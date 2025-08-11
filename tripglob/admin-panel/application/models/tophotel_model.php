<?php
class Tophotel_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

function add_new_tophotel($data)
{
	$this->db->insert('last_minute_deals', $data);
	$address_details_id = $this->db->insert_id();
}
function get_alltophotels(){
	$this->db->select('*');
    $this->db->from('last_minute_deals');
    //$this->db->where('status',1);				
	$query = $this->db->get();
		if ( $query->num_rows > 0 ){
		return $query->result();
	    }
		else
		{
			return '';
		}
}

function update_tophotel_status1($id,$status)
{
	$data = array(
		'status' =>$status		
		);
	
		$where = "last_minute_deals_id ='$id'";
	if ($this->db->update('last_minute_deals', $data, $where)) {
		return true;
	} else {
		return false;
	}
   
}
function get_tophotelbyid($id)
{
	$this->db->select('*');
    $this->db->from('last_minute_deals');
    $this->db->where('last_minute_deals_id',$id);				
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
	$this->db->WHERE('last_minute_deals_id',$id);
	$this->db->update("last_minute_deals",$data);		
	
	return true;
	
}
function delete_tophotelbyid($id)
{	
	$this->db->WHERE('last_minute_deals_id',$id);
	$this->db->delete("last_minute_deals");
	return true;

}

// Best Hotel Start


	function add_new_besthotel($data)
{		
	$this->db->insert('last_besthotel_deals', $data);
	$address_details_id = $this->db->insert_id();
}
function get_allbesthotels(){
	$this->db->select('*');
    $this->db->from('last_besthotel_deals');	
    //$this->db->where('status',2);			
	$query = $this->db->get();
		if ( $query->num_rows > 0 ){
		return $query->result();
	    }
		else
		{
			return '';
		}
}

function update_besthotel_status1($id,$status)
{
	$data = array(
		'status' =>$status		
		);
	
		$where = "last_minute_deals_id ='$id'";
	if ($this->db->update('last_besthotel_deals', $data, $where)) {
		return true;
	} else {
		return false;
	}
   
}
function get_besthotelbyid($id)
{
	$this->db->select('*');
    $this->db->from('last_besthotel_deals');
    $this->db->where('last_minute_deals_id',$id);				
	$query = $this->db->get();
		if ( $query->num_rows > 0 ){
		return $query->result();
	    }
		else
		{
			return '';
		}
}

function update_bestdeal_do($data,$id)
{
	$this->db->WHERE('last_minute_deals_id',$id);
	$this->db->update("last_besthotel_deals",$data);		
	
	return true;
	
}
function delete_besthotelbyid($id)
{	
	$this->db->WHERE('last_minute_deals_id',$id);
	$this->db->delete("last_besthotel_deals");
	return true;

}

	
}
?>