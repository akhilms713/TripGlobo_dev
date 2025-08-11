<style>
   span.flitrlbl.elipsetool {
   /* display: none;*/
   font-size: 12px;
   }
   .spn{
   color: #055dad;
   font-weight: 600;
   }
   .mrinfrmtn {
   overflow: initial;
   }
   .popover.top {
   top: -90px!important;
   /*left: 557.516px!important;*/
   height:100px!important;
   right:0!important;
   padding: 15px 0px;
   }
   .popover {
   left: unset!important;
   }
   .frm{
   height: 28px!important;
   width: 120px!important;
   padding: 4px 12px!important;
   margin-bottom: 10px;
   }
   .popover.top>.arrow {
   margin-left: 30px!important;
   }
   .popover-content {
   padding: 0px 14px;
   }
   .inputError {
    border: 1px solid #b51010 !important;
   }
   .tooltip.top {
    padding: 6px 0 4px;
  }
  .md_side_txt{
    border-left: 1px solid #ccc;
    padding-left: 8px;
    color: #717171;
    margin-left: 5px;
  }
</style>
<div class="carttoloadr"><strong>Confirming your flight...</strong></div>
<?php if(!empty($flight_result)){ //echo '<pre>';print_r($flight_result);exit('views');
   $flight_count_result=count($flight_result);
   for($i=0;$i<$flight_count_result;$i++){ ?>
<?php if($flight_result[$i]['api_name']=="AMADEUS"){ ?>
<div class="rowresult">
   <div class="madgrid">
      <div class="col-xs-12 nopad">
         <div class="sidenamedesc">
            <div class="width80 celhtl">
               <?php   $detail_count = count($flight_result[$i]['FlightDetails']);
                  for($j=0;$j<$detail_count;$j++){
                      //echo '<pre/>';print_r($flight_result[$i]['FlightDetails'][$j]['stops']);exit;
                  
                  
                  
                      if(isset($flight_result[$i]['FlightDetails'][$j]['flightId']) && $flight_result[$i]['FlightDetails'][$j]['flightId'] != ''){
                          $flight_id=$flight_result[$i]['FlightDetails'][$j]['flightId'];
                          $inner_segment_len=count($flight_result[$i]['FlightDetails'][$j]['dateOfDeparture']) - 1; ?>
               <!-- Round trip start -->
               <div class="sector_loop <?=$hide_class?>">
                  <div class="celhtl   width25 midlbord">
                     <div class="fligthsmll">
                        <img src="https://c.fareportal.com/n/common/air/ai/<?php echo $flight_result[$i]['FlightDetails'][$j]['marketingCarrier'][0]; ?>.gif"; alt="" />
                        <!--<div class="flitsmdets">
                           </div>-->
                     </div>
                     <div class="airlinename"><?php echo $flight_result[$i]['FlightDetails'][$j]['airlineName'][0]; ?>
                        <?php echo $flight_result[$i]['FlightDetails'][$j]['marketingCarrier'][0]; ?> -  <?php echo $flight_result[$i]['FlightDetails'][$j]['flightOrtrainNumber'][0]; ?>
                     </div>
                  </div>
                  <div class="celhtl width75">
                     <div class="waymensn">
                        <div class="flitruo cloroutbnd">
                           <div class="detlnavi">
                              <div class="col-xs-3  new-cus-se padflt widfty">
                                 <span class="timlbl right">
                                 <span class="flname">
                                 <?php echo  $flight_result[$i]['FlightDetails'][$j]['locationIdDeparture'][0]; ?>
                                 <span class="fltime"><?php echo $flight_result[$i]['FlightDetails'][$j]['DepartureTime'][0];   ?></span></span>
                                 </span>
                                 <div class="clearfix"></div>
                                 <span class="flitrlbl elipsetool"><?php echo date('D M d,Y',strtotime($flight_result[$i]['FlightDetails'][$j]['DepartureDate'][0])); ?> </span>
                                 <div class="rndplace"><?php echo $this->Flight_Model->get_airport_cityname($flight_result[$i]['FlightDetails'][$j]['locationIdDeparture'][0]); ?></div>
                              </div>
                              <div class="col-xs-3 nopad padflt widfty">
                                 <div class="lyovrtime">
                                    <!-- <div class="termnl1 flo_w">
                                       <blink>Availability: <?php //echo $flight_result[$i]['PricingDetails'][0]['PriceInfo']['fareDetails'][$j]['avlStatus'][0]; ?> left </blink>
                                    </div> -->
                                    <div class="instops <?php if($flight_result[$i]['FlightDetails'][$j]['stops'] > 1) echo 'morestop'; if($flight_result[$i]['FlightDetails'][$j]['stops'] > 2) echo 'plusone'; ?>">
                                     <a class="stopone">
                                       <label class="rounds"></label>
                                       </a>

                                    <a class="stopone">
                                       <label class="rounds <?php if($flight_result[$i]['FlightDetails'][$j]['stops'] != 2) echo 'oneonly'; ?>"></label> &nbsp
                                       
                                         <?php if($flight_result[$i]['FlightDetails'][$j]['stops']!=0){ ?>
                                       <label class="rounds oneplus" data-toggle="tooltip" data-placement="top" title="Hooray!"></label> 
                                       <?php } ?>
                                       </a>
                                    <a class="stopone">
                                       <label class="rounds"></label>
                                       </a>
                                       <label class="rounds1"><?php  echo $flight_result[$i]['FlightDetails'][$j]['locationIdDeparture'][0]; ?></label>
                                       <?php for($s=0;$s<count($flight_result[$i]['FlightDetails'][$j]['locationIdArival']);$s++){ ?>
                                       <label class="rounds1">-<?php  echo $flight_result[$i]['FlightDetails'][$j]['locationIdArival'][$s]; ?></label>
                                       <?php } ?>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xs-3 padflt widfty">
                                 <span class="timlbl left">
                                 <span class="flname">
                                 <?php echo  $flight_result[$i]['FlightDetails'][$j]['locationIdArival'][$inner_segment_len]; ?>
                                 <span class="fltime"><?php echo $flight_result[$i]['FlightDetails'][$j]['ArrivalTime'][$inner_segment_len];  ?></span> </span>
                                 </span>
                                 <div class="clearfix"></div>
                                 <span class="flitrlbl elipsetool"><?php
                                    echo date('D M d,Y',strtotime($flight_result[$i]['FlightDetails'][$j]['ArrivalDate'][$inner_segment_len]));
                                    ?></span>
                                 <div class="rndplace"><?php echo $this->Flight_Model->get_airport_cityname($flight_result[$i]['FlightDetails'][$j]['locationIdArival'][$inner_segment_len]); ?></div>
                                 <?php if(!empty($flight_result[$i]['PricingDetails'][0]['PriceInfo']['fareDetails'][$j]['avlStatus'][0])){ ?>
                                 <?php } ?>
                              </div>
                              <div class="col-xs-3 new-div">
                                 <span class="flect"> <i class="fal fa-clock"></i><span class=" hidesprite retime"></span> <?php

                                   $oo=explode(':', $flight_result[$i]['FlightDetails'][$j]['durationFinalEft']);
                                   $oo1=explode(" ", $oo[0]);
                                    if($oo1[0]==0){
                                       echo $oo[1].$oo[2];
                                    }else{
                                       echo $flight_result[$i]['FlightDetails'][$j]['durationFinalEft'];
                                    }


                                   ?></span>
                                 <label class="rounds1 airline_stop_filt" data-stops="<?=$flight_result[$i]['FlightDetails'][0]['stops']?>">
                                 <?php  
                                    if($flight_result[$i]['FlightDetails'][$j]['stops']==0){
                                        echo "Non-Stop";
                                    }else{
                                        echo $flight_result[$i]['FlightDetails'][$j]['stops']." "."Stop"; 
                                    }
                                    ?>
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php }  }   ?>
            </div>
            <div class="celhtl new-width20 width20 <?=$hide_class?>">
               <div class="sidepricewrp"  data-price="<?= $this->display_icon.' '. number_format(($flight_result[$i]['amount'] * $this->curr_val), 2); ?>">
                  <div class="sideprice">
                     <?= $this->display_icon.' '. number_format(($flight_result[$i]['amount'] * $this->curr_val), 2); ?>
                  </div>
                  <?php
                     $data_v['sessionid'] = $flight_result[$i]['session_id'];
                     $data_v['id'] = $flight_result[$i]['flight_id'];
                     $data_v['search_id'] = @$search_id;
                     $data_v['api_name'] = $flight_result[$i]['api_name'];
                     $data_v['search_module'] = 'FLIGHT';
                     $uid  =  base64_encode(json_encode($data_v));
                     
                     ?>
                  <div class="bookbtn">
                     <a class="booknow FlightbookNow" data-target="_blank" data-attr="<?php echo $uid; ?>">Book</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="mrinfrmtn <?=$hide_class?>">
         <div class="accordion" id="accordion<?=$flight_result[$i]['flight_id'];?>" role="tablist" aria-multiselectable="true">
             <div class="col-md-12 nopad">




               <a class="detailsflt" data-toggle="collapse" onclick="show_flightpopup(this, '<?php echo  $flight_result[$i]['flight_id'];  ?>', 'itenerary')"  data-target="#flight_details_<?php echo  $flight_result[$i]['flight_id'];  ?>" data-parent="#accordion<?php echo  $flight_result[$i]['flight_id'];  ?>" aria-expanded="false" aria-controls="#flight_details_<?php echo  $flight_result[$i]['flight_id'];  ?>"> <span class="sprite"></span> <i class="fal fa-info-circle"></i> More Details <!-- <span class="md_side_txt"><img src="<?php echo ASSETS;?>images/seat.png" alt="" /> sdfsdf</span> --> </a>




               <!--     <a class="detailsflt" data-toggle="collapse" onclick="show_flightpopup(this, '<?php echo  $flight_result[$i]['flight_id']; ?>', 'faredets')" data-target="#flight_fare_<?php echo  $flight_result[$i]['flight_id'];  ?>" data-parent="#accordion<?php echo  $flight_result[$i]['flight_id'];  ?>" aria-expanded="false" aria-controls="#flight_fare_<?php echo  $flight_result[$i]['flight_id'];  ?>"> <span class="sprite"></span><i class="fal fa-usd-circle"></i> Fare Details</a>
                  <a class="detailsflt" data-toggle="collapse" onclick="show_flightpopup(this, '<?php echo  $flight_result[$i]['flight_id']; ?>', 'farerule')" data-target="#flight_farerules_<?php echo  $flight_result[$i]['flight_id'];  ?>" data-parent="#accordion<?php echo  $flight_result[$i]['flight_id'];  ?>" aria-expanded="false" aria-controls="#flight_farerules_<?php echo  $flight_result[$i]['flight_id'];  ?>"> <span class="sprite"></span><i class="fa fa-list-ul" aria-hidden="true"></i>Fare Rules</a> -->
               <?php if(strpos($flight_result[$i]['paxFareProduct'][0]['fare'][0]['pricingMessage']['description'], 'NON') == false){
                  $pre_attr = 'R';
                  $refund_type = 'Refundable';
                  } else{
                  $pre_attr = 'NR';
                  $refund_type = 'Non-Refundable';
                  }
                  ?>
               <div class="refund pull-right" data-type="<?=$pre_attr?>">
                  <a class="detailsflt fare_flight" data-toggle="collapse">
                  <span><?php echo $refund_type ?></span>
                  </a>
               </div>
            </div>
            <div class="collapse flight_res" id="flight_details_<?php echo  $flight_result[$i]['flight_id'];  ?>" data-parent="#accordion<?php echo  $flight_result[$i]['flight_id'];  ?>">
               <div class="load_details"><img src="<?php echo ASSETS;?>images/loader.gif" alt="" /></div>
            </div>
            <div class="collapse" id="flight_fare_<?php echo  $flight_result[$i]['flight_id'];  ?>" data-parent="#accordion<?php echo  $flight_result[$i]['flight_id'];  ?>">
            </div>
            <div class="collapse" id="flight_farerules_<?php echo  $flight_result[$i]['flight_id'];  ?>" data-parent="#accordion<?php echo  $flight_result[$i]['flight_id'];  ?>">
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<?php }elseif($flight_result[$i]['api_name']=="TBO"){ ?>
<div class="rowresult">
   <div class="madgrid">
      <div class="col-xs-12 nopad">
         <div class="sidenamedesc">
            <div class="width80 celhtl">
               <?php   $detail_count = count($flight_result[$i]['FlightDetails']['Segments']);
                  for($j=0;$j<$detail_count;$j++){
                      //echo '<pre/>';print_r($flight_result);exit("225");

                      $inner_segment_len=count($flight_result[$i]['FlightDetails']['Segments'][$j])-1;

                     ?>
               <!-- Round trip start -->
               <div class="sector_loop <?=$hide_class?>">
                  <div class="celhtl   width25 midlbord">
                     <div class="fligthsmll">
                        <img src="https://c.fareportal.com/n/common/air/ai/<?php echo $flight_result[$i]['FlightDetails']['Segments'][$j][0]['Airline']['AirlineCode']; ?>.gif"; alt="" />
                        <!--<div class="flitsmdets">
                           </div>-->
                     </div>
                     <div class="airlinename"><?php echo $flight_result[$i]['FlightDetails']['Segments'][$j][0]['Airline']['AirlineName']; ?>
                        <?php echo $flight_result[$i]['FlightDetails']['Segments'][$j][0]['Airline']['AirlineCode']; ?> -  <?php echo $flight_result[$i]['FlightDetails']['Segments'][$j][0]['Airline']['FlightNumber']; ?>
                     </div>
                  </div>
                  <div class="celhtl width75">
                     <div class="waymensn">
                        <div class="flitruo cloroutbnd">
                           <div class="detlnavi">
                              <div class="col-xs-3  new-cus-se padflt widfty">
                                 <span class="timlbl right">
                                 <span class="flname">
                                 <?php echo  $flight_result[$i]['FlightDetails']['Segments'][$j][0]['Origin']['Airport']['AirportCode']; ?>
                                 <span class="fltime"><?php 

                                 $dep= explode('T', $flight_result[$i]['FlightDetails']['Segments'][$j][0]['Origin']['DepTime']);
                                  $drt=explode(':',$dep[1]);
                                 echo $drt[0].':'.$drt[1];

                                   ?></span></span>
                                 

                                 </span>
                                 <div class="clearfix"></div>
                                 <span class="flitrlbl elipsetool"><?php echo date('D M d,Y',strtotime($dep[0])); ?> </span>
                                 <div class="rndplace"><?php echo $flight_result[$i]['FlightDetails']['Segments'][$j][0]['Origin']['Airport']['CityName']; ?></div>
                              </div>
                              <div class="col-xs-3 nopad padflt widfty">
                                  <div class="lyovrtime">
                                  <!--  
                                     <div class="termnl1 flo_w">
                                       <blink>Availability: <?php echo $flight_result[$i]['PricingDetails'][0]['PriceInfo']['fareDetails'][$j]['avlStatus'][0]; ?> left </blink>
                                    </div> -->

                                    <div class="instops <?php if($flight_result[$i]['FlightDetails']['Segments'][$j]['stops'] > 1) echo 'morestop'; if($flight_result[$i]['FlightDetails'][$j]['stops'] > 2) echo 'plusone'; ?>">
                                     <a class="stopone">
                                       <label class="rounds"></label>
                                       </a>

                                    <a class="stopone">
                                       <label class="rounds <?php if($flight_result[$i]['FlightDetails']['Segments'][$j]['stops'] != 2) echo 'oneonly'; ?>"></label> &nbsp
                                       
                                         <?php if($flight_result[$i]['FlightDetails']['Segments'][$j]['stops']!=0){ ?>
                                       <label class="rounds oneplus" data-toggle="tooltip" data-placement="top" title="Hooray!"></label> 
                                       <?php } ?>
                                       </a>
                                    <a class="stopone">
                                       <label class="rounds"></label>
                                       </a>
                                       <label class="rounds1"><?php  echo $flight_result[$i]['FlightDetails']['Segments'][$j]['locationIdDeparture'][0]; ?></label>
                                       <?php for($s=0;$s<count($flight_result[$i]['FlightDetails']['Segments'][$j]['locationIdArival']);$s++){ ?>
                                       <label class="rounds1">-<?php  echo $flight_result[$i]['FlightDetails']['Segments'][$j]['locationIdArival'][$s]; ?></label>
                                       <?php } ?>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xs-3 padflt widfty">
                                 <span class="timlbl left">
                                 <span class="flname">
                                 <?php echo  $flight_result[$i]['FlightDetails']['Segments'][$j][$inner_segment_len]['Destination']['Airport']['AirportCode']; ?>
                                 <span class="fltime"><?php 

                                 $arr=explode('T',$flight_result[$i]['FlightDetails']['Segments'][$j][$inner_segment_len]['Destination']['ArrTime']); 
                                 $art=explode(':',$arr[1]);
                                 echo $art[0].':'.$art[1];

                                  ?></span> </span>
                                 </span>
                                 <div class="clearfix"></div>
                                 <span class="flitrlbl elipsetool"><?php
                                    echo date('D M d,Y',strtotime($arr[0]));
                                    ?></span>
                                 <div class="rndplace"><?php echo $flight_result[$i]['FlightDetails']['Segments'][$j][$inner_segment_len]['Destination']['Airport']['CityName']; ?></div>
                                 <!-- <?php if(!empty($flight_result[$i]['PricingDetails'][0]['PriceInfo']['fareDetails'][$j]['avlStatus'][0])){ ?>
                                 <?php } ?> -->
                              </div>
                              <div class="col-xs-3 new-div">
                                 <span class="flect"> <i class="fal fa-clock"></i><span class=" hidesprite retime"></span> <?php

                                  $tot_mins = $flight_result[$i]['FlightDetails']['Segments'][$j][$inner_segment_len]['Duration'];
                                  $days = floor($tot_mins / 1440);
                                  $hours = floor(($tot_mins % 1440)/60);
                                  $mins = floor($tot_mins % 60);
                                  echo $days.' d: '.$hours.' h: '. $mins;

                                    if($flight_result[$i]['FlightDetails']['Segments'][$j][$inner_segment_len]['StopOver']==''){
                                      $sto='0';
                                    }else{
                                      $sto=$flight_result[$i]['FlightDetails']['Segments'][$j][$inner_segment_len]['StopOver'];
                                    }

                                   ?></span>
                                 <label class="rounds1 airline_stop_filt" data-stops="<?= $sto;?>">
                                 <?php  
                                    if($sto==0){
                                        echo "Non-Stop";
                                    }else{
                                        echo $sto." "."Stop"; 
                                    }
                                    ?>
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php   }   ?>
            </div>
            <div class="celhtl new-width20 width20 <?=$hide_class?>">
               <div class="sidepricewrp"  data-price="<?= $this->display_icon.' '. number_format(($flight_result[$i]['amount']), 2); ?>">
                  <div class="sideprice">
                     <?= $this->display_icon.' '. number_format(($flight_result[$i]['amount']), 2); ?>
                  </div>
                  <?php
                     $data_v['sessionid'] = $flight_result[$i]['session_id'];
                     $data_v['id'] = $flight_result[$i]['flight_id'];
                     $data_v['search_id'] = @$search_id;
                      $data_v['api_name'] = $flight_result[$i]['api_name'];
                     $data_v['search_module'] = 'FLIGHT';
                     $uid  =  base64_encode(json_encode($data_v));
                     
                     ?>
                  <div class="bookbtn">
                     <a class="booknow FlightbookNow" data-target="_blank" data-attr="<?php echo $uid; ?>">Book</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="mrinfrmtn <?=$hide_class?>">
         <div class="accordion" id="accordion<?=$flight_result[$i]['flight_id'];?>" role="tablist" aria-multiselectable="true">
            <div class="col-md-12 nopad">
               <a class="detailsflt" data-toggle="collapse" onclick="show_flightpopup_t(this, '<?php echo  $flight_result[$i]['flight_id'];  ?>', 'itenerary')"  data-target="#flight_details_<?php echo  $flight_result[$i]['flight_id'];  ?>" data-parent="#accordion<?php echo  $flight_result[$i]['flight_id'];  ?>" aria-expanded="false" aria-controls="#flight_details_<?php echo  $flight_result[$i]['flight_id'];  ?>"> <span class="sprite"></span> <i class="fal fa-info-circle"></i> More Details <!-- <span class="md_side_txt"><img src="<?php echo ASSETS;?>images/seat.png" alt="" /> sdfsdf</span> --> </a>


               <!--     <a class="detailsflt" data-toggle="collapse" onclick="show_flightpopup(this, '<?php echo  $flight_result[$i]['flight_id']; ?>', 'faredets')" data-target="#flight_fare_<?php echo  $flight_result[$i]['flight_id'];  ?>" data-parent="#accordion<?php echo  $flight_result[$i]['flight_id'];  ?>" aria-expanded="false" aria-controls="#flight_fare_<?php echo  $flight_result[$i]['flight_id'];  ?>"> <span class="sprite"></span><i class="fal fa-usd-circle"></i> Fare Details</a>
                  <a class="detailsflt" data-toggle="collapse" onclick="show_flightpopup(this, '<?php echo  $flight_result[$i]['flight_id']; ?>', 'farerule')" data-target="#flight_farerules_<?php echo  $flight_result[$i]['flight_id'];  ?>" data-parent="#accordion<?php echo  $flight_result[$i]['flight_id'];  ?>" aria-expanded="false" aria-controls="#flight_farerules_<?php echo  $flight_result[$i]['flight_id'];  ?>"> <span class="sprite"></span><i class="fa fa-list-ul" aria-hidden="true"></i>Fare Rules</a> -->

               <?php 

               if($flight_result[$i]['nonRefundable'] == 'R'){
                  $refund_type = 'Refundable';
                  } else{
                  $refund_type = 'Non-Refundable';
                  }
                  ?>
               <div class="refund pull-right" data-type="<?=$pre_attr?>">
                  <a class="detailsflt fare_flight" data-toggle="collapse">
                  <span><?php echo $refund_type ?></span>
                  </a>
               </div>
            </div>
            <div class="collapse flight_res" id="flight_details_<?php echo  $flight_result[$i]['flight_id'];  ?>" data-parent="#accordion<?php echo  $flight_result[$i]['flight_id'];  ?>">
               <div class="load_details"><img src="<?php echo ASSETS;?>images/loader.gif" alt="" /></div>
            </div>
            <div class="collapse" id="flight_fare_<?php echo  $flight_result[$i]['flight_id'];  ?>" data-parent="#accordion<?php echo  $flight_result[$i]['flight_id'];  ?>">
            </div>
            <div class="collapse" id="flight_farerules_<?php echo  $flight_result[$i]['flight_id'];  ?>" data-parent="#accordion<?php echo  $flight_result[$i]['flight_id'];  ?>">
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<?php } ?>
<?php
   }
   
   }else{
   echo "<center> <h3> No Result Found. </h3><center>" ; } ?>
