<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Requests extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('admin_model');
		$this->load->model('request_model');
		$this->load->model('xmllog_model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		$this->load->library('form_validation');
	}
	private function check_isvalidated()
	{
		if(!$this->session->userdata('admin_logged_in') || $this->session->userdata('admin_id')!= ADMIN_ID )
		{
			if ($this->session->userdata('admin_logged_in')) {
		 	$controller_name = $this->router->fetch_class();
			 $function_name = $this->router->fetch_method();
             $this->load->model('Privilege_Model');
            $sub_admin_id = $this->session->userdata('admin_id');
           if(!$this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id,$controller_name,$function_name))
		   {			
    	 	  	access_denied('error');
			}
			
       	 }
		 else
       	 {
       	 	redirect('login','refresh');
       	 }
		}
		
    }
    
    
    public function get_advertise_list(){
        
        $data['advertise_data']	=	$this->request_model->get_advertise_list();
        //echo '<pre>';print_r($data['advertise_data']);exit('nidhi');
		$this->load->view('requests/advertise_view', $data);
       
    }
    
    public function get_feedback_list(){
        $data['feedback_data']	=	$this->request_model->get_feedback_list();
        //echo '<pre>';print_r($data['feedback_data']);exit('nidhi');
		$this->load->view('requests/feedback_view', $data);
    }
    
    public function get_workwithus_list(){
        $data['work_data']	=	$this->request_model->get_workwithus_list();
		$this->load->view('requests/workwithus_view', $data);
    }
	
}

?>
