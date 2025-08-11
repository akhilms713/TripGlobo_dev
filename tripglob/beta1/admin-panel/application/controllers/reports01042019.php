<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Reports extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('reports_model');
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

	function user_bookings($user_id)
	{
		$data['reports'] = $this->reports_model->get_user_bookings($user_id); 

		$this->load->view('reports/view',$data);
	}
	function product_basis()
	{
		$data['product_reports'] = $this->reports_model->product_reports(); 
		$data['total_reports'] = $this->reports_model->total_reports(); 
		$data['first_chart'] = $this->reports_model->first_chart();
		$data['second_chart'] = $this->reports_model->second_chart($start='',$end='');
		$data['third_chart'] = $this->reports_model->third_chart();
		$data['fourth_chart'] = $this->reports_model->fourth_chart();
		$data['pie_chart'] = $this->reports_model->pie_chart();
		$data['statics_reports'] = $this->reports_model->statics_reports();
		$data['product'] = $this->reports_model->products();
		//echo "<pre>"; print_r($data['fourth_chart']); echo "</pre>";exit;
		$this->load->view('reports/product_basis',$data);
	}
	function ajax_chart(){
		$start = $this->input->post('start');
		$end = $this->input->post('end');
	//echo $start .''.$end;
		$data['ajax_chart'] = $this->reports_model->second_chart($start,$end);
	//print_r($data['ajax_chart']);
		$data['product'] = $this->reports_model->products();
		$this->load->view('reports/graph_ajax',$data);
	}
	public function b2b_basis(){
		$access = "b2b";
		$data['b2b_bookings'] = $this->reports_model->b2b_bookings($access);
		$this->load->view('reports/b2b_basis',$data);
	}
	public function b2c_basis(){
		$access = "b2c";
		$data['b2c_bookings'] = $this->reports_model->b2b_bookings($access);
		
		$this->load->view('reports/b2c_basis',$data);
	}
	public function country_basis(){
		$data['country_basis'] = $this->reports_model->country_basis();
		//print_r($data['country_basis']); exit;
		$this->load->view('reports/country_basis',$data);
	}
	public function city_basis(){
		$data['city_basis'] = $this->reports_model->city_basis();
		//print_r($data['country_basis']); exit;
		$this->load->view('reports/city_basis',$data);
	}
	
	public function b2c(){
		redirect(base_url().'reports/b2c_basis');
	}
	public function b2b(){
		echo "under progress";
		exit;
		//redirect(base_url().'reports/b2b_basis');
	}

}

?>
