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
    
    <link href="<?php echo ASSETS; ?>css/icheck/flat/green.css" rel="stylesheet" />
    <link href="<?php echo ASSETS; ?>css/floatexamples.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>
    <script src="<?php echo ASSETS; ?>js/nprogress.js"></script>
    <script>
        NProgress.start();
    </script>
    
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

                <!-- top tiles -->
                <div class="row tile_count">
                    

                </div>
                <!-- /top tiles -->

                <div class="row">
                    <div class="page-title">
                            <div class="title_left">
                                <h3>
                                   Overall GP report
                                </h3>
                            </div>
                        </div>
                   
                    <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                <table id="example" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                        <tr class="headings">
                                            <th>Sl No </th>
                                            <th>Product </th>
                                            <th>Net Rate</th>
                                            <th>Admin Markup</th>
                                            <th>Agent Markup</th>
                                            <th>Base Amount</th>
                                            <th>Discount</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                        <?php 
										$i=1;
										if(!empty($product_reports))
										{
                                        foreach($product_reports as $reports)
                                        {
                                        
                                           ?>
                                           <tr class="even pointer">
                                             <td class=" "><?php echo $i++; ?></td>
                                            <td class=""><?php echo $reports->product_name; ?></td>
                                            <td class=""><?php echo $reports->net_rate; ?></td>
                                            <td class=""><?php echo $reports->admin_markup; ?></td>
                                            <td class=""><?php echo $reports->agent_markup; ?></td>
                                            <td class=""><?php echo $reports->base_amount; ?></td>
                                            <td class=""><?php echo $reports->discount; ?></td>
                                            <td class=""><?php echo $reports->total_amount; ?></td>

                                        </tr>
                                        <?php
                                    }
										}
                                    ?>
                                       <!--  <tr class="even pointer">
                                             <td class=" ">-</td>
                                            <td class="">TOTAL</td>
                                            <td class=""><?php echo $total_reports->net_rate; ?></td>
                                            <td class=""><?php echo $total_reports->admin_markup; ?></td>
                                            <td class=""><?php echo $total_reports->agent_markup; ?></td>
                                            <td class=""><?php echo $total_reports->base_amount; ?></td>
                                            <td class=""><?php echo $total_reports->discount; ?></td>
                                            <td class=""><?php echo $total_reports->total_amount; ?></td>

                                        </tr> -->
                                </tbody>

                            </table></div></div>
                            
            <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>
                                    B2B Wise Reports
                                </h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                <table id="example" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                        <tr class="headings">
                                             <th>Sl No </th>
                                            <th>Agent </th>
                                            <th>Gross Total</th>
                                            <th >Admin Markup</th>
                                            <th>Agent Markup</th>
                                            <th>No Of Bookings</th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                        <?php 
										$i=1;
										if(!empty($b2b_bookings))
										{
                                        foreach($b2b_bookings as $bookings)
                                        {   
                                           
                                           ?>
                                           <tr class="even pointer">
                                             <td class=" "><?php echo $i++; ?></td>
                                            <td class=""><?php echo $bookings->user_name; ?> </td>
                                            <td class=""><?php echo round($bookings->total_amount,0); ?></td>
                                            <td class=""><?php echo round($bookings->admin_markup,0); ?></td>
                                            <td class=""><?php echo round($bookings->agent_markup,0); ?></td>
                                            <td class=""><?php echo $bookings->total_bookings; ?></td>

                                        </tr>
                                        <?php
                                    }
										}
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>
                                    B2C Wise Reports
                                </h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                <table id="example" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                        <tr class="headings">
                                             <th>Sl No </th>
                                            <th>B2C User </th>
                                            <th>Gross Total</th>
                                            <th >Admin Markup</th>
                                            <th>No Of Bookings</th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                        <?php 
										$i=1;
										if(!empty($b2c_bookings))
										{
                                        foreach($b2c_bookings as $bookings)
                                        {
                                        
                                           ?>
                                           <tr class="even pointer">
                                             <td class=" "><?php echo $i++; ?></td>
                                            <td class=""><?php echo $bookings->user_name; ?> </td>
                                            <td class=""><?php echo round($bookings->total_amount,0); ?></td>
                                            <td class=""><?php echo round($bookings->admin_markup,0); ?></td>
                                            <td class=""><?php echo $bookings->total_bookings; ?></td>

                                        </tr>
                                        <?php
                                    }
										}
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                            
                            
                            
                            
                            
                            
            
            
            	<div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Total Sales and Profit Amount <small></small></h2>
                                   
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <canvas id="canvas_pie_new"></canvas>
                                </div>
                            </div>
                      </div>
                    


                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Total Booking Count <small></small></h2>
                                   
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <canvas id="canvas_pie"></canvas>
                                </div>
                            </div>
                        </div>
                </div>
                <br />


