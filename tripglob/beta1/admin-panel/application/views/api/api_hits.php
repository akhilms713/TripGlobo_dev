<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo PROJECT_TITLE; ?>  </title>
	<link rel="icon" href="https://tripglobo.com/beta1/assets/theme_dark/images/favicon.png" type="image/x-icon">

    <!-- Bootstrap core CSS -->

     <link href="<?php echo ASSETS; ?>css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo ASSETS; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo ASSETS; ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/icheck/flat/green.css" rel="stylesheet">
     <link href="<?php echo ASSETS; ?>css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">


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
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Api Hits</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Last 30 Day Hits <small></small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <div class="demo-container" style="height:280px">
                                            <div id="placeholder33x" class="demo-placeholder"></div>
                                        </div>
                                        <div class="tiles">
                                            <div class="col-md-4 tile">
                                                <span>Recent Hits</span>
                                                <h2><?php echo $hits_count->TOTAL_HITS; ?></h2>
                                                <span class="sparkline12 graph" style="height: 160px;">
                                        <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                    </span>
                                            </div>
                                            <div class="col-md-4 tile">
                                                <span>Recent Successive Hits</span>
                                                <h2><?php echo $hits_count->SUCCESS_HITS; ?></h2>
                                                <span class="sparkline22 graph" style="height: 160px;">
                                        <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                    </span>
                                            </div>
                                            <div class="col-md-4 tile">
                                                <span>Recent Failed Hits</span>
                                                <h2><?php echo $hits_count->FAILURE_HITS; ?></h2>
                                                <span class="sparkline11 graph" style="height: 160px;">
                                        <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                    </span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div>
                                            <div class="x_title">
                                                <h2>Recent Hits User List</h2>
                                               <div class="clearfix"></div>
                                            </div>
                                            <ul class="list-unstyled top_profiles scroll-view">
                                                <?php if($recent_hits){ foreach($recent_hits as $recent_hit_lists) { ?>
                                                <li class="media event">
                                                    <a class="pull-left border-aero profile_thumb">
                                                        <img src="<?php echo $recent_hit_lists->profile_picture; ?>" class="img-circle img-responsive">
                                                    </a>
                                                    <div class="media-body">
                                                        <a class="title" href="#"><?php echo $recent_hit_lists->user_name; ?></a>
                                                        <p><strong><?php echo $recent_hit_lists->ip_address; ?></strong>  </p>
                                                        <p> <small><?php echo $recent_hit_lists->xml_timestamp; ?></small>
                                                        </p>
                                                    </div>
                                                </li>
                                                    <?php }} ?>
                                              
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                      <div class="clearfix"></div>
                    <div class="row">

                        <!-- bar chart -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Last Six Month Hits <small></small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <canvas id="canvas_bar"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Total Hits Percentage <small></small></h2>
                                   
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <canvas id="canvas_pie"></canvas>
                                </div>
                            </div>
                        </div>
                        
                       
                          
                    </div>
                      <div class="row top_tiles">
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-caret-square-o-right"></i>
                                </div>
                                <div class="count"><?php echo $total_hits->TOTAL_HITS; ?></div>

                                <h3>Total Hits</h3>
                                <p></p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-comments-o"></i>
                                </div>
                                <div class="count"><?php echo $total_hits->SUCCESS_HITS; ?></div>

                                <h3>Total Successive Hits</h3>
                                <p></p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                                </div>
                                <div class="count"><?php echo $total_hits->FAILURE_HITS; ?></div>

                                <h3>Total Failed Hits</h3>
                                <p></p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-check-square-o"></i>
                                </div>
                                <div class="count"><?php echo $total_hits->IP_HITS; ?></div>

                                <h3>Total IP Hits</h3>
                                <p></p>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                    

                     <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                <table id="example" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                        <tr class="headings">
                                            <th>Sl No </th>
                                            <th>Api Name </th>
                                            <th>Number of Hits</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                        <?php 
                                        $i=1;
                                        if(!empty($api_name_hits))
                                        {
                                           // print_r($api_name_hits);exit;
                                        foreach($api_name_hits as $api)
                                        {
                                        
                                           ?>
                                           <tr class="even pointer">
                                             <td class=" "><?php echo $i++; ?></td>
                                             <td class=""><?php echo $api->api_name; ?></td>
                                             <td class=""><?php echo $api->TOTAL_API_HITS; ?></td>
                                            
                                            <td>
                                            <a href="<?php echo WEB_URL; ?>api/view_api_hits/<?php echo $api->api_id; ?>"> <i class="fa fa-search" title="View"></i></a>
                                           
                                            </td>

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

                <!-- footer content -->
                <?php echo $this->load->view('common/footer'); ?>  
                <!-- /footer content -->

            </div>
            <!-- /page content -->
        </div>
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

    <script src="<?php echo ASSETS; ?>js/datatables/js/jquery.dataTables.js"></script>
    <script src="<?php echo ASSETS; ?>js/datatables/tools/js/dataTables.tableTools.js"></script>
    <script src="<?php echo ASSETS; ?>js/sparkline/jquery.sparkline.min.js"></script>
    
    <script type="text/javascript">
 
    </script>
    
    <script src="<?php echo ASSETS; ?>js/chartjs/chart.min.js"></script>
<script>
           var randomScalingFactor = function () {
            return Math.round(Math.random() * 100)
        };
<?php 
$first  = strtotime('first day this month');
$months = array();

for ($i = 6; $i >= 1; $i--) {
  array_push($months, date('M', strtotime("-$i month", $first)));
}
?>

        var barChartData = {
            labels: ["<?php echo $months[0]; ?>", "<?php echo $months[1]; ?>", "<?php echo $months[2]; ?>", "<?php echo $months[3]; ?>", "<?php echo $months[4]; ?>", "<?php echo $months[5]; ?>"],
            datasets: [
                {
                    fillColor: "#26B99A", //rgba(220,220,220,0.5)
                    strokeColor: "#26B99A", //rgba(220,220,220,0.8)
                    highlightFill: "#36CAAB", //rgba(220,220,220,0.75)
                    highlightStroke: "#36CAAB", //rgba(220,220,220,1)
                    data: [<?php echo $api_hits->sixth_success; ?>, <?php echo $api_hits->fifth_success; ?>, <?php echo $api_hits->fourth_success; ?>, <?php echo $api_hits->third_success; ?>, <?php echo $api_hits->second_success; ?>, <?php echo $api_hits->first_success; ?>]
            },
                {
                    fillColor: "#03586A", //rgba(151,187,205,0.5)
                    strokeColor: "#03586A", //rgba(151,187,205,0.8)
                    highlightFill: "#066477", //rgba(151,187,205,0.75)
                    highlightStroke: "#066477", //rgba(151,187,205,1)
                    data: [<?php echo $api_hits->sixth_failure; ?>, <?php echo $api_hits->fifth_failure; ?>, <?php echo $api_hits->fourth_failure; ?>, <?php echo $api_hits->third_failure; ?>, <?php echo $api_hits->second_failure; ?>, <?php echo $api_hits->first_failure; ?>]
            }
        ],
        }
          var sharePiePolorDoughnutData = [
            {
                value: <?php echo $pie_chart->FAILURE; ?>,
                color: "#455C73",
                highlight: "#34495E",
                label: "FAILURE"
        },
            {
                value: <?php echo $pie_chart->SUCCESS; ?>,
                color: "#9B59B6",
                highlight: "#B370CF",
                label: "SUCCESS"
        }
    ];
        $(document).ready(function () {
                   //define chart clolors ( you maybe add more colors if you want or flot will add it automatic )
        var chartColours = ['#96CA59', '#3F97EB', '#72c380', '#6f7a8a', '#f7cb38', '#5a8022', '#2c7282'];

        //generate random number for charts
        randNum = function () {
            return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
        }

        $(function () {
            var d1 = [];
            //var d2 = [];
    var d12 = [<?php foreach($bar_chart as $data){ echo $data->HITS.','; } ?>];

            //here we generate data for chart
            for (var i = 0; i < 30; i++) {

                d1.push([new Date(Date.today().add(-i).days()).getTime(), d12[i]]);
                //    d2.push([new Date(Date.today().add(i).days()).getTime(), randNum()]);
            }
 
          
            var tickSize = [1, "day"];
            var tformat = "%d/%m/%y";

            //graph options
            var options = {
                grid: {
                    show: true,
                    aboveData: true,
                    color: "#3f3f3f",
                    labelMargin: 10,
                    axisMargin: 0,
                    borderWidth: 0,
                    borderColor: null,
                    minBorderMargin: 5,
                    clickable: true,
                    hoverable: true,
                    autoHighlight: true,
                    mouseActiveRadius: 100
                },
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        lineWidth: 2,
                        steps: false
                    },
                    points: {
                        show: true,
                        radius: 4.5,
                        symbol: "circle",
                        lineWidth: 3.0
                    }
                },
                legend: {
                    position: "ne",
                    margin: [0, -25],
                    noColumns: 0,
                    labelBoxBorderColor: null,
                    labelFormatter: function (label, series) {
                        // just add some space to labes
                        return label + '&nbsp;&nbsp;';
                    },
                    width: 40,
                    height: 1
                },
                colors: chartColours,
                shadowSize: 0,
                tooltip: true, //activate tooltip
                tooltipOpts: {
                    content: "%s: %y.0",
                    xDateFormat: "%d/%m",
                    shifts: {
                        x: -30,
                        y: -50
                    },
                    defaultTheme: false
                },
                yaxis: {
                    min: 0
                },
                xaxis: {
                    mode: "time",
                    minTickSize: tickSize,
                    timeformat: tformat
                  //  min: chartMinDate,
                  //  max: chartMaxDate
                }
            };
            var plot = $.plot($("#placeholder33x"), [{
                label: "API Hits",
                data: d1,
                lines: {
                    fillColor: "rgba(150, 202, 89, 0.12)"
                }, //#96CA59 rgba(150, 202, 89, 0.42)
                points: {
                    fillColor: "#fff"
                }
            }], options);
        });
        
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
$(".sparkline12").sparkline([<?php foreach($bar_chart as $data){ echo $data->HITS.','; } ?>], {
                type: 'bar',
                height: '40',
                barWidth: 13,
                colorMap: {
                    '7': '#a1a1a1'
                },
                barSpacing: 2,
                barColor: '#26B99A'
            });

            $(".sparkline11").sparkline([<?php foreach($bar_chart_failure as $data_failure){ echo $data_failure->HITS.','; } ?>], {
                type: 'bar',
                height: '40',
                barWidth: 8,
                colorMap: {
                    '7': '#a1a1a1'
                },
                barSpacing: 2,
                barColor: '#26B99A'
            });

            $(".sparkline22").sparkline([<?php foreach($bar_chart_success as $data_success){ echo $data_success->HITS.','; } ?>], {
                type: 'line',
                height: '40',
                width: '200',
                lineColor: '#26B99A',
                fillColor: '#ffffff',
                lineWidth: 3,
                spotColor: '#34495E',
                minSpotColor: '#34495E'
            });

            var oTable = $('#example').dataTable({
                "oLanguage": {
                    "sSearch": "Search all columns:"
                },
                "aoColumnDefs": [
                {
                    'bSortable': false,
                    'aTargets': [0]
                        } //disables sorting for column one
                        ],
                        'iDisplayLength': 10,
                        "sPaginationType": "full_numbers",
                        "dom": 'T<"clear">lfrtip',
                        "tableTools": {
                            "sSwfPath": "<?php echo base_url('assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                        }
                    });
        });
    </script>
     
     <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/jquery.flot.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/jquery.flot.time.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/date.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/jquery.flot.spline.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/jquery.flot.stack.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/curvedLines.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/flot/jquery.flot.resize.js"></script>
     

</body>

</html>