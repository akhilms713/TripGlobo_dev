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
<!--  <link href="<?php echo ASSETS; ?>css/temp_1.css" rel="stylesheet"> -->
<link href="<?php echo ASSETS; ?>css/custom_style.css" rel="stylesheet">


</head>
<style>
    .rsnd_otp{
        float: right;
        margin: 7px 1px -8px 0px;
    }
    .inp_otp{
        margin-top: 7px;
    }
</style>
<body>
<!-- Navigation --> 

<?php echo $this->load->view(PROJECT_THEME.'/common/header'); ?>

<div class="clearfix"></div>
<div class="agent_login_wrap top80 agent_login_wrap_height">
<div class="container" style="background: ;">
	<div class="inside_agent">
    
   		<div class="col-md-4 rit_agent">
            <div class="centerfix">
      
              
              <div class="wrapdivs" id="signinfix">
                <div class="popuperror" style="display:none;"></div>
                <div  class="pophed">Validate OTP(One Time Passcode)</div>
                <div class="signdiv">
                  <div class="insigndiv">
                    <form method="POST" action="<?php echo WEB_URL; ?>account/login_check_next ">
                      <input type="hidden" name="ref" value="<?php echo $_GET['ref']; ?>">
                      
                      <div class="ritpul">
                        <div>
                            <span class="span_text">Your OTP has been sent to your mobile phone.Please enter the OTP below to verify your account.</span>
                            <input type="text" class="form-control inp_otp" placeholder="Enter OTP to login" name="otp" required />
                        </div>
                        
                        <div class="misclog">
                          <a class="rsnd_otp" href="<?php echo WEB_URL.'account/resend_otp/'.$_GET['ref']; ?>">Resend OTP</a>  </div>
                        <div class="clearfix"></div>
                        <button class="btn btn-default submitlogin submit_otp" id="loginbtn" type="submit">Validate OTP</button>
                        <div class="clearfix"></div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>
    	
        <div class="col-md-8">
        	<div class="inside_benefits">
            	<div class="benefits">
                	<h3 class="bene_hd">Login as an agent!</h3>
                    <ul class="ben_agent">
                    	<li><span class="fa fa-rocket"></span><strong>There are many variations of passages of Lorem Ipsum available</strong></li>
                        <li><span class="fa fa-rocket"></span><strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry</strong></li>
                        <li><span class="fa fa-rocket"></span><strong>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet</strong></li>
                        <li><span class="fa fa-rocket"></span><strong>There are many variations of passages of Lorem Ipsum available</strong></li>
                        <li><span class="fa fa-rocket"></span><strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry</strong></li>
                    </ul>
                </div>
            </div>
        </div>
        
    	
    </div>
</div>
</div>
<?php echo $this->load->view(PROJECT_THEME.'/common/footer'); ?> 
<?php echo $this->load->view(PROJECT_THEME.'/common/load_common_js'); ?> 

<script>
<?php 
    $status=$this->session->flashdata('status');
    if(isset($status) && $status != '')
    {
?>
        $('.popuperror').html('');
        $('.popuperror').show();
        $('.popuperror').html("<?php echo $status; ?>");
<?php
    }
?>
</script>
</body>
</html>
