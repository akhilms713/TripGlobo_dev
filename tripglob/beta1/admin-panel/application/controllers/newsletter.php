<?php  
/**
 * @author 
 * Date Time
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Newsletter extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('newsletter_model');
		$this->load->model('email_model');
		$this->check_isvalidated();
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

	public function index()
	{
		$data["newsletter_templates"] = $this->newsletter_model->get_newsletter_templates();
		$this->load->view('newsletter/newsletter', $data);
	}

	public function add_newsletter()
	{
		$this->load->view('newsletter/add_newsletter');
	}

	public function add_newsletter_template(){

		if ($_FILES["newsletter_template_image"]["tmp_name"] != "" || $_FILES["newsletter_template_image"]["tmp_name"] != null) {
			$config['upload_path'] = "./uploads/newsletter/";
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1024';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->do_upload('newsletter_template_image');
			$data["template_images"] = UPLOADS."newsletter/".$this->upload->file_name;
		
			//echo $this->upload->display_errors(); exit;
		}
		else
		{
			$data["template_images"] = UPLOADS."newsletter/no-image.png";
		}

		$data["template_name"] = $this->input->post("newsletter_template_name");
		$data["template_content"] = $this->input->post("newsletter_template_content");
		$this->newsletter_model->add_newsletter_template($data);
		redirect(WEB_URL.'newsletter/');
	}

	public function change_newsletter_status(){
		$id = $this->input->post("id");
		$data["template_status"] = $this->input->post("status");
		$response = $this->newsletter_model->change_newsletter_status($id, $data);
		return $response;
	}

	public function edit_newsletter_template($template_id){
		$data["newsletter_templates"] = $this->newsletter_model->get_newsletter_templates($template_id);
		if (!empty($data["newsletter_templates"])) {
			$this->load->view('newsletter/edit_newsletter_template', $data);
		}
		else{
			redirect(WEB_URL.'newsletter/');
		}
		
	}

	public function update_newsletter_template(){
		if ($_FILES["newsletter_template_image"]["tmp_name"] != "" || $_FILES["newsletter_template_image"]["tmp_name"] != null) {
			$config['upload_path'] = "./uploads/newsletter/";
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1024';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->do_upload('newsletter_template_image');
			$data["template_images"] = UPLOADS."newsletter/".$this->upload->file_name;
		}
		else{
			$data["template_images"] = $this->input->post("old_image");
		}
		$id = $this->input->post("newsletter_template_id");
		$data["template_name"] = $this->input->post("newsletter_template_name");
		$data["template_content"] = $this->input->post("newsletter_template_content");
		$this->newsletter_model->update_newsletter_template($id, $data);
		redirect(WEB_URL.'newsletter/');
	}

	public function delete_template(){
		$id = $this->input->post("template_id");
		$response = $this->newsletter_model->delete_template($id);
		return $response;
	}
	public function fetch_newsletter_template($id){

		$newsletter_templates = $this->newsletter_model->get_newsletter_templates($id);
		//echo "<pre/>"; print_r($data["newsletter_templates"]);
		echo json_encode($newsletter_templates[0]);
	}
	public function campaign(){
		$data["campaign"] = $this->newsletter_model->get_campaign();

		$this->load->view('newsletter/campaign', $data);
	}

	public function select_campaign()
	{
		$data["newsletter_templates"] = $this->newsletter_model->get_newsletter_templates(NULL,'*',array('template_status' => 1));
		$this->load->view('newsletter/select_campaign', $data);
	}

	public function add_campaign($template_id){
		$data["newsletter_templates"] = $this->newsletter_model->get_newsletter_templates($template_id);
		
		//echo "<pre>"; var_dump($data["newsletter_templates"] );

		$this->load->view('newsletter/add_campaign', $data);
	}
	public function add_campaign_template(){
		$data["campaign_name"] = $this->input->post("campaign_template_name");
		$data["email_subject"] = $this->input->post("campaign_email_sub");
		$data["email_from"] = $this->input->post("campaign_email_from");
		$data["email_from_name"] = $this->input->post("campaign_email_from_name");
		$data["campaign_email_to"] = $this->input->post("campaign_email_cc");
		$data["campaign_template"] = $this->input->post("campaign_content");
		$data["template_id"] = $this->input->post("template_id");
		$response = $this->newsletter_model->add_campaign_template($data);

		if ($response) {
			redirect(WEB_URL.'newsletter/campaign');
		}
	}
	public function delete_campaign(){
		$campaign_id = $this->input->post("campaign_id");
		$response = $this->newsletter_model->delete_campaign($campaign_id);
		if ($response) {
			echo "Delete Successfully";
		}
		else{
			echo "Something went wrong";
		}
	}
	public function fetch_campaign_template($id){
		$data["campaign_templates"] = $this->newsletter_model->get_campaign($id);
		echo json_encode($data["campaign_templates"][0]);
	}
	public function edit_campaign_template($campaign_id){
		$data["campaign"] = $this->newsletter_model->get_campaign($campaign_id);
		if (!empty($data["campaign"])) {
			$this->load->view('newsletter/edit_campaign', $data);
		}
		else{
			redirect(WEB_URL.'newsletter/campaign');
		}
		
	}
	public function update_campaign(){
		$id = $this->input->post("campaign_id");
		$data["campaign_name"] = $this->input->post("campaign_template_name");
		$data["email_subject"] = $this->input->post("campaign_email_sub");
		$data["email_from"] = $this->input->post("campaign_email_from");
		$data["email_from_name"] = $this->input->post("campaign_email_from_name");
		$data["campaign_email_to"] = $this->input->post("campaign_email_cc");
		$data["campaign_template"] = $this->input->post("campaign_content");
		$data["template_id"] = $this->input->post("template_id");

		$response = $this->newsletter_model->update_campaign($id, $data);

		if ($response) {
			redirect(WEB_URL.'newsletter/campaign');
		}
	}

	public function b2b_subscribers(){
		$b2b_id = 1;
		$data["b2b_subscribers"] = $this->newsletter_model->get_subscribers($b2b_id);
		$this->load->view('newsletter/b2b_subscribers', $data);
	}
	public function get_newsletter_template()
	{
		$tmplt_arr = $this->input->post('data');
		$id = $this->input->post('id');
		echo json_encode( $tmplt_arr [$id]);
	}



	
	public function b2c_subscribers(){
		$b2b_id = 2;
		$data["b2c_subscribers"] = $this->newsletter_model->get_subscribers($b2b_id);
		$this->load->view('newsletter/b2c_subscribers', $data);
	}
	public function unregistered_subscribers(){
		$data["unregistered_subscribers"] = $this->newsletter_model->get_unregistered_subscribers();
		$this->load->view('newsletter/unregistered_subscribers', $data);
	}
	public function send_test_campaign_email() {


        $id = $this->input->post('id');
        $emailid = $this->input->post('emailid');
        $mail_list = explode(';', $emailid);
        $mail_content_arr = $this->newsletter_model->get_campaign($id);
        $mail_content = $mail_content_arr[0];
        $email_config = $this->email_model->get_smtp_access();
        $sendemail = $this->email_model->sendmail_reg($mail_list, $mail_content, $email_config);
    }
    public function send_campaign_email($id) {
        
        $allB2c_check = $this->input->post('allB2c');
        $allB2b_check = $this->input->post('allB2b');
        $allSub_check = $this->input->post('allSub');

        if($allB2c_check == 1) {
            $b2c_email_id = $this->email_model->get_subscriber_email_id(2);            
        } else {
            $b2c_email_id = array();
        }
        
        if($allB2b_check == 1) {
            $b2b_email_id = $this->email_model->get_subscriber_email_id(1);               
        } else {
            $b2b_email_id = array();
        }
        
        if($allSub_check == 1) {
            $allSub_email_id = $this->email_model->get_subscriber_email_id();
        } else {
            $allSub_email_id = array();
        }

        $additional_emails = $this->email_model->get_additional_campaign_email($id);
        if($additional_emails != "") {
            $additional_emails_array = explode(';', $additional_emails[0]->campaign_email_to);            
        } else {
            $additional_emails_array = array();    
        }

        $mail_list = array();
        if (!empty($b2c_email_id)) {
            foreach ($b2c_email_id as $mail_id) {
                $mail_list[] = $mail_id->email . '';
            }
        }

        if (!empty($b2b_email_id)) {
            foreach ($b2b_email_id as $mail_id) {
                $mail_list[] = $mail_id->email_id . '';
            }
        }
        if (!empty($allSub_email_id)) {
            foreach ($allSub_email_id as $mail_id) {
                $mail_list[] = $mail_id->email_id . '';
            }
        }
        
        $mail_list = array_merge($mail_list, $additional_emails_array); 
        $mail_content_arr = $this->newsletter_model->get_campaign($id);
        $mail_content = $mail_content_arr[0];
        $email_config = $this->email_model->get_smtp_access();
        $get_email_from_id = $this->email_model->get_from_email($id);
        $email_from_id = $get_email_from_id->email_from;
        $sendemail = $this->email_model->sendCampaignEmail($mail_list, $mail_content, $email_config, $email_from_id);
    }
	public function delete_subscriber(){
		$subscriber_id = $this->input->post("subscriber_id");
		$response = $this->newsletter_model->delete_subscriber($subscriber_id);
		if ($response) {
			echo "Delete Successfully";
		}
		else{
			echo "Something went wrong";
		}
	}

}
