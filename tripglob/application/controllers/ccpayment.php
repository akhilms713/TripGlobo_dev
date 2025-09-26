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
            $working_key  = getenv('CC_WorkingKey');
            $access_code  = getenv('CC_AccessCode');
            $redirect_url = site_url('ccpayment/ccresponse');

            $merchant_id  = getenv('CC_MerchantID');
            $order_id     = $this->input->get('parent');   // booking/payment id
            $amount       = $this->input->get('numb');     // booking amount

            // Build merchant data
            $merchant_data  = "merchant_id=".$merchant_id
                ."&order_id=".$order_id
                ."&currency=INR"
                ."&amount=".$amount
                ."&redirect_url=".$redirect_url
                ."&cancel_url=".$redirect_url
                ."&language=EN";

            // Encrypt data
            $encrypted_data = encrypt_ccavenue($merchant_data, $working_key);

            // Auto-submit form
            echo '
        <form id="ccavenue_payment" method="post" action="'.getenv('CC_RedirectUrl').'">
            <input type="hidden" name="encRequest" value="'.$encrypted_data.'">
            <input type="hidden" name="access_code" value="'.$access_code.'">
        </form>
        <script type="text/javascript">
            document.getElementById("ccavenue_payment").submit();
        </script>';
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
        $order_id     = isset($responseData['order_id']) ? $responseData['order_id'] : '';
        // Fetch row from payment_gateway_details using order_id
        $datas = $this->db->get_where('payment_gateway_details', ['id' => $order_id])->row_array();

        // Prepare update for payment_gateway_details (same as PayU)
        if ($order_status === "Success") {
            $response = [
                'response' => json_encode($responseData),
                'status'   => 'accepted'
            ];
        } else {
            $response = [
                'response' => json_encode($responseData),
                'status'   => 'declined'
            ];
        }

        if (!empty($datas)) {
            $this->db->where('id', $datas['id']);
            $this->db->update('payment_gateway_details', $response);

            // Redirect logic like PayU
            if ($datas['productinfo']=='flight' && $order_status === "success") {
                redirect(WEB_URL.'booking/book/'.$datas['parent_pnr'].'/'.$order_status);
                //redirect(WEB_URL.'booking/flight_availability/'.$datas['parent_pnr'].'/'.$order_status);
            } elseif ($datas['productinfo']=='hotel' && $order_status === "success") {
                redirect(WEB_URL.'booking/book/'.$datas['parent_pnr'].'/'.$order_status);
            } elseif ($datas['productinfo']=='bus' && $order_status === "success") {
                redirect(WEB_URL.'booking/book/'.$datas['parent_pnr'].'/'.$order_status);
            } else {
                redirect(WEB_URL.'error/payment/'.$order_status,'refresh');
            }
        } else {
            // fallback if order_id not found in payment_gateway_details
            redirect(WEB_URL.'error/payment/'.$order_status,'refresh');
        }
    }
}
