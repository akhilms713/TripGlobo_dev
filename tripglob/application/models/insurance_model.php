<?php

class Insurance_model extends CI_Model { 

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }


public function get_search_data_insurance($search_id){

	// debug($search_id); die;
   		$this->db->select('*');
        $this->db->from('search_history');
        $this->db->where('origin', $search_id);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result_array();
        }

/*	$this->select('*');
	$this->from('search_history');
	$this->where('origin',$search_id);
	$query= $this->db->get();
     if ($query->num_rows() == '') {
            return '';
        } else {
	return $query->result_array();
}*/

}
public function get_search_resp($search_id){
    $this->db->select('*'); 
        $this->db->where("search_id",$search_id);
        $this->db->from("transfer_search_logs");
      //  $this->db->limit(2);
        $this->db->distinct();
        $query=$this->db->get();

        return $query->result_array();

 }

   
    public function insert_transfer_search_logs($data)
    { 

        // debug($data); die;
        $this->db->insert('transfer_search_logs', $data);
        // return $this->db->insert_id();
        return true;
    }

public function get_country(){
    $this->db->select('*');  
        $this->db->from("iso_country"); 
        $query=$this->db->get();

        return $query->result_array();

 }

  public function insert_booking_detail_request($transaction_id,$search_id, $rqust){

 $data['search_id'] = $search_id;
 $data['transaction_id'] = $transaction_id;  
 $data['book_req'] = $rqust; 
 $res = $this->db->insert('booking_passenger',$data); 
 return true; 

 }

}

?>
