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
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<link href="<?php echo ASSETS; ?>css/dashboard.css" rel="stylesheet" />  
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/dataTables.tableTools.css">
<script>
  var WEB_URL = "<?=WEB_URL?>";
</script>
<script type="text/javascript" src="<?php echo ASSETS; ?>js/custom_modified.js"></script>
<script>
function valadition(){
  //alert('zsz');
  var feed_name = document.getElementById('feedback_name').value;
  var feed_email = document.getElementById('feedback_email').value;
  var feed_booking = document.getElementById('feedback_booking').value;
  var message = document.getElementById('message').value;
  
  
//for user

if(feed_name == ""){
  document.getElementById('usernam').innerHTML ="Please fill the user name field ";
       return false;
}

if((feed_name.length<=2)||(feed_name.length>20)){
  document.getElementById('usernam').innerHTML ="Length should be between 2 and 20 ";
       return false;
}

if(!isNaN(feed_name)){
  document.getElementById('usernam').innerHTML ="should be in character ";
       return false;
}



//email
if(feed_email == ""){
  document.getElementById('emails').innerHTML ="please fill the email name field ";
       return false;
}

if(feed_email.indexOf('@')<=1){
  document.getElementById('emails').innerHTML ="@ at invalid postion ";
       return false;
}
if(feed_email.charAt(feed_email.length-4)!='.'){
  document.getElementById('emails').innerHTML =". at invalid postion ";
       return false;
}
//for booking

if(feed_booking == ""){
  document.getElementById('bookings').innerHTML ="please fill the password name field ";
       return false;
}
document.getElementById('myform').submit();
} 
</script>     
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


<!--main content start-->
<section id="main-content" class="col-md-12 tab_sty nopad viewproff">
<section class="wrapper">

 <h3 class="lineth">User Information</h3>
          
          <div class="main-chart"  id="viewpro"> 

          <div class="col-md-3 custom-nav side-nav">
    <ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="active">
  <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
  <!--<a href="<?php echo WEB_URL; ?>dashboard/profile" class="<?php echo $staus_profile; ?>"> -->
  <i class="fal fa-user "></i> Contact Details</a></li>

   <li  role="presentation">
   <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
    <i class="fal fa-ticket"></i> Passport Information</a>
  </li>

   <li  role="presentation">
   <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">
   <i class="fal fa-building"></i> Preferences</a>
  </li>
  
   <!-- <li  role="presentation">
   <a href="#travelinfo" aria-controls="travelinfo" role="tab" data-toggle="tab">
   <i class="fas fa-map-marker-alt"></i> Traveler Information</a>
  </li> -->
   <li  role="presentation">
   <a href="#deals" aria-controls="deals" role="tab" data-toggle="tab">
   <i class="far fa-gift"></i> Deals</a>
  </li>
  </ul>  
</div>

