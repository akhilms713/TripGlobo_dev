<?php

if(isset($status))
{
	$status = $status;
}
else
{
	$status='';
}
$overall_users = $this->home_model->overall_users($status);
// print_r($overall_users);
 		 
        ?><table class="tile" style="width:100%">
                                        <tr>
                                            <th style="width:37%;">
                                                <span>Users</span>
                                            </th>
                                            <th>
                                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                                    <span class="hidden-small">Module</span>
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                    <span class="hidden-small"></span>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <canvas id="canvas1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                                            </td>
                                            <td>
                                                <table class="tile_info">
                                                <?php 
												$data_v='';
												if($overall_users!='')
												{
													$data=array();
													for($i=0;$i<count($overall_users);$i++)
													{
														$color = $this->home_model->random_color();
														$data[] = '{   value: '.$overall_users[$i]->user_count.',   color: "#'.$color.'"        }';
														?>
                                                    <tr>
                                                        <td>
                                                            <p><i class="fa fa-square " style="color:#<?php echo $color; ?>"></i><?php echo $overall_users[$i]->user_type_name; ?> </p>
                                                        </td>
                                                        <td><?php echo $overall_users[$i]->user_count; ?></td>
                                                    </tr>
                                                    <?php
													}
													$data_v =implode(",",$data);
												}
													?>
                                                </table>
                                            </td>
                                        </tr>
                                    </table><script>
        $('document').ready(function () {
            
            var doughnutData = [<?php echo $data_v; ?>];
            var myDoughnut = new Chart(document.getElementById("canvas1").getContext("2d")).Doughnut(doughnutData);


        })
    </script>