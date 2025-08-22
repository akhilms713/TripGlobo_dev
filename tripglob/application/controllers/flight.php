<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
error_reporting(0);

class FLight extends CI_Controller {

    //DO : Setting Current website url in session, Purpose : For keeping the page on login/logout.
    public function __construct() {
        parent::__construct();
        $current_url = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
        $current_url = WEB_URL . $this->uri->uri_string() . $current_url;
        $url = array('continue' => $current_url);
        $this->perPage = 100000;
        $this->session->set_userdata($url);
        $this->load->model('Home_Model');
        $this->load->model('Flight_Model');
        $this->load->model('cart_model');
        $this->load->model('booking_model');
        $this->load->model('email_model');
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->library('flight/amedus_xml_to_array');
        $this->load->library('flight/xml_to_array');
        $this->load->library('Ajax_pagination');
        $this->load->helper('flight/amedus_helper');
        $this->load->helper('flight/tbo_helper');
        $this->curr_val = 1;
    }

    public function index() {
        $request = $this->input->get();
        $data['req'] = json_decode(json_encode($request));
        $data['request'] = base64_encode(json_encode($request));
        // debug($data['request']);exit;

        //$this->load->view(PROJECT_THEME.'/flight/results_calender', $data);
        //$data['airportcitycode']=$this->Flight_Model->getAirportcodelist($request);
        // print_r($data); exit;
        if ($request['type'] == "M") {
            $this->load->view(PROJECT_THEME . '/flight/results', $data);
        } else if ($request['destination'] != $request['origin']) {
            $this->load->view(PROJECT_THEME . '/flight/results', $data);
        } else {
            //redirect('home');
        }
    }

    public function search() {
        $request = $this->input->get();
        // echo '<pre>';print_r($request);exit();
        $insert_report['search_type'] = 'FLIGHT';
        $insert_report['trip_type'] = $request['trip_type'];
        $insert_report['cehck_from'] = $request['from'];
        $insert_report['cehck_to'] = $request['to'];
        $insert_report['cehck_both'] = $request['from'] . ' - ' . $request['to'];
        $search_report_data = $this->custom_db->insert_record('search_report', $insert_report);
        if ($request['trip_type'] == '') {
            $request['trip_type'] = 'round';
        }

        if ($request['trip_type'] == "oneway") {
            $request['depature'] = date('d-m-Y', strtotime($request['depature']));
        }
        if ($request['trip_type'] == "round") {
            //$data1=explode('-',$request['round_val']);
            $request['depature'] = date('d-m-Y', strtotime($request['depature']));
            $request['return'] = date('d-m-Y', strtotime($request['return']));
        }

        if ($request['trip_type'] == "oneway") {
            $tday_get = date('d-m-Y');
            $dep_get_now = strtotime($request['depature']);
            $tday_get_now = strtotime($tday_get);

            if ($dep_get_now < $tday_get_now) {
                redirect(WEB_URL, 'refresh');
            }
        }

        if ($request['trip_type'] == "round") {
            $dep_get = strtotime($request['depature']);
            $ret_get = strtotime($request['return']);

            if ($dep_get > $ret_get) {
                redirect(WEB_URL, 'refresh');
            }
        }

        if (trim($request['trip_type']) != 'M' && $request['trip_type'] != 'multicity') {

            if ($request['depature']) {
                $request['depature'] = date('d-m-Y', strtotime($request['depature']));
            }
            if ($request['return']) {
                $request['return'] = date('d-m-Y', strtotime($request['return']));
            }

            $insert_data['search_data'] = json_encode($request);
            $insert_data['search_type'] = 'FLIGHT';


            $search_insert_data = $this->custom_db->insert_record('search_history', $insert_data);
            $request['type'] = $request['trip_type'];
            $return_date = '';
            $isdomstic = '';
            $dep_check = explode("-", $request['depature']);
            $deppp = count($dep_check);
            if (($request['type']) == "round") {
                $ret_check = explode("-", $request['return']);
                $rett = count($ret_check);
            }
            $from_aircode = explode('(', $request['from']);
            $to_aircode = explode('(', $request['to']);
            $cehck_from = count($from_aircode);
            $cehck_to = count($to_aircode);


            if (($request['from']) == ($request['to'])) {
                redirect(WEB_URL, 'refresh');
            } elseif (($request['depature']) == "") {
                redirect(WEB_URL, 'refresh');
            } elseif (($request['depature']) != "" && $deppp != "3") {

                redirect(WEB_URL, 'refresh');
            } elseif ($request['type'] == "oneway" && $request['depature'] == "") {
                redirect(WEB_URL, 'refresh');
            } elseif (($request['type']) == "round" && $request['depature'] == "" || $request['type'] == "round" && $request['return'] == "") {
                redirect(WEB_URL, 'refresh');
            } else if (((($request['type']) == "") || ($request['depature'] == "") || ($deppp != "3")) || ((($request['type']) == "") && ($request['depature'] == "") && ($deppp != "3") && ($rett != "3") && ($request['return'] == ""))) {
                redirect(WEB_URL, 'refresh');
            } elseif ((($request['from']) == "") || (($request['to']) == "")) {
                redirect(WEB_URL, 'refresh');
            } elseif (($request['adult']) + ($request['child']) > 9) {
                redirect(WEB_URL, 'refresh');
            } elseif (($request['adult'] == "" ) || ($request['child'] == "") || ($request['infant'] == "") || ($request['class2'] == "")) {
                redirect(WEB_URL, 'refresh');
            } elseif ($cehck_from != 2 || $cehck_to != 2) {
                redirect(WEB_URL, 'refresh');
            }
            if ($request['trip_type'] == 'oneway') {
                $type = 'type=oneway';
            } else if ($request['trip_type'] == 'round') {
                $type = 'type=round';
                $return_date = '&return_date=' . $request['return'];
            }
            $from_aircode = substr(chop(substr($request['from'], -5), ')'), -3);
            $country_name = $this->Flight_Model->getcountry_name($from_aircode);
            $from_country = $country_name->country;
            $to_aircode = substr(chop(substr($request['to'], -5), ')'), -3);
            $country_name = $this->Flight_Model->getcountry_name($to_aircode);
            $to_country = $country_name->country;


            $isdomstic = 0;
            if ($request['airlines'] != "0" && $request['airlines'] != "") {
                $airline = $request['airlines'];
            } else {
                $airline = '';
            }


            $query = $type . '&origin=' . substr(chop(substr($request['from'], -5), ')'), -3) . '&destination=' . substr(chop(substr($request['to'], -5), ')'), -3) . '&depart_date=' . $request['depature'] . $return_date . '&ADT=' . $request['adult'] . '&CHD=' . $request['child'] . '&INF=' . $request['infant'] . '&class=' . $request['class2'] . '&is_domestic=' . $isdomstic . '&airline=' . $airline . '&search_id=' . $search_insert_data['insert_id'] . '&flexible=' . $request['flexible'];

            redirect(WEB_URL . 'flight/?' . $query);
        } else if ($request['trip_type'] == 'multicity' || trim($request['trip_type']) == 'M') {
            $type = 'type=M';
            $multi = json_decode(json_encode($this->input->get()));
            foreach ($multi->from_m as $key => $value) {
                $origin[] = substr(chop(substr($value, -5), ')'), -3);
                $destination[] = substr(chop(substr($multi->to_m[$key], -5), ')'), -3);
                $depature[] = $multi->depature_m[$key];
            }
            $origin1 = substr(chop(substr($origin[0], -5), ')'), -3);
            $max_coun = count($destination) - 1;
            $destination1 = substr(chop(substr($destination[$max_coun], -5), ')'), -3);
            $depature1 = $depature[0];
            //airline wise search 
            if ($request['airlines'] != "0" && $request['airlines'] != "") {
                $airline = $request['airlines'];
            } else {
                $airline = '';
            }
            $multicity = array(
                'type' => 'M',
                'flexible' => '0',
                'origin' => $origin1,
                'destination' => $destination1,
                'depart_date' => $depature1,
                'origin_m' => $origin,
                'destination_m' => $destination,
                'depart_date_m' => $depature,
                'ADT' => $request['adult'],
                'CHD' => $request['child'],
                'INF' => $request['infant'],
                'class' => $request['class'],
                'airline' => $request['airline'],
                'max_stop' => $request['max_stop'],
                'departure_time' => $request['departure_time'],
                'arrival_time' => $request['arrival_time'],
                'connection_location' => $request['connection_location'],
            );
            $query = http_build_query($multicity);
            redirect(WEB_URL . 'flight/?' . $query);
        }
    }

    public function add_days_todate() {

        $get_data = $this->input->get();

        $request_data = json_decode(base64_decode($get_data['search_request']), true);
        if ($request_data['type'] == 'oneway') {
            $new_date = trim($get_data['new_date']);
            $request_data['depart_date'] = date('d-m-Y', strtotime($new_date)); //Adding new Date
            $day_diff = $this->get_date_difference($request_data['depart_date'], $new_date);
            if (isset($safe_search_data['return'])) {
                $request_data['return'] = $this->add_days_to_date($day_diff, $request_data['return_date']); //Check it
            }
            $query = http_build_query($request_data);
            redirect('flight/?' . $query);
        }
    }

    function get_date_difference($date1, $date2) {
        $date1 = strtotime($date1);
        $date2 = strtotime($date2);
        return floor(($date2 - $date1) / (60 * 60 * 24));
    }

    function add_days_to_date($days, $date = '') {
        if (empty($date) == true) {
            $date = date('d-m-Y');
        }
        return date('d-m-Y H:i:s', strtotime($date . ' +' . $days . ' day'));
        ;
    }

