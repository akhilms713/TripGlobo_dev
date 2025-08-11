<style type="text/css">
   .add_anima_hotel{animation: shake 0.5s !important;}
   .brdr_bx{padding: 0;border: 2px solid #fdb813; border-radius: 4px;margin-bottom: 10px;}
   .col-sm-4.col-xs-12.brdr_bx {
    width: 32.333333%;
    background: #fff;
    margin: 0px 3px;
}
   #search_hotel .ui-datepicker.ui-widget-content {
    z-index: 100000000 !important;
    width: 500px!important;
}
</style>
<?php

//Read cookie when user has not given any search starts here
if ((isset($hotel_search_params) == false) || (isset($hotel_search_params) == true && !empty($hotel_search_params) == false)) {
  $sparam = $this->input->cookie('sparam', TRUE);
  $sparam = unserialize($sparam);
  $sid = intval(@$sparam['HOTEL']);
  if ($sid > 0) {
    $this->load->model('Hotel_Model');
    $hotel_search_params = $this->Hotel_Model->get_safe_search_data($sid, true); 
    // debug($hotel_search_params);
    $hotel_search_params = $hotel_search_params['data'];
    
    if (!empty($hotel_search_params) == true) {
       if (strtotime(@$hotel_search_params['hotel_checkin']) < time()) {
        $hotel_search_params['hotel_checkin'] = date('d-m-Y', strtotime(add_days_to_date(3)));
        $hotel_search_params['hotel_checkout'] = date('d-m-Y', strtotime(add_days_to_date(5)));
       }
    }
  }
}     

if (isset($hotel_search_params['room_count']) == true) {
  $room_count_config = intval($hotel_search_params['room_count']);
} else {
  $room_count_config = 1;
}

if (isset($hotel_search_params['adult_config']) == true) {
  $room_adult_config = $hotel_search_params['adult_config'];
} else {
  $room_adult_config = array(2,1,1);
}
// debug($room_adult_config);exit;
if (isset($hotel_search_params['child_config']) == true) {
  $room_child_config = $hotel_search_params['child_config'];
} else {
  $room_child_config = array(0);
}

if (isset($hotel_search_params['child_age']) == true) {
  $room_child_age_config = $hotel_search_params['child_age'];
} else {
  $room_child_age_config = array(1);
}
//Read cookie when user has not given any search ends here

if (isset($rooms)) {
   $room_count_config = intval(@$rooms);
} else {
   $room_count_config = 1;
}

if (isset($adult)) {
   $room_adult_config = @$adult;
} else {
   $room_adult_config = array(2);
}
//debug($room_adult_config);exit;
if (isset($child)) {
   $room_child_config = $child;
} else {
   $room_child_config = array(0);
}

if (isset($childAges)) {
   $room_child_age_config = $childAges;
} else {
   $room_child_age_config = array(1);
}

?>
<?php 
        // debug($this->uri->segments(3));die; 
        // if (!(isset($this->uri->segments[3]))) {
        //   $header_product = "Flights";
        // } else {
        //   $header_product = $this->uri->segments[3];
        // }
$header_product1 = explode('/',$_SERVER['REQUEST_URI']);
       // print_r($header_product);die;
         // print_r($this->uri->segments[0]);die; 
       if($header_product1[2] =='' || $header_product1[2] =='flight' || $header_product1[2] =='subscriber'){
        $header_product = 'flight';
       }else{
        $header_product = 'hotel';
       }
      ?> 

