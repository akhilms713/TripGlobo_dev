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


    <span class="profile_head">Close Account</span>
    
        <div class="rowit marbotom20">
            <div class="inreprow">
        <div class="col-md-12 nopad">
        	<div class="col-xs-2 nopad">
            	<div class="imagestep">
                	<img src="<?php echo ASSETS;?>images/cancel.png" alt="" />
                </div>
            </div>
            <div class="col-xs-8 nopad fullsetting">
                <h4 class="stepshed"> Close Account</h4>
                <div class="stepspara"><strong>You'll need verification codes</strong>
    After entering your password, you'll enter a code that you'll get via text, voice call, or our mobile app.</div>
			</div>
            
            <div class="col-sm-2 fullsetting">
                <a class="enbleink" data-toggle="modal" data-target="#cancelAccount"> Close Account</a>
            </div>
      

            <div class="clearfix"></div>
            
    		<div class="popup_wrapper fullquestionswrp4 modal fade" id="cancelAccount">
                <div class="modal-dialog">
    				<div class="modal-content">
                    <div class="popuperror" style="display:none;"></div>
                   
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Close Account</h4>
                    </div>
                    
                    <div class="signdiv">
                        <div class="rowlistwish">
                            <strong>Closing your account will delete all your information from </strong>
                        </div>
                        
                      <div class="clear"></div>
                      <div class="downselfom">
                        <a class="savewish colorcancel" id="hideCancelPopup" data-dismiss="modal">Cancel</a>
                        <a class="savewish colorsave" id="startCancelProc">Start Closing Process</a>
                      </div>
                    </div> 
                    </div>    
                </div>
            </div>

            <div id="cancel2stepVerify" class="wellme minwidth" style="display: none;">
                <div class="popuperror" style="display:none;"></div>
                <div  class="pophed"> Close Account</div>
                <div class="signdiv">
                    <div class="rowlistwish">
                        <strong>Enter Verification Code <span id="typeString"></span> </strong>
                        <input type="text" class="fulwish typecodeans" id="twoStepCode" style="border: 1px solid #777" />
                        <span id="verificationCodeErr" style="color:red; font-size: small"></span>
                    </div>
                    
                  <div class="clear"></div>
                  <div class="downselfom">
                    <a class="savewish colorsave" id="verifyPswd">Submit</a>
                  </div>
                </div>
            </div>

            <div id="cancelLoginPswd" class="wellme minwidth" style="display: none;">
                <div class="popuperror" id="popuperror_verifyOneStepPswd" style="display:none;">Password Missing.</div>
                <div  class="pophed">Close Account</div>
                <div class="signdiv">
                    <div class="rowlistwish">
                        <strong>Enter Password</strong>
                        <input type="text" class="fulwish typecodeans" id="oneStepCode" style="border: 1px solid #777" />
                    </div>
                    
                  <div class="clear"></div>
                  <div class="downselfom">
                    <a class="savewish colorsave" id="verifyOneStepPswd">Submit</a>
                  </div>
                </div>
            </div>

            <div class="wellme col-md-2" style="display: none" id="showLoader">
                <div class="rowlistwish">
                   <div   class="lodrefrentrev imgLoader"><div class="centerload"></div>
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
