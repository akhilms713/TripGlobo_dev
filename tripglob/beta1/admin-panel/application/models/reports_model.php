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
		     	//$conditionQ .= " OR ticket_number LIKE '".$condition."%' ";
		     	$conditionQ .= " OR mode LIKE '".$condition."%' )";
		     	
	    	}



		$bd_query = "SELECT * from booking_global as bg left join
		booking_flight as bf on  bg.referal_id=bf.booking_flight_id  
		left join booking_transaction as bt on bg.booking_transaction_id=bt.booking_transaction_id
		left join booking_billing_address as ba on bg.billing_address_id = ba.billing_address_id";
		//left join passenger_ticket_reports as pt on bg.booking_global_id = pt.booking_global_id"; 

			$bd_query .=" left join user_details as ud on bg.user_id = ud.user_id ";
    		$bd_query .=" where  bg.product_id=1 ";

		if($user_id>0){
			$bd_query .=" and bg.user_id =".$user_id;	
		}
		$bd_query .= $conditionQ;
		$bd_query .=' order by  bg.booking_global_id  desc';
		//$bd_query .=' LIMIT 1';
	//	 echo $bd_query;die;
		$exe_query = $this->db->query($bd_query);
		$result_array = array();
		if($exe_query->num_rows()){
			$result_array = $exe_query->result_array();
		}
		
	 //echo "<pre/>";print_r($result_array);exit();
		
		return $result_array;
	}
	
	public function search_flight_booking_new($condition){
	    
    	 $conditionQ = $this->get_custom_condition($condition);
    
		$bd_query = "SELECT * from booking_global as bg left join
		booking_flight as bf on  bg.referal_id=bf.booking_flight_id  
		left join booking_transaction as bt on bg.booking_transaction_id=bt.booking_transaction_id
		left join booking_billing_address as ba on bg.billing_address_id = ba.billing_address_id";

		$bd_query .=" left join user_details as ud on bg.user_id = ud.user_id ";
		$bd_query .=" where  bg.product_id=1 ";

		
		$bd_query .= $conditionQ;
		$bd_query .=' order by  bg.booking_global_id  desc';
	    
		$exe_query = $this->db->query($bd_query);
		$result_array = array();
		if($exe_query->num_rows()){
			$result_array = $exe_query->result_array();
		}
		
	    //echo $this->db->last_query();exit();
		
		return $result_array;
	}
		public function search_hotel_booking_new($condition){
			// debug($condition);exit;
			if (!empty($condition['con_number'])) {
			$this->db->where('bg.con_pnr_no',$condition['con_number']);				
			}
			if (!empty($condition['pnr'])) {
			$this->db->where('bg.pnr_no',$condition['pnr']);				
			}
			if (!empty($condition['user_id'])) {
			$this->db->where('bg.user_id',$condition['user_id']);				
			}
			if (!empty($condition['billing_date'])) {
			$this->db->where('bh.book_date >=', date('Y-m-d',strtotime($condition['billing_date'])).' 00:00:00');
			$this->db->where('bh.book_date <=', date('Y-m-d',strtotime($condition['billing_date'])).' 23:59:59');						
			}
			if (!empty($condition['created_datetime_from']) && !empty($condition['created_datetime_to'])) {
			$this->db->where('bh.search_date >=', date('Y-m-d',strtotime($condition['created_datetime_from'])).' 00:00:00');
			$this->db->where('bh.search_date <=', date('Y-m-d',strtotime($condition['created_datetime_to'])).' 23:59:59');			
			}elseif (!empty($condition['created_datetime_from']) && empty($condition['created_datetime_to'])) {
			$this->db->where('bh.search_date >=', date('Y-m-d',strtotime($condition['created_datetime_from'])).' 00:00:00');		
			$this->db->where('bh.search_date <=', date('Y-m-d').' 23:59:59');			
			}elseif(empty($condition['created_datetime_from']) && !empty($condition['created_datetime_to'])){
			$this->db->where('bh.search_date >=', date('Y-m-d',strtotime($condition['created_datetime_to'])).' 00:00:00');
			$this->db->where('bh.search_date <=', date('Y-m-d',strtotime($condition['created_datetime_to'])).' 23:59:59');			
			}
			$this->db->select('*');
			$this->db->from('booking_global bg'); 
			$this->db->join('booking_hotel bh', 'bh.booking_hotel_id=bg.referal_id', 'left');
			$this->db->join('booking_transaction bt', 'bt.booking_transaction_id=bg.booking_transaction_id', 'left');
			$this->db->order_by('bg.booking_global_id','desc');   
			$query = $this->db->get();
			if($query->num_rows() != 0)
			{
			return $query->result_array();
			}
			else
			{
			return false;
			}
		}
	public function search_bus_booking_new($condition){
			// debug($condition);exit;
			if (!empty($condition['con_number'])) {
			$this->db->where('bg.con_pnr_no',$condition['con_number']);				
			}
			if (!empty($condition['pnr'])) {
			$this->db->where('bg.pnr_no',$condition['pnr']);				
			}
			if (!empty($condition['user_id'])) {
			$this->db->where('bg.user_id',$condition['user_id']);				
			}
			if (!empty($condition['billing_date'])) {
			$this->db->where('bh.book_date >=', date('Y-m-d',strtotime($condition['billing_date'])).' 00:00:00');
			$this->db->where('bh.book_date <=', date('Y-m-d',strtotime($condition['billing_date'])).' 23:59:59');						
			}
			if (!empty($condition['created_datetime_from']) && !empty($condition['created_datetime_to'])) {
			$this->db->where('bh.search_date >=', date('Y-m-d',strtotime($condition['created_datetime_from'])).' 00:00:00');
			$this->db->where('bh.search_date <=', date('Y-m-d',strtotime($condition['created_datetime_to'])).' 23:59:59');			
			}elseif (!empty($condition['created_datetime_from']) && empty($condition['created_datetime_to'])) {
			$this->db->where('bh.search_date >=', date('Y-m-d',strtotime($condition['created_datetime_from'])).' 00:00:00');		
			$this->db->where('bh.search_date <=', date('Y-m-d').' 23:59:59');			
			}elseif(empty($condition['created_datetime_from']) && !empty($condition['created_datetime_to'])){
			$this->db->where('bh.search_date >=', date('Y-m-d',strtotime($condition['created_datetime_to'])).' 00:00:00');
			$this->db->where('bh.search_date <=', date('Y-m-d',strtotime($condition['created_datetime_to'])).' 23:59:59');			
			}
			$this->db->select('*');
			$this->db->from('booking_global bg'); 
			$this->db->join('booking_bus bh', 'bh.booking_bus_id=bg.referal_id', 'left');
			$this->db->join('booking_transaction bt', 'bt.booking_transaction_id=bg.booking_transaction_id', 'left');
			$this->db->order_by('bg.booking_global_id','desc');   
			$query = $this->db->get();
			if($query->num_rows() != 0)
			{
			return $query->result_array();
			}
			else
			{
			return false;
			}
		}
	function get_custom_condition($cond)
	{
		$sql = ' AND ';
		if (is_array($cond) == true) {
			foreach ($cond as $k => $v) {
				$sql .= $v[0].' '.$v[1].' '.$v[2].' AND ';
			}
		}
		$sql = rtrim($sql, ' AND ');
		return $sql;
	}

    public function getBookingPnr($pnr_no,$con_pnr_no=''){
		 
		  $this->db->join('product','product.product_id = booking_global.product_id','LEFT');
		$this->db->where('booking_global.pnr_no',$pnr_no);
		if($con_pnr_no){
			$this->db->where('booking_global.con_pnr_no',$con_pnr_no);	
		}
		
	 return  $this->db->get('booking_global');
	  $this->db->last_query();exit();
	  
	   
    }
    public function getBookingFlightTemp($booking_flight_id){
        $this->db->where('booking_flight_id',$booking_flight_id);
        return $this->db->get('booking_flight');
    }
   
    public function getBookingbyPnr($pnr_no,$module,$con_pnr_no){
		if($module == 'FLIGHT'){
			$this->db->join('booking_flight','booking_global.referal_id = booking_flight.booking_flight_id');
		
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

		if($user_type==B2B_USER || $user_type==STAFF_USER){
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



    public function flight_booking($user_type,$user_id=0){

		$bd_query = "SELECT * from booking_global as bg left join
		booking_flight as bf on  bg.referal_id=bf.booking_flight_id  
		left join booking_transaction as bt on bg.booking_transaction_id=bt.booking_transaction_id
		left join booking_billing_address as ba on bg.billing_address_id = ba.billing_address_id"; 

		if($user_type==B2B_USER || $user_type==STAFF_USER){
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
	return	$this->db->select('c.city,SUM(bt.total_amount) as total_amount,SUM(bt.admin_markup) as admin_markup,COUNT(bt.booking_transaction_id) as total_bookings')->from('booking_global bg')->join('booking_transaction bt','bt.booking_transaction_id = bg.booking_transaction_id')->join('user_details ud','ud.user_id = bg.user_id')->join('address_details ad','ad.address_details_id = ud.address_details_id')->get()->result();		
	}

	/*new added functions*/
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

	public function updateChangeRequest_flag($id)
	{
	    $data = array(
			'flag' => mysql_real_escape_string(1)
			
			);
		$where = "id = '$id'";
	    $this->db->update('change_request', $data, $where);
	}



	public function get_group_bookings()
	{
		$this->db->select('GB.id,GB.gb_id,GB.request,GB.insertion_time,GB.remarks,UD.c_p_name AS agent_name,UD.c_p_email AS agent_email,UD.c_p_phone AS agent_phone');
		$this->db->from('group_booking GB');
		$this->db->join('user_details UD','UD.user_id=GB.agent_id');
		$this->db->order_by('GB.id',DESC);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return '';
		}
	}
	public function get_filter_group_bookings($filter)
	{
		$from_date= date('Y-m-d',strtotime($filter['created_datetime_from'])).' 00:00:00'; 
        $to_date= date('Y-m-d',strtotime($filter['created_datetime_to'])).' 23:59:59'; 
		$this->db->select('GB.id,GB.request,GB.insertion_time,GB.remarks,UD.c_p_name AS agent_name,UD.c_p_email AS agent_email,UD.c_p_phone AS agent_phone');
		$this->db->from('group_booking GB');
		$this->db->join('user_details UD','UD.user_id=GB.agent_id');
		if($filter['created_datetime_from']!="" && $filter['created_datetime_to']!="") {
            $this->db->where('GB.insertion_time >=', $from_date);
            $this->db->where('GB.insertion_time <=', $to_date);
        }else if($filter['created_datetime_from']!="" && $filter['created_datetime_to']=="") {
            $this->db->where('GB.insertion_time >=', $from_date);
        }else if($filter['created_datetime_from']=="" && $filter['created_datetime_to']!="") {
            $this->db->where('GB.insertion_time <=', $to_date);
        }
        if($filter['agent_list']!='') {
        	$this->db->where('GB.agent_id',$filter['agent_list']);
        }
		$this->db->order_by('GB.id',DESC);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return '';
		}
	}
	public function get_agent_list()
	{
		$this->db->select('ULD.user_type_id,UD.c_p_name AS agent_name,UD.c_p_email AS agent_email,UD.c_p_phone AS agent_phone,UD.user_id AS agent_id');
		$this->db->from('user_login_details ULD');
		$this->db->join('user_details UD','UD.user_id=ULD.user_id');
		$this->db->where('UD.c_p_email !=','');
		$this->db->where('ULD.user_type_id',1);
		$this->db->order_by('ULD.user_login_details_id',DESC);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return '';
		}
	}
	public function get_airline_name($code){
        $this->db->select('airline_name as airline');
        $this->db->where('airline_code', $code);
        $data = $this->db->get('airline_list')->row();

        if(isset($data->airline) && $data->airline!='')
        {
        return $data->airline;
        }
        else
        {
             return $code;
        }
    }
    
    public function add_passenger_ticket($data)
    {
        $passengerId = $data['booking_passenger_id'];
        $select2 = "select * from passenger_ticket_reports where booking_passenger_id = $passengerId";
		$query=$this->db->query($select2);
		$result = $query->row();
		
        $insert_data = array(
			'booking_passenger_id' => $data['booking_passenger_id'],
			'booking_global_id' => $data['booking_global_id'],
			'pnr' => $data['pnr'],
			'ticket_number' => $data['ticket_no'],
			
		);
		if ($query->num_rows() > 0)
		{
		    $this->db->where('booking_passenger_id',$data['booking_passenger_id']);
			$this->db->update('passenger_ticket_reports', $insert_data);
		}else{
		    $this->db->insert('passenger_ticket_reports', $insert_data);
		}
		
    }
    public function update_group_booking_remarks($data,$id,$gb_id,$admin_id=''){
          $data1=array(
            'remarks'=>trim($data['remarks']),
            'admin_id'=>$admin_id,
            'gb_id'=>$gb_id
            );
       	$this->db->where('id',$id);
		$this->db->where('gb_id',$gb_id);
	    $this->db->update('group_booking', $data);
       $this->db->insert('gb_history',$data1);
    }
     public function get_gb_history($gb_id){
        $this->db->select('*');
        $this->db->where('gb_id', $gb_id);
        $this->db->from('gb_history');
        $query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return '';
		}
     }
     public function get_admin_name($admin_id){
         $this->db->select('*');
        $this->db->where('admin_id', $admin_id);
        $this->db->from('admin_details');
        $query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return '';
		}
         
     }
     
     public function update_request_remark($data,$request_id,$admin_id=''){
          $insert_data=array(
            'remarks'=>trim($data['remarks']),
            'admin_id'=>$admin_id,
            'request_id'=>$request_id
            );
		$this->db->where('id',$request_id);
	    $this->db->update('change_request', $data);
       $this->db->insert('request_remark_history',$insert_data);
    }
     public function get_request_remark_history($request_id){
        $this->db->select('*');
        $this->db->where('request_id', $request_id);
        $this->db->from('request_remark_history');
        $query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return '';
		}
     }
    
    public function hotel_booking_condition($user_type,$user_id,$cond){
		$condition = $this->get_custom_condition_flyonair($cond);
		$bd_query = "SELECT * from booking_global as bg left join
		booking_hotel as bf on  bg.referal_id=bf.booking_hotel_id  
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
    
    public function hotel_booking($user_type,$user_id=0){

		$bd_query = "SELECT * from booking_global as bg left join
		booking_hotel as bh on  bg.referal_id=bh.booking_hotel_id  
		left join booking_transaction as bt on bg.booking_transaction_id=bt.booking_transaction_id
		left join booking_billing_address as ba on bg.billing_address_id = ba.billing_address_id"; 

		if($user_type==B2B_USER || $user_type==STAFF_USER){
			$bd_query .=" left join user_details as ud on bg.user_id = ud.user_id ";
		}
		$bd_query .=" where  bg.product_id=2 and bg.user_type_id = ".$user_type;

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

	public function bus_booking_condition($user_type,$user_id=0,$cond)
	{
		$condition = $this->get_custom_condition_flyonair($cond);
		$bd_query = "SELECT * from booking_global as bg left join
		booking_bus as bb on  bg.referal_id=bb.booking_bus_id  
		left join booking_transaction as bt on bg.booking_transaction_id=bt.booking_transaction_id
		left join booking_billing_address as ba on bg.billing_address_id = ba.billing_address_id"; 

		if($user_type==B2B_USER || $user_type==STAFF_USER){
			$bd_query .=" left join user_details as ud on bg.user_id = ud.user_id ";
		}
		$bd_query .=" where  bg.product_id=8 and bg.user_type_id = ".$user_type;

		if($user_id>0){
			$bd_query .=" and bg.user_id =".$user_id;	
		}
		$bd_query .= $condition;
		$bd_query .=' order by  bg.booking_global_id  desc';
		$exe_query = $this->db->query($bd_query);
		$result_array = array();
		if($exe_query->num_rows()){
			$result_array = $exe_query->result_array();
		}
		return $result_array;
	}
	
	public function bus_booking($user_type,$user_id=0){

		$bd_query = "SELECT * from booking_global as bg left join
		booking_bus as bb on  bg.referal_id=bb.booking_bus_id  
		left join booking_transaction as bt on bg.booking_transaction_id=bt.booking_transaction_id
		left join booking_billing_address as ba on bg.billing_address_id = ba.billing_address_id"; 

		if($user_type==B2B_USER || $user_type==STAFF_USER){
			$bd_query .=" left join user_details as ud on bg.user_id = ud.user_id ";
		}
		$bd_query .=" where  bg.product_id=8 and bg.user_type_id = ".$user_type;

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
	
	public function getBookingTemphotel($cart_global_id){
        //$this->db->where('cart_hotel_id',$cart_global_id);
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
    	public function getBookingTempbus($referal_id){
         $this->db->where('booking_bus_id',$referal_id);
		$query = $this->db->get('booking_bus');
		if($query->num_rows() != 0 )
		{
			return $query->row();
		}
		else
		{
			return '';
		}
		
    } 
     public function get_hotel_other_details($hotel_code,$sessionId)
    {
        $this->db->select('*');
    	$this->db->from('api_hotel_details');
    	$this->db->where('hotel_code', $hotel_code);
    	$this->db->where('session_id', $sessionId);
    	$query = $this->db->get();
    	if ($query->num_rows() == '') {
    	return '';
    	} else {
    	return $query->result_array();
    	}
    }
       public function get_bus_other_details($global_id)
    {
        $this->db->select('*');
    	$this->db->from('cart_bus');
    	$this->db->where('parent_cart_id', $global_id);
    	$query = $this->db->get();
    	if ($query->num_rows() == '') {
    	return '';
    	} else {
    	return $query->result_array();
    	}
    }
   public function getBookingTempbuscart($cart_id,$session_id)
   {
          $this->db->select('*');
    	$this->db->from('cart_global');
    	$this->db->where('referal_id', $cart_id);
    	$this->db->where('session_id', $session_id);
    	$query = $this->db->get();
    	if ($query->num_rows() == '') {
    	return '';
    	} else {
    	return $query->result_array();
    	}
   }
    public function update_booking_global($booking_temp_id, $update_booking){
        $this->db->where('booking_global_id',$booking_temp_id);	 
        $this->db->update('booking_global', $update_booking);
    }
     
	/*end*/
	
}