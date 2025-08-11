<?php
class Airline_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_airline_list($airline_details_id = ''){
		$this->db->select('*');
		$this->db->from('airline_details');
		if($airline_details_id !='')
			$this->db->where('airline_details_id', $airline_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	function get_airline_list_new($airline_details_id = ''){
		$this->db->select('*');
		$this->db->from('airline_list');
		if($airline_details_id !='')
			$this->db->where('airline_list_id', $airline_details_id);		
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function add_airline_details($input,$airline_logo_name){
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$insert_data = array(
							'airline_name_english' 			=> $input['airline_name'],
							'airline_name_arabic' 			=> $input['airline_name_ar'],
							'airline_code' 			=> $input['airline_code'],							
							'airline_logo_name' 			=> $airline_logo_name,							
							'status' 				=> $input['status'],
						);			
		$this->db->insert('airline_list',$insert_data);
	}

	function active_airline($airline_details_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('airline_list_id', $airline_details_id);
		$this->db->update('airline_list', $data); 
	}
	
	function inactive_airline($airline_details_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('airline_list_id', $airline_details_id);
		$this->db->update('airline_list', $data); 
	}
	
	function delete_airline($airline_details_id){
		$this->db->where('airline_list_id', $airline_details_id);
		$this->db->delete('airline_list'); 
	}
	
	function update_airline($update,$airline_details_id, $airline_logo_name){
		if(!isset($update['status']))
			$update['status'] = "INACTIVE";
		$update_data = array(
							'airline_name_english' 			=> $update['airline_name'],
							'airline_name_arabic' 			=> $update['airline_name_ar'],
							'airline_code' 			=> $update['airline_code'],							
							'airline_logo_name' 		=> $airline_logo_name,
							'status' 				=> $update['status']				
						);
		// echo '<pre/>';print_r($update_data);die;
		$this->db->where('airline_list_id', $airline_details_id);
		$this->db->update('airline_list', $update_data);
	}
	function check_airlinecode($air_code){
		// echo $air_code;
		$this->db->select('airline_list_id');
		$this->db->from('airline_list');		
		$this->db->where('airline_code', $air_code);
		$query=$this->db->get();
		// echo $this->db->last_query();exit;
		if($query->num_rows() ==''){
			$data['status'] = 0;
			$data['airline_list_id'] = '';
			return $data;
		}else{
			$data['status'] = 1;
			$data['airline_list_id'] = $query->row('airline_list_id');
			return $data;
		}
	}
}
?>
