<?php

/**
 * Description of arrayToXml
 *
 * @author anton
 */
class ArrayToXml {

    var $array     = array();
    var $xml       = '';
    var $root_name = '';
    var $charset   = '';

    /**
     * 
     * @param array $params = array('array'     => $array, 'charset'   => 'utf-8', 'root_name' => 'root');
     */
    public function __construct($params = array()) {
        header("content-type: text/xml");
        $this->array     = isset($params['array']) ? $params['array'] : false;
        $this->root_name = isset($params['root_name']) ? $params['root_name'] : 'root';
        $this->charset   = isset($params['charset']) ? $params['charset'] : 'utf-8';
        $array=$this->array;
        if (is_array($array) && count($array) > 0) {
            $this->struct_xml($array);
        } else {
            $this->xml .= "no data";
        }
    }

    public function struct_xml($array) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                $tag = preg_replace('/^[0-9]{1,}$/', 'item', $k); // replace numeric key in array to 'data'
                $this->xml .= "<$tag>";
                $this->struct_xml($v);
                $this->xml .= "</$tag>";
            } else {
                $tag = preg_replace('/^[0-9]{1,}$/', 'item', $k); // replace numeric key in array to 'data'
                $this->xml .= "<$tag><![CDATA[$v]]></$tag>";
            }
        }
    }

    public function get_xml($params=false) {
        if (is_array($params) && isset($params['array'])){
            $this->xml='';
             $this->struct_xml($params['array']);
        }
        $header = "<?xml version=\"1.0\" encoding=\"" . $this->charset . "\"?><" . $this->root_name . ">";
        $footer = "</" . $this->root_name . ">";
        
        return $header . $this->xml . $footer;
    }
    public function __destruct() {        
    }

}


 
//class Array2XML {
// 
//    private static $xml = null;
//	private static $encoding = 'UTF-8';
// 
//    /**
//     * Initialize the root XML node [optional]
//     * @param $version
//     * @param $encoding
//     * @param $format_output
//     */
//    public static function init($version = '1.0', $encoding = 'UTF-8', $format_output = true) {
//        self::$xml = new DomDocument($version, $encoding);
//        self::$xml->formatOutput = $format_output;
//		self::$encoding = $encoding;
//    }
// 
//    /**
//     * Convert an Array to XML
//     * @param string $node_name - name of the root node to be converted
//     * @param array $arr - aray to be converterd
//     * @return DomDocument
//     */
//    public static function &createXML($node_name, $arr=array()) {
//        $xml = self::getXMLRoot();
//        $xml->appendChild(self::convert($node_name, $arr));
// 
//        self::$xml = null;    // clear the xml node in the class for 2nd time use.
//        return $xml;
//    }
// 
//    /**
//     * Convert an Array to XML
//     * @param string $node_name - name of the root node to be converted
//     * @param array $arr - aray to be converterd
//     * @return DOMNode
//     */
//    private static function &convert($node_name, $arr=array()) {
// 
//        //print_arr($node_name);
//        $xml = self::getXMLRoot();
//        $node = $xml->createElement($node_name);
// 
//        if(is_array($arr)){
//            // get the attributes first.;
//            if(isset($arr['@attributes'])) {
//                foreach($arr['@attributes'] as $key => $value) {
//                    if(!self::isValidTagName($key)) {
//                        throw new Exception('[Array2XML] Illegal character in attribute name. attribute: '.$key.' in node: '.$node_name);
//                    }
//                    $node->setAttribute($key, self::bool2str($value));
//                }
//                unset($arr['@attributes']); //remove the key from the array once done.
//            }
// 
//            // check if it has a value stored in @value, if yes store the value and return
//            // else check if its directly stored as string
//            if(isset($arr['@value'])) {
//                $node->appendChild($xml->createTextNode(self::bool2str($arr['@value'])));
//                unset($arr['@value']);    //remove the key from the array once done.
//                //return from recursion, as a note with value cannot have child nodes.
//                return $node;
//            } else if(isset($arr['@cdata'])) {
//                $node->appendChild($xml->createCDATASection(self::bool2str($arr['@cdata'])));
//                unset($arr['@cdata']);    //remove the key from the array once done.
//                //return from recursion, as a note with cdata cannot have child nodes.
//                return $node;
//            }
//        }
// 
//        //create subnodes using recursion
//        if(is_array($arr)){
//            // recurse to get the node for that key
//            foreach($arr as $key=>$value){
//                if(!self::isValidTagName($key)) {
//                    throw new Exception('[Array2XML] Illegal character in tag name. tag: '.$key.' in node: '.$node_name);
//                }
//                if(is_array($value) && is_numeric(key($value))) {
//                    // MORE THAN ONE NODE OF ITS KIND;
//                    // if the new array is numeric index, means it is array of nodes of the same kind
//                    // it should follow the parent key name
//                    foreach($value as $k=>$v){
//                        $node->appendChild(self::convert($key, $v));
//                    }
//                } else {
//                    // ONLY ONE NODE OF ITS KIND
//                    $node->appendChild(self::convert($key, $value));
//                }
//                unset($arr[$key]); //remove the key from the array once done.
//            }
//        }
// 
//        // after we are done with all the keys in the array (if it is one)
//        // we check if it has any text value, if yes, append it.
//        if(!is_array($arr)) {
//            $node->appendChild($xml->createTextNode(self::bool2str($arr)));
//        }
// 
//        return $node;
//    }
// 
//    /*
//     * Get the root XML node, if there isn't one, create it.
//     */
//    private static function getXMLRoot(){
//        if(empty(self::$xml)) {
//            self::init();
//        }
//        return self::$xml;
//    }
// 
//    /*
//     * Get string representation of boolean value
//     */
//    private static function bool2str($v){
//        //convert boolean to text value.
//        $v = $v === true ? 'true' : $v;
//        $v = $v === false ? 'false' : $v;
//        return $v;
//    }
// 
//    /*
//     * Check if the tag name or attribute name contains illegal characters
//     * Ref: http://www.w3.org/TR/xml/#sec-common-syn
//     */
//    private static function isValidTagName($tag){
//        $pattern = '/^[a-z_]+[a-z0-9\:\-\.\_]*[^:]*$/i';
//        return preg_match($pattern, $tag, $matches) && $matches[0] == $tag;
//    }
//}


?>
