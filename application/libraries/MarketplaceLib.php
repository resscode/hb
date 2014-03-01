<?php

/**
 * Description of Marketplace
 *
 * @author anton
 */
class MarketplaceLib {

    const TABLENAMEORDPART   = '[name]s';
    const TABLENAMEPACKGPART = 'customers_[name]';
    const ORDERLOGPATH       = '/application/logs/orders';

    private $errorMessage;
    private $resultCode;
    private $ci;
    private $orderId;
    private $customerId;
    private $ticketName;
    private $orderInfo;
    private $restrictions;
    private $orderPartsInfo;
    private $packageInfo      = false;
    private $packagePartsInfo = false;
    private $customersModulesInfo;

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->config->load('commonconfig');
        $this->ci->load->library('Logs');
    }

    /**
     * Create order
     * @param array $params
     * @param int $customerId
     * @return string
     */
    public function sendorder($params, $customerId) {
        $insertParts = array();
        $totalPrice  = 0;
        //  Prepare params
        foreach ($params as $key => $param) {
            if (isset($param['partName']) && isset($param['partId']) && isset($param['partPrice'])) {
                $tableName                        = str_replace('[name]', $param['partName'], self::TABLENAMEORDPART);
                $insertParts['order_parts'][$key] = array(
                    'table_name' => $tableName,
                    'table_id'   => $param['partId'],
                    'price'      => $param['partPrice'],
                    'value'      => isset($param['partValue']) && $param['partName'] == 'restriction' ? $param['partValue']
                                : 0
                );
                $totalPrice+=$param['partPrice'];
            }
        }
        // Check for empty parts
        if (empty($insertParts)) {
            $this->errorMessage = 'No valid parts to start order prepare';
            return $this->ci->config->item('errorcode_notenoughparams');
        }
        // Prepare write in orders
        $insertParts['orders'] = array(
            'total_price' => $totalPrice,
            'customer_id' => $customerId,
            'created'     => date("Y-m-d H:i:s")
        );
        $orderResult           = $this->insertInTable('orders', $insertParts['orders']);
        if ($orderResult == false) {
            return $this->ci->config->item('errorcode_globdb');
        } else {
            // Continue with writing in orders_parts
            $orderId  = $this->orderId;
            $this->ticketCreate($insertParts['orders']);
            $readyArr = array();
            foreach ($insertParts['order_parts'] as $item) {
                $item['order_id'] = $orderId;
                $readyArr[]       = $item;
            }
            sort($readyArr);
            $orderPartsRes = $this->insertInTable('order_parts', $readyArr);
            unset($insertParts);
            if ($orderPartsRes == false) {
                $this->ci->db->delete('orders', array('id' => $orderId));
                $answercode = $this->ci->config->item('errorcode_globdb');
            } else {
                $this->messageInLog(__METHOD__, $readyArr, 'SUCCESS');
                // If Price =0 start insert in package table
                if ($totalPrice == 0) {
                    return $this->changeOrderStatus($orderId, $customerId);
                }
                $answercode = $this->ci->config->item('successcode_success');
            }
        }
        return $answercode;
    }

    public function moveOrderToCanceled() {
        // Delete from Orders, Orders_Parts
        $this->ci->db->delete('orders', array('id' => $this->orderId));
        $this->ci->db->delete('order_parts', array('order_id' => $this->orderId));
        // Create records in Orders_canceled, Orders_parts_canceled
        $this->ci->db->insert('orders_canceled', $this->orderInfo);
        $this->ci->db->insert_batch('order_parts_canceled', $this->orderPartsInfo);
        return $this->ci->config->item('successcode_success');
    }

    /**
     *  Making orders 
     * @param int $orderId
     * @param int $customerId
     * @param boolean $status
     * @return boolean
     * @throws Exception
     */
    public function changeOrderStatus($orderId, $customerId, $status = 1) {
        try {
            $this->orderId    = $orderId;
            $this->customerId = $customerId;
            // Get info about order from order and order_parts            
            if ($this->getOrderInfo() == false) {
                throw new Exception('No order Info', $this->ci->config->item('errorcode_noresults'));
            }
            if ($this->getOrderPartsInfo() == false) {
                throw new Exception('No order Parts Info', $this->ci->config->item('errorcode_noresults'));
            }
            // Check if this is second attempt of the order make
            $orderInfo        = $this->orderInfo;
            // Set ticket name 
            $this->ticketName = $orderInfo['id'];
            if ($orderInfo['is_paid'] == 1 || $orderInfo['is_processed'] == 1) {
                // Already made order
                throw new Exception('Order is already made', $this->ci->config->item('errorcode_made'));
            }
            $this->messageInLog(__METHOD__, $orderInfo, 'SUCCESS');
            $this->customerId = $orderInfo['customer_id'];
            if ($status == 0) {
                if ($orderInfo['customer_id'] != $customerId) {
                    throw new Exception('This customer can\'t made such operation', $this->ci->config->item('errorcode_nopermissions'));
                }
                return $this->moveOrderToCanceled();
            }
            // Check has this operation attemts or not
            if ($orderInfo['attempt'] == $this->ci->config->item('orderAttemptLimit')) {
                // Already made order
                throw new Exception('The number of attempts has exceeded', $this->ci->config->item('orderAttemptLimit'));
            }
            // Delete all parts from package if attempt>0, it means that some fail occurred in previous attempt  
            if ($orderInfo['attempt'] > 0) {
                $this->messageInLog('deleteNotFinishedPackage', 'deleting..', 'SUCCESS');
                $this->deleteNotFinishedPackage();
            }
            //Increment attempt
            $this->updateOrder($orderInfo['id'], array('attempt' => $orderInfo['attempt'] + 1));
            $this->messageInLog('updateOrder', 'updating..', 'SUCCESS');
            // Get info about isset packages for item customer in expire period, if isset connect order to package
            // renew is a flag true - package isset, false - new request            
            if ($this->getPackageInfo() == true) {
                $packageInfo         = $this->packageInfo;
                $this->messageInLog('packageInfo', $packageInfo, 'SUCCESS');
                // Check for start date and end date if curent date in this period then delete old records
                $startPackageDateObj = new DateTime($packageInfo['start_date']);
                $endPackageDateObj   = new DateTime($packageInfo['expire_date']);
                $currTimestamp       = time();
                if ($currTimestamp < $startPackageDateObj->getTimestamp()
                        || $currTimestamp > $endPackageDateObj->getTimestamp()) {
                    // This is renew operation, all that connected to this package should be deleted
                    $this->deletePackage($packageInfo['id']);
                    $this->packageInfo = false;
                    // Update order record in db
                    $this->updateOrder($orderInfo['id'], array('is_renew' => 1));
                    $this->messageInLog('updateOrder', array('is_renew' => 1), 'SUCCESS');
                }
                // Check if in order_parts isset restriction, delete all records from customer_restriction and package_parts
                // Get Restrictions with Types
                $restrictions = $this->getRestrictions();
                // Prepare restrictions
                $restrReady   = array();
                foreach ($restrictions as $restriction) {
                    $restrReady[$restriction['id']] = $restriction;
                }
                unset($restrictions);
                foreach ($this->orderPartsInfo as $orderPart) {
                    if ($orderPart['table_name'] == 'restrictions') {
                        if (!isset($restrReady[$orderPart['table_id']]['type_id'])) {
                            continue;
                        }
                        $restrDelArr = array();
                        $currType    = $restrReady[$orderPart['table_id']]['type_id'];
                        foreach ($restrReady as $restr) {
                            if ($restr['type_id'] == $currType) {
                                $restrDelArr[] = $restr['id'];
                            }
                        }
                        $this->deleteCustomerRestriction($packageInfo['id'], $restrDelArr);
                        $this->messageInLog('deleteCustomerRestriction', $restrDelArr, 'SUCCESS');
                    }
                }
            } else {
                // First time package create, maybe some deference should be...
            }
            if ($this->packageCreate() == false) {
                throw new Exception('Some problem In packageCreate', $this->ci->config->item('errorcode_globdb'));
            }
            // Update order record in db
            $updateOrder = array(
                'package_id'   => $this->packageInfo['id'],
                'is_paid'      => 1,
                'is_processed' => 1,
                'pay_date'     => date("Y-m-d H:i:s")
            );
            $this->updateOrder($orderInfo['id'], $updateOrder);
            $this->messageInLog('updateOrder', $updateOrder, 'SUCCESS');
            //TODO make Write in order table help values
        } catch (Exception $ex) {
            $message            = $ex->getMessage();
            $this->messageInLog(__METHOD__, $message, 'ERROR');
            $this->errorMessage = $message;
            return $ex->getCode();
        }
        return $this->ci->config->item('successcode_success');
    }

    public function getOrderId() {
        return $this->orderId;
    }

    /**
     * 
     * @param array $ids
     * @return array
     */
    private function getRestrictionsIn($ids) {
        $this->ci->db->select('restrictions.id, restriction_types.name_in_table');
        $this->ci->db->from('restrictions');
        $this->ci->db->join('restriction_types', "restriction_types.id=restrictions.restriction_type_id");
        $this->ci->db->where_in('restrictions.id', $ids);
        $query = $this->ci->db->get();
        if ($query != false && $query->num_rows() > 0) {
            return $query->result_array();
        } else {
            $this->errorMessage = $this->ci->db->_error_message();
            return array();
        }
    }

    /**
     * 
     * @param string/boolean $typeName
     * @param int/boolean $customerId
     * @param int/boolean $tableId
     * @return boolean
     */
    public function getRestrictions($typeName = false, $customerId = false, $tableId = false) {
        if ($customerId == false) {
            $this->ci->db->select('restrictions.id, restrictions.price, restriction_types.name, restriction_types.id as type_id');
        } else {
            $this->ci->db->select('restrictions.id, restrictions.price, restriction_types.name, customers_restrictions.id AS custRestr');
        }
        $this->ci->db->from('restrictions');
        $this->ci->db->join('restriction_types', 'restrictions.restriction_type_id=restriction_types.id');
        if ($customerId != false && $typeName != false) {
            $this->ci->db->join('customers_restrictions', "customers_restrictions.table_id=restrictions.id");
            $this->ci->db->where('customers_restrictions.customer_id', $customerId);
            $this->ci->db->where('restriction_types.name', $typeName);
        }
        if ($tableId != false) {
            $this->ci->db->where('restrictions.id', $tableId);
        }
        $query = $this->ci->db->get();
        if ($query != false && $query->num_rows() > 0) {
            return $query->result_array();
        } else {
            $this->errorMessage = $this->ci->db->_error_message();
            return false;
        }
    }

    private function updateOrder($orderId, $orderData) {
        $this->ci->db->where('id', $orderId);
        return $this->ci->db->update('orders', $orderData);
    }

    private function insertInTable($tableName, $params) {
        if (isset($params[0]) && is_array($params[0])) {
            // insert batch
            $result = $this->ci->db->insert_batch($tableName, $params);
        } else {
            // insert single
            $result = $this->ci->db->insert($tableName, $params);
            if ($tableName == 'orders') {
                $this->orderId = $this->ci->db->insert_id();
            }
        }
        $errorMessage = $this->ci->db->_error_message();
        if (!empty($errorMessage)) {
            $this->errorMessage = $this->ci->db->_error_message();
            return false;
        } else {
            return true;
        }
    }

    private function packageCreate() {
        try {
            $currDateObj = new DateTime();
            if ($this->packageInfo == FALSE) {
                // Create new package
                $packageLifetime  = (int) $this->ci->config->item('packageLifetime');
                $packageRenew     = (int) $this->ci->config->item('packageRenew');
                $endDateTimestamp = (int) $currDateObj->getTimestamp() + $packageLifetime;
                $endDateObj       = new DateTime();
                $endDateObj->setTimestamp($endDateTimestamp);
                $packageData      = array(
                    'customer_id'  => $this->customerId,
                    'start_date'   => $currDateObj->format("Y-m-d H:i:s"),
                    'expire_date'  => $endDateObj->format("Y-m-d H:i:s"),
                    'renew_period' => $packageRenew,
                    'created'      => $currDateObj->format("Y-m-d H:i:s"),
                );
                if (!is_bool($this->ci->db->insert('packages', $packageData))) {
                    throw new Exception($this->ci->db->_error_message(), $this->ci->config->item('errorcode_globdb'));
                }
                $this->packageInfo['id'] = $this->ci->db->insert_id();
                $this->messageInLog('createPackage', $packageData, 'SUCCESS');
            } else {
                // Update isset package
                $packageData = array(
                    'updated' => $currDateObj->format("Y-m-d H:i:s")
                );
                $this->ci->db->where('id', $this->packageInfo['id']);
                $this->ci->db->update('packages', $packageData);
                $this->messageInLog('updatePackage', $packageData, 'SUCCESS');
            }
            // Insert in package parts, prepare data to insert in customers_..
            $orderParts      = $this->orderPartsInfo;
            // Array contain customer_...data
            $customerParts   = array();
            $packageParts    = array();
            $packageInfo     = $this->packageInfo;
            $i               = 0;
            $resstrictionsIn = false;
            // Prepare data for insert
            foreach ($orderParts as $orderPart) {
                $packageParts[]                = array(
                    'package_id' => $packageInfo['id'],
                    'table_name' => $orderPart['table_name'],
                    'table_id'   => $orderPart['table_id']
                );
                $tableName                     = str_replace('[name]', $orderPart['table_name'], self::TABLENAMEPACKGPART);
                $customerParts[$tableName][$i] = array(
                    'table_id'    => $orderPart['table_id'],
                    'customer_id' => $this->customerId,
                    'package_id'  => $packageInfo['id'],
                    'price'       => $orderPart['price'],
                    'created'     => $currDateObj->format("Y-m-d H:i:s")
                );
                if (!is_null($orderPart['value']) && $orderPart['value'] != 0) {
                    $customerParts[$tableName][$i]['value'] = $orderPart['value'];
                }
                $i++;
                // Prepare select for restrictions get
//                $restrictions=array();
                if ($orderPart['table_name'] == 'restrictions') {
                    $resstrictionsIn[$orderPart['table_id']] = $orderPart;
                }
            }
            if ($resstrictionsIn != false) {
                //Prepare info to insert in customers table
                $restrictionsInfo = $this->getRestrictionsIn(array_keys($resstrictionsIn));
                $custUpdateData   = array();
                foreach ($restrictionsInfo as $itemRestr) {
                    $custUpdateData[$itemRestr['name_in_table']] = $resstrictionsIn[$itemRestr['id']]['value'];
                }
                // Update customers restrictions in customer table
                $this->changeRestrictionForCustomer($custUpdateData, $this->customerId);
                $this->messageInLog('changeRestrictionForCustomer', $custUpdateData, 'SUCCESS');
            }
            //TODO add full check here
            // insert in package parts
            $this->ci->db->insert_batch('package_parts', $packageParts);
            $this->messageInLog('package_parts', $packageParts, 'SUCCESS');
            // insert in customers_
            foreach ($customerParts as $tableName => $tableRecords) {
                foreach ($tableRecords as $tableRecord) {
                    if ($this->ci->db->insert($tableName, $tableRecord) == false) {
                        throw new Exception($this->ci->db->_error_message(), $this->ci->config->item('errorcode_globdb'));
                    }
                }
                $this->messageInLog('insert' . $tableName, $tableRecords, 'SUCCESS');
            }
        } catch (Exception $ex) {
            $this->resultCode   = $ex->getCode();
            $this->errorMessage = $ex->getMessage();
            return false;
        }
        return true;
    }

    private function changeRestrictionForCustomer($updateData, $customerId) {
        $this->ci->db->where('id', $customerId);
        $this->ci->db->update('customers', $updateData);
        return true;
    }

    private function deletePackage($packageId) {
        // delete from Package
        $this->ci->db->delete('packages', array('id' => $packageId));
        $this->messageInLog('delete', 'delete from packages...', 'SUCCESS');
        // select from customers_...
        if ($this->getPackagePartsInfo()) {
            foreach ($this->packagePartsInfo as $packagePart) {
                $this->ci->db->where('package_id', $packageId);
                $tableName = str_replace('[name]', $packagePart['table_name'], self::TABLENAMEPACKGPART);
                $this->ci->db->delete($tableName);
                $this->messageInLog('delete', 'delete from ' . $tableName, 'SUCCESS');
            }
        }
        // delete from package_parts
        $this->ci->db->delete('package_parts', array('package_id' => $packageId));
    }

    private function deleteCustomerRestriction($packageId, $ids) {
        // Delete from customer restriction
        $this->ci->db->where('package_id', $packageId);
        $this->ci->db->where_in('table_id', $ids);
        $this->ci->db->delete('customers_restrictions');
        // Delete from package parts
        $this->ci->db->where('package_id', $packageId);
        $this->ci->db->where_in('table_name', 'restrictions');
        $this->ci->db->where_in('table_id', $ids);
        $this->ci->db->delete('package_parts');
        return true;
    }

    private function deleteNotFinishedPackage() {
        $orderInfo      = $this->orderInfo;
        $orderPartsInfo = $this->orderPartsInfo;
        if (!isset($orderInfo['package_id']) || (isset($orderInfo['package_id']) && is_null($orderInfo['package_id']))) {
            return false;
        }
        // delete from Package
        $this->ci->db->delete('packages', array('id' => $orderInfo['package_id']));
        // delete from package_parts
        $this->ci->db->delete('package_parts', array('package_id' => $orderInfo['package_id']));
        // Delete from package customers tables customers_...
        if (is_array($orderPartsInfo)) {
            foreach ($orderPartsInfo as $orderPart) {
                $this->ci->db->where('id', $orderPart['table_id']);
                $this->ci->db->delete(str_replace('[name]', $orderPart['table_name'], self::TABLENAMEPACKGPART));
            }
        }
        return true;
    }

    private function getOrderInfo() {
        $this->ci->db->from('orders');
        $this->ci->db->where(array('id' => $this->orderId));
        $query = $this->ci->db->get();
        if ($query != false && $query->num_rows() > 0) {
            $this->orderInfo = $query->row_array();
            return true;
        } else {
            $this->errorMessage = $this->ci->db->_error_message();
            return false;
        }
    }

    private function getOrderPartsInfo() {
        $this->ci->db->from('order_parts');
        $this->ci->db->where(array('order_id' => $this->orderId));
        $query = $this->ci->db->get();
        if ($query != false && $query->num_rows() > 0) {
            $this->orderPartsInfo = $query->result_array();
            return true;
        } else {
            $this->errorMessage = $this->ci->db->_error_message();
            return false;
        }
    }

    public function getPackageInfo($byCustomerId = false, $returnRes = false) {
        if ($byCustomerId == false) {
            $orderInfo = $this->orderInfo;
            $this->ci->db->from('packages');
            $this->ci->db->where('id', $orderInfo['package_id']);
            $this->ci->db->or_where('customer_id', $this->customerId);
        } elseif (is_int($byCustomerId)) {
            // for standalone classes
            $this->ci->db->from('packages');
            $this->ci->db->where('customer_id', $byCustomerId);
        } else {
            return false;
        }
        $query = $this->ci->db->get();
        if ($query != false && $query->num_rows() > 0) {
            $this->packageInfo = $query->row_array();
            if ($returnRes == true) {
                return $this->packageInfo;
            } else {
                return true;
            }
        } else {
            $this->errorMessage = $this->ci->db->_error_message();
            return false;
        }
    }

    /**
     * Parts of the package getting
     * @return boolean
     */
    private function getPackagePartsInfo() {
        $orderInfo   = $this->orderInfo;
        $packageInfo = $this->packageInfo;
        if (isset($orderInfo['package_id'])) {
            // For Order
        } elseif ($packageInfo != false) {
            // For package
            $orderInfo['package_id']       = $packageInfo['id'];
            $this->orderInfo['package_id'] = $packageInfo['id'];
        } else {
            // No enough data
            return false;
        }
        $this->ci->db->from('package_parts');
        $this->ci->db->where('package_id', $orderInfo['package_id']);
        $query = $this->ci->db->get();
        if ($query != false && $query->num_rows() > 0) {
            $this->packagePartsInfo = $query->result_array();
            return true;
        } else {
            $this->errorMessage = $this->ci->db->_error_message();
            return false;
        }
    }

    /**
     * 
     * @param type $startSubscrDate
     * @param type $endSubscrDate
     * @param type $price
     * @param string $typeOf
     * @param array $addParams
     *   "currPrice"
     * @return decimal
     */
    public function countCurrentPrice($startSubscrDate, $endSubscrDate, $price, $typeOf, $addParams = array()) {
        $curPrice                 = $price;
        $endDateObj               = new DateTime($endSubscrDate);
        $endDateTimeStamp         = $endDateObj->getTimestamp();
        $curDateObj               = new DateTime();
        $curDateTimeStamp         = $curDateObj->getTimestamp();
        $startSubscrDateObj       = new DateTime($startSubscrDate);
        $startSubscrDateTimeStamp = $startSubscrDateObj->getTimestamp();
        $priceInZeroPeriod        = $this->ci->config->item('priceInZeroPeriod');
        if ($endDateTimeStamp <= $curDateTimeStamp) {
            $curPrice = $price;
        } elseif ($endDateTimeStamp - $curDateTimeStamp <= $priceInZeroPeriod) {
            $curPrice = 0;
        } else {
            if ($typeOf == 'module' || $typeOf == 'language') {
                // (integer)($curDateTimeStamp/86400) days from start Unix epox,  86400 - sec in 1 day
                $curPrice = $price / 365 * (365 - (integer) (($curDateTimeStamp - $startSubscrDateTimeStamp) / 86400));
            } elseif ($typeOf = 'restriction') {
                if (empty($addParams) || !isset($addParams['currPrice'])) {
                    $curPrice = $price / 365 * (365 - (integer) (($curDateTimeStamp - $startSubscrDateTimeStamp) / 86400));
                } else {
                    $curPrice = $price / 365 * (365 - (integer) (($curDateTimeStamp - $startSubscrDateTimeStamp) / 86400))
                            - $addParams['currPrice'] / 365 * (365 - (integer) (($curDateTimeStamp - $startSubscrDateTimeStamp) / 86400));
                    if ($curPrice < 0)
                        $curPrice = 0;
                }
            } else {
                $curPrice = $price;
            }
        }
        return round($curPrice, 6);
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }

    /**
     * 
     * @param string $methodName
     * @param string $faultMessage
     */
    private function messageInLog($methodName, $message, $messageType = 'ERROR', $logFolder = 'ORDERLOGPATH') {
        return $this->ci->logs->writeLog($message, $messageType . "; " . $methodName, 1, $this->ticketName, self::ORDERLOGPATH, true);
    }

    /**
     * Create bying ticket for each order
     */
    protected function ticketCreate($details) {
        try {
//            $dateString       = date("YmdHis") . substr((string) microtime(), 2, 4);
//            $ticketName       = $dateString . "_" . $this->orderId;
            $ticketName       = $this->orderId;
            $this->ticketName = $ticketName;
            // Create ticket file
            return $this->ci->logs->writeLog($details, 'SUCCESS;' . __METHOD__, 1, $ticketName, self::ORDERLOGPATH, true);
        } catch (Exception $ex) {
            log_message('error', $ex->getMessage() . "\n\tFile name: " . $ex->getFile() . "\n\tLine number: " . $ex->getLine() . "\n\tStack Trace: " . $ex->getTraceAsString(), 'FAIL;' . __METHOD__);
            return false;
        }
        return true;
    }

    /**
     * Deleting order ticket
     */
    protected function ticketDelete() {
        //echo realpath(APPLICATION_PATH .'/../log/transactions/'.$this->ticketName.'.log'); exit;
        $this->ci->load->library('Logs');
        $logPath = FULLPATH . self::ORDERLOGPATH . $this->ticketName . '.log';
        $this->ci->logs->deleteLog($logPath);
    }

}

?>
