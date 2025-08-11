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
                    <?php
                    if($accounts!='')
                     {
                    	 ?>
                    <div class="row" >
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>INVOICE - <?php echo $accounts->transaction_number; ?></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                    
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <section class="content invoice">
                                        <!-- title row -->
                                        <div class="row">
                                            <div class="col-xs-12 invoice-header">
                                                <h1>
                                        <i class="fa fa-globe"></i> Invoice.
                                        <small class="pull-right">Date: <?php echo $orders->travel_date; ?></small>
                                    </h1>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- info row -->
                                        <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">
                                                From
                                                <address>
                                                <img src="<?php echo PROJECT_LOGO; ?>" width="100" ><br>
                                        <strong> <?php echo PROJECT_TITLE; ?></strong>
                                        <br>Address
                                        <br>City
                                        <br>Phone: 12312121212
                                        <br>Email: @.com
                                    </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                To
                                                <address>
                                                <img src="<?php echo $user_info->profile_picture; ?>" width="100" ><br>
                                        <strong><?php echo $user_info->address; ?></strong>
                                        <br><?php echo $user_info->city_name; ?> <?php echo $user_info->state_name; ?>, <?php echo $user_info->zip_code; ?>
                                        <br><?php echo $user_info->country_name; ?>
                                        <br>Phone: <?php echo $user_info->mobile_phone; ?>
                                        <br>Email: <?php echo $user_info->user_email; ?>
                                    </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                <b>Invoice #<?php echo $accounts->transaction_number; ?></b>
                                                <br>
                                                <br>
                                                <b>Order ID:</b> <?php echo $orders->pnr_no; ?>
                                                <br>
                                                <b>Payment Due:</b> <?php echo $orders->voucher_date; ?>
                                                <br>
                                                <b>Account:</b> <?php echo $orders->user_email; ?>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- Table row -->
                                        <div class="row">
                                            <div class="col-xs-12 table">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Qty</th>
                                                            <th>Product</th>
                                                            <th style="width: 59%">Description</th>
                                                            <th >Passanger</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td><?php echo $product; ?></td>
                                                             <td><?php echo $product_desc; ?></td>
                                                            <td><?php echo $passanger_info; ?></td>
                                                            <td><?php echo BASE_CURRENCY_ICON; ?> <?php echo $total; ?></td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">
                                            <!-- accepted payments column -->
                                            <div class="col-xs-6 well well-sm no-shadow">
                                                <p class="lead">Payment Methods:</p>
                                                <img src="<?php echo ASSETS; ?>images/visa.png" alt="Visa">
                                                <img src="<?php echo ASSETS; ?>images/mastercard.png" alt="Mastercard">
                                                <img src="<?php echo ASSETS; ?>images/american-express.png" alt="American Express">
                                                <img src="<?php echo ASSETS; ?>images/paypal2.png" alt="Paypal">
                                                <p class="text-muted " style="margin-top: 10px;">
                                                  <?php if($orders->payment_type == 'DEPOSIT') { echo 'Payment made from deposit amount.<br>';
												  ?></p>
                                                  <table class="table">
                                                        <tbody>
                                                           
                                                            <tr>
                                                                <th>Opening Balance</th>
                                                                <td><?php echo BASE_CURRENCY_ICON; ?> <?php echo ($accounts->balance_amount+$accounts->amount); ?></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <th>Closing Balance</th>
                                                                <td><?php echo BASE_CURRENCY_ICON; ?> <?php echo ($accounts->balance_amount ); ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <?
												  
												  
												   } ?>
                                                  <?php if($orders->payment_type == 'PAYMENT') { echo 'Payment made from payment gateway'; } ?>
                                                  <?php if($orders->payment_type == 'CASHDEPOSIT') { echo 'CASH DEPOSIT'; } ?> 
                                                 
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-xs-6">
                                                <p class="lead">Amount Due <?php echo $orders->voucher_date; ?></p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width:50%">Subtotal:</th>
                                                                <td><?php echo BASE_CURRENCY_ICON; ?> <?php echo $orders->amount; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tax (0%)</th>
                                                                <td><?php echo BASE_CURRENCY_ICON; ?> 0.00</td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <th>Total:</th>
                                                                <td><?php echo BASE_CURRENCY_ICON; ?> <?php echo $orders->amount; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- this row will not appear when printing -->
                                        <div class="row no-print">
                                            <div class="col-xs-12">
                                                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                           <a  href="javascript:demoTwoPageDocument()" >     <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button></a>
                                               <script type="text/javascript" src="<?php echo ASSETS; ?>js/jspdf.debug.js"></script>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
 }
 ?>
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