<?php //echo $this->ajax_pagination->create_links(); ?>
<script type="text/javascript">
   $(".booknow").click(function(e){
       e.preventDefault();
       //$(this).closest("form").setAttribute("target", "_blank");;
       $(this).closest("form").submit();
   });
   
   function show_flightpopup(thisoj, id, divclass){
       var thisobj = $(thisoj);
       var idval = id;
       var $objTarget = '';
       //thisobj.closest('.accordion').find('.collapse').removeClass('in');
       $target = thisobj.data('target');
       $targetHref = thisobj.attr('href');
       if(typeof($target)!=="undefind" && ($target!=="")){
           $objTarget = $target;
       }else if(typeof($targetHref)!=="undefind" && ($targetHref!=="")){
           $objTarget = $targetHref;
       }else{
   
       }
   
       if(typeof($objTarget)!=="undefind" && ($objTarget!=="")){
           // alert(divclass);
           // return false;
           $.ajax({
               type:'GET',
               url: '<?php echo WEB_URL;?>flight/call_iternary/'+idval,
               beforeSend: function(XMLHttpRequest){
                   $('.flight_fliter_loader').fadeIn();
               },
               success: function(response) {
                   $('#'+divclass).addClass('active');
                   $('#'+divclass+"_li").addClass('active');
                   $($objTarget).html(response);
                   $('.flight_fliter_loader').fadeOut();
               }
           });
       }
   }
   function show_flightpopup_t(thisoj, id, divclass){
       var thisobj = $(thisoj);
       var idval = id;
       var $objTarget = '';
       //thisobj.closest('.accordion').find('.collapse').removeClass('in');
       $target = thisobj.data('target');
       $targetHref = thisobj.attr('href');
       if(typeof($target)!=="undefind" && ($target!=="")){
           $objTarget = $target;
       }else if(typeof($targetHref)!=="undefind" && ($targetHref!=="")){
           $objTarget = $targetHref;
       }else{
   
       }
   
       if(typeof($objTarget)!=="undefind" && ($objTarget!=="")){
           // alert(divclass);
           // return false;
           $.ajax({
               type:'GET',
               url: '<?php echo WEB_URL;?>flight/call_iternary_t/'+idval,
               beforeSend: function(XMLHttpRequest){
                   $('.flight_fliter_loader').fadeIn();
               },
               success: function(response) {
                   $('#'+divclass).addClass('active');
                   $('#'+divclass+"_li").addClass('active');
                   $($objTarget).html(response);
                   $('.flight_fliter_loader').fadeOut();
               }
           });
       }
   }
   
   
   $("#flight_count").html("<?php echo $flight_count; ?>");
   
   $('#airlines').addClass('in');
   // console.log(<?php //echo $filter_condition;?>);
   $('#AirlineFilter').html('<?php if(isset($airline_data)) { $i=1;foreach($airline_data as $airline){if(in_array($airline->airline,$airline_filter)){$checked='checked';}else{$checked='';}?><li><div class="squaredThree"><input id="squaredThree<?php echo $i;?>" class="filter_airline" type="checkbox" name="airline" <?=$checked?> value="<?php echo $airline->airline;?>" ><label for="squaredThree<?php echo $i;?>"></label></div><label class="lbllbl" for="squaredThree<?php echo $i;?>"><?php echo ucfirst($airline->airline)." (".$airline->airline_code.")";?></label></li><?php $i++; } }?>');
   
   
   $('#con_air_filter').html('<?php if(isset($connecting_airports_filter)) { $i=1;foreach($connecting_airports_filter as $airline){if(in_array($airline->airport_code,$con_air_fil)){$checked='checked';}else{$checked='';}?><li><div class="squaredThree"><input id="squaredFour<?php echo $i;?>" class="filter_con_air" type="checkbox" name="airline" <?=$checked?> value="<?php echo $airline->airport_code;?>" ><label for="squaredFour<?php echo $i;?>"></label></div><label class="lbllbl" for="squaredFour<?php echo $i;?>"><?php echo $this->general_model->get_airport_name($airline->airport_code).' ('.$airline->airport_code.')';?></label></li><?php $i++; } }?>');
   
