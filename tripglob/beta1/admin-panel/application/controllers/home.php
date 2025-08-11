<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		//$this->check_isvalidated();
		$this->load->model('admin_model');
		$this->load->model('home_model');
		$this->load->model('user_model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      	$this->output->set_header("Pragma: no-cache");
	    $this->load->library('form_validation');
	    $this->load->helper('app_helper');
	}
	function get_flight_suggestions(){        
            $term = trim(strip_tags($this->input->get('term')));
            $rsa = $this->home_model->getAirportcitylist($term);
            $rsa1 = $this->home_model->getAirportcodelist($term);
            if(count($rsa)!=0){
                  for ($i=0; $i < count($rsa); $i++) {    
                      $rss = $this->home_model->getAirportlist($rsa[$i]->city_code);
                      for($rs=0;$rs<count($rss);$rs++){
                         /* if($rs==0){
                              $data['label']  = $rss[$rs]->airport_city.', '.$rss[$rs]->country."(All Airports)--(".$rss[$rs]->airport_code.")";
                              $data['value']  = $rss[$rs]->airport_city.' ('.$rss[$rs]->airport_code.')';
                              $data['id']  = $rss[$rs]->airport_id;
                              $results[]=$data;
                            }*/
                          $data['label']  = $rss[$rs]->airport_city.', '.$rss[$rs]->airport_name."  (".$rss[$rs]->airport_code.")      ".$rss[$rs]->country;    
                          $data['value']  = $rss[$rs]->airport_city.' ('.$rss[$rs]->airport_code.')';
                              $data['id']  = $rss[$rs]->airport_id;
                      $results[]=$data;
                        }           
                    }     
            echo json_encode($results);
            }elseif(count($rsa1)!=0){
				 for ($i=0; $i < count($rsa1); $i++) {    
                          $data['label']  = $rsa1[$i]->airport_city.', '.$rsa1[$i]->airport_name." (".$rsa1[$i]->airport_code.")         ".$rsa1[$i]->country ;    
                          $data['value']  = $rsa1[$i]->airport_city.' ('.$rsa1[$i]->airport_code.')';
                          $data['id']  = $rsa1[$i]->airport_id;
                      $results[]=$data;
                    }     
            echo json_encode($results);
				}else{
                $results=array("label"=>"no records");
            echo json_encode($results); 
            }
        
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
	function index()
	{

		$data['overall_sales'] = $this->home_model->get_overall_sales(array('booking_payment.payment_gateway_status' => 'SUCCESS'));
		#echo "hi";exit;
		$this->load->view('dashboard/admin_dashboard',$data);
	}
	
	function overall_booking_reports()
	{
		$data['user_type']= $_POST['user_type'];	
		echo $this->load->view('dashboard/graph/overall_booking_reports',$data);
	}
	
	function overall_users()
	{
		$data['status']= $_POST['status'];	
		echo $this->load->view('dashboard/graph/overall_users',$data);
	}
	function profile()
	{
		$data['admin_profile_info'] = $this->admin_model->get_admin_details();
		$this->load->view('dashboard/profile/manage_profile',$data);
	}
	
	function edit_profile()
	{
		$data['admin_profile_info'] = $this->admin_model->get_admin_details();
		$data['country_details'] 	= $this->user_model->get_country_details();
		$this->load->view('dashboard/profile/edit_admin_profile',$data);
	}
	
	function update_info()
	{
		
		$admin_id =$_POST['admin_id'];
		//print_r($_POST);exit;
		
	/*			
	 * $admin_profile_name  = $_REQUEST['previous_profile_photo'];

	 * 
	 * if(!empty($_FILES['profile_photo']['name'])){	
						if(is_uploaded_file($_FILES['profile_photo']['tmp_name'])) {
							$allowed =  array('gif','png' ,'jpg', 'jpeg');
							$oldImage = "uploads/users/".$admin_profile_name;
							unlink($oldImage);
							$sourcePath = $_FILES['profile_photo']['tmp_name'];
							$filename = $_FILES['profile_photo']['name'];
							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							if(in_array($ext,$allowed) ) {
								$img_Name	= time().$_FILES['profile_photo']['name'];
								$targetPath = "uploads/users/".$img_Name;
								if(move_uploaded_file($sourcePath,$targetPath)){
									$admin_profile_name = $img_Name;
								}
							}
						}				
					}
					
			print_r($admin_profile_name);  
			print_r($_POST);  
			exit;
		*/
			$this->admin_model->update_admin($_POST,$admin_id);
			
		redirect('home/profile','refresh');
	}
	
	
	function change_password($status='')
	{
		$data['status']=$status;
		$data['admin_profile_info'] = $this->admin_model->get_admin_details();
		$this->load->view('dashboard/profile/change_password', $data);
	}
	function update_password(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('opassword', 'Old Password', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password2', 'Confirm password', 'required');
		$data['status']='';
		if ( $this->form_validation->run() !== false ) 
		{
			// echo md5("admin");
			$check_password = $this->admin_model->check_admin_password(md5($this->input->post('opassword')));
			// echo $check_password;exit;
			if($check_password == 1)
			{
			   $new_password = $this->input->post('password');
			   if ($this->admin_model->update_admin_password($new_password)) {
				   
				   $status=1;
			   }
			   else
			   {
				 
					$status=0;
			   }
			}
			else
			{
			  $status=11;
				
			}
		}
		else
		{
			$status=0;
		}
		
		redirect(WEB_URL.'home/change_password/'.$status,'refresh');
	}
	

public function change_logo($profile_id = '')
{
	
	if ($this->session->userdata('admin_logged_in')) {
		if($profile_id!=''){
			$adminid =$profile_id;
		}else{
			$adminid =$this->session->userdata('admin_id');
		}
		
		if($adminid)
		{
			if ($_FILES["avatar_file"]["tmp_name"] != "") 
			{	

				$img_Name=time().$_FILES['avatar_file']['name'];
				if($adminid ==1){
					$targetPath = "uploads/users/".$img_Name;
				}else{
					$targetPath =  "../photo/users/".$img_Name;
				}

				$sourcePath = $_FILES['avatar_file']['tmp_name'];
				
				
				if(move_uploaded_file($sourcePath,$targetPath)){
					$user_profile = $img_Name;
				}
				// echo $user_profile;

				// $config['allowed_types'] = 'gif|jpg|png';
				// $config['max_size']	= '2048';
				// $config['max_width'] = '10024';
				// $config['max_height'] = '10768';
				// $config['file_name'] = 'profile_pic_'.time().$_FILES["avatar_file"]["name"];
				// // print_r($config);exit;
				// $this->load->library('upload', $config);
				// // echo $this->upload->file_name;
				// $imgg = 'profile_pic_'.time().$_FILES["avatar_file"]["name"];
				// echo $imgg;
				// echo $this->upload->file_name;exit;
				// $upload_data = $this->upload->data();
				if($adminid ==1){
					
					$data["admin_profile_pic"] =  base_url()."uploads/users/".$user_profile;
					
					if($this->home_model->update_admin( array('admin_id' => ($adminid)),$data))
					{
					    echo "yes"; die;
						echo json_encode( array('result' => $data["admin_profile_pic"], 'message' => 'Image uploaded successfully.' ));	
					}
					else
					{
					    echo "yes"; die;
						echo json_encode( array('message' => 'Image upload failed.' ));	
					}
					// $data["admin_profile_pic"] = base_url()."uploads/users/".$user_profile;
				}else{
					$data["profile_picture"] = $user_profile;
				
				// echo "<pre>";print_r($data);exit;
					if($this->home_model->update_users( array('user_id' => ($adminid)),$data))
					{
						echo json_encode( array('result' => $data["admin_profile_pic"], 'message' => 'Image uploaded successfully.' ));	
					}
					else
					{
						echo json_encode( array('message' => 'Image upload failed.' ));	
					}
				}
			}
		}
	}
}
    
    public function booking_events(){
        $lists = $this->home_model->getFlightLatMonthDetails($_POST);
        $status = true;
        $calendar_events = array();
        // echo "<pre>"; print_r($lists); exit();
        for ($i=0; $i < count($lists); $i++) {
           $calendar_events[$i] = array('title'      => $lists[$i]['parent_pnr_no'].'-BOOKING_'.$lists[$i]['booking_status'],
                                       'start'       => $lists[$i]['voucher_date'],
                                       'tip'         => 'API:'.$lists[$i]['api_name'].',LeadPax:'.$lists[$i]['leadpax'],
                                    //   'href'        => base_url().'booking/voucher_view/'.base64_encode(json_encode($lists[$i]['parent_pnr'])),
                                       'add_class'   => 'hand-cursor event-hand flight-booking');
        }
        header('content-type:application/json');
        echo json_encode(array('status' => $status, 'data' => $calendar_events));
        exit;
    }
	
}

?>
