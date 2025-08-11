<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Reports extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('reports_model');
		$this->load->model('admin_model');
		$this->load->helper('custom/app_share_helper');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      	$this->output->set_header("Pragma: no-cache");
	    $this->load->library('form_validation');
	    $this->load->model('email_model');
	    $this->load->model('user_model');
	    
	}
        private function check_isvalidated()
	{
		if(!$this->session->userdata('admin_logged_in') || $this->session->userdata('admin_id')!= ADMIN_ID )
		{
			if ($this->session->userdata('admin_logged_in')) {
		 	$controller_name = $this->router->fetch_class();
			 $function_name = $this->router->fetch_method();
             $this->load->model('Privilege_Model');
            $sub_admin_id = $this->session->userdata('admin_id');
           if(!$this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id,$controller_name,$function_name))
		   {			
    	 	  	access_denied('error');
			}
			
       	 }
	 else
       	 {
       	 	redirect('login','refresh');
       	 }
		}
		
    }
	
    function search_report($user_type='All', $user_id=0, $condition='')
    {
    	$searchData = '';
    	$aData = array();
    	$data = array();
    	if($this->input->post()){
    		$searchData = $condition = $this->input->post('searchData');
    		$flight = $this->reports_model->search_flight_booking($user_type,$user_id, $condition);
    		$hotel = $this->reports_model->search_hotel_booking($user_type,$user_id, $condition);
    		$bus = $this->reports_model->search_bus_booking($user_type,$user_id, $condition);
    		// debug($flight);exit;
    		foreach ($flight as $rowF) {
    			$segment_data = json_decode($rowF['request_scenario'],true);
    			$aData[$rowF['con_pnr_no']] = array(
    						'type' => 'FLIGHT',
    						'con_pnr_no' => $rowF['con_pnr_no'],
    						'booking_status' => $rowF['booking_status'],
    						'user_name' => $rowF['user_name'],
    						'leadpax' => $rowF['leadpax'],
    						'pnr_no' => $rowF['pnr_no'],
    						'total_cost' => $rowF['total_amount'],
    						'admin_markup' => $rowF['admin_markup'],
    						'agent_markup' => $rowF['agent_markup'],
    						'api_rate' => $rowF['api_rate'],
    						'origin' => $rowF['origin'],
    						'destination' => $rowF['destination'],
    						'mode' => $rowF['mode'],
    						'voucher_date' => $rowF['voucher_date'],
    						'depart_date' => $segment_data['depart_date'],
    						'return_date' => @$segment_data['return_date'],
    						
    					);
    		}
    		foreach ($hotel as $rowH) {
    			// debug($rowH);exit;
    			$segment_data = json_decode($rowF['request_scenario'],true);
    			$search_data=$this->db->select('search_data')->get_where('search_history',array('origin'=>$rowH['search_id']))->row_array();
    			 // debug(json_decode($search_data['search_data'],1));exit;
    			 $search_data=json_decode($search_data['search_data'],1);
    			$aData[$rowH['con_pnr_no']] = array(
    						'type' => 'Hotel',
    						'con_pnr_no' => $rowH['con_pnr_no'],
    						'booking_status' => $rowH['booking_status'],
    						'user_name' => ($rowH['user_name']!='')?$rowH['user_name']:'---',
    						'leadpax' => $rowH['leadpax'],
    						'pnr_no' => $rowH['pnr_no'],
    						'total_cost' => $rowH['total_cost'],
    						'admin_markup' => $rowH['admin_markup'],
    						'agent_markup' => ($rowH['agent_markup']!='')?$rowH['agent_markup']:0.00	,
    						'api_rate' => $rowH['api_rate'],
    						'origin' => $search_data['city'],
    						'destination' => '---',
    						'mode' => json_decode($rowH['room_type'],1)[0],
    						'voucher_date' => $rowH['voucher_date'],
    						'depart_date' => $search_data['hotel_checkin'],
    						'return_date' => @$search_data['hotel_checkout'],
    						
    					);
    		}
    		foreach ($bus as $rowB) {
    			// debug($rowB);exit;
    			$segment_data = json_decode($rowF['request_scenario'],true);
    			$search_data=$this->db->select('search_data')->get_where('search_history',array('origin'=>$rowH['search_id']))->row_array();
    			 // debug(json_decode($search_data['search_data'],1));exit;
    			 $search_data=json_decode($search_data['search_data'],1);
    			$aData[$rowB['con_pnr_no']] = array(
    						'type' => 'BUS',
    						'con_pnr_no' => $rowB['con_pnr_no'],
    						'booking_status' => $rowB['booking_status'],
    						'user_name' => ($rowB['user_name']!='')?$rowB['user_name']:'---',
    						'leadpax' => $rowB['leadpax'],
    						'pnr_no' => $rowB['pnr_no'],
    						'total_cost' => $rowB['api_tax'],
    						'admin_markup' => $rowH['admin_markup'],
    						'agent_markup' => ($rowH['agent_markup']!='')?$rowH['agent_markup']:0.00	,
    						'api_rate' => $rowB['total_amount'],
    						'origin' => $rowB['origin_city'],
    						'destination' => $rowB['destination_city'],
    						'mode' => '---',
    						'voucher_date' => $rowB['voucher_date'],
    						'depart_date' => str_replace('T', ' ', $rowB['departure_date']),
    						'return_date' => str_replace('T', ' ', $rowB['arrival_date']),
    						
    					);
    		}
// debug($aData);exit;
    		$data['res'] = $aData;
    	}
    	else{
    		
    	}
    	$data['searchData'] = $searchData;
    	$data['page_title'] = 'Quick Search';
    	$this->load->view('reports/search_report', $data);
    }
     
    function search_report_second()
    {
    	$searchData = '';
    	$get_data = $this->input->get();
    	
    	if($get_data['filter'])
    	{
    	  //echo '<pre>';print_r($get_data);exit();
	
		$condition = array();

		$filter_data = $this->format_search_filters();
		
		$condition = $filter_data['filter_condition'];
		
		//echo '<pre>';print_r($condition);exit();
		
		$searchData = $get_data;
		
    		$flight = $this->reports_model->search_flight_booking_new($condition);
    		$hotel = $this->reports_model->search_hotel_booking_new($get_data);
    		$bus = $this->reports_model->search_bus_booking_new($get_data);
    		// debug($flight);exit;
    		if (is_array($flight)) { 
    		foreach ($flight as $rowF) {
    			$segment_data = json_decode($rowF['request_scenario'],true);
    			$aData[$rowF['con_pnr_no']] = array(
    						'type' => 'FLIGHT',
    						'con_pnr_no' => $rowF['con_pnr_no'],
    						'booking_status' => $rowF['booking_status'],
    						'user_name' => ($rowF['user_name']!='')?$rowF['user_name']:'---',
    						'leadpax' => $rowF['leadpax'],
    						'pnr_no' => $rowF['pnr_no'],
    						'total_cost' => $rowF['total_amount'],
    						'admin_markup' => $rowF['admin_markup'],
    						'agent_markup' => ($rowF['agent_markup']!='')?$rowF['agent_markup']:'0.00',
    						'api_rate' => $rowF['api_rate'],
    						'origin' => $rowF['origin'],
    						'destination' => $rowF['destination'],
    						'mode' => $rowF['mode'],
    						'voucher_date' => $rowF['voucher_date'],
    						'depart_date' => $segment_data['depart_date'],
    						'return_date' => @$segment_data['return_date'],
    						'billing_date' => date("Y-m-d", strtotime($rowF['booking_timestamp'])),
    					);
    		}
    	}
    		if (is_array($bus)) {    			
    		foreach ($bus as $rowb) {
    			$segment_data = json_decode($rowb['request_scenario'],true);
    			// debug($rowb);exit;
    			$aData[$rowb['con_pnr_no']] = array(
    						'type' => 'BUS',
    						'con_pnr_no' => $rowb['con_pnr_no'],
    						'booking_status' => $rowb['booking_status'],
    						'user_name' => ($rowb['user_name']!='')?$rowb['user_name']:'---',
    						'leadpax' => $rowb['leadpax'],
    						'pnr_no' => $rowb['pnr_no'],
    						'api_tax' => $rowb['api_tax'],
    						'admin_markup' => $rowb['admin_markup'],
    						'agent_markup' => ($rowb['agent_markup']!='')?$rowb['agent_markup']:'0.00',
    						'total_cost' => $rowb['total_amount'],
    						'discount' => $rowb['discount'],
    						'origin' => $rowb['origin_city'],
    						'destination' => $rowb['destination_city'],
    						'mode' => '---',
    						'voucher_date' => $rowb['voucher_date'],
    						'depart_date' => str_replace('T', ' ', $rowb['departure_date']),
    						'return_date' => str_replace('T', ' ', $rowb['arrival_date']),
    						'billing_date' => date("Y-m-d", strtotime($rowb['booking_timestamp'])),
    					);
    		}
    		}
    		if (is_array($hotel)) {
    		foreach ($hotel as $rowh) {
    			$segment_data = json_decode($rowh['request_scenario'],true);
    			$search_data=$this->db->select('search_data')->get_where('search_history',array('origin'=>$rowh['search_id']))->row_array();
    			 $search_data=json_decode($search_data['search_data'],1);
    			// debug($rowh);exit;
    			$aData[$rowh['con_pnr_no']] = array(
    						'type' => 'Hotel',
    						'con_pnr_no' => $rowh['con_pnr_no'],
    						'booking_status' => $rowh['booking_status'],
    						'user_name' =>  ($rowh['user_name']!='')?$rowh['user_name']:'---',
    						'leadpax' => $rowh['leadpax'],
    						'pnr_no' => $rowh['pnr_no'],
    						'api_tax' => $rowh['api_tax'],
    						'admin_markup' => $rowh['admin_markup'],
    						'agent_markup' => ($rowh['agent_markup']!='')?$rowh['agent_markup']:'0.00',
    						'total_cost' => $rowh['total_cost'],
    						'origin' => $search_data['city'],
    						'destination' => '---',
    						'mode' => json_decode($rowh['room_type'],1)[0],
    						'voucher_date' => $rowh['voucher_date'],
    						'depart_date' => $search_data['hotel_checkin'],
    						'return_date' => $search_data['hotel_checkout'],
    						'billing_date' => date("Y-m-d", strtotime($rowh['booking_timestamp'])),
    					);
    		}
    	    }
    		$data['res'] = $aData;
		
    	}
    	// debug($data);exit;
    	$data['searchData'] = $searchData;
    	
    	$data['page_title'] = 'Quick Search';
    	$data['users'] = $this->user_model->get_allusers_status('B2B','ACTIVE');
    	
    	$this->load->view('reports/search_report_second', $data);
    }
    
    private function format_search_filters()
	{
		$get_data = $this->input->get();

		if(is_array($get_data) == true) {
			$filter_condition = array();
			//From-Date and To-Date

			if(empty($get_data['created_datetime_from']) == false) {
			    $from_date = trim(@$get_data['created_datetime_from']);
			    $from_date = date('Y-m-d', strtotime($from_date));
				$filter_condition[] = array('bg.voucher_date', '>=', $this->db->escape($from_date));
			}
			if(empty($get_data['created_datetime_to']) == false) {
			    $to_date = trim(@$get_data['created_datetime_to']);
			    $to_date = date('Y-m-d', strtotime($to_date));
				$filter_condition[] = array('bg.voucher_date', '<=', $this->db->escape($to_date));
			}
			
			if(empty($get_data['billing_date']) == false) {
			    
			    $billing_date = trim(@$get_data['billing_date']);
			    $billing_date = date('Y-m-d', strtotime($billing_date));
			
				$filter_condition[] = array('bt.booking_timestamp', ' like ', $this->db->escape('%'.trim($billing_date).'%'));
			}
	
		
			if (empty($get_data['con_number']) == false) {
				$filter_condition[] = array('bg.con_pnr_no', ' like ', $this->db->escape('%'.trim($get_data['con_number']).'%'));
			}
			
			if (empty($get_data['pnr']) == false) {
				$filter_condition[] = array('bg.pnr_no', ' like ', $this->db->escape('%'.trim($get_data['pnr']).'%'));
			}
			
			if (empty($get_data['user_id']) == false) {
				$filter_condition[] = array('bg.user_id', '=', $get_data['user_id']);
			}
			
			if (empty($get_data['origin']) == false) {
			    
			    $origin = substr(chop(substr($get_data['origin'], -5), ')'), -3);
			    
			    $filter_condition[] = array('bf.origin', ' like ', $this->db->escape('%'.trim($origin).'%'));
			    
			    /*if(strlen($get_data['origin']) <= 3)
			    {
			        $filter_condition[] = array('bf.origin', ' like ', $this->db->escape('%'.trim($get_data['origin']).'%'));
			    }else{
			        $filter_condition[] = array('bf.origin_airport', ' like ', $this->db->escape('%'.trim($get_data['origin']).'%'));
			    }*/
			
			}
			
			if (empty($get_data['destination']) == false) {
			    
			    $destination = substr(chop(substr($get_data['destination'], -5), ')'), -3);
			    
			    $filter_condition[] = array('bf.destination', ' like ', $this->db->escape('%'.trim($destination).'%'));
			    
			}
			
			
			return array('filter_condition' => $filter_condition, 'from_date' => $from_date, 'to_date' => $to_date);
		}
	}

	function user_bookings($user_id)
	{
		$data['reports'] = $this->reports_model->get_user_bookings($user_id); 

		$this->load->view('reports/view',$data);
	}
	function product_basis()
	{
		$data['product_reports'] = $this->reports_model->product_reports(); 
		$data['total_reports'] = $this->reports_model->total_reports(); 
		$data['first_chart'] = $this->reports_model->first_chart();
		$data['second_chart'] = $this->reports_model->second_chart($start='',$end='');
		$data['third_chart'] = $this->reports_model->third_chart();
		$data['fourth_chart'] = $this->reports_model->fourth_chart();
		$data['pie_chart'] = $this->reports_model->pie_chart();
		$data['statics_reports'] = $this->reports_model->statics_reports();
		$data['product'] = $this->reports_model->products();
		//echo "<pre>"; print_r($data['fourth_chart']); echo "</pre>";exit;
		$this->load->view('reports/product_basis',$data);
	}
	function ajax_chart(){
		$start = $this->input->post('start');
		$end = $this->input->post('end');
	//echo $start .''.$end;
		$data['ajax_chart'] = $this->reports_model->second_chart($start,$end);
	//print_r($data['ajax_chart']);
		$data['product'] = $this->reports_model->products();
		$this->load->view('reports/graph_ajax',$data);
	}
	public function b2b_basis(){
		$access = "b2b";
		$data['b2b_bookings'] = $this->reports_model->b2b_bookings($access);
		$this->load->view('reports/b2b_basis',$data);
	}
	public function b2c_basis(){
		$access = "b2c";
		$data['b2c_bookings'] = $this->reports_model->b2b_bookings($access);
		
		$this->load->view('reports/b2c_basis',$data);
	}
	public function country_basis(){
		$data['country_basis'] = $this->reports_model->country_basis();
		//print_r($data['country_basis']); exit;
		$this->load->view('reports/country_basis',$data);
	}
	public function city_basis(){
		$data['city_basis'] = $this->reports_model->city_basis();
		//print_r($data['country_basis']); exit;
		$this->load->view('reports/city_basis',$data);
	}
	
	public function b2c(){
		redirect(base_url().'reports/b2c_basis');
	}
	public function b2b(){
		echo "under progress";
		exit;
		//redirect(base_url().'reports/b2b_basis');
	}
	public function flight_b2c_reports($user_type=B2C_USER,$user_id=0){
		$data= array();		
		if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		}
		//$user_type = B2C_USER ; // b2c users;
		$filter_data = $this->format_basic_search_filters_book();
         $data['from_date'] = $filter_data['from_date'];
		 $data['to_date'] = $filter_data['to_date'];
		 $condition = $filter_data['filter_condition'];
		 if(valid_array($this->input->get()) == true) {
  			$data['flight_data'] = $this->reports_model->flight_booking_condition($user_type,$user_id, $condition);
		 }else{
  			$data['flight_data'] = $this->reports_model->flight_booking($user_type,$user_id);

		 }
		$data['page_title'] = 'B2C Flight Booking Reports';
		$this->load->view('reports/b2c_flight_report', $data);
	}
	public function flight_b2b_reports($user_type=B2B_USER,$user_id=0){
		$data= array();		
		if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		}
		$filter_data = $this->format_basic_search_filters_book();
         $data['from_date'] = $filter_data['from_date'];
		 $data['to_date'] = $filter_data['to_date'];
		 $condition = $filter_data['filter_condition'];

		// $data['flight_data'] = $this->reports_model->flight_booking($user_type,$user_id);
		 if(valid_array($this->input->get()) == true) {
  			$data['flight_data'] = $this->reports_model->flight_booking_condition($user_type,$user_id, $condition);
		 }else{
  			$data['flight_data'] = $this->reports_model->flight_booking($user_type,$user_id);
		 }

		$data['page_title'] = 'B2B Flight Booking Reports';
					
		$this->load->view('reports/b2b_flight_report', $data);
	}
	
	public function car_b2c_reports($user_type=B2C_USER,$user_id=0){}
	public function car_b2b_reports($user_type=B2B_USER,$user_id=0){}
	function auto_swipe_dates_flyonair($from_date, $to_date)
	{
		if(empty($from_date) == false && empty($to_date) == false) {
			if(strtotime($from_date) > strtotime($to_date)) {//Validating From date and To date
				return array('from_date' => $to_date, 'to_date' => $from_date);
			} else {
				return array('from_date' => $from_date, 'to_date' => $to_date);
			}
		}
	}
	function db_current_datetime_flyonair($date='')
	{
		if (empty($date) == false) {
			return date('Y-m-d H:i:s', strtotime($date));
		} else {
			return date('Y-m-d H:i:s', time());
		}
	}
	private function format_basic_search_filters_book($module='')
	{
		$get_data = $this->input->get();

		if(valid_array($get_data) == true) {
			$filter_condition = array();
			//From-Date and To-Date
			$from_date = trim(@$get_data['created_datetime_from']);
			$to_date = trim(@$get_data['created_datetime_to']);
			//Auto swipe date
			if(empty($from_date) == false && empty($to_date) == false)
			{
				$valid_dates = $this->auto_swipe_dates_flyonair($from_date, $to_date);
				$from_date = $valid_dates['from_date'];
				$to_date = $valid_dates['to_date'];
			}
			if(empty($from_date) == false) {
				$filter_condition[] = array('bg.voucher_date', '>=', $this->db->escape($this->db_current_datetime_flyonair($from_date." 00:00:00")));
			}
			if(empty($to_date) == false) {
				$flyonair_to = $this->db->escape($this->db_current_datetime_flyonair($to_date))." 23:59:59";
				$filter_condition[] = array('bg.voucher_date', '<=', $this->db->escape($this->db_current_datetime_flyonair($to_date." 23:59:59")));
			}
			
			$page_data['from_date'] = $from_date;
			$page_data['to_date'] = $to_date;

			//Today's Booking Data
			if(isset($get_data['today_booking_data']) == true && empty($get_data['today_booking_data']) == false) {
				$filter_condition[] = array('(bg.voucher_date)', '>=', '"'.date('Y-m-d').' 00:00:00"');
				$filter_condition[] = array('(bg.voucher_date)', '<=', '"'.date('Y-m-d').' 23:59:59"');
			}
			//Last day Booking Data
			if(isset($get_data['last_day_booking_data']) == true && empty($get_data['last_day_booking_data']) == false) {
				$filter_condition[] = array('(bg.voucher_date)', '>=', '"'.trim($get_data['last_day_booking_data']).' 00:00:00"');
				$filter_condition[] = array('(bg.voucher_date)', '<=', '"'.trim($get_data['last_day_booking_data']).' 23:59:59"');
			}
			//Previous Booking Data: last 3 days, 7 days, 15 days, 1 month and 3 month
			if(isset($get_data['prev_booking_data']) == true && empty($get_data['prev_booking_data']) == false) {
				$filter_condition[] = array('(bg.voucher_date)', '>=', '"'.trim($get_data['prev_booking_data']).' 00:00:00"');
			}
			
			return array('filter_condition' => $filter_condition, 'from_date' => $from_date, 'to_date' => $to_date);
		}
	}
	public function activity_b2c_reports($user_type=B2C_USER,$user_id=0){}

	public function activity_b2b_reports($user_type=B2B_USER,$user_id=0){}

	public function transfer_b2c_reports($user_type=B2C_USER,$user_id=0){}
	public function transfer_b2b_reports($user_type=B2B_USER,$user_id=0){}

	public function bundle_b2c_reports($user_type=B2C_USER,$user_id=0){}

	public function bundle_b2b_reports($user_type=B2B_USER,$user_id=0){}


	public function bundle_view_voucher($pnr,$module,$con_pnr_no){}
	public function view_voucher($Pnr='',$con_pnr_no){
		$Pnr = base64_decode($Pnr);
		$con_pnr_no = base64_decode($con_pnr_no);

		 $count = $this->reports_model->getBookingPnr($Pnr,$con_pnr_no)->num_rows();

         	// debug($b_data);exit;
		if($count==1){
		 	$b_data = $this->reports_model->getBookingPnr($Pnr,$con_pnr_no)->row();
		 	$admin_details = $this->reports_model->get_admin_details();
         	$data['admin_details'] = $admin_details;
		 	if($b_data->product_name == 'FLIGHT'){
				  				
		         $data['b_data'] = $this->reports_model->getBookingPnr($Pnr,$con_pnr_no)->row();

		         $booking_global_id=$data['b_data']->booking_global_id;
		          $billing_address_id=$data['b_data']->billing_address_id;

		         $data['Passenger'] = $passenger = $this->reports_model->getPassengerbyid($booking_global_id)->result();
		         $data['flight_iterna'] = $this->reports_model->getBookingFlightTemp($data['b_data']->referal_id)->row();

		         $data['booking_agent'] = $passenger = $this->reports_model->getagentbyid($billing_address_id)->result();

		          $booking_transaction_id = $data['b_data']->booking_transaction_id;
		          $data['booking_transaction'] = $this->reports_model->getbookingTransaction($booking_transaction_id)->result();
		          
				//$this->load->view('voucher/flight_mail_voucher', $data);	 
		         $this->load->view('voucher/flight_voucher', $data);	 

				//$this->load->view('voucher/flight_voucher', $data);	 
			
            }
            if($b_data->product_name == 'HOTEL'){
				$data['Booking'] = $booking = $this->reports_model->getBookingbyPnr($b_data->pnr_no,$b_data->product_name,$b_data->con_pnr_no)->row();
				$data['Passenger'] = $passenger = $this->reports_model->getPassengerbyPnr($booking->booking_global_id)->result();
				$data['cart']	= $cart = $this->reports_model->get_hotel_other_details_acount($booking->parent_pnr_no);
				$hotel_data = $this->reports_model->get_hotel_other_details($cart->HotelCode,$cart->session_id);
                $data['hotel_data'] = $this->reports_model->get_hotel_other_details($cart->HotelCode,$cart->session_id);
                $data['request_data'] = unserialize($hotel_data[0]['request']);
				// debug($data);exit;
                //echo '<pre>';print_r( $data['request_data']);exit();
				$this->load->view('voucher/hotel_voucher_view', $data);
            }
             if($b_data->product_name == 'BUS'){
				$data['Booking'] = $booking = $this->reports_model->getBookingbyPnr($b_data->pnr_no,$b_data->product_name,$b_data->con_pnr_no)->row();
				$data['Passenger'] = $passenger = $this->reports_model->getPassengerbyPnr($booking->booking_global_id)->result();
				$data['busData']	= $busData = $this->reports_model->getBookingTempbus($booking->referal_id);
				$data['getAllData'] = $bus_data=$this->reports_model->get_bus_other_details($busData->global_id);
				$data['cart']	= $cart = $this->reports_model->getBookingTempbuscart($bus_data[0]['origin'],$bus_data[0]['session_id']);
			
				$data['bus_datas'] =json_decode($bus_data[0]['checkout_form']);
				//echo '<pre>';print_r($data['busData']);exit();
			
				$this->load->view('voucher/bus_voucher', $data);
            }
		}
	}
	public function mail(){
	
		$pnr_no = $_POST['PNR_NO'];
		$con_pnr_no = $_POST['CON_PNR_NO'];
		$email =  $_POST['Email'];
		$this->load->library('provab_mailer');
		 $count = $this->reports_model->getBookingPnr($pnr_no,$con_pnr_no)->num_rows();	 
        if($count == 1){
            $b_data = $this->reports_model->getBookingPnr($pnr_no,$con_pnr_no)->row();   
            // debug($b_data);
            // exit;
          	$admin_details = $this->reports_model->get_admin_details();

         	$data['admin_details'] = $admin_details;
            if($b_data->product_name == 'FLIGHT'){            
           $data['b_data'] = $this->reports_model->getBookingPnr($pnr_no,$con_pnr_no)->row();     
           $booking_global_id=$b_data->booking_global_id;
           $billing_address_id=$b_data->billing_address_id;
             
                 $data['Passenger'] = $passenger = $this->reports_model->getPassengerbyid($booking_global_id)->result();
                 $data['booking_agent'] = $passenger = $this->reports_model->getagentbyid($billing_address_id)->result();

                   $booking_transaction_id = $data['b_data']->booking_transaction_id;
		          $data['booking_transaction'] = $this->reports_model->getbookingTransaction($booking_transaction_id)->result();

                $data['message'] = $this->load->view('voucher/flight_mail_voucher',$data,TRUE);
                 
                $data['to'] = $email;               
                $data['booking_status'] = $b_data->booking_status;
                $data['pnr_no'] = $pnr_no;               
                $email_type = 'TRIPGOLOBO-Flight Voucher-'.$pnr_no;
                // $Response = $this->provab_mailer->send_mail($email,$email_type,$data['message']);  
                // echo $email_type; 
                $response = $this->email_model->sendmail_flightVoucher($data); 
                // echo $response;exit;           
                 if($response==true){
                	$response = array('status'=>1);
                }else{
                	$response = array('status'=>0);
                }              
            }
        }else{
            $response = array('status' => 0);
            echo json_encode($response);
        }

        echo json_encode($response);
        exit;

    }
     public function BundleCancelPnr(){}
    private function xml2array($xmlStr, $get_attributes = 1, $priority = 'tag') 
	{
    	//print_r($xmlStr);die();
        // I renamed $url to $xmlStr, $url was the first parameter in the method if you
        // want to load from a URL then rename $xmlStr to $url everywhere in this method
		$contents = "";
		if (!function_exists('xml_parser_create')) {
			return array();
		}
		$parser = xml_parser_create('');

		xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8");
		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
		xml_parse_into_struct($parser, trim($xmlStr), $xml_values);
		xml_parser_free($parser);
		if (!$xml_values)
            return; //Hmm...
        //echo "<pre>"; print_r($xml_values); echo "</pre>";  die();
        $xml_array = array();
        $parents = array();
        $opened_tags = array();
        $arr = array();
        $current = & $xml_array;
        $repeated_tag_index = array();
        foreach ($xml_values as $data) {
        	unset($attributes, $value);
            //echo "<pre>"; print_r($get_attributes); echo "</pre>";  die();
        	extract($data);
        	$result = array();
        	$attributes_data = array();
        	if (isset($value)) {
        		if ($priority == 'tag')
        			$result = $value;
        		else
        			$result['value'] = $value;
        	}
        	if (isset($attributes) and $get_attributes) {
        		foreach ($attributes as $attr => $val) { 
        			if ($priority == 'tag')
        				$attributes_data[$attr] = $val;
        			else
                    	$result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
                }
            }
            if ($type == "open") {
            	$parent[$level - 1] = & $current; 
            	if (!is_array($current) or (!in_array($tag, array_keys($current)))) {
            		$current[$tag] = $result;
            		if ($attributes_data)
            			$current[$tag . '_attr'] = $attributes_data;
            		$repeated_tag_index[$tag . '_' . $level] = 1;
            		$current = & $current[$tag];
            	}
            	else {
            		if (isset($current[$tag][0])) {
            			$current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
            			$repeated_tag_index[$tag . '_' . $level]++;
            		} else {
            			$current[$tag] = array(
            				$current[$tag],
            				$result
            				);
            			$repeated_tag_index[$tag . '_' . $level] = 2;
            			if (isset($current[$tag . '_attr'])) {
            				$current[$tag]['0_attr'] = $current[$tag . '_attr'];
            				unset($current[$tag . '_attr']);
            			}
            		}
            		$last_item_index = $repeated_tag_index[$tag . '_' . $level] - 1;
            		$current = & $current[$tag][$last_item_index];
            	}
            } elseif ($type == "complete") {
            	if (!isset($current[$tag])) {
            		$current[$tag] = $result;
            		$repeated_tag_index[$tag . '_' . $level] = 1;
            		if ($priority == 'tag' and $attributes_data)
            			$current[$tag . '_attr'] = $attributes_data;
            	}
            	else {
            		if (isset($current[$tag][0]) and is_array($current[$tag])) {
            			$current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
            			if ($priority == 'tag' and $get_attributes and $attributes_data) {
            				$current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
            			}
            			$repeated_tag_index[$tag . '_' . $level]++;
            		} else {
            			$current[$tag] = array(
            				$current[$tag],
            				$result
            				);
            			$repeated_tag_index[$tag . '_' . $level] = 1;
            			if ($priority == 'tag' and $get_attributes) {
            				if (isset($current[$tag . '_attr'])) {
            					$current[$tag]['0_attr'] = $current[$tag . '_attr'];
            					unset($current[$tag . '_attr']);
            				}
            				if ($attributes_data) {
            					$current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
            				}
            			}
                        $repeated_tag_index[$tag . '_' . $level]++; //0 and 1 index is already taken
                    }
                }
            } elseif ($type == 'close') {
            	$current = & $parent[$level - 1];
            }
        }
        //echo "<pre>"; print_r($xml_array); echo "</pre>";  die();
        return ($xml_array);
}
    public function CancelPnr(){}
    public function transfer_activity_cancel(){}

