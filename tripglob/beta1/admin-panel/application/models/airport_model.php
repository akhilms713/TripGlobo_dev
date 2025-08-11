<?php
class Airport_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_airport_detail_list(){
		$this->db->select('*');
		$this->db->from('airport_details');
		$this->db->join('iata_airport_list', 'iata_airport_list.airport_id = airport_details.airport_id');
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

	function get_airport_detail_single($airportId){
		// $this->db->select('*');
		// $this->db->where('id',$airportId);
		// $query = $this->db->get('airport_details')->row();

        $this->db->select('*');
        $this->db->from('airport_details');
        $this->db->join('iata_airport_list', 'iata_airport_list.airport_id = airport_details.airport_id');
        $this->db->where('id',$airportId);
        $query = $this->db->get()->row();


		return $query;
	}
	
    public function add_airport_detail($data)
    {
        $this->db->insert('airport_details',$data);
        return true;
    }
	
	public function update_airport_detail($id, $data)
    {
        $this->db->where('id',$id);
        $this->db->update('airport_details',$data);
        return true;
    }

    public function get_row_id_by_airport_code($airportCode)
    {
        $this->db->where('airport_code',$airportCode);
        $data = $this->db->get('iata_airport_list')->row();
        return $data->airport_id;
    }

    public function check_data_exist($airportId)
    {
        $this->db->where('airport_id',$airportId);
        $data = $this->db->get('airport_details')->num_rows();
       	if($data > 0){
       		return true;
       	}
    }
    
    public function delete_airport_detail($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('airport_details');
        return true;
    }
    
    function update_airport_page_status($id,$status)
    {
        $data = array(
            'airport_status' => $status       
            );
        
            $where = "id ='$id'";

        if ($this->db->update('airport_details', $data, $where)) {
            
            return true;
        } else {
            
            return false;
        }
       
    }
}
?>
