<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Offline_booking extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('user_model');
		$this->load->model('Offline_Booking_Model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      	$this->output->set_header("Pragma: no-cache");
	    $this->load->library('form_validation');
		$this->load->model('email_model');		
		$this->user_mode = 'B2B';
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
	
	public function add_booking()
	{
		//echo "fcghfhf";exit;
        $this->load->view('offline_booking/add_booking');
	}

	public function offline_flight_book() {
        $page_data = $this->input->post();
        //echo "<pre>";print_r($page_data);exit;
        $data = $this->Offline_Booking_Model->insert_offline_data($page_data);
        redirect('offline_booking/offline_booking_report');
        
    }
   public function offline_fare_calculate() {

        $flight_data = $this->input->post();
      // print_r($flight_data);exit;
        $pax_fare = array();
        $c = 0;
        $agent_id = "0";

        if ($flight_data['booking_type'] == "international") {
            $ModuleType = "flight_int";
        } else {
            $ModuleType = "flight";
        }
        $cm = 0;

        foreach ($flight_data['pax_basic_fare_onward'] as $fk => $fv) {
            $pax_fare['onward']['basic'] = @$pax_fare['onward']['basic'] + ($fv * $flight_data['pax_type_count_onward'][$fk]);
            $pax_fare['onward']['yq'] = @$pax_fare['onward']['yq'] + ($flight_data['pax_yq_onward'][$fk] * $flight_data['pax_type_count_onward'][$fk]);
            $pax_fare['onward']['others'] = @$pax_fare['onward']['others'] + ($flight_data['pax_other_tax_onward'][$fk] * $flight_data['pax_type_count_onward'][$fk]);
            if ($flight_data['trip_type'] == 'circle' && isset($flight_data['pax_basic_fare_return'][$fk])) {
                $pax_fare['return']['basic'] = @$pax_fare['return']['basic'] + ($flight_data['pax_basic_fare_return'][$fk] * $flight_data['pax_type_count_return'][$fk]);
                $pax_fare['return']['yq'] = @$pax_fare['return']['yq'] + ($flight_data['pax_yq_return'][$fk] * $flight_data['pax_type_count_return'][$fk]);
                $pax_fare['return']['others'] = @$pax_fare['return']['others'] + ($flight_data['pax_other_tax_return'][$fk] * $flight_data['pax_type_count_return'][$fk]);
            }
        }
        //debug($pax_fare);
        $t['onward']['career'] = @$flight_data['career_onward'];
        $t['onward']['pax_count'] = array_sum($flight_data['pax_type_count_onward']);
        $f['onward']['basic'] = $pax_fare['onward']['basic'];
        $f['onward']['yq'] = $pax_fare['onward']['yq'];
        $f['onward']['others'] = $pax_fare['onward']['others'];
        if ($flight_data['trip_type'] == 'circle' && valid_array(@$flight_data['career_return'])) {
            $t['return']['pax_count'] = array_sum($flight_data['pax_type_count_onward']);
            $t['return']['career'] = @$flight_data['career_return'];
            $f['return']['basic'] = $pax_fare['return']['basic'];
            $f['return']['yq'] = $pax_fare['return']['yq'];
            $f['return']['others'] = $pax_fare['return']['others'];
        }
        //debug($t);exit;
        $price['api_total_tax'] = 0;
        $price['api_total_basic_fare'] = 0;
        $price['api_total_yq'] = 0;
        $price['service_tax'] = 0;
        $price['meal_and_baggage_fare'] = 0;
        $price['commission'] = 0;
        $price['tds'] = 0;
        $price['agent_buying_price'] = 0;
        $price['api_total_selling_price'] = 0;

        foreach ($t as $trp => $tv) {

            $trpc = $trp;
           
            if(@$flight_data['add_admin_markup'] > 0){
                $service_tax = @$flight_data['add_admin_markup'] ;
            }
            else{
                $service_tax = 0;   
            }
            $agent_comm = $flight_data['basic_comm'];
            $agent_tds_on_commission = $agent_comm * 5 / 100;
            $dist_comm = 0;
            $dist_tds_on_commission = 0;

            $total = $f[$trpc]['basic'] + $f[$trpc]['yq'] + $f[$trpc]['others'];
            $tot_markup = ( @$flight_data['add_admin_markup'] + @$flight_data['add_admin_markup'] );
            $buying_price = $total + $service_tax + $tot_markup;
            $agent_buying_price = $f[$trp]['basic'] + $agent_tds_on_commission + $f[$trp]['others'] + $service_tax - $agent_comm;
            $api_total_selling_price = $f[$trp]['basic'] + $agent_tds_on_commission + $f[$trp]['others'] + $service_tax + $agent_comm;


            $price['api_total_tax'] = $price['api_total_tax'] + ($f[$trp]['others']);
            $price['api_total_basic_fare'] = $price['api_total_basic_fare'] + $f[$trp]['basic'];
            //echo $price['api_total_basic_fare'] ;exit;
            $price['api_total_yq'] = $price['api_total_yq'] + $f[$trp]['yq'];
            $price['service_tax'] = 0;
            $price['meal_and_baggage_fare'] = 0;
            $price['commission'] =  $agent_comm;
            $price['tds'] = $agent_tds_on_commission;
           
            $price['agent_buying_price'] = $price['api_total_tax'] + $price['api_total_basic_fare']+$price['service_tax']+$price['tds']-$price['commission'];
           
            $price['api_total_selling_price'] =  $price['api_total_tax'] + $price['api_total_basic_fare']+$price['service_tax']+$price['tds']+$price['commission'];
        }
        $price['admin_markup'] = $flight_data['add_admin_markup'];
        $price['commission'] = $price['commission'];
        // $price['tds'] = number_format((float)$price['tds'], 2, '.', '');
        // $price['tds'] = number_format((float)$price['tds'], 2, '.', '');
        $price['agent_buying_price'] = $price['agent_buying_price']+$price['admin_markup'];
        $total_price = $flight_data['total_base_fare'] + $flight_data['other_tax_value'];
        //echo $total_price; exit;
        $price['agent_buying_price'] =round($price['agent_buying_price']) + $total_price;
        $price['api_total_selling_price'] = round($price['api_total_selling_price']+@$flight_data['add_admin_markup']);

        $price['pass_base_fare'] = $flight_data['pass_base_fare'];
    
    	$price['passenger_other_tax'] = $flight_data['passenger_other_tax'];
    	//echo $price['passenger_other_tax'];
    	//echo "<pre>";print_r($price);exit;
        echo json_encode($price);

        //debug($page_data);
    }

    function offline_booking_report()
    {
    	//echo "dgbhfhfg";exit;
        //$current_user_id = $GLOBALS['CI']->user_id;;exit;
        // $markup             = $this->General_Model->get_home_page_settings();
        // $markup['markup']   = $this->Markup_Model->get_markup_list();
        $booking_list['booking_data'] = $this->Offline_Booking_Model->get_booking_data();
       // echo "<pre>";print_r($booking_list['booking_data']);exit;
    //   echo '<pre/>';print_r($markup);exit;
        $this->load->view('offline_booking/offline_booking_list',$booking_list);
    }

    function voucher_view($user_id1)
    {
    	$id 	= json_decode(base64_decode($user_id1));
        //$this->load->library('provab_pdf');
        //$create_pdf = new Provab_Pdf();
        //$get_view=$this->template->isolated_view('voucher/flight_pdf', $page_data);
        $booking_list['booking_data'] = $this->Offline_Booking_Model->get_single_booking_data($id);
        $booking_list['pass_details'] = $this->Offline_Booking_Model->getpassangerdetails($id);
        // echo "<pre>";print_r($booking_list['pass_details']);
        // echo "<pre>";print_r($booking_list['booking_data']);exit;
        $this->load->view('offline_booking/offline_voucher_view',$booking_list);
    }
    function flight_pdf()
    {
//echo "dfdgdg";exit;
       $referal_email_id = $this->input->post('email_pdf');//echo $referal_email_id;exit;
       $parent_pnr = $this->input->post('id');//echo $parent_pnr;exit;
       //echo json_encode($parent_pnr);
        
       // $parent_pnr     = json_decode(base64_decode($_POST['parent_pnr1']));
        if(!empty($parent_pnr)){
        	//echo "ecjhjj";exit;
             //$result = $this->Booking_Model->getBookingByParentPnr($parent_pnr)->result();
             $result['booking_data'] = $this->Offline_Booking_Model->get_single_booking_data($parent_pnr);
            // echo "<pre>";print_r($result['booking_data']);exit;
             $result['pass_details'] = $this->Offline_Booking_Model->getpassangerdetails($parent_pnr);
           // echo "<pre>";print_r($result['pass_details']);exit;
             if($parent_pnr != 0){
                 //$data['response'] = $result[0];

                //$data['booking_number']         = $result[0]->booking_number;
                //$data['email_voucher']          = $this->load->view('global/hotel_voucher', $data,true);  
                $data['email_voucher']          = $this->load->view('offline_booking/offline_voucher_view',$result,true);

                //$data['booking_number']         = $flight['booking_global'][0]->booking_number;

                $data['to']                     = $referal_email_id;
                //$data['module']                 ='HOTEL';
                $datata = $this->Offline_Booking_Model->send_voucher($data);
                ///echo json_encode($datata);
                //redirect('offline_booking/offline_booking_report','refresh');
                }else{
                    echo "Error";exit;
                    /*
                $booking_flights    = $this->Booking_Model->get_booking_flight_data($parent_pnr);
            if($booking_flights !=''){
                $booking_global     = $this->Booking_Model->get_booking_global_data($parent_pnr);
                $flight['search_id']        = $booking_flights[0]->search_parameter_details_id;
                $flight['rand_id']          = $booking_flights[0]->rand_id;
                $flight['booking_global']   = $booking_global;
                $flight['booking_flights']  = $this->Booking_Model->get_booking_flight_data($parent_pnr);
                $flight['booking_payment']  = $this->Booking_Model->get_booking_payment_data($parent_pnr);
                // $flight['search_data']   = json_decode(base64_decode($booking_flights[0]->search_data));
                $flight['search_data']      = json_decode($booking_flights[0]->search_data);
                $flight['results']          = json_decode(base64_decode($booking_flights[0]->segment_data),1);
                $traveler_details           = json_decode(base64_decode($flight['booking_flights'][0]->traveler_details));
                $data['booking_number']     = $flight['booking_global'][0]->booking_number;
                // $data['email_voucher']       = $this->load->view('global/voucher_view',$flight,true);
                $data['email_voucher']      = $this->load->view('global/mail_voucher',$flight,true);
                $data['to']                 = $_POST['email'];
                $data['module']             ='FLIGHT';
                $this->Booking_Model->send_voucher($data);
                redirect('booking/orders','refresh');
            }
            */
        }
        }else{
            redirect('booking/orders','refresh');
        }
        
    }

    function edit_booking($booking_id)
    {
    	$booking_details = $this->Offline_Booking_Model->edit_booking($booking_id);


    }








}

?>
