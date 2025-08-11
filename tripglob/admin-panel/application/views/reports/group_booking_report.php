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
@media print{
    table td:nth-child(3),
    table th:nth-child(3) {
     display:none;
    }
    table td:nth-child(4),
    table th:nth-child(4) {
     display:none;
    }
    table td:nth-child(6),
    table th:nth-child(6) {
     display:none;
    }
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
                                  Group Booking Reports
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
    <form action="<?=base_url()?>reports/group_booking" method="post" autocomplete="off" class="form-horizontal" role="form">
      <div class="form-group mT15">
        
        <label class="col-sm-2 control-label">Enquiry From </label>                
        <div class="col-sm-2">
          <input type="text" id="created_datetime_from" class="form-control" name="created_datetime_from" placeholder="From Date" value="<?php if($filter_data['created_datetime_from']){echo $filter_data['created_datetime_from'];} ?>" readonly>                
        </div>
         
        <label class="col-sm-1 control-label">Enquiry To </label>                
        <div class="col-sm-2">                    
          <input type="text" id="created_datetime_to" class="form-control disable-date-auto-update" name="created_datetime_to" placeholder="To Date" value="<?php if($filter_data['created_datetime_to']){echo $filter_data['created_datetime_to'];} ?>" readonly>
        </div>

        <label class="col-sm-1 control-label"> Agent List </label>                
        <div class="col-sm-2">
          <select class="form-control" name="agent_list">
             <option value="">All</option>
             <?php foreach ($agent_list as $key => $agents) { ?>
              <option value="<?php echo $agents['agent_id']; ?>" <?php if($filter_data['agent_list']){ if($filter_data['agent_list']==$agents['agent_id']){echo 'selected';}} ?> ><?php echo $agents['agent_name'].' ('.$agents['agent_email'].')'; ?></option> 
             <?php } ?>
          </select>
        </div>

        <div class="col-sm-1">                    
          <button class="btn btn-success " type="submit">Search</button>               
        </div>
        <div class="col-sm-1">                     
          <button class="btn btn-warning reset_class" type="reset">Reset</button>                
        </div>
      </div>
    </form>
  </div>


<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="clearfix"></div>
                                
                           
              <div class="table-responsive" style="width: 100%;overflow-x: scroll;">
                <table class="table table-striped responsive-utilities jambo_table" id="flight_report_pre">
                 <thead>
                    <tr class="headings">
                      <th>S.No</th>
                      <th>GB ID</th>
                      <th>Agent Name</th>
                      <th>Agent Email</th>
                      <th>Agent Contact</th>
                      <th>Trip Type</th>
                      <th>Origin</th>
                      <th>Destination</th>
                      <th>Departure Date</th>
                      <th>Return Date</th>
                      <th>Total Pax</th>
                      <th>Adult Count</th>
                      <th>Child Count</th>
                      <th>Infant Count</th>
                      <th>Cabin Class</th>
                      <th>Airline</th>
                      <th>Enquiry Date</th>
                      <th>Remarks</th>
                      <th>Actions</th>
                    </tr>
                 </thead>
                  <tbody> 
                    <?php if($group_report){  $num = 1; for($k=0;$k<count($group_report);$k++){ 
                        // echo "<pre/>";print_r($group_report);exit();
                      $data_request_decode=json_decode($group_report[$k]['request'],true);
                    ?>
                      <tr class="">
                        <td><?php echo $num; ?></td>
                        <td><?php echo $group_report[$k]['gb_id']; ?></td>
                        
                        <td><?php echo $group_report[$k]['agent_name']; ?></td>
                        <td><?php echo $group_report[$k]['agent_email']; ?></td>
                        <td><?php echo $group_report[$k]['agent_phone']; ?></td>
                        <td><?php if(strtoupper($data_request_decode['trip_type'])=='ROUND'){echo 'ROUNDWAY';}else{echo 'ONEWAY';} ?></td>
                        <td><?php echo $data_request_decode['from']; ?></td>
                        <td><?php echo $data_request_decode['to']; ?></td>
                        <td><?php echo date('d M Y',strtotime($data_request_decode['depature'])); ?></td>
                        <td><?php if(strtoupper($data_request_decode['trip_type'])=='ROUND'){ echo date('d M Y',strtotime($data_request_decode['return']));}else{echo ' -- ';} ?></td>
                        <td><?php echo $data_request_decode['adult']+$data_request_decode['child']+$data_request_decode['infant']; ?></td>
                        <td><?php echo $data_request_decode['adult']; ?></td>
                        <td><?php echo $data_request_decode['child']; ?></td>
                        <td><?php echo $data_request_decode['infant']; ?></td>
                        <td><?php echo $data_request_decode['class2']; ?></td>
                        <td><?php if($data_request_decode['airlines']!='0'){  $airline_name=$this->reports_model->get_airline_name($data_request_decode['airlines']);
                        echo $airline_name .'('.$data_request_decode['airlines'].')';}else{echo ' -- ';} ?></td>
                        <td><?php echo date('d M Y, h:i A',strtotime($group_report[$k]['insertion_time'])); ?></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#list_remark<?php echo $k; ?>" class="btn btn-primary btn-xs has-tooltip" data-placement='top' title='Update remark'><span class="glyphicon glyphicon-info-sign"></span></a>
                            <div class="modal fade" id="list_remark<?php echo $k; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Update Remark</h4>
                                  </div>
                                    <form action="<?=base_url()?>reports/update_remark" method="POST" autocomplete="off" class="form-horizontal" role="form">
                                        <input type="hidden" value="<?php echo base64_encode(json_encode($group_report[$k]['id'].'-brk-'.$group_report[$k]['gb_id'])); ?>" name="gb_id">
                                      <div class="modal-body">
                                        <div class='err_cont'>
                                            <textarea name="remarks" required placeholder="No remark found !!" style="width: 575px; height: 353px;"><?php if($group_report[$k]['remarks']!=''){echo $group_report[$k]['remarks'];}?></textarea>
                                        </div>                                        
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" class="btn btn-default">Update Remark</button>
                                      </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                        </td>
                        
                        <td>
                            
                            <?php if($group_report[$k]['remarks']!=''){ ?>
                            <a class="btn btn-primary btn-xs has-tooltip" href="<?php echo base_url(); ?>reports/gb_history/<?php echo base64_encode(json_encode($group_report[$k]['id'].'-brk-'.$group_report[$k]['gb_id'])); ?>" data-placement='top' title='GB Remark History' onclick="return confirm('Are you sure ,you want to See the history remark?')"> <span class="glyphicon glyphicon-book"></span></a>
                            
                               <!-- <a class="btn btn-primary btn-xs has-tooltip" href="<?php echo base_url(); ?>reports/delete_gb_remark/<?php echo base64_encode(json_encode($group_report[$k]['id'].'-brk-'.$group_report[$k]['gb_id'])); ?>" data-placement='top' title='Delete remark' onclick="return confirm('Are you sure ,you want to reset remark?')"> <span class="glyphicon glyphicon-trash"></span></a> !-->
                            <?php }else{ echo " -- ";} ?>
                        </td>
                        
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

	<script>
	   $(document).ready(function() {
	    $('#flight_report_pre').DataTable( {
	        dom: 'Bfrtip',
	        buttons: [
	            'copy', 'csv', 'excel',{
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A2'
                }, 'print'
	        ]
	    } );
	} );
	</script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        $("body").on("click", ".buttons-pdf", function () {
            html2canvas($('#flight_report_pre')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500,
                          
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("TripGlobo.pdf");
                }
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
   var hurl = '<?=base_url()?>reports/group_booking';
   window.location.href = hurl;
});
</script>
</body>

</html>
