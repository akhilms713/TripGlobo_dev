<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(-1);
/**
 * provab
 *
 * Travel Portal Application
 *
 * @package		provab
 * @author		Balasab A<balasab.muddebihal@provabmail.com>
 * @copyright	Copyright (c) 2013 - 2014
 * @link		http://provab.com
 */

class Insurance_api  extends CI_Controller {

	/**
	 * Provab Email Class
	 *
	 * Permits email to be sent using Mail, Sendmail, or SMTP.
	 *
	 * @package		provab
	 * @subpackage	Libraries
	 * @category	Libraries
	 * @author		Balasab A<balasab.muddebihal@provabmail.com>
	 * @link		http://provab.com
	 */
	public $CI;                     //instance of codeigniter super object
	public $mailer_status;         //mailer status which indicates if the mail should be sent or not
	public $mail_configuration;    //mail configurations defined by user
    
    public function __construct()
    {
        parent::__construct();
        $this->CI = &get_instance();
        $this->load->model('Home_Model'); 
        $this->load->helpers('debug_helper'); 
    }


	public function insurance_api_response($search_data,$search_id){ 

		// debug($search_data); die;
			$search_data_ = json_decode($search_data,true);   
			$get_new_token=$this->Home_Model->get_token_deta(); 
			$token_id = $get_new_token[0]['token'];  
			// debug($token_id); die;

			$token = get_tokens(); 
			$token_id = $token; 

			/*if($search_data_['destinations']="Domestic"){ 
			$plancatagory = "4";
			}
			if($search_data_['destinations']="US/Canada"){  
			$plancatagory = "1";
			}
			if($search_data_['destinations']="Non US"){
			$plancatagory = "2"; 
			} 
			if($search_data_['destinations']=="Worldwide"){
			$plancatagory = "3"; 
			}*/
			if($search_data_['destinations']=="Domestic"){ 
				$plancatagory = "1";
			}
			else{  
				$plancatagory = "2";
			}
			
			if($search_data_['trip_type']=="annual-multi"){ 
				$trip_type	=2;
			}else{
				$trip_type	=1;
			} 
			if($search_data_['destinations']=="Domestic"){ 
			$PlanCoverage = "4";
			}
			if($search_data_['destinations']=="US/Canada"){  
			$PlanCoverage = "1";
			}
			if($search_data_['destinations']=="Non US"){
			$PlanCoverage = "2"; 
			} 
			if($search_data_['destinations']=="Worldwide"){
			$PlanCoverage = "3"; 
			}  
			$pax_detail = array($search_data_['age']); 
			$pax_detail = '['.$pax_detail[0].']'; 
			$depart_date = $search_data_['depart_date'].'T00:00:00';  
			if($search_data_['return-date']!=""){ 
			$arrival_date = $search_data_['return_date'].'T00:00:00'; 
			} 
			$pax_detailss = str_replace('"', "", $search_data_['age']);   

			$post_fields=array(); 
			$post_fields['PlanCategory'] = $plancatagory;
			$post_fields['PlanType'] = $trip_type;
			$post_fields['PlanCoverage'] = $PlanCoverage;
			$post_fields['TravelStartDate'] = $depart_date; 
			if($search_data_['return_date']!=""){ 
			$post_fields['TravelEndDate'] = $arrival_date;
			}
			$post_fields['NoOfPax'] = $search_data_['pax'];
			$post_fields['PaxAge'] = $pax_detailss; 
			$post_fields['EndUserIp'] = "182.156.5.54";
			$post_fields['TokenId'] = $token_id; 
 			$request_crl = json_encode($post_fields);
  
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'http://api.tektravels.com/BookingEngineService_Insurance/InsuranceService.svc/rest/Search',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>$request_crl,
			  CURLOPT_HTTPHEADER => array(
			    'Content-Type: application/json'
			  ),
			));

			$response = curl_exec($curl); 
			curl_close($curl); 
			$path = PROJECT_PATH."/logs/insurance/search/search_req".$search_id.".json"; 
			$fp = fopen($path,"wb");fwrite($fp,$request_crl);fclose($fp); 
			$path = PROJECT_PATH."/logs/insurance/search/search_res".$search_id.".json"; 
			$fp = fopen($path,"wb");fwrite($fp,$response);fclose($fp); 
			return  $response;    
	}

	public function insurance_book_response($book_req,$search_id){
	  //  debug($book_req);
	  // DEBUG('BOOKING BLOCKED...uNDER dEVELOPMENT...!! '); 
	  // debug(json_decode($book_req,true));  die; 
	   $curl 					= curl_init(); 
	  curl_setopt_array($curl, array(
	  CURLOPT_URL 				=> 'http://api.tektravels.com/BookingEngineService_Insurance/InsuranceService.svc/rest/Book',
	  CURLOPT_RETURNTRANSFER 	=> true,
	  CURLOPT_ENCODING 			=> '',
	  CURLOPT_MAXREDIRS 		=> 10,
	  CURLOPT_TIMEOUT 			=> 0,
	  CURLOPT_FOLLOWLOCATION 	=> true,
	  CURLOPT_HTTP_VERSION 		=> CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST 	=> 'POST',
	  CURLOPT_POSTFIELDS 		=>$book_req,
	  CURLOPT_HTTPHEADER 		=> array(
	    'Content-Type: application/json'
	  ),
	  )); 
	  $response = curl_exec($curl);

	  curl_close($curl);

	  $path 	= PROJECT_PATH."/logs/insurance/book/book_req".$search_id.".json"; 
	  $fp 		= fopen($path,"wb");fwrite($fp,$book_req);fclose($fp); 
	  $path 	= PROJECT_PATH."/logs/insurance/book/book_res".$search_id.".json"; 
	  $fp 		= fopen($path,"wb");fwrite($fp,$response);fclose($fp);  

	  // debug($book_req);
	  // debug(json_decode($response,true)); die; 
	  /*$response ='{"Response":{"ResponseStatus":1,"Error":{"ErrorCode":0,"ErrorMessage":""},"TraceId":"18940b24-e2ea-4e37-a9c6-de03a5f8defc","Itinerary":{"BookingId":1924685,"InsuranceId":23940,"PlanType":1,"PlanName":"SANKASH 50D 7 DAYS (additional 10% cashback)","PlanDescription":null,"PlanCoverage":4,"CoverageDetails":[{"Coverage":"Hospitalization expenses for Injury","SumInsured":"50000","Excess":null},{"Coverage":"Outpatient Treatment Expenses for Injury","SumInsured":"20000","Excess":null},{"Coverage":"Medical Evacuation","SumInsured":"50000","Excess":null},{"Coverage":"Personal Accident","SumInsured":"300000","Excess":null},{"Coverage":"Trip Cancellation","SumInsured":"10000","Excess":null},{"Coverage":"Trip Interruption & Curtailment","SumInsured":"10000","Excess":null},{"Coverage":"Repatriation of remains","SumInsured":"50000","Excess":null},{"Coverage":"Total Loss of Checked-in Baggage","SumInsured":"3000","Excess":null},{"Coverage":"Delay of Checked-in Baggage","SumInsured":"1000","Excess":null}],"PlanCategory":1,"PaxInfo":[{"PaxId":28680,"PolicyNo":"","ClaimCode":null,"SiebelPolicyNumber":"","ReferenceId":"TBO-23092024115328730","DocumentURL":null,"MaxAge":70.00,"MinAge":1.00,"Title":"Mr","FirstName":"Mohan","LastName":"Kumar","Gender":"Male","DOB":"1977-09-07T00:00:00","BeneficiaryName":"Mr Raj Kumar","RelationShipToInsured":"Self","RelationToBeneficiary":"Brother","EmailId":"balasab.muddebihal@provabmail.com","PhoneNumber":"8698745877","PassportNo":"india7899798","AddressLine1":"Electronic city Bangalore india","AddressLine2":"Electronic city Bangalore india","Country":"India","State":"Bangalore","City":"Bangalore","PinCode":"560100","MajorDestination":"INDIA","Price":{"Currency":"INR","GrossFare":60,"PublishedPrice":60,"PublishedPriceRoundedOff":60,"OfferedPrice":60,"OfferedPriceRoundedOff":60,"CommissionEarned":0,"TdsOnCommission":0,"ServiceTax":0,"SwachhBharatTax":0,"KrishiKalyanTax":0},"OldPolicyNumber":"","PolicyStatus":2,"ErrorMsg":""}],"PolicyStartDate":"2025-01-15T00:00:00","PolicyEndDate":"2025-01-15T00:00:00","CreatedOn":"2024-09-23T11:53:28","Source":"Sankash","IsDomestic":true,"Status":2,"BookingHistory":[{"CreatedBy":54728,"CreatedByName":"tbo tbo","CreatedOn":"2024-09-23T11:53:28","EventCategory":7,"LastModifiedBy":54728,"LastModifiedByName":"tbo tbo","LastModifiedOn":"2024-09-23T11:53:28","Remarks":"Booking is Ready (Booked By BookingAPI). Insurance details saved for PlanCode : 1 | Source : Sankash (through New BookingEngine Service). | IP Address :- 103.86.177.227 | MSDTC : OFF"}],"GSTIN":null,"SupplierName":"SANKASH"}}}';*/

	  return  $response; 
	} 



	public function Insurance_GeneratePolicy($booking_id,$search_id,$request){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://api.tektravels.com/BookingEngineService_Insurance/InsuranceService.svc/rest/GeneratePolicy',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>$request,
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

	  $path 	= PROJECT_PATH."/logs/insurance/GeneratePolicy/generate_policy_req".$search_id.".json"; 
	  $fp 		= fopen($path,"wb");fwrite($fp,$request);fclose($fp); 
	  $path 	= PROJECT_PATH."/logs/insurance/GeneratePolicy/generate_policy_res".$search_id.".json"; 
	  $fp 		= fopen($path,"wb");fwrite($fp,$response);fclose($fp);   

	  /*$response ='{"Response":{"ResponseStatus":1,"Error":{"ErrorCode":0,"ErrorMessage":""},"TraceId":"18940b24-e2ea-4e37-a9c6-de03a5f8defc","Itinerary":{"BookingId":1924685,"InsuranceId":23940,"PlanType":1,"PlanName":"Gold","PlanDescription":"Worldwide  USD 250,000   ","PlanCoverage":1,"CoverageDetails":null,"PlanCategory":1,"PaxInfo":[{"PaxId":28680,"PolicyNo":"","ClaimCode":null,"SiebelPolicyNumber":"","ReferenceId":"TBO-23092024115328730","DocumentURL":null,"MaxAge":70.00,"MinAge":1.00,"Title":"Mr","FirstName":"Mohan","LastName":"Kumar","Gender":"Male","DOB":"1977-09-07T00:00:00","BeneficiaryName":"Mr Raj Kumar","RelationShipToInsured":"Self","RelationToBeneficiary":"Brother","EmailId":"balasab.muddebihal@provabmail.com","PhoneNumber":"8698745877","PassportNo":"india78997","AddressLine1":"Electronic city Bangalore india","AddressLine2":"Electronic city Bangalore india","Country":"India","State":null,"City":null,"PinCode":"560100","MajorDestination":"INDIA","Price":{"Currency":"INR","GrossFare":60,"PublishedPrice":60,"PublishedPriceRoundedOff":60,"OfferedPrice":60,"OfferedPriceRoundedOff":60,"CommissionEarned":0,"TdsOnCommission":0,"ServiceTax":0,"SwachhBharatTax":0,"KrishiKalyanTax":0},"OldPolicyNumber":"","PolicyStatus":2,"ErrorMsg":""}],"PolicyStartDate":"2025-01-15T00:00:00","PolicyEndDate":"2025-01-15T00:00:00","CreatedOn":"2024-09-23T11:53:28","Source":"Sankash","IsDomestic":true,"Status":19,"BookingHistory":[{"CreatedBy":54728,"CreatedByName":"tbo tbo","CreatedOn":"2024-09-23T11:53:28","EventCategory":7,"LastModifiedBy":54728,"LastModifiedByName":"tbo tbo","LastModifiedOn":"2024-09-23T11:53:28","Remarks":"Booking is Ready (Booked By BookingAPI). Insurance details saved for PlanCode : 1 | Source : Sankash (through New BookingEngine Service). | IP Address :- 103.86.177.227 | MSDTC : OFF"},{"CreatedBy":54728,"CreatedByName":"tbo tbo","CreatedOn":"2024-09-23T11:53:30","EventCategory":7,"LastModifiedBy":54728,"LastModifiedByName":"tbo tbo","LastModifiedOn":"2024-09-23T11:53:30","Remarks":"Booking is Failed (Booked By BookingAPI).  Policy for Mohan Kumar pax not generated |  (through GeneratePolicy Method of New BookingEngine Service). | IP Address :- 103.86.177.227"}],"GSTIN":null,"SupplierName":"SANKASH"}}}';*/
	  
	  return $response;

	}

		public function GetBookingDetail($booking_id,$search_id,$request){


		 $curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://api.tektravels.com/BookingEngineService_Insurance/InsuranceService.svc/rest/GetBookingDetail',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => $request,
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$path 	= PROJECT_PATH."/logs/insurance/GetBookingDetail/GetBookingDetail_req".$search_id.".json"; 
		$fp 		= fopen($path,"wb");fwrite($fp,$request);fclose($fp); 
		$path 	= PROJECT_PATH."/logs/insurance/GetBookingDetail/GetBookingDetail_res".$search_id.".json"; 
		$fp 		= fopen($path,"wb");fwrite($fp,$response);fclose($fp);  
		/*$response ='{"Response":{"Error":{"ErrorCode":0,"ErrorMessage":""},"Itinerary":{"BookingId":1924685,"InsuranceId":23940,"PlanType":1,"PlanName":"Gold","PlanDescription":"Worldwide  USD 250,000   ","PlanCoverage":1,"CoverageDetails":null,"PlanCategory":1,"PaxInfo":[{"PaxId":28680,"PolicyNo":"","ClaimCode":null,"SiebelPolicyNumber":"","ReferenceId":"TBO-23092024115328730","DocumentURL":null,"MaxAge":70.00,"MinAge":1.00,"Title":"Mr","FirstName":"Mohan","LastName":"Kumar","Gender":"Male","DOB":"1977-09-07T00:00:00","BeneficiaryName":"Mr Raj Kumar","RelationShipToInsured":"Self","RelationToBeneficiary":"Brother","EmailId":"balasab.muddebihal@provabmail.com","PhoneNumber":"8698745877","PassportNo":"india78997","AddressLine1":"Electronic city Bangalore india","AddressLine2":"Electronic city Bangalore india","Country":"India","State":null,"City":null,"PinCode":"560100","MajorDestination":"INDIA","Price":{"Currency":"INR","GrossFare":60,"PublishedPrice":60,"PublishedPriceRoundedOff":60,"OfferedPrice":60,"OfferedPriceRoundedOff":60,"CommissionEarned":0,"TdsOnCommission":0,"ServiceTax":0,"SwachhBharatTax":0,"KrishiKalyanTax":0},"OldPolicyNumber":"","PolicyStatus":2,"ErrorMsg":""}],"PolicyStartDate":"2025-01-15T00:00:00","PolicyEndDate":"2025-01-15T00:00:00","CreatedOn":"2024-09-23T11:53:28","Source":"Sankash","IsDomestic":true,"CancellationCharge":10,"Status":19,"BookingHistory":[{"CreatedBy":54728,"CreatedByName":"tbo tbo","CreatedOn":"2024-09-23T11:53:28","EventCategory":7,"LastModifiedBy":54728,"LastModifiedByName":"tbo tbo","LastModifiedOn":"2024-09-23T11:53:28","Remarks":"Booking is Ready (Booked By BookingAPI). Insurance details saved for PlanCode : 1 | Source : Sankash (through New BookingEngine Service). | IP Address :- 103.86.177.227 | MSDTC : OFF"},{"CreatedBy":54728,"CreatedByName":"tbo tbo","CreatedOn":"2024-09-23T11:53:30","EventCategory":7,"LastModifiedBy":54728,"LastModifiedByName":"tbo tbo","LastModifiedOn":"2024-09-23T11:53:30","Remarks":"Booking is Failed (Booked By BookingAPI).  Policy for Mohan Kumar pax not generated |  (through GeneratePolicy Method of New BookingEngine Service). | IP Address :- 103.86.177.227"}],"GSTIN":null,"SupplierName":"SANKASH"},"ResponseStatus":1,"TraceId":"18940b24-e2ea-4e37-a9c6-de03a5f8defc"}}';*/

		return $response;

	}
} 

?>