 <!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo PROJECT_TITLE; ?> </title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo ASSETS; ?>css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo ASSETS; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo ASSETS; ?>css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="<?php echo ASSETS; ?>css/icheck/flat/green.css" rel="stylesheet" />
    <link href="<?php echo ASSETS; ?>css/floatexamples.css" rel="stylesheet" type="text/css" />


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
          <?php echo $this->load->view('common/top_menu'); ?>

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <br />
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="dashboard_graph x_panel">
                                <div class="row x_title">
                                    <div class="col-md-6">
                                        <h3>Overall Sales<small></small></h3>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                                <div class="x_content">
                                    <div class="demo-container" style="height:250px">
                                        <div id="placeholder3xx3" class="demo-placeholder" style="width: 100%; height:250px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12 widget_tally_box">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Sales</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                              <li><a href="#">Overall</a></li> <li><a href="#">B2C</a></li></li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
								<?php echo $this->load->view('dashboard/graph/sales'); ?>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="x_panel fixed_height_320">
                                <div class="x_title">
                                    <h2>Booking Reports  </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                         
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-pencil"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a id="overall_booking_reports"  data-val="all">Overall</a>
                                                </li>
                                                <li><a id="overall_booking_reports"  data-val="B2C">B2C</a>
                                                </li>
                                            </ul>
                                        </li>
                                        	
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content"  id="overall_p">
									<?php echo $this->load->view('dashboard/graph/overall_booking_reports'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="x_panel fixed_height_320">
                                <div class="x_title">
                                    <h2>Overall Users <small></small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                       
                                        <li class="dropdown">
                                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-pencil"></i></a>
                                             <ul class="dropdown-menu" role="menu">
                                                <li><a id="overall_users"  data-val="all">Overall</a>
                                                </li>
                                                <li><a id="overall_users"  data-val="ACTIVE">Active</a>
                                                </li>
                                                <li><a id="overall_users"  data-val="INACTIVE">In Active</a>
                                                </li>
                                                <!-- <li><a id="overall_users"  data-val="PENDING">Pending</a>
                                                </li> -->
                                            </ul>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content" id="overall_u">
									<?php echo $this->load->view('dashboard/graph/overall_users'); ?>
                                </div>
                            </div>
                        </div>


                        <!-- <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="x_panel fixed_height_320">
                                <div class="x_title">
                                    <h2>Profits / Sales <small>Product Based</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                         
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-pencil"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a id="profit_sales"  data-val="all">Overall</a>
                                                </li>
                                                <li><a id="profit_sales"  data-val="B2C">B2C</a>
                                                </li>
                                            </ul>
                                        </li>
                                        	
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content" id="overall_ps">
                                <?php echo $this->load->view('dashboard/graph/profit_sales'); ?>
                                    
                                </div>
                            </div>
                        </div> -->

                        

                        <!-- start of weather widget -->
                        
                        <!-- end of weather widget -->


                        <!-- <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="x_panel fixed_height_320">
                                <div class="x_title">
                                    <h2>Profit / Sales <small>in <?php echo BASE_CURRENCY_ICON; ?></small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                       <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="dashboard-widget-content">
                                        <ul class="quick-list">
                                        <li><i class="fa fa-area-chart"></i><a href="#">Overall</a>
                                            </li>
                                            <li><i class="fa fa-bar-chart"></i><a href="#">B2C</a> </li>
                                            </li>
                                        </ul>

                                        <div class="sidebar-widget">
                                            <h4>Markup Completion</h4>
                                            <canvas width="150" height="80" id="foo2" class="" style="width: 160px; height: 100px;"></canvas>
                                            <div class="goal-wrapper">
                                                <span class="gauge-value pull-left"><?php echo BASE_CURRENCY_ICON; ?></span>
                                                <span id="gauge-text2" class="gauge-value pull-left">3,200</span>
                                                <span id="goal-text2" class="goal-value pull-right"><?php echo BASE_CURRENCY_ICON; ?>9,000</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

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
    <!-- gauge js -->
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/gauge/gauge.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/gauge/gauge_demo.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/moment.min2.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/datepicker/daterangepicker.js"></script>
    <!-- sparkline -->
    <script src="<?php echo ASSETS; ?>js/sparkline/jquery.sparkline.min.js"></script>

    <script src="<?php echo ASSETS; ?>js/custom.js"></script>
    <!-- skycons -->
    <script src="<?php echo ASSETS; ?>js/skycons/skycons.js"></script>

    <!-- flot js -->
    <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/jquery.flot.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/jquery.flot.time.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/date.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/jquery.flot.spline.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/jquery.flot.stack.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/curvedLines.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/jquery.flot.resize.js"></script>

    <!-- flot -->

    <script>
	 $(document).on('click','#overall_users',function(){

          
                    var id = $(this).attr("data-val");
                    $.ajax({
                        type:"POST",
                        url:"<?php echo WEB_URL; ?>home/overall_users",
                        data:{status : id},
						beforeSend: function(){
							$("#overall_u").html('<img src="<?php echo ASSETS; ?>images/loader1.gif">');
						},

                        success: function(response){
                           $("#overall_u").html(response);
                        }
                    });

                

            });  
	 $(document).on('click','#overall_booking_reports',function(){

          
                    var id = $(this).attr("data-val");
                    $.ajax({
                        type:"POST",
                        url:"<?php echo WEB_URL; ?>home/overall_booking_reports",
                        data:{user_type : id},
						beforeSend: function(){
							$("#overall_p").html('<img src="<?php echo ASSETS; ?>images/loader1.gif">');
						},

                        success: function(response){
                           $("#overall_p").html(response);
                        }
                    });

                

            });  
        //random data
        var d1 = [
       				[moment().subtract(24, 'month').valueOf(), 100],
					[moment().subtract(10, 'month').valueOf(), 450],
					[moment().subtract(9, 'month').valueOf(), 800],
					[moment().subtract(8, 'month').valueOf(), 400],
					[moment().subtract(7, 'month').valueOf(), 2100],
					[moment().subtract(6, 'month').valueOf(), 2440],
					[moment().subtract(5, 'month').valueOf(), 3500],
					[moment().subtract(4, 'month').valueOf(), 2800],
					[moment().subtract(3, 'month').valueOf(), 2500],
					[moment().subtract(2, 'month').valueOf(), 1000],
					[moment().subtract(1, 'month').valueOf(), 500],
					[moment().valueOf(), 1000]
    ];
        var d2 = [
       				[moment().subtract(24, 'month').valueOf(), 200],
					[moment().subtract(10, 'month').valueOf(), 470],
					[moment().subtract(9, 'month').valueOf(), 870],
					[moment().subtract(8, 'month').valueOf(), 470],
					[moment().subtract(7, 'month').valueOf(), 2700],
					[moment().subtract(6, 'month').valueOf(), 2440],
					[moment().subtract(5, 'month').valueOf(), 3200],
					[moment().subtract(4, 'month').valueOf(), 2800],
					[moment().subtract(3, 'month').valueOf(), 2600],
					[moment().subtract(2, 'month').valueOf(), 1200],
					[moment().subtract(1, 'month').valueOf(), 1700],
					[moment().valueOf(), 1000]
    ];
        var d3 = [
                    [moment().subtract(24, 'month').valueOf(), 200],
                    [moment().subtract(10, 'month').valueOf(), 470],
                    [moment().subtract(9, 'month').valueOf(), 870],
                    [moment().subtract(8, 'month').valueOf(), 470],
                    [moment().subtract(7, 'month').valueOf(), 2700],
                    [moment().subtract(6, 'month').valueOf(), 2440],
                    [moment().subtract(5, 'month').valueOf(), 3200],
                    [moment().subtract(4, 'month').valueOf(), 2800],
                    [moment().subtract(3, 'month').valueOf(), 2600],
                    [moment().subtract(2, 'month').valueOf(), 1200],
                    [moment().subtract(1, 'month').valueOf(), 1700],
                    [moment().valueOf(), 1000]
    ];
        
        
        var d4 = '';var d5 = '';var d6 = '';var d7 = '';var d8 = ''; /*[
    			    [moment().subtract(24, 'month').valueOf(), 100],
					[moment(), 40],
					[moment().subtract(9, 'month').valueOf(), 80],
					[moment().subtract(8, 'month').valueOf(), 40],
					[moment().subtract(7, 'month').valueOf(), 200],
					[moment().subtract(6, 'month').valueOf(), 240],
					[moment().subtract(5, 'month').valueOf(), 300],
					[moment().subtract(4, 'month').valueOf(), 200],
					[moment().subtract(3, 'month').valueOf(), 200],
					[moment().subtract(2, 'month').valueOf(), 100],
					[moment().subtract(1, 'month').valueOf(), 50],
					[moment().valueOf(), 1000]
    ];*/

var labelColor = "#333";
        //flot options
        var options = {
            series: {
                curvedLines: {
                    apply: true,
                    active: true,
                    monotonicFit: true
                }
            },
			xaxis: {
				mode: "time",
				timeformat: "%b-%y",
				color: 'rgba(0, 0, 0, 0)',
				font: {color: labelColor}
			},
			yaxis: {
				font: {color: labelColor}
			},
            colors: ["#26B99A"],
            grid: {
                borderWidth: {
                    top: 0,
                    right: 0,
                    bottom: 1,
                    left: 1
                },
                borderColor: {
                    bottom: "#7F8790",
                    left: "#7F8790"
                }
            }
        };

        var plot = $.plot($("#placeholder3xx3"), [{
            label: "Flight",
            data: d1,
            lines: {
                fillColor: "rgba(150, 202, 89, 0.12)"
            }, //#96CA59 rgba(150, 202, 89, 0.42)
            points: {
                fillColor: "#fff"
            }
                },/*{
            label: "Car",
            data: d2,
            lines: {
                fillColor: "rgba(89, 121, 182, 1)"
            },
            points: {
                fillColor: "#fff"
            }
                },{
            label: "Hotel",
            data: d3,
            lines: {
                fillColor: "rgba(255, 108, 108, 1)"
            },
            points: {
                fillColor: "#fff"
            }
                },*/
              /*  {
            label: "Cars",
            data: d8,
            lines: {
                fillColor: "rgba(255, 108, 108, 1)"
            }, //#96CA59 rgba(150, 202, 89, 0.42)
            points: {
                fillColor: "#fff"
            }
                },
                {
            label: "Transfers",
            data: d3,
            lines: {
                fillColor: "rgba(255, 108, 108, 1)"
            }, //#96CA59 rgba(150, 202, 89, 0.42)
            points: {
                fillColor: "#fff"
            }
                },
                {
            label: "Packages",
            data: d4,
            lines: {
                fillColor: "rgba(255, 108, 108, 1)"
            }, //#96CA59 rgba(150, 202, 89, 0.42)
            points: {
                fillColor: "#fff"
            }
                },
                {
            label: "Cruise",
            data: d7,
            lines: {
                fillColor: "rgba(255, 108, 108, 1)"
            }, //#96CA59 rgba(150, 202, 89, 0.42)
            points: {
                fillColor: "#fff"
            }
                } */
                
                
                
                ], options);
    </script>
    <!-- /flot -->
    <!--  -->
    <script>
        $('document').ready(function () {
            $(".sparkline_one").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 7, 5, 4, 3, 5, 6], {
                type: 'bar',
                height: '40',
                barWidth: 9,
                colorMap: {
                    '7': '#a1a1a1'
                },
                barSpacing: 2,
                barColor: '#26B99A'
            });

            $(".sparkline_two").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 7, 5, 4, 3, 5, 6], {
                type: 'line',
                width: '200',
                height: '40',
                lineColor: '#26B99A',
                fillColor: 'rgba(223, 223, 223, 0.57)',
                lineWidth: 2,
                spotColor: '#26B99A',
                minSpotColor: '#26B99A'
            });
 

        })
    </script>
    <!-- -->
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
                maxDate: '12/31/2020',
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

    <!-- moris js -->
    <script src="<?php echo ASSETS; ?>js/moris/raphael-min.js"></script>
    <script src="<?php echo ASSETS; ?>js/moris/morris.js"></script>
    <script>
        $(function () {
            var day_data = [
                {
                    "period": "Jan",
                    "Hours worked": 80
                },
                {
                    "period": "Feb",
                    "Hours worked": 125
                },
                {
                    "period": "Mar",
                    "Hours worked": 176
                },
                {
                    "period": "Apr",
                    "Hours worked": 224
                },
                {
                    "period": "May",
                    "Hours worked": 265
                },
                {
                    "period": "Jun",
                    "Hours worked": 314
                }
    ];
            Morris.Bar({
                element: 'graph_bar',
                data: day_data,
                hideHover: 'always',
                xkey: 'period',
                barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                ykeys: ['Hours worked', 'sorned'],
                labels: ['Hours worked', 'SORN'],
                xLabelAngle: 60
            });
        });
    </script>
    <!-- skycons -->
    <script>
        var icons = new Skycons({
                "color": "#73879C"
            }),
            list = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for (i = list.length; i--;)
            icons.set(list[i], list[i]);

        icons.play();
    </script>
    <script>
    
        var opts = {
            lines: 12, // The number of lines to draw
            angle: 0, // The length of each line
            lineWidth: 0.4, // The line thickness
            pointer: {
                length: 0.75, // The radius of the inner circle
                strokeWidth: 0.042, // The rotation offset
                color: '#1D212A' // Fill color
            },
            limitMax: 'false', // If true, the pointer will not go past the end of the gauge
            colorStart: '#1ABC9C', // Colors
            colorStop: '#1ABC9C', // just experiment with them
            strokeColor: '#F0F3F3', // to see which ones work best for you
            generateGradient: true
        };
        var target = document.getElementById('foo2'); // your canvas element
        var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
        gauge.maxValue = 10000; // set max gauge value
        gauge.animationSpeed = 32; // set animation speed (32 is default value)
        gauge.set(3200); // set actual value
        gauge.setTextField(document.getElementById("gauge-text2"));
    </script>
</body>

</html>
