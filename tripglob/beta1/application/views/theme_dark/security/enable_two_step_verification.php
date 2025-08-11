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
<body>
<!-- Navigation -->
<?php echo $this->load->view(PROJECT_THEME.'/common/header'); ?>
  
<div class="clearfix"></div>

<!--sidebar start-->
<aside>
  <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?>
</aside>
<!--sidebar end-->

<section id="main-content">
<section class="wrapper">

<div class="main-chart">

<?php
if($securityQuestionExist->security_question != "" || $securityQuestionExist->security_answer != "") { 
    $display_steps = "";
} 
else {
    $display_steps = "style = 'display: none;' ";
}

if(!empty($twoStepTypeEnabled)){
    if($twoStepTypeEnabled->two_step_verification == 0 && $twoStepTypeEnabled->two_step_type == 0) { //everything is off right now
        $active_email = "";
        $active_phone = "";
        $display_disable_btn = 0;
    } else if($twoStepTypeEnabled->two_step_verification == 1 && $twoStepTypeEnabled->two_step_type == 1) { //2-step is on for EMAIL
        $active_email = "ssactive";
        $active_phone = "";
        $display_disable_btn = 1;
    } else if($twoStepTypeEnabled->two_step_verification == 1 && $twoStepTypeEnabled->two_step_type == 2) { ////2-step is on for MOBILE
        $active_phone = "ssactive";
        $active_email = "";
        $display_disable_btn = 1;
    } else {
        $active_email = "";
        $active_phone = "";
        $display_disable_btn = 0;
    }
} else {
    $display_disable_btn = "";
}
?>
<div class="seconfirm" id="choose_type" <?php echo $display_steps; ?> >
    <span class="profile_head">2-step verification </span>

    <div id="collapse2step" class="collapse in">
        <div class="colsppad">
        	<div class="col-md-6">
            	<div class="colcentrtbl">
                <div class="ajaxtime"></div>
                	<div class="stndrdimg">
                    	<img src="<?php echo ASSETS;?>images/phonevery.png" alt="" />
                    </div>
                    <h4 class="wichvery">Phone Verification</h4>
                    <?php  
                    if(isset($userInfo->mobile_phone) && $userInfo->mobile_phone != "") {
                        $number = $userInfo->mobile_phone;
                    } else {
                        $number = "**********";
                    }

                    ?>

                    <p>A verification code to the number <b>"<?php echo $number; ?>"</b> will be sent via text message whenever you will log in.</p>
                    
                    <div data-verifyType="2" class="clickblebtn <?php echo $active_phone; ?> btnvery2 twoStepEnable"></div>
                
                </div>
            </div>
            <div class="col-md-6">
            	<div class="colcentrtbl">
                <div class="ajaxtime"></div>
                	<div class="stndrdimg">
                    	<img src="<?php echo ASSETS;?>images/eml.png" alt="" />
                    </div>
                    <h4 class="wichvery"> Email Verification</h4>
                    <?php  
                    if(isset($userInfo->user_email) && $userInfo->user_email != "") {
                        $email_addr = $userInfo->user_email;
                    }  else {
                        $email_addr = "**********@*****.***";
                    }

                    ?>
                    <p>A verification code to the email address <b>"<?php echo $email_addr; ?>"</b> will be sent whenever you will log in.</p>
                    <div data-verifyType="1" class="clickblebtn <?php echo $active_email; ?> btnvery2 twoStepEnable"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if($display_disable_btn == 1 && $securityQuestionExist->security_question != "" && $securityQuestionExist->security_answer != "" ) { ?>
<div class="seconfirm">
    <span class="profile_head">Disable 2-Step Verification </span>
                        
    <div id="collapseDisable2Step" class="collapse in">
        <div class="colsppad" style="text-align: center;">
            <p> If you do not wish to have two step verification while logging in, you can disable it from here</p>            
            <a href="<?php echo WEB_URL.'security/disableTwoStepVerification'; ?>" class="startuostep">Disable 2-Step Verification</a>
        </div>
    </div>
</div>
<?php } ?>



