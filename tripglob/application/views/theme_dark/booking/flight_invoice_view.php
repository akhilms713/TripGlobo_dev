<?php
 // echo "<pre>"; print_r($Booking); echo "</pre>"; die();

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
</head>
<body>
<!-- Navigation --> 
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
<div class="clearfix"></div>
<div class="top80">
  <div class="full marintopcnt contentvcr" id="voucher">
    <div class="container offset-0">
      <div class="centervoucher2">
        <div class="col-md-12">
          <div class="alliconfrmt"> <a class="tooltipv iconsofvcr fa fa-print" title="Print " onclick="PrintDiv();"></a>  </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6" style="width: 50%;float: left;">
          <?php if($Booking->user_type_name == 'B2B'){
				 	
				$user_data = 	 $this->general_model->get_user_details($Booking->user_id,$Booking->user_type_id );
					?>
          <div class="agent_or_logo"> <img src="https://tripglobo.com/assets/theme_dark/images/logo_transparent.png" width="100" alt="" /> </div>
          <?php 
                    }else  {
						
                   
                ?>
          <div class="agent_or_logo" style="border-radius: 1%;display: block;height: 100px;margin: 0 0 20px;overflow: hidden;width: 323px;">
            <img src="https://tripglobo.com/assets/theme_dark/images/logo_transparent.png" width="250" alt="" ></div>
          <?php }?>
        </div>
        <div class="col-md-6" style="width: 50%;float: left;">
          <div class="vcradrss">
            <?php if($Booking->user_type_name == 'B2B'){
 
                ?>
             <div class="iconmania" style="float:right;width: 100%;text-align: right;padding-bottom: 5px;"><?php echo $user_data->user_email_id;?><br /></div>
           <!-- <div class="iconmania"><span class="fa fa-envelope"></span><a><?php echo $user_data->user_email;?></a></div>-->
            <div class="iconmania" style="float:right;width: 100%;text-align: right;padding-bottom: 5px;"><span class="fa fa-phone"></span> <?php echo $user_data->mobile_phone;?></div>
            <?php  }else{
						?>
          
               <div class="iconmania" style="float:right;width: 100%;text-align: right;padding-bottom: 5px;">Address:<br>
               <?php  echo @$admin_details->address;?> </div>
        
              <div class="iconmania" style="float:right;width: 100%;text-align: right;padding-bottom: 5px;"><span class="fa fa-envelope"></span><a> Email:<?=@$admin_details->admin_email?></a></div>
              <div class="iconmania" style="float:right;width: 100%;text-align: right;padding-bottom: 5px;"><span class="fa fa-phone"></span> Phone :<?=@$admin_details->admin_cell_phone?></div>
 
            <?php 
                   
						}?>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
          <table width="100%" border="0" align="center" cellpadding="8" cellspacing="0" style=" font-family:Arial, Helvetica, sans-serif; font-size:13px;" class="tables">
            <tbody>
              <tr>
                <td align="left"></td>
                <td align="right" style="font-size:13px; line-height:20px;"></td>
              </tr>
              <tr>
                <td colspan="2" style="border:0px; border-top:1px dashed #CCC;"><table width="900" border="0" align="center" cellpadding="8" cellspacing="0">
                    <tbody>
                      <tr>
                        <td width="100%" style="line-height:22px; text-align:center"><div class="confirmtionltr">INVOICE</div></td>
                      </tr>
                      <tr style="border: 1px solid #bcbcbc;padding: 10px 10px;">
                        <td align="center">
                          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tbody>
                              <tr>
                                <td width="50%" align="left" valign="top" class="padding1"><table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF">
                                    <tbody>
                                      <tr>
                                        <td colspan="2" align="left"><strong style="font-size:18px;"> <?php echo strtoupper($Booking->leadpax);?> </strong></td>
                                      </tr>
                                      <tr>
                                        <td width="50%" align="left">Confirmation No  :</td>
                                        <td width="50%" align="left"><strong><?php echo $Booking->con_pnr_no;?></strong></td>
                                      </tr>
                                      <tr>
                                        <td width="50%" align="left">Pnr No  :</td>
                                        <td width="50%" align="left"><strong><?php echo $Booking->pnr_no;?></strong></td>
                                      </tr>
                                      <tr>
                                        <td width="50%" align="left">Booking Status  :</td>
                                        <td width="50%" align="left"><strong><?php echo $Booking->booking_status;?></strong></td>
                                      </tr>
                                    </tbody>
                                  </table></td>
                                <td width="50%" align="right" valign="top"> Receive Payment : <?php echo date('M d,Y', strtotime($Booking->voucher_date));?></td>
                              </tr>
                            </tbody>
                          </table></td>
                      </tr>
                      <tr>
                        <td style="height:20px;width:100%;"></td>
                      </tr>
                       <tr>
                         <td colspan="5" class="padding1"><div class="detailhed_trvels">
                          <strong>Payment Details</strong></div></td>
                              </tr>
                      <tr>
                        <td>
                          <table width="100%" border="1" cellspacing="0" cellpadding="10" bgcolor="#FFFFFF" class="detailtbl">
                            <tbody>
                             
                              <tr style="background:#eeeeee">
                                <th align="left" valign="top"><strong>Flight Info </strong></th>
                                <th align="left" valign="top"><strong>Trip Type</strong></th>
                                <?php 
		  if($Booking->user_type_name == 'B2B') { ?>
							
                                <th align="left" valign="top"><strong>Net Rate </strong></th>
                                <th align="left" valign="top"><strong>Discount </strong></th>
                                <th align="left" valign="top"><strong>Base Price </strong></th>
                                <th align="left" valign="top"><strong>Tax & fees </strong></th>
                               <!--  <th align="left" valign="top"><strong>Profit </strong></th> -->
                                <?php } ?>
                                <th align="left" valign="top"><strong>Booking Amount </strong></th>
                              </tr>
                              <tr style="background:#ffffff">
                                <td><?php echo $Booking->origin_airport;?> To <?php echo $Booking->destination_airport;?></td>
                                <td><?php echo $Booking->mode;?></td>
                                <?php 
		  if($Booking->user_type_name == 'B2B') { ?>
                                <td><?php echo $Booking->admin_baseprice;?> <?php echo BASE_CURRENCY_ICON; ?></td>
                                <td><?php echo $Booking->discount;?> <?php echo BASE_CURRENCY_ICON; ?></td>
                                <?php $tota_tax_markup = ($Booking->admin_markup)+($tax->totalTaxAmount);  ?>
                                <!-- <td><?php echo $Booking->base_amount;?> <?php echo BASE_CURRENCY_ICON; ?></td> -->
                                <td><?php echo $tota_tax_markup;?> <?php echo BASE_CURRENCY_ICON; ?></td>
                                <!-- <td><?php echo $Booking->agent_markup;?> <?php echo BASE_CURRENCY_ICON; ?></td> -->
                                <?php } ?>
                                <td><?php echo BASE_CURRENCY_ICON; ?><?php echo $Booking->total_amount;?> </td>
                              </tr>
                            </tbody>
                          </table></td>
                      </tr>
                      <tr>
                        <td style="height:20px;width:100%;"></td>
                      </tr>
                      <tr>
                                <td colspan="2" class="padding1"><div class="detailhed_trvels">
                                  <strong>Customer Details</strong></div></td>
                              </tr>
                      <tr>
                        <td><table width="100%" border="1" cellspacing="0" cellpadding="10" bgcolor="#FFFFFF" class="detailtbl">
                            <tbody>
                              
                              <tr>
                                <td width="20%" align="left" style="background:#eeeeee"><strong>Email ID</strong></td>
                                <td width="80%" align="left" style="background:#ffffff"><?php echo $Booking->billing_email;?></td>
                              </tr>
                              <tr>
                                <td align="left" style="background:#eeeeee"><strong>Mobile Number</strong></td>
                                <td align="left" style="background:#ffffff"><?php echo $Booking->billing_contact_number;?></td>
                              </tr>
                              <tr>
                                <td align="left" style="background:#eeeeee"><strong>Address</strong></td>
                                <td align="left" style="background:#ffffff"><?php echo $Booking->billing_address;?>, <?php echo $Booking->billing_state;?>, <?php echo $Booking->billing_city;?>, <?php echo $Booking->billing_zip;?></td>
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
              <tr> </tr>
              <tr>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page Content --> 

