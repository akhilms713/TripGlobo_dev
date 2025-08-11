<?php
class Noticeboard_Model extends CI_Model {
	
	public function __construct(){
	    parent::__construct();
    }
    
    public function get_usertypes(){
		$this->db->where('status', 'ACTIVE');
		$query = $this->db->get('user_type');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return '';
		}
	}
	
	public function update_notice($users,  $expiry,$message){
		if($expiry == 0){
			$expiry_type = 'MANUAL';
			$exp_date =  '';
		}else{
			$expiry_type = 'AUTO';
			$exp_date =  date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' + '.$expiry.' days'));;
		}
		
		
		$data = array(
			'user_type' => $users,
			'expiry_period_days' => $expiry_type,
			'expiry_date' => $exp_date,
			'notice_content' => mysql_real_escape_string($message),
			'status' => 'ACTIVE',
			'created_date' => date('Y-m-d H:i:s')			
			);
		if ($this->db->insert('notice_boards', $data)) {	
			return true;
		} else {
			return false;
		}
   }
   
   public function get_notice_list(){
		$this->db->select('*');
		$query = $this->db->get('notice_boards');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return '';
		}
   }
   
   public function update_notice_status($id,  $status){
		$data = array(
			'status' => mysql_real_escape_string($status)
		);
		
		$where = "notice_board_id = '$id'";
		if ($this->db->update('notice_boards', $data, $where)) {
			return true;
		} else {
			return false;
		}
	} 
	
	public function delete_notice($id){
		$where = "notice_board_id = '$id'";
		if ($this->db->delete('notice_boards', $where)) {
			return true;
		} else {
			return false;
		}
	}
	
	
}
