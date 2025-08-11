<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Subadmin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('admin_model');
		$this->load->model('xmllog_model');
		$this->load->model('user_model');
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
		function view($status='')
	{
		
		$data['status']=$status;
		$data['subadmin_list']=$this->admin_model->get_subadmin_details();
	
		$this->load->view('subadmin/view', $data);
	}
		 public function update_user_status() 
	 {
		$id= $_POST['id'];
		$status= $_POST['status'];
        if($this->admin_model->update_user_status($id, $status))
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
	function add_subadmin($status='')
	{
		$data['error'] = $this->general_model->error_message('Sub-Admin',$status);
		$data['role']=$this->admin_model->get_role_details();
		$data['country_details'] 	= $this->user_model->get_country_details();
		$this->load->view('subadmin/add_new', $data);
	}
	
	function edit_subadmin($admin_id='')
	{
		$data['error'] = $this->general_model->error_message('Sub-Admin',$status);
		$data['role']=$this->admin_model->get_role_details();
		$data['country_details'] 	= $this->user_model->get_country_details();
		
		$data['admin'] = $this->admin_model->get_admin_details_id($admin_id);
		$data['admin_role']	=	$this->admin_model->admin_role_details_user($admin_id);
		
		// echo '<pre>';print_r($data['admin']);exit();
		
		$this->load->view('subadmin/edit_subadmin', $data);
	}
	
	
	
	function add_subadmin_do($status='')
	{
		// debug($_POST);exit;
	 
		$this->form_validation->set_rules('fname', 'Admin Name', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required|admin_login_details.admin_user_name');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('city_name', 'City Name', 'required');
		$this->form_validation->set_rules('zip_code', 'Zip Code', 'required');
		$this->form_validation->set_rules('state_name', 'State Name', 'required');
		$this->form_validation->set_rules('country_code', 'Country Name', 'required');
		$this->form_validation->set_rules('role', 'Role', 'required');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
				
		
		$data['status']='';
		if ( $this->form_validation->run() !== false ) 
		{
			$admin_name = $_POST['fname'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$address = $_POST['address'];
			$city_name = $_POST['city_name'];
			$zip_code = $_POST['zip_code'];
			$state_name = $_POST['state_name'];
			$country_code = $_POST['country_code'];
			$role = $_POST['role'];
			$admin_profile_pic ='';
			$admin_pattren = $_POST['pattern'];
			$phone_number = $_POST['phone_number'];
			
			
			
		if(isset($_FILES["profile_photo"]["name"]) && $_FILES["profile_photo"]["name"]!='')
		{
			 $logo_image = explode(".",$_FILES["profile_photo"]["name"]);
			$newlogoname = date('YmdHis').rand(1,9999999) . '.' .end($logo_image);
			$tmpnamert=$_FILES['profile_photo']['tmp_name'];
	
			//move_uploaded_file($tmpnamert, 'uploads/users/'.$newlogoname);

			$this->compressImage($tmpnamert,'uploads/users/'.$newlogoname,60);
			
			$admin_profile_pic=WEB_URL.'uploads/users/'.$newlogoname;
		
		}
		 
		
			if($this->admin_model->check_admin_email_id($this->input->post('email')))
			{
			 $this->admin_model->add_new_admin($admin_name,$email,$password,$phone_number,$address,$city_name,$zip_code,$state_name,$country_code,$admin_profile_pic,$admin_pattren,$role);
				$status=1;
				
			}
			else
			{

				$status=0;
			}
		}
		else
		{
			$status=11;
		}
		
		redirect(WEB_URL.'subadmin/add_subadmin/'.$status,'refresh');

	}
	
	function edit_subadmin_do($admin_id='')
	{
		$this->form_validation->set_rules('fname', 'Admin Name', 'required');
		//$this->form_validation->set_rules('email', 'Email Address', 'required|admin_login_details.admin_user_name');
		//$this->form_validation->set_rules('old_password', 'Old Password', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('city_name', 'City Name', 'required');
		$this->form_validation->set_rules('zip_code', 'Zip Code', 'required');
		$this->form_validation->set_rules('state_name', 'State Name', 'required');
		$this->form_validation->set_rules('country_code', 'Country Name', 'required');
		//$this->form_validation->set_rules('role', 'Role', 'required');
		//$this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
		
		
	
		if ( $this->form_validation->run() !== false ) 
		{
		    $admin_id=$_POST['admin_id'];
			$admin_name = $_POST['fname'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$address = $_POST['address'];
			$city_name = $_POST['city_name'];
			$zip_code = $_POST['zip_code'];
			$state_name = $_POST['state_name'];
			$country_code = $_POST['country_code'];
			$role = $_POST['role'];
			$admin_profile_pic ='';
			$admin_pattren = $_POST['pattern'];
			$phone_number = $_POST['phone_number'];
			
			$admin_profile_pic = $_POST['old_image'];	
			$hphoto =explode('/',$admin_profile_pic);
			
			
        	if(isset($_FILES["profile_photo"]["name"]) && $_FILES["profile_photo"]["name"]!='')
			{
				//$image_name=$hhotel['7'];
				$image_name = end($hphoto);
				unlink('uploads/users/'.$image_name);	

				$logo_image = explode(".",$_FILES["profile_photo"]["name"]);
				$newlogoname = date('YmdHis').rand(1,9999999) . '.' .end($logo_image);
				$tmpnamert=$_FILES['profile_photo']['tmp_name'];
		
				// move_uploaded_file($tmpnamert, 'uploads/flightdeal/'.$newlogoname);
				$this->compressImage($tmpnamert, 'uploads/users/'.$newlogoname,60);
				
				$admin_profile_pic = WEB_URL.'uploads/users/'.$newlogoname;

				$this->admin_model->update_admin_details($_POST,$admin_profile_pic,$admin_id);	
				
			}		
			else
				{
					$this->admin_model->update_admin_details($_POST,$admin_profile_pic,$admin_id);		
				}
				
				redirect(WEB_URL.'subadmin/view','refresh');
		 
		
		
		}
		else
		{
			$status=11;
		}
		
		$data['country_details'] 	= $this->user_model->get_country_details();
		
		$data['admin'] = $this->admin_model->get_admin_details_id($admin_id);
		
		$this->load->view('subadmin/edit_subadmin', $data);

	}
	function manage_xmllog($status='')
	{
		$data['status']=$status;
		$data['xml_logs']	=	$this->xmllog_model->get_xmllogs();
		
		$this->load->view('xmllogs/xmllog', $data);
	}
	function privileges($status='')
	{
	 	$data['admin_privileges']=$this->admin_model->get_privileges();
		$data['error'] = $this->general_model->error_message('Privileges',$status);
		$this->load->view('subadmin/privileges', $data);
	}
	function manage_functions($privilege_id = NULL,$status='')
	{
		if($privilege_id == '' || $privilege_id < 0 )
		{
			redirect(WEB_URL.'subadmin/privileges/');
		}
			$data['error'] = $this->general_model->error_message('Privileges',$status);
			$data['privilege_functions']	=	$this->admin_model->get_privilege_functions();
			$active_function_id	=	$this->admin_model->get_privilege_active_functions($privilege_id);
			$function_ids = array();
			foreach ($active_function_id as $value) {
				$function_ids[] = $value["privilege_functions_id"];
			}
			$data['active_functions'] = $function_ids;
			$data['privilege_id'] = $privilege_id;
			$this->load->view('subadmin/manage_functions', $data);
	}

	function add_privileges(){

		$this->form_validation->set_rules('privilege_name', 'Privilege Name', 'required|is_unique[privilege.privilege_name]');
		if ( $this->form_validation->run() !== false ) 
		{
			
			$data["privilege_name"] = ucfirst($this->input->post("privilege_name"));
			if($this->admin_model->add_privileges($data))
			{
				redirect(WEB_URL.'subadmin/privileges/1','refresh');
			}
			else
			{
				redirect(WEB_URL.'subadmin/privileges/0','refresh');
			}
		}
		else
		{
			redirect(WEB_URL.'subadmin/privileges/11','refresh');
		}
	}
	function activate_functions(){
		$privilege = $this->input->post("privilege");
		$privilege_id = $this->input->post("privilege_id");
		$i = 0;
		$data = array();
		if (!empty($privilege)) {
			foreach ($privilege as $key => $value) {
				$data[$i]["privilege_id"] = $privilege_id;
				$data[$i]["privilege_functions_id"] = $value;
				$i++;
			}
		}
		
		$response = $this->admin_model->activate_functions($data, $privilege_id);
		if ($response) {
			redirect(WEB_URL.'subadmin/manage_functions/'.$privilege_id.'/12','refresh');
		}else
		{
			redirect(WEB_URL.'subadmin/manage_functions/'.$privilege_id.'/0','refresh');
		}
	}

	function edit_privileges($privilege_id = NULL){
		$data['admin_privileges']	=	$this->admin_model->get_privilege($privilege_id);
		
		if($data['admin_privileges'] == '')
		{
			redirect(WEB_URL.'subadmin/privileges');
		}

		$this->load->view('subadmin/edit_privileges', $data);
	}

	function update_privilege($status=''){
		$privilege_id = $this->input->post("privilege_id");
		$this->form_validation->set_rules('privilege_name', 'Privilege Name', 'required|is_unique[privilege.privilege_name]');
		if ( $this->form_validation->run() !== false ) 
		{
			$data["privilege_name"] = ucfirst($this->input->post("privilege_name"));
			if($this->admin_model->update_privilege($privilege_id, $data))
			{
				redirect(WEB_URL.'subadmin/privileges/12','refresh');
			}
			else
			{
				redirect(WEB_URL.'subadmin/privileges/0','refresh');
			}
		}
		else
		{
			redirect(WEB_URL.'subadmin/privileges/11','refresh');
		}
		
		
	}

	function delete_privilege($privilege_id, $status=''){
	

		if($this->admin_model->delete_privilege($privilege_id))
			{
				redirect(WEB_URL.'subadmin/privileges/13','refresh');
			}
			else
			{
				redirect(WEB_URL.'subadmin/privileges/0','refresh');
			}
		
	}


	function role($status='')
	{
 		$data['error'] = $this->general_model->error_message('Role',$status);
		$data['admin_role']	=	$this->admin_model->get_admin_role_details();
		$this->load->view('subadmin/role', $data);
	}
	function add_role($status=''){
		$this->form_validation->set_rules('role_name', 'Role Name', 'required|is_unique[admin_role.admin_role_name]');
		if ( $this->form_validation->run() !== false ) 
		{
			$data["admin_role_name"] = ucfirst($this->input->post("role_name"));

		if($this->admin_model->add_role($data))
			{
				redirect(WEB_URL.'subadmin/role/1','refresh');
			}
			else
			{
				redirect(WEB_URL.'subadmin/role/0','refresh');
			}
		}
		else
		{
			redirect(WEB_URL.'subadmin/role/11','refresh');
		}
	}
	function edit_role($role_id){
		$data['admin_role']	=	$this->admin_model->get_admin_role_details($role_id);
		$this->load->view('subadmin/edit_role', $data);
	}
	function update_role($status=''){
		
		$admin_role_id = $this->input->post("admin_role_id");
			$this->form_validation->set_rules('role_name', 'Role Name', 'required|is_unique[admin_role.admin_role_name]');
	
		if ( $this->form_validation->run() !== false ) 
		{
			$data["admin_role_name"] = ucfirst($this->input->post("role_name"));
			if($this->admin_model->update_role($admin_role_id, $data))
			{
				redirect(WEB_URL.'subadmin/role/12','refresh');
			}
			else
			{
				redirect(WEB_URL.'subadmin/role/0','refresh');
			}
		}
		else
		{
			redirect(WEB_URL.'subadmin/role/11','refresh');
		}
		
		 
	}
	function delete_role($admin_role_id){
		
		
		if($this->admin_model->delete_role($admin_role_id))
			{
				redirect(WEB_URL.'subadmin/role/13','refresh');
			}
			else
			{
				redirect(WEB_URL.'subadmin/role/0','refresh');
			}	 
	}
	function manage_role($admin_role_id,$status=''){
		
		$data['error'] = $this->general_model->error_message('Privileges',$status);
		$data['admin_role']	=	$this->admin_model->get_admin_role_details($admin_role_id);
		$data['privileges']	=	$this->admin_model->get_privileges();
		$active_privileges_id	=	$this->admin_model->get_privilege_active_ids($admin_role_id);
		
		//echo "<pre>"; var_dump($data['admin_role']); exit;
		
		if($data['admin_role'] == '' )
		{
			redirect(WEB_URL.'subadmin/role/');
		}

		$privileges_ids = array();
		foreach ($active_privileges_id as $value) {
			$privileges_ids[] = $value["privilege_id"];
		}
		$data['privileges_ids'] = $privileges_ids;
		$this->load->view('subadmin/manage_role', $data);
	}
	function activate_privilege(){

		$privilege = $this->input->post("privilege");
		$admin_role_id = $this->input->post("admin_role_id");		
		//var_dump($admin_role_id); exit;
		$response = $this->admin_model->activate_privilege($privilege, $admin_role_id);
		 
		if ($response) {
			redirect(WEB_URL.'subadmin/manage_role/'.$admin_role_id.'/12','refresh');
		}else
		{
			redirect(WEB_URL.'subadmin/manage_role/'.$admin_role_id.'/0','refresh');
		}
	}
	
	
	
	
}

?>
