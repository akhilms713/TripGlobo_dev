<?php
class Usertype_Model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

     function get_user_type_list($user_type_id = ''){
		$this->db->select('*');
		$this->db->from('user_type');
		$this->db->where('status', 'ACTIVE');
		if($user_type_id !='')
			$this->db->where('user_type_id', $user_type_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	 function add_user_type_details($input){
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$insert_data = array(
							'user_type_name' 		=> $input['user_type_name'],
							'status' 				=> $input['status'],
							'creation_date'			=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('user_type',$insert_data);
	}

	function active_user_type($user_type_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('user_type_id', $user_type_id);
		$this->db->update('user_type', $data); 
	}
	
	function inactive_user_type($user_type_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('user_type_id', $user_type_id);
		$this->db->update('user_type', $data); 
	}
	
	function delete_user_type($user_type_id){
		$this->db->where('user_type_id', $user_type_id);
		$this->db->delete('user_type'); 
	}
	
	function update_user_type($update,$user_type_id){
		if(!isset($update['status']))
			$update['status'] = "INACTIVE";
		$update_data = array(
							'user_type_name' 	=> $update['user_type_name'],
							'status' 			=> $update['status']					
						);
		$this->db->where('user_type_id', $user_type_id);
		$this->db->update('user_type', $update_data);
	}
}
?>
