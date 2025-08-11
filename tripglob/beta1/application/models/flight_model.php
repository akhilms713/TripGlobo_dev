<?php

class Flight_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_ticket_status() {
        $this->db->select('*');
        $this->db->from('api_details');
        $this->db->where('api_status', 'ACTIVE');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $myres = $query->row();
            return $myres->ticketing_status;
        } else {
            return '';
        }
    }

    public function get_api_list_flight() {
        $this->db->where('api_status', 'ACTIVE');
        $query = $this->db->get('api_details');
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    function update_flight_response($search_parameter_details_id, $rand_id, $xml_request, $xml_response, $field_xml_request, $field_xml_response) {
        $this->db->reconnect();
        $this->db->query("UPDATE search_parameter_details SET $field_xml_request='" . $xml_request . ".xml',$field_xml_response='" . $xml_response . ".xml', rand_id='" . $rand_id . "'  WHERE search_parameter_details_id='" . $search_parameter_details_id . "'");
    }

    function parse_session_create_response($SessionCreateRQ_RS) {
        $SessionCreateRS = $SessionCreateRQ_RS['SessionCreateRS'];
        $response = $this->xml_to_array->XmlToArray($SessionCreateRS);
        $BinarySecurityToken = array();
        if (isset($response['soap-env:Header']['eb:MessageHeader'])) {
            $BinarySecurityToken['ConversationId'] = $response['soap-env:Header']['eb:MessageHeader']['eb:ConversationId'];
            $BinarySecurityToken['BinarySecurityToken'] = $response['soap-env:Header']['wsse:Security']['wsse:BinarySecurityToken']['@content'];
        }
        return $BinarySecurityToken;
    }

    public function get_api_credentials($api_name) {
        $this->db->where('api_name', $api_name);
        $this->db->where('api_status', 'ACTIVE');
        $query = $this->db->get('api_details');
        if ($query->num_rows() != 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    public function getMealcode() {
        $meal_de = $this->db->get('meal_info')->result_array();

        // echo "<pre/>";print_r($meal_de);die;
        return $meal_de;
    }

    public function getAirportcitylist($key) {
        if (strlen($key) == 3) {
            $this->db->select('city_code');
            $this->db->where('city_code', $key);
            $this->db->where('airport_status', 'ACTIVE');
            $this->db->limit('1');
            $query = $this->db->get('iata_airport_list');

            if(strlen($key)>3){
              $where="airport_name like '".$key."%'";
              $query = $this->db->query('select * from iata_airport_list where '.$where);
              } 
            if ($query->num_rows() > 0) {
                return $query->result();
            }
        }
    }

    public function getAirportcodelist($key) {
        if (strlen($key) == 3) {
            $this->db->select('*');
            $this->db->where('airport_code', $key);
            $this->db->where('airport_status', 'ACTIVE');
            $query = $this->db->get('iata_airport_list');
        }
        if (strlen($key) > 3) {
            $where = "airport_city like '" . $key . "%' AND airport_status='ACTIVE' ";
            $query = $this->db->query('select * from iata_airport_list where ' . $where);
        }
        #echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    //################## Air line List suggestions 6088 ########################
    public function get_airline_list_suggestions($key) {
        if (strlen($key) == 2) {
            $this->db->select('*');
            $this->db->where('airline_code', $key);
            $query = $this->db->get('airline_list');
        }
        if (strlen($key) > 2) {
            $where = "airline_name like '" . $key . "%'";
            $query = $this->db->query('select * from airline_list where ' . $where);
        }
        #echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function getAirportlist($key) {
        $sqlDestinations = "select airport_name,airport_id,city_code,airport_code,country,airport_city from iata_airport_list where city_code='$key' AND airport_status='ACTIVE' ORDER BY `airport_code` DESC ";
        $query = $this->db->query($sqlDestinations);
        // echo $this->db->last_query();exit();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function insert_search_request($data) {
        $this->db->insert('searchinput_flight_amadeu', $data);
        return $this->db->insert_id();
    }

    public function update_response($xml_request, $xml_response_name, $xml_response) {
        $this->db->query("UPDATE search_parameter_details SET xml_request='" . $xml_request . ".xml',xml_response='" . $xml_response_name . ".xml', rand_id='" . $xml_response['InputrandId'] . "'  WHERE search_parameter_details_id='" . $xml_response['searchId'] . "'");
    }

    public function insertInputParameters($input, $rand_id) {
        $xmlNameRes = '';
        $searchId = '';
        $xmlNameReq = '';
        $CurrentDate = date("Y-m-d");
        $ipaddr = $_SERVER['REMOTE_ADDR'];
        if ($input->return_date == "") {
            $return_date = '';
        } else {
            $return_date = $input->return_date;
        }
        $inputQuery = array('departure_city' => $input->origin, 'arrival_city' => $input->destination, 'departure_date' => $input->depart_date, 'returning_date' => $return_date, 'adult' => $input->ADT, 'child' => $input->CHD, 'infant' => $input->INF, 'cabin_class' => $input->class, 'journey_type' => $input->type, 'status' => 'ACTIVE');



        $insertQuery = array('departure_city' => $input->origin, 'arrival_city' => $input->destination, 'departure_date' => $input->depart_date, 'returning_date' => $return_date, 'adult' => $input->ADT, 'child' => $input->CHD, 'infant' => $input->INF, 'cabin_class' => $input->class, 'journey_type' => $input->type, 'rand_id' => $rand_id, 'status' => 'ACTIVE', 'search_count' => '1', 'insertion_date' => $CurrentDate);



        $this->db->select('*');
        $this->db->from('search_parameter_details');
        $this->db->where($inputQuery);
        $query = $this->db->get();
        // echo $this->db->last_query();  

        if ($query->num_rows == '' || $query->num_rows == '0') {

            $insertQuery = $this->db->insert('search_parameter_details', $insertQuery);
            $searchId = $this->db->insert_id();
        } else {
            $xmlResponse = $query->row();
            $xmlResponseDate = $xmlResponse->insertion_date;

            $Result = strcmp($xmlResponseDate, $CurrentDate);
            // echo $Result;exit();
            if ($Result == 0) {
                $searchId = $xmlResponse->search_parameter_details_id;
                if ($xmlResponse->xml_response != '') {
                    // exit();
                    $count = (($xmlResponse->search_count) + 1);
                    $xmlNameReq = $xmlResponse->xml_request;
                    $xmlNameRes = $xmlResponse->xml_response;
                    $rand_id = $xmlResponse->rand_id;
                    $this->db->query("UPDATE search_parameter_details SET search_count='$count' WHERE search_parameter_details_id='$searchId'");
                } else {
                    $this->db->delete('search_parameter_details', array('search_parameter_details_id' => $searchId));
                    $insertQuery = $this->db->insert('search_parameter_details', $insertQuery);
                    $searchId = $this->db->insert_id();
                }
            } else {
                $insertQuery = $this->db->insert('search_parameter_details', $insertQuery);
                $searchId = $this->db->insert_id();
            }
        }
        $data['searchId'] = $searchId;
        $data['xmlNameReq'] = $xmlNameReq;
        $data['xmlNameRes'] = $xmlNameRes;
        $data['InputrandId'] = $rand_id;
        return $data;
    }

    public function currency_convertor($amount, $from, $to) {
        $from = strtoupper($from);

        //$this->db->select('value');
        $this->db->where('currency_code', $to["currency_code"]);
        $price = $this->db->get('currency_details')->row();

        $value = $price->value;

        if ($from === $to) {
            $amount = $amount / 1;
            return number_format(($amount), 2, '.', '');
        } else {
            //echo 100.00/64.7325;
            //echo $amount.'/'.$value;
            $amount = ($amount) * ($value);
            return number_format(($amount), 2, '.', '');
        }
    }

    public function get_airport_cityname($code) {
        $this->db->select('airport_city as city');
        $this->db->where('airport_code', $code);
        $data = $this->db->get('iata_airport_list')->row();
        if (isset($data->city)) {
            return $data->city;
        } else {
            return '';
        }
    }

    public function get_airport_details($code) {
        // echo 'hi'; die();
        $this->db->where('airport_code', $code);
        $data = $this->db->get('iata_airport_list')->row();
        //echo $this->db->last_query(); exit();
        return $data;
    }

    /* public function get_airport_details($code){
      $this->db->where('airport_code',$code);

      return $this->db->get('flight_airport_list');
      } */

    public function get_airport_details_name($code) {
        $code = str_replace("-", " ", $code);
        $this->db->select('*');
        $this->db->from('airport_details');
        $this->db->join('iata_airport_list', 'iata_airport_list.airport_id = airport_details.airport_id');
        $this->db->where('airport_details.airport_status', 'ACTIVE');
        $this->db->where('iata_airport_list.airport_code', $code);
        $this->db->or_where('iata_airport_list.airport_city', $code);
        $data = $this->db->get()->row();
        //print_r($this->db->last_query()); exit();
        return $data;
    }

    public function get_airline_page($code) {
        $code = str_replace("-", " ", $code);
        $this->db->select('*');
        $this->db->from('airline_pages');
        $this->db->join('airline_list', 'airline_list.airline_list_id = airline_pages.airline_id');
        $this->db->where('airline_pages.airline_status', 'ACTIVE');
        $this->db->where('airline_list.airline_code', $code);
        $this->db->or_where('airline_list.airline_name', $code);
        $data = $this->db->get()->row();
        //print_r($this->db->last_query()); exit();
        return $data;
    }

    public function get_airline_page_link($action = '') {
        $this->db->select('*');
        $this->db->from('airline_pages');
        $this->db->join('airline_list', 'airline_list.airline_list_id = airline_pages.airline_id');
        $this->db->where('airline_pages.airline_status', 'ACTIVE');

        if ($action == 'OnPage') {
            $this->db->order_by('airline_pages.id', 'RANDOM');
            $this->db->limit(20);
        } else if ($action != '') {
            $this->db->order_by('airline_pages.id', 'RANDOM');
            $this->db->limit($action);
        }

        $data = $this->db->get()->result();
        return $data;
    }

    public function get_top_destinations($action = '') {
        $this->db->select('*');
        $this->db->from('airport_details');
        $this->db->join('iata_airport_list', 'iata_airport_list.airport_id = airport_details.airport_id');
        $this->db->where('airport_details.airport_status', 'ACTIVE');

        if ($action == 'OnPage') {
            $this->db->order_by('airport_details.id', 'RANDOM');
            $this->db->limit(20);
        } else if ($action != '') {
            $this->db->order_by('airport_details.id', 'RANDOM');
            $this->db->limit($action);
        }

        $data = $this->db->get()->result();
        return $data;
    }

    public function get_airline_name($code) {
        $this->db->select('airline_name as airline');
        $this->db->where('airline_code', $code);
        $data = $this->db->get('airline_list')->row();

        if (isset($data->airline) && $data->airline != '') {
            return $data->airline;
        } else {
            return $code;
        }
    }

    public function get_airline_name_result($code) {
        $this->db->select('DISTINCT airline_name as airline');
        $this->db->where('airline_code', $code);
        $data = $this->db->get('airline_list')->row();

        if (isset($data->airline) && $data->airline != '') {
            return $data->airline;
        } else {
            return $code;
        }
    }

    public function get_unixtimestamp($DateTime) {
        //Exploding T from arrival time  
        list($date, $time) = explode('T', $DateTime);
        $time = preg_replace("/[.]/", " ", $time);
        list($time) = explode(" ", $time);
        $DateTime = $date . " " . $time; //Exploding T and adding space
        $timestamp = strtotime($DateTime);
        return $timestamp;
    }

    public function get_airport_list($query) {
        //$this->db->like('airport_name', $query);
        $this->db->like('airport_city', $query);
        $this->db->or_like('airport_code', $query);
        //$this->db->or_like('country', $query);
        $this->db->limit(8);
        return $this->db->get('iata_airport_list');
    }

    public function getcountry_name($code) {
        $this->db->select('country');
        $this->db->where('airport_code', $code);
        return $this->db->get('iata_airport_list')->row();
    }

    public function get_airport_name($code) {
        $this->db->select('airport_name as airport');
        $this->db->where('airport_code', $code);
        $data = $this->db->get('iata_airport_list')->row();
        return $data->airport;
    }

    public function get_airport_name1($code) {
        $this->db->select('airport_city as airport');
        $this->db->where('airport_code', $code);
        $data = $this->db->get('iata_airport_list')->row();
        return $data->airport;
    }

    public function insert_cart_flight($cart_flight) {
        $this->db->insert('cart_flight', $cart_flight);
        return $this->db->insert_id();
    }
    
    public function delete_cart_flight($cart_flight) {
        $this->db->where('bundle_search_id', $cart_flight);
        $this->db->delete('cart_flight');
    }

    public function get_cart_flight($code) {

        $this->db->where('ID', $code);
        $data = $this->db->get('cart_flight')->row();

        return $data;
    }

    public function clearCart($cart_id) {
        $this->db->select('ref_id');
        $this->db->where('cart_id', $cart_id);
        $data = $this->db->get('cart_global')->row();
        $ref_id = $data->ref_id;

        $this->db->where('ID', $ref_id);
        $this->db->delete('cart_flight');

        $this->db->where('cart_id', $cart_id);
        $this->db->delete('cart_global');
    }

    public function get_country() {
        $this->db->select('*');
        $this->db->from('country_details');
        $this->db->order_by("country_name", "asc");

        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    public function getBookingTemp($cart_global_id) {
        $this->db->where('cart_id', $cart_global_id);
        $this->db->join('cart_flight', 'cart_flight.ID = cart_global.ref_id');

        $query = $this->db->get('cart_global');
        //echo $this->db->last_query(); exit();
        if ($query->num_rows() != 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    public function get_duration($DepartureDateTime, $ArrivalDateTime) {
        $seconds = $ArrivalDateTime - $DepartureDateTime;
        $jms = $seconds / 60;
        $days = floor($seconds / 86400);
        $hours = floor(($seconds - ($days * 86400)) / 3600);
        $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600)) / 60);
        // $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
        if ($days == 0) {
            $dur = $hours . "h " . $minutes . "m";
        } else {
            $dur = $days . "d " . $hours . "h " . $minutes . "m";
        }
        return $dur;
    }

    public function insert_booking_flight($booking_flight) {
        $this->db->insert('booking_flight', $booking_flight);
        return $this->db->insert_id();
    }

    public function Booking_Global($booking) {
        $this->db->insert('booking_global', $booking);
        return $this->db->insert_id();
    }

    public function Update_Booking_Global($booking_temp_id, $update_booking, $module) {
        $this->db->where('booking_global_id', $booking_temp_id);
        $this->db->where('module', $module);
        $this->db->update('booking_global', $update_booking);
    }

    public function getBookingFlightTemp($booking_flight_id) {
        $this->db->where('ID', $booking_flight_id);
        return $this->db->get('booking_flight');
    }

    public function Update_Booking_Global_sol($booking_temp_id, $update_booking) {
        $this->db->where('id', $booking_temp_id);

        $this->db->update('booking_global', $update_booking);
    }

    public function Update_Booking_flight($booking_temp_id, $update_booking) {
        $this->db->where('booking_flight_id', $booking_temp_id);
        $this->db->update('booking_flight', $update_booking);
    }

    public function getBookingByParentPnr($parent_pnr) {
        $this->db->join('booking_flight', 'booking_global.ref_id = booking_flight.ID');
        $this->db->where('parent_pnr', $parent_pnr);
        return $this->db->get('booking_global');
    }

    function get_airline_list() {
        $this->db->select('airline_code,airline_name');
        $this->db->from('airline_list');
        $this->db->order_by('airline_name', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    function get_destdays($val) {
        $this->db->select('*');
        $this->db->from('package_days');
        $this->db->where('country', $val);
        $this->db->where('status', 'ACTIVE');

        //$this->db->order_by('country');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    function getvisainformation($city) {
        /* $this->db->select('*'); //print_r($city); exit();
          $this->db->form('visa_information');
          $this->db->where('city',$city);
          $this->db->where('status','ACTIVE'); */
        $this->db->select('*');
        $this->db->from('visa_information');
        $this->db->where('city', $city);
        $this->db->where('status', 'ACTIVE');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    //CRS Starts Here
    public function getCRSFlights($type, $origin, $destination) {
        $this->db->select('*');
        $this->db->from('api_details');
        $this->db->where('api_name', 'CRS-Flight');
        $this->db->where('api_status', 'ACTIVE');
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $this->db->where('trip_type', $type);
            $this->db->where('from_city', $origin);
            $this->db->where('to_city', $destination);
            $this->db->where('status', '1');
            $c = $this->db->get('flightcrs_search');
            return $c->result();
        } else {
            return '';
        }
    }

    public function getCRSSegments($flight_id) {
        $this->db->where('flight_id', $flight_id);
        return $this->db->get('flightcrs_segments');
        //echo $this->db->last_query(); exit();
    }

    public function getCRSPrice($flight_id) {
        $this->db->where('flight_id', $flight_id);
        return $this->db->get('flightcrs_pricing');
    }

    // Time Zone Related Code
    function get_time_zone_details($CityCode) {
        $query = $this->db->query("SELECT Offset FROM city_code_amadeus_test WHERE city_code = '$CityCode' ");
        if ($query->num_rows == '')
            $country_time_zone = '';
        else {
            $dd = $query->row();
            $country_time_zone = $dd->Offset;
        }
        return $country_time_zone;
    }

    function get_flight_data_segments($uid) {
        $this->db->where('flight_id', $uid);
        $result = $this->db->get('tf_routing_res');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return '';
        }
    }
    function get_flight_data_segments_r($uid) {
        $this->db->where_in('flight_id', $uid);
        $result = $this->db->get('tf_routing_res');
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return '';
        }
    }
        function get_flight_data_segments_f($uid) {
        $this->db->where_in('flight_id', $uid);
        $result = $this->db->get('tf_routing_res');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return '';
        }
    }


    function insert_flight_data_segments_to_query_table($data) {
        $data1 = array(
            'segment_data' => $data,
            'status' => 'ACTIVE'
        );
        $this->db->insert('query_table', $data1);
    }

    function insert_flight_data_segments($data) {

        $this->db->insert("tf_routing_res", $data);
        return true;
    }

    function get_data($rand_id) {
        $query = $this->db->query("SELECT xmlResponseFileName FROM searchinput_flight_amadeu WHERE rand_id = '$rand_id' ");


        if ($query->num_rows == '')
            $result11 = '';
        else {

            $result11 = $query->result();
        }
        return $result11;
    }

    function save_result($result, $session_id, $request, $api_name) {
        /* $this->db->where('session_id', $session_id);
          $this->db->truncate('tf_routing_res'); */
        //echo "okk"; print_r($session_id);die();
        // debug('md1');
        $data = array();
        if (!empty($result) && $result != '') {
            for ($i = 0; $i < count($result); $i++) { 
                $temp = $result[$i];
                $data[$i]['session_id'] = $session_id;
                $TotalTax = $temp['PricingDetails'][0]['PriceInfo']['totalTaxAmount'];
                $TotalPrice = $temp['PricingDetails'][0]['PriceInfo']['totalFareAmount'] + $TotalTax;
                $user_id = $this->session->userdata('user_id');
                $user_type = $this->session->userdata('user_type');
                $generic_markup_B2C = $this->get_markup_B2C('GENERAL', '2'); //B2C
                $generic_markup_B2B = $this->get_markup_B2B('GENERAL', '1'); //B2B
                $agent_markup = $this->get_agent_markup($user_id);
                $agent_markup_price = 0;
                if ($user_type == 1) {
                    if ($generic_markup_B2B != '') {
                        foreach ($generic_markup_B2B as $B2B_markup) {
                            if ($B2B_markup->user_id == $user_id) {
                                if (!empty($B2B_markup->markup_value)) {
                                    $percentage = $B2B_markup->markup_value;
                                    $generic_markup_price_B2B = $this->PercentageToAmount($TotalPrice, $percentage);
                                } else {
                                    $generic_markup_price_B2B = $generic_markup_B2B[0]->markup_fixed;
                                }
                            } elseif ($B2B_markup->user_id == 0) {

                                if (!empty($B2B_markup->markup_value)) {
                                    $percentage = $B2B_markup->markup_value;
                                    $generic_markup_price_B2B = $this->PercentageToAmount($TotalPrice, $percentage);
                                } else {
                                    $generic_markup_price_B2B = $generic_markup_B2B[0]->markup_fixed;
                                }
                            } else {
                                $generic_markup_price_B2B = 0;
                            }
                        }
                    }
                    if ($generic_markup_price_B2B != 0) {
                        $admin_markup = $generic_markup_price_B2B;
                    }
                    //agent markup 
                    if ($agent_markup != "") {

                        if ($agent_markup[0]->markup_value_type == 'percentage') {
                            //   echo "d";
                            $percentage = $agent_markup[0]->markup;
                            $agent_markup_price = $this->PercentageToAmount($TotalPrice, $percentage);
                        } elseif ($agent_markup[0]->markup_value_type == 'fixed') {
                            $agent_markup_price = $agent_markup[0]->markup;
                        }
                    } else {
                        $agent_markup_price = 0;
                    }

                    // echo $agent_markup_price;
                    //agent markup ends
                } else {

                    if ($generic_markup_B2C != NULL) {
                        if (!empty($generic_markup_B2C[0]->markup_value)) {
                            $percentage = $generic_markup_B2C[0]->markup_value;
                            $generic_markup_price = $this->PercentageToAmount($TotalPrice, $percentage);
                        } else {
                            $generic_markup_price = $generic_markup_B2C[0]->markup_fixed;
                        }
                    } else {
                        $generic_markup_price = 0;
                    }

                    if ($generic_markup_price != 0) {
                        $admin_markup = $generic_markup_price;
                    } else {
                        $admin_markup = 0;
                    }
                }
                // $Final_price = $TotalPrice + $admin_markup + $TotalTax;
                // echo $TotalTax."dsd";
                $Final_price = $TotalPrice + $admin_markup + $agent_markup_price;
                
                //echo $Final_price."<br>"; echo $agent_markup_price."<br>"; echo $TotalPrice."<br>"; echo $TotalPrice."<br>"; die;
                if ($request->type == "multicity") {
                    $trip_type = "MULTICITY";
                } else if ($request->type == "round") {
                    $trip_type = "ROUNDTRIP";
                } else {
                    $trip_type = "ONEWAY";
                }
                
                $seg_count = count($temp['FlightDetails'][0]['timeOfArrival']) - 1;
                $data[$i]['api_name'] = "AMADEUS";
                $data[$i]['trip_type'] = $trip_type;
                $data[$i]['amount'] = $Final_price;
                $data[$i]['api_tax'] = $temp['PricingDetails'][0]['PriceInfo']['totalTaxAmount'];
                $data[$i]['currency'] = BASE_CURRENCY;
                $data[$i]['api_currency'] = $temp['FlightDetails'][0]['currency'];
                $data[$i]['airline'] = $temp['FlightDetails'][0]['airlineName'][0];
                $data[$i]['airline_code'] = $temp['FlightDetails'][0]['marketingCarrier'][0];
                $data[$i]['segment_data'] = json_encode($temp['FlightDetails']);
                $data[$i]['PricingDetails'] = json_encode($temp['PricingDetails']);
                $data[$i]['all_results'] = json_encode($temp['paxFareProduct']);
                /* $data[$i]['specific_rec_details']= json_encode($temp['specificRecDetails']); */
                $data[$i]['depature_time'] = $temp['FlightDetails'][0]['timeOfDeparture'][0];
                $data[$i]['arrival_time'] = $temp['FlightDetails'][0]['timeOfArrival'][$seg_count];
                $data[$i]['onwards_duration'] = $temp['FlightDetails'][0]['dur_in_min_time_zone'][0];
                $data[$i]['returns_duration'] = $temp['FlightDetails'][1]['dur_in_min_time_zone'][0];
                $data[$i]['routing_id'] = $i;
                $data[$i]['origin'] = $request->origin;
                $data[$i]['destination'] = $request->destination;
                $data[$i]['adult'] = $request->ADT;
                $data[$i]['child'] = $request->CHD;
                $data[$i]['infant'] = $request->INF;
                $data[$i]['onwards_stops'] = count($temp['FlightDetails'][0]['ArrivalDate']) - 1;
                $data[$i]['returns_stops'] = isset($temp['FlightDetails'][1]['ArrivalDate']) ? (count($temp['FlightDetails'][1]['ArrivalDate']) - 1) : NULL;
                $data[$i]['request_scenario'] = json_encode($request);
                if ($temp['specificRecDetails'] != '') {
                    // exit("test");
                    $data[$i]['specific_rec_details'] = $temp['specificRecDetails'];
                } else {
                    $data[$i]['specific_rec_details'] = '';
                }
                //$data[$i]['admin_markup'] = $temp['Admin_Markup'];
                /* $data[$i]['admin_baseprice']   	= $temp['Admin_BasePrice'];
                  $data[$i]['my_markup']   		= $temp['My_Markup']; */
                $data[$i]['admin_markup'] = $admin_markup ; //$temp['Admin_Markup'];
                $data[$i]['agent_markup'] = $agent_markup_price;
                $data[$i]['admin_baseprice'] = $TotalPrice; // $temp['Admin_BasePrice'];
                $data[$i]['bundle_search_id'] = @$request->id;

                $index_key = count($temp['FlightDetails'][0]['ArrivalDate']) - 1;
                $data[$i]['arrival_time_filter'] = $temp['FlightDetails'][0]['timeOfArrival'][$index_key];
                $data[$i]['con_air_filter'] = '';
                for ($j = 1; $j <= $index_key; $j++) {
                    $data[$i]['con_air_filter'] .= '-';
                    $data[$i]['con_air_filter'] .= trim($temp['FlightDetails'][0]['locationIdDeparture'][$j]);
                    $this->db->insert('connecting_airports_filter', ['session_id' => $session_id, 'airport_code' => trim($temp['FlightDetails'][0]['locationIdDeparture'][$j])]);
                }
                if (strpos($temp['paxFareProduct'][0]['fare'][0]['pricingMessage']['description'], 'NON') == false) {
                    $data[$i]['prefer'] = 'R'; //Refundable
                } else {
                    $data[$i]['prefer'] = 'NR'; //NonRefundable
                }
            }
            
           // print_r(json_encode($data)); die;
            /* echo "<pre>";
              print_r ($data);
              echo "</pre>";exit(); */
              //debug($data);exit;
            $this->db->insert_batch('tf_routing_res', $data);
            // debug($this->db->last_query());
            // debug($this->db->affected_rows());exit;
            
        }
    }

    /* save TBO start */

    function save_result_tbo($result, $session_id, $request, $api_name) {
        
        $data = array();
        if (!empty($result) && $result != '') {
            for ($i = 0; $i < count($result); $i++) {
                $temp = $result[$i];               
                $data[$i]['session_id'] = $session_id;
                $fare = json_decode($temp['Fare'], 1);
                $currency = $fare['Currency'];
                $Tax = $fare['Tax'];
                $OtherCharges = $fare['OtherCharges'];
                $BaseFare = $fare['BaseFare'];
                $TotalTax = $Tax + $OtherCharges;
                $TotalPrice = $BaseFare + $TotalTax;
                $user_id = $this->session->userdata('user_id');
                $user_type = $this->session->userdata('user_type');
                $generic_markup_B2C = $this->get_markup_B2C('GENERAL', '2'); //B2C       
                $generic_markup_B2B = $this->get_markup_B2B('GENERAL', '1'); //B2B
                $agent_markup = $this->get_agent_markup($user_id);  
                    if ($result[$i]['AirlineCode']!='') {
                     $AirlineCode=$result[$i]['AirlineCode'];
                    }else{            
                     $AirlineCode=$result[$i]['ValidatingAirline'];
                    }          
                $add_dest_air_markup = $this->add_dest_air_markup($user_id,$request,$AirlineCode,$user_type);                
                $add_country_air_markup = $this->add_country_air_markup($user_id,$request,$AirlineCode,$user_type);                
                $add_country_dect_air_markup = $this->add_country_dect_air_markup($user_id,$request,$AirlineCode,$user_type);    
                // if ($AirlineCode=='GF') {
                //                debug($add_country_dect_air_markup);exit();
                //             }            
                if ($user_type == 1) {
                    if ($add_dest_air_markup != '') {
                        if (!empty($add_dest_air_markup['markup_value'])) {
                                    $percentage = $add_dest_air_markup['markup_value'];
                                    $spc_dect_markup_price_B2B = $this->PercentageToAmount($TotalPrice, $percentage);
                                } else {
                                    $spc_dect_markup_price_B2B = $add_dest_air_markup['markup_fixed'];
                                }
                    }
                    if ($add_country_air_markup != '') {
                        if (!empty($add_country_air_markup['markup_value'])) {
                                    $percentage = $add_country_air_markup['markup_value'];
                                    $spc_country_markup_price_B2B = $this->PercentageToAmount($TotalPrice, $percentage);
                                } else {
                                    $spc_country_markup_price_B2B = $add_country_air_markup['markup_fixed'];
                                }
                    }
                       if ($add_country_dect_air_markup != '') {
                        if (!empty($add_country_dect_air_markup['markup_value'])) {
                                    $percentage = $add_country_dect_air_markup['markup_value'];
                                    $spc_country_dect_markup_price_B2B = $this->PercentageToAmount($TotalPrice, $percentage);
                                } else {
                                    $spc_country_dect_markup_price_B2B = $add_country_dect_air_markup['markup_fixed'];
                                }
                    }
                // debug($spc_country_markup_price_B2B);exit;
                    if ($generic_markup_B2B != '') {
                        foreach ($generic_markup_B2B as $B2B_markup) {
                            if ($B2B_markup->user_id == $user_id) {
                                if (!empty($B2B_markup->markup_value)) {
                                    $percentage = $B2B_markup->markup_value;
                                    $generic_markup_price_B2B = $this->PercentageToAmount($TotalPrice, $percentage);
                                } else {
                                    $generic_markup_price_B2B = $generic_markup_B2B[0]->markup_fixed;
                                }
                            } elseif ($B2B_markup->user_id == 0) {

                                if (!empty($B2B_markup->markup_value)) {
                                    $percentage = $B2B_markup->markup_value;
                                    $generic_markup_price_B2B = $this->PercentageToAmount($TotalPrice, $percentage);
                                } else {
                                    $generic_markup_price_B2B = $generic_markup_B2B[0]->markup_fixed;
                                }
                            } else {
                                $generic_markup_price_B2B = 0;
                            }
                        }
                    }
                    $admin_markup= 0;
                    if ($spc_country_dect_markup_price_B2B != 0 ){
                       $admin_markup = $spc_country_dect_markup_price_B2B;                     
                    }elseif($spc_country_dect_markup_price_B2B == 0 && $spc_country_markup_price_B2B != 0){
                       $admin_markup = $spc_country_markup_price_B2B;               
                    }elseif( $spc_country_dect_markup_price_B2B == 0 && $spc_country_markup_price_B2B == 0 && $spc_dect_markup_price_B2B != 0){
                      $admin_markup = $spc_dect_markup_price_B2B;
                    }elseif( $spc_country_dect_markup_price_B2B == 0 && $spc_dect_markup_price_B2B ==0 && $spc_dect_markup_price_B2B ==0 && $generic_markup_price_B2B != 0){                        
                      $admin_markup = $generic_markup_price_B2B;
                    }
                    
                    if ($agent_markup != "") {

                        if ($agent_markup[0]->markup_value_type == 'percentage') {
                            //   echo "d";
                            $percentage = $agent_markup[0]->markup;
                            $agent_markup_price = $this->PercentageToAmount($TotalPrice + $admin_markup, $percentage);
                        } elseif ($agent_markup[0]->markup_value_type == 'fixed') {
                            $agent_markup_price = $agent_markup[0]->markup;
                        }
                    } else {
                        $agent_markup_price = 0;
                    }
                     //agent markup ends
                } else {
                     if ($add_dest_air_markup != '') {
                        if (!empty($add_dest_air_markup['markup_value'])) {
                                    $percentage = $add_dest_air_markup['markup_value'];
                                    $spc_dect_markup_price_B2C = $this->PercentageToAmount($TotalPrice, $percentage);
                                } else {
                                    $spc_dect_markup_price_B2C = $add_dest_air_markup['markup_fixed'];
                                }
                    }
                    if ($add_country_air_markup != '') {
                        if (!empty($add_country_air_markup['markup_value'])) {
                                    $percentage = $add_country_air_markup['markup_value'];
                                    $spc_country_markup_price_B2C = $this->PercentageToAmount($TotalPrice, $percentage);
                                } else {
                                    $spc_country_markup_price_B2C = $add_country_air_markup['markup_fixed'];
                                }
                    }
                     if ($add_country_dect_air_markup != '') {
                        if (!empty($add_country_dect_air_markup['markup_value'])) {
                                    $percentage = $add_country_dect_air_markup['markup_value'];
                                    $spc_country_dect_markup_price_B2C = $this->PercentageToAmount($TotalPrice, $percentage);
                                } else {
                                    $spc_country_dect_markup_price_B2C = $add_country_dect_air_markup['markup_fixed'];
                                }
                    }
                    // debug($spc_dect_markup_price_B2C);exit;

                    if ($generic_markup_B2C != NULL) {
                        if (!empty($generic_markup_B2C[0]->markup_value)) {
                            $percentage = $generic_markup_B2C[0]->markup_value;
                            $generic_markup_price = $this->PercentageToAmount($TotalPrice, $percentage);
                        } else {
                            $generic_markup_price = $generic_markup_B2C[0]->markup_fixed;
                        }
                    } else {
                        $generic_markup_price = 0;
                    }
                    $admin_markup = 0;
                     if ($spc_country_dect_markup_price_B2C != 0) {
                         $admin_markup = $spc_country_dect_markup_price_B2C;
                     }elseif ($spc_country_dect_markup_price_B2C == 0 && $spc_country_markup_price_B2C!= 0) {
                         $admin_markup = $spc_country_markup_price_B2C;                         
                     }elseif($spc_country_dect_markup_price_B2C == 0 && $spc_country_markup_price_B2C== 0 && $spc_dect_markup_price_B2C!= 0 ){
                         $admin_markup=$spc_dect_markup_price_B2C;
                     }elseif($spc_country_dect_markup_price_B2C == 0 && $spc_country_markup_price_B2C== 0 && $spc_dect_markup_price_B2C == 0 && $generic_markup_price!= 0 ){
                        $admin_markup = $generic_markup_price;                        
                     }
                   
                }               
                $Final_price = $TotalPrice + $admin_markup + $agent_markup_price;
                if (($request->type == "multicity") || $request->type == "M") {
                    $trip_type = "MULTICITY";
                } elseif (($request->type == "round") || ($request->type == "R")) {
                    $trip_type = "ROUNDTRIP";
                } else {
                    $trip_type = "ONEWAY";
                }
                $seg2 = json_decode($temp['Segments']);
                $seg1 = $seg2->Segments;

                // debug($seg2);
//                echo "<pre/>";print_r($seg1);
                $DepdateTime = explode('T', $seg1[0][0]->Origin->DepTime);
                $deptime = $DepdateTime[1];

                $ArrdateTime = explode('T', end($seg1[0])->Destination->ArrTime);
                //debug($ArrdateTime);exit;
                $arrtime = $ArrdateTime[1];

                if ($temp['IsRefundable'] == 1) {
                    $Refundable = 'R';
                } else {
                    $Refundable = 'NR';
                }
                  //debug($temp['Segments']);exit;

                $data[$i]['api_name'] = $api_name;
                $data[$i]['trip_type'] = $trip_type;
                $data[$i]['ResultIndex'] = $temp['ResultIndex'];
                $data[$i]['amount'] = floor($Final_price);
                $data[$i]['api_tax'] = $Tax;
                $data[$i]['currency'] = BASE_CURRENCY;
                $data[$i]['api_currency'] = $currency;
                $data[$i]['airline'] = $temp['AirlineCode'];
                $data[$i]['airline_code'] = $temp['ValidatingAirline'];
                $data[$i]['segment_data'] = $temp['Segments'];
                $data[$i]['PricingDetails'] = $temp['Fare'];
                $data[$i]['all_results'] = json_encode($temp);
                $data[$i]['depature_time'] = $deptime;
                $data[$i]['arrival_time'] = $arrtime;
                $data[$i]['onwards_duration'] = $seg1[0][0]->Duration;
                if ($trip_type == "ROUNDTRIP") {
                    $data[$i]['returns_duration'] = $seg1[0][1]->Duration;
                } else {
                    $data[$i]['returns_duration'] = '';
                }
                $data[$i]['routing_id'] = $i;
                $data[$i]['origin'] = $request->origin;
                $data[$i]['destination'] = $request->destination;
                $data[$i]['adult'] = $request->ADT;
                $data[$i]['child'] = $request->CHD;
                $data[$i]['infant'] = $request->INF;
                foreach ($seg1 as $sag1Value){
                   $StopOverCount= count($sag1Value)-1;
                }               
                    $data[$i]['onwards_stops'] = $StopOverCount;              
                if ($trip_type == "ROUNDTRIP") {
                    $data[$i]['returns_stops'] = $seg1[0][1]->StopOver;
                } else {
                    $data[$i]['returns_stops'] = '';
                }
                $data[$i]['request_scenario'] = json_encode($request);
                $data[$i]['specific_rec_details'] = '';
                $data[$i]['admin_markup'] = $admin_markup; //$temp['Admin_Markup'];
                $data[$i]['agent_markup'] = $agent_markup_price;
                $data[$i]['admin_baseprice'] = $TotalPrice; // $temp['Admin_BasePrice'];
                $data[$i]['bundle_search_id'] = @$request->id;
                $data[$i]['arrival_time_filter'] = '';
                $data[$i]['con_air_filter'] = $seg1[0][1]->Origin->Airport->AirportCode;
                $data[$i]['prefer'] = $Refundable;
                $data[$i]['nonRefundable'] = $Refundable;
                $data[$i]['type'] =$result[$i]['type'] ;
                if (!empty($seg1[0][1]->Origin->Airport->AirportCode))
                    $this->db->insert('connecting_airports_filter', ['session_id' => $session_id, 'airport_code' => $seg1[0][1]->Origin->Airport->AirportCode]);
            }
// debug($data);exit();
            /*/*/$this->db->insert_batch('tf_routing_res', $data);
        }
    }

    /* save TBO End */
    function add_dest_air_markup($user_id,$request,$AirlineCode,$user_type){
        if ($user_type==0 || empty($user_type)) {
            $user_type=2;
        }            
        $from=$this->get_airport_list_markup($request->origin);
        $to=$this->get_airport_list_markup($request->destination);
        if ($request->type=='round') {
            $type=2;
        }elseif  ($request->type=='oneway'){            
            $type=1;
        }else{
            $type=3;
        }
        $this->db->where_in('onward_class',[$request->class,'All']);        
        $markup = $this->db->get_where('dest_air_markup',array('from_loc'=>$from,'to_loc'=>$to,'user_type_id'=>$user_type,'product_details_id'=>1,'api_details_id'=>2,'trip_type'=>$type,'status'=>'ACTIVE','airline_details_id'=>$AirlineCode,'user_details_id'=>$user_id))->row_array();
        if (empty($markup)) {        
        $this->db->where_in('onward_class',[$request->class,'All']);
        $markup = $this->db->get_where('dest_air_markup',array('from_loc'=>$from,'to_loc'=>$to,'user_type_id'=>$user_type,'product_details_id'=>1,'api_details_id'=>2,'trip_type'=>$type,'status'=>'ACTIVE','user_details_id'=>0,'airline_details_id'=>$AirlineCode))->row_array();
        }        
        // debug($markup);exit();
       return $markup;
    }
    function add_country_air_markup($user_id,$request,$AirlineCode,$user_type){
        if ($user_type==0 || empty($user_type)) {
            $user_type=2;
        }            
        $from=$this->get_country_list_markup($request->origin);      
        $markup = $this->db->get_where('air_coun_markup',array('user_type_id'=>$user_type,'product_details_id'=>1,'api_details_id'=>2,'status'=>'ACTIVE','airline_details_id'=>$AirlineCode,'country_id'=>$from['country_id'],'user_details_id'=>$user_id))->row_array();        
        if (empty($markup)) {
        $this->db->where('country_id',$from['country_id']);               
        $markup = $this->db->get_where('air_coun_markup',array('user_type_id'=>$user_type,'product_details_id'=>1,'api_details_id'=>2,'status'=>'ACTIVE','user_details_id'=>0,'airline_details_id'=>$AirlineCode,'country_id'=>$from['country_id']))->row_array();
        }   
       return $markup;
    }
    function add_country_dect_air_markup($user_id,$request,$AirlineCode,$user_type){
          if ($user_type==0 || empty($user_type)) {
            $user_type=2;
        // debug($request);exit;
        }            
        $from=$this->get_airport_list_markup($request->origin);
        $to=$this->get_airport_list_markup($request->destination);
        $from_country=$this->get_country_list_markup($request->origin); 
        if ($request->type=='round') {
            $type=2;
        }elseif  ($request->type=='oneway'){            
            $type=1;
        }else{
            $type=3;
        }        
        $this->db->where_in('onward_class',[$request->class,'All']);        
        $markup = $this->db->get_where('air_coun_dest_markup',array('from_loc'=>$from,'to_loc'=>$to,'user_type_id'=>$user_type,'product_details_id'=>1,'api_details_id'=>2,'country_id'=>$from_country['country_id'],'user_details_id'=>$user_id,'status'=>'ACTIVE','trip_type'=>$type,'airline_details_id'=>$AirlineCode))->row_array();
        if (empty($markup)) {
        // debug($markup);exit();        
        $this->db->where_in('onward_class',[$request->class,'All']);
        $markup = $this->db->get_where('air_coun_dest_markup',array('from_loc'=>$from,'to_loc'=>$to,'user_type_id'=>$user_type,'product_details_id'=>1,'api_details_id'=>2,'country_id'=>$from_country['country_id'],'status'=>'ACTIVE','trip_type'=>$type,'user_details_id'=>0,'airline_details_id'=>$AirlineCode))->row_array();
        }     
       return $markup;
    }
    function get_airport_list_markup($air_code){
     $result=$this->db->select('airport_city,airport_code')->get_where('iata_airport_list',array('airport_code'=>$air_code))->row_array();
     return $result['airport_city'].' ('.$result['airport_code'].')';
     
    }
    function get_country_list_markup($air_code){
    $result=$this->db->select('country')->get_where('iata_airport_list',array('airport_code'=>$air_code))->row_array();
    return $this->db->select('country_id')->get_where('country_details',array('country_name'=>$result['country']))->row_array();     
    }
    function get_arival_data_data($session_id) {
        $this->db->select('COUNT(*) as flight_count, MIN(amount) as min_rate, MAX(amount) as max_rate');
        $this->db->where('session_id', $session_id);
        $result = $this->db->get('tf_routing_res');
        //debug($this->db->last_query());
        if ($result->num_rows() > 0) {
            $this->db->select(' *, COUNT(*) as flight_count, MIN(amount) as min_rate, MAX(amount) as max_rate');
            $this->db->where('session_id', $session_id);
            $result9 = $this->db->get('tf_routing_res');
            $data['low_flight'] = $result9->row();
            return $data;
        } else {
            return '';
        }
    }

    function get_last_response_data($session_id, $cond = array()) {
        $this->db->select('COUNT(*) as flight_count, MIN(amount) as min_rate, MAX(amount) as max_rate');
        $this->db->where('session_id', $session_id);
        $result = $this->db->get('tf_routing_res');
        // debug($this->db->last_query());
        if ($result->num_rows() > 0) {

            $data['result_data'] = $result->row();

            // $this->db->select('airline,airline_code, MIN(amount) as min_rate');
            // $this->db->where('session_id', $session_id);
            // $this->db->group_by('airline');
            // $result1 = $this->db->get('tf_routing_res');

            $result1 = $this->db->query("SELECT `airline_list`.`airline_name` as airline, `tf_routing_res`.`airline_code`, MIN(`tf_routing_res`.`amount`) as min_rate FROM (`tf_routing_res`) JOIN `airline_list` on  `airline_list`.`airline_code` = `tf_routing_res`.`airline_code` WHERE `tf_routing_res`.`session_id` =  '".$session_id."' GROUP BY tf_routing_res.airline ASC");
            
             // debug($result1->result_array()); die;
            
            $this->db->select('MIN(amount) as min_rate');
            $this->db->where('session_id', $session_id);
            $this->db->where('onwards_stops', 0);
            $result2 = $this->db->get('tf_routing_res');
            $data['stops_0'] = $result2->row();

            $this->db->select('MIN(amount) as min_rate');
            $this->db->where('session_id', $session_id);
            $this->db->where('onwards_stops', 1);
            $result3 = $this->db->get('tf_routing_res');
            $data['stops_1'] = $result3->row();

            $this->db->select('MIN(amount) as min_rate');
            $this->db->where('session_id', $session_id);
            $this->db->where('onwards_stops !=', 1);
            $this->db->where('onwards_stops !=', 0);
            $result4 = $this->db->get('tf_routing_res');
            $data['stops_multi'] = $result4->row();
            // debug($this->db->last_query());die;
            $data['airline_data'] = $result1->result();

            $this->db->distinct();
            $this->db->select('airport_code');
            $this->db->where('session_id', $session_id);
            $con_airp = $this->db->get('connecting_airports_filter');
            $data['connecting_airports_filter'] = $con_airp->result();
            // debug($data);die;
            return $data;
        } else {
            return '';
        }
    }

    function getlast_lowset_flight() {

        $this->db->select('tf_routing_res.*, MIN(amount) as low_cost');
        $this->db->from('tf_routing_res');
        $query = $this->db->get();
        if ($query->num_rows() != '') {
            $result = $this->formate_res_from_db($query->result_array());
            return $result;
        } else {
            return false;
        }
    }

    function getlowestprice_flight_byid($id) {

        $this->db->select('*');
        $this->db->from('tf_routing_res');
        $this->db->where('flight_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() != '') {
            $result = $this->formate_res_from_db($query->result_array());
            return $result;
        } else {
            return false;
        }
    }

    function get_last_response($session_id, $params = array(), $cond = array()) {

        $this->db->where('session_id', $session_id);

        if (count($cond) > 0) {

            $this->db->where($cond['amount_filter']);
            if ($cond['airline_filter'] != NULL) {
                $this->db->where_in('airline', $cond['airline_filter']);
            }

            if ($cond['prefer'] != NULL) {

                $this->db->where_in('prefer', $cond['prefer']);
            }

            $temp_cond = '';
            if ($cond['con_air_filter'] != NULL) {

                foreach ($cond['con_air_filter'] as $con_key => $con_val) {
                    if (count($cond['con_air_filter']) > 1) {
                        if ($con_key == count($cond['con_air_filter']) - 1)
                            $temp_cond .= " con_air_filter LIKE '%" . $con_val . "%'";
                        else
                            $temp_cond .= " con_air_filter LIKE '%" . $con_val . "%' OR";
                    } else {
                        $temp_cond .= "con_air_filter LIKE '%" . $con_val . "%'";
                    }
                }

                $this->db->where($temp_cond, NULL, FALSE);
            }

            if ($cond['stop_filter'] != NULL) {
                if (count($cond['stop_filter']) == 1) {
                    if ($cond['stop_filter'][0] != '1+') {
                        $this->db->where('onwards_stops', $cond['stop_filter'][0]);
                    } else {
                        $this->db->where('onwards_stops !=', 0);
                        $this->db->where('onwards_stops !=', 1);
                    }
                } elseif (count($cond['stop_filter']) == 2) {
                    if ($cond['stop_filter'][0] != '1+' AND $cond['stop_filter'][1] != '1+') {
                        $this->db->where_in('onwards_stops', $cond['stop_filter']);
                    } else {
                        $where = "(onwards_stops='" . $cond['stop_filter'][0] . "' OR onwards_stops > 1)";
                        $this->db->where($where);
                    }
                }
            }

            if ($cond['min_arrive_tme'] !== NULL && $cond['max_arrive_tme']) {
                $this->db->where('arrival_time_filter >=', $cond['min_arrive_tme']);
                $this->db->where('arrival_time_filter <=', $cond['max_arrive_tme']);
            }

            if ($cond['min_depart_tme'] !== NULL && $cond['max_depart_tme']) {
                $this->db->where('depature_time >=', $cond['min_depart_tme']);
                $this->db->where('depature_time <=', $cond['max_depart_tme']);
            }

            if ($cond['min_return_tme'] !== NULL && $cond['max_return_tme']) {
                $this->db->where('arrival_time >=', $cond['min_return_tme']);
                $this->db->where('arrival_time <=', $cond['max_return_tme']);
            }
            if ($cond['sort_col'] !== NULL) {
                $this->db->order_by($cond['sort_col'], $cond['sort_val']);
            }
        } else {
            $this->db->order_by('amount', 'asc');
        }

        if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit']);
        }
        $q = $this->db->select('*')->get('tf_routing_res');

        if ($q->num_rows() > 0) {

            $result = $this->formate_res_from_db($q->result_array());

            return $result;
        }
        return false;
    }

    function get_last_response_filter($session_id, $params = array(), $cond = array()) {

        $this->db->where('session_id', $session_id);

        if (count($cond) > 0) {

            $this->db->where($cond['amount_filter']);
            if ($cond['airline_filter'] != NULL) {
                $this->db->where_in('airline', $cond['airline_filter']);
            }

            if ($cond['prefer'] != NULL) {

                $this->db->where_in('prefer', $cond['prefer']);
            }

            $temp_cond = '';
            if ($cond['con_air_filter'] != NULL) {

                foreach ($cond['con_air_filter'] as $con_key => $con_val) {
                    if (count($cond['con_air_filter']) > 1) {
                        if ($con_key == count($cond['con_air_filter']) - 1)
                            $temp_cond .= " con_air_filter LIKE '%" . $con_val . "%'";
                        else
                            $temp_cond .= " con_air_filter LIKE '%" . $con_val . "%' OR";
                    } else {
                        $temp_cond .= "con_air_filter LIKE '%" . $con_val . "%'";
                    }
                }

                $this->db->where($temp_cond, NULL, FALSE);
            }

            if ($cond['stop_filter'] != NULL) {
                if (count($cond['stop_filter']) == 1) {
                    if ($cond['stop_filter'][0] != '1+') {
                        $this->db->where('onwards_stops', $cond['stop_filter'][0]);
                    } else {
                        $this->db->where('onwards_stops !=', 0);
                        $this->db->where('onwards_stops !=', 1);
                    }
                } elseif (count($cond['stop_filter']) == 2) {
                    if ($cond['stop_filter'][0] != '1+' AND $cond['stop_filter'][1] != '1+') {
                        $this->db->where_in('onwards_stops', $cond['stop_filter']);
                    } else {
                        $where = "(onwards_stops='" . $cond['stop_filter'][0] . "' OR onwards_stops > 1)";
                        $this->db->where($where);
                    }
                }
            }

            if ($cond['min_arrive_tme'] !== NULL && $cond['max_arrive_tme']) {
                $this->db->where('arrival_time >=', $cond['min_arrive_tme']);
                $this->db->where('arrival_time <=', $cond['max_arrive_tme']);
            }

            if ($cond['min_depart_tme'] !== NULL && $cond['max_depart_tme']) {
                $this->db->where('depature_time >=', $cond['min_depart_tme']);
                $this->db->where('depature_time <=', $cond['max_depart_tme']);
            }

            if ($cond['min_return_tme'] !== NULL && $cond['max_return_tme']) {
                $this->db->where('arrival_time_filter >=', $cond['min_return_tme']);
                $this->db->where('arrival_time_filter <=', $cond['max_return_tme']);
            }
            if ($cond['sort_col'] !== NULL) {
                $this->db->order_by($cond['sort_col'], $cond['sort_val']);
            }
        } else {
            $this->db->order_by('amount', 'asc');
        }

        if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit']);
        }
        $q = $this->db->select('*')->get('tf_routing_res');
// echo $this->db->last_query();die;
        if ($q->num_rows() > 0) {

            $result = $this->formate_res_from_db($q->result_array());

            return $result;
        }
        return false;
    }

    function formate_res_from_db($result) {
        // debug($result);exit();
        $data = array();
        for ($i = 0; $i < count($result); $i++) {
            $temp = $result[$i];
            // debug($temp);exit();
            $data[$i]['flight_id'] = $temp['flight_id'];
            $data[$i]['api_name'] = $temp['api_name'];
            $data[$i]['session_id'] = $temp['session_id'];
            $data[$i]['amount'] = $temp['amount'];
            $data[$i]['admin_markup'] = $temp['admin_markup'];
            $data[$i]['agent_markup'] = $temp['agent_markup'];
            $data[$i]['currency'] = $temp['currency'];
            $data[$i]['routing_id'] = $temp['routing_id'];

            $data[$i]['onwards_duration'] = $temp['onwards_duration'];
            $data[$i]['returns_duration'] = $temp['returns_duration'];
            $data[$i]['onwards_stops'] = $temp['onwards_stops'];
            $data[$i]['returns_stops'] = $temp['returns_stops'];

            $data[$i]['airline'] = $temp['airline'];
            $data[$i]['FlightDetails'] = isset($temp['segment_data']) ? json_decode($temp['segment_data'], true) : NULL;
            $data[$i]['PricingDetails'] = isset($temp['PricingDetails']) ? json_decode($temp['PricingDetails'], true) : NULL;
            $data[$i]['paxFareProduct'] = isset($temp['all_results']) ? json_decode($temp['all_results'], true) : NULL;
            $data[$i]['specific_rec_details'] = isset($temp['specific_rec_details']) ? json_decode($temp['specific_rec_details'], true) : NULL;
            $data[$i]['type'] = $temp['type'];
        }
        //debug($data);
        return $data;
    }

    function get_last_response_count($session_id, $cond = array()) {

        $this->db->where('session_id', $session_id);
//         echo '<pre/>';print_r($session_id);exit;
        if (count($cond) > 0) {
            $this->db->where($cond['amount_filter']);
            if ($cond['airline_filter'] != NULL) {
                $this->db->where_in('airline', $cond['airline_filter']);
            }

            if ($cond['prefer'] != NULL) {
                $this->db->where_in('prefer', $cond['prefer']);
            }

            $temp_cond = '';
            if ($cond['con_air_filter'] != NULL) {

                foreach ($cond['con_air_filter'] as $con_key => $con_val) {
                    if (count($cond['con_air_filter']) > 1) {
                        if ($con_key == count($cond['con_air_filter']) - 1)
                            $temp_cond .= " con_air_filter LIKE '%" . $con_val . "%')";
                        else if ($con_key == 0)
                            $temp_cond .= " (con_air_filter LIKE '%" . $con_val . "%' OR";
                        else
                            $temp_cond .= " con_air_filter LIKE '%" . $con_val . "%' OR";
                    } else {
                        $temp_cond .= "con_air_filter LIKE '%" . $con_val . "%'";
                    }
                }
//                         echo '<pre/>';print_r($temp_cond);exit;
                $this->db->where($temp_cond, NULL, FALSE);
            }

            if ($cond['stop_filter'] != NULL) {
                if (count($cond['stop_filter']) == 1) {
                    if ($cond['stop_filter'][0] != '1+') {
                        $this->db->where('onwards_stops', $cond['stop_filter'][0]);
                    } else {
                        $this->db->where('onwards_stops !=', 0);
                        $this->db->where('onwards_stops !=', 1);
                    }
                } elseif (count($cond['stop_filter']) == 2) {

                    if ($cond['stop_filter'][0] != '1+' AND $cond['stop_filter'][1] != '1+') {
                        $this->db->where_in('onwards_stops', $cond['stop_filter']);
                    } else {
                        $where = "(onwards_stops='" . $cond['stop_filter'][0] . "' OR onwards_stops > 1)";
                        $this->db->where($where);
                    }
                }
            }
             //debug($cond);exit;
            if ($cond['min_arrive_tme'] !== NULL && $cond['max_arrive_tme']) {
                $this->db->where('arrival_time >=', $cond['min_arrive_tme']);
                $this->db->where('arrival_time <=', $cond['max_arrive_tme']);
            }

            if ($cond['min_depart_tme'] !== NULL && $cond['max_depart_tme']) {
                $this->db->where('depature_time >=', $cond['min_depart_tme']);
                $this->db->where('depature_time <=', $cond['max_depart_tme']);
            }

            if ($cond['min_return_tme'] !== NULL && $cond['max_return_tme']) {
                $this->db->where('arrival_time_filter >=', $cond['min_return_tme']);
                $this->db->where('arrival_time_filter <=', $cond['max_return_tme']);
            }

            if ($cond['sort_col'] != NULL) {
                $this->db->order_by($cond['sort_col'], $cond['sort_val']);
            }

            # next condition
        }

        $result = $this->db->get('tf_routing_res');
//        echo ($this->db->last_query());exit;
        return $result->num_rows();
    }

    public function insert_cart_global($cart_global) {
        $this->db->insert('cart_global', $cart_global);
        return $this->db->insert_id();
    }

    public function delete_cart_global($cart_global) {
        $this->db->where('bundle_search_id', $cart_global);
        $this->db->where('product_id', 1);
        $this->db->delete('cart_global');
    }

    public function get_session_id() {
        $this->db->select('session_id');
        $this->db->from('tf_routing_res');
        $query = $this->db->get();
        if ($query->num_rows() != '') {
            $result = $query->result();
            return $result;
        } else {
            return false;
        }
    }

    function get_markup_B2C($markup_type, $B2C) {
        $this->db->select('*');
        //$this->db->from('air_coun_dest_markup');
        $this->db->from('markup_details');
        
        $this->db->where('markup_type', $markup_type);
        $this->db->where('user_type_id', $B2C);
        /*    if ($api_id != '') {
          $this->db->where('api_details_id',$api_id);
          } */
        $this->db->where('product_details_id', 1);
        $this->db->where('status', 'ACTIVE');
        $query = $this->db->get();
            // echo $this->db->last_query();exit;      
        if ($query->num_rows() != '') {
            $result = $query->result();
            return $result;
        } else {
            return false;
        }
    }

    function get_markup_B2B($markup_type, $B2B) {
        $this->db->select('*');
        $this->db->from('markup_details');
        $this->db->where('markup_type', $markup_type);
        $this->db->where('user_type_id', $B2B);
        /*    if ($api_id != '') {
          $this->db->where('api_details_id',$api_id);
          } */
        $this->db->where('product_details_id', 1);
        $this->db->where('status', 'ACTIVE');
        $query = $this->db->get();
        if ($query->num_rows() != '') {
            $result = $query->result();
            return $result;
        } else {
            return false;
        }
    }

    public function PercentageToAmount($total, $percentage) {

        $amount = ($percentage / 100) * $total;
        $perc_amount = $amount;

        //echo "percamounta".$perc_amount;exit();
        return $perc_amount;
    }

    function get_agent_markup($user_id) {
        $this->db->select('*');
        $this->db->from('user_markup');
        $this->db->where('user_id', $user_id);
        $this->db->where('product_id', 1);
        $query = $this->db->get();
        //  echo $this->db->last_query(); exit;
        if ($query->num_rows() != '') {
            $result = $query->result();
            return $result;
        } else {
            return false;
        }
    }

    function get_flight_data_deals($id) {
        $this->db->select('*');
        $this->db->from('flight_deals');
        $this->db->where('flight_deal_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    public function get_group_booking_agent() {
        $agent_id = $this->session->userdata('user_id');
        $agent_type = $this->session->userdata('user_type');
        $this->db->select('gb_id,request,insertion_time');
        $this->db->from('group_booking');
        $this->db->where('agent_id', $agent_id);
        $this->db->where('agent_type', $agent_type);
        $this->db->order_by('id', DESC);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }
    function airline_code_gen($airline_filter){
        $airline=array();
        foreach ($airline_filter as $key => $value) {
            if (strlen($value) != 2) {
            $this->db->select('airline_code');
            $this->db->from('airline_list');
            $this->db->where('airline_name',$value);
            $query = $this->db->get();
            $result=$query->row_array();            
            }else{
            $this->db->select('airline_code');
            $this->db->from('airline_list');
            $this->db->where('airline_code',$value);
            $query = $this->db->get();           
            $result=$query->row_array();
            }
            // debug($result);exit();
             $airline[]=$result['airline_code'];
        }
        return $airline;
    }
        public function get_airport_timezone_offset($airport_code,$journey_date)
    {
        //FIXME: cache the data
            
                $query_al='select timezonename, CountryCode from flight_airport_list where airport_code = "'.$airport_code.'"';
                $timezonename = $this->db->query($query_al)->result_array();
                
                if($timezonename[0]['timezonename']!='')
                {
                    
                     $target_time_zone = new DateTimeZone($timezonename[0]['timezonename']);
                     $date_time = new DateTime($journey_date, $target_time_zone);
                     $time_zone_value=substr($date_time->format(DateTime::ATOM), -6);
                     
                } 
                if(isset($time_zone_value))
                {
                   return $time_zone_value;  
                }
                else if(!isset($time_zone_value) && $timezonename[0]['CountryCode']=="IN")
                {
                     return "+5.30";
                }
                else {
                     $journey_month = date('m', strtotime($journey_date));
             $query = 'select FAL.airport_code,FAT.start_month,FAT.end_month,FAT.timezone_offset from flight_airport_list FAL
                    join flight_airport_timezone_offset FAT on FAT.flight_airport_list_fk=FAL.origin
                    where airport_code = "'.$airport_code.'" and (start_month<='.$journey_month.' and end_month>='.$journey_month.')
                    order by 
                    CASE
                    WHEN start_month    = '.$journey_month.' THEN 1
                    WHEN end_month  = '.$journey_month.' THEN 2
                    ELSE 3 END';
             $timezone_offset = $this->db->query($query)->result_array();
             return $timezone_offset[0]['timezone_offset'];
              }
    }

}

?>
