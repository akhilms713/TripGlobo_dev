<html>
<head>
<title> Iframe</title>
</head>
<body>
<center>
<?php include('Crypto.php')?>
<?php 
   error_reporting(0);
  $working_key='5C5912A907A3BB65234F77B3572F14E6';//Shared by CCAVENUES
  $access_code='AVCQ90HC88AH99QCHA';//Shared by CCAVENUES
  $amount_value='12';
  $merchant_id='251108';
  $order_id='12345';
  $product_id=isset($_POST['product_id']) ? $_POST['product_id'] : '' ;

   
   $merchant_data='';
   foreach ($_POST as $key => $value){
      $merchant_data.=$key.'='.$value.'&';
   }
    // $order_id='234';
    //  $product_id=isset($_POST['product_id']) ? $_POST['product_id'] : '' ;
    //  $sql_statement = 'put your sql query to find product amount and merchant_id';
    //  $amount_value = $sql_statement->amount;
    //  $merchant_id = $sql_statement->merchant_id;

     $merchant_data.='merchant_id'.'='.$merchant_id.'&'.'amount'.'='.$amount_value.'&'.'order_id'.'='.$order_id.'&';
     $encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
   // $production_url='https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
   $test_url='https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
?>
<iframe src="<?php echo $test_url?>" id="paymentFrame" width="482" height="450" frameborder="0" scrolling="No" ></iframe>
<script type="text/javascript" src="jquery-1.7.2.js"></script>
<script type="text/javascript">
       $(document).ready(function(){
           window.addEventListener('message', function(e) {
              $("#paymentFrame").css("height",e.data['newHeight']+'px');     
          }, false);
      });
</script>
</center>
</body>
</html>