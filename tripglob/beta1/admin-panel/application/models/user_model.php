<?php
class User_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	function get_agent_details(){
	   $this->db->select('*');
	   $this->db->from('user_login_details');
	   $this->db->join('user_details', 'user_login_details.user_id = user_details.user_id');
	   $this->db->join('user_type', 'user_type.user_type_id = user_login_details.user_type_id');
	   //$this->db->where('user_type.user_type_id', 1);
	  // $this->db->where('user_details.status', 'ACTIVE');
	   $query =  $this->db->get()->result();
	   return $query;
   }
	public function get_country_details()
	{
		$this->db->select('*')->from('country_list');
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
	public function assignDefaultverfication($user_id,$user_type,$email_opt_number,$mobile_opt_number) {
		
		
		$verifi_str = $this->generate_random_key(50);
		$random_url_string = WEB_URL.'/agent/verification/'.$verifi_str;
		
		$data = array('user_type_id'=>$user_type,
		 'user_id'=>$user_id,
		 'temp_email_opt'=>$email_opt_number,
		 'temp_mobile_opt'=>$mobile_opt_number,
		 'verification_url'=>$random_url_string,
		 'verification_code'=>$verifi_str
		 );
		$this->db->insert('user_verifications', $data);
		return true;
	}
	public function get_allusers($user_type,$limit='',$start='')
	{
		 $this->db->select('user_login_details.*,user_type.*,user_details.*, address_details.*, country_list.country_name, user_accounts.balance_credit, user_accounts.last_credit, user_accounts.last_debit')
                ->from('user_login_details')
				->where('user_type.user_type_name',$user_type)
				->where('user_details.sa_status','ACTIVE')
				->order_by('user_details.user_id','desc')
                ->join('user_type', 'user_type.user_type_id  = user_login_details.user_type_id', 'left')
				 ->join('user_details', 'user_details.user_id  = user_login_details.user_id', 'left')
				 ->join('address_details', 'address_details.address_details_id  = user_details.address_details_id', 'left')
				 ->join('country_list', 'country_list.country_code  = address_details.country_code', 'left')
				 ->join('user_accounts', 'user_accounts.user_id  = user_details.user_id', 'left');

		if (!empty($limit) && $limit >= 0 && !empty($start) && $start >= 0)  
		{
			$this->db->limit($limit,$start);
		}
				
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

	public function get_allusers_row($user_type)
	{
       $this->db->select('user_login_details.*,user_type.*,user_details.*, address_details.*, country_list.country_name, user_accounts.balance_credit, user_accounts.last_credit, user_accounts.last_debit')
                ->from('user_login_details')
				->where('user_type.user_type_name',$user_type)
				->where('user_details.sa_status','ACTIVE')
				->order_by('user_details.user_id','desc')
                ->join('user_type', 'user_type.user_type_id  = user_login_details.user_type_id', 'left')
				 ->join('user_details', 'user_details.user_id  = user_login_details.user_id', 'left')
				 ->join('address_details', 'address_details.address_details_id  = user_details.address_details_id', 'left')
				 ->join('country_list', 'country_list.country_code  = address_details.country_code', 'left')
				 ->join('user_accounts', 'user_accounts.user_id  = user_details.user_id', 'left');
				
		$query=$this->db->get();
		return $query->num_rows();
	}
	public function get_allusers_status($user_type,$status,$limit='',$start='')
	{
        
		 $this->db->select('user_login_details.*,user_type.*,user_details.*, address_details.*, country_list.country_name, user_accounts.balance_credit, user_accounts.last_credit, user_accounts.last_debit')
                ->from('user_login_details')
				->where('user_type.user_type_name',$user_type)
				->where('user_details.status',$status)
				->where('user_details.sa_status','ACTIVE')
				->order_by('user_details.user_id','desc')
                ->join('user_type', 'user_type.user_type_id  = user_login_details.user_type_id', 'left')
				 ->join('user_details', 'user_details.user_id  = user_login_details.user_id', 'left')
				 ->join('address_details', 'address_details.address_details_id  = user_details.address_details_id', 'left')
				 ->join('country_list', 'country_list.country_code  = address_details.country_code', 'left')
				 ->join('user_accounts', 'user_accounts.user_id  = user_details.user_id', 'left');
		
		if (!empty($limit) && $limit >= 0 && !empty($start) && $start >= 0)  
		{
			$this->db->limit($limit,$start);
		}

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
	
	
	function get_allusers_status_row($user_type,$status){
		$this->db->select('user_login_details.*,user_type.*,user_details.*, address_details.*, country_list.country_name, user_accounts.balance_credit, user_accounts.last_credit, user_accounts.last_debit')
                ->from('user_login_details')
				->where('user_type.user_type_name',$user_type)
				->where('user_details.status',$status)
				->where('user_details.sa_status','ACTIVE')
				->order_by('user_details.user_id','desc')
                ->join('user_type', 'user_type.user_type_id  = user_login_details.user_type_id', 'left')
				 ->join('user_details', 'user_details.user_id  = user_login_details.user_id', 'left')
				 ->join('address_details', 'address_details.address_details_id  = user_details.address_details_id', 'left')
				 ->join('country_list', 'country_list.country_code  = address_details.country_code', 'left')
				 ->join('user_accounts', 'user_accounts.user_id  = user_details.user_id', 'left');
		$query=$this->db->get();
		return $query->num_rows();
	}

	
	
	public function get_user_details($id)
	{
		
		 $this->db->select('user_login_details.*,user_details.*,address_details.*, country_list.country_name')
                ->from('user_login_details')
				->where('user_login_details.user_id',$id)
				 ->join('user_details', 'user_details.user_id  = user_login_details.user_id', 'left')
				 ->join('user_login_access', 'user_login_access.user_id  = user_login_details.user_id', 'left')
				 ->join('address_details', 'address_details.address_details_id  = user_details.address_details_id', 'left')
				 ->join('country_list', 'country_list.country_code  = address_details.country_code', 'left');
				
		$query = $this->db->get();

		if ( $query->num_rows > 0 ) 
		{
			
			return $query->row();
	    }
		else
		{
			
			return '';
		}
	
	}
	
	
	public function get_verification_details($id)
	{
		
		 $this->db->select('*')
                ->from('user_verifications')
				->where('user_id',$id);
				
		$query = $this->db->get();

		if ( $query->num_rows > 0 ) 
		{
			
			return $query->row();
	    }
		else
		{
			
			return '';
		}
	
	}
	
	public function get_user_log_details($id)
	{
		
		 $this->db->select('*')
                ->from('user_failed_verifications')
				->where('user_id',$id);
				
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
	public function get_user_login_session_details($id)
	{
		//TIMESTAMPDIFF(HOUR,	login_tracking_details_start_time, login_tracking_details_end_time) as cal_days
		
		 $this->db->select('TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF( login_tracking_details_end_time,login_tracking_details_start_time )))), "%h:%i") AS diff')
                ->from('user_login_tracking_details')
				->where('user_login_tracking_details.user_id',$id)
				->where('login_status','OFFLINE');
		$query = $this->db->get();
echo $this->db->last_query();exit;
		if ( $query->num_rows > 0 ) 
		{
			
			return $query->result();
	    }
		else
		{
			
			return '';
		}
	}
	public function get_user_activity_details($id){		
		 $this->db->select('user_activity.*')
                ->from('user_activity')
				->where('user_activity.user_id',$id)
				->order_by('activity_timestamp','ASC')
				->limit(10);
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
	public function update_user_status($id,  $status){

		//echo $id;echo ">>>>>>>";echo $status;exit();


		$data = array(
			'status' => mysql_real_escape_string($status)
			
			);
		
			$where = "user_id = '$id'";
		if ($this->db->update('user_details', $data, $where)) {
			return true;
		} else {
			return false;
		}
   }
   
   	public function update_sa_status($id,  $status){
   	    
   	    
		$data = array(
			'sa_status' => mysql_real_escape_string($status)
			);
			$where = "user_id = '$id'";
		if ($this->db->update('user_details', $data, $where)) {
			return true;
		} else {
			return false;
		}
		
		
		
   }
   
   
   
   
   
   
   
   public function update_b2cuser_details($user_id,$username, $home_phone,$mobile_phone,$aadhar_card,$profile_picture='')
   {
   	if ($profile_picture=='') {   		
	   $data = array(
			'user_name' => mysql_real_escape_string(ucfirst($username)),
			'home_phone' => $home_phone,
			'mobile_phone' => $mobile_phone,
			'aadhar_card' => $aadhar_card,
			);
   	}else{
   		 $data = array(
			'user_name' => mysql_real_escape_string(ucfirst($username)),
			'home_phone' => $home_phone,
			'mobile_phone' => $mobile_phone,
			'profile_picture'=>$profile_picture,
			'aadhar_card'=>$aadhar_card,
			);
   	}
			$where = "user_id = '$user_id'";
		if ($this->db->update('user_details', $data, $where)) {
			return true;
		} else {
			return false;
		}
   }
   public function update_user_details($user_id,$username, $iatacode,$branch,$mobile_phone,$c_p_name,$c_p_designation,$c_p_email,$c_p_phone)
   {
	   $data = array(
			'user_name' => mysql_real_escape_string(ucfirst($username)),
			'iata' => mysql_real_escape_string($iatacode),
			'no_branch' => mysql_real_escape_string($branch),
			
			'mobile_phone' => mysql_real_escape_string($mobile_phone),
			'c_p_name' => mysql_real_escape_string($c_p_name),
			'c_p_designation' => mysql_real_escape_string($c_p_designation),
			'c_p_email' => mysql_real_escape_string($c_p_email),
			'c_p_phone' => mysql_real_escape_string($c_p_phone)
			
			
			);
		
			$where = "user_id = '$user_id'";
		if ($this->db->update('user_details', $data, $where)) {
			return true;
		} else {
			return false;
		}
   }
    public function update_user_address_details($address_details_id,$address, $city_name,$state_name,$zip_code,$country_name)
   {
	   $data = array(
			'address' => mysql_real_escape_string($address),
			'city_name' => mysql_real_escape_string($city_name),
			'state_name' => mysql_real_escape_string($state_name),
			'zip_code' => mysql_real_escape_string($zip_code),
			'country_code' => mysql_real_escape_string($country_name)
			
			);
		
			$where = "address_details_id = '$address_details_id'";
		if ($this->db->update('address_details', $data, $where)) {
			return true;
		} else {
			return false;
		}
   }
   
   public function get_usertype_id($user_type_name){	
		$this->db->where('user_type_name', $user_type_name);
		$this->db->from('user_type');
		$query = $this->db->get(); 
		//echo $this->db->last_query();exit(); 		
		if ($query->num_rows() > 0) {
			$a = $query->row();
			return $a->user_type_id;
		}else{
			return '';
		}
	}
	
   public function isRegistered($email,$user_type_id){
		$this->db->where('user_login_details.user_email_id', $email);
		$this->db->where('user_login_details.user_type_id', $user_type_id);
		$this->db->join('user_details', 'user_details.user_id = user_login_details.user_id','LEFT');
		return $this->db->get('user_login_details');
	}
	
	public function isRegistered_cancel($email,$user_type_id){
		$this->db->where('user_login_details.user_email_id', $email);
		$this->db->where('user_login_details.user_type_id', $user_type_id);
		$this->db->where('user_details.status', 'CANCEL');
		$this->db->join('user_details', 'user_details.user_id = user_login_details.user_id','LEFT');
		return $this->db->get('user_login_details');
	}
	
	
	
	public function createUsers_staff($postData,$user_type_id,$image){

		$address_data['address']= $postData['address'];
		$address_data['city_name']= $postData['city_name'];
		$address_data['state_name']= $postData['state_name'];
		$address_data['zip_code']= $postData['zip_code'];
		$address_data['country_code'] = $postData['country_code'];
		
		$this->db->insert('address_details',$address_data);
		$address_id = $this->db->insert_id();
		
		$user_info['iata'] = '';
		$user_info['no_branch'] = '';
		
		$user_info['c_p_name'] = '';
		$user_info['c_p_designation'] = '';
		$user_info['c_p_email'] = '';
		$user_info['c_p_phone'] = '';
		
		$user_info['user_name'] = $postData['fname'];
		//$user_info['sub_user_id'] = $this->session->userdata('user_id');
		$user_info['mobile_phone'] = $postData['phone_number'];
			
		$user_info['user_email'] = $postData['email'];
		
		$user_info['status'] = 'ACTIVE';
		$user_info['address_details_id'] = $address_id;
		$user_info['profile_picture'] = $image;
		$user_info['aadhar_card'] = $postData['aadhar_card'];
		
		$user_info['user_creation_date_time'] = date('Y-m-d H:i:s');
		$this->db->insert('user_details',$user_info);
		$user_details_id = $this->db->insert_id();
		
		$user_login_details['user_email_id'] = $postData['email'];
		$user_login_details['password'] = md5($postData['password']);
		$user_login_details['user_id'] = $user_details_id;
		$user_login_details['user_type_id'] = $user_type_id;
		$this->db->insert('user_login_details',$user_login_details);
		$user_id =$this->db->insert_id();
	
		$user_login_access['via_email'] = $postData['email'];
		$user_login_access['user_id'] = $user_details_id;
		$this->db->insert('user_login_access',$user_login_access);
		 return $user_details_id;
		
	}
	/*New Block Code*/
	public function get_block_status($user_type,$status)
	{

		 $this->db->select('user_login_details.*,user_type.*,user_details.*, address_details.*, country_list.country_name, user_accounts.balance_credit, user_accounts.last_credit, user_accounts.last_debit')
                ->from('user_login_details')
				->where('user_type.user_type_name',$user_type)
				->where('user_details.sa_status',$status)
				->order_by('user_details.user_id','desc')
                ->join('user_type', 'user_type.user_type_id  = user_login_details.user_type_id', 'left')
				 ->join('user_details', 'user_details.user_id  = user_login_details.user_id', 'left')
				 ->join('address_details', 'address_details.address_details_id  = user_details.address_details_id', 'left')
				 ->join('country_list', 'country_list.country_code  = address_details.country_code', 'left')
				 ->join('user_accounts', 'user_accounts.user_id  = user_details.user_id', 'left');
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
	
	public function staff_log_tracking(){
        $this->db->select('staff_login_tracking.*,user_details.user_name,user_details.user_email');
        $this->db->join('user_details', 'user_details.user_id = staff_login_tracking.staff_id','left');
        $this->db->from('staff_login_tracking');
        $this->db->order_by('staff_login_tracking.id',DESC);
        $query = $this->db->get();
        if ( $query->num_rows > 0 ){
				return $query->result();	
		}else{
			return false;	
		}
   }
   
	/*New Block Code*/
	
/* get all bus trip*/
	
	function getallBusTrip(){
	   $this->db->select('*');
	   $this->db->from('special_bus_trip');
	   $query =  $this->db->get()->result();
	   return $query;
   }
	
}
