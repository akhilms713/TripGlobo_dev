<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
error_reporting(0);
class Security extends CI_Controller {
	public function __construct(){
		
		parent::__construct();
		//DO : Setting Current website url in session, 
		//Purpose : For keeping the page on login/logout.
		//Begin
		$current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = WEB_URL.$this->uri->uri_string(). $current_url;
		$url =  array(
            'continue' => $current_url,
        );
        $this->session->set_userdata($url);
		//End
		$this->load->model('account_model');
		$this->load->model('email_model');
		$this->load->model('verification_model');
	}
	
	public function twostepVerification() {
		if($this->checkVerifiedCredentials()) {
			if($this->isTwoStepEnabled()) {
				$this->setUpTwoStep();
			} else {
				$data['user_id'] = $user_id = $this->session->userdata('user_id');
        $data['user_type']=$user_type =  $this->session->userdata('user_type');
				 $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
				$this->load->view(PROJECT_THEME.'/security/two_step_initialize',$data); //check if the user has already enabled the 2 step service	
			}
		} else {
			$this->session->set_flashdata('verify_attributes', 1);
			redirect(WEB_URL.'dashboard/profile/verifications');
		}
	}

 public function isTwoStepEnabled() {	//check if the two step login is already enabled or not.
	  $data['user_type']=$user_type =$this->session->userdata('user_type');
            $data['user_id']=$user_id = $this->session->userdata('user_id');
        

        $user_type_string = (string)$user_type;
		if($this->verification_model->isTwoStepEnabled($user_id, $user_type_string)) {
			return true;
		} else {
			return false;
		}
	}

 	public function cancelAccountVerificationChk() {
 		if($this->isTwoStepEnabled()) {          /*Check if the two step verification is enabled or not.*/
 			 $data['user_type']=$user_type =$this->session->userdata('user_type');
            $data['user_id']=$user_id = $this->session->userdata('user_id');
			
			if($this->checkVerificationType($user_id, $user_type) == 1) { 			//check which type of verification user has enabled
				$response = array('status'=>1, 'enabled'=>1, 'ver'=>1);
			} else if($this->checkVerificationType($user_id, $user_type) == 2) {
				$response = array('status'=>1, 'enabled'=>1, 'ver'=>2);
			} else {
				$response = array('status'=>0, 'enabled'=>1, 'ver'=>'ERR');
			}
 		} else {
			$response = array('status'=>0, 'enabled'=>0, 'ver'=>0);
 		}

 		echo json_encode($response);
 	}
public function checkVerifiedCredentials() {  //this is applicable for b2c user only as b2b user will already be verified at the time of sign up.
		if($this->session->userdata('user_id')){
            $data['user_type']=$user_type =$this->session->userdata('user_type');
            $data['user_id']=$user_id = $this->session->userdata('user_id');
        
        	$user_type = (string)$user_type;
        	$result = $this->verification_model->checkUserVerfication($user_id, $user_type)->row();
			
			$email_verified = $result->email_verify;
			$mobile_verified = $result->mobile_verify;
			if($email_verified == 1 AND $mobile_verified == 1) {
				return true;
			} else {
				return false;
			}
		}	
		else
		{
			return false;
		}
       
	}
	 /*Checks the verification type: email or mobile*/
	public function checkVerificationType($user_id, $user_type) {
		return $this->verification_model->checkVerificationType($user_id,$user_type);
	}
	public function generate_random_key($length = 50) {
        $alphabets = range('A','Z');
        $numbers = range('0','9');
        $final_array = array_merge($alphabets,$numbers);
        $id = '';
        while($length--) {
          $key = array_rand($final_array);
          $id .= $final_array[$key];
        }
        return $id;
    }
	 public function verifyTwoStepPassword() {
    	//$user_id = $this->session->userdata('temp_b2c_id');
    	if($this->session->userdata('temp_user_id')){
			$user_id = $this->session->userdata('temp_user_id');
			$user_type = $this->session->userdata('temp_user_type');
		}
    	$twoStepPwd = $this->input->post('twoStepPwd');
    	
    	if($userData = $this->verification_model->verifyTwoStepPassword($user_type,$user_id, $twoStepPwd)) {
			if(!empty($userData)) {
				if($this->session->userdata('temp_user_id')){
					$user_session =  array(
		                'user_id' => $userData->user_id,
		                'user_type' =>  $userData->user_type_id
	            	);
		    		$this->session->set_userdata($user_session);
				}
	    		$response = array('status' => '1');
    		} else {
    			$response = array('status' => '0');	
    		}    		
    	} else {
    		$response = array('status' => '0');
    	}
    	echo json_encode($response);
    }


