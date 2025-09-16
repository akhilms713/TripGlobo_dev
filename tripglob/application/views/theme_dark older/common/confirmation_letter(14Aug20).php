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
                		<a class="btn_comnbtns" href="<?php echo WEB_URL.'booking/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank">View voucher</a>
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
                		<a class="btn_comnbtns" href="<?php echo WEB_URL.'booking/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank">View voucher</a>
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
           /*   $booking = $this->booking_model->getBookingbyPnr($pnr_nos[$p]->pnr_no,$pnr_nos[$p]->product_name)->row(); */
           	$booking = $pnr_nos;
				$car_information = json_decode(base64_decode($booking->segment_data),1); 
				$segment_loop_count=count($flight);

		//		echo $booking[0]->booking_status;
				//echo '<pre/>';print_r($voucher_data);exit;
				 // echo '<pre/>';print_r($booking);exit;
				 //echo 'test'.$booking[0]->booking_status;exit;
			//	echo '<pre/>'; print_r($voucher_data); exit;
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
							<a class="btn_comnbtns" href="<?php echo WEB_URL.'booking/voucher/'.base64_encode(base64_encode($booking[0]->pnr_no));?>" target="_blank">View voucher</a>
						<?php endif;?>






					</div>
				</div>
				<?php } else if($pnr_nos[$p]->product_name == 'HOTEL'){ 
				     //echo '<pre>';print_r($pnr_nos[$p]);exit();
				   $booking = $this->booking_model->getBookingbyPnr_Hotel($pnr_nos[$p]->parent_pnr_no,$pnr_nos[$p]->product_name)->row();
				   //echo '<pre>';print_r($booking);exit();
				   $pnrdata = $this->cart_model->getBookingTemphotel($booking->cart_id);
				    //echo '<pre>';print_r($pnrdata);exit();
				   $CI = & get_instance();
                   $CI->load->model('hotel_model');
                   $hotel_data = $CI->hotel_model->get_hotel_other_details($pnrdata->HotelCode,$pnrdata->session_id);
                   $hotel_data = $hotel_data[0];
                   
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
							<a class="btn_comnbtns" href="<?php echo WEB_URL.'booking/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank">View voucher</a>
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
							<a class="btn_comnbtns" href="<?php echo WEB_URL.'booking/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank">View voucher</a>
						<?php endif;?>
					</div>
				</div>
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


</body>
</html>
