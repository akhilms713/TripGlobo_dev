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
         mark, .mark {
            background-color: #f1ca0061;
            padding: 0.1em;
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
                              <div class="clearfix">
                                 <span style="color: red;">You can search with following inputs CON Reference Number Wise, Booking Status Wise,Pnr Wise,Lead Pax Wise,Booked ON Date Wise(YYYY-MM-DD).</span> 
                                  
                              </div>
                              <div id="advance_search_form_container" class="serch_area_fltr">
                                 <form action="" method="post" autocomplete="off" class="form-horizontal" role="form">
                                    <div class="form-group mT15">
                                       <label class="col-sm-2 control-label">  </label>                
                                       <div class="col-sm-6">
                                          <input type="text" id="" class="form-control" name="searchData" placeholder="Search Query" value="<?=@$searchData?>">
                                       </div>
                                       
                                       <div class="col-sm-1">
                                          <button class="btn btn-success " type="submit">Search</button>
                                        </div>
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
                                          <th>Depature Date</th>
                                          <th>Arrival Date</th>
                                          <!-- <th>Api Net Rate</th>
                                          <th>Api Tax</th>
                                          <th>Admin Markup</th>
                                          <th>Agent Markup</th> -->
                                          <th>Total Amount</th>
                                          <!-- <th>Action</th> -->
                                       </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                          $i=1;
                                          foreach($res as $fd)
                                          {
                                              
                                              
                                             // echo "<pre/>";print_r($fd);exit();
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
                                          <td><?php echo $fd['depart_date']?></td>
                                          <td><?php echo @$fd['return_date']?></td>
                                        
                                          <!-- <td><?php echo $fd['api_rate']?></td>
                                          <td><?php echo $fd['api_tax']?></td>
                                          <td><?php echo $fd['admin_markup']?></td>
                                          <td><?php echo $fd['agent_markup'];?></td> -->
                                          <td><?php echo ($fd['total_cost'])?></td>

                                         
                                          <?php /* ?>
                                          <td>
                                             <?php if($fd['pnr_no']):?>
                                             <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>reports/view_voucher/<?=base64_encode($fd['pnr_no'])?>/<?=base64_encode($fd['con_pnr_no'])?>"> <i class="fa fa-file" title="View Voucher"></i></a>
                                             <a   data-pnr="<?=$fd['pnr_no']?>" 
                                                data-con-pnr ="<?=$fd['con_pnr_no']?>"
                                                data-recipient_email="<?=$fd['billing_email']?>" class="send_email_voucher btn btn-sm btn-primary"> <i class="fa fa-envelope" title="Send Email"></i></a>
                                             <?php endif;?>
                                             <?php /*?>  <a href="<?php echo WEB_URL; ?>b2c/send_email_to_user/<?php echo $user->user_id; ?>"> <i class="fa fa-envelope" title="Send Email"></i></a>
                                             <a data-toggle="modal" data-target=".bs-example-modal-lg"  onClick="get_user_id('<?php echo $user->user_id; ?>')">    <i class="fa fa-gift" title="Send Promo"></i></a><?php *
                                             #>
                                          </td>
                                          <?php */?>

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

	<script>
	   $(document).ready(function() {
	    $('#example').DataTable( {
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
	    } );
	} );
	</script>

   </body>
</html>