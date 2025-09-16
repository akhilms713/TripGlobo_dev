<style type="text/css">
   .hedtowr{
    /*color:#dd2a1b;  */
   } 
   .flname {
    font-size: 14px;
}
.flitrlbl{
    display:inline;
}
.bdr1{
   border-top:solid 1px #ccc;  
   padding:5px 0px;  
}
.layortie {
    background: #dd2a1b;
    border: 1px solid #dd2a1b;
    border-radius: 5px;
    display: table;
    margin: 0px auto;
    overflow: hidden;
    padding: 2px 10px;
    color: #000;
    text-align: center;
    margin:15px auto;
}
.sclr250{
max-height:480px;
overflow:auto;
}

#farerules {
   max-height: calc(100vh - 212px);
   overflow-y: auto;
}
.ls ul li{
    list-style: none;
    padding: 7px 0px;
}
.hr_line{
    margin-top: 8px;
    margin-bottom: 8px;
    border-top: 1px solid #c5c5c5;
}
</style>
<div class="">
    <div class="popuphed hide">
        <button type="button" class="close" data-dismiss="modal"><span class="fa fa-close"></span></button>
        <div class="hdngpops">
           <?php echo $this->Flight_Model->get_airport_name($result->origin); ?> (<?php echo $result->origin; ?>)<?php if($request_scenario->type == "oneway"){  ?> <span class="fa fa-long-arrow-right"> <?php } else{?><span class="fa fa-exchange"></span>  <?php } ?><?php echo $this->Flight_Model->get_airport_name($result->destination); ?>  (<?php echo $result->destination; ?>)
       </div>
   </div>
   <div class="clearfix"></div>
   <div class="popconyent">
    <div class="contfare">
        <ul role="tablist" class="nav nav-tabs flittwifil">
            <li class="active" id="itenerary_li" data-role="presentation">
                <a data-toggle="tab" data-role="tab" data-aria-controls="home" href="#itenerary<?=$idval?>">Itinerary</a>
            </li>
            <li id="faredets_li" data-role="presentation">
                <a data-toggle="tab" data-role="tab" data-aria-controls="profile" href="#faredets<?=$idval?>">Fare Details</a>
            </li>
            <li id="farerule_li" data-role="presentation">
                <a data-toggle="tab" data-role="tab" data-aria-controls="profile" href="#farerules<?=$idval?>">Fare Rules</a>
            </li>
            <li id="baggage_li" data-role="presentation">
                <a data-toggle="tab" data-role="tab" data-aria-controls="profile" href="#baggage<?=$idval?>">Baggage</a>
            </li>
        </ul>
        <?php 
        	$segment_data  = json_decode($result->segment_data,1); 
            // debug($segment_data);die('ddd'); 
        ?>
        <div class="tab-content">
           <div id="itenerary<?=$idvl?>" class="tab-pane active" role="tabpanel">
                <div class="tabmarg">
                    <div class="alltwobnd">
                    <?php 
                    	$req_typ1=json_decode($result->request_scenario);
                    	$req_typ=$req_typ1->type;

                    	

                    	if($req_typ=="round"){
                    		# echo '<pre/>';print_r($segment_data);exit;
                    for($s=0;$s<(count($segment_data)-1);$s++){
                      //echo $s;
                         //echo '<pre/>';print_r($segment_data[$s]);exit;
                     ?>
                        <div class="col-xs-12 ways_one nopad">
                            <div >
                                
                                 <?php for($ss=0;$ss<count($segment_data[$s]['dateOfDeparture']);$ss++){ ?>
                                 
                                 <div class="flitone">

                                  <div class="hedtowr">
                                <div class="col-md-8">
                                     <?php echo $this->Flight_Model->get_airport_name($segment_data[$s]['locationIdDeparture'][$ss]); ?> <?php if($request_scenario->type == "oneway"){?><span class="fa fa-long-arrow-right"></span> <?php } else {?><span class="fa fa-exchange"></span><?php } ?>  <?php echo $this->Flight_Model->get_airport_name($segment_data[$s]['locationIdArival'][$ss]); ?>
                                     </div>
                                    <div class="col-md-2"> <span><?php echo date("D M d Y", strtotime($segment_data[$s]['DepartureDate'][$ss]));  ?></span></div>
                                     <div class="col-md-2"><span> <i class="fa fa-clock-o"></i> <?php echo $segment_data[0]['DepartureTime'][$ss]; ?>   </span></div>
                                </div>

                                 <div class="col-xs-4 padflt widfty">
                                                        <span class="timlbl right">
                                                            <!-- <span class="sprite reflone"></span> -->
                                                            <span class="flname"><?php echo $this->Flight_Model->get_airport_name($segment_data[$s]['locationIdDeparture'][$ss]); ?> (<?php echo $segment_data[$s]['locationIdDeparture'][$ss]; ?>)<br/><span class="flitrlbl elipsetool"><?php echo date("D M d Y", strtotime($segment_data[$s]['DepartureDate'][$ss]));  ?> </span><span class="fltime"><?php echo $segment_data[$s]['DepartureTime'][$ss]; ?></span></span>
                                                        </span>
                                                        
                                                      
                                 </div>
                                    <div class="col-xs-2 nopad padflt widfty">
                                                        <div class="lyovrtime"> 
                                                            <span class="flect"> <span class="sprite retime"></span> <?php echo $segment_data[$s]['duration_time_zone'][$ss]; ?></span>
                                                            <div class="termnl1">Clock Change : <?php echo $segment_data[$s]['Clock_Changes'][$ss]." Hours"; ?></div>
                                                        </div>  
                                    </div>
                                                        <div class="col-xs-4 padflt widfty">
                                                    <span class="timlbl left">
                                                       
                                                        <span class="flname"><?php echo $this->Flight_Model->get_airport_name($segment_data[$s]['locationIdArival'][$ss] ); ?> (<?php echo $segment_data[$s]['locationIdArival'][$ss]; ?>)<br/>
                                                        <span class="flitrlbl elipsetool"><?php echo date("D M d Y", strtotime($segment_data[$s]['ArrivalDate'][$ss]));  ?></span>
                                                        <span class="fltime"><?php echo $segment_data[$s]['ArrivalTime'][$ss]; ?></span> </span>
                                                        
                                                    </span>
                                                    <div class="clearfix"></div>
                                                    <div class="clearfix"></div>
                                                    
                                                </div>

                                 <div class="col-md-2 nopad">
                                   <div class="flitsmdets">
                                            <div class="col-md-12 nopad">
                                            <?php echo $segment_data[$s]['airlineName'][$ss]; ?> - <?php echo $segment_data[$s]['marketingCarrier'][$ss]; ?> 
                                            </div>

                                            <div class="col-md-12 nopad"><strong>Airline Number: <?php echo $segment_data[$s]['flightOrtrainNumber'][$ss]; ?></strong></div>
                                            <div class="col-md-12 nopad">Segment Type:<?php echo $segment_data[$s]['equipmentType'][$ss]; ?></div>
                                        </div> 
                                 </div>
                                    <div class="col-xs-12 nopad5 width_hundred bdr1 hide">
                                        <!--  <div class="imagesmflt">
                                            <img alt="" src="">
                                        </div> -->

                                    </div>

                                 
                                </div>

                                <div class="col-md-12">
                                    <br>
                                    <h5>AMENITIES</h5><hr class="hr_line">
                                    <div class="col-md-3 nopad ls">
                                        <ul>
                                            <li><img src="<?php echo ASSETS;?>images/seat.png" alt="" /> sdfsdf</li>
                                            <li><i class="fa fa-cutlery" aria-hidden="true"></i> sdfsdf</li>
                                        </ul>
                                    </div>
                                     <div class="col-md-3 nopad ls">
                                        <ul>
                                            <li><i class="fa fa-wifi" aria-hidden="true"></i> sdfsdf</li>
                                            <li><i class="fa fa-plug" aria-hidden="true"></i> sdfsdf</li>
                                        </ul>
                                    </div>
                                     <div class="col-md-3 nopad ls">
                                        <ul>
                                            <li><i class="fa fa-plane" aria-hidden="true"></i> sdfsdf</li>
                                            <li><i class="fa fa-file-video-o" aria-hidden="true"></i> sdfsdf</li>
                                        </ul>
                                    </div>
                                     <div class="col-md-3 nopad ls">
                                        <ul>
                                            <li><i class="fa fa-th"></i> sdfsdf</li>
                                        </ul>
                                    </div>
                                </div>

                                   <?php if($ss<(count($segment_data[$s]['dateOfDeparture'])-1)) {?>
                                    <div class="col-md-12">
                                        <div class="layortie">
                                          <span class="fa fa-clock-o"></span> <strong>Layover Duration</strong>
                               <?php echo $this->Flight_Model->get_airport_name($segment_data[$s]['locationIdArival'][$ss] ); ?> (<?php echo $segment_data[$s]['locationIdArival'][$ss]; ?>),
                                 <strong>Time: </strong>
                                               <?php 
                                               
                                                    $time1 = strtotime("1980-01-01".$segment_data[$s]['ArrivalTime'][$ss]);
                                                    $time2 = strtotime("1980-01-01".$segment_data[$s]['DepartureTime'][$ss+1]);
                                                    
                                                    if ($time2 < $time1)
                                                    {
                                                        $time2 = $time2 + 86400;
                                                    }
                                                    echo date("H:i:s", strtotime("1980-01-01 00:00:00") + ($time2 - $time1)); ?>   
                                                 </div>
                                    </div>
                                    <?php } ?>

                                <div class="clearfix"></div>
                              <?php } ?>
                                <div class="clearfix"></div>
                                
                            </div>
                        </div>
                        <?php if(isset($segment_data[$s+ 1]['locationIdArival'][0])){ ?>
                        <div class="inboundiv"></div>
                        <?php } ?>
                     <?php }
                     }elseif ($req_typ=="oneway") {
                    for($s=0;$s<(count($segment_data)-1);$s++){
                    	//echo $s;
                    		 //echo '<pre/>';print_r($segment_data[$s]);exit;
                     ?>
                        <div class="col-xs-12 ways_one nopad">
                            <div>
                                
                                 <?php for($ss=0;$ss<count($segment_data[$s]['dateOfDeparture']);$ss++){ ?>
                                 <div class="flitone"> 
                                  <div class="hedtowr">
                                     <?php echo $this->Flight_Model->get_airport_name($result->origin); ?> <span class="fa fa-fa fa-long-arrow-right"></span>  <?php echo $this->Flight_Model->get_airport_name($result->destination); ?>
                                   </div>

                                    <div class="col-xs-12  nopad5 width_hundred"> 
                                       <div class="col-xs-2 nopad5">
                                        <div class="fligthsmll">
                                            <img src="https://c.fareportal.com/n/common/air/ai/<?php echo $segment_data[$s]['marketingCarrier'][$ss]; ?>.gif" ;="" alt="">
                                            <div class="flitsmdets">
                                                <?php echo $segment_data[$s]['marketingCarrier'][$ss]; ?> <strong> <?php echo $segment_data[$s]['flightOrtrainNumber'][$ss]; ?><br>
                                                    <?php echo $segment_data[$s]['equipmentType'][$ss]; ?></strong>
                                                    
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-xs-2 nopad5">
                                        <div class="flitsmdets">
                                            <?php echo $segment_data[$s]['airlineName'][$ss]; ?>
                                        </div>

                                        </div>
                                    
                                    <div class="col-xs-8 nopad width_hundred ">
										

											<div class="waymensn">
												<div class="detail_section">
													<div class="detlnavi flight_itrn_section">
													<div class="col-xs-4 padflt widfty">
														<span class="timlbl right">
                                                        	
															<span class="flname"><?php echo $segment_data[$s]['locationIdDeparture'][$ss]; ?> <span class="fltime"><?php echo $segment_data[$s]['DepartureTime'][$ss]; ?></span></span>
														</span>
														<div class="clearfix"></div>
                                                        <div class="clearfix"></div>
														<span class="flitrlbl elipsetool"><?php echo date("D M d Y", strtotime($segment_data[$s]['DepartureDate'][$ss]));  ?> </span>
													</div>
													<div class="col-xs-4 nopad padflt widfty">
														<div class="lyovrtime">	
															<span class="flect"> <span class="sprite retime"></span> <?php echo $segment_data[$s]['duration_time_zone'][$ss]; ?></span>
															<div class="termnl1">Clock Change : <?php echo $segment_data[$s]['Clock_Changes'][$ss]." Hours"; ?></div>
                                                            <div class="termnl1">
                                                                <?php  echo ltrim($segment_data[$s]['locationIdDeparture'][$ss]);

                                echo '-';
                                echo ltrim($segment_data[$s]['locationIdArival'][$ss]);

                                                                ?>
                                                            </div>

														</div>	
													</div>
												<div class="col-xs-4 padflt widfty">
													<span class="timlbl left">
                                                    	
														<span class="flname"><?php echo $segment_data[$s]['locationIdArival'][$ss]; ?><span class="fltime"><?php echo $segment_data[$s]['ArrivalTime'][$ss]; ?></span> </span>
														
													</span>
													<div class="clearfix"></div>
                                                    <div class="clearfix"></div>
													<span class="flitrlbl elipsetool"><?php echo date("D M d Y", strtotime($segment_data[$s]['ArrivalDate'][$ss]));  ?></span>
												</div>
											</div>
												</div>
											</div>

									</div>
                                    </div>
                                </div>
                                     <?php if($ss<(count($segment_data[$s]['dateOfDeparture'])-1)) {?>
                                         <div class="col-md-12">
                                             <div class="layortie">
                                                 <span class="fa fa-clock-o"></span> <strong>Layover Duration</strong>
                                                 <?php echo $this->Flight_Model->get_airport_name($segment_data[$s]['locationIdArival'][$ss] ); ?> (<?php echo $segment_data[$s]['locationIdArival'][$ss]; ?>),
                                                 <strong>Time: </strong>
                                                 <?php

                                                 $time1 = strtotime("1980-01-01".$segment_data[$s]['ArrivalTime'][$ss]);
                                                 $time2 = strtotime("1980-01-01".$segment_data[$s]['DepartureTime'][$ss+1]);

                                                 if ($time2 < $time1)
                                                 {
                                                     $time2 = $time2 + 86400;
                                                 }
                                                 echo date("H:i:s", strtotime("1980-01-01 00:00:00") + ($time2 - $time1)); ?>
                                             </div>
                                         </div>
                                     <?php } ?>
                                <div class="clearfix"></div>
                              <?php } ?>
                                <div class="clearfix"></div>
                                
                            </div>
                        </div> 
                        <?php if(isset($segment_data[$s+ 1]['locationIdArival'][0])){ ?>
                        <div class="inboundiv"></div>
                        <?php } ?>
                     <?php }
                     }elseif ($req_typ=="M") {?>
                      <div class="col-xs-12 ways_one nopad">
                            <div class="inboundiv">
                     <?php
                    for($s=0;$s<(count($segment_data)-1);$s++){
                        //echo $s;
                             // echo '<pre/>';print_r($segment_data[$s]);
                     ?>
                                 <div class="flitone">
                                 <?php for($ss=0;$ss<count($segment_data[$s]['dateOfDeparture']);$ss++){ ?>
                                
                                  <div class="hedtowr">
                                     <?php echo $this->Flight_Model->get_airport_name($segment_data[$s]['locationIdDeparture'][$ss]); ?> <span class="fa fa-exchange"></span>  <?php echo $this->Flight_Model->get_airport_name($segment_data[$s]['locationIdArival'][$ss]); ?>
                                   </div>

                                    <div class="col-xs-12 col-sm-offset-1 nopad5 width_hundred">
                                       <div class="col-xs-2 nopad5">
                                        <div class="fligthsmll">
                                            <img src="https://c.fareportal.com/n/common/air/ai/<?php echo $segment_data[$s]['marketingCarrier'][$ss]; ?>.gif" ;="" alt="">
                                            <div class="flitsmdets">
                                                <?php echo $segment_data[$s]['marketingCarrier'][$ss]; ?> <strong> <?php echo $segment_data[$s]['flightOrtrainNumber'][$ss]; ?><br>
                                                    <?php echo $segment_data[$s]['equipmentType'][$ss]; ?></strong>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-xs-2 nopad5">
                                        <div class="flitsmdets">
                                            <?php echo $segment_data[$s]['airlineName'][$ss]; ?>
                                        </div>

                                        </div>
                                    
                                    <div class="col-xs-8 nopad width_hundred ">
                                        

                                            <div class="waymensn">
                                                <div class="detail_section">
                                                    <div class="detlnavi">
                                                    <div class="col-xs-4 padflt widfty">
                                                        <span class="timlbl right">
                                                            
                                                            <span class="flname"><?php echo $segment_data[$s]['locationIdDeparture'][$ss]; ?> <span class="fltime"><?php echo $segment_data[$s]['DepartureTime'][$ss]; ?></span></span>
                                                        </span>
                                                        <div class="clearfix"></div>
                                                        <div class="clearfix"></div>
                                                        <span class="flitrlbl elipsetool"><?php echo date("D M d Y", strtotime($segment_data[$s]['DepartureDate'][$ss]));  ?> </span>
                                                    </div>
                                                    <div class="col-xs-4 nopad padflt widfty">
                                                        <div class="lyovrtime"> 
                                                            <span class="flect"> <span class="sprite retime"></span> <?php echo $segment_data[$s]['duration_time_zone'][$ss]; ?></span>
                                                            <div class="termnl1">Clock Change : <?php echo $segment_data[$s]['Clock_Changes'][$ss]." Hours"; ?></div>
                                                            <div class="termnl1">
                                                                <?php  echo ltrim($segment_data[$s]['locationIdDeparture'][$ss]);

                                echo '-';
                                echo ltrim($segment_data[$s]['locationIdArival'][$ss]);

                                                                ?>
                                                            </div>

                                                        </div>  
                                                    </div>
                                                <div class="col-xs-4 padflt widfty">
                                                    <span class="timlbl left">
                                                        
                                                        <span class="flname"><?php echo $segment_data[$s]['locationIdArival'][$ss]; ?><span class="fltime"><?php echo $segment_data[$s]['ArrivalTime'][$ss]; ?></span> </span>
                                                        
                                                    </span>
                                                    <div class="clearfix"></div>
                                                    <div class="clearfix"></div>
                                                    <span class="flitrlbl elipsetool"><?php echo date("D M d Y", strtotime($segment_data[$s]['ArrivalDate'][$ss]));  ?></span>
                                                </div>
                                            </div>
                                                </div>
                                            </div>

                                    </div>
                                    </div>
                               
                                     <?php if($ss<(count($segment_data[$s]['dateOfDeparture'])-1)) {?>
                                         <div class="col-md-12">
                                             <div class="layortie">
                                                 <span class="fa fa-clock-o"></span> <strong>Layover Duration</strong>
                                                 <?php echo $this->Flight_Model->get_airport_name($segment_data[$s]['locationIdArival'][$ss] ); ?> (<?php echo $segment_data[$s]['locationIdArival'][$ss]; ?>),
                                                 <strong>Time: </strong>
                                                 <?php

                                                 $time1 = strtotime("1980-01-01".$segment_data[$s]['ArrivalTime'][$ss]);
                                                 $time2 = strtotime("1980-01-01".$segment_data[$s]['DepartureTime'][$ss+1]);

                                                 if ($time2 < $time1)
                                                 {
                                                     $time2 = $time2 + 86400;
                                                 }
                                                 echo date("H:i:s", strtotime("1980-01-01 00:00:00") + ($time2 - $time1)); ?>
                                             </div>
                                         </div>
                                     <?php } ?>
                                <div class="clearfix"></div>
                              <?php } ?>
                               </div>
                                <div class="clearfix"></div>
                                
                         
                     <?php }
                     ?>
                        </div>
                        </div>
                     <?php
                     } ?>

                    </div>
                </div>
            </div>

