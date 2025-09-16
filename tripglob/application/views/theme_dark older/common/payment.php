<?php
session_start();
$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id='payment-facilitator@vietnet.us'; // Business email ID
?>
<body onload="do_submit();">
<form action='<?php echo $paypal_url; ?>' method='post'  name="payment_form">
<input type='hidden' name='business' value='<?php echo $paypal_id; ?>'>
<input type='hidden' name='cmd' value='_xclick'>
<input type='hidden' name='item_name' value='<?php echo $module; ?>'>
<input type='hidden' name='item_number' value='<?php echo $parent_pnr; ?>'>
<input type='hidden' name='amount' value='<?php echo $total_price; ?>'>
<input type='hidden' name='no_shipping' value='1'>
<input type='hidden' name='currency_code' value='USD'>
<input type='hidden' name='cancel_return' value="<?php echo base_url().'booking/payment_cancel/' ; ?>">
<input type='hidden' name='return' value="<?php echo base_url().'booking/payment_response/' ; ?>">
</form> 
<script type="text/javascript">
			function do_submit() {
				document.payment_form.submit();
			}
		</script>
</body>




