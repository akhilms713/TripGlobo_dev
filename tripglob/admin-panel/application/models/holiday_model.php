<?php

class Holiday_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_country_details($country_id = '') {
        $this->db->select('*');
        $this->db->from('country_list');
        if ($country_id != '')
            $this->db->where('country_list', $country_list);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    /*public function get_country_details($country_id = '') {
        $this->db->select('*');
        $this->db->from('country_info');
        if ($country_id != '')
            $this->db->where('country_id', $country_id);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }
*/
   
    function get_holiday_types_list_active($holiday_type_id = '') {
        $this->db->select('*');
        $this->db->from('holiday_type');
        $this->db->where('status','ACTIVE');
       
        
       if ($holiday_type_id != '')
            $this->db->where('holiday_type_id', $holiday_type_id);
         $this->db->order_by('holiday_type_name','asc');
        $query = $this->db->get();

        //echo $this->db->last_query(); exit;

        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    function get_holiday_types_list($holiday_type_id = '') {
        $this->db->select('*');
        $this->db->from('holiday_type');
       if ($holiday_type_id != '')
            $this->db->where('holiday_type_id', $holiday_type_id);
        $query = $this->db->get();

        //echo $this->db->last_query(); exit;

        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }
    
     function get_holiday_settings_list($general_holiday_settings_id = '') {
        $this->db->select('*');
        $this->db->from('general_holiday_settings');
        if ($general_holiday_settings_id != '')
            $this->db->where('general_holiday_settings_id', $general_holiday_settings_id);
        $query = $this->db->get();

     // echo $this->db->last_query();exit;

        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }
    function add_new_holiday_do($data)
    {

        $this->db->insert('holiday_details', $data);
        return true;
    }
     function get_holiday_crs_list($holiday_id = '', $holiday) {
        $this->db->select('h.*, c.country_name');
        $this->db->from('holiday_details h');
        $this->db->join('country_info c', 'h.country_id = c.country_id');
        if ($holiday_id != '')
            $this->db->where('holiday_details_id', $holiday_id);
        $query = $this->db->get();
        //$this->db->last_query($query);
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    function get_holiday_crs_list1($holiday_id = '') {
        $this->db->select('h.*, c.country_name');
        $this->db->from('holiday_details h');
        $this->db->join('country_list c', 'h.country_id = c.country_list');
        if ($holiday_id != '')
            $this->db->where('holiday_details_id', $holiday_id);
        $query = $this->db->get();
       // echo $this->db->last_query($query);
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    public function get_home_page_settings(){
        // $colors              = array('black','blue','cafe','purple','red','white','yellow');
        $colors                 = array('');
        $color_key              = array_rand($colors, 1);
        $data['color']          = $colors[$color_key];
        
        $transitions            = array('page-left-in','page-right-in','page-fade','page-fade-only');
        $transition_key         = array_rand($transitions, 1);
        $data['transition']     = $transitions[$transition_key];
        
        // $headers             = array('header_left','header_top','header_right');
        $headers                = array('header_left');
        $header_key             = array_rand($headers, 1);
        $data['header']         = $headers[$header_key];
        $data['header']         = $headers[$header_key];
        // $data['sidebar']         = "sidebar-collapsed";
        $data['sidebar']        = "";
        
        return $data;
    }

    function get_holiday_list($holiday_id = '') {
        
        $sql = "SELECT hod.* FROM (`holiday_details` hod) LEFT JOIN `holiday_type` ON `hod`.`holiday_types` = `holiday_type`.`holiday_type_id` WHERE `holiday_type`.`status` = 'ACTIVE'";
        
        $query = $this->db->query($sql);
       // echo $this->db->last_query(); exit;

        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    /*function get_holiday_list($holiday_id = '') {
        $this->db->select('*');
        $this->db->from('holiday_details hod');

         $this->db->join('holiday_type', 'hod.holiday_types = holiday_type.holiday_type_id');
        $this->db->where('holiday_type.status', 'ACTIVE');
        //$this->db->join('supplier_details sd','sd.supplier_details_id = hod.supplier_details_id');
        //$this->db->join('hotel_details hd','hd.hotel_details_id = hod.hotel_details_id');
        if ($holiday_id != '') {
            $this->db->where('hod.holiday_details_id', $holiday_id);
        }
        $query = $this->db->get();

        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }*/
     function active_holiday($holiday_id) {
        $data = array(
            'status' => 'ACTIVE'
        );
        $this->db->where('holiday_details_id', $holiday_id);
        $this->db->update('holiday_details', $data);
       
    }

    function inactive_holiday($holiday_id) {
        $data = array(
            'status' => 'INACTIVE'
        );
        $this->db->where('holiday_details_id', $holiday_id);
        $this->db->update('holiday_details', $data);
        }

    function delete_holiday($holiday_id) {
        $this->db->where('holiday_details_id', $holiday_id);
        $this->db->delete('holiday_details');
         }
    function add_new_holiday_image_do($data)
    {
        $this->db->insert('holiday_gallery_details', $data);
        return true;
    }
    function package_gallary_detail($holiday_id = '') {
        $this->db->select('*');
        $this->db->from('holiday_gallery_details');
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }
    function get_holiday_detailbyId($holiday_id) {
        $this->db->select('*');
        $this->db->from('holiday_details');
        $this->db->where('holiday_details_id',$holiday_id);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

     function get_holiday_gallery_detailbyId($holiday_id) {
        $this->db->select('*');
        $this->db->from('holiday_gallery_details');
        $this->db->where('holiday_id',$holiday_id);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }
    function delete_gall_id($delete_gall_id)
    {

        $this->db->where('gallery_id',$delete_gall_id);
        $this->db->delete('holiday_gallery_details');
         return true;

    }
     function delete_holiday_id($delete_holiday_id)
    {

        $this->db->where('holiday_details_id',$delete_holiday_id);
        $this->db->delete('holiday_details');
         return true;

    }



      function active_holiday_image($gallery_id) {
        $data = array(
            'status' => 'ACTIVE'
        );
        $this->db->where('gallery_id', $gallery_id);
        $this->db->update('holiday_gallery_details', $data);
     
    }

    function inactive_holiday_image($gallery_id) {
        $data = array(
            'status' => 'INACTIVE'
        );
        $this->db->where('gallery_id', $gallery_id);
        $this->db->update('holiday_gallery_details', $data);
       
    }
    function get_holiday_imageById($gallery_id) {
        $this->db->select('*');
        $this->db->from('holiday_gallery_details');
        $this->db->where('gallery_id',$gallery_id);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }
    function update_new_holiday_image_do($data,$gallery_id)
{
    $this->db->WHERE('gallery_id',$gallery_id);
    $this->db->update("holiday_gallery_details",$data);   
    return true;
}

 function update_holiday($data,$holiday_id)
{
      $this->db->where('holiday_details_id',$holiday_id);
    $this->db->update("holiday_details",$data);   
    return true;
}

function delete_holiday_imageById($gallery_id)
{
    $this->db->WHERE('gallery_id',$gallery_id);
    $this->db->delete("holiday_gallery_details"); 
    return true;
}


  /* function get_inclusions_list($inclusion_id = '') {
        $this->db->select('*');
        $this->db->from('holiday_inclusions');
        if ($inclusion_id != '')
            $this->db->where('holiday_inclusions_id', $inclusion_id);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }
*/

  
    function get_all_enquiry_list_holiday($holiday_id="") {
        $this->db->select('*');
        $this->db->from('holiday_enquiries');    
        $this->db->join('holiday_details', 'holiday_details.holiday_details_id = holiday_enquiries.holiday_details_id'); 
        if($holiday_id!=""){   
        $this->db->where('holiday_enquiries.holiday_details_id', $holiday_id);
        }
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    function get_all_success_pending_enquiry_list_holiday($status) {
        $this->db->select('*');
        $this->db->from('holiday_enquiries');    
        $this->db->join('holiday_details', 'holiday_details.holiday_details_id = holiday_enquiries.holiday_details_id'); 
        $this->db->where('holiday_enquiries.payment_status', $status);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }


    /*
        1.HOLIDAY TYPE SECTION 
    
    */
    
    function add_holiday_type_details($input) {
        if (!isset($input['status']))
            $input['status'] = "INACTIVE";
            if (!isset($post['display_home']))
            $input['display_home'] = "NO";

            
        $insert_data = array(
            'holiday_type_name'    => $input['holiday_type_name'],
            'holiday_type_name_arabic'    => $input['holiday_type_name_ar'],
            'display_in_home_page' => $input['display_home'],
            'icon'                 => $input['holiday_type_icon'],
            'added_by' => $this->session->userdata('lgm_supplier_id'),
            'status' => $input['status']
        );

        //echo "<pre>test";print_r($insert_data);exit();
        $this->db->insert('holiday_type', $insert_data);
        $id = $this->db->insert_id();
        /*$this->General_Model->insert_log('8', 'add_holiday_type_details', json_encode($input), 'adding the Holiday Type', 'holiday_type', 'holiday_type_id', $id);*/
    }

    function inactive_holiday_type($holiday_type_id) {
        $data = array(
            'status' => 'INACTIVE'
        );
        $this->db->where('holiday_type_id', $holiday_type_id);
        $this->db->update('holiday_type', $data);
       /* $this->General_Model->insert_log('8', 'inactive_holiday_type', json_encode($data), 'updating the Holiday Type status to inactive', 'holiday_type', 'holiday_type_id', $holiday_type_id);*/
    }

    function active_holiday_type($holiday_type_id) {
        $data = array(
            'status' => 'ACTIVE'
        );
        $this->db->where('holiday_type_id', $holiday_type_id);
        $this->db->update('holiday_type', $data);
        /*$this->General_Model->insert_log('8', 'active_holiday_type', json_encode($data), 'updating the Holiday Type status to active', 'holiday_type', 'holiday_type_id', $holiday_type_id);*/
    }

    function delete_holiday_type($holiday_type_id) {
        $this->db->where('holiday_type_id', $holiday_type_id);
        $this->db->delete('holiday_type');
        /*$this->General_Model->insert_log('8', 'delete_holiday_type', json_encode($_POST), 'deleting the Holiday Type', 'holiday_type', 'holiday_type_id', $holiday_type_id);*/
    }

    function update_holiday_type($input, $holiday_type_id) {
        if (!isset($input['status']))
            $input['status'] = "INACTIVE";
              if (!isset($input['display_home']))
            $input['display_home'] = "NO";
        $update_data = array(
            'holiday_type_name'  => $input['holiday_type_name'],
            'holiday_type_name_arabic'  => $input['holiday_type_name_ar'],
             'display_in_home_page' => $input['display_home'],
            'icon'                 => $input['holiday_type_icon'],
            'added_by' => $this->session->userdata('lgm_supplier_id'),
            'status' => $input['status']
        );
        $this->db->where('holiday_type_id', $holiday_type_id);
        $this->db->update('holiday_type', $update_data);
        /*$this->General_Model->insert_log('8', 'update_holiday_type', json_encode($update_data), 'updating the Holiday Type', 'holiday_type', 'holiday_type_id', $holiday_type_id);*/
    }
  function get_enquiry_details($enq_id = '') {
        $this->db->select('*');
        $this->db->from('holiday_enquiries');
        if ($enq_id != '')
            $this->db->where('enquiry_id', $enq_id);
            $this->db->join('holiday_details', 'holiday_details.holiday_details_id = holiday_enquiries.holiday_details_id');    

        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    function get_all_review(){
        
    }
    function add_review_details(){

    }



    function get_holiday_package()
    {
         $this->db->select('*');
         $this->db->from('holiday_details');
        // $this->db->where('status','ACTIVE');
         $query = $this->db->get();
         return $query->result();
        // echo $this->db->last_query(); exit;
        // echo $result;exit;
           /* if ( $query->num_rows > 0 ){
            return $query->result();
            }
            else
            {
                return '';
            }   */
        
    }
    function update_top_holiday($id)
    {   
        $this->db->set('top_holiday','1');
        $this->db->where('holiday_details_id',$id);
        $this->db->update("holiday_details");   
         return true;
    }
    function edit_top_holiday($holiday_details_id,$data)
    {   
        $this->db->where('holiday_details_id',$holiday_details_id);
        $this->db->update("holiday_details",$data);   
         return true;
    }

    function get_top_holiday(){

        $this->db->select('*');
        $this->db->from('holiday_details');
        $this->db->where('top_holiday','1');
       $query = $this->db->get();
       
         return $query->result();
    }

    function update_booking_status($enq_id,$value)
    {
        $data=array(
                     'booking_status'=>$value
                   );
        $this->db->where('enquiry_id',$enq_id);
        if($this->db->update('holiday_enquiries',$data)){
            return true;

        }
        else
        {
            return false;
        }

    }

    function holiday_voucher($enquiry_id)
    {
            $this->db->select('*');
            $this->db->from('holiday_enquiries');  
            $this->db->join('holiday_details', 'holiday_details.holiday_details_id = holiday_enquiries.holiday_details_id');
            $this->db->where('enquiry_id',$enquiry_id);   
            $query = $this->db->get();          
            if ($query->num_rows() != '') {
            return $query->row();
        } else {
          return false;
        }   
    }
}
?>
