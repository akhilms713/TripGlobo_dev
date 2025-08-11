<?php
class Hotel_page_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_hotel_detail_list(){
		$this->db->select('*');
		$this->db->from('hotel_page');
		$this->db->join('crs_cities', 'crs_cities.city_id = hotel_page.crs_city_id');
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

	function get_hotel_detail_single($hotelPageId){
        $this->db->select('*');
        $this->db->from('hotel_page');
        $this->db->join('crs_cities', 'crs_cities.city_id = hotel_page.crs_city_id');
        $this->db->where('id',$hotelPageId);
        $query = $this->db->get()->row();


		return $query;
	}
	
    public function add_hotel_detail($data)
    {
        $this->db->insert('hotel_page',$data);
        return true;
    }
	
	public function update_hotel_detail($id, $data)
    {
        $this->db->where('id',$id);
        $this->db->update('hotel_page',$data);
        return true;
    }

    public function delete_hotel_detail($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('hotel_page');
        return true;
    }

    public function get_row_id_by_hotel_code($city_id)
    {
        $this->db->where('city_name',$city_id);
        $data = $this->db->get('crs_cities')->row();
        return $data->city_id;
    }

    public function check_data_exist($city_id)
    {
        $this->db->where('crs_city_id',$city_id);
        $data = $this->db->get('hotel_page')->num_rows();
       	if($data > 0){
       		return true;
       	}
    }

    function update_hotel_page_status1($id,$status)
    {
        $data = array(
            'page_status' => $status       
            );
        
            $where = "id ='$id'";

        if ($this->db->update('hotel_page', $data, $where)) {
            
            return true;
        } else {
            
            return false;
        }
       
    }
}
?>
