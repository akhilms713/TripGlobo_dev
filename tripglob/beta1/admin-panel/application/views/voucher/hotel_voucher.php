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
<div class="container body">
        <div class="main_container">
            <?php echo $this->load->view('common/sidebar_menu'); ?>
            <?php echo $this->load->view('common/top_menu'); ?>
<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="cancel_loader"><div id="mainDiv"><div class="carttoloadr hide"><strong>Please Wait...Cancellation process is going on!!..</strong></div></div>
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
        
         <?php $images = explode(',', $cart->image); ?>
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
                          <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #000;"><table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
                              <tbody>
                                <tr>
                                  <td colspan="4" bgcolor="#f1f1f1" style="border-bottom: 1px solid #000;background-color: rgb(190, 223, 241);color: #000;padding: 10px 10px;">
                                    <div class="dterser">
                                      <div class="colsdets"> CHECK-IN: <?php echo date('M d,Y', strtotime($Booking->check_in)); ?>  </div>
                                      <div class="snotes"> <?php echo $cart->hotel_name.", ".$cart->city;?> </div>
                                    </div></td>
                                </tr>
                                <tr>
                                  <td width="25%" rowspan="2" style="border-right: 1px solid #000;padding:10px 10px;"><div class="padwithbord">
                                      <div class="htl_vchrimg"> <img src="<?php echo $images[0]; ?>" /> </div>
                                      <br />
                                      <div class="opfligt"> Room type: <strong><?php $rooms = explode('<br>', $Booking->room_type); echo $rooms[0]; ?>,<?php echo $cart->description;?></strong></div>
                                    </div></td>
                                  <td bgcolor="#FFFFFF" style="border-bottom:1px solid #000; border-right:1px solid #cccccc;padding:10px 10px;"><span style="font-size:16px; font-weight:bold;">Check-in</span><br><?php echo $Booking->check_in; ?></td>
                                  <td bgcolor="#FFFFFF" style="border-bottom:1px solid #000; border-right:1px solid #cccccc;padding:10px 10px;"><span style="font-size:16px; font-weight:bold;">Check-out</span><br><?php echo $Booking->check_out; ?></td>
                                  <td width="25%" rowspan="2" bgcolor="#FFFFFF" style="padding:10px 10px;"><strong>Guests</strong> <br>
                                    <br>
                                   Adult : <?php $adults = explode('<br>', $Booking->adult); echo array_sum($adults); ?>
                                   <br>
                                   Children : <?php $childs = explode('<br>', $Booking->child); echo array_sum($childs); ?></td>
                                </tr>
                                <tr>
                                  <td bgcolor="#FFFFFF" style="border-right:1px solid #000;padding:10px 10px;">No of night(s)<br>
                                    <span style="font-size:13px; font-weight:bold;"><?php  $diff = date_diff(date_create($Booking->check_in),date_create($Booking->check_out));    echo $sec_days = $diff->format('%a'); ?></span></td>
                                  <td bgcolor="#FFFFFF" style="border-right:1px solid #000;padding:10px 10px;">Room(s)<br>
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
                          <td class="padding1">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                              <tbody>
                                <tr>
                                  <td colspan="5" class="padding1" style="    padding: 10px 0px;" ><div class="detailhed_trvels"><strong style="color:#1f91cd;font-size:15px">Traveller Details</strong> </div></td>
                                </tr>
                                </tbody>
                              </table>
                              <table width="100%" border="1">
                                <tr style="background:#eeeeee">
                                  <th align="left" valign="top" style="background-color: rgb(190, 223, 241);color: #000;padding: 10px 10px;"><strong>Pax Type</strong></th>

                                  <th align="left" valign="top" style="background-color: rgb(190, 223, 241);color: #000;padding: 10px 10px;"><strong>Name</strong></th>
                                   
                                </tr>
                          <?php  for($t=0; $t<count($Passenger); $t++){ ?>
                                <tr style="background:#ffffff">
                                  <td style="padding: 10px 10px;"><?php echo $Passenger[$t]->passenger_type; ?></td>
                                  <td style="padding: 10px 10px;">
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
                          <td style="height:10px;width:100%;"></td>
                        </tr>

                      
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
                                              <td valign="middle" align="right"> <?=BASE_CURRENCY_ICON.($Booking->admin_baseprice)?></td>
                                          </tr>
                                          <tr>
                                              <td valign="middle" align="left">Service Tax & Maintenance Charge </td>
                                              <td>&nbsp;</td>
                                              <td valign="middle" align="right"><?=BASE_CURRENCY_ICON.($Booking->admin_markup+$Booking->agent_markup)?></td>
                                          </tr>

                                                                         
                                          
                                          <tr>
                                              <td valign="middle" align="left">Discount</td>
                                              <td>&nbsp;</td>
                                              <?php if($Booking->user_type_id ==B2C_USER):?>
                                              <td valign="middle" align="right"><?=BASE_CURRENCY_ICON.($Booking->discount)?></td>
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
                                                  <b style="font-size:14px"><?=BASE_CURRENCY_ICON.$Booking->total_amount?></b>
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
                          <td ><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl" style="    padding: 10px 0px;">
                              <tbody>
                                <tr>
                                  <td colspan="2" class="padding1" style="padding: 10px 0px;"><div class="detailhed_trvels"><strong style="color:#1f91cd;font-size:15px">Customer Details</strong></div></td>
                                </tr>
                              </tbody>
                            </table>
                            <table border="1" width="100%">
                              <tbody>
                                <tr class="set_bordr">
                                  <td width="20%" align="left" style="background-color: rgb(190, 223, 241);color: #000;padding: 10px 10px;"><strong>Email ID</strong></td>
                                  <td width="80%" align="left" style="background:#ffffff;padding: 10px 10px;"><?php echo $Booking->billing_email; ?></td>
                                </tr>
                                <tr class="set_bordr">
                                  <td align="left" style="background-color: rgb(190, 223, 241);color: #000;padding: 10px 10px;"><strong>Mobile Number</strong></td>
                                  <td align="left" style="background:#ffffff;padding: 10px 10px;"><?php echo $Booking->billing_contact_number; ?></td>
                                </tr>
                                <tr class="set_bordr">
                                  <td align="left" style="background-color: rgb(190, 223, 241);color: #000;padding: 10px 10px;"><strong>Address</strong></td>
                                  <td align="left" style="background:#ffffff;padding: 10px 10px;"><?php echo $Booking->billing_address.', '.$Booking->billing_city.', '.$Booking->billing_state.' - '.$Booking->billing_zip; ?></td>
                                </tr>
                              </tbody>
                            </table></td>
                        </tr>
                       
                        
                        <tr>
                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                              <tbody>

                              
                                <tr>
                                  <td colspan="2" class="padding1" style="font-size:16px;padding: 5px 0px;width: 95%;margin: 0 auto;"><div class="detailhed_trvels"><strong style="color:#1f91cd;font-size:15px">Cancellation Policy</strong></div></td>
                                </tr>
                                <?php if(empty($Booking->cancel_policy)==false):?>

                                <tr class="set_bordr">
                                  <td width="100%" align="left" style="background:#f1f1f1;padding: 10px;"> <?php echo $Booking->cancel_policy; ?></td>
                                </tr>
                                 <?php else:?>
                                 
                                  <tr><td width="100%" align="left" style="background:#f1f1f1;padding: 10px;">This rate is non-refundable. If you cancel this booking you will not be refunded any of the payment. </td></tr>
                               <?php endif; ?>
                              </tbody>
                            </table></td>
                        </tr>
                            <tr>
                  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
                      <tbody>
                        <tr>
                          <td style="font-size:16px;padding: 5px 0px;width: 95%;margin: 0 auto;"><div class="detailhed_trvels"><strong style="color:#1f91cd;font-size:15px">Terms & Conditions</strong> </div></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" style="padding:10px 5px;"><div class="paratems"> Not Available </div></td>
                        </tr>
                      </tbody>
                    </table></td>
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


<!-- Page Content --> 
<div class="clearfix"></div>
<?php echo $this->load->view('common/footer'); ?> 

</div>
</div>
</div>
   <script src="<?php echo ASSETS; ?>js/bootstrap.min.js"></script> 
   
  
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
