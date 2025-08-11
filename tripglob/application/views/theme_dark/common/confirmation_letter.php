<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo PROJECT_TITLE; ?></title>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_css'); ?>
<link href="<?php echo ASSETS; ?>css/flight_result.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>css/pre_booking.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>css/voucher.css" rel="stylesheet" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .mt{
        margin-bottom: 10px;
      }

      .flect {
    color: #646464;
    display: table;
    font-size: 12px;
    margin: 0 auto auto;
    padding: 5px 10px;
    line-height: 12px;
}


.instops::after {
    background: #ed1924 none repeat scroll 0 0;
    border-radius: 5px;
    content: "";
    height: 1px;
    left: 30px;
    position: absolute;
    right: 30px;
    top: 30%;
    z-index: 0;
}
.airlinename { float: left; }

.fligthsmll img {
    width: 49px;
    float: left;
}
.tickapt{
    margin-top: 10%;
}
    </style>

</head>
<body>




<!-- Navigation -->
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
<div class="clearfix"></div>

<div class="full onlycontent top80">

<div class="full splalert">
        <div class="container offset-0">
            <div class="clearfix"></div>
            <?php
              // echo "<pre/>";print_r($pnr_nos);exit();
            	// debug($pnr_nos); exit();
				$pnr_nos_count=count($pnr_nos);
				for($p=0;$p<$pnr_nos_count;$p++)
				{	
					
              if($pnr_nos[$p]->product_name == 'FLIGHT'){
              	// debug($pnr_nos[$p]);
				   ?>
				  <div class="tickapt">
				<?php if($pnr_nos[$p]->api_name == "SABRE"){ ?>
				<?php
				  $flight = json_decode($pnr_nos[$p]->segment_data); $segment_loop_count=count($flight);
				$flight_result[0]['FlightDetails'] = json_decode($pnr_nos[$p]->segment_data,1); $segment_loop_count=count($flight);
				 // debug($flight_result); 
				 #echo '<pre/>';print_r($flight);exit;
              $booking = $this->booking_model->getBookingbyPnr($pnr_nos[$p]->pnr_no,$pnr_nos[$p]->product_name)->row(); 
				 // echo '<pre/>';print_r($flight_result);exit;
              ?>
				 <?php if($booking->booking_status !=''&& $booking->booking_status !='FAILED' && $booking->pnr_no != ''):?>
            		<div class="round_acti fa fa-check"></div>
                		<span class="confirm_mfg" style="overflow: visible;">Booking confirmed</span>
					</div>
					
				 <?php else:?>
				 	
					<div class="round_acti fa fa-times"></div>
                		<span class="confirm_mfg" style="overflow: visible;">Booking Failed</span>
					</div>
				 <?php endif;?>	     
				 <div class="row mt">
            <div class="col-md-8 col-sm-8 col-xs-12">
				
            	<div class="pre_summery">
					<?php for($i=0;$i<count($flight_result);$i++){  ?>
				 <div class="rowresult" > 
					<div class="">
					<?php   $detail_count = count($flight_result[$i]['FlightDetails']); 
						for($j=0;$j<$detail_count;$j++){  
							// debug($flight_result[$i]['FlightDetails'][$j]);
							// if(isset($flight_result[$i]['FlightDetails'][$j]['FlightDetailsID']) && $flight_result[$i]['FlightDetails'][$j]['FlightDetailsID'] != ''){
							if(true){
								$flight_id=$flight_result[$i]['FlightDetails'][$j]['FlightDetailsID']; 
								$inner_segment_len=count($flight_result[$i]['FlightDetails'][$j]['DepartureDateTime_r']) - 1; 
								// debug($flight_result[$i]['FlightDetails'][$j]);
								?>
								<div class="col-xs-12 nopad">
								<div class="sidenamedesc">
								<!-- Round trip start -->


								<div class="celhtl width20 midlbord">
								 <div class="fligthsmll">
								  <img src="https://c.fareportal.com/n/common/air/ai/<?php echo $flight_result[$i]['FlightDetails'][$j]['MarketingAirline'][0]; ?>.gif"; alt="" />
								  <div class="airlinename"><?php echo $flight_result[$i]['FlightDetails'][$j]['Airline_name'][0]; ?></div>
								</div>
								

							  </div>
							  <div class="celhtl width80">
								<div class="waymensn">

								  <div class="flitruo cloroutbnd">
								   <div class="detlnavi">
									<div class="col-xs-4 padflt widfty">
									  <span class="timlbl right">
										<span class="flname"><div class="rndplace"><?php echo $this->Flight_Model->get_airport_cityname($flight_result[$i]['FlightDetails'][$j]['OriginLocation'][0]); ?> (<?php echo  $flight_result[$i]['FlightDetails'][$j]['OriginLocation'][0]; ?>)</div> </span>
									  </span>

									  <span class="flitrlbl elipsetool"><?php echo date('M d,Y',strtotime($flight_result[$i]['FlightDetails'][$j]['DepartureDateTime_r'][0])); ?>, <span class="fltime"><?php echo date('H:i',strtotime($flight_result[$i]['FlightDetails'][$j]['DepartureDateTime_r'][0])); ?></span></span>
									  
									</div>

									<div class="col-xs-4 nopad padflt widfty">
									  <div class="lyovrtime"> 
										<span class="flect"> <span class="fa fa-clock-o"></span> <?php echo  $flight_result[$i]['FlightDetails'][$j]['final_duration'];  ?></span>
																				<div class="instops <?php if($flight_result[$i]['FlightDetails'][$j]['stops'] > 1) echo 'morestop'; if($flight_result[$i]['FlightDetails'][$j]['stops'] > 2) echo 'plusone'; ?>">
										  <a class="stopone">
											<label class="rounds"></label>
										  </a>
										  <a class="stopone">
											<label class="rounds <?php if($flight_result[$i]['FlightDetails'][$j]['stops'] != 2) echo 'oneonly'; ?>"></label>
											<label class="rounds oneplus"></label>
										  </a>
										  <a class="stopone">
											<label class="rounds"></label>
										  </a>
										</div>

									  </div>  
									</div>
									<div class="col-xs-4 padflt widfty">
									  <span class="timlbl left">
										<span class="flname"><!--<span class="sprite refltwo jj"></span>--> <div class="rndplace"><?php echo $this->Flight_Model->get_airport_cityname($flight_result[$i]['FlightDetails'][$j]['DestinationLocation'][$inner_segment_len]); ?> (<?php echo  $flight_result[$i]['FlightDetails'][$j]['DestinationLocation'][$inner_segment_len]; ?>) </div></span>

									  </span>
									  <div class="clearfix"></div>
									  <span class="flitrlbl elipsetool"><?php 
									   echo date('M d,Y',strtotime($flight_result[$i]['FlightDetails'][$j]['ArrivalDateTime_r'][$inner_segment_len]));
									   ?>, <span class="fltime"><?php echo date('H:i',strtotime($flight_result[$i]['FlightDetails'][$j]['ArrivalDateTime_r'][$inner_segment_len]));  ?></span></span>
									   
									 </div>
								   </div>
								 </div>

							   </div>
							 </div>  
						</div>
                        		
						 </div>
						<?php }  }   ?>

</div>
</div>
			<?php } ?>
				


  <div class="clearfix"></div>

               <script>
               $(function(){              
                            sendVoucherMail_flight('<?php echo $booking->pnr_no; ?>');
                        });

                </script>
               

  
</div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12  sidebuki ">
            	<div class="confrm_smmry">

                  <div class="rowfare">
                    <div class="col-xs-6 nopad"> <span class="infolbl">Booking Date </span> </div>
                    <div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo date('M d,Y', strtotime($booking->travel_date)); ?></span> </div>
                  </div>
                  <div class="rowfare">
                    <div class="col-xs-6 nopad"> <span class="infolbl">Confirmation No</span> </div>
                    <div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo $booking->pnr_no; ?></span> </div>
                  </div>
                  <div class="rowfare">
                    <div class="col-xs-6 nopad"> <span class="infolbl">Booking Status</span> </div>
                    <div class="col-xs-6 nopad"> <span class="pricelbl"><?php if($booking->pnr_no != ''){echo $booking->booking_status; } else { echo "FAILED";} ?></span> </div>
                  </div>
                </div>
                
                <div class="clearfix"></div>
                   <div class="col-md-12 col-sm-12 col-xs-6 nopad sidebuki">
                    <?php if($booking->booking_status =='CONFIRMED' && $booking->pnr_no !=""):?>
                		<a class="btn_comnbtns" href="<?php echo WEB_URL.'booking/voucher/'.base64_encode(base64_encode($booking->booking_global_id)).'/'.base64_encode(base64_encode($booking->product_id));?>" target="_blank">View voucher</a>
          			<?php endif;?>
                   <div class="clearfix"></div>
                   </div>

            </div>
            </div>
				<?php } else { ?>
				<?php
				  $flight = json_decode($pnr_nos[$p]->segment_data); $segment_loop_count=count($flight);
				$flight_result[0]['FlightDetails'] = json_decode($pnr_nos[$p]->segment_data,1); $segment_loop_count=count($flight);
				 #echo '<pre/>';print_r($flight);exit;
              $booking = $this->booking_model->getBookingbyPnr($pnr_nos[$p]->pnr_no,$pnr_nos[$p]->product_name)->row(); 
				 #echo '<pre/>';print_r($booking);exit;
              ?>
				 <?php if($booking->booking_status !=''&& $booking->booking_status !='FAILED' && $booking->pnr_no != ''):?>
            		<div class="round_acti fa fa-check"></div>
                		<span class="confirm_mfg" style="overflow: visible;">Booking confirmed</span>
					</div>
					
				 <?php else:?>
				 	
					<div class="round_acti fa fa-times"></div>
                		<span class="confirm_mfg" style="overflow: visible;">Booking Failed</span>
					</div>
				 <?php endif;?>	     
				 <div class="row mt">
				 	<?php //echo "<pre>"; print_r($pnr_nos); ?>
            <div class="col-md-8 col-sm-8 col-xs-12">
				
            	<div class="pre_summery">
					<?php for($i=0;$i<count($flight_result);$i++){  ?>
				 <div class="rowresult" > 
					<div class="">
					<?php   $detail_count = count($flight_result[$i]['FlightDetails']); 
						for($j=0;$j<$detail_count;$j++){  
							if(isset($flight_result[$i]['FlightDetails'][$j]['flightId']) && $flight_result[$i]['FlightDetails'][$j]['flightId'] != ''){
								$flight_id=$flight_result[$i]['FlightDetails'][$j]['flightId']; 
								$inner_segment_len=count($flight_result[$i]['FlightDetails'][$j]['dateOfDeparture']) - 1; ?>
								<div class="col-xs-12 nopad">
								<div class="sidenamedesc">
								<!-- Round trip start -->


								<div class="celhtl width20 midlbord">
								 <div class="fligthsmll">
								  <img src="https://c.fareportal.com/n/common/air/ai/<?php echo $flight_result[$i]['FlightDetails'][$j]['marketingCarrier'][0]; ?>.gif"; alt="" />
								  <div class="airlinename"><?php echo $flight_result[$i]['FlightDetails'][$j]['airlineName'][0]; ?></div>
								</div>
								

							  </div>
							  <div class="celhtl width80">
								<div class="waymensn">

								  <div class="flitruo cloroutbnd">
								   <div class="detlnavi">
									<div class="col-xs-4 padflt widfty">
									  <span class="timlbl right">
										<span class="flname"><div class="rndplace"><?php echo $this->Flight_Model->get_airport_cityname($flight_result[$i]['FlightDetails'][$j]['locationIdDeparture'][0]); ?> (<?php echo  $flight_result[$i]['FlightDetails'][$j]['locationIdDeparture'][0]; ?>)</div> </span>
									  </span>

									  <span class="flitrlbl elipsetool"><?php echo date('M d,Y',strtotime($flight_result[$i]['FlightDetails'][$j]['DepartureDate'][0])); ?>, <span class="fltime"><?php echo $flight_result[$i]['FlightDetails'][$j]['DepartureTime'][0];   ?></span></span>
									  
									</div>

									<div class="col-xs-4 nopad padflt widfty">
									  <div class="lyovrtime"> 
										<span class="flect"> <span class="fa fa-clock-o"></span> <?php echo  $flight_result[$i]['FlightDetails'][$j]['durationFinalEft'];  ?></span>
																				<div class="instops <?php if($flight_result[$i]['FlightDetails'][$j]['stops'] > 1) echo 'morestop'; if($flight_result[$i]['FlightDetails'][$j]['stops'] > 2) echo 'plusone'; ?>">
										  <a class="stopone">
											<label class="rounds"></label>
										  </a>
										  <a class="stopone">
											<label class="rounds <?php if($flight_result[$i]['FlightDetails'][$j]['stops'] != 2) echo 'oneonly'; ?>"></label>
											<label class="rounds oneplus"></label>
										  </a>
										  <a class="stopone">
											<label class="rounds"></label>
										  </a>
										</div>

									  </div>  
									</div>
									<div class="col-xs-4 padflt widfty">
									  <span class="timlbl left">
										<span class="flname"><!--<span class="sprite refltwo jj"></span>--> <div class="rndplace"><?php echo $this->Flight_Model->get_airport_cityname($flight_result[$i]['FlightDetails'][$j]['locationIdArival'][$inner_segment_len]); ?> (<?php echo  $flight_result[$i]['FlightDetails'][$j]['locationIdArival'][$inner_segment_len]; ?>) </div></span>

									  </span>
									  <div class="clearfix"></div>
									  <span class="flitrlbl elipsetool"><?php 
									   echo date('M d,Y',strtotime($flight_result[$i]['FlightDetails'][$j]['ArrivalDate'][$inner_segment_len]));
									   ?>, <span class="fltime"><?php echo $flight_result[$i]['FlightDetails'][$j]['ArrivalTime'][$inner_segment_len];  ?></span></span>
									   
									 </div>
								   </div>
								 </div>

							   </div>
							 </div>  
						</div>
                        		
						 </div>
						<?php }  }   ?>

</div>
</div>
			<?php } ?>
				


  <div class="clearfix"></div>

               <script>
               $(function(){              
                            sendVoucherMail_flight('<?php echo $booking->pnr_no; ?>');
                        });

                </script>
               

  
</div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12  sidebuki ">
            	<div class="confrm_smmry">

                  <div class="rowfare">
                    <div class="col-xs-6 nopad"> <span class="infolbl">Booking Date </span> </div>
                    <div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo date('M d,Y', strtotime($pnr_nos[0]->travel_date)); ?></span> </div>
                  </div>
                  <div class="rowfare">
                    <div class="col-xs-6 nopad"> <span class="infolbl">Confirmation No</span> </div>
                    <div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo $booking->pnr_no; ?></span> </div>
                  </div>
                  <div class="rowfare">
                    <div class="col-xs-6 nopad"> <span class="infolbl">Booking Status</span> </div>
                    <div class="col-xs-6 nopad"> <span class="pricelbl"><?php if($booking->booking_status =='CONFIRMED' && $booking->pnr_no !="") { echo $booking->booking_status; } else { echo "FAILED";} ?></span> </div>
                  </div>
                </div>
                
                <div class="clearfix"></div>
                   <div class="col-md-12 col-sm-12 col-xs-6 nopad sidebuki">
                    <?php if($booking->booking_status =='CONFIRMED' && $booking->pnr_no !=""):?>
                		<a class="btn_comnbtns" href="<?php echo WEB_URL.'booking/voucher/'.base64_encode(base64_encode($booking->booking_global_id)).'/'.base64_encode(base64_encode($booking->product_id));?>" target="_blank">View voucher</a>
          			<?php endif;?>
                   <div class="clearfix"></div>
                   </div>

            </div>
				</div>
				<?php } ?>
				<?php   } else if ($pnr_nos[$p]->product_name == 'CAR') {?>
					<div class="tickapt">
					
            	
				 		
				
				<?php
				  $flight = json_decode($pnr_nos[$p]->segment_data); $segment_loop_count=count($flight);
           	    $booking = $pnr_nos;
				$car_information = json_decode(base64_decode($booking->segment_data),1); 
				$segment_loop_count=count($flight);
              ?>

			 <?php if($booking[0]->booking_status =='' || $booking[0]->booking_status =='FAILED' || $booking[0]->booking_status =='PROCESS' || $booking[0]->pnr_no == ""):?>
            		
					
					<div class="round_acti fa fa-times"></div>
                		<span class="confirm_mfg" style="overflow: visible;">BOOKING <?php echo $booking[0]->booking_status;?></span>
					</div>
				 <?php else:?>
				 	<div class="round_acti fa fa-check"></div>
                		<span class="confirm_mfg" style="overflow: visible;">Booking  Confirmed</span>
					</div>
				 <?php endif;?>
			<div class="row" style="padding: 25px 0px">
				<div class="col-md-8 col-sm-8">
				<div class="pre_summery">
				  <div class="prebok_hding"> 
					  <div class="detail_htlname"><span class="left">Pick-up Location : <span class="flname"> <?php echo $voucher_data[0]->pick_up_loc; ?></span></span><span class="" style="float: right"> Drop-off Location :<span class="flname"> <?php echo $voucher_data[0]->drop_down_loc; ?></span></span></div>
				  </div>
				  <div class="sidenamedesc">
					<div class="celhtl width20 midlbord">
					  <div class="hotel_prebook"> <img src="<?php echo $voucher_data[0]->car_image; ?>" alt="" class="img-responsive" /> </div>
					</div>
					<div class="celhtl width80">
					  <div class="waymensn">
						<div class="flitruo cloroutbnd">
						  <div class="detlnavi">
							<div class="col-xs-4 padflt widfty"> <span class="timlbl right"> <span class="flname"><span class="fltime">Pick-UP</span></span> </span>
							  <div class="clearfix"></div>
							  <?php $com_pikup_date =  $voucher_data[0]->car_pick_day."-".$voucher_data[0]->car_pick_month."-".$voucher_data[0]->car_pick_year;
							  $com_drop_date =  $voucher_data[0]->car_drop_day."-".$voucher_data[0]->car_drop_month."-".$voucher_data[0]->car_drop_year;
							   ?>
							  <span class="flitrlbl elipsetool"><?php echo date('M d Y', strtotime($com_pikup_date)) ?></span>
							</div>
							<div class="col-xs-4 nopad padflt widfty">
							  <div class="lyovrtime"> <span class="flect"></span>
								<span class="flects"> <?php echo $voucher_data[0]->company_name; ?> Supplier</span> </div>
							</div>
							<div class="col-xs-4 padflt widfty"> <span class="timlbl left"> <span class="flname"><span class="fltime">Drop-off</span> </span> </span>
							  <div class="clearfix"></div>
							  <span class="flitrlbl elipsetool"><?php echo date('M d Y', strtotime($com_drop_date)) ?></span>
							</div>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
				</div>
					<div class="col-md-4 col-sm-4 nopad sidebuki">
						<div class="confrm_smmry">
						  <div class="rowfare">
							<div class="col-xs-6 nopad"> <span class="infolbl">Booking Date </span> </div>
							<div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo date('M d,Y', strtotime($booking[0]->travel_date)); ?></span> </div>
						  </div>
						  <div class="rowfare">
							<div class="col-xs-6 nopad"> <span class="infolbl">Confirmation No</span> </div>
							<div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo $booking[0]->con_pnr_no; ?></span> </div>
						  </div>

						  <div class="rowfare">
							<div class="col-xs-6 nopad"> <span class="infolbl">PNR No</span> </div>
							<div class="col-xs-6 nopad"> <span class="pricelbl">
						<?php if($booking[0]->booking_status =='CONFIRMED' && $booking[0]->pnr_no != "")
						: echo $booking[0]->pnr_no; ?></span> </div>
						  </div>

						  <div class="rowfare">
							<div class="col-xs-6 nopad"> <span class="infolbl">Booking Status</span> </div>
							<div class="col-xs-6 nopad"> <span class="pricelbl"><?php if($booking->booking_status == "PROCESS" || $booking[0]->booking_status =="FAILED" || $booking[0]->booking_status == " " ){ echo "FAILED" ;} else { echo $booking[0]->booking_status; }; ?></span> </div>
						  </div>
						</div>
						<div class="clearfix"></div>
							<a class="btn_comnbtns" href="<?php echo WEB_URL.'booking/voucher/'.base64_encode(base64_encode($booking->booking_global_id)).'/'.base64_encode(base64_encode($booking->product_id));?>" target="_blank">View voucher</a>
						<?php endif;?>
					</div>
				</div>
				<?php } else if($pnr_nos[$p]->product_name == 'HOTEL'){ 
				     //echo '<pre>';print_r($pnr_nos[$p]);exit();
				   $booking = $this->booking_model->getBookingbyPnr_Hotel($pnr_nos[$p]->parent_pnr_no,$pnr_nos[$p]->product_name)->row();
				   // debug(json_decode(base64_decode($booking->hotel_details),1));exit();
				   $pnrdata = $this->cart_model->getBookingTemphotel($booking->cart_id);
				    //echo '<pre>';print_r($pnrdata);exit();
				   $CI = & get_instance();
                   $CI->load->model('hotel_model');
                   $hotel_data = $CI->hotel_model->get_hotel_other_details($pnrdata->HotelCode,$pnrdata->session_id);
                   $hotel_data = json_decode(base64_decode($booking->hotel_details),1);
				   // debug($hotel_data[]);exit();
                   
                   $star = $hotel_data['star_rating'];
                   
                    if (Is_numeric($star[0])) { $star_rating = $star[0]; } else { $star_rating = '0'; } 
                    $hotelimage =  trim($hotel_data['images'],'"');
                    
                    $hotel_request =json_decode(base64_decode(unserialize(json_decode(base64_decode($booking->hotel_details),1)['request'])),1)  ;
                    
                   // debug($booking->cancel_policy);
                   // debug($hotel_request);exit();
                    
                    if ($hotel_request['rooms'] > 0) {
                        $roomcnt = $hotel_request['rooms'];
                        $adult = array_sum($hotel_request['adult']);
                        $child = array_sum($hotel_request['child']);
                      } else {
                        $roomcnt = 0;
                        $adult = 0;
                        $child = 0;
                    }
                   
				   
			if($pnr_nos_count==1){ ?>
			 <div class="tickapt">
            	 <?php if($booking->booking_status !='' && $booking->booking_status !='FAILED' && $booking->pnr_no != ''):?>
            		
					
					<div class="round_acti fa fa-check"></div>
                		<span class="confirm_mfg" style="overflow: visible;">Booking confirmed</span>
					</div>
				 <?php else:?>
				 	<div class="round_acti fa fa-times"></div>
                		<span class="confirm_mfg" style="overflow: visible;">Booking Failed</span>
					</div>
				 <?php endif;?>	
				<?php
			} ?>
			<div class="row">
				<div class="col-md-8 col-sm-8">
				<div class="pre_summery">
                              <div class="prebok_hding"> 
                                  <div class="detail_htlname"><?php echo $hotel_data['HotelName']; ?></div>
                                  <div class="star_detail">
                                        <div data-star="<?php echo $star_rating; ?>" class="stra_hotel">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                    </div>
                              </div>
                              <div class="sidenamedesc">
                                <div class="celhtl width20 midlbord">
                                  <div class="hotel_prebook 55"> 
                    
                                  <?php if($hotelimage):?>
                                    <img style="max-width: 112px;min-width: 112px;" src="<?php echo $hotelimage; ?>" alt="" />
                                  <?php else:?>
                                    <img style="width:160px;height:107px;" src="<?php echo base_url().'assets/theme_dark/images/no_image_available.jpg'?>" alt="" />
                                  <?php endif;?>
                                   </div>
                                </div>
                                <div class="celhtl width80">
                                  <div class="waymensn">
                                    <div class="flitruo cloroutbnd">
                                      <div class="detlnavi">
                                        <div class="col-xs-4 padflt widfty"> <span class="timlbl right"> <span class="flname"><span class="fltime">Check-in</span></span> </span>
                                          <div class="clearfix"></div>
                                          <span class="flitrlbl elipsetool"><?php echo date('M d,Y', strtotime($hotel_request['hotel_checkin'])); ?></span>
                                        </div>
                                        <div class="col-xs-4 nopad padflt widfty">
                                          <div class="lyovrtime"> <span class="flect"><?php echo $adult+$child; ?> Passenger(s)</span>
                                            
                                            <span class="flects"> <?php echo $roomcnt; ?> Room(s)</span> </div>
                                        </div>
                                        <div class="col-xs-4 padflt widfty"> <span class="timlbl left"> <span class="flname"><span class="fltime">Check-out</span> </span> </span>
                                          <div class="clearfix"></div>
                                          <span class="flitrlbl elipsetool"><?php echo date('M d,Y', strtotime($hotel_request['hotel_checkout'])); ?></span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                 <div class="celhtl width100">
                                  <div class="waymensn" style="padding:10px">
                                <span class="fltime">Cancellation Policy : </span> <?php  if (empty(json_decode($booking->cancel_policy,1))) {
                                             echo "Non Refundable";
                                           } else {
                                             foreach(json_decode($booking->cancel_policy,1) as $key_c =>$CancellationPolicyy){
                                                foreach( $CancellationPolicyy as $key_c => $CancellationPolicy){

                                                if ($CancellationPolicy['ChargeType'] == 2) {
                                                $ChargeType='Percentage';
                                                }elseif ($CancellationPolicy['ChargeType'] == 1) {
                                                $ChargeType='Amount';
                                                }else{
                                                $ChargeType='Nights';                                       
                                                }
                                                echo 'From now until the start date of travel '.str_replace('T', ' ', $CancellationPolicy['ToDate']).'  : '.$CancellationPolicy['Charge'] .' '.$ChargeType.' '.$CancellationPolicy['Currency'].' of expenses <br>';
                                                }
                                             }
                                        } ?>
                                
                               <br>
                               Note : Date and time depents on hotel destination.
                                <?php
                          if($cart->comment!='')
                          {
                            ?>
                                <br> <br><span class="fltime">Hotel Remarks : </span> <?php echo $cart->comment; ?>
                                <?php
                          }
                          ?>
                                 </div>
                                 </div>
                              </div>
                            </div>
				</div>
				
					<div class="col-md-4 col-sm-4 nopad sidebuki">
						<div class="confrm_smmry">
						  <div class="rowfare">
							<div class="col-xs-6 nopad"> <span class="infolbl">Booking Date </span> </div>
							<div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo date('M d,Y', strtotime($booking->travel_date)); ?></span> </div>
						  </div>
						  <div class="rowfare">
							<div class="col-xs-6 nopad"> <span class="infolbl">Confirmation No</span> </div>
							<div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo $booking->pnr_no; ?></span> </div>
						  </div>
						  <div class="rowfare">
							<div class="col-xs-6 nopad"> <span class="infolbl">Booking Status</span> </div>
							<div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo ($pnr_nos[$p]->pnr_no != "") ? $booking->booking_status : "FAILED"; ?></span> </div>
						  </div>
						</div>
						<div class="clearfix"></div>
						<?php if($pnr_nos[$p]->pnr_no != ""):?>
							<a class="btn_comnbtns" href="<?php echo WEB_URL.'booking/voucher/'.base64_encode(base64_encode($booking->booking_global_id)).'/'.base64_encode(base64_encode($booking->product_id));?>" target="_blank">View voucher</a>
						<?php endif;?>
					</div>
				</div>
			  <?php   
				}elseif($pnr_nos[$p]->product_name == 'ACTIVITY'){  
					#@echo "<pre/>"; print_r($pnr_nos);die;
				   $booking = $this->booking_model->getBookingbyPnr_sight($pnr_nos[$p]->parent_pnr_no,$pnr_nos[$p]->product_name)->row();
				   #echo $this->db->last_query();
				  // echo "<pre/>";print_r($booking);die;
				   $pnrdata = $this->cart_model->getBookingTemp_SIGHTSEEING($booking->referal_id);
				   $image=json_decode(base64_decode($booking->detail_response));
				  # echo "<pre/>";print_r($image);die;
				   if(isset($image->ProductImage) && $image->ProductImage!=""){ 
					   #$himages= explode(',', $pnrdata->ProductImage); 
					   $himages= $image->ProductImage; 
					}
					else{
						$himages='';
					}
			            $act_det=json_decode(base64_decode($booking->detail_response));
			            $act_room=json_decode(base64_decode($booking->response));
			if($pnr_nos_count==1){ ?>
			 <div class="tickapt">
            	 <?php if($booking->booking_status !='' && $booking->booking_status !='FAILED'):?>
            		
					
					<div class="round_acti fa fa-check"></div>
                		<span class="confirm_mfg" style="overflow: visible;">Booking confirmed</span>
					</div>
				 <?php else:?>
				 	<div class="round_acti fa fa-times"></div>
                		<span class="confirm_mfg" style="overflow: visible;">Booking Failed</span>
					</div>
				 <?php endif;?>
				<?php
			} ?>
			<div class="row">
				<div class="col-md-8 col-sm-8">
				<div class="pre_summery">
				  <div class="prebok_hding"> 
					  <div class="detail_htlname"><?php echo $image->ProductName; ?></div>
					  <div class="star_detail">
							<?php $star = $image->StarRating;
							if (Is_numeric($star)) { $star_rating = $star; } else { $star_rating = '0'; } ?>
							<div data-star="<?php echo $star_rating; ?>" class="stra_hotel">
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
						</div>
				  </div>
				  <div class="sidenamedesc">
					<div class="celhtl width20 midlbord">
					  <div class="hotel_prebook"> <img src="<?php echo $himages; ?>" alt="" /> </div>
					</div>
					<div class="celhtl width80">
					  <div class="waymensn">
						<div class="flitruo cloroutbnd">
						  <div class="detlnavi">
							<div class="col-xs-4 padflt widfty"> <span class="timlbl right"> <span class="flname"><span class="fltime">Duration</span></span> </span>
							  <div class="clearfix"></div>
							  <span class="flitrlbl elipsetool"><?php echo $act_det->Duration; ?></span>
							</div>
							<div class="col-xs-4 nopad padflt widfty">
							  <div class="lyovrtime"> <span class="flect"><?php echo $act_room->BlockTrip->BlockTripResult->Destination; ?></span>
								<!-- <span class="flects"> <?php #echo array_sum($rooms); ?> Room(s)</span>  --></div>
							</div>
							<div class="col-xs-4 padflt widfty"> <span class="timlbl left"> <span class="flname"><span class="fltime">Booking Date</span> </span> </span>
							  <div class="clearfix"></div>
							  <span class="flitrlbl elipsetool"><?php echo date('M d,Y', strtotime($act_room->BlockTrip->BlockTripResult->BookingDate)); ?></span>
							</div>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
				</div>
					<div class="col-md-4 col-sm-4 nopad sidebuki">
						<div class="confrm_smmry">
						  <div class="rowfare">
							<div class="col-xs-6 nopad"> <span class="infolbl">Booking Date </span> </div>
							<div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo date('M d,Y', strtotime($act_room->BlockTrip->BlockTripResult->BookingDate)); ?></span> </div>
						  </div>
						  <div class="rowfare">
							<div class="col-xs-6 nopad"> <span class="infolbl">Confirmation No</span> </div>
							<div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo $booking->pnr_no; ?></span> </div>
						  </div>
						  <div class="rowfare">
							<div class="col-xs-6 nopad"> <span class="infolbl">Booking Status</span> </div>
							<div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo $booking->booking_status; ?></span> </div>
						  </div>
						</div>
						<div class="clearfix"></div>
						<?php if( $booking->booking_status!='FAILED'):?>
							<a class="btn_comnbtns" href="<<?php echo WEB_URL.'booking/voucher/'.base64_encode(base64_encode($booking->booking_global_id)).'/'.base64_encode(base64_encode($booking->product_id));?>" target="_blank">View voucher</a>
						<?php endif;?>
					</div>
				</div>
			  <?php }elseif($pnr_nos[$p]->product_name == 'TRANSFER'){  
				   $booking = $this->booking_model->getBookingbyPnr_sight($pnr_nos[$p]->parent_pnr_no,$pnr_nos[$p]->product_name)->row();
				   #echo "<pre/>";print_r($booking);die;
				   $pnrdata = $this->cart_model->getBookingTemp_transfer_booking($booking->referal_id);
				  # echo $this->db->last_query();die;
				   $image=json_decode(base64_decode($pnrdata->detail_response));
				   if(isset($image->ProductImage) && $image->ProductImage!=""){ 
					   #$himages= explode(',', $pnrdata->ProductImage); 
					   $himages= $image->ProductImage; 
					}
					else{
						$himages='';
					}
			            $act_det=json_decode(base64_decode($booking->detail_response));
			            $act_room=json_decode(base64_decode($booking->response));

			if($pnr_nos_count==1){ ?>
			 <div class="tickapt">
            	 <?php if($booking->booking_status !='FAILED'):?>
            		
					
					<div class="round_acti fa fa-check"></div>
                		<span class="confirm_mfg" style="overflow: visible;">Booking confirmed</span>
					</div>
				 <?php else:?>
				 	<div class="round_acti fa fa-times"></div>
                		<span class="confirm_mfg" style="overflow: visible;">Booking Failed</span>
					</div>
				 <?php endif;?>
				<?php
			} ?>
			<div class="row">
				<div class="col-md-8 col-sm-8">
				<div class="pre_summery">
				  <div class="prebok_hding"> 
					  <div class="detail_htlname"><?php echo $image->ProductName; ?></div>
					  <div class="star_detail">
							<?php $star = $image->StarRating;
							if (Is_numeric($star)) { $star_rating = $star; } else { $star_rating = '0'; } ?>
							<div data-star="<?php echo $star_rating; ?>" class="stra_hotel">
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
						</div>
				  </div>
				  <div class="sidenamedesc">
					<div class="celhtl width20 midlbord">
					  <div class="hotel_prebook"> <img src="<?php echo $himages; ?>" alt="" /> </div>
					</div>
					<div class="celhtl width80">
					  <div class="waymensn">
						<div class="flitruo cloroutbnd">
						  <div class="detlnavi">
							<div class="col-xs-4 padflt widfty"> <span class="timlbl right"> <span class="flname"><span class="fltime">Duration</span></span> </span>
							  <div class="clearfix"></div>
							  <span class="flitrlbl elipsetool"><?php echo $act_det->Duration; ?></span>
							</div>
							<div class="col-xs-4 nopad padflt widfty">
							  <div class="lyovrtime"> <span class="flect"><?php echo $act_room->BlockTrip->BlockTripResult->Destination; ?></span>
								<!-- <span class="flects"> <?php #echo array_sum($rooms); ?> Room(s)</span>  --></div>
							</div>
							<div class="col-xs-4 padflt widfty"> <span class="timlbl left"> <span class="flname"><span class="fltime">Travel Date</span> </span> </span>
							  <div class="clearfix"></div>
							  <span class="flitrlbl elipsetool"><?php echo date('M d,Y', strtotime($act_room->BlockTrip->BlockTripResult->BookingDate)); ?></span>
							</div>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
				</div>
					<div class="col-md-4 col-sm-4 nopad sidebuki">
						<div class="confrm_smmry">
						  <div class="rowfare">
							<div class="col-xs-6 nopad"> <span class="infolbl">Travel Date </span> </div>
							<div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo date('M d,Y', strtotime($act_room->BlockTrip->BlockTripResult->BookingDate)); ?></span> </div>
						  </div>
						  <div class="rowfare">
							<div class="col-xs-6 nopad"> <span class="infolbl">Confirmation No</span> </div>
							<div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo $booking->pnr_no; ?></span> </div>
						  </div>
						  <div class="rowfare">
							<div class="col-xs-6 nopad"> <span class="infolbl">Booking Status</span> </div>
							<div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo $booking->booking_status; ?></span> </div>
						  </div>
						</div>
						<div class="clearfix"></div>
						<?php if($booking->booking_status !='FAILED'):?>
							<a class="btn_comnbtns" href="<?php echo WEB_URL.'booking/voucher/'.base64_encode(base64_encode($booking->booking_global_id)).'/'.base64_encode(base64_encode($booking->product_id));?>" target="_blank">View voucher</a>
						<?php endif;?>
					</div>
				</div>
			  <?php   
				}else if($pnr_nos[$p]->product_name == 'BUS'){ 
				     //echo '<pre>';print_r($pnr_nos[$p]);exit();
				   $booking = $this->booking_model->getBookingbyPnr_Bus($pnr_nos[$p]->parent_pnr_no,$pnr_nos[$p]->product_name)->row();
				   //echo '<pre>';print_r($booking);exit();
				   $pnrdata = $this->cart_model->getBookingTempbus($booking->global_id);
				    //echo '<pre>';print_r($pnrdata);exit();

				   /*debug($booking);
				  debug($pnrdata); */
				   $booking_all_details = $this->cart_model->getBookingDetailsBus($booking->global_id, 'Get_Booking_Det');
				   $block_all_details = $this->cart_model->getBookingDetailsBus($booking->global_id, 'Block_Seat');
				   
				   $booking_details = json_decode($booking_all_details->response, true);
				   $block_details = json_decode($block_all_details->response, true);
				   $CancelPolicy = $block_details['BlockResult']['CancelPolicy'];
				   $Itinerary = $booking_details['GetBookingDetailResult']['Itinerary'];
				   $Passenger = $booking_details['GetBookingDetailResult']['Itinerary']['Passenger'];
				//   debug($booking_details); 
				//   debug($CancelPolicy); exit();
				    
				   $CI = & get_instance();
                   $CI->load->model('hotel_model');
                   /*$hotel_data = $CI->hotel_model->get_hotel_other_details($pnrdata->HotelCode,$pnrdata->session_id);
                   $hotel_data = $hotel_data[0];*/
                   
                   $star = $hotel_data['star_rating'];
                   
                    if (Is_numeric($star[0])) { $star_rating = $star[0]; } else { $star_rating = '0'; } 
                    $hotelimage =  trim($hotel_data['images'],'"');
                    
                    $hotel_request = unserialize($hotel_data['request']);
                    
                   // echo '<pre>';print_r($hotel_request);exit();
                    
                    if ($hotel_request['rooms'] > 0) {
                        $roomcnt = $hotel_request['rooms'];
                        $adult = array_sum($hotel_request['adult']);
                        $child = array_sum($hotel_request['child']);
                      } else {
                        $roomcnt = 0;
                        $adult = 0;
                        $child = 0;
                    }
                   
				   
			if($pnr_nos_count==1){ ?>
				<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_css'); ?>
				<link href="<?php echo ASSETS; ?>css/voucher.css" rel="stylesheet" />
			 <div class="tickapt">
            	 <?php if($booking->booking_status !='' && $booking->booking_status !='FAILED' && $booking->pnr_no != ''):?>
            		
					
					<div class="round_acti fa fa-check"></div>
                		<span class="confirm_mfg" style="overflow: visible;">Booking confirmed</span>
					</div>
				 <?php else:?>
				 	<div class="round_acti fa fa-times"></div>
                		<span class="confirm_mfg" style="overflow: visible;">Booking Failed</span>
					</div>
				 <?php endif;?>	
				<?php
			} ?>
			<div class="clearfix"></div> 
			<div class="col-md-8 new_ceneterd">
			<section class="new_voucher_hed">
			   
			<div class="col-md-6"><img src="http://provabtech.com/tripglobo/assets/theme_dark/images/logo.png"></div>
			<div class="col-md-6">
			   <ul>
			      <li>Booking Reference : <strong><?=$booking->parent_pnr_no ?></strong></li>
			      <li>Booking Date : <strong><?=$booking->booking_timestamp ?></strong></li>
			      
			   </ul>
			</div>
			<div class="col-md-12">
			   <hr>  
			   <h4>status <strong><?=$booking->booking_status ?></strong></h4>
			   <hr>
			</div> 
			<div class="clearfix"> </div>
			<div class="col-md-12 " style="float: none; margin: 35px auto;">
			<div class="col-md-12 brd_r">
			   <h5>Reservation Ticket (<?=$booking->origin_city ?> to <?=$booking->destination_city ?>)</h5>
			   <div class="col-md-4">
			      <label><?=$Itinerary['TravelName'] ?></label>
			      <span><?=$Itinerary['BusType'] ?></span>
			   </div>
			    <div class="col-md-3">
			      <label>Ticket Booking</label>
			      <span><?=$booking->origin_city ?> to <?=$booking->destination_city ?></span>
			   </div>
			    <div class="col-md-2">
			      <label>Booking Id</label>
			      <span><?=$Itinerary['TicketNo'] ?></span>
			   </div>

			 <div class="col-md-3">
			      <label>Boarding Pickup Time</label>
			      <span><?=$Itinerary['BoardingPointdetails']['CityPointTime'] ?></span>
			   </div>


			   </div>

			<div class="clearfix">  </div>
			<div class="col-md-12 " style="float: none; margin: 35px auto; padding: 0px;">
			<div class="col-md-12 brd_s"> 
			   <h5>Travel (s) Information</h5>
			   <?php
			   	foreach ($Passenger as $pkey => $pvalue) {
			   		
			   	
			    ?>
			   	<div class="col-md-2">
			      <!-- <label>Sr.No</label> -->
			      <span><?=$pkey+1?></span>
			   	</div>
			    <div class="col-md-6">
			      <!-- <label>Passenger(s) Name</label> -->
			      <span><?=$pvalue['FirstName'].' '.$pvalue['LastName']?></span>
			   	</div>
			    <div class="col-md-2">
			      <!-- <label>Gender</label> -->
			      <span><?php
			      		if($pvalue['Gender'] == 1){
			      			echo "Male";
			      		}else{
			      			echo "Female";
			      		}
			      	?></span>
			   	</div>

				<div class="col-md-2">
			      <!-- <label>Seat No</label> -->
			      <span><?=$pvalue['Seat']['SeatName']?></span>
			   	</div>
			   	<?php 
			   }
			   	 ?>


			   </div>


			<div class="clearfix">  </div>
			<div class="col-md-12 " style="float: none; margin: 35px auto; padding: 0px;">
			<div class="col-md-4 brd_sa">  
			   <div class="col-md-6 nopad"><h5>Payment Details</h5></div>
			   <div class="col-md-6 nopad"><h5 class="new_on">Amout (Rs)</h5></div>
			   
			   <div class="col-md-12 nopad">
			  <div class="col-md-6 nopad"><span>Base fare</span></div>   
			  <div class="col-md-6 nopad"><span><?=$booking->admin_baseprice ?> </span></div>   
			  

			  <div class="col-md-6 nopad"><span>gst</span></div>   
			  <div class="col-md-6 nopad"><span></span></div>   

			  <div class="col-md-6 nopad"><span>Discount</span></div>   
			  <div class="col-md-6 nopad"><span>0</span></div>   

			 <div class="col-md-6 nopad"><h6>Total Fare</h6></div>   
			 <div class="col-md-6 nopad"><h6><?=$booking->amount ?> </h6></div>   
			  

			   </div>
			  


			   </div>
			<div class="col-md-1"> </div>
			   <div class="col-md-7 brd_sa">  
			   <div class="col-md-12 nopad"><h5>Cancellation Policy</h5></div>
			    <div class="col-md-12 nopad">
			  <div class="col-md-8 nopad"><span>Cancellation Time</span></div>   
			  <div class="col-md-4 nopad"><span>Cancellation Charges</span></div>   
			  </div>
			    <?php
			   	foreach ($CancelPolicy as $ckey => $cvalue) {
			    ?>
			  <div class="col-md-12 nopad">
			  

			  <div class="col-md-8 nopad"><span><?=$cvalue['PolicyString']?></span></div>   
			  <div class="col-md-4 nopad"><span><?=$cvalue['CancellationCharge']?></span></div>   

			  <!--<div class="col-md-8 nopad"><span><?=$cvalue['PolicyString']?></span></div>   -->
			  <!--<div class="col-md-4 nopad"><span>80%</span></div>   -->

			   </div>
			   <?php } ?>
			  


			   </div>


			<div class="clearfix">  </div>
			<div class="col-md-12 " style="float: none; margin: 35px auto; padding: 0px;">
			<div class="col-md-12 brd_sa">  
			   <div class="col-md-6 nopad"><h5>Payment Type</h5></div>
			   <div class="col-md-6 nopad"><h5 class="new_on">Amout (Rs)</h5></div>
			   
			   <div class="col-md-12 nopad">
			  <div class="col-md-6 nopad"><span>pay throught payment gateway</span></div>   
			  <div class="col-md-6 nopad"><span><?=$booking->total_amount ?></span></div>   
			  

			  

			 <div class="col-md-6 nopad"><h6>Grand Fare</h6></div>   
			 <div class="col-md-6 nopad"><h6><?=$booking->total_amount ?></h6></div>   
			  

			   </div>
			  


			   </div>
			</div>

			</div>
			</section>
			</div>

			<div class="clearfix"></div>
			<!-- <div class="row">
				<div class="col-md-8 col-sm-8">
				<div class="pre_summery">
                              <div class="prebok_hding"> 
                                  <div class="detail_htlname"><?php echo $hotel_data['HotelName']; ?></div>
                                  <div class="star_detail">
                                        <div data-star="<?php echo $star_rating; ?>" class="stra_hotel">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                    </div>
                              </div>
                              <div class="sidenamedesc">
                                <div class="celhtl width20 midlbord">
                                  <div class="hotel_prebook 55"> 
                    
                                  <?php if($hotelimage):?>
                                    <img style="max-width: 112px;min-width: 112px;" src="<?php echo $hotelimage; ?>" alt="" />
                                  <?php else:?>
                                    <img style="width:160px;height:107px;" src="<?php echo base_url().'assets/theme_dark/images/no_image_available.jpg'?>" alt="" />
                                  <?php endif;?>
                                   </div>
                                </div>
                                <div class="celhtl width80">
                                  <div class="waymensn">
                                    <div class="flitruo cloroutbnd">
                                      <div class="detlnavi">
                                        <div class="col-xs-4 padflt widfty"> <span class="timlbl right"> <span class="flname"><span class="fltime">Check-in</span></span> </span>
                                          <div class="clearfix"></div>
                                          <span class="flitrlbl elipsetool"><?php echo date('M d,Y', strtotime($hotel_request['hotel_checkin'])); ?></span>
                                        </div>
                                        <div class="col-xs-4 nopad padflt widfty">
                                          <div class="lyovrtime"> <span class="flect"><?php echo $adult+$child; ?> Passenger(s)</span>
                                            
                                            <span class="flects"> <?php echo $roomcnt; ?> Room(s)</span> </div>
                                        </div>
                                        <div class="col-xs-4 padflt widfty"> <span class="timlbl left"> <span class="flname"><span class="fltime">Check-out</span> </span> </span>
                                          <div class="clearfix"></div>
                                          <span class="flitrlbl elipsetool"><?php echo date('M d,Y', strtotime($hotel_request['hotel_checkout'])); ?></span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                 <div class="celhtl width100">
                                  <div class="waymensn" style="padding:10px">
                                <span class="fltime">Cancellation Policy : </span> <?php echo $cancelpolicy[0]['cancel_policy']; ?>
                                
                               <br>
                               Note : Date and time depents on hotel destination.
                                <?php
                          if($cart->comment!='')
                          {
                            ?>
                                <br> <br><span class="fltime">Hotel Remarks : </span> <?php echo $cart->comment; ?>
                                <?php
                          }
                          ?>
                                 </div>
                                 </div>
                              </div>
                            </div>
				</div>
				
					<div class="col-md-4 col-sm-4 nopad sidebuki">
						<div class="confrm_smmry">
						  <div class="rowfare">
							<div class="col-xs-6 nopad"> <span class="infolbl">Booking Date </span> </div>
							<div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo date('M d,Y', strtotime($booking->travel_date)); ?></span> </div>
						  </div>
						  <div class="rowfare">
							<div class="col-xs-6 nopad"> <span class="infolbl">Confirmation No</span> </div>
							<div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo $booking->pnr_no; ?></span> </div>
						  </div>
						  <div class="rowfare">
							<div class="col-xs-6 nopad"> <span class="infolbl">Booking Status</span> </div>
							<div class="col-xs-6 nopad"> <span class="pricelbl"><?php echo ($pnr_nos[$p]->pnr_no != "") ? $booking->booking_status : "FAILED"; ?></span> </div>
						  </div>
						</div>
						<div class="clearfix"></div>
						<?php if($pnr_nos[$p]->pnr_no != ""):?>
							<a class="btn_comnbtns" href="<?php echo WEB_URL.'booking/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank">View voucher</a>
						<?php endif;?>
					</div>
				</div> -->
			  <?php   
				}else{
					?>
						<div class="tickapt">
							<div class="round_acti fa fa-check"></div>
							<span class="confirm_mfg">Booking Not Done</span>
						</div>
						<?php
					}
			}
			?> 



