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
<?php  
if(isset($redirectUrl) && $redirectUrl != "") {
    $currentUrl_f = trim($redirectUrl);
} else {
    $currentUrl_f = WEB_URL.'/dashboard';
}
?>

           <?php if($verify_type == 1) { ?> 
<div class="twostep withpadd">
	<div class="cenerstepbox">
    	<h4 class="twostp">2-step verification</h4>
        <div class="imagemsg"><img src="<?php echo ASSETS;?>images/eml.png" alt=""  /></div>

        <?php 
            //$email_id = $user_data->email; 
            $explode_email_id = explode('@',$email_id);
            $email_username = $explode_email_id[0];
            $length = strlen($email_username)-2; //reduce first and last character and then take that as length.
            $masked_email_id = substr($email_username, 0,1).str_repeat('*', $length).substr($email_username, -1).'@'.$explode_email_id[1]; 
        ?>
        <div class="stpnote">An email to <b><?php echo $masked_email_id; ?></b> has been sent</div>
        <div class="clearfix"></div>
        <form action="<?php echo WEB_URL;?>/security/verifyTwoStepPassword" method="POST" id="twoStepForm">
            <input type="text"  class="typecode" id="twoStep_e" name="twoStepPwd" placeholder="Enter OTP" />
            <span style="font-size: small; color: red;" class="errCode"></span>
            <button type="submit" class="fullverify verifyTwoStepEmail" style="width: 100%">Verify</button>
        </form>
    </div><br />
    
	<div class="cenerstepbox">
    	<a class="very_links" id="resendTwoStep">Resend code?</a>
        <span class="pull-right">
            <img class="resendLoader" src="<?php echo ASSETS;?>images/preloader.gif">
            <span style="color: green; font-size: small; display: none" class="resend_success">Email sent successfully!</span>
        </span>
    </div>
    <br />
    <div class="cenerstepbox">
    	<a class="problm very_links" id="problemreceive" href="<?php echo WEB_URL.'security/problemLogIn?url='.$currentUrl_f; ?>">Problem receiving your code?</a>
    </div>
</div>
<?php } else if($verify_type == 2) { ?>
    <?php 

        //$contact = $user_data->contact_no; 
        if($this->session->userdata('temp_b2c_id')){
            $contact = $user_data->contact_no; 
        }else if($this->session->userdata('temp_b2b_id')){
            $contact = $user_data->mobile; 
        }
        $length = strlen($contact)-2;
        $masked_contact_no = substr($contact, 0, 1).str_repeat('*', $length).substr($contact, -1);
    ?>
<div class="twostep withpadd">
    <div class="cenerstepbox">
        <h4 class="twostp"><?php echo $this->lang->line('SS_2_step_Verification'); ?></h4>
        <div class="imagemsg"><img src="<?php echo ASSETS;?>images/textmsg.png" alt=""  /></div>
        <div class="stpnote"><?php echo $this->lang->line('SS_A_text_message'); ?> <b><?php echo $masked_contact_no; ?></b></div>
        <div class="clear"></div>
        
        <form action="<?php echo WEB_URL.'/security/verifyTwoStepSMSPassword' ?>" method="POST" >
            <input type="text" style="margin-bottom: 5px"  class="typecode" id="twoStep_e" name="twoStepPwd" placeholder="<?php echo $this->lang->line('SS_Enter_code'); ?>" />
            <span style="font-size: small; color: red;" class="errCode"></span>
            <button class="fullverify verifyTwoStepEmail" style="width: 100%"><?php echo $this->lang->line('SS_Verify'); ?></button>
        </form>

    </div><br />
    
    <div class="cenerstepbox">
        <a style="color: #4b8df9;" id="resendTwoStep"><?php echo $this->lang->line('SS_Resend_code'); ?></a>
        <span style="float: right;">
            <img class="resendLoader" style="float: right; display: none;" src="<?php echo ASSETS;?>images/loader.gif">
            <span style="color: green; font-size: small; display: none" class="resend_success"><?php echo $this->lang->line('SS_SMS_sent_successfully'); ?></span>
        </span>
    </div>
    <br />
    <div class="cenerstepbox">
        <a class="problm" id="problemreceive" href="<?php echo WEB_URL.'/security/problemLogIn'; ?>"><?php echo $this->lang->line('SS_Problem_receiving_code'); ?></a>
    </div>
</div>

<?php } ?>



</div>

</section>
</section>

<div class="clearfix"></div>


<!-- Page Content -->

<?php echo $this->load->view(PROJECT_THEME.'/common/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/common/load_common_js'); ?>

<!-- Script to Activate the Carousel --> 

<script type="text/javascript">
    
$('.verifyTwoStepEmail').on('click', function(e) {
    e.preventDefault();
    var verifyCode = $('#twoStep_e').val(); 
    if(verifyCode) {
        verifyCode = verifyCode.trim();
    }
    if(verifyCode.length != 0 && verifyCode != "undefined") {
        $.ajax({
            url: "<?php echo WEB_URL.'security/verifyTwoStepPassword' ?>",
            method: "POST",
            data: {twoStepPwd: verifyCode},
            dataType: 'json',
            success: function(r) {
                if(r.status == '1') {
                    window.location.href = "<?php echo $currentUrl_f; ?>";
                } else {
                    $('.errCode').html('Invalid verification code. Please try again.');
                }
            }
        });
    }else {
        $('.errCode').html('Please enter the code');
    }
});

</script>

<script type="text/javascript">
$('#resendTwoStep').on('click', function(e) {
    $('.resendLoader').fadeIn();
    e.preventDefault();
    $.ajax({
        url: "<?php echo WEB_URL.'security/verifytwostep' ?>",
        method: "POST",
        data: {"ajaxRequest": 1},
        success: function(r) {
            $('.resendLoader').hide();
            $('.resend_success').show();
        }
    })
});

$('#problemreceive').click(function(){
			$('#steptwo').fadeOut(500,function(){
				$('#stepthree').fadeIn(500);
			})
		});
</script>

</body>
</html>
