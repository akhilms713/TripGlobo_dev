<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
error_reporting(0);

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //DO : Setting Current website url in session, 
        //Purpose : For keeping the page on login/logout.
        //Begin
        /* 		$current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
          $current_url = WEB_URL.$this->uri->uri_string(). $current_url;
          $url =  array(
          'continue' => $current_url,
          );
          $this->session->set_userdata($url); */
        //End
        $this->load->model('home_model');
        $this->load->model('account_model');
        $this->load->model('email_model');
        $this->load->model('verification_model');
    }

    public function index() {
        if ($this->session->userdata('user_type') == '1') {
            redirect(WEB_URL . 'dashboard');
        } else if ($this->session->userdata('user_type') == '2') {
            redirect(WEB_URL);
        } else if ($this->session->userdata('user_type') == '4') {
            redirect(WEB_URL . 'dashboard');
        }
        $data['country_code'] = $this->general_model->getCountryList();
        $this->load->view(PROJECT_THEME . '/common/login_employee', $data);
    }

    public function create_with_email() {
        //echo '<pre/>';print_r($_POST);exit;
        $user_type_name = $_POST['user_type_name'];
        $user_type_id = $this->account_model->get_usertype_id($user_type_name);
        $count = $this->account_model->isRegistered($this->input->post('email'), $user_type_id)->num_rows();
        if ($count == 0) {

            $user_id = $this->account_model->createUsers_fr_guest($_POST, $user_type_id);

            $email_opt_number = $this->generate_random_key(4, 'SPECIAL');
            $this->account_model->assignDefaultverfication($user_id, $user_type_id, $email_opt_number);
            $user_data = $this->general_model->get_user_details($user_id, $user_type_id);
            $this->send_confirmation_email($user_id, $user_type_id, 'USER_CONFIRMAIOTN_LINK', $email_opt_number);

            $data['s_session_id'] = $_POST['session_id'];
            $data['user_id'] = $user_id;
            $data['user_type_id'] = $user_type_id;
            $curll = base64_encode(json_encode($data));
            $response = array(
                'user_logs_status' => 'Now You can continue the booking as a Guest.',
                'secdata' => $curll
            );
        } else {

            $user = $this->account_model->isRegistered($this->input->post('email'), $user_type_id)->row();
            $data['s_session_id'] = $_POST['session_id'];
            $data['user_id'] = $user->user_id;
            $data['user_type_id'] = $user->user_type_id;
            $curll = base64_encode(json_encode($data));
            $response = array(
                'user_logs_status' => 'Now You can continue the booking as a Guest',
                'secdata' => $curll
            );
        }
        echo json_encode($response);
    }

    public function create_with_email_checkout() {
        //echo '<pre/>';print_r($_POST);exit;
        $user_type = $this->session->userdata('user_type');
        if ($user_type==1) {
            $user_type_name='B2B';
        }elseif ($user_type==4) {
            $user_type_name='STAFF';            
        }else{
            $user_type_name='B2C';
        }       
        $user_type_id = $this->account_model->get_usertype_id($user_type_name);
        $count = $this->account_model->isRegistered($this->input->post('email'), $user_type_id)->num_rows();
        // debug($this->input->post('email'));
        if ($count == 0) {

            $user_id = $this->account_model->createUsers_fr_guest($_POST, $user_type_id);

            $email_opt_number = $this->generate_random_key(4, 'SPECIAL');
            $this->account_model->assignDefaultverfication($user_id, $user_type_id, $email_opt_number);
            $user_data = $this->general_model->get_user_details($user_id, $user_type_id);
            $this->send_confirmation_email($user_id, $user_type_id, 'USER_CONFIRMAIOTN_LINK', $email_opt_number);

            $data['s_session_id'] = $_POST['session_id'];
            $data['user_id'] = $user_id;
            $data['user_type_id'] = $user_type_id;
            $curll = base64_encode(json_encode($data));
            $response = array(
                'user_logs_status' => 'Now You can continue the booking as a Guest.',
                'secdata' => $curll
            );
        } else {

            $user = $this->account_model->isRegistered($this->input->post('email'), $user_type_id)->row();
            // debug($user);exit;
            $data['s_session_id'] = $_POST['session_id'];
            $data['user_id'] = $user->user_id;
            $data['user_type_id'] = $user->user_type_id;
            $curll = base64_encode(json_encode($data));
            $response = array(
                'user_logs_status' => 'Now You can continue the booking as a Guest',
                'secdata' => $curll
            );
        }
        return $data;
    }

    public function send_mail() {
        $this->load->library('email');
        $to_email = 'pintuprovab01@gmailcom.com';
        $from_email = 'xyz@gmail.com';

        $config = array(
            'protocol' => 'gsmtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'maheshwara2044@gmail.com',
            'smtp_pass' => '123@provab',
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
            'mailtype' => 'html'
        );

        $this->email->initialize($config);

        $this->email->from($from_email);
        $this->email->to($to_email);
        $this->email->subject('Test mail send');
        $this->email->message('Test Mail');

        if ($this->email->send()) {
            echo "send";
        } else {
            echo "error";
        }
    }

    public function create() {

        $user_type_name = $_REQUEST['user_type_name'];  //B2C or B2B
        $user_type_id = $this->account_model->get_usertype_id($user_type_name);
        $count = $this->account_model->isRegistered(trim($this->input->post('email')), $user_type_id)->num_rows();
        if ($count == 0) {
            
            if(trim($this->input->post('send_otp')) == 1){
                $otp = $this->check_validate_otp_b2c($_REQUEST);
                $response = array(
                    'status' => 2,
                    'success' => 'true',
                    'msg' => $otp,
                );
                
            }else{
                
                $sended_otp = $this->input->post('sended_otp');
                $enter_otp = $this->input->post('enter_otp');
                $enter_otp = md5(json_encode(base64_encode(json_encode(md5($enter_otp)))));
                
                if($enter_otp != $sended_otp){
                    
                    $response = array(
                        'status' => 4,
                        'success' => 'true',
                        'msg' => 'Enter Correct OTP',
                    );
                    
                }else{
                   $user_id = $this->account_model->createUsers($_REQUEST, $user_type_id);
                    $user_session = array(            
                        'user_id' => $user_id,
                        'user_type' => $user_type_id
                    );           
                    $email_opt_number = $this->generate_random_key(4, 'SPECIAL');
                    $this->account_model->assignDefaultverfication($user_id, $user_type_id, $email_opt_number);//insert data
                    $user_data = $this->general_model->get_user_details($user_id, $user_type_id);            
                    $this->send_confirmation_email($user_id, $user_type_id, 'USER_CONFIRMAIOTN_LINK', $email_opt_number);
                    $response = array(
                        'status' => 3,
                        'success' => 'true',
                        'msg' => 'Success!',
                        'emailid' => $user_data->user_email_id
                    );    
                }
                
            }
            
        } else {
            $response = array(
                'status' => 0,
                'success' => 'false',
                'msg' => 'That email address is already in use. Please log in.'
            );
        }
        
        echo json_encode($response);
    }

    public function check_email_exist() {
        if (count($_POST) > 0) {
            $user_type_name = 'B2C';
            $user_type_id = $this->account_model->get_usertype_id($user_type_name);
            $count = $this->account_model->isRegistered($this->input->post('email'), $user_type_id)->num_rows();
            if ($count > 0) {
                echo "false";
                exit;
            } else {
                echo "true";
                exit;
            }
        }
    }

    public function saveDeposit() {
        // echo "<pre/>";print_r($this->input->post('check_number'));exit();
        $data['user_type'] = $user_type = $this->session->userdata('user_type');
        $data['user_id'] = $user_id = $this->session->userdata('user_id');

        $type = $this->input->post('banking_types');

        if (isset($_FILES["slip"]["name"]) && $_FILES["slip"]["name"] != '') {
            $logo_image = explode(".", $_FILES["slip"]["name"]);
            $newlogoname = date('YmdHis') . rand(1, 9999999) . '.' . end($logo_image);
            $tmpnamert = $_FILES['slip']['tmp_name'];

            move_uploaded_file($tmpnamert, 'admin-panel/uploads/deposit/slip_' . $newlogoname);

            $transaction_slip = WEB_URL . 'admin-panel/uploads/deposit/slip_' . $newlogoname;
        } else {
            $transaction_slip = '';
        }

        if ($type == 'banking') {
            $data1 = array(
                'user_id' => $user_id,
                'amount' => $this->input->post('amount'),
                'deposited_date' => $this->input->post('date'),
                'bank_name' => $this->input->post('bank_name'),
                'bank_branch' => $this->input->post('bank_branch'),
                'bank_city' => $this->input->post('bank_city'),
                'remarks' => $this->input->post('remarks'),
                'deposit_mode' => $type,
                'deposit_slip'=>$transaction_slip,
            );
        }
        if ($type == 'cheque') {
            $data1 = array(
                'user_id' => $user_id,
                'amount' => $this->input->post('amount'),
                'cheque_date' => $this->input->post('date'),
                'cheque_number' => $this->input->post('check_number'),
                'remarks' => $this->input->post('remarks'),
                'deposit_mode' => $type,
                'deposit_slip'=>$transaction_slip,
                
            );
        }
        $amount = $this->input->post('amount');
        $deposit_date = $this->input->post('deposited_date');
        $remark = $this->input->post('remarks');

        //	echo "<pre/>";print_r($data1);exit("qwqwdqd");

        $this->account_model->saveDeposit_model($data1);

        echo "<script>
            alert('Deposite Request Sent.');
            </script>";
        redirect(WEB_URL . 'dashboard/deposit');
    }

    public function fileupload() { {
            $status = "";
            $msg = "";
            $file_element_name = 'userfile';

            if ($status != "error") {
                $config['upload_path'] = 'application/uploads/deposit_list';
                $config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf';
                $config['max_size'] = 1024 * 8;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($file_element_name)) {
                    $status = 'error';
                    $msg = $this->upload->display_errors('', '');
                } else {
                    $data = $this->upload->data();
                    $image_path = $data['full_path'];
                    if (file_exists($image_path)) {
                        $status = "success";
                        $msg = "File successfully uploaded";
                        if (($pos = strpos($image_path, 'application')) !== false) {
                            $new_str = 'a' . substr($image_path, $pos + 1);
                        } else {
                            $new_str = get_last_word($image_path);
                        }


                        $this->account_model->FileUpload($new_str);
                        //redirect(WEB_URL.'dashboard/deposit');
                    } else {
                        $status = "error";
                        $msg = "Something went wrong when saving the file, please try again.";
                    }
                }
                @unlink($_FILES[$file_element_name]);
            }
            echo json_encode(array('status' => $status, 'msg' => $msg));
        }
    }

    public function agent_create() {
        // echo "<pre>"; print_r($_POST); exit();
        $user_type_name = $_POST['user_type_name'];
        $user_type_id = $this->account_model->get_usertype_id($user_type_name);
        $count_vs = $this->account_model->isRegistered_cancel($this->input->post('email'), $user_type_id)->num_rows();
        if ($count_vs <= 0) {

            $count = $this->account_model->isRegistered($this->input->post('email'), $user_type_id)->num_rows();
              
            if ($count == 0) {

                $user_id = $this->account_model->createUsers_agent($_POST, $user_type_id, $_FILES);
                if ($user_id == 'invalid_image') {
                    $response = array(
                        'status' => '0',
                        'success' => 'false',
                        'msg' => 'Invalid file type. Only JPEG, JPG, GIF and PNG types are accepted.'
                    );
                    echo json_encode($response);
                    exit();
                }

                $email_opt_number = $this->generate_random_key(4, 'SPECIAL');
// debug($email_opt_number);exit;
                // $mobile_opt_number = $this->generate_random_key(4, 'SPECIAL');
                $this->account_model->assignDefaultverfication($user_id, $user_type_id, $email_opt_number);
                $this->account_model->initializeAccountInfo_model($user_id);
                // debug($user_type_id);exit;  
                if ($user_type_id == 4) {
                    $this->send_employeeverification_email($user_id, $user_type_id, 'EMPLOYEE_VERIFICATION_CODE', $email_opt_number);
                } else {

                    $this->send_verification_email($user_id, $user_type_id, 'AGENT_VERIFICATION_CODE', $email_opt_number);
                }
                //$this->send_mobileVerification($user_id, $int_mobile_num, $mobile_opt_number);
                $user_data = $this->general_model->get_user_details($user_id, $user_type_id);
                // debug($user_data);exit;
                if ($user_type_id == 4) {
                    $response = array(
                        'status' => '1',
                        'success' => 'true',
                        'msg' => 'Success!',
                        'rid' => $user_data->user_id,
                        'fname' => $user_data->user_name,
                        'verifyid' => $user_data->verification_code,
                        'profile_photo' => $user_data->profile_picture,
                        'url' => WEB_URL . 'dashboard/employee_list'
                    );
                } else {
                    $response = array(
                        'status' => '1',
                        'success' => 'true',
                        'msg' => 'Success!',
                        'rid' => $user_data->user_id,
                        'fname' => $user_data->user_name,
                        'verifyid' => $user_data->verification_code,
                        'profile_photo' => $user_data->profile_picture
                    );
                }
            } else {
                $response = array(
                    'status' => '0',
                    'success' => 'false',
                    'msg' => 'That email address is already in use. Please log in.'
                );
            }
        } else {

            $response = array(
                'status' => '0',
                'success' => 'false',
                'msg' => "Your Account Has Been Canceled Already. If you want to continue the same account. Kindly contact to admin."
            );
        }
        echo json_encode($response);
    }

    public function verification($vid = '') {


        $check_agent_id = $this->session->userdata('user_id');
        if ($check_agent_id == "" && $vid != '') {
            $data['vid'] = $vid;
            $get_acc_details = $this->account_model->verifyAgentContactDetails_v2($vid)->row();
            if ($get_acc_details->status == 'PENDING') {
                $this->load->view(PROJECT_THEME . '/security/verfication_user', $data);
            } else {
                redirect(WEB_URL);
            }
        } else {
            redirect(WEB_URL);
        }
    }

    public function send_verification_email($user_id, $user_type_id, $email_type, $email_opt_number, $mobile_opt_number = '') {

        $email_['email_opt_number'] = $email_opt_number;
        $email_['mobile_opt_number'] = $mobile_opt_number;
        $email_['user_data'] = $this->general_model->get_user_details($user_id, $user_type_id);

        $email_['data']=$this->email_model->get_email_template_new($email_type);
        // debug($email_);exit;
        $message_temp=$this->load->view('theme_dark/email_tem/register_mail',$email_,true);
        // debug($email_);exit;
        $this->email_model->sendmail_trip($email_['user_data']->user_email,$email_['data']['content']->subject,$message_temp,$email_['data']['content']->Bcc_email);
        
    }

    public function send_employeeverification_email($user_id, $user_type_id, $email_type, $email_opt_number, $mobile_opt_number = '') {

        $data['email_opt_number'] = $email_opt_number;
        $data['mobile_opt_number'] = $mobile_opt_number;
        $data['user_data'] = $this->general_model->get_user_details($user_id, $user_type_id);
        $data['verification'] = $this->general_model->get_verification_details($user_id);
        $data['confirm_url'] = $data['verification']->verification_url;
        $this->email_model->sendmail_employeeVerification($data, $email_type);
    }

    public function send_confirmation_email($user_id, $user_type_id, $email_type, $email_opt_number, $mobile_opt_number = '') {
        $data['email_opt_number'] = $email_opt_number;
        $data['mobile_opt_number'] = $mobile_opt_number;
        $data['user_data'] = $this->general_model->get_user_details(936, 2);
        $email_['data']=$this->email_model->get_email_template_new($email_type);
        $email_['user_data']=$data['user_data'];       
        $email = $data['user_data']->user_email_id;
        $key = $this->generate_random_key(50);
        $secret = md5($email);
        $this->account_model->updatePwdResetLink($user_id, $user_type_id, $key, $secret);
        $email_['confirm_link'] = WEB_URL . 'account/email/' . $key . '/' . $secret;      
        $message_temp=$this->load->view('theme_dark/email_tem/register_mail',$email_,true);
        $this->email_model->sendmail_trip($data['user_data']->user_email_id,$email_['data']['content']->subject,$message_temp,$email_['data']['content']->Bcc_email);
        
    }

    public function email($key = '', $secret = '') {

        if ($key != '' && $secret != '') {

            $data['msg'] = 'The link you followed is no longer valid. You can attempt sending another verification email from your Dashboard.';
            $data['status'] = '0';
            if ($this->session->userdata('user_id')) {
                redirect(WEB_URL, 'refresh');
            } else {
                $count = $this->account_model->isvalidSecrect($key, $secret)->num_rows();

                if ($count == 1) {
                    $user_data = $this->account_model->isvalidSecrect($key, $secret)->row();

                    $data['status'] = '1';

                    $user_session = array(
                        'user_id' => $user_data->user_id,
                        'user_type' => $user_data->user_type_id
                    );



                    $user_id = $user_data->user_id;
                    $user_type_id = $user_data->user_type_id;

                    $count = $this->verification_model->checkUserVerfication($user_id, $user_type_id)->num_rows();

                    if ($count == 1) {
                        $update = array(
                            'email_verify' => '1',
                            'key' => '',
                            'secret' => ''
                        );
                        $this->verification_model->updateUserVerification($user_id, $update);

                        $user_status = array(
                            'status' => 'ACTIVE'
                        );
                        $this->verification_model->update_user_status($user_status, $user_id, $user_type_id);


                        if (!$this->session->userdata('user_id')) {
                            $this->session->set_userdata($user_session);
                        }
                        echo '<html><body>
					<form id="vForm" action="' . WEB_URL . 'dashboard" method="POST">
					<input type="hidden" name="email_v" value="Your Email is verified"/>
					</form>
					<script>document.getElementById("vForm").submit();</script></body></html>';
                    } else {

                        redirect(WEB_URL, 'refresh');
                    }
                } else {
                    redirect(WEB_URL, 'refresh');
                }
            }
        } else {

            redirect(WEB_URL, 'refresh');
        }
    }

    public function sendEmailVerification() {
        if ($this->session->userdata('user_id')) {
            $data['user_type'] = $user_type = $this->session->userdata('user_type');
            $data['user_id'] = $user_id = $this->session->userdata('user_id');
        } else {

            return false;
        }

        $userInfo = $this->general_model->get_user_details($user_id, $user_type);
        if (isset($userInfo->user_email) && $userInfo->user_email != "") {
            $email = $userInfo->user_email;
        } else {

            return false;
        }

//        $status = $this->get_mail_content_emailVerification($email, $user_type);
        $response = array(
            'status' => '1',
            'success' => 'true'
        );
        echo json_encode($response);
    }

    public function login() {

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user_type_name = $this->input->post('user_type_name');
        // echo $email;die;
// debug($user_type_name);exit;
        if ($user_type_name == 'B2C') {
            $user_type_id = $this->account_model->get_usertype_email($email, '2');
            if ($user_type_id) {
                $count = $this->account_model->isRegistered($email, $user_type_id)->num_rows();
                if ($count == 1) {
                    $userInfo = $this->account_model->isRegistered($email, $user_type_id)->row();
                    if ($userInfo->status == 'ACTIVE') {
                        $valid_user = $this->account_model->isValidUser($email, $password, $user_type_id)->num_rows();
                        if ($valid_user == 1) {
                            $user_data = $this->account_model->isValidUser($email, $password, $user_type_id)->row();
                            $user_session = array(
                                'user_id' => $user_data->user_id,
                                'user_type' => $user_data->user_type_id,
                                'user_login_id' => $user_data->user_login_details_id,
                            );
                            if (!empty($_POST["remember"])) {
                                setcookie("user_login", $email, time() + (10 * 365 * 24 * 60 * 60));
                                setcookie("user_password", $password, time() + (10 * 365 * 24 * 60 * 60));
                            } else {
                                if (isset($_COOKIE["user_login"])) {
                                    setcookie("user_login", "");
                                }
                                if (isset($_COOKIE["user_password"])) {
                                    setcookie("user_password", "");
                                }
                            }


                            $this->session->set_userdata($user_session);
                            $continue = $this->session->userdata('continue');
                            $response = array(
                                'status' => '1',
                                'success' => 'true',
                                'msg' => 'Success!',
                                'rid' => $user_data->user_id,
                                'fname' => $user_data->user_name,
                                'profile_photo' => $user_data->profile_picture,
                                'continue' => $continue,
                                'user_logs_status' => 'You are logged-in. Now you can continue the booking.'
                            );
                        } else {
                            $response = array(
                                'status' => '0',
                                'success' => 'false',
                                'msg' => 'Invalid Password.'
                            );
                        }
                    } elseif ($userInfo->status == 'PENDING') {
                        $response = array(
                            'status' => '0',
                            'success' => 'false',
                            'msg' => "Your Account Need To Verify. Kindly contact to admin."
                        );
                    } elseif ($userInfo->status == 'INACTIVE') {
                        $response = array(
                            'status' => '0',
                            'success' => 'false',
                            'msg' => "Your Account Inactive. Kindly contact to admin."
                        );
                    } elseif ($userInfo->status == 'CANCEL') {
                        $response = array(
                            'status' => '0',
                            'success' => 'false',
                            'msg' => "Your Account Has Been Canceled Already. If you want to continue the same account. Kindly contact to admin."
                        );
                    } else {
                        $response = array(
                            'status' => '0',
                            'success' => 'false',
                            'msg' => "Invalid password. If you previously logged in with Social, click 'Log in with Social to access your account."
                        );
                    }
                } else {
                    $response = array(
                        'status' => '0',
                        'success' => 'false',
                        'msg' => 'Invalid user name or password.'//before invalid email
                    );
                }
            } else {
                $response = array(
                    'status' => '0',
                    'success' => 'false',
                    'msg' => 'Invalid user name or password.'//before invalid email
                );
            }
        } else if ($user_type_name == 'B2B') {
            $user_type_id = $this->account_model->get_usertype_email($email, '1');
            if ($user_type_id) {
                $count = $this->account_model->isRegistered($email, $user_type_id)->num_rows();
                if ($count == 1) {
                    $userInfo = $this->account_model->isRegistered($email, $user_type_id)->row();

                    //	echo "<pre/>";print_r($userInfo);exit("602");

                    if ($userInfo->status == 'ACTIVE') {
                        $valid_user = $this->account_model->isValidUser($email, $password, $user_type_id)->num_rows();
                        if ($valid_user == 1) {
                            $user_data = $this->account_model->isValidUser($email, $password, $user_type_id)->row();

                            //mobile otp check start
                            if ($user_data->mobile_phone != '') {
                                $this->account_model->update_agent_log_otp('', $user_data->user_id, $user_data->user_email);
                                $status_otp = $this->check_validate_otp_agent($user_data);
            // debug($status_otp);exit;
                                if ($status_otp) {
                                    $send_det = base64_encode(json_encode($user_data->user_id . '-tg-' . $user_data->user_email));
                                    $data['user_data'] = $this->general_model->get_user_details($userInfo->user_id, $user_type_id);
                                    //echo "<pre>";print_r($data['user_data']);exit();
                                    $data['otp']=$status_otp;
                                    $Response = $this->email_model->b2bOtoSend($data);
                                    $continue = WEB_URL . 'account/login_next?ref=' . $send_det;
                                    $response = array(
                                        'status' => '1',
                                        'success' => 'true',
                                        'msg' => 'OTP has been sent to your mobile number registered with Tripglobo !!',
                                        'continue' => $continue
                                    );
                                } else {
                                    $response = array(
                                        'status' => '0',
                                        'success' => 'false',
                                        'msg' => 'Unable to send OTP !!'
                                    );
                                }
                            } else {
                                $response = array(
                                    'status' => '0',
                                    'success' => 'false',
                                    'msg' => 'Unable to find your contact number,Please check with the Admin for the update!!'
                                );
                            }
                            //mobile otp check ends
                            // 			$user_session =  array(
                            //                 'user_id' => $user_data->user_id,
                            //                 'user_type' => $user_data->user_type_id,
                            //                 'user_login_id'=>$user_data->user_login_details_id,
                            //             );
                            //             if(!empty($_POST["remember"])) {
                            // 				setcookie ("user_login",$email,time()+ (10 * 365 * 24 * 60 * 60));
                            // 				setcookie ("user_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
                            // 			} else {
                            // 				if(isset($_COOKIE["user_login"])) { setcookie ("user_login",""); }
                            // 				if(isset($_COOKIE["user_password"])) { setcookie ("user_password",""); }
                            // 			}
                            // 			$this->session->set_userdata($user_session);
                            // 			$continue = WEB_URL.'dashboard';
                            // 			$response = array(
                            // 				'status' => '1',
                            // 				'success' => 'true',
                            // 				'msg' => 'Success!',
                            // 				'rid' => $user_data->user_id,
                            // 				'fname' =>  $user_data->user_name,
                            // 				'profile_photo' =>  $user_data->profile_picture,
                            // 				'continue' => $continue,
                            // 				'user_logs_status' =>'You are logged-in. Now you can continue the booking.'
                            // 			);
                        } else {
                            $response = array(
                                'status' => '0',
                                'success' => 'false',
                                'msg' => 'Invalid Password.'
                            );
                        }
                    } elseif ($userInfo->status == 'PENDING') {
                        $response = array(
                            'status' => '0',
                            'success' => 'false',
                            'msg' => "Your Account Need To Verify. Kindly contact to admin."
                        );
                    } elseif ($userInfo->status == 'INACTIVE') {
                        $response = array(
                            'status' => '0',
                            'success' => 'false',
                            'msg' => "Your Account Inactive. Kindly contact to admin."
                        );
                    } elseif ($userInfo->status == 'CANCEL') {
                        $response = array(
                            'status' => '0',
                            'success' => 'false',
                            'msg' => "Your Account Has Been Canceled Already. If you want to continue the same account. Kindly contact to admin."
                        );
                    } else {
                        $response = array(
                            'status' => '0',
                            'success' => 'false',
                            'msg' => "Invalid password. If you previously logged in with Social, click 'Log in with Social to access your account."
                        );
                    }
                } else {
                    $response = array(
                        'status' => '0',
                        'success' => 'false',
                        'msg' => 'Invalid user name or password.'//before invalid email
                    );
                }
            } else {
                $response = array(
                    'status' => '0',
                    'success' => 'false',
                    'msg' => 'Invalid user name or password.'//before invalid email
                );
            }
        } else if ($user_type_name == 'STAFF') {

            $user_type_id = $this->account_model->get_usertype_email($email, '4');
            if ($user_type_id) {
                $count = $this->account_model->isRegistered($email, $user_type_id)->num_rows();
                if ($count == 1) {
                    $userInfo = $this->account_model->isRegistered($email, $user_type_id)->row();
                    if ($userInfo->status == 'ACTIVE') {
                        $valid_user = $this->account_model->isValidUser($email, $password, $user_type_id)->num_rows();
                        if ($valid_user == 1) {
                            $user_data = $this->account_model->isValidUser($email, $password, $user_type_id)->row();

                            //mobile otp check start
                            if ($user_data->mobile_phone != '') {
                                $this->account_model->update_agent_log_otp('', $user_data->user_id, $user_data->user_email);
                                $status_otp = $this->check_validate_otp_staff($user_data);
                                if ($status_otp) {
                                    $send_det = base64_encode(json_encode($user_data->user_id . '-tg-' . $user_data->user_email));
                                    $continue = WEB_URL . 'account/login_next?ref=' . $send_det;
                                    $response = array(
                                        'status' => '1',
                                        'success' => 'true',
                                        'msg' => 'OTP has been sent to your mobile number registered with Tripglobo !!',
                                        'continue' => $continue
                                    );
                                } else {
                                    $response = array(
                                        'status' => '0',
                                        'success' => 'false',
                                        'msg' => 'Unable to send OTP !!'
                                    );
                                }
                            } else {
                                $response = array(
                                    'status' => '0',
                                    'success' => 'false',
                                    'msg' => 'Unable to find your contact number,Please check with the Admin for the update!!'
                                );
                            }
                        } else {
                            $response = array(
                                'status' => '0',
                                'success' => 'false',
                                'msg' => 'Invalid Password.'
                            );
                        }
                    } elseif ($userInfo->status == 'PENDING') {
                        $response = array(
                            'status' => '0',
                            'success' => 'false',
                            'msg' => "Your Account Need To Verify. Kindly contact to admin."
                        );
                    } elseif ($userInfo->status == 'INACTIVE') {
                        $response = array(
                            'status' => '0',
                            'success' => 'false',
                            'msg' => "Your Account Inactive. Kindly contact to admin."
                        );
                    } elseif ($userInfo->status == 'CANCEL') {
                        $response = array(
                            'status' => '0',
                            'success' => 'false',
                            'msg' => "Your Account Has Been Canceled Already. If you want to continue the same account. Kindly contact to admin."
                        );
                    } else {
                        $response = array(
                            'status' => '0',
                            'success' => 'false',
                            'msg' => "Invalid password. If you previously logged in with Social, click 'Log in with Social to access your account."
                        );
                    }
                } else {
                    $response = array(
                        'status' => '0',
                        'success' => 'false',
                        'msg' => 'Invalid user name or password.'//before invalid email
                    );
                }
            } else {
                $response = array(
                    'status' => '0',
                    'success' => 'false',
                    'msg' => 'Invalid user name or password.'//before invalid email
                );
            }
        }

        echo json_encode($response);
    }

    public function checkOwnerAccVerif($ajax_req = null) {

        if ($this->session->userdata('user_id')) {
            $data['user_type'] = $user_type = $this->session->userdata('user_type');
            $data['user_id'] = $user_id = $this->session->userdata('user_id');
        } else {
            return false;
        }


        $checkUserVerif = $this->account_model->checkTwoStepVerification($user_id, $user_type);



        if (!empty($checkUserVerif)) {
            if ($checkUserVerif->email == 1 && $checkUserVerif->mobile == 1) {
                $data['userVerification'] = 1;
            } else {
                $data['userVerification'] = 0;
            }
        } else {
            $data['userVerification'] = 0;
        }


        if ($ajax_req == 1) {
            return $data;
        } else {
            echo json_encode($data);
        }
    }

    public function agent_login() {
        if ($this->session->userdata('user_type') == '1' || $this->session->userdata('user_type') == '4') {
            redirect(WEB_URL . 'dashboard');
        } else if ($this->session->userdata('user_type') == '2') {
            redirect(WEB_URL);
        }

        $data['country_code'] = $this->general_model->getCountryList();

        $this->load->view(PROJECT_THEME . '/common/login_agent', $data);
    }

    public function staff_login() {
        if ($this->session->userdata('user_type') == '1' || $this->session->userdata('user_type') == '4') {
            redirect(WEB_URL . 'dashboard');
        } else if ($this->session->userdata('user_type') == '2') {
            redirect(WEB_URL);
        }

        $data['country_code'] = $this->general_model->getCountryList();

        $this->load->view(PROJECT_THEME . '/common/login_staff', $data);
    }

    public function employee_login() {
        if ($this->session->userdata('user_type') == '1') {
            redirect(WEB_URL . 'dashboard');
        } else if ($this->session->userdata('user_type') == '2') {
            redirect(WEB_URL);
        } else if ($this->session->userdata('user_type') == '4') {
            redirect(WEB_URL . 'dashboard');
        }
        $data['country_code'] = $this->general_model->getCountryList();
        $this->load->view(PROJECT_THEME . '/common/login_employee', $data);
    }

    public function agent_registration() {
        if ($this->session->userdata('user_type') == '1') {
            redirect(WEB_URL . 'dashboard');
        } else if ($this->session->userdata('user_type') == '2') {
            redirect(WEB_URL);
        }
        $data['country_code'] = $this->general_model->getCountryList();
        $this->load->view(PROJECT_THEME . '/common/registration_agent', $data);
    }

    public function verifyContactDetails() {

        $email_code = $this->input->post('veri_email');
        $verify_id = $this->input->post('verify_id');
        // echo $email_code; exit();
        if ($verify_id != "") {
            // echo $verify_id.'    '.$email_code; exit();
            //verify the codes entered by the user.
            $verify_count = $this->account_model->verifyAgentContactDetails($verify_id, $email_code)->num_rows();
            if ($verify_count == 1) {
                $verify_data = $this->account_model->verifyAgentContactDetails($verify_id, $email_code)->row();
                if ($verify_data->user_type_id == 4) {
                    $this->account_model->changeEmployeeStatus($verify_data->user_id);
                } else if ($verify_data->user_type_id == 1) {
                    $this->account_model->changeagentStatus($verify_data->user_id);
                } else {
                    $this->account_model->changeUserStatus($verify_data->user_id);
                }
                $user_verification_data = array('email_verify' => '1', 'mobile_verify' => '1');
                $this->account_model->UpdateInUserVerification($verify_data->user_id, $user_verification_data);
                $response = array('status' => 1, 'msg' => 'correct');
            } else {
                $response = array('status' => 0, 'msg' => 'Wrong credentials entered.');
            }
        } else {
            $response = array('status' => 2, 'msg' => 'Error occured, Please try in few moments.');
        }

        echo json_encode($response);
    }

    public function confirm_login() {
        $this->load->view(PROJECT_THEME . '/common/login_confirmation');
    }

    public function sendAgentPassResetLink() {
        
        $email_id = $this->input->post('agent_reset_email');
       
        $user_type_name = $this->input->post('user_type_name');
        
        $user_type_id = $this->account_model->get_usertype_id($user_type_name);

        $isAgentReg = $this->account_model->isRegistered($email_id, $user_type_id)->num_rows();
        //debug($email_id);exit();
        if ($isAgentReg == 1) {
            if ($this->sendAgentForgetPassLink($email_id, $user_type_id)) {

                //$response = array('status'=>1, 'msg'=>'correct');
                echo 1;
                // redirect(WEB_URL."/account/agent_login",$response);
            } else {
                echo 0;
                // $response = array('status'=>0, 'msg'=>'Email Not Sent');
                // redirect(WEB_URL."account/agent_login",$response);
            }
        } else {

            $response = array('status' => 0, 'msg' => 'Incorrect Email Address');
            redirect(WEB_URL . "account/agent_login", $response);
        }
        //redirect(WEB_URL."account/agent_login",$response);
    }

    public function sendAgentForgetPassLink($email, $user_type_id) {
       
        $isAgentReg = $this->account_model->isRegistered($email, $user_type_id)->row();
        $data['user_data'] = $this->general_model->get_user_details($isAgentReg->user_id, $user_type_id);
        $key = $this->generate_random_key(50);
        $secret = md5($email);
        $this->account_model->updatePwdResetLink($isAgentReg->user_id, $user_type_id, $key, $secret);
        $data['reset_link'] = WEB_URL . 'account/set_password/' . $key . '/' . $secret;
        $Response = $this->email_model->user_sendmail_forgot_password($data);
        $Response='"rahulk';
        echo "<pre>"; print_r($Response);exit;
        //debug($Response);exit();
        return $Response;
    }

    public function set_password($key, $secret) {
        if ($key == '' || $secret == '') {
            $data['msg'] = 'Sorry, this link has expired, please reset again...';
            $data['status'] = '0';
        } else {
            $count = $this->account_model->isvalidSecrect($key, $secret)->num_rows();
            // echo $count.'sfgdg';exit;
            if ($count == 1) {
                // echo "afaf";exit;
                $user_data = $this->account_model->isvalidSecrect($key, $secret)->row();
                $user_datas = $this->general_model->get_user_details($user_data->user_id, $user_data->user_type_id);
                $data['status'] = '1';
                $data['email'] = $user_datas->user_email_id;
                $data['key'] = $key;
                $data['secret'] = $secret;
                $data['user_data'] = $user_datas;
            } else {
                // echo "sgsgd";exit;
                $data['msg'] = 'Sorry, this link has expired, please reset again...';
                $data['status'] = '0';
            }
        }
        $this->load->view(PROJECT_THEME . '/common/reset_password', $data);
    }

    public function forgetpwd() {
        $user_type_name = $_POST['email'];
        $user_type_id = $this->account_model->get_usertype_email($user_type_name);
       
        $email = $this->input->post('email');

        $count = $this->account_model->isRegistered($email, $user_type_id)->num_rows();
        // echo "<pre>"; print_r($count); echo "</pre>"; die();
        if ($count == 1) {
            $userInfo = $this->account_model->isRegistered($email, $user_type_id)->row();

            if ($userInfo->status == 'ACTIVE') {
                $password = $userInfo->password;
                $status = $this->sendAgentForgetPassLink($email, $user_type_id);
                 echo $status;exit("1017");
                if ($status == '1') {
                    $response = array(
                        'status' => '1',
                        'success' => 'true',
                        'msg' => "A link to reset your password has been sent to " . $email . ".!"
                    );
                    echo json_encode($response);
                }
            } else {
                $response = array(
                    'status' => '0',
                    'success' => 'false',
                    'msg' => "Invalid Email."
                );
                echo json_encode($response);
            }
        } else {
            $response = array(
                'status' => '0',
                'success' => 'false',
                'msg' => 'Invalid Email.'
            );
            echo json_encode($response);
        }
        // echo json_encode($response);
    }

    public function resetPwd() {
        $key = $this->input->post('key');
        $secret = $this->input->post('secret');
        $count = $this->account_model->isvalidSecrect($key, $secret)->num_rows();
        if ($count == 1) {
            $user_data = $this->account_model->isvalidSecrect($key, $secret)->row();

            $user_datas = $this->general_model->get_user_details($user_data->user_id, $user_data->user_type_id);


            //echo json_encode($email); die();
            $password = $this->input->post('password');
            $update = array(
                'key' => ''
            );
            $this->account_model->update_user_verification($update, $user_data->user_id, $user_data->user_type_id);
            $update3 = array(
                'password' => md5($password)
            );
            $this->account_model->update_user_password($update3, $user_data->user_id, $user_data->user_type_id);

            $response = array(
                'status' => '1',
                'success' => 'true',
                'msg' => "Your password has been changed you can login now!"
            );
            echo json_encode($response);
            // redirect(WEB_URL,$response);
        } else {
            $response = array(
                'status' => '0',
                'msg' => "sorry link has been expired, plese reset again"
            );
            echo json_encode($response);
        }
    }

    public function generate_random_key($length = '', $special = null) {
        $alphabets = range('A', 'Z');
        $numbers = range('0', '9');
        $additional_characters = array('_', '.');
        $final_array = array_merge($alphabets, $numbers, $additional_characters);

        $id = '';

        while ($length--) {
            $key = array_rand($final_array);
            $id .= $final_array[$key];
        }
        return $id;
    }

    public function get_usertype() {
        if ($_REQUEST['email'] != '') {
            $user = $this->account_model->user_data($_REQUEST['email']);
            if ($user != '')
                echo json_encode(array('usertype' => $user->user_type_name));
            else
                echo json_encode(array('usertype' => ''));
        }
    }

    public function subscriber() {
        #echo "ea";exit;
        $email_id = $_POST['subscriber_id'];

        $result = $this->home_model->checkSubscriberisRegistered($email_id);

        if (!$result) {
            $creation_date = date("Y-m-d h:m:s");
            $status = "ACTIVE";
            $data = array(
                "subscriber_email" => $email_id,
                "subscriber_status" => $status,
                "subscriber_creation_date" => $creation_date
            );
            $sub_status = $this->home_model->insert_subscriber($data);
            if ($sub_status == true) {
                echo "<script>alert('Thanks for subscription with us.')</script>";
            } else {
                echo "<script>alert('Please inter Correct email id.')</script>";
            }
        } else {
            echo "<script>alert('Entered mail Id already Registered with us.')</script>";
        }
        //exit;
        echo "<script>window.location ='" . WEB_URL . "';</script>";
    }
    
    public function check_validate_otp_b2c($details) {
        
        $curl = curl_init();
        
        $oo = rand(10000,99999);
    
        $msg = "Dear user your OTP for logging in to your account is {#var#}. Thank you for choosing Tripglobo, We are here to support you whenever you need us at Contact@tripglobo.com or contact us at +917710277110";
        $msg = str_replace("{#var#}",$oo,$msg);
        
        $msg = rawurlencode($msg);
        $cont = '91' . $details['phone_number'];
        
        $url = 'https://japi.instaalerts.zone/httpapi/QueryStringReceiver?ver=1.0&key=d10lvCQSrDZydhONDE1dnQ%3D%3D&encrpt=0&dest='.$cont.'&send=TRIPGB&dlt_entity_id=1001861812287155118&text='.$msg;
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        
        $enc_op = md5(json_encode(base64_encode(json_encode(md5($oo)))));
        return $enc_op;
    }
    
    public function check_validate_otp_agent($details) {
        
        $curl = curl_init();
        
        $oo = rand(10000,99999);
        $user_name = $details->user_name;
        
        $msg = "Dear user your OTP for logging in to your (agent) account is {#var#}. For further assistance please get in touch with us at Contact@tripglobo.com or +917710277110. Thank you for choosing tripglobo.";
        $msg = str_replace("{#var#}",$oo,$msg);
        $msg = str_replace("(agent)",$user_name,$msg);
        $msg = rawurlencode($msg);
        $cont = '91' . $details->mobile_phone;
        
        $url = 'https://japi.instaalerts.zone/httpapi/QueryStringReceiver?ver=1.0&key=d10lvCQSrDZydhONDE1dnQ%3D%3D&encrpt=0&dest='.$cont.'&send=TRIPGB&dlt_entity_id=1001861812287155118&text='.$msg;
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        
        $enc_op = md5(json_encode(base64_encode(json_encode(md5($oo)))));
        $this->account_model->update_agent_log_otp($enc_op, $details->user_id, $details->user_email);
        return $oo;

    }
    
    
    public function check_validate_otp_staff($details){
        
        $curl = curl_init();
        
        $oo = rand(10000,99999);
        $msg = "Dear user your OTP for logging in to your Staff account is {#var#}. For further assistance please contact us at Contact@tripglobo.com or +917710277110. Thank you for choosing Tripglobo.";
        $msg = str_replace("{#var#}",$oo,$msg);
        $msg = rawurlencode($msg);
        $cont = '91' . $details->mobile_phone;
        
        $url = 'https://japi.instaalerts.zone/httpapi/QueryStringReceiver?ver=1.0&key=d10lvCQSrDZydhONDE1dnQ%3D%3D&encrpt=0&dest='.$cont.'&send=TRIPGB&dlt_entity_id=1001861812287155118&text='.$msg;
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        
        $enc_op = md5(json_encode(base64_encode(json_encode(md5($oo)))));
        $this->account_model->update_agent_log_otp($enc_op, $details->user_id, $details->user_email);
        return $oo;
        
    }
    
    /*public function check_validate_otp_agent($details) {
        $curl = curl_init();
       // $oo = rand(100,99999);
        $oo = 12345;
        $msg = urlencode('Your OTP number is ' . $oo);
        $cont = '91' . $details->mobile_phone;
        // debug($details);exit;
        $url = "http://107.20.199.106/api/v3/sendsms/plain?user=kapsystem&password=Kap@user!123&sender=KAPNFO&SMSText=" . $msg . "&GSM=" . $cont . "&type=longSMS";
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $this->load->library('xml_to_array');
        $response = $this->xml_to_array->XmlToArray($response);

        // use dummy pass start
        // $oo = 123456789;
        // $enc_op = md5(json_encode(base64_encode(json_encode(md5($oo)))));
        // $this->account_model->update_agent_log_otp($enc_op, $details->user_id, $details->user_email);
        // return true;
        // use dummy pass ends

        // if ($response['result']['status'] == 0) {
            $enc_op = md5(json_encode(base64_encode(json_encode(md5($oo)))));
            $this->account_model->update_agent_log_otp($enc_op, $details->user_id, $details->user_email);
            return $oo;
        // } else {
        //     return false;
        // }
    }*/

    public function resend_validate_otp_agent($details) {
        
        $curl = curl_init();
        
        $oo = rand(10000,99999);
        $msg = "Dear user, your OTP for logging in to your Admin account is {#var#} . Embrace the Journey with Tripglobo";
        $msg = str_replace("{#var#}",$oo,$msg);
        $msg = rawurlencode($msg);
        $cont = '91' . $details->mobile_phone;
        
        $url = 'https://japi.instaalerts.zone/httpapi/QueryStringReceiver?ver=1.0&key=d10lvCQSrDZydhONDE1dnQ%3D%3D&encrpt=0&dest='.$cont.'&send=TRIPGB&dlt_entity_id=1001861812287155118&text='.$msg;
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $enc_op = md5(json_encode(base64_encode(json_encode(md5($oo)))));
        $this->account_model->update_agent_log_otp($enc_op, $details->user_id, $details->user_email);
        return true;
        
    }

    public function login_next() {
        $data['country_code'] = $this->general_model->getCountryList();
        $this->load->view(PROJECT_THEME . '/common/login_agent_otp', $data);
    }

    public function login_check_next() {
        // debug($_POST);exit;
        if ((isset($_POST['otp'])) && (isset($_POST['ref']))) {
            if (($_POST['otp'] != '') && ($_POST['ref'] != '')) {
                $decoded_ref = explode('-tg-', json_decode(base64_decode($_POST['ref'])));
                $ecoded_otp = md5(json_encode(base64_encode(json_encode(md5($_POST['otp'])))));
                $get_details = $this->account_model->get_update_agent_log_otp($ecoded_otp, $decoded_ref[0], $decoded_ref[1]);
                if ($get_details) {

                    if ($get_details->user_type_id == 4) {
                        $staff_log_track_id = $this->account_model->insert_staff_log($get_details);
                    } else {
                        $staff_log_track_id = '';
                    }

                    $this->account_model->update_agent_log_otp_success($decoded_ref[0], $decoded_ref[1]);
                    $user_session = array(
                        'user_id' => $get_details->user_id,
                        'user_type' => $get_details->user_type_id,
                        'user_login_id' => $get_details->user_login_details_id,
                        'user_logged_in' => TRUE,
                        'staff_log_track_id' => $staff_log_track_id,
                    );
                    $this->session->set_userdata($user_session);
                    redirect(WEB_URL . 'dashboard', 'refresh');
                } else {
                    $this->session->set_flashdata('status', 'Invalid OTP Entered !!');
                    redirect(WEB_URL . 'account/login_next?ref=' . $_POST['ref'], 'refresh');
                }
            } else {
                $this->session->set_flashdata('status', 'Please Enter OTP !!');
                redirect(WEB_URL . 'account/login_next?ref=' . $_POST['ref'], 'refresh');
            }
        } else {
            $this->session->set_flashdata('status', 'Please Enter OTP !!');
            redirect(WEB_URL . 'account/login_next?ref=' . $_POST['ref'], 'refresh');
        }
    }

    public function resend_otp($ref) {
        if (isset($ref)) {
            if ($ref != '') {
                $decoded_ref = explode('-tg-', json_decode(base64_decode($ref)));
                $details = $this->account_model->get_agent_log_details_full($decoded_ref[0], $decoded_ref[1]);
                if ($details->resend_flag < 3) {
                    $resend_status = $this->resend_validate_otp_agent($details);
                    if ($resend_status) {
                        $this->session->set_flashdata('status', 'OTP has been sent to your mobile number registered with Tripglobo !!');
                        redirect(WEB_URL . 'account/login_next?ref=' . $ref, 'refresh');
                    } else {
                        $this->session->set_flashdata('status', 'Unable to resend OTP !!');
                        redirect(WEB_URL . 'account/login_next?ref=' . $ref, 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('status', 'Oops ! You have reached OTP limit !!');
                    redirect(WEB_URL . 'account/login_next?ref=' . $ref, 'refresh');
                }
            } else {
                $this->session->set_flashdata('status', 'Unable to resend OTP !!');
                redirect(WEB_URL . 'account/agent_login', 'refresh');
            }
        } else {
            $this->session->set_flashdata('status', 'Unable to resend OTP !!');
            redirect(WEB_URL . 'account/agent_login', 'refresh');
        }
    }
    
    
    public function testotp() {
    
        $curl = curl_init();
        
        $oo = rand(10000,99999);
        $msg = "Dear user, your OTP for logging in to your Admin account is {#var#} . Embrace the Journey with Tripglobo";
        $msg = str_replace("{#var#}",$oo,$msg);
        $msg = rawurlencode($msg);
        $cont = '917785070089';
        
         //$url = 'https://japi.instaalerts.zone/httpapi/QueryStringReceiver?ver=1.0&key=d10lvCQSrDZydhONDE1dnQ==&encrpt=0&dest='.$cont.'&send=TRIPGB&dlt_entity_id=1007333230625813233&text='.$msg;
        $url = 'https://japi.instaalerts.zone/httpapi/QueryStringReceiver?ver=1.0&key=d10lvCQSrDZydhONDE1dnQ%3D%3D&encrpt=0&dest='.$cont.'&send=TRIPGB&dlt_entity_id=1001861812287155118&text='.$msg;
        //  echo $url;
        // exit;
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;

        
    }
    

}

?>