</script>
<script>
   $("[data-toggle=popover]").popover({
    html: true, 
    content: function() {
          return $('#popover-content').html();
        }
   }); 


   function sendQuotation(flight_id){
    var form = $('#quotation_'+flight_id);
    var url = '<?php echo WEB_URL ?>flight/send_quotation';
    var Qemail = $('#Qemail_'+flight_id);
    var agent_markup = $('#agent_markup_'+flight_id);
    console.log(Qemail+'/'+agent_markup);
    if(Qemail.val()==''){ Qemail.addClass('inputError'); }
    else if(agent_markup.val()=='') { agent_markup.addClass('inputError'); } 
    else {   
        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                   
               }
             });
    }

}

var isVisible = false;
var clickedAway = false;
$('.popoverBTN').mouseover(function(){
    var id = $(this).attr('id');
    $(this).data('placement', 'top');
    $(this).popover({
        html: true, 
        content: function() {
          return $('#popover-content-'+id).html();
        },
    });
        clickedAway = false
        isVisible = true
        //e.preventDefault()
});

function hidePopover() {
    if (isVisible & clickedAway) {
        $('.popoverBTN').popover('hide')
        isVisible = clickedAway = false
    } else {
        clickedAway = true
    }
}
</script>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<script type="text/javascript">
  window.onload = function() {
  let frameElement = document.getElementById("myiFrame");
  let doc = frameElement.contentDocument;
  doc.body.innerHTML = doc.body.innerHTML + '<style>.searchWizardRadioGroup {color:RED;}</style>';
}
</script>