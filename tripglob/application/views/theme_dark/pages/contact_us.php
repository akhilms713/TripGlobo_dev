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

<style type="text/css">
  .row-margin{
  margin-left: -15px;
  margin-right: -15px;
  }
  .con-info{
    width: 100%;
    display: table-row;
    margin-bottom: 20px;
    clear: both;
    float: left;
  }
  .con-icon{
    
    display: table-cell;
    vertical-align: top;
    padding-right: 20px; 
  }
  .con-info span{
    display: table-cell;
    vertical-align: top;
    font-size: 18px;
    line-height: 22px;
  }
  .con-icon i{
    background: #484a4c;
    width: 46px;
    height: 46px;
    color: #ec3438;
    font-size: 24px;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 2px 2px 3px #29222285;
}

.map_box{
  width: 100%;
  height: 200px;
  float: left;
  margin-bottom: 25px;
}




</style>
</head>
<body>
<!-- Navigation -->
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
<div class="clearfix"></div>


            <div class="top_deals no-margin-top" style="min-height: 500px;">
                <div class="container">
                    <h3 class="inpagehed inner-page-header"><span>Contact Us</span></h3><br/><br/>
                      
  <div class="row-margin">
  <div class="col-md-6 col-sm-6 col-xs-12">
  <h3 style="margin-bottom: 30px">Send A Message</h3>
  <form action="<?php echo WEB_URL.'general/save_contact_us'; ?>" method="POST">
    <div class="row-margin">
    <div class="col-md-6">
      <div class="form-group">
        <label for="fname">First Name :</label> 
        <input type="text" name="fname" class="form-control" required="required" id="fname">
      </div>
      </div>
      <div class="col-md-6">
      <div class="form-group">
        <label for="lname">Last Name :</label>
        <input type="text" name="lname" class="form-control" required="required" id="lname">
      </div>
      </div>
      </div>
      <div class="row-margin">
    <div class="col-md-6">
      <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" class="form-control" name="email" required="required" id="email">
      </div>
      </div>
      <div class="col-md-6">
      <div class="form-group">
        <label for="phone">Phone :</label>
        <input type="number" class="form-control"  name="phone" required="required" id="phone">
      </div>
      </div>
      </div>
      <div class="form-group">
        <label for="message">Message :</label>
        <textarea class="form-control" id="message" name="message" required="required" rows="5"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form> 
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <h3 style="margin-bottom: 30px">Contact Information</h3>

    <div class="map_box">
      <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d15559.47957618634!2d77.65057346977538!3d12.851678850000004!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1538717506459" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>

    </div>
    <div class="con-info"><div class="con-icon"><i class="fa fa-map-marker"></i></div><span>2nd Floor, Venkatadri IT Park, HP Avenue, Konnappana Agrahara, Electronic city, Bengaluru, Karnataka 560069</span></div>
    <div class="con-info"><div class="con-icon"><i class="fa fa-phone"></i></div><span>+91 96 8959 2534</span></div>
    <div class="con-info"><div class="con-icon"><i class="fa fa-envelope"></i></div><span>info@flyonair.com</span></div>
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

