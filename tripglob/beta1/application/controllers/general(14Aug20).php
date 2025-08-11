<?php
ob_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) { session_start(); }
error_reporting(0);
class General extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Flight_Model');
        $this->load->model('Home_Model');
        $this->load->model('Account_Model');
        $this->load->model('General_Model');
        $this->load->model('Booking_Model');
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

       $insert = $this->Home_Model->subscribeSave($sub_mail);
      
       if($insert == '1'){
        echo  "true";
       }
       else{
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
        $data['content'] = $this->Home_Model->get_page_content($id);
        $data['top_airliners'] = $this->Home_Model->get_topairliners();
        $this->load->view(PROJECT_THEME.'/pages/pages',$data);
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
        $this->load->view(PROJECT_THEME.'/new_theme/manage_booking'); 

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
        
        //$data['response'] = 'Success';
    }
    
     public function send_feedback_request()
    {
        $insert_data['name'] = $_POST['name'];
        $insert_data['email'] = $_POST['email'];
        $insert_data['contact_number'] = $_POST['contact_number'];
        $insert_data['feedback'] = $_POST['feedback'];
        $insert_data['suggestion'] = $_POST['suggestion'];
        $this->custom_db->insert_record('feedback_details',$insert_data);
    }
    
    public function work_with_us()
    {
        //echo '<pre>';print_r($_POST);exit();
        
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
		$this->load->view(PROJECT_THEME.'/home/feedback');
	}
	
	public function advertise()
	{	
		$this->load->view(PROJECT_THEME.'/home/advertise');
	}
	
	public function work_with_uss()
	{	
		$this->load->view(PROJECT_THEME.'/home/work_with_us');
	}
	
	function getCurrencyValue(){
	    
	    //echo '<pre>';print_r($_POST);exit();
	    $result = array();
	    $response = $this->General_Model->get_currency_details($_POST['currency_code']);
	    $CI =& get_instance();
        $CI->load->library(currency_converter);
        $price_val = $_POST['total_amount'];
        $currency_code = $_POST['currency_code'];
        $total_value = $CI->currency_converter->convert(BASE_CURRENCY,$currency_code,$price_val);
        
         $result['currency_value'] = $response->value;
        $result['currency_from'] = BASE_CURRENCY;
        $result['currency_to'] = $currency_code;
        $result['price_val'] = $price_val;
        $result['converted_value'] = number_format($total_value, 2);
        $result['currency_code'] = $response->currency_symbol;
	    //echo '<pre>';print_r($response);exit();
	
        echo json_encode($result);
	}
    
    /*end*/
    
    
    
    
}
