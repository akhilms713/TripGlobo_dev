<?php
class Hotel_CRS_Model extends CI_Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}
	public function usertypes(){
		$result = FALSE ; 
			$this->db->select('*');
			$this->db->where(array("user_type.status" => 'ACTIVE'));
			$this->db->where(array("user_type.user_type_name != " => 'SUBSCRIBER'));
			$query = $this->db->get("user_type");
			if($query->num_rows() > 0)
			{
				$result = $query->result() ; 
			}
			return $result ;
	}
	function get_agency_countrylist(){
		$this->db->select('*');
		$this->db->from('country_list');
		return $this->db->get()->result();
	}
	public function managed_by_list($data){
		$value = $data['ManagedBy'];
		$select = $this->db->query("SELECT * FROM admin_details a
		LEFT JOIN address_details ad ON(ad.address_details_id = a.address_details_id)
		LEFT JOIN admin_login_details d ON(d.admin_id = a.admin_id) WHERE d.admin_type_id =3")->result();
		$result="";
		foreach($select as $row){
		$result.= '<option value='.$row->admin_id.'><b>'.$row->admin_name.', '.$row->city_name.'-'.$row->admin_account_number.'</b></option>';
			}
			echo $result;
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
	function get_country_data_ajax_list($country,$val)
    {
       //$this->db = $this->load->database('hotelthis->db', TRUE); 
        $this->db->select('city_code,city ')->from('api_hotel_cities')->where('country_code', $country);
        $this->db->like('city', $val);
        $query = $this->db->get();
	
		//$this->load->database('default', TRUE); 
        if ($query->num_rows > 0) {
            $city = $query->result();

            foreach ($city as $cities) {
            	echo '<p>'.$cities->city.'</p>' ;
            }
        }
        return false;
      
        
    }
    	function get_hotelcrs_count()
		{
			
				$select = "SELECT hotel_id  FROM hotel_list order by hotel_id DESC";
		
				$query=$this->db->query($select);
				
				if ($query->num_rows() > 0)
				{
					$a =  $query->row();
					return $a->hotel_id;
				} else {
					return 0;	
				}
		}
		function add_hotelcrs_data($hotel_code,$hotel_name,$supplier_number,$star_rating,$hotel_type,$address,$country,$city,$contact_person,$contact_mobile,$image_path)
		{
			
		$this->db->select('*');
		$this->db->where('hotel_rating',$star_rating);
		$this->db->from('hotel_rating');
		$query_chk1 = $this->db->get();
		
		$this->db->select('*');
		$this->db->where('hotel_type_code',$hotel_type);
		$this->db->from('hotel_type');
		$query_chk2 = $this->db->get();
		
		$this->db->select('*');
		$this->db->where('city',$city);
		$this->db->from('api_hotel_cities');
		$query_chk3 = $this->db->get();
		
		
		if($supplier_number=='admin')
		{
			$query_chk4 = "OK";
		}
		else
		{
			
			$this->db->select('*');
			$this->db->where('admin_id',$supplier_number);
			$this->db->from('admin_details');
			$query_chk5 = $this->db->get();
			if($query_chk5->num_rows() > 0)
			{
				$query_chk4 = "OK";
			}
			else
			{
				$query_chk4 = "NOTOK";
			}
			
		}
		if($query_chk3->num_rows() > 0 && $query_chk4 == "OK")
			{
							$city_data_v = 	$query_chk3->row();
			
			$data = array(
            'hotel_code' => $hotel_code,
            'hotel_name' => mysql_real_escape_string($hotel_name),
			'supplier_id' => mysql_real_escape_string($supplier_number),
            'hotel_rating' => mysql_real_escape_string($star_rating),
            'hotel_type' => mysql_real_escape_string($hotel_type),
            'hotel_address' => mysql_real_escape_string($address),
            'country_id' => mysql_real_escape_string($city_data_v->country_name),
            'city' => mysql_real_escape_string($city_data_v->destination_name),
            //'city_code' => mysql_real_escape_string($city_code),
            'contact_person' => mysql_real_escape_string($contact_person),
         	'contact_mobile' => mysql_real_escape_string($contact_mobile),
		 	'hotel_image' => 'uploads/'.$image_path,
            'status' => 'ACTIVE',
			'created_ip_address' =>  'CLIENT_ADDR',
			'hotel_agent_domain_name' =>  'APPLICATION_URL',
			'hotel_agent_number' => 'AGENT_NUMBER'
        );

        $this->db->set('created', 'NOW()', FALSE);
    	$ret_data =  $this->db->insert('hotel_list', $data);
		$data1 = array(
            'overview' => '',
            'fine_print' => '',
			'landmark' => '',
            'checkin' => '',
            'checkout' => '',
			'hotel_code' =>  $hotel_code
			//'created_ip_address' =>  'CLIENT_ADDR',
			//'hotel_agent_domain_name' =>  'APPLICATION_URL',
			//'hotel_agent_number' => 'AGENT_NUMBER'
        );
	           $this->db->insert('hotel_details', $data1);
			   $data2 = array(
         
			'hotel_code' =>  $hotel_code,
			//'created_ip_address' =>  'CLIENT_ADDR',
			//'hotel_agent_domain_name' =>  'APPLICATION_URL',
			//'hotel_agent_number' => 'AGENT_NUMBER'
        );
	          $this->db->insert('hotel_contacts', $data2);
			   
			
			return $ret_data;
			}
			else
			{
				
				return false;
			}
				
		}
		function fetch_hotel_rating()
		{		
				 
				$select = "SELECT *  FROM hotel_rating";
		
				$query=$this->db->query($select);
				$this->load->database('default', TRUE); 
				if ($query->num_rows() > 0)
				{
					return $query->result();
				} else {
					return false;	
				}
		}
		function fetch_hotel_types()
		{		
				
				$select = "SELECT *  FROM hotel_type";
		
				$query=$this->db->query($select);
				$this->load->database('default', TRUE); 
				if ($query->num_rows() > 0)
				{
					return $query->result();
				} else {
					return false;	
				}
		}
		function get_hotel_list_hotel_code($id)
		{
				//$agent_number = AGENT_NUMBER;
				
				$select = "SELECT *  FROM hotel_list LEFT JOIN country_list ON country_list.country_code=hotel_list.country_id where hotel_list.hotel_code='$id' ";
		
				$query=$this->db->query($select);
				if ($query->num_rows() > 0)
				{
					return $query->row();
				} else {
					return false;	
				}
		}
		function get_supplier_list_id($number)
		{		
				$select = "SELECT admin_account_number,admin_name FROM admin_details where admin_account_number='$number'";
		
				$query=$this->db->query($select);
				if ($query->num_rows() > 0)
				{
					return $query->row();
				} else {
					return false;	
				}
		}
		function update_hotelcrs_data($hotel_code,$hotel_name,$star_rating,$hotel_type,$address,$contact_person,$contact_mobile,$image_path)
		{
			
			
			
		
		$this->db->select('*');
		$this->db->where('hotel_rating',$star_rating);
		$this->db->from('hotel_rating');
		$query_chk1 = $this->db->get();
		
		$this->db->select('*');
		$this->db->where('hotel_type_code',$hotel_type);
		$this->db->from('hotel_type');
		$query_chk2 = $this->db->get();
		
			if($query_chk1->num_rows() > 0 && $query_chk2->num_rows() > 0 )
			{
				
			if($image_path!='')
			{
				$data = array(
            'hotel_name' => mysql_real_escape_string($hotel_name),
            'hotel_rating' => mysql_real_escape_string($star_rating),
            'hotel_type' => mysql_real_escape_string($hotel_type),
            'hotel_address' => $address,
           
            'contact_person' => mysql_real_escape_string($contact_person),
         	'contact_mobile' => mysql_real_escape_string($contact_mobile),
			'hotel_image' => $image_path
        );
		 	
			}
			else
			{
					$data = array(
            'hotel_name' => mysql_real_escape_string($hotel_name),
            'hotel_rating' => mysql_real_escape_string($star_rating),
            'hotel_type' => mysql_real_escape_string($hotel_type),
            'hotel_address' => $address,
           
            'contact_person' => mysql_real_escape_string($contact_person),
         	'contact_mobile' => mysql_real_escape_string($contact_mobile)
			
        );
			}
			

       $where = array('hotel_code'=>$hotel_code);
	   
       $this->db->update('hotel_list', $data,$where);
	
	  
	 
				return true;
			}
			else
			{
				
					return false;
			}
		}
		
		
		function get_hotel_images($id)
		{
				//$this->db = $this->load->database('hotelthis->db', TRUE); 
				
				//$agent_number = AGENT_NUMBER;
				$select = "SELECT *  FROM hotel_images where hotel_code='$id' ";
		
				$query=$this->db->query($select);
				//$this->load->database('default', TRUE); 
				if ($query->num_rows() > 0)
				{
					return $query->result();
				} else {
					return false;	
				}
				 }
				function get_hotel_contacts_code($id)
		{
				
				$select = "SELECT *  FROM hotel_contacts  where hotel_code='$id' ";
		
				$query=$this->db->query($select);
				 
				if ($query->num_rows() > 0)
				{
					return $query->row();
				} else {
					return false;	
				}
		}
		function update_hotelcontacts_info($phone,$fax,$email,$phone1,$fax1,$email1,$hotel_code)
		{
						
				$data = array(
            'phone_number' => $phone,
            'fax_number' => $fax,'email_address' => $email,'reservation_phone' => $phone1,'reservation_mobile' => $fax1,'reservation_email'=>$email1
        );
		 	

       $where = array('hotel_code'=>$hotel_code);
	   
       $this->db->update('hotel_contacts', $data,$where);
		
			return true;
		}
		function get_hotel_amentity()
	{		
		$this->db->select('*');
		$this->db->from('hotel_amenities');
		$this->db->order_by('hotel_amenity_lable');
		$query = $this->db->get();
				
			if ($query->num_rows() > 0)
			{
				return $query->result();
			} else {
				return false;	
			}
	}
	function get_hotel_details_code($id)
		{
				
				$select = "SELECT *  FROM hotel_details  where hotel_code='$id' ";
		
				$query=$this->db->query($select);
				
				if ($query->num_rows() > 0)
				{
					return $query->row();
				} else {
					return false;	
				}
		}
		function update_hoteldetails_info($hotel_code,$overview,$fine_print,$landmark,$checkin,$checkout,$amentity)
		{
			
				$data = array(
            'overview' => $overview,
            'fine_print' => $fine_print,'landmark' => $landmark,'checkin' => $checkin,'checkout' => $checkout,'amentity'=>implode(",",$amentity)
        );
		 
       $where = array('hotel_code'=>$hotel_code);
	   
       $this->db->update('hotel_details', $data,$where);
		
			return true;
		}
		function get_hotel_rooms_hotel_code($id)
		{
				$select = "SELECT *  FROM hotel_room join room_type ON room_type.room_type_id = hotel_room.room_type_id  where hotel_room.hotel_code='$id' ";
				$query=$this->db->query($select);
				if ($query->num_rows() > 0)
				{
					return $query->result();
				} else {
					return false;	
				}
		}
		function get_room_list_room_code($id)
		{
				
				$select = "SELECT *  FROM hotel_room where room_code='$id' ";
		
				$query=$this->db->query($select);
				if ($query->num_rows() > 0)
				{
					return $query->row();
				} else {
					return false;	
				}
		}
		function date_diff($first, $last, $step = '+1 day', $output_format = 'Y-m-d' ) {

	    $dates = array();
	    $current = strtotime($first);
	    $last = strtotime($last);

	    while( $current <= $last ) {

	        $dates[] = date($output_format, $current);
	        $current = strtotime($step, $current);
	    }
	   
	    return $dates;
	}
	function hotel_crs_rate_manager_v1($id)
		{
		
				$select = "SELECT *,date as date_v1  FROM hotel_crs_rate_manager  where hotel_code='$id'  ";
//			$select = "SELECT *  FROM hotel_room join room_type ON room_type.room_type_code=hotel_room.room_type  where hotel_room.hotel_code='$id' ";
		
				$query=$this->db->query($select);
				
				if ($query->num_rows() > 0)
				{
					return $query->result();
				} else {
					return false;	
				}
				
		}
		public function crs_rate_manager($hotel_code,$room_code,$date){
		
		$this->db->select("*");
		$this->db->from("hotel_crs_rate_manager");
		$this->db->where('date', $date);
		$this->db->where('hotel_room_id	', $room_code);
		$this->db->where('hotel_code', $hotel_code);
		$query = $this->db->get();
		if($query) {
			return $query;
		}
		else { return false; }
		
	}
	public function rate_manager($hotel_code,$room_code,$date){
		
		$this->db->select("*");
		$this->db->from("hotel_room_rate");
		$this->db->where('start_date <=', $date);
		$this->db->where('end_date >=', $date);
		$this->db->where('room_code', $room_code);
		$this->db->where('hotel_code', $hotel_code);
		$query = $this->db->get();
		
		return $query;
	}
	public function hotel_gallery_upload($new_str,$id){
		$data = array(
			'hotel_code' => $id,
			'image_url' => $new_str
			);
		
        return $this->db->insert('hotel_images', $data); 
	}
	public function hotel_photo_delete($id){
		$data = array(
			'hotel_images_id' => $id
			);
		$image = $this->db->get_where('hotel_images',$data)->row();
		if(($pos = strpos($image->image_url, 'uploads')) !== false)
            {
               $new_str = 'u'.substr($image->image_url, $pos + 1);
            }
            else
            {
               $new_str = get_last_word($image->image_url);
            }

		unlink($new_str);
		$this->db->delete('hotel_images',$data);

	}
	public function room_image_delete($id){
		$data = array(
			'room_images_id' => $id
			);
		$image = $this->db->get_where('room_images',$data)->row();
		if(($pos = strpos($image->image_url, 'uploads')) !== false)
            {
               $new_str = 'u'.substr($image->image_url, $pos + 1);
            }
            else
            {
               $new_str = get_last_word($image->image_url);
            }

		unlink($new_str);
		$this->db->delete('room_images',$data);
	}
	public function viewDiscount($array){
		
		$this->db->select('hotel_crs_discount.*,hotel_crs_discount_types.discount_type');
		$this->db->from('hotel_crs_discount');
		$this->db->join('hotel_crs_discount_types', 'hotel_crs_discount_types.id = hotel_crs_discount.discount_type_id');
		$this->db->where('hotel_crs_discount.hotel_code', $array);
		
		 $query = $this->db->get();
		if ( $query->num_rows > 0 ) {
			 
	         return $query->result();
			 
	      }
	
		return false;
		
	}
	public function get_discount_types(){
		$a =  $this->db->get('hotel_crs_discount_types');
		return $a;
		
	}
	public function save_discount($input){
		
		$this->db->insert('hotel_crs_discount', $input);
		$id = $this->db->insert_id();
		
		return $id;
	}
	public function delete_discount($array){
		
	   	$this->db->delete('hotel_crs_discount', $array);
	   	
		return true;
	}
	public function edit_discount($array,$hotel_code){
		$this->db->select('hotel_crs_discount.*,hotel_crs_discount_types.discount_type');
		$this->db->from('hotel_crs_discount');
		$this->db->join('hotel_crs_discount_types', 'hotel_crs_discount_types.id = hotel_crs_discount.discount_type_id');
		$this->db->where(array('hotel_crs_discount.id' => $array));
		$this->db->where(array('hotel_crs_discount.hotel_code' => $hotel_code));
		$query = $this->db->get();
		
		return $query;
	}
	public function update_discount($array,$where){
		
		$query = $this->db->update('hotel_crs_discount',$array,$where);
		
		return $query;
	}
	public function viewLocator($array){
		
		$this->db->select('hotel_crs_locators.*,hotel_crs_locators_types.locator_types,api_hotel_cities.destination_name');
		$this->db->from('hotel_crs_locators');
		$this->db->join('hotel_crs_locators_types', 'hotel_crs_locators_types.id = hotel_crs_locators.locator_id');
		$this->db->join('api_hotel_cities', 'api_hotel_cities.city_code = hotel_crs_locators.city_code');
		$this->db->where('hotel_crs_locators.hotel_code', $array);
		 $query = $this->db->get();
		if ( $query->num_rows > 0 ) {
			
	         return $query->result();
			 
	      }
	
		return false;
	}
	public function get_locator_types(){
		$a =  $this->db->get('hotel_crs_locators_types');
		return $a;

	}
	public function getcities(){
		$this->db->order_by('destination_name','ASC');
		$this->db->where('destination_name !=','');
		$a = $this->db->get('api_hotel_cities');
		return $a;
	}
	public function save_locator($input){
		
		
		$this->db->select('*');
		$this->db->where('id',$input['locator_id']);
		$this->db->from('hotel_crs_locators_types');
		$query = $this->db->get();
		
		$this->db->select('*');
		$this->db->where('city_code',$input['city_code']);
		$this->db->from('api_hotel_cities');
		$query1 = $this->db->get();
		
		if ($query->num_rows() > 0 && $query1->num_rows() > 0)
		{
				$this->db->insert('hotel_crs_locators', $input);
				$this->db->insert_id();
				
				return true;
		}
		
		return false;	
		
		
	}
	public function edit_locator($array,$hotel_code){
		
		$this->db->select('hotel_crs_locators.*,hotel_crs_locators_types.locator_types,api_hotel_cities.destination_name');
		$this->db->from('hotel_crs_locators');
		$this->db->join('hotel_crs_locators_types', 'hotel_crs_locators_types.id = hotel_crs_locators.locator_id');
		$this->db->join('api_hotel_cities', 'api_hotel_cities.city_code = hotel_crs_locators.city_code');
		$this->db->where('hotel_crs_locators.id', $array);
		$this->db->where('hotel_crs_locators.hotel_code', $hotel_code);
		
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		
		return $query;
	}
	public function update_locator($array,$where){
		
		$query = $this->db->update('hotel_crs_locators',$array,$where);
		
		return $query;
	}
	public function delete_locator($array){
		
	   	$this->db->delete('hotel_crs_locators', $array);
	   	
		return true;
	}
	public function taxes($type,$array){
		
		if($type == 'specific'){
			$this->db->select('*');
			$this->db->from('hotel_crs_taxes');
			$this->db->join('hotel_crs_tax_charge_type', 'hotel_crs_tax_charge_type.id = hotel_crs_taxes.charge_type_id');
			$this->db->join('hotel_crs_tax_types', 'hotel_crs_tax_types.id = hotel_crs_taxes.tax_type_id');
			$a = $this->db->where($array)->get();
			//$a= $this->db->get_where('hotel_crs_taxes', );
			
			return $a;
			
		}
		
		return false;
	}
	function get_tax_tax_type()
	{		
		
		$this->db->select('*');
		$this->db->from('hotel_crs_tax_types');
		$query = $this->db->get();
		
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}
	function get_tax_charge_type()
	{		
		
		$this->db->select('*');
		$this->db->from('hotel_crs_tax_charge_type');
		$query = $this->db->get();
		
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}
	public function save_taxes($input){
		
		$this->db->select('*');
		$this->db->where('id',$input['tax_type_id']);
		$this->db->from('hotel_crs_tax_types');
		$query = $this->db->get();
		
		$this->db->select('*');
		$this->db->where('id',$input['charge_type_id']);
		$this->db->from('hotel_crs_tax_charge_type');
		$query1 = $this->db->get();
		
		if ($query->num_rows() > 0 && $query1->num_rows() > 0)
		{
				$this->db->insert('hotel_crs_taxes', $input);
				$this->db->insert_id();
				
				return true;
		}
		
		return false;	
		
		
	}
	public function edit_tax($array){
		 
		$query = $this->db->get_where('hotel_crs_taxes',$array);
		if ($query->num_rows() > 0 ){

		 
		 return $query->row();
	}
	else{
		return false;
	}
	}
		public function update_tax($input,$where){
			$data = array(
				'tax_type_id' => $input['tax_type_id'],
				'charge_type_id' => $input['charge_type_id'],
				'tax_value' => $input['tax_value']
				);
		
		$query = $this->db->update('hotel_crs_taxes',$data,$where);
		
		return $query;
	}
	public function delete_tax($array){
		
	   	$this->db->delete('hotel_crs_taxes', $array);

		return true;
	}
	public function attractions($type,$array){
		
		if($type == 'specific'){
			$a =  $this->db->get_where('hotel_crs_attraction', $array);
				
				return $a;
			
		}
		
		return false;
	}
	public function save_attractions($input){
		
		$this->db->insert('hotel_crs_attraction', $input);
		$id = $this->db->insert_id();
		
		return $id;
	}
	public function edit_attraction($array){
		
		$query = $this->db->get_where('hotel_crs_attraction',$array);
		
		if ($query->num_rows() > 0)
				{
					return $query->row();
				} else {
					return false;	
				}
		
	}
	public function update_attraction($array,$where){
		
		$query = $this->db->update('hotel_crs_attraction',$array,$where);
		
		return $query;
	}
	public function delete_attraction($array){
		
	   	$this->db->delete('hotel_crs_attraction', $array);
	   	
		return true;
	}
	public function save_cancellation($input){
		
		$this->db->insert('hotel_crs_generic_cancellation', $input);
		$id = $this->db->insert_id();
		
		return $id;
	}
	public function edit_gcancellation($array){
		
		$query = $this->db->get_where('hotel_crs_generic_cancellation',$array);

		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}
		
		
		
	}
	public function update_gcancellation($array,$where){
		
		$query = $this->db->update('hotel_crs_generic_cancellation',$array,$where);
		
		return $query;
	}
	public function delete_gcancellation($array){
		
		$this->db->delete('hotel_crs_generic_cancellation', $array);
		
		return true;
	}
	public function save_scancellation($input){
		
		$this->db->insert('hotel_crs_specific_cancellation', $input);
		$id = $this->db->insert_id();
		
		return $id;
	}
	public function edit_scancellation($array){
		
		$query = $this->db->get_where('hotel_crs_specific_cancellation',$array);
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}

	}
	public function update_scancellation($array,$where){
		
		$query = $this->db->update('hotel_crs_specific_cancellation',$array,$where);
		
		return $query;
	}
	public function delete_scancellation($array){
		
		$this->db->delete('hotel_crs_specific_cancellation', $array);
		
		return true;
	}
	public function cancellation($type,$hotel_code){
		if($type == 'specific'){
			$this->db->select('*')
			->from('hotel_crs_specific_cancellation')
			->where("hotel_code", $hotel_code);
			$query = $this->db->get();
			if ( $query->num_rows > 0 ) 
			{
				return $query->result();	
			}
			else
			{
				return '';	
			}
		}elseif($type == 'generic'){
			$this->db->select('*')
			->from('hotel_crs_generic_cancellation')
			->where("hotel_code", $hotel_code);
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
	public function get_hotel_details($hotel_code = ""){
		if ($hotel_code != "") {
			$this->db->select('hotel_list.*,admin_details.admin_account_number as supplier_code,admin_details.admin_name as supplier_name, country_list.country_name,hotel_type.*')
			->from('hotel_list')
			->where('hotel_list.hotel_code', $hotel_code)
			->join('admin_details', 'admin_details.admin_id = hotel_list.supplier_id', 'left')
			->join('country_list', 'country_list.country_list = hotel_list.country_id', 'left')
			->join('hotel_type', 'hotel_type.hotel_type_id = hotel_list.hotel_type', 'left');
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
			$this->db->select('hotel_list.*,admin_details.admin_account_number as supplier_code, admin_details.admin_name as supplier_name, country_list.country_name,hotel_type.*')
			->from('hotel_list')
			->join('admin_details', 'admin_details.admin_id = hotel_list.supplier_id', 'left')
			->join('country_list', 'country_list.country_list = hotel_list.country_id', 'left')
			->join('hotel_type', 'hotel_type.hotel_type_id = hotel_list.hotel_type', 'left');
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
	function get_hotel_room($id,$hotel_code)
	{
		
		
		$select = "SELECT *  FROM hotel_room where room_code='$id' and hotel_code ='$hotel_code' ";
		
		$query=$this->db->query($select);
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}
	}
	function fetch_room_types()
	{		
		
		$select = "SELECT *  FROM room_type";
		$query=$this->db->query($select);
		 
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}
	function fetch_inclustion_data()
	{		
		
		$this->db->select('*');
		$this->db->from('inclusion');
		
		$query = $this->db->get();
		 
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}
	function fetch_extras_data()
	{		
		
		$this->db->select('*');
		$this->db->from('extras_fees');
		
		$query = $this->db->get();
		
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}
	function fetch_r_amenities_data()
	{		
		
		$this->db->select('*');
		$this->db->from('room_amenities');
		$this->db->order_by('room_amenities_name');
		$query = $this->db->get();
		
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}
	function get_hotel_room_extra($id,$hotel_code)
	{
		$select = "SELECT *  FROM hotel_room_extra_fees where room_code='$id' and hotel_code ='$hotel_code' ";
		$query=$this->db->query($select);
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return '';	
		}
	}
	function update_room_info($room_type,$room_name,$no_of_rooms,$booking_status,$min_people,$max_people,$room_description,$room_code,$hotel_code,$r_amenities,$extras,$inclusion)
	{
	
		
		$this->db->select('*');
		
		$this->db->where('hotel_code',$hotel_code);
		$this->db->from('hotel_list');
		$query_chk = $this->db->get();
		
		$this->db->select('*');
		$this->db->where('room_type_code',$room_type);
		$this->db->from('room_type');
		$query_chk1 = $this->db->get();
	
		if(isset($inclusion) && $inclusion!='')
		{
			$this->db->select('*');
			$this->db->where('inclusion_code',$inclusion);
			$this->db->from('inclusion');
			$query_chk2 = $this->db->get();
			if($query_chk2->num_rows() > 0)
			{
				$query_chk2_v = 'OK';
			}
			else
			{
				$query_chk2_v = 'NOTOK';
			}
		}
		else
		{
			$query_chk2_v = 'OK';
		}
		
		if ( ($booking_status=='PENDING' || $booking_status=='INSTANT') && ($max_people >= $min_people))
		{
			
			$data = array(
				'room_type_id' => $room_type,
				'room_name' => $room_name,'no_of_rooms'=>$no_of_rooms,'booking_status' => $booking_status,'min_people' => $min_people,'max_people' => $max_people,'room_description'=>$room_description,'inclusion'=>$inclusion,'room_amenities_code'=>$r_amenities
				);
			
			$where = array('room_code'=>$room_code,'hotel_code'=>$hotel_code);
			$this->db->update('hotel_room', $data,$where);
			
			if($max_people <2)
			{
				$data3 = array(
					'two_adult_price' => 0,
					'extrabed' => 0
					);
				$where3 = array('room_code'=>$room_code,'hotel_code'=>$hotel_code);
				$this->db->update('hotel_room_rate', $data3,$where3);
				$data3_3 = array(
					'double_price' => 0,
					'extra_bed' => 0
					);
				$this->db->update('hotel_crs_rate_manager', $data3_3,$where3);
				
			}
			
			foreach($extras as $key=>$val)
			{
				if($val!='')
				{
					
					$this->db->select('*');
					$this->db->where('extras_fees_code',$key);$this->db->where('room_code',$room_code);
					$this->db->where('hotel_code',$hotel_code);
					$this->db->from('hotel_room_extra_fees');
					$query_chk5 = $this->db->get();
					if($query_chk5->num_rows() > 0)
					{
						
						$data2 = array(
							'price' => $val,
							);
						$where1 = array('room_code'=>$room_code,'hotel_code'=>$hotel_code,'extras_fees_code'=>$key);
						$this->db->update('hotel_room_extra_fees', $data2,$where1);
					}
					else
					{
						$data2 = array(
							'hotel_code' => $hotel_code,
							'price' => $val,
							'extras_fees_code' => $key,
							'room_code' => $room_code,
							'currency' => CURRENCY
							
							
							);
						$this->db->insert('hotel_room_extra_fees', $data2);
					}
					
				}
			}
			

			return true;
		}
		else
		{
			return false;
		}
	}
	function get_hotel_room_rate($id,$hotel_code)
	{
		
		$select = "SELECT *  FROM hotel_room_rate where room_code='$id' and  hotel_code='$hotel_code'  ";
		
		$query=$this->db->query($select);
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}
	public function add_roomrates($hotel_code,$room_code,$data){
		
		$result = array(
			'hotel_code' => $hotel_code,
			'room_code' => $room_code,
			'start_date	' => $data['valid_from'],
			'end_date' => $data['valid_to'],
			'one_adult_price' => $data['price_single'],
			'two_adult_price' => $data['price_double'],
			'extrabed' => $data['extra_bed'],
			'room_allocation' => $data['room_allocation'],
			'currency' => 'USD',
			'status' => 'ACTIVE',
			
			);
		return $this->db->insert('hotel_room_rate',$result);
	}
	function delete_room_rates($hotel_code,$room_code,$room_rate_id){
		
		
		$where = array( 'hotel_code' =>  $hotel_code, 'room_code' =>  $room_code,'hotel_room_rate_id'=>$room_rate_id);
		$this->db->delete('hotel_room_rate', $where);
		
		return true;
		
	}
	function get_room_images($id,$room_code)
		{
				//$this->db = $this->load->database('hotelthis->db', TRUE); 
				
				//$agent_number = AGENT_NUMBER;
				$select = "SELECT *  FROM room_images where hotel_code='$id' AND room_code = '$room_code'";
		
				$query=$this->db->query($select);
				//$this->load->database('default', TRUE); 
				if ($query->num_rows() > 0)
				{
					return $query->result();
				} else {
					return false;	
				}
				 }
		public function room_gallery_upload($new_str,$id,$room_id){
			$data = array(
			'hotel_code' => $id,
			'room_code' => $room_id,
			'image_url' => $new_str
			);
		
        return $this->db->insert('room_images', $data); 
	}
	function add_room($data, $extras)
	{
		

		$this->db->set('created_date', 'NOW()', FALSE);
		$ret_data = $this->db->insert('hotel_room', $data);
		foreach($extras as $key=>$val)
		{
			if($val!='')
			{
				$data2 = array(
					'hotel_code' => $data["hotel_code"],
					'price' => $val,
					'extras_fees_code' => $key,
					'room_code' => $data["room_code"],
					'ip_address' =>  $data["ip_address"]
					);
				$this->db->insert('hotel_room_extra_fees', $data2);
			}
		}
		$this->load->database('default', TRUE); 
		return $ret_data;
	}
	function get_room_type(){
		$this->db->select('*')
		->from('room_type');
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
	function delete_room($hotel_code,$room_id){
				
		$where = array('hotel_code' =>  $hotel_code,'room_code'=>$room_id);
		$this->db->delete('hotel_room', $where);
		$this->db->delete('hotel_room_extra_fees', $where);
		$this->db->delete('hotel_crs_rate_manager', array('hotel_code' =>  $hotel_code));
		$this->db->delete('hotel_room_rate', $where);
		$img = $this->db->get_where('room_images',$where)->result();
		foreach($img as $image){
		if(($pos = strpos($image->image_url, 'uploads')) !== false)
            {
               $new_str = 'u'.substr($image->image_url, $pos + 1);
            }
            else
            {
               $new_str = get_last_word($image->image_url);
            }

		unlink($new_str);
	}
		$this->db->delete('room_images', $where);
		
		return true;
		
	}
	function hotel_crs_rate_manager($hotel_code)
	{
		
		$this->db->select('*')
		->from('hotel_crs_rate_manager')
		->where('hotel_crs_rate_manager.hotel_code', $hotel_code);
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
	public function update_status_hotel($id,$status){
		$this->db->where('hotel_code',$id);
		return $this->db->update('hotel_list',array('status' => $status));

	}
	public function check_date($array){
		
		$query = $this->db->get_where('hotel_crs_rate_manager',$array);
		
		return $query;
	}
	public function check_pax_count($array){
		
		$query = $this->db->get_where('hotel_room',$array);
	
		return $query;
	}
	public function update_rate_manager($array,$where){
		
		$query = $this->db->update('hotel_crs_rate_manager',$array,$where);
		
		return $query;
	}
	public function insert_rate_manager($input){
		
		$this->db->insert('hotel_crs_rate_manager', $input);
		$id = $this->db->insert_id();
		
		return $id;
	}
	public function delete_rate_manager($array){
	
		$this->db->delete('hotel_crs_rate_manager', $array);
		
		return true;
	}
	function update_hotel_location_info($hotelcode,$latirude,$longitude)
	{
		
		$data = array(
			'latitude' => $latirude,
			'longitude' => $longitude
			);
		
		$where = array('hotel_code'=>$hotelcode);
		$this->db->update('hotel_list', $data,$where);
		
		return true;
	}

}