<?php
class Static_Page_Model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	public function isTitleExists($title){
		$this->db->select('*');
		$this->db->where('slug',$title);
		$query = $this->db->get('static_pages');
		if ( $query->num_rows > 0 ) {
         		return true;
      		}
      		return false;
	}
	public function addNewPageDetails($labels){
		$this->db->insert('static_pages',$labels);
		$id = $this->db->insert_id();
		$labels['guid'] = WEB_FRONT_URL."general/page/".$id;
		$labels['url'] = WEB_FRONT_URL."general/page/".$labels['slug'];
		$this->db->trans_start();
		$this->db->where('id',$id);
		$this->db->update('static_pages',$labels);	
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	public function addNewfaqDetails($labels){
		
		$this->db->insert('cms_faq',$labels);
		$id = $this->db->insert_id();
		return $id;
	}
	public function viewAllPages(){
		$this->db->select('*');
		$query = $this->db->get('static_pages');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}
      		return false;
	}
	public function viewAllfaqPages()
	{
			$this->db->select('*');
		$query = $this->db->get('cms_faq');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}
      		return false;
		
	}
	public function editfaqPage($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('cms_faq');
		if ( $query->num_rows > 0 ) {
         		return $query->row();
      		}
      		return false;
	}
	public function updatefaqPage($labels){
		$this->db->trans_start();
		$this->db->where('id',$labels['id']);
		$this->db->update('cms_faq',$labels);	
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	public function editPage($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('static_pages');
		if ( $query->num_rows > 0 ) {
         		return $query->row();
      		}
      		return false;
	}
	
	public function updatePage($labels){
		$this->db->trans_start();
		$this->db->where('id',$labels['id']);
		$this->db->update('static_pages',$labels);	
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	public function updatePageStatus($id,$status){
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->update('static_pages', $status); 
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	public function deletePage($id){
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->delete('static_pages'); 
		$this->db->trans_complete();
		return $this->db->trans_status();	
	}
	public function deletefaqPage($id){
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->delete('cms_faq'); 
		$this->db->trans_complete();
		return $this->db->trans_status();	
	}
		public function addcontact($data) {
		$this->db->where('contact_id', 1); //we are hard coding the contact_id as there will be only single row for contact details..
		$this->db->update('contact_details', $data);
	}

	public function currentAddress() {
		return $this->db->get('contact_details');
	}

	public function getAllWbws() {
		return $this->db->get('static_pages_title');
	}

	public function getCurrentWbwsDetails($id) {
		$this->db->select('*');
		$this->db->from('static_pages_title');
		$this->db->where('id', $id);
		return $this->db->get();
	}

	public function editWbws_save($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('static_pages_title', $data);
		return true;
	}
}
?>
