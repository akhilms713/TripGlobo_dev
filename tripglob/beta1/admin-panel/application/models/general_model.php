<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General_Model extends CI_Model {

	
	public function get_promo_list()
	{
		$this->db->select('*')->from('promo');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) 
		{
			return $query->result();	
		}
		else
		{
			return '';	
		}
	}
	public function get_user_details($user_id,$user_type){
		$this->db->select('user_login_details.*,user_details.*,user_verifications.*,user_type.user_type_name,user_accounts.*');
		$this->db->where('user_login_details.user_id', $user_id);
		//$this->db->where('user_login_details.user_login_details_id', $user_id);
		$this->db->where('user_login_details.user_type_id', $user_type);
		$this->db->join('user_details', 'user_details.user_id=user_login_details.user_id', 'left');
		$this->db->join('user_verifications', 'user_verifications.user_id=user_login_details.user_id', 'left');
		$this->db->join('user_type', 'user_type.user_type_id=user_login_details.user_type_id', 'left');
		$this->db->join('user_accounts', 'user_accounts.user_id=user_login_details.user_id', 'left');
		
		$this->db->from('user_login_details');

		$query = $this->db->get();   
		
		if ($query->num_rows() > 0) {
			 
			return $query->row();
		}else{
			return false;
		}
	}
	public function get_country_details($country_id = ''){
		$this->db->select('*');
		$this->db->from('country_details');
		if($country_id !='')
			$this->db->where('country_id', $country_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		} else {
			return $query->result();
		}
	}
	function error_message($title,$status)
	{
		$data='';
		if($status!='')
		{
			if($status==1)
			{
				$data['status_tag']= 'success';
				
				$data['status_msg'] = $title.' Added Successfully.';
			}
			elseif($status==11)
			{
				$data['status_tag']= 'error';
				$data['status_msg'] = 'Duplicate Data Occurred.';
			}
			elseif($status==12)
			{
				$data['status_tag']= 'success';
				$data['status_msg'] = $title.' Updated Successfully.';
			}
			elseif($status==13)
			{
				$data['status_tag']= 'error';
				$data['status_msg'] = $title.' Deleted.';
			}
			else
			{
				$data['status_tag']= 'error';
				$data['status_msg'] = 'Error Occurred. Try Again.';
			}
			$data['status']= $status;
		}
		return $data;
	}
	public function get_side_bar_menu($group='',$where='',$module='')
	{
		if($this->session->userdata('admin_id')!= ADMIN_ID)
		{
 			$sub_admin_id = $this->session->userdata('admin_id');
			$this->db->where('admin_role_details.admin_id',$sub_admin_id);
		}
		if($where!='')
		{
			
			$this->db->where('privilege_title',$where);
		}
		if($module!='')
		{
			$this->db->where('privilege_module',$module);
		}
		//$this->db->where('privilege_functions.menu_status','ACTIVE');
		$this->db->join('privilege_admin_roles', 'privilege_admin_roles.admin_role_id = admin_role_details.admin_roles_id','right');
		$this->db->join('privilege_actions', 'privilege_actions.privilege_id = privilege_admin_roles.privilege_id','right');
			$this->db->join('privilege_functions', 'privilege_functions.privilege_functions_id = privilege_actions.privilege_functions_id','left');
	 
		if($group!='')
		{
			$this->db->group_by($group);
		}
		$query = $this->db->get('admin_role_details');
		
		if ( $query->num_rows > 0 ) 
		{
			return $query->result();	
			
		}
		else
		{
			return '';	
		}
	}
	public function get_side_bar_menu_v1($group='',$where='',$module='')
	{
	    //echo ADMIN_ID;exit('jafjasjkghksaljg');
		if($this->session->userdata('admin_id')!= ADMIN_ID)
		{
 			$sub_admin_id = $this->session->userdata('admin_id');
			$this->db->where('admin_role_details.admin_id',$sub_admin_id);
			
			
		if($where!='')
		{
			$this->db->where('privilege_title',$where);
		}
		if($module!='')
		{
			$this->db->where('privilege_module',$module);
		}
		$this->db->where('privilege_functions.menu_status','ACTIVE');
		$this->db->join('privilege_admin_roles', 'privilege_admin_roles.admin_role_id = admin_role_details.admin_roles_id','right');
		$this->db->join('privilege_actions', 'privilege_actions.privilege_id = privilege_admin_roles.privilege_id','right');
		$this->db->join('privilege_functions', 'privilege_functions.privilege_functions_id = privilege_actions.privilege_functions_id','left');
	 
	    //$this->db->order_by('privilege_functions.privilege_functions_id','ASC');
	    
		if($group!='')
		{
			$this->db->group_by($group);
		}
		$query = $this->db->get('admin_role_details');
		
		//ORDER BY `privilege_functions`.`privilege_functions_id` ASC
		
		
		
		
		//$this->db->order_by('privilege_functions.privilege_functions_id','DESC');
		
		if ( $query->num_rows > 0 ) 
		{
			return $query->result();	
			
		}
		else
		{
			return '';	
		}
		}
		else
		{
		if($where!='')
		{
			
			$this->db->where('privilege_title',$where);
		}
		if($module!='')
		{
			$this->db->where('privilege_module',$module);
		}
		$this->db->where('privilege_functions.menu_status','ACTIVE');
		
	 
		if($group!='')
		{
			$this->db->group_by($group);
		}
		$this->db->order_by('privilege_title','DESC');
		$query = $this->db->get('privilege_functions');
		
		if ( $query->num_rows > 0 ) 
		{
			return $query->result();	
			
		}
		else
		{
			return '';	
		}
		}
		
	}
	function get_user_type($user_type)
	{
		$this->db->select('*')->from('user_type')->where('user_type_name',$user_type)->where('status','ACTIVE');
		$query = $this->db->get();
		//print_r($query); exit;
		if ( $query->num_rows > 0 ) 
		{
			$a = $query->row();	
			return $a->user_type_id;
		}
		else
		{
			return '';	
		}
	}
	
	function sendMail($bodyContent,$email,$subject){
		
		include_once('../assets/PHPMailer/class.phpmailer.php');		 
		$emaiConfiguration = $this->getEmailSettings();		
		$mail = new PHPMailer();
		$mail->isSMTP();
        $mail->Host     =$emaiConfiguration->host;
        $mail->SMTPAuth = true;
        $mail->Username = $emaiConfiguration->username;
        $mail->Password = $emaiConfiguration->password;
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = $emaiConfiguration->port;
        $mail->setfrom($emaiConfiguration->username, 'TRIPGLOBO');        
        $mail->addaddress($email);    
        $mail->addcc('poovarasan.g@provabmail.com');    
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $bodyContent;
       
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            // redirect(WEB_URL.'subscriber/all_subscriber','refresh');
        }
		
	}
	
	function getEmailSettings(){
		$this->db->select('*');
		$this->db->from('email_access');
		$this->db->where('status','ACTIVE');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
		
	}
	public function get_home_page_settings(){
		// $colors 				= array('black','blue','cafe','purple','red','white','yellow');
		$colors 				= array('');
		$color_key 				= array_rand($colors, 1);
		$data['color'] 			= $colors[$color_key];
		
		$transitions 			= array('page-left-in','page-right-in','page-fade','page-fade-only');
		$transition_key 		= array_rand($transitions, 1);
		$data['transition'] 	= $transitions[$transition_key];
		
		// $headers				= array('header_left','header_top','header_right');
		$headers				= array('header_left');
		$header_key 		    = array_rand($headers, 1);
		$data['header'] 	    = $headers[$header_key];
		$data['header'] 	    = $headers[$header_key];
		// $data['sidebar'] 	    = "sidebar-collapsed";
		$data['sidebar'] 	    = "";
		
		return $data;
	}

	/* show supplier_list data */
  public function feedback_list(){
      $this->db->select('*');
      $this->db->from('user_feedback');
      //$this->db->group_by('airport_code');
       return $this->db->get();
  }	
  
  public function get_passenger_ticket($id){
      $this->db->select('*');
      $this->db->from('passenger_ticket_reports');
      $this->db->where('booking_passenger_id',$id);
      $query=$this->db->get();
      return $query->row_array();
  }	
	
}

?>
