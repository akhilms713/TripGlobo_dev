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
<link href="<?php echo ASSETS; ?>css/toggle-switch.css" rel="stylesheet" media="screen">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Navigation -->
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
  
<div class="clearfix"></div>

<!--sidebar start-->
<aside>
  <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?>
</aside>
<!--sidebar end-->

<!--main content start-->
<section id="main-content">
<section class="wrapper">

<div class="main-chart">

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

		<div class="tab_inside_profile"> 
        <span class="profile_head">Security</span>
        
        <div class="rowit marbotom20">
        
        <div class="inreprow">
        <div class="col-md-12 nopad">
        
        	<div class="col-xs-2 nopad">
            	<div class="imagestep">
                	<img src="<?php echo ASSETS;?>images/step1.png" alt="" />
                </div>
            </div>
            
            <div class="col-xs-8 nopad fullsetting">
                <h4 class="stepshed">2 step verification </h4>
                <div class="stepspara">
                <strong>You'll need verification:</strong>
               After entering your password, you'll enter a code that you'll get via text, voice call, or our mobile app.
                </div>
			</div>
          <!-- 2-step verification -->
          
            <div class="col-xs-2 nopad fullsetting">
            	<div class="wraponof">
                    <div class="darktogle">
                       
                        <?php if($userInfo->two_step_verification  == 0 ) { ?>
                            <span class="onon">OFF</span>
                            <span class="roundtogle noo"></span>
                        <?php } else if($userInfo->two_step_verification  == 1) { ?>
                            <span class="onon">ON</span>
                            <span class="roundtogle"></span>
                        <?php } else { ?>
                            <span class="onon">OFF</span>
                            <span class="roundtogle noo"></span>
                        <?php } ?>
                         
                    </div>
                </div>
                <div class="clearfix"></div>
                <a href="<?php echo WEB_URL.'security/twostepVerification'; ?>" class="enbleink">Settings</a>
            </div>
            <!-- end of 2-step verificationsw -->
            
        </div>
        </div>
        <div class="clearfix"></div>
    
        <div class="stepline"></div>
        
        <div class="clearfix"></div>
        
        <div class="inreprow">
            <div class="col-md-12 nopad">
            <?php
			$security_question_chl='OFF';
			if($userInfo->security_question!='') {
				$security_question_chl='ON';
			}
			?>
        	<div class="col-xs-2 nopad">
            	<div class="imagestep">
                	<img src="<?php echo ASSETS;?>images/secr.png" alt="" />
                </div>
            </div>
            <div class="col-xs-8 nopad fullsetting">
                <h4 class="stepshed">Security questions and answers</h4>
                <div class="stepspara">In case you cant access your account means you can retrieve you account via using this one.<br /><br />
                    <?php

                    if($security_question_chl=='ON') {
                        echo '<b>Current Question </b> <i>'.$userInfo->security_question.'</i><br>';
                        $answer = $userInfo->security_answer;
                        $answer_length = strlen($answer);

                        if($answer_length > 4) {
                            $answer_length = $answer_length - 4;
                            $masked_answer = substr($answer, 0, 3).str_repeat('*', $answer_length).substr($answer, -1);
                        } else {
                            $masked_answer = $answer;
                        }
                        


                        echo '<b>Current Answer</b>  <i>'.$masked_answer.'</i>';
                         
                    }
                    ?>
                </div>
			</div>
           
            <div class="col-xs-2 nopad fullsetting">
            	<div class="wraponof">
                    <div class="darktogle">
                        <span class="onon "><?php echo $security_question_chl; ?></span>
                        <span class="roundtogle <?php echo ($security_question_chl == 'ON') ? '' : 'noo' ?>"></span>
                    </div>
                </div>
                <div class="clearfix"></div>
                <a class="enbleink" id="editquestion">Edit</a>
            </div>
            <div class="clearfix"></div>
           
                <div class="fullquestionswrp set_toggle">
                 <form name="Update_security_question"  id="Update_security_question" action="<?php echo WEB_URL;?>security/Update_security_question" method="POST">
                    <div class="fullquestions">
                    	<h4 class="editquestions">Edit Question Answer</h4>
                        <div class="qstn">
                            <span class="secqstn">Select Question</span>
                            <select onchange="check_security_question_v1(this.value);"  class="typecodeans" name="security_question">
                                <option value="In what city did you meet your spouse/significant other?">Child Name</option>
                                <option value="">Write Own Question</option>
                            </select>
                        </div>
                        <div class="qstn" id="check_security_question_other" style="display:none;">
                            <span class="secqstn">Question</span>
                            <input type="text" name="security_question_own" class="typecodeans" placeholder="" />
                        </div>
                        <div class="qstn">
                            <span class="secqstn">Answer</span>
                            <input type="text" required="required" name="security_answer" class="typecodeans" placeholder="Answer" />
                        </div>
                        <br />
                        <button type="submit" class="comnbutton">Save</button>
                    </div>
                </form>
                </div>
            

        </div>
        </div>
    
   
        
        <div class="clear"></div>
        
      <?php /*?> <!-- <div class="inreprow">
        <div class="col-md-12 nopad">
       
            <div class="fullquestionswrpshare">
             <form name="Update_public_private" id="Update_public_private" action="<?php echo WEB_URL;?>/dashboard/Update_public_private" method="post">
            <div class="fullquestions">
            	<h4 class="editquestions">Manage private / public settings</h4>
                <div class="rowshare">
                    <div class="col-md-6">
                        <div class="lablshare"><span class="icon icon-envelope"></span>Email Address</div>
                    </div>
                    <div class="col-md-6">
                        <label class="switch-light switch-ios" style="width: 100px" onclick="">
                          <input name="emailaddress" <?php if($userInfo->security_email_address==1) { echo ' checked="checked"'; } ?>  type="checkbox" />
                          <span class="htspan">
                            <span>Only me</span>
                            <span>Public</span>
                          </span>
                          <a></a>
                        </label>
                    </div>
                    </div>
                    <div class="rowshare">
                    <div class="col-md-6">
                        <div class="lablshare"><span class="icon icon-phone"></span>Phone Number</div>
                    </div>
                    <div class="col-md-6">
                        <label class="switch-light switch-ios" style="width: 100px" onclick="">
                          <input name="phone" type="checkbox" <?php if($userInfo->security_phone==1) { echo ' checked="checked"'; } ?>/>
                          <span class="htspan">
                            <span>Only me</span>
                            <span>Public</span>
                          </span>
                          <a></a>
                        </label>
                    </div>
                    </div>
                    <div class="rowshare">
                    <div class="col-md-6">
                        <div class="lablshare"><span class="icon icon-group"></span>Contact Address</div>
                    </div>
                    <div class="col-md-6">
                        <label class="switch-light switch-ios" style="width: 100px" onclick="">
                          <input name="address" type="checkbox" <?php if($userInfo->security_address==1) { echo ' checked="checked"'; } ?> />
                          <span class="htspan">
                            <span>Only me</span>
                            <span>Public</span>
                          </span>
                          <a></a>
                        </label>
                    </div>
                    </div>
                <?php if($this->session->userdata('b2c_id')){?>
                <div class="rowshare">
                    <div class="col-md-6">
                        <div class="lablshare"><span class="icon icon-facebook"></span>Facebook</div>
                    </div>
                    <div class="col-md-6">
                        <label class="switch-light switch-ios" style="width: 100px" onclick="">
                          <input name="facebook" type="checkbox" <?php if($userInfo->security_facebook==1) { echo ' checked="checked"'; } ?> />
                          <span class="htspan">
                            <span>Only me</span>
                            <span>Public</span>
                          </span>
                          <a></a>
                        </label>
                    </div>
                    </div>
                
                <div class="rowshare">
                    <div class="col-md-6">
                        <div class="lablshare"><span class="icon icon-twitter"></span>Twitter</div>
                    </div>
                    <div class="col-md-6">
                        <label class="switch-light switch-ios" style="width: 100px" onclick="">
                          <input name="twitter" type="checkbox" <?php if($userInfo->security_twitter==1) { echo ' checked="checked"'; } ?> />
                          <span class="htspan">
                            <span>Only me</span>
                            <span>Public</span>
                          </span>
                          <a></a>
                        </label>
                    </div>
                    </div>
                    
                <div class="rowshare">
                    <div class="col-md-6">
                        <div class="lablshare"><span class="icon icon-google-plus"></span>Google Plus</div>
                    </div>
                    <div class="col-md-6">
                        <label class="switch-light switch-ios" style="width: 100px" onclick="">
                          <input name="google" type="checkbox" <?php if($userInfo->security_google==1) { echo ' checked="checked"'; } ?>/>
                          <span class="htspan">
                            <span>Only me</span>
                            <span>Public</span>
                          </span>
                          <a></a>
                        </label>
                    </div>
                    </div>
                <?php }?>
                
                <br />
                <button type="submit" class="comnbutton">Save changes</button>
            </div>
             </form>
            </div>
            
            
        </div>
        </div>
        
        
        <div style="display:none;">
            <span class="dark size14 bold">2-Step Verification</span><br/>
            Disabled. <a href="<?php echo WEB_URL.'/verification/twostep'; ?>">Setup</a>
            <br><br>

            <span class="dark size14 bold">Notifications</span><br/>
            Change the way you recieve notifications.
            <div class="checkbox dark">
                <label>
                  <input type="checkbox" checked>
                  Make my profile private 
                </label>
            </div>
            <div class="checkbox dark">
                <label>
                    <input type="checkbox">
                    Send an email when someone replyes to one of your comments. 
                </label>
            </div>
            <br/>
            <br/>
            <span class="dark size14 bold">Who can contact me?</span><br/>
            <select class="form-control mySelectBoxClass hasCustomSelect cpwidth">
                <option value="">Everyone</option>
                <option value="">No one</option>
                <option value="">Friends</option>
            </select>
            <br/>
            <br/>
            <br/>
            <span class="dark size14 bold">Payments</span><br/>
            <div class="checkbox dark">
                <label>
                    <input type="checkbox" checked>
                    Auto Payment 
                </label>
            </div>
            
            
            </div>--><?php */?>
            
        </div>
        
        </div>



</div>

</section>
</section>

<div class="clearfix"></div>


<!-- Page Content -->

<?php echo $this->load->view(PROJECT_THEME.'/new_theme/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>

<!-- Script to Activate the Carousel --> 


</body>
</html>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/settings.js"></script>
<script>
$(document).ready(function(){
		
		$('#editquestion').click(function(){
			$('.fullquestionswrp').slideToggle(500);
		});
		
		$('#editprivatepub').click(function(){
			$('.fullquestionswrpshare').slideToggle(500);
		});
		
		$('#smsalert').click(function(){
			$('.fullquestionswrp2').slideToggle(500);
		});
		
		$('#changepaswrd').click(function(){
			$('.fullquestionswrp3').slideToggle(500);
		});

	});
	
function passwordchanges(){
	var pp = $("#password-error").html();
	var cpp = $("#cpassword-error").html();
	var npp = $("#npassword-error").html();
	
	if(pp=='' && cpp=='' && npp==''){
	   $("#passwordchanges").show(500);
	}
}
function check_security_question_v1(sec_ques){
	if(sec_ques==''){
		$("#check_security_question_other").show(500);
	}
	else {
		$("#check_security_question_other").hide(500);
	}
}
	</script>
