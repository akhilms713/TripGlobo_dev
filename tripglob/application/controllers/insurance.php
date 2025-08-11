<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
error_reporting(0);

class Insurance extends CI_Controller {
            public function __construct() {
        parent::__construct();
        $current_url = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
        $current_url = WEB_URL . $this->uri->uri_string() . $current_url;
        $url = array('continue' => $current_url);
        $this->perPage = 100000;
        $this->session->set_userdata($url);
        $this->load->model('Home_Model');
        $this->load->model('Insurance_model');
        $this->load->model('cart_model');
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->model('booking_model');
        $this->load->model('custom_db'); 
        $this->load->helper('flight/tbo_helper'); 
        $this->load->library('Insurance_api');
        $this->curr_val = 1;
    }



public function search($app_reference){ 
        $data =array();
        $data = $this->input->get();  
        $dd = implode(" ", $data['age']); 
        $d = str_replace(" ", ',', $dd);  
        $insert_data['search_data'] = json_encode($data); 
        $insert_data['search_type'] = 'Insurance'; 
        $search_insert_data = $this->custom_db->insert_record('search_history',$insert_data); 
        $data['search_id'] = $search_insert_data['insert_id']; 
        $data['transfer_search_params'] = $data;  
        $get_search_data = $this->Home_Model->get_search_data($data['search_id']); 
        $srch_data = json_decode($get_search_data[0]['search_data'],true);
        $data['srch_data'] = $srch_data;  
 
        $get_api_resp=$this->get_api_resp($data['search_id']);  
        if($get_api_resp ==""){ 
 			echo $this->load->view(PROJECT_THEME.'/bus/bus_result_loader'); 
		} 
        $response = json_decode($get_api_resp,true); 
        $data['response'] = $response; 
        if($response['Response']['ResponseStatus']==1){ 
        $this->load->view(PROJECT_THEME.'/insurance/search_result_page', $data);     
    	}else{ 
    	// echo	$this->load->view(PROJECT_THEME.'/insurance/no_result.php');     
    	redirect(WEB_URL.'error/no_result/'.base64_encode($text)); exit;
    	}
}




public function get_api_resp($search_id){ 
	
        $get_search_data_transfer = $this->Insurance_model->get_search_data_insurance($search_id);  
        $search_data = $get_search_data_transfer[0]['search_data'];
        $Response = $this->insurance_api->insurance_api_response($search_data,$search_id);   
        return $Response;

}
 

public function addToCart($data)
{  
	$d = unserialize(urldecode($data));   
	$get_search_data_transfer = $this->Insurance_model->get_search_data_insurance($d['search_id']);  
	$get_country = $this->Insurance_model->get_country();   
	$pt = "https://tripglobo.com"."/logs/insurance/search/search_res".$d['search_id'].".json";  
	$filesss = fopen($pt,"r"); 
	$api_resp = fgets($filesss); 
	fclose($filesss); 
	$api_res_decode = json_decode($api_resp,true);   
	$dataa = $api_res_decode['Response']['Results'];
	foreach ($dataa as $key => $value) 
			{  
		        if($value['ResultIndex']==$d['ResultIndex'])
			        {  
			        	$PremiumList = $value['PremiumList']; 
			        	$PlanName = $value['PlanName']; 
			        }
			} 
	$dataa['PremiumList'] 				= $PremiumList;
	$dataa['PlanName'] 					= $PlanName;
	$dataa['get_search_data_transfer'] 	= $get_search_data_transfer[0]['search_data'];
	$dataa['search_id']   				= $d['search_id']; 
	$dataa['get_country']   			= $get_country; 
	$dataa['TraceId']   				= $api_res_decode['Response']['TraceId']; 
	$dataa['ResultIndex']   				= $d['ResultIndex']; 
	$this->load->view(PROJECT_THEME.'/insurance/booking_page', $dataa);      
}
 
public function Booking($search_id){ 
	debug("booking blocked"); die; 
	   	$data 													= $this->input->get(); 
	   	$bbok_detl  											=$data;
	   	$token = get_tokens(); 
	   	$TokenId 												= $token; 
		$transaction_id 										=  'app_ref'.'-'. 'insurance' . '-' . date ( 'dmHi' ) . '-' . rand ( 1000, 9999 );  
		$rqust 													= json_encode($data);  
	   	$transaction_id = $this->Home_Model->insert_booking_detail_request($transaction_id,$search_id,$rqust); 

	   	$get_txn_id = $this->Home_Model->get_txn_number($transaction_id);

	   	$transaction_id = $get_txn_id[0]['transaction_id'];

		$TokenId 												= $TokenId; 
		$book_request 											= array();  
		$book_request['TokenId'] 								= $TokenId;
		$book_request['EndUserIp'] 								= "182.156.5.54";
		$book_request['TraceId'] 								= $data['TraceId'];
		$book_request['GenerateInsurancePolicy'] 				= false;
		$book_request['ResultIndex'] 							= $data['ResultIndex']; 
		$pax_counts 											= count($data['insured_name_title']);  
		for($i=0;$i<$pax_counts;$i++) {  
		$book_request['Passenger'][$i]['Title'] 				= $data['insured_name_title'][$i];
		$book_request['Passenger'][$i]['FirstName'] 			= $data['Ins_f_name'][$i];
		$book_request['Passenger'][$i]['LastName'] 				= $data['Ins_l_name'][$i]; 
		$book_request['Passenger'][$i]['BeneficiaryTitle'] 		= $data['Beneficiary_title'][$i]; 
		$book_request['Passenger'][$i]['BeneficiaryName'] 		= $data['Beneficiary_title'][$i]." ".$data['Benef_f_name'][$i]." ".$data['Benef_l_name'][$i];
		
		$book_request['Passenger'][$i]['RelationShipToInsured'] = "Self";
		$book_request['Passenger'][$i]['RelationToBeneficiary'] = $data['rel_insured'][$i]; 
		$book_request['Passenger'][$i]['Gender'] 				= $data['sex'][$i];
		$book_request['Passenger'][$i]['Sex'] 					= $data['sex'][$i];
		$book_request['Passenger'][$i]['DOB'] 					= $data['dob'][$i]."T00:00:00";
		$book_request['Passenger'][$i]['PassportNo'] 			= $data['passport_num'][$i];
		$book_request['Passenger'][$i]['PassportCountry'] 		= $data['major_destination'][$i]; 
		$book_request['Passenger'][$i]['PhoneNumber'] 			= $data['mobile'][$i];
		$book_request['Passenger'][$i]['EmailId'] 				= $data['email'][$i];
		$book_request['Passenger'][$i]['AddressLine1'] 			= $data['address'][$i];
		$book_request['Passenger'][$i]['AddressLine2']  		= $data['address'][$i];
		$book_request['Passenger'][$i]['CityCode'] 				= $data['city'][$i];
		$book_request['Passenger'][$i]['CountryCode'] 			= $data['country'][$i];  
		$book_request['Passenger'][$i]['MajorDestination']  	= $data['major_destination'][$i];
		$book_request['Passenger'][$i]['PinCode'] 				= $data['pincode'][$i];
		}   
		$book_req = json_encode($book_request);
		// Book API
	    $Response = $this->insurance_api->insurance_book_response($book_req,$search_id);  

	    $decode_response = json_decode($Response,true);

	    // $decode_response['Response']['ResponseStatus'] =0;
	    if($decode_response['Response']['ResponseStatus']==1){ 

	    foreach ($decode_response['Response']['Itinerary']['PaxInfo'] as $key => $value) { 


	    		 $Price += $value['Price']['PublishedPrice'];
	    		 $Currency += $value['Price']['Currency'];

	    }

	    $Itinerary = json_encode($decode_response['Response']['Itinerary']);
	    $booking_id= $decode_response['Response']['Itinerary']['BookingId'];
 
	    $book_response = json_decode($Response,true);
	    // debug($book_response);  
	    $lead_pax_name= $book_response['Response']['Itinerary']['PaxInfo'][0]['Title']." ".$book_response['Response']['Itinerary']['PaxInfo'][0]['FirstName']." ".$book_response['Response']['Itinerary']['PaxInfo'][0]['LastName'];
	    $dat['leadpax'] = $lead_pax_name;
	    $dat['voucher_date'] = $book_response['Response']['Itinerary']['CreatedOn'];
	    $dat['PolicyStartDate'] = $book_response['Response']['Itinerary']['PolicyStartDate'];
	    $dat['booking_id'] = $book_response['Response']['Itinerary']['BookingId'];
	    if($book_response['Response']['Itinerary']['BookingId']!=""){

	    $dat['booking_status'] = "CONFIRMED";
	    } 

	    $this->Home_Model->insert_booking_global($dat,$search_id,$booking_id,$transaction_id);  
		// please uncomment below line 
	    $this->Home_Model->insert_booking_detail_response($Itinerary,$search_id,$booking_id,$transaction_id);
 
	   	$this->Home_Model->insert_booking_transaction($Price,$Currency,$transaction_id);   
 
	    $generatepolicy = array();
	    $generatepolicy['EndUserIp']="182.156.5.54";
	    $generatepolicy['TokenId']=$TokenId;
	    $generatepolicy['BookingId']=$booking_id;

	    $request = json_encode($generatepolicy); 

	    $GeneratePolicy_Response = $this->insurance_api->Insurance_GeneratePolicy($booking_id,$search_id,$request);   
	    // debug($GeneratePolicy_Response); die;
	    $this->Home_Model->Update_GeneratePolicy_Response($GeneratePolicy_Response,$booking_id);  
	    $GetBookingDetail_Response = $this->insurance_api->GetBookingDetail($booking_id,$search_id,$request);   

	    $this->Home_Model->Update_GetBookingDetail_Response($GeneratePolicy_Response,$booking_id);   

	    redirect('insurance/get_voucher/'.$booking_id.'/'.$search_id); 

	 }else{ 
 
	 	$transaction_id = $transaction_id; 
	 	$name = $bbok_detl['insured_name_title'][0]." ".$bbok_detl['Ins_f_name'][0]." ".$bbok_detl['Ins_l_name'][0];  
	 	$status = "FAILED";
	 	$booking_id="0";
	 	$dataaa = array();
	 	$dataaa['booking_status'] = $status;
	 	$dataaa['leadpax'] = $name; 

        $this->Home_Model->insert_booking_global($dataaa,$search_id,$booking_id,$transaction_id); 

    	$plan = $bbok_detl['plan_name'];
    	$Price = $bbok_detl['prices'];
    	$Currency = "USD";

        $this->Home_Model->insert_booking_transaction_failed($Price,$Currency,$transaction_id,$plan); 

        $text="Booking Failed from API side";
	 	redirect(WEB_URL.'error/booking_failure/'.base64_encode($text)); exit;
	 }

	}


public function get_voucher($booking_id,$search_id){
 
$text="Booking Failed from API side";

if($booking_id!=""){ 

		$get_generate_policy_details = $this->Home_Model->get_generate_policy_details($booking_id); 
		$dataa['GeneratePolicy_Response'] =  json_decode($get_generate_policy_details[0]['GeneratePolicy_Response'],true);
		$dataa['Itinerary'] =  json_decode($get_generate_policy_details[0]['Itinerary'],true);
		$dataa['GetBookingDetail'] =  json_decode($get_generate_policy_details[0]['GetBookingDetail'],true);
		$dueration  = $this->Home_Model->get_search_data($search_id);
		  $dd = json_decode($dueration[0]['search_data'],true); 
		$dataa['duration'] =  $dd['duration']; 
		   $this->load->view(PROJECT_THEME.'/insurance/insurance_voucher', $dataa); 
		}else{
		   	redirect(WEB_URL.'error/booking_failure/'.base64_encode($text)); exit;
		   }

	}
public function transfer_list($search_id =''){ } 

}

	
	
?>