</div>




                <div class="row hide" >
				    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Last Six Month Bookings <small></small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <canvas id="canvas_bar"></canvas>
                                </div>
                            </div>
                        </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="x_panel tile fixed_height_320 overflow_hidden">
                            <div class="x_title">
                                <h2>Total Transaction Amount</h2>
                               
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <table class="" style="width:100%">
                                    <tr>
                                        <th style="width:37%;">
                                            <p>Top 5</p>
                                        </th>
                                        <th>
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                                <p class="">Charges</p>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                <p class="">Percentage</p>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <canvas id="canvas1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                                        </td>
                                        <td>
                                            <table class="tile_info">
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square blue"></i>Base Amount </p>
                                                    </td>
                                                    <td><?php echo round((($statics_reports->base_amount/$statics_reports->total_amount)*100),0); ?>%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square grey"></i>Net Rate </p>
                                                    </td>
                                                    <td><?php echo round((($statics_reports->net_rate/$statics_reports->total_amount)*100),0); ?>%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square purple"></i>Admin Markup </p>
                                                    </td>
                                                    <td><?php echo round((($statics_reports->admin_markup/$statics_reports->total_amount)*100),0); ?>%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square green"></i>Agent Markup </p>
                                                    </td>
                                                    <td><?php echo round((($statics_reports->agent_markup/$statics_reports->total_amount)*100),0); ?>%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square red"></i>Admin Base Price </p>
                                                    </td>
                                                    <td><?php echo round((($statics_reports->admin_baseprice/$statics_reports->total_amount)*100),0); ?>%</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row hide">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="dashboard_graph x_panel">
                                <div class="row x_title">
                                    <div class="col-md-6">
                                        <h3>Overall Sales<small></small></h3>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="reportrange1" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                            <span>
                                            <?php echo  date('F d, Y') .' - '.date('F d, Y' , strtotime( date('Y-m-d') ." -1 months")); ?>
                                            </span> <b class="caret"></b>
                                        </div>
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
    <script src="<?php echo ASSETS; ?>js/chartjs/chart.min.js"></script>
    <script src="<?php echo ASSETS; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo ASSETS; ?>js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo ASSETS; ?>js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- gauge js -->
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/gauge/gauge.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/gauge/gauge_demo.js"></script>
    <!-- chart js -->
    <script src="<?php echo ASSETS; ?>js/icheck/icheck.min.js"></script>
    <script src="<?php echo ASSETS; ?>js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?php echo ASSETS; ?>js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo ASSETS; ?>js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    
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
    <div class="change_graph">
    <script>
        $(document).ready(function () {
            // [17, 74, 6, 39, 20, 85, 7]
            //[82, 23, 66, 9, 99, 6, 2]
            <?php
            if($product){
            	foreach($product as $products){ ?>
            		var <?php echo $products->chart_name ; ?> = [
            		<?php
            		foreach($second_chart as $group_chart){
            			if($products->product_name == $group_chart->product){
            			?>	
            			 [gd(<?php echo $group_chart->year ;?>, <?php echo $group_chart->month ;?>, <?php echo $group_chart->day ;?>), <?php echo $group_chart->Hits; ?>], 
            			           			<?php }
            		}?>
            	]; <?php
            		
            	} 
            }

            ?>

         // var data3 = [[gd(2012, 1, 1), 56], [gd(2012, 1, 2), 74], [gd(2012, 1, 3), 6], [gd(2012, 1, 4), 39], [gd(2012, 1, 5), 20], [gd(2012, 1, 6), 85], [gd(2012, 1, 7), 7]];

         //  var data2 = [[gd(2012, 1, 1), 82], [gd(2012, 1, 2), 23], [gd(2012, 1, 3), 66], [gd(2012, 1, 4), 9], [gd(2012, 1, 5), 119], [gd(2012, 1, 6), 6], [gd(2012, 1, 7), 9]];
          
            $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
              <?php if($product) foreach($product as $products){
            		 echo $products->chart_name.',' ; }?> 
            ], {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    verticalLines: true,
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#fff'
                },
                colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
                xaxis: {
                    tickColor: "rgba(51, 51, 51, 0.06)",
                    mode: "time",
                    tickSize: [1, "day"],
                    //tickLength: 10,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Verdana, Arial',
                    axisLabelPadding: 10
                        //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]
                },
                yaxis: {
                    ticks: 8,
                    tickColor: "rgba(51, 51, 51, 0.06)",
                },
                tooltip: false
            });

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }
        });
    </script>
    </div>
    <!-- worldmap -->
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/maps/jquery-jvectormap-2.0.1.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/maps/gdp-data.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/maps/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/maps/jquery-jvectormap-us-aea-en.js"></script>
    <script>
        $(function () {
            $('#world-map-gdp').vectorMap({
                map: 'world_mill_en',
                backgroundColor: 'transparent',
                zoomOnScroll: false,
                series: {
                    regions: [{
                        values: gdpData,
                        scale: ['#E6F2F0', '#149B7E'],
                        normalizeFunction: 'polynomial'
                    }]
                },
                onRegionTipShow: function (e, el, code) {
                    el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
                }
            });
        });
    </script>
    <!-- skycons -->
    <script src="<?php echo ASSETS; ?>js/skycons/skycons.js"></script>
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

    <!-- dashbord linegraph -->
    <script>

        var doughnutData = [
            {
                value: <?php echo round($statics_reports->net_rate,0); ?>,
                color: "#455C73"
            },
            {
                value: <?php echo round($statics_reports->admin_markup,0); ?>,
                color: "#9B59B6"
            },
            {
                value: <?php echo round($statics_reports->admin_baseprice,0); ?>,
                color: "red"
            },
            {
                value: <?php echo round($statics_reports->agent_markup,0); ?>,
                color: "#26B99A"
            },
            {
                value: <?php echo round($statics_reports->base_amount,0); ?>,
                color: "#3498DB"
            }

    ];
        var myDoughnut = new Chart(document.getElementById("canvas1").getContext("2d")).Doughnut(doughnutData);
    </script>
    <!-- /dashbord linegraph -->
    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {
        	<?php 
$first  = strtotime('first day this month');
$months = array();

for ($i = 6; $i >= 1; $i--) {
  array_push($months, date('M', strtotime("-$i month", $first)));
}
?>

<?php if($first_chart){ if(count($first_chart) <= 6){ for($i=0;$i<=count($first_chart)-1;$i++) { $data[$i] = $first_chart[$i]->Hits;} } else{ for($i=0;$i<=6;$i++) { $data[$i] = $first_chart[$i]->Hits; } } }  ?>
            var barChartData = {
            labels: ["<?php echo $months[0]; ?>", "<?php echo $months[1]; ?>", "<?php echo $months[2]; ?>", "<?php echo $months[3]; ?>", "<?php echo $months[4]; ?>", "<?php echo $months[5]; ?>"],
            datasets: [
                {
                    fillColor: "#26B99A", //rgba(220,220,220,0.5)
                    strokeColor: "#26B99A", //rgba(220,220,220,0.8)
                    highlightFill: "#36CAAB", //rgba(220,220,220,0.75)
                    highlightStroke: "#36CAAB", //rgba(220,220,220,1)
                    data: [<?php if(!empty($data)) {if(count($data) <= 6){ for($i=0;$i<=count($first_chart)-1;$i++) { echo $data[$i].',';} } else{ for($i=0;$i<=6;$i++) { echo $data[$i].','; } }} ?>]
            }
        ],
        }
        var sharePiePolorDoughnutData = [
            <?php if($pie_chart){ foreach($pie_chart as $pie){ ?>

            {
                value: <?php echo $pie->hits;?>,
                color: "<?php 
    
    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    echo $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
    
?>",
                highlight: "<?php echo $color; ?>",
                label: "<?php echo $pie->product;?>"
        },
        <?php }} ?>
            
    ];
     var sharePiePolorDoughnutData_new = [
          

            {
                value:<?php echo round($statics_reports->admin_markup,0); ?>,
                color: "green",
                highlight: "green",
                label: "PROFIT"
        },
        {
                value: <?php echo round($statics_reports->total_amount,0); ?>,
                color: "blue",
                highlight: "blue",
                label: "TOTAL SALES"
        },
        
            
    ];
         <?php if($third_chart){ for($i=0;$i<=count($third_chart)-1;$i++){ $value[$i] = $third_chart[$i]->Hits; }}?>
       /*  var d1 = [
         <?php if($third_chart){ for($i=0;$i<count($third_chart)-1;$i++){ ?>
       				[new Date(Date.today().add(-<?php echo $i; ?>).days()).getTime(), <?php echo $value[$i]; ?>],
					<?php }} ?>
					
    ];*/
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
            label: "Overall Booking Hits",
            data: d1,
            lines: {
                fillColor: "rgba(150, 202, 89, 0.12)"
            }, //#96CA59 rgba(150, 202, 89, 0.42)
            points: {
                fillColor: "#fff"
            }
                }], options);
        new Chart($("#canvas_bar").get(0).getContext("2d")).Bar(barChartData, {
                tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                responsive: true,
                barDatasetSpacing: 6,
                barValueSpacing: 5
            }); 
        new Chart(document.getElementById("canvas_pie").getContext("2d")).Pie(sharePiePolorDoughnutData, {
                responsive: true,
                tooltipFillColor: "rgba(51, 51, 51, 0.55)"
            });
        new Chart(document.getElementById("canvas_pie_new").getContext("2d")).Pie(sharePiePolorDoughnutData_new, {
                responsive: true,
                tooltipFillColor: "rgba(51, 51, 51, 0.55)"
            });
            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
            }
            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange1 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
            }
            
        });
    </script>
