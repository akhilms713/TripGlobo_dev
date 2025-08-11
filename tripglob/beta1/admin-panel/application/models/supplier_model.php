<?php
Class Supplier_Model extends CI_Model
{
	/**
	 *verify is the user credentials are valid
	 *
	 *@param string $email    email of the user
	 *@param string @password password of the user
	 *
	 *return boolean status of the user credentials
	 */
	 
	/* menu list model starts */	
	function hotel_review_count($vId)
	{
		$query="select count(VendorID) as count from hotel_reviews where VendorID='$vId'";
		$results=$this->db->query($query);
		return $results;	 
	}
	function bookingDetail()
	{
		$this->db->select('bookingDetials.id,bookingDetials.bookingId,bookingDetials.hotelName,bookingDetials.guestName,bookingDetials.checkIn,bookingDetials.checkOut,bookingDetials.baseFare,bookingDetials.bookingDate,bookingDetials.bookingDate,bookingDetials.status');
		$this->db->from('bookingDetials');
		$this->db->join('crs_hotel_supplier_details', 'crs_hotel_supplier_details.hotel_id = bookingDetials.id');
		$this->db->where('crs_hotel_supplier_details.supplier_id',$this->entity_user_id);
		$query = $this->db->get();
		return $query;
	}
	function crsbookingDetail($hot_id)
	{
		$session_id=$this->session->userdata('AID');
		$this->db->select('*');
		$this->db->from('booking_crs_global');
		$this->db->join('booking_crs_hotel', 'booking_crs_global.pnr_no =booking_crs_hotel.pnr_no ');
		$this->db->join('crs_hotel_supplier_details', 'crs_hotel_supplier_details.hotel_name = booking_crs_hotel.hotel_name');
	   	$this->db->where('crs_hotel_supplier_details.supplier_id',$session_id);
/*		$this->db->where('booking_crs_hotel.hotel_code',$hot_id);*/
		$this->db->where('booking_crs_global.payment_status','Pending');
		$this->db->where('booking_crs_global.booking_status','PROCESS');
		/*$this->db->from('booking_transaction_details');
		$this->db->join('booking_hotelinfo', 'booking_transaction_details.hotel_booking_id = booking_hotelinfo.hotel_booking_info_id');
		$this->db->like('booking_transaction_details.booking_number','CRS',both);
		$this->db->where('booking_transaction_details.prn_no != ','');
		$this->db->where('booking_transaction_details.prn_no != ','');
		$this->db->where('booking_hotelinfo.supplier_id',$this->entity_user_id);*/
		
		$query = $this->db->get();
		//~ echo $this->db->last_query();exit;
		return $query;
	}
	public function hotels()
	{
        $SessionDetails = $this->session->all_userdata();
       // echo "<pre>";  print_r($SessionDetails); exit();
        $SupplierId= $this->session->userdata('admin_id');
       // echo $SupplierId;exit();
		$this->db->where('supplier_id',$SupplierId);
		//$StatusArray=array('Active','Inactive');
		//$this->db->where_in('status',$StatusArray);
		$Hotels = $this->db->get('crs_hotel_supplier_details')->result_array();
		//echo $this->db->last_query();exit;
	     //echo "<pre>"; print_r($Hotels); exit();
		return $Hotels;
	}
	/* menu list model ends */
	
	/* Tax setting model starts */
	
	function supplierListing()
	{
		$hotel=$this->session->userdata('hotel');
		$this->db->select('*');
		$this->db->where('supp_id',$this->entity_user_id);
		$this->db->where('hotel_id',$hotel);
		$query = $this->db->get('supplier_tax');
		return $query;
	}
	function checkExist($tax_type)
	{
		$hotel=$this->session->userdata('hotel');
		$query="select count(tax_id) as count from supplier_tax where supp_id='$this->entity_user_id' and tax_type='$tax_type' and hotel_id='$hotel'";
		$results=$this->db->query($query);
		return $results;
	}
	
	function supplier_tax_type()
	{
		$this->db->select('*');
		$this->db->where('status','Active');
		$query = $this->db->get('supplier_tax_type');
		//echo "<pre>"; print_r($query); exit;
		return $query;
	}
	/* Tax setting model ends */
	
	/* Cancellation policy model starts */
	
	function cancellation_policyListing()
	{ 
		$this->db->select('*');
		$this->db->where('supplier_id',$this->entity_user_id);
		$this->db->order_by('sequence', 'asc'); 
		$query = $this->db->get('policies');
		return $query;
	}
	function cancellation_policies($hot_id)
	{
		$this->db->select('*');
		$this->db->where('cp_hotel_id',$hot_id);
		$this->db->where('cp_supplier_id',$this->entity_user_id);
		$this->db->order_by('cp_id', 'asc'); 
		$query = $this->db->get('cancelation_policies');
		return $query;
	}
public function city_name_with_id($city)
	{
		$this->db->where('city_id',$city);
		$CityIdRow=$this->db->get('crs_cities')->row();
		return $CityIdRow->city_name;
	}
        public function get_city_name_with_id($city)
	{
		$this->db->where('city_id',$city);
		$CityIdRow=$this->db->get('crs_cities')->row();
		return $CityIdRow->city;
	}
	public function country_name_with_id($country)
	{
		$this->db->where('country_id',strtoupper($country));
		$CountryIdRow=$this->db->get('crs_countries')->row();
		return $CountryIdRow->country_name;
	}
public function HotelStatus($Status,$Hotel)
	{
		switch ($Status) {
			case 'Delete':
					$this->db->where('hotel_id',$Hotel);
                    $this->db->delete('crs_hotel_supplier_details');
                    
					// $UpdateData = array(
					// 	               'status' => 'Deleted'
					// 	            );
					//$this->db->update('crs_hotel_supplier_details',$UpdateData);
					//$this->db->where('id', $id);
				break;

			case 'Activate':
					$UpdateData = array(
						               'status' => 'Active'
						            );
					$this->db->where('hotel_id',$Hotel);
					$this->db->update('crs_hotel_supplier_details',$UpdateData);
				break;

			case 'Inactive':
					$UpdateData = array(
						               'status' => 'Inactive'
						            );
					$this->db->where('hotel_id',$Hotel);
					$this->db->update('crs_hotel_supplier_details',$UpdateData);
				break;
		}
	}
	function crs_room_type_detail()
	{
        $SessionDetails = $this->session->all_userdata();
		$hot_id=$SessionDetails['hotel'];
		$data['session_data']=$hot_id;	
		$this->db->distinct();
		$this->db->select('room_name');
		$this->db->where('hotel_id',$hot_id);
		$query = $this->db->get('crs_room_type_detail');
		return $query;
	}
	
	function crs_room_type_id_detail()
	{
        $SessionDetails = $this->session->all_userdata();
		$hot_id=$SessionDetails['hotel'];
		$data['session_data']=$hot_id;	
		$this->db->distinct();
		$this->db->select('room_name,room_type_id');
		$this->db->where('hotel_id',$hot_id);
		$query = $this->db->get('crs_room_type_detail');
		return $query;
	}
	
	function stopsales()
	{
        $SessionDetails = $this->session->all_userdata();
		$hot_id=$SessionDetails['hotel'];
		$this->db->where('ss_hotel_id',$hot_id);
		$query = $this->db->get('crs_stop_sales');
		return $query;		
	}
	
	function addstopsales($newstopsales)
	{
		$this->custom_db->insert_record('crs_stop_sales',$newstopsales);	
	}
	
	/* Cancellation policy model ends */
	
	/*locatorsListing model starts */
	
	function locatorsListing()
	{
		$this->db->select('*');
		$this->db->where('supplier_id',$this->entity_user_id);
		$query = $this->db->get('locators');
		return $query;
	}
	function locator_type()
	{
		$this->db->select('*');
		$this->db->where('status','active');
		$query = $this->db->get('locator_type');
		return $query;
	}
	function city()
	{
		$this->db->select('city');
		$query = $this->db->get('lcities');
		return $query;
	}
	/*locatorsListing model ends */
	
	/*attractionListing model starts */
	function attractionListing()
	{
		$this->db->select('*');
		$this->db->where('supplier_id',$this->entity_user_id);
		$query = $this->db->get('attractions');
		return $query;
	}
	/*attractionListing model ends */
	
	/*bank_accountListing model starts */
	function bank_accountListing()
	{
		$this->db->select('*');
		$this->db->where('supplier_id',$this->entity_user_id);
		$query = $this->db->get('bank_details');
		return $query;
	}
	/*bank_accountListing model ends */
	
	/* User Review model starts */
	function user_reviewListing()
	{
		$this->db->select('*');
		$this->db->where('supplier_id',$this->entity_user_id);
		$query = $this->db->get('bank_details');
		return $query;
	}
	
	/* User Review model ends */
	/* change password starts */
	function selectPassword()
	{
		$this->db->select('password');
		$this->db->where('supplier_id',$this->entity_user_id);
		$query = $this->db->get('crs_supplier_login');
		return $query;
	}
	function changePassword($newPassword)
	{
		
		$data = array(
               'password' => $newPassword
				);
		$this->db->where('supplier_id',$this->entity_user_id);
		$this->db->update('crs_supplier_login', $data); 
	}
	/* change password ends */
	
	/* rate manager starts */
	function  selectRoomType($inventory = '')
	{
		$SessionDetails = $this->session->all_userdata();
		$hot_id=$SessionDetails['hotel']; 
		$data['session_data']=$hot_id;		
		$this->db->select('crs_room_type_detail.*,crs_room_type.room_type_name');
		$this->db->from('crs_room_type_detail');
		$this->db->join('crs_room_type', 'crs_room_type_detail.room_type_id = crs_room_type.room_type_id');
		//crs_hotel_supplier_details getting supplier wise table
		if($inventory != ''){
			$startDate= date('Y-m-d');
			$sdate = strtotime($startDate);
			$endDate = date('Y-m-d',strtotime("+13 day", $sdate));
			$condtion=array('crs_room_type_detail.sdate <= ' => $startDate,'crs_room_type_detail.edate >= ' => $endDate);
			$this->db->where($condtion);
		}
		if($inventory == '')
			//echo $hot_id; exit;
			// $this->db->where('crs_room_type_detail.hotel_id',$hot_id);
			
		$this->db->group_by('crs_room_type_detail.room_type_id');
		$query = $this->db->get();
		
		return $query;
	}
	/*
	 * 
	 * 
	 */



	function getInventRange($condtion,$hot_id='',$startDate,$endDate)
	{

		
		$this->db->select('crs_room_type_detail.*,crs_room_type.room_type_name,crs_cutt_off_dates.*');
		$this->db->from('crs_room_type_detail');
		$this->db->join('crs_room_type', 'crs_room_type_detail.room_type_id = crs_room_type.room_type_id');
		$this->db->join('crs_cutt_off_dates', 'crs_room_type_detail.hotel_id = crs_cutt_off_dates.co_hotel');


		$this->db->where('crs_room_type_detail.edate >=',$startDate);
		$this->db->where('crs_room_type_detail.sdate <=',$endDate);
		$this->db->where($condtion);


		if($hot_id!=''){
			$this->db->where('crs_room_type_detail.hotel_id',$hot_id);	
		}
		$this->db->group_by('crs_room_type_detail.room_type_id');
		$query = $this->db->get()->result_array();


		  // echo "<pre>".$this->db->last_query();exit;

		return $query;
	}











	
	
	
	function selectPropertyName($id)
	{
        $SessionDetails = $this->session->all_userdata();
		$hot_id=$SessionDetails['hotel'];
		$data['session_data']=$hot_id;	
		$this->db->distinct();
		$this->db->select('crs_room_type_detail.packege_id,hour_package.package_name');
		$this->db->from('crs_room_type_detail');
		$this->db->join('hour_package', 'crs_room_type_detail.packege_id = hour_package.id');
		$this->db->where('crs_room_type_detail.room_type_id',$id);
		$this->db->where('crs_room_type_detail.hotel_id',$hot_id);
		$query = $this->db->get();
		return $query;
	}
	
	function selectRateManagerCount($hid,$rn,$rt_id,$date)
	{
		$this->db->select('crs_rate_manager.id');
		$this->db->from('crs_rate_manager');
		$this->db->where('crs_rate_manager.hotel_id',$hid);
		$this->db->where('crs_rate_manager.packege_id',$rn);
		$this->db->where('crs_rate_manager.room_type_id',$rt_id);
		$this->db->where('crs_rate_manager.date',$date);
		$query=$this->db->get();
		return $query;
	}
	/* rate manager ends */
	
	/* booking model starts */
	
	
	/* booking model ends */
	
	function dotw_country_nationalitycode()
	{
		$this->db->select('country_name,country_code');
		//$this->db->distinct('country_name');
		$this->db->from('dotw_nationality');
		$this->db->order_by("country_name", "asc");
		$query = $this->db->get();
		if($query->num_rows() =='')
		{
			return '';
		}
		else
		{
			return $query->result();
		}
	}
	
	function get_market_details($market)
	{
		$this->db->from('crs_markets');
		$this->db->where("market_id", $market);
		$this->db->order_by("market_id", "asc");
		$marketsdetails = $this->db->get()->result();
		return $marketsdetails;
	}
	
	function get_all_markets()
	{
		$this->db->from('crs_markets');
		$this->db->order_by("market_id", "asc");
		$allmarkets = $this->db->get()->result();
		return $allmarkets;
	}
	
	function crs_discount_types()
	{
		$this->db->from('discount_types');
		$this->db->where('dt_status',1);
		$this->db->order_by("dt_id", "asc");
		$discount_types = $this->db->get();
                //echo $this->db->last_query();
		return $discount_types;
	}
	
	function crs_active_discounts_old()
	{
		$this->db->from('discounts');
		$this->db->where("d_status", "Active");
		$this->db->order_by("d_id", "desc");
		$discounts = $this->db->get();
		return $discounts;
	}

	function crs_active_discounts($hotel_id)
	{
		$this->db->from('discounts');
		$this->db->where("d_status", "Active");
		$this->db->where('dis_hotel_id',$hotel_id);
		$this->db->order_by("d_id", "desc");
		$discounts = $this->db->get();
		return $discounts;
	}

	
	function add_discount_type($discounts)
	{
		$this->custom_db->insert_record('discounts',$discounts);
		echo $this->db->last_query();
	}
	
	function get_cut_off_dates($hot_id)
	{
		$this->db->where('co_hotel',$hot_id);
		$cdates=$this->db->get('crs_cutt_off_dates')->result();
		return $cdates;
	}
	
	function delete_cut_off($co_id)
	{
		$this->db->where('co_id',$co_id);
		$this->db->delete('crs_cutt_off_dates');
	}
	public function getvoucher($id)
	{
		$this->db->select('*');
		$this->db->from('booking_transaction_details');
		$this->db->where('transaction_details_id',$id);
		$this->db->join('booking_hotelinfo', 'booking_transaction_details.hotel_booking_id = booking_hotelinfo.hotel_booking_info_id'); 
		$this->db->join('booking_customer_details', 'booking_transaction_details.customer_contact_details_id = booking_customer_details.customer_info_details_id');
		$query = $this->db->get();
		// echo $this->db->last_query(); exit;
		if ($query->num_rows() == 0)
		{
			return "No Booking Records Found";
		}
		else
		{
			return $query->row();
		}
	}
	public function passagerdetail($passangerid)
	{
		$this->db->select('*');
		$this->db->from('booking_customer_details');
		$this->db->where('customer_info_details_id',$passangerid);
		$this->db->or_where('parent_id',$passangerid);
				
		$query = $this->db->get();
		// echo $this->db->last_query(); exit; 
		if ($query->num_rows() == 0)
				{
			return "No Booking Records Found";
		}
		else
		{
			return $query->result();
		}
	}
	public function get_hotel_address($api,$hotel)
	{
		switch ($api)
			{
				case 'TSHP':
					$this->db->select('address,city,phone,email');
					$this->db->where('hotel_code',$hotel);
					return $this->db->get('TSHP_permanent')->result_array();

				case 'TSHB':
					$this->db->select('address,city,phone,email');
					$this->db->where('hotel_code',$hotel);
					return $this->db->get('TSHB_permanent')->result_array();

				case 'CRS':
					$this->db->select('hotel_address as address,city_name as city,contact_email as email,mobile_no as phone');
					$this->db->where('hotel_id',$hotel);
					return $this->db->get('crs_hotel_supplier_details')->result_array();
			}
			// echo $this->db->last_query(); exit;
	}

   /* public function b2c_Bookings(){
    	$SessionDetails = $this->session->all_userdata();
        $SupplierId=$SessionDetails['AID'];
		$this->db->join('booking_customer_details','booking_customer_details.customer_info_details_id=booking_crs_global.leadpax','left');
		$this->db->join('booking_hotelinfo','booking_hotelinfo.customer_contact_details_id=booking_customer_details.customer_info_details_id','left');
        $this->db->like('booking_no','CRS','both');
		$this->db->order_by('booking_crs_global.voucher_date','DESC');
		$Hotels = $this->db->get('booking_crs_global')->result_array();
		// echo $this->db->last_query();exit;
		return $Hotels;
    } */
    public function get_email_acess()
    {
      $this->db->select('*')
        ->from('email_access');
      $query = $this->db->get();
      if ( $query->num_rows > 0 ) {
       return $query->row();
      }
      return false;
    }
  //  public function b2c_Bookings(){
  //   	$SessionDetails = $this->session->all_userdata();
  //       $SupplierId=$SessionDetails['AID'];
       
  //       $where  = array('booking_crs_global.API'=>'CRS','booking_crs_global.module'=>'HOTEL','booking_crs_global.user_type'=> '3');
  //       $or_where  = array('booking_crs_global.user_type'=> '4');  
  //               $this->db->select('booking_crs_global.pnr_no,booking_crs_global.booking_no,booking_crs_global.amount,booking_crs_global.transaction_id,booking_crs_global.transaction_status,'
  //                       . 'booking_crs_global.payment_status,booking_crs_global.ref_id,booking_crs_global.booking_status,booking_crs_global.check_in,'
  //                       . 'booking_crs_global.check_out,b2c.email,booking_crs_global.voucher_date,booking_crs_global.leadpax,booking_crs_hotel.room_count');
  //               $this->db->join('b2c','booking_crs_global.user_id = b2c.user_id','inner');
  //               $this->db->join('booking_crs_hotel','booking_crs_global.parent_pnr = booking_crs_hotel.id','inner');
                
               
  //               $this->db->where($where);
  //               $this->db->or_where($or_where);
  //                $this->db->order_by('booking_crs_global.voucher_date','DESC'); 
		// $Hotels = $this->db->get('booking_crs_global')->result_array();
		 
		// return $Hotels;
  //   }

    public function b2c_Bookings(){
    	$SessionDetails = $this->session->all_userdata();
        $SupplierId=$SessionDetails['AID'];
       
        $where  = array('booking_crs_global.API'=>'CRS','booking_crs_global.module'=>'HOTEL','booking_crs_global.user_type'=> '3');
        $or_where  = array('booking_crs_global.user_type'=> '4');  
                $this->db->select('booking_crs_global.pnr_no,booking_crs_global.booking_no,booking_crs_global.amount,booking_crs_global.transaction_id,booking_crs_global.transaction_status,'
                        . 'booking_crs_global.payment_status,booking_crs_global.ref_id,booking_crs_global.booking_status,booking_crs_global.check_in,'
                        . 'booking_crs_global.check_out,b2c.email,booking_crs_global.voucher_date,booking_crs_global.leadpax,booking_crs_hotel.room_count');
                $this->db->join('b2c','booking_crs_global.user_id = b2c.user_id','inner');
                $this->db->join('booking_crs_hotel','booking_crs_global.parent_pnr = booking_crs_hotel.id','inner');
                
               
                $this->db->where($where);
                $this->db->or_where($or_where);
                 $this->db->order_by('booking_crs_global.voucher_date','DESC'); 
		$Hotels = $this->db->get('booking_crs_global')->result_array();
		 //echo $this->db->last_query();exit;
		return $Hotels;
    }

    public function rating_data($from,$to,$mode)
    { 
        $supplier_id=$this->session->userdata('AID');
        $where1="(`booking_crs_global`.`reviews` != '' or `booking_crs_global`.`user_rating` != 0 )";
        $where = "(`booking_hotelinfo`.`$mode`>='$from' and `booking_hotelinfo`.`$mode`<='$to')";
        $this->db->select('booking_hotelinfo.check_in,booking_hotelinfo.check_out,booking_hotelinfo.voucher_date,
        	                booking_crs_global.pnr_no,booking_crs_global.user_rating,booking_crs_global.reply,booking_crs_global.reviews,
        	                booking_customer_details.first_name,crs_room_type_detail.room_name,booking_customer_details.emailid');
        $this->db->join('booking_customer_details','booking_crs_global.leadpax=booking_customer_details.customer_info_details_id');
        $this->db->join('booking_transaction_details','booking_transaction_details.transaction_details_id=booking_crs_global.ref_id');
        $this->db->join('booking_hotelinfo','booking_hotelinfo.hotel_booking_info_id=booking_transaction_details.hotel_booking_id');
        $this->db->join('crs_room_type_detail','crs_room_type_detail.id = booking_hotelinfo.room_type');
        $this->db->where('`booking_hotelinfo`.`supplier_id`',$supplier_id);
        $this->db->where($where);
        $this->db->where($where1);
        $res= $this->db->get('booking_crs_global'); 
        return $res->result();  
    }

    public function check_reply($pnr)
    {
       $this->db->select('reply');
       $this->db->where('pnr_no',$pnr);
       $res=$this->db->get('booking_crs_global');
       
       if($res->num_rows >0)
        {
          $re=$res->result();
           
             if($re[0]->reply=='')
              { 
            	return 0;
              }
             else
             { 
               return 1;  
             }  	
       }
      else
      {
      	return 0;
      }  
           
    }

   public function reply_to_customer($pnr,$reply)
     {   
   	   $arr=array('reply'=>$reply);
   	   $this->db->where('pnr_no',$pnr);

       return $resp= $this->db->update('booking_crs_global',$arr);
 
     }
  

    public function get_email_credential()
     {
        $res = $this->db->get('email_access');
        return $res->row();
     }
       
    public function send_reply($to,$msg,$email_conf,$subject)
    {
       
        
        $this->load->library('email');
        $config['protocol'] = 'mail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';  


            $config['protocol'] = $email_conf->smtp;
            $config['smtp_host'] = $email_conf->host;
            $config['smtp_port'] = $email_conf->port;
            $config['smtp_user'] = $email_conf->username;
            $config['smtp_pass'] = $email_conf->password;
            $config['mailtype'] = 'html';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
        
	        $this->email->initialize($config);
	        $this->email->set_newline("\r\n");
	        $this->email->from('Set My Journey');
	        $this->email->to($to);
	        
	        $this->email->subject($subject);
	        $this->email->message($msg);
       
	        if($this->email->send())
	        {
	           //	echo $this->email->print_debugger();
	          return 1;  
	        } 
	        else
	        {
	        	return 0 ;
	        }
         
         

    } 


   


      public function all_replied_nonreplyed()
    { 
        $supplier_id=$this->session->userdata('AID');
        $where1="(`booking_crs_global`.`reviews` != ' ' or `booking_crs_global`.`user_rating` != 0 )";
        
        $this->db->select('booking_hotelinfo.check_in,booking_hotelinfo.check_out,booking_hotelinfo.voucher_date,
        	                booking_crs_global.pnr_no,booking_crs_global.user_rating,booking_crs_global.reply,booking_crs_global.reviews,
        	                booking_customer_details.first_name,crs_room_type_detail.room_name,booking_customer_details.emailid');
        $this->db->join('booking_customer_details','booking_crs_global.leadpax=booking_customer_details.customer_info_details_id');
        $this->db->join('booking_transaction_details','booking_transaction_details.transaction_details_id=booking_crs_global.ref_id');
        $this->db->join('booking_hotelinfo','booking_hotelinfo.hotel_booking_info_id=booking_transaction_details.hotel_booking_id');
        $this->db->join('crs_room_type_detail','crs_room_type_detail.id = booking_hotelinfo.room_type');
        $this->db->where('supplier_id',$supplier_id);
      
        $this->db->where($where1);
        $res= $this->db->get('booking_crs_global'); 
        return $res->result();  
    } 



    public function getting_info($pnr)
    {
        

        $this->db->select('booking_hotelinfo.hotel_name,booking_hotelinfo.cancellation_policy,booking_hotelinfo.check_in,booking_hotelinfo.check_out,booking_hotelinfo.voucher_date,
        	                booking_hotelinfo.hotelrooms,booking_crs_global.pnr_no,booking_crs_global.user_rating,booking_crs_global.reply,booking_crs_global.reviews,
        	                booking_customer_details.first_name,crs_room_type_detail.room_name,booking_customer_details.emailid');
        
        $this->db->join('booking_customer_details','booking_crs_global.leadpax=booking_customer_details.customer_info_details_id');
        $this->db->join('booking_transaction_details','booking_transaction_details.transaction_details_id=booking_crs_global.ref_id');
        $this->db->join('booking_hotelinfo','booking_hotelinfo.hotel_booking_info_id=booking_transaction_details.hotel_booking_id');  
        $this->db->join('crs_room_type_detail','crs_room_type_detail.id = booking_hotelinfo.room_type');
        $this->db->where('pnr_no',$pnr);
        $res=$this->db->get('booking_crs_global');
        return $res->result();

    }
    
    public function inventory_percentage($status=''){
   		//select IF(SUM(allocation) IS NULL,0, SUM(allocation)) as count from crs_room_type_detail where 
   		//status=1 and sdate >= curdate() and edate >= (DATE_ADD(curdate(), INTERVAL 30 DAY))
    	
    	if($status == ''){
    		$condition = array('sdate >= '=> date('Y-m-d'),'edate >= '=> date('Y-m-d', strtotime("+30 days"))); 
    	}else{
    		$condition = array('status'=>1,'sdate >= '=> date('Y-m-d'),'edate >= '=> date('Y-m-d', strtotime("+30 days")) ); 
    	}
    	$this->db->select('IF(SUM(allocation) IS NULL,0, SUM(allocation)) as count',false);
    	$this->db->where($condition);
    	$res=$this->db->get('crs_room_type_detail');
    	$data=$res->result_array();
   		return $data[0]['count'];
    }


    public function yesterday_booking()
    {
           $yest=date('Y-m-d',time() - 60 * 60 * 24); 
	
		$this->db->select('booking_transaction_details.prn_no,`booking_hotelinfo`.`check_in`,`booking_hotelinfo`.`check_out`,`booking_hotelinfo`.`voucher_date`,`booking_hotelinfo`.`hotelrooms`,`crs_room_type_detail`.`room_name`');
		$this->db->from('booking_transaction_details');
		$this->db->join('booking_hotelinfo', 'booking_transaction_details.hotel_booking_id = booking_hotelinfo.hotel_booking_info_id');
		$this->db->join('crs_room_type_detail','crs_room_type_detail.id = booking_hotelinfo.room_type');
		$this->db->like('booking_transaction_details.booking_number','CRS',both);
		$this->db->where('booking_transaction_details.prn_no != ','');
		$this->db->where('booking_hotelinfo.supplier_id',$this->entity_user_id);
		$this->db->where('`booking_hotelinfo`.`check_in`',$yest);
		$query = $this->db->get();
		//~ echo $this->db->last_query();exit;
		return $query;
	}


    public function today_booking()
    {
           $today=date('Y-m-d'); 
	
		$this->db->select('booking_transaction_details.prn_no,`booking_hotelinfo`.`check_in`,`booking_hotelinfo`.`check_out`,`booking_hotelinfo`.`voucher_date`,`booking_hotelinfo`.`hotelrooms`,`crs_room_type_detail`.`room_name`');
		$this->db->from('booking_transaction_details');
		$this->db->join('booking_hotelinfo', 'booking_transaction_details.hotel_booking_id = booking_hotelinfo.hotel_booking_info_id');
		$this->db->join('crs_room_type_detail','crs_room_type_detail.id = booking_hotelinfo.room_type');
		$this->db->like('booking_transaction_details.booking_number','CRS',both);
		$this->db->where('booking_transaction_details.prn_no != ','');
		$this->db->where('booking_hotelinfo.supplier_id',$this->entity_user_id);
		$this->db->where('`booking_hotelinfo`.`check_in`',$today);
		$query = $this->db->get();
		//~ echo $this->db->last_query();exit;
		return $query;
	}
 
   
    public function tomorrow_booking()
    {
           $tomorrow=date('Y-m-d',time()+(60*60*24)); 
	
		$this->db->select('booking_transaction_details.prn_no,`booking_hotelinfo`.`check_in`,`booking_hotelinfo`.`check_out`,`booking_hotelinfo`.`voucher_date`,`booking_hotelinfo`.`hotelrooms`,`crs_room_type_detail`.`room_name`');
		$this->db->from('booking_transaction_details');
		$this->db->join('booking_hotelinfo', 'booking_transaction_details.hotel_booking_id = booking_hotelinfo.hotel_booking_info_id');
		$this->db->join('crs_room_type_detail','crs_room_type_detail.id = booking_hotelinfo.room_type');
		$this->db->like('booking_transaction_details.booking_number','CRS',both);
		$this->db->where('booking_transaction_details.prn_no != ','');
		$this->db->where('booking_hotelinfo.supplier_id',$this->entity_user_id);
		$this->db->where('`booking_hotelinfo`.`check_in`',$tomorrow);
		$query = $this->db->get();
		//~ echo $this->db->last_query();exit;
		return $query;
	}
   
   public function new_booking()
    {
           $tomorrow=date('Y-m-d',time()+(60*60*24)); 
	
		$this->db->select('booking_transaction_details.prn_no,`booking_hotelinfo`.`check_in`,`booking_hotelinfo`.`check_out`,`booking_hotelinfo`.`voucher_date`,`booking_hotelinfo`.`hotelrooms`,`crs_room_type_detail`.`room_name`');
		$this->db->from('booking_transaction_details');
		$this->db->join('booking_hotelinfo', 'booking_transaction_details.hotel_booking_id = booking_hotelinfo.hotel_booking_info_id');
		$this->db->join('crs_room_type_detail','crs_room_type_detail.id = booking_hotelinfo.room_type');
		$this->db->like('booking_transaction_details.booking_number','CRS',both);
		$this->db->where('booking_transaction_details.prn_no != ','');
		$this->db->where('booking_hotelinfo.supplier_id',$this->entity_user_id);
		$this->db->where('`booking_hotelinfo`.`check_in` > ',$tomorrow);
		$query = $this->db->get();
		//~ echo $this->db->last_query();exit;
		return $query;
	}

   public function no_of_room()
    { 
          $end=date('Y-m-d');
          $start=date('Y-m-d',time()-(7*60*60*24)); 
      $query="select count(id) as no_of_room from booking_crs_global where booking_status='CONFIRMED' and (check_in between '$start' and '$end')";
      return $res=$this->db->query($query);

    }
    
    public function my_bdo($supplier_id)
    {   
        $this->db->select('BDO.bdo_id,BDO.name,BDO.email,BDO.phone');
        $this->db->from('crs_hotel_bdo as BDO');
        $this->db->join('crs_supplier_login as SUP', 'SUP.bdo=BDO.bdo_id', 'inner');
        $this->db->from('crs_supplier_login');
        $this->db->where('SUP.supplier_id', $supplier_id);
        return $this->db->get();
    }

    public function dashboard_offer_discounts()
	{
		$offer_end_date=date('Y-m-d');
		$this->db->from('discounts');
		$this->db->where("d_status", "Active");
		$this->db->where("check_in_to >= ",$offer_end_date);
		$this->db->order_by("d_id", "desc");
		$discounts = $this->db->get();
		return $discounts->result();
	}

	public function revenue()
	{       
         $supplier_id=$this->session->userdata('AID');
         $this->db->select('sum(booking_crs_global.amount) as revenues');
         $this->db->from('booking_crs_global'); 
         $this->db->join('booking_transaction_details','booking_transaction_details.prn_no = booking_crs_global.pnr_no');
         $this->db->join('booking_hotelinfo','booking_hotelinfo.hotel_booking_info_id = booking_transaction_details.hotel_booking_id ');
         $this->db->where('booking_crs_global.booking_status','CONFIRMED');
         $this->db->where('booking_crs_global.module','HOTEL');
         $this->db->where('booking_hotelinfo.supplier_id',$supplier_id);
         $rev=$this->db->get();
         return $rev->result();
         

	}
	
	public function admin_payment_details(){
		$this->db->select('crs_hotel_confirmation.ip as SC_IP,crs_hotel_confirmation.crs_hotel_confirmation_status as SCStatus,crs_hotel_confirmation.created_date as accepted_date,booking_crs_global.*,booking_customer_details.*,booking_hotelinfo.hotel_name,crs_room_type.room_type_name as room_type,booking_hotelinfo.hotelroom_adult as adult,crs_hotel_supplier_details.*,crs_supplier_login.*,CONCAT(booking_customer_details.gender," ",booking_customer_details.first_name," ",booking_customer_details.last_name) as GUEST_NAME',FALSE);
		$this->db->join('booking_crs_global','booking_crs_global.pnr_no=crs_hotel_confirmation.pnr_no');
		$this->db->join('booking_transaction_details','booking_crs_global.ref_id = booking_transaction_details.transaction_details_id');
		$this->db->join('booking_hotelinfo','booking_hotelinfo.hotel_booking_info_id = booking_transaction_details.hotel_booking_id');
		$this->db->join('crs_room_type_detail','crs_room_type_detail.id = booking_hotelinfo.room_type');
		$this->db->join('crs_room_type','crs_room_type_detail.room_type_id = crs_room_type.room_type_id');
		$this->db->join('crs_hotel_supplier_details','crs_room_type_detail.hotel_id=crs_hotel_supplier_details.hotel_id');
		$this->db->join('crs_supplier_login','crs_supplier_login.supplier_id=crs_hotel_supplier_details.supplier_id');
		$this->db->join('booking_customer_details','booking_crs_global.leadpax = booking_customer_details.customer_info_details_id');
		$this->db->where(array('crs_hotel_confirmation.admin_status'=>'PAID'));
		return $this->db->get('crs_hotel_confirmation')->result_array();
	}
	function crs_confirmation_details($data){
		$supplier_id=$this->session->userdata('AID');
		$data=explode(',', $data);
		$this->db->select('crs_hotel_confirmation.ip as SC_IP,crs_hotel_confirmation.crs_hotel_confirmation_status as SCStatus,crs_hotel_confirmation.created_date as accepted_date,booking_crs_global.*,booking_customer_details.*,booking_hotelinfo.hotel_name,crs_room_type.room_type_name as room_type,booking_hotelinfo.hotelroom_adult as adult,crs_hotel_supplier_details.*,crs_supplier_login.*,CONCAT(booking_customer_details.gender," ",booking_customer_details.first_name," ",booking_customer_details.last_name) as GUEST_NAME',FALSE);
		$this->db->join('booking_crs_global','booking_crs_global.pnr_no=crs_hotel_confirmation.pnr_no');
		$this->db->join('booking_transaction_details','booking_crs_global.ref_id = booking_transaction_details.transaction_details_id');
		$this->db->join('booking_hotelinfo','booking_hotelinfo.hotel_booking_info_id = booking_transaction_details.hotel_booking_id');
		$this->db->join('crs_room_type_detail','crs_room_type_detail.id = booking_hotelinfo.room_type');
		$this->db->join('crs_room_type','crs_room_type_detail.room_type_id = crs_room_type.room_type_id');
		$this->db->join('crs_hotel_supplier_details','crs_room_type_detail.hotel_id=crs_hotel_supplier_details.hotel_id');
		$this->db->join('crs_supplier_login','crs_supplier_login.supplier_id=crs_hotel_supplier_details.supplier_id');
		$this->db->join('booking_customer_details','booking_crs_global.leadpax = booking_customer_details.customer_info_details_id');
		$this->db->where(array('crs_hotel_confirmation.supplier_id'=>$supplier_id));
		$this->db->where_in('crs_hotel_confirmation.id',$data);
		return $this->db->get('crs_hotel_confirmation')->result_array();
	}
	function CRS_admin_detials(){
		$supplier_id=$this->session->userdata('AID');
		$this->db->join('admin','admin.user_id=admin_crs_payment_details.admin_id');
		$this->db->where(array('admin_crs_payment_details.supplier_id'=>$supplier_id));
		return $this->db->get('admin_crs_payment_details')->result_array();
	}

public function conference($Status,$conference_id)
	{
		switch ($Status) {
			case 'Delete':
					$UpdateData = array(
						               'conference_hall_status' => 'Deleted'
						            );
					$this->db->where('conference_hall_details_id',$conference_id);
					$this->db->update('conference_hall_details',$UpdateData);
				break;

			case 'Activate':
					$UpdateData = array(
						               'conference_hall_status' => 'Active'
						            );
					$this->db->where('conference_hall_details_id',$conference_id);
					$this->db->update('conference_hall_details',$UpdateData);
				break;

			case 'Inactive':
					$UpdateData = array(
						               'conference_hall_status' => 'Block'
						            );
					$this->db->where('conference_hall_details_id',$conference_id);
					$this->db->update('conference_hall_details',$UpdateData);
				break;
		}
	}
	public function conference_hall_detaillist($supplier_id)
	{
		#$this->db->join('crs_hotel_supplier_details','crs_hotel_supplier_details.hotel_id=conference_hall_details.hotel_id');
		$this->db->where(array('conference_hall_details.supplier_id'=>$supplier_id));
		$this->db->where("conference_hall_details.conference_hall_status IN ('Active', 'Block')");
		return $this->db->get('conference_hall_details')->result_array();		
	}
	public function apartment_detaillist($supplier_id)
	{
		$this->db->where(array('cr_apartment_master.supplier_id'=>$supplier_id));
		$this->db->where("cr_apartment_master.apartment_status IN ('Active', 'Block')");
		return $this->db->get('cr_apartment_master')->result_array();		
	}

	public function Bookings()
	{
		$this->db->select('*');
		$this->db->from("crs_hotel_booking_details");
		$this->db->join('hotel_booking_pax_details', 'crs_hotel_booking_details.app_reference = hotel_booking_pax_details.app_reference');
		$query=$this->db->get();
	//	echo "<pre>";print_r($query->result()); exit();
		if($query->num_rows()){
			return $query->result();
		}else{
			return array();
		}
	}

	public function cityNameByCountry($country_id){

		$this->db->select('*');
		$this->db->from("crs_cities");
		$this->db->where('country_id',$country_id);
		$this->db->order_by('city_name', 'asc'); 
		$query=$this->db->get();

		if($query->num_rows()){
			return $query->result();
		}else{
			return array();
		}
	}



	public function FetchB2cBooking(){
		//need to write
	}


//added extra
	/*public function CRSBookingsNew(){
		$this->db->join('booking_crs_hotel','booking_crs_hotel.ID = booking_crs_global.id');
		$this->db->order_by('booking_crs_global.voucher_date','DESC');
		//$this->db->where('booking_crs_global.user_type',4);
		$Hotels=$this->db->get('booking_crs_global')->result_array();
		return $Hotels;
	}*/

	
	public function CRSBookingsNew($hotel_id){

		//echo "testss".$hotel_id;exit;
	$session_id=$this->session->userdata('AID');
	$this->db->select('booking_crs_global.*,booking_crs_hotel.*');
	$this->db->from('booking_crs_hotel');
	$this->db->join('booking_crs_global', 'booking_crs_global.id = booking_crs_hotel.ID');
	$this->db->join('crs_hotel_supplier_details', 'crs_hotel_supplier_details.hotel_name = booking_crs_hotel.hotel_name');
	 $array=array('booking_crs_hotel.hotel_code'=>$hotel_id,'crs_hotel_supplier_details.supplier_id'=>$session_id);
	$this->db->where($array);
/*
     $this->db->where('booking_crs_hotel.hotel_code =',$hotel_id);*/
	 //$this->db->where('crs_hotel_supplier_details.supplier_id =',$session_id);
/*	$this->db->order_by('booking_crs_global.voucher_date','DESC');	*/	
		
	$query = $this->db->get();
/*	echo $this->db->last_query(); exit();	*/	
		if ( $query->num_rows > 0 )
		{			
			return $query->result_array();			
		}
		else
		{			
			return '';			
		}	
		$affected_rows=$this->db->affected_rows(); 
	}
  function PaymentstatusChange($ref_id,$data)
  {
        $this->db->where('ref_id', $ref_id);
        $this->db->update('booking_crs_global', $data);
  }
  function BookingstatusChange($ref_id,$data)
  {
  	$this->db->where('ref_id',$ref_id);
  	$this->db->update('booking_crs_global',$data);
  }

	public function get_blocked_room($room_id,$hotel_id,$selected_date,$room_no){
		$this->db->select('*');
		$this->db->from("blocked_room_detials");
		$this->db->where('CRS_RTD_ID',$room_id);
		$this->db->where('hotel_id',$hotel_id);
		$this->db->where('blocked_room_date',$selected_date);
		$this->db->where('room_no',$room_no);
		$query=$this->db->get();
		return $query->num_rows();	
	}

	public function insert_blocked_room($room_id,$hotel_id,$selected_date,$room_no){
		$data = array(
        'CRS_RTD_ID' =>$room_id,
        'hotel_id' =>$hotel_id,
        'blocked_room_date' =>$selected_date,
        'room_no'=>$room_no
		);
		if($this->db->insert('blocked_room_detials', $data))
		{
			return 'sucsess';
		}else{
			return 'failed';
		}	
	}

	public function delete_blocked_room($room_id,$hotel_id,$selected_date,$room_no){
		$this->db->where('CRS_RTD_ID', $room_id);
		$this->db->where('hotel_id', $hotel_id);
		$this->db->where('blocked_room_date', $selected_date);
		$this->db->where('room_no', $room_no);
		if($this->db->delete('blocked_room_detials')){
			return 'sucsess';
		}else{
			return 'failed';
		}
	}

	public function get_all_blocked_room_data(){
		$this->db->select('*');
		$this->db->from("blocked_room_detials");
		$query=$this->db->get();
		if($query->num_rows()){
			return $query->result();
		}else{
			return array();
		}	
	}
	public  function Add_markup($data)
    {
		$this->db->insert('markup_crs', $data);   
    } 
    public function get_markup($admin_id)
    {
    	$this->db->select('*');  
    	$this->db->where('admin_id',$admin_id);            
        $query = $this->db->get('markup_crs');
    /*    echo "<pre>r";exit('jithu');*/
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }
    public function get_hotel_name($hotel_id)
    {
    	$this->db->select("hotel_name");
    	$this->db->where('hotel_id',$hotel_id);
    	$query=$this->db->get('crs_hotel_supplier_details');
    	return $query->result();

    }
    public function get_markup_by_id($hotel_id)
    {
    	$this->db->select("markup_type");
    	$this->db->where('hotel_id',$hotel_id);
    	$query=$this->db->get('markup_crs');
    	return $query->row();

    }
  
  
    public function change_status_markup($id,$status)
	{         
		$data['status'] = $status;
	    $this->db->where('id', $id);
		if($this->db->update('markup_crs',$data)){
	    return true;
		}else{
		return false;
	    }
	}
	public function delete_markup($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('markup_crs');
	}
	



	public function get_hotels_markup($id)
	{
		$this->db->select("*");
		$this->db->where('id',$id);
		$query=$this->db->get('markup_crs');
    	return $query->result();

	}
	function get_hotels()
 {
 	  $this->db->select('*');
        $query=$this->db->get('crs_hotel_supplier_details');
        if($query->num_rows()=='')
        {
        	return '';
        }
        else
        {
        	return $query->result();
        }

 }
 function Update_markup($id,$data)
 {
 	$this->db->where('id',$id);
 	$this->db->update('markup_crs',$data);
 }

 function update_hotel_detail_max($data,$id)
	{
		$this->db->where('hotel_id',$id);
		$this->db->update('crs_hotel_supplier_details', $data); 
	}

	function update_hotel_map($data,$id)
	{
		$this->db->where('hotel_id',$id);
		$this->db->update('crs_map', $data); 
	}

	function hotel_status_change($id,$status)
	{
		$data=array('status'=>$status);
		$this->db->where('hotel_id',$id);
		$this->db->update('crs_hotel_supplier_details', $data); 
	}
	function room_status_change($id,$status)
	{
		$data=array('status'=>$status);
		$this->db->where('id',$id);
		if($this->db->update('crs_room_type_detail', $data)){
			return true;
		}else{
			return false;
		} 
	}
	public function room_list_by_hotel_id($id)
	{
		$this->db->select("*");
		$this->db->where('hotel_id',$id);
		$query=$this->db->get('crs_room_type_detail');
    	return $query->result();

	}
	public function room_list_by_room_id($id)
	{
		$this->db->select("*");
		$this->db->where('id',$id);
		$query=$this->db->get('crs_room_type_detail');
    	return $query->result();

	}

	function update_room_data($data,$room_id)
	{
		$this->db->where('id',$room_id);
		if($this->db->update('crs_room_type_detail', $data)){
			return true;
		}else{
			return false;
		} 
	}

	public function room_type_details($room_type_id='')
	{
		$this->db->select("*");
		if($room_type_id!=''){
			$this->db->where('room_type_id',$room_type_id);
		}
		$query=$this->db->get('crs_room_type');
    	return $query->result();
	}
	function room_type_status_change($id,$status)
	{
		$data=array('room_type_status'=>$status);
		$this->db->where('room_type_id',$id);
		if($this->db->update('crs_room_type', $data)){
			return true;
		}else{
			return false;
		} 
	}

	function update_room_type_list($data)
	{
		$arr=array('room_type_name'=>$data['room_name']);
		$this->db->where('room_type_id',$data['room_id']);
		if($this->db->update('crs_room_type', $arr)){
			return true;
		}else{
			return false;
		} 
	}
	public function room_type_details_by_name($name)
	{
		$this->db->select("room_type_name");
		$this->db->where('room_type_name',$name);
		$query=$this->db->get('crs_room_type');
    	return $query->row();
	}
	public function hotel_amenities_list($amenity_id='')
	{
		$this->db->select("*");
		if($amenity_id!=''){
			$this->db->where('amenity_id',$amenity_id);
		}
		$this->db->where('amenity_for','hotel');
		$query=$this->db->get('cr_amenities_master');
    	return $query->result();
	}
	function hotel_amenity_status_change($id,$status)
	{
		$data=array('amenity_status'=>$status);
		$this->db->where('amenity_id',$id);
		if($this->db->update('cr_amenities_master', $data)){
			return true;
		}else{
			return false;
		} 
	}
	public function amenity_details_by_name($name)
	{
		$this->db->select("amenity_name");
		$this->db->where('amenity_name',$name);
		$this->db->where('amenity_for','hotel');
		$query=$this->db->get('cr_amenities_master');
    	return $query->row();
	}
	function update_amenities_list($data)
	{
		$arr=array('amenity_name'=>$data['amenity_name']);
		$this->db->where('amenity_id',$data['amenity_id']);
		if($this->db->update('cr_amenities_master', $arr)){
			return true;
		}else{
			return false;
		} 
	}
	public function room_amenities_list($amenity_id='')
	{
		$this->db->select("*");
		if($amenity_id!=''){
			$this->db->where('amenity_id',$amenity_id);
		}
		$this->db->where('amenity_for','hotel_room');
		$query=$this->db->get('cr_amenities_master');
    	return $query->result();
	}
	public function amenity_details_by_room_name($name)
	{
		$this->db->select("amenity_name");
		$this->db->where('amenity_name',$name);
		$this->db->where('amenity_for','hotel_room');
		$query=$this->db->get('cr_amenities_master');
    	return $query->row();
	}
	public function get_hotel_logo($hotel_id)
	{
		$this->db->select("picture1");
		$this->db->where('hotel_id',$hotel_id);
		$query=$this->db->get('crs_hotel_supplier_details');
    	return $query->row();
	}
	public function get_hotel_images($hotel_id)
	{
		$this->db->select("*");
		$this->db->where('hotel_id',$hotel_id);
		$query=$this->db->get('crs_hotel_image');
    	return $query->result();
	}
	function update_hotel_logo($hotel_id,$newlogoname)
	{
		$arr=array('picture1'=>$newlogoname);
		$this->db->where('hotel_id',$hotel_id);
		if($this->db->update('crs_hotel_supplier_details', $arr)){
			return true;
		}else{
			return false;
		} 
	}

	function insert_hotel_images($hotel_id,$file_name){
		$data = array(
	        'image' => $file_name,
	        'hotel_id' => $hotel_id,
		);

		$this->db->insert('crs_hotel_image', $data);
	}
	public function get_room_images($room_id)
	{
		$this->db->select("*");
		$this->db->where('room_id',$room_id);
		$query=$this->db->get('crs_room_images');
    	return $query->result();
	}
	function insert_room_images($room_id,$file_name){
		$data = array(
	        'room_image' => $file_name,
	        'room_id' => $room_id,
		);

		$this->db->insert('crs_room_images', $data);
	}
	function remove_hotel_images($image_id)
	{
		$this->db->where('id',$image_id);
		$this->db->delete('crs_hotel_image');
	}
	function remove_room_images($image_id)
	{
		$this->db->where('id',$image_id);
		$this->db->delete('crs_room_images');
	}

	function update_crs_markup($data,$hotel_id)
	{
		$this->db->where('hotel_id',$hotel_id);
		if($this->db->update('markup_crs', $data)){
			return true;
		}else{
			return false;
		} 
	}
	function crs_markup_status($id,$status)
	{
		$data=array('status'=>$status);
		$this->db->where('id',$id);
		$this->db->update('markup_crs', $data); 
	}
	public function edit_markup_by_markup_id($markup_id)
	{
		$this->db->select("*");
		$this->db->where('id',$markup_id);
		$query=$this->db->get('markup_crs');
    	return $query->row();
	}
	function update_crs_markup_list($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('markup_crs', $data); 
	}
	function delete_crs_markup_list($markup_id)
	{
		$this->db->where('id',$markup_id);
		$this->db->delete('markup_crs');
	}
	public function edit_markup_by_id($hotel_id)
	{
		$this->db->select("admin_id");
		$this->db->where('hotel_id',$hotel_id);
		$query=$this->db->get('markup_crs');
    	return $query->row();
	}
	public function hotel_type_details($hotel_type_id='')
	{
		$this->db->select("*");
		if($hotel_type_id!=''){
			$this->db->where('hotel_style_id',$hotel_type_id);
		}
		$query=$this->db->get('crs_hotel_style');
    	return $query->result();
	}
	function hotel_type_status_change($id,$status)
	{
		$data=array('hotel_style_status'=>$status);
		$this->db->where('hotel_style_id',$id);
		if($this->db->update('crs_hotel_style', $data)){
			return true;
		}else{
			return false;
		} 
	}
	public function hotel_type_details_by_name($name)
	{
		$this->db->select("hotel_style_name");
		$this->db->where('hotel_style_name',$name);
		$query=$this->db->get('crs_hotel_style');
    	return $query->row();
	}
	function update_hotel_type_list($data)
	{
		$arr=array('hotel_style_name'=>$data['room_name']);
		$this->db->where('hotel_style_id',$data['room_id']);
		if($this->db->update('crs_hotel_style', $arr)){
			return true;
		}else{
			return false;
		} 
	}
	function add_hotel_type_list($content)
	{
 		$data=array('hotel_style_name'=>$content['room_name']);
		$this->db->insert('crs_hotel_style', $data);
	}
	function add_room_type_list($content)
	{
 		$data=array('room_type_name'=>$content['room_name']);
		$this->db->insert('crs_room_type', $data);
	}
	function delete_hotel_type_list($id)
	{
		$this->db->where('hotel_style_id',$id);
		$this->db->delete('crs_hotel_style');
	}
	function delete_room_type_list($id)
	{
		$this->db->where('room_type_id',$id);
		$this->db->delete('crs_room_type');
	}
	function delete_room_amenity($id)
	{
		$this->db->where('amenity_id',$id);
		$this->db->delete('cr_amenities_master');
	}
	function delete_hotel_amenity($id)
	{
		$this->db->where('amenity_id',$id);
		$this->db->delete('cr_amenities_master');
	}
	function add_hotel_amenity($content)
	{
 		$data=array('amenity_name'=>$content['room_name'],'amenity_for'=>'hotel');
		$this->db->insert('cr_amenities_master', $data);
	}
	function add_room_amenity($content)
	{
 		$data=array('amenity_name'=>$content['room_name'],'amenity_for'=>'hotel_room');
		$this->db->insert('cr_amenities_master', $data);
	}
	public function get_blocked_room_data($data)
	{
		$this->db->select("blocked_room_date");
		$this->db->where('hotel_id',$data['hotel_id']);
		$this->db->where('room_id',$data['room_id']);
		$this->db->where('status','1');
		$query=$this->db->get('blocked_room_detials');
    	return $query->result();

	}
	public function get_blocked_room_data_by_hotel_room_id($room_id,$hotel_id){
		$this->db->select("blocked_room_date");
		$this->db->where('hotel_id',$hotel_id);
		$this->db->where('room_id',$room_id);
		$this->db->where('status','0');
		$query=$this->db->get('blocked_room_detials');
    	return $query->result();
	}

	public function get_crs_pending_booking(){
		$query_room = "select crs_hotel_bookings.*,crs_hotel_supplier_details.hotel_name,crs_room_type_detail.room_name,blocked_room_detials.booking_status,blocked_room_detials.created_datetime from crs_hotel_bookings left join blocked_room_detials on blocked_room_detials.booking_reference=crs_hotel_bookings.booking_ref left join crs_hotel_supplier_details on crs_hotel_supplier_details.hotel_id=crs_hotel_bookings.hotel_id left join crs_room_type_detail on crs_room_type_detail.id=crs_hotel_bookings.room_id where blocked_room_detials.booking_status='Pending' group by blocked_room_detials.booking_reference";
		$data = $this->db->query($query_room);
		// echo $this->db->last_query();exit();
		return $data->result();
	}

	public function get_crs_confirmed_booking_by_customer(){
		$query_room = "select crs_hotel_bookings.*,crs_hotel_supplier_details.hotel_name,crs_room_type_detail.room_name,blocked_room_detials.booking_status,blocked_room_detials.created_datetime,admin_details.admin_name from crs_hotel_bookings left join blocked_room_detials on blocked_room_detials.booking_reference=crs_hotel_bookings.booking_ref left join crs_hotel_supplier_details on crs_hotel_supplier_details.hotel_id=crs_hotel_bookings.hotel_id left join crs_room_type_detail on crs_room_type_detail.id=crs_hotel_bookings.room_id left join admin_details on admin_details.admin_id=blocked_room_detials.admin_id where blocked_room_detials.booking_status='Confirmed'  group by blocked_room_detials.booking_reference";
		$data = $this->db->query($query_room);
		// echo $this->db->last_query();exit();
		return $data->result();
	}
	public function get_book_data_by_ref_id($ref_id)
	{
		$this->db->select("*");
		$this->db->where('booking_ref',$ref_id);
		$query=$this->db->get('crs_hotel_bookings');
    	return $query->row();
	}
	public function get_crs_confirmed_booking_by_admin()
	{
		$this->db->select("blocked_room_detials.*,admin_details.admin_name,crs_hotel_supplier_details.hotel_name,crs_room_type_detail.room_name");
		$this->db->where('type','admin');
		$this->db->where('booking_status','Confirmed');

		$this->db->join('admin_details', 'admin_details.admin_id = blocked_room_detials.admin_id', 'inner');
		$this->db->join('crs_hotel_supplier_details', 'crs_hotel_supplier_details.hotel_id = blocked_room_detials.hotel_id', 'inner');
		$this->db->join('crs_room_type_detail', 'crs_room_type_detail.id = blocked_room_detials.room_id', 'inner');
		
		$this->db->group_by('admin_booking_ref'); 
		$query=$this->db->get('blocked_room_detials');
    	return $query->result_array();
	}
	public function get_block_date_by_ref_id($ref_id)
	{
		$this->db->select('blocked_room_date');
		$this->db->where('admin_booking_ref',$ref_id);
		$query=$this->db->get('blocked_room_detials');
    	return $query->result_array();
	}
	public function get_name_by_id($id){
		$this->db->select('c_p_name');
		$this->db->where('user_id',$id);
		$query=$this->db->get('user_details');
    	return $query->row();
	}
}