<?php
class Reports_Model extends CI_Model {
	
	public function __construct(){
	    parent::__construct();
    }

    	 public function search_flight_booking($user_type,$user_id=0,$condition){
    	 	$conditionQ = '';
    	 	if($condition != '') {
		     	$conditionQ = " AND ( con_pnr_no LIKE '".$condition."%' ";
		     	$conditionQ .= " OR booking_status LIKE '".$condition."%' ";
		     	$conditionQ .= " OR leadpax LIKE '".$condition."%' ";
		     	$conditionQ .= " OR origin LIKE '".$condition."%' ";
		     	$conditionQ .= " OR destination LIKE '".$condition."%' ";
		     	$conditionQ .= " OR pnr_no LIKE '".$condition."%' ";
		     	$conditionQ .= " OR api_tax LIKE '".$condition."%' ";
		     	$conditionQ .= " OR admin_markup LIKE '".$condition."%' ";
		     	$conditionQ .= " OR agent_markup LIKE '".$condition."%' ";
		     	$conditionQ .= " OR api_rate LIKE '".$condition."%' ";
		     	$conditionQ .= " OR voucher_date LIKE '".$condition."%' ";
		     	//$conditionQ .= " OR depart_date LIKE '".$condition."%' ";
		     	//$conditionQ .= " OR return_date LIKE '".$condition."%' ";
		     	$conditionQ .= " OR mode LIKE '".$condition."%' )";
	    	}



		$bd_query = "SELECT * from booking_global as bg left join
		booking_flight as bf on  bg.referal_id=bf.booking_flight_id  
		left join booking_transaction as bt on bg.booking_transaction_id=bt.booking_transaction_id
		left join booking_billing_address as ba on bg.billing_address_id = ba.billing_address_id"; 

		//if($user_type==B2B_USER){
			$bd_query .=" left join user_details as ud on bg.user_id = ud.user_id ";
		//}
		$bd_query .=" where  bg.product_id=1 ";

		if($user_id>0){
			$bd_query .=" and bg.user_id =".$user_id;	
		}
		$bd_query .= $conditionQ;
		$bd_query .=' order by  bg.booking_global_id  desc';
		//$bd_query .=' LIMIT 1';
		 //echo $bd_query;die;
		$exe_query = $this->db->query($bd_query);
		$result_array = array();
		if($exe_query->num_rows()){
			$result_array = $exe_query->result_array();
		}
		return $result_array;
	}

	public function search_hotel_booking($user_type,$user_id=0,$condition){
			$conditionQ = '';
			if($condition != '') {
		     	$conditionQ = " AND ( con_pnr_no LIKE '".$condition."%' ";
		     	$conditionQ .= " OR booking_status LIKE '".$condition."%' ";
		     	$conditionQ .= " OR leadpax LIKE '".$condition."%' ";
		     	$conditionQ .= " OR voucher_date LIKE '".$condition."%' ";
		     	$conditionQ .= " OR check_in LIKE '".$condition."%' ";
		     	$conditionQ .= " OR check_out LIKE '".$condition."%' ";
		     	$conditionQ .= " OR pnr_no LIKE '".$condition."%' ";
		     	$conditionQ .= " OR api_tax LIKE '".$condition."%' ";
		     	$conditionQ .= " OR bt.admin_markup LIKE '".$condition."%' ";
		     	$conditionQ .= " OR bt.agent_markup LIKE '".$condition."%' ";
		     	$conditionQ .= " OR api_rate LIKE '".$condition."%' ";
		     	$conditionQ .= " OR city LIKE '".$condition."%' ";
		     	$conditionQ .= " OR voucher_date LIKE '".$condition."%' ";
		     	$conditionQ .= " OR pnr_no LIKE '".$condition."%' ";
		     	$conditionQ .= " OR room_count LIKE '".$condition."%' )";
	    	}
		$bd_query = "SELECT * from booking_global as bg left join
		booking_hotel as bf on  bg.referal_id=bf.id  
		left join booking_transaction as bt on bg.booking_transaction_id=bt.booking_transaction_id 
		left join booking_billing_address as ba on bg.billing_address_id = ba.billing_address_id";
		//if($user_type==B2B_USER){
			$bd_query .=" left join user_details as ud on bg.user_id = ud.user_id ";
		//}

		$bd_query .=" where  bg.product_id=2 ";
		if($user_id>0){
			$bd_query .=" and bg.user_id =".$user_id;	
		}
		$bd_query .= $conditionQ;
		$bd_query .= " order by  bg.booking_global_id  desc";
		//$bd_query .=' LIMIT 1';
		// echo $bd_query;die;
		$exe_query = $this->db->query($bd_query);
		$result_array = array();
		if($exe_query->num_rows()){
			$result_array = $exe_query->result_array();
		}
		return $result_array;
	}

