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
<style>
    @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");
.panel-title > a:before {
    float: right !important;
    font-family: FontAwesome;
    content:"\f068";
    padding-right: 5px;
}
.panel-title > a.collapsed:before {
    float: right !important;
    content:"\f067";
}
.panel-title > a:hover, 
.panel-title > a:active, 
.panel-title > a:focus  {
    text-decoration:none;
}
.help_data h3{text-align:center;padding:1em;}
</style>

</head>
<body>
<!-- Navigation -->
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
<div class="clearfix"></div>

            <div class="top_deals no-margin-top" style="min-height: 500px;">
                <div class="container">
                    <div class="row help_data">
                       <h3>Help</h3>
                         <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            
                         <?php foreach($content as $data){ ?>       
                         <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                 <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $data['id']; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $data['id']; ?>">
                             <?php echo $data['subject']; ?>
                            </a>
                          </h4>
                            </div>
                            <div id="collapse_<?php echo $data['id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body"><?php echo $data['details']; ?></div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        
                        </div>
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

