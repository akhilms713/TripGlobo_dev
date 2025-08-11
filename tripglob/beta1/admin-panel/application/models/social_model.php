<?php
class Social_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}


function add_new_sociallink_do($data)
{
	$this->db->insert('social_link_details', $data);
	return true;
}

function all_social_link()
{
	$this->db->select('*');
    $this->db->from('social_link_details');				
	$query = $this->db->get();
		if ( $query->num_rows > 0 ){
		return $query->result();
	    }
		else
		{
			return '';
		}	
	
}
function update_social_status1($id,$status)
{
	$data = array(
		'status' => $status		
		);
	
		$where = "social_link_details_id ='$id'";
	if ($this->db->update('social_link_details', $data, $where)) {
		return true;
	} else {
		return false;
	}
   
}
function get_social_linkbyid($id)
{
	$this->db->select('*');
    $this->db->from('social_link_details');
    $this->db->where('social_link_details_id',$id);				
	$query = $this->db->get();
		if ( $query->num_rows > 0 ){
		return $query->result();
	    }
		else
		{
			return '';
		}
}
function update_social_link_do($data,$id)
{
	$this->db->WHERE('social_link_details_id',$id);
	$this->db->update("social_link_details",$data);	
	return true;
}
function delete_social_linkbyid($id)
{
	$this->db->WHERE('social_link_details_id',$id);
	$this->db->delete("social_link_details");	
	return true;
}



	
	
}
?>