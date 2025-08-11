<?php
class Product_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_product_list($product_id = ''){
		$this->db->select('product_details_id,product_name, product_status');
		$this->db->from('product_details');
		if($product_id !='')
			$this->db->where('product_details_id', $product_id);

		$this->db->where('product_status', 'ACTIVE');

		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
    function get_product_list_markup($product_id = ''){
    	$this->db->select('product_details_id,product_name, product_status');
		$this->db->from('product_details');
		if($product_id !='')
			$this->db->where('product_details_id', $product_id);

		$this->db->where('product_status', 'ACTIVE');
		$this->db->where('markup_status', 1);

		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
    }
	function add_product($input){	
		if(!isset($input['product_status']))
			$input['product_status'] = "INACTIVE";
		$insert_data = array(
							'product_name' 			=> $input['product_name'],							
							'product_status' 		=> $input['product_status'],
							'product_creation_date'	=> (date('Y-m-d H:i:s'))					
						);
			
		$this->db->insert('product_details',$insert_data);
	}
	
	function active_product($product_id){
		$data = array(
					'product_status' => 'ACTIVE'
					);
		$this->db->where('product_details_id', $product_id);
		$this->db->update('product_details', $data); 
	}
	
	function inactive_product($product_id){
		$data = array(
					'product_status' => 'INACTIVE'
					);
		$this->db->where('product_details_id', $product_id);
		$this->db->update('product_details', $data); 
	}
	
	function delete_product($product_id){
		$this->db->where('product_details_id', $product_id);
		$this->db->delete('product_details'); 
	}
	
	function update_product($update,$product_id){
		if(!isset($update['product_status']))
			$update['product_status'] = "INACTIVE";
		$update_data = array(
							'product_name' 			=> $update['product_name'],
							'product_name_polish' 			=> $update['product_name_polish'],
							'product_status' 		=> $update['product_status']				
						);
		$this->db->where('product_details_id', $product_id);
		$this->db->update('product_details', $update_data);
	}


	
}
?>
