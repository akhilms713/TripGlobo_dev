<?php
                     
                        if(count($getoverallBookings) >0)
                        {
                            for($k=0;$k<count($getoverallBookings);$k++)
                            {
                            
                                if($getoverallBookings[$k]->product_name == 'FLIGHT')
                                {
                                    $result = $this->account_model->getBookingbyPnr($getoverallBookings[$k]->pnr_no,$getoverallBookings[$k]->product_name)->row();  //echo '<pre/>';
                            //  print_r($result);exit;
							$outward_segments = json_decode($result->outward_segments);
                            ?>
                            <div class="fulltable bkingg">  
                                <div class="bookrow">
                                    <div class="topbokro">
                                        <h4 class="bokrname">
                                            <span class="fa fa-plane"></span>
                                             PNR No:  <?php echo $getoverallBookings[$k]->pnr_no; ?>
                                        </h4>
                                        <div class="pnrnum">
                                           <?php echo $result->origin; ?> TO <?php echo $result->destination; ?> | <?php echo $result->mode; ?>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="remful">
                                         
                                        <div class="xlbook col-xs-9 bookdetails">
                                             
                                             <div class="col-md-7 concell"> 
                        <div class="onwyrow">
                            <div class="fblueline22 linegreen">
                                <b><?php echo $result->origin_airport;?></b> (<?php echo $result->origin;?>) 
                                <span class="farrow"></span> 
                                <b><?php echo $result->destination_airport;?></b> (<?php echo $result->destination;?>)
                            </div>
                            <?php
							 
							for($i=0;$i<count($outward_segments);$i++)
							{
							 ?>
                            <div class="rowfux">
                            <div class="col-md-2">
                                <div class="flitsecimg">
                                    <img alt="" id="FF219160" src="<?php echo 'http://www.travelfusion.com/images/logos/'.strtolower(str_replace(" ","",$outward_segments[$i]->Operator)).'.gif'; ?>">
                                    <span class="nortosimle textcentr"><?php echo $outward_segments[$i]->Operator;?></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                               
                                <div class="radiobtn rittextalign"><?php echo $outward_segments[$i]->Origin;?></div>
                                <span class="norto rittextalign"><?php echo date('d M, D Y', strtotime($outward_segments[$i]->DepartDate));?></span>
                                <span class="norto lbold rittextalign"><?php echo date('H:i', strtotime($outward_segments[$i]->DepartDate));?></span>
                            </div>
                            <div class="col-md-1 nopad">
                                <div class="flightimgs">
                                    <img alt="" src="<?php echo ASSETS;?>images/departure.png">
                                </div>
                            </div>
                            <div class="col-md-3">
                               
                                 <div class="radiobtn"><?php echo $outward_segments[$i]->Destination;?></div>
                                <span class="norto"><?php echo date('d M, D Y', strtotime($outward_segments[$i]->ArriveDate));?></span>
                                <span class="norto lbold"><?php echo date('H:i', strtotime($outward_segments[$i]->ArriveDate));?></span>
                            </div>
                            <div class="col-md-3 nopad">
                                <span class="radiobtn"><?php echo $outward_segments[$i]->FlightId;?></span>
                                <span class="norto"><?php echo $outward_segments[$i]->TfClass;?></span>
                                <span class="norto lbold"><?php echo $outward_segments[$i]->SupplierClass;?></span>
                            </div>
                            </div>
                            <?php
							}
							?>
                             
                        </div>  
                        <?php
							$inward_segments = json_decode($result->inward_segments);
							if($inward_segments!='')
					   {
						   ?>
                        <div class="onwyrow">
                            <div class="fblueline22 linegreen">
                                <b><?php echo $result->destination_airport;?></b> (<?php echo $result->destination;?>) 
                                <span class="farrow"></span> 
                                <b><?php echo $result->origin_airport;?></b> (<?php echo $result->origin;?>)
                            </div>
                            
                             <?php
							 
							for($i=0;$i<count($inward_segments);$i++)
							{
							 ?>
                            <div class="rowfux">
                            <div class="col-md-2">
                                <div class="flitsecimg">
                                    <img alt="" id="" src="<?php echo 'http://www.travelfusion.com/images/logos/'.strtolower(str_replace(" ","",$inward_segments[$i]->Operator)).'.gif'; ?>">
                                    <span class="nortosimle textcentr"><?php echo $inward_segments[$i]->Operator;?></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                               
                                <div class="radiobtn rittextalign"><?php echo $inward_segments[$i]->Origin;?></div>
                                <span class="norto rittextalign"><?php echo date('d M, D Y', strtotime($inward_segments[$i]->DepartDate));?></span>
                                <span class="norto lbold rittextalign"><?php echo date('H:i', strtotime($inward_segments[$i]->DepartDate));?></span>
                            </div>
                            <div class="col-md-1 nopad">
                                <div class="flightimgs">
                                    <img alt="" src="<?php echo ASSETS;?>images/departure.png">
                                </div>
                            </div>
                            <div class="col-md-3">
                               
                                 <div class="radiobtn"><?php echo $inward_segments[$i]->Destination;?></div>
                                <span class="norto"><?php echo date('d M, D Y', strtotime($inward_segments[$i]->ArriveDate));?></span>
                                <span class="norto lbold"><?php echo date('H:i', strtotime($inward_segments[$i]->ArriveDate));?></span>
                            </div>
                            <div class="col-md-3 nopad">
                                <span class="radiobtn"><?php echo $inward_segments[$i]->FlightId;?></span>
                                <span class="norto"><?php echo $inward_segments[$i]->TfClass;?></span>
                                <span class="norto lbold"><?php echo $inward_segments[$i]->SupplierClass;?></span>
                            </div>
                            </div>
                            <?php
							}
							?> 
                             
                        </div>
                        <?php
					   }
					   
					   ?>
                    </div>
                                             
                                        </div>
                                        <div class="xlbook col-xs-3 bordbor bookprice">
                                          
                                       
                                            
                                              <span class="fstatus"><?php echo $result->leadpax; ?></span>
                                                <span class="fstatus"><?php echo BASE_CURRENCY_ICON; ?> <?php echo $result->total_amount; ?></span>
                                                  <span class="fstatus"><?php echo $result->booking_status; ?></span>
                                            <div class="pxconf fstatus">
<ul class="list-inline bookicons">
<li><a href="<?php echo WEB_URL; ?>voucher/<?php echo base64_encode(base64_encode($getoverallBookings[$k]->pnr_no)); ?>" target="_blank"><button class="btn btngreen" data-toggle="tooltip" data-placement="top" title="View voucher"><i class="fa fa-file-text-o"></i></button></a></li>

<li><a href="<?php echo WEB_URL; ?>invoice/<?php echo base64_encode(base64_encode($getoverallBookings[$k]->pnr_no)); ?>" target="_blank"><button class="btn btngreen" data-toggle="tooltip" data-placement="top" title="View Invoice"><i class="fa fa-money"></i></button></a></li> 

</ul>
                                            
                                             </div>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <?php
                                }
                            } ?>
                            <?php echo $this->new_ajax->create_links(); ?>
                    <?php   }
                        else
                        {
                            ?>
                            
                         <div class="col-md-12" style="margin: 0 auto; text-align: center;">
                    <div class="srywrap"><span class="sorrydiv"><img src="<?php echo ASSETS; ?>images/sorry.png" alt="" /><h4 class="stepshed">No Result Found!</h4></span></div>
                </div>
                <?php
                        }
                        ?>
                           
                            
                         <?php /*?>   <div class="fulltable bkingg">  
                                <div class="bookrow">
                                    <div class="topbokro">
                                        <h4 class="bokrname">
                                            <span class="fa fa-bed"></span>
                                              PNR No:  F2E200056H
                                        </h4>
                                        <div class="pnrnum">
                                             <strong>Radha Hometel </strong>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="remful">
                                        <div class="xlbook col-xs-2 bookimg">
                                            <div class="imghtlflt">
                                           
                                                <img src="http://192.168.0.145/transion/assets/theme_dark/images/overview.jpg" alt="" />
                                               
                                            </div>
                                        </div>
                                        <div class="xlbook col-xs-7 bookdetails">
                                            <div class="htlfltr">
                                                <div class="col-md-6 nopad">
                                                    <div class="outdates">
                                                    <div class="datesin">
                                                        <span class="hdcheck">Check-in</span>
                                                        <span class="datin">23 Jun 2016</span>
                                                    </div>
                                                    <div class="datesin">
                                                        <span class="hdcheck">Check-Out</span>
                                                        <span class="datin">23 Jun 2016</span>
                                                    </div>
                                               </div>
                                                </div>
                                                <div class="col-md-6 nopad">
                                                    <h3 class="shtlname">Hotel Name</h3>
                                                    <div class="starrting">
                                                        <img alt="" src="<?php echo ASSETS; ?>images/fourstar.png">
                                                    </div>
                                                    <div class="pricediv">$2300</div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="xlbook col-xs-3 bordbor bookprice">
                                          
                                     
                                            <span class="fstatus">Cancelled</span>
                                            <div class="pxconf">
<ul class="list-inline bookicons">
<li><button class="btn btngreen" data-toggle="tooltip" data-placement="top" title="Mail voucher"><i class="fa fa-envelope-o"></i></button></li>
<li><button class="btn btngreen" data-toggle="tooltip" data-placement="top" title="Mail voucher"><i class="fa fa-file-text-o"></i></button></li>
<li><button class="btn btngreen" data-toggle="tooltip" data-placement="top" title="Mail voucher"><i class="fa fa-eye"></i></button></li>
<li><button class="btn btngreen" data-toggle="tooltip" data-placement="top" title="Mail voucher"><i class="fa fa-money"></i></button></li>

</ul>
                                            
                                             </div>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
                            <div class="fulltable bkingg">  
                                <div class="bookrow">
                                    <div class="topbokro">
                                        <h4 class="bokrname">
                                            <span class="fa fa-plane"></span>
                                             PNR No: F2E200056H
                                        </h4>
                                        <div class="pnrnum">
                                            <strong></strong>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="remful">
                                        <div class="xlbook col-xs-2 bookimg">
                                            <div class="imghtlflt">
                                                <img src="http://192.168.0.145/transion/assets/theme_dark/images/cab.jpg" alt="" />
                                            </div>
                                        </div>
                                        <div class="xlbook col-xs-7 bookdetails">
                                            <div class="htlfltr">
                                                <div class="col-md-6 nopad">
                                                    <div class="outdates">
                                                    <div class="datesin">
                                                        <span class="hdcheck">Check-in</span>
                                                        <span class="datin">23 Jun 2016</span>
                                                    </div>
                                                    <div class="datesin">
                                                        <span class="hdcheck">Check-Out</span>
                                                        <span class="datin">23 Jun 2016</span>
                                                    </div>
                                               </div>
                                                </div>
                                                <div class="col-md-6 nopad">
                                                    <h3 class="shtlname">Car Name</h3>
                                                    <div class="starrting">
                                                        <img alt="" src="<?php echo ASSETS; ?>images/fourstar.png">
                                                    </div>
                                                    <div class="pricediv">$2300</div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="xlbook col-xs-3 bordbor bookprice">
                                    
                                            <span class="fstatus">Cancelled</span>
                                            <div class="pxconf">
<ul class="list-inline bookicons">
<li><button class="btn btngreen" data-toggle="tooltip" data-placement="top" title="Mail voucher"><i class="fa fa-envelope-o"></i></button></li>
<li><button class="btn btngreen" data-toggle="tooltip" data-placement="top" title="Mail voucher"><i class="fa fa-file-text-o"></i></button></li>
<li><button class="btn btngreen" data-toggle="tooltip" data-placement="top" title="Mail voucher"><i class="fa fa-eye"></i></button></li>
<li><button class="btn btngreen" data-toggle="tooltip" data-placement="top" title="Mail voucher"><i class="fa fa-money"></i></button></li>

</ul>
                                            
                                             </div>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div><?php */?>