<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Tophotels extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('admin_model');
		$this->load->model('tophotel_model');
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
	function add_tophotels()
	{
	$this->load->view('tophotels/add_new');
	}
	function add_tophotels_do()
	{
		
		$this->form_validation->set_rules('from', 'city name', 'required');		
		// $this->form_validation->set_rules('depature', 'check in', 'required');
		// $this->form_validation->set_rules('return', 'check out', 'required');
		// $this->form_validation->set_rules('link', 'link', 'required');
		// $this->form_validation->set_rules('position', 'position', 'required|numeric');
          
// if (empty($_FILES['hotel_image']['name']))
// {
// 	echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
// 
// }
		// echo "<pre>"; print_r($_POST); exit();
		if ( $this->form_validation->run() !== false ) 
		{
			 $city_name =$_POST['from'];
			//  $check_in = $_POST['depature'];
			// $check_out = $_POST['return'];
			// $link = $_POST['link'];			
			//  $position = $_POST['position'];
			$status='ACTIVE';
			$hotel_image ='';	
			$city_id = $_POST['city_id'];
			
		if(isset($_FILES["hotel_image"]["name"]) && $_FILES["hotel_image"]["name"]!='')
		{
			 $logo_image = explode(".",$_FILES["hotel_image"]["name"]);
			 $ext=$logo_image['1'];
			 // echo "<pre>"; print_r($logo_image); exit();
			 $types = array('jpeg', 'gif', 'png','jpg');
		     if (in_array($ext, $types)) {
			$newlogoname = date('YmdHis').'.' .end($logo_image);
			$tmpnamert=$_FILES['hotel_image']['tmp_name'];	
			//move_uploaded_file($tmpnamert, 'uploads/hotel/'.$newlogoname);

			// $this->compressImage($tmpnamert,'uploads/hotel/'.$newlogoname,60);
			$this->compressImage($tmpnamert,'uploads/hotel/'.$newlogoname,60);
			$hotel_image=$newlogoname;

			$insert_data=array(
				"city"=>$city_name,
				// "checkin_date"=>$check_in,
				// "checkout_date"=>$check_out,
				// "link"=>$link,
				"hotel_image"=>$hotel_image,
				// "position"=>$position,
				"status"=>$status,
				"city_id"=>$city_id
				);

				 $this->tophotel_model->add_new_tophotel($insert_data);		

				 redirect(WEB_URL.'tophotels/all_tophotels','refresh');

		}	
			else
			{
				$this->session->set_flashdata('img_msg','Invalid file type, Only JPEG, JPG, GIF and PNG types are accepted.');
			  	redirect(WEB_URL.'tophotels/add_tophotels','refresh');
			}	
	    }
		else
			{
			$srror_msg="not upload";	
			}
		
			
			redirect(WEB_URL.'tophotels/add_tophotels','refresh');

		}
		else
		{
			redirect(WEB_URL.'tophotels/add_tophotels','refresh');
		}

	}
	public function all_tophotels()
	{
		
		$data['tophotels'] = $this->tophotel_model->get_alltophotels();	
        $this->load->view('tophotels/view', $data);
	}
	 public function update_tophotel_status() 
	 {
		$id= $_GET['id'];
		$status= $_GET['status'];
        if($this->tophotel_model->update_tophotel_status1($id, $status))
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
    function edit_tophotel($id){
		$data['tophotel']	=	$this->tophotel_model->get_tophotelbyid($id);
		
		$this->load->view('tophotels/edit_tophotel', $data);
	}

	function update_tophotels_do()
	{
		$this->form_validation->set_rules('from', 'city name', 'required');		
		// $this->form_validation->set_rules('depature', 'check in', 'required');
		// $this->form_validation->set_rules('return', 'check out', 'required');
		// $this->form_validation->set_rules('link', 'link', 'required');
		// $this->form_validation->set_rules('position', 'position', 'required|numeric');
		if ( $this->form_validation->run() !== false ) 
		{
			$id=$_POST['hotel_id'];
			 $city_name =$_POST['from'];
			//  $check_in = $_POST['depature'];
			// $check_out = $_POST['return'];
			// $link = $_POST['link'];			
			//  $position = $_POST['position'];
			$hotel_image1 =$_POST['old_image'];	
			$hhotel=explode('/',$hotel_image1);

			$status=$_POST['status'];
			if(isset($_FILES["hotel_image"]["name"]) && $_FILES["hotel_image"]["name"]!='')
			{
				$image_name=$hhotel['8'];
				unlink('uploads/hotel/'.$image_name);
				

			$logo_image = explode(".",$_FILES["hotel_image"]["name"]);
			$newlogoname = date('YmdHis').rand(1,9999999) . '.' .end($logo_image);
			$tmpnamert=$_FILES['hotel_image']['tmp_name'];
	
			//move_uploaded_file($tmpnamert, 'uploads/hotel/'.$newlogoname);

			$this->compressImage($tmpnamert,'uploads/hotel/'.$newlogoname,60);
			
			$hotel_image1=$newlogoname;
			$update_data=array(
				"city"=>$city_name,
				// "checkin_date"=>$check_in,
				// "checkout_date"=>$check_out,
				// "link"=>$link,
				"hotel_image"=>$hotel_image1,
				// "position"=>$position,
				"status"=>$status,
				);		
			
			 		
		}		
		else
			{
			$update_data=array(
				"city"=>$city_name,
				// "checkin_date"=>$check_in,
				// "checkout_date"=>$check_out,
				// "link"=>$link,
				"hotel_image"=>$hotel_image1,
				// "position"=>$position,
				"status"=>$status,
				);		
			}
			$this->tophotel_model->update_topdeal_do($update_data,$id);
			
			redirect(WEB_URL.'tophotels/all_tophotels','refresh');


	}
	else
	{
		redirect(WEB_URL.'tophotels/all_tophotels','refresh');
		
	}
}
function delete_tophotel($id)
{
	$data['tophotel']	=	$this->tophotel_model->get_tophotelbyid($id);
	$hotel_image1 =$data['tophotel']['0']->hotel_image;	
	$hhotel=explode('/',$hotel_image1);
	$image_name=$hhotel['8'];
	unlink('uploads/hotel/'.$image_name);
	$this->tophotel_model->delete_tophotelbyid($id);
	redirect(WEB_URL.'tophotels/all_tophotels','refresh');
}


// section for Best hotel Start

	function add_besthotels()
	{
	$this->load->view('tophotels/add_besthotel_page');
	}

	function add_besthotels_do()
	{
		
		$this->form_validation->set_rules('from', 'city name', 'required');		
		// $this->form_validation->set_rules('depature', 'check in', 'required');
		// $this->form_validation->set_rules('return', 'check out', 'required');
		// $this->form_validation->set_rules('link', 'link', 'required');
		// $this->form_validation->set_rules('position', 'position', 'required|numeric');
          
// if (empty($_FILES['hotel_image']['name']))
// {
// 	echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
// 
// }
		// echo "<pre>"; print_r($_POST); exit();
		if ( $this->form_validation->run() !== false ) 
		{
			 $city_name =$_POST['from'];
			//  $check_in = $_POST['depature'];
			// $check_out = $_POST['return'];
			// $link = $_POST['link'];			
			//  $position = $_POST['position'];
			$status='ACTIVE';
			$hotel_image ='';	
			$city_id = $_POST['city_id'];
			
		if(isset($_FILES["hotel_image"]["name"]) && $_FILES["hotel_image"]["name"]!='')
		{
			 $logo_image = explode(".",$_FILES["hotel_image"]["name"]);
			 $ext=$logo_image['1'];
			 // echo "<pre>"; print_r($logo_image); exit();
			 $types = array('jpeg', 'gif', 'png','jpg');
		     if (in_array($ext, $types)) {
			$newlogoname = date('YmdHis').'.' .end($logo_image);
			$tmpnamert=$_FILES['hotel_image']['tmp_name'];	
			// move_uploaded_file($tmpnamert, 'uploads/hotel/'.$newlogoname);			
			$this->compressImage($tmpnamert,'uploads/hotel/'.$newlogoname,60);
			$hotel_image=$newlogoname;

			$insert_data=array(
				"city"=>$city_name,
				// "checkin_date"=>$check_in,
				// "checkout_date"=>$check_out,
				// "link"=>$link,
				"hotel_image"=>$hotel_image,
				// "position"=>$position,
				"status"=>$status,
				"city_id"=>$city_id
				);

				 $this->tophotel_model->add_new_besthotel($insert_data);		

				 redirect(WEB_URL.'tophotels/all_besthotels','refresh');

		}	
			else
			{
				$this->session->set_flashdata('img_msg','Invalid file type, Only JPEG, JPG, GIF and PNG types are accepted.');
			  	redirect(WEB_URL.'tophotels/add_besthotels','refresh');
			}	
	    }
		else
			{
			$srror_msg="not upload";	
			}
		
			
			redirect(WEB_URL.'tophotels/add_besthotels','refresh');

		}
		else
		{
			redirect(WEB_URL.'tophotels/add_besthotels','refresh');
		}

	}
	public function all_besthotels()
	{
		
		$data['tophotels'] = $this->tophotel_model->get_allbesthotels();	
        $this->load->view('tophotels/view_besthotel', $data);
	}
	 public function update_besthotel_status() 
	 {
		$id= $_GET['id'];
		$status= $_GET['status'];
        if($this->tophotel_model->update_besthotel_status1($id, $status))
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
    function edit_besthotel($id){
		$data['tophotel']	=	$this->tophotel_model->get_besthotelbyid($id);
		
		$this->load->view('tophotels/edit_besthotel', $data);
	}

	function update_besthotels_do()
	{
		$this->form_validation->set_rules('from', 'city name', 'required');		
		// $this->form_validation->set_rules('depature', 'check in', 'required');
		// $this->form_validation->set_rules('return', 'check out', 'required');
		// $this->form_validation->set_rules('link', 'link', 'required');
		// $this->form_validation->set_rules('position', 'position', 'required|numeric');
		if ( $this->form_validation->run() !== false ) 
		{
			$id=$_POST['hotel_id'];
			 $city_name =$_POST['from'];
			//  $check_in = $_POST['depature'];
			// $check_out = $_POST['return'];
			// $link = $_POST['link'];			
			//  $position = $_POST['position'];
			$hotel_image1 =$_POST['old_image'];	
			$hhotel=explode('/',$hotel_image1);

			$status=$_POST['status'];
			if(isset($_FILES["hotel_image"]["name"]) && $_FILES["hotel_image"]["name"]!='')
			{
				$image_name=$hhotel['8'];
				unlink('uploads/hotel/'.$image_name);
				

			$logo_image = explode(".",$_FILES["hotel_image"]["name"]);
			$newlogoname = date('YmdHis').rand(1,9999999) . '.' .end($logo_image);
			$tmpnamert=$_FILES['hotel_image']['tmp_name'];
	
			// move_uploaded_file($tmpnamert, 'uploads/hotel/'.$newlogoname);
			$this->compressImage($tmpnamert,'uploads/hotel/'.$newlogoname,60);
			
			$hotel_image1=$newlogoname;
			$update_data=array(
				"city"=>$city_name,
				// "checkin_date"=>$check_in,
				// "checkout_date"=>$check_out,
				// "link"=>$link,
				"hotel_image"=>$hotel_image1,
				// "position"=>$position,
				"status"=>$status,
				);		
			
			 		
		}		
		else
			{
			$update_data=array(
				"city"=>$city_name,
				// "checkin_date"=>$check_in,
				// "checkout_date"=>$check_out,
				// "link"=>$link,
				"hotel_image"=>$hotel_image1,
				// "position"=>$position,
				"status"=>$status,
				);		
			}
			$this->tophotel_model->update_bestdeal_do($update_data,$id);
			
			redirect(WEB_URL.'tophotels/all_besthotels','refresh');


	}
	else
	{
		redirect(WEB_URL.'tophotels/all_besthotels','refresh');
		
	}
}
function delete_besthotel($id)
         
{
	$data['tophotel']	=	$this->tophotel_model->get_besthotelbyid($id);
	$hotel_image1 =$data['tophotel']['0']->hotel_image;	
	$hhotel=explode('/',$hotel_image1);
	$image_name=$hhotel['8'];
	unlink('uploads/hotel/'.$image_name);
	$this->tophotel_model->delete_besthotelbyid($id);
	redirect(WEB_URL.'tophotels/all_besthotels','refresh');
}
	


		
	
}

?>