<!--<div class="full contentvcr">
        <div class="container offset-0">
            <div class="rowitbk left">
            	<ul id="user_bookings">
                
                  <?php foreach($pnr_nos as $pnr_no){
					  
					  
					   if($pnr_no->product_name == 'FLIGHT'){
                        $booking = $this->booking_model->getBookingbyPnr($pnr_no->pnr_no,$pnr_no->product_name)->row();
                  
						$request->type='O';
				if ($request->type == 'O') {
				  ?>
                  <li class="bookingli">
                    <div class="bookingicon <?php echo 'p_'.strtolower($pnr_no->product_name);?>"></div>
                    
                    <div class="tablofcon">
                    <div class="col-md-7 concell"> 
                        <div class="onwyrow">
                           
                            <div class="col-md-3">
                                <span class="radiobtn">Arrival</span>
                                <span class="norto"><?php echo date('d M, D Y', strtotime($booking->outward_arrival));?></span>
                                <span class="norto lbold"><?php echo date('H:i', strtotime($booking->outward_arrival));?></span>
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-5 offset-0 concell litgrycell">
                            <div class="topfisconf">
                            <div class="col-md-12 nopad">
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux">Reservation Date</div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux">Confirmation No</div>
                                     </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo $booking->pnr_no;?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux nomarb">Booking Status</div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux nomarb"> <?php echo $booking->booking_status;?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 nopad">
                        <div class="botufis">
                               <a title="MAil Voucher " onclick="flight_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Edit Voucher">
                                          <i class="icon-envelope"></i>Mail Vocuher  <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                        </a>
                                
                                <a href="<?php echo WEB_URL.'/flight/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View Voucher>" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Voucher">
                                    <i class="icon-ticket"></i>View Voucher
                                </a>

                               
                                <a class="left">
                               
                                  </a>
                                
                         </div>

                    </div>
                            </div>
                     
                    </div>
                    
                    </div>

                    <div class="clearfix"></div>
                  </li>
                  <?php 
                    }else if ($request->type == 'R') {
                    $flight = json_decode(base64_decode($booking->response));
                    $onward_first_seg = reset($flight->onward->segments);
                    $onward_last_seg = end($flight->onward->segments);
                    $return_first_seg = reset($flight->return->segments);
                    $return_last_seg = end($flight->return->segments);
                    $onward_fromCityName =  $this->flight_model->get_airport_cityname($onward_first_seg->Origin);
                    $onward_toCityName =  $this->flight_model->get_airport_cityname($onward_last_seg->Destination);

                    $return_fromCityName =  $this->flight_model->get_airport_cityname($return_first_seg->Origin);
                    $return_toCityName =  $this->flight_model->get_airport_cityname($return_last_seg->Destination);

                    $onward_DepartureDateTime = $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime);
                    $onward_ArrivalDateTime = $this->flight_model->get_unixtimestamp($onward_first_seg->ArrivalTime);

                    $return_DepartureDateTime = $this->flight_model->get_unixtimestamp($return_first_seg->DepartureTime);
                    $return_ArrivalDateTime = $this->flight_model->get_unixtimestamp($return_first_seg->ArrivalTime);
                  ?>
                  <li class="bookingli">
                    <div class="bookingicon <?php echo 'p_'.strtolower($booking->module);?>"></div>
                    
                    <div class="tablofcon">
                    <div class="col-md-7 concell"> 
                        <div class="onwyrow">
                        <div class="fblueline22 linegreen">
                             <b><?php echo $onward_fromCityName;?></b> (<?php echo $onward_first_seg->Origin;?>) 
                             <span class="farrow"></span> 
                             <b><?php echo $onward_toCityName;?></b> (<?php echo $onward_last_seg->Destination;?>)
                        </div>
                        <div class="col-md-2">
                            <div class="flitsecimg">
                                <img alt="" id="FF219160" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $onward_first_seg->Carrier;?>.gif">
                                <span class="nortosimle textcentr"><?php echo $this->lang->line('CV_Air_India'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="radiobtn rittextalign"><?php echo $this->lang->line('CV_Departure'); ?></div>
                            <span class="norto rittextalign"><?php echo date('d M, D Y', $onward_DepartureDateTime);?></span>
                            <span class="norto lbold rittextalign"><?php echo date('H:i', $onward_DepartureDateTime);?></span>
                        </div>
                        <div class="col-md-1 nopad">
                            <div class="flightimgs">
                                <img alt="" src="<?php echo ASSETS;?>images/departure.png">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <span class="radiobtn"><?php echo $this->lang->line('CV_Arrival'); ?></span>
                            <span class="norto"><?php echo date('d M, D Y', $onward_ArrivalDateTime);?></span>
                            <span class="norto lbold"><?php echo date('H:i', $onward_ArrivalDateTime);?></span>
                        </div>
                        <div class="col-md-3 nopad">
                            <span class="radiobtn"><?php echo $this->lang->line('CV_Duration'); ?></span>
                            <span class="norto"><?php echo $this->lang->line('CV_Economy'); ?></span>
                            <span class="norto lbold"><?php //echo $dur;?></span>
                        </div>
                    </div>  
                        
                        <div class="onwyrow">
                        <div class="fblueline22 linegreen">
                             <b><?php echo $return_fromCityName;?></b> (<?php echo $return_first_seg->Origin;?>) 
                             <span class="farrow"></span> 
                             <b><?php echo $return_toCityName;?></b> (<?php echo $return_last_seg->Destination;?>)
                        </div>
                        <div class="col-md-2">
                            <div class="flitsecimg">
                                <img alt="" id="FF219160" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $return_first_seg->Carrier;?>.gif">
                                <span class="nortosimle textcentr"><?php echo $this->lang->line('CV_Air_India'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="radiobtn rittextalign"><?php echo $this->lang->line('CV_Departure'); ?></div>
                            <span class="norto rittextalign"><?php echo date('d M, D Y', $return_DepartureDateTime);?></span>
                            <span class="norto lbold rittextalign"><?php echo date('H:i', $return_DepartureDateTime);?></span>
                        </div>
                        <div class="col-md-1 nopad">
                            <div class="flightimgs">
                                <img alt="" src="<?php echo ASSETS;?>images/departure.png">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <span class="radiobtn"><?php echo $this->lang->line('CV_Arrival'); ?></span>
                            <span class="norto"><?php echo date('d M, D Y', $return_ArrivalDateTime);?></span>
                            <span class="norto lbold"><?php echo date('H:i', $return_ArrivalDateTime);?></span>
                        </div>
                        <div class="col-md-3 nopad">
                            <span class="radiobtn"><?php echo $this->lang->line('CV_Duration'); ?></span>
                            <span class="norto"><?php echo $this->lang->line('CV_Economy'); ?></span>
                            <span class="norto lbold"><?php //echo $dur;?></span>
                        </div>
                    </div>
                                                   
                    </div>
                    
                    <div class="col-md-5 offset-0 concell litgrycell">
                            <div class="topfisconf">
                            
                            <div class="col-md-12 nopad">
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux"><?php echo $this->lang->line('CV_Reservation_Date'); ?></div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux"><?php echo $this->lang->line('CV_Confirmation'); ?></div>
                                     </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo $booking->pnr_no;?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux nomarb"><?php echo $this->lang->line('CV_Booking_Status'); ?></div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux nomarb"> <?php echo $booking->booking_status;?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 nopad">
                        <div class="botufis">
                               <a title="<?php echo $this->lang->line('CV_Mail_Voucher'); ?> " onclick="flight_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Edit Voucher">
                                          <i class="icon-envelope"></i><?php echo $this->lang->line('CV_Mail_Voucher'); ?>  <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                        </a>
                                
                                <a href="<?php echo WEB_URL.'/flight/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="<?php echo $this->lang->line('CV_View_Voucher'); ?>" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Voucher">
                                    <i class="icon-ticket"></i><?php echo $this->lang->line('CV_View_Voucher'); ?>
                                </a>
                                 <?php
								
                                if($booking->user_type == '2')
								{
									?>
                                       <a href="<?php echo WEB_URL.'/flight/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Invoice">
                                       
                                	
                                    <i class="icon-ticket"></i><?php echo $this->lang->line('CV_View_Invoice'); ?>
                                </a>
                                <?php
								}
								?>
                                <a class="left">
                                  <span class="green bold size20"><?php echo CURR_ICON?><?php echo $booking->amount;?></span> 
                                  </a>
                                
                         </div>
                    </div>
                            </div>
                     
                    </div>
                    
                    </div>

                    <div class="clearfix"></div>
                  </li>
                  
                    <?php } else if($request->type=='M') {  
                        $flight = json_decode(base64_decode($booking->response));
                      //  echo '<pre>';print_r($flight); die;
                    ?>
                  <li class="bookingli">
                    <div class="bookingicon <?php echo 'p_'.strtolower($booking->module);?>"></div>
                    
                    <div class="tablofcon">
                    
                    <div class="clear"></div>
                    <div class="col-md-7 concell"> 

                    <?php foreach($flight->segments as $k) { 
                        $fromCityName =  $this->flight_model->get_airport_cityname($k->Origin);
                        $toCityName =  $this->flight_model->get_airport_cityname($k->Destination);

                        //Exploding T from arrival time  
                        list($date, $time) = explode('T', $k->ArrivalTime);
                        $time = preg_replace("/[.]/", " ", $time);
                        list($time, $TimeOffSet) = explode(" ", $time);
                        $ArrivalDateTime = $date." ".$time; //Exploding T and adding space
                        $ArrivalDateTime = $art = strtotime($ArrivalDateTime);

                        //Exploding T from depature time  
                        list($date, $time) = explode('T', $k->DepartureTime);
                        $time = preg_replace("/[.]/", " ", $time);
                        list($time, $TimeOffSet) = explode(" ", $time);
                        $DepartureDateTime = $date." ".$time; //Exploding T and adding space
                        $DepartureDateTime = $dpt = strtotime($DepartureDateTime);

                        $seconds = $ArrivalDateTime - $DepartureDateTime;
                        $jms = $seconds/60;
                        $days = floor($seconds / 86400);
                        $hours = floor(($seconds - ($days * 86400)) / 3600);
                        $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);

                        if($days==0){
                            $dur=$hours."h ".$minutes."m";  
                        }else{
                            $dur=$days."d ".$hours."h ".$minutes."m";
                        }
                    ?>

                        <div class="onwyrow">
                            <div class="fblueline22 linegreen">
                                <b><?php echo $fromCityName;?></b> (<?php echo $k->Origin;?>) 
                                <span class="farrow"></span> 
                                <b><?php echo $toCityName;?></b> (<?php echo $k->Destination;?>)
                            </div>
                            <div class="col-md-2">
                                <div class="flitsecimg">
                                    <img alt="" id="FF219160" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $k->Carrier;?>.gif">
                                    <span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($k->Carrier);?></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="radiobtn rittextalign"><?php echo $this->lang->line('CV_Departure'); ?></div>
                                <span class="norto rittextalign"><?php echo date('d M, D Y', $DepartureDateTime);?></span>
                                <span class="norto lbold rittextalign"><?php echo date('H:i', $DepartureDateTime);?></span>
                            </div>
                            <div class="col-md-1 nopad">
                                <div class="flightimgs">
                                    <img alt="" src="<?php echo ASSETS;?>images/departure.png">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <span class="radiobtn"><?php echo $this->lang->line('CV_Arrival'); ?></span>
                                <span class="norto"><?php echo date('d M, D Y', $ArrivalDateTime);?></span>
                                <span class="norto lbold"><?php echo date('H:i', $ArrivalDateTime);?></span>
                            </div>
                            <div class="col-md-3 nopad">
                                <span class="radiobtn"><?php echo $this->lang->line('CV_Duration'); ?></span>
                                <span class="norto"><?php echo $this->lang->line('CV_Economy'); ?></span>
                                <span class="norto lbold"><?php echo $dur;?></span>
                            </div>
                        </div>  
                    <?php } ?>

                    </div>

                    
                    
                    <div class="col-md-5 offset-0 concell litgrycell">
                            <div class="topfisconf">
                            
                            <div class="col-md-12 nopad">
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux"><?php echo $this->lang->line('CV_Reservation_Date'); ?></div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
                                    </div>
                                </div>
                                

                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux"><?php echo $this->lang->line('CV_Confirmation'); ?></div>
                                     </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo $booking->pnr_no;?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux nomarb"><?php echo $this->lang->line('CV_Booking_Status'); ?></div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux nomarb"> <?php echo $booking->booking_status;?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 nopad">
                        <div class="botufis">
                               <a title="<?php echo $this->lang->line('CV_Mail_Voucher'); ?> " onclick="flight_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Edit Voucher">
                                          <i class="icon-envelope"></i><?php echo $this->lang->line('CV_Mail_Voucher'); ?>  <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                        </a>
                                
                                <a href="<?php echo WEB_URL.'/flight/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="<?php echo $this->lang->line('CV_View_Voucher'); ?>" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Voucher">
                                    <i class="icon-ticket"></i><?php echo $this->lang->line('CV_View_Voucher'); ?>
                                </a>
                                  <?php
								
                                if($booking->user_type == '2')
								{
									?>
                                       <a href="<?php echo WEB_URL.'/flight/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Invoice">
                                       
                                	
                                    <i class="icon-ticket"></i><?php echo $this->lang->line('CV_View_Invoice'); ?>
                                </a>
                                <?php
								}
								?>
                                <a class="left">
                                <?php /*?>  <span class="green bold size20"><?php echo CURR_ICON?><?php echo $booking->amount;?></span> <?php */?>
                                  </a>
                                
                         </div>

                    </div>
                            </div>
                     
                    </div>
                    

                    <div class="clearfix"></div>
                  </li>


                    <?php } }} ?>
 
                </ul>
                
              </div>
        </div>

