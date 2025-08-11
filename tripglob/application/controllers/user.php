<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
error_reporting(0);
class User extends CI_Controller {
	public function __construct(){
		
		parent::__construct();
		//DO : Setting Current website url in session, 
		//Purpose : For keeping the page on login/logout.
		//Begin
		$current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = WEB_URL.$this->uri->uri_string(). $current_url;
		$url =  array(
            'continue' => $current_url,
        );
        $this->session->set_userdata($url);
		//End
		$this->load->model('account_model');
	}
	public function addAffilate()
	{
		$data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
         if($data['userInfo']->user_type_name == 'B2B') 
		{
	 			$update['affilate_link'] = $_POST['Affilate_link'];
	 			$this->db->update('user_details', $update, array('user_id' => $user_id));
	 			$this->db->last_query();die;
	 	}
	 	echo json_encode("Done");
	}
	 public function addMarkup() {
		 $data['user_id'] = $user_id = $this->session->userdata('user_id');
         $data['user_type']=$user_type =  $this->session->userdata('user_type');
         $data['userInfo'] = $this->general_model->get_user_details($user_id,$user_type);
	 		
	 		
		if($data['userInfo']->user_type_name == 'B2B') 
		{
	 		
	 		if(isset($_POST['product_id'])){
	 			$product_id = $_POST['product_id'];
	 		}
	 		$insert_data = array(
	 				'product_id' => $product_id,
	 				'markup_value_type'=>$_POST['markup_value_type'],
	 				'markup'=>$_POST['markup'],
	 				'user_id'=>$user_id
	 			);
	 	//	echo "<pre>"; print_r($insert_data); 
	 		$this->account_model->addMarkUp_model($insert_data,$user_id,$product_id,$_POST);
		/*foreach($_POST as $key=>$val)
		{	
			 echo "<pre>"; print_r($key);
			 echo "<pre>"; print_r($val);

			$keyval  =  explode("Markup",$key);
			
			 echo "<pre>"; print_r($keyval);

			if(isset($keyval[1]))
			{

			  if($val <= 100 && $val >= 0) {
            	  $markup_float = (float)$val;
            		
            	
            	  // echo $markup_float;
            	   exit();
					$this->account_model->addMarkUp_model($user_id, $keyval[1],$markup_float);
			   }
			}
		}*/
       
		}
        
            echo json_encode("Done");
      
    }



}
















?>
