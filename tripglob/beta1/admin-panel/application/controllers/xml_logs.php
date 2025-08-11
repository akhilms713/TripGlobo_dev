<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Xml_Logs extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	  
		$this->load->model('xmllog_Model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");
	  $this->load->library('form_validation');
   
   }
   public function view(){
   	$data['xml_logs'] = $this->xmllog_Model->get_xmllogs();
   	$this->load->view('xmllogs/view',$data);
		
	
    }
    public function booking_logs(){
    	$data['booking_logs'] = $this->xmllog_Model->get_bookingxmllogs();
   	$this->load->view('xmllogs/booking_logs',$data);
    }
      public function export_xml_log_request($id){
    
	$user_data = $this->xmllog_Model->getOneXmlLogs($id); 
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
    public function export_xml_log_response($id){
	$user_data = $this->xmllog_Model->getOneXmlLogs($id); 
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
   }
