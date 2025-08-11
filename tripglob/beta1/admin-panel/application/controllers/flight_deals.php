<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
class Flight_Deals extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('admin_model');
		$this->load->model('flightdeals_model');
		$this->load->model('airline_model');
		$this->load->model('xmllog_model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		$this->load->library('form_validation');
		$this->load->helper('file');
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
	function add_flight_deals()
	{
		if(!isset($_POST)){
			$this->load->view('flight_deals/add_new');
		}else{
			$this->add_flight_deals_do();
		}
	}
	function add_flight_deals_do()
	{
		$this->form_validation->set_rules('deal_type', 'Deal Type', 'required');
		$this->form_validation->set_rules('from', 'from', 'required');
		$this->form_validation->set_rules('to', 'to', 'required');
		
		$this->form_validation->set_rules('deal_image', 'Deal Image', 'callback_file_check');			
		// $this->form_validation->set_rules('depature', 'check in', 'required');
		// $this->form_validation->set_rules('return', 'check out', 'required');
		// $this->form_validation->set_rules('price', 'price', 'required');
		if ( $this->form_validation->run() !== false ) 
		{
			$deal_type = $_POST['deal_type'];
			$from =$_POST['from'];
			$to =$_POST['to'];
			 $deal_start = $_POST['deal_start'];
			 $deal_end = $_POST['deal_end'];
			 $airline = $_POST['airline'];
			$price = isset($_POST['price']) ? $_POST['price'] : '';
			$offerText = isset($_POST['offer_text']) ? $_POST['offer_text'] : '';
			$status="ACTIVE";
			$deal_image ='';	
			
			
		if(isset($_FILES["deal_image"]["name"]) && $_FILES["deal_image"]["name"]!='')
		{
			 $logo_image = explode(".",$_FILES["deal_image"]["name"]);
			$newlogoname = date('YmdHis').rand(1,9999999) . '.' .end($logo_image);
			$tmpnamert=$_FILES['deal_image']['tmp_name'];
	
			//move_uploaded_file($tmpnamert, 'uploads/flightdeal/'.$newlogoname);

			$this->compressImage($tmpnamert, 'uploads/flightdeal/'.$newlogoname,60);
			
			$deal_image=$newlogoname;

			$insert_data=array(
				"deal_type"=>$deal_type,
				"deal_image"=>$deal_image,
				"deal_offered_price"=>$price,
				"offered_text"=>$offerText,
				"deal_start"=>$deal_start,
				"deal_end"=>$deal_end,
				"airline"=> $airline,
				"deal_from_place"=>$from,				
				"deal_to_place"=>$to,
				"deal_status"=>$status
				);
			 $this->flightdeals_model->add_new_flight_deals_do($insert_data);	

			 redirect(WEB_URL.'flight_deals/all_flightdeals','refresh');

		}		
		else
			{
			$srror_msg="not upload";	
			}
			
			redirect(WEB_URL.'flight_deals/add_flight_deals','refresh');

		}
		else{
		    
			$data['airline'] = $this->airline_model->get_airline_list_new();
			
		    //echo '<pre>';print_r($data['airport_name']);exit();
			$this->load->view('flight_deals/add_new',$data);
		}
	}
	
// 	public function getCityName()
//  {
//         $cityname= $this->input->post('cityname');
//       $data = $this->airline_model->get_airport_list_new($cityname);
// 		print_r($data);
//  }
	public function all_flightdeals()
	{
		$data['flightdeals'] = $this->flightdeals_model->get_allflightdeals();	
        $this->load->view('flight_deals/view', $data);
	}
	 public function update_flightdeal_status() 
	 {
		$id= $_GET['id'];
		$status= $_GET['status'];
        if($this->flightdeals_model->update_flightdeal_status1($id, $status))
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
    function edit_flightdeal($id='')
    {
		if(empty($_POST)==TRUE){
		    $data['airline'] = $this->airline_model->get_airline_list_new();
	    	$data['flight_deal']	=	$this->flightdeals_model->get_flightdealbyid($id);
			$this->load->view('flight_deals/edit_flightdeal', $data);
		}
		else{
			$this->update_flight_deals_do($id);
		}
    }

    function update_flight_deals_do($id='')
    {

		
		$this->form_validation->set_rules('deal_type', 'Deal Type', 'required');
		$this->form_validation->set_rules('from', 'from', 'required');
		$this->form_validation->set_rules('to', 'to', 'required');
		//$this->form_validation->set_rules('deal_image', 'Deal Image', 'callback_file_check');			
		// $this->form_validation->set_rules('depature', 'check in', 'required');
		// $this->form_validation->set_rules('return', 'check out', 'required');
		// $this->form_validation->set_rules('price', 'price', 'required');
		if ( $this->form_validation->run() !== false ) 
		{
			$id=$_POST['fdeal_id'];
			$deal_type = $_POST['deal_type'];
			$from =$_POST['from'];
			$to =$_POST['to'];
		    $deal_start = $_POST['deal_start'];
			 $deal_end = $_POST['deal_end'];
			 $airline = $_POST['airline'];						
			$price = $_POST['price'];
			$offerText = $_POST['offer_text'];
			$status=$_POST['status'];
			$deal_image =$_POST['old_image'];	
			$hhotel=explode('/',$deal_image);	
			
			
			if(isset($_FILES["deal_image"]["name"]) && $_FILES["deal_image"]["name"]!='')
			{
				//$image_name=$hhotel['7'];
				$image_name = end($hhotel);
				unlink('uploads/flightdeal/'.$image_name);	

				 $logo_image = explode(".",$_FILES["deal_image"]["name"]);
				$newlogoname = date('YmdHis').rand(1,9999999) . '.' .end($logo_image);
				$tmpnamert=$_FILES['deal_image']['tmp_name'];
		
				// move_uploaded_file($tmpnamert, 'uploads/flightdeal/'.$newlogoname);
				$this->compressImage($tmpnamert, 'uploads/flightdeal/'.$newlogoname,60);
				$deal_image=$newlogoname;

				$update_data=array(
					"deal_type"=>$deal_type,
					"deal_image"=>$deal_image,
					"deal_offered_price"=>$price,
					"offered_text"=>$offerText,
					"deal_from_place"=>$from,				
					"deal_to_place"=>$to,
					"deal_status"=>$status,
					"deal_start"=>$deal_start,
                    "deal_end"=>$deal_end,
                    "airline"=> $airline,
					);
				
			}		
			else
				{
					$update_data=array(
						"deal_type"=>$deal_type,
						"deal_image"=>$deal_image,
						"deal_offered_price"=>$price,
						"offered_text"=>$offerText,
						"deal_from_place"=>$from,				
						"deal_to_place"=>$to,
                        "deal_start"=>$deal_start,
                        "deal_end"=>$deal_end,
                        "airline"=> $airline,
						"deal_status"=>$status
					);	
				}
				$this->flightdeals_model->update_flight_deals_do($update_data,$id);	
				redirect(WEB_URL.'flight_deals/all_flightdeals','refresh');

		}
		else
		{
		    $data['airline'] = $this->airline_model->get_airline_list_new();
			$data['flight_deal']	=	$this->flightdeals_model->get_flightdealbyid($id);
			$this->load->view('flight_deals/edit_flightdeal', $data);

		}
    }
    function delete_flightdeal($id)
	{
	$data['flight_deal']	=	$this->flightdeals_model->get_flightdealbyid($id);
	$hotel_image1 =$data['flight_deal']['0']->deal_image;	
	$hhotel=explode('/',$hotel_image1);
	
	$image_name = end($hhotel);

	//$image_name=$hhotel['7'];

	unlink('uploads/flightdeal/'.$image_name);	
	$this->flightdeals_model->delete_tophotelbyid($id);
	redirect(WEB_URL.'flight_deals/all_flightdeals','refresh');

	}

	public function file_check($str){
        $allowed_mime_type_arr = array('application/pdf','image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['deal_image']['name']);
        if(isset($_FILES['deal_image']['name']) && $_FILES['deal_image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only pdf/gif/jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }

 






	
	
	
} 
?>
