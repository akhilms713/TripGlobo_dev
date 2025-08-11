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
		   //         if(!$this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id,$controller_name,$function_name))
				 //   {			
		   //  	 	  	access_denied('error');
					// }
				
       	 	}else{
       	 		//redirect(base_url());
       	 	}
		}else{
			
			//redirect(base_url());
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
    		foreach ($flight as $rowF) {
    			$segment_data = json_decode($rowF['request_scenario'],true);
    			$aData[] = array(
    						'type' => 'FLIGHT',

    						'con_pnr_no' => $rowF['con_pnr_no'],
    						'booking_status' => $rowF['booking_status'],
    						'user_name' => $rowF['user_name'],
    						'leadpax' => $rowF['leadpax'],
    						'pnr_no' => $rowF['pnr_no'],
    						'api_tax' => $rowF['api_tax'],
    						'admin_markup' => $rowF['admin_markup'],
    						'agent_markup' => $rowF['agent_markup'],
    						'api_rate' => $rowF['api_rate'],
    						
    						'origin' => $rowF['origin'],
    						'destination' => $rowF['destination'],
    						'mode' => $rowF['mode'],
    						'voucher_date' => $rowF['voucher_date'],
    						'depart_date' => $segment_data['depart_date'],
    						'return_date' => @$segment_data['return_date'],
    						

    						//'hotel_name' => "",
    						'room_count' => "",
    						'adult' => "",
    						'child' => "",

    						'car_model' => "", //$rowF['car_model'],
    						'company_name' => "", //$rowF['company_name'],

    					);
    		}
    		
    		$hotel = $this->reports_model->search_hotel_booking($user_type,$user_id, $condition);
    		
    		foreach ($hotel as $rowF) {
    			$aData[] = array(
    						'type' => 'HOTEL',

    						'con_pnr_no' => $rowF['con_pnr_no'],
    						'booking_status' => $rowF['booking_status'],
    						'user_name' => $rowF['user_name'],
    						'leadpax' => $rowF['leadpax'],
    						'pnr_no' => $rowF['pnr_no'],
    						'api_tax' => $rowF['api_tax'],
    						'admin_markup' => $rowF['admin_markup'],
    						'agent_markup' => $rowF['agent_markup'],
    						'api_rate' => $rowF['api_rate'],
    						
    						'origin' => $rowF['city'],
    						'destination' => "",
    						'mode' => "",
    						'voucher_date' => $rowF['voucher_date'],
    						'depart_date' => $rowF['check_in'],
    						'return_date' => $rowF['check_out'],
    						

    						//'hotel_name' => $rowF['hotel_name'],
    						'room_count' => $rowF['room_count'],
    						'adult' => $rowF['adult'],
    						'child' => $rowF['child'],

    						'car_model' => "", //$rowF['car_model'],
    						'company_name' => "", //$rowF['company_name'],

    					);
    		}

    		

    		$car = $this->reports_model->search_car_booking($user_type,$user_id, $condition);
    		foreach ($car as $rowF) {
    						$pikcup_date = $rowF['car_pick_day'].'-'.$rowF['car_pick_month'].'-'.$rowF['car_pick_year'];
                            $pikcup_date1 = date('M d,Y',strtotime($pikcup_date)).'<br/>/'.$rowF['car_pick_hour'];

                            $date_str = $rowF['car_drop_day'].'-'.$rowF['car_drop_month'].'-'.$rowF['car_drop_year'];  
                            $date_str1 = date('M d,Y',strtotime($date_str)).'<br/>/'.$rowF['car_drop_hour'];                        

    			$aData[] = array(
    						'type' => 'CAR',

    						'con_pnr_no' => $rowF['con_pnr_no'],
    						'booking_status' => $rowF['booking_status'],
    						'user_name' => '', //$rowF['user_name'],
    						'leadpax' => $rowF['leadpax'],
    						'pnr_no' => $rowF['pnr_no'],
    						'api_tax' => $rowF['api_tax'],
    						'admin_markup' => $rowF['admin_markup'],
    						'agent_markup' => $rowF['agent_markup'],
    						'api_rate' => $rowF['api_rate'],
    						
    						'origin' => $rowF['car_pick_up_ld_code'],
    						'destination' => $rowF['car_drop_off_ld_code'],
    						'mode' => "", //$rowF['mode'],
    						'voucher_date' => $rowF['voucher_date'],
    						'depart_date' => $pikcup_date1,
    						'return_date' => $date_str1,
    						

    						'hotel_name' => "", //$rowF['hotel_name'],
    						'room_count' => "", //$rowF['room_count'],
    						'adult' => "", //$rowF['adult'],
    						'child' => "", //$rowF['child'],

    						'car_model' => $rowF['car_model'],
    						'company_name' => $rowF['company_name'],

    					);
    		}

    		$data['res'] = $aData;
    	}
    	else{
    		
    	}
    	$data['searchData'] = $searchData;
    	$data['page_title'] = 'Search Booking Reports';
    	$this->load->view('reports/search_report', $data);
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
		// debug($data['flight_data']);
		// exit;
				
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
	public function hotel_b2c_reports($user_type=B2C_USER,$user_id=0){
		$data= array();
		if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		}		
		$filter_data = $this->format_basic_search_filters_book();
         $data['from_date'] = $filter_data['from_date'];
		 $data['to_date'] = $filter_data['to_date'];
		 $condition = $filter_data['filter_condition'];

		 if(valid_array($this->input->get()) == true) {
  			$data['hotel_data'] = $this->reports_model->hotel_booking_condition($user_type,$user_id, $condition);	
		 }else{
  			$data['hotel_data'] = $this->reports_model->hotel_booking($user_type,$user_id);	
		 }	
		$data['page_title'] = 'B2C Hotel Booking Reports';
		$this->load->view('reports/b2c_hotel_report', $data);
	}
	public function hotel_b2b_reports($user_type=B2B_USER,$user_id=0){
		$data= array();		
		if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		}
		$filter_data = $this->format_basic_search_filters_book();
         $data['from_date'] = $filter_data['from_date'];
		 $data['to_date'] = $filter_data['to_date'];
		 $condition = $filter_data['filter_condition'];

		// $data['hotel_data'] = $this->reports_model->hotel_booking($user_type,$user_id);

		 if(valid_array($this->input->get()) == true) {
  			$data['hotel_data'] = $this->reports_model->hotel_booking_condition($user_type,$user_id, $condition);	
		 }else{
  			$data['hotel_data'] = $this->reports_model->hotel_booking($user_type,$user_id);	
		 }

		$data['page_title'] = 'B2B Hotel Booking Reports';
		$this->load->view('reports/b2b_hotel_report', $data);
	}
	public function car_b2c_reports($user_type=B2C_USER,$user_id=0){
		$data= array();	
		if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		}	
		$filter_data = $this->format_basic_search_filters_book();
         $data['from_date'] = $filter_data['from_date'];
		 $data['to_date'] = $filter_data['to_date'];
		 $condition = $filter_data['filter_condition'];

		 if(valid_array($this->input->get()) == true) {
  			$data['car_data'] = $this->reports_model->car_booking_condition($user_type,$user_id, $condition);	
		 }else{
  			$data['car_data'] = $this->reports_model->car_booking($user_type,$user_id);	
		 }	
		$data['page_title'] = 'B2C Car Booking Reports';	
		
		$this->load->view('reports/b2c_car_report', $data);
	}
	public function car_b2b_reports($user_type=B2B_USER,$user_id=0){
		$data= array();	
		if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		}
		$filter_data = $this->format_basic_search_filters_book();
         $data['from_date'] = $filter_data['from_date'];
		 $data['to_date'] = $filter_data['to_date'];
		 $condition = $filter_data['filter_condition'];

		 if(valid_array($this->input->get()) == true) {
  			$data['car_data'] = $this->reports_model->car_booking_condition($user_type,$user_id, $condition);	
		 }else{
  			$data['car_data'] = $this->reports_model->car_booking($user_type,$user_id);	
		 }

		// $data['car_data'] = $this->reports_model->car_booking($user_type,$user_id);		
		$data['page_title'] = 'B2B Car Booking Reports';	
		
		$this->load->view('reports/b2b_car_report', $data);
	}
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
	public function activity_b2c_reports($user_type=B2C_USER,$user_id=0){
		$data= array();		
		$data['activity_data'] = $this->reports_model->activity_booking($user_type,$user_id);		
		$data['page_title'] = 'B2C Activity Booking Reports';	
		
		$this->load->view('reports/b2c_activity_report', $data);
	}

	public function activity_b2b_reports($user_type=B2B_USER,$user_id=0){
		$data= array();		
		$data['activity_data'] = $this->reports_model->activity_booking($user_type,$user_id);		
		$data['page_title'] = 'B2B Activity Booking Reports';	
		
		$this->load->view('reports/b2b_activity_report', $data);
	}

	public function transfer_b2c_reports($user_type=B2C_USER,$user_id=0){
		$data= array();		
		$data['activity_data'] = $this->reports_model->transfer_booking($user_type,$user_id);		
		$data['page_title'] = 'B2C Transfer Booking Reports';	
		
		$this->load->view('reports/b2c_transfer_report', $data);
	}
	public function transfer_b2b_reports($user_type=B2B_USER,$user_id=0){
		$data= array();		
		$data['activity_data'] = $this->reports_model->transfer_booking($user_type,$user_id);		
		$data['page_title'] = 'B2B Transfer Booking Reports';	
		
		$this->load->view('reports/b2b_transfer_report', $data);
	}

	public function bundle_b2c_reports($user_type=B2C_USER,$user_id=0){
		$data= array();		
		$bundle_data= $this->reports_model->bundle_booking($user_type,$user_id);
			
		$data['bundle_data'] = $bundle_data;
		$data['page_title'] = 'B2C Bundle Booking Reports';			
		$this->load->view('reports/b2c_bundle_report', $data);
	}

	public function bundle_b2b_reports($user_type=B2B_USER,$user_id=0){
		$data= array();		
		$bundle_data= $this->reports_model->bundle_booking($user_type,$user_id);
		
		$data['bundle_data'] = $bundle_data;
		$data['page_title'] = 'B2B Bundle Booking Reports';			
		$this->load->view('reports/b2b_bundle_report', $data);
	}


	public function bundle_view_voucher($pnr,$module,$con_pnr_no){
		$Pnr = base64_decode($pnr);
		$con_pnr_no =base64_decode($con_pnr_no);
		$product_id = FLIGHT_MARKUP;
    	if($module=='HOTEL'){
    		$product_id = HOTEL_MARKUP;
    	}elseif ($module=='FLIGHT') {
    		$product_id = FLIGHT_MARKUP;
    	}elseif ($module=='CAR') {
    		$product_id = CAR_MARKUP;
    	}
    	
    	$count = $this->reports_model->bundle_getBookingPnr($Pnr,$product_id,$con_pnr_no)->num_rows();
    	
    	
    	if($count==1){
    		$b_data = $this->reports_model->bundle_getBookingPnr($Pnr,$product_id,$con_pnr_no)->row();

		 	$admin_details = $this->reports_model->get_admin_details();
         	$data['admin_details'] = $admin_details;
     		if($b_data->product_name == 'FLIGHT'){
				  				
		         $data['b_data'] = $this->reports_model->bundle_getBookingPnr($Pnr,$product_id,$con_pnr_no)->row();

		         $booking_global_id=$data['b_data']->booking_global_id;
		          $billing_address_id=$data['b_data']->billing_address_id;

		         $data['Passenger'] = $passenger = $this->reports_model->getPassengerbyid($booking_global_id)->result();

		         $data['booking_agent'] = $passenger = $this->reports_model->getagentbyid($billing_address_id)->result();				 
		         $this->load->view('voucher/flight_voucher', $data);	 

				
			
            }elseif ($b_data->product_name == 'HOTEL') {
            	$data['Booking'] = $booking = $this->reports_model->getBookingbyPnr($b_data->pnr_no,$b_data->product_name,$b_data->con_pnr_no)->row();
				$data['Passenger'] = $passenger = $this->reports_model->getPassengerbyPnr($booking->booking_global_id)->result();
				$data['cart']	= $cart = $this->reports_model->getBookingTemphotel($booking->shopping_cart_hotel_id);

				$this->load->view('voucher/hotel_voucher', $data);	
			 

            }elseif ($b_data->product_name == 'CAR') {
            	  $data['Booking'] = $this->reports_model->bundle_getBookingPnr($Pnr,$product_id,$con_pnr_no)->row();

		         $booking_global_id=$data['Booking']->booking_global_id;
		          $billing_address_id=$data['Booking']->billing_address_id;

		         $data['Passenger'] = $passenger = $this->reports_model->getPassengerbyid($booking_global_id)->result();
		         $data['booking_agent'] = $passenger = $this->reports_model->getagentbyid($billing_address_id)->result();
				
	              $this->load->view('voucher/car_voucher', $data);

            }
    	}
	}
	public function view_voucher($Pnr='',$con_pnr_no){
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
		          
				//$this->load->view('voucher/flight_mail_voucher', $data);	 
		         $this->load->view('voucher/flight_voucher', $data);	 

				//$this->load->view('voucher/flight_voucher', $data);	 
			
            }elseif ($b_data->product_name == 'HOTEL') {
            	$data['Booking'] = $booking = $this->reports_model->getBookingbyPnr($b_data->pnr_no,$b_data->product_name,$b_data->con_pnr_no)->row();
				$data['Passenger'] = $passenger = $this->reports_model->getPassengerbyPnr($booking->booking_global_id)->result();
				$data['cart']	= $cart = $this->reports_model->getBookingTemphotel($booking->shopping_cart_hotel_id);
				
				$this->load->view('voucher/hotel_voucher', $data);	 

				//$this->load->view('voucher/hotel_mail_voucher', $data);	 

            }	elseif ($b_data->product_name == 'CAR') {
            	  $data['Booking'] = $this->reports_model->getBookingPnr($Pnr,$con_pnr_no)->row();

		         $booking_global_id=$data['Booking']->booking_global_id;
		          $billing_address_id=$data['Booking']->billing_address_id;

		         $data['Passenger'] = $passenger = $this->reports_model->getPassengerbyid($booking_global_id)->result();
		         $data['booking_agent'] = $passenger = $this->reports_model->getagentbyid($billing_address_id)->result();
					$booking_transaction_id = $data['Booking']->booking_transaction_id;
		          $data['booking_transaction'] = $this->reports_model->getbookingTransaction($booking_transaction_id)->result();
	              $this->load->view('voucher/car_voucher', $data);

            }elseif ($b_data->product_name == 'ACTIVITY') {

            		$data['Booking'] = $booking = $this->reports_model->getBookingbyPnr($b_data->pnr_no,$b_data->product_name,$b_data->con_pnr_no)->row();

					$data['Passenger'] = $passenger = $this->reports_model->getPassengerbyPnr($booking->booking_global_id)->result_array();

					$data['cart']	= $cart = $this->reports_model->getBookingTemp_SIGHTSEEING($booking->referal_id);

					$data['pnr_nos'] = $this->reports_model->getBookingByParentPnr($data['Booking']->parent_pnr_no)->result();
					$global_ids = $this->reports_model->validate_order_id_org($data['Booking']->parent_pnr_no)->result();
					$data['cart'] = $this->db->get_where('booking_activity', array('booking_sightseeing_id' => $global_ids[0]->referal_id))->row();
			
					$this->load->view('voucher/transfer_act_voucher',$data);
            }elseif ($b_data->product_name == 'TRANSFER') {
            		$data['Booking'] = $booking = $this->reports_model->getBookingbyPnr($b_data->pnr_no,$b_data->product_name,$b_data->con_pnr_no)->row();

					$data['Passenger'] = $passenger = $this->reports_model->getPassengerbyPnr($booking->booking_global_id)->result_array();

					$data['cart']	= $cart = $this->reports_model->getBookingTemp_transfer($booking->referal_id);
					
					$data['pnr_nos'] = $this->reports_model->getBookingByParentPnr($data['Booking']->parent_pnr_no)->result();
					$global_ids = $this->reports_model->validate_order_id_org($data['Booking']->parent_pnr_no)->result();
					$data['cart'] = $this->db->get_where('booking_transfer', array('booking_transfer_id' => $global_ids[0]->referal_id))->row();
					

					$this->load->view('voucher/transfer_act_voucher',$data);
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
                $email_type = 'Vietnet-Flight Voucher-'.$pnr_no;
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
            
            else if($b_data->product_name == 'HOTEL'){
           
	           $data['b_data'] = $this->reports_model->getBookingPnr($pnr_no,$con_pnr_no)->row();     
	           $booking_global_id=$b_data->booking_global_id;
	           $billing_address_id=$b_data->billing_address_id;
             
                 $data['Booking'] = $booking = $this->reports_model->getBookingbyPnr($b_data->pnr_no,$b_data->product_name,$b_data->con_pnr_no)->row();
				$data['Passenger'] = $passenger = $this->reports_model->getPassengerbyPnr($booking->booking_global_id)->result();
				$data['cart']	= $cart = $this->reports_model->getBookingTemphotel($booking->shopping_cart_hotel_id);

                 $data['message'] = $this->load->view('voucher/hotel_mail_voucher',$data,TRUE);   
                          
                $data['to'] =$email;               
                $data['booking_status'] = $b_data->booking_status;
                $data['pnr_no'] = $pnr_no;
                
                $email_type = 'Vietnet - Hotel Voucher - '.$pnr_no;
                
                $Response = $this->provab_mailer->send_mail($email,$email_type,$data['message']);  
                if($Response['status']==true){
                	$response = array('status'=>1);
                }else{
                	$response = array('status'=>0);
                }             
                
                
            }
            elseif ($b_data->product_name =='ACTIVITY') {

            	
            	  $data['b_data'] =  $this->reports_model->getBookingPnr($pnr_no,$con_pnr_no)->row();  
        	   	$data['Booking'] =$this->reports_model->getBookingbyPnr($pnr_no,$b_data->product_name,$b_data->con_pnr_no)->row();
	           $booking_global_id=$b_data->booking_global_id;
	           $billing_address_id=$b_data->billing_address_id;

                 $data['Passenger'] = $passenger = $this->reports_model->getPassengerbyid($booking_global_id)->result_array();
                 $data['booking_agent'] = $passenger = $this->reports_model->getagentbyid($billing_address_id)->result();
                 
                 $data['booking_info'] = $bookinginfo = $this->reports_model->getBookingbyPnr($pnr_no,$b_data->product_name)->row();
                 $data['cart']	= $cart = $this->reports_model->getBookingTemp_SIGHTSEEING($bookinginfo->referal_id);

				$data['pnr_nos'] = $this->reports_model->getBookingByParentPnr($data['Booking']->parent_pnr_no)->result();
				$global_ids = $this->reports_model->validate_order_id_org($data['Booking']->parent_pnr_no)->result();
				$data['cart'] = $this->db->get_where('booking_activity', array('booking_sightseeing_id' => $global_ids[0]->referal_id))->row();
                 $data['mail_voucher'] = true;
                 $data['message'] = $this->load->view('voucher/transfer_act_voucher', $data,TRUE);

                $data['to'] = $email;               
                $data['booking_status'] = $b_data->booking_status;
                $data['pnr_no'] = $pnr_no;                
                $email_type = 'Vietnet-Activity Voucher-'.$pnr_no;
                
                $Response = $this->provab_mailer->send_mail($email,$email_type,$data['message']);  
               
                if($Response['status']==true){
                	$response = array('status'=>1);
                }else{
                	$response = array('status'=>0);
                }  
            }else if($b_data->product_name =='TRANSFER'){
            	
            	  $data['b_data'] =  $this->reports_model->getBookingPnr($pnr_no,$con_pnr_no)->row();  
        	   	$data['Booking'] =$this->reports_model->getBookingbyPnr($pnr_no,$b_data->product_name,$b_data->con_pnr_no)->row();
	           $booking_global_id=$b_data->booking_global_id;
	           $billing_address_id=$b_data->billing_address_id;

                 $data['Passenger'] = $passenger = $this->reports_model->getPassengerbyid($booking_global_id)->result_array();
                 $data['booking_agent'] = $passenger = $this->reports_model->getagentbyid($billing_address_id)->result();
                 
                 $data['booking_info'] = $bookinginfo = $this->reports_model->getBookingbyPnr($pnr_no,$b_data->product_name,$b_data->con_pnr_no)->row();
                 $data['cart']	= $cart = $this->reports_model->getBookingTemp_transfer($bookinginfo->referal_id);

				$data['pnr_nos'] = $this->reports_model->getBookingByParentPnr($data['Booking']->parent_pnr_no)->result();
				$global_ids = $this->reports_model->validate_order_id_org($data['Booking']->parent_pnr_no)->result();
				$data['cart'] = $this->db->get_where('booking_transfer', array('booking_transfer_id' => $global_ids[0]->referal_id))->row();
                 $data['mail_voucher'] = true;
                 $data['message'] = $this->load->view('voucher/transfer_act_voucher', $data,TRUE);
                $data['to'] = $data['booking_agent'][0]->billing_email;               
                $data['booking_status'] = $b_data->booking_status;
                $data['pnr_no'] = $pnr_no;
              
                $email_type = 'Vietnet-Transfer Voucher-'.$pnr_no;
                $Response = $this->provab_mailer->send_mail($email,$email_type,$data['message']);  
                if($Response['status']==true){
                	$response = array('status'=>1);
                }else{
                	$response = array('status'=>0);
                }  
            }
            elseif ($b_data->product_name =='CAR') {
            	 $data['Booking']= $data['b_data']= $this->reports_model->getBookingPnr($pnr_no,$con_pnr_no)->row();

		         $booking_global_id=$data['Booking']->booking_global_id;
		          $billing_address_id=$data['Booking']->billing_address_id;

		         $data['Passenger'] = $passenger = $this->reports_model->getPassengerbyid($booking_global_id)->result();
		         $data['booking_agent'] = $passenger = $this->reports_model->getagentbyid($billing_address_id)->result();
		          $data['mail_voucher'] = true;
		          $data['message'] =  $this->load->view('voucher/car_voucher', $data,TRUE);
		      	  $booking_transaction_id = $data['Booking']->booking_transaction_id;
		          $data['booking_transaction'] = $this->reports_model->getbookingTransaction($booking_transaction_id)->result();

		         	$data['to'] = $email;               
	                $data['booking_status'] = $b_data->booking_status;
	                $data['pnr_no'] = $pnr_no;	               
	                 $email_type = 'Vietnet-Car Voucher-'.$pnr_no;
	                $data['mail_from'] = 'Car';
                 	$Response = $this->provab_mailer->send_mail($email,$email_type,$data['message']);  
	                if($Response['status']==true){
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
     public function BundleCancelPnr(){
    	
    	if($_POST){

    		$booked_pnr  = base64_decode(base64_decode($_POST['pnr_no']));  
	       $b_data = $this->reports_model->getBookingPnr($booked_pnr)->result_array(); 
	      $status = 2;
	      $car_module = 0;
	      $flight_module = 0;
	      $hotel_module = 0;

	      foreach ($b_data as $key => $value) {
	        	
	        	if(($value['booking_status']=='CONFIRMED' || $value['booking_status'] =='CANCEL_HOLD')&& $value['pnr_no']!=''){
	        		
	        		if($value['product_name'] == 'FLIGHT'){
			       		$this->load->helper('flight/flight_amedus_helper');
			       		$flight_module =1;
			       		$car_module =0;
			       		$hotel_module = 0;
					}	
					elseif ($value['product_name']=='HOTEL') {
			       		$this->load->helper('hotel/hotel_amedus_helper');
			       		$hotel_module =1;
			       		$flight_module = 0;
			       		$car_module = 0;
			       	}elseif ($value['product_name']=='CAR') {	
			       		$this->load->helper('car/car_amedus_helper');
			       		$car_module  =1;
			       		$flight_module = 0;
			       		$hotel_module = 0;

			       	}
			       	$pnr = $value['pnr_no'];
			       	if($flight_module){
			       		$PNRRetrieve = Flight_PNR_Retrieve($pnr);	
			       	}elseif($hotel_module){
			       		$PNRRetrieve = Hotel_PNR_Retrieve($pnr);
			       	}elseif ($car_module) {
			       		$PNRRetrieve = Car_PNR_Retrieve($pnr);
			       	}
			       	
					$PNRRetrieveResponse = $PNRRetrieve ['PNR_RetrieveRes'];
					$RetrieveStatus = $this->xml2array ( $PNRRetrieveResponse, $get_attributes = 1, $priority = 'tag' );
					$SecuritySession = $RetrieveStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SessionId'];
					$seq = $SequenceNumber = $RetrieveStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SequenceNumber'];
					$SecurityToken = $RetrieveStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SecurityToken'];

					if($flight_module){
						$PNRCancel = Flight_PNR_Cancel($SecuritySession, $seq, $SecurityToken);
					}elseif($hotel_module){
						$PNRCancel = Hotel_PNR_Cancel($SecuritySession, $seq, $SecurityToken);
					}elseif ($car_module) {
						$PNRCancel = Car_PNR_Cancel($SecuritySession, $seq, $SecurityToken);
					}
					
				    $PNRCancelResponse = $PNRCancel['PNR_CancelRes'];
				    $CancleStatus = $this->xml2array ( $PNRCancelResponse, $get_attributes = 1, $priority = 'tag' );
					#debug($CancleStatus);

					$SecuritySessionCancle = $CancleStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SessionId'];
					$seqCancle = $SequenceNumber = $CancleStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SequenceNumber'];
					$SecurityTokenCancle = $CancleStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SecurityToken'];

					$status_details = $CancleStatus ['soapenv:Envelope'] ['soapenv:Body'] ['PNR_Reply'] ['technicalData'] ['generalPNRInformation'] ['statusDetails'] ['isPNRModifDuringTrans'] ;

					if($flight_module){
						$pnrAddMultiElements = Flight_PNR_AddMultiElements_option10('','',$SecuritySessionCancle,$seqCancle,$SecurityTokenCancle);
					}elseif ($hotel_module) {
						$pnrAddMultiElements = Hotel_PNR_AddMultiElements_option10('','',$SecuritySessionCancle,$seqCancle,$SecurityTokenCancle);
					}elseif ($car_module) {
						$pnrAddMultiElements = Car_PNR_AddMultiElements_option10('','',$SecuritySessionCancle,$seqCancle,$SecurityTokenCancle);
					}
			

					$pnrAddMultiElementsRes = $pnrAddMultiElements['PNR_AddMultiElements_option10Res'];
					$pnrAddMultiElementsStatus = $this->xml2array ( $pnrAddMultiElementsRes, $get_attributes = 1, $priority = 'tag' );

					$SecuritySessionpnradd = $pnrAddMultiElementsStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SessionId'];
					$seqpnradd = $SequenceNumber = $pnrAddMultiElementsStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SequenceNumber'];
					$SecurityTokenpnradd = $pnrAddMultiElementsStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SecurityToken'];

					if(isset($pnrAddMultiElementsStatus['soapenv:Envelope']['soapenv:Body']['PNR_Reply'])){
						$cancel_pnr_no = $pnrAddMultiElementsStatus['soapenv:Envelope']['soapenv:Body']['PNR_Reply']['pnrHeader']['reservationInfo']['reservation']['controlNumber'];
						

						if(strtolower($cancel_pnr_no)==strtolower($pnr)){
							$booking_status = "CANCELED";
							$this->db->set('booking_status', $booking_status);
							$this->db->where('booking_global_id', $value['booking_global_id']);
							$this->db->update('booking_global');
							$status = 1;

						}

					}else{
						$data['message'] = 'Cancellation Not Success';
					}			
					if($flight_module){
						Flight_Security_SignOut($SecuritySessionpnradd,$seqpnradd,$SecurityTokenpnradd);	
					}elseif ($hotel_module) {
						Hotel_Security_SignOut($SecuritySessionpnradd,$seqpnradd,$SecurityTokenpnradd);
					}elseif ($car_module) {
						Car_Security_SignOut($SecuritySessionpnradd,$seqpnradd,$SecurityTokenpnradd);
					}
					

	        	}else{
	        		$data['message'] = 'Booking Already Cancelled';
	        	}
	        	echo "status".$status.'<br/>';
	        } 

	       /*send email to customer*/
	       echo $status;
		   exit;

    	}
    }
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
    public function CancelPnr(){
    		
    	
    	if($_POST){
    		
    		$pnr  = base64_decode($_POST['PNR_NO']); 
    		$con_pnr_no = base64_decode($_POST['CON_PNR_NO']) ;

	       $b_data = $this->reports_model->getBookingPnr($pnr,$con_pnr_no)->row();     
           $booking_global_id=$b_data->booking_global_id;
           $billing_address_id=$b_data->billing_address_id;
	       
	        $booking_agent = $passenger = $this->reports_model->getagentbyid($billing_address_id)->result();
	       $to_email = $booking_agent[0]->billing_email;
	       $status = false;
	       	if($b_data->product_name == 'FLIGHT'){
	       		$this->load->helper('flight/flight_amedus_helper');
			}	
			elseif ($b_data->product_name=='HOTEL') {
	       		$this->load->helper('hotel/hotel_amedus_helper');
	       	}elseif ($b_data->product_name=='CAR') {
	       		$this->load->helper('car/car_amedus_helper');

	       	}
	       	if($b_data->booking_status=='CONFIRMED' || $b_data->booking_status=='CANCEL_HOLD'){

       		 	if($b_data->product_name == 'FLIGHT'){

	       			$PNRRetrieve = Flight_PNR_Retrieve($pnr);
	       		}elseif ($b_data->product_name=='HOTEL') {
	       			$PNRRetrieve = Hotel_PNR_Retrieve($pnr);
	       		}elseif ($b_data->product_name=='CAR') {
	       			$PNRRetrieve = Car_PNR_Retrieve($pnr);
	       		}

				$PNRRetrieveResponse = $PNRRetrieve ['PNR_RetrieveRes'];
				$RetrieveStatus = $this->xml2array ( $PNRRetrieveResponse, $get_attributes = 1, $priority = 'tag' );
				$SecuritySession = $RetrieveStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SessionId'];
				$seq = $SequenceNumber = $RetrieveStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SequenceNumber'];
				$SecurityToken = $RetrieveStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SecurityToken'];
				if($b_data->product_name == 'FLIGHT'){
					$PNRCancel = Flight_PNR_Cancel($SecuritySession, $seq, $SecurityToken);
				}elseif ($b_data->product_name=='HOTEL') {
					$PNRCancel = Hotel_PNR_Cancel($SecuritySession, $seq, $SecurityToken);
				}elseif ($b_data->product_name=='CAR') {
					$PNRCancel = Car_PNR_Cancel($SecuritySession, $seq, $SecurityToken);
				}
				
			    $PNRCancelResponse = $PNRCancel['PNR_CancelRes'];
			    $CancleStatus = $this->xml2array ( $PNRCancelResponse, $get_attributes = 1, $priority = 'tag' );
				#debug($CancleStatus);

				$SecuritySessionCancle = $CancleStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SessionId'];
				$seqCancle = $SequenceNumber = $CancleStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SequenceNumber'];
				$SecurityTokenCancle = $CancleStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SecurityToken'];

				$status_details = $CancleStatus ['soapenv:Envelope'] ['soapenv:Body'] ['PNR_Reply'] ['technicalData'] ['generalPNRInformation'] ['statusDetails'] ['isPNRModifDuringTrans'] ;
				if($b_data->product_name == 'FLIGHT'){
					$pnrAddMultiElements = Flight_PNR_AddMultiElements_option10('','',$SecuritySessionCancle,$seqCancle,$SecurityTokenCancle);
				}elseif ($b_data->product_name=='HOTEL') {
					$pnrAddMultiElements = Hotel_PNR_AddMultiElements_option10('','',$SecuritySessionCancle,$seqCancle,$SecurityTokenCancle);
				}elseif ($b_data->product_name=='CAR') {
					$pnrAddMultiElements = Car_PNR_AddMultiElements_option10('','',$SecuritySessionCancle,$seqCancle,$SecurityTokenCancle);
				}
				$pnrAddMultiElementsRes = $pnrAddMultiElements['PNR_AddMultiElements_option10Res'];
				$pnrAddMultiElementsStatus = $this->xml2array ( $pnrAddMultiElementsRes, $get_attributes = 1, $priority = 'tag' );

				$SecuritySessionpnradd = $pnrAddMultiElementsStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SessionId'];
				$seqpnradd = $SequenceNumber = $pnrAddMultiElementsStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SequenceNumber'];
				$SecurityTokenpnradd = $pnrAddMultiElementsStatus ['soapenv:Envelope'] ['soapenv:Header'] ['awsse:Session'] ['awsse:SecurityToken'];
				$this->load->model('xml_model');
				if(isset($pnrAddMultiElementsStatus['soapenv:Envelope']['soapenv:Body']['PNR_Reply'])){
					$cancel_pnr_no = $pnrAddMultiElementsStatus['soapenv:Envelope']['soapenv:Body']['PNR_Reply']['pnrHeader']['reservationInfo']['reservation']['controlNumber'];
					

					if(strtolower($cancel_pnr_no)==strtolower($pnr)){
						$booking_status = "CANCELED";
						$this->db->set('booking_status', $booking_status);
						$this->db->where('pnr_no', $pnr);
						$this->db->update('booking_global');
						$status = true;

					}
					$xml_log = array(
							 	'api_name' => 'AMADEUS',
							 	'XML_Type' =>$b_data->product_name.'CANCEL',
							 	'XML_Request' => $pnrAddMultiElements['PNR_AddMultiElements_option10Req'],
							 	'XML_Response' => $pnrAddMultiElements['PNR_AddMultiElements_option10Res'],
							 	'Ip_address' => $_SERVER['REMOTE_ADDR'],
							       'xml_status' =>'ERROR',
							      'product_name' =>ucfirst(strtolower($b_data->product_name)),
							 	'xml_timestamp' => date('Y-m-d H:i:s')
								  ); 
				    $this->Xml_Model->insert_xml_log($xml_log); 
				}else{

						
						$xml_log = array(
							 	'api_name' => 'AMADEUS',
							 	'XML_Type' =>$b_data->product_name.'CANCEL',
							 	'XML_Request' => $pnrAddMultiElements['PNR_AddMultiElements_option10Req'],
							 	'XML_Response' => $pnrAddMultiElements['PNR_AddMultiElements_option10Res'],
							 	'Ip_address' => $_SERVER['REMOTE_ADDR'],
							       'xml_status' =>'ERROR',
							      'product_name' =>ucfirst(strtolower($b_data->product_name)),
							 	'xml_timestamp' => date('Y-m-d H:i:s')
								  ); 
					    $this->Xml_Model->insert_xml_log($xml_log); 

					$data['message'] = 'Cancellation Not Success';
				}			
				if($b_data->product_name == 'FLIGHT'){
					Flight_Security_SignOut($SecuritySessionpnradd,$seqpnradd,$SecurityTokenpnradd);
				}elseif ($b_data->product_name=='HOTEL') {
					Hotel_Security_SignOut($SecuritySessionpnradd,$seqpnradd,$SecurityTokenpnradd);
				}elseif ($b_data->product_name=='CAR') {
					Car_Security_SignOut($SecuritySessionpnradd,$seqpnradd,$SecurityTokenpnradd);
				}
	       	}else{
	       		$data['message'] = 'Booking Already Cancelled';
	       	}
	       /*send email to customer*/
	       echo $status;
		   exit;

    	}
    }
    public function transfer_activity_cancel(){
    	
    	if($_POST){


    		$pnr_no = base64_decode($_POST['PNR_NO']);
    		
	       	$b_data = $this->reports_model->getBookingPnr($pnr_no)->result_array();
	       	$b_data = $this->reports_model->getBookingPnr($pnr_no)->row();  
	       
            if($b_data){
            	if($b_data->product_name=='ACTIVITY'){
            		$this->load->helper('sightseeing/sightseeing_helper');	
            	}elseif ($b_data->product_name=='TRANSFER') {
            		$this->load->helper('transfer/transfer_helper');	
            	}            	
                $app_reference  = $b_data->con_pnr_no;
                $booking_pnr_no = $b_data->pnr_no;
                $sightseeing_request['AppReference'] = $app_reference;
                $sightseeing_request['CancelCode'] = "00";
                $sightseeing_request['CancelDescription']='Testing';
                $xml_response = viator_cancel_booking_request_params($app_reference,"00","Testing");
               
                if($xml_response['Status']==true){
                    if($xml_response['CancelBooking']['CancellationDetails']){
                        $update_booking = array(
                                    'booking_status'            => 'CANCELED',
                                    'cancellation_status'       => 'SUCCESS',
                                    'cancel_request'            => json_encode($sightseeing_request),
                                    'cancel_response'           => json_encode($xml_response)
                                );
                    

                        if(strtolower($pnr_no)==strtolower($booking_pnr_no)){
							 $this->db->where('pnr_no', $pnr_no);
       						 $this->db->update('booking_global', $update_booking); 

						}
                        $data['response'] ='Your Cancellation  Request Done';
                        $data['status'] ='1';

                    }
                }else{
                     $data['response'] ='Booking not cancelled from API';
                     $data['status'] ='0';
                }
            }else{
                $data['response'] ='Unable to Process your Request';
                $data['status'] ='0';
            }
    	}else{
    		$data['response'] ='PNR number is missing';
            $data['status'] ='0';
    	}
    	echo json_encode($data);
        exit;
    }
    
    /*new added function */
    public function get_change_request()
    {
    	// error_reporting(E_ALL);
    	$data['reports_data'] = $this->reports_model->getChangeRequest();
    	// echo"<pre/>";print_r($reports_data);exit;
    	$this->load->view('change_request/view',$data);
    }
    /*end*/

}

?>
