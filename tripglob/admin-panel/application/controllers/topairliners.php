<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Topairliners extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('admin_model');
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
    function add_airliners()
	{
		$execute_query = $this->db->query('select * from airline_list');
		$data['airline_list'] =$execute_query->result_array();
		$this->load->view('topairliners/add_new',$data);
	}
	function add_topairliners_do()
	{
		
		$this->form_validation->set_rules('airline_id', 'Airline Name', 'required');		
		
		if ( $this->form_validation->run() !== false ) 
		{
			
			$airline_id =$_POST['airline_id'];			
			$status=ACTIVE;
			$flight_image ='';			
			
		if(isset($_FILES["airline_image"]["name"]) && $_FILES["airline_image"]["name"]!='')
		{
			 $logo_image = explode(".",$_FILES["airline_image"]["name"]);
			$newlogoname = date('YmdHis').'.' .end($logo_image);
			$tmpnamert=$_FILES['airline_image']['tmp_name'];	
			//move_uploaded_file($tmpnamert, 'uploads/topairliners/'.$newlogoname);		
			$this->compressImage($tmpnamert, 'uploads/topairliners/'.$newlogoname,60);	
			$flight_image=WEB_URL.'uploads/topairliners/'.$newlogoname;

			$insert_data=array(				
				"airline_image"=>$flight_image,				
				"status"=>$status,
				);
			$where = array('airline_list_id'=>$_POST['airline_id']);
		 	$this->db->where($where);
			$this->db->update('airline_list ', $insert_data); 

		}		
		else
			{
			$srror_msg="not upload";	
			}
			
			redirect(WEB_URL.'topairliners/all_airliners','refresh');

		}
		else
		{
			redirect(WEB_URL.'topairliners/all_airliners','refresh');
		}
	}
	public function all_airliners()
	{
		
		$execute_query = $this->db->query('select * from airline_list where airline_image!=""');
		$top_airliners_array = array();
		if($execute_query->num_rows()!=''){
			$top_airliners_array = $execute_query->result_array();
		}
		$data['topairliners'] = $top_airliners_array;
        $this->load->view('topairliners/view', $data);
	}
	 public function update_topairline_status() 
	 {
		$id= $_GET['id'];
		$status= $_GET['status'];
		$update_data=array(	
				"status"=>$status,
				);
		$where = array('airline_list_id'=>$id);
	 	$this->db->where($where);	

        if($this->db->update('airline_list ', $update_data))
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
    function edit_topairline($id){

    	$execute_query = $this->db->query('select * from airline_list where airline_list_id='.$id);
		$top_airliners_array = array();
		if($execute_query->num_rows()!=''){
			$top_airliners_array = $execute_query->result_array();
		}
		$execute_query = $this->db->query('select * from airline_list');

		$data['topairliners']	=	$top_airliners_array[0];
		$data['airline_list'] = $execute_query->result_array();
		$this->load->view('topairliners/edit_topairline', $data);
	}

	function update_topairline_do()
	{
			$this->form_validation->set_rules('airline_id', 'Airline Name', 'required');		
	
			if ( $this->form_validation->run() !== false ) 
			{
				$id=$_POST['airline_id'];
				
				$airline_image =$_POST['old_image'];	
				$hhotel=explode('/',$airline_image);

				$status=$_POST['status'];
				if(isset($_FILES["airline_image"]["name"]) && $_FILES["airline_image"]["name"]!='')
					{
						$image_name=$hhotel['8'];
						unlink('uploads/topairliners/'.$image_name);
						

					$logo_image = explode(".",$_FILES["airline_image"]["name"]);
					$newlogoname = date('YmdHis').rand(1,9999999) . '.' .end($logo_image);
					$tmpnamert=$_FILES['airline_image']['tmp_name'];
			
					//move_uploaded_file($tmpnamert, 'uploads/topairliners/'.$newlogoname);
					$this->compressImage($tmpnamert, 'uploads/topairliners/'.$newlogoname,60);
					
					$airline_image=WEB_URL.'uploads/topairliners/'.$newlogoname;
					$update_data=array(					
						"airline_image"=>$airline_image,
						"status"=>$status,
						);		
					
					 		
				}		
				else
					{
						$update_data=array(					
							"airline_image"=>$airline_image,			
							"status"=>$status,
						);		
				}
				$update_data=array(				
				"airline_image"=>$airline_image,				
				"status"=>$status,
				);
				$where = array('airline_list_id'=>$_POST['airline_id']);
			 	$this->db->where($where);
				$this->db->update('airline_list ', $update_data);
				
				redirect(WEB_URL.'topairliners/all_airliners','refresh');


		}
		else
		{
			
			redirect(WEB_URL.'topairliners/all_airliners','refresh');
			
		}
	}
	function delete_topairlines($id)
	{
		$execute_query = $this->db->query('select * from airline_list where airline_list_id='.$id);
		$top_airlineres = $execute_query->result_array()[0];
		
		$airline_image1 =$top_airlineres['airline_image'];
		$hhotel=explode('/',$airline_image1);
		$image_name=$hhotel['8'];
		unlink('uploads/topairliners/'.$image_name);		
		$update_data=array(				
				"airline_image"=>'',				
				"status"=>0,
				);
		$where = array('airline_list_id'=>$id);
	 	$this->db->where($where);
		$this->db->update('airline_list ', $update_data);			

		redirect(WEB_URL.'topairliners/all_airliners','refresh');
	}


	//Best Airline

	function add_bestairliners()
	{
		$execute_query = $this->db->query('select * from bestairline_list');
		$data['bestairline_list'] =$execute_query->result_array();
		$this->load->view('topairliners/add_bestairline',$data);
	}
	function add_bestairliners_do()
	{
		
		$this->form_validation->set_rules('airline_id', 'Airline Name', 'required');		
		
		if ( $this->form_validation->run() !== false ) 
		{
			
			$airline_id =$_POST['airline_id'];			
			$status=ACTIVE;
			$flight_image ='';			
			
		if(isset($_FILES["airline_image"]["name"]) && $_FILES["airline_image"]["name"]!='')
		{
			 $logo_image = explode(".",$_FILES["airline_image"]["name"]);
			$newlogoname = date('YmdHis').'.' .end($logo_image);
			$tmpnamert=$_FILES['airline_image']['tmp_name'];	
			move_uploaded_file($tmpnamert, 'uploads/topairliners/'.$newlogoname);			
			$flight_image=WEB_URL.'uploads/topairliners/'.$newlogoname;

			$insert_data=array(				
				"airline_image"=>$flight_image,				
				"status"=>$status,
				);
			$where = array('airline_list_id'=>$_POST['airline_id']);
		 	$this->db->where($where);
			$this->db->update('bestairline_list ', $insert_data); 

		}		
		else
			{
			$srror_msg="not upload";	
			}
			
			redirect(WEB_URL.'topairliners/all_bestairliners','refresh');

		}
		else
		{
			redirect(WEB_URL.'topairliners/all_bestairliners','refresh');
		}
	}
	public function all_bestairliners()
	{
		
		$execute_query = $this->db->query('select * from bestairline_list where airline_image!=""');
		$top_airliners_array = array();
		if($execute_query->num_rows()!=''){
			$top_airliners_array = $execute_query->result_array();
		}
		$data['topairliners'] = $top_airliners_array;
        $this->load->view('topairliners/view_bestairline', $data);
	}
	 public function update_bestairline_status() 
	 {
		$id= $_GET['id'];
		$status= $_GET['status'];
		$update_data=array(	
				"status"=>$status,
				);
		$where = array('airline_list_id'=>$id);
	 	$this->db->where($where);	

        if($this->db->update('bestairline_list ', $update_data))
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
    function edit_bestairline($id){

    	$execute_query = $this->db->query('select * from bestairline_list where airline_list_id='.$id);
		$top_airliners_array = array();
		if($execute_query->num_rows()!=''){
			$top_airliners_array = $execute_query->result_array();
		}
		$execute_query = $this->db->query('select * from bestairline_list');

		$data['topairliners']	=	$top_airliners_array[0];
		$data['bestairline_list'] = $execute_query->result_array();
		$this->load->view('topairliners/edit_bestairline', $data);
	}

	function update_bestairline_do()
	{
			$this->form_validation->set_rules('airline_id', 'Airline Name', 'required');		
	
			if ( $this->form_validation->run() !== false ) 
			{
				$id=$_POST['airline_id'];
				
				$airline_image =$_POST['old_image'];	
				$hhotel=explode('/',$airline_image);

				$status=$_POST['status'];
				if(isset($_FILES["airline_image"]["name"]) && $_FILES["airline_image"]["name"]!='')
					{
						$image_name=$hhotel['8'];
						unlink('uploads/topairliners/'.$image_name);
						

					$logo_image = explode(".",$_FILES["airline_image"]["name"]);
					$newlogoname = date('YmdHis').rand(1,9999999) . '.' .end($logo_image);
					$tmpnamert=$_FILES['airline_image']['tmp_name'];
			
					move_uploaded_file($tmpnamert, 'uploads/topairliners/'.$newlogoname);
					
					$airline_image=WEB_URL.'uploads/topairliners/'.$newlogoname;
					$update_data=array(					
						"airline_image"=>$airline_image,
						"status"=>$status,
						);		
					
					 		
				}		
				else
					{
						$update_data=array(					
							"airline_image"=>$airline_image,			
							"status"=>$status,
						);		
				}
				$update_data=array(				
				"airline_image"=>$airline_image,				
				"status"=>$status,
				);
				$where = array('airline_list_id'=>$_POST['airline_id']);
			 	$this->db->where($where);
				$this->db->update('bestairline_list ', $update_data);
				
				redirect(WEB_URL.'topairliners/all_bestairliners','refresh');


		}
		else
		{
			
			redirect(WEB_URL.'topairliners/all_bestairliners','refresh');
			
		}
	}
	function delete_bestairlines($id)
	{
		$execute_query = $this->db->query('select * from bestairline_list where airline_list_id='.$id);
		$top_airlineres = $execute_query->result_array()[0];
		
		$airline_image1 =$top_airlineres['airline_image'];
		$hhotel=explode('/',$airline_image1);
		$image_name=$hhotel['8'];
		unlink('uploads/topairliners/'.$image_name);		
		$update_data=array(				
				"airline_image"=>'',				
				"status"=>0,
				);
		$where = array('airline_list_id'=>$id);
	 	$this->db->where($where);
		$this->db->update('bestairline_list', $update_data);			

		redirect(WEB_URL.'topairliners/all_bestairliners','refresh');
	}
}

?>