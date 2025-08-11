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
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/header'); ?>
  
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
    <span class="profile_head">SMS Alert</span>
    
        <div class="rowit marbotom20">
        <div class="inreprow">
        <div class="col-md-12 nopad">
        	<div class="col-xs-2 nopad">
            	<div class="imagestep">
                	<img src="<?php echo ASSETS;?>images/sms.png" alt="" />
                </div>
            </div>
            <div class="col-xs-8 nopad fullsetting">
                <h4 class="stepshed">SMS Alert Options</h4>
                <div class="stepspara">
                    <strong>Recieve SMS alert when the selected event occurs</strong>
                </div>
			</div>
            
            <div class="col-xs-2 nopad fullsetting">
                <a class="enbleink" id="smsalert">Edit</a>
            </div>
            <div class="clearfix"></div>
            
            <div class="fullquestionswrp2 set_toggle">
            <div class="fullquestions">
            	<h4 class="editquestions">Turn SMS alerts Off or On</h4>
                    <?php foreach($getSMSalertList as $k) { ?>
                        <div class="rowshare">
                            <div class="col-xs-6 big_pad">
                                <div class="lablshare"><?php echo $k->user_sms_alert_action; ?></div>
                            </div>
                            <div class="col-xs-6 big_pad">
                            
                                <div class="set_loader smsAlrtLdr">
                                <img src="<?php echo ASSETS.'images/preloader.gif'; ?>">
                                </div>
                                
                                <label class="switch-light switch-ios" style="width: 100px" onclick="">
                                    <?php  
                                    if(!empty($getSMSalertData)) {
                                        foreach($getSMSalertData as $check_key) {
                                            if($k->user_sms_alert_id == $check_key->alert_action_id && $check_key->alert_status == 1) {
                                                $check_box = "checked";
                                                break;
                                            } else {
                                                $check_box = "";
                                            }
                                        }
                                    } else {
                                        $check_box = "";
                                    }
                                    ?>
                                    <input class="sms_alert" data-alert_id="<?php echo $k->user_sms_alert_id; ?>" type="checkbox" <?php echo $check_box; ?> />
                                    
                                    <span class="htspan">
                                        <span>OFF</span>
                                        <span>ON</span>
                                    </span>
                                    <a></a>
                                </label>
                            </div>
                        </div>
                    <?php } ?>
                
            </div>
            </div>
        </div>
        </div>
        </div>
        
</div>

</div>


</section>
</section>

<div class="clearfix"></div>


<!-- Page Content -->

<?php echo $this->load->view(PROJECT_THEME.'/common/footer'); ?>
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

        $('#addMarkUp').click(function() {
            $('.fullquestionswrp5').slideToggle(500);
        })
			$("#add_markup").validate({
		rules: {
		    field: {
		      	required: true,
		      	number: true
		    }
		 },		
		submitHandler: function() { 
			$('#addMarkUpLoader').show();
			var action = $("#add_markup").attr('action');
			$.ajax({
				type: "POST",
				url: action,
				data: $("#add_markup").serialize(),
				dataType: "json",
				success: function(data){
					$('#addMarkUpLoader').hide();
					$('.msg').show();
					$('.msg').text('Mark up updated successfully.');
					$('.fullquestionswrp5').slideToggle(500);
				}
			});
			return false; 
		}
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
