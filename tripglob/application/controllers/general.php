<?php
ob_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) { session_start(); }
// error_reporting(0);
class General extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Flight_Model');
        $this->load->model('Home_Model');
        $this->load->model('Account_Model');
        $this->load->model('General_Model');
        $this->load->model('Booking_Model');
        $this->load->library('currency_converter');
    }
        
	function get_hotel_cities(){
		ini_set('memory_limit', '-1');
        $term = $this->input->get('term'); //retrieve the search term that autocomplete sends
        $term = trim(strip_tags($term));
        $cities = $this->Home_Model->get_hotel_cities_list($term)->result();
        // echo $this->db->last_query();die;
        // echo "<pre/>";print_r($cities);die;
        $result = array();
        foreach ($cities as $city) {
            $apts['label'] 	= $city->city_name.", ".$city->country_name;
            $apts['value'] 	= $city->city_name.",".$city->country_name;
            $apts['id'] 	= $city->tbo_city_id;
            $result[] 		= $apts;
        }
        echo json_encode($result);
	}
    public function subscribe_save(){
        $sub_mail = $this->input->post('sub_mail');
        $all_ready=$this->db->get_where('subscriber',array('subscriber_email'=>$sub_mail))->result_array();
        // debug($all_ready);exit;
        if (empty($all_ready)) {
        $insert = $this->Home_Model->subscribeSave($sub_mail);
       if($insert == '1'){
        echo  "true";
       }
       else{
         echo "false";
       }
            
        }else{
             echo "false";
        }
    }

    // public function subscribe_save(){
    //    $insert = $this->Home_Model->subscribeSave($_POST);
    // }
	
     /*
     *
     * Sightseeing AutoSuggest List
     *
     */

    function get_sightseen_city_list() {

        $this->load->model('sightseeing_model');
        $term = $this->input->get('term'); //retrieve the search term that autocomplete sends
        $term = trim(strip_tags($term));
        $data_list = $this->sightseeing_model->get_sightseen_city_list($term);
        if (valid_array($data_list) == false) {
            $data_list = $this->sightseeing_model->get_sightseen_city_list('');
        }
        $suggestion_list = array();
        $result = '';
        foreach ($data_list as $city_list) {
            $suggestion_list['label'] = $city_list['city_name'];

            $suggestion_list['value'] = $city_list['city_name'];

          //  $suggestion_list['value'] = hotel_suggestion_value($city_list['city_name'], $city_list['country_name']);
            $suggestion_list['id'] = $city_list['origin'];
            if (empty($city_list['top_destination']) == false) {
                $suggestion_list['category'] = 'Top cities';
                $suggestion_list['type'] = 'Top cities';
            } else {
                $suggestion_list['category'] = 'Location list';
                $suggestion_list['type'] = 'Location list';
            }
           
            $suggestion_list['count'] = 0;
            $result[] = $suggestion_list;
        }
        $this->output_compressed_data($result);
    }

	public function adult_child_binding_m($room_count){
		$data['room_count']	=	$room_count;
		#echo '<pre/>ss';print_r($data);exit;
		$this->load->view('hotel/adult_child_binding',$data);
	}
	
    public function package_adult_child_binding_m($room_count)
    {
            $data['room_count']=$room_count;
            $this->load->view('general/package_adult_child_binding',$data);
    }
	function child_age_binding($child_count,$room_id)
	{
			$data['child_count']=$child_count;
			$data['room_id']=$room_id;
			$this->load->view('general/child_age_binding',$data);
	}

    function package_child_age_binding($child_count,$room_id)
    {
            $data['child_count']=$child_count;
            $data['room_id']=$room_id;
            $this->load->view('general/package_child_age_binding',$data);
    }
    /*
  *Pre Transfer Search
  */
  function pre_activity_search($search_id=''){
    $search_id = $this->save_pre_search(META_SIGHTSEEING_COURSE);
    $search_params = $this->input->get();

    $insert_data['search_data'] = json_encode($search_params);
        $insert_data['search_type'] = 'ACTIVITIES';

    $search_insert_data = $this->custom_db->insert_record('search_history',$insert_data);

    $search_id = $search_insert_data['insert_id'];
    // debug($search_params);
    // exit;
    redirect('activities/index/?search_id='.$search_id.'&'.$_SERVER['QUERY_STRING']);
  }
    /*
  *Pre Transfer Search
  */
  function pre_transferv1_search($search_id=''){
    $search_id = $this->save_pre_search(META_TRANSFERV1_COURSE);
    $search_params = $this->input->get();
    redirect('transfer/index/'.$search_id.'?'.$_SERVER['QUERY_STRING']);
  }
  /**
     * Pre Search used to save the data
     *
     */
    private function save_pre_search($search_type) {
        //Save data
        $this->load->model('custom_db');
        $search_params = $this->input->get();

        //debug($search_params);exit;
        $search_data = json_encode($search_params);
        $insert_id = $this->custom_db->insert_record('search_history', array('search_type' => $search_type, 'search_data' => $search_data, 'created_datetime' => date('Y-m-d H:i:s')));
        return $insert_id['insert_id'];
    }
    function get_flight_suggestions(){
            $term = trim(strip_tags($this->input->get('term')));
            $rsa = $this->Flight_Model->getAirportcitylist($term);
            $rsa1 = $this->Flight_Model->getAirportcodelist($term);
            if(count($rsa)!=0){
                  for ($i=0; $i < count($rsa); $i++) {    
                      $rss = $this->Flight_Model->getAirportlist($rsa[$i]->city_code);
                      for($rs=0;$rs<count($rss);$rs++){
                          $data['label']  = $rss[$rs]->airport_city.', '.$rss[$rs]->airport_name."  (".$rss[$rs]->airport_code.")      ".$rss[$rs]->country;    
                          $data['value']  = $rss[$rs]->airport_city.' ('.$rss[$rs]->airport_code.')';
                          $data['id']  = $rss[$rs]->airport_id;
                      $results[]=$data;
                        }           
                    }     
            echo json_encode($results);
            }elseif(count($rsa1)!=0){
				 for ($i=0; $i < count($rsa1); $i++) {    
                          $data['label']  = $rsa1[$i]->airport_city.', '.$rsa1[$i]->airport_name." (".$rsa1[$i]->airport_code.")         ".$rsa1[$i]->country ;    
                          $data['value']  = $rsa1[$i]->airport_city.' ('.$rsa1[$i]->airport_code.')';
                          $data['id']  = $rsa1[$i]->airport_id;
                      $results[]=$data;
                    }     
            echo json_encode($results);
				}else{
                $results=array("label"=>"no records");
            echo json_encode($results); 
            }
        
    }

     function bus_stations() {
        $this->load->model('bus_model');
        $term = $this->input->get('term'); //retrieve the search term that autocomplete sends
        $term = trim(strip_tags($term));
        $data_list = $this->bus_model->get_bus_station_list($term);
         //debug($data_list);exit;
        if (valid_array($data_list) == false) {
            $data_list = $this->bus_model->get_bus_station_list($term);
        }
        $suggestion_list = array();
        $result = '';
      
        foreach ($data_list as $city_list) {
            $suggestion_list['label'] = $city_list['CityName'];
            $suggestion_list['value'] = $city_list['CityName'];
            $suggestion_list['id'] = $city_list['origin'];
                $suggestion_list['category'] = 'Search Results';
                $suggestion_list['type'] = 'Search Results';
            // }
            $result[] = $suggestion_list;
            //debug($result);exit;
        }
        $this->output_compressed_data($result);
    }


    function transfer_search() {


            $term = trim(strip_tags($this->input->get('term')));
            $country = trim(strip_tags($this->input->get('country')));

            // debug($term);  
            // debug($country); die;
            $rsa = $this->Home_Model->gettransferlist($term,$country);
            // debug($rsa);  die;
            $rsa1 = $this->Home_Model->gettransfer_code_list($term,$country);
            // debug($rsa1)."dshfkjdsh";  die;
             $rsaa = $this->Home_Model->gettransferlist_hotel($term);
            // debug($rsaa); 
            $rsa2 = $this->Home_Model->gettransfer_code_list_hotel($term);
            // debug($rsa2); die;
            if(count($rsa)!=0){
                // debug($rsa); die;
                  for ($i=0; $i < count($rsa); $i++) {    
                    // debug($rsa[$i]->AirportCode); die;
                      $rss = $this->Home_Model->getAirportlist_transfer($rsa[$i]->AirportCode);
                      // debug($rss);  
                      for($rs=0;$rs<count($rss);$rs++){
                          $data['label']  = $rss[$rs]->cityName.', '.$rss[$rs]->AirportName."  (".$rss[$rs]->AirportCode.")      ".$rss[$rs]->CountryCode;    
                          $data['value']  = $rss[$rs]->AirportName.' ('.$rss[$rs]->AirportCode.')';
                          $data['id']  = $rss[$rs]->TBOCityId;
                          $data['city_id']  = $rss[$rs]->city_id;
                          $data['from_station_id']  = $rss[$rs]->AirportCode;
                          // $data['HotelId']  = $rss[$rs]->AirportCode;
                            // debug($data); die;
                      $results[]=$data;
                        }           
                    }     
                    // debug($results); die;
            echo json_encode($results);
            }elseif(count($rsa1)!=0){
                // debug($rsa1); die;
                 for ($i=0; $i < count($rsa1); $i++) {    
                          $data['label']  = $rsa1[$i]->cityName.', '.$rsa1[$i]->AirportName." (".$rsa1[$i]->AirportCode.")         ".$rsa1[$i]->CountryCode ;    
                          $data['value']  = $rsa1[$i]->cityName.' ('.$rsa1[$i]->AirportCode.')';
                          $data['id']  = $rsa1[$i]->TBOCityId;
                          $data['city_id']  = $rsa1[$i]->city_id;
                          // $data['HotelId']  = $rsa1[$i]->HotelId;
                      $results[]=$data;
                    }     
            echo json_encode($results);
                }elseif(count($rsa2)!=0){
                // debug($rsa2); die;
                 for ($i=0; $i < count($rsa2); $i++) {    
                          // $data['label']  = $rsa1[$i]->CityName.', '.$rsa1[$i]->HotelName." (".$rsa1[$i]->HotelId.")         ".$rsa1[$i]->CountryCode ;    
                          $data['label']  = $rsa2[$i]->HotelName.', '.$rsa2[$i]->CityName."        ".$rsa2[$i]->CountryCode ;    
                          // $data['value']  = $rsa1[$i]->CityName.' ('.$rsa1[$i]->city_id.')';
                          $data['value']  = $rsa2[$i]->HotelName.','.$rsa2[$i]->CityName.','.$rsa2[$i]->CountryCode;
                          $data['id']  = $rsa2[$i]->HotelId;
                          // $data['city_id']  = $rsa2[$rs]->city_id;
                          $data['from_HotelId']  = $rsa2[$i]->HotelId;
                          $data['to_HotelId']  = $rsa2[$i]->HotelId;

                          // debug($data); die;
                      $results[]=$data;
                    }     
            echo json_encode($results);
                } else{
                $results=array("label"=>"no records");
            echo json_encode($results); 
            }
        
    }


    function transfer_search_hotel() {
            $term = trim(strip_tags($this->input->get('term')));
            // debug($term); die;
            $rsaa = $this->Home_Model->gettransferlist_hotel($term);
            // debug($rsa); 
            $rsa2 = $this->Home_Model->gettransfer_code_list_hotel($term);
            // debug($rsa1); die;

            // debug($rsa1); die;
            if(count($rsaa)!=0){
                // debug($rsa); die;
                  for ($i=0; $i < count($rsaa); $i++) {    
                    // debug($rsa[$i]->AirportCode); die;
                      $rss = $this->Home_Model->getAirportlist_transfer($rsaa[$i]->AirportCode);
                      // debug($rss); die;
                      for($rs=0;$rs<count($rss);$rs++){
                          // $data['label']  = $rss[$rs]->CityName.', '.$rss[$rs]->HotelName."  (".$rss[$rs]->HotelId.")      ".$rss[$rs]->CountryCode;    
                          $data['label']  = $rss[$rs]->CityName.', '.$rss[$rs]->HotelName." ".$rss[$rs]->CountryCode;    
                          // $data['value']  = $rss[$rs]->CityName.' ('.$rss[$rs]->city_id.')';
                          $data['value']  = $rss[$rs]->CityName.'';
                          $data['id']  = $rss[$rs]->HotelId;
                      $results[]=$data;
                        }           
                    }     
                    // debug($results); die;
            echo json_encode($results);
            }elseif(count($rsa2)!=0){
                // debug($rsa1); die;
                 for ($i=0; $i < count($rsa2); $i++) {    
                          // $data['label']  = $rsa1[$i]->CityName.', '.$rsa1[$i]->HotelName." (".$rsa1[$i]->HotelId.")         ".$rsa1[$i]->CountryCode ;    
                          $data['label']  = $rsa2[$i]->HotelName.', '.$rsa2[$i]->CityName."        ".$rsa2[$i]->CountryCode ;    
                          // $data['value']  = $rsa1[$i]->CityName.' ('.$rsa1[$i]->city_id.')';
                          $data['value']  = $rsa2[$i]->CityName.'';
                          $data['id']  = $rsa2[$i]->HotelId;
                      $results[]=$data;
                    }     
            echo json_encode($results);
                }else{
                $results=array("label"=>"no records");
            echo json_encode($results); 
            }
        
    }

    //################## Air line List suggestions 6088 ########################
    function get_airline_suggestions(){
            $term = trim(strip_tags($this->input->get('term')));
            $rsa1 = $this->Flight_Model->get_airline_list_suggestions($term);
            if(count($rsa1)!=0)
            {
                for ($i=0; $i < count($rsa1); $i++) {    
                  $data['label']  = $rsa1[$i]->airline_name.', --('.$rsa1[$i]->airline_code.")";    
                  $data['value']  = $rsa1[$i]->airline_name.' ('.$rsa1[$i]->airline_code.")";
                  $data['id']  = $rsa1[$i]->airline_list_id;
                  $results[]=$data;
                }     
              echo json_encode($results);
            }
            else
            {
                $results=array("label"=>"no records");
                echo json_encode($results); 
            }
        
    }
    
    function get_car_cities()
	{
		ini_set('memory_limit', '-1');
        $term = $this->input->get('term');
        $term = trim(strip_tags($term));
        $cities = $this->General_Model->get_car_cities_list($term)->result();
        foreach ($cities as $city) {
            $apts['label'] = $city->LocationName;
            $apts['value'] = $city->LocationName;
            $apts['id'] = $city->car_location_id;
            $result[] = $apts;
        }
        echo json_encode($result);
	}
        
    function load_pickup_cities() {
        $city = $this->General_Model->load_pickup_cities($_REQUEST['country_code'])->result();
        $city_sHtml = "";
        $city_sHtml .= '<option value="">Select Pickup City</option>';
        if (!empty($city)) {
            foreach ($city as $key => $value) {
                $city_sHtml .= '<option value="' . $value->city_id . '">' . $value->city_name . '</option>';
            }
        }
        echo json_encode(array('load_pickup_cities' => $city_sHtml));
    }
    
    function load_pickup_location() {
        $location = $this->General_Model->load_pickup_location($_REQUEST['city_code'])->result();
        $location_sHtml = "";
        $locationy_sHtml .= '<option value="">Select Pickup Location</option>';
        if (!empty($location)) {
            foreach ($location as $key => $value) {
                $locationy_sHtml .= '<option value="' . $value->location_id . '">' . $value->location_name . '</option>';
            }
        }
        echo json_encode(array('load_pickup_location' => $locationy_sHtml));
    }
        
    function load_dropoff_cities() {
        $city = $this->General_Model->load_pickup_cities($_REQUEST['country_code'])->result();
        $city_sHtml = "";
        $city_sHtml .= '<option value="">Select Drop Off City</option>';
        if (!empty($city)) {
            foreach ($city as $key => $value) {
                $city_sHtml .= '<option value="' . $value->city_id . '">' . $value->city_name . '</option>';
            }
        }
        echo json_encode(array('load_pickup_cities' => $city_sHtml));
    }
    
    function load_dropoff_location() {
        $location = $this->General_Model->load_pickup_location($_REQUEST['city_code'])->result();
        $location_sHtml = "";
        $locationy_sHtml .= '<option value="">Select Drop Off Location</option>';
        if (!empty($location)) {
            foreach ($location as $key => $value) {
                $locationy_sHtml .= '<option value="' . $value->location_id . '">' . $value->location_name . '</option>';
            }
        }
        echo json_encode(array('load_pickup_location' => $locationy_sHtml));
    }

    public function getHotelCity()
    {
        $term = $this->input->get('term'); //retrieve the search term that autocomplete sends
        $term = trim(strip_tags($term));
        $hotelsp = $this->General_Model->get_hotel_list($term)->result();//print_r($hotelsp);
        foreach($hotelsp as $hotelp){
            $apts['label'] = $hotelp->city_name.', '.$hotelp->country.'('.$hotelp->city_code.')';
            //$apts['value'] = $airport->country_name.' ('.$airport->iso3_code.')';
            //$apts['label'] = $hotelp->city;
            $apts['value'] = $hotelp->city_name.', '.$hotelp->country;
            $apts['id'] = $hotelp->id;
            $result[] = $apts; 
        }
        //print_r($result);
        echo json_encode($result);//format the array into json data
    }

    public function gethotelName()
    {
        //print_r($this->input->post('CityName'));
        $city = $this->input->post('CityName');
        $city = explode(",", $city);
        $data['City_name'] = $city[0];
        $data['Country_name'] = ltrim($city[1]);
        $hotelsp = $this->General_Model->get_Hotel_Name($data)->result();
        //echo "<pre/>";print_r($hotelsp);
        $html = '';
        foreach ($hotelsp as $key => $hotelp) {
            $html .= '<option value="'.$hotelp->Hotel_name.'">'.$hotelp->Hotel_name.'</option>';
        }
        echo json_encode(array('phphtml' => $html));//format the array into json data
    }

    public function gethoteldetails()
    {
        //echo "<pre/>";print_r($this->input->post());die;
        $city = $this->input->post('hotel_name');
        $city = explode(",", $city);
        $data['City_name'] = $city[1];
        $data['Country_name'] = ltrim($city[2]);
        $data['Hotel_name'] = $city[0];
        //echo "<pre/>";print_r($data);
        $hotelsp = $this->General_Model->get_Hotel_Name($data)->row();
        echo json_encode(array('star' => $hotelsp->Hotel_star));//format the array into json data
    }
     /**
     * Compress and output data
     * @param array $data
     */
    private function output_compressed_data($data) {


        while (ob_get_level() > 0) {
            ob_end_clean();
        }
        ob_start("ob_gzhandler");
        header('Content-type:application/json');
        echo json_encode($data);
        ob_end_flush();
        exit;
    }
    function page($id){ 
        // debug($this->session->userdata);exit;
        $data['content'] = $this->Home_Model->get_page_content($id);
        $data['top_airliners'] = $this->Home_Model->get_topairliners();
        $this->load->view(PROJECT_THEME.'/new_theme/header_new');
	    $this->load->view(PROJECT_THEME.'/pages/pages',$data);
	    $this->load->view(PROJECT_THEME.'/new_theme/footer_new'); 
       
    }
    
    function footer_data($id){ 
        $data['content'] = $this->Home_Model->get_footer_content($id);
         //echo $this->db->last_query(); exit();
        $this->load->view(PROJECT_THEME.'/pages/footer_data',$data);
    }
    
    function help($id){ 
        $data['content'] = $this->Home_Model->get_knowledge_content($id);
         //echo $this->db->last_query(); exit();
        $this->load->view(PROJECT_THEME.'/pages/knowledge_data',$data);
    }
    
    function contact_us()
    {
        $this->load->view(PROJECT_THEME.'/pages/contact_us');
    }
    function save_contact_us()
    {
        $data=array(
            'fname'=>$_POST['fname'],
            'lname'=>$_POST['lname'],
            'email'=>$_POST['email'],
            'phone'=>$_POST['phone'],
            'message'=>$_POST['message'],
            );
        $this->General_Model->save_contact_us($data);
        redirect('general/contact_us','refresh');
    }

    public function change_currency(){
//exit("rahul");

        $code = $this->input->post('code');
        $icon = $this->input->post('icon');
        if($this->input->cookie('currency')){
            $cookie = array( 'name'   => 'currency', 'value'  => $code, 'expire' => '86500');
            $this->input->set_cookie($cookie);
            $cookie = array( 'name'   => 'icon', 'value'  => $icon, 'expire' => '86500');
            $this->input->set_cookie($cookie);
            $this->display_currency = $code;
            $this->display_icon = $icon;
        }else{
            $cookie = array( 'name'   => 'currency', 'value'  => BASE_CURRENCY, 'expire' => '86500');
            $this->input->set_cookie($cookie);
            $cookie = array( 'name'   => 'icon','value'  => BASE_CURRENCY_ICON, 'expire' => '86500');
            $this->input->set_cookie($cookie);
            $this->display_currency = BASE_CURRENCY;
            $this->display_icon = BASE_CURRENCY_ICON;
        }
        $this->curr_val = $this->general_model->get_curr_val($this->display_currency);

        $cookie = array( 'name'   => 'currency_val', 'value'  => $this->curr_val, 'expire' => '86500');
        $this->input->set_cookie($cookie);

        $this->curr_val = $this->general_model->get_currency_value($this->display_currency);
        $this->curr_val_flag = $this->general_model->get_currency_value_flag($this->display_currency);
        $response = array('status' => 1,'currency_icon' => $this->display_icon, 'currency_code' => $this->display_currency, 'currency_val' => $this->curr_val);
        echo json_encode($response);
    }
    
    
    /*new functions added */
    public function manage_booking()
    {
        if ($_POST) {
            $data=$this->db->get_where('booking_global',array('con_pnr_no'=>trim($_POST['pnr'])))->row_array();
            
            if(count($data)!=0){
            if ($data['booking_status']=='CONFIRMED') {                
                redirect('booking/voucher/'.base64_encode(base64_encode($data['booking_global_id'])).'/'.base64_encode(base64_encode($data['product_id'])));
            }
            }
        }
        $this->load->view(PROJECT_THEME.'/new_theme/manage_booking'); 

    }
    
     public function special_trip()
    {
        $data['flight_details']=$this->general_model->getspecialFlightTrip();
        // debug($data);exit;
        $this->load->view(PROJECT_THEME.'/new_theme/special_trip',$data); 

    }
     
    public function allFlightTrip_details($id)
    {
        	$ids = json_decode(base64_decode($id));
            // debug($ids);exit;
         $data['flight_details']=$this->general_model->getFlightTripDetails($ids);
          foreach($data['flight_details'] as $stval)
        {
            foreach (json_decode($stval['airline_id']) as $key => $value) {
                if ($value != 'Select Airline') {
                $airIds[] = $value;
                }
            }  
            $airIds=rtrim(implode(",",$airIds),',');
            
            // debug($airIds);exit;
            $execute_query = $this->db->query("select airline_name from airline_list where airline_list_id in ($airIds)");
		    $data['airline_name'][]=$execute_query->result_array();
        }
         $this->load->view(PROJECT_THEME.'/new_theme/allFlightTrip_details',$data); 
    }
    
    public function sendEnquiry_flightTrip($id)
    {
        $data['user_type'] = $user_type = $this->session->userdata('user_type');
        $data['user_id'] = $user_id = $this->session->userdata('user_id');
          if ($this->session->userdata('user_type') == '2') {
            
           if(isset($user_id) && $user_id!=''){
               
               $datas=array(
                   'flight_trip_ids'=>$id,
                   'user_ids'=>$user_id,
                   );
               $addData=$this->general_model->insertUserDetails($datas);
           }
              redirect('general/special_trip');
        } 
          redirect(WEB_URL);
     
    }
    
   public function specialFlight_userDetail()
    {
      //  $datas=$this->general_model->getb2cftrip();
        // debug($_POST\)
        if($this->input->post('user_name'))
        {
            $datas=array(
                'user_name'=>$this->input->post('user_name'),
                'email'=>$this->input->post('email'),
                'phone'=>$this->input->post('phone'),
                'message'=>$this->input->post('message'),
                'flight_trip_ids'=>$this->input->post('flight_trip_id'),
                );
                $addData=$this->general_model->insertUserDetails($datas);
                $this->session->set_flashdata('success','Your Request has been Submited.');
                redirect('general/special_trip');
        }
    }

    public function saveSpecialFilghtDetails()
    {
      //  $datas=$this->general_model->getb2cftrip();
        // debug($_POST\)
        if($this->input->post('user_name'))
        {
            $datas=array(
                'user_name'=>$this->input->post('user_name'),
                'email'=>$this->input->post('email'),
                'phone'=>$this->input->post('phone'),
                'message'=>$this->input->post('message'),
                'flight_trip_ids'=>$this->input->post('flight_trip_id'),
                );
                $addData=$this->general_model->insertUserDetails($datas);
                $this->session->set_flashdata('success','Your Request has been Submited.');
                redirect('/');
        }
    }
    
    public function hotal_trip()
    { 
        $data['hotal_trip_details']=$this->general_model->gethotalTrip();
        error_reporting(0);
          // debug($data); exit;
        $this->load->view(PROJECT_THEME.'/new_theme/hotal_trip',$data); 

    }
    
     public function bus_trip()
    {   error_reporting(0);
        $data['bus_trip_details']=$this->general_model->getbusTrip();
       // debug($data); exit;
        $this->load->view(PROJECT_THEME.'/new_theme/busTrip',$data); 

    }
     public function allbusTrip_details($id)
    {
         $ids = json_decode(base64_decode($id));
         $data['flight_details']=$this->general_model->getbusTripDetails($ids);
         $this->load->view(PROJECT_THEME.'/new_theme/allbusTrip_details',$data); 
    }
         public function allhotelTrip_details($id)
    {
         $ids = json_decode(base64_decode($id));
         $data['hotel_details']=$this->general_model->gethotelTripDetails($ids);
         // debug($data);exit;
         $this->load->view(PROJECT_THEME.'/new_theme/allhotelTrip_details',$data); 
    }
    
     public function specialbus_userDetail()
    {
        if($this->input->post('user_name'))
        {
            $datas=array(
                'user_name'=>$this->input->post('user_name'),
                'email'=>$this->input->post('email'),
                'phone'=>$this->input->post('phone'),
                'message'=>$this->input->post('message'),
                'bus_trip_ids'=>$this->input->post('bus_trip_id'),
                );
                $addData=$this->general_model->busUserDetails($datas);
                 $this->session->set_flashdata('success','Your Request has been Submited.');
                redirect('general/bus_trip');
        }
    }
    public function specialhotel_userDetail()
    {
        if($this->input->post('user_name'))
        {
            $datas=array(
                'user_name'=>$this->input->post('user_name'),
                'email'=>$this->input->post('email'),
                'phone'=>$this->input->post('phone'),
                'message'=>$this->input->post('message'),
                'hotel_trip_ids'=>$this->input->post('bus_trip_id'),
                'requested_date'=>date('d/m/Y'),
                );
      
                $addData=$this->general_model->hotelUserDetails($datas);
                 $this->session->set_flashdata('success','Your Request has been Submited.');
                redirect('general/hotal_trip');
        }
    }
    
    public function request_ftrip_list()
    {
        $data['flight_request']=$this->general_model->getreqFlightTrip();
        $this->load->view(PROJECT_THEME.'/new_theme/request_ftrip_list',$data); 
    }
    
    public function searchFilter()
    {
        $email= $this->input->post('val');
          $data=$this->general_model->searchFilter($email);
          print_r(json_encode($data));
    }
     public function voucher(){
     //error_reporting(E_ALL);        
        $pnr_no = $this->input->post('pnr');        
       // echo $pnr_no;die;
        $count = $this->Booking_Model->getBookingPnr($pnr_no)->num_rows();       
       
        if($count == 1) {
         $b_data = $this->Booking_Model->getBookingPnr($pnr_no)->row(); 

            // echo "<pre>"; print_r($b_data); echo "</pre>"; die();
            $admin_details = $this->Booking_Model->get_admin_details();
            $data['admin_details'] = $admin_details;
            if($b_data->product_name == 'FLIGHT'){
                                
                 $data['b_data'] = $this->Booking_Model->getBookingPnr($pnr_no)->row();
                 $data['flight_iterna'] = $this->Booking_Model->getBookingFlightTemp($data['b_data']->referal_id)->row();
                 $data['flight_transaction'] = $this->Booking_Model->getbookingTransaction($data['b_data']->booking_transaction_id)->row();

                 $booking_global_id=$data['b_data']->booking_global_id;
                  $billing_address_id=$data['b_data']->billing_address_id;

                 $data['Passenger'] = $passenger = $this->Booking_Model->getPassengerbyid($booking_global_id)->result();
                 $data['booking_agent'] = $passenger = $this->Booking_Model->getagentbyid($billing_address_id)->result();
                  $this->load->view(PROJECT_THEME.'/booking/flight_voucher_view', $data);
            }
        }else{
            $this->session->set_flashdata('info','Booking is not avilable for this PNR request.');
            redirect('general/manage_booking');
            //  $this->load->view('errors/404');
        }
    }
    
    
     public function send_email_voucher(){ 
        //$this->load->library('provab_mailer');
        $pnr_no = $this->input->post('pnr');
        $email = $this->input->post('email');
        $this->load->model('email_model');
        
        $count = $this->Booking_Model->getBookingPnr($pnr_no,$con_pnr_no)->num_rows();
        
        if($count == 1){
            $b_data = $this->Booking_Model->getBookingPnr($pnr_no,$con_pnr_no)->row();   
          
            $admin_details = $this->Booking_Model->get_admin_details();
            $data['admin_details'] = $admin_details;
            if($b_data->product_name == 'FLIGHT'){
            //  $data['terms_conditions'] = $this->booking_model->get_terms_conditions($product_id);
           $data['b_data'] = $this->Booking_Model->getBookingPnr($pnr_no,$b_data->con_pnr_no)->row();     
           $booking_global_id=$b_data->booking_global_id;
           $billing_address_id=$b_data->billing_address_id;
             
                 $data['Passenger'] = $passenger = $this->Booking_Model->getPassengerbyid($booking_global_id)->result();
                 $data['booking_agent'] = $passenger = $this->Booking_Model->getagentbyid($billing_address_id)->result();
                 $booking_transaction_id = $data['b_data']->booking_transaction_id;
                 $data['booking_transaction'] = $this->Booking_Model->getbookingTransaction($booking_transaction_id)->result();

                $data['message'] = $this->load->view(PROJECT_THEME.'/booking/mail_voucher', $data,TRUE);
               
                $data['to'] = $email;               
                $data['booking_status'] = $b_data->booking_status;
                $data['pnr_no'] = $pnr_no;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'FLIGHT_BOOKING_VOUCHER';
                 // echo "b_data:<pre/>";print_r($data);exit();
                
                $Response = $this->email_model->sendmail_flightVoucher($data);
              //   echo "b_data:<pre/>";print_r($Response);exit();
                $response = array('status' => 1);
                //echo json_encode($response);
            }
        }else{
            return $response = array('status' => 0);
        }
        $this->session->set_flashdata('success','You have successfully send the mail');
        redirect('general/manage_booking');
    }

    public function change_request()
    {
        // echo"<pre/>";print_r($this->input->post());exit;
        $data['pnr_no'] = $this->input->post('pnr');
        $data['request'] = $this->input->post('change_request');
        
        $data['user_type_id'] = $user_type = $this->session->userdata('user_type');
        $data['user_id'] = $user_id = $this->session->userdata('user_id');

        $response = $this->Booking_Model->insert_change_request($data);

        $this->session->set_flashdata('success','You have successfully send the request');

        redirect('general/manage_booking');
    }
   
    
    public function send_adertise_request()
    {
        $insert_data['name'] = $_POST['name'];
        $insert_data['email'] = $_POST['email'];
        $insert_data['contact_number'] = $_POST['contact_number'];
        $insert_data['company_name'] = $_POST['company_name'];
        $insert_data['company_website'] = $_POST['company_website'];
        $this->custom_db->insert_record('request_advertise_details',$insert_data);
        $this->session->set_flashdata('success','Your Adverties Request sent Successfully.');

          redirect('general/advertise');

          
        //$data['response'] = 'Success';
    }
    
     public function send_feedback_request()
    {
        $insert_data['name'] = $_POST['name'];
        $insert_data['email'] = $_POST['email'];
        $insert_data['contact_number'] = $_POST['contact_number'];
        $insert_data['feedback'] = $_POST['feedback'];
        $insert_data['suggestion'] = $_POST['suggestion'];
        //debug($insert_data);exit;
        $this->custom_db->insert_record('feedback_details',$insert_data);
        $this->session->set_flashdata('success','Your Feedback Request sent Successfully.');

          redirect('general/feedback');
    }
    
    public function work_with_us()
    {
        // echo '<pre>';print_r($_FILES);exit();
        
        if(isset($_FILES["resume"]["name"]) && $_FILES["resume"]["name"]!='')
		{
            $ext = end(explode('/', $_FILES["resume"]["type"]));
            $tmp_name = $_FILES["resume"]["tmp_name"];   
    		$newfilename = date("dmHis").rand(1,99999) . '.' .$ext;
    	    move_uploaded_file($tmp_name, 'uploads/customer_resume/'.$newfilename);
    		$newresumefile = $newfilename;

			$insert_data=array(
				"resume"=>$newresumefile,
				"name"=>$_POST['name'],				
				"email"=>$_POST['email'],				
				"contact_number"=>$_POST['contact_number'],
				"qualification"=>$_POST['qualification'],
				"experience"=>$_POST['experience'],
				"about_yourself"=>$_POST['about_yourself'],
				);
				
			 $this->custom_db->insert_record('work_with_us',$insert_data);		
		}
        
        
         $this->session->set_flashdata('success','Your Request sent Successfully.');

        redirect('general/work_with_uss');
        
        
    }
    
    
    public function feedback()
    {
		//$this->load->view(PROJECT_THEME.'/home/feedback');
		$this->load->view(PROJECT_THEME.'/new_theme/header_new');
	    $this->load->view(PROJECT_THEME.'/home/feedback_new');
	    $this->load->view(PROJECT_THEME.'/new_theme/footer_new'); 
	}

	public function faq()
	{
	    $this->load->view(PROJECT_THEME.'/new_theme/header_new');
	    $data['faq_details']=$this->Home_Model->get_faq_detail();
        //debug($data['top_faq']);exit;
        $this->load->view(PROJECT_THEME.'/home/faq_new',$data);
        $this->load->view(PROJECT_THEME.'/new_theme/footer_new');
	}
	
	
	public function advertise()
	{	
		//$this->load->view(PROJECT_THEME.'/home/advertise');
		 $this->load->view(PROJECT_THEME.'/new_theme/header_new');
	    $this->load->view(PROJECT_THEME.'/home/advertise_new');
	    $this->load->view(PROJECT_THEME.'/new_theme/footer_new'); 
	}
	
	public function work_with_uss()
	{		//$this->load->view(PROJECT_THEME.'/home/work_with_us');
	    $this->load->view(PROJECT_THEME.'/new_theme/header_new');
	    $this->load->view(PROJECT_THEME.'/home/workWithUs');
	    $this->load->view(PROJECT_THEME.'/new_theme/footer_new'); 
	}
	
	function getCurrencyValue(){
	    
	    $result = array();
	    $response = $this->General_Model->get_currency_details($_POST['currency_code']);
	 
	    $CI =& get_instance();
       // $CI->load->library(currency_converter);
        $price_val = $_POST['total_amount'];
        $currency_code = $_POST['currency_code'];
        $total_value = $CI->currency_converter->convert(BASE_CURRENCY,$currency_code,$price_val);
        
         $result['currency_value'] = $response->value;
        $result['currency_from'] = BASE_CURRENCY;
        $result['currency_to'] = $currency_code;
        $result['price_val'] = $price_val;
        $result['converted_value'] = number_format($total_value, 2);
        $result['currency_code'] = $response->currency_symbol;
	   // echo '<pre>';print_r($result);exit();
	
        echo json_encode($result);
	}
    
    /*end*/
    // insert country code and name to database
    
     public function test(){ 
        $xml = new SimpleXMLElement("<Countries>
    <Country>
        <Code>AF</Code>
        <Name>Afghanistan</Name>
    </Country>
    <Country>
        <Code>AL</Code>
        <Name>Albania</Name>
    </Country>
    <Country>
        <Code>DZ</Code>
        <Name>Algeria</Name>
    </Country>
    <Country>
        <Code>AS</Code>
        <Name>American Samoa</Name>
    </Country>
    <Country>
        <Code>AD</Code>
        <Name>Andorra</Name>
    </Country>
    <Country>
        <Code>AO</Code>
        <Name>Angola</Name>
    </Country>
    <Country>
        <Code>AI</Code>
        <Name>Anguilla</Name>
    </Country>
    <Country>
        <Code>AQ</Code>
        <Name>Antarctica</Name>
    </Country>
    <Country>
        <Code>AG</Code>
        <Name>Antigua &amp; Barbuda</Name>
    </Country>
    <Country>
        <Code>AR</Code>
        <Name>Argentina</Name>
    </Country>
    <Country>
        <Code>AM</Code>
        <Name>Armenia</Name>
    </Country>
    <Country>
        <Code>AW</Code>
        <Name>Aruba</Name>
    </Country>
    <Country>
        <Code>AU</Code>
        <Name>Australia</Name>
    </Country>
    <Country>
        <Code>AT</Code>
        <Name>Austria</Name>
    </Country>
    <Country>
        <Code>AZ</Code>
        <Name>Azerbaijan</Name>
    </Country>
    <Country>
        <Code>BS</Code>
        <Name>Bahamas</Name>
    </Country>
    <Country>
        <Code>BH</Code>
        <Name>Bahrain</Name>
    </Country>
    <Country>
        <Code>BD</Code>
        <Name>Bangladesh</Name>
    </Country>
    <Country>
        <Code>BB</Code>
        <Name>Barbados</Name>
    </Country>
    <Country>
        <Code>BY</Code>
        <Name>Belarus (Belorussia)</Name>
    </Country>
    <Country>
        <Code>BE</Code>
        <Name>Belgium</Name>
    </Country>
    <Country>
        <Code>BZ</Code>
        <Name>Belize</Name>
    </Country>
    <Country>
        <Code>BJ</Code>
        <Name>Benin</Name>
    </Country>
    <Country>
        <Code>BM</Code>
        <Name>Bermuda</Name>
    </Country>
    <Country>
        <Code>BT</Code>
        <Name>Bhutan</Name>
    </Country>
    <Country>
        <Code>BO</Code>
        <Name>Bolivia</Name>
    </Country>
    <Country>
        <Code>BA</Code>
        <Name>Bosnia and Herzegowina</Name>
    </Country>
    <Country>
        <Code>BW</Code>
        <Name>Botswana</Name>
    </Country>
    <Country>
        <Code>BV</Code>
        <Name>Bouvet Islands</Name>
    </Country>
    <Country>
        <Code>BR</Code>
        <Name>Brazil</Name>
    </Country>
    <Country>
        <Code>IO</Code>
        <Name>British Indian Ocean Territory</Name>
    </Country>
    <Country>
        <Code>VG</Code>
        <Name>British Virgin Islands</Name>
    </Country>
    <Country>
        <Code>BN</Code>
        <Name>Brunei Darussalam</Name>
    </Country>
    <Country>
        <Code>BG</Code>
        <Name>Bulgaria</Name>
    </Country>
    <Country>
        <Code>BF</Code>
        <Name>Burkina Faso</Name>
    </Country>
    <Country>
        <Code>BI</Code>
        <Name>Burundi</Name>
    </Country>
    <Country>
        <Code>KH</Code>
        <Name>Cambodia</Name>
    </Country>
    <Country>
        <Code>CM</Code>
        <Name>Cameroon</Name>
    </Country>
    <Country>
        <Code>CA</Code>
        <Name>Canada</Name>
    </Country>
    <Country>
        <Code>CB</Code>
        <Name>Canada Buffer</Name>
    </Country>
    <Country>
        <Code>CV</Code>
        <Name>Cape Verde</Name>
    </Country>
    <Country>
        <Code>KY</Code>
        <Name>Cayman Islands</Name>
    </Country>
    <Country>
        <Code>CF</Code>
        <Name>Central African Republic</Name>
    </Country>
    <Country>
        <Code>TD</Code>
        <Name>Chad</Name>
    </Country>
    <Country>
        <Code>CL</Code>
        <Name>Chile</Name>
    </Country>
    <Country>
        <Code>CN</Code>
        <Name>China</Name>
    </Country>
    <Country>
        <Code>CX</Code>
        <Name>Christmas Islands</Name>
    </Country>
    <Country>
        <Code>CC</Code>
        <Name>Cocos (Keeling) Island</Name>
    </Country>
    <Country>
        <Code>CO</Code>
        <Name>Colombia</Name>
    </Country>
    <Country>
        <Code>KM</Code>
        <Name>Comoros</Name>
    </Country>
    <Country>
        <Code>CG</Code>
        <Name>Congo</Name>
    </Country>
    <Country>
        <Code>CD</Code>
        <Name>Congo (Rep. Dem.)</Name>
    </Country>
    <Country>
        <Code>CK</Code>
        <Name>Cook Islands</Name>
    </Country>
    <Country>
        <Code>CR</Code>
        <Name>Costa Rica</Name>
    </Country>
    <Country>
        <Code>HR</Code>
        <Name>Croatia</Name>
    </Country>
    <Country>
        <Code>CU</Code>
        <Name>Cuba</Name>
    </Country>
    <Country>
        <Code>CY</Code>
        <Name>Cyprus</Name>
    </Country>
    <Country>
        <Code>CZ</Code>
        <Name>Czech Republic</Name>
    </Country>
    <Country>
        <Code>DK</Code>
        <Name>Denmark</Name>
    </Country>
    <Country>
        <Code>DJ</Code>
        <Name>Djibouti</Name>
    </Country>
    <Country>
        <Code>DO</Code>
        <Name>Dominican Republic</Name>
    </Country>
    <Country>
        <Code>DM</Code>
        <Name>Dominicana</Name>
    </Country>
    <Country>
        <Code>TP</Code>
        <Name>East Timor</Name>
    </Country>
    <Country>
        <Code>EC</Code>
        <Name>Ecuador</Name>
    </Country>
    <Country>
        <Code>EG</Code>
        <Name>Egypt</Name>
    </Country>
    <Country>
        <Code>SV</Code>
        <Name>El Salvador</Name>
    </Country>
    <Country>
        <Code>GQ</Code>
        <Name>Equatorial Guinea</Name>
    </Country>
    <Country>
        <Code>ER</Code>
        <Name>Eritrea</Name>
    </Country>
    <Country>
        <Code>EE</Code>
        <Name>Estonia</Name>
    </Country>
    <Country>
        <Code>ET</Code>
        <Name>Ethiopia</Name>
    </Country>
    <Country>
        <Code>EU</Code>
        <Name>European Monetary Union</Name>
    </Country>
    <Country>
        <Code>FK</Code>
        <Name>Falkland Islands</Name>
    </Country>
    <Country>
        <Code>FO</Code>
        <Name>Faroe Islands</Name>
    </Country>
    <Country>
        <Code>FJ</Code>
        <Name>Fiji Islands</Name>
    </Country>
    <Country>
        <Code>FI</Code>
        <Name>Finland</Name>
    </Country>
    <Country>
        <Code>FR</Code>
        <Name>France</Name>
    </Country>
    <Country>
        <Code>GF</Code>
        <Name>French Guiana</Name>
    </Country>
    <Country>
        <Code>PF</Code>
        <Name>French Polynesia</Name>
    </Country>
    <Country>
        <Code>TF</Code>
        <Name>French Southern Territories</Name>
    </Country>
    <Country>
        <Code>GA</Code>
        <Name>Gabon</Name>
    </Country>
    <Country>
        <Code>GM</Code>
        <Name>Gambia</Name>
    </Country>
    <Country>
        <Code>GE</Code>
        <Name>Georgia</Name>
    </Country>
    <Country>
        <Code>DE</Code>
        <Name>Germany</Name>
    </Country>
    <Country>
        <Code>GH</Code>
        <Name>Ghana</Name>
    </Country>
    <Country>
        <Code>GI</Code>
        <Name>Gibralter</Name>
    </Country>
    <Country>
        <Code>GR</Code>
        <Name>Greece</Name>
    </Country>
    <Country>
        <Code>GL</Code>
        <Name>Greenland</Name>
    </Country>
    <Country>
        <Code>GD</Code>
        <Name>Grenada</Name>
    </Country>
    <Country>
        <Code>GP</Code>
        <Name>Guadeloupe</Name>
    </Country>
    <Country>
        <Code>GU</Code>
        <Name>Guam</Name>
    </Country>
    <Country>
        <Code>GT</Code>
        <Name>Guatemala</Name>
    </Country>
    <Country>
        <Code>GN</Code>
        <Name>Guinea</Name>
    </Country>
    <Country>
        <Code>GW</Code>
        <Name>Guinea-Bissau</Name>
    </Country>
    <Country>
        <Code>GY</Code>
        <Name>Guyana</Name>
    </Country>
    <Country>
        <Code>HT</Code>
        <Name>Haiti</Name>
    </Country>
    <Country>
        <Code>HM</Code>
        <Name>Heard &amp; Mcdonald Islands</Name>
    </Country>
    <Country>
        <Code>HN</Code>
        <Name>Honduras</Name>
    </Country>
    <Country>
        <Code>HK</Code>
        <Name>Hong kong</Name>
    </Country>
    <Country>
        <Code>HU</Code>
        <Name>Hungary</Name>
    </Country>
    <Country>
        <Code>IS</Code>
        <Name>Iceland</Name>
    </Country>
    <Country>
        <Code>IN</Code>
        <Name>India</Name>
    </Country>
    <Country>
        <Code>ID</Code>
        <Name>Indonesia</Name>
    </Country>
    <Country>
        <Code>IR</Code>
        <Name>Iran</Name>
    </Country>
    <Country>
        <Code>IQ</Code>
        <Name>Iraq</Name>
    </Country>
    <Country>
        <Code>IE</Code>
        <Name>Ireland</Name>
    </Country>
    <Country>
        <Code>IL</Code>
        <Name>Israel</Name>
    </Country>
    <Country>
        <Code>IT</Code>
        <Name>Italy</Name>
    </Country>
    <Country>
        <Code>CI</Code>
        <Name>Ivory Coast</Name>
    </Country>
    <Country>
        <Code>JM</Code>
        <Name>Jamaica</Name>
    </Country>
    <Country>
        <Code>JP</Code>
        <Name>Japan</Name>
    </Country>
    <Country>
        <Code>JO</Code>
        <Name>Jordan</Name>
    </Country>
    <Country>
        <Code>KZ</Code>
        <Name>Kazakhstan</Name>
    </Country>
    <Country>
        <Code>KE</Code>
        <Name>Kenya</Name>
    </Country>
    <Country>
        <Code>KI</Code>
        <Name>Kiribati</Name>
    </Country>
    <Country>
        <Code>KP</Code>
        <Name>Korea (Democratic People's Republic Of)</Name>
    </Country>
    <Country>
        <Code>KW</Code>
        <Name>Kuwait</Name>
    </Country>
    <Country>
        <Code>KG</Code>
        <Name>Kyrgyzstan</Name>
    </Country>
    <Country>
        <Code>LA</Code>
        <Name>Lao People's Democratic Republic</Name>
    </Country>
    <Country>
        <Code>LV</Code>
        <Name>Latvia</Name>
    </Country>
    <Country>
        <Code>LB</Code>
        <Name>Lebanon</Name>
    </Country>
    <Country>
        <Code>LS</Code>
        <Name>Lesotho</Name>
    </Country>
    <Country>
        <Code>LR</Code>
        <Name>Liberia</Name>
    </Country>
    <Country>
        <Code>LY</Code>
        <Name>Libyan Arab Jamahiriya</Name>
    </Country>
    <Country>
        <Code>LI</Code>
        <Name>Liechtenstein</Name>
    </Country>
    <Country>
        <Code>LT</Code>
        <Name>Lithuania</Name>
    </Country>
    <Country>
        <Code>QL</Code>
        <Name>Lithuania (Dummy Code)</Name>
    </Country>
    <Country>
        <Code>LU</Code>
        <Name>Luxembourg</Name>
    </Country>
    <Country>
        <Code>MO</Code>
        <Name>Macau</Name>
    </Country>
    <Country>
        <Code>MK</Code>
        <Name>Macedonia</Name>
    </Country>
    <Country>
        <Code>MG</Code>
        <Name>Madagascar</Name>
    </Country>
    <Country>
        <Code>MW</Code>
        <Name>Malawi</Name>
    </Country>
    <Country>
        <Code>MY</Code>
        <Name>Malaysia</Name>
    </Country>
    <Country>
        <Code>MV</Code>
        <Name>Maldives</Name>
    </Country>
    <Country>
        <Code>ML</Code>
        <Name>Mali</Name>
    </Country>
    <Country>
        <Code>MT</Code>
        <Name>Malta</Name>
    </Country>
    <Country>
        <Code>MH</Code>
        <Name>Marshall Islands</Name>
    </Country>
    <Country>
        <Code>MQ</Code>
        <Name>Martinique</Name>
    </Country>
    <Country>
        <Code>MR</Code>
        <Name>Mauritania</Name>
    </Country>
    <Country>
        <Code>MU</Code>
        <Name>Mauritius</Name>
    </Country>
    <Country>
        <Code>YT</Code>
        <Name>Mayotte</Name>
    </Country>
    <Country>
        <Code>MX</Code>
        <Name>Mexico</Name>
    </Country>
    <Country>
        <Code>MB</Code>
        <Name>Mexico Buffer</Name>
    </Country>
    <Country>
        <Code>FM</Code>
        <Name>Micronesia</Name>
    </Country>
    <Country>
        <Code>MD</Code>
        <Name>Moldova</Name>
    </Country>
    <Country>
        <Code>MC</Code>
        <Name>Monaco</Name>
    </Country>
    <Country>
        <Code>MN</Code>
        <Name>Mongolia</Name>
    </Country>
    <Country>
        <Code>MS</Code>
        <Name>Montserrat</Name>
    </Country>
    <Country>
        <Code>MA</Code>
        <Name>Morocco</Name>
    </Country>
    <Country>
        <Code>MZ</Code>
        <Name>Mozambique</Name>
    </Country>
    <Country>
        <Code>MM</Code>
        <Name>Myanmar</Name>
    </Country>
    <Country>
        <Code>NA</Code>
        <Name>Namibia</Name>
    </Country>
    <Country>
        <Code>NR</Code>
        <Name>Nauru</Name>
    </Country>
    <Country>
        <Code>NP</Code>
        <Name>Nepal</Name>
    </Country>
    <Country>
        <Code>NL</Code>
        <Name>Netherlands</Name>
    </Country>
    <Country>
        <Code>AN</Code>
        <Name>Netherlands Antilles</Name>
    </Country>
    <Country>
        <Code>NC</Code>
        <Name>New Caledonia</Name>
    </Country>
    <Country>
        <Code>NZ</Code>
        <Name>New Zealand</Name>
    </Country>
    <Country>
        <Code>NI</Code>
        <Name>Nicaragua</Name>
    </Country>
    <Country>
        <Code>NE</Code>
        <Name>Niger</Name>
    </Country>
    <Country>
        <Code>NG</Code>
        <Name>Nigeria</Name>
    </Country>
    <Country>
        <Code>NU</Code>
        <Name>Niue</Name>
    </Country>
    <Country>
        <Code>NF</Code>
        <Name>Norfolk Islands</Name>
    </Country>
    <Country>
        <Code>MP</Code>
        <Name>Northern Mariana Islands</Name>
    </Country>
    <Country>
        <Code>NO</Code>
        <Name>Norway</Name>
    </Country>
    <Country>
        <Code>OM</Code>
        <Name>Oman</Name>
    </Country>
    <Country>
        <Code>PK</Code>
        <Name>Pakistan</Name>
    </Country>
    <Country>
        <Code>PW</Code>
        <Name>Palau</Name>
    </Country>
    <Country>
        <Code>PS</Code>
        <Name>Palestinian Occ. Territories</Name>
    </Country>
    <Country>
        <Code>PA</Code>
        <Name>Panama</Name>
    </Country>
    <Country>
        <Code>PG</Code>
        <Name>Papua New Guinea</Name>
    </Country>
    <Country>
        <Code>PY</Code>
        <Name>Paraguay</Name>
    </Country>
    <Country>
        <Code>PE</Code>
        <Name>Peru</Name>
    </Country>
    <Country>
        <Code>PH</Code>
        <Name>Philippines</Name>
    </Country>
    <Country>
        <Code>PL</Code>
        <Name>Poland</Name>
    </Country>
    <Country>
        <Code>PT</Code>
        <Name>Portugal</Name>
    </Country>
    <Country>
        <Code>PR</Code>
        <Name>Puerto Rico</Name>
    </Country>
    <Country>
        <Code>QA</Code>
        <Name>Qatar</Name>
    </Country>
    <Country>
        <Code>RE</Code>
        <Name>Reunion</Name>
    </Country>
    <Country>
        <Code>RO</Code>
        <Name>Romania</Name>
    </Country>
    <Country>
        <Code>RW</Code>
        <Name>Ruanda</Name>
    </Country>
    <Country>
        <Code>RU</Code>
        <Name>Russian Federation</Name>
    </Country>
    <Country>
        <Code>LC</Code>
        <Name>Saint Lucia</Name>
    </Country>
    <Country>
        <Code>WS</Code>
        <Name>Samoa</Name>
    </Country>
    <Country>
        <Code>SM</Code>
        <Name>San Marino</Name>
    </Country>
    <Country>
        <Code>ST</Code>
        <Name>Sao Tome &amp; Principe</Name>
    </Country>
    <Country>
        <Code>SA</Code>
        <Name>Saudi Arabia</Name>
    </Country>
    <Country>
        <Code>SN</Code>
        <Name>Senegal</Name>
    </Country>
    <Country>
        <Code>SC</Code>
        <Name>Seychelles</Name>
    </Country>
    <Country>
        <Code>SL</Code>
        <Name>Sierra Leone</Name>
    </Country>
    <Country>
        <Code>SG</Code>
        <Name>Singapore</Name>
    </Country>
    <Country>
        <Code>SK</Code>
        <Name>Slovakia</Name>
    </Country>
    <Country>
        <Code>SI</Code>
        <Name>Slovenia</Name>
    </Country>
    <Country>
        <Code>SB</Code>
        <Name>Solomon Islands</Name>
    </Country>
    <Country>
        <Code>SO</Code>
        <Name>Somalia</Name>
    </Country>
    <Country>
        <Code>ZA</Code>
        <Name>South Africa</Name>
    </Country>
    <Country>
        <Code>GS</Code>
        <Name>South Georgia &amp; South Sandwich</Name>
    </Country>
    <Country>
        <Code>KR</Code>
        <Name>South Korea</Name>
    </Country>
    <Country>
        <Code>SU</Code>
        <Name>Soviet Union</Name>
    </Country>
    <Country>
        <Code>ES</Code>
        <Name>Spain</Name>
    </Country>
    <Country>
        <Code>LK</Code>
        <Name>Sri Lanka</Name>
    </Country>
    <Country>
        <Code>SH</Code>
        <Name>St. Helena</Name>
    </Country>
    <Country>
        <Code>KN</Code>
        <Name>St. Kitts and Nevis</Name>
    </Country>
    <Country>
        <Code>PM</Code>
        <Name>St. Pierre &amp; Miquelon</Name>
    </Country>
    <Country>
        <Code>VC</Code>
        <Name>St. Vincent &amp; the Grenadines</Name>
    </Country>
    <Country>
        <Code>SD</Code>
        <Name>Sudan</Name>
    </Country>
    <Country>
        <Code>SR</Code>
        <Name>Suriname</Name>
    </Country>
    <Country>
        <Code>SJ</Code>
        <Name>Svalbard &amp; Jan Mayen Islands</Name>
    </Country>
    <Country>
        <Code>SZ</Code>
        <Name>Swaziland</Name>
    </Country>
    <Country>
        <Code>SE</Code>
        <Name>Sweden</Name>
    </Country>
    <Country>
        <Code>CH</Code>
        <Name>Switzerland</Name>
    </Country>
    <Country>
        <Code>SY</Code>
        <Name>Syrian Arab Republic</Name>
    </Country>
    <Country>
        <Code>TW</Code>
        <Name>Taiwan</Name>
    </Country>
    <Country>
        <Code>TJ</Code>
        <Name>Tajikistan</Name>
    </Country>
    <Country>
        <Code>TZ</Code>
        <Name>Tanzania</Name>
    </Country>
    <Country>
        <Code>TH</Code>
        <Name>Thailand</Name>
    </Country>
    <Country>
        <Code>TG</Code>
        <Name>Togo</Name>
    </Country>
    <Country>
        <Code>TK</Code>
        <Name>Tokelau</Name>
    </Country>
    <Country>
        <Code>TO</Code>
        <Name>Tonga</Name>
    </Country>
    <Country>
        <Code>TT</Code>
        <Name>Trinidad and Tobago</Name>
    </Country>
    <Country>
        <Code>TN</Code>
        <Name>Tunisia</Name>
    </Country>
    <Country>
        <Code>TC</Code>
        <Name>Turcs &amp; Caicos Islands</Name>
    </Country>
    <Country>
        <Code>TR</Code>
        <Name>Turkey</Name>
    </Country>
    <Country>
        <Code>TM</Code>
        <Name>Turkmenistan</Name>
    </Country>
    <Country>
        <Code>TV</Code>
        <Name>Tuvalu</Name>
    </Country>
    <Country>
        <Code>UM</Code>
        <Name>U.S. Minor Outlaying Islands</Name>
    </Country>
    <Country>
        <Code>UG</Code>
        <Name>Uganda</Name>
    </Country>
    <Country>
        <Code>UA</Code>
        <Name>Ukraine</Name>
    </Country>
    <Country>
        <Code>AE</Code>
        <Name>United Arab Emirates</Name>
    </Country>
    <Country>
        <Code>GB</Code>
        <Name>United Kingdom</Name>
    </Country>
    <Country>
        <Code>UY</Code>
        <Name>Uruguay</Name>
    </Country>
    <Country>
        <Code>US</Code>
        <Name>USA</Name>
    </Country>
    <Country>
        <Code>UZ</Code>
        <Name>Uzbekistan</Name>
    </Country>
    <Country>
        <Code>VU</Code>
        <Name>Vanuatu</Name>
    </Country>
    <Country>
        <Code>VA</Code>
        <Name>Vatican City State</Name>
    </Country>
    <Country>
        <Code>VE</Code>
        <Name>Venezuela</Name>
    </Country>
    <Country>
        <Code>VN</Code>
        <Name>Vietnam</Name>
    </Country>
    <Country>
        <Code>VI</Code>
        <Name>Virgin Islands (US)</Name>
    </Country>
    <Country>
        <Code>WF</Code>
        <Name>Wallis &amp; Futuna Islands</Name>
    </Country>
    <Country>
        <Code>EH</Code>
        <Name>Western Sahara</Name>
    </Country>
    <Country>
        <Code>YE</Code>
        <Name>Yemen</Name>
    </Country>
    <Country>
        <Code>YU</Code>
        <Name>Yugoslavia</Name>
    </Country>
    <Country>
        <Code>ZM</Code>
        <Name>Zambia</Name>
    </Country>
    <Country>
        <Code>ZW</Code>
        <Name>Zimbabwe</Name>
    </Country>
</Countries>");
        $array = (array)$xml; 

        $insert_data=array(); 
        foreach ($array['Country'] as $key => $value) {  
        $res = json_decode(json_encode(($value), true), JSON_PRETTY_PRINT); 
        $insert_data['Code'] = $res['Code'];
        $insert_data['Name'] = $res['Name'];  
        $search_insert_data = $this->custom_db->insert_record('activity_country_list',$insert_data); 
        } 
     
    debug($insert_data); die;

    }

public function activity_destinations_city_wise()
{


debug('blocked'); die;
$active_home_mod=$this->Home_Model->get_transfer_country_list_(); 

foreach ($active_home_mod as $key => $values) {

    $code = $values['Code']; 
   $curl = curl_init(); 
  curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://api.tektravels.com/SharedServices/StaticData.svc/rest/GetDestinationSearchStaticData',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
"EndUserIp":"182.156.5.54" ,
"TokenId":"19b4f26e-158f-4776-abc5-9d37540eb495",  
"CountryCode":"'.$code.'", 
"SearchType"  :"1"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));  
 $response = curl_exec($curl); 
curl_close($curl); 
 $insert_data_final=array();

$jsn_dcde = json_decode($response,true);
if(isset($jsn_dcde['Destinations'] )){ 
      
        foreach ($jsn_dcde['Destinations'] as $key => $value) { 
  $insert_data=array(); 
        $insert_data['CityName'] = $value['CityName'];
        $insert_data['CountryCode'] = $value['CountryCode'];  
        $insert_data['CountryName'] = $value['CountryName'];  
        $insert_data['DestinationId'] = $value['DestinationId'];  
        $insert_data['StateProvince'] = $value['StateProvince'];  
        $insert_data['Type'] = $value['Type'];  
        $insert_data_final[]=$insert_data; 
        }  
        $search_insert_data = $this->db->insert_batch('activity_destinations_city_wise',$insert_data_final);  
         

       $this->db->where('origin',$values['origin']);
       $this->db->update('activity_country_list',array('status'=>"1"));
   }else{
    $this->db->where('origin',$values['origin']);
       $this->db->update('activity_country_list',array('status'=>"2"));
   }

} 
debug($jsn_dcde['Destinations']); die; 
}

