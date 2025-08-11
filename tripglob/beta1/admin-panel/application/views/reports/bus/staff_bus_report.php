<?php //error_reporting(E_ALL); ini_set('display_error', 'on'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo PROJECT_TITLE; ?> </title>
		<link rel="icon" href="https://tripglobo.com/beta1/assets/theme_dark/images/favicon.png" type="image/x-icon">


    <!-- Bootstrap core CSS -->

    <link href="<?php echo ASSETS; ?>css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="<?php echo ASSETS; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/animate.min.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>css/common/toggle-switch.css" rel="stylesheet" media="screen">
    <!-- Custom styling plus plugins -->
    <link href="<?php echo ASSETS; ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/icheck/flat/green.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet">
<style>
.switch-ios.switch-light {
    
    top: 0px !important; 
}
i{
  margin-right:5px;
  cursor:pointer;
}
</style>
<style>
        .list_of_sections a {
            background: #fff none repeat scroll 0 0;
            border: 1px solid #eeeeee;
            border-radius: 3px;
            box-shadow: 0 1px 2px 0 #ccc;
            color: #666;
            float: left;
            font-size: 14px;
            margin: 5px;
            padding: 5px 10px;
        }
        .list_of_sections a{
          margin-bottom: 20px;
        }
        .list_of_sections a.active {
            color: #1b66a9;
        }
        .mT15{
                margin-top: 15px;
        }
    </style>
   <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
    <script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
      </head>


      <body class="nav-md">

        <div class="container body">


            <div class="main_container">



                <!-- top navigation -->

                <?php echo $this->load->view('common/sidebar_menu'); ?>
                <?php echo $this->load->view('common/top_menu'); ?>
                <?php echo $this->load->view('reports/email_popup');?>
                <!-- /top navigation -->

                <!-- page content -->
          

                <div class="right_col" role="main">

                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>
                                    <?php echo $page_title; ?>
                                </h3>
                            </div>


                        </div>
                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div class="x_panel">
                                    <div class="x_content">

                                <div class="clearfix"></div>
<div class="clearfix"></div>
<div class="clearfix"></div>

<div id="advance_search_form_container" class="serch_area_fltr">
   <form action="<?=base_url()?>reports/bus_staff_reports" method="get" autocomplete="off" class="form-horizontal" role="form">
      <div class="form-group mT15">
         <label class="col-sm-1 control-label"> From</label>                
         <div class="col-sm-2">                    <input type="text" id="created_datetime_from" class="form-control" name="created_datetime_from" placeholder="From Date" value="<?=@$created_datetime_from?>" readonly>                </div>
         <label class="col-sm-1 control-label"> To </label>                
         <div class="col-sm-2">                    <input type="text" id="created_datetime_to" class="form-control disable-date-auto-update" name="created_datetime_to" placeholder="To Date" value="<?=@$created_datetime_to?>" readonly>                </div>
       
         <div class="col-sm-1">                   
          <button class="btn btn-success " type="submit">Search</button>                
        </div>
         <div class="col-sm-2">                    
               <button class="btn btn-success reset_class" type="reset">Reset</button>                
         </div>
      </div>
   </form>
</div>
<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="searc_fliter_all">
   <div class="filter_heading">Make your search easy</div>
   <div class="list_of_sections">
   <?php 
      $today_search = date('Y-m-d');
      $last_today_search = date('Y-m-d', strtotime('-1 day'));

      $last_3_search = date('Y-m-d', strtotime('-3 day'));
      $last_7_search = date('Y-m-d', strtotime('-7 day'));
      $last_15_search = date('Y-m-d', strtotime('-15 day'));
      $last_1m_search = date('Y-m-d', strtotime('-1 month'));
      $last_3m_search = date('Y-m-d', strtotime('-3 month'));
    ?>
       <a class="<?=(($today_search == @$_GET['today_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>reports/bus_staff_reports?today_booking_data=<?=date('Y-m-d')?>">Today Search</a>
       <a class="<?=(($last_today_search == @$_GET['last_day_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>reports/bus_staff_reports?last_day_booking_data=<?=date('Y-m-d', strtotime('-1 day'))?>">Last Day Search</a>
       <a class="<?=(($last_3_search == @$_GET['prev_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>reports/bus_staff_reports?prev_booking_data=<?=date('Y-m-d', strtotime('-3 day'))?>">Last 3 Day Search</a>
       <a class="<?=(($last_7_search == @$_GET['prev_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>reports/bus_staff_reports?prev_booking_data=<?=date('Y-m-d', strtotime('-7 day'))?>">Last 7 Day Search</a>
       <a class="<?=(($last_15_search == @$_GET['prev_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>reports/bus_staff_reports?prev_booking_data=<?=date('Y-m-d', strtotime('-15 day'))?>">Last 15 Day Search</a>
       <a class="<?=(($last_1m_search == @$_GET['prev_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>reports/bus_staff_reports?prev_booking_data=<?=date('Y-m-d', strtotime('-1 month'))?>">Last 1 Month Search</a>
       <a class="<?=(($last_3m_search == @$_GET['prev_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>reports/bus_staff_reports?prev_booking_data=<?=date('Y-m-d', strtotime('-3 month'))?>">Last 3 Month Search</a>
   </div>
