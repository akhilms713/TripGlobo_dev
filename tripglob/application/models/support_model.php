<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support_Model extends CI_Model {

 function get_support_subject_list()
	{
		$this->db->select('*')
		->from('support_ticket_subject');
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
      return false;
	}
	function get_support_list($user_id )
	{
		$this->db->select('*')
		->from('support_ticket')->where('support_ticket.status !=', 'CLOSED')  ->where('support_ticket.user_id', $user_id)	;
		$this->db->join('support_ticket_subject','support_ticket_subject.support_ticket_subject_id = support_ticket.subject_id');
	 
		
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
      return false;
	}
function get_support_list_sent($user_id)
	{
		$this->db->select('*')
		->from('support_ticket')->where('support_ticket.last_updated_by !=', 'ADMIN')->where('support_ticket.status', 'OPEN')  ->where('support_ticket.user_id', $user_id)	;
		$this->db->join('support_ticket_subject','support_ticket_subject.support_ticket_subject_id = support_ticket.subject_id');
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
      return false;
	}
	
function get_support_list_pending($user_id)
	{
		
		//$this->db->select('*')
		//->from('support_ticket')->where('support_ticket.last_updated_by =', 'ADMIN') ->where('support_ticket.status !=', 'OPEN')  ->where('support_ticket.user_id', $user_id)	;
		$this->db->select('*')
		->from('support_ticket')->where('support_ticket.last_updated_by =', 'ADMIN') ->where('support_ticket.status =', 'OPEN')  ->where('support_ticket.user_id', $user_id)	;
		$this->db->join('support_ticket_subject','support_ticket_subject.support_ticket_subject_id = support_ticket.subject_id');
	 
	 
	   
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
      return false;
	}
	function get_support_list_close($user_id)
	{
		$this->db->select('*')
		->from('support_ticket') ->where('support_ticket.status', 'CLOSED')  ->where('support_ticket.user_id', $user_id)	;
		$this->db->join('support_ticket_subject','support_ticket_subject.support_ticket_subject_id = support_ticket.subject_id');
	 
	  
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
      return false;
	}
	function add_new_support_ticket($user_id,$sub,$message,$image_path)
	{
		
		  $select2 = "select max(id)+1 as max from support_ticket";
		  $query=$this->db->query($select2);
		  $aa = $query->row();
		  $m_id1 = 0;
		  if($aa!='')
		  {
		   $m_id1=  $aa->max;
		  }
  		$m_id =  'ST'.date('d').date('m').($m_id1+10000);
  		$ticket_unique_id  =  'ST'. time();
  		$data = array(  
						 
						'user_id' => $user_id,
						'subject_id' => $sub,
						'message' => $message,
						'file_path' => $image_path,
						'status' => 'OPEN',
						'support_ticket_id'=>$m_id,
						'ticket_unique_id'=>$ticket_unique_id,
						'last_updated_by' => 'USER'
						);
			
			
		$this->db->set('created_time', 'NOW()', FALSE); 
		$this->db->set('last_update_time', 'NOW()', FALSE); 
		$this->db->insert('support_ticket', $data);
		$suprtid = $this->db->insert_id();
		$data = array(
		'support_ticket_id' => $m_id,
		'message' => $message,
		'file_path' => $image_path,
		'status' => 'OPEN',
		'last_updated_by' => 'USER'
		);
		$this->db->set('last_update_time', 'NOW()', FALSE); 
		$this->db->insert('support_ticket_history', $data);
		return $suprtid;
	}
	function get_support_list_id($user_id,$id)
	{
	 
										 
								 $this->db->select('*')
								->from('support_ticket_history')->where('support_ticket_id', $id)->order_by('last_update_time','ASC');
								
								$query = $this->db->get();
							//echo $this->db->last_query();exit;
								if ( $query->num_rows > 0 ) 
								{
										 return $query->result();
								}
								
								
     
      return false;
		
	}
	
	function getSupportHistoryRow($id)
	{
		$this->db->select('*')
		->from('support_ticket_history')->where('support_ticket_history_id', $id);;
		
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->row();
        }
      return false;
	}
	function add_new_support_ticket_updates($s_id,$message,$image_path)
	{
			 
	 
		
		 	$data = array(
		'message' => $message,
		'file_path' => $image_path,
		'status' => 'OPEN',
		'last_updated_by' => 'USER',
		'support_ticket_id'=>$s_id
		);
			
	
		$this->db->set('last_update_time', 'NOW()', FALSE); 
		$this->db->insert('support_ticket_history', $data);
		$last_id = $this->db->insert_id();
		$this->db->where('support_ticket_id', $s_id);
		$this->db->update('support_ticket',array('last_updated_by'=>'USER'));

		return $last_id;
	}
	function close_ticket($id)
	{
		$data = array(
			'status' => 'CLOSED'
			
			);
		
			
			$where = "support_ticket_id = '$id'";
		if ($this->db->update('support_ticket', $data, $where)) {
			return true;
		} else {
			return false;
		}
	}
	function get_support_list_id_row($user_id,$id)
	{
		 
		$this->db->select('*')

		->from('support_ticket')->where('support_ticket.support_ticket_id', $id);
		$this->db->join('support_ticket_subject','support_ticket_subject.support_ticket_subject_id = support_ticket.subject_id');
		
		
		$query = $this->db->get();
		
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->row();
        }
      return false;
		
	}
	function calculate_time_ago($ptime)
	{
		
	$sss = date('Y-m-d H:i:s');
    $etime = strtotime($sss) - strtotime($ptime);
    if( $etime < 1 )
    {
        return 'less than 1 second ago';
    }

    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60             =>  'hour',
                60                  =>  'minute',
                1                   =>  'second'
    );

    foreach( $a as $secs => $str )
    {
        $d = $etime / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return '' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
	}
	
	
	function close_ticket_with_remark($gdata)
	{
	    
		$data = array(
			'status' => 'CLOSED',
			'remarks'=> $gdata['remarks']
			);
		
			$id = $gdata['ticket_number'];
			
			$where = "support_ticket_id = '$id'";
		if ($this->db->update('support_ticket', $data, $where)) {
			return true;
		} else {
			return false;
		}
	}
}

?>
