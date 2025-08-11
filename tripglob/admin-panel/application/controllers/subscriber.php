<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
class Subscriber extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('admin_model');
		$this->load->model('subscriber_model');
		$this->load->model('general_model');
		$this->load->model('email_model');
		$this->load->model('xmllog_model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		// $this->load->helper('form');
		//$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->load->library('session');

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
	
	public function all_subscriber()
	{
		

		$data['subscriber'] = $this->subscriber_model->get_allsubscriber();	
        $this->load->view('subscribers/view', $data);
	}
	public function update_subscribes_status() 
	 {
		 $id = $_GET['id'];
		 $status = $_GET['status'];
		
        if($this->subscriber_model->subscriber_status1($id, $status))
		{
			$response = array('status' => 1);
        	echo json_encode($response);
        	redirect('all_subscriber','refresh'); 
		}   
		else
		{
			$response = array('status' => 0);
        	echo json_encode($response);
		}
    }
    
    function send_mail($id,$err_msg='')
    {
    	
    	$data['subscriber'] = $this->subscriber_model->get_subscriberbyid($id);
    	$data['id'] = $id;
    	$data['err_msg'] = $err_msg;
		 $this->load->view('subscribers/mail', $data);
    }
    
    function bulk_mail() {
    $this->load->view('subscribers/mail1', $data);
    }
    function b_mail() {
        
        // echo "FUnction will be active on the main server";exit();
       $bodyContent=$_POST['msg'];
       $subject=$_POST['subject'];
       $subscriber = $this->subscriber_model->get_allsubscriber_active();	
      // debug($bodyContent);exit;
      for($i=0;$i<count($subscriber);$i++){
          $email[]=$subscriber[$i]->subscriber_email;          
      } 
      // $bulk_mail='"'.implode(',', $email).'"';
      // debug($bulk_mail);exit();
          $this->email_model->sendpromomail_bulk($email,$subject,$bodyContent);         
      // debug('hi');exit();
      $this->session->set_flashdata('success', 'Email Send Successfully');
      	redirect(WEB_URL.'subscriber/all_subscriber','refresh'); 
       
       
       	
        
    }
    
    
    
    
    

    function mail()
    {
    	$bodyContent=$_POST['msg'];
    	$email=$_POST['to'];
    	$subject=$_POST['subject'];
    	$edit_mail_id = $_POST['edit_mail_id'];
    	$this->form_validation->set_rules('msg', 'Message ', 'required');		
		$this->form_validation->set_rules('to', 'To', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		if ($bodyContent == '') 
		{
			echo "<script>
					alert('Please Enter Mail Message');
					window.location.href='send_mail/".$edit_mail_id."/show';
				</script>";
			exit;
		}
		if ( $this->form_validation->run() !== false ) 
		{
			// debug($email);exit();
			$this->session->set_flashdata('success', 'Email Send Successfully'); 
    	// debug($_POST);exit;
          $this->email_model->sendpromomail_bulk($email,$subject,$bodyContent);         
      // debug('hi');exit();
      
			redirect(WEB_URL.'subscriber/all_subscriber','refresh');			
		}else{
    	// debug($_POST);exit;
			redirect(WEB_URL.'subscriber/send_mail/'.$edit_mail_id.'/show','refresh');	
		}
    

    	
    	

    }


	



	


		
	
}

?>
