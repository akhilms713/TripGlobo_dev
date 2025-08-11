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
	    $date='';
	    if(valid_array($this->input->get()) == true) {
			$data = $_GET;
		    if($_GET['today_booking_data']!=''){
		         $date=$_GET['today_booking_data'];
		    }elseif($_GET['last_day_booking_data']!=""){
		        $date=$_GET['last_day_booking_data'];
		    }elseif($_GET['prev_booking_data']!=""){
		        $date=$_GET['prev_booking_data'];
		    }
	    }
		// debug($date );exit();
		$data['deposit_status'] =$deposit_status =$_GET['status'];
		$data['status']=$status;
		$data['deposits'] = $this->deposit_model->get_deposit_details($deposit_status,$date);
 		//echo "<pre/>";print_r($data);die;

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
		$data['deposit_status'] = $deposit_status ='DECLINED';
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
		//echo "<pre/>";print_r($_REQUEST);exit("70");
		
		if(isset($_REQUEST['service_fee'])){
			$service_fee = $_REQUEST['service_fee'];
		} else {
			$service_fee = 0;
		}
		
		 $sub_admin_id = $this->session->userdata('admin_id');
	
		$admin_remarks=$_REQUEST['Remarks'];
		$deposit_det = $this->deposit_model->get_deposit_account_details($deposit_id); 

		if ($this->deposit_model->update_deposit_status($deposit_id,$status,$user_id,$deposit_det->amount, $service_fee,$admin_remarks,$sub_admin_id))
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
		// debug($_POST);exit;
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
		 $sub_admin_id = $this->session->userdata('admin_id');
		if ($this->deposit_model->save_deposit($_POST,$transaction_slip,$sub_admin_id))
		{
			redirect(WEB_URL.'deposit/deopsit_control/1','refresh');
		}
		else
		{
			redirect(WEB_URL.'deposit/deopsit_control/0','refresh');
		}

	}
	
	public function superadmin_deposit_action($deposit_id,$status,$user_id)
	{
	    
	    // echo "<pre/>";print_r($user_id);exit;
	    $sub_admin_id = $this->session->userdata('admin_id');
	    
	    $remarks = $_REQUEST['Remarks'];
	    
	    $deposit_det = $this->deposit_model->get_deposit_account_details($deposit_id);
	    if (empty($deposit_det->admin_accepted_id)) {
	    $admin_accepted_id = $this->session->userdata('admin_id');	    	
	    }else{
	    $admin_accepted_id = $deposit_det->admin_accepted_id;   	

	    }
	    if ($this->deposit_model->update_superadminAction_status($deposit_id,$status,$user_id,$sub_admin_id,$admin_accepted_id,$remarks))
		{
			redirect(WEB_URL.'deposit/deopsit_control/12','refresh');
		}
		else
		{
			redirect(WEB_URL.'deposit/deopsit_control/13','refresh');
		}
	}
	
	public function new_deposit_check()
	{
	    $date='';
		$data['deposit_status'] = '';
		$admin_status = 'ACCEPTED';
		$super_status = 'PENDING';
		$data['deposits'] = $this->deposit_model->get_deposit_check($admin_status,$super_status,$date);
        $this->load->view('deposit/view', $data);
	}
}

?>
