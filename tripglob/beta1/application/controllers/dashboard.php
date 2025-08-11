<?php
ob_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
	error_reporting(0);
 //error_reporting(E_ALL);
 //ini_set('display_errors', 1);
class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		//DO : Setting Current website url in session, 
		//Purpose : For keeping the page on login/logout.
		//Begin
		$current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = WEB_URL.$this->uri->uri_string(). $current_url;
		$url =  array(
            'continue' => $current_url,
        );
        $this->session->set_userdata($url);
		//End
		$this->load->library('upload');
		$this->load->model('home_model');
		$this->load->model('verification_model');
		$this->load->model('account_model');
		$this->load->model('support_model');
		$this->load->model('cart_model');
		$this->load->model('Flight_Model'); 
		$this->load->model('booking_model');  
        $this->load->model('email_model');    
		$this->load->model('general_model');
		$this->load->library('New_Ajax');
        $this->perPage = 5;
		if (!$this->session->userdata('user_id')) {
            redirect(WEB_URL);
        }
	}
		 
	
	public function index(){
	    
	    //echo '<pre>';print_r($this->session->all_userdata());
	    
		if(isset($_POST['email_v'])){
			$data['email_v'] = $_POST['email_v'];
		}
		
		 $data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
        // echo "<pre>"; print_r($data); exit();
			$data['flight_bookings'] = $this->general_model->get_bookings($user_id,$user_type,'1');
			$usertypename = $this->account_model->usertype_name($user_type);
		$data['notices'] = $this->general_model->get_notices($usertypename[0]->user_type_name);
		$this->load->view(PROJECT_THEME.'/dashboard/index',$data);	
	}

	public function add_search(){
		if(isset($_POST['email_v']))
		{
			$data['email_v'] = $_POST['email_v'];
		}
		
		 $data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
        // echo "<pre>"; print_r($data); exit();
			$data['flight_bookings'] = $this->general_model->get_bookings($user_id,$user_type,'1');
			$data['no_multi'] = true;
			$usertypename = $this->account_model->usertype_name($user_type);
		$data['notices'] = $this->general_model->get_notices($usertypename[0]->user_type_name);
		// $this->load->view(PROJECT_THEME.'/dashboard/index',$data);	
		$this->load->view(PROJECT_THEME.'/dashboard/group_booking',$data);	
	}

	public function get_overall_reports()
	{
		if($this->session->userdata('user_id'))
		{
			$data['user_id'] = $user_id = $this->session->userdata('user_id');
			$data['user_type']=$user_type =  $this->session->userdata('user_type');
			$data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type,1);
			$data['bookings_reports'] = $this->general_model->get_overall_reports_graph($user_id,$user_type);
			$data['recent_sales_profit'] = $this->general_model->get_recent_sales_profit($user_id,$user_type);
			$data['recent_product_sales'] = $this->general_model->get_recent_product_sales($user_id,$user_type);
			$data['get_overall_pds_graph'] = $this->general_model->get_overall_pds_graph($user_id,$user_type);
			
			 
			echo $this->load->view(PROJECT_THEME.'/dashboard/overall_graph_reports',$data);	
		}
	}
	public function affilate_link()
	{
		 $data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
		 $data['products'] = $this->general_model->get_product_details();
		 // debug($data['userInfo']);die;
		 $this->load->view(PROJECT_THEME.'/dashboard/affilate_link',$data);	
	}
	public function markup(){
		 $data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
		 $data['products'] = $this->general_model->get_product_details();
		 $data['get_markup'] = $this->general_model->get_markup_details($user_id,$user_type);
  	 
			
	   $data['getSMSalertList'] = $this->verification_model->getSMSalertList($user_id, $user_type); //get list of all the list available in sms_alert table
       $data['getSMSalertData'] = $this->verification_model->getSMSalertData($user_id, $user_type); //get joined table between sms_alert and sms_alert_enabled.
		
		$this->load->view(PROJECT_THEME.'/dashboard/markup',$data);	
	}
	public function settings(){
		 $data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
		 $data['products'] = $this->general_model->get_product_details();
		 $data['get_markup'] = $this->general_model->get_markup_details($user_id,$user_type);
  	 
			
	   $data['getSMSalertList'] = $this->verification_model->getSMSalertList($user_id, $user_type); //get list of all the list available in sms_alert table
       $data['getSMSalertData'] = $this->verification_model->getSMSalertData($user_id, $user_type); //get joined table between sms_alert and sms_alert_enabled.
		
		$this->load->view(PROJECT_THEME.'/dashboard/settings',$data);	
	}
	public function sms_alerts(){
		 $data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
		 $data['products'] = $this->general_model->get_product_details();
		 $data['get_markup'] = $this->general_model->get_markup_details($user_id,$user_type);
  	 
			
	   $data['getSMSalertList'] = $this->verification_model->getSMSalertList($user_id, $user_type); //get list of all the list available in sms_alert table
       $data['getSMSalertData'] = $this->verification_model->getSMSalertData($user_id, $user_type); //get joined table between sms_alert and sms_alert_enabled.
		
		$this->load->view(PROJECT_THEME.'/dashboard/sms_alerts',$data);	
	}
	public function change_pwd($id=''){
		 $data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
		 $data['products'] = $this->general_model->get_product_details();
		 $data['get_markup'] = $this->general_model->get_markup_details($user_id,$user_type);
  	 
			
	   $data['getSMSalertList'] = $this->verification_model->getSMSalertList($user_id, $user_type); //get list of all the list available in sms_alert table
       $data['getSMSalertData'] = $this->verification_model->getSMSalertData($user_id, $user_type); //get joined table between sms_alert and sms_alert_enabled.
		$data['Status'] = $id;
		$this->load->view(PROJECT_THEME.'/dashboard/change_pwd',$data);	
	}
	public function cancel_account(){
		 $data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
		 $data['products'] = $this->general_model->get_product_details();
		 $data['get_markup'] = $this->general_model->get_markup_details($user_id,$user_type);
  	 
			
	   $data['getSMSalertList'] = $this->verification_model->getSMSalertList($user_id, $user_type); //get list of all the list available in sms_alert table
       $data['getSMSalertData'] = $this->verification_model->getSMSalertData($user_id, $user_type); //get joined table between sms_alert and sms_alert_enabled.
		
		$this->load->view(PROJECT_THEME.'/dashboard/cancel_account',$data);	
	}
	
	public function bookings($module = '')
	{
        
        // echo $type;exit();

        $totalRec = $this->account_model->getallBookings();

        if($module != ''){
			$data['module'] = json_decode(base64_decode($module));
		} else {
			$data['module'] = '';
		}
		// debug($data['module']);exit();
		// $to_addclass = 
        //pagination configuration
        $config['first_link']  = 'First';
        $config['div']         = 'BookingList'; //parent div tag id
        $config['base_url']    = WEB_URL.'dashboard/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
       
        $this->new_ajax->initialize($config);

		 $data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
         //$data['booking']=$this->general_model->get_booking_detail($user_id);
         //$data['staus_bookings']='active';
		 $data['getoverallBookings'] = $this->account_model->getoverallBookings($user_id,$user_type)->result();
 		// debug($data);exit;
		 
		 
	     // debug($data);exit();

		 $this->load->view(PROJECT_THEME.'/dashboard/bookings',$data);	

	}
    function ajaxPaginationData()
    {
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec =  $this->account_model->getallBookings();
        
        //pagination configuration
        $config['first_link']  = 'First';
        $config['div']         = 'BookingList'; //parent div tag id
        $config['base_url']    = WEB_URL.'dashboard/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        
        $this->new_ajax->initialize($config);
        
        //get the posts data
        $data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
         $data['getoverallBookings'] = $this->account_model->getoverallBookings($user_id,$user_type,array('start'=>$offset,'limit'=>$this->perPage))->result();
        
        //load the view
        $this->load->view(PROJECT_THEME.'/dashboard/bookings_pagination', $data, false);
    }
    
	public function profile($subpage='')
	{
		$data['user_id'] = $user_id = $this->session->userdata('user_id');

        $data['user_type']=$user_type =  $this->session->userdata('user_type');
        $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
		$data['address_details'] = $this->account_model->get_address_details($user_id,$user_type);
		$data['baddress_details'] = $this->account_model->get_billing_address_details($user_id,$user_type);
		
		$data['baddress_details'] = $this->account_model->get_billing_address_details($user_id,$user_type);
		
		$data['getoverallBookings'] = $this->account_model->getoverallBookings($user_id,$user_type)->result();
		
		$data['getCountry'] = $this->general_model->getCountryList();
		if($subpage=='')
		{
		 	$subpage = 'profile';
		}
  	 	$data['subpage']=$subpage;

  	 	 $data['promo_deal_list'] =$promo_deal_list=$this->general_model->promo_list_deal_by_userId($user_type,$user_id)->result();
  	 	 //echo "<pre/>";print_r($data['promo_deal_list']);die;
		$this->load->view(PROJECT_THEME.'/dashboard/profile',$data);		
	}
	public function updatePassport()
	{
		// echo "<pre/>";print_r($_POST);die;
		$this->db->update('user_details', $_POST, array('user_id' =>$this->session->userdata('user_id')));
		// echo $this->db->last_query();die;
		redirect('dashboard/profile');
	}
	public function updateHomeAirport()
	{
		// echo "<pre/>";print_r($_POST);die;
		$this->db->update('user_details', $_POST, array('user_id' =>$this->session->userdata('user_id')));
		// echo $this->db->last_query();die;
		redirect('dashboard/profile');
	}
	public function edit_profile($subpage=''){
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
        $data['user_type']=$user_type =  $this->session->userdata('user_type');
        $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
        //print_r($data['userInfo']); exit;
		$data['address_details'] = $this->account_model->get_address_details($user_id,$user_type);
		$data['baddress_details'] = $this->account_model->get_billing_address_details($user_id,$user_type);
		
		$data['baddress_details'] = $this->account_model->get_billing_address_details($user_id,$user_type);
		
		$data['getoverallBookings'] = $this->account_model->getoverallBookings($user_id,$user_type)->result();
		
		$data['getCountry'] = $this->general_model->getCountryList();
		if($subpage=='')
		{
		 	$subpage = 'profile';
		}
  	 	$data['subpage']=$subpage;
		$this->load->view(PROJECT_THEME.'/dashboard/profile/edit_profile',$data);		
	}
	
	public function verification($subpage=''){
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
        $data['user_type']=$user_type =  $this->session->userdata('user_type');
        $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
		$data['address_details'] = $this->account_model->get_address_details($user_id,$user_type);
		$data['baddress_details'] = $this->account_model->get_billing_address_details($user_id,$user_type);
		
		$data['baddress_details'] = $this->account_model->get_billing_address_details($user_id,$user_type);
		
		$data['getoverallBookings'] = $this->account_model->getoverallBookings($user_id,$user_type)->result();
		
		$data['getCountry'] = $this->general_model->getCountryList();
		if($subpage=='')
		{
		 	$subpage = 'profile';
		}
  	 	$data['subpage']=$subpage;
		$this->load->view(PROJECT_THEME.'/dashboard/profile/verifications',$data);		
	}
	
	public function newsletter($subpage=''){
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
        $data['user_type']=$user_type =  $this->session->userdata('user_type');
        $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
		
		   $data['getNewsletterStatus'] = $this->account_model->getNewsletterStatus($user_id,$user_type)->num_rows();
		   
	 
		if($subpage=='')
		{
		 	$subpage = 'newsletter';
		}
  	 	$data['subpage']=$subpage;
		$this->load->view(PROJECT_THEME.'/dashboard/newsletter',$data);		
	}
	  
    public function updateProfile(){
       $data['user_id'] = $user_id = $this->session->userdata('user_id');
        $data['user_type']=$user_type =  $this->session->userdata('user_type');
        $data['userInfo'] = $userInfo = $this->general_model->get_user_details($user_id,$user_type);
                   //print_r($data['userInfo']); exit;

       

        
         $update = array(
                'user_name' => $this->input->post('fname'),
                'mobile_phone' => $this->input->post('phone'),
            );
            $this->account_model->update_user($update, $user_id);
         $update2 = array(
                
                'address' => $this->input->post('address'),
                'city_name' => $this->input->post('city_name'),
                'state_name' => $this->input->post('state_name'),
                'zip_code' => $this->input->post('zip_code'),
                'country_code' => $this->input->post('country'),
            );
            $this->account_model->update_user_address($update2, $userInfo->address_details_id);
        

        //echo json_encode(array('status' => '1', 'msg' => 'Changes has been saved!!'));
        redirect(WEB_URL.'dashboard/profile');
    }

	 public function update_user_profile_image(){
        // echo "<pre>"; print_r($_FILES);exit();
        $ext = end(explode('/', $_FILES["profilePhoto"]["type"]));
        $types = array('jpeg', 'gif', 'png','jpg');
		 if (in_array($ext, $types)) {
   
        $tmp_name = $_FILES["profilePhoto"]["tmp_name"];   
      // echo $tmp_name;exit;    

		$newlogoname = date("dmHis").rand(1,99999) . '.' .$ext;
		//echo $newlogoname; exit;
	    move_uploaded_file($tmp_name, 'photo/users/'.$newlogoname);
		$image = $newlogoname;

        if($this->session->userdata('user_id')){    //identify the session
            $data['user_type']=$user_type =$this->session->userdata('user_type');
            $data['user_id']=$user_id = $this->session->userdata('user_id');
        } 

        $userInfo =  $this->general_model->get_user_details($user_id,$user_type);
        $email = $userInfo->user_email; 
		$old_image = $userInfo->profile_picture;
		/*
        
        if (strpos($old_image,'1/b2c/images/') !== false) {
            $old_image = explode('1/b2c/images/',$old_image);
            $old_image = ADMIN_UPLOAD_PATH.'1/b2c/images/'.$old_image[1];
            @unlink($old_image);
        }
        */
			$update = array('profile_picture' => $image);
            $profile_photo = $this->account_model->update_user($update, $user_id );
            echo json_encode(array('img' => UPLOAD_PATH."users/".$image));
    }
    else
    {
    	echo json_encode(array('img' =>'failed'));
    	// echo"Sorry your file was not uploaded. It may be the wrong filetype. We only allow JPG, GIF, and PNG filetypes.";

    }
}

	public function deposit(){
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);

            
            $data['deposit'] = $this->account_model->agent_deposit_details($user_id)->result();
            $data['deposit_amount'] = $this->account_model->get_deposit_amount($user_id)->row();

		$this->load->view(PROJECT_THEME.'/dashboard/deposit',$data);		
	}
	public function deposit_control(){
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);

            
            $data['deposit'] = $this->account_model->agent_deposit_details($user_id)->result();
            $data['deposit_amount'] = $this->account_model->get_deposit_amount($user_id)->row();

		$this->load->view(PROJECT_THEME.'/dashboard/deposit_control',$data);		
	}
	public function support_conversation(){
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
        $data['user_type']=$user_type =  $this->session->userdata('user_type');
        $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
        $data['support_ticket_subject'] = $this->support_model->get_support_subject_list(); 
        $data['support'] = $this->support_model->get_support_list($user_id); 
        $data['support_pending'] = $this->support_model->get_support_list_pending($user_id); 
        $data['support_sent'] = $this->support_model->get_support_list_sent($user_id); 
        $data['support_close'] = $this->support_model->get_support_list_close($user_id); 
            $this->load->view(PROJECT_THEME.'/dashboard/support_conversation',$data);
	
	}
	public function ticket_inbox(){
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
        $data['user_type']=$user_type =  $this->session->userdata('user_type');
        $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);

        $data['support_ticket_subject'] = $this->support_model->get_support_subject_list(); 
        $data['support'] = $this->support_model->get_support_list($user_id); 
        $data['support_pending'] = $this->support_model->get_support_list_pending($user_id);
        
        $data['support_sent'] = $this->support_model->get_support_list_sent($user_id); 
        $data['support_close'] = $this->support_model->get_support_list_close($user_id); 
            $this->load->view(PROJECT_THEME.'/dashboard/ticket_inbox',$data);
	
	}
	public function sent_ticket(){
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
        $data['user_type']=$user_type =  $this->session->userdata('user_type');
        $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
        $data['support_ticket_subject'] = $this->support_model->get_support_subject_list(); 
        $data['support'] = $this->support_model->get_support_list($user_id); 
        $data['support_pending'] = $this->support_model->get_support_list_pending($user_id); 
        $data['support_sent'] = $this->support_model->get_support_list_sent($user_id); 
        $data['support_close'] = $this->support_model->get_support_list_close($user_id); 
            $this->load->view(PROJECT_THEME.'/dashboard/sent_ticket',$data);
	
	}
	public function closed_tickets(){
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
        $data['user_type']=$user_type =  $this->session->userdata('user_type');
        $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
        $data['support_ticket_subject'] = $this->support_model->get_support_subject_list(); 
        $data['support'] = $this->support_model->get_support_list($user_id); 
        $data['support_pending'] = $this->support_model->get_support_list_pending($user_id); 
        $data['support_sent'] = $this->support_model->get_support_list_sent($user_id); 
        $data['support_close'] = $this->support_model->get_support_list_close($user_id); 
            $this->load->view(PROJECT_THEME.'/dashboard/closed_tickets',$data);
	
	}
	

    function add_new_ticket(){
    	// echo "<pre/>";print_r($this->session->userdata);die;
		if($this->session->userdata('user_id')){
			$data['user_type']=$user_type = $this->session->userdata('user_type');
			$data['user_id']=$user_id = $this->session->userdata('user_id');
		} else {
				echo "else";die;
			 redirect(WEB_URL,'refresh');
		}
	// echo "<pre/>";print_r($_FILES);die;
		$sub = $this->input->post('subject');
		$message = $this->input->post('message');
		$config['upload_path'] = './admin-panel/uploads/support_ticket/';
		// echo "<pre/>";print_r($_FILES);die;
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if($_FILES['file_name']['name']!=''){
			if ( ! $this->upload->do_upload('file_name')){
				$error = array('error' => $this->upload->display_errors());
				$data['status'] ='<div class="alert alert-block alert-danger">
				<a href="#" data-dismiss="alert" class="close">×</a>
				<h4 class="alert-heading">Attachment File Failed!</h4>
				'.$error['error'].'</div>';
				$data['user_id'] = $user_id = $this->session->userdata('user_id');
				$data['user_type']=$user_type =  $this->session->userdata('user_type');
				$data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
				$data['support_ticket_subject'] = $this->support_model->get_support_subject_list(); 
				$data['support'] = $this->support_model->get_support_list($user_id); 
				$data['support_pending'] = $this->support_model->get_support_list_pending($user_id); 
				$data['support_sent'] = $this->support_model->get_support_list_sent($user_id); 
				$data['support_close'] = $this->support_model->get_support_list_close($user_id); 
				//echo "<pre/>";print_r($error);die;
				$this->load->view(PROJECT_THEME.'/dashboard/support_conversation',$data);
			}
			$cc = $this->upload->data('file');
			$image_path = 'uploads/support_ticket/'.$cc['file_name'];
		} else {
			$image_path = '';
		}
		// echo "<pre/>";print_r($image_path);die;
		$this->support_model->add_new_support_ticket( $user_id,$sub,$message,$image_path);
		
		
		
		echo "<script>alert('We received your support ticket request. Our team will get back to you. ');</script>";
		redirect(WEB_URL."dashboard/sent_ticket",'refresh');
	}
   public  function download_file($file){
        $this->load->helper('download');
            $name=  base64_decode($file);
       
        $data = file_get_contents($name); // Read the file's contents
       
        $a = explode('support_ticket', $name);
        $name1 = substr($a[1],2);
        if($data != ''){
            force_download($name1, $data); 
        }else{
            redirect(WEB_URL.'dashboard/support_conversation/','refresh');
        }
    }
  public function close_ticket($sid){

        //echo '<pre>';print_r($_POST);exit();
        $data = array();
        
        if($_POST[ticket_number])
        {
            $data['remarks'] = $_POST['remarks'];
            $data['ticket_number'] = $_POST['ticket_number'];
            
            $this->support_model->close_ticket_with_remark($data);
        }
        
      //exit("ahgsagvsas");
      
        //$this->support_model->close_ticket($sid);
        
       echo "<script>alert('Ticket Close Request Sent. ');</script>";
           
        redirect('dashboard/sent_ticket');
       // redirect("dashboard/support_conversation","refresh");
    }
    
    public function view_ticket($id){ //print_r($id); exit;

  			$data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);

       
        $data['status']='';
        $data['ticket'] = $this->support_model->get_support_list_id($user_id,$id); 
        $data['ticketrow'] = $this->support_model->get_support_list_id_row($user_id,$id); 
        $data['id']=$id;
