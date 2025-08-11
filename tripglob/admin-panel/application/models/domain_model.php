<?php
class Domain_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    } 
	
	function get_domain_list($domain_id = ''){
		$this->db->select('domain_details_id,domain_name,domain_url,domain_logo,domain_status');
		$this->db->from('domain_details');
		if($domain_id !='')
			$this->db->where('domain_details_id', $domain_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	function add_domain($input,$domain_logo_name){
		// echo "<pre>";print_r($input);die;
		if(!isset($input['domain_status']))
			$input['domain_status'] = "INACTIVE";
		$insert_data = array(
							'domain_name' 			=> $input['domain_name'],
							'domain_url' 			=> $input['domain_url'],
							'domain_logo' 			=> $domain_logo_name,
							'domain_status' 		=> $input['domain_status'],
							'creation_date'			=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('domain_details',$insert_data);
	}
	
	function active_domain($domain_id){
		$data = array(
					'domain_status' => 'ACTIVE'
					);
		$this->db->where('domain_details_id', $domain_id);
		$this->db->update('domain_details', $data); 
	}
	
	function inactive_domain($domain_id){
		$data = array(
					'domain_status' => 'INACTIVE'
					);
		$this->db->where('domain_details_id', $domain_id);
		$this->db->update('domain_details', $data); 
	}
	
	function delete_domain($domain_id){
		$this->db->where('domain_details_id', $domain_id);
		$this->db->delete('domain_details'); 
	}
	
	function update_domain($update,$domain_id, $domain_logo_name){
		if(!isset($update['domain_status']))
			$update['domain_status'] = "INACTIVE";
		$update_data = array(
							'domain_name' 			=> $update['domain_name'],
							'domain_url' 			=> $update['domain_url'],
							'domain_logo' 			=> $domain_logo_name,
							'domain_status' 		=> $update['domain_status']				
						);
		$this->db->where('domain_details_id', $domain_id);
		$this->db->update('domain_details', $update_data);
	}	
}
?>
