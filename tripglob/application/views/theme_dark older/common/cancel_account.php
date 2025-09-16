<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo PROJECT_TITLE; ?></title>
<?php echo $this->load->view(PROJECT_THEME.'/common/load_common_css'); ?>
<link rel="stylesheet" href="<?php echo ASSETS; ?>css/backslider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo ASSETS; ?>css/backslider2.css" type="text/css" media="screen" />
<link href="<?php echo ASSETS; ?>css/owl.carousel.css" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="top">
<div class="bodypat"></div>



<!-- Navigation -->
<?php echo $this->load->view(PROJECT_THEME.'/common/header'); ?>
  
<div class="full onlycontent">
 
<div class="clear"></div>
<div class="full contentvcr">
    <div class="container martopbtm">
        <div class="container offset-0">
            <div class="rowitbk left">
            	<div class="tablwe">
                <div class="col-md-10 celtb">
                    <h2 class="ooops">Your Account Has Been Deleted!</h2>
                    <span class="erordes">We are accessing your account cancellation request. Your data will maintain with us, you can retreive data at any time in future.</span>
                    <div class="rellinks">Here are some helpful links instead:</div>
                      <div class="erorredrctwrp"><a class="erorredrct" href="">Home</a></div>
                    <div class="erorredrctwrp"><a class="erorredrct" href="">Help</a></div>
                </div>
                
                <div class="col-md-2 celtb">
                    <div class="fornot">
                       <img alt="" src="<?php echo ASSETS;?>images/cancel.png">
                    </div>
                </div>
                </div>
                
              </div>
        </div>
</div>
</div>

</div>





<!-- Page Content -->

<?php echo $this->load->view(PROJECT_THEME.'/common/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/common/load_common_js'); ?>

<!-- Script to Activate the Carousel --> 


</body>
</html>
