<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = "home";

$route['home/(:any)'] = "home/index/$1";
$route['booking/signup_login'] = "booking/signup_login";
$route['booking/payment_payumoney/(:any)'] = "booking/payment_payumoney/$1";
$route['booking/checkout'] = "booking/checkout";
$route['booking/book'] = "booking/book";
$route['booking/promo'] = "booking/promo";
$route['booking/payment_response'] = "booking/payment_response";
$route['booking/payment_cancel'] = "booking/payment_cancel";
$route['booking/book/(:any)'] = "booking/book/$1";
$route['booking/voucher/(:any)'] = "booking/voucher/$1";
$route['booking/do_payment/(:any)'] = "booking/do_payment/$1";
$route['booking/payment_response/(:any)'] = "booking/payment_response/$1";
$route['booking/confirm'] = "booking/confirm";
$route['booking/flight_availability/(:any)'] = "booking/flight_availability/$1";
$route['booking/flight_availability1/(:any)'] = "booking/flight_availability1/$1";
$route['booking/payumoney_payment_response/(:any)'] = "booking/payumoney_payment_response/$1";
$route['booking/confirm/(:any)'] = "booking/confirm/$1";
$route['booking/booking_travellers'] = "booking/booking_travellers";
$route['booking/booking_travellers/(:any)'] = "booking/booking_travellers/$1";
$route['voucher/(:any)'] = "booking/voucher/$1";
$route['invoice/(:any)'] = "booking/invoice/$1";
$route['booking/(:any)'] = "booking/index/$1";
$route['Flights'] = "home/inner_header/Flights";
// $route['404_override'] ='error/page_missing';

$host="localhost"; 
$db_user="root";
$db_password="";
$db="tripglobo_main";

/*$db_user="root";
$db_password='';
$db="tripgolobo";*/



$conn = @mysql_connect($host,$db_user,$db_password) or die (mysql_error());
//print_r($conn); die;
mysql_select_db($db) or die (mysql_error());
$sql = "SELECT * FROM static_pages";
$query = mysql_query($sql,$conn);
if($query === FALSE) {
    echo "afdsafdsf";
    die("dfasdf"); // TODO: better error handling
}

while($row = mysql_fetch_array($query, MYSQL_ASSOC))
{	
	$title			=	trim(str_replace(" ","-",$row['slug']));
	$page_id		=	$row['id'];
	$route[$title] 	= 	'general/page/'.$title;
}