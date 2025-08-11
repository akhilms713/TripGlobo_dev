<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Ticket_Support extends CI_Controller {

  public function __construct()
    {
      parent::__construct();
    
    $this->load->model('Ticket_Support_Model');
    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");
    $this->load->library('form_validation');
    $this->load->library("pagination");
    $this->check_isvalidated();
  
    }
  private function check_isvalidated()
  {
    if(!$this->session->userdata('admin_logged_in') || $this->session->userdata('admin_id')!= ADMIN_ID )
    {
      if ($this->session->userdata('admin_logged_in')) {
       $controller_name = $this->router->fetch_class();
       $function_name = $this->router->fetch_method();
       $this->load->model('Privilege_Model');
       $sub_admin_id = $this->session->userdata('admin_id');
      if(!$this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id,$controller_name,$function_name))
       {      
          access_denied('error');
        }
      
        }
   else
         {
          redirect('login','refresh');
         }
    }
    
    }
    public function inbox(){
        
        $get_data = $this->input->get();
        
        if( empty($get_data['unique_number']) == false)
		{
			$condition = ' and s.ticket_unique_id ="'.$get_data['unique_number'].'"';
		}else{
			$condition = '';
		}
		
        // echo '<pre>';print_r($get_data);exit();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config["total_rows"] = $this->Ticket_Support_Model->inbox_count();
        $config["base_url"] = WEB_URL . "ticket_support/inbox";
        $this->pagination->initialize($config);
        $status = 'open';
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["links"] = $this->pagination->create_links();
        $data['inbox'] = $this->Ticket_Support_Model->allinbox($config["per_page"], $page,$status,$condition);
        $data['singleticket'] = $this->Ticket_Support_Model->singleticket($SingleTicketID='',$status);
        $data['tickethistory']=$this->Ticket_Support_Model->tickethistory($SingleTicketID='',$status);
        // debug($data);exit;
        $this->load->view('ticket_support/inbox',$data);
    }
    public function viewSubject(){
      $data['subject'] = $this->Ticket_Support_Model->viewsubjects();
      $this->load->view('ticket_support/viewsubject',$data);
    }
    public function deleteticket(){
      $id=$this->input->post('id');
      $this->Ticket_Support_Model->deletesubjects($id);
    }
    public function addSubject(){
      $title=array(
        'support_ticket_subject_id  ' => '',
        'support_ticket_subject_value' => $this->input->post('subject') );
      $this->Ticket_Support_Model->addsubjects($title);
      redirect(WEB_URL.'ticket_support/viewSubject');
    }
    public function add_new_subject(){

      $this->load->view('ticket_support/add_new_subject');
    }
    public function SingleTicketDisplay(){
        $status = 'open';
        $SingleTicketID=$this->input->post('SingleTicketID');
        $data['singleticket']=$this->Ticket_Support_Model->singleticket($SingleTicketID,$status);
        $data['tickethistory']=$this->Ticket_Support_Model->tickethistory($SingleTicketID,$status);
        $this->load->view('ticket_support/singleticketdisplay',$data);
    }
    public function closedSingleTicketDisplay(){
        $status = 'closed';
        $SingleTicketID=$this->input->post('SingleTicketID');
        $data['singleticket']=$this->Ticket_Support_Model->singleticket($SingleTicketID,$status);
        $data['tickethistory']=$this->Ticket_Support_Model->tickethistory($SingleTicketID,$status);
        $this->load->view('ticket_support/singleticketdisplay',$data);
    }
    public function AddTicketReply(){
           $datestring = "%Y-%m-%d - %h:%i %a";
            $time = time();
        $data = array(
        'support_ticket_id' => $this->input->post('newticketID'),
        'message' => $this->input->post('message'),
        'last_updated_by' => 'admin',
        'status' => 'open',
        'last_update_time' => date("Y-m-d H:i:s")

        );
        $this->Ticket_Support_Model->AddNewReply($data);
        $this->Ticket_Support_Model->updateticket($id=$this->input->post('newticketID'));
        
    }
    public function fileupload(){
        {
          $status = "";
          $msg = "";
          $file_element_name = 'userfile';

         if ($status != "error")
        {
          $config['upload_path'] = '../admin-panel/uploads/support_ticket';
          $config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf';
          $config['max_size'] = 1024 * 8;
          $config['encrypt_name'] = TRUE;

          $this->load->library('upload', $config);
          if (!$this->upload->do_upload($file_element_name))
          {
            $status = 'error';
            $msg = $this->upload->display_errors('', '');
          }
          else
           {
           $data = $this->upload->data();
           $image_path = $data['full_path'];
           if(file_exists($image_path))
           {
              $status = "success";
              $msg = "File successfully uploaded";
              if(($pos = strpos($image_path, 'uploads')) !== false)
            {
               $new_str = 'u'.substr($image_path, $pos + 1);
            }
            else
            {
               $new_str = get_last_word($image_path);
            }


              $this->Ticket_Support_Model->FileUpload($new_str);
         }
         else
         {
          $status = "error";
          $msg = "Something went wrong when saving the file, please try again.";
           }
          }
           @unlink($_FILES[$file_element_name]);
           }
           echo json_encode(array('status' => $status, 'msg' => $msg)); 
          }

        }
        public function closeTicket(){
          $id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
          $this->Ticket_Support_Model->CloseTicketUpdate($id);
          redirect(WEB_URL.'ticket_support/inbox');

        }
        public function last(){
          $this->Ticket_Support_Model->lastid();
        }
        public function closed(){
            
            $get_data = $this->input->get();
        
            if( empty($get_data['unique_number']) == false)
    		{
    			$condition = ' and s.ticket_unique_id ="'.$get_data['unique_number'].'"';
    		}else{
    			$condition = '';
    		}
                    
          $config["per_page"] = 10;
          $config["uri_segment"] = 3;
          $config["total_rows"] = $this->Ticket_Support_Model->close_count();
          $config["base_url"] = WEB_URL . "ticket_support/closed";
          $this->pagination->initialize($config);
          $status = 'closed';
          $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

          $data["links"] = $this->pagination->create_links();
          $data['inbox'] = $this->Ticket_Support_Model->allinbox($config["per_page"], $page,$status,$condition);
          $data['singleticket'] = $this->Ticket_Support_Model->singleticket($SingleTicketID='',$status);
          $data['tickethistory']=$this->Ticket_Support_Model->tickethistory($SingleTicketID='',$status);
          $this->load->view('ticket_support/closedticket',$data);
        }
        
        
        public function sent(){
            
            $get_data = $this->input->get();
        
            if( empty($get_data['unique_number']) == false)
    		{
    			$condition = ' and s.ticket_unique_id ="'.$get_data['unique_number'].'"';
    		}else{
    			$condition = '';
    		}
		
          $config["per_page"] = 10;
          $config["uri_segment"] = 3;
          $config["total_rows"] = $this->Ticket_Support_Model->sent_count();
          $config["base_url"] = WEB_URL . "ticket_support/sent";
          $this->pagination->initialize($config);
          $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

          $data["links"] = $this->pagination->create_links();
          $data['sentticket'] = $this->Ticket_Support_Model->sentTickets($config["per_page"], $page,$condition);
          $data['sentsingleticket'] = $this->Ticket_Support_Model->sentsingleticket();
          $data['senttickethistory']=$this->Ticket_Support_Model->senttickethistory();
          $this->load->view('ticket_support/sentticket',$data);
        }
}
?>
