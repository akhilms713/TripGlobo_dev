<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Static_page extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('static_page_Model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      	$this->output->set_header("Pragma: no-cache");
	    $this->load->library('form_validation');
		$this->check_isvalidated();
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

	public function addNewPageForm(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$this->load->view('static_page/add_page');
		}else{
		  redirect('','refresh');
		}	
	}
	public function addNewFaqForm(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$this->load->view('static_page/addNewfaqForm');
		}else{
		  redirect('','refresh');
		}	
	}
	public function addNewPageDetails(){
		$this->load->helper('text');
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$title = $this->input->post('title');
			$label = $this->uniqueLabel(substr($title, 0,100));
			$english = $this->input->post('english');
			$farsi ='';
			$this->form_validation->set_rules('english', 'english', 'trim|required|min_length[3]|xss_clean');     
        	//$this->form_validation->set_rules('farsi', 'farsi', 'required|xss_clean');
			$exists = $this->static_page_Model->isTitleExists($label);
			if($this->form_validation->run($this) == FALSE) 
			{
			    $data['notvalid'] = "Please enter the content for all the languages";		
			    $this->load->view('static_page/addnewpagesform',$data);	
			} else if($exists){
				$data['notvalid'] = "Page title already Exists, Please use another one";		
			    $this->load->view('static_page/addnewpagesform',$data);
			} 
			else {
				$labels = array(
						'title' => $title,
						'english' => $english,
						'farsi' => $farsi,
						'slug' => $label,
						'url' => '',
						'guid' => ''			
						);			
				$res = $this->static_page_Model->addNewPageDetails($labels);
				if($res){
					redirect(WEB_URL.'static_page/viewAllPages');			
				}
			}
		}else{
		  redirect('','refresh');
		}
	}
	public function addNewfaqDetails(){
		$this->load->helper('text');
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
		
			$english = $this->input->post('english');
			$farsi = $this->input->post('english1');
			$this->form_validation->set_rules('english', 'english', 'trim|required|min_length[3]|xss_clean');     
        	$this->form_validation->set_rules('english1', 'english1', 'trim|required|min_length[3]|xss_clean');
		
			if($this->form_validation->run($this) == FALSE) 
			{
			    $data['notvalid'] = "Please enter the content for all the Faq";		
			    $this->load->view('static_page/addNewFaqForm',$data);	
			} else {
				$labels = array(
					
						'question' => $english,
						'answer' => $farsi
								
						);			
				$res = $this->static_page_Model->addNewfaqDetails($labels);
				if($res){
					redirect(WEB_URL.'static_page/faqpage');			
				}
			}
		}else{
		  redirect('','refresh');
		}
	}
	
	public function isTitleExists(){
		$type = $this->input->post('data');
		$label = $this->uniqueLabel(substr($type, 0,100));
		$exists = $this->static_page_Model->isTitleExists($label);
		if($exists){
			$response = array('s'=>'Sorry Dear, Page title is already exists please use another title','status'=>0);
		}else{
			$response = array('s'=>'Page title available','status'=>1);
		}
		echo json_encode($response);
	}
	
	public function viewAllPages(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$data['pages'] = $this->static_page_Model->viewAllPages();
			$this->load->view('static_page/viewpages',$data);
		}else{
		  redirect('','refresh');
		}	
	}
	public function faqpage(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$data['faqpage'] = $this->static_page_Model->viewAllfaqPages();
			$this->load->view('static_page/viewfaqPages',$data);
		}else{
		  redirect('','refresh');
		}	
	}
	
	public function editPage($id){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			if($id){
				$data['edit'] = $this->static_page_Model->editPage($id);
				$this->load->view('static_page/edit_page',$data);
			}else{
				redirect(WEB_URL.'cms/viewpages');
			}
			
		}else{
		  redirect('','refresh');
		}	
	}

	public function editfaqPage($id){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			if($id){
				$data['edit'] = $this->static_page_Model->editfaqPage($id);
				$this->load->view('CMS/editfaqPage',$data);
			}else{
				redirect(WEB_URL.'static_page/viewfaqPages');
			}
			
		}else{
		  redirect('','refresh');
		}	
	}
	public function updatePage($id){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			if($id){
				$english = $this->input->post('english');
				$farsi = '';
				$this->form_validation->set_rules('english', 'english', 'trim|required|min_length[3]|xss_clean');       
				//$this->form_validation->set_rules('farsi', 'farsi', 'trim|required|min_length[3]|xss_clean');
				if($this->form_validation->run($this) == FALSE) 
				{
					$data['notvalid'] = "Please enter the content for all the languages";
					$data['edit'] = $this->static_page_Model->editPage($id);
					$this->load->view('static_page/editPage',$data);	
				} else {
					$labels = array(
							'id' => $id,
							'english' => $english,
							'farsi' => $farsi
							);			
					$res = $this->static_page_Model->updatePage($labels);
					if($res){
						redirect(WEB_URL.'static_page/viewAllPages');			
					}
				}
			}else{
				redirect(WEB_URL.'cms/viewAllPages');
			}
			
		}else{
		  redirect('','refresh');
		}
	}

	public function updatefaqPage($id){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			if($id){
				$english = $this->input->post('questionss');
				$farsi =$this->input->post('answersd');
				$this->form_validation->set_rules('questionss', 'questionss', 'trim|required|min_length[3]|xss_clean');       
				$this->form_validation->set_rules('answersd', 'answersd', 'trim|required|min_length[3]|xss_clean');
				if($this->form_validation->run($this) == FALSE) 
				{
					$data['notvalid'] = "Please enter the content for all the Contents";
					$data['edit'] = $this->static_page_Model->editfaqPage($id);
					$this->load->view('static_page/editPage',$data);	
				} else {
					$labels = array(
							'id' => $id,
							'question' => $english,
							'answer' => $farsi
							);			
					$res = $this->static_page_Model->updatefaqPage($labels);
					if($res){
						redirect(WEB_URL.'static_page/faqpage');			
					}
				}
			}else{
				redirect(WEB_URL.'static_page/faqpage');
			}
			
		}else{
		  redirect('','refresh');
		}
	}
	public function deletePage($id){
		$res = $this->static_page_Model->deletePage($id);
		if($res){
			redirect(WEB_URL.'static_page/viewAllPages');	
		}
	}
	public function deleteFaqPage($id){
		$res = $this->static_page_Model->deletefaqPage($id);
		if($res){
			redirect(WEB_URL.'static_page/faqpage');	
		}
	}
	public function updatePageStatus(){
		$value=$this->input->post('status');
		$id=$this->input->post('id');
		$status = array('status'=>$value);
		$res = $this->static_page_Model->updatePageStatus($id,$status);
		if($res){
			redirect(WEB_URL.'static_page/viewAllPages');	
		}
	}
	public function uniqueLabel($string) {
		//Lower case everything
		$string = strtolower($string);
		//Make alphanumeric (removes all other characters)
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		//Clean up multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", " ", $string);
		//Convert whitespaces and underscore to dash
		$string = preg_replace("/[\s_]/", "-", $string);
		return $string;
	}
	public function contact(){
		$data['currentAddress'] = $this->static_page_Model->currentAddress()->row();
		$this->load->view('static_page/view_contact', $data);
	}

	public function addcontact() {
		$address = $this->input->post('address');
		$contact = $this->input->post('contact');
		$email = $this->input->post('email');
		$website = $this->input->post('website');

		
		$data = array('address'=>$address, 
					  'contact'=>$contact,
					  'email'=>$email,
					  'website'=>$website);


		$this->static_page_Model->addcontact($data);

		redirect(WEB_URL.'cms/contact');
	}

	/*Why solace module begins*/	

	public function whySolace() {
		$data['allWbwsData'] = $this->static_page_Model->getAllWbws()->result();
		$this->load->view('static_page/viewAllWbws', $data);
	}

	public function editWbws($id) {
		$data['wbws_details'] = $this->static_page_Model->getCurrentWbwsDetails($id)->row();
		$this->load->view('static_page/editWbws', $data);
	}

	public function editWbws_save() {
		$id = $this->input->post('wbws_id');
		$title = $this->input->post('wbws_title');
		$english_content = $this->input->post('english_content');
		$farsi_content = '';
		$data = array('title'=>$title, 'english_content'=>$english_content, 'farsi_content'=>$farsi_content);

		$this->static_page_Model->editWbws_save($id, $data);
		redirect(WEB_URL.'static_page/whySolace');
	}

	
 
	
}
?>
