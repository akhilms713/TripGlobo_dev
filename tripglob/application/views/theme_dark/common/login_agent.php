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
<body>
<!-- Navigation --> 

<?php echo $this->load->view(PROJECT_THEME.'/common/header'); ?>

<div class="clearfix"></div>
<div class="agent_login_wrap top80 agent_login_wrap_height">
<div class="container" style="background: ;">
	<div class="inside_agent">
    
   		<div class="col-md-4 rit_agent">
            <div class="centerfix">
      
              <div class="wrapdivs" id="forgotpasemail_agent" style="display: none">
                <div class="popuperror" style="display:none;"></div>
                <div  class="pophed">Enter your Email Id</div>
                <div class="signdiv">
                  <div id="AgntloginLdrReg" class="lodrefrentrev imgLoader">
                    <div class="centerload"></div>
                  </div>
                  <div class="insigndiv">
                    <form id="AgentResetPassword" name="AgentResetPassword" action="<?php echo WEB_URL;?>account/sendAgentPassResetLink">
                      <input type="hidden" name="user_type_name" value="B2B">
                      <div class="signupul22">
                        <div class="rowput"> <span class="fa fa-envelope"></span>
                          <input class="form-control logpadding" value="" type="email" name="agent_reset_email" placeholder="Email ID" minlength="5" required/>
                        </div>
                        <div class="clearfix"></div>
                        <div class="signupterms"> You will receive a reset password link through email. </div>
                        <div class="clearfix"></div>
                        <input type="submit" class="submitlogin" value="Send Reset Link" />
                        <div class="clearfix"></div>
                    	<div class="dntacnt">I remember my password <a class="remember_acnt">SignIn</a> </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              
              
              
              <div class="wrapdivs" id="signinfix">
                <div class="popuperror" style="display:none;"></div>
                <div  class="pophed">Agent SignIn</div>
                <div class="signdiv">
                  <div class="insigndiv">
                    <form id="Agentlogin" name="Agentlogin" action="<?php echo WEB_URL;?>account/login">
                      <input type="hidden" id="user_type_name" name="user_type_name" value="B2B">
                      <div class="ritpul">
                        <div class="rowput"> <span class="fa fa-envelope"></span>
                          <!-- <input class="form-control logpadding" onblur="get_user_type(this.value)" type="email" name="email" placeholder="Email Address" required> -->
                          <input class="form-control logpadding"  type="email" name="email" placeholder="Email Address" required>
                        </div>
                        <div class="rowput"> <span class="fa fa-lock"></span>
                          <input class="form-control logpadding" type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="misclog"> 
                        <!-- <a class="rember"><input type="checkbox" />Remember</a>  -->
                          <a class=" forgota" id="forgtpsw_agent">Forgot Password?</a> </div>
                        <div class="clearfix"></div>
                        <button class="submitlogin">Login</button>
                        <div class="clearfix"></div>
                        <div class="dntacnt">Don't have an account? <a class="signupfixed" href="<?php echo WEB_URL;?>account/agent_registration">SignUp</a> </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              
              <div class="wrapdivs" id="agentVerification" style="display: none;">
                <div class="popuperror" style="display:none;"></div>
                <div  class="pophed">Verify Your Account</div>
                <div class="signdiv" style="position: relative">
                  <div id="AgntVeriContact" class="lodrefrentrev imgLoader">
                    <div class="centerload"></div>
                  </div>
                  <div class="insigndiv">
                    <form id="AgentVerify" name="AgentVerify" action="<?php echo WEB_URL;?>account/verifyContactDetails" method="post">
                      <input type="hidden" name="verify_id" id="verify_id" value=""  required>
                      <div class="ritpul"> <span class="veri_msg"> Enter the verification codes sent to your email and mobile numbers </span>
                        <div class="rowput"> <span class="fa fa-envelope"></span>
                          <input class="form-control logpadding" type="text" name="veri_email" id="veri_email" placeholder="Email OTP" required>
                        </div>
                        <div class="rowput"> <span class="fa fa-phone"></span>
                          <input class="form-control logpadding" type="type" name="veri_mobile" id="veri_mobile" placeholder="Mobile OTP" required>
                        </div>
                        <div class="clearfix"></div>
                        <button class="submitlogin">Submit</button>
                        <div class="clearfix"></div>
                        <div class="dntacnt">
                        <a  data-toggle="modal" data-target="#facing_problem"  class="problemReceCode problemReceCode_open">If You Have Facing Any Problem?</a> </div>
                      </div>
                    </form>
                  </div>
                  <div id="messageSentPopup" style="display: none" class="thnkupopup">
                    <div class="thankudiv">
                      <div class="thnkutik"><img src="<?php echo ASSETS ?>/images/aptcheck.png" alt="Thank you"></div>
                      <h3>Thank You.</h3>
                      <p>Will Back Soonly.</p>
                    </div>
                  </div>
                </div>
              </div>
              
              
              
              
              
              <div id="facing_problem" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Contact Admin</h4>
                      </div>
                      <div class="clearfix"></div>
                      <div class="modal-body">
                        <form method="POST" action="<?php echo WEB_URL.'auth/contactAdmin'; ?>" id="cntctAdmin">
                            <div class="poprow">
                              <div class="col-md-12"> 
                              	<span class="poplabel_msg">Enter your message:</span>
                                <textarea name="agentMsg" class="simtextre" id="msgId" placeholder="Enter the problem faced while receiving the verification code..." required></textarea>
                              </div>
                            </div>
                            <div class="clearfix"></div>
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


<script type="text/javascript">

$(document).ready(function(){
	$('.remember_acnt').click(function(){
			$('#forgotpasemail_agent').fadeOut(500,function(){
				$('#signinfix').fadeIn(500);
			});
	});

	$('#forgtpsw_agent').click(function(){
		$('#signinfix').fadeOut(500,function(){
			$('#forgotpasemail_agent').fadeIn(500);
		});
	});
	
	
});
</script>

<!-- Page Content --> 

<script>
	function get_user_type(emailval){
		$.ajax({
			type: "GET",
			url: WEB_URL+'account/get_usertype',
			data: { email : emailval },
			dataType: "json",
			success: function(data){
				if(data.usertype != ''){
					$('#user_type_name').val(data.usertype);
				} else {
					alert('Email address is not registered.');
				}
			}
		});
	}
</script>

<?php echo $this->load->view(PROJECT_THEME.'/common/load_common_js'); ?> 


</body>
</html>
