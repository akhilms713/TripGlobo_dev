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
</head>
<body>
<?php echo $this->load->view(PROJECT_THEME.'/common/header'); ?>
<div class="clearfix"></div>


<div class="not_found top80">
	<div class="container">
    	<div class="center_not">
        	<div class="image_not">
            	<img src="<?php echo $this->general_model->convert_image_base64(ASSETS.'images/page_not_found.png'); ?>" alt="">
            </div>
            <div class="clearfix"></div>
            
            <div class="four_nor">404<strong>page not found!</strong></div>
            
            <div class="clearfix"></div>
            <a class="cancel_search" href="<?php echo WEB_URL; ?>"><span class="fa fa-long-arrow-left"></span>Back to home</a>
        </div>
    </div>
</div>


<div class="clearfix"></div>
<?php echo $this->load->view(PROJECT_THEME.'/common/footer'); ?>
</body>
</html>