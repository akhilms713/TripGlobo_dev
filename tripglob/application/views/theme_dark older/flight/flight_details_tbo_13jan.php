

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



        	$segment_data1  = json_decode($result->segment_data,1); 
            $segment_data  = $segment_data1['Segments'];
        ?>
        <div class="tab-content">
           <div id="itenerary<?=$idval?>" class="tab-pane active" role="tabpanel">
                <div class="tabmarg">
                    <div class="alltwobnd">
                    <?php 
                    	$req_typ1=json_decode($result->request_scenario);
                    	$req_typ=$req_typ1->type;
                    
                    for($s=0;$s<=(count($segment_data)-1);$s++){

                     ?>
                        <div class="col-xs-12 ways_one nopad">
                            <div>
                                
                                 <?php

                               // echo "<pre/>";print_r($segment_data[$s]);exit("ytyyu");
                                  for($ss=0;$ss<count($segment_data[$s]);$ss++){ ?>
                                 <div class="flitone"> 
                                  <div class="hedtowr">
                                     <?php echo  $segment_data[$s][$ss]['Origin']['Airport']['AirportName']; ?> <span class="fa fa-fa fa-long-arrow-right"></span>  <?php echo $segment_data[$s][$ss]['Destination']['Airport']['AirportName']; ?>
                                   </div>

                                    <div class="col-xs-12  nopad5 width_hundred"> 
                                       <div class="col-xs-2 nopad5">
                                        <div class="fligthsmll">
                                            <img src="https://c.fareportal.com/n/common/air/ai/<?php echo $segment_data[$s][$ss]['Airline']['AirlineCode']; ?>.gif" ;="" alt="">
                                            <div class="flitsmdets">
                                                <?php echo  $segment_data[$s][$ss]['Airline']['AirlineCode']; ?> <strong> <?php echo  $segment_data[$s][$ss]['Airline']['FlightNumber']; ?><br>
                                                   </strong>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-xs-2 nopad5">
                                        <div class="flitsmdets">
                                            <?php echo $segment_data[$s][$ss]['Airline']['AirlineName']; ?>
                                        </div>

                                        </div>
                                    
                                    <div class="col-xs-8 nopad width_hundred ">
										

											<div class="waymensn">
												<div class="detail_section">
													<div class="detlnavi">
													<div class="col-xs-4 padflt widfty">
														<span class="timlbl right">
                                                            <?php 
                                                            $ddd=explode('T',$segment_data[$s][$ss]['Origin']['DepTime']);

                                                             ?>

                                                        	
															<span class="flname"><?php echo $segment_data[$s][$ss]['Origin']['Airport']['CityName']; ?> <span class="fltime"><?php echo $ddd[1]; ?></span></span>
														</span>
														<div class="clearfix"></div>
                                                        <div class="clearfix"></div>
														<span class="flitrlbl elipsetool"><?php echo date("D M d Y", strtotime($ddd[0]));  ?> </span>
													</div>
													<div class="col-xs-4 nopad padflt widfty">
														<div class="lyovrtime">	
														<!-- 	<span class="flect"> <span class="sprite retime"></span> <?php echo $ddd[1]; ?></span> -->
															<div class="termnl1">Clock Change : <?php //echo $segment_data[$s]['Clock_Changes'][$ss]." Hours"; ?></div>
                                                            <div class="termnl1">
                                                                <?php  echo $segment_data[$s][$ss]['Origin']['Airport']['CityCode'];

                                                                        echo '-';
                                                                        echo $segment_data[$s][$ss]['Destination']['Airport']['CityCode'];

                                                                ?>
                                                            </div>

														</div>	
													</div>
												<div class="col-xs-4 padflt widfty">
													<span class="timlbl left">
                                                        <?php 

                                                        $aaa=explode('T', $segment_data[$s][$ss]['Destination']['ArrTime']);

                                                         ?>
                                                    	
														<span class="flname"><?php echo $segment_data[$s][$ss]['Destination']['Airport']['CityName']; ?><span class="fltime"><?php echo $aaa[1]; ?></span> </span>
														
													</span>
													<div class="clearfix"></div>
                                                    <div class="clearfix"></div>
													<span class="flitrlbl elipsetool"><?php echo date("D M d Y", strtotime($aaa[0]));  ?></span>
												</div>
											</div>
												</div>
											</div>

									</div>
                                    </div>
                                </div>
                                     <!-- <?php if($ss<(count($segment_data[$s]['dateOfDeparture'])-1)) {?>
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
                                     <?php } ?> -->
                                <div class="clearfix"></div>
                              <?php } ?>
                                <div class="clearfix"></div>
                                
                            </div>
                        </div> 
                       <!--  <?php if(isset($segment_data[$s + 1]['locationIdArival'][0])){ ?>
                        <div class="inboundiv"></div>
                        <?php } ?> -->
                     <?php }
                     ?>

                    </div>
                </div>
            </div>

<div id="faredets<?=$idval?>" class="tab-pane" role="tabpanel">
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
        <div class="col-xs-4 nopad text-right">
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
<div id="farerules<?=$idval?>" class="tab-pane" role="tabpanel">
    <div class="tabmarg">
        <div class="col-xs-12 nopad fare_full">
            <div class="inboundiv">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
            $farerules=json_decode($fare_rule_details,1);
         //   echo "<pre/>";print_r($farerules);exit("");
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
<div id="baggage<?=$idval?>" class="tab-pane" role="tabpanel">
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
                  <?php for($ss=0;$ss<=count(($segment_data[$s])-1);$ss++){ ?>
                    <tr>
                       <td style="width:33.3%"><h5><?php echo $segment_data[$s][$ss]['Origin']['Airport']['AirportName']; ?></h5></td> 
                       <td style="width:33.3%"><h5><?php echo $segment_data[$s][$ss]['Origin']['Airport']['AirportName']; ?></h5></td> 
                       <td style="width:33.3%"><h5><?php echo $segment_data[$s][$ss]['Baggage'];?></h5></td> 
                       <td style="width:33.3%"><h5>
                           <?php if($segment_data[$s][$ss]['CabinBaggage']==""){echo "7KG";}else{
                                echo $segment_data[$s][$ss]['CabinBaggage'];
                           } ?>

                       </h5></td> 
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
