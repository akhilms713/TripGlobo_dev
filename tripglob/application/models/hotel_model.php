<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel_Model extends CI_Model {
function __construct() {
// Call the Model constructor
parent::__construct();

}

        public function save_tbo_results($result, $request, $session_id, $api_id)
	    {
	    	// debug($session_id);exit;
	        $postdata = json_decode(base64_decode($request));
	        
	        //echo '<pre>';print_r($postdata);exit(' nidhi singh');
	        
	        $diff = date_diff(date_create($postdata->checkin),date_create($postdata->checkout));
	        $total_nights = $diff->format('%a');
	        //$total_nights = $postdata->days;
	    	$i  = 0;
	       foreach ($result as $val) { 
	        //echo $total_nights;exit();
	        
	        $TotalPrice = $val['display_fare'];
	        $user_id = $this->session->userdata('user_id');
            $user_type = $this->session->userdata('user_type');
            if ($user_type==1) {            	
            $generic_markup_B2B = $this->get_markup_B2B('GENERAL', $user_type); //B2B
            $agent_markup = $this->get_markup_B2B_agent($user_id); //B2B
            	if ($agent_markup=='') {
             $agent_markup = $this->get_markup_B2B_agent($user_id); //B2B
            	// code...
            }
            if ($generic_markup_B2B=='') {
            $generic_markup_B2B = $this->get_markup_B2B('GENERAL', $user_type); //B2B
            	// code...
            }
            }elseif ($user_type==4) {
            	$generic_markup_B2B = $this->get_markup_B2B('GENERAL', $user_type); 
            	if ($generic_markup_B2C=='') {
            $generic_markup_B2B = $this->get_markup_B2B('GENERAL', $user_type); 
            	// code...
            }
            }else{
            // $generic_markup_B2B = $this->get_markup_B2B('GENERAL', $user_type); //B2B
            $generic_markup_B2C = $this->get_markup_B2C('GENERAL', '2'); //B2C
            if ($generic_markup_B2C=='') {
            $generic_markup_B2C = $this->get_markup_B2C('GENERAL', '2'); //B2C
            	// code...
            }
            // debug($generic_markup_B2C);exit;

            }
            $agent_markup_price = 0;
            if ($user_type == 1 ||$user_type == 4) {
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
                        $agent_markup_price = $this->PercentageToAmount($TotalPrice+$admin_markup, $percentage);
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
            // $Final_price = $TotalPrice + $admin_markup + $TotalTax;
            // echo $TotalTax."dsd";
            // $agent_markup = $this->get_agent_markup($user_id);
	        // echo '<pre>';print_r($result);exit(' nidhi singh');
            $Final_price = $TotalPrice + $admin_markup + $agent_markup_price;
	         //echo $TotalPrice."<br>"; echo $admin_markup."<br>"; echo $agent_markup_price."<br>"; echo $Final_price."<br>"; die;
	        
	        
	            $data[$i]['session_id']        = $session_id;
	            $data[$i]['hotel_code']        = $val['hotel_code'];
	            $data[$i]['ResultIndex']       = $val['ResultIndex'];
	            $data[$i]['hotel_id']          = '';//$val['hotel_id'];
	            $data[$i]['api']               = $api_id;
	            $data[$i]['request']           = serialize($request);
	            $data[$i]['HotelName']         = $val['hotel_name'];
	            $data[$i]['URL']               = $val['primary_image'];
	            $data[$i]['total_nights']      = $total_nights;
	            $data[$i]['total_cost']        = $Final_price;
	            $data[$i]['servicefee']        = $val['service_charge'];
	            $data[$i]['net_cost']          = 0;
	            $data[$i]['admin_markup']      = $admin_markup;
	            $data[$i]['agent_markup']      = $agent_markup_price;
	            $data[$i]['admin_baseprice']   = 0;
	            $data[$i]['currency']          = BASE_CURRENCY;
	            $data[$i]['xml_currency']      = $val['currency'];
	            $data[$i]['status']            = '';
	            $data[$i]['room_count']        = $postdata->rooms;;
	            $data[$i]['RoomRateDescription_Text'] = $val['description'];
	            $data[$i]['AddressLine']       = $val['address'];
	            $data[$i]['star_rating']       = $val['star_rating'];
	            $data[$i]['city']              = $val['destination_name'];
	            $data[$i]['Latitude']          = $val['lat'];
	            $data[$i]['Longitude']         = $val['lon'];
	            $data[$i]['total_room']        = $postdata->rooms;
	            $data[$i]['HotelAmenity']      = json_encode($val['facility']);
	            $data[$i]['images']            = json_encode($val['image']);
	            $data[$i]['search_id']            = json_encode($val['search_id']);
	            $data[$i]['TraceId']            = json_encode($val['TraceId']);
	            $data[$i]['TokenId']            = json_encode($val['TokenId']);
	            $data[$i]['EndUserIp']            = json_encode($val['EndUserIp']);
	        // echo "<pre>"; print_r($data[$i]); exit;
	            $this->db->insert('api_hotel_details', $data[$i]);
	            $i++;
	        }
	        // if ($data != "") {
	        //     $this->db->insert_batch('api_hotel_details', $data);
	        // }
	        
	    }
	       public function PercentageToAmount($total, $percentage) {

        $amount = ($percentage / 100) * $total;
        $perc_amount = $amount;

        //echo "percamounta".$perc_amount;exit();
        return $perc_amount;
    }
 
	    public function fetch_search_result($ses_id, $api, $page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='',$hotel_name_vals='',$hotel_loc_vals='',$place_val2='')
	    {
	    // $this->db->reconnect();	
		$display_perpage 	= 700;
		$start_pos			= $display_perpage * ($page);
		$where 				= '';
// debug($start_pos);exit;
	
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}

		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
			switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.HotelName_en, low_cost ASC';
				break;
			case 'name_desc':
				$order = 'ORDER BY p.HotelName_en DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = '';
				break;
			case 'star_desc':
				$order = '';
				break;
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
			}
		}

		if(isset($_SESSION['hotel_name'])){
			$where.= " AND p.HotelName_en LIKE '%".$_SESSION['hotel_name']."%'";	
		}
	
		$where.= "";
		// $select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_details t WHERE t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order limit 700";
		$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_details t WHERE t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order limit 700 OFFSET $start_pos";
		$query = $this->db->query($select);
		if ( $query->num_rows > 0 ) {
				$data['result'] = $query->result();
				$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
				$count = $count->result();
				$data['totRow'] = $count[0]->rowcount;
			if (empty($fac)) {
				$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
					SELECT MIN(t.total_cost) as low_cost FROM api_hotel_details t WHERE t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab limit 700 OFFSET $start_pos";
			} else {
				$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
					SELECT MIN(t.total_cost) as low_cost FROM api_hotel_details t WHERE t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab limit 700 OFFSET $start_pos";
			}
		
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
            
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			
		// debug($data);exit;
			return $data;
		}
      return false;
	}
    public function fetch_search_result_row($sessionId){
		$this->db->select('*');
		$this->db->where('session_id',$sessionId);
		$query = $this->db->get('api_hotel_details');
		return $num = $query->num_rows();
		// debug($num);exit;
    }
    public function insLogsHistory($data){
    $this->db->insert('logs_history', $data);
    return $this->db->insert_id();
    }
    public function updLogsHistory($data,$ins_id){
        $this->db->where('id',$ins_id);
        $this->db->update('logs_history', $data);
    }
    public function checkLogsHistory($search_id,$type){
        $query = 'SELECT * FROM logs_history WHERE search_id="'.$search_id.'" AND type="'.$type.'"';
        return $this->custom_db->get_result_by_query($query);
    }
    public function getSearchHistory($search_id){
        $search_query = 'SELECT * FROM search_history WHERE origin="'.$search_id.'"';
        return $this->custom_db->get_result_by_query($search_query);
    }
    
    public function get_hotel_cost($hotel_code,$sessionId){
    	$this->db->select_min('total_cost');
    	$this->db->from('api_hotel_details');
    	$this->db->where('hotel_code', $hotel_code);
    	$this->db->where('session_id', $sessionId);
    	$query = $this->db->get();
    	if ($query->num_rows() == '') {
    	return '';
    	} else {
    	return $query->result();
    	}
    }
    
    public function get_hotel_other_details($hotel_code,$sessionId)
    {
        $this->db->select('*');
    	$this->db->from('api_hotel_details');
    	$this->db->where('hotel_code', $hotel_code);
    	$this->db->where('session_id', $sessionId);
    	$query = $this->db->get();
    	if ($query->num_rows() == '') {
    	return '';
    	} else {
    	return $query->result_array();
    	}
    }
    
    function add_cart_details_hotel($cart_data) {
       $this->db->empty_table('cart_hotel');
       $this->db->empty_table('cart_global');
	   if($this->session->userdata('user_id')){
			$cart_data['user_type'] = $user_type = $this->session->userdata('user_type');
			$cart_data['user_id'] = $user_id = $this->session->userdata('user_id');
		}else{
			$cart_data['user_type'] = B2C_USER;
			$cart_data['user_id'] = '';
		}
		
		$this->db->insert('cart_hotel',$cart_data);
        $cart_hotel_id = $this->db->insert_id();
		
        $cart_global = array(
				'parent_cart_id' => 0,
				'referal_id' => $cart_hotel_id,
				'product_id' => '2',
				'user_type' => $user_type,
				'user_id' => $user_id,
				'session_id' => $cart_data['session_id'],
				'site_currency' => BASE_CURRENCY,
				'total_cost' => $cart_data['total_amount'],
				'admin_markup' => $cart_data['admin_markup'],
				'agent_markup' => $cart_data['agent_markup'],
				'ip_address' =>  $this->input->ip_address(),
				'bundle_search_id' => '',
				'timestamp' => date('Y-m-d H:i:s')
			);
			
			$this->db->insert('cart_global',$cart_global);
            $cart_global_id = $this->db->insert_id();
        
        $this->db->query("UPDATE cart_hotel SET parent_cart_id='$cart_global_id' WHERE cart_hotel_id='$cart_hotel_id'"); 
        
        $cdata['cart_hotel_id']      = $cart_hotel_id;
        $cdata['shopping_global_id'] = $cart_global_id;
        $cdata['cart_status']        = 1;
        $cdata['isCart']             = true;
        $cdata['C_URL']              = WEB_URL . 'booking/' . $cart_data['session_id'];
        
        return $cdata;
    }
    
    function getAdminGenericHotelMarkup(){
    	$this->db->select('*'); 	
    	$this->db->from('markup_details');
        $this->db->where('markup_type','GENERAL');
        $this->db->where('product_details_id','2'); 	
    	//$this->db->join('product','product.product_id =markup.product','left'); 
    	//$this->db->where('product.product_name', 'HOTEL'); 
    	//$this->db->where('product_details.markup_type', 'GENERIC'); 
    	$query = $this->db->get('');
    	if ($query->num_rows() == '') {
    	return '';
    	} else {
    	return $query->result();
    	}	
    }
    
    function getSpecificHotelMarkup($user_id){
    	$this->db->select('*'); 	
    	$this->db->from('markup'); 	
    	$this->db->join('product','product.product_id =markup.product','left'); 
    	$this->db->where('product.product_name', 'HOTEL'); 
    	$this->db->where('markup.markup_type', 'SPECIFIC'); 
    	$this->db->where('markup.user_id', $user_id); 
    	$query = $this->db->get('');
    	if ($query->num_rows() == '') {
    	return '';
    	} else {
    	return $query->result_array();
    	}	
    }
    
    
