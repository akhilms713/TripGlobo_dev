<style>
   .topssec{
   margin-top: -0px;
   position:fixed;
   }
   .wrapper_before_content{
   margin-top: 75px;
   }
   .bus_filter span#total_records {font-size: 16px;text-align: left;float: left;}
   .bus_filter{font-family: poppins; }
   #reset_filters{background: #1c2b59;
   padding: 5px;
   color: #fff;
   cursor: pointer;
   position: absolute;
   right: 10;
   top: 10px;
   } 
   .wrapper_reslut_bus{
   background: #f1f5f8 none repeat scroll 0 0;
   }
   .flight_list .sorta i {
   color: #fdb813!important;
   margin-right: 4px;
   font-weight: 500;
   }
   .flight_list a#arrival_sort {
   text-decoration: none!important;
   font-size: 13px!important;
   font-weight: 600!important;
   color: #203f7c!important;
   
   }
   .flight_list{
     cursor: pointer; 
   }
   .main_bus_details_head span {
   color: #203f7c!important;
   font-weight: 400;
   margin-top: -21px;
   }
   .sorta.active{
   text-decoration: none!important;
   font-size: 13px!important;
   font-weight: 600!important;
   color: #203f7c!important;
   }
   .flight_list.active {
   border-bottom: 3px solid #fdb813;
   }
   .flight_list:hover {
   /* border-bottom: 2px solid #fdb813;*/
   }
   .bus_datails_page{
        padding-left: 15px;
   }
  i.fa.fa-sort-desc {
    float: inline-end;
    margin-top: 12px;
    margin-right: 8px;
}
  i.fa.fa-sort-asc {
    float: inline-end;
    margin-top: 10px;
    margin-right: 8px;
}
</style>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
<?php
   // $this->load->helper('bus/tbo');
   
   
   
   $data = array();
   
   
   
   
   
   
   
   /*$bus_search_params =json_decode('{"bus_date_1":"24-08-2020","trip_type":"One Way","bus_station_from":"Bangalore","bus_station_to":"Chennai","from_station_id":"1190","to_station_id":"2553","search_id":235}', true);
   
   
   
   $data['result'] = $bus_search_params;*/
   
   
   
   // debug($data);
   
   
   
   $mini_loading_image ='';
   
   
   
   ?>
<input type="hidden" name="baseUrl" id="baseUrl" value="<?php echo base_url();?>">
<link rel="icon" href="<?php echo base_url(); ?>assets/theme_dark/images/favicon.png" type="image/x-icon">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato|Source+Sans+Pro" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/theme_dark/css/font-awesome5.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/theme_dark/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- Bootstrap Core CSS -->
<link href="<?php echo base_url(); ?>assets/theme_dark/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/theme_dark/css/jquery_ui.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/theme_dark/css/animation.css" rel="stylesheet" />
<!-- Custom Fonts -->
<link href="<?php echo base_url(); ?>assets/theme_dark/css/owl.carousel.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme_dark/css/backslider.css" type="text/css" media="screen" />
<!-- <link href="<?php //echo base_url(); ?>assets/theme_dark/css/custom.css" rel="stylesheet" /> -->
<link href="<?php echo base_url(); ?>assets/theme_dark/css/custom_style.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/theme_dark/js/jquery-1.11.0.js"></script>
<script src="<?php echo base_url(); ?>assets/theme_dark/js/jquery.jsort.0.4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme_dark/js/jquery_ui.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/theme_dark/js/bootstrap.min.js"></script>
<link href="<?= ASSETS; ?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?= ASSETS; ?>css/bootstrap.min.css" rel="stylesheet" />
<link href="<?= ASSETS; ?>css/jquery_ui.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
<link href="<?= ASSETS; ?>css/animation.css" rel="stylesheet" />
<link href="<?= ASSETS; ?>css/owl.carousel.css" rel="stylesheet">
<link rel="stylesheet" href="<?= ASSETS; ?>css/backslider.css" type="text/css" media="screen" />
<link href="<?= ASSETS; ?>css/custom_style.css" rel="stylesheet" />

<!-- <script src="<?= ASSETS; ?>js/jquery-1.11.0.js"></script>
   <script src="<?= ASSETS; ?>js/jquery_ui.js"></script> -->
