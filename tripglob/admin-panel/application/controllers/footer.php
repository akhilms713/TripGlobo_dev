<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Footer extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('admin_model');		
    	$this->load->model('Footer_Model');
		//$this->load->model('General_Model');
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



	 
	function footer_list(){
		
		$footer['footer_list'] 	= $this->Footer_Model->get_footer_list();
		$this->load->view('footer/footer_list',$footer);
	}
	
    function add_footer()
	{
	$this->load->view('footer/add_footer');
	}


	function add_footer_do(){
		if(count($_POST) > 0){
			$this->form_validation->set_rules('footer_name','Footer Name','required');
			$this->form_validation->set_rules('position','Position','required');
			if($this->form_validation->run()==TRUE){
				$this->Footer_Model->add_footer_details($_POST);
				redirect('footer/footer_list','refresh');
			} else {
				
				$this->load->view('footer/add_footer',$footer);
			}
		}else{
			
			$this->load->view('footer/add_footer',$footer);
		}
	}
	
	function active_footer($footer_id){
	$footer_id = json_decode(base64_decode($footer_id));			
		if($footer_id != ''){			
			$this->Footer_Model->active_footer($footer_id);
		}
		redirect('footer/footer_list','refresh');
	}
	
	function inactive_footer($footer_id){
		$footer_id = json_decode(base64_decode($footer_id));
		if($footer_id != ''){
			$this->Footer_Model->inactive_footer($footer_id);
		}
		redirect('footer/footer_list','refresh');
	}
	
	function delete_footer($footer_id){
		$footer_id = json_decode(base64_decode($footer_id));
		if($footer_id != ''){
			$this->Footer_Model->delete_footer($footer_id);
		}
		redirect('footer/footer_list','refresh');
	}
	
	function edit_footer($footer_id)
	{
		$footer_id = json_decode(base64_decode($footer_id));
		if($footer_id != ''){
			$footer['footer_list'] = $this->Footer_Model->get_footer_list($footer_id);
			$this->load->view('footer/edit_footer',$footer);
		} else {
			redirect('footer/footer_list','refresh');
		}
	}

	function update_footer($footer_id1){

		if(count($_POST) > 0){
			$footer_id = json_decode(base64_decode($footer_id1));
			if($footer_id != ''){
				//$this->form_validation->set_rules('footer_name','Footer Name','required');
				$this->form_validation->set_rules('position','Position','required');
				if($this->form_validation->run()==TRUE){					
					$this->Footer_Model->update_footer($_POST,$footer_id);
				} else {
					redirect('footer/edit_footer/'.$footer_id1,'refresh');
				}
			} 
			redirect('footer/footer_list','refresh');
		}else if($footer_id!=''){
			redirect('footer/footer_list','refresh');
		}else{
			redirect('footer/footer_list','refresh');
		}
	}
	
	function view_footer_data(){
		$footer['footer_list'] 	= $this->Footer_Model->get_footerData_list();
		$this->load->view('footer/view_footer_data',$footer);
	}
	
	function add_footer_data()
	{
	  $this->load->view('footer/add_footer_data');
	}
	
	function add_footer_data_do(){
		if(count($_POST) > 0){
			$this->form_validation->set_rules('footer_name','Footer Name','required');
			$this->form_validation->set_rules('position','Position','required');
			if($this->form_validation->run()==TRUE){
				$this->Footer_Model->add_footerData_details($_POST);
				redirect('footer/view_footer_data','refresh');
			} else {
				
				$this->load->view('footer/add_footer_data',$footer);
			}
		}else{
			
			$this->load->view('footer/add_footer_data',$footer);
		}
	}
	
	function active_footer_data($footer_id){
	$footer_id = json_decode(base64_decode($footer_id));			
		if($footer_id != ''){			
			$this->Footer_Model->active_footer_data($footer_id);
		}
		redirect('footer/view_footer_data','refresh');
	}
	
	function inactive_footer_data($footer_id){
		$footer_id = json_decode(base64_decode($footer_id));
		if($footer_id != ''){
			$this->Footer_Model->inactive_footer_data($footer_id);
		}
		redirect('footer/view_footer_data','refresh');
	}
	
	function delete_footer_data($footer_id){
		$footer_id = json_decode(base64_decode($footer_id));
		if($footer_id != ''){
			$this->Footer_Model->delete_footer_data($footer_id);
		}
		redirect('footer/view_footer_data','refresh');
	}
	
	function edit_footer_data($footer_id)
	{
		$footer_id = json_decode(base64_decode($footer_id));
		if($footer_id != ''){
			$footer['footer_list'] = $this->Footer_Model->get_footerData_list($footer_id);
			$this->load->view('footer/edit_footer_data',$footer);
		} else {
			redirect('footer/view_footer_data','refresh');
		}
	}

	function update_footer_data($footer_id1){

		if(count($_POST) > 0){
			$footer_id = json_decode(base64_decode($footer_id1));
			if($footer_id != ''){
				//$this->form_validation->set_rules('footer_name','Footer Name','required');
				$this->form_validation->set_rules('position','Position','required');
				if($this->form_validation->run()==TRUE){					
					$this->Footer_Model->update_footer_data($_POST,$footer_id);
				} else {
					redirect('footer/edit_footer_data/'.$footer_id1,'refresh');
				}
			} 
			redirect('footer/view_footer_data','refresh');
		}else if($footer_id!=''){
			redirect('footer/view_footer_data','refresh');
		}else{
			redirect('footer/view_footer_data','refresh');
		}
	}
}
