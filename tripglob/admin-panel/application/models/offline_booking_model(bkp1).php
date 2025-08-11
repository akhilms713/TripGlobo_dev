<?php
class Offline_Booking_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function insert_offline_data($page_data){
    	//echo "<pre>";print_r($page_data);exit;
    	//echo "dgfdgf";exit;
    	//echo $page_data['booking_status'];
    	
		
		$pnr_no = count($page_data['pnr']);

		if($pnr_no > 0)
		{
			

			for($i=0;$i<$pnr_no;$i++)
			{

				$dd_org = $page_data["arrival_date"][$i];
				$dd = date('Y-m-d', strtotime($dd_org));echo $dd;
				$at = $page_data["arriaval_time"][$i];echo $at;
				
				$dept_date = $dd . " " . $at;
				
				$sqldt_date = date_create_from_format( "j/n/Y G:i:s", $dept_date ); // 
				echo "$sqldt_date";
				$dt_org = $page_data["dept_date"][$i];
				$dt = date('Y-m-d', strtotime($dt_org));//echo $dt;
				//$dt = $page_data["dept_time"][$i];

				$at = $page_data["dept_time"][$i];

				$dept_time = $dt . " " . $at; 
				
				$dt_time = date_create_from_format( "j/n/Y G:i:s", $dept_time ); // convert from string to PHP DateTime

				$sqldt_time = Date( "Y-n-j G:i:s", $dept_time ); // convert from DateTime to MySQL format!

				//echo $sqldt_time;
				//echo $sqldt_date;

				$data_iterity[$i]['app_reference'] = 'FR0000000HH6';
				$data_iterity[$i]['airline_pnr'] = $page_data['pnr'][$i];
				$data_iterity[$i]['airline_code'] = $page_data['career_code'][$i];
				$data_iterity[$i]['flight_number'] = $page_data['flight_no'][$i];
				$data_iterity[$i]['fare_class'] = $page_data['booking_class'][$i];
				$data_iterity[$i]['from_airport_code'] = $page_data['dept_airport_code'][$i];
				$data_iterity[$i]['to_airport_code'] = $page_data['arrival_airport_code'][$i];
				$data_iterity[$i]['departure_datetime'] = $dept_date;
				$data_iterity[$i]['arrival_datetime'] = $dept_time;

				// $data_iterity = array(
				// 	'app_reference' =>"FR0000000HH6",
				// 	//'segment_indicator' => $last_id,
				// 	'airline_pnr'=>$page_data['pnr'][$i],
				// 	'airline_code' =>$page_data['career_code'][$i],
				// 	//'airline_name' => $page_data['adult_fname'][$i],
				// 	'flight_number' => $page_data['flight_no'][$i],
				// 	'fare_class' =>$page_data['booking_class'][$i],
				// 	'from_airport_code' =>$page_data['dept_airport_code'][$i],
				// 	'to_airport_code' =>$page_data['arrival_airport_code'][$i],
				// 	'departure_datetime' =>$dept_date,
				// 	'arrival_datetime' =>$dept_time
				// 	);
				$data_iterity_data = json_encode($data_iterity);
				// $this->db->insert('flight_booking_itinerary_details',$data_iterity);
			}
		}
		//echo "34345<pre>";print_r($data_iterity_data);exit;
		$dept_date =  date('Y-m-d' , strtotime($page_data['dept_date']));
    	$arriv_date = date('Y-m-d' , strtotime($page_data['arrival_date']));
    	//echo $page_data['adult_fname'][0];
    	//echo $dept_date;echo $arriv_date;
    	$app_reference = "TRGL".rand(100000,999999);
    	$booking_transaction_id = sha1(md5(time()));
    	$app_reference = "TRGL".$booking_transaction_id;
    	$child_count = count($arriv_date['child_fname']);
    	//echo $child_count;
		//echo "<pre>";print_r($page_data);exit;
		$data = array(
			'status'  =>$page_data['booking_status'],
			'app_reference' =>$app_reference,
			'booking_source' => strtoupper($page_data['paass_contact']),
			'trip_type' =>$page_data['trip_type'],
			'phone' =>$page_data['passenger_mobile'],
			'email' =>$page_data['pass_email'],
			'flight_iterity_data'	=> $data_iterity_data,
			'fname'=>$page_data['passenger_first_name'], 
			'lname'=>$page_data['passenger_last_name'],
			//'from_loc' => $page_data['dept_airport_code'],
			//'to_loc' =>$page_data['arrival_airport_code'],

			//'pnr'  =>  $page_data['pnr'],
			'journey_start' =>$dept_date,
			'journey_end' =>$arriv_date,
			'payment_mode' =>"OFFLINE",
			'attributes' =>$page_data['passenger_address'],
			'total_base_fare'=>$page_data['total_base_fare'],
			'admin_markup' =>$page_data['admin_markup'],
			'tds' => $page_data['tds'],
			'commision' =>$page_data['basic_comm'],
			'customer_paid_amount' =>$page_data['agent_buying_price'],
			'booking_transaction_id' => $booking_transaction_id,
			'created_datetime' => date('Y-m-d H:i:s')


			);
		$data = $this->db->insert('flight_booking_details',$data);//$this->db->
		