	public function verifytwostep() {

		$ajaxRequest = $this->input->post('ajaxRequest');
		 
		if($this->session->userdata('temp_user_id')){
			$user_id = $this->session->userdata('temp_user_id');
			$user_type =  $this->session->userdata('temp_user_type');
		} 
		//$user_id = $this->session->userdata('temp_b2c_id');
		$data['email_id'] = $email_id = $this->session->userdata('temp_user_email_id');
		
		$getRedirectUrl = $_SERVER['QUERY_STRING'] ? $_SERVER['QUERY_STRING'] : '';
	 	if($getRedirectUrl != '') {
		 	$redirectUrlArray = explode('url=', $getRedirectUrl);
		 	if($redirectUrlArray[1] != '') {
		 		$data['redirectUrl'] = $redirectUrlArray[1];	
		 	} else {
		 		$data['redirectUrl'] = WEB_URL;
		 	}
		 } else {
		 	$data['redirectUrl'] = WEB_URL;
		 }


		$veriType = $this->checkVerificationType($user_id, $user_type);
		//die();	
		if($veriType == 1) {
			
			$verifyType = $veriType;
			$data['twoStepRandomNumber'] = $this->generate_random_key(4); //generate random number
	        $email_type = 'TWO_STEP_VERIFICATION';
	        $this->verification_model->updatePwdTwoStep($user_id, $user_type, $data['twoStepRandomNumber']);
	           $data['user_data'] = $this->general_model->get_user_details($user_id,$user_type);
			if($response = $this->email_model->twoStepVerifyEmail_send($data,$email_type)) {
				if(!empty($ajaxRequest) && $ajaxRequest==1 ) {
					$response = array('verifyType' => $verifyType, 'status' => 1);
					echo json_encode($response);
				} else {
					$data['verify_type'] = $verifyType;
					$this->load->view(PROJECT_THEME.'/security/verification_email', $data);	
				}
			}
		} 
		else if($veriType == 2){
			$verifyType = $this->checkVerificationType($user_id, $user_type);
			$data['twoStepRandomNumber'] = $this->generate_random_key(4); //generate random number
			
			$data['user_data'] = $this->account_model->getUserInfoEmail($email_id)->row();

			$user_contact_no = $data['user_data']->contact_no;
			
          

  
			$this->verification_model->updatePwdTwoStep($user_type, $user_id, $data['twoStepRandomNumber']);
			  $response = $this->sms_model->send_verifytwostep_sms($user_contact_no,$data['twoStepRandomNumber']);
			//$response = file(WEB_URL.'/security/mobile_test?test=hello world'); //get response from the url
		//	$response = file($sms_url); //get response from the url
			//echo '<pre>';print_r($response);die;
			
			if($response != "") {
				$response_array = explode(' ', $response[0]);
				
				$response_code_array = explode(';', $response[0]);
				$response_sms_global_id_array = explode(' ', $response_code_array[1]);
				$response_sms_global_id = $response_sms_global_id_array[6];
				$sms_global_id_array = explode(':', $response_sms_global_id);
				$sms_global_id = $sms_global_id_array[1];

				if($response_array[0] === "OK:" && $response_array[1] === "0;") {
					if(!empty($ajaxRequest) && $ajaxRequest==1 ) {
						$response = array('verifyType' => $verifyType, 'status' => 1);
						echo json_encode($response);
					} else {
						$data['verify_type'] = $verifyType;
						$this->load->view('security/verification_mobile_email', $data);	
					}
				}
			}
			
		}
	}
	public function problemLogIn() {
		$user_id = $this->session->userdata('temp_user_id');
		if($user_id != "") {
			$data['security_question'] = $this->verification_model->getSecurityQuestion($user_id);
				$this->load->view(PROJECT_THEME.'/security/problem_log_in', $data);	
		} else {
			redirect(WEB_URL);
		}
	}
	public function checkSecurityAnswer() {
		$user_id = $this->session->userdata('temp_user_id');
		$question = $this->input->post('qus');
		$answer = $this->input->post('ansec');
		
		$question_case = strtolower($question);
		$answer_case = strtolower($answer);

		$getData = $this->verification_model->checkSecurityAnswer($user_id);
		if($getData->security_question == $question && $getData->security_answer == $answer_case) {
			$this->session->set_userdata('temp_probLogin', 'PROB_LOGIN_SESSION');
			$response = array('status'=>1);
			echo json_encode($response);
		} else {
			$response = array('status'=>0);
			echo json_encode($response);
		}
	}
	

