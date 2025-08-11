<?php
$uri_string =    $this->uri->uri_string(); 

	$staus_dashboard = ($uri_string == 'dashboard') ? 'active' : '';
	
	$staus_profile = ($uri_string == 'dashboard/profile' || $uri_string == 'dashboard/edit_profile' || $uri_string == 'dashboard/verification' || $uri_string == 'dashboard/change_pwd') ? 'active' : '';
	$status_profile_view = ($uri_string == 'dashboard/profile') ? 'active' : '';
	$status_profile_edit = ($uri_string == 'dashboard/edit_profile') ? 'active' : '';
	$status_profile_verify = ($uri_string == 'dashboard/verification') ? 'active' : '';
	$change_request = ($uri_string == 'dashboard/change_request') ? 'active' : '';
	
	
	$staus_bookings = ($uri_string == 'dashboard/bookings' || $uri_string == 'dashboard/bookings/IkZsaWdodCI=' || $uri_string == 'dashboard/bookings/IkhvdGVsIg==' || $uri_string == 'dashboard/bookings/IkNhciI=' || $uri_string == 'dashboard/bookings/IlBhY2thZ2VzIg==' || $uri_string == 'dashboard/bookings/IkFjdGl2aXRpZXMi' || $uri_string == 'dashboard/bookings/IlJhaWwi' || $uri_string == 'dashboard/bookings/IkNydWlzZSI=' || $uri_string == 'dashboard/bookings/IlRyYW5zZmVycyI=') ? 'active' : '';
	$staus_bookings_all = ($uri_string == 'dashboard/bookings') ? 'active' : '';
	$staus_bookings_flight = ($uri_string == 'dashboard/bookings/IkZsaWdodCI=') ? 'active' : '';
	$staus_bookings_hotel = ($uri_string == 'dashboard/bookings/IkhvdGVsIg==') ? 'active' : '';
	$staus_bookings_car = ($uri_string == 'dashboard/bookings/IkNhciI=') ? 'active' : '';
	$staus_bookings_package = ($uri_string == 'dashboard/bookings/IlBhY2thZ2VzIg==') ? 'active' : '';
	$staus_bookings_activity = ($uri_string == 'dashboard/bookings/IkFjdGl2aXRpZXMi') ? 'active' : '';
	$staus_bookings_rail = ($uri_string == 'dashboard/bookings/IlJhaWwi') ? 'active' : '';
	$staus_bookings_cruise = ($uri_string == 'dashboard/bookings/IkNydWlzZSI=') ? 'active' : '';
	$staus_bookings_transfer = ($uri_string == 'dashboard/bookings/IlRyYW5zZmVycyI=') ? 'active' : '';
	
	
	
	$staus_settings = ($uri_string == 'dashboard/settings' || $uri_string == 'security/setUpTwoStep' || $uri_string == 'security/twostepVerification' || $uri_string == 'dashboard/sms_alerts' || $uri_string == 'dashboard/cancel_account' || $uri_string == 'dashboard/markup') ? 'active' : '';
  $staus_settings_markup = ($uri_string == 'dashboard/markup') ? 'active' : '';
	$staus_settings_affilate = ($uri_string == 'dashboard/affilate_link') ? 'active' : '';
	$staus_settings_security = ($uri_string == 'dashboard/settings') ? 'active' : '';
	$staus_settings_smsalert = ($uri_string == 'dashboard/sms_alerts') ? 'active' : '';
	$staus_settings_changpwd = ($uri_string == 'dashboard/change_pwd') ? 'active' : '';
	$staus_settings_cancelacnt = ($uri_string == 'dashboard/cancel_account') ? 'active' : '';
	
	
	$staus_support_conversation = ($uri_string == 'dashboard/support_conversation' || $uri_string == 'dashboard/ticket_inbox' || $uri_string == 'dashboard/sent_ticket' || $uri_string == 'dashboard/closed_tickets') ? 'active' : '';
	$staus_support_compose = ($uri_string == 'dashboard/support_conversation') ? 'active' : '';
	$staus_support_inbox = ($uri_string == 'dashboard/ticket_inbox') ? 'active' : '';
	$staus_support_sent = ($uri_string == 'dashboard/sent_ticket') ? 'active' : '';
	$staus_support_closed = ($uri_string == 'dashboard/closed_tickets') ? 'active' : '';
	
	
	$staus_deposit = ($uri_string == 'dashboard/deposit') ? 'active' : '';
	$staus_account_statement = ($uri_string == 'dashboard/account_statement' || $uri_string == 'dashboard/booking_statement' || $uri_string == 'dashboard/profit_matrix' || $uri_string == 'dashboard/deposit_control') ? 'active' : '';
	$staus_support_acntstmt = ($uri_string == 'dashboard/account_statement') ? 'active' : '';
	$staus_support_bkstmt = ($uri_string == 'dashboard/booking_statement') ? 'active' : '';
	$staus_support_profit = ($uri_string == 'dashboard/profit_matrix') ? 'active' : '';
	$staus_support_dptctl = ($uri_string == 'dashboard/deposit_control') ? 'active' : '';

  $staus_deposit1 = ($uri_string == 'dashboard/booking_statement1') ? 'active' : '';
	
	
	
	$staus_newsletter = ($uri_string == 'dashboard/newsletter') ? 'active' : ''; 


