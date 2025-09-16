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
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/dataTables.tableTools.css">
</head>
<body>
<!-- Navigation --> 
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/header'); ?>
<div class="clearfix"></div>

<!--sidebar start-->
<aside> <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?> </aside>
<!--sidebar end--> 

<!--main content start-->
<section id="main-content">
  <section class="wrapper">
<div class="main-chart">

<div  id="trustnveri"> 


  <div class="withedrow">
     
  		<span class="profile_head">Your Current Verifications</span>
        <div class="rowit">
          <?php 
            $count = $this->verification_model->checkUserVerfication($user_id, $user_type)->num_rows();
            if($count == 1){
              $verifications = $this->verification_model->checkUserVerfication($user_id, $user_type)->row();
              if($verifications->mobile_verify == 1){
                echo '<div class="all_very"><div class="fa fa-envelope vericon"></div><div class="veriside"><span class="rowsubhd">Email Address</span>
				<div class="veried_para">You have confirmed your email: <span class="very_email">'.$userInfo->user_email.'</span> <strong>A confirmed email is important to allow us to securely communicate with you.</strong></div></div></div>';
              }
              if($verifications->mobile_verify == 1){
                echo '<div class="all_very"><div class="fa fa-mobile vericon"></div><div class="veriside"><span class="rowsubhd">Contact Number</span>
				<div class="veried_para">You have confirmed your Contact Number: <span class="very_email">'.$userInfo->mobile_phone.'</span> <strong>A confirmed Contact Number is important to allow us to securely communicate with you.</strong></div></div></div>';
              }
              if($verifications->mobile_verify == 0 && $verifications->mobile_verify == 0){
                echo '<span class="novery_yet">No Verifications Yet.</span>';
              }
            }else{
              echo '<span class="novery_yet">No Verifications Yet.</span>';
            }
          ?>
        </div>
  </div>
  

