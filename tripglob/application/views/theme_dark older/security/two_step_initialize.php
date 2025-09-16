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
<link href="<?php echo ASSETS; ?>css/dashboard.css" rel="stylesheet" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Navigation -->
<?php echo $this->load->view(PROJECT_THEME.'/common/header'); ?>
  
<div class="clearfix"></div>

<!--sidebar start-->
<aside>
  <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?>
</aside>
<!--sidebar end-->

<!--main content start-->
<section id="main-content">
<section class="wrapper">

<div class="main-chart">

<div class="twostep"> <!-- Removed stepone id from here, It was affecting back button functionality ..Vikas Arora. -->
  <div class="col-md-8 nopad">
      <h3 class="stepsbighed">Signing in with 2-step verification </h3>
      <div class="col-md-12 nopad">
          <div class="col-md-3">
              <div class="imagestep">
                  <img src="<?php echo ASSETS;?>images/step1.png" alt="" />
                </div>
            </div>
            <div class="col-md-9">
                <h4 class="stepshed">Signing in will be different </h4>
                <div class="stepspara"><strong>You'll need verification codes:</strong>
    After entering your password, you'll enter a code that you'll get via text, voice call, or our mobile app. </div>
      </div>
        </div>
        <div class="clear"></div>
        <div class="stepline"></div>
        
        <div class="col-md-12 nopad">
          <div class="col-md-3">
              <div class="imagestep">
                  <img src="<?php echo ASSETS;?>images/step2.png" alt="" />
                </div>
            </div>
            <div class="col-md-9">
                <h4 class="stepshed">Signing in will be different </h4>
                <div class="stepspara"><strong>You'll need verification codes: </strong>
    After entering your password, you'll enter a code that you'll get via text, voice call, or our mobile app. </div>
      </div>
        </div>
        
        <div class="clear"></div>
        <div class="stepline"></div>
        
        <div class="col-md-12 nopad">
          <div class="col-md-3">
              <div class="imagestep">
                  <img src="<?php echo ASSETS;?>images/step3.png" alt="" />
                </div>
            </div>
            <div class="col-md-9">
                <h4 class="stepshed">Signing in will be different</h4>
                <div class="stepspara"><strong>You'll need verification codes: </strong>
    After entering your password, you'll enter a code that you'll get via text, voice call, or our mobile app. </div>
      </div>
        </div>
    </div>
    
    <div class="col-md-4 nopad">
      <div class="stepfolow">
          <h4 class="instructn">Signing in with 2-step verification</h4>
            <span class="paraveri">After entering your password, you'll enter a code that you'll get via text, voice call, or our mobile app.</span>
            <div class="clear"></div>
            <a href="<?php echo WEB_URL.'security/setUpTwoStep'; ?>" class="startuostep" id="startstep">Start setup</a>
            <div class="clear"></div>
            <a class="forgotsomthig"> Learn More</a>
        </div>
    </div>
</div>

</div>

</section>
</section>

<div class="clearfix"></div>




<!-- Page Content -->

<?php echo $this->load->view(PROJECT_THEME.'/common/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/common/load_common_js'); ?>

<!-- Script to Activate the Carousel --> 




<script type="text/javascript">
  $(document).ready(function(){
    $('#startstep').click(function(){
      $('#stepone').fadeOut(500,function(){
        $('#steptwo').fadeIn(500);
      })
    });
    
    $('#problemreceive').click(function(){
      $('#steptwo').fadeOut(500,function(){
        $('#stepthree').fadeIn(500);
      })
    });
    
  });
</script>

</body>
</html>