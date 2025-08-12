<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
<!--<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>-->

<style type="text/css">
 ul.dropdown-menu.mysign1 { margin: 26px 0 0 0;}

  ul.dropdown-menu.mysign2 {     
    margin: 26px 0 0 0;
    max-width: 255px;
    right: 0px !important;
    left: 0px !important;
    padding: 15px;
    margin-left: 72em!important; 
    margin: auto 0;} 
    ul.dropdown-menu.special_trip_nav {
        position: absolute;
    /* right: -12!important; */
    /* top: 72px; */
    height: auto;
    border: none;
    border-radius: 0;
    float: right!important;
    /* left: 77%; */
}
@media only screen and (device-width: 768px) {
   ul.dropdown-menu.mysign2 {margin-left: 36em !important;}
}
@media only screen and (device-width: 1024px) {
   ul.dropdown-menu.mysign2 {margin-left: 55em !important;}
}

ul.dropdown-menu.mysign1 li{border-bottom:solid 1px #f2f2f2;padding:0px 0px;}
ul.dropdown-menu.mysign1 li a i{padding:6px;}
label.error {
    color: white;
}

ul.mysign2 li { float: left; width: 100%; position: relative; }
ul.mysign2 li ul { float: left; width: 20%; }
ul.mysign2 li ul li { list-style: none; padding: 15px !important;} 
ul.mysign2 li ul li a{ text-decoration: none; }

a.spectal_trip_1 {
    background: transparent!important;
    color: #203f7c!important;
    padding: 6px 13px!important;
    margin: 0!important;
    font-size: 13px!important;
}

::-webkit-scrollbar {
  display: none; /* For Chrome, Safari, and Edge */
}


/*========== style ================= */

/* Base hamburger */
.hamburger {
  position: absolute;
  top: clamp(10px, 3.5vw, 35px);   /* responsive top */
  right: clamp(10px, 4vw, 40px);    /* responsive right */
  background: #1356f7;
  padding: 12px;
  border: none;
  display: none;
  flex-direction: column;
  justify-content: center;
  gap: 5px;
  width: 48px;
  height: 48px;
  border-radius: 8px;
  cursor: pointer;
  z-index: 20;
  transition: background .2s ease;
  -webkit-tap-highlight-color: transparent;

}

.hamburger:focus {
  outline: 2px solid #fff;
  outline-offset: 2px;
}

.hamburger .bar {
  display: block;
  width: 24px;
  height: 3px;
  background: #fff;
  border-radius: 2px;
  transition: transform .3s ease, opacity .3s ease;
  transform-origin: center;
}

.hamburger.open .bar:nth-child(1) {
  transform: translateY(5px) rotate(42deg);
}
.hamburger.open .bar:nth-child(2) {
  opacity: 0;
}
.hamburger.open .bar:nth-child(3) {
  transform: translateY(-8px) rotate(-45deg);
}

  /*=========== nav links ========= */
  .nav-links{
    display:flex;
    flex-direction:row;
    gap:.6rem;

  }
  .hiddenBlock{
    display:none;
  }
  .nav-links a{
    color: #ffffff;
		background: #203f7c;
		text-decoration: none;
		border-radius: 10px;
    height:3rem;
  }


@media (max-width: 768px) {
  /*=========== hamburger ========= */
  .hamburger {
    width: 44px;
    height: 44px;
    padding: 13px;
    gap: 4px;
    display:flex;
  }

  .hamburger .bar {
    width: 20px;
    height: 2.5px;
  }
  /*=========== nav links ========= */
  .nav-links{
    flex-direction:column;
  }
  .nav-bar {
    display: flex !important;
    justify-content: center;
    align-items: center;  
    display:none;
  }
  .nav-links a{
    font-size: 15px;
  }
  .nav-links a {
    display: flex;          
    justify-content: center; 
    align-items: center;     
    width: 30rem;
    height: 3.5rem;
    text-decoration: none;
  }
  #submenuDrop a{
   display:flex;
  }

}
@media (min-width: 769px) {
  #navMenu{
    display:flex;
  }
  .nav-links a,#submenuDrop a {
    width: 12rem;
    padding: 0.5rem;
    font-size:14px;
    text-align: center;
    margin-top: 2.5rem;
  }
  #submenuDrop a{
   display:inline-block;
  }
  .menuli{
    padding:0;
  }
  .navbar-nav>li>a{
    padding:0;
  }

  .topmenu {
    display: flex;              
    align-items: center;           
    justify-content: flex-start;    
    gap: 20px;                      
    padding: 10px 0;
  }
  .mbooking{
    width:18rem !important;
  }

}
@media (min-width: 992px) and (max-width: 1199px) {
  .mob-div{
    width: 20% !important;
  }
}
.sidetorit {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  justify-content: center; 
}
</style>
 
