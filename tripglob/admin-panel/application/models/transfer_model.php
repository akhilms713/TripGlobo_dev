<?php

class Transfer_model extends CI_Model {
  
  public function __construct() {
      parent::__construct();
    }

        public function vehicle_add($add_vehicle_data) {
        $this->db->insert("transfer_vehicles", $add_vehicle_data);
        return $this->db->insert_id();
    }


 public function update_transfer_details($transfer_details_id,$add_transfer_data) {

        $this->db->where('transfer_details_id', $transfer_details_id);
        $this->db->update('transfer_details_new', $add_transfer_data);
        return true;
    }
    
     public function vehicle_update($add_vehicle_data,$vid) {

        $this->db->where('vid', $vid);
        $this->db->update('transfer_vehicles', $add_vehicle_data);
        return true;
    }

        public function vehicle_view_data(){
         $query = $this->db->get('transfer_vehicles');
         foreach ($query->result() as $row)
        {
            $data[] =  $row;
        }
        return @$data;
    }

    // public function equipment_list(){
    //      $query = $this->db->get('add_equipment');
    //      foreach ($query->result() as $row)
    //     {
    //         $data[] =  $row;
    //     }
    //     return @$data;
    // }

    public function accom_add($add_accom_data) {
        $this->db->insert("accomdation_details", $add_accom_data);
        return $this->db->insert_id();
    }
     public function location_add($add_loc_data) {
     // echo "<pre>",print_r($add_loc_data);exit;
        $this->db->insert("transfer_location", $add_loc_data);
        return $this->db->insert_id();
    }

    public function accom_view_data(){
         $query = $this->db->get('accomdation_details');
         foreach ($query->result() as $row)
        {
            $data[] =  $row;
        }
        return @$data;
    }
 public function location_view_data(){
         $query = $this->db->get('transfer_location');
         foreach ($query->result() as $row)
        {
            $data[] =  $row;
        }
        return @$data;
    }
    public function vehicledata_basics($vid) {
      $this->db->where('vid', $vid);
      return $this->db->get('transfer_vehicles')->row();
    }

      public function transfer_data_basics($tid) {
      $this->db->where('transfer_details_id', $tid);
      return $this->db->get('transfer_details_new')->row();
    }
 public function transfer_data_price($tid) {
      $this->db->where('transfer_id', $tid);
      return $this->db->get('transfer_price_details')->result();
    }
    public function transfer_data_shuttle($tid) {
      $this->db->where('transfer_details_id', $tid);
      return $this->db->get('transfer_shuttle_details')->row();
    }


    public function add_transfer_details($add_transfer_data){
       $this->db->insert("transfer_details_new", $add_transfer_data);
        return $this->db->insert_id();
    }

    public function transfer_view_data($admin_id){

       /*$this->db->select('*');
      $this->db->where('supplier_id',$admin_id);
       $query = $this->db->get('transfer_details_new');

         foreach ($query->result() as $row)
        {
            $data[] =  $row;
        }
        return @$data;*/
        $this->db->select('*');
        $this->db->from('transfer_details_new');
       //$this->db->join('hcrs_regions r',"r.Id = transfer_details_new.region");
       //$this->db->join('hcrs_regions rt',"rt.Id = transfer_details_new.to_region");
    //$this->db->join('hcrs_subregions',"s.Id = transfer_details_new.subregion",LEFT);
   // $this->db->join('hcrs_subregions',"sr.Id = transfer_details_new.to_subregion",LEFT);
   //$this->db->join('hcrs_hotel_details',"hcrs_hotel_details.hotel_code = transfer_details_new.hotel_list",LEFT);
     //$this->db->join('hcrs_hotel_details',"hcrs_hotel_details.hotel_code = transfer_details_new.to_hotel",LEFT);
    

      $query = $this->db->get();
      return $query->result();
    }
      public function transfer_view_data_supplier($admin_id){

       $this->db->select('*');
      $this->db->where_not_in('supplier_id',$admin_id);
       $query = $this->db->get('transfer_details');
       // print_r($this->db->last_query());exit;
      
        foreach ($query->result() as $row)
        {
            $data[] =  $row;
        }
        return @$data;
    }

