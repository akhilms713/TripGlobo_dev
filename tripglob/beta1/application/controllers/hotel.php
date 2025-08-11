<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) { session_start(); } 
error_reporting(0);
class Hotel extends CI_Controller {

public function __construct() {
        parent::__construct();
	    $this->load->library('session');
		$this->load->model('Hotel_Model');
		$this->load->model('custom_db');
        $this->load->library('xml_to_array');
        $this->load->helper('hotel/tbo_helper');	
        $this->load->library('pagination');
}
	 
public function search(){
 	// echo "<pre/>";print_r($_GET);exit;
       
	if(!empty($_GET['checkin']) && !empty($_GET['checkout'])){
      if ($_GET['city'] == '' || $_GET['rooms'] == '' || $_GET['adult'][0] =='' || $_GET['adult'][0] ==0) { 
        redirect(WEB_URL.'home','refresh'); 
      }
     
      $check_in = $_GET['checkin'];
      $check_out = $_GET['checkout'];
    }else{
      if ($_GET['city'] == '' || $_GET['checkin'] =='' || $_GET['checkout'] =='' || $_GET['rooms'] == '' || $_GET['adult'][0] =='' || $_GET['adult'][0] ==0) { 
         
        redirect(WEB_URL.'home#hotels','refresh'); 
      }
      $check_in  = $_GET['checkin'];
      $check_out = $_GET['checkout'];

    }
        //$_SESSION['currency'] = BASE_CURRENCY;		   
        $request = $this->input->get(); 
	
        $request['hotel_checkin'] =date('Y-m-d' , strtotime($check_in));
        $request['hotel_checkout'] =date('Y-m-d' , strtotime($check_out));
     
     	$explode_city = explode(",",$request['city']);
     	$request['city'] = $explode_city[0];
     	$request['country'] = $explode_city[1];     	
		$data['request_data'] = $request;

		$insert_data['search_data'] = json_encode($request);
        $insert_data['search_type'] = 'HOTEL';
       // print_r($insert_data);exit();
        $search_insert_data = $this->custom_db->insert_record('search_history',$insert_data);
        $data['request_data']['search_id'] =$search_insert_data['insert_id'];
        //print_r(data);exit();
        $bundle_search_id = 0;
        if(isset($request['insert_id'])){
        	$bundle_search_id = $request['insert_id'];
        }
        $search_id = 0;
        if($bundle_search_id==0){
        	$search_id  = $search_insert_data['insert_id'];
        }
        // debug($_GET['sid']);exit;
        if ($_GET['sid']=='') {
            $sid=$this->generate_rand_no() . date("mdHis");
        }else{
            $sid=$_GET['sid'];
        }
        $data['request_data']['bundle_search_id'] = $bundle_search_id;
        $data['request_data']['search_id'] = $search_id;
        $data['request_data']['sid']        = $sid ;
        $data['request_data']['session_data'] = $sid;
        $data['request_data']['session_data'] = $sid;
         if ($_GET['page']=='') {
        $data['request_data']['page'] = 1;
        }
        $data['ssid'] = $sid;
        // debug($data);exit();
        
        $this->load->view(PROJECT_THEME.'/hotel/results', $data);        
}
 public function generate_rand_no($length = 24)
    {
        $alphabets   = range('A', 'Z');
        $numbers     = range('0', '9');
        $final_array = array_merge($alphabets, $numbers);
        //$id = date("ymd").date("His");
        $id          = '';
        while ($length--) {
            $key = array_rand($final_array);
            $id .= $final_array[$key];
        }
        return $id;
    }
    
    public function call_api($api,$id=''){ 
        
		$request 	= 	$_REQUEST['request'];
		$page=$_REQUEST['page'];
        $requestset = 	json_decode(base64_decode($request), true); 
		
        $session_data = $requestset['session_data'];
        // debug($session_data);exit;
        $totel_row =   $this->Hotel_Model->fetch_search_result_row($session_data);
        $api_id = 3;
        if ($totel_row == 0) {            
	    // debug($hotel_data);exit;
	    $hotel_data = TBOHotelValuedAvailRQ($request, $api_id, $session_data);
        }else{
         $hotel_data  =   $this->Hotel_Model->fetch_search_result($session_data,$api,$page);   
        }
        $this->fetch_search_result($hotel_data,$session_data,$api,$request,'',$page);
        
    }
    
