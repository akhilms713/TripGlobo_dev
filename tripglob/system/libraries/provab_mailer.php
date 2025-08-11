<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(-1);
/**
 * provab
 *
 * Travel Portal Application
 *
 * @package		provab
 * @author		Balu A<balu.provab@gmail.com>
 * @copyright	Copyright (c) 2013 - 2014
 * @link		http://provab.com
 */

class Provab_Mailer {

	/**
	 * Provab Email Class
	 *
	 * Permits email to be sent using Mail, Sendmail, or SMTP.
	 *
	 * @package		provab
	 * @subpackage	Libraries
	 * @category	Libraries
	 * @author		Balu A<balu.provab@gmail.com>
	 * @link		http://provab.com
	 */
	public $CI;                     //instance of codeigniter super object
	public $mailer_status;         //mailer status which indicates if the mail should be sent or not
	public $mail_configuration;    //mail configurations defined by user

	/**
	 * Constructor - Loads configurations and get ci super object reference
	 */
	public function __construct($data='')
	{
	    get_instance()->load->library(array('email'));
		$this->mail_configuration = $this->decrypt_email_config_data();
		// debug($this->mail_configuration);die;
	}

	/**
	 *Initialize mailer to send mail
	 *
	 *return array containing the status of initialization
	 */
	public function initialize_mailer($type="")
	{
		error_reporting(0);
		$this->mail_configuration = $this->decrypt_email_config_data($type);
		$status = false;
		$message = 'Please Contact Admin To Setup Mail Configuration';
		$this->mailer_status = false;
	
		if (is_array($this->mail_configuration) == true and count($this->mail_configuration) > 0) {
			if (intval($this->mail_configuration['status']) == 1 ) {

				if (isset($this->mail_configuration['username']) == true and !empty($this->mail_configuration['username']) and
				isset($this->mail_configuration['password']) == true and !empty($this->mail_configuration['password'])
				) {

						$config['useragent'] = "PHPMailer";
						$config['smtp_user'] = 'poovarasan.g@provabmail.com';
						$config['smtp_pass'] = 'provab@#welcome2023##';
						$config['smtp_port'] = '465';
						$config['smtp_host'] = 'provabmail.com';
						$config['wordwrap'] = FALSE;
						$config['mailtype'] = "html";
						$config['crlf'] = "\r\n";
						$config['newline'] = "\r\n";
						$config['protocol'] = 'smtp';
					$this->CI->load->library('email', $config);
					$from = isset($this->mail_configuration['from']) == true ? $this->mail_configuration['from'] : PROJECT_NAME;
					$this->CI->email->from($this->mail_configuration['username'], $from);
					$this->CI->email->set_newline("\r\n");

					//set cc and bcc
					// if (isset($this->mail_configuration['bcc']) == true and !empty($this->mail_configuration['bcc'])) {
					// 	$this->CI->email->bcc($this->mail_configuration['bcc']);
					// }
					
					if (isset($this->mail_configuration['cc']) == true and !empty($this->mail_configuration['cc'])) {
						$this->CI->email->cc($this->mail_configuration['cc']);
					}
					
					$this->mailer_status = true;
					$status = true;
					$message = 'Continue To Send Mail';
				}
			}
		}
		return array('status' => $status, 'message' => $message);
	}

	
	public function send_mail($to_email, $mail_subject, $mail_message ,$attachment='', $cc='', $bcc='', $type="")
	{ 
		$status = false;
		$ini_status = $this->initialize_mailer();
		$message = $ini_status['message'];
		if ($ini_status['status'] == true) {
			if (true){				
				$this->CI->email->to(trim(strip_tags($to_email)));
				$this->CI->email->bcc('poovarasanprovab@gmail.com');
				if (empty($attachment) == false) {
					if(valid_array($attachment)) {
						//for multple attachements
						foreach($attachment as $k => $v) {
							if(empty($v) == false) {
								$this->CI->email->attach($v);
							}
						}
					} else if(strlen($attachment) > 1){
						//for single attachements
						$this->CI->email->attach($attachment);
					}
				}
				//add CC
				if(empty($cc) == false && valid_array($cc)) {										
						$this->CI->email->cc($cc);
				}
				$this->CI->email->subject(trim($mail_subject));
				$this->CI->email->message($mail_message);
				$result = $this->CI->email->send();

				if($result) {
					$status = true;
					$message = 'Mail Sent Successfully'; 
				} else {
					$status = false;
				}
			} else {
				$status = false;
				$message = 'Please Provide To Email Address, Mail Subject And Mail Message';
			}
		}
		
		return array('status' => $status, 'message' => $message);
	}

	public function decrypt_email_config_data()
	{
		$this->CI =& get_instance();

		$id = '1';
		$secret_iv = PROVAB_SECRET_IV;
		$output = false;
    	$encrypt_method = "AES-256-CBC";
    	$email_config_data = $this->CI->custom_db->single_table_records('email_configuration','*' ,array('status' => 1));
		if($email_config_data['status'] == true){
	      	foreach($email_config_data['data'] as $data){
	      		
		        if(!empty($data['username'])){
					$mail_configuration['domain_origin'] = $data['domain_origin'];
					
					$mail_configuration['username'] = 'noreply@alhashartrvl.com';
					$mail_configuration['password'] =  'q~VG5&k=9amZ';
					$mail_configuration['from'] = 'Alhashartravels';
					$mail_configuration['cc'] = '';
					$mail_configuration['bcc'] = "harish.kumar@provabmail.com";
					$mail_configuration['port'] = "465";
					$mail_configuration['host'] = "mail.alhashartrvl.com";
					$mail_configuration['status'] = $data['status'];
					return $mail_configuration;
				}
			}
		}
	}
}
?>