<?php 
			$user_id = $this->session->userdata('user_id');
			$user_type =  $this->session->userdata('user_type');
			$userInfo = $this->general_model->get_user_details($user_id,$user_type,1);
			$bookings_reports = $this->general_model->get_overall_reports_graph($user_id,$user_type);
			// debug($bookings_reports);//die;
			$recent_sales_profit = $this->general_model->get_recent_sales_profit($user_id,$user_type);
			$recent_product_sales = $this->general_model->get_recent_product_sales($user_id,$user_type);
			$get_overall_pds_graph = $this->general_model->get_overall_pds_graph($user_id,$user_type);
			
			 
			// echo $this->load->view(PROJECT_THEME.'/dashboard/overall_graph_reports',$data);

 ?>



  <div class="row">


                        <div class="col-md-12 col-sm-12 col-xs-12 graph-divv">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Overall Reports<small> </small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                   <div id="chartdiv" style="width:100%; height:600px;"></div>
                                </div>
                            </div>
                        </div>
</div>
    <div class="clearfix"></div>
       <div>
       

 


                    <div class="row">


                        <div class="col-md-6 col-sm-6 col-xs-12 chr-book">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Bookings<small> </small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <canvas id="canvas000"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 chr-saless">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Sales <small></small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <canvas id="canvas_bar"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 chr-saless">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Overall Sales <small></small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <canvas id="canvas_radar"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 chr-saless">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Overall Bookings <small></small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <canvas id="canvas_doughnut"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                   
                    
       </div>
         <!-- chart js -->
    <script src="<?php echo ADMIN_ASSETS; ?>js/chartjs/chart.min.js"></script>
 
    <script src="<?php echo ADMIN_ASSETS; ?>js/custom.js"></script>
    
    
    	<link rel="stylesheet" href="<?php echo ADMIN_ASSETS; ?>js/amcharts/style.css"	type="text/css">
		<script src="<?php echo ADMIN_ASSETS; ?>js/amcharts/amcharts.js" type="text/javascript"></script>
		<script src="<?php echo ADMIN_ASSETS; ?>js/amcharts/serial.js" type="text/javascript"></script>
		<script src="<?php echo ADMIN_ASSETS; ?>js/amcharts/amstock.js" type="text/javascript"></script>
         <?php
		 if($recent_sales_profit!='')
		 {
			 for($i=0;$i<count($recent_sales_profit);$i++)
						{
							
							
							$sa[] = '"'.date("M",strtotime($recent_sales_profit[$i]->booking_date)).'"';
							$sa1[] = $recent_sales_profit[$i]->sales;
							$sa2[] =  $recent_sales_profit[$i]->profit;
							
						}
						$sa_a =implode(",",$sa);
						$sa_a1 =implode(",",$sa1);
						$sa_a2 =implode(",",$sa2);
		 }
		  if($recent_product_sales!='')
		 {
			 for($i=0;$i<count($recent_product_sales);$i++)
						{
							
							
							$ps[] = '"'.$recent_product_sales[$i]->product_name.'"';
							$ps1[] = $recent_product_sales[$i]->sales;
							$ps2[] =  $recent_product_sales[$i]->profit;
							
						}
						$p_s =implode(",",$ps);
						$p_s1 =implode(",",$ps1);
						$p_s2 =implode(",",$ps2);
		 }
		 

				if($get_overall_pds_graph!='')
				{
					 

 $color_array =  array("#F60","#FCD202","#B0DE09","#0D8ECF","#2A0CD0","#CD0D74","#C00","#0C0","#F60","#F60");
				 		for($i=0;$i<count($get_overall_pds_graph);$i++)
						{
						
						$a1[] =' {
                value: '.$get_overall_pds_graph[$i]->total_count.',
                color: "'.$color_array[$i].'",
                highlight: "'.$color_array[$i].'",
                label: "'.$get_overall_pds_graph[$i]->product_name.'"
        }';
				 		  
						
						  
						}
						$a1sd1 =implode(",",$a1);
				}
				
				 
				?>
<script>
 
				var chartData1 = [];
				var chartData2 = [];
				var chartData3 = [];
				var chartData4 = [];
				var chartData5 = [];
				var chartData6 = [];
				var chartData7 = [];
				var chartData8 = [];
			generateChartData();

			function generateChartData() {
				
			
				
				var firstDate = new Date();
				
				firstDate.setDate(firstDate.getDate());
				firstDate.setHours(0, 0, 0, 0);
				var unavailabledates = $.parseJSON('<?php echo json_encode($bookings_reports); ?>');
				for (var i = 0; i < unavailabledates.length; i++) {
					
				var newDate = new Date(firstDate);
					newDate.setDate(newDate.getDate() + i);

					var a1 = Math.round(unavailabledates[i]['flight_count']);
					var b1 = Math.round(unavailabledates[i]['flight_total_amount']);

					
				 

					chartData1.push({
						date: newDate,
						value: a1,
						volume: b1
					});
					
				
				}
			}
