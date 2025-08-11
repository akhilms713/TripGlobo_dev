<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
class Product extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('admin_model');		
    	$this->load->model('Product_Model');
		//$this->load->model('General_Model');
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
		}
		
    }
    function add_product()
	{
	$this->load->view('product/add_product');
	}


     
	function product_list(){		
		$product['product_list'] 	= $this->Product_Model->get_product_list();
		// echo '<pre/>';print_r($product);exit;
		$this->load->view('product/product_list',$product);
	}
	
	function add_product_do(){
		if(count($_POST) > 0){
			$this->Product_Model->add_product($_POST);
			redirect('product/product_list','refresh');
		}else{			
			$this->load->view('product/add_product',$product);
		}
	}
	
	function active_product($product_id){
		$product_id = json_decode(base64_decode($product_id));
		if($product_id!=''){
			$this->Product_Model->active_product($product_id);
		}
		redirect('product/product_list','refresh');
	}
	
	function inactive_product($product_id){
		$product_id = json_decode(base64_decode($product_id));
		if($product_id!=''){
			$this->Product_Model->inactive_product($product_id);
		}
		redirect('product/product_list','refresh');
	}
	
	function delete_product($product_id){
		$product_id = json_decode(base64_decode($product_id));
		if($product_id!=''){
			$this->Product_Model->delete_product($product_id);
		}
		redirect('product/product_list','refresh');
	}
	
	function edit_product($product_id){
		$product_id = json_decode(base64_decode($product_id));
		if($product_id != ''){			
			$product['product'] = $this->Product_Model->get_product_list($product_id);
			$this->load->view('product/edit_product',$product);
		} else {
			redirect('product/product_list','refresh');
		}
	}
	
	function update_product($product_id)
	{
		if(count($_POST) > 0){
			$product_id = json_decode(base64_decode($product_id));
			if($product_id != ''){
				$this->Product_Model->update_product($_POST,$product_id);
			}
			redirect('product/product_list','refresh');
		}else if($product_id!=''){
			redirect('product/edit_product/'.$product_id,'refresh');
		}else{
			redirect('product/product_list','refresh');
		}
	}
}
