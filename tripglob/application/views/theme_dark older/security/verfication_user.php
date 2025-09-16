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
   
   
   <div id="messageSentPopup"  class="thanks_msg">
    <div class="thankudiv">
    <span class="fa fa-check-square-o"></span>
    	<div class="messgae_thank">
        	<h3>Thank You.</h3>
        	<p>Will Back Soonly.</p>
        </div>
      </div>
    </div>
    <div class="clearfix"></div> 
    
<div class="twostep withpadd">
    <div class="cenerstepbox">
    
      <div class="wrapdivs" id="agentVerification"  > 
        <div class="popuperror" style="display:none;"></div>
        <div  class="pophed">Verify Your Account</div>
        <div class="signdiv" style="position: relative">
          <div id="AgntVeriContact" class="lodrefrentrev imgLoader">
            <div class="centerload"></div>
          </div> 
            <div class="insigndiv">
              <form id="AgentVerify" name="AgentVerify" action="<?php echo WEB_URL;?>account/verifyContactDetails" method="post">
              <input type="hidden" name="verify_id" id="verify_id" value="<?php if(isset($vid) && $vid!='') { echo $vid; } ?>"  required>
                 <div class="ritpul"> 
                    <span class="nav_codesent">
                     Enter the verification codes sent to your email and mobile numbers
                    </span>
                    <div class="rowput">
                      <span class="fa fa-envelope"></span>
                      <input class="form-control logpadding" type="text" name="veri_email" id="veri_email" placeholder="Email OTP" required>
                    </div>
                    <div class="rowput">
                        <span class="fa fa-phone"></span>
                        <input class="form-control logpadding" type="type" name="veri_mobile" id="veri_mobile" placeholder="Mobile OTP">
                    </div>
                    <div class="clear"></div>
                    <button class="submitlogin">Submit</button>
                    <div class="clear"></div>
                    <div class="dntacnt"><a   class="problemReceCode problemReceCode_open" data-toggle="modal" data-target="#cntctAgentPopup">If You Have Facing Any Problem?</a> </div>
                </div>
              </form>
            </div>
            
            
        </div>
      </div>
</div>
</div>
  
  
</div>

</section>
</section>

<div class="clearfix"></div>





<div id="cntctAgentPopup" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Contact Admin</h4>
      </div>
      <div class="clearfix"></div>
      <div class="modal-body">
        <form method="POST" action="<?php echo WEB_URL.'auth/contactAdmin'; ?>" id="cntctAdmin">
          <input type="hidden" name="vid_c"  value="<?php echo $vid; ?>">
            <div class="poprow">
              <div class="col-md-12">
                <span class="poplabel_msg">Enter your message:</span>
                <textarea name="agentMsg" class="simtextre" id="msgId" placeholder="Enter the problem faced while receiving the verification code..." required></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <button class="popbutton blubutton help_btn" type="submit">Send Message</button>
            </div>
          </form>
      </div>
      <div class="clearfix"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<!-- Page Content -->

<?php echo $this->load->view(PROJECT_THEME.'/common/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/common/load_common_js'); ?>


</body>
</html>
