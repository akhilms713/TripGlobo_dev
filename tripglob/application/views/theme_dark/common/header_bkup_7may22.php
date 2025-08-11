<?php $currency_info =   $this->general_model->get_currency_info(); ?>


<style type="text/css">

.user_profimag img {width: 20px;border-radius: 50%;display: block;float: left;  }
.ritsude > li > a { overflow: hidden; margin: 10px 40px;  }
.null_effective {float: right;}
#showLeft{display: none;}
ul.dropdown-menu.mysign1 li a{padding: 10px 15px;}
ul.dropdown-menu.mysign1:after {
  content: '';
  border-bottom: 6px solid #000000;
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  content: "";
  display: inline-block;
  left: 42%;
  position: absolute;
  top: -7px;
}
.userorlogin {color: #4c4c4c;
  display: block;
  float: left;
  font-size: 14px;
padding-right: 15px;
  position: relative; 
    text-overflow: ellipsis;
    white-space: nowrap;
    /*overflow: hidden; */
   /* width: 124px;*/
  }
.userorlogin::after {
  color: #4c4c4c;
  content: "";
  font-family: "FontAwesome";
  position: absolute;
  right: 0;
}
ul.dropdown-menu.mysign1 {min-width: 250px;left: 38px;}
 ul.dropdown-menu.mysign1 { margin: 26px 0 0 0;}

  ul.dropdown-menu.mysign2 {     
    margin: 26px 0 0 0;
    max-width: 255px;
    right: 0px !important;
    left: 0px !important;
    padding: 15px;
    margin-left: 0em!important;
    margin: auto 0;} 
