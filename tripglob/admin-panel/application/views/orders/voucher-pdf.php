<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <title><?php echo PROJECT_TITLE; ?> </title>
       <link rel="icon" href="https://tripglobo.com/beta1/assets/theme_dark/images/favicon.png" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo ASSETS; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/animate.min.css" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="<?php echo ASSETS; ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/icheck/flat/green.css" rel="stylesheet">
    <script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="row" >
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 style="text-align: center;">VOUCHER</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                    
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <section class="content invoice col-md-12">
               <!--                          <table class="table hide" width="100" border="0" style="width: 100%;border:0px;" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr style="width: 100%;">
                                                    
                                                <td style="width: 50%;float: left;">
                                                    <img src="<?php echo PROJECT_LOGO; ?>" width="100" >
                                                </td>
                                                <td style="width: 50%;float: right;text-align: left">
                                                    <address>
                                               <strong> <?php echo PROJECT_TITLE; ?></strong>
                                                <br>Address
                                                <br>City
                                                <br>Phone: 12312121212
                                                <br>Email: @.com
                                                </address></td>

                                                </tr>
                                            </tbody>



                                        </table> -->
                                
                                        <div class="row invoice-info ">
                                        <div class="col-xs-9 invoice-col">
                                                  <img src="<?php echo PROJECT_LOGO; ?>" width="100" >
                                            </div>
                                            <!-- <div class="col-sm-4 invoice-col"></div> -->
                                            <div class="col-xs-4 invoice-col pull-right">
                                            
                                            <address>
                                               
                                                <strong> <?php echo PROJECT_TITLE; ?></strong>
                                                <br>Address
                                                <br>City
                                                <br>Phone: 12312121212
                                                <br>Email: @.com
                                            </address>
                                            </div>
                                            
                                        </div>
                                       

                                        <!-- Table row -->
                                        <div class="row">
                                           <div class="col-xs-4 ">
                                             <p class="lead"><?php echo $orders->leadpax; ?></p>
                                            PNR No : <?php echo $orders->pnr_no; ?><br>
                                            Booking Status : <?php echo $orders->booking_status; ?><br>
                                             
                                           </div>
                                           <div class="col-xs-4">
                                            <p class="lead">&nbsp;</p>
                                            Supplier No : <?php echo $orders->booking_supplier_number; ?><br>
                                            Supplier Status : <?php echo $orders->supplier_status; ?><br>
                                           </div>
                                            <div class="col-xs-12 table">
                                                 <div class="col-md-12" style="border-bottom:1px solid #E3E3E3; padding:20px 0px;">