function get_last_response_count($session_id,$cond = array(),$limit=1000000, $start=0){
    $this->db->select('api_hotel_details.*, MIN(api_hotel_details.total_cost) as low_cost, MAX(api_hotel_details.total_cost) as max_cost');
    $this->db->from('api_hotel_details');
	$this->db->where('api_hotel_details.session_id',$session_id);
    if(count($cond) > 0)
    {
        $this->db->where($cond['amount_filter']);
        if($cond['hotel_name'] != NULL )
        {
            $this->db->like('api_hotel_details.HotelName', trim($cond['hotel_name']));
        }
        
        if($cond['star_rating'] !== NULL &&  count($cond['star_rating']) > 0 )
        {
           for($s=0; $s < count($cond['star_rating']); $s++){
				if($s==0){
					$this->db->like('api_hotel_details.star_rating', $cond['star_rating'][$s]);
				} else {
					$this->db->or_like('api_hotel_details.star_rating', $cond['star_rating'][$s]);
				}
		   }
        } 
        
        if($cond['sort_col'] !== NULL &&  $cond['sort_val']	!== NULL)
        {
        $this->db->order_by($cond['sort_col'],$cond['sort_val']);
		}
		 else
		{
        $this->db->order_by('low_cost','asc');
		}
        # next condition
    }
    else
    {
        $this->db->order_by('low_cost','asc');
    }
    $this->db->group_by('api_hotel_details.hotel_code');
    $this->db->limit($limit, $start);
	$query = $this->db->get();
	//echo $this->db->last_query(); exit;
	if ($query->num_rows() == '') {
	return '';
	} else {
	return $query->result();
	}
}
function get_last_response_count_page($session_id,$cond = array()){
    $this->db->select('api_hotel_details.*, MIN(api_hotel_details.total_cost) as low_cost, MAX(api_hotel_details.total_cost) as max_cost');
    $this->db->from('api_hotel_details');
	$this->db->where('api_hotel_details.session_id',$session_id);
    if(count($cond) > 0)
    {
        $this->db->where($cond['amount_filter']);
        if($cond['hotel_name'] != NULL )
        {
            $this->db->like('api_hotel_details.HotelName', trim($cond['hotel_name']));
        }
        
        if($cond['star_rating'] !== NULL &&  count($cond['star_rating']) > 0 )
        {
           for($s=0; $s < count($cond['star_rating']); $s++){
				if($s==0){
					$this->db->like('api_hotel_details.star_rating', $cond['star_rating'][$s]);
				} else {
					$this->db->or_like('api_hotel_details.star_rating', $cond['star_rating'][$s]);
				}
		   }
        } 
        
        if($cond['sort_col'] !== NULL &&  $cond['sort_val']	!== NULL)
        {
        $this->db->order_by($cond['sort_col'],$cond['sort_val']);
		}
		 else
		{
        $this->db->order_by('low_cost','asc');
		}
        # next condition
    }
    else
    {
        $this->db->order_by('low_cost','asc');
    }
    $this->db->group_by('api_hotel_details.hotel_code');
    
	$query = $this->db->get();
	return $query->num_rows();

}
    function get_agent_markup($user_id) {
        $this->db->select('*');
        $this->db->from('user_markup');
        $this->db->where('user_id', $user_id);
        $this->db->where('product_id', 1);
        $query = $this->db->get();
        //  echo $this->db->last_query(); exit;
        if ($query->num_rows() != '') {
            $result = $query->result();
            return $result;
        } else {
            return false;
        }
    }
    
    function get_markup_B2C($markup_type, $B2C) {
        $this->db->select('*');
        //$this->db->from('air_coun_dest_markup');
        $this->db->from('markup_details');
        
        $this->db->where('markup_type', $markup_type);
        $this->db->where('user_type_id', $B2C);
        /*    if ($api_id != '') {
          $this->db->where('api_details_id',$api_id);
          } */
        $this->db->where('product_details_id', 2);
        $this->db->where('status', 'ACTIVE');
        $query = $this->db->get();
        //     echo $this->db->last_query();exit;      
        if ($query->num_rows() != '') {
            $result = $query->result();
            return $result;
        } else {
            return false;
        }
    }

    function get_markup_B2B($markup_type, $B2B) {
        $this->db->select('*');
        $this->db->from('markup_details');
        $this->db->where('markup_type', $markup_type);
        $this->db->where('user_type_id', $B2B);
        /*    if ($api_id != '') {
          $this->db->where('api_details_id',$api_id);
          } */
        $this->db->where('product_details_id', 2);
        $this->db->where('status', 'ACTIVE');
        $query = $this->db->get();
        if ($query->num_rows() != '') {
            $result = $query->result();
            return $result;
        } else {
            return false;
        }
    }

