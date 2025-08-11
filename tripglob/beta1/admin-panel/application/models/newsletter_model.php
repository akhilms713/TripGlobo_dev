<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter_model extends CI_Model {

	function add_newsletter_template($data){
		if ($this->db->insert("newsletter_templates", $data)) {
			return true;
		}else{
			return false;
		}
	}

	function get_newsletter_templates($id = "",$col = '*' , $cond = array()){
			if ($id != "") 
			{
				$this->db->where("id",$id);
			}
			if (count($cond) > 0) 
			{
				$this->db->where($cond);
			}
			$this->db->select($col);
			$query = $this->db->get('newsletter_templates');
			if ( $query->num_rows > 0 ) 
			{
				return $query->result();	
			}
			return false;	
	}	

	function get_email_header_and_footer()
	{
			$this->db->select('*');
			$query = $this->db->get('email_template_common');
			if ( $query->num_rows > 0 ) 
			{
				return $query->result();	
			}
			return false;	
	}


	function change_newsletter_status($id, $data){
		$this->db->where("id",$id);
		if($this->db->update('newsletter_templates', $data)){
			return true;
		}else{
			return false;
		}
	}

	function update_newsletter_template($id, $data){
		$this->db->where("id",$id);
		if($this->db->update('newsletter_templates', $data)){
			return true;
		}else{
			return false;
		}
	}
	function delete_template($id){
		$this->db->where("id",$id);
		if($this->db->delete('newsletter_templates')){
			return true;
		}else{
			return false;
		}
	}

	function get_campaign($id = "",$col = '*'){
		if ($id != "") 
			{
				$this->db->where("id",$id);
			}
			$this->db->select($col);
			$query = $this->db->get('campaign');
			if ( $query->num_rows > 0 ) 
			{
				return $query->result();	
			}
			return false;
	}

	function add_campaign_template($data){
		if ($this->db->insert("campaign", $data)) {
			return true;
		}else{
			return false;
		}
	}
	function delete_campaign($campaign_id){
		$this->db->where("id",$campaign_id);
		if($this->db->delete('campaign')){
			return true;
		}else{
			return false;
		}
	}
	function update_campaign($id, $data){
		$this->db->where("id",$id);
		if($this->db->update('campaign', $data)){
			return true;
		}else{
			return false;
		}
	}
	function get_subscribers($usertype_id){
		$this->db->select('user_type.user_type_name,user_type.user_type_id,subscribers.*')
		->from("subscribers")
		->where('user_type.user_type_id', $usertype_id) 
		->join('user_type', 'user_type.user_type_id = subscribers.user_type_id', 'left');
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
	function get_unregistered_subscribers(){
		$this->db->select('*');
		$this->db->where("user_type_id", 0);
		$query = $this->db->get('subscribers');

		if ( $query->num_rows > 0 ) 
		{
			return $query->result();	
		}
		else
		{
			return '';	
		}
	}
	function delete_subscriber($subscriber_id){
		$this->db->where("subscriber_id",$subscriber_id);
		if($this->db->delete('subscribers')){
			return true;
		}else{
			return false;
		}
	}
}

?>