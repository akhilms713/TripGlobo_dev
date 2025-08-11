<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verification_Model extends CI_Model {
  public function getSMSalertList($user_id, $user_type) {
        $this->db->select('*');
        $this->db->from('user_sms_alert');
        $query = $this->db->get()->result();
        return $query;
    }
 public function checkVerificationType($user_id,$user_type) {
        $where = "user_id = ".$user_id." AND user_type_id='".$user_type."'" ;

        $this->db->select('*');
        $this->db->from('user_verifications');
        $this->db->where($where);

        $result_object = $this->db->get()->row();

        if(!empty($result_object)) {
           if($result_object->two_step_type == 1) {
            return '1';
           } else if($result_object->two_step_type == 2) {
            return '2';
           } else {
            return false;
           }
        }
    }
	 public function updatePwdTwoStep($user_id,$user_type, $twoStepRandomNumber) {
        $update = array(
            'temp_email_opt' => $twoStepRandomNumber
        );
        
            $this->db->where('user_id', $user_id);  $this->db->where('user_type_id', $user_type);
            return $this->db->update('user_verifications', $update);
        
        
    }
	 public function update_user_status($user_status,$user_id,$user_type) {
       
            $this->db->where('user_id', $user_id);   
            return $this->db->update('user_details', $user_status);
        
        
    }
	  public function getSecurityQuestion($user_id) {
        $this->db->select('security_question');
        $this->db->from('user_verifications');
        $this->db->where('user_id', $user_id);

        $query = $this->db->get();
        return $query->row();
    } 
	
    public function checkSecurityAnswer($user_id) {
        $this->db->select('user_id, security_question, security_answer');
        $this->db->from('user_verifications');
        $this->db->where('user_id', $user_id);

        $query = $this->db->get();
        return $query->row();
    }
 public function verifyTwoStepPassword($user_type,$user_id, $twoStepPwd) {
        $this->db->select('*');
        
            $this->db->from('user_verifications');
            $this->db->where('user_id', $user_id);
			 $this->db->where('user_type_id', $user_type);
	        $this->db->where('temp_email_opt', $twoStepPwd);

        if($query = $this->db->get()) {
            if($query->num_rows() == 1) {
                return $query->row();
            } else {
                return false;
            }
        }
    }
    public function getSMSalertData($user_id, $user_type) {
        $this->db->select('a.*, b.*');
        $this->db->from('user_sms_alert a');
        $this->db->join('user_sms_alert_enabled b', 'a.user_sms_alert_id = b.alert_action_id');
        $this->db->where('b.user_id', $user_id);
        $this->db->where('b.user_type', $user_type);
        $query = $this->db->get()->result();
        return $query;
    }
		public function checkUserVerfication($user_id, $user_type) {
        $this->db->where('user_id', $user_id);
        $this->db->where('user_type_id', (string)$user_type); 
        return $this->db->get('user_verifications');
    }
	
    public function enableTwoStepVerification($user_id, $user_type, $verificationType, $verificationEnable){
        $this->db->where('user_id', $user_id);
        $this->db->where('user_type_id', $user_type);
        $data = array('two_step_verification'=>$verificationEnable, 'two_step_type'=>$verificationType);
        if($this->db->update('user_verifications', $data)) {
            return true;    
        }
    }
	    public function disableTwoStepVerification($user_id, $user_type) {
        $data = array('two_step_verification'=>'0', 'two_step_type'=>0);
        $this->db->where('user_id', $user_id);
        $this->db->where('user_type_id', $user_type);
        $this->db->update('user_verifications', $data);        
        return true;
    }
	public function validatePassword($user_id,$opassword){
		$this->db->where('user_id', $user_id);
		$this->db->where('password', $opassword);
		return $this->db->get('user_login_details');
	}
	public function update_user_password($update,$user_id,$usertype){
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type_id', $usertype);
		if($this->db->update('user_login_details', $update)) {
			return true;
		}
	}
	 public function checkSecurityQuestion($user_id, $user_type_id){
        $this->db->select('security_question, security_answer');
        $this->db->from('user_verifications');
        $this->db->where('user_id', $user_id);
		$this->db->where('user_type_id', $user_type_id);

        return $this->db->get()->row();
    }
	    public function twoStepTypeEnabled($user_id, $user_type) {
        $this->db->select('two_step_verification, two_step_type');
        $this->db->from('user_verifications');
        $this->db->where('user_id', $user_id);
        $this->db->where('user_type_id', $user_type);

        return $this->db->get()->row();
    }
	public function isTwoStepEnabled($user_id, $user_type) {
        $this->db->where('user_id', $user_id);
        $this->db->where('user_type_id', $user_type);
        $query = $this->db->get('user_verifications')->row();
        if(!empty($query)) {
            if($query->two_step_verification == 1) {
                return true;
            } else {
                return false;
            }    
        } else {
            return false;
        }
    }
 public function User_setSecurityQuestion($user_id,$user_type, $security_question, $security_answer) {
        $this->db->where('user_id', $user_id); 
		$this->db->where('user_type_id', $user_type);
		
        $data = array('security_question'=>$security_question, 'security_answer'=>$security_answer);
        if($this->db->update('user_verifications', $data)) {
            return true;
        }
    }
 
	 public function updateUserVerification($b2c_id,$update){
        $this->db->where('user_id', $b2c_id);
        return $this->db->update('user_verifications',$update);
    }

    public function validate_old_Password($user_id,$opassword){
        $this->db->select('user_type_id');
        $this->db->from("user_login_details");
        $this->db->where('user_id', $user_id);
        $this->db->where('password', $opassword);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return 1;
        }else{
            return 0;
        } 
    }

}

?>