<div class="col-xs-12 nopad listfull">
        	<div class="rndplace">
					<?php if($orders->product_name == 'FLIGHT'){ ?>	
				<button type="button" style="margin-top:5px;margin-left:5px;" class="btn btn-success btn-xs"><?php echo $flight_data->mode; ?></button><?php echo $flight_data->origin_airport; ?>(<?php echo $flight_data->origin_city; ?>) <span class="farrow fa fa-long-arrow-right"></span> <?php echo $flight_data->destination_airport; ?>(<?php echo $flight_data->destination_city; ?>)</div>
            <div class="sidenamedesc">
            	<!-- <div class="celhtl width20 midlbord">
                   <div class="fligthsmll">
                    <img alt="" src="<?php echo $flight_data->airline_image; ?>">
                    </div>
                    <div class="airlinename"><?php echo $flight_data->airline; ?></div>
                    
                </div> -->
                
                <div class="celhtl width80">
                    <div class="waymensn">
                  <?php
				 $outward_segments =  json_decode($flight_data->outward_segments);
			 	  for($k=0;$k<count($outward_segments);$k++)
				  {
					  ?>
                        <div class="flitruo cloroutbnd">
                        	<div class="detlnavi">
                             <div class="col-xs-2 padflt widfty">
                                      <strong><?php echo $outward_segments[$k]->Operator; ?></strong>
                                </div>
                                <div class="col-xs-3 padflt widfty">
                                    <span class="timlbl"><?php echo $outward_segments[$k]->Origin; ?> <span class="tsperate"><?php echo date("H:i", strtotime($outward_segments[$k]->DepartDate)); ?></span>
                                    </span>
                                    <span class="flitrlbl elipsetool"><?php echo date("M d", strtotime($outward_segments[$k]->DepartDate)); ?> </span>
                                     Terminal :  <?php if($outward_segments[$k]->Origin_Terminal!='') { echo $outward_segments[$k]->Origin_Terminal; } else { echo '****'; }  ?>
                                 
                                </div>
                                <div class="col-xs-1 nopad padflt widfty"><span class="flicent fa fa-plane"></span></div>
                                <div class="col-xs-3 padflt widfty">
                                    <span class="timlbl"><?php echo $outward_segments[$k]->Destination; ?>  <span class="tsperate"><?php echo date("H:i", strtotime($outward_segments[$k]->ArriveDate)); ?></span></span>
                                    <span class="flitrlbl elipsetool"><?php echo date("M d", strtotime($outward_segments[$k]->ArriveDate)); ?></span>
                                    Terminal :  <?php if($outward_segments[$k]->Destination_Terminal!='') { echo $outward_segments[$k]->Destination_Terminal; } else { echo '****'; }  ?>
                                </div>
                                <div class="col-xs-3 padflt nonefity">
                                    <div class="lyovrtime">	
                                        <span class="flect"><?php echo $outward_segments[$k]->Duration; ?> | <?php echo $outward_segments[$k]->FlightId; ?></span> 
                                         <span class="flects"><?php echo $outward_segments[$k]->SupplierClass; ?>, </span>
                                          <span class="flects"><?php echo $outward_segments[$k]->TfClass; ?></span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <?php
				  }
				  ?>
                     </div>  
                </div>
                
            </div>
            <?php } 
            if($orders->product_name == 'HOTEL'){ ?>
		 <?php echo $hotel_data->hotel_name; ?>(<?php echo $hotel_data->hotel_address_full; ?>) <span class="farrow fa fa-long-arrow-right"></span> <?php echo $hotel_data->sec_city; ?></div>		 
	<?php	 }  ?> 
          
</div>
</div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">
                                            <!-- accepted payments column -->
                                              <div class="col-xs-12">
                                                <p class="lead">Travellar Details:</p>
                                            <table class="table table-bordered" cellpadding="10" cellspacing="10">
                                                        <tbody>
                                                            <tr>
                                                                <th style="padding: 10px;">Passenger</th>
                                                                <th style="padding: 10px;">Given Name </th>
                                                                <th style="padding: 10px;">Surname </th>
                                                               <?php if($orders->product_name == 'FLIGHT'){ ?> <th style="padding: 10px;">DOB</th> <?php } ?>
                                                                <th style="padding: 10px;">Gender</th>
                                                                </tr>
                                                               <?php
															   for($l=0;$l<count($passanger);$l++) 
															   {
																   ?> <tr>
                                                                   <td style="padding: 10px;"><?php echo $passanger[$l]->passenger_type; ?></td>
                                                                   <td style="padding: 10px;"><?php echo $passanger[$l]->first_name	; ?></td>
                                                                   <td style="padding: 10px;"><?php echo $passanger[$l]->last_name	; ?></td>
                                                                   <?php if($orders->product_name == 'FLIGHT'){ ?> <td style="padding: 10px;"><?php echo $passanger[$l]->dob	; ?></td><?php } ?>
                                                                   <td style="padding: 10px;"><?php echo $passanger[$l]->gender; ?></td></tr>
                                                                   <?php
															   }
															   ?>
                                                            
                                                            
                                                            
                                                        </tbody>
                                                    </table>
                                                    </div>
                                            
                                            <!-- /.col -->
                                            <div class="col-xs-8">
                                                <p class="lead">Billing Address</p>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" border="1" cellpadding="10">
                                                        <tbody>
                                                            <tr style="padding: 10px;">
                                                                <th style="width:30%;padding: 10px;">Name</th>
                                                                <td style="padding: 10px;"><?php echo $orders->billing_first_name; ?> <?php echo $orders->billing_last_name; ?></td>
                                                            </tr>
                                                            <tr style="padding: 10px;">
                                                                 <th style="width:30%;padding: 10px;">Address</th>
                                                                <td style="padding: 10px;"><?php echo $orders->billing_address; ?> <br><?php echo $orders->billing_city; ?>,
                                                                <?php echo $orders->billing_state; ?>-                                                              <?php echo $orders->billing_zip; ?></td>
                                                            </tr>
                                                            
                                                            <tr style="padding: 10px;">
                                                                <th style="width:30%;padding: 10px;">Email</th>
                                                                <td style="padding: 10px;"><?php echo $orders->billing_email; ?> </td>
                                                            </tr>
                                                              <tr>
                                                                <th style="width:30%;padding: 10px;">Phone No</th>
                                                                <td style="padding: 10px;"><?php echo $orders->billing_contact_number; ?> </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <p class="lead">Terms & Condition</p>
                                                <div class="table-responsive">
                                                    You're advised to print the Voucher in the attachment above for your convenience. You're requested to present this voucher upon your arrival at hotel front desk.<br><br>
