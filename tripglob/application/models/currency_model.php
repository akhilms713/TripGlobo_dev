<?php
class Currency_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_currency_list()
   	{
   
		$this->db->select('*')
		->from('currency_list');
		
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
   public function get_currency_list_update()
   {	
   return $this->db->get('currency_list')->result_array();
		
   }
   public function get_currency_list_update_auto(){
   	
   	$data=array(
            'updated_at'=>2
            );
      return $this->db->update('currency_list',$data);       
   }
   function getCurrencyData($id)
	{
		
		$this->db->select('*')
		->from('currency_list')
		->where('currency_list_id',$id);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}
	}
	function deleteCurrencyData($id){
		
		
		$where = "currency_list_id = $id";
		if ($this->db->delete('currency_list', $where)) {
			return true;
		} else {
			return false;
		}
	}
	function add_currency($currency,$value,$code,$name)
   {
	   	$data = array(
		'currency_code' => $currency,
		'value' => $value,
		'currency_symbol'=>$code,
		'currency_name'=>$name
		
		);
			
		$this->db->set('date_time', 'NOW()', FALSE); 
		
		$this->db->insert('currency_list', $data);
		$id = $this->db->insert_id();
		if (!empty($id)) {				
			return true;
		} else {
			return false;
		}
   }

}