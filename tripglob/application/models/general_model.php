<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General_Model extends CI_Model {

	public function get_currency_value($currency_code){
		$currency_code_v1 = strtoupper($currency_code);
    	$this->db->where('currency_code',$currency_code_v1);
		$query = $this->db->get('currency_list');
		if ( $query->num_rows > 0 ) {
       		$data= $query->row();
			return  $data->value;
   		}
		else
		{
      		return ''; 
		}
    }
    public function get_currency_value_flag($currency_code){
		$currency_code_v1 = strtoupper($currency_code);
    	$this->db->where('currency_code',$currency_code_v1);
		$query = $this->db->get('currency_list');
		if ( $query->num_rows > 0 ) {
       		$data= $query->row();
			return  strtolower($data->country_code);
   		}
		else
		{
      		return '';
		}
    }
    
    public function get_currency_details($currency_code){
		$currency_code_v1 = strtoupper($currency_code);
    	$this->db->where('currency_code',$currency_code_v1);
		$query = $this->db->get('currency_list');
		if ( $query->num_rows > 0 ) {
       		$data= $query->row();
			return  $data;
   		}
		else
		{
      		return '';
		}
    }
    
    public function get_currency_list(){
		$this->db->select('*');
		$this->db->where('curr_status', '1');
		$this->db->order_by('currency_code');
		$query = $this->db->get('currency_list');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}else{
      			return array();
      		}
      		
	}

	public function get_currency_info(){
		$this->db->select('*');
		$this->db->where('curr_status', '1');
		$this->db->order_by('currency_code');
		$query = $this->db->get('currency_list');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}else{
      			return array();
      		}
      		
	}
	public function convert_image_base64($path){
		$type = pathinfo($path, PATHINFO_EXTENSION);
	$data = file_get_contents($path);
	return 'data:image/' . $type . ';base64,' . base64_encode($data);
      		
	}
	
	public function secs_to_display_format($seconds)
	{
									 
									$days = floor($seconds / 86400);
									$hours = floor(($seconds - ($days * 86400)) / 3600);
									$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
									// $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
									if($days==0){
										return $hours."h ".$minutes."m";  
									}else{
										return $days."d ".$hours."h ".$minutes."m";
									}
	}
	public function mins_to_display_format($mins)
	{
									$seconds=$mins*60;
									$days = floor($seconds / 86400);
									$hours = floor(($seconds - ($days * 86400)) / 3600);
									$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
									// $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
									if($days==0){
										return $hours."h ".$minutes."m";  
									}else{
										return $days."d ".$hours."h ".$minutes."m";
									}
	}
	public function get_airport_cityname($code){
        //echo $code;die;
        $this->db->select('airport_city as city, country');
        $this->db->where('airport_code', $code);
        $this->db->or_where('city_code', $code);
        $data = $this->db->get('iata_airport_list')->row();
        return $data->city;
    }
	 public function get_airport_name($code){
        $this->db->select('airport_name as airport');
        $this->db->where('airport_code', $code);
        $this->db->or_where('city_code', $code);
        $data = $this->db->get('iata_airport_list')->row();
        return $data->airport;
    }
	
	function store_logs($connection_response,$status,$error_text='')
    {
       
        $data = array(
                'api_id' => $connection_response['api_id'],
                'xml_type' => $connection_response['xml_title'],
                'xml_request' => $connection_response['request'],
                'xml_response' =>  $connection_response['response'],
				'ip_address' =>  $this->input->ip_address(),
				'xml_url' => $connection_response['xml_url'],
				'xml_status' =>  $status,
				'error_text' =>  $error_text
                );
           $this->db->insert('xml_logs', $data);
		  return $this->db->insert_id();
           
    }

	public function get_product_details(){
		$this->db->select('*'); 
			$this->db->where('status','ACTIVE'); 
		$query = $this->db->get('product');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}else{
      			return array();
      		}
      		
	}
	public function get_curr_val($curr){
		$curr = strtoupper($curr);
    	//$this->db->select('value');
    	$this->db->where('currency_code',$curr);
    	$price = $this->db->get('currency_list')->row();
    	return $value = $price->value;
    }
	public function get_user_details($user_id,$user_type){
		$this->db->select('user_login_details.*,user_details.*,user_verifications.*,user_type.user_type_name,user_accounts.*');
		$this->db->where('user_login_details.user_id', $user_id);
		$this->db->where('user_login_details.user_type_id', $user_type);
		$this->db->join('user_details', 'user_details.user_id=user_login_details.user_id', 'left');
		$this->db->join('user_verifications', 'user_verifications.user_id=user_login_details.user_id', 'left');
		$this->db->join('user_type', 'user_type.user_type_id=user_login_details.user_type_id', 'left');
		$this->db->join('user_accounts', 'user_accounts.user_id=user_login_details.user_id', 'left');
		
		$this->db->from('user_login_details');
		$query = $this->db->get();   
		// echo $this->db->last_query(); exit();
		if ($query->num_rows() > 0) {
			 
			return $query->row();
		}else{
			return false;
		}
	}
	// public function get_user_details($user_id,$user_type){
	// 	$this->db->select('user_login_details.*,user_details.*,user_verifications.*,user_type.user_type_name,user_accounts.*');
	// 	$this->db->where('user_login_details.user_login_details_id', $user_id);
	// 	$this->db->where('user_login_details.user_type_id', $user_type);
	// 	$this->db->join('user_details', 'user_details.user_id=user_login_details.user_id', 'left');
	// 	$this->db->join('user_verifications', 'user_verifications.user_id=user_login_details.user_login_details_id', 'left');
	// 	$this->db->join('user_type', 'user_type.user_type_id=user_login_details.user_type_id', 'left');
	// 	$this->db->join('user_accounts', 'user_accounts.user_id=user_login_details.user_login_details_id', 'left');
		
	// 	$this->db->from('user_login_details');
	// 	$query = $this->db->get();   
	// 	// echo $this->db->last_query(); exit();
	// 	if ($query->num_rows() > 0) {
			 
	// 		return $query->row();
	// 	}else{
	// 		return false;
	// 	}
	// }
	public function get_markup_details($user_id,$user_type){
		$this->db->where('user_markup.user_id', $user_id);
		$this->db->join('product', 'user_markup.product_id=product.product_id', 'left');
		$this->db->from('user_markup');
		$query = $this->db->get();   
		if ($query->num_rows() > 0) {
			 
			return $query->result();
		}else{
			return false;
		}
	}
	public function getCountryList(){
	
		$query = $this->db->get('country_list');
		if ( $query->num_rows > 0 ) {
       		$data= $query->result();
			return  $data;
   		}
		else
		{
      		return '';
		}
    }
    
     public function get_user_type_id($user_type_name){
        $this->db->where('user_type_id', $user_type_name);
        $query = $this->db->get('user_type');   
        if ($query->num_rows() > 0) {
            $a = $query->row();
            return $a->user_type_name;
        }else{
            return '';
        }
    }
    
		public function get_markup($api_id,$country_code=''){
    	//Get Markup Starts
		if($this->session->userdata('user_id')) {

			$user_id = $this->session->userdata('user_id');
			$user_type =	$this->get_user_type_id($this->session->userdata('user_type'));
			$markup = $this->get_user_markup($api_id,$country_code,$user_id,$user_type);
			//echo '<pre>';print_r($markup->hotel_markup);
			if(!empty($markup->markup_value)){
				$aMarkup = array(
					'markup' => $markup->markup_value
				);	
			}else{
				$aMarkup = array(
					'markup' => 0
				);
			}
			return $aMarkup['markup'];
		}else{
			$markup = $this->get_user_markup($api_id,$country_code);
			if(!empty($markup->markup_value)){
				$aMarkup = array(
					'markup' => $markup->markup_value
				);
			}else{
				$aMarkup = array(
					'markup' => 0
					
				);
			}
			return $aMarkup['markup'];
		}
		//Get Markup Ends
		//echo '<pre>';print_r($aMarkup);
    }
	public function get_user_markup($api_id,$country_code='',$user_id='',$user_type=''){
		//$this->db->where('hotel_country_id',$country);
		//echo $api_id.'-'.$country_code.'-'.$user_id;exit;
		$this->db->where('user_id',$user_id);
		$this->db->where('user_type',$user_type);
		$this->db->where('markup_type','SPECIFIC'); 
		$query = $this->db->get('markup');
	
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			//$this->db->where('agent_id',$b2b_id);
			$this->db->where('country_code',$country_code); 
			$this->db->where('user_type',$user_type);
			$this->db->where('markup_type','COUNTRY');   
			$query = $this->db->get('markup');
			if ($query->num_rows() > 0) {
				return $query->row();
			}else{
						 
						//$this->db->where('agent_id',$b2b_id);
						$this->db->where('api_details_id',$api_id); 
						$this->db->where('markup_type','GENERIC');   
						$this->db->where('user_type',$user_type);
						
						$query = $this->db->get('markup');
							
						if ($query->num_rows() > 0) {
							return $query->row();
						}else{
							return '';
						}
					
			}
		}
	}
	public function get_my_markup($api_id){
    	//Get Markup Starts
		if($this->session->userdata('user_id')) 
		{
			$this->db->where('api_details_id',$api_id); 
			$query = $this->db->get('api_details');
			if ($query->num_rows() > 0) 
			{
	


				$a =  $query->row();

			 	$user_id = $this->session->userdata('user_id');
				$this->db->where('user_id',$user_id); 
				$query = $this->db->get('user_markup');
				if ($query->num_rows() > 0) 
				{
					$a = $query->row();
					$aMarkup = array('markup' => $a->markup);
				}
				else
				{
					$aMarkup = array('markup' => 0 );
				}
			}
			else
			{
				$aMarkup = array('markup' => 0 );
			}
		}
		else
		{
			$aMarkup = array('markup' => 0 );
		}
			
			return $aMarkup['markup'];			
			
    }
    public function convert_api_to_base_currecy_with_markup($TotalPrice,$currency,$api_id='')
	{
		 
		if($api_id!='')
		{
			$adminMarkup = $this->get_markup($api_id); //get markup
			$MyMarkup = $this->get_my_markup($api_id); //get agent markup
		}
		else
		{
			$adminMarkup =0;
			$MyMarkup =0;
		}
	 
			$TotalPrice = $this->currency_convertor($TotalPrice,$currency,BASE_CURRENCY);
			$data['Netrate'] = $TotalPrice;
				$data['Admin_Markup'] = $this->PercentageAmount($TotalPrice,$adminMarkup);
 				$data['Admin_BasePrice'] =	$TotalPrice = $this->PercentageToAmount($TotalPrice,$adminMarkup);
				$data['My_Markup'] = $this->PercentageAmount($TotalPrice,$MyMarkup);
				$data['TotalPrice'] = $this->PercentageToAmount($TotalPrice,$MyMarkup);
			
			 
						return $data;
						
	}
	
	public function convert_currecy_with_markup($TotalPrice, $api_id='')
	{
		 
		if($api_id!='')
		{
			$adminMarkup = $this->get_markup($api_id); //get markup
			$MyMarkup = $this->get_my_markup($api_id); //get agent markup
		}
		else
		{
			$adminMarkup =0;
			$MyMarkup =0;
		}
	  // debug($MyMarkup);exit;
	  // debug($TotalPrice);exit;
				$data['My_Markup'] = $this->PercentageAmount($TotalPrice,$MyMarkup);
				$data['TotalPrice'] = $this->PercentageToAmount($TotalPrice,$MyMarkup);
			
	  // debug($data);exit;
			 
						return $data;
						
	}

	public function currency_convertor($amount,$from,$to){
    	$from = strtoupper($from);
    	//$this->db->select('value');
    	$this->db->where('currency_code',$from);
    	$price = $this->db->get('currency_list')->row();
    	$value = $price->value;
    	//echo '<pre>';print_r($price);die;
    	if($from === $to){
    		$amount = $amount/1;
    		return number_format(($amount) ,2,'.','');
    	}else{
    		//echo 100.00/64.7325;
    		//echo $amount.'/'.$value;
    		$amount = ($amount)/($value);
    		return number_format(($amount) ,2,'.','');
    	}
    }
	public function PercentageToAmount($total,$percentage){
		$amount = ($percentage/100) * $total;
		$total = number_format(($total+$amount) ,2,'.','');
		return $total;
	}
	
	public function PercentageAmount($total,$percentage){
		$amount = ($percentage/100) * $total;
		$amount = number_format(($amount) ,2,'.','');
		return $amount;
	}
	public function get_bookings($userid, $usertype, $product){
		$this->db->select('count(booking_global.booking_global_id) as cnt');
		$this->db->where('user_id', $userid);
		$this->db->where('user_type_id', $usertype);
		$this->db->where('booking_global.product_id', $product);
		$bookings = $this->db->get('booking_global');
		return $bookings->row();
	}
	
		public function get_overall_reports_graph($userid, $usertype){
		 $res = $this->db->query('select bg.voucher_date as booking_date, 
		sum(if(pd.product_name = "HOTEL", 1 ,0)) as hotel_count,
		sum(if( pd.product_name = "FLIGHT", 1 ,0)) as flight_count,
		sum(if( pd.product_name = "PACKAGE", 1 ,0)) as package_count,
		sum(if( pd.product_name = "ACTIVITY", 1 ,0)) as activity_count,
		sum(if( pd.product_name = "RAIL", 1 ,0)) as rail_count,
		sum(if( pd.product_name = "CRUISE", 1 ,0)) as cruise_count,
		sum(if( pd.product_name = "CAR", 1 ,0)) as car_count,
		sum(if( pd.product_name = "TRANSFER", 1 ,0)) as transfer_count,
		
		sum(if(pd.product_name = "HOTEL" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  hotel_total_amount ,
		sum(if( pd.product_name = "FLIGHT" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  flight_total_amount ,
		
		sum(if( pd.product_name = "PACKAGE" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  package_total_amount ,
		sum(if( pd.product_name = "ACTIVITY" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  activity_total_amount ,
		sum(if( pd.product_name = "RAIL" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  rail_total_amount ,
		sum(if( pd.product_name = "CRUISE" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  cruise_total_amount ,
		sum(if( pd.product_name = "CAR" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  car_total_amount ,
		sum(if( pd.product_name = "TRANSFER" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  transfer_total_amount 
		
		from `booking_global` bg,booking_transaction bt, product pd 
		where bg.booking_transaction_id = bt.booking_transaction_id and  bg.`product_id` = pd.product_id  and bg.`user_id` = "'.$userid.'" 
		 and bg.`user_type_id` = "'.$usertype.'" 
		group by booking_date');
 
	//	$this->db->where('booking_global.product_id', $product);
	//	 echo $this->db->last_query();
			if ($res->num_rows() > 0) 
			{
				return $res->result();
			}
			else
			{
				return '';	
			}
 
	}
		public function get_overall_pds_graph($userid, $usertype){
		 $res = $this->db->query('select pd.product_name as product_name, 
	
		count(if(bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  total_count
		from `booking_global` bg,booking_transaction bt, product pd 
		where bg.booking_transaction_id = bt.booking_transaction_id and  bg.`product_id` = pd.product_id  and bg.`user_id` = "'.$userid.'" 
		 and bg.`user_type_id` = "'.$usertype.'" 
		group by  pd.product_id');
 
	//	$this->db->where('booking_global.product_id', $product);
	//	 echo $this->db->last_query();
			if ($res->num_rows() > 0) 
			{
				return $res->result();
			}
			else
			{
				return '';	
			}
 
	}
	public function get_overall_pds_graph1($userid, $usertype){
		 $res = $this->db->query('select pd.product_name as product_name, 
	
		sum(if(pd.product_name = "HOTEL" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  hotel_total_amount ,
		sum(if( pd.product_name = "FLIGHT" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  flight_total_amount ,
		
		sum(if( pd.product_name = "PACKAGE" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  package_total_amount ,
		sum(if( pd.product_name = "ACTIVITY" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  activity_total_amount ,
		sum(if( pd.product_name = "RAIL" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  rail_total_amount ,
		sum(if( pd.product_name = "CRUISE" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  cruise_total_amount ,
		sum(if( pd.product_name = "CAR" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  car_total_amount ,
		sum(if( pd.product_name = "TRANSFER" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  transfer_total_amount 
		
		from `booking_global` bg,booking_transaction bt, product pd 
		where bg.booking_transaction_id = bt.booking_transaction_id and  bg.`product_id` = pd.product_id  and bg.`user_id` = "'.$userid.'" 
		 and bg.`user_type_id` = "'.$usertype.'" 
		group by  pd.product_id');
 
	//	$this->db->where('booking_global.product_id', $product);
	//	 echo $this->db->last_query();
			if ($res->num_rows() > 0) 
			{
				return $res->result();
			}
			else
			{
				return '';	
			}
 
	}
	public function get_recent_sales_profit($userid, $usertype){
		 $res = $this->db->query('select bg.voucher_date as booking_date,
		 sum(bt.total_amount) as sales,
		sum(bt.agent_markup) as profit
		
		from `booking_global` bg,booking_transaction bt, product pd 
		where bg.booking_transaction_id = bt.booking_transaction_id and  bg.`product_id` = pd.product_id  and bg.`user_id` = "'.$userid.'" 
		 and bg.`user_type_id` = "'.$usertype.'" 
		 and bg.voucher_date  > DATE_SUB(now(), INTERVAL 6 MONTH)  
		group by booking_date');
 
	//	$this->db->where('booking_global.product_id', $product);
	//	 echo $this->db->last_query();
			if ($res->num_rows() > 0) 
			{
				return $res->result();
			}
			else
			{
				return '';	
			}
 
	}
	public function get_recent_product_sales($userid, $usertype){
		 $res = $this->db->query('select pd.product_name as product_name,
		 sum(bt.total_amount) as sales,
		sum(bt.agent_markup) as profit
		
		from `booking_global` bg,booking_transaction bt, product pd 
		where bg.booking_transaction_id = bt.booking_transaction_id and  bg.`product_id` = pd.product_id  and bg.`user_id` = "'.$userid.'" 
		 and bg.`user_type_id` = "'.$usertype.'" 
		 and bg.voucher_date  > DATE_SUB(now(), INTERVAL 6 MONTH)  
		group by bg.`product_id`');
 
	//	$this->db->where('booking_global.product_id', $product);
	//	 echo $this->db->last_query();
			if ($res->num_rows() > 0) 
			{
				return $res->result();
			}
			else
			{
				return '';	
			}
 
	}
	
	public function get_notices($user_type){
		$res = $this->db->query('select * from notice_boards where user_type in ("ALL", "'.$user_type.'") and status="ACTIVE"');
		if($res->num_rows() > 0){
			return $res->result();
		} else {
			return '';
		}
	}
	
	public function get_employees($userid){
		$this->db->select('user_login_details.*,user_details.*');
		$this->db->join('user_login_details', 'user_login_details.user_id=user_details.user_id', 'left');
		$this->db->where('sub_user_id', $userid);
		$query = $this->db->get('user_details');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return '';
		}
	}
	
	public function get_verification_details($verify_id) {
		$this->db->select('*');
		$this->db->from('user_verifications');
		$this->db->where('user_id', $verify_id);

		$query = $this->db->get();   
		if ($query->num_rows() > 0) {
			 
			return $query->row();
		}else{
			return '';
		}
		
	 
	}
	public function get_superuser($userid){
		$this->db->select('*');
		$this->db->where('user_id', $userid);
		$query = $this->db->get('user_details');
		if($query->num_rows() > 0){
			return $query->row();
		} else {
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

		if ( $query->num_rows > 0 ) {
			return $query->result();
	    }else{
			return '';
		}
	}
	function get_fromcarcityid($pick_car_loc)
    {
        $this->db->select('*');
        $this->db->from('car_location');
        $this->db->where('LocationName',$pick_car_loc);
        //$this->db->like('CityName',$pick_car_loc);
        $query = $this->db->get();
        if($query->num_rows() == '')
        {
            return '';
        }
        else
        {
            return $query->row();
        }
    }
    
    function getPickupCountry() {
        $this->db->select('*');
        $this->db->from('pickup_car_country');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }
    
    public function load_pickup_cities($country_code) {
        $this->db->select('city_name,city_id');
        if ($country_code != '') {
            $this->db->where('country_id', $country_code);
        }
        $this->db->order_by('city_name', 'asc');
        $query = $this->db->get('pickup_car_cities');
        return $query;
    }
    
    public function load_pickup_location($city_code) {
        $this->db->select('location_name,location_id');
        if ($city_code != '') {
            $this->db->where('city_id', $city_code);
        }
        $this->db->order_by('location_name', 'asc');
        $query = $this->db->get('pickup_car_locations');
        return $query;
    }
    
    public function get_location_name($location_id) {
        $this->db->select('location_name,location_id');
        if ($location_id != '') {
            $this->db->where('location_id', $location_id);
        }
        $query = $this->db->get('pickup_car_locations');
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }
    function getResidenceCountry() {
        $this->db->select('*');
        $this->db->from('residence_country');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }
	function socialiconfunction(){
        $this->db->select('*');
        $this->db->from('social_link_details');
        $this->db->where('status', 'ACTIVE');
        $this->db->order_by("position", "asc");
        $this->db->limit(5);
        $query=$this->db->get();
        if($query->num_rows() ==''){
            return '';
        }else{
            return $query->result();
        }
    }
    function get_important_links(){
        $this->db->select('*');
        $this->db->from('static_pages');
        $this->db->where('status', '1');
        $this->db->order_by("id", "desc");
        $this->db->limit(5);
        $query=$this->db->get();
        if($query->num_rows() ==''){
            return '';
        }else{
            return $query->result();
        }
    }
    function footer_details_db()
    {
    	$this->db->select('*');
        $this->db->from('footer_details');
        $this->db->where('status', 'ACTIVE');
        $this->db->order_by("position", "ASC");
        $this->db->limit(3);
        $query=$this->db->get();
        // echo $this->db->last_query();die;
        if($query->num_rows() ==''){
            return '';
        }else{
            return $query->result();
        }
    }
	public function save_contact_us($data)
	{
		$this->db->insert('contact_us', $data);
		return true;
	}

	/*made change-13*/

	public function store_data_feedback($data){
		// //$this->load->database();
		//  exit("kgh");
		$insert_data['feedback_name'] = $data['feedback_name'];
		$insert_data['feedback_email'] = $data['feedback_email'];
		$insert_data['feedback_booking'] = $data['feedback_booking'];
		$insert_data['message'] = $data['message'];
		// //$insert_data['status'] = 1;
		
	$query = $this->db->insert('user_feedback', $insert_data);
	//$this->db->insert('user_feedback', $data);
	}

 /* show supplier_list data */
 	 public function store_deal_hotel(){
 		$this->db->insert('deal_flight', $data);
    }

    public function store_invite_email($data){
		//print_r($data);//exit;
		//  exit("kgh");
		$insert_data['email'] = $data['email'];
		$insert_data['user_id'] = $data['user_id'];
	$query = $this->db->insert('email_invite', $insert_data);
	
	}

	public function promo_list_deal(){
      $this->db->select('*');
      $this->db->from('promo');
      //$this->db->group_by('airport_code');
       return $this->db->get();
  	}
  	
  	public function promo_list_deal_by_userId($user_type,$user_id =''){
      $this->db->select('*');
      $this->db->from('promo');
      $this->db->where('user_type',$user_type);
      if ($user_type==1) {
      $this->db->where('user_id',$user_id);
      	// code...
      }
      //$this->db->group_by('airport_code');
       return $this->db->get();
  	}

  	public function get_knowloedge_base(){
      $this->db->select('*');
      $this->db->where('status','ACTIVE');
      $this->db->from('knowledge_base');
      return $this->db->get();
  	}
    
    public function get_api($api,$api_usage = ''){
        $this->db->where('api_details_id', $api);
        $this->db->where('api_status', 'ACTIVE');
        $query = $this->db->get('api_details');
        return $query;
  }
	public function getspecialFlightTrip(){
	    $this->db->where('status_new', '1');  
		$query = $this->db->get('special_flight_trip');
		if ( $query->num_rows > 0 ) {
       		$data= $query->result_array();
			return  $data;
   		}
		else
		{
      		return '';
		}
    }
    public function getFlightTripDetails($id)
    {
        $this->db->where('flight_trip_id',$id);
       $query= $this->db->get('special_flight_trip');
       	if ( $query->num_rows > 0 ) {
       		$data= $query->result_array();
			return  $data;
   		}
		else
		{
      		return '';
		}
    }
    
    	public function insertUserDetails($data)
	{
		$this->db->insert('b2c_special_flight_trip', $data);
		return true;
	}
	
	public function getreqFlightTrip(){
	
		$query = $this->db->get('b2c_special_flight_trip');
		if ( $query->num_rows > 0 ) {
       		$data= $query->result_array();
			return  $data;
   		}
		else
		{
      		return '';
		}
    }
    
    	public function getbusTrip(){
	    $this->db->where('status_new','1');
		$query = $this->db->get('bus_trip');
		if ( $query->num_rows > 0 ) {
       		$data= $query->result();
			return  $data;
   		}
		else
		{
      		return '';
		}
    }
    public function gethotalTrip(){
	    $this->db->where('hotel_status','1');
		$query = $this->db->get('hotel_trip');
		if ( $query->num_rows > 0 ) {
       		$data= $query->result();
			return  $data;
   		}
		else
		{
      		return '';
		}
    }
    
     public function getbusTripDetails($id)
    {
        $this->db->where('bus_trip_id',$id);
       $query= $this->db->get('bus_trip');
       	if ( $query->num_rows > 0 ) {
       		$data= $query->result_array();
			return  $data;
   		}
		else
		{
      		return '';
		}
    }
    public function gethotelTripDetails($id)
    {
        $this->db->where('hotel_trip_id',$id);
       $query= $this->db->get('hotel_trip');
       	if ( $query->num_rows > 0 ) {
       		$data= $query->result_array();
			return  $data;
   		}
		else
		{
      		return '';
		}
    }
    
    public function busUserDetails($data)
    {
        $this->db->insert('b2c_special_bus_trip', $data);
		return true;
    }
     public function hotelUserDetails($data)
    {
        $this->db->insert('b2c_special_hotel_trip', $data);
		return true;
    }
    public function searchFilter($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('b2c_special_flight_trip');
        return $query->result();
    }
    public function getb2cftrip(){
        $query = $this->db->get('b2c_special_flight_trip');
        return $query->result_array();
    }
}

?>