<!--old profinfo -->
              <div class="top_info_profile col-md-9 col-xs-12 tab-content">

               
                <div class="adres_user tab-pane active "  role="tabpanel" id="home">
                <div class="inside_left col-md-9 nopad">             	

                	<div class="dashprof-inpt">
                		<div class="dash-lab">Name </div>
                		<div class="dash-inpt"><?php if($userInfo->user_type_name == 'B2B2B') echo $userInfo->c_p_name; else echo $userInfo->user_name;?>
                			
                		</div>
                	</div>
               <div class="dashprof-inpt">
                    <div class="dash-lab">Email Address </div>
                    <div class="dash-inpt"><?php if($userInfo->user_type_name == 'B2B2B') echo $userInfo->c_p_name; else echo $userInfo->user_email;?>
                      
                    </div>
                  </div>
                    <div class="dashprof-inpt">
                    <div class="dash-lab">Mobile Number </div>
                    <div class="dash-inpt"><?php if($userInfo->user_type_name == 'B2B2B') echo $userInfo->c_p_name; else echo $userInfo->mobile_phone;?>
                      
                    </div>
                  </div>
                
                	<!--<span class="lred"></span>-->
                	<div class="dashprof-inpt">
                		<div class="dash-lab">Address </div>
                		<div class="dash-inpt"><?php echo str_replace(',',',', $address_details->address); ?>
                			
                		</div>
                	</div>
                	<div class="dashprof-inpt">
                		<div class="dash-lab">City </div>
                		<div class="dash-inpt"><?php echo $address_details->city_name; ?>
                			
                		</div>
                	</div>
                	<div class="dashprof-inpt">
                		<div class="dash-lab">State </div>
                		<div class="dash-inpt"><?php echo $address_details->state_name; ?>
                			
                		</div>
                	</div>
                  <?php// echo "<pre>";print_r($address_details); ?>
                   <div class="dashprof-inpt">
                    <div class="dash-lab">Zip Code</div>
                    <div class="dash-inpt"><?php if($userInfo->user_type_name == 'B2B2B') echo $address_details->zip_code; else echo $address_details->zip_code;?>
                      
                    </div>
                  </div>
				 </div>
                                  
                <div class="fstusrp col-md-3 dash-profimg"> 
                  <img src="<?php echo base_url('photo/users')."/".$userInfo->profile_picture;?>" alt="" class="profile_photo"/> 
                </div>
                    
				
                
                <div class="clearfix"></div>
                <div class="col-md-12">
                	 <div class="col-md-3">
                	 </div>
                	 <div class="col-md-9">
	                <a href="<?php echo WEB_URL; ?>dashboard/edit_profile" class="dashbuttons extr_profile"><i class="fal fa-edit"></i> Edit Profile</a> 
	                <a href="<?php echo WEB_URL; ?>dashboard/change_pwd" class="chnge_paswordd"> <i class="fal fa-key"></i> Change Password</a> 
	            </div>
            	</div>
              </div>
          <div role="tabpanel" class="tab-pane " id="profile">
            <div class="col-md-10 normal-pass">
              <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                <div class="prolabel">Passport Number <span>*</span>  </div>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                <input minlength="4" type="text" class="form-control" name="city_name" placeholder="" value="<?php echo $userInfo->passport_number; ?>" required readonly="true"/>
              </div> 
              <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                  <div class="prolabel">Expiry Date <span>*</span>  </div>
              </div>
               <div class="col-lg-9 col-md-9 col-sm-9 margbotm15 fullprofiles">
            <input  name="depature" id="" required type="text" class="form-control" value="<?php echo $userInfo->passport_expirydate; ?>" placeholder="Passport Expiry Date"  readonly="true"/>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                <div class="prolabel">Issuing Country <span>*</span> </div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="country" required readonly="true">
                  <?php foreach($getCountry as $country){?>
                  <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $userInfo->passport_issuing_country) ? "selected" : ""; ?> ><?php echo $country->country_name;?></option>
                  <?php }?>
                </select>
              </div>
                   <div class="col-md-12">
                     <div class="col-md-3">
                     </div>
                    <div class="col-md-9">
                      <a href="#" class="dashbuttons extr_profile passedit-btn"><i class="fal fa-edit"></i> Edit</a>    
                      </div>

                    
                  </div>




              </div><!-- normal view -->

                      <script>
                      $(document).ready(function(){
                       $(".passedit-btn").click(function(){
                        $(".normal-pass").hide(),
                        $(".edit-pass").show();
                      });
                          $(".edpass-cancel").click(function(){
                            $(".edit-pass").hide(),
                            $(".normal-pass").show()
                          });
                           $( "#passexpiry" ).datepicker({
                            dateFormat: 'dd-mm-yy',
                            minDate : 0,
                            changeMonth: true, 
                            changeYear: true, 
                           
                     });
                         });
                      </script>
          <form method="post" action="<?=base_url().'dashboard/updatePassport'?>">
          <div class="col-md-10 edit-pass">
              <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                <div class="prolabel">Passport Number <span>*</span>  </div>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                <input minlength="4" type="text" class="form-control" name="passport_number" placeholder="Enter the Passport Number" value="<?php echo $userInfo->passport_number; ?>" required/>
              </div> 
              <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                  <div class="prolabel">Expiry Date <span>*</span>  </div>
              </div>
               <div class="col-lg-9 col-md-9 col-sm-9 margbotm15">
                <input  name="passport_expirydate" id="passexpiry" required type="text" class="form-control" value="<?php echo $userInfo->passport_expirydate; ?>" placeholder="Enter the Passport Expiry Date" autocomplete="off" />
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                <div class="prolabel">Issuing Country <span>*</span> </div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="passport_issuing_country" required>
                  <?php foreach($getCountry as $country){?>
                  <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $userInfo->passport_issuing_country) ? "selected" : ""; ?> ><?php echo $country->country_name;?></option>
                  <?php }?>
                </select>
              </div>
                   <div class="col-md-12">
                     <div class="col-md-3">
                     </div>
                    <div class="col-md-3">
                      <!-- <a href="#" class="dashbuttons extr_profile"> Save</a>  -->
                      <input type="submit" class="dashbuttons extr_profile" value="Save">
                    </div>
                    <div class="col-md-3">
                      <a href="#" class="dashbuttons extr_profile bg-black edpass-cancel"> Cancel</a> 
                    </div>    
                    </div>
                  </div>
                  </form>
              </div><!-- normal view -->
 <!-- Deal Info -->
               <div role="tabpanel" class="tab-pane" id="deals">
                 <div class="col-md-12 norm-prefrnc">

                  <!-- deal tab -->

              <ul class="nav nav-tabs deal-tabss" role="tablist">
                <li role="presentation" class="active"><a href="#deal-flight" aria-controls="deal-flight" role="tab" data-toggle="tab">Flight</a></li>
                <li role="presentation" ><a href="#deal-hotel" aria-controls="deal-flight" role="tab" data-toggle="tab">Hotel</a></li>
                  <li role="presentation" ><a href="#deal-bus" aria-controls="deal-bus" role="tab" data-toggle="tab">Bus</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content deal-tabsscont ">
              <div role="tabpanel" class="tab-pane active" id="deal-flight">

                <h3 class="lineth">Flight Deals</h3>
                <?php // print_r($promo_deal_list);
                     
                      foreach($promo_deal_list as $k=>$val){ 
                        if($val->module == 'flight'){
                                  ?>
                        <div class="col-md-12 deal-outss">
                          <div class="col-md-7 deal-imgss">
                           <h5><span class="promo-label">Flight Deal <span><?=$val->discount?><?=($val->discount == "PERCENTAGE") ? " %" : " INR"?> </span> Off </span></h5>
                            <h6><span class="promo-label">*Valid till <span><?=date('d M Y', strtotime($val->created_date))?></span> to <span><?=date('d M Y', strtotime($val->expiry_date))?></span> </span></h6>
                         
                            
                          </div>
                           <div class="col-md-5 deal-details">
                           <h4 class="deal-promooocode"><span class="promo-label">PROMO CODE</span> <span class="deal-promoo"><?=$val->promo_code?></span></h4>
                            </div>
                        </div>
                        <?php }}?>

              </div>
              <div role="tabpanel" class="tab-pane" id="deal-hotel">
                <h3 class="lineth">Hotel Deals</h3>
                 <?php // print_r($promo_deal_list);
                     
                      foreach($promo_deal_list as $k=>$val){ 
                        if($val->module == 'hotel'){
                                  ?>
                        <div class="col-md-12 deal-outss">
                          <div class="col-md-7 deal-imgss">
                             
                            
                          
                            <h5>Hotel Deal <span><?=$val->discount?><?=($val->discount == "PERCENTAGE") ? " %" : " INR"?> </span> Off </h5>
                            <h6><span class="promo-label">*Valid till <span><?=date('d M Y', strtotime($val->created_date))?></span> to <span><?=date('d M Y', strtotime($val->expiry_date))?></span> </span></h6>
                          </div>
                           <div class="col-md-5 deal-details">
                            <h4 class="deal-promooocode"><span class="promo-label">PROMO CODE</span> <span class="deal-promoo"><?=$val->promo_code?></span></h4>
                            <h6> *Valid till <span><?=date('d M Y', strtotime($val->created_date))?></span> to <span><?=date('d M Y', strtotime($val->expiry_date))?></span> </h6>
                          </div>
                        </div>
                        <?php }}?>

              </div>
              <div role="tabpanel" class="tab-pane" id="deal-bus">
                <h3 class="lineth">Bus Deals</h3>
                 <?php // print_r($promo_deal_list);
                     
                      foreach($promo_deal_list as $k=>$val){ 
                        if($val->module == 'bus'){
                                  ?>
                        <div class="col-md-12 deal-outss">
                          <div class="col-md-7 deal-imgss">
                             
                            
                          
                            <h5>Bus Deal <span><?=$val->discount?><?=($val->discount == "PERCENTAGE") ? " %" : " INR"?> </span> Off </h5>
                            <h6><span class="promo-label">*Valid till <span><?=date('d M Y', strtotime($val->created_date))?></span> to <span><?=date('d M Y', strtotime($val->expiry_date))?></span> </span></h6>
                          </div>
                           <div class="col-md-5 deal-details">
                            <h4 class="deal-promooocode"><span class="promo-label">PROMO CODE</span> <span class="deal-promoo"><?=$val->promo_code?></span></h4>
                            <h6>*Valid till <span><?=date('d M Y', strtotime($val->created_date))?></span> to <span><?=date('d M Y', strtotime($val->expiry_date))?></span> </h6>
                          </div>
                        </div>
                        <?php }}?>
              </div>
            </div>


                  <!-- // deal tab -->

                 </div>
                </div>