</div>
</div>-->




        </div>
</div>

<div class="clearfix"></div>
<script>
    function sendVoucherMail_flight(v_pnr) {
    //alert();    
        $.ajax({
            url: WEB_URL+'flight/flight_mail_voucher/'+v_pnr,
            success: function(r) {
               // $('.loadr:visible').hide();
                console.log(r);
            }
        })
    }
</script>
<!-- Page Content -->

<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>

<!-- Script to Activate the Carousel --> 


<style>
.leftflitmg { max-width:70px !important } 
</style>
<style>




.new_ceneterd{float: none !important;margin:50px auto; display: block; font-family: roboto;  }
.new_voucher_hed{background: #f9f9f9; position: relative; float: left; width: 100%;     padding: 12px 0px;}
.new_voucher_hed img{
    width: 41%;
    position: relative;
    top: -6px;
}
.new_voucher_hed h4{    font-size: 13px;
    text-align: right;
    font-weight: 400;}
.new_voucher_hed hr{margin-top: 5px;
    margin-bottom: 5px;
    border: 0;
    border-top: 1px solid #d8d8d8;}
.new_voucher_hed strong{text-transform: uppercase;}
.new_voucher_hed ul{padding-left: 0px;}
.new_voucher_hed li{list-style: none;
    text-align: right;}


.brd_r{border:1px solid #76e288; padding: 0px !important; font-family: roboto;}
.brd_r h5{    
	margin:0px;
    padding: 15px;
    border-bottom: 1px solid #76e288;
}
.brd_r label{    width: 100%; padding-top:15px;
    float: left;
    font-weight: 500;}
.brd_r span{    width: 100%;
    float: left; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;     padding-bottom: 15px;
    }


    .brd_s{border:1px solid #666; padding: 0px !important; font-family: roboto;}
.brd_s h5{    
	margin:0px;
    padding: 15px;
    border-bottom: 1px solid #666; 
}
.brd_s label{    width: 100%; padding-top:15px;
	text-align: center;
    float: left;
    font-weight: 500;}
.brd_s span{    width: 100%;
	text-align: center;
    float: left; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;     padding-bottom: 15px;
    }



      .brd_sa{border:1px solid #666; padding: 0px !important; font-family: roboto;}
.brd_sa h5{    
	margin:0px;
    padding: 15px;
    border-bottom: 1px solid #666; 
}
.brd_sa h6{    
	margin:0px;
    padding: 15px;
    border-top: 1px solid #666; 
}
.brd_sa label{    width: 100%; padding-top:15px;
	float: left;
    font-weight: 500;}
.brd_sa span{    width: 100%;
	    padding: 5px 15px;
	float: left; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;     padding-bottom: 15px;
    } 
    .new_on{padding:15px   0px !important;}



</style>

<script type="text/javascript">
$(document).ready(function() {
    $(".tooltipv").tooltip();
});

function PrintDiv() {  
   var voucher = document.getElementById('voucher');
   var popupWin = window.open('', '_blank', 'width=600,height=600');
   popupWin.document.open();
   popupWin.document.write('<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1" /><meta name="description" content=""><meta name="author" content=""><link href="<?php echo ASSETS;?>css/bootstrap.min.css" rel="stylesheet" media="screen,print"><link href="<?php echo ASSETS;?>css/temp.css" rel="stylesheet" media="screen,print"><link href="<?php echo ASSETS;?>css/voucher.css" rel="stylesheet" media="screen,print"><style>@page {size: A4;margin: 0;}@media print {html, body {width: 210mm;height: 297mm;} .none_print{display: none !important;} .tablebg{background-color: #f1f1f1 !important; -webkit-print-color-adjust: exact; }}</style></head><body onload="window.print()">' + voucher.innerHTML + '</html>');
  popupWin.document.close();
}
</script>
</body>
</html>