// echo '<pre/>';
// print_r($data);exit;
        // $tickets = $this->load->view(PROJECT_THEME.'/dashboard/support_view_ticket',$data,TRUE);
        $this->load->view(PROJECT_THEME.'/dashboard/support_view_ticket',$data);
       // $response = array('tickets' => $tickets,'status'=> '1');
       // echo json_encode($response);

    }
	function reply_ticket($id){
	   // exit("test");
		// debug($_FILES);exit;
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
        $data['user_type']=$user_type =  $this->session->userdata('user_type');
		$ticketrow = $this->support_model->get_support_list_id_row($user_id,$id); 
		$user = $ticketrow->user_id;
		$message = $this->input->post('message');
		$support_ticket_id = $ticketrow->support_ticket_id;
		$config['upload_path'] = './admin-panel/uploads/support_ticket/';
		// echo "<pre/>";print_r($_FILES);die;
		$config['allowed_types'] = '*';		
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
		
		if($_FILES['rfile_name']['name']!=''){
			if ( ! $this->upload->do_upload('rfile_name')){
				$error = array('error' => $this->upload->display_errors());
				$data['status'] ='<div class="alert alert-block alert-danger">
				<a href="#" data-dismiss="alert" class="close">×</a>
				<h4 class="alert-heading">Attachment File Failed!</h4>
				'.$error['error'].'</div>';
			}
			$cc = $this->upload->data('file');
			$image_path = 'uploads/support_ticket/'.$cc['file_name'];
		} else {
			$image_path = '';
		}
		// debug($cc);exit;
		
            
            $last_id = $this->support_model->add_new_support_ticket_updates($support_ticket_id,$message,$image_path);
            $data['ticket'] = $this->support_model->getSupportHistoryRow($last_id);
            $ticketrow = $this->support_model->get_support_list_id_row($ticketrow->user_id,$id);
				$data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
			$data['user_details'] = $this->general_model->get_user_details($user_id,$user_type);
			
			$response = array('tickets' => $tickets,'status'=> '1','id'=>$id);
             echo json_encode($response);
            //redirect('dashboard/support_conversation/'.$id);
			 redirect('dashboard/view_ticket/'.$id);
            // $this->load->view(PROJECT_THEME.'/dashboard/support_view_ticket_ajax',$data,TRUE);
           // $response = array('tickets' => $tickets,'status'=> '1','id'=>$id);
            // echo json_encode($response);
            //redirect('dashboard/support_conversation/'.$id,'refresh');
    }
    
	function check_b2b_user(){
		 $user_id = $this->session->userdata('user_id');
		 $user_type =  $this->session->userdata('user_type');
		$userInfo = $this->general_model->get_user_details($user_id,$user_type);
		// debug($userInfo);exit;
		if($userInfo->user_type_name == 'B2C')
		{
			redirect(WEB_URL.'dashboard');
		}
		
		
	}
	public function account_statement(){
		$this->check_b2b_user();
		if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		}
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
		$data['user_type']=$user_type =  $this->session->userdata('user_type');
		$data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
		$data['deposit'] = $this->account_model->agent_deposit_details($user_id)->result();
		$data['deposit_amount'] = $this->account_model->get_deposit_amount($user_id)->row();
		$filter_data = $this->format_basic_search_filters();
		$data['from_date'] = $filter_data['from_date'];
		$data['to_date'] = $filter_data['to_date'];
		$condition = $filter_data['filter_condition'];
		if(valid_array($this->input->get()) == true) {
			// debug($condition);die;
			$data['account_statment_data'] = $this->account_model->get_account_statment_condition($user_id, $condition)->result();
		} else {
			$data['account_statment_data'] = $this->account_model->get_account_statment($user_id)->result();
		}
		// debug($data);die;
		$this->load->view(PROJECT_THEME.'/dashboard/account_statement',$data);		
	}
	public function booking_statement(){
		$this->check_b2b_user();
		if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		}
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
            
        $data['deposit'] = $this->account_model->agent_deposit_details($user_id)->result();
 		$data['deposit_amount'] = $this->account_model->get_deposit_amount($user_id)->row();
         $filter_data = $this->format_basic_search_filters_book();
         $data['from_date'] = $filter_data['from_date'];
		 $data['to_date'] = $filter_data['to_date'];
		 $condition = $filter_data['filter_condition'];
		 if(valid_array($this->input->get()) == true) {
  			$data['Bookings'] =  $this->account_model->getoverallBookings_condition($user_id, $user_type, $condition)->result();
		 }else{
  			$data['Bookings'] =  $this->account_model->getoverallBookings($user_id, $user_type)->result();
		 }
       
	   
		$this->load->view(PROJECT_THEME.'/dashboard/booking_statement',$data);		
	}
	public function booking_statement1(){
		$this->check_b2b_user();
		if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		}
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
            
        $data['deposit'] = $this->account_model->agent_deposit_details($user_id)->result();
 		$data['deposit_amount'] = $this->account_model->get_deposit_amount($user_id)->row();
         $filter_data = $this->format_basic_search_filters_book();
         $data['from_date'] = $filter_data['from_date'];
		 $data['to_date'] = $filter_data['to_date'];
		 $condition = $filter_data['filter_condition'];
		 if(valid_array($this->input->get()) == true) {
  			$data['Bookings'] =  $this->account_model->getoverallBookings_condition($user_id, $user_type, $condition)->result();
		 }else{
  			$data['Bookings'] =  $this->account_model->getoverallBookings($user_id, $user_type)->result();
		 }
       
	   
		$this->load->view(PROJECT_THEME.'/dashboard/booking_statement1',$data);		
	}
	 public function profit_matrix(){
	 	$data['search_status'] = 0;
	 	if(valid_array($this->input->get()) == true) {
			$data = $_GET;
			$data['search_status'] = 1;
		}
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
        $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
        $data['deposit'] = $this->account_model->agent_deposit_details($user_id)->result();
 		$data['deposit_amount'] = $this->account_model->get_deposit_amount($user_id)->row();
 		$filter_data = $this->format_basic_search_filters_book();
 		$page_data['from_date'] = $filter_data['from_date'];
		$data['to_date'] = $filter_data['to_date'];
		$data['condition'] = $filter_data['filter_condition'];
       
  		$data['Bookings'] = $this->account_model->getoverallBookings($user_id, $user_type)->result();
		
		$data['products'] = $this->account_model->get_products();
	   
	   
	   
		$this->load->view(PROJECT_THEME.'/dashboard/profit_matrix',$data);		
	}
	function auto_swipe_dates_flyonair($from_date, $to_date)
	{
		if(empty($from_date) == false && empty($to_date) == false) {
			if(strtotime($from_date) > strtotime($to_date)) {//Validating From date and To date
				return array('from_date' => $to_date, 'to_date' => $from_date);
			} else {
				return array('from_date' => $from_date, 'to_date' => $to_date);
			}
		}
	}
	function db_current_datetime_flyonair($date='')
	{
		if (empty($date) == false) {
			return date('Y-m-d H:i:s', strtotime($date));
		} else {
			return date('Y-m-d H:i:s', time());
		}
	}
	private function format_basic_search_filters_book($module='')
	{
		$get_data = $this->input->get();


		if(valid_array($get_data) == true) {
			$filter_condition = array();
			//From-Date and To-Date
			$from_date = trim(@$get_data['created_datetime_from']);
			$to_date = trim(@$get_data['created_datetime_to']);
			//Auto swipe date
			if(empty($from_date) == false && empty($to_date) == false)
			{
				$valid_dates = $this->auto_swipe_dates_flyonair($from_date, $to_date);
				$from_date = $valid_dates['from_date'];
				$to_date = $valid_dates['to_date'];
			}
			if(empty($from_date) == false) {
				$filter_condition[] = array('BD.voucher_date', '>=', $this->db->escape($this->db_current_datetime_flyonair($from_date." 00:00:00")));
			}
			if(empty($to_date) == false) {
				$flyonair_to = $this->db->escape($this->db_current_datetime_flyonair($to_date))." 23:59:59";
				$filter_condition[] = array('BD.voucher_date', '<=', $this->db->escape($this->db_current_datetime_flyonair($to_date." 23:59:59")));
			}
	
			
			
			$page_data['from_date'] = $from_date;
			$page_data['to_date'] = $to_date;

			//Today's Booking Data
			if(isset($get_data['today_booking_data']) == true && empty($get_data['today_booking_data']) == false) {
				$filter_condition[] = array('(BD.voucher_date)', '>=', '"'.date('Y-m-d').' 00:00:00"');
				$filter_condition[] = array('(BD.voucher_date)', '<=', '"'.date('Y-m-d').' 23:59:59"');
			}
			//Last day Booking Data
			if(isset($get_data['last_day_booking_data']) == true && empty($get_data['last_day_booking_data']) == false) {
				$filter_condition[] = array('(BD.voucher_date)', '>=', '"'.trim($get_data['last_day_booking_data']).' 00:00:00"');
				$filter_condition[] = array('(BD.voucher_date)', '<=', '"'.trim($get_data['last_day_booking_data']).' 23:59:59"');
			}
			//Previous Booking Data: last 3 days, 7 days, 15 days, 1 month and 3 month
			if(isset($get_data['prev_booking_data']) == true && empty($get_data['prev_booking_data']) == false) {
				$filter_condition[] = array('(BD.voucher_date)', '>=', '"'.trim($get_data['prev_booking_data']).' 00:00:00"');
			}
			
			return array('filter_condition' => $filter_condition, 'from_date' => $from_date, 'to_date' => $to_date);
		}
	}
	private function format_basic_search_filters($module='')
	{
		$get_data = $this->input->get();


		if(valid_array($get_data) == true) {
			$filter_condition = array();
			//From-Date and To-Date
			$from_date = trim(@$get_data['created_datetime_from']);
			$to_date = trim(@$get_data['created_datetime_to']);
			//Auto swipe date
			if(empty($from_date) == false && empty($to_date) == false)
			{
				$valid_dates = $this->auto_swipe_dates_flyonair($from_date, $to_date);
				$from_date = $valid_dates['from_date'];
				$to_date = $valid_dates['to_date'];
			}
			if(empty($from_date) == false) {
				$filter_condition[] = array('BD.created_date_time', '>=', $this->db->escape($this->db_current_datetime_flyonair($from_date." 00:00:00")));
			}
			if(empty($to_date) == false) {
				$flyonair_to = $this->db->escape($this->db_current_datetime_flyonair($to_date))." 23:59:59";
				$filter_condition[] = array('BD.created_date_time', '<=', $this->db->escape($this->db_current_datetime_flyonair($to_date." 23:59:59")));
			}
	
			
			
			$page_data['from_date'] = $from_date;
			$page_data['to_date'] = $to_date;

			//Today's Booking Data
			if(isset($get_data['today_booking_data']) == true && empty($get_data['today_booking_data']) == false) {
				$filter_condition[] = array('(BD.created_date_time)', '>=', '"'.date('Y-m-d').' 00:00:00"');
				$filter_condition[] = array('(BD.created_date_time)', '<=', '"'.date('Y-m-d').' 23:59:59"');
			}
			//Last day Booking Data
			if(isset($get_data['last_day_booking_data']) == true && empty($get_data['last_day_booking_data']) == false) {
				$filter_condition[] = array('(BD.created_date_time)', '>=', '"'.trim($get_data['last_day_booking_data']).' 00:00:00"');
				$filter_condition[] = array('(BD.created_date_time)', '<=', '"'.trim($get_data['last_day_booking_data']).' 23:59:59"');
			}
			//Previous Booking Data: last 3 days, 7 days, 15 days, 1 month and 3 month
			if(isset($get_data['prev_booking_data']) == true && empty($get_data['prev_booking_data']) == false) {
				$filter_condition[] = array('(BD.created_date_time)', '>=', '"'.trim($get_data['prev_booking_data']).' 00:00:00"');
			}
			
			return array('filter_condition' => $filter_condition, 'from_date' => $from_date, 'to_date' => $to_date);
		}
	}
	public function traveller(){
		$this->load->view(PROJECT_THEME.'/dashboard/traveller');	
	}
	public function b2b_dashboard(){
		$this->load->view(PROJECT_THEME.'/dashboard/b2b_dashboard');	
	}
	 
	 public function get_booking_data(){
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
		 $data['booking'] = $this->account_model->getBookingbyPnr($_REQUEST['pnr'],$_REQUEST['module'])->row();
		 $this->load->view(PROJECT_THEME.'/dashboard/booking_details',$data);
	 }
	 
	 public function add_employee(){
		
		 $data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
		$this->load->view(PROJECT_THEME.'/dashboard/b2b2b/add_employee',$data);	
	}
	 public function employee_list(){
		
		 $data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
         $data['employee_list'] = $this->general_model->get_employees($user_id);
		$this->load->view(PROJECT_THEME.'/dashboard/b2b2b/employee_list',$data);	
	}
	 public function employee_bookings(){
		
		 $data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
		$this->load->view(PROJECT_THEME.'/dashboard/b2b2b/employee_bookings',$data);	
	}
	function call_iternary(){
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
         $data['module']	= $_REQUEST['module'];
		 $data['booking']  = $booking = $this->account_model->getBookingbyPnr($_REQUEST['pnr'],$_REQUEST['module'])->row();
		 if($_REQUEST['module'] == 'HOTEL')
		 $data['cart']	= $cart = $this->cart_model->getBookingTemphotel($booking->shopping_cart_hotel_id);
		$this->load->view(PROJECT_THEME.'/dashboard/booking_details',$data); 
   	}
   	
   	public function update_user_status(){
		$id = $_GET['id'];
		$status = $_GET['status'];

		//$this->email_model->send_status_email($id, $status);
        if($this->account_model->update_user_status($id, $status)){
			$response = array('status' => 1);
        	echo json_encode($response);
		} else {
			$response = array('status' => 0);
        	echo json_encode($response);
		}
	}	
	public function view_profile($user_id, $user_type){
		$data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
		$data['address_details'] = $this->account_model->get_address_details($user_id,$user_type);
		$data['baddress_details'] = $this->account_model->get_billing_address_details($user_id,$user_type);		
		$data['baddress_details'] = $this->account_model->get_billing_address_details($user_id,$user_type);		
		$data['getoverallBookings'] = $this->account_model->getoverallBookings($user_id,$user_type)->result();		
		$data['getCountry'] = $this->general_model->getCountryList();
		
		$this->load->view(PROJECT_THEME.'/dashboard/b2b2b/employee_profile',$data);
	}



	public function mail($pnr_no='',$con_pnr_no='',$booking_global_id=''){	
		$this->load->library('provab_mailer');

		
		if($booking_global_id){

		 $count = $this->booking_model->getBookingPnr($pnr_no,$con_pnr_no,$booking_global_id)->num_rows();	 
		}else{
			$count = $this->booking_model->getBookingPnr($pnr_no,$con_pnr_no)->num_rows();	
		}
		
        if($count == 1){

        	if($booking_global_id){
        		 $b_data = $this->booking_model->getBookingPnr($pnr_no,$con_pnr_no,$booking_global_id)->row();	
        	}else{
        		 $b_data = $this->booking_model->getBookingPnr($pnr_no,$con_pnr_no)->row();
        	}

          	$admin_details = $this->booking_model->get_admin_details();
         	$data['admin_details'] = $admin_details;
            if($b_data->product_name == 'FLIGHT'){
            //  $data['terms_conditions'] = $this->booking_model->get_terms_conditions($product_id);
        	if($booking_global_id){
        		$data['b_data'] = $this->booking_model->getBookingPnr($pnr_no,$con_pnr_no,$booking_global_id)->row();   
        	}else{
        		$data['b_data'] = $this->booking_model->getBookingPnr($pnr_no,$con_pnr_no)->row();   
        	}
             
	           $booking_global_id=$b_data->booking_global_id;
	           $billing_address_id=$b_data->billing_address_id;
             	 $booking_transaction_id = $b_data->booking_transaction_id;
		          $data['booking_transaction'] = $this->booking_model->getbookingTransaction($booking_transaction_id)->result();
                $data['Passenger'] = $passenger = $this->booking_model->getPassengerbyid($booking_global_id)->result();
                $data['booking_agent'] = $passenger = $this->booking_model->getagentbyid($billing_address_id)->result();
                $data['message'] = $this->load->view(PROJECT_THEME.'/booking/mail_voucher', $data,TRUE);

                $data['to'] = $data['booking_agent'][0]->billing_email;           
                //$data['to'] = 'elavarasi.k@provabmail.com';
                $data['booking_status'] = $b_data->booking_status;
                $data['pnr_no'] = $pnr_no;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'FLIGHT_BOOKING_VOUCHER';
                 // echo "b_data:<pre/>";print_r($data);exit();
                
                $Response = $this->email_model->sendmail_flightVoucher($data);
               
              //   echo "b_data:<pre/>";print_r($Response);exit();
                $response = array('status' => 1);
                //echo json_encode($response);
            }
            
            else if($b_data->product_name == 'HOTEL'){
            //  $data['terms_conditions'] = $this->booking_model->get_terms_conditions($product_id);
            	if($booking_global_id){
            		$data['b_data'] = $this->booking_model->getBookingPnr($pnr_no,$con_pnr_no,$booking_global_id)->row();
            	}else{
            		$data['b_data'] = $this->booking_model->getBookingPnr($pnr_no,$con_pnr_no)->row();
            	}
	                

	           $booking_global_id=$b_data->booking_global_id;
	           $billing_address_id=$b_data->billing_address_id;
             
                 $data['Passenger'] = $passenger = $this->booking_model->getPassengerbyid($booking_global_id)->result();
                 $data['booking_agent'] = $passenger = $this->booking_model->getagentbyid($billing_address_id)->result();
                 

                 $data['Booking'] = $bookinginfo = $this->booking_model->getBookingbyPnr($pnr_no,$b_data->product_name,$b_data->con_pnr_no)->row();

                 $data['cart']	= $cart = $this->cart_model->getBookingTemphotel($bookinginfo->shopping_cart_hotel_id);

                 $data['message'] = $this->load->view(PROJECT_THEME.'/booking/hotel_mail_voucher', $data,TRUE);

                
                 
              //   print_r($data);  exit;
               
                $data['to'] = $data['booking_agent'][0]->billing_email;               
                $data['booking_status'] = $b_data->booking_status;
                $data['pnr_no'] = $pnr_no;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'HOTEL_BOOKING_VOUCHER';
                $data['mail_from'] = 'Hotel';

                $Response = $this->email_model->sendmail_hotelVoucher($data);
                $response = array('status' => 1);
                //echo json_encode($response);
            }
            elseif ($b_data->product_name =='ACTIVITY') {
            	$this->load->model('payment_model');
            	  $data['b_data'] =  $this->booking_model->getBookingPnr($pnr_no)->row();  
        	   	$data['Booking'] =$this->booking_model->getBookingbyPnr($pnr_no,$b_data->product_name)->row();
	           $booking_global_id=$b_data->booking_global_id;
	           $billing_address_id=$b_data->billing_address_id;

                 $data['Passenger'] = $passenger = $this->booking_model->getPassengerbyid($booking_global_id)->result_array();
                 $data['booking_agent'] = $passenger = $this->booking_model->getagentbyid($billing_address_id)->result();
                 
                 $data['booking_info'] = $bookinginfo = $this->account_model->getBookingbyPnr($pnr_no,$b_data->product_name)->row();
                 $data['cart']	= $cart = $this->cart_model->getBookingTemp_SIGHTSEEING($bookinginfo->referal_id);

				$data['pnr_nos'] = $this->booking_model->getBookingByParentPnr($data['Booking']->parent_pnr_no)->result();
				$global_ids = $this->payment_model->validate_order_id_org($data['Booking']->parent_pnr_no)->result();
				$data['cart'] = $this->db->get_where('booking_activity', array('booking_sightseeing_id' => $global_ids[0]->referal_id))->row();
                 $data['mail_voucher'] = true;
                 $data['message'] = $this->load->view(PROJECT_THEME.'/transferv1/voucher', $data,TRUE);
                $data['to'] = $data['booking_agent'][0]->billing_email;               
                $data['booking_status'] = $b_data->booking_status;
                $data['pnr_no'] = $pnr_no;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'ACTIVITY_BOOKING_VOUCHER';
                $data['mail_from'] = 'Activity';
        		
                $Response = $this->email_model->sendmail_ActivityTransferVoucher($data,'Activity');
                
                $response = array('status' => 1);

            }else if($b_data->product_name =='TRANSFER'){
            	$this->load->model('payment_model');
            	  $data['b_data'] =  $this->booking_model->getBookingPnr($pnr_no)->row();  
        	   	$data['Booking'] =$this->booking_model->getBookingbyPnr($pnr_no,$b_data->product_name)->row();
	           $booking_global_id=$b_data->booking_global_id;
	           $billing_address_id=$b_data->billing_address_id;

                 $data['Passenger'] = $passenger = $this->booking_model->getPassengerbyid($booking_global_id)->result_array();
                 $data['booking_agent'] = $passenger = $this->booking_model->getagentbyid($billing_address_id)->result();
                 
                 $data['booking_info'] = $bookinginfo = $this->account_model->getBookingbyPnr($pnr_no,$b_data->product_name)->row();
                 $data['cart']	= $cart = $this->cart_model->getBookingTemp_transfer($bookinginfo->referal_id);

				$data['pnr_nos'] = $this->booking_model->getBookingByParentPnr($data['Booking']->parent_pnr_no)->result();
				$global_ids = $this->payment_model->validate_order_id_org($data['Booking']->parent_pnr_no)->result();
				$data['cart'] = $this->db->get_where('booking_transfer', array('booking_transfer_id' => $global_ids[0]->referal_id))->row();
                 $data['mail_voucher'] = true;
                 $data['message'] = $this->load->view(PROJECT_THEME.'/transferv1/voucher', $data,TRUE);
                 
               
               
                $data['to'] = $data['booking_agent'][0]->billing_email;               
                $data['booking_status'] = $b_data->booking_status;
                $data['pnr_no'] = $pnr_no;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'TRANSFER_BOOKING_VOUCHER';
                $data['mail_from'] = 'Transfer';
        		
                $Response = $this->email_model->sendmail_ActivityTransferVoucher($data,'Transfer');
                
                $response = array('status' => 1);
            }
            elseif ($b_data->product_name =='CAR') {
            	if($booking_global_id){
            		 $data['Booking']= $data['b_data']= $this->booking_model->getBookingPnr($pnr_no,$con_pnr_no,$booking_global_id)->row();
            		}else{
            			 $data['Booking']= $data['b_data']= $this->booking_model->getBookingPnr($pnr_no,$con_pnr_no)->row();
            		}
            	

		         $booking_global_id=$data['Booking']->booking_global_id;
		          $billing_address_id=$data['Booking']->billing_address_id;
		          $booking_transaction_id = $data['Booking']->booking_transaction_id;
		          $data['booking_transaction'] = $this->booking_model->getbookingTransaction($booking_transaction_id)->result();
		         $data['Passenger'] = $passenger = $this->booking_model->getPassengerbyid($booking_global_id)->result();
		         $data['booking_agent'] = $passenger = $this->booking_model->getagentbyid($billing_address_id)->result();
		          $data['mail_voucher'] = true;
		          $data['message'] =  $this->load->view(PROJECT_THEME.'/booking/car_voucher_view', $data,TRUE);
		       
		         $data['to'] = $data['booking_agent'][0]->billing_email;               
	                $data['booking_status'] = $b_data->booking_status;
	                $data['pnr_no'] = $pnr_no;
	                $data['email_access'] = $this->email_model->get_email_acess()->row();
	                $email_type = 'CAR_BOOKING_VOUCHER';
	                $data['mail_from'] = 'Car';
                 $Response = $this->email_model->sendmail_ActivityTransferVoucher($data,'Car');
                
                $response = array('status' => 1);


            }
        }else{
            $response = array('status' => 0);
            echo json_encode($response);
        }

        echo json_encode($response);
        exit;

    }
	public function mail20032019($pnr_no=''){	
		$this->load->library('provab_mailer');
	 $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();	 
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();   
          	$admin_details = $this->booking_model->get_admin_details();
         	$data['admin_details'] = $admin_details;
            if($b_data->product_name == 'FLIGHT'){
            //  $data['terms_conditions'] = $this->booking_model->get_terms_conditions($product_id);
           $data['b_data'] = $this->booking_model->getBookingPnr($pnr_no)->row();     
           $booking_global_id=$b_data->booking_global_id;
           $billing_address_id=$b_data->billing_address_id;
             
                 $data['Passenger'] = $passenger = $this->booking_model->getPassengerbyid($booking_global_id)->result();
                 $data['booking_agent'] = $passenger = $this->booking_model->getagentbyid($billing_address_id)->result();
                $data['message'] = $this->load->view(PROJECT_THEME.'/booking/mail_voucher', $data,TRUE);
               
                $data['to'] = $data['booking_agent'][0]->billing_email;               
                $data['booking_status'] = $b_data->booking_status;
                $data['pnr_no'] = $pnr_no;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'FLIGHT_BOOKING_VOUCHER';
                 // echo "b_data:<pre/>";print_r($data);exit();
                
                $Response = $this->email_model->sendmail_flightVoucher($data);
              //   echo "b_data:<pre/>";print_r($Response);exit();
                $response = array('status' => 1);
                //echo json_encode($response);
            }
            
            else if($b_data->product_name == 'HOTEL'){
            //  $data['terms_conditions'] = $this->booking_model->get_terms_conditions($product_id);
	           $data['b_data'] = $this->booking_model->getBookingPnr($pnr_no)->row();     
	           $booking_global_id=$b_data->booking_global_id;
	           $billing_address_id=$b_data->billing_address_id;
             
                 $data['Passenger'] = $passenger = $this->booking_model->getPassengerbyid($booking_global_id)->result();
                 $data['booking_agent'] = $passenger = $this->booking_model->getagentbyid($billing_address_id)->result();
                 
                 $data['booking_info'] = $bookinginfo = $this->account_model->getBookingbyPnr($pnr_no,$b_data->product_name)->row();
                 $data['cartinfo']	= $cart = $this->cart_model->getBookingTemphotel($bookinginfo->shopping_cart_hotel_id);

                 $data['message'] = $this->load->view(PROJECT_THEME.'/booking/hotel_mail_voucher', $data,TRUE);
                 
                 
              //   print_r($data);  exit;
               
                $data['to'] = $data['booking_agent'][0]->billing_email;               
                $data['booking_status'] = $b_data->booking_status;
                $data['pnr_no'] = $pnr_no;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'HOTEL_BOOKING_VOUCHER';
                $data['mail_from'] = 'Hotel';

                $Response = $this->email_model->sendmail_hotelVoucher($data);
                $response = array('status' => 1);
                //echo json_encode($response);
            }
            elseif ($b_data->product_name =='ACTIVITY') {
            	$this->load->model('payment_model');
            	  $data['b_data'] =  $this->booking_model->getBookingPnr($pnr_no)->row();  
        	   	$data['Booking'] =$this->booking_model->getBookingbyPnr($pnr_no,$b_data->product_name)->row();
	           $booking_global_id=$b_data->booking_global_id;
	           $billing_address_id=$b_data->billing_address_id;

                 $data['Passenger'] = $passenger = $this->booking_model->getPassengerbyid($booking_global_id)->result_array();
                 $data['booking_agent'] = $passenger = $this->booking_model->getagentbyid($billing_address_id)->result();
                 
                 $data['booking_info'] = $bookinginfo = $this->account_model->getBookingbyPnr($pnr_no,$b_data->product_name)->row();
                 $data['cart']	= $cart = $this->cart_model->getBookingTemp_SIGHTSEEING($bookinginfo->referal_id);

				$data['pnr_nos'] = $this->booking_model->getBookingByParentPnr($data['Booking']->parent_pnr_no)->result();
				$global_ids = $this->payment_model->validate_order_id_org($data['Booking']->parent_pnr_no)->result();
				$data['cart'] = $this->db->get_where('booking_activity', array('booking_sightseeing_id' => $global_ids[0]->referal_id))->row();
                 $data['mail_voucher'] = true;
                 $data['message'] = $this->load->view(PROJECT_THEME.'/transferv1/voucher', $data,TRUE);
                $data['to'] = $data['booking_agent'][0]->billing_email;               
                $data['booking_status'] = $b_data->booking_status;
                $data['pnr_no'] = $pnr_no;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'ACTIVITY_BOOKING_VOUCHER';
                $data['mail_from'] = 'Activity';
        		
                $Response = $this->email_model->sendmail_ActivityTransferVoucher($data,'Activity');
                
                $response = array('status' => 1);

            }else if($b_data->product_name =='TRANSFER'){
            	$this->load->model('payment_model');
            	  $data['b_data'] =  $this->booking_model->getBookingPnr($pnr_no)->row();  
        	   	$data['Booking'] =$this->booking_model->getBookingbyPnr($pnr_no,$b_data->product_name)->row();
	           $booking_global_id=$b_data->booking_global_id;
	           $billing_address_id=$b_data->billing_address_id;

                 $data['Passenger'] = $passenger = $this->booking_model->getPassengerbyid($booking_global_id)->result_array();
                 $data['booking_agent'] = $passenger = $this->booking_model->getagentbyid($billing_address_id)->result();
                 
                 $data['booking_info'] = $bookinginfo = $this->account_model->getBookingbyPnr($pnr_no,$b_data->product_name)->row();
                 $data['cart']	= $cart = $this->cart_model->getBookingTemp_transfer($bookinginfo->referal_id);

				$data['pnr_nos'] = $this->booking_model->getBookingByParentPnr($data['Booking']->parent_pnr_no)->result();
				$global_ids = $this->payment_model->validate_order_id_org($data['Booking']->parent_pnr_no)->result();
				$data['cart'] = $this->db->get_where('booking_transfer', array('booking_transfer_id' => $global_ids[0]->referal_id))->row();
                 $data['mail_voucher'] = true;
                 $data['message'] = $this->load->view(PROJECT_THEME.'/transferv1/voucher', $data,TRUE);
                 
               
               
                $data['to'] = $data['booking_agent'][0]->billing_email;               
                $data['booking_status'] = $b_data->booking_status;
                $data['pnr_no'] = $pnr_no;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'TRANSFER_BOOKING_VOUCHER';
                $data['mail_from'] = 'Transfer';
        		
                $Response = $this->email_model->sendmail_ActivityTransferVoucher($data,'Transfer');
                
                $response = array('status' => 1);
            }
            elseif ($b_data->product_name =='CAR') {
            	 $data['Booking']= $data['b_data']= $this->booking_model->getBookingPnr($pnr_no)->row();

		         $booking_global_id=$data['Booking']->booking_global_id;
		          $billing_address_id=$data['Booking']->billing_address_id;

		         $data['Passenger'] = $passenger = $this->booking_model->getPassengerbyid($booking_global_id)->result();
		         $data['booking_agent'] = $passenger = $this->booking_model->getagentbyid($billing_address_id)->result();
		          $data['mail_voucher'] = true;
		          $data['message'] =  $this->load->view(PROJECT_THEME.'/booking/car_voucher_view', $data,TRUE);
		       
		         $data['to'] = $data['booking_agent'][0]->billing_email;               
	                $data['booking_status'] = $b_data->booking_status;
	                $data['pnr_no'] = $pnr_no;
	                $data['email_access'] = $this->email_model->get_email_acess()->row();
	                $email_type = 'CAR_BOOKING_VOUCHER';
	                $data['mail_from'] = 'Car';
                 $Response = $this->email_model->sendmail_ActivityTransferVoucher($data,'Car');
                
                $response = array('status' => 1);


            }
        }else{
            $response = array('status' => 0);
            echo json_encode($response);
        }

        echo json_encode($response);
        exit;

    }


    /*Made change-13*/

    public function add_feedback(){    

   // $this->input->post();
   //  $data = array(
   //  'feedback_name' => $this->input->post('feedback_name'),
   //  'feedback_email' => $this->input->post('feedback_email'),
   //  'feedback_booking' => $this->input->post('feedback_booking'),
   //  'message' => $this->input->post('message')
   //  );
   //  // print_r($data);
   //  // exit();
   //  //$this->transfer_model->update_supplier_record($id,$data);
   //  $this->general_model->store_data_feedback($data);
      
   //  $this->load->view(PROJECT_THEME.'/dashboard/profile',$data);

    
    $this->form_validation->set_rules('feedback_email', 'feedback Email', 'required|is_unique[user_feedback.feedback_email]');

    if ($this->form_validation->run() == FALSE){
      //$this->load->view('transfer/add_equipment');
    }else{
      $post_data = $this->input->post();
      if (isset($post_data) && is_array($post_data)){
        
      $data['feedback_name'] = $this->input->post('feedback_name');
      $data['feedback_email'] = $this->input->post('feedback_email');
      $data['feedback_booking'] = $this->input->post('feedback_booking');
      $data['message'] = $this->input->post('message');
    }
      
      $this->general_model->store_data_feedback($data);
    }
      
    $this->load->view(PROJECT_THEME.'/dashboard/profile',$data);
  }

   /* show Deal data*/
  public function deal_flight(){ 
  	//$this->input->post();
   $config = array(
	'upload_path' => "./uploads/",
	'allowed_types' => "gif|jpg|png|jpeg|pdf",
	'overwrite' => TRUE,
	'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
	'max_height' => "768",
	'max_width' => "1024"
	);
	$this->load->library('upload', $config);
	if($this->upload->do_upload())
	{
	$data = array('upload_data' => $this->upload->data());
	$this->load->view('upload_success',$data);
	}
	else
	{
	$error = array('error' => $this->upload->display_errors());
	$this->load->view('file_view', $error);
	}
	}


	public function sendMail()
	{

		$this->form_validation->set_rules('email', 'Email', 'required|is_unique[email_invite.email]');

    if ($this->form_validation->run() == FALSE){
      //$this->load->view('transfer/add_equipment');
    }else{
      $post_data = $this->input->post();
      if (isset($post_data) && is_array($post_data)){
       $data['user_id'] = $user_id = $this->session->userdata('user_id'); 
      $data['email'] = $this->input->post('email');
      
  		$config = Array(
	  'protocol' => 'smtp',
	  'smtp_host' => 'ssl://smtp.googlemail.com',
	  'smtp_port' => 465,
	  'smtp_user' => 'sruthi.mailtest@gmail.com', // change it to yours
	  'smtp_pass' => 'mailtest@123', // change it to yours
	  'mailtype' => 'html',
	  'charset' => 'iso-8859-1',
	  'wordwrap' => TRUE
		);

        $message = '';
        $this->load->library('email', $config);
        $this->email->initialize($config);
      $this->email->set_newline("\r\n");
      $this->email->from('abhimanukumar2395@gmail.com'); // change it to yours
      $this->email->to($data['email']);// change it to yours
      $this->email->subject('Resume from JobsBuddy for your Job posting');
      $this->email->message($message);
      if($this->email->send())
     {
      echo 'Email sent.';
     }
     /*else
    	{
     show_error($this->email->print_debugger());
    	}*/
      
    }
      
      $this->general_model->store_invite_email($data);
    }
      
    // $this->load->view(PROJECT_THEME.'/dashboard/profile',$data);
    redirect('dashboard/profile');
  }

	public function promo_deal_list(){
	    $data['promo_deal_list'] =$promo_deal_list=$this->general_model->promo_list_deal()->result();
	    $this->load->view(PROJECT_THEME.'/dashboard/profile',$data);
	}

	public function knowloedge_base(){
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
        $data['user_type']=$user_type =  $this->session->userdata('user_type');
        $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
	    $data['kb'] = $this->general_model->get_knowloedge_base()->result();
	    $this->load->view(PROJECT_THEME.'/dashboard/knowledge_base',$data);
	}
	
	public function change_request(){
		$user_id = $this->session->userdata('user_id');
		$user_type = STAFF_USER;
		$data['change_request'] = $this->db->get_where('change_request', array('user_id' => $user_id,'user_type_id' => $user_type,))->result();
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
		$data['user_type']=$user_type =  $this->session->userdata('user_type'); 		
		$data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);

		$this->load->view(PROJECT_THEME.'/dashboard/change_request',$data);
	}
	
	public function send_change_request(){
	    $data['pnr_no'] = $_POST['pnr'];
	    $data['request'] = $_POST['remarks'];
	    $data['user_id'] = $this->session->userdata('user_id');
	    $data['user_type_id'] = STAFF_USER;
	    $this->db->insert('change_request',$data);
	    redirect('dashboard/change_request');
	    
	}
	
	
	 
}


?>