<script type="text/javascript" src="<?= ASSETS; ?>js/bus_search.js"></script>
<script type="text/javascript" src="<?= ASSETS; ?>js/bus_search_result.js"></script>
<style>
   .collapsebtn {
   background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
   border: 0 none;
   color: #222;
   display: block;
   font-size: 16px;
   font-weight: 300;
   overflow: hidden;
   padding: 5px 0;
   position: relative;
   text-align: left;
   width: 100%;
   }
   .bus_filter span#total_records {
   font-size: 16px;
   text-align: left;
   float: left;
   width: 100%;
   padding: 17px 20px 11px;
   }
   
   .new_minazx {
   position: relative;
   padding-top: 25px;
   font-weight: 400;
   background: #fff;
   padding: 11px 20px; 
   }
   .new_minazx_ab { 
   position: relative;
   /*padding-top: 5px; */
   font-weight: 400;  background: #fff;
   padding: 11px 20px;
   }
   div#departureTimeWrapper { float: left;padding: 7px 15px 5px 20px;} 
   div#arrivalTimeWrapper { float: left;padding: 7px 15px 5px 20px;}
   .collapse.in.price-refine {
   padding: 7px 30px 5px 30px;
   }  
   .tmxdv {float: left;width: 50%;}
   .tmxdv label {color: #203f7c;font-size: 13px;     
   margin-left:25px;
   margin-top: 5px;/*position: relative;top: -2px;*/}
   .starin {width: 100%;float: left;}
   span.htlcount {width: 50%;text-align: right;float: right;}
   .rangebox {float: left;width: 100%;height: auto;}
   #reset_filters {
   background: #1c2b59;
   padding: 5px;
   color: #fff;
   cursor:pointer;
   }
</style>
<script>
   var load_busses = function () {
   
   
   
       var basUrl = $('#baseUrl').val();
   
   
   
        //show_result_pre_loader();
   
   
   
       $.ajax({
   
   
   
           type: 'GET',
   
   
   
           url: basUrl + 'index.php/bus/bus_list?search_id=<?php echo $search_id ?>&op=load',
   
   
   
           async: true,
   
   
   
           cache: false,
   
   
   
           dataType: 'json',
   
   
   
           success: function (res) {
   
   
   
               var dui;
   
   
   
               var r = res;
   
   
   
               dui = setInterval(function () {
   
   
   
                   if (typeof (process_result_update) != "undefined" && $.isFunction(process_result_update) == true) {
   
   
   
                       clearInterval(dui);
   
   
   
                       process_result_update(r);
   
   
   
                   }
   
   
   
               }, 1);
   
   
   
               $('#onwFltContainer').hide();
   
   
   
           }
   
   
   
       });
   
   
   
   }
   
   
   
   //Load buss from active source
   
   
   
   load_busses();
   
   
   
</script>
<span class="hide">    
<input type="hidden" id="pri_search_id" value="<?= $search_id ?>" >
</span>
<?php
   // echo $GLOBALS['CI']->template->isolated_view('bus/search_panel_summary');
   
   
   
   ?>
<div class="wrapper_before_content">
   <div class="container ">
      <h3><?php echo $from .' To '. $to?></h3>
      <h6><a href="#" id="modify">modify</a></h6>
   </div>
   <div class="container " id="modify_open" style="display: none;">
      <?php //echo $GLOBALS['CI']->template->isolated_view('new_theme/search_tabs/bus_search');?>
      <form autocomplete="off" action="<?php echo base_url('index.php/bus/search')?>" method="get" name="busSearchForm" id="busSearchForm">
         <div class="col-md-4 nopad"><label> FROM</label>
            <input id="bus-station-from" name="from" type="text" class="ft frombus iconLoc contr_form ui-autocomplete-input" placeholder="From" style="color:#000 !important" value="<?php echo (isset($from) || $form != '') ? $from:''?>" autocomplete="off" aria-autocomplete="list">
            <input class="hide loc_id_holder" name="from_station_id" type="hidden" value="">
         </div>
         <div class="col-md-4 nopad"><label> TO</label>
            <input name="to" id="bus-station-to" style="color:#000 !important" class="ft departbus iconLoc contr_form pad_twofive ui-autocomplete-input" placeholder="To" value="<?php echo (isset($to) || $to != '') ? $to:''?>" type="text" autocomplete="off" aria-autocomplete="list">
         </div>
         <input class="hide loc_id_holder" name="to_station_id" type="hidden" value="">
         <div class="col-md-2 nopad">
            <label> DATE</label>
            <input name="bus_depature" style="color:#000 !important" 
               class="ft departflight1 iconLoc contr_form pad_twofive" 
               id="bus_depature" placeholder="" value="<?php echo (isset($bus_depature) || $bus_depature != '') ? $bus_depature:''?>"
               type="text">
            <!--<input name ="bus_depature" class="ft departflight1 mytextbox iconLoc contr_form pad_twofive" id="bus_depature" value="<?php echo (isset($bus_depature) || $bus_depature != '') ? $bus_depature:''?>" type="text" />-->
         </div>
         <div class="col-md-2 nopad"><label> &nbsp;</label><button> search</button></div>
      </form>
   </div>
