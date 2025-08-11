<?php
class Airport_Manag_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_airport_list($limit='',$start = ''){

		$this->db->select('*');
		$this->db->from('iata_airport_list');
		$this->db->limit($limit, $start);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	function get_airport_list_row(){
		$this->db->select('*');
		$this->db->from('iata_airport_list');
		$query=$this->db->get();
		return $query->num_rows();
	}

	function get_airport_single($airportId){

		$this->db->select('*');
		$this->db->from('iata_airport_list');
		$this->db->where('airport_id',$airportId);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}

	function get_airport_lis_newt($airport_details_id = ''){
		$this->db->select('*');
		$this->db->from('iata_airport_list');
		if($airport_details_id !='')
			$this->db->where('airport_id', $airport_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

	function get_airport_list_edit($airport_details_id = ''){
    	
		$this->db->select('*');
		$this->db->from('iata_airport_list');
		if($airport_details_id !=''){
			$this->db->where('origin', $airport_details_id);
		}
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

    function get_country_list(){
		$this->db->select('*');
		$this->db->from('iata_airport_list');
		$this->db->distinct('country');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function add_airport_details($input){
    	// echo "<pre/>";print_r($input);exit;
    	$countryCode = $this->get_country_single($input['country']);
    	$cityCode = $this->get_city_single($input['airport_city']);
		$insert_data = array(
							'airport_code' 			=> $input['airport_code'],
							'airport_name' 			=> $input['airport_name'],
							'country_code' 			=> $countryCode->country_code,
							'city_code	' 			=> $cityCode->city_code,
							'airport_city' 			=> $input['airport_city'],
							'country' 				=> $input['country'],
							'continent' 			=> $input['country'],
						);			
		$this->db->insert('iata_airport_list',$insert_data);
	}

	
	function delete_airport($airport_details_id){
		$this->db->where('airport_id', $airport_details_id);
		$this->db->delete('iata_airport_list'); 
	}
	
	function update_airport($update,$airport_details_id){
		$countryCode = $this->get_country_single($update['country']);
    	$cityCode = $this->get_city_single($update['airport_city']);
		$update_data = array(
							'airport_code' 			=> $update['airport_code'],
							'airport_name' 			=> $update['airport_name'],
							'country_code' 			=> $countryCode->country_code,
							'city_code	' 			=> $cityCode->city_code,
							'airport_city' 			=> $update['airport_city'],
							'country' 				=> $update['country'],
							'continent' 			=> $update['country'],			
						);
		// echo "<pre/>";print_r($update_data);exit;
		$this->db->where('airport_id', $airport_details_id);
		$this->db->update('iata_airport_list', $update_data);
	}
	function check_airportcode($air_code){
		$this->db->select('airport_id');
		$this->db->from('iata_airport_list');		
		$this->db->where('airport_code', $air_code);
		$query=$this->db->get();
		// echo $this->db->last_query();exit;
		if($query->num_rows() ==''){
			$data['status'] = 0;
			$data['airport_id'] = '';
			return $data;
		}else{
			$data['status'] = 1;
			$data['airport_id'] = $query->row('airport_id');
			return $data;
		}
	}

	function get_country_select(){
		$this->db->select('*');
		$this->db->from('country_list');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

	function get_country_single($countryN){
		$this->db->select('*');
		$this->db->from('country_list');
		$this->db->where('country_name',$countryN);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}

	function get_city_select($country){
		$this->db->select('*');
		$this->db->from('city_code_amadeus');
		$this->db->where('country',$country);
		$query=$this->db->get();
		if($query->num_rows() == ''){
			return '';
		}else{
			return $query->result();
		}
	}

	function get_city_single($cityN){
		$this->db->select('*');
		$this->db->from('city_code_amadeus');
		$this->db->where('city',$cityN);
		$query=$this->db->get();
		if($query->num_rows() == ''){
			return '';
		}else{
			return $query->row();
		}
	}

	function update_airport_status1($id,$status)
    {
        $data = array(
            'airport_status' => $status       
            );
        
            $where = "airport_id ='$id'";

        if ($this->db->update('iata_airport_list', $data, $where)) {
            
            return true;
        } else {
            
            return false;
        }
       
    }


    // ################## TEST 
    function get_airport_list_test(){

		$this->db->select('*');
		$this->db->from('iata_airport_list');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query;
		}
	}
}
?>
