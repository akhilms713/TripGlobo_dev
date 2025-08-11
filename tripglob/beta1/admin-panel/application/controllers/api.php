<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
class Api extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('api_model');
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
	
	public function api_list()
	{
		
		$data['api'] = $this->api_model->get_api_details();
			//echo "<pre>"; print_r($data); echo "</pre>"; die();
		
        $this->load->view('api/view', $data);
	}
	   public function update_api_status() 
	 {
		$id= $_POST['id'];
		$status= $_POST['status'];
        if($this->api_model->update_api_status($id, $status))
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
		function edit_api($id,$status='')
	{
		    $data['status']=$status;
			$data['api'] = $this->api_model->get_api_list_id($id); 
			$data['id']=$id;
				//echo "<pre>"; print_r($data); echo "</pre>"; die();
			
			$this->load->view('api/edit_api',$data);
	}
	function edit_api_do($api_id)
	{
		$data = array(
			'api_username' => $this->input->post('username'),
			'api_password' => $this->input->post('password'),
			'pseudo_city_code' => $this->input->post('tbranch'),
			'api_WSAP' => $this->input->post('wsap'),
			'api_url' => $this->input->post('url'),
			'api_url1' => $this->input->post('url2'),
			'api_status' => $this->input->post('status'),
			'api_credential_type' => $this->input->post('mode')
			);
		
		$this->api_model->update_api_details($data,$api_id);
		redirect(WEB_URL.'api/api_list','refresh');
		 
	}
	public function api_hits(){
		$data['api_hits'] = $this->api_model->getApiHits();
		$data['pie_chart'] = $this->api_model->pie_chart();
		$data['api_name_hits'] = $this->api_model->api_hits();
		$data['bar_chart'] = $this->api_model->bar_chart();
		$data['bar_chart_success'] = $this->api_model->bar_chart_success();
		$data['bar_chart_failure'] = $this->api_model->bar_chart_failure();
		$data['hits_count'] = $this->api_model->hits_count();
		$data['total_hits'] = $this->api_model->total_hits();
		$data['recent_hits'] = $this->api_model->recent_hits();
		$this->load->view('api/api_hits',$data);
	}
	public function view_api_hits(){
		$api = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['api_name_details'] = $this->api_model->api_name_details($api);
		$this->load->view('api/view_api_hits',$data);
	}
	public function view_ip_hits(){
		$id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$ip = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['ip_details'] = $this->api_model->ip_details($id,$ip);
		$this->load->view('api/view_ip_hits',$data);
	}
	public function export_xml_log_request(){
    $id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	$user_data = $this->api_model->getOneXmlLogs($id); 
	$xmldata = '<?xml version="1.0" encoding="utf-8"?>';
	$xmldata .= $user_data->xml_request;
	

	if(file_put_contents('Request.xml',$xmldata)) // this code is working fine xml get created
	{
	    //echo "file created";exit;
	    header('Content-type: text/xml');   // i am getting error on this line
	    //Cannot modify header information - headers already sent by (output started at D:\xampp\htdocs\yii\framework\web\CController.php:793)

	    header('Content-Disposition: Attachment; filename="Request.xml"');
	    // File to download
	    readfile('Request.xml');        // i am not able to download the same file
	}
	
    }
    public function export_xml_log_response(){
    $id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	$user_data = $this->api_model->getOneXmlLogs($id); 
	$xmldata = '<?xml version="1.0" encoding="utf-8"?>';
	$xmldata .= $user_data->xml_response;
	

	if(file_put_contents('Response.xml',$xmldata)) // this code is working fine xml get created
	{
	    //echo "file created";exit;
	    header('Content-type: text/xml');   // i am getting error on this line
	    //Cannot modify header information - headers already sent by (output started at D:\xampp\htdocs\yii\framework\web\CController.php:793)

	    header('Content-Disposition: Attachment; filename="Response.xml"');
	    // File to download
	    readfile('Response.xml');        // i am not able to download the same file
	}
	
    }
    public function allot_country(){
    	$this->load->view('api/allot_country');
    }

}

?>
