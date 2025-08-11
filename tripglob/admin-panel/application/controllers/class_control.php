<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Class_Control extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->check_isvalidated();	
		$this->load->model('general_model');		
		$this->load->model('class_control_model');
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
		$data['cc'] = $this->class_control_model->get_list()->result();
		$this->load->view('class_control/show', $data);
	}

	function add(){
		$data = array();
		if($_POST)
		{
			$this->class_control_model->add($_POST);
			$data['msg'] = "Details Added Successfuly.";
		}
		$this->load->view('class_control/add',$data);
	}

	function update($id=''){
		if($_POST)
		{
			$this->class_control_model->update_ad($_POST,$id);
			$data['msg'] = "Successfuly Updated.";
		}
		$data['cc'] = $this->class_control_model->get_list($id)->row();
		$this->load->view('class_control/update',$data);
	}

	function delete($ad_id=''){
		$this->class_control_model->delete_ad($ad_id);
		$data['msg'] = "Successfuly Updated.";
		redirect(WEB_URL.'class_control/show','refresh');
	}

	public function change_status() 
	 {
		$id = $_GET['id'];
		$status = $_GET['status'];

		
        if($this->class_control_model->status_ad($id, $status))
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
