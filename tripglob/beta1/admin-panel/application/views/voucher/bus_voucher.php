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
<link href="<?php echo ASSETS; ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>css/animate.min.css" rel="stylesheet"><!-- Custom styling plus plugins -->
<link href="<?php echo ASSETS; ?>css/custom.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>css/voucher.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>css/flight_result.css" rel="stylesheet">
<script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS; ?>js/nicescroll/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS; ?>js/custom.js"></script>
<style>
  .right_col{float: right;}
  .centervoucher2 {margin: 0px;width: 100%;}
</style>
</head>
<body>
<!-- Navigation --> 
<div class="clearfix"></div>

<div class="container body" style="background: #fff;">
    <div class="main_container">
        <?php echo $this->load->view('common/sidebar_menu'); ?>
        <?php echo $this->load->view('common/top_menu'); ?>
        <div class="clearfix"></div>
        <div class="container offset-0">
      <div class="centervoucher2">
      <div class="none_print">
        <div class="col-md-10 right_col">
          <div class="alliconfrmt"> 
			     <a class="tooltipv iconsofvcr fa fa-print" title="Print " onclick="PrintDiv();"></a> <br>
			 <!--<a class="tooltipv iconsofvcr fa fa-envelope" title="Mail Voucher"></a> -->
          </div>
        <div class="clearfix"></div>
        
         <?php $images = explode(',', $cart->image); ?>
        
          <div class="col-md-6">
              <div class=""><img width="300px" height="100px" src="<?php echo ASSETS;?>images/logo.png" /></div>
          </div>

          <div class="col-md-6">
            <div class="vcradrss">
               
              Address:<br>
             <?php  echo @$admin_details->address;?> 
              <div class="iconmania"><span class="fa fa-envelope"></span><a> Email:<?=@$admin_details->admin_email?></a></div>
              <div class="iconmania"><span class="fa fa-phone"></span> Phone :<?=@$admin_details->admin_cell_phone?></div><br>
            </div>
          </div>
        
          <div class="clearfix"></div>

          <div class="col-md-12">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tables">
                 <?php print_r(json_decode($bus_datas));?>
              <tbody>
                <tr>
                  <td align="left"></td>
                  <td align="right" style="font-size:13px; line-height:20px;"></td>
                </tr>
                <tr>
                  <td colspan="2" style="border:0px; border-top:1px dashed #cccccc;"><table width="100%" border="0" align="center" cellpadding="8" cellspacing="0">
                      <tbody>
                        <tr>
                          <td width="100%" style="line-height:22px;padding: 10px 0;font-size: 18px; text-align:center"><div class="confirmtionltr">CONFIRMATION LETTER</div></td>
                        </tr>
                        <tr>
                          <td align="center" class="padding1"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                              <tbody>
                                <tr>
                                  <td width="50%" align="left" valign="top" class="padding1"><table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF">
                                      <tbody>
                                        <tr>
                                          <td colspan="2" align="left"><strong style="font-size:18px;"> <?php echo $Booking->leadpax; ?> </strong></td>
                                        </tr>
                                        <tr>
                                          <td width="50%" align="left">Confirmation No  :</td>
                                          <td width="50%" align="left"><strong><?php echo $Booking->pnr_no; ?></strong></td>
                                        </tr>
                                        <tr>
                                          <td width="50%" align="left">Booking Status  :</td>
                                          <td width="50%" align="left"><strong><?php echo $Booking->booking_status; ?></strong></td>
                                        </tr>
                                        <tr>
                                          <td width="50%" align="left">Ticket No  :</td>
                                          <td width="50%" align="left"><strong><?php echo $busData->pnr; ?></strong></td>
                                        </tr>
                                        <tr>
                                          <td width="50%" align="left">Travel Operator PNR  :</td>
                                          <td width="50%" align="left"><strong><?php echo $busData->pnr; ?></strong></td>
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
                          <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #cccccc;"><table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
                              <tbody>
                                <tr>
                                  <td colspan="4" bgcolor="#f1f1f1" style="border-bottom: 1px solid #cccccc;"><div class="dterser">
                                      <div class="colsdets"> Boarding and Droping Details: <?//php echo date('M d,Y', strtotime($cart->arrival_date)); ?>  </div>
                                      <div class="snotes"> <?php echo $busData->boarding_from.", ".$busData->dropping_at;?> </div>
                                    </div></td>
                                </tr>
                                <tr>
                                  <td width="25%" rowspan="2" style="border-right: 1px solid #cccccc;"><div class="padwithbord">
                                      <div class="htl_vchrimg"> <img src="<?php echo $images[0]; ?>" /> </div>
                                      <br />
                                      <div class="opfligt"> Bus Name: <strong><?php echo $busData->bus_name; ?></strong></div>
                                    </div></td>
                                  <td bgcolor="#FFFFFF" style="border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;"><span style="font-size:16px; font-weight:bold;">Departure</span><br></td>
                                  <td bgcolor="#FFFFFF" style="border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;"><span style="font-size:16px; font-weight:bold;">Arrival</span><br></td>
                                  <!--<td width="25%" rowspan="2" bgcolor="#FFFFFF"><strong>Guests</strong> <br>-->
                                  <!--  <br>-->
                                  <!-- Adult : <?php echo array_sum($request_data['adult']); ?>-->
                                  <!-- <br>-->
                                  <!-- Children : <?php  echo array_sum($request_data['child']); ?></td>-->
                                </tr>
                                <tr>
                                  <td bgcolor="#FFFFFF" style="border-right:1px solid #cccccc;"><?php echo date('M d,Y', strtotime($busData->departure_date)); ?>  Time <?php echo date('h:i:s', strtotime($busData->departure_date)); ?><br>
                                     <td bgcolor="#FFFFFF" style="border-right:1px solid #cccccc;"><?php echo date('M d,Y', strtotime($busData->arrival_date)); ?>  Time <?php echo date('h:i:s', strtotime($busData->arrival_date)); ?><br>
                                 </td>
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
                          <td class="padding1"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                              <tbody>
                                <tr>
                                  <td colspan="5" class="padding1"><div class="detailhed_trvels">User Details </div></td>
                                </tr>
                                <tr style="background:#eeeeee">
                                  <th align="left" valign="top"><strong>Name</strong></th>
                                  <th align="left" valign="top"><strong>Surname </strong></th>
                                   
                                </tr>
                                <?php  for($t=0; $t<count($Passenger); $t++){ ?>
                                <tr style="background:#ffffff">
                                   <td><?php echo $Passenger[$t]->first_name; ?></td>
                                  <td><?php echo $Passenger[$t]->last_name; ?></td>
                                   
                                </tr>
                               <?php } ?>
           
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
                                  <td colspan="2" class="padding1"><div class="detailhed_trvels">Customer Details</div></td>
                                </tr>
                                <tr class="set_bordr">
                                  <td width="20%" align="left" style="background:#f1f1f1"><strong>Email ID</strong></td>
                                  <td width="80%" align="left" style="background:#ffffff"><?php echo $Booking->billing_email; ?></td>
                                </tr>
                                <tr class="set_bordr">
                                  <td align="left" style="background:#f1f1f1"><strong>Mobile Number</strong></td>
                                  <td align="left" style="background:#ffffff"><?php echo $Booking->billing_contact_number; ?></td>
                                </tr>
                                <!--<tr class="set_bordr">-->
                                <!--  <td align="left" style="background:#f1f1f1"><strong>Address</strong></td>-->
                                <!--  <td align="left" style="background:#ffffff"><?php echo $Booking->billing_address.', '.$Booking->billing_city.', '.$Booking->billing_state.' - '.$Booking->billing_zip; ?></td>-->
                                <!--</tr>-->
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
                                <tr class="set_bordr">
                                  <td width="100%" align="left" style="background:#f1f1f1"> <?php echo $Booking->cancellation_status; ?></td>
                                </tr>
                                <tr class="set_bordr">
                                  <td width="100%" align="left" style="background:#f1f1f1"> <?php echo $Booking->cancel_request; ?></td>
                                </tr>
                                <tr class="set_bordr">
                                  <td width="100%" align="left" style="background:#f1f1f1"> <?php echo $Booking->cancel_response; ?></td>
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
                          <td align="left" valign="top" style="padding:0 10px;"><div class="paratems"> Not Available </div></td>
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
</div>
</div>


<!-- Page Content --> 
<div class="clearfix"></div>


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
   popupWin.document.write('<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1" /><meta name="description" content=""><meta name="author" content=""><link href="<?php echo ASSETS;?>css/bootstrap.min.css" rel="stylesheet" media="screen,print"><link href="<?php echo ASSETS;?>css/temp.css" rel="stylesheet" media="screen,print"><link href="<?php echo ASSETS;?>css/voucher.css" rel="stylesheet" media="screen,print"><style>@page {size: A4;margin: 0;}@media print {html, body {width: 210mm;height: 297mm;} .none_print{display: none !important;} .tablebg{background-color: #f1f1f1 !important; -webkit-print-color-adjust: exact; }}</style></head><body onload="window.print()">' + voucher.innerHTML + '</html>');
  popupWin.document.close();
}
</script>
</body>
</html>