<?php if($userInfo->user_type_name == 'B2C') { ?>               
  <div class="withedrow">
  	<h3 class="dashed norgren">Add More Verifications</h3>
    <div class="rowit">
      <?php 
        $count = $this->verification_model->checkUserVerfication($user_id, $user_type)->num_rows();
        if($count == 0){
      ?>
      	<div class="seprow">
      		<span class="rowsubhd">Email Address</span>
      		<p class="normalpara">Please verify your email address by clicking the link in the message we just sent to:<?php echo $userInfo->user_email;?>
          </p><p class="normalpara">Can't find our message? Check your spam folder or  <a href="javascript:void(0)" class="resend_v">resend the confirmation email. </a><span class="loadr"></span><span class="loadr-tick"><img src="<?php echo ASSETS;?>images/sstik.png"/></span></p>
        </div>
        <div class="seprow">
      		<span class="rowsubhd">Phone Number</span>
      		<p class="normalpara">Make it easier to communicate with a verified phone number. We'll send you a code by SMS or read it to you over the phone. Enter the code below to confirm that you're the person on the other end.</p>
          <br>
          <p class="normalpara">No phone number entered</p>
          <a class="addPhonePopup addPhone">Add a phone number</a>
          <br> 

          <div class="adphone sendVerification">
          	<div class="phlabl">Choose a country:</div>
             <input class="form-control" type="text" id="countryPhoneCodeq" placeholder="">
        
            <span style="color: red; font-size:small" class="errCountry"></span>
            <br>
            <div class="phlabl">Add a phone number:</div>
            <input class="form-control" type="text" id="phoneNumber" placeholder="">
            <span style="color: red; font-size:small" class="errPhone"></span>
            <br>
            <button class="btn-search5" id="verifyPhone" type="submit">Send Verification Code</button>
            <img class="sendingLoader" src=" <?php echo ASSETS.'/images/loader.gif' ?>  ">
          </div>
              
          <div class="adphone" id="enterCodeDiv" style="display: none; margin-left: 50px">
            <div class="phlabl">Enter the verification code sent to your phone</div>
            <input class="form-control" type="text" id="enteredCode" placeholder="">
            <span style="color: red; font-size:small" class="errVerifyCode"></span>
            <br>
            <button class="btn-search5" id="processCode" type="submit">Verify</button>
            <img class="verifyingLoader" src=" <?php echo ASSETS.'/images/loader.gif' ?>  ">
          </div>
		    </div>
        <?php }else{
          $verifications = $this->verification_model->checkUserVerfication($user_id, $user_type)->row();
          if($verifications->email_verify == 0){
        ?>
       	<div class="seprow">
      		<span class="rowsubhd">Email Address</span>
      		<p class="normalpara">Please verify your email address by clicking the link in the message we just sent to:<?php echo $userInfo->user_email;?>
          </p><p class="normalpara">Can't find our message? Check your spam folder or  <a href="javascript:void(0)" class="resend_v">resend the confirmation email. </a><span class="loadr"></span><span class="loadr-tick"><img src="<?php echo ASSETS;?>images/sstik.png"/></span></p>
        </div>
        <?php } if($verifications->mobile_verify == 0){ ?>
        <div class="seprow">
      		<span class="rowsubhd">Phone Number</span>
      		<p class="normalpara">Make it easier to communicate with a verified phone number. We'll send you a code by SMS or read it to you over the phone. Enter the code below to confirm that you're the person on the other end.</p>
          <br>
          <p class="normalpara">No phone number entered</p>
          <a class="addPhonePopup addPhone">Add a phone number</a>
          <br> 

          <div class="adphone sendVerification">
          	<div class="phlabl">Choose a country:</div>
             <input class="form-control" type="text" id="countryPhoneCodeq" placeholder="">
        
            <span style="color: red; font-size:small" class="errCountry"></span>
            <br>
            <div class="phlabl">Add a phone number:</div>
            <input class="form-control" type="text" id="phoneNumber" placeholder="">
            <span style="color: red; font-size:small" class="errPhone"></span>
            <br>
            <button class="btn-search5" id="verifyPhone" type="submit">Send Verification Code</button>
            <img class="sendingLoader" src=" <?php echo ASSETS.'/images/loader.gif' ?>  ">
          </div>
              
          <div class="adphone" id="enterCodeDiv" style="display: none; margin-left: 50px">
            <div class="phlabl">Enter the verification code sent to your phone</div>
            <input class="form-control" type="text" id="enteredCode" placeholder="">
            <span style="color: red; font-size:small" class="errVerifyCode"></span>
            <br>
            <button class="btn-search5" id="processCode" type="submit">Verify</button>
            <img class="verifyingLoader" src=" <?php echo ASSETS.'/images/loader.gif' ?>  ">
          </div>
		    </div>
        <?php }}?>
 <?php
  $atts = array(
    'width'      => '600',
    'height'     => '600',
    'scrollbars' => 'yes',
    'status'     => 'yes',
    'resizable'  => 'yes',
    'screenx'   =>  '\'+((parseInt(screen.width) - 600)/2)+\'',
    'screeny'   =>  '\'+((parseInt(screen.height) - 600)/2)+\'',
  );
  $atts['class'] = 'conctsocial';
  ?>
        <div class="clear"></div>
        <br>

        <?php if($this->session->userdata('b2c_id')){ ?>                       
          <div class="seprow">
          	<span class="rowsubhd"><?php echo $this->lang->line('D_Facebook'); ?></span>
              <div class="col-md-8 offset-0">
              	<p class="normalpara"><?php echo $this->lang->line('D_Signin_FB'); ?></p>
              </div>
              <?php if($userInfo->facebook_id == ''){ ?>  
                  <div class="col-md-4">
                      <?php echo anchor_popup('auth/login/Facebook/login','Connect', $atts);?>
                      <!-- <a class="conctsocial">Connect</a> -->
                  </div>
              <?php }else{?>
                  <div class="col-md-4">
                    <a href="<?php echo WEB_URL;?>/dashboard/disconnect/Facebook" class="disconct"><?php echo $this->lang->line('D_Disconnect'); ?></a>
                    <a class="tooltip-a helptooltip icon icon-question" title="You can always reconnect later"></a>
                  </div>
              <?php }?>
          </div>
          <div class="clear"></div>
          <br>
          
          <div class="seprow">
          	<span class="rowsubhd"><?php echo $this->lang->line('D_Google'); ?></span>
              <div class="col-md-8 offset-0">
              	<p class="normalpara"><?php echo $this->lang->line('D_Connect_Google'); ?></p>
              </div>
              <?php if($userInfo->google_id == ''){ ?> 
                  <div class="col-md-4">
                      <?php echo anchor_popup('auth/login/Google/login','Connect', $atts);?>
                  	<!-- <a class="conctsocial">Connect</a> -->
                  </div>
              <?php }else{?>
                  <div class="col-md-4">
                    <a href="<?php echo WEB_URL;?>/dashboard/disconnect/Google" class="disconct"><?php echo $this->lang->line('D_Disconnect'); ?></a>
                    <a class="tooltip-a helptooltip icon icon-question" title="You can always reconnect later"></a>
                  </div>
              <?php }?>
          </div>
          <div class="clear"></div>
          <br>
          <div class="seprow">
          	<span class="rowsubhd"><?php echo $this->lang->line('D_Twitter'); ?></span>
              <div class="col-md-8 offset-0">
              	<p class="normalpara"><?php echo $this->lang->line('D_Signin_Twitter'); ?></p>
              </div>
              <?php if($userInfo->twitter_id == ''){ ?> 
                  <div class="col-md-4">
                      <?php  echo anchor_popup('auth/login/Twitter/login','Connect', $atts);?>
                  	<!-- <a class="conctsocial">Connect</a> -->
                  </div>
              <?php }else{?>
                  <div class="col-md-4">
                    <a href="<?php echo WEB_URL;?>/dashboard/disconnect/Twitter" class="disconct"><?php echo $this->lang->line('D_Disconnect'); ?></a>
                    <a class="tooltip-a helptooltip icon icon-question" title="You can always reconnect later"></a>
                  </div>
              <?php }?>
          </div>
        <?php }?>                       
      </div>
    </div>
<?php } ?>
</div>


