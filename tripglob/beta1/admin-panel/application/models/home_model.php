<?php
class Home_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	public function getAirportcitylist($key){
          if(strlen($key)==3){
			$this->db->select('city_code');
            $this->db->where('city_code',$key);
            $this->db->limit('1'); 
			$query = $this->db->get('iata_airport_list');   
			
			/*if(strlen($key)>3){
             $where="airport_name like '".$key."%'";
             $query = $this->db->query('select * from iata_airport_list where '.$where);   
			}*/
          if($query->num_rows() > 0){
            return $query->result();
          }
	  }
    }
    public function getAirportcodelist($key){
          if(strlen($key)==3){
		   $this->db->select('*');
           $this->db->where('airport_code',$key);
           $query = $this->db->get('iata_airport_list');   
           }
           if(strlen($key)>3){
             $where="airport_city like '".$key."%'";
             $query = $this->db->query('select * from iata_airport_list where '.$where);   
			}
			#echo $this->db->last_query();
         if($query->num_rows() > 0){
            return $query->result();
          } 
    }
    public function getAirportlist($key){
          $sqlDestinations ="select airport_name,airport_id,city_code,airport_code,country,airport_city from iata_airport_list where city_code='$key'";
          $query = $this->db->query($sqlDestinations);
          if($query->num_rows() > 0){
            return $query->result();
          }
    }
	public function get_overall_sales($cond = array(),$cols = '*')
	{
		$status = FALSE;
		if(count($cond > 0))
		{
			$this->db->where($cond);
		}

		$this->db->select($cols);
		$this->db->join('product','product.product_id=booking_global.product_id');
		$this->db->join('booking_payment','booking_payment.payment_id=booking_global.payment_id');
		$result = $this->db->get('booking_global');
		if($result->num_rows() > 0 )
		{
			$status = $result->result();
		}
		
		return $status ;

	}
	public function overall_booking_reports($user_type='')
	{
		//echo $user_type;
		if($user_type!='' && $user_type!='all')
		{
			$user_type_v = ' and ut.`user_type_name` = "'.$user_type.'"';
		}
			$res = $this->db->query('select pd.product_name as product_name, count(pd.product_name) as product_count, sum(bt.total_amount) as total_amount , min(bt.total_amount) as min_total_amount, max(bt.total_amount) as max_total_amount, avg(bt.total_amount) as avg_total_amount from `booking_global` bg,booking_transaction bt, product pd, user_type ut where bg.booking_transaction_id = bt.booking_transaction_id and  bg.user_type_id = ut.user_type_id and pd.status = "ACTIVE" and bg.`product_id` = pd.product_id '.$user_type_v.' group by pd.product_id ORDER BY `product_count` DESC');
 
			
	if ($res->num_rows() > 0) 
				{
					return $res->result();
				}
				else
				{
					return '';	
				}
	}
	public function get_country_details()
	{
		$this->db->select('*')->from('country_list');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) 
		{
			return $query->result();	
		}
		else
		{
			return '';	
		}
	}
		public function profit_sales($user_type='')
	{
		//echo $user_type;
		if($user_type!='' && $user_type!='all')
		{
			$user_type_v = ' and ut.`user_type_name` = "'.$user_type.'"';
		}
			$res = $this->db->query('select pd.product_name as product_name, count(pd.product_name) as product_count, sum(bt.total_amount) as total_amount ,
			sum(bt.agent_markup) as markup_amount ,	
			 min(bt.total_amount) as min_total_amount, max(bt.total_amount) as max_total_amount, avg(bt.total_amount) as avg_total_amount from `booking_global` bg,booking_transaction bt, product pd, user_type ut where bg.booking_transaction_id = bt.booking_transaction_id and  bg.user_type_id = ut.user_type_id and bg.`product_id` = pd.product_id '.$user_type_v.' group by pd.product_id ORDER BY `product_count` DESC');
 
			
	if ($res->num_rows() > 0) 
				{
					return $res->result();
				}
				else
				{
					return '';	
				}
	}
	public function overall_users($status='')
	{
		//echo $user_type;
		
		$this->db->select(' count(user_type.user_type_id) as user_count, user_type.*');
		$this->db->join('user_login_details','user_type.user_type_id=user_login_details.user_type_id');
		$this->db->join('user_details','user_details.user_id=user_login_details.user_id');
		$this->db->where('user_type.status',"ACTIVE");
		if($status!='' && $status!='all')
		{
				$this->db->where('user_details.status',$status);
			//$status = ' and ud.`status` = "'.$user_type.'"';
		}
		$this->db->group_by('user_type.user_type_name');
		$result = $this->db->get('user_type');
		
		//	$res = $this->db->query('select  ut.user_type_name,  count(uld.user_login_details_id) as user_count from user_type ut,`user_login_details` uld, user_details ud where  ut.user_type_id = uld.user_type_id  and uld.user_id = ud.user_id    '.$status.' group by ud.user_id ');
 
		//	echo $this->db->last_query();
	if ($result->num_rows() > 0) 
				{
					return $result->result();
				}
				else
				{
					return '';	
				}
	}
	public function overall_booking_reports_($product, $user_type=''){
		 $sql  = "select product_name from product";
		 $query1 = $this->db->query($sql);
		 if($query1->num_rows() > 0){
			  $product_result = $query1->result();
		 }
		 if(count($product_result) > 0){
			 $subqry = "";
			 for($p = 0; $p < count($product_result); $p++){
				 $subqry .= 'sum(if(pd.product_name = "'.$product_result[$p]->product_name.'", 1 ,0)) as '.$product_result[$p]->product_name.'count,
			   
		sum(if(pd.product_name = "'.$product_result[$p]->product_name.'" and bg.booking_transaction_id = bt.booking_transaction_id, bt.total_amount,0)) as  '.$product_result[$p]->product_name.'total_amount,' ; 
			 }
		 }
		 
		 $subqry = substr($subqry,0, -1);
		 
		
		 
		 $res = $this->db->query('select pd.product_name as product_name, 
		 '.$subqry.'
		
		from `booking_global` bg,booking_transaction bt, product pd 
		where bg.booking_transaction_id = bt.booking_transaction_id and  bg.`product_id` = pd.product_id  
		 
			group by  pd.product_id');
 
	//	$this->db->where('booking_global.product_id', $product);
	 echo $this->db->last_query();exit;
			if ($res->num_rows() > 0) 
			{
				return $res->result();
			}
			else
			{
				return '';	
			}
 
	}
	public function get_products()
	{
			$res = $this->db->query('select * from product');
			if ($res->num_rows() > 0) 
			{
				return $res->result();
			}
			else
			{
				return '';	
			}
 
	}
function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
}
	public function get_api_details()
	{
		$this->db->select('*')->from('api');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) 
		{
			return $query->result();	
		}
		else
		{
			return '';	
		}
	}
	 public function update_api_status($id,  $status)
   	{
		$data = array(
			'status' => mysql_real_escape_string($status)
			
			);
		
			$where = "api_id = '$id'";
		if ($this->db->update('api', $data, $where)) {
			return true;
		} else {
			return false;
		}
   }
    public function update_api_details($api_id, $username,$password,$tbranch,$url1,$url2)
   	{
		$data = array(
			'username' => $username,
			'password' => $password,
			'username1' => $tbranch,
			'url1' => $url1,
			'url2' => $url2
			
			);
		
			$where = "api_id = '$api_id'";
		if ($this->db->update('api', $data, $where)) {
			return true;
		} else {
			return false;
		}
   }
   function get_api_list_id($id)
	{
		
		$this->db->select('*')
		->from('api')
		->where('api_id',$id)
		;
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
	}

	public function update_admin($cond = array() , $data = array())
	{
		$this->db->where($cond);
		if($this->db->update('admin_details',$data))
		{
			return true;	
		}
		return false;
		
	}
	public function update_users($cond = array() , $data = array())
	{
		$this->db->where($cond);
		if($this->db->update('user_details',$data))
		{
			return true;	
		}
		return false;
		
	}
	public function getFlightLatMonthDetails($post_data){
	   // $sql = "SELECT * FROM booking_global where date_format(voucher_date,'%m-%Y') = '".date('m-Y')."'";
	   if(($post_data['from_date']!='') && ($post_data['to_date']!='')){
	      $sql = "SELECT * FROM booking_global where voucher_date >= '".$post_data['from_date']."' AND voucher_date < '".$post_data['to_date']."'"; 
	   }else{
	      $sql = "SELECT * FROM booking_global where date_format(voucher_date,'%m-%Y') = '".date('m-Y')."'"; 
	   }
   	    return $this->db->query($sql)->result_array();
	}
	
}
