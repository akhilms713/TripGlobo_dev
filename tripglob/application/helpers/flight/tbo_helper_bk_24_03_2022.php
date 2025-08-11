<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/*



|--------------------------------------------------------------------------|



| Author: Provab Technosoft Pvt Ltd.									   |



|--------------------------------------------------------------------------|



| Developer: RAHUL PANDEY									               |



| Started Date: 2020-06-03T15:15:00										   |



| Ended Date:   2020-06-XXTXX:XX:XX					   					   |



|--------------------------------------------------------------------------|



*/







function get_token(){



	$api_details 	= get_api_credentials();

	$hit_url=$api_details['url'].'SharedAPI/SharedData.svc/rest/authenticate';

	$auth_detail=array(

		"UserName"=>$api_details['Username'],

		"Password"=>$api_details['pwd'],

		"ClientId"=>$api_details['client_id'],

		"EndUserIp"=>'103.78.245.113'

	);



	$auth_detail1=json_encode($auth_detail);

	$data=tbo_curl($hit_url,$auth_detail1);



	return $data;



}



function SearchReq_Res($search_request,$token_data){//exit("raj");

	

	error_reporting(0);



	$api_details 	= get_api_credentials();



	// $hit_url        =$api_details['url'].'BookingEngineService_Air/AirService.svc/rest/Search';

	$hit_url        ='https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/Search';



	// echo "<pre/>";print_r($search_request);die;



	$type          ='';



	$search_segment='';



	$class='';



	if( ($search_request->type=="oneway") ||($search_request->type=="O") ){



		$type='1';



		$dep=date('Y-m-d',strtotime($search_request->depart_date));



		if($search_request->class=="Economy"){



			$class='1';



		}



		    $Segments[0]["Origin"]  			 = $search_request->origin;



			$Segments[0]["Destination"]           = $search_request->destination;



			$Segments[0]["FlightCabinClass"]      = $class;



			$Segments[0]["PreferredDepartureTime"]= $dep."T00: 00: 00";			



		



	}elseif( ($search_request->type=="round") || ($search_request->type=="R")){



		$type='2';



		$dep=date('Y-m-d',strtotime($search_request->depart_date));



		$ret=date('Y-m-d',strtotime($search_request->return_date));



		if($search_request->class=="Economy"){



			$class='1';



		}



		    $Segments[0]["Origin"]  			  = $search_request->origin;



			$Segments[0]["Destination"]           = $search_request->destination;



			$Segments[0]["FlightCabinClass"]      = $class;



			$Segments[0]["PreferredDepartureTime"]= $dep."T00: 00: 00";	



			$Segments[1]["Origin"]  			  = $search_request->destination;



			$Segments[1]["Destination"]           = $search_request->origin;



			$Segments[1]["FlightCabinClass"]      = $class;



			$Segments[1]["PreferredDepartureTime"]= $ret."T00: 00: 00";			







	}elseif( ($search_request->type=="multi") || ($search_request->type=="M")){



		$type='3';







		for($i=0;$i<count($search_request->origin_m);$i++){



			$dep=date('Y-m-d',strtotime($search_request->depart_date_m[$i]));



		if($search_request->class=="Economy"){



			$class='1';



			$Segments[$i]["Origin"]  			  = $search_request->origin_m[$i];



			$Segments[$i]["Destination"]           = $search_request->destination_m[$i];



			$Segments[$i]["FlightCabinClass"]      = $class;



			$Segments[$i]["PreferredDepartureTime"]= $dep."T00: 00: 00";	







		}



	}



		















	}



	$search_request1 =array(



			    "EndUserIp"        => '103.78.245.113',



				"TokenId"		   => $token_data->TokenId,



				"AdultCount"       => $search_request->ADT,



				"ChildCount"       => $search_request->CHD,



				"InfantCount"      => $search_request->INF,



				"DirectFlight"     => "false",



				"OneStopFlight"    => "false",



				"JourneyType"      => $type,



				"PreferredAirlines"=> null,



				"Segments"         =>$Segments,



				"Sources"=> null



	);







	$search_req=json_encode($search_request1);



	$flight_data=tbo_curl($hit_url,$search_req);



	// echo "<pre/>";print_r($search_req);exit;



	$flight_data1=json_decode($flight_data,1);







	// debu

	$formate_result=result_formate($flight_data1,$token_data->TokenId);

	// echo "<pre/>";print_r($formate_result);exit;

	return $formate_result;



}