	 public function loginBySecurityAnswer() {
	 	$getRedirectUrl = $_SERVER['QUERY_STRING'] ? $_SERVER['QUERY_STRING'] : '';
	 	if($getRedirectUrl != '') {
		 	$redirectUrlArray = explode('url=', $getRedirectUrl);
		 	if($redirectUrlArray[1] != '') {
		 		$redirectUrl = $redirectUrlArray[1];	
		 	}
		 } else {
		 	$redirectUrl = WEB_URL;
		 }
	 	
    	$user_id = $this->session->userdata('temp_user_id');
    	$checkSession = $this->session->userdata('temp_probLogin');

			$user_type = $this->session->userdata('temp_user_type');
    	if($checkSession === 'PROB_LOGIN_SESSION' && $user_id != "" ) {
    		$b2c_session =  array(
				                'user_id' => $user_id,
				                'user_type' => $user_type 
			            	);
	    	$this->session->set_userdata($b2c_session);



	    	redirect($redirectUrl);

    	} else {
    		redirect(WEB_URL);
    	}
    	
    }
   public function checkPswrdAvail() {
   		  $data['user_type']=$user_type =$this->session->userdata('user_type');
            $data['user_id']=$user_id = $this->session->userdata('user_id');

		
			$checkPswrd = $this->general_model->get_user_details($user_id,$user_type);
		

    	if(trim($checkPswrd->password) == "" && isset($checkPswrd->password)) {
    		$checkEmailVer = $this->checkEmailVerification($user_id, $user_type);

    		if(empty($checkEmailVer)) {
 				$response = array('status'=>0, 'pswrdAvail'=>0, 'emailVerified'=>0);
 				echo json_encode($response);  //will cause redirect to verification page
    		} else {
    			$response = array('status'=>0, 'pswrdAvail'=>0, 'emailVerified'=>1);
    			echo json_encode($response);  //will send verification code
    		}
    	} else {
    		$response = array('status'=>1, 'pswrdAvail'=>1, 'emailVerified'=>2); //password is present already
    		echo json_encode($response);
    	}
    }
	 public function cancelAccountOneStepVerifyPswd() {
		 $data['user_type']=$user_type =$this->session->userdata('user_type');
            $data['user_id']=$user_id = $this->session->userdata('user_id');

		
    	$passwrd = $this->input->post('oneStepPwd');

    	$userInfo = $this->general_model->get_user_details($user_id,$user_type);
    	if($userInfo->password == $passwrd) {
			
			$user_status =  array(
		                'status' => 'CANCEL'
	            	);
					
			  $this->verification_model->update_user_status($user_status,$user_id,$user_type);
      $this->session->unset_userdata('sessionUserInfo');
        $this->session->sess_destroy();
 
    		$response = array('status'=>1, 'msg'=>'success'); //password is present already
    		echo json_encode($response);
    	} else {
    		$response = array('status'=>0, 'msg'=>'Wrong Password'); //password is present already
    		echo json_encode($response);
    	}

    }
	
	public function cancelAccountVerifyPswd() {
    	 $data['user_type']=$user_type =$this->session->userdata('user_type');
            $data['user_id']=$user_id = $this->session->userdata('user_id');

    	$twoStepPwd = $this->input->post('twoStepPwd');
    	
    	if($userData = $this->verification_model->verifyTwoStepPassword($user_type, $user_id, $twoStepPwd)) {
    		$cancelKey = 'CANCELACCOUNTDATA'.$user_id;
    		$this->session->set_userdata('cancel_key', $cancelKey);  //verify this when cancelling function is called
		    $response = array('status' => '1'); 		
    	} else {
    		$response = array('status' => '0');
    	}
    	echo json_encode($response);
    }

    public function cancelAccountData() { 
    	
			 $data['user_type']=$user_type =$this->session->userdata('user_type');
            $data['user_id']=$user_id = $this->session->userdata('user_id');

    	$cancelKey = $this->session->userdata('cancel_key');
    	if(isset($cancelKey) && $cancelKey != "" && $cancelKey == 'CANCELACCOUNTDATA'.$user_id) {
    		
			$user_status =  array(
		                'status' => 'CANCEL'
	            	);
					
			  $this->verification_model->update_user_status($user_status,$user_id,$user_type);
      $this->session->unset_userdata('sessionUserInfo');
        $this->session->sess_destroy();
 
    		$response = array('status'=>1, 'msg'=>'success'); //password is present already
    		echo json_encode($response);
    	}
		else {
    		$response = array('status'=>0, 'msg'=>'Failed'); //password is present already
    		echo json_encode($response);
    	}
    }

