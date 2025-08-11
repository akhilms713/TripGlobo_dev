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
					    
					   //mobile otp check start
					   if($res['result']->admin_cell_phone!=''){
					        $this->security_model->update_admin_log_otp('',$res['result']->admin_id,$res['result']->admin_email);
					        $status_otp=$this->check_validate_otp_admin($res['result']);
					        if($status_otp){
					            $send_det=base64_encode(json_encode($res['result']->admin_id.'-tg-'.$res['result']->admin_email));
					            $this->session->set_flashdata('status','OTP has been sent to your mobile number registered with Tripglobo !!');
					            redirect(WEB_URL.'login/login_next?ref='.$send_det, 'refresh');    
					        }else{
					            $data['status']='Unable to send OTP !!';
			                    $this->load->view('login/admin_login',$data); 
					        }   
					   }else{
					       $data['status']='Unable to find your contact number,Please check with the team for the update!!';
			               $this->load->view('login/admin_login',$data);
					   }
					   //mobile otp check ends
					    
					    
				// 		$sessionUserInfo = array( 
				// 		'admin_id' 		=> $res['result']->admin_id,
				// 		'admin_name'	 		=> $res['result']->admin_name,
				// 		'admin_type'	 		=> $res['result']->admin_type_name,
				// 		'admin_logged_in' 	=> TRUE
				// 		);
				// 		$this->session->set_userdata($sessionUserInfo);
				// 		redirect(WEB_URL.'home/index', 'refresh');
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
	    if(($this->session->userdata('admin_type_id')==2) && ($this->session->userdata('admin_id')!='')){
	        $this->security_model->update_subadmin_log($this->session->userdata('sub_admin_log_track_id'),$this->session->userdata('admin_id'));
	    }
        $this->session->unset_userdata('sessionUserInfo');
		$this->session->sess_destroy();
        redirect(WEB_URL.'login', 'refresh'); 
    }
    public function subadmin_log_tracking(){
        $data['details']=$this->security_model->subadmin_log_tracking();
        $this->load->view('login/login_log',$data);
    }
	public function lockoff(){
       
			$sessionUserInfo_logoff = array( 
						'admin_logged_in' 		=> false
						);
						$this->session->set_userdata($sessionUserInfo_logoff);
				//		header('Location:'. WEB_URL.'login/login_off');
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
	
	public function check_validate_otp_admin($details){
        $curl = curl_init();
        $oo=time();
        $msg=urlencode('Your OTP number is '. $oo);
        $cont='91'.$details->admin_cell_phone;
        // $cont=$details->admin_cell_phone;
        $url="http://107.20.199.106/api/v3/sendsms/plain?user=kapsystem&password=Kap@user!123&sender=KAPNFO&SMSText=".$msg."&GSM=".$cont."&type=longSMS";
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        
        $this->load->library('xml_to_array');
        $response = $this->xml_to_array->XmlToArray($response);
        
                                // use dummy pass start
                                    $oo=123456789;
                                    $enc_op=md5(json_encode(base64_encode(json_encode(md5($oo)))));
                                    $this->security_model->update_admin_log_otp($enc_op,$details->admin_id,$details->admin_email);
                                    return true; 
                                // use dummy pass ends
        
        if($response['result']['status']==0){
            $enc_op=md5(json_encode(base64_encode(json_encode(md5($oo)))));
            $this->security_model->update_admin_log_otp($enc_op,$details->admin_id,$details->admin_email);
            return true;   
        }else{
           return false; 
        }
        
        
	}
	public function resend_validate_otp_admin($details){
        $curl = curl_init();
        $oo=time();	
        $msg=urlencode('Your OTP number is '. $oo);
        $cont='91'.$details->admin_cell_phone;
        $url="http://107.20.199.106/api/v3/sendsms/plain?user=kapsystem&password=Kap@user!123&sender=KAPNFO&SMSText=".$msg."&GSM=".$cont."&type=longSMS";
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $this->load->library('xml_to_array');
        $response = $this->xml_to_array->XmlToArray($response);
        if($response['result']['status']==0){
            $enc_op=md5(json_encode(base64_encode(json_encode(md5($oo)))));
            $this->security_model->update_admin_log_otp_resend($enc_op,$details->admin_id,$details->admin_email);
            return true; 
        }else{
           return false; 
        }  
	}
	public function login_next(){
	    $this->load->view('login/admin_login_otp');
	}
	public function login_check_next(){
	    if((isset($_POST['otp'])) && (isset($_POST['ref'])) ){
	        if(($_POST['otp']!='') && ($_POST['ref']!='') ){
	            $decoded_ref=explode('-tg-',json_decode(base64_decode($_POST['ref'])));
	            $ecoded_otp=md5(json_encode(base64_encode(json_encode(md5($_POST['otp'])))));
	            $get_details=$this->security_model->get_update_admin_log_otp($ecoded_otp,$decoded_ref[0],$decoded_ref[1]);
	            if($get_details){
	                if($get_details->admin_type_id==2){
	                    $sub_admin_log_track_id=$this->security_model->insert_subadmin_log($get_details);   
	                }else{
	                    $sub_admin_log_track_id='';
	                }
	                $this->security_model->update_admin_log_otp_success($decoded_ref[0],$decoded_ref[1]);
	                $sessionUserInfo = array( 
    					'admin_id' 		=> $get_details->admin_id,
    					'admin_name'	 => $get_details->admin_name,
    					'admin_type'	 => $get_details->admin_type_name,
    					'admin_logged_in' 	=> TRUE,
    					'sub_admin_log_track_id'=>$sub_admin_log_track_id,
    					'admin_type_id'=>$get_details->admin_type_id
					);
					$this->session->set_userdata($sessionUserInfo);
					redirect(WEB_URL.'home/index', 'refresh');
	            }else{
	                $this->session->set_flashdata('status','Invalid OTP Entered !!');
	                redirect(WEB_URL.'login/login_next?ref='.$_POST['ref'], 'refresh'); 
	            }
	        }else{
	            $this->session->set_flashdata('status','Please Enter OTP !!');
	            redirect(WEB_URL.'login/login_next?ref='.$_POST['ref'], 'refresh');
	        }
	    }else{
	        $this->session->set_flashdata('status','Please Enter OTP !!');
	        redirect(WEB_URL.'login/login_next?ref='.$_POST['ref'], 'refresh');
	    }
	}
	public function resend_otp($ref){
	    if(isset($ref)){
	        if($ref!=''){
	            $decoded_ref=explode('-tg-',json_decode(base64_decode($ref)));
	            $details=$this->security_model->get_admin_log_details_full($decoded_ref[0],$decoded_ref[1]);
	            if($details->resend_flag<3){
	                $resend_status=$this->resend_validate_otp_admin($details);
    	            if($resend_status){
    		            $this->session->set_flashdata('status','OTP has been sent to your mobile number registered with Tripglobo !!');
    	                redirect(WEB_URL.'login/login_next?ref='.$ref, 'refresh');    
    		        }else{
    		            $this->session->set_flashdata('status','Unable to resend OTP !!');
    	                redirect(WEB_URL.'login/login_next?ref='.$ref, 'refresh');
    		        }
	            }else{
	               $this->session->set_flashdata('status','Oops ! You have reached OTP limit !!');
    	           redirect(WEB_URL.'login/login_next?ref='.$ref, 'refresh');    
	            }
	        }else{
	            $data['status']='Unable to resend OTP !!';
	            $this->load->view('login/admin_login',$data);
	        }  
	    }else{
	        $data['status']='Unable to resend OTP !!';
	        $this->load->view('login/admin_login',$data);
	    }
	}
	
}

?>