function get_api_credentials(){



	$CI =& get_instance();



	$CI->load->model('flight_model');



	$credentials = $CI->Flight_Model->get_api_credentials('TBO'); 



	if(isset($credentials->api_username)){



		$data['api_id']       		= $credentials->api_details_id;



		$data['Username']       	= $credentials->api_username;



		$data['pwd']            	= trim($credentials->api_password);



		$data['client_id']          = trim($credentials->api_username1);



		$data['url']				= $credentials->api_url;



		$data['ip_address']         ='192.168.0.1';

		//echo "<pre/>";print_r($data);exit();



		return $data;



	}else{



		return '';



	}		



}



function fare_rule_t($TokenId,$TraceId,$ResultIndex){



	$api_details 	= get_api_credentials();



	$hit_url=$api_details['url'].'BookingEngineService_Air/AirService.svc/rest/FareRule';



	$fare_rule_detail=array(



		"TokenId"=>$TokenId,



		"TraceId"=>$TraceId,



		"ResultIndex"=>$ResultIndex,



		"EndUserIp"=>'103.78.245.113'



	);



	$fare_rule1=json_encode($fare_rule_detail);



	$data=tbo_curl($hit_url,$fare_rule1);



//echo "<pre/>";print_r($data);exit("131");







	return $data;







}



