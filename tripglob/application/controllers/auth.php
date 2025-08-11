<?php  
ob_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class Auth extends CI_Controller {
	public function __construct(){
		parent::__construct();
		//DO : Setting Current website url in session, 
		//Purpose : For keeping the page on login/logout.
		//Begin
/*		$current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = WEB_URL.$this->uri->uri_string(). $current_url;
		$url =  array(
            'continue' => $current_url,
        );
        $this->session->set_userdata($url);*/
		//End
		  $this->load->model('account_model');
	}

	public function test() {
		$this->account_model->Test();

	}
	public function contactAdmin() {

		if(isset($_POST['vid_c']) && $_POST['vid_c']!='')
		{
			
			$verif = $this->account_model->get_verification_details($_POST['vid_c']);
			if($verif!='')
			{
				
			 $message = $this->input->post('agentMsg');
			 $data = array('user_id'=>$verif->user_id, 'user_type' => $verif->user_type_id, 'message'=>$message, 'ipaddress'=>$this->input->ip_address());
		            $this->account_model->contactAdmin_model($data);
		            $response = array('status' => 1);
		            echo json_encode($response);
			}
			else
			{
				$response = array('status' => 0);
		            echo json_encode($response);
			}
					
		}
		else
		{

	        $temp_user_type = $this->session->userdata('temp_user_type');
			$temp_user_id = $this->session->userdata('temp_user_id');
	        if($temp_user_id != "") {
	            $message = $this->input->post('agentMsg');
	            $data = array('user_id'=>$temp_user_id, 'user_type' => $temp_user_type, 'message'=>$message, 'ipaddress'=>$this->input->ip_address());
	            $this->account_model->contactAdmin_model($data);
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
	 public function logout($provider, $user_id=''){
	
    	 if($this->session->userdata('user_type')==1)
    	{
    	  
    		$url = WEB_URL.'account/agent_login';
    			
    	}
    	else if($this->session->userdata('user_type')==4)
    	{
    	     
    	    $url = WEB_URL.'account/staff_login';
    	    
    	}else{
    		 $url = WEB_URL;
    	
    	}
    	
    	if(($this->session->userdata('user_type')==4) && ($this->session->userdata('user_id')!='')){
    	   $this->account_model->update_staff_log($this->session->userdata('staff_log_track_id'),$this->session->userdata('user_id'));
    	}
	
		$this->session->unset_userdata('sessionUserInfo');
        $this->session->sess_destroy();
        redirect($url,'refresh');
           
          
    }
        
        public function logout_autolog($provider, $user_id=''){
	     
		if($provider == 'autologout')
		{
    		if($this->session->userdata('user_type')==4)
        	{
        	    $url = WEB_URL.'account/staff_login';
        	    $this->account_model->update_staff_log($this->session->userdata('staff_log_track_id'),$this->session->userdata('user_id'));
        		$this->session->unset_userdata('sessionUserInfo');
                $this->session->sess_destroy();
                redirect($url,'refresh');
        	}else{
        	    
        	    $url = $_SERVER['REQUEST_URI'];
        	    redirect($url,'refresh');
        	} 
    	}
		else{
		    
        	 if($this->session->userdata('user_type')==1)
        	{
        		$url = WEB_URL.'account/agent_login';
        	}
        	else if($this->session->userdata('user_type')==4)
        	{
        	    $url = WEB_URL.'account/staff_login';
        	}else{
        		 $url = WEB_URL;
        	}
        	
        	if(($this->session->userdata('user_type')==4) && ($this->session->userdata('user_id')!='')){
        	   $this->account_model->update_staff_log($this->session->userdata('staff_log_track_id'),$this->session->userdata('user_id'));
        	}
    	
    		$this->session->unset_userdata('sessionUserInfo');
            $this->session->sess_destroy();
            redirect($url,'refresh');
		}
           
    }
		
   

}
?>