<!-- Feed Back -->
               <div role="tabpanel" class="tab-pane" id="feedb">
                <form method="post" action="<?php echo WEB_URL; ?>dashboard/add_feedback" id="myform">
                 <div class="col-md-8 main-divss">
                    <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                      <div class="prolabel">Name  </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                      <span id= "usernam"></span>
                      <input  type="text" class="form-control" name="feedback_name" id="feedback_name" placeholder="Enter your Name"   >
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                      <div class="prolabel">Email Address  </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                      <span id ="emails"></span>
                      <?php echo form_error('feedback_email'); ?>
                      <input  type="email" class="form-control" name="feedback_email" id="feedback_email" placeholder="Enter your Email"  >
                    </div> 
                    <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                      <div class="prolabel">Booking ref.no</div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                      <span id ="bookings"></span>
                    <input type="text" class="form-control" name="feedback_booking" id="feedback_booking" placeholder="Booking ref.no"  >
                    </div> 
                    <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                      <div class="prolabel">Message  </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                    <textarea class="form-control" name="message" id="message" placeholder="Enter your Message"  required=""  rows="5"></textarea>
                    </div>
                    <div class="col-sm-12">
                      <button type="submit"  class="center_btn update_btn"  onclick=" return valadition()">Send</button>
                    </div>
               

                 </div>
               </form>
                </div>
<!-- Feed Back -->

