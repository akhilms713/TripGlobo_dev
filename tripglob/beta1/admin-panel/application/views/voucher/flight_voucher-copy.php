<?php
$Booking=$b_data;
// $str ="ela,mathi,pri,yash,raj,nan";
// debug(explode(",",$str,-4));
// exit;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo PROJECT_TITLE; ?></title>
 <link href="<?php echo ASSETS; ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>css/animate.min.css" rel="stylesheet"><!-- Custom styling plus plugins -->
<link href="<?php echo ASSETS; ?>css/custom.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>css/voucher.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>css/flight_result.css" rel="stylesheet">
<script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo ASSETS; ?>js/nicescroll/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS; ?>js/custom.js"></script>





</head>
<body class="nav-md">
<!-- Navigation --> 
    <div class="container body">
        <div class="main_container">
            <?php echo $this->load->view('common/sidebar_menu'); ?>
            <?php echo $this->load->view('common/top_menu'); ?>
            <div class="clearfix"></div>

            <div class="cancel_loader"><div id="mainDiv"><div class="carttoloadr"><strong>Please Wait...Cancellation process is going on!!..</strong></div></div>

             <div class="right_col" role="main">
            <div class="top80">
              <div class="full marintopcnt contentvcr" id="voucher">
                <div class="container offset-0">
                  <div class="centervoucher2">
                    <div class="col-md-12">
                      <div class="alliconfrmt"> <a class="tooltipv iconsofvcr fa fa-print" title="Print " onclick="PrintDiv();"></a>  </div>
                    </div>
                    <div class="clearfix"></div>
                  


                 <div class="col-md-6">
          
                <?php if($Booking->user_type_id ==B2B_USER ){
                
              $user_data =   $this->general_model->get_user_details($Booking->user_id,$Booking->user_type_id );
                ?>
                <div class="agent_or_logo"> <img src="<?php echo UPLOAD_PATH.$user_data->profile_picture;?>" width="100" alt="" /> </div>
                <?php 
                }else  {
                      ?>
                <div class="agent_or_logo" style="    border-radius: 1%;
          display: block;
          height: 100px;
          margin: 0 0 20px;
          overflow: hidden;
          width: 323px;"><img src="<?php echo ASSETS;?>images/logo.png" width="250" alt="" ></div>
                <?php }?>
              </div>
           
            <div class="col-md-6">
            <div class="vcradrss">            
              <?php 


              ?>
              Address:<br/>              
              <?php  echo @$admin_details->address;?><br/>
             <?php  echo @$admin_details->city_name.', '.$admin_details->state_name.' '.$admin_details->zip_code.'. '.$admin_details->country_code_3;?><br/>
              <div class="iconmania"><span class="fa fa-phone"></span> Tel :<?=@$admin_details->admin_cell_phone?></div>
              <div class="iconmania"><span class="fa fa-phone"></span> Toll free :<?=@$admin_details->admin_home_phone?></div>

              <div class="iconmania"><span class="fa fa-envelope"></span><a> Email:<?=@$admin_details->admin_email?></a></div>
              <?php 
                   
          //  }?>
            </div>
          </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tables">
                <tbody>
                  <tr>
                    <td align="left"></td>
                    <td align="right" style="font-size:13px; line-height:20px;"></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="border:0px; border-top:1px dashed #CCC;"><table width="900" border="0" align="center" cellpadding="8" cellspacing="0">
                        <tbody>
                          <tr>
                            <td width="100%" style="line-height:22px; text-align:center"><div class="confirmtionltr">CONFIRMATION LETTER</div></td>
                          </tr>
                          <tr>
                            <td align="center" class="padding1"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tbody>
                                  <tr>
                                    <td width="50%" align="left" valign="top" class="padding1"><table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF">
                                        <tbody>
                                          <tr>
                                            <td colspan="2" align="left"><strong style="font-size:18px;"> <?php echo ucwords($Booking->leadpax);?> </strong></td>
                                          </tr>
                                          <tr>
                                            <td width="50%" align="left">Confirmation No  :</td>
                                            <td width="50%" align="left"><strong><?php echo $b_data->con_pnr_no;?></strong></td>
                                          </tr>
                                           <tr>
                                            <td width="50%" align="left">Pnr No  :</td>
                                            <td width="50%" align="left"><strong><?php echo $b_data->pnr_no;?></strong></td>
                                          </tr>
                                          <tr>
                                            <td width="50%" align="left">Booking Status  :</td>
                                            <td width="50%" align="left"><strong><?php echo $Booking->booking_status;?></strong></td>
                                          </tr>
                                        </tbody>
                                      </table>       
                                      </td>
                                    <td width="50%" align="left" valign="top" class="padding1"><table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF">
                                        <tbody>
                                          <tr>
                                            <td colspan="2" align="left">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td width="50%" align="left">&nbsp;</td>
                                            <td width="50%" align="left">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td align="left">&nbsp;</td>
                                            <td align="left">&nbsp;</td>
                                          </tr>
                                        </tbody>
                                      </table></td>
                                  </tr>
                                </tbody>
                              </table></td>
                          </tr>
                          <tr>
                            <td style="height:20px;width:100%;"></td>
                             <tr>
                           
                          </tr>
                          </tr>

                                <tr>
                                 <td width="100%" style="line-height:22px; text-align:center"><div class="confirmtionltr">FLIGHT DETAIL</div></td>

                               </tr>






                
              
                         <tr>
                            <td class="padding1"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                                <tbody>                              


                          <?php 

                          // debug($Booking);
                          // exit;
                        $segment_data = json_decode($Booking->segment_data);
                        
                        $segment_data = array_filter($segment_data);
                        
                        if ($Booking->api_name == "SABRE") { ?>
                           <?php for($s=0;$s<count($segment_data);$s++){ 
                            // debug($segment_data);
                          // exit;
                          if($segment_data[$s]->dateOfDeparture){
                              $arrival_count=count($segment_data[$s]->DestinationLocation);
                              $no=$arrival_count-1;
                          ?>
                          <div class="col-xs-12 ways_one nopad">
                              <div class="inboundiv">
                                  <div class="hedtowr">
                                       <?php echo $this->reports_model->get_airport_name($segment_data[$s]->OriginLocation[0]); ?> <span class="fa fa-exchange"></span>  <?php echo $this->reports_model->get_airport_name($segment_data[$s]->DestinationLocation[$no]); ?>
                                  </div>
                                   <?php for($ss=0;$ss<count($segment_data[$s]->dateOfDeparture);$ss++){ ?>
                                   <div class="flitone">
                                      <div class="col-xs-3 nopad5 width_hundred">
                                          <div class="imagesmflt">
                                              <img alt="" src="https://c.fareportal.com/n/common/air/ai/<?php echo $segment_data[$s]->MarketingAirline[$ss] ; ?>.gif">
                                          </div>
                                          <div class="flitsmdets" style="overflow:visible;">
                                              <?php echo $segment_data[$s]->Airline_name[$ss]; ?> -  <strong> <?php echo $segment_data[$s]->FlighvgtNumber_no[$ss]; ?><br>
                                                <?php echo $segment_data[$s]->Equipment[$ss]; ?></strong>
                                          </div>
                                      </div>
                                      <div class="col-xs-9 nopad width_hundred">
        


                                        <div class="waymensn">
                                          <div class="detail_section">
                                            <div class="detlnavi">
                                            <div class="col-xs-4 padflt widfty">
                                              <span class="timlbl right">
                                                                            <span class="sprite reflone"></span>
                                                <span class="flname"><?php echo $segment_data[$s]->Origin[$ss]; ?> <span class="fltime"><?php echo date("H:i", strtotime($segment_data[$s]->DepartureDateTime_r[$ss]));  ?></span></span>
                                              </span>
                                              <div class="clearfix"></div>
                                                                          <div class="clearfix"></div>
                                              <span class="flitrlbl elipsetool"><?php echo date("M d,Y", strtotime($segment_data[$s]->DepartureDateTime_r[$ss]));  ?> </span>
                                            </div>
                                            <div class="col-xs-4 nopad padflt widfty">
                                              <div class="lyovrtime"> 
                                                <span class="flect"> <span class="sprite retime"></span> <?php echo $segment_data[$s]->segment_duration[$ss]; ?></span>
                                                <div class="termnl1 hide">Change Clock : <?php echo $segment_data[$s]->Clock_Changes[$ss]." Hours"; ?></div>
                                              </div>  
                                            </div>
                                          <div class="col-xs-4 padflt widfty">
                                            <span class="timlbl left">
                                                                        <span class="sprite refltwo"></span>
                                              <span class="flname"><?php echo $segment_data[$s]->Destination[$ss]; ?><span class="fltime"><?php echo date("H:i", strtotime($segment_data[$s]->ArrivalDateTime_r[$ss]));  ?></span> </span>
                                              
                                            </span>
                                            <div class="clearfix"></div>
                                                                      <div class="clearfix"></div>
                                            <span class="flitrlbl elipsetool"><?php echo date("M d,Y", strtotime($segment_data[$s]->ArrivalDateTime_r[$ss]));  ?></span>
                                          </div>
                                        </div>
                                          </div>
                                        </div>

                                    </div>
                                  </div>
                                  <div class="clearfix"></div>
                                <?php } ?>
                                  <div class="clearfix"></div>
                                  
                              </div>
                          </div>
                          <?php }} ?>
                     <?php   } else {
                            $PricingDetails = json_decode($b_data->PricingDetails,true);
                         foreach($PricingDetails[0]['PriceInfo']['PassengerFare'] as $key=>$val){
                              $pax_type = $key;
                            if($key=='ADT'){
                              $pax_type='Adult';
                            }elseif ($key=='CH' || $key == 'CNN') {
                              $pax_type = 'Child';
                            }elseif ($key=='INF') {
                              $pax_type='Infant';
                            }
                              $price_summary['base_fare'][$key]['pax_type'] = $pax_type.'(s)';

                              $price_summary['base_fare'][$key]['break_down'] = $val['count'].' '.$pax_type.'(s)'.' ('.$val['count'].'X'.($val['totalFareAmount']-$val['totalTaxAmount']).')';

                              $pax_tax = $val['totalTaxAmount'];

                              $price_summary['base_fare'][$key]['total_tax'] = $val['count']*$pax_tax;

                              $price_summary['base_fare'][$key]['total_pax_amount'] = ($val['count']*($val['totalFareAmount']-$val['totalTaxAmount']));
                              $price_summary['base_fare'][$key]['total_amount'] = ($val['count']*$val['totalFareAmount']);

                          }
                   ?>
                        <?php for($s=0;$s<count($segment_data);$s++){ 
                         
                          if($segment_data[$s]->dateOfDeparture){
                              $arrival_count=count($segment_data[$s]->locationIdArival);
                              $no=$arrival_count-1;
                          ?>
                          <div class="col-xs-12 ways_one nopad">
                              <div class="inboundiv">
                                  <div class="hedtowr">
                                       <?php echo $this->reports_model->get_airport_name($segment_data[$s]->locationIdDeparture[0]); ?> <span class="fa fa-exchange"></span>  <?php echo $this->reports_model->get_airport_name($segment_data[$s]->locationIdArival[$no]); ?>
                                  </div>
                                   <?php for($ss=0;$ss<count($segment_data[$s]->dateOfDeparture);$ss++){ ?>
                                   <div class="flitone">
                                      <div class="col-xs-3 nopad5 width_hundred">
                                          <div class="imagesmflt">
                                              <img alt="" src="https://c.fareportal.com/n/common/air/ai/<?php echo $segment_data[$s]->marketingCarrier[$ss] ; ?>.gif">
                                          </div>
                                          <div class="flitsmdets" style="overflow:visible;">
                                              <?php echo $segment_data[$s]->airlineName[$ss]; ?> -  <strong> <?php echo $segment_data[$s]->flightOrtrainNumber[$ss]; ?><br>
                                                <?php echo $segment_data[$s]->equipmentType[$ss]; ?></strong>
                                          </div>
                                      </div>
                                      <div class="col-xs-9 nopad width_hundred">
        


                                        <div class="waymensn">
                                          <div class="detail_section">
                                            <div class="detlnavi">
                                            <div class="col-xs-4 padflt widfty">
                                              <span class="timlbl right">
                                                                            <span class="sprite reflone"></span>
                                                <span class="flname"><?php echo $segment_data[$s]->locationIdDeparture[$ss]; ?> <span class="fltime"><?php echo $segment_data[$s]->DepartureTime[$ss]; ?></span></span>
                                              </span>
                                              <div class="clearfix"></div>
                                                                          <div class="clearfix"></div>
                                              <span class="flitrlbl elipsetool"><?php echo date("M d,Y", strtotime($segment_data[$s]->DepartureDate[$ss]));  ?> </span>
                                            </div>
                                            <div class="col-xs-4 nopad padflt widfty">
                                              <div class="lyovrtime"> 
                                                <span class="flect"> <span class="sprite retime"></span> <?php echo $segment_data[$s]->duration_time_zone[$ss]; ?></span>
                                                <div class="termnl1">Change Clock : <?php echo $segment_data[$s]->Clock_Changes[$ss]." Hours"; ?></div>
                                              </div>  
                                            </div>
                                          <div class="col-xs-4 padflt widfty">
                                            <span class="timlbl left">
                                                                        <span class="sprite refltwo"></span>
                                              <span class="flname"><?php echo $segment_data[$s]->locationIdArival[$ss]; ?><span class="fltime"><?php echo $segment_data[$s]->ArrivalTime[$ss]; ?></span> </span>
                                              
                                            </span>
                                            <div class="clearfix"></div>
                                                                      <div class="clearfix"></div>
                                            <span class="flitrlbl elipsetool"><?php echo date("M d,Y", strtotime($segment_data[$s]->ArrivalDate[$ss]));  ?></span>
                                          </div>
                                        </div>
                                          </div>
                                        </div>

                                    </div>
                                  </div>
                                  <div class="clearfix"></div>
                                <?php } ?>
                                  <div class="clearfix"></div>
                                  
                              </div>
                          </div>
                       <?php } } } ?>
                        
                        

                    </tbody>
                    </table>
                          <tr>
                            <td class="padding1"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                                <tbody>
                                  <tr>
                                    <td colspan="5" class="padding1"><div class="detailhed_trvels">Traveller Details </div></td>
                                  </tr>
                                  <tr style="background:#eeeeee">
                                    <th align="left" valign="top"><strong>Passenger </strong></th>
                                    <th align="left" valign="top"><strong> Traveller Name </strong></th>                                
                                    <th align="left" valign="top"><strong>DOB </strong></th>
                             
                                  </tr>
                                  <?php
  		for($l=0;$l<count($Passenger);$l++)
  		{
  			?>
                                  <tr style="background:#ffffff">
                                    <td><?php echo $Passenger[$l]->passenger_type;?></td>
                                    <td><?php echo $Passenger[$l]->gender.' '.$Passenger[$l]->first_name.' '.$Passenger[$l]->middle_name.' '.$Passenger[$l]->last_name;?></td>
                                    
                                    <td><?php echo date('M d,Y',strtotime($Passenger[$l]->dob));?></td>
                                  
                                  </tr>
                                  <?php	
                                }
    
  		?>
                                </tbody>
                              </table></td>
                          </tr>
                          <tr>
                            <td style="height:10px;width:100%;"></td>
                          </tr>
                             <tr>
                            <td>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                              <tbody>
                                <tr><td colspan="5" class="padding1"><div class="detailhed_trvels">Payment Details </div></td></tr>
                                     <tr style="background:#eeeeee">
                                     <th align="left" valign="top"><strong>Pax Type</strong></th>

                                    <th align="left" valign="top"><strong>Base Fare</strong></th>
                                    <th align="left" valign="top"><strong>Taxes & Fees</strong></th>

                                    <th align="left" valign="top"><strong>Total Fare </strong></th>

                                                                        
                                  </tr>
                                <?php 
                                  $booking_transaction = $booking_transaction[0];

                                ?>  
                                  
                                    <?php if ($Booking->api_name == "SABRE") { ?>
                                    <?php 
                                    $pax_array['ADT'] = 'Adult';
                                    $pax_array['CNN'] = 'Adult';
                                    $pax_array['INF'] = 'Adult';
                                     ?>
                                     <?php foreach($segment_data[0]->PCode as $key=>$val){ ?>           
                                     <tr>
                                       <?php 
                                          $total_pax = 0;
                                          $total_amount = 0;
                                          if($val=='ADT'){
                                              $total_pax = (($segment_data[0]->PEquivFare_org[$key] * $segment_data[0]->PQuantity[$key])+$booking_transaction->total_adult_markup);
                                              $total_amount = ($segment_data[0]->PTotalFare_org[$key] + $booking_transaction->total_adult_markup);                                           
                                          }elseif ($val=='CH' || $val == 'CNN') { 
                                              $total_pax = (($segment_data[0]->PEquivFare_org[$key] * $segment_data[0]->PQuantity[$key])+$booking_transaction->total_child_markup); 
                                                $total_amount = ($segment_data[0]->PTotalFare_org[$key] + $booking_transaction->total_child_markup);

                                          }elseif ($val=='INF') {
                                              $total_pax = (($segment_data[0]->PEquivFare_org[$key] * $segment_data[0]->PQuantity[$key])+$booking_transaction->total_infant_markup); 
                                                $total_amount = ($segment_data[0]->PTotalFare_org[$key] + $booking_transaction->total_infant_markup);

                                          }
                                     ?>
                                      <td><?=$pax_array[$val]?></td> 
                                      <td><?=BASE_CURRENCY_ICON.($total_pax) ?></td> 
                                      <td><?=BASE_CURRENCY_ICON.$segment_data[0]->TotalTax?></td>    
                                      <td><?=BASE_CURRENCY_ICON.$total_amount?></td>
                                      
                                     
                                       </tr>
                                    <?php }?>
                                    <?php } else { ?>
                                    <?php foreach($price_summary['base_fare'] as $key=>$val){ ?>           
                                     <tr>
                                       <?php 
                                          $total_pax = 0;
                                          $total_amount = 0;
                                          if($key=='ADT'){
                                              $total_pax = ($val['total_pax_amount']+$booking_transaction->total_adult_markup);
                                              $total_amount = ($val['total_amount'] + $booking_transaction->total_adult_markup);                                           
                                          }elseif ($key=='CH' || $key == 'CNN') { 
                                              $total_pax = ($val['total_pax_amount']+$booking_transaction->total_child_markup); 
                                                $total_amount = ($val['total_amount'] + $booking_transaction->total_child_markup);

                                          }elseif ($key=='INF') {
                                              $total_pax = ($val['total_pax_amount']+$booking_transaction->total_infant_markup); 
                                                $total_amount = ($val['total_amount'] + $booking_transaction->total_infant_markup);

                                          }
                                     ?>
                                      <td><?=$val['break_down']?></td> 
                                      <td><?=BASE_CURRENCY_ICON.($total_pax) ?></td> 
                                      <td><?=BASE_CURRENCY_ICON.$val['total_tax']?></td>    
                                      <td><?=BASE_CURRENCY_ICON.$total_amount?></td>
                                      
                                     
                                       </tr>
                                    <?php }?>
                                    <?php }
                                     ?>
                                 
                                  <tr>
                                      <td></td>
                                      <td></td>
                                     <td align="left" valign="top"><strong>Service Tax & Maintenance Charge</strong></td>
                                    <td><?=BASE_CURRENCY_ICON.($booking_transaction->admin_markup+$booking_transaction->agent_markup)?></td>
                                  </tr>

                                   <?php 
                                        if($Booking->user_type_id ==B2C_USER):
                                      ?>
                                      <tr>
                                         <td></td>
                                      <td></td>
                                     <td align="left" valign="top"><strong>Discount</strong></td>
                                        <td><?=BASE_CURRENCY_ICON.$booking_transaction->discount?></td>
                                      </tr>
                                      <?php endif;?>
                                   <tr>
                                      <td></td>
                                      <td></td>
                                     <td align="left" valign="top"><strong>Total Payment</strong></td>
                                    <td><?=BASE_CURRENCY_ICON.($booking_transaction->total_amount)?></td>
                                  </tr>


                              </tbody>
                              </table>
                            </td>
                        </tr> 
                          <tr>
                            <td style="height:10px;width:100%;"></td>
                          </tr>

                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                                <tbody>
                                  <tr>
                                    <td colspan="2" class="padding1"><div class="detailhed_trvels">Customer Details</div></td>
                                  </tr>
                                  <tr class="set_bordr">
                                    <td width="20%" align="left" style="background:#f1f1f1"><strong>Email ID</strong></td>
                                    <td width="80%" align="left" style="background:#ffffff"><?php echo $booking_agent[0]->billing_email;?></td>
                                  </tr>
                                  <tr class="set_bordr">
                                    <td align="left" style="background:#f1f1f1"><strong>Mobile Number</strong></td>
                                    <td align="left" style="background:#ffffff"><?php echo $booking_agent[0]->billing_contact_number;?></td>
                                  </tr>
                                  <tr class="set_bordr">
                                    <td align="left" style="background:#f1f1f1"><strong>Address</strong></td>
                                    <td align="left" style="background:#ffffff"><?php echo $booking_agent[0]->billing_address;?>, <?php echo $booking_agent[0]->billing_city;?>, <?php echo $booking_agent[0]->billing_state;?>, <?php echo $booking_agent[0]->billing_zip;?></td>
                                  </tr>
                                </tbody>
                              </table></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                        <tbody>
                          <tr>
                            <td><div class="detailhed_trvels">Terms & Conditions </div></td>
                          </tr>
                          <tr>
                            <?php 
                              $request_flight = json_decode($Booking->request_scenario,true);
                             
                              $current_date = date('Y-m-d');
                              $travel_date = date('Y-m-d',strtotime($request_flight['depart_date']));
                            ?>
                            <td align="left" valign="top" style="padding:0 10px;"><div class="paratems"> Not Available </div></td>
                            <?php if(!$Booking->bundle_search_id):?>
                            <?php if(($current_date < $travel_date)&&($Booking->booking_status=='CONFIRMED' || $Booking->booking_status =='CANCEL_HOLD')):?>
                              <td><button data-pnr="<?php echo base64_encode($b_data->pnr_no);?>" data-con-pnr="<?php echo base64_encode($b_data->con_pnr_no);?>"  class="btn btn-danger" id="cancelPnrbooking">Ticket-cancel</button></td>
                          <?php endif;?>
                        <?php endif;?>
                          </tr>

                        </tbody>
                      </table></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
     <?php echo $this->load->view('common/footer'); ?> 

  </div>
