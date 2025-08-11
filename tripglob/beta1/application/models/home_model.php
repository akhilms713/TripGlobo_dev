<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_Model extends CI_Model {

	public function get_airport_list($query){
        if(strlen($query) == 3){
            $cityCode = strtoupper($query);
            $this->db->where('airport_code', $query);
            $result = $this->db->get('iata_airport_list');
            if($result->num_rows() > 0){
                return $result;
            } else {
                $this->db->like('airport_city', $query);
                $this->db->or_like('country', $query);
                $this->db->limit(7);
                return $this->db->get('iata_airport_list');
            }
        } else  {
            $this->db->like('airport_city', $query);
            $this->db->or_like('airport_code', $query); 
            $this->db->or_like('country', $query);
            $this->db->limit(7);
            return $this->db->get('iata_airport_list');
        }
    }
    
    	public function get_promo_list()
	{
		//$this->db->select('*')->from('promo');

		$execute_query = $this->db->query('select * from promo where status="ACTIVE" && user_type="2"');

		//$query = $this->db->get();
		if ( $execute_query->num_rows > 0 ) 
		{
			return $execute_query->result();	
		}
		else
		{
			return '';	
		}
	}
	
	public function get_api_credentials($api){
		$this->db->where('api_name', $api);
		$this->db->where('status', 'ACTIVE');
		return $this->db->get('api');
	}
	
		function home_banners(){
		$this->db->select('*');
		$this->db->from('banner_details');
		$this->db->where('banner_type','MAIN_BANNER');
		$this->db->where('status', 'ACTIVE');
		$this->db->order_by('position','asc');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

        function get_flight_data(){
        $this->db->select('*');
        $this->db->from('flight_deals');
        $this->db->where('deal_status', 'ACTIVE');
        $this->db->order_by("flight_deal_id", "desc");
        $query=$this->db->get();
        if($query->num_rows() ==''){
            return '';
        }else{
            return $query->result();
        }
       }

       function get_hotal_data(){
        $this->db->select('*');
        $this->db->from('last_minute_deals');
        $this->db->where('status', 'ACTIVE');
        $this->db->order_by("last_minute_deals_id", "desc");
        // $this->db->order_by('rand()');
        // $this->db->limit(4);

        $query=$this->db->get();
        if($query->num_rows() ==''){
            return '';
        }else{
            return $query->result();
        }
       }



	function home_Inner_banners(){
		$this->db->select('*');
		$this->db->from('banner_details');
		$this->db->where('banner_type','INNER_BANNER');
		$this->db->where('status', 'ACTIVE');
		$this->db->order_by('position','asc');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

    function class_name(){
        $this->db->select('*');
        $this->db->from('class_control');
        $this->db->where('status','ACTIVE');
        //$this->db->order_by('class_name','asc');
        $query=$this->db->get();
        if($query->num_rows() ==''){
            return '';
        }else{
            return $query->result();
        }
    }

    function advertisement(){
        $this->db->select('*');
        $this->db->from('advertise_detail');
        $this->db->where('advertise_status','ACTIVE');
        $this->db->order_by('id', 'RANDOM');
        //$this->db->order_by('class_name','asc');
        $query=$this->db->get();
        if($query->num_rows() ==''){
            return '';
        }else{
            return $query->row();
        }
    }

    // function subscribeSave($input){
    //     $this->db->insert('subscriber',$input);
    //     return ($this->db->affected_rows() != 1) ? false : true;
    // }
    function subscribeSave($sub_mail){ 
        $data = array(
                'subscriber_email' => $sub_mail,
                'subscriber_status' =>'ACTIVE'
        );
        // debug($data);exit;
        $res = $this->db->insert('subscriber',$data);
        return $res;
    }
	
	function footer_details(){
		$this->db->select('*');
		$this->db->from('footer_details');
		$this->db->where('status', 'ACTIVE');
		$this->db->order_by('position','asc');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	function social_links(){
		$this->db->select('*');
		$this->db->from('social_link_details');
		$this->db->where('status', 'ACTIVE');
		$this->db->order_by('position','asc');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
		function advertise_sect(){
		$this->db->select('*');
		$this->db->from('advertise_detail');
		$this->db->where('advertise_status', 'ACTIVE');
		$this->db->order_by('position','asc');
		// $this->db->limit(2,0);
		$query=$this->db->get();
		//echo $this->db->last_query();
		//exit;
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	
	
	public function PercentageToAmount($total,$percentage){

		$amount = ($percentage/100) * $total;

		$total = number_format(($total+$amount) ,2,'.','');

		return $total;

	}
	public function currency_convertor_v1($amount){

		if($this->display_currency === BASE_CURRENCY){

    		$amount = $amount*1;

    		return number_format(($amount) ,2,'.','');

    	}else{

    		$amount = ($amount)*($this->curr_val);

    		return number_format(($amount) ,2,'.','');

    	}

	}

	public function currency_convertor($amount,$from,$to){
    	$from = strtoupper($from);
        $to = strtoupper($to);
    	//$this->db->select('value');
    	if($from === $to){
    		$amount = $amount/1;
    		return number_format(($amount) ,2,'.','');
    	}else{
            $this->db->where('currency_code',$from);
            $price = $this->db->get('currency_list')->row();
            $value = $price->value;
    		$amount = ($amount)/($value);
            return number_format(($amount) ,2,'.','');
    	}
    }
	public function getNationalityCountries() {
		$this->db->order_by('country_name', 'asc');
		//echo "<pre>"; print_r($this->db->get('country')); echo "</pre>"; die();
		return $this->db->get('country_list');
	}
	 public function get_hotel_cities_list_old($term){
		$this->db->like('city', $term, 'after');
        $this->db->group_by("city_code");
        $this->db->order_by("city", "asc");
        $this->db->limit(10);
        return $this->db->get('city_code_amadeus');
	}
	
	public function get_hotel_cities_list($term){
		$this->db->like('city_name', $term, 'after');
        $this->db->order_by("city_name", "asc");
        $this->db->limit(10);
        return $this->db->get('all_api_city_master');
	}

    public function get_top_destionation()
    {
        $this->db->select('*');
        $this->db->order_by("position");
        $this->db->from("last_minute_deals");
        $this->db->where("status","ACTIVE");
         // $this->db->limit(6);
        $query=$this->db->get();
            return $query->result();
    }
    public function get_best_destionation()
    {
        $this->db->select('*');
        $this->db->order_by("position");
        $this->db->from("last_besthotel_deals");
        $this->db->where("status","ACTIVE");
         $this->db->limit(4);
        $query=$this->db->get();
            return $query->result();
    }
    public function get_top_deals()
    {
        $this->db->select('*');
         $this->db->order_by("position");
         $this->db->where("status","ACTIVE");
        $this->db->from("top_deals");
         $this->db->limit(4);
        $query=$this->db->get();
            return $query->result();
    }
    public function get_promo_deals(){
        $this->db->select('*');
       
        $this->db->where("status","ACTIVE");
        $this->db->from("promo");
        $this->db->limit(6);
        $query=$this->db->get();
        return $query->result_array();
    }
    public function get_flight_deals()
    {
        $this->db->select('*');       
        $this->db->from("flight_deals");
        $this->db->where("deal_status","ACTIVE");
        //$this->db->limit(4);
        $query=$this->db->get();
            return $query->result();
    }
    public function get_topairliners(){
         $this->db->select('*');       
        $this->db->from("airline_list");
        $this->db->where("status",ACTIVE);
         $this->db->limit(15);
        $query=$this->db->get();
            return $query->result();
    }
    public function bestairline_list(){
         $this->db->select('*');       
        $this->db->from("bestairline_list");
        $this->db->where("status",ACTIVE);
         $this->db->limit(4);
        $query=$this->db->get();
            return $query->result();
    }
   
    function checkSubscriberisRegistered($email_id)
    { 
        $this->db->select('*');
        $this->db->from('subscriber');
        $this->db->where('subscriber_email',$email_id);
        $query = $this->db->get();
        if ($query->num_rows > 0){
             return $query->row();
        }
    }
    
    public function insert_subscriber($data)
    {
        $this->db->insert("subscriber",$data);
        return true;
    }
	


      public function get_flight_dealsbyid($id)
    {
        $this->db->select('*');       
        $this->db->from("flight_deals");
        $this->db->where("flight_deal_id",$id);
        $query=$this->db->get();
        return $query->result();
    }


    public function get_last_dealsbyid($deal_id)
    {
        $this->db->select('*');       
        $this->db->from("last_minute_deals");
        $this->db->where("last_minute_deals_id",$deal_id);
        $query=$this->db->get();
        return $query->result();
    }
    
     public function all_airliners()
    {
        $this->db->select('*');       
        $this->db->from("airline_list");
        $this->db->order_by("airline_name","asc");
        $query=$this->db->get();
        return $query->result();
    }

    function get_page_content($id)
    { 
        $this->db->select('*');
        $this->db->from('static_pages');
        $this->db->where('slug',$id);
        $this->db->where('status',1);
        $query = $this->db->get();
       // echo $this->db->last_query(); exit();
        if ($query->num_rows > 0){
             return $query->row();
        }
    }
    
    function get_footer_content($id)
    { 
        $this->db->select('*');
        $this->db->from('footer_data');
        $this->db->where('footer_data_id',$id);
        $this->db->where('status','ACTIVE');
        $query = $this->db->get();
        if ($query->num_rows > 0){
             return $query->row();
        }
    }

    function get_knowledge_content($id)
    { 
        $this->db->select('*');
        $this->db->from('knowledge_base');
        $this->db->where('status','ACTIVE');
        $query = $this->db->get();
        if ($query->num_rows > 0){
             return $query->result_array();
        }
    }


    function get_holiday_types_list($holiday_type_id = '') 
    {
        $this->db->select('*');
        $this->db->from('holiday_type');
        $this->db->where('status',"ACTIVE");
        $this->db->order_by('holiday_type_name','asc');
        if ($holiday_type_id != '')
            $this->db->where('holiday_type_id', $holiday_type_id);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }    

    function get_holiday_types_list_index($holiday_type_id = '') 
    {
        $this->db->select('*');
        $this->db->from('holiday_details');
        $this->db->where('top_holiday',"1");
        $this->db->where('status',"ACTIVE");
        if ($holiday_type_id != '')
            $this->db->where('holiday_types', $holiday_type_id);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    } 
    function active_home_module_list(){
		$this->db->select('section_name');
        $this->db->where('status','ACTIVE');
		$this->db->from('home_management');		
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

     public function get_news_detail(){
        $this->db->select('*');
       
        $this->db->where("status","ACTIVE");
        $this->db->from("news");
      //  $this->db->limit(2);
        $query=$this->db->get();
        return $query->result_array();
    }
	
      public function get_faq_detail(){
        $this->db->select('*');
        $this->db->where("status","ACTIVE");
        $this->db->from("faq");
      //  $this->db->limit(2);
        $query=$this->db->get();
        return $query->result_array();
    }
    
}

?>