    public function get_airports($term,$city){
      $this->db->select('airport_id,airport_name,airport_code');
        $this->db->where('airport_city', $city);
     $this->db->like('airport_city', $term, 'both');
    // $this->db->or_like('airport_city', $term, 'both');
     //$this->db->or_like('country',$term, 'both');
     $query = $this->db->get('iata_airport_list');
    // echo $this->db->last_query();exit;
         foreach ($query->result() as $row)
        {
            $data[] =  $row;
        }
        return @$data;
  
    }

    public function get_city_by_citycode($citycode){
        $this->db->select('*');
        $this->db->from('api_hotel_cities');
        $this->db->like('api_hotel_cities.city_code',$citycode);
      
        $query = $this->db->get();
        return $query->row();        
    }

    public function getGtaHotelsByCityName($cityname){
      $this->db->select('*');
      $this->db->from('gta_hotels');
      $this->db->like('CityName',$cityname);
      
      $query = $this->db->get();
      return $query->result();
    }

     public function accom_data_basics($accomId) {
      $this->db->where('acid', $accomId);
      return $this->db->get('accomdation_details')->row();
    }
    public function location_data_basics($locId) {
      $this->db->where('location_id', $locId);
      return $this->db->get('transfer_location')->row();
    }

     public function transfer_details($transfer_details_id) {
      $this->db->where('transfer_details_id', $transfer_details_id);
      return $this->db->get('transfer_details_new')->row();
    }

      public function accom_update($add_accom_data,$accid) {

        $this->db->where('acid', $accid);
        $this->db->update('accomdation_details', $add_accom_data);
        return true;
    }

      public function location_update($add_loc_data,$locid) {

        $this->db->where('location_id',$locid);
        $this->db->update('transfer_location', $add_loc_data);
        return true;
    }

        public function transferAcc_change_status($accId, $get_status) {
        $this->db->where('acid', $accId);
        $data = array('status'=>$get_status);
        $this->db->update('accomdation_details', $data);
        return true;
    }

            public function delete_transferAcc($accId) {
        $data = array('acid'=> $accId);
        $this->db->delete('accomdation_details', $data);
        $this->db->affected_rows();
        return true;
    }
        public function delete_location($locId) {
        $data = array('location_id'=> $locId);
        $this->db->delete('transfer_location', $data);
      //  print_r($this->db->last_query());exit;
        $this->db->affected_rows();
        return true;
    }

    public function vehicle_change_status($vid, $get_status) {
        $this->db->where('vid', $vid);
        $data = array('status'=>$get_status);
        $this->db->update('transfer_vehicles', $data);
        return true;
    }

     public function equipment_change_status($id, $get_status) {
        $this->db->where('id', $id);
        $data = array('status'=>$get_status);
        $this->db->update('add_equipment', $data);
        return true;
    }

    public function transfer_change_status($transfer_details_id, $get_status) {
        $this->db->where('transfer_details_id', $transfer_details_id);
        $data = array('status'=>$get_status);
        $this->db->update('transfer_details_new', $data);
        return true;
    }
    public function transfer_topdeals_change_status($transfer_details_id, $get_status) {
        $this->db->where('transfer_details_id', $transfer_details_id);
        $data = array('status'=>$get_status);
        $this->db->update('top_deals', $data);
        return true;
    }

     public function delete_transfer($transfer_details_id) {
        $data = array('transfer_details_id'=> $transfer_details_id);
        $this->db->delete('transfer_details_new', $data);
        $this->db->affected_rows();
        return true;
    }

            public function delete_vehicle($vid) {
        $data = array('vid'=> $vid);
        $this->db->delete('transfer_vehicles', $data);
        $this->db->affected_rows();
        return true;
    }