</div>
</div>


<!-- Page Content --> 




   <script src="<?php echo ASSETS; ?>js/bootstrap.min.js"></script> 
   
  
<?php //echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>

<!-- Script to Activate the Carousel -->

<style>
.leftflitmg { max-width:70px !important } 
</style>



<script type="text/javascript">
$(document).ready(function() {
    $(".tooltipv").tooltip();
    $("#cancelPnrbooking").click(function(){
      var pnr_no = $(this).data('pnr');
      var con_pnr_no = $(this).data('con-pnr');
      $('.cancel_loader .carttoloadr').show();
      $.ajax({
          type:"post",
          url:"<?php echo base_url()?>"+"reports/CancelPnr",
          data:{PNR_NO:pnr_no,CON_PNR_NO:con_pnr_no},
          success:function(res){
            $('.cancel_loader .carttoloadr').hide();
            
            if(res==0){
              alert('Cancellation not success');
            }else{
              alert('Cancellation success');              
            }
            location.reload();

          },
          error:function(res){
            
          }
      });

    });
});

function PrintDiv() {    
   var voucher = document.getElementById('voucher');
   var popupWin = window.open('', '_blank', 'width=600,height=600');
   popupWin.document.open();
   popupWin.document.write('<html><head><link href="<?php echo ASSETS;?>css/bootstrap.min.css" rel="stylesheet" media="print"><link href="<?php echo ASSETS;?>css/temp.css" rel="stylesheet" media="screen"><link href="<?php echo ASSETS;?>css/voucher.css" rel="stylesheet" media="screen"><style>@media print {.col-md-1,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-10,.col-md-11 {float: left;}.col-md-1 {width: 8.333333333333332%;}.col-md-2 {width: 16.666666666666664%;}.col-md-3 {width: 25%;}.col-md-4 {width: 33.33333333333333%;}.col-md-5 {width: 41.66666666666667%;}.col-md-6 {width: 50%;}.col-md-7 {width: 58.333333333333336%;}.col-md-8 {width: 66.66666666666666%;}.col-md-9 {width: 75%;}.col-md-10 {width: 83.33333333333334%;}.col-md-11 {width: 91.66666666666666%;}.col-md-12 {width: 100%;}}.tooltip, .tooltipv{display: none !important;}</style></head><body onload="window.print()">' + voucher.innerHTML + '</html>');
   popupWin.document.close();
}
</script>
</body>
</html>
