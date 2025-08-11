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
    <script src="<?php echo ASSETS; ?>js/jspdf.js"></script>

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
@media print {
 .nav_menu,
 .row.no-print,.page-title{
    display: none;
 }
.x_content{
    border:1px solid #bcbcbc;
}
}
</style>

<body class="nav-md">
    <div class="container body">


        <div class="main_container">

            
  <?php echo $this->load->view('common/sidebar_menu'); ?>
          <?php echo $this->load->view('common/top_menu'); error_reporting(0); ?>

            <!-- page content -->
            <div class="right_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3></h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                     
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div> 

 
                    <div class="row" id="voucher-section">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>VOUCHER</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                    
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <section class="content invoice">
                                
                                        <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                                  <img src="<?php echo PROJECT_LOGO; ?>" width="100" >
                                            </div>
                                            <div class="col-sm-4 invoice-col"></div>
                                            <div class="col-sm-4 invoice-col" style="float:right">
                                            
                                                <address style="float: right;">
                                               
                                        <p style=""><strong> <?php echo PROJECT_TITLE; ?></strong></p>
                                       <p style="">Address</p>
                                        <p style="">City</p>
                                        <p style="">Phone: 12312121212</p>
                                        <p style="">Email: @.com</p>
                                    </address>
                                            </div>
                                            <!-- /.col -->
                                            
                                            <!-- /.col -->
                                            
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

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
			<button type="button" style="margin-top:5px;margin-left:5px;" class="btn btn-success btn-xs">
			<?php echo $flight_data->mode; ?>
        	</button><?php echo $flight_data->origin_airport; ?>(<?php echo $flight_data->origin_city; ?>) <span class="farrow fa fa-long-arrow-right"></span> <?php echo $flight_data->destination_airport; ?>(<?php echo $flight_data->destination_city; ?>)</div>
            <div class="sidenamedesc">
            	<div class="celhtl width20 midlbord">
                   <div class="fligthsmll">
                    <img alt="" src="<?php echo $flight_data->airline_image; ?>">
                    </div>
                    <div class="airlinename"><?php echo $flight_data->airline; ?></div>
                    
                </div>
                
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
     <?php } if($orders->product_name == 'HOTEL'){ ?>
		 HOTEL NAME :   <?php echo $hotel_data->hotel_name; ?>(<?php echo $hotel_data->hotel_address_full; ?>) <span class="farrow fa fa-long-arrow-right"></span> <?php echo $hotel_data->sec_city; ?></div>		 
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
                                            <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <th>Passenger</th>
                                                                <th> Name </th>
                                                                <th>Surname </th>
                                                                <th>DOB</th>
                                                                <th>Gender</th>
                                                                </tr>
                                                               <?php
															   for($l=0;$l<count($passanger);$l++) 
															   {
																   ?> <tr>
                                                                   <td><?php echo $passanger[$l]->passenger_type; ?></td>
                                                                   <td><?php echo $passanger[$l]->first_name	; ?></td>
                                                                   <td><?php echo $passanger[$l]->last_name	; ?></td>
                                                                   <td><?php echo $passanger[$l]->dob	; ?></td>
                                                                   <td><?php echo $passanger[$l]->gender; ?></td></tr>
                                                                   <?php
															   }
															   ?>
                                                            
                                                            
                                                            
                                                        </tbody>
                                                    </table>
                                                    </div>
                                            
                                            <!-- /.col -->
                                            <div class="col-xs-6">
                                                <p class="lead">Billing Address</p>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width:50%">Name</th>
                                                                <td><?php echo $orders->billing_first_name; ?> <?php echo $orders->billing_last_name; ?></td>
                                                            </tr>
                                                            <tr>
                                                                 <th style="width:50%">Address</th>
                                                                <td><?php echo $orders->billing_address; ?> <br><?php echo $orders->billing_city; ?>,
                                                                <?php echo $orders->billing_state; ?>-                                                              <?php echo $orders->billing_zip; ?></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <th style="width:50%">Email</th>
                                                                <td><?php echo $orders->billing_email; ?> </td>
                                                            </tr>
                                                              <tr>
                                                                <th style="width:50%">Phone No</th>
                                                                <td><?php echo $orders->billing_contact_number; ?> </td>
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
                                        <div class="row no-print">
                                            <div class="col-xs-12">
                                                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                            <a  href="<?php echo WEB_URL.'orders/download_pdf_voucher/'.$orders->pnr_no; ?>" >     <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button></a>
                                               <script type="text/javascript" src="<?php echo ASSETS; ?>js/jspdf.debug.js"></script>
                                            </div>
                                        </div>
                                    </section>
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
	function demoTwoPageDocument() {
	var pdf = new jsPDF('p', 'pt', 'letter')

	// source can be HTML-formatted string, or a reference
	// to an actual DOM element from which the text will be scraped.
	, source = $('#fromHTMLtestdiv')[0]

	// we support special element handlers. Register them with jQuery-style 
	// ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
	// There is no support for any other type of selectors 
	// (class, of compound) at this time.
	, specialElementHandlers = {
		// element with id of "bypass" - jQuery style selector
		'#bypassme': function(element, renderer){
			// true = "handled elsewhere, bypass text extraction"
			return true
		}
	}

	margins = {
      top: 80,
      bottom: 60,
      left: 40,
      width: 522
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.fromHTML(
    	source // HTML string or DOM elem ref.
    	, margins.left // x coord
    	, margins.top // y coord
    	, {
    		'width': margins.width // max width of content on PDF
    		, 'elementHandlers': specialElementHandlers
    	},
    	function (dispose) {
    	  // dispose: object with X, Y of the last line add to the PDF 
    	  //          this allow the insertion of new lines after html
          pdf.save('Test.pdf');
        },
    	margins
    )
}
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