?>

<?php if($userInfo->user_type_name == 'B2B' || $userInfo->user_type_name == 'STAFF'){ ?>
      <link href="<?php echo ASSETS; ?>css/b2b_dashboard.css" rel="stylesheet" />
    
    
    <?php }?>

    <style type="text/css">

  .logo img {
    /*padding: 4px 0;
    width: 231px;*/
}
 
    </style>
<button class="dash_menus"><span class="fa fa-bars"></span></button>



<div class="sidebar_wrap">

<div id="sidebar1" class="nav-collapse top_dash">
	<?php if($userInfo->user_type_id == 4){ 
			/*$superuser = $this->general_model->get_superuser($userInfo->sub_user_id);
			$username = $superuser->user_name.' / '.$userInfo->c_p_name;*/
			$username = $userInfo->user_name;
		} else {
			$username = $userInfo->user_name;
		}?>

	<div class="profile_dir">
          <a class="dash_user" href="<?php echo WEB_URL.'dashboard/profile'; ?>">
            <img src="<?php  echo WEB_URL;echo "photo/users/".''.$userInfo->profile_picture; ?>" alt="user image"  width="70">
          </a>
          <h5 class="centered"><?php echo $username;?></h5>
          </div>

      <!-- sidebar menu start-->
      <ul class="sidebar-menu nw-style" id="nav-accordion">
                    
          <!-- <li>
              <a class="" href="<?php echo WEB_URL; ?>">
                  <i class="fa fa-home"></i>
                  <span>Home</span>
              </a>
          </li> -->
          <?php if($userInfo->user_type_name == 'B2B' || $userInfo->user_type_name == 'STAFF'){ ?>
          <li>
              <a href="<?php echo WEB_URL; ?>dashboard" class="<?php echo $staus_dashboard; ?>">
                 <p> <i class="fal fa-search"></i><br>
                  <span>Search</span></p>
              </a>
          </li>
          <?php
          }else{
              ?>
              <li>
              <a href="<?php echo WEB_URL; ?>" class="<?php echo $staus_dashboard; ?>">
                 <p> <i class="fal fa-search"></i><br>
                  <span>Search</span></p>
              </a>
          </li>
              
              <?php
          }
          ?>
          <li>
              <a href="<?php echo WEB_URL; ?>dashboard/bookings" class="<?php echo $staus_bookings; ?>">
                 <p> <i class="fal fa-ticket"></i><br>
                  <span>Dashboard</span></p>
              </a>
             
          </li>


      

          <li>
              <a href="<?php echo WEB_URL; ?>dashboard/profile" class="<?php echo $staus_profile; ?>">
                  <p><i class="fal fa-user"></i><br>
                  <span>Profile</span></p>
              </a>
              <!--<ul class="sub">
                  <li class="<?php echo $status_profile_view; ?>"><a href="<?php echo WEB_URL; ?>dashboard/profile"><i class="fa fa-eye"></i>View Profile</a></li>
                  <li class="<?php echo $status_profile_edit; ?>"><a href="<?php echo WEB_URL; ?>dashboard/edit_profile"><i class="fa fa-pencil-square-o"></i>Edit Profile</a></li>

              </ul>-->
          </li>
          
          <?php if($userInfo->user_type_name == 'STAFF'){ ?>
          <li>
              <a href="<?php echo WEB_URL; ?>dashboard/change_request" class="<?php echo $change_request; ?>">
                  <p><i class="fal fa-user"></i><br>
                  <span>Change Request</span></p>
              </a>
          </li>
          <?php } ?>
          
              <li class="hide">
              <a class="<?php echo $staus_dashboard; ?>" href="<?php echo WEB_URL; ?>dashboard">
                  <p><i class="fal fa-dashboard"></i><br>
                  <span>Dashboard</span></p>
              </a>
          </li>
            <?php if($userInfo->user_type_name == 'B2B' ){ ?>
            <li class="sub-menu dropdown">
              <a class="<?php echo $staus_settings; ?>" href="javascript:;"  id="dropdownMenuButtonb2bsetting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <p><i class=" fal fa-gear"></i><br>
                  <span>Settings</span></p>
              </a>
             <ul  class="dropdown-menu sub" aria-labelledby="dropdownMenuButtonb2bsetting">
                
              <li class="<?php echo $staus_settings_markup; ?>"><a href="<?php echo WEB_URL; ?>dashboard/markup">Markup</a></li>
             <!--  <li class="<?php //echo $staus_settings_affilate; ?>"><a href="<?php echo WEB_URL; ?>dashboard/affilate_link">Affilate Link</a></li> -->
              
                  <li class="hide <?php echo $staus_settings_security; ?>"><a href="<?php echo WEB_URL; ?>dashboard/settings">Security</a></li>
                  <!-- <li class="hide <?php echo $staus_settings_smsalert; ?>"><a href="<?php echo WEB_URL; ?>dashboard/sms_alerts">SMS Alert</a></li> -->
                  <li class="<?php echo $staus_settings_changpwd; ?>"><a href="<?php echo WEB_URL; ?>dashboard/change_pwd">Change Password</a></li>
                 <!--<li class="<?php //echo $staus_settings_cancelacnt; ?>"><a href="<?php //echo WEB_URL; ?>dashboard/cancel_account">Close Account</a></li> 
              --></ul>
          </li>
          <?php }?> 
           <!--  <li>
              <a href="#" class="<?php echo $staus_settings; ?>">
                  <p><i class=" fal fa-gear"></i><br>
                  <span>Traveler Information</span></p>
              </a>
             <ul class="sub">
              	  <?php if($userInfo->user_type_name == 'B2B'){	?>
        		  <li class="<?php echo $staus_settings_markup; ?>"><a href="<?php echo WEB_URL; ?>dashboard/markup">Markup</a></li>
        		  <?php }?> 
                  <li class="hide <?php echo $staus_settings_security; ?>"><a href="<?php echo WEB_URL; ?>dashboard/settings">Security</a></li>
                  <li class="hide <?php echo $staus_settings_smsalert; ?>"><a href="<?php echo WEB_URL; ?>dashboard/sms_alerts">SMS Alert</a></li>
                  <li class="<?php echo $staus_settings_changpwd; ?>"><a href="<?php echo WEB_URL; ?>dashboard/change_pwd"><i class="fa fa-key"></i>Change Password</a></li>
                 <li class="<?php //echo $staus_settings_cancelacnt; ?>"><a href="<?php //echo WEB_URL; ?>dashboard/cancel_account">Close Account</a></li> 
              </ul>
          </li>-->
          
        <!--   <li class="sub-menu">
              <a href="javascript:;" class="<?php echo $staus_support_conversation; ?>">
                  <i class="fa fa-tasks"></i>
                  <span>Support Ticket</span>
              </a>
              <ul class="sub">
                  <li class="<?php echo $staus_support_compose; ?>"><a href="<?php echo WEB_URL; ?>dashboard/support_conversation">Compose</a></li>
                  <li class="<?php echo $staus_support_inbox; ?>"><a href="<?php echo WEB_URL; ?>dashboard/ticket_inbox">Inbox</a></li>
                  <li class="<?php echo $staus_support_sent; ?>"><a href="<?php echo WEB_URL; ?>dashboard/sent_ticket">Sent</a></li>
                  <li class="<?php echo $staus_support_closed; ?>"><a href="<?php echo WEB_URL; ?>dashboard/closed_tickets">Close</a></li>
              </ul>
          </li> -->
          
          <?php 
	if($userInfo->user_type_name == 'B2B'|| $userInfo->user_type_name == 'STAFF')
	{
		?>
		  
          
          <li>
              <a class="<?php echo $staus_deposit; ?>" href="javascript:;" id="deposit">
                  <p><i class="fal fa-file-text"></i><br>
                  <span>Deposit</span>
                  </p>
              </a>
             
          </li>
          
          <li class="sub-menu dropdown">
              <a  class="<?php echo $staus_account_statement; ?>" href="javascript:;"  id="dropdownMenuButtonaccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <p><i class="fal fa-book"></i><br>
                  <span>Account Statement</span>
                  </p>
              </a>
              <ul class="dropdown-menu sub" aria-labelledby="dropdownMenuButtonaccount">
                  <li class="<?php echo $staus_support_acntstmt; ?>"><a href="<?php echo WEB_URL; ?>dashboard/account_statement">Account Statement</a></li>
                  <li class="<?php echo $staus_support_bkstmt; ?>"><a href="<?php echo WEB_URL; ?>dashboard/booking_statement">Booking Statement</a></li>
                  <li class="<?php echo $staus_support_profit; ?>"><a href="<?php echo WEB_URL; ?>dashboard/profit_matrix">Profit Matrixs</a></li>
                  <!-- <li class="<?php echo $staus_support_dptctl; ?>"><a href="<?php echo WEB_URL; ?>dashboard/deposit_control">Deposit Control</a></li> -->
              </ul>
          </li>
          <?php if ($userInfo->user_type_name == 'B2B') {?>
       
          <li class="sub-menu dropdown">
              <a href="javascript:;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="<?php echo $staus_support_conversation; ?> dropdown-toggle">
                  <p><i class="fal fa-tasks"></i>
                  <span>Support Ticket</span><br>
                  </p>
              </a>
                    <ul class="dropdown-menu sub" aria-labelledby="dropdownMenuButton">
                          <li class="<?php echo $staus_support_compose; ?>"><a href="<?php echo WEB_URL; ?>dashboard/support_conversation">Compose</a></li>
                          <li class="<?php echo $staus_support_inbox; ?>"><a href="<?php echo WEB_URL; ?>dashboard/ticket_inbox">Inbox</a></li>
                          <li class="<?php echo $staus_support_sent; ?>"><a href="<?php echo WEB_URL; ?>dashboard/sent_ticket">Sent</a></li>
                          <li class="<?php echo $staus_support_closed; ?>"><a href="<?php echo WEB_URL; ?>dashboard/closed_tickets">Close</a></li>
          <?php } ?>
                          <?php }?>   
                    </ul>
                  </li>
 <?php 
	if($userInfo->user_type_name == 'B2B')
	{
		?>
		  
            <li>
              <a class="<?php echo $staus_deposit1; ?>" href="<?php echo WEB_URL; ?>dashboard/booking_statement1" id="pnr">
                  <p><i class="fal fa-file-text"></i><br>
                  <span>PNR</span>
                  </p>
              </a>
          </li>
          <li class="sub-menu dropdown">
            <a href="javascript:;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class=" dropdown-toggle">
              <p><i class="fal fa-users"></i>
              <span>Group Booking</span><br>
              </p>
            </a>
            <ul class="dropdown-menu sub" aria-labelledby="dropdownMenuButton">
              <li class=""><a href="<?php echo WEB_URL; ?>dashboard/add_search">Send Enquiry</a></li>
              <li class=""><a href="<?php echo WEB_URL; ?>flight/get_grp_booking">List Enquiries</a></li>
            </ul>
          </li>
<?php
}
?>

              
      <!-- sidebar menu end-->