// Get airport data ->  http://sharedapi.tektravels.com/staticdata.svc/rest/GetTransferStaticData


public function authenticate_new(){ 
    // debug('i am in airport'); die;
    $curl = curl_init(); 
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://api.tektravels.com/SharedServices/SharedData.svc/rest/Authenticate',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
"ClientId": "ApiIntegrationNew",
"UserName": "tripg",
"Password": "Tripg@1234", 
"EndUserIp": "182.156.5.54"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl); 

/*$response = '{
    "Status": 1,
    "TokenId": "76f2b168-6975-4a08-9a25-a5aa85b312cf",
    "Error": {
        "ErrorCode": 0,
        "ErrorMessage": ""
    },
    "Member": {
        "FirstName": "tbo",
        "LastName": "tbo",
        "Email": "contact@tripglobo.com",
        "MemberId": 54728,
        "AgencyId": 54818,
        "LoginName": "tripg",
        "LoginDetails": "Login Success at#@ 4/28/2022 12:38:04 PM #@ IPAddress: 115.114.12.58",
        "isPrimaryAgent": false
    }
}';*/

$jsn_dcde = json_decode($response,true);  
$token = $jsn_dcde['TokenId']; 
$execute_query = $this->db->query('select * from tbo_activity_token where id="1"');
$execute_query->result();    
 
