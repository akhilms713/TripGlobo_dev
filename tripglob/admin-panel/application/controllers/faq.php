<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
//error_reporting(0);
class Faq extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->check_isvalidated();	
		$this->load->model('general_model');		
		$this->load->model('Banner_Model');
		$this->load->model('faq_model');
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
	
	function show(){
		$data['kb'] = $this->faq_model->get_row_list();
		$this->load->view('faq/show', $data);
	}

	function add($id=''){
		$data = array();
		if($_POST)
		{
			$this->faq_model->add_row($_POST);
			$data['msg'] = "Details Added Successfuly.";
		}
		$this->load->view('faq/add',$data);
	}

	function update($id=''){
		$data = array();
		if($_POST)
		{
			$this->faq_model->update_row($id, $_POST);
			$data['msg'] = "Successfuly Updated.";
				// echo '<script type="text/javascript">';
    //         echo ' alert("Updated successfully.")';  //not showing an alert box.
    //         echo '</script>';
		//		redirect(WEB_URL.'faq/show/1','refresh');

		}
		$data['kb'] = $this->faq_model->get_row_single($id);
		$this->load->view('faq/update',$data);
	}

	function delete($id=''){
		$this->faq_model->delete_row($id);
		$data['msg'] = "Successfuly Updated.";
		redirect(WEB_URL.'faq/show','refresh');
	}

	public function change_status() 
	 {
		$id = $_GET['id'];
		$status = $_GET['status'];

		
        if($this->faq_model->do_change_status($id, $status))
		{
			$response = array('status' => 1);
        	echo json_encode($response);
		}
		else
		{
			$response = array('status' => 0);
        	echo json_encode($response);
		}
    }
	
	
}