		$last_id = $this->db->insert_id();// echo $last_id;exit;
		$adult_count = count($page_data['adult_fname']);
		$pnr_no = count($page_data['pnr']);
		


		if($adult_count > 0)
		{

			for($i=0;$i<$adult_count;$i++)
			{
				$data_adult = array(
					'booking_global_id'=>$last_id,
					'passenger_type' =>"Adult",
					'first_name' => $page_data['adult_fname'][$i],
					'last_name' => $page_data['adult_lname'][$i],
					'passport_number' =>$page_data['adult_pass_no'][$i],
					'flyer_number' =>$page_data['freq_fly_no'][$i],
					'passport_date_of_expiry' =>$page_data['adult_pexpire'][$i],
					'adult_count' =>$page_data['adult_id']
					);
				$this->db->insert('booking_passenger_details',$data_adult);
			}
		}
		$child_count = count($page_data['child_fname']);
		if($child_count > 0)
		{

			for($i=0;$i<$child_count;$i++)
			{
				$data_child = array(
					'booking_global_id'=>$last_id,
					'passenger_type' =>"Child",
					'first_name' => $page_data['child_fname'][$i],
					'last_name' => $page_data['child_lname'][$i],
					'passport_number' =>$page_data['child_pass_no'][$i],
					'flyer_number' =>$page_data['child_freq_fly_no'][$i],
					'passport_date_of_expiry' =>$page_data['child_pexpire'][$i],
					'clild_count' =>$page_data['clild_id']
					
					);
				$this->db->insert('booking_passenger_details',$data_child);
			}
		}
		if($page_data['infant_id']>0)
		{
			for($i=0;$i<$page_data['infant_id'];$i++)
			{
				$data_infant = array(
					'booking_global_id'=>$last_id,
					'passenger_type' =>"INFANT",
					'first_name' => $page_data['infant_fname'][$i],
					'last_name' => $page_data['infant_lname'][$i],
					'passport_number' =>$page_data['child_pass_no'][$i],
					'flyer_number' =>$page_data['infant_freq_fly_no'][$i],
					'passport_date_of_expiry' =>$page_data['infant_pexpire'][$i],
					'infant_count' =>$page_data['infant_id']
					
					);
				$this->db->insert('booking_passenger_details',$data_infant);
			}
		}
		
