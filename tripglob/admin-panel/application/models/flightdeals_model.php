<?php
class Flightdeals_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}


function add_new_flight_deals_do($data)
{
	$this->db->insert('flight_deals', $data);
	return true;
}
	
function get_allflightdeals()
{
	$this->db->select('*');
    $this->db->from('flight_deals');				
	$query = $this->db->get();
		if ( $query->num_rows > 0 ){
		return $query->result();
	    }
		else
		{
			return '';
		}	
}	

function update_flightdeal_status1($id,$status)
{
	$data = array(
		'deal_status' => $status		
		);
	
		$where = "flight_deal_id ='$id'";
	if ($this->db->update('flight_deals', $data, $where)) {
		return true;
	} else {
		return false;
	}
   
}
function get_flightdealbyid($id)
{
	$this->db->select('*');
    $this->db->from('flight_deals');
    $this->db->where('flight_deal_id',$id);				
	$query = $this->db->get();
		if ( $query->num_rows > 0 ){
		return $query->result();
	    }
		else
		{
			return '';
		}
}
function update_flight_deals_do($data,$id)
{
	$this->db->WHERE('flight_deal_id',$id);
	$this->db->update("flight_deals",$data);		
	return true;
}
function delete_tophotelbyid($id)
{	
	$this->db->WHERE('flight_deal_id',$id);
	$this->db->delete("flight_deals");
	return true;

}




	
}
?>