<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Deposit extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('deposit_model');
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
	
	public function deopsit_control($status='')
	{
		$data['deposit_status'] =$deposit_status ='';
		$data['status']=$status;
		$data['deposits'] = $this->deposit_model->get_deposit_details($deposit_status);
		#echo "<pre/>";print_r($data['deposits']);die;

        $this->load->view('deposit/view', $data);
	}

	
	public function accpeted($status='')
	{
		$data['deposit_status'] =$deposit_status ='ACCEPTED';
		$data['status']=$status;
		$data['deposits'] = $this->deposit_model->get_deposit_details($deposit_status);
        $this->load->view('deposit/view', $data);
	}
	public function decline($status='')
	{
		$data['deposit_status'] = $deposit_status ='DECLINE';
		$data['status']=$status;
		$data['deposits'] = $this->deposit_model->get_deposit_details($deposit_status);
        $this->load->view('deposit/view', $data);
	}
	public function pending($status='')
	{
		$data['deposit_status'] =$deposit_status ='PENDING';
		$data['status']=$status;
		$data['deposits'] = $this->deposit_model->get_deposit_details($deposit_status);
        $this->load->view('deposit/view', $data);
	}
	public function update_deposit_status($deposit_id,$status,$user_id)
	{
		
		if(isset($_REQUEST['service_fee'])){
			$service_fee = $_REQUEST['service_fee'];
		} else {
			$service_fee = 0;
		}
		$deposit_det = $this->deposit_model->get_deposit_account_details($deposit_id); 

		if ($this->deposit_model->update_deposit_status($deposit_id,$status,$user_id,$deposit_det->amount, $service_fee))
		{
			redirect(WEB_URL.'deposit/deopsit_control/1','refresh');
		}
		else
		{
			redirect(WEB_URL.'deposit/deopsit_control/0','refresh');
		}
	}
	public function add_new_deposit($status='')
	{
		$data['status']=$status;
		$module = 'B2B';
		$data['user'] = $this->deposit_model->get_user_details($module);
        $this->load->view('deposit/add_deposit', $data);
	}
	public function add_deposit_do()
	{
	
		
		if(isset($_FILES["slip"]["name"]) && $_FILES["slip"]["name"]!='')
		{
			$logo_image = explode(".",$_FILES["slip"]["name"]);
	        $newlogoname = date('YmdHis').rand(1,9999999) . '.' .end($logo_image);
	        $tmpnamert=$_FILES['slip']['tmp_name'];

	        move_uploaded_file($tmpnamert, 'uploads/deposit/slip_'.$newlogoname);
			
			$transaction_slip=WEB_URL.'uploads/deposit/slip_'.$newlogoname;
		}
		else
		{
			$transaction_slip='';
		}
		
		
		if ($this->deposit_model->save_deposit($_POST,$transaction_slip))
		{
			redirect(WEB_URL.'deposit/deopsit_control/1','refresh');
		}
		else
		{
			redirect(WEB_URL.'deposit/deopsit_control/0','refresh');
		}

	}
}

?>
