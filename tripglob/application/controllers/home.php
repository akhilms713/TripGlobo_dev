<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) { session_start(); }
error_reporting(0);
 // error_reporting(E_ALL);
 // ini_set('display_errors', 1);
class Home extends CI_Controller {
	
	//DO : Setting Current website url in session, Purpose : For keeping the page on login/logout.
	public function __construct(){
		parent::__construct();
// exit('test');
		$current_url 	= $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url 	= WEB_URL.$this->uri->uri_string(). $current_url;
		$url 			=  array('continue' => $current_url);
        $this->session->set_userdata($url);
		$this->load->model('home_model');
		$this->load->model('General_Model');
		//$this->load->model('promo_model');
	}
	
	public function index($type=''){
		// debug('test'); die; 
		ini_set('memory_limit', '-1');
		// 	error_reporting(E_ALL);
 		// ini_set('display_errors', 1);
		if($this->session->userdata('user_type')=='1')
		{
			// redirect(WEB_URL.'dashboard');
		}
		$this->load->model('flightdeals_model');
		//debug($data['promo']);die;
		$data['flightdeals'] = $this->flightdeals_model->get_allflightdeals();
		//debug($data['flightdeals']);die;
		$flight_deals=[];
        foreach ($flight_deals as $key => $flight_deal) {
    		array_push($flight_deals,$flight_deal->deal_offered_price);
    	}
    	$data['flight_deals']=$flight_deals;
	  // debug($data['flightdeals']);die;
		$this->load->model('general_model');
		$data['top_destionation']	=	$this->home_model->get_top_destionation();
		$data['best_destionation']	=	$this->home_model->get_best_destionation();
		$data['top_deals']			=	$this->home_model->get_promo_deals();
		$data['top_flightdeals']	=	$this->home_model->get_flight_deals();
		$data['top_airliners'] 		= 	$this->home_model->get_topairliners();
		$data['bestairline_list'] 	= 	$this->home_model->bestairline_list();
		$data['tour_style'] 		= '';
		$data['advertise_sect'] 	= 	$this->home_model->advertise_sect();
		$data['flightsdetails']		=	$this->home_model->get_flight_data();
        $data['hotalsdetails']		=	$this->home_model->get_hotal_data();
        $data['class']				=	$this->home_model->class_name();
        $data['ad']					=	$this->home_model->advertisement();
        $data['holidays_list']		=	$this->home_model->get_holiday_types_list_index();
		$data['top_news']	=	$this->home_model->get_news_detail();

		$data['transfer_country_list']	=	$this->home_model->get_transfer_country_list();
		/*$data['transfer_pickup_airport']	=	$this->home_model->transfer_pickup_airport();
		$data['transfer_drop_airport']	=	$this->home_model->transfer_drop_airport();*/
		$data['transfer_country_lists']	=	$this->home_model->transfer_country_list(); 

		  $query = $this->db->query('select * from PreferredLanguage'); 
            $langauge =  $query->result();
		$data['PreferredLanguage']	=	$langauge; 
		// debug($data['PreferredLanguage']); die;


        // debug($data['transfer_drop_airport']);exit;
        //echo '<pre>';print_r($data['top_flightdeals']);exit();
        
        $active_home_mod=$this->home_model->active_home_module_list();
        $active_home_module_list=[];
        foreach ($active_home_mod as $key => $active_home) {
    		array_push($active_home_module_list,$active_home->section_name);
    	}
    	$data['active_home_module_list']=$active_home_module_list;
        // print_r($data['holidays_list'Z]); exit;
     	$data['promo_deals'] = $this->home_model->get_promo_list();
 	//debug($data['promo_deals']);die;
		$data['status'] = $status; 
        // debug($data);exit;
		$this->load->view(PROJECT_THEME.'/index', $data);	
    }
    
    //~ public function create_pagination(){
		//~ $this->load->library('pagination');
		//~ $config['base_url'] = base_url().'home/create_pagination';
		//~ $config['total_rows'] = 200;
		//~ $config['per_page'] = 20;
		//~ $this->pagination->initialize($config);
		//~ echo $this->pagination->create_links();
	//~ }

