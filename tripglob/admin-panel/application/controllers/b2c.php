<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class B2c extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('user_model');
		$this->load->model('email_model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      	$this->output->set_header("Pragma: no-cache");
	    $this->load->library('form_validation');
		$this->user_mode = 'B2C';
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
	public function allusers()
	{
		$this->load->library("pagination");
	    $config = array();
        $config["base_url"] = base_url() . "b2c/allusers";
        $config["total_rows"] = $this->user_model->get_allusers_row($this->user_mode);
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
		$data['page_title'] = 'B2C User Management';
		$data['promo'] = $this->general_model->get_promo_list(); 
		// echo "<pre>";
		// print_r($data['users']);
		// exit;

        $this->load->view('b2c/view', $data);
	}
	public function activeusers()
	{
		
		$this->load->library("pagination");
	    $config = array();
        $config["base_url"] = base_url() . "b2c/activeusers";
        $config["total_rows"] = $this->user_model->get_allusers_status_row($this->user_mode,'ACTIVE');
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
        $config['first_tag_open'] = '<li class="page-item" disabled>';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
		$data['total_rows']=$config["total_rows"];

		$data['users'] = $this->user_model->get_allusers_status($this->user_mode,'ACTIVE',$config["per_page"], $page);
		$data['page_title'] = 'Active User Management';
		$data['promo'] = $this->general_model->get_promo_list();
        $this->load->view('b2c/view', $data);
	}
	public function inactiveusers()
	{

		$this->load->library("pagination");
	    $config = array();
        $config["base_url"] = base_url() . "b2c/inactiveusers";
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

		$data['page_title'] = 'Inactive User Management';
		$data['promo'] = $this->general_model->get_promo_list(); 
        $this->load->view('b2c/view', $data);
	}
	
	 public function update_user_status() 
	 {
		$id = $_GET['id'];
		$status = $_GET['status'];
      
        $user_type=$this->db->get_where('user_login_details',array('user_id'=>$id))->row();
        $user_data=$this->db->get_where('user_details',array('user_id'=>$id))->row();
        $url='';

        if ($user_type->user_type_id==1) {
			if ($status == 'INACTIVE') {
			$type='AGENT_DEACTIVATION';
			}else{
			$type='AGENT_ACTIVATION';
			$url='https://tripglobo.com/account/agent_login';
			}
        }elseif ($user_type->user_type_id==2) {
			if ($status == 'INACTIVE') {
			$type='B2C_DEACTIVATION';
			}else{
			$url='https://tripglobo.com';
			$type='B2C_ACTIVATION';
			}
        }else{
			if ($status == 'INACTIVE') {
			$type='STAFF_DEACTIVATION';
			}else{
			$url='https://tripglobo.com/account/staff_login';
			$type='STAFF_ACTIVATION';
			}
        }

         $this->load->model('email_model');
         $this->email_model->status_admin_email($type,$id,$url,$user_data);
        
		// $this->email_model->send_status_email($id, $status);
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
	
	public function view_profile($user_id)
	{
		$data['user'] = $this->user_model->get_user_details($user_id);
		$data['user_activity'] = $this->user_model->get_user_activity_details($user_id);
		//debug($data);exit;
		//$data['user_login_session'] = $this->user_model->get_user_login_session_details($user_id);
        $this->load->view('b2c/view_profile', $data);
	}
	public function edit_profile($user_id ,$status='')
	{
		$data['status'] = $status;
		$data['user'] = $this->user_model->get_user_details($user_id);
		$data['country_details'] = $this->user_model->get_country_details();
		//debug($data);exit;
		$this->load->view('b2c/edit_profile', $data);
	}
	public function edit_profile_do($user_id)
	{

		//debug($user_id);
		 $username = $_POST['username'];
		 $home_phone = $_POST['home_phone'];
		$mobile_phone = $_POST['mobile_phone'];
		$address = $_POST['address'];
		$city_name = $_POST['city_name'];
		$state_name = $_POST['state_name'];
		$zip_code = $_POST['zip_code'];
		$country_name = $_POST['country_name'];
		$user_info = $this->user_model->get_user_details($user_id);
		
		$this->user_model->update_b2cuser_details($user_id,$username, $_POST['home_phone'],$_POST['mobile_phone']);
		$this->user_model->update_user_address_details($user_info->address_details_id,$address, $city_name,$state_name,$zip_code,$country_name);
		redirect(WEB_URL.'b2c/edit_profile/'.$user_id.'/1','refresh');
		//echo "<script>alert('Sucess ! Data is updated.');</script>";
		//redirect(WEB_URL.'b2c/edit_profile/','refresh');
		
		
	}
	
	public function send_email_to_user($user_id,$status='')
	{
		$data['status']=$status;
		$data['id']=$user_id;
		$data['user'] = $this->user_model->get_user_details($user_id);
        $this->load->view('b2c/send_email', $data);
	}
	public function send_mail_to_mail($id)
	{
		echo '<pre/>';
		print_r($_POST);exit;
	}
	
}

?>
