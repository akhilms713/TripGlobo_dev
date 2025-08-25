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


$env_base_url = getenv('BASE_URL');

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
    $base_url = "http://localhost/tripglobo_dev/tripglob";  // no trailing slash
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
define('PROJECT_NAME',				''); // IF server make it empty
define('PROJECT_TITLE',				'TripGlobo');
define('PROJECT_URL',				'https://dev-tripglobo.dsocmarket.com/');
define('PROJECT_THEME',				'theme_dark');
define('ENCRYPTION_KEY',			'786$&GH&%!@');
/*define('BASE_CURRENCY_ICON',		'$');
define('BASE_CURRENCY',				'USD');
define('BASE_CURRENCY_CODE',		'USD');*/

define('BASE_CURRENCY_CODE',		'INR');
define('BASE_CURRENCY_ICON',		'INR');
define('BASE_CURRENCY',				'INR');

// define('SSL_TLL',					'http://');
// define('ASSETS',					SSL_TLL.$_SERVER['HTTP_HOST'].'/tripglob/assets/'.PROJECT_THEME.'/');
// define('BASE_URL',					SSL_TLL.$_SERVER['HTTP_HOST'].'/tripglob/'); 
// define('ADMIN_ASSETS',				SSL_TLL.$_SERVER['HTTP_HOST'].'/admin-panel/assets/');
// define('WEB_URL',					SSL_TLL.$_SERVER['HTTP_HOST'].'/tripglob/');
// define('UPLOAD_PATH',				SSL_TLL.$_SERVER['HTTP_HOST'].'/tripglob/photo/');
// define('IMG_URL',					SSL_TLL.$_SERVER['HTTP_HOST'].'/tripglob/admin-panel/uploads/');
// define('FRONT_UPLOAD',				SSL_TLL.$_SERVER['HTTP_HOST'].'/tripglob/application/uploads/');

define('ASSETS',					$base_url.'/assets/'.PROJECT_THEME.'/');
define('BASE_URL',					$base_url.'/'); 
define('ADMIN_ASSETS',				$base_url.'/admin-panel/assets/');
define('WEB_URL',					$base_url.'/');
define('UPLOAD_PATH',				$base_url.'/photo/');
define('IMG_URL',					$base_url.'/admin-panel/uploads/');
define('FRONT_UPLOAD',				$base_url.'/application/uploads/');

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
define('FRONT_URL','/home/tripglobo/public_html/');

define ( 'PROJECT_PATH', '/home/tripglobo/public_html' );
define('ticket_date1',Date('dmy', strtotime("+360 days")));