function book($result,$passenger,$billingaddress){



	$api_details 	= get_api_credentials();



	$hit_url=$api_details['url'].'BookingEngineService_Air/AirService.svc/rest/Book';











	$segment_data1=json_decode($result->segment_data);



	$TokenId=$segment_data1->TokenId;



	$TraceId=$segment_data1->TraceId;



	$ResultIndex=$segment_data1->ResultIndex;



	$price=json_decode($result->PricingDetails);



	$b_country=explode('-',$billingaddress->billing_contact_number);







	//$b_country=$b_country[0];



	$b_country1='+91';



	$b_contact=$b_country[1];











	//echo "<pre/>";print_r($passenger);exit("adasda");







	$p_c=0;















	$fare=array(



		"Currency"   			 =>$price->Currency,



		"BaseFare"	 			 =>$price->BaseFare,



		"Tax"	     			 =>$price->Tax,



		"YQTax"	     			 =>0,



		"AdditionalTxnFeePub"	 =>0,



		"AdditionalTxnFeeOfrd"	 =>0,



		"OtherCharges"	      	 =>$price->OtherCharges,



		"Discount"	     		 =>0,



		"PublishedFare"	      	 =>$price->PublishedFare,



		"OfferedFare"	      	 =>$price->OfferedFare,



		"TdsOnCommission"	     =>$price->TdsOnCommission,



		"TdsOnPLB"	      		 =>0,



		"TdsOnIncentive"	     =>0,



		"ServiceFee"	      	 =>0,



		);



	



	if(isset($passenger['ADULT'])){



		for($i=0;$i<count($passenger['ADULT']);$i++){







			if($passenger['ADULT'][$i]->gender=="MALE"){



				$Title='Mr';



				$gend='1';



			}else{



				$Title='Miss';



				$gend='2';



			}



			$lead='false';



			if($i==0){



				$lead='true';



			}



			$passenger1[$p_c]=array(



						"Title" 			=>$Title,



						"FirstName"			=>$passenger['ADULT'][$i]->first_name,



						"LastName"			=>$passenger['ADULT'][$i]->last_name,



						"PaxType"			=>'1',



						"DateOfBirth"    	=>$passenger['ADULT'][$i]->dob.'T00:00:00',



						"Gender"			=>$gend,



						"PassportNo"		=>$passenger['ADULT'][$i]->passport_no,



						"PassportExpiry"	=>$passenger['ADULT'][$i]->pass_expiry.'T00:00:00',



						"AddressLine1" 		=>"test",



						"AddressLine2" 		=>"test",



						"Fare"				=>$fare,



						"City" 				=>"Gurgaon",



						"CountryCode"		=> "IN",



						"CellCountryCode" 	=> $b_country1,



						"ContactNo"			=> $b_contact,



						"Nationality"		=> $passenger['ADULT'][$i]->issue_country,



					    "Email"				=> $billingaddress->billing_email,



						"IsLeadPax"			=> $lead,



						"FFAirlineCode"		=> null,



						"FFNumber"			=> "",



						"GSTCompanyAddress"	=> "",



						"GSTCompanyContactNumber"=> "",



						"GSTCompanyName"	=> "",



						"GSTNumber"			=> "",



						"GSTCompanyEmail"	=> ""







			);







			$p_c=$p_c+1;







		}







	}







	if(isset($passenger['CHILD'])){



		for($i=0;$i<count($passenger['CHILD']);$i++){







			if($passenger['CHILD'][$i]->gender=="MALE"){



				$Title='Mr';



				$gend='1';



			}else{



				$Title='Miss';



				$gend='2';



			}



			$lead='false';



			



			$passenger1[$p_c]=array(



						"Title" 			=>$Title,



						"FirstName"			=>$passenger['CHILD'][$i]->first_name,



						"LastName"			=>$passenger['CHILD'][$i]->last_name,



						"PaxType"			=>'2',



						"DateOfBirth"    	=>$passenger['CHILD'][$i]->dob.'T00:00:00',



						"Gender"			=>$gend,



						"PassportNo"		=>$passenger['CHILD'][$i]->passport_no,



						"PassportExpiry"	=>$passenger['CHILD'][$i]->pass_expiry.'T00:00:00',



						"AddressLine1" 		=>"test",



						"AddressLine2" 		=>"test",



						"Fare"				=>$fare,



						"City" 				=>"Gurgaon",



						"CountryCode"		=> "IN",



						"CellCountryCode" 	=> $b_country1,



						"ContactNo"			=> $b_contact,



						"Nationality"		=> $passenger['CHILD'][$i]->issue_country,



					    "Email"				=> $billingaddress->billing_email,



						"IsLeadPax"			=> $lead,



						"FFAirlineCode"		=> null,



						"FFNumber"			=> "",



						"GSTCompanyAddress"	=> "",



						"GSTCompanyContactNumber"=> "",



						"GSTCompanyName"	=> "",



						"GSTNumber"			=> "",



						"GSTCompanyEmail"	=> ""







			);



			$p_c=$p_c+1;



		}



	}







	if(isset($passenger['INFANT'])){



		for($i=0;$i<count($passenger['INFANT']);$i++){







			if($passenger['INFANT'][$i]->gender=="MALE"){



				$Title='Mr';



				$gend='1';



			}else{



				$Title='Miss';



				$gend='2';



			}



			$lead='false';



			



			$passenger1[$p_c]=array(



						"Title" 			=>$Title,



						"FirstName"			=>$passenger['INFANT'][$i]->first_name,



						"LastName"			=>$passenger['INFANT'][$i]->last_name,



						"PaxType"			=>'3',



						"DateOfBirth"    	=>$passenger['INFANT'][$i]->dob.'T00:00:00',



						"Gender"			=>$gend,



						"PassportNo"		=>$passenger['INFANT'][$i]->passport_no,



						"PassportExpiry"	=>$passenger['INFANT'][$i]->pass_expiry.'T00:00:00',



						"AddressLine1" 		=>"test",



						"AddressLine2" 		=>"test",



						"Fare"				=>$fare,



						"City" 				=>"Gurgaon",



						"CountryCode"		=> "IN",



						"CellCountryCode" 	=> $b_country1,



						"ContactNo"			=> $b_contact,



						"Nationality"		=> $passenger['INFANT'][$i]->issue_country,



					    "Email"				=> $billingaddress->billing_email,



						"IsLeadPax"			=> $lead,



						"FFAirlineCode"		=> null,



						"FFNumber"			=> "",



						"GSTCompanyAddress"	=> "",



						"GSTCompanyContactNumber"=> "",



						"GSTCompanyName"	=> "",



						"GSTNumber"			=> "",



						"GSTCompanyEmail"	=> ""







			);



			$p_c=$p_c+1;



		}



	}







	$book=array(



		"ResultIndex"    =>$ResultIndex,



		"Passengers"	 =>$passenger1,



		"TokenId"		 =>$TokenId,



		"TraceId"		 =>$TraceId,



		"EndUserIp"      =>'103.78.245.113'



		);



	//echo "<pre/>";print_r($book);exit();







	$book_final=json_encode($book);



	$book_data=tbo_curl($hit_url,$book_final);



	return $book_data;







}











