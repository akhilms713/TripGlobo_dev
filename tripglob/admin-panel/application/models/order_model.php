<?php
class Order_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	public function get_crs_orders($module,$post,$api_id ,$pnr_no=""){

		 if($module == 'HOTEL' OR $api_id ==20 ){
			$select = 'booking_hotel.*';
		}
        if($module == 'TRANSFER_CRS' OR $api_id == 16){
           $select = 'booking_transfer.*';
        }
        if($module == 'PACKAGES' OR $api_id == 17){
           $select = 'booking_package.*';
        }
        if($module == 'TOUR' OR $api_id == 19){
            $select = 'booking_city_tour.*';
        }
        if($module == 'FLIGHT'){
            $select = 'booking_flight.*';
        }

		$this->db->select('booking_global.*, '.$select.',booking_transaction.*,user_details.user_name,user_details.user_email,user_details.profile_picture');
		// $this->db->join('booking_global','booking_global.reference_id=booking_global.booking_global_id','LEFT');
		$this->db->join('booking_transaction','booking_transaction.booking_transaction_id=booking_global.booking_transaction_id','LEFT');
		$this->db->join('user_details','user_details.user_id=booking_global.user_id','LEFT');
		
		 if($module == 'HOTEL' OR $api_id ==20){
			$this->db->join('booking_hotel','booking_global.referal_id = booking_hotel.booking_hotel_id');
		}
        if($module == 'TRANSFER_CRS' OR $api_id == 16){
            $this->db->join('booking_transfer','booking_global.referal_id = booking_transfer.booking_transfer_id');
        }
        if($module == 'PACKAGES' OR $api_id ==17){
            $this->db->join('booking_package','booking_global.referal_id = booking_package.booking_package_id');
        }
        if($module == 'TOUR' OR $api_id ==19){
            $this->db->join('booking_city_tour','booking_global.referal_id = booking_city_tour.booking_tour_id');
        }
        if($module == 'FLIGHT'){
            $this->db->join('booking_flight','booking_global.referal_id = booking_flight.booking_flight_id');
        }

		if($module!='')
		{
		$this->db->where('booking_global.module',$module);	
		}

		if(!empty($api_id))
		{
		$this->db->where('booking_global.api_id',$api_id);	
		}
		if(!empty($pnr_no))
		{
			$this->db->where('booking_global.pnr_no',$pnr_no);
		}
		
		if(($post['from_date']!='') && ($post['to_date']!='')){
		$this->db->where('booking_global.voucher_date BETWEEN "'.$post["from_date"].'" AND "'.$post["to_date"].'"', NULL, FALSE );	
		}
		if($post['pnr_no']!='')
		{
		$this->db->where('booking_global.pnr_no',$post['pnr_no']);	
		}
		if($post['booking_status']!='')
		{
		$this->db->where('booking_global.booking_status',$post['booking_status']);	
		}
		$result = $this->db->get('booking_global');
		// echo $this->db->last_query(); exit();
		if($result->num_rows() > 0 )
		{
			return $result->result();
		}
		return '' ;
	}
	public function get_all_oders($user_type_id,$user_id='')
	{
		 
		$this->db->select('booking_global.*,booking_transaction.*,user_details.user_name,user_details.user_email,user_details.profile_picture');

		$this->db->join('booking_transaction','booking_transaction.booking_transaction_id=booking_global.booking_transaction_id','LEFT');
		$this->db->join('user_details','user_details.user_id=booking_global.user_id','LEFT');
		if($user_id!='')
		{
		$this->db->where('booking_global.user_id',$user_id);	
		}
		$this->db->where('booking_global.user_type_id',$user_type_id);
		$result = $this->db->get('booking_global');
		if($result->num_rows() > 0 )
		{
			return $result->result();
		}
		
		return '' ;

	}

	public function get_flight_booking_details($flight_id)
	{
		 	
		
		$this->db->where('booking_flight.booking_flight_id',$flight_id);
		$result = $this->db->get('booking_flight');
		if($result->num_rows() > 0 )
		{
			$status = $result->row();
		}
		
		return $status ;

	}
	
public function get_hotel_booking_details($hotel_id)
	{
		
		$this->db->where('booking_hotel.id',$hotel_id);
		$this->db->join('cart_hotel','cart_hotel.cart_hotel_id=booking_hotel.shopping_cart_hotel_id','LEFT');
		$result = $this->db->get('booking_hotel');
		if($result->num_rows() > 0 )
		{
			$status = $result->row();
		}
		
		return $status ;

	}
	
	
	public function get_transaction_details_all($booking_transaction_id)
	{
		 	
	 
		$this->db->where('booking_transaction_id',$booking_transaction_id);
		$result = $this->db->get('booking_transaction');
	 

	
		if($result->num_rows() > 0 )
		{
		return  $result->row();
		}
		
		return '' ;

	}
	
public function get_promo_info($promoid)
	{
		 	
	 
		$this->db->where('promo_id',$promoid);
		$result = $this->db->get('promo');
	 
		if($result->num_rows() > 0 )
		{
		return  $result->row();
		}
		
		return '' ;

	}
	
	
	
