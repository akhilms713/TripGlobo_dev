<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_Model extends CI_Model {

  public function getBookingTemp($session_id){
        $this->db->where('session_id',$session_id);
		$this->db->join('product','cart_global.product_id = product.product_id');
        return $this->db->get('cart_global');
    }
	public function get_convenience_data(){
		
		$this->db->select('*');
		$this->db->from('convenience_fee');
		$query = $this->db->get();
		
		if ( $query->num_rows > 0 ){
			return $query->row();	
		}else{
			return '';	
		}
	}
	public function getBookingTemp_flight($cart_global_id){
        $this->db->where('cart_id',$cart_global_id);
        $this->db->join('cart_flight','cart_flight.referal_id = cart_global.referal_id');
       
		$query = $this->db->get('cart_global');
		if($query->num_rows() != 0 )
		{
			return $query->row();
		}
		else
		{
			return '';
		}
		
    }
    public function getcancelpolicy($api_temp_hotel_id){
        $this->db->where('api_temp_hotel_id',$api_temp_hotel_id);
       	$query = $this->db->get('api_hotel_detail_t');
	if ($query->num_rows() == '') {
	return '';
	} else {
	return $query->result_array();
    }
	}
	public function getCartDataByModule($cart_id,$module){

		$this->db->where('cart_id',$cart_id);
		if($module == 'FLIGHT'){
			$this->db->join('cart_flight','cart_flight.referal_id = cart_global.referal_id');
		}
		
		if($module == 'HOTEL'){
			$this->db->join('cart_hotel','cart_hotel.cart_hotel_id = cart_global.referal_id');
		}
		
		return $this->db->get('cart_global');
	}

	public function getBookingTemp1($session_id){

		//echo $cart_id;exit("<<<<rahul");

		$this->db->where('session_id',$session_id);
		$this->db->select('*');
		$this->db->from('cart_flight');
		$query = $this->db->get();

		//echo $this->db->last_query();exit();
		
		if ( $query->num_rows > 0 ){
			return $query->row();	
		}else{
			return '';	
		}
	}

	public function getBookingTemp_hotel($cart_global_id){
        $this->db->where('cart_id',$cart_global_id);
        $this->db->join('cart_hotel','cart_hotel.cart_hotel_id = cart_global.referal_id');
       
		$query = $this->db->get('cart_global');
		if($query->num_rows() != 0 )
		{
			return $query->row();
		}
		else
		{
			return '';
		}
		
    }
    
    public function getBookingTemphotel($cart_global_id){
        /*$this->db->where('cart_hotel_id',$cart_global_id);*/
        $this->db->where('parent_cart_id',$cart_global_id);
		$query = $this->db->get('cart_hotel');
		if($query->num_rows() != 0 )
		{
			return $query->row();
		}
		else
		{
			return '';
		}
		
    }

}

?>
