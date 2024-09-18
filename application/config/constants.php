<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* Credits transaction Codes */
define('CASH_PAYMENT_RECEIVED', 'CPR');
define('PAYPAL_PAYMENT_RECEIVED', 'PPR');
define('IMEI_CODE_REQUEST', 'IMC');
define('BROUTFORCE_CODE_REQUEST', 'BFC');
define('SERVER_CODE_REQUEST', 'SRC');
define('REFERRAL_MEMBER_COMMISSION', 'RMC');

/* IMEI Order Field Types  */
define('ORDER_FIELD_TYPE_IMEI', 1);
define('ORDER_FIELD_TYPE_SN', 2);
define('ORDER_FIELD_TYPE_UNIVERSAL', 0);

/* Client Libraries */
define('LIBRARY_DHURU_CLIENT', 1);

/* Payment Gateways Settings */
define('TEST_MODE', FALSE);

/* End of file constants.php */
/* Location: ./application/config/constants.php */