<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
class Header extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('admin_model');
		$this->load->model('Header_Model');
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
/*	 
	function index(){
		//$header 				= $this->General_Model->get_home_page_settings();
		$header['header_list'] 	= $this->Header_Model->get_header_list();
		$header['logo_list'] 	= $this->Header_Model->get_logo_list();
		$this->load->view('header/header_list',$header);
	}
	*/
	
	function header_list(){
		//$header 				= $this->General_Model->get_home_page_settings();
		$header['header_list'] 	= $this->Header_Model->get_header_list();
		$header['logo_list'] 	= $this->Header_Model->get_logo_list();
		$this->load->view('header/header_list',$header);
	}
	

	function add_header()
	{
	$this->load->view('header/add_new');
	}
	function add_header_do(){
		if(count($_POST) > 0){
			$this->form_validation->set_rules('menu_name','Header Menu Name','required');
			$this->form_validation->set_rules('position','Menu Position','required');
			if($this->form_validation->run()==TRUE){
				$this->Header_Model->add_header_details($_POST);
				redirect('header/header_list','refresh');
			} else {				
				$this->load->view('header/add_new');
			}
		}else{			
			$this->load->view('header/add_new');
		}
	}
	
	function active_header($header_id){
		$header_id = json_decode(base64_decode($header_id));
		if($header_id != ''){
			$this->Header_Model->active_header($header_id);
		}
		redirect('header/header_list','refresh');
	}
	
	function inactive_header($header_id){
		$header_id = json_decode(base64_decode($header_id));
		if($header_id != ''){
			$this->Header_Model->inactive_header($header_id);
		}
		redirect('header/header_list','refresh');
	}
	
	function delete_header($header_id){
		$header_id = json_decode(base64_decode($header_id));
		if($header_id != ''){
			$this->Header_Model->delete_header($header_id);
		}
		redirect('header/header_list','refresh');
	}
	
	function edit_header($header_id){
		$header_id =  json_decode(base64_decode($header_id));
		if($header_id != ''){
			//$header 					= $this->General_Model->get_home_page_settings();
			$header['header_list'] 		= $this->Header_Model->get_header_list($header_id);
			$this->load->view('header/edit_header',$header);
		} else {
			redirect('header/header_list','refresh');
		}
	}

	function update_header($header_id1){
		if(count($_POST) > 0){
			$header_id = json_decode(base64_decode($header_id1));
			if($header_id != ''){
				$this->form_validation->set_rules('menu_name','Header Menu Name','required');
				$this->form_validation->set_rules('position','Menu Position','required');
				if($this->form_validation->run()==TRUE){	
					$this->Header_Model->update_header_details($_POST,$header_id);
				} else {
					redirect('header/edit_header/'.$header_id,'refresh');
				}
			}
			redirect('header/header_list','refresh');
		}else if($header_id!=''){
			redirect('header/edit_header/'.$header_id,'refresh');
		}else{
			redirect('header/header_list','refresh');
		}
	}

	function add_logo(){
		if(count($_POST) > 0){
			$site_logo_name = '';
			if(!empty($_FILES['site_logo']['name'])){	
				if(is_uploaded_file($_FILES['site_logo']['tmp_name'])) {
					$allowed =  array('gif','png' ,'jpg', 'jpeg');
					$sourcePath = $_FILES['site_logo']['tmp_name'];
					$filename = $_FILES['site_logo']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					if(in_array($ext,$allowed) ) {
						$img_Name=time().$_FILES['site_logo']['name'];
						$targetPath = "uploads/logo/".$img_Name;
						if(move_uploaded_file($sourcePath,$targetPath)){
							$site_logo_name = $img_Name;
						}
					}
				}				
			}
			$this->Header_Model->add_logo_details($_POST,$site_logo_name);
			redirect('header/header_list','refresh');
		}else{
			$header = $this->General_Model->get_home_page_settings();
			$this->load->view('header/logo/add_logo',$header);
		}
	}

	function active_logo($logo_id){
		$logo_id = json_decode(base64_decode($logo_id));
		if($logo_id != ''){
			$this->Header_Model->active_logo($logo_id);
		}
		redirect('header/header_list','refresh');
	}
	
	function inactive_logo($logo_id){
		$logo_id = json_decode(base64_decode($logo_id));
		if($logo_id != ''){
			$this->Header_Model->inactive_logo($logo_id);
		}
		redirect('header/header_list','refresh');
	}
	
	function delete_logo($logo_id){
		$logo_id = json_decode(base64_decode($logo_id));
		if($logo_id != ''){
			$this->Header_Model->delete_logo($logo_id);
		}
		redirect('header/header_list','refresh');
	}
	
	function edit_logo($logo_id){
		$logo_id = json_decode(base64_decode($logo_id));
		if($logo_id != ''){
			$header 					= $this->General_Model->get_home_page_settings();
			$header['logo_list'] 		= $this->Header_Model->get_logo_list($logo_id);
			$this->load->view('header/logo/edit_logo',$header);
		} else {
			redirect('header/header_list','refresh');
		}
	}

	function update_logo($logo_id){
		if(count($_POST) > 0){
			$logo_id = json_decode(base64_decode($logo_id));
			if($logo_id != ''){
				$site_logo_name  = $_REQUEST['site_logo_old'];
				if(!empty($_FILES['site_logo']['name'])){	
					if(is_uploaded_file($_FILES['site_logo']['tmp_name'])) {
						$allowed =  array('gif','png' ,'jpg', 'jpeg');
						$oldImage = "uploads/logo/".$site_logo_name;
						unlink($oldImage);
						$sourcePath = $_FILES['site_logo']['tmp_name'];
						$filename = $_FILES['site_logo']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(in_array($ext,$allowed) ) {
							$img_Name=time().$_FILES['site_logo']['name'];
							$targetPath = "uploads/logo/".$img_Name;
							if(move_uploaded_file($sourcePath,$targetPath)){
								$site_logo_name = $img_Name;
							}
						}
					}				
				}
				$this->Header_Model->update_logo_details($_POST,$logo_id,$site_logo_name);
			} 
			redirect('header/header_list','refresh');
		}else if($header_id!=''){
			redirect('header/edit_header/'.$header_id,'refresh');
		}else{
			redirect('header/header_list','refresh');
		}
	}

	function view_menu_details($header_id, $menu_level){
		$menu['header_id'] 			= $header_id;
		$menu['menu_level'] 		= $menu_level;
		$menu['header_list'] 		= $this->Header_Model->get_header_list($header_id);
		$menu['header_menu_list'] 	= $this->Header_Model->get_header_menu_list($header_id);
		$menu_details 				= $this->load->view('header/menu/menu_list',$menu);
	}
	
	function add_header_menu($menu_level){
		if(count($_POST) > 0){
			$this->Header_Model->add_header_menu_details($_POST,$menu_level);
			redirect('header/header_list','refresh');
		}else{
			$header 				= $this->General_Model->get_home_page_settings();
			$header['header_list'] 	= $this->Header_Model->get_header_list();
			$header['menu_level'] 	= $menu_level;
			$this->load->view('header/menu/add_menu',$header);
		}
	}

	function active_header_menu($header_menu_id){
		$header_menu_id = json_decode(base64_decode($header_menu_id));
		if($header_menu_id != ''){
			$this->Header_Model->active_header_menu($header_menu_id);
		}
		redirect('header/header_list','refresh');
	}
	
	function inactive_header_menu($header_menu_id){
		$header_menu_id = json_decode(base64_decode($header_menu_id));
		if($header_menu_id != ''){
			$this->Header_Model->inactive_header_menu($header_menu_id);
		}
		redirect('header/header_list','refresh');
	}
	
	function delete_header_menu($header_menu_id){
		$header_menu_id = json_decode(base64_decode($header_menu_id));
		if($header_menu_id != ''){
			$this->Header_Model->delete_header_menu($header_menu_id);
		}
		redirect('header/header_list','refresh');
	}
	
	function edit_header_menu($header_id, $header_menu_id){
		$header_id = json_decode(base64_decode($header_id));
		$header_menu_id = json_decode(base64_decode($header_menu_id));
		if($header_id != '' && $header_menu_id != ''){
			$header 					= $this->General_Model->get_home_page_settings();
			$header['header_menu_list'] = $this->Header_Model->get_header_menu_list($header_id,$header_menu_id);
			$header['header_list'] 		= $this->Header_Model->get_header_list();
			$this->load->view('header/menu/edit_menu',$header);
		} else {
			redirect('header/header_list','refresh');
		}
	}

	function update_header_menu($header_menu_id){
		if(count($_POST) > 0){
			$header_menu_id = json_decode(base64_decode($header_menu_id));
			if($header_menu_id != ''){
				$this->Header_Model->update_header_menu_details($_POST,$header_menu_id);
			}
			redirect('header/header_list','refresh');
		}else if($header_id!=''){
			redirect('header/edit_header/'.$header_id,'refresh');
		}else{
			redirect('header/header_list','refresh');
		}
	}
	
	function search_header_menu_list(){
		$search_header 							= $this->General_Model->get_home_page_settings();
		$search_header['search_header_list'] 	= $this->Header_Model->get_search_header_list();
		$this->load->view('search_header/header_menu_list',$search_header);
	}
	
	function add_search_header_menu(){
		if(count($_POST) > 0){
			$this->Header_Model->add_search_header_details($_POST);
			redirect('header/search_header_menu_list','refresh');
		}else{
			$search_header = $this->General_Model->get_home_page_settings();
			$this->load->view('search_header/add_header',$search_header);
		}
	}
	
	function inactive_search_header($search_header_id){
		$search_header_id = json_decode(base64_decode($search_header_id));
		if($search_header_id != ''){
			$this->Header_Model->inactive_search_header($search_header_id);
		}
		redirect('header/search_header_menu_list','refresh');
	}
	
	function active_search_header($search_header_id){
		$search_header_id = json_decode(base64_decode($search_header_id));
		if($search_header_id != ''){
			$this->Header_Model->active_search_header($search_header_id);
		}
		redirect('header/search_header_menu_list','refresh');
	}
	
	function edit_search_header($search_header_id){
		$search_header_id = json_decode(base64_decode($search_header_id));
		if($search_header_id != ''){
			$search_header 							= $this->General_Model->get_home_page_settings();
			$search_header['search_header_list'] 	= $this->Header_Model->get_search_header_list($search_header_id);
			$this->load->view('search_header/edit_header',$search_header);
		} else {
			redirect('header/search_header_menu_list','refresh');
		}
	}
	
	function update_search_header($search_header_id){
		if(count($_POST) > 0){
			$search_header_id = json_decode(base64_decode($search_header_id));
			if($search_header_id != ''){
				$this->Header_Model->update_search_header_details($_POST,$search_header_id);
			}
			redirect('header/search_header_menu_list','refresh');
		}else if($search_header_id!=''){
			redirect('header/edit_search_header/'.$search_header_id,'refresh');
		}else{
			redirect('header/search_header_menu_list','refresh');
		}
	}
	
	function delete_search_header($search_header_id){
		$search_header_id = json_decode(base64_decode($search_header_id));
		if($search_header_id != ''){
			$this->Header_Model->delete_search_header($search_header_id);
		}
		redirect('header/search_header_menu_list','refresh');
	}
	
	
}
