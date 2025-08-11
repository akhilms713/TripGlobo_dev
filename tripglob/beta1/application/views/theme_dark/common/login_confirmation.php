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
<body class="noside">
<!-- Navigation --> 
<?php echo $this->load->view(PROJECT_THEME.'/common/header'); ?>
<div class="clearfix"></div>

<!--main content start-->
<section class="top80 noother">
  <section class="wrapper">
    <div class="main-chart">
      <div class="twostep withpadd">
        <div class="cenerstepbox login_confirm">
          
          <div class="thankudiv">
            <span class="fa fa-check-square-o"></span>
                <div class="messgae_thank">
                    <h3>Congratulations!</h3>
                    <p>Thanks for registering with us. Your account verification has been completed.</p>
                </div>
          </div>
          

          <a class="cancel_search" href="<?php echo WEB_URL.'account/agent_login'; ?>"><span class="fa fa-long-arrow-left"></span>Back to home</a>

        </div>
      </div>
    </div>
  </section>
</section>
<div class="clearfix"></div>

<!-- Page Content --> 

<?php echo $this->load->view(PROJECT_THEME.'/common/footer'); ?> <?php echo $this->load->view(PROJECT_THEME.'/common/load_common_js'); ?> 

<!-- Script to Activate the Carousel -->

</body>
</html>
