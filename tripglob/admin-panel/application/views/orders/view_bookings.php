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

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>
<style>

ul.bar_tabs > li{
        margin-left: 0px;
        border-radius: 0px 0px 0 0;
}
ul.bar_tabs > li a{
        padding: 10px 10px;
}
</style>

<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            
  <?php echo $this->load->view('common/sidebar_menu'); ?>
          <?php echo $this->load->view('common/top_menu');  ?>

            <!-- page content -->
            <div class="right_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Bookings Reports - <?php echo $orders->pnr_no; ?></h3>
                        </div>
                         <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Made From <?php echo $orders->user_name; ?>  <small><?php echo $orders->user_email; ?></small></h2>
                                  
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">

                                        <div class="profile_img">

                                            <!-- end of image cropping -->
                                            <div id="crop-avatar">
                                                <!-- Current avatar -->
                                                <div class="avatar-view" title="Change the avatar">
                                                    <img src="<?php echo $orders->profile_picture; ?>" alt="Avatar">
                                                </div>
                                     </div>
                                            <!-- end of image cropping -->

                                        </div>
                                        <h3>#<?php echo $orders->pnr_no; ?></h3>

                                        <ul class="list-unstyled user_data">
                                            <li><p class="title"><strong>Lead Pax</strong></p> <?php echo $orders->leadpax; ?> 
                                            </li>
 											<li><p class="title"><strong>Booking Status</strong></p> <?php echo $orders->booking_status; ?> 
                                            </li>
                                            <li><p class="title"><strong>Voucher Date</strong></p> <?php echo $orders->voucher_date; ?> 
                                            </li>
                                           <!--  <li><p class="title"><strong>Travel Date</strong></p> <?//php echo $orders->travel_date; ?> 
                                            </li> -->
                                            <li><p class="title"><strong>Booking IP</strong></p> <?php echo $orders->ip_address; ?> 
                                            </li>
                                             
 
                                        </ul>


<?php if($orders->pnr_no):?>     
  <a class="btn btn-primary" href="<?php echo WEB_URL; ?>reports/view_voucher/<?php echo base64_encode($orders->pnr_no); ?>/<?php echo base64_encode($orders->con_pnr_no); ?>"><i class="fa fa-download m-right-xs"></i> Voucher</a>
  <?php endif; ?>
  <?php
  if($orders->booking_status == 'CONFIRMED')
  {
	  ?>
  <a class="btn btn-primary" href="<?php echo WEB_URL; ?>orders/invoice/<?php echo $orders->pnr_no; ?>"><i class="fa fa-download m-right-xs"></i> Invoice</a>
 	 <?php
  }
  ?>
                                        <br />

                                     

                                    </div>
                                    <div class="col-md-9 col-sm-9 col-xs-12">

                                        <div class="profile_title">
                                            <div class="col-md-6">
                                                <h2>Fare Rated - Billing Amount <?php echo $orders->total_amount; ?> <?php echo BASE_CURRENCY_ICON; ?></h2>
                                            </div>
                                           
                                        </div>
                                        <!-- start of user-activity-graph -->
                                        <div id="graph_bar" style="width:100%; "></div>                                        <!-- end of user-activity-graph -->

                                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Supplier Record</a>
                                                </li>
                                                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Passanger Info</a>
                                                </li>
                                                <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Billing Address</a>
                                                </li>
                                                 <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Payments</a>
                                                </li>
                                                 <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Promo Information</a>
                                                </li>
                                            </ul>
                                            <div id="myTabContent" class="tab-content">
                                          
                                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
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

                         <div class="clearfix"></div>    <div class="col-md-12" style="  padding:20px 0px;">           