$token_id= $execute_query->result_object[0]->id; 
$updated = $this->Home_Model->update_token($token_id,$token);
 
 }




public function activity_destinations_airport_data()
{ 
// debug('i am in airport'); die;
$get_transfer_city_list=$this->Home_Model->get_transfer_city_list();  
foreach ($get_transfer_city_list as $key => $values) { 
$code = $values['DestinationId'];  

// get token from here 
$get_new_token=$this->Home_Model->get_token_deta(); 
$token_id = $get_new_token[0]['token']; 
// get token from here 

$curl = curl_init(); 
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sharedapi.tektravels.com/staticdata.svc/rest/GetTransferStaticData',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
"CityId": "'.$code.'",
"ClientId" : "apiintegrationnew",
"EndUserIp": "182.156.5.54",
"TransferCategoryType":"1",
"TokenId": "'.$token_id.'"
} ',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl); 
curl_close($curl);  
$insert_data_final=array(); 
$jsn_dcde = json_decode($response,true); 
// debug($jsn_dcde); die;

//if token expired hit authenticate

if($jsn_dcde['Error']['ErrorCode']==2){ 
$authenticate_dat = $this->authenticate_new();
} 
//if token expired hit authenticate


$testXml = str_replace('<?xml version="1.0" encoding="utf-16"?>','',$jsn_dcde['TransferStaticData']);
$xml = new SimpleXMLElement($testXml);   
$dat_new = json_decode(json_encode($xml),true);  
if(isset($dat_new['BasicAirportPropertyInfo'] )){ 

    if(!isset($dat_new['BasicAirportPropertyInfo'][0])){
        $da[0] = $dat_new['BasicAirportPropertyInfo'];
        $dat_new['BasicAirportPropertyInfo'] = $da;
    }



      // debug($dat_new['BasicAirportPropertyInfo']); die;
        foreach ($dat_new['BasicAirportPropertyInfo'] as $key => $value) {  

            // debug($value); die;
        $insert_data=array(); 
        $insert_data['AirportCode'] = $value['@attributes']['AirportCode'];
        $insert_data['AirportName'] = $value['@attributes']['AirportName'];  
        $insert_data['CityCode'] = $value['@attributes']['CityCode'];  
        $insert_data['cityName'] = $value['@attributes']['cityName'];  
        $insert_data['TBOCityId'] = $value['@attributes']['TBOCityId'];  
        $insert_data['CountryCode'] = $value['@attributes']['CountryCode'];  
        $insert_data['status'] = "1";  
        $insert_data['city_id'] = $code;  
        $insert_data_final[]=$insert_data; 
        }  
        // debug($insert_data_final); die;
       $search_insert_data = $this->db->insert_batch('activity_airport_list',$insert_data_final);   
       $this->db->where('origin',$values['origin']);
       $this->db->update('activity_destinations_city_wise',array('status'=>"1"));
   }else{ 
    $this->db->where('origin',$values['origin']);
       $this->db->update('activity_destinations_city_wise',array('status'=>"2"));
   }

} 
// debug($dat_new); die; 
}


