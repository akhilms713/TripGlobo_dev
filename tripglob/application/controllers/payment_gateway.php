<?php  
ob_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class Payment_gateway extends CI_Controller {
	public function __construct(){
		parent::__construct();

	}
function process_to_pay($id){
  error_reporting(0);

$datas=$this->db->get_where('payment_gateway_details',array('id'=>$id))->row_array();

// debug($datas);exit;

session_start();
$key="gtKFFx";
$salt="4R38IvwiV57FwVpsgOvTXBdLE4tHUXFW";
$action = 'https://test.payu.in/_payment';
$html='';
$data['key']='gtKFFx';
$data['txnid']=$datas['txnid'];
$data['amount']=$datas['amount'];
$data['productinfo']=$datas['productinfo'];
$data['firstname']=$datas['phone'];
$data['email']=$datas['email'];
$data['udf5']='test';
$surl=base_url().'payment_gateway/payuresponse/'.$id;
$furl=base_url().'payment_gateway/payuresponse/'.$id;
$lastname='tests';
$phone=$datas['phone'];  
  $hash=hash('sha512', $key.'|'.$data['txnid'].'|'.$data['amount'].'|'.$data['productinfo'].'|'.$data['firstname'].'|'.$data['email'].'|||||'.$data['udf5'].'||||||'.$salt);    
  $_SESSION['salt'] = $salt; //save salt in session to use during Hash validation in response  
  $html = '<form action="'.$action.'" id="payment_form_submit" method="post">
      <input type="hidden" id="udf5" name="udf5" value="'.$data['udf5'].'" />
      <input type="hidden" id="surl" name="surl" value="'.$surl.'" />
      <input type="hidden" id="furl" name="furl" value="'.$surl.'" />
      <input type="hidden" id="curl" name="curl" value="'.$surl.'" />
      <input type="hidden" id="key" name="key" value="'.$key.'" />
      <input type="hidden" id="txnid" name="txnid" value="'.$data['txnid'].'" />
      <input type="hidden" id="amount" name="amount" value="'.$data['amount'].'" />
      <input type="hidden" id="productinfo" name="productinfo" value="'.$data['productinfo'].'" />
      <input type="hidden" id="firstname" name="firstname" value="'.$data['firstname'].'" />
      <input type="hidden" id="Lastname" name="Lastname" value="'.$data['Lastname'].'" />
      <input type="hidden" id="Zipcode" name="Zipcode" value="'.$data['Zipcode'].'" />
      <input type="hidden" id="email" name="email" value="'.$data['email'].'" />
      <input type="hidden" id="phone" name="phone" value="'.$data['phone'].'" />
      <input type="hidden" id="address1" name="address1" value="'.$data['address1'].'" />
      <input type="hidden" id="address2" name="address2" value="'.(isset($data['address2'])? $data['address2'] : '').'" />
      <input type="hidden" id="city" name="city" value="'.$data['city'].'" />
      <input type="hidden" id="state" name="state" value="'.$data['state'].'" />
      <input type="hidden" id="country" name="country" value="'.$data['country'].'" />
      <input type="hidden" id="Pg" name="Pg" value="'.$data['Pg'].'" />
      <input type="hidden" id="hash" name="hash" value="'.$hash.'" />
      </form>
      <script type="text/javascript"><!--
        document.getElementById("payment_form_submit").submit();  
      //-->
      </script>';
      if($html){
      echo $html;
      } 
}

function payuresponse($id){
  $datas=$this->db->get_where('payment_gateway_details',array('id'=>$id))->row_array();
	if ($_POST['status'] == 'success' && $_POST['unmappedstatus'] == 'captured') {
	$response=array('response'=>json_encode($_POST),
                     'status'=>'accepted'
                     ); 
 	}else{
			$response=array('response'=>json_encode($_POST),
                     'status'=>'declined'
                     ); 

	}
	$this->db->where('id',$id);
	$this->db->update('payment_gateway_details',$response);
  if ($datas['productinfo']=='flight' && $_POST['status'] == 'success' && $_POST['unmappedstatus'] == 'captured') {
// debug($_POST);exit;
    redirect(WEB_URL.'booking/flight_availability/'.$datas['parent_pnr'].'/'.$_POST['status']);
  }elseif ($datas['productinfo']=='hotel' && $_POST['status'] == 'success' && $_POST['unmappedstatus'] == 'captured') {
    redirect(WEB_URL.'booking/book/'.$datas['parent_pnr'].'/'.$_POST['status']);
    // code...
  }elseif ($datas['productinfo']=='bus' && $_POST['status'] == 'success' && $_POST['unmappedstatus'] == 'captured') {
    redirect(WEB_URL.'booking/book/'.$datas['parent_pnr'].'/'.$_POST['status']);
    // code...
  }else{
// debug($_POST);exit;
    redirect(WEB_URL.'error/payment/'.$msg,'refresh');
  }
}

}
?>