/*new function added */
    public function get_change_request()
    {
    	// error_reporting(E_ALL);
    	$data['reports_data'] = $this->reports_model->getChangeRequest();
    	$this->load->view('change_request/view',$data);
    }
    
     public function update_change_status($id)
    {
      
            $this->reports_model->updateChangeRequest_flag($id);
            
            echo '<script language="javascript">';
            echo 'alert("Action Taken! Thankyou.")';
            echo '</script>';
            $data['reports_data'] = $this->reports_model->getChangeRequest();
    	    $this->load->view('change_request/view',$data);
    }
    public function group_booking()
    {
    	if(count($_POST)>0){
    		if(($_POST['created_datetime_from']=='')&&($_POST['created_datetime_to']=='')&&($_POST['agent_list']=='')){
    			$data['group_report'] = $this->reports_model->get_group_bookings();	
    		}else{
    			$data['filter_data']=$_POST;
    			$data['group_report'] = $this->reports_model->get_filter_group_bookings($_POST);	
  		// debug($data);exit;
  		
    		}
    	}else{
    		$data['group_report'] = $this->reports_model->get_group_bookings();	
    	}	
  		$data['agent_list'] = $this->reports_model->get_agent_list();	
		$this->load->view('reports/group_booking_report', $data);
    }
   
    function gb_history($gb_id){
	    if($gb_id){
	        $decode_resp=explode('-brk-',json_decode(base64_decode($gb_id)));
	        
	        if($decode_resp[0]!='' && $decode_resp[1]!=''){
	           $data1['group_report']= $this->reports_model->get_gb_history($decode_resp[1]);
	        }
	    }
	   $this->load->view('reports/group_booking_history', $data1);
	   
	}
    
    
    
    
