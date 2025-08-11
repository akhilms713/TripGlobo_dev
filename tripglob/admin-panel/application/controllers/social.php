<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Social extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('admin_model');
		$this->load->model('social_model');
		$this->load->model('xmllog_model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		$this->load->library('form_validation');
	}
	private function check_isvalidated()
	{
		if(!$this->session->userdata('admin_logged_in') || $this->session->userdata('admin_id')!= ADMIN_ID )
		{

			if ($this->session->userdata('admin_logged_in')) {
				echo "askjcbjkas1234";
			exit();
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
	function add_sociallink()
	{
	$this->load->view('social/add_new');
	}
	function add_new_sociallink_do()
	{
		
		$this->form_validation->set_rules('social_link_name', 'social_link name', 'required');
		$this->form_validation->set_rules('social_link', 'social_link', 'required|url');
		$this->form_validation->set_rules('social_icon', 'social_icon', 'required');		
		$this->form_validation->set_rules('position', 'position', 'required');
		if ( $this->form_validation->run() !== false ) 
		{

			$social_link_name =$_POST['social_link_name'];
			$link=$_POST['social_link'];
			$position=$_POST['position'];
			$icon=$_POST['social_icon'];			
			$status='ACTIVE';
			
		

			$insert_data=array(
				"social_link_name"=>$social_link_name,
				"link"=>$link,
				"icon"=>$icon,
				"image"=>"",
				"position"=>$position,
				"status"=>$status
				);
			 $this->social_model->add_new_sociallink_do($insert_data);
			    echo '<script type="text/javascript">';
                echo ' alert("Social Link added successful")';  //not showing an alert box.
                echo '</script>';
                			 
			redirect(WEB_URL.'social/all_social_link','refresh');

		}
		else
		{
			redirect(WEB_URL.'social/add_sociallink','refresh');
		}
	}
	public function all_social_link()
	{
		
		$data['social_link'] = $this->social_model->all_social_link();	
        $this->load->view('social/view', $data);
	}
	public function update_social_status() 
	 {
		 $id = $_GET['id'];
		 $status = $_GET['status'];
		
        if($this->social_model->update_social_status1($id, $status))
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
    function edit_social_link($id){
		$data['social_link']	=	$this->social_model->get_social_linkbyid($id);
		$this->load->view('social/edit_social', $data);
	}


function update_social_link_do()
{
	
	$this->form_validation->set_rules('social_link_name', 'social_link name', 'required');
	$this->form_validation->set_rules('social_link', 'social_link', 'required|url');
	$this->form_validation->set_rules('social_icon', 'social_icon', 'required');		
	$this->form_validation->set_rules('position', 'position', 'required');
	if ( $this->form_validation->run() !== false ) 
	{
		$social_link_details_id=$_POST['social_link_details_id'];
		$social_link_name =$_POST['social_link_name'];
		$link=$_POST['social_link'];
		$position=$_POST['position'];
		$icon=$_POST['social_icon'];			
		$status=$_POST['status'];
	

		$update_data=array(
			"social_link_name"=>$social_link_name,
			"link"=>$link,
			"icon"=>$icon,
			"image"=>"",
			"position"=>$position,
			"status"=>$status
			);
		}
	else{
		
		redirect(WEB_URL.'social/all_social_link','refresh');
	}	

		 $this->social_model->update_social_link_do($update_data,$social_link_details_id);			
		redirect(WEB_URL.'social/all_social_link','refresh');

	

}

	function delete_social_link($id)
{	
	$this->social_model->delete_social_linkbyid($id);
	redirect(WEB_URL.'social/all_social_link','refresh');
}


	


		
	
}

?>
