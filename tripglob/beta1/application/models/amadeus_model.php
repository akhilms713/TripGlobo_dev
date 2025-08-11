<?php

class Amadeus_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function get_api($api){
		
		$this->db->where('api_name', $api);
        $this->db->where('api_status', 'ACTIVE');
        $query = $this->db->get('api_details');
        return $query;
	}

    public function get_hotel_cities_list($term) {
        $this->db->like('city', $term);
        $this->db->order_by("city", "asc");
        $this->db->limit(10);
        return $this->db->get('api_hotels_city');
    }
    
    public function get_car_cities_list($term) {
        $this->db->like('LocationName', $term);
        $this->db->order_by("LocationName", "asc");
        $this->db->limit(10);
        return $this->db->get('car_location');
    }

    public function address_countries() {
        $this->db->distinct();
        $this->db->select('country_id,country_name,iso_code');
        $this->db->order_by('country_name', 'asc');
        $query = $this->db->get('country_details');
        return $query;
    }

    public function country_telecode_list() {
        $que = "SELECT * , SUBSTR( phone_code, 2 ) AS phone FROM country_details ORDER BY CAST( phone AS UNSIGNED )";
        $query = $this->db->query($que);
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    public function load_countries() {
        $this->db->distinct();
        $this->db->select('countryName,countryCode');
        $this->db->order_by('countryName', 'asc');
        $query = $this->db->get('iata_cities');
        return $query;
    }

    public function load_cities($country_code) {
        $this->db->select('cityName,cityCode');
        if ($country_code != '') {
            $this->db->where('countryCode', $country_code);
        }
        $this->db->order_by('cityName', 'asc');
        $query = $this->db->get('iata_cities');
        return $query;
    }

    public function get_city_terminals($city) {
        $query = $this->db->query("SELECT b.code, b.name
                                    FROM hotelbeds_terminal_transfer_zones AS a
                                    LEFT OUTER JOIN hotelbeds_terminal AS b ON a.terminal_code = b.code
                                    WHERE a.destination_code = '$city'
                                    GROUP BY a.terminal_code
                                    ORDER BY b.name ASC");
        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        } else
            return '';
    }

    function get_terminal_hotels($terminal_code, $hotel_code = '') {
        $this->db->select('t.hotel_code as hotel_code,h.Name as hotel_name');
        $this->db->from('hotelbeds_hotel_terminals t');
        $this->db->join('hotelbeds_Hotels h', 't.hotel_code = h.HotelCode');
        $this->db->where('t.terminal_code', $terminal_code);
        if($hotel_code!=''){
			$this->db->where('t.hotel_code', $hotel_code);
		}
		
        $query = $this->db->get();
		
        $this->load->database('default', TRUE);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return '';
    }

    public function insert_cart_global($cart_global) {
        $this->db->insert('cart_global', $cart_global);
        return $this->db->insert_id();
    }

    public function getCartData($session_id) {
        $this->db->where('cart_id', $session_id);
        return $this->db->get('cart_global');
    }

    public function getCartDataByModule($cart_id, $module = '') {
        if ($module == 'SIGHTSEEN') {
            $this->db->where('cart_id', $cart_id);
            $this->db->join('cart_sightseen', 'cart_sightseen.ID = cart_global.ref_id');
            return $this->db->get('cart_global');
        }
        if ($module == 'Hotel') {
            $this->db->where('cart_id', $cart_id);
            $this->db->join('cart_hotel', 'cart_hotel.ID = cart_global.ref_id');
            return $this->db->get('cart_global');
            //echo $this->db->last_query(); exit();
        }
        if ($module == 'CRS-Hotel') {
            $this->db->where('cart_id', $cart_id);
            $this->db->join('cart_hotel', 'cart_hotel.ID = cart_global.ref_id');
            return $this->db->get('cart_global');
            //echo $this->db->last_query(); exit();
        }
		if ($module == 'TRANSFER') {
            $this->db->where('cart_id', $cart_id);
            $this->db->join('cart_transfer', 'cart_transfer.ID = cart_global.ref_id');
            return $this->db->get('cart_global');
        }
        if ($module == 'FLIGHT') {
            $this->db->where('cart_id', $cart_id);
            $this->db->join('cart_flight', 'cart_flight.ID = cart_global.ref_id');
            //$this->db->join('flightInputParameters', 'flightInputParameters.randId = cart_flight.rand_id');
            return $this->db->get('cart_global');
        }
        
        if ($module == 'CAR') {
            $this->db->where('cart_id', $cart_id);
            $this->db->join('cart_car', 'cart_car.car_cart_id = cart_global.ref_id');
            //$this->db->join('flightInputParameters', 'flightInputParameters.randId = cart_flight.rand_id');
            return $this->db->get('cart_global');
        }

         if ($module == 'Car-CRS') {
            $this->db->where('cart_id', $cart_id);
            $this->db->join('cart_car', 'cart_car.car_cart_id = cart_global.ref_id');
            //$this->db->join('flightInputParameters', 'flightInputParameters.randId = cart_flight.rand_id');
            return $this->db->get('cart_global');
        }
    }

   /* public function get_Transferdata($cart_id){
        $module == 'Hotel') {
            $this->db->where('cart_id', $cart_id);
            $this->db->where('cart_id', $cart_id);
            $this->db->join('cart_hotel', 'cart_hotel.ID = cart_global.ref_id');
            return $this->db->get('cart_global');
            }}*/
    public function getcartData_Session($value,$module)
    {
        if ($module == 'FLIGHT') {
           $this->db->join('cart_flight', 'cart_flight.ID = cart_global.ref_id');
            $this->db->where('session_id', $value);
            return $this->db->get('cart_global');
        }
    }
    public function clearCart($cart_id = '', $session_id = ''){
		//$this->db->select('ref_id, cart_id','module');
         if($session_id!=''){
			$this->db->where('session_id',$session_id);
		} else {
			if($cart_id!=''){
				$this->db->where('cart_id',$cart_id);
			}
		}
        $data 	= $this->db->get('cart_global')->result();
        //echo "<pre/>";print_r($data);exit;
		$ref_id = $data[0]->ref_id;
		$cart_id1 = $data[0]->cart_id;
		$module = $data[0]->module;
		if($module == 'SIGHTSEEN'){
			$this->db->where('ID',$ref_id);
			$this->db->delete('cart_sightseen');
        } else if($module == 'HOTEL'){
			$this->db->where('shopping_cart_hotel_id',$ref_id);
			$this->db->delete('cart_hotel');
		} else if($module == 'TRANSFER'){
			$this->db->where('ID',$ref_id);
			$this->db->delete('cart_transfer');
		} else {
		}
		$this->db->where('cart_id',$cart_id1);
		$this->db->delete('cart_global');
	}
	
	public function Booking_Global($booking){
        $this->db->insert('booking_global', $booking);
        return $this->db->insert_id();
    }
    
    public function Update_Booking_Global($booking_temp_id, $update_booking, $module){
        $this->db->where('id',$booking_temp_id);
		$this->db->where('module',$module);
        $this->db->update('booking_global', $update_booking);
    }
    
    public function validate_order_id_org($order_id='', $globalid=''){
		if($order_id!=''){
			$this->db->where('parent_pnr',$order_id);
		} if($globalid!=''){
			$this->db->where('id',$globalid);
		}
		return $this->db->get('booking_global');
	}
	
	public function getBookingbyPnr($pnr_no,$module){
		if($module == 'SIGHTSEEN'){
			$this->db->join('booking_sightseen','booking_global.ref_id = booking_sightseen.booking_sightseen_id');
		}
		if($module == 'TRANSFER'){
			$this->db->join('booking_transfer','booking_global.ref_id = booking_transfer.booking_transfer_id');
		}
		if($module == 'HOTEL'){
			$this->db->join('booking_hotel','booking_global.ref_id = booking_hotel.id');
		}
        if($module == 'Flight'){
            $this->db->join('booking_flight','booking_global.ref_id = booking_flight.id');
        }
		
		$this->db->where('pnr_no',$pnr_no);
        return $this->db->get('booking_global');
    }
    
   // B2C Markup for Flight (TBO API/ADMIN)
	public function get_adminmarkup($product, $api) {
		$this->db->select('markup_value, markup_fixed');
        $this->db->from('markup_details m');
        $this->db->join('domain_details d','d.domain_details_id = m.domain_details_id');
        $this->db->join('product_details p','p.product_details_id = m.product_details_id');
        $this->db->join('api_details a','a.api_details_id = m.api_details_id');
        $this->db->where('d.domain_status','Active');
        $this->db->where('p.product_status','Active');
        $this->db->where('a.api_status','Active');
        $this->db->where('a.api_name', $api);
        $this->db->where('d.domain_url', 'http://www.fly2escape.com');
        $this->db->where('p.product_name', $product);
        $this->db->where('markup_type', 'GENERAL');
        $this->db->where('m.status', 'ACTIVE');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else { 
			return '';
		}
    }
     /* 
    // B2C Markup for Payment Charges
    function get_pgmarkup($product, $api) 
    {
       $this->db->select('markup_value');
       $this->db->from('payment_charges_details p');
       $this->db->join('payment_api_details pa','pa.payment_api_details_id=p.payment_api_details_id');
       $this->db->join('domain_details d','d.domain_details_id=p.domain_details_id');
       $this->db->join('product_details pd','pd.product_details_id=p.product_details_id');
       $this->db->join('api a','a.api_id=p.api_details_id');
       $this->db->where('d.domain_url','www.tripkonnect.com');
       $this->db->where('pd.product_name',$product);
       $this->db->where('a.api_name', $api);
       $this->db->where('p.status','ACTIVE');
	   $query = $this->db->get();
	   if ($query->num_rows > 0) 
       {
           return $query->result();
       }
    } */
	public function get_pproduct()
    {
        $data['product_status'] = "ACTIVE";
        return $this->db->get_where('product_details',$data);
    }
	public function get_contact_address(){
		$this->db->select('contact_address, contact_number, email_address');
		$this->db->from('general_settings');
		$query = $this->db->get();
		if ($query->num_rows > 0) 
		{
           return $query->result();
		} else return '';
	}
	public function get_currency_list($id = '', $currency = ''){
		$this->db->select('*');
		if($id!=''){
			$this->db->where('cur_id',$id);
		} if($currency != ''){
			$this->db->where('currency_code',$currency);
		}
        $this->db->order_by("currency_code", "asc");
		$query = $this->db->get('currency_details');
		if ( $query->num_rows > 0 ) {
			return $query->result();
		}
		return false;
	}
	public function getCountryCode($value)
    {
        $data["country_name"] = $value;
        return $this->db->get_where('country_details',$data);
    }
	public function get_airport_list($query){
		//$this->db->like('airport_name', $query);
		$this->db->like('airport_city', $query); 
		$this->db->or_like('airport_code', $query); 
		//$this->db->or_like('country', $query);
        $this->db->limit(8);
		return $this->db->get('iata_airport_list');
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

  /*  public function get_manage_flights()
    {
        $this->db->where('deal_status','ACTIVE');
       //$this->db->where('departure_date >=',date('m/d/Y'));
      
        return $this->db->get('flight_deals')->result_array();
    }*/

      public function get_manage_flights($best_deals_id = ''){
         $this->db->select('*');
        $this->db->from('best_deals');
        if ($best_deals_id != '') {
            $array = array('best_deals_id' => $best_deals_id, 'status' => 'ACTIVE');
            $this->db->where($array);
        } else {
            $this->db->where('best_deals.status', 'ACTIVE');
            $this->db->where('best_deals.best_deals_name','Flightss');
            $this->db->join('flight_deals','flight_deals.deal_category = best_deals.best_deals_id','left');
        }
        $this->db->order_by("flight_deals.position", "asc");
        $query = $this->db->get();
      
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

    public function save_traveller($postData){
        return $this->db->insert('traveller_details', $postData);
    }

    public function travellers($userid){
        $this->db->where('user_details_id',$userid);
        return $this->db->get('traveller_details');
    }

    public function get_country_name($country_id){
        $this->db->select('country_id,country_name,iso3_code')
                    ->from('country_details')
                    ->where('country_id', $country_id);
        $query = $this->db->get();
        if($query->num_rows() == ''){
            return '';
        } else {
            return $query->result();
        }
    }

    public function get_user_profile($ss_dtl_id){
        $this->db->select('*');
        $this->db->from('user_details AS t1');
        $this->db->join('address_details AS t2', 't2.address_details_id = t1.address_details_id');
        $this->db->join('country_details AS t3', 't2.country_id = t3.country_id');
        $this->db->where('t1.user_details_id', $ss_dtl_id);
        return $this->db->get()->result_array()[0];
    }

    public function remove_traveller($data){
         return $this->db->delete('traveller_details',$data);
    }

    public function get_hotel_list($query){
        $this->db->distinct();
        //$this->db->like('city_name', $query);
        //$this->db->like('country', $query); 
        $this->db->like('City_name', $query); 
        //$this->db->or_like('country', $query);
        $this->db->limit(8);
        return $this->db->get('api_hotels_city');
    }

    public function get_Hotel_Name($value)
    {
        return $this->db->get_where('api_permanent_hotel_hotelspro',$value);
        //echo $this->db->last_query();
    }

    public function makeHotelCrsBooking($book_temp_data,$table_data){
  $data['method'] = "makeHotelBooking";
  $data['processId'] = $book_temp_data[0]->process_id;
  $data['agencyReferenceNumber'] = "HJHHJKHJKHKJH".time();
  $leadpax = json_decode(base64_decode($book_temp_data[0]->passenger_details));
  //echo "<pre>"; print_r($req); echo "<pre/>";die;
  $nationality = $book_temp_data[0]->contact_country;  
  //$leadpax = json_decode($book_temp_data->passenger_details);
  //echo "<pre>";print_r($leadpax);die();
  $data['leadTravellerInfo']['paxInfo']['paxType'] = "Adult";
  $data['leadTravellerInfo']['paxInfo']['title'] = $book_temp_data[0]->contact_sur_name;
  $data['leadTravellerInfo']['paxInfo']['firstName'] = $book_temp_data[0]->contact_fname;
  $data['leadTravellerInfo']['paxInfo']['lastName'] = $book_temp_data[0]->contact_mname;
  $data['leadTravellerInfo']['nationality'] = $nationality;
  //$data['leadTravellerInfo']['ipAddress'] = $global_book->ip;
  $data['leadTravellerInfo']['ipAddress'] = $_SERVER['SERVER_ADDR'];
  $data['leadTravellerInfo']['invoiceToCustomer'] = "no";
  if(isset($leadpax)){
    for ($s=0,$r=1; $s < (count($leadpax->pfirst_name)-1); $s++,$r++) { 
      $data['otherTravellerInfo'][$s]['title'] = $leadpax->title[$r];
      $data['otherTravellerInfo'][$s]['firstName'] = $leadpax->pfirst_name[$r];
      $data['otherTravellerInfo'][$s]['lastName'] = $leadpax->plast_name[$r];
    }
  }
   
  if(isset($leadpax->cfirst_name)) 
  {
    for ($s=0,$r=(count($leadpax->pfirst_name)-1); $s < (count($leadpax->cfirst_name)); $s++,$r++) { 
    $data['otherTravellerInfo'][$r]['title'] = $leadpax->ctitle[$s];
    $data['otherTravellerInfo'][$r]['firstName'] = $leadpax->cfirst_name[$s];
    $data['otherTravellerInfo'][$r]['lastName'] = $leadpax->clast_name[$s];
  }
  }
  // echo "<pre>"; print_r($data); echo "<pre/>";die;
  $data['hotelCode'] = $book_temp_data[0]->booking_hotel_code;

  /*$rooms_v1 = http_build_query($data);
  $rooms_v1 =  str_replace("%5B","[",(str_replace("%5D","]",str_replace("%3D","=",$rooms_v1))));
  $url = $api_url."?".$rooms_v1;
  //print_r($url);die();
  $response = $this->curl_execution($url);*/
  // echo "<pre>"; print_r(json_decode($response)); echo "<pre/>";die;
  $response = 'CONFIRMED';
   $padata["booking_status"] = "CONFIRMED";
   /*$presponse = json_decode($response);
   if ($presponse->hotelBookingInfo->bookingStatus == 1) {
     $padata["booking_status"] = "CONFIRMED";
   } else if($presponse->hotelBookingInfo->bookingStatus == 2){
     $padata["booking_status"] = "PENDING";
   } else if($presponse->hotelBookingInfo->bookingStatus == 3){
      $padata["booking_status"] = "FAILED";
   } else if($presponse->hotelBookingInfo->bookingStatus == 4){
      $padata["booking_status"] = "CANCELLED";
   } else{
      $padata["booking_status"] = "HOLD";
   }*/
  $where["id"] = $table_data["bid"]; 
  //$padata["hotelspro_booking"] = $response;
  $this->Hotel_Model->update_bookingglobal($padata,$where);
 return $response;  
}


}
