<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Currency{
	function __construct(){
       $display_currency;
       $display_icon;
       $curr_val;
    }
    function initializeData() {
    	$ci =& get_instance();
        if($ci->input->cookie('currency')){
            $ci->display_currency = $ci->input->cookie('currency');
            $ci->display_icon = $ci->input->cookie('icon');
        }else{
        	$cookie = array(
			    'name'   => 'currency',
			    'value'  => BASE_CURRENCY,
			    'expire' => '86500'
			);
            $ci->input->set_cookie($cookie);
            $cookie = array(
                'name'   => 'icon',
                'value'  => BASE_CURRENCY_ICON,
                'expire' => '86500'
            );
            $ci->input->set_cookie($cookie);
            /*$ci->display_currency = 'USD';
            $ci->display_icon = '$';*/
            $ci->display_currency = BASE_CURRENCY;
            $ci->display_icon = BASE_CURRENCY_ICON;
        }
       // $ci->curr_val = $ci->general_model->get_currency_value($ci->display_currency);
        $ci->curr_val = 1;
        $ci->curr_val_flag = $ci->general_model->get_currency_value_flag($ci->display_currency);
    }
}