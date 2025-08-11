<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*============== TBO code===================================*/
function set_credentials($api) {
		$CI = & get_instance();
		$api_usage = "TEST";
		$CI->load->model('General_Model');         
        $query = $CI->General_Model->get_api($api, $api_usage);
        if ($query->num_rows() == 0) {
            $data['set_credentials'] = FALSE;
        } else {  
            $api_info = $query->row(); 
            $data['onlinekey'] 			= $api_info->api_username;
            $data['secrete'] 			= $api_info->api_password;
            $data['signature'] 			= hash("sha256",$data['onlinekey'].$data['secrete'].time());
            $data['post_url'] 			= $api_info->api_url;
            $data['set_credentials'] 	= TRUE;
            $data['active_api'] 		= $api;
        } return $data;
    }
    
    function tbo_bus_cancel($data,$api_id)
    {
        //echo '<pre>';print_r($data);exit();
        
        $changeRequestdata = json_encode($data);
        
       // echo '<pre>';print_r($cancelRequestdata);exit();
        
        $xml_title = 'SendChangeRequest';
        
        $changeRequestURL  = 'http://api.tektravels.com/BookingEngineService_Bus/busservice.svc/rest/SendChangeRequest';
        $SendChangeRequest_response = get_json_response($changeRequestURL,$changeRequestdata,$api_id,$xml_title);
        
       // echo '<pre>';print_r($SendChangeRequest_response);exit();
        
        $SendChangeRequest_response = json_decode($SendChangeRequest_response, true);
        
        //echo '<pre>';print_r($SendChangeRequest_response);
        
        /*=============== get cancel request status===============*/
        
            if($SendChangeRequest_response['BusChangeRequestResult']['ResponseStatus'] == 1 && !empty($SendChangeRequest_response['BusChangeRequestResult']['ChangeRequestId']))
            {
                $data_arr['BookingMode'] = 5;
                $data_arr['ChangeRequestId'] = $SendChangeRequest_response['BusChangeRequestResult']['ChangeRequestId'];
                $data_arr['EndUserIp'] = $data['EndUserIp'];
                $data_arr['TokenId'] = $data['TokenId'];
                
                $GetChangeRequestStatus_data = json_encode($data_arr);
                
                $xml_title_a = 'GetChangeRequestStatus';
                
                $GetChangeRequestStatus_url  = 'http://api.tektravels.com/BookingEngineService_Bus/busservice.svc/rest/GetChangeRequestStatus/';
                $GetChangeRequestStatus_response = get_json_response($GetChangeRequestStatus_url,$GetChangeRequestStatus_data,$api_id,$xml_title_a);
                
                $GetChangeRequestStatus_response = json_decode($GetChangeRequestStatus_response, true);
                
                //echo '<pre>';print_r($GetChangeRequestStatus_response);
                
                if($SendChangeRequest_response['BusChangeRequestResult']['ResponseStatus'] == 1)
                {
                     $updateRes['status']  = true;
                     $updateRes['service_charge']  = json_encode($SendChangeRequest_response['BusChangeRequestResult']['TotalServiceCharge']);
                     $updateRes['cancellation_charge']  = json_encode($SendChangeRequest_response['BusChangeRequestResult']['CancellationChargeBreakUp']);
                     
                }else{
                    $updateRes['status']  = false;
                }
            
            }else{
                $updateRes['status'] = false;
        }
        
        return $updateRes;
        
        //echo '<pre>';print_r($updateRes);exit();
        
    }
    
    function get_json_response_auth(){
        $header=array(
            'Content-Type:application/json',
            'Accept-Encoding:gzip, deflate'
        );
        $request["UserName"]= "tripg";
        $request["Password"]= "tripg@1234";
        $request["ClientId"]= "ApiIntegrationNew";
        $request["EndUserIp"]= "45.112.20.146";
        $request_data = json_encode($request);
        
        $url = 'http://api.tektravels.com/SharedServices/SharedData.svc/rest/Authenticate';
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
        $res = curl_exec($ch);
        if(curl_errno($ch)){
            $error_msg = curl_error($ch);
        }
        curl_close($ch);
        if (isset($error_msg)) {
            echo 'Request Error:' . curl_error($ch);die;
        }
        $res = json_decode($res, true);
        return $res;
    }
    
    function get_json_response($url,$request,$api_id='',$xml_title=''){
          
        //$credentials_data = set_credentials($api_id);  
        
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
          CURLOPT_POSTFIELDS =>$request,
          CURLOPT_HTTPHEADER => $header,
        ));

        $response = curl_exec($curl);
        if(curl_errno($curl)){
            $error_msg = curl_error($curl);
        }

        curl_close($curl);
        // echo $response;die;
        if (isset($error_msg)) {
            echo 'Request Error:' . curl_error($curl);die;
        }
        // $response = json_decode($response, true);
        
        //echo '<pre>';print_r($response);exit();
        
        $requestcml = $xml_title.'_request'.date('mdHis').'.xml';
        $responsecml = $xml_title.'_response'.date('mdHis').'.xml';
        
        
         
        return $response;
    }
    
    
   
?>
