<?php
if (!defined('BASEPATH'))
                exit('No direct script access allowed');

function get_token()
{
    $api_details  = get_api_credentials();
    // debug($api_details);die;
    // $hit_url      ='http://api.tektravels.com/SharedServices/SharedData.svc/rest/authenticate';
    //live
    $hit_url      ='https://api.travelboutiqueonline.com/SharedAPI/SharedData.svc/rest/authenticate';
    $EndUserIp = '127.0.0.1';
    if($api_details['status'] == 'LIVE'){
        $EndUserIp = '103.78.245.113';
    }
    $auth_detail  = array(
        "UserName" => $api_details['Username'],
        "Password" => $api_details['pwd'],
        "ClientId" => $api_details['client_id'],
        "EndUserIp" => $EndUserIp
    );

    $auth_detail1 = json_encode($auth_detail);
    $CI=get_instance();
       $token=$CI->db->get_where('authenticate_token',array('type'=>'FLIGHT'))->row_array();
         if (date('Y-m-d',strtotime($token['create_at']))==date('Y-m-d') && json_decode($token['data'],1)['Status']== true) {
       // debug(json_decode($token['data'],1)['Status']);exit;
            $data=$token['data'];    
         }else{ 
            $data         = tbo_curl($hit_url, $auth_detail1);
            $CI->db->where('type','FLIGHT');
            $token_data['data']=$data;
            $token_data['create_at']=date('Y-m-d');
            $CI->db->update('authenticate_token',$token_data);
         }
  //  debug($auth_detail);die;
    return $data;
}
function SearchReq_Res($search_request, $token_data) //exit("raj");
{
                error_reporting(0);
                $api_details    = get_api_credentials();
    // debug($token_data);die;
               
                // $hit_url        = 'http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Search';
                //live
                $hit_url        = 'https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/Search';
              //  echo "<pre/>";debug($hit_url );die;
                $type           = '';
                $search_segment = '';
                $class          = '';
                // debug($search_request);exit;
                if (($search_request->type == "oneway") || ($search_request->type == "O")) {
                                $type = '1';
                                $dep  = date('Y-m-d', strtotime($search_request->depart_date));
                                 if ($search_request->class == "Economy") {
                                                $class = '1';
                                }elseif($search_request->class=='PremiumEconomy'){
                                                $class = '3';                                    
                                }elseif($search_request->class=='Business'){
                                                $class = '4';                                    
                                }elseif($search_request->class=='PremiumBusiness'){
                                                $class = '5';                                    
                                }elseif($search_request->class=='First'){
                                                $class = '6';                                    
                                }
                                $Segments[0]["Origin"]                 = $search_request->origin;
                                $Segments[0]["Destination"]            = $search_request->destination;
                                $Segments[0]["FlightCabinClass"]       = $class;
                                $Segments[0]["PreferredDepartureTime"] = $dep . "T00: 00: 00";
                } elseif (($search_request->type == "round") || ($search_request->type == "R")) {
                                $type = '2';
                                $dep  = date('Y-m-d', strtotime($search_request->depart_date));
                                $ret  = date('Y-m-d', strtotime($search_request->return_date));
                                if ($search_request->class == "Economy") {
                                                $class = '1';
                                }elseif($search_request->class=='PremiumEconomy'){
                                                $class = '3';                                    
                                }elseif($search_request->class=='Business'){
                                                $class = '4';                                    
                                }elseif($search_request->class=='PremiumBusiness'){
                                                $class = '5';                                    
                                }elseif($search_request->class=='First'){
                                                $class = '6';                                    
                                }
                                $Segments[0]["Origin"]                 = $search_request->origin;
                                $Segments[0]["Destination"]            = $search_request->destination;
                                $Segments[0]["FlightCabinClass"]       = $class;
                                $Segments[0]["PreferredDepartureTime"] = $dep . "T00: 00: 00";
                                $Segments[1]["Origin"]                 = $search_request->destination;
                                $Segments[1]["Destination"]            = $search_request->origin;
                                $Segments[1]["FlightCabinClass"]       = $class;
                                $Segments[1]["PreferredDepartureTime"] = $ret . "T00: 00: 00";
                } elseif (($search_request->type == "multi") || ($search_request->type == "M")) {
                                $type = '3';
                                for ($i = 0; $i < count($search_request->origin_m); $i++) {
                                                $dep = date('Y-m-d', strtotime($search_request->depart_date_m[$i]));
                                                if ($search_request->class == "Economy") {
                                                                $class                                  = '1';
                                                                $Segments[$i]["Origin"]                 = $search_request->origin_m[$i];
                                                                $Segments[$i]["Destination"]            = $search_request->destination_m[$i];
                                                                $Segments[$i]["FlightCabinClass"]       = $class;
                                                                $Segments[$i]["PreferredDepartureTime"] = $dep . "T00: 00: 00";
                                                }
                                }
                }

                if (!empty($search_request->airline)) {
                    $airline=["$search_request->airline"];
                }else{
                    $airline=null;

                }
                
                $search_request1 = array(
                                "EndUserIp" => '103.78.245.113',
                                "TokenId" => $token_data->TokenId,
                                "AdultCount" => $search_request->ADT,
                                "ChildCount" => $search_request->CHD,
                                "InfantCount" => $search_request->INF,
                                "DirectFlight" => "false",
                                "OneStopFlight" => "false",
                                "JourneyType" => $type,
                                "PreferredAirlines" => $airline,
                                "Segments" => $Segments,
                                "Sources" => null
                );
                $search_req      = json_encode($search_request1);
                // debug($search_req);exit;

                $flight_data     = tbo_curl($hit_url, $search_req);
                // echo "<pre/>";print_r($search_req);exit;
                $flight_data1    = json_decode($flight_data, 1);
               // echo "<pre/>";print_r($flight_data1);exit;
                $formate_result  = result_formate($flight_data1, $token_data->TokenId);
                // echo "<pre/>";print_r($formate_result);exit;
                return $formate_result;
}
function get_api_credentials()
{
                $CI =& get_instance();
                $CI->load->model('flight_model');
                $credentials = $CI->Flight_Model->get_api_credentials('TBO');
                // debug($credentials);die;
                if (isset($credentials->api_username)) {
                    $data['api_id']     = $credentials->api_details_id;
                    $data['Username']   = $credentials->api_username;
                    $data['pwd']        = trim($credentials->api_password);
                    $data['client_id']  = trim($credentials->api_username1);
                    $data['url']        = $credentials->api_url;
                    $data['ip_address'] = '192.168.0.1';
                    $data['status']     = $credentials->api_credential_type;
                               // echo "<pre/>";print_r($data);exit();
                                return $data;
                } else {
                                return '';
                }
}
function fare_rule_t($TokenId, $TraceId, $ResultIndex)
{ 
                $api_details      = get_api_credentials();
                // $hit_url          ='http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/FareRule';
                //live
                $hit_url          ='https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/FareRule';
                $fare_rule_detail = array(
                                "TokenId" => $TokenId,
                                "TraceId" => $TraceId,
                                "ResultIndex" => $ResultIndex,
                                "EndUserIp" => '103.78.245.113'
                );
                $fare_rule1       = json_encode($fare_rule_detail);
                $data             = tbo_curl($hit_url, $fare_rule1);
                // debug($data);exit;
                //echo "<pre/>";print_r($data);exit("131");
                return $data;
}
function book($result, $passenger, $billingaddress,$path)
{
    // debug($request);exit;
    $api_details   = get_api_credentials();
    // $hit_url       = $api_details['url'] . 'BookingEngineService_Air/AirService.svc/rest/Book';
    // $hit_url       = 'http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Book';
    //live
    $hit_url       = 'https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/Book';
    $segment_data1 = json_decode($result->segment_data);
    $TokenId       = $segment_data1->TokenId;
    $TraceId       = $segment_data1->TraceId;
    $ResultIndex   = $segment_data1->ResultIndex;
    $price         = json_decode($result->PricingDetails);
    $b_country     = explode('-', $billingaddress->billing_contact_number);
    //$b_country=$b_country[0];
    $b_country1    = '+91';
    $b_contact     = $b_country[1];
    $p_c           = 0;
    $fare          = array(
                    "Currency" => $price->Currency,
                    "BaseFare" => $price->BaseFare,
                    "Tax" => $price->Tax,
                    "YQTax" => 0,
                    "AdditionalTxnFeePub" => 0,
                    "AdditionalTxnFeeOfrd" => 0,
                    "OtherCharges" => $price->OtherCharges,
                    "Discount" => 0,
                    "PublishedFare" => $price->PublishedFare,
                    "OfferedFare" => $price->OfferedFare,
                    "TdsOnCommission" => $price->TdsOnCommission,
                    "TdsOnPLB" => 0,
                    "TdsOnIncentive" => 0,
                    "ServiceFee" => 0
    );
    if (isset($passenger['ADULT']) && !empty($passenger['ADULT'])) {
    
                    for ($i = 0; $i < count($passenger['ADULT']); $i++) {
                                    if ($passenger['ADULT'][$i]->gender == "MALE") {
                                                    $Title = 'Mr';
                                                    $gend  = '1';
                                    } else {
                                                    $Title = 'Miss';
                                                    $gend  = '2';
                                    }
                                    $lead = 'false';
                                    if ($i == 0) {
                                                    $lead = 'true';
    // echo "<pre/>";print_r($passenger['ADULT'][$i]->passport_no);exit("adasda");
                                    }
                                    $passenger1[$p_c] = array(
                                                    "Title" => $Title,
                                                    "FirstName" => $passenger['ADULT'][$i]->first_name,
                                                    "LastName" => $passenger['ADULT'][$i]->last_name,
                                                    "PaxType" => '1',
                                                    "DateOfBirth" => $passenger['ADULT'][$i]->dob . 'T00:00:00',
                                                    "Gender" => $gend,
                                                    "PassportNo" => $passenger['ADULT'][$i]->passport_no,
                                                    "PassportExpiry" => $passenger['ADULT'][$i]->pass_expiry . 'T00:00:00',
                                                    "AddressLine1" => "test",
                                                    "AddressLine2" => "test",
                                                    "Fare" => $fare,
                                                    "City" => "Gurgaon",
                                                    "CountryCode" => "IN",
                                                    "CellCountryCode" => $b_country1,
                                                    "ContactNo" => $b_contact,
                                                    "Nationality" => $passenger['ADULT'][$i]->issue_country,
                                                    "Email" => $billingaddress->billing_email,
                                                    "IsLeadPax" => $lead,
                                                    "FFAirlineCode" => null,
                                                    "FFNumber" => "",
                                                    "GSTCompanyAddress" => "",
                                                    "GSTCompanyContactNumber" => "",
                                                    "GSTCompanyName" => "",
                                                    "GSTNumber" => "",
                                                    "GSTCompanyEmail" => ""
                                    );
                                    $p_c              = $p_c + 1;
                    }
    }
    if (isset($passenger['CHILD'])&& !empty($passenger['CHILD'])) {
                    for ($i = 0; $i < count($passenger['CHILD']); $i++) {
                                    if ($passenger['CHILD'][$i]->gender == "MALE") {
                                                    $Title = 'Mr';
                                                    $gend  = '1';
                                    } else {
                                                    $Title = 'Miss';
                                                    $gend  = '2';
                                    }
                                    $lead             = 'false';
                                    $passenger1[$p_c] = array(
                                                    "Title" => $Title,
                                                    "FirstName" => $passenger['CHILD'][$i]->first_name,
                                                    "LastName" => $passenger['CHILD'][$i]->last_name,
                                                    "PaxType" => '2',
                                                    "DateOfBirth" => $passenger['CHILD'][$i]->dob . 'T00:00:00',
                                                    "Gender" => $gend,
                                                    "PassportNo" => $passenger['CHILD'][$i]->passport_no,
                                                    "PassportExpiry" => $passenger['CHILD'][$i]->pass_expiry . 'T00:00:00',
                                                    "AddressLine1" => "test",
                                                    "AddressLine2" => "test",
                                                    "Fare" => $fare,
                                                    "City" => "Gurgaon",
                                                    "CountryCode" => "IN",
                                                    "CellCountryCode" => $b_country1,
                                                    "ContactNo" => $b_contact,
                                                    "Nationality" => $passenger['CHILD'][$i]->issue_country,
                                                    "Email" => $billingaddress->billing_email,
                                                    "IsLeadPax" => $lead,
                                                    "FFAirlineCode" => null,
                                                    "FFNumber" => "",
                                                    "GSTCompanyAddress" => "",
                                                    "GSTCompanyContactNumber" => "",
                                                    "GSTCompanyName" => "",
                                                    "GSTNumber" => "",
                                                    "GSTCompanyEmail" => ""
                                    );
                                    $p_c              = $p_c + 1;
                    }
    }
    if (isset($passenger['INFANT']) && !empty($passenger['CHILD'])) {
                    for ($i = 0; $i < count($passenger['INFANT']); $i++) {
                                    if ($passenger['INFANT'][$i]->gender == "MALE") {
                                                    $Title = 'Mr';
                                                    $gend  = '1';
                                    } else {
                                                    $Title = 'Miss';
                                                    $gend  = '2';
                                    }
                                    $lead             = 'false';
                                    $passenger1[$p_c] = array(
                                                    "Title" => $Title,
                                                    "FirstName" => $passenger['INFANT'][$i]->first_name,
                                                    "LastName" => $passenger['INFANT'][$i]->last_name,
                                                    "PaxType" => '3',
                                                    "DateOfBirth" => $passenger['INFANT'][$i]->dob . 'T00:00:00',
                                                    "Gender" => $gend,
                                                    "PassportNo" => $passenger['INFANT'][$i]->passport_no,
                                                    "PassportExpiry" => $passenger['INFANT'][$i]->pass_expiry . 'T00:00:00',
                                                    "AddressLine1" => "test",
                                                    "AddressLine2" => "test",
                                                    "Fare" => $fare,
                                                    "City" => "Gurgaon",
                                                    "CountryCode" => "IN",
                                                    "CellCountryCode" => $b_country1,
                                                    "ContactNo" => $b_contact,
                                                    "Nationality" => $passenger['INFANT'][$i]->issue_country,
                                                    "Email" => $billingaddress->billing_email,
                                                    "IsLeadPax" => $lead,
                                                    "FFAirlineCode" => null,
                                                    "FFNumber" => "",
                                                    "GSTCompanyAddress" => "",
                                                    "GSTCompanyContactNumber" => "",
                                                    "GSTCompanyName" => "",
                                                    "GSTNumber" => "",
                                                    "GSTCompanyEmail" => ""
                                    );
                                    $p_c              = $p_c + 1;
                    }
    }
    // debug($passenger1);exit;
    $book       = array(
                    "ResultIndex" => $ResultIndex,
                    "Passengers" => $passenger1,
                    "TokenId" => $TokenId,
                    "TraceId" => $TraceId,
                    "EndUserIp" => '103.78.245.113'
    );
    $book_final = json_encode($book);
    // echo "<pre/>";print_r($book_final);exit();
    
                 $fare_quote = Fare_quote($book_final);
       // debug($fare_quote);die;
                
                $path       = $path . '/Ticket.txt';
                $fp         = fopen($path, "wb");
                fwrite($fp, $book_final);
                fclose($fp);
          
    $book_data  = tbo_curl($hit_url, $book_final);
    
    return $book_data;
}
function ticket($result, $passenger, $billingaddress, $path)
{
    
                $api_details   = get_api_credentials();
                  //  $hit_url=$api_details['url'].'BookingEngineService_Air/AirService.svc/rest/Ticket';
                 // $hit_url       = 'http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Ticket';
                 //live
                 $hit_url       = 'https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/Ticket';
                $segment_data1 = json_decode($result->segment_data);
                // debug($segment_data1);
                $TokenId       = $segment_data1->TokenId;
                $TraceId       = $segment_data1->TraceId;
                $ResultIndex   = $segment_data1->ResultIndex;
                $price         = json_decode($result->PricingDetails);
                $b_country     = explode('-', $billingaddress->billing_contact_number);                
                $b_country1    = '+91';
                $b_contact     = $b_country[1];
                $p_c           = 0;
                $fare          = array(
                                "Currency" => $price->Currency,
                                "BaseFare" => $price->BaseFare,
                                "Tax" => $price->Tax,
                                "YQTax" => 0,
                                "AdditionalTxnFeePub" => 0,
                                "AdditionalTxnFeeOfrd" => 0,
                                //         "PGCharge"                 =>0,
                                "OtherCharges" => 0,
                                "Discount" => 0.0,
                                "PublishedFare" => $price->BaseFare,
                                "OfferedFare" => 0.0,
                                "TdsOnCommission" => 0.0,
                                "TdsOnPLB" => 0.0,
                                "TdsOnIncentive" => 0.0,
                                "ServiceFee" => 0.0
                );
                if (isset($passenger['ADULT']) && !empty($passenger['ADULT'])) {
                    for ($i = 0; $i < count($passenger['ADULT']); $i++) {
                        if ($passenger['ADULT'][$i]->gender == "MALE") {
                                        $Title = 'Mr';
                                        $gend  = '1';
                        } else {
                                        $Title = 'Miss';
                                        $gend  = '2';
                        }
                        $lead = 'false';
                        if ($i == 0) {
                                        $lead = 'true';
                        }
                        $passenger1[$p_c] = array(
                                        "Title" => $Title,
                                        "FirstName" => $passenger['ADULT'][$i]->first_name,
                                        "LastName" => $passenger['ADULT'][$i]->last_name,
                                        "PaxType" => '1',
                                        "DateOfBirth" => $passenger['ADULT'][$i]->dob . 'T00:00:00',
                                        "Gender" => $gend,
                                        "PassportNo" => $passenger['ADULT'][$i]->passport_no,
                                        "PassportExpiry" => $passenger['ADULT'][$i]->pass_expiry . 'T00:00:00',
                                        "AddressLine1" => "test",
                                        "AddressLine2" => "test",
                                        "Fare" => $fare,
                                        "City" => "Gurgaon",
                                        "CountryCode" => "IN",
                                        "CellCountryCode" => $b_country1,
                                        "ContactNo" => $b_contact,
                                        "Nationality" => $passenger['ADULT'][$i]->issue_country,
                                        "Email" => $billingaddress->billing_email,
                                        "IsLeadPax" => $lead,
                                        "FFAirlineCode" => null,
                                        "FFNumber" => "",
                                        "GSTCompanyAddress" => "",
                                        "GSTCompanyContactNumber" => "",
                                        "GSTCompanyName" => "",
                                        "GSTNumber" => "",
                                        "GSTCompanyEmail" => ""
                        );
                        $p_c              = $p_c + 1;
                    }
                }
                if (isset($passenger['CHILD']) && $passenger['CHILD'] != '') {
                                for ($i = 0; $i < count($passenger['CHILD']); $i++) {
                                                if ($passenger['CHILD'][$i]->gender == "MALE") {
                                                                $Title = 'Mr';
                                                                $gend  = '1';
                                                } else {
                                                                $Title = 'Miss';
                                                                $gend  = '2';
                                                }
                                                $lead             = 'false';
                                                $passenger1[$p_c] = array(
                                                                "Title" => $Title,
                                                                "FirstName" => $passenger['CHILD'][$i]->first_name,
                                                                "LastName" => $passenger['CHILD'][$i]->last_name,
                                                                "PaxType" => '2',
                                                                "DateOfBirth" => $passenger['CHILD'][$i]->dob . 'T00:00:00',
                                                                "Gender" => $gend,
                                                                "PassportNo" => $passenger['CHILD'][$i]->passport_no,
                                                                "PassportExpiry" => $passenger['CHILD'][$i]->pass_expiry . 'T00:00:00',
                                                                "AddressLine1" => "test",
                                                                "AddressLine2" => "test",
                                                                "Fare" => $fare,
                                                                "City" => "Gurgaon",
                                                                "CountryCode" => "IN",
                                                                "CellCountryCode" => $b_country1,
                                                                "ContactNo" => $b_contact,
                                                                "Nationality" => $passenger['CHILD'][$i]->issue_country,
                                                                "Email" => $billingaddress->billing_email,
                                                                "IsLeadPax" => $lead,
                                                                "FFAirlineCode" => null,
                                                                "FFNumber" => "",
                                                                "GSTCompanyAddress" => "",
                                                                "GSTCompanyContactNumber" => "",
                                                                "GSTCompanyName" => "",
                                                                "GSTNumber" => "",
                                                                "GSTCompanyEmail" => ""
                                                );
                                                $p_c              = $p_c + 1;
                                }
                }
                if (isset($passenger['INFANT']) && $passenger['INFANT'] != '') {
                                for ($i = 0; $i < count($passenger['INFANT']); $i++) {
                                                if ($passenger['INFANT'][$i]->gender == "MALE") {
                                                                $Title = 'Mr';
                                                                $gend  = '1';
                                                } else {
                                                                $Title = 'Miss';
                                                                $gend  = '2';
                                                }
                                                $lead             = 'false';
                                                $passenger1[$p_c] = array(
                                                                "Title" => $Title,
                                                                "FirstName" => $passenger['INFANT'][$i]->first_name,
                                                                "LastName" => $passenger['INFANT'][$i]->last_name,
                                                                "PaxType" => '3',
                                                                "DateOfBirth" => $passenger['INFANT'][$i]->dob . 'T00:00:00',
                                                                "Gender" => $gend,
                                                                "PassportNo" => $passenger['INFANT'][$i]->passport_no,
                                                                "PassportExpiry" => $passenger['INFANT'][$i]->pass_expiry . 'T00:00:00',
                                                                "AddressLine1" => "test",
                                                                "AddressLine2" => "test",
                                                                "Fare" => $fare,
                                                                "City" => "Gurgaon",
                                                                "CountryCode" => "IN",
                                                                "CellCountryCode" => $b_country1,
                                                                "ContactNo" => $b_contact,
                                                                "Nationality" => $passenger['INFANT'][$i]->issue_country,
                                                                "Email" => $billingaddress->billing_email,
                                                                "IsLeadPax" => $lead,
                                                                "FFAirlineCode" => null,
                                                                "FFNumber" => "",
                                                                "GSTCompanyAddress" => "",
                                                                "GSTCompanyContactNumber" => "",
                                                                "GSTCompanyName" => "",
                                                                "GSTNumber" => "",
                                                                "GSTCompanyEmail" => ""
                                                );
                                                $p_c              = $p_c + 1;
                                }
                }
                $book       = array(
                                        // "PreferredCurrency"         => $price->Currency,
                                          // "IsBaseCurrencyRequired"    => "true",
                                "AgentReferenceNo" => 'Saffron@1234',
                                "ResultIndex" => $ResultIndex,
                                "Passengers" => $passenger1,
                                "TokenId" => $TokenId,
                                "TraceId" => $TraceId,
                                "EndUserIp" => '103.78.245.113'
                );
              
                // debug($book);
                $book_final = json_encode($book);
                $fare_quote = Fare_quote($book_final);
                $path       = $path . '/Ticket.txt';
                $fp         = fopen($path, "wb");
                fwrite($fp, $book_final);
                fclose($fp);
                $book_data = tbo_curl($hit_url, $book_final);
                // debug($book_data);exit;
                return $book_data;
}
function Fare_quote($segment_data)
{
                 // debug($segment_data);die;

                error_reporting(E_ALL);
                $api_details       = get_api_credentials();                
               // $hit_url           = 'http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/FareQuote';
               //live
               $hit_url           = 'https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/FareQuote';
                $segment_data1     = json_decode($segment_data);
               // echo "<pre/>";print_r($segment_data1);exit();
                $TokenId           = $segment_data1->TokenId;
                $TraceId           = $segment_data1->TraceId;
                $ResultIndex       = $segment_data1->ResultIndex;
                $fare_quote_detail = array(
                                "TokenId" => $TokenId,
                                "TraceId" => $TraceId,
                                "ResultIndex" => $ResultIndex,
                                "EndUserIp" => '103.78.245.113'
                );
                $fare_rule1        = json_encode($fare_quote_detail);
                $data              = tbo_curl($hit_url, $fare_rule1);
                 // debug($data);exit;
                return true;
}
function session_logout($result)
{
                $api_details    = get_api_credentials();
                $hit_url        = $api_details['url'] . 'SharedServices/SharedData.svc/rest/Logout';
                $segment_data1  = json_decode($result->segment_data);
                $TokenId        = $segment_data1->TokenId;
                $session_logout = array(
                                "TokenId" => $TokenId,
                                "ClientId" => "tboprod",
                                "TokenAgencyId" => "54818",
                                "TokenMemberId" => "54728",
                                "EndUserIp" => '103.78.245.113'
                );
                $session_logout = json_encode($session_logout);
                $data           = tbo_curl1($hit_url, $session_logout);
                return true;
}
function tbo_curl($hit_url, $request)
{

     // debug($request);die;
                $file = explode('/', $hit_url);
                $curl = curl_init();
                curl_setopt_array($curl, array(
                                CURLOPT_URL => $hit_url,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => "",
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => "POST",
                                CURLOPT_POSTFIELDS => $request,
                                CURLOPT_HTTPHEADER => array(
                                                "Content-Type: application/json",
                                                "Accept-Encoding: gzip, deflate"
                                )
                ));
                $response = curl_exec($curl);
              //   debug($response);die;
                curl_close($curl);
                $final_de       = date('Ymd_His') . "_" . rand(1, 10000);
                $XmlReqFileName = $file[6] . '_Req' . $final_de;
                $XmlResFileName = $file[6] . '_Res' . $final_de;
                $fp             = fopen("logs/Flight/TBO/" . $XmlReqFileName . '.txt', 'a+');
                fwrite($fp, $request);
                fclose($fp);
                $fp = fopen("logs/Flight/TBO/" . $XmlResFileName . '.txt', 'a+');
                fwrite($fp, $response);
                fclose($fp);
                return $response;
}
function tbo_curl1($hit_url, $request)
{
    // debug($request);exit;
                $curl = curl_init();
                curl_setopt_array($curl, array(
                                CURLOPT_URL => $hit_url,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => "",
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => "POST",
                                CURLOPT_POSTFIELDS => $request,
                                CURLOPT_HTTPHEADER => array(
                                                "Content-Type: application/json",
                                                "Accept-Encoding: gzip, deflate"
                                )
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $final_de       = date('Ymd_His') . "_" . rand(1, 10000);
                $XmlReqFileName = 'session_logout_Req' . $final_de;
                $XmlResFileName = 'session_logout_Res' . $final_de;
                $fp             = fopen("logs/Flight/TBO/" . $XmlReqFileName . '.txt', 'a+');
                fwrite($fp, $request);
                fclose($fp);
                $fp = fopen("logs/Flight/TBO/" . $XmlResFileName . '.txt', 'a+');
                fwrite($fp, $response);
                fclose($fp);
                return $response;
}
function result_formate($row_data, $track_id)
{
                $result      = array();
                $outer_count = count($row_data['Response']['Results']); //no of inventry
                $i = 0;
                foreach ($row_data['Response']['Results'] as $key => $value) {
                for ($m = 0; $m < count($value); $m++) {
                                $inner_data                      = $row_data['Response']['Results'][$key][$m];
                                $segm['TokenId']                 = $track_id;
                                $segm['TraceId']                 = $row_data['Response']['TraceId'];
                                $segm['ResultIndex']             = $inner_data['ResultIndex'];
                                 if($inner_data['IsDomestic']==1){
                                    $domestic=1;
                                }else{
                                    $domestic=0;
                                }
                                $segm['IsDomestic']                   = $domestic;
                                
                                if($inner_data['IsLCC']==1){
                                    $lcc=1;
                                }else{
                                    $lcc=0;
                                }
                                $segm['islcc']                   = $lcc;
                                $segm['Segments']                = Segments_m($inner_data['Segments']);
                                $result[$i]['TokenId']           = $track_id;
                                $result[$i]['TraceId']           = $row_data['Response']['TraceId'];
                                $result[$i]['ResultIndex']       = $inner_data['ResultIndex'];
                                $result[$i]['IsRefundable']      = $inner_data['IsRefundable'];
                                $result[$i]['Fare']              = format_fare($inner_data['Fare']);
                                $result[$i]['FareBreakdown']     = json_encode($inner_data['FareBreakdown']);
                                $result[$i]['Segments']          = json_encode($segm);
                                $result[$i]['LastTicketDate']    = $inner_data['LastTicketDate'];
                                $result[$i]['AirlineCode']       = $inner_data['AirlineCode'];
                                $result[$i]['ValidatingAirline'] = $inner_data['ValidatingAirline'];
                                // debug($inner_data['Segments']);exit;
                                if($key == 0)
                                {
                                    $result[$i]['type'] = 'onward';
                                }
                                else
                                {
                                    $result[$i]['type'] = 'return';
                                }
                                $i++;
                }
            }
           
                return $result;
}
function format_fare($value)
{
                $fare['Currency']         = $value['Currency'];
                $fare['BaseFare']         = $value['BaseFare'];
                $fare['Tax']              = $value['Tax'];
                $fare['OtherCharges']     = $value['OtherCharges'];
                $fare['PublishedFare']    = $value['PublishedFare'];
                $fare['CommissionEarned'] = $value['CommissionEarned'];
                $fare['OfferedFare']      = $value['OfferedFare'];
                $fare['TdsOnCommission']  = $value['TdsOnCommission'];
                return json_encode($fare);
}
function Segments_m($value){
    for ($i=0; $i < count($value); $i++) { 
        for ($j=0; $j < count($value[$i]) ; $j++) { 
            

            $departure_datetime = date('Y-m-d H:i:s', strtotime(str_replace('T', '', $value[$i][$j]['Origin']['DepTime'])));
            $arrival_datetime = date('Y-m-d H:i:s', strtotime(str_replace('T', '', $value[$i][$j]['Destination']['ArrTime'])));
            $CI=get_instance();
            $CI->load->model('flight_model');
           $departure_timezone_offset= $CI->Flight_Model->get_airport_timezone_offset($value[$i][$j]['Origin']['Airport']['AirportCode'],$departure_datetime);
          
           $arrival_timezone_offset= $CI->Flight_Model->get_airport_timezone_offset($value[$i][$j]['Destination']['Airport']['AirportCode'],$arrival_datetime);
           $departure_timezone_offset = convert_timezone_offset_to_minutes($departure_timezone_offset);
            $arrival_timezone_offset = convert_timezone_offset_to_minutes($arrival_timezone_offset);           
          
            $timezone_offset = ($arrival_timezone_offset - $departure_timezone_offset);
            //Calculating the Waiting time between 2 segments
            $current_segment_arr = strtotime($arrival_datetime);
            $next_segment_dep = strtotime($departure_datetime);
            $segment_waiting_time = ($next_segment_dep - $current_segment_arr);
            //Converting into minutes
            $segment_waiting_time = ($segment_waiting_time) / 60; //Converting into minutes
            //Updating the total duration with time zone offset difference
            $segment_waiting_time = ($segment_waiting_time + $timezone_offset);
            $value[$i][$j]['Totel_Duration']=str_replace('-','',$segment_waiting_time);

        }
    }
    // debug($value);exit;
    return $value; 
}
function convert_timezone_offset_to_minutes($timezone_offset){
     $add_mode_sign = $timezone_offset[0];
        $time_zone_details = explode(':', $timezone_offset);
        $hours = abs(intval($time_zone_details[0]));
        $minutes = abs(intval($time_zone_details[1]));
        $minutes = $hours * 60 + $minutes;
        $minutes = ($add_mode_sign . $minutes);
        return $minutes;
}
function get_time_duration_label($seconds)
{
    $dur = '';
    $days = floor($seconds / 86400);
    $hours = floor(($seconds) / 3600);
    $minutes = floor(($seconds - ($hours * 3600)) / 60);
    // $seconds = floor(($seconds - ($days  86400) - ($hours  3600) - ($minutes*60)));

    /*if ($days > 0) {
        if (intval($days) > 1) {
        $label = ' Days ';
        } else {
        $label = ' Day ';
        }
        $dur .= $days .$label;
        }*/
    if ($hours > 0) {
        if (intval($hours) > 1) {
            $label = 'h ';//hrs
        } else {
            $label = 'h ';
        }
        $dur .= $hours.$label;
    }
    if ($minutes > 0) {
        if (intval($minutes) > 1) {
            $label = 'm ';//mins
        } else {
            $label = 'm ';
        }
        $dur .= $minutes.$label;
    }
    return $dur;
}