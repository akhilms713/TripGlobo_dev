<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Currency extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	  $this->check_isvalidated();
		$this->load->model('user_model');
		$this->load->model('Currency_Model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      	$this->output->set_header("Pragma: no-cache");
	    $this->load->library('form_validation');
		$this->user_mode = 'Currency';
	   	
	
	
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
	function currency_converter($status='')
	{

	  $data['currency'] = $this->Currency_Model->get_currency_list(); 
	  $data['status'] = $status;
	  $this->load->view('currency/currency_converter',$data);
		
	}
	
	function edit_currency($id){
		
		$data['currency'] = $this->Currency_Model->getCurrencyData($id);
		
		//print_r($data['currency']);exit;
			
		$this->load->view('currency/currency_edit',$data);	
	}
	
	function delete_currency($id){
		
		$this->Currency_Model->deleteCurrencyData($id);
		
		//print_r($data['currency']);exit;
			
		 redirect('currency/currency_converter/1','refresh');
	}
	
	function update_currency($id)
	{
		//print_r($_POST);exit;
		$currency= $_POST['currency'];
		$value=$_POST['value'];
		$code=$_POST['country_code'];
		$name=$_POST['currency_name'];
		$data=array('currency_code' => $currency,'value' => $value,'currency_symbol'=>$code,'currency_name'=>$name);
		$this->db->where('currency_list_id',$id);
		$this->db->update('currency_list',$data);
		redirect('currency/currency_converter/1','refresh');
	}
	
	function add_currency()
	{
		//echo '<pre/>';
		//print_r($_POST);exit;
		$this->form_validation->set_rules('currency', 'Currency Code', 'required');
		$this->form_validation->set_rules('value', 'Value', 'required');
		$this->form_validation->set_rules('country_code', 'Country Code', 'required');
		$this->form_validation->set_rules('currency_name', 'Currency Name', 'required');
		
		if($this->form_validation->run()==FALSE)
		{
	  		
			$this->load->view('currency/add_currency');
		}
		else
		{
			$currency = $_POST['currency'];
			$value = $_POST['value'];
			$code = $_POST['country_code'];
			$name = $_POST['currency_name'];

			$Query="select * from  currency_list  where currency_code ='".$currency."' ";
	 
		 	$query=$this->db->query($Query);
		
		if ($query->num_rows() > 0)
		{
			
			$data['status'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Currency Code Already Exists!</h4>
							 
							</div>';
			
			$this->load->view('currency/add_currency',$data);
		}
		else
		{
			
		 
			if($this->Currency_Model->add_currency($currency,$value,$code,$name))
			{
					redirect('currency/currency_converter/1','refresh');
			}
			else
			{
				$data['status'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Currency Code Already Exists!</h4>
							 
							</div>';
			
			$this->load->view('currency/add_currency',$data);
			
			}


		
	
	  		
		}
		}
	}
	
	function auto_update_currency(){


	    $currency = $this->Currency_Model->get_currency_list_update(); 
	    
	    if (is_array($currency) && $currency['currency_code']!='') {	    	
			$value=$this->auto_curl($currency['currency_code']);
			if (isset($value['error']) && !empty($value['error'])) {
			// debug($value);exit;
			$data=array('updated_at'=>1,
				          'updated_at_date'=>date('Y-m-d H:i:s'),
		         );
			$this->db->where('currency_code',$currency['currency_code']);
			$this->db->update('currency_list',$data);
				
			}else{

			foreach ($value['results'] as $key => $value) {			
			$data=array('value' => $value,
				          'updated_at'=>1,
				          'updated_at_date'=>date('Y-m-d H:i:s'),
		         );
			$this->db->where('currency_code',$key);
			$this->db->update('currency_list',$data);
			}
			}
		  redirect('currency/auto_update_currency','refresh');
	    }else{
	    $currency_u = $this->Currency_Model->get_currency_list_update_auto(); 
	    	// debug($currency_u);exit;
		  redirect('currency/currency_converter/3','refresh');
	    }
	    
	}


		function auto_update_currency_cron(){
			// mail("poovarasanprovab@gmail.com","My subject","Hello");
			// die;
	    $currency = $this->Currency_Model->get_currency_list_update(); 
	    
	    if (is_array($currency) && $currency['currency_code']!='') {	    	
			$value=$this->auto_curl($currency['currency_code']);
			if (isset($value['error']) && !empty($value['error'])) {
			// debug($value);exit;
			$data=array('updated_at'=>1,
				          'updated_at_date'=>date('Y-m-d H:i:s'),
		         );
			$this->db->where('currency_code',$currency['currency_code']);
			$this->db->update('currency_list',$data);
				
			}else{

			foreach ($value['results'] as $key => $value) {			
			$data=array('value' => $value,
				          'updated_at'=>1,
				          'updated_at_date'=>date('Y-m-d H:i:s'),
		         );
			$this->db->where('currency_code',$key);
			$this->db->update('currency_list',$data);
			}
			}
		  redirect('currency/auto_update_currency_cron','refresh');
	    }else{
	    $currency_u = $this->Currency_Model->get_currency_list_update_auto(); 
	    	// debug($currency_u);exit;
		  exit("done");
	    }
	    
	    
	}
	
	
	function auto_curl($to){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://api.fastforex.io/fetch-multi?api_key=26e3a6a0d2-1e59916e8e-s74cqf&from=INR&to='.$to,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$response = curl_exec($curl);
	curl_close($curl);
	return json_decode($response,1);            	 
	}

	
	
	
	

}