/*end*/
    
    function gpm()
	{
		$data['product_reports'] = $this->reports_model->product_reports(); 
		$data['total_reports'] = $this->reports_model->total_reports(); 
		$data['first_chart'] = $this->reports_model->first_chart();
		$data['second_chart'] = $this->reports_model->second_chart($start='',$end='');
		$data['third_chart'] = $this->reports_model->third_chart();
		$data['fourth_chart'] = $this->reports_model->fourth_chart();
		$data['pie_chart'] = $this->reports_model->pie_chart();
		$data['statics_reports'] = $this->reports_model->statics_reports();
		$data['product'] = $this->reports_model->products();
		$data['b2b_bookings'] = $this->reports_model->b2b_bookings('b2b');
		$data['b2c_bookings'] = $this->reports_model->b2b_bookings('b2c');
	
		$this->load->view('reports/gpm',$data);
	}


    public function update_ticket($Pnr='',$con_pnr_no){
		$Pnr = base64_decode($Pnr);
		$con_pnr_no = base64_decode($con_pnr_no);

		 $count = $this->reports_model->getBookingPnr($Pnr,$con_pnr_no)->num_rows();

		if($count==1){
		 	$b_data = $this->reports_model->getBookingPnr($Pnr,$con_pnr_no)->row();
		 	$admin_details = $this->reports_model->get_admin_details();
         	$data['admin_details'] = $admin_details;
		 	if($b_data->product_name == 'FLIGHT'){
				  				
		         $data['b_data'] = $this->reports_model->getBookingPnr($Pnr,$con_pnr_no)->row();

		         $booking_global_id=$data['b_data']->booking_global_id;
		          $billing_address_id=$data['b_data']->billing_address_id;

		         $data['Passenger'] = $passenger = $this->reports_model->getPassengerbyid($booking_global_id)->result();
		         $data['flight_iterna'] = $this->reports_model->getBookingFlightTemp($data['b_data']->referal_id)->row();

		         $data['booking_agent'] = $passenger = $this->reports_model->getagentbyid($billing_address_id)->result();

		          $booking_transaction_id = $data['b_data']->booking_transaction_id;
		          $data['booking_transaction'] = $this->reports_model->getbookingTransaction($booking_transaction_id)->result();
		          $data['pnr_no'] = $Pnr;
				//$this->load->view('voucher/flight_mail_voucher', $data);	 
		         $this->load->view('reports/update_ticket', $data);	 

				//$this->load->view('voucher/flight_voucher', $data);	 
			
            }
		}
	}
	
	function add_ticket()
	{
	   // echo '<pre>';print_r($_POST);exit('testing');
	    $data = $_POST;
	    $this->reports_model->add_passenger_ticket($data);
	    
	    $response['status'] = true;
	    print_r(json_encode($response));
	}
	function update_remark(){
	    if($_POST['gb_id'] && $_POST['remarks']){
	        $decode_resp=explode('-brk-',json_decode(base64_decode($_POST['gb_id'])));
	        // debug($decode_resp);exit;
	        if($decode_resp[0]!='' && $decode_resp[1]!=''){
	        	 $this->load->model('email_model');
	        	
	        	$data_g =$this->db->get_where('group_booking',array('id'=>$decode_resp[0],'gb_id'=> $decode_resp[1]))->row_array();
                // debug($data_g);exit;
	        	$user_data =$this->db->get_where('user_details',array('user_id'=>$data_g['agent_id']))->row();
                
                 $this->email_model->group_booking_email('GROUP_BOOKING_ACCEPT',$decode_resp[1],$_POST['remarks'],$user_data);
	            $data=array('remarks'=>$_POST['remarks']);
	             $sub_admin_id = $this->session->userdata('admin_id');
	            $this->reports_model->update_group_booking_remarks($data,$decode_resp[0],$decode_resp[1],$sub_admin_id);
	        }
	    }
	    redirect(base_url().'reports/group_booking');
	}
	function delete_gb_remark($gb_id){
	    if($gb_id){
	        $decode_resp=explode('-brk-',json_decode(base64_decode($gb_id)));
	        if($decode_resp[0]!='' && $decode_resp[1]!=''){
	            $data=array('remarks'=>'');
	            $this->reports_model->update_group_booking_remarks($data,$decode_resp[0],$decode_resp[1]);
	        }
	    }
	    redirect(base_url().'reports/group_booking');
	}
	
	function update_request_remark(){
	    if($_POST['request_id'] && $_POST['remarks']){
	    	$request_data=$this->db->get_where('change_request',array('id'=>json_decode(base64_decode($_POST['request_id']))))->row_array();
	    	$user_data=$this->db->select('user_email')->get_where('user_details',array('user_id'=>$request_data['user_id']))->row_array();
	        
	    // debug($user_data['user_email']);exit;
	        $request_id =json_decode(base64_decode($_POST['request_id']));
	        if($request_id){
	            $data=array('remarks'=>$_POST['remarks'],'flag'=>mysql_real_escape_string(1));
	             $sub_admin_id = $this->session->userdata('admin_id');
	            $this->reports_model->update_request_remark($data,$request_id,$sub_admin_id);
	            $subject='Update PNR Remarks';
	            $this->load->model('email_model');
	            $this->email_model->sendpromomail_bulk($user_data['user_email'],$subject,$_POST['remarks']);
	        }
	    }
	    redirect(base_url().'reports/get_change_request');
	}
	function delete_request_remark($req_id){
	    if($gb_id){
	        $decode_resp=explode('-brk-',json_decode(base64_decode($gb_id)));
	        if($decode_resp[0]!='' && $decode_resp[1]!=''){
	            $data=array('remarks'=>'');
	            $this->reports_model->update_group_booking_remarks($data,$decode_resp[0],$decode_resp[1]);
	        }
	    }
	    redirect(base_url().'reports/group_booking');
	}
	
	 function get_request_remark_history($request_id){
	    if($request_id){
	        $request_id = json_decode(base64_decode($request_id));
	        
	        if($request_id){
	           $data1['request_remark']= $this->reports_model->get_request_remark_history($request_id);
	        }
	    }
	   $this->load->view('change_request/request_remark_history', $data1);
	   
	}
    
	public function flight_staff_reports($user_type=STAFF_USER,$user_id=0){
		$data= array();		
		if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		}
		$filter_data = $this->format_basic_search_filters_book();
         $data['from_date'] = $filter_data['from_date'];
		 $data['to_date'] = $filter_data['to_date'];
		 $condition = $filter_data['filter_condition'];

		// $data['flight_data'] = $this->reports_model->flight_booking($user_type,$user_id);
		 if(valid_array($this->input->get()) == true) {
  			$data['flight_data'] = $this->reports_model->flight_booking_condition($user_type,$user_id, $condition);
		 }else{
  			$data['flight_data'] = $this->reports_model->flight_booking($user_type,$user_id);
		 }

		$data['page_title'] = 'STAFF Flight Booking Reports';
					
		$this->load->view('reports/staff_flight_report', $data);
	}
	
		function update_staff_request_remark(){
	    // echo '<pre>';print_r($_POST);
	    if($_POST['request_id'] && $_POST['remarks']){
	        $request_id =json_decode(base64_decode($_POST['request_id']));
	        //echo $request_id;exit();
	        if($request_id){
	            $data=array('remarks'=>$_POST['remarks']);
	             $sub_admin_id = $this->session->userdata('admin_id');
	            $this->reports_model->update_staff_request_remark($data,$request_id,$sub_admin_id);
	        }
	    }
	    redirect(base_url().'reports/get_change_request');
	}

    
    public function hotel_b2c_reports($user_type=B2C_USER,$user_id=0){
		$data= array();		
		if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		}
		//$user_type = B2C_USER ; // b2c users;
		$filter_data = $this->format_basic_search_filters_book();
         $data['from_date'] = $filter_data['from_date'];
		 $data['to_date'] = $filter_data['to_date'];
		 $condition = $filter_data['filter_condition'];
		 if(valid_array($this->input->get()) == true) {
  			$data['hotel_data'] = $this->reports_model->hotel_booking_condition($user_type,$user_id, $condition);
		 }else{
  			$data['hotel_data'] = $this->reports_model->hotel_booking($user_type,$user_id);
		 }
		 // echo '<pre>';print_r($data['hotel_data']);exit();
		 
		$data['page_title'] = 'B2C Hotel Booking Reports';
		$this->load->view('reports/hotel/b2c_hotel_report', $data);
	}
	 public function bus_b2c_reports($user_type=B2C_USER,$user_id=0){
		$data= array();		
		if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		}
		//$user_type = B2C_USER ; // b2c users;
		$filter_data = $this->format_basic_search_filters_book();
         $data['from_date'] = $filter_data['from_date'];
		 $data['to_date'] = $filter_data['to_date'];
		 $condition = $filter_data['filter_condition'];
		 if(valid_array($this->input->get()) == true) {
  			$data['bus_data'] = $this->reports_model->bus_booking_condition($user_type,$user_id, $condition);
		 }else{
  			$data['bus_data'] = $this->reports_model->bus_booking($user_type,$user_id);
		 }
		 //echo '<pre>';print_r($data['hotel_data']);exit();
		 
		$data['page_title'] = 'B2C Bus Booking Reports';
		 	//	debug($data);die;
		$this->load->view('reports/bus/b2c_bus_report', $data);
	}
	public function hotel_b2b_reports($user_type=B2B_USER,$user_id=0){
		$data= array();		
		if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		}
		//$user_type = B2C_USER ; // b2c users;
		$filter_data = $this->format_basic_search_filters_book();
		// debug($filter_data);exit;
         $data['from_date'] = $filter_data['from_date'];
		 $data['to_date'] = $filter_data['to_date'];
		 $condition = $filter_data['filter_condition'];
		 if(valid_array($this->input->get()) == true) {
  			$data['hotel_data'] = $this->reports_model->hotel_booking_condition($user_type,$user_id, $condition);
		 }else{
  			$data['hotel_data'] = $this->reports_model->hotel_booking($user_type,$user_id);
		 }
		 //echo '<pre>';print_r($data['hotel_data']);exit();
		 
		$data['page_title'] = 'B2B Hotel Booking Reports';
		$this->load->view('reports/hotel/b2b_hotel_report', $data);
	}
	
	public function bus_b2b_reports($user_type=B2B_USER,$user_id=0){
		$data= array();		
		if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		}
		//$user_type = B2C_USER ; // b2c users;
		$filter_data = $this->format_basic_search_filters_book();
         $data['from_date'] = $filter_data['from_date'];
		 $data['to_date'] = $filter_data['to_date'];
		 $condition = $filter_data['filter_condition'];
		 if(valid_array($this->input->get()) == true) {
  			$data['bus_data'] = $this->reports_model->bus_booking_condition($user_type,$user_id, $condition);
		 }else{
  			$data['bus_data'] = $this->reports_model->bus_booking($user_type,$user_id);
		 }
		 //echo '<pre>';print_r($data['hotel_data']);exit();
		 
		$data['page_title'] = 'B2B Bus Booking Reports';
		//	debug($data);die;
		$this->load->view('reports/bus/b2b_bus_report', $data);
	}
	
	public function hotel_staff_reports($user_type=STAFF_USER,$user_id=0){
		$data= array();		
		if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		}
		//$user_type = B2C_USER ; // b2c users;
		$filter_data = $this->format_basic_search_filters_book();
         $data['from_date'] = $filter_data['from_date'];
		 $data['to_date'] = $filter_data['to_date'];
		 $condition = $filter_data['filter_condition'];
		 if(valid_array($this->input->get()) == true) {
  			$data['hotel_data'] = $this->reports_model->hotel_booking_condition($user_type,$user_id, $condition);
		 }else{
  			$data['hotel_data'] = $this->reports_model->hotel_booking($user_type,$user_id);
		 }
		 //echo '<pre>';print_r($data['hotel_data']);exit();
		 
		$data['page_title'] = 'Staff Hotel Booking Reports';
		$this->load->view('reports/hotel/staff_hotel_report', $data);
	}
	
	public function bus_staff_reports($user_type=STAFF_USER,$user_id=0){
		$data= array();		
		if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		}
	     $filter_data = $this->format_basic_search_filters_book();
         $data['from_date'] = $filter_data['from_date'];
		 $data['to_date'] = $filter_data['to_date'];
		 $condition = $filter_data['filter_condition'];
		 if(valid_array($this->input->get()) == true) {
  			$data['bus_data'] = $this->reports_model->bus_booking_condition($user_type,$user_id, $condition);
		 }else{
  			$data['bus_data'] = $this->reports_model->bus_booking($user_type,$user_id);
		 }
		 // echo '<pre>';print_r($data['bus_data']);exit();
		 
		$data['page_title'] = 'Staff Bus Booking Reports';
		$this->load->view('reports/bus/staff_bus_report', $data);
	}
	function cancel_hotel_booking($pnr,$con_pnr_no)
	{
    	 $pnr = base64_decode($pnr);
	     $con_pnr_no = base64_decode($con_pnr_no);
		 $count = $this->reports_model->getBookingPnr($pnr,$con_pnr_no)->num_rows();
		if($count==1){
		 	$booking = $this->reports_model->getBookingPnr($pnr,$con_pnr_no)->row();
		 	$cart = $this->reports_model->getBookingTemphotel($booking->cart_id);
		    $hotel_data = $this->reports_model->get_hotel_other_details($cart->HotelCode,$cart->session_id);
// debug($count);exit;
		    $this->load->helper('hotel/tbo_helper');
		    //echo '<pre>';print_r($booking);exit();
		     $tokenid = get_json_response_auth();
		    $data['BookingMode'] = 5;
		    $data['TokenId'] = $tokenid['TokenId'];
		    $data['EndUserIp'] = '127.0.0.1';
		    $data['BookingId'] = $booking->pnr_no;
		    $data['RequestType'] = 4; // cancel hotel booking
		    $data['Remarks'] = 'Hotel Booking Cancel';
		    
		    $api_id = $booking->api_id;

		    
		    $cancelResponse = tbo_hotel_cancel($data,$api_id);
		    
		    if($cancelResponse['status'])
		    {
		        $update_booking_status['booking_status'] = 'CANCELED';
		        $this->reports_model->update_booking_global($booking->booking_global_id, $update_booking_status);
		    }
		    
		    redirect(base_url().'reports/hotel_b2c_reports');
		 	
		}
	}
	
	function cancel_bus_booking($pnr,$con_pnr_no)
	{
		    $this->load->helper('bus/bus_tbo_helper');
    	 $pnr = base64_decode($pnr);
	     $con_pnr_no = base64_decode($con_pnr_no);
		 $count = $this->reports_model->getBookingPnr($pnr,$con_pnr_no)->num_rows();
		if($count==1){
		 	$booking = $this->reports_model->getBookingPnr($pnr,$con_pnr_no)->row();
		 	$cart = $this->reports_model->getBookingTempbus($booking->referal_id);
		    $bus_data = $this->reports_model->get_bus_other_details($cart->global_id);
		 		// $tokenid=json_decode($bus_data[0]['checkout_form']);

        $token=$this->db->get_where('authenticate_token',array('type'=>'BUS'))->row_array();
		 	// debug($token);exit;
	        if (date('Y-m-d',strtotime($token['create_at']))==date('Y-m-d') && json_decode($token['data'],1)['Status']== true) {
	            // debug($token);exit;
	            $tokenid=json_decode($token['data'],1);    
		 	// debug($tokenid);exit;
	        }else{ 	
		 	// debug($token);exit;
			    $tokenid = get_json_response_auth();		
         // debug($tokenid);exit;
	        	$this->db->where('type','BUS');
	             $token_data['data']=json_encode($tokenid);
	             $token_data['create_at']=date('Y-m-d');
	             $this->db->update('authenticate_token',$token_data);
	         }
		    // debug(json_decode($booking->request_scenario,1)['data']['result']['GetBookingDetailResult']['TraceId']);exit;
		    // $data['BookingMode'] = 1;
		    $data['AgencyId'] = $tokenid['Member']['AgencyId'];
		    // $data['TraceId'] = json_decode($booking->request_scenario,1)['data']['result']['GetBookingDetailResult']['TraceId'];
		    $data['TraceId'] = json_decode($booking->booking_res,1)['data']['result']['BookResult']['TraceId'];
		    $data['TokenId'] = $tokenid['TokenId'];
		    $data['EndUserIp'] = '127.0.0.1';
		    // $data['BookingId'] = '30327';
		    $data['BusId'] = $booking->booking_id;
		    $data['RequestType'] = 11; // cancel hotel booking
		    $data['Remarks'] = 'Bus Booking Cancel';		   
		    $api_id = $booking->api_id;

		    // debug($data);exit;
	       // debug(json_decode($booking->booking_res,1)['data']['result']['BookResult']['TraceId']);exit;
		    $cancelResponse = tbo_bus_cancel($data,$api_id);
		    if(!empty($cancelResponse['status']))
		    {
		       
		        $update_booking_status['booking_status'] = 'CANCELED';
		        $this->reports_model->update_booking_global($booking->booking_global_id, $update_booking_status);
		    }
		    redirect(base_url().'reports/bus_b2c_reports');
		 	
		}
	}


    public function insurance_b2c_reports($user_type=B2C_USER,$user_id=0){
        $data= array();     
        if(valid_array($this->input->get()) == true) {
            $data = $_GET;
        }
        //$user_type = B2C_USER ; // b2c users;
        $filter_data = $this->format_basic_search_filters_book();
         $data['from_date'] = $filter_data['from_date'];
         $data['to_date'] = $filter_data['to_date'];
         $condition = $filter_data['filter_condition'];
         if(valid_array($this->input->get()) == true) {
            // debug('test'); die;
            $data['flight_data'] = $this->reports_model->insurance_booking_condition($user_type,$user_id, $condition);
         }else{
            // debug('test2'); die;
            $data['flight_data'] = $this->reports_model->insurance_booking($user_type,$user_id);

         }

         // debug($data); die;
        $data['page_title'] = 'B2C Insurance Booking Reports';
        $this->load->view('reports/b2c_insurance_report', $data);
    }
	
}

?>