.reglognorml {
    padding: 10px 17px;
    line-height: 0px;}
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
  <div class="container module_header b2b-dash">


  <button id="showLeft" class="in_page_menu">
  	<span class="fa fa-bars"></span>
  </button>
  <?php if($this->session->userdata('user_type')=='1' || $this->session->userdata('user_type')=='4'){  ?>
  <a class="logo" href="<?php echo WEB_URL.'dashboard'; ?>"><img src="<?php echo ASSETS; ?>images/logo.png" alt="<?php  echo PROJECT_NAME; ?>" /> </a> 
  <?php }else{ ?>
    <a class="logo" href="<?php echo $_SERVER['REQUEST_URI']; ?>">
   <!-- <a class="logo" href="<?php //echo WEB_URL.'account/agent_login'; ?>">-->
    <img src="<?php echo ASSETS; ?>images/logo.png" alt="<?php  echo PROJECT_NAME; ?>" width="160px"/> </a> 
  <?php } ?>
  <!-- <span class="tagline">Tag Line goes here</span> -->
  <div class="null_effective">
  <ul class="nav nav-pills ritsude"  data-dropdown-in="fadeInDown" data-dropdown-out="fadeOutUp" id="simnavrit">
    <?php if ($this->session->userdata('user_id')) {
					$user_id = $this->session->userdata('user_id');
					$user_type = $this->session->userdata('user_type');
					$user_data = $this->general_model->get_user_details($user_id,$user_type);
					if($user_type == 4){
						/*$super_user = $this->general_model->get_superuser($user_data->sub_user_id);
						$username = $super_user->user_name .' / '.$user_data->c_p_name;*/
						$username = $user_data->user_name;
					} else {
						$username = $user_data->user_name;
					}
					if($user_data->profile_picture == ''){
						$profile_photo = ASSETS.'images/user-avatar.jpg';
					}else{
						$profile_photo = $user_data->profile_picture;
					}
					$provider = $user_data->user_loggedin_with;
				?>
        <li>
          <div class="" style="padding-top: 29px;"> <span class="amnbalbl">Balance Amount </span> <span class="balncamnt">
        <?php echo $user_data->balance_credit.' '.BASE_CURRENCY_ICON; ?></span> 
          </div>
      </li>
  


    <li id="login_signup" class="dropdown login_after">
      <a href="#" class="topa dropdown-toggle nomargin" data-toggle="dropdown">
      <div class="reglog">
        <div class="userimage user_profimag"><img src="<?php echo WEB_URL;echo "photo/users/".''.$profile_photo;?>" alt=""/>  <span style="margin-left: 5px;" class="userorlogin"><?php echo $username;?></span></div>
      </div>
      </a>
      <ul class="dropdown-menu mysign1" >
       
        <li><a href="<?php echo WEB_URL;?>dashboard/bookings"><i class="fa fa-book"></i><span class="name_currency">Bookings</span></a></li>
         <li><a href="<?php echo WEB_URL;?>dashboard"><i class="fa fa-search"></i> <span class="name_currency">Search</span></a></li>
        <!-- <li><a href="<?php echo WEB_URL;?>dashboard/settings"><i class="fa fa-cog"></i><span class="name_currency">Settings</span></a></li>
        <li><a href="<?php echo WEB_URL;?>dashboard/support_conversation"><i class="fa fa-life-ring"></i><span class="name_currency">Support</span></a></li> -->
        <li class="log_out_li"><?php echo anchor(WEB_URL.'auth/logout/'.$provider.'/'.$user_data->user_id,'Logout');?></li>
      </ul>
    </li>
    <?php  } ?>

    <li class="dropdown sidebtn flagss hide">
                 <a href="#" class="dropdown-toggle topa" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                 <div class="reglognorml">
                    <span class="curncy_img flag flag-<?=$this->curr_val_flag?> flag_sel"></span> 
                    <div class="flags hide"><span class="flag_txt"> <?=$this->display_currency?></span> <b class="caret cartdown"></b> </div>
                 </div>
                 </a>
               <ul class="dropdown-menu mysign1 mysign2 curncyul"> 
               <li> <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Country.." title="Type in a name">
               </li>
               <li id="myUL">
                <ul >
                <?php $currency_info =   $this->general_model->get_currency_info();
                  if(isset($currency_info) && $currency_info !=''){ 
                    for($curr_count=0; $curr_count < 33; $curr_count++) { ?>
                  <?php //echo "<pre/>";print_r($currency_info[$curr_count]);die; ?>
                  <li <?php if($this->display_currency == $currency_info[$curr_count]->currency_code){?>class="selected"<?php }?>> <a href="javascript:void(0)" onClick="ChangeCurrency(this)" data-code="<?php echo $currency_info[$curr_count]->currency_code; ?>" data-icon="<?php echo $currency_info[$curr_count]->currency_symbol; ?>"> <span class="<?php echo 'curncy_img flag flag-'.strtolower($currency_info[$curr_count]->country_code); ?>"></span><span class="name_currency"> <?php echo $currency_info[$curr_count]->currency_code; ?></span> - <span class="side_curency"><?php echo $currency_info[$curr_count]->currency_symbol; ?></span> </a></li>
                <?php }} ?>
                </ul>

                <ul>
                <?php 
                  if(isset($currency_info) && $currency_info !=''){ 
                    for($curr_count=33; $curr_count < 66; $curr_count++) { ?>
                  <?php //echo "<pre/>";print_r($currency_info[$curr_count]);die; ?>
                  <li <?php if($this->display_currency == $currency_info[$curr_count]->currency_code){?>class="selected"<?php }?>> <a href="javascript:void(0)" onClick="ChangeCurrency(this)" data-code="<?php echo $currency_info[$curr_count]->currency_code; ?>" data-icon="<?php echo $currency_info[$curr_count]->currency_symbol; ?>"> <span class="<?php echo 'curncy_img flag flag-'.strtolower($currency_info[$curr_count]->country_code); ?>"></span><span class="name_currency"> <?php echo $currency_info[$curr_count]->currency_code; ?></span> - <span class="side_curency"><?php echo $currency_info[$curr_count]->currency_symbol; ?></span> </a></li>
                <?php }} ?>
                </ul>

                <ul>
                <?php 
                  if(isset($currency_info) && $currency_info !=''){ 
                    for($curr_count=66; $curr_count < 99; $curr_count++) { ?>
                  <?php //echo "<pre/>";print_r($currency_info[$curr_count]);die; ?>
                  <li <?php if($this->display_currency == $currency_info[$curr_count]->currency_code){?>class="selected"<?php }?>> <a href="javascript:void(0)" onClick="ChangeCurrency(this)" data-code="<?php echo $currency_info[$curr_count]->currency_code; ?>" data-icon="<?php echo $currency_info[$curr_count]->currency_symbol; ?>"> <span class="<?php echo 'curncy_img flag flag-'.strtolower($currency_info[$curr_count]->country_code); ?>"></span><span class="name_currency"> <?php echo $currency_info[$curr_count]->currency_code; ?></span> - <span class="side_curency"><?php echo $currency_info[$curr_count]->currency_symbol; ?></span> </a></li>
                <?php }} ?>
                </ul>

                <ul>
                <?php 
                  if(isset($currency_info) && $currency_info !=''){ 
                    for($curr_count=99; $curr_count < 132; $curr_count++) { ?>
                  <?php //echo "<pre/>";print_r($currency_info[$curr_count]);die; ?>
                  <li <?php if($this->display_currency == $currency_info[$curr_count]->currency_code){?>class="selected"<?php }?>> <a href="javascript:void(0)" onClick="ChangeCurrency(this)" data-code="<?php echo $currency_info[$curr_count]->currency_code; ?>" data-icon="<?php echo $currency_info[$curr_count]->currency_symbol; ?>"> <span class="<?php echo 'curncy_img flag flag-'.strtolower($currency_info[$curr_count]->country_code); ?>"></span><span class="name_currency"> <?php echo $currency_info[$curr_count]->currency_code; ?></span> - <span class="side_curency"><?php echo $currency_info[$curr_count]->currency_symbol; ?></span> </a></li>
                <?php }} ?>
                </ul>

                <ul>
                <?php 
                  if(isset($currency_info) && $currency_info !=''){ 
                    for($curr_count=132; $curr_count < 164; $curr_count++) { ?>
                  <?php //echo "<pre/>";print_r($currency_info[$curr_count]);die; ?>
                  <?php if(isset($currency_info[$curr_count])){ ?>
                  <li <?php if($this->display_currency == $currency_info[$curr_count]->currency_code){?>class="selected"<?php }?>> <a href="javascript:void(0)" onClick="ChangeCurrency(this)" data-code="<?php echo $currency_info[$curr_count]->currency_code; ?>" data-icon="<?php echo $currency_info[$curr_count]->currency_symbol; ?>"> <span class="<?php echo 'curncy_img flag flag-'.strtolower($currency_info[$curr_count]->country_code); ?>"></span><span class="name_currency"> <?php echo $currency_info[$curr_count]->currency_code; ?></span> - <span class="side_curency"><?php echo $currency_info[$curr_count]->currency_symbol; ?></span> </a></li>
                <?php } }} ?>
                </ul>

     
         </li>
            </ul>
         </li> 
  
  </ul>
  </div>
