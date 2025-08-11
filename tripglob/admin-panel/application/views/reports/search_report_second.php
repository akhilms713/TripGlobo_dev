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
      
      <script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>
      <script src="<?php echo ASSETS; ?>js/jquery-1.11.0.js"></script>
      <script src="<?php  echo ASSETS; ?>js/jquery_ui.js"></script>
      <link href="<?php  echo ASSETS; ?>css/jquery_ui.css" rel="stylesheet" type="text/css">
      
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
         mark, .mark {
            background-color: #f1ca0061;
            padding: 0.1em;
        }
      </style>
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
                           Advance Search
                        </h3>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                           <div class="x_content">
                              <div id="advance_search" class="serch_area_fltr">
                                 <form method="GET" id="advance_search_form" autocomplete="off">
                                   <input type="hidden" value="test" name="filter">
                                   <div class="clearfix form-group">
                                      <div class="col-xs-4">
                                          <label>Con. Number</label>
                                          <input type="text" class="form-control" name="con_number" value="<?php echo $searchData['con_number'];?>" placeholder="Con Number">
                                      </div>
                                      <div class="col-xs-4">
                                          <label>PNR</label>
                                          <input type="text" class="form-control" name="pnr" value="<?php echo $searchData['pnr'];?>" placeholder="PNR">
                                       </div>
                                     <!--   <div class="col-xs-4">
                                           <label>Origin</label>
                                           <input type="text" class="form-control numeric fromflight" name="origin" value="<?php echo $searchData['origin'];?>" placeholder="Origin">
                                        </div>
                                      <div class="col-xs-4">
                                          <label>Destination</label>
                                          <input type="text" class="form-control fromflight" name="destination" value="<?php echo $searchData['destination'];?>" placeholder="Destination">
                                      </div>  -->
                                      <div class="col-xs-4">
                                         <label>Agents</label>
                                         <select class="form-control" name="user_id">
                                            <option value="">All</option>
                                            <?php foreach($users as $data){ ?>
                                            <option <?php if($searchData['destination'] == $data->user_id){echo 'selected'; }?> value="<?php echo $data->user_id;?>"><?php echo $data->user_name;?> - <?php echo $data->user_email;?></option>
                                            <?php } ?>
                                         </select>
                                      </div>
                                      <div class="col-xs-4">
                                          <label>Billing Date</label>
                                        
                                            <input id="billing_date" type="text" name="billing_date"  class="form-control col-md-7 col-xs-12" value="<?php echo $searchData['billing_date'];?>" readonly>
                                       
                                        </div>
                                      <div class="col-xs-4">
                                          <label>Booked From Date</label>
                                          <input type="text" readonly="" id="created_datetime_from" class="form-control date_picker" name="created_datetime_from" value="<?php echo $searchData['created_datetime_from'];?>" placeholder="Request Date">
                                          </div>
                                       <div class="col-xs-4">
                                          <label>Booked To Date</label>
                                          <input type="text" readonly="" id="created_datetime_to" class="form-control disable-date-auto-update date_picker" name="created_datetime_to" value="<?php echo $searchData['created_datetime_to'];?>" placeholder="Request Date">
                                        </div>
                                        
                                   </div>
                                   <div class="col-sm-12 well well-sm">
                                       <button type="submit" class="btn btn-primary">Search</button>
                                       <a href="<?php echo base_url(); ?>reports/search_report_second" id="clear-filter" class="btn btn-warning">Reset</a>
                                       <!--<button type="button" class="btn btn-warning" id="btn_reset">Reset</button>-->
                                       
                                    </div>
                                </form>
                              </div>
                         
                              <div class="clearfix"></div>
                              <?php if(!empty($res)){ ?>
                              <div class="table-responsive">
                                 <table id="example" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                       <tr class="headings">
                                          <th>Sl No </th>
                                          <th>Type </th>
                                          <th>Con Reference </th>
                                          <th>Status</th>
                                          <th>Agent Name</th>
                                          <th>Lead Pax details</th>
                                          <th>PNR</th>
                                          <th>From</th>
                                          <th>To</th>
                                          <th>Type</th>
                                          <th>Booked on</th>
                                          <th>Billing Date</th>
                                          <th>Depature Date</th>
                                          <th>Arrival Date</th>
                                         <!--  <th>Api Net Rate</th>
                                          <th>Api Tax</th>
                                          <th>Admin Markup</th>
                                          <th>Agent Markup</th> -->
                                          <th>Total Amount</th>
                                           <th>Action</th> 
                                       </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                          $i=1;
                                          foreach($res as $fd)
                                          {
                                              
                                              

                                        
                                            //  echo "<pre/>";print_r($fd);exit();
                                        ?>
                                       <tr class="even pointer">
                                          <td class=" "><?php echo $i++; ?></td>
                                          <td><?php echo $fd['type']?></td>
                                          <td><?php echo $fd['con_pnr_no']?></td>
                                          <td><span class="<?php echo booking_status_label($fd['booking_status']) ?>"><?php echo $fd['booking_status']?></span></td>
                                          <td><?php echo $fd['user_name'];?></td>
                                          <td><?php echo $fd['leadpax']?></td>
                                          <td><?php echo $fd['pnr_no']?></td>
                                          <td><?php echo $fd['origin']?></td>
                                          <td><?php echo $fd['destination']?></td>
                                          <td><?php echo $fd['mode']?></td>
                                          <td><?php echo $fd['voucher_date']?></td>
                                          <td><?php echo $fd['billing_date']?></td>
                                          <td><?php echo $fd['depart_date']?></td>
                                          <td><?php echo @$fd['return_date']?></td>
                                                                                 <!-- <td><?php echo $fd['api_rate']?></td>
                                          <td><?php echo $fd['api_tax']?></td>
                                          <td><?php echo $fd['admin_markup']?></td>
                                          <td><?php echo $fd['agent_markup'];?></td> -->
                                          <td><?php echo ($fd['total_cost'])?></td>

                                         

                                          <td>
                                            <?php if($fd['pnr_no']):?>
                                                <a class="btn btn-sm btn_action" style="background-color: #fdb813;" href="<?php echo base_url(); ?>reports/view_voucher/<?=base64_encode($fd['pnr_no'])?>/<?=base64_encode($fd['con_pnr_no'])?>"> <i class="fa fa-file" title="View Voucher"></i></a>
                                            <?php endif;?>

                                        </td>

                                       </tr>
                                       <?php
                                        }
                                        ?>
                                    </tbody>
                                 </table>
                                 <?php } else { echo "<h2 style='text-align: center;'> No Result Found! Search Again.</h2>"; } ?>
                              </div>
                              <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                 <div class="modal-dialog modal-lg">
                                    <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL; ?>b2c/send_user_promo">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                             </button>
                                             <h4 class="modal-title" id="myModalLabel">Send Promo Ccde</h4>
                                          </div>
                                          <div class="modal-body">
                                             <div class='form-group'>
                                                <strong>Choose Any One Promo</strong>
                                                <?php $i = 1; foreach ($promo as $promos) { ?>
                                                <label class="control-label" for="validation_promo<?php echo $i; ?>"></label><br>
                                                <div class='radio'>
                                                   <label><input type='radio' data-rule-required='true' id="validation_promo<?php echo $i; ?>" name="promoid" value='<?php echo $promos->promo_id; ?>'>
                                                   <?php echo $promos->promo_code; ?> - <em> <font color="#FF00FD"><?php echo $promos->discount; ?>%</font> discount, valid upto <?php echo date('M j,Y', strtotime($promos->expiry_date)); ?></em>
                                                   </label>
                                                </div>
                                                <?php $i++; } ?>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                             <input type="hidden" name="user_id" id="userid">
                                             <button type="button" class="btn btn-primary">Send Via Email</button>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
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
<script src="<?php echo ASSETS; ?>js/tags/jquery.tagsinput.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/moment.min2.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/datepicker/daterangepicker.js"></script>
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
	    $('#example').DataTable({
	        dom: 'Bfrtip',
	        buttons: [
                'copy', 'csv', 'excel', 
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A3'
                }, 
                'print'
            ]
	    });
	    
	    $(".fromflight").autocomplete({
              source: api_url+"general/get_flight_suggestions",
             minLength: 2,//search after two characters
             autoFocus: true, // first item will automatically be focused
             select: function(event,ui){
                 $(".departflight").focus();
                 //$(".flighttoo").focus();
             }
             
        });
	} );
	</script>
	  <script>
      var api_url='<?php echo WEB_FRONT_URL; ?>';
      
     $( "#created_datetime_from" ).daterangepicker({
       changeMonth: false,
       singleDatePicker: true,
       dateFormat : 'dd-mm-yy',
        calender_style: "picker_4",
       maxDate: 0,
       numberOfMonths: 1,
       onClose: function( selectedDate ) {
         $( "#created_datetime_to" ).daterangepicker( "option", "minDate", selectedDate );
       }
     });
     $( "#created_datetime_to" ).daterangepicker({
       changeMonth: false,
       singleDatePicker: true,
        dateFormat : 'dd-mm-yy',
         calender_style: "picker_4",
       numberOfMonths: 1,
       maxDate: 0,
       onClose: function( selectedDate ) {
         $( "#created_datetime_from" ).datepicker( "option", "maxDate", selectedDate );
       }
     });
     /*var today = new Date();
     $('#billing_date').daterangepicker({
                singleDatePicker: true,
                 minDate:today,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });*/
     
     $( "#billing_date" ).daterangepicker({
       changeMonth: false,
        singleDatePicker: true,
        numberOfMonths: 1,
       maxDate: 0,
       calender_style: "picker_4",
       onClose: function( selectedDate ) {
         
       }
     });
     
     $('#btn_reset').click(function(){
         //alert('test');
            $('#advance_search_form').trigger("reset");
    });
	</script>
	

   </body>
</html>