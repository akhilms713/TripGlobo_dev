<?php
class Header_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_header_list($header_details_id = ''){
		$this->db->select('*');
		$this->db->from('header_details');
		if($header_details_id !='')
			$this->db->where('header_details_id', $header_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function add_header_details($input){
		if(!isset($input['menu_status']))
			$input['menu_status'] = "INACTIVE";
		$insert_data = array(
							'menu_name' 			=> $input['menu_name'],
							'menu_name_polish' 		=> base64_encode(json_encode($input['menu_name_polish'])),
							'menu_icon' 			=> $input['menu_icon'],
							'menu_type' 			=> $input['menu_type'],
							'menu_url' 				=> $input['menu_url'],
							'menu_level' 			=> $input['menu_level'],
							'position' 				=> $input['position'],
							'menu_status' 			=> $input['menu_status'],
							'menu_creation_date'		=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('header_details',$insert_data);
	}
   
	function active_header($header_id){
		$data = array(
					'menu_status' => 'ACTIVE'
					);
		$this->db->where('header_details_id', $header_id);
		$this->db->update('header_details', $data); 
	}
	
	function inactive_header($header_id){
		$data = array(
					'menu_status' => 'INACTIVE'
					);
		$this->db->where('header_details_id', $header_id);
		$this->db->update('header_details', $data); 
	}
	
	function delete_header($header_id){
		$this->db->where('header_details_id', $header_id);
		$this->db->delete('header_details'); 
	}
	
	function update_header_details($update,$api_id){
		if(!isset($update['menu_status']))
			$update['menu_status'] = "INACTIVE";
		$update_data = array(
							'menu_name' 			=> $update['menu_name'],
							'menu_name_polish' 		=> base64_encode(json_encode($update['menu_name_polish'])),
							'menu_icon' 			=> $update['menu_icon'],
							'menu_type' 			=> $update['menu_type'],
							'menu_url' 				=> $update['menu_url'],
							'menu_level' 			=> $update['menu_level'],
							'position' 				=> $update['position'],
							'menu_status' 			=> $update['menu_status']			
						);
		$this->db->where('header_details_id', $api_id);
		$this->db->update('header_details', $update_data);
	}
	
    function get_logo_list($logo_details_id = ''){
		$this->db->select('*');
		$this->db->from('logo_details');
		if($logo_details_id !='')
			$this->db->where('logo_details_id', $logo_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	function add_logo_details($input,$site_logo_name){
		if(!isset($input['logo_status']))
			$input['logo_status'] = "INACTIVE";
			
		$date_range[0] = $date_range[1] = '';
		if(isset($input['date_rane']) && $input['date_rane']!='')
			$date_range = explode("-",$input['date_rane']);
			
		$insert_data = array(
							'logo_name' 			=> $input['logo_name'],
							'logo_image' 			=> $site_logo_name,
							'logo_url' 				=> $input['logo_url'],
							'logo_start_date' 		=> $date_range[0],
							'logo_end_date' 		=> $date_range[1],
							'logo_status' 			=> $input['logo_status'],
							'logo_creation_date'	=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('logo_details',$insert_data);
	}

	function active_logo($logo_id){
		$data = array(
					'logo_status' => 'ACTIVE'
					);
		$this->db->where('logo_details_id', $logo_id);
		$this->db->update('logo_details', $data); 
	}
	
	function inactive_logo($logo_id){
		$data = array(
					'logo_status' => 'INACTIVE'
					);
		$this->db->where('logo_details_id', $logo_id);
		$this->db->update('logo_details', $data); 
	}

	function delete_logo($logo_id){
		$this->db->where('logo_details_id', $logo_id);
		$this->db->delete('logo_details'); 
	}

	function update_logo_details($update,$logo_id,$site_logo_name){
		if(!isset($update['logo_status']))
			$update['logo_status'] = "INACTIVE";
			
		$date_range[0] = $date_range[1] = '';
		if(isset($update['date_rane']) && $update['date_rane']!='')
			$date_range = explode("-",$update['date_rane']);
			
		$update_data = array(
							'logo_name' 			=> $update['logo_name'],
							'logo_image' 			=> $site_logo_name,
							'logo_url' 				=> $update['logo_url'],
							'logo_start_date' 		=> $date_range[0],
							'logo_end_date' 		=> $date_range[1],
							'logo_status' 			=> $update['logo_status']				
						);	
		$this->db->where('logo_details_id', $logo_id);
		$this->db->update('logo_details', $update_data);
	}

	function get_header_menu_list($header_details_id, $menu_level_details_id = ''){
		$this->db->select('m.*,h.menu_name');
		$this->db->from('menu_level_details m');
		if($menu_level_details_id !='')
			$this->db->where('m.menu_level_details_id', $menu_level_details_id);
		$this->db->where('m.header_details_id', $header_details_id);
		$this->db->join('header_details h', 'h.header_details_id = m.header_details_id');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

	function add_header_menu_details($input){
		if(!isset($input['menu_status']))
			$input['menu_status'] = "INACTIVE";
		$insert_data = array(
							'header_details_id' 	=> $input['header_id'],
							'menu_level' 			=> $input['menu_level'],
							'title' 				=> $input['sub_menu_title'],
							'display_name' 			=> $input['sub_menu_name'],
							'position' 				=> $input['position'],
							'link_type' 			=> $input['menu_type'],
							'link' 					=> $input['menu_url'],
							'status' 				=> $input['menu_status']
						);			
		$this->db->insert('menu_level_details',$insert_data);
	}

	function active_header_menu($header_menu_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('menu_level_details_id', $header_menu_id);
		$this->db->update('menu_level_details', $data); 
	}
	
	function inactive_header_menu($header_menu_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('menu_level_details_id', $header_menu_id);
		$this->db->update('menu_level_details', $data); 
	}
	
	function delete_header_menu($header_menu_id){
		$this->db->where('menu_level_details_id', $header_menu_id);
		$this->db->delete('menu_level_details'); 
	}

	function update_header_menu_details($input,$header_menu_id){
		if(!isset($input['menu_status']))
			$input['menu_status'] = "INACTIVE";
		$update_data = array(
							'header_details_id' 	=> $input['header_id'],
							'menu_level' 			=> $input['menu_level'],
							'title' 				=> $input['sub_menu_title'],
							'display_name' 			=> $input['sub_menu_name'],
							'position' 				=> $input['position'],
							'link_type' 			=> $input['menu_type'],
							'link' 					=> $input['menu_url'],
							'status' 				=> $input['menu_status']
						);
		$this->db->where('menu_level_details_id', $header_menu_id);
		$this->db->update('menu_level_details', $update_data);
	}
	
	function get_search_header_list($search_header_details_id = ''){
		$this->db->select('*');
		$this->db->from('search_module_details');
		if($search_header_details_id !='')
			$this->db->where('search_module_details_id', $search_header_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	function add_search_header_details($input){
		if(!isset($input['menu_status']))
			$input['menu_status'] = "INACTIVE";
		$insert_data = array(
							'search_module_name' 		=> $input['menu_name'],
							'search_module_icon' 		=> $input['menu_icon'],
							'link_type' 				=> $input['menu_type'],
							'search_url' 				=> $input['menu_url'],
							'position' 					=> $input['position'],
							'search_module_status' 		=> $input['menu_status'],
							'menu_creation_date'		=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('search_module_details',$insert_data);
	}
	
	function inactive_search_header($search_header_id){
		$data = array(
					'search_module_status' => 'INACTIVE'
					);
		$this->db->where('search_module_details_id', $search_header_id);
		$this->db->update('search_module_details', $data);
	}
	
	function active_search_header($search_header_id){
		$data = array(
					'search_module_status' => 'ACTIVE'
					);
		$this->db->where('search_module_details_id', $search_header_id);
		$this->db->update('search_module_details', $data);
	}
	
	function update_search_header_details($update, $search_header_id){
		if(!isset($update['menu_status']))
			$update['menu_status'] = "INACTIVE";
		$update_data = array(
							'search_module_name' 			=> $update['menu_name'],
							'search_module_icon' 			=> $update['menu_icon'],
							'link_type' 					=> $update['menu_type'],
							'search_url' 					=> $update['menu_url'],
							'position' 						=> $update['position'],
							'search_module_status' 			=> $update['menu_status']			
						);
		$this->db->where('search_module_details_id', $search_header_id);
		$this->db->update('search_module_details', $update_data);
	}
	
	function delete_search_header($search_header_id){
		$this->db->where('search_module_details_id', $search_header_id);
		$this->db->delete('search_module_details');
	}
	
}
?>