function ticket($result,$passenger,$billingaddress,$path){

	// error_reporting(E_ALL);



	$api_details 	= get_api_credentials();



// 	$hit_url=$api_details['url'].'BookingEngineService_Air/AirService.svc/rest/Ticket';

	$hit_url='https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/Ticket';



	$segment_data1=json_decode($result->segment_data);



	$TokenId=$segment_data1->TokenId;



	$TraceId=$segment_data1->TraceId;



	$ResultIndex=$segment_data1->ResultIndex;



	$price=json_decode($result->PricingDetails);



	$b_country=explode('-',$billingaddress->billing_contact_number);



	// debug($TokenId);die;





	//$b_country=$b_country[0];



	$b_country1='+91';



	$b_contact=$b_country[1];











	//echo "<pre/>";print_r($passenger);exit("adasda");







	$p_c=0;



	 



	$fare=array(



		"Currency"	 			 =>$price->Currency,

		"BaseFare"	 			 =>$price->BaseFare,



		"Tax"	     			 =>$price->Tax,



		"YQTax"	     			 =>0,



		"AdditionalTxnFeePub"	 =>0,



		"AdditionalTxnFeeOfrd"	 =>0,



// 		"PGCharge"				 =>0,

		"OtherCharges"			 =>0,

		"Discount"               => 0.0,

		"PublishedFare"          => $price->BaseFare,

		"OfferedFare"            => 0.0,

		"TdsOnCommission"        => 0.0,

		"TdsOnPLB"               => 0.0,

		"TdsOnIncentive"         => 0.0,

		"ServiceFee"             => 0.0

		

		



		);



	



	if(isset($passenger['ADULT'])){



		for($i=0;$i<count($passenger['ADULT']);$i++){







			if($passenger['ADULT'][$i]->gender=="MALE"){



				$Title='Mr';



				$gend='1';



			}else{



				$Title='Miss';



				$gend='2';



			}



			$lead='false';



			if($i==0){



				$lead='true';



			}



			$passenger1[$p_c]=array(



						"Title" 			=>$Title,



						"FirstName"			=>$passenger['ADULT'][$i]->first_name,



						"LastName"			=>$passenger['ADULT'][$i]->last_name,



						"PaxType"			=>'1',



						"DateOfBirth"    	=>$passenger['ADULT'][$i]->dob.'T00:00:00',



						"Gender"			=>$gend,



						"PassportNo"		=>$passenger['ADULT'][$i]->passport_no,



						"PassportExpiry"	=>$passenger['ADULT'][$i]->pass_expiry.'T00:00:00',



						"AddressLine1" 		=>"test",



						"AddressLine2" 		=>"test",



						"Fare"				=>$fare,



						"City" 				=>"Gurgaon",



						"CountryCode"		=> "IN",



						"CellCountryCode" 	=> $b_country1,



						"ContactNo"			=> $b_contact,



						"Nationality"		=> $passenger['ADULT'][$i]->issue_country,



					    "Email"				=> $billingaddress->billing_email,



						"IsLeadPax"			=> $lead,



						"FFAirlineCode"		=> null,



						"FFNumber"			=> "",



						"GSTCompanyAddress"	=> "",



						"GSTCompanyContactNumber"=> "",



						"GSTCompanyName"	=> "",



						"GSTNumber"			=> "",



						"GSTCompanyEmail"	=> ""







			);







			$p_c=$p_c+1;







		}







	}







	if(isset($passenger['CHILD'])){



		for($i=0;$i<count($passenger['CHILD']);$i++){







			if($passenger['CHILD'][$i]->gender=="MALE"){



				$Title='Mr';



				$gend='1';



			}else{



				$Title='Miss';



				$gend='2';



			}



			$lead='false';



			



			$passenger1[$p_c]=array(



						"Title" 			=>$Title,



						"FirstName"			=>$passenger['CHILD'][$i]->first_name,



						"LastName"			=>$passenger['CHILD'][$i]->last_name,



						"PaxType"			=>'2',



						"DateOfBirth"    	=>$passenger['CHILD'][$i]->dob.'T00:00:00',



						"Gender"			=>$gend,



						"PassportNo"		=>$passenger['CHILD'][$i]->passport_no,



						"PassportExpiry"	=>$passenger['CHILD'][$i]->pass_expiry.'T00:00:00',



						"AddressLine1" 		=>"test",



						"AddressLine2" 		=>"test",



						"Fare"				=>$fare,



						"City" 				=>"Gurgaon",



						"CountryCode"		=> "IN",



						"CellCountryCode" 	=> $b_country1,



						"ContactNo"			=> $b_contact,



						"Nationality"		=> $passenger['CHILD'][$i]->issue_country,



					    "Email"				=> $billingaddress->billing_email,



						"IsLeadPax"			=> $lead,



						"FFAirlineCode"		=> null,



						"FFNumber"			=> "",



						"GSTCompanyAddress"	=> "",



						"GSTCompanyContactNumber"=> "",



						"GSTCompanyName"	=> "",



						"GSTNumber"			=> "",



						"GSTCompanyEmail"	=> ""







			);



			$p_c=$p_c+1;



		}



	}







	if(isset($passenger['INFANT'])){



		for($i=0;$i<count($passenger['INFANT']);$i++){







			if($passenger['INFANT'][$i]->gender=="MALE"){



				$Title='Mr';



				$gend='1';



			}else{



				$Title='Miss';



				$gend='2';



			}



			$lead='false';



			



			$passenger1[$p_c]=array(



						"Title" 			=>$Title,



						"FirstName"			=>$passenger['INFANT'][$i]->first_name,



						"LastName"			=>$passenger['INFANT'][$i]->last_name,



						"PaxType"			=>'3',



						"DateOfBirth"    	=>$passenger['INFANT'][$i]->dob.'T00:00:00',



						"Gender"			=>$gend,



						"PassportNo"		=>$passenger['INFANT'][$i]->passport_no,



						"PassportExpiry"	=>$passenger['INFANT'][$i]->pass_expiry.'T00:00:00',



						"AddressLine1" 		=>"test",



						"AddressLine2" 		=>"test",



						"Fare"				=>$fare,



						"City" 				=>"Gurgaon",



						"CountryCode"		=> "IN",



						"CellCountryCode" 	=> $b_country1,



						"ContactNo"			=> $b_contact,



						"Nationality"		=> $passenger['INFANT'][$i]->issue_country,



					    "Email"				=> $billingaddress->billing_email,



						"IsLeadPax"			=> $lead,



						"FFAirlineCode"		=> null,



						"FFNumber"			=> "",



						"GSTCompanyAddress"	=> "",



						"GSTCompanyContactNumber"=> "",



						"GSTCompanyName"	=> "",



						"GSTNumber"			=> "",



						"GSTCompanyEmail"	=> ""







			);



			$p_c=$p_c+1;



		}



	}







	$book=array(



// 		"PreferredCurrency" 		=> $price->Currency,



//   		"IsBaseCurrencyRequired"	=> "true",



		"ResultIndex"               =>$ResultIndex,



		"Passengers"	 			=>$passenger1,



		"TokenId"		 			=>$TokenId,



		"TraceId"		 			=>$TraceId,



		"EndUserIp"      			=>'103.78.245.113'



		);



	// echo "<pre/>";print_r($book);exit();






	$book_final=json_encode($book);
	$fare_quote = Fare_quote($book_final);
	// debug($fare_quote);die;

	$path = $path.'/Ticket.txt';

  	$fp = fopen($path,"wb");fwrite($fp,$book_final);fclose($fp);

	$book_data=tbo_curl($hit_url,$book_final);

	

// debug($book_data);die;



	return $book_data;







}