<div id="faredets<?=$idvl?>" class="tab-pane" role="tabpanel">
    <div class="tabmarg">
        <div class="col-xs-12 nopad fare_full">
            <div class="inboundiv">
                <h4 class="farehdng">Fare Breakup (<?php echo $result->origin; ?> To <?php echo $result->destination; ?>)</h4>
                <?php
					$Total = $amount_db  = str_replace('"','', $result->amount);
					$amount_tax = 0; // str_replace('"','', $result->tax_amount);
					$air_fare= $amount_db - $amount_tax;  
                        $sed_pricing_data = json_decode($result->PricingDetails, true)[0]['PriceInfo'];
                        // debug($sed_pricing_data);die;
                    ?>

              
                    <div class="rowfare">

                        <div class="col-xs-4 nopad">
                            <span class="infolbl"> Fare Summary
                              
                        </span>
                    </div>
                    <div class="col-xs-4 nopad">
                            <span class="infolbl"> Base Fare
                              
                        </span>
                    </div>
                    <div class="col-xs-4 nopad">
                            <span class="infolbl"> Fees and Taxes
                              
                        </span>
                    </div>
                    
                </div>
                
                <?php $request_scenario = (json_decode($result->request_scenario,1));?>
                <?php $tot_pax = $sed_pricing_data['PassengerFare']['ADT']['count']; ?>
			   <div class="rowfare">
					<div class="col-xs-4 nopad"><span class="infolbl"> <?php  echo 'Adult'; ?> X <?php echo $sed_pricing_data['PassengerFare']['ADT']['count']; ?></span></div>
                    <div class="col-xs-4 nopad"><span class="pricelbl"><?=$this->display_icon;?> <?php echo number_format(($sed_pricing_data['PassengerFare']['ADT']['totalFareAmount'] * $this->curr_val * $sed_pricing_data['PassengerFare']['ADT']['count']),2); ?> </span></div>
					<div class="col-xs-4 nopad"><span class="pricelbl"><?=$this->display_icon;?> <?php echo number_format(($sed_pricing_data['PassengerFare']['ADT']['totalTaxAmount'] * $this->curr_val * $sed_pricing_data['PassengerFare']['ADT']['count']),2); ?> </span></div>
				</div>
				<?php if(isset($sed_pricing_data['PassengerFare']['CH'])){ ?>
                <?php $tot_pax += $sed_pricing_data['PassengerFare']['CH']['count']; ?>
					<div class="rowfare">
					<div class="col-xs-4 nopad"><span class="infolbl"> <?php  echo 'Child'; ?> X <?php echo $sed_pricing_data['PassengerFare']['CH']['count']; ?></span></div>
                    <div class="col-xs-4 nopad"><span class="pricelbl"><?=$this->display_icon;?> <?php echo number_format(($sed_pricing_data['PassengerFare']['CH']['totalFareAmount'] * $this->curr_val * $sed_pricing_data['PassengerFare']['CH']['count']),2); ?> </span></div>
					<div class="col-xs-4 nopad"><span class="pricelbl"><?=$this->display_icon;?> <?php echo number_format(($sed_pricing_data['PassengerFare']['CH']['totalTaxAmount'] * $this->curr_val * $sed_pricing_data['PassengerFare']['CH']['count']),2); ?> </span></div>
				</div>
				<?php } ?>	
           
				<?php if(isset($sed_pricing_data['PassengerFare']['INF'])){ ?>
                <?php $tot_pax += $sed_pricing_data['PassengerFare']['INF']['count']; ?>
					<div class="rowfare">
					<div class="col-xs-4 nopad"><span class="infolbl"> <?php  echo 'Infant'; ?> X <?php echo $sed_pricing_data['PassengerFare']['INF']['count']; ?></span></div>
                    <div class="col-xs-4 nopad"><span class="pricelbl"><?=$this->display_icon;?> <?php echo number_format(($sed_pricing_data['PassengerFare']['INF']['totalFareAmount'] * $this->curr_val * $sed_pricing_data['PassengerFare']['INF']['count']),2); ?> </span></div>
					<div class="col-xs-4 nopad"><span class="pricelbl"><?=$this->display_icon;?> <?php echo number_format(($sed_pricing_data['PassengerFare']['INF']['totalTaxAmount'] * $this->curr_val * $sed_pricing_data['PassengerFare']['INF']['count']),2); ?> </span></div>
				</div>
				<?php } ?>	
				<div class="rowfare hide">

                        <div class="col-xs-8 nopad">
                            <span class="infolbl"> <?php  echo 'Total  Fare'; ?>
                              
                        </span>
                    </div>
                    <div class="col-xs-4 nopad">
                        <span class="pricelbl"><?php echo $this->display_icon;echo number_format(($amount_db * $this->curr_val), 2); ?> </span>
                    </div>
                </div>
        
