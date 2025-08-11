<?php
class Api_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	public function get_api_lists_mar(){
    	$this->db->select('*');
		$this->db->from('api_details');
		$this->db->where('api_status', 'ACTIVE');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
    }
    public function get_api_lists_markup(){
    	$this->db->select('*');
		$this->db->from('api_details');
		$this->db->where('api_status', 'ACTIVE');
		$this->db->where('markup_status', 1);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
    }
    
    
    public function get_api_name($id){
    	$this->db->select('*');
		$this->db->from('api_details');
		$this->db->where('api_details_id', $id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
    }
	public function get_api_details()
	{
		$this->db->select('*')->from('api_details');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) 
		{
			// foreach ($query->result() as $value) {
			// 	$value->api_password = $this->CI_decrypt($value->api_password);
			// }
			
			return $query->result();	
		}
		else
		{
			return '';	
		}
	}
	 public function update_api_status($id,  $status)
   	{
		$data = array(
			'api_status' => mysql_real_escape_string($status)
			
			);
		
			$where = "api_details_id = '$id'";
		if ($this->db->update('api_details', $data, $where)) {
			return true;
		} else {
			return false;
		}
   }
    public function update_api_details($data,$api_details_id)
   	{
		
		//$data['api_password'] = $this->CI_encript($data['api_password']);
			$where = "api_details_id = '$api_details_id'";
		if ($this->db->update('api_details', $data, $where)) {
			return true;
		} else {
			return false;
		}
   }
   function get_api_list_id($id)
	{
		
		$this->db->select('*')
		->from('api_details')
		->where('api_details_id',$id)
		;
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      			//$query->row()->api_password = $this->CI_decrypt($query->row()->api_password);
         return $query->row();
      }
      return false;
	}
	public function getApiHits(){
		return $result = $this->db->query('SELECT COUNT( * ) AS first_success, 
			(

SELECT COUNT( * ) 
FROM xml_logs
WHERE MONTH(xml_timestamp) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND xml_status = "FAILURE"
) AS first_failure ,(

SELECT COUNT( * ) 
FROM xml_logs
WHERE MONTH(xml_timestamp) = MONTH(CURRENT_DATE - INTERVAL 2 MONTH) AND xml_status = "SUCCESS"
) AS second_success ,(

SELECT COUNT( * ) 
FROM xml_logs
WHERE MONTH(xml_timestamp) = MONTH(CURRENT_DATE - INTERVAL 2 MONTH) AND xml_status = "FAILURE"
) AS second_failure ,
(

SELECT COUNT( * ) 
FROM xml_logs
WHERE MONTH(xml_timestamp) = MONTH(CURRENT_DATE - INTERVAL 3 MONTH) AND xml_status = "SUCCESS"
) AS third_success,
		(

SELECT COUNT( * ) 
FROM xml_logs
WHERE MONTH(xml_timestamp) = MONTH(CURRENT_DATE - INTERVAL 3 MONTH) AND xml_status = "FAILURE"
) AS third_failure,
		(

SELECT COUNT( * ) 
FROM xml_logs
WHERE MONTH(xml_timestamp) = MONTH(CURRENT_DATE - INTERVAL 4 MONTH) AND xml_status = "SUCCESS"
) AS fourth_success ,
		(

SELECT COUNT( * ) 
FROM xml_logs
WHERE MONTH(xml_timestamp) = MONTH(CURRENT_DATE - INTERVAL 4 MONTH) AND xml_status = "FAILURE"
) AS fourth_failure ,
		(

SELECT COUNT( * ) 
FROM xml_logs
WHERE MONTH(xml_timestamp) = MONTH(CURRENT_DATE - INTERVAL 5 MONTH) AND xml_status = "SUCCESS"
) AS fifth_success ,
(

SELECT COUNT( * ) 
FROM xml_logs
WHERE MONTH(xml_timestamp) = MONTH(CURRENT_DATE - INTERVAL 5 MONTH) AND xml_status = "FAILURE"
) AS fifth_failure ,
		(
SELECT COUNT( * ) 
FROM xml_logs
WHERE MONTH(xml_timestamp) = MONTH(CURRENT_DATE - INTERVAL 6 MONTH)  AND xml_status = "SUCCESS"
) AS sixth_success ,
(
SELECT COUNT( * ) 
FROM xml_logs
WHERE MONTH(xml_timestamp) = MONTH(CURRENT_DATE - INTERVAL 6 MONTH)  AND xml_status = "FAILURE"
) AS sixth_failure 
FROM xml_logs
WHERE MONTH(xml_timestamp) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND xml_status = "SUCCESS"')->row();

	}
	public function pie_chart(){
		return $result = $this->db->query('SELECT COUNT( * ) AS FAILURE ,
			(SELECT COUNT(*) AS SUCCESS FROM xml_logs WHERE xml_status = "SUCCESS")
			AS SUCCESS,
			(SELECT COUNT(*) AS SUCCESS FROM xml_logs WHERE xml_logs_id != "")
			AS TOTAL
			FROM xml_logs WHERE xml_status = "FAILURE" ')->row();
	}
	public function api_hits(){
		return $this->db->query('SELECT a.api_details_id,a.api_name,COUNT(xl.api_name) as TOTAL_API_HITS FROM xml_logs xl
									LEFT JOIN `api_details` a ON(a.api_name = xl.api_details_id) GROUP BY xl.api_name')->result();
	}
	public function api_name_details($api){
		return $this->db->query('SELECT COUNT(xl.ip_address) as TOTAL_HITS, xl.ip_address,a.api_name FROM `xml_logs` xl
									LEFT JOIN `api` a ON(a.api_details_id = xl.api_details_id)
		 WHERE xl.api_details_id = '.$api.' GROUP BY xl.ip_address')->result();
	}
	public function ip_details($id,$ip){
		return $this->db->select('*')->from('xml_logs xl')->join('api a','a.api_details_id = xl.api_details_id')->where(array('xl.api_details_id' => $id, 'xl.ip_address' => $ip))->get()->result();
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
	public function bar_chart(){
		return $this->db->query('SELECT COUNT(api_details_id) AS `HITS`,
       	DATE(xml_timestamp) AS `Date`
		FROM xml_logs
		WHERE DATE(xml_timestamp) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
		GROUP BY DATE(xml_timestamp) ORDER BY DATE(xml_timestamp) DESC ')->result();
	}
	public function hits_count(){
		return $this->db->query('SELECT COUNT(api_details_id) as TOTAL_HITS, (SELECT COUNT(api_details_id) FROM xml_logs WHERE xml_status = "SUCCESS" AND `xml_timestamp` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)) as SUCCESS_HITS,(SELECT COUNT(api_details_id) FROM xml_logs WHERE xml_status = "FAILURE" AND `xml_timestamp` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)) as FAILURE_HITS FROM xml_logs WHERE `xml_timestamp` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ')->row();
	}
	public function bar_chart_success(){
		return $this->db->query('SELECT COUNT(api_details_id) AS `HITS`,
       	DATE(xml_timestamp) AS `Date`
		FROM xml_logs
		WHERE xml_status = "SUCCESS" AND DATE(xml_timestamp) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
		GROUP BY DATE(xml_timestamp) ORDER BY DATE(xml_timestamp) DESC ')->result();
	}
	public function bar_chart_failure(){
		return $this->db->query('SELECT COUNT(api_details_id) AS `HITS`,
       	DATE(xml_timestamp) AS `Date`
		FROM xml_logs
		WHERE xml_status = "FAILURE" AND DATE(xml_timestamp) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
		GROUP BY DATE(xml_timestamp) ORDER BY DATE(xml_timestamp) DESC ')->result();
	}
	public function total_hits(){
		return $this->db->query('SELECT COUNT(api_details_id) as TOTAL_HITS, (SELECT COUNT(api_details_id) FROM xml_logs WHERE xml_status = "SUCCESS" ) as SUCCESS_HITS,(SELECT COUNT(Distinct ip_address) FROM xml_logs ) as IP_HITS,(SELECT COUNT(api_details_id) FROM xml_logs WHERE xml_status = "FAILURE" ) as FAILURE_HITS FROM xml_logs ')->row();
	}
	public function recent_hits(){
		return $this->db->select('*')->from('xml_logs x')->where('x.user_id != 0')->join('user_details ud','ud.user_id = x.user_id')->order_by('x.xml_logs_id','DESC')->group_by(array('x.ip_address','x.user_id'))->limit('5')->get()->result();
	}
}