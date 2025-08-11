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
   font-size: 15px;
   color: #333;
   font-weight: 400;
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

/*---------------------modify_before_box css ---------------------*/
.modify-transfer {
    display: flex;
    flex-direction: column;
    gap: 1rem; /* Space between items */
    background-color: #ffffff; /* White background for the container */
    border-radius: 0.5rem;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 500px;
}

.item {
    display:flex;
    align-items:center;
    gap: 0.75rem; /* Space between icon and content */
    padding: 0.75rem;
    border-radius: 0.25rem;
    background-color: #f9f9f9; /* Light grey background for each item */
    transition: background-color 0.3s ease;
}

.item:hover {
    background-color: #e0e0e0; /* Slightly darker grey on hover */
}

.icon {
    width: 7%; /* Size of icons */
}

.content {
    font-size: 1rem;
    color: #333; /* Dark grey for text */
    font-weight: 500;
}
.content_heading{
    font-size: 1rem;
    color: #333; /* Dark grey for text */
    font-weight: 600 !important;
}
.modify-button {
    align-self: end;
    padding: 0.75rem 1.5rem;
    font-size: 1.4rem;
    color: #ffffff;
    background-color: #203f7c;
    border: none;
    border-radius: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin: 0px 5px 10px 0px;
}

.modify-button:hover {
    background-color: #0056b3; /* Darker blue on hover */
}
/*-------------------modfy box pop up css ----------------------*/
/* Base styling for the transfer search engine container */
.transfer_search_engine {
    padding: 40px 15px 20px;
    background: #f8f9fa; /* Light background for better contrast */
    border-radius: 8px; /* Rounded corners for a modern look */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow */
    position: relative;
}

/* Styling for the form */
.transfer_search_engine form {
    display: flex;
    flex-wrap: wrap;
    gap: 15px; /* Add spacing between elements */
}

/* Destination input styling */
.Dest_input {
    text-align: left;
    width: 45%;
    margin-bottom: 7px;
    position: relative;
}

/* Destination select styling */
.Dest_input select {
    width: 100%;
    height: 50px;
    border: 2px solid #fdb816 !important;
    color: #333;
    font-weight: 600;
    padding: 10px 7px; /* Adjust padding */
    outline: none;
    background: #fff;
    border-radius: 4px; /* Rounded corners for select */
}

/* Pick and Drop styling */
.pick_drop {
    display: flex;
    gap: 15px; /* Space between pick-up and drop-off */
    margin-bottom: 7px;
}

/* Styling for pick-up and drop-off select boxes */
.pick_drop select {
    width: 100%;
    height: 50px;
    border: 2px solid #fdb816 !important;
    color: #333;
    font-weight: 600;
    padding: 10px 7px;
    outline: none;
    background: #fff;
    border-radius: 4px; /* Rounded corners for select */
}

/* Date and time picker styling */
.date_pickup {
    display: flex;
    gap: 15px; /* Space between date and time pickers */
    margin-bottom: 7px;
}

.dat_pick input,
.pick_up_time select , .nationality select {
    width: 100%;
    height: 50px;
    border: 2px solid #fdb816 !important;
    font-weight: 600;
    padding: 10px 7px;
    border-radius: 4px; /* Rounded corners */
    background: #fff;
}

.date_pickup select {
    background: #fff;
    display:flex;
}

/* Language and Nationality select styling */
.lang_num_pass {
    display: flex;
    width: 60%;
    gap: 15px; /* Space between language and nationality */
}

.lang_num_pass select {
    width: 100%;
    height: 50px;
    border: 2px solid #fdb816 !important;
    font-weight: 600;
    padding: 10px 7px;
    border-radius: 4px; /* Rounded corners */
    background: #fff;
}

/* Styling for various input fields */
.fromtransfer.mytextbox.iconLoc.contr_form,
.droptransfer.mytextbox.iconLoc.contr_form {
    width: 100%;
    height: 50px;
    border: 2px solid #fdb816 !important;
    color: #333;
    font-weight: 600;
    padding: 10px 7px;
    border-radius: 4px; /* Rounded corners */
    background: #fff;
    outline: none;
}

/* Button styling */
.srchbutn {
    background-color: #fdb816;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px; /* Rounded corners */
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.srchbutn:hover {
    background-color: #e0a800;
}

/* Cross button styling */
.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #f44336; /* Red color for close button */
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease;
    z-index:99;
}

.close-btn:hover {
    background-color: #d32f2f;
}

