<!DOCTYPE html>
<html lang="en">
<head>
 
  <link rel="icon" href="https://tripglobo.com/assets/theme_dark/images/favicon.png" type="image/x-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <title><?php echo PROJECT_TITLE; ?></title>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_css'); ?>
</head>
<body>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
  

<style>
    .error_request{
        background-color: #f7f5f5;
        padding:15% 20px 10%;
        text-align: center;
    }
    h3{
        color: #e80000;
        margin-bottom: 10px;
    }
    strong{
        font-weight: 500;
        color: #3c0bb4;
        margin-top: 5px;
    }
    span{
        font-weight: 800;
        color: #3c0bb4;
    }
    button {
        padding: 10px;
        border: none;
        border-radius: 7px;
        margin-top: 14px;
        color: #FFFFFF;
        background: lightskyblue;
    }
    .main-pge_1{
        color:#FFFFFF;
    }
</style>
<div class="error_request">
  <div>
        <h3>No result found !!!</h3>    
        <h3>Please Try Again with new search...!!!</h3>  
        <!-- <strong>You can use Reference Contact To Talk to Our Customer Support</strong>  -->
        <span><a href="mailto:contact@tripglobo.com">contact@tripglobo.com</a></span>
  </div>
  <button><a class="main-pge_1" href="https://tripglobo.com/" >Main Page</a></button>   
  </div>       

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/footer_js'); ?>
</body>
</html>