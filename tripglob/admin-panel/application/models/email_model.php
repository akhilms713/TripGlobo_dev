<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
class Email_Model extends CI_Model {
	private $smtp;
	private $host;
	private $port;
	private $username;
	private $password;
	public function __construct(){
		parent::__construct();
			$this->get_email_access();
	}
	
    public function get_email_template($email_type) 
	{
	    $this->db->where('email_type', $email_type);
		$result = $this->db->get('email_template');
		$data['content'] = $result->row();
		
		$this->db->where('email_template_common_id', '1');
		$this->db->where('status', 'ACTIVE');
		$result1 = $this->db->get('email_template_common');
		$result1_v = $result1->row();
        $data['header'] = $result1_v->div_content;
		
		$this->db->where('email_template_common_id', '2');
		$this->db->where('status', 'ACTIVE');
		$result2 = $this->db->get('email_template_common');
		$result2_v = $result2->row();
        $data['footer'] = $result2_v->div_content;
	 	
        return $data;
    }
	function get_email_access()
    {
       	  $this->db->select('*');
        $this->db->from('email_access');
        $this->db->where('email_access_id','1');
        $query = $this->db->get();
        $result = $query->row();    
        $this->smtp = $result->smtp;
        $this->host = $result->host;
        $this->port = $result->port;
        $this->username = $result->username;
        $this->password = $result->password;
        $this->SMTPSecure = $result->SMTPSecure;
	   return $result;	
    }
	public function get_smtp_access()
	{
		$this->db->select('*')->from('email_access');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) 
		{
			return $query->row();	
		}
		else
		{
			return '';	
		}
	}
	public function get_email_content_common($div_name)
	{
		$this->db->select('*')->from('email_template_common')
		->where('div_name',$div_name);
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) 
		{
			return $query->row();	
		}
		else
		{
			return '';	
		}
	}
	public function get_all_email_template($id = NULL)
	{
        if($id)
        {
            $this->db->where('email_template_id',$id);
        }

		$this->db->select('*')->from('email_template');
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
    public function get_all_email_template_new($id = NULL)
    {
        if($id)
        {
            $this->db->where('id',$id);
        }

        $this->db->select('*')->from('email_template_new');
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
    
    public function update_email($id, $data)
    {
        $this->db->where('email_template_id',$id);
        $this->db->update('email_template',$data);
        return true;
    }

 public function update_smtp_setting($data)
   	{
		
			$where = "email_access_id = '1'";
		if ($this->db->update('email_access', $data, $where)) {
			return true;
		} else {
			return false;
		}
   }

public function update_email_template_common($data,$where)
{
    $this->db->where('div_name', $where);
    if ($this->db->update('email_template_common', $data)) {
        return true;
    } else {
        return false;
    }
}




    public function update_email_div($div_name, $div_content)
   	{
		
		$data = array(
			'div_content' => mysql_real_escape_string($div_content)
			
		 );
			$where = "div_name = '$div_name'";
		if ($this->db->update('email_template_common', $data, $where)) {
			return true;
		} else {
			return false;
		}
   }

   public function get_subscriber_email_id($user_type_id = "") {
        $this->db->select('email');
        if ($user_type_id != "") {
        	$this->db->where("user_type_id", $user_type_id);
        }
		$query = $this->db->get('subscribers');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function get_additional_campaign_email($id) {
        $this->db->select('campaign_email_to');
        $this->db->from('campaign');
        $this->db->where('id', $id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function get_from_email($id) {
        $this->db->select('email_from');
        $this->db->from('campaign');
        $this->db->where('id', $id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    public function sendCampaignEmail($email_id, $mail_content, $credential, $email_from_id) {
        $config = Array(
            'protocol' => $credential->smtp,
            'smtp_host' => $credential->host,
            'smtp_port' => $credential->port,
            'smtp_user' => $credential->username,
            'smtp_pass' => $credential->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($email_from_id);
        $this->email->bcc($email_id);
        $this->email->subject($mail_content->email_subject);
        
        $data['content'] = $mail_content->campaign_template;
        $message = $this->load->view('newsletter/email_template', $data , TRUE);
        $this->email->message($message);
        if ($this->email->send()) {
            echo json_encode(array('status' => 1));
        } else {
            echo json_encode(array('status' => 0));
        }
    }

   public function sendmail_reg($email_id, $mail_content, $credential) {
        $config = Array(
            'protocol' => $credential->smtp,
            'smtp_host' => $credential->host,
            'smtp_port' => $credential->port,
            'smtp_user' => $credential->username,
            'smtp_pass' => $credential->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $data['content'] = $mail_content->campaign_template;
        $message = $this->load->view('newsletter/email_template', $data , TRUE);
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($mail_content->email_from,$mail_content->email_subject);
        $this->email->bcc($email_id);
        $this->email->subject($mail_content->email_subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo json_encode(array('status' => 1));
        } else {
            echo json_encode(array('status' => 0));
        }
    }
	
	  public function sendmail_agentVerification($data,$email_type) {

		$email_template = $this->get_email_template($email_type);
		
		$message = $email_template['header'].$email_template['content']->message.$email_template['footer'];
        $to_email = $email_template['content']->to_email;
      
         
        $message = str_replace("{%%FIRSTNAME%%}", $data['user']->user_name, $message);
        $message = str_replace("{%%VERIFICATION_CODE%%}", $data['email_opt_number'], $message);
		  $message = str_replace("{%%VERIFICATION_CODE_MOBILE%%}", $data['mobile_opt_number'], $message);
		  
		  $message = str_replace("{%%RESETLINK%%}", $data['confirm_url'], $message);
        $config = array(
            'protocol' => $this->smtp,
            'smtp_host' => $this->host,
            'smtp_port' => $this->port,
            'smtp_user' => $this->username,
            'smtp_pass' => $this->password,
            'mailtype' => 'html',
            'charset' => 'UTF-8',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
		$this->email->from($email_template['content']->email_from, PROJECT_TITLE);
        $this->email->to($data['user']->user_email_id, $to_email );
        $this->email->subject($email_template['content']->subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        }else{
			
		
            return false;
        }
    }
	
    public function send_status_email($user_id,$status){
        if($status == 'ACTIVE'){
         $module = 'AGENT_DEACTIVATION';
         }else{
         $module = 'AGENT_ACTIVATION';
         }       
        $email_template['data'] = $this->get_email_template_new($module);
        $email_template['user_data']=$this->db->get_where('user_details',array('user_id'=>$user_id))->row();  

        $message_temp=$this->load->view('email_tem/register_mail',$email_template,true);     
        // debug($message_temp);exit();
        $this->sendmail_trip($email_template['user_data']->user_email,$email_template['data']['content']->subject,$message_temp,$email_template['data']['content']->Bcc_email);
    }


    public function get_email_acess() {
        $this->db->where('status', "ACTIVE");
        return $this->db->get('email_access');
    }

 //for Flight Voucher
    public function sendmail_flightVoucher($data) {
         //echo '<pre/>';print_r($data);exit;
        $message = $data['message'];
        $to = $data['to'];
        $subject = str_replace("{%%PNR%%}", $data['pnr_no'], 'Tripglobo - Flight Voucher - {%%PNR%%}');
        $data['email_access'] = $this->get_email_access();
        // print_r($data['email_access']);
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            //'protocol' => 'mail',
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        // echo "<pre>";print_r($config);exit;
       
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        //$this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->from($data['email_access']->username, 'Tripglobo');
        $this->email->to($to);
        $this->email->bcc($data['email_access']->username);
        $this->email->subject($subject);
        $this->email->message($message);
      // echo 'email: <pre/>';print_r($this->email);
        if ($this->email->send()) {
            return 'true';
        }else{
            return 'false';
        }
    }

    public function sendbookingconfirmation($data)
    {
         $data1 = $this->db->get('email_access')->row();
        //stdClass Object ( [email_access_id] => 1 [smtp] => smtp [host] => ssl://smtp.gmail.com [port] => 465 [username] => provab.technosoft2016@gmail.com [password] => meneksha2042 [status] => 1 )
         $email_type = 'Booking_Confirmation';
        
        $email_template = $this->get_email_template($email_type);
        //print_r($data);exit;

        // $message = $email_template['header'].$email_template['content']->message.$email_template['footer'];
        $message = $email_template['content']->message;
        $message = str_replace("{%%FIRST_NAME%%}", $data['user_name'], $message);
        $message = str_replace("{%%HOLIDAY_NAME%%}", $data['holiday_name'], $message); 
        $message = str_replace("{%%PACKAGE_DESCRIPTION%%}", $data['description'], $message);
        $message = str_replace("{%%USER_NAME%%}", $data['user_name'], $message); 
        $message = str_replace("{%%USER_CONTACT_NUMBER%%}", $data['user_contact_number'], $message);
        $message = str_replace("{%%NO_OF_NIGHTS%%}", $data['no_of_nights'], $message);
        $message = str_replace("{%%TRAVEL_START_DATE%%}", $data['travel_start_date_from'], $message);
        $message = str_replace("{%%TRAVEL_END_DATE%%}", $data['travel_end_date_to'],$message);
        $message = str_replace("{%%TOTAL_PAYMENT%%}", $data['Total_payment'],$message);
        $message = str_replace("{%%MSG_DESCRIPTION%%}", $data['holiday_desc'], $message); 
        $logo_path=base_url().'/assets/theme_dark/images/logo.png';
        $current_year=date(Y);
        $message = str_replace("{%%IMG_LOGO%%}",$logo_path, $message);
        $message = str_replace("{%%YEAR_CURRENT%%}", $current_year, $message);
/*         echo "<pre>jithu" print_r($message);exit();
*/
        $to = $data['user_email'];

        $subject = $email_template['content']->subject;
        $config = Array(
            'protocol' => $data1->smtp,
            //'protocol' => 'mail',
            'smtp_host' => $data1->host,
            'smtp_port' => $data1->port,
            'smtp_user' => $data1->username,
            'smtp_pass' => $data1->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            //'charset' => 'UTF-8',
            'wordwrap' => TRUE
        );
        $fromm='Flightzee';
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        //$this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->from($fromm,'Flightzee');
        $this->email->to($to);
        $bcc_list = array('swadesh.provab@gmail.com',"swadesh");
       // $bcc_list = array('swadesh.provab@gmail.com',$data->username);
        $this->email->bcc($bcc_list);
        $this->email->subject($subject);
        $this->email->message($message);

       //echo 'email: <pre/>';print_r($this->email);
        
        if ($this->email->send()) {
         return 1;
        }else{
            return 0;
        }
    }

   
    function add_new_admin_email($type,$user_id,$email){
    $email_type = 'SUB_ADMIN_CREATE';
        $email_template['data'] = $this->get_email_template_new($email_type);

        $email_template['user_data']=$this->db->get_where('admin_details',array('admin_id'=>$user_id))->row();
        // $email_template['reset_link']=$data['reset_link'];
        $message_temp=$this->load->view('email_tem/register_mail',$email_template,true);
        $this->sendmail_trip($email,$email_template['data']['content']->subject,$message_temp,$email_template['data']['content']->Bcc_email);
    }
    function status_admin_email($type,$user_id,$url='',$user_data){
        $email_template['data'] = $this->get_email_template_new(trim($type));

        $email_template['user_data']=$user_data;
        if ($url!='') {
        $email_template['URL']=$url;            
        }
        // debug($email_template['user_data']->user_email);exit;
        // $email_template['reset_link']=$data['reset_link'];
        $message_temp=$this->load->view('email_tem/register_mail',$email_template,true);
        // debug($message_temp);exit();
        $this->sendmail_trip($email_template['user_data']->user_email,$email_template['data']['content']->subject,$message_temp,$email_template['data']['content']->Bcc_email);
    }
    function group_booking_email($type,$group_code,$remark,$user_data){
        $email_template['data'] = $this->get_email_template_new($type);
        $email_template['user_data']=$user_data;
        $email_template['group_code']=$group_code;
        $email_template['remark']=$remark;
        // $email_template['reset_link']=$data['reset_link'];
        $message_temp=$this->load->view('email_tem/register_mail',$email_template,true);
        // debug($message_temp );exit();
        $this->sendmail_trip($user_data->user_email,$email_template['data']['content']->subject,$message_temp,$email_template['data']['content']->Bcc_email);
    }
    function add_new_staff_email($type,$user_id,$email){
        $email_template['data'] = $this->get_email_template_new($type);
        $email_template['user_data']=$this->db->get_where('user_details',array('user_id'=>$user_id))->row();
        // debug($type);exit;
        // $email_template['reset_link']=$data['reset_link'];
        $message_temp=$this->load->view('email_tem/register_mail',$email_template,true);
        // debug($message_temp);exit();
        $this->sendmail_trip($email,$email_template['data']['content']->subject,$message_temp,$email_template['data']['content']->Bcc_email);
    }
    function user_spcial_trip($type,$id,$val){
        $email_template['data'] = $this->get_email_template_new($type);
        $email_template['user_data']=$this->db->get_where('b2c_special_flight_trip',array('special_trip_id'=>$id))->row();
        // $email_template['reset_link']=$data['reset_link'];
        $message_temp=$this->load->view('email_tem/register_mail',$email_template,true);
        // debug($message_temp);exit();
        // debug($message_temp);exit();
        $this->sendmail_trip($email_template['user_data']->email,$email_template['data']['content']->subject,$message_temp,$email_template['data']['content']->Bcc_email);
    }
      public function sendpromomail($email,$input,$message) {
         $email_template['data'] = $this->get_email_template_new('PROMO_CODE');
         $email_template['data']['content']->email_body = $message;
        $message_temp=$this->load->view('email_tem/register_mail',$email_template,true);
        // debug($message_temp);exit();
        $this->sendmail_trip($email_template['user_data']->email,$input,$message_temp,$email_template['data']['content']->Bcc_email);
    }
    public function sendpromomail_bulk($email,$input,$message) {
        // debug($email);exit();
         $email_template['data'] = $this->get_email_template_new('PROMO_CODE');
         $email_template['data']['content']->email_body = $message;
        $message_temp=$this->load->view('email_tem/register_mail',$email_template,true);
        // debug($message_temp);exit();
        $this->sendmail_trip($email,$input,$message_temp,$email_template['data']['content']->Bcc_email,'bulk');
    }
    function sendmail_trip($toemail,$subject,$message,$bcc='',$bulk=''){
// error_reporting(E_ALL);
        // debug($toemail);exit();
        $email_con=$this->get_email_access();
         require 'PHPMailer/src/Exception.php';
         require 'PHPMailer/src/PHPMailer.php';
         require 'PHPMailer/src/SMTP.php';         
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug  = 0;
            $mail->Mailer     = $email_con->smtp;
            $mail->SMTPAuth   = TRUE;
            $mail->SMTPSecure = $email_con->SMTPSecure;
            $mail->Port       = 587;
            $mail->Host       = $email_con->host;
            $mail->Username   = $email_con->username;
            $mail->Password   = $email_con->password;
            $mail->IsHTML(true);
            if (is_array($toemail) && $bulk=='bulk') {
                foreach ($toemail as $key => $value) {
                    
            $mail->AddAddress($value, "travel-tripgolobo");
                }
            }else{
            $mail->AddAddress($toemail, "travel-tripgolobo");

            }
            // $mail->addBCC("poovarasanprovab@gmail.com",'test@tripglobo.com');

            $mail->addBCC("test@tripglobo.com");
            $mail->SetFrom($email_con->username, "Tripgolobo");
            $mail->SMTPDebug = false;            
            $mail->Subject = $subject;
            $content = $message;
            $mail->MsgHTML($content); 
            // debug($mail->Send());exit();
        // debug($email_con);exit();
            $mail->Send();
            // if($mail->Send()==false) {
            //   return false;
            // } else {
            //   return true;
            // }    
    }
    public function get_email_template_new($email_type) 
    {
        $this->db->where('type',trim($email_type));
        $result = $this->db->get('email_template_new');
        $data['content'] = $result->row();
        // debug($this->db->last_query());
        $this->db->where('email_template_common_id', '1');
        $this->db->where('status', 'ACTIVE');
        $result1 = $this->db->get('email_template_common');
        $result1_v = $result1->row();
        $data['header'] = $result1_v->div_content;
        
        $this->db->where('email_template_common_id', '4');
        $this->db->where('status', 'ACTIVE');
        $result2 = $this->db->get('email_template_common');
        $result2_v = $result2->row();
        $data['footer'] = $result2_v->div_content;
        // debug($email_type);exit;
        return $data;
    }



}