	public function search_car_booking($user_type,$user_id=0,$condition){
			$conditionQ = '';
			if($condition != '') {
		     	$conditionQ = " AND ( con_pnr_no LIKE '".$condition."%' ";
		     	$conditionQ .= " OR booking_status LIKE '".$condition."%' ";
		     	$conditionQ .= " OR leadpax LIKE '".$condition."%' ";
		     	$conditionQ .= " OR voucher_date LIKE '".$condition."%' ";
		     	$conditionQ .= " OR car_pick_up_ld_code LIKE '".$condition."%' ";
		     	$conditionQ .= " OR car_drop_off_ld_code LIKE '".$condition."%' ";
		     	$conditionQ .= " OR car_model LIKE '".$condition."%' ";
		     	$conditionQ .= " OR pnr_no LIKE '".$condition."%' ";
		     	$conditionQ .= " OR bt.admin_markup LIKE '".$condition."%' ";
		     	$conditionQ .= " OR bt.agent_markup LIKE '".$condition."%' ";
		     	$conditionQ .= " OR api_rate LIKE '".$condition."%' ";
		     	$conditionQ .= " OR company_name LIKE '".$condition."%' ";
		     	$conditionQ .= " OR company_name LIKE '".$condition."%' )";
	    	}
		$bd_query = "SELECT * from booking_global as bg left join
		booking_car as bf on  bg.referal_id=bf.booking_car_id  
		left join booking_transaction as bt on bg.booking_transaction_id=bt.booking_transaction_id 
		left join booking_billing_address as ba on bg.billing_address_id = ba.billing_address_id ";
		if($user_type==B2B_USER){
			$bd_query .=" left join user_details as ud on bg.user_id = ud.user_id ";
		}

		$bd_query .=" where  bg.product_id=7 ";

		if($user_id>0){
			$bd_query .=" and bg.user_id =".$user_id;	
		}
		$bd_query .= $conditionQ;
		$bd_query .=" order by  bg.booking_global_id  desc";
		//$bd_query .=' LIMIT 1';	
		//echo $bd_query;die;
		$exe_query = $this->db->query($bd_query);
		$result_array = array();
		if($exe_query->num_rows()){
			$result_array = $exe_query->result_array();
		}
		return $result_array;
	}

