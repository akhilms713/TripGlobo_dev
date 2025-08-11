<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Security_Model extends CI_Model {

	public function admin_ip_track($type)
   	{
		
		$data = array(
		'admin_id' => ADMIN_ID,
		'login_track_details_ip' => CLIENT_ADDR,
		'login_track_details_system_info' => HTTP_USER_AGENT,
		'attempt' => mysql_real_escape_string($type),
		'login_track_status_info' => $_SERVER['REMOTE_ADDR'].'||'.$_SERVER['REMOTE_PORT']
		);
		$this->db->insert('admin_login_tracking_details', $data);
		return $this->db->insert_id();
   }
	 public function check_admin_pattern($pattern)
   	{
		$pattern=mysql_real_escape_string($pattern);
		$aa = "SELECT admin_id FROM admin_login_details WHERE admin_pattren='$pattern' AND admin_id='".ADMIN_ID."'";
		$query = $this->db->query($aa);
		if ( $query->num_rows > 0 ) 
		{
			return 1;	
	    }
		else
		{
			return 0;
		}
   }
    public function check_admin_login($username,$password,$pattern)
   	{
		$username=mysql_real_escape_string($username);
		//$password=mysql_real_escape_string($this->CI_encript_pass($password));
		$password=md5(mysql_real_escape_string($password));//echo md5($password);exit;
		$pattern=mysql_real_escape_string($pattern);
		
		 $this->db->select('admin_login_details.*,admin_details.*,admin_type.admin_type as admin_type_name')
                ->from('admin_login_details')
				->where('admin_login_details.admin_user_name',$username)
				->where('admin_login_details.admin_password',$password)
				->where('admin_login_details.admin_pattren',$pattern)
                ->join('admin_details', 'admin_login_details.admin_id  = admin_details.admin_id', 'left')
				->join('admin_type', 'admin_type.admin_type_id  = admin_login_details.admin_type_id', 'left');
				
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) 
		{
			$data['result']=$query->row();
			return $data;	
	    }
		else
		{
			$data['result']='';
			return $data;
		}
   }
	 public function get_admin_details()
   	{
		if($this->session->userdata('sa_id'))
		{
		$admin_id =$this->session->userdata('sa_id');
		$this->db->select('*')->from('super_admin_details')->where('super_admin_id', $admin_id)->where('super_admin_status', 'ACTIVE');
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
		else
		{
			return '';	
		}
   }
   public function admin_pattern_check($pattern)
   	{
		if($this->session->userdata('admin_id'))
		{
		$admin_id =$this->session->userdata('admin_id');
		$this->db->select('*')->from('admin_login_details')->where('admin_id', $admin_id)->where('admin_pattren', $pattern);
		$query = $this->db->get();
	
    	if ( $query->num_rows > 0 ) 
		{
				return true;	
		}
		else
		{
			return false;	
		}
		}
		else
		{
			return false;	
		}
   }
   public function update_admin_log_otp($otp,$admin_id,$email){
        $data=array(
                'access_one_code'=>$otp,
                'resend_flag'=>0,
            );
        $this->db->where('admin_id', $admin_id);
        $this->db->where('admin_email', $email);
        $this->db->update('admin_details', $data);
   }
   
   public function get_update_admin_log_otp($otp,$admin_id,$email){
        $this->db->select('admin_details.admin_id,admin_details.admin_name,admin_type.admin_type as admin_type_name,admin_login_details.admin_type_id');
        $this->db->where('admin_details.admin_id', $admin_id);
        $this->db->where('admin_details.admin_email', $email);
        // $this->db->where('admin_details.access_one_code', $otp);
        $this->db->join('admin_login_details', 'admin_login_details.admin_id = admin_details.admin_id','left');
        $this->db->join('admin_type', 'admin_type.admin_type_id  = admin_login_details.admin_type_id', 'left');
        $this->db->from('admin_details');
        $query = $this->db->get();
        if ( $query->num_rows > 0 ){
				return $query->row();	
		}else{
			return false;	
		}
   }
   public function subadmin_log_tracking(){
        $this->db->select('subadmin_login_tracking.*,admin_details.admin_name,admin_details.admin_email');
        $this->db->join('admin_details', 'admin_details.admin_id = subadmin_login_tracking.subadmin_id','left');
        $this->db->from('subadmin_login_tracking');
        $this->db->order_by('subadmin_login_tracking.id',DESC);
        $query = $this->db->get();
        if ( $query->num_rows > 0 ){
				return $query->result();	
		}else{
			return false;	
		}
   }
   
   public function insert_subadmin_log($details){
        $data = array(
    		'subadmin_id' =>$details->admin_id,
    		'login_time' =>date("Y-m-d H:i:s"),
    		'logout_time' =>'',
    		'ip_address' => $_SERVER['REMOTE_ADDR'].'||'.$_SERVER['REMOTE_PORT']
    	);
		$this->db->insert('subadmin_login_tracking', $data);
		return $this->db->insert_id();
   }
   public function update_subadmin_log($id,$subadmin_id){
        $data=array(
                'logout_time'=>date("Y-m-d H:i:s"),
            );
        $this->db->where('id', $id);
        $this->db->where('subadmin_id', $subadmin_id);
        $this->db->update('subadmin_login_tracking', $data);
   }
   
   public function update_admin_log_otp_success($admin_id,$email){
        $data=array(
                'access_one_code'=>'',
                'resend_flag'=>0,
            );
        $this->db->where('admin_id', $admin_id);
        $this->db->where('admin_email', $email);
        $this->db->update('admin_details', $data);
   }
   public function get_admin_log_details_full($admin_id,$email){
        $this->db->select('admin_id,admin_email,admin_cell_phone,resend_flag');
        $this->db->where('admin_id', $admin_id);
        $this->db->where('admin_email', $email);
        $this->db->from('admin_details');
        $query = $this->db->get();
        if ( $query->num_rows > 0 ){
				return $query->row();	
		}else{
			return false;	
		}
   }
   public function update_admin_log_otp_resend($otp,$admin_id,$email){
        $data=array(
                'access_one_code'=>$otp,
            );
        $this->db->set('resend_flag', 'resend_flag+1', FALSE);
        $this->db->where('admin_id', $admin_id);
        $this->db->where('admin_email', $email);
        $this->db->update('admin_details', $data);
   }
   
   
   
}

?>
