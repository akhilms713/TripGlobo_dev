<?php
// error_reporting(0);
//  $limit=10;
//  $from=0;
//  $to=9;

$GLOBALS['CI']->load->model('bus_model');
// $getBusMarkup = $GLOBALS['CI']->bus_model->get_markup_B2C('GENERAL',2);
 //debug($raw_bus_list);die;


foreach ($raw_bus_list as $__bk => $__bv) {
// debug($__bv);exit();
   // if($__bk ==0){
//   if($__bk >= $from && $__bk <= $to )
//   {

   // if(($getBusMarkup[0]->markup_fixed)>0 && ($getBusMarkup[0]->markup_fixed)!='')
   // {
   //     $__bv['BusPrice']['admin_markup'] = $getBusMarkup[0]->markup_fixed;
   // }
   // else{
   //     $mark= $getBusMarkup[0]->markup_value;
   //     $markVal=$mark/100;
   //     $__bv['BusPrice']['admin_markup']=$__bv['BusPrice']['PublishedPriceRoundedOff']*$markVal;
   //  // $bus_fare = $addmarkval=$__bv['BusPrice']['OfferedPriceRoundedOff']+$getmarkval;
   //  // debug($__bv['BusPrice']['admin_markup']);die;
   // }

    $filt_dept_time = str_replace('T', ' ', $__bv['DepartureTime']);

    $filt_arrv_time = str_replace('T', ' ', $__bv['ArrivalTime']);

    $route_id = $__bv['ResultIndex'].'*'.$search_id.'*'.$TraceId.'*'.$tokenId.'*'.$session_id;

    $cancellationpolicy = $__bv['CancellationPolicies'];       

    // $bus_fare = $__bv['BusPrice']['PublishedPriceRoundedOff'];

    $bus_fare = $__bv['BusPrice']['PublishedPriceRoundedOff'] + @$__bv['BusPrice']['admin_markup']+@$__bv['BusPrice']['agent_markup_price'];
   // debug($bus_fare);die;

    $s2s_duration = calculate_duration($__bv['DepartureTime'], $__bv['ArrivalTime']);

   
  //debug($__bv);

?>

<style type="text/css">

.load-img{
  width: 100px;
  margin: 0 auto;
  text-align: center;
  display: flex;justify-content: center;align-items: center;
}
.main_bus_details.busrows.r-r-i{
  padding-left: 20px;
}
.main_bus_details {
  border-bottom: 1px solid #ececec;
  padding: 10px 10px 10px;
  }
.main_bus_details h6 {
  text-align: center;
}
.each_bus_details{
  display: flex;
  align-items: center;
}
.bus_type{
  font-size: 12px !important;
  text-align: left !important;
}
.new_addtionl_textz_n{
  padding-left: 18px;
}
.droping_end::before {
  left: -25px;
}
</style>
	 <div class="main_bus_details busrows r-r-i">
   	 <div class="col-md-12 each_bus_details">

      <div class="col-md-2 nopad">

         <h4><?=$__bv['TravelName']?></h4>

         <h5 class="bus_type"><?=$__bv['BusType']?></h5>
      </div>
 
      <div class="col-md-2 nopad departure_datetime" data-departure-category="<?=time_filter_category($__bv['DepartureTime'])?>">

         <h5 class="departure_datetime_filter hide"><?php 
         	$new_time = DateTime::createFromFormat('h:i A', get_time($__bv['DepartureTime']));
			     $time_24 = $new_time->format('H:i:s');
			     $parsed = date_parse($time_24);
			     $seconds = $parsed['hour'] * 60 + $parsed['minute'];
         	echo($seconds);?>		
         </h5>
         <h6><?=date('Y-M-d',strtotime((explode('T',$__bv['DepartureTime'])[0])))?></h6>
         <h5 class="addtionl_ad"><?=get_time($__bv['DepartureTime'])?></h5>
      </div>

      <div class="col-md-1 nopad">
         <span><?php 
         $time1 = new DateTime($filt_arrv_time);
       	 $time2 = new DateTime($filt_dept_time);
       	 $time_diff = $time1->diff($time2);
			echo $time_diff->h.' H ';
			echo $time_diff->i.' M ';?></span>
      </div>

       <h5 class="arrivaltime_datetime_filter hide"><?php 
            $new_time = DateTime::createFromFormat('h:i A', get_time($__bv['ArrivalTime']));
         	$time_24 = $new_time->format('H:i:s');
         	$parsed = date_parse($time_24);
         	$seconds = $parsed['hour'] * 60 + $parsed['minute'];
        	echo($seconds);?>
      </h5>

      <div class="col-md-2 nopad arrival_datetime" data-arrival-category="<?=time_filter_category($__bv['ArrivalTime'])?>">
         <h6><?=date('Y-M-d',strtotime((explode('T',$__bv['ArrivalTime'])[0])))?></h6>
         <h5><?=get_time($__bv['ArrivalTime'])?></h5>
      </div>

      <div class="col-md-2 nopad">
         <h6 class="addtionl_seat_filter hide"><?=$__bv['AvailableSeats'] ?></h6>
         <h6 class="addtionl_seat"><?=$__bv['AvailableSeats'] ?> Seat Availability</h6>
      </div>

      <div class="col-md-3 nopad checking bus_price" data-price="<?=$bus_fare?>">
         <p class='price-order hide' ><?=round($bus_fare)?></p>
         <center >₹ <?=round($bus_fare)?></center>
         <form action="" method="GET" class="book-form">

                     <input type="hidden" name="route_schedule_id" class="route-schedule-id" value="<?=$route_id?>">

                     <input type="hidden" name="bus_res" class="route-schedule-id" value="<?=serialized_data($__bv)?>">

                     <input type="hidden" name="totalbus_res" class="route-schedule-id" value="<?=serialized_data($totalbus_res) ?>">

                     <!-- <button class ="inner-summary-btn preloader" id="changeClass" data-index="<?=$__bv['ResultIndex']?>" >Select Seat</button> -->
                       <button class="bookNow-summary-btn preloader" type="button" data-toggle="collapse" data-target="#select_seats_<?=$__bv['ResultIndex']?>" aria-expanded="false" data-index="<?=$__bv['ResultIndex']?>" aria-controls="collapseExample">Book Now</button>


                  </form>
      </div>
   	  </div>
      <!-- start --> 
      <div class="col-md-12 amintis_newdw">

         <div class="tab_o">

            <ul>

              <li class="tablinks bording_drop-show" id="">

                  <!-- Boarding & Dropping Point</button> -->

                  <form action="" method="GET" class="book-form">

                     <input type="hidden" name="route_schedule_id" class="route-schedule-id" value="<?=$route_id?>">

                     <input type="hidden" name="bus_res" class="route-schedule-id" value="<?=serialized_data($__bv)?>">

                     <input type="hidden" name="totalbus_res" class="route-schedule-id" value="<?=serialized_data($totalbus_res) ?>">

                     <!--<button class ="boarding-summary-btn" data-index="<?=$__bv['ResultIndex']?>" >Boarding & Dropping Point</button>-->
 			               <button class="boarding-summary-btn" type="button" data-toggle="collapse" data-target="#boarding_<?=$__bv['ResultIndex']?>" aria-expanded="false" data-index="<?=$__bv['ResultIndex']?>" aria-controls="collapseExample">Boarding & Dropping Point</button>
                  </form>

              </li>

               <li class="tablinks cancel_policy-show" id="">

                  <!-- Cancellation Policy</button> -->

                  <form action="" method="GET" class="book-form">

                     <input type="hidden" name="route_schedule_id" class="route-schedule-id" value="<?=$route_id?>">

                     <input type="hidden" name="bus_res" class="route-schedule-id" value="<?=serialized_data($__bv)?>">

                     <input type="hidden" name="totalbus_res" class="route-schedule-id" value="<?=serialized_data($totalbus_res) ?>">

                    <!--  <button class ="cancellation-policy-btn" >Cancellation Policy</button> -->
                      <button class="cancellation-policy-btn" type="button" data-toggle="collapse" data-target="#cancel_policy_<?=$__bv['ResultIndex']?>" aria-expanded="false" data-index="<?=$__bv['ResultIndex']?>" aria-controls="collapseExample">Cancellation Policy</button>

                  </form>

               </li>
               <li class="tablinks selsect_seat-show" id="" >

                     <!-- Select Seat</button> -->

                  <form action="" method="GET" class="book-form">

                     <input type="hidden" name="route_schedule_id" class="route-schedule-id" value="<?=$route_id?>">

                     <input type="hidden" name="bus_res" class="route-schedule-id" value="<?=serialized_data($__bv)?>">

                     <input type="hidden" name="totalbus_res" class="route-schedule-id" value="<?=serialized_data($totalbus_res) ?>">

                     <!-- <button class ="inner-summary-btn preloader" id="changeClass" data-index="<?=$__bv['ResultIndex']?>" >Select Seat</button> -->
                      <button class="inner-summary-btn preloader" type="button" data-toggle="collapse" data-target="#select_seats_<?=$__bv['ResultIndex']?>" aria-expanded="false" data-index="<?=$__bv['ResultIndex']?>" aria-controls="collapseExample">Select Seat</button>


                  </form>

               </li>

            </ul>

         </div>
      </div>

      <div id="" class="tabcontent_o amenities-hidden" style="display: none;">

         <div class="col-md-12 new_addtionl_textz">

            <div class="col-md-3">

               <li> <i class="fa fa-wifi" aria-hidden="true"></i> WIFI</li>

            </div>

            <div class="col-md-3">

               <li><i class="fa fa-plug" aria-hidden="true"></i>Charging Point </li>

            </div>

            <div class="col-md-3">

               <li> <i class="fa fa-bus" aria-hidden="true"></i>Track My Bus</li>

            </div>

            <div class="col-md-3">

               <li>

            </div>

            <div class="col-md-3"><li><i class="fa fa-phone-square" aria-hidden="true"></i>Emergency Contact Number</li></div>

         </div>
      </div>
	  <div id="boarding_<?=$__bv['ResultIndex']?>" class="tabcontent_o bording_drop-hidden collapse" >

              <div class="col-md-12 new_addtionl_textz_n">

                  <div id="drop_<?=$__bv['ResultIndex']?>" class="boarding_drop_points"> 
                <!--   <p>

                     Please wait...
                  </p>  -->     
                     <img src="<?= base_url()?>assets/busLoader/bus_seat_loader.gif" class="load-img">  
                        </div>

                  <div class="col-md-8 nopad"> </div>

               </div>
      </div> 

      <div id="cancel_policy_<?=$__bv['ResultIndex']?>" class="tabcontent_o cancellation_policy_hidden collapse" >

              <div class="col-md-12 new_addtionl_textz_n_cancel">

                  <div id="cancelPolicy_<?=$__bv['ResultIndex']?>" class="cancellation_policy_points"> 
                   
                     <!--<img src="<?= base_url()?>assets/busLoader/boarding_loader.gif" class="load-img">  -->
                        </div>
                          <table class="table table-condensed table-bordered table-striped">
				<tr>
				<th>Cancellation Time</th>
				<th>Cancellation Charges</th>
				</tr>
			 	<?php 
          		foreach($__bv['CancellationPolicies'] as $vals)
          		{
            	// echo "<pre>"; print_r($vals);
          
          		?>
      
				<tr>
			    <td><?= $vals['PolicyString']?></td>
			    <td><?php
             	if ($vals['CancellationChargeType']== 2) {
                if (isset($vals['CancellationCharge'])) {
                   echo $vals['CancellationCharge'].' %';
                }else{
                   echo '10 %';
                }
             	}else{
               echo $vals['CancellationCharge'].' INR';
             	}

              	?></td>
			    
				</tr>
				<?php } ?>
			
				</table>

                  <div class="col-md-8 nopad"> </div>

               </div>
      </div>
   
      <div id="" class="tabcontent_o cancel_policy-hidden" style="display: none;">

         <div class="col-md-12 new_addtionl_textz_z">

            <h4>   Your current cancellation charges according to the cancellation policy is highlighted below </h4>

       

         </div>
      </div>

      <div id="select_seats_<?=$__bv['ResultIndex']?>" class="tabcontent_o selsect_seat-hidden collapse" >
         <div class="col-md-12 new_addtionl_textz_x">
            <div id="newyarok" class="tabcontent_o ">
               <div class="col-md-12 new_addtionl_textz_x">
                  <div id="seat_<?=$__bv['ResultIndex']?>" class="room-summ">   
                     <img src="<?= base_url()?>assets/busLoader/bus_seat_loader.gif" class="load-img"/>  
                  </div>
                  <div class="col-md-12 nopad"> </div>
               </div>
            </div>
         </div>
      </div> 

       <div class="inner-summary-toggle" style="display:none;">
          <div class="buseatselct"></div>
       </div>
   </div>
  
   
     
    
      <!--<div id="boarding_<?=$__bv['ResultIndex']?>" class="tabcontent_o bording_drop-hidden" style="display: none;">-->

      <!--   <div class="col-md-12 new_addtionl_textz_n">-->

      <!--      <div class ="boarding_drop_points" id="drop_<?=$__bv['ResultIndex']?>">-->

      <!--      </div>-->



      <!--   </div>-->

      <!--</div> -->
          <!-- <div id="select_seats_book_<?=$__bv['ResultIndex']?>" class="tabcontent_o selsect_seat-hidden collapse" >

         <div class="col-md-12 new_addtionl_textz_x_booknow">

            <div id="newyarok" class="tabcontent_o ">

               <div class="col-md-12 new_addtionl_textz_x_booknow">

                  <div id="booknow_<?=$__bv['ResultIndex']?>" class="book_room_summ"> 
                
                     <img src="<?= base_url()?>assets/busLoader/bus_seat_loader.gif" class="load-img">  
                        </div>

                  <div class="col-md-8 nopad"> </div>

               </div>

              

            </div>

        

         </div>

      </div> --> 

      

<?php


}

?>


