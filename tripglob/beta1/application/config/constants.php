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

/* Customized Constants */
define('PROJECT_NAME',				'beta1'); // IF server make it empty
define('PROJECT_TITLE',				'TripGlobo');
define('PROJECT_URL',				'https://www.tripglobo.com/beta1/');
define('PROJECT_THEME',				'theme_dark');
define('ENCRYPTION_KEY',			'786$&GH&%!@');
/*define('BASE_CURRENCY_ICON',		'$');
define('BASE_CURRENCY',				'USD');
define('BASE_CURRENCY_CODE',		'USD');*/

define('BASE_CURRENCY_CODE',		'INR');
define('BASE_CURRENCY_ICON',		'INR');
define('BASE_CURRENCY',				'INR');

define('SSL_TLL',					'http://');
define('ASSETS',					SSL_TLL.$_SERVER['HTTP_HOST'].'/'.PROJECT_NAME.'/assets/'.PROJECT_THEME.'/');
define('BASE_URL',					SSL_TLL.$_SERVER['HTTP_HOST'].'/'.PROJECT_NAME.'/');
define('ADMIN_ASSETS',				SSL_TLL.$_SERVER['HTTP_HOST'].'/'.PROJECT_NAME.'/admin-panel/assets/');
define('WEB_URL',					SSL_TLL.$_SERVER['HTTP_HOST'].'/'.PROJECT_NAME.'/');
define('UPLOAD_PATH',				SSL_TLL.$_SERVER['HTTP_HOST'].'/'.PROJECT_NAME.'/photo/');
define('IMG_URL',					SSL_TLL.$_SERVER['HTTP_HOST'].'/'.PROJECT_NAME.'/admin-panel/uploads/');
define('FRONT_UPLOAD',				SSL_TLL.$_SERVER['HTTP_HOST'].'/'.PROJECT_NAME.'/application/uploads/');
define('B2C',						'ACTIVE');
define('B2B',						'ACTIVE');
define('HOTEL',						'ACTIVE');
define('FLIGHT',					'ACTIVE');

define('ACTIVE', 1);
define('INACTIVE', 0);
define('MODERATION', 2);
define('SUCCESS', 1);
define('FAILURE', 0);
define('WEBSERVICE_USERNAME','ProvabADVANCE');
define('WEBSERVICE_PASSWORD','RAHUL@provab9067');
define('WEBSERVICE_KEY','w&Yft78w^4*@ttPg');

//admin table id
//define('ADMIN_ID',1);
define('ADMIN_ID',1);
define('FLIGHT_MARKUP',1);

define('B2C_USER',2);
define('B2B_USER',1);
define('STAFF_USER',4);
define('FRONT_URL','/home/tripglobo/public_html/beta1/');

define ( 'PROJECT_PATH', '/home/tripglobo/public_html' );
define('ticket_date1',Date('dmy', strtotime("+360 days")));