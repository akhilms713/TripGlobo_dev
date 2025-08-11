<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class B2b extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('user_model');
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
	
	public function allusers($msg='')
	{
		if($msg!='')
		{
			$data['status'] =json_decode(base64_decode($msg));
		}
		$this->load->library("pagination");
	    $config = array();
        $config["base_url"] = base_url() . "b2b/allusers";
        $config["total_rows"] = $this->user_model->get_allusers_row($this->user_mode);
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config["prev_link"] = "Previous";
        $config["next_link"] = "Next";
        $config['full_tag_open'] = '<ul class="pagination pull-right" style="margin-top: -20px;">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
		$data['total_rows']=$config["total_rows"];
	 
		$data['users'] = $this->user_model->get_allusers($this->user_mode,$config["per_page"], $page);
        

		$data['page_title'] = 'Agent Management';
		$data['promo'] = $this->general_model->get_promo_list(); 
        $this->load->view('b2b/view', $data);
	}
	public function activeusers()
	{
		$this->load->library("pagination");
	    $config = array();
        $config["base_url"] = base_url() . "b2b/activeusers";
        $config["total_rows"] = $this->user_model->get_allusers_status_row($this->user_mode,'ACTIVE');
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config["prev_link"] = "Previous";
        $config["next_link"] = "Next";
        $config['full_tag_open'] = '<ul class="pagination pull-right" style="margin-top: -20px;">';
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
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
		$data['total_rows']=$config["total_rows"];
		$data['users'] = $this->user_model->get_allusers_status($this->user_mode,'ACTIVE',$config["per_page"], $page);
		$data['page_title'] = 'Active Agents';
		$data['promo'] = $this->general_model->get_promo_list(); 
        $this->load->view('b2b/view', $data);
	}
	public function inactiveusers()
	{
		$this->load->library("pagination");
	    $config = array();
        $config["base_url"] = base_url() . "b2b/inactiveusers";
        $config["total_rows"] = $this->user_model->get_allusers_status_row($this->user_mode,'INACTIVE');
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['full_tag_open'] = '<ul class="pagination pull-right" style="margin-top: -20px;">';
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
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
		$data['total_rows']=$config["total_rows"];
		$data['users'] = $this->user_model->get_allusers_status($this->user_mode,'INACTIVE',$config["per_page"], $page);

		$data['page_title'] = 'Inactive Agents';
		$data['promo'] = $this->general_model->get_promo_list(); 
        $this->load->view('b2b/view', $data);
	}
	
	 public function update_user_status() 
	 {
		$id= $_POST['id'];
		$status= $_POST['status'];
		//$this->email_model->send_status_email($id, $status);
        if($this->user_model->update_user_status($id, $status))
		{
			$response = array('status' => 1);
        	echo json_encode($response);
		}
		else
		{
			$response = array('status' => 0);
        	echo json_encode($response);
		}
    }
    
    
     public function update_sa_status(){
		$id= $_POST['id'];
		$status= $_POST['status'];
		
		if($status=="BLOCK"){
		    $this->user_model->update_user_status($id, 'INACTIVE');
		}elseif($status=="ACTIVE"){
		    $this->user_model->update_user_status($id, 'ACTIVE');
		}
	    if($this->user_model->update_sa_status($id, $status)){
			$response = array('status' => 1);
        	echo json_encode($response);
		}
		else
		{
			$response = array('status' => 0);
        	echo json_encode($response);
		}
			redirect(WEB_URL.'b2b/allusers/','refresh');
    }
    
    public function blockusers()
	{
	  //  exit("rahul");
		$data['users'] = $this->user_model->get_block_status($this->user_mode,'BLOCK');
		$data['page_title'] = 'Block Agents';
		$data['promo'] = $this->general_model->get_promo_list(); 
        $this->load->view('b2b/view', $data);
	}
    
    
	
	public function view_profile($user_id)
	{
		$data['user'] = $this->user_model->get_user_details($user_id);
		$data['user_activity'] = $this->user_model->get_user_activity_details($user_id);
		//$data['user_login_session'] = $this->user_model->get_user_login_session_details($user_id);
		//debug($data['user']);exit;
        $this->load->view('b2b/view_profile', $data);
	}
	public function edit_profile($user_id ,$status='')
	{
		$data['status'] = $status;
		$data['user'] = $this->user_model->get_user_details($user_id);
		$data['country'] = $this->user_model->get_country_details();
		
		$this->load->view('b2b/edit_profile', $data);
	}
	public function edit_profile_do($user_id)
	{
		 	
		
		$username = $_POST['username'];
		$iatacode = $_POST['iatacode'];
		$branch = $_POST['branch'];
		
		$c_p_name = $_POST['c_p_name'];
		$c_p_designation = $_POST['c_p_designation'];
		$c_p_email = $_POST['c_p_email'];
		$c_p_phone = $_POST['c_p_phone'];
		
		
		$address = $_POST['address'];
		$city_name = $_POST['city_name'];
		$mobile_phone = $_POST['mobile_phone'];
		$zip_code = $_POST['zip_code'];
		$country_name = $_POST['country_name'];
		$state_name='';
		$user_info = $this->user_model->get_user_details($user_id);
		
		$this->user_model->update_user_details($user_id,$username, $iatacode,$branch,$mobile_phone,$c_p_name,$c_p_designation,$c_p_email,$c_p_phone);
		$this->user_model->update_user_address_details($user_info->address_details_id,$address, $city_name,$state_name,$zip_code,$country_name);
		redirect(WEB_URL.'b2b/edit_profile/'.$user_id.'/1','refresh');
	}
	
	public function send_email_to_user($user_id,$status='')
	{
		$data['status']=$status;
		$data['id']=$user_id;
		$data['user'] = $this->user_model->get_user_details($user_id);
        $this->load->view('b2b/send_email', $data);
	}
	public function send_mail_to_mail()
	{
		
	}
	
	public function send_Verfication_detatils($user_id)
	{
	
		$data['user'] = $this->user_model->get_user_details($user_id);
		$data['verification'] = $this->user_model->get_verification_details($user_id);
		$data['email_opt_number'] = $data['verification']->temp_email_opt;
		$data['mobile_opt_number'] =  $data['verification']->temp_mobile_opt; 
		$data['confirm_url'] = $data['verification']->verification_url;
		$this->email_model->sendmail_agentVerification($data,'AGENT_VERIFICATION_CODE_ADMIN');
		$data2['msg'] = 'Verification details send to user successfully.';
		$data2['status'] = 'success';
		$data2['title'] = 'Send OTP To Users';
		
		$msg = base64_encode(json_encode($data2));
		redirect(WEB_URL.'b2b/allusers/'.$msg,'refresh');
	}
	public function check_user_log_detatils($user_id){
		
		$data['user'] = $this->user_model->get_user_details($user_id);
		$data['log_details'] = $this->user_model->get_user_log_details($user_id);	
		$this->load->view('b2b/login_logs',$data);
	}
	/*public function update_user_status() 
	 {
		$id= $_POST['id'];
		$status= $_POST['status'];
        if($this->user_model->update_user_status($id, $status))
		{
			$response = array('status' => 1);
        	echo json_encode($response);
		}
		else
		{
			$response = array('status' => 0);
        	echo json_encode($response);
		}
    }*/


public function update_b2b_user() 
	 {
        $user1=	$this->user_model->get_allusers($this->user_mode);
        
       // echo "<pre/>";print_r($user1);exit();
        
		   for($i=0;$i<count($user1);$i++){
		       
		       $user11=$user1[$i]->user_id;
		       $cc='TRIP-'.time().'-'.$user11;
		       	  $sql11 = "UPDATE `user_details` SET `user_unique_id` = '$cc' WHERE `user_details`.`user_id` = '$user11'";
                  $this->db->query($sql11);
		   }
		exit("done");
	
	}







}

?>