      public function get_CRS_data ($request, $api_id, $session_data )
 {
     $result = FALSE ; 

     $postdata = json_decode(base64_decode($request));

 //echo "<pre>",print_r($postdata);exit;
   

     $adult_count = $postdata->adult_count;
     $child_count = $postdata->child_count;
     $infant_count = $postdata->infant_count;

     $city = $postdata->city;
     $departure_date = $postdata->departure_date;
     $arrival_date = $postdata->arrival_date;
     $location = $postdata->location;
     $airport = $postdata->airport;
     $trip_type = $postdata->trip_type;
     $totl_pax = ($postdata->adult_count + $postdata->child_count + $postdata->infant_count);
    
      //echo "<pre>", print_r($postdata) ;exit ;
      if($postdata->trip_type == 'FROM Airport'){
        $type = 'single_from_airport';
      }
      else if($postdata->trip_type == 'To Airport'){
       $type = 'single_to_airport'; 
      }
       else if($postdata->trip_type == 'Return'){
       $type = 'return'; 
      }
     $select =   array(
                'transfer_details.booking_status',
                'transfer_details.transfer_details_id',
                'transfer_details.transfer_type',
                'transfer_details.airport',
                'transfer_details.airport_code',
                'transfer_details.travel_description',
                'transfer_details.vehicle',
                'transfer_details.min_adult',
                'transfer_details.min_child',
                'transfer_details.min_infant',
                'transfer_details.max_adult',
                'transfer_details.max_child',
                'transfer_details.max_infant',
                'transfer_details.min_infant_age',
                'transfer_details.min_child_age',
                'transfer_details.min_adult_age',
                'transfer_details.max_child_age',
                'transfer_details.max_infant_age',
                'transfer_details.max_adult_age',
                'transfer_details.destination_country',
                'transfer_details.destination_place',
                'transfer_details.destination_city',
                'transfer_details.destination_type',
                'transfer_details.destination_address',
                'transfer_details.vehicle_type',
                'transfer_details.vmin_pax',
                'transfer_details.vmax_pax',
                'transfer_details.vmin_suitcase',
                'transfer_details.vmax_suitcase',
                'transfer_details.vmin_available',
                'transfer_details.vmax_available',
                'transfer_details.image',
                'transfer_details.adult_price',
                'transfer_details.child_price',
                'transfer_details.infant_price',
                'transfer_details.cancel_day',
                'transfer_details.cancellation_percentage',
                'transfer_details.transfer_title',
                'transfer_details.vehicle_name'
                );

       $this->db->select($select);
    $this->db->where('transfer_details.airport =',trim($postdata->airport));
    $this->db->where('transfer_details.destination_place =',trim($postdata->location));
    $this->db->where('transfer_details.vmax_pax >=',trim($totl_pax));
    $this->db->where('transfer_details.status' , '1');
    if($type != ""){
        $this->db->where('transfer_details.transfer_type' , $type);
    }
    $q = $this->db->group_by('transfer_details.transfer_details_id')->get('transfer_details');

//echo  $this->db->last_query();exit;
//echo $q->num_rows();exit;
    if($q->num_rows() > 0 )
    {
        $result = $q->result();
       $this->save_Crs_result($result ,$api_id, $session_data,$adult_count,$child_count,$infant_count,$request);
      
    }

    return $result ;
 }

