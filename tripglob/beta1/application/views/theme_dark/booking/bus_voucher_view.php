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
<link href="<?php echo ASSETS; ?>css/voucher.css" rel="stylesheet" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style>




.new_ceneterd{float: none !important;margin:50px auto; display: block; font-family: roboto;  }
.new_voucher_hed{background: #f9f9f9; position: relative; float: left; width: 100%;     padding: 12px 0px;}
.new_voucher_hed img{
    width: 41%;
    position: relative;
    top: -6px;
}
.new_voucher_hed h4{    font-size: 13px;
    text-align: right;
    font-weight: 400;}
.new_voucher_hed hr{margin-top: 5px;
    margin-bottom: 5px;
    border: 0;
    border-top: 1px solid #d8d8d8;}
.new_voucher_hed strong{text-transform: uppercase;}
.new_voucher_hed ul{padding-left: 0px;}
.new_voucher_hed li{list-style: none;
    text-align: right;}


.brd_r{border:1px solid #76e288; padding: 0px !important; font-family: roboto;}
.brd_r h5{    
	margin:0px;
    padding: 15px;
    border-bottom: 1px solid #76e288;
}
.brd_r label{    width: 100%; padding-top:15px;
    float: left;
    font-weight: 500;}
.brd_r span{    width: 100%;
    float: left; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;     padding-bottom: 15px;
    }


    .brd_s{border:1px solid #666; padding: 0px !important; font-family: roboto;}
.brd_s h5{    
	margin:0px;
    padding: 15px;
    border-bottom: 1px solid #666; 
}
.brd_s label{    width: 100%; padding-top:15px;
	text-align: center;
    float: left;
    font-weight: 500;}
.brd_s span{    width: 100%;
	text-align: center;
    float: left; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;     padding-bottom: 15px;
    }



      .brd_sa{border:1px solid #666; padding: 0px !important; font-family: roboto;}
.brd_sa h5{    
	margin:0px;
    padding: 15px;
    border-bottom: 1px solid #666; 
}
.brd_sa h6{    
	margin:0px;
    padding: 15px;
    border-top: 1px solid #666; 
}
.brd_sa label{    width: 100%; padding-top:15px;
	float: left;
    font-weight: 500;}
.brd_sa span{    width: 100%;
	    padding: 5px 15px;
	float: left; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;     padding-bottom: 15px;
    } 
    .new_on{padding:15px   0px !important;}



</style>
<body>
<!-- Navigation --> 
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
<div class="clearfix"></div>


 
<div class="col-md-8 new_ceneterd">
<section class="new_voucher_hed">
   
<div class="col-md-6"><img src="http://provabtech.com/tripglobo/assets/theme_dark/images/logo.png"></div>
<div class="col-md-6">
   <ul>
      <li>Booking Reference : <strong><?php echo $b_data->parent_pnr_no;?></strong></li>
      <li>Booking Date : <strong><?php echo $b_data->travel_date;?></strong></li>
      
   </ul>
</div>
<div class="col-md-12">
   <hr>  
   <h4>status <strong><?php echo $b_data->booking_status;?></strong></h4>
   <hr>
</div> 
<div class="clearfix"> </div>
<div class="col-md-12 " style="float: none; margin: 35px auto;">
<div class="col-md-12 brd_r">
   <?php 
     $cancellationPolicy=json_decode($booking_all_details->response);   
      $cancelData=$cancellationPolicy->GetBookingDetailResult;
      $travelData=$cancelData->Itinerary;
     
  ?>
   <h5>Reservation Ticket (<?php echo $bus_iterna->origin_city;?> To <?php echo $bus_iterna->destination_city;?>)</h5>
   <div class="col-md-4">
      <label>Travel Name</label>
      <span><?php echo $travelData->BusType;?></span>
   </div>
    <div class="col-md-3">
      <label>Ticket Booking</label>
      <span><?php echo $travelData->Origin;?> To <?php echo $travelData->Destination;?></span>
   </div>
    <div class="col-md-2">
      <label>Booking Id</label>
      <span><?php echo $travelData->TicketNo;?></span>
   </div>

 <div class="col-md-3">
      <label>Boarding Pickup Time</label>
      <span><!-- 12-jun-2020 11.00 PM --><?php echo date('Y-m-d h:i:s', strtotime($travelData->DepartureTime));?></span>
   </div>


   </div>

<div class="clearfix">  </div>
<div class="col-md-12 " style="float: none; margin: 35px auto; padding: 0px;">
<div class="col-md-12 brd_s"> 
   <h5>Travel (s) Information</h5>
   <?php 
   $travelInfo=json_decode($booking_all_details->response);   
      $traData=$travelInfo->GetBookingDetailResult;
      $travelallData=$traData->Itinerary;
      //print_r($travelallData->Passenger);
      foreach ($travelallData->Passenger as $vals) {
        

   ?>
   <div class="col-md-2">
      <label>Sr.No</label>
      <span>1</span>
   </div>
    <div class="col-md-6">
      <label>Passenger(s) Name</label>
      <span><?php echo $vals->FirstName;?>  <?php echo $vals->LastName;?></span>
   </div>
    <div class="col-md-2">
      <label>Gender</label>
      <span><?php if($vals->Gender=='2'){ echo 'FEMALE';}else { echo 'MALE';} ?></span>
   </div>

 <div class="col-md-2">
      <label>Seat No</label>
      <span><?php 
      $seat= $vals->Seat;
     echo $seat->SeatName;
      ?></span>
   </div>


   </div>

<?php } ?>
<div class="clearfix">  </div>
<div class="col-md-12 " style="float: none; margin: 35px auto; padding: 0px;">
<div class="col-md-4 brd_sa"> 
<?php 
    $pricedetail=json_decode($bus_iterna->PricingDetails);
?> 
<div class="col-md-6 nopad"><h5>Payment Details</h5></div>
<div class="col-md-6 nopad"><h5 class="new_on">Amout (Rs)</h5></div>
   
<div class="col-md-12 nopad">
<div class="col-md-6 nopad"><span>base fare</span></div>   
<div class="col-md-6 nopad"><span><?php echo $bus_transaction->total_amount;?></span></div>   
  <div class="col-md-6 nopad"><span>gst</span></div>   
  <div class="col-md-6 nopad"><span>0</span></div>   

  <div class="col-md-6 nopad"><span>discount</span></div>   
  <div class="col-md-6 nopad"><span><?php echo $pricedetail->Discount;?></span></div>   

 <div class="col-md-6 nopad"><h6>Total Fare</h6></div>   
 <div class="col-md-6 nopad"><h6><?php
   echo $total_amount=$bus_transaction->total_amount+$gst->IGSTRate;+$pricedetail->Discount;

 ?></h6></div>   
  

   </div>
  


   </div>
<div class="col-md-1"> </div>
   <div class="col-md-7 brd_sa">  
   <div class="col-md-12 nopad"><h5>Cancellation Policy</h5></div>
   
   <div class="col-md-12 nopad">
  <div class="col-md-8 nopad"><span>Cancellation Time</span></div>   
  <div class="col-md-4 nopad"><span>Cancellation Charges</span></div>   
  <?php 
     $cancellationPolicy=json_decode($booking_all_details->response);
      //echo "<pre>";print_r($cancellationPolicy->GetBookingDetailResult);
      $cancelData=$cancellationPolicy->GetBookingDetailResult;
      $cancelPolicy=$cancelData->Itinerary;
      foreach ($cancelPolicy->CancelPolicy as $cancelDataVal) {
       
     
  ?>

  <div class="col-md-8 nopad"><span><?= $cancelDataVal->PolicyString;?></span></div>   
  <div class="col-md-4 nopad"><span><?= $cancelDataVal->CancellationCharge;?></span></div>   

 
  <?php } ?>

   </div>
  


   </div>


<div class="clearfix">  </div>
<div class="col-md-12 " style="float: none; margin: 35px auto; padding: 0px;">
<div class="col-md-12 brd_sa">  
   <div class="col-md-6 nopad"><h5>Payment Type</h5></div>
   <div class="col-md-6 nopad"><h5 class="new_on">Amout (Rs)</h5></div>
   
   <div class="col-md-12 nopad">
  <div class="col-md-6 nopad"><span>pay throught payment gateway</span></div>   
  <div class="col-md-6 nopad"><span><?php
   echo $total_amount=$bus_transaction->total_amount+$gst->IGSTRate;+$pricedetail->Discount;
 ?></span></div>   
  

 <div class="col-md-6 nopad"><h6>Grand Fare</h6></div>   
 <div class="col-md-6 nopad"><h6><?php
   echo $total_amount=$bus_transaction->total_amount+$gst->IGSTRate;+$pricedetail->Discount;
 ?></h6></div>   
  

   </div>
  


   </div>
</div>

</div>
</section>
</div>

<div class="clearfix"></div>


<!-- Page Content --> 
<div class="clearfix"></div>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>

<!-- Script to Activate the Carousel -->

<style>
.leftflitmg { max-width:70px !important } 
</style>


<script type="text/javascript">
$(document).ready(function() {
    $(".tooltipv").tooltip();
});

function PrintDiv() {  
   var voucher = document.getElementById('voucher');
   var popupWin = window.open('', '_blank', 'width=600,height=600');
   popupWin.document.open();
   popupWin.document.write('<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1" /><meta name="description" content=""><meta name="author" content=""><link href="<?php echo ASSETS;?>css/bootstrap.min.css" rel="stylesheet" media="screen,print"><link href="<?php echo ASSETS;?>css/temp.css" rel="stylesheet" media="screen,print"><link href="<?php echo ASSETS;?>css/voucher.css" rel="stylesheet" media="screen,print"><style>@page {size: A4;margin: 0;}@media print {html, body {width: 210mm;height: 297mm;} .none_print{display: none !important;} .tablebg{background-color: #f1f1f1 !important; -webkit-print-color-adjust: exact; }}</style></head><body onload="window.print()">' + voucher.innerHTML + '</html>');
  popupWin.document.close();
}
</script>
</body>
</html>
