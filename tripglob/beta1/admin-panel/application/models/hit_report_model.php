<?php
class Hit_Report_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_report($type){
        $this->db->select('*, COUNT(cehck_both) as hit_count');
        $this->db->from('search_report');
        if($type == 'FLIGHT')
        {
            $this->db->where('trip_type !=','multicity');
        }
        $this->db->where('search_type',$type);
        $this->db->group_by('cehck_both');
        $query=$this->db->get();
        return $query;
	}

    function get_report_month($type,$both){
        $this->db->select("DATE_FORMAT(created_datetime, ('%m')) as m, COUNT(cehck_both) as hit_count");
        $this->db->from('search_report');
        $this->db->where('search_type',$type);
        $this->db->where('cehck_both',$both);
        $this->db->group_by("DATE_FORMAT(created_datetime, ('%Y-%m'))");
        $query=$this->db->get();
        $sql = $this->db->last_query();
        //echo $sql; exit;
        return $query;
    }
}
?>
