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
	<link href="<?php echo ASSETS; ?>css/flight_result.css" rel="stylesheet">
	<style>
	.box_bg{
		padding: 15px;
	    background: #fff;
	    border-radius: 10px;
	    margin: 15px 0px;
		}
		.error_msg{font-size: 16px;color:red;text-align: center;}
	</style>
</head>
<body>
	<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header');  ?>

	<div class="allpagewrp top80">
		<div class="newmodify">
			<div class="container">
				<div class="contentsdw">
					<?php 
						if($status == '1'){
					?>
							<div class="clear"></div>
							<div class="col-md-3"></div>
							<div class="centerfix col-md-6">
								<div class="box_bg">
								<div class="popuperror" style="display:none;">
								</div>
								<div  class="pophed">
									<center><h4>Reset Password</h4></center>
								</div>
								<br>
								<div id="reset_password_val" class="lodrefrentrev imgLoader">
									<div class="centerload"></div>
								</div> 
								<form id="resetpwd" name="resetpwd" method="post" action="<?php echo WEB_URL;?>account/resetpwd">
									<div class="ritpul">
										<div class="rowput">
											<span class="icon icon-lock"></span>
											<input type="hidden" name="key" value="<?php echo $key;?>">
								 			<input type="hidden" name="secret" value="<?php echo $secret;?>">
											<input class="form-control logpadding" type="password" name="password" id="npassword" placeholder="New Password" minlength="5" maxlength="50" required/>
										</div>
										<div class="rowput">
											<span class="icon icon-lock"></span>
											<input class="form-control logpadding" type="password" name="cpassword" placeholder="Confirm Password" required/>
										</div>
										<div class="clear"></div>
										<button class="submitlogin">Save & Continue</button>
										<div class="clear"></div>
										<div class="dntacnt">Suddenly remember password?
											<?php if($user_data->user_type_id == 1){?>
											<a href="<?php echo WEB_URL; ?>account/agent_login" class="signinfixed" id="afterlogin">Sign In</a> 
											<?php }elseif ($user_data->user_type_id == 2) {?>
											<a href="<?php echo WEB_URL; ?>" class="signinfixed" id="afterlogin">Sign In</a> 		
											<?php }else{ ?>
											<a href="<?php echo WEB_URL; ?>account/staff_login" class="signinfixed" id="afterlogin">Sign In</a> 

											<?php } ?>
										</div>
									</div>
								</form>
							</div>
					<?php  
						}else{
					?>
					<div class="col-md-3"></div>
							<div class="centerfix col-md-6">
								<div class="box_bg">
								<div class="popuperror" style="display:none;"></div>
			  					<div  class="pophed">
			  						<center><h4>Reset Password</h4></center>
			  					</div><br>
							   	<div id="reset_password_val" class="lodrefrentrev imgLoader">
									<div class="centerload"></div>
								</div> 
								<div class="error_msg">
									<?php echo $msg;?>
								</div>
							</div>
						</div>
					<?php		
						}
					?>
				</div>
			</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>

	<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
	<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>
</body>
</html>