<!-- Refer a friend -->
               <div role="tabpanel" class="tab-pane" id="referf">
                 <div class="col-md-12 refer">
                    <div class="col-md-4 referimg">
                       <img src="<?=base_url().'assets/theme_dark/images/referr.png';?>" alt="deals-image" />
                    </div>
                    <div class="col-md-7 referinput nopad">
                      <form method="POST" action="<?php echo WEB_URL; ?>dashboard/sendMail">
                      <div class="col-lg-4 col-md-4 col-sm-12 fullprofiles">
                      <div class="prolabel">Email Address  </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 margbotm15 fullprofiles">
                       <?php echo form_error('email'); ?>
                      <input  type="email" class="form-control" name="email" placeholder="Enter your Email" value="" required="" >
                    </div> 
                    <div class="col-sm-12">
                    <button type="submit" class="center_btn update_btn">Invite</button>
                  </div>

                </form>
                    </div>
                  </div>
                </div>
<!-- Refer a friend -->






























               <!-- Passport Info -->
               <div role="tabpanel" class="tab-pane" id="messages">
                 <div class="col-md-10 norm-prefrnc">

                   <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                      <div class="prolabel">Home Airport  </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                    <input minlength="4" type="text" class="form-control" name="city_name" placeholder="Departing City or Airport" value="<?php echo $userInfo->home_airport; ?>" required readonly/>
                  </div> 
              <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles hide">
                <div class="prolabel">Meal Preference  </div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15  hide">
                <input minlength="4" type="text" class="form-control" name="city_name" placeholder="Departing City or Airport" value="<?php echo $address_details->city_name; ?>" required readonly/>
                  </div> 
              
               <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles  hide">
                <div class="prolabel">Special Assistance</div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15  hide">
                <input minlength="4" type="text" class="form-control" name="city_name" placeholder="Departing City or Airport" value="<?php echo $address_details->city_name; ?>" required readonly/>
                  </div> 
             
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles  hide">
                <div class="prolabel">Prefered Airline</div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15  hide">
               <input minlength="4" type="text" class="form-control" name="city_name" placeholder="Departing City or Airport" value="<?php echo $address_details->city_name; ?>" required readonly/>
              </div>
               <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles  hide">
                <div class="prolabel">Frequent Flyer No.</div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15  hide ">
               <input minlength="4" type="text" class="form-control" name="city_name" placeholder="Departing City or Airport" value="<?php echo $address_details->city_name; ?>" required readonly/>
              </div>  
             
              <div class="col-md-12">
                    <div class="col-md-3">
                     </div>
                    <div class="col-md-9">
                      <a href="#" class="dashbuttons extr_profile prefedit-btn"><i class="fal fa-edit"></i> Edit</a>
                    </div>
                 </div>
                </div>
                <form method="post" action="<?=base_url().'dashboard/updateHomeAirport'?>">
                  <div class="col-md-10 edit-prefrnc">
                   <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                      <div class="prolabel">Home Airport  </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                    <input type="text" class="fromflight form-control" name="home_airport" id="from_loc_id" placeholder="Home Airport" value="<?php echo $userInfo->home_airport; ?>" required/>
                  </div> 
              <!-- <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles hide">
                <div class="prolabel">Meal Preference  </div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 hide">
                <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="country" required>
                  <?php foreach($getCountry as $country){?>
                  <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $address_details->country_code) ? "selected" : ""; ?> ><?php echo $country->country_name;?></option>
                  <?php }?>
                </select>
              </div>
               <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles hide">
                <div class="prolabel">Special Assistance</div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 hide">
                <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="country" required>
                  <?php foreach($getCountry as $country){?>
                  <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $address_details->country_code) ? "selected" : ""; ?> ><?php echo $country->country_name;?></option>
                  <?php }?>
                </select>
              </div>
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles hide">
                <div class="prolabel">Prefered Airline</div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 hide">
                <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="country" required>
                  <?php foreach($getCountry as $country){?>
                  <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $address_details->country_code) ? "selected" : ""; ?> ><?php echo $country->country_name;?></option>
                  <?php }?>
                </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles hide">
                <div class="prolabel">Frequent Flyer No.</div>
              </div>
              <div class="col-md-9 ">
              <div class="add-flyer">
                <div class="clone-data">
                  <div class="inner-clones">
                 <div class="col-lg-6 col-md-6 col-sm-12 margbotm15 pad-r-5  hide">
                  <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="country" required>
                    <?php foreach($getCountry as $country){?>
                    <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $address_details->country_code) ? "selected" : ""; ?> ><?php echo $country->country_name;?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 margbotm15 pad-l-5 hide">
                  <input minlength="4" type="text" class="form-control" name="city_name" placeholder="Departing City or Airport" value="<?php echo $address_details->city_name; ?>" required/>
                </div>
                <a href="javascript:void(0)" class="text-danger pull-right close_clone"><i class="fa fa-times"></i></a>
                </div>
                </div>
