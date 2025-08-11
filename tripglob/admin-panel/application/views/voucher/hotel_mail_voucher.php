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
<div class="centervoucher2">

          <div class="clearfix"></div>
          <div class="col-md-12">
            <table width="100%" style="font-family: arial;" border="0" align="center" cellpadding="0" cellspacing="0" class="tables">
              <tbody>
               
                <tr>
                  <td align="left"></td>
                  <td align="right" style="font-size:13px; line-height:20px;"></td>
                </tr>
                <tr>
                  <td colspan="2" style="border:0px; ">
                     <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tbody>

                        <tr >
                  <?php $images = explode(',', $cart->image); ?>
                     <td class="col-md-6">
                       <?php if($Booking->user_type_id ==B2B_USER ){
                
              $user_data =   $this->general_model->get_user_details($Booking->user_id,$Booking->user_type_id );
                ?>
                  <div class="agent_or_logo"> <img src="<?php echo UPLOAD_PATH.$user_data->profile_picture;?>" width="100" alt="" /> </div>

                 <?php 

                }else  {
                      ?>

                     <div class="agent_or_logo" style="border-radius: 1%;
                     display: block;
                     height: 100px;
                     margin: 0 0 20px;
                     overflow: hidden;
                     width: 120px;"><img style="width: 120px;" src="<?php echo ASSETS;?>images/logo.png" />
                      
                      <?php }?>

                     </div>
                     </td>

                     <td class="col-md-6">
                     <div class="vcradrss" style="color: #333; display: block; font-size: 16px; line-height: 24px; overflow: hidden; text-align: right;">
                    <?php  echo @$admin_details->address;?><br/>
                   <?php  echo @$admin_details->city_name.', '.$admin_details->state_name.' '.$admin_details->zip_code.'. '.$admin_details->country_code_3;?><br/>
                        
                    
                    <div class="iconmania"><span class="fa fa-phone"></span> Tel :<?=@$admin_details->admin_cell_phone?></div>
                    <div class="iconmania"><span class="fa fa-phone"></span> Toll free :<?=@$admin_details->admin_home_phone?></div>

                    <div class="iconmania"><span class="fa fa-envelope"></span><a> Email:<?=@$admin_details->admin_email?></a></div>
                     </td>
               </tr>


                        <tr>
                          <td colspan="2" width="100%" style="line-height:22px; text-align:center; border-top:1px dashed #cccccc;"><div class="confirmtionltr">CONFIRMATION LETTER</div></td>
                        </tr>

                        <tr>
                          <td colspan="2" align="center" style="padding:0px;" class="padding1">
                           <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                              <tbody>
                                <tr>
                                  <td width="50%" align="left" valign="top" class="padding1"><table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF">
                                      <tbody>
                                        <tr>
                                       
                                        <?php
                                          $title = 'Miss'; 
                                          if($Passenger[0]->gender=='MALE'){
                                            $title ='Mr';
                                          }
                                        ?>
                                          <td colspan="2" align="left"><strong style="font-size:18px;"> <?php echo $title.' '.$Passenger[0]->first_name.' '.$Passenger[0]->middle_name.' '.$Passenger[0]->last_name; //echo $Booking->leadpax; ?> </strong></td>
                                        </tr>
                                        <tr>
                                          <td width="50%" align="left">Confirmation No  :</td>
                                          <td width="50%" align="left"><strong><?php echo $Booking->pnr_no; ?></strong></td>
                                        </tr>
                                        <tr>
                                          <td width="50%" align="left">Booking Status  :</td>
                                          <td width="50%" align="left"><strong><?php echo $Booking->booking_status; ?></strong></td>
                                        </tr>
                                      </tbody>
                                    </table></td>
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
                        </tr>
                        <tr>
                          <td colspan="2" align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #cccccc;  font-size: 15px;line-height: 20px;">
                           <table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
                              <tbody>
                                <tr>
                                  <td colspan="4" bgcolor="#f1f1f1" style="border-bottom: 1px solid #cccccc;"><div class="dterser">
                                      <div class="colsdets"> CHECK-IN: <?php echo date('M d,Y', strtotime($Booking->check_in)); ?>  </div>
                                      <div class="snotes"> <?php echo $cart->hotel_name.", ".$cart->city;?> </div>
                                    </div></td>
                                </tr>
                                <tr>
                                  <td width="25%" rowspan="2" style="border-right: 1px solid #cccccc;"><div class="padwithbord">
                                      <div class="htl_vchrimg"> <img src="<?php echo $images[0]; ?>" /> </div>
                                      <br />
                                      <div class="opfligt"> Room type: <strong><?php $rooms = explode('<br>', $Booking->room_type); echo $rooms[0]; ?>,<?php echo $cart->description;?></strong></div>
                                    </div></td>
                                  <td bgcolor="#FFFFFF" style="border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;"><span style="font-size:16px; font-weight:bold;">Check-in</span><br><?php echo $Booking->check_in; ?></td>
                                  <td bgcolor="#FFFFFF" style="border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;"><span style="font-size:16px; font-weight:bold;">Check-out</span><br><?php echo $Booking->check_out; ?></td>
                                  <td width="25%" rowspan="2" bgcolor="#FFFFFF"><strong>Guests</strong> <br>
                                    <br>
                                   Adult : <?php $adults = explode('<br>', $Booking->adult); echo array_sum($adults); ?>
                                   <br>
                                   Children : <?php $childs = explode('<br>', $Booking->child); echo array_sum($childs); ?></td>
                                </tr>
                                <tr>
                                  <td bgcolor="#FFFFFF" style="border-right:1px solid #cccccc;">No of night(s)<br>
                                    <span style="font-size:13px; font-weight:bold;"><?php  $diff = date_diff(date_create($Booking->check_in),date_create($Booking->check_out));    echo $sec_days = $diff->format('%a'); ?></span></td>
                                  <td bgcolor="#FFFFFF" style="border-right:1px solid #cccccc;">Room(s)<br>
                                    <span style="font-size:13px; font-weight:bold;"><?php $rooms = explode('<br>', $Booking->room_count); echo array_sum($rooms); ?></span></td>
                                </tr>
                              </tbody>
                            </table></td>
                        </tr>
                        <tr>
                          <td style="height:10px;width:100%;"></td>
                        </tr>
   

                        <tr>
                          <td style="height:10px;width:100%;"></td>
                        </tr>
  
                        <tr>
                          <td colspan="2" class="padding1"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                              <tbody>
                                <tr>
                                  <td colspan="5" class="padding1"><div class="detailhed_trvels" style="font-size: 18px; padding-bottom: 10px;">Traveller Details </div></td>
                                </tr>
                                
                                <tr style="background:#eeeeee">
                                  <th align="left" valign="top" style="padding:10px;"><strong>Pax Type</strong></th>
                                  <th align="left" valign="top" style="padding:10px;"><strong>Name</strong></th>
                                </tr>
                          <?php  for($t=0; $t<count($Passenger); $t++){ ?>
                                <tr style="background:#ffffff">
                                  <td style="padding:10px;"><?php echo $Passenger[$t]->passenger_type; ?></td>
                                  <td style="padding:10px;">
                                    <?php 
                                      echo $Passenger[$t]->gender.' '.$Passenger[$t]->first_name.' '.$Passenger[$t]->middle_name.' '.$Passenger[$t]->last_name;
                                    ?>
                                  </td>                                   
                                </tr>
                               <?php } ?>
           
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
                                    <th align="left" valign="top"><strong>Base Fare</strong></th>
                                    <th align="left" valign="top"><strong>Service Tax & Maintenance Charge</strong></th>
                                    <?php if($Booking->user_type_id ==B2C_USER):?>
                                    <th align="left" valign="top"><strong>Discount </strong></th>
                                  <?php endif;?>
                                    <th align="left" valign="top"><strong>Total Payment </strong></th>                                     
                                  </tr>

                                  <tr>
                                    
                                     <td><?=BASE_CURRENCY_ICON.($Booking->admin_baseprice)?></td>
                                    <td><?=BASE_CURRENCY_ICON.($Booking->admin_markup+$Booking->agent_markup)?></td>
                                 
                                  <?php if($Booking->user_type_id ==B2C_USER):?>
                                    <td><?=BASE_CURRENCY_ICON.($Booking->discount)?></td>
                                  <?php endif;?>

                                  <td><?=BASE_CURRENCY_ICON.$Booking->total_amount?></td>
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
                                  <td colspan="2" class="padding1"><div class="detailhed_trvels" style="font-size: 18px; padding-bottom: 10px;">Customer Details</div></td>
                                </tr>
                                <tr class="set_bordr">
                                  <td width="20%" align="left" style="background:#f1f1f1; padding: 10px;"><strong>Email ID</strong></td>
                                  <td width="80%" align="left" style="background:#ffffff; padding: 10px;"><?php echo $Booking->billing_email; ?></td>
                                </tr>
                                <tr class="set_bordr">
                                  <td align="left" style="background:#f1f1f1; padding: 10px;"><strong>Mobile Number</strong></td>
                                  <td align="left" style="background:#ffffff; padding: 10px;"><?php echo $Booking->billing_contact_number; ?></td>
                                </tr>
                                <tr class="set_bordr">
                                  <td align="left" style="background:#f1f1f1; padding: 10px;"><strong>Address</strong></td>
                                  <td align="left" style="background:#ffffff;padding: 10px;"><?php echo $Booking->billing_address.', '.$Booking->billing_city.', '.$Booking->billing_state.' - '.$Booking->billing_zip; ?></td>
                                </tr>
                              </tbody>
                            </table></td>
                        </tr>
                        <tr>
                          <td style="height:10px;width:100%;"></td>
                        </tr>
                            <tr>
                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                              <tbody>

                                <tr>
                                  <td colspan="2" class="padding1"><div class="detailhed_trvels">Cancellation Policy</div></td>
                                </tr>
                                <?php if($Booking->cancel_policy):?>
                                <tr class="set_bordr">
                                  <td width="100%" align="left" style="background:#f1f1f1"> <?php echo $Booking->cancel_policy; ?></td>
                                </tr>
                                 <?php else:?>
                                  <tr><td>This rate is non-refundable. If you cancel this booking you will not be refunded any of the payment. </td></tr>
                               <?php endif; ?>
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
                          <td align="left" valign="top" style="padding:0 10px;"><div class="paratems"> Not Available </div></td>
                        </tr>
                      </tbody>
                    </table></td>
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
