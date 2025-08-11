<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Special_trip extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('reports_model');
		$this->load->model('admin_model');
		$this->load->helper('custom/app_share_helper');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      	$this->output->set_header("Pragma: no-cache");
	    $this->load->library('form_validation');
	    $this->load->model('email_model'); 
	    $this->load->model('user_model');
	     $this->load->model('specialtrip_model'); 
	    
	}
        private function check_isvalidated()
	{
		if(!$this->session->userdata('admin_logged_in') || $this->session->userdata('admin_id')!= ADMIN_ID )
		{
			if ($this->session->userdata('admin_logged_in')) {
		 	$controller_name = $this->router->fetch_class();
			 $function_name = $this->router->fetch_method();
             $this->load->model('Privilege_Model');
            $sub_admin_id = $this->session->userdata('admin_id');
           if(!$this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id,$controller_name,$function_name))
		   {			
    	 	  	access_denied('error');
			}
			
       	 }
	 else
       	 {
       	 	redirect('login','refresh');
       	 }
		}
		
    }
	
    function add_special_trip()
    {
        $execute_query = $this->db->query('select * from airline_list ORDER BY airline_name ASC');
		$data['airline_list'] =$execute_query->result_array();
		if($this->input->post('moduleName'))
		{
      $image_name = '';
      if(!empty($_FILES['image']['name']))
      { 
        if(is_uploaded_file($_FILES['image']['tmp_name'])) 
        {
          $sourcePath = $_FILES['image']['tmp_name'];
          $img_Name=time().$_FILES['image']['name'];
          $targetPath = "uploads/special_trip/".$img_Name;
          if(move_uploaded_file($sourcePath,$targetPath)){
            $image_name = $img_Name;
          }
        }       
      }
		    $datas=array(
		        'moduleName'=>$this->input->post('moduleName'),
		        'from_location'=>json_encode($this->input->post('from')),
		        'to_location'=>json_encode($this->input->post('to')),
		        'stops'=>$this->input->post('stops'),
		        'departure_date'=>json_encode($this->input->post('departure_date')),
		        'arrival_date'=>json_encode($this->input->post('arrival_date')),
		        'start_time'=>json_encode($this->input->post('start_time')),
		        'end_time'=>json_encode($this->input->post('end_time')),
		        'airline_id'=>json_encode($this->input->post('airline')),
		        'amount'=>$this->input->post('amount'),
            'user_id'=>$this->session->userdata('admin_id'),
            'flight_image'=>$image_name,
		        );
		 
		 $addData = $this->specialtrip_model->addSpecialTrip($datas);
		 $this->session->set_flashdata('success', 'Added successfully');
		redirect(WEB_URL.'special_trip/add_special_trip/','refresh');
		      
		}
     	$this->load->view('special_trip/add_special_trip',$data);
    }
    
     function month_low_fare()
    {
        $execute_query = $this->db->query('select * from airline_list');
		$data['airline_list'] =$execute_query->result_array();
		if($this->input->post('moduleName'))
		{
		    $datas=array(
		        'moduleName'=>$this->input->post('moduleName'),
		        'from_location'=>json_encode($this->input->post('from')),
		        'to_location'=>json_encode($this->input->post('to')),
		        'stops'=>$this->input->post('stops'),
		        'departure_date'=>json_encode($this->input->post('departure_date')),
		        'arrival_date'=>json_encode($this->input->post('arrival_date')),
		        'start_time'=>json_encode($this->input->post('start_time')),
		        'end_time'=>json_encode($this->input->post('end_time')),
		        'airline_id'=>json_encode($this->input->post('airline')),
		        'amount'=>$this->input->post('amount'),
		        );
		 //print_r($datas);exit;
		 $addData = $this->specialtrip_model->addSpecialTrip($datas);
		 $this->session->set_flashdata('success', 'Added successfully');
		redirect(WEB_URL.'special_trip/add_special_trip/','refresh');
		      
		}
     	$this->load->view('special_trip/add_special_trip',$data);
    }
    function all_special_trip()
    {
        $data['special_trip']= $this->specialtrip_model->get_specialFlight_list();
        foreach($data['special_trip'] as $stval)
        {
            $arr=json_decode($stval['airline_id']);
            $airIds = [];
        foreach ($arr as $key => $value) {
          if ($value != 'Select Airline'&& trim($value) !='') {
            $airIds[] = $value;
          }
        }
        if(!empty($airIds)){
         // debug($airIds);

         $airIds=rtrim(implode(",",$airIds),',');
        // debug($airIds);
            $execute_query = $this->db->query("select airline_name from airline_list where airline_list_id in ($airIds)");
		    $data['airline_name'][]=$execute_query->result_array();
        }
        // debug($data['airline_name']);
		      //print_r($data['airline_name']);exit;
        //   $data['from_loc']= json_decode($stval['from_location']);
        //   $data['to_loc']= json_decode($stval['to_location']);
        //   $data['departure_date']= json_decode($stval['departure_date']);
        //   $data['arrival_date']= json_decode($stval['arrival_date']);
        //   $data['start_time']= json_decode($stval['start_time']);
        //   $data['end_time']= json_decode($stval['end_time']);
        
        }
        // echo "<pre>"; print_r($data);die;
    	$this->load->view('special_trip/all_special_trip',$data);
    }
    function specialTrip_delete($id)
    {
      //  $tripid = $this->uri->segment(3);
       $tripid=json_decode(base64_decode($id));
        $this->specialtrip_model->delSecialTrip($tripid);
        $this->session->set_flashdata('success', 'Delete successfully');
    	redirect(WEB_URL.'special_trip/all_special_trip/','refresh');
    }
    function special_flightTrip_edit($ftripId)
    {
         $ftripIds=json_decode(base64_decode($ftripId));
          $datas['flight_details']= $this->specialtrip_model->getFlightTrip($ftripIds);
          $execute_query = $this->db->query('select * from airline_list');
	      $datas['airline_list'] =$execute_query->result_array();
        $arr = json_decode($datas['flight_details']->airline_id);
        $airlineId = [];
        foreach ($arr as $key => $value) {
          if ($value != 'Select Airline') {
            $airlineId[] = $value;
          }
        }  
        if (!empty($airlineId)) {
          
	       $airlineId=implode(",",$airlineId);
	     // print_r($airlineId);die;
	       if(isset($airlineId))
	       {
            $execute_query = $this->db->query("select airline_name from airline_list where airline_list_id in ($airlineId)");
		    $datas['airlineName']=$execute_query->result();
		    //print_r($data['airline_name'][0]->airline_name);
		  
	       }
        }
         //debug($datas);exit(); 
	      
          $this->load->view('special_trip/flight_trip_edit',$datas);
    }
     function update_flight_trip($flightId)
     {
      // debug($this->session->userdata);exit;
      // debug($_POST);
      $image_name = '';
      if(!empty($_FILES['image']['name']))
      { 
        if(is_uploaded_file($_FILES['image']['tmp_name'])) 
        {
          $sourcePath = $_FILES['image']['tmp_name'];
          $img_Name=time().$_FILES['image']['name'];
          $targetPath = "uploads/special_trip/".$img_Name;
          if(move_uploaded_file($sourcePath,$targetPath)){
            $image_name = $img_Name;
          }
        }    
        $datas=array(
            'moduleName'=>$this->input->post('moduleName'),
            'from_location'=>json_encode(array_slice($this->input->post('from'),0,$this->input->post('stops')+1,false)),
            'to_location'=>json_encode(array_slice($this->input->post('to'),0,$this->input->post('stops')+1,false)),        
            'stops'=>$this->input->post('stops'),
            'departure_date'=>json_encode(array_slice($this->input->post('departure_date'),0,$this->input->post('stops')+1,false)),
            'arrival_date'=>json_encode(array_slice($this->input->post('arrival_date'),0,$this->input->post('stops')+1,false)),
            'start_time'=>json_encode(array_slice($this->input->post('start_time'),0,$this->input->post('stops')+1,false)),
            'end_time'=>json_encode(array_slice($this->input->post('end_time'),0,$this->input->post('stops')+1,false)), 
            'airline_id'=>json_encode(array_slice($this->input->post('airline'),0,$this->input->post('stops')+1,false)),       
            'amount'=>$this->input->post('amount'),
            'flight_image'=>$image_name,
            );   
      }else{

         $datas=array(
		        'moduleName'=>$this->input->post('moduleName'),
		        'from_location'=>json_encode(array_slice($this->input->post('from'),0,$this->input->post('stops')+1,false)),
            'to_location'=>json_encode(array_slice($this->input->post('to'),0,$this->input->post('stops')+1,false)),        
		        'stops'=>$this->input->post('stops'),
            'departure_date'=>json_encode(array_slice($this->input->post('departure_date'),0,$this->input->post('stops')+1,false)),
            'arrival_date'=>json_encode(array_slice($this->input->post('arrival_date'),0,$this->input->post('stops')+1,false)),
            'start_time'=>json_encode(array_slice($this->input->post('start_time'),0,$this->input->post('stops')+1,false)),
            'end_time'=>json_encode(array_slice($this->input->post('end_time'),0,$this->input->post('stops')+1,false)), 
            'airline_id'=>json_encode(array_slice($this->input->post('airline'),0,$this->input->post('stops')+1,false)),       
		        'amount'=>$this->input->post('amount'),
            'user_id'=>$this->session->userdata('admin_id'),
		        );
      }
         // debug($datas);exit;
		 //echo "<pre>";print_r($datas);exit;
	 	$this->specialtrip_model->update_flightTrip($flightId,$datas);
		$this->session->set_flashdata('success', 'Update successfully');
		redirect(WEB_URL.'special_trip/all_special_trip/','refresh');
     }
    function specialTrip_status_update()
    {
      // debug($_POST);exit;
        // $tripid=json_decode(base64_decode($id));
         $val= $this->input->post('val');
         $tripid=$this->input->post('ids');
        $data=$this->specialtrip_model->updateStatusSecialTrip($val,$tripid);
        echo json_decode($data);
	// redirect(WEB_URL.'special_trip/all_special_trip/','refresh');
    }
    function trip_booking_list()
    {
         $datas['flight_request_list']= $this->specialtrip_model->getflighttripRequest();
          foreach($datas['flight_request_list'] as $stval)
        {
          $arr=json_decode($stval['airline_id']);
            $airIds = [];
          foreach ($arr as $key => $value) {
          if ($value != 'Select Airline') {
            $airIds[] = $value;
          }
        } 
             $airIds=rtrim(implode(",",$airIds),',');
            $execute_query = $this->db->query("select airline_name from airline_list where airline_list_id in ($airIds)");
		    $datas['airline_name'][]=$execute_query->result_array();
        }
        // echo "<pre>"; print_r($datas);exit;
    	$this->load->view('special_trip/trip_booking_list',$datas);
    }
    
    function userReq_status_update()
    {
        $val= $this->input->post('val');
        $id=$this->input->post('ids');
        if ($val!=0) {
          if ($val==1) {
            $type='SPECIAL_TRIP_ACCEPT';
          }else{
            $type='SPECIAL_TRIP_REJECT';
          }
          $this->load->model('email_model');
          $this->email_model->user_spcial_trip($type,$id,$val);
        }
        $this->specialtrip_model->userReq_status_update($val,$id);
	redirect(WEB_URL.'special_trip/trip_booking_list/','refresh');
    }
    function hotel_booking_list()
    {
       $datas['hotel_request_list']= $this->specialtrip_model->gethoteltripRequest();
        // debug($datas);exit;
    	$this->load->view('special_trip/hotel_booking_list',$datas);
    }
      function add_hotel_trip()
    {
      if($this->input->post('moduleName'))
    {
      $image_name = '';
      if(!empty($_FILES['image']['name']))
      { 
        if(is_uploaded_file($_FILES['image']['tmp_name'])) 
        {
          $sourcePath = $_FILES['image']['tmp_name'];
          $img_Name=time().$_FILES['image']['name'];
          $targetPath = "uploads/special_trip/".$img_Name;
          if(move_uploaded_file($sourcePath,$targetPath)){
            $image_name = $img_Name;
          }
        }       
      }

        $datas=array(
            'module_name'=>$this->input->post('moduleName'),
            'city_name'=>$this->input->post('from'),
            'hotel_name'=>$this->input->post('hotelname'), 
            //'to_location'=>$this->input->post('to'),
            'checkin_date'=>$this->input->post('checkin_date'),
            'checkout_date'=>$this->input->post('checkout_date'),
            'checkin_time'=>$this->input->post('checkin_time'),
            'checkout_time'=>$this->input->post('checkout_time'),
            'price'=>$this->input->post('amount'),
            'rating'=>$this->input->post('rating'),
            'address'=>$this->input->post('address'),
            'hotel_image'=>$image_name,
            'user_id'=>$this->session->userdata('admin_id'),

            );
          //  debug($datas);exit;
     $addData = $this->specialtrip_model->addHotelTrip($datas);
     $this->session->set_flashdata('success', 'Added successfully');
     
    redirect(WEB_URL.'special_trip/add_hotel_trip/','refresh');
          
    }
    	$this->load->view('special_trip/add_hotel_trip');
    }
    function all_hotel_trip()
    {
        $getAllHotelTrip['allData'] = $this->specialtrip_model->getallHotelTrip();
      //  debug($getAllHotelTrip);exit;
    	$this->load->view('special_trip/all_hotel_trip',$getAllHotelTrip);
    }

     function hotelTrip_delete($id)
    {
        $tripid=json_decode(base64_decode($id));
        $this->specialtrip_model->delHotelTrip($tripid);
        $this->session->set_flashdata('success', 'Delete successfully');
      redirect(WEB_URL.'special_trip/all_hotel_trip/','refresh');
    }

      function hotelTrip_edit($tripid){
        $tripids=json_decode(base64_decode($tripid));
         $datas['hotel_details']= $this->specialtrip_model->updateHotelTrip($tripids);
          $this->load->view('special_trip/hotelTrip_edit',$datas);
    }

      public function update_hotel_trip($tripid)   
    {
      if($this->input->post('moduleName'))
      {
         $image_name = '';
      if(!empty($_FILES['image']['name']))
      { 
        if(is_uploaded_file($_FILES['image']['tmp_name'])) 
        {
          $sourcePath = $_FILES['image']['tmp_name'];
          $img_Name=time().$_FILES['image']['name'];
          $targetPath = "uploads/special_trip/".$img_Name;
          if(move_uploaded_file($sourcePath,$targetPath)){
            $image_name = $img_Name;
          }
        }  

          $datas=array(
            'module_name'=>$this->input->post('moduleName'),
            'city_name'=>$this->input->post('from'),
            'hotel_name'=>$this->input->post('hotelname'),
            //'to_location'=>$this->input->post('to'),
            'checkin_date'=>$this->input->post('checkin_date'),
            'checkout_date'=>$this->input->post('checkout_date'),
            'checkin_time'=>$this->input->post('checkin_time'),
            'checkout_time'=>$this->input->post('checkout_time'),
            'price'=>$this->input->post('amount'),
            'rating'=>$this->input->post('rating'),
            'address'=>$this->input->post('address'),
            'hotel_image'=>$image_name,
            'user_id'=>$this->session->userdata('admin_id'),

            );

            $this->specialtrip_model->updateHotelTripDetails($tripid,$datas);
            $this->session->set_flashdata('success', 'Update successfully');
        redirect(WEB_URL.'special_trip/all_hotel_trip/','refresh');

      }
      else{
               $datas=array(
            'module_name'=>$this->input->post('moduleName'),
            'city_name'=>$this->input->post('from'),
            'hotel_name'=>$this->input->post('hotelname'),
            //'to_location'=>$this->input->post('to'),
            'checkin_date'=>$this->input->post('checkin_date'),
            'checkout_date'=>$this->input->post('checkout_date'),
            'checkin_time'=>$this->input->post('checkin_time'),
            'checkout_time'=>$this->input->post('checkout_time'),
            'price'=>$this->input->post('amount'),
            'rating'=>$this->input->post('rating'),
            'address'=>$this->input->post('address'),
            'user_id'=>$this->session->userdata('admin_id'),
           // 'hotel_image'=>$image_name,

            );

            $this->specialtrip_model->updateHotelTripDetails($tripid,$datas);
            $this->session->set_flashdata('success', 'Update successfully');
        redirect(WEB_URL.'special_trip/all_hotel_trip/','refresh');
      }
     
      }
    }
    
      function add_bus_trip()
    {
      	if($this->input->post('moduleName'))
		{

       $image_name = '';
      if(!empty($_FILES['image']['name']))
      { 
        if(is_uploaded_file($_FILES['image']['tmp_name'])) 
        {
          $sourcePath = $_FILES['image']['tmp_name'];
          $img_Name=time().$_FILES['image']['name'];
          $targetPath = "uploads/special_trip/".$img_Name;
          if(move_uploaded_file($sourcePath,$targetPath)){
            $image_name = $img_Name;
          }
        } 
      }
		    $datas=array(
		        'moduleName'=>$this->input->post('moduleName'),
		        'from_location'=>$this->input->post('from'), 
		        'to_location'=>$this->input->post('to'),
		        'departure_date'=>$this->input->post('departure_date'),
		        'arrival_date'=>$this->input->post('arrival_date'),
		        'start_time'=>$this->input->post('start_time'),
		        'end_time'=>$this->input->post('end_time'),
		        'boarding_point'=>json_encode($this->input->post('boarding')),
		        'droping_point'=>json_encode($this->input->post('droping')),
		        'amount'=>$this->input->post('amount'),
		        'travels_name'=>$this->input->post('travelsname'),
            'user_id'=>$this->session->userdata('admin_id'),  
            'bus_image'=>$image_name  
		        );
		        
		 $addData = $this->specialtrip_model->addBusTrip($datas);
		 $this->session->set_flashdata('success', 'Added successfully');
		 
		redirect(WEB_URL.'special_trip/add_bus_trip/','refresh');
		      
		}
    	$this->load->view('special_trip/add_bus_trip');
    }
    function all_bus_trip()
    {
       // $getAllBusTrip['allData'] = $this->user_model->getallBusTrip();
        $getAllBusTrip['allData'] = $this->specialtrip_model->getallBusTrip();
       	$this->load->view('special_trip/all_bus_trip',$getAllBusTrip);
    }
      function busTrip_delete($id)
    {
        $tripid=json_decode(base64_decode($id));
        $this->specialtrip_model->delBusTrip($tripid);
        $this->session->set_flashdata('success', 'Delete successfully');
    	redirect(WEB_URL.'special_trip/all_bus_trip/','refresh');
    }
    
    function busTrip_edit($tripid)
    {
          $tripids=json_decode(base64_decode($tripid));
          $datas['bus_details']= $this->specialtrip_model->updateBusTrip($tripids);
          // debug($datas['bus_details']);exit;
          $this->load->view('special_trip/busTrip_edit',$datas);
    }
  
    function update_bus_trip($tripid)
    {     
      if($this->input->post('moduleName'))
      {
        if(!empty($_FILES['image']['name']))
      { 
        if(is_uploaded_file($_FILES['image']['tmp_name'])) 
        {
          $sourcePath = $_FILES['image']['tmp_name'];
          $img_Name=time().$_FILES['image']['name'];
          $targetPath = "uploads/special_trip/".$img_Name;
          if(move_uploaded_file($sourcePath,$targetPath)){
            $image_name = $img_Name;
          }
        } 
         $datas=array(
            'moduleName'=>$this->input->post('moduleName'),
            'from_location'=>$this->input->post('from'),
            'to_location'=>$this->input->post('to'),
            'departure_date'=>$this->input->post('departure_date'),
            'arrival_date'=>$this->input->post('arrival_date'),
            'start_time'=>$this->input->post('start_time'),
            'end_time'=>$this->input->post('end_time'),
            'boarding_point'=>json_encode($this->input->post('boarding')),
            'droping_point'=>json_encode($this->input->post('droping')),
            'amount'=>$this->input->post('amount'),
            'travels_name'=>$this->input->post('travelsname'),
            'user_id'=>$this->session->userdata('admin_id'),
            'bus_image'=>$image_name,
            );
      }else{
         $datas=array(
            'moduleName'=>$this->input->post('moduleName'),
            'from_location'=>$this->input->post('from'),
            'to_location'=>$this->input->post('to'),
            'departure_date'=>$this->input->post('departure_date'),
            'arrival_date'=>$this->input->post('arrival_date'),
            'start_time'=>$this->input->post('start_time'),
            'end_time'=>$this->input->post('end_time'),
            'boarding_point'=>json_encode($this->input->post('boarding')),
            'droping_point'=>json_encode($this->input->post('droping')),
            'amount'=>$this->input->post('amount'),
            'travels_name'=>$this->input->post('travelsname'),
            'user_id'=>$this->session->userdata('admin_id'),
            );
      }          
		        $this->specialtrip_model->updateBusTripDetails($tripid,$datas);
		        $this->session->set_flashdata('success', 'Update successfully');
		  	redirect(WEB_URL.'special_trip/all_bus_trip/','refresh');
      }
    }

  
    function busTrip_status_update()
    {
        //$tripid=json_decode(base64_decode($id));
        $val= $this->input->post('val');
        $tripid=$this->input->post('ids');
        $this->specialtrip_model->updateStatusBusTrip($val,$tripid);
	    redirect(WEB_URL.'special_trip/all_bus_trip/','refresh');
    }
    
    function hotelTrip_status_update()
    {
      $val= $this->input->post('val');
        $tripid=$this->input->post('ids');
        $this->specialtrip_model->updateStatusHotelTrip($val,$tripid);
      redirect(WEB_URL.'special_trip/all_bus_trip/','refresh');
    }
    function bus_booking_list()
    {
         $datas['bus_request_list']= $this->specialtrip_model->getbustripRequest();
        //   debug($datas);exit;
         $this->load->view('special_trip/bus_booking_list',$datas);
    }
     function b2c_userReq_status_update()
    {
        $val= $this->input->post('vals');
        $id=$this->input->post('ids');
        $this->specialtrip_model->b2c_userReq_status_update($val,$id);
        redirect(WEB_URL.'special_trip/hotel_booking_list/','refresh');
    }
     function b2c_userReq_status_update_hotel()
    {
        $val= $this->input->post('vals');
        $id=$this->input->post('ids');
        $this->specialtrip_model->b2c_userReq_status_update_hotel($val,$id);
	      redirect(WEB_URL.'special_trip/hotel_booking_list/','refresh');
    }
     function add_hotel()
    {
    	$this->load->view('special_trip/add_hotel');
    }
    
     function all_trip_hotels()
    {
    	$this->load->view('special_trip/all_trip_hotels');
    }
    
   
}

?>