		//return $data;
		
	}
	function offline_flight_report($offset=0)
	{	error_reporting(0);
		$current_user_id = $GLOBALS['CI']->entity_user_id;
		$get_data = $this->input->get();
		$condition = array();
		$filter_data = $this->format_basic_search_filters();
		$page_data['from_date'] = $filter_data['from_date'];
		$page_data['to_date'] = $filter_data['to_date'];
		$condition = $filter_data['filter_condition'];

		$total_records = $this->flight_model->offline_flight_report($condition, true,0,100000000000);
		//echo '<pre>'; print_r($total_records); die;
		$table_data = $this->flight_model->offline_flight_report($condition, false, $offset, RECORDS_RANGE_2);

		if(!empty($table_data['data']['booking_details'])){
			$table_data = $this->booking_data_formatter->format_flight_booking_data($table_data, $this->current_module);
		}

		$page_data['table_data'] = $table_data['data'];
		
		$this->load->library('pagination');
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['base_url'] = base_url().'index.php/report/offline_flight_report/';
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		$page_data['total_rows'] = $config['total_rows'] = $total_records;
		$config['per_page'] = RECORDS_RANGE_2;
		$this->pagination->initialize($config);
		/** TABLE PAGINATION */
		$page_data['total_records'] = $config['total_rows'];
		$page_data['search_params'] = $get_data;
		$page_data['status_options'] = get_enum_list('booking_status_options');

		$user_cond = [];
		$user_cond [] = array('U.user_type','=',' (', ADMIN, ')');
		$user_cond [] = array('U.domain_list_fk' , '=' ,get_domain_auth_id());

		//$agent_info['data'] = $this->user_model->b2b_user_list($user_cond,false);

		$agent_info = $this->custom_db->single_table_records('user','*',array('user_type'=>ADMIN,'domain_list_fk'=>get_domain_auth_id()));

		$page_data['agent_details'] = magical_converter(array('k' => 'user_id', 'v' => 'agency_name'), $agent_info);		
		
		$this->template->view('report/offline_report_airline', $page_data);
	}

	function get_booking_data()
	{
		//echo "egedgr";exit;
		$this->db->select('flight_booking_details.status as status,flight_booking_details.app_reference as app_reference,flight_booking_details.*');
		//$this->db->select('flight_booking_details.status as status','*');
		$this->db->from('flight_booking_details');
		//$this->db->join('flight_booking_itinerary_details','flight_booking_itinerary_details.segment_indicator= flight_booking_details.origin','left');
		//$this->db->where('');
		$query = $this->db->get();//echo $this->db->last_query();exit;
		return $query->result();
	}

	function get_single_booking_data($id)
	{
		$this->db->select('flight_booking_details.status as bookingstatus,flight_booking_details.*');
		$this->db->from('flight_booking_details');
		//$this->db->join('flight_booking_itinerary_details','flight_booking_itinerary_details.segment_indicator = flight_booking_details.origin');
		$this->db->where('flight_booking_details.origin',$id);
		$query = $this->db->get();//echo $this->db->last_query();exit;
		return $query->result();
	}
	function getpassangerdetails($id)
	{
		//echo $id;exit;
		$this->db->select('*');
		$this->db->from('flight_booking_details');
		$this->db->join('booking_passenger_details','booking_passenger_details.booking_global_id=flight_booking_details.origin');
		$this->db->where('flight_booking_details.origin',$id);
		$query = $this->db->get();//$this->db->last_query();exit;
		return $query->result();
	}

	function flight_pdf($id){
		//echo $id;exit;
		$this->db->select('*');
		$this->db->from('flight_booking_details');
		$this->db->join('booking_passenger_details','booking_passenger_details.booking_global_id = flight_booking_details.origin');
		$this->db->where('flight_booking_details.origin',$id);
		$query = $this->db->get();
		return $query->result();
	}
	function get_email_acess() {
		$this->db->where('email_id','2');
       return $this->db->get('email_configuration');
    }

	function send_voucher($data) {
		//print_r($data);
		$data['email_access'] = $this->Offline_Booking_Model->get_email_acess()->row();

		//echo "<pre>";print_r($data['email_access']);exit;
		$config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $from = $data['email_access']->username;
        //echo $from;exit;
        //print_r($config);exit;
       
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($data['to']);
        //$this->email->cc(Email_cc);
        $this->email->subject("TRIPGLOBO - FLIGHT Voucher");
        $this->email->message($data['email_voucher']);
        if ($this->email->send()) {
        	echo "send successfully";
            return "send successfully !!!";
        }else{
        	echo "Unable to Send";
            return 0;
        }
    }

    function edit_booking($booking_id)
    {
    	$this->db->select('*');
    	$this->db->from('flight_booking_details');
    	$this->db->where('origin',$booking_id);
    	$query = $this->db->get();
    	return $query->result();
    }



	
}
?>
