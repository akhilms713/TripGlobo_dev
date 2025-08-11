<?php
class Supplier_Wizard_Model extends CI_Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}
	function getSuppliers($id='')
	{		if($id==''){
		$select = $this->db->query("SELECT * FROM admin_details a
		LEFT JOIN address_details ad ON(ad.address_details_id = a.address_details_id)
		LEFT JOIN admin_login_details d ON(d.admin_id = a.admin_id) WHERE d.admin_type_id =3")->result();
	}else{
		$select = $this->db->query("SELECT * FROM admin_details a
		LEFT JOIN address_details ad ON(ad.address_details_id = a.address_details_id)
		LEFT JOIN admin_login_details d ON(d.admin_id = a.admin_id) WHERE (d.admin_type_id =3 AND d.admin_id = '".$id."')")->row();
	}

		
			return $select;
		
	}
	 public function update_supplier_status($id,  $status)
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
   public function DeleteSupplier($id){
   /*	return	$this->db->join("admin_details", "admin_details.admin_id = admin_login_details.admin_id")
	  	->where("admin_login_details.admin_id", $id)
	  	->delete("admin_login_details"); */
	  	$query = $this->db->query("DELETE admin_details, admin_login_details 
					FROM admin_details
					INNER JOIN admin_login_details 
					      ON admin_login_details.admin_id = admin_details.admin_id
					INNER JOIN address_details ad ON ad.address_details_id = admin_details.address_details_id
					WHERE admin_details.admin_id = ".$id."");
   		//$this->db->delete('supplier', array('supplier_id' => $id)); 
		return $query;

   }
   function fetch_country_list()
	{		
		$select = "SELECT country_code,country_name FROM country_list";

		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}
	public function add_supplier($supplier_name,$password,$email,$address,$contacts,$city,$country,$postal,$supplier_number)
	{
		
          $address = array (
          	'address' => mysql_real_escape_string($address),
          	'city_name' => mysql_real_escape_string($city),
          	'country_code' => mysql_real_escape_string($country),
            'zip_code' => mysql_real_escape_string($postal)
          	);
          $this->db->insert('address_details',$address);
          $datestring = "%Y-%m-%d - %h:%i %a";
          $time = time();
          $details = array(
          	'admin_account_number' => mysql_real_escape_string($supplier_number),
          	'admin_name' => mysql_real_escape_string($supplier_name),
          	'admin_email' => mysql_real_escape_string($email),
          	'address_details_id' => $this->db->insert_id(),
          	'admin_home_phone' => mysql_real_escape_string($contacts),
          	'admin_status' => 'ACTIVE',
          	'admin_creation_date_time' => date("Y-m-d H:i:s"),
          	'admin_updation_date_time' => date("Y-m-d H:i:s")
          	);
          $this->db->insert('admin_details',$details);

          $login = array(
          	'admin_id' => $this->db->insert_id(),
          	'admin_type_id' => '3',
          	'admin_user_name' => mysql_real_escape_string($email),
          	'admin_password' => mysql_real_escape_string($password)
          	);

        $this->db->insert('admin_login_details', $login);
       
            return true;
	}
	public function update_supplier_details($data){
		$this->db->set('a.admin_name', $data['supplier_name']);
		$this->db->set('a.admin_email', $data['email']);
		$this->db->set('b.address', $data['address']);
		$this->db->set('a.admin_home_phone',$data['contacts'] );
		$this->db->set('b.city_name',$data['city'] );
		$this->db->set('b.country_code', $data['country']);
		$this->db->set('b.zip_code', $data['postal']);

		$this->db->where('a.admin_id', $data['admin_id']);
		$this->db->where('a.address_details_id = b.address_details_id');
		return	$this->db->update('admin_details as a, address_details as b');

	}
	public function update_new_password($data){
		$value = array(
			'admin_password' => $data['password']
			);
		$this->db->where('admin_id',$data['admin_id']);
		$this->db->update('admin_login_details',$value);
	}
	
}