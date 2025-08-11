<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
// error_reporting(0)
class Airport_management extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');		
		$this->load->model('Airport_Manag_Model');
		//$this->check_admin_login();		
	}

	private function check_admin_login(){
		if($this->session->userdata('provab_admin_logged_in') == ""){
	        redirect('login','refresh');
        }else if($this->session->userdata('provab_admin_logged_in') == "Logged_In"){
			// redirect('dashboard','refresh');
        }else if($this->session->userdata('provab_admin_logged_in') == "Lock_Screen"){
			redirect('login/lock_screen','refresh');
		}
    }
	 
	function index($country = "India"){
		ini_set('memory_limit','-1');
			    $this->load->library("pagination");
	    $config = array();
        $config["base_url"] = base_url() . "airport_management/index/";
        $config["total_rows"] = $this->Airport_Manag_Model->get_airport_list_row();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['full_tag_open'] = '<ul class="pagination pull-right" style="margin-top: -20px;">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $airport["links"] = $this->pagination->create_links();
			
		$airport['airports'] 	= $this->Airport_Manag_Model->get_airport_list($config["per_page"], $page);
		$airport['total_rows']=$config["total_rows"];
// 		 echo "<pre>";print_r($airport['airports']);exit();
		$this->load->view('airport_manage/view',$airport);
	}

	function air_list(){
		$airport['airport_list'] 	= $this->Airport_Manag_Model->get_airport_lis_newt();
		$this->load->view('airport_manage/airport_list',$airport);
	}
	
	
	function add_airport(){
		if(count($_POST) > 0){
			$this->Airport_Manag_Model->add_airport_details($_POST);
			redirect('airport_management','refresh');
		}else{
			$data['countrys'] = $this->Airport_Manag_Model->get_country_select();
			$this->load->view('airport_manage/add_airport_manage', $data);
		}
	}

	function city_by_country(){
		$country = $_POST['countryN'];
		$dataCitys = $this->Airport_Manag_Model->get_city_select($country);
		foreach($dataCitys as $dataCity){
			echo '<option value="'.$dataCity->city.'">'.$dataCity->city.'</option>';
		}
	}


	
	function delete_airport($airport_id){
		//$airport_id = json_decode(base64_decode($airport_id));
		if($airport_id != ''){
			$this->Airport_Manag_Model->delete_airport($airport_id);
		}
		redirect('airport_management','refresh');
	}
	
	function edit_airport($airport_id){
		if($airport_id != ''){
			$airport['countrys'] = $this->Airport_Manag_Model->get_country_select();
			$airport['airport_list'] 	= $this->Airport_Manag_Model->get_airport_single($airport_id);

			if(count($_POST) > 0){
				$this->Airport_Manag_Model->update_airport($_POST,$airport_id);
				redirect('airport_management','refresh');
			} else {
				$this->load->view('airport_manage/edit_airport_manage',$airport);
			}
		} else {
			redirect('airport_management','refresh');
		}
	}

	function check_airportcode(){
		// echo "<pre/>";print_r($_POST);exit;
		$air_code = $_POST['air_code'];
		$status = $this->Airport_Manag_Model->check_airportcode($air_code);
		// echo "<pre/>";print_r($status);exit;
		echo json_encode($status);exit;
	}

	public function update_airport_status() 
	 {
		$id = $_GET['id'];
		$status = $_GET['status'];

		
        if($this->Airport_Manag_Model->update_airport_status1($id, $status))
		{
			$response = array('advertise_status' => 1);
        	echo json_encode($response);
		}
		else
		{
			$response = array('advertise_status' => 0);
        	echo json_encode($response);
		}
    }





    function index1(){
		$this->load->view('airport_manage/view_test');
	}


    public function datatable_test()
     {
          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $airport = $this->Airport_Manag_Model->get_airport_list_test();

          $data = array();

          foreach($airport->result() as $r) {

               $data[] = array(
                    $r->name,
                    $r->price,
                    $r->author,
                    $r->rating . "/10 Stars",
                    $r->publisher
               );
          }

          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $books->num_rows(),
                 "recordsFiltered" => $books->num_rows(),
                 "data" => $data
            );
          echo json_encode($output);
          exit();
     }

}
