<?php
class Class_Control_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_list($id = ''){
		$this->db->select('*');
		$this->db->from('class_control');
		if($id !='')
			$this->db->where('id', $id);
		$query=$this->db->get();
		return $query;
	}
	
    function add($input){
		$this->db->insert('class_control',$input);
	}

	function update_ad($input,$id){
		$this->db->where('id', $id);
		$this->db->update('class_control', $input);
	}
		
	function delete_ad($id){
		$this->db->where('id', $id);
		$this->db->delete('class_control'); 
	}

	function status_ad($id,$status)
    {
        $data = array(
            'status' => $status       
            );
        
            $where = "id ='$id'";

        if ($this->db->update('class_control', $data, $where)) {
            
            return true;
        } else {
            
            return false;
        }
       
    }
	
}
?>