 public function save_Crs_result($res, $api_id, $session_id,$total_adult,$total_child,$infant_count,$request)
    { 
           
        $this->db->where('session_id', $session_id);
        $this->db->delete('tf_transfer_details');
        $postdata = json_decode(base64_decode($request));

        foreach ($res as $key => $val) 
        {   
            $data['session_id'] = $session_id;
            $data['booking_status'] = $val->booking_status;
            $data['transfer_type'] = $val->transfer_type;
            $data['airport'] = $val->airport;
            $data['airport_code'] = $val->airport_code;
            $data['destination'] = $val->destination_place;
            $data['travel_description'] = $val->travel_description;
            $data['vehicle'] = $val->vehicle;
            $data['destination_country'] =$val->destination_country;
            $data['destination_city'] = $val->destination_city;
            $data['destination_type'] = $val->destination_type;
            $data['destination_address'] = $val->destination_address;
             $data['transfer_title'] = $val->transfer_title;

            if($postdata->adult_count != 0 || $postdata->adult_count != "0"){
                $adult_price = ($val->adult_price * $postdata->adult_count);
            } 
            else{
                 $adult_price = 0;
            }

            if($postdata->child_count != 0 || $postdata->child_count != "0"){
                $child_price = ($val->child_price * $postdata->child_count);
            } 
            else{
                 $child_price = 0;
            }

            if($postdata->infant_count != 0 || $postdata->infant_count != "0"){
                $infant_price = ($val->infant_price * $postdata->infant_count);
            } 
            else{
                 $infant_price = 0;
            }


            
             $org_amt = ($adult_price + $child_price + $infant_price);
             $TotalPrice_v     = $this->general_model->convert_api_to_base_currecy_with_markup($org_amt,BASE_CURRENCY,$api_id);
            
            
           $data['amount'] = $TotalPrice_v['TotalPrice'];
           $data['net_rate'] = $TotalPrice_v['Netrate'];
           $data['admin_markup'] = $TotalPrice_v['Admin_Markup'];
           $data['admin_baseprice'] = $TotalPrice_v['Admin_BasePrice'];
           $data['my_markup'] = $TotalPrice_v['My_Markup'];
           $data['api_id'] = $api_id;
           $data['discount'] = 0;
           $data['status'] = 'Available' ;
           $data['search_date'] = date('Y-m-d H:i:s') ; 
           $data['departure_date'] = $postdata->departure_date;
           $data['arrival_date'] = $postdata->arrival_date;
           $data['vehicle_type'] = $val->vehicle_type ;
           $data['vehicle_name'] = $val->vehicle_name;
           $data["image"] = $val->image;
           $data["search_adult"] = $postdata->adult_count;
           $data["search_child"] = $postdata->child_count;
           $data["search_infant"] = $postdata->infant_count;;
           $data["max_adult"] = $val->max_adult;
           $data["max_child"] = $val->max_child;
           $data["max_infant"] = $val->max_infant;
           $data["min_adult"] = $val->min_adult;
           $data["min_child"] = $val->min_child;
           $data["min_infant"] = $val->min_infant;
           $data["min_infant_age"] = $val->min_infant_age;
           $data["min_child_age"] = $val->min_child_age;
           $data["min_adult_age"] = $val->min_adult_age;
           $data["max_child_age"] = $val->max_child_age;
           $data["max_infant_age"] = $val->max_infant_age;
           $data["max_adult_age"] = $val->max_adult_age;

           $data["vmin_pax"] = $val->vmin_pax;
           $data["vmax_pax"] = $val->vmax_pax;
           $data["vmin_suitcase"] = $val->vmin_suitcase;
           $data["vmax_suitcase"] = $val->vmax_suitcase;
           $data["vmin_available"] = $val->vmin_available;
           $data["vmax_available"] = $val->vmax_available;

            $data["adult_price"] = $val->adult_price;
           $data["child_price"] = $val->child_price;
           $data["infant_price"] = $val->infant_price;
           $data["cancel_day"] = $val->cancel_day;
           $data["cancellation_percentage"] = $val->cancellation_percentage;
           $this->db->insert('tf_transfer_details',$data);
           $insert_id = $this->db->insert_id() ;
        }

        return TRUE ;

    }

  public function get_cities_country($country){ 
    $this->db->select(array('city_code','destination_name','country_name'));
    $this->db->where('country_code',$country);
    $this->db->from('api_hotel_cities');
    $query = $this->db->get();
   // print_r($this->db->last_query());exit;
    return $query->result();
  }
 public function get_country($country){ 
    //$this->db->select(array('city_code','destination_name','country_name'));
  $this->db->select('name');
    $this->db->where('country_id',$country);
    $this->db->from('hcrs_country');
    $query = $this->db->get();
   // print_r($this->db->last_query());exit;
    return $query->result();
  }
 public function get_city($city){ 
    //$this->db->select(array('city_code','destination_name','country_name'));
  $this->db->select('city_name');
    $this->db->where('id',$city);
    $this->db->from('hcrs_city');
    $query = $this->db->get();
   // print_r($this->db->last_query());exit;
    return $query->result();
  }

  public function fetch_airline_currency(){
      $select = "SELECT currency_code FROM currency_list order by currency_code ASC";
        
      $query=$this->db->query($select);
      $this->load->database('default', TRUE); 
      if ($query->num_rows() > 0)
      {
        return $query->result();
      } else {
        return false; 
      }
  }

    function getTransferCountries(){
    $this->db->select("*");
    $this->db->from("hcrs_country");
    $this->db->group_by('country_id');
    $this->db->order_by('name', 'asc');
    return $this->db->get();
  }

     function getTransferCities($country_code){
        $this->db->select('*');
        $this->db->from('hcrs_city');
        $this->db->where('country_id', $country_code);
        $this->db->group_by('city_code');
        $this->db->order_by('city_code');
        return $this->db->get();
    }
    function getTransferAllCities(){
        $this->db->select('*');
        $this->db->from('hcrs_city');
        $this->db->group_by('city_code');
        $this->db->order_by('city_code');
        return $this->db->get();
    }

