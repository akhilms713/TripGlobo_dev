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
                            Update Special Trip
                        </h3>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                           <div class="x_title">
                              <h2>Update Special Trip<small> </small></h2>
                              <div class="clearfix"></div>
                           </div>
                           <div class="x_content">
                              <form class="form-horizontal form-label-left"  method="post" action="<?php echo WEB_URL; ?>special_trip/update_flight_trip/<?php echo $flight_details->flight_trip_id; ?>" enctype="multipart/form-data" enctype="multipart/form-data">
                                  <div class="item form-group">
                                            <label for="fname" class="control-label col-md-3">Module Name</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control" name="moduleName">
                                                   <option value="">Select Module</option>
                                                   <option value="Flight" selected>Flight</option>
                                                   <!--<option value="Hotel">Hotel</option>-->
                                                   <!--<option value="Bus">Bus</option>-->
                                                   
                                               </select>
                                            </div>
                                        </div>
                                          <div class="item form-group">
                                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Stops</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                   <select id="stops" class="form-control" name="stops" onclick="addStops(this.value)">
                                                   <option>Select Stops</option>
                                                 
                                                   <option value="0" <?php if($flight_details->stops=='0'){ echo "selected";}?>>0</option>
                                                   <option value="1" <?php if($flight_details->stops=='1'){ echo "selected";}?>>1</option>
                                                   <option value="2" <?php if($flight_details->stops=='2'){ echo "selected";}?>>2</option>
                                                   
                                               </select>
                                                     </div>
                                        </div>
                                       <?php $from=json_decode($flight_details->from_location);
                                        $to=json_decode($flight_details->to_location);
                                        $departure_date=json_decode($flight_details->departure_date);
                                        $arrival_date=json_decode($flight_details->arrival_date);
                                        $start_time=json_decode($flight_details->start_time);
                                        $end_time=json_decode($flight_details->end_time);
                                        $timed0 = strtotime($departure_date[0]);
                                         $departure_date0 = date('d-m-Y',$timed0);
                                         $timed1 = strtotime($departure_date[1]);
                                         $departure_date1 = date('d-m-Y',$timed1);
                                          $timed2 = strtotime($departure_date[2]);
                                         $departure_date2 = date('d-m-Y',$timed2);
                                         $timea1 = strtotime($arrival_date[0]);
                                         $arrival_date0 = date('d-m-Y',$timea1);
                                         $timea2 = strtotime($arrival_date[1]);
                                         $arrival_date1 = date('d-m-Y',$timea2);
                                          $timea3 = strtotime($arrival_date[2]);
                                         $arrival_date2 = date('d-m-Y',$timea3);



                                        //echo $arrival_date0;exit();
                                        ?>

                                 <div class="item form-group">
                                    <label for="City Name" class="control-label col-md-3">From </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                         <input id="from" name="from[]" type="text" class=" ft fromflight mytextbox iconLoc contr_form form-control col-md-7 col-xs-12" placeholder="From, Airport" style="" value="<?php echo $from[0] ?>" autoComplete="off" aria-autocomplete="list"/>
                                  <span class="text-danger"><?php echo form_error('from'); ?></span>
                                    </div>
                                 </div>
                                 <div class="item form-group">
                                    <label for="Offer" class="control-label col-md-3">To</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="ft departflight mytextbox iconLoc contr_form pad_twofive form-control col-md-7 col-xs-12" name="to[]"  id="to"  placeholder="To, Airport" value="<?php echo $to[0];?>" autoComplete="off" aria-autocomplete="list" type="text" />
                                   <span class="text-danger"><?php echo form_error('to'); ?></span>
                                    </div>
                                 </div>
                                    <div class="item form-group">
                                    <label for="" class="control-label col-md-3 col-sm-3 col-xs-12">Departure Date</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                         <input id="single_cal4" type="text" name="departure_date[]"  class="form-control col-md-7 col-xs-12" value="<?php echo $departure_date0;?>" required="required" readonly>
                                         </div>
                                    </div>
                                    <div class="item form-group">
                                    <label for="Check-out" class="control-label col-md-3 col-sm-3 col-xs-12">Arrival Date</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="single_cal5" type="text" name="arrival_date[]"  class="form-control col-md-7 col-xs-12" value="<?php echo $arrival_date0;?>" required="required" readonly >
                                       
                                    </div>
                                    </div>
                                    <div class="item form-group">
                                            <label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Start Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="departure" type="time" name="start_time[]"  class="form-control col-md-7 col-xs-12" required="required" placeholder="Start Time" value="<?php echo $start_time[0];?>">
                                            </div>  
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">End Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="arrival" type="time" name="end_time[]" class="form-control col-md-7 col-xs-12" required="required" placeholder="End Time" value="<?php echo $end_time[0];?>">
                                            </div>
                                        </div>
                                    <div class="item form-group">
                                            <label for="city_name" class="control-label col-md-3 col-sm-3 col-xs-12">Airline</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <select class="form-control select22" name="airline[]">
                                                     <option value="">Select Airline</option>
                                                        <?php foreach($airline_list as $a_value):?>
                                                         <option value="<?=$a_value['airline_list_id']?>" <?php if($a_value['airline_name']==$airlineName[0]->airline_name){ echo "selected";}?>><?=$a_value['airline_name']?></option>
                                              
                                                    <?php endforeach;?>
                                                 </select>
                                            </div>  
                                        </div>

                                    <div class="add_flight_1" style="display:none;">
                                       <div class="item form-group">
                                    <label for="City Name" class="control-label col-md-3">From </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                         <input id="from" name="from[]" type="text" class=" ft fromflight mytextbox iconLoc contr_form form-control col-md-7 col-xs-12" placeholder="From, Airport" style="" value="<?php echo $from[1] ?>" autoComplete="off" aria-autocomplete="list"/>
                                  <span class="text-danger"><?php echo form_error('from'); ?></span>
                                    </div>
                                 </div>
                                 <div class="item form-group">
                                    <label for="Offer" class="control-label col-md-3">To</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="ft departflight mytextbox iconLoc contr_form pad_twofive form-control col-md-7 col-xs-12" name="to[]"  id="to"  placeholder="To, Airport" value="<?php echo $to[1] ?>" autoComplete="off" aria-autocomplete="list" type="text" />
                                   <span class="text-danger"><?php echo form_error('to'); ?></span>
                                    </div>
                                 </div>
                                    <div class="item form-group">
                                    <label for="" class="control-label col-md-3 col-sm-3 col-xs-12">Departure Date</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                         <input id="single_cal6" type="text" name="departure_date[]"  class="form-control col-md-7 col-xs-12" value="<?php if ($departure_date1<= date('d-m-Y')) {
                                        echo date('d-m-Y');
                                    }else{
                                        echo $departure_date1;
                                    }
                                    ?>" required="required" readonly>
                                         </div>
                                    </div>
                                    <div class="item form-group">
                                    <label for="Check-out" class="control-label col-md-3 col-sm-3 col-xs-12">Arrival Date</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="single_cal7" type="text" name="arrival_date[]"  class="form-control col-md-7 col-xs-12" value="<?php if ($arrival_date1<= date('d-m-Y')) {echo date('d-m-Y');}else{ echo $arrival_date1;}?>" required="required" readonly >
                                       
                                    </div>
                                    </div>
                                    <div class="item form-group">
                                            <label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Start Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="departure" type="time" name="start_time[]"  class="form-control col-md-7 col-xs-12" required="required" placeholder="Start Time" value="00:00">
                                            </div>  
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">End Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="arrival" type="time" name="end_time[]" class="form-control col-md-7 col-xs-12" required="required" placeholder="End Time" value="00:00">
                                            </div>
                                        </div>
                                    <div class="item form-group">
                                            <label for="city_name" class="control-label col-md-3 col-sm-3 col-xs-12">Airline</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <select class="form-control select22" name="airline[]" style="width:100%">
                                                     <option>Select Airline</option>
                                                        <?php foreach($airline_list as $a_value):?>
                                                        <option value="<?=$a_value['airline_list_id']?>"><?=$a_value['airline_name']?></option>
                                                    <?php endforeach;?>
                                                 </select>
                                            </div>  
                                        </div>
                                    </div>
                                   <div  class="add_flight_2" style="display:none;">
                                         <div class="item form-group">
                                    <label for="City Name" class="control-label col-md-3">From </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                         <input id="from" name="from[]" type="text" class=" ft fromflight mytextbox iconLoc contr_form form-control col-md-7 col-xs-12" placeholder="From, Airport" style="" value="<?php echo $from[2] ?>" autoComplete="off" aria-autocomplete="list"/>
                                  <span class="text-danger"><?php echo form_error('from'); ?></span>
                                    </div>
                                 </div>
                                 <div class="item form-group">
                                    <label for="Offer" class="control-label col-md-3">To</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="ft departflight mytextbox iconLoc contr_form pad_twofive form-control col-md-7 col-xs-12" name="to[]"  id="to"  placeholder="To, Airport" value="<?php echo $to[2] ?>" autoComplete="off" aria-autocomplete="list" type="text" />
                                   <span class="text-danger"><?php echo form_error('to'); ?></span>
                                    </div>
                                 </div>
                                    <div class="item form-group">
                                    <label for="" class="control-label col-md-3 col-sm-3 col-xs-12">Departure Date</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                         <input id="single_cal8" type="text" name="departure_date[]"  class="form-control col-md-7 col-xs-12" value="<?php if ($departure_date2<= date('d-m-Y')){echo date('d-m-Y');}else{echo $departure_date2;}?>" required="required" >
                                    </div>
                                    </div>
                                    <div class="item form-group">
                                    <label for="Check-out" class="control-label col-md-3 col-sm-3 col-xs-12">Arrival Date</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="single_cal9" type="text" name="arrival_date[]"  class="form-control col-md-7 col-xs-12" value="<?php if ($arrival_date2<= date('d-m-Y')) {echo date('d-m-Y');}else{
                                        echo $arrival_date2;
                                    }
                                    ?>" required="required" readonly >
                                       
                                    </div>
                                    </div>
                                    <div class="item form-group">
                                            <label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Start Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="departure" type="time" name="start_time[]"  class="form-control col-md-7 col-xs-12" required="required" placeholder="Start Time" value="00:00">
                                            </div>  
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">End Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="arrival" type="time" name="end_time[]" class="form-control col-md-7 col-xs-12" required="required" placeholder="End Time" value="00:00">
                                            </div>
                                        </div>
                                    <div class="item form-group">
                                            <label for="city_name" class="control-label col-md-3 col-sm-3 col-xs-12">Airline</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <select class="form-control select22" name="airline[]" style="width:100%">
                                                     <option>Select Airline</option>
                                                        <?php foreach($airline_list as $a_value):?>
                                                        <option value="<?=$a_value['airline_list_id']?>"><?=$a_value['airline_name']?></option>
                                                    <?php endforeach;?>
                                                 </select>
                                            </div>  
                                        </div>
                                   </div> 
                                  <div class="" id="addModuleField"></div>
                                        <div class="item form-group">
                                            <label for="zip_code" class="control-label col-md-3 col-sm-3 col-xs-12">Amount</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="amount" type="number" name="amount" class="form-control col-md-7 col-xs-12" required="required" placeholder="Amount" value="<?php echo $flight_details->amount; ?>" >
                                            </div>
                                        </div>
