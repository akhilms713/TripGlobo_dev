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
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/dataTables.tableTools.css">
<link href="<?php echo ASSETS; ?>css/toggle-switch.css" rel="stylesheet" media="screen">
<link href="<?php echo ASSETS; ?>css/flight_result.css" rel="stylesheet">
<script src="<?php echo ASSETS; ?>js/jquery.dataTables.js"></script>
<script src="<?php echo ASSETS; ?>js/dataTables.tableTools.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
         .box_main .box-icon{
      width: 80px;
    height: 80px;
    display: inline-block;
    float: left;
 } 
  .box_main .box-icon span{
        line-height: 80px;
    padding: 0px;
    color: #fff;
    font-size: 50px;
  }
  .box_main .box-text{
  width: calc(100% - 80px);
  display: inline-block;
  float: left;
  padding-left: 15px;
 } 
 .box_main .box-text h3, .box_main .box-text span{
  color:#fff;
 }

 .box_main .box-text h3{
      margin: 12px 0px 6px 0px;
    padding: 0px;
    text-align: left;
    font-size: 30px;

 }
  .box_main .box-text span{
        text-align: left !important;
    font-size: 17px !important;
    line-height: 25px !important;
  }
  .violet .box_in{
    background: #fdb813;
  }
  .violet .box-icon{
  background: #203f7c; 
  }
  .pink .box_in{
    background: #444444;
  }
  .pink .box-icon{
  background: #bb1c65;
  }
  .orange .box_in{
    background: #444444;
  }
  .orange .box-icon{
  background: #e0790c;
  }
  #BookingList.rowit{
    margin-bottom: 20px;
  }
    </style>
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
        <!--sidebar end-->



<!--main content start-->
<section id="main-content" class="col-md-12 tab_sty nopad dash-allbok">
<section class="wrapper">
<h3 class="lineth">My Bookings</h3>

<div class="main-chart">


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
<div class="cancel_loader"><div id="mainDiv"><div class="carttoloadr"><strong>Please Wait...Cancellation process is going on!!..</strong></div></div>

<div class="col-md-12">
<!-- 
<div class="col-md-3 custom-nav side-nav ">
  <ul>
  <li id="all"><a href="<?php echo WEB_URL; ?>dashboard/bookings" class="<?php echo $staus_bookings; ?> "> <i class="fal fa-ticket "></i> All Bookingsss</a></li>
   <li id="Flight">
    <a href="<?php echo WEB_URL; ?>dashboard/bookings/<?php echo base64_encode(json_encode('Flight')); ?>"><i class="fal fa-plane"></i> Flight</a>
  </li>
  </ul>
</div> -->

<div class="col-md-12 nopad">
<div class="rowit" id="BookingList">
	<?php $flight_count=0; $hotel_count=0;$bus_count=0;
      // debug($module);exit();
		if(count($getoverallBookings) >0){
				for($k=0;$k<count($getoverallBookings);$k++){ 
					if($getoverallBookings[$k]->product_name == 'FLIGHT'){
						$flight_count += 1; 
					}
          if($getoverallBookings[$k]->product_name == 'HOTEL'){
            $hotel_count += 1; 
          }
           if($getoverallBookings[$k]->product_name == 'BUS'){
            $bus_count += 1; 
          }
					
					$all_count += 1;
			} } ?> 