console.log(chartData1);
			AmCharts.makeChart("chartdiv", {
				type: "stock",
				dataSets: [
				{
					title: "Flight",
					fieldMappings: [{
						fromField: "value",
						toField: "value"
					}, {
						fromField: "volume",
						toField: "volume"
					}],
					dataProvider: chartData1,
					categoryField: "date"
				},
				],

				panels: [{

					showCategoryAxis: false,
					title: "Sales",
					percentHeight: 70,

					stockGraphs: [{
						id: "g1",

						valueField: "value",
						comparable: true,
						compareField: "value",
						bullet: "round",
						bulletBorderColor: "#FFFFFF",
						bulletBorderAlpha: 1,
						balloonText: "[[title]]:<b>[[value]]</b>",
						compareGraphBalloonText: "[[title]]:<b>[[value]]</b>",
						compareGraphBullet: "round",
						compareGraphBulletBorderColor: "#FFFFFF",
						compareGraphBulletBorderAlpha: 1
					}],

					stockLegend: {
						periodValueTextComparing: "[[percents.value.close]]%",
						periodValueTextRegular: "[[value.close]]"
					}
				},

				{
					title: "Bookings",
					percentHeight: 30,
					stockGraphs: [{
						valueField: "volume",
						type: "column",
						showBalloon: false,
						fillAlphas: 1
					}],


					stockLegend: {
						periodValueTextRegular: "[[value.close]]"
					}
				}],

				chartScrollbarSettings: {
					graph: "g1",
					updateOnReleaseOnly:false
				},

				chartCursorSettings: {
					valueBalloonsEnabled: true,
					valueLineEnabled:true,
					valueLineBalloonEnabled:true
				},

				periodSelector: {
					position: "left",
					periods: [{
						period: "DD",
						count: 7,
						label: "Last Week"
					}, {
						period: "MM",
						selected: true,
						count: 1,
						label: "Last month"
					}, {
						period: "YYYY",
						count: 1,
						label: "Last year"
					}, {
						period: "YTD",
						label: "YTD"
					}, {
						period: "MAX",
						label: "MAX"
					}]
				},

				dataSetSelector: {
					position: "left"
				}
			});
		</script><script>
        var randomScalingFactor = function () {
            return Math.round(Math.random() * 100)
        };



        var barChartData = {
            labels: [<?php echo $sa_a; ?>],
            datasets: [
                {
                    fillColor: "#FEC933", //rgba(220,220,220,0.5)
                    strokeColor: "#FEC933", //rgba(220,220,220,0.8)
                    highlightFill: "#EAAF08", //rgba(220,220,220,0.75)
                    highlightStroke: "#EAAF08", //rgba(220,220,220,1)
                    data: [<?php echo $sa_a1; ?>]
            },
                {
                    fillColor: "#F96800", //rgba(151,187,205,0.5)
                    strokeColor: "#F96800", //rgba(151,187,205,0.8)
                    highlightFill: "#C15406", //rgba(151,187,205,0.75)
                    highlightStroke: "#C15406", //rgba(151,187,205,1)
                    data: [<?php echo $sa_a2; ?>]
            }
        ],
        }

   
            new Chart($("#canvas_bar").get(0).getContext("2d")).Bar(barChartData, {
                tooltipFillColor: "#F96800",
                responsive: true,
                barDatasetSpacing: 6,
                barValueSpacing: 5
            });
       


        var lineChartData = {
            labels: [<?php echo $sa_a; ?>],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "#F96800", //rgba(220,220,220,0.2)
                    strokeColor: "#F96800", //rgba(220,220,220,1)
                    pointColor: "#F96800", //rgba(220,220,220,1)
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [<?php echo $sa_a1; ?>]
            },
                {
                    label: "My Second dataset",
                    fillColor: "#FEC933", //rgba(151,187,205,0.2)
                    strokeColor: "#FEC933", //rgba(151,187,205,1)
                    pointColor: "#FEC933", //rgba(151,187,205,1)
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [<?php echo $sa_a2; ?>]
            }
        ]

        }

       
            new Chart(document.getElementById("canvas000").getContext("2d")).Line(lineChartData, {
                responsive: true,
                tooltipFillColor: "rgba(51, 51, 51, 0.55)"
            });
       

        var sharePiePolorDoughnutData = [<?php echo $a1sd1; ?>];

      

        var radarChartData = {
            labels: [<?php echo $p_s; ?>],
            datasets: [
                {
                    label: "My First dataset",
                   fillColor: "#F96800", //rgba(220,220,220,0.2)
                    strokeColor: "#F96800", //rgba(220,220,220,1)
                    pointColor: "#F96800", //rgba(220,220,220,1)
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [<?php echo $p_s1; ?>]
            },
                {
                    label: "My Second dataset",
                    fillColor: "#FEC933", //rgba(151,187,205,0.2)
                    strokeColor: "#FEC933", //rgba(151,187,205,1)
                    pointColor: "#FEC933", //rgba(151,187,205,1)
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [<?php echo $p_s2; ?>]
            }
        ]
        };

      
            window.myRadar = new Chart(document.getElementById("canvas_radar").getContext("2d")).Radar(radarChartData, {
                responsive: true,
                tooltipFillColor: "rgba(51, 51, 51, 0.55)"
            });
      

        var polarData = [<?php echo $a1sd1; ?>];
 

     
            window.myDoughnut = new Chart(document.getElementById("canvas_doughnut").getContext("2d")).Doughnut(sharePiePolorDoughnutData, {
                responsive: true,
                tooltipFillColor: "rgba(51, 51, 51, 0.55)"
            });
        
    </script>
