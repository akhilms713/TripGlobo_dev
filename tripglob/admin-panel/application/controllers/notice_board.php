<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Notice_Board extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('noticeboard_model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      	$this->output->set_header("Pragma: no-cache");
	    $this->load->library('form_validation');
 
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
    
    public function add_notice($status=''){
		$data['status'] = $status;
		$this->load->view('notice_board/add_new_notice',$data);
	}
	
	public function add_newnotice(){
		$this->form_validation->set_rules('users', 'users', 'required');
		$this->form_validation->set_rules('expiry', 'expiry', 'required');
		$this->form_validation->set_rules('notice_content', 'notice_content', 'required');
		if($this->form_validation->run()==FALSE){
			redirect("notice_board/add_notice/0",'refresh');	
		}else{
			$users = $_REQUEST['users'];
			$expiry = $_REQUEST['expiry'];
			$message = $_REQUEST['notice_content'];
			
			if($this->noticeboard_model->update_notice($users, $expiry, $message)){
				redirect("notice_board/notice_list/1",'refresh');
			}else{
				redirect("notice_board/notice_list/0",'refresh');
			}
		}
	}
	
	public function notice_list($status=''){
		$data['result'] = $this->noticeboard_model->get_notice_list(); 
		$data['status'] = $status;
		$this->load->view('notice_board/notice_list',$data);
	}

	public function delete_notice(){
		if($this->noticeboard_model->delete_notice($_REQUEST['notice_id']))
			{
				redirect("notice_board/notice_list/1",'refresh');
			}
			else
			{
				redirect("notice_board/notice_list/0",'refresh');
			}
	}
	public function change_notice_status(){
		$id= $_POST['id'];
		$status= $_POST['status'];
		if($this->noticeboard_model->update_notice_status($id,  $status))
		{
			 $response = array('status' => 1);
        		echo json_encode($response);
		}
		else
		{
			 $response = array('status' => 1);
        		echo json_encode($response);
		}
	}
	


}

?>
