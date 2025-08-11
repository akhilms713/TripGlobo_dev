<?php
class Banner_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_banner_list($banner_id = ''){
		$this->db->select('*');
		$this->db->from('banner_details');
		if($banner_id !='')
			$this->db->where('banner_details_id', $banner_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function add_banner_details($input,$banner_logo_name){
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$insert_data = array(
							'title' 				=> $input['title'],
							'banner_type' 			=> $input['banner_type'],
							'banner_image' 			=> $banner_logo_name,
							'img_alt_text' 			=> $input['img_alt_text'],
							'link' 					=> $input['link'],
							'position' 				=> $input['position'],
							'status' 				=> $input['status'],
							'creation_date'	=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('banner_details',$insert_data);
		$banner_id = $this->db->insert_id();
		//$this->General_Model->insert_log('9','add_banner_details',json_encode($insert_data),'Adding  Banner to database','banner_details','banner_details_id',$banner_id);
	}

	function active_banner($banner_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('banner_details_id', $banner_id);
		$this->db->update('banner_details', $data); 
		//$this->General_Model->insert_log('9','active_banner',json_encode($data),'updating  Banner status to active','banner_details','banner_details_id',$banner_id);
	}
	
	function inactive_banner($banner_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('banner_details_id', $banner_id);
		$this->db->update('banner_details', $data); 
		//$this->General_Model->insert_log('9','inactive_banner',json_encode($data),'updating  Banner status to inactive','banner_details','banner_details_id',$banner_id);
	}
	
	function delete_banner($banner_id){
		$this->db->where('banner_details_id', $banner_id);
		$this->db->delete('banner_details'); 
		//$this->General_Model->insert_log('9','delete_banner',json_encode(array()),'deleting  Banner from database','banner_details','banner_details_id',$banner_id);
	}
	
	function update_banner($update,$banner_id, $banner_logo_name){
		if(!isset($update['status']))
			$update['status'] = "INACTIVE";
		$update_data = array(
							'title' 				=> $update['title'],
							'banner_type' 			=> $update['banner_type'],
							'banner_image' 			=> $banner_logo_name,
							'img_alt_text' 			=> $update['img_alt_text'],
							'link' 					=> $update['link'],
							'position' 				=> $update['position'],
							'status' 				=> $update['status']				
						);	
		$this->db->where('banner_details_id', $banner_id);
		$this->db->update('banner_details', $update_data);
		//$this->General_Model->insert_log('9','update_banner',json_encode($update_data),'updating  Banner  to database','banner_details','banner_details_id',$banner_id);
	}
	function get_home_management_list(){
		$this->db->select('*');
		$this->db->from('home_management');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	function update_home_mgmt_status($id,$status){
		$data = array(
					'status' => $status
					);
		$this->db->where('id', $id);
		$this->db->update('home_management', $data); 
	}
}
?>