function Fare_quote($segment_data){

error_reporting(E_ALL);

	$api_details 	= get_api_credentials();

	// debug($segment_data);die;

// 	$hit_url=$api_details['url'].'BookingEngineService_Air/AirService.svc/rest/FareQuote';

	$hit_url='https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/FareQuote';
	$segment_data1=json_decode($segment_data);



	// echo "<pre/>";print_r($segment_data1);exit();



	$TokenId=$segment_data1->TokenId;



	$TraceId=$segment_data1->TraceId;



	$ResultIndex=$segment_data1->ResultIndex;



	$fare_quote_detail=array(



		"TokenId"=>$TokenId,



		"TraceId"=>$TraceId,



		"ResultIndex"=>$ResultIndex,



		"EndUserIp"=>'103.78.245.113'



	);



	$fare_rule1=json_encode($fare_quote_detail);



	$data=tbo_curl($hit_url,$fare_rule1);

	// debug($data);die;



	return true;



}







function session_logout($result){



	$api_details 	= get_api_credentials();



	$hit_url=$api_details['url'].'SharedServices/SharedData.svc/rest/Logout';







	$segment_data1=json_decode($result->segment_data);



	$TokenId=$segment_data1->TokenId;







	$session_logout=array(



		"TokenId"=>$TokenId,



		"ClientId"=>"tboprod",



		"TokenAgencyId"=>"54818",



		"TokenMemberId"=>"54728",



		"EndUserIp"=>'103.78.245.113'



	);



	$session_logout=json_encode($session_logout);



	$data=tbo_curl1($hit_url,$session_logout);



	return true;







}































