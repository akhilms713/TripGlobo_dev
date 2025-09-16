<?php
$active_domain_modules = $GLOBALS ['CI']->active_domain_modules;
$master_module_list = $GLOBALS ['CI']->config->item ( 'master_module_list' );
if (empty ( $default_view )) {
  $default_view = $GLOBALS ['CI']->uri->segment ( 2 );
}
?>
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
<link type="text/css" rel="stylesheet" href="<?php echo ASSETS; ?>css/bootstrap-datepicker/datepicker3.css?1424887858" />
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/dataTables.tableTools.css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- pankaj start here -->
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
    </style>
    <!-- pankaj end here -->
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
<!--sidebar start-->
<div class="container">
<div class="dashboard_section">
<div class="col-md-12 nopad">
<aside class="aside"> <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?> </aside>
<!--sidebar end--> 




<!--main content start-->
<section id="main-content" class="col-md-12 tab_sty nopad dash-allbok">
<section class="wrapper">

<div class="main-chart col-md-12 cent-block">
    <h3 class="lineth">Account Management</h3>
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
    


            
               

    
    <div class="tab_inside_profile"> 
   <!--  <span class="profile_head">Account Management </span> -->
    
    
        <div class='box-content box-no-padding rowit'>
        
        <div class="top_deposit_div">
        	<div class="col-md-6 nopad">
            <span class="amnbalbl">Balance Amount</span>
            <span class="balncamnt"> <?php  echo (isset($deposit_amount->balance_credit) && $deposit_amount->balance_credit != "" ) ? $deposit_amount->balance_credit : "0.00" ; ?> INR</span>
            
            
            </div>
        </div>    
		<div class="clearfix"></div>
        <div id="advance_search_form_container" class="serch_area_fltr">
   <form action="<?=base_url()?>dashboard/account_statement" method="get" autocomplete="off" class="form-horizontal" role="form">
      <div class="form-group">
         <label class="col-sm-1 control-label"> From </label>                
         <div class="col-sm-2">                    <input type="text" id="created_datetime_from" class="form-control" name="created_datetime_from" placeholder="From Date" value="<?=@$created_datetime_from?>" >                </div>
         <label class="col-sm-1 control-label"> To </label>                
         <div class="col-sm-2">                    <input type="text" id="created_datetime_to" class="form-control disable-date-auto-update" name="created_datetime_to" placeholder="To Date" value="<?=@$created_datetime_to?>" >                </div>
         <!-- <label class="col-sm-1 control-label"> Status </label>                
         <div class="col-sm-2">
            <select class="form-control" name="filter_booking_status">
               <option value="">All</option>
               <option value="BOOKING_CONFIRMED">Confirmed</option>
               <option value="BOOKING_PENDING">Pending</option>
               <option value="BOOKING_CANCELLED">Cancelled</option>
            </select>
         </div> -->
         <div class="col-sm-1">                    <button class="btn btn-success " type="submit">Search</button>                </div>
         <div class="col-sm-1">
            <!-- 
               <a class="btn btn-warning " href="http://192.168.0.83/npro/agent/report/flight"><i class="fa fa-history"></i> Reset All</a>                     -->                     <button class="btn btn-warning reset_class" type="reset">Reset</button>                
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
     <a class="<?=(($today_search == @$_GET['today_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>dashboard/account_statement?today_booking_data=<?=date('Y-m-d')?>">Today Search</a>
       <a class="<?=(($last_today_search == @$_GET['last_day_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>dashboard/account_statement?last_day_booking_data=<?=date('Y-m-d', strtotime('-1 day'))?>">Last Day Search</a>
       <a class="<?=(($last_3_search == @$_GET['prev_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>dashboard/account_statement?prev_booking_data=<?=date('Y-m-d', strtotime('-3 day'))?>">Last 3 Day Search</a>
       <a class="<?=(($last_7_search == @$_GET['prev_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>dashboard/account_statement?prev_booking_data=<?=date('Y-m-d', strtotime('-7 day'))?>">Last 7 Day Search</a>
       <a class="<?=(($last_15_search == @$_GET['prev_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>dashboard/account_statement?prev_booking_data=<?=date('Y-m-d', strtotime('-15 day'))?>">Last 15 Day Search</a>
       <a class="<?=(($last_1m_search == @$_GET['prev_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>dashboard/account_statement?prev_booking_data=<?=date('Y-m-d', strtotime('-1 month'))?>">Last 1 Month Search</a>
       <a class="<?=(($last_3m_search == @$_GET['prev_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>dashboard/account_statement?prev_booking_data=<?=date('Y-m-d', strtotime('-3 month'))?>">Last 3 Month Search</a>
   </div>
</div>
<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="clearfix"></div>
		<div class="table-responsive">		
                <table id="depostDatatable" class="data-table-column-filter table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr class="sortablehed">
                                <th>TX No</th>
                                <th>Date</th>
                                <th>Statement</th>
                                <th>Deposit</th>
                                <th>Withdraw</th>
                                <!-- <th>Balance Amount</th> -->
                                
                            </tr>
                        </thead>
                    
                        <tbody>
                            <?php $count = 1; ?>
                            <?php if(!empty($account_statment_data)): ?>
                            <?php
							 
							 foreach($account_statment_data as $k): ?>
                            <tr>
                                
                                <td><?php echo $k->transaction_number; ?></td>
                                 <td><?php echo date("d-m-Y", strtotime($k->created_date_time)); ?></td>
                                <td><?php echo $k->description; ?></td>
                                <td><?php 
								if($k->transaction_type=='DEPOSIT')
								{
									echo $k->amount; 
								}
								else
								{
									echo '-';
								}
								?></td>
                                <td><?php if($k->transaction_type=='WITHDRAW')
								{
									echo $k->amount; 
								}
								else
								{
									echo '-';
								} ?></td>
                                <!-- <td><?php echo $k->balance_amount; ?></td> -->
                            </tr>
                            <?php $count++; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                       
                    </table>
		</div>
        
        </div>


    <div class="clearfix"></div>
            


              <div id="get_profit_matric"></div>
        </div>      

              
</div>

</section>
</section>
</div>
</div>
</div>
<div class="clearfix"></div>


<!-- Page Content -->
<div class="clearfix"></div>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<?php //echo $this->load->view(PROJECT_THEME.'/new_theme/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>

<!-- Script to Activate the Carousel --> 


</body>
</html>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/dataTables.tableTools.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  var urll = "<?php echo base_url(); ?>";
     var oTable = $('#depostDatatable').dataTable({
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
                            "sSwfPath": urll+"admin-panel/assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf"
                        }
                    });
    
  //BookingPagination();
});
		
	</script>
<style>
#adddeposit {
    display: none;
}
</style>
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
  $(".reset_class").click(function() {
   var hurl = '<?=base_url()?>dashboard/account_statement';
   window.location.href = hurl;
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
        yearRange: "-100:-0"
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
</script>