public function activity_destinations_hotel_data()
{



$get_new_token=$this->Home_Model->get_token_deta();  
$token_id = $get_new_token[0]['token'];  


$get_transfer_city_list=$this->Home_Model->get_transfer_city_list_h();  
foreach ($get_transfer_city_list as $key => $values) { 
$code = $values['DestinationId'];  
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sharedapi.tektravels.com/staticdata.svc/rest/GetTransferStaticData',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
"CityId": "'.$code.'",
"ClientId" : "apiintegrationnew",
"EndUserIp": "182.156.5.54",
"TransferCategoryType":"4",
"TokenId": "'.$token_id.'"
} ',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl); 
curl_close($curl); 

// debug($response); die;
 $insert_data_final=array(); 
$jsn_dcde = json_decode($response,true); 

if($jsn_dcde['Error']['ErrorCode']==2){ 
$authenticate_dat = $this->authenticate_new();
} 


$testXml = str_replace('<?xml version="1.0" encoding="utf-16"?>','',$jsn_dcde['TransferStaticData']);
$xml = new SimpleXMLElement($testXml);   
$dat_new = json_decode(json_encode($xml),true);  


if(isset($dat_new['TransferAccomodationInfo'] )){ 
    if(!isset($dat_new['TransferAccomodationInfo'][0])){
        $da[0] = $dat_new['TransferAccomodationInfo'];
        $dat_new['TransferAccomodationInfo'] = $da;
    }
// debug($dat_new); die;
      
        foreach ($dat_new['TransferAccomodationInfo'] as $key => $value) {  
            // debug($value); die;
        $insert_data=array(); 
        $insert_data['HotelId'] = $value['@attributes']['HotelId'];
        $insert_data['GiataId'] = $value['@attributes']['GiataId'];  
        $insert_data['HotelName'] = $value['@attributes']['HotelName'];  
        $insert_data['CityName'] = $value['@attributes']['CityName'];  
        $insert_data['CountryCode'] = $value['@attributes']['CountryCode'];  
        $insert_data['AddressLine1'] = $value['@attributes']['AddressLine1'];  
        $insert_data['AddressLine2'] = $value['@attributes']['AddressLine2'];  
        $insert_data['Latitude'] = $value['@attributes']['Latitude'];  
        $insert_data['Longitude'] = $value['@attributes']['Longitude'];  
        $insert_data['TBOCityId'] = $value['@attributes']['TBOCityId'];  
        $insert_data['PostalCode'] = $value['@attributes']['PostalCode'];  
        $insert_data['IsTransferActive'] = $value['@attributes']['IsTransferActive'];  
        $insert_data['status'] = "1";  
        $insert_data['city_id'] = $code;  
        $insert_data_final[]=$insert_data; 
        }  
        // debug($insert_data_final); die;
       $search_insert_data = $this->db->insert_batch('activity_hotel_list',$insert_data_final);   
       $this->db->where('origin',$values['origin']);
       $this->db->update('activity_destinations_city_wise',array('hotel_status'=>"1"));
   }else{ 
    $this->db->where('origin',$values['origin']);
       $this->db->update('activity_destinations_city_wise',array('hotel_status'=>"2"));
   }

} 
// debug($dat_new); die; 
}























