<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
error_reporting(0);
class Markup extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');
		$this->load->model('Product_Model');		
		$this->load->model('Domain_Model');		
		$this->load->model('Usertype_Model');		
		$this->load->model('Api_Model');
		$this->load->model('Airline_Model');
		$this->load->model('Markup_Model');
		$this->load->model('Email_Model');
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
	
	public function index(){
		$markup['markup'] 	= $this->Markup_Model->get_markup_list();
		// echo "<pre/>";print_r($markup);die;
		$this->load->view('markup/markup_list',$markup);
	}

	
	public function add_markup(){
		

		if(count($_POST) > 0){
			if(isset($_POST['status'])){
				$_POST['status'] = "ACTIVE";
			}
			else
			{
				$_POST['status'] = "INACTIVE";
			}
			// echo "<pre>";print_r($_POST);exit;
			$user_type = $_POST['user_type'];
			$product_type = $_POST['product'];
			$markup_type = $_POST['markup_type'];
			
			$check_markup_data = $this->Markup_Model->get_markup_data($user_type,$product_type,$markup_type);
			$mark_up_detail_id = $check_markup_data[0]['markup_details_id'];
			 count($check_markup_data);
			$count = count($check_markup_data);
			
			if($count > 0){
				 $this->Markup_Model->update_markup($_POST,$mark_up_detail_id);
			}else{
				
				  $this->Markup_Model->add_markup($_POST);
				  // $this->Email_Model->sendMarkupMail($_POST);
			}
			redirect('markup','refresh');

		}else{
			$data['domain'] 	=  $this->Domain_Model->get_domain_list();
			$data['product'] 	=  $this->Product_Model->get_product_list();
			$data['country'] 	=  $this->General_Model->get_country_details();
			$data['user_type']	=  $this->Usertype_Model->get_user_type_list();
			// $data['api']		=  $this->Api_Model->get_api_list();
			$data['api']		=  $this->Api_Model->get_api_lists_mar();
			$data['agents'] = $this->Markup_Model->getB2bUsers();
			$data['airline']	=  $this->Airline_Model->get_airline_list_new();
			// echo "<pre/>";print_r($data['api']);die;
			$this->load->view('markup/add_markup',$data);	
		}
	}	
	
	function active_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->active_markup($markup_id);
		}
		redirect('markup','refresh');
	}
	
	function inactive_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->inactive_markup($markup_id);
		}
		redirect('markup','refresh');
	}
	
	function delete_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->delete_markup($markup_id);
		}
		redirect('markup','refresh');
	}
	
	function edit_markup($markup_id){

		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$data['domain'] 	=  $this->Domain_Model->get_domain_list();
			$data['product'] 	=  $this->Product_Model->get_product_list();
			$data['country'] 	=  $this->General_Model->get_country_details();
			$data['user_type']	=  $this->Usertype_Model->get_user_type_list();
			// $data['api']		=  $this->Api_Model->get_api_list();
			$data['api']		=  $this->Api_Model->get_api_lists_mar();
			$data['airline']	=  $this->Airline_Model->get_airline_list_new();
			$data['agents'] = $this->Markup_Model->getB2bUsers();
			$data['markup'] 	= $this->Markup_Model->get_markup_list($markup_id);
			$this->load->view('markup/edit_markup',$data);
		} else {
			redirect('markup','refresh');
		}
	}
	
	function update_markup($markup_id){
		//echo '<pre>'; print_r($_POST); exit;
		if(count($_POST) > 0){
			$markup_id = json_decode(base64_decode($markup_id));
			
			if($markup_id != ''){
				if($_POST['markup_type'] == 'GENERAL'){
					$_POST['country'] = 0;
					$_POST['airline'] = 0;
				}
				$this->Markup_Model->update_markup($_POST,$markup_id);
				// $this->Email_Model->sendMarkupMail($_POST);
			}
			redirect('markup','refresh');
		}else if($markup_id!=''){
			redirect('markup/edit_markup/'.$markup_id,'refresh');
		}else{
			redirect('markup','refresh');
		}
	}

	function getB2bList($id){
		if($id == 3){
			$agents = $this->Markup_Model->getB2bUsers();
			$string = '<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Select Agent</label>
			<div class="col-sm-5">
			<select name="agent_name" class="select2" required >';
			for ($i=0; $i < count($agents); $i++) { 
				$string .= '<option value="'.$agents[$i]->user_details_id.'" data-iconurl="">'.$agents[$i]->user_name.'-'.$agents[$i]->user_email.'</option>';
			}

			$string .= '</select></div></div>';
			echo json_encode($string);
		}else{
			echo "";
		}
	}
	public function list_dest_air_markup(){
		$markup 			= $this->General_Model->get_home_page_settings();
		$markup['markup'] 	= $this->Markup_Model->get_list_dest_air_markup();
		$this->load->view('markup/list_dest_air_markup',$markup);
	}	
	public function edit_dest_air_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		$markup['domain'] 	=  $this->Domain_Model->get_domain_list();
			$markup['product'] 	=  $this->Product_Model->get_product_list_markup();
			$markup['country'] 	=  $this->General_Model->get_country_details();
			$markup['user_type']	=  $this->Usertype_Model->get_user_type_list();
			$markup['api']		=  $this->Api_Model->get_api_lists_markup();
			$markup['agents'] 	= $this->Markup_Model->getB2bUsers();
			$markup['airline']	=  $this->Airline_Model->get_airline_list_new();
		$markup['markup'] 	= $this->Markup_Model->get_list_dest_air_markup($markup_id);
		$markup['airline']	=  $this->Airline_Model->get_airline_list_new();
		$this->load->view('markup/edit_dest_airl_markup',$markup);
		// debug($markup['markup']);exit;

	}
	public function add_dest_air_markup(){
		if(count($_POST) > 0){
			if (isset($_POST['markup_details_id']) && !empty($_POST['markup_details_id'])) {
			// debug($_POST);exit;
			$mark_up_detail_id = $_POST['markup_details_id'];
					$this->Markup_Model->update_dest_air_markup($_POST,$mark_up_detail_id);
					$this->session->set_flashdata('success', 'Update Successfully');
			}else{				
			// debug($_POST);exit;
				$check_markup_data = $this->Markup_Model->get_dest_air_markup($_POST);
				$count = count($check_markup_data);

				if($count > 0){
					$mark_up_detail_id = $check_markup_data[0]['markup_details_id'];
					$this->Markup_Model->update_dest_air_markup($_POST,$mark_up_detail_id);
					$this->session->set_flashdata('success', 'Update Successfully');
				}else{
					$this->Markup_Model->add_dest_air_markup($_POST);
					$this->session->set_flashdata('success', 'Add Successfully');
				}
			}
			redirect('markup/list_dest_air_markup','refresh');

		}else{
			$data['domain'] 	=  $this->Domain_Model->get_domain_list();
			$data['product'] 	=  $this->Product_Model->get_product_list_markup();
			$data['country'] 	=  $this->General_Model->get_country_details();
			$data['user_type']	=  $this->Usertype_Model->get_user_type_list();
			$data['api']		=  $this->Api_Model->get_api_lists_markup();
			$data['agents'] 	= $this->Markup_Model->getB2bUsers();
			$data['airline']	=  $this->Airline_Model->get_airline_list_new();
			// debug($data['agents']);exit();
			$this->load->view('markup/add_dest_airl_markup',$data);	
		}
	}
	function active_dest_air_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->active_dest_air_markup($markup_id);
		}
		redirect('markup/list_dest_air_markup','refresh');
	}
	
	function inactive_dest_air_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->inactive_dest_air_markup($markup_id);
		}
		redirect('markup/list_dest_air_markup','refresh');
	}
	
	function delete_dest_air_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->delete_dest_air_markup($markup_id);
		}
		redirect('markup/list_dest_air_markup','refresh');
	}



	public function list_air_coun_markup(){
		$markup['markup'] 	= $this->Markup_Model->get_list_air_coun_markup();
		$this->load->view('markup/list_air_coun_markup',$markup);
	}
		public function edit_air_coun_markup($markup_id){
			$markup_id = json_decode(base64_decode($markup_id));
			$data['domain'] 	=  $this->Domain_Model->get_domain_list();
			$data['product'] 	=  $this->Product_Model->get_product_list_markup();
			$data['country'] 	=  $this->General_Model->get_country_details();
			$data['user_type']	=  $this->Usertype_Model->get_user_type_list();
			$data['api']		=  $this->Api_Model->get_api_lists_markup();
			$data['agents'] 	= $this->Markup_Model->getB2bUsers();
			$data['airline']	=  $this->Airline_Model->get_airline_list_new();
		$data['markup'] 	= $this->Markup_Model->get_list_air_coun_markup($markup_id);
		// debug($data['markup']);exit;
		$this->load->view('markup/edit_air_coun_markup',$data);
	}

	public function add_air_coun_markup(){
		if(count($_POST) > 0){
			$check_markup_data = $this->Markup_Model->get_air_coun_markup($_POST);
			$count = count($check_markup_data);
            if (isset($_POST['markup_details_id']) && !empty($_POST['markup_details_id'])) {
			// debug($_POST);exit;
			$mark_up_detail_id = $_POST['markup_details_id'];
				$this->Markup_Model->update_air_coun_markup($_POST,$mark_up_detail_id);
					
					$this->session->set_flashdata('success', 'Update Successfully');
			}else{
			if($count > 0){
				$mark_up_detail_id = $check_markup_data[0]['markup_details_id'];
				$this->Markup_Model->update_air_coun_markup($_POST,$mark_up_detail_id);
					$this->session->set_flashdata('success', 'Update Successfully');
			}else{
				$this->Markup_Model->add_air_coun_markup($_POST);
					$this->session->set_flashdata('success', 'Add Successfully');
			}
		    }
			redirect('markup/list_air_coun_markup','refresh');

		}else{
			$data['domain'] 	=  $this->Domain_Model->get_domain_list();
			$data['product'] 	=  $this->Product_Model->get_product_list_markup();
			$data['country'] 	=  $this->General_Model->get_country_details();
			$data['user_type']	=  $this->Usertype_Model->get_user_type_list();
			$data['api']		=  $this->Api_Model->get_api_lists_markup();
			$data['agents'] 	= $this->Markup_Model->getB2bUsers();
			$data['airline']	=  $this->Airline_Model->get_airline_list_new();
			$this->load->view('markup/add_air_coun_markup',$data);	
		}
	}

	function active_air_coun_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->active_air_coun_markup($markup_id);
		}
		redirect('markup/list_air_coun_markup','refresh');
	}
	
	function inactive_air_coun_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->inactive_air_coun_markup($markup_id);
		}
		redirect('markup/list_air_coun_markup','refresh');
	}
	
	function delete_air_coun_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->delete_air_coun_markup($markup_id);
		}
		redirect('markup/list_air_coun_markup','refresh');
	}




	public function list_air_coun_dest_markup(){
		$markup['markup'] 	= $this->Markup_Model->get_list_air_coun_dest_markup();
		$this->load->view('markup/list_air_coun_dest_markup',$markup);
	}	
	public function edit_air_coun_dest_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		$markup['markup'] 	= $this->Markup_Model->get_list_air_coun_dest_markup($markup_id);
		$markup['domain'] 	=  $this->Domain_Model->get_domain_list();
			$markup['product'] 	=  $this->Product_Model->get_product_list_markup();
			$markup['country'] 	=  $this->General_Model->get_country_details();
			$markup['user_type']	=  $this->Usertype_Model->get_user_type_list();
			$markup['api']		=  $this->Api_Model->get_api_lists_markup();
			$markup['agents'] 	=  $this->Markup_Model->getB2bUsers();
			$markup['airline']	=  $this->Airline_Model->get_airline_list_new();
			// debug($markup['markup'] );exit;
		$this->load->view('markup/edit_air_coun_dest_markup',$markup);
	}
	public function add_air_coun_dest_markup(){
		// debug($_POST);exit;

		if(count($_POST) > 0){
			// debug($_POST);exit;
			$check_markup_data = $this->Markup_Model->get_air_coun_dest_markup($_POST);
			$count = count($check_markup_data);
			// debug($_POST);exit;
            if (isset($_POST['markup_details_id']) && !empty($_POST['markup_details_id'])) {
			$mark_up_detail_id = $_POST['markup_details_id'];
				$this->Markup_Model->update_air_coun_dest_markup($_POST,$mark_up_detail_id);
					
					$this->session->set_flashdata('success', 'Update Successfully');
			}else{
			if($count > 0){
				$mark_up_detail_id = $check_markup_data[0]['markup_details_id'];
				$this->Markup_Model->update_air_coun_dest_markup($_POST,$mark_up_detail_id);
					$this->session->set_flashdata('success', 'Update Successfully');
			}else{
				$this->Markup_Model->add_air_coun_dest_markup($_POST);
					$this->session->set_flashdata('success', 'Add Successfully');
			}
		    }
			redirect('markup/list_air_coun_dest_markup','refresh');

		}else{
			$data['domain'] 	=  $this->Domain_Model->get_domain_list();
			$data['product'] 	=  $this->Product_Model->get_product_list_markup();
			$data['country'] 	=  $this->General_Model->get_country_details();
			$data['user_type']	=  $this->Usertype_Model->get_user_type_list();
			$data['api']		=  $this->Api_Model->get_api_lists_markup();
			$data['agents'] 	=  $this->Markup_Model->getB2bUsers();
			$data['airline']	=  $this->Airline_Model->get_airline_list_new();
			$this->load->view('markup/add_air_coun_dest_markup',$data);	
		}
	}
	function active_air_coun_dest_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->active_air_coun_dest_markup($markup_id);
		}
		redirect('markup/list_air_coun_dest_markup','refresh');
	}
	
	function inactive_air_coun_dest_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->inactive_air_coun_dest_markup($markup_id);
		}
		redirect('markup/list_air_coun_dest_markup','refresh');
	}
	
	function delete_air_coun_dest_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->delete_air_coun_dest_markup($markup_id);
		}
		redirect('markup/list_air_coun_dest_markup','refresh');
	}
	public function list_amt_range_markup(){
		$markup['markup'] 	= $this->Markup_Model->get_list_amt_range_markup();
		$this->load->view('markup/list_amt_range_markup',$markup);
	}
	public function add_amt_range_markup(){
		if(count($_POST) > 0){
			$check_markup_data = $this->Markup_Model->get_amt_range_markup($_POST);
			$count = count($check_markup_data);

			if($count > 0){
				$mark_up_detail_id = $check_markup_data[0]['markup_details_id'];
				$this->Markup_Model->update_amt_range_markup($_POST,$mark_up_detail_id);
			}else{
				$this->Markup_Model->add_amt_range_markup($_POST);
			}
			redirect('markup/list_amt_range_markup','refresh');

		}else{
			$data['domain'] 	=  $this->Domain_Model->get_domain_list();
			$data['product'] 	=  $this->Product_Model->get_product_list();
			$data['country'] 	=  $this->General_Model->get_country_details();
			$data['user_type']	=  $this->Usertype_Model->get_user_type_list();
			$data['api']		=  $this->Api_Model->get_api_lists_mar();
			$data['agents'] 	= $this->Markup_Model->getB2bUsers();
			$data['airline']	=  $this->Airline_Model->get_airline_list_new();
			$this->load->view('markup/add_amt_range_markup',$data);	
		}
	}
	function active_amt_range_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->active_amt_range_markup($markup_id);
		}
		redirect('markup/list_amt_range_markup','refresh');
	}
	
	function inactive_amt_range_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->inactive_amt_range_markup($markup_id);
		}
		redirect('markup/list_amt_range_markup','refresh');
	}
	
	function delete_amt_range_markup($markup_id){
		$markup_id = json_decode(base64_decode($markup_id));
		if($markup_id != ''){
			$this->Markup_Model->delete_amt_range_markup($markup_id);
		}
		redirect('markup/list_amt_range_markup','refresh');
	}

// 		public function search_option_from(){ 
// 	  	$from_date=$searchTerm = $_GET['term']; 
// 	  	$result = $this->Markup_Model->get_bulkDataNameby($from_date);
// 	  	$data=[];
// 	  	foreach($result as $val){
// 	  	    $data[]=['id'=>$val->city.' - '.$val->city_code.', '.$val->country,'value'=>$val->city.' - '.$val->city_code.', '.$val->country];
// 	  	}
// 	  	echo json_encode($data);
// 	}

 public function get_api_detail()
 {
     $id= $this->input->post('val');
     $dataApiName=  $this->Api_Model->get_api_name($id);
     print_r(json_encode($dataApiName));
     
 }


	
}
