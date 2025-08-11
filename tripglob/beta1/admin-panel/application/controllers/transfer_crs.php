<?php 
ob_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);

class Transfer_crs extends CI_Controller {
	
	public function __construct(){

		parent::__construct();
		$this->load->model('transfer_model');
        
		//$this->load->model('hotel_crs_model');

        $this->load->model('admin_model');
        $this->load->model('hotel_crs_model');
        $this->load->model('user_model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		$this->load->library('form_validation');
		$this->load->library("pagination");

    }

    public function transfer_add() { 
          
        $data['transfer_detail'] = "";
        $data['admin_profile_info'] =$admin= $this->admin_model->get_admin_details();
        $admin_id=$admin->admin_id;
        $data['vehicle'] = $this->transfer_model->vehicle_view_data();
        $data['accom'] = $this->transfer_model->accom_view_data();
        $data['airline_currency'] = $this->transfer_model->fetch_airline_currency();
        $data["markets"] = $this->transfer_model->hcrs_markets();
        $data['transfer_data'] = $this->transfer_model->transfer_view_data($admin_id);
        $data["usertypes"] = $this->hotel_crs_model->usertypes();
        $data["agency_country_list"] = $this->hotel_crs_model->get_agency_countrylist();
        $data['agent_list'] = $this->user_model->get_agent_details(); 
        $this->load->view('transfer/transfer_add', $data);
    }

     public function transfer_edit($tid = 0) { 
        $vid = $this->uri->segment(3);
        $data['transfer_detail'] =   $this->transfer_model->transfer_data_basics($tid);
        $this->load->view('transfer/transfer_edit', $data);
    }
 public function save_transfer_pickup(){ 
        $Myself_status = FALSE ;

        $vehicle_type=$this->input->post('vehicle_type');
       $trans_id=$this->input->post('trans_id');
        $from_time = $this->input->post('from_time');
        $to_time = $this->input->post('to_time');
      

       
        $add_pickup_data = array( 
                        'type'=>$vehicle_type,
                        'from_time'=>$from_time,
                        'to_time'=>$to_time,
                        'transfer_id'=>$trans_id
                        );
      $returnId = $this->transfer_model->save_transfer_pickup($add_pickup_data);
            $datas = $this->transfer_model->get_transfer_pickup($trans_id);
            $data_tr = "";
            foreach($datas as $pick){ 
                $data_tr .= '<tr><td>'.$pick->type.'</td><td>'.$pick->from_time.'</td><td>'.$pick->to_time.'</td> <td> <a class="remove_pickUp btn btn-danger btn-flat" PickupId="'. $pick->id.'">Remove <i  class="fa fa-remove"></i></a></td> </tr>'; 
            }
        echo $data_tr;exit;
       
       
    }

    public function accom_add() { 
          
        $data['accom_detail'] = "";
    	 $data['country'] = $this->transfer_model->getTransferCountries()->result();
    	$this->load->view('transfer/accom_add', $data);
    }

    public function vehicle_add() {     
        $data['vehicle_detail'] = "";
        $this->load->view('transfer/vehicle_add', $data);
    }

    public function location_add() { 
        $data['accom_detail'] = "";
        $this->load->view('transfer/location_add', $data);
    }
    public function edit_location($locId = 0) { 
        $locId = $this->uri->segment(3);
        $data['location_detail'] = $this->transfer_model->location_data_basics($locId);
        $data['zone_list'] = $this->transfer_model->get_zone_list();
        $this->load->view('transfer/location_edit', $data);
    }
    public function edit_accom($accomId = 0) { 
        $accomId = $this->uri->segment(3);
        $data['accom_detail'] = $this->transfer_model->accom_data_basics($accomId);
        $data['country'] = $this->transfer_model->getTransferCountries()->result();
        $this->load->view('transfer/accom_edit', $data);
    }

    public function get_single_accom($accomId = 0) { 
        $accomId = $this->uri->segment(3);
        $accom_detail =   $this->transfer_model->accom_data_basics($accomId);
       echo json_encode($accom_detail);
       
    }
    public function getHotelList($citycode){
        $post = $this->input->post();
        $getcityname = $this->transfer_model->get_city_by_citycode($post['city']);
        $cityName    = $getcityname->destination_name; 
        $hotelList   = $this->transfer_model->getGtaHotelsByCityName($cityName); 
        $options = '';
        foreach ($hotelList as $key => $value) {

            $options .= '<option value="'.$value->HotelCode.'">'.$value->HotelName.'</option>';
        }

        $html = '<div class="form-group">
        <label class="control-label col-md-4 col-sm-4 col-xs-12">Hotel Name</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
        <select class="select2 form-control" required data-rule-required="true" name="hotel_name" id="hotel_name">'.$options.'</select> 
        <span class="error" style="color:#F00; display:none; ">This field is required</span>
        <input type="hidden" name="hotel_text" id="hotel_text" value="">
        </div>
        </div>';

        echo $html;exit;
    }

    /*Add Equipment*/
    public function add_equipment()
    {    

    $this->form_validation->set_rules('euipment_name', 'Equipment', 'trim|required|is_unique[add_equipment.euipment_name]');
    $this->form_validation->set_rules('price', 'Price', 'required|is_unique[add_equipment.price]');
    
    // exit("fff");
  
    //get the form values
    //    echo "<pre>";
    // print_r($this->input->post());
    // exit; 
     if ($this->form_validation->run() == FALSE){
      //$this->load->view('transfer/add_equipment');
    }else{
      $post_data = $this->input->post();
      if (isset($post_data) && is_array($post_data)){
        // echo "<pre>";
        // print_r($post_data);
        // exit;
      $data['euipment_name'] = $this->input->post('euipment_name');
      $data['price'] = $this->input->post('price');
      $data['checks'] = $this->input->post('checks');
      //$data['txtPassportNumber'] = $this->input->post('txtPassportNumber');
    }
      // echo "<pre>";
      // print_r($data);
      // exit;
      $this->admin_model->store_data1($data);
    }
      
    $this->load->view('transfer/add_equipment');

  }
 

    
    public function get_single_vehicle($vid = 0) { 
        $vid = $this->uri->segment(3);
        $vehicle =   $this->transfer_model->vehicledata_basics($vid);
        echo json_encode($vehicle);
         //$this->load->view('transfer/add_equipment');
    }

    public function edit_vehicle($vid = 0) { 
        $vid = $this->uri->segment(3);
        $data['vehicle_detail'] =   $this->transfer_model->vehicledata_basics($vid);
        // echo "<pre/>";print_r($data['vehicle_detail']);die;
        $this->load->view('transfer/vehicle_edit', $data);
    }

    public function edit_transfer($transfer_details_id = 0) { 
        $vid = $this->uri->segment(3);
        $data['admin_profile_info'] =$admin= $this->admin_model->get_admin_details();
        $admin_id=$admin->admin_id;
        $data['vehicle'] = $this->transfer_model->vehicle_view_data();
        $data['accom'] = $this->transfer_model->accom_view_data();
        $data['airline_currency'] = $this->transfer_model->fetch_airline_currency();
        $data["markets"] = $this->transfer_model->hcrs_markets();
        $data['transfer_data'] = $this->transfer_model->transfer_view_data($admin_id);
        $data["usertypes"] = $this->hotel_crs_model->usertypes();
        $data["agency_country_list"] = $this->hotel_crs_model->get_agency_countrylist();
        $data['agent_list'] = $this->user_model->get_agent_details(); 
       
        $data['transfer_detail'] =   $this->transfer_model->transfer_data_basics($vid);
        $this->load->view('transfer/transfer_edit', $data);
    }
    public function edit_transfer_supplier($transfer_details_id = 0) { 
        $vid = $this->uri->segment(3);
        $data['vehicle'] = $this->transfer_model->vehicle_view_data();
        $data['accom'] = $this->transfer_model->accom_view_data();
        $data['transfer_detail'] = $this->transfer_model->transfer_details($transfer_details_id);
        $this->load->view('transfer/transfer_edit_supplier', $data);
    }

    public function save_transfer(){ 
    //   echo "<pre>";
    // print_r($_POST); 
    // exit();
        $agency_type=implode(',',$this->input->post('agency_type'));
        $agency_country=implode(',',$this->input->post('agency_country'));
        $include_agancies=implode(',',$this->input->post('include_agancies'));
        $exclude_agancies=implode(',',$this->input->post('exclude_agancies'));
        $market_place=implode(',',$this->input->post('market_place'));
        $exclude_market_place=implode(',',$this->input->post('exclude_market_place'));

        $transfer_title=$this->input->post('transfer_title');
        $transfer_code=$this->input->post('transfer_code');
        $transfer_type=$this->input->post('transfer_type');
        $country = $this->input->post('transfer_country');
        $city = $this->input->post('transfer_city');
        $transfer_dir_o=$this->input->post('transfer_dir');
        $transfer_dir_s=$this->input->post('transfer_dir_s');

        $region = implode(',',$this->input->post('transfer_region'));
        $subregion = implode(',',$this->input->post('from_subregion'));
        $fromairport=$this->input->post('from_airport');
        if($fromairport!=""){
          $fairport=$this->transfer_model->get_airports_info($fromairport);
        $from_airport=$fairport[0]->airport_name.' ('.$fairport[0]->airport_code.')';
      }else{
        $from_airport="";
      }
        
        $to_region = implode(',',$this->input->post('to_region'));
        $to_subregion = implode(',',$this->input->post('to_subregion')); 
        $toairport=$this->input->post('to_airport');
        if($toairport!=""){
         $tairport=$this->transfer_model->get_airports_info($toairport);
          $to_airport=$tairport[0]->airport_name.' ('.$tairport[0]->airport_code.')';
        }else{
          $to_airport="";
        }


        if($transfer_type=="shuttle"){
          // $transfer_dir = $transfer_dir_s;
          $transfer_dir = $transfer_dir_o;
        }
        else{
          $transfer_dir = $transfer_dir_o;
          
        }

       
        $airport_code_to = $this->input->post('to_airport');
        $airport_code_from = $this->input->post('from_airport');
        $from_terminal = implode(',',$this->input->post('terminal1'));
        $to_terminal = implode(',',$this->input->post('terminal2'));
        // $from_terminal = $this->input->post('terminal1');
        // $to_terminal = $this->input->post('terminal2');

        $start_time = implode(',',$this->input->post('start_time'));
        $end_time = implode(',',$this->input->post('end_time'));
        $duration = implode(',',$this->input->post('duration'));
        $time_in = implode(',',$this->input->post('time_in'));
       // echo count($this->input->post('start_time'));
        $dur = array();
        $time_in_t = array();
        for($i=0;$i<count($this->input->post('meeting_point'));$i++){
          if($transfer_dir=="single_from_airport"){
             $meeting[0][]=$_POST['meeting_point'][$i];
             // $pickup[]=$_POST['pickup'][$i];

          }elseif ($transfer_dir=="single_to_airport") {
            $departure[]=$_POST['departure_point'][$i];
            $departuretime[]=$_POST['departure_time'][$i];
          }
      }

      for($i=0;$i<count($this->input->post('start_time'));$i++){
        if(empty($duration)){
                array_push($dur, "10");
             }

             if(empty($time_in)){
                array_push($time_in_t, "minute");
               
             }
      }

      if(empty($duration)){ $duration = implode(',',$dur); }
      if(empty($time_in)){ $time_in = implode(',',$time_in_t); }
      // print_r($duration);
      // print_r($time_in);
// exit();
 
    if($transfer_dir=="single_from_airport" && $transfer_type=="shuttle"){
        $meeting_point=json_encode($meeting);
        // $pickup=implode(',', $pickup);
    }elseif ($transfer_dir=="single_to_airport" && $transfer_type=="shuttle"){
    $departure_point=json_encode($departure);
    $departure_time=json_encode($departuretime);
    }

        $travel_description = $this->input->post('travel_description');
        $cancellation = $this->input->post('cancellation');
        $terms_conditions = $this->input->post('terms_conditions');
        //$vehicle = $this->input->post('vehicle');
        $min_adult = $this->input->post('min_adult');
        $max_adult = $this->input->post('max_adult');
        $min_child = $this->input->post('min_child');
        $max_child = $this->input->post('max_child');
        $min_infant = $this->input->post('min_infant');
        $max_infant = $this->input->post('max_infant');
        $min_adult_age = $this->input->post('min_adult_age');
        $min_child_age = $this->input->post('min_child_age');
        $min_infant_age = $this->input->post('min_infant_age');
        $max_infant_age = $this->input->post('max_infant_age');
        $max_child_age = $this->input->post('max_child_age');
        $max_adult_age = $this->input->post('max_adult_age');
        $baby_chair = $this->input->post('baby_chair');
        $destination_place = $this->input->post('dest_name');
       


         $destination_country = $this->input->post('dest_country');
         $dest_city = $this->input->post('dest_city');
         $dest_type = $this->input->post('dest_type');
         $dest_address = $this->input->post('dest_address');

         $vehicle= $this->input->post('vehicle');
          $fvehicle_type = $this->input->post('fvehicle_type');
         $fvehicle_name = $this->input->post('fvehicle_name');
         $fmin_pax = $this->input->post('fmin_pax');
         $fmax_pax = $this->input->post('fmax_pax');
         $fmax_suitcase = $this->input->post('fmax_suitcase');
 
         $image = $_POST['fcar_image'];

         $price_currency = $this->input->post('rcurrency');
         $transfer_details_id = $this->input->post('transfer_details_id');
         // $cancel_day = implode(',',$this->input->post('cancel_day'));
         $cancel_day = $this->input->post('cancel_day');

         // $cancellation_percentage = implode(',',$this->input->post('cancellation_percentage'));
         $cancellation_percentage = $this->input->post('cancellation_percentage');

         $remarks = $this->input->post('remarks');
         $remarks1 = $this->input->post('remarks1');

         $admin = $this->admin_model->get_admin_details();
         $supplier_id = $admin->admin_id; 
         $vehicle_price = $this->input->post('vehicle_price');
          $vehicle_from = $this->input->post('vehicle_from');
          $vehicle_to = $this->input->post('vehicle_to');
         $adult_price = $this->input->post('adult_price');
         $date_from = $this->input->post('date_from');
          $date_to= $this->input->post('date_to');
          //$adult_from = $this->input->post('adult_from');
          //$adult_to= $this->input->post('adult_to');
         $child_price = $this->input->post('child_price');
         $child_age = $this->input->post('child_age');
         // $child_from = $this->input->post('child_from');
          //$child_to= $this->input->post('child_to');
         $infant_price = $this->input->post('infant_price');
         $infant_age = $this->input->post('infant_age');
        // $infant_from = $this->input->post('infant_from');
        // $infant_to = $this->input->post('infant_to');

// print_r($transfer_type);exit;

         if($transfer_type!="private" && $transfer_type!="vip"){
            //print_r($transfer_type);exit;

          //  print_r($count);exit;
        $add_transfer_data = array( 
                        'supplier_id'=>$supplier_id,
                        'agency_type'=>$agency_type,
                        'agency_country'=>$agency_country,
                        'include_agancies'=>$include_agancies,
                        'exclude_agancies'=>$exclude_agancies,
                        'market_place'=>$market_place,
                        'exclude_market_place'=>$exclude_market_place,
                        'transfer_type'=>$transfer_type,
                        'transfer_direction'=>$transfer_dir,
                        'country_code'=>$country,
                        'city_code'=>$city,
                        'region'=>$region,
                        'subregion'=>$subregion,
                        'to_region'=>$to_region,
                        'to_subregion'=>$to_subregion,
                        'airport_from'=>@$from_airport,
                        'airport_from_code'=>@$airport_code_from,
                        'airport_to'=>@$to_airport,
                        'airport_to_code'=>@$airport_code_to,
                        'from_terminal'=>@$from_terminal,
                        'to_terminal'=>@$to_terminal,
                        'destination'=> '',
                        'transfer_title' => $transfer_title,
                        'transfer_code' => $transfer_code,
                        'travel_description'=>$travel_description,
                        'cancellation'=>$cancellation,
                        'terms_conditions'=>$terms_conditions,
                        'vehicle'=>$fvehicle_type,
                        'min_adult'=>$min_adult,
                        'max_adult'=>$max_adult,
                        'min_child'=>$min_child,
                        'max_child'=>$max_child,
                        'min_infant'=>$min_infant,
                        'max_infant'=>$max_infant,
                        'min_adult_age'=>$min_adult_age,
                        'min_child_age'=>$min_child_age,
                        'min_infant_age'=>$min_infant_age,
                        'max_infant_age'=>$max_infant_age,
                        'max_child_age'=>$max_child_age,
                        'max_adult_age'=>$max_adult_age,
                        'baby_chair'=>$baby_chair,
                        'destination_country'=> '',
                        'destination_place'=> '',
                        'destination_city'=> '',
                        'destination_type'=> '',
                        'destination_address'=> '',
                        'vehicle_type'=>$fvehicle_type,
                        'vehicle_name'=>$fvehicle_name,
                        'vmin_pax'=>$fmin_pax,
                        'vmax_pax'=>$fmax_pax,
                        'vmax_suitcase'=>$fmax_suitcase,
                        'image'=>$image,
                        'price_currency' => $price_currency,
                        'cancel_day'=>$cancel_day,
                        'location'=>$location,
                        'booking_status'=>$booking_status,
                        'cancellation_percentage'=>$cancellation_percentage,
                        'remarks'=>$remarks,
                        'remarks1'=>$remarks1,

                        //for price

                        'adult_price'=>$adult_price[0],
                        'child_price'=>$child_price[0],
                        'child_age'=>$child_age[0],                       
                        'infant_price'=>$infant_price[0],
                        'infant_age'=>$infant_age[0],
                        // 'vehicle_from'=>$date_from[0],
                        // 'vehicle_to'=>$date_to[0]

                        //end for price
                        ); 
// echo "<pre>",print_r($add_transfer_data);exit;
      if($transfer_details_id != ""){
            $rid = $this->transfer_model->update_transfer_details($transfer_details_id,$add_transfer_data);   
            $returnId = $transfer_details_id;
        }
        else{
         $returnId = $this->transfer_model->add_transfer_details($add_transfer_data);   
        }
$this->transfer_model->delete_price_details($returnId);
        /* if(count($adult_price)>=count($child_price)){
            $count=count($adult_price);
        }else if(count($child_price)>=count($infant_price)){
            $count=count($child_price);
        }else{
            $count=count($infant_price);
        }*/
         for($i=0;$i<count($adult_price);$i++){
          $add_price_data= array(
                        'transfer_id'=>$returnId,
                        'adult_price'=>$adult_price[$i],
                        'child_price'=>$child_price[$i],
                        'child_age'=>$child_age[$i],                       
                        'infant_price'=>$infant_price[$i],
                        'infant_age'=>$infant_age[$i],
                        'date_from'=>$date_from[$i],
                        'date_to'=>$date_to[$i]);
           $this->transfer_model->add_transfer_price_details($add_price_data);   
        }
        // print_r($returnId);exit;
if($transfer_type=="shuttle"){
    $data1=array('start_time'=>$start_time,
        'end_time'=>$end_time,
        'duration'=>$duration,
        'time_in'=>$time_in,
        'meeting_point'=>$meeting_point,
        // 'pickup'=>$pickup,
        'departure_point'=>$departure_point,
        'departure_time'=>$departure_time
        );
// print_r($data1);exit();
    $this->transfer_model->add_transfer_shuttle_details($data1,$returnId);   
        }

        }
    else if($transfer_type=="private" || $transfer_type=="vip"){

             // print_r($vehicle_price);exit;
        $add_transfer_data = array( 
                        'supplier_id'=>$supplier_id,
                        'agency_type'=>$agency_type,
                        'agency_country'=>$agency_country,
                        'include_agancies'=>$include_agancies,
                        'exclude_agancies'=>$exclude_agancies,
                        'market_place'=>$market_place,
                        'exclude_market_place'=>$exclude_market_place,
                        'transfer_type'=>$transfer_type,
                        'transfer_direction'=>$transfer_dir,

                        'country_code'=>$country,
                        'city_code'=>$city,
                        'region'=>$region,
                        'subregion'=>$subregion,
                        'to_region'=>$to_region,
                        'to_subregion'=>$to_subregion,
                        'airport_from'=>@$from_airport,
                        'airport_from_code'=>@$airport_code_from,
                        'airport_to'=>@$to_airport,
                        'airport_to_code'=>@$airport_code_to,
                        'from_terminal'=>@$from_terminal,
                        'to_terminal'=>@$to_terminal,
                        'transfer_title' => $transfer_title,
                        'transfer_code' => $transfer_code,
                        'travel_description'=>$travel_description,
                        'cancellation'=>$cancellation,
                        'terms_conditions'=>$terms_conditions,
                       // 'master_transfer_id'=>$transfer_master_id,
                        //'market'=>$market,
                        'vehicle'=>$fvehicle_type,
                        'min_adult'=>$min_adult,
                        'max_adult'=>$max_adult,
                        'min_child'=>$min_child,
                        'max_child'=>$max_child,
                        'min_infant'=>$min_infant,
                        'max_infant'=>$max_infant,
                        'min_adult_age'=>$min_adult_age,
                        'min_child_age'=>$min_child_age,
                        'min_infant_age'=>$min_infant_age,
                        'max_infant_age'=>$max_infant_age,
                        'max_child_age'=>$max_child_age,
                        'max_adult_age'=>$max_adult_age,
                        'baby_chair'=>$baby_chair,
                        'destination_country'=> '',
                        'destination_place'=> '',
                        'destination_city'=> '',
                        'destination_type'=> '',
                        'destination_address'=> '',
                        'vehicle_type'=>$fvehicle_type,
                        'vehicle_name'=>$fvehicle_name,
                        'vmin_pax'=>$fmin_pax,
                        'vmax_pax'=>$fmax_pax,
                        'vmax_suitcase'=>$fmax_suitcase,
                        'image'=>$image,
                        'price_currency' => $price_currency,
                        'cancel_day'=>$cancel_day,
                        'cancellation_percentage'=>$cancellation_percentage,
                        'remarks'=>$remarks,
                        'remarks1'=>$remarks1
                        );
                // echo "<pre>",print_r($add_transfer_data);exit;
                          if($transfer_details_id != ""){
            $rid = $this->transfer_model->update_transfer_details($transfer_details_id,$add_transfer_data); 
             $returnId = $transfer_details_id;  
        }
        else{
         $returnId = $this->transfer_model->add_transfer_details($add_transfer_data);   
        }
$this->transfer_model->delete_price_details($returnId);
 for($i=0;$i<count($vehicle_price);$i++){
$add_price_data=array('vehicle_price'=>$vehicle_price[$i],
                        'date_from'=>$vehicle_from[$i],
                        'date_to'=>$vehicle_to[$i],
                        'transfer_id'=>$returnId
                        );
$this->transfer_model->add_transfer_price_details($add_price_data); 


//update price and date
$update_transfer_price=array('vehicle_price'=>$vehicle_price[$i],
                            // 'vehicle_from'=>$vehicle_from[$i],
                            // 'vehicle_to'=>$vehicle_to[$i],
                        );

$this->transfer_model->update_transfer_details($returnId,$update_transfer_price);
// exit();
        }
       
    }
        
        redirect(WEB_URL."transfer_crs/view_transfer");
    }
    public function save_transfer_supplier(){ 
        
        $location=$this->input->post('location');
        $booking_status=$this->input->post('booking_status');
        $transfer_type=$this->input->post('transfer_type');
        $from_airport=$this->input->post('from_airport');
        $to_airport=$this->input->post('to_airport');
        if($from_airport != ""){
        $airport = $from_airport;
        }
        if($to_airport != ""){
        $airport = $to_airport;
        }
        $airport_code = $this->input->post('airport_code');

        $transfer_title = $this->input->post('transfer_title');


        $destination = $this->input->post('destination');
        $travel_description = $this->input->post('travel_description');
        //$vehicle = $this->input->post('vehicle');
        $min_adult = $this->input->post('min_adult');
        $max_adult = $this->input->post('max_adult');
        $min_child = $this->input->post('min_child');
        $max_child = $this->input->post('max_child');
        $min_infant = $this->input->post('min_infant');
        $max_infant = $this->input->post('max_infant');
        $min_adult_age = $this->input->post('min_adult_age');
        $min_child_age = $this->input->post('min_child_age');
        $min_infant_age = $this->input->post('min_infant_age');
        $max_infant_age = $this->input->post('max_infant_age');
        $max_child_age = $this->input->post('max_child_age');
        $max_adult_age = $this->input->post('max_adult_age');
        $destination_place = $this->input->post('dest_name');
        $fvehicle_type = $this->input->post('fvehicle_type');

         $destination_country = $this->input->post('dest_country');
         $dest_city = $this->input->post('dest_city');
         $dest_type = $this->input->post('dest_type');
         $dest_address = $this->input->post('dest_address');
         $fvehicle_name = $this->input->post('fvehicle_name');

          $fmin_pax = $this->input->post('fmin_pax');
         $fmax_pax = $this->input->post('fmax_pax');
         $fmin_suitcase = $this->input->post('fmin_suitcase');
         $fmax_suitcase = $this->input->post('fmax_suitcase');
         $fmin_available = $this->input->post('fmin_available');
         $fmax_available = $this->input->post('fmax_available');
         $image = $this->input->post('fcar_image');

         $adult_price = $this->input->post('adult_price');
         $child_price = $this->input->post('child_price');
         $infant_price = $this->input->post('infant_price');

          $transfer_details_id = $this->input->post('transfer_details_id');

         $cancel_day = $this->input->post('cancel_day');
         $cancellation_percentage = $this->input->post('cancellation_percentage');
         $supplier_id=$this->input->post('supplier_id');

        $add_transfer_data = array( 
                        'supplier_id'=>$supplier_id,
                        'transfer_type'=>$transfer_type,
                        'airport'=>$airport,
                        'airport_code'=>$airport_code,
                        'destination'=>$destination,
                        'transfer_title' => $transfer_title,
                        'travel_description'=>$travel_description,
                        'vehicle'=>$fvehicle_type,
                        'min_adult'=>$min_adult,
                        'max_adult'=>$max_adult,
                        'min_child'=>$min_child,
                        'max_child'=>$max_child,
                        'min_infant'=>$min_infant,
                        'max_infant'=>$max_infant,
                        'min_adult_age'=>$min_adult_age,
                        'min_child_age'=>$min_child_age,
                        'min_infant_age'=>$min_infant_age,
                        'max_infant_age'=>$max_infant_age,
                        'max_child_age'=>$max_child_age,
                        'max_adult_age'=>$max_adult_age,

                        'destination_country'=>$destination_country,
                        'destination_place'=>$destination_place,
                        'destination_city'=>$dest_city,
                        'destination_type'=>$dest_type,
                        'destination_address'=>$dest_address,
                        'vehicle_type'=>$fvehicle_type,
                        'vehicle_name'=>$fvehicle_name,
                        'vmin_pax'=>$fmin_pax,
                        'vmax_pax'=>$fmax_pax,
                        'vmin_suitcase'=>$fmin_suitcase,
                        'vmax_suitcase'=>$fmax_suitcase,
                        'vmin_available'=>$fmin_available,
                        'vmax_available'=>$fmax_available,
                        'image'=>$image,

                        'adult_price'=>$adult_price,
                        'child_price'=>$child_price,
                        'infant_price'=>$infant_price,
                        'cancel_day'=>$cancel_day,
                        'location'=>$location,
                        'booking_status'=>$booking_status,
                        'cancellation_percentage'=>$cancellation_percentage
                        );
        if($transfer_details_id != ""){
            $returnId = $this->transfer_model->update_transfer_details($transfer_details_id,$add_transfer_data);   
        }
        else{
         $returnId = $this->transfer_model->add_transfer_details($add_transfer_data);   
        }
        
        redirect(WEB_URL."transfer_crs/view_transfer_supplier");
    }
    public function view_transfer(){
        $data['admin_profile_info'] =$admin= $this->admin_model->get_admin_details();
        $admin_id=$admin->admin_id;
        $data['transfer_data'] = $this->transfer_model->transfer_view_data($admin_id);
        $data['region'] = $this->transfer_model->region()->result();
        $data['subregion'] = $this->transfer_model->subregion()->result();
        $data['hotel'] = $this->transfer_model->hotel()->result();
        //echo "<pre>",print_r($data);exit;
        $this->load->view('transfer/view_transfer', $data);
    }

    public function view_transfer_supplier(){
        $data['admin_profile_info'] =$admin= $this->admin_model->get_admin_details();
        $admin_id=$admin->admin_id;
        $data['transfer_data'] = $this->transfer_model->transfer_view_data_supplier($admin_id);
        $this->load->view('transfer/view_transfer_supplier', $data);
    }

    public function save_vehicle(){

// echo "<pre>",print_r($_POST);exit;
        $airport_cource = explode("(", $_POST['source_airport']);
        $airport_source = explode(")", $airport_cource[1])[0];
        $airport_dest = explode("(", $_POST['destination_airport']);
        $airport_destination = explode(")", $airport_dest[1])[0];
        $vehicle_type=$this->input->post('vehicle_type');
        $vehicle_name=$this->input->post('vehicle_name');
        $transfer_type=$this->input->post('transfer_type');
        $min_pax = $this->input->post('min_pax');
        $max_pax = $this->input->post('max_pax');
        //$min_suitcase = $this->input->post('min_suitcase');
        $max_suitcase=$this->input->post('max_suitcase');
        //$min_available=$this->input->post('min_available');
        //$max_available=$this->input->post('max_available');
        $images=$this->input->post('transfer_image');
        $image = implode(',',$images);

        if(empty($image)){
            $image = 'default_car.jpg';
        }

        $vid=$this->input->post('vid');
         if($vid != ""){

        $add_vehicle_data = array( 
                        'same_airport'=>@$_POST['same_airport'],
                        'different_airport'=>@$_POST['different_airport'],
                        'source_airport'=>@$_POST['source_airport'],
                        'source_airport'=>@$airport_source,
                        'destination_airport'=>@$_POST['destination_airport'],
                        'destination_airport_code'=>@$airport_destination,
                        'vehicle_type_code'=>@$_POST['vehicle_type_code'],
                        'no_of_vechile'=>@$_POST['no_of_vechile'],
                        'Supplier_id'=>@$_POST['Supplier_name'],
                        'minimum_age'=>@$_POST['minimum_age'],
                        'Maximum_Age'=>@$_POST['Maximum_Age'],
                        'equipment'=>implode(",", $_POST['equipment']),
                        'number_of_door'=>@$_POST['number_of_door'],
                        'location_information'=>@$_POST['location_information'],
                        'services'=>@$_POST['services'],
                        'age_description'=>@$_POST['age_description'],
                        'dropoff_description'=>@$_POST['dropoff_description'],
                        'fees_description'=>@$_POST['fees_description'],
                        'geographic_restrictions'=>@$_POST['geographic_restrictions'],
                        'license_description'=>@$_POST['license_description'],
                        'taxes_description'=>@$_POST['taxes_description'],
                        'loss_damages'=>@$_POST['loss_damages'],
                        'street_address'=>@$_POST['street_address'],
                        'supplier_address'=>@$_POST['supplier_address'],
                        'supplier_city'=>@$_POST['supplier_city'],
                        'supplier_state'=>@$_POST['supplier_state'],
                        'supplier_country'=>@$_POST['supplier_country'],
                        'supplier_postalcode'=>@$_POST['supplier_postalcode'],
                        'mondday_price'=>@$_POST['mondday_price'],
                        'mondday_km'=>@$_POST['mondday_km'],
                        'tuesday_price'=>@$_POST['tuesday_price'],
                        'tuesday_km'=>@$_POST['tuesday_km'],
                        'wednesday_price'=>@$_POST['wednesday_price'],
                        'wednesday_km'=>@$_POST['wednesday_km'],
                        'thursday_price'=>@$_POST['thursday_price'],
                        'thursday_km'=>@$_POST['thursday_km'],
                        'friday_price'=>@$_POST['friday_price'],
                        'friday_km'=>@$_POST['friday_km'],
                        'saturaday_price'=>@$_POST['saturaday_price'],
                        'saturaday_km'=>@$_POST['saturaday_km'],
                        'sunday_price'=>@$_POST['sunday_price'],
                        'sunday_km'=>@$_POST['sunday_km'],
                        'weekend_price_10'=>@$_POST['weekend_price_10'],
                        'weekend_price_20'=>@$_POST['weekend_price_20'],
                        'weekend_price_30'=>@$_POST['weekend_price_30'],
                        'weekend_price_40'=>@$_POST['weekend_price_40'],
                        'weekend_price_50'=>@$_POST['weekend_price_50'],
                        'weekend_price_60'=>@$_POST['weekend_price_60'],
                        'weekend_price_70'=>@$_POST['weekend_price_70'],
                        'weekend_price_80'=>@$_POST['weekend_price_80'],
                        'weekend_price_90'=>@$_POST['weekend_price_90'],
                        'weekend_price_100'=>@$_POST['weekend_price_100'],
                        'weekend_price_110'=>@$_POST['weekend_price_110'],
                        'weekday_price_10'=>@$_POST['weekday_price_10'],
                        'weekday_price_20'=>@$_POST['weekday_price_20'],
                        'weekday_price_30'=>@$_POST['weekday_price_30'],
                        'weekday_price_40'=>@$_POST['weekday_price_40'],
                        'weekday_price_50'=>@$_POST['weekday_price_50'],
                        'weekday_price_60'=>@$_POST['weekday_price_60'],
                        'weekday_price_70'=>@$_POST['weekday_price_70'],
                        'weekday_price_80'=>@$_POST['weekday_price_80'],
                        'weekday_price_90'=>@$_POST['weekday_price_90'],
                        'weekday_price_100'=>@$_POST['weekday_price_100'],
                        'weekday_price_110'=>@$_POST['weekday_price_110'],
                        'vehicle_type'=>$vehicle_type,
                        'vehicle_name'=>$vehicle_name,
                        'transfer_type'=>$transfer_type,
                        'min_pax'=>$min_pax,
                        'max_pax'=>$max_pax,
                       // 'min_suitcase'=>$min_suitcase,
                        'max_suitcase'=>$max_suitcase,
                       // 'min_available'=>$min_available,
                       // 'max_available'=>$max_available,
                        'images'=>$image
                        );

       
        $returnId = $this->transfer_model->vehicle_update($add_vehicle_data,$vid);
        }
        else{
            for ($i=0; $i <count($transfer_type) ; $i++) { 
                 $add_vehicle_data = array( 
                        'same_airport'=>@$_POST['same_airport'],
                        'different_airport'=>@$_POST['different_airport'],
                        'source_airport'=>@$airport_source,
                        'source_airport_code'=>@$_POST['source_airport'],
                        'destination_airport'=>@$_POST['destination_airport'],
                        'destination_airport_code'=>@$airport_destination,
                        'vehicle_type_code'=>@$_POST['vehicle_type_code'],
                        'no_of_vechile'=>@$_POST['no_of_vechile'],
                        'Supplier_id'=>@$_POST['Supplier_name'],
                        'minimum_age'=>@$_POST['minimum_age'],
                        'Maximum_Age'=>@$_POST['Maximum_Age'],
                        'equipment'=>implode(",", $_POST['equipment']),
                        'number_of_door'=>@$_POST['number_of_door'],
                        'location_information'=>@$_POST['location_information'],
                        'services'=>@$_POST['services'],
                        'age_description'=>@$_POST['age_description'],
                        'dropoff_description'=>@$_POST['dropoff_description'],
                        'fees_description'=>@$_POST['fees_description'],
                        'geographic_restrictions'=>@$_POST['geographic_restrictions'],
                        'license_description'=>@$_POST['license_description'],
                        'taxes_description'=>@$_POST['taxes_description'],
                        'loss_damages'=>@$_POST['loss_damages'],
                        'street_address'=>@$_POST['street_address'],
                        'supplier_address'=>@$_POST['supplier_address'],
                        'supplier_city'=>@$_POST['supplier_city'],
                        'supplier_state'=>@$_POST['supplier_state'],
                        'supplier_country'=>@$_POST['supplier_country'],
                        'supplier_postalcode'=>@$_POST['supplier_postalcode'],
                        'mondday_price'=>@$_POST['mondday_price'],
                        'mondday_km'=>@$_POST['mondday_km'],
                        'tuesday_price'=>@$_POST['tuesday_price'],
                        'tuesday_km'=>@$_POST['tuesday_km'],
                        'wednesday_price'=>@$_POST['wednesday_price'],
                        'wednesday_km'=>@$_POST['wednesday_km'],
                        'thursday_price'=>@$_POST['thursday_price'],
                        'thursday_km'=>@$_POST['thursday_km'],
                        'friday_price'=>@$_POST['friday_price'],
                        'friday_km'=>@$_POST['friday_km'],
                        'saturaday_price'=>@$_POST['saturaday_price'],
                        'saturaday_km'=>@$_POST['saturaday_km'],
                        'sunday_price'=>@$_POST['sunday_price'],
                        'sunday_km'=>@$_POST['sunday_km'],
                        'weekend_price_10'=>@$_POST['weekend_price_10'],
                        'weekend_price_20'=>@$_POST['weekend_price_20'],
                        'weekend_price_30'=>@$_POST['weekend_price_30'],
                        'weekend_price_40'=>@$_POST['weekend_price_40'],
                        'weekend_price_50'=>@$_POST['weekend_price_50'],
                        'weekend_price_60'=>@$_POST['weekend_price_60'],
                        'weekend_price_70'=>@$_POST['weekend_price_70'],
                        'weekend_price_80'=>@$_POST['weekend_price_80'],
                        'weekend_price_90'=>@$_POST['weekend_price_90'],
                        'weekend_price_100'=>@$_POST['weekend_price_100'],
                        'weekend_price_110'=>@$_POST['weekend_price_110'],
                        'weekday_price_10'=>@$_POST['weekday_price_10'],
                        'weekday_price_20'=>@$_POST['weekday_price_20'],
                        'weekday_price_30'=>@$_POST['weekday_price_30'],
                        'weekday_price_40'=>@$_POST['weekday_price_40'],
                        'weekday_price_50'=>@$_POST['weekday_price_50'],
                        'weekday_price_60'=>@$_POST['weekday_price_60'],
                        'weekday_price_70'=>@$_POST['weekday_price_70'],
                        'weekday_price_80'=>@$_POST['weekday_price_80'],
                        'weekday_price_90'=>@$_POST['weekday_price_90'],
                        'weekday_price_100'=>@$_POST['weekday_price_100'],
                        'weekday_price_110'=>@$_POST['weekday_price_110'],
                        
                        'vehicle_type'=>$vehicle_type,
                        'vehicle_name'=>$vehicle_name,
                        'transfer_type'=>$transfer_type,
                        'min_pax'=>$min_pax,
                        'max_pax'=>$max_pax,
                       // 'min_suitcase'=>$min_suitcase,
                        'max_suitcase'=>$max_suitcase,
                       // 'min_available'=>$min_available,
                       // 'max_available'=>$max_available,
                        'images'=>$image
                        );
   $returnId = $this->transfer_model->vehicle_add($add_vehicle_data);    
        }
       
        }
        
        redirect("transfer_crs/view_vehicle/");
    }

    public function transfer_list(){
         $data['admin_profile_info'] =$admin= $this->admin_model->get_admin_details();
        $admin_id=$admin->admin_id;
       // print_r($admin_id);exit;
        $data['transfer_data'] = $this->transfer_model->transfer_view_data($admin_id);
         $data['region'] = $this->transfer_model->region()->result();
        $data['subregion'] = $this->transfer_model->subregion()->result();
        $data['hotel'] = $this->transfer_model->hotel()->result();
        //echo "<pre>",print_r($data);exit;
        $this->load->view('transfer/view_transfer', $data);
    }

    public function transfer_list_supplier(){
        $data['admin_profile_info'] =$admin= $this->admin_model->get_admin_details();
        $admin_id=$admin->admin_id;

        $data['transfer_data'] = $this->transfer_model->transfer_view_data_supplier($admin_id);
        $this->load->view('transfer/view_transfer_supplier', $data);
    }
    public function view_vehicle(){
        $data['vehicle_view_data'] = $this->transfer_model->vehicle_view_data();
        $this->load->view('transfer/view_vehicle', $data);
    }

    // public function view_equipment(){
    //     $data['equipment_list'] = $this->transfer_model->equipment_list();
    //     $this->load->view('transfer/view_equipment_list', $data);
    // }
    public function get_airports($city){

    $term = $this->input->get('term');
    $term = trim(strip_tags($term));
    $cities=$this->transfer_model->get_city($city);
 //print_r($cities);exit;
    $airports = $this->transfer_model->get_airports($term,$cities[0]->city_name);  
    $result = array();
    foreach ($airports as $value) {
            $apts['label'] = $value->airport_name.' ('.$value->airport_code.')';
            $apts['value'] = $value->airport_name.' ('.$value->airport_code.')';
            $apts['id'] = $value->airport_code;
            $result[] = $apts;
        }
        //print_r($result);
        echo json_encode($result); 
    
    }

    public function save_accom(){


        $accname=$this->input->post('accname');
        $country=$this->input->post('country');
        $city = $this->input->post('city');
        $type = $this->input->post('type');
        $address = $this->input->post('address');
        $country_text   = $this->input->post('pack_country_text');
        $city_text = $this->input->post('pack_city_text');
        $accid=$this->input->post('accid');
        if($type == 'Hotel'){
            $hotel      = $this->input->post('hotel_name');
            $hotel_text = $this->input->post('hotel_text');
        }

        $add_accom_data = array( 
                        'accname'=>$accname,
                        'city'=>$city,
                        'country'=>$country,
                        'country_text'=>$country_text,
                        'city_text'=>$city_text,
                        'type'=>$type,
                        'address'=>$address,
                        'hotel'  => @$hotel,
                        'hotel_text'  => @$hotel_text,
                        );

        if($accid != ""){
        $returnId = $this->transfer_model->accom_update($add_accom_data,$accid);
        }
        else{
        $returnId = $this->transfer_model->accom_add($add_accom_data);    
        }
        
        redirect(WEB_URL."transfer_crs/view_accom/");
    }

    public function view_accom(){
    	$data['accom_view_data'] = $this->transfer_model->accom_view_data();
        $this->load->view('transfer/view_accom', $data);
    }

    public function transferAcc_change_status($accId, $get_status) {
        
        if($get_status == 1) {
            $this->transfer_model->transferAcc_change_status($accId, $get_status);  
            redirect(WEB_URL.'transfer_crs/view_accom');          
        } else if($get_status == 0) {
            $this->transfer_model->transferAcc_change_status($accId, $get_status);
            redirect(WEB_URL.'transfer_crs/view_accom');
        } else {
            redirect(WEB_URL.'transfer_crs/view_accom');
        }
    }

    public function delete_transferAcc_change_status($accId) {
        $this->transfer_model->delete_transferAcc($accId);
        redirect(WEB_URL.'transfer_crs/view_accom');
    }

    public function vehicle_change_status($vid, $get_status) {
        if($get_status == 1) {
            $this->transfer_model->vehicle_change_status($vid, $get_status);  
            redirect(WEB_URL.'transfer_crs/view_vehicle');          
        } else if($get_status == 0) {
            $this->transfer_model->vehicle_change_status($vid, $get_status);
            redirect(WEB_URL.'transfer_crs/view_vehicle');
        } else {
            redirect(WEB_URL.'transfer_crs/view_vehicle');
        }
    }

    public function equipment_change_status($id, $get_status) {
        if($get_status == 1) {
            $this->transfer_model->equipment_change_status($id, $get_status);  
            //redirect(WEB_URL.'transfer_crs/view_vehicle');          
        } else if($get_status == 0) {
            $this->transfer_model->equipment_change_status($id, $get_status);
           // redirect(WEB_URL.'transfer_crs/view_vehicle');
        } 
        // else {
        //     redirect(WEB_URL.'transfer_crs/view_vehicle');
        // }
    }

    public function transfer_change_status($transfer_details_id, $get_status) {
        if($get_status == 1) {
            $this->transfer_model->transfer_change_status($transfer_details_id, $get_status);  
            redirect(WEB_URL.'transfer_crs/view_transfer');          
        } else if($get_status == 0) {
            $this->transfer_model->transfer_change_status($transfer_details_id, $get_status);
            $this->transfer_model->transfer_topdeals_change_status($transfer_details_id, 'INACTIVE');
            redirect(WEB_URL.'transfer_crs/view_transfer');
        } else {
            redirect(WEB_URL.'transfer_crs/view_transfer');
        }
    }

    public function delete_transfer($transfer_details_id) {
        //echo $transfer_details_id;exit;
        $this->transfer_model->delete_transfer($transfer_details_id);
        redirect(WEB_URL.'transfer_crs/view_transfer');
    }


    public function delete_vehicle($vid) {
        $this->transfer_model->delete_vehicle($vid);
        redirect(WEB_URL.'transfer_crs/view_vehicle');
    }

	
    public function upload_file() { 
       
        $submit_form = $this->input->get();
        list($width, $height) = getimagesize($_FILES['uploadfile']['tmp_name']);

        // print_r($width);
        // echo "heigh".$height;
        

        if ($height >= 768 AND $width >= 1024) {
// echo "<pre>"; print_r($_FILES); exit();
        if ($_FILES['uploadfile']['error'] == 0 AND $_FILES['uploadfile']['size'] > 0) {
               
                
            if(@$_FILES["uploadfile"]["name"] !=""){
            $pack_image = explode(".",$_FILES["uploadfile"]["name"]);
            $randId = rand(1,999999999);
            $newfilename = $pack_image[0].$randId . '.' .end($pack_image);
            $tmpnamert=$_FILES['uploadfile']['tmp_name'];
            $dir = "uploads/transfer/";
            move_uploaded_file($tmpnamert, $dir.$newfilename);
            // $newfilename_dbPath = WEB_URL.'uploads/transfer/'.$newfilename;
            $newfilename_dbPath = $newfilename;
             $image = $newfilename_dbPath;

                   if ($image) {
                    
                        $Resp = '<div style="display: block; " class="col-md-4 room_image" id="imagediv-'.$randId.'" style="padding:2px;float: left;">
                                      <a title="'.$randId.'" href="javascript:void(0);" style="position: absolute;"  class="remove btn btn-danger btn-xs has-tooltip"> <i title="Remove" class="fa fa-remove"></i>
                                    </a>
                                    <img src="'.TRANSFER_IMG_PATH.$image.'" alt="" style="width:60%" />
                                    <input type="hidden" value="'.$image.'" name="transfer_image[]">
                                    <script>
                                    $(".remove").click(function(){
                                        var selected = $(this).attr("title"); 
                                    $("#imagediv-"+selected).remove();    
                                    });
                                </script>
                                  </div>
                                ';
                        echo $Resp;
                        exit;
                    } 

            
            }               
    }

    }else{

      echo $Resp = '<div class="col-md-4 pull-right"><p>Please choose larger image</p></div>';
      exit;

    }

}
 public function save_location(){

//echo "<pre>",print_r($this->input->post());exit;
        $country=$this->input->post('country');
        $city=$this->input->post('city');
        $region=$this->input->post('region');
        $subregion =$this->input->post('subregion');

        $zone_list=implode(',',$this->input->post('zone_list'));
// exit();
        $location = $this->input->post('location');
        $location_id = $this->input->post('loc_id');
      

        $add_loc_data = array( 
                        'country_code'=>$country,
                        'city_code'=>$city,
                        'region'=>$region,
                        'subregion'=>$subregion,
                        'zone_list'=>$zone_list,
                        'location'=>$location
                        );
// print_r($zone_list);exit;
    if($location_id != ""){
        $returnId = $this->transfer_model->location_update($add_loc_data,$location_id);
        }
        else{
        $returnId = $this->transfer_model->location_add($add_loc_data);    
        }
      
        redirect(WEB_URL.'transfer_crs/location_list/');
    }

    public function location_list(){
        $data['location_view_data'] = $this->transfer_model->location_view_data();
        $this->load->view('transfer/view_location', $data);
    }

      public function get_cities_country($country){
       /* $city = $this->transfer_model->getTransferCities($country);//echo '<pre>',print_r($city);exit; 
        foreach($city as $coun){
        ?>
            <option value='<?php echo $coun->city_code; ?>'><?php echo $coun->destination_name; ?></option>
        <?php
        } */ 
        $cities = $this->transfer_model->getTransferCities($country)->result();

            $options = '<option value="">Select Cities</option>';
            for($city =0; $city < count($cities); $city++){
               $options .= '<option value="'.$cities[$city]->id.'">'.$cities[$city]->city_name.'</option>';
            }
            echo $options;exit;  
  }
   public function delete_location($locId) {
   // print_r($locId);exit;
        $this->transfer_model->delete_location($locId);
        //redirect(WEB_URL.'transfer_crs/location_list/');
    }

    function getTransferCities(){
            $country_code=$_GET['country'];

        if($country_code != ''){
            $cities = $this->transfer_model->getTransferCities($country_code)->result();

            $options = '<option value="">Select Cities</option>';
            for($city =0; $city < count($cities); $city++){
               $options .= '<option value="'.$cities[$city]->city.'">'.$cities[$city]->city.'</option>';
            }
            echo $options;exit;
            //echo json_encode(array("option"=>$options)); exit;
        }
    }
     public function get_cities_region($city){
        $cities = $this->transfer_model->getTransferRegion($city)->result();

           /* $options = '<option value="">Select Regions</option>';
            for($city =0; $city < count($cities); $city++){
               $options .= '<option value="'.$cities[$city]->Id.'">'.$cities[$city]->region.'</option>';
            }*/

        if(count($cities)>0){
            $html = '<option value="all">All</option>';
             foreach ($cities as $city) { 
           $html .= '<option value="'.$city->Id.'">'.$city->region.'</option>';
             }
             echo $html;
         }
             exit;
            
  }
   public function get_region_subregion($region){
       // $regions = explode(',',$region);
 // print_r($region);exit;
    $regions=$_POST['region'];

if(is_array($regions)){
        foreach ($regions as $region) {
           $cities[] = $this->transfer_model->getTransferSubregion($region)->result();
        }
    }else{
        $cities[] = $this->transfer_model->getTransferSubregion($regions)->result();
    }

         foreach ($cities as $city) { 
            foreach ($city as $citi) {
               $cityarr[] = $citi;
            }
           // $citiies[] = $city[$key];
         } 
    
    if(count($cityarr)>0){
 $html = '<option value="all">All</option>';
             foreach ($cityarr as $city) { 
           $html .= '<option value="'.$city->Id.'">'.$city->subregion.'</option>';
             }
             echo $html;
}
             exit;

  }

     public function get_zone_list($country,$city,$region,$subregion){
       // $regions = explode(',',$region);

    $country=$_POST['country'];
    $city=$_POST['city'];
    $regions=$_POST['region'];
    $subregion=$_POST['sub_region'];

    $zone_list = $this->transfer_model->getTransferZonelist($country,$city,$regions,$subregion);
    // print_r($zone_list);
    if(count($zone_list)>0){
    $html = '<option value="all">All</option>';
        foreach ($zone_list as $zone) { 
           $html .= '<option value="'.$zone->zone_no.'">'.$zone->zone_name.'</option>';
        }
    echo $html;
    }

    exit;
  }


   public function get_regionsubregion($region){
      
    $regions=$_POST['region'];
    $cities = $this->transfer_model->getTransferSubregion($region)->result();

 $html = '<option value="all">All</option>';
             foreach ($cities as $city) { 
           $html .= '<option value="'.$city->Id.'">'.$city->subregion.'</option>';
             }
             echo $html;exit;

  }

    public function get_hotels($region){
         $regions = $_POST['region'];
        foreach ($regions as $region) {
           $cities[] = $this->transfer_model->getHotelDetails($region)->result();
        }
         foreach ($cities as $city) { 
            foreach ($city as $citi) {
               $cityarr[] = $citi;
            }
           // $citiies[] = $city[$key];
         } 
       

 $html = '';
             foreach ($cityarr as $city) { 
           $html .= '<option value="'.$city->hotel_name.'">'.$city->hotel_name.'</option>';
             }
             echo $html;exit;
  }

  public function get_airport_details($city){
        $airport = $this->transfer_model->get_airport_details($city)->result();
//echo "<pre>",print_r($airport);exit;
 $html = '';
             foreach ($airport as $airports) { 
               // print_r($airports);exit;
           $html .= '<option value="'.$airports->airport_code.'">'.$airports->airport_name.'('.$airports->airport_code.')</option>';
             }
             echo $html;exit;
  }

    public function get_hotels_region($region){
    
        $cities = $this->transfer_model->get_hotels_region($region)->result();

            
            for($city =0; $city < count($cities); $city++){
               $options .= '<option value="'.$cities[$city]->hotel_code.'">'.$cities[$city]->hotel_name.'</option>';

            }
            echo $options;exit;  
  }
   public function get_hotels_subregion($subregion){
 $tosubregion=$_POST['subregion'];
 $from_subregion=$_POST['from_subregion'];

 // $region=$_POST['region'];
// print_r($_POST);exit();

 if($from_subregion!=""){
  $subregion=array_merge($tosubregion,$from_subregion);

}else{
  $subregion=$tosubregion;
}
//print_r($subregion);exit;
   foreach ($subregion as $subregions) {
     // echo $subregions;
        $cities[] = $this->transfer_model->get_hotels_subregion($subregions)->result();
        // $cities[] = $this->transfer_model->get_hotels_subregion($region)->result();
 }
         foreach ($cities as $city) { 
            foreach ($city as $citi) {
               $cityarr[] = $citi;
            }
           // $citiies[] = $city[$key];
         } 
        // echo "<pre>",print_r($cityarr);exit;
           
            foreach ($cityarr as $key => $value) {
            
               $options .= '<option value="'.$value->hotel_name.'">'.$value->hotel_name.'</option>';

            }
            echo $options;exit;  
  }

  public function get_accomadations($region){
     $term = $this->input->get('term');
    $term = trim(strip_tags($term));
    $airports = $this->transfer_model->get_accomadations($term,$region);  
    $result = array();
    foreach ($airports as $value) {
            $apts['label'] = $value->hotel_name.' ('.$value->hotel_code.')';
            $apts['value'] = $value->hotel_name.' ('.$value->hotel_code.')';
            $apts['id'] = $value->hotel_code;
            $result[] = $apts;
        }
        //print_r($result);
        echo json_encode($result); 
    
} 
public function get_regions($city){
      $term = $this->input->get('term');
    $term = trim(strip_tags($term));
    $airports = $this->transfer_model->get_regions($term,$city);  
    $result = array();
    foreach ($airports as $value) {
            $apts['label'] = $value->region;
            $apts['value'] = $value->region;
            $apts['id'] = $value->Id;
            $result[] = $apts;
        }
        //print_r($result);
        echo json_encode($result); 
    
}   
public function get_subregions($region){
      $term = $this->input->get('term');
    $term = trim(strip_tags($term));
    $airports = $this->transfer_model->get_subregions($term,$region);  
    $result = array();
    foreach ($airports as $value) {
            $apts['label'] = $value->subregion;
            $apts['value'] = $value->subregion;
            $apts['id'] = $value->Id;
            $result[] = $apts;
        }
        //print_r($result);
        echo json_encode($result); 
    
}  
 public function remove_pickup($pickup_id = NULL)
    {
     if($this->transfer_model->delete_pickup($pickup_id ))
     {
            echo 'true' ;
     }
      
    }
public function master_module_list(){
    $data['master_module'] = $this->transfer_model->master_module_view_data();
    $data['country'] = $this->transfer_model->getTransferCountries()->result();
    $data['cities'] = $this->transfer_model->getTransferAllCities()->result();
        $this->load->view('transfer/view_master_module', $data);
}

public function add_master_module(){
  $data['country'] = $this->transfer_model->getTransferCountries()->result();
        $this->load->view('transfer/add_master_module', $data);   
}
public function save_master_transfer(){
  
     $transfer_type=$this->input->post('transfer_dir');
        $country=$this->input->post('country');
        $city=$this->input->post('city');
        $region = $this->input->post('transfer_region');
          $subregion = $this->input->post('from_subregion');
         $from_airport=$this->input->post('from_airport');
        $airport_code_from=$this->input->post('airport_code_from');
      
      $to_region=$this->input->post('to_region');
        $to_subregion=$this->input->post('to_subregion');
         $to_airport=$this->input->post('to_airport');
        $airport_code_to=$this->input->post('airport_code_to');
        
        $add_master_data = array( 
                        'transfer_type'=>$transfer_type,
                        'country'=>$country,
                        'city'=>$city,
                        'region'=>$region,
                        'sub_region'=>$subregion,
                        'from_airport'=>$from_airport,
                        'airport_code_from'=>$airport_code_from,
                        'to_region'=>$to_region,
                        'to_subregion'=>$to_subregion,
                        'to_airport'=>$to_airport,
                        'airport_code_to'=>$airport_code_to,
                       
                        );
       // print_r($add_pickup_data);exit;
      $this->transfer_model->save_master_transfer($add_master_data);
      redirect(WEB_URL."transfer_crs/master_module_list");
}
  public function delete_master_module($id) {
        $this->transfer_model->delete_transfer_master($id);
        redirect(WEB_URL.'transfer_crs/master_module_list');
    }

     public function master_transfer_status($transfer_details_id, $get_status) {
        if($get_status == "ACTIVE") {
            $this->transfer_model->master_transfer_status($transfer_details_id, $get_status);  
            redirect(WEB_URL.'transfer_crs/master_module_list');          
        } else if($get_status == "INACTIVE") {
            $this->transfer_model->master_transfer_status($transfer_details_id, $get_status);
            redirect(WEB_URL.'transfer_crs/master_module_list');
        } else {
            redirect(WEB_URL.'transfer_crs/master_module_list');
        }
    }
     public function get_master_module(){ 
//print_r($this->input->post());exit;
        $Myself_status = FALSE ;

        $country=$this->input->post('country');
       $city=$this->input->post('city');
        $transfer_type = $this->input->post('transfer_type');
            $datas = $this->transfer_model->get_master_module($country,$city,$transfer_type);
           // echo "<pre>",print_r($datas);exit;
            $data_tr = "";
            
             if($transfer_type=="single_from_airport"){
                $data_tr .= '<table class="table table-bordered"> <thead> <tr><th>From Airport</th><th>Departure</th><th>To Hotel</th><th>Arrival</th></tr><tbody >';
            foreach($datas as $pick){ 
                $data_tr .= '<tr><td>'.$pick->from_airport.'</td><td>'.$pick->departure_time.'</td><td>'.$pick->to_hotel.'</td><td>'.$pick->arival_time.'</td></tr>'; 
            }
             $data_tr .= '</tbody></table>';
         }elseif ($transfer_type=="single_to_airport") {
            $data_tr .= '<table class="table table-bordered"> <thead> <tr><th>From Hotel</th><th>Departure</th><th>To Airport</th><th>Arrival</th></tr><tbody >';
              foreach($datas as $pick){ 
                $data_tr .= '<tr><td>'.$pick->hotel_list.'</td><td>'.$pick->departure_time.'</td><td>'.$pick->to_airport.'</td><td>'.$pick->arival_time.'</td></tr>'; 
            }$data_tr .= '</tbody></table>';
            }elseif ($transfer_type=="return") {
                $data_tr .= '<table class="table table-bordered"> <thead> <tr><th>From</th><th>Departure</th><th>To</th><th>Arrival</th></tr><tbody >';
              foreach($datas as $pick){ 
                $data_tr .= '<tr><td>'.$pick->from_airport.'</td><td>'.$pick->from_time.'</td><td>'.$pick->to_airport.'</td><td>'.$pick->to_time.'</td>  </tr>'; 
            }$data_tr .= '</tbody></table>';
            }elseif ($transfer_type=="region_to_region") {
                $data_tr .= '<table class="table table-bordered"> <thead> <tr><th>From Region</th><th>Departure</th><th>To Region</th><th>Arrival</th></tr><tbody >';
             foreach($datas as $pick){ 
                $data_tr .= '<tr><td>'.$pick->region.'</td><td>'.$pick->departure_time.'</td><td>'.$pick->to_region.'</td><td>'.$pick->arival_time.'</td></tr>'; 
            }
            }elseif ($transfer_type=="subregion_to_subregion") {
                $data_tr .= '<table class="table table-bordered"> <thead> <tr><th>From Sub Region</th><th>Departure</th><th>To Sub Region</th><th>Arrival</th></tr><tbody >';
              foreach($datas as $pick){ 
                $data_tr .= '<tr><td>'.$pick->sub_region.'</td><td>'.$pick->departure_time.'</td><td>'.$pick->to_subregion.'</td><td>'.$pick->arival_time.'</td></tr>'; 
            }$data_tr .= '</tbody></table>';
            }elseif ($transfer_type=="hotel_to_hotel") {
                $data_tr .= '<table class="table table-bordered"> <thead> <tr><th>From Hotel</th><th>Departure</th><th>To Hotel</th><th>Arrival</th></tr><tbody >';
              foreach($datas as $pick){ 
                $data_tr .= '<tr><td>'.$pick->hotel_list.'</td><td>'.$pick->departure_time.'</td><td>'.$pick->to_hotel.'</td><td>'.$pick->arival_time.'</td></tr>'; 
            }$data_tr .= '</tbody></table>';
            }elseif ($transfer_type=="region_to_hotel") {
                $data_tr .= '<table class="table table-bordered"> <thead> <tr><th>From Region</th><th>Departure</th><th>To Hotel</th><th>Arrival</th></tr><tbody >';
            foreach($datas as $pick){ 
                $data_tr .= '<tr><td>'.$pick->region.'</td><td>'.$pick->departure_time.'</td><td>'.$pick->to_hotel.'</td><td>'.$pick->arival_time.'</td></tr>'; 
            }$data_tr .= '</tbody></table>';
            }elseif ($transfer_type=="subregion_to_hotel") {
                $data_tr .= '<table class="table table-bordered"> <thead> <tr><th>From SubRegion</th><th>Departure</th><th>To Hotel</th><th>Arrival</th></tr><tbody >';
              foreach($datas as $pick){ 
                $data_tr .= '<tr><td>'.$pick->sub_region.'</td><td>'.$pick->departure_time.'</td><td>'.$pick->to_hotel.'</td><td>'.$pick->arival_time.'</td></tr>'; 
            }$data_tr .= '</tbody></table>';
            }elseif ($transfer_type=="hotel_to_region") {
                $data_tr .= '<table class="table table-bordered"> <thead> <tr><th>From Hotel</th><th>Departure</th><th>To Region</th><th>Arrival</th></tr><tbody >';
              foreach($datas as $pick){ 
                $data_tr .= '<tr><td>'.$pick->hotel_list.'</td><td>'.$pick->departure_time.'</td><td>'.$pick->to_region.'</td><td>'.$pick->arival_time.'</td></tr>'; 
            }$data_tr .= '</tbody></table>';
            }elseif ($transfer_type=="hotel_to_subregion") {
                 $data_tr .= '<table class="table table-bordered"> <thead> <tr><th>From Hotel</th><th>Departure</th><th>To Sub Region</th><th>Arrival</th></tr><tbody >';
              foreach($datas as $pick){ 
           
                $data_tr .= '<tr><td>'.$pick->hotel_list.'</td><td>'.$pick->departure_time.'</td><td>'.$pick->to_subregion.'</td><td>'.$pick->arival_time.'</td></tr>'; 
            }$data_tr .= '</tbody></table>';
            }

     
        echo $data_tr;exit;
       
       
    }
       public function selectVehicleType($type){
        $vehicle = $this->transfer_model->selectVehicleType($type)->result();

            $options = '<option value="">Select Vehicle</option>';
            for($v =0; $v < count($vehicle); $v++){
               $options .= '<option value="'.$vehicle[$v]->vid.'">'.$vehicle[$v]->vehicle_type.' - '.$vehicle[$v]->vehicle_name.'</option>';
            }
            echo $options;exit;  
  }
  public function airport_list(){
    $data['airport_list'] =$airport_list=$this->transfer_model->airport_list_view_data()->result();
    // $data['airport_list'] = $this->transfer_model->airport_list_data()->result();
    foreach ($airport_list as $key => $value) {
      $airport_name[]=$this->transfer_model->selectairportName($value->airport_code)->result(); 
    }
   
$data['airport_name']=$airport_name;

        $this->load->view('transfer/view_airport_list', $data);
}
/* show data*/
 public function equipment_list(){
    $data['equipment_list'] =$equipment_list=$this->transfer_model->equipment_list_view_data()->result();
    // $data['airport_list'] = $this->transfer_model->airport_list_data()->result();
    // foreach ($airport_list as $key => $value) {
    //   $airport_name[]=$this->transfer_model->selectairportName($value->airport_code)->result(); 
    // }
    //$data['airport_name']=$airport_name;

        $this->load->view('transfer/view_equipment_list', $data);
    }

public function add_airport_list(){
  $data['airport_list'] = $this->transfer_model->airport_list_data()->result();

        $this->load->view('transfer/add_airport_list', $data);   
}
public function save_airport_list(){
     //print_r($_POST);exit;
     $terminal_code=$_POST['terminal_code'];
    $terminal_name=$_POST['terminal_name'];
$airport_name=$_POST['airport_name'];
    $airport_code=$_POST['airport_code'];
    $this->transfer_model->update_airport_name($airport_code,$airport_name);
    for ($i=0; $i < count($terminal_code); $i++) { 
       // print_r($_POST);exit;
        $add_airport_data = array( 
                        'airport_code'=>$airport_code,
                        'terminal_name'=>$terminal_name[$i],
                        'terminal_code'=>$terminal_code[$i],
                        'status'=>'ACTIVE',
                        );
       // print_r($add_airport_data);exit;
      $this->transfer_model->save_airport_list($add_airport_data);
      
    }
        
        
      redirect(WEB_URL."transfer_crs/airport_list");
}



public function update_airport_list(){
     //print_r($_POST);exit;
    $terminal_code=$_POST['terminal_code'];
    $terminal_name=$_POST['terminal_name'];
    $airport_name=$_POST['airport_name'];
    $airport_code=$_POST['airport_code'];
    $this->transfer_model->deletAirportList($airport_code);
    for ($i=0; $i < count($terminal_code); $i++) { 
       // print_r($_POST);exit;
        $add_airport_data = array( 
                        'airport_code'=>$airport_code,
                        'terminal_name'=>$terminal_name[$i],
                        'terminal_code'=>$terminal_code[$i],
                        'status'=>'ACTIVE',
                        );
       // print_r($add_airport_data);exit;
      $this->transfer_model->save_airport_list($add_airport_data);
      $this->transfer_model->update_airport_name($airport_code,$airport_name);
      
    }
        
        
      redirect(WEB_URL."transfer_crs/airport_list");
}

  public function update()
  {
    $this->form_validation->set_rules('euipment_name', 'euipment_name', 'required');
    $this->form_validation->set_rules('price', 'Price', 'required');
    $id=$this->input->post('hidenid');
        if ($this->form_validation->run() == FALSE){
      $output=$this->transfer_model->equipment_list_databyid($id);
      $data['id']= $output['hidenid'];
      $data['euipment_name']= $output['euipment_name'];
      $data['price']= $output['price'];
    // echo "<pre/>";print_r($_POST);die;
      
      redirect('transfer_crs/edit_equipment_list/'.$id);
    }else{
    $wdata['id']= $id;
  $data['euipment_name']= $_POST['euipment_name'];
  $data['price']= $_POST['price'];
  $data['checks']= $_POST['checks'];
  $this->db->update('add_equipment', $data, $wdata);
  //$this->session->set_flashdata('successmsg', 'Your data updated successfully');
  //$this->load->view('transfer/equipment_list',$data);
  redirect('transfer_crs/equipment_list',$data);
  }
  
  }

  public function delete_airport_list($id) {
        $this->transfer_model->delete_transfer_master($id);
        redirect(WEB_URL.'transfer_crs/airport_list');
    }

     public function airport_list_status($transfer_details_id, $get_status) {
        if($get_status == "ACTIVE") {
            $this->transfer_model->master_transfer_status($transfer_details_id, $get_status);  
            redirect(WEB_URL.'transfer_crs/airport_list');          
        } else if($get_status == "INACTIVE") {
            $this->transfer_model->master_transfer_status($transfer_details_id, $get_status);
            redirect(WEB_URL.'transfer_crs/airport_list');
        } else {
            redirect(WEB_URL.'transfer_crs/airport_list');
        }
    }
    public function selectairportcode(){
        $val=$_POST['airport'];
        //print_r($val);exit;
  $airport_code = $this->transfer_model->get_airport_code($val)->result();
$data['airport_code']=$airport_code[0]->airport_code;
$data['airport_name']=$val;
echo json_encode($data);
        
}
public function edit_airport_list($airport_code){
    //print_r($airport_code);exit;
    $data['airport_code']=$airport_code;
  $data['airport_list'] = $this->transfer_model->airport_list_databyid($airport_code)->result();
    //$data['airport_list'] = $this->transfer_model->airport_list_data()->result();
   $airport_name=$this->transfer_model->selectairportName($airport_code)->result();
$data['airport_name']=$airport_name[0]->airport_name;
        $this->load->view('transfer/edit_airport_list', $data);   
}
/* edit_equipment_list */
 public function edit_equipment_list($id){

  $id=$this->uri->segment(3); 
  $output=$this->transfer_model->equipment_list_databyid($id);
    $data['id']= $output['id'];
  $data['euipment_name']= $output['euipment_name'];
  $data['pricee']= $output['price'];
  $data['checks']= $output['checks'];
  // print_r($data);
  // exit();
    //print_r($airport_code);exit;
    //$data['airport_code']=$airport_code;
  //$data['equipment_list'] = $this->transfer_model->equipment_list_databyid($id)->result_array();
  // echo $this->db->last_query();
  // print_r($data['equipment_list']);
  // exit();

    //$data['airport_list'] = $this->transfer_model->airport_list_data()->result();
   //$airport_name=$this->transfer_model->selectairportName($airport_code)->result();
//$data['airport_name']=$airport_name[0]->airport_name;
        $this->load->view('transfer/edit_equipment_list', $data);   
}

public function showairportlist(){
$airport=$_POST['airport'];
//echo $airport;exit;
  $airport_list= $this->transfer_model->airport_list_databyid($airport)->result();
 

     $html = '<option value="all">All</option>';
              foreach ($airport_list as $key => $value) { 
           $html .= '<option value="'.$value->terminal_code.'">'.$value->terminal_name.'</option>';
             }
             echo $html;exit;
}

public function get_hotels_mpoint($country='',$city=''){

    if(empty($country)){
        $transfer_country=$_POST['transfer_country'];
    }else{ $transfer_country=$country; }

    if(empty($city)){
        $transfer_city=$_POST['transfer_city'];
    }else{ $transfer_city=$city;}
    
    $city = $transfer_city.','.$transfer_country;
    $hotelarray = $this->transfer_model->get_hotels_list($city);

    // echo "<pre>";print_r($hotelarray);exit; 
    foreach ($hotelarray as $key => $value) {
      $options .= '<option value="'.$value->hotel_name.'">'.$value->hotel_name.'</option>';
    }
    echo $options;exit; 
}
    
  /*---Supplier Section Start----*/

  public function add_supplier(){    

    $this->form_validation->set_rules('supplier_name', 'Supplier name', 'trim|required|is_unique[add_supplier.supplier_name]');
    $this->form_validation->set_rules('supplier_code', 'Supplier Code', 'required|is_unique[add_supplier.supplier_code]');

    if ($this->form_validation->run() == FALSE){
      //$this->load->view('transfer/add_equipment');
    }else{
      $post_data = $this->input->post();
      if (isset($post_data) && is_array($post_data)){
        
      $data['supplier_name'] = $this->input->post('supplier_name');
      $data['supplier_code'] = $this->input->post('supplier_code');
      
    }
      
      $this->admin_model->store_data_supplier($data);
    }
      
    $this->load->view('transfer/add_supplier');
  }


  /* show supplier_list data*/
  public function supplier_list(){
    $data['supplier_list'] =$supplier_list=$this->transfer_model->supplier_list_view_data()->result();
      $this->load->view('transfer/view_supplier_list', $data);
  }

  /* edit supplier list data */
 public function edit_supplier_list($id){

    $id=$this->uri->segment(3); 
    $output=$this->transfer_model->supplier_list_databyid($id);
    $data['id']= $output['id'];
    $data['supplier_name']= $output['supplier_name'];
    $data['supplier_code']= $output['supplier_code'];
   
  
    $this->load->view('transfer/edit_supplier_list', $data);   
  }

  /* Status change */
  public function supplier_change_status($id, $get_status) {
    if($get_status == 1) {
      $this->transfer_model->supplier_change_status($id, $get_status);  
      //redirect(WEB_URL.'transfer_crs/view_vehicle');          
    } else if($get_status == 0) {
      $this->transfer_model->supplier_change_status($id, $get_status);
      // redirect(WEB_URL.'transfer_crs/view_vehicle');
    } 
    // else {
    //     redirect(WEB_URL.'transfer_crs/view_vehicle');
    // }
  }

   public function rss_change_status($id, $get_status) {
    if($get_status == 1) {
      $this->transfer_model->rss_change_status($id, $get_status);  
      //redirect(WEB_URL.'transfer_crs/view_vehicle');          
    } else if($get_status == 0) {
      $this->transfer_model->rss_change_status($id, $get_status);
      // redirect(WEB_URL.'transfer_crs/view_vehicle');
    } 
    // else {
    //     redirect(WEB_URL.'transfer_crs/view_vehicle');
    // }
  }

  /* Update Supplier data */
  public function update_supplier_data()
  {
 
    $id= $this->input->post('hidenid');
    $data = array(
    'supplier_name' => $this->input->post('supplier_name'),
    'supplier_code' => $this->input->post('supplier_code')

    );
    $this->transfer_model->update_supplier_record($id,$data);
    $this->transfer_model->supplier_list_databyid($id);
        
    redirect("transfer_crs/supplier_list/");
  }


  /*test page Section started*/

  public function test_page_data(){
    $this->form_validation->set_rules('Air_code', 'Airport name', 'trim|required');
    

    if ($this->form_validation->run() == FALSE){
      //$this->load->view('transfer/add_equipment');
    }else{
      $post_data = $this->input->post();
      if (isset($post_data) && is_array($post_data))

    {
       // echo "<pre/>";print_r($_FILES);die; 
      $data['Air_code'] = $this->input->post('Air_code');
      $data['checkin'] = $this->input->post('checkin');
      $data['checkout'] = $this->input->post('checkout');
      $data['adult_no'] = $this->input->post('adult_no');
      $data['child_no'] = $this->input->post('child_no');
      $data['ages'] = $this->input->post('ages');

        $config['upload_path'] = './uploads/';
       $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['max_width'] = '10024';
        $config['max_height'] = '10768';
        $config['file_name'] = 'profile_pic_'.time();

        $this->load->library('upload', $config);

        
      if ( ! $this->upload->do_upload('images')){
          echo $this->upload->display_errors();die;
       $error = array('error' => $this->upload->display_errors());
      }else{

        // $data = array('upload_data' => $this->upload->data());

     //get the uploaded file name
      $data['images'] = WEB_FRONT_URL."admin-cpanel/uploads/".$this->upload->file_name;
       $images = (isset($_FILES['images']['name'])) ? $_FILES['images']['name'] : "";

        //store pic data to the db
        $this->admin_model->store_test($data);
      }
    }
    }
      
    $this->load->view('transfer/test_page');
  }

  /* show test_list data*/
  public function test_list(){
    $data['test_list'] =$test_list=$this->transfer_model->test_list_view_data()->result();
      $this->load->view('transfer/test_list', $data);
  }

  /* edit Test list data */
 public function edit_test_list($id){

    $id=$this->uri->segment(3); 
    $output=$this->transfer_model->test_list_databyid($id);
    $data['id']= $output['id'];
    $data['Air_code']= $output['Air_code'];
    $data['checkin']= $output['checkin'];
    $data['checkout']= $output['checkout'];
    $data['adult_no']= $output['adult_no'];
    $data['child_no']= $output['child_no'];
    $data['ages']= $output['ages'];
    $data['images']= $output['images'];
   // echo "<pre/>";print_r($data);die;
  
    $this->load->view('transfer/edit_test', $data);   
  }

  /* Update Test data */
  public function update_test_data()
  {
 
    $id= $this->input->post('hidenid');
    $data = array(
    'Air_code' => $this->input->post('Air_code'),
    'checkin' => $this->input->post('checkin'),
    'checkout' => $this->input->post('checkout'),
    'adult_no' => $this->input->post('adult_no'),
    'child_no' => $this->input->post('child_no'),
    'ages' => $this->input->post('ages')
);
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['max_width'] = '10024';
        $config['max_height'] = '10768';
        $config['file_name'] = 'profile_pic_'.time();

        $this->load->library('upload', $config);

        
      if ( ! $this->upload->do_upload('images')){
          echo $this->upload->display_errors();die;
       $error = array('error' => $this->upload->display_errors());
      }else{

        // $data = array('upload_data' => $this->upload->data());

     //get the uploaded file name
      $data['images'] = WEB_FRONT_URL."admin-cpanel/uploads/".$this->upload->file_name;
       $images = (isset($_FILES['images']['name'])) ? $_FILES['images']['name'] : "";

        //store pic data to the db
        //$this->admin_model->store_test($data);
      }
    //print_r($data);exit;
    $this->transfer_model->update_test_record($id,$data);
    $this->transfer_model->test_list_databyid($id);
        
    redirect("transfer_crs/test_list/");
  }


  /*Hotel page Section started*/

  public function hotel_page_data(){
    $this->form_validation->set_rules('hotel_code', 'Hotel name', 'trim|required');
    

    if ($this->form_validation->run() == FALSE){
      //$this->load->view('transfer/add_equipment');
    }else{
      $post_data = $this->input->post();
      if (isset($post_data) && is_array($post_data))

    {
       // echo "<pre/>";print_r($_FILES);die; 
      $data['hotel_code'] = $this->input->post('hotel_code');
      $data['hotel_checkin'] = $this->input->post('hotel_checkin');
      $data['hotel_checkout'] = $this->input->post('hotel_checkout');
      $data['adult_num'] = $this->input->post('adult_num');
      $data['child_num'] = $this->input->post('child_num');
      $data['age1'] = $this->input->post('age1');

        $config['upload_path'] = './uploads/';
       $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['max_width'] = '10024';
        $config['max_height'] = '10768';
        $config['file_name'] = 'profile_pic_'.time();

        $this->load->library('upload', $config);

        
      if ( ! $this->upload->do_upload('images1')){
          echo $this->upload->display_errors();die;
       $error = array('error' => $this->upload->display_errors());
      }else{

        // $data = array('upload_data' => $this->upload->data());

     //get the uploaded file name
      $data['images1'] = WEB_FRONT_URL."admin-cpanel/uploads/".$this->upload->file_name;
       $images = (isset($_FILES['images1']['name'])) ? $_FILES['images1']['name'] : "";

        //store pic data to the db
        $this->admin_model->store_hotel($data);
      }
    }
    }
      
    $this->load->view('transfer/hotel_page');
  }

  /* show hotel_list data*/
  public function hotel_list(){
    $data['hotel_list'] =$hotel_list=$this->transfer_model->hotel_list_view_data()->result();
      $this->load->view('transfer/hotel_list', $data);
  }

  public function hotel_delete()
  {
  
  $id=$this->uri->segment(3); 
  $this->transfer_model->delete_hotel_list($id);
   redirect("transfer_crs/hotel_list/");
  
  }

  /* Rss Section page */

 public function add_rss_page(){

  $this->form_validation->set_rules('rss_text', 'Rss txt', 'trim|required');
  $this->form_validation->set_rules('rss_des', 'Rss Descpriation', 'trim|required');
    

    if ($this->form_validation->run() == FALSE){
      //$this->load->view('transfer/add_equipment');
    }else{
      $post_data = $this->input->post();
      //print_r($post_data);exit;
      if (isset($post_data) && is_array($post_data)){
        
      $data['rss_text'] = $this->input->post('rss_text');
      $data['rss_des'] = $this->input->post('rss_des');
       $b2b = $this->input->post('b2b');
       $b2c = $this->input->post('b2c');

      if($b2b==1){
        $data['b2b'] = 1;
      } else {
        $data['b2b'] = 0;
      }

      if($b2c ==1){
        $data['b2c'] = 1;
      } else {
        $data['b2c'] = 0;
      }
     
    }
     $this->admin_model->store_rss_data($data);
    }
   $this->load->view('transfer/add_rss_page');
    }

    /* show RSS_list data*/
  public function rss_list(){
    $data['rss_list'] =$rss_list=$this->transfer_model->rss_list_view_data()->result();
      $this->load->view('transfer/rss_list_page', $data);
  }

  /* edit RSS list data */
 public function edit_rss_list($id){

    $id=$this->uri->segment(3); 
    $output=$this->transfer_model->rss_list_databyid($id);
    $data['id']= $output['id'];
    $data['rss_text']= $output['rss_text'];
    $data['rss_des']= $output['rss_des'];
     $data['b2b']= $output['b2b'];
    $data['b2c']= $output['b2c'];
   $this->load->view('transfer/edit_rss_page', $data);   
  }

  /* Update RSS data */
  public function update_rss_data()
  {
 
    $id= $this->input->post('hidenid');
    $data = array(
    'rss_text' => $this->input->post('rss_text'),
    'rss_des' => $this->input->post('rss_des'),
    'b2b' => $this->input->post('b2b'),
    'b2c' => $this->input->post('b2c')
    );
    $this->transfer_model->update_rss_record($id,$data);
    $this->transfer_model->rss_list_databyid($id);
        
    redirect("transfer_crs/rss_list/");
  }

  /* Delete RSS data */
  public function rss_delete()
  {
  
  $id=$this->uri->segment(3); 
  $this->transfer_model->delete_rss_list($id);
   redirect("transfer_crs/rss_list/");
  
  }

}
