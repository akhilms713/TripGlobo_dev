<?php
   //echo "<pre>"; print_r($tophotels); echo "</pre>"; die();
   
   ?>
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
         .newd_maisn_curtnd{height: 470px; max-height: 100%;} 
         .popover {
            max-width: 470px !important;
          }
          .popoverBTN{
            font-size: 16px;
          }  
      </style>
      <script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>
      <!--[if lt IE 9]>
      <script src="../assets/js/ie8-responsive-file-warning.js"></script>
      <![endif]-->
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="nav-md">
      <div class="container body">
         <div class="main_container">
            <!-- top navigation -->
            <?php echo $this->load->view('common/sidebar_menu'); ?>
            <?php echo $this->load->view('common/top_menu'); ?>
            <!-- /top navigation -->
            <!-- page content -->
            <div class="right_col" role="main">
               <div class="">
                  <div class="page-title">
                     <div class="title_left">
                        <h3>
                           Flight Hit Report
                        </h3>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                           <div class="x_content">
                              <table id="example" class="table table-striped responsive-utilities jambo_table">
                                 <thead>
                                    <tr class="headings">
                                       <th>Sl No </th>
                                       <!--<th>Trip Type </th>-->
                                       <th>Check From</th>
                                       <th>Check To</th>
                                       <!-- <th>cehck_both</th> -->
                                       <th>Count</th>
                                       <!--<th class="text-center">Info</th>-->
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $j=1;
                                       if(!empty($report))
                                       {
                                       foreach($report as $row)
                                       { ?>
                                      <tr class="even pointer">
                                         <td class=" "><?php echo $j; ?></td>
                                        <!-- <td><?=$row['main']->trip_type?></td>-->
                                         <td><?=$row['main']->cehck_from?></td>
                                         <td><?=$row['main']->cehck_to?></td>
                                         <!-- <td><?=$row->cehck_both?></td> -->
                                         <td><?=$row['main']->hit_count?></td>
                                    </tr>
                                    <?php $j++; } } ?>
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

<script>
   $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                }, 'print'
        ]
    } );
} );
</script>

      <script>
         $('.whiteip1').on('click', function() {
             
                 var curEle = $(this);
                 var id1 = $(this).data('alert_id1');
                 var status1 = $('#alert_status_'+id1).val();
         
                 
                 if(status1=='ACTIVE' || status1=='INACTIVE')
                 {
                 $('#whiteip_load1'+id1).fadeIn();
                 if(id1) {
                     _id1 = id1.toString().trim();
                 }
                 
                     _status1 = status1.toString().trim();
             if(_status1=='INACTIVE')
             {
                 var s_status1 = 'ACTIVE';
             }
             else
             {
                 var s_status1 = 'INACTIVE';
             }
             
                 if(_id1.toString().length > 0 && !isNaN(_id1)) {
                         
                     $.ajax({
                         url: '<?php echo WEB_URL; ?>airport_management/update_airport_status/',
                         type: "get",
                         data: {id: _id1,status: s_status1},
                         dataType: 'json',
                         success: function(result) {
                              $('#alert_status_'+id1).val(s_status1);
                             $('#whiteip_load1'+id1).fadeOut();
                         }
                     });
                 } else {
                     
                 }
                 }
             });
         //$(document).ready(function(){
         $('.popoverBTN').mouseover(function(){
              var id = $(this).attr('id');
              $(this).data('placement', 'left');
              $(this).popover({
                  html: true, 
                  content: function() {
                    return $('#popover-content-'+id).html();
                  }
              });
          });
         //});
             
      </script>
   </body>
</html>