</div>
                <div class="col-md-3 add-btnn nopad  hide">
                <button class="add-pref" id="add_more">Add More</button>
                </div> 
               
              </div> -->

                    <div class="col-md-12">
                       <div class="col-md-3">
                       </div>
                      <div class="col-md-3">
                        <!-- <a href="#" class="dashbuttons extr_profile"> Save</a>  -->
                        <input type="submit" class="dashbuttons extr_profile" value="Save">
                      </div>
                      <div class="col-md-3">
                          <a href="#" class="dashbuttons extr_profile bg-black edpref-cancel"> Cancel</a> 
                      </div>    
                    </div>
                    </form>
                 </div>


<!-- script-->
<script>
$(document).ready(function(){
   $(".prefedit-btn").click(function(){
    $(".norm-prefrnc").hide(),
    $(".edit-prefrnc").show();
  });
      $(".edpref-cancel").click(function(){
        $(".edit-prefrnc").hide(),
        $(".norm-prefrnc").show()
      });
      /*adtrave contact*/
$(".adtcontactedit-btn").click(function(){
    $(".adt-normcontact").hide(),
    $(".adt-editcontact").show();
  });
      $(".adt-contactcncl").click(function(){
        $(".adt-editcontact").hide(),
        $(".adt-normcontact").show()
      });

/*adtrave pass*/
$(".adtpassedit-btn").click(function(){
    $(".adt-normpassport").hide(),
    $(".adtedit-pass").show();
  });
      $(".adtedpass-cancel").click(function(){
        $(".adtedit-pass").hide(),
        $(".adt-normpassport").show()
      });
/*adtrave preference*/
 $(".adtprefedit-btn").click(function(){
    $(".adtnorm-prefrnc").hide(),
    $(".adtedit-prefrnc").show();
  });
      $(".adtedpref-cancel").click(function(){
        $(".adtedit-prefrnc").hide(),
        $(".adtnorm-prefrnc").show()
      });


  $('#adtadd_more').click(function(){
   $('.adtclone-data')
   .clone()
   .attr({"class":"cloned"})
   .appendTo(".adtadd-flyer")
  });
  $(document).on('click', '.adtclose_clone', function(){
   $(this).closest('.cloned').remove();
  });
  $(document).on('click', '.adtdelete_ff', function(){
   $('#id_'+$(this).data('id')).remove();
  });

   $('#add_more').click(function(){
   $('.clone-data')
   .clone()
   .attr({"class":"cloned"})
   .appendTo(".add-flyer")
  });
  $(document).on('click', '.close_clone', function(){
   $(this).closest('.cloned').remove();
  });
  $(document).on('click', '.delete_ff', function(){
   $('#id_'+$(this).data('id')).remove();
  });
 
});





</script>

               </div>
<!-- traveler info-->
 <div role="tabpanel" class="tab-pane" id="travelinfo" style="display: none;>
<!-- traveler Info -->
<div class="col-md-12 col-sm-12 col-xs-12">
<button type="button" class="btn-traveler" data-toggle="modal" data-target="#myModaladd">Add Traveler</button>

<div class="col-md-12">
<h2>Traveler's Details</h2>
<table class="table table-bordered addtrav-tab" >
  <thead>
    <tr>
      <th>Name</th>
      <th>Date Of Birth</th>
      <th>Email ID</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Mr Hghfg Ghfg</td>
      <td>07 Feb 2019</td>
      <td>Mr Hghfg Ghfg</td>
      <td>
      <a class="stopone toglefil" type="0"><label class="rounds"></label></a>
      <button class="addt-detail" data-toggle="collapse" data-target="#traveller_details_row" aria-expanded="true">Details</button>
      <a href="#" class="addt-cancel"><i class="fa fa-trash-o delet_class"></i></a>
      </td>
    </tr>
    <tr>
      <td colspan="4">
        <div id="traveller_details_row" class="traveller_details_row collapse" aria-expanded="true" style="">
  <div class="travemore">
    <div class="othinformtn">
         <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
            <a href="#ad-contact" aria-controls="ad-contact" role="tab" data-toggle="tab">
            <!--<a href="<?php echo WEB_URL; ?>dashboard/profile" class="<?php echo $staus_profile; ?>"> -->
            <i class="fal fa-user "></i> Contact Details</a></li>

             <li  role="presentation">
             <a href="#ad-pass" aria-controls="ad-pass" role="tab" data-toggle="tab">
              <i class="fal fa-ticket"></i> Passport Information</a>
            </li>

             <li  <li role="presentation">
             <a href="#ad-pref" aria-controls="d-pref" role="tab" data-toggle="tab">
             <i class="fal fa-building"></i> Preferences</a>
            </li>
          </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="ad-contact">
