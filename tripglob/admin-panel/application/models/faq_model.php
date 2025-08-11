<?php
class faq_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_row_list(){
		$this->db->select('*');
		$this->db->from('faq');
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

	function get_row_single($id){
        $this->db->select('*');
        $this->db->from('faq');
        $this->db->where('id',$id);
        $query = $this->db->get()->row();


		return $query;
	}
	
    public function add_row($data)
    {
        $this->db->insert('faq',$data);
        return true;
    }
	
	public function update_row($id, $data)
    {
        $this->db->where('id',$id);
        $this->db->update('faq',$data);
        return true;
    }

    public function delete_row($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('faq');
        return true;
    }

    function do_change_status($id,$status)
    {
        $data = array(
            'status' => $status       
            );
        
            $where = "id ='$id'";

        if ($this->db->update('faq', $data, $where)) {
           // exit("ttt");
            return true;
        } else {
            
            return false;
        }
       
    }
}

?>