	public function get_hotel_cities(){
		//exit("raj");
		ini_set('memory_limit', '-1');
        $term = $this->input->get('term'); //retrieve the search term that autocomplete sends
        $term = trim(strip_tags($term));
        $cities = $this->home_model->get_hotel_cities_list($term)->result();
        $result = array();
        foreach ($cities as $city) {
            $apts['label'] = $city->city;
            $apts['value'] = $city->city;
            $apts['id'] = $city->id;
            $result[] = $apts;
        }
        echo json_encode($result);
	}

	/*  16-03-2016 */
	// For Inner pages header functionality
	public function inner_header($product){
		$data['header_product'] 	= 	$product;
		$data['top_destionation']	=	$this->home_model->get_top_destionation();
		$data['top_flightdeals']	=	$this->home_model->get_flight_deals();
		//$data['top_deals']			=	$this->home_model->get_top_deals();
		$data['top_deals']			=	$this->home_model->get_promo_deals();
		$data['tour_style'] = $this->home_model->get_tourstyle();
		$data['top_airliners'] = $this->home_model->get_topairliners();
		$data['flightsdetails']=$this->home_model->get_flight_data();
		$data['hotalsdetails']=$this->home_model->get_hotal_data();

		$this->load->view(PROJECT_THEME.'/index', $data);	
	}


	public function get_top_destination()
	{
		$data['top_destionation']=$this->home_model->get_top_destionation();
		$this->load->view(PROJECT_THEME.'/new_theme/top_destination'); 

	}


	public function topsearch($flight_id)
	{
		$data      				=	$this->home_model->get_flight_dealsbyid($flight_id);
		$adult					=1;
		 $today_date			=date("Y-m-d");		
		 $from					=$data[0]->deal_from_place;
		 $to					=$data[0]->deal_to_place;
		 $type					=$type 	= 'type=oneway';   
		 $child				    =0;
		 $infant				=0;
		 $class                 ="All";
		 $date = date("Y-m-d");// current date
         $date1 = date("Y-m-d",strtotime(date("Y-m-d", strtotime($date)) . " +1 day"));
   
	$query 	= $type.'&origin='.substr(chop(substr($from, -5), ')'), -3).'&destination='.substr(chop(substr($to, -5), ')'), -3).'&depart_date='.$date1.'&ADT='.$adult.'&CHD='.$child.'&INF='.$infant.'&class='.$class ;
	redirect(WEB_URL.'flight/?'.$query);  
	}


	public function tophotelsearch($last_deal_id){
	$data =	$this->home_model->get_last_dealsbyid($last_deal_id);
	$city1= explode('(', $data[0]->city);
	$city=str_replace(" ","+",$city1[0]);
	$date = date("Y-m-d");// current date
	$hotel_checkin =  $date1 = date("d-m-Y",strtotime(date("d-m-Y", strtotime($date)) . " +1 day"));
	$hotel_checkout=  $date2 = date("d-m-Y",strtotime(date("d-m-Y", strtotime($date1)) . " +1 day"));
	$rooms=1;
	$adult=1; 
	$child=0; 
	//$query 	= 'city='.$city.'&hotel_checkin='.$hotel_checkin.'&hotel_checkout='.$hotel_checkout.'&adult='.$adult.'&child='.$child ;
	$query='city='.$city.'&hotel_checkin='.$hotel_checkin.'&hotel_checkout='.$hotel_checkout.'&rooms='."1".'&adult[0]='."1".'&child='."0";
redirect(WEB_URL.'hotel/search?'.$query);  
}


	function page($id){	
	// echo $id; exit();	
		$data['content'] = $this->home_model->get_page_content($id);
		$data['top_airliners'] = $this->home_model->get_topairliners();

		// echo 'hi'; print_r($data['content']); exit();
		$this->load->view(PROJECT_THEME.'/pages/pages',$data);
	}


	
}

?>
