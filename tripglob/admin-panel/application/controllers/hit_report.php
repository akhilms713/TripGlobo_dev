<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Hit_Report extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->check_isvalidated();	
		$this->load->model('Hit_Report_Model');
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
	
	function flight_report(){
		$result = array();
		$res = $this->Hit_Report_Model->get_report('FLIGHT')->result();
		foreach ($res as $row) {
			$cehck_both = $row->cehck_both;
			$res1 = $this->Hit_Report_Model->get_report_month('FLIGHT',$cehck_both)->result();
			$result[] = array( 'main' => $row, 'sub' => $res1 );
		}
		$data['report'] = $result;
		$this->load->view('hit_report/flight_report',$data);
	}



	function flight_hits_data(){
		 

	}

	
	

}