<?php if($module == ''){ ?>

<div class="top_booking_info">
        <a class="col-sm-4 col-md-4 box_main violet" href="<?php echo WEB_URL; ?>dashboard/bookings/<?php echo base64_encode(json_encode('Flight')); ?>">
          <div class="box_in">
            <div class="box-icon"> <span class="fa fa-plane"></span></div>
              <div class="box-text">
              <h3><?php echo $flight_count; ?></h3>
              <span class="">Flights Booked</span> 
            </div>
          </div>
        </a>
      </div>
      <div class="top_booking_info">
        <a class="col-sm-4 col-md-4 box_main violet" href="<?php echo WEB_URL; ?>dashboard/bookings/<?php echo base64_encode(json_encode('Hotel')); ?>">
          <div class="box_in">
            <div class="box-icon"> <span class="fa fa-hotel"></span></div>
              <div class="box-text">
              <h3><?php echo $hotel_count; ?></h3>
              <span class="">Hotel Booked</span> 
            </div>
          </div>
        </a>
      </div>
      <div class="top_booking_info">
        <a class="col-sm-4 col-md-4 box_main violet" href="<?php echo WEB_URL; ?>dashboard/bookings/<?php echo base64_encode(json_encode('Bus')); ?>">
          <div class="box_in">
            <div class="box-icon"> <span class="fa fa-bus"></span></div>
              <div class="box-text">
              <h3><?php echo $bus_count; ?></h3>
              <span class="">Bus Booked</span> 
            </div>
          </div>
        </a>
      </div>
      <?php //echo $this->session->userdata('user_type');die; ?>
     <!--  <?php 
            if($this->session->userdata('user_type') == 1){

            $this->load->view(PROJECT_THEME.'/dashboard/overall_graph_reports');
            }
      ?> -->
<?php } else { ?>


  <div class="bookings_only booking-intab">
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Previous Bookings</a></li>
      <!-- <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Current Bookings</a></li> -->
    </ul>
  <div class="tab-content  booking-inertab">
    <div role="tabpanel" class="tab-pane active" id="home">

      <!-- previous booking star here -->
      <?php //debug($module);die;
      if($module == 'Flight'){ 
      // echo $flight_count;die;                    
            if($flight_count > 0){
            if ($user_type == 1) { ?>
              <div class="table-responsive" style="width: 100%;overflow-x: scroll;">
                <table class="table table-bordered" id="flight_report_pre">
                 <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Confirmation No.</th>
                      <th>Pnr</th>
                      <th>Status</th>
                      <th>Airline</th>
                      <th>Lead Pax</th>
                      <th>Origin</th>
                      <th>Destination</th>
                      <th>Departure Date</th>
                      <th>Return Date</th>
                      <th>Trip Type</th>
                      <th>Net Price</th>
                      <th>Agent Markup</th>
                      <th>Total</th>
                      <th>Action</th>
                    </tr>
                 </thead>
                  <tbody>
                    <?php $bokk_sno = 1 ?>
                    <?php for($k=0;$k<count($getoverallBookings);$k++){

                      // debug($result);die; 
                                                 
                    if($getoverallBookings[$k]->product_name == 'FLIGHT'){

                      $result = $this->account_model->getBookingbyPnr($getoverallBookings[$k]->parent_pnr_no,$getoverallBookings[$k]->product_name)->row();  
                      $booking_transaction = $this->account_model->booking_transaction_data($getoverallBookings[$k]->booking_transaction_id);
                      $search_data=json_decode($result->request_scenario);
                      // debug($search_data);exit();
                      $segment_data=$outward_segments = json_decode($result->segment_data);
                      $passengers = $this->account_model->get_passengersbypnr($result->booking_global_id)->result(); 
                      // echo "<pre/>"; print_r($result);die;

                   $outward_departure_info = strtotime(date('y-m-d', strtotime($result->outward_departure)));
                  if($result->api_name == 'SABRE'){
                  	$outward_departure_info = strtotime(date('y-m-d', strtotime($result->outward_departure)));
                  }
                    $current_datetime_info =strtotime(date('Y-m-d'));
                    $prev_book = 0;
                    
                    // if($outward_departure_info < $current_datetime_info) {
                    if($outward_departure_info < $current_datetime_info) {
                       $prev_book = 1;
                     
                      ?>
                      <tr class="">
                        <td><?=($bokk_sno)?></td>
                        <td><?php echo $result->con_pnr_no; ?></td>
                        <td><?php echo $result->pnr_no; ?></td>
                        <td><?php if($result->booking_status=="FAILED" || $result->booking_status=="PROCESS" || $result->pnr_no == "") {?>
                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success-->
                        <span style="color:red;">FAILED</span> 
                        <!--  <?php echo $result->booking_status; ?>  -->
                        </div>
                        <?php } else {?>
                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success-->CONFIRMED 
                           <!--  <?php echo $result->booking_status; ?>  -->
                        </div> <?php }?></td>
                        <td><?php echo $result->airline; ?></td>
                        <td><?php echo $passengers[0]->first_name.' '.$passengers[0]->last_name; ?></td>
                          <?php if($result->api_name == 'SABRE'){ 
                                $des_count = count($segment_data[0]->Destination) - 1;
                          ?>
                              <td><?php echo $segment_data[0]->Origin[0]; ?></td>
                              <td><?php echo $segment_data[0]->Destination[$des_count]; ?></td>
                              <td><?php echo date('M \. d Y', strtotime($segment_data[0]->DepartureDateTime_r[0])); ?></td>
                              <?php } else {?>
                              <td><?php echo $result->origin_city; ?></td>
                              <td><?php echo $result->destination_city; ?></td>
                              <td><?php echo date('M \. d Y', strtotime($search_data->depart_date)); ?></td>
                              <?php } ?>
                        
                        <td><?php if($result->mode == "ROUNDTRIP"){ echo date('M \. d Y', strtotime($search_data->return_date));} ?></td>
                        <td><?php echo $result->mode; ?></td>
                        <td><?php echo BASE_CURRENCY_ICON.' '. ($booking_transaction['total_amount']-($booking_transaction['agent_markup']+$booking_transaction['discount'])); ?></td>
                        <td><?php echo BASE_CURRENCY_ICON.' '.number_format($booking_transaction['agent_markup']+$booking_transaction['discount'], 2); ?></td>
                        <td><?php echo BASE_CURRENCY_ICON.' '.number_format($booking_transaction['total_amount'], 2); ?></td>
                        <td>
                        <div class="col-md-12 dasflight-btn">
                                      <div class="btns_bkd">
                        <?php if($result->pnr_no !='' && $result->booking_status == 'CONFIRMED') { ?>
                         <a href="<?php echo WEB_URL; ?>voucher/<?php echo base64_encode(base64_encode($result->booking_global_id)); ?>/<?php echo base64_encode(base64_encode($result->product_id)); ?>" target="_blank" class="btn view_voucher_btn pull-right">View voucher</a>
                    <a href="<?php echo WEB_URL; ?>invoice/<?php echo base64_encode(base64_encode($result->booking_global_id)); ?>/<?php echo base64_encode(base64_encode($result->product_id)); ?>" target="_blank" class="btn view_invoice_btn pull-right">View Invoice</a>
                    <!--<a href="<?php echo WEB_URL; ?>voucher/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank" class="btn send_voucher_email_btn" onclick="sendVoucherMail_flight('<?php echo $result->pnr_no; ?>')">SEND MAIL</a>-->
                    <a href="#" class="btn send_voucher_email_btn" onclick="sendVoucherMail_flight('<?php echo $result->pnr_no; ?>',<?=$result->product_id?>,<?=$result->booking_global_id?>)">SEND MAIL</a>
                         <?php
                            }
                            ?>

                        </div>
                        </div>
                        </td>
                      </tr>
                       <!--  </div> -->
                        <?php $bokk_sno++; ?>
                          <?php }} }?>
                  </tbody>
                </table>
              </div>
              <script>
                $(document).ready(function () {
                var oTable = $('#flight_report_pre').dataTable({
                "oLanguage": {
                    "sSearch": "Search all columns:"
                },
                "aoColumnDefs": [
                {
                    'bSortable': false,
                    'aTargets': [0]
                        } //disables sorting for column one
                        ],
                        'iDisplayLength': 10,
                        "sPaginationType": "full_numbers",
                        "dom": 'T<"clear">lfrtip',
                        "tableTools": {
                            "sSwfPath": "<?php echo base_url('assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                        }
                    });
                });
              </script>
              <?php } 
              else {
               
            
              for($k=0;$k<count($getoverallBookings);$k++){ 
              // debug($getoverallBookings);die;                               
                if($getoverallBookings[$k]->product_name == 'FLIGHT') {
                  $result = $this->account_model->getBookingbyPnr($getoverallBookings[$k]->parent_pnr_no,$getoverallBookings[$k]->product_name)->result();   

                  ?>
                  <div class="booking_rows">
                  <div class="mension_booktype">
                      <span class="fa fa-plane"></span>
                  </div>
                  <div class="inside_bookrow">
                  <?php
                  foreach ($result as $key_r => $result) {
                    // debug(json_decode($result->request_scenario,1)['depart_date']);exit();
                  $segment_data=$outward_segments = json_decode($result->segment_data);
                  $passengers = $this->account_model->get_passengersbypnr($result->booking_global_id)->result();
                  $booking_transaction = $this->account_model->booking_transaction_data($getoverallBookings[$k]->booking_transaction_id);
                   $search_data=json_decode($result->request_scenario);
                  // debug($result);exit();
                  if($result->api_name == 'SABRE'){
                  	$outward_departure_info = strtotime(date('y-m-d', strtotime($result->outward_departure)));
                  }
                    $current_datetime_info =strtotime(date('Y-m-d'));
                    $prev_book = 0;
                    
                  if (empty($result->outward_departure)) {
                  $outward_departure_info1 = json_decode($result->request_scenario,1)['depart_date'];
                    
                  }else{

                  $outward_departure_info1 = $result->outward_departure;
                  }
                    if($outward_departure_info < $current_datetime_info) {

                ?>

                
                    <div class="from_to_all">
                    <?php if($result->api_name == 'SABRE'){ ?>
                    <div class="left_city"><?php echo $segment_data[0]->Origin[0]; ?><span class="fa fa-long-arrow-right"></span><?php echo $segment_data[0]->Destination[$des_count]; ?> </div><div class="travel_date"><?php echo date('M \. d Y', strtotime($segment_data[0]->DepartureDateTime_r[0])); ?></div>
                    <?php } else{ 
                      if ($key_r==1) {?>
                         <div class="left_city"><?php echo $result->destination_city; ?><span class="fa fa-long-arrow-right"></span><?php echo $result->origin_city; ?> </div><div class="travel_date"><?php echo date('M \. d Y', strtotime($outward_departure_info1)); ?></div>
                      <?php }else{?>

                    <div class="left_city"><?php echo $result->origin_city; ?><span class="fa fa-long-arrow-right"></span><?php echo $result->destination_city; ?> </div><div class="travel_date"><?php echo date('M \. d Y', strtotime($outward_departure_info1)); ?></div>
                      <?php }
                      ?>
                        
                    <?php } ?>
                        
                        
                      <!--   <div class="book_status <?php if($result->booking_status == 'FAILED') { echo 'bkd_failed'; } else if($result->booking_status == 'CONFIRMED' || $result->booking_status == 'SUCCESS'){ echo 'bkd_success'; } else echo 'bkd_canceld'; ?>">
                          <?php echo $result->booking_status; ?>
                        </div> -->
                         <?php if($result->booking_status=="FAILED" || $result->booking_status=="PROCESS" || $result->pnr_no == "") {?>
                                            <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success--><span style="color:red;">FAILED</span> 
                                               <!--  <?php echo $result->booking_status; ?>  -->
                                            </div>
                                            <?php } else {?>
                                            <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success-->CONFIRMED 
                                               <!--  <?php echo $result->booking_status; ?>  -->
                                            </div> <?php }?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-8 nopad">

                         <div class="row_books">
                            <div class="col-sm-4 nopad">
                                <div class="labl_books">Pnr No.</div>
                            </div>
                            <div class="col-sm-8 nopad">
                                <div class="labl_books bold_lbl"><?php echo $result->pnr_no; ?></div>
                            </div>
                        </div>

                        <div class="row_books">
                            <div class="col-sm-4 nopad">
                                <div class="labl_books">Conformation No.</div>
                            </div>
                            <div class="col-sm-8 nopad">
                                <div class="labl_books bold_lbl"><?php echo $result->con_pnr_no; ?></div>
                            </div>
                        </div>
                        <div class="row_books">
                            <div class="col-sm-4 nopad">
                                <div class="labl_books">Lead Passenger</div>
                            </div>
                            <div class="col-sm-8 nopad">
                                <div class="labl_books bold_lbl"><?php echo $passengers[0]->first_name.' '.$passengers[0]->last_name; ?></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <!-- <a class="view_bokd_dets" data-toggle="modal" onclick="show_booking_data('<?php echo $result->pnr_no; ?>', 'FLIGHT', 'itenerary')"  data-target="#booked_fligt_detail">View details</a> -->
                    </div>
                    <div class="col-sm-4 nopad">
                      <div class="side_details">
                          <div class="price_booked">
                              <div class="bokd_price"><?php echo BASE_CURRENCY_ICON.' '.number_format($booking_transaction['total_amount'], 2); ?></div>

                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-12 dasflight-btn">
                    <div class="btns_bkd">
                    <?php if($result->pnr_no !='' && $result->booking_status == 'CONFIRMED') { ?>
                    <a href="<?php echo WEB_URL; ?>voucher/<?php echo base64_encode(base64_encode($result->booking_global_id)); ?>/<?php echo base64_encode(base64_encode($result->product_id)); ?>" target="_blank" class="btn view_voucher_btn pull-right">View voucher</a>
                    <a href="<?php echo WEB_URL; ?>invoice/<?php echo base64_encode(base64_encode($result->booking_global_id)); ?>/<?php echo base64_encode(base64_encode($result->product_id)); ?>" target="_blank" class="btn view_invoice_btn pull-right">View Invoice</a>
                    <!--<a href="<?php echo WEB_URL; ?>voucher/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank" class="btn send_voucher_email_btn" onclick="sendVoucherMail_flight('<?php echo $result->pnr_no; ?>')">SEND MAIL</a>-->
                    <a href="#" class="btn send_voucher_email_btn" onclick="sendVoucherMail_flight('<?php echo $result->pnr_no; ?>',<?=$result->product_id?>,<?=$result->booking_global_id?>)">SEND MAIL</a>
                    <?php
                    }
                    ?>

                    </div>
            <?php } }?> 
                  </div>
                </div>
          <?php }}
           } 
          } 
         else { ?>
            <!-- <div class="col-md-12" style="margin: 0 auto; text-align: center;">
                <div class="srywrap"><span class="sorrydiv"><img src="<?php echo ASSETS; ?>images/sorry.png" alt="" /><h4 class="stepshed">No Flight Bookings Found!</h4></span></div>
            </div>  -->
            <?php } } ?>
        <!-- </div> -->
  
      


      <!-- Hotel -->
      <?php //debug($module);die;
      if($module == 'Hotel'){                     
            if($hotel_count > 0){
            if ($user_type == 1) { ?>
              <div class="table-responsive" style="width: 100%;overflow-x: scroll;">
                <table class="table table-bordered" id="hotel_report_pre">
                 <thead>
                    <tr>
                     <tr>
                      <th>S.No.</th>
                      <th>App Reference</th>
                      <th>Status</th>
                      <th>Lead Pax Name</th>
                      <th>PNR</th>
                      <th>Hotel Name</th>
                      <th>no Of Room</th>
                      <th>City</th>
                      <th>CheckIn Date</th>
                      <th>Checkout Date</th>
                      <th>Net Price</th>
                      <th>Agent Markup</th>
                      <th>Total </th>
                      <th>Action</th>
                    </tr>
                 </thead>
                  <tbody>
                    <?php $hsno = 1 ?>

                    <?php for($k=0;$k<count($getoverallBookings);$k++){
                    // debug($getoverallBookings);exit();                                
                    if($getoverallBookings[$k]->product_name == 'HOTEL'){

                      $result = $this->account_model->getBookingbyPnr($getoverallBookings[$k]->parent_pnr_no,$getoverallBookings[$k]->product_name)->row();   
                      $hoteldata=$this->account_model->get_hoteldatainfo_new($getoverallBookings[$k]->parent_pnr_no);
                  // debug(json_decode(base64_decode($hoteldata['hotel_details']),1)['HotelName']);exit();  
                  $search_data=json_decode(base64_decode($hoteldata['hotel_details']),1)['request'];
                  $search_data=json_decode(base64_decode(unserialize($search_data)));
                       $passengers = $this->account_model->get_passengersbypnr($result->booking_global_id)->result();
                        // $hoteldata = $this->account_model->get_hoteldatainfo($result->hotel_code); 
                     // debug($search_data);exit();

                         $date = new DateTime($result->check_in);
                          $now = new DateTime();
                          $prev_book = 0;
                          $outward_departure_info = strtotime(date('y-m-d', strtotime($result->check_in)));
                          $current_datetime_info =strtotime(date('Y-m-d'));
                          if($outward_departure_info < $current_datetime_info) {
                             $prev_book = 1;
                          
                      
                      ?>
                      <tr class="">
                <td><?=$hsno?></td>
                <td><?php echo $result->con_pnr_no; ?></td>
                <td>
                   <?php if($result->booking_status=="FAILED" || $result->booking_status=="PROCESS") {?>
                                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success--><span style="color:red;">FAILED</span> 
                                           <!--  <?php echo $result->booking_status; ?>  -->
                                        </div>
                                        <?php } else {?>
                                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success-->CONFIRMED 
                                           <!--  <?php echo $result->booking_status; ?>  -->
                                        </div> <?php }?>
                </td>
                <td><?php echo $passengers[0]->first_name.' '.$passengers[0]->last_name; ?></td>
                <td><?php echo $result->pnr_no; ?></td>
                <td><?=json_decode(base64_decode($hoteldata['hotel_details']),1)['HotelName']?></td>
                <td><?php echo $search_data->rooms; ?></td>
                <td><?php echo $search_data->city; ?></td>
                <td><?php echo date('M \. d Y', strtotime($search_data->hotel_checkin)) ?></td>
                <td><?php echo date('M \. d Y', strtotime($search_data->hotel_checkout)) ?></td>
                <td><?php echo BASE_CURRENCY_ICON.' '.($hoteldata['total_cost']-($hoteldata['agent_markup']+$hoteldata['discount'])); ?> </td>
                <td><?php echo BASE_CURRENCY_ICON.' '. ($hoteldata['agent_markup']+$hoteldata['discount']); ?></td>
                <td><?php echo BASE_CURRENCY_ICON.' '. number_format(($hoteldata['total_cost']), 2); ?></td>
                <td>
                 
                
                               <?php if($result->pnr_no !='' && $result->booking_status == 'CONFIRMED') { ?>
                              <a href="<?php echo WEB_URL; ?>voucher/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank"><button class="btn btn-primary">View voucher</button></a>
                                <a href="<?php echo WEB_URL; ?>invoice/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank"><button class="btn btn-info">View Invoice</button></a>
                                <button class="btn btn-primary" onclick="sendVoucherMail_flight('<?php echo $result->pnr_no; ?>')">SEND MAIL</button><?php }?>
                        
                </td>
              </tr>
                       <!--  </div> -->
                        <?php $hsno++; ?>
                          <?php }}}?>
                  </tbody>
                </table>
              </div>
              <script>
                $(document).ready(function () {
            var oTable = $('#hotel_report_pre').dataTable({
                "oLanguage": {
                    "sSearch": "Search all columns:"
                },
                "aoColumnDefs": [
                {
                    'bSortable': false,
                    'aTargets': [0]
                        } //disables sorting for column one
                        ],
                        'iDisplayLength': 10,
                        "sPaginationType": "full_numbers",
                        "dom": 'T<"clear">lfrtip',
                        "tableTools": {
                            "sSwfPath": "<?php echo base_url('assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                        }
                    });
        });
              </script>
              <?php } 
              else {
               
            
              for($k=0;$k<count($getoverallBookings);$k++){                                
                if($getoverallBookings[$k]->product_name == 'HOTEL') {
                  $result = $this->account_model->getBookingbyPnr($getoverallBookings[$k]->parent_pnr_no,$getoverallBookings[$k]->product_name)->row(); 
                  $hoteldata=$this->account_model->get_hoteldatainfo_new($getoverallBookings[$k]->parent_pnr_no);
                  // debug($hoteldata['total_cost']);exit();  
                  $search_data=json_decode(base64_decode($hoteldata['hotel_details']),1)['request'];
                  $search_data=json_decode(base64_decode(unserialize($search_data)));
                  $segment_data=$outward_segments = json_decode($result->segment_data);
                  $passengers = $this->account_model->get_passengersbypnr($result->booking_global_id)->result();
                  // debug($search_data);die;
                    //         echo "<pre>"; print_r($getoverallBookings[$k]); echo "</pre>"; die();
                  $outward_departure_info = strtotime(date('y-m-d', strtotime($search_data->check_in)));
                          $current_datetime_info =strtotime(date('Y-m-d'));
                          if($outward_departure_info < $current_datetime_info) {

                ?>

                <div class="booking_rows">
                  <div class="mension_booktype">
                      <span class="fa fa-bed"></span>
                  </div>
                  <div class="inside_bookrow">
                    <div class="from_to_all">
                        <?php if($result->api_name == "Sabre"){ ?>
                        <div class="left_city"><?php echo $result->city; ?><span class="fa fa-long-arrow-right"></span><?php echo $hoteldata->city; ?> </div><div class="travel_date"><?php echo date('M \. d Y', strtotime($result->check_in)).' - '.date('M \. d Y', strtotime($result->check_out)); ?></div>
                        <?php } else { ?>
                        <div class="left_city"><?php echo $search_data->origin_city; ?><span class="fa fa-long-arrow-right"></span><?php echo $hoteldata->city; ?> </div><div class="travel_date"><?php echo date('M \. d Y', strtotime($search_data->hotel_checkin)).' - '.date('M \. d Y', strtotime($search_data->hotel_checkout)); ?></div>
                        <?php } ?>
                        
                      <!--   <div class="book_status <?php if($result->booking_status == 'FAILED') { echo 'bkd_failed'; } else if($result->booking_status == 'CONFIRMED' || $result->booking_status == 'SUCCESS'){ echo 'bkd_success'; } else echo 'bkd_canceld'; ?>">
                          <?php echo $result->booking_status; ?>
                        </div> -->
                         <?php if($result->booking_status=="FAILED" || $result->booking_status=="PROCESS") {?>
                                            <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success--><span style="color:red;">FAILED</span> 
                                               <!--  <?php echo $result->booking_status; ?>  -->
                                            </div>
                                            <?php } else {?>
                                            <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success-->CONFIRMED 
                                               <!--  <?php echo $result->booking_status; ?>  -->
                                            </div> <?php }?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-8 nopad">

                         <div class="row_books">
                            <div class="col-sm-4 nopad">
                                <div class="labl_books">Pnr No.</div>
                            </div>
                            <div class="col-sm-8 nopad">
                                <div class="labl_books bold_lbl"><?php echo $result->pnr_no; ?></div>
                            </div>
                        </div>

                        <div class="row_books">
                            <div class="col-sm-4 nopad">
                                <div class="labl_books">Conformation No.</div>
                            </div>
                            <div class="col-sm-8 nopad">
                                <div class="labl_books bold_lbl"><?php echo $result->con_pnr_no; ?></div>
                            </div>
                        </div>
                        <div class="row_books">
                            <div class="col-sm-4 nopad">
                                <div class="labl_books">Lead Passenger</div>
                            </div>
                            <div class="col-sm-8 nopad">
                                <div class="labl_books bold_lbl"><?php echo $passengers[0]->first_name.' '.$passengers[0]->last_name; ?></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <!-- <a class="view_bokd_dets" data-toggle="modal" onclick="show_booking_data('<?php echo $result->pnr_no; ?>', 'FLIGHT', 'itenerary')"  data-target="#booked_fligt_detail">View details</a> -->
                    </div>
                    <div class="col-sm-4 nopad">
                      <div class="side_details">
                          <div class="price_booked">
                              <div class="bokd_price"><?php echo BASE_CURRENCY_ICON.' '.$hoteldata['total_cost']; ?></div>

                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-12 dasflight-btn">
                    <div class="btns_bkd">
                    <?php if($result->pnr_no !='' && $result->booking_status == 'CONFIRMED') { ?>
                     
                    <a href="<?php echo WEB_URL; ?>voucher/<?php echo base64_encode(base64_encode($result->booking_global_id)); ?>/<?php echo base64_encode(base64_encode($result->product_id)); ?>" target="_blank" class="btn view_voucher_btn pull-right">View voucher</a>
                   
                  
                    <a href="#" class="btn send_voucher_email_btn" onclick="sendVoucherMail_flight('<?php echo $result->pnr_no; ?>',<?=$result->product_id?>,<?=$result->booking_global_id?>)">SEND MAIL</a>
                    <?php
                    }
                    ?>

                    </div>
                  </div>
                </div>
            <?php } } }
           } 
          } 
         else { ?>
            <!-- <div class="col-md-12" style="margin: 0 auto; text-align: center;">
                <div class="srywrap"><span class="sorrydiv"><img src="<?php echo ASSETS; ?>images/sorry.png" alt="" /><h4 class="stepshed">No Flight Bookings Found!</h4></span></div>
            </div>  -->
              <?php } }; ?>
        
  
    <!-- Hotel end -->


    <!--CAR -->
    
       <?php //debug($module);die;    
      if($module == 'Bus'){
                #echo "car_count".$car_count;
        $csno = 1;
         if($bus_count > 0){
           if ($user_type == 1) { ?>
                       <div class="table-responsive" style="width: 100%;overflow-x: scroll;">
              <table class="table table-bordered" id="car_report_pre">
              <thead>
                <tr>
                <th>S.No.</th>
                <th>App Reference</th>
                <th>Status</th>
                <th>Lead Pax Name</th>
                <th>PNR</th>
                <!-- <th>Bus Model</th> -->
                <th>bus Company</th>
                <th>Pickup Location</th>
                <th>Drop off Loaction</th>
                <th>Pickup Date</th>
                <th>Net Price</th>
                <th>Agent Markup</th>
                <th>Total </th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
            <?php for($k=0;$k<count($getoverallBookings);$k++){ 
           if($getoverallBookings[$k]->product_name == 'BUS'){

                         $result = $this->account_model->getBookingbyPnr($getoverallBookings[$k]->parent_pnr_no,$getoverallBookings[$k]->product_name)->row();              
                        $cart_data=$this->account_model->cart_data_bus($getoverallBookings[$k]->cart_id);
                         $bus_data=$this->account_model->get_bus_data($getoverallBookings[$k]->parent_pnr_no);
                        // debug($bus_data['bus_name']);exit;
                         $car_pick_up_dt = json_decode(base64_decode($result->segment_data), true)['car_pick_up_dt'];
                         $passengers = $this->account_model->get_passengersbypnr($result->booking_global_id)->result();
                         $cart = json_decode(base64_decode($result->segment_data));

                         $request_data = json_decode(base64_decode($result->request_data), true);
                        
                         $city_data = $this->db->get_where('iata_airport_list', array('airport_code' => $request_data['drop_down_loc'])) -> row_array(); 
                        $car_pick_up_dt = json_decode(base64_decode($result->segment_data), true)['car_pick_up_dt'];
                         $date_arr = explode('(', $car_pick_up_dt);
                        $outward_departure_info = strtotime(date('y-m-d', strtotime($date_arr[0])));
                          $current_datetime_info =strtotime(date('Y-m-d'));
                          if($outward_departure_info < $current_datetime_info) {
                             $prev_book = 1;
                           
                         ?>
              
              <tr class="">

                <td><?=$csno;?></td>
                <td><?php echo $result->con_pnr_no; ?></td>
                <td>
                  <?php if($result->booking_status=="FAILED" || $result->booking_status=="PROCESS" || $result->pnr_no == "") {?>
                                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success--><span style="color:red;">FAILED</span> 
                                           <!--  <?php echo $result->booking_status; ?>  -->
                                        </div>
                                        <?php } else {?>
                                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success-->CONFIRMED 
                                           <!--  <?php echo $result->booking_status; ?>  -->
                                        </div> <?php }?>
                </td>
                <td><?php echo $passengers[0]->first_name.' '.$passengers[0]->last_name; ?></td>
                <td><?php echo $result->pnr_no; ?></td>
                <!-- <td><?=$cart->fareType?></td> -->
                <td><?=$bus_data['bus_name']?></td>
                <td><?=$cart_data['bus_orgin'];?></td>
                <td><?=$cart_data['bus_destination'];?></td>
                <td><?=date('D d M Y', strtotime($result->travel_date))?></td>
                <td><?=number_format(($cart_data['amount']-$cart_data['discount']), 2);?></td>
                <td><?=number_format($cart_data['agent_markup'], 2);?></td>
                <td><?php echo BASE_CURRENCY_ICON.' '.$cart_data['amount']; ?> </td>
                <td>
                  <div class="col-sm-4 nopad">
                                        <div class="side_details">
                                            <div class="price_booked">
                                                <div class="btns_bkd">
                                                   <?php if($result->booking_status != 'FAILED' && $result->booking_status == 'CONFIRMED' ||  $result->con_pnr_no == "") { ?>
                                                   <!--  <a data-href="<?php echo WEB_URL; ?>car/CancelPnrBooking"  data-pnr="<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" class="cancelPnrBooking"><button class="btn btn-danger">Cancel Booking</button></a> -->
                                                    <?php } ?> 
                                                     <?php if($result->pnr_no !='' && $result->booking_status == 'CONFIRMED') { ?>
                                                    <a href="<?php echo WEB_URL; ?>voucher/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank"><button class="btn btn-primary">View voucher</button></a>
                                                    <a href="<?php echo WEB_URL; ?>invoice/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank"><button class="btn btn-info">View Invoice</button></a>
                                                    <button class="btn btn-primary" onclick="sendVoucherMail_flight('<?php echo $result->pnr_no; ?>')">SEND MAIL</button>  <?php } ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                </td>
              </tr>
              
                         <?php $csno++; ?>
                                <?php }} } ?>
                              </tbody>
                                </table>
                                <script>
                $(document).ready(function () {
            var oTable = $('#car_report_pre').dataTable({
                "oLanguage": {
                    "sSearch": "Search all columns:"
                },
                "aoColumnDefs": [
                {
                    'bSortable': false,
                    'aTargets': [0]
                        } //disables sorting for column one
                        ],
                        'iDisplayLength': 10,
                        "sPaginationType": "full_numbers",
                        "dom": 'T<"clear">lfrtip',
                        "tableTools": {
                            "sSwfPath": "<?php echo base_url('assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                        }
                    });
        });
              </script>

              </div>
            <?php }else{

           for($k=0;$k<count($getoverallBookings);$k++){ 
           if($getoverallBookings[$k]->product_name == 'BUS'){
                         $result = $this->account_model->getBookingbyPnr($getoverallBookings[$k]->parent_pnr_no,$getoverallBookings[$k]->product_name)->row();              
                          $bus_data=$this->account_model->get_bus_data($getoverallBookings[$k]->parent_pnr_no);
                          $cart_data=$this->account_model->cart_data_bus($getoverallBookings[$k]->cart_id);

 // debug($cart_data['amount']);exit();
                         $passengers = $this->account_model->get_passengersbypnr($result->booking_global_id)->result();
                         $cart = json_decode(base64_decode($result->segment_data));

                         $request_data = json_decode(base64_decode($result->request_data), true);
                        
                         $city_data = $this->db->get_where('iata_airport_list', array('airport_code' => $request_data['drop_down_loc'])) -> row_array(); 
                         $car_pick_up_dt = json_decode(base64_decode($result->segment_data), true)['car_pick_up_dt'];
                         $date_arr = explode('(', $car_pick_up_dt);
                        $outward_departure_info = strtotime(date('y-m-d', strtotime($date_arr[0])));
                          $current_datetime_info =strtotime(date('Y-m-d'));
                          if($outward_departure_info < $current_datetime_info) {
                       # debug($request_data);exit;
                         ?>
                         <div class="booking_rows">
                                <div class="mension_booktype">
                                    <span class="fa fa-bus"></span>
                                </div>
                                         <div class="inside_bookrow">
                                    <div class="from_to_all">
                                        <div class="left_city">
                                        <?php echo $bus_data['origin_city']; ?><span class="fa fa-long-arrow-right"></span><?php echo $bus_data['destination_city']; ?> </div><div class="travel_date"><?php echo date('M d,Y', strtotime($bus_data['departure_date'])).' - '.date('M d,Y', strtotime($bus_data['arrival_date'])); ?></div>

                                        <?php if($result->booking_status=="FAILED" || $result->booking_status=="PROCESS" ||  $result->pnr_no == "") {?>
                                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success--><span style="color:red;">FAILED</span> 
                                           <!--  <?php echo $result->booking_status; ?>  -->
                                        </div>
                                        <?php } else {?>
                                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success-->CONFIRMED 
                                           <!--  <?php echo $result->booking_status; ?>  -->
                                        </div> <?php }?>

                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-8 nopad">
                                        <div class="row_books">
                                            <div class="col-sm-4 nopad">
                                                <div class="labl_books">PNR No.</div>
                                            </div>
                                            <div class="col-sm-8 nopad">
                                                <div class="labl_books bold_lbl"><?php echo $result->pnr_no; ?></div>
                                            </div>
                                        </div>
                                           <div class="row_books">
                                            <div class="col-sm-4 nopad">
                                                <div class="labl_books">Confirmation No.</div>
                                            </div>
                                            <div class="col-sm-8 nopad">
                                                <div class="labl_books bold_lbl"><?php echo $result->con_pnr_no; ?></div>
                                            </div>
                                        </div>
                                        <div class="row_books">
                                            <div class="col-sm-4 nopad">
                                                <div class="labl_books">Lead Passenger</div>
                                            </div>
                                            <div class="col-sm-8 nopad">
                                                <div class="labl_books bold_lbl"><?php echo $passengers[0]->first_name.' '.$passengers[0]->last_name; ?></div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        
                                    </div>
                                    <div class="col-sm-4 nopad">
                                        <div class="side_details">
                                            <div class="price_booked">
                                                <div class="bokd_price"><?php echo BASE_CURRENCY_ICON.' '.$cart_data['amount']; ?></div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-12 dasflight-btn ma-t-20">
                                                <div class="btns_bkd">
                                                   <?php if($result->booking_status != 'FAILED' && $result->booking_status == 'CONFIRMED') { ?>
                                                     <a href="<?php echo WEB_URL; ?>voucher/<?php echo base64_encode(base64_encode($result->booking_global_id)); ?>/<?php echo base64_encode(base64_encode($result->product_id)); ?>" target="_blank" class="btn view_voucher_btn pull-right">View voucher</a>
                   
                  
                    <a href="#" class="btn send_voucher_email_btn" onclick="sendVoucherMail_flight('<?php echo $result->pnr_no; ?>',<?=$result->product_id?>,<?=$result->booking_global_id?>)">SEND MAIL</a>
                                                 <?php } ?> 
                                                </div>
                                            </div>
                                        </div>
                                  
                                </div>


          <?php  } }
         }
        }
         } else { ?>
          <div class="col-md-12" style="margin: 0 auto; text-align: center;">
                    <div class="srywrap"><span class="sorrydiv"><img src="<?php echo ASSETS; ?>images/sorry.png" alt="" /><h4 class="stepshed">No Car Bookings Found!</h4></span></div>
                </div>
        <?php  }
      } ?>

    <!--End Car-->
  </div>
  <!--Current Bokking-->

    <div role="tabpanel" class="tab-pane" id="profile">
      <?php 
      //print_r($getoverallBookings);

      if(count($getoverallBookings) >0){
          if($module == 'Flight'){ 
           //debug($getoverallBookings);exit("hg");                    
            if($flight_count > 0){
              if ($user_type == 1) { ?>
              <div class="table-responsive" style="width: 100%;overflow-x: scroll;">
              <table class="table table-bordered" id="flight_report">
               <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Confirmation No.</th>
                    <th>Pnr</th>
                    <th>Status</th>
                    <th>Airline</th>
                    <th>Lead Pax</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Departure Date</th>
                    <th>Return Date</th>
                    <th>Trip Type</th>
                    <th>Net Price</th>
                    <th>Agent Markup</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
               </thead>
               <tbody>

                <?php  $bokk_sno = 1 ?>
                <?php for($k=0;$k<count($getoverallBookings);$k++){                                
                  if($getoverallBookings[$k]->product_name == 'FLIGHT'){

                  $result = $this->account_model->getBookingbyPnr($getoverallBookings[$k]->parent_pnr_no,$getoverallBookings[$k]->product_name)->row();   
                  $segment_data=$outward_segments = json_decode($result->segment_data);
                  $passengers = $this->account_model->get_passengersbypnr($result->booking_global_id)->result(); 
                  //echo "<pre/>"; print_r($result);die;

                  $outward_departure_info = strtotime(date('y-m-d', strtotime($result->outward_departure)));
                  if($result->api_name == 'SABRE'){
                  	$outward_departure_info = strtotime(date('y-m-d', strtotime($result->outward_departure)));
                  }
                    $current_datetime_info =strtotime(date('Y-m-d'));
                    $prev_book = 0;
                    
                    if($outward_departure_info >= $current_datetime_info) {
                     $prev_book = 1;
                    
                ?>
              <tr class="">
                    <td><?=($bokk_sno)?></td>
                    <td><?php echo $result->con_pnr_no; ?></td>
                    <td><?php echo $result->pnr_no; ?></td>
                    <td><?php if($result->booking_status=="FAILED" || $result->booking_status=="PROCESS" || $result->pnr_no == "") {?>
                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success-->
                          <span style="color:red;">FAILED</span> 
                           <!--  <?php echo $result->booking_status; ?>  -->
                        </div>
                        <?php } else {?>
                            <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success-->CONFIRMED 
                               <!--  <?php echo $result->booking_status; ?>  -->
                            </div> <?php }?></td>
                    <td><?php echo $result->airline; ?></td>
                    <td><?php echo $passengers[0]->first_name.' '.$passengers[0]->last_name; ?></td>
                    <!-- <td><?php echo $result->origin_city; ?></td>
                    <td><?php echo $result->destination_city; ?></td>
                    <td><?php echo date('M \. d Y', strtotime($result->travel_date)); ?></td> -->
                     <?php if($result->api_name == 'SABRE'){ 
                                $des_count = count($segment_data[0]->Destination) - 1;
                          ?>
                              <td><?php echo $segment_data[0]->Origin[0]; ?></td>
                              <td><?php echo $segment_data[0]->Destination[$des_count]; ?></td>
                              <td><?php echo date('M \. d Y', strtotime($segment_data[0]->DepartureDateTime_r[0])); ?></td>
                              <?php } else {?>
                              <td><?php echo $result->origin_city; ?></td>
                              <td><?php echo $result->destination_city; ?></td>
                              <td><?php echo date('M \. d Y', strtotime($result->outward_departure)); ?></td>
                              <?php } ?>
                    <td><?php if($result->mode == "ROUNDTRIP"){ echo date('M \. d Y', strtotime($result->inward_depature));} ?></td>
                    <td><?php echo $result->mode; ?></td>
                    <td><?php echo BASE_CURRENCY_ICON.' '.number_format(($result->admin_baseprice + $result->admin_markup), 2); ?></td>
                    <td><?php echo BASE_CURRENCY_ICON.' '.number_format($result->agent_markup, 2); ?></td>
                    <td><?php echo BASE_CURRENCY_ICON.' '.number_format($result->total_amount, 2); ?></td>
                    <td>
                      <div class="col-md-12 dasflight-btn">
                                          <div class="btns_bkd">
                           <?php if($result->pnr_no !='' && $result->booking_status == 'CONFIRMED') { ?>
                              <a href="<?php echo WEB_URL; ?>voucher/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank" class="btn view_voucher_btn pull-right">View voucher</a>
                                <a href="<?php echo WEB_URL; ?>invoice/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank" class="btn view_invoice_btn pull-right">View Invoice</a>
                                <a href="#" class="btn send_voucher_email_btn" onclick="sendVoucherMail_flight('<?php echo $result->pnr_no; ?>')">SEND MAIL</a>
                             <?php
                                }
                                ?>

                            </div>
            </div>
                    </td>
                </tr>
              



            </div>
            <?php $bokk_sno++; ?>
              <?php }} }?>
              </tbody>
              </table>
              </div>
              <script>
                $(document).ready(function () {
            var oTable = $('#flight_report58').dataTable({
                "oLanguage": {
                    "sSearch": "Search all columns:"
                },
                "aoColumnDefs": [
                {
                    'bSortable': false,
                    'aTargets': [0]
                        } //disables sorting for column one
                        ],
                        'iDisplayLength': 10,
                        "sPaginationType": "full_numbers",
                        "dom": 'T<"clear">lfrtip',
                        "tableTools": {
                            "sSwfPath": "<?php echo base_url('assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                        }
                    });
        });
              </script>
              <?php } else {
               
              
              for($k=0;$k<count($getoverallBookings);$k++){                                
              if($getoverallBookings[$k]->product_name == 'FLIGHT'){

            $result = $this->account_model->getBookingbyPnr($getoverallBookings[$k]->parent_pnr_no,$getoverallBookings[$k]->product_name)->row();   
            $segment_data=$outward_segments = json_decode($result->segment_data);
            $passengers = $this->account_model->get_passengersbypnr($result->booking_global_id)->result();
                  //         echo "<pre>"; print_r($getoverallBookings[$k]); echo "</pre>"; die();
            $outward_departure_info = strtotime(date('y-m-d', strtotime($result->outward_departure)));
                  if($result->api_name == 'SABRE'){
                  	$outward_departure_info = strtotime(date('y-m-d', strtotime($result->outward_departure)));
                  }
                    $current_datetime_info =strtotime(date('Y-m-d'));
                    $prev_book = 0;
                    
                    if($outward_departure_info >= $current_datetime_info) {
                    // if(true) {

          ?>

      <div class="booking_rows">
            <div class="mension_booktype">
                <span class="fa fa-plane"></span>
            </div>
           <div class="inside_bookrow">
                <div class="from_to_all">
                    <?php if($result->api_name == 'SABRE'){ ?>
                    <div class="left_city"><?php echo $segment_data[0]->Origin[0]; ?><span class="fa fa-long-arrow-right"></span><?php echo $segment_data[0]->Destination[$des_count]; ?> </div><div class="travel_date"><?php echo date('M \. d Y', strtotime($segment_data[0]->DepartureDateTime_r[0])); ?></div>
                    <?php } else{ ?>
                    <div class="left_city"><?php echo $result->origin_city; ?><span class="fa fa-long-arrow-right"></span><?php echo $result->destination_city; ?> </div><div class="travel_date"><?php echo date('M \. d Y', strtotime($result->outward_departure)); ?></div>
                    <?php } ?>
                    
                  <!--   <div class="book_status <?php if($result->booking_status == 'FAILED') { echo 'bkd_failed'; } else if($result->booking_status == 'CONFIRMED' || $result->booking_status == 'SUCCESS'){ echo 'bkd_success'; } else echo 'bkd_canceld'; ?>">
                      <?php echo $result->booking_status; ?>
                    </div> -->
                     <?php if($result->booking_status=="FAILED" || $result->booking_status=="PROCESS" || $result->pnr_no == "") {?>
                                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success--><span style="color:red;">FAILED</span> 
                                           <!--  <?php echo $result->booking_status; ?>  -->
                                        </div>
                                        <?php } else {?>
                                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success-->CONFIRMED 
                                           <!--  <?php echo $result->booking_status; ?>  -->
                                        </div> <?php }?>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-8 nopad">

                     <div class="row_books">
                        <div class="col-sm-4 nopad">
                            <div class="labl_books">Pnr No.</div>
                        </div>
                        <div class="col-sm-8 nopad">
                            <div class="labl_books bold_lbl"><?php echo $result->pnr_no; ?></div>
                        </div>
                    </div>

                    <div class="row_books">
                        <div class="col-sm-4 nopad">
                            <div class="labl_books">Conformation No.</div>
                        </div>
                        <div class="col-sm-8 nopad">
                            <div class="labl_books bold_lbl"><?php echo $result->con_pnr_no; ?></div>
                        </div>
                    </div>
                    <div class="row_books">
                        <div class="col-sm-4 nopad">
                            <div class="labl_books">Lead Passenger</div>
                        </div>
                        <div class="col-sm-8 nopad">
                            <div class="labl_books bold_lbl"><?php echo $passengers[0]->first_name.' '.$passengers[0]->last_name; ?></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- <a class="view_bokd_dets" data-toggle="modal" onclick="show_booking_data('<?php echo $result->pnr_no; ?>', 'FLIGHT', 'itenerary')"  data-target="#booked_fligt_detail">View details</a> -->
                </div>
                <div class="col-sm-4 nopad">
                  <div class="side_details">
                      <div class="price_booked">
                          <div class="bokd_price"><?php echo BASE_CURRENCY_ICON.' '.$result->total_amount; ?></div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 dasflight-btn">
                                          <div class="btns_bkd">
                           <?php if($result->pnr_no !='' && $result->booking_status == 'CONFIRMED') { ?>
                              <a href="<?php echo WEB_URL; ?>voucher/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank" class="btn view_voucher_btn pull-right">View voucher</a>
                                <a href="<?php echo WEB_URL; ?>invoice/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank" class="btn view_invoice_btn pull-right">View Invoice</a>
                                <a href="#" class="btn send_voucher_email_btn" onclick="sendVoucherMail_flight('<?php echo $result->pnr_no; ?>')">SEND MAIL</a>
                             <?php
                                }
                                ?>

                            </div>
            </div>



            </div>
      <?php } } } } } else { ?>
        <div class="col-md-12" style="margin: 0 auto; text-align: center;">
                    <div class="srywrap"><span class="sorrydiv"><img src="<?php echo ASSETS; ?>images/sorry.png" alt="" /><h4 class="stepshed">No Flight Bookings Found!</h4></span></div>
                </div>    </div>
  </div>
      <?php }
      




       } 









			 // Hotel
			 if($module == 'Hotel'){
           if ($user_type == 1) { 
				 if($hotel_count > 0){ ?>
           <div class="table-responsive" style="width: 100%;overflow-x: scroll;">
              <table class="table table-bordered" id="hotel_report">
              <thead>
                <tr>
                <th>S.No.</th>
                <th>App Reference</th>
                <th>Status</th>
                <th>Lead Pax Name</th>
                <th>PNR</th>
                <th>Hotel Name</th>
                <th>no Of Room</th>
                <th>City</th>
                <th>CheckIn Date</th>
                <th>Checkout Date</th>
                <th>Net Price</th>
                <th>Agent Markup</th>
                <th>Total </th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php $hsno = 1; ?>
           <?php for($k=0;$k<count($getoverallBookings);$k++){ 
           if($getoverallBookings[$k]->product_name == 'HOTEL') {          
             $result = $this->account_model->getBookingbyPnr($getoverallBookings[$k]->parent_pnr_no,$getoverallBookings[$k]->product_name)->row();          
             $passengers = $this->account_model->get_passengersbypnr($result->booking_global_id)->result();
             $hoteldata = $this->account_model->get_hoteldatainfo($result->hotel_code);
              
             // echo"<pre/>";print_r($result); exit;
              $outward_departure_info = strtotime(date('y-m-d', strtotime($result->check_in)));
                          $current_datetime_info =strtotime(date('Y-m-d'));
                          if($outward_departure_info >= $current_datetime_info) {


            ?>
            <tr class="">
                <td><?=$hsno?></td>
                <td><?php echo $result->con_pnr_no; ?></td>
                <td>
                   <?php if($result->booking_status=="FAILED" || $result->booking_status=="PROCESS") {?>
                                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success--><span style="color:red;">FAILED</span> 
                                           <!--  <?php echo $result->booking_status; ?>  -->
                                        </div>
                                        <?php } else {?>
                                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success-->CONFIRMED 
                                           <!--  <?php echo $result->booking_status; ?>  -->
                                        </div> <?php }?>
                </td>
                <td><?php echo $passengers[0]->first_name.' '.$passengers[0]->last_name; ?></td>
                <td><?php echo $result->pnr_no; ?></td>
                <td><?=@$hoteldata->HotelName?></td>
                <td><?php echo $result->room_count; ?></td>
                <td><?php echo $result->city; ?></td>
                <td><?php echo date('M \. d Y', strtotime($result->check_in)) ?></td>
                <td><?php echo date('M \. d Y', strtotime($result->check_out)) ?></td>
                <td><?php echo number_format(($result->admin_baseprice + $result->admin_markup), 2); ?></td>
                <td><?php echo $result->agent_markup; ?></td>
                <td><?php echo BASE_CURRENCY_ICON.' '.$result->total_amount; ?> </td>
                <td>
                 
                
                               <?php if($result->pnr_no !='' && $result->booking_status == 'CONFIRMED') { ?>
                              <a href="<?php echo WEB_URL; ?>voucher/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank"><button class="btn btn-primary">View voucher</button></a>
                                <a href="<?php echo WEB_URL; ?>invoice/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank"><button class="btn btn-info">View Invoice</button></a>
                                <button class="btn btn-primary" onclick="sendVoucherMail_flight('<?php echo $result->pnr_no; ?>')">SEND MAIL</button><?php }?>
                        
                </td>
              </tr>
            <?php }} ?>
            <?php $hsno++; ?>
          
            <?php }  ?>
            </tbody>
            </table>
            <script>
                $(document).ready(function () {
            var oTable = $('#hotel_report').dataTable({
                "oLanguage": {
                    "sSearch": "Search all columns:"
                },
                "aoColumnDefs": [
                {
                    'bSortable': false,
                    'aTargets': [0]
                        } //disables sorting for column one
                        ],
                        'iDisplayLength': 10,
                        "sPaginationType": "full_numbers",
                        "dom": 'T<"clear">lfrtip',
                        "tableTools": {
                            "sSwfPath": "<?php echo base_url('assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                        }
                    });
        });
              </script>
          <?php } ?>
            
            </div>
            <?php }  else if(($hotel_count > 0) && ($user_type != 1)){ ?>
            
              <?php 
					 for($k=0;$k<count($getoverallBookings);$k++){ 
						 //~ echo"<pre/>";print_r($getoverallBookings); exit;
					 if($getoverallBookings[$k]->product_name == 'HOTEL')	{					 
						 $result = $this->account_model->getBookingbyPnr($getoverallBookings[$k]->parent_pnr_no,$getoverallBookings[$k]->product_name)->row();					
						 $passengers = $this->account_model->get_passengersbypnr($result->booking_global_id)->result();
						 $hoteldata = $this->account_model->get_hoteldatainfo($result->hotel_code);
						$outward_departure_info = strtotime(date('y-m-d', strtotime($result->check_in)));
                          $current_datetime_info =strtotime(date('Y-m-d'));
                          if($outward_departure_info >= $current_datetime_info) {
                          // if(true) {
						?>
					<div class="booking_rows">
            <div class="mension_booktype">
                <span class="fa fa-bed"></span>
            </div>
					 <div class="inside_bookrow">
                <div class="from_to_all">
                    <div class="left_city"><?php echo $hoteldata->HotelName; ?><span class="fa fa-long-arrow-right"></span><?php echo $hoteldata->city; ?> </div><div class="travel_date"><?php echo date('M \. d Y', strtotime($result->check_in)).' - '.date('M \. d Y', strtotime($result->check_out)); ?></div>
                    
                    <!-- <div class="book_status bkd_success <?php echo $result->booking_status; ?>">
                    	<?php echo $result->booking_status; ?>
                    </div> -->
                     <?php if($result->booking_status=="FAILED" || $result->booking_status=="PROCESS") {?>
                                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success--><span style="color:red;">FAILED</span> 
                                           <!--  <?php echo $result->booking_status; ?>  -->
                                        </div>
                                        <?php } else {?>
                                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success-->CONFIRMED 
                                           <!--  <?php echo $result->booking_status; ?>  -->
                                        </div> <?php }?>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-8 nopad">
                    <div class="row_books">
                        <div class="col-sm-4 nopad">
                            <div class="labl_books">PNR No.</div>
                        </div>
                        <div class="col-sm-8 nopad">
                            <div class="labl_books bold_lbl"><?php echo $result->pnr_no; ?></div>
                        </div>
                    </div>
                       <div class="row_books">
                        <div class="col-sm-4 nopad">
                            <div class="labl_books">Conformation No.</div>
                        </div>
                        <div class="col-sm-8 nopad">
                            <div class="labl_books bold_lbl"><?php echo $result->con_pnr_no; ?></div>
                        </div>
                    </div>
                    <div class="row_books">
                        <div class="col-sm-4 nopad">
                            <div class="labl_books">Lead Passenger</div>
                        </div>
                        <div class="col-sm-8 nopad">
                            <div class="labl_books bold_lbl"><?php echo $passengers[0]->first_name.' '.$passengers[0]->last_name; ?></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                  <!--   <a class="view_bokd_dets" data-toggle="modal" onclick="show_booking_data('<?php echo $result->parent_pnr_no; ?>', 'HOTEL', 'itenerary')"  data-target="#booked_fligt_detail">View details</a> -->
                </div>
                <div class="col-sm-4 nopad">
                	<div class="side_details">
                    	<div class="price_booked">
                        	<div class="bokd_price"><?php echo BASE_CURRENCY_ICON.' '.$result->total_amount; ?></div>
                            <div class="btns_bkd">
								<?php if($result->booking_status != 'FAILED' && $result->booking_status == 'CONFIRMED') { ?>
                            	<!-- <a data-href="<?php echo WEB_URL; ?>hotel/CancelPnrBooking"  data-pnr="<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" class="cancelPnrBooking"><button class="btn btn-danger">Cancel Booking</button></a>
                            	<?php } ?> -->
                               <?php if($result->pnr_no !='' && $result->booking_status == 'CONFIRMED') { ?>
                            	<a href="<?php echo WEB_URL; ?>voucher/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank"><button class="btn btn-primary">View voucher</button></a>
                                <a href="<?php echo WEB_URL; ?>invoice/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank"><button class="btn btn-info">View Invoice</button></a>
                                <button class="btn btn-primary" onclick="sendVoucherMail_flight('<?php echo $result->pnr_no; ?>')">SEND MAIL</button><?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
					<?php } }
				 } }
        
				 } else {  ?>
          <?php if(($hotel_count == 0) && ($module == 'HOTEL')){ ?>
					 <div class="col-md-12" style="margin: 0 auto; text-align: center;">
                    <div class="srywrap"><span class="sorrydiv"><img src="<?php echo ASSETS; ?>images/sorry.png" alt="" /><h4 class="stepshed">No Hotel Bookings Found!</h4></span></div>
                </div>
              <?php } ?>
				<?php }
      }
			
			// Car 
           
			if($module == 'Car'){
                #echo "car_count".$car_count;
        $csno = 1;
				 if($car_count > 0){
           if ($user_type == 1) { ?>
                       <div class="table-responsive" style="width: 100%;overflow-x: scroll;">
              <table class="table table-bordered" id="car_report">
              <thead>
                <tr>
                <th>S.No.</th>
                <th>App Reference</th>
                <th>Status</th>
                <th>Lead Pax Name</th>
                <th>PNR</th>
                <th>Car Model</th>
                <th>Car Company</th>
                <th>Pickup Location</th>
                <th>Drop off Loaction</th>
                <th>Pickup Date</th>
                <th>Net Price</th>
                <th>Agent Markup</th>
                <th>Total </th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
            <?php for($k=0;$k<count($getoverallBookings);$k++){ 
           if($getoverallBookings[$k]->product_name == 'CAR'){

                         $result = $this->account_model->getBookingbyPnr($getoverallBookings[$k]->parent_pnr_no,$getoverallBookings[$k]->product_name)->row();              

                            $car_pick_up_dt = json_decode(base64_decode($result->segment_data), true)['car_pick_up_dt'];

                         $passengers = $this->account_model->get_passengersbypnr($result->booking_global_id)->result();
                         $cart = json_decode(base64_decode($result->segment_data));

                         $request_data = json_decode(base64_decode($result->request_data), true);
                        
                         $city_data = $this->db->get_where('iata_airport_list', array('airport_code' => $request_data['drop_down_loc'])) -> row_array(); 
                       // echo "<pre/>";print_r($request_data);exit;

                         $date_arr = explode('(', $car_pick_up_dt);
                         $outward_departure_info = strtotime(date('y-m-d', strtotime($date_arr[0])));
                          $current_datetime_info =strtotime(date('Y-m-d'));
                          if($outward_departure_info >= $current_datetime_info) {
                             $prev_book = 1;
                        ?>
              
              <tr class="">
                <td><?=$csno?></td>
                <td><?php echo $result->con_pnr_no; ?></td>
                <td>
                  <?php if($result->booking_status=="FAILED" || $result->booking_status=="PROCESS" ||  $result->pnr_no == "") {?>
                                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success--><span style="color:red;">FAILED</span> 
                                           <!--  <?php echo $result->booking_status; ?>  -->
                                        </div>
                                        <?php } else {?>
                                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success-->CONFIRMED 
                                           <!--  <?php echo $result->booking_status; ?>  -->
                                        </div> <?php }?>
                </td>
                <td><?php echo $passengers[0]->first_name.' '.$passengers[0]->last_name; ?></td>
                <td><?php echo $result->pnr_no; ?></td>
                <td><?=$cart->fareType?></td>
                <td><?=$cart->company_name?></td>
                <td><?=$request_data['pick_up_loc'];?></td>
                <td><?=$request_data['drop_down_loc'];?></td>
                <td><?=date('D d M Y', strtotime($result->travel_date))?></td>
                <td><?=number_format(($result->admin_baseprice + $result->admin_markup), 2);?></td>
                <td><?=number_format($result->agent_markup, 2);?></td>
                <td><?php echo BASE_CURRENCY_ICON.' '.$result->total_amount; ?> </td>
                <td>
                  <div class="col-sm-4 nopad">
                                        <div class="side_details">
                                            <div class="price_booked">
                                                <div class="btns_bkd">
                                                   <?php if($result->booking_status != 'FAILED' && $result->booking_status == 'CONFIRMED') { ?>
                                                   <!--  <a data-href="<?php echo WEB_URL; ?>car/CancelPnrBooking"  data-pnr="<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" class="cancelPnrBooking"><button class="btn btn-danger">Cancel Booking</button></a> -->
                                                    <?php } ?> 
                                                     <?php if($result->pnr_no !='' && $result->booking_status == 'CONFIRMED') { ?>
                                                    <a href="<?php echo WEB_URL; ?>voucher/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank"><button class="btn btn-primary">View voucher</button></a>
                                                    <a href="<?php echo WEB_URL; ?>invoice/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank"><button class="btn btn-info">View Invoice</button></a>
                                                    <button class="btn btn-primary" onclick="sendVoucherMail_flight('<?php echo $result->pnr_no; ?>')">SEND MAIL</button>  <?php } ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                </td>
              </tr>
              
                         <?php $csno++; ?>
                                <?php }} } ?>
                              </tbody>
                                </table>
                                <script>
                $(document).ready(function () {
            var oTable = $('#car_report').dataTable({
                "oLanguage": {
                    "sSearch": "Search all columns:"
                },
                "aoColumnDefs": [
                {
                    'bSortable': false,
                    'aTargets': [0]
                        } //disables sorting for column one
                        ],
                        'iDisplayLength': 10,
                        "sPaginationType": "full_numbers",
                        "dom": 'T<"clear">lfrtip',
                        "tableTools": {
                            "sSwfPath": "<?php echo base_url('assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                        }
                    });
        });
              </script>

              </div>
            <?php }else{

					 for($k=0;$k<count($getoverallBookings);$k++){ 
					 if($getoverallBookings[$k]->product_name == 'CAR'){

                         $result = $this->account_model->getBookingbyPnr($getoverallBookings[$k]->parent_pnr_no,$getoverallBookings[$k]->product_name)->row();              


                         $passengers = $this->account_model->get_passengersbypnr($result->booking_global_id)->result();
                         $cart = json_decode(base64_decode($result->segment_data));

                         $request_data = json_decode(base64_decode($result->request_data), true);
                        
                         $city_data = $this->db->get_where('iata_airport_list', array('airport_code' => $request_data['drop_down_loc'])) -> row_array(); 
                         $car_pick_up_dt = json_decode(base64_decode($result->segment_data), true)['car_pick_up_dt'];
                         $date_arr = explode('(', $car_pick_up_dt);
                        $outward_departure_info = strtotime(date('y-m-d', strtotime($date_arr[0])));
                          $current_datetime_info =strtotime(date('Y-m-d'));
                          // debug($result);die;
                          if($outward_departure_info >= $current_datetime_info) {
                         ?>
                         <div class="booking_rows">
                                <div class="mension_booktype">
                                    <span class="fa fa-car"></span>
                                </div>
                                         <div class="inside_bookrow">
                                    <div class="from_to_all">
                                        <div class="left_city">
                                        <?php echo $request_data['pick_up_loc']; ?><span class="fa fa-long-arrow-right"></span><?php echo $request_data['drop_down_loc']; ?> </div><div class="travel_date"><?php echo date('M d,Y', strtotime($request_data['pick_up_date'])).' - '.date('M d,Y', strtotime($request_data['drop_down_date2'])); ?></div>

                                        <?php if($result->booking_status=="FAILED" || $result->booking_status=="PROCESS" ||  $result->pnr_no == "") {?>
                                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success--><span style="color:red;">FAILED</span> 
                                           <!--  <?php echo $result->booking_status; ?>  -->
                                        </div>
                                        <?php } else {?>
                                        <div class="book_status bkd_success <?php echo $result->booking_status; ?>"><!--bkd_success-->CONFIRMED 
                                           <!--  <?php echo $result->booking_status; ?>  -->
                                        </div> <?php }?>

                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-8 nopad">
                                        <div class="row_books">
                                            <div class="col-sm-4 nopad">
                                                <div class="labl_books">PNR No.</div>
                                            </div>
                                            <div class="col-sm-8 nopad">
                                                <div class="labl_books bold_lbl"><?php echo $result->pnr_no; ?></div>
                                            </div>
                                        </div>
                                           <div class="row_books">
                                            <div class="col-sm-4 nopad">
                                                <div class="labl_books">Confirmation No.</div>
                                            </div>
                                            <div class="col-sm-8 nopad">
                                                <div class="labl_books bold_lbl"><?php echo $result->con_pnr_no; ?></div>
                                            </div>
                                        </div>
                                        <div class="row_books">
                                            <div class="col-sm-4 nopad">
                                                <div class="labl_books">Lead Passenger</div>
                                            </div>
                                            <div class="col-sm-8 nopad">
                                                <div class="labl_books bold_lbl"><?php echo $passengers[0]->first_name.' '.$passengers[0]->last_name; ?></div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        
                                    </div>
                                    <div class="col-sm-4 nopad">
                                        <div class="side_details">
                                            <div class="price_booked">
                                                <div class="bokd_price"><?php echo BASE_CURRENCY_ICON.' '.$result->total_amount; ?></div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-12 dasflight-btn ma-t-20">
                                                <div class="btns_bkd">
                                                   <?php if($result->booking_status != 'FAILED' && $result->booking_status == 'CONFIRMED') { ?>
                                                   <!--  <a data-href="<?php echo WEB_URL; ?>car/CancelPnrBooking"  data-pnr="<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" class="cancelPnrBooking"><button class="btn btn-danger">Cancel Booking</button></a> -->
                                                    <?php } ?> 
                                                     <?php if($result->pnr_no !='' && $result->booking_status == 'CONFIRMED') { ?>
                                                    <a href="<?php echo WEB_URL; ?>voucher/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank"><button class="btn btn-primary view_voucher_btn pull-right matb-11">View voucher</button></a>
                                                    <a href="<?php echo WEB_URL; ?>invoice/<?php echo base64_encode(base64_encode($result->pnr_no)); ?>" target="_blank"><button class="btn btn-info view_invoice_btn pull-right">View Invoice</button></a>
                                                    <button class="btn btn-primary send_voucher_email_btn" onclick="sendVoucherMail_flight('<?php echo $result->pnr_no; ?>','<?php echo $result->con_pnr_no; ?>')">SEND MAIL</button>  <?php } ?> 
                                                </div>
                                            </div>
                                        </div>
                                  
                                </div>


					<?php  } }
				 }
        }
				 } else { ?>
					<div class="col-md-12" style="margin: 0 auto; text-align: center;">
                    <div class="srywrap"><span class="sorrydiv"><img src="<?php echo ASSETS; ?>images/sorry.png" alt="" /><h4 class="stepshed">No Car Bookings Found!</h4></span></div>
                </div>
				<?php  }
			} ?>		
    </div>
<?php 
} ?>
</div>
</div>
</div>

<div class="modal fade" id="booked_fligt_detail" data-role="dialog">

</div>


</div>
    </div>
 </section>
</section>
</div>
</div>
</div>
<div class="clearfix"></div>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>



<!-- Page Content -->

<?php echo $this->load->view(PROJECT_THEME.'/new_theme/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>




</body>
</html>

<!-- 
<script>
    function sendVoucherMail_flight(v_pnr) {
        $.ajax({
               url: WEB_URL+'dashboard/mail/'+v_pnr,
            success: function(r) {
               // $('.loadr:visible').hide();
                console.log(r);
            }
        })
    }
    
    $('.cancelPnrBooking').click(function(event){
		event.preventDefault();
		 var r = confirm("Are you Sure want to Cancel Hotel booking!");
			if (r == true) {
				var urlAction =$(this).attr('data-href');
				var pnrNO =$(this).attr('data-pnr');
				$('.cancel_loader .carttoloadr').show();
				$.ajax({
					type : 'POST',
					url: urlAction,
					data :{
						pnr_no :pnrNO
					},
					success: function(r) {
						$('.cancel_loader .carttoloadr').hide();
						location.reload();
					}
				})
			}
	});
    
    
</script> -->

<!-- 



<script type="text/javascript">
	function show_booking_data(id, module, divclass){
			var idval = id;
			  $.ajax({
      type:'GET', 
      url: '<?php echo WEB_URL;?>dashboard/call_iternary',
      data: { pnr: idval, module: module },
      beforeSend: function(XMLHttpRequest){
		$('.flight_fliter_loader').fadeIn();
      }, 
      success: function(response) {
        $('#booked_fligt_detail').html(response);
        $( "li.active" ).removeClass( "active" );
        $( "div.active" ).removeClass( "active" );
        $('#'+divclass+'_li').addClass('active');
        $('#'+divclass).addClass('active');
		$('.flight_fliter_loader').fadeOut();
      }
    });
                     
        }
</script>
 -->
 <script>
 function sendVoucherMail_flight(v_pnr,con_pnr_no,booking_global_id) {
        //alert("hiiiii");
        $.ajax({
               url: WEB_URL+'dashboard/mail/'+v_pnr+'/'+con_pnr_no+'/'+booking_global_id,
            success: function(r) {
               // $('.loadr:visible').hide();
                //console.log(r);
                alert("Mail sent Success");
            }
        })
    }
   $(document).ready(function(){
   
    $("#<?php echo $module ?>").addClass("active");
    if('<?php echo $module=="" ?>'){
      $("#all").addClass("active");
    }

    //to hide previous booking
    $('.book_1').hide();
   
  
});
 </script>