<div class="col-md-6" >
                                                    <!-- start recent activity -->
                                                    <div class="project_detail">
                                                    <p class="title">Supplier Name</p>
                                                    <p><?php echo $orders->api_name; ?></p>
                                                    <p class="title">Supplier Status</p>
                                                    <p><?php echo $orders->supplier_status; ?></p>
                                                     <p class="title">Supplier No</p>
                                                    <p><?php echo $orders->booking_supplier_number; ?></p>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- start recent activity -->
                                                    <div class="project_detail">

                                                    <p class="title">Booking Timestamp</p>
                                                    <p><?php echo date('d M, Y - h:i A', strtotime($orders->supplier_timestamp)); ?></p>
                                                    <p class="title hide">Booking Logs</p>
                                                  
                                                   <ul class="list-unstyled project_files hide">
                                                   
                                                    <li >
                                                    <?php if($orders->prebook_xml_request!='') { ?>
                                                    <a download href="<?php echo WEB_FRONT_URL.$orders->prebook_xml_response; ?>"  style="color:#01B400"><i class="fa fa-file-code-o"></i>ProcessDetails Response.xml <i class="fa fa-download"></i></a> |  <a href="<?php echo WEB_FRONT_URL.$orders->prebook_xml_request; ?>">Request <i class="fa fa-download"></i></a>
                                                    <?php } else { ?>
                                                    <a download href="<?php echo WEB_FRONT_URL.$orders->prebook_xml_response; ?>"  style="color:#E8282B"><i class="fa fa-file-code-o"></i>ProcessDetails Response.xml <i class="fa fa-download"></i></a> |  <a href="<?php echo WEB_FRONT_URL.$orders->prebook_xml_request; ?>">Request <i class="fa fa-download"></i></a>
                                                     <?php } ?>
                                                    </li>
                                                    
                                                       <li >
                                                    <?php if($orders->ProcessTermsRequest!='') { ?>
                                                    <a download href="<?php echo WEB_FRONT_URL.$orders->ProcessTermsResponse; ?>"  style="color:#01B400"><i class="fa fa-file-code-o"></i>ProcessTerms Response.xml <i class="fa fa-download"></i></a> |  <a href="<?php echo WEB_FRONT_URL.$orders->ProcessTermsRequest; ?>">Request <i class="fa fa-download"></i></a>
                                                    <?php } else { ?>
                                                    <a download href="<?php echo WEB_FRONT_URL.$orders->ProcessTermsResponse; ?>"  style="color:#E8282B"><i class="fa fa-file-code-o"></i>ProcessTerms Response.xml <i class="fa fa-download"></i></a> |  <a href="<?php echo WEB_FRONT_URL.$orders->ProcessTermsRequest; ?>">Request <i class="fa fa-download"></i></a>
                                                     <?php } ?>
                                                    </li>
                                                    
                                                      <li >
                                                    <?php if($orders->StartBookingFlightRequest!='') { ?>
                                                    <a download href="<?php echo WEB_FRONT_URL.$orders->StartBookingFlightResponse; ?>"  style="color:#01B400"><i class="fa fa-file-code-o"></i>StartBooking Response.xml <i class="fa fa-download"></i></a> |  <a href="<?php echo WEB_FRONT_URL.$orders->StartBookingFlightRequest; ?>">Request <i class="fa fa-download"></i></a>
                                                    <?php } else { ?>
                                                    <a download href="<?php echo WEB_FRONT_URL.$orders->StartBookingFlightResponse; ?>"  style="color:#E8282B"><i class="fa fa-file-code-o"></i>StartBooking Response.xml <i class="fa fa-download"></i></a> |  <a href="<?php echo WEB_FRONT_URL.$orders->StartBookingFlightRequest; ?>">Request <i class="fa fa-download"></i></a>
                                                     <?php } ?>
                                                    </li>
                                                     
                                                     
                                                       <li >
                                                    <?php if($orders->CheckBookingFlightRequest!='') { ?>
                                                    <a download href="<?php echo WEB_FRONT_URL.$orders->CheckBookingFlightResponse; ?>"  style="color:#01B400"><i class="fa fa-file-code-o"></i>CheckBooking Response.xml <i class="fa fa-download"></i></a> |  <a href="<?php echo WEB_FRONT_URL.$orders->CheckBookingFlightRequest; ?>">Request <i class="fa fa-download"></i></a>
                                                    <?php } else { ?>
                                                    <a download href="<?php echo WEB_FRONT_URL.$orders->CheckBookingFlightResponse; ?>"  style="color:#E8282B"><i class="fa fa-file-code-o"></i>CheckBooking Response.xml <i class="fa fa-download"></i></a> |  <a href="<?php echo WEB_FRONT_URL.$orders->CheckBookingFlightRequest; ?>">Request <i class="fa fa-download"></i></a>
                                                     <?php } ?>
                                                    </li>
                                                </ul>
                                                </div>
                                                </div>
                                                    <!-- end recent activity -->
