<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Adevertise extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('admin_model');
		$this->load->model('adevertise_model');
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
	function add_adevertise()
	{
	$this->load->view('adevertise/add_new');
	}
	function add_new_adevertise_do()
	{
		
		$this->form_validation->set_rules('add_title', 'add_title', 'required');		
		$this->form_validation->set_rules('link', 'link', 'required|URL');
		$this->form_validation->set_rules('position', 'position', 'required');
		if ( $this->form_validation->run() !== false ) 
		{

			$add_title =$_POST['add_title'];			
			$link = $_POST['link'];			
			$position = $_POST['position'];
			$adv_amount = $_POST['adv_amount'];
			$status='ACTIVE';
			$Adevertise_image1 ='';	
			
			
		if(isset($_FILES["Adevertise_image"]["name"]) && $_FILES["Adevertise_image"]["name"]!='')
		{
			 $logo_image = explode(".",$_FILES["Adevertise_image"]["name"]);
			$newlogoname = date('YmdHis').rand(1,9999999) . '.' .end($logo_image);
			$tmpnamert=$_FILES['Adevertise_image']['tmp_name'];
	
			//move_uploaded_file($tmpnamert, 'uploads/adevertise/'.$newlogoname);

			$this->compressImage($tmpnamert, 'uploads/adevertise/'.$newlogoname,60);
			
			$Adevertise_image1=WEB_URL.'uploads/adevertise/'.$newlogoname;

			$insert_data=array(
				"advertise_image"=>$Adevertise_image1,
				"link_type"=>$add_title,				
				"link"=>$link,				
				"position"=>$position,
				"amount"=>$adv_amount,
				"advertise_status"=>$status
				);
			 $this->adevertise_model->add_new_adevertise_do($insert_data);		
		}		
		else
			{
				$status=11;
			}
			
			redirect(WEB_URL.'adevertise/all_adevertise','refresh');

		}
		redirect(WEB_URL.'adevertise/all_adevertise','refresh');
	}
	public function all_adevertise()
	{
		
		$data['adevertise'] = $this->adevertise_model->get_alladevertise();	
        $this->load->view('adevertise/view', $data);
	}
	public function update_adevertise_status() 
	 {
		  $id = $_GET['id'];
		 $status = $_GET['status'];

		
        if($this->adevertise_model->update_adevertise_status1($id, $status))
		{
			$response = array('advertise_status' => 1);
        	echo json_encode($response);
		}
		else
		{
			$response = array('advertise_status' => 0);
        	echo json_encode($response);
		}
    }
    function edit_adevertise($id){
		$data['adevertise']	=	$this->adevertise_model->get_adevertisebyid($id);
		$this->load->view('adevertise/edit_adevertise', $data);
	}


	function update_adevertise_do()
	{
		$this->form_validation->set_rules('add_title', 'add_title', 'required');		
		$this->form_validation->set_rules('link', 'link', 'required|URL');
		$this->form_validation->set_rules('position', 'position', 'required');
		if ( $this->form_validation->run() !== false ) 
		{
			//echo "<pre>";
			$id=$_POST['advertise_id'];
			$add_title =$_POST['add_title'];			
			$link = $_POST['link'];			
			$position = $_POST['position'];
			$adv_amount = $_POST['adv_amount'];
			$status= $_POST['status'];		
			$Adevertise_image1 =$_POST['old_image'];
			#echo $Adevertise_image1;
			$hhotel=explode('/',$Adevertise_image1);	
			// /$hhotel  =array_filter($hhotel);
			

		if(isset($_FILES["Adevertise_image"]["name"]) && $_FILES["Adevertise_image"]["name"]!='')
		{
				//$image_name=$hhotel['7'];
				$image_name = end($hhotel);
				
				unlink('uploads/adevertise/'.$image_name);				

			 $logo_image = explode(".",$_FILES["Adevertise_image"]["name"]);
			$newlogoname = date('YmdHis').rand(1,9999999) . '.' .end($logo_image);
			$tmpnamert=$_FILES['Adevertise_image']['tmp_name'];
	
			//move_uploaded_file($tmpnamert, 'uploads/adevertise/'.$newlogoname);

			$this->compressImage($tmpnamert, 'uploads/adevertise/'.$newlogoname,60);
			
			$Adevertise_image1=WEB_URL.'uploads/adevertise/'.$newlogoname;

			$update_data=array(
				"advertise_image"=>$Adevertise_image1,
				"link_type"=>$add_title,				
				"link"=>$link,				
				"position"=>$position,
				"amount"=>$adv_amount,
				"advertise_status"=>$status
				);
				
		}		
		else
			{

			$update_data=array(
				"advertise_image"=>$Adevertise_image1,
				"link_type"=>$add_title,				
				"link"=>$link,				
				"position"=>$position,
				"amount"=>$adv_amount,
				"advertise_status"=>$status
				);
			}
			 
			 
			 $this->adevertise_model->update_adevertise_do($update_data,$id);
			
			redirect(WEB_URL.'adevertise/all_adevertise','refresh');

		}
		
	redirect(WEB_URL.'adevertise/all_adevertise','refresh');

	}

	function delete_adevertise($id)
{
	$data['adevertise']	=	$this->adevertise_model->get_adevertisebyid($id);
	$hotel_image1 =$data['adevertise']['0']->advertise_image;	
	$hhotel=explode('/',$hotel_image1);
	$image_name=$hhotel['7'];
	unlink('uploads/adevertise/'.$image_name);
	$this->adevertise_model->delete_adevertisebyid($id);
	redirect(WEB_URL.'adevertise/all_adevertise','refresh');
}


	


		
	
}

?>
