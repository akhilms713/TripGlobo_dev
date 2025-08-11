<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Error extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	 public function page_missing($str=''){
		$data['error_msg'] = "page not found!";
        $this->load->view(PROJECT_THEME.'/errors/booking_error',$data);
    }
     public function booking_failure($str=''){
		if($str!=''){
			$data['error_msg'] = base64_decode($str);
		}else{
			$data['error_msg'] = "Booking Failure try again after some time!!!!";
		}
        $this->load->view(PROJECT_THEME.'/errors/booking_error',$data);
    }
    public function hotel($str=''){
		if($str!=''){
			$data['error_msg'] = base64_decode($str);
		}else{
			$data['error_msg'] = "Failure try again after some time!!!!";
		}
        $this->load->view(PROJECT_THEME.'/errors/booking_error',$data);
	}
	public function payment($str=''){
		if($str!=''){
			$data['error_msg'] = base64_decode($str);
		}else{
			$data['error_msg'] = "Failure try again after some time!!!!";
		}
        $this->load->view(PROJECT_THEME.'/errors/booking_error',$data);
	}
	    public function no_result($str=''){
		if($str!=''){
			$data['error_msg'] = base64_decode($str);
		}else{
			$data['error_msg'] = "No Result found, try again new search..!!!!";
		}
        $this->load->view(PROJECT_THEME.'/errors/no_result',$data);
    }
}
















?>