<!-- normal contact details-->
         <div class="adt-normcontact">
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">Name</div>
          </div>
           <div class="col-lg-9 col-md-9 col-sm-9 margbotm15 fullprofiles">
            <input  name="depature" id="" required type="text" class="form-control" value="" placeholder="First Name"/>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">Date Of Birth</div>
          </div>
           <div class="col-lg-9 col-md-9 col-sm-9 margbotm15 fullprofiles">
            <input  name="depature" id="" required type="text" class="form-control" value="" placeholder="First Name"/>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">Email ID</div>
          </div>
           <div class="col-lg-9 col-md-9 col-sm-9 margbotm15 fullprofiles">
            <input  name="depature" id="" required type="text" class="form-control" value="" placeholder="First Name"/>
            </div>
             <div class="col-md-12">
                    <div class="col-md-3">
                     </div>
                    <div class="col-md-9">
                      <a href="#" class="dashbuttons extr_profile adtcontactedit-btn"><i class="fal fa-edit"></i> Edit</a>
                    </div>
                 </div>

         </div>
  <!-- edit contact details -->      
          <div class="adt-editcontact">
          <div class="col-md-12">
          <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">Title<span>*</span> </div>
          </div>
                       <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="country" required>
                  <?php foreach($getCountry as $country){?>
                  <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $address_details->country_code) ? "selected" : ""; ?> ><?php echo $country->country_name;?></option>
                  <?php }?>
                </select>
              </div>
          <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">First Name<span>*</span> </div>
          </div>
           <div class="col-lg-9 col-md-9 col-sm-9 margbotm15 fullprofiles">
            <input  name="depature" id="" required type="text" class="form-control" value="" placeholder="First Name"/>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">Last Name<span>*</span> </div>
          </div>
           <div class="col-lg-9 col-md-9 col-sm-9 margbotm15 fullprofiles">
            <input  name="depature" id="" required type="text" class="form-control" value="" placeholder="Last Name"/>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">Date Of Birth<span>*</span> </div>
          </div>
           <div class="col-lg-9 col-md-9 col-sm-9 margbotm15 fullprofiles">
            <input  name="depature" id="atdob" required type="text" class="form-control" value="" placeholder="Date Of Birth"/>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">Email ID<span>*</span> </div>
          </div>
           <div class="col-lg-9 col-md-9 col-sm-9 margbotm15 fullprofiles">
            <input  name="depature" id="" required type="text" class="form-control" value="" placeholder="Email ID"/>
            </div>
        </div>
       <div class="col-md-12 addtr-btn">
          <div class="col-md-3">
          </div>
          <button type="button" class="btn btn-default adt-addbutton" >Save</button>
           <button type="button" class="btn btn-default adt-contactcncl" >Cancel</button>
       </div> 
       </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="ad-pass">
        <!-- normal pass details-->
         <div class="adt-normpassport">
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">Passport Number</div>
          </div>
           <div class="col-lg-9 col-md-9 col-sm-9 margbotm15 fullprofiles">
            <input  name="depature" id="" required type="text" class="form-control" value="" placeholder="First Name"/>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">Expiry Date</div>
          </div>
           <div class="col-lg-9 col-md-9 col-sm-9 margbotm15 fullprofiles">
            <input  name="depature" id="" required type="text" class="form-control" value="" placeholder="First Name"/>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">Issuing Country</div>
          </div>
           <div class="col-lg-9 col-md-9 col-sm-9 margbotm15 fullprofiles">
            <input  name="depature" id="" required type="text" class="form-control" value="" placeholder="First Name"/>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">Nationality</div>
          </div>
           <div class="col-lg-9 col-md-9 col-sm-9 margbotm15 fullprofiles">
            <input  name="depature" id="" required type="text" class="form-control" value="" placeholder="First Name"/>
            </div>
             <div class="col-md-12">
                    <div class="col-md-3">
                     </div>
                    <div class="col-md-9">
                      <a href="#" class="dashbuttons extr_profile adtpassedit-btn"><i class="fal fa-edit"></i> Edit</a>
                    </div>
                 </div>

         </div><!-- end passport edit -->

