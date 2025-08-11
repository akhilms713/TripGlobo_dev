<?php
class Topdeals_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}


function add_new_topdeal_do($data)
{
	$this->db->insert('top_deals', $data);
	return true;
}

function get_alltopdeals()
{
	$this->db->select('*');
    $this->db->from('top_deals');				
	$query = $this->db->get();
		if ( $query->num_rows > 0 ){
		return $query->result();
	    }
		else
		{
			return '';
		}	
	
}
function update_topdeals_status1($id,$status)
{
	$data = array(
		'status' => $status		
		);
	
		$where = "top_deals_id ='$id'";
	if ($this->db->update('top_deals', $data, $where)) {
		return true;
	} else {
		return false;
	}
   
}
function get_topdealbyid($id)
{
	$this->db->select('*');
    $this->db->from('top_deals');
    $this->db->where('top_deals_id',$id);				
	$query = $this->db->get();
		if ( $query->num_rows > 0 ){
		return $query->result();
	    }
		else
		{
			return '';
		}
}
function update_topdeal_do($data,$id)
{
	$this->db->WHERE('top_deals_id',$id);
	$this->db->update("top_deals",$data);	
	return true;
}
function delete_topdealbyid($id)
{
	$this->db->WHERE('top_deals_id',$id);
	$this->db->delete("top_deals");	
	return true;
}



	
	
}
?>