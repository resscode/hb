<?php

/**
 * Answer codes list for API REST answers
 */
/*
 * 
 *  Success part
 *  Codes with success result
 */

// Main success code which return a data
$config['successcode_success'] = 1001;

/*
 * 
 *  Alert part
 *  Code when in process of the defined operation appear Alert, but it was
 *  finished with success result
 */

// User with userid already in tale, new key was generated
$config['alertcode_alreadyin'] = 2001;

// Not all columns in params has permissions for edit
$config['alertcode_notpermited'] = 2002;

/*
 * 
 *  Error part
 *  Until operation execution was appeared fatal error  
 */

// Until operation execution was appeared unknown error
$config['errorcode_unknownerror'] = 3001;

// Entered data for login is wrong
$config['errorcode_notlogin'] = 3002;

// If time for sign was expired
$config['errorcode_signlifetime'] = 3003;

// If auth code doesn't match with result of the check 
$config['errorcode_signcheckfail'] = 3004;

// Crud model generation, no table for obtain 
$config['errorcode_notableformodel'] = 3005;

// Not enough parameters in REST request becamed to API
$config['errorcode_notenoughparams'] = 3006;

// Some global problem with db, detailes writen in log
$config['errorcode_globdb'] = 3007;

// Some global problem with API, detailes writen in log
$config['errorcode_general'] = 3008;

// Some global problem in code, detailes writen in log
$config['errorcode_incode'] = 3009;

// 404 error
$config['errorcode_404'] = 3010;

//Cannot add row in crud
$config['errorcode_crudnotadd'] = 3011;

//Cannot update row in crud
$config['errorcode_crudnotupdate'] = 3012;

//Cannot delete row in crud
$config['errorcode_crudnotdelete'] = 3013;

//No results for prepared query
$config['errorcode_noresults'] = 3014;

//Time for operation has expired
$config['errorcode_timeexpired'] = 3015;

//No such entity
$config['errorcode_noentity'] = 3016;

//Not enough permissions
$config['errorcode_nopermissions'] = 3017;

//Not active
$config['errorcode_notactive'] = 3018;

//Already made
$config['errorcode_made'] = 3019;

//No attempts
$config['errorcode_noattempts'] = 3020;

//Isn't match
$config['errorcode_notmatch'] = 3021;

//Can't save on hard drive
$config['errorcode_saveonhard'] = 3022;

return $config;
?>