</div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                                                    <!-- start user projects -->
                                                    <table class="data table table-striped no-margin">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Passanger</th>
                                                                <th>First Name</th>
                                                                <th>Last Name</th>
                                                                <th>DOB</th>
                                                                 <th>Gender</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                            <?php
															for($k=0;$k<count($passanger);$k++)
															{
																?>
                                                            
                                                            <tr>
                                                                <td><?php echo $k+1; ?></td>
                                                                <td><?php echo $passanger[$k]->passenger_type; ?></td>
                                                                
                                                                <td><?php echo $passanger[$k]->first_name; ?></td>
                                                                 <td><?php echo $passanger[$k]->last_name; ?></td>
                                                                  <td><?php echo $passanger[$k]->dob; ?></td>
                                                                  <td><?php echo $passanger[$k]->gender; ?></td>
                                                               
                                                            </tr>
                                                            <?php
															}
															?>
                                                        </tbody>
                                                    </table>
                                                    <!-- end user projects -->

                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                                
                                                 <div class="col-md-12">
                                            <ul class="list-unstyled user_data">
                                            <li><h5><?php echo $orders->billing_first_name; ?> <?php echo $orders->billing_last_name; ?> </h5>
                                            </li>
                                            <li><i class="fa fa-map-marker"></i> <?php echo $orders->billing_address; ?> <br>
                                             <?php echo $orders->billing_city; ?> <br>
                                               <?php echo $orders->billing_state; ?> <br>
                                                 <?php echo $orders->billing_zip; ?> <br>
                                            </li>

                                             
                                             
                                        </ul>
                                        </div> <div class="col-md-12"><ul class="list-unstyled user_data">
                                           
                                            <li>
                                                <i class="fa fa-phone user-profile-icon"></i> 
												<?php echo $orders->billing_contact_number; ?>    </li>
                                            <li class="m-top-xs">
                                                <i class="fa fa-envelope user-phone-icon"></i>
                                                                           <?php echo $orders->billing_email; ?>                 </li>
                                             
                                        </ul>
                                        </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">

                                                    <!-- start user projects -->
                                                    <table class="data table table-striped no-margin">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Payment Mode</th>
                                                                <th>Transaction No</th>
                                                                <th>Payment Status</th>
                                                                <th>Amount</th>
                                                                 <th>Timestamp</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                          
                                                            
                                                            <tr>
                                                                <td><?php echo  $orders->payment_id; ?></td>
                                                                <td><?php echo $orders->payment_type; ?></td>
                                                                  <td><?php echo ($orders->payment_type == "DEPOSIT") ? $orders->payment_id : $orders->payment_gateway_id; ?></td>
                                                                    <td><?php echo ($orders->payment_type == "DEPOSIT") ? "PAID" : $orders->payment_status; ?></td>
                                                                      <td><?php echo $orders->amount; ?></td>
                                                                      
                                                                
                                                                <td><?php echo date('d M, Y - h:i A', strtotime($orders->payment_timestamp)); ?></td>
                                                             
                                                               
                                                            </tr>
                                                           
                                                        </tbody>
                                                    </table>
                                                    <!-- end user projects -->

                                                </div>
                                            <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">

											<?php	if(isset($transactions) && isset($promo_info)) { ?>
													<table class="data table table-striped no-margin">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Promo_code</th>
                                                                <th>Promo_type</th>
                                                                <th>Discount</th>
                                                                <th>Before Discount</th>
                                                                 <th>Afer Discount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                          
                                                            
                                                            <tr>
                                                                <td><?php echo  1; ?></td>
                                                                <td><?php echo $promo_info->promo_code; ?></td>
                                                                  <td><?php echo $promo_info->promo_type; ?></td>
                                                                    <td><?php echo $promo_info->discount; ?></td>
                                                                      <td><?php echo $transactions->net_rate; ?></td>
                                                                      
                                                                
                                                                <td><?php echo $transactions->base_amount; ?></td>
                                                             
                                                               
                                                            </tr>
                                                           
                                                        </tbody>
                                                    </table>
                                                    <?php	} else {
                                                    ?>
                                                    Promo Code not Applicable!  <?php } ?>
											</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

               <!-- footer content -->
               <?php echo $this->load->view('common/footer'); ?>  
               <!-- /footer content -->

            </div>
            <!-- /page content -->
        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="<?php echo ASSETS; ?>js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="<?php echo ASSETS; ?>js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?php echo ASSETS; ?>js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo ASSETS; ?>js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?php echo ASSETS; ?>js/icheck/icheck.min.js"></script>

    <script src="<?php echo ASSETS; ?>js/custom.js"></script>

    <!-- image cropping -->
    <script src="<?php echo ASSETS; ?>js/cropping/cropper.min.js"></script>
    <script src="<?php echo ASSETS; ?>js/cropping/main.js"></script>

    
    <!-- daterangepicker -->
    <script type="<?php echo ASSETS; ?>text/javascript" src="js/moment.min.js"></script>
    <script type="<?php echo ASSETS; ?>text/javascript" src="js/datepicker/daterangepicker.js"></script>
    <!-- moris js -->
    <script src="<?php echo ASSETS; ?>js/moris/raphael-min.js"></script>
    <script src="<?php echo ASSETS; ?>js/moris/morris.js"></script>
    <script>
        $(function () {
            var day_data = [
                {
                    "period": "Net Rate",
                    "Cost in <?php echo BASE_CURRENCY_ICON; ?>": <?php echo $orders->net_rate; ?>
                },
                {
                    "period": "Ad Markup",
                    "Cost in <?php echo BASE_CURRENCY_ICON; ?>": <?php echo $orders->admin_markup; ?>
                },
                {
                    "period": "Ag Markup",
                    "Cost in <?php echo BASE_CURRENCY_ICON; ?>": <?php echo $orders->agent_markup; ?>
                },
                {
                    "period": "Base Fare",
                    "Cost in <?php echo BASE_CURRENCY_ICON; ?>": <?php echo $orders->base_amount; ?>
                },
                {
                    "period": "Discount",
                    "Cost in <?php echo BASE_CURRENCY_ICON; ?>": <?php echo $orders->discount; ?>
                },
                {
                    "period": "Total Amout",
                    "Cost in <?php echo BASE_CURRENCY_ICON; ?>": <?php echo $orders->total_amount; ?>
                }
    ];
            Morris.Bar({
                element: 'graph_bar',
                data: day_data,
                xkey: 'period',
                hideHover: 'auto',
                barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                ykeys: ['Cost in <?php echo BASE_CURRENCY_ICON; ?>', 'sorned'],
                labels: ['Cost in <?php echo BASE_CURRENCY_ICON; ?>', ''],
                xLabelAngle: 60
            });
        });
    </script>
    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
            }

            var optionSet1 = {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Clear',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            };
            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
            $('#reportrange').daterangepicker(optionSet1, cb);
            $('#reportrange').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#reportrange').on('hide.daterangepicker', function () {
                console.log("hide event fired");
            });
            $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
            });
            $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
                console.log("cancel event fired");
            });
            $('#options1').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
            });
            $('#options2').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
            });
            $('#destroy').click(function () {
                $('#reportrange').data('daterangepicker').remove();
            });
        });
    </script>
    <!-- /datepicker -->
</body>

</html><style>
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