    public function getBookingPnr($pnr_no,$con_pnr_no=''){
		 
		  $this->db->join('product','product.product_id = booking_global.product_id','LEFT');
		$this->db->where('booking_global.pnr_no',$pnr_no);
		if($con_pnr_no){
			$this->db->where('booking_global.con_pnr_no',$con_pnr_no);	
		}
		
	 return  $this->db->get('booking_global');
	  // $this->db->last_query();exit();
	  
	   
    }
    public function getBookingFlightTemp($booking_flight_id){
        $this->db->where('booking_flight_id',$booking_flight_id);
        return $this->db->get('booking_flight');
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
    public function getBookingbyPnr($pnr_no,$module,$con_pnr_no){
		if($module == 'FLIGHT'){
			$this->db->join('booking_flight','booking_global.referal_id = booking_flight.booking_flight_id');
		}
		if($module == 'HOTEL'){
			$this->db->join('booking_hotel','booking_global.referal_id = booking_hotel.id');
		}
		$this->db->join('booking_payment', 'booking_payment.payment_id = booking_global.payment_id','LEFT');
		$this->db->join('booking_transaction', 'booking_transaction.booking_transaction_id = booking_global.booking_transaction_id','LEFT');		
		$this->db->join('booking_billing_address', 'booking_billing_address.billing_address_id = booking_global.billing_address_id','LEFT');		
		$this->db->join('user_type', 'user_type.user_type_id = booking_global.user_type_id','LEFT');		
   		$this->db->where('booking_global.pnr_no',$pnr_no);
   		$this->db->where('booking_global.con_pnr_no',$con_pnr_no);
   		return  $this->db->get('booking_global');
         	//echo $this->db->last_query();exit;
    }
     public function getPassengerbyPnr($pnr_no){
		$this->db->where('booking_global_id',$pnr_no);
        return $this->db->get('booking_passenger');
    }
     public function get_admin_details(){
        $admin_id = ADMIN_ID;
        $this->db->select('admin_details.*,address_details.*, country_list.country_name,country_list.iso_alpha3 as country_code_3,admin_login_details.admin_pattren')->from('admin_details')->where('admin_details.admin_id', $admin_id)->where('admin_details.admin_status', 'ACTIVE')
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
     public function get_airport_name($code){
        $this->db->select('airport_name as airport');
        $this->db->where('airport_code', $code);
        $data = $this->db->get('iata_airport_list')->row();
        return $data->airport;
    }
    function get_custom_condition_flyonair($cond)
	{
		$sql = ' AND ';
		if (valid_array($cond) == true) {
			foreach ($cond as $k => $v) {
				$sql .= $v[0].' '.$v[1].' '.$v[2].' AND ';
			}
		}
		$sql = rtrim($sql, ' AND ');
		return $sql;
	}
     public function flight_booking_condition($user_type,$user_id=0,$cond){
     	$condition = $this->get_custom_condition_flyonair($cond);
		$bd_query = "SELECT * from booking_global as bg left join
		booking_flight as bf on  bg.referal_id=bf.booking_flight_id  
		left join booking_transaction as bt on bg.booking_transaction_id=bt.booking_transaction_id
		left join booking_billing_address as ba on bg.billing_address_id = ba.billing_address_id"; 

		if($user_type==B2B_USER){
			$bd_query .=" left join user_details as ud on bg.user_id = ud.user_id ";
		}
		$bd_query .=" where  bg.product_id=1 and bg.user_type_id = ".$user_type;

		if($user_id>0){
			$bd_query .=" and bg.user_id =".$user_id;	
		}
		$bd_query .= $condition;
		$bd_query .=' order by  bg.booking_global_id  desc';
		// echo $bd_query;die;
		$exe_query = $this->db->query($bd_query);
		$result_array = array();
		if($exe_query->num_rows()){
			$result_array = $exe_query->result_array();
		}
		return $result_array;
	}

	public function hotel_booking_condition($user_type,$user_id,$cond){
		$condition = $this->get_custom_condition_flyonair($cond);
		$bd_query = "SELECT * from booking_global as bg left join
		booking_hotel as bf on  bg.referal_id=bf.id  
		left join booking_transaction as bt on bg.booking_transaction_id=bt.booking_transaction_id 
		left join booking_billing_address as ba on bg.billing_address_id = ba.billing_address_id";
		if($user_type==B2B_USER){
			$bd_query .=" left join user_details as ud on bg.user_id = ud.user_id ";
		}

		$bd_query .=" where  bg.product_id=2 and bg.user_type_id = ".$user_type;
		if($user_id>0){
			$bd_query .=" and bg.user_id =".$user_id;	
		}
		$bd_query .= $condition;
		$bd_query .= " order by  bg.booking_global_id  desc";
		// echo $bd_query;die;
		$exe_query = $this->db->query($bd_query);
		$result_array = array();
		if($exe_query->num_rows()){
			$result_array = $exe_query->result_array();
		}
		return $result_array;
	}

	public function car_booking_condition($user_type,$user_id,$cond){
		$condition = $this->get_custom_condition_flyonair($cond);
		$bd_query = "SELECT * from booking_global as bg left join
		booking_car as bf on  bg.referal_id=bf.booking_car_id  
		left join booking_transaction as bt on bg.booking_transaction_id=bt.booking_transaction_id 
		left join booking_billing_address as ba on bg.billing_address_id = ba.billing_address_id ";
		if($user_type==B2B_USER){
			$bd_query .=" left join user_details as ud on bg.user_id = ud.user_id ";
		}

		$bd_query .=" where  bg.product_id=7 and bg.user_type_id = ".$user_type;

		if($user_id>0){
			$bd_query .=" and bg.user_id =".$user_id;	
		}
		$bd_query .= $condition;
		$bd_query .=" order by  bg.booking_global_id  desc";
		// echo $bd_query;die;
		$exe_query = $this->db->query($bd_query);
		$result_array = array();
		if($exe_query->num_rows()){
			$result_array = $exe_query->result_array();
		}
		return $result_array;
	}


    public function flight_booking($user_type,$user_id=0){

		$bd_query = "SELECT * from booking_global as bg left join
		booking_flight as bf on  bg.referal_id=bf.booking_flight_id  
		left join booking_transaction as bt on bg.booking_transaction_id=bt.booking_transaction_id
		left join booking_billing_address as ba on bg.billing_address_id = ba.billing_address_id"; 

		if($user_type==B2B_USER){
			$bd_query .=" left join user_details as ud on bg.user_id = ud.user_id ";
		}
		$bd_query .=" where  bg.product_id=1 and bg.user_type_id = ".$user_type;

		if($user_id>0){
			$bd_query .=" and bg.user_id =".$user_id;	
		}
		$bd_query .=' order by  bg.booking_global_id  desc';
		$exe_query = $this->db->query($bd_query);
		$result_array = array();
		if($exe_query->num_rows()){
			$result_array = $exe_query->result_array();
		}
		return $result_array;
	}
	public function hotel_booking($user_type,$user_id){
		$bd_query = "SELECT * from booking_global as bg left join
		booking_hotel as bf on  bg.referal_id=bf.id  
		left join booking_transaction as bt on bg.booking_transaction_id=bt.booking_transaction_id 
		left join booking_billing_address as ba on bg.billing_address_id = ba.billing_address_id";
		if($user_type==B2B_USER){
			$bd_query .=" left join user_details as ud on bg.user_id = ud.user_id ";
		}

		$bd_query .=" where  bg.product_id=2 and bg.user_type_id = ".$user_type;
		if($user_id>0){
			$bd_query .=" and bg.user_id =".$user_id;	
		}
		$bd_query .= " order by  bg.booking_global_id  desc";
		$exe_query = $this->db->query($bd_query);
		$result_array = array();
		if($exe_query->num_rows()){
			$result_array = $exe_query->result_array();
		}
		return $result_array;
	}

	public function car_booking($user_type,$user_id){
		$bd_query = "SELECT * from booking_global as bg left join
		booking_car as bf on  bg.referal_id=bf.booking_car_id  
		left join booking_transaction as bt on bg.booking_transaction_id=bt.booking_transaction_id 
		left join booking_billing_address as ba on bg.billing_address_id = ba.billing_address_id ";
		if($user_type==B2B_USER){
			$bd_query .=" left join user_details as ud on bg.user_id = ud.user_id ";
		}

		$bd_query .=" where  bg.product_id=7 and bg.user_type_id = ".$user_type;

		if($user_id>0){
			$bd_query .=" and bg.user_id =".$user_id;	
		}
		$bd_query .=" order by  bg.booking_global_id  desc";
		$exe_query = $this->db->query($bd_query);
		$result_array = array();
		if($exe_query->num_rows()){
			$result_array = $exe_query->result_array();
		}
		return $result_array;
	}
	public function get_user_bookings($user_id)
	{
		
	}
	public function product_reports(){
		return $this->db->select('sum(bt.net_rate) as net_rate,sum(bt.admin_markup) as admin_markup,sum(bt.agent_markup) as agent_markup,sum(bt.base_amount) as base_amount,sum(bt.discount) as discount,sum(bt.total_amount) as total_amount,p.product_name')->from('booking_transaction bt')
		->join('booking_global bg','bg.booking_transaction_id = bt.booking_transaction_id')
		->join('product p','p.product_id = bg.product_id')->group_by('p.product_name')->get()->result();
	}
	public function total_reports(){
		return $this->db->select('sum(bt.net_rate) as net_rate,sum(bt.admin_markup) as admin_markup,sum(bt.agent_markup) as agent_markup,sum(bt.base_amount) as base_amount,sum(bt.discount) as discount,sum(bt.total_amount) as total_amount,p.product_name')->from('booking_transaction bt')
		->join('booking_global bg','bg.booking_transaction_id = bt.booking_transaction_id')
		->join('product p','p.product_id = bg.product_id')->get()->row();
	}
	public function first_chart(){
		
		return $this->db->query('SELECT COUNT(`booking_transaction_id`) as Hits, MONTH(`booking_timestamp`) as month FROM booking_transaction  
		WHERE `booking_timestamp` < Now() and `booking_timestamp` > DATE_ADD(Now(), INTERVAL- 11 MONTH) GROUP BY MONTH(`booking_timestamp`) ORDER BY MONTH(`booking_timestamp`) DESC')->result();
	
	}
	public function second_chart($start,$end){
		if($start){
	     $sql = 'SELECT COUNT(bt.booking_transaction_id) as Hits, MONTH(bt.booking_timestamp) as month,YEAR(bt.booking_timestamp) as year,DATE_FORMAT(bt.booking_timestamp,"%d") as day,p.product_name as product FROM booking_transaction bt  
			LEFT JOIN booking_global bg ON(bg.booking_transaction_id = bt.booking_transaction_id)
			LEFT JOIN product p ON(p.product_id = bg.product_id)
		WHERE  DATE(bt.booking_timestamp) >= "'.$start.'" AND DATE(bt.booking_timestamp) <= "'.$end.'"   GROUP BY p.product_name,DATE(bt.booking_timestamp)';
        
        $query =$this->db->query($sql);
        
		
		
		}
		else{
		$sql = 'SELECT COUNT(bt.booking_transaction_id) as Hits, MONTH(bt.booking_timestamp) as month,YEAR(bt.booking_timestamp) as year,DATE_FORMAT(bt.booking_timestamp,"%d") as day,p.product_name as product FROM booking_transaction bt  
			LEFT JOIN booking_global bg ON(bg.booking_transaction_id = bt.booking_transaction_id)
			LEFT JOIN product p ON(p.product_id = bg.product_id)
		WHERE bt.booking_timestamp < Now() and bt.booking_timestamp >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) GROUP BY p.product_name,DATE(bt.booking_timestamp)';
		$query =$this->db->query($sql);
	}
	return $query->result();

	}
	public function pie_chart(){
		return $this->db->select('count(bt.booking_transaction_id) as hits,p.product_name as product,p.Chart_color')->from('booking_transaction bt')
		->join('booking_global bg','bg.booking_transaction_id = bt.booking_transaction_id')
		->join('product p','p.product_id = bg.product_id')->group_by('p.product_name')->get()->result();
	}
	public function statics_reports(){
		return $this->db->select('sum(bt.net_rate) as net_rate,sum(bt.admin_baseprice) as admin_baseprice,sum(bt.admin_markup) as admin_markup,sum(bt.agent_markup) as agent_markup,sum(bt.base_amount) as base_amount,sum(bt.discount) as discount,sum(bt.total_amount) as total_amount')->from('booking_transaction bt')
		->get()->row();
	}
	public function products(){
		return $this->db->select('*')->from('product')->get()->result();
	}
	public function third_chart(){
		return $this->db->query('SELECT COUNT(bt.booking_transaction_id) as Hits, MONTH(bt.booking_timestamp) as month,YEAR(bt.booking_timestamp) as year,DATE_FORMAT(bt.booking_timestamp,"%d") as day,p.product_name as product FROM booking_transaction bt  
			LEFT JOIN booking_global bg ON(bg.booking_transaction_id = bt.booking_transaction_id)
			LEFT JOIN product p ON(p.product_id = bg.product_id)
		WHERE bt.booking_timestamp < Now() and bt.booking_timestamp >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) GROUP BY DATE(bt.booking_timestamp)')->result();
	}
	
		public function fourth_chart(){
		
		return $this->db->query('SELECT COUNT(`booking_transaction_id`) as Hits, MONTH(`booking_timestamp`) as month,DATE_FORMAT(booking_timestamp,"%d") as day FROM booking_transaction  
		WHERE `booking_timestamp` < Now() and `booking_timestamp` > DATE_SUB(CURDATE(), INTERVAL 1 MONTH) GROUP BY DATE(`booking_timestamp`) ORDER BY MONTH(`booking_timestamp`) DESC')->result();
	
	}
	public function b2b_bookings($access){
		if($access == 'b2b'){
	return	$this->db->select('ud.user_name,SUM(bt.total_amount) as total_amount,SUM(bt.admin_markup) as admin_markup,COUNT(bt.booking_transaction_id) as total_bookings')->from('booking_global bg')->join('booking_transaction bt','bt.booking_transaction_id = bg.booking_transaction_id')->join('user_details ud','ud.user_id = bg.user_id')->join('user_login_details uld','uld.user_id = ud.user_id')->where('bg.user_id != 0 and uld.user_type_id = 1')->group_by('ud.user_name')->get()->result();
	}
	else{
	return	$this->db->select('ud.user_name,SUM(bt.total_amount) as total_amount,SUM(bt.admin_markup) as admin_markup,COUNT(bt.booking_transaction_id) as total_bookings')->from('booking_global bg')->join('booking_transaction bt','bt.booking_transaction_id = bg.booking_transaction_id')->join('user_details ud','ud.user_id = bg.user_id')->join('user_login_details uld','uld.user_id = ud.user_id')->where('bg.user_id != 0 and uld.user_type_id = 2')->group_by('ud.user_name')->get()->result();	
	}
	}
	public function country_basis(){
	return	$this->db->select('cl.country_name,SUM(bt.total_amount) as total_amount,SUM(bt.admin_markup) as admin_markup,COUNT(bt.booking_transaction_id) as total_bookings')->from('booking_global bg')->join('booking_transaction bt','bt.booking_transaction_id = bg.booking_transaction_id')->join('user_details ud','ud.user_id = bg.user_id')->join('address_details ad','ad.address_details_id = ud.address_details_id')->join('country_list cl','cl.country_code = ad.country_code')->group_by('cl.country_name')->get()->result();		
	}
	

	public function city_basis(){
	return	$this->db->select('c.city,SUM(bt.total_amount) as total_amount,SUM(bt.admin_markup) as admin_markup,COUNT(bt.booking_transaction_id) as total_bookings')->from('booking_global bg')->join('booking_transaction bt','bt.booking_transaction_id = bg.booking_transaction_id')->join('user_details ud','ud.user_id = bg.user_id')->join('address_details ad','ad.address_details_id = ud.address_details_id')->join('api_hotel_cities c','c.destination_name = ad.city_name')->group_by('c.city')->get()->result();		
	}
	
	/*new function added*/
	public function getChangeRequest()
	{
		$this->db->select('*');
		$query = $this->db->get('change_request');
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else
		{
			return '';
		}
	}
	/*end*/
	
}