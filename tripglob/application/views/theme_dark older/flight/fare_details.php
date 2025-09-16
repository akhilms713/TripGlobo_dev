<style type="text/css">
   .hedtowr{
    /*color:#dd2a1b;  */
   } 
   .flname {
    font-size: 16px;
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
    padding: 5px 10px;
    color: #fff;
    text-align: center;
}
.sclr250{
max-height: :480px;
overflow:auto;
}

#farerules {
   max-height: calc(100vh - 212px);
   overflow-y: auto;
}

</style>

<div class="propopum flight_datails sclr250">
    <div class="popuphed">
        <button type="button" class="close" data-dismiss="modal"><span class="fa fa-close"></span></button>
        <div class="hdngpops">
           <?php echo $this->Flight_Model->get_airport_name($result->origin); ?> (<?php echo $result->origin; ?>)<?php if($request_scenario->type == "oneway"){  ?> <span class="fa fa-long-arrow-right"> <?php } else{?><span class="fa fa-exchange"></span>  <?php } ?><?php echo $this->Flight_Model->get_airport_name($result->destination); ?>  (<?php echo $result->destination; ?>)
       </div>
   </div>
   <div class="clearfix"></div>
   <div class="popconyent">
    <div class="contfare">
        <ul role="tablist" class="nav nav-tabs flittwifil">
            <li id="itenerary_li" data-role="presentation">
                <a data-toggle="tab" data-role="tab" data-aria-controls="home" href="#itenerary">Itinerary</a>
            </li>
            <li id="faredets_li" data-role="presentation">
                <a data-toggle="tab" data-role="tab" data-aria-controls="profile" href="#faredets">Fare Details</a>
            </li>
            <li id="farerule_li" data-role="presentation">
                <a data-toggle="tab" data-role="tab" data-aria-controls="profile" href="#farerules">Fare Rules</a>
            </li>
        </ul>
        <?php 
        	$segment_data  = json_decode($result->segment_data,1);  
        ?>
        <div class="tab-content">
           <div id="itenerary" class="tab-pane" data-role="tabpanel">
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
                            <div class="inboundiv">
                                
                                 <?php for($ss=0;$ss<count($segment_data[$s]['dateOfDeparture']);$ss++){ ?>
                                 
                                 <div class="flitone">

                                  <div class="hedtowr">
                                <div class="col-md-8">
                                     <?php echo $this->Flight_Model->get_airport_name($segment_data[$s]['locationIdDeparture'][$ss]); ?> <?php if($request_scenario->type == "oneway"){?><span class="fa fa-long-arrow-right"></span> <?php } else {?><span class="fa fa-exchange"></span><?php } ?>  <?php echo $this->Flight_Model->get_airport_name($segment_data[$s]['locationIdArival'][$ss]); ?>
                                     </div>
                                    <div class="col-md-2"> <span><?php echo date("M d", strtotime($segment_data[$s]['DepartureDate'][$ss]));  ?></span></div>
                                     <div class="col-md-2"><span> <i class="fa fa-clock-o"></i> <?php echo $segment_data[0]['DepartureTime'][$ss]; ?>   </span></div>
                                </div>

                                 <div class="col-xs-4 padflt widfty">
                                                        <span class="timlbl right">
                                                            <!-- <span class="sprite reflone"></span> -->
                                                            <span class="flname"><?php echo $this->Flight_Model->get_airport_name($segment_data[$s]['locationIdDeparture'][$ss]); ?> (<?php echo $segment_data[$s]['locationIdDeparture'][$ss]; ?>)<br/><span class="flitrlbl elipsetool"><?php echo date("M d", strtotime($segment_data[$s]['DepartureDate'][$ss]));  ?> </span><span class="fltime"><?php echo $segment_data[$s]['DepartureTime'][$ss]; ?></span></span>
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
                                                        <span class="flitrlbl elipsetool"><?php echo date("M d", strtotime($segment_data[$s]['ArrivalDate'][$ss]));  ?></span>
                                                        <span class="fltime"><?php echo $segment_data[$s]['ArrivalTime'][$ss]; ?></span> </span>
                                                        
                                                    </span>
                                                    <div class="clearfix"></div>
                                                    <div class="clearfix"></div>
                                                    
                                                </div>

                                 <div class="col-md-2 nopad">
                                   <div class="flitsmdets">
                                            <div class="col-md-12">
                                            <?php echo $segment_data[$s]['airlineName'][$ss]; ?> - <?php echo $segment_data[$s]['marketingCarrier'][$ss]; ?> 
                                            </div>

                                            <div class="col-md-12"><strong>Airline Number: <?php echo $segment_data[$s]['flightOrtrainNumber'][$ss]; ?></strong></div>
                                            <div class="col-md-12">Segment Type:<?php echo $segment_data[$s]['equipmentType'][$ss]; ?></div>
                                        </div> 
                                 </div>
                                    <div class="col-xs-12 nopad5 width_hundred bdr1 hide">
                                        <!--  <div class="imagesmflt">
                                            <img alt="" src="">
                                        </div> -->

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
                     <?php }
                     }elseif ($req_typ=="oneway") {
                    for($s=0;$s<(count($segment_data)-1);$s++){
                    	//echo $s;
                    		 //echo '<pre/>';print_r($segment_data[$s]);exit;
                     ?>
                        <div class="col-xs-12 ways_one nopad">
                            <div class="inboundiv">
                                
                                 <?php for($ss=0;$ss<count($segment_data[$s]['dateOfDeparture']);$ss++){ ?>
                                 <div class="flitone">
                                  <div class="hedtowr">
                                     <?php echo $this->Flight_Model->get_airport_name($result->origin); ?> <span class="fa fa-fa fa-long-arrow-right"></span>  <?php echo $this->Flight_Model->get_airport_name($result->destination); ?>
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
														<span class="flitrlbl elipsetool"><?php echo date("M d", strtotime($segment_data[$s]['DepartureDate'][$ss]));  ?> </span>
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
													<span class="flitrlbl elipsetool"><?php echo date("M d", strtotime($segment_data[$s]['ArrivalDate'][$ss]));  ?></span>
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
                     <?php }
                     }elseif ($req_typ=="M") {?>
                      <div class="col-xs-12 ways_one nopad">
                            <div class="inboundiv">
                     <?php
                    for($s=0;$s<(count($segment_data)-1);$s++){
                        //echo $s;
                             echo '<pre/>';print_r($segment_data[$s]);exit;
                     ?>
                       
                                 <div class="flitone">
                                 <?php for($ss=0;$ss<count($segment_data[$s]['dateOfDeparture']);$ss++){ ?>
                                
                                  <div class="hedtowr">
                                     <?php echo $this->Flight_Model->get_airport_name($result->origin); ?> <span class="fa fa-exchange"></span>  <?php echo $this->Flight_Model->get_airport_name($result->destination); ?>
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
                                                        <span class="flitrlbl elipsetool"><?php echo date("M d", strtotime($segment_data[$s]['DepartureDate'][$ss]));  ?> </span>
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
                                                    <span class="flitrlbl elipsetool"><?php echo date("M d", strtotime($segment_data[$s]['ArrivalDate'][$ss]));  ?></span>
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

<div id="faredets" class="tab-pane" role="tabpanel">
    <div class="tabmarg">
        <div class="col-xs-12 nopad fare_full">
            <div class="inboundiv">
                <h4 class="farehdng">Fare Breakup (<?php echo $result->origin; ?> To <?php echo $result->destination; ?>)</h4>
                <?php
					$Total = $amount_db  = str_replace('"','', $result->amount);
					$amount_tax = 0; // str_replace('"','', $result->tax_amount);
					$air_fare= $amount_db - $amount_tax;  ?>

              
                     <div class="rowfare">

                        <div class="col-xs-8 nopad">
                            <span class="infolbl"> <?php  echo 'Air Fare'; ?>
                              
                        </span>
                    </div>
                    <div class="col-xs-4 nopad">
                        <span class="pricelbl"><?php echo BASE_CURRENCY_ICON;echo $air_fare; ?> </span>
                    </div>
                </div>
                
                <?php $request_scenario = (json_decode($result->request_scenario,1));?>
			   <div class="rowfare">
					<div class="col-xs-8 nopad"><span class="infolbl"> <?php  echo 'Adult'; ?></span></div>
					<div class="col-xs-4 nopad"><span class="pricelbl"><?php echo $request_scenario['ADT']; ?> </span></div>
				</div>
				<?php if(isset($request_scenario['CHD']) && $request_scenario['CHD'] !=''){ ?>
					<div class="rowfare">
					<div class="col-xs-8 nopad"><span class="infolbl"> <?php  echo 'Child'; ?></span></div>
					<div class="col-xs-4 nopad"><span class="pricelbl"><?php echo $request_scenario['CHD']; ?> </span></div>
				</div>
				<?php } ?>	
           
				<?php if(isset($request_scenario['INF']) && $request_scenario['INF'] !=''){ ?>
					<div class="rowfare">
					<div class="col-xs-8 nopad"><span class="infolbl"> <?php  echo 'Infant'; ?></span></div>
					<div class="col-xs-4 nopad"><span class="pricelbl"><?php echo $request_scenario['INF']; ?> </span></div>
				</div>
				<?php } ?>	
				<div class="rowfare">

                        <div class="col-xs-8 nopad">
                            <span class="infolbl"> <?php  echo 'Total  Fare'; ?>
                              
                        </span>
                    </div>
                    <div class="col-xs-4 nopad">
                        <span class="pricelbl"><?php echo BASE_CURRENCY_ICON;echo $amount_db; ?> </span>
                    </div>
                </div>
        
<div class="inboundiv grand_totall">

    <div class="rowfare grandtl">
        <div class="col-xs-8 nopad">
            <span class="infolbl">Grand Total</span>
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
<div id="farerules" class="tab-pane" role="tabpanel">
    <div class="tabmarg">
        <div class="col-xs-12 nopad fare_full">
            <div class="inboundiv">
        <?php
            foreach($fare_rule_details as $fare_key=>$fare_val){
                echo '
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          '.$fare_key.'
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        '.ucfirst(strtolower(str_replace('  ', '', trim($fare_val)))).'
      </div>
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

</div>
</div>

</div>
