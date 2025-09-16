<style>
.instops {
    margin-top: -5px;
}
.instops::after {
    left: 16px;
    right: 16px;
    top:16%;
 }
 .sideprice {
    margin-top: 24px !important;
}
.multiple_booking{
   background: #fff;
}
.multiple_cello{
   background: #fff;
    box-shadow: 0px 0px 18px 0px #b9b9b9;
}
.sidenamedesc{
       margin: 0 8%;
}
.detlnavi .widfty:last-child {
    height: 50px;
}
.detlnavi .widfty:first-child {
    height: 50px;
}
.null_data h1{
   color: #000;
   font-size: 16px;
}
.null_data{
   padding: 32px;
   background: #fff;
}
</style>

<?php 
$totel_price=0;
for ($i = 0; $i < count($onward); $i++) 
{
   if ($onward[$i]['type'] == 'onward') {      
      $segment_onward=json_decode($onward[$i]['segment_data'],1);
      $onward_data=current(current($segment_onward['Segments']));
      $onward_end=end(current($segment_onward['Segments']));  

      if (count(current($segment_onward['Segments']))== 1 ) {
         $travel_time=secondstominutes($onward_data['Duration']*60);  
      }else{  
         $travel_time=secondstominutes($onward_end['AccumulatedDuration']*60);
      } 

   $totel_price += $onward[$i]['amount'];
      $segment_on=1;
   }else{
      $segment_return=json_decode($onward[$i]['segment_data'],1);
      $return_data=current(current($segment_return['Segments']));
      // debug($return_data);exit();
      $return_end=end(current($segment_return['Segments']));  

      if (count(current($segment_return['Segments']))== 1 ) {
         $return_time=secondstominutes($return_data['Duration']*60);  
      }else{  
         $return_time=secondstominutes($return_end['AccumulatedDuration']*60);
      } 

      $segment_to=1;
   $totel_price += $onward[$i]['amount'];
   }   
   
}