public function get_transaction_details($booking_global_id)
	{
		$this->db->where('user_transaction.booking_id',$booking_global_id);
		$result = $this->db->get('user_transaction');
	 	//  echo $this->db->last_query(); exit;
		if($result->num_rows() > 0 )
		{
		return  $result->row();
		}
		
		return '' ;

	}

	public function get_order_details($pnr_no,$user_type_id='')
	{
		
/*		 
SELECT `booking_global`.*, `booking_transaction`.*, `user_details`.`user_name`, `user_details`.`user_email`, `user_details`.`profile_picture`, `booking_supplier`.*, `booking_payment`.*, `booking_billing_address`.*, `api_details`.`api_name`, `booking_xml_data`.*, `product`.`product_name`
FROM (`booking_global`)
LEFT JOIN `booking_transaction` ON `booking_transaction`.`booking_transaction_id`=`booking_global`.`booking_transaction_id`
LEFT JOIN `user_details` ON `user_details`.`user_id`=`booking_global`.`user_id`
LEFT JOIN `booking_billing_address` ON `booking_billing_address`.`billing_address_id`=`booking_global`.`billing_address_id`
LEFT JOIN `api_details` ON `api_details`.`api_details_id`=`booking_global`.`api_id`
LEFT JOIN `booking_payment` ON `booking_payment`.`payment_id`=`booking_global`.`payment_id`
LEFT JOIN `product` ON `product`.`product_id`=`booking_global`.`product_id`
LEFT JOIN `booking_supplier` ON `booking_supplier`.`booking_supplier_id`=`booking_global`.`booking_supplier_id`
LEFT JOIN `booking_xml_data` ON `booking_xml_data`.`booking_xml_data_id`=`booking_supplier`.`booking_xml_data_id`
WHERE `booking_global`.`pnr_no` =  'AMA846846976'
*/
		
		$this->db->select('booking_global.*,booking_transaction.*,user_details.user_name,user_details.user_email,user_details.profile_picture,booking_supplier.*,booking_payment.*,booking_billing_address.*,api_details.api_name,product.product_name');
		//$this->db->select('booking_global.*,booking_transaction.*,user_details.user_name,user_details.user_email,user_details.profile_picture,booking_supplier.*,booking_payment.*,booking_billing_address.*,api_details.api_name,booking_xml_data.*,product.product_name');
		//~ $this->db->select('*');
		$this->db->join('booking_transaction','booking_transaction.booking_transaction_id=booking_global.booking_transaction_id','LEFT');
		$this->db->join('user_details','user_details.user_id=booking_global.user_id','LEFT');
		$this->db->join('booking_billing_address','booking_billing_address.billing_address_id=booking_global.billing_address_id','LEFT');
		$this->db->join('api_details','api_details.api_details_id=booking_global.api_id','LEFT');
		$this->db->join('booking_payment','booking_payment.payment_id=booking_global.payment_id','LEFT');
		$this->db->join('product','product.product_id=booking_global.product_id','LEFT');
		$this->db->join('booking_supplier','booking_supplier.booking_supplier_id=booking_global.booking_supplier_id','LEFT');
		//$this->db->join('booking_xml_data','booking_xml_data.booking_xml_data_id=booking_supplier.booking_xml_data_id','LEFT');
	
		if($user_type_id!='')	 	
		{
			$this->db->where('booking_global.user_type_id',$user_type_id);
		}
		$this->db->where('booking_global.pnr_no',$pnr_no);
		
		$result = $this->db->get('booking_global');
		
		//echo $this->db->last_query();
		//echo '<pre/>sds';print_r($result->row());exit;
		if($result->num_rows() > 0 )
		{
		return $result->row();
		}
		
		return '' ;

	}


	public function get_passanger_details($pnr_no)
	{
		 
		$this->db->select('*');
		$this->db->where('booking_passenger.booking_global_id',$pnr_no);
		$result = $this->db->get('booking_passenger');
	$status='';
		if($result->num_rows() > 0 )
		{
			$status = $result->result();
		}
		
		return $status ;

	}
	public function get_xml_details($pnr_no)
	{
		 
		$this->db->select('*');
		$this->db->where('booking_passenger.booking_global_id',$pnr_no);
		$result = $this->db->get('booking_passenger');
		if($result->num_rows() > 0 )
		{
			$status = $result->result();
		}
		
		return $status ;

	}
	
	
		public function getBookingbyPnr($pnr_no,$module){
		 if($module == 'FLIGHT'){
			$this->db->join('booking_flight','booking_global.referal_id = booking_flight.booking_flight_id');
		}
		 if($module == 'HOTEL'){
			$this->db->join('booking_hotel','booking_global.referal_id = booking_hotel.id');
		}
		$this->db->join('booking_transaction','booking_transaction.booking_transaction_id = booking_global.booking_transaction_id');
        $this->db->where('booking_global.pnr_no',$pnr_no);
        return $this->db->get('booking_global');
    }
    
    	public function getBookingTemphotel($cart_global_id){
        $this->db->where('cart_hotel_id',$cart_global_id);
       // $this->db->join('cart_global','cart_global.referal_id = cart_hotel.cart_hotel_id');      
		$query = $this->db->get('cart_hotel');
		//return $this->db->last_query();
		if($query->num_rows() != 0 )
		{
			return $query->row();
		}
		else
		{
			return '';
		}
		
    }
	 public function getBookingPnr($pnr_no){
		  $this->db->join('product','product.product_id = booking_global.product_id','LEFT');
		$this->db->where('booking_global.pnr_no',$pnr_no);
	    return $this->db->get('booking_global');
    }
	public function getPassengerbyid($booking_global_id){
				$this->db->where('booking_global_id',$booking_global_id);
        return $this->db->get('booking_passenger');

    }
    public function getagentbyid($billing_address_id){
				$this->db->where('billing_address_id',$billing_address_id);
        return $this->db->get('booking_billing_address');
    }
      public function get_airport_name($code){
        $this->db->select('airport_name as airport');
        $this->db->where('airport_code', $code);
        $data = $this->db->get('iata_airport_list')->row();
        return $data->airport;
    }
 	public function cancel_bookings(){
		
		$exe_query = $this->db->query("select * from booking_global where booking_status='CANCELED'");
		$cancel_booking = array();
		if($exe_query->num_rows()!=''){
			$cancel_booking = $exe_query->result_array();
		}		
		return $cancel_booking;
	}
}