<div class="inboundiv grand_totall">

    <div class="rowfare grandtl">
        <div class="col-xs-8 nopad">
            <span class="infolbl">Grand Total (<?=$tot_pax?> Travellers)</span>
        </div>
        <div class="col-xs-4 nopad">
            <span class="pricelbl"><?php echo BASE_CURRENCY_ICON;echo $result->amount; ?> </span>
        </div>
    </div>
</div>
</div>
 </div>

<?php if(false){ ?>
<div class="col-xs-7 nopad fare_full">
    <div class="inboundiv splfares">
        <h4 class="farehdng">Fare Rules</h4>
        <div class="rowfare">
            <div class="lablfare">Cancellation fee <strong>(per passenger)</strong> : </div>
            <div class="feenotes">
                All charges are prior to scheduled departure of the first flight. Does not include additional no-show charges.
            </div>
        </div>


    </div>
</div>
<?php } ?>
</div>
</div>
<div id="farerules<?=$idvl?>" class="tab-pane" role="tabpanel">
    <div class="tabmarg">
        <div class="col-xs-12 nopad fare_full">
            <div class="inboundiv">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
            foreach($fare_rule_details as $fare_key=>$fare_val){
                echo '
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.str_ireplace("/", "_", str_ireplace(" ", "_", $fare_key)).'" aria-expanded="true" aria-controls="collapseOne">
                          '.$fare_key.'
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne'.str_ireplace("/", "_", str_ireplace(" ", "_", $fare_key)).'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        '.ucfirst(strtolower(str_replace('  ', '', trim($fare_val)))).'
                      </div>
                    </div>
                  </div>
                ';
            }
        ?>
        </div>
            </div>
        </div>
    </div>
