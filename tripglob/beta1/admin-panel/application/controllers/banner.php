<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
error_reporting(0);
class Banner extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('general_model');		
		$this->load->model('Banner_Model');
		$this->check_isvalidated();	
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
           // echo $sub_admin_id;exit();
           if(!$this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id,$controller_name,$function_name))
		   {	
		       exit("raj");
    	 	  	access_denied('error');
			}
			
       	 }
		 else
       	 {
       	 	redirect('login','refresh');
       	 }
		}
		
    }
	 
	function banner_list(){
		$banner 				= $this->general_model->get_home_page_settings();
		$banner['banner_list'] 	= $this->Banner_Model->get_banner_list();
			//print_r($banner); exit;
		$this->load->view('banner/banner_list',$banner);
	}
	
	function add_banner(){
		if(count($_POST) > 0){
			$banner_logo_name = '';
			if(!empty($_FILES['banner_logo']['name']))
			{	
				if(is_uploaded_file($_FILES['banner_logo']['tmp_name'])) 
				{
					$sourcePath = $_FILES['banner_logo']['tmp_name'];
					$img_Name=time().$_FILES['banner_logo']['name'];
					$targetPath = "uploads/banner/".$img_Name;
					if(move_uploaded_file($sourcePath,$targetPath)){
						$banner_logo_name = $img_Name;
					}
				}				
			}
			$this->Banner_Model->add_banner_details($_POST,$banner_logo_name);//not showing an alert box.
			echo '<script type="text/javascript">
              alert("Banner Image added successfully.");
              window.location.href="banner_list";  
             </script>';
			//redirect('banner/banner_list','refresh');
		}else{
			$banner = $this->general_model->get_home_page_settings();
			
		
			$this->load->view('banner/add_banner',$banner);
		}
	}
	
	function active_banner($banner_id){
		
		$banner_id = json_decode(base64_decode($banner_id));
		$this->Banner_Model->active_banner($banner_id);
		redirect('banner/banner_list','refresh');
	}
	
	function inactive_banner($banner_id){
		
		$banner_id = json_decode(base64_decode($banner_id));
		$this->Banner_Model->inactive_banner($banner_id);
		redirect('banner/banner_list','refresh');
	}
	
	function delete_banner($banner_id){
		
		$banner_id = json_decode(base64_decode($banner_id));
		$this->Banner_Model->delete_banner($banner_id);
		
		redirect('banner/banner_list','refresh');
	}
	
	function edit_banner($banner_id)
	{
		$banner_id = json_decode(base64_decode($banner_id));
		$banner 				= $this->general_model->get_home_page_settings();
		$banner['banner_list'] 	= $this->Banner_Model->get_banner_list($banner_id);
		
		//print_r($banner); exit;
		$this->load->view('banner/edit_banner',$banner);
	}

	function update_banner($banner_id)
	{
		
		//$banner_id = json_decode(base64_decode($banner_id));
		if(count($_POST) > 0){
			$banner_logo_name  = $_REQUEST['banner_logo_old'];
			if(!empty($_FILES['banner_logo']['name']))
			{	
				if(is_uploaded_file($_FILES['banner_logo']['tmp_name'])) 
				{
					$oldImage = "uploads/banner/".$banner_logo_name;
					unlink($oldImage);
					$sourcePath = $_FILES['banner_logo']['tmp_name'];
					$img_Name=time().$_FILES['banner_logo']['name'];
					$targetPath = "uploads/banner/".$img_Name;
					if(move_uploaded_file($sourcePath,$targetPath)){
						$banner_logo_name = $img_Name;
					}
				}				
			}
			
	/*		echo"<pre/>";print_r($_POST);
			echo"<pre/>";print_r($_FILES['banner_logo']['name']);
			echo"<pre/>";print_r($banner_logo_name);
			echo"<pre/>";print_r($banner_id);
			exit;
  */                      
			$this->Banner_Model->update_banner($_POST,$banner_id, $banner_logo_name);
			redirect('banner/banner_list','refresh');
		}else if($banner_id!=''){
			redirect('banner/banner_list','refresh');
		}else{
			redirect('banner/banner_list','refresh');
		}
	}
	function home_management_list(){
		$home_mgmt= $this->general_model->get_home_page_settings();
		$home_mgmt['list'] 	= $this->Banner_Model->get_home_management_list();
		$this->load->view('home_management/list',$home_mgmt);
	}
	function active_home_mgmt_list($id){
		
		$id = json_decode(base64_decode($id));
		$this->Banner_Model->update_home_mgmt_status($id,'ACTIVE');
		redirect('banner/home_management_list','refresh');
	}
	
	function inactive_home_mgmt_list($id){
		
		$id = json_decode(base64_decode($id));
		$this->Banner_Model->update_home_mgmt_status($id,'INACTIVE');
		redirect('banner/home_management_list','refresh');
	}
}