<!-- adt-passport edit page -->
                  <div class="col-md-10 adtedit-pass">
              <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                <div class="prolabel">Passport Number <span>*</span>  </div>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                <input minlength="4" type="text" class="form-control" name="city_name" placeholder="" value="<?php echo $address_details->city_name; ?>" required/>
              </div> 
              <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                  <div class="prolabel">Expiry Date <span>*</span>  </div>
              </div>
               <div class="col-lg-9 col-md-9 col-sm-9 margbotm15">
                <input  name="depature" id="passexpiry" required type="text" class="form-control" value="" placeholder="Passport Expiry Date"  />
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                <div class="prolabel">Issuing Country <span>*</span> </div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="country" required>
                  <?php foreach($getCountry as $country){?>
                  <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $address_details->country_code) ? "selected" : ""; ?> ><?php echo $country->country_name;?></option>
                  <?php }?>
                </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                <div class="prolabel">Nationality<span>*</span> </div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="country" required>
                  <?php foreach($getCountry as $country){?>
                  <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $address_details->country_code) ? "selected" : ""; ?> ><?php echo $country->country_name;?></option>
                  <?php }?>
                </select>
              </div>
                   <div class="col-md-12">
                     <div class="col-md-3">
                     </div>
                    <div class="col-md-3">
                      <a href="#" class="dashbuttons extr_profile"> Save</a> 
                    </div>
                    <div class="col-md-3">
                      <a href="#" class="dashbuttons extr_profile bg-black adtedpass-cancel"> Cancel</a> 
                    </div>    
                    </div>
                  </div>

        </div>
        <div role="tabpanel" class="tab-pane" id="ad-pref">
       <!-- normal Pref -->
       <div class="col-md-10 adtnorm-prefrnc">

                   <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                      <div class="prolabel">Home Airport  </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                    <input minlength="4" type="text" class="form-control" name="city_name" placeholder="Departing City or Airport" value="<?php echo $address_details->city_name; ?>" required readonly/>
                  </div> 
              <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                <div class="prolabel">Meal Preference  </div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                <input minlength="4" type="text" class="form-control" name="city_name" placeholder="Departing City or Airport" value="<?php echo $address_details->city_name; ?>" required readonly/>
                  </div> 
              
               <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                <div class="prolabel">Special Assistance</div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                <input minlength="4" type="text" class="form-control" name="city_name" placeholder="Departing City or Airport" value="<?php echo $address_details->city_name; ?>" required readonly/>
                  </div> 
             
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                <div class="prolabel">Prefered Airline</div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
               <input minlength="4" type="text" class="form-control" name="city_name" placeholder="Departing City or Airport" value="<?php echo $address_details->city_name; ?>" required readonly/>
              </div>
               <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                <div class="prolabel">Frequent Flyer No.</div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
               <input minlength="4" type="text" class="form-control" name="city_name" placeholder="Departing City or Airport" value="<?php echo $address_details->city_name; ?>" required readonly/>
              </div>  
             
              <div class="col-md-12">
                    <div class="col-md-3">
                     </div>
                    <div class="col-md-9">
                      <a href="#" class="dashbuttons extr_profile adtprefedit-btn"><i class="fal fa-edit"></i> Edit</a>
                    </div>
                 </div>
                </div>
<!-- edit add traveler pref -->
                <div class="col-md-10 adtedit-prefrnc">
                   <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                      <div class="prolabel">Home Airport  </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                    <input minlength="4" type="text" class="form-control" name="city_name" placeholder="Departing City or Airport" value="<?php echo $address_details->city_name; ?>" required/>
                  </div> 
              <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                <div class="prolabel">Meal Preference  </div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="country" required>
                  <?php foreach($getCountry as $country){?>
                  <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $address_details->country_code) ? "selected" : ""; ?> ><?php echo $country->country_name;?></option>
                  <?php }?>
                </select>
              </div>
               <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                <div class="prolabel">Special Assistance</div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="country" required>
                  <?php foreach($getCountry as $country){?>
                  <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $address_details->country_code) ? "selected" : ""; ?> ><?php echo $country->country_name;?></option>
                  <?php }?>
                </select>
              </div>
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                <div class="prolabel">Prefered Airline</div>
              </div>
             <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="country" required>
                  <?php foreach($getCountry as $country){?>
                  <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $address_details->country_code) ? "selected" : ""; ?> ><?php echo $country->country_name;?></option>
                  <?php }?>
                </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                <div class="prolabel">Frequent Flyer No.</div>
              </div>
              <div class="col-md-9 ">
              <div class="adtadd-flyer">
                <div class="adtclone-data">
                  <div class="adtinner-clones">
                 <div class="col-lg-6 col-md-6 col-sm-12 margbotm15 pad-r-5">
                  <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="country" required>
                    <?php foreach($getCountry as $country){?>
                    <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $address_details->country_code) ? "selected" : ""; ?> ><?php echo $country->country_name;?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 margbotm15 pad-l-5">
                  <input minlength="4" type="text" class="form-control" name="city_name" placeholder="Departing City or Airport" value="<?php echo $address_details->city_name; ?>" required/>
                </div>
                <a href="javascript:void(0)" class="text-danger pull-right adtclose_clone"><i class="fa fa-times"></i></a>
                </div>
                </div>
</div>
                <div class="col-md-3 add-btnn nopad">
                <button class="adtadd-pref" id="adtadd_more">Add More</button>
                </div>
               
              </div>

                    <div class="col-md-12">
                       <div class="col-md-3">
                       </div>
                      <div class="col-md-3">
                        <a href="#" class="dashbuttons adtextr_profile"> Save</a> 
                      </div>
                      <div class="col-md-3">
                          <a href="#" class="dashbuttons extr_profile bg-black adtedpref-cancel"> Cancel</a> 
                      </div>    
                    </div>

                 </div>















        </div>
      </div>
    </div>
  </div>
</div>

      </td>
    </tr>
  </tbody>
