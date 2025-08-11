<style type="text/css">
	.brdbtmwt {
    border-bottom: 1px solid #fff;
}

.headsec {
    background-color: #00adef;
    border-right: 1px solid #ffffff;
    border-bottom: 1px solid #ffffff;
    color: #ffffff;
    display: block;
    font-family: arimo;
    font-size: 14px;
    font-weight: 600;
    height: 45px;
    overflow: hidden;
    padding: 0px;
    text-align: center;
}
.brdbtmwt {
    border-bottom: 1px solid #fff;
}
.headsec {
    background-color: #00adef;
    border-right: 1px solid #ffffff;
    border-bottom: 1px solid #ffffff;
    color: #ffffff;
    display: block;
    font-family: arimo;
    font-size: 14px;
    font-weight: 600;
    height: 45px;
    overflow: hidden;
    padding: 0px;
    text-align: center;
}
.flighton {
    background-color: #f89406;
    position: relative;
}
.innersec {
    background-color: #ffffff;
    border-bottom: 1px solid #dddddd;
    border-right: 1px solid #dddddd;
    height: 45px;
    padding: 10px;
    color: #666666;
    text-align: center;
}
.nopad, .nopadding {
    padding: 0;
}
.leftheadsec {
    background-color: #00adef;
    border-bottom: 1px solid #ffffff;
    border-right: 1px solid #ffffff;
    color: #ffffff;
    display: block;
    font-family: arimo;
    font-size: 14px;
    font-weight: 600;
    height: 45px;
    overflow: hidden;
    padding: 2px 0;
    text-align: center;
}
</style>
<?php 
	// echo "<pre/>";print_r($flight_result);exit('1111');
	$i=0;
	$rand_id = $rand_id;
	$search_id = $search_id;


	
	// $flight_result = $flight_result_calendar;
	if(!empty($flight_result)){
		// die('if');
		if(!empty($flight_result[0])){
			$curr_code		= BASE_CURRENCY;
			$lowest_price 	= $flight_result[0]['TotalFare'];
		} else {
			$curr_code 		= BASE_CURRENCY;
			$lowest_price 	= '0';
		}
		$date_sess_sd 		= $request->depart_date;
		$date_sess_ed 		= $request->return_date;
		$passenger_count 	= $request->ADT+$request->CHD+$request->INF;
	} else {
		// die('else');
		$id					= 0;
		$lowest_price		= 0;
		$date_sess_sd		= date("m-d-y");
		$date_sess_ed		= date("m-d-y");
	}
	// echo $date_sess_sd;
	// echo "<br/>".$date_sess_ed;

	$days = array('-3 days','-2 days','-1 days','+0 days','+1 days','+2 days','+3 days');	
	for($d = 0; $d < 7; $d++){
		$converteddate_sd[$d] 		= date('D j M',strtotime($date_sess_sd. $days[$d]));
		$converteddate_ed[$d] 		= date('D j M',strtotime($date_sess_ed. $days[$d]));
		$date_sd['cal_date'][$d] 	= date('D j M',strtotime($date_sess_sd. $days[$d]));
		$date_sd1['cal_date'][$d] 	= date('d-m-Y',strtotime($date_sess_sd. $days[$d]));
		$date_ed['cal_date'][$d] 	= date('D j M',strtotime($date_sess_ed. $days[$d]));
		$date_ed1['cal_date'][$d] 	= date('d-m-Y',strtotime($date_sess_ed. $days[$d]));
	}

	 // print_r($date_sd); print_r($date_ed); die;
	if(!empty($flight_result)){
		for($i=0;$i<(count($flight_result));$i++){
			$flight_result1[$i][0]['flight_id'] 	= $flight_id[$i]->flight_id;

			$sd = $flight_result[$i]['FlightDetails'][0]['DepartureDateTime_r'][0];
			$date_result_oneway = (date('D j M',((strtotime($sd)))));
			for($k=0;$k<7;$k++){
				if($date_result_oneway == $date_sd['cal_date'][$k]){							
					if($request->type == "oneway"){
						$Total_FareAmount[$k] = $flight_result[$i]['FlightDetails'][0]['TotalFare'];
						$flight_data[$k]	  = base64_encode(json_encode($flight_result[$i]));
						$flight_idd[$k]       = base64_encode(json_encode($flight_result1[$i]));
						$name[$k]			  = $flight_result[$i]['FlightDetails'][0]['Airline_name'][0];
					}else{
						$c 						= (count($flight_result[$i]['FlightDetails'][1]['ArrivalDateTime_r'])-1);
						$ed 					=  $flight_result[$i]['FlightDetails'][1]['DepartureDateTime_r'][0];
						$date_result_return		= (date('D j M',((strtotime($ed)))));					
						for($j=0;$j<7;$j++){
							if($date_result_return==$date_ed['cal_date'][$j]){
								$Total_FareAmount[$k][$j] = $flight_result[$i]['FlightDetails'][0]['TotalFare'];
								$flight_data[$k][$j]	  = base64_encode(json_encode($flight_result[$i]));
								$flight_idd[$k][$j]	      = base64_encode(json_encode($flight_result1[$i]));
								$name[$k][$j]			  = $flight_result[$i]['FlightDetails'][0]['Airline_name'][0];
							}
						}
					}					
				}
			}
		}
	}
  	//  echo '<pre/>';print_r($flight_data);
  	//   	echo '<pre/>';print_r($flight_idd);
  	// echo '<pre/>';print_r($flight_result1);exit();//print_r($Total_FareAmount);print_r($flight_data);print_r($name);exit;	 ?>


			<?php //print_r($Total_FareAmount); ?><br>
			<?php //print_r($converteddate_sd); ?>
    <div class="clearfix"></div>
    <input type="hidden" id="rand_id" value="<?php echo $rand_id; ?>">
    <input type="hidden" id="search_id" value="<?php echo $search_id; ?>">
    <div style="overflow-x:auto;">
    	<div class="totbrds">
		<?php if($request->type != "oneway"){ ?>

			<?php
				$price_arr = array(); 
				foreach ($Total_FareAmount as $key => $value) {
					$first = min($value);
					$first_val = $first;
					if ($first_val != '') {
						array_push($price_arr, $first_val);	
					}
					
					$second = min(array_diff($value, [$first]));
					if ($second > $first) {
						$second_val = $second;
					} else {
						$second_val = '';
					}
					if ($second_val != '') {
						array_push($price_arr, $second_val);
					}
					$third = min(array_diff($value, [$second]));
					if ($third > $second) {
						$third_val = $third;
					} else {
						$third_val = '';
					} 
					if ($third_val != '') {
						array_push($price_arr, $third_val);
					}
				}		
				
				$min = min($price_arr);
				if ($min != '') {
					$min_val = $min;	
				} else {
					$min_val = 'no val';
				}
				

				$second_min = min(array_diff($price_arr, [$min]));
				if ($second_min > $min) {
					$second_min_val = $second_min;
				} else {
					$second_min_val = 'no val';
				}

				$third_min = min(array_diff($price_arr, [$min, $second_min]));
				if ($third_min > $min) {
					$third_min_val = $third_min;
				} else {
					$third_min_val = 'no val';
				}
				
			?>
			<div class="col-xs-12 nopadding">
				<?php $kkk = 0;for($kk=0;$kk<4;$kk++){  ?>
				<div class="col-xs-3 nopadding">
					<?php if($kk == 0){ ?>
					<div class="col-xs-6 nopadding">
						<div class="headsec brdbtmwt">
							
						</div>
					</div>
					<?php }else{ ?>
						<div class="col-xs-6 nopadding">
							<div class="headsec <?php if($kk == 2){ echo "flighton"; } ?> ">
								Return<br /><?php echo $converteddate_ed[$kkk++]; ?>
							</div>
						</div>
					<?php } ?>	
					<div class="col-xs-6 nopadding">
						<div class="headsec">
							Return<br /><?php echo $converteddate_ed[$kkk++]; ?>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="clearfix"></div>
			<?php for($ii=0;$ii<7;$ii++) { ?>
				
				<div class="col-xs-12 nopadding">
					<?php $kkk = 0;for($kk=0;$kk<4;$kk++){ ?>
					<div class="col-xs-3 nopadding">
						<?php if($kk == 0){ ?>
						<div class="col-xs-6 nopadding">
								<div class="leftheadsec <?php if($ii == 3){ echo "flighton"; } ?> ">
									Departure<br /><?php echo $converteddate_sd[$ii]; ?>
								</div>
							</div>
						<?php }else{ ?>
							<div class="col-xs-6 nopadding">
								<?php if(isset($Total_FareAmount[$ii][$kkk])){   ?>
								<div onclick="show_flight_details('<?php echo $flight_data[$ii][$kkk]; ?>', '<?php echo $flight_idd[$ii][$kkk]; ?>')" class="innersec" <?php if ($Total_FareAmount[$ii][$kkk] == $min_val) {
									echo "style='background-color:#77ff77'";
								} else if ($Total_FareAmount[$ii][$kkk] == $second_min_val) {
									// var_dump($second_val);
									echo "style='background-color:#FFFF77'";
								} else if ($Total_FareAmount[$ii][$kkk] == $third_min_val) {
									echo "style='background-color:#FF7777'";
								} ?>>
									
									<a style="color: #000000;" href="javascript:void(0);" ><?php echo $this->display_icon." ".number_format(($Total_FareAmount[$ii][$kkk] * $this->curr_val), 2);?><?php $kkk++ ?></a>
								</div>
								<?php }else{ ?>
									<div class="innersec" <?php if ($Total_FareAmount[$ii][$kkk] == $min_val) {
										echo "style='background-color:#77ff77'";
									} else if ($Total_FareAmount[$ii][$kkk] == $second_min_val) {
										// var_dump($second_val);
										echo "style='background-color:#FFFF77'";
									} else if ($Total_FareAmount[$ii][$kkk] == $third_min_val) {
										echo "style='background-color:#FF7777'";
									} ?>>
										<span class="noflights">No Flights</span> <?php $kkk++ ?>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
						<div class="col-xs-6 nopadding">
							<?php if(isset($Total_FareAmount[$ii][$kkk])){ ?>
							<div class="innersec" onclick="show_flight_details('<?php echo $flight_data[$ii][$kkk]; ?>', '<?php echo $flight_idd[$ii][$kkk]; ?>')" <?php if ($Total_FareAmount[$ii][$kkk] == $min_val) {
									echo "style='background-color:#77ff77'";
								} else if ($Total_FareAmount[$ii][$kkk] == $second_min_val) {
									// var_dump($second_val);
									echo "style='background-color:#FFFF77'";
								} else if ($Total_FareAmount[$ii][$kkk] == $third_min_val) {
									echo "style='background-color:#FF7777'";
								} ?>>
								
								<a style="color: #000000;" href="javascript:void(0);" ><?php echo $this->display_icon." ".number_format(($Total_FareAmount[$ii][$kkk] * $this->curr_val), 2);?><?php $kkk++ ?></a>
							</div>
									
								<?php }else{ ?>
								<div class="innersec" <?php if ($Total_FareAmount[$ii][$kkk] == $min_val) {
									echo "style='background-color:#77ff77'";
								} else if ($Total_FareAmount[$ii][$kkk] == $second_min_val) {
									// var_dump($second_val);
									echo "style='background-color:#FFFF77'";
								} else if ($Total_FareAmount[$ii][$kkk] == $third_min_val) {
									echo "style='background-color:#FF7777'";
								} ?>>
									<span class="noflights">No Flights</span> <?php $kkk++ ?>
								</div>
								<?php } ?>	
						</div>
					</div>
				   <?php } ?> 
				  </div>
				<div class="clearfix"></div>
			<?php } ?>
		<?php }else{ ?>
			<?php 
				$first = min($Total_FareAmount);
				if ($first != '') {
					$first_val = $first;	
				} else {
					$first_val = 'no val';
				}
				

				$second = min(array_diff($Total_FareAmount, [$first]));
				if ($second > $first) {
					$second_val = $second;
				} else {
					$second_val = 'no val';
				}

				$third = min(array_diff($Total_FareAmount, [$first, $second]));
				if ($third > $second) {
					$third_val = $third;
				} else {
					$third_val = 'no val';
				}	
				//var_dump($first_val);var_dump($second_val);var_dump($third_val);
			?>
			<div class="col-xs-12 nopadding">
				<?php $kkk = 0;for($kk=0;$kk<4;$kk++){  ?>
				<div class="col-xs-3 nopadding">
					<?php if($kk == 0){ ?>
					<div class="col-xs-6 nopadding">
						<div class="headsec brdbtmwt">
							
						</div>
					</div>
					<?php }else{ ?>
						<div class="col-xs-6 nopadding">
							<div class="headsec <?php if($ii == 3){ echo "flighton"; } ?> ">
								Departure<br /><?php echo $converteddate_sd[$kkk++]; ?>
							</div>
						</div>
					<?php } ?>	
					<div class="col-xs-6 nopadding">
						<div class="headsec">
							Departure<br /><?php echo $converteddate_sd[$kkk++]; ?>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="clearfix"></div>
			<?php for($ii=0;$ii<1;$ii++) { ?>
				<div class="col-xs-12 nopadding">
					<?php $kkk = 0;for($kk=0;$kk<4;$kk++){  ?>
					<div class="col-xs-3 nopadding">
						<?php if($kk == 0){ ?>
						<div class="col-xs-6 nopadding">
								<div class="leftheadsec <?php if($ii == 3){ echo "flighton"; } ?> "></div>
							</div>
						<?php }else{ ?>
							<div class="col-xs-6 nopadding">
								<?php if(isset($Total_FareAmount[$kkk])){  ?>
								<div class="innersec" onclick="show_flight_details('<?php echo $flight_data[$kkk]; ?>', '<?php echo $flight_idd[$kkk]; ?>')" <?php if ($Total_FareAmount[$kkk] == $first_val) {
									echo "style='background-color:#77ff77'";
								} else if ($Total_FareAmount[$kkk] == $second_val) {
									// var_dump($second_val);
									echo "style='background-color:#FFFF77'";
								} else if ($Total_FareAmount[$kkk] == $third_val) {
									echo "style='background-color:#FF7777'";
								} ?>>
									<a style="color: #000000;" href="javascript:void(0);" ><?php echo $this->display_icon." ".number_format(($Total_FareAmount[$kkk] * $this->curr_val), 2);?><?php $kkk++ ?></a>										
								</div>
									<?php }else{ ?>
									<div class="innersec" <?php if ($Total_FareAmount[$kkk] == $first_val) {
										echo "style='background-color:#77ff77'";
									} else if ($Total_FareAmount[$kkk] == $second_val) {
										// var_dump($second_val);
										echo "style='background-color:#FFFF77'";
									} else if ($Total_FareAmount[$kkk] == $third_val) {
										echo "style='background-color:#FF7777'";
									} ?>>
										<span class="noflights">No Flights</span><?php $kkk++ ?>
									</div>
									<?php } ?>	
							</div>
						<?php } ?>
						<div class="col-xs-6 nopadding">
							<?php if(isset($Total_FareAmount[$kkk])){ ?>
							<div class="innersec" onclick="show_flight_details('<?php echo $flight_data[$kkk]; ?>', '<?php echo $flight_idd[$kkk]; ?>')" <?php if ($Total_FareAmount[$kkk] == $first_val) {
								echo "style='background-color:#77ff77'";
							} else if ($Total_FareAmount[$kkk] == $second_val) {
								// var_dump($second_val);
								echo "style='background-color:#FFFF77'";
							} else if ($Total_FareAmount[$kkk] == $third_val) {
								echo "style='background-color:#FF7777'";
							} ?>>
									<a style="color: #000000;" href="javascript:void(0);" ><?php echo $this->display_icon." ".number_format(($Total_FareAmount[$kkk] * $this->curr_val), 2);?><?php $kkk++ ?></a>									
							</div>
								<?php }else{ ?>
								<div class="innersec" <?php if ($Total_FareAmount[$kkk] == $first_val) {
									echo "style='background-color:#77ff77'";
								} else if ($Total_FareAmount[$kkk] == $second_val) {
									// var_dump($second_val);
									echo "style='background-color:#FFFF77'";
								} else if ($Total_FareAmount[$kkk] == $third_val) {
									echo "style='background-color:#FF7777'";
								} ?>>
									<span class="noflights">No Flights</span> <?php $kkk++ ?>
								</div>
								<?php } ?>	
						</div>
					</div>
				   <?php } ?> 
				  </div>
				<div class="clearfix"></div>
			<?php } ?>	
		<?php } ?>	
		</div>
	</div>
	
	<table class="table table-bordered  table_cnt" id="flight_view_details">
   
  	</table>

<style>
	/*.col70{ width:100%;}*/
	.totbrds{ min-width:1140px}

	.tooltip1 {
    position: relative;
    display: inline-block;
     z-index:1500;
   /* border-bottom: 1px dotted black;*/
}

.tooltip1 {
    position: relative;
    display: inline-block;
    /*  border-bottom: 1px dotted black;*/
}

.tooltip1 .tooltiptext1 {
    visibility:hidden;
    width:400px;
    color: #333;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    top:-15px;
    right:95px;
    z-index:1025;

}

.tooltip1 .tooltiptext55 {
    visibility:hidden;
    width:400px;
    color: #333;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    top:-15px;
    right:-404px;
    z-index:1025;

}

.tooltip1:hover .tooltiptext1 {
    visibility: visible;
}
.tooltip1:hover .tooltiptext55 {
    visibility: visible;
}
</style>
<script>
	function show_flight_details(flightdetails, flight_id){
		
		$.ajax({
			type:'POST', 
			data:{ 
				flightdetails: flightdetails,
				flight_id: flight_id,				
				rand_id: $('#rand_id').val(),
				search_id: $('#search_id').val()

			},
			url: '<?php echo site_url();?>flight/show_flight_details_ajax_calender',
			beforeSend: function(XMLHttpRequest){
				$('#flight_view_details').html('');
			}, 
			success: function(response) {
				
				$('#flight_view_details').html(response);
			}
		});
	}
	
</script>