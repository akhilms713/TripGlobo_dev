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
      <link href="<?php echo ASSETS; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
      <link href="<?php echo ASSETS; ?>css/animate.min.css" rel="stylesheet">
      <!-- Custom styling plus plugins -->
      <link href="<?php echo ASSETS; ?>css/custom.css" rel="stylesheet">
      <link href="<?php echo ASSETS; ?>css/icheck/flat/green.css" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="<?php echo ASSETS; ?>/css/common/toastr.css?1425466569" />
      <script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>
      <script src="<?php echo ASSETS; ?>js/jquery-1.11.0.js"></script>
      <script src="<?php  echo ASSETS; ?>js/jquery_ui.js"></script>
      <link href="<?php  echo ASSETS; ?>css/jquery_ui.css" rel="stylesheet" type="text/css">
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
                           Top Flight Deals 
                        </h3>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                           <div class="x_title">
                              <h2>Add New Flight Deal <small> </small></h2>
                              <div class="clearfix"></div>
                           </div>
                           <div class="x_content">
                              <form class="form-horizontal form-label-left" novalidate method="post" action="<?php echo WEB_URL; ?>flight_deals/add_flight_deals" enctype="multipart/form-data">
                                <div class="item form-group">
                                    <label class="col-sm-3 control-label">Deal Type</label>                 
                                    <div class="col-md-6 col-sm-6 col-xs-12">                    
                                      <select name="deal_type" class="form-control col-md-7 col-xs-12">
                                        <option value="" data-iconurl="" >Select Type</option>
                                        <option value="DOMESTIC" <?php echo  set_select('deal_type', 'DOMESTIC'); ?> data-iconurl="" >Domestic</option>
                                         <option value="INTERNATIONAL" <?php echo  set_select('deal_type', 'INTERNATIONAL'); ?> data-iconurl="" >International</option>
                                      </select>
                                      <span class="text-danger"><?php echo form_error('deal_type'); ?></span>
                                    </div>
                                </div>

                                 <div class="item form-group">
                                    <label for="City Name" class="control-label col-md-3">From </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                         <input id="from" name="from" type="text" class=" ft fromflight mytextbox iconLoc contr_form form-control col-md-7 col-xs-12" placeholder="From, Airport" style="" value="<?php if(isset($origin)){ echo $origin; } ?>" autoComplete="off" aria-autocomplete="list"/>
                       
                                       <!--<input id="from" type="text" name="from" class="ft fromflight form-control col-md-7 col-xs-12" value="<?php echo set_value('from'); ?>" required="required">-->
                                       <span class="text-danger"><?php echo form_error('from'); ?></span>
                                    </div>
                                 </div>
                                 <div class="item form-group">
                                    <label for="Offer" class="control-label col-md-3">To</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="ft departflight mytextbox iconLoc contr_form pad_twofive form-control col-md-7 col-xs-12" name="to"  id="to"  placeholder="To, Airport" value="<?php echo $destination;?>" autoComplete="off" aria-autocomplete="list" type="text" />
                      
                                       <!--<input id="to" type="text" name="to" class="ft fromflight form-control col-md-7 col-xs-12" value="<?php echo set_value('to'); ?>" required="required">-->
                                       <span class="text-danger"><?php echo form_error('to'); ?></span>
                                    </div>
                                 </div>
                                    <div class="item form-group">
                                    <label for="" class="control-label col-md-3 col-sm-3 col-xs-12">Deal Start</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                         <input id="single_cal4" type="text" name="deal_start"  class="form-control col-md-7 col-xs-12" value="" required="required" readonly>
                                         </div>
                                    </div>
                                    <div class="item form-group">
                                    <label for="Check-out" class="control-label col-md-3 col-sm-3 col-xs-12">Deal End</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="single_cal5" type="text" name="deal_end"  class="form-control col-md-7 col-xs-12" value="" required="required" readonly>
                                       
                                    </div>
                                    </div>
                                    
                                     <div class="item form-group">
                                    <label for="Check-out" class="control-label col-md-3 col-sm-3 col-xs-12">Airline</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="ft form-control select2" name="airline">
                                            <option value="">Select</option>
                                            <?php foreach($airline as $airlinedata){ ?>
                                                <option value="<?php echo $airlinedata->airline_code; ?>"><?php echo $airlinedata->airline_name; ?></option>
                                            <?php } ?>
                                        </select>
                                       
                                    </div>
                                    </div>
                                    
                                    
                                 <div class="item form-group">
                                    <label for="price" class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="price" type="number" name="price" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('price'); ?>" required="required">
                                        <span class="text-danger"><?php echo form_error('price'); ?></span>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label for="price" class="control-label col-md-3 col-sm-3 col-xs-12">Offer Text</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="offer_text" type="text" name="offer_text" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('offer_text'); ?>" required="required">
                                        <span class="text-danger"><?php echo form_error('offer_text'); ?></span>
                                    </div>
                                </div>
                                 <div class="item form-group">
                                    <label for="hotel_image" class="control-label col-md-3 col-sm-3 col-xs-12">Flight Deal Photo</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <input  type="file" name="deal_image" id="deal_image" class="form-control col-md-7 col-xs-12">
                                       <span class="text-danger"><?php echo form_error('deal_image'); ?></span>
                                       <p class="upload_details">Width:500px and Height:700px (High Resolution)</p>
                                    </div>
                                 </div>
                                 <div class="ln_solid"></div>
                                 <div class="form-group">
                                    <div class="col-md-3 col-md-offset-3">
                                       <a href="javascript:history.back()"  class="btn btn-primary ad-cancel">Cancel</a>                                                
                                       <button id="send" type="submit" class="btn btn-success">Save</button>
                                    </div>
                                 </div>
                              </form>
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
    
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/moment.min2.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/datepicker/daterangepicker.js"></script>
    <!-- icheck -->
    <script src="<?php echo ASSETS; ?>js/icheck/icheck.min.js"></script> 
    <script src="<?php echo ASSETS; ?>js/tags/jquery.tagsinput.min.js"></script>
    <script src="<?php echo ASSETS; ?>js/custom.js"></script>
     <!--<script src="<?php echo ASSETS; ?>js/custom_modified.js"></script>-->
     <script type="text/javascript" src="https://tripglobo.com/beta1/assets/theme_dark/js/custom_modified.js"></script>
    <!-- form validation -->
    <script src="<?php echo ASSETS; ?>js/validator/validator.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
	<script>
	     $(document).ready(function(){
	         $(".select2").select2();
	     });
	</script>
    
      <script type="text/javascript">
         var api_url='<?php echo WEB_FRONT_URL; ?>';
         // room adding for hotel
           function show_room_info(room_count,divid){
             if(room_count==''){
               room_count=0;
             }
             if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
               xmlhttp=new XMLHttpRequest();
             }else{// code for IE6, IE5
               xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
             }
             xmlhttp.onreadystatechange=function(){
               if (xmlhttp.readyState==4 && xmlhttp.status==200){
                 document.getElementById(divid).innerHTML=xmlhttp.responseText;
               }
             }
             xmlhttp.open("GET",api_url+"hotel/adult_child_binding_m/"+room_count,true);
             xmlhttp.send();
           }
           
           
         $(document).ready(function(){
         /* flight */  
           
             $(function() {
           $(".fromflight").autocomplete({
              source: api_url+"general/get_flight_suggestions",
             minLength: 2,//search after two characters
             autoFocus: true, // first item will automatically be focused
             select: function(event,ui){
                 $(".departflight").focus();
                 //$(".flighttoo").focus();
             }
             
           });
          
           $(".departflight").autocomplete({
            source: api_url+"general/get_flight_suggestions",
             minLength: 2,//search after two characters
             autoFocus: true, // first item will automatically be focused
             select: function(event,ui){
                 $("#depature").focus();
             }
           });
         
          $("#swap").on('click', function() {
             var from = $('#from').val();
           var destination = $('#to').val();
           $('#from').val(destination);
           $('#to').val(from);
             }); 
         
         
           var windowidth = $(window).width();
           if(windowidth > 768){
             set_datepickerval(2);
           }else{
             set_datepickerval(1);
           }
          
         });
         
         </script>
      <script>
         (function($) {
           
         
           'use strict';
         
           $(document).on('show.bs.tab', '.nav-tabs-responsive [data-toggle="tab"]', function(e) {
             var $target = $(e.target);
             var $tabs = $target.closest('.nav-tabs-responsive');
             var $current = $target.closest('li');
             var $parent = $current.closest('li.dropdown');
             $current = $parent.length > 0 ? $parent : $current;
             var $next = $current.next();
             var $prev = $current.prev();
             var updateDropdownMenu = function($el, position){
               $el
                 .find('.dropdown-menu')
                 .removeClass('pull-xs-left pull-xs-center pull-xs-right')
                 .addClass( 'pull-xs-' + position );
             };
         
             $tabs.find('>li').removeClass('next prev');
             $prev.addClass('prev');
             $next.addClass('next');
             
             updateDropdownMenu( $prev, 'left' );
             updateDropdownMenu( $current, 'center' );
             updateDropdownMenu( $next, 'right' );
           });
         
         })(jQuery);
      </script>
       <script>
        var today = new Date(); 
       $('#single_cal4').daterangepicker({
                singleDatePicker: true,
                 minDate:today,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            
            $('#single_cal5').daterangepicker({
                singleDatePicker: true,
                 minDate:today,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
       </script>
      
      
      
      
      
      <script>
          $(function() {
         $( "#deal_start" ).datepicker({
            minDate: 0,
           defaultDate: "+1w",
           changeMonth: false,
         dateFormat : 'dd-mm-yy',
           numberOfMonths: 1,
           onClose: function( selectedDate ) {
             $( "#deal_end" ).datepicker( "option", "minDate", selectedDate );
           }
         });
         $( "#deal_end" ).datepicker({
           defaultDate: "+1w",
           changeMonth: false,
             dateFormat : 'dd-mm-yy',
           numberOfMonths: 1,
           onClose: function( selectedDate ) {
             //$( "#deal_start" ).datepicker( "option", "maxDate", selectedDate );
           }
         });
        });
      </script>
   </body>
</html>