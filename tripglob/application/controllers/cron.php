<?php
ob_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) { session_start(); }
// error_reporting(0);
class Cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Currency_Model');
       
    }
    function auto_update_currency_cron(){ 
        $currency = $this->Currency_Model->get_currency_list_update();         
            // debug(implode(',', array_column($currency, 'currency_code')) );exit();
        if (is_array($currency)) {            
            $value=$this->auto_curl(implode(',', array_column($currency, 'currency_code')));
            // debug(count($value['results']));exit;
            if (isset($value['error']) && !empty($value['error'])) {
            $data=array('updated_at'=>1,
                          'updated_at_date'=>date('Y-m-d H:i:s'),
                 );
            $this->db->where('currency_code',$currency['currency_code']);
            $this->db->update('currency_list',$data);
                
            }else{
                foreach ($value['results'] as $key => $value) {         
                $data=array('value' => $value,
                              'updated_at'=>2,
                              'updated_at_date'=>date('Y-m-d H:i:s'),
                     );
                $this->db->where('currency_code',$key);
                $this->db->update('currency_list',$data);
                }
            }
          redirect('cron/auto_update_currency_cron','refresh');
        }else{
        $currency_u = $this->Currency_Model->get_currency_list_update_auto(); 
            // debug($currency_u);exit;
          exit("done");
        }
        
        
    }
    function auto_curl($to){
        // debug($to);exit();
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.fastforex.io/fetch-multi?api_key=26e3a6a0d2-1e59916e8e-s74cqf&from=INR&to='.$to,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response,1);                 
    }

   // public function hoteldetails_data(){

   //              $query=$this->db->query('SELECT * FROM `tbo_hotel_codes` WHERE `status`= 0 LIMIT 1000');
   //              $result=$query->result_array();
   //              $status['status']=1;
   //              $this->db->where_in('origin',array_column($result, 'origin'));
   //              $this->db->update('tbo_hotel_codes',$status);
       
   //          $curl = curl_init();

   //          curl_setopt_array($curl, array(
   //          CURLOPT_URL => 'https://apiwr.tboholidays.com/HotelAPI/Hoteldetails',
   //          CURLOPT_RETURNTRANSFER => true,
   //          CURLOPT_ENCODING => '',
   //          CURLOPT_MAXREDIRS => 10,
   //          CURLOPT_TIMEOUT => 0,
   //          CURLOPT_FOLLOWLOCATION => true,
   //          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   //          CURLOPT_CUSTOMREQUEST => 'POST',
   //          CURLOPT_POSTFIELDS =>'{
   //          "Hotelcodes" : "'.implode(',',array_column($result, 'HotelCodes')).'",
   //          "Language" : "FR"
   //          }',
   //          CURLOPT_HTTPHEADER => array(
   //          'Content-Type: application/json',
   //          'Authorization: Basic '
   //          ),
   //          ));

   //          $response = curl_exec($curl);
   //          curl_close($curl);
   //          // debug($response);exit;
   //      if (isset(json_decode($response,1)['Status']) && isset(json_decode($response,1)['HotelDetails'])) {
   //          foreach (json_decode($response,1)['HotelDetails'] as $key => $value) {
   //          // debug($value);exit;
   //          $response=$value;
   //          // debug($response);exit;
   //          $CountryName='';
   //          $Attractions='';
   //          $image='';
   //          $images='';
   //          $latitude='';
   //          $longitude='';
   //          $CityName='';
   //          $CountryCode='';
   //          $CityId='';
   //          $Address='';
   //          $PhoneNumber='';
   //          $HotelName='';
   //          $FaxNumber='';
   //          $HotelRating='';
   //          $Description='';
   //          $HotelFacilities='';
   //          if (isset($response['Attractions'])) {          
   //              $Attractions=json_encode($response['Attractions']);
   //          }
   //          if (isset($response['Images']) && $response['Images']!='' && is_array($response['Images'])) {
   //              $image=current($response['Images']);
   //              $images=json_encode($response['Images']);
   //          }
   //          if (isset($response['Map']) && $response['Map']!='' && count(explode('|',$response['Map']))==2) {
   //              $latitude=current(explode('|', $response['Map']));
   //              $longitude=end(explode('|', $response['Map']));
   //          }
   //          if (isset($response['CountryName']) && $response['CountryName']!= '') {
   //              $CountryName=$response['CountryName'];              
   //          }
   //          if (isset($response['CityName']) && $response['CityName']!= '') {
   //              $CityName=$response['CityName'];                
   //          }
   //          if (isset($response['CountryCode']) && $response['CountryCode']!= '') {
   //              $CountryCode=$response['CountryCode'];              
   //          }
   //          if (isset($response['CityId']) && $response['CityId']!= '') {
   //              $CityId=$response['CityId'];                
   //          }
   //          if (isset($response['Address']) && $response['Address']!= '') {
   //              $Address=$response['Address'];              
   //          }           
   //          if (isset($response['PhoneNumber']) && $response['PhoneNumber']!= '') {
   //              $PhoneNumber=$response['PhoneNumber'];              
   //          }
   //          if (isset($response['HotelName']) && $response['HotelName']!= '') {
   //              $HotelName=$response['HotelName'];              
   //          }
   //          if (isset($response['FaxNumber']) && $response['FaxNumber']!= '') {
   //              $FaxNumber=$response['FaxNumber'];              
   //          }
   //          if (isset($response['HotelRating']) && $response['HotelRating']!= '') {
   //              $HotelRating=$response['HotelRating'];              
   //          }
   //          if (isset($response['Description']) && $response['Description']!= '') {
   //              $Description=$response['Description'];              
   //          }
   //          if (isset($response['HotelFacilities']) && $response['HotelFacilities']!= '' && is_array($response['HotelFacilities'])) {
   //              $HotelFacilities=json_encode($response['HotelFacilities']);             
   //          }
   //          $data[]=array('booking_source'=>'PTBSID0000001295',             
   //                      'unique_code'=>$response['HotelCode'],
   //                      'hotel_code'=>$response['HotelCode'],
   //                      'country_name'=>$CountryName,
   //                      'city_name'=>$CityName,
   //                      'country_code'=>$CountryCode,
   //                      'city_code'=>$CityId,
   //                      'state'=>'',
   //                      'hotel_name'=>$HotelName,
   //                      'address'=>$Address,
   //                      'phone_number'=>$PhoneNumber,
   //                      'fax'=>$FaxNumber,
   //                      'email'=>'',
   //                      'website'=>'',
   //                      'star_rating'=>$HotelRating,
   //                      'latitude'=>$latitude,
   //                      'longitude'=>$longitude,
   //                      'hotel_desc'=>$Description,
   //                      'room_faci'=>$HotelFacilities,
   //                      'hotel_faci'=>$HotelFacilities,
   //                      'attractions'=>$Attractions,
   //                      'image'=>$image,
   //                      'thumb_image'=>$image,
   //                      'images'=>$images,
   //                      'status'=>0
   //                     );
   //                  if (count($data) == 500 && $data!='') {
   //                  $this->db->insert_batch('tbo_master_hotel_details_new',$data);
   //                  $data=array();
   //                  }       
   //          }           
   //          if (count($data) >= 1 && $data!='') {               
   //           $this->db->insert_batch('tbo_master_hotel_details_new',$data);                
   //          }            
   //      }else{
   //           $query=$this->db->query('SELECT * FROM `tbo_hotel_codes` WHERE `status`= 0 LIMIT 1000');
   //              $result=$query->result_array();
   //              $status['status']=1;
   //              $this->db->where_in('origin',array_column($result, 'origin'));
   //              $this->db->update('tbo_hotel_codes',$status);
       
   //          $curl = curl_init();

   //          curl_setopt_array($curl, array(
   //          CURLOPT_URL => 'https://apiwr.tboholidays.com/HotelAPI/Hoteldetails',
   //          CURLOPT_RETURNTRANSFER => true,
   //          CURLOPT_ENCODING => '',
   //          CURLOPT_MAXREDIRS => 10,
   //          CURLOPT_TIMEOUT => 0,
   //          CURLOPT_FOLLOWLOCATION => true,
   //          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   //          CURLOPT_CUSTOMREQUEST => 'POST',
   //          CURLOPT_POSTFIELDS =>'{
   //          "Hotelcodes" : "'.implode(',',array_column($result, 'HotelCodes')).'",
   //          "Language" : "FR"
   //          }',
   //          CURLOPT_HTTPHEADER => array(
   //          'Content-Type: application/json',
   //          'Authorization: Basic TmFzQmFiOk5hc0AzMzc3NTExNA=='
   //          ),
   //          ));

   //          $response = curl_exec($curl);
   //          curl_close($curl);
   //          // debug($response);exit;
   //          if (isset(json_decode($response,1)['Status']) && isset(json_decode($response,1)['HotelDetails'])) {
   //      foreach (json_decode($response,1)['HotelDetails'] as $key => $value) {
   //          // debug($value);exit;
   //          $response=$value;
   //          // debug($response);exit;
   //          $CountryName='';
   //          $Attractions='';
   //          $image='';
   //          $images='';
   //          $latitude='';
   //          $longitude='';
   //          $CityName='';
   //          $CountryCode='';
   //          $CityId='';
   //          $Address='';
   //          $PhoneNumber='';
   //          $HotelName='';
   //          $FaxNumber='';
   //          $HotelRating='';
   //          $Description='';
   //          $HotelFacilities='';
   //          if (isset($response['Attractions'])) {          
   //              $Attractions=json_encode($response['Attractions']);
   //          }
   //          if (isset($response['Images']) && $response['Images']!='' && is_array($response['Images'])) {
   //              $image=current($response['Images']);
   //              $images=json_encode($response['Images']);
   //          }
   //          if (isset($response['Map']) && $response['Map']!='' && count(explode('|',$response['Map']))==2) {
   //              $latitude=current(explode('|', $response['Map']));
   //              $longitude=end(explode('|', $response['Map']));
   //          }
   //          if (isset($response['CountryName']) && $response['CountryName']!= '') {
   //              $CountryName=$response['CountryName'];              
   //          }
   //          if (isset($response['CityName']) && $response['CityName']!= '') {
   //              $CityName=$response['CityName'];                
   //          }
   //          if (isset($response['CountryCode']) && $response['CountryCode']!= '') {
   //              $CountryCode=$response['CountryCode'];              
   //          }
   //          if (isset($response['CityId']) && $response['CityId']!= '') {
   //              $CityId=$response['CityId'];                
   //          }
   //          if (isset($response['Address']) && $response['Address']!= '') {
   //              $Address=$response['Address'];              
   //          }           
   //          if (isset($response['PhoneNumber']) && $response['PhoneNumber']!= '') {
   //              $PhoneNumber=$response['PhoneNumber'];              
   //          }
   //          if (isset($response['HotelName']) && $response['HotelName']!= '') {
   //              $HotelName=$response['HotelName'];              
   //          }
   //          if (isset($response['FaxNumber']) && $response['FaxNumber']!= '') {
   //              $FaxNumber=$response['FaxNumber'];              
   //          }
   //          if (isset($response['HotelRating']) && $response['HotelRating']!= '') {
   //              $HotelRating=$response['HotelRating'];              
   //          }
   //          if (isset($response['Description']) && $response['Description']!= '') {
   //              $Description=$response['Description'];              
   //          }
   //          if (isset($response['HotelFacilities']) && $response['HotelFacilities']!= '' && is_array($response['HotelFacilities'])) {
   //              $HotelFacilities=json_encode($response['HotelFacilities']);             
   //          }
   //          $data[]=array('booking_source'=>'PTBSID0000001295',             
   //                      'unique_code'=>$response['HotelCode'],
   //                      'hotel_code'=>$response['HotelCode'],
   //                      'country_name'=>$CountryName,
   //                      'city_name'=>$CityName,
   //                      'country_code'=>$CountryCode,
   //                      'city_code'=>$CityId,
   //                      'state'=>'',
   //                      'hotel_name'=>$HotelName,
   //                      'address'=>$Address,
   //                      'phone_number'=>$PhoneNumber,
   //                      'fax'=>$FaxNumber,
   //                      'email'=>'',
   //                      'website'=>'',
   //                      'star_rating'=>$HotelRating,
   //                      'latitude'=>$latitude,
   //                      'longitude'=>$longitude,
   //                      'hotel_desc'=>$Description,
   //                      'room_faci'=>$HotelFacilities,
   //                      'hotel_faci'=>$HotelFacilities,
   //                      'attractions'=>$Attractions,
   //                      'image'=>$image,
   //                      'thumb_image'=>$image,
   //                      'images'=>$images,
   //                      'status'=>0
   //                     ); 
   //              if (count($data) == 500 && $data!='') {                
   //              $this->db->insert_batch('tbo_master_hotel_details_new',$data);
   //              $data=array();

   //              }          
            
   //          }
            
   //          if ($data != '') {                
   //           $this->db->insert_batch('tbo_master_hotel_details_new',$data);
                
   //          }
   //      }
       
   //  }
   //       echo 'success'; exit;
   //  }
}