<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Airline_management extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Airline_Manag_Model');
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
	 
	function index($page){
	    $this->load->library("pagination");
	      $search_text = "";
            if($this->input->post('submit') != NULL ){
              $search_text = $this->input->post('search');
              $this->session->set_userdata(array("search"=>$search_text));
            }
            
	    $config = array();
        $config["base_url"] = base_url() . "airline_management/index/";
        $config["total_rows"] = $this->Airline_Manag_Model->get_airline_list_row($search_text);
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['full_tag_open'] = '<ul class="pagination pull-right" style="margin-top: -20px;">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');
        
        
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $airline["links"] = $this->pagination->create_links();
		$airline['airline_list'] 	= $this->Airline_Manag_Model->get_airline_list($config["per_page"], $page,$search_text);
		$airline['total_rows']=$config["total_rows"];
		$this->load->view('airline_manage/view',$airline);
	}
	function air_list(){
		$airline['airline_list'] 	= $this->Airline_Manag_Model->get_airline_list_new();
		// echo "<pre/>";print_r($airline);exit;
		$this->load->view('airline_manage/airline_list',$airline);
	}

	function add_airline(){

		if(count($_POST) > 0){

			$airline_logo_name = '';
			//$this->form_validation->set_rules('airline_name', 'Airline Name', 'required');
			//$this->form_validation->set_rules('airline_code', 'Airline Code', 'required');
			// $this->form_validation->set_rules('provider_type', 'Provider Type', 'required');

			//if ($this->form_validation->run() == TRUE){
				if(!empty($_FILES['airline_logo']['name'])){	
					if(is_uploaded_file($_FILES['airline_logo']['tmp_name'])) {
						$allowed =  array('gif','png' ,'jpg', 'jpeg');
						$sourcePath = $_FILES['airline_logo']['tmp_name'];
						$filename = $_FILES['airline_logo']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(in_array($ext,$allowed) ) {
							$img_Name=time().$_FILES['airline_logo']['name'];
							$targetPath = "uploads/airline/".$img_Name;
							// if(move_uploaded_file($sourcePath,$targetPath)){
							// 	$airline_logo_name = $img_Name;
							// }

							if($this->compressImage($sourcePath,$targetPath,60)){
								$airline_logo_name = $img_Name;
							}
						}
					}				
				}

				$this->Airline_Manag_Model->add_airline_details($_POST,$airline_logo_name);
				redirect('airline_management','refresh');
			// } else {
			// 	$airline = $this->General_Model->get_home_page_settings();
			// 	$this->load->view('airline_manage/add_airline_manage',$airline);
			// }
		}else{
			$airline = $this->General_Model->get_home_page_settings();
			$this->load->view('airline_manage/add_airline_manage',$airline);
		}
	}
	function check_airlinecode(){
		// echo "<pre/>";print_r($_POST);exit;
		$air_code = $_POST['air_code'];
	$status = 	$this->Airline_Manag_Model->check_airlinecode($air_code);
	 // echo "<pre/>";print_r($status);exit;
	echo  json_encode($status);exit;
	}
	
	
	public function update_airline_status() 
	 {
		$id = $_GET['id'];
		$status = $_GET['status'];

		
        if($this->Airline_Manag_Model->update_airline_status1($id, $status))
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
	
	function delete_airline($airline_id){
		//$airline_id = json_decode(base64_decode($airline_id));
		if($airline_id != ''){
			$this->Airline_Manag_Model->delete_airline($airline_id);
		}
		redirect('airline_management','refresh');
	}
	
	function edit_airline($airline_id){
		// echo $airline_id;exit;
		if($airline_id != ''){
			//$airline 					= $this->General_Model->get_home_page_settings();
			$airline['airline_list'] 	= $this->Airline_Manag_Model->get_airline_list_single($airline_id);
			//echo "<pre/>";print_r($airline);exit;
			$this->load->view('airline_manage/edit_airline_manage',$airline);
		} else {
			redirect('airline_management','refresh');
		}
	}

	function update_airline($airline_id){
		// echo "<pre/>";print_r($_POST);die;
		if(count($_POST) > 0){
			//$airline_id = json_decode(base64_decode($airline_id));
			 //echo $airline_id;exit;
			if($airline_id != ''){
				$airline_logo_name = '';
				// $airline_logo_name  = $_REQUEST['airline_logo_old'];
				// $this->form_validation->set_rules('airline_name', 'Airline Name', 'required');
				// $this->form_validation->set_rules('airline_code', 'Airline Code', 'required');
				//$this->form_validation->set_rules('provider_type', 'Provider Type', 'required');
				// if ($this->form_validation->run() == TRUE){					
					if(!empty($_FILES['airline_image']['name'])){	
						if(is_uploaded_file($_FILES['airline_image']['tmp_name'])) {
							$allowed =  array('gif','png' ,'jpg', 'jpeg');
							$oldImage = "uploads/airline_manage/".$airline_logo_name;
							//unlink($oldImage);
							$sourcePath = $_FILES['airline_image']['tmp_name'];
							$filename = $_FILES['airline_image']['name'];
							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							if(in_array($ext,$allowed) ) {
								$img_Name=time().$_FILES['airline_image']['name'];
								$targetPath = "uploads/airline/".$img_Name;
								// if(move_uploaded_file($sourcePath,$targetPath)){
								// 	$airline_logo_name = $img_Name;
								// }

								if($this->compressImage($sourcePath,$targetPath,60)){
									$airline_logo_name = $img_Name;
								}
							}
						}				
					}
					// echo "<pre/>";print_r($_POST);die;
					$this->Airline_Manag_Model->update_airline($_POST,$airline_id, $airline_logo_name);
					redirect('airline_management','refresh');
				// } else {
				// 	$airline = $this->General_Model->get_home_page_settings();
				// 	$this->load->view('airline_manage/add_airline',$airline);
				// }
			}
			redirect('airline_management','refresh');
		}else{
			$this->edit_airline($airline_id);
		}
	}

	function airline_details_insert(){
		$airline_list 	= $this->Airline_Manag_Model->get_airline_list();
		for($i=0;$i<count($airline_list);$i++){
			$image = FCPATH."assets/airline_logo/".$airline_list[$i]->AirLineName.".jpg";
			if(file_exists($image)) {
				echo "The file $image exists";
			} else {
				echo "The file $image does not exist";
			}
			echo "<br/>";
			$insert_data = array(
							'airline_name' 			=> $airline_list[$i]->AirLineName,
							'airline_code' 			=> $airline_list[$i]->AirLineCode,
							'airline_logo' 			=> '',
							'provider_type' 		=> $airline_list[$i]->ProviderType,
							'status' 				=> 'ACTIVE',
							'airline_creation_date'	=> (date('Y-m-d H:i:s'))					
						);			
			// $this->db->insert('airline_details',$insert_data);
		}
		
	}
}
