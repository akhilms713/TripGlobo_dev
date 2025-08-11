<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function booking_status_label($status)
{
	switch ($status) {
		
		case 'FAILED': $status_label = 'label label-info';
		break;
		case 'HOLD' :$status_label = 'label label-info';
		break;
		case 'CANCEL_HOLD':$status_label = 'label label-warning';
		break;
		case 'CONFIRMED': $status_label = 'label label-success';
		break;		
		case 'CANCELED': $status_label = 'label label-danger';
		break;
		default : $status_label = 'label label-primary';
	}
	return $status_label;
}
// function debug($arr=array()){
// 	echo "<pre>";
// 	print_r($arr);
// }