</div>
<div id="baggage<?=$idvl?>" class="tab-pane" role="tabpanel">
    <div class="tabmarg">
        <div class="col-xs-12 nopad fare_full">
            <div class="inboundiv">
                <h4>Baggage Info</h4>
                 <table class="table bag-tab  ">
                    <thead class="thead-light">
                    <tbody>
                    <tr>
                        <td style="width:33.3%"><h5>Origin</h5></td> 
                       <td style="width:33.3%"><h5>Destination</h5></td> 
                       <td style="width:33.3%"><h5>Baggage</h5></td> 
                       <td style="width:33.3%"><h5>Baggage2</h5></td> 
                    </tr>
                  <?php for($s=0;$s<(count($segment_data)-1);$s++){ ?>
                  <?php for($ss=0;$ss<count($segment_data[$s]['dateOfDeparture']);$ss++){ ?>
                    <tr>
                       <td style="width:33.3%"><h5><?php echo $this->Flight_Model->get_airport_name($segment_data[$s]['locationIdDeparture'][$ss]); ?></h5></td> 
                       <td style="width:33.3%"><h5><?php echo $this->Flight_Model->get_airport_name($segment_data[$s]['locationIdArival'][$ss]); ?></h5></td> 
                       <td style="width:33.3%"><h5><?=$segment_data[0]['baggage'][0]?></h5></td> 
                       <td style="width:33.3%"><h5>7 kg</h5></td> 
                    </tr>
                    <?php } ?>
                    <?php } ?>
                    </tbody>

                 </table>
            </div>
        </div>
    </div>
</div>
</div>

</div>
</div>

</div>
