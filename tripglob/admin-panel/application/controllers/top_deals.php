<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
class Top_deals extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('admin_model');
		$this->load->model('topdeals_model');
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
	function add_topdeals()
	{
	$this->load->view('topdeals/add_new');
	}
	function add_topdeals_do()
	{
		$this->form_validation->set_rules('from', 'city name', 'required');
		$this->form_validation->set_rules('offer_title', 'offer title', 'required');
		$this->form_validation->set_rules('offer_desc', 'offer desc', 'required');
		$this->form_validation->set_rules('special_title', 'special title', 'required');
		$this->form_validation->set_rules('special_desc', 'special desc', 'required');
		$this->form_validation->set_rules('depature', 'check in', 'required');
		$this->form_validation->set_rules('return', 'check out', 'required');
		$this->form_validation->set_rules('link', 'link', 'required');
		$this->form_validation->set_rules('position', 'position', 'required');
		if ( $this->form_validation->run() !== false ) 
		{

			$city_name =$_POST['from'];
			$offer_title=$_POST['offer_title'];
			$offer_desc=$_POST['offer_desc'];
			$special_title=$_POST['special_title'];
			$special_desc=$_POST['special_desc'];
			$check_in = $_POST['depature'];
			$check_out = $_POST['return'];
			$link = $_POST['link'];			
			$position = $_POST['position'];
			$status='ACTIVE';
			$deal_image ='';	
			
			
		if(isset($_FILES["deal_image"]["name"]) && $_FILES["deal_image"]["name"]!='')
		{
			 $logo_image = explode(".",$_FILES["deal_image"]["name"]);
			$newlogoname = date('YmdHis').rand(1,9999999) . '.' .end($logo_image);
			$tmpnamert=$_FILES['deal_image']['tmp_name'];
	
			move_uploaded_file($tmpnamert, 'uploads/topdeals/'.$newlogoname);
			
			$deal_image=WEB_URL.'uploads/topdeals/'.$newlogoname;

			$insert_data=array(
				"city"=>$city_name,
				"offer_title"=>$offer_title,
				"offer_desc"=>$offer_desc,
				"special_title"=>$special_title,
				"special_desc"=>$special_desc,
				"checkin_date"=>$check_in,
				"checkout_date"=>$check_out,
				"link"=>$link,
				"deal_image"=>$deal_image,
				"position"=>$position,
				"status"=>$status,
				);
			 $this->topdeals_model->add_new_topdeal_do($insert_data);		
		}		
		else
			{
				$status=11;
			}
			
			redirect(WEB_URL.'top_deals/add_topdeals','refresh');

		}
		redirect(WEB_URL.'top_deals/add_topdeals','refresh');
	}
	public function all_topdeals()
	{
		
		$data['topdeals'] = $this->topdeals_model->get_alltopdeals();	
        $this->load->view('topdeals/view', $data);
	}
	public function update_topdeals_status() 
	 {
		 $id = $_GET['id'];
		 $status = $_GET['status'];
		
        if($this->topdeals_model->update_topdeals_status1($id, $status))
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
    function edit_deal($id){
		$data['deal']	=	$this->topdeals_model->get_topdealbyid($id);
		$this->load->view('topdeals/edit_topdeal', $data);
	}


	function update_topdeals_do()
	{
		$this->form_validation->set_rules('from', 'city name', 'required');
		$this->form_validation->set_rules('offer_title', 'offer title', 'required');
		$this->form_validation->set_rules('offer_desc', 'offer desc', 'required');
		$this->form_validation->set_rules('special_title', 'special title', 'required');
		$this->form_validation->set_rules('special_desc', 'special desc', 'required');
		$this->form_validation->set_rules('depature', 'check in', 'required');
		$this->form_validation->set_rules('return', 'check out', 'required');
		$this->form_validation->set_rules('link', 'link', 'required');
		$this->form_validation->set_rules('position', 'position', 'required');
		if ( $this->form_validation->run() !== false ) 
		{
			$id=$_POST['deal_id'];
			$city_name =$_POST['from'];
			$offer_title=$_POST['offer_title'];
			$offer_desc=$_POST['offer_desc'];
			$special_title=$_POST['special_title'];
			$special_desc=$_POST['special_desc'];
			$check_in = $_POST['depature'];
			$check_out = $_POST['return'];
			$link = $_POST['link'];			
			$position = $_POST['position'];
			$status=$_POST['status'];
			$deal_image =$_POST['old_image'];
			$hhotel=explode('/',$deal_image);	
			
			
		if(isset($_FILES["deal_image"]["name"]) && $_FILES["deal_image"]["name"]!='')
		{
				$image_name=$hhotel['7'];
				unlink('uploads/topdeals/'.$image_name);				

			 $logo_image = explode(".",$_FILES["deal_image"]["name"]);
			$newlogoname = date('YmdHis').rand(1,9999999) . '.' .end($logo_image);
			$tmpnamert=$_FILES['deal_image']['tmp_name'];
	
			move_uploaded_file($tmpnamert, 'uploads/topdeals/'.$newlogoname);
			
			$deal_image=WEB_URL.'uploads/topdeals/'.$newlogoname;

			$insert_data=array(
				"city"=>$city_name,
				"offer_title"=>$offer_title,
				"offer_desc"=>$offer_desc,
				"special_title"=>$special_title,
				"special_desc"=>$special_desc,
				"checkin_date"=>$check_in,
				"checkout_date"=>$check_out,
				"link"=>$link,
				"deal_image"=>$deal_image,
				"position"=>$position,
				"status"=>$status,
				);
				
		}		
		else
			{

			$insert_data=array(
				"city"=>$city_name,
				"offer_title"=>$offer_title,
				"offer_desc"=>$offer_desc,
				"special_title"=>$special_title,
				"special_desc"=>$special_desc,
				"checkin_date"=>$check_in,
				"checkout_date"=>$check_out,
				"link"=>$link,
				"deal_image"=>$deal_image,
				"position"=>$position,
				"status"=>$status,
				);
			}
			//~ echo "<pre/>";print_r($insert_data);exit;
			
			 $this->topdeals_model->update_topdeal_do($insert_data,$id);	
			redirect(WEB_URL.'top_deals/all_topdeals','refresh');

		}

	}

	function delete_topdeal($id)
{
	$data['deal']	=	$this->topdeals_model->get_topdealbyid($id);
	$hotel_image1 =$data['deal']['0']->deal_image;	
	$hhotel=explode('/',$hotel_image1);
	$image_name=$hhotel['7'];
	unlink('uploads/topdeals/'.$image_name);
	$this->topdeals_model->delete_topdealbyid($id);
	redirect(WEB_URL.'top_deals/all_topdeals','refresh');
}


	


		
	
}

?>
