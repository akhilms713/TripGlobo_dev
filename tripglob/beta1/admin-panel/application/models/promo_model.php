<?php
class Promo_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_promo_list()
	{
		//$this->db->select('*')->from('promo');

		$execute_query = $this->db->query('select a.*,p.*,a.airline_code as air_code from promo as p left join airline_list as a on p.airline_code=a.airline_list_id ORDER BY p.created_date DESC');

		//$query = $this->db->get();
		if ( $execute_query->num_rows > 0 ) 
		{
			return $execute_query->result();	
		}
		else
		{
			return '';	
		}
	}
	public function get_user_type()
	{
		$this->db->select('*')->from('user_type');
		$this->db->where('user_type.status',"ACTIVE");
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
	public function get_user_list_details($user_type_id)
   	{
		$this->db->select('user_email_id')
		->where_in('user_type_id',$user_type_id)
		->from('user_login_details');
		$query = $this->db->get();
	
	      if ( $query->num_rows > 0 ) {
         return $query->result();
    	  }
      	return false;
   }
	public function get_promo_list_id($id)
	{
		$this->db->select('*')->from('promo')
		->where('promo_id',$id);
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
 function update_promo_status($id,$status)
   {
		$data = array(
			'status' => $status
			);
			$where = "promo_id = ".$id;
		if ($this->db->update('promo', $data, $where)) {
			return true;
		} else {
			return false;
		}
	
		
   }

   function update_promo_detail($data,$id)
   {	
   	    $where = "promo_id = ".$id;
		if ($this->db->update('promo', $data, $where)) {
			return true;
		} else {
			return false;
		}
   }
    function add_promo_new_amount($user_id,$user_type,$discount,$promo_code,$exp_date,$promo_amount,$description,$minimum_amount,$airline_code,$module_type,$pic_name1)
   {
	   	$data = array(
	   	'user_type' => $user_type,
	   	'user_id' => $user_id,   
		'discount' => $discount,
		'promo_code' => $promo_code,
		'expiry_date' => $exp_date,
		'module'=>$module_type,
		'description'=>$description,
		'minimum_amount'=>$minimum_amount,
		'airline_code'=>$airline_code,
		'status' => 'ACTIVE',
		'promo_amount' => $promo_amount,
		'promo_type' => 'AMOUNT',
		'pic_name'=>$pic_name1
		//'img_b2b'=>$img_b2b
		);
		// echo "<pre/>";print_r($data);die;	
		$this->db->set('created_date', 'NOW()', FALSE); 
		
		$this->db->insert('promo', $data);
		$id = $this->db->insert_id();
		if (!empty($id)) {				
			return true;
		} else {
			return false;
		}
   
   }
    function add_promo_new($user_id,$user_type,$discount,$promo_code,$exp_date,$description,$minimum_amount,$airline_code,$module_type,$pic_name, $promo_image_b2c='', $promo_image_b2b='',$limit='',$limit_count='1')
   {
	   	$data = array(
	   	'user_type' => $user_type,
	   	'user_id' => $user_id,
		'discount' => $discount,
		'promo_code' => $promo_code,
		'expiry_date' => $exp_date,
		'module'=>$module_type,
		'description'=>$description,
		'minimum_amount'=>$minimum_amount,
		'airline_code'=>$airline_code,
		'status' => 'ACTIVE',
		'promo_type' => 'PERCENTAGE',
		'pic_name'=>$promo_image_b2c,
		'pic_name1' => $promo_image_b2b,
		'limit' => $limit,
		'limit_count' => $limit_count,
		//'pic_b2b'=>$pic_b2b
		);
	   	 //echo "<pre/>";print_r($data);die;
		$this->db->set('created_date', 'NOW()', FALSE); 
		
		$this->db->insert('promo', $data);
		$id = $this->db->insert_id();
		if (!empty($id)) {				
			return true;
		} else {
			return false;
		}
   
   }

   //points system start
   function add_rule_new($POST,$e_date_from,$e_date_to)
	   {
		   	$data = array(
		   	'module' => $POST['module'],
			'amount_range_from' => $POST['amount_range_from'],
			// 'amount_range_to' => $POST['amount_range_to'],
			'points' => $POST['points'],
			'exp_date_from' => $e_date_from,
			'exp_date_to' => $e_date_to,
			);
	   	 // echo"<pre>"; print_r($data); exit('xcd');
			if($this->db->insert('points_rules',$data))
			{				
				return true;
			} else {
				return false;
			}
	   }

	public function get_points_list()
	{
		$this->db->select('*')->from('points_rules');
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

	function update_point_status($id,$status)
   {
		$data = array(
			'status' => $status
			);
			$where = "id = ".$id;
		if ($this->db->update('points_rules', $data, $where)) {
			return true;
		} else {
			return false;
		}
	
		
   }

   public function get_active_points_list()
	{
		$this->db->select('*')->from('points_rules')
		->where('status','ACTIVE');
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

	 function add_point_new($point_id,$promo_code,$exp_date,$module)
   {
	   	$data = array(
		'point_id' => $point_id,
		'promo_code' => $promo_code,
		'expiry_date' => $exp_date,
		'status' => 'ACTIVE',
		'promo_type' => 'POINT',
		'point_module' => $module
		);
			
		$this->db->set('created_date', 'NOW()', FALSE); 
		
		$this->db->insert('promo', $data);
		$id = $this->db->insert_id();
		if (!empty($id)) {				
			return true;
		} else {
			return false;
		}
   
   }

   public function get_point_range($id)
	{
		$this->db->select('*')->from('points_rules')
		->where('id',$id);
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

	function update_rule($POST,$e_date_from,$e_date_to)
	   {
		   	$data = array(
		   	'module' => $POST['module'],
			'amount_range_from' => $POST['amount_range_from'],
			// 'amount_range_to' => $POST['amount_range_to'],
			'points' => $POST['points'],
			'exp_date_from' => $e_date_from,
			'exp_date_to' => $e_date_to,
			);
			$where = "id = ".$POST['id'];

			if ($this->db->update('points_rules', $data, $where)) {
				return true;
			} else {
				return false;
			}
	   }

	function update_promo_expired($status,$id)
   { 
		$data = array(
			'status' => $status
			);
			$where = "id = ".$id;
		if ($this->db->update('points_rules', $data, $where)) {
			return true;
		} else {
			return false;
		}	
   }

   function update_point_expired($status,$id)
   {
		$data = array(
			'status' => $status
			);
			$where = "promo_id = ".$id;
		if ($this->db->update('promo', $data, $where)) {
			return true;
		} else {
			return false;
		}
   }

   public function get_redeem_points_list()
	{
		$this->db->select('*')->from('redeem_point');
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

	function update_redeem_points_status($id,$status)
	{
		$data = array(
			'status' => $status
			);
			$where = "id = ".$id;
		if ($this->db->update('redeem_point', $data, $where)) {
			return true;
		} else {
			return false;
		}	
	}

	public function get_redeem_point_range($id)
	{
		$this->db->select('*')->from('redeem_point')
		->where('id',$id);
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

	function update_redeem_point($POST)
	   {
		   	$data = array(
			'amount_from' => $POST['amount_range_from'],
			// 'amount_to' => $POST['amount_range_to'],
			'point_redeem' => $POST['points'],
			'module_redeem' => $POST['module'],
			);
			$where = "id = ".$POST['id'];

			if ($this->db->update('redeem_point', $data, $where)) {
				return true;
			} else {
				return false;
			}
	   }
	public function get_redeem_point_value()
	{
		$this->db->select('*')->from('redeem_point_value');
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

	function add_redeem_point_new($POST)
	   { 
		   	$data = array(
			'amount_from' => $POST['amount_range_from'],
			// 'amount_to' => $POST['amount_range_to'],
			'point_redeem' => $POST['points'],
			'module_redeem' => $POST['module'],
			);
	   	 // echo"<pre>"; print_r($data); exit('xcd');
			if($this->db->insert('redeem_point',$data))
			{				
				return true;
			} else {
				return false;
			}
	   }

	function update_redeem_point_value($point)
	{
		$data = array(
			'point_value' => $point
			);
		$this->db->where('id',1);
		$this->db->update('redeem_point_value', $data);
	}


	public function get_module_point($type)
	{
		$this->db->select('*');
		$this->db->from('points_rules');
		$this->db->where('module',$type);
		$this->db->where('status','ACTIVE');
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

	//point syatem ends
   
}