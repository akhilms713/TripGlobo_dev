<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_Model extends CI_Model {

	public function Test() {
		echo $this->CI_encript('123456')."<br>";
		echo $this->CI_decrypt('VFZSSmVrNUVWVEk9')."<br>";
	}

	public function isRegistered($email,$user_type_id){
		$this->db->where('user_login_details.user_email_id', $email);
		$this->db->where('user_login_details.user_type_id', $user_type_id);
		$this->db->join('user_details', 'user_details.user_id = user_login_details.user_id','LEFT');
		return $this->db->get('user_login_details');
	}
	public function isRegistered_cancel($email,$user_type_id){
		$this->db->where('user_login_details.user_email_id', $email);
		$this->db->where('user_login_details.user_type_id', $user_type_id);
		$this->db->where('user_details.status', 'CANCEL');
		$this->db->join('user_details', 'user_details.user_id = user_login_details.user_id','LEFT');
		return $this->db->get('user_login_details');
	}
		public function getNewsletterStatus($user_id,$user_type) {
		$this->db->select('*');
		
			$this->db->where('user_id', $user_id);$this->db->where('user_type_id', $user_type);
            return $this->db->get('subscribers');
       
	}

	public function currency_convertor($amount){
		
		if($this->display_currency === BASE_CURRENCY){
    		$amount = $amount*1;
    		$float = number_format(($amount) ,3,'.','');
    		////echo $float;exit;
    		return $float;
    		//echo 'hi';die;
    	}else if($this->display_currency === 'BHD'){
    		$amount = ($amount)*($this->curr_val);
    		$float = number_format(($amount),3,'.','');
    		///echo 'dsfdsfds--';$float;exit;
    		return $float;
    	}else{
    		$amount = ($amount)*($this->curr_val);
    		$float=number_format(($amount),3,'.','');
    		//~ echo 'dsfdsfdrtrets--';$float;exit;
    		return $float;
    	}
	}

	public function PercentageAmount($total,$percentage){
		
		 $amount = ($percentage/100) * $total;
		$amount = number_format($amount,3,'.','');
		//echo '<br/>'.$amount;exit;
		return $amount;
	}	
	public function updatePwdResetLink($user_id,$user_type_id,$key,$secret){
		$update = array(
			'key' => $key,
			'secret' => $secret
		);
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type_id', $user_type_id);
		return $this->db->update('user_verifications', $update);
	}
	public function isValidUser($email, $password,$user_type_id){
		$password = md5($password);
		$this->db->where('user_login_details.user_type_id', $user_type_id);
		$this->db->where('user_login_details.user_email_id', $email);
		$this->db->where('user_login_details.password', $password);
		$this->db->join('user_details', 'user_details.user_id = user_login_details.user_id','LEFT');
		return $this->db->get('user_login_details');
	}
	public function agent_deposit_details($user_id) {
		$this->db->where('user_id', $user_id);
	//	$this->db->order('deposit_id', 'ASC');
		return $this->db->get('user_deposit');
	}
	public function get_deposit_amount($user_id) {
		$this->db->where('user_id', $user_id);
		return $this->db->get('user_accounts');
	}
	public function PercentageMinusAmount($total,$amount){
		//$amount = ($percentage/100) * $total;
		$total = number_format(($total-$amount) ,2,'.','');
		return $total;
	}
  public function update_credit_amount($update_credit_amount,$b2b_id){
		$this->db->where('user_id',$b2b_id);
		$this->db->update('user_accounts',$update_credit_amount); 
	}
	
	public function saveDeposit_model($data) {

		$this->db->select('max(deposit_id)+1 as max_id');
		$this->db->from('user_deposit');
		$query_run = $this->db->get();

		$query_row = $query_run->row();
		
		if(!empty($query_row)) {
			$m_id = $query_row->max_id;
		}
		$transaction_id = 'AT'.date('d').date('m').($m_id+10000);

		$data['deposit_number'] = $transaction_id;
					
		$this->db->insert('user_deposit', $data);
		return true;
	}
	public function get_account_statment_condition($b2b_id, $cond) {
		$condition = $this->get_custom_condition_flyonair($cond);
		$cus_sql = 'SELECT * FROM user_transaction BD WHERE '.$condition;
		// echo $cus_sql;die;
		return $this->db->query($cus_sql);
	}
	function get_custom_condition_flyonair($cond)
	{
		$sql = 'BD.user_id ='.$this->db->escape($this->session->userdata('user_id')).' AND ';
		if (valid_array($cond) == true) {
			foreach ($cond as $k => $v) {
				$sql .= $v[0].' '.$v[1].' '.$v[2].' AND ';
			}
		}
		$sql = rtrim($sql, ' AND ');
		return $sql;
	}
	public function getoverallBookings_condition($user_id, $user_type,$params = array()){
		$condition = $this->get_custom_condition_flyonair($params);
		$cus_sql = 'SELECT * FROM booking_global BD LEFT JOIN `product` ON `product`.`product_id`=`BD`.`product_id` WHERE `BD`.`user_type_id` = '.$user_type.' AND '.$condition.' ORDER BY `BD`.`booking_global_id` desc';
		 return $this->db->query($cus_sql);
	}
	public function get_booking_transaction_products_condition($product_id,$user_id, $cond)
	{
		$condition = $this->get_custom_condition_flyonair($cond);
		$this->db->select('SUM(booking_transaction.total_amount) as total_amount_c,
		SUM(booking_transaction.discount) as discount_c,
		SUM(booking_transaction.admin_baseprice) as net_rate_c,
		
 
		SUM(booking_transaction.base_amount) as base_amount_c,
		
		SUM(booking_transaction.agent_markup) as agent_markup_c ,
		COUNT(booking_global.product_id) as p_count, booking_global.*');
		$this->db->where('booking_global.user_id', $user_id);
		$this->db->where('booking_global.product_id', $product_id);
		$this->db->join('booking_transaction','booking_transaction.booking_transaction_id=booking_global.booking_transaction_id','LEFT');
		 
		$this->db->get('booking_global');
		$cus_sql = 'SELECT SUM(booking_transaction.total_amount) as total_amount_c, SUM(booking_transaction.discount) as discount_c, SUM(booking_transaction.admin_baseprice) as net_rate_c, SUM(booking_transaction.base_amount) as base_amount_c, SUM(booking_transaction.agent_markup) as agent_markup_c, COUNT(BD.product_id) as p_count, `BD`.* FROM booking_global BD LEFT JOIN `booking_transaction` ON `booking_transaction`.`booking_transaction_id`=`BD`.`booking_transaction_id` WHERE '.$condition.' AND `BD`.`product_id` = '.$product_id;
		// echo $cus_sql;die;
		return $this->db->query($cus_sql);
	}
	public function get_account_statment($b2b_id) {
		$this->db->where('user_id', $b2b_id);
		$this->db->order_by('created_date_time', 'DESC');
		return $this->db->get('user_transaction');
	}
	public function get_usertype_email($user_type_name,$type=''){	
		$this->db->where('user_email_id', $user_type_name);
		if($type!=''){
			$this->db->where('user_type_id',$type);
		}
		$this->db->from('user_login_details');
		$query = $this->db->get(); 
		// echo $this->db->last_query();exit(); 		
		if ($query->num_rows() > 0) {
			$a = $query->row();
			return $a->user_type_id;
		}else{
			return '';
		}
	}
	public function get_usertype_id($user_type_name){	
		$this->db->where('user_type_name', $user_type_name);
		$this->db->from('user_type');
		$query = $this->db->get(); 
		//echo $this->db->last_query();exit(); 		
		if ($query->num_rows() > 0) {
			$a = $query->row();
			return $a->user_type_id;
		}else{
			return '';
		}
	}
	public function FileUpload($new_str){
		$data = array(
			'deposit_slip' => $new_str
			);
		$this->db->select_max('deposit_id');
        $query = $this->db->get('user_deposit')->row();
		$this->db->where('deposit_id', $query->deposit_id);
        return $this->db->update('user_deposit', $data); 

	}
	public function createUsers($postData,$user_type_id){
		
		
		$UPLOAD_IMAGE = "user-avatar.jpg";
		
		$address_data['address']=NULL;
		$this->db->insert('address_details',$address_data);
		$address_id = $this->db->insert_id();
		
		$user_info['user_name'] = $postData['fname'];
		$user_info['user_email'] = $postData['email'];
		
		$user_info['address_details_id'] = $address_id;
		$user_info['profile_picture'] = $UPLOAD_IMAGE;
		$user_info['status'] = 'INACTIVE';
		$user_info['user_creation_date_time'] = date('Y-m-d H:i:s');
		$this->db->insert('user_details',$user_info);
		$user_details_id = $this->db->insert_id();
		
		$user_login_details['user_email_id'] = $postData['email'];
		$user_login_details['password'] = md5($postData['password']);
		$user_login_details['user_id'] = $user_details_id;
		$user_login_details['user_type_id'] = $user_type_id;
		$this->db->insert('user_login_details',$user_login_details);
		$user_id =$this->db->insert_id();
	
		$user_login_access['via_email'] = $postData['email'];
		$user_login_access['user_id'] = $user_details_id;
		$this->db->insert('user_login_access',$user_login_access);
		// return $user_id;
		return $user_details_id;
	}
	public function createUsers_fr_guest($postData,$user_type_id){
		
		$UPLOAD_PATH =  ASSETS.'images/user-avatar.jpg';
		
		$address_data['address']=NULL;
		$this->db->insert('address_details',$address_data);
		$address_id = $this->db->insert_id();
		
		$user_info['user_name'] = 'Guest';
		$user_info['user_email'] = $postData['email'];
		
		$user_info['address_details_id'] = $address_id;
		$user_info['profile_picture'] = $UPLOAD_PATH;
		$user_info['status'] = 'INACTIVE';
		$user_info['user_creation_date_time'] = date('Y-m-d H:i:s');
		$this->db->insert('user_details',$user_info);
		$user_details_id = $this->db->insert_id();
		
		$user_login_details['user_email_id'] = $postData['email'];
		$user_login_details['password'] = '';
		$user_login_details['user_id'] = $user_details_id;
		$user_login_details['user_type_id'] = $user_type_id;
		$this->db->insert('user_login_details',$user_login_details);
		$user_id =$this->db->insert_id();
	
		$user_login_access['via_email'] = $postData['email'];
		$user_login_access['user_id'] = $user_id;
		$this->db->insert('user_login_access',$user_login_access);
		 return $user_id;
	}
	public function addMarkUp_model($insert_data,$user_id,$product_id,$post_data){
		//echo "<pre>"; print_r($insert_data);
		//echo $user_id; 
		
		$this->db->where('user_id', $user_id);
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('user_markup');   

		if ($query->num_rows() > 0) {
			$a = $query->row();
			$update_data = array(
				'markup_value_type' => $post_data['markup_value_type'],
    			'markup' => $post_data['markup']
			);
			// echo "<pre>sasa"; print_r($update_data);
			$this->db->where('user_id', $user_id);
			$this->db->where('product_id', $product_id);
			$this->db->update('user_markup', $update_data);
		

		}
		else{
			
			$this->db->insert('user_markup',$insert_data);
		}
		
	 
	}
	public function createUsers_agent($postData,$user_type_id,$files_data){

		if($files_data!='' && count($files_data) > 0 && $files_data["profile_picture"]['name']!='') 
		{

			$file_type = $files_data["profile_picture"]['type'];
			if (  
		        ($file_type != "image/jpeg") &&
		        ($file_type != "image/jpg") &&
		        ($file_type != "image/gif") &&
		        ($file_type != "image/png")    
		    ){
		    	return 'invalid_image';       
		    }else{
				$logo_image = explode(".",$files_data["profile_picture"]["name"]);
				$newlogoname = date("dmHis").rand(1,99999) . '.' .end($logo_image);
				$tmpnamert=$_FILES['profile_picture']['tmp_name'];
				move_uploaded_file($tmpnamert, 'photo/users/'.$newlogoname);
				$UPLOAD_PATH = $newlogoname;
		    } 
		}
		else
		{
			$UPLOAD_PATH =  'user-avatar.jpg';
		}
		 // echo $UPLOAD_PATH; exit; 
		if($user_type_id == 4){
			$address_data['address']= '';
			$address_data['city_name']= '';
			$address_data['state_name']='';
			$address_data['zip_code']= '';
			$address_data['country_code']='';
		} else {
			$address_data['address']=$postData['o_address'];
			$address_data['city_name']=$postData['o_city'];
			$address_data['state_name']='';
			$address_data['zip_code']=$postData['o_pin'];
			$address_data['country_code']=$postData['country_code'];
		}
		
		
		$this->db->insert('address_details',$address_data);
		$address_id = $this->db->insert_id();
		
		if($user_type_id == 4){
			$user_info['iata'] = '';
			$user_info['no_branch'] = '';
		} else {
			$user_info['iata'] = $postData['iata'];
			$user_info['no_branch'] = $postData['no_branch'];
		}
		
		$user_info['c_p_name'] = $postData['c_person'];
		$user_info['c_p_designation'] = $postData['c_designation'];
		$user_info['c_p_email'] = $postData['c_email'];
		$user_info['c_p_phone'] = $postData['c_phone'];
		
		if($user_type_id == 4){
			$user_info['user_name'] = '';
			$user_info['sub_user_id'] = $this->session->userdata('user_id');
			$user_info['mobile_phone'] = '';
		} else {
			$user_info['user_name'] = $postData['company'];
			$user_info['mobile_phone'] = $postData['contact_no'];
			
		}
		$user_info['user_email'] = $postData['email'];
		$user_info['status'] = 'INACTIVE';
		$user_info['address_details_id'] = $address_id;
		$user_info['profile_picture'] = $UPLOAD_PATH;
		$user_info['user_creation_date_time'] = date('Y-m-d H:i:s');
		$user_info['user_unique_id']='TRIP-'.time();
		$this->db->insert('user_details',$user_info);
		$user_details_id = $this->db->insert_id();
		
		$user_login_details['user_email_id'] = $postData['email'];
		$user_login_details['password'] = md5($postData['pswd']);
		$user_login_details['user_id'] = $user_details_id;
		$user_login_details['user_type_id'] = $user_type_id;
		$this->db->insert('user_login_details',$user_login_details);
		$user_id =$this->db->insert_id();
	
		$user_login_access['via_email'] = $postData['email'];
		$user_login_access['user_id'] = $user_details_id;
		$this->db->insert('user_login_access',$user_login_access);
		 return $user_details_id;
	}
	 public function generate_random_key($length = '', $special=null) {
        $alphabets = range('A','Z');
        $numbers = range('0','9');
        if($special == 'SPECIAL') {                 //If SPECIAL, than put special characters
            $additional_characters = array('@','*','_');    
        } else {
            $additional_characters = array();       
        }
        
        $final_array = array_merge($alphabets,$numbers,$additional_characters);
             
        $id = '';
      
        while($length--) {
          $key = array_rand($final_array);
          $id .= $final_array[$key];
        }
        return $id;
    }
	public function update_user_verification($update,$user_id,$usertype_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type_id', $usertype_id);
		$this->db->update('user_verifications', $update);
	}
	public function update_user($update,$user_id)
	{
		$this->db->where('user_id', $user_id); 
		$this->db->update('user_details', $update);
	}
	public function update_user_address($update,$address_details_id)
	{
		$this->db->where('address_details_id', $address_details_id); 
		$this->db->update('address_details', $update);
	}
	public function getBookingbyPnr($parent_pnr_no,$module){
		

		$cond_array = array('booking_global.parent_pnr_no'=>$parent_pnr_no);
		if($module == 'FLIGHT'){
			$this->db->join('booking_flight','booking_global.referal_id = booking_flight.booking_flight_id');
			$cond_array['product_id'] = FLIGHT_MARKUP;//flight booking id
		}
		 if($module == 'HOTEL'){
			$this->db->join('booking_hotel','booking_global.referal_id = booking_hotel.id');
			$cond_array['product_id'] = HOTEL_MARKUP;//hotel booking id
		}
		if($module=='CAR'){
			$this->db->join('booking_car','booking_global.referal_id = booking_car.booking_car_id');
			$cond_array['product_id'] = CAR_MARKUP;//car booking id
		}
		if($module == 'ACTIVITY'){
			$this->db->join('booking_activity','booking_global.referal_id = booking_activity.booking_sightseeing_id');

			$cond_array = array('product_id'=>ACTIVITY_MARKUP,'booking_global.pnr_no'=>$parent_pnr_no);

		}
		if($module == 'TRANSFER'){
			$this->db->join('booking_transfer','booking_global.referal_id = booking_transfer.booking_transfer_id');

			$cond_array = array('product_id'=>TRANSFER_MARKUP,'booking_global.pnr_no'=>$parent_pnr_no);

		}
		$this->db->join('booking_transaction','booking_transaction.booking_transaction_id = booking_global.booking_transaction_id');

		// if($module_id){
		// 	$cond_array['booking_global.product_id'] =  $module_id;
		// }
        $this->db->where($cond_array);

        return $this->db->get('booking_global');
    }

    public function getBookingbyPnrHOTEL($pnr_no,$module){
		 if($module == 'FLIGHT'){
			$this->db->join('booking_flight','booking_global.referal_id = booking_flight.booking_flight_id');
		}
		 if($module == 'HOTEL'){
			$this->db->join('booking_hotel','booking_global.referal_id = booking_hotel.booking_hotel_id');
		}
		$this->db->join('booking_transaction','booking_transaction.booking_transaction_id = booking_global.booking_transaction_id');
        $this->db->where('booking_global.pnr_no',$pnr_no);
        return $this->db->get('booking_global');
    }
    
	public function getallBookings(){
		return $this->db->count_all("booking_global");
	}
	public function getoverallBookings($user_id, $user_type,$params = array()){
		// echo $user_id."<br>"; echo $user_type; exit();
		
		$this->db->where('booking_global.user_type_id', $user_type);
		$this->db->where('booking_global.user_id', $user_id);
			$this->db->join('product','product.product_id=booking_global.product_id','LEFT');
		$this->db->order_by('booking_global.booking_global_id','desc');
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
		// $query=  $this->db->get('booking_global')->result();

		// echo "<pre>"; print_r($query); exit();
		return $this->db->get('booking_global');
	}
		
	public function get_products(){
		
		$this->db->select('*');  
		$this->db->from('product'); 
		$this->db->where('product_name',"FLIGHT");
		$query = $this->db->get();   
		if ($query->num_rows() > 0) {
			 
			return $query->result();
		}else{
			return '';
		}
	}
	public function get_booking_transaction_products($product_id,$user_id)
	{
		$this->db->select('SUM(booking_transaction.total_amount) as total_amount_c,
		SUM(booking_transaction.discount) as discount_c,
		SUM(booking_transaction.admin_baseprice) as net_rate_c,
		
 
		SUM(booking_transaction.base_amount) as base_amount_c,
		
		SUM(booking_transaction.agent_markup) as agent_markup_c ,
		COUNT(booking_global.product_id) as p_count, booking_global.*');
		$this->db->where('booking_global.user_id', $user_id);
		$this->db->where('booking_global.product_id', $product_id);
		$this->db->join('booking_transaction','booking_transaction.booking_transaction_id=booking_global.booking_transaction_id','LEFT');
		 
		return $this->db->get('booking_global');
	}
	public function get_address_details($user_id, $user_type){
		
		$this->db->select('user_login_details.*,user_details.*,address_details.*,user_type.user_type_name,user_accounts.*');
		$this->db->where('user_login_details.user_id', $user_id);
		$this->db->where('user_login_details.user_type_id', $user_type);
		$this->db->join('user_details', 'user_details.user_id=user_login_details.user_id', 'left');
		$this->db->join('address_details', 'address_details.address_details_id=user_details.address_details_id', 'left');
		$this->db->join('user_type', 'user_type.user_type_id=user_login_details.user_type_id', 'left');
		$this->db->join('user_accounts', 'user_accounts.user_id=user_login_details.user_id', 'left');
		
		$this->db->from('user_login_details');
		
		$query = $this->db->get();   
		if ($query->num_rows() > 0) {
			 
			return $query->row();
		}else{
			return false;
		}
	}
	public function get_billing_address_details($user_id, $user_type){
		
		$this->db->select('booking_billing_address.*');
		$this->db->where('booking_billing_address.user_id', $user_id);
		$this->db->group_by('billing_first_name,	billing_last_name,billing_email,billing_contact_number,billing_country_code,billing_address,billing_city,billing_state,billing_zip');
		
		$this->db->from('booking_billing_address');
		
		$query = $this->db->get();   
		if ($query->num_rows() > 0) {
			 
			return $query->result();
		}else{
			return false;
		}
	}
	public function update_user_password($update,$user_id,$usertype_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type_id', $usertype_id);
		$this->db->update('user_login_details', $update);
	}
		public function isvalidSecrect($key,$secret){  //this method is valid for b2c only. the b2b sign up process will ensure the genuinity of the email.
		$this->db->where('key', $key);
		$this->db->where('secret', $secret);
		return $this->db->get('user_verifications');
	}
	public function changeUserStatus($user_id) {
		$data = array('status'=>'INACTIVE');
		$this->db->where('user_id', $user_id);
		$this->db->update('user_details', $data);
		return true;
	}
	public function changeEmployeeStatus($user_id) {
		$data = array('status'=>'ACTIVE');
		$this->db->where('user_id', $user_id);
		$this->db->update('user_details', $data);
		return true;
	}
	public function changeagentStatus($user_id) {
		$data = array('status'=>'ACTIVE');
		$this->db->where('user_id', $user_id);
		$this->db->update('user_details', $data);
		return true;
	}
	public function UpdateInUserVerification($user_id,$user_verification_data) {
	 
		$this->db->where('user_id', $user_id);
		$this->db->update('user_verifications', $user_verification_data);
		return true;
	}
	public function verifyAgentContactDetails($verify_id, $email_code) {
		$this->db->select('*');
		$this->db->from('user_verifications');
		$this->db->where('verification_code', $verify_id);
	//	$this->db->where('temp_email_opt', $email_code);
//		$this->db->where('temp_mobile_opt', $mobile_code);

		return $this->db->get();
	}
	public function get_verification_details($verify_id) {
		$this->db->select('*');
		$this->db->from('user_verifications');
		$this->db->where('verification_code', $verify_id);

$query = $this->db->get();   
		if ($query->num_rows() > 0) {
			 
			return $query->row();
		}else{
			return '';
		}
		
	 
	}

	public function contactAdmin_model($data) {
		$this->db->insert('user_failed_verifications', $data);
		return true;
	}
	public function assignDefaultverfication($user_id,$user_type,$email_opt_number,$mobile_opt_number='') {
		
		
		$verifi_str = $this->generate_random_key(50);
		$random_url_string = WEB_URL.'account/verification/'.$verifi_str;
		
		$data = array('user_type_id'=>$user_type,
		 'user_id'=>$user_id,
		 'temp_email_opt'=>$email_opt_number,
		 'temp_mobile_opt'=>$mobile_opt_number,
		 'verification_url'=>$random_url_string,
		 'verification_code'=>$verifi_str
		 );
		$this->db->insert('user_verifications', $data);
		// echo "<pre>"; print_r($data); exit();
		return true;
	}
	public function verifyAgentContactDetails_v2($vid) {
		$this->db->select('*');
		$this->db->from('user_verifications');
			$this->db->join('user_details', 'user_details.user_id=user_verifications.user_id', 'left');
 
		$this->db->where('user_verifications.verification_code', $vid);
	

		return $this->db->get();
	}
		public function initializeAccountInfo_model($user_id) {
        $data = array('user_id'=>$user_id, 'balance_credit'=>0, 'last_credit'=>0);
        $this->db->insert('user_accounts', $data);
        return true;
    }
	public function checkTwoStepVerification($user_login_id,$user_type) {
		$this->db->where('user_type_id', $user_type);
		$this->db->where('user_id', $user_login_id);
		$query_output = $this->db->get('user_verifications');

		if($query_output->num_rows() > 0) {
			return $query_output->row(); 
		} else {
			return false;
		}
		
	}
	
	public function getBookings_gid($user_id, $user_type,$gid){
		
		$this->db->where('booking_global.user_type_id', $user_type);
		$this->db->where('booking_global.user_id', $user_id);
			$this->db->join('product','product.product_id=booking_global.product_id','LEFT');
		$this->db->where('booking_global.booking_global_id',$gid);
		return $this->db->get('booking_global');
	}
	
	public function get_passengersbypnr($gid){
		$this->db->where('booking_global_id', $gid);
		return $this->db->get('booking_passenger');
	}
	
	public function usertype_name($typeid){
		$this->db->where('user_type_id', $typeid);
		$query =  $this->db->get('user_type');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return '';
		}
	}
	
	public function user_data($email){
		$this->db->where('user_email_id', $email);
		$this->db->join('user_type', 'user_type.user_type_id = user_login_details.user_type_id','LEFT');
		$query = $this->db->get('user_login_details');
		
		if($query->num_rows() > 0){
			return $query->row();
		} else {
			return '';
		}
	}
	
	public function update_user_status($id,  $status){
		$data = array(
			'status' => mysql_real_escape_string($status)
			
			);
		
			$where = "user_id = '$id'";
		if ($this->db->update('user_details', $data, $where)) {
			return true;
		} else {
			return false;
		}
   }
   
      public function get_hoteldatainfo($hotelcode){
		$this->db->where('hotel_code', $hotelcode);
		$query = $this->db->get('api_hotel_detail_t');
		if($query->num_rows() > 0){
			return $query->row();
		}
		
	}
	
	public function get_markup_new($type,$api_id){
		//$where= '`markup_type` = '.$type.' and `api_details_id`='.$api_id;
		$this->db->select('*');
		$this->db->from('markup');
		$this->db->where('markup_type',$type);
		$this->db->where('api_details_id',$api_id);

		$query = $this->db->get();	
			return $query;
	}
	
	public function get_markup_new_code($code){
		$this->db->select('*');
		$this->db->from('markup');
		$this->db->where('airline_code',$code);	
		$query = $this->db->get();	
	   // echo $this->db->last_query();die();
		return $query->result();
		//	echo "<pre>"; print_r($tt); echo "</pre>"; die();
		
	}
		public function get_otp($uid){
		$this->db->select('*');
		$this->db->from('user_details');
		$this->db->where('user_id',$uid);	
		$query = $this->db->get();	
	   // echo $this->db->last_query();die();
		return $query->row();
		//	echo "<pre>"; print_r($tt); echo "</pre>"; die();
		
	}
	
	public function update_agent_log_otp($otp,$user_id,$email){
        $data=array(
                'access_one_code'=>$otp,
                'resend_flag'=>0,
            );
        $this->db->where('user_id', $user_id);
        $this->db->where('user_email', $email);
        $this->db->update('user_details', $data);
   }
   public function update_agent_log_otp_resend($otp,$user_id,$email){
        $data=array(
                'access_one_code'=>$otp,
            );
        $this->db->set('resend_flag', 'resend_flag+1', FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->where('user_email', $email);
        $this->db->update('user_details', $data);
   }
   public function update_agent_log_otp_success($user_id,$email){
        $data=array(
                'access_one_code'=>'',
                'resend_flag'=>0,
            );
        $this->db->where('user_id', $user_id);
        $this->db->where('user_email', $email);
        $this->db->update('user_details', $data);
   }
   public function get_update_agent_log_otp($otp,$user_id,$email){
		$this->db->select('user_login_details.user_id,user_login_details.user_type_id,user_login_details.user_login_details_id');
        $this->db->where('user_login_details.user_id', $user_id);
        $this->db->where('user_login_details.user_email_id', $email);
           $this->db->where('user_details.access_one_code', $otp);
        $this->db->join('user_details', 'user_details.user_id = user_login_details.user_id','left');
        $this->db->from('user_login_details');
        $query = $this->db->get();
        if ( $query->num_rows > 0 ){
				return $query->row();	
		}else{
			return false;	
		}
	}
	public function get_agent_log_details_full($user_id,$email){
        $this->db->select('user_id,user_email,mobile_phone,resend_flag');
        $this->db->where('user_id', $user_id);
        $this->db->where('user_email', $email);
        $this->db->from('user_details');
        $query = $this->db->get();
        if ( $query->num_rows > 0 ){
				return $query->row();	
		}else{
			return false;	
		}
   }
   
   public function insert_staff_log($details){
        $data = array(
    		'staff_id' =>$details->user_id,
    		'login_time' =>date("Y-m-d H:i:s"),
    		'logout_time' =>'',
    		'ip_address' => $_SERVER['REMOTE_ADDR'].'||'.$_SERVER['REMOTE_PORT']
    	);
		$this->db->insert('staff_login_tracking', $data);
		return $this->db->insert_id();
   }
   public function update_staff_log($id,$staff_id){
        $data=array(
                'logout_time'=>date("Y-m-d H:i:s"),
            );
        $this->db->where('id', $id);
        $this->db->where('staff_id', $staff_id);
        $this->db->update('staff_login_tracking', $data);
   }
	

}

?>
