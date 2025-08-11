<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(-1);
/**
 * provab
 *
 * Travel Portal Application
 *
 * @package		provab
 * @author		Balu A<balu.provab@gmail.com>
 * @copyright	Copyright (c) 2013 - 2014
 * @link		http://provab.com
 */

class Transfer_api  extends CI_Controller {

	/**
	 * Provab Email Class
	 *
	 * Permits email to be sent using Mail, Sendmail, or SMTP.
	 *
	 * @package		provab
	 * @subpackage	Libraries
	 * @category	Libraries
	 * @author    Balasab A<balasab.muddebihal@provabmail.com>
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
    }


	public function transfer_api_response($search_data,$search_id){
		// debug($search_id); die;

			$search_data_ = json_decode($search_data,true); 
			 /*$t='{
   "country": "GB",
   "from": "Ravna Gora,London,GB        ",
   "from_station_ids": "",
   "from_city_id": "",
   "from_HotelId": "1346517",
   "to": "London Heathrow Airport (LHR)",
   "to_station_id": "126632",
   "to_HotelId": "",
   "to_station_code": "LHR",
   "depatures": "2024-9-18",
   "hours": "19",
   "minutes": "32",
   "nationality": "IN",
   "langauge": "4",
   "adult": "1",
   "child": "0",
   "infant": "0"
}';
			$search_data_ =json_decode($t,true);*/
			// debug($search_data_);

			$get_new_token=$this->Home_Model->get_token_deta(); 
			$token_id = $get_new_token[0]['token']; 

			// $token_id = "4237431c-a86e-476e-aff5-0f5833109d11"; 
          $token_id = get_tokens(); 



			if($search_data_['from_station_ids']!=""){
				$PickUpCode=1; 
				$PickUpPointCode =$search_data_['from_station_ids'];
			}else{
				$PickUpCode=0; 
				$PickUpPointCode =$search_data_['from_HotelId'];
			}

			if($search_data_['to_station_code']!=""){
				$dropuppointCode = $search_data_['to_station_code'];
			}else{
				$dropuppointCode = $search_data_['to_HotelId'];
			}





			if($search_data_['to_HotelId']!=""){
				$DropupCode=0;
			}else{
				$DropupCode=1;
			} 


			if($search_data_['from_city_id']!=""){
				$city_id = $search_data_['from_city_id'];
			}else{
				$city_id = $search_data_['to_station_id'];
			}	 

			$num = $search_data_['hours'];
			$hours = sprintf("%02d", $num); 
			$num = $search_data_['minutes'];
			$minutes = sprintf("%02d", $num); 

			$transfer_time = $hours.$minutes;

			$datee = explode('-', $search_data_['depatures']); 
			$mnth = $datee['1'];
			$month = sprintf("%02d", $mnth);

			$dte = $datee['2'];
			$dateee = sprintf("%02d", $dte); 
			$date = $datee['0'].'-'.$month.'-'.$dateee; 


      $curl_rqst = array();

      $curl_rqst['TransferTime'] = $transfer_time;
      $curl_rqst['TransferDate'] = $date;
      $curl_rqst['AdultCount'] = $search_data_['adult'];
      $curl_rqst['PreferredLanguage'] = $search_data_['langauge'];
      $curl_rqst['AlternateLanguage'] = "5";
      $curl_rqst['PreferredCurrency'] = "INR";
      $curl_rqst['IsBaseCurrencyRequired'] = "false";
      $curl_rqst['PickUpCode'] = $PickUpCode;
      $curl_rqst['PickUpPointCode'] = $PickUpPointCode;
      $curl_rqst['CityId'] = $city_id;
      $curl_rqst['DropOffCode'] = $DropupCode;
      $curl_rqst['DropOffPointCode'] = $dropuppointCode;
      $curl_rqst['CountryCode'] = $search_data_['country'];
      $curl_rqst['EndUserIp'] = "182.156.5.54";
      $curl_rqst['TokenId'] = $token_id;
// debug($curl_rqst);
      $cur_req = json_encode($curl_rqst);

      // debug($cur_req); die;

			$curl = curl_init();