    function fetch_search_result($hotel_data,$sessionId,$api,$request,$id='',$page){
        // debug($sessionId);exit;

	$requestset 							= 	json_decode(base64_decode($request), true); 	
	$roomCount								=  	$requestset['rooms'];
	$response 								= 	$this->Hotel_Model->fetch_search_result($sessionId,$api,$page); 
     
    
    // debug($response['totRow']);exit();
    
	
	$star_rating_html ='';
			$star_rating_checkhtml ='';
			$response['star_rating1'] = array_multisort($response['star_rating']);
			foreach ($response['star_rating'] as $key => $value) {
				if ($key == 0) {
					$star_rating_html = '<a class="timone toglefil filter_depart_btn star_rating" rate="'.$value["star_rating"].'" type="'.$value["star_rating"].'_star">
            		   <div class="starin"><span class="htlcount">'.$value["star_rating"].' star</span></div>
            		</a>';
				} else {
					$star_rating_html .= '<a class="timone toglefil filter_depart_btn star_rating" rate="'.$value['star_rating'].'" type="'.$value["star_rating"].'_star">
            		   <div class="starin"><span class="htlcount">'.$value["star_rating"].' star</span></div>
            		</a>';
				}	
			}

        $response 								= 	$this->calculateHotelMarkup($response); 
    	$data['photeldesc'] 					= 	$response['result'];      	
    	$total_result_count						= 	$response['totRow'];		
    	$data['check_in']						=	$_SESSION['hotel_checkin'];
    	$data['check_out']						=	$_SESSION['hotel_checkout'];
    	$data['rooms']							=	$_SESSION['rooms'];
    	$data['adlt']							=	$_SESSION['adult_count'];
    	$data['chld']							=	$_SESSION['child_count'];
    	$data['sessionId']						=	$_SESSION['session_id_amadeus'];
    	$data['request_data']					=	$request;	
    	$data['ssid']					        =	$sessionId;	
    	$data['api']					        =	$api;	
    	$data['id']								=	$id;
    	$data['search_id']                      =   $requestset['search_id'];
    	$data['TraceId']                        =   $hotel_data['TraceId'];
    	$data['TokenId']                        =   $hotel_data['TokenId'];
    	$data['EndUserIp']                      =   $hotel_data['EndUserIp'];
    	$data['ResultIndex']                    =   $hotel_data['ResultIndex'];
    	$config = array(); 
        $get = json_decode(base64_decode($_GET['request']),1);         
        // debug($get);exit;      
        unset($get['page']);
        // debug(http_build_query($get)); 
        // die;
        $config['base_url'] =$_SERVER["HTTP_REFERER"].'?'.urldecode(http_build_query($get));
        $config['total_rows'] =$response['totRow']-300 ;
        $config['per_page'] = 700;
        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');
        // debug($config);exit();
		$this->pagination->initialize($config);
		$page = $this->input->get('page',0);
		$data['links'] = $this->pagination->create_links();
    	$ajax_page 								= 	$this->load->view(PROJECT_THEME.'/hotel/ajax_result',$data,true);
    	$hotel_min_val							= 	$response['minVal'] + $response['result'][0]->markup;
    	$hotel_max_val							= 	$response['maxVal'] + $response['result'][0]->markup;
    
    	print json_encode(array(
    		'hotel_search_result' 	=> $ajax_page,
    		'star_rating_html'   	=> $star_rating_html,
    		'accommodation_html' 	=> $accommodation_html,
    		'star_rating_checkhtml' => $star_rating_checkhtml,
    		'total_result_count' 	=> $total_result_count,
    		'min_val'				=> $hotel_min_val,
    		'max_val' 				=> $hotel_max_val
    	));
    }
    
     public function hotel_details($hotel_code,$session_id){
         //echo "<pre/>";print_r($_POST);die;
        $data['hotel_code'] = json_decode(base64_decode($hotel_code));
        $data['session_id'] = $session_id;
         //debug($data);exit;
        $this->load->view(PROJECT_THEME.'/hotel/hotel_details', $data);
      }
      
