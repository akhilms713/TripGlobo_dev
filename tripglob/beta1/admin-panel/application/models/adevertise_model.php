<?php
class Adevertise_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}


function add_new_adevertise_do($data)
{
	//print_r($data);exit;
	$this->db->insert('advertise_detail', $data);
	return true;
}

function get_alladevertise()
{
	$this->db->select('*');
    $this->db->from('advertise_detail');				
	$query = $this->db->get();
		if ( $query->num_rows > 0 ){
		return $query->result();
	    }
		else
		{
			return '';
		}	
	
}
function update_adevertise_status1($id,$status)
{
	$data = array(
		'advertise_status' => $status		
		);
	
		$where = "advertise_id ='$id'";

	if ($this->db->update('advertise_detail', $data, $where)) {
		
		return true;
	} else {
		
		return false;
	}
   
}
function get_adevertisebyid($id)
{
	$this->db->select('*');
    $this->db->from('advertise_detail');
    $this->db->where('advertise_id',$id);				
	$query = $this->db->get();
		if ( $query->num_rows > 0 ){
		return $query->result();
	    }
		else
		{
			return '';
		}
}
function update_adevertise_do($data,$id)
{
	$this->db->WHERE('advertise_id',$id);
	$this->db->update("advertise_detail",$data);	
	return true;
}
function delete_adevertisebyid($id)
{
	$this->db->WHERE('advertise_id',$id);
	$this->db->delete("advertise_detail");	
	return true;
}



	
	
}
?>