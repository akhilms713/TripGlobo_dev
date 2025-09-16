<?php
$Booking=$b_data;
// echo"<pre/>";print_r($Booking);
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
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_css'); ?>
<link href="<?php echo ASSETS; ?>css/flight_result.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>css/voucher.css" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .new_bg{
        background: #ef4823;
        color: #fff;
        padding: 5px 0px;
      }
      .destination_heading{
        padding: 8px 15px;
      }
      .flitone { padding: 7px 0px; border: 1px solid #eee;}
      .detail_section .flname { color: #ef4823; }
      .flect { color: #393a3b; }
      .flitrlbl { font-size: 13px; }
      @media print {
      .hedtowr.destination_heading{
         background-color: #1a4567 !important;
        -webkit-print-color-adjust: exact; 
      }
    }
    </style>
</head>
<body>
<?php //debug($flight_iterna);die; ?>
<!-- Navigation --> 
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
<div class="clearfix"></div>
<div class="top80">
  <div class="full marintopcnt contentvcr" id="voucher" style="background: #ddd;">
    <div class="container offset-0">
      <div class="centervoucher2" style="width: 90%">
       <!--  <div class="col-md-12">
          <div class="alliconfrmt"> <a class="tooltipv iconsofvcr fa fa-print" title="Print " onclick="PrintDiv();"></a>  </div>
        </div> -->
        <table style="margin:0 auto;background-color:#fff;margin-top:2%" width="95%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr>
                            <td width="20%" style="">      
                              <div class="col-md-6 nopad">
                                  <div class="agent_or_logo" style="    border-radius: 1%;display: block;height: auto;margin: 0 0 0px;overflow: hidden;width: 323px;"> <img src="<?=base_url()?>assets/theme_dark/images/logo.png" width="180"  /> </div> </div>
                            </td>
                            <td width="80%">
                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                        <tr>
                                            <td style="text-align:right;padding-right: 20px; " width="90%">
                                                <span>Booking</span> <strong><?php echo $Booking->booking_status;?></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px;color:#898c8d;padding-right: 20px;" width="90%" align="right">
                                                <b>Booking Date:</b>
                                                <span id="m_-4110333284589491124m_-1052083848044131799m_-6053388023728618413ctl01_BookingDay"><?=date('D' ,strtotime($Booking->voucher_date));?></span>
                                                <span id="m_-4110333284589491124m_-1052083848044131799m_-6053388023728618413ctl01_lblBookDate">, <?=date('d M Y' ,strtotime($Booking->voucher_date));?></span>
                                                <!--  <b>Booking Time:</b> -->
                                                <!-- <span id="m_-4110333284589491124m_-1052083848044131799m_-6053388023728618413ctl01_lblBookTime">21:17</span> -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>


        <div class="clearfix"></div>

 <!--          <div class="col-md-6">
            <div class="vcradrss">            
              <?php 
              ?>

              <div class="iconmania" style="float:right;width: 100%;text-align: right;"><span class="fa fa-envelope"></span><a> Email:<?=@$admin_details->admin_email?></a></div>
              <div class="iconmania" style="float:right;width: 100%;text-align: right;"><span class="fa fa-phone"></span> Phone :<?=@$admin_details->admin_cell_phone?></div>
              <?php 
                   
					//	}?>
            </div>
          </div> -->
                  <table style="margin:0 auto;background-color:#fff;font-size:14px;" width="95%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr>
                            <td style="padding:10px 25px 0px;" width="417" align="left">
                                Hi ,
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px 25px;" width="417" align="left">
                                <span id="" style="display:block">Your flight ticket for <span style="color:#18385f">
                                    <span id=""><?=$flight_iterna->origin_airport?> - <?=$flight_iterna->destination_airport?></span>
                                </span>is 
                                <?php if($Booking->booking_status=="FAILED"){ ?>
                                <span style="color: red;"><?php echo $Booking->booking_status; ?></span>
                              <?php }else{ ?>
                                
                                 <span style="color: green;"><?php echo $Booking->booking_status; ?></span>
                              <?php } ?>


                              .  Your ticket is attached along with the email.</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:14px;;padding:0px 25px;" width="417" align="left">
                                Your Booking ID is<span style="color:#18385f">
                                    <span id="m_8976427284687916203m_-1052083848044131799m_-6053388023728618413ctl01_lblBETID"><?php echo $b_data->con_pnr_no;?></span>
                                </span>. Please use it for any further communication with us.
                            </td>
                        </tr>
                    </tbody>
                </table>
          <div class="clearfix"></div>
          <div class="col-md-12">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tables">
              <tbody>
                <tr>
                  <td align="left"></td>
                  <td align="right" style="font-size:13px; line-height:20px;"></td>
                </tr>
                <tr>
                  <td colspan="2" style="border:0px; padding: 0px 0px; border-top:0px dashed #CCC;">
                    <table width="95%" border="0" align="center" cellpadding="8" cellspacing="0" style="margin:0 auto;">
                      <tbody>
                      <!--   <tr>
                          <td width="100%" style="line-height:22px; width:100%;text-align:center"><div class="confirmtionltr new_bg">CONFIRMATION LETTER</div></td>
                        </tr> -->
                        <tr>
                          <td style="padding: 5px 0px;"></td>
                        </tr>
                        <tr>
                          <td align="center" class="padding1">
                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="">
                              <tbody>
                              
                       
                         </td>
                        </tr>
                        </tr>

                              <tr>
                               <td width="100%" style="line-height:22px; text-align:left; padding: 0px 0px 20px 10px"><div class="confirmtionltr second_heading"><strong style="color:#18385f;font-size:15px">Flight Details</strong></div></td>

                             </tr>

            
                       <tr>
                          <td style="padding: 0px 5px" class="padding1">
                            <table width="100%" border="1" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                              <tbody>                              


                        <?php 
      $segment_data = json_decode($Booking->segment_data,1)['Segments'];
                        
     
 ?>
 <?php if(true){ ?>
 <?php for($s=0;$s<count($segment_data);$s++){ 
// debug($segment_data);die;
        if(is_array($segment_data[$s])){
            $arrival_count=count($segment_data[$s]->locationIdArival);
            $no=$arrival_count-1;
        ?>
                        <div class="col-xs-12 ways_one nopad">
                            <div class="inboundiv nopad">
                                <div class="hedtowr destination_heading">
                                 <?php for($ss=0;$ss<count($segment_data[$s]);$ss++){ ?>
                                     <?php echo $segment_data[$s][$ss]['Origin']['Airport']['AirportName'].'('.$segment_data[$s][$ss]['Origin']['Airport']['AirportCode'].')' ?> <span class="fa fa-exchange"></span>  <?php echo $segment_data[$s][$ss]['Destination']['Airport']['AirportName'].'('.$segment_data[$s][$ss]['Destination']['Airport']['AirportCode'].')' ?>
                                </div>
                                 <div class="flitone">
                                    <div class="col-xs-1 nopad5 width_hundred">
                                        <div class="imagesmflt">
                                            <img alt="" src="https://c.fareportal.com/n/common/air/ai/<?php echo $segment_data[$s][$ss]['Airline']['AirlineCode'] ; ?>.gif">
                                        </div>
                                      </div>
                                      <div class="col-xs-2 nopad5 width_hundred">
                                        <div class="flitsmdets" style="overflow:visible;">
                                            <?php echo $segment_data[$s][$ss]['Airline']['AirlineName'] ; ?> -  <strong> <?php echo $segment_data[$s][$ss]['Airline']['FlightNumber'] ; ?>
                                              <?php echo $segment_data[$s][$ss]['Airline']['AirlineCode'] ; ?></strong>
                                        </div>
                                    </div>
                                    <div class="col-xs-9 nopad width_hundred">
      


                      <div class="waymensn">
                        <div class="detail_section">
                          <div class="detlnavi">
                          <div class="col-xs-4 padflt widfty">
                            <span class="timlbl " style="text-align: center;">
                              <p class="flname" style="color: #18385f;font-weight: bold;display: block;"><?php echo $segment_data[$s][$ss]['Origin']['Airport']['AirportCode'] ; ?></p> 
                              <span class="fltime" style="text-align: center; font-size: 16px;"><?php// echo secondstominutes($segment_data[$s][$ss]['Duration']*60); ?></span>
                            </span>
                            <div class="clearfix"></div>
                                                        <div class="clearfix"></div>
                            <span class="flitrlbl elipsetool" style="text-align: center;"><?php echo date("M d,Y", strtotime(str_replace('T',' ', $segment_data[$s][$ss]['Origin']['DepTime'])));  ?> </span>
                          </div>
                          <div class="col-xs-4 nopad padflt widfty">
                            <div class="lyovrtime"> 
                              <span class="flect"> <span class="fa fa-clock-o"></span> <?php echo secondstominutes($segment_data[$s][$ss]['Duration']*60); ?></span>
                               <img src="<?php echo ASSETS;?>images/arrow.jpg" style="width:100px;display: block;margin: 0 auto;" >
                              <div class="termnl1">Change Clock : <?php echo $segment_data[$s]->Clock_Changes[$ss]." Hours"; ?></div>
                            </div>  
                          </div>
                        <div class="col-xs-4 padflt widfty">
                          <span class="timlbl " style="text-align: center;">
                            <p class="flname" style="color: #18385f;font-weight: bold;display: block;"><?php echo $segment_data[$s][$ss]['Destination']['Airport']['AirportCode'] ; ?> </p><span class="fltime" style="    font-size: 16px;"><?php echo date("M d,Y", strtotime(str_replace('T',' ', $segment_data[$s][$ss]['Destination']['ArrTime'])));  ?> </span> 
                            
                          </span>
                          <div class="clearfix"></div>
                                                    <div class="clearfix"></div>
                          <span class="flitrlbl elipsetool" style="text-align: center;"><?php// echo date("M d,Y", strtotime($segment_data[$s]->ArrivalDate[$ss]));  ?></span>
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
                     <?php } } ?>
 <?php } ?>
      

</tbody>
</table>



                      <tr>
   <td width="100%" valign="top" align="left" style="padding: 25px 5px;">
      <table width="100%" cellspacing="0" cellpadding="0" border="1" style="margin: 0 auto;">
         <tbody>
            <tr>
               <td>
                  <table style="font-family:Tahoma,Geneva,sans-serif;font-size:11px;padding:1% 1%;margin:0 auto;" width="95%" border="0">
                     <tbody>
                        <tr>
                           <td valign="middle" align="left">
                              <b style="font-size:15px;color:#18385f;">Fare Details</b>
                           </td>
                           <td> &nbsp;</td>
                           <td valign="middle" align="right">
                              <b style="font-size:15px;color:#18385f;">Amount (INR)</b>
                           </td>
                        </tr>
                        <tr>
                           <td valign="middle" align="left">&nbsp; </td>
                           <td>&nbsp;</td>
                           <td valign="middle" align="right">&nbsp;</td>
                        </tr>
                        <?php if($Booking->api_name == "SABRE"){ 
                          $pax_array['ADT'] = "Adult";
                          $pax_array['CNN'] = "Child";
                          $pax_array['INF'] = "Infant";
                          $segment_data1 = json_decode($Booking->segment_data, true);
                          // debug($flight_transaction);die;
                        ?>
                        <?php foreach ($segment_data1[0]['PCode'] as $key => $value) {
                        ?>
                        <tr>
                           <td valign="middle" align="left">Pax Type</td>
                           <td>&nbsp;</td>
                           <td valign="middle" align="right">
                              <?=$pax_array[$value]?>                                         
                           </td>
                        </tr>
                        <tr>
                           <td valign="middle" align="left"> No.Of Passengers</td>
                           <td> &nbsp;</td>
                           <td valign="middle" align="right"> <?=$segment_data1[0]['PQuantity'][$key]?></td>
                        </tr>
                        <tr>
                           <td valign="middle" align="left"> Base Fare</td>
                           <td> &nbsp;</td>
                           <td valign="middle" align="right"> <?=$this->display_icon?> <?=number_format(($segment_data1[0]['PQuantity'][$key] * $segment_data1[0]['PEquivFare_org'][$key] * $this->curr_val), 2)?></td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <?php 
                          $pax_array['ADT'] = "Adult";
                          $pax_array['CNN'] = "Child";
                          $pax_array['CH'] = "Child";
                          $pax_array['INF'] = "Infant";
                          // debug(json_decode($Booking->PricingDetails, true));die;
                          $PricingDetails_ama = json_decode($Booking->PricingDetails, true);
                          // debug($flight_transaction);exit();
                          foreach ($PricingDetails_ama[0]['PriceInfo']['PassengerFare'] as $key => $value) { 
                         ?>
                        <tr>
                           <td valign="middle" align="left">Pax Type</td>
                           <td>&nbsp;</td>
                           <td valign="middle" align="right">
                               <?=$pax_array[$key]?>                                            
                           </td>
                        </tr>
                        <tr>
                           <td valign="middle" align="left"> No.Of Passengers</td>
                           <td> &nbsp;</td>
                           <td valign="middle" align="right"> <?=$PricingDetails_ama[0]['PriceInfo']['PassengerFare'][$key]['count']?></td>
                        </tr>
                        <tr>
                           <td valign="middle" align="left"> Base Fare</td>
                           <td> &nbsp;</td>
                           <td valign="middle" align="right"> <?=$PricingDetails_ama['BaseFare']?></td>
                        </tr>
                        <?php } ?>
                        <?php } ?>
                         <tr>
                           <td valign="middle" align="left">Base Fare</td>
                           <td>&nbsp;</td>
                           <td valign="middle" align="right"><?=$this->display_icon?> <?=number_format(($flight_transaction->api_rate * $this->curr_val), 2)?></td>
                        </tr>
                        <tr>
                           <td valign="middle" align="left">Taxes &amp; Fees</td>
                           <td>&nbsp;</td>
                           <td valign="middle" align="right"><?=$this->display_icon?> <?=number_format(($flight_transaction->api_tax * $this->curr_val), 2)?></td>
                        </tr>
                        <tr>
                           <td valign="middle" align="left">Service Tax &amp; Maintenance Charge</td>
                           <td>&nbsp;</td>
                           <td valign="middle" align="right"><?=$this->display_icon?> <?=number_format((($flight_transaction->admin_markup + $flight_transaction->agent_markup ) * $this->curr_val), 2)?></td>
                        </tr>
                        <!-- <tr>
                           <td valign="middle" align="left">Discount</td>
                           <td>&nbsp;</td>
                           <td valign="middle" align="right"><?=$this->display_icon?> <?=number_format(($flight_transaction->discount * $this->curr_val), 2)?></td>
                        </tr> -->
                        <tr>
                           <td colspan="3" valign="middle" align="left">
                              <hr>
                           </td>
                        </tr>
                        <tr>
                           <td valign="middle" align="left">
                              <b style="font-size:14px">Total Payment</b>
                           </td>
                           <td>
                              &nbsp;
                           </td>
                           <td valign="middle" align="right">
                              <b style="font-size:14px"><?=$this->display_icon?> <?=number_format((($flight_transaction->total_amount) * $this->curr_val), 2)?></b>
                           </td>
                        </tr>
                        <tr>
                           <td colspan="3" valign="middle" align="left">
                              <hr>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>
   </td>
</tr>

                        <tr>
                          <td class="">
                            <table style="border:none" width="100%" border="1" bordercolor="#c5c5c5" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                              <tbody>
                                <tr style="border:none;">
                                  <td colspan="5" class="" style="padding:5px 0px; border:none;">
                                    <div class="detailhed_trvels second_heading" style="font-weight: bold;"><strong style="color:#18385f;font-size:15px">Traveller Details</strong> </div></td>
                                </tr>
                                <tr style="padding:5px 0px;border:none;">
                                  <td colspan="5" style="padding:5px 0px;border:none;"></td>
                                </tr>
                                <tr style="background:#f0f0f0">
                                  <th align="left" valign="top" style="border:1px solid #000;background-color: #bedff1;color: #000; -webkit-print-color-adjust: exact; padding: 10px 10px;"><strong>Passenger</strong> </th>
                                  <th align="left" valign="top" style="border:1px solid #000;background-color: #bedff1;color: #000; -webkit-print-color-adjust: exact; padding: 10px 10px;"> <strong>Name</strong> </th>
                                  <th align="left" valign="top" style="border:1px solid #000;background-color: #bedff1;color: #000; -webkit-print-color-adjust: exact; padding: 10px 10px;"><strong>Surname</strong> </th>
                                  <th align="left" valign="top" style="border:1px solid #000;background-color: #bedff1;color: #000; -webkit-print-color-adjust: exact; padding: 10px 10px;"><strong>DOB</strong> </th>
                                  <th align="left" valign="top" style="border:1px solid #000;background-color: #bedff1;color: #000; -webkit-print-color-adjust: exact; padding: 10px 10px;"><strong>Gender</strong> </th>
                                </tr>
                                <?php
		for($l=0;$l<count($Passenger);$l++)
		{
			?>
                                <tr style="background:#ffffff">
                                  <td style="border:1px solid #000;padding: 10px 5px;"><?php echo $Passenger[$l]->passenger_type;?></td>
                                  <td style="border:1px solid #000;padding: 10px 5px;"><?php echo $Passenger[$l]->first_name;?></td>
                                  <td style="border:1px solid #000;padding: 10px 5px;"><?php echo $Passenger[$l]->last_name;?></td>
                                  <td style="border:1px solid #000;padding: 10px 5px;"><?php echo $Passenger[$l]->dob;?></td>
                                  <td style="border:1px solid #000;padding: 10px 5px;"><?php echo $Passenger[$l]->gender;?></td>
                                </tr>
                                <?php	
                              }
  
		?>
                              </tbody>
                            </table></td>
                        </tr>
                       
                        <tr>
                          <td>
                            <table width="100%" style="border:none;" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                              <tbody>
                                 <tr>
                                  <td colspan="2" style="padding:5px 0px;" class=""><div class="detailhed_trvels second_heading" style="font-weight: bold;"></div></td>
                                </tr>
                                <tr>
                                  <td colspan="2" style="padding:5px 0px;" class=""><div class="detailhed_trvels second_heading" style="font-weight: bold;"><strong style="color:#18385f;font-size:15px">Customer Details</strong></div></td>
                                </tr>
                                <tr>
                                  <td colspan="2" style="padding:5px 0px;" class=""></td>
                                  
                                </tr>
                                <tr class="set_bordr new-brder">
                                  <td width="20%" align="left" style="border:1px solid #000;background-color: #bedff1;color: #000; -webkit-print-color-adjust: exact; padding: 10px 10px;">Email ID</td>
                                  <td width="80%" align="left" style="background:#ffffff; border:1px solid #000; font-size: 13px;padding: 10px 5px;"><?php echo $booking_agent[0]->billing_email;?></td>
                                </tr>
                                <tr class="set_bordr new-brder">
                                  <td align="left" style="border:1px solid #000;background-color: #bedff1;color: #000; -webkit-print-color-adjust: exact; padding: 10px 10px;">Mobile Number</td>
                                  <td align="left" style="background:#ffffff; border:1px solid #000; font-size: 13px;padding: 10px 5px;"><?php echo $booking_agent[0]->billing_contact_number;?></td>
                                </tr>
                                <tr class="set_bordr new-brder">
                                  <td align="left" style="border:1px solid #000;background-color: #bedff1;color: #000; -webkit-print-color-adjust: exact; padding: 10px 10px;">Address</td>
                                  <td align="left" style="background:#ffffff; border:1px solid #000; font-size: 13px;padding: 10px 5px;"><?php echo $booking_agent[0]->billing_address;?>, <?php echo $booking_agent[0]->billing_state;?>, <?php echo $booking_agent[0]->billing_city;?>, <?php echo $booking_agent[0]->billing_zip;?></td>
                                </tr>
                              </tbody>
                            </table></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                      <tbody>
                        <tr>
                          <td style="padding:5px  0px;"><div class="detailhed_trvels second_heading"></div></td>
                        </tr>
                        <tr>
                          <td style="padding:5px  0px;"><div class="detailhed_trvels second_heading" style="font-weight: bold"><strong style="color:#18385f;font-size:15px">Terms & Conditions</strong> </div></td>
                        </tr>
                        <tr>
                          <td style="padding:5px  0px;"><div class="detailhed_trvels second_heading"></div></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" style="padding:10px 10px; "><div class="paratems"> <?php 
                              $datatt['id'] = 17; 
                              $travel_tip = $this->db->get_where('static_pages', $datatt)->row_array();
                              echo $travel_tip['english'];
                          ?></div></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="centervoucher2" style="width: 90%">
<div class="btn-group btn-group-justified">
  <a class="btn btn-primary" title="Print " onclick="PrintDiv();">Printing of itinerery</a>
  <a class="btn btn-primary" data-toggle="modal" data-target="#myModal">Email</a>
  <a class="btn btn-primary" onclick="PrintDiv();">Save File</a>
  <a class="btn btn-primary" data-toggle="modal" data-target="#myModal1">Change Request</a>
 


</div>
</div>
</div>
</div>
</div>
</body>
</html>

  <!-- html for email send-->
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form method="post" action="<?php echo WEB_URL.'general/send_email_voucher '?>">
      <input type="hidden" name="pnr" value="<?php echo $Booking->pnr_no;?>">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send Email</h4>
      </div>
      <div class="modal-body">
        <input type="email" class="form-control" name="email" placeholder="Enter email address" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
    </form>

  </div>
</div>
  <!-- end -->
  <!-- html for Change Request -->
  <div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form method="post" action="<?php echo WEB_URL.'general/change_request '?>">
      <input type="hidden" name="pnr" value="<?php echo $Booking->pnr_no;?>">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Request</h4>
      </div>
      <div class="modal-body">
        <textarea name="change_request" class="form-control" placeholder="Describe your request......." required ></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
    </form>

  </div>
</div>
  <!-- end -->
<!-- Page Content --> 

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

<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>

<!-- Script to Activate the Carousel -->

<style>
.leftflitmg { max-width:70px !important } 
</style>



<script type="text/javascript">
$(document).ready(function() {
    $(".tooltipv").tooltip();
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