</div>
</div>
  
<script class="include" type="text/javascript" src="<?php echo ASSETS; ?>js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo ASSETS; ?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.dash_menus').click(function(){
		$('.sidebar_wrap').toggleClass('open');
	});
});

$('#news_letter').click(function(){
	location.href="<?php echo WEB_URL; ?>dashboard/newsletter";
});
$('#deposit').click(function(){
	location.href="<?php echo WEB_URL; ?>dashboard/deposit";
});


// $(function() {
//     $('#nav-accordion').dcAccordion({
//         eventType: 'click',
//         autoClose: true,
//         saveState: true,
//         disableLink: true,
//         speed: 'slow',
//         showCount: false,
//         autoExpand: true,
// //        cookie: 'dcjq-accordion-1',
//         classExpand: 'dcjq-current-parent'
//     });
// });
var Script = function () {


//    sidebar dropdown menu auto scrolling





//    sidebar toggle

    $(function() {
        function responsiveView() {
            var wSize = $(window).width();
            if (wSize <= 768) {
                $('#container').addClass('sidebar-close');
                //$('#sidebar > ul').hide();
            }

            if (wSize > 768) {
                $('#container').removeClass('sidebar-close');
                $('#sidebar > ul').show();
            }
        }
        $(window).on('load', responsiveView);
        $(window).on('resize', responsiveView);
    });
	
/*	$('.fa-bars').click(function () {
        if ($('#sidebar > ul').is(":visible") === true) {
            $('#main-content').css({
                'margin-left': '0px'
            });
            $('#sidebar').css({
                'margin-left': '-210px'
            });
            $('#sidebar > ul').hide();
            $("#container").addClass("sidebar-closed");
        } else {
            $('#main-content').css({
                'margin-left': '210px'
            });
            $('#sidebar > ul').show();
            $('#sidebar').css({
                'margin-left': '0'
            });
            $("#container").removeClass("sidebar-closed");
        }
    });*/


// custom scrollbar
    $("#sidebar").niceScroll({styler:"fb",cursorcolor:"#4ECDC4", cursorwidth: '3', cursorborderradius: '10px', background: '#404040', spacebarenabled:false, cursorborder: ''});

   

// widget tools

    jQuery('.panel .tools .fa-chevron-down').click(function () {
        var el = jQuery(this).parents(".panel").children(".panel-body");
        if (jQuery(this).hasClass("fa-chevron-down")) {
            jQuery(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            el.slideDown(200);
        }
    });

    jQuery('.panel .tools .fa-times').click(function () {
        jQuery(this).parents(".panel").parent().remove();
    });




}();


//Prevent mousewheel on hover of sidebar
/*$( '.top_dash' ).bind( 'mousewheel DOMMouseScroll', function ( e ) {
    var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;

    this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
    e.preventDefault();
});*/


</script>

<div class="clearfix"></div>

<div class="clearfix"></div>
