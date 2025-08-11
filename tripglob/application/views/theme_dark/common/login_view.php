<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo PROJECT_TITLE; ?></title>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_css'); ?>
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
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
  
<div class="full onlycontent">
    <div class="container martopbtm">
<div class="centerfix">
<div class="container martopbtm">
<div class="errstatus" <?php if(!isset($msg)){?>style="display:none;<?php }?>"><?php if(isset($msg)){ echo $msg;}?></div>
<div class="centerfix">
  <div class="wrapdivs">
  <div class="popuperror" style="display:none;"></div>
  <div class="wellme">
      <div class="popuperror" style="display:none;"></div>
        <div class="signdiv">
            <div class="insigndiv">
            <div class="leftpul">
                <?php
                $atts = array(
                  'width'      => '600',
                  'height'     => '600',
                  'scrollbars' => 'yes',
                  'status'     => 'yes',
                  'resizable'  => 'yes',
                  'screenx'   =>  '\'+((parseInt(screen.width) - 600)/2)+\'',
                  'screeny'   =>  '\'+((parseInt(screen.height) - 600)/2)+\'',
                );
                $atts['class'] = 'logspecify facecolor';
                   echo anchor_popup('auth/login/Facebook/login','<span class="icon icon-facebook"></span>
                    <div class="mensionsoc">Login with Facebook</div>', $atts);
                $atts['class'] = 'logspecify tweetcolor';
                   echo anchor_popup('auth/login/Twitter/login','<span class="icon icon-twitter"></span>
                    <div class="mensionsoc">Login with Twitter</div>', $atts);
                $atts['class'] = 'logspecify gpluses';
                   echo anchor_popup('auth/login/Google/login','<span class="icon icon-google-plus"></span>
                    <div class="mensionsoc">Login with Google Plus</div>', $atts);
                ?>
           </div>
             <div class="centerpul"><div class="orbar"><strong>Or</strong></div></div>
             <form id="login2" name="login" action="<?php echo WEB_URL;?>/account/login">
               <div class="ritpul"> 
                  <div class="rowput">
                    <span class="icon glyphicon-envelope"></span>
                    <input class="form-control logpadding" type="email" name="email" placeholder="Email Address" required>
                  </div>
                  <div class="rowput">
                    <span class="icon icon-lock"></span>
                      <input class="form-control logpadding" type="password" name="password" placeholder="Password" required>
                  </div>
                  <div class="misclog">
                    <a class="rember"><input type="checkbox" />Remember me</a>
                      <a class="fadeandscale_close fadeandscaleforget_open forgota" id="forgtpsw">Forgot password?</a>
                  </div>
                  <div class="clear"></div>
                  <button class="submitlogin">Login</button>
                  <div class="clear"></div>
                  <div class="dntacnt">Don't have an account? <a class="fadeandscale_close fadeandscalereg_open">Sign up</a> </div>

              </div>
              </form>
            </div>
        </div>
    </div>

  </div>

</div>
</div>

  </div>
</div>
</div>
<script type="text/javascript">
$('#cntctAgentPopup').on('click', function() {
  $('#messageAdminPopup').provabPopup({
      modalClose: true, 
      zIndex: 10000005
  }); 
})
</script>





<!-- Page Content -->

<?php echo $this->load->view(PROJECT_THEME.'/common/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/common/load_common_js'); ?>

<!-- Script to Activate the Carousel --> 


</body>
</html>