       function get_room_details(){
        extract($_POST);
        $hotel_code = json_decode(base64_decode($hotel_code));
        $other_details = $this->Hotel_Model->get_hotel_other_details($hotel_code,$session_id);
        $hotel_details['TraceId'] = trim($other_details[0]['TraceId'],'"');
        $hotel_details['TokenId'] = trim($other_details[0]['TokenId'],'"');
        $hotel_details['EndUserIp'] = trim($other_details[0]['EndUserIp'],'"');
        $hotel_details['HotelCode'] = $hotel_code;
        $hotel_details['ResultIndex'] = $other_details[0]['ResultIndex'];
        $hotel_details['api_id'] = $other_details[0]['api'];
        /* agent mark up start*/
            $user_id = $this->session->userdata('user_id');
            $user_type = $this->session->userdata('user_type');
            $generic_markup_B2C = $this->Hotel_Model->get_markup_B2C('GENERAL', '2'); //B2C
            $generic_markup_B2B = $this->Hotel_Model->get_markup_B2B('GENERAL', '1'); //B2B
            // $agent_markup = $this->Hotel_Model->get_agent_markup($user_id);
            if ($user_type == 1) {
                if ($generic_markup_B2B != '') {
                    foreach ($generic_markup_B2B as $B2B_markup) {
                        if ($B2B_markup->user_id == $user_id) {
                            if (!empty($B2B_markup->markup_value)) {
                                $percentage = $B2B_markup->markup_value;
                                $generic_markup_price_B2B = $this->PercentageToAmount($TotalPrice, $percentage);
                            } else {
                                $generic_markup_price_B2B = $generic_markup_B2B[0]->markup_fixed;
                            }
                        } elseif ($B2B_markup->user_id == 0) {

                            if (!empty($B2B_markup->markup_value)) {
                                $percentage = $B2B_markup->markup_value;
                                $generic_markup_price_B2B = $this->PercentageToAmount($TotalPrice, $percentage);
                            } else {
                                $generic_markup_price_B2B = $generic_markup_B2B[0]->markup_fixed;
                            }
                        } else {
                            $generic_markup_price_B2B = 0;
                        }
                    }
                }
                if ($generic_markup_price_B2B != 0) {
                    $admin_markup = $generic_markup_price_B2B;
                }
                //agent markup 
                if ($agent_markup != "") {

                    if ($agent_markup[0]->markup_value_type == 'percentage') {
                        //   echo "d";
                        $percentage = $agent_markup[0]->markup;
                        $agent_markup_price = $this->PercentageToAmount($TotalPrice, $percentage);
                    } elseif ($agent_markup[0]->markup_value_type == 'fixed') {
                        $agent_markup_price = $agent_markup[0]->markup;
                    }
                } else {
                    $agent_markup_price = 0;
                }

                // echo $agent_markup_price;
                //agent markup ends
            } else {

                if ($generic_markup_B2C != NULL) {
                    if (!empty($generic_markup_B2C[0]->markup_value)) {
                        $percentage = $generic_markup_B2C[0]->markup_value;
                        $generic_markup_price = $this->PercentageToAmount($TotalPrice, $percentage);
                    } else {
                        $generic_markup_price = $generic_markup_B2C[0]->markup_fixed;
                    }
                } else {
                    $generic_markup_price = 0;
                }

                if ($generic_markup_price != 0) {
                    $admin_markup = $generic_markup_price;
                } else {
                    $admin_markup = 0;
                }
            }
        
            
        /* agent mark up end*/
        $search_id = $other_details[0]['search_id'];
        $PublishedPrice = $other_details[0]['total_cost'];
        //echo $PublishedPrice;exit();
        $hotel_info = tbo_hotel_info($search_id,$hotel_details,$PublishedPrice);
        //debug($hotel_details);exit;
        
        //echo '<pre>';print_r($hotel_info);exit();
        
        $roomDetails['roomDetails'] = $hotel_info['roomDetails'];
        $roomDetails['search_history'] = $hotel_info['search_history'];
        $roomDetails['hotel_details'] = $hotel_info['hotel_details'];
        $roomDetails['starting_price'] = $PublishedPrice;
        $roomDetails['session_id'] = $session_id;
        $roomDetails['roomRequest'] = json_encode($hotel_details);
        $roomDetails['api_id'] = $other_details[0]['api'];
        //echo '<pre>';print_r($roomDetails['hotel_details']);exit();
        $roomDetails['search_id'] = $search_id;
        //debug($roomDetails);exit();
        $ajax_page = $this->load->view(PROJECT_THEME.'/hotel/room_description', $roomDetails,true);
        
        	print json_encode(array(
        		'hotel_description_result' 	=> $ajax_page,
        	));
      }
      
      
      function add_cart(){
            extract($_POST);
            if (count($_POST) > 0) {
                $roomRequest = json_decode(base64_decode($roomRequest));
                $HotelName = json_decode(base64_decode($HotelName));
                $HotelCode = json_decode(base64_decode($HotelCode));
                $NoOfRooms = json_decode(base64_decode($NoOfRooms));
                $RoomTypeCode = json_decode(base64_decode($RoomTypeCode));
                $RoomTypeName = json_decode(base64_decode($RoomTypeName));
                $RatePlanCode = json_decode(base64_decode($RatePlanCode));
                $SmokingPreference = json_decode(base64_decode($SmokingPreference)); 
                $search_id = json_decode(base64_decode($search_id));
                $session_id = json_decode(base64_decode($session_id));
                $total_amount = json_decode(base64_decode($room_price));
                $api_id = json_decode(base64_decode($api_id));
                $RoomIndex = json_decode(base64_decode($RoomIndex));
                
                //$roomRequest_a  = json_decode($room_data['roomRequest']);
                //echo '<pre>';print_r($roomRequest_a);exit();
                
                $blockResponse = tbo_room_blocking($search_id,$NoOfRooms,$RoomIndex,$RoomTypeCode,$RoomTypeName,$RatePlanCode,$SmokingPreference,$HotelName,$roomRequest,$api_id);
                
                //echo '<pre>';print_r($blockResponse);exit();
                
                $room_block_response = $blockResponse['blockResponse'];
                
                //echo '<pre>';print_r($room_block_response);exit();
                
                $cart_data['search_history'] = json_encode($blockResponse['search_history']);
                $cart_data['room_block_response'] = json_encode($room_block_response);
                $cart_data['room_block_request'] = ($blockResponse['blockRequest']);
                $cart_data['roomRequest'] = json_encode($roomRequest);
                $cart_data['HotelName'] = $HotelName;
                $cart_data['HotelCode'] = $HotelCode;
                $cart_data['NoOfRooms'] = $NoOfRooms;
                $cart_data['RoomTypeCode'] = $RoomTypeCode;
                $cart_data['RoomTypeName'] = $RoomTypeName;
                $cart_data['RatePlanCode'] = $RatePlanCode;
                $cart_data['SmokingPreference'] = $SmokingPreference; 
                $cart_data['search_id'] = $search_id;
                $cart_data['session_id'] = $session_id;
                $cart_data['total_amount'] = $total_amount;
                $cart_data['api_id'] = $api_id;
                $cart_data['RoomIndex'] = $RoomIndex;
        
                //echo '<pre>';print_r($cart_data);exit();
                
        		$data = $this->Hotel_Model->add_cart_details_hotel($cart_data);
        		
        	    $data['isCart'] = true;
        	    
        	    $data['C_URL'] 			= WEB_URL.'booking/'.$session_id.'/'.$search_id.'/HOTEL';
				$data['cart_status'] 	= 1;
    
                echo json_encode($data);exit;
        	
        	}
        }
        