	public function cancelAccountSendCode() {

			 $data['user_type']=$user_type =$this->session->userdata('user_type');
            $data['user_id']=$user_id = $this->session->userdata('user_id');

		$verType = $this->input->post('ver');

		if($verType == 1) {
			
			$data['twoStepRandomNumber'] = $this->generate_random_key(4); //generate random number

			$data['user_data'] = $user_data = $this->general_model->get_user_details($user_id,$user_type);
			
			 $email_type = 'TWO_STEP_VERIFICATION';
	        $this->verification_model->updatePwdTwoStep($user_id, $user_type, $data['twoStepRandomNumber']);
			
			if($response = $this->email_model->twoStepVerifyEmail_send($data,$email_type)) {
				$response = array('verifyType' => $verType, 'status' => 1);
				echo json_encode($response);
			} else {
				$response = array('verifyType' => $verType, 'status' => 0);
				echo json_encode($response);
			}
		} else if($verType == 2){

			$data['twoStepRandomNumber'] = $this->generate_random_key(4); //generate random number
			
			$data['user_data'] = $user_data = $this->account_model->GetUserData($user_type, $user_id)->row();

			if($this->session->userdata('b2c_id')){
				$user_contact_no = $data['user_data']->contact_no;
			}else if($this->session->userdata('b2b_id')){
				$user_contact_no = $data['user_data']->mobile;
			}
			//$user_contact_no = $data['user_data']->contact_no;
		

			$this->verification_model->updatePwdTwoStep($user_id, $data['twoStepRandomNumber']);
			
			//$response = file(WEB_URL.'/security/mobile_test?test=hello world'); //get response from the url
			//$response = file($sms_url); //get response from the url
			 $response = $this->sms_model->send_verifytwostep_sms($user_contact_no,$data['twoStepRandomNumber']);
			if($response != "") {
				$response_array = explode(' ', $response[0]);
				
				$response_code_array = explode(';', $response[0]);
				$response_sms_global_id_array = explode(' ', $response_code_array[1]);
				$response_sms_global_id =  $response_sms_global_id_array[6];
				$sms_global_id_array = explode(':', $response_sms_global_id);
				$sms_global_id = $sms_global_id_array[1];

				if($response_array[0] === "OK:" && $response_array[1] === "0;") {
					$response = array('verType' => $verType, 'status' => 1);
					echo json_encode($response);	
				}
			}
			
		}
	}

	 public function cancel_account_success() {
		 
		 $this->load->view(PROJECT_THEME.'/common/cancel_account');	
	 }
    public function createCancelDataDump($user_id, $user_type) {
    	$all_user_data = $this->general_model->get_user_details($user_id,$user_type);
    	$filename = "cancel_user_".$user_id.".txt";

    	$fh = fopen('cancel_account_dump/'.$filename, "w");
		foreach($all_user_data as $key => $value) {
			$stringData = $key.":".$value."\n";
			fwrite($fh, $stringData);
		}

		return true;
    }
    
