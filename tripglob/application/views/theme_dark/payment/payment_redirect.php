<html>
<head>
<title>Redirecting to Payment...</title>
</head>
<body>
<center>
    <form method="post" name="redirect" 
          action="<?php echo $paymentRequestUrl; ?>">
        <input type="hidden" name="encRequest" value="<?php echo $encrypted_data; ?>">
        <input type="hidden" name="access_code" value="<?php echo $access_code; ?>">
    </form>
</center>
<script type="text/javascript">
    document.redirect.submit();
</script>
</body>
</html>
