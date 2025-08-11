 <!DOCTYPE html>
<html lang="en">
   <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta name="description" content="">
      <meta name="author" content="">
      <title><?php echo PROJECT_TITLE; ?></title>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_css'); ?>
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> 
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

           <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
      <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> 
      <!-- Custom CSS -->
   <link href="<?php //echo base_url(); ?>assets/theme_dark/css/index.css" rel="stylesheet" />
    <!--      <link href="<?php //echo base_url(); ?>assets/theme_dark/css/main_ff.css" rel="stylesheet" />  -->
<!--  <link href="<?php echo base_url(); ?>assets/theme_dark/css/index.css" rel="stylesheet" /> -->
<style type="text/css">
.data_forms .ft .col-md-6{padding-bottom:5px;}
.data_forms h3{text-align:center;}
.fgt_secss{
          margin-top:70px;
     
}
    .wrapper_before_content{
        margin-top: 75px;
    }
  .trm_con{    
           margin-top:110px;
      
        
    }

   hr {
   margin-top: 20px;
   margin-bottom: 0px;
   border-top: 1px solid #fff;
   }
   .link{
   margin-left: 18px;
   color: white;
   text-decoration: underline;
   margin-bottom: 10px;
   }

   .footer_cities ul {padding-left: 0px}
   .footer_cities li {
    list-style: none;
    color: #fff!important;
    padding: 1px 0;
 /*  list-style: none;*/
}
.footer_cities ul li a {
    color: #000!important;  
    font-size: 15px;
    line-height: 28px;
}

.footer_cities ul li a:hover{text-decoration: none;}
.foot_phone{width: 100%;float: left;margin-top: 10px; font-size: 13px;}
.foot_phone i {
    color: #193960;
    font-size: 16px;
    width: 19px;
    padding-right: 5px;
    height: auto;
}
.list_css{
    float: left;
    list-style: none;
    padding: 0px 10px 0px 10px;
    margin-top: 13px;
}
.list_brdr{
    border-left: 1px solid;
    height: 1.4em;
}
.ftr_sec{
  background: #fff; text-align: center;height:45px; border-radius:50px;
}
.ftr_mailbtn{
    color: #fff; 
    background-color: #db271d;
    border-color: #ccc;
    margin-left: -4px;
    border: 1px solid #db271d;
    border-radius: 0px 50px 50px 0px;
}
.ftr_input{
    background: #fff0;
    border: 1px solid #db271d;
    border-radius: 50px 0px 0px 50px;
}

</style>
<style type="text/css">
.faq_desgin h3 {
text-align: center;
font-size: 28px;
text-transform: uppercase;
font-weight: 600;
padding: 15px;
text-decoration: underline;
}




.faq_desgin {
background: none;
float: left;
border: 1px solid yellowgreen;
padding: 0px;
}

.faq_desgin h4 {
float: left;
text-align: left;
font-size: 15px;
font-weight: 600;
padding-right: 15px;
}

.faq_desgin_outer {
padding: 25px;
float: left;
width: 100%;
}

.faq_desgin h5 {
float: left;
text-align: left;
font-size: 17px;
font-weight: 600;
}

.faq_qustion {
float: left;
width: 100%;
padding: 15px;
}

.faq_answer {
width: 100%;
float: left;
background: #e9e9e9;
padding: 6px 15px;
}

.faq_desgin h6 {
float: left;
text-align: left;
font-size: 15px;
font-weight: 600;
padding-right: 11px;
text-transform: capitalize;
}

.faq_desgin span {
float: left;
text-align: left;
font-size: 15px;
font-weight: 400;
}
</style>
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
    top: 72px;
    height: auto;
    border: none;
    border-radius: 0;
    float: right!important;
    left: 77%;
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
</style>

   </head>
<!--<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>-->

 
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
      <img src="<?php echo base_url(); ?>assets/theme_dark/images/logo_transparent.png" alt="Vietnet" style="padding-top: 2px;"/>
         </a>

      
    </div>

   <nav class="navbar navme col-sm-9 collapse col-md-9 col-xs-10" id="main_menu">
      <div class="sidall">
        <div class="topmenu">
          <div class="navbdclose">
          <div class="top_items explore_div main_con desk-view-only ">
          <a  href="<?php echo WEB_URL?>" target=""> <i class="fa fa-plane" aria-hidden="true"></i> FLIGHTS
          </a>
        <a  href="<?php echo WEB_URL.'hotel/search' ?>" target="_blank" id=""> <i class="fa fa-hotel" aria-hidden="true"></i> HOTELS
          </a>
           <a  href="<?php echo WEB_URL.'bus/search' ?>" target="_blank"> <i class="fa fa-bus" aria-hidden="true"></i> BUS
          </a>

          <a href="<?php echo WEB_URL.'general/manage_booking' ?>"><i class="fa fa-book" aria-hidden="true"></i> MANAGE BOOKING</a>
          <!-- <a href="<?php echo WEB_URL.'general/special_trip' ?>"><i class="" aria-hidden="true"></i></a>-->


    <a href="<?php echo WEB_URL.'general/special_trip' ?>" class="dropdown-toggle dropdown_trip" type="button" data-toggle="dropdown" > SPECIAL TRIP
    <span class="caret"></span></a>
    <ul class="dropdown-menu special_trip_nav">
         <li><a href="<?php echo WEB_URL.'general/special_trip' ?>" class="spectal_trip_1">FLIGHTS</a></li>
         <li><a href="#" class="spectal_trip_1">HOTELS</a></li>
         <li><a href="<?php echo WEB_URL.'general/bus_trip' ?>" class="spectal_trip_1">BUS</a></li>
     
    </ul>
 
</div>



          <!--<a href=""> <i class="fa fa-tag" aria-hidden="true"></i> DEALS & OFFERS</a>-->
        
        
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
                                  Remember me
                                  <a class="fadeandscale_close fadeandscaleforget_open forgota" style="padding-left: 65px;">Forgot password?</a> 
                                  </div>
                                </div>
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