<input type="hidden" id="getUrl1" value="<?php echo $_SERVER['REQUEST_URI']?>">
<div class="tab-pane tab_cus page_hotel <?php if(isset($header_product) && $header_product == 'hotel') echo 'active'; ?>" id="hotel">
      <form autocomplete="off" action="<?php echo WEB_URL ?>hotel/search" method="get" name="hotelSearchForm" id="hotelSearchForm">
          <input type="hidden" value="1" name="page">
         <div class="intabs">
            <div class="outsideserach ">
               <div class="col-sm-12 nopad">
                <div class="col-sm-12 col-xs-12 brdr_bx">
                  <span class="formlabel">City</span> 
                  <div class="">
                     <input type="text" required  placeholder="Region, City, Area (Worldwide)" class="ft hotelCityIp iconLoc contr_form" id="city" name="city" value="<?php if(isset($city)) { echo $city.' , '.$country; } else { echo @$hotel_search_params['location']; } ?>">
                  </div>
                  <!-- <div class="form-group">
                     <span class="formlabel">No.of Nights</span>
                     <div class="plcetogo nitmark selctmark sidebord">
                        <select class="normalsel padselct arimo form-control contr_form" id="no_of_nights">
                           <?php for($k=1;$k<=10;$k++):?>
                              <?php
                                 $selected = '';
                                 if(isset($no_of_nights)){
                                    if($no_of_nights==$k){
                                       $selected = 'selected=selected';
                                    }
                                 } 
                              ?>
                                 <option value="<?=$k?>" <?=$selected?>><?=$k?></option>
                           <?php endfor;?>
                           
                        </select>
                     </div>
                  </div> -->
                  
                  </div> 
               </div>
               <br>
               <div class="col-sm-12 col-xs-12 nopad">
                <div class="col-sm-4 col-xs-12 brdr_bx">
                  <div class="datapickerss">
                    <span class="formlabel">Checkin Date</span>
                  <input  name="checkin" id="check-in" required type="text" class="ft fromflight contr_form forminput date_picker"  value="<?php if($check_in != '') { echo  date('M d,Y' , strtotime($check_in)); } else if(isset($hotel_search_params)) { echo date('M d,Y' , strtotime(@$hotel_search_params['from_date'])); } else { echo ''; }  ?>" placeholder="Checkin Date"  readonly />
                  </div></div>
                   <div class="col-sm-4 col-xs-12 brdr_bx">
                      <div class="datapickerss">
                                    <span class="formlabel">Check Out</span>
                       <input  name="checkout" id="check-out" required type="text" class="ft fromflight contr_form forminput date_picker"  value="<?php if($check_out != '') { echo  date('M d,Y' , strtotime($check_out)); } else if(isset($hotel_search_params)) { echo date('M d,Y' , strtotime(@$hotel_search_params['to_date'])); } else { echo ''; }  ?>" placeholder="Checkout Date"  readonly />
                       </div>
                    <!-- <div class="curr_date mm" id="valdate_hotel_datepicker"></div>
                     <div id="hotel_datepicker"></div>
                      <input type="hidden" name="hotel_datepicker_val" id="hotel_datepicker_val">-->

               </div>
