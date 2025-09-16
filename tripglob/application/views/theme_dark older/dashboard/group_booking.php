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
<style type="text/css">
  .row-new{
    margin:0px -15px; 
  }


</style>
</head>
<body>

<!-- Navigation --> 
<?php 

if($this->session->userdata('user_type')=='1' || $this->session->userdata('user_type')=='4'){
  echo $this->load->view(PROJECT_THEME.'/common/header');
}else{
  echo $this->load->view(PROJECT_THEME.'/new_theme/header'); 
}

?>
<div class="clearfix"></div>

<!-- Messages -->
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
<!-- Messages End--> 
<!-- top image-->
<div class="dash-img"> 
</div>
<div class="container">
<div class="dashboard_section">

<div class="col-md-12 nopad">
<!--sidebar start-->
<aside class="aside col-md-12 new_tab "> <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?> </aside>
<!--sidebar end--> 

<!--main content start-->
<section id="main-content" class="col-md-12 tab_sty HH nopad">
  <section class="wrapper">
    <div class="col-lg-12 cent-block main-chart">
        
    <div class="clearfix"></div>
    
    
      <div class="main_top">

        <h3 class="dashed">Welcome  To <?php echo PROJECT_TITLE; ?></h3>
        <div class="indashrow"> <span class="onlysent"> <?php echo PROJECT_TITLE; ?> brings the world closer to you. Go ahead and explore the largest range of destinations and properties, hotels with the world's leading online travel company. </span> </div>
      </div>
      <div class="clearfix"></div>
      <!-- <div class="top_booking_info">
      <div class="row">
        <a class="col-md-4 col-sm-4 box_main violet" href="<?php echo WEB_URL; ?>dashboard/bookings/<?php echo base64_encode(json_encode('Flight')); ?>">
          <div class="box_in">
            <div class="box-icon"> <span class="fa fa-plane"></span></div>
            <div class="box-text">
              <h3><?php echo $flight_bookings->cnt; ?></h3>
            
            <span class="">Flights Booked</span> 
            </div>
           </div>
        </a>
        <a class="col-md-4 col-sm-4 box_main orange" href="<?php echo WEB_URL; ?>dashboard/bookings/<?php echo base64_encode(json_encode('Hotel')); ?>">
              <div class="box_in"> 
              <div class="box-icon">
                <span class="fa fa-bed"></span>
              </div>

              <div class="box-text">
              <h3><?php echo $hotel_bookings->cnt; ?></h3>
            
            <span class="">Hotels Booked</span> 
            </div>
            </div>
        </a>
         <a class="col-sm-4 col-md-4 box_main pink" href="<?php echo WEB_URL; ?>dashboard/bookings/<?php echo base64_encode(json_encode('Car')); ?>">
          <div class="box_in">
            <div class="box-icon"> <span class="fa fa-car"></span>
            </div>
            <div class="box-text">
              <h3><?php echo $car_count->cnt; ?></h3>
            
            <span class=""><strong>Car</strong> booked</span> </div>
            </div>
        </a> 
        </div>
         
      
      
   
    </div> -->
     <?php if($userInfo->user_type_name == 'B2B'){?>
      <link href="<?php echo ASSETS; ?>css/b2b_dashboard.css" rel="stylesheet" />
    
    <?php echo $this->load->view(PROJECT_THEME.'/new_theme/agent_search_tab_groupbooking'); ?>
    
    <?php }?>
    <!-- *** RIGHT SIDEBAR CONTENT ********* -->
    
    <!--<div class="col-lg-3 hide right_side_dash">
      <div class="dash_inside">
        <?php 
                  if($userInfo->user_type_name == 'B2B')
                  {
                      ?>
        <div class="sidewiserow">
          <h3 class="sidewisehed">Accounts</h3>
          <div class="rogntr">
            <div class="col-xs-6 detdt">Last Deposit</div>
            <div class="col-xs-6 detdt idagnt coloramnt"><?php echo BASE_CURRENCY_ICON.' '.$userInfo->last_credit; ?></div>
          </div>
          <div class="rogntr">
            <div class="col-xs-6 detdt">Balance</div>
            <div class="col-xs-6 detdt idagnt coloramnt"><?php echo BASE_CURRENCY_ICON.' '.$userInfo->balance_credit; ?></div>
          </div>
          <div class="rogntr">
            <div class="col-xs-12 detdt"> <span class="fa fa-money"></span> <a href="<?php echo WEB_URL;?>dashboard/account_statement">&nbsp;&nbsp;Account Statement</a> </div>
          </div>
          <div class="rogntr">
            <div class="col-xs-12 detdt"> <span class="fa fa-thumb-tack"></span> <a href="<?php echo WEB_URL;?>dashboard/booking_statement">&nbsp;&nbsp;Booking Statement</a> </div>
          </div>
          <div class="rogntr">
            <div class="col-xs-12 detdt "> <span class="fa fa-pie-chart"></span> <a href="<?php echo WEB_URL;?>dashboard/profit_matrix">&nbsp;&nbsp;profit Matrix</a> </div>
          </div>
        </div>
        
        <div class="clearfix"></div>
        
        <div class="sidewiserow">
          <h3 class="sidewisehed">Notice</h3>
          
          <?php if($notices != ''){ $n=0; 
        
         
        foreach($notices as $notice){ if($n < 2){ ?>
          
           <div class="rogntr">
          <a>
            <div class="notice_icon fa fa-bell-o"></div>
            <div class="notice_msg">
              <?php echo $notice->notice_content; ?>
                <p>18.March.2016</p>
            </div>
          </a>
          <?php if($n == 1){ ?>
          <a class="all_view_notice">View all</a>
          <?php } ?>
          </div>
          <?php }  $n++; } } ?>
          
          
          
        </div>
        
        
        <?php
                  }
                  ?>
         <?php 
                  if($userInfo->user_type_name != 'B2B')
                  {
                      ?>
        <div class="clearfix"></div>
        <div class="sidewiserow">
          <h3 class="sidewisehed">Quick Links</h3>
          <ul class="qlinkul">
            <li class="qlink"><a href="<?php echo WEB_URL; ?>dashboard/profile">View Profile</a></li>
            <li class="qlink"><a href="<?php echo WEB_URL; ?>dashboard/edit_profile">Edit Profile</a></li>
            <li class="qlink"><a href="<?php echo WEB_URL; ?>dashboard/change_pwd">Change Password</a></li>
             <li class="qlink"><a href="<?php echo WEB_URL; ?>dashboard/support_conversation">Support Ticket</a></li> 
            <li class="qlink"><a href="<?php echo WEB_URL; ?>dashboard/cancel_account">Close Account</a></li>
          </ul>
        </div>
        <?php
          }
        ?>
      </div>
    </div>-->
      <!--<div class="clearfix"></div>
        <?php 
                  if($userInfo->user_type_name == 'B2B')
                  {
            
                      ?>
              <div class="col-lg-12 main-chart" id="get_overall_reports">
       

    </div>
            <script>
             $(document).ready(function () {
  $.ajax({
      type:'GET', 
   
      url: '<?php echo WEB_URL;?>dashboard/get_overall_reports',
      beforeSend: function(XMLHttpRequest){
    
      }, 
      success: function(response) {
      
        $("#get_overall_reports").html(response);
      
      }
    });
   });
</script>


         <?php
          }
          ?>-->
  </section>
</section>
</div>
</div>
</div>
<!--main content end--> 

<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/footer'); ?> 
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>
</body>
</html>


 
    
