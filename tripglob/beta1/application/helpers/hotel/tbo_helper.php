<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*============== TBO code===================================*/
function set_credentials_hotel($api){
    $CI = & get_instance();
    $api_usage = "LIVE";
    $CI->load->model('General_Model');         
    $query = $CI->General_Model->get_api($api, $api_usage);
    if ($query->num_rows() == 0) {
        $data['set_credentials'] = FALSE;
    } else {  
        $api_info = $query->row(); 
        $data['onlinekey']          = $api_info->api_username;
        $data['secrete']            = $api_info->api_password;
        $data['signature']          = hash("sha256",$data['onlinekey'].$data['secrete'].time());
        $data['post_url']           = $api_info->api_url;
        $data['set_credentials']    = TRUE;
        $data['active_api']         = $api;
    } 

       // echo "<pre>";print_r($data);die;
    return $data;
}
    
    
     function TBOHotelValuedAvailRQ($requestData,$api_id,$session_data){
//exit("ram");
        $credentials_data = set_credentials_hotel($api_id);
        // debug($credentials_data);die;
        $request = json_decode(base64_decode($requestData), true);       
        $search_id = $request['search_id'];
        $getAuthDetails = get_json_response_auth();
        // debug($getAuthDetails);die;
        $getAuthDetails=json_decode($getAuthDetails,1);

        if($getAuthDetails['Error']['ErrorCode']!='0'){
            $searchResponse = array(
                'response_data' => $getAuthDetails['Error']['ErrorMessage'],
                'errorStatus'=>1);
            return $searchResponse;
        }
        $tokenId = $getAuthDetails['TokenId'];
      
        $splitCityName              = explode(',',$request['city']);
        $cityName                   = $splitCityName[0];
        $request_data['city_name']      = $cityName;
        $request_data['country_name']   = $splitCityName[1];
        $chkIn                      = date(strtotime($request['checkin']));
        $chkOut                     = date(strtotime($request['checkout']));
        $diffDate                   = abs($chkOut - $chkIn);
        $query                      = 'SELECT * FROM all_api_city_master WHERE city_name="'.$cityName.'"';
        
        $CI = & get_instance();
        $CI->load->model('custom_db');
        $cityDetails = $CI->custom_db->get_result_by_query_array($query);
        if(isset($request['adult'][1])){
          if(isset($request['adult'][2])){
            $adult = $request['adult'][0] + $request['adult'][1] + $request['adult'][2];
          }else{
            $adult = $request['adult'][0] + $request['adult'][1];
          }

        }else{
          $adult = $request['adult'][0];
        }

        if(isset($request['child'][1])){
          if(isset($request['child'][2])){
            $child = $request['child'][0] + $request['child'][1] + $request['child'][2];
          }else{
            $child = $request['child'][0] + $request['child'][1];
          }
        }else{
          $child = $request['child'][0];
        }
        $childAge = null;

        /*for($i=0;$i<$request['rooms'];$i++){
            $roomGuest[] = array(
                'NoOfAdults'=>$request['adult'][$i],
                'NoOfChild'=>$request['child'][$i],
                'ChildAge'=>$request['childAge_1'][$i]);
        }*/
        
        $room_index = $temp_child_index = 0;
        for($room_index = 0; $room_index < $request ['rooms']; $room_index ++) {
            $temp_room_config = '';
            $temp_room_config ['NoOfAdults'] = intval ( $request ['adult'] [$room_index] );
            $temp_room_config ['NoOfChild'] = intval ( $request ['child'] [$room_index] );
            if ($request ['child'] [$room_index] > 0) {
                $temp_room_config ['ChildAge'] = array_slice ( $request ['child_age'], $temp_child_index, intval ( $request ['child'] [$room_index] ) );
                $temp_child_index += intval ( $request ['child'] [$room_index] );
            }

            $roomGuest[] = $temp_room_config;
        }
        
        //echo '<pre>';print_r($roomGuest);exit();

        $req['CheckInDate'] = date('d/m/Y', strtotime($request['checkin']));
        $req['NoOfNights'] = floor($diffDate/(60*60*24));
        $req['CountryCode'] = $cityDetails[0]['country_code'];
        $req['CityId'] = $cityDetails[0]['tbo_city_id'];
        $req['ResultCount'] = null;
        $req['PreferredCurrency'] = BASE_CURRENCY;
        $req['GuestNationality'] = 'IN';
        $req['NoOfRooms'] = $request['rooms'];
        $req['RoomGuests'] = $roomGuest;
        $req['PreferredHotel'] = '';
        $req['MaxRating'] = 5;
        $req['MinRating'] = 0;
        $req['ReviewScore'] = null;
        $req['IsNearBySearchAllowed'] = "true";
        $req['EndUserIp'] = '103.78.245.113';
        $req['TokenId'] = $tokenId;
        $request_data['reqData'] = json_encode($req);
        $request_data['NoOfNights'] = $req['NoOfNights'];

        $search_request['search_id'] = $search_id;
        $search_request['request'] = $request_data['reqData'];
        $search_request['response'] = '';
        $search_request['module'] = 'Hotel';
        $search_request['type'] = 'search';
        $search_request['api'] = $credentials_data['active_api'];
        
        $CI = & get_instance();
        $CI->load->model('hotel_model');
        $ins_id = $CI->hotel_model->insLogsHistory($search_request);
        // $request_data['searchUrl'] = 'http://api.tektravels.com/HotelAPI_V10/HotelService.svc/rest/GetHotelResult';
        $request_data['searchUrl'] = 'https://api.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/GetHotelResult';
        // $request_data['searchUrl'] = 'https://tboapi.travelboutiqueonline.com/BookingEngineService_Hotel/hotelservice.svc/rest/GetHotelResult';
        
        $xml_title='hotel_search';

    //  debug($search_request);exit("RAHUL");




        $response['response'] = get_json_response_hotel($request_data['searchUrl'],$request_data['reqData'],$api_id,$xml_title);
       // echo '<pre>';print_r($response['response']);exit();
        $CI->hotel_model->updLogsHistory($response,$ins_id);

        $response_decode = json_decode($response['response'], true);
        if($response_decode['HotelSearchResult']['Error']['ErrorCode'] > 0){
            $response_data = $response_decode['HotelSearchResult']['Error']['ErrorMessage'];
            $error = 1;
        }else{
            $response_data = $response_decode['HotelSearchResult']['HotelResults'];
            $error = 0;
        }
        
        //echo '<pre>';print_r($response_data);exit();
        
        $other_data['TraceId'] = $response_decode['HotelSearchResult']['TraceId'];
        $other_data['TokenId'] = $tokenId;
        $other_data['EndUserIp'] = $req['EndUserIp'];
        $other_data['search_id'] = $search_id;
        $other_data['api_id'] = $api_id;
        
        $formatted_result = formatted_TBO_result($response_data,$requestData,$other_data);
        // debug($formatted_result);exit;
        //echo '<pre>';print_r($request);exit();
        $CI->hotel_model->save_tbo_results($formatted_result ,$requestData, $session_data,$api_id);
    
        $searchResponse = array(
            'response_data'=>$response_data,
            'errorStatus'=>$error,
            'TraceId'=>$response_decode['HotelSearchResult']['TraceId'],
            'TokenId'=>$tokenId,
            'search_id'=>$search_id,
            'EndUserIp'=>$req['EndUserIp']);
        // echo "<pre>";print_r($searchResponse);die;

        return $searchResponse;
    }
    
    function formatted_TBO_result($response,$request,$other_data){
            //echo '<pre>';print_r($response);exit();
            $search_data = json_decode(base64_decode($request), true);
            //echo '<pre>';print_r($search_data);exit();
            $hotel_response = $response; //$response['response_data'];
            $hotel_summary = array();
            
            foreach ( $hotel_response as $key => $hotel_detail ) {
            $hotel_summary[$key]['hotel_code'] = $hotel_detail['HotelCode'];
            $hotel_summary[$key]['hotel_name'] = $hotel_detail['HotelName'];
             $hotel_summary[$key]['ResultIndex'] = $hotel_detail['ResultIndex'];
            $hotel_summary[$key]['destination_code'] = $search_data['city_code'];
            $hotel_summary[$key]['destination_name'] = $search_data['city'];
            $hotel_summary[$key]['star_rating'] = $hotel_detail['StarRating'];
            $hotel_summary[$key]['facility'] = '';
            $hotel_summary[$key]['description'] = $hotel_detail['HotelDescription'];
            $hotel_summary[$key]['address'] = $hotel_detail['HotelAddress'];
            $hotel_summary[$key]['postal'] = '';
            $hotel_summary[$key]['primary_image'] = $hotel_detail['HotelPicture'];
            $hotel_summary[$key]['image'] = $hotel_detail['HotelPicture'];
            $hotel_summary[$key]['currency'] = $hotel_detail['Price']['CurrencyCode'];
            $hotel_summary[$key]['email'] = '';
            $hotel_summary[$key]['website'] = '';
            $hotel_summary[$key]['accomodation_type'] = '';
            $hotel_summary[$key]['contact'] = '';
            $hotel_summary[$key]['lat'] = $hotel_detail['Latitude'];
            $hotel_summary[$key]['lon'] = $hotel_detail['Longitude'];
            $hotel_summary[$key]['min_rate'] = ''; 
            $hotel_summary[$key]['max_rate'] = '';
            $hotel_summary[$key]['price'] = $hotel_detail['Price']['PublishedPrice'];
            $hotel_summary[$key]['base_fare'] = $hotel_detail['Price']['PublishedPrice'];
            $hotel_summary[$key]['markup'] = 0;
            $hotel_summary[$key]['gst'] = json_encode($hotel_detail['Price']['GST']);
            $hotel_summary[$key]['total_gst_amount'] = json_encode($hotel_detail['Price']['GST']);
            $hotel_summary[$key]['display_fare'] = $hotel_detail['Price']['PublishedPrice'];
            $hotel_summary[$key]['service_charge'] = $hotel_detail['Price']['ServiceCharge'];
            $hotel_summary[$key]['service_tax'] = $hotel_detail['Price']['ServiceTax'];
            $hotel_summary[$key]['api'] = $other_data['api'];
            $hotel_summary[$key]['search_id'] = $other_data['search_id'];
            $hotel_summary[$key]['TraceId'] = $other_data['TraceId'];
            $hotel_summary[$key]['TokenId'] = $other_data['TokenId'];
            $hotel_summary[$key]['EndUserIp'] = $other_data['EndUserIp'];
            
            }
            
            return $hotel_summary;
        }
        
    function tbo_hotel_info($search_id,$hotel_details,$PublishedPrice){
            $hotel_details_req          = json_encode($hotel_details);
            $logs_request['search_id']  = $search_id;
            $logs_request['request']    = $hotel_details_req;
            $logs_request['response']   = '';
            $logs_request['module']     = 'Hotel';
            $logs_request['type']       = 'hotelInfo';
            
            $api_id = $hotel_details['api_id'];
            
            $CI = & get_instance();
            $CI->load->model('hotel_model');
            
            $checkLogsHistory           = $CI->hotel_model->checkLogsHistory($search_id,'hotelInfo');
            
            if(empty($checkLogsHistory)){
              $ins_id = $CI->hotel_model->insLogsHistory($logs_request);
            }else{
              $ins_id = $checkLogsHistory[0]->id;
            }
            
            $xml_title = 'hotelInfo';
            
            //$requestUrl             = 'http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/GetHotelInfo';
            $requestUrl             = 'https://api.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/GetHotelInfo';

            // $requestUrl             = 'https://tboapi.travelboutiqueonline.com/BookingEngineService_Hotel/hotelservice.svc/rest/GetHotelInfo';
            $response['response']   = get_json_response_hotel($requestUrl,$hotel_details_req,$api_id,$xml_title);
            // debug($response['response']);exit;
            
            //echo '<pre>';print_r($response['response']);exit();
            
            $CI->hotel_model->updLogsHistory($response,$ins_id);
            
            $response                       = json_decode($response['response'], true);
            $response_data['hotel_details']     = $response['HotelInfoResult']['HotelDetails'];
            $response_data['search_id']         = $search_id;
            $response_data['PublishedPrice']    = $PublishedPrice;
            $response_data['hotelDetailsReq']   = $hotel_details_req;
            $response_data['ResultIndex']       = $hotel_details['ResultIndex'];
            $response_data['search_history']    = $CI->hotel_model->getSearchHistory($search_id);
            unset($logs_request['type']);
            $logs_request['type']       = 'hotelRoom';
            $checkLogsHistory1           = $CI->hotel_model->checkLogsHistory($search_id,'hotelRoom');
    
            if(empty($checkLogsHistory1)){
              $ins_id_a                   = $CI->hotel_model->insLogsHistory($logs_request);;
            }else{
              $ins_id_a                  = $checkLogsHistory1[0]->id;
            }
            
            $xml_title_a = 'hotelRoominfo';
            //$requestUrl_a                = 'http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/GetHotelRoom';
            $requestUrl_a                = 'https://api.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/GetHotelRoom';


            
            // $requestUrl_a                = 'http://api.tektravels.com/HotelAPI_V10/HotelService.svc/rest/GetHotelRoom';
            $roomResponse_a['response']  = get_json_response_hotel($requestUrl_a,$logs_request['request'],$api_id,$xml_title_a);
            $CI->hotel_model->updLogsHistory($roomResponse_a,$ins_id_a);
            $roomResponse_a  = json_decode($roomResponse_a['response'], true);
            $response_data['roomDetails'] = $roomResponse_a['GetHotelRoomResult']['HotelRoomsDetails'];
            
            return $response_data;

    }
    
    function tbo_room_list($search_id,$roomReq,$HotelName,$api_id){

        $logs_request['search_id']  = $search_id;
        $logs_request['request']    = $roomReq;
        $logs_request['response']   = '';
        $logs_request['module']     = 'Hotel';
        $logs_request['type']       = 'hotelRoom';
        $roomDetails['HotelName']   = $HotelName;
        
        $CI = & get_instance();
        $CI->load->model('hotel_model');
        $checkLogsHistory           = $CI->hotel_model->checkLogsHistory($search_id,'hotelRoom');

        if(empty($checkLogsHistory)){
          $ins_id                   = $CI->hotel_model->insLogsHistory($logs_request);
        }else{
          $ins_id                   = $checkLogsHistory[0]->id;
        }
        
        $xml_title='hotelRoominfo';
       // $requestUrl                 = 'http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/GetHotelRoom';
        $requestUrl                 = 'https://api.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/GetHotelRoom';

        
        $response['response']       = get_json_response_hotel($requestUrl,$roomReq,$api_id,$xml_title);

        $CI->hotel_model->updLogsHistory($response,$ins_id);
        $response  = json_decode($response['response'], true);

        $roomResponse = array(
            'roomDetails'=>$response['GetHotelRoomResult']['HotelRoomsDetails'],
            'search_history'=>$CI->hotel_model->getSearchHistory($search_id));

        return $roomResponse;
    }
    
    function tbo_room_blocking($search_id,$NoOfRooms,$RoomIndex,$RoomTypeCode,$RoomTypeName,$RatePlanCode,$SmokingPreference,$HotelName,$roomRequest,$api_id)
    {
        $CI = & get_instance();
        $CI->load->model('hotel_model');
        $getRoomDetails         = $CI->hotel_model->checkLogsHistory($search_id,'hotelRoom');
        
        $getRoomRes             = json_decode($getRoomDetails[0]->response);
        
        //echo '<pre>';print_r($getRoomRes);exit();
        
        $getRoomRes_new         = array();
        $roomRequest_a           = json_decode($roomRequest);
        
        $combinationCount       = count($getRoomRes->GetHotelRoomResult->RoomCombinations->RoomCombination);

        for ($i=0; $i < $combinationCount; $i++) {
            $getCombination     = $getRoomRes->GetHotelRoomResult->RoomCombinations->RoomCombination[$i]->RoomIndex;
            if(in_array($RoomIndex,$getCombination)){
                $selectedCombination = $getCombination;
            }
        }
        //echo '<pre>';print_r($selectedCombination);exit();
        
        foreach ($getRoomRes->GetHotelRoomResult->HotelRoomsDetails as $k => $v) {
            $allRoomIndex = $v->RoomIndex;
            foreach ($selectedCombination as $k1 => $v1) {
                $selectedRoomIndex = $v1;
                if($allRoomIndex == $selectedRoomIndex){
                    $getRoomRes_new[$allRoomIndex] =$v;
                }
            }
        }

        ksort($getRoomRes_new);
        
        //echo '<pre>';print_r($getRoomRes_new);exit();
        
        $blockReq['ResultIndex']        = $roomRequest_a->ResultIndex;
        $blockReq['HotelCode']          = $roomRequest_a->HotelCode;
        $blockReq['EndUserIp']          = $roomRequest_a->EndUserIp;
        $blockReq['TokenId']            = $roomRequest_a->TokenId;
        $blockReq['TraceId']            = $roomRequest_a->TraceId;
        $blockReq['HotelName']          = $HotelName;
        $blockReq['GuestNationality']   = 'IN';
        $blockReq['NoOfRooms']          = $NoOfRooms;
        $blockReq['ClientReferenceNo']  = 0;
        $blockReq['IsVoucherBooking']   = 1;

        foreach ($getRoomRes_new as $k => $v) {
            if($v->SmokingPreference == "NoPreference" || $v->SmokingPreference == ''){
                $SmokingPreference = 0;
            }else{
                $SmokingPreference = 1;
            }

            $blockReq['HotelRoomsDetails'][] = array(
                'RoomIndex'=>$v->RoomIndex,
                'RoomTypeCode'=>$v->RoomTypeCode,
                'RoomTypeName'=>$v->RoomTypeName,
                'RatePlanCode'=>$v->RatePlanCode,
                'SmokingPreference'=>$SmokingPreference,
                'Price'=>$v->Price,
                'BedTypeCode'=>null,
                'Supplements'=>null);
        }
        
        //echo '<pre>';print_r($blockReq);exit();
        
        $blockRoomReq = json_encode($blockReq);
        $logs_request['search_id']  = $search_id;
        $logs_request['request']    = $blockRoomReq;
        $logs_request['response']   = '';
        $logs_request['module']     = 'Hotel';
        $logs_request['type']       = 'RoomBlock';
        $checkLogsHistory           = $CI->hotel_model->checkLogsHistory($logs_request['search_id'],'RoomBlock');

        if(empty($checkLogsHistory)){
          $ins_id                   = $CI->hotel_model->insLogsHistory($logs_request);;
        }else{
          $ins_id                   = $checkLogsHistory[0]->id;
        }
        
        $xml_title = 'RoomBlockinfo';

       // $BlockRoomUrl = 'http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/BlockRoom';
       // $BlockRoomUrl = 'http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/BlockRoom';
        $BlockRoomUrl = 'https://api.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/BlockRoom';

        
        $blockRoomResponse['response'] = get_json_response_hotel($BlockRoomUrl,$blockRoomReq,$api_id,$xml_title);
        $CI->hotel_model->updLogsHistory($blockRoomResponse,$ins_id);
        $search_history             = $CI->hotel_model->getSearchHistory($logs_request['search_id']);

        $pageData['search_history'] = json_decode($search_history[0]->search_data);
        $pageData['search_id']      = $logs_request['search_id'];
        $pageData['blockRequest']   = $blockRoomReq;
        $pageData['blockResponse']   = $blockRoomResponse;
        
        return $pageData;   
    }
    
    function TBO_final_booking($booking_id,$search_id,$getPaxDetails,$getBlockReq)
    {
       // echo '<pre>';print_r($getBlockReq);exit();
     
        $bookReq['GuestNationality']    = 'IN';
        $bookReq['NoOfRooms']           = $getBlockReq->NoOfRooms;
        $bookReq['ClientReferenceNo']   = 0;
        $bookReq['IsVoucherBooking']    = true;
        //$paxDetails     = $getPaxDetails['data'];
        $paxDetails     = $getPaxDetails;

        $passengerCount = count($paxDetails);
        $roomCount      = count($getBlockReq->HotelRoomsDetails);
        $CI = & get_instance();
        $CI->load->model('hotel_model');
        $CI->load->model('booking_model');
        $search_history = $CI->hotel_model->getSearchHistory($search_id);
        $search_history = json_decode($search_history[0]->search_data);
      //  $search_data    = $search_history->hotel_search;
        $hotel_data = $CI->booking_model->getBookingHotelTemp($booking_id)->result();
       
        $cart_id = $hotel_data[0]->cart_id;
        $getPaxDetails = json_decode($getPaxDetails,true);
        // echo '<pre>';print_r($hotel_data);exit();
        $adtcount = 0;
        $chdcount = 0;
        /*extract($getPaxDetails);
        */
        $adtcount = count($getPaxDetails['first_name'.$cart_id]);
        //print_r($getPaxDetails['first_name'.$cart_id]);exit();
        
       // echo '<pre>';print_r($getPaxDetails);
        
     for ($i=0; $i < $roomCount; $i++) {
         
        for ($j=0; $j < $adtcount; $j++) {
            // ($i==0 && $j==0)? 
            $isLeadPax = true;
            // : $isLeadPax= false;
        $passengerList[] = array(
                        'Title'                     => $getPaxDetails['a_gender'.$cart_id][$j],
                        'FirstName'                 => $getPaxDetails['first_name'.$cart_id][$j],
                        'MiddleName'                => '',
                        'LastName'                  => $getPaxDetails['last_name'.$cart_id][$j],
                        'Email'                     => null,
                        'PaxType'                   => 1, //Need to change
                        'LeadPassenger'             => $isLeadPax,
                        'Age'                       => 0,
                        'PassportNo'                => null,
                        'PassportIssueDate'         => null,
                        'PassportExpDate'           => null,
                        'Phoneno'                   => null,
                        'PaxId'                     => 0,
                        'GSTCompanyAddress'         => null,
                        'GSTCompanyContactNumber'   => null,
                        'GSTCompanyName'            => null,
                        'GSTNumber'                 => null,
                        'GSTCompanyEmail'           => null,
                       
                    );
        }     
        
        $chdcount = count($getPaxDetails['cfirst_name'.$cart_id]);
        
        //echo $chdcount;exit();
        
        for ($k=0; $k < $chdcount; $k++) {
                $isLeadPax = false;
                $passengerList[] = array(
                    'Title'                     => $getPaxDetails['c_gender'.$cart_id][$k],
                    'FirstName'                 => $getPaxDetails['cfirst_name'.$cart_id][$k],
                    'MiddleName'                => '',
                    'LastName'                  => $getPaxDetails['clast_name'.$cart_id][$k],
                    'Email'                     =>  null,
                    'PaxType'                   => 2, //Need to change
                    'LeadPassenger'             => $isLeadPax,
                    'Age'                       => 0,
                    'PassportNo'                => null,
                    'PassportIssueDate'         => null,
                    'PassportExpDate'           => null,
                    'Phoneno'                   => null,
                    'PaxId'                     => 0,
                    'GSTCompanyAddress'         => null,
                    'GSTCompanyContactNumber'   => null,
                    'GSTCompanyName'            => null,
                    'GSTNumber'                 => null,
                    'GSTCompanyEmail'           => null,
                       
                );
        }

            $passengerList1 = $passengerList;
            unset($passengerList);
            
            // echo '<pre>';print_r($passengerList1);exit();
       
            $roomDetails = $getBlockReq->HotelRoomsDetails[$i];
            $bookReq['HotelRoomsDetails'][$i]['RoomIndex']          = $roomDetails->RoomIndex;
            $bookReq['HotelRoomsDetails'][$i]['RoomTypeCode']       = $roomDetails->RoomTypeCode;
            $bookReq['HotelRoomsDetails'][$i]['RatePlanCode']       = $roomDetails->RatePlanCode;
            $bookReq['HotelRoomsDetails'][$i]['BedTypeCode']        = $roomDetails->BedTypeCode;
            $bookReq['HotelRoomsDetails'][$i]['SmokingPreference']  = $roomDetails->SmokingPreference;
            $bookReq['HotelRoomsDetails'][$i]['Supplements']        = $roomDetails->Supplements;
            $bookReq['HotelRoomsDetails'][$i]['Price']              = $roomDetails->Price;
            $bookReq['HotelRoomsDetails'][$i]['HotelPassenger']     = $passengerList1;
        }
            
        $bookReq['ArrivalTransport']['ArrivalTransportType']    = 0;
        $bookReq['ArrivalTransport']['TransportInfoId']         = "Ab 777";
        $bookReq['ArrivalTransport']['Time']                    = "0001-01-01T00:00:00";
        $bookReq['FlightInfo']                                  = null;
        $bookReq['OnlinePaymentId']                             = 0;
        $bookReq['TransactionId']                               = null;
        $bookReq['CancelAtPriceChangeAfterBooking']             = "true";
        $bookReq['IsAmountDeduct']                              = "false";
        $bookReq['IsHotelImport']                               = "false";
        $bookReq['MakePaymentInfo']                             = null;
        $bookReq['IsPackageFare']                               = true;
        $bookReq['HotelCode']                                   = $getBlockReq->HotelCode;
        $bookReq['HotelName']                                   = $getBlockReq->HotelName;
        $bookReq['ResultIndex']                                 = $getBlockReq->ResultIndex;
        $bookReq['EndUserIp']                                   = $getBlockReq->EndUserIp;
        $bookReq['TokenId']                                     = $getBlockReq->TokenId;
        $bookReq['TraceId']                                     = $getBlockReq->TraceId;
        $bookReq['CategoryIndexes']                             = null;
        $bookReq['CategoryId']                                  = null;

        
        
        $bookRequest = json_encode($bookReq);
       // echo '<pre>';print_r($bookRequest);exit();
        
         
        $logs_request['search_id']  = $search_id;
        $logs_request['request']    = $bookRequest;
        $logs_request['response']   = '';
        $logs_request['module']     = 'Hotel';
        $logs_request['type']       = 'roomBookingInfo';
    // echo "<pre/>";print_r($logs_request);die;
        $checkLogsHistory           = $CI->hotel_model->checkLogsHistory($logs_request['search_id'],'RoomBook');
        if(empty($checkLogsHistory)){
          $ins_id                   = $CI->hotel_model->insLogsHistory($logs_request);;
        }else{
          $ins_id                   = $checkLogsHistory[0]->id;
        }
        
        $api_id = $hotel_data[0]->api;
        $xml_title = 'roomBookingInfo';
        
       // $BookRoomUrl                = 'http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/Book';
       // $BookRoomUrl = 'http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/Book';
        $BookRoomUrl = 'https://api.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/Book';  
        $bookRoomResponse['response'] = get_json_response_hotel($BookRoomUrl,$bookRequest,$api_id,$xml_title);

        $CI->hotel_model->updLogsHistory($bookRoomResponse,$ins_id);
        $bookResponse   = json_decode($bookRoomResponse['response']);
        $booking_status = $bookResponse->BookResult->Status;
        
         //echo "<pre/>";print_r($bookResponse);exit(' hotel booking');

        if($booking_status == 1){
            $updateRes1['status']                 = 'BOOKING_CONFIRMED';
            $updateRes1['booking_id']             = $bookResponse->BookResult->BookingId;
            $updateRes1['booking_reference']      = $bookResponse->BookResult->BookingRefNo;
            $updateRes1['confirmation_reference'] = $bookResponse->BookResult->ConfirmationNo;
        }

        return $bookResponse;

    }
    
    function get_json_response_auth(){
        $request["UserName"]= "IXCT029";
        $request["Password"]= "Trip@#Trvl/898";
        $request["ClientId"]= "tboprod";
        $request["EndUserIp"]= "103.78.245.113";
/*testing credential*/
        // $request["UserName"]= "Aktours";
        // $request["Password"]= "Aktoursl@123";
        // $request["ClientId"]= "ApiIntegrationNew";
        // $request["EndUserIp"]= "127.0.0.1";
           //  $request['UserName']          = 'tripg';
           //  $request['Password']            = 'tripg@1234';                       
           // // $request['Url']           = 'http://api.tektravels.com/SharedServices/SharedData.svc/rest/';
           //  $request['ClientId']           = 'ApiIntegrationNew';
           //  $request["EndUserIp"]= "127.0.0.1";

        $request_data = json_encode($request);
        $url = 'https://api.travelboutiqueonline.com/SharedAPI/SharedData.svc/rest/authenticate';
        //$url='http://api.tektravels.com/SharedServices/SharedData.svc/rest/authenticate';
         $auth_detail1=json_encode($request);
         $data=tbo_curl($url,$auth_detail1);

 //echo "<pre/>";print_r($data);exit('>>>>>>>>>>');

         return $data;
    }
    
    function get_json_response_hotel($url,$request,$api_id='',$xml_title=''){
        // debug($url);
        // debug($request);
          
        $credentials_data = set_credentials_hotel($api_id);  
        
        $header=array(
            'Content-Type:application/json',
            'Accept-Encoding:gzip, deflate'
        );
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_FAILONERROR => true,
          CURLOPT_POSTFIELDS =>$request,
          CURLOPT_HTTPHEADER => $header,
        ));

        $response = curl_exec($curl);
        if(curl_errno($curl)){
            $error_msg = curl_error($curl);
        debug($error_msg);die;
        }
        // debug($response);die;

        curl_close($curl);
        // echo $response;die;
        if (isset($error_msg)) {
            echo 'Request Error:' . curl_error($curl);die;
        }
         //$response = json_decode($response, true);
        
       // echo '<pre>';print_r($response);exit();
       // debug($response);exit;
        
        $requestcml = $xml_title.'_request'.date('mdHis').'.xml';
        $responsecml = $xml_title.'_response'.date('mdHis').'.xml';
        
        write_file('logs/hotel/tbo/'.$requestcml,$request, 'w+');
        write_file('logs/hotel/tbo/'.$responsecml,$response, 'w+');
        return $response;
    }




function tbo_curl($hit_url,$request){
    // debug($hit_url);
    // debug($request);
      $file=explode('/',$hit_url);
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
      CURLOPT_POSTFIELDS =>$request,
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Accept-Encoding: gzip, deflate"
      ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        // debug($response);exit;

    $final_de = date('Ymd_His')."_".rand(1,10000);
    $XmlReqFileName = $file[6].'_Req'.$final_de;
    $XmlResFileName = $file[6].'_Res'.$final_de;
   /* $fp = fopen("logs/HOTEL/TBO/".$XmlReqFileName.'.txt', 'a+');
    fwrite($fp, $request);
    fclose($fp);
    $fp = fopen("logs/HOTEL/TBO/".$XmlResFileName.'.txt', 'a+');
    fwrite($fp, $response);
    fclose($fp);*/
    return $response;

}






   
?>
