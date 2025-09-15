<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccpayment extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->helper('url'); 
        $this->load->helper('crypto');
    }

    public function index(){

        $key = $this->input->get('key');
        if($key == "tripglobopay"){

            $data['merchantId'] = getenv('CC_MerchantID'); 
            $this->load->view(PROJECT_THEME."/payment/form", $data);
        }
        else{
            $this->load->view(PROJECT_THEME."/errors/404");
        }
        
    }
    public function ccrequest(){

        // Set your credentials
        $working_key = getenv('CC_WorkingKey');  
        $access_code = getenv('CC_AccessCode'); 

        // Build merchant data from POST
        $merchant_data = '';
        foreach ($this->input->post(NULL, TRUE) as $key => $value) {
            $merchant_data .= $key . '=' . $value . '&';
        }

        // Encrypt
        $encrypted_data = encrypt_ccavenue($merchant_data, $working_key);


        // Pass data to view
        $data['encrypted_data'] = $encrypted_data;
        $data['access_code']    = $access_code;
        $data['paymentRequestUrl'] = getenv('CC_RedirectUrl'); 

        $this->load->view(PROJECT_THEME."/payment/payment_redirect", $data);
    
    }

     public function ccresponse() {

        $workingKey = getenv('CC_WorkingKey');  

        // Get encrypted response from CCAvenue
        $encResponse = $this->input->post("encResp");
        $rcvdString  = decrypt_ccavenue($encResponse, $workingKey);

        // Parse response string
        $decryptValues = explode('&', $rcvdString);
        $order_status  = "";

        foreach ($decryptValues as $index => $val) {
            $info = explode('=', $val);
            if ($index == 3) {  // CCAvenue keeps order_status at index 3
                $order_status = isset($info[1]) ? $info[1] : '';
            }
        }

        // Pass data to view
        $data['order_status']   = $order_status;
        $data['decrypt_values'] = $decryptValues;

        $this->load->view(PROJECT_THEME."/payment/payment_response", $data);
    }
}
