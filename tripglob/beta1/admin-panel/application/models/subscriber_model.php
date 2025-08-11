<?php
class Subscriber_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}


function get_allsubscriber()
{
	 
	$this->db->select('*');
    $this->db->from('subscriber');				
	$query = $this->db->get();
		if ( $query->num_rows > 0 ){
		return $query->result();
	    }
		else
		{
			return '';
		}	
	
}
function get_allsubscriber_active()
{
	 
	$this->db->select('*');
    $this->db->from('subscriber');				
    $this->db->where('subscriber_status','ACTIVE');				
	$query = $this->db->get();
		if ( $query->num_rows > 0 ){
		return $query->result();
	    }
		else
		{
			return '';
		}	
	
}
function subscriber_status1($id,$status)
{
	$data = array(
		'subscriber_status' => $status		
		);
	
		$where = "subscriber_id ='$id'";
	if ($this->db->update('subscriber', $data, $where)) {
		return true;
	} else {
		return false;
	}
   
}
function get_subscriberbyid($id)
{
	$this->db->select('*');
    $this->db->from('subscriber');
    $this->db->where('subscriber_id',$id);				
	$query = $this->db->get();
		if ( $query->num_rows > 0 ){
		return $query->result();
	    }
		else
		{
			return '';
		}
}



	
	
}
?>