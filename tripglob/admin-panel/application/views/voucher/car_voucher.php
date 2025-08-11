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
</head>
<body class="nav-md">
<!-- Navigation --> 
 <div class="container body">
        <div class="main_container">
<?php 
     if(!isset($mail_voucher)){ ?>
      
      <?php   echo $this->load->view('common/sidebar_menu');
        echo $this->load->view('common/top_menu'); 
     }
?>
<div class="clearfix"></div>
<?php 
     if(!isset($mail_voucher)){ ?>
<div class="cancel_loader"><div id="mainDiv"><div class="carttoloadr"><strong>Please Wait...Cancellation process is going on!!..</strong></div></div>
<?php } ?>
<?php $cart = json_decode(base64_decode($Booking->segment_data)); ?>
<?php $request_data = json_decode(base64_decode($Booking->request_data), true); ?>
<?php $city_data = $this->db->get_where('iata_airport_list', array('airport_code' => $request_data['drop_down_loc'])) -> row_array(); ?>
<?php //echo "<pre/>";print_r($request_data); ?>

 <div class="right_col" role="main" style="background: #fff;">
<div class="top80">
  <div class="full marintopcnt contentvcr" id="voucher">
    <div class="container offset-0">
      <div class="centervoucher2">
      <div class="none_print">
        <div class="col-md-12">
          <div class="alliconfrmt" style="float: right;font-size: 30px;width: 30px;margin-right: 20px;"> 
			 <a class="tooltipv iconsofvcr fa fa-print" title="Print " onclick="PrintDiv();"></a> 
			 <!--<a class="tooltipv iconsofvcr fa fa-envelope" title="Mail Voucher"></a> -->
          </div>
        </div>
        <div class="clearfix"></div>
        
         <?php $images = explode(',', $cart->car_image); ?>
        
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
            <div class="vcradrss" style="float: right;"> 
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
                          <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #cccccc;"><table width="100%" border="1" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
                              <tbody>
                                <tr>
                                  <td colspan="4"  style="border-bottom: 1px solid #000;background-color: rgb(190, 223, 241);color: #000;padding: 10px 10px;"><div class="dterser">
                                      <div class="colsdets"> PICK-UP: <?php echo date('M d,Y', strtotime(explode("(", $cart->car_pick_up_dt)[0])) ." ". $request_data['drop_down_time1']; ?>  </div>
                                      <div class="snotes">
                                          <?php 
                                              $text = '';
                                              if($cart->car_model){
                                                $text .=$cart->car_model.',';
                                              }
                                              $text .= $city_data['airport_city']."(".$city_data['airport_name'].")";
                                          ?>

                                       <?php echo $text?> </div>
                                    </div></td>
                                </tr>
                                <tr>
                                  <td width="25%" rowspan="2" style="border-right: 1px solid #000;"><div class="padwithbord">
                                      <div class="htl_vchrimg"> <img src="<?php echo $images[0]; ?>" style="width: 100%;"/> </div>
                                      <br />
                                      <div class="opfligt"> Company Name: <strong><?php $rooms = explode('<br>', $cart->company_name); echo $rooms[0]; ?>(<?php echo $cart->company_code;?>)</strong></div>
                                    </div></td>
                                  <td bgcolor="#FFFFFF" style="    padding: 5px 10px;border-bottom:1px solid #000; border-right:1px solid #000;"><span style="font-size:16px; font-weight:bold;">Pick-up</span><br> <?php echo date('M d,Y', strtotime(explode("(", $cart->car_pick_up_dt)[0]))." ".$request_data['drop_down_time1']; ?></td>
                                  <td bgcolor="#FFFFFF" style="    padding: 5px 10px;border-bottom:1px solid #000; border-right:1px solid #000;"><span style="font-size:16px; font-weight:bold;">Drop-off</span><br> <?php echo date('M d,Y', strtotime(explode("(", $cart->car_drop_off_dt)[0]))." ".$request_data['drop_down_time2']; ?></td>
                                  <td width="25%" rowspan="2" bgcolor="#FFFFFF" style="    padding: 5px 10px;"><strong>Guests</strong> <br>
                                  <?php
                                  $adults_count = 0; 
                                  $child_count = 0;
                                  // echo "<pre/>";print_r($Passenger);
                                  foreach ($Passenger as $key => $value) {
                                    if($value->passenger_type == "ADULT"){
                                      $adults_count++;
                                   }
                                   if($value->passenger_type == "CHILD"){
                                      $child_count++;
                                   }  
                                 }
                                  ?>
                                    <br>
                                   Adult : <?php echo $adults_count; ?>
                                   <?php if($child_count > 0){ ?>
                                   <br>
                                   Children : <?php echo $child_count; ?>
                                   <?php } ?>
                                   </td>
                                </tr>
                                <tr>
                                  <td bgcolor="#FFFFFF" style="border-right:1px solid #000;    padding: 5px 10px;">Duration(No of Day)<br>
                                    <span style="font-size:13px; font-weight:bold;"><?php  $diff = date_diff(date_create(explode("(", $cart->car_pick_up_dt)[0]),date_create(explode("(", $cart->car_drop_off_dt)[0]));    echo $sec_days = $diff->format('%a'); ?></span></td>
                                  <td bgcolor="#FFFFFF" style="border-right:1px solid #000;padding: 5px 10px;">Vehicle Rental Preference Type<br>
                                    <span style="font-size:13px; font-weight:bold;"><?php echo $cart->car_vehicleRentalPrefType; ?></span></td>
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
                          <td class="padding1"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl" style="">
                              <tbody>
                                <tr>
                                  <td colspan="5" class="padding1" style="    padding: 10px 0px;"><div class="detailhed_trvels"><strong style="color:#1f91cd;font-size:15px">Traveller Details </strong></div></td>
                                </tr>
                              </tbody>
                            </table>
                            <table width="100%" border="1">
                              <tbody>
                                <?php 
                                 # debug($Passenger);

                                ?>
                                <tr style="background:#eeeeee">
                                  <th align="left" valign="top"style="background-color: rgb(190, 223, 241);color: #000;padding: 10px 10px;"><strong>Traveller Name</strong></th>
                                 
                                   
                                </tr>
              <?php  for($t=0; $t<count($Passenger); $t++){ ?>
                                <tr style="background:#ffffff">
                                  <td style="    padding: 10px 10px;"><?php echo $Passenger[$t]->gender.' '.$Passenger[$t]->first_name.' '.$Passenger[$t]->middle_name.' '.$Passenger[$t]->last_name; ?></td>
                                 
                                   
                                </tr>
                               <?php } ?>
           
                              </tbody>
                            </table></td>
                        </tr>
                        <tr>
                          <td style="height:10px;width:100%;"></td>
                        </tr>
                         

                        
                      <?php 
                          $booking_transaction = $booking_transaction[0];
                          
                        ?>
                        <tr>
                        <td colspan="4" style="border:1px solid #000; padding: 10px;">
                          <table style="width: 100%; ">
 
                                          <tr>
                                          <td valign="middle" align="left">
                                              <b style="font-size:15px;color:#1f91cd">Fare Details</b>
                                          </td>
                                          <td> &nbsp;</td>
                                          <td valign="middle" align="right">
                                              <b style="font-size:15px;color:#1f91cd">Amount ($)</b>
                                          </td>
                                          </tr>

                                          <tr>
                                          <td valign="middle" align="left">&nbsp; </td>
                                          <td>&nbsp;</td>
                                          <td valign="middle" align="right">&nbsp;</td>
                                          </tr>

                                     


                                          <tr>
                                              <td valign="middle" align="left"> Base Fare</td>
                                              <td> &nbsp;</td>
                                              <td valign="middle" align="right"> <?=BASE_CURRENCY_ICON.($booking_transaction->api_rate)?></td>
                                          </tr>
                                          <tr>
                                              <td valign="middle" align="left">Service Tax & Maintenance Charge </td>
                                              <td>&nbsp;</td>
                                              <td valign="middle" align="right"><?=BASE_CURRENCY_ICON.($booking_transaction->admin_markup+$booking_transaction->agent_markup)?></td>
                                          </tr>
          
                                          
                                          <tr>
                                              <td valign="middle" align="left">Discount</td>
                                              <td>&nbsp;</td>
                                              <?php if($Booking->user_type_id ==B2C_USER):?>
                                              <td valign="middle" align="right"><?=BASE_CURRENCY_ICON.($booking_transaction->discount)?></td>
                                               <?php endif;?>
                                          </tr>

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
                                                  <b style="font-size:14px"><?=BASE_CURRENCY_ICON.$booking_transaction->total_amount?></b>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td colspan="3" valign="middle" align="left">
                                                  <hr>
                                              </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>

                          <tr>
                          <td style="height:10px;width:100%;"></td>
                        </tr>
                        <tr>
                          <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl" style="">
                              <tbody>
                                <tr>
                                  <td colspan="2" class="padding1" style="padding: 10px 0px;"><div class="detailhed_trvels"><strong style="color:#1f91cd;font-size:15px">Customer Details</strong></div></td>
                                </tr>
                              </tbody>
                            </table>
                            <table width="100%" border="1">
                              <tbody>
                                <tr class="set_bordr">
                                  <td width="20%" align="left" style="background-color: rgb(190, 223, 241);color: #000;padding: 10px 10px;"><strong>Email ID</strong></td>
                                  <td width="80%" align="left" style="background:#ffffff;padding: 5px 10px;"><?php echo $booking_agent[0]->billing_email; ?></td>
                                </tr>
                                <tr class="set_bordr">
                                  <td align="left" style="background-color: rgb(190, 223, 241);color: #000;padding: 10px 10px;"><strong>Mobile Number</strong></td>
                                  <td align="left" style="background:#ffffff;padding: 5px 10px;"><?php echo $booking_agent[0]->billing_contact_number; ?></td>
                                </tr>
                                <tr class="set_bordr">
                                  <td align="left" style="background-color: rgb(190, 223, 241);color: #000;padding: 10px 10px;"><strong>Address</strong></td>
                                  <td align="left" style="background:#ffffff;padding: 5px 10px;"><?php echo $booking_agent[0]->billing_address.', '.$booking_agent[0]->billing_city.', '.$booking_agent[0]->billing_state.' - '.$booking_agent[0]->billing_zip; ?></td>
                                </tr>
                              </tbody>
                            </table></td>
                        </tr>
                        <tr>
                          <td style="height:10px;width:100%;"></td>
                        </tr>
                                    <tr>
                  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                      <tbody>
                        <tr>
                          <td><div class="detailhed_trvels"><strong style="color:#1f91cd;font-size:15px">Terms & Conditions </strong></div></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" style="padding:10px 0px;"><div class="paratems"> Not Available </div></td>
                        </tr>
                        <tr>

                          <?php 
                          

                           $current_date = date('Y-m-d');
                           $travel_date = date('Y-m-d',strtotime(explode("(", $cart->car_pick_up_dt)[0]))
                          ?>
                          <?php if(!isset($mail_voucher)){
 ?> 
                          <?php if(!$Booking->bundle_search_id):?>

                          <?php if(($current_date < $travel_date) && ($Booking->booking_status=='CONFIRMED' || $Booking->booking_status =='CANCEL_HOLD')):?>
                              <td style="float: right;"><button data-pnr="<?php echo base64_encode($Booking->pnr_no);?>" data-con-pnr="<?php echo base64_encode($Booking->con_pnr_no);?>" class="btn btn-danger" id="cancelPnrbooking">Ticket-cancel</button></td>
                          <?php endif;?>
                        <?php endif;?>
                          <?php }?>
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
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
<?php 
  
   if(!isset($mail_voucher)){
       echo $this->load->view('common/footer');
   }

?>
  <script src="<?php echo ASSETS; ?>js/bootstrap.min.js"></script> 
</div>
</div></div>


<!-- Page Content --> 



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
            
            if(res==1){
                alert('Cancellation success');              
            }else{
              alert('Cancellation not success');
              
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
   popupWin.document.write('<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1" /><meta name="description" content=""><meta name="author" content=""><link href="<?php echo ASSETS;?>css/bootstrap.min.css" rel="stylesheet" media="screen,print"><link href="<?php echo ASSETS;?>css/temp.css" rel="stylesheet" media="screen,print"><link href="<?php echo ASSETS;?>css/voucher.css" rel="stylesheet" media="screen,print"><style>@page {size: A4;margin: 0;}@media print {html, body {width: 210mm;height: 297mm;} .none_print{display: none !important;} .tablebg{background-color: #f1f1f1 !important; -webkit-print-color-adjust: exact; }}</style></head><body onload="window.print()">' + voucher.innerHTML + '</html>');
  popupWin.document.close();
}
</script>
</body>
</html>
