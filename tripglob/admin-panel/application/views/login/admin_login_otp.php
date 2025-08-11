<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo PROJECT_TITLE; ?> </title>
  <link rel="icon" href="https://tripglobo.com/beta1/assets/theme_dark/images/favicon.png" type="image/x-icon">
    <!-- Bootstrap core CSS -->

    <link href="<?php echo ASSETS; ?>css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo ASSETS; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo ASSETS; ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/icheck/flat/green.css" rel="stylesheet">
   <link type="text/css" rel="stylesheet" href="<?php echo ASSETS; ?>/css/common/toastr.css?1425466569" />

    <script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>
<style>
    .login_content h1:before, .login_content h1:after {
        width: 23%;
    }
    .span_text{
        float: left;
        padding: 5px;
        font-weight: 600;
    }
    .rsnd_otp{
        float: right;
        margin-right: 1px;
    }
    .submit_otp {
        padding: 2% 10%;
        background-color: #203f7c;
        color: #fff;
        width: 100%;
        height: 45px;
        font-size: 16px;
    }
</style>
<body style="background:#fff;">
    
    <div class="back_gradi">
        <div class="back_gradi_img"></div>
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content1">
                    <div class="admin_logo">
                         <img src="<?php echo WEB_URL?>assets/images/logo.png" alt="">
                    </div><br>
                    <!-- <div class="reltivefligtgo">        <div class="flitfly"></div>        </div> -->
                    <form class="form form-validate  floating-label"  action="<?php echo WEB_URL; ?>login/login_check_next " accept-charset="utf-8" method="post">
                    <div class="log_full_bg login_content">
                        <div class="log_form col-sm-12">
                            <h1>Validate OTP(One Time Passcode)</h1>
                                <input type="hidden" name="ref" value="<?php echo $_GET['ref']; ?>">
                            <div>
                                <span class="span_text">Your OTP has been sent to your mobile phone.Please enter the OTP below to verify your account.</span>
                                <input type="text" class="form-control" placeholder="Enter OTP to login" name="otp" required />
                            </div>
                            
                            <div>
                            <button class="btn btn-default submit_otp" id="loginbtn" type="submit">Validate OTP</button>
                                <a class="rsnd_otp" href="<?php echo WEB_URL.'login/resend_otp/'.$_GET['ref']; ?>">Resend OTP</a> 
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">
    					        <div>
                                    <h1><i class="fa fa-lock" style="font-size: 26px;"></i> <?php echo PROJECT_TITLE; ?></h1>
                                    <p>©<?=date('Y')?> All Rights Reserved. <?php echo PROJECT_TITLE; ?>. Privacy and Terms</p>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    </form>
                    <!-- form -->
               </section>
                <!-- content -->
            </div>
            
        </div>
    </div>

</body>

</html>
 <script src="<?php echo ASSETS; ?>/js/toastr/toastr.js"></script>
<link href="<?php echo ASSETS; ?>css/common/patternLock.css"  rel="stylesheet" type="text/css" />
<script>
<?php 
$status=$this->session->flashdata('status');
if(isset($status) && $status != '')
{
	?>
toastr.error("<?php echo $status; ?>", '');
<?php
}
?>
</script>
