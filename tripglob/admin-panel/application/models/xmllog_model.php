<?php
class Xmllog_Model extends CI_Model {
	
	// public function __construct(){
	//     parent::__construct();
 //    }
	// public function get_xmllogs(){
 //   		return $this->db->get('xml_logs');
	// }
	public function __construct(){
		parent::__construct();
	}
	public function get_xmllogs()
	{
		
		$this->db->select('*')->from('xml_logs')->join('api_details','api_details.api_name = xml_logs.api_name');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) 
		{
			return $query->result();	
		}
		else
		{
			return '';	
		}
	}
	public function getOneXmlLogs($id){
		$this->db->select('*');
		$this->db->from('XML_logs');
		$this->db->where('xml_logs_id',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return array();
		}
	}
	public function get_bookingxmllogs()
	{
		
		$this->db->select('*')->from('booking_global')->join('booking_supplier','booking_supplier.booking_supplier_id = booking_global.booking_supplier_id')->join('api_details','api_details.api_details_id = booking_global.api_id')->join('booking_xml_data','booking_xml_data.booking_xml_data_id = booking_supplier.booking_xml_data_id');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) 
		{
			return $query->result();	
		}
		else
		{
			return '';	
		}
	}

}
?>