</div>
</div>
<?php if($this->session->userdata('user_type')=='1'){ ?>
<script type="text/javascript">
  var WEB_URL = "<?=WEB_URL?>";
</script>
<?php } ?>
<!-- /Navigation -->

<?php $error_data = $this->session->flashdata('error'); 
  if(isset($error_data) && $error_data!='')
  {
	  $error_data_v1 = json_decode($error_data);
  ?>
<div class="error_warning" style="height:90px; background:#FFFFFF">
  <div class="error_caption" ><?php echo $error_data_v1->error_caption; ?></div>
  <div class="error_message"><?php echo $error_data_v1->error_message; ?></div>
</div>
<?php
  }
  ?>
<script type="text/javascript">
function doLogin(data){
	$('#simnavrit #login_signup').remove();
	$('#simnavrit #agent_signup').remove();
	
	$('.wrapofa.login').remove();
	//var login = '<div class="wrapofa"><a href="#" class="topa dropdown-toggle" data-toggle="dropdown"><div class="usrwel"><img src="'+data.profile_photo+'" alt="" /></div>'+data.fname+'<b class="caret"></b></a><ul class="dropdown-menu"><li><a href="<?php echo WEB_URL;?>dashboard">Dashboard</a></li><li><a href="<?php echo WEB_URL;?>dashboard/bookings">Bookings</a></li><li><a href="<?php echo WEB_URL;?>dashboard/settings">Settings</a></li><li><a href="<?php echo WEB_URL;?>dashboard/support_conversation">Support</a></li><li><a href="<?php echo WEB_URL;?>auth/logout/<?php echo PROJECT_NAME; ?>/'+data.rid+'">Logout</a></li></ul></div>';
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
</script>


<script>
$('document').ready(function(){
( function( window ) {

'use strict';

// class helper functions from bonzo https://github.com/ded/bonzo

function classReg( className ) {
  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
}

// classList support for class management
// altho to be fair, the api sucks because it won't accept multiple classes at once
var hasClass, addClass, removeClass;

if ( 'classList' in document.documentElement ) {
  hasClass = function( elem, c ) {
    return elem.classList.contains( c );
  };
  addClass = function( elem, c ) {
    elem.classList.add( c );
  };
  removeClass = function( elem, c ) {
    elem.classList.remove( c );
  };
}
else {
  hasClass = function( elem, c ) {
    return classReg( c ).test( elem.className );
  };
  addClass = function( elem, c ) {
    if ( !hasClass( elem, c ) ) {
      elem.className = elem.className + ' ' + c;
    }
  };
  removeClass = function( elem, c ) {
    elem.className = elem.className.replace( classReg( c ), ' ' );
  };
}

function toggleClass( elem, c ) {
  var fn = hasClass( elem, c ) ? removeClass : addClass;
  fn( elem, c );
}

window.classie = {
  // full names
  hasClass: hasClass,
  addClass: addClass,
  removeClass: removeClass,
  toggleClass: toggleClass,
  // short names
  has: hasClass,
  add: addClass,
  remove: removeClass,
  toggle: toggleClass
};

})( window );


var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
	body = document.body;

showLeft.onclick = function() {
	classie.toggle( this, 'active' );
	classie.toggle( menuLeft, 'cbp-spmenu-open' );
	disableOther( 'showLeft' );
};


function disableOther( button ) {
	if( button !== 'showLeft' ) {
		classie.toggle( showLeft, 'disabled' );
	}
}


$('.navbak').click(function(){
	$('#cbp-spmenu-s1').removeClass('cbp-spmenu-open');
});

});

</script>


<script>
   /* ------------start autologout in idle condition code--------------------------------*/
      var base_url = '<?php echo base_url(); ?>';
      var user_type = '<?php echo $this->session->userdata('user_type'); ?>';
      var idleMax = 15; // Logout after 15 minutes of IDLE
      var idleTime = 0;
        
      var idleInterval = setInterval("timerIncrement()", 60000);  // 1 minute interval    
      $( "body" ).mousemove(function( event ) {
          idleTime = 0; // reset to zero
    });
    
    // count minutes
    function timerIncrement() {
        //var abc = base_url+'auth/logout/tripglobo/';
        idleTime = idleTime + 1;
        if (idleTime > idleMax) { 
            if (user_type) {
                location.href = base_url+'auth/logout/autologout/';
            }
        }
        
    }
   /* ------------end autologout in idle condition code--------------------------------*/ 
</script>
