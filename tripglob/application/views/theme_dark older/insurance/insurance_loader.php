<html>
<head>
<title>Please wait</title>
</head>
<body>
  <form id="form" action="<?=$form_url?>" method="<?=$form_method?>"><?php
  foreach ( $form_params as $key => $val ) {
    ?><input type="hidden" name="<?=$key?>" value="<?=$val?>" /><?php
  }
  ?></form>
  <script>
document.getElementById("form").submit();
</script>
</body>
</html>
