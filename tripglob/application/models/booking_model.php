<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking_Model extends CI_Model {
 
public function get_xml_log_id($xml_log_id){
	 
    	$this->db->where('xml_logs_id',$xml_log_id);
		$query = $this->db->get('xml_logs');
		if ( $query->num_rows > 0 ) {
       		return $query->row();
		}
		else
		{
      		return '';
		}
    }
	public function get_recent_billing_details($user_id, $user_type){
	 
    	
		$this->db->where('user_id',$user_id);
		$this->db->order_by('billing_address_id','DESC');
		$query = $this->db->get('booking_billing_address');
		if ( $query->num_rows > 0 ) {
       		return $query->row();
		}
		else
		{
      		return '';
		}
    }
	  public function getBookingPnr($pnr_no,$productId){
		 
		 //$this->db->join('product','product.product_id = booking_global.product_id','LEFT');
	    // $this->db->where('booking_global.pnr_no',$pnr_no);
	    $this->db->where('booking_global_id',$pnr_no);
        
	    $this->db->where('product_id',$productId);
	     return  $this->db->get('booking_global');
	     // $this->db->last_query();exit();
	  
	   
    }
    public function getpassengerDetail($uid,$user_type)
    {
    	$this->db->join('user_details', 'user_details.user_id = booking_global.user_id','LEFT');
    	$this->db->join('user_type', 'user_type.user_type_id = booking_global.user_type_id','LEFT');
    	$this->db->join('booking_billing_address', 'booking_billing_address.billing_address_id = booking_global.billing_address_id','LEFT');
    	$this->db->join('booking_transaction', 'booking_transaction.booking_transaction_id = booking_global.booking_transaction_id','LEFT');
    	
		$this->db->where('booking_global.user_id',$uid);
		//$this->db->where('booking_global.user_type_id',$user_type);
   		return  $this->db->get('booking_global');
    }
    
 public function check_promocode($promo_code){

        $user_id =$this->session->userdata('user_type');
        if (empty($user_id) || $user_id == 0) {            
        $user_id =2;
        }
        $query = "select p.*,a.*,a.airline_code as booking_airline_code from promo as p left join airline_list as a on p.airline_code = a.airline_list_id where p.status='ACTIVE' and p.promo_code='".$promo_code."'and p.user_type='".$user_id."'and p.user_id= 0";       
        $execute_query = $this->db->query($query);
        if (count($execute_query->result()) == 0) {            
        $query = "select p.*,a.*,a.airline_code as booking_airline_code from promo as p left join airline_list as a on p.airline_code = a.airline_list_id where p.status='ACTIVE' and p.promo_code='".$promo_code."'and p.user_type='".$user_id."'and p.user_id='".$this->session->userdata('user_id')."'";
        $execute_query = $this->db->query($query);
        }
        $promo_arr = array();       
       
             // debug($execute_query->result());
        if($execute_query->num_rows()){
            return $execute_query->result();

        }else{
            return 0;
        }  
    }
	public function insert_booking_flight($booking_flight){
        $this->db->insert('booking_flight',$booking_flight);
        return $this->db->insert_id();
    }
    public function insert_booking_hotel($booking_hotel){
        $this->db->insert('booking_hotel',$booking_hotel);
        return $this->db->insert_id();
    }
     public function insert_booking_car($booking_car){
        $this->db->insert('booking_car',$booking_car);
        return $this->db->insert_id();
    }
    public function insert_booking_activity($booking_activity){
        $this->db->insert('booking_activity',$booking_activity);
        return $this->db->insert_id();
    }
    public function insert_booking_transfer($booking_activity){
        $this->db->insert('booking_transfer',$booking_activity);
        return $this->db->insert_id();
    }
    public function insert_booking_bus($booking_bus){
        $this->db->insert('booking_bus',$booking_bus);
        return $this->db->insert_id();
    }



    
    public function getBookingHotelTemp($booking_hotel_id){
        $this->db->where('booking_hotel_id',$booking_hotel_id);
        return $this->db->get('booking_hotel');
    }

     public function getBookingBusTemp($booking_bus_id){
        $this->db->where('booking_bus_id',$booking_bus_id);
        return $this->db->get('booking_bus');
    }
    


     public function getCountryName($country_code){
		$this->db->select('country_name');
        $this->db->where('country_code',$country_code);
        return $this->db->get('country_list');
    }
	public function insert_booking_transaction_data($data){
        $this->db->insert('booking_transaction',$data);
        return $this->db->insert_id();
    }
	public function insert_booking_payment_data($data){
        $this->db->insert('booking_payment',$data);
        return $this->db->insert_id();
    }
    public function insert_booking_payment_data_payment_getway($data){
        $this->db->insert('payment_gateway',$data);
        return $this->db->insert_id();
    }
	public function insert_booking_xml_data($data){
        $this->db->insert('booking_xml_data',$data);
        return $this->db->insert_id();
    }
	public function insert_booking_supplier_data($data){
        $this->db->insert('booking_supplier',$data);
        return $this->db->insert_id();
    }
	public function insert_booking_billing_address($data){
        $this->db->insert('booking_billing_address',$data);
        return $this->db->insert_id();
    }
	public function insert_booking_passenger($data){
        $this->db->insert_batch('booking_passenger',$data);
        return $this->db->insert_id();
    }
	public function insert_booking_global_data($booking){
        $this->db->insert('booking_global', $booking);
        return $this->db->insert_id();
    }
	public function getBookingFlightTemp($booking_flight_id){
        $this->db->where('booking_flight_id',$booking_flight_id);
        return $this->db->get('booking_flight');
    }
    public function getBookingActivityTemp($booking_sightseeing_id){
        $this->db->where('booking_sightseeing_id',$booking_sightseeing_id);
        return $this->db->get('booking_activity');
    }
    public function getBookingTransferTemp($booking_sightseeing_id){
        $this->db->where('booking_transfer_id',$booking_sightseeing_id);
        return $this->db->get('booking_transfer');
    }
    public function getBookingCarTemp($booking_car_id){
        $this->db->where('booking_car_id',$booking_car_id);
        return $this->db->get('booking_car');
    }
    public function getBookingCardetailbyid($referal_id){
        $this->db->where('booking_car_id',$referal_id);       
        $query = $this->db->get('booking_car');
        if ( $query->num_rows > 0 ) {        	
       		return $result = $query->result();
		}
    }




	public function getBookingpassengerTempFlight($booking_flight_id){
		$this->db->where('booking_global_id',$booking_flight_id);
		$this->db->where('passenger_type','ADULT');
		$query = $this->db->get('booking_passenger');
		if ( $query->num_rows > 0 ) {
       		$data['ADULT'] = $query->result();
		}else{
      		$data['ADULT'] =  '';
		}
		
		$this->db->where('booking_global_id',$booking_flight_id);
		$this->db->where('passenger_type','CHILD');
		$query = $this->db->get('booking_passenger');
		if ( $query->num_rows > 0 ) {
       		$data['CHILD'] = $query->result();
		}else{
      		$data['CHILD'] =  '';
		}
		
		$this->db->where('booking_global_id',$booking_flight_id);
		$this->db->where('passenger_type','INFANT');
		$query = $this->db->get('booking_passenger');
		if ( $query->num_rows > 0 ) {
       		$data['INFANT'] = $query->result();
		}else{
      		$data['INFANT'] =  '';
		}
		return $data;
	}
	public function getBookingpassengerTempCar($booking_flight_id){
		$this->db->where('booking_global_id',$booking_flight_id);
		$this->db->where('passenger_type','ADULT');
		$query = $this->db->get('booking_passenger');
		if ( $query->num_rows > 0 ) {
       		$data['ADULT'] = $query->result();
		}else{
      		$data['ADULT'] =  '';
		}
		return $data;
	}




	public function getBookingpassengerTemp($booking_flight_id){
		$this->db->where('booking_global_id',$booking_flight_id);
        return $this->db->get('booking_passenger');
    }
	public function getbillingaddressTemp($booking_flight_id){
        $this->db->where('billing_address_id',$booking_flight_id);
        return $this->db->get('booking_billing_address');
    }
	public function Update_Booking_Global($booking_temp_id, $update_booking){
		#debug($update_booking);
        // echo $booking_temp_id;
        // echo "<pre/>"; print_r($update_booking);die;
        $this->db->where('booking_global_id',$booking_temp_id);	 
        $this->db->update('booking_global', $update_booking);
      // echo $this->db->last_query();exit();
    }
    public function Update_Bus_Booking($booking_temp_id, $update_booking){
        #debug($update_booking);
        // echo $booking_temp_id;
        // echo "<pre/>"; print_r($update_booking);die;
        $this->db->where('parent_cart_id',$booking_temp_id);  
        $this->db->update('cart_bus', $update_booking);
       # echo $this->db->last_query();exit();
    }

    public function Update_Booking_Global_booking($booking_temp_id, $update_booking){
        #debug($update_booking);
        // echo $booking_temp_id;
        // echo "<pre/>"; print_r($update_booking);die;
        $this->db->where('booking_global_id',$booking_temp_id);  
        $this->db->update('booking_global', $update_booking);
       # echo $this->db->last_query();exit();


    }
    public function Update_Boooking_Payment($payment_id, $update_booking){
        $this->db->where('payment_id',$payment_id);	 
        $this->db->update('booking_payment', $update_booking);
    }
    
    public function Update_Booking_GlobalAfter($booking_temp_id, $update_booking){
        $this->db->where('booking_global_id',$booking_temp_id);
        $this->db->update('booking_global', $update_booking);
    }
	
	
	public function Update_Booking_xmldata($booking_temp_id, $update_booking){
        $this->db->where('booking_xml_data_id',$booking_temp_id);
	 
        $this->db->update('booking_xml_data', $update_booking);
    }
		public function Update_Booking_Supplier($booking_temp_id, $update_booking){
        $this->db->where('booking_supplier_id',$booking_temp_id);
	 
        $this->db->update('booking_supplier', $update_booking);
    }
	  public function getBookingByParentPnr($parent_pnr){
		  
        $this->db->where('booking_global.parent_pnr_no',$parent_pnr);
		$this->db->join('product', 'product.product_id = booking_global.product_id','LEFT');
		$this->db->join('api_details', 'api_details.api_details_id = booking_global.api_id','LEFT');
		$this->db->join('booking_payment', 'booking_payment.payment_id = booking_global.payment_id','LEFT');
        return $this->db->get('booking_global');
    }
	 public function get_booking_supplier_details($supplier_id){
        $this->db->where('booking_supplier.booking_supplier_id',$supplier_id);
		$this->db->join('booking_xml_data', 'booking_xml_data.booking_xml_data_id = booking_supplier.booking_xml_data_id','LEFT');
        return $this->db->get('booking_supplier');
    }
    public function get_booking_activity_details($supplier_id){
        $this->db->where('booking_activity.booking_sightseeing_id',$supplier_id);
        return $this->db->get('booking_activity');
    } 
    public function get_booking_transfer_details($supplier_id){
        $this->db->where('booking_transfer.booking_transfer_id',$supplier_id);
        return $this->db->get('booking_transfer');
    }
    
	public function getPassangerbyBookingId($bookid){
		$this->db->select('booking_passenger.*');
		$this->db->join('booking_global','booking_global.booking_global_id = booking_passenger.booking_global_id ','LEFT');
		//$this->db->join('booking_hotel','booking_hotel.id = booking_global.referal_id','LEFT');
		$this->db->where('booking_global.referal_id',$bookid);
		$this->db->where('booking_global.product_id',2);
       return  $this->db->get('booking_passenger');
        //return $this->db->last_query();exit;
	}    
    
	
	public function getBookingbyPnr($pnr_no,$module){
	 if($module == '1'){
			$this->db->join('booking_flight','booking_global.referal_id = booking_flight.booking_flight_id');
		}
    	if($module == '2'){
    		  $this->db->join('booking_hotel','booking_global.referal_id = booking_hotel.booking_hotel_id');

    	}
        if($module == '8'){
          $this->db->join('booking_bus','booking_global.referal_id = booking_bus.booking_bus_id');

        }
			$this->db->join('booking_payment', 'booking_payment.payment_id = booking_global.payment_id','LEFT');
			$this->db->join('booking_transaction', 'booking_transaction.booking_transaction_id = booking_global.booking_transaction_id','LEFT');
		//	$this->db->join('booking_supplier', 'booking_supplier.booking_supplier_id = booking_global.booking_supplier_id','LEFT');
			
			$this->db->join('booking_billing_address', 'booking_billing_address.billing_address_id = booking_global.billing_address_id','LEFT');
			
			$this->db->join('user_type', 'user_type.user_type_id = booking_global.user_type_id','LEFT');
			
			
       		$this->db->where('booking_global.booking_global_id',$pnr_no);
       return  $this->db->get('booking_global');
         //echo $this->db->last_query();exit;
    }
    public function getBookingbyPnr_Hotel($pnr_no,$module){
     if($module == 'FLIGHT'){
            $this->db->join('booking_flight','booking_global.referal_id = booking_flight.booking_flight_id');
        }
    if($module == 'HOTEL'){
          $this->db->join('booking_hotel','booking_global.referal_id = booking_hotel.booking_hotel_id');

    }
            $this->db->join('booking_payment', 'booking_payment.payment_id = booking_global.payment_id','LEFT');
            $this->db->join('booking_transaction', 'booking_transaction.booking_transaction_id = booking_global.booking_transaction_id','LEFT');
        //  $this->db->join('booking_supplier', 'booking_supplier.booking_supplier_id = booking_global.booking_supplier_id','LEFT');
            
            $this->db->join('booking_billing_address', 'booking_billing_address.billing_address_id = booking_global.billing_address_id','LEFT');
            
            $this->db->join('user_type', 'user_type.user_type_id = booking_global.user_type_id','LEFT');
            
            
            $this->db->where('booking_global.parent_pnr_no',$pnr_no);
       return  $this->db->get('booking_global');
         //echo $this->db->last_query();exit;
    }

     public function getBookingbyPnr_Bus($pnr_no,$module){
     if($module == 'FLIGHT'){
            $this->db->join('booking_flight','booking_global.referal_id = booking_flight.booking_flight_id');
        }
    if($module == 'HOTEL'){
          $this->db->join('booking_hotel','booking_global.referal_id = booking_hotel.booking_hotel_id');

    }
     if($module == 'BUS'){
          $this->db->join('booking_bus','booking_global.referal_id = booking_bus.booking_bus_id');

    }
            $this->db->join('booking_payment', 'booking_payment.payment_id = booking_global.payment_id','LEFT');
            $this->db->join('booking_transaction', 'booking_transaction.booking_transaction_id = booking_global.booking_transaction_id','LEFT');
        //  $this->db->join('booking_supplier', 'booking_supplier.booking_supplier_id = booking_global.booking_supplier_id','LEFT');
            
            $this->db->join('booking_billing_address', 'booking_billing_address.billing_address_id = booking_global.billing_address_id','LEFT');
            
            $this->db->join('user_type', 'user_type.user_type_id = booking_global.user_type_id','LEFT');
            
            
            $this->db->where('booking_global.parent_pnr_no',$pnr_no);
       return  $this->db->get('booking_global');
         //echo $this->db->last_query();exit;
    }

    public function getBookingbyPnr_sight($pnr_no,$module){
	 if($module == 'ACTIVITY'){
			$this->db->join('booking_activity','booking_global.referal_id = booking_activity.booking_sightseeing_id');
		}
		if($module == 'TRANSFER'){
			$this->db->join('booking_transfer','booking_global.referal_id = booking_transfer.booking_transfer_id');
		}
			$this->db->join('booking_payment', 'booking_payment.payment_id = booking_global.payment_id','LEFT');
			$this->db->join('booking_transaction', 'booking_transaction.booking_transaction_id = booking_global.booking_transaction_id','LEFT');
		//	$this->db->join('booking_supplier', 'booking_supplier.booking_supplier_id = booking_global.booking_supplier_id','LEFT');
			
			$this->db->join('booking_billing_address', 'booking_billing_address.billing_address_id = booking_global.billing_address_id','LEFT');
			
			$this->db->join('user_type', 'user_type.user_type_id = booking_global.user_type_id','LEFT');
			
			
       		$this->db->where('booking_global.parent_pnr_no',$pnr_no);
       return  $this->db->get('booking_global');
         //echo $this->db->last_query();exit;
    }
	public function getPassengerbyPnr($pnr_no){
		$this->db->where('booking_global_id',$pnr_no);
        return $this->db->get('booking_passenger');
    }
	public function getPassengerbyid($booking_global_id){
				$this->db->where('booking_global_id',$booking_global_id);
        return $this->db->get('booking_passenger');

    }
    public function getagentbyid($billing_address_id){
				$this->db->where('billing_address_id',$billing_address_id);
        return $this->db->get('booking_billing_address');
    }
	public function getbookingTransaction($booking_transaction_id){
        $this->db->where('booking_transaction_id',$booking_transaction_id);
        return $this->db->get('booking_transaction');

    }
	public function update_booking_xml($booking_xml_log,$booking_xml_data_id)
	{
		//print_r($booking_xml_log); exit();
		$this->db->where("booking_xml_data_id",$booking_xml_data_id);
		$this->db->update("booking_xml_data",$booking_xml_log);
		

	}
    public function get_admin_details(){
        $admin_id = ADMIN_ID;
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

    function get_admin_markup($session_id){
        $this->db->select('*');
        $this->db->from('tf_routing_res');
        $this->db->where('session_id',$session_id);
        $this->db->limit('1');
   
        $query = $this->db->get();    
      //  echo $this->db->last_query();exit;      
        if ($query->num_rows() != '') {
          $result = $query->result();
          return $result;
        } else {
          return false;
        }   

    }
     function update_booking_global_sabre($parent_pnr, $update_booking){
        $this->db->where('parent_pnr_no',$parent_pnr);
        $this->db->update('booking_global', $update_booking);
    }
    function getcarvocherdata($cart_car_id)
    {
        return false;
    }
    
    /*new added */
    function insert_change_request($data)
    {
        $this->db->insert('change_request', $data);
        return $this->db->insert_id();
    }
    /*end*/
    
    public function update_payment_response_payu($parent_pnr, $update_booking){
        $this->db->where('parent_pnr_book',$parent_pnr);	 
        $this->db->update('booking_payment', $update_booking);
    }

	
	
}

?>