<div class="col-sm-4 col-xs-12 brdr_bx">
               <div class="form-group">
                    
                        <!-- <span class="formlabel">Travelers</span> -->
                        <div class="totlall">
                           <input type="hidden" value="<?=@$room_count_config?>" id="room-count" name="rooms" min="1" max="3">
                           <span class="remngwd" id="hotel-pax-summary"><?php if(empty($adult)) echo "2";?><?php echo array_sum($adult)?> Adults,<?php echo array_sum($child)?> <?php if(!empty($child)) echo 'Child,';?> <?php if(empty($rooms))echo "1";?> <?=$rooms?> Room</span>
                           <div class="roomcount">
                              <div class="inallsn">
                                <?php

                                    $max_rooms = 3;
                                    $min_adults = 2;
                                    $min_child = 0;
                                    $max_child = 2;
                                    $room = 0;
                                    $child_age_index = 0;
                                    $visible_rooms = intval($room_count_config);
                                    for ($room = 1; $room <= $max_rooms; $room++) {
                                      
                                       if (intval($room) > $visible_rooms) {
                                          $room_visibility = 'display:none';
                                       } else {
                                          $room_visibility = '';
                                       }
                                      
                                       $current_room_child_count = intval(@$room_child_config[($room-1)]);
                                ?>
                                 <div class="oneroom" id="room-wrapper-<?=$room?>" style="<?=$room_visibility?>">
                                    <div class="roomone">Room <?=$room?></div>
                                    <div class="roomrow">
                                       <div class="celroe col-xs-6">Adults<span class="agemns">(12+)</span></div>
                                       <div class="celroe col-xs-6">
                                          <div class="onlynum newhpad pax-count-wrapper">
                                             <button type="button" class="btn btn-default btn-number_h btnpot" data-type="minus" data-field="adult[]"> <span class="fa fa-minus"></span> </button>
                                             <input type="text" name="adult[]" id="adult_text_<?=$room-1?>" class="form-control input-number centertext" value="<?=intval(@$room_adult_config[$room-1])?>" data-min="1" data-max="3" readonly>
                                             <button type="button" class="btn btn-default btn-number_h btnpot btn_right" data-type="plus" data-field="adult[]"> <span class="fa fa-plus"></span> </button>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="roomrow">
                                       <div class="celroe col-xs-6">Child<span class="agemns">(2-11 yrs)</span></div>
                                       <div class="celroe col-xs-6">
                                          <div class="onlynum newhpad pax-count-wrapper">
                                             <button type="button" class="btn btn-default btn-number_h btnpot" data-type="minus" data-field="child[]"> <span class="fa fa-minus"></span> </button>
                                             <input type="text" name="child[]"  class="form-control input-number centertext" value="<?=$current_room_child_count?>" data-min="0" data-max="2" readonly>
                                             <button type="button" class="btn btn-default btn-number_h btnpot btn_right" data-type="plus" data-field="child[]"> <span class="fa fa-plus"></span> </button>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="add_remove">
                                      <!--  <div class="col-xs-6 nopad">
                                          <a class="done1 comnbtn_room1"><span class="fa fa-check"></span> Done</a>
                                       </div> -->
                                       <div class="col-xs-6 nopad">
                                          <button class="remove_rooms comnbtn_room"> <span class="fa fa-minus-circle"></span>Remove room </button>
                                       </div>
                                       <div class="col-xs-6 nopad">
                                          <button class="add_rooms comnbtn_room"> <span class="fa fa-plus-circle"></span>Add room </button>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                       <?php
                                          if ($current_room_child_count > 0) {
                                             $child_room_visibility = '';
                                          } else {
                                             $child_room_visibility = 'display:none';
                                          }
                                       ?>
                                    <div class="chilagediv" style="<?=$child_room_visibility?>">
                                       <div class="chldrnage">Children's ages at time of travel</div>
                                       <?php
                                          $child = 0;
                                          for ($child=1; $child <= $max_child; $child++) {
                                             if (($child) > $current_room_child_count) {
                                                $child_age_visibility = 'display: none;';
                                                $child_age_value = 1;
                                             } else {
                                                $child_age_visibility = '';
                                                $child_age_value = intval(@$room_child_age_config[$child_age_index+($child-1)]);
                                             }
                                             #echo "child_age_value...".$child_age_value.'<br/>';
                                       ?>
                                       <div data-child="<?=$child?>" data-currnet="<?=$current_room_child_count?>" class="col-xs-6 padfive child-age-wrapper-<?=$child?>" style="<?=$child_age_visibility?>">
                                          <div class="mrgnpadd">
                                             <div class="plcetogo selctmarksml">
                                                <select name="child_age[]" class="normalsel padselctsmal arimo full-width">
                                                  <?php for($c=1;$c<=11;$c++):?>
                                                      <?php
                                                            $c_selected='';
                                                            if($c==$child_age_value){
                                                               $c_selected ='selected=selected';
                                                            }
                                                      ?>
                                                      <option value="<?=$c?>" <?=$c_selected?>><?=$c?></option>
                                                  <?php endfor;?>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <?php
                                          }
                                          if ($current_room_child_count > 0) {
                                             $child_age_index += $max_child;
                                          }
                                       ?>
                                    </div>
                                 </div>
                                <?php
                                    }
                                 ?>
                              </div>
                           </div>
                        </div>
                     
                  </div></div>
                 <!--  <div class="curr_date" id="valdate1">October 2 2017</div>
                  <div id="datepicker1"></div> -->
                 <input type="hidden" name="page" value="1">
               <div class="clearfix"></div>
               <div class="col-md-12 col-xs-12  n100">
                   <!--   <span class="formlabel formlabel_two">&nbsp;</span> -->
                     <div class="formsubmit">
                        <button id="search_hotel" class="srchbutn comncolor btn  btn_newdaqas">Search</button>
                     </div> 
                  </div>
               </div>
              
            </div>
         </div>
      </form>
   </div>
<span class="hide">
   <input type="hidden" id="pri_visible_room" value="<?=$visible_rooms?>">
</span>