<?php if($securityQuestionExist->security_question == "" && $securityQuestionExist->security_answer == "" ){ ?>
<div class="seconfirm">
    
    <span class="profile_head">Security Question and Answers</span>
						
    <div id="collapseqstion" class="collapse in">
        <div class="colsppad">
        	<div class="col-md-12">
            	<div class="colcentrtbl">
                <div class="ajaxtime"></div>
                	<div class="stndrdimg">
                    	<img src="<?php echo ASSETS;?>images/cnfirmsec.png" alt="" />
                    </div>
                    <h4 class="wichvery">Security questions and answers </h4>
                    <p>In case of having problem while retrieving 2-Step verification code, you can access account by answering a security question.</p>
                    <div class="qstn">
                        <select onchange="check_security_question_v1(this.value);" class="typecodeans" id="security_question" name="security_question">
                            <option value="In what city did you meet your spouse/significant other?">City Name</option>                          
                        </select>
                    </div>
                    <div class="qstn" id="check_security_question_other" style="display:none;">
                        <span class="secqstn">Own Question</span>
                        <input type="text" name="security_question_own" id="security_question_own" class="typecodeans" placeholder="Type Here" />
                        <span style="color: red; font-size: small" id="checkQuesMsg"></span>
                        
                    </div>
                    <div class="qstn" id="check_security_question_other">
                        <span class="secqstn">Answer</span>
                        <input type="text" id="security_answer" name="security_question_own" class="typecodeans" placeholder="Type here" />
                        <span style="color: red; font-size: small" id="checkAns"></span>
                    </div>
                    
                
                    <div class="clickblebtn ssactive btnveryqstn"></div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<?php } ?>

</div>

</section>
</section>

<div class="clearfix"></div>

<?php echo $this->load->view(PROJECT_THEME.'/common/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/common/load_common_js'); ?>

<!-- Script to Activate the Carousel --> 




<script type="text/javascript">
    
function check_security_question_v1(sec_ques) {
    if(sec_ques=='') {
        $("#check_security_question_other").show(500);
    } else{
        $("#check_security_question_other").hide(500);
    }
}

</script>

<script type="text/javascript">
$(document).ready(function(){

$('.twoStepEnable').click(function(){
    if($(this).hasClass('ssactive')) { 
		return false;
	}
    $(this).siblings('.ajaxtime').fadeIn(200);
    var verificationType = $(this).attr('data-verifyType');
    if(verificationType) {
        verificationType = verificationType.trim();
    }
    
    if(verificationType){
        $.ajax({
            url: "<?php echo WEB_URL.'security/enableTwoStepVerification' ?>",
            method: "POST",
            data: {'verificationType': verificationType},
            dataType: 'json',
            success: function(r) {
                $('.ajaxtime').fadeOut(200);
                window.location.href = WEB_URL+'/dashboard/settings';
            }
        });
    }
    $('.btnvery2').removeClass('ssactive');
	$(this).addClass('ssactive');
});

	
$('.btnveryqstn').click(function(){ 
    var security_question = $('#security_question').val();
    var security_question_own = $('#security_question_own').val();
    
    if(security_question) {
        security_question = security_question.trim();
        $("#checkAns").text('');
    } else if(security_question_own) {
        security_question = security_question_own.trim();
        $("#checkAns").text('');
    } else {
        $("#checkQuesMsg").text('Please select a security question or type one of your own.');
        return false;
    }

    var security_answer = $('#security_answer').val();
    if(security_answer) {
        security_answer = security_answer.trim();
        $("#checkAns").text('');
    } else {
        $("#checkAns").text('Please give an answer to the question.');
        return false;
    }


	if(security_question && security_answer) {
        $(this).siblings('.ajaxtime').fadeIn(200);
        $.ajax({
            url: "<?php echo WEB_URL.'security/updateSecurityQuestionAnswer' ?>",
            method: "POST",
            data: {'security_question': security_question, "security_answer": security_answer},
            dataType: 'json',
            success: function(r) {
                $(this).toggleClass('ssactive');
                $('.ajaxtime').fadeOut(200);
                $('#choose_type').fadeIn();
                $('html,body').animate({scrollTop: 0}, 800);
            }
        });
    }
});
	
});
</script>

</body>
</html>