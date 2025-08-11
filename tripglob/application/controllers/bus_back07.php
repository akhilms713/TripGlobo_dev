<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



/**

 *

 * @package    Provab

 * @subpackage Bus

 * @author     Balu A<balu.provab@gmail.com>

 * @version    V1

 */

/*ini_set('display_errors', '1');

ini_set('display_startup_errors', '1');

error_reporting(E_ALL);*/

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

    }



    /**

     * index page of application will be loaded here

     */

    function index() {

        

    }



    /**

     *  Balu A

     * Load bus Search Result

     * @param number $search_id unique number which identifies search criteria given by user at the time of searching

     */

    function search($search_id='') {
    //     	if(!empty($_GET['from']) && !empty($_GET['to'])){
    //   if ($_GET['from'] == '' || $_GET['to'] == '') { 
    //     redirect(WEB_URL.'home','refresh'); 
    //   }
     
    //     $from = $_GET['from'];
    //   $to = $_GET['to'];
    // }else{
    //   if ($_GET['from'] == '' || $_GET['to'] == '') { 
    //     redirect(WEB_URL.'home','refresh'); 
    //   }
    //   $from = $_GET['from'];
    //   $to = $_GET['to'];

    // }

        // echo "string";

        $data =array();

        $data = $this->input->get();
        // debug($data);die;
        $insert_data['search_data'] = json_encode($data);
        $insert_data['search_type'] = 'BUS';
        $search_insert_data = $this->custom_db->insert_record('search_history',$insert_data);

        // debug($search_insert_data); exit();

        $data['search_id'] = $search_insert_data['insert_id'];

        $data['bus_search_params'] = $data;

        // $data['data'] ="data";

        // debug($data); exit();
        
        $this->load->view(PROJECT_THEME.'/bus/search_result_page', $data);       

        /*$bus_list = get_bus_list();

        debug($bus_list);*/

       /* $safe_search_data = $this->bus_model->get_safe_search_data($search_id);

        // Get all the busses bookings source which are active

        $active_booking_source = $this->bus_model->active_booking_source();

        // debug($active_booking_source); exit();

        if ($safe_search_data['status'] == true and valid_array($active_booking_source) == true) {

            $safe_search_data['data']['search_id'] = abs($search_id);

            $this->template->view('bus/search_result_page', array('bus_search_params' => $safe_search_data['data'], 'active_booking_source' => $active_booking_source));

        } else {

            $this->template->view('general/popup_redirect');

        }*/



        //https://www.goodflights.in/bus_tbo/index.php/bus/search/169?bus_station_from=Bangalore&from_station_id=1190&bus_station_to=Chennai&to_station_id=2553&bus_date_1=11-08-2020

        /*$authresponse = $this->bus_lib->auth_tektravel();

        $query  = $type.'&origin='.substr(chop(substr($request['from'], -5), ')'), -3).'&destination='.substr(chop(substr($request['to'], -5), ')'), -3).'&depart_date='.$request['depature'].$return_date.'&ADT='.$request['adult'].'&CHD='.$request['child'].'&INF='.$request['infant'].'&class='.$request['class2'].'&is_domestic='.$isdomstic.'&airline='.$airline.'&search_id='.$search_insert_data['insert_id'].'&flexible='.$request['flexible'];



            redirect(WEB_URL.'flight/?'.$query);  */

    }

    public function bus_list($search_id ='')

    {


        $search_params =array();

        $search_params = $this->input->get();
        // debug($search_params);exit;

        $session_data_main= $data['session_data'] = $session_data = $this->generate_rand_no().date("mdHis");

        // debug($data); exit();

          // echo "string";

    	/*ini_set('display_errors', '1');

		ini_set('display_startup_errors', '1');

		error_reporting(E_ALL);*/

		error_reporting(0);

       

        $authresponse = auth_tektravel();

         // debug($search_data);

        // debug($authresponse); exit();

        if ($authresponse['Status'] == true) {
            $raw_bus_list = get_bus_list(abs($search_params['search_id']),$authresponse);
        }

              

        // debug($raw_bus_list); exit();

        $from_id = @$raw_bus_list['data']['result']['Destination'];

        $to_id = @$raw_bus_list['data']['result']['Origin'];



        $form_data = $this->bus_model->get_bus_station_data($search_data['from_station_id']);

        // debug($form_data);

        $to_data = $this->bus_model->get_bus_station_data($search_data['to_station_id']);

       // debug($to_data);exit;

        $search_data_city = array('from_id' => $form_data->station_id,

            'to_id' => $to_data->station_id);

       // debug($search_data_city);

        //exit;

        if ($raw_bus_list['status']) {

            //Converting API currency data to preferred currency

            // echo 'herre'.get_api_data_currency();exit;

            



            // $raw_bus_list = $this->bus_lib->search_data_in_preferred_currency($raw_bus_list, $currency_obj);

            // $currency_obj = new Currency(array('module_type' => 'bus', 'from' => get_application_currency_preference(), 'to' => get_application_currency_preference()));

            

            $formatted_search_data = format_search_response($raw_bus_list, $search_params['search_id'], 'bus','B2C');

           // debug($formatted_search_data);exit('hhhh');

            //Display Bus List

            // $currency_obj = new Currency(array('module_type' => 'bus', 'from' => get_application_currency_preference(), 'to' => get_application_currency_preference()));

            $data['raw_bus_list'] = $formatted_search_data;

            $data['search_id'] = $search_params['search_id'];

            $data['search_data_city'] = $search_data_city;

            $data['tokenId'] = $authresponse['TokenId'];

            $data['TraceId'] = $formatted_search_data[0]['TraceId'];

            $data['session_id'] = $session_data;



            $dataresult['data'] =  $this->load->view(PROJECT_THEME.'/bus/tbo/tbo_search_result',$data,true);

            $dataresult['status'] = 1;

            // debug($dataresult);exit('hhhh');

            echo json_encode($dataresult);exit();

            //array('raw_bus_list' => $formatted_search_data, 'search_id' => $search_params['search_id'],  'search_data_city' => $search_data_city,'tokenId' =>$authresponse['TokenId'], 'TraceId' => $formatted_search_data[0]['TraceId'] )



            /*$response_tbo['data'] =    $this->load->view(PROJECT_THEME.'/bus/tbo/tbo_search_result', $data);

                        // debug($response_tbo['data']);

            $bus_list = $response_tbo['data'];

            $response['status'] = 1;

            $response['data'] = get_compressed_output($bus_list);*/

            // debug($response_tbo['data']);exit('hhhh');

            

        }

    }



    function get_bus_details($filter_boarding_points = false) {



        /*ini_set('display_errors', '1');

        ini_set('display_startup_errors', '1');

        error_reporting(E_ALL);*/

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

        // debug($params); exit();

      

        $params['resultIndex'] = $params[0];

        $params['search_id'] = $params[1];

        $params['traceId'] =  $params[2];

        $params['tokenId'] = $params[3];        

        $params['session_id'] = $params[4];        

        $params['EndUserIp'] = "103.78.245.113";

        // debug($params);exit('');

        $boardingDetails = get_bus_boardingDetails($params['EndUserIp'], $params['resultIndex'], $params['traceId'], $params['tokenId']);

        $details = get_bus_details($params['EndUserIp'], $params['resultIndex'], $params['traceId'], $params['tokenId'], 'bus','B2C');

         // debug($boardingDetails);

         // debug($details);

         //  exit();

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

        /*ini_set('display_errors', '1');

        ini_set('display_startup_errors', '1');

        error_reporting(E_ALL);*/

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



        $boardingDetails = get_bus_boardingDetails($params['EndUserIp'], $params['resultIndex'], $params['traceId'], $params['tokenId']);



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

        

        $dataresult['data'] =  $this->load->view(PROJECT_THEME.'/bus/tbo/tbo_boarding_details',$page_data,true);    

        $dataresult['status'] = true;

        // output_compressed_data($dataresult);

        echo json_encode($dataresult); exit();

    }

    /**

     *  Balu A

     * Passenger Details page for final bookings

     * Here we need to run booking based on api

     */

    function addToCart($session_id='', $search_id='') {

        // exit('hiii');

        /*ini_set('display_errors', '1');

        ini_set('display_startup_errors', '1');

        error_reporting(E_ALL);*/

        error_reporting(0);

        // print_r($_POST); die();

        

        $pre_booking_params = $this->input->post();

        $selected_seat_response = array_filter(explode('-resp_brk-', $pre_booking_params['selected_seat_response']));

   

        /*debug($session_id);

        debug($search_id);

        debug($pre_booking_params);

        debug($selected_seat_response);   

        exit;*/

        

       

        // echo 'herre'.get_application_currency_preference();exit;

        $safe_search_data = $this->bus_model->get_search_data($search_id);

        $safe_search_data['data']['search_id'] = abs($search_id);

        // $page_data['active_payment_options'] = $this->module_model->get_active_payment_module_list();

        // debug($safe_search_data['data']);exit;

      

            

            $page_data['search_data'] = $safe_search_data['data'];

            // load_bus_lib($pre_booking_params['booking_source']);

            //Need to fill pax details by default if user has already logged in

            // $this->load->model('user_model');

            $page_data['pax_details'] = array();



            //Not to show cache data in browser

            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

            header("Cache-Control: post-check=0, pre-check=0", false);

            header("Pragma: no-cache");

            // debug($pre_booking_params); exit();



            if ( isset($pre_booking_params['resultIndex']) == true and isset($pre_booking_params['pickupId']) == true and count($pre_booking_params['seat']) > 0 and  $safe_search_data['status'] == true) {



                $pre_booking_params['bus_res'] = unserialized_data($pre_booking_params['bus_res']);

                $bus_details = $pre_booking_params['bus_res'];

                $BoardingDropDetails = unserialized_data($pre_booking_params['dropdetails']);

                $BoardingPickupDetails = unserialized_data($pre_booking_params['pickup-details']);

                $bus_res = $pre_booking_params['bus_res'];

                $totalbus_res = unserialized_data($pre_booking_params['totalbus_res']);

                // debug($bus_details);exit;

                //$bus_details = $this->bus_lib->get_bus_details($pre_booking_params['route_schedule_id'], $pre_booking_params['journey_date']);

                // debug($bus_details);

                // debug($pre_booking_params);exit;

                if ($pre_booking_params['bus_res'] != false && valid_array($bus_details)) {

                

                    $selected_seats = array();

                    $total_fare = 0;

                    $markup_total_fare = 0;

                    $domain_total_fare = 0;

                  

                    // debug($pre_booking_params);

                    foreach ($pre_booking_params['seat'] as $ssk => $ssv) {

                        // debug($ssv);

                        foreach ($selected_seat_response as  $key=> $value) {

                            $seatarray = base64_decode($value);

                            $seatarray = json_decode($seatarray,true);

                            // debug($seatarray);exit;

                        if ($ssv == $seatarray['SeatIndex']) {

                           

                        $cur_seat_attr = $seatarray;

                        $total_fare += $cur_seat_attr['Price']['PublishedPriceRoundedOff'];

                        // debug($total_fare);exit;



                        // total currency to customer

                        /*if($application_currency == get_application_currency_preference()){

                            $temp_currency = $currency_obj->get_currency($cur_seat_attr['Price']['PublishedPriceRoundedOff']);

                        }

                        else{

                            $temp_currency = $booking_currency_obj->get_currency($cur_seat_attr['Price']['PublishedPriceRoundedOff']);



                        }

                        // debug($temp_currency);exit;

                        // currency to be deducted from domain

                        $domain_currency = $domain_currency_obj->get_currency($cur_seat_attr['Price']['PublishedPriceRoundedOff'], true, true, false);*/

                        // $cur_seat_attr ['Markup_Fare'] = $temp_currency ['default_value'];

                        // $markup_total_fare += @$cur_seat_attr ['Markup_Fare'];

                        // $domain_total_fare += @$domain_currency ['default_value'];

                       /* if($application_currency != get_application_currency_preference()){

                            $cur_seat_attr['total_fare'] =get_converted_currency_value($booking_currency_obj->force_currency_conversion($cur_seat_attr['total_fare']));

                            $cur_seat_attr['base_fare'] =get_converted_currency_value($booking_currency_obj->force_currency_conversion($cur_seat_attr['base_fare']));

                            $cur_seat_attr['Fare'] =  get_converted_currency_value($booking_currency_obj->force_currency_conversion($cur_seat_attr['Fare']));

                            $bus_details['Route']['CommAmount'] =  get_converted_currency_value($booking_currency_obj->force_currency_conversion($bus_details['Route']['CommAmount']));



                        }*/

                        $selected_seats[$ssv] = $cur_seat_attr;

                        }

                        }

                    }

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





                    // debug($bus_details['selected_seat_response']);exit;

                    // debug($bus_details ['CancellationCharges'] ['clsCancellationCharge']);exit;



                    //----------- page data

                    $page_data['selected_seat_response'] = $selected_seat_response;

                    $page_data['resultIndex'] = $pre_booking_params['resultIndex'];

                    $page_data['tokenId'] = $pre_booking_params['tokenId'];

                    $page_data['traceId'] = $pre_booking_params['traceId'];

                  

                    $page_data['details'] = $bus_details;

                    $page_data['pre_booking_params'] = $pre_booking_params;

                    // $page_data['pre_booking_params']['default_currency'] = admin_base_currency();

                    // $page_data['iso_country_list'] = $this->db_cache_api->get_iso_country_list();

                    // $page_data['country_list'] = $this->general_model->getCountryList();

                    

                    $total_markup_fare = count($selected_seats)*$cur_seat_attr['Markup_Fare'];

                    // $page_data['convenience_fees'] = $currency_obj->convenience_fees($total_markup_fare, $search_id, count($selected_seats));

                    //Summarize Price

                    //$page_data['price_summary'] = '';

                    // debug($page_data);exit;

                    // $page_data['pax_title_enum'] = get_enum_list('title');

                    // $gender_enum = get_enum_list('gender');

                    

                    /*unset($gender_enum [3]);

                    $page_data['gender_enum'] = $gender_enum;*/

                    //Traveller Details

                    // $page_data['traveller_details'] = $this->user_model->get_user_traveller_details();

                    // $page_data['pax_details'] = $this->user_model->get_current_user_details();

                   

                    //Get the country phone code 

                    // $Domain_record = $this->custom_db->single_table_records('domain_list', '*');

                    // $page_data['active_data'] = $Domain_record['data'][0];

                    //'BOOKING_CONFIRMED','BOOKING_HOLD','BOOKING_CANCELLED','BOOKING_ERROR','BOOKING_INCOMPLETE','BOOKING_INPROCESS'

                    // debug($page_data);

                    $book_id = 'BB'.date('d-His').'-'.rand(1,1000000);

                    $cart_data['bus_orgin'] = $bus_details['Origin'];

	                $cart_data['bus_destination'] = $bus_details['Destination'];

	                $cart_data['session_id'] = $session_id;

	                $cart_data['status'] = "BOOKING_INPROCESS";

	                $cart_data['app_reference'] = $book_id;

	                $cart_data['amount'] = $page_data['total_fare'];

	                $cart_data['selected_seat_response'] = json_encode($page_data['selected_seat_response']);

                   /* debug($cart_data);

	                exit();

	        */

	                //echo '<pre>';print_r($cart_data);exit();

	                $book_data  = base64_encode(json_encode($page_data));

	                // debug($book_data); exit();





	        		$data = $this->bus_model->add_cart_details_bus($cart_data);

	        		$ins_book_data = $this->bus_model->ins_book_data($search_id, $book_data,$data['shopping_global_id'] );

	        		        	    

	        	    $page_data['C_URL'] 			= WEB_URL.'booking/'.$session_id.'/'.$search_id.'/BUS';

					$page_data['cart_status'] 	= 1;

					$page_data['status'] = 1;

					$page_data['isCart'] = true;



					echo json_encode($page_data); exit();

					// redirect( $data['C_URL']);

	    

	                // 

                    /*$temp_record = $this->custom_db->get_phone_code_list();

                    $page_data['phone_code'] =$temp_record;

                     if(!empty($this->entity_country_code)){

                        // $mobile_code = $this->db_cache_api->get_mobile_code($this->entity_country_code);

                        $page_data['user_country_code'] = $mobile_code;

                    }

                    else{

                        $page_data['user_country_code'] = $Domain_record['data'][0]['phone_code'];  

                    }

                    debug($page_data);exit;

                    // $this->template->view('bus/tbo/tbo_booking_page', $page_data);

                     $this->load->view(PROJECT_THEME.'/bus/tbo/tbo_booking_page',$page_data,true);    */

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

}