/* Animation for showing and hiding the form */
.form-container {
    position: fixed;
    top: -100%; /* Initially hide the form above the viewport */
    left: 0;
    right: 0;
    background: #fff;
    transition: top 0.5s ease; /* Smooth transition */
    z-index: 9999; /* Ensure form is above other content */
}

.form-container.show {
    top: 0; /* Show the form */
}

/* Responsive Design */
@media (max-width: 768px) {
    .transfer_search_engine form {
        flex-direction: column;
    }
    .pick_drop, .date_pickup, .lang_num_pass {
        width: 100%;
    }
}
.pax-count-wrapper .input-number{
    background: #fff !important;
    border: none;
    margin-bottom: 0;
    text-align: center;
    box-shadow: none;
}
.flyinputsnor.contr_form {
    color: #333;
    border-radius: 5px;
    border: 2px solid #fdb816 !important;
    height: 50px !important;
}
.div_flex select {
    width: 70px;
}
/*---------------override css again in modify--------------------*/

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
   img.htl_icon {
    width: 11%;
}
/*----------------------table result css start ------------------------*/

.table-container {
    width: 100%;
    margin-left: 10px; /* Center the table */
    background-color: #ffffff; /* White background for the table container */
    border-radius: 0.5rem; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    overflow-x: auto; /* Handle overflow on smaller screens */
}

.custom-table {
    width: 100%;
    border-collapse: collapse; /* Remove space between borders */
}

.custom-table .header {
    padding: 1.5rem;
    text-align: left;
    background-color: #203f7c; /* Blue background for headers */
    color: white; /* White text color for headers */
    font-weight: bold; /* Bold text */
    border-right:1px solid #fff;    
    font-size: 13px;
    text-align:center;
}
.custom-table .header:last-child{
    border-right:none;
}
.custom-table .description {
    padding: 1rem;
    gap: 0.5rem; /* Space between text and link */
    border-bottom: 1px solid #ddd; /* Light border for rows */
    text-align:center;
    font-size:14px;
}

.custom-table .description .more-info {
    color: #007bff;
    text-decoration: none;
    font-size: 1.3rem;
}
.description p{
    margin-bottom:7px;
}
.custom-table .description .more-info:hover {
    text-decoration: underline;
}

.custom-table .bordered {
    padding: 1rem;
    border: 1px solid #ddd; /* Light border around cells */
    background-color: #f9f9f9; /* Slightly different background color */
    border-right: 0; /* Remove right border for all but last cell */
    text-align:center;
    font-size:14px;
}

.custom-table tr:last-child .bordered {
    border-right: 1px solid #ddd; /* Ensure right border on the last cell */
}

.custom-table .action-button {
    padding: 1rem 0.9rem;
    font-size: 1.4rem;
    color: #ffffff;
    background-color: #203f7c;
    border: none;
    border-radius: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
    /* width: 100%; */
}