    function getTransferRegion($city){  
      $this->db->select('*');
        $this->db->from('hcrs_regions');
        $this->db->where('city', $city);
        $this->db->group_by('region');
        $this->db->order_by('region');
        return $this->db->get();
    }

    function getTransferSubregion($region){
      // print_r($region);exit;
        $this->db->select('*');
        $this->db->from('hcrs_subregions');
        $this->db->where('region', $region);
        $this->db->group_by('subregion');
        $this->db->order_by('subregion');
        return $this->db->get();
    }
    public function hcrs_markets()
  {
   $this->db->select('*');
        $this->db->from('hcrs_market');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    
  }
  //9dec
   // function getHotelDetails($region){
   //      $this->db->select('hotel_code,hotel_name');
   //      $this->db->from('hcrs_hotel_details');
   //      $this->db->where_in('region', $region);
   //      return $this->db->get();
   //  }

     function getHotelDetails($region){
        $this->db->select('hotel_list.hotel_code,hotel_list.hotel_name');
        $this->db->join('hcrs_regions','hcrs_regions.city_name = hotel_list.city');

        $this->db->where_in('hcrs_regions.region', $region);
        $this->db->from('hotel_list');
        
        return  $this->db->get();
         // echo $this->db->last_query();


    }


    //  function get_hotels_subregion($subregion){


    //     $this->db->select('hotel_code,hotel_name');
    //     $this->db->from('hcrs_hotel_details');
    //     $this->db->where('subregion', $subregion);
    //     return $this->db->get();
    // }

     function get_hotels_subregion($subregion){
     
     $this->db->select('hotel_list.hotel_code,hotel_list.hotel_name');
        $this->db->join('hcrs_regions','hcrs_regions.city_name = hotel_list.city','left');
        $this->db->join('hcrs_subregions','hcrs_subregions.region = hcrs_regions.id','left');

        $this->db->where_in('hcrs_subregions.id', $subregion);
        $this->db->from('hotel_list');
        
         return $this->db->get();
         // echo $this->db->last_query();

        
    }

    public function get_accomadations($term,$region){
      $this->db->select('hotel_code,hotel_name');
      $this->db->where('city_details_id',$region);
     $this->db->like('hotel_name', $term, 'both');
     $this->db->or_like('hotel_code',$term, 'both');
     $query = $this->db->get('hcrs_hotel_details');
     //echo $this->db->last_query();exit;
         foreach ($query->result() as $row)
        {
            $data[] =  $row;
        }
        return @$data;
    }
     public function get_regions($term,$city){
      $this->db->select('Id,region');
      $this->db->where('city',$city);
     $this->db->like('region', $term, 'both');
    // $this->db->or_like('hotel_code',$term, 'both');
     $query = $this->db->get('hcrs_regions');
     //echo $this->db->last_query();exit;
         foreach ($query->result() as $row)
        {
            $data[] =  $row;
        }
        return @$data;
    }
     public function get_subregions($term,$region){
      $this->db->select('Id,subregion');
      $this->db->where('region',$region);
     $this->db->like('subregion', $term, 'both');
    // $this->db->or_like('hotel_code',$term, 'both');
     $query = $this->db->get('hcrs_subregions');
     //echo $this->db->last_query();exit;
         foreach ($query->result() as $row)
        {
            $data[] =  $row;
        }
        return @$data;
    }
     public function get_transfer_pickup($trans_id) {
        $this->db->where('transfer_id', $trans_id);
         $query = $this->db->get('transfer_pickup_vehicle');
         foreach ($query->result() as $row)
        {
            $data[] =  $row;
        }
        return @$data;
    }
     public function save_transfer_pickup($add_pickup_data) {
        $this->db->insert("transfer_pickup_vehicle", $add_pickup_data);
        return $this->db->insert_id();
    }
    public function delete_pickup($pickup_id)
    {

       $status = $this->db->where('id' ,$pickup_id)
                 ->delete("transfer_pickup_vehicle");
         if($status)
         {
            return TRUE ;
         } 
    }
      public function master_module_view_data(){
      $this->db->select('*');
      $this->db->from('transfer_master_module');
      $query = $this->db->get();
      return $query->result();
    }
      public function save_master_transfer($add_master_data) {
        //print_r($add_master_data);exit;
        $this->db->insert("transfer_master_module", $add_master_data);
        return $this->db->insert_id();
    }
    public function delete_transfer_master($id) {
        $data = array('id'=> $id);
        $this->db->delete('transfer_master_module', $data);
        $this->db->affected_rows();
        return true;
    }
     public function master_transfer_status($transfer_details_id, $get_status) {
        $this->db->where('id', $transfer_details_id);
        $data = array('status'=>$get_status);
        $this->db->update('transfer_master_module', $data);
        return true;
    }