<!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
                var start = start.format('YYYY-M-D');
                var end = end.format('YYYY-M-D');
               // alert(start+end);
                $.ajax({
                    url:"<?php echo WEB_URL;?>reports/ajax_chart",
                    type:"POST",
                    data:{start:start,end:end},
                     }).done(function(data){
                        $('.new_graph').html(data);
                     });
           
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
    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange1 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
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
            $('#reportrange1 span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
            $('#reportrange1').daterangepicker(optionSet1, cb);
            $('#reportrange1').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#reportrange1').on('hide.daterangepicker', function () {
                console.log("hide event fired");
            });
            $('#reportrange1').on('apply.daterangepicker', function (ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
            });
            $('#reportrange1').on('cancel.daterangepicker', function (ev, picker) {
                console.log("cancel event fired");
            });
            $('#options1').click(function () {
                $('#reportrange1').data('daterangepicker').setOptions(optionSet1, cb);
            });
            $('#options2').click(function () {
                $('#reportrange1').data('daterangepicker').setOptions(optionSet2, cb);
            });
            $('#destroy').click(function () {
                $('#reportrange1').data('daterangepicker').remove();
            });
        });
    </script>
    
    <!-- /datepicker -->
    <!-- /datepicker -->
    <script>
        NProgress.done();
    </script>
    <!-- /datepicker -->
    <!-- /footer content -->
</body>

</html>