 public function checkEmailVerification($user_id, $user_type) {
    	return $this->account_model->checkTwoStepVerification($user_id, $user_type);
    }
/*Takes user to the actual enable verification page*/
	public function setUpTwoStep() {
		if($this->session->userdata('user_id')){
            $data['user_type']=$user_type =$this->session->userdata('user_type');
            $data['user_id']=$user_id = $this->session->userdata('user_id');
        
			$data['securityQuestionExist'] = $this->verification_model->checkSecurityQuestion($user_id,$user_type);	
		
		$user_type_string = (string)$user_type;

		$data['twoStepTypeEnabled'] = $this->verification_model->twoStepTypeEnabled($user_id, $user_type_string); //check what type of two step is enabled. Mobile or email type.
		
	    $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type_string);

		if($this->checkVerifiedCredentials()) {
			$this->load->view(PROJECT_THEME.'/security/enable_two_step_verification', $data); //start the two step verification
		} else {
			redirect(WEB_URL.'dashboard/profile/verifications','refresh');
		}
		}
		else
		{
			refdirect(WEB_URL,'refresh');
		}
	}
	 public function validatePassword(){
        
		$data['user_type']=$user_type =$this->session->userdata('user_type');
        $data['user_id']=$user_id = $this->session->userdata('user_id');
         $opassword =md5($this->input->post('opassword'));

        $status = $this->verification_model->validatePassword($user_id,$opassword)->num_rows();    
       #echo $this->db->last_query();die;
        if($status == 1){
            echo 'true';
        }else{
            echo "\"Your old password was incorrect. Please try again.\"";
        }
    }
	 public function ChangePassword(){
       $data['user_type']=$user_type =$this->session->userdata('user_type');
        $data['user_id']=$user_id = $this->session->userdata('user_id');
        
        $old_password=md5($_POST['opassword']);
        $new_password=md5($_POST['password']);
        $confirm_password=md5($_POST['cpassword']);
		
		if($new_password!=$confirm_password){
			$this->session->set_flashdata('password_msg','confirm_mismatch');
		}else{

	        $old_pass_check=$this->verification_model->validate_old_Password($user_id,$old_password);
			if($old_pass_check==0){
				$this->session->set_flashdata('password_msg','old_mismatch');
			}else{
				$update = array('password' => $new_password);
        		$check_update=$this->verification_model->update_user_password($update,$user_id,$user_type);
        		if($check_update=='1'){
        			$this->session->set_flashdata('password_msg','success_pass');
        		}else{
        			$this->session->set_flashdata('password_msg','somthing_wrong');
        		}
			}
		
		}
      	redirect('dashboard/change_pwd','refresh');
        
    }
    
 public function Update_security_question(){
        if($this->session->userdata('user_id')){
            $data['user_type']=$user_type =$this->session->userdata('user_type');
            $data['user_id']=$user_id = $this->session->userdata('user_id');
        }

        $security_question = mysql_real_escape_string($this->input->post('security_question'));
        if($this->input->post('security_question')=='')
        {
            $security_question = mysql_real_escape_string($this->input->post('security_question_own'));
        }
        $security_answer = mysql_real_escape_string($this->input->post('security_answer'));

    
       
			$this->verification_model->User_setSecurityQuestion($user_id,$user_type, $security_question, $security_answer);
		
        
        
        redirect(WEB_URL.'dashboard/settings');
    }
// /*This will update the security question via ajax call*/
	public function updateSecurityQuestionAnswer() {
		if($this->session->userdata('user_id')){
            $data['user_type']=$user_type =  $this->session->userdata('user_type');
            $data['user_id']=$user_id = $this->session->userdata('user_id');
        }

		$security_question = $this->input->post("security_question");
		$security_answer = $this->input->post("security_answer");
		
		
			$this->verification_model->User_setSecurityQuestion($user_id,$user_type, $security_question, $security_answer);
			echo json_encode("1");

		
	}

// /*This will be called by the ajax request and will enable the two step verification*/
	public function enableTwoStepVerification() {
		$verificationType = $this->input->post("verificationType"); //get the verification type via post; email: 1, Phone: 2
		$verificationEnable = '1';  //set the verification on 
		
		if($this->session->userdata('user_id')){
            $data['user_type']=$user_type = $this->session->userdata('user_type');
            $data['user_id']=$user_id = $this->session->userdata('user_id');
        } 
		
		if($this->reVerifyAllCredentials()) {
			$user_type_string = (string)$user_type;
			if($this->verification_model->enableTwoStepVerification($user_id, $user_type_string, $verificationType, $verificationEnable)) {
				
				$this->session->set_flashdata('twoStepEnabled', 'enabled');
				
				if($verificationType == 1) {
					$this->session->set_flashdata('twoStepEnableType', 'two_step_email');	
				} else {
					$this->session->set_flashdata('twoStepEnableType', 'two_step_phone');	
				}

				$response = array('status'=>1);
				echo json_encode($response);
			}	
		}
		
	}
	
// /*While activating the 2-step verification, the user will be reverified by this*/
	public function reVerifyAllCredentials() {
		if($this->session->userdata('user_id')){
            $data['user_type']=$user_type = $this->session->userdata('user_type');
            $data['user_id']=$user_id = $this->session->userdata('user_id');
        } 
		
		
		$user_verification = $this->verification_model->checkUserVerfication($user_id,$user_type)->row(); //get all data from the user_id
		
		if($user_verification->security_question != "" && $user_verification->security_answer !="") {
			 
			if($user_verification->email_verify == 1 && $user_verification->mobile_verify == 1) {
				return true;
			} else {
				return false;
			} 

		} else {
			return false;
		}
	}

public function disableTwoStepVerification() {
		if($this->session->userdata('user_id')){
            $data['user_type']=$user_type = $this->session->userdata('user_type');
            $data['user_id']=$user_id = $this->session->userdata('user_id');
        } 

        $user_type_string = (string)$user_type;
		if($this->verification_model->disableTwoStepVerification($user_id, $user_type_string)) {
			redirect(WEB_URL.'dashboard/settings');
		}
	}

}
















?>
