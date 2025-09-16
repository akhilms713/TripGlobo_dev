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
<link href="<?php echo ASSETS; ?>css/dashboard.css" rel="stylesheet" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
  .row-new{
    margin:0px -15px; 
  }


</style>
</head>
<body>

<!-- Navigation --> 
<?php 

if($this->session->userdata('user_type')=='1' || $this->session->userdata('user_type')=='4'){
  echo $this->load->view(PROJECT_THEME.'/common/header');
}else{
  echo $this->load->view(PROJECT_THEME.'/new_theme/header'); 
}

?>
<div class="clearfix"></div>

<!-- Messages -->
<?php if (isset($email_v)) { ?>
  <div class="msg" style="display: block;"><?php echo $email_v; ?></div>
  <?php } ?>
<?php if (isset($err_v)) { ?>
  <div class="msg" style="display: block;"><?php echo $err_v; ?></div>
  <?php } ?>
<?php if (isset($d_msg)) { ?>
  <div class="msg" style="display: block;"><?php echo $d_msg; ?></div>
  <?php } ?>
<div class="msg" style="display: none;"></div>
<div class="errstatus" style="display: none;"></div>
<!-- Messages End--> 
<!-- top image-->
<div class="dash-img"> 
</div>
<div class="container">
<div class="dashboard_section">

<div class="col-md-12 nopad">
<!--sidebar start-->
<aside class="aside col-md-12 new_tab "> <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?> </aside>
<!--sidebar end--> 

<!--main content start-->
<section id="main-content" class="col-md-12 tab_sty HH nopad">
  <section class="wrapper">
    <div class="col-lg-12 cent-block main-chart">
        
    <div class="clearfix"></div>
    
    
      <div class="main_top">

        <h3 class="dashed">Welcome  To <?php echo PROJECT_TITLE; ?></h3>
        <div class="indashrow"> <span class="onlysent"> <?php echo PROJECT_TITLE; ?> brings the world closer to you. Go ahead and explore the largest range of destinations and properties, hotels with the world's leading online travel company. </span> </div>
      </div>
      <div class="clearfix"></div>
     
     <?php if($userInfo->user_type_name == 'B2B' || $userInfo->user_type_name == 'STAFF'){?>
      <link href="<?php echo ASSETS; ?>css/b2b_dashboard.css" rel="stylesheet" />
    
    <?php echo $this->load->view(PROJECT_THEME.'/new_theme/agent_search_tab'); ?>
    
    <?php }?>
   
  </section>
</section>
</div>
</div>
</div>
<!--main content end--> 

<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/footer'); ?> 
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>
</body>
</html>


 
    