function get_markup_B2B_agent($user_id){
	 $this->db->select('*');
        $this->db->from('user_markup');
        $this->db->where('product_id', 2);
        $this->db->where('user_id', $user_id);
       
        $query = $this->db->get();
        if ($query->num_rows() != '') {
            $result = $query->result();
            return $result;
        } else {
            return false;
        }
}
// function get_last_response_counts_pages1($session_id,$cond = array()){
//     $this->db->select('api_hotel_details.*, MIN(api_hotel_details.total_cost) as low_cost, MAX(api_hotel_details.total_cost) as max_cost');
//     $this->db->from('api_hotel_details');
// 	$this->db->where('api_hotel_details.session_id',$session_id);
//     if(count($cond) > 0)
//     {
//         $this->db->where($cond['amount_filter']);
//         if($cond['hotel_name'] != NULL )
//         {
//             $this->db->like('api_hotel_details.HotelName', trim($cond['hotel_name']));
//         }
        
//         if($cond['star_rating'] !== NULL &&  count($cond['star_rating']) > 0 )
//         {
//           for($s=0; $s < count($cond['star_rating']); $s++){
// 				if($s==0){
// 					$this->db->like('api_hotel_details.star_rating', $cond['star_rating'][$s]);
// 				} else {
// 					$this->db->or_like('api_hotel_details.star_rating', $cond['star_rating'][$s]);
// 				}
// 		   }
//         } 
        
//         if($cond['sort_col'] !== NULL &&  $cond['sort_val']	!== NULL)
//         {
//         $this->db->order_by($cond['sort_col'],$cond['sort_val']);
// 		}
// 		 else
// 		{
//         $this->db->order_by('low_cost','asc');
// 		}
//         # next condition
//     }
//     else
//     {
//         $this->db->order_by('low_cost','asc');
//     }
//     $this->db->group_by('api_hotel_details.hotel_code');
    
// 	$query = $this->db->get();
// 	return $query->num_rows();

// }

// public function searchName($query)
// 	{
// 	    $raw_search_chars = '"'.$query.'"';
// 		$sql = 'select * from api_hotel_details where `HotelName` like "%'.$query.'%" LIMIT 0, 10';
// 		$result_to = $this->db->query($sql);
// 		return  json_encode($result_to->result());
// 	}
public function get_hotel_other_details_acount($parent_pnr){
	return $this->db->get_where('booking_hotel',array('parent_pnr'=>$parent_pnr))->row();
}

}

?>