<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> 
<script>
//selcted date datepicker start
   var main_arr= new Array();
   var date_check_home,dept,req;
    <?php 
       $dep=date('m/d/Y' , strtotime($request_data['hotel_checkin'] )); 
       $req=date('m/d/Y' , strtotime($request_data['hotel_checkout'] )); 
    ?>
   
    dept="<?php echo $dep; ?>";
    retu="<?php echo $req; ?>";

    if(dept=='01/01/1970'){
       dept='';
    }
    if(retu=='01/01/1970'){
       retu='';
    }
    
    if((dept!='')&&(retu!='') ){
        var getDateArray = function(start, end) {
             var arr = new Array();
             var dt = new Date(start);
             var et = new Date(end);
             while (dt <= et) {
                 arr.push(new Date(dt));
                 dt.setDate(dt.getDate() + 1);
             }
             return arr;
         }
         var dateArr = getDateArray(dept, retu);
         for (var i = 0; i < dateArr.length; i++) {
             main_arr.push(moment(dateArr[i]).format('MM/DD/YYYY'));
         }
         $('#valdate_hotel_datepicker').html(dept+' - '+retu);
         $('#hotel_datepicker_val').val(dept+' - '+retu);
    }
//selcted date datepicker end

$(function() {
 var cur = -1, prv = -1;
$('#hotel_datepicker').datepicker( {
   
        numberOfMonths: 2,
        minDate: 0,
        beforeShowDay: function ( date ) {
          if(main_arr.length > 0){
               setTimeout(function(){  
                  $('.ui-state-default, a').removeClass('ui-state-highlight');
                 $('.ui-state-default, a').removeClass('ui-state-active');
               }, 1000);
                var length = main_arr.length;
                var a = new Date(main_arr[0]); // April 10, 2012
                var b = new Date(main_arr[length-1]); // April 20, 2012
                return [true, a <= date && date <= b ? "date-range-selected" : ""];

           }else{
            return [true, ( (date.getTime() >= Math.min(prv, cur) && date.getTime() <= Math.max(prv, cur)) ? 'date-range-selected' : '')];
          }
        },
        onSelect: function(dateText, inst) {
          main_arr = "";
          var d1, d2;
          prv = cur;
          cur = (new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay)).getTime();
          if ( prv == -1 || prv == cur ) {
            $('.date-range-selected').removeClass('date-range-selected');
             prv = cur;
             $('#valdate_hotel_datepicker').html(dateText);
             $('#hotel_datepicker_val').val(dateText);
          } else {
            $('.date-range-selected').removeClass('date-range-selected');
             d1 = $.datepicker.formatDate( 'mm/dd/yy', new Date(Math.min(prv,cur)), {} );
             d2 = $.datepicker.formatDate( 'mm/dd/yy', new Date(Math.max(prv,cur)), {} );
             $('#valdate_hotel_datepicker').html(d1+' - '+d2);
             $('#hotel_datepicker_val').val(d1+' - '+d2);
          }
          // $('#valdate_round').html(date);
          
        },
    });

});


</script>
<script type="text/javascript">
  $('.totlall').click(function(){
   	$('.roomcount').toggleClass(".fadeinn");
  });

  $('.totlall, .roomcount').click(function(e){ 
  	e.stopPropagation()
  });
</script>

<script type="text/javascript">
$("#search_hotel").click(function(){
  
    $("#hotel_datepicker").removeClass("add_anima_hotel");
    
      if($('#city').val()==''){
        alert("Please select the city");
        $('#city').focus();
        return false;
      }
      if($('#valdate_hotel_datepicker').html()==''){
            alert("Please select the date");
            $("#hotel_datepicker").addClass("add_anima_hotel");
            // $('#valdate_hotel_datepicker').focus();
            return false;
      }
      if($('#valdate_hotel_datepicker').html()!=''){
        var check_date_round=$('#valdate_hotel_datepicker').html();   
        var check_round_dat = check_date_round.indexOf("-"); 
        if(check_round_dat<=0){
           alert('Please select two dates');
           $("#hotel_datepicker").addClass("add_anima_hotel");
           return false;
        }
      }
      
// return false;
   });

</script>
 <script>
     var getUrl = ($('#getUrl1').val()).split('/');
    //  alert(getUrl[1]);
    if(getUrl[2] != ''){
        if(getUrl[2] != 'Hotels'){
            if($('.page_hotel').hasClass('hide')){
                $('.page_hotel').removeClass('hide');
            }    
        }
    }
 </script>