<div class="item form-group">
                                            <img src="https://tripglobo.com/admin-panel/uploads/special_trip/<?=$flight_details->flight_image?>" alt="no images" style="width:10%">
                                        </div>
                                        <div class="item form-group">
                                            <label for="zip_code" class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="" type="file" name="image" class="form-control col-md-7 col-xs-12" required="required" placeholder="">
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
    <script src="<?php echo ASSETS; ?>/js/toastr/toastr.js"></script>
    <script src="<?php echo ASSETS; ?>js/custom.js"></script>
     <!--<script src="<?php echo ASSETS; ?>js/custom_modified.js"></script>-->
     <script type="text/javascript" src="https://tripglobo.com/beta1/assets/theme_dark/js/custom_modified.js"></script>
    <!-- form validation -->
    <script src="<?php echo ASSETS; ?>js/validator/validator.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
	<script>
	     $(document).ready(function(){
	         $(".select22").select2();
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
           $("").autocomplete({
              source: api_url+"general/get_flight_suggestions",
             minLength: 2,//search after two characters
             autoFocus: true, // first item will automatically be focused
             select: function(event,ui){
                 $(".departflight").focus();
                 //$(".flighttoo").focus();
             }
             
           });
          
           $("").autocomplete({
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
              var today = new Date(); 
       $('#single_cal6').daterangepicker({
                singleDatePicker: true,
                 minDate:today,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            
            $('#single_cal7').daterangepicker({
                singleDatePicker: true,
                 minDate:today,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
              var today = new Date(); 
       $('#single_cal8').daterangepicker({
                singleDatePicker: true,
                 minDate:today,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            
            $('#single_cal9').daterangepicker({
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
      <script>
    function addStops(val)
    {
      if (val == 0) {
        $(".add_flight_1").hide();
        $(".add_flight_2").hide();
      } else if (val == 1) {
        $(".add_flight_1").show();
        $(".add_flight_2").hide();
      } else if (val == 2) {
        $(".add_flight_1").show();
        $(".add_flight_2").show();
      } else {
        $(".add_flight_1").hide();
        $(".add_flight_2").hide();
      }

        
    }

</script>
   <script type="text/javascript">

<?php if($this->session->flashdata('success')){ ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
<?php }else if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
<?php } ?>

</script>
<script type="text/javascript">
     $(document).ready(function(){
        var val = $('#stops').val();
        console.log(val);
     if (val == 0) {
        $(".add_flight_1").hide();
        $(".add_flight_2").hide();
      } else if (val == 1) {
        $(".add_flight_1").show();
        $(".add_flight_2").hide();
      } else if (val == 2) {
        $(".add_flight_1").show();
        $(".add_flight_2").show();
      } else {
        $(".add_flight_1").hide();
        $(".add_flight_2").hide();
      }
    });
</script>
   </body>
</html>