</div>

<div class="wrapper_reslut_bus">
   <div class="container ">
       <div class="row">
      <div class="col-md-3 bus_filter">
         <div class="col-md-12 nopad main_bus_details_head"  style="">
         
               <div class="filter_sec">
                  <div class="col-md-12 nopad">
                     <div class="text-center pdt15">
                        <span id="total_records"></span><!--  Buses <span>found</span> -->
                     </div>
                     <h3>
                        <a class="pull-right" id="reset_filters">RESET ALL</a>
                     </h3>
                  </div>
                  <div class="rangebox">
                     <button class="collapsebtn new_minazx" type="button" data-toggle="collapse" data-target="#price-refine">Price</button>
                     <div class="collapse in price-refine">
                        <div class="price_slider1">
                           <div id="core_min_max_slider_values" class="hide">
                              <input type="hiden" id="core_minimum_range_value" value="">
                              <input type="hiden" id="core_maximum_range_value" value="">
                           </div>
                           <p id="amount" class="level"></p>
                           <div id="slider-range-1" class="" aria-disabled="false"></div>
                        </div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="septor"></div>
                  <div class="rangebox">
                     <button type="button" class="collapsebtn new_minazx_ab" data-toggle="collapse"
                        data-target="#collapse503">Departure Time</button>
                     <div class="collapse in" id="collapse503">
                        <div id="departureTimeWrapper" class="boxins marret">
                           <a class="timone toglefil time-wrapper">
                              <div class="starin">
                                 <div class="tmxdv">
                                    <input type="checkbox" value="1" class="time-category hidecheck">
                                    <label for="check1" class="ckboxdv">Early Morning</label>
                                 </div>
                                 <div class="flitsprt mng1"></div>
                                 <span class="htlcount">5AM-9AM</span>
                              </div>
                           </a>
                           <a class="timone toglefil time-wrapper">
                              <div class="starin">
                                 <div class="tmxdv">
                                    <input type="checkbox" value="2" class="time-category hidecheck">
                                    <label for="check1" class="ckboxdv">Mid-Day</label>
                                 </div>
                                 <div class="flitsprt mng2"></div>
                                 <span class="htlcount">9AM-5PM</span>
                              </div>
                           </a>
                           <a class="timone toglefil time-wrapper">
                              <div class="starin">
                                 <div class="tmxdv">
                                    <input type="checkbox" value="3" class="time-category hidecheck">
                                    <label for="check1" class="ckboxdv">Evening</label>
                                 </div>
                                 <div class="flitsprt mng3"></div>
                                 <span class="htlcount">5PM-9PM</span>
                              </div>
                           </a>
                           <a class="timone toglefil time-wrapper">
                              <div class="starin">
                                 <div class="tmxdv">
                                    <input type="checkbox" value="4" class="hidecheck time-category">
                                    <label for="check1" class="ckboxdv">Night</label>
                                 </div>
                                 <div class="flitsprt mng4"></div>
                                 <span class="htlcount">9PM-5AM</span>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="rangebox">
                     <button type="button" class="collapsebtn new_minazx_ab" data-toggle="collapse" data-target="#collapse504">Arrival Time</button>
                     <div class="collapse in" id="collapse504">
                        <div id="arrivalTimeWrapper" class="boxins marret">
                           <a class="timone toglefil time-wrapper">
                              <div class="starin">
                                 <div class="tmxdv">
                                    <input type="checkbox" value="1" class="time-category hidecheck">
                                    <label for="check1" class="ckboxdv">Early Morning</label>
                                 </div>
                                 <div class="flitsprt mng1"></div>
                                 <span class="htlcount">5AM-9AM</span>
                              </div>
                           </a>
                           <a class="timone toglefil time-wrapper">
                              <div class="starin">
                                 <div class="tmxdv">
                                    <input type="checkbox" value="2" class="time-category hidecheck">
                                    <label for="check1" class="ckboxdv">Mid-Day</label>
                                 </div>
                                 <div class="flitsprt mng2"></div>
                                 <span class="htlcount">9AM-5PM</span>
                              </div>
                           </a>
                           <a class="timone toglefil time-wrapper">
                              <div class="starin">
                                 <div class="tmxdv">
                                    <input type="checkbox" value="3" class="time-category hidecheck">
                                    <label for="check1" class="ckboxdv">Evening</label>
                                 </div>
                                 <div class="flitsprt mng3"></div>
                                 <span class="htlcount">5PM-9PM</span>
                              </div>
                           </a>
                           <a class="timone toglefil time-wrapper">
                              <div class="starin">
                                 <div class="tmxdv">
                                    <input type="checkbox" value="4" class="time-category hidecheck">
                                    <label for="check1" class="ckboxdv">Night</label>
                                 </div>
                                 <div class="flitsprt mng4"></div>
                                 <span class="htlcount">9PM-5AM</span>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
     
      <div class="col-md-9 bus_datails_page" >
         <div class="col-md-12 nopad main_bus_details_head" style="">
            <!-- <div class="col-md-2 nopad">
                <h3><span id="total_records"></span> Buses <span>Found</span></h3>
               </div> -->
            <div class="col-md-3 nopad">
               <div class="flight_list depart_sort">
                  <a class="sorta dep_bus" type="depature_time" id="depart_sort_asc" val="desc"> <i class="fal fa-calendar-check"></i> Departure
                  <i class="fa fa-sort-asc " aria-hidden="true"></i>
                  </a>

                  <a class="sorta dep_bus hide" type="depature_time" id="depart_sort_dec" val="desc"> <i class="fal fa-calendar-check"></i> Departure
                  <i class="fa fa-sort-desc" aria-hidden="true"></i>
                  </a>
               </div>
            </div>
           
           <!--  <div class="col-md-3 nopad">
               <div class="flight_list duration_time">
                  <a class="sorta dep_bus" type="duration_time" id="duration_time" val="asc"><i class="fal fa-clock"></i> Duration 
                  <i class="fa fa-sort-asc fare_icon_inc" aria-hidden="true"></i>
                         <i class="fa fa-sort-desc fare_icon_dec" aria-hidden="true"></i></a>
               </div>
            </div> -->
            <div class="col-md-3 nopad">
               <div class="flight_list arrival_time">
                  <a class="sorta dep_bus" type="arrival_time" id="arrival_time_asc" val="asc"><i class="fal fa-clock"></i> Arrival 
                  <i class="fa fa-sort-asc fare_icon_inc" aria-hidden="true"></i>
                  </a>
                  <a class="sorta dep_bus hide" type="arrival_time" id="arrival_time_dec" val="asc"><i class="fal fa-clock"></i> Arrival 
                         <i class="fa fa-sort-desc fare_icon_dec" aria-hidden="true"></i>
                  </a>
               </div>
            </div>
            <!-- <div class="col-md-3 nopad">
               <div class="flight_list rating_bus">
                  <a class="sorta dep_bus" type="arrival_time" id="rating_bus" val="asc"><span class="fa fa-star-o"></span> Rating
                 <i class="fa fa-sort-asc fare_icon_inc" aria-hidden="true"></i>
                         <i class="fa fa-sort-desc fare_icon_dec" aria-hidden="true"></i></a>
               </div>
            </div> -->
              <div class="col-md-3 nopad">
               <div class="flight_list seats_available">
                  <a class="sorta dep_bus" type="arrival_time" id="seats_available_asc" val="asc"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Seats Available
                 <i class="fa fa-sort-asc fare_icon_inc" aria-hidden="true"></i>
                 </a>
                 <a class="sorta dep_bus hide"  type="arrival_time" id="seats_available_dec" val="asc"><i class="fa fa-puzzle-piece" aria-hidden="true">
                    
                 </i> Seats Available
                         <i class="fa fa-sort-desc fare_icon_dec" aria-hidden="true"></i>
                      </a>
               </div>
            </div> 
           <!--  <div class="col-md-2 nopad">
               <div class="seats_available">
                  <a class="sorta dep_bus" type="seats_available" id="seats_available" val="asc"> <i class="fa fa-puzzle-piece" aria-hidden="true"></i> Seats Available</a>
               </div>
            </div> --> 
            <div class="col-md-3 nopad">
               <div class="flight_list fare_bus">
                  <a class="sorta dep_bus" type="arrival_time" id="fare_bus_asc" val="asc"><i class="fa fa-ticket" aria-hidden="true"></i> Fare  
                 
                     <i class="fa fa-sort-asc fare_icon_inc" aria-hidden="true"></i>
                     </a>
                       <a class="sorta dep_bus hide" type="arrival_time_dec" id="fare_bus_dec" val="asc"><i class="fa fa-ticket" aria-hidden="true"></i> Fare 
                         <i class="fa fa-sort-desc fare_icon_dec" aria-hidden="true"></i>
                  </a>
               </div>
            </div>
         </div>
         <div class="col-md-12  main_bus_details">
            <div class="main_bus">
               <?php echo $this->load->view(PROJECT_THEME.'/bus/bus_result_loader'); ?>
            </div>
            <div id="bus_search_result">
            </div>
         </div>
      </div>
       </div>
   </div>
