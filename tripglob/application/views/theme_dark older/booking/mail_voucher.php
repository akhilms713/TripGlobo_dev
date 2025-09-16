<?php
 
$Booking=$b_data;


// function getairlinecode($code=''){
//         $air = explode('-', $code);
//         $MarketingAirlineCode = $air[0];
//         return $MarketingAirlineCode;
//     } $request = json_decode(base64_decode($Booking->request));// echo '<pre/>';print_r($request);exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<style type="text/css">
div, p, a, li, td {
   -webkit-text-size-adjust:none;
}
#outlook a {
   padding:0;
}
html {
   width: 100%;
}
body {
   width:100% !important;
   -webkit-text-size-adjust:100%;
   -ms-text-size-adjust:100%;
   margin:0;
   padding:0;
}
.ExternalClass {
   width:100%;
}
.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
   line-height: 100%;
}
#backgroundTable {
   margin:0;
   padding:0;
   width:100% !important;
   line-height: 100% !important;
}
img {
   outline:none;
   text-decoration:none;
   border:none;
   -ms-interpolation-mode: bicubic;
}
a img {
   border:none;
}
.image_fix {
   display:block;
}
p {
   margin: 0px 0px !important;
}
table td {
   border-collapse: collapse;
}
table {
   border-collapse:collapse;
   mso-table-lspace:0pt;
   mso-table-rspace:0pt;
   font-size:14px; color:#333;
}
table[class=full] {
   width: 100%;
   clear: both;
}
 @media only screen and (max-width: 640px) {
a[href^="tel"], a[href^="sms"] {
   text-decoration: none;
   color: #33b9ff;
   pointer-events: none;
   cursor: default;
}
.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
   text-decoration: default;
   color: #33b9ff !important;
   pointer-events: auto;
   cursor: default;
}
table[class=devicewidth] {
   width: 440px!important;
   text-align:center!important;
}
table[class=devicewidth2] {
   width: 440px!important;
   text-align:center!important;
}
table[class=devicewidth3] {
   width: 400px!important;
   text-align:center!important;
}
table[class=devicewidth33] {
   width: 420px!important;
   text-align:center!important;
}
table[class=devicewidthinner] {
   width: 420px!important;
   text-align:center!important;
}
img[class=banner] {
   width: 440px!important;
   height:220px!important;
}
img[class=col2img] {
   display:block;
   margin:0 auto;
}
}
 @media only screen and (max-width: 480px) {
a[href^="tel"], a[href^="sms"] {
   text-decoration: none;
   color: #33b9ff;
   pointer-events: none;
   cursor: default;
}
.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
   text-decoration: default;
   color: #33b9ff !important;
   pointer-events: auto;
   cursor: default;
}
table[class=devicewidth] {
   width: 280px!important;
   text-align:center!important;
}
table[class=devicewidth33] {
   width: 260px!important;
   text-align:center!important;
}
table[class=devicewidth2] {
   width: 280px!important;
   text-align:center!important;
}
table[class=devicewidth3] {
   width: 240px!important;
   text-align:center!important;
}
table[class=devicewidthinner] {
   width: 260px!important;
   text-align:center!important;
}
img[class=banner] {
   width: 280px!important;
   height:140px!important;
}
img[class=col2img] {
   width: 260px!important;
   height:140px!important;
}
.social {
   display: block;
   float: none;
   margin: 0 auto;
   overflow: hidden;
   padding: 10px 0;
   text-align: center !important;
   width: 100%;
}
.social div {
}
}
</style>
</head>
<body>