<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>

<!-- Script to Activate the Carousel -->

</body>
</html>
<style>
.leftflitmg {
	max-width:70px !important
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $(".tooltipv").tooltip();
});

function PrintDiv() {    
   var voucher = document.getElementById('voucher');
   var popupWin = window.open('', '_blank', 'width=600,height=600');
   popupWin.document.open();
   popupWin.document.write('<html><head><link href="<?php echo ASSETS;?>css/bootstrap.css" rel="stylesheet" media="print"><link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" media="print"><link href="<?php echo ASSETS;?>css/bootstrap.css" rel="stylesheet" media="screen"><link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" media="screen"><style>@media print {.col-md-1,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-10,.col-md-11 {float: left;}.col-md-1 {width: 8.333333333333332%;}.col-md-2 {width: 16.666666666666664%;}.col-md-3 {width: 25%;}.col-md-4 {width: 33.33333333333333%;}.col-md-5 {width: 41.66666666666667%;}.col-md-6 {width: 50%;}.col-md-7 {width: 58.333333333333336%;}.col-md-8 {width: 66.66666666666666%;}.col-md-9 {width: 75%;}.col-md-10 {width: 83.33333333333334%;}.col-md-11 {width: 91.66666666666666%;}.col-md-12 {width: 100%;}}.tooltip, .tooltipv{display: none !important;}</style></head><body onload="window.print()">' + voucher.innerHTML + '</html>');
   popupWin.document.close();
}
</script>