</div>



<script></script>
<script type="text/javascript" src="<?= ASSETS; ?>js/bus_filter.js"></script>
<script type="text/javascript" src="<?= ASSETS; ?>js/custom_modified.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
   
   
   
   
   
   
   
       $(".close_fil_box").click(function(){
   
   
   
           $(".coleft").hide();
   
   
   
           $(".resultalls").removeClass("open");
   
   
   
     });
   
   
   
   });
   
   
   
</script>       
<script>
   /*$(document).ready(function() {$('.amenities-show').click(function() {
   
   
   
      $('.amenities-hidden').slideToggle("slow");}); }); 
   
   
   
   $(document).ready(function() {
   
   
   
    $('.bording_drop-show').click(function() {
   
   
   
      console.log("asdfadsf");
   
   
   
      $('.bording_drop-hidden').slideToggle("slow");
   
   
   
    });
   
   
   
   }); 
   
   
   
   $(document).ready(function() {$('.cancel_policy-show').click(function() {$('.cancel_policy-hidden').slideToggle("slow");});}); 
   
   
   
   $(document).ready(function() {$('.selsect_seat-show').click(function() {$('.selsect_seat-hidden').slideToggle("slow");});}); 
   
   
   
   $(document).ready(function() {$('amenities-show_a').click(function() {$('.amenities-hidden_a').slideToggle("slow");}); }); 
   
   
   
   $(document).ready(function() {$('bording_drop-show_a').click(function() {$('.bording_drop-hidden_a').slideToggle("slow");});}); 
   
   
   
   $(document).ready(function() {$('#cancel_policy-show_a').click(function() {$('.cancel_policy-hidden_a').slideToggle("slow");});}); 
   
   
   
   $(document).ready(function() {$('#selsect_seat-show_a').click(function() {$('.selsect_seat-hidden_a').slideToggle("slow");});}); 
   
   
   
   
   
   
   
   */
   
   
   
   
   
   
   
   $('#modify').click(function() {
   
   
   
     $('#modify_open').toggle('slow');
   
   
   
     });
   
     
   
   
   
</script>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<script type="text/javascript">
   //  $('#bus_depature').click(function(){
   
       $('#bus_depature').datepicker({
   
              // defaultDate: "+1w",
   
               changeMonth: true,
   
               changeYear:true,
   
               dateFormat : 'M d,yy',
   
               numberOfMonths: 1,
   
               minDate:0
   
   
   
   
   
               //minDate: $( "#depature").val(),
   
         });
   
   //  });                         
   

</script>
<!--<script type="text/javascript" src="https://tripglobo.com/beta1/assets/theme_dark/js/datepicker.js"></script>-->