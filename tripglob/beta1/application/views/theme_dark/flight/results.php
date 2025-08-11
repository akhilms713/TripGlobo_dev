<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php echo PROJECT_TITLE; ?></title>
	<link rel="icon" href="https://tripglobo.com/beta1/assets/theme_dark/images/favicon.png" type="image/x-icon">
	<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_css'); ?>
	<link href="<?php echo ASSETS; ?>css/flight_result.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>

<style type="text/css">
  .btn-searc{ background: #f73829; }
  .col70 {
    width: 75%;
}
.pre_nxt{    
    background: #91a9b1;
    color: #fff;
    border-radius: 0px;
  }
  .footer_data{
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   color: white;
   text-align: center;
   z-index: 1;
}

</style>

<?php if($this->session->userdata('user_type')=='1'){
  echo $this->load->view(PROJECT_THEME.'/common/header');
}else{
  echo $this->load->view(PROJECT_THEME.'/new_theme/header'); 
} ?>

<!-- Header Carousel --> 
<div class="allpagewrp top80">
	<div class="newmodify">
		<div class="container">
			<div class="contentsdw">
				<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 nopad">
					<div class="pad_ten">
						<div class="left_icon sprite marker_icon">
            <i class="cus-fa-icon fas fa-map-marker-alt"></i>
            </div>
						<div class="from_to_place">
							<h4 class="placename"><?php if($req->type == 'round'){
                                              echo 'Round Trip';
                                            }else if($req->type == 'M'){
                                              echo 'Multi City';
                                            }else{
                                              echo 'One way' ; 

                                            }
                                          ?>
                    
                    
                  </h4>
							<h3 class="contryname"><?= $req->origin .' To '. $req->destination; ?> </h3>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-xs-6 hidden-sm hidden-xs nopad">
					<div class="col-xs-6 nopad">
						<div class="pad_ten">
							<div class="left_icon sprite calendar_icon">
         <i class="cus-fa-icon far fa-calendar-alt"></i>     
              </div>
							<div class="from_to_place">
								<div class="boxlabl">Departure</div>
								<div class="datein">
									<span class="calinn"> <?php echo date('M d,Y' , strtotime( $req->depart_date )); ?> </span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-6 nopad <?php if($req->type != 'round') echo 'disabled'; ?>">
						<div class="pad_ten">
							<div class="left_icon sprite calendar_icon">
          <i class="cus-fa-icon far fa-calendar-alt"></i>            
              </div>
							<div class="from_to_place">
								<div class="boxlabl">Return</div>
								<div class="datein">
									<?= $return_date =  ($req->type == 'round') ? date('M d,Y' , strtotime( $req->return_date )) : "-- --"; ?><span class="calinn">  </span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-2 hidden-md hidden-sm hidden-xs nopad">
					<div class="pad_ten">
						<div class="left_icon sprite pasnger_icon">
        <i class="cus-fa-icon far fa-user"></i>

            </div>
						<div class="from_to_place">
							<div class="boxlabl textcentr">Passenger(s)</div>
							<div class="countlbl"><?= $req->ADT + $req->CHD + $req->INF; ?></div>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4 nopad">
					<div class="pad_ten text-right">
						<button class="modifysrch" data-toggle="collapse" data-target="#modify"><strong>Modify</strong> <span class="down_caret"></span></button>
					</div>
				</div>
			</div>
	</div>
</div>
<div class="clearfix"></div>
<div class="modify_search_wrap">
	<div class="container">
		<div id="modify" class="collapse">
		<?php 
			$data['product'] 		= 'Flight';
			$data['triptype'] 		= $req->type;
			$origin1 				= $this->Flight_Model->get_airport_name1($req->origin);
			$destination1 			= $this->Flight_Model->get_airport_name1($req->destination);
			$data['origin'] 		= $origin1.' ('. $req->origin.')';
			$data['destination'] 	= $destination1.' ('. $req->destination.')';
			$data['depart_date'] 	= $req->depart_date;
			$data['return_date'] 	= $req->return_date;
            $data['airline']    = $req->airline;
			$data['ADT'] 			= $req->ADT;
			$data['CHD'] 			= $req->CHD;
			$data['INF'] 			= $req->INF;
            $data['traveller']      = $req->ADT+$req->CHD+$req->INF;
			$data['class'] 			= $req->class;
            $data['search_id'] = $req->search_id;     
            $data['origin_m']    = $req->origin_m;
            $data['destination_m']  = $req->destination_m;
            $data['depart_date_m']  = $req->depart_date_m;
           // echo "<pre/>";print_r($data);exit();
			echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/flight_search', $data); 
      // echo ($req->flexible);die;
		?>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<div class="contentsec margtop">
     <div id='return_trip' class="footer_data">
        
    </div> 
	<div class="container">
        <div class="filtrsrch">
    <div class="clearfix"></div>
        <?php if($req->flexible != 1){ ?>	
			<div class="col30 notflexible">
				<div class="celsrch">
                	<button class="close_filter"><span class="fa fa-close"></span></button>
					<div class="boxtop">
						<div class="filtersho">
							<div class="avlhtls"><strong><span id="flight_count"></span></strong> Flight found<span class="placenamefil"><strong><button class="flight_filter_reset">Reset</button></strong><?php echo $req->origin; ?> to <?php echo $req->destination; ?></span></div>
						</div>
					</div>
					<div class="norfilterr">
						<div class="outbnd">
              <div class="rangebox">
                <div class="ranghead" data-target="#collapse-Airlines" data-toggle="collapse">Airlines</div>
                <div id="collapse-Airlines" class="collapse in" aria-expanded="true" style="">
                  <div id="airlines" class="stoprow">
                    <div class="boxins">
                      <ul class="locationul" id="AirlineFilter"></ul>
                    </div>
                  </div>
                </div>
              </div>

							<div class="rangebox">
								<div class="ranghead" data-target="#collapse-Price" data-toggle="collapse">Price</div>
                <div id="collapse-Price" class="collapse in" aria-expanded="true" style=""> 
								<div class="price_slider1">
									<input type="text"  class="level" id="amount" readonly >
									<div id="slider-range"></div>
								</div>
                </div>
							</div>

                <div class="rangebox">
                <div class="ranghead" data-target="#collapse-stop" data-toggle="collapse">No. of Stops</div>
                <div id="collapse-stop" class="collapse in" aria-expanded="true" style=""> 
                <div id="no_stops" class="stoprow">
                  <input hidden type="checkbox" id="stop_0_v" class="filter_stop"  name="filter_stop[]" value="0" >
                  <input hidden type="checkbox" id="stop_1_v" class="filter_stop"  name="filter_stop[]" value="1" >
                  <input hidden type="checkbox" id="stop_m_v" class="filter_stop"  name="filter_stop[]" value="1+" >
                  <div class="boxins marret stop-fligt">
                    <div class="relatboxs">
                      <a class="stopone toglefil stopzero check_stop" type="0"><label class="rounds"></label>
                         <div class="starin">
                          <div class="stopbig">Non stop<span class="stopsml stoppricezero  text-right"></span></div>
                        </div>
                      </a>
                      <a class="stopone toglefil stop_one check_stop" type="1"><label class="rounds"></label>
                          <div class="starin">
                          <div class="stopbig">1 stop<span class="stopsml stoppriceone text-right"></span></div>
                          </div>
                      </a>

                      <a class="stopone toglefil stop_mul check_stop" type="m"><label class="rounds"></label>
                       <div class="starin">
                          <div class="stopbig">1+ stop<span class="stopsml stoppricetwo text-right"></span></div>
                       </div>

                      </a>
                    </div>
                  </div>
                </div>
                </div>
              </div>
                            
						
                            <?php if($_GET['type'] === 'oneway' ) { ?>
                                <div class="rangebox">
                                        <div class="ranghead" data-target="#collapse-Departure" data-toggle="collapse">Departure Time</div>
                                         <div id="collapse-Departure" class="collapse in" aria-expanded="true" style=""> 
                                        <div id="dep_time" class="stoprow">
                                            <input hidden type="checkbox" id="12_6A_D" class="filter_depart"  name="filter_depart[]" value="12_6A" >
                                            <input hidden type="checkbox" id="6_12A_D" class="filter_depart"  name="filter_depart[]" value="6_12A" >
                                            <input hidden type="checkbox" id="12_6P_D" class="filter_depart"  name="filter_depart[]" value="12_6P" >
                                            <input hidden type="checkbox" id="6_12P_D" class="filter_depart"  name="filter_depart[]" value="6_12P" >
                                            <div class="boxins marret padlow">
                                                <div class="relatboxsone">
                                                    <a class="timone" type="0"><div class="sprte png1"></div></a>
                                                    <a class="timone toglefil" type="1"><div class="sprte png2"></div></a>
                                                    <a class="timone toglefil" type="m"><div class="sprte png3"></div></a>
                                                    <a class="timone toglefil" type="m"><div class="sprte png4"></div></a>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="relatboxs">
                                                    <a class="timone filter_depart_btn toglefil " type="12_6A"><label class="rounds"></label></a>
                                                    <a class="timone filter_depart_btn toglefil " type="6_12A"><label class="rounds"></label></a>
                                                    <a class="timone filter_depart_btn toglefil " type="12_6P"><label class="rounds"></label></a>
                                                    <a class="timone filter_depart_btn toglefil " type="6_12P"><label class="rounds"></label></a>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="relatboxsone">
                                                    <a class="timone toglefil filter_depart_btn" type="12_6A">
                                                        <div class="starin"><span class="htlcount">12-6 AM</span></div>
                                                    </a>
                                                    <a class="timone toglefil filter_depart_btn" type="6_12A">
                                                        <div class="starin"><span class="htlcount">6-12 PM</span></div>
                                                    </a>
                                                    <a class="timone toglefil filter_depart_btn" type="12_6P">
                                                        <div class="starin"><span class="htlcount">12-6 PM</span></div>
                                                    </a>
                                                    <a class="timone toglefil filter_depart_btn" type="6_12P">
                                                        <div class="starin"><span class="htlcount">6-12 AM</span></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                <div class="rangebox">
                                    <div class="ranghead" data-target="#collapse-Arrival" data-toggle="collapse">Arrival Time</div>
                                     <div id="collapse-Arrival" class="collapse in" aria-expanded="true" style=""> 
                                    <div id="arr_time" class="stoprow">
                                        <input hidden type="checkbox" id="12_6A_A" class="filter_arrive"  name="filter_arrive[]" value="12_6A" >
                                        <input hidden type="checkbox" id="6_12A_A" class="filter_arrive"  name="filter_arrive[]" value="6_12A" >
                                        <input hidden type="checkbox" id="12_6P_A" class="filter_arrive"  name="filter_arrive[]" value="12_6P" >
                                        <input hidden type="checkbox" id="6_12P_A" class="filter_arrive"  name="filter_arrive[]" value="6_12P" >
                                        <div class="boxins marret padlow">
                                            <div class="relatboxsone">
                                                <a class="timone" type="0"><div class="sprte png1"></div></a>
                                                <a class="timone toglefil" type="1"><div class="sprte png2"></div></a>
                                                <a class="timone toglefil" type="m"><div class="sprte png3"></div></a>
                                                <a class="timone toglefil" type="m"><div class="sprte png4"></div></a>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="relatboxs">
                                                <a class="timone filter_arrive_btn toglefil " type="12_6A"><label class="rounds"></label></a>
                                                <a class="timone filter_arrive_btn toglefil " type="6_12A"><label class="rounds"></label></a>
                                                <a class="timone filter_arrive_btn toglefil " type="12_6P"><label class="rounds"></label></a>
                                                <a class="timone filter_arrive_btn toglefil " type="6_12P"><label class="rounds"></label></a>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="relatboxsone">
                                                <a class="timone toglefil filter_arrive_btn" type="12_6A">
                                                    <div class="starin"><span class="htlcount">12-6 AM</span></div>
                                                </a>
                                                <a class="timone toglefil filter_arrive_btn" type="6_12A">
                                                    <div class="starin"><span class="htlcount">6-12 PM</span></div>
                                                </a>
                                                <a class="timone toglefil filter_arrive_btn" type="12_6P">
                                                    <div class="starin"><span class="htlcount">12-6 PM</span></div>
                                                </a>
                                                <a class="timone toglefil filter_arrive_btn" type="6_12P">
                                                    <div class="starin"><span class="htlcount">6-12 AM</span></div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            <?php } ?>
							<?php if($_GET['type'] === 'round' AND isset($_GET['return_date'])) { ?>
                                <div class="rangebox">
                                    <div class="ranghead " data-target="#collapse-Departure-Time" data-toggle="collapse">Departure Time</div>
                                    <div id="collapse-Departure-Time" class="collapse in" aria-expanded="true" style=""> 
                                    <div id="dep_time" class="stoprow">
                                        <input hidden type="checkbox" id="12_6A_D" class="filter_depart"  name="filter_depart[]" value="12_6A" >
                                        <input hidden type="checkbox" id="6_12A_D" class="filter_depart"  name="filter_depart[]" value="6_12A" >
                                        <input hidden type="checkbox" id="12_6P_D" class="filter_depart"  name="filter_depart[]" value="12_6P" >
                                        <input hidden type="checkbox" id="6_12P_D" class="filter_depart"  name="filter_depart[]" value="6_12P" >
                                        <div class="boxins marret padlow">
                                            <div class="relatboxsone">
                                                <a class="timone" type="0"><div class="sprte png1"></div></a>
                                                <a class="timone toglefil" type="1"><div class="sprte png2"></div></a>
                                                <a class="timone toglefil" type="m"><div class="sprte png3"></div></a>
                                                <a class="timone toglefil" type="m"><div class="sprte png4"></div></a>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="relatboxs">
                                                <a class="timone filter_depart_btn toglefil " type="12_6A"><label class="rounds"></label></a>
                                                <a class="timone filter_depart_btn toglefil " type="6_12A"><label class="rounds"></label></a>
                                                <a class="timone filter_depart_btn toglefil " type="12_6P"><label class="rounds"></label></a>
                                                <a class="timone filter_depart_btn toglefil " type="6_12P"><label class="rounds"></label></a>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="relatboxsone">
                                                <a class="timone toglefil filter_depart_btn" type="12_6A">
                                                    <div class="starin"><span class="htlcount">12-6 AM</span></div>
                                                </a>
                                                <a class="timone toglefil filter_depart_btn" type="6_12A">
                                                    <div class="starin"><span class="htlcount">6-12 PM</span></div>
                                                </a>
                                                <a class="timone toglefil filter_depart_btn" type="12_6P">
                                                    <div class="starin"><span class="htlcount">12-6 PM</span></div>
                                                </a>
                                                <a class="timone toglefil filter_depart_btn" type="6_12P">
                                                    <div class="starin"><span class="htlcount">6-12 AM</span></div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="rangebox">
                                    <div class="ranghead" data-target="#collapse-Arrival-Time" data-toggle="collapse">Arrival Time</div>
                                     <div id="collapse-Arrival-Time" class="collapse in" aria-expanded="true" style=""> 
                                    <div id="arr_time" class="stoprow">
                                        <input hidden type="checkbox" id="12_6A_A" class="filter_arrive"  name="filter_arrive[]" value="12_6A" >
                                        <input hidden type="checkbox" id="6_12A_A" class="filter_arrive"  name="filter_arrive[]" value="6_12A" >
                                        <input hidden type="checkbox" id="12_6P_A" class="filter_arrive"  name="filter_arrive[]" value="12_6P" >
                                        <input hidden type="checkbox" id="6_12P_A" class="filter_arrive"  name="filter_arrive[]" value="6_12P" >
                                        <div class="boxins marret padlow">
                                            <div class="relatboxsone">
                                                <a class="timone" type="0"><div class="sprte png1"></div></a>
                                                <a class="timone toglefil" type="1"><div class="sprte png2"></div></a>
                                                <a class="timone toglefil" type="m"><div class="sprte png3"></div></a>
                                                <a class="timone toglefil" type="m"><div class="sprte png4"></div></a>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="relatboxs">
                                                <a class="timone filter_arrive_btn toglefil " type="12_6A"><label class="rounds"></label></a>
                                                <a class="timone filter_arrive_btn toglefil " type="6_12A"><label class="rounds"></label></a>
                                                <a class="timone filter_arrive_btn toglefil " type="12_6P"><label class="rounds"></label></a>
                                                <a class="timone filter_arrive_btn toglefil " type="6_12P"><label class="rounds"></label></a>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="relatboxsone">
                                                <a class="timone toglefil filter_arrive_btn" type="12_6A">
                                                    <div class="starin"><span class="htlcount">12-6 AM</span></div>
                                                </a>
                                                <a class="timone toglefil filter_arrive_btn" type="6_12A">
                                                    <div class="starin"><span class="htlcount">6-12 PM</span></div>
                                                </a>
                                                <a class="timone toglefil filter_arrive_btn" type="12_6P">
                                                    <div class="starin"><span class="htlcount">12-6 PM</span></div>
                                                </a>
                                                <a class="timone toglefil filter_arrive_btn" type="6_12P">
                                                    <div class="starin"><span class="htlcount">6-12 AM</span></div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
							<?php }?>


              <div class="rangebox">
                                <div class="ranghead" data-target="#collapse-Preference" data-toggle="collapse">Preference</div>
                               <div id="collapse-Preference" class="collapse in" aria-expanded="true" style=""> 
                               <div id="airlines" class="stoprow">
                                    <div class="boxins">
                                        <ul class="locationul" id="preference"><li>
                                                <div class="squaredThree">
                                                    <input type="checkbox" value="non_refund" name="non_refund" class="prefer toglefil" id="squaredThree25">
                                                    <label for="squaredThree25"></label>
                                                </div>
                                                <label for="squaredThree15" class="lbllbl">Refundable</label>
                                            </li><li>
                                                <div class="squaredThree">
                                                    <input type="checkbox" value="refund" name="refund" class="prefer toglefil" id="squaredThree26">
                                                    <label for="squaredThree26"></label>
                                                </div>
                                                <label for="squaredThree16" class="lbllbl">Non-Refundable</label>
                                            </li></ul>
                                    </div>
                                </div>
                                </div>
                            </div>
                 
                             <div class="rangebox">
                                <div class="ranghead" data-target="#collapse-Airports" data-toggle="collapse">Connecting Airports</div>
                                <div id="collapse-Airports" class="collapse in" aria-expanded="true" style="">
                                <div id="airlines" class="stoprow">
                                    <div class="boxins">
                                        <ul class="locationul" id="con_air_filter">
                                            
                                        </ul>
                                    </div>
                                </div>
                                </div>
                            </div>
                            
						</div>
					</div>
				</div>
            </div>           
        
            <div class="col70">

               <div class="flights1 <?php if($req->type == 'round') echo 'ifroundway'; ?>" id="flightsdata1"></div>
                  


            	<div class="in70">  

             
                <ul class="nav nav-tabs flightrestab" role="tablist">
                <li role="presentation" class="active"><a href="#flightresult" aria-controls="home" role="tab" data-toggle="tab" id="get_cheapest_flight">Lowest Fare <span id="lowest_fare_pricingid"></span></a></li>
                <li role="presentation" class="get_non_stop_flight"><a href="#flightresult" aria-controls="profile" role="tab" data-toggle="tab" id="get_non_stop_flight">Non Stop Flights <span id="nonstop_fare_pricingid"></span></a></li>
              
           
          </ul>
          <!-- Rss Design -->
            <div class="col-md-12 rssdesign nopad">
              <marquee>
              <?php  
                if($this->session->userdata('user_type')=='1'){
                  $this->db->where_in('user_id',array($this->session->userdata('user_id'),0));
                  $rss_feedback = $this->db->get_where('promo', array('status' => 'ACTIVE','user_type' => 1,'module'=>'flight'))->result_array();
              }elseif($this->session->userdata('user_type') != 1 && $this->session->userdata('user_type')!=4) {
                  
                $rss_feedback = $this->db->get_where('promo', array('status' => 'ACTIVE','user_type' => 2,'module'=>'flight'))->result_array();
              }                  
              
              if(count($rss_feedback) > 0) {
                foreach ($rss_feedback as $rss_key => $rss_value) {
              ?>
              <span><i class="fas fa-gift"></i> <?=$rss_value['description']?></span>

               <?php } ?>
               <?php } ?>
              </marquee>
             
            </div>
            <?php
              $request_data   = json_decode(base64_decode($request));
             if($request_data->type == 'oneway'){ ?>
            <div class="col-xs-12 nopad">
                        <?php
                         

                          $date = isset($request_data->depart_date) ? $request_data->depart_date : date('Y-m-d');
                          $prev_date = date('Y-m-d H:m:s', strtotime($date .' -1 day'));
                          $next_date = date('Y-m-d H:m:s', strtotime($date .' +1 day'));
                        ?>
                      <div class="timer-section nopad">
                        <div class="col-xs-3 nopad">
                          <button class="previous_day pre_nxt btn" data-journey-date="<?=$prev_date?>">Previous day</button></div>
                        <div class="col-xs-9 nopad">
                          <button class="next_day ne_rightsd pre_nxt btn" data-journey-date="<?=$next_date?>" style="float: right;">Next day</button>
                        </div>
                    </div>
                  <div class="col-xs-12 nopad">
                    <div class="timer"></div>
                      <div class="farenewcal">
                          <div class="matrx">
                              <div id="farecal" class="owl-carousel matrixcarsl owl-theme">

                                      
                               </div>
                            </div>
                        </div>
                    </div>
              </div>

            <?php }  ?>









                <!-- // rss-->
          <!-- Tab panes -->
          <div class="tab-content flight-resnav">
            <div role="tabpanel" class="tab-pane active" id="flightresult">

                    <div class="farecaled">
                	<div class="col-xs-12 nopad">
                    	<div class="farenewcal">
                        	<div class="matrx">
                            	<div id="farecal" class="owl-carousel matrixcarsl owl-theme">

                                      
                               </div>
                            </div>
                        </div>
                    </div>
           		</div>
                    
                	<div class="topmisty">
                    	<div class="col-xs-12 nopad">
                        	<button class="filter_show"><span class="fa fa-filter"></span></button>
                            <div class="insidemyt">
                            	<ul class="sortul flight_sort">
                                	<li class="sortli hide_sort">
                                      
                                      <a class="sorta" type='airline' id="airline_sort" val='asc'>
                                      <i class="fal fa-calendar-check"></i> Airline</a>
                                    </li>
                                     <li class="sortli">
                                     
                                      <a class="sorta" type='depature_time' id="depart_sort" val='asc'> <i class="fal fa-calendar-check"></i> Departure Time</a>
                                    </li>
                                    <li class="sortli hide_sort">
                                     
                                      <a class="sorta" type='onwards_stops' id="stop_sort" val='asc'><i class="fal fa-clock"></i> Stop</a>
                                    </li>
                                    <li class="sortli">
                                      
                                      <a class="sorta" type='arrival_time'   id="arrival_sort" val='asc'><i class="fal fa-clock"></i> Arrival Time</a>
                                    </li>

                                    
                                   
                                    
                                    <li class="sortli">
                                     
                                      <a class="sorta active des" type='amount' id="price_sort" val='asc'>
                                      <i class="fal fa-tag"></i> Price</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!--All Available flight result comes here -->
                  
                    <div class="allresult">
                    
						        <?php echo $this->load->view(PROJECT_THEME.'/flight/flight_result_loader');  ?>
						
                      <input type="hidden" value="" id='session_id'>
                      
                      <div class="lodrefrentrev flight_fliter_loader hide">
                      <p><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></p>
                       <h5 class="text-center">We are seeking the best results for your search. Please wait.</h5>
                        <h5 class="text-center">This will take only few seconds......</h5>
                         </div>
                       
                     <div class="flights <?php if($req->type == 'round') echo 'ifroundway'; ?>" id="flightsdata">
                     </div>
                
                    </div>

                     </div>
                  
                    <!-- End of result -->

                     <div role="tabpanel" class="tab-pane hide" id="alternate">
                       
                       <p><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></p>
                       <h5 class="text-center">We are seeking the best results for your search. Please wait.</h5>
                        <h5 class="text-center">This will take only few seconds......</h5>

                     </div>
                     </div>
                </div>



 
            </div>
            
        </div>
        
    </div>
</div>

</div>

<input type="hidden" id="amount_min_">

<!-- Page Content -->


    	<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
    	<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>


<script type="text/javascript" src="<?= ASSETS; ?>js/flight_filter.js"></script>

<!-- Script to Activate the Carousel --> 
<script type="text/javascript">

	$(document).ready(function(){
    var sess_jcurr = "<?=$this->display_icon?>";
		$(".filter_depart").prop('checked', false);
        $(".filter_arrive").prop('checked', false);
		$(".filter_return").prop('checked', false);
        $(".prefer").prop('checked', false);
		//Before the AJAX function runs
		var start = new Date().getTime(),
		difference;
		$(function() {
			$.ajax({
		  type:'GET', 
		  dataType:"json",
		  url: '<?php echo WEB_URL;?>flight/GetResults/<?php echo $request;?>',
		  beforeSend: function(XMLHttpRequest){
			$('.imgLoader').fadeIn();
			$('body').css('overflow', 'hidden');		
		  }, 
		  success: function(response) {
        //console.log(response);
      $("#amount_min_").val( sess_jcurr + response.min_rate + " - " + sess_jcurr + response.max_rate); 
      $('.flights1').html(response.result1);
			$('.flights').html(response.result);
      $('.imgLoader').fadeIn();
			$('#farecal').html(response.airlinematrix);		
			airline_matrix();	
			$('.imgLoader').fadeOut(500, function(){
				$('body').css('overflow', '');
			});
			$('#pricerange').addClass('in');
			 $(function() {
				$( "#slider-range" ).slider({
				  range: true,
				  min: response.min_rate,
				  max: response.max_rate,
				  values: [ response.min_rate, response.max_rate ],
				  slide: function( event, ui ) {
					$( "#amount" ).val( sess_jcurr + ui.values[ 0 ] + " - " + sess_jcurr + ui.values[ 1 ] );

				  },
				  change: function( event, ui ) {
					 one=ui.values[0];
					 two=ui.values[1];
				  }
				});
				$( "#amount" ).val( sess_jcurr + $( "#slider-range" ).slider( "values", 0 ) +
				  " - "+ sess_jcurr + $( "#slider-range" ).slider( "values", 1 ) );
			  });
			 $('#no_stops').addClass('in');
			 $('#dep_time').addClass('in');
			 $('#return_time').addClass('in');
			 $('#arr_time').addClass('in');
			
			$("#session_id").val(response.session_data);
			$("#stops_0").html(response.stops_0min_rate+" $");
			$("#stops_1").html(response.stops_1min_rate+" $");
			// $("#AirlineFilter").html(response.AirlineFilter);
			$("#stops_multi").html(response.stops_multimin_rate+" $");
      var infoarr = new Array();
      $('.rowresult').each(function(key, value) {
        var stops_fil = $('.airline_stop_filt:first', this).data('stops');
        if(stops_fil > 1){
          stops_fil = 2
        }
        if(infoarr[stops_fil]!==""||infoarr[stops_fil]!==null||infoarr[stops_fil]!=='null')
        {
            if(infoarr[stops_fil] < $('.sidepricewrp:first', this).data('price')){
              infoarr[stops_fil] = $('.sidepricewrp:first', this).data('price');
            }
        } else {
          infoarr[stops_fil] = $('.sidepricewrp:first', this).data('price');
        }
        infoarr[stops_fil] = $('.sidepricewrp:first', this).data('price');
      });
      $('.stoppricezero').html(sess_jcurr+" "+response.stops_0min_rate);
      $('.stoppriceone').html(sess_jcurr+" "+response.stops_1min_rate);
        // console.log(infoarr);
      if (response.stops_0min_rate == 0)
        {
          // alert('if');
          $('a.stopzero').addClass('hide');
          //$('a.stopzero').addClass('chkbox-dis');
          $('li.get_non_stop_flight').addClass('hide');
          $('.nav.nav-tabs.flightrestab li').css('width', '50%');
        } else{
          $('#nonstop_fare_pricingid').html(sess_jcurr+" "+response.stops_0min_rate);
        }
      if(response.stops_1min_rate == 0)
        {
          $('a.stop_one').addClass('hide');
          //$('a.stop_one').addClass('chkbox-dis');
        }
      if(response.stops_multimin_rate == 0)
        {
          $('a.stop_mul').addClass('hide');
          //$('a.stop_mul').addClass('chkbox-dis');
        }
      $('.stoppricetwo').html(sess_jcurr+" "+response.stops_multimin_rate);
      $('#lowest_fare_pricingid').html(sess_jcurr + " " + response.min_rate);
      $('#alternate_fare_pricingid').html(sess_jcurr + " " + response.min_rate);
		  }
		});
	});

	function airline_matrix(){
		
	  $("#farecal").owlCarousel({
		items : 4, 
		itemsDesktop : [1000,4],
		itemsDesktopSmall : [900,3], 
		itemsTablet: [600,2], 
		itemsMobile : [479,2], 
		itemsMobile : [330,1], 
		navigation : true,
		pagination : false

	  });
	  
	}


$('.mymail').click(function(){
    $(this).fadeOut(500,function(){
      $('.signupul').fadeIn(500);
    });
    
  });
  
$('.toglefil').click(function(){
    $(this).toggleClass('active');
  });

    $('.nav-tabs.customtab .item').click(function(){
      $('.nav-tabs.customtab .item').removeClass('active');
      $(this).toggleClass('active');
    });
    



  $(".sorta").click(function(){
      var type = $(this).attr('type');
     
      if(type == 'price')
      {
        var val = $(this).attr('val');
          if(val = 'asc')
          {
             $('#flightsdata > div').toArray().sort( function(a,b) { a.id - b.id } );

    
          }

      }
  });

  $(document).on("click", ".FlightbookNow", function (e) {
	  var that = $(this);
	        e.preventDefault();
	        var att = $(this).attr('data-attr');
	        var action = WEB_URL+'flight/addToCart/'+att;
			$.ajax({
				type: "GET",
				url: action,
				data: '',
				dataType: "json",
				beforeSend: function(){
					$('.flights').find('.carttoloadr').fadeIn();
			    },
				success: function(data){
                    // console.log(data);
					$('.flights').find('.carttoloadr').fadeOut();
					if(data.isCart == false){
						alert('error')
					}else{
						if(data.status == 1){
							console.log('ajaxsuccess');
								window.location.href = data.C_URL;
						}else{
							console.log('ajaxsuccess');
							alert(data.error);
						}
					}
				}
			});
			//callFlightCart(att);
	    });
		
  $(document).on("click", ".FlightbookNowreturn", function (e) {
      var that = $(this);
            e.preventDefault();
            var att = $(this).attr('data-attr');
            var action = WEB_URL+'flight/addToCartReturn/'+att;
            $.ajax({
                type: "GET",
                url: action,
                data: '',
                dataType: "json",
                beforeSend: function(){
                    $('.flights').find('.carttoloadr').fadeIn();
                },
                success: function(data){
                    $('.flights').find('.carttoloadr').fadeOut();
                     $("#return_trip").html(data);                  
                }
            });
           
    });	

      $(document).on("click", ".FlightbookNowfinal", function (e) {
      var that = $(this);
            e.preventDefault();
            var att = $(this).attr('data-attr');
            var action = WEB_URL+'flight/addToCartfinal/'+att;
            $.ajax({
                type: "GET",
                url: action,
                data: '',
                dataType: "json",
                beforeSend: function(){
                    $('.flights').find('.carttoloadr').fadeIn();
                },
                success: function(data){
                   $('.flights').find('.carttoloadr').fadeOut();
                    if(data.isCart == false){
                        alert('error')
                    }else{
                        if(data.status == 1){
                            console.log('ajaxsuccess');
                                window.location.href = data.C_URL;
                        }else{
                            console.log('ajaxsuccess');
                            alert(data.error);
                        }
                    }                 
                }
            });
           
    }); 	
	
	
	$('.filter_show').click(function(){
		$('.filtrsrch').addClass('open');
	});
	
	$('.close_filter').click(function(){
		$('.filtrsrch').removeClass('open');
	});


		
});
</script>
<script type="text/javascript">
  $(document).on('click', '.next_day', function(){

      <?php if($request_data->type == 'oneway'){ ?>
        var new_date = $(this).data('journey-date');
        // console.log(new_date);
        var search_request = '<?php echo $request; ?>';
        window.location.href = '<?php echo WEB_URL; ?>flight/add_days_todate?search_request='+search_request+'&new_date='+new_date;
      <?php } ?>
      });

      $(document).on('click', '.previous_day', function(){
        <?php if($request_data->type == 'oneway'){ ?>

        var new_date = $(this).data('journey-date');
        // console.log(new_date);
        var search_request = '<?php echo $request; ?>';
        window.location.href = '<?php echo WEB_URL; ?>flight/add_days_todate?search_request='+search_request+'&new_date='+new_date;
      <?php } ?>
      $(document).click('.filter_reset', function() {
   
    //alert('hi');
    $('.filter_arrive').attr("checked",false).checkboxradio("refresh");
    $('.toglefil').attr("checked",false).checkboxradio("refresh");
    $('.filter_depart').attr("checked",false).checkboxradio("refresh");
    $('.filter_arrive').attr("checked",false).checkboxradio("refresh");
    
    $('.filter_depart').attr("checked",false).checkboxradio("refresh");
    //$('#captureImage').attr("checked",false).checkboxradio("refresh");  
  //$('input[type=checkbox]').prop('checked',false);
    //HotelName
    //$('#hotel-name').val(''); //Hotel Name
  
    filter();
  });
      });
</script>

</body>
</html>
