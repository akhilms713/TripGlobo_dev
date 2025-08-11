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
				<?php if(true){ ?>
				<?php
				  $flight = json_decode($pnr_nos[$p]->segment_data); 
				  $segment_loop_count=count($flight);
				$flight_result[0]['FlightDetails'] = json_decode($pnr_nos[$p]->segment_data,1); $segment_loop_count=count($flight);
				// echo '<pre/>';print_r($flight);exit("85");
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
					<?php 
					//echo "<pre/>";print_r($flight_result);exit("245");


					for($i=0;$i<count($flight_result[0]['FlightDetails']['Segments']);$i++){  ?>
				 <div class="rowresult" > 
					<div class="">
					<?php   $detail_count = count($flight_result[0]['FlightDetails']['Segments'][$i]); 
						for($j=0;$j<$detail_count;$j++){ 

						//	echo $j;
						//$inner_segment_len=count($detail_count);
						//echo $inner_segment_len;
							if(true){
							 ?>
								<div class="col-xs-12 nopad">
								<div class="sidenamedesc">
								<!-- Round trip start -->


								<div class="celhtl width20 midlbord">
								 <div class="fligthsmll">
								  <img src="https://c.fareportal.com/n/common/air/ai/<?php echo $flight_result[0]['FlightDetails']['Segments'][$i][$j]['Airline']['AirlineCode']; ?>.gif"; alt="" />
								  <div class="airlinename"><?php echo $flight_result[0]['FlightDetails']['Segments'][$i][$j]['Airline']['AirlineName']; ?></div>
								</div>
								

							  </div>
							  <div class="celhtl width80">
								<div class="waymensn">

								  <div class="flitruo cloroutbnd">
								   <div class="detlnavi">
									<div class="col-xs-4 padflt widfty">
									  <span class="timlbl right">
										<span class="flname"><div class="rndplace"><?php echo $flight_result[0]['FlightDetails']['Segments'][$i][$j]['Origin']['Airport']['AirportName']; ?> (<?php echo  $flight_result[0]['FlightDetails']['Segments'][$i][$j]['Origin']['Airport']['AirportCode']; ?>)</div> </span>
									  </span>
									<?php 
									$ddd=explode('T',$flight_result[0]['FlightDetails']['Segments'][$i][$j]['Origin']['DepTime']);
									?>


									  <span class="flitrlbl elipsetool"><?php echo date('M d,Y',strtotime($ddd[0])); ?>, <span class="fltime"><?php echo $ddd[1];   ?></span></span>
									  
									</div>
									 <?php 
                                    $time=$flight_result[0]['FlightDetails']['Segments'][$i][$j]['Duration'];
                                     $hours = floor($time / 60);
                                     $minutes = ($time % 60);
                                     ?>

									<div class="col-xs-4 nopad padflt widfty">
									  <div class="lyovrtime"> 
										<span class="flect"> <span class="fa fa-clock-o"></span> <?php echo $hours.'h:'.$minutes.'m'; ?></span>
									  </div>  
									</div>
									<div class="col-xs-4 padflt widfty">
									  <span class="timlbl left">
										<span class="flname"><!--<span class="sprite refltwo jj"></span>--> <div class="rndplace"><?php echo $flight_result[0]['FlightDetails']['Segments'][$i][$j]['Destination']['Airport']['AirportName'];  ;?> (<?php echo  $flight_result[0]['FlightDetails']['Segments'][$i][$j]['Destination']['Airport']['AirportCode']; ?>) </div></span>

									  </span>
									  <div class="clearfix"></div>
									  <?php 
									$aaa=explode('T',$flight_result[0]['FlightDetails']['Segments'][$i][$j]['Destination']['ArrTime']);
									?>
									  <span class="flitrlbl elipsetool"><?php 
									   echo date('M d,Y',strtotime($aaa[0]));
									   ?>, <span class="fltime"><?php echo $aaa[1];  ?></span></span>
									   
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
				<?php   }else{
					?>
						<div class="tickapt">
							<div class="round_acti fa fa-check"></div>
							<span class="confirm_mfg">Booking Not Done</span>
						</div>
						<?php
					}
			}
			?> 





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
