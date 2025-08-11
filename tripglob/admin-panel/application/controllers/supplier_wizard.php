<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class supplier_wizard extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	  
		$this->load->model('supplier_wizard_Model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    	$this->output->set_header("Pragma: no-cache");
	    $this->load->library('form_validation');
    	$this->load->library("pagination");
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
    public function Supplier_List(){
    	$data['supplier'] = $this->supplier_wizard_Model->getSuppliers();
		$this->load->view('supplier_wizard/supplierlist', $data);
    }
    public function update_supplier_status()
	{
		$id= $_POST['id'];
		$status= $_POST['status'];
		if($this->supplier_wizard_Model->update_supplier_status($id,  $status))
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
	public function deleteSupplier(){
		$id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->supplier_wizard_Model->DeleteSupplier($id);
		redirect(WEB_URL.'supplier_wizard/Supplier_List');
	}
	function Create_Supplier($status='')
	{ 

		$data['status']=$status;
		$data['country_list'] = $this->supplier_wizard_Model->fetch_country_list();
		$this->load->view('supplier_wizard/add_new_supplier',$data);

	}
	function insert_Supplier()
	{
	
		$this->form_validation->set_rules('supplier_name', 'supplier_name', 'required');
		
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|supplier.email');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('country', 'country', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('postal', 'postal', 'required');
		$this->form_validation->set_rules('contacts', 'contacts', 'required');
		
		if($this->form_validation->run()==FALSE){
	  			redirect(WEB_URL.'supplier_wizard/Create_Supplier/0','refresh');
		}else{
			$supplier_name = $_POST['supplier_name'];
			
			$email = $_POST['email'];
			$password = $_POST['password'];
			$address = $_POST['address'];
			$country = $_POST['country'];
			$city = $_POST['city'];
			$postal = $_POST['postal'];
			$contacts = $_POST['contacts'];
		
			$supplier_number=strtoupper(substr($_POST['country'],0,4)).date("HYimds");
			
			if($this->supplier_wizard_Model->add_supplier($supplier_name,$password,$email,$address,$contacts,$city,$country,$postal,$supplier_number))
			{
				redirect(WEB_URL.'supplier_wizard/Supplier_List','refresh');
			}
			else
			{
				redirect(WEB_URL.'supplier_wizard/Create_Supplier/0','refresh');
			}
		}
	}
	function editSupplier(){
			$id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		  	$data['country_list'] = $this->supplier_wizard_Model->fetch_country_list();
		  	$data['result'] = $this->supplier_wizard_Model->getSuppliers($id);
		  	$this->load->view('supplier_wizard/edit_supplier', $data);
		  
	}
	function update_supplier(){
			$data = $this->input->post();
			$this->supplier_wizard_Model->update_supplier_details($data);
			redirect(WEB_URL.'supplier_wizard/Supplier_List');
	}
	public function ChangePassword(){
			$data['admin_id'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$this->load->view('supplier_wizard/change_password',$data);
	}
	public function update_password(){
			$data = $this->input->post();
			$this->supplier_wizard_Model->update_new_password($data);
			redirect(WEB_URL.'supplier_wizard/Supplier_List');
	}
	public function viewSupplier(){
			$id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data['country_list'] = $this->supplier_wizard_Model->fetch_country_list();
			$data['result'] = $this->supplier_wizard_Model->getSuppliers($id);
			$this->load->view('supplier_wizard/view_profile',$data);
	}
}