			curl_setopt_array($curl, array(
			CURLOPT_URL => 'http://api.tektravels.com/BookingEngineService_Transfer/TransferService.svc/rest/Search/',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>$cur_req,
			CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
			),
			));

			$response = curl_exec($curl);

			curl_close($curl);

			//  $d = json_decode($response,true); 
   //     		$data['response'] = json_encode($d);
   //      	$data['search_id'] = $search_id; 

			// $searcdatah_insert_data = $this->Home_Model->insert_transfer_search_logs($data);

			// debug($response); die;

			

				 $path = PROJECT_PATH."/logs/transfer/search/search_req".$search_id.".json"; 
				 $fp = fopen($path,"wb");fwrite($fp,$search_data);fclose($fp); 
				 $path = PROJECT_PATH."/logs/transfer/search/search_res".$search_id.".json"; 
				 $fp = fopen($path,"wb");fwrite($fp,$response);fclose($fp);

			return  $response;   


			// debug($search_data_); die;


	}

	public function transfer_api_book_response($rquest,$transaction_id,$search_id){
// debug('booking under development'); die;
    // debug($rquest); die;

 // debug(json_decode($rquest,true));  die;
  $curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://api.tektravels.com/BookingEngineService_Transfer/TransferService.svc/rest/Book/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$rquest,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl); 

// debug('test'); die;
/*$rquest = '{
   "IsVoucherBooking": true,
   "NumOfPax": "1",
   "PaxInfo": [
      {
         "PaxId": 0,
         "Title": "Mr.",
         "FirstName": "Gurdeep",
         "LastName": "Kang Singh ",
         "PaxType": 0,
         "Age": 35,
         "ContactNumber": "9876606498",
         "PAN": "BMKPK2046P"
      }
   ],
   "PickUp": {
      "PickUpCode": "1",
      "PickUpName": "Airport",
      "PickUpDetailCode": "DXB",
      "Description": "AI-1427",
      "PickUpDetailName": null,
      "IsPickUpAllowed": true,
      "IsPickUpTimeRequired": true,
      "Time": "1030",
      "PickUpDate": "21/11/2024",
      "AddressLine1": null,
      "city": null,
      "Country": null,
      "ZipCode": null,
      "AddressLine2": null
   },
   "DropOff": {
      "DropOffCode": "0",
      "DropOffName": "Accomodation",
      "DropOffDetailCode": "1078433",
      "DropOffDetailName": null,
      "DropOffAllowForCheckInTime": 0,
      "IsDropOffAllowed": 1
   },
   "Vehicles": [
      {
         "VehicleIndex": 1,
         "Vehicle": "Estate Car",
         "VehicleCode": "1",
         "VehicleMaximumPassengers": 4,
         "VehicleMaximumLuggage": 4,
         "Language": "NotSpecified",
         "LanguageCode": 0,
         "TransferPrice": {
            "CurrencyCode": "INR",
            "BasePrice": 8815.03,
            "Tax": 0,
            "Discount": 0,
            "PublishedPrice": 8815.03,
            "PublishedPriceRoundedOff": 8815,
            "OfferedPrice": 8815.03,
            "OfferedPriceRoundedOff": 8815,
            "AgentCommission": 0,
            "AgentMarkUp": 0,
            "ServiceTax": 0,
            "TCS": 0,
            "TDS": 0,
            "PriceType": 0,
            "SubagentCommissionInPriceDetailResponse": 0,
            "SubagentCommissionTypeInPriceDetailResponse": 0,
            "DistributorCommissionInPriceDetailResponse": 0,
            "DistributorCommissionTypeInPriceDetailResponse": 0,
            "ServiceCharge": 0,
            "TotalGSTAmount": 0,
            "GST": {
               "CGSTAmount": 0,
               "CGSTRate": 0,
               "CessAmount": 0,
               "CessRate": 0,
               "IGSTAmount": 0,
               "IGSTRate": 18,
               "SGSTAmount": 0,
               "SGSTRate": 0,
               "TaxableAmount": 0
            }
         }
      }
   ],
   "ResultIndex": "1",
   "TransferCode": "1088225",
   "VehicleIndex": [
      1
   ],
   "BookingMode": 5,
   "OccupiedPax": [
      {
         "AdultCount": "1"
      }
   ],
   "EndUserIp": "182.156.5.54",
   "TokenId": "b42e5cd8-5084-4222-a052-2c19ee4cbb1d",
   "TraceId": "6bbb69f9-9f6d-4191-bada-cad1325886a3"
}'; */

// debug($rquest); die;

/*$response ='{
   "BookResult": {
      "ResponseStatus": 1,
      "Error": {
         "ErrorCode": 0,
         "ErrorMessage": ""
      },
      "TraceId": "6bbb69f9-9f6d-4191-bada-cad1325886a3",
      "BookingStatus": 1,
      "VoucherStatus": false,
      "ConfirmationNo": "TBO-546815",
      "BookingRefNo": "TBO30092024120146975",
      "BookingId": 1926039,
      "TransferId": 0,
      "BookingRemarks": "<p><u>Airport Meeting Point</u>:&nbsp;The driver will meet you in the arrivals area of the airport, holding a sign showing the lead passenger name. If you cannot locate the driver please call the emergency contact number above.</p>\n\n<p>Our representative monitors your landing hour and waits 60 minutes since the time of actual landing. If there is a delay in passport control, receipt of baggage or any other reason beyond the maximum waiting period, contact us immediately using the emergency contact number above. In case the passengers did not show up or did not reach us through the emergency contact number, our representative is allowed to leave without the passengers. In case the flight delays more than 3 hours, you must update us through the emergency contact number. In case the passengers do not find the representative/driver they must contact us through the emergency contact number before using any alternative transportation.</p>\n<p>An SMS with the driver details will be sent to the guest mobile number that you provided in the booking about 2 hours before the service</p>",
      "IsPriceChanged": false,
      "IsCancellationPolicyChanged": false
   }
}';*/ 

// debug($response); die;
$path = PROJECT_PATH."/logs/transfer/booking/booking_req".$search_id.".json"; 
$fp = fopen($path,"wb");fwrite($fp,$rquest);fclose($fp); 
$path = PROJECT_PATH."/logs/transfer/booking/booking_res".$search_id.".json"; 
$fp = fopen($path,"wb");fwrite($fp,$response);fclose($fp);

 
return $response;   

	}


public function get_booking_response($rquest,$transaction_id,$search_id){

  $curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://api.tektravels.com/BookingEngineService_Transfer/TransferService.svc/rest/GetBookingDetail/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$rquest,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$path = PROJECT_PATH."/logs/transfer/get_booking/get_booking_req".$search_id.".json"; 
$fp = fopen($path,"wb");fwrite($fp,$rquest);fclose($fp); 
$path = PROJECT_PATH."/logs/transfer/get_booking/get_booking_res".$search_id.".json"; 
$fp = fopen($path,"wb");fwrite($fp,$response);fclose($fp);


return $response;  

  }
 
}




?>