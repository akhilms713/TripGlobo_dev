<?php

 // $this->load->helper('bus/tbo');

$data = array();



/*$bus_search_params =json_decode('{"bus_date_1":"24-08-2020","trip_type":"One Way","bus_station_from":"Bangalore","bus_station_to":"Chennai","from_station_id":"1190","to_station_id":"2553","search_id":235}', true);

$data['result'] = $bus_search_params;*/

// debug($data);

$mini_loading_image ='';

?>

<input type="hidden" name="baseUrl" id="baseUrl" value="<?php echo base_url();?>">

<link href="<?= ASSETS; ?>css/style.css" rel="stylesheet" type="text/css">

<link href="<?= ASSETS; ?>css/bootstrap.min.css" rel="stylesheet" />

<link href="<?= ASSETS; ?>css/jquery_ui.css" rel="stylesheet" type="text/css">

 <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">



<link href="<?= ASSETS; ?>css/animation.css" rel="stylesheet" />

<link href="<?= ASSETS; ?>css/owl.carousel.css" rel="stylesheet">

<link rel="stylesheet" href="<?= ASSETS; ?>css/backslider.css" type="text/css" media="screen" />

<link href="<?= ASSETS; ?>css/custom_style.css" rel="stylesheet" />



<script src="<?= ASSETS; ?>js/jquery-1.11.0.js"></script>

<script src="<?= ASSETS; ?>js/jquery_ui.js"></script>

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

         <div class="container">

            <h3><?php echo $from .' To '. $to?></h3>

            <h6><a href="#modify_open" id="modify">modify</a></h6>

         </div>

         <div class="container " id="modify_open" style="display: none;">
          <?php //echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/bus_search');?>

          <form autocomplete="off" action="<?php echo base_url('index.php/bus/search')?>" method="get" name="busSearchForm" id="busSearchForm">

            <div class="col-md-4 nopad"><label> FROM</label>
              <input id="bus-station-from" name="from" type="text" class="ft frombus iconLoc contr_form ui-autocomplete-input" placeholder="From" style="color:#000 !important" value="<?php echo (isset($from) || $form != '') ? $from:''?>" autocomplete="off" aria-autocomplete="list">
            </div>

            <div class="col-md-4 nopad"><label> TO</label>
              <input name="to" id="bus-station-to" style="color:#000 !important" class="ft departbus iconLoc contr_form pad_twofive ui-autocomplete-input" placeholder="To" value="<?php echo (isset($to) || $to != '') ? $to:''?>" type="text" autocomplete="off" aria-autocomplete="list"></div>

            <div class="col-md-2 nopad"><label> DATE</label>
              <input name="bus_depature" style="color:#000 !important" class="ft departflight iconLoc contr_form pad_twofive hasDatepicker ui-autocomplete-input" id="bus_depature" placeholder="" value="<?php echo (isset($bus_depature) || $bus_depature != '') ? $bus_depature:''?>" type="text" autocomplete="off"></div>

            <div class="col-md-2 nopad"><label> &nbsp;</label><button> search</button></div>
          </form>
         </div>

      </div>

      

      <div class="wrapper_reslut_bus">

         <div class="container ">

            <div class="col-md-3">

              
               <div class="col-md-12 nopad main_bus_details_head" style="">

                  <div class="col-md-12 nopad">
                     <div class="text-center pdt15"><span id="total_records">0</span> Buses <span>found</span></div>
                     <h3>
                      <a class="pull-right" id="reset_filters">RESET ALL</a>
                    </h3>

                  </div>

                   <div class="row">
                    <div class="filter_sec">

                                <div class="rangebox">

                                    <button class="collapsebtn" type="button" data-toggle="collapse" data-target="#price-refine">Price</button>



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

                                    <button type="button" class="collapsebtn" data-toggle="collapse"

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

                                    <button type="button" class="collapsebtn" data-toggle="collapse" data-target="#collapse504">Arrival Time</button>

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

            </div>

            <div class="col-md-9 ">

               <div class="col-md-12 nopad main_bus_details_head" style="">

                  <div class="col-md-2 nopad">

                     <h3><span id="total_records">0</span> Buses <span>found</span></h3>

                  </div>

                  <div class="col-md-2 nopad">

                     <h5>Departure</h5>

                  </div>

                  <div class="col-md-1 nopad">

                     <h5>Duration</h5>

                  </div>

                  <div class="col-md-2 nopad">

                     <h5>Arrival</h5>

                  </div>

                  <div class="col-md-1 nopad">

                     <h5>Ratings</h5>

                  </div>

                  <div class="col-md-2 nopad">

                     <h5>Seats Available</h5>

                  </div>

                  <div class="col-md-2 nopad">

                     <h5>Fare</h5>

                  </div>

               </div>

               <div class="col-md-12  main_bus_details">

                  <div class="text-center loader-image fulloading result-pre-loader-wrapper bus_preloader" >

                  Please Wait <img src="<?= ASSETS; ?>images/loader_v3.gif" alt="Loading........">

                </div>



                  <div id="bus_search_result">

                      

                  </div>

                  

               </div>

            </div>

         

         </div>

      </div>

        

      <script>



         

         

      </script>





<script type="text/javascript" src="<?= ASSETS; ?>js/bus_filter.js"></script>

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