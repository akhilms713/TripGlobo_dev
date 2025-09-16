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
<link href="<?php echo ASSETS; ?>css/voucher.css" rel="stylesheet" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
  <?php 
$request_data=json_decode($request_data->search_data,1);
$hotel_data=json_decode(base64_decode($cart->hotel_details),1) ;
$carts=json_decode(base64_decode($cart->cart_hotel_data),1) ;
// debug($Booking);exit();
$Booking_code=json_decode($cart->room_code);
$cancel_policy=json_decode( json_decode(base64_decode($Booking->getRoomDetails),1)[0]['response'],1)['GetHotelRoomResult']['HotelRoomsDetails'];
// debug($Booking_code);exit();

   ?>

<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
<div class="clearfix"></div>

<div class="top80">
  <div class="full marintopcnt contentvcr" id="voucher">
    <div class="container offset-0">
      <div class="centervoucher2">
      <div class="none_print">
        <div class="col-md-12">
          <div class="alliconfrmt"> 
			 <a class="tooltipv iconsofvcr fa fa-print" title="Print " onclick="PrintDiv();"></a> 
			 <!--<a class="tooltipv iconsofvcr fa fa-envelope" title="Mail Voucher"></a> -->
          </div>
        </div>
        <div class="clearfix"></div>
        
         <?php $images = explode(',', $cart->image); ?>
        <div class="col-md-6">
          
          <div class=""><img width="300px" height="100px" src="<?=base_url()?>assets/theme_dark/images/logo.png" /></div>
          </div>
          <div class="col-md-6">
            <div class="vcradrss">
            
              <div class="iconmania"><span class="fa fa-envelope"></span><a> Email:<?=@$admin_details->admin_email?></a></div>
              <div class="iconmania"><span class="fa fa-phone"></span> Phone :<?=@$admin_details->admin_cell_phone?></div>
            </div>
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
                  <td colspan="2" style="border:0px; border-top:1px dashed #cccccc;"><table width="900" border="0" align="center" cellpadding="8" cellspacing="0">
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
                                      <div class="colsdets"> CHECK-IN: <?php echo date('M d,Y', strtotime($request_data['checkin'])); ?>  </div>
                                      <div class="snotes"> <?php echo $hotel_data['HotelName'].", ".$hotel_data['city'];?> </div>
                                    </div></td>
                                </tr>
                                <tr>
                                  <td width="25%" rowspan="2" style="border-right: 1px solid #cccccc;"><div class="padwithbord">
                                      <div class="htl_vchrimg"> <img height="200px" width="200px" src="<?php echo $hotel_data['URL']; ?>" /> </div>
                                      <br />
                                      <div class="opfligt"> Room type: <strong><?php echo json_decode($carts['RoomTypeName'])[0]; ?>,<?php echo $cart->description;?></strong></div>
                                    </div></td>
                                  <td bgcolor="#FFFFFF" style="border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;"><span style="font-size:16px; font-weight:bold;">Check-in</span><br><?php echo $request_data['checkout']; ?></td>
                                  <td bgcolor="#FFFFFF" style="border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;"><span style="font-size:16px; font-weight:bold;">Check-out</span><br><?php echo $request_data['checkin']; ?></td>
                                  <td width="25%" rowspan="2" bgcolor="#FFFFFF"><strong>Guests</strong> <br>
                                    <br>
                                   Adult : <?php echo array_sum($request_data['adult']); ?>
                                   <br>
                                   Children : <?php  echo array_sum($request_data['child']); ?></td>
                                </tr>
                                <tr>
                                  <td bgcolor="#FFFFFF" style="border-right:1px solid #cccccc;">No of night(s)<br>
                                    <span style="font-size:13px; font-weight:bold;"><?php  $diff = date_diff(date_create($request_data['checkin']),date_create($request_data['checkout']));    echo $sec_days = $diff->format('%a'); ?></span></td>
                                  <td bgcolor="#FFFFFF" style="border-right:1px solid #cccccc;">Room(s)<br>
                                    <span style="font-size:13px; font-weight:bold;"><?php echo $request_data['rooms']; ?></span></td>
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
                                  <td colspan="5" class="padding1"><div class="detailhed_trvels">Guest Details </div></td>
                                </tr>
                                <tr style="background:#eeeeee">
                                  <th align="left" valign="top"><strong>Guest Type</strong></th>
                                  <th align="left" valign="top"><strong>Name</strong></th>
                                  <th align="left" valign="top"><strong>Surname </strong></th>
                                   
                                </tr>
              <?php  for($t=0; $t<count($Passenger); $t++){ ?>
                                <tr style="background:#ffffff">
                                  <td><?php echo $Passenger[$t]->passenger_type; ?></td>
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
                                <!-- <tr class="set_bordr">
                                  <td align="left" style="background:#f1f1f1"><strong>Address</strong></td>
                                  <td align="left" style="background:#ffffff"><?php echo $Booking->billing_address.', '.$Booking->billing_city.', '.$Booking->billing_state.' - '.$Booking->billing_zip; ?></td>
                                </tr> -->
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
                                  <td width="100%" align="left" style="background:#f1f1f1"> 
                                    <?php  if (empty(json_decode($Booking->cancel_policy,1))) {
                                             echo "Non Refundable";
                                           } else {
                                             foreach(json_decode($Booking->cancel_policy,1) as $key_c =>$CancellationPolicyy){
                                                foreach( $CancellationPolicyy as $key_c => $CancellationPolicy){

                                                if ($CancellationPolicy['ChargeType'] == 2) {
                                                $ChargeType='Percentage';
                                                }elseif ($CancellationPolicy['ChargeType'] == 1) {
                                                $ChargeType='Amount';
                                                }else{
                                                $ChargeType='Nights';                                       
                                                }
                                                echo 'From now until the start date of travel '.str_replace('T', ' ', $CancellationPolicy['ToDate']).'  : '.$CancellationPolicy['Charge'] .' '.$ChargeType.' '.$CancellationPolicy['Currency'].' of expenses <br>';
                                                }
                                             }
                                        } ?>
                                  </td>
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


<!-- Page Content --> 
<div class="clearfix"></div>
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
   popupWin.document.write('<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1" /><meta name="description" content=""><meta name="author" content=""><link href="<?php echo ASSETS;?>css/bootstrap.min.css" rel="stylesheet" media="screen,print"><link href="<?php echo ASSETS;?>css/temp.css" rel="stylesheet" media="screen,print"><link href="<?php echo ASSETS;?>css/voucher.css" rel="stylesheet" media="screen,print"><style>@page {size: A4;margin: 0;}@media print {html, body {width: 210mm;height: 297mm;} .none_print{display: none !important;} .tablebg{background-color: #f1f1f1 !important; -webkit-print-color-adjust: exact; }}</style></head><body onload="window.print()">' + voucher.innerHTML + '</html>');
  popupWin.document.close();
}
</script>
</body>
</html>
