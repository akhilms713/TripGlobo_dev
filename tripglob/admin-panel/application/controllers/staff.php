<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Staff extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('user_model');
		$this->load->model('email_model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      	$this->output->set_header("Pragma: no-cache");
	    $this->load->library('form_validation');
	    $this->user_mode = 'STAFF';
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
    
    function add_staff($status='')
	{
		$data['error'] = $this->general_model->error_message('Staff',$status);
		$data['country_details'] 	= $this->user_model->get_country_details();
		$this->load->view('staff/add_staff', $data);
	}
	
	function staff_list($status='')
	{
		
		$data['status']=$status;
		// debug($this->user_mode);exit;
		$data['staff_list'] = $this->user_model->get_allusers($this->user_mode);
// 		echo "<pre>";
// 	    print_r($data); exit;
		$this->load->view('staff/view_staff', $data);
	}
	function staff_update_password($id){
   if ($_POST['new_password']!='' && $_POST['confirm_password']!='') {
   	if ($_POST['new_password']===$_POST['confirm_password']) {   		
   		$this->db->where('user_id',$id);
   		$data['password']=md5($_POST['new_password']);
   		$this->db->update('user_login_details',$data);
   		$data['status']=1;   	
   	}else{

   		$data['status']=2;   	
   	}
   }
   $data['user_id']=$id;
   $this->load->view('staff/staff_update_password', $data);
	}
	
	function add_staff_do($status='')
	{
		$this->form_validation->set_rules('fname', 'Staff Name', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('city_name', 'City Name', 'required');
		$this->form_validation->set_rules('zip_code', 'Zip Code', 'required');
		$this->form_validation->set_rules('state_name', 'State Name', 'required');
		$this->form_validation->set_rules('country_code', 'Country Name', 'required');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
		$this->form_validation->set_rules('aadhar_card', 'Aadhar Card', 'required');
		$user_type_name = $_POST['user_type_name'];
		$user_type_id = $this->user_model->get_usertype_id($user_type_name);
		$count_vs = $this->user_model->isRegistered_cancel($this->input->post('email'),$user_type_id)->num_rows();
		
		if($count_vs <= 0){
		
        		$count = $this->user_model->isRegistered($this->input->post('email'),$user_type_id)->num_rows();
                $newlogoname = '';
        		if($count == 0){
        		    
            		if(isset($_FILES["profile_photo"]["name"]) && $_FILES["profile_photo"]["name"]!='')
            		{
            			 $logo_image = explode(".",$_FILES["profile_photo"]["name"]);
            			$newlogoname = date('YmdHis').rand(1,9999999) . '.' .end($logo_image);
            			$tmpnamert=$_FILES['profile_photo']['tmp_name'];
            	
            			//move_uploaded_file($tmpnamert, 'uploads/users/'.$newlogoname);
            
            			$this->compressImage($tmpnamert,'../photo/users/'.$newlogoname,60);
            			
            			$admin_profile_pic = WEB_FRONT_URL.'photo/users/'.$newlogoname;
            		
            		}
        		 
        		    $user_id = $this->user_model->createUsers_staff($_POST,$user_type_id,$newlogoname);
        		    $this->initializeAccountInfo_model($user_id);
        		    $this->load->model('email_model');
                $this->email_model->add_new_staff_email('STAFF_CREATE',$user_id,$this->input->post('email'));
        		    // debug($user_id);exit;
        		    $status=1;
        			
        		}else{
        		    
        		    $status=11;
        		    
        		}
	    }
		else
		{
			$status=11;
		}
		
// 		redirect(WEB_URL.'staff/add_staff/'.$status,'refresh');
        redirect(WEB_URL.'staff/staff_list/'.$status);
	}
	
    
      public function initializeAccountInfo_model($user_id) {
        $data = array('user_id'=>$user_id, 'balance_credit'=>0, 'last_credit'=>0);
        $this->db->insert('user_accounts', $data);
        return true;
       }
    
	public function allusers()
	{
		$data['users'] = $this->user_model->get_allusers($this->user_mode);
		$data['page_title'] = 'User Management';
		$data['promo'] = $this->general_model->get_promo_list(); 
		// echo "<pre>";
		// print_r($data['users']);
		// exit;

        $this->load->view('b2c/view', $data);
	}
	
	 public function update_user_status() 
	 {
		$id = $_GET['id'];
		$status = $_GET['status'];

		$this->email_model->send_status_email($id, $status);
        if($this->user_model->update_user_status($id, $status))
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
	
	public function view_profile($user_id)
	{
		//$data['user'] = $this->user_model->get_user_details($user_id);
		$data['user'] = $this->user_model->get_user_details($user_id);
		$data['user_activity'] = $this->user_model->get_user_activity_details($user_id);
		//$data['user_login_session'] = $this->user_model->get_user_login_session_details($user_id);
        $this->load->view('staff/view_profile', $data);
	}
	
	public function edit_profile($user_id ,$status='')
	{
		$data['status'] = $status;
		$data['user'] = $this->user_model->get_user_details($user_id);
		$data['country_details'] = $this->user_model->get_country_details();
		// debug($data);exit;
		$this->load->view('staff/edit_profile', $data);
	}
	public function edit_profile_do($user_id)
	{
		// debug($_POST);exit;
		$username = $_POST['username'];
		$home_phone = $_POST['home_phone'];
		$mobile_phone = $_POST['mobile_phone'];
		$address = $_POST['address'];
		$city_name = $_POST['city_name'];
		$state_name = $_POST['state_name'];
		$zip_code = $_POST['zip_code'];
		$country_name = $_POST['country_name'];
		$aadhar_card = $_POST['aadhar_card'];
		$user_info = $this->user_model->get_user_details($user_id);
		if(isset($_FILES["profile_photo"]["name"]) && $_FILES["profile_photo"]["name"]!='')
		{
			$logo_image = explode(".",$_FILES["profile_photo"]["name"]);
            			$newlogoname = date('YmdHis').rand(1,9999999) . '.' .end($logo_image);
            			$tmpnamert=$_FILES['profile_photo']['tmp_name'];
            	
            			//move_uploaded_file($tmpnamert, 'uploads/users/'.$newlogoname);
            
            			$this->compressImage($tmpnamert,'../photo/users/'.$newlogoname,60);
            			
            			$admin_profile_pic = WEB_FRONT_URL.'photo/users/'.$newlogoname;
		$this->user_model->update_b2cuser_details($user_id,$username, $_POST['home_phone'],$_POST['mobile_phone'],$_POST['aadhar_card'],$newlogoname);
		$this->user_model->update_user_address_details($user_info->address_details_id,$address, $city_name,$state_name,$zip_code,$country_name);
		}		
		else
		{
		$this->user_model->update_b2cuser_details($user_id,$username, $_POST['home_phone'],$_POST['mobile_phone'],$_POST['aadhar_card'],'');
		$this->user_model->update_user_address_details($user_info->address_details_id,$address, $city_name,$state_name,$zip_code,$country_name);	
		}
		
		
		redirect(WEB_URL.'staff/edit_profile/'.$user_id.'/1','refresh');
	
		
		
	}
	
	public function send_email_to_user($user_id,$status='')
	{
		$data['status']=$status;
		$data['id']=$user_id;
		$data['user'] = $this->user_model->get_user_details($user_id);
        $this->load->view('staff/send_email', $data);
	}
	
	public function staff_log_tracking(){
        $data['details']=$this->user_model->staff_log_tracking();
        $this->load->view('staff/login_log',$data);
    }
	
	
}

?>
