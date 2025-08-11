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
define('PROJECT_NAME',				'transinn'); // IF server make it empty
define('PROJECT_TITLE',				'Transinn');
define('PROJECT_URL',				'http://transinn.com');
define('PROJECT_THEME',				'theme_dark');
define('ENCRYPTION_KEY',			'786$&GH&%!@');
define('BASE_CURRENCY_ICON',		'$');//Default Currency is USD($) Unicode Decial
define('BASE_CURRENCY',				'USD');
define('ASSETS',					'http://'.$_SERVER['HTTP_HOST'].'/~demoproject/'.PROJECT_NAME.'/assets/'.PROJECT_THEME.'/');
define('WEB_URL',					'http://'.$_SERVER['HTTP_HOST'].'/~demoproject/'.PROJECT_NAME.'/');
define('UPLOAD_PATH',				'http://'.$_SERVER['HTTP_HOST'].'/~demoproject/'.PROJECT_NAME.'/photo/');
define('B2C',						'ACTIVE');
define('B2B',						'ACTIVE');
define('HOTEL',						'ACTIVE');
define('FLIGHT',					'ACTIVE');


/* End of file constants.php */
/* Location: ./application/config/constants.php */