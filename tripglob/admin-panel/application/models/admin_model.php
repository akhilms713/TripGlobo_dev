<?php
class Admin_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	public function get_admin_details()
	{
		$admin_id =$this->session->userdata('admin_id');
		$this->db->select('admin_details.*,address_details.*, country_list.country_name,admin_login_details.admin_pattren')->from('admin_details')->where('admin_details.admin_id', $admin_id)->where('admin_details.admin_status', 'ACTIVE')
		->join('address_details', 'address_details.address_details_id = admin_details.address_details_id', 'left')->join('country_list', 'country_list.country_code = address_details.country_code', 'left')->join('admin_login_details', 'admin_login_details.admin_id = admin_details.admin_id', 'left');
		
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if ( $query->num_rows > 0 ) 
		{
			return $query->row();	
		}
		else
		{
			return '';	
		}
	}
	
		public function get_admin_details_id($admin_id){
			$this->db->select('admin_details.*,address_details.*, country_list.country_name,admin_login_details.admin_pattren')->from('admin_details')->where('admin_details.admin_id', $admin_id)
		->join('address_details', 'address_details.address_details_id = admin_details.address_details_id', 'left')->join('country_list', 'country_list.country_code = address_details.country_code', 'left')->join('admin_login_details', 'admin_login_details.admin_id = admin_details.admin_id', 'left');
		
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if ( $query->num_rows > 0 ) 
		{
			return $query->row();	
		}
		else
		{
			return '';	
		}
	}
	
	
	
	
	 public function check_admin_email_id($username)
   	{
		$username=mysql_real_escape_string($username);
		
		 $this->db->select('admin_login_details.*')
                ->from('admin_login_details')
				->where('admin_login_details.admin_user_name',$username);
				
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) 
		{
			 
			return false;	
	    }
		else
		{
			
			return true ;
		}
   }
    public function update_user_status($id,  $status)
   	{
		$data = array(
			'admin_status' => mysql_real_escape_string($status)
			
			);
		
			$where = "admin_id = '$id'";
		if ($this->db->update('admin_details', $data, $where)) {
			return true;
		} else {
			return false;
		}
   }
	public function get_subadmin_details()
	{
		$this->db->select('admin_details.*,address_details.*, country_list.country_name,admin_role.*')->from('admin_details')->where('admin_login_details.admin_type_id !=', '1') 
		->join('address_details', 'address_details.address_details_id = admin_details.address_details_id', 'left')
		->join('admin_login_details', 'admin_login_details.admin_id = admin_details.admin_id', 'left')
		->join('admin_role_details', 'admin_role_details.admin_id = admin_details.admin_id', 'left')
		->join('admin_role', 'admin_role.admin_role_id = admin_role_details.admin_roles_id', 'left')
		->join('country_list', 'country_list.country_code = address_details.country_code', 'left');
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

	public function get_role_details()
	{
		$this->db->select('admin_role.*')->from('admin_role');
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
	function update_admin_password($password='')
	{
		if (!empty($password)) {
			$data['admin_password'] = md5($password);	
			$where = "admin_id = ".ADMIN_ID;
			if ($this->db->update('admin_login_details', $data, $where)) {
				return true;
			} else {
				return false;
			}		
		}
		else {
			return false;
		}
	}
	public function get_admin_role_details($id="")
	{
		if ($id != null || $id != "") {
			$this->db->select('*')->from('admin_role');
			$this->db->where("admin_role_id", $id);
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
		else{
			$this->db->select('*')->from('admin_role');
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
		
	}
	
	public function check_admin_password($password)
	{
		
		$password=mysql_real_escape_string($password);
		$aa = "SELECT admin_id FROM admin_login_details WHERE admin_password='$password' AND admin_id='".ADMIN_ID."'";
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

	function add_privileges($data){
		if($this->db->insert('privilege', $data)){
			return true;
		}else{
			return false;
		}
	}

	function get_privilege($privilege_id){
		$this->db->where("privilege_id",$privilege_id);
		$query = $this->db->get('privilege');

		if ( $query->num_rows > 0 ) 
		{
			return $query->result();	
		}
		else
		{
			return '';	
		}
	}

	function update_privilege($privilege_id, $data){
		$this->db->where("privilege_id",$privilege_id);
		if($this->db->update('privilege', $data)){
			return true;
		}else{
			return false;
		}
	}

	function delete_privilege($privilege_id){
		$this->db->where("privilege_id",$privilege_id);
		if($this->db->delete('privilege')){
			return true;
		}else{
			return false;
		}
	}
	public function get_privileges()
	{
		$this->db->select('*')->from('privilege');
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

	function get_privilege_functions(){
		$this->db->select('*');
		$this->db->where('menu_status','ACTIVE');
		$query = $this->db->get('privilege_functions');

		// echo $this->db->last_query(); die();

		if ( $query->num_rows > 0 ) 
		{
			return $query->result();	
		}
		else
		{
			return '';	
		}
	}

	function get_privilege_active_functions($privilege_id){
		$this->db->where("privilege_id",$privilege_id);
		$this->db->select('privilege_actions.privilege_functions_id');
		$query = $this->db->get('privilege_actions');

		// echo $this->db->last_query(); die();

		if ( $query->num_rows > 0 ) 
		{
			return $query->result_array();	
		}
		else
		{
			return array();	
		}
	}
	function activate_functions($data, $privilege_id){
		$status = false;
		$this->db->where("privilege_id",$privilege_id);
		$this->db->delete('privilege_actions');
		//echo "<pre>"; var_dump($privilege_details); exit;
		if (count($data) > 0) 
		{
			if($this->db->insert_batch("privilege_actions", $data))
			{
				$status = true;
			}
		}
		return $status;
	}

	function add_role($data){
		if ($this->db->insert("admin_role", $data)){
			return true;
		}
		else{
			return false;
		}
	} 
	function getthe_image($id){
		$this->db->where("admin_id",$id);
		$this->db->select('admin_profile_pic');
		$query = $this->db->get('admin_details');

		// echo $this->db->last_query(); die();

		if ( $query->num_rows > 0 ) 
		{
			return $query->result_array();	
		}
		else
		{
			return array();	
		}
		
	} 
	function getthe_admin($id){
		$this->db->where("admin_id",$id);
		$this->db->select('admin_profile_pic');
		$query = $this->db->get('admin_details');

		// echo $this->db->last_query(); die();

		if ( $query->num_rows > 0 ) 
		{
			return $query->result_array();	
		}
		else
		{
			return array();	
		}
		
	} 
	
	
	
	function update_role($admin_role_id,$data){
		$this->db->where("admin_role_id",$admin_role_id);
		if($this->db->update('admin_role', $data)){
			return true; 
		}else{
			return false;
		}
	}

	function delete_role($admin_role_id){
		$this->db->where("admin_role_id",$admin_role_id);
		if($this->db->delete('admin_role')){
			return true;
		}else{
			return false;
		}
	}
	function get_privilege_active_ids($role_id){
		$this->db->where("admin_role_id",$role_id);
		$this->db->select('privilege_admin_roles.privilege_id');
		$query = $this->db->get('privilege_admin_roles');

		// echo $this->db->last_query(); die();

		if ( $query->num_rows > 0 ) 
		{
			return $query->result_array();	
		}
		else
		{
			return array();	
		}
	}
	function activate_privilege($privilege, $admin_role_id){
		$this->db->where("admin_role_id",$admin_role_id);
		$this->db->delete('privilege_admin_roles');
		if ($privilege) {
			foreach ($privilege as $value) 
			{
					$data["privilege_id"] = $value;
					$data["admin_role_id"] = $admin_role_id;
					$this->db->insert("privilege_admin_roles", $data);
			
			}
			return true;
		}
		return false;
		
		
	}
	
	
	public function add_new_admin($admin_name,$email,$password,$phone_number,$address,$city_name,$zip_code,$state_name,$country_code,$admin_profile_pic,$admin_pattren,$role)
	{
	// debug($aadhar_card);exit();	
		
	$data_address = array(
		'address' => $address,
		'city_name' => $city_name,
		'zip_code' => $zip_code,
		'state_name' => $state_name,
		'country_code' => $country_code
		);
		$this->db->insert('address_details', $data_address);
		$address_details_id = $this->db->insert_id();
		
		
		 $data = array(
		'admin_name' => $admin_name,
		'admin_email' => $email,
		'address_details_id' => $address_details_id,
		'admin_account_number' => 'A_'.($address_details_id+1000),
		'admin_home_phone' => '',
		'admin_cell_phone' => '',
		'admin_profile_pic' => $admin_profile_pic,
		'admin_status' => 'ACTIVE',
		'admin_cell_phone'=>$phone_number
		
		);
		$this->db->insert('admin_details', $data);
		$admin_details_id =  $this->db->insert_id();
		
		 	$data_log = array(
		'admin_id' => $admin_details_id,
		'admin_user_name' => $email,
		'admin_password' => $password,
		'admin_pattren' => $admin_pattren,
		'admin_type_id' => '2'
		);
		$this->db->insert('admin_login_details', $data_log);
	    $this->db->insert_id();
		
			$data_role = array(
		'admin_roles_id' => $role,
		'admin_id' => $admin_details_id
		);
		$this->db->insert('admin_role_details', $data_role);
	
		return $admin_details_id;
	}
	
	function admin_role_details_user($user_id){
		 return $this->db->get_where('admin_role_details',array('admin_id'=>$user_id))->row();
	}
	
		function update_admin($update,$admin_id,$user_profile_name){
		//echo '<pre/>';print_r($update);exit;

			
		$update_data_address = array(
								'address' 		=> $update['address'],
								'city_name' 	=> $update['city_name'],
								'zip_code' 		=> $update['zip_code'],
								'state_name' 	=> $update['state_name'],
								'country_code' 	=> $update['country_code']					
							);
		$this->db->where('address_details_id', $update['address_details_id']);
		$this->db->update('address_details', $update_data_address);
		
		$update_data_user = array(
								'admin_name' 					=> $update['fname'],								
								'admin_email' 					=> $update['email'],					
								'admin_home_phone' 				=> $update['cell_phone'],					
								'admin_cell_phone' 				=> $update['home_mobile'],					
							);		
		$this->db->where('admin_id', $admin_id);						
		$this->db->update('admin_details',$update_data_user);

	}

	function store_data1($data){
		//$this->load->database();
		// exit("kgh");
		$insert_data['euipment_name'] = $data['euipment_name'];
		$insert_data['price'] = $data['price'];
		$insert_data['checks'] = $data['checks'];
		$insert_data['status'] = 1;
		//$insert_data['txtPassportNumber'] = $data['txtPassportNumber'];
		
		$query = $this->db->insert('add_equipment', $insert_data);
		//echo $query;
	}	

	function store_data_supplier($data){
		//$this->load->database();
		// exit("kgh");
		$insert_data['supplier_name'] = $data['supplier_name'];
		$insert_data['supplier_code'] = $data['supplier_code'];
		//$insert_data['checks'] = $data['checks'];
		$insert_data['status'] = 1;
		//$insert_data['txtPassportNumber'] = $data['txtPassportNumber'];
		
		$query = $this->db->insert('add_supplier', $insert_data);
		//echo $query;
	}	
	
	function store_hotel($data){
		//$this->load->database();
		 // print_r($data);exit;
		$insert_data['hotel_code'] = $data['hotel_code'];
		$insert_data['hotel_checkin'] = $data['hotel_checkin'];
		$insert_data['hotel_checkout'] = $data['hotel_checkout'];
		$insert_data['adult_num'] = $data['adult_num'];
		$insert_data['child_num'] = $data['child_num'];
		$insert_data['age1'] = $data['age1'];
		$insert_data['images1'] = $data['images1'];
		
		
		$query = $this->db->insert('hotel_data', $insert_data);
		//echo $query;
	}

	function store_rss_data($data){
		$query = $this->db->insert('rss_table', $data);
	}
	
	function update_admin_details($update,$admin_profile_pic,$admin_id){
		// echo '<pre/>';print_r(date('Y-m-d H:i:s'));exit;

			
		$update_data_address = array(
								'address' 		=> $update['address'],
								'city_name' 	=> $update['city_name'],
								'zip_code' 		=> $update['zip_code'],
								'state_name' 	=> $update['state_name'],
								'country_code' 	=> $update['country_code']					
							);
		$this->db->where('address_details_id', $update['address_details_id']);
		$this->db->update('address_details', $update_data_address);
		
		$update_data_user = array(
								'admin_name' 					=> $update['fname'],								
								'admin_email' 					=> $update['email'],					
								'admin_home_phone' 				=> $update['cell_phone'],					
								'admin_cell_phone' 				=> $update['home_mobile'],
								'admin_profile_pic' 			=> $admin_profile_pic,
								
							);		
		$this->db->where('admin_id', $admin_id);						
		$this->db->update('admin_details',$update_data_user);
        if ($update['role'] != '') {     
        $admin_role_details = array(
								'admin_roles_id' 					=> $update['role'],				
							);	   	
		$this->db->where('admin_id', $admin_id);						
		$this->db->update('admin_role_details',$admin_role_details);
        }
        if ($update['old_password'] != '') {
        $admin_password = array(
								'admin_password' 					=> md5($update['new_password']),				
							);		
        $this->db->where('admin_id', $admin_id);						
		$this->db->update('admin_login_details',$admin_password);
        }
         if ($update['pattern'] != '') {
        $admin_pattren = array(
								'admin_pattren' 					=> $update['pattern'],				
							);		
        $this->db->where('admin_id', $admin_id);						
		$this->db->update('admin_login_details',$admin_pattren);
        }

	}
	  
}
