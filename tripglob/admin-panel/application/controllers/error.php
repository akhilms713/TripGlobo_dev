<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Error extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	 public function page_missing(){
        $this->load->view('/errors/404');
    }
}
















?>
