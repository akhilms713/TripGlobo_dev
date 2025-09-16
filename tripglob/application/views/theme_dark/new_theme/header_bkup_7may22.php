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

 
</style>
 
<div class="topssec">
  <div class="container nopad position_relative">
    <button type="button" class="menu_toggle" data-toggle="collapse" data-target="#main_menu"> <span class="fa fa-bars"></span> </button>
    
    <div class="col-md-3 col-sm-3 col-xs-2 mob-div">
        
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
      <img src="<?php echo base_url(); ?>assets/theme_dark/images/logo.jpg" alt="Vietnet" style="padding-top: 2px;"/>
         </a>

      
    </div>

   <nav class="navbar navme col-sm-9 collapse col-md-9 col-xs-10" id="main_menu">
      <div class="sidall">
        <div class="topmenu">
          <div class="navbdclose">
          <div class="top_items  main_con desk-view-only ">
          <a  href="<?php echo WEB_URL?>" target=""> <i class="fa fa-plane" aria-hidden="true"></i> FLIGHTS
          </a>
        <a  href="<?php echo WEB_URL.'hotel/search' ?>" target="_blank" id=""> <i class="fa fa-hotel" aria-hidden="true"></i> HOTELS
          </a>
           <a  href="<?php echo WEB_URL.'bus/search' ?>" target="_blank"> <i class="fa fa-bus" aria-hidden="true"></i> BUS
          </a>

          <a href="<?php echo WEB_URL.'general/manage_booking' ?>"><i class="fa fa-book" aria-hidden="true"></i> MANAGE BOOKING</a>
           <a href="<?php echo WEB_URL.'general/special_trip' ?>"><i class="" aria-hidden="true"></i> SPECIAL TRIP</a>
          <!--<a href=""> <i class="fa fa-tag" aria-hidden="true"></i> DEALS & OFFERS</a>-->
        
          </div>
            <?php //if(@$header_product==''){ ?>
              <ul class="nav navbar-nav sidetorit" data-dropdown-in="fadeInDown" data-dropdown-out="fadeOutUp">
                
                <!-- <li class="dropdown sidebtn flagss">
                 <a href="#" class="dropdown-toggle topa" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                 <div class="reglognorml">
                    <span class="curncy_img flag flag-us flag_sel"></span> 
                    <div class="flags"> USD <b class="caret cartdown"></b> </div>
                 </div>
                 </a>
                <ul class="dropdown-menu mysign1 curncyul">
                <?php $currency_info =   $this->general_model->get_currency_info();
                  if(isset($currency_info) && $currency_info !=''){ foreach($currency_info as $currency_info[$curr_count]) { if($currency_info[$curr_count]->currency_code == "USD"){ ?>
                  <li <?php if($this->display_currency == $currency_info[$curr_count]->currency_code){?>class="selected"<?php }?>> <a href="javascript:void(0)" onClick="ChangeCurrency(this)" data-code="<?php echo $currency_info[$curr_count]->currency_code; ?>" data-icon="<?php echo $currency_info[$curr_count]->currency_symbol; ?>"> <span class="<?php echo 'curncy_img flag flag-'.strtolower($currency_info[$curr_count]->country_code); ?>"></span><span class="name_currency"> <?php echo $currency_info[$curr_count]->currency_code; ?></span><span class="side_curency"><?php echo $currency_info[$curr_count]->currency_symbol; ?></span> </a></li>
                <?php }}} ?>
                </ul>
                </li> -->
                <!-- <li class="dropdown "> <a href="#" class="dropdown-toggle topa" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <div class="reglognorml">
                    <div class="flags"> <img src="<?php echo base_url(); ?>assets/theme_dark/images/eng.png" alt="" /><b class="caret cartdown"></b> </div>
                  </div>
                  </a>
                  <ul class="dropdown-menu mysign1 languageul">
                    <li><a href="#"><span class="curncy_img sprte gbp"></span> <span class="name_currency"> English</span></a></li>
                  </ul>
                </li> -->
                 

                <li style="position: relative;" role="presentation" class="dropdown menuli" id="login_signup"> 

                  <?php if ($this->session->userdata('user_id')) {
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
                <?php  } else { ?>
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
                                  Remember me</div>
                                <a class="fadeandscale_close fadeandscaleforget_open forgota">Forgot password?</a> </div>
                              <div class="clearfix"></div>
                              <button class="btn submitlogin">Login</button>
                              <div class="clear"></div>
                             <!-- <div class="dntacnt">Don't have an account? <a class="fadeandscale_close fadeandscalereg_open">Sign up</a> </div>-->
                            </div>
                            </form>
                          </div>
                        </div>
                      </li>

                      <li class="forgets">
                        <div class="signdiv">
                          <div style="display:none;" class="popuperror"></div>
                          <div class="formcontnt">Enter the email address associated with your account, and we wll email you a link to reset your password.</div>
                           <form id="forgetpwd" name="forgetpwd" action="<?php echo WEB_URL;?>account/forgetpwd">
                          <div class="ritpul">
                            <div class="rowput"> <span class="fa fa-envelope"></span>
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
                  <?php } ?>
                  <li style="position: relative;" role="presentation" class="dropdown menuli" id="login_signup"> 

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
                          <input type="hidden" name="user_type_name" value="B2C">
                          <div class="rowput"> <span class="fa fa-user"></span>
                            <input class="form-control logpadding" type="text" name="fname" placeholder="Name" minlength="4" required>
                          </div>
                          
                          <div class="signupul">
                           <!-- <div class="rowput"> <span class="fa fa-user"></span>
                              <input class="form-control logpadding" type="text" name="lname" placeholder="Last name" minlength="1">
                            </div> -->
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
                            <div class="rowput misclog">
                              <!--<div class="rember">
                                <input type="checkbox" />
                                Tell me about <?php //echo PROJECT_TITLE; ?> news</div>
                            </div>
                            <div class="clear"></div>-->
                 <!-- <div class="signupterms" style="color: #fff;"> By signing up, I agree to Transition <a>Terms of Service</a>,<a> Privacy Policy</a>, <a>Guest Refund Policy</a>, and <a>Host Guarantee Terms</a>. </div>-->
                            <div class="clear"></div>
                            <input type="submit" id="b2c_register_clk" class="submitlogin" value="Sign up" name="Sign up"/>
                          </div>
                          </div>
                          </form>
                        </div>
                      </li>
                    </ul>
                  </li>
                  
                  
     <!--
                  
              <li class="dropdown sidebtn flagss">
                 <a href="#" class="dropdown-toggle topa" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                 <div class="reglognorml">
                    <span class="curncy_img flag flag-<?=$this->curr_val_flag?> flag_sel"></span> 
                    <div class="flags"><span class="flag_txt"> <?=$this->display_currency?></span> <b class="caret cartdown"></b> </div>
                 </div>
                 </a>
               <ul class="dropdown-menu mysign1 mysign2 curncyul"> 
               <li> <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Country.." title="Type in a name">
               </li>
               <li id="myUL">
                <ul >
                <?php $currency_info =   $this->general_model->get_currency_info();
                // debug($currency_info);die;
                  if(isset($currency_info) && $currency_info !=''){ 
                    for($curr_count=0; $curr_count < 33; $curr_count++) { ?>
                  <?php //echo "<pre/>";print_r($currency_info[$curr_count]);die; ?>
                  <li <?php if($this->display_currency == $currency_info[$curr_count]->currency_code){?>class="selected"<?php }?>> <a href="javascript:void(0)" onClick="ChangeCurrency(this)" data-code="<?php echo $currency_info[$curr_count]->currency_code; ?>" data-icon="<?php echo $currency_info[$curr_count]->currency_symbol; ?>"> <span class="<?php echo 'curncy_img flag flag-'.strtolower($currency_info[$curr_count]->country_code); ?>"></span><span class="name_currency"> <?php echo $currency_info[$curr_count]->currency_code; ?></span> - <span class="side_curency"><?php echo $currency_info[$curr_count]->currency_symbol; ?></span> </a></li>
                <?php }} ?>
                </ul>
               </li>
            </ul>

                </li> -->
           <!--     <li><div id="google_translate_element"></div></li> -->
               
              </ul>
             
          
            <?php //}else{ ?>
              <!-- <ul class="nav navbar-nav sidetorit" data-dropdown-in="fadeInDown" data-dropdown-out="fadeOutUp">
                
                <li class="menuli"><a href="<?php echo WEB_URL.'Flights'; ?>">Flights</a></li>
                <li class="menuli"><a href="<?php echo WEB_URL.'Hotels'; ?>">Hotels</a></li>
                <li class="menuli"><a href="<?php echo WEB_URL.'Cars'; ?>">Cars</a> </li>
                
              </ul> -->
            <?php //} ?>
          </div>
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
    
   
</script>
