<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Bus extends CI_Controller {
    private $current_module;


    public function __construct() {
    parent::__construct();
    $this->load->helper('bus/tbo');
    $this->load->helper('bus/date_helper');
    $this->load->model('bus_model');
    $this->load->model('Home_Model');
    $this->load->model('general_model');
    $this->load->library('encrypt');
    $this->load->library('session');
    $this->load->library('pagination');
    }
    function index() {   

    }
    function search($search_id='') {
        	if(!isset($_GET['from']) && !isset($_GET['to'])){ 
                redirect(WEB_URL.'home#buses','refresh');
            }

        // echo "string";

        $data =array();
        $data = $this->input->get();
        // debug($data);die;
        $insert_data['search_data'] = json_encode($data);
        $insert_data['search_type'] = 'BUS';
        $search_insert_data = $this->custom_db->insert_record('search_history',$insert_data);
        $data['search_id'] = $search_insert_data['insert_id'];
        $data['bus_search_params'] = $data;  
        $this->load->view(PROJECT_THEME.'/bus/search_result_page', $data);       
    }

    public function bus_list($search_id ='')

    {
        error_reporting(0);
        $search_params =array();
        $search_params = $this->input->get();
        $session_data_main= $data['session_data'] = $session_data = $this->generate_rand_no().date("mdHis");
        $authresponse = auth_tektravel();
                
        if ($authresponse['Status'] == true) {
            $raw_bus_list = get_bus_list(abs($search_params['search_id']),$authresponse);
            // debug($raw_bus_list);die;
        }        
        $from_id = @$raw_bus_list['data']['result']['Destination'];
        $to_id = @$raw_bus_list['data']['result']['Origin'];     
        $form_data = $this->bus_model->get_bus_station_data($search_data['from_station_id']);
        // debug($search_data);
        $to_data = $this->bus_model->get_bus_station_data($search_data['to_station_id']);
        // debug($to_data);exit;
        $search_data_city = array('from_id' => $form_data->station_id,
            'to_id' => $to_data->station_id);
        //exit;
        if ($raw_bus_list['status']) {            
            $config = array();
        $config['base_url'] =$_SERVER["HTTP_REFERER"];
        $config['total_rows'] =10000;
        $config['per_page'] = 10;
        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		$page = $this->input->get('page',0);

		$data['links'] = $this->pagination->create_links();
        // debug($this->session->userdata('user_type'));exit;
            $formatted_search_data = format_search_response($raw_bus_list, $search_params['search_id'], 'bus',$this->session->userdata('user_type'));
            // debug($formatted_search_data);exit;           
            $data['raw_bus_list'] = $formatted_search_data;
            $data['search_id'] = $search_params['search_id'];
            $data['search_data_city'] = $search_data_city;
            $data['tokenId'] = $authresponse['TokenId'];
            $data['TraceId'] = $formatted_search_data[0]['TraceId'];
            $data['session_id'] = $session_data;          
             //print_r($data);exit();
            $dataresult['data'] =  $this->load->view(PROJECT_THEME.'/bus/tbo/tbo_search_result',$data,true);
            $dataresult['status'] = 1;
            // debug($dataresult);exit('hhhh');
            echo json_encode($dataresult);exit();
        }

    }



    function get_bus_details($filter_boarding_points = false) {    
        error_reporting(0);
        $this->load->model('bus_model');
        $response['data'] = 'No Details Found !! Try Later';
        $response['status'] = false;
        //check params
        $params = $this->input->post();
         // $params = $this->input->get();
        $bus_res = $params['bus_res'];
        $totalbus_res = $params['totalbus_res'];
        $params = explode('*', $params['route_schedule_id']);
        $params['resultIndex'] = $params[0];
        $params['search_id'] = $params[1];
        $params['traceId'] =  $params[2];
        $params['tokenId'] = $params[3];
        $params['session_id'] = $params[4];
        $params['EndUserIp'] = "103.78.245.113";         
        $boardingDetails = get_bus_boardingDetails($params['EndUserIp'], $params['resultIndex'], $params['traceId'], $params['tokenId']);
        $details = get_bus_details($params['EndUserIp'], $params['resultIndex'], $params['traceId'], $params['tokenId'], 'bus',$this->session->userdata('user_type'));
        // debug($details);exit;
        $response['stauts'] = true;
        $page_data['search_id'] = $params['search_id'];
        // $page_data['ResultToken'] = $params['ResultToken'];
        $page_data['SeatDetails'] = $details;
        $page_data['BoardingDetails'] = $boardingDetails['data']['result'];
        $page_data['EndUserIp'] = $_SERVER['REMOTE_ADDR'];
        $page_data['resultIndex'] = $params[0];
        $page_data['tokenId'] =   $params['tokenId'];
        $page_data['traceId'] =  $params[2];
        $page_data['session_id'] =  $params[4];
        $page_data['bus_res'] =  unserialized_data($bus_res);
        $page_data['totalbus_res'] =  unserialized_data($totalbus_res);
        // debug($page_data); exit();
        $dataresult['data'] =  $this->load->view(PROJECT_THEME.'/bus/tbo/tbo_bus_details',$page_data,true);
        $dataresult['status'] = true;
        echo json_encode($dataresult);exit();
    }



    function get_boadrding_details($filter_boarding_points = false) {
        error_reporting(0);
        $this->load->model('bus_model');
        $response['data'] = 'No Details Found !! Try Later';
        $response['status'] = false;
        //check params
        // $params = $this->input->get();
         $params = $this->input->post();
        // debug($params);
        $bus_res = $params['bus_res'];
        $totalbus_res = $params['totalbus_res'];
        $params = explode('*', $params['route_schedule_id']);
        $params['resultIndex'] = $params[0];
        $params['search_id'] = $params[1];
        $params['traceId'] =  $params[2];
        $params['tokenId'] = $params[3]; 
        $params['EndUserIp'] = $_SERVER['REMOTE_ADDR'];
        $boardingDetails = get_bus_boardingDetails($params['EndUserIp'], $params['resultIndex'], $params['traceId'], $params['tokenId']);
        $response['stauts'] = true;
        $page_data['search_id'] = $params['search_id'];
        $page_data['BoardingDetails'] = $boardingDetails['data']['result'];
        $page_data['EndUserIp'] = $_SERVER['REMOTE_ADDR'];
        $page_data['resultIndex'] = $params[0];
        $page_data['tokenId'] =   $params['tokenId'];
        $page_data['traceId'] =  $params[2];
        $page_data['bus_res'] =  unserialized_data($bus_res);
        $page_data['totalbus_res'] =  unserialized_data($totalbus_res);
       // debug($page_data);exit;
        $dataresult['data'] =  $this->load->view(PROJECT_THEME.'/bus/tbo/tbo_boarding_details',$page_data,true);    
        $dataresult['status'] = true;
        // output_compressed_data($dataresult);
        echo json_encode($dataresult); exit();
    }

  
function get_cancellation_details($filter_cancel_points = false)
{
        error_reporting(0);
        $this->load->model('bus_model');
        $response['data'] = 'No Details Found !! Try Later';

        $response['status'] = false;

        //check params

        // $params = $this->input->get();

         $params = $this->input->post();

        // debug($params);

        $bus_res = $params['bus_res'];

        $totalbus_res = $params['totalbus_res'];

       

        $params = explode('*', $params['route_schedule_id']);

      

        $params['resultIndex'] = $params[0];

        $params['search_id'] = $params[1];

        $params['traceId'] =  $params[2];

        $params['tokenId'] = $params[3];        

        $params['EndUserIp'] = $_SERVER['REMOTE_ADDR'];

        // debug($params);exit('');



        $cancellationDetails = get_bus_cancellationDetails($params['EndUserIp'], $params['resultIndex'], $params['traceId'], $params['tokenId']);

       // debug($cancellationDetails);exit;

        $response['stauts'] = true;

        $page_data['search_id'] = $params['search_id'];

        // $page_data['ResultToken'] = $params['ResultToken'];

        // $page_data['SeatDetails'] = $details;

        $page_data['BoardingDetails'] = $boardingDetails['data']['result'];        

        $page_data['EndUserIp'] = $_SERVER['REMOTE_ADDR'];

        $page_data['resultIndex'] = $params[0];

        $page_data['tokenId'] =   $params['tokenId'];

        $page_data['traceId'] =  $params[2];

        $page_data['bus_res'] =  unserialized_data($bus_res);

        $page_data['totalbus_res'] =  unserialized_data($totalbus_res);

        

        $dataresult['data'] =  $this->load->view(PROJECT_THEME.'/bus/tbo/tbo_cancellation_policy',$page_data,true);    

        $dataresult['status'] = true;

        // output_compressed_data($dataresult);

        echo json_encode($dataresult); exit();
       // $dataresult['data'] =  $this->load->view(PROJECT_THEME.'/bus/tbo/tbo_cancellation_policy',true);    

       
}

    function addToCart($session_id='', $search_id='') {
        error_reporting(0);       
        $pre_booking_params = $this->input->post();
        $selected_seat_response = array_filter(explode('-resp_brk-', $pre_booking_params['selected_seat_response']));   
// debug(unserialized_data($selected_seat_response));exit;
        $safe_search_data = $this->bus_model->get_search_data($search_id);
        $safe_search_data['data']['search_id'] = abs($search_id);
            $page_data['search_data'] = $safe_search_data['data'];           
            $page_data['pax_details'] = array();
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            if ( isset($pre_booking_params['resultIndex']) == true and isset($pre_booking_params['pickupId']) == true and count($pre_booking_params['seat']) > 0 and  $safe_search_data['status'] == true) {
                $pre_booking_params['bus_res'] = unserialized_data($pre_booking_params['bus_res']);
                $bus_details = $pre_booking_params['bus_res'];
                $BoardingDropDetails = unserialized_data($pre_booking_params['dropdetails']);
                $BoardingPickupDetails = unserialized_data($pre_booking_params['pickup-details']);
                $bus_res = $pre_booking_params['bus_res'];
                $totalbus_res = unserialized_data($pre_booking_params['totalbus_res']);
                if ($pre_booking_params['bus_res'] != false && valid_array($bus_details)) {
                    $selected_seats = array();
                    $total_fare = 0;
                    $markup_total_fare = 0;
                    $domain_total_fare = 0;
                    $admin_markup=0;
                    $agent_markup=0;
                    foreach ($pre_booking_params['seat'] as $ssk => $ssv) {
                        foreach ($selected_seat_response as  $key=> $value) {

                            $seatarray = base64_decode($value);
                            $seatarray = json_decode($seatarray,true); 
                            if ($ssv == $seatarray['SeatIndex']) {
                            $cur_seat_attr = $seatarray;
                            // debug($cur_seat_attr);exit;
        // debug($pre_booking_params);exit;
                            $total_fare += $cur_seat_attr['Price']['TotalFare'];
                            $admin_markup += $cur_seat_attr['Price']['admin_markup'];
                            $agent_markup += $cur_seat_attr['Price']['agent_markup_price'];
                            $selected_seats[$ssv] = $cur_seat_attr;
                            }
                        }
                    }
                        // debug($agent_markup);exit;    
                    // debug($selected_seats);exit;
                    $page_data['total_fare'] = $total_fare;
                    $page_data['markup_total_fare'] = $markup_total_fare;
                    $page_data['domain_total_fare'] = $domain_total_fare;
                    $bus_details ['Layout'] ['SeatDetails'] ['clsSeat'] = $selected_seats;
                    $bus_details ['Pickup'] ['clsPickup'] = index_pickup_number(force_multple_data_format(@$BoardingPickupDetails));
                    // debug($bus_details['Pickup']['clsPickup']);exit;
                    $bus_details ['Drop'] ['clsDrop'] = index_drop_number(force_multple_data_format(@$BoardingDropDetails));
                    $bus_details ['CancellationCharges'] ['clsCancellationCharge'] = force_multple_data_format($bus_res['CancellationPolicies']);
                    $bus_details['origindestination'] = $totalbus_res;
                    $bus_details['Route'] = $bus_res;
                    $bus_details['safe_search_data'] = $safe_search_data;    

                    $page_data['selected_seat_response'] = $selected_seat_response;

                    $page_data['resultIndex'] = $pre_booking_params['resultIndex'];

                    $page_data['tokenId'] = $pre_booking_params['tokenId'];

                    $page_data['traceId'] = $pre_booking_params['traceId'];                 

                    $page_data['details'] = $bus_details;

                    $page_data['pre_booking_params'] = $pre_booking_params;

                    $total_markup_fare = count($selected_seats)*$cur_seat_attr['Markup_Fare'];

                    $book_id = 'BB'.date('d-His').'-'.rand(1,1000000);

                    $cart_data['bus_orgin'] = $bus_details['Origin'];

	                $cart_data['bus_destination'] = $bus_details['Destination'];

	                $cart_data['session_id'] = $session_id;
                    $cart_data['admin_markup'] = $admin_markup;
                    $cart_data['agent_markup'] = $agent_markup;

	                $cart_data['status'] = "BOOKING_INPROCESS";

	                $cart_data['app_reference'] = $book_id;

	                $cart_data['amount'] = $page_data['total_fare'];

	                $cart_data['selected_seat_response'] = json_encode($page_data['selected_seat_response']);     

	                $book_data  = base64_encode(json_encode($page_data));

	                // debug($cart_data); exit();

	        		$data = $this->bus_model->add_cart_details_bus($cart_data);

	        		$ins_book_data = $this->bus_model->ins_book_data($search_id, $book_data,$data['shopping_global_id'] );	        		        	    

	        	    $page_data['C_URL'] 			= WEB_URL.'booking/'.$session_id.'/'.$search_id.'/BUS';

					$page_data['cart_status'] 	= 1;

					$page_data['status'] = 1;

					$page_data['isCart'] = true;
					echo json_encode($page_data); exit();					
                }

            }

        

    }



    



    /**

     *  Balu A

     * Process booking on hold - pay at bank

     */

    function booking_on_hold($book_id) {

        

    }



    /**

     * Balu A

     */

    function pre_cancellation($app_reference, $booking_source) {

        if (empty($app_reference) == false && empty($booking_source) == false) {

            $page_data = array();

            $booking_details = $this->bus_model->get_booking_details($app_reference, $booking_source);

            // debug($booking_details);exit;

            if ($booking_details['status'] == SUCCESS_STATUS) {

                $this->load->library('booking_data_formatter');

                //Assemble Booking Data

                $assembled_booking_details = $this->booking_data_formatter->format_bus_booking_data($booking_details, 'b2c');

                $page_data['data'] = $assembled_booking_details['data'];

                $this->template->view('bus/pre_cancellation', $page_data);

            } else {

                redirect('security/log_event?event=Invalid Details');

            }

        } else {

            redirect('security/log_event?event=Invalid Details');

        }

    }



    /*

     * Balu A

     * Process the Booking Cancellation

     * Full Booking Cancellation

     *

     */



    function cancel_booking($app_reference, $booking_source) {

        //echo 'Under Construction';exit;

        if (empty($app_reference) == false) {

            $master_booking_details = $this->bus_model->get_booking_details($app_reference, $booking_source);

            if ($master_booking_details['status'] == SUCCESS_STATUS) {

                $this->load->library('booking_data_formatter');

                $master_booking_details = $this->booking_data_formatter->format_bus_booking_data($master_booking_details, 'b2c');

                $master_booking_details = $master_booking_details['data']['booking_details'][0];

                // debug($master_booking_details);exit;

                $PNRNo = trim($master_booking_details['pnr']);

                $TicketNo = trim($master_booking_details['ticket']);

                $SetaNos = $master_booking_details['seat_numbers'];

                $booking_details = array();

                $booking_details['PNRNo'] = $PNRNo;

                $booking_details['TicketNo'] = $TicketNo;

                $booking_details['SeatNos'] = $SetaNos;

                $booking_details['booking_source'] = $master_booking_details['booking_source'];

                load_bus_lib($booking_source);

                $cancellation_details = $this->bus_lib->cancel_full_booking($booking_details, $app_reference); //Invoke Cancellation Methods

                // debug($cancellation_details);exit;



                if ($cancellation_details['status'] == true) {//IF Cancellation is Success

                    $cancellation_details = $this->bus_lib->save_cancellation_data($app_reference, $cancellation_details); //Save Cancellation Data

                }

                redirect('bus/cancellation_details/' . $app_reference . '/' . $booking_source);

            } else {

                redirect('security/log_event?event=Invalid Details');

            }

        } else {

            redirect('security/log_event?event=Invalid Details');

        }

    }



    /**

     * Balu A

     * Cancellation Details

     * @param $app_reference

     * @param $booking_source

     */

    function cancellation_details($app_reference, $booking_source) {

        if (empty($app_reference) == false && empty($booking_source) == false) {

            $master_booking_details = $GLOBALS['CI']->bus_model->get_booking_details($app_reference, $booking_source);

            if ($master_booking_details['status'] == SUCCESS_STATUS) {

                $page_data = array();

                $this->load->library('booking_data_formatter');

                $master_booking_details = $this->booking_data_formatter->format_bus_booking_data($master_booking_details, 'b2c');

                $page_data['data'] = $master_booking_details['data'];

                $this->template->view('bus/cancellation_details', $page_data);

            } else {

                redirect('security/log_event?event=Invalid Details');

            }

        } else {

            redirect('security/log_event?event=Invalid Details');

        }

    }



    /**

     * Balu A

     */

    function exception() {

        $module = META_BUS_COURSE;

        $op = @$_GET['op'];

        $notification = @$_GET['notification'];

        // echo $notification;exit;

        $exception = $this->module_model->flight_log_exception ( $module, $op, $notification );

        

        $exception = base64_encode(json_encode($exception));

        // debug($exception);exit;

        // set ip log session before redirection

        $this->session->set_flashdata ( array (

                'log_ip_info' => true 

        ) );

        redirect ( base_url () . 'index.php/bus/event_logger/' . $exception );

    }



    function event_logger($exception = '') {

        $log_ip_info = $this->session->flashdata('log_ip_info');

        $this->template->view('bus/exception', array('log_ip_info' => $log_ip_info, 'exception' => $exception));

    }



    public function generate_rand_no($length = 24) {

        $alphabets = range('A','Z');

        $numbers = range('0','9');

        $final_array = array_merge($alphabets,$numbers);

        //$id = date("ymd").date("His");

        $id = '';

        while($length--) {

          $key = array_rand($final_array);

          $id .= $final_array[$key];

        }

        return $id;

    }
    
    public function store_city_list()
    {
        // $auth=get_aut_json_response_new();
        // debug($auth);exit;
      $datas['BusCities']=get_bus_city_list_new();
      // debug($datas['BusCities']);exit;
     $bus_data = $this->bus_model->insert_tbo_city_list_new($datas['BusCities']);
 
    }
    
    
}

