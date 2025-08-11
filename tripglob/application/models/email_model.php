<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
class Email_Model extends CI_Model {
	private $smtp;
	private $host;
	private $port;
	private $username;
	private $password;
    private $SMTPSecure;
	function __construct()
    {
        parent::__construct();
		$this->get_email_access();
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
		
    }
    
    public function get_email_acess() {
        $this->db->where('status', "ACTIVE");
        return $this->db->get('email_access');
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
	 	// debug($data);exit;
        return $data;
    }
        public function get_email_template_new($email_type) 
    {
        $this->db->where('type', $email_type);
        $result = $this->db->get('email_template_new');
        $data['content'] = $result->row();
        
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
        // debug($data);exit;
        return $data;
    }
	public function user_sendmail_forgot_password($data)
	{
		$email_type = 'FORGET_PASSWORD';
		$email_template['data'] = $this->get_email_template_new($email_type);
        $email_template['user_data']=$data['user_data'];
        $email_template['reset_link']=$data['reset_link'];
        $message_temp=$this->load->view('theme_dark/email_tem/register_mail',$email_template,true);
        $this->sendmail_trip($data['user_data']->user_email_id,$email_template['data']['content']->subject,$message_temp,$email_template['data']['content']->Bcc_email);
	}
	  public function sendmail_agentVerification($data,$email_type) {

		$email_template = $this->get_email_template($email_type);
		
		$message = $email_template['header'].$email_template['content']->message.$email_template['footer'];
        $to_email = $email_template['content']->to_email;
      
         
        $message = str_replace("{%%FIRSTNAME%%}", $data['user_data']->user_name, $message);
        $message = str_replace("{%%VERIFICATION_CODE%%}", $data['email_opt_number'], $message);
		 
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
// echo "<pre>"; print_r($config); exit();
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
		$this->email->from($email_template['content']->email_from, PROJECT_TITLE);
        $this->email->to($data['user_data']->user_email_id, $to_email );
        $this->email->subject($email_template['content']->subject);
        $this->email->message($message);
        if ($this->email->send()) {
            //echo $this->email->print_debugger();
            return true;
        }else{
			 //echo $this->email->print_debugger();
            // exit();
		
            return false;
        }
    }
	
	  public function sendmail_employeeVerification($data,$email_type) {

		$email_template = $this->get_email_template($email_type);
		
		$message = $email_template['header'].$email_template['content']->message.$email_template['footer'];
        $to_email = $email_template['content']->to_email;
      
         
        $message = str_replace("{%%FIRSTNAME%%}", $data['user_data']->c_p_name, $message);
        $message = str_replace("{%%VERIFICATION_CODE%%}", $data['email_opt_number'], $message);
        $message = str_replace("{%%VER_URL%%}", $data['confirm_url'], $message);
		 
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
        $this->email->to($data['user_data']->user_email_id, $to_email );
        $this->email->subject($email_template['content']->subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        }else{			
		
            return false;
        }
    }
	
