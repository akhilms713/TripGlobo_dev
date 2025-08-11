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
    <script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
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
                                  Request Remark Reports
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
<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="clearfix"></div>
                                
                           
              <div class="table-responsive" style="width: 100%;overflow-x: scroll;">
                <table class="table table-striped responsive-utilities jambo_table" id="flight_report_pre">
                 <thead>
                    <tr class="headings">
                      <th>Sl.No</th>
                      <th>Request ID</th>
                      <th>Admin Name</th>
                      <th>Remarks</th>
                      <th>Remarks Date</th>
                     </tr>
                 </thead>
                  <tbody> 
                    <?php if($request_remark){  
                        $num = 1; 
                        for($k=0;$k<count($request_remark);$k++){ 
                        $admin_id=$request_remark[$k]['admin_id'];
                        $admin_name=$this->reports_model->get_admin_name($admin_id);
                        $a_name=$admin_name[0]['admin_name'];
                       // echo "<pre/>";print_r($group_report);exit();
                        ?>
                      <tr class="">
                        <td><?php echo $num; ?></td>
                        <td><?php echo $request_remark[$k]['request_id']; ?></td>
                        <td><?php echo $a_name; ?></td>
                         <td><?php echo $request_remark[$k]['remarks']; ?></td>
                        <td><?php echo date('d M Y, h:i A',strtotime($request_remark[$k]['date'])); ?></td>
                       
                        
                      </tr>
                    <?php $num++; } } ?>
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
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

	<script>
	   $(document).ready(function() {
	    $('#flight_report_pre').DataTable( {
	        dom: 'Bfrtip',
	        buttons: [
	            'copy', 'csv', 'excel',{
                extend: 'pdfHtml5',
                orientation: 'portrait',
                pageSize: 'A5'
            }, 'print'
	        ]
	    } );
	} );
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
 $(".reset_class").click(function() {
   var hurl = '<?=base_url()?>reports/group_booking';
   window.location.href = hurl;
});
</script>
</body>

</html>
