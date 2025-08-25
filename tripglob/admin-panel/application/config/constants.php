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



$env_base_url = getenv('ADMIN_URL');

if ($env_base_url && strlen(trim($env_base_url)) > 0) {
    // Remove trailing slash to avoid double slashes when concatenated with leading slash paths
    $base_url = rtrim($env_base_url, '/');
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
                 || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

    $host = $_SERVER['HTTP_HOST'];
    $script_name = $_SERVER['SCRIPT_NAME'];
    $path = str_replace(basename($script_name), '', $script_name);

    // Remove trailing slash from $path as well
    $path = rtrim($path, '/');

    $base_url = $protocol . $host . $path;
} else {
    $base_url = "http://localhost/tripglobo_dev/tripglob/admin-panel";  // no trailing slash
}
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

$APPLICATION_NAME="";

define('IMAGE_UPLOAD',				'TripGlobo');
define('PROJECT_TITLE',				'TripGlobo');
define('PROJECT_URL',				'https://dev-tripglobo.dsocmarket.com/admin-panel');
define('PROJECT_THEME',				'theme_dark');
define('ENCRYPTION_KEY',			'786$&GH&%!@');
define('BASE_CURRENCY_ICON',		'INR');
define('BASE_CURRENCY',				'INR');
define('SSL_TLL',					'https://');
define('BASE_URL',					$base_url);
define('ASSETS',					$base_url.'/assets/');
define('WEB_URL',					$base_url.'/');
define('WEB_FRONT_URL',				$base_url.'/');
define('SERVER_ADDR',				$_SERVER['SERVER_NAME']);
define('CLIENT_ADDR',				$_SERVER['REMOTE_ADDR']);
define('ADMIN_ID',					1); // 1= Super Admin , 2= Sub Admin
 
define('HTTP_USER_AGENT',			'HTTP_USER_AGENT');

define('SUPER_ADMIN_NAME',			'SUPER ADMIN');
define('SUB_ADMIN_NAME',			'SUB ADMIN');
define('SITE_TIME_FORMAT',			'd-M-Y');

define('UPLOADS',					$base_url.'/uploads/');
define('PROJECT_LOGO',				ASSETS.'/images/logo.png');

/*Added by ela*/
define('PROJECT_NAME',				''); // IF server make it empty
define('ACTIVE',1);
define('INACTIVE',0);
define('UPLOAD_PATH',				'https://'.$_SERVER['HTTP_HOST'].'/photo/users/');
define('TRANSFER_IMG_PATH',			WEB_URL."uploads/transfer/");


define('B2C_USER',2);
define('B2B_USER',1);
define('STAFF_USER',4);


/* End of file constants.php */
/* Location: ./application/config/constants.php */