	  public function sendmail_userconfirmation($data,$email_type) {
        
		$email_template = $this->get_email_template($email_type);
		$message = $email_template['header'].$email_template['content']->message.$email_template['footer'];
        $to_email = $email_template['content']->to_email;
        $message = str_replace("{%%FIRSTNAME%%}", $data['user_data']->user_name, $message);
        $message = str_replace("{%%CONFIRMLINK%%}", $data['confirm_link'], $message);
        //debug($data['user_data']->user_email_id);exit;

        /*$config = array(
            'protocol' => $this->smtp,
            'smtp_host' => $this->host,
            'smtp_port' => $this->port,
            'smtp_user' => $this->username,
            'smtp_pass' => $this->password,
            'mailtype' => 'html',
            'charset' => 'UTF-8',
            'wordwrap' => TRUE
        );
        // echo "<pre/>";print_r($config);exit;
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
		$this->email->from($email_template['content']->email_from, PROJECT_TITLE);
        $this->email->to($data['user_data']->user_email_id, $to_email );
        $this->email->subject($email_template['content']->subject);
        $this->email->message($message);
       
        if ($this->email->send()) {
			// echo $this->email->print_debugger();
            return true;
        }else{
			// echo $this->email->print_debugger();
            return false;
        }*/
        include_once('assets/PHPMailer/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host     = $this->host;
        $mail->SMTPAuth = true;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->SMTPSecure =$this->SMTPSecure;
        $mail->Port     = $this->port;

        $mail->setfrom($this->username, 'TripGlobo');
        //$mail->addreplyto('info@example.com', 'CodexWorld');

        // Add a recipient
        $mail->addaddress($data['user_data']->user_email_id);

        // Add cc or bcc 
        //$mail->addcc('cc@example.com');
        //$mail->addbcc('bcc@example.com');

        // Email subject
        $mail->Subject = $email_template['content']->subject;

        // Set email format to HTML
        $mail->isHTML(true);

        // Email body content
        

        $mail->Body = $message;
          //debug( $message);exit();
        // Send email
        if(!$mail->send()){
           // echo 'Message could not be sent.';
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        }else{
            //echo 'Message has been sent';
            return true;
        }
    }
    public function twoStepVerifyEmail_send($data,$email_type) {
		$randomNumber = $data['twoStepRandomNumber'];
		$email_template = $this->get_email_template($email_type);
		$message = $email_template['header'].$email_template['content']->message.$email_template['footer'];
        $to_email = $email_template['content']->to_email;
      

       $message = str_replace("{%%FIRSTNAME%%}", $data['user_data']->user_name, $message);
        $message = str_replace("{%%VERIFICATION_CODE%%}", $randomNumber, $message); 
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
        $this->email->to($data['user_data']->user_email_id, $to_email );
        $this->email->subject($email_template['content']->subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        }else{
			
		
            return false;
        }
    }
    
    //for Flight Voucher
    public function sendmail_flightVoucher($data) {
        $message = $data['message'];
		 echo '<pre/>';print_r($message);exit;
        $to = $data['to']; 
          //  $to ='rahulpandey.provab@gmail.com';       
        $subject = str_replace("{%%PNR%%}", $data['pnr_no'], 'TripGlobo  - Flight Voucher - {%%PNR%%}');

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
        
        //echo '<pre>';print_r($config);exit();
       
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        //$this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->from($data['email_access']->username, 'TripGlobo ');
        $this->email->to($to);
        $this->email->addaddress('poovarasan.g@provabmail.com');
      
        $this->email->subject($subject);
        $this->email->message($message);
      // echo 'email: <pre/>';print_r($this->email);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }   
    
    
        public function sendmail_hotelVoucher($data) {
		// echo '<pre/>';print_r($data);exit;
        $message = $data['message'];
        $to = $data['to'];

        $subject = str_replace("{%%PNR%%}", $data['pnr_no'], 'TripGlobo  - Hotel Voucher - {%%PNR%%}');

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
       
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        //$this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->from($data['email_access']->username, 'TripGlobo ');
        $this->email->to($to);
        $this->email->bcc($data['email_access']->username);
        $this->email->subject($subject);
        $this->email->message($message);
       //echo 'email: <pre/>';print_r($this->email);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }
    public function sendmail_ActivityTransferVoucher($data,$title='') {
        // echo '<pre/>';print_r($data);exit;
        $message = $data['message'];
        $to = $data['to'];
      
       // $to = 'elavarasi.k@provabmail.com';

        $subject = PROJECT_TITLE." - ".$title." Voucher - ".$data['pnr_no']."";
        $config = array(
            'protocol' => $this->smtp,
            'smtp_host' => $this->host,
            'smtp_port' => $this->port,
            'smtp_user' => $this->username,
            'smtp_pass' => $this->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        //$this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->from($this->username, PROJECT_TITLE);
        $this->email->to($to);
        //$this->email->bcc($this->username);
        if($this->admin_bcc_email_id!=''){
            $this->email->bcc($this->admin_bcc_email_id);    
        }
        if($this->admin_cc_email_id!=''){
         $this->email->cc($this->admin_cc_email_id);       
        }
        
        $this->email->subject($subject);
        $this->email->message($message);
        
        if ($this->email->send()) {
            return 1;
        }else{
           
            return 0;
        }
    }

    public function sendmail_quotation($data,$email_type) {
        $data['flight_result'] = json_decode($data['quotData'], true);
        $template = $this->load->view(PROJECT_THEME.'/flight/quotation_template', $data, TRUE);
        //$template = '';
        $email_template = $this->get_email_template($email_type);
        $to_email = $data['to_mail'];
        $message = $email_template['header'].$email_template['content']->message.$email_template['footer'];
        $message = str_replace("{%%DATA%%}", $template, $message);
        //$message = str_replace("{%%CONFIRMLINK%%}", $data['confirm_link'], $message);
       
        //print_r($message); exit;
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
        //echo "<pre/>";print_r($config);exit;
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($email_template['content']->email_from, PROJECT_TITLE);
        $this->email->to($data['to_mail']);
        $this->email->subject($email_template['content']->subject);
        $this->email->message($message);
       
        if ($this->email->send()) {
             echo $this->email->print_debugger();
            return true;
        }else{
             echo $this->email->print_debugger();
            return false;
        }
    }

    public function sendmail_thankyoutocust($data1)
     {
        $data = $this->db->get('email_access')->row();
        //stdClass Object ( [email_access_id] => 1 [smtp] => smtp [host] => ssl://smtp.gmail.com [port] => 465 [username] => provab.technosoft2016@gmail.com [password] => meneksha2042 [status] => 1 )
         $email_type = 'HOLIDAY_ENQUERY_THANKYOU';
        
        $email_template = $this->get_email_template($email_type);

        //print_r($data);exit;
        $myDate=$data1['enquired_date'];
        $newDate=date('Y-m-d',strtotime($myDate));
        // $message = $email_template['header'].$email_template['content']->message.$email_template['footer'];
        $message = $email_template['content']->message;
        $message = str_replace("{%%FIRST_NAME%%}", $data1['user_name'], $message);
         $message = str_replace("{%%USER_NAME%%}", $data1['user_name'], $message);
        $message = str_replace("{%%HOLIDAY_NAME%%}", $data1['holiday_name'], $message); 
        $message = str_replace("{%%DEPARTURE_DATE%%}", $newDate,$message);
        $message = str_replace("{%%USER_CONTACT_NUMBER%%}", $data1['user_contact_number'],$message);
        $message = str_replace("{%%PACKAGE_DESCRIPTION%%}", $data1['package_description'],$message);
        $message = str_replace("{%%TOTAL_PAYMENT%%}", $data1['booking_price'],$message);
        $message = str_replace("{%%MSG_DESCRIPTION%%}", $data1['holiday_desc'], $message); 
        $logo_path=base_url().'/assets/theme_dark/images/logo.png';
        $current_year=date(Y);
        $message = str_replace("{%%IMG_LOGO%%}",$logo_path, $message);
        $message = str_replace("{%%YEAR_CURRENT%%}", $current_year, $message);
 
        $to = $data1['user_email'];
        $subject = $email_template['content']->subject;
        $config = Array(
            'protocol' => $data->smtp,
            //'protocol' => 'mail',
            'smtp_host' => $data->host,
            'smtp_port' => $data->port,
            'smtp_user' => $data->username,
            'smtp_pass' => $data->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            //'charset' => 'UTF-8',
            'wordwrap' => TRUE
        );
        $fromm='TripGlobo';
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        //$this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->from($fromm,'TrekBuyFly');
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
    
public function b2bOtoSend($data)
	{
		$email_type = 'TWO_STEP_VERIFICATION';
		$email_template['data'] = $this->get_email_template_new($email_type);
        $email_template['user_data']=$data['user_data'];
        $email_template['email_opt_number']=$data['otp'];
         $message_temp=$this->load->view('theme_dark/email_tem/register_mail',$email_template,true);
		// debug($message_temp);exit;
        $this->sendmail_trip($data['user_data']->user_email_id,$email_template['data']['content']->subject,$message_temp,$email_template['data']['content']->Bcc_email);
		
	}
    function sendmail_trip($toemail,$subject,$message,$bcc=''){
        // error_reporting(E_ALL);
         require 'PHPMailer/src/Exception.php';
         require 'PHPMailer/src/PHPMailer.php';
         require 'PHPMailer/src/SMTP.php';
         
         
             
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug  = 0;
            $mail->Mailer     = $this->smtp;
            $mail->SMTPAuth   = TRUE;
            $mail->SMTPSecure = $this->SMTPSecure;
            $mail->Port       = 587;
            $mail->Host       = $this->host;
            $mail->Username   = $this->username;
            $mail->Password   = $this->password;
            $mail->IsHTML(true);
            $mail->AddAddress($toemail, "travel-tripgolobo");
            $mail->addBCC("test@tripglobo.com");
             $mail->SetFrom("Travel@tripglobo.com", "Tripgolobo");
             // $mail->addBCC("poovarasanprovab@gmail.com");
            $email->SMTPDebug = false;            
            $mail->Subject = $subject;
            $content = $message;
            $mail->MsgHTML($content);
            $mail->Send(); 
            // if(!$mail->Send()) {
              // echo "Error while sending Email.";
            //     return false;
            // } else {
            //   return true;
            // }
      
      
      
      
      
      
      
    
    }

} 

?>