</div>
<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="clearfix"></div>
                                  <div class="table-responsive">  
                                <table id="example" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                        <tr class="headings">

                                            <th>Sl No </th>
                                            <th>Con Reference </th>         
                                            <th>Status</th>
                                            <th>Lead Pax details</th>
                                            <th>PNR</th>
                                            <th>City</th>
                                            <th>Booked on</th>
                                            <th>Checkin</th>
                                            <th>Checkout</th>
                                            <th>Net rate</th>
                                            <th>Markup</th>
                                            <th>Discount</th>
                                            <th>Total Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                    $i=1;
                                        
                    if(!empty($hotel_data))
                    {
                                            // echo "<pre/>"; print_r($hotel_data);die;
                                        foreach($hotel_data as $fd)
                                        {
                                            $segment_data = json_decode($fd['request_scenario'],true);

                                           ?>
                                           <tr class="even pointer">

                                            <td class=" "><?php echo $i++; ?></td>
                                            <td><?php echo $fd['con_pnr_no']?></td>
                                            <?php $booking_status = ($fd['pnr_no'] != "") ? $fd['booking_status'] : "FAILED"  ?>                                                
                                            <td><span class="<?php echo booking_status_label($booking_status) ?>"><?php echo $booking_status?></span></td>
                                            <td><?php echo $fd['leadpax']?></td>
                                            <td><?php echo $fd['pnr_no']?></td>
                                            <td><?php echo $fd['city']?></td>
                                            <td><?php echo $fd['voucher_date']?></td>
                                            <td><?php echo $fd['check_in']?></td>
                                            <td><?php echo $fd['check_out']?></td>
                                            <td><?php echo $fd['net_rate']?></td>
                                            <td><?php echo $fd['admin_markup']?></td>
                                            <td><?php echo $fd['discount']?></td>
                                            <td><?php echo ($fd['total_amount'])?></td>
                                            <td>
                                            <?php if($fd['pnr_no']):?>
                                                <a class="btn btn-sm btn_action" href="<?php echo base_url(); ?>reports/view_voucher/<?=base64_encode($fd['pnr_no'])?>/<?=base64_encode($fd['con_pnr_no'])?>"> <i class="fa fa-file" title="View Voucher"></i></a>

                                                <a   data-pnr="<?=$fd['pnr_no']?>" 

                                                data-con-pnr ="<?=$fd['con_pnr_no']?>"
                                                data-recipient_email="<?=$fd['billing_email']?>" class="send_email_voucher btn btn-sm btn_action"> <i class="fa fa-envelope" title="Send Email"></i></a>
                                                
                                                <a class="btn btn-sm btn_action" href="<?php echo base_url(); ?>reports/cancel_ticket/<?=base64_encode($fd['pnr_no'])?>/<?=base64_encode($fd['con_pnr_no'])?>"> <i class="fa fa-ticket" title="Cancel Ticket"></i></a>

                                            <?php endif;?>
                                          
                                            </td>

                                        </tr>
                                        <?php
                                    }
                    }
                                    ?>
                                </tbody>

                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer content -->
        <?php echo $this->load->view('common/footer'); ?>  
        <!-- /footer content -->

    </div>
    <!-- /page content -->
</div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>

<script src="<?php echo ASSETS; ?>js/bootstrap.min.js"></script>

<!-- chart js -->
<script src="<?php echo ASSETS; ?>js/chartjs/chart.min.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo ASSETS; ?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo ASSETS; ?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo ASSETS; ?>js/icheck/icheck.min.js"></script>

<script src="<?php echo ASSETS; ?>js/custom.js"></script>
<!-- form validation -->
  <script src="<?php echo ASSETS; ?>js/validator/validator.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  <script>
     $(document).ready(function() {
      $('#example').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ]
      } );
  } );
  </script>
