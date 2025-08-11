<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	  public function dashboard(){
		 
        $this->load->view('dashboard/dashboard');
    }
}
















?>
