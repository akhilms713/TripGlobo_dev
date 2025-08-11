<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	  public function dashboard(){
		 echo $this->user_mode;exit;
        $this->load->view('dashboard/dashboard');
    }
    public function feedback_data(){
    $data['feedback_data'] =$feedback_data=$this->general_model->feedback_list()->result();
      $this->load->view('dashboard/feedback_list',$data);
  }
}
















?>