/////////////activity_destinations_hotel_wise


public function activity_destinations_hotel_wise(){

// debug('test'); die;
    $active_home_mod=$this->Home_Model->get_transfer_country_list_1(); 
    // debug($active_home_mod); die;
foreach ($active_home_mod as $key => $values) {

    $code = $values['Code']; 
    // debug($code); die;
   $curl = curl_init(); 
  curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://api.tektravels.com/SharedServices/StaticData.svc/rest/GetDestinationSearchStaticData',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
"EndUserIp":"182.156.5.54" ,
"TokenId":"09fbee60-618a-4a78-8181-614b48af4993",  
"CountryCode":"'.$code.'", 
"SearchType"  :"2"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));  
 $response = curl_exec($curl); 
curl_close($curl); 
 $insert_data_final=array();

$jsn_dcde = json_decode($response,true); 
if(isset($jsn_dcde['Destinations'] )){ 
      
        foreach ($jsn_dcde['Destinations'] as $key => $value) { 
  $insert_data=array(); 
        $insert_data['CityName'] = $value['CityName'];
        $insert_data['CountryCode'] = $value['CountryCode'];  
        $insert_data['CountryName'] = $value['CountryName'];  
        $insert_data['DestinationId'] = $value['DestinationId'];  
        $insert_data['StateProvince'] = $value['StateProvince'];  
        $insert_data['Type'] = $value['Type'];  
        $insert_data_final[]=$insert_data; 
        }  
        $search_insert_data = $this->db->insert_batch('activity_destinations_hotel_wise',$insert_data_final);  
         

       $this->db->where('origin',$values['origin']);
       $this->db->update('activity_country_list_',array('status'=>"1"));
   }else{
    $this->db->where('origin',$values['origin']);
       $this->db->update('activity_country_list_',array('status'=>"2"));
   }

} 
debug($jsn_dcde['Destinations']); die; 

}









/*public function testt(){
    $curl = curl_init(); 
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sharedapi.tektravels.com/staticdata.svc/rest/GetTransferStaticData',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
"CityId": "126632",
"ClientId" : "apiintegrationnew",
"EndUserIp": "182.156.5.54",
"TransferCategoryType":"2",
"TokenId": "09fbee60-618a-4a78-8181-614b48af4993"
} ',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
debug(json_decode($response)); die;
}*/





    function get_transfer_suggestions(){


            $term = trim(strip_tags($this->input->get('term')));
            $term = "KBL";
            $rsa1 = $this->Home_Model->get_airline_list_suggestions($term);
            // debug($rsa1); die;
            if(count($rsa1)!=0)
            {
                for ($i=0; $i < count($rsa1); $i++) {    
                  $data['label']  = $rsa1[$i]->AirportName.', --('.$rsa1[$i]->AirportCode.")";    
                  $data['value']  = $rsa1[$i]->AirportName.' ('.$rsa1[$i]->AirportCode.")";
                  $data['id']  = $rsa1[$i]->TBOCityId;
                  $results[]=$data;
                }     
              echo json_encode($results); die;
            }
            else
            {
                $results=array("label"=>"no records");
                echo json_encode($results); 
            }
        
    }







    
}
