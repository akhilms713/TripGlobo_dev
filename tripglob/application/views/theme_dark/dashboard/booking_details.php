 <?php
if($module == 'FLIGHT'){ ?>
 <div class="propopum flight_datails">
    <div class="popuphed">
        <button type="button" class="close" data-dismiss="modal"><span class="fa fa-close"></span></button>
        <div class="hdngpops">
             <?php echo $booking->origin_airport; ?> (<?php echo $booking->origin; ?>) <span class="fa fa-exchange"></span>  <?php echo $booking->destination_airport; ?>  (<?php echo $booking->destination; ?>)
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="popconyent">
        <div class="contfare">
            
       
                <?php
                   $segment_data= $flight_result=json_decode(($booking->segment_data),true);
                  // echo "<pre>";print_r($segment_data);echo "</pre>pre>";exit();
                  for($s=0;$s<count($segment_data);$s++){ 
           
		for($ss=0;$ss<count($segment_data[$s]['dateOfDeparture']);$ss++){  //echo "j121asckjnpre>";exit();?>
                                 <div class="flitone">
                                    <div class="col-xs-3 nopad5 width_hundred">
                                        <div class="imagesmflt">
                                            <img src="https://www.amadeus.net/static/img/static/airlines/medium/<?php echo $segment_data[$s]['marketingCarrier'][$ss]; ?>.png"; alt="" />
                                        </div>
                                        <div class="flitsmdets">
                                            <?php echo $segment_data[$s]['airlineName'][$ss]; ?> - <?php echo $segment_data[$s]['marketingCarrier'][$ss]; ?> <strong> <?php echo $segment_data[$s]['flightOrtrainNumber'][$ss]; ?><br>
                                              <?php echo $segment_data[$s]['equipmentType'][$ss]; ?></strong>
                                        </div>
                                    </div>
                                    <div class="col-xs-9 nopad width_hundred">
									

											<div class="waymensn">
												<div class="detail_section">
													<div class="detlnavi">
													<div class="col-xs-4 padflt widfty">
														<span class="timlbl right">
                                                        	<span class="sprite reflone"></span>
															<span class="flname"><?php echo $segment_data[$s]['locationIdDeparture'][$ss]; ?> <span class="fltime"><?php echo $segment_data[$s]['DepartureTime'][$ss]; ?></span></span>
														</span>
														<div class="clearfix"></div>
                                                        <div class="clearfix"></div>
														<span class="flitrlbl elipsetool"><?php echo date("M d", strtotime($segment_data[$s]['DepartureDate'][$ss]));  ?> </span>
													</div>
													<div class="col-xs-4 nopad padflt widfty">
														<div class="lyovrtime">	
															<span class="flect"> <span class="sprite retime"></span> <?php echo $segment_data[$s]['duration_time_zone'][$ss]; ?></span>
															<div class="termnl1">Clock Change : <?php echo $segment_data[$s]['Clock_Changes'][$ss]." Hours"; ?></div>
														</div>	
													</div>
												<div class="col-xs-4 padflt widfty">
													<span class="timlbl left">
                                                    	<span class="sprite refltwo"></span>
														<span class="flname"><?php echo $segment_data[$s]['locationIdArival'][$ss]; ?><span class="fltime"><?php echo $segment_data[$s]['ArrivalTime'][$ss]; ?></span> </span>
														
													</span>
													<div class="clearfix"></div>
                                                    <div class="clearfix"></div>
													<span class="flitrlbl elipsetool"><?php echo date("M d", strtotime($segment_data[$s]['ArrivalDate'][$ss]));  ?></span>
												</div>
											</div>
												</div>
											</div>
								
									</div>
                                </div>
                                <div class="clearfix"></div>
                              <?php } }?>









                        </div>
                    </div>
               
                      
                        
                    </div>
                </div>
            </div>


            
           </div>
        
    
         
         
         
        </div>
    </div>
 </div>
 <?php } if($module == 'HOTEL'){   ?>	
 <div class="propopum flight_datails">
	<div class="popuphed">
    	<button type="button" class="close" data-dismiss="modal"><span class="fa fa-close"></span></button>
        <div class="hdngpops">
             <?php echo $cart->hotel_name; ?> (<?php echo $cart->sec_city; ?>) 
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="popconyent">
        <div class="contfare">
		              <div class="tab-content">
            <div id="itenerary" class="tab-pane" data-role="tabpanel">
                <div class="tabmarg">
                    <div class="alltwobnd">
                    
                        <div class="col-xs-12 ways_one nopad">
                            <div class="inboundiv">
                                <div class="hedtowr">
                                     <?php echo 'Check-in: '.$booking->check_in.' Check-out: '. $booking->check_out; ?>
                                </div>
                                <?php $rooms = explode('<br>', $booking->room_code); 
                                 $roomtype = explode( ',', $cart->description) ; 
                                 $inclusion = explode('<br>', $booking->inclusion); 
                                 $roomcnt = explode('<br>', $booking->room_count); 
                                $images = explode(',', $cart->image);
                                for($s=0;$s<count($rooms);$s++){ 
									if($rooms[$s] != ''){
									?>
									
                                <div class="flitone">
                                    <div class="col-xs-3 nopad5 width_hundred">
                                        <div class="imagesmflt">
                                            <img alt="" src="<?php echo $images[$s]; ?>">
                                        </div>
                                        <div class="flitsmdets">
                                            <strong> <br>
                                             </strong>
                                        </div>
                                    </div>
                                    <div class="col-xs-9 nopad width_hundred">
											<div class="waymensn">
												<div class="detail_section">
													<div class="detlnavi">
													<div class="col-xs-6 padflt widfty">
														<span class="timlbl right">
															<span class="flname"><span class=" reflone"></span><?php echo $roomtype[1]; ?></span>
														</span>
														<div class="clearfix"></div>
                                                        <div class="clearfix"></div>
														<div class="rndplace"><?php echo $inclusion[$s]; ?></div>
														<div class="rndplace">No of Rooms: <?php echo $roomcnt[$s]; ?></div>
													</div>
											</div>
												</div>
											</div>

									</div>
                                </div>
                                <div class="clearfix"></div>
                                <?php
								} }
								?>

                            </div>
                        </div>
                
                    </div>
                </div>
            </div>
            
           </div>
        
    
         
         
         
		</div>
    </div>
 </div>
<?php } ?>