.custom-table .action-button:hover {
    background-color: #203f7c; /* Darker blue on hover */
}
.box_hours{
    display:flex;
    flex-wrap:wrap;
}
</style>
<script>
   var load_busses = function () {
   
   
   
 var basUrl = $('#baseUrl').val();
   
   
   
        //show_result_pre_loader();
   
   
   
       $.ajax({
   
   
   
           type: 'GET',
   
   
   
           url: basUrl + 'index.php/transfer/transfer_list?search_id=<?php echo $search_id ?>&op=load',
   
   
   
           async: true,
   
   
   
           cache: true,
   
   
   
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
   
   
    
   
   load_busses();  
   
   
   
</script>
<span class="hide">    
<input type="hidden" id="pri_search_id" value="<?= $search_id ?>" >
</span>
<?php
   // echo $GLOBALS['CI']->template->isolated_view('bus/search_panel_summary');
   
   
   
   ?>
<div class="wrapper_before_content">
   <!--<div class="container ">-->
   <!--   <h3><?php echo $from .' To '. $to?></h3>-->
   <!--   <h6><a href="#" id="modify">modify</a></h6>-->
   <!--</div>-->
   <!--<div class="container " id="modify_open" style="display: none;">-->
      <?php //echo $GLOBALS['CI']->template->isolated_view('new_theme/search_tabs/bus_search');?>
   <!--   <form autocomplete="off" action="<?php echo base_url('index.php/bus/search')?>" method="get" name="busSearchForm" id="busSearchForm">-->
   <!--      <div class="col-md-4 nopad"><label> FROM</label>-->
   <!--         <input id="bus-station-from" name="from" type="text" class="ft frombus iconLoc contr_form ui-autocomplete-input" placeholder="From" style="color:#000 !important" value="<?php echo (isset($from) || $form != '') ? $from:''?>" autocomplete="off" aria-autocomplete="list">-->
   <!--         <input class="hide loc_id_holder" name="from_station_id" type="hidden" value="">-->
   <!--      </div>-->
   <!--      <div class="col-md-4 nopad"><label> TO</label>-->
   <!--         <input name="to" id="bus-station-to" style="color:#000 !important" class="ft departbus iconLoc contr_form pad_twofive ui-autocomplete-input" placeholder="To" value="<?php echo (isset($to) || $to != '') ? $to:''?>" type="text" autocomplete="off" aria-autocomplete="list">-->
   <!--      </div>-->
   <!--      <input class="hide loc_id_holder" name="to_station_id" type="hidden" value="">-->
   <!--      <div class="col-md-2 nopad">-->
   <!--         <label> DATE</label>-->
   <!--         <input name="bus_depature" style="color:#000 !important" -->
   <!--            class="ft departflight1 iconLoc contr_form pad_twofive" -->
   <!--            id="bus_depature" placeholder="" value="<?php echo (isset($bus_depature) || $bus_depature != '') ? $bus_depature:''?>"-->
   <!--            type="text">-->
   <!--         <input name ="bus_depature" class="ft departflight1 mytextbox iconLoc contr_form pad_twofive" id="bus_depature" value="<?php echo (isset($bus_depature) || $bus_depature != '') ? $bus_depature:''?>" type="text" />-->
   <!--      </div>-->
   <!--      <div class="col-md-2 nopad"><label> &nbsp;</label><button> search</button></div>-->
   <!--   </form>-->
   <!--</div>-->
</div>

<div class="wrapper_reslut_bus">
   <div class="container ">
       <div class="row">
        <div class="col-md-3 bus_filter">
         <div class="col-md-12 nopad main_bus_details_head"  style="">
         
               <!--<div class="filter_sec">-->
               <!--   <div class="col-md-12 nopad">-->
               <!--      <div class="text-center pdt15">-->
               <!--         <span id="total_records"></span>-->
               <!--      </div>-->
               <!--      <h3>-->
               <!--         <a class="pull-right" id="reset_filters">RESET ALL</a>-->
               <!--      </h3>-->
               <!--   </div>-->
               <!--   <div class="rangebox">-->
               <!--      <button class="collapsebtn new_minazx" type="button" data-toggle="collapse" data-target="#price-refine">Price</button>-->
               <!--      <div class="collapse in price-refine">-->
               <!--         <div class="price_slider1">-->
               <!--            <div id="core_min_max_slider_values" class="hide">-->
               <!--               <input type="hiden" id="core_minimum_range_value" value="">-->
               <!--               <input type="hiden" id="core_maximum_range_value" value="">-->
               <!--            </div>-->
               <!--            <p id="amount" class="level"></p>-->
               <!--            <div id="slider-range-1" class="" aria-disabled="false"></div>-->
               <!--         </div>-->
               <!--      </div>-->
               <!--   </div>-->
               <!--   <div class="clearfix"></div>-->
               <!--   <div class="septor"></div>-->
               <!--   <div class="rangebox">-->
               <!--      <button type="button" class="collapsebtn new_minazx_ab" data-toggle="collapse"-->
               <!--         data-target="#collapse503">Departure Time</button>-->
               <!--      <div class="collapse in" id="collapse503">-->
               <!--         <div id="departureTimeWrapper" class="boxins marret">-->
               <!--            <a class="timone toglefil time-wrapper">-->
               <!--               <div class="starin">-->
               <!--                  <div class="tmxdv">-->
               <!--                     <input type="checkbox" value="1" class="time-category hidecheck">-->
               <!--                     <label for="check1" class="ckboxdv">Early Morning</label>-->
               <!--                  </div>-->
               <!--                  <div class="flitsprt mng1"></div>-->
               <!--                  <span class="htlcount">5AM-9AM</span>-->
               <!--               </div>-->
               <!--            </a>-->
               <!--            <a class="timone toglefil time-wrapper">-->
               <!--               <div class="starin">-->
               <!--                  <div class="tmxdv">-->
               <!--                     <input type="checkbox" value="2" class="time-category hidecheck">-->
               <!--                     <label for="check1" class="ckboxdv">Mid-Day</label>-->
               <!--                  </div>-->
               <!--                  <div class="flitsprt mng2"></div>-->
               <!--                  <span class="htlcount">9AM-5PM</span>-->
               <!--               </div>-->
               <!--            </a>-->
               <!--            <a class="timone toglefil time-wrapper">-->
               <!--               <div class="starin">-->
               <!--                  <div class="tmxdv">-->
               <!--                     <input type="checkbox" value="3" class="time-category hidecheck">-->
               <!--                     <label for="check1" class="ckboxdv">Evening</label>-->
               <!--                  </div>-->
               <!--                  <div class="flitsprt mng3"></div>-->
               <!--                  <span class="htlcount">5PM-9PM</span>-->
               <!--               </div>-->
               <!--            </a>-->
               <!--            <a class="timone toglefil time-wrapper">-->
               <!--               <div class="starin">-->
               <!--                  <div class="tmxdv">-->
               <!--                     <input type="checkbox" value="4" class="hidecheck time-category">-->
               <!--                     <label for="check1" class="ckboxdv">Night</label>-->
               <!--                  </div>-->
               <!--                  <div class="flitsprt mng4"></div>-->
               <!--                  <span class="htlcount">9PM-5AM</span>-->
               <!--               </div>-->
               <!--            </a>-->
               <!--         </div>-->
               <!--      </div>-->
               <!--   </div>-->
               <!--   <div class="rangebox">-->
               <!--      <button type="button" class="collapsebtn new_minazx_ab" data-toggle="collapse" data-target="#collapse504">Arrival Time</button>-->
               <!--      <div class="collapse in" id="collapse504">-->
               <!--         <div id="arrivalTimeWrapper" class="boxins marret">-->
               <!--            <a class="timone toglefil time-wrapper">-->
               <!--               <div class="starin">-->
               <!--                  <div class="tmxdv">-->
               <!--                     <input type="checkbox" value="1" class="time-category hidecheck">-->
               <!--                     <label for="check1" class="ckboxdv">Early Morning</label>-->
               <!--                  </div>-->
               <!--                  <div class="flitsprt mng1"></div>-->
               <!--                  <span class="htlcount">5AM-9AM</span>-->
               <!--               </div>-->
               <!--            </a>-->
               <!--            <a class="timone toglefil time-wrapper">-->
               <!--               <div class="starin">-->
               <!--                  <div class="tmxdv">-->
               <!--                     <input type="checkbox" value="2" class="time-category hidecheck">-->
               <!--                     <label for="check1" class="ckboxdv">Mid-Day</label>-->
               <!--                  </div>-->
               <!--                  <div class="flitsprt mng2"></div>-->
               <!--                  <span class="htlcount">9AM-5PM</span>-->
               <!--               </div>-->
               <!--            </a>-->
               <!--            <a class="timone toglefil time-wrapper">-->
               <!--               <div class="starin">-->
               <!--                  <div class="tmxdv">-->
               <!--                     <input type="checkbox" value="3" class="time-category hidecheck">-->
               <!--                     <label for="check1" class="ckboxdv">Evening</label>-->
               <!--                  </div>-->
               <!--                  <div class="flitsprt mng3"></div>-->
               <!--                  <span class="htlcount">5PM-9PM</span>-->
               <!--               </div>-->
               <!--            </a>-->
               <!--            <a class="timone toglefil time-wrapper">-->
               <!--               <div class="starin">-->
               <!--                  <div class="tmxdv">-->
               <!--                     <input type="checkbox" value="4" class="time-category hidecheck">-->
               <!--                     <label for="check1" class="ckboxdv">Night</label>-->
               <!--                  </div>-->
               <!--                  <div class="flitsprt mng4"></div>-->
               <!--                  <span class="htlcount">9PM-5AM</span>-->
               <!--               </div>-->
               <!--            </a>-->
               <!--         </div>-->
               <!--      </div>-->
               <!--   </div>-->
               <!--</div>-->

               <?php //debug($search_id); die; 

                // $get_search_data = $this->Home_Model->get_search_data($search_id);
                // // debug(json_decode($get_search_data[0]['search_data'],true)); die;
                // $srch_data = json_decode($get_search_data[0]['search_data'],true);

               //debug($get_country_data); die;

               ?>
               <div class="modify-transfer">
                    <div class="item">
                        <img src="../assets/theme_dark/images/hotel.png" alt="Hotel Icon" class="htl_icon">
                        <span class="content_heading">Your Transfer Search</span>
                    </div>
                    <div class="item">
                        <img src="../assets/theme_dark/images/hotels.png" alt="Dubai Emirates Icon" class="icon">
                        <span class="content">&nbsp;<?php echo $get_country_data[0]['Name'].'('.$get_country_data[0]['Code'].')'; ?></span>
                    </div>
                    <div class="item">
                        <img src="../assets/theme_dark/images/placeholder.png" alt="Airport Icon" class="icon">
                        <span class="content">Airport</span>
                    </div>
                    <div class="item">
                        <img src="../assets/theme_dark/images/placeholder.png" alt="Dubai Airport Icon" class="icon">
                        <span class="content">&nbsp;<?php echo $srch_data['from']; ?></span>
                    </div>
                    <div class="item">
                        <img src="../assets/theme_dark/images/placeholder.png" alt="Accommodation Icon" class="icon">
                        <span class="content">Accommodation</span>
                    </div>
                    <div class="item">
                        <img src="../assets/theme_dark/images/placeholder.png" alt="Metro Politian Hotel Icon" class="icon">
                        <span class="content">&nbsp;<?php echo $srch_data['to']; ?></span>
                    </div>
                    <div class="item">
                        <img src="../assets/theme_dark/images/finish.png" alt="Metro Politian Hotel Icon" class="icon">
                        <span class="content">&nbsp;<?php echo $get_country_data[0]['Name'].'('.$get_country_data[0]['Code'].')'; ?></span>
                    </div>
                    <div class="item">
                        <img src="../assets/theme_dark/images/calendar_15.png" alt="Metro Politian Hotel Icon" class="icon">
                        <span class="content">&nbsp;<?php 
                        $dte = explode('-', $srch_data['depatures']);
                        echo $dte[2].'-'.$dte[1].'-'.$dte[0]; ?></span>
                    </div>
                    <div class="item">
                        <img src="../assets/theme_dark/images/placeholder.png" alt="Metro Politian Hotel Icon" class="icon">
                        <span class="content">1 Adult</span>
                    </div>
                    <div class="item">
                        <img src="../assets/theme_dark/images/clock.png" alt="Clock Icon" class="icon">
                        <span class="content">&nbsp;<?php echo $srch_data['hours'].':'.$srch_data['minutes']; ?>hrs</span>
                    </div>
                    <div class="item">
                        <img src="../assets/theme_dark/images/language.png" alt="Metro Politian Hotel Icon" class="icon">
                        <span class="content">&nbsp;<?php 
                        $srch_data['langauge']="";
                        if($srch_data['langauge']!=""){echo $srch_data['langauge'];}else{echo "Not Specified";}?></span>
                    </div>
                    <button class="modify-button" onclick="openForm()">Modify Search</button>
                </div>
            </div>
        </div>
     
      <!--<div class="col-md-9 bus_datails_page" >-->
      <!--   <div class="col-md-12 nopad main_bus_details_head" style="">-->
      <!--       <div class="col-md-2 nopad">-->
      <!--          <h3><span id="total_records"></span> Buses <span>Found</span></h3>-->
      <!--         </div> -->
      <!--      <div class="col-md-3 nopad">-->
      <!--         <div class="flight_list depart_sort">-->
      <!--            <a class="sorta dep_bus" type="depature_time" id="depart_sort_asc" val="desc"> <i class="fal fa-calendar-check"></i> Departure-->
      <!--            <i class="fa fa-sort-asc " aria-hidden="true"></i>-->
      <!--            </a>-->

      <!--            <a class="sorta dep_bus hide" type="depature_time" id="depart_sort_dec" val="desc"> <i class="fal fa-calendar-check"></i> Departure-->
      <!--            <i class="fa fa-sort-desc" aria-hidden="true"></i>-->
      <!--            </a>-->
      <!--         </div>-->
      <!--      </div>-->
           
      <!--       <div class="col-md-3 nopad">-->
      <!--         <div class="flight_list duration_time">-->
      <!--            <a class="sorta dep_bus" type="duration_time" id="duration_time" val="asc"><i class="fal fa-clock"></i> Duration -->
      <!--            <i class="fa fa-sort-asc fare_icon_inc" aria-hidden="true"></i>-->
      <!--                   <i class="fa fa-sort-desc fare_icon_dec" aria-hidden="true"></i></a>-->
      <!--         </div>-->
      <!--      </div> -->
      <!--      <div class="col-md-3 nopad">-->
      <!--         <div class="flight_list arrival_time">-->
      <!--            <a class="sorta dep_bus" type="arrival_time" id="arrival_time_asc" val="asc"><i class="fal fa-clock"></i> Arrival -->
      <!--            <i class="fa fa-sort-asc fare_icon_inc" aria-hidden="true"></i>-->
      <!--            </a>-->
      <!--            <a class="sorta dep_bus hide" type="arrival_time" id="arrival_time_dec" val="asc"><i class="fal fa-clock"></i> Arrival -->
      <!--                   <i class="fa fa-sort-desc fare_icon_dec" aria-hidden="true"></i>-->
      <!--            </a>-->
      <!--         </div>-->
      <!--      </div>-->
      <!--       <div class="col-md-3 nopad">-->
      <!--         <div class="flight_list rating_bus">-->
      <!--            <a class="sorta dep_bus" type="arrival_time" id="rating_bus" val="asc"><span class="fa fa-star-o"></span> Rating-->
      <!--           <i class="fa fa-sort-asc fare_icon_inc" aria-hidden="true"></i>-->
      <!--                   <i class="fa fa-sort-desc fare_icon_dec" aria-hidden="true"></i></a>-->
      <!--         </div>-->
      <!--      </div> -->
      <!--        <div class="col-md-3 nopad">-->
      <!--         <div class="flight_list seats_available">-->
      <!--            <a class="sorta dep_bus" type="arrival_time" id="seats_available_asc" val="asc"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Seats Available-->
      <!--           <i class="fa fa-sort-asc fare_icon_inc" aria-hidden="true"></i>-->
      <!--           </a>-->
      <!--           <a class="sorta dep_bus hide"  type="arrival_time" id="seats_available_dec" val="asc"><i class="fa fa-puzzle-piece" aria-hidden="true">-->
                    
      <!--           </i> Seats Available-->
      <!--                   <i class="fa fa-sort-desc fare_icon_dec" aria-hidden="true"></i>-->
      <!--                </a>-->
      <!--         </div>-->
      <!--      </div> -->
      <!--       <div class="col-md-2 nopad">-->
      <!--         <div class="seats_available">-->
      <!--            <a class="sorta dep_bus" type="seats_available" id="seats_available" val="asc"> <i class="fa fa-puzzle-piece" aria-hidden="true"></i> Seats Available</a>-->
      <!--         </div>-->
      <!--      </div> -->
      <!--      <div class="col-md-3 nopad">-->
      <!--         <div class="flight_list fare_bus">-->
      <!--            <a class="sorta dep_bus" type="arrival_time" id="fare_bus_asc" val="asc"><i class="fa fa-ticket" aria-hidden="true"></i> Fare  -->
                 
      <!--               <i class="fa fa-sort-asc fare_icon_inc" aria-hidden="true"></i>-->
      <!--               </a>-->
      <!--                 <a class="sorta dep_bus hide" type="arrival_time_dec" id="fare_bus_dec" val="asc"><i class="fa fa-ticket" aria-hidden="true"></i> Fare -->
      <!--                   <i class="fa fa-sort-desc fare_icon_dec" aria-hidden="true"></i>-->
      <!--            </a>-->
      <!--         </div>-->
      <!--      </div>-->
      <!--   </div>-->
      <!--   <div class="col-md-12  main_bus_details">-->
      <!--      <div class="main_bus">-->
               <?php // echo $this->load->view(PROJECT_THEME.'/bus/bus_result_loader'); ?>
      <!--      </div>-->
      <!--      <div id="bus_search_result">-->
      <!--      </div>-->
      <!--   </div>-->
      <!--</div>-->

      <?php //debug($raw_transfer_list); die; ?>
       <div class="col-md-9">
          <div class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <td class="header">Service Description</td>
                            <td class="header">Service Duration</td>
                            <td class="header">Vehicle</td>
                            <td class="header">Max Passenger</td>
                            <td class="header">Max Luggage</td>
                            <td class="header">Total Price (Exclusive of Service Tax)</td>
                            <td class="header"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="description">
                                <p>Private Standard Car</p>
                                <a href="#" class="more-info">More Info</a>
                            </td>
                            <td class="bordered">0h 30 mins</td>
                            <td class="bordered">Private Standard car</td>
                            <td class="bordered"> 3</td>
                            <td class="bordered"> 4</td>
                            <td class="bordered"> $2475</td>
                            <td class="bordered">
                                <button class="action-button">Book Now</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="description">
                                <p>Private Standard Car</p>
                                <a href="#" class="more-info">More Info</a>
                            </td>
                            <td class="bordered">2h 30 mins</td>
                            <td class="bordered">Private Standard car</td>
                            <td class="bordered"> 5</td>
                            <td class="bordered"> 12</td>
                            <td class="bordered"> $4000</td>
                            <td class="bordered">
                                <button class="action-button">Book Now</button>
                            </td>
                        </tr>
                         <tr>
                            <td class="description">
                                <p>Private Standard Car</p>
                                <a href="#" class="more-info">More Info</a>
                            </td>
                            <td class="bordered">5h 30 mins</td>
                            <td class="bordered">Private Standard car</td>
                            <td class="bordered"> 8</td>
                            <td class="bordered"> 14</td>
                            <td class="bordered"> $6000</td>
                            <td class="bordered">
                                <button class="action-button">Book Now</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="description">
                                <p>Private Standard Car</p>
                                <a href="#" class="more-info">More Info</a>
                            </td>
                            <td class="bordered">1h 30 mins</td>
                            <td class="bordered">Private Standard car</td>
                            <td class="bordered"> 2</td>
                            <td class="bordered"> 7</td>
                            <td class="bordered"> $1500</td>
                            <td class="bordered">
                                <button class="action-button">Book Now</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
       </div>
       </div>
   </div>
</div>

<div class="col-md-12">
    <div class="form-container" id="form-container">
    <button class="close-btn" onclick="closeForm()">×</button>
    <div class="transfer_search_engine">
                <div class="transfer_row">
                    <form autocomplete="off" action="/transfer/search" name="flight" id="flight">
                        <div class="Dest_input">
                            <label for="country" class="details_of_input">Destinations</label>

                            <select id="country"  class="country"  name="country" onChange="myNewFunction(this)";> 
                            <?php foreach ($transfer_country_list as $key => $value) {?> 
                            <option value="<?php echo $value['Code']; ?>"><?php echo $value['Name']; ?></option>  
                            <?php    } ?>
                             </select>
                            <!-- <select id="country" name="country" class="country" onchange="myNewFunction(this)">
                                <option value="US">United States</option>
                                <option value="CA">Canada</option>
                                <option value="GB">United Kingdom</option>
                                <option value="AU">Australia</option> 
                            </select> -->
                        </div>
                        <div class="pick_drop">
                            <div class="pick_up">
                                <span class="details_of_input">Pick Up</span>
                                <div class="input-field first-wrap">
                                    <input id="transfer-station-from" name="from" type="text" class="ft fromtransfer mytextbox iconLoc contr_form" placeholder="Pick Up Location" autocomplete="off" aria-autocomplete="list" value="New York">
                                    <input class="hide loc_id_holder" name="from_station_id" type="hidden" value="">
                                </div>
                            </div>
                            <div class="drop_me">
                                <span class="details_of_input">Drop off</span>
                                <div class="input-field first-wrap">
                                    <input id="transfer-station-to" name="to" type="text" class="ft droptransfer mytextbox iconLoc contr_form" placeholder="Drop Off Location" autocomplete="off" aria-autocomplete="list" value="Los Angeles">
                                    <input class="hide loc_id_holder" name="to_station_id" type="hidden" value="">
                                </div>
                            </div>
                        </div>
                            <div class="dat_pick">
                                <span class="details_of_input">Date</span>
                                <input class="datepicker contr_form" name="depature" id="depature_date" type="text" class="forminput date_picker contr_form" readonly="readonly" placeholder="Departure Date" value="Aug 26, 2024">
                            </div>
                            <div class="pick_up_time">
                                <span class="details_of_input">Pick up time</span>
                                 <div class="box_hours">
                                     <div class="div_flex">
                                         <select name="hours">
                                    <option value="0">00</option>
                                    <option value="1">01</option>
                                    <option value="2">02</option>
                                    <option value="3">03</option>
                                    <option value="4">04</option>
                                    <option value="5">05</option>
                                    <option value="6">06</option>
                                    <option value="7">07</option>
                                    <option value="8">08</option>
                                    <option value="9">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                </select> 
                                 </div>
                                 <div class="div_flex">
                                   <select name="minutes">
                        <?php for($i=0;$i<=60;$i++){  ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>

                    </select>
                                    <!--   <select name="minutes">
                                            <option value="0">00</option>
                                            <option value="15">15</option>
                                            <option value="30">30</option>
                                            <option value="45">45</option>
                                        </select> -->
                                 </div>
                                 </div>
                            </div>
                            <div class="nationality">
                                <span class="details_of_input">Nationality</span>
                                    <select id="country"  class="country"  name="country" onChange="myNewFunction(this)";> 
                            <?php foreach ($transfer_country_list as $key => $value) {?> 
                            <option value="<?php echo $value['Code']; ?>"><?php echo $value['Name']; ?></option>  
                            <?php    } ?>
                             </select>
                                <!-- <select name="nationality">
                                    <option value="US">United States</option>
                                    <option value="CA">Canada</option>
                                    <option value="GB">United Kingdom</option>
                                    <option value="AU">Australia</option> 
                                </select> -->
                            </div>
                        <div class="lang_num_pass">
                            <div class="lang_select">
                                <span class="details_of_input">Language</span>
                                <select name="langauge">
                      <?php
                      // debug($PreferredLanguage); die;
                       foreach ($PreferredLanguage as $key => $value) {?>
 
                      
 <option  value="<?php echo $value->code; ?>" ><?php echo $value->langauge; ?></option>

                       <?php } ?>
                    </select>
                             <!--    <select name="language">
                                    <option value="en">English</option>
                                    <option value="es">Spanish</option>
                                    <option value="fr">French</option>
                                    <option value="de">German</option> 
                                </select> -->
                            </div>
                            <div class="pass_select">
                                <span class="details_of_input">Passengers</span>
                                <div class="totlall">
                                    <span class="remngwd flyinputsnor contr_form">
                                        <span class="total_pax_count">1</span>
                                        <span id="travel_text"> Travellers</span>
                                    </span>
                                    <div class="roomcount pax_count_div1">
                                        <div class="mobile_adult_icon">Travellers<i class="fa fa-male"></i></div>
                                        <div class="inallsn">
                                            <div class="oneroom fltravlr">
                                                <div class="lablform2">Travellers</div>
                                                <div class="clearfix"></div>
                                                <div class="roomrow">
                                                    <div class="celroe col-xs-7"><i class="fal fa-male"></i> Adults<span class="agemns">(12+)</span></div>
                                                    <div class="celroe col-xs-5">
                                                        <div class="input-group countmore pax-count-wrapper adult_count_div">
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-default btn-number btnpot" data-type="minus" data-field="adult"> 
                                                                    <span class="glyphicon glyphicon-minus"></span> 
                                                                </button>
                                                            </span>
                                                            <input type="text" name="adult" id="adult" value="1" readonly class="form-control input-number centertext valid" data-min="1" data-max="9" aria-invalid="false">
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-default btn-number btnpot btn_right" data-type="plus" data-field="adult"> 
                                                                    <span class="glyphicon glyphicon-plus"></span> 
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="roomrow">
                                                    <div class="celroe col-xs-7">
                                                        <i class="fal fa-child"></i> Children<span class="agemns">(2-11)</span>
                                                    </div>
                                                    <div class="celroe col-xs-5">
                                                        <div class="input-group countmore pax-count-wrapper child_count_div">
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-default btn-number btnpot" data-type="minus" data-field="child"> 
                                                                    <span class="glyphicon glyphicon-minus"></span> 
                                                                </button>
                                                            </span>
                                                            <input type="text" name="child" id="child" readonly class="form-control input-number centertext" value="0" data-min="0" data-max="8">
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-default btn-number btnpot btn_right" data-type="plus" data-field="child"> 
                                                                    <span class="glyphicon glyphicon-plus"></span> 
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="roomrow last">
                                                    <div class="celroe col-xs-7">
                                                        <i class="fal fa-child"></i> Infants<span class="agemns">(0-2)</span>
                                                    </div>
                                                    <div class="celroe col-xs-5">
                                                        <div class="input-group countmore pax-count-wrapper infant_count_div">
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-default btn-number btnpot" data-type="minus" data-field="infant">
                                                                    <span class="glyphicon glyphicon-minus"></span> 
                                                                </button>
                                                            </span>
                                                            <input type="text" id="infant" name="infant" readonly class="form-control input-number centertext" value="0" data-min="0" data-max="9">
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-default btn-number btnpot btn_right" data-type="plus" data-field="infant"> 
                                                                    <span class="glyphicon glyphicon-plus"></span> 
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="text-align:center;">
                            <button class="srchbutn comncolor btn btn-search search_fly btn_newdaqas">Search</button>
                        </div>
                    </form>
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
   function openForm() {
    document.getElementById('form-container').classList.add('show');
}

function closeForm() {
    document.getElementById('form-container').classList.remove('show');
}

// Example usage:
// openForm(); // Call this to show the form
// closeForm(); // Call this to hide the form


</script>
<script type="text/javascript">
    $('#depature_date').datepicker({
                               // defaultDate: "+1w",d-m-
                                changeMonth: true,
                                changeYear:true,
                                dateFormat : 'yy-m-d',
                                numberOfMonths: 1,
                                minDate:0,
                                onSelect:function()
                                {
                                  var id_v = $(this).data('id');
                                  $("#to_m_"+ (id_v+1)).focus(); 
                                  var to_m =$('#to_m_1').val();
                                  $("#from_m_2").val(to_m);
                                } 
                          });     
</script>
<!--<script type="text/javascript" src="https://tripglobo.com/beta1/assets/theme_dark/js/datepicker.js"></script>-->