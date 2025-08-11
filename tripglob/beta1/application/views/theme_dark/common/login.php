<style>
    button.btn.submitlogin:focus {
    outline: 0px auto -webkit-focus-ring-color;
    color: #fff;
}
.submitlogin:hover{color:#fff;}
</style>

 <div id="fadeandscale" class="wellme">
        <div id="loginLdr" class="lodrefrentrev imgLoader"><div class="centerload"></div>
</div>
<div class="popuperror" style="display:none;"></div>
        <div class="signdiv">
            <div class="insigndiv">
            <div class="leftpul">
             <?php
   $atts = array('width' => '600','height' => '600','scrollbars' => 'yes','status' => 'yes','resizable'  => 'yes','screenx'   =>  '\'+((parseInt(screen.width) - 600)/2)+\'','screeny'   =>  '\'+((parseInt(screen.height) - 600)/2)+\'' );
   $atts['class'] = 'logspecify facecolor';
   echo anchor_popup('auth/login/Facebook/login','<span class="icon icon-facebook"></span>
   <div class="mensionsoc">Login with Facebook</div>', $atts);
   $atts['class'] = 'logspecify tweetcolor';
   echo anchor_popup('auth/login/Twitter/login','<span class="icon icon-twitter"></span>
   <div class="mensionsoc">Login with Twitter</div>', $atts);
   $atts['class'] = 'logspecify gpluses';
   echo anchor_popup('auth/login/Google/login','<span class="icon icon-google-plus"></span>
   <div class="mensionsoc">Login with Google Plus</div>', $atts);
 ?>
  
             </div>
             <div class="centerpul"><div class="orbar"><strong>Or</strong></div></div>
              <form id="login" name="login" action="<?php echo WEB_URL;?>account/login">
               <input type="hidden" name="user_type_name" value="B2C">
             <div class="ritpul"> 
                <div class="rowput">
                	<span class="fa fa-user"></span>
                	<input class="form-control logpadding" type="email" name="email"  placeholder="Email Address" required >
                </div>
                <div class="rowput">
                	<span class="fa fa-lock"></span>
                    <input class="form-control logpadding" type="password" name="password" id="pswd" placeholder="Password" required>
                    <div class="errMsg"></div>
                </div>
                <div class="misclog">
                	<a class="rember"><input type="checkbox" />Remember me</a>
                    <a class="fadeandscale_close fadeandscaleforget_open forgtpsw" id="forgtpsw">Forgot password?</a>
                </div>
                <div class="clear"></div>
                <button class="submitlogin">Login</button>
                <div class="clear"></div>
                <div class="dntacnt">Don't have an account? <a class="fadeandscale_close fadeandscalereg_open">Sign up</a> </div>
            </div>
             </form>
            </div>
        </div>
      
    </div>
    
<div id="fadeandscalereg" class="wellme">
 <div id="loginLdrReg" class="lodrefrentrev imgLoader"><div class="centerload"></div></div>     
 <div class="popuperror" style="display:none;"></div>
        <div class="signdiv">
            <div class="insigndiv">
            <div class="leftpul">
            <?php
$atts['class'] = 'logspecify facecolor';
echo anchor_popup('auth/login/Facebook/up','<span class="icon icon-facebook"></span>
<div class="mensionsoc">Sign up with Facebook</div>', $atts);
$atts['class'] = 'logspecify tweetcolor';
echo anchor_popup('auth/login/Twitter/up','<span class="icon icon-twitter"></span>
<div class="mensionsoc">Sign up with Twitter</div>', $atts);
$atts['class'] = 'logspecify gpluses';
echo anchor_popup('auth/login/Google/up','<span class="icon icon-google-plus"></span>
<div class="mensionsoc">Sign up with Google Plus</div>', $atts);
?>
 
             </div>
             <div class="centerpul"><div class="orbar"><strong>Or</strong></div></div>
             
             <a class="logspecify mymail">
                <span class="fa fa-envelope"></span>
                <div class="mensionsoc">Sign up with email</div>
            </a>
            <form id="registration" name="registration" action="<?php echo WEB_URL;?>account/create">
            <input type="hidden" name="user_type_name" value="B2C">
             <div class="signupul"> 
                <div class="rowput">
                	<span class="fa fa-user"></span>
                	<input class="form-control logpadding" type="text" name="fname" placeholder="First name" minlength="4" required>
                </div>
                <div class="rowput">
                	<span class="fa fa-user"></span>
                	<input class="form-control logpadding" type="text" name="lname" placeholder="Last name" minlength="1" required>
                </div>
                <div class="rowput">
                	<span class="fa fa-envelope"></span>
                	<input class="form-control logpadding" type="email" name="email" placeholder="Your email" required>
                </div>
                <div class="rowput">
                	<span class="fa fa-lock"></span>
                    <input class="form-control logpadding" type="password" name="password" id="password" placeholder="Password" minlength="5" maxlength="50" required >
                </div>
                <div class="rowput">
                	<span class="fa fa-lock"></span>
                	<input class="form-control logpadding" type="password" name="cpassword" placeholder="Confirm password" required >
                </div>
                <div class="misclog">
                	<a class="rember"><input type="checkbox" />Tell me about <?php echo PROJECT_TITLE; ?> news</a>
                </div>
                <div class="clear"></div>
                <div class="signupterms">
                	By signing up, I agree to Transion <a>Terms of Service</a>,<a> Privacy Policy</a>, <a>Guest Refund Policy</a>, and <a>Host Guarantee Terms</a>. 
                </div>
                <div class="clear"></div>
                 <input type="submit" class="submitlogin" value="Sign up" name="Sign up"/>

            </div>
            </form>
                <div class="clear"></div>
                <div class="dntacnt">Don't have an account? <a class="fadeandscalereg_close fadeandscale_open">Sign in</a> </div>
            
            </div>
        </div>
      
    </div>
    
<div id="fadeandscaleforget" class="wellme forgetps">
			<div class="popuperror" style="display:none;"></div>
			<div  class="signheding">Reset Password</div>
				<div class="signdivup">
						<div class="formcontnt">
							Enter the emailll address associated with your account, and we'll email you a link to reset your password.
						</div>
						<form id="forgetpwd" name="forgetpwd" action="<?php echo WEB_URL;?>account/forgetpwd">
						<input type="hidden" name="user_type_name" value="B2C">
							 <div class="ritpul"> 
									<div class="rowput">
										<span class="fa fa-envelope"></span>
										<input class="form-control logpadding"  type="email" name="email" placeholder="Email Address" required>
									</div>
									<div class="clear"></div>
									<button class="submitlogin">Send Reset Link</button>
									<div class="clear"></div>
									<div class="dntacnt">Suddenly remeber password?  <a class="fadeandscaleforget_close fadeandscale_open">Sign In</a> </div>
							</div>
							</form>
						</div>
				</div>
