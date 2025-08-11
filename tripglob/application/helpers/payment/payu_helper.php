<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function process_to_pay(){

session_start();
$key="gtKFFx";
$salt="4R38IvwiV57FwVpsgOvTXBdLE4tHUXFW";
$action = 'https://test.payu.in/_payment';
$html='';
$data['key']='gtKFFx';
$data['txnid']='TX999'.date('ymdhis');
$data['amount']=100;
$data['productinfo']='iphone';
$data['firstname']='test';
$data['email']='poovarasan@gamil.com';
$data['udf5']='test';
$surl='https://tripglobo.com/beta1/payur.php';
$furl='https://tripglobo.com/beta1/payur.php';
$lastname='tests';
$phone=9874563210;  
  $hash=hash('sha512', $key.'|'.$data['txnid'].'|'.$data['amount'].'|'.$data['productinfo'].'|'.$data['firstname'].'|'.$data['email'].'|||||'.$data['udf5'].'||||||'.$salt);    
  $_SESSION['salt'] = $salt; //save salt in session to use during Hash validation in response  
  $html = '<form action="'.$action.'" id="payment_form_submit" method="post">
      <input type="hidden" id="udf5" name="udf5" value="'.$data['udf5'].'" />
      <input type="hidden" id="surl" name="surl" value="'.getCallbackUrl().'" />
      <input type="hidden" id="furl" name="furl" value="'.getCallbackUrl().'" />
      <input type="hidden" id="curl" name="curl" value="'.getCallbackUrl().'" />
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
function getCallbackUrl()
{
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $uri = str_replace('/index.php','/',$_SERVER['REQUEST_URI']);
  $surl='/beta1/payur.php';
  return $protocol . $_SERVER['HTTP_HOST'] . $surl ;
}
?>

    
    
  
