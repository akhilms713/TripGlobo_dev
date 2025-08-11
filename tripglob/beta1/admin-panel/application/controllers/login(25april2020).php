<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
	  $this->load->model('security_model');
	  $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      $this->output->set_header("Pragma: no-cache");
	  
	}
	//Default function while load the admin panel
	public function index()
	{	
		
		if($this->session->userdata('admin_logged_in')) //Whether already panel logged or not.
		{

	      	redirect(WEB_URL.'home/index','refresh');
		} 
		$type ="URL";
		//Whoever enter the admin panel link will track the IP and User Info.
		$last_track_id = $this->security_model->admin_ip_track($type);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'User Name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('pattern', 'Pattern', 'required');
		$data['status']='';
		
		if ( $this->form_validation->run() !== false ) 
		{
			
			$pattern_check = $this->security_model->check_admin_pattern($this->input->post('pattern')); 
			
			$res = $this->security_model->check_admin_login($this->input->post('username'),$this->input->post('password'),$this->input->post('pattern')); 
			// print_r($res);exit;
			if(!empty($res)){
					if($res['result']->admin_status =='ACTIVE'){
						$sessionUserInfo = array( 
						'admin_id' 		=> $res['result']->admin_id,
						'admin_name'	 		=> $res['result']->admin_name,
						'admin_type'	 		=> $res['result']->admin_type_name,
						'admin_logged_in' 	=> TRUE
						);
						$this->session->set_userdata($sessionUserInfo);
						redirect(WEB_URL.'home/index', 'refresh');
					}else{
						$data['status']='Incorrect Username/Password';
						// $data['status']='Your Account is Inactive, Please contact Admin to Activate your Account..';
						$this->load->view('login/admin_login',$data);
					}
				}
				else
				{
					$type ="FAIL";
					$last_track_id = $this->security_model->admin_ip_track($type);
					$data['status']='Your Account is Inactive, Please contact Admin to Activate your Account..';
					// $data['status']='Incorrect Username/Password';
					$this->load->view('login/admin_login',$data);
				}
					//redirect('home/employee_dashboard', 'refresh');
					
			/*if($pattern_check==1)
			
			{}
					else
					{
						$type ="PATTERN";
						$last_track_id = $this->security_model->admin_ip_track($type);
						$data['status']='Incorrect Pattern';
						$this->load->view('login/admin_login',$data);
					}
			*/	}	
				else
				{
					if(validation_errors())
					{
					$data['status'] =  'Required Fileds Are Missing.';
					}
					$this->load->view('login/admin_login',$data);
					
				}
			
	
	}
	public function logout(){
        $this->session->unset_userdata('sessionUserInfo');
		$this->session->sess_destroy();
        redirect(WEB_URL.'login', 'refresh'); 
    }
	public function lockoff(){
       
			$sessionUserInfo_logoff = array( 
						'admin_logged_in' 		=> false
						);
						$this->session->set_userdata($sessionUserInfo_logoff);
        redirect(WEB_URL.'login/login_off', 'refresh'); 
    }
	public function login_off(){
		
		if(!$this->session->userdata('admin_id')){
	      	redirect('login');
		} 
		else
		{
			$data['admin_details'] =  $this->security_model->get_admin_details();
			$this->load->view('login/logoff',$data);
		}
		
	
	}
	
	public function logoff_pattern($pattern){
		
		if(!$this->session->userdata('admin_id') && $pattern!='' && $pattern!='0'){
	       $response = array('status' => 2);
       		echo json_encode($response);
		
		} 
		else
		{
			$status =  $this->security_model->admin_pattern_check($pattern);
			if($status)
			{
				$sessionUserInfo_logoff = array( 
						'admin_logged_in' 		=> true
						);
						$this->session->set_userdata($sessionUserInfo_logoff);
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
}

?>
