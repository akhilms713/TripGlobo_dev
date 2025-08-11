<?php
class Ticket_Support_Model extends CI_Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function viewsubjects()
	{
		$this->db->select('*');
		$query = $this->db->get('support_ticket_subject')->result();
		return $query;
	}
	public function deletesubjects($id)
	{
		$this->db->where('support_ticket_subject_id', $id);
	    return $this->db->delete('support_ticket_subject'); 
 
	}
	public function addsubjects($title)
	{
	return $this->db->insert('support_ticket_subject', $title); 
	}
	public function allinbox($limit, $start,$status,$condition='')
	{

        $query = $this->db->query('SELECT * FROM `support_ticket` s
LEFT JOIN user_details u ON(u.user_id=s.user_id)
LEFT JOIN support_ticket_subject sts ON(sts.support_ticket_subject_id = s.subject_id)
 WHERE s.status ="'.$status.'" '.$condition.'
ORDER BY s.last_updated_by DESC, s.last_update_time DESC LIMIT '.$start.','.$limit.' ')->result();
		/*$this->db->from('support_ticket');
		$this->db->join('user_details', 'user_details.user_id = support_ticket.user_id');	
		$query = $this->db->where('support_ticket.status',$status)->order_by('support_ticket.last_update_time','DESC')->limit($limit, $start)->get()->result();
		*/
		return $query;
	}
	
	 public function inbox_count() 
	{
		$query = $this->db->where('status', 'OPEN')->get('support_ticket');
		return $query->num_rows();
    }
    public function close_count() 
    {
    	$query = $this->db->where('status', 'CLOSED')->get('support_ticket');
		return $query->num_rows();
        
    }

	public function singleticket($SingleTicketID,$status)
	{
        $this->db->select('*');
        if(!empty($SingleTicketID)){
       	$this->db->from('support_ticket');
		$this->db->join('user_details', 'user_details.user_id = support_ticket.user_id');	
		$this->db->join('support_ticket_subject sts','sts.support_ticket_subject_id = support_ticket.subject_id');
		$query = $this->db->where( array('support_ticket.support_ticket_id' => $SingleTicketID, 'support_ticket.status' => $status ))->order_by('support_ticket.last_update_time','DESC')->get()->row();
		
      //  $query = $this->db->get_where('support_ticket', array('support_ticket_id' => $SingleTicketID))->row();
        }
        else{

        $this->db->from('support_ticket');
		$this->db->join('user_details', 'user_details.user_id = support_ticket.user_id');
		$this->db->join('support_ticket_subject sts','sts.support_ticket_subject_id = support_ticket.subject_id');	
		$query = $this->db->where('support_ticket.status',$status)->order_by('support_ticket.last_update_time','DESC')->get()->row();
		}
		return $query;
	}
	public function tickethistory($SingleTicketID,$status)
	{

		if(!empty($SingleTicketID)){
			$this->db->select('support_ticket_history.support_ticket_history_id,support_ticket_history.support_ticket_id,support_ticket.user_id,support_ticket_history.message,support_ticket_history.file_path,support_ticket_history.last_updated_by,user_details.user_id,user_details.profile_picture,user_details.user_name,support_ticket.support_ticket_id,support_ticket_history.last_update_time');
		
		$this->db->from('support_ticket_history');
		$this->db->join('support_ticket', 'support_ticket.support_ticket_id = support_ticket_history.support_ticket_id');	
		$this->db->join('user_details', 'user_details.user_id = support_ticket.user_id');	
		$query = $this->db->where(array('support_ticket_history.support_ticket_id' => $SingleTicketID))->get()->result();
	
       // $query = $this->db->order_by('support_ticket_history_id','ASC')->get_where('support_ticket_history', array('support_ticket_id' => $SingleTicketID))->result();
		}else{
			$this->db->select('*');
		 $result=$this->db->where('status',$status)->order_by('last_update_time','DESC')->limit(1)->get('support_ticket')->row();
		if($result){
		$this->db->select('support_ticket_history.support_ticket_history_id,support_ticket_history.support_ticket_id,support_ticket.user_id,support_ticket_history.message,support_ticket_history.file_path,support_ticket_history.last_updated_by,user_details.user_id,user_details.profile_picture,user_details.user_name,support_ticket.support_ticket_id,support_ticket_history.last_update_time');
		
		$this->db->from('support_ticket_history');
		$this->db->join('support_ticket', 'support_ticket.support_ticket_id = support_ticket_history.support_ticket_id');	
		$this->db->join('user_details', 'user_details.user_id = support_ticket.user_id');	
		$query = $this->db->where(array('support_ticket_history.support_ticket_id' => $result->support_ticket_id))->order_by('support_ticket_history.support_ticket_history_id','ASC')->get()->result();
		}
		else{
			$query='';
		}
		 //$query = $this->db->order_by('support_ticket_history_id','ASC')->get_where('support_ticket_history', array('support_ticket_id' => $result->support_ticket_id))->result();
		}
		return $query;
	}
	public function AddNewReply($data){
		return $this->db->insert('support_ticket_history', $data); 
		 
	}
	public function updateticket($id){
		$datestring = "%Y-%m-%d - %h:%i %a";
            $time = time();
		$data = array(
			'last_update_time' => date("Y-m-d H:i:s") ,
			'last_updated_by' => 'admin'
			);
		$this->db->where('support_ticket_id', $id);
        $this->db->update('support_ticket', $data); 
	}
	public function FileUpload($new_str){
		$data = array(
			'file_path' => $new_str
			);
		$this->db->select_max('support_ticket_history_id');
        $query = $this->db->get('support_ticket_history')->row();
		$this->db->where('support_ticket_history_id', $query->support_ticket_history_id);
        return $this->db->update('support_ticket_history', $data); 
	}
	public function CloseTicketUpdate($id){
		$data = array(
			'status' => 'closed'
			);
		$this->db->where('support_ticket_id', $id);
        $this->db->update('support_ticket', $data);
	}
	public function lastid(){
		$this->db->select_max('support_ticket_history_id');
        $query = $this->db->get('support_ticket_history')->row();
        echo $query->support_ticket_history_id;
	}
	public function sentTickets($limit, $start,$condition=''){
			$result = $this->db->query('SELECT DISTINCT s.support_ticket_id,s.message,sts.support_ticket_subject_value,s.ticket_unique_id,s.last_update_time,u.user_name,u.profile_picture FROM `support_ticket` s
	LEFT JOIN `support_ticket_history` sh ON(sh.support_ticket_id = s.support_ticket_id)
	LEFT JOIN `user_details` u ON(u.user_id = s.user_id)
	LEFT JOIN `support_ticket_subject` sts ON(sts.support_ticket_subject_id = s.subject_id)
	WHERE sh.last_updated_by ="admin" AND s.status = "open" '.$condition.' ORDER BY s.last_update_time DESC LIMIT '.$start.','.$limit.'')->result();
			
		//print_r($result);
			return $result;
	}
	 public function sent_count() 
    {
    	$query = $this->db->where(array('status' => 'OPEN', 'last_updated_by' => 'admin'))->get('support_ticket');
		return $query->num_rows();
        //return $this->db->where(array('status' => 'closed', 'last_updated_by' => 'admin'))->count_all("support_ticket");
         }
	public function sentsingleticket(){
		
			$query = $this->db->query('SELECT DISTINCT s.support_ticket_id,s.message,sts.support_ticket_subject_value,s.last_update_time,s.status,u.user_name,u.user_email,s.file_path FROM `support_ticket` s
		LEFT JOIN `support_ticket_history` sh ON(sh.support_ticket_id = s.support_ticket_id)
		LEFT JOIN `user_details` u ON(u.user_id = s.user_id)
		LEFT JOIN `support_ticket_subject` sts ON(sts.support_ticket_subject_id = s.subject_id)
		WHERE sh.last_updated_by ="admin" AND s.status = "open" ORDER BY s.last_update_time DESC LIMIT 1')->row();

		return $query;

	}
	public function senttickethistory(){
			$result = $this->db->query('SELECT DISTINCT s.support_ticket_id FROM `support_ticket` s
	LEFT JOIN `support_ticket_history` sh ON(sh.support_ticket_id = s.support_ticket_id)
	WHERE sh.last_updated_by ="admin" AND s.status = "open" ORDER BY s.last_update_time DESC LIMIT 1')->row();
			
      if($result){
		$this->db->select('support_ticket_history.support_ticket_history_id,support_ticket_history.support_ticket_id,support_ticket.user_id,support_ticket_history.message,support_ticket_history.file_path,support_ticket_history.last_updated_by,user_details.user_id,user_details.profile_picture,user_details.user_name,support_ticket.support_ticket_id,support_ticket_history.last_update_time');
		
		$this->db->from('support_ticket_history');
		$this->db->join('support_ticket', 'support_ticket.support_ticket_id = support_ticket_history.support_ticket_id');	
		$this->db->join('user_details', 'user_details.user_id = support_ticket.user_id');	
		$query = $this->db->where(array('support_ticket_history.support_ticket_id' => $result->support_ticket_id))->order_by('support_ticket_history.support_ticket_history_id','ASC')->get()->result();
		}
		else{
			$query ='';
		}

		return $query;
	}
}
?>