Thank you for using <?php echo PROJECT_TITLE; ?> online booking system.
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- this row will not appear when printing -->
                                        <!-- <div class="row no-print">
                                            <div class="col-xs-12">
                                                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                            <a  href="<?php echo WEB_URL.'orders/download_pdf_voucher/'.$orders->pnr_no; ?>" >     <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button></a>
                                               <script type="text/javascript" src="<?php echo ASSETS; ?>js/jspdf.debug.js"></script>
                                            </div>
                                        </div> -->
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div></body></html>
    <script src="<?php echo ASSETS; ?>js/bootstrap.min.js"></script>

<style>
.rndplace {
    background: #E8E8E8 none repeat scroll 0 0;
    display: block;
    font-size: 14px;
    overflow: hidden;
    padding: 5px 15px;
}

.sidenamedesc {
    display: table;
    padding: 10px 0;
    width: 100%;
}

.celhtl.midlbord {
    vertical-align: middle;
}
.width20 {
    width: 20%;
}


.celhtl {
    display: table-cell;
    vertical-align: top;
}
.fligthsmll {
    display: block;
    overflow: hidden;
    text-align: center;
}
.airlinename {
    color: #666;
    display: block;
    overflow: hidden;
    text-align: center;
}
.celhtl {
    display: table-cell;
    vertical-align: top;
}

.waymensn {
    display: block;
    overflow: hidden;
}
.width80 {
    width: 80%;
}
.flitruo {
    display: block;
    overflow: hidden;
}
.detlnavi {
    display: block;
    overflow: hidden;
}
.detlnavi .widfty:first-child {
    text-align: right;
}

.timlbl {
    color: #333333;
    display: block;
    font-size: 20px;
    overflow: hidden;
}
.tsperate {
    color: #07253f;
    font-weight: 600;
}

.flitrlbl {
    color: #666;
    display: block;
    font-size: 14px;
    font-weight: 300;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.nopad {
    margin: 0;
    padding: 0;
}
.flicent.fa {
    background: #b0cdee none repeat scroll 0 0;
    border-radius: 30px;
    color: #555555;
    display: table;
    font-size: 16px;
    height: 30px;
    line-height: 30px;
    margin: 8px auto;
    text-align: center;
    width: 30px;
}


.lyovrtime {
    display: block;
    text-align: center;
    width: 100%;
}

.flect {
    color: #333333;
    display: block;
    font-size: 14px;
}
.flects::after {
    background: #fff none repeat scroll 0 0;
    color: #ddd;
    content: "";
    font-family: FontAwesome;
    font-size: 20px;
    line-height: 9px;
    position: absolute;
    right: 45%;
    top: -9px;
}
</style>
