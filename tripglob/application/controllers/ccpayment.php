<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ccpayment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('crypto'); // your CCAvenue encrypt/decrypt helper
    }

    // Step 1: Payment form
    public function index() {
        $key = $this->input->get('key');
        if ($key == "tripglobopay") {
            $merchantId = getenv('CC_MerchantID');
            $parent     = $this->input->get('parent');
            $amount     = $this->input->get('numb');

            echo '
        <form method="post" action="'.site_url('ccpayment/ccrequest').'">
            <input type="hidden" name="merchant_id" value="'.$merchantId.'" />
            <input type="hidden" name="order_id" value="'.$parent.'" />
            <input type="hidden" name="currency" value="INR" />
            <input type="hidden" name="amount" value="'.$amount.'" />
            <input type="hidden" name="language" value="EN" />
            <button type="submit">Proceed to Pay</button>
        </form>';
        } else {
            $this->load->view(PROJECT_THEME."/errors/404");
        }
    }

    // Step 2: Build request and redirect to CCAvenue
    public function ccrequest() {
        $working_key  = getenv('CC_WorkingKey');
        $access_code  = getenv('CC_AccessCode');
        $redirect_url = site_url('ccpayment/ccresponse');

        $merchant_data  = '';
        foreach ($this->input->post(NULL, TRUE) as $key => $value) {
            $merchant_data .= $key . '=' . $value . '&';
        }
        // Mandatory params
        $merchant_data .= "redirect_url=".$redirect_url."&cancel_url=".$redirect_url;

        $encrypted_data = encrypt_ccavenue($merchant_data, $working_key);

        $data['encrypted_data']   = $encrypted_data;
        $data['access_code']      = $access_code;
        $data['paymentRequestUrl']= getenv('CC_RedirectUrl');

        $this->load->view(PROJECT_THEME."/payment/payment_redirect", $data);
    }

    // Step 3: Response from CCAvenue
    public function ccresponse() {
        $workingKey   = getenv('CC_WorkingKey');
        $encResponse  = $this->input->post("encResp");
        $rcvdString   = decrypt_ccavenue($encResponse, $workingKey);
        $decryptValues= explode('&', $rcvdString);

        $responseData = [];
        foreach ($decryptValues as $val) {
            $info = explode('=', $val);
            $responseData[$info[0]] = isset($info[1]) ? $info[1] : '';
        }

        $order_status = isset($responseData['order_status']) ? $responseData['order_status'] : '';

        // Update booking table
        if ($order_status === "Success") {
            $this->db->where('pnr', $responseData['order_id'])
                ->update('bookings', ['payment_status' => 'Paid']);
        } else {
            $this->db->where('pnr', $responseData['order_id'])
                ->update('bookings', ['payment_status' => 'Failed']);
        }

        $data['order_status']   = $order_status;
        $data['decrypt_values'] = $responseData;
        $this->load->view(PROJECT_THEME."/payment/payment_response", $data);
    }
}
