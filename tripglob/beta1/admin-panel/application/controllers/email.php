<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Email extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	  $this->check_isvalidated();
		$this->load->model('email_model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      	$this->output->set_header("Pragma: no-cache");
	    $this->load->library('form_validation');
    }
	  private function check_isvalidated(){
		
	 if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
	   {
		       redirect('login/index');
       }
		
		
		
    }
	public function smtp_setting($status='')
	{
		$this->load->model('newsletter_model');
		$data['header_footer'] = $this->newsletter_model->get_email_header_and_footer();
		$data['smtp'] = $this->email_model->get_smtp_access();
		$data['status'] =$status;
        $this->load->view('email/smtp_setting', $data);
	}
	public function smtp_setting_do()
	{
		
		$data['smtp'] = $this->input->post('smtp');
        $data['host'] = $this->input->post('host');
        $data['port'] = $this->input->post('port');
        $data['username'] = $this->input->post('username');
        $data['password'] = $this->input->post('password');
        $this->email_model->update_smtp_setting($data);
        $data_h['div_content'] = $this->input->post('header_content');
		//echo "<pre>"; var_dump($data_h['div_content']); exit;
        $this->email_model->update_email_template_common($data_h,'header');
        $data_f['div_content'] = $this->input->post('footer_content');
        $this->email_model->update_email_template_common($data_f,'footer');
        redirect(WEB_URL.'email/smtp_setting/1');  
		
	}
	// public function manage_email($status='')
	// {
	// 	$data['emails'] = $this->email_model->get_all_email_template();
	// 	$data['status'] =$status;
  //       $this->load->view('email/manage_email', $data);
	// }
	public function manage_email($status=''){
		$data['emails'] = $this->email_model->get_all_email_template_new();
	 	$data['status'] =$status;
    $this->load->view('email/add_manage_email_new', $data);
	}

	// public function edit_email_template($template_id='')
	// {
	// 	if($_POST)
	// 	{
	// 		$data['subject'] = $this->input->post('subject');
	//         $data['email_from'] = $this->input->post('email_from');
	//         $data['email_from_name'] = $this->input->post('email_from_name');
	//         $data['to_email'] = $this->input->post('to_email');
	//         $data['message'] = $this->input->post('email_body');
	//         $this->email_model->update_email($template_id,$data);
		
	//         redirect(WEB_URL.'email/manage_email/1'); 
	// 	}


	// 	if($template_id)
	// 	{
	// 		$template = $this->email_model->get_all_email_template($template_id);
	// 		if($template){
	// 			$data['template'] = $template[0];
	// 		}
	// 		// debug($data['template']->message);exit;
			
  //      		$this->load->view('email/edit_email_template', $data);

	// 	}

		
	// }

public function edit_email_template($template_id=''){
// debug($_POST['id']);exit;
  if ($_POST) {
  if ($_POST['id']) {
    		$this->db->where('id',$_POST['id']);
    		$this->db->update('email_template_new',$_POST);
    	}else{    		
  	$this->db->insert('email_template_new',$_POST);
    	}  	
  }
  if ($template_id!='') {
  	$data['template'] = $this->email_model->get_all_email_template_new($template_id);
  }
  // debug($data);exit;
	$this->load->view('email/add_email_template', $data);
}


	
	public function set_header($status='')
	{
		$data['div_name'] =	$div_name = 'header';
		$data['div_content'] = $this->email_model->get_email_content_common($div_name);
		$data['status'] =$status;
        $this->load->view('email/common_div_content', $data);
	}
	public function set_footer($status='')
	{
		$data['div_name'] = $div_name = 'footer';
		$data['div_content'] = $this->email_model->get_email_content_common($div_name);
		$data['status'] =$status;
        $this->load->view('email/common_div_content', $data);
	}
	public function update_email_div($status='')
	{
		
		$div_name = $_POST['div_name'];
		$div_content = $_POST['div_content'];
		$this->email_model->update_email_div($div_name, $div_content);
		redirect(WEB_URL.'email/manage_email/1','refresh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