    public function GetResults($Req_before_decode = '') {
        if (isset($_SESSION['this_form']) && !empty($_SESSION['this_form'])) {
            // code...
        unset($_SESSION['this_form']);
        unset($_SESSION['this_to']);
        }
        $data['request'] = $search_request = json_decode(base64_decode($Req_before_decode));
        $rand_id = md5(time() . rand() . crypt(time()));
        $xml_response = $this->Flight_Model->insertInputParameters($search_request, $rand_id);
        $session_data_main = $data['session_data'] = $session_data = $this->generate_rand_no() . date("mdHis");
        //$session_data_main= $data['session_data'] = $session_data ="GSGORC134B0ZWWSI9NPZOHSN0604215359";
        $api_name = "";
        $active_api = $this->Flight_Model->get_api_list_flight();
        // debug($active_api);exit;
        for ($ai = 0; $ai < count($active_api); $ai++) {
            $api_name = $active_api[$ai]->api_name; 
            //$api_name='AMADEUS';


            if ($api_name == 'AMADEUS') {
                
                $Amedus_LowFareSearchRes = Fare_MasterPricerTravelBoardSearchReq($search_request, $xml_response);
                $results = $this->renderApiResponse($Amedus_LowFareSearchRes['Fare_MasterPricerTravelBoardSearchRes'], $rand_id);
                // debug($results); die;
                if ($results) {
                    $new_flight_arr = array();
                    $i = 0;
                    foreach ($results as $r_key => $r_value) {

                        if (isset($search_request->preferred_airline) && !empty($search_request->preferred_airline) && $search_request->preferred_airline != 'All') {

                            if ($search_request->preferred_airline == $r_value['FlightDetails'][0]['airlineName'][0]) {
                                $include_flight = true;
                                foreach ($r_value['FlightDetails'] as $f_key => $f_value) {
                                    foreach ($f_value['locationIdArival'] as $l_key => $l_value) {
                                        if ((@$f_value['locationIdDeparture'][$l_key + 1] != null) && @$f_value['locationIdDeparture'][$l_key + 1] != $l_value) {
                                            $include_flight = false;
                                        }
                                    }
                                }
                                if ($include_flight) {
                                    $new_flight_arr[$i]['FlightDetailsID'] = $i;
                                    $new_flight_arr[$i]['FlightDetails'] = $r_value['FlightDetails'];
                                    $new_flight_arr[$i]['PricingDetails'] = $r_value['PricingDetails'];
                                    $new_flight_arr[$i]['paxFareProduct'] = $r_value['paxFareProduct'];
                                    $i++;
                                } else {
                                    
                                }
                            }
                        } else {
                            $include_flight = true;
                            foreach ($r_value['FlightDetails'] as $f_key => $f_value) {
                                //if(valid_array($r_value['FlightDetails'] )){
                                foreach ($f_value['locationIdArival'] as $l_key => $l_value) {

                                    if ((@$f_value['locationIdDeparture'][$l_key + 1] != null) && @$f_value['locationIdDeparture'][$l_key + 1] != $l_value) {
                                        $include_flight = false;
                                    }
                                }
                            }
                            if ($include_flight) {
                                $new_flight_arr[$i]['FlightDetailsID'] = $i;
                                $new_flight_arr[$i]['FlightDetails'] = $r_value['FlightDetails'];
                                $new_flight_arr[$i]['PricingDetails'] = $r_value['PricingDetails'];
                                $new_flight_arr[$i]['paxFareProduct'] = $r_value['paxFareProduct'];
                                $i++;
                            } else {
                                //echo "not_incl"."<br/>";
                            }
                        }
                    }
                    $results = $new_flight_arr;
                }
                // debug('here');
                $data['paxFareProduct'] = $results['paxFareProduct']['paxFareDetail'];
                $dataresult['session_data'] = $session_data_main;
                //echo "ss"; print_r($dataresult['session_data']);die();
                // debug('here3');
                $this->Flight_Model->save_result($results, $session_data, $search_request, $api_name);
                // exit; 
            } elseif ($api_name == 'TBO') {
                // error_reporting(E_ALL);
                $token_row = get_token();
                // debug($token_row);
                $token_data = json_decode($token_row);
                $_SESSION['token'] = $token_data;
                $tt = $_SESSION['token'];
                $results = SearchReq_Res($search_request, $tt);
               // debug($results);exit;
                $dataresult['session_data'] = $session_data_main;
                
                $this->Flight_Model->save_result_tbo($results, $session_data, $search_request, $api_name);
            }
        }
        $flight_data = $this->Flight_Model->get_last_response_data($session_data);
        $flight_data1 = $this->Flight_Model->get_arival_data_data($session_data);
        // debug($flight_data);exit;

       // debug($data['request']);exit;
        if ($api_name == 'AMADEUS') {
            $arival_data = json_decode($flight_data1['low_flight']->segment_data);
            $dataresult['ArrivalDate'] = $arival_data[0]->ArrivalDate[0];
        }

        $level_markup = 'B2C';
        $user_type = $this->session->userdata('user_type');
        if ($user_type == B2B_USER) {
            $user_id = $this->session->userdata('user_id');
            $level_markup = 'B2B';
        }
        $start_date = date('Y-m-d', strtotime($search_req->depart_date));
        if ($search_req->depart_date == "Roundtrip") {
            $end_date = date('Y-m-d', strtotime($search_req->return_date));
        }
        $total_flight_price = $flight_data['result_data']->min_rate;
        $dataresult['min_rate'] = floor((float) $flight_data['result_data']->min_rate * $this->curr_val);
        $total_flight_price = $flight_data['result_data']->max_rate;
        $dataresult['max_rate'] = ceil((float) $flight_data['result_data']->max_rate * $this->curr_val);
        $data['airline_data'] = $flight_data['airline_data'];   
        // debug($data['airline_data']);die;    
        $data['connecting_airports_filter'] = $flight_data['connecting_airports_filter'];
        $dataresult['stops_0min_rate'] = floor((float) $flight_data['stops_0']->min_rate * $this->curr_val);
        $dataresult['stops_1min_rate'] = floor((float) $flight_data['stops_1']->min_rate * $this->curr_val);
        $dataresult['stops_multimin_rate'] = floor((float) $flight_data['stops_multi']->min_rate * $this->curr_val);
        $data['flight_count'] = $flight_data['result_data']->flight_count;
        $totalRec = $flight_data['result_data']->flight_count;

        $config['first_link'] = 'First';
        $config['div'] = 'flightsdata'; //parent div tag id
        $config['base_url'] = WEB_URL . 'flight/ajaxPaginationData/' . $session_data;
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;

        $this->ajax_pagination->initialize($config);

        $airlinematrixdata = $AirlineFilter = '';
        // debug($flight_data['airline_data']);
        foreach ($flight_data['airline_data'] as $airlinematrix) {

           if (in_array($airlinematrix->airline,$airline_data_valied)) {
        // debug($airline_data_valied);exit;
            
           }else{
            $airlinematrixdata .= '<div class="item">
				<a class="pricedates" id=' . str_replace(" ", "_", $airlinematrix->airline) . '>
					<div class="imgemtrx_plusmin">
						<img src="https://c.fareportal.com/n/common/air/ai/' . $airlinematrix->airline_code . '.gif"  alt=""/>
					 </div>
				   <div class="alsmtrx"><strong>' . $airlinematrix->airline . '</strong><span class="mtrxprice">' . $this->display_icon . ' ' . number_format(($airlinematrix->min_rate * $this->curr_val), 2) . '</span></div>
				 </a>
			  </div>';

           }
        $airline_data_valied[]=$airlinematrix->airline;
        }
        // debug($airlinematrixdata);exit;
        $data['flight_result'] = $this->Flight_Model->get_last_response($session_data, array('limit' => $this->perPage));
        if (!$data['flight_result']) {
            $data['message'] = "No Result Found";
        }
        $dataresult['airlinematrix'] = $airlinematrixdata;
        $dataresult['AirlineFilter'] = $AirlineFilter;
        // debug($dataresult);exit;
        $data['Req_before_decode'] = $Req_before_decode;
        $data['all_results'] = $results;
        $data['search_id'] = $search_request->search_id;
        $data['session_id'] = $session_data;
        if (in_array("return", array_column($data['flight_result'], 'type')))
        {
         // debug(array_column($data['flight_result'], 'type'));exit;       
        $dataresult['result'] = $this->load->view(PROJECT_THEME . '/flight/ajax_result_return', $data, true);
        }
        else
        {
                 
        $dataresult['result'] = $this->load->view(PROJECT_THEME . '/flight/ajax_result', $data, true);
        }
         
        // $dataresult['result'] = $this->load->view(PROJECT_THEME . '/flight/ajax_result', $data, true);

// debug($dataresult);exit;
        echo json_encode($dataresult);
    }

    function calculate_time_zone_duration($ddate, $adate, $dep_zone, $arv_zone) {
        $ddate = str_replace("T", " ", $ddate);
        $adate = str_replace("T", " ", $adate);
        $Change_clock = ($arv_zone) - ($dep_zone);
        if (!is_int($Change_clock)) {
            $Changeclock = explode(".", $Change_clock);
            $Changeclock0 = $Changeclock[0];
            if ($Changeclock0 > 0) {
                $Changeclock1 = ($Changeclock[1] * 6);
            } else {
                $Changeclock1 = (-1 * $Changeclock[1] * 6);
            }
        } else {
            $Changeclock0 = $Change_clock;
            $Changeclock1 = 0;
        }
        // echo $ddate." ".$dep_zone." ".$adate." ".$arv_zone." ".$Changeclock0." ".$Changeclock1."<br/>";
        $date_a = new DateTime($ddate);
        $date_b = new DateTime($adate);
        $interval = date_diff($date_a, $date_b);
        $hour = $interval->format('%h');
        $min = $interval->format('%i');
        $day1 = $interval->format('%d');
        $dur_in_min = ((($hour * 60) + $min) - (($Changeclock0 * 60) + $Changeclock1));
        $hour = FLOOR($dur_in_min / 60);
        $min = $dur_in_min % 60;
        // echo '<pre/>';print_r($interval);
        if ($hour < 0) {
            $hour = ((24) + ($hour));
            $day1 -= 1;
        } else {
            $day1 += floor(((($hour * 60) + $min) / 1440));
        }
        if ($min < 0) {
            $min = ((60) + ($min));
        }
        $hours = floor((($hour * 60) + $min) / 60);
        $minutes = ((($hour * 60) + $min) % 60);

        if ($hours > 24) {
            $hours = ($hours % 24);
        }
        if ($day1 > 0)
            $dur = $day1 . "d " . $hours . "h " . $minutes . "m";
        else
            $dur = $hours . "h " . $minutes . "m";
        return $dur;
    }