</table>
</div>




 <!-- Modal -->
  <div class="modal fade" id="myModaladd" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Add Traveler</h4>
        </div>
        <div class="modal-body">
          <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">Title<span>*</span> </div>
          </div>
                       <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="country" required>
                  <?php foreach($getCountry as $country){?>
                  <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $address_details->country_code) ? "selected" : ""; ?> ><?php echo $country->country_name;?></option>
                  <?php }?>
                </select>
              </div>
          <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">First Name<span>*</span> </div>
          </div>
           <div class="col-lg-9 col-md-9 col-sm-9 margbotm15 fullprofiles">
            <input  name="depature" id="" required type="text" class="form-control" value="" placeholder="First Name"/>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">Last Name<span>*</span> </div>
          </div>
           <div class="col-lg-9 col-md-9 col-sm-9 margbotm15 fullprofiles">
            <input  name="depature" id="" required type="text" class="form-control" value="" placeholder="Last Name"/>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">Date Of Birth<span>*</span> </div>
          </div>
           <div class="col-lg-9 col-md-9 col-sm-9 margbotm15 fullprofiles">
            <input  name="depature" id="atdob" required type="text" class="form-control" value="" placeholder="Date Of Birth"/>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
            <div class="prolabel">Email ID<span>*</span> </div>
          </div>
           <div class="col-lg-9 col-md-9 col-sm-9 margbotm15 fullprofiles">
            <input  name="depature" id="" required type="text" class="form-control" value="" placeholder="Email ID"/>
            </div>
        </div>
       <div class="col-md-12 addtr-btn">
          <div class="col-md-3">
          </div>
          <button type="button" class="btn btn-default adt-add" >Add</button>
           <button type="button" class="btn btn-default adt-cncl" data-dismiss="modal">Cancel</button>
       </div>
      </div>
      
    </div>
  </div>
  
<script type="text/javascript">
   $(document).ready(function(){
      $( "#atdob" ).datepicker({
         changeMonth: true, 
          changeYear: true, 
                           
       });


   }); 



</script>




</div>
<!-- traveler Info End -->






 </div>





                </div>
                
              </div>
              
               
          <?php 
		  $failed=array();$confirmed=array();$pending=array();$cancelled=array();$days=array();
		      if(isset($getoverallBookings[0])){ 
               foreach($getoverallBookings as $booking){
				  if($booking->booking_status == 'FAILED')
				  {
						if(isset($booking->api_status))
							$failed[] = $booking->api_status;
						else
							$failed[] = 'FAILED';
				  }
				   if($booking->booking_status == 'CONFIRMED')
				  {
               		 $confirmed[] = $booking->booking_status;
				  }
				    if($booking->booking_status == 'HOLD')
				  {
               		 $pending[] = $booking->booking_status;
				  }
				   if($booking->booking_status == 'CANCELED')
				  {
               		 $cancelled[] = $booking->booking_status;
				  }
               		 $days[] = $booking->leadpax;
              } 
            
               
            }
			  $failed_count = count($failed);
			   $confirmed_count = count($confirmed);
			    $pending_count = count($pending);
				 $cancelled_count = count($cancelled);
               $days_count = count($days);
          ?>

			  <div class="clearfix"></div>
              
              
              
              
              <!-- End of Admin top -->
              
              <div class="clearfix"></div>
              <div class="row margtop15 addings hide">


                <div class="col-md-4 offset-0"> 
                	<div class="inrowit">
                    <span class="size16 bold dark newprof">Recent Bookings</span>
                    <div class="outsprof">
                    <?php 
					if(count($getoverallBookings) > 0)
					{
					$b_count = 5;
					if(count($getoverallBookings) <= 5)
					{
					$b_count = count($getoverallBookings);
					}
					
					for($f=0;$f< $b_count;$f++)
					{
					
						?>
                      <a href="#" class="clblue"> #<?php echo $getoverallBookings[$f]->pnr_no; ?></a><br/>
                    <?php
					}
					?>
                  	<a href="<?php echo WEB_URL.'/dashboard/bookings'; ?>" class="proa">View All</a> 
                    <?php
					}
					else
					{
					?>
                    No Bookings Are Done.
                    <?php
					}
					?>
                    </div>
                    </div>
               </div>
              </div>
            </div>
          
          
<?php //$this->load->view(PROJECT_THEME.'/dashboard/profile/edit_profile');?>
<?php //$this->load->view(PROJECT_THEME.'/dashboard/profile/verifications');?>        
   
       

        
        
</section>
</section>
</div>
</div></div>
</body>

<div class="clearfix"></div>


<!-- Page Content -->
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>
</body>
</html>
<script src="<?php echo ASSETS; ?>js/jquery.ajaxform.js"></script>
<script type="text/javascript">
    $(document).ready(function() { 

     
  $('ul.tabss li').click(function(){
    var tab_id = $(this).attr('data-tab');

    $('ul.tabss li').removeClass('current');
    $('.tab-content').removeClass('current');

    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
  });






        $('#profilePhoto').on('change', function() {
            $('.imgLoader').fadeIn();
            $("#myForm").ajaxForm({
                dataType: 'json',
                success: function(r) {
                    //$('.fstusrp').html('<img src="'+r.img+'">');
                    //$('.profileusrs').html('<img src="'+r.img+'">');
                    $('.profile_photo').attr("src", r.img);
                    $('.imgLoader').fadeOut();
                }
            }).submit();
        })
    }); 
</script>

<script>
$(document).ready(function() {
	
	//$('#example').DataTable();
	$('#depostDatatable').DataTable( {
		"order": [[ 1, "desc" ]],
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "<?php echo ASSETS;?>swf/copy_csv_xls_pdf.swf"
        }
    } );
	
  //BookingPagination();







});
		
	</script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/dataTables.tableTools.js"></script>
