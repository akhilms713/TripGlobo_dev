<?php
class Sponsor_Ad_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_ad_list($ad_id = ''){
		$this->db->select('*');
		$this->db->from('sponsor_ad');
		if($ad_id !='')
			$this->db->where('id', $ad_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query;
		}
	}
	
    function add_ad($input,$ad_logo){
		$insert_data = array(
							'ad_type' 			=> $input['ad_type'],
							'ad_image' 			=> $ad_logo,
							'ad_content' 		=> $input['ad_content'],							
						);			
		$this->db->insert('sponsor_ad',$insert_data);
	}

	function update_ad($input,$ad_logo,$ad_id){

		if($ad_logo != ''){
			$insert_data = array(
								'ad_type' 			=> $input['ad_type'],
								'ad_image' 			=> $ad_logo,
								'ad_content' 		=> $input['ad_content'],							
							);
		} else {
			$insert_data = array(
								'ad_type' 			=> $input['ad_type'],
								'ad_content' 		=> $input['ad_content'],							
							);
		}	
		$this->db->where('id', $ad_id);
		$this->db->update('sponsor_ad', $insert_data);
	}
		
	function delete_ad($ad_id){
		$this->db->where('id', $ad_id);
		$this->db->delete('sponsor_ad'); 
	}

	function status_ad($id,$status)
    {
        $data = array(
            'ad_status' => $status       
            );
        
            $where = "id ='$id'";

        if ($this->db->update('sponsor_ad', $data, $where)) {
            
            return true;
        } else {
            
            return false;
        }
       
    }
	
}
?>