<table width="100%"  cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="header">
   <tbody>
      <tr>
         <td>
            <table width="645" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%" style="border: 1px solid #dddddd;">
                        <table width="645" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <tr>
                                 <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                       <tr>
                                          <td align="left" width="100%">
                                             <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                   <td align="center">
                                                      <div class="confirmtionltr" style="text-align:center; padding:10px 0 ">Confirmation Voucher</div>
                                                   </td>
                                                </tr>
                                             </table>
                                             <table width="100%"> 
                                                <tr>
                                                   <td align="left" width="40%"><img src="https://tripglobo.com/assets/theme_dark/images/logo_transparent.png" width="165px" /></td>
                                                   <td align="right" style="font-weight:bold;">
                                                      
                                                         <td style="text-align: right;width: 42%;">
                                                            <span>Confirmation No : </span><br>  
                                                            <span>
                                                                 PNR No :
                                                             </span>
                                                         </td>
                                                         <td style="text-align: left;padding-right: 15px;">
                                                            <span> <?php echo $b_data->con_pnr_no;?> </span><br>
                                                            <span>
                                                             <?php echo $b_data->pnr_no;?>
                                                               </span>
                                                         </td>
                                                   </td>
                                                </tr>
                                             </table>
                                             <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                   <td align="left" width="100%">
                                                      <table width="100%" border="0" align="center" cellpadding="8" cellspacing="0" style=" font-family:Arial, Helvetica, sans-serif; font-size:13px;" class="tables">
                                                         <tbody>
                                                            <!-- <tr>
                                                               <td align="left"></td>
                                                               <td align="right" style="font-size:13px; line-height:20px;"></td>
                                                            </tr> -->
                                                            <tr>
                                                               <td colspan="2" style="border:0px; border-top:1px dashed #CCC;">
                                                                  <table width="100%" border="0" align="center" cellpadding="8" cellspacing="0">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td style="padding:0px" align="center">
                                                                              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                                 <tbody>
                                                                                    <tr>
                                                                                       <td width="100%" align="left" valign="top">
                                                                                          <table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF">
                                                                                             <tbody>
                                                                                               <!--  <tr>
                                                                                                   <td width="100%" bgcolor="#203f7c" style="color: #ffffff; border-bottom: 1px solid #eee;">
                                                                                                      <div class="" style="margin-top: 5px;">
                                                                                                         <table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
                                                                                                            <tbody>
                                                                                                               <tr style="font-size:12px; color:#666;">
                                                                                                                  <td width="25%" style="font-weight:bold;border-right: 1px solid #eee;">Tripglobo Confirmation No</td>
                                                                                                                  <td width="25%" style="font-weight:bold;border-right: 1px solid #eee;"><?php echo $b_data->con_pnr_no;?></td>
                                                                                                                  <td width="25%" style="font-weight:bold;border-right: 1px solid #eee;">PNR No</td>
                                                                                                                  <td width="25%" style="font-weight:bold;border-right: 1px solid #eee;"><?php echo $b_data->pnr_no;?></td>
                                                                                                               </tr>
                                                                                                            </tbody>
                                                                                                         </table>
                                                                                                      </div>
                                                                                                   </td>
                                                                                                </tr> -->
                                                                                                <tr>
                                                                                                   <td colspan="2" align="left"><strong style="font-size:18px;"> <?php echo strtoupper($Booking->leadpax);?> </strong></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                   <td colspan="2" align="left"><strong style="font-size:10px;"> Please check on your dates of travel and take quick contact with your host to discuss all the details of your arrival.</strong></td>
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
                                                                           <td style="height:20px;width:100%;"></td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #eee; padding:0px;">
                                                                              <table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
                                                                                 <tbody>
                                                                                    <tr>
                                                                                       <td colspan="2" bgcolor="#203f7c" style="color: #ffffff;border-bottom: 1px solid #eee;">
                                                                                          <div class="snotes" style="margin-top: 5px;">Booking Information</div>
                                                                                       </td>
                                                                                    </tr>
                                                                                    <tr style="font-size:12px; color:#666;">
                                                                                       <td width="50%" rowspan="2" style="border-right: 1px solid #eee;">Booking Status</td>
                                                                                       <td width="50%" bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE; vertical-align:top;"><span style="font-size:14px; color:#333; font-weight:bold; padding: 5px 0;"><?php echo $Booking->booking_status;?></span></td>
                                                                                    </tr>
                                                                                 </tbody>
                                                                              </table>
                                                                           </td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td style="height:20px;width:100%;"></td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #eee; padding:0px;">
                                                                              <table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
                                                                                 <tbody>
                                                                                    <tr>
                                                                                       <td colspan="2" bgcolor="#203f7c" style="color: #ffffff; border-bottom: 1px solid #eee;">
                                                                                          <div class="snotes" style="margin-top: 5px;">Payment Information</div>
                                                                                       </td>
                                                                                    </tr>
                                                                                    <tr style="font-size:12px; color:#666;">
                                                                                       <td width="50%" rowspan="2" style="border-right: 1px solid #eee;">Payment Transaction Id</td>
                                                                                       <td width="50%" bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE; vertical-align:top;"><span style="font-size:14px; color:#333; font-weight:bold; padding: 5px 0;"><?php echo $Booking->booking_transaction_id;?></span></td>
                                                                                    </tr>
                                                                                 </tbody>
                                                                              </table>
                                                                           </td>
                                                                        </tr>
                                                                        <?php
                                                                        
                                                                           $price_data = json_decode($b_data->PricingDetails,1);
                                                                           $count = json_decode($b_data->request_scenario,1);
                                                                        // debug($count);exit();   
                                                                           
                                                                            $adult=$ADT = $count['ADT'];
                                                                              $child=$CHD=$count['CHD'];
                                                                              $infant=$INF=$count['INF'];    
                                                                           //  if(isset($price_data[0]['PriceInfo']['PassengerFare']['CNN']['count'])){
                                                                           //  }else{
                                                                           //    $child=$CHD = 0;
                                                                           //  }
                                                                           //  if(isset($passenger['INFANT'][0])){
                                                                           //  }else{
                                                                           //    $infant=$INF=0;
                                                                           //  } 
                                                                           
                                                                           // $totalFareAmount=$price_data[0]['PriceInfo']['totalFareAmount'];
                                                                           
                                                                           
                                                                           
                                                                           ?>
                                                                        <tr>
                                                                           <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #eee; padding:0px;">
                                                                              <table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
                                                                                 <tbody>
                                                                                    <tr style="font-size:12px; color:#666;">
                                                                                       <td width="25%" style="border-right: 1px solid #eee;"><span style="font-size:12px; color:#333; font-weight:normal; padding: 5px 0;display: block;"><?php echo "No. of Adults : ".$adult;?></span></td>
                                                                                       <td width="25%" style="border-right: 1px solid #eee;"><span style="font-size:12px; color:#333; font-weight:normal; padding: 5px 0;display: block;"><?php echo "No. of Children : ".$CHD;?></span></td>
                                                                                       <td width="25%" style="border-right: 1px solid #eee;"><span style="font-size:12px; color:#333; font-weight:normal; padding: 5px 0;display: block;"><?php echo "No. of Infants : ".$INF;?></span></td>
                                                                                       <td width="25%" style="border-right: 1px solid #eee;"><span style="font-size:12px; color:#333; font-weight:normal; padding: 5px 0;display: block;"><?php echo "Price: ";?><?php echo "INR"; echo  $booking_transaction[0]->total_amount; ?></span></td>
                                                                                    </tr>
                                                                                 </tbody>
                                                                              </table>
                                                                           </td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td style="height:20px;width:100%;"></td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #eee; padding:0px;">
                                                                              <table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
                                                                                 <tbody>
                                                                                    <tr>
                                                                                       <td colspan="5" bgcolor="#203f7c" style="color: #ffffff; border-bottom: 1px solid #eee;">
                                                                                          <div class="dterser">
                                                                                             <div class="colsdets" style="float: left;">
                                                                                                <!-- <img style="float: left;margin-right: 10px;" src="http://horizontrvl.com/HorizonTravel-cust/assets/images/departure1.png" width="23" height="25">  -->
                                                                                                <div style=" display: block; float:left; margin-top: 5px;">DEPARTURE: <?php // echo date('D, d M', $this->Flight_Model->get_unixtimestamp($segment->DepartureDateTime));?></div>
                                                                                             </div>
                                                                                             <div class="snotes" style="float:right;margin-top: 5px;"> Please verify flight times prior to departure </div>
                                                                                          </div>
                                                                                       </td>
                                                                                    </tr>
                                                                                    <?php 
                                                                                       $segment_data = json_decode($b_data->segment_data,1)['Segments'];
                                                                                         // debug($segment_data);exit();
                                                                                       
                                                                                       for($s=0;$s<count($segment_data);$s++){ 
                                                                                         $arrival_count=count($segment_data[$s]['locationIdArival']);
                                                                                          $no=$arrival_count-1;
                                                                                       for($ss=0;$ss<count($segment_data[$s]);$ss++){ 
                                                                                         ?>
                                                                                    <tr style="font-size:12px; color:#666;">
                                                                                       <td width="22%" rowspan="2" style="border-right: 1px solid #eee;">
                                                                                          <div class="padwithbord">
                                                                                             <div style="padding:5px 0;" class="leftflitmg"> <img src="https://c.fareportal.com/n/common/air/ai/<?php echo $segment_data[$s][$ss]['Airline']['AirlineCode'] ; ?>.gif" />  </div>
                                                                                             <div style="padding:5px 0;" class="opfligt"> Operated by:  <?php echo $segment_data[$s][$ss]['Airline']['AirlineName'] ; ?> -  <strong> <?php echo $segment_data[$s][$ss]['Airline']['FlightNumber'] ; ?>
                                                                                                <?php echo $segment_data[$s][$ss]['Airline']['AirlineCode'] ; ?></strong></div>
                                                                                             <div style="padding:5px 0;" class="opfligt">Duration: <strong><?php echo secondstominutes($segment_data[$s][$ss]['Duration']*60); ?></strong></div>
                                                                                             <div>
                                                                                          <span style="display:block; padding:5px 0;"><strong>CabinClass:</strong> <?php
                                                                                          if ($segment_data[$s][$ss]['CabinClass']==2) {
                                                                                             echo "Economy";
                                                                                          }elseif ($segment_data[$s][$ss]['CabinClass']==3) {
                                                                                             echo'PremiumEconomy';
                                                                                          }elseif ($segment_data[$s][$ss]['CabinClass']==4) {
                                                                                             // code...
                                                                                             echo'Business';
                                                                                          }elseif ($segment_data[$s][$ss]['CabinClass']==5) {
                                                                                             // code...
                                                                                             echo'PremiumBusiness';
                                                                                          }else{

                                                                                             echo'First';
                                                                                          }
                                                                                            ?></span>
                                                                                             </div>
                                                                                          </div>
                                                                                       </td>
                                                                                       <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE; vertical-align:top;width: 37%;">
                                                                                          <span style="font-size:14px; color:#333; font-weight:bold; padding: 5px 0;display: block;"><?php echo $segment_data[$s][$ss]['Origin']['Airport']['AirportName'].'('.$segment_data[$s][$ss]['Origin']['Airport']['AirportCode'].')' ?> </span><br>

                                                                                          
                                                                                       </td>
                                                                                       <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;vertical-align:top;"><span style="font-size:14px;color:#333; font-weight:bold;display: block;padding: 5px 0;"><?php echo $segment_data[$s][$ss]['Destination']['Airport']['AirportName'].'('.$segment_data[$s][$ss]['Destination']['Airport']['AirportCode'].')' ?></span>
                                                                                          
                                                                                       </td>
                                                                                    </tr>
                                                                                    <tr colspan="5">
                                                                                       <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;vertical-align:top;padding-bottom:5px;"><span style="display:block; padding:5px 0;">Departing At:</span>
                                                                                          <span style="font-size:13px; font-weight:bold;"><?php echo date("M d,Y H:i", strtotime(str_replace('T',' ', $segment_data[$s][$ss]['Origin']['DepTime'])));  ?></span>
                                                                                       </td>
                                                                                       <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;vertical-align:top;padding-bottom:5px;"><span style="display:block; padding:5px 0;">Arriving At:</span>
                                                                                          <span style="font-size:12px; font-weight:bold;"><?php echo date("M d,Y H:i", strtotime(str_replace('T',' ', $segment_data[$s][$ss]['Destination']['ArrTime'])));  ?></span>
                                                                                       </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                       }
                                                                                       
                                                                                       }?>
                                                                                 </tbody>
                                                                              </table>
                                                                           </td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td style="height:20px;width:100%;"></td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td style="padding:0px;">
                                                                              <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                                                                                 <tbody>
                                                                                    <tr>
                                                                                       <td colspan="5" bgcolor="#203f7c" style=" color: #ffffff;border-bottom: 1px solid #eee;">
                                                                                          <div class="snotes" style="padding: 5px;font-size:18px;margin-top: 5px;">Traveller Details</div>
                                                                                       </td>
                                                                                    </tr>
                                                                                    <tr style="background:#f5f5f5">
                                                                                       <td align="left" valign="top" style="border: 1px solid #eee;padding:5px;">Sl No.</td>
                                                                                       <td align="left" valign="top" style="border: 1px solid #eee;padding:5px;">PassengerName</td>
                                                                                       <td align="left" valign="top" style="border: 1px solid #eee;padding:5px;">Passenger Type</td>
                                                                                       <td align="left" valign="top" style="border: 1px solid #eee;padding:5px;">Passenger Gender</td>
                                                                                    </tr>
                                                                                    <?php
                                                                                       $sl=0;
                                                                                         for($l=0;$l<count($Passenger);$l++)
                                                                                         {
                                                                                            $sl++;
                                                                                           ?>                                      
                                                                                    <tr style="background:#ffffff">
                                                                                       <td style="border: 1px solid #eee;padding:10px;"><?php echo $sl; ?></td>
                                                                                       <td style="border: 1px solid #eee;padding:10px;"><?php echo $Passenger[$l]->first_name;?> <?php echo $Passenger[$l]->last_name;?></td>
                                                                                       <td style="border: 1px solid #eee;padding:10px;"><?php echo $Passenger[$l]->passenger_type;?></td>
                                                                                       <td style="border: 1px solid #eee;padding:10px;"><?php echo $Passenger[$l]->gender;?></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                       }
                                                                                                                                               ?>
                                                                                 </tbody>
                                                                              </table>
                                                                           </td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </td>
                                                            </tr>
                                                            <?php // echo 'terms_conditions<pre/>';print_r($terms_conditions);exit; ?>
                                                            <tr>
                                                               <td colspan="2">
                                                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td bgcolor="#203f7c" style=" color: #ffffff;border-bottom: 1px solid #eee;">
                                                                              <div class="snotes" style="padding: 5px;font-size:18px;margin-top: 5px;">Important Information</div>
                                                                           </td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td align="left" valign="top" style="padding:10px 10px; font-size:12px; color:#666;">
                                                                              <div class="paratems">
                                                                                 <?php if(false){  }else{ echo 'No Terms & Conditions Found !'; } ?>
                                                                              </div>
                                                                           </td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td style="padding:0 28px 0 10px;">
                                                                  <table width="103%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td colspan="2" bgcolor="#203f7c" style=" color: #ffffff; border-bottom: 1px solid #eee;">
                                                                              <div class="snotes" style="padding: 5px;font-size:18px;margin-top: 5px;">ADDRES INFORMATION</div>
                                                                           </td>
                                                                        </tr>
                                                                            <tr><td width="50%" align="left" style="padding:0px"><div style="color: #666; display: block; line-height: 20px; overflow: hidden; text-align: left;font-family: Helvetica Neue, Helvetica, Arial, sans-serif;"><table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF" class="con_addr_bottom"><td colspan="2" bgcolor="#f5f5f5" style="color: #000000;border-bottom: 1px solid #eee;"><div class="snotes" style="font-size:13px;">Customer Billing Details</div>
                                                                                 </td>
                                                                                 <tr style="color:#666; line-height:23.5px;">
                                                                                 <td colspan="5" align="left" valign="top" style="border:0px; border-right:1px solid #FFF;">
                                                                                 <p style="margin:0px"><i class='fa fa-home'></i> <label>Name: <?php echo $booking_agent[0]->billing_first_name."  ".$booking_agent[0]->billing_last_name; ?></label></p>
                                                                                 <p style="margin:0px"><i class='fa fa-phone'></i> Email: <?php echo $booking_agent[0]->billing_email;?></p>
                                                                                 <p style="margin:0px"><i class='fa fa-envelope'></i> Phone: <?php echo $booking_agent[0]->billing_contact_number;?></p>
                                                                                 <p style="margin:0px"><i class='fa fa-envelope'></i> Address: <?php echo $booking_agent[0]->billing_address?>,<br />
                                                                                 <?php echo $booking_agent[0]->billing_city;?><br />
                                                                                 <?php echo $booking_agent[0]->billing_state;?><br />
                                                                                 <?php echo $booking_agent[0]->billing_zip;?></p>
                                                                                 </td>
                                                                                 </tr>
                                                                              </table>
                                                                              </div>
                                                                           </td>
                                                                           <td width="50%"  align="right" style="padding:10px 0">
                                                                              <div style="color: #666; display: block; line-height: 20px; overflow: hidden; text-align: right;float: right; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
                                                                              <table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF" class="con_addr_bottom">
                                                                                 <td colspan="2" bgcolor="#f5f5f5" style=" color: #000000; border-bottom: 1px solid #eee;">
                                                                                       <!-- <div class="snotes" style="text-align: left;font-size:13px;">Vietnet Address</div> -->
                                                                                       <div class="snotes" style="text-align: left;font-size:13px;">TripGlobo Address</div>
                                                                                 </td>
                                                                                 <tr style="color:#666; line-height:20px;">
                                                                                 <td colspan="5" align="left" valign="top" style="border:0px; border-right:1px solid #FFF;">
                                                                                 <p style="margin:0px"><i class='fa fa-home'></i> <label>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br/></label></p><br/>
                                                                                 <p style="margin:0px"><i class='fa fa-phone'></i>Phone Number:  +91 7652936188</p>
                                                                                 <p style="margin:0px"><i class='fa fa-envelope'></i> Email: contact@tripglobo.com</p>
                                                                                 <p style="margin:0px"><i class='fa fa-envelope'></i> Website :https://tripglobo.com</p><br/>
                                                                                 </td>
                                                                                 </tr>
                                                                              </table>
                                                                              </div>
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
                                             </table>
                                          </td>
                                       </tr>
                                    </table>
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
   </tbody>
</table>

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
</body>
</html>
