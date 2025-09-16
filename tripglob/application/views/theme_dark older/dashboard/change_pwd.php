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

<link href="<?php echo ASSETS; ?>css/dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS; ?>css/toggle-switch.css" rel="stylesheet" media="screen">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .alert-dismissable {
            padding-right: 35px;
            background: #e94d4d;
            color: white;
        }
        .pwd_img{
            max-height: 65px;
        }
    </style>
</head>
<body>
<!-- Navigation -->
<?php if($this->session->userdata('user_type')=='1' || $this->session->userdata('user_type')=='4'){
  echo $this->load->view(PROJECT_THEME.'/common/header');
}else{
  echo $this->load->view(PROJECT_THEME.'/new_theme/header'); 
} ?>
  
<div class="clearfix"></div>
<div class="dash-img"> 
</div>
<div class="container">
<div class="dashboard_section">

<div class="col-md-12 nopad">
<!--sidebar start-->
<aside class="aside col-md-3">
  <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?>
</aside>
<!--sidebar end-->

<!--main content start-->
<section id="main-content" class="col-md-12 tab_sty nopad dash-chgpwd">
<section class="wrapper"> 
    <!--<h3 class="lineth">Change Password</h3>-->
<div class="main-chart">
    <div class="col-md-2 custom-nav side-nav">
  <ul>
  <li id="all"><a href="<?php echo WEB_URL; ?>dashboard/profile" class="<?php echo $staus_profile; ?>"> 
  <i class="fal fa-user "></i> Contact Details</a></li>

  </ul>
</div>
  <div class="col-md-9 nopad">
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

    <?php if (($this->session->flashdata('password_msg'))) {
        $status_pass=$this->session->flashdata('password_msg');
        
        if($status_pass=='old_mismatch'){ ?>
            <div class="alert alert-block alert-dismissable">
                <a href="#" data-dismiss="alert" class="close">×</a>
                Old password mismatch.
            </div>
        <?php }else if($status_pass=='confirm_mismatch'){ ?>
            <div class="alert alert-block  alert-dismissable">
                <a href="#" data-dismiss="alert" class="close">×</a>
                Confirm password mismatch.
            </div>
        <?php }else if($status_pass=='success_pass'){ ?>
            <div class="alert alert-block alert-success ">
                <a href="#" data-dismiss="alert" class="close">×</a>
                Password successfully updated.
            </div>
        <?php }else if($status_pass=='somthing_wrong'){ ?>
            <div class="alert alert-block  alert-dismissable">
                <a href="#" data-dismiss="alert" class="close">×</a>
                Something went wrong.
            </div>
        <?php } 


    } ?>
    <!-- <div class="alert alert-block alert-success alert-dismissable">
        <a href="#" data-dismiss="alert" class="close">×</a>
        Your Password Successfully Updated.
    </div> -->
    
    
	
    
    <div class="rowit marbotom20 nopad">
        <div class="inreprow">
            <div class="col-md-12 nopad">
            
            	<div class="col-xs-2 nopad">
                	<div class="imagestep">
                    	<img src="<?php echo ASSETS;?>images/key.png" alt="" class="pwd_img"/>
                    </div>
                </div>
                <div class="col-xs-7 nopad fullsetting">
                    <h4 class="stepshed">You can change your password</h4>
                    <div class="stepspara">
                        <strong>Update your current Password</strong>
                    </div>
    			</div>
                <div class="col-sm-3 fullsetting nopad">
                    <a class="enbleink1 chnge_paswordd" id="changepaswrd">Change Password</a>
                </div>

                <div class="clear"></div>

                <form name="change_password" method="POST" onsubmit="passwordchanges()" id="change_password" action="<?php echo WEB_URL;?>security/ChangePassword">

                    <div class="fullquestionswrp3 set_toggle change_password_div ">
                        <h3 class="lineth">Change your password </h3>
                        <div class="fullquestions col-md-9 nopad">
                          
                             <?php if(!empty($userInfo->password)){?>
                           <div class="dashprof-inpt">
                                <div class="dash-lab">Current Password
                                </div>
                                <div class="dash-inpt">
                                <input type="password" id="password" name="opassword" class="typecodeans notypmar" required />
                                </div>
                            </div>
                             <?php }?>
                            <div class="dashprof-inpt">
                                <div class="dash-lab">
                                   New Password
                                </div>
                                <div class="dash-inpt">
                                    <input type="password" id="npassword"  name="password"  minlength="5" maxlength="50" required class="typecodeans notypmar" />
                                </div>
                            </div>
                            <div class="dashprof-inpt">
                                <div class="dash-lab">
                                    Confirm Password
                                </div>
                                <div class="dash-inpt">
                                    <input type="password" required  name="cpassword"  class="typecodeans notypmar" />
                                </div>
                            </div>
                             <div class="col-md-3 mr-18"></div>
                          <div class="col-md-4">
                            <button type="submit" class="comnbutton" >Update</button>
                            <span  id="passwordchanges" class="passucss"><span class="icon icon-check"></span>Password Changed</span>
                        </div>
                        </div>
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

</div>
</div>
</div>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<!-- Page Content -->

<?php //echo $this->load->view(PROJECT_THEME.'/new_theme/footer'); ?>
<?php //echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>

<!-- Script to Activate the Carousel --> 


<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/settings.js"></script>
<script>
 $('#changepaswrd').click(function(){
            $('.fullquestionswrp3').slideToggle(500);
        });
$(document).ready(function(){
        //alert-success
        setTimeout(function(){
            $(".alert-success").fadeOut('fast')
        },3000);

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
</body>
</html>
