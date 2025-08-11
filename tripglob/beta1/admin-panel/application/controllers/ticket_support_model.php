<?php
class Ticket_Support_Model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function viewsubjects(){
		$this->db->select('*');
		$query = $this->db->get('support_ticket_subject')->result();
		return $query;
	}
	public function deletesubjects($id){
		$this->db->where('support_ticket_subject_id', $id);
	    return $this->db->delete('support_ticket_subject'); 
 
	}
	public function addsubjects($title){
	return $this->db->insert('support_ticket_subject', $title); 
	}
	public function allinbox(){
		$this->db->select('*');
		$query = $this->db->get('support_ticket')->result();
		return $query;

	}
}
?>