<script type="text/javascript">
    $(function(){      

            $('.send_email_voucher').on('click', function(e) {
                    $("#mail_voucher_modal").modal('show');
                    $('#mail_voucher_error_message').empty();
                    email = $(this).data('recipient_email');
                    $("#voucher_recipient_email").val(email);
                    var pnr_no =$(this).data('pnr');
                    var con_pnr_no = $(this).data('con-pnr');
                  $("#send_mail_btn").off('click').on('click',function(e){
                     
                      email = $("#voucher_recipient_email").val();
            
                      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                         if(email != ''){ 
                              if(!emailReg.test(email)){
                                  $('#mail_voucher_error_message').empty().text('Please Enter Correct Email Id');
                                     return false;    
                                      }
                            var _opp_url ="<?php echo base_url()?>"+"reports/mail";
                            
                           
                            $.post(_opp_url,{PNR_NO:pnr_no,Email:email,CON_PNR_NO:con_pnr_no}, function(data,status) {                                
                                 alert("Email sent  Successfully!!!");
                                $("#mail_voucher_modal").modal('hide'); 
                            });
                             
                      }else{
                          $('#mail_voucher_error_message').empty().text('Please Enter Email ID');
                          }
                  });
            
             });

      


      
    });
</script>
<script type="text/javascript">
var dp_visi_months = 1;
if ($(window).width() > 420) {
    dp_visi_months = 2;
} else {
    dp_visi_months = 1;
}
  $(document).ready(function() {
              pastDatepicker("created_datetime_from");
                    pastDatepicker("created_datetime_to");
                    pastDatepicker("from_date");
                    pastDatepicker("to_date");
                    //date validation
          $("#created_datetime_from").change(function() {
            //manage date validation
            auto_set_dates($("#created_datetime_from").datepicker('getDate'), "created_datetime_to", 'minDate');
          });
          //if second date is already set then dont run
          if ($("#created_datetime_to").val() == '' ) {
            auto_set_dates($("#created_datetime_from").datepicker('getDate'), "created_datetime_to", 'minDate');
          }
                //date validation
          $("#from_date").change(function() {
            //manage date validation
            auto_set_dates($("#from_date").datepicker('getDate'), "to_date", 'minDate');
          });
          //if second date is already set then dont run
          if ($("#to_date").val() == '' ) {
            auto_set_dates($("#from_date").datepicker('getDate'), "to_date", 'minDate');
          }
        });
</script>
<script>
  function auto_set_dates(date_1, input2, date_type, add_days) {
  var add_days = typeof add_days !== 'undefined' ?  add_days : 1;
    var date_1_ts = Date.parse(date_1);
    if (isNaN(date_1_ts) == false) {
        var ip_2 = $("#" + input2);
        ip_2.trigger("click");
        var selectedDate = date_1;
        
        //var nextdayDate = dateADD(selectedDate);
        nextdayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), (selectedDate.getDate() + add_days));
        
        var nextDateStr = zeroPad(nextdayDate.getDate(), 2) + "-" + zeroPad((nextdayDate.getMonth() + 1), 2) + "-" + (nextdayDate.getFullYear());
        ip_2.datepicker('option', date_type, nextdayDate);
        var second_date = ip_2.datepicker('getDate');
        var date_diff = get_day_difference(selectedDate, second_date);
        if (date_diff < 1 && ip_2.is(':disabled') == false && ip_2.hasClass('disable-date-auto-update') == false) {
            ip_2.val(nextDateStr)
        }
    }
}
function pastDatepicker(inputId) {
    $('#' + inputId).datepicker({
        numberOfMonths: dp_visi_months,
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        maxDate: 0,
        yearRange: "-100:-0",
        autoclose: true
    })
}
function zeroPad(num, count) {
    var numZeropad = num + '';
    while (numZeropad.length < count) {
        numZeropad = "0" + numZeropad
    }
    return numZeropad
}

function get_day_difference(date1, date2) {
    if (date1 != '' && date2 != '') {
        var date1 = new Date(date1);
        var date2 = new Date(date2);
        var time_diff = date2.getTime() - date1.getTime();
        var days = time_diff / (1000 * 3600 * 24);
        return days
    }
}
 $(".reset_class").click(function() {
   var hurl = '<?=base_url()?>reports/bus_staff_reports';
   window.location.href = hurl;
});
</script>
</body>

</html>