    function ajaxfilter(){
       
            
            if($_POST['ssid'] !=""){
            	$session_id  = 	json_decode(base64_decode($_POST['ssid']));
            }
        	
        	$data = json_decode($this->input->post('filter'),true);
        // 	echo '<pre>';print_r($data);exit();
        	$cond=array();
        	if(!empty($data)){
        		// Minus the Markup value with amount
        		$admin_markup 			= $this->Hotel_Model->getAdminGenericHotelMarkup();
        		$specific_markup 		= array();
        		if ($this->session->userdata('user_id')!='') {
        			$user_id = $this->session->userdata('user_id');
        			$specific_markup 	= $this->Hotel_Model->getSpecificHotelMarkup($user_id);
        		}
        		$total_price_with_markups = 0;
        		 if (isset($admin_markup) || isset($specific_markup)){
        				if (!empty($specific_markup)) {
        					if ($specific_markup[0]['markup_on'] == 'Percentage') {
        						$specific_markup_price = $specific_markup[0]['markup_value'];
        					} else {
        						$specific_markup_price = $specific_markup[0]['markup_value'];
        					}
        					$total_price_with_markups = $specific_markup_price;
        				} elseif ($admin_markup != '') {
        					if ($admin_markup[0]['markup_on'] == 'Percentage') {
        						$admin_markup_price = $admin_markup[0]['markup_value'];
        					} else {
        						$admin_markup_price = $admin_markup[0]['markup_value'];
        					}
        					$total_price_with_markups = $admin_markup_price;
        				}
        			}
        		
        		list($from_amt, $to_amt) 	= explode('-',$data['amount']);
        		$from_amt 					= (int) trim(str_replace(BASE_CURRENCY,'', $from_amt));
        		$to_amt  					=  (int) trim( str_replace(BASE_CURRENCY,'', $to_amt));
        		$amount_filter['total_cost >=']  = ($from_amt-$total_price_with_markups); 
        		$amount_filter['total_cost <=']  = $to_amt;
        		$hotel_name 				= isset($data['hotel_name']) ?  $data['hotel_name'] : NULL;
        		$star_rating 				= (isset($data['starrate']) && count($data['starrate']) > 0) ?  $data['starrate'] : NULL;
        		$accommodation 				= (isset($data['accommodation']) && count($data['accommodation']) > 0) ?  $data['accommodation'] : NULL;
        		$ammenities = (isset($data['facility']) && count($data['facility']) > 0) ?  $data['facility'] : NULL;
        		$cond = array('amount_filter' => $amount_filter , 
        					  'hotel_name' => $hotel_name,
        					  'sort_col' => $data['sort']['column'],
        					  'sort_val' => $data['sort']['value'],
        					  'star_rating' => $star_rating,
        					  'accommodation' => $accommodation,
        					  'ammenities' => $ammenities
        					  ); 
        	}
        	// debug($cond);
        	// exit;
        	 $config = array();
            $config['base_url'] =$_SERVER["HTTP_REFERER"];
            $config['total_rows'] =$this->Hotel_Model->get_last_response_count_page($session_id,$cond);
            $config['per_page'] = 1000;
            $config['enable_query_strings'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tagl_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tagl_close'] = '</li>';
            $config['first_tag_open'] = '<li class="page-item disabled">';
            $config['first_tagl_close'] = '</li>';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tagl_close'] = '</a></li>';
            $config['attributes'] = array('class' => 'page-link');
    		$this->pagination->initialize($config);
    // 		$page = (isset($_GET['hotel_name']))?$this->input->get('page',1):1;
    		$data['links'] = $this->pagination->create_links();  
        	$data['photeldesc'] 				= 	$this->Hotel_Model->get_last_response_count($session_id,$cond,$config['per_page'],0); 
        	 //echo $this->db->last_query();exit;
        	$hotel_filter['result'] 			= 	$data['photeldesc'];
        	$response 							= 	$this->calculateHotelMarkup($hotel_filter); 
        	$data['photeldesc']					=  	$response['result'];
        	$total_result_count					= 	count($data['photeldesc']);
        	$data['total_result_count'] = $total_result_count;
        	$ajax_page 							= 	$this->load->view(PROJECT_THEME.'/hotel/ajax_result',$data,true);


        	$usd_min_val						= 	$response['result'][0]->low_cost;
        	$usd_max_val						= 	$response['result'][(count($data['photeldesc'])-1)]->max_cost;
        	print json_encode(array(
        		'hotel_search_result' 			=> $ajax_page,
        		'total_result_count' 			=> $total_result_count,
        		'min_val'						=> $usd_min_val,
        		'max_val' 						=> $usd_max_val
        	));
        }
        
        
        public function calculateHotelMarkup($response){
           if (!empty($response['result'])) {
        		for ($i = 0; $i < count($response['result']); $i++) {
        			$original_price 		= $response['result'][$i]->total_cost;
        			$admin_markup 			= $this->Hotel_Model->getAdminGenericHotelMarkup();
                    $original_price1=$original_price/100;
                    //$toltal10=$original_price1*$admin_markup[0]->markup_value;
        			//$specific_markup 		= array();
                    //debug($original_price);exit();
                    //$admin_markup           = array();
        			if ($this->session->userdata('user_id')!='') {
        				$user_id = $this->session->userdata('user_id');
        				$specific_markup 	= $this->Hotel_Model->getSpecificHotelMarkup($user_id);
        			}
        			
        		    if (isset($admin_markup) || isset($specific_markup)){
        				if (!empty($specific_markup)) {
        					if ($specific_markup[0]['markup_on'] == 'Percentage') {
        						$specific_markup_price = $original_price * ($specific_markup[0]['markup_value'] / 100);
        					} else {
        						$specific_markup_price = $specific_markup[0]->markup_value;
        					}
        					$total_price_with_markups = $specific_markup_price;
        				} elseif ($admin_markup != '') {
        					if ($admin_markup[0]->markup_value) {
        						$admin_markup_price = $original_price1*$admin_markup[0]->markup_value;
        					} else {
        						$admin_markup_price = $admin_markup[0]->markup_fixed;
        					}
        					$total_price_with_markups = $admin_markup_price;
        				}
        			}
                    //debug($admin_markup_price);exit();
        
        			$totalPrice = $total_price_with_markups + $original_price + $agent_markup_price;
        		//	echo $agent_markup_price.'<br>'; echo $original_price.'<br>'; echo $total_price_with_markups.'<br>'; exit;
        			$response['result'][$i]->markup 	= $total_price_with_markups;
        			$response['result'][$i]->low_cost =	$response['result'][$i]->room_cost = $response['result'][$i]->total_cost = $original_price; //$totalPrice
        		}
        		return $response;
        	}
    } 
    
    // public function filter_hotel_result()
    // {
    //      $name=$this->input->post('name');
    //      $data = $this->Hotel_Model->searchName($name);
	   //  print_r($data);
    // }
    
    
}

?>
