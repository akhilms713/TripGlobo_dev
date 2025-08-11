<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Promo extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('promo_model');
		$this->load->model('usertype_model');
			$this->load->model('user_model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      	$this->output->set_header("Pragma: no-cache");
	    $this->load->library('form_validation');
	    $this->load->helper(array('form', 'url'));
	    $this->load->model('email_model');
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

	function promo_list($status='')
	{
		$data['promo'] = $this->promo_model->get_promo_list();
		$data['status'] = $status; 
	     //debug($data['promo']);exit;
		$this->load->view('promo/view',$data);
	}
	function update_promo_status()
	{
		$id = $_POST['id'];
		$status = $_POST['status'];
		
			
			if($this->promo_model->update_promo_status($id,$status))
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
	
	public function delete_promo($id)
	{
				$wheres = "promo_id = $id";
				$this->db->delete('promo', $wheres);
				redirect(WEB_URL.'promo/promo_list','refresh');
	}
	public function edit_promo($id)
	{
		 $data['promo'] = $this->promo_model->get_promo_list_id($id); 
		 $execute_query = $this->db->query('select * from airline_list');
		 $data['airline_list'] =$execute_query->result_array();
		 $data['agent_user'] = $this->user_model->get_allusers('B2B');
	 	 $this->load->view('promo/edit_promo',$data);
	}

	public function update_promo_new($id)
	{
			 // debug($_POST);exit;
	    $e_date = explode("/",$this->input->post('exp_date'));
			$yy = explode(" ",$e_date[2]);
			 $e_date1 = $yy[0].'-'.trim($e_date[0]).'-'.trim($e_date[1]);
		// debug(date('Y-m-d',strtotime($e_date1)));exit;
		if($this->input->post('module_type')=='bus' || $this->input->post('module_type')=='hotel')
		{
			
           $data=array(
           //   'promo_id'=>$this->input->post('promo_id'),
              // 'user_type'=>$this->input->post('user_type'),
              'user_id'=>$this->input->post('agent_user_id'),
              'promo_code'=>$this->input->post('promo_code'),
              'description'=>$this->input->post('description'),
              'minimum_amount'=>0,
              'module'=>$this->input->post('module_type'),
              'discount'=>$this->input->post('discount'),
              
              'expiry_date'=>date('Y-m-d',strtotime($e_date1)),
              'limit'=>$_POST['promo_code_type'] ,
              'promo_type'=>'PERCENTAGE',
              'limit_count'=>($_POST['promo_code_type']=='multiple')?$_POST['limit']:1 ,
           );
          
           $this->promo_model->update_promo_detail($data,$id);
           $this->session->set_flashdata('success', 'Update successfully');
           redirect(WEB_URL.'promo/promo_list','refresh');
		}
		else
		{
             $data=array(

              // 'user_type'=>$this->input->post('user_type'),
              'user_id'=>$this->input->post('agent_user_id'),
              'promo_code'=>$this->input->post('promo_code'),
              'description'=>$this->input->post('description'),
              'minimum_amount'=>0,
              'module'=>$this->input->post('module_type'),
              'airline_code'=>$this->input->post('airline_code'),
              
              'discount'=>$this->input->post('discount'),
              'expiry_date'=>date('Y-m-d',strtotime($e_date1)),
              'limit'=>$_POST['promo_code_type'] ,
              'promo_type'=>'PERCENTAGE',
              'limit_count'=>($_POST['promo_code_type']=='multiple')?$_POST['limit']:1 ,
           );
            // debug($data);exit;
           $this->promo_model->update_promo_detail($data,$id);
           $this->session->set_flashdata('success', 'Update successfully');
           redirect(WEB_URL.'promo/promo_list','refresh');
		}
		 
		
		
	}
	public function update_promo_new_amount($id)
	{
		// debug($_POST);exit;
	    	$e_date = explode("/",$this->input->post('exp_date'));
			$yy = explode(" ",$e_date[2]);
			$e_date1 = $yy[0].'-'.$e_date[0].'-'.$e_date[1].' 00:00:00.00';
		
         if($this->input->post('module_type')=='bus' || $this->input->post('module_type')=='hotel')
		{
// 			$exp_date = $this->input->post('exp_date');
		
           $data=array(
           //   'promo_id'=>$this->input->post('promo_id'),
              
              'user_id'=>$this->input->post('agent_user_id'),
              'promo_code'=>$this->input->post('promo_code'),
              'description'=>$this->input->post('description'),
              'minimum_amount'=>$this->input->post('minimum_amount'),
              'module'=>$this->input->post('module_type'),
              
              'promo_type'=>'AMOUNT',
              'discount'=>$this->input->post('discount'),
              'promo_amount'=>$this->input->post('discount'),
              'limit'=>$_POST['promo_code_type'] ,
              'expiry_date'=>$e_date1,
              'limit_count'=>($_POST['promo_code_type']=='multiple')?$_POST['limit']:1 ,
           );
           $this->promo_model->update_promo_detail($data,$id);
           $this->session->set_flashdata('success', 'Update successfully');
           redirect(WEB_URL.'promo/promo_list','refresh');
		}
		else
		{
             $data=array(

             
              'user_id'=>$this->input->post('agent_user_id'),
              'promo_code'=>$this->input->post('promo_code'),
              'description'=>$this->input->post('description'),
              'minimum_amount'=>$this->input->post('minimum_amount'),
              'module'=>$this->input->post('module_type'),
              'airline_code'=>$this->input->post('airline_code'),              
              'promo_type'=>'AMOUNT',
              'discount'=>$this->input->post('discount'),
              'promo_amount'=>$this->input->post('discount'),
              'expiry_date'=>$e_date1,
              'limit'=>$_POST['promo_code_type'] ,
              'limit_count'=>($_POST['promo_code_type']=='multiple')?$_POST['limit']:1 ,
           );
            // print_r($data);
           $this->promo_model->update_promo_detail($data,$id);
           $this->session->set_flashdata('success', 'Update successfully');
           redirect(WEB_URL.'promo/promo_list','refresh');
		}
		 
	}
	public function send_promo_to_user($id,$status='')
	{
		$data['id']= $id;
		$data['promo'] = $this->promo_model->get_promo_list_id($id); 
		$data['user_type'] = $this->promo_model->get_user_type(); 
		 $data['status'] = $status;
		// debug($data['promo']);exit; 
		$this->load->view('promo/send_email',$data);
	}
	public function send_promo_to_user_do($id)
	{
		// echo "<pre>";print_r($_POST);exit;
		$email='';
		$emailid = $_POST['emailid'] ;
		$str_arr = preg_split ("/\,/", $emailid);  
		// print_r($str_arr); 
		// echo $emailid;exit;
		if(isset($_POST['user_type']) && $_POST['user_type']!='')
		{	
				$user_list = $this->promo_model->get_user_list_details(implode(",",$_POST['user_type'])); 
				for($i=0;$i<count($user_list);$i++)
				{
					$email  .= $user_list[$i]->user_email_id.', ';
				}
			
		
		}
		if(isset($_POST['emailid']))	
		{
			$email  .= $_POST['emailid'] ;
		}

		$get_promo_code  = $this->db->query("select * from promo where promo_id=".$id." and status='ACTIVE' ");
		$promo_arr = array();
		if($get_promo_code->num_rows()!=''){
			$promo_arr = $get_promo_code->result_array();
		}
		$promodata = $this->promo_model->get_promo_list_id($id); 
		$promomessage = $promodata->description ;
		$message = '';
		// $this->load->library('provab_mailer');
		if($promo_arr){
			// $message = 'Use this promo code '.$promo_arr[0]['promo_code'].' get '.$promo_arr[0]['discount'].' '.$promo_arr[0]['promo_type'];
			$message = 'Use this promo code '.$promo_arr[0]['promo_code'].' get '.$promomessage;
			for($j=0;$j<count($str_arr);$j++){
				// echo $str_arr[$j];
				$res = $this->email_model->sendpromomail($str_arr[$j],$_POST['subject'],$message);
				// echo $res;
			}
			
			// echo $res;exit;
			// $message = 'Use this promo code '.$promo_arr[0]['promo_code'].' get '.$promo_arr[0]['discount'].' '.$promo_arr[0]['promo_type'];

			// $mail_status = $this->provab_mailer->send_mail($email,$_POST['subject'],$message);
			if($res == "true"){
				redirect(WEB_URL.'promo/promo_list/2','refresh');
			}
			else{
				redirect(WEB_URL.'promo/promo_list/0','refresh');
			}
			redirect(WEB_URL.'promo/promo_list/2','refresh');
		}else{
			redirect(WEB_URL.'promo/promo_list/0','refresh');
		}
	
		//
		//redirect(WEB_URL.'promo/promo_list','refresh');
	}
	public function add_new_promo($status='')
	{

		$data['status']=$status;
		$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$res = "";
		for ($i = 0; $i < 10; $i++) {
			$res .= $chars[mt_rand(0, strlen($chars)-1)];
		}
		$data['promo_code'] = $res;
		$execute_query = $this->db->query('select * from airline_list');
		$data['airline_list'] =$execute_query->result_array();
		$data['user_type'] = $this->usertype_model->get_user_type_list();
		$data['staff_user'] = $this->user_model->get_allusers('STAFF');
		$data['agent_user'] = $this->user_model->get_allusers('B2B');
		//echo '<pre>';print_r($data['agent_user']);exit();
		$this->load->view('promo/add_promo',$data);
	}
	function add_promo_new()
	{
		// debug($_POST);exit;
			$b2c_airport = $_POST['b2c_airport'];
			$b2b_airport = $_POST['b2b_airport'];
			if($b2c_airport !='')
			{

				if(!empty($_FILES['pic_name']['name']))
				{	
					if(is_uploaded_file($_FILES['pic_name']['tmp_name'])) 
					{
						$sourcePath = $_FILES['pic_name']['tmp_name'];
						$img_Name=time().$_FILES['pic_name']['name'];
						$targetPath = "uploads/promo_img/".$img_Name;
						if(move_uploaded_file($sourcePath,$targetPath)){
							$promo_logo_name = $img_Name;
						}
					}				
				}

				$promo_image_b2c = $promo_logo_name;
			}
			if($b2b_airport != ''){
				if(!empty($_FILES['pic_name']['name']))
				{	
					if(is_uploaded_file($_FILES['pic_name']['tmp_name'])) 
					{
						$sourcePath = $_FILES['pic_name']['tmp_name'];
						$img_Name=time().$_FILES['pic_name']['name'];
						$targetPath = "uploads/promo_img/".$img_Name;
						if(move_uploaded_file($sourcePath,$targetPath)){
							$promo_logo_name = $img_Name;
						}
					}				
				}
				$promo_image_b2b = $promo_logo_name;
			}
			// echo $promo_logo_name;
			// exit;
			$promo_code = $_POST['promo_code'];
			$discount = $_POST['discount'];
			$exp_date = $_POST['exp_date'];
			$e_date = explode("/",$_POST['exp_date']);
		//	print_r($e_date);die;
			$description= $_POST['description'];
			$minimum_amount= 0;
			$airline_code= $_POST['airline_code'];
			$module_type = $_POST['module_type'];
			$user_type = $_POST['user_type'];
			$limit = $_POST['promo_code_type'];
			if ($limit=='multiple') {				
			$limit_count = $_POST['limit'];
			}else{
			$limit_count = 1;
			}
			$user_id = '';
			if($user_type == 1)
			{
			 $user_id = $_POST['agent_user_id'];
			}
			
			if($user_type == 4)
			{
			 $user_id = $_POST['staff_user_id'];
			}
			
			//die('dd');
		// echo "<pre/>";print_r($_FILES);die;
		if ($_FILES["pic_name"]["tmp_name"] != "") {
			// echo "<pre/>";print_r($_FILES);die;
			$img_typre = explode(".", $_FILES["pic_name"]["name"])[1];
				if (IMAGE_UPLOAD != "") {
					$config['upload_path'] =$_SERVER['DOCUMENT_ROOT'].'/flyonair/photo/users/';
				} else {
					$config['upload_path'] =$_SERVER['DOCUMENT_ROOT'].'/photo/users/';
				}
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']	= '2048';
				$config['max_width'] = '10024';
				$config['max_height'] = '10768';
				$config['file_name'] = 'profile_pic_'.time();
				// echo "<pre/>";print_r($config);die;
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('pic_name')){
					//echo $this->upload->display_errors();die;
					$error = array('error' => $this->upload->display_errors());
					
				}else{
				//now get the file uploaded data 
				$data = array('upload_data' => $this->upload->data());

				//get the uploaded file name
				$data['pic_name'] = WEB_FRONT_URL."photo/users".$this->upload->file_name.$img_typre;
				$pic_name = (isset($_FILES['pic_name']['name'])) ? ($config['file_name'].".".$img_typre) : "";
				// echo $data['pic_name'];die;
				//store pic data to the db
				//$this->promo_model->add_promo_new($data);
			}
		}

			$yy = explode(" ",$e_date[2]);
			
			$e_date1 = $yy[0].'-'.$e_date[0].'-'.$e_date[1].' 00:00:00.000000';
			
		$Query="select * from  promo  where promo_code ='".$promo_code."' ";
	 
		 $query=$this->db->query($Query);
		
		if ($query->num_rows() > 0)
		{
			
			$data['status'] = '11';
			$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$res = "";
			for ($i = 0; $i < 10; $i++) {
				$res .= $chars[mt_rand(0, strlen($chars)-1)];
			}
			$data['promo_code'] = $res;
			$execute_query = $this->db->query('select * from airline_list');
			$data['airline_list'] =$execute_query->result_array();
			$this->load->view('promo/add_promo',$data);
		
		}
		else
		{
		if($this->promo_model->add_promo_new($user_id,$user_type,$discount,$promo_code,$e_date1,$description,$minimum_amount,$airline_code,$module_type,$pic_name, $promo_image_b2c, $promo_image_b2b,$limit,$limit_count))
			{
				redirect(WEB_URL.'promo/promo_list','refresh');
			}
			
		}
	}
	function add_promo_new_amount()
	{
			$promo_code = $_POST['promo_code'];
			$discount = $_POST['discount'];
			$exp_date = $_POST['exp_date'];
			$promo_amount = $_POST['promo_amount'];
			$e_date = explode("/",$_POST['exp_date']);
			$description= $_POST['description'];
			$minimum_amount= $_POST['promo_amount'];
			$airline_code= $_POST['airline_code'];
			$module_type = $_POST['module_type'];
			$user_type = $_POST['user_type'];
			
			$user_id = '';
			if($user_type == '1')
			{
			 $user_id = $_POST['agent_user_id'];
			}
			
			if($user_type == '4')
			{
			 $user_id = $_POST['staff_user_id'];
			}

			if ($_FILES["pic_name1"]["tmp_name"] != "") {
				if (IMAGE_UPLOAD != "") {
					$config['upload_path'] =$_SERVER['DOCUMENT_ROOT'].'/flyonair/photo/users/';
				} else {
					$config['upload_path'] =$_SERVER['DOCUMENT_ROOT'].'/photo/users/';
				}
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']	= '2048';
				$config['max_width'] = '10024';
				$config['max_height'] = '10768';
				$config['file_name'] = 'profile_pic_'.time();
				// echo "<pre/>";print_r($config);die;
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('pic_name1')){
					//echo $this->upload->display_errors();die;
					$error = array('error' => $this->upload->display_errors());
					
				}else{
				//now get the file uploaded data 
				$data = array('upload_data' => $this->upload->data());

				//get the uploaded file name
				$data['pic_name1'] = WEB_FRONT_URL."photo/users".$this->upload->file_name;
				$pic_name1 = (isset($_FILES['pic_name1']['name'])) ? $_FILES['pic_name1']['name'] : "";
				// echo $data['pic_name'];die;
				//store pic data to the db
				//$this->promo_model->add_promo_new($data);
			}
		}
			
			$yy = explode(" ",$e_date[2]);
			//echo '<pre>';print_r($e_date);
			$e_date1 = $yy[0].'-'.$e_date[0].'-'.$e_date[1].' 00:00:00.000000';
			//echo $e_date1;die;
		$Query="select * from  promo  where promo_code ='".$promo_code."' ";
	 
		 $query=$this->db->query($Query);
		
		if ($query->num_rows() > 0)
		{
			
			$data['status'] = '11';
			$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$res = "";
			for ($i = 0; $i < 10; $i++) {
				$res .= $chars[mt_rand(0, strlen($chars)-1)];
			}
			$data['promo_code'] = $res;
			$execute_query = $this->db->query('select * from airline_list');
			$data['airline_list'] =$execute_query->result_array();
			$this->load->view('promo/add_promo',$data);
		
		}
		else
		{
			if($this->promo_model->add_promo_new_amount($user_id,$user_type,$discount,$promo_code,$e_date1,$promo_amount,$description,$minimum_amount,$airline_code,$module_type,$pic_name1))
			{
				redirect(WEB_URL.'promo/promo_list','refresh');
			}
			
		}
	}
	
	function update_bulk_promo_status(){
	    $today_date=date('Y-m-d');
	    $Query="UPDATE `promo` SET `status` = 'INACTIVE' WHERE  `expiry_date` <'".$today_date."' ";
		 $query=$this->db->query($Query);
	}

	
}

?>