</div>
 </section>
</section>
<div class="clearfix"></div>

<!-- Page Content --> 

<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/footer'); ?> <?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?> 

<!-- Script to Activate the Carousel -->



<?php //Flash data is used here to show the message about unverified account ?>
<?php 
  $verify_attributes = $this->session->flashdata('verify_attributes');
  if($verify_attributes == 1 && !empty($verify_attributes)) { 
?>
  <script type="text/javascript">
    $('.msg').show();
    $('.msg').text('Please verify your Email id and Mobile number before setting up two step verification.')
  </script>
<?php } ?>
<script type="text/javascript">
    $('.sendingLoader').hide();
    $('.verifyingLoader').hide();
    $('#verifyPhone').on('click', function() {
      $('.sendingLoader').show();
      var cc = $('#countryPhoneCode111').val();
      var m_n = $('#phoneNumber').val();
      console.log(cc);
      if(cc) {
        _cc = cc.trim();
      } else {
        $('.errCountry').text("Select Country");
        $('.sendingLoader').hide();
        return false;
      }

      if(m_n) {
        _m_n = m_n.trim();
      } else {
        $('.errPhone').text("Enter mobile number");
        $('.sendingLoader').hide();
        return false;
      }

      var full_m_n = _cc+_m_n;
      var m_n_int = full_m_n.substring(1);

      if(isNaN(m_n_int)) {
        $('.errPhone').text("Incorrect number");
        $('.sendingLoader').hide();
        return false;
      }
      $('.errPhone').text("");

      $.ajax({
        url: "<?php echo WEB_URL.'security/sendVerifyMobileNumber' ?>",
        method: "POST",
        data: {"m_n": m_n_int},
        dataType: "JSON",
        success: function(r) {
          $('.sendingLoader').hide();
          if(r.status == 1) {
            $('#enterCodeDiv').fadeIn();
          }
        }
      })
    });

    $('#processCode').on('click', function() {
      $('.verifyingLoader').show();
      var m_n = $('#phoneNumber').val();
    
      var e_c = $('#enteredCode').val();
      if(e_c) {
        _e_c = e_c.trim();
      } else {
        $('.errVerifyCode').text("Enter verification code");
        $('.verifyingLoader').hide();
        return false;
      }
      if(_e_c) {
          $.ajax({
            url: "<?php echo WEB_URL.'security/verifyMobileNumber' ?>",
            method: "POST",
            data: {'e_c': _e_c},
            dataType: "JSON",
            success: function(r) {
              $('.verifyingLoader').hide();
              if(r.status == 1) {
                window.location.href = "<?php echo WEB_URL.'dashboard/profile/verifications'; ?>"
              } else {
                $('.errVerifyCode').text("Invalid verification code");
                return false;
              }
            }
          })  
      }
    })
	 $('.resend_v').click(function() {
        $.ajax({
            url: '<?php echo WEB_URL; ?>account/sendEmailVerification',
            dataType: 'json',
            beforeSend: function(){
                $('.loadr').html('<div class="lodrefrentrev imgLoader"><div class="centerload"></div></div>');
            },
            success: function(data) {
                $('.loadr, .loadr-tick').toggle();
            }
        });
    });
</script>

</body>
</html>