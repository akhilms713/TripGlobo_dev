<?php
class Request_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

	public function get_advertise_list(){
        $this->db->select('*');
        $this->db->from('request_advertise_details');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_feedback_list(){
        $this->db->select('*');
        $data = $this->db->get('feedback_details');
        return $data->result();
    }
    
    public function get_workwithus_list(){
        $this->db->select('*');
        $data = $this->db->get('work_with_us');
        return $data->result();
    }
}
?>