?>
<div class="" style="">
   <div class="col-xs-12 nopad">
         <div class="sidenamedesc">
            <div class="multiple_booking">
            <div class="width40 celhtl" style="width: 33%;
                  box-shadow: 0px 0px 18px 0px #b9b9b9;">
               <?php if ($segment_on == 1) {?>
                  
                             
               <div class="sector_loop ">
                  <div class="celhtl   width25 midlbord">
                     <div class="fligthsmll">
                        <img src="https://c.fareportal.com/n/common/air/ai/<?=$onward_data['Airline']['AirlineCode']?>.gif" alt="">
                        
                     </div>
                     <div class="airlinename"><?=$onward_data['Airline']['AirlineName']?>                        <?=$onward_data['Airline']['AirlineCode']?> -  <?=$onward_data['Airline']['FlightNumber']?>                     </div>
                  </div>
                  <div class="celhtl width75">
                     <div class="waymensn">
                        <div class="flitruo cloroutbnd">
                           <div class="detlnavi">
                              <div class="col-xs-4  new-cus-se padflt widfty">
                                 <span class="timlbl right">
                                 <span class="flname">
                                 <?=$onward_data['Origin']['Airport']['AirportCode']?>                                 
                                 <br><span class="fltime"><?=substr(explode('T', $onward_data['Origin']['DepTime'])[1],0,5)?></span>
                              </span>

                                 </span>
                                 <div class="clearfix"></div>
                              </div>
                              <div class="col-xs-4 nopad padflt widfty">
                                  <div class="lyovrtime">                                  
                                       <span class="flect"> 
                                          <i class="fal fa-clock"></i>
                                          <span class=" hidesprite retime"></span><?=$travel_time?> </span>
                                    <div class="instops ">
                                     <a class="stopone">
                                       <label class="rounds"></label>
                                       </a>

                                    <a class="stopone">
                                       <label class="rounds oneonly"></label> &nbsp;
                                       
                                                                                </a>
                                    <a class="stopone">
                                       <label class="rounds"></label>
                                       </a>
                                       <label class="rounds1"></label>
                                       <label class="rounds1 airline_stop_filt" data-stops="0">
                                 1 Stop                                 </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xs-4 padflt widfty">
                                 <span class="timlbl left">
                                 <span class="flname">
                                 <?=$onward_end['Destination']['Airport']['AirportCode']?>                                  
                                 <br><span class="fltime"><?=substr(explode('T',$onward_end['Destination']['ArrTime'])[1],0,5)?></span> </span>
                                 </span>
                                 <div class="clearfix"></div>
                                 
                                 
                              </div>
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            <?php }else{?>
               <div class="null_data">
              <h1>Please Select the Onward Flight</h1>
               </div>
            <?php } ?>
            </div>
            <div class="width40 celhtl" style="width: 33%;
                  box-shadow: 0px 0px 18px 0px #b9b9b9;">
                              <!-- Round trip start -->
                       <?php if ($segment_to == 1) {?>       
               <div class="sector_loop ">
                  <div class="celhtl   width25 midlbord">
                     <div class="fligthsmll">
                        <img src="https://c.fareportal.com/n/common/air/ai/<?=$return_data['Airline']['AirlineCode']?>.gif"  alt="">
                        <!--<div class="flitsmdets">
                           </div>-->
                     </div>
                     <div class="airlinename"><?=$return_data['Airline']['AirlineName']?>                        <?=$return_data['Airline']['AirlineCode']?> -  <?=$return_data['Airline']['FlightNumber']?>                      </div>
                  </div>
                  <div class="celhtl width75">
                     <div class="waymensn">
                        <div class="flitruo cloroutbnd">
                           <div class="detlnavi">
                              <div class="col-xs-4  new-cus-se padflt widfty">
                                 <span class="timlbl right">
                                 <span class="flname">
                                 <?=$return_data['Origin']['Airport']['AirportCode']?>                                 
                                 <br><span class="fltime"><?=substr(explode('T',$return_data['Origin']['DepTime'])[1],0,5)?></span>
                              </span>

                                 </span>
                                 <div class="clearfix"></div>
                              </div>
                              <div class="col-xs-4 nopad padflt widfty">
                                  <div class="lyovrtime">
                                  <!--  
                                     <div class="termnl1 flo_w">
                                       <blink>Availability:  left </blink>
                                    </div> -->
                                       <span class="flect"> 
                                          <i class="fal fa-clock"></i>
                                          <span class=" hidesprite retime"></span><?=$return_time?></span>
                                    <div class="instops ">
                                     <a class="stopone">
                                       <label class="rounds"></label>
                                       </a>

                                    <a class="stopone">
                                       <label class="rounds oneonly"></label> &nbsp;
                                       
                                                                                </a>
                                    <a class="stopone">
                                       <label class="rounds"></label>
                                       </a>
                                       <label class="rounds1"></label>
                                       <label class="rounds1 airline_stop_filt" data-stops="0">
                                 1 Stop                                 </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xs-4 padflt widfty">
                                 <span class="timlbl left">
                                 <span class="flname">
                                 <?=$return_end['Destination']['Airport']['AirportCode']?>                                 
                                 <br><span class="fltime"><?=substr(explode('T',$return_end['Destination']['ArrTime'])[1],0,5)?></span> </span>
                                 </span>
                                 <div class="clearfix"></div>
                                 
                                 <!--  -->
                              </div>
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php }else{ ?>
                <div class="null_data">
              <h1>Please Select the Return Flight</h1>
               </div>
            <?php } ?>
            </div>
            <div class="celhtl multiple_cello new-width20 width20 " >
               <div class="sidepricewrp" data-price="INR <?=$totel_price?>">
                  <div class="sideprice">
                     INR <?=$totel_price?>  
                  </div>
                  <?php  
                     
                     $data_v['sessionid'] = array_column($onward, 'session_id');
                     $data_v['id'] = array_column($onward, 'flight_id');
                     $data_v['search_id'] = $search_id;
                     $data_v['api_name'] = array_column($onward, 'api_name');
                     $data_v['search_module'] = 'FLIGHT';
                     $uid  =  base64_encode(json_encode($data_v));
                     
                     ?>
                                    <div class="bookbtn">
                     <?php if (count($onward)==2) {?>                        
                     <a class="booknow FlightbookNowfinal" data-target="_blank" data-attr="<?=$uid ?>">Book</a>
                   <?php  }else{?>

                     <a class="booknow FlightbookNowfinal disabled" data-target="_blank" data-attr="<?=$uid ?>">Book</a>
                  <?php }  ?>                  
                  </div>
               
               </div>
            </div>
            </div>
         </div>
      </div>
</div>


<?php
 function secondstominutes($init){
    
$day = floor($init / 86400);
$hours = floor(($init -($day*86400)) / 3600);
$minutes = floor(($init / 60) % 60);
$seconds = $init % 60;

if(strlen($minutes)==1){
   $minutes='0'.$minutes;
}
if(strlen($hours)==1){
   $hours='0'.$hours;
}

if ($day==0) {
   
return "$hours".'h'.":$minutes".'m';
}else{

return "$day".'d'.":$hours".'h'.":$minutes".'m';
}
 }
?>
