<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
error_reporting(0);
class Sponsor_Ad extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->check_isvalidated();	
		$this->load->model('general_model');		
		$this->load->model('sponsor_ad_model');
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
		$data['ad'] = $this->sponsor_ad_model->get_ad_list()->result();
		$this->load->view('sponsor_ad/show', $data);
	}

	function add(){
		$data = array();
		if($_POST)
		{
			if(!empty($_FILES['ad_image']['name'])){	
				if(is_uploaded_file($_FILES['ad_image']['tmp_name'])) {
					$allowed =  array('gif','png' ,'jpg', 'jpeg');
					$sourcePath = $_FILES['ad_image']['tmp_name'];
					$filename = $_FILES['ad_image']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					if(in_array($ext,$allowed) ) {
						$img_Name=time().$_FILES['ad_image']['name'];
						$targetPath = "uploads/sponsor_ad/".$img_Name;

						if($this->compressImage($sourcePath,$targetPath,60)){
							$ad_logo = $img_Name;
						}
					}
				}				
			}

			$this->sponsor_ad_model->add_ad($_POST,$ad_logo);
			$data['msg'] = "Details Added Successfuly.";
		}
		$this->load->view('sponsor_ad/add',$data);
	}

	function update($ad_id=''){
		if($_POST)
		{
			if(!empty($_FILES['ad_image']['name'])){	
				if(is_uploaded_file($_FILES['ad_image']['tmp_name'])) {
					$allowed =  array('gif','png' ,'jpg', 'jpeg');
					$sourcePath = $_FILES['ad_image']['tmp_name'];
					$filename = $_FILES['ad_image']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					if(in_array($ext,$allowed) ) {
						$img_Name=time().$_FILES['ad_image']['name'];
						$targetPath = "uploads/sponsor_ad/".$img_Name;

						if($this->compressImage($sourcePath,$targetPath,60)){
							$ad_logo = $img_Name;
						}
					}
				}				
			}

			$this->sponsor_ad_model->update_ad($_POST,$ad_logo,$ad_id);
			$data['msg'] = "Successfuly Updated.";
		}
		$data['ad'] = $this->sponsor_ad_model->get_ad_list($ad_id)->row();
		$this->load->view('sponsor_ad/update',$data);
	}

	function delete($ad_id=''){
		$this->sponsor_ad_model->delete_ad($ad_id);
		$data['msg'] = "Successfuly Updated.";
		redirect(WEB_URL.'sponsor_ad/show','refresh');
	}

	public function change_status() 
	 {
		$id = $_GET['id'];
		$status = $_GET['status'];

		
        if($this->sponsor_ad_model->status_ad($id, $status))
		{
			$response = array('advertise_status' => 1);
        	echo json_encode($response);
		}
		else
		{
			$response = array('advertise_status' => 0);
        	echo json_encode($response);
		}
    }
	
	
}