    function renderApiResponse($SearchResponse, $rand_id) {
        $flight_result = $this->xml2array($SearchResponse);

        $flightResult = array();
        $currency = '';
        if (!isset($_SESSION[$rand_id])) {
            // OneWay, RoundTrip, and MultiCity Module
            if (!isset($flight_result['soapenv:Envelope']['soapenv:Body']['Fare_MasterPricerTravelBoardSearchReply']['errorMessage'])) {
                if (isset($flight_result['soapenv:Envelope']['soapenv:Body']['Fare_MasterPricerTravelBoardSearchReply']))
                    $flightResult = $flight_result['soapenv:Envelope']['soapenv:Body']['Fare_MasterPricerTravelBoardSearchReply'];
            }
        } else {
            // Calendar Module
            if (!isset($flight_result['soapenv:Envelope']['soapenv:Body']['Fare_MasterPricerCalendarReply']['errorMessage'])) {
                if (isset($flight_result['soapenv:Envelope']['soapenv:Body']['Fare_MasterPricerCalendarReply']))
                    $flightResult = $flight_result['soapenv:Envelope']['soapenv:Body']['Fare_MasterPricerCalendarReply'];
            }
        }

        $flightIndex1 = array();
        $flightIndex = array();
        // debug($flightResult['recommendation']);die;
        if ($flightResult) {
            $currency = $flightResult['conversionRate']['conversionRateDetail']['currency'];
            // To Check the JourneyType: Oneway Or Roundtrip or Multicity or Calendar
            $flightIndex1 = $flightResult['flightIndex'];

            if (!isset($flightIndex1[0]))
                $flightIndex[0] = $flightIndex1;
            else
                $flightIndex = $flightIndex1;
            $flightIndexCount = count($flightIndex);
            for ($i = 0; $i < $flightIndexCount; $i++) { // No of Flight Records Loop
                $groupOfFlights = $flightIndex[$i]['groupOfFlights'];
                $groupOfFlightsCount = count($groupOfFlights);
                for ($f = 0; $f < ($groupOfFlightsCount); $f++) { // To Check the Flight Segment
                    $FlightSegment1 = array();
                    $FlightSegment = array();
                    $FlightSegment1 = $groupOfFlights[$f]['flightDetails'];

                    if (!isset($FlightSegment1[0]))
                        $FlightSegment[0] = $FlightSegment1;
                    else
                        $FlightSegment = $FlightSegment1;

                    for ($j = 0; $j < (count($FlightSegment)); $j++) {
                        $flightId = $groupOfFlights[$f]['propFlightGrDetail']['flightProposal'][0]['ref'];
                        $flightDetails1[$flightId]['Flight'][$i]['flightId'] = $groupOfFlights[$f]['propFlightGrDetail']['flightProposal'][0]['ref'];

                        $flightDetails1[$flightId]['Flight'][$i]['currency'] = $currency;
                        $flightDetails1[$flightId]['Flight'][$i]['stops'] = $j;
                        $flightDetails1[$flightId]['Flight'][$i]['FlightEft'] = $groupOfFlights[$f]['propFlightGrDetail']['flightProposal'][1]['ref'];
                        $flightDetails1[$flightId]['Flight'][$i]['dateOfDeparture'][$j] = $departureDate = $FlightSegment[$j]['flightInformation']['productDateTime']['dateOfDeparture'];
                        $flightDetails1[$flightId]['Flight'][$i]['timeOfDeparture'][$j] = $departureTime = $FlightSegment[$j]['flightInformation']['productDateTime']['timeOfDeparture'];
                        $flightDetails1[$flightId]['Flight'][$i]['dateOfArrival'][$j] = $arrivalDate = $FlightSegment[$j]['flightInformation']['productDateTime']['dateOfArrival'];
                        $flightDetails1[$flightId]['Flight'][$i]['timeOfArrival'][$j] = $arrivalTime = $FlightSegment[$j]['flightInformation']['productDateTime']['timeOfArrival'];
                        $flightDetails1[$flightId]['Flight'][$i]['flightOrtrainNumber'][$j] = $FlightSegment[$j]['flightInformation']['flightOrtrainNumber'];
                        $flightDetails1[$flightId]['Flight'][$i]['marketingCarrier'][$j] = $FlightSegment[$j]['flightInformation']['companyId']['marketingCarrier'];
                        $flightDetails1[$flightId]['Flight'][$i]['airlineName'][$j] = $this->Flight_Model->get_airline_name($FlightSegment[$j]['flightInformation']['companyId']['marketingCarrier']);

                        $flightDetails1[$flightId]['Flight'][$i]['DepartureDate'][$j] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-20" . (substr("$departureDate", -2)));
                        $flightDetails1[$flightId]['Flight'][$i]['ArrivalDate'][$j] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-20" . (substr("$arrivalDate", -2)));

                        $flightDetails1[$flightId]['Flight'][$i]['DepartureTime'][$j] = ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2)));
                        $flightDetails1[$flightId]['Flight'][$i]['ArrivalTime'][$j] = ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2)));

                        $eft_final = str_split($flightDetails1[$flightId]['Flight'][$i]['FlightEft'], 2);
                        $flightDetails1[$flightId]['Flight'][$i]['durationFinalEft'] = $eft_final[0] . " h " . $eft_final[1] . " min";
                        $pp = (($eft_final[0] * 60) + $eft_final[1]) * 60;
                        $pp1 = $this->ConvertSectoDay($pp);
                        $flightDetails1[$flightId]['Flight'][$i]['durationFinalEft'] = $pp1;
                        // $flightDetails1[$flightId]['Flight'][$i]['total_duration_final']
                        // Red Eye Feature
                        if ((($flightDetails1[$flightId]['Flight'][$i]['timeOfDeparture'][0]) <= "0700") && (($flightDetails1[$flightId]['Flight'][$i]['timeOfArrival'][$j]) >= "2000"))
                            $flightDetails1[$flightId]['Flight'][$i]['redEye'] = "Yes";
                        else
                            $flightDetails1[$flightId]['Flight'][$i]['redEye'] = "No";

                        // Diffrent Airport Feature
                        if ($flightDetails1[$flightId]['Flight'][$i]['marketingCarrier'][0] != $flightDetails1[$flightId]['Flight'][$i]['marketingCarrier'][$j])
                            $flightDetails1[$flightId]['Flight'][$i]['DiffrentAirport'] = "Yes";
                        else
                            $flightDetails1[$flightId]['Flight'][$i]['DiffrentAirport'] = "No";

                        // Short layover Time and Long Layover Time feature
                        if ($j != 0) {
                            $departureDateTimeLayover = new DateTime($flightDetails1[$flightId]['Flight'][$i]['DepartureDate'][$j] . " " . $flightDetails1[$flightId]['Flight'][$i]['DepartureTime'][$j]);
                            $arrivalDateTimeLayover = new DateTime($flightDetails1[$flightId]['Flight'][$i]['ArrivalDate'][($j - 1)] . " " . $flightDetails1[$flightId]['Flight'][$i]['ArrivalTime'][($j - 1)]);
                            $Layoverinterval = date_diff($arrivalDateTimeLayover, $departureDateTimeLayover);

                            $hour_layover = $Layoverinterval->format('%h');
                            $min_layover = $Layoverinterval->format('%i');
                            $dur_in_min_layover = (($hour_layover * 60) + $min_layover);
                            $flightDetails1[$flightId]['Flight'][$i]['LayoverDurationMins'] = $dur_in_min_layover;
                            $flightDetails1[$flightId]['Flight'][$i]['LayoverDurationText'] = $Layoverinterval->format('%h H %i M');
                            $flightDetails1[$flightId]['Flight'][$i]['LayoverDuration'][$j] = $Layoverinterval->format('%h H %i M');
                        }
                        // echo '<pre/>';print_r($FlightSegment[$j]);exit;
                        if (isset($FlightSegment[$j]['flightInformation']['companyId']['operatingCarrier'])) {
                            $flightDetails1[$flightId]['Flight'][$i]['operatingCarrier'][$j] = $FlightSegment[$j]['flightInformation']['companyId']['operatingCarrier'];
                        } else {
                            $flightDetails1[$flightId]['Flight'][$i]['operatingCarrier'][$j] = '';
                        }
                        // echo '<pre/>';print_r($FlightSegment);exit;
                        $flightDetails1[$flightId]['Flight'][$i]['locationIdDeparture'][$j] = $FlightSegment[$j]['flightInformation']['location'][0]['locationId'];
                        $flightDetails1[$flightId]['Flight'][$i]['locationIdArival'][$j] = $FlightSegment[$j]['flightInformation']['location'][1]['locationId'];

                        $dep_name = $this->Flight_Model->get_airport_cityname($flightDetails1[$flightId]['Flight'][$i]['locationIdDeparture'][$j]);
                        $arr_name = $this->Flight_Model->get_airport_cityname($flightDetails1[$flightId]['Flight'][$i]['locationIdArival'][$j]);
                        if (isset($flightDetails1[$flightId]['Flight'][$i]['DepartureAirport'][$j]))
                            $flightDetails1[$flightId]['Flight'][$i]['DepartureAirport'][$j] = $dep_name->city . ", " . $dep_name->country . " (" . $dep_name->city_code . ")";
                        if (isset($flightDetails1[$flightId]['Flight'][$i]['ArrivalAirport'][$j]))
                            $flightDetails1[$flightId]['Flight'][$i]['ArrivalAirport'][$j] = $arr_name->city . ", " . $arr_name->country . " (" . $arr_name->city_code . ")";

                        $dep_time_zone_offset = $this->Flight_Model->get_time_zone_details($flightDetails1[$flightId]['Flight'][$i]['locationIdDeparture'][$j]);
                        $arv_time_zone_offset = $this->Flight_Model->get_time_zone_details($flightDetails1[$flightId]['Flight'][$i]['locationIdArival'][$j]);
                        $flightDetails1[$flightId]['Flight'][$i]['dep_time_zone_offset'][$j] = $dep_time_zone_offset;
                        $flightDetails1[$flightId]['Flight'][$i]['arv_time_zone_offset'][$j] = $arv_time_zone_offset;

                        $flightDetails1[$flightId]['Flight'][$i]['equipmentType'][$j] = $FlightSegment[$j]['flightInformation']['productDetail']['equipmentType'];
                        $flightDetails1[$flightId]['Flight'][$i]['electronicTicketing'][$j] = $FlightSegment[$j]['flightInformation']['addProductDetail']['electronicTicketing'];
                        $flightDetails1[$flightId]['Flight'][$i]['productDetailQualifier'][$j] = $FlightSegment[$j]['flightInformation']['addProductDetail']['productDetailQualifier'];
                        // Time Zone Related Code
                        if (isset($flightDetails1[$flightId]['Flight'][$i]['dep_time_zone_offset'][$j]))
                            $dep_zone = explode(":", ($flightDetails1[$flightId]['Flight'][$i]['dep_time_zone_offset'][$j]));
                        if (isset($flightDetails1[$flightId]['Flight'][$i]['arv_time_zone_offset'][$j]))
                            $arv_zone = explode(":", ($flightDetails1[$flightId]['Flight'][$i]['arv_time_zone_offset'][$j]));

                        if ($flightId == 2) {
                            // print_r($dep_zone)." ".print_r($arv_zone);exit;
                        }
                        if (!empty($arv_zone)) {
                            $Change_clock = (($arv_zone[0] . "." . $arv_zone[1]) - ($dep_zone[0] . "." . $dep_zone[1]));
                            if (!is_int($Change_clock)) {
                                $Changeclock = explode(".", $Change_clock);
                                $Changeclock0 = $Changeclock[0];
                                if ($Changeclock0 > 0) {
                                    $Changeclock1 = ($Changeclock[1] * 6);
                                } else {
                                    $Changeclock1 = (-1 * $Changeclock[1] * 6);
                                }
                            } else {
                                $Changeclock0 = $Change_clock;
                                $Changeclock1 = 0;
                            }
                        }
                        $ddate = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-20" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
                        ;
                        $adate = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-20" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
                        $date_a = new DateTime($ddate);
                        $date_b = new DateTime($adate);
                        $interval = date_diff($date_a, $date_b);
                        $hour = $interval->format('%h');
                        $min = $interval->format('%i');
                        $day1 = $interval->format('%d');
                        $dur_in_min = ((($hour * 60) + $min) - (($Changeclock0 * 60) + $Changeclock1));
                        $hour = FLOOR($dur_in_min / 60);
                        $min = $dur_in_min % 60;

                        if ($hour < 0) {
                            $hour = ((24) + ($hour));
                        }
                        if ($min < 0) {
                            $min = ((60) + ($min));
                        }

                        $day = floor(((($hour * 60) + $min) / 1440));
                        $hours = floor((($hour * 60) + $min) / 60);
                        $minutes = ((($hour * 60) + $min) % 60);

                        if ($hours > 24) {
                            $hours = ($hours % 24);
                        }


                        if ($day1 > 0)
                            $duration_time_zone = $day1 . " D " . $hours . " h " . $minutes . " min";
                        else
                            $duration_time_zone = $hours . " h " . $minutes . " min";

                        $flightDetails1[$flightId]['Flight'][$i]['duration_time_zone'][$j] = $duration_time_zone;
                        $flightDetails1[$flightId]['Flight'][$i]['Clock_Changes'][$j] = $Change_clock;
                        $flightDetails1[$flightId]['Flight'][$i]['dur_in_min_time_zone'][$j] = $dur_in_min;
                    }
                }
            }

            $x = 0;
            $recommendation = array();
            if (isset($flightResult['recommendation'][0]))
                $recommendation = $flightResult['recommendation'];
            else
                $recommendation[0] = $flightResult['recommendation'];
            foreach ($recommendation as $p => $s) {

                if (isset($s['itemNumber']['itemNumberId']['numberType'])) {
                    $price = $p;
                    $flag = "MTK";
                } else {
                    $price = 0;
                    $flag = "Normal";
                }
                $segmentFlightRef = array();
                if (isset($s['segmentFlightRef'][0]))
                    $segmentFlightRef = $s['segmentFlightRef'];
                else
                    $segmentFlightRef[0] = $s['segmentFlightRef'];
                // debug($segmentFlightRef);die;
                for ($sfr = 0; $sfr < (count($segmentFlightRef)); $sfr++) {
                    $referencingDetail = array();
                    if (isset($segmentFlightRef[$sfr]['referencingDetail'][0]))
                        $referencingDetail = $segmentFlightRef[$sfr]['referencingDetail'];
                    else
                        $referencingDetail[0] = $segmentFlightRef[$sfr]['referencingDetail'];
                    // debug($referencingDetail);die;
                    for ($rd = 0; $rd < (count($referencingDetail)); $rd++) {
                        $refNumber = $referencingDetail[$rd]['refNumber'] . "-" . $flag . "-" . $p;
                        $refNumberFlight = $referencingDetail[$rd]['refNumber'];
                        $refQualifier = $referencingDetail[$rd]['refQualifier'];

                        if (isset($s['itemNumber']['itemNumberId']['numberType'])) {
                            $flightDetails[$refNumber][$price]['PriceInfo']['MultiTicket'] = "Yes";
                            // $flightDetails[$refNumber][$p]['PriceInfo']['MultiTicket_type']      = $s['itemNumber']['itemNumberId']['numberType'];
                            $flightDetails[$refNumber][$price]['PriceInfo']['MultiTicket_number'] = $s['itemNumber']['itemNumberId']['number'];
                        } else {
                            $flightDetails[$refNumber][$price]['PriceInfo']['MultiTicket'] = "No";
                            $flightDetails[$refNumber][$price]['PriceInfo']['MultiTicket_number'] = $s['itemNumber']['itemNumberId']['number'];
                        }

                        // $flightDetails[$refNumber][$price]['baggage_amadeus_APIinfo']['baggage']             = $baggage_amadeus_APIinfo;
                        $flightDetails[$refNumber][$price]['PriceInfo']['refQualifier'] = $refQualifier;
                        $flightDetails[$refNumber][$price]['PriceInfo']['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount'];
                        $flightDetails[$refNumber][$price]['PriceInfo']['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount'];

                        $paxFareProduct = array();
                        if (isset($s['paxFareProduct'][0]))
                            $paxFareProduct = $s['paxFareProduct'];
                        else
                            $paxFareProduct[0] = $s['paxFareProduct'];
                        for ($pfp = 0; $pfp < (count($paxFareProduct)); $pfp++) {
                            $paxReference = array();
                            if (isset($paxFareProduct[$pfp]['paxReference']['traveller'][0]))
                                $paxReference = $paxFareProduct[$pfp]['paxReference']['traveller'];
                            else
                                $paxReference[0] = $paxFareProduct[$pfp]['paxReference']['traveller'];
                            $flightDetails[$refNumber][$price]['PriceInfo']['passengerType'] = $passengerType = $paxFareProduct[$pfp]['paxReference']['ptc'];
                            for ($pr = 0; $pr < (count($paxReference)); $pr++) {
                                $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['count'] = ($pr + 1);
                            }

                            $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['totalFareAmount'] = $paxFareProduct[$pfp]['paxFareDetail']['totalFareAmount'];
                            $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['totalTaxAmount'] = $paxFareProduct[$pfp]['paxFareDetail']['totalTaxAmount'];
                            if (isset($paxFareProduct[$pfp]['paxFareDetail']['codeShareDetails']['transportStageQualifier'])) {
                                $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['transportStageQualifier'] = $paxFareProduct[$pfp]['paxFareDetail']['codeShareDetails']['transportStageQualifier'];
                            } else {
                                $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['transportStageQualifier'] = '';
                            }
                            if (isset($paxFareProduct[$pfp]['paxFareDetail']['codeShareDetails']['company'])) {
                                $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['company'] = $paxFareProduct[$pfp]['paxFareDetail']['codeShareDetails']['company'];
                            } else {
                                $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['company'] = '';
                            }


                            $fare = array();
                            if (isset($paxFareProduct[$pfp]['fare'][0]))
                                $fare = $paxFareProduct[$pfp]['fare'];
                            else
                                $fare[0] = $paxFareProduct[$pfp]['fare'];

                            for ($fa = 0; $fa < (count($fare)); $fa++) {
                                $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['fare'][$fa]['description'] = '';
                                $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['fare'][$fa]['textSubjectQualifier'] = $fare[$fa]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['fare'][$fa]['informationType'] = $fare[$fa]['pricingMessage']['freeTextQualification']['informationType'];
                                $description = array();
                                if (is_array($fare[$fa]['pricingMessage']['description']))
                                    $description = $fare[$fa]['pricingMessage']['description'];
                                else
                                    $description[0] = $fare[$fa]['pricingMessage']['description'];
                                $flightDetails[$refNumber][$price]['PriceInfo']['fare'][$fa]['description'] = '';
                                for ($d = 0; $d < count($description); $d++) {
                                    if (isset($description[$d]))
                                        $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['fare'][$fa]['description'] .= $description[$d] . " - ";
                                }
                            }
                            $fareDetails = array();
                            if (isset($paxFareProduct[$pfp]['fareDetails'][0]))
                                $fareDetails = $paxFareProduct[$pfp]['fareDetails'];
                            else
                                $fareDetails[0] = $paxFareProduct[$pfp]['fareDetails'];
                            for ($fd = 0; $fd < (count($fareDetails)); $fd++) {
                                $flightDetails[$refNumber][$price]['PriceInfo']['fareDetails'][$fd]['flightMtkSegRef'] = $fareDetails[$fd]['segmentRef']['segRef'];
                                $flightDetails[$refNumber][$price]['PriceInfo']['fareDetails'][$fd]['designator'] = $fareDetails[$fd]['majCabin']['bookingClassDetails']['designator'];
                                $groupOfFares = array();
                                if (isset($fareDetails[$fd]['groupOfFares'][0]))
                                    $groupOfFares = $fareDetails[$fd]['groupOfFares'];
                                else
                                    $groupOfFares[0] = $fareDetails[$fd]['groupOfFares'];
                                for ($gf = 0; $gf < (count($groupOfFares)); $gf++) {
                                    $flightDetails[$refNumber][$price]['PriceInfo']['fareDetails'][$fd]['rbd'][$gf] = $groupOfFares[$gf]['productInformation']['cabinProduct']['rbd'];
                                    $flightDetails[$refNumber][$price]['PriceInfo']['fareDetails'][$fd]['cabin'][$gf] = $groupOfFares[$gf]['productInformation']['cabinProduct']['cabin'];
                                    $flightDetails[$refNumber][$price]['PriceInfo']['fareDetails'][$fd]['avlStatus'][$gf] = $groupOfFares[$gf]['productInformation']['cabinProduct']['avlStatus'];
                                    $flightDetails[$refNumber][$price]['PriceInfo']['fareDetails'][$fd]['breakPoint'][$gf] = $groupOfFares[$gf]['productInformation']['breakPoint'];
                                    $flightDetails[$refNumber][$price]['PriceInfo']['fareDetails'][$fd]['fareType'][$gf] = $groupOfFares[$gf]['productInformation']['fareProductDetail']['fareType'];
                                }
                            }
                        }
                    }
                }
            }
            // debug($referencingDetail);die;

            foreach ($recommendation as $p => $s) {
                // debug($s);die;
                if (isset($s['itemNumber']['itemNumberId']['numberType'])) {
                    $price = $p;
                    $flag = "MTK";
                } else {
                    $price = 0;
                    $flag = "Normal";
                }
                $segmentFlightRef = array();
                if (isset($s['segmentFlightRef'][0]))
                    $segmentFlightRef = $s['segmentFlightRef'];
                else
                    $segmentFlightRef[0] = $s['segmentFlightRef'];
                for ($sfr = 0; $sfr < (count($segmentFlightRef)); $sfr++) {
                    $referencingDetail = array();
                    if (isset($segmentFlightRef[$sfr]['referencingDetail'][0]))
                        $referencingDetail = $segmentFlightRef[$sfr]['referencingDetail'];
                    else
                        $referencingDetail[0] = $segmentFlightRef[$sfr]['referencingDetail'];
                    for ($rd = 0; $rd < (count($referencingDetail)); $rd++) {
                        $refNumber = $referencingDetail[$rd]['refNumber'] . "-" . $flag . "-" . $p;
                        $refNumberFlight = $referencingDetail[$rd]['refNumber'];
                        $refQualifier = $referencingDetail[$rd]['refQualifier'];
                        $baggage_amadeus_info = '';
                        $baggage_amadeus_APIinfo = '';
                        if ($refQualifier == 'B') {
                            // debug($flightResult['serviceFeesGrp']['freeBagAllowanceGrp']);die;
                            // $baggage_amadeus_info = $flightResult['serviceFeesGrp']['freeBagAllowanceGrp'];
                            if (isset($flightResult['serviceFeesGrp']['freeBagAllowanceGrp'][0])) {
                                $baggage_amadeus_info = $flightResult['serviceFeesGrp']['freeBagAllowanceGrp'];
                            } else {
                                $baggage_amadeus_info[0] = $flightResult['serviceFeesGrp']['freeBagAllowanceGrp'];
                            }
                            foreach ($baggage_amadeus_info as $abkey => $abvalue) {
                                // debug($rd);
                                // debug($refNumberFlight);
                                // debug($abvalue);die;
                                if ($abvalue['itemNumberInfo']['itemNumberDetails']['number'] == $refNumberFlight) {
                                    if ($abvalue['freeBagAllownceInfo']['baggageDetails']['quantityCode'] == 'W') {
                                        if ($abvalue['freeBagAllownceInfo']['baggageDetails']['freeAllowance'] > 1) {
                                            $FinalResult[$x]['FlightDetails'][0]['baggage'][$abkey] = $abvalue['freeBagAllownceInfo']['baggageDetails']['freeAllowance'] . " Kgs";
                                        } else {
                                            $FinalResult[$x]['FlightDetails'][0]['baggage'][$abkey] = $abvalue['freeBagAllownceInfo']['baggageDetails']['freeAllowance'] . " Kg";
                                        }
                                    } else {
                                        if ($abvalue['freeBagAllownceInfo']['baggageDetails']['freeAllowance'] > 1) {
                                            $FinalResult[$x]['FlightDetails'][0]['baggage'][$abkey] = $abvalue['freeBagAllownceInfo']['baggageDetails']['freeAllowance'] . " Pieces";
                                        } else {
                                            $FinalResult[$x]['FlightDetails'][0]['baggage'][$abkey] = $abvalue['freeBagAllownceInfo']['baggageDetails']['freeAllowance'] . " Piece";
                                        }
                                    }
                                }
                            }
                        }
                        $FinalResult[$x]['FlightDetailsID'] = $x;
                        $FinalResult[$x]['FlightDetails'][$rd] = $flightDetails1[$refNumberFlight]['Flight'][$rd];
                        // $FinalResult[$x]['FlightDetails'][$rd]['baggage']  = $baggage_amadeus_APIinfo;
                    }

                    $priceDetailsfinal = array();
                    foreach ($flightDetails[$refNumber] as $price)
                        $priceDetailsfinal[] = $price;

                    $FinalResult[$x]['PricingDetails'] = $priceDetailsfinal;

                    if (!isset($s['paxFareProduct'][0])) {
                        $paxFareProduct[0] = $s['paxFareProduct'];
                    } else {
                        $paxFareProduct = $s['paxFareProduct'];
                    }
                    $FinalResult[$x]['paxFareProduct'] = $paxFareProduct;
                    $specificRecDetails = '';



                    if (!empty($s['specificRecDetails'])) {

                        if (isset($s['specificRecDetails'][0]))
                            $specificRecDetails1 = $s['specificRecDetails'][0];
                        else
                            $specificRecDetails1 = $s['specificRecDetails'];


                        //$detail = base_64encode($s['specificRecDetails']);
                        //    echo "recommendation11<pre>"; print_r($s['specificRecDetails']); echo "</pre>"; 

                        if (isset($specificRecDetails1['specificProductDetails'][0]))
                            $specificRecDetails12 = $specificRecDetails1['specificProductDetails'][0];
                        else
                            $specificRecDetails12 = $specificRecDetails1['specificProductDetails'];


                        $specificRecDetails = $specificRecDetails12['fareContextDetails']['cnxContextDetails']['0']['fareCnxInfo']['contextDetails']['availabilityCnxType'];

                        $FinalResult[$x]['specificRecDetails'] = $specificRecDetails;

                        /* echo "<pre>";
                          print_r ($FinalResult[$x]);
                          echo "</pre>";exit("1272"); */
                    }


                    $x++;
                }
            }
        } else {
            //if there is no result
            $FinalResult = array();
        }

        // echo "<pre>"; print_r($FinalResult); echo "</pre>"; exit("1285");

        return $data['flight_result'] = $FinalResult;
    }

    function ConvertSectoDay($n) {
        $dt1 = new DateTime("@0");
        $dt2 = new DateTime("@$n");
        return $dt1->diff($dt2)->format('%a d: %h h: %i m');
    }

    function xml2array($xmlStr, $get_attributes = 1, $priority = 'tag') {
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
                } else {
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
                } else {
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

    function dateformatAMD($dateval, $timeval) {
        $day = substr($dateval, 0, 2);
        $mon = substr($dateval, 2, 2);
        $year = "20" . substr($dateval, 4, 2);
        $hour = substr($timeval, 0, 2);
        $min = substr($timeval, 2, 2);
        $newdate = $year . '-' . $mon . '-' . $day . 'T' . $hour . ':' . $min . ':00';
        return $newdate;
    }

    function show_flight_details_ajax_calender() {
        $flightdetails = $this->input->post('flightdetails');
        $flight_id = $this->input->post('flight_id');
        $rand_id = $this->input->post('rand_id');
        $search_id = $this->input->post('search_id');


        $data['flight_details'] = json_decode(base64_decode($flightdetails), 1);
        $data['flight_id_details'] = json_decode(base64_decode($flight_id), 1);
        $data['flight_data'] = $flightdetails;
        $data['flight_id_data'] = $flight_id;
        $data['rand_id'] = $rand_id;
        $data['search_id'] = $search_id;
        // echo "<pre/>";print_r($data);exit();

        $flight = $this->load->view(PROJECT_THEME . '/flight/ajax_flight_details_calender', $data, true);
        echo ($flight);
    }

    function call_iternary($idval) {
        $data['result'] = $this->Flight_Model->get_flight_data_segments($idval);
        $data['request_scenario'] = json_decode($data['result']->request_scenario);
        $data['idval'] = $idval;
        $segment_data = $data['result']->segment_data;
        $PricingDetails = $data['result']->PricingDetails;
        $fare_rule_xml_res = Get_Fare_Rule1($segment_data, $PricingDetails);
        if (true) {
            $fare_details = json_decode($data['result']->all_results, true);
            $fare_rule_data['origin'] = $data['result']->origin;
            $fare_rule_data['destination'] = $data['result']->destination;
            $fare_rule_data['date'] = date("dmy");
            if (array_key_exists("company", $fare_details[0]['paxFareDetail']['codeShareDetails']))
                $fare_rule_data['carrier'] = $fare_details[0]['paxFareDetail']['codeShareDetails']['company'];
            else
                $fare_rule_data['carrier'] = $fare_details[0]['paxFareDetail']['codeShareDetails'][0]['company'];

            $fare_rule_data['farebasis'] = $fare_details[0]['fareDetails'][0]['groupOfFares'][0]['productInformation']['fareProductDetail']['fareBasis'];
            if (!array_key_exists("groupOfFares", $fare_details[0]['fareDetails'])) {
                if (!array_key_exists("productInformation", $fare_details[0]['fareDetails'][0]['groupOfFares']))
                    $fare_rule_data['farebasis'] = $fare_details[0]['fareDetails'][0]['groupOfFares'][0]['productInformation']['fareProductDetail']['fareBasis'];
                else
                    $fare_rule_data['farebasis'] = $fare_details[0]['fareDetails'][0]['groupOfFares']['productInformation']['fareProductDetail']['fareBasis'];
            } else {
                if (!array_key_exists("productInformation", $fare_details[0]['fareDetails'][0]['groupOfFares']))
                    $fare_rule_data['farebasis'] = $fare_details[0]['fareDetails']['groupOfFares'][0]['productInformation']['fareProductDetail']['fareBasis'];
                else
                    $fare_rule_data['farebasis'] = $fare_details[0]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareBasis'];
            }
            $fare_rule_xml_res = Get_Fare_Rule($fare_rule_data);
            $fare_rule_details = $this->render_fare_rule_response($this->xml2array($fare_rule_xml_res['FareRule_SearchRes']));
            $data['fare_rule_details'] = $fare_rule_details;
            $this->load->view(PROJECT_THEME . '/flight/flight_details', $data);
        }
    }

    /* Tbo New start */

    function call_iternary_t($idval) {
        $data['result'] = $this->Flight_Model->get_flight_data_segments($idval);
        // debug($data);exit;
        $data['request_scenario'] = json_decode($data['result']->request_scenario);
        $data['idval'] = $idval;

        if (true) {
            $fare_details = json_decode($data['result']->all_results, true);
            $farerule_data=fare_rule_t($fare_details['TokenId'],$fare_details['TraceId'],$fare_details['ResultIndex']);
            $data['fare_rule_details'] = $farerule_data;
            // debug($data['fare_rule_details']);exit();
            $this->load->view(PROJECT_THEME . '/flight/flight_details_tbo', $data);
        }
    }

    /* Tbo new end */

    function render_fare_rule_response($response) {
        // debug($response);die;
        $fare_ruleResult = array();
        if (!isset($response['soapenv:Envelope']['soapenv:Body']['Fare_GetFareRulesReply']['errorInfo'])) {
            if (isset($response['soapenv:Envelope']['soapenv:Body']['Fare_GetFareRulesReply']))
                $fare_ruleResult = $response['soapenv:Envelope']['soapenv:Body']['Fare_GetFareRulesReply'];
        }

        $fare_ruleResult1 = array();
        foreach ($fare_ruleResult['tariffInfo'] as $key => $val) {
            $index_name = explode('.', $val['fareRuleText'][0]['freeText'])[1];
            $fare_ruleResult1[$index_name] = '';
            foreach ($val['fareRuleText'] as $text_key => $text_val) {
                $fare_ruleResult1[$index_name] .= ' ';
                if ($text_key == 0)
                    continue;
                if (empty($text_val['freeText']))
                    continue;
                $fare_ruleResult1[$index_name] .= trim($text_val['freeText']);
            }
        }

        return $fare_ruleResult1;
    }

    public function addToCart($uid = '') {
        if ($uid != '') {
            $uid_v1 = json_decode(base64_decode($uid));
            $uid = $uid_v1->id;
            $session_id = $uid_v1->sessionid;
            $fareBasis = $uid_v1->fareBasis;
            $result = $this->Flight_Model->get_flight_data_segments($uid);
            $pricedetails=json_decode($result->PricingDetails);
            // debug($result);die;
            if ($result != '') {
                $RoutingId = $result->routing_id;
                $this->Flight_Model->insert_flight_data_segments_to_query_table($result->segment_data);
                $segment_data = json_decode($result->segment_data, 1);

                // echo "<pre/>";
                // print_r($segment_data);
                // exit();

                #debug($segment_data);die;
                if ($result->api_name == 'AMADEUS') {
                    $api_id = 1;
                    $out_count = (count($segment_data[0]['DepartureDate']) - 1 );
                    $out_DepartDate = $segment_data[0]['DepartureDate'][0];
                    $out_ArriveDate = $segment_data[0]['ArrivalDate'][$out_count];

                    if (isset($segment_data[1]['flightId']) && $segment_data[1]['flightId'] != '') {
                        $in_count = (count($segment_data[1]['DepartureDate']) - 1 );
                        $in_DepartDate = $segment_data[1]['DepartureDate'][0];
                        $in_ArriveDate = $segment_data[1]['ArrivalDate'][$in_count];
                        $modee = 'ROUNDTRIP';
                    } else {
                        $modee = 'ONEWAY';
                        $in_DepartDate = '';
                        $in_ArriveDate = '';
                    }
                } elseif ($result->api_name == 'TBO') {
                    $api_id = 2;
                    $out_count = (count($segment_data[0]) - 1 );
                    $dep1 = explode('T', $segment_data[0][0]['Origin']['DepTime']);
                    $out_DepartDate = $dep1[0];
                    $arr1 = explode('T', $segment_data[0][$out_count]['Destination']['ArrTime']);
                    $out_ArriveDate = $dep1[0];
                    if (isset($segment_data[1]) && $segment_data[1][0]['FlightStatus'] == 'Confirmed') {
                        $in_count = (count($segment_data[1]) - 1 );
                        $dep1 = explode('T', $segment_data[1][0]['Origin']['DepTime']);
                        $in_DepartDate = $dep1[0];
                        $arr1 = explode('T', $segment_data[1][$out_count]['Destination']['ArrTime']);
                        $in_ArriveDate = $dep1[0];
                        $modee = 'ROUNDTRIP';
                    } else {
                        $modee = 'ONEWAY';
                        $in_DepartDate = '';
                        $in_ArriveDate = '';
                    }
                }



                $cart_flight = array(
                    'session_id' => $session_id,
                    'origin' => $result->origin,
                    'destination' => $result->destination,
                    'origin_city' => $this->Flight_Model->get_airport_cityname($result->origin),
                    'destination_city' => $this->Flight_Model->get_airport_cityname($result->destination),
                    'origin_airport' => $this->Flight_Model->get_airport_name($result->origin),
                    'destination_airport' => $this->Flight_Model->get_airport_name($result->destination),
                    'mode' => $result->trip_type,
                    'outward_departure' => $out_DepartDate,
                    'outward_arrival' => $out_ArriveDate,
                    'inward_depature' => $in_DepartDate,
                    'inward_arrival' => $in_ArriveDate,
                    'outward_duration' => $result->onwards_duration,
                    'inward_duration' => $result->returns_duration,
                    'airline' => $result->airline,
                    'outward_stops' => $result->onwards_stops,
                    'inward_stops' => $result->returns_stops,
                    'amount' => $result->amount,
                    'api_tax' => $pricedetails->Tax,
                    'segment_data' => $result->segment_data,
                    'PricingDetails' => $result->PricingDetails,
                    'airline_image' => 'https://www.amadeus.net/static/img/static/airlines/medium/' . $result->airline_code . '.png',
                    'admin_markup' => $result->admin_markup,
                    'admin_baseprice' => $pricedetails->BaseFare,
                    'my_markup' => $result->agent_markup,
                    'site_currency' => BASE_CURRENCY,
                    'api_currency' => $result->api_currency,
                    'request_scenario' => $result->request_scenario,
                    'api_id' => $api_id,
                    'fareBasis' => $fareBasis,
                    'specific_rec_details' => $result->specific_rec_details,
                    'bundle_search_id' => @$result->bundle_search_id
                );

                if ($result->bundle_search_id != '' || $result->bundle_search_id == 0) {
                    $booking_cart_id = $this->Flight_Model->delete_cart_flight($result->bundle_search_id);
                }

                	// echo "<pre/>";print_r($cart_flight);exit("1185");
                $booking_cart_id = $this->Flight_Model->insert_cart_flight($cart_flight);

                if ($this->session->userdata('user_id')) {
                    $user_type = $this->session->userdata('user_type');
                    $user_id = $this->session->userdata('user_id');
                } else {
                    $user_type = '';
                    $user_id = '';
                }
                $cart_global = array(
                    'parent_cart_id' => 0,
                    'referal_id' => $booking_cart_id,
                    'product_id' => '1',
                    'user_type' => $user_type,
                    'user_id' => $user_id,
                    'session_id' => $session_id,
                    'site_currency' => BASE_CURRENCY,
                    'total_cost' => $result->amount,
                    'bundle_search_id' => @$result->bundle_search_id,
                    'ip_address' => $this->input->ip_address(),
                    'timestamp' => date('Y-m-d H:i:s')
                );
                if ($result->bundle_search_id != '' || $result->bundle_search_id == 0) {
                    $booking_cart_id = $this->Flight_Model->delete_cart_global($result->bundle_search_id);
                }
                $cart_global_id = $this->Flight_Model->insert_cart_global($cart_global);
                /* $request = $this->custom_db->single_table_records('search_history', '', array('origin' => $result->bundle_search_id));
                  $fs = json_decode($request['data'][0]['search_data'], true);
                 */
                $data['status'] = 1;
                $data['isCart'] = true;
                $search_module_id = $uid_v1->search_id;
                $search_module = $uid_v1->search_module;
                $data['C_URL'] = WEB_URL . 'booking/' . $session_id . '/' . $search_module_id . '/' . $search_module;
            } else {
                $data['isCart'] = false;
            }
            echo json_encode($data);
        }
    }
     public function addToCartReturn($uid = '') {
        if ($uid != '') {
            $uid_v1 = json_decode(base64_decode($uid));
            $uid = $uid_v1->id;
            $session_id = $uid_v1->sessionid;
            $fareBasis = $uid_v1->fareBasis;
            $result['data'] = $this->Flight_Model->get_flight_data_segments($uid);
            if (!empty($result['data'])) {
                if ($result['data']->type == 'onward') {   
                    unset($_SESSION['this_form']);                  
                    $newdata = array(
                    'uid_v1'  => $uid_v1,
                    'uid'     => $uid                
                    );
                    $_SESSION['this_form'] = $newdata;   
                 }else{
                    unset($_SESSION['this_to']);                  
                    $newdata = array(
                    'uid_v1'  => $uid_v1,
                    'uid'     => $uid                
                    );
                    $_SESSION['this_to'] = $newdata;  
                 } 
                $uid=array($_SESSION['this_form']['uid'],$_SESSION['this_to']['uid']);
            unset($result['data']); 
            $result['onward'] = $this->Flight_Model->get_flight_data_segments_r($uid);
            }
            $result['search_id'] =$uid_v1->search_id;

            
            // $pricedetails=json_decode($result['PricingDetails']);            
              // debug($result);exit;
            $dataresult['result'] = $this->load->view(PROJECT_THEME . '/flight/connection_return', $result, true);  
            echo json_encode($dataresult['result']);
            // exit;
           
        }
    }
        public function addToCartfinal($uidd = '') {
        if ($uidd != '') {
            $uid_v1 = json_decode(base64_decode($uidd));
            $uid = $uid_v1->id;
            $session_id = $uid_v1->sessionid;
            $fareBasis = $uid_v1->fareBasis;
            $results = $this->Flight_Model->get_flight_data_segments_f($uid);
            // debug($results);exit;
            if (is_array($results)) {
                foreach ($results as $key => $result) {                    
                // debug($results);exit;
                $pricedetails=json_decode($result->PricingDetails);                
                    $RoutingId = $result->routing_id;
                    $this->Flight_Model->insert_flight_data_segments_to_query_table($result->segment_data);
                    $segment_data = json_decode($result->segment_data, 1);                    
                    if ($result->api_name == 'AMADEUS') {
                        $api_id = 1;
                        $out_count = (count($segment_data[0]['DepartureDate']) - 1 );
                        $out_DepartDate = $segment_data[0]['DepartureDate'][0];
                        $out_ArriveDate = $segment_data[0]['ArrivalDate'][$out_count];

                        if (isset($segment_data[1]['flightId']) && $segment_data[1]['flightId'] != '') {
                            $in_count = (count($segment_data[1]['DepartureDate']) - 1 );
                            $in_DepartDate = $segment_data[1]['DepartureDate'][0];
                            $in_ArriveDate = $segment_data[1]['ArrivalDate'][$in_count];
                            $modee = 'ROUNDTRIP';
                        } else {
                            $modee = 'ONEWAY';
                            $in_DepartDate = '';
                            $in_ArriveDate = '';
                        }
                    } elseif ($result->api_name == 'TBO') {
                        $api_id = 2;
                        $out_count = (count($segment_data[0]) - 1 );
                        $dep1 = explode('T', $segment_data[0][0]['Origin']['DepTime']);
                        $out_DepartDate = $dep1[0];
                        $arr1 = explode('T', $segment_data[0][$out_count]['Destination']['ArrTime']);
                        $out_ArriveDate = $dep1[0];
                        if (isset($segment_data[1]) && $segment_data[1][0]['FlightStatus'] == 'Confirmed') {
                            $in_count = (count($segment_data[1]) - 1 );
                            $dep1 = explode('T', $segment_data[1][0]['Origin']['DepTime']);
                            $in_DepartDate = $dep1[0];
                            $arr1 = explode('T', $segment_data[1][$out_count]['Destination']['ArrTime']);
                            $in_ArriveDate = $dep1[0];
                            $modee = 'ROUNDTRIP';
                        } else {
                            $modee = 'ONEWAY';
                            $in_DepartDate = '';
                            $in_ArriveDate = '';
                        }
                    }



                    $cart_flight = array(
                        'session_id' => $session_id[$key],
                        'origin' => $result->origin,
                        'destination' => $result->destination,
                        'origin_city' => $this->Flight_Model->get_airport_cityname($result->origin),
                        'destination_city' => $this->Flight_Model->get_airport_cityname($result->destination),
                        'origin_airport' => $this->Flight_Model->get_airport_name($result->origin),
                        'destination_airport' => $this->Flight_Model->get_airport_name($result->destination),
                        'mode' => $result->trip_type,
                        'outward_departure' => $out_DepartDate,
                        'outward_arrival' => $out_ArriveDate,
                        'inward_depature' => $in_DepartDate,
                        'inward_arrival' => $in_ArriveDate,
                        'outward_duration' => $result->onwards_duration,
                        'inward_duration' => $result->returns_duration,
                        'airline' => $result->airline,
                        'outward_stops' => $result->onwards_stops,
                        'inward_stops' => $result->returns_stops,
                        'amount' => $result->amount,
                        'api_tax' => $pricedetails->Tax,
                        'segment_data' => $result->segment_data,
                        'PricingDetails' => $result->PricingDetails,
                        'airline_image' => 'https://www.amadeus.net/static/img/static/airlines/medium/' . $result->airline_code . '.png',
                        'admin_markup' => $result->admin_markup,
                        'admin_baseprice' => $pricedetails->BaseFare,
                        'my_markup' => $result->agent_markup,
                        'site_currency' => BASE_CURRENCY,
                        'api_currency' => $result->api_currency,
                        'request_scenario' => $result->request_scenario,
                        'api_id' => $api_id,
                        'fareBasis' => $fareBasis,
                        'specific_rec_details' => $result->specific_rec_details,
                        'bundle_search_id' => @$result->bundle_search_id
                    );
                    if ($key==0) {                        
                    if ($result->bundle_search_id != '' || $result->bundle_search_id == 0) {
                        $booking_cart_id = $this->Flight_Model->delete_cart_flight($result->bundle_search_id);
                    }
                    }

                        // echo "<pre/>";print_r($cart_flight);exit("1185");
                    $booking_cart_id = $this->Flight_Model->insert_cart_flight($cart_flight);

                    if ($this->session->userdata('user_id')) {
                        $user_type = $this->session->userdata('user_type');
                        $user_id = $this->session->userdata('user_id');
                    } else {
                        $user_type = '';
                        $user_id = '';
                    }
                    $cart_global = array(
                        'parent_cart_id' => 0,
                        'referal_id' => $booking_cart_id,
                        'product_id' => '1',
                        'user_type' => $user_type,
                        'user_id' => $user_id,
                        'session_id' => $session_id[$key],
                        'site_currency' => BASE_CURRENCY,
                        'total_cost' => $result->amount,
                        'bundle_search_id' => @$result->bundle_search_id,
                        'ip_address' => $this->input->ip_address(),
                        'timestamp' => date('Y-m-d H:i:s')
                    );
                    if ($key==0) {                        
                        if ($result->bundle_search_id != '' || $result->bundle_search_id == 0) {
                            $booking_cart_id = $this->Flight_Model->delete_cart_global($result->bundle_search_id);
                        }
                    }
                    $cart_global_id = $this->Flight_Model->insert_cart_global($cart_global);
                    /* $request = $this->custom_db->single_table_records('search_history', '', array('origin' => $result->bundle_search_id));
                      $fs = json_decode($request['data'][0]['search_data'], true);
                     */
                    $data['status'] = 1;
                    $data['isCart'] = true;
                    $search_module_id = $uid_v1->search_id;
                    $search_module = $uid_v1->search_module;
            // debug($data);exit;
                }
                    $data['C_URL'] = WEB_URL . 'booking/' . $uidd . '/domestic_flight/'.$search_module;
            } else {
            // debug($data);exit;
                $data['isCart'] = false;
            }
            echo json_encode($data);
        }
    }

    public function generate_rand_no($length = 24) {
        $alphabets = range('A', 'Z');
        $numbers = range('0', '9');
        $final_array = array_merge($alphabets, $numbers);
        //$id = date("ymd").date("His");
        $id = '';
        while ($length--) {
            $key = array_rand($final_array);
            $id .= $final_array[$key];
        }
        return $id;
    }

    function ajaxPaginationData($session_data) {
        //echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die();


        $page = $this->input->post('page');
        $offset = (!$page) ? 0 : $page;

        //What ever the filtering data comes here
        $data = json_decode($this->input->post('filter'), true);
        // print_r($data);die();
        list($from_amt, $to_amt) = explode('-', $data['amount']);
        $from_amt = (int) trim(str_replace($this->display_icon, '', $from_amt));
        $to_amt = (int) trim(str_replace($this->display_icon, '', $to_amt));

        $amount_filter['Amount >='] = floor(($from_amt / $this->curr_val));
        $amount_filter['Amount <='] = ceil($to_amt / $this->curr_val);
        // echo "<pre/>";print_r($amount_filter);die;
        if ($data['airline'] != '') {
            for ($a = 0; $a < count($data['airline']); $a++) {
                $data['airline'][$a] = str_replace("_", " ", $data['airline'][$a]);
            }
        }
        $airline_filter = count($data['airline']) > 0 ? $data['airline'] : NULL;
        //debug($airline_filter);exit;
        if ($data['con_air'] != '') {
            for ($a = 0; $a < count($data['con_air']); $a++) {
                $data['con_air'][$a] = str_replace("_", " ", $data['con_air'][$a]);
            }
        }
        $con_air_filter = count($data['con_air']) > 0 ? $data['con_air'] : NULL;
        //print_r($con_air_filter);die();
        if ($data['prefer'] != '') {
            for ($a = 0; $a < count($data['prefer']); $a++) {
                $data['prefer'][$a] = str_replace("_", " ", $data['prefer'][$a]);
            }
        }
        $prefer = count($data['prefer']) > 0 ? $data['prefer'] : NULL;
        // print_r($prefer);die();
        $stop_filter = count($data['stops']) > 0 ? $data['stops'] : NULL;

        $min_arrive_tme = $max_arrive_tme = $min_depart_tme = $max_depart_tme = $min_return_tme = $max_return_tme = NULL;

        if (count($data['arrive_time']) > 0) {
            $min_arrive_tme = $max_arrive_tme = 0;
            foreach ($data['arrive_time'] as $key => $val) {
                $arr = $this->format_time($val);

                if ($arr['min'] <= $min_arrive_tme OR $min_arrive_tme === 0) {
                    $min_arrive_tme = $arr['min'];
                }

                if ($arr['max'] >= $max_arrive_tme) {
                    $max_arrive_tme = $arr['max'];
                }
            }
        }

        // echo '<pre/>';print_r($data);exit;
        if (count($data['depart_time']) > 0) {
            $min_depart_tme = $max_depart_tme = 0;
            foreach ($data['depart_time'] as $key => $val) {
                $arr = $this->format_time($val);

                if ($arr['min'] <= $min_depart_tme OR $min_depart_tme === 0) {
                    $min_depart_tme = $arr['min'];
                }

                if ($arr['max'] >= $max_depart_tme) {
                    $max_depart_tme = $arr['max'];
                }
            }
        }



        if (count($data['return_time']) > 0) {
            $min_return_tme = $max_return_tme = 0;
            foreach ($data['return_time'] as $key => $val) {
                $arr = $this->format_time($val);
                if ($arr['min'] <= $min_return_tme OR $min_return_tme === 0) {
                    $min_return_tme = $arr['min'];
                }
                if ($arr['max'] >= $max_return_tme) {
                    $max_return_tme = $arr['max'];
                }
            }
        } 

        $airline_filter1=$this->Flight_Model->airline_code_gen($airline_filter);
        // debug($airline_filter1);exit();
        // debug($this->db->last_query());exit();
        $cond = array('amount_filter' => $amount_filter,
            'airline_filter' => $airline_filter1,
            'sort_col' => $data['sort']['column'],
            'sort_val' => $data['sort']['value'],
            'stop_filter' => $stop_filter,
            'min_arrive_tme' => $min_arrive_tme,
            'max_arrive_tme' => $max_arrive_tme,
            'min_depart_tme' => $min_depart_tme,
            'max_depart_tme' => $max_depart_tme,
            'min_return_tme' => $min_return_tme,
            'max_return_tme' => $max_return_tme,
            'con_air_filter' => $con_air_filter,
            'prefer' => $prefer
        );


        // debug($cond);die;
        $totalRec = $this->Flight_Model->get_last_response_count($session_data, $cond);
        $data['flight_count'] = $totalRec;

        //debug($this->db->last_query()); die;
        $flight_data = $this->Flight_Model->get_last_response_data($session_data,$cond);
        // debug($flight_data);die;


        $data['airline_data'] = $flight_data['airline_data'];

        //pagination configuration
        $config['first_link'] = 'First';
        $config['div'] = 'flightsdata'; //parent div tag id
        $config['base_url'] = WEB_URL . 'flight/ajaxPaginationData/' . $session_data;
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;

        $this->ajax_pagination->initialize($config);

        //get the posts data
        $data['flight_result'] = $this->Flight_Model->get_last_response_filter($session_data, array('start' => $offset, 'limit' => $this->perPage), $cond);

// debug($data);exit;
	   // echo '<pre>';print_r($data['flight_result']);exit;
        if (!$data['flight_result']) {
            $data['message'] = "No Result Found.";
        }
        $data['airline_filter'] = $cond['airline_filter'];
        $data['con_air_fil'] = $cond['con_air_filter'];
        $data['connecting_airports_filter'] = $flight_data['connecting_airports_filter'];
       if (in_array("return", array_column($data['flight_result'], 'type')))
        {
         // debug(array_column($data['flight_result'], 'type'));exit;       
        $this->load->view(PROJECT_THEME . '/flight/ajax_result_return', $data);
        }
        else
        {
       $this->load->view(PROJECT_THEME . '/flight/ajax_result', $data);
        }
        // $this->load->view(PROJECT_THEME . '/flight/ajax_result', $data);
    }

    function format_time($time_f) {
        switch ($time_f) {
            case '12_6A':
                $time_v1 = '0';
                $time_v2 = '0600';
                break;
            case '6_12A':
                $time_v1 = '0600';
                $time_v2 = '1200';
                break;
            case '12_6P':
                $time_v1 = '1200';
                $time_v2 = '1800';
                break;
            case '6_12P':
                $time_v1 = '1800';
                $time_v2 = '2400';
                break;
        }

        return array('min' => $time_v1, 'max' => $time_v2);
    }

    public function flight_mail_voucher($pnr_no) {


        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();

        if ($count == 1) {
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if ($b_data->product_name == 'FLIGHT') {
                //  $data['terms_conditions'] = $this->booking_model->get_terms_conditions($product_id);
                $data['b_data'] = $this->booking_model->getBookingPnr($pnr_no)->row();
                $booking_global_id = $b_data->booking_global_id;
                $billing_address_id = $b_data->billing_address_id;

                $data['Passenger'] = $passenger = $this->booking_model->getPassengerbyid($booking_global_id)->result();
                $data['booking_agent'] = $passenger = $this->booking_model->getagentbyid($billing_address_id)->result();
                $data['message'] = $this->load->view(PROJECT_THEME . '/booking/mail_voucher', $data, TRUE);

                $data['to'] = $data['booking_agent'][0]->billing_email;
                $data['booking_status'] = $b_data->booking_status;
                $data['pnr_no'] = $pnr_no;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'FLIGHT_BOOKING_VOUCHER';


                $Response = $this->email_model->sendmail_flightVoucher($data);
                $response = array('status' => 1);
                // echo"aschva";
                //echo json_encode($response);
            }
        } else {
            $response = array('status' => 0);
            echo json_encode($response);
        }
    }

    function flight_deal($id) {
        $flight_deals = $this->Flight_Model->get_flight_data_deals($id);
        $from_air = explode('(', $flight_deals[0]->deal_from_place);
        $to_air = explode('(', $flight_deals[0]->deal_to_place);


        $from_airport_code = trim($from_air[1], ")");
        $to_airport_code = trim($to_air[1], ")");

        $depart_date = date("d-m-Y", strtotime('+7 days'));
        $return_date = date("d-m-Y", strtotime('+14 days'));
        // echo "<pre>"; print_r($flight_deals); exit;

        $request = array(
            'type' => 'round',
            'origin' => $from_airport_code,
            'destination' => $to_airport_code,
            'depart_date' => $depart_date,
            'return_date' => $return_date,
            'ADT' => 1,
            'CHD' => 0,
            'INF' => 0,
            'class' => All,
            'is_domestic' => 0,
        );
        $query = http_build_query($request);
        // echo $query; exit();
        redirect(WEB_URL . 'flight/?' . $query);
    }

    function renderApiResponse_calender($SearchResponse, $rand_id) {
        $flight_result = $this->xml2array($SearchResponse);

        $flightResult = array();
        $currency = '';
        // Calendar Module
        if (!isset($flight_result['soapenv:Envelope']['soapenv:Body']['Fare_MasterPricerCalendarReply']['errorMessage'])) {
            if (isset($flight_result['soapenv:Envelope']['soapenv:Body']['Fare_MasterPricerCalendarReply']))
                $flightResult = $flight_result['soapenv:Envelope']['soapenv:Body']['Fare_MasterPricerCalendarReply'];
        }



        $flightIndex1 = array();
        $flightIndex = array();



        if ($flightResult) {
            $currency = $flightResult['conversionRate']['conversionRateDetail']['currency'];
            // To Check the JourneyType: Oneway Or Roundtrip or Multicity or Calendar
            $flightIndex1 = $flightResult['flightIndex'];

            if (!isset($flightIndex1[0]))
                $flightIndex[0] = $flightIndex1;
            else
                $flightIndex = $flightIndex1;
            $flightIndexCount = count($flightIndex);
            for ($i = 0; $i < $flightIndexCount; $i++) { // No of Flight Records Loop
                $groupOfFlights = $flightIndex[$i]['groupOfFlights'];
                $groupOfFlightsCount = count($groupOfFlights);
                for ($f = 0; $f < ($groupOfFlightsCount); $f++) { // To Check the Flight Segment
                    $FlightSegment1 = array();
                    $FlightSegment = array();
                    $FlightSegment1 = $groupOfFlights[$f]['flightDetails'];

                    if (!isset($FlightSegment1[0]))
                        $FlightSegment[0] = $FlightSegment1;
                    else
                        $FlightSegment = $FlightSegment1;

                    for ($j = 0; $j < (count($FlightSegment)); $j++) {
                        $flightId = $groupOfFlights[$f]['propFlightGrDetail']['flightProposal'][0]['ref'];
                        $flightDetails1[$flightId]['Flight'][$i]['flightId'] = $groupOfFlights[$f]['propFlightGrDetail']['flightProposal'][0]['ref'];

                        $flightDetails1[$flightId]['Flight'][$i]['currency'] = $currency;
                        $flightDetails1[$flightId]['Flight'][$i]['stops'] = $j;
                        $flightDetails1[$flightId]['Flight'][$i]['FlightEft'] = $groupOfFlights[$f]['propFlightGrDetail']['flightProposal'][1]['ref'];
                        $flightDetails1[$flightId]['Flight'][$i]['dateOfDeparture'][$j] = $departureDate = $FlightSegment[$j]['flightInformation']['productDateTime']['dateOfDeparture'];
                        $flightDetails1[$flightId]['Flight'][$i]['timeOfDeparture'][$j] = $departureTime = $FlightSegment[$j]['flightInformation']['productDateTime']['timeOfDeparture'];
                        $flightDetails1[$flightId]['Flight'][$i]['dateOfArrival'][$j] = $arrivalDate = $FlightSegment[$j]['flightInformation']['productDateTime']['dateOfArrival'];
                        $flightDetails1[$flightId]['Flight'][$i]['timeOfArrival'][$j] = $arrivalTime = $FlightSegment[$j]['flightInformation']['productDateTime']['timeOfArrival'];
                        $flightDetails1[$flightId]['Flight'][$i]['flightOrtrainNumber'][$j] = $FlightSegment[$j]['flightInformation']['flightOrtrainNumber'];
                        $flightDetails1[$flightId]['Flight'][$i]['marketingCarrier'][$j] = $FlightSegment[$j]['flightInformation']['companyId']['marketingCarrier'];
                        $flightDetails1[$flightId]['Flight'][$i]['airlineName'][$j] = $this->Flight_Model->get_airline_name($FlightSegment[$j]['flightInformation']['companyId']['marketingCarrier']);

                        $flightDetails1[$flightId]['Flight'][$i]['DepartureDate'][$j] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-20" . (substr("$departureDate", -2)));
                        $flightDetails1[$flightId]['Flight'][$i]['ArrivalDate'][$j] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-20" . (substr("$arrivalDate", -2)));

                        $flightDetails1[$flightId]['Flight'][$i]['DepartureTime'][$j] = ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2)));
                        $flightDetails1[$flightId]['Flight'][$i]['ArrivalTime'][$j] = ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2)));

                        $eft_final = str_split($flightDetails1[$flightId]['Flight'][$i]['FlightEft'], 2);
                        $flightDetails1[$flightId]['Flight'][$i]['durationFinalEft'] = $eft_final[0] . " h " . $eft_final[1] . " min";


                        // Red Eye Feature
                        if ((($flightDetails1[$flightId]['Flight'][$i]['timeOfDeparture'][0]) <= "0700") && (($flightDetails1[$flightId]['Flight'][$i]['timeOfArrival'][$j]) >= "2000"))
                            $flightDetails1[$flightId]['Flight'][$i]['redEye'] = "Yes";
                        else
                            $flightDetails1[$flightId]['Flight'][$i]['redEye'] = "No";

                        // Diffrent Airport Feature
                        if ($flightDetails1[$flightId]['Flight'][$i]['marketingCarrier'][0] != $flightDetails1[$flightId]['Flight'][$i]['marketingCarrier'][$j])
                            $flightDetails1[$flightId]['Flight'][$i]['DiffrentAirport'] = "Yes";
                        else
                            $flightDetails1[$flightId]['Flight'][$i]['DiffrentAirport'] = "No";

                        // Short layover Time and Long Layover Time feature
                        if ($j != 0) {
                            $departureDateTimeLayover = new DateTime($flightDetails1[$flightId]['Flight'][$i]['DepartureDate'][$j] . " " . $flightDetails1[$flightId]['Flight'][$i]['DepartureTime'][$j]);
                            $arrivalDateTimeLayover = new DateTime($flightDetails1[$flightId]['Flight'][$i]['ArrivalDate'][($j - 1)] . " " . $flightDetails1[$flightId]['Flight'][$i]['ArrivalTime'][($j - 1)]);
                            $Layoverinterval = date_diff($arrivalDateTimeLayover, $departureDateTimeLayover);

                            $hour_layover = $Layoverinterval->format('%h');
                            $min_layover = $Layoverinterval->format('%i');
                            $dur_in_min_layover = (($hour_layover * 60) + $min_layover);
                            $flightDetails1[$flightId]['Flight'][$i]['LayoverDurationMins'] = $dur_in_min_layover;
                            $flightDetails1[$flightId]['Flight'][$i]['LayoverDurationText'] = $Layoverinterval->format('%h H %i M');
                            $flightDetails1[$flightId]['Flight'][$i]['LayoverDuration'][$j] = $Layoverinterval->format('%h H %i M');
                        }
                        // echo '<pre/>';print_r($FlightSegment[$j]);exit;
                        if (isset($FlightSegment[$j]['flightInformation']['companyId']['operatingCarrier'])) {
                            $flightDetails1[$flightId]['Flight'][$i]['operatingCarrier'][$j] = $FlightSegment[$j]['flightInformation']['companyId']['operatingCarrier'];
                        } else {
                            $flightDetails1[$flightId]['Flight'][$i]['operatingCarrier'][$j] = '';
                        }
                        // echo '<pre/>';print_r($FlightSegment);exit;
                        $flightDetails1[$flightId]['Flight'][$i]['locationIdDeparture'][$j] = $FlightSegment[$j]['flightInformation']['location'][0]['locationId'];
                        $flightDetails1[$flightId]['Flight'][$i]['locationIdArival'][$j] = $FlightSegment[$j]['flightInformation']['location'][1]['locationId'];

                        $dep_name = $this->Flight_Model->get_airport_cityname($flightDetails1[$flightId]['Flight'][$i]['locationIdDeparture'][$j]);
                        $arr_name = $this->Flight_Model->get_airport_cityname($flightDetails1[$flightId]['Flight'][$i]['locationIdArival'][$j]);
                        if (isset($flightDetails1[$flightId]['Flight'][$i]['DepartureAirport'][$j]))
                            $flightDetails1[$flightId]['Flight'][$i]['DepartureAirport'][$j] = $dep_name->city . ", " . $dep_name->country . " (" . $dep_name->city_code . ")";
                        if (isset($flightDetails1[$flightId]['Flight'][$i]['ArrivalAirport'][$j]))
                            $flightDetails1[$flightId]['Flight'][$i]['ArrivalAirport'][$j] = $arr_name->city . ", " . $arr_name->country . " (" . $arr_name->city_code . ")";

                        $dep_time_zone_offset = $this->Flight_Model->get_time_zone_details($flightDetails1[$flightId]['Flight'][$i]['locationIdDeparture'][$j]);
                        $arv_time_zone_offset = $this->Flight_Model->get_time_zone_details($flightDetails1[$flightId]['Flight'][$i]['locationIdArival'][$j]);
                        $flightDetails1[$flightId]['Flight'][$i]['dep_time_zone_offset'][$j] = $dep_time_zone_offset;
                        $flightDetails1[$flightId]['Flight'][$i]['arv_time_zone_offset'][$j] = $arv_time_zone_offset;

                        $flightDetails1[$flightId]['Flight'][$i]['equipmentType'][$j] = $FlightSegment[$j]['flightInformation']['productDetail']['equipmentType'];
                        $flightDetails1[$flightId]['Flight'][$i]['electronicTicketing'][$j] = $FlightSegment[$j]['flightInformation']['addProductDetail']['electronicTicketing'];
                        $flightDetails1[$flightId]['Flight'][$i]['productDetailQualifier'][$j] = $FlightSegment[$j]['flightInformation']['addProductDetail']['productDetailQualifier'];
                        // Time Zone Related Code
                        if (isset($flightDetails1[$flightId]['Flight'][$i]['dep_time_zone_offset'][$j]))
                            $dep_zone = explode(":", ($flightDetails1[$flightId]['Flight'][$i]['dep_time_zone_offset'][$j]));
                        if (isset($flightDetails1[$flightId]['Flight'][$i]['arv_time_zone_offset'][$j]))
                            $arv_zone = explode(":", ($flightDetails1[$flightId]['Flight'][$i]['arv_time_zone_offset'][$j]));

                        if ($flightId == 2) {
                            // print_r($dep_zone)." ".print_r($arv_zone);exit;
                        }
                        if (!empty($arv_zone)) {
                            $Change_clock = (($arv_zone[0] . "." . $arv_zone[1]) - ($dep_zone[0] . "." . $dep_zone[1]));
                            if (!is_int($Change_clock)) {
                                $Changeclock = explode(".", $Change_clock);
                                $Changeclock0 = $Changeclock[0];
                                if ($Changeclock0 > 0) {
                                    $Changeclock1 = ($Changeclock[1] * 6);
                                } else {
                                    $Changeclock1 = (-1 * $Changeclock[1] * 6);
                                }
                            } else {
                                $Changeclock0 = $Change_clock;
                                $Changeclock1 = 0;
                            }
                        }
                        $ddate = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-20" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
                        ;
                        $adate = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-20" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
                        $date_a = new DateTime($ddate);
                        $date_b = new DateTime($adate);
                        $interval = date_diff($date_a, $date_b);
                        $hour = $interval->format('%h');
                        $min = $interval->format('%i');
                        $day1 = $interval->format('%d');
                        $dur_in_min = ((($hour * 60) + $min) - (($Changeclock0 * 60) + $Changeclock1));
                        $hour = FLOOR($dur_in_min / 60);
                        $min = $dur_in_min % 60;

                        if ($hour < 0) {
                            $hour = ((24) + ($hour));
                        }
                        if ($min < 0) {
                            $min = ((60) + ($min));
                        }

                        $day = floor(((($hour * 60) + $min) / 1440));
                        $hours = floor((($hour * 60) + $min) / 60);
                        $minutes = ((($hour * 60) + $min) % 60);

                        if ($hours > 24) {
                            $hours = ($hours % 24);
                        }
                        if ($day1 > 0)
                            $duration_time_zone = $day1 . " D " . $hours . " h " . $minutes . " min";
                        else
                            $duration_time_zone = $hours . " h " . $minutes . " min";

                        $flightDetails1[$flightId]['Flight'][$i]['duration_time_zone'][$j] = $duration_time_zone;
                        $flightDetails1[$flightId]['Flight'][$i]['Clock_Changes'][$j] = $Change_clock;
                        $flightDetails1[$flightId]['Flight'][$i]['dur_in_min_time_zone'][$j] = $dur_in_min;
                    }
                }
            }

            $x = 0;
            $recommendation = array();
            if (isset($flightResult['recommendation'][0]))
                $recommendation = $flightResult['recommendation'];
            else
                $recommendation[0] = $flightResult['recommendation'];
            foreach ($recommendation as $p => $s) {

                if (isset($s['itemNumber']['itemNumberId']['numberType'])) {
                    $price = $p;
                    $flag = "MTK";
                } else {
                    $price = 0;
                    $flag = "Normal";
                }
                $segmentFlightRef = array();
                if (isset($s['segmentFlightRef'][0]))
                    $segmentFlightRef = $s['segmentFlightRef'];
                else
                    $segmentFlightRef[0] = $s['segmentFlightRef'];
                for ($sfr = 0; $sfr < (count($segmentFlightRef)); $sfr++) {
                    $referencingDetail = array();
                    if (isset($segmentFlightRef[$sfr]['referencingDetail'][0]))
                        $referencingDetail = $segmentFlightRef[$sfr]['referencingDetail'];
                    else
                        $referencingDetail[0] = $segmentFlightRef[$sfr]['referencingDetail'];
                    for ($rd = 0; $rd < (count($referencingDetail)); $rd++) {
                        $refNumber = $referencingDetail[$rd]['refNumber'] . "-" . $flag . "-" . $p;
                        $refNumberFlight = $referencingDetail[$rd]['refNumber'];
                        $refQualifier = $referencingDetail[$rd]['refQualifier'];
                        if (isset($s['itemNumber']['itemNumberId']['numberType'])) {
                            $flightDetails[$refNumber][$price]['PriceInfo']['MultiTicket'] = "Yes";
                            // $flightDetails[$refNumber][$p]['PriceInfo']['MultiTicket_type']      = $s['itemNumber']['itemNumberId']['numberType'];
                            $flightDetails[$refNumber][$price]['PriceInfo']['MultiTicket_number'] = $s['itemNumber']['itemNumberId']['number'];
                        } else {
                            $flightDetails[$refNumber][$price]['PriceInfo']['MultiTicket'] = "No";
                            $flightDetails[$refNumber][$price]['PriceInfo']['MultiTicket_number'] = $s['itemNumber']['itemNumberId']['number'];
                        }

                        $flightDetails[$refNumber][$price]['PriceInfo']['refQualifier'] = $refQualifier;
                        $flightDetails[$refNumber][$price]['PriceInfo']['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount'];
                        $flightDetails[$refNumber][$price]['PriceInfo']['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount'];

                        $paxFareProduct = array();
                        if (isset($s['paxFareProduct'][0]))
                            $paxFareProduct = $s['paxFareProduct'];
                        else
                            $paxFareProduct[0] = $s['paxFareProduct'];
                        for ($pfp = 0; $pfp < (count($paxFareProduct)); $pfp++) {
                            $paxReference = array();
                            if (isset($paxFareProduct[$pfp]['paxReference']['traveller'][0]))
                                $paxReference = $paxFareProduct[$pfp]['paxReference']['traveller'];
                            else
                                $paxReference[0] = $paxFareProduct[$pfp]['paxReference']['traveller'];
                            $flightDetails[$refNumber][$price]['PriceInfo']['passengerType'] = $passengerType = $paxFareProduct[$pfp]['paxReference']['ptc'];
                            for ($pr = 0; $pr < (count($paxReference)); $pr++) {
                                $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['count'] = ($pr + 1);
                            }

                            $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['totalFareAmount'] = $paxFareProduct[$pfp]['paxFareDetail']['totalFareAmount'];
                            $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['totalTaxAmount'] = $paxFareProduct[$pfp]['paxFareDetail']['totalTaxAmount'];
                            if (isset($paxFareProduct[$pfp]['paxFareDetail']['codeShareDetails']['transportStageQualifier'])) {
                                $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['transportStageQualifier'] = $paxFareProduct[$pfp]['paxFareDetail']['codeShareDetails']['transportStageQualifier'];
                            } else {
                                $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['transportStageQualifier'] = '';
                            }
                            if (isset($paxFareProduct[$pfp]['paxFareDetail']['codeShareDetails']['company'])) {
                                $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['company'] = $paxFareProduct[$pfp]['paxFareDetail']['codeShareDetails']['company'];
                            } else {
                                $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['company'] = '';
                            }


                            $fare = array();
                            if (isset($paxFareProduct[$pfp]['fare'][0]))
                                $fare = $paxFareProduct[$pfp]['fare'];
                            else
                                $fare[0] = $paxFareProduct[$pfp]['fare'];

                            for ($fa = 0; $fa < (count($fare)); $fa++) {
                                $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['fare'][$fa]['description'] = '';
                                $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['fare'][$fa]['textSubjectQualifier'] = $fare[$fa]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['fare'][$fa]['informationType'] = $fare[$fa]['pricingMessage']['freeTextQualification']['informationType'];
                                $description = array();
                                if (is_array($fare[$fa]['pricingMessage']['description']))
                                    $description = $fare[$fa]['pricingMessage']['description'];
                                else
                                    $description[0] = $fare[$fa]['pricingMessage']['description'];
                                $flightDetails[$refNumber][$price]['PriceInfo']['fare'][$fa]['description'] = '';
                                for ($d = 0; $d < count($description); $d++) {
                                    if (isset($description[$d]))
                                        $flightDetails[$refNumber][$price]['PriceInfo']['PassengerFare'][$passengerType]['fare'][$fa]['description'] .= $description[$d] . " - ";
                                }
                            }
                            $fareDetails = array();
                            if (isset($paxFareProduct[$pfp]['fareDetails'][0]))
                                $fareDetails = $paxFareProduct[$pfp]['fareDetails'];
                            else
                                $fareDetails[0] = $paxFareProduct[$pfp]['fareDetails'];
                            for ($fd = 0; $fd < (count($fareDetails)); $fd++) {
                                $flightDetails[$refNumber][$price]['PriceInfo']['fareDetails'][$fd]['flightMtkSegRef'] = $fareDetails[$fd]['segmentRef']['segRef'];
                                $flightDetails[$refNumber][$price]['PriceInfo']['fareDetails'][$fd]['designator'] = $fareDetails[$fd]['majCabin']['bookingClassDetails']['designator'];
                                $groupOfFares = array();
                                if (isset($fareDetails[$fd]['groupOfFares'][0]))
                                    $groupOfFares = $fareDetails[$fd]['groupOfFares'];
                                else
                                    $groupOfFares[0] = $fareDetails[$fd]['groupOfFares'];
                                for ($gf = 0; $gf < (count($groupOfFares)); $gf++) {
                                    $flightDetails[$refNumber][$price]['PriceInfo']['fareDetails'][$fd]['rbd'][$gf] = $groupOfFares[$gf]['productInformation']['cabinProduct']['rbd'];
                                    $flightDetails[$refNumber][$price]['PriceInfo']['fareDetails'][$fd]['cabin'][$gf] = $groupOfFares[$gf]['productInformation']['cabinProduct']['cabin'];
                                    $flightDetails[$refNumber][$price]['PriceInfo']['fareDetails'][$fd]['avlStatus'][$gf] = $groupOfFares[$gf]['productInformation']['cabinProduct']['avlStatus'];
                                    $flightDetails[$refNumber][$price]['PriceInfo']['fareDetails'][$fd]['breakPoint'][$gf] = $groupOfFares[$gf]['productInformation']['breakPoint'];
                                    $flightDetails[$refNumber][$price]['PriceInfo']['fareDetails'][$fd]['fareType'][$gf] = $groupOfFares[$gf]['productInformation']['fareProductDetail']['fareType'];
                                }
                            }
                        }
                    }
                }
            }

            foreach ($recommendation as $p => $s) {
                if (isset($s['itemNumber']['itemNumberId']['numberType'])) {
                    $price = $p;
                    $flag = "MTK";
                } else {
                    $price = 0;
                    $flag = "Normal";
                }
                $segmentFlightRef = array();
                if (isset($s['segmentFlightRef'][0]))
                    $segmentFlightRef = $s['segmentFlightRef'];
                else
                    $segmentFlightRef[0] = $s['segmentFlightRef'];
                for ($sfr = 0; $sfr < (count($segmentFlightRef)); $sfr++) {
                    $referencingDetail = array();
                    if (isset($segmentFlightRef[$sfr]['referencingDetail'][0]))
                        $referencingDetail = $segmentFlightRef[$sfr]['referencingDetail'];
                    else
                        $referencingDetail[0] = $segmentFlightRef[$sfr]['referencingDetail'];
                    for ($rd = 0; $rd < (count($referencingDetail)); $rd++) {
                        $refNumber = $referencingDetail[$rd]['refNumber'] . "-" . $flag . "-" . $p;
                        $refNumberFlight = $referencingDetail[$rd]['refNumber'];
                        $refQualifier = $referencingDetail[$rd]['refQualifier'];
                        $FinalResult[$x]['FlightDetailsID'] = $x;
                        $FinalResult[$x]['FlightDetails'][$rd] = $flightDetails1[$refNumberFlight]['Flight'][$rd];
                    }

                    $priceDetailsfinal = array();
                    foreach ($flightDetails[$refNumber] as $price)
                        $priceDetailsfinal[] = $price;

                    $FinalResult[$x]['PricingDetails'] = $priceDetailsfinal;

                    if (!isset($s['paxFareProduct'][0])) {
                        $paxFareProduct[0] = $s['paxFareProduct'];
                    } else {
                        $paxFareProduct = $s['paxFareProduct'];
                    }
                    $FinalResult[$x]['paxFareProduct'] = $paxFareProduct;
                    $specificRecDetails = '';

                    // echo "recommendation11<pre>"; print_r($s); echo "</pre>"; 

                    if (!empty($s['specificRecDetails'])) {
                        if (!empty($s['specificRecDetails'][0]['specificProductDetails'][0])) {
                            $specificRecDetails = $s['specificRecDetails']['0']['specificProductDetails'][0]['fareContextDetails']['cnxContextDetails'][0]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                        } else {
                            $specificRecDetails = $s['specificRecDetails']['0']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                        }
                        $FinalResult[$x]['specificRecDetails'] = $specificRecDetails;
                    }

                    $x++;
                }
            }
        } else {
            //if there is no result
            $FinalResult = array();
        }

        //echo "asdfg<pre>"; print_r($FinalResult); echo "</pre>"; die();

        return $data['flight_result'] = $FinalResult;
    }

    public function send_group_bookingsearch() {
        $gb_id = 'TRIP-' . time();
        $insert_data = array(
            'gb_id' => $gb_id,
            'request' => json_encode($_POST),
            'agent_id' => $this->session->userdata('user_id'),
            'agent_type' => $this->session->userdata('user_type'),
        );
        if ($this->custom_db->insert_record('group_booking', $insert_data)) {
            $this->session->set_flashdata('group_book_msg', 'Thank you for your booking enquiry. We will be in touch shortly. Please note this booking is not yet confirmed');
        } else {
            $this->session->set_flashdata('group_book_msg', 'There was an error trying to send your enquiry.Please try again later.');
        }
        redirect(WEB_URL . 'dashboard/add_search');
    }

    public function get_grp_booking() {
        $data['user_id'] = $user_id = $this->session->userdata('user_id');
        $data['user_type'] = $user_type = $this->session->userdata('user_type');
        $data['userInfo'] = $this->general_model->get_user_details($user_id, $user_type);
        $data['group_report'] = $this->Flight_Model->get_group_booking_agent();
        $this->load->view(PROJECT_THEME . '/dashboard/dashboard_group_enquiry', $data);
    }

    public function view_more($type) {
        $data['top_flightdeals'] = $this->Home_Model->get_flight_deals();
        $data['type'] = $type;
        $this->load->view(PROJECT_THEME . '/common/view_more', $data);
    }

    public function custom_search() {
        $request = $this->input->get();

        $depature = date("Y-m-d", strtotime("+1 week"));

        $request['trip_type'] = 'circle';
        $request['depature'] = date("F d Y", strtotime($depature));
        $request['return'] = date('F d Y', strtotime($depature . ' +5 day'));
        $request['class'] = 'Economy';
        $request['class2'] = 'Economy';
        $request['airlines'] = 0;
        $request['adult'] = 1;
        $request['child'] = 0;
        $request['infant'] = 0;
        $request['infant_child'] = 0;

        $insert_report['search_type'] = 'FLIGHT';
        $insert_report['trip_type'] = $request['trip_type'];
        $insert_report['cehck_from'] = $request['from'];
        $insert_report['cehck_to'] = $request['to'];
        $insert_report['cehck_both'] = $request['from'] . ' - ' . $request['to'];

        $search_report_data = $this->custom_db->insert_record('search_report', $insert_report);

        $insert_data['search_type'] = 'FLIGHT';

        if ($request['depature']) {
            $request['depature'] = date('d-m-Y', strtotime($request['depature']));
        }
        if ($request['return']) {
            $request['return'] = date('d-m-Y', strtotime($request['return']));
        }

        $insert_data['search_data'] = json_encode($request);
        $insert_data['search_type'] = 'FLIGHT';

        $search_insert_data = $this->custom_db->insert_record('search_history', $insert_data);

        $request['type'] = $request['trip_type'];

        $return_date = '';
        $isdomstic = '';
        $dep_check = explode("-", $request['depature']);
        $deppp = count($dep_check);
        if (($request['type']) == "round") {
            $ret_check = explode("-", $request['return']);
            $rett = count($ret_check);
        }
        $from_aircode = explode('(', $request['from']);
        $to_aircode = explode('(', $request['to']);
        $cehck_from = count($from_aircode);
        $cehck_to = count($to_aircode);

        $type = 'type=round';
        $return_date = '&return_date=' . $request['return'];

        $from_aircode = substr(chop(substr($request['from'], -5), ')'), -3);
        $country_name = $this->Flight_Model->getcountry_name($from_aircode);
        $from_country = $country_name->country;
        $to_aircode = substr(chop(substr($request['to'], -5), ')'), -3);
        $country_name = $this->Flight_Model->getcountry_name($to_aircode);
        $to_country = $country_name->country;


        $isdomstic = 0;
        if ($request['airlines'] != "0" && $request['airlines'] != "") {
            $airline = $request['airlines'];
        } else {
            $airline = '';
        }


        $query = $type . '&origin=' . substr(chop(substr($request['from'], -5), ')'), -3) . '&destination=' . substr(chop(substr($request['to'], -5), ')'), -3) . '&depart_date=' . $request['depature'] . $return_date . '&ADT=' . $request['adult'] . '&CHD=' . $request['child'] . '&INF=' . $request['infant'] . '&class=' . $request['class2'] . '&is_domestic=' . $isdomstic . '&airline=' . $airline . '&search_id=' . $search_insert_data['insert_id'] . '&flexible=' . $request['flexible'];

        redirect(WEB_URL . 'flight/?' . $query);
    }

    function test() {
        $test = PNR_Retrieve('UQLM2Y');
    }

//end of file
}

?>
