			<?php
		 	
if(isset($user_type))
{
$user_type=$user_type;
}
else
{
	$user_type='';
}

$profit_sales = $this->home_model->profit_sales($user_type);
//echo '<pre/>';
//print_r($profit_sales);exit;
 							?>
                            
                            <div class="dashboard-widget-content">
                                        <ul class="quick-list">
                                          <?php
										  $barr =array('fa-bars','fa-bar-chart','fa-line-chart','fa-bar-chart','fa-line-chart','fa-area-chart','fa-bars','fa-bar-chart','fa-line-chart','fa-line-chart');
										  if($profit_sales!='')
										  {
											  for($i=0;$i<count($profit_sales);$i++)
											  {
												  
												  ?>
                                            <li><i class="fa <?php echo $barr[$i]; ?>"></i><a href="#"><?php echo  $profit_sales[$i]->product_name; ?></a></li>
                                            <?php
											  }
										  }
										  ?>
                                        </ul>

                                        <div class="sidebar-widget">
                                            <h4><?php echo  $profit_sales[0]->product_name; ?></h4>
                                            <canvas width="150" height="80" id="foo" class="" style="width: 160px; height: 100px;"></canvas>
                                            <div class="goal-wrapper">
                                                <span class="gauge-value pull-left">$</span>
                                                <span id="gauge-text" class="gauge-value pull-left">20</span>
                                                <span id="goal-text" class="goal-value pull-right">$3,000</span>
                                            </div>
                                        </div>
                                    </div><script>
    
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