function tbo_curl($hit_url,$request){



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



	$final_de = date('Ymd_His')."_".rand(1,10000);

	$XmlReqFileName = $file[6].'_Req'.$final_de;

	$XmlResFileName = $file[6].'_Res'.$final_de;

	$fp = fopen("logs/Flight/TBO/".$XmlReqFileName.'.txt', 'a+');

	fwrite($fp, $request);

	fclose($fp);

	$fp = fopen("logs/Flight/TBO/".$XmlResFileName.'.txt', 'a+');

	fwrite($fp, $response);

	fclose($fp);

	return $response;



}







function tbo_curl1($hit_url,$request){



		







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







	$final_de = date('Ymd_His')."_".rand(1,10000);







	$XmlReqFileName = 'session_logout_Req'.$final_de;



	$XmlResFileName = 'session_logout_Res'.$final_de;



	



	$fp = fopen("logs/Flight/TBO/".$XmlReqFileName.'.txt', 'a+');



	fwrite($fp, $request);



	fclose($fp);



	$fp = fopen("logs/Flight/TBO/".$XmlResFileName.'.txt', 'a+');



	fwrite($fp, $response);



	fclose($fp);



	return $response;



}







function result_formate($row_data,$track_id){



	$result=array();







	$outer_count=count($row_data['Response']['Results'][0]);//no of inventry







		for($i=0;$i<$outer_count;$i++){







			$inner_data=$row_data['Response']['Results'][0][$i];



			$segm['TokenId']       =$track_id;



			$segm['TraceId']       =$row_data['Response']['TraceId'];



			$segm['ResultIndex']   =$inner_data['ResultIndex'];



			$segm['Segments']      =$inner_data['Segments'];



			$result[$i]['TokenId']=$track_id;



			$result[$i]['TraceId']=$row_data['Response']['TraceId'];



			$result[$i]['ResultIndex']=$inner_data['ResultIndex'];



			$result[$i]['IsRefundable']=$inner_data['IsRefundable'];



			$result[$i]['Fare']=format_fare($inner_data['Fare']);



			$result[$i]['FareBreakdown']=json_encode($inner_data['FareBreakdown']);



			$result[$i]['Segments']=json_encode($segm);



			$result[$i]['LastTicketDate']=$inner_data['LastTicketDate'];



			$result[$i]['AirlineCode']=$inner_data['AirlineCode'];



			$result[$i]['ValidatingAirline']=$inner_data['ValidatingAirline'];



		}



		return $result;



}



function format_fare($value){



	$fare['Currency']       	    =$value['Currency'];



	$fare['BaseFare']               =$value['BaseFare'];



	$fare['Tax']             		=$value['Tax'];



	$fare['OtherCharges']    		=$value['OtherCharges'];



	$fare['PublishedFare']    		=$value['PublishedFare'];



	$fare['CommissionEarned']    	=$value['CommissionEarned'];



	$fare['OfferedFare']    		=$value['OfferedFare'];



	$fare['TdsOnCommission']    	=$value['TdsOnCommission'];



	return json_encode($fare);



}