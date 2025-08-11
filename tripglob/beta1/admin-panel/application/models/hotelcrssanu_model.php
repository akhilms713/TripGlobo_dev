<?php
class Hotelcrssanu_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

	public function get_hotel_details($hotel_code = ""){
		if ($hotel_code != "") {
			$this->db->select('hotel_list.*,admin_details.admin_account_number as supplier_code,admin_details.admin_name as supplier_name, country_list.country_name,hotel_type.*')
			->from('hotel_list')
			->where('hotel_list.hotel_code', $hotel_code)
			->join('admin_details', 'admin_details.admin_id = hotel_list.supplier_id', 'left')
			->join('country_list', 'country_list.country_list = hotel_list.country_id', 'left')
			->join('hotel_type', 'hotel_type.hotel_type_id = hotel_list.hotel_type', 'left');
			$query = $this->db->get();
			if ( $query->num_rows > 0 ) 
			{
				return $query->result();	
			}
			else
			{
				return '';	
			}
		}
		else{
			$this->db->select('hotel_list.*,admin_details.admin_account_number as supplier_code, admin_details.admin_name as supplier_name, country_list.country_name,hotel_type.*')
			->from('hotel_list')
			->join('admin_details', 'admin_details.admin_id = hotel_list.supplier_id', 'left')
			->join('country_list', 'country_list.country_list = hotel_list.country_id', 'left')
			->join('hotel_type', 'hotel_type.hotel_type_id = hotel_list.hotel_type', 'left');
			$query = $this->db->get();
			if ( $query->num_rows > 0 ) 
			{
				return $query->result();	
			}
			else
			{
				return '';	
			}
		}
		
	}

	public function get_hotel_rooms_hotel_code($hotel_code){
		$this->db->select('hotel_room.*,room_type.*')
		->from('hotel_room')
		->where('hotel_room.hotel_code', $hotel_code)
		->join('room_type', 'room_type.room_type_id = hotel_room.room_type_id', 'left');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) 
		{
			return $query->result();	
		}
		else
		{
			return '';	
		}
	}

	function hotel_crs_rate_manager($hotel_code)
	{
		//$agent_number = AGENT_NUMBER;
		$this->db->select('*')
		->from('hotel_crs_rate_manager')
		->where('hotel_crs_rate_manager.hotel_code', $hotel_code);
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) 
		{
			return $query->result();	
		}
		else
		{
			return '';	
		}


// 		$select = "SELECT *,date as date_v1  FROM hotel_crs_rate_manager  where hotel_code='$id' ";
// 		// $select = "SELECT *,date as date_v1  FROM hotel_crs_rate_manager  where hotel_code='$id' and hotel_agent_number='$agent_number' ";
// //			$select = "SELECT *  FROM hotel_room join room_type ON room_type.room_type_code=hotel_room.room_type  where hotel_room.hotel_code='$id' ";
		
// 		$query=$crs_db->query($select);
// 		$this->load->database('default', TRUE); 
// 		if ($query->num_rows() > 0)
// 		{
// 			return $query->result();
// 		} else {
// 			return false;	
// 		}

	}

	
}
?>