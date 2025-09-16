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
<!-- Custom CSS -->
<link href="<?php echo base_url(); ?>assets/theme_dark/css/index.css" rel="stylesheet" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- jQuery Version 1.11.0 -->


</head>
<body>
<!-- Navigation -->
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
<div class="clearfix"></div>


            <div class="top_deals no-margin-top" style="min-height: 500px;">
                <div class="container"><?php //echo '<pre>'; print_r($content); exit(); ?>
                    <h3 class="inpagehed inner-page-header"><span><?php echo $content->footer_name; ?></span></h3>
                        <div class="cmscontent dynam">                          
                                <div class="col-xs-12 nopad">
                                    <?php echo $content->description; ?>
                                 </div> 
                         </div>
                  </div>
                </div>
            

<!--Advertise-->
<!--Advertise-->

<div class="clearfix"></div>


<div class="clearfix"></div>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>

<!-- /.container --> 

<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>

<?php //echo $this->load->view(PROJECT_THEME.'/new_theme/footer_js'); ?>


</body>
</html>

