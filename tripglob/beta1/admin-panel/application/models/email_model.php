<?php
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
		return $result = $query->row();	
		// $this->smtp = $result->smtp;
		// $this->host = $result->host;
		// $this->port = $result->port;
		// $this->username = $result->username;
		// $this->password = $result->password;
		
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
	
    public function send_status_email($id,$status){
        if($status == 'ACTIVE') $module = 'add_user_active';
        else $module = 'user_deactivate';
       
        $message = $this->db->get_where('email_template',array('email_type' => $module))->row();
        $user = $this->db->get_where('user_details',array('user_id' => $id))->row();
        $data = $this->db->get('email_access')->row();
        //echo '<pre>'; var_dump($message); exit;
        $subject = str_replace("{%%USER%%}", $user->user_name, $message->subject);
        $messagenew = str_replace("{%%USER%%}", $user->user_name, $message->message);
        $messagenew = str_replace("{%%FIRSTNAME%%}", $user->user_name, $messagenew);
        $messagenew = str_replace("{%%WEB_URL%%}", WEB_URL , $messagenew);
        if($data){
        $config = Array(
            'protocol' => $data->smtp,
            'smtp_host' => $data->host,
            'smtp_port' => $data->port,
            'smtp_user' => $data->username,
            'smtp_pass' => $data->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);

        $this->email->set_newline("\r\n");
        $this->email->from($message->email_from);
        //$this->email->to($user->user_email);

        $this->email->to('sudhinprovab@gmail.com');
        $this->email->subject($subject);
        $this->email->message($messagenew);
          return $this->email->send();
        //echo $this->email->print_debugger();exit ;




    }
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

     public function sendpromomail($email,$input,$message) {
        // echo $email;
        // echo $input;
        // echo $message;
        // echo "srgsdg";
        // exit;
         //echo '<pre/>';print_r($data);exit;
        $message = $message;
        $to = $email;
        $subject = $input;
        $data['email_access'] = $this->get_email_access();
        // print_r($data['email_access']);exit();
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
    function sendmail_trip($email,$subject,$message,$bcc=''){

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
        $mail->addaddress('poovarasan.g@provabmail.com');
        // $mail->addcc('poovarasan.g@provabmail.com');

        $mail->Subject = $subject;       
        $mail->isHTML(true);

        // Email body content       

        $mail->Body = $message;
        
        // Send email
        if(!$mail->send()){
            
            return false;
        }else{
           
            return true;
        }
    
    }


}
