<?php
class Airline_page_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_airline_detail_list(){
		$this->db->select('*');
		$this->db->from('airline_pages');
		$this->db->join('airline_list', 'airline_list.airline_list_id = airline_pages.airline_id');
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

	function get_airline_detail_single($airlineId){
        $this->db->select('*');
        $this->db->from('airline_pages');
        $this->db->join('airline_list', 'airline_list.airline_list_id = airline_pages.airline_id');
        $this->db->where('id',$airlineId);
        $query = $this->db->get()->row();


		return $query;
	}
	
    public function add_airline_detail($data)
    {
        $this->db->insert('airline_pages',$data);
        return true;
    }
	
	public function update_airline_detail($id, $data)
    {
        $this->db->where('id',$id);
        $this->db->update('airline_pages',$data);
        return true;
    }

    public function delete_airline_detail($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('airline_pages');
        return true;
    }

    public function get_row_id_by_airline_code($airlineCode)
    {
        $this->db->where('airline_code',$airlineCode);
        $data = $this->db->get('airline_list')->row();
        return $data->airline_list_id;
    }

    public function check_data_exist($airportId)
    {
        $this->db->where('airline_id',$airportId);
        $data = $this->db->get('airline_pages')->num_rows();
       	if($data > 0){
       		return true;
       	}
    }

    function update_airline_page_status1($id,$status)
    {
        $data = array(
            'airline_status' => $status       
            );
        
            $where = "id ='$id'";

        if ($this->db->update('airline_pages', $data, $where)) {
            
            return true;
        } else {
            
            return false;
        }
       
    }
}
?>
