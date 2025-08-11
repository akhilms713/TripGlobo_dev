<?php

class Payment_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
    }
	public function validate_order_id($order_id){
		$this->db->where('parent_pnr',$order_id);
		$this->db->where('transaction_status','PROCESS');
		return $this->db->get('booking_global');
	}
	
	public function validate_order_id_org($order_id){
		$this->db->where('parent_pnr_no',$order_id);
		$this->db->join('product', 'product.product_id = booking_global.product_id','LEFT');
		$this->db->join('api_details', 'api_details.api_details_id = booking_global.api_id','LEFT');
			$this->db->join('user_type', 'user_type.user_type_id = booking_global.user_type_id','LEFT');
			$this->db->join('booking_transaction', 'booking_transaction.booking_transaction_id = booking_global.booking_transaction_id','LEFT');
		$this->db->join('booking_payment', 'booking_payment.payment_id = booking_global.payment_id','LEFT');
		 /*$this->db->get('booking_global');
		 echo $this->db->last_query();die;*/
		return $this->db->get('booking_global');
	}

	public function validate_order_id_v1($order_id){
		$this->db->where('parent_pnr',$order_id);
		$this->db->where('payment_status','5');
		return $this->db->get('booking_global');
	}
	public function update_transaction($order_id,$transaction){
		$this->db->where('parent_pnr',$order_id);
		$this->db->update('booking_global',$transaction);
	}

}