      public function get_master_module($country,$city,$transfer_type){
      $this->db->select('*');
      $this->db->from('transfer_master_module');
      $this->db->where('country',$country);
      $this->db->where('city',$city);
      $this->db->where('transfer_type',$transfer_type);
      $query = $this->db->get();
      return $query->result();
    }
     function region(){
        $this->db->select('*');
        $this->db->from('hcrs_regions');  
        $this->db->group_by('region');
        $this->db->order_by('region');      
        return $this->db->get();
    }
     function subregion(){
        $this->db->select('*');
        $this->db->from('hcrs_subregions');
        $this->db->group_by('subregion');
        $this->db->order_by('subregion');
        return $this->db->get();
    }
    function regionById($region){
        $this->db->select('region');
        $this->db->from('hcrs_regions');  
        $this->db->where('Id',$region);
        $this->db->order_by('region');      
        return $this->db->get();
    }
     function subregionById($subregion){
        $this->db->select('subregion');
        $this->db->from('hcrs_subregions');
        $this->db->where('Id',$subregion);
        $this->db->order_by('subregion');
        return $this->db->get();
    }
     function hotel(){
        $this->db->select('hotel_code,hotel_name');
        $this->db->from('hcrs_hotel_details');       
        return $this->db->get();
    }
    function  selectVehicleType($type){  
      $this->db->select('*');
        $this->db->from('transfer_vehicles');
        $this->db->where('transfer_type', $type);
       // $this->db->group_by('region');
       // $this->db->order_by('region');
        return $this->db->get();
    }
   function add_transfer_shuttle_details($data,$tid){
    //print_r($hotel_code);exit;
    $this->db->select('*')
    ->where('transfer_details_id',$tid);
    $this->db->from('transfer_shuttle_details');
    $query = $this->db->get();
    if ( $query->num_rows > 0 ) 
    {
      $result =  $query->row(); 
      $where = "tid = ".$result->tid;
      if ($this->db->update('transfer_shuttle_details', $data, $where)) {
        return true;
      } else {
        return false;
      }
    }
    else
    {
      $data['transfer_details_id']=$tid;
      if($this->db->insert('transfer_shuttle_details', $data)){
      return true;
    }else{
      return false;
    }
    
        
    }
   }
       function getshuttledetails($tid){  
      $this->db->select('*');
        $this->db->from('transfer_shuttle_details');
        $this->db->where('transfer_details_id', $tid);
        return $this->db->get();
    }
    function get_hotels_subregions($subregion,$to_subregion){
        $this->db->select('hotel_code,hotel_name');
        $this->db->from('hcrs_hotel_details');

        $this->db->where('subregion', $subregion);
        $this->db->or_where('subregion', $to_subregion);
        return $this->db->get();
    }
    function get_hotels_region($region,$to_region){
        $this->db->select('hotel_code,hotel_name');
        $this->db->from('hcrs_hotel_details');
        $this->db->where('region', $region);
        $this->db->or_where('region',$to_region);
        return $this->db->get();
    }
    public function get_agency_list($country,$user_type){
    
    $this->db->select('user_login_details.*,user_details.*,user_type.user_type_name,user_accounts.*');
    $this->db->where_in('user_login_details.user_type_id', $user_type);
    $this->db->where_in('address_details.country_code', $country);
    $this->db->join('user_details', 'user_details.user_id=user_login_details.user_id', 'left');
    $this->db->join('user_type', 'user_type.user_type_id=user_login_details.user_type_id', 'left');
    $this->db->join('user_accounts', 'user_accounts.user_id=user_login_details.user_id', 'left');
    $this->db->join('address_details', 'address_details.address_details_id=user_details.address_details_id', 'left');
    $this->db->from('user_login_details');
    
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
       
      return $query->result();
    }else{
      return false;
    }
  }
   public function fetchcountryById($country){
         $this->db->where('country_id', $country);
        $this->db->select('*')->from('hcrs_country');
        $query = $this->db->get();
        if ( $query->num_rows > 0 ) 
        {
            return $query->row();    
        }
        else
        {
            return '';  
        }
    }
     public function fetchmarket_byId($market){
         $this->db->where('id', $market);
        $this->db->select('*')->from('hcrs_market');
        $query = $this->db->get();
        if ( $query->num_rows > 0 ) 
        {
            return $query->row();    
        }
        else
        {
            return '';  
        }
    }
    function airport_list_data(){
        $this->db->select('*');
        $this->db->from('iata_airport_list');
         return $this->db->get();
    }
 function airport_list_view_data(){
        $this->db->select('*');
        $this->db->from('terminal_airport_list');
        $this->db->group_by('airport_code');
         return $this->db->get();
    }
    /* Equipment list */
    function equipment_list_view_data(){
        $this->db->select('*');
        $this->db->from('add_equipment');
        //$this->db->group_by('airport_code');
         return $this->db->get();
    }

    function get_airport_code($val){

        $this->db->select('airport_code');
        $this->db->from('iata_airport_list');
        $this->db->where('airport_name', $val);
         return $this->db->get();
    }
      public function save_airport_list($add_airport_data) {
       //print_r($add_airport_data);exit;
        $this->db->insert("terminal_airport_list", $add_airport_data);
        return $this->db->insert_id();
    }
     public function airport_list_databyid($airport_code) {
       // print_r($add_airport_data);exit;
       $this->db->select('*');
        $this->db->from('terminal_airport_list');
        $this->db->where('airport_code', $airport_code);
         return $this->db->get();
    }

    /* equipment_list_databyid*/
    
     public function equipment_list_databyid($id) {

     $query =  $this->db->get_where('add_equipment',array('id'=>$id));
   return $query->row_array();
       //print_r($add_airport_data);exit;
       // $this->db->select('*');
       //  $this->db->from('add_equipment');
       //  $this->db->where('id', $id);
       //   return $this->db->get();
    }
    public function selectairportName($airport_code){
      $this->db->select('airport_name');
        $this->db->from('iata_airport_list');
        $this->db->where('airport_code', $airport_code);
         return $this->db->get();
    }
   

    //  public function update_equipment_name($airport_code,$airport_name) {
    //     $data['airport_name']=$airport_name;
    //     $this->db->where('airport_code', $airport_code);
    //     $this->db->update('iata_airport_list', $data);
    //     return true;
    // }


    public function updaterecord($id)
  {
        $euipment_name = $this->input->post('euipment_name');
        $price = $this->input->post('price');
          
          $data = array(
                       
            'euipment_name'=>$euipment_name,
            'price'=>$price,
            
            );
    $this->db->where('id', $id);
    $this->db->update('add_equipment', $data); 
  }

  

        public function deletAirportList($airport_code) {
        $data = array('airport_code'=> $airport_code);
        $this->db->delete('terminal_airport_list', $data);
        $this->db->affected_rows();
        return true;
    }
     public function get_airport_details($city){
      $this->db->select('*');
        $this->db->from('hcrs_city');
        $this->db->where('id', $city);
$query=$this->db->get();
$res=$query->result();

      $this->db->select('airport_id,airport_name,airport_code');
        //$this->db->where('airport_city', $city);
     $this->db->like('airport_city', $res[0]->city_name);
    // $this->db->or_like('airport_city', $term, 'both');
     //$this->db->or_like('country',$term, 'both');
     $query = $this->db->get('iata_airport_list');
    //echo $this->db->last_query();exit;
         return $query;
  
    }
     public function get_airports_info($airport_code){
      $this->db->select('airport_id,airport_name,airport_code');
        $this->db->where('airport_code', $airport_code);
     $query = $this->db->get('iata_airport_list');
 
         foreach ($query->result() as $row)
        {
            $data[] =  $row;
        }
        return @$data;

}
      public function delete_price_details($accId) {
        $data = array('transfer_id'=> $accId);
        $this->db->delete('transfer_price_details', $data);
        $this->db->affected_rows();
        return true;
    }
  public function add_transfer_price_details($add_price_data) {
        $this->db->insert("transfer_price_details", $add_price_data);
        return $this->db->insert_id();
    }

   public function getTransferZonelist($country,$city,$region,$subregion){
      $this->db->select('zone_no,zone_name');
      $this->db->where('country',$country);
      $this->db->where('city',$city);
      $this->db->where('region',$region);
      $this->db->where('sub_region', $subregion);

     $query = $this->db->get('city_tour_zone');
     // echo $this->db->last_query();exit;
         foreach ($query->result() as $row)
        {
            $data[] =  $row;
        }
        return @$data;
    }

  public function get_zone_list(){
    $query = $this->db->get('city_tour_zone');
     // echo $this->db->last_query();exit;
         foreach ($query->result() as $row)
        {
            $data[] =  $row;
        }
        return @$data;
  }

  public function get_transfer_details_byparam($country,$city,$transfer_direction,$transfer_type,$status){
        $this->db->where('country_code', $country);
        $this->db->where('city_code', $city);
        $this->db->where('transfer_direction', $transfer_direction);
        $this->db->where('transfer_type', $transfer_type);
        $this->db->where('status', $status);
       return $this->db->get('transfer_details_new')->result();
       // echo $this->db->last_query();

  }

      public function get_transfer_images($transfer_details_id){
      $this->db->select('image');
      $this->db->where('transfer_details_id', $transfer_details_id);
      return $this->db->get('transfer_details_new')->row();
      // echo $this->db->last_query();
    }

    public function get_hotels_list($city){
    $this->db->select('*');
    $this->db->from('hotel_list');
    $this->db->where('city',$city);
    $query = $this->db->get();
    return $query->result();
    // echo $this->db->last_query();
  }

  /*---Supplier Section Start----*/

  /* show supplier_list data */
  public function supplier_list_view_data(){
      $this->db->select('*');
      $this->db->from('add_supplier');
      //$this->db->group_by('airport_code');
       return $this->db->get();
  }

  /* edit_equipment_list */
  public function supplier_list_databyid($id) {

   $query =  $this->db->get_where('add_supplier',array('id'=>$id));
   return $query->row_array();
  }

  /* Status change */
  public function supplier_change_status($id, $get_status) {
    $this->db->where('id', $id);
    $data = array('status'=>$get_status);
    $this->db->update('add_supplier', $data);
    return true;
  }

  public function rss_change_status($id, $get_status) {
    $this->db->where('id', $id);
    $data = array('status'=>$get_status);
    $this->db->update('rss_table', $data);
    return true;
  }

  /* Update Supplier data */
  public function update_supplier_record($id,$data)
  {
    
    $this->db->where('id', $id);
    $this->db->update('add_supplier',$data);
    return true;
  }

  /*---TEST Section Start----*/

  /* show test_list data */
  public function test_list_view_data(){
      $this->db->select('*');
      $this->db->from('test_data');
      //$this->db->group_by('airport_code');
       return $this->db->get();
  }


  /* Edit Test_list */
  public function test_list_databyid($id) {

   $query =  $this->db->get_where('test_data',array('id'=>$id));
   return $query->row_array();
  }

  /* Update Test data */
  public function update_test_record($id,$data)
  {
    
    $this->db->where('id', $id);
    $this->db->update('test_data',$data);
    return true;
  }


  /* show test_list data */
  public function hotel_list_view_data(){
      $this->db->select('*');
      $this->db->from('hotel_data');
      //$this->db->group_by('airport_code');
       return $this->db->get();
  }

  public function delete_hotel_list($id)
  {
    $this->db->delete('hotel_data', array('id' => $id)); 
  } 

  /*Rss Section start*/

  /* show Rss_list data */
  public function rss_list_view_data(){
      $this->db->select('*');
      $this->db->from('rss_table');
      //$this->db->group_by('airport_code');
       return $this->db->get();
  }
    
   /* Edit RSS_list */
  public function rss_list_databyid($id) {

   $query =  $this->db->get_where('rss_table',array('id'=>$id));
   return $query->row_array();
  } 
  

  /* Update Rss data */
  public function update_rss_record($id,$data)
  {
    
    $this->db->where('id', $id);
    $this->db->update('rss_table',$data);
    return true;
  }

  /* Update Rss data */
  public function delete_rss_list($id)
  {
    $this->db->delete('rss_table', array('id' => $id)); 
  }
    
}
