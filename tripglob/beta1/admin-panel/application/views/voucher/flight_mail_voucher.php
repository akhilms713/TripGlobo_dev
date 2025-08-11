<?php
$Booking=$b_data;
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
<link rel="icon" href="https://tripglobo.com/beta1/assets/theme_dark/images/favicon.png" type="image/x-icon">
</head>
<body class="nav-md">

 <div class="centervoucher2" style="display: table;margin: 0 auto;padding: 20px 1%;border: 1px solid #dddddd; width: 70%; font-family: arial;">
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
                            <td width="100%" style="line-height:22px; text-align:center; color: #666; display: block; font-size: 20px; overflow: hidden; padding: 20px;">
                              <div class="confirmtionltr">CONFIRMATION LETTER</div></td>
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
                                 <td width="100%" style="line-height:22px; text-align:center; color: #666; display: block; font-size: 20px; overflow: hidden; padding: 20px;">
                                  <div class="confirmtionltr">FLIGHT DETAIL</div>
                                </td>

                               </tr>
              
                         <tr>
                            <td class="padding1">

                          <?php 

                          
                        $segment_data = json_decode($Booking->segment_data);
                        
                        $segment_data = array_filter($segment_data);
                   ?>
                        <?php for($s=0;$s<count($segment_data);$s++){ 
                         
                          if($segment_data[$s]->dateOfDeparture){
                              $arrival_count=count($segment_data[$s]->locationIdArival);
                              $no=$arrival_count-1;
                          ?>
                              <table class="inboundiv" style="border-radius: 3px; overflow: hidden; padding: 10px; width: 100%;">
                                <tr>
                                <td colspan="4" class="hedtowr" style="border-bottom: 1px dashed #ddd; color: #333;  font-size: 16px; font-weight: 500; overflow: hidden; background: #f5f5f5;padding: 5px 0px;">
                                       <?php echo $this->reports_model->get_airport_name($segment_data[$s]->locationIdDeparture[0]); ?> to  <?php echo $this->reports_model->get_airport_name($segment_data[$s]->locationIdArival[$no]); ?>
                                  </td>
                                </tr>



                                
                                   <?php for($ss=0;$ss<count($segment_data[$s]->dateOfDeparture);$ss++){ ?>
                                   <tr class="flitone" style="  margin: 10px 0px 10px 0px; overflow: hidden; padding: 0px 0;">
                                      <td style="width: 20%;">
                                          <div class="imagesmflt" style="float: left; margin-right: 5px;">
                                              <img alt="" src="https://c.fareportal.com/n/common/air/ai/<?php echo $segment_data[$s]->marketingCarrier[$ss] ; ?>.gif">
                                          </div>
                                          <div class="flitsmdets" style="overflow:visible; display: block; line-height: 16px; font-size: 14px;">
                                              <?php echo $segment_data[$s]->airlineName[$ss]; ?> -  <strong style="color: #666; display: block; font-weight: 300; margin: 0px 0 0; overflow: hidden;"> <?php echo $segment_data[$s]->flightOrtrainNumber[$ss]; ?><br>
                                                <?php echo $segment_data[$s]->equipmentType[$ss]; ?></strong>
                                          </div>
                                      </td>


                              
                                            <td style="text-align: right; width: 30%;">
                                              <span class="timlbl right" style="font-size: 14px !important; color: #004ec2;  line-height: 22px; overflow: hidden;">
                                                <span class="flname" style="display: block; font-size: 16px; overflow: hidden; line-height: 28px; width: 100%;"><?php echo $segment_data[$s]->locationIdDeparture[$ss]; ?> 
                                                <span class="fltime" style="font-weight: 500; margin-left: 10px; line-height: 28px;"><?php echo $segment_data[$s]->DepartureTime[$ss]; ?></span></span>
                                              </span>
                                              <div class="clearfix"></div>
                                                                          <div class="clearfix"></div>
                                              <span class="flitrlbl elipsetool" style="color: #2d2b29; display: block;font-size: 14px;font-weight: 300; line-height:28px;"><?php echo date("M d,Y", strtotime($segment_data[$s]->DepartureDate[$ss]));  ?> </span>
                                            </td>

                                            <td style=" width: 30%;">
                                              <div class="lyovrtime" style="display: block; text-align: center; width: 100%;"> 
                                                <span class="flect" style="color: #2d2b29; display: table; font-size: 14px; margin: 0 auto auto; padding: 5px 10px; line-height: 21px;"> 
                                                  <span class="sprite retime"></span> <?php echo $segment_data[$s]->duration_time_zone[$ss]; ?>
                                                </span>
                                                <div class="termnl1" style="display: block; margin: 0 0 3px; overflow: hidden;">Change Clock : <?php echo $segment_data[$s]->Clock_Changes[$ss]." Hours"; ?></div>
                                              </div>  
                                            </td>

                                          <td style=" width: 20%;">
                                            <span class="timlbl left" style="font-size: 14px !important; color: #004ec2;  line-height: 22px; overflow: hidden;">
                                              <span class="flname" style="display: block; font-size: 16px; overflow: hidden; line-height: 28px; width: 100%;"><?php echo $segment_data[$s]->locationIdArival[$ss]; ?>
                                              <span class="fltime" style="font-weight: 500; margin-left: 10px; line-height: 28px;"><?php echo $segment_data[$s]->ArrivalTime[$ss]; ?></span> 
                                            </span>
                                              
                                            </span>
                                            <div class="clearfix"></div>
                                                                      <div class="clearfix"></div>
                                            <span class="flitrlbl elipsetool"><?php echo date("M d,Y", strtotime($segment_data[$s]->ArrivalDate[$ss]));  ?></span>
                                          </td>
                                       


                                  </tr>
                                <?php } ?>
                                  <div class="clearfix"></div>
                                  
                          </table>
                       <?php } } ?>

                     </td>
                   </tr>

                   
                          <tr>
                            <td class="padding1">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                                <tbody>
                                  <tr>
                                    <td colspan="5" class="padding1">
                                      <div class="detailhed_trvels" style="font-size: 18px; padding: 10px 0;">Traveller Details </div></td>
                                  </tr>
                                  <tr style="background:#eeeeee">
                                    <th align="left" valign="top" style="padding: 10px;"><strong>Passenger </strong></th>
                                    
                                    <th align="left" valign="top" style="padding: 10px;"><strong>Traveller Name </strong></th>
                                    <th align="left" valign="top" style="padding: 10px;"><strong>DOB </strong></th>
                                   
                                  </tr>
                                  <?php
      for($l=0;$l<count($Passenger);$l++)
      {
         ?>
                                  <tr style="background:#ffffff">
                                    <td style="padding: 10px;"><?php echo $Passenger[$l]->passenger_type;?></td>
                                    <td style="padding: 10px;"><?php echo $Passenger[$l]->gender.' '.$Passenger[$l]->first_name.' '.$Passenger[$l]->middle_name.' '.$Passenger[$l]->last_name;?></td>             
                                    <td style="padding: 10px;"><?php echo date('M d,Y',strtotime($Passenger[$l]->dob));?></td>
                                   
                                  </tr>
                                  <?php   
                                }
    
      ?>
                                </tbody>
                              </table></td>
                          </tr>
                          <?php 
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
                                    <td colspan="2" class="padding1">
                                      <div class="detailhed_trvels" style="font-size: 18px; padding: 10px 0;">Customer Details</div></td>
                                  </tr>
                                  <tr class="set_bordr">
                                    <td width="20%" align="left" style="background:#f1f1f1; padding:10px; border: 1px solid #eee;"><strong>Email ID</strong></td>
                                    <td width="80%" align="left" style="background:#ffffff; padding:10px; border: 1px solid #eee;"><?php echo $booking_agent[0]->billing_email;?></td>
                                  </tr>
                                  <tr class="set_bordr">
                                    <td align="left" style="background:#f1f1f1; padding:10px; border: 1px solid #eee;"><strong>Mobile Number</strong></td>
                                    <td align="left" style="background:#ffffff; padding:10px; border: 1px solid #eee;"><?php echo $booking_agent[0]->billing_contact_number;?></td>
                                  </tr>
                                  <tr class="set_bordr">
                                    <td align="left" style="background:#f1f1f1; padding:10px; border: 1px solid #eee;"><strong>Address</strong></td>
                                    <td align="left" style="background:#ffffff; padding:10px; border: 1px solid #eee;"><?php echo $booking_agent[0]->billing_address;?>, <?php echo $booking_agent[0]->billing_city;?>, <?php echo $booking_agent[0]->billing_state;?>, <?php echo $booking_agent[0]->billing_zip;?></td>
                                  </tr>
                                </tbody>
                              </table></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="padding: 10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                        <tbody>
                          <tr>
                            <td style="padding: 10px;"><div class="detailhed_trvels" style="font-size: 18px; padding: 10px 0;">Terms & Conditions </div></td>
                          </tr>
                          <tr>
                            <td  align="left" valign="top" style="padding:10px;"><div class="paratems"> Not Available </div></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

</body>
</html>