<div class="topssec" >
  <div class="mobile">
    <button class="hamburger" id="toggleHam" aria-label="Menu" aria-expanded="false" aria-controls="nav">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </button>
    <div class="col-xs-6 col-sm-2 mob-div">
        <?php
             if($this->session->userdata('user_type')==1)
        	{
        		$url = WEB_URL.'account/agent_login';
        	}
        	else if($this->session->userdata('user_type')==4)
        	{
        	    $url = WEB_URL.'account/staff_login';
        	}else{
        		 $url = WEB_URL;
        	}
        ?>
        <a class="logo" href="<?php echo $url; ?>" > 
          <img src="<?php echo base_url(); ?>assets/theme_dark/images/logo_transparent.png" alt="Vietnet" style="padding-top: 2px; height: 80px;"/>
        </a>
    </div>

    <nav class="nav-bar navme col-md-9 col-xs-12" id="main_menu">
      <div class="sidall hiddenBlock" id="navMenu">
        <div class="topmenu">
          <div class="navbdclose">
            <div class="explore_div main_con nav-links" >
              <a  href="<?php echo WEB_URL?>" target=""> <i class="fa fa-plane" aria-hidden="true"></i> FLIGHTS
              </a>
              <a  href="<?php echo WEB_URL.'hotel/search' ?>" id=""> <i class="fa fa-hotel" aria-hidden="true"></i> HOTELS
              </a>
              <a  href="<?php echo WEB_URL.'bus/search' ?>" > <i class="fa fa-bus" aria-hidden="true"></i> BUS
              </a>
              <a href="<?php echo WEB_URL.'general/manage_booking' ?>" class="mbooking"><i class="fa fa-book" aria-hidden="true"></i> MANAGE BOOKING</a>
              
              <div class="dropdown" id="submenuDrop">
                <a href="<?php echo WEB_URL.'general/special_trip' ?>"
                  class="dropdown-toggle dropdown_trip"
                  type="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false">
                  SPECIAL TRIP <span class="caret"></span>
                </a>
                <ul class="dropdown-menu special_trip_nav">
                  <li><a href="<?php echo WEB_URL.'general/special_trip' ?>" class="spectal_trip_1">FLIGHTS</a></li>
                  <li><a href="<?php echo WEB_URL.'general/hotal_trip' ?>" class="spectal_trip_1">HOTELS</a></li>
                  <li><a href="<?php echo WEB_URL.'general/bus_trip' ?>" class="spectal_trip_1">BUS</a></li>
                </ul>
              </div>

            </div>
          </div>
          <ul class="nav navbar-nav sidetorit" data-dropdown-in="fadeInDown" data-dropdown-out="fadeOutUp">
            <?php
              error_reporting(0);
              if ($this->session->userdata('user_id')) {
                  $user_id = $this->session->userdata('user_id');
                  $user_type = $this->session->userdata('user_type');
                  $user_data = $this->general_model->get_user_details($user_id,$user_type);
                  if($user_type == 4){
                    $super_user = $this->general_model->get_superuser($user_data->sub_user_id);

                    $username1 = $super_user->user_name .' / '.$user_data->c_p_name;
                      $rr=explode(' ',$username1);
                      $username=$rr[0];
                  } else {
                    $username1 = $user_data->user_name;
                  $rr=explode(' ',$username1);
                  $username=$rr[0];
                    
                  }
                  if($user_data->profile_picture == ''){
                    $profile_photo = ASSETS.'images/user-avatar.jpg';
                  }else{
                    $profile_photo = $user_data->profile_picture;
                  }
                  $provider = $user_data->user_loggedin_with;
              ?>
            <li>
              <a href="#" class="dropdown-toggle topa" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="reglog">
                  <div class="userimage user_profimag"><img src="<?php echo WEB_URL;echo "photo/users/".''.$profile_photo;?>" alt=""/>  <span style="margin-left: 5px;" class="userorlogin"><?php echo $username;?></span></div>
                </div>
              </a>
              <ul class="dropdown-menu mysign1">
                <li><a href="<?php echo WEB_URL;?>dashboard/bookings"><i class="fa fa-book"></i><span class="name_currency"> Dashboard</span></a></li>
                <li><a href="<?php echo WEB_URL;?>dashboard/change_pwd"><i class="fa fa-cog"></i><span class="name_currency"> Settings</span></a></li>
                <li class="log_out_li"><a href="<?php echo WEB_URL.'auth/logout/'.$provider.'/'.$user_data->user_id ?>"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
            <?php  } else { ?>
            <li  role="presentation" class="dropdown menuli" id="login_signup"> 
              <a href="#" class="dropdown-toggle topa" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="login_signup_a">
                <div class="reglog">
                  <div class="userimage hide"> <img src="<?php echo base_url(); ?>assets/theme_dark/images/user.png" alt="" /> </div>
                  <div class="userorlogin1">
                    <button class="btn btn-default mybtn">LOGIN</button>
                  </div>
                </div>
              </a>
              <ul class="dropdown-menu mysign languageul">
                <li class="logins active">
                  <div class="signdiv">
                    <div class="insigndiv">
                      <div class="leftpul">  
                        <div class="" style="margin: 0 auto;text-align:center;color: #fff;"><h4>User Login</h4></div>
                        <form id="login" name="login" method="post" action="<?php echo WEB_URL;?>account/login" >
                          <input type="hidden" name="user_type_name" value="B2C">
                          <div class="ritpul">
                            <div class="rowput"> <span class="fa fa-user"></span>
                              <input class="form-control logpadding" type="email" name="email" id="login_email_id" placeholder="Email Address" required value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>">
                            </div>
                            <div class="rowput"> <span class="fa fa-lock"></span>
                              <input class="form-control logpadding" type="password" name="password" id="pswd" placeholder="Password" required value="<?php if(isset($_COOKIE["user_password"])) { echo $_COOKIE["user_password"]; } ?>">
                            </div>
                            <div class="rowput misclog">
                              <div class="rember">
                                <input type="checkbox" id="remember_me" name="remember" value="remember-me" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?>>
                                Remember me
                                <a class="fadeandscale_close fadeandscaleforget_open forgota" style="padding-left: 65px;">Forgot password?</a> 
                              </div>
                            </div>
                            <div class="clearfix"></div>
                            <button class="btn submitlogin">Login</button>
                            <div class="clear"></div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="forgets">
                  <div class="signdiv">
                    <div style="display:none;" class="popuperror"></div>
                    <div class="formcontnt">Enter the email address associated with your account, and we wll email you a link to reset your password.</div>
                    <form id="forgetpwd" name="forgetpwd" action="<?php echo WEB_URL;?>account/forgetpwd">
                      <div class="ritpul">
                        <div class="rowput"> 
                          <span class="fa fa-envelope"></span>
                          <input type="email" required name="email" placeholder="Email Address" class="form-control logpadding" aria-required="true">
                        </div>
                        <div class="clearfix"></div>
                        <button class="submitlogin">Send Reset Link</button>
                        <div class="clear"></div>
                        <div class="dntacnt"><a style="color:#fff;" class="fadeandscalereg_close fadeandscale_open"> Sign in</a> </div>
                      </div>
                    </form>
                  </div>
                </li>
              </ul>
            </li>               
            <li  role="presentation" class="dropdown menuli" id="login_signup"> 
              <a href="#" class="dropdown-toggle topa" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="login_signup_a">
                <div class="reglog">
                  <div class="userimage hide"> <img src="<?php echo base_url(); ?>assets/theme_dark/images/user.png" alt="" /> </div>
                  <div class="userorlogin1">
                      <button class="btn btn-default mybtn">SIGN UP</button>
                  </div>
                </div>
              </a>
              <ul class="dropdown-menu mysign languageul">
                <li class="registers active">
                  <div class="signdiv">
                    <div class="insigndiv">
                      <div class="" style="margin: 0 auto;text-align:center;color:#fff;"><h4>Register New User</h4></div>
                      <div class="signupul">
                        <form id="registration" name="registration" action="<?php echo WEB_URL;?>account/create">
                          
                          <div class="reg_div">
                            
                          <input type="hidden" name="user_type_name" value="B2C">
                          <div class="rowput"> <span class="fa fa-user"></span>
                            <input class="form-control logpadding" type="text" name="fname" placeholder="Name" minlength="4" required>
                          </div>
                          
                          <div class="signupul">
                            <div class="rowput"> <span class="fa fa-user"></span>
                              <input class="form-control logpadding" type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="phone_number" placeholder="Enter Phone Number" minlength="1" maxlength="10">
                            </div>
                            <div class="rowput"> <span class="fa fa-envelope"></span>
                              <input class="form-control logpadding" type="email" name="email"  placeholder="Email" required>
                            </div>
                            <div class="rowput"> <span class="fa fa-lock"></span>
                              <input class="form-control logpadding valid_pass" type="password" name="password" id="password" placeholder="Password" minlength="5" maxlength="50" required>
                              <label style="display:none;" id="regex_err_pass" class="error">Password between 5 to 15 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character</label>
                            </div>
                            <div class="rowput"> <span class="fa fa-lock"></span>
                              <input class="form-control logpadding" type="password" name="cpassword" placeholder="Confirm password" required >
                            </div>
                            
                            <input type="hidden" class="send_otp" name="send_otp" value="1">
                            <input type="hidden" class="sended_otp" name="sended_otp" value="">
                            
                            <input type="submit" id="b2c_register_clk" class="submitlogin" value="Sign up" name="Sign up"/>
                            
                          </div>
                          </div>
                          
                          <div class="otp_div">
                              <div class="rowput"> <span class="fa fa-lock"></span>
                                  <input class="form-control logpadding" type="text" name="enter_otp" placeholder="Enter OTP" required >
                              </div>
                              
                              <input type="submit" class="submitlogin" value="Submit OTP"/>
                              
                          </div>
                          
                          
                        </form>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>

  </div>
</div>


<script type="text/javascript">
function doLogin(data){
	$('#simnavrit #login_signup').remove();
	//$('#simnavrit #agent_signup').remove();
	//$('.wrapofa.login').remove();
	var login = '<li role="presentation" id="login_signup1" class="dropdown login_after"><a href="#" class="topa dropdown-toggle nomargin" data-toggle="dropdown"> <div class="reglog"><div class="userimage user_profimag"><img src="'+data.profile_photo+'" alt=""/></div><div class="userorlogin">'+data.fname+'</div></div></a><ul class="dropdown-menu mysign1"><li><a href="<?php echo WEB_URL;?>dashboard"><i class="fa fa-dashboard"></i> <span class="name_currency">Dashboard</span></a></li><li><a href="<?php echo WEB_URL;?>dashboard/bookings"><i class="fa fa-book"></i><span class="name_currency">Bookings</span></a></li><li><a href="<?php echo WEB_URL;?>dashboard/settings"><i class="fa fa-cog"></i><span class="name_currency">Settings</span></a></li><li><a href="<?php echo WEB_URL;?>dashboard/support_conversation"><i class="fa fa-life-ring"></i><span class="name_currency">Support</span></a></li><li><a href="<?php echo WEB_URL;?>auth/logout/<?php echo PROJECT_NAME; ?>/'+data.rid+'">Logout</a></li></ul></li>';
	$(login).appendTo('#simnavrit');
	/* dropdown animation*/
var dropdownSelectors = $('.dropdown, .dropup');
dropdownSelectors.on({
  "show.bs.dropdown": function () {
    // On show, start in effect
    var dropdown = dropdownEffectData(this);
    dropdownEffectStart(dropdown, dropdown.effectIn);
  },
  "shown.bs.dropdown": function () {
    // On shown, remove in effect once complete
    var dropdown = dropdownEffectData(this);
    if (dropdown.effectIn && dropdown.effectOut) {
      dropdownEffectEnd(dropdown, function() {}); 
    }
  },  
  "hide.bs.dropdown":  function(e) {
    // On hide, start out effect
    var dropdown = dropdownEffectData(this);
    if (dropdown.effectOut) {
      e.preventDefault();   
      dropdownEffectStart(dropdown, dropdown.effectOut);   
      dropdownEffectEnd(dropdown, function() {
        dropdown.dropdown.removeClass('open');
      }); 
    }    
  }, 
});

}

function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>
<script type="text/javascript">
  $(function(){
      if (localStorage.chkbx && localStorage.chkbx != '') {
          $('#remember_me').attr('checked', 'checked');
          $('#login_email_id').val(localStorage.usrname);
          $('#pswd').val(localStorage.pass);
      } else {
          $('#remember_me').removeAttr('checked');
          $('#login_email_id').val('');
          $('#pswd').val('');
      }

      $('#remember_me').click(function() { 
       
          if ($('#remember_me').is(':checked')) {
              // save username and password
              
              localStorage.usrname = $('#login_email_id').val();
              localStorage.pass = $('#pswd').val();
              localStorage.chkbx = $('#remember_me').val();
             

          } else {
            
              localStorage.usrname = '';
              localStorage.pass = '';
              localStorage.chkbx = '';
          }
      });

  });
  function ChangeCurrency(that){
    var code = $(that).data('code');
    var icon = $(that).data('icon');
    // alert(code);
    // alert(icon);
    //$('.currencychange').hide();
    var data = {};
    data['code'] = code;
    data['icon'] = icon;
    $.ajax({
      type: 'POST',
      url: '<?php echo WEB_URL;?>general/change_currency',
      async: true,
      dataType: 'json',
      data: data,
      success: function(data) {
        // alert('fff');
      location.reload();
      }   
    });
    } 
</script>
        <script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
  }
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>

<!-- Flag click handler -->
<script type="text/javascript">
    $('.translation-links a').click(function() {
      var lang = $(this).data('lang');
      var $frame = $('.goog-te-menu-frame:first');
      if (!$frame.size()) {
        alert("Error: Could not find Google translate frame.");
        return false;
      }
      $frame.contents().find('.goog-te-menu2-item span.text:contains('+lang+')').get(0).click();
      return false;
    });
    
    
    // b2c_register_clk
    $('#b2c_register_clk').click(function() {
        var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{5,15}$/;
        var inputtxt=$('.valid_pass').val();
        if(inputtxt.match(decimal)) 
        { 
            $('#regex_err_pass').hide();
            return true;
        }else{ 
            $('#regex_err_pass').show();
            return false;
        }
    });
    
    $('.otp_div').hide();
    
   
</script>
<script>
  const btn = document.getElementById('toggleHam');
  const nav = document.getElementById('navMenu');

  btn.addEventListener('click', () => {
    btn.classList.toggle('open');
    nav.classList.toggle('hiddenBlock'); // assumes .hidden sets display:none
  });
</script>