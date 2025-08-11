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
</head>
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
        .form-horizontal .form-group {
        margin-left: 0px;
        }
        .form-horizontal .control-label {
        text-align: left;
        }
        .advance_search-to{
        padding-left: 22px;
        }
        .advance_search_button{
        padding-left: 22px;
        }
        div.DTTT_container {
        margin-left: 12px;
        }
        .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
        cursor: pointer;
        }
    </style>
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
        <!--sidebar start-->
<aside class="aside"> <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?> </aside>
<!--sidebar end--> 



<div class="clearfix"></div>

<!--main content start-->
<section id="main-content" class="col-md-12 tab_sty nopad dash-allbok">
<section class="wrapper">

<div class="main-chart">


<h3 class="lineth">Profit Matrix</h3>


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
    	<!-- <span class="profile_head">Profit Matrix </span> -->
    
        <div class='box-content box-no-padding rowit'>
        
        <div class="top_deposit_div">
        	<div class="col-md-6 nopad">
            <span class="amnbalbl">Balance Amount</span>
            <span class="balncamnt"> <?php  echo (isset($deposit_amount->balance_credit) && $deposit_amount->balance_credit != "" ) ? $deposit_amount->balance_credit : "0.00" ; ?> INR</span>
            
            
            </div>
        </div>    
            

            <div class="clearfix"></div>
            <div id="advance_search_form_container" class="serch_area_fltr">
   <form action="<?=base_url()?>dashboard/profit_matrix" method="get" autocomplete="off" class="form-horizontal" role="form" id="filterform">
      <div class="form-group">
         <label class="col-sm-1 control-label"> From </label>                
         <div class="col-sm-2">                    <input type="text" id="created_datetime_from" class="form-control" name="created_datetime_from" placeholder="From Date" value="<?=@$created_datetime_from?>" readonly>                </div>
         <label class="col-sm-1 control-label advance_search-to"> To </label>                
         <div class="col-sm-2">                    <input type="text" id="created_datetime_to" class="form-control disable-date-auto-update" name="created_datetime_to" placeholder="To Date" value="<?=@$created_datetime_to?>" readonly>                </div>
        <!--  <label class="col-sm-1 control-label"> Status </label>                
         <div class="col-sm-2">
            <select class="form-control" name="filter_booking_status">
               <option value="">All</option>
               <option value="BOOKING_CONFIRMED">Confirmed</option>
               <option value="BOOKING_PENDING">Pending</option>
               <option value="BOOKING_CANCELLED">Cancelled</option>
            </select>
         </div> -->
         <div class="col-sm-1 advance_search_button">                    <button class="btn btn-success " type="submit">Search</button>                </div>
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
       <a class="<?=(($today_search == @$_GET['today_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>dashboard/profit_matrix?today_booking_data=<?=date('Y-m-d')?>">Today Search</a>
       <a class="<?=(($last_today_search == @$_GET['last_day_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>dashboard/profit_matrix?last_day_booking_data=<?=date('Y-m-d', strtotime('-1 day'))?>">Last Day Search</a>
       <a class="<?=(($last_3_search == @$_GET['prev_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>dashboard/profit_matrix?prev_booking_data=<?=date('Y-m-d', strtotime('-3 day'))?>">Last 3 Day Search</a>
       <a class="<?=(($last_7_search == @$_GET['prev_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>dashboard/profit_matrix?prev_booking_data=<?=date('Y-m-d', strtotime('-7 day'))?>">Last 7 Day Search</a>
       <a class="<?=(($last_15_search == @$_GET['prev_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>dashboard/profit_matrix?prev_booking_data=<?=date('Y-m-d', strtotime('-15 day'))?>">Last 15 Day Search</a>
       <a class="<?=(($last_1m_search == @$_GET['prev_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>dashboard/profit_matrix?prev_booking_data=<?=date('Y-m-d', strtotime('-1 month'))?>">Last 1 Month Search</a>
       <a class="<?=(($last_3m_search == @$_GET['prev_booking_data']) ? 'active' : '')?>" href="<?=base_url()?>dashboard/profit_matrix?prev_booking_data=<?=date('Y-m-d', strtotime('-3 month'))?>">Last 3 Month Search</a>
   </div>
</div>
<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="clearfix"></div>
				
                <div class="table-responsive">
                <table id="profit_table" class="data-table-column-filter table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr class="sortablehed">
                                 <th>Sl No</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Net Rate</th>
                                <th>Margin</th>
                                <th>Selling Rate</th>
                                <th>Discount</th>
                                 <th>Billing Amount</th>
                                  <th>Profit</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                          <?php
						  
						  for($k=0;$k<count($products);$k++)
						  {
                if ($search_status == 1) {
                  $p_data= $this->account_model->get_booking_transaction_products_condition($products[$k]->product_id,$user_id, $condition)->row();
                } else {
                  $p_data= $this->account_model->get_booking_transaction_products($products[$k]->product_id,$user_id)->row();
                }
							
							  ?>
                           
                                  <tr>
                                    <td><?php echo $k+1; ?></td>
                                    <td><a href="javascript:void(0);" onClick="javascript:get_data('<?php echo $products[$k]->product_name; ?>');"><?php echo $products[$k]->product_name; ?></a></td>
                                  <td>
                                      <div class="text-center"><?php echo $p_count[] = $p_data->p_count; ?></div>
                                    </td>
                                    <td>
                                      <div class="text-right"><?php $fn1[] = $f_n =( $p_data->total_amount_c - $p_data->discount_c - $p_data->agent_markup_c); echo $f_n; ?></div>
                                    </td>
                                    <td>
                                      <div class="text-right"><?php echo  $fn2[] = $p_data->agent_markup_c; ?></div>
                                    </td>
                                    <td>
                                      <div class="text-right"><?php  $fn3[] = $f_s  =($p_data->total_amount_c - $p_data->discount_c); echo $f_s; ?></div>
                                    </td>
                                     <td>
                                      <div class="text-right"><?php echo  $fn4[] = $p_data->discount_c; ?></div>
                                    </td>
                                    <td>
                                      <div class="text-right"><?php echo  $fn5[] = $p_data->total_amount_c; ?></div>
                                    </td>
                                     <td>
                                      <div class="text-right"><?php   $fn6[] = $f_p=($p_data->agent_markup_c-$p_data->discount_c); echo $f_p; ?></div>
                                    </td>
                                  </tr>
                                  <?php
						  }
						  ?>
                               <tr>
                                
                                <td align="right" class="tot_1">Total Bookings</td>
                                <td align="right" class="tot_2"></td>
                                <td align="right"  style=" background-color:#ECECEC"><?php echo array_sum($p_count); ?></td>
                                <td align="right"  style=" background-color:#ECECEC"><?php echo array_sum($fn1); ?></td>
                                 <td align="right"  style="background-color:#ECECEC"><?php echo array_sum($fn2); ?></td>
                                 <td align="right"  style="background-color:#ECECEC"><?php echo array_sum($fn3); ?></td>
                                 <td align="right"  style="background-color:#ECECEC"><?php echo array_sum($fn4); ?></td>
                                 <td align="right"  style="background-color:#ECECEC"><?php echo array_sum($fn5); ?></td>
                                 <td align="right"  style="background-color:#ECECEC"><?php echo array_sum($fn6); ?></td> 
                                 
                                 
                            </tr>
                        </tbody>
                       
                    </table>
		</div>
        </div>

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
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>

<!-- Script to Activate the Carousel --> 
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/dataTables.tableTools.js"></script>

</body>
</html>
<script>
$(document).ready(function() {
     var oTable = $('#profit_table').dataTable({
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
                            "sSwfPath": "https://www.provabextranet.com/flyonair/admin-panel/assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf"
                        }
                    });
    
  //BookingPagination();
});
function get_data($product)
{
 $.ajax({
	 
						type: 'POST',
						url: "<?php echo WEB_URL; ?>/dashboard/get_profit_matric/"+$product,
						async: true,
						dataType: 'json',
						 beforeSend: function(){
       $('#get_profit_matric').html('<div class="lodrefrentrev imgLoader" style="display: block;"><div class="centerload"></div></div>');
      },
						success: function(data) {
							$('#get_profit_matric').html(data.result);
							
						}
					
});
}	
	</script>
<style>
  .tot_1{
    border-right:0 !important;
  }
  .tot_2{
    border-left:0 !important;
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
   var hurl = '<?=base_url()?>dashboard/profit_matrix';
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