<?php 
   $time_arr=array( 
   
       '' => 'Please select',
   
       '00:00' => '12:00 AM',
   
       '00:30' => '12:30 AM',
   
       '01:00' => '1:00 AM',
   
       '01:30' => '1:30 AM',
   
       '02:00' => '2:00 AM',
   
       '02:30' => '2:30 AM',
   
       '03:00' => '3:00 AM',
   
       '03:30' => '3:30 AM',
   
       '04:00' => '4:00 AM',
   
       '04:30' => '4:30 AM',
   
       '05:00' => '5:00 AM',
   
       '05:30' => '5:30 AM',
   
       '06:00' => '6:00 AM',
   
       '06:30' => '6:30 AM',
   
       '07:00' => '7:00 AM',
   
       '07:30' => '7:30 AM',
   
       '08:00' => '8:00 AM',
   
       '08:30' => '8:30 AM',
   
       '09:00' => '9:00 AM',
   
       '09:30' => '9:30 AM',
   
       '10:00' => '10:00 AM',
   
       '10:30' => '10:30 AM',
   
       '11:00' => '11:00 AM',
   
       '11:30' => '11:30 AM',
   
       '12:00' => '12:00 PM',
   
       '12:30' => '12:30 PM',
   
       '13:00' => '1:00 PM',
   
       '13:30' => '1:30 PM',
   
       '14:00' => '2:00 PM',
   
       '14:30' => '2:30 PM',
   
       '15:00' => '3:00 PM',
   
       '15:30' => '3:30 PM',
   
       '16:00' => '4:00 PM',
   
       '16:30' => '4:30 PM',   
   
       '17:00' => '5:00 PM',
   
       '17:30' => '5:30 PM',
   
       '18:00' => '6:00 PM',
   
       '18:30' => '6:30 PM',
   
       '19:00' => '7:00 PM',
   
       '19:30' => '7:30 PM',
   
       '20:00' => '8:00 PM',
   
       '20:30' => '8:30 PM',
   
       '21:00' => '9:00 PM',
   
       '21:30' => '9:30 PM',
   
       '22:00' => '10:00 PM',
   
       '22:30' => '10:30 PM',
   
       '23:00' => '11:00 PM',
   
       '23:30' => '11:30 PM',
   
       
   
   ); ?>
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
      <link href="<?php echo ASSETS; ?>css/owl.carousel.css" rel="stylesheet">
      <link href="<?php echo ASSETS; ?>css/flight_result.css" rel="stylesheet">
      <link href="<?php echo ASSETS; ?>css/pre_booking.css" rel="stylesheet">
      <link href="<?php echo ASSETS; ?>css/social.css" rel="stylesheet">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style type="text/css" media="screen">
         .required {
         color: red;
         }  
         .paymentpage{
         padding: 110px 0; 
         }
         .cartbukdis {
         margin-top: -112px;
         }
      </style>
   </head>
   <body>
      <style type="text/css">
         .new-width-30{
         width: 30%;
         float: left;
         }
         .new-width-70{
         width: 70%;
         float: left;
         }
         .cartbukdis{
         border: 1px solid #e6e6e6;
         border-radius: 3px;
         box-shadow: 0 0 5px #e6e6e6;
         margin-bottom: 13px;
         margin-top: 0px!important;
         }
         .lbllbl {
         color: #1a1717;
         }
         .waymensn {
         color: #000;
         }
      </style>
      <?php //debug($phone_code); exit; ?>
      <!-- Navigation -->
      <?php if($this->session->userdata('user_type')=='1'){
         echo $this->load->view(PROJECT_THEME.'/common/header');
         
         }else{
         
         echo $this->load->view(PROJECT_THEME.'/new_theme/header'); 
         
         } ?>
      <div class="clearfix"></div>
      <div class="full onlycontent top80">
         <div class="container martopbtm">
            <div class="paymentpage">
               <?php 
                  $Acount = 0;$Fcount = 0;$Hcount = 0;$Ccount = 0;$Bcount = 0;$Car_count = 0;$sight_count = 0;$transfer_count=0;$Car_v1_count = 0;
                  
                    $Vcount = 0;
                  
                    $Total = array();
                  
                    $cart_count=count($cart_global);
                  
                    // debug($search_id); exit();
                  
                      if($cart_count==1){ 
                  
                        foreach($cart_global as $key => $cid){
                  
                            list($module, $cid) = explode(',', $cid);     
                  
                          if($module == 'FLIGHT'){
                  
                            $Fcount = $Fcount+1;
                  
                          }
                  
                          if($module == 'HOTEL'){
                  
                            $Hcount = $Hcount+1;
                  
                          }
                  
                           if($module == 'BUS'){
                  
                            $Bcount = $Bcount+1;
                  
                          }
                  
                        }
                  
                      }  
                  
                      else{
                  
                         for($p=0;$p<$cart_count;$p++)
                  
                         {
                  
                             list($module, $cid) = explode(',',$cart_global[$p]);
                  
                             $module_final[$p]=$module;
                  
                            
                  
                         }
                  
                          $Pcount = $Pcount+1;
                  
                      }  
                  
                      $module_final1=base64_encode(json_encode($module_final));
                  
                  
                  
                    foreach($cart_global as $key => $cid){
                  
                    list($module, $cid) = explode(',', $cid);    
                  
                      if($module == 'FLIGHT'){
                  
                        $cart = $this->cart_model->getBookingTemp_flight($cid);
                  
                          $pricing_details = json_decode($cart->PricingDetails,true);
                  
                         // echo "<pre>"; print_r($pricing_details); exit;
                  
                          foreach($pricing_details[0]['PriceInfo']['PassengerFare'] as $key=>$val){
                  
                              $pax_type = $key;
                  
                            if($key=='ADT'){
                  
                              $pax_type='Adult';
                  
                            }elseif ($key=='CH') {
                  
                              $pax_type = 'Child';
                  
                            }elseif ($key=='INF') {
                  
                              $pax_type='Infant';
                  
                            }
                  
                              $price_summary['base_fare'][$key]['break_down'] = $val['count'].' '.$pax_type.'(s)'.' ('.$val['count'].'X'.$val['totalFareAmount'].')';
                  
                              $price_summary['base_fare'][$key]['total_amount'] = $val['count']*$val['totalFareAmount'];
                  
                          }
                  
                  
                  
                          $price_summary['taxes'] = $pricing_details[0]['PriceInfo']['totalTaxAmount'];
                  
                              $Totall[] = $cart->amount;
                  
                              // $Totall[] = $cart->amount + $price_summary['taxes'];
                  
                      }
                  
                      
                  
                      if($module == 'HOTEL'){
                  
                        $cart_data = $this->cart_model->getBookingTemp_hotel($cid);
                  
                  
                  
                         $Totall[] = $cart_data->total_cost;
                  
                      }
                  
                  
                      if($module == 'BUS'){
                  
                        $cart_data = $this->cart_model->getBookingTemp_bus($cid);
                  
                        if(($busMarkupval[0]->markup_fixed)>0 && ($busMarkupval[0]->markup_fixed)!='')
                        {
                            $busmarkupval = $busMarkupval[0]->markup_fixed;
                        }
                        else{
                           $busmark=$busMarkupval[0]->markup_value/100;
                           $busmarkupval=$cart_data->amount*$busmark;
                        
                        }
                           
                        
                          $Totall[] = round($cart_data->amount+$busmarkupval);
                         
                      }
                  
                         
                  
                    }
                  
                    $airline_code = '';
                  
                  ?>
               <div class="col-md-8 col-sm-8 nopad fulbuki">
                  <form name="checkout-apartment" id="checkout-apartment" onsubmit="return checkCheckBoxes(this);"  action="<?php echo WEB_URL;?>booking/checkout">
                     <?php if($this->session->userdata('user_type') == '1'){ ?>
                     <input type="hidden" name="user_type_name" value="B2B">
                     <?php } elseif($this->session->userdata('user_type') == '2' OR $this->session->userdata('user_type') == ''){ ?>  
                     <input type="hidden" name="user_type_name" value="B2C">
                     <?php } ?>
                     <input type="hidden" name="session_id" value="<?php echo $session_id_c; ?>">
                     <div class="col-md-12 col-sm-12 nopad fulbuki">
                        <div class="sumry_wrap">
                           <?php  
                              # print_r($cart_global);die;
                              
                              foreach($cart_global as $key => $cid){
                              
                                 list($module, $cid) = explode(',', $cid);
                              
                              
                              
                                 if($module == 'FLIGHT'){
                              
                                 $cart = $this->cart_model->getCartDataByModule($cid,$module)->row();
                              
                                 $segment_data = json_decode($cart->segment_data,1); 
                              
                                 // debug($segment_data);die;  
                              
                                 $flight_segment_details = array();
                              
                                 if($cart->api_id == 10){     
                              
                              ?>
                           <div class="pre_summery">
                              <div class="prebok_hding">
                                 <?php echo $this->general_model->get_airport_name($cart->origin); ?> (<?php echo $cart->origin; ?>)  <span class="fa fa-exchange"></span>  <?php echo $this->general_model->get_airport_name($cart->destination); ?> (<?php echo $cart->destination; ?>)
                              </div>
                              <?php
                                 for($s=0;$s<count($segment_data);$s++){  for($ss=0;$ss<count($segment_data[$s]['dateOfDeparture']);$ss++){
                                 
                                  $flight_segment_details[] = $segment_data[$s]['MarketingAirline'][$ss];
                                 
                                   ?>
                              <div class="sidenamedesc">
                                 <div class="celhtl width20 midlbord">
                                    <div class="fligthsmll">
                                       <img alt="" src="<?php echo 'https://c.fareportal.com/n/common/air/ai/'.$segment_data[$s]['MarketingAirline'][$ss].'.gif'; ?>">
                                       <?php
                                          $airline_code .= $segment_data[$s]['MarketingAirline'][$ss].';';
                                          
                                          ?>
                                       <div class="flitsmdets">
                                          <?php echo $segment_data[$s]['MarketingAirline'][$ss]; ?> <strong> <?php echo $segment_data[$s]['FlighvgtNumber_no'][$ss]; ?><br>
                                          </strong>
                                       </div>
                                    </div>
                                    <?php //echo //$onwards_f[$s]->TfClass;?>
                                    <?php //echo //$onwards_f[$s]->SupplierClass;?>
                                 </div>
                                 <div class="celhtl width80">
                                    <div class="waymensn">
                                       <div class="flitruo cloroutbnd">
                                          <div class="detlnavi">
                                             <div class="col-xs-4 padflt widfty">
                                                <div class="rndplace"><?php echo $this->general_model->get_airport_cityname($segment_data[$s]['OriginLocation'][$ss]); ?> <span class="timlbl right"> <span class="flname">(<?php echo $segment_data[$s]['OriginLocation'][$ss]; ?>)</span> </span></div>
                                                <div class="clearfix"></div>
                                                <span class="flitrlbl elipsetool"><?php echo date("M d,Y", strtotime($segment_data[$s]['DepartureDateTime_r'][$ss])); ?>, <span class="fltime"><?php echo date("H:i", strtotime($segment_data[$s]['DepartureDateTime_r'][$ss])); ?></span></span>
                                             </div>
                                             <div class="col-xs-2 nopad padflt widfty">
                                                <span class="fadr fa fa-long-arrow-right textcntr" style="font-size: 15px; line-height: 30px;"> </span>
                                             </div>
                                             <div class="col-xs-4 padflt widfty">
                                                <div class="rndplace"><?php echo $this->general_model->get_airport_cityname($segment_data[$s]['DestinationLocation'][$ss]); ?> <span class="timlbl"> <span class="flname">(<?php echo $segment_data[$s]['DestinationLocation'][$ss]; ?>)</span> </span></div>
                                                <div class="clearfix"></div>
                                                <span class="flitrlbl elipsetool"><?php echo date("M d,Y", strtotime($segment_data[$s]['ArrivalDateTime_r'][$ss])); ?>, <span class="fltime"><?php echo date("H:i", strtotime($segment_data[$s]['ArrivalDateTime_r'][$ss])); ?></span></span>
                                             </div>
                                             <div class="col-xs-2 nopad padflt widfty">
                                                <div class="lyovrtime">
                                                   <span class="flect"> <span class="fa fa-clock-o"></span> <?php echo $segment_data[$s]['segment_duration'][$ss]; ?></span>
                                                   <?php if(false){ ?>
                                                   <div class="instops <?php if(count($segment_data[$s]['FlighvgtNumber_no']) > 1) echo 'morestop'; if(count($segment_data[$s]['FlighvgtNumber_no']) > 2) echo 'plusone'; ?>">
                                                      <a class="stopone">
                                                      <label class="rounds"></label>
                                                      </a>
                                                      <a class="stopone">
                                                      <label class="rounds <?php if(count($segment_data[$s]['FlighvgtNumber_no']) != 2) echo 'oneonly'; ?>"></label>
                                                      <label class="rounds oneplus"></label>
                                                      </a>
                                                      <a class="stopone">
                                                      <label class="rounds"></label>
                                                      </a>
                                                   </div>
                                                   <span class="flects"><?php echo count($segment_data[$s]['FlighvgtNumber_no']) == 1 ? 0 : ( count($segment_data[$s]['FlighvgtNumber_no']) == 2 ? 1 : count($segment_data[$s]['FlighvgtNumber_no'])) ; ?> stop</span>
                                                   <?php } ?>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <?php if(false){ if(count($onwards_f) > 0 &&  $s+1 < count($onwards_f)){ ?>
                              <div class="layoverdiv">
                                 <div class="centovr">
                                    <span class="fa fa-plane"></span>
                                    Change of planes at   <?php echo $this->general_model->get_airport_name($onwards_f[$s]->Destination);?>
                                    |
                                    <span class="fa fa-clock-o"></span>
                                    Connection Time : <?php echo $Layover;?>
                                 </div>
                              </div>
                              <?php }} ?>
                              <?php
                                 } }
                                 
                                 ?>
                           </div>
                           <?php } else { ?>
                           <div class="pre_summery">
                              <div class="prebok_hding">
                                 <?php echo $this->general_model->get_airport_name($cart->origin); ?> (<?php echo $cart->origin; ?>)  <span class="fa fa-exchange"></span>  <?php echo $this->general_model->get_airport_name($cart->destination); ?> (<?php echo $cart->destination; ?>)
                              </div>
                              <?php
                             
                              //  echo count($segment_data);
                                 for($s=0;$s<count($segment_data);$s++){ 
                               //debug($segment_data['Segments'][0][$s]);
                                  for($ss=0;$ss<count($segment_data['Segments'][0][$s]['Origin']);$ss++){
                                 
                                    //debug($segment_data['Segments'][0][$s]['Airline']['AirlineCode']);exit;

                                   // echo  date("M d,Y", strtotime($segment_data['Segments'][0][$s]['StopPointArrivalTime']));exit;
                                   ?>
                              <div class="sidenamedesc">
                                 <div class="celhtl width20 midlbord">
                                    <div class="fligthsmll">
                                       <img alt="" src="<?php echo 'https://c.fareportal.com/n/common/air/ai/'.$segment_data['Segments'][0][$s]['Airline']['AirlineCode'].'.gif'; ?>">
                                       <?php
                                          $airline_code .= $segment_data[$s]['marketingCarrier'][$ss].';';
                                          
                                          ?>
                                       <div class="flitsmdets">
                                          <?php echo $segment_data['Segments'][0][$s]['Airline']['AirlineName']; ?> <strong> <?php echo $segment_data['Segments'][0][$s]['Airline']['FlightNumber']; ?><br>
                                          </strong>
                                       </div>
                                    </div>
                                    <?php //echo //$onwards_f[$s]->TfClass;?>
                                    <?php //echo //$onwards_f[$s]->SupplierClass;?>
                                 </div>
                                 <div class="celhtl width80">
                                    <div class="waymensn">
                                       <div class="flitruo cloroutbnd">
                                          <div class="detlnavi">
                                             <div class="col-xs-4 padflt widfty">
                                                <div class="rndplace"><?php echo $segment_data['Segments'][0][$s]['Origin']['Airport']['AirportName']; ?> <span class="timlbl right"> <span class="flname">(<?php echo $segment_data['Segments'][0][$s]['Origin']['Airport']['AirportCode']; ?>)</span> </span></div>
                                                <div class="clearfix"></div>
                                                <span class="flitrlbl elipsetool"><?php echo date("M d,Y", strtotime($segment_data['Segments'][0][$s]['Origin']['DepTime'])); ?>, <span class="fltime"><?php //echo $segment_data[$s]['DepartureTime'][$ss]; ?></span></span>
                                             </div>
                                             <div class="col-xs-2 nopad padflt widfty">
                                                <span class="fadr fa fa-long-arrow-right textcntr" style="font-size: 15px; line-height: 30px;"> </span>
                                             </div>
                                             <div class="col-xs-4 padflt widfty">
                                                <div class="rndplace"><?php echo $segment_data['Segments'][0][$s]['Destination']['Airport']['AirportName']; ?> <span class="timlbl"> <span class="flname">(<?php echo $segment_data['Segments'][0][$s]['Destination']['Airport']['AirportCode']; ?>)</span> </span></div>
                                                <div class="clearfix"></div>
                                                <span class="flitrlbl elipsetool"><?php echo date("M d,Y", strtotime($segment_data['Segments'][0][$s]['Destination']['ArrTime'])); ?>, <span class="fltime"><?php //echo $segment_data[$s]['ArrivalTime'][$ss]; ?></span></span>
                                             </div>
                                             <div class="col-xs-2 nopad padflt widfty">
                                                <div class="lyovrtime">
                                                   <span class="flect"> <span class="fa fa-clock-o"></span> <?php echo $segment_data[$s]['duration_time_zone'][$ss]; ?></span>
                                                   <?php if(false){ ?>
                                                   <div class="instops <?php if(count($segment_data[$s]['flightOrtrainNumber']) > 1) echo 'morestop'; if(count($segment_data[$s]['flightOrtrainNumber']) > 2) echo 'plusone'; ?>">
                                                      <a class="stopone">
                                                      <label class="rounds"></label>
                                                      </a>
                                                      <a class="stopone">
                                                      <label class="rounds <?php if(count($segment_data[$s]['flightOrtrainNumber']) != 2) echo 'oneonly'; ?>"></label>
                                                      <label class="rounds oneplus"></label>
                                                      </a>
                                                      <a class="stopone">
                                                      <label class="rounds"></label>
                                                      </a>
                                                   </div>
                                                   <span class="flects"><?php echo count($segment_data[$s]['flightOrtrainNumber']) == 1 ? 0 : ( count($segment_data[$s]['flightOrtrainNumber']) == 2 ? 1 : count($segment_data[$s]['flightOrtrainNumber'])) ; ?> stop</span>
                                                   <?php } ?>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <?php if(false){ if(count($onwards_f) > 0 &&  $s+1 < count($onwards_f)){ ?>
                              <div class="layoverdiv">
                                 <div class="centovr">
                                    <span class="fa fa-plane"></span>
                                    Change of planes at   <?php echo $this->general_model->get_airport_name($onwards_f[$s]->Destination);?>
                                    |
                                    <span class="fa fa-clock-o"></span>
                                    Connection Time : <?php echo $Layover;?>
                                 </div>
                              </div>
                              <?php }} ?>
                              <?php
                                 } }
                                 
                                 ?>
                           </div>
                           <?php } ?>    
                           <?php   }
                              if($module == 'HOTEL'){
                              
                              $cart = $this->cart_model->getCartDataByModule($cid,$module)->row();
                              
                              $CI = & get_instance();
                              
                              $CI->load->model('hotel_model');
                              
                              
                              
                              $hotel_data = $CI->hotel_model->get_hotel_other_details($cart->HotelCode,$cart->session_id);
                              
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
                              
                              
                              
                              ?>
                           <!--  Hotel Summery  -->
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
                                             <div class="col-xs-4 padflt widfty">
                                                <!--<span class="timlbl right"> <span class="flname"><span class="fltime">Check-in</span></span> </span>-->
                                                <div class="clearfix"></div>
                                                <span class="flitrlbl elipsetool"><?php echo date('M d,Y', strtotime($search_request['hotel_checkin'])); ?></span>
                                             </div>
                                             <div class="col-xs-4 nopad padflt widfty">
                                                <div class="lyovrtime"> <span class="flect"><?php echo $search_request['adult'][0]+$search_request['child'][0]; ?> Passenger(s)</span>
                                                   <span class="flects"> <?php echo $search_request['rooms']; ?> Room(s)</span> 
                                                </div>
                                             </div>
                                             <div class="col-xs-4 padflt widfty">
                                                <span class="timlbl left"> <span class="flname"><span class="fltime">Check-out</span> </span> </span>
                                                <div class="clearfix"></div>
                                                <span class="flitrlbl elipsetool"><?php echo date('M d,Y', strtotime($search_request['hotel_checkout'])); ?></span>
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
                           <!--  Hotel Summery End -->  
                           <?php }
                              }?>
                           <div class="clearfix"></div>
                           <div class="pre_summery">
                              <?php 
                                 if(!$this->session->userdata('user_id'))
                                 
                                 {
                                 
                                   ?>
                              <div class="prebok_hding spl_sigin">
                                 Sign in now to Book Online 
                              </div>
                              <div class="signing_detis">
                                 <div id="loginLdrReg_p" class="lodrefrentrev imgLoader">
                                    <div class="centerload"></div>
                                 </div>
                                 <div class="popuperror" style="display:none;"></div>
                                 <div class="col-md-7 nopad">
                                    <div class="wrp_pre">
                                       <input class="form-control logpadding pre_put" type="email" name="email"  placeholder="Email Address" required >
                                       <span class="sentmail_id">Your booking details will be sent to this email address.</span>
                                    </div>
                                 </div>
                                 <div class="col-md-1 celoty nopad linetopbtm xs-clear" style="padding: 15px;">
                                    <div class="orround xs-clear">OR</div>
                                 </div>
                                 <div class="col-md-4" style="padding: 15px;">
                                    <a class="btn btn-block btn-social btn-facebook">
                                    <i class="fa fa-facebook"></i> Sign in with Facebook
                                    </a>
                                    <a class="btn btn-block btn-social btn-google-plus">
                                    <i class="fa fa-google-plus"></i> Sign in with Google
                                    </a>
                                 </div>
                                 <div class="clearfix"></div>
                                 <div class="sign_twosec">
                                    <div class="section_sign" id="i_have_account">
                                       <div class="col-md-7 nopad">
                                          <div class="wrp_pre">
                                             <input class="form-control logpadding pre_put" type="password" name="password" id="pswd_p" placeholder="Password" >
                                             <div class="errMsg"></div>
                                          </div>
                                          <div class="clearfix"></div>
                                          <div class="wrp_pre">
                                             <input type="submit" class="paysubmit" name="continue" value="Continue" />
                                          </div>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="section_sign" id="con_as_guest">
                                       <div class="col-md-7 nopad">
                                          <div class="wrp_pre">
                                             <div class="col-xs-5 nopad">
                                                <select class="form-control pre_put newslterinput nputbrd _numeric_only" id="before_country_code" >
                                                <?php
                                                   echo diaplay_phonecode($phone_code, $user_country_code); ?>
                                                </select>
                                             </div>
                                             <div class="col-xs-1 nopad">
                                                <div class="mob_hi">-</div>
                                             </div>
                                             <div class="col-xs-6 nopad">
                                                <input type="text" maxlength="12" name="pn_mobil_no" data-mask="000000000000" class="form-control pre_put" required placeholder="Mobile Number" id="booking_user_mobile">
                                                <div class="errMsgf"></div>
                                             </div>
                                             <div class="clearfix"></div>
                                             <div class="sentmail_id">We'll use this number to send
                                                possible update alerts.
                                             </div>
                                          </div>
                                          <div class="clearfix"></div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="clearfix"></div>
                                 <div class="wrp_pre">
                                    <div class="squaredThree">
                                       <input type="checkbox" value="0" name="confirm" class="filter_airline" id="ihave" >
                                       <label for="ihave"></label>
                                    </div>
                                    <label for="ihave" class="have_account">I have an Account</label>
                                 </div>
                                 <!-- </form> -->
                              </div>
                              <?php
                                 }
                                 
                                 ?>
                              <div class="signing_detis_confirm" <?php  if(!$this->session->userdata('user_id'))
                                 { echo 'style="display:none"'; } ?> >
                                 <div class="col-md-6 nopad">
                                    <div class="wrp_pre">
                                       <span class="sentmail_id" id="user_logs_status"><?php echo $user_logs_status; ?></span>
                                    </div>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 col-sm-12 nopad fulbuki ">
                        <div class="sumry_wrap">
                           <div class="wrappay leftboks">
                              <div class="comon_backbg">
                                 <h3 class="inpagehed">Traveller </h3>
                                 <?php if($Fcount > 0 || $Hcount > 0 || $Ccount > 0|| $Bcount > 0){ ?>              
                                 <div class="sectionbuk">
                                    <div class="collapse in" id="collapse102">
                                       <?php
                                          $i=1; 
                                          
                                          foreach($cart_global as $key => $cid){
                                          
                                              list($module, $cid) = explode(',', $cid);
                                          
                                              if($module == 'FLIGHT'){
                                          
                                                  $cart = $this->cart_model->getBookingTemp_flight($cid);
                                          
                                                  $Total[] = $cart->total_cost;
                                          
                                                  $request = json_decode($cart->request_scenario);
                                          
                                          
                                          
                                                  // print_r($cart); exit;
                                          
                                          ?>          
                                       <div class="onedept">
                                          <div class="evryicon"><span class="fa fa-plane"></span></div>
                                          <div class="pasenger_location">
                                             <h3 class="inpagehedbuk">
                                                <span class="bookingcnt"><?php echo $i;?>.</span>
                                                <span class="aptbokname"><?php echo $cart->origin_city;?> (<?php echo $cart->origin;?>) - <?php echo $cart->destination_city;?> (<?php echo $cart->destination;?>)</span>            
                                             </h3>
                                             <span class="hwonum">Adult <?php echo $request->ADT; ?></span> <span class="hwonum">Child <?php echo $request->CHD; ?></span> <span class="hwonum">Infant <?php echo $request->INF; ?></span>
                                          </div>
                                          <div class="clearfix"></div>
                                          <?php 
                                             if ($this->session->userdata('user_id') !== "") {
                                             
                                                   $user_id = $this->session->userdata('user_id');
                                             
                                                   $user_type =  $this->session->userdata('user_type');
                                             
                                                   $userInfo = $this->general_model->get_user_details($user_id,$user_type);
                                             
                                             //       echo "<pre/>";print_r($userInfo);die('ffff');
                                             
                                                   $origin = $userInfo->home_airport;
                                             
                                                 }
                                             
                                                 // debug($userInfo);die;
                                             
                                                 $first_name = explode(" ", $userInfo->user_name)[0];
                                             
                                                 $last_name = explode(" ", $userInfo->user_name)[1];
                                             
                                                 $user_name = $userInfo->user_name;
                                             
                                                 $passport_number = $userInfo->passport_number;
                                             
                                                 // debug($userInfo);die;
                                             
                                                 if ($userInfo->passport_expirydate != "") {
                                             
                                                    $passport_expirydate = date('d/m/Y', strtotime($userInfo->passport_expirydate));
                                             
                                                 } else {
                                             
                                                   $passport_expirydate = "";
                                             
                                                 }
                                             
                                                 
                                             
                                                 $passport_issuing_country = $userInfo->passport_issuing_country;
                                             
                                             ?>
                                          <?php
                                             $flight_segment_details = array_unique($flight_segment_details);
                                             
                                             // debug($request); exit;
                                             
                                             $flight_segment_details = array_unique($flight_segment_details);
                                             
                                             if($request->ADT >0)
                                             
                                             {
                                             
                                                 for($k=0;$k<$request->ADT;$k++)
                                             
                                                 {
                                             
                                                     ?>
                                          <div class="payrow">
                                             <div class="repeatprows">
                                                <div class="col-md-12 downsrt set_margin nw-stylss">
                                                   <div class="lokter">
                                                      <span class="fa fa-user"></span>
                                                      <span class="whoare">Adult(<?php echo $k+1; ?>)</span>
                                                   </div>
                                                </div>
                                                <div class="col-md-2 set_margin">
                                                   <div class="paylabel">Title<span class="required">*</span></div>
                                                   <div class="selectedwrap">
                                                      <select class="flpayinput" name="a_gender<?php echo $cid; ?>[<?php echo $k; ?>]">
                                                         <option value="Male">Mr.</option>
                                                         <option value="Female">Mrs./Miss.</option>
                                                      </select>
                                                      <input type="hidden" name="search_request" value="<?=base64_encode(json_encode($request))?>" />
                                                   </div>
                                                </div>
                                                <div class="col-md-4 set_margin">
                                                   <div class="paylabel">First Name<span class="required">*</span></div>
                                                   <input placeholder="First Name" name="first_name<?php echo $cid;?>[<?php echo $k; ?>]"  type="text" class="payinput mytextbox" value="<?php if($k == 0){ echo $first_name;}?>" required />
                                                </div>
                                                <div class="col-md-4 set_margin">
                                                   <div class="paylabel">Last Name<span class="required">*</span></div>
                                                   <input placeholder="Last Name" name="last_name<?php echo $cid;?>[<?php echo $k; ?>]" type="text" id="<?php echo 'AL'.$k; ?>" class="payinput mytextbox" value="<?php if($k == 0){ echo $last_name;}?>" required />
                                                </div>
                                                <!-- 
                                                   <div class="clearfix"></div>
                                                   
                                                   <div class="col-md-2 set_margin"></div> -->
                                                <div class="col-md-2 set_margin">
                                                   <div class="paylabel">Date of Birth<span class="required">*</span></div>
                                                   <input type="text" name="aDate Of Birth<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput adt" value="" placeholder="Date of Birth" required readonly/>
                                                </div>
                                                <!-- <div class="clearfix"></div>
                                                   <div class="col-md-2 set_margin"></div>
                                                   
                                                   <div class="col-md-10 set_margin"><div class="paylabel psprt_head">Passport Details</div></div>
                                                   
                                                   <div class="clearfix"></div> 
                                                   
                                                   <div class="col-md-2 set_margin"></div>-->
                                                <?php if ($request->is_domestic != 1) { ?>
                                                <div class="col-md-4 set_margin">
                                                   <div class="paylabel">Passport No.<span class="required">*</span></div>
                                                   <input placeholder="Passport No." value="<?php if($k == 0){ echo $passport_number;}?>" name="apass<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput" type="text"  required/> 
                                                </div>
                                                <div class="col-md-4 set_margin">
                                                   <div class="paylabel">Passport Expiry<span class="required">*</span></div>
                                                   <input placeholder="Pasport Expiry" value="<?php if($k == 0){ echo $passport_expirydate;}?>" name="pass_expiry<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput passport_expiry" type="text" required readonly/> 
                                                </div>
                                                <?php } ?>
                                                <!-- </div> -->
                                                <?php if ($request->is_domestic != 1) { ?>
                                                <!-- <div class=""> -->
                                                <!--  <div class="col-md-2 set_margin"></div> -->
                                                <div class="col-md-4 set_margin">
                                                   <div class="paylabel">Issuing Country<span class="required">*</span></div>
                                                   <select class="payinput" id="issuing_country<?php echo $cid;?>[<?php echo $k; ?>]" name="issuing_country<?php echo $cid;?>[<?php echo $k; ?>]" required>
                                                      <option value="">Please Select</option>
                                                      <?php 
                                                         foreach ($countries as $country) { ?>
                                                      <option value="<?php echo $country->country_code; ?>" <?php if(($k == 0) && ($country->country_code == $passport_issuing_country)){ echo "selected";}?>><?php echo $country->country_name;?></option>
                                                      <?php } ?>
                                                   </select>
                                                </div>
                                                <!-- flight num-->
                                                <div class="col-md-6 set_margin">
                                                   <div class="paylabel">Frequent Flyer Program</div>
                                                   <select class="payinput" id="afrequent_air<?php echo $cid;?>[<?php echo $k; ?>]" name="afrequent_air<?php echo $cid;?>[<?php echo $k; ?>]" >
                                                      <option value="">Please Select</option>
                                                      <?php foreach($airline_list as $air_k=>$air_v):?>
                                                      <?php if(in_array($air_v->airline_code, $flight_segment_details)):?>
                                                      <option value="<?=$air_v->airline_code?>"><?=$air_v->airline_name?></option>
                                                      <?php endif;?>
                                                      <?php endforeach;?>
                                                   </select>
                                                </div>
                                                <div class="col-md-6 set_margin">
                                                   <div class="paylabel">Frequent Flyer Number</div>
                                                   <input type="text" name="afrequent_flyer<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput " value="" placeholder="Frequent Flyer Number"/>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-6 set_margin">
                                                   <div class="paylabel">Meals</div>
                                                   <select name="mealcode<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput">
                                                      <option value="">Please Select</option>
                                                      <option value="AVML">VEGETARIAN HINDU MEAL</option>
                                                      <option value="BBML">Baby meal /Infant/Baby Food</option>
                                                      <option value="BLML">BLAND MEAL</option>
                                                      <option value="CHML">CHILD MEAL</option>
                                                      <option value="CNML">CHICKEN MEAL (LY SPECIFIC)</option>
                                                      <option value="DBML">DIABETIC MEAL</option>
                                                      <option value="FPML">FRUIT PLATTER MEAL</option>
                                                      <option value="GFML">GLUTEN INTOLERANT MEAL</option>
                                                      <option value="HNML">HINDU (NON VEGETARIAN) MEAL SPECIFIC</option>
                                                      <option value="IVML">INDIAN VEGETARIAN MEAL (UA SPECIFIC)</option>
                                                      <option value="JPML">JAPANESE MEAL (LH SPECIFIC)</option>
                                                      <option value="KSML">KOSHER MEAL</option>
                                                      <option value="LCML">LOW CALORIE MEAL</option>
                                                      <option value="LFML">Low Cholesterol, Low Fat Meal</option>
                                                      <option value="LSML">Low Sodium, No Salt Added Meal</option>
                                                      <option value="MOML">MOSLEM MEAL</option>
                                                      <option value="NFML">NO FISH MEAL (LH SPECIFIC)</option>
                                                      <option value="NLML">LOW LACTOSE MEAL</option>
                                                      <option value="OBML">JAPANESE OBENTO MEAL (UA SPECIFIC)</option>
                                                      <option value="RVML">Raw Vegetarian Meal / Vegetarian Raw Meal</option>
                                                      <option value="SFML">SEA FOOD MEAL</option>
                                                      <option value="SPML">SPECIAL MEAL, SPECIFY FOOD</option>
                                                      <option value="VGML">VEGETARIAN VEGAN MEAL</option>
                                                      <option value="VJML">VEGETARIAN JAIN MEAL</option>
                                                      <option value="VOML">VEGETARIAN ORIENTAL MEAL</option>
                                                      <option value="VLML">VEGETARIAN LACTO-OVO MEAL</option>
                                                   </select>
                                                </div>
                                                <div class="col-md-6 set_margin">
                                                   <div class="paylabel">Special Assistance</div>
                                                   <select class="payinput" name="adult_special_assistance[]" >
                                                      <option value="">Please Select</option>
                                                      <option value="DEAF">  Deaf Passenger</option>
                                                      <!--  <option value="250773"> Meet and assist</option> -->                        
                                                      <option value="STCR"> Stretcher Passenger </option>
                                                      <option value="SLPR"> Berth/Bed in the Cabin, excludes stretcher </option>
                                                      <option value="BLND"> Blind Passenger </option>
                                                      <option value="WCHR"> Wheelchair(Assistance required to/from boarding gate) </option>
                                                      <option value="WCHS"> Wheelchair Assistance through apt and up/down steps (PRM SEAT)</option>
                                                      <option value="WCHC"> Wheelchair Assistance to seat including lift on/off (PRM seat) </option>
                                                   </select>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-12 set_margin">
                                                   <div class="paylabel">Extra Remarks</div>
                                                   <textarea name="extra_remarks" class="payinput mytextbox" style="height: 50px;"></textarea>
                                                </div>
                                             </div>
                                             <?php } ?>
                                          </div>
                                          <?php
                                             }
                                             
                                             
                                             
                                             }
                                             
                                             ?>
                                          <?php
                                             if($request->CHD >0)
                                             
                                             {
                                             
                                                 for($k=0;$k<$request->CHD;$k++)
                                             
                                                 {
                                             
                                                     ?>
                                          <div class="payrow">
                                             <div class="repeatprows">
                                                <div class="col-md-12 downsrt set_margin nw-stylss">
                                                   <div class="lokter">
                                                      <span class="fa fa-child"></span>
                                                      <span class="whoare">Child(<?php echo $k+1; ?>)</span>
                                                   </div>
                                                </div>
                                                <div class="col-md-2 set_margin">
                                                   <div class="paylabel">Title<span class="required">*</span></div>
                                                   <div class="selectedwrap">
                                                      <select class="flpayinput" name="c_gender<?php echo $cid; ?>[<?php echo $k; ?>]">
                                                         <option value="Male">Mr.</option>
                                                         <option value="Female">Mrs./Miss.</option>
                                                      </select>
                                                   </div>
                                                </div>
                                                <div class="col-md-4 set_margin">
                                                   <div class="paylabel">First Name<span class="required">*</span></div>
                                                   <input placeholder="First Name" name="cfirst_name<?php echo $cid;?>[<?php echo $k; ?>]" type="text" class="payinput mytextbox" value=""/>
                                                </div>
                                                <div class="col-md-4 set_margin">
                                                   <div class="paylabel">Last Name<span class="required">*</span></div>
                                                   <input placeholder="Last Name" name="clast_name<?php echo $cid;?>[<?php echo $k; ?>]" type="text" class="payinput mytextbox"/>
                                                </div>
                                                <div class="col-md-2 set_margin">
                                                   <div class="paylabel">Date Of Birth<span class="required">*</span></div>
                                                   <input placeholder="Date Of Birth" type="text" name="cDate Of Birth<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput chd" value="" readonly  required/>
                                                   <!--  <input placeholder="Child age" id="cDate Of Birth<?php echo $cid.'_'.$k; ?>" name="cDate Of Birth<?php echo $cid;?>[<?php echo $k; ?>]" type="text" class="payinput adt"/> -->
                                                </div>
                                                <div class="clearfix"></div>
                                                <!-- <div class="col-md-2 set_margin"></div>
                                                   <div class="col-md-10 set_margin"><div class="paylabel psprt_head">Passport Details</div></div>
                                                   
                                                    <div class="col-md-2 set_margin"></div> -->
                                                <?php if ($request->is_domestic != 1) { ?>
                                                <div class="col-md-4 set_margin">
                                                   <div class="paylabel">Passport No.<span class="required">*</span></div>
                                                   <input placeholder="Passport No." value="" name="cpass<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput" type="text" required /> 
                                                </div>
                                                <div class="col-md-4 set_margin">
                                                   <div class="paylabel">Passport Expiry<span class="required">*</span></div>
                                                   <input placeholder="Pasport Expiry" value="" name="cpass_expiry<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput passport_expiry" type="text" required readonly /> 
                                                </div>
                                                <?php } ?>
                                                <?php if ($request->is_domestic != 1) { ?>
                                                <div class="col-md-4 set_margin">
                                                   <div class="paylabel">Issuing Country<span class="required">*</span></div>
                                                   <select class="payinput" id="cissuing_country<?php echo $cid;?>[<?php echo $k; ?>]" name="cissuing_country<?php echo $cid;?>[<?php echo $k; ?>]" required>
                                                      <option value="">Please Select</option>
                                                      <?php 
                                                         foreach ($countries as $country) { ?>
                                                      <option value="<?php echo $country->country_code; ?>"><?php echo $country->country_name;?></option>
                                                      <?php } ?>
                                                   </select>
                                                </div>
                                                <div class="col-md-6 set_margin">
                                                   <div class="paylabel">Frequent Flyer Program</div>
                                                   <select class="payinput" id="afrequent_air<?php echo $cid;?>[<?php echo $k; ?>]" name="cfrequent_air<?php echo $cid;?>[<?php echo $k; ?>]" >
                                                      <option value="">Please Select</option>
                                                      <?php foreach($airline_list as $air_k=>$air_v):?>
                                                      <?php if(in_array($air_v->airline_code, $flight_segment_details)):?>
                                                      <option value="<?=$air_v->airline_code?>"><?=$air_v->airline_name?></option>
                                                      <?php endif;?>
                                                      <?php endforeach;?>
                                                   </select>
                                                </div>
                                                <div class="col-md-6 set_margin">
                                                   <div class="paylabel">Frequent Flyer Number</div>
                                                   <input type="text" name="cfrequent_flyer<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput " value="" placeholder="Frequent Flyer Number"/>
                                                </div>
                                                <div class="clearfix"></div>
                                             </div>
                                             <?php } ?>
                                             <div class="col-md-6 set_margin">
                                                <div class="paylabel">Meals</div>
                                                <select name="mealcode<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput">
                                                   <option value="">Please Select</option>
                                                   <option value="AVML">VEGETARIAN HINDU MEAL</option>
                                                   <option value="BBML">Baby meal /Infant/Baby Food</option>
                                                   <option value="BLML">BLAND MEAL</option>
                                                   <option value="CHML">CHILD MEAL</option>
                                                   <option value="CNML">CHICKEN MEAL (LY SPECIFIC)</option>
                                                   <option value="DBML">DIABETIC MEAL</option>
                                                   <option value="FPML">FRUIT PLATTER MEAL</option>
                                                   <option value="GFML">GLUTEN INTOLERANT MEAL</option>
                                                   <option value="HNML">HINDU (NON VEGETARIAN) MEAL SPECIFIC</option>
                                                   <option value="IVML">INDIAN VEGETARIAN MEAL (UA SPECIFIC)</option>
                                                   <option value="JPML">JAPANESE MEAL (LH SPECIFIC)</option>
                                                   <option value="KSML">KOSHER MEAL</option>
                                                   <option value="LCML">LOW CALORIE MEAL</option>
                                                   <option value="LFML">Low Cholesterol, Low Fat Meal</option>
                                                   <option value="LSML">Low Sodium, No Salt Added Meal</option>
                                                   <option value="MOML">MOSLEM MEAL</option>
                                                   <option value="NFML">NO FISH MEAL (LH SPECIFIC)</option>
                                                   <option value="NLML">LOW LACTOSE MEAL</option>
                                                   <option value="OBML">JAPANESE OBENTO MEAL (UA SPECIFIC)</option>
                                                   <option value="RVML">Raw Vegetarian Meal / Vegetarian Raw Meal</option>
                                                   <option value="SFML">SEA FOOD MEAL</option>
                                                   <option value="SPML">SPECIAL MEAL, SPECIFY FOOD</option>
                                                   <option value="VGML">VEGETARIAN VEGAN MEAL</option>
                                                   <option value="VJML">VEGETARIAN JAIN MEAL</option>
                                                   <option value="VOML">VEGETARIAN ORIENTAL MEAL</option>
                                                   <option value="VLML">VEGETARIAN LACTO-OVO MEAL</option>
                                                </select>
                                             </div>
                                             <div class="col-md-6 set_margin">
                                                <div class="paylabel">Special Assistance</div>
                                                <select class="payinput" name="adult_special_assistance[]" >
                                                   <option value="">Please Select</option>
                                                   <option value="DEAF">  Deaf Passenger</option>
                                                   <!--  <option value="250773"> Meet and assist</option> -->                        
                                                   <option value="STCR"> Stretcher Passenger </option>
                                                   <option value="SLPR"> Berth/Bed in the Cabin, excludes stretcher </option>
                                                   <option value="BLND"> Blind Passenger </option>
                                                   <option value="WCHR"> Wheelchair(Assistance required to/from boarding gate) </option>
                                                   <option value="WCHS"> Wheelchair Assistance through apt and up/down steps (PRM SEAT)</option>
                                                   <option value="WCHC"> Wheelchair Assistance to seat including lift on/off (PRM seat) </option>
                                                </select>
                                             </div>
                                             <div class="clearfix"></div>
                                             <div class="col-md-12 set_margin">
                                                <div class="paylabel">Extra Remarks</div>
                                                <textarea name="extra_remarks" class="payinput mytextbox" style="height: 50px;"></textarea>
                                             </div>
                                          </div>
                                          <?php
                                             }
                                             
                                             ?>
                                          <?php
                                             }
                                             
                                             ?>
                                          <?php
                                             if($request->INF >0)
                                             
                                             {
                                             
                                                 for($k=0;$k<$request->INF;$k++)
                                             
                                                 {
                                             
                                                     ?>
                                          <div class="payrow">
                                             <div class="repeatprows">
                                                <div class="col-md-12 downsrt set_margin nw-stylss">
                                                   <div class="lokter">
                                                      <span class="fa fa-child"></span>
                                                      <span class="whoare">Infant(<?php echo $k+1; ?>)</span>
                                                   </div>
                                                </div>
                                                <div class="col-md-2 set_margin">
                                                   <div class="paylabel">Title<span class="required">*</span></div>
                                                   <div class="selectedwrap">
                                                      <select class="flpayinput" name="i_gender<?php echo $cid; ?>[<?php echo $k; ?>]">
                                                         <option value="Male">Mr.</option>
                                                         <option value="Female">Mrs./Miss.</option>
                                                      </select>
                                                   </div>
                                                </div>
                                                <div class="col-md-4 set_margin">
                                                   <div class="paylabel">First Name<span class="required">*</span></div>
                                                   <input placeholder="First Name" name="ifirst_name<?php echo $cid;?>[<?php echo $k; ?>]" type="text" class="payinput mytextbox" value=""/>
                                                </div>
                                                <div class="col-md-4 set_margin">
                                                   <div class="paylabel">Last Name<span class="required">*</span></div>
                                                   <input placeholder="Last Name" name="ilast_name<?php echo $cid;?>[<?php echo $k; ?>]" type="text" class="payinput mytextbox"/>
                                                </div>
                                                <div class="col-md-2 set_margin">
                                                   <div class="paylabel">Date Of Birth<span class="required">*</span></div>
                                                   <input placeholder="Date Of Birth" type="text" name="iDate Of Birth<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput inf" value="" readonly  required/>
                                                   <!--    <input placeholder="Infant age" id="iDate Of Birth<?php echo $cid.'_'.$k; ?>" name="iDate Of Birth<?php echo $cid;?>[<?php echo $k; ?>]" type="text" class="payinput"/> -->
                                                </div>
                                                <?php if ($request->is_domestic != 1) { ?>
                                                <!--<div class="paylabel psprt_head">Passport Details</div></div>
                                                   <div class="col-md-2 set_margin"></div>-->
                                                <div class="col-md-4 set_margin">
                                                   <div class="paylabel">Passport No.<span class="required">*</span></div>
                                                   <input placeholder="Passport No." value="" name="ipass<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput" type="text" required  /> 
                                                </div>
                                                <div class="col-md-4 set_margin">
                                                   <div class="paylabel">Passport Expiry<span class="required">*</span></div>
                                                   <input placeholder="Passport Expiry" value="" name="ipass_expiry<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput passport_expiry" type="text"  required readonly /> 
                                                </div>
                                                <?php } ?>
                                                <?php if ($request->is_domestic != 1) { ?>
                                                <div class="col-md-4 set_margin">
                                                   <div class="paylabel">Issuing Country<span class="required">*</span></div>
                                                   <select class="payinput" id="iissuing_country<?php echo $cid;?>[<?php echo $k; ?>]" name="iissuing_country<?php echo $cid;?>[<?php echo $k; ?>]" required>
                                                      <option value="">Please Select</option>
                                                      <?php 
                                                         foreach ($countries as $country) { ?>
                                                      <option value="<?php echo $country->country_code; ?>"><?php echo $country->country_name;?></option>
                                                      <?php } ?>
                                                   </select>
                                                </div>
                                                <div class="clearfix"></div>
                                                <?php } ?>
                                             </div>
                                          </div>
                                          <?php
                                             }
                                             
                                             ?>
                                          <?php
                                             }
                                             
                                             ?>
                                          <?php $i++;}
                                             if($module == 'HOTEL'){
                                             
                                             $cart = $this->cart_model->getBookingTemp_hotel($cid);
                                             
                                            //  echo '<pre>';print_r($cart);exit();
                                             
                                             $Total[] = $cart->total_cost;
                                            // echo "<pre>";print_r($hotel_data);exit();
                                             ?>          
                                          <div class="onedept">
                                             <div class="evryicon"><span class="fa fa-bed"></span></div>
                                             <div class="pasenger_location">
                                                <h3 class="inpagehedbuk">
                                                   <span class="bookingcnt"><?php echo $i;?>.</span>
                                                   <span class="aptbokname"><?php echo $hotel_data['HotelName'] .'(' .$hotel_data['city']. ')'; ?></span>            
                                                </h3>
                                                <span class="hwonum">Adult <?php echo $search_request['adult'][0]; ?></span> <span class="hwonum">Child <?php echo $search_request['child'][0]; print_r($adult); ?></span>
                                             </div>
                                             <div class="clearfix"></div>
                                             <?php
                                                $room_count=$hotel_data['room_count'];
                                                for($r=0;$r<$room_count;$r++){
                                                 $adult=$search_request['adult'][0];
                                                if($adult >0)
                                                
                                                {
                                                
                                                    for($k=0;$k<$adult;$k++)
                                                
                                                    {
                                                
                                                        ?>
                                             <div class="payrow">
                                                <div class="repeatprows">
                                                   <div class="col-md-2 downsrt set_margin">
                                                      <div class="lokter">
                                                         <span class="fa fa-user"></span>
                                                         <span class="whoare">Adult(<?php echo $k+1; ?>)</span>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-2 set_margin">
                                                      <div class="selectedwrap">
                                                         <select class="flpayinput" name="a_gender<?php echo $cid; ?>[<?php echo $k; ?>]">
                                                            <option value="Mr">Mr</option>
                                                            <option value="Mrs">Mrs</option>
                                                            <option value="Miss">Miss</option>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-4 set_margin">
                                                      <input placeholder="First Name" name="first_name<?php echo $cid;?>[<?php echo $k; ?>]"  type="text" class="payinput mytextbox" value="" required />
                                                   </div>
                                                   <div class="col-md-4 set_margin">
                                                      <input placeholder="Last Name" name="last_name<?php echo $cid;?>[<?php echo $k; ?>]" type="text" id="<?php echo 'AL'.$k; ?>" class="payinput mytextbox" required />
                                                   </div>
                                                </div>
                                             </div>
                                             <?php
                                                }
                                                
                                                ?>
                                             <?php
                                                }
                                                
                                                ?>
                                             <?php
                                             $child=$search_request['child'][0];

                                                if($child >0)
                                                
                                                {
                                                
                                                    for($k=0;$k<$child;$k++)
                                                
                                                    {
                                                
                                                        ?>
                                             <div class="payrow">
                                                <div class="repeatprows">
                                                   <div class="col-md-2 downsrt set_margin">
                                                      <div class="lokter">
                                                         <span class="fa fa-male"></span>
                                                         <span class="whoare">Child (<?php echo $k+1; ?>)</span>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-2 set_margin">
                                                      <div class="selectedwrap">
                                                         <select class="flpayinput" name="c_gender<?php echo $cid; ?>[<?php echo $k; ?>]">
                                                            <option value="Mr">Mr</option>
                                                            <option value="Miss">Miss</option>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-4 set_margin">
                                                      <input placeholder="First Name" name="cfirst_name<?php echo $cid;?>[<?php echo $k; ?>]" type="text" class="payinput mytextbox" value=""/>
                                                   </div>
                                                   <div class="col-md-4 set_margin">
                                                      <input placeholder="Last Name" name="clast_name<?php echo $cid;?>[<?php echo $k; ?>]" type="text" class="payinput mytextbox"/>
                                                   </div>
                                                </div>
                                             </div>
                                             <?php
                                                }
                                            }
                                                ?>
                                             <?php
                                                }
                                                
                                                ?>
                                          </div>
                                          <?php $i++; }
                                             if($module == 'BUS'){
                                             
                                                $cart = $this->cart_model->getBookingTemp_bus($cid);
                                             
                                                $page_data_ = $this->cart_model->get_book_data($search_id);
                                             
                                                $page_data = base64_decode($page_data_->book_data);
                                             
                                                $page_data = json_decode($page_data, true);
                                             
                                                $search_data = $page_data['search_data'];
                                             
                                                $pax_details = $page_data['pax_details'];
                                             
                                                $total_fare = $page_data['total_fare'];
                                             
                                                $selected_seat_response = $page_data['selected_seat_response'];
                                             
                                                $resultIndex = $page_data['resultIndex'];
                                             
                                                $tokenId = $page_data['tokenId'];
                                             
                                                $traceId = $page_data['traceId'];
                                             
                                                $details = $page_data['details'];
                                             
                                                $pre_booking_params = $page_data['pre_booking_params'];
                                             
                                                $bus_seats = $details ['Layout'] ['SeatDetails'] ['clsSeat'];
                                             
                                                $bus_pickup = $details ['Pickup'] ['clsPickup'];
                                             
                                                $bus_drop = $details ['Drop'] ['clsDrop'];
                                             
                                                $CUR_CancellationCharges = $details ['CancellationCharges'] ['clsCancellationCharge'];
                                             
                                                $CUR_Route = ($details ['Route']);
                                             
                                                $bus_seats = $details ['Layout'] ['SeatDetails'] ['clsSeat'];
                                             
                                                $bus_pickup = $details ['Pickup'] ['clsPickup'];
                                             
                                                $bus_drop = $details ['Drop'] ['clsDrop'];
                                             
                                                $CUR_CancellationCharges = $details ['CancellationCharges'] ['clsCancellationCharge'];
                                             
                                                $seat_count = count ( $pre_booking_params ['seat'] );       
                                             
                                                
                                             
                                                $pickup_string = ($pickup['CityPointName'].' - '.get_time($pickup['CityPointTime']));
                                             
                                                $pickup_string .= ', Address : '.$pickup['CityPointAddress'].', Landmark : '.$pickup['CityPointLandmark'].', Phone : '.$pickup['CityPointContactNumber'];
                                             
                                                $drop_string = ($drop['CityPointName'].' - '.get_time($drop['CityPointTime']));
                                             
                                             
                                             
                                                $dynamic_params_url['RouteScheduleId'] = $pre_booking_params['route_schedule_id'];
                                             
                                                $dynamic_params_url['JourneyDate'] = $CUR_Route['DepartureTime'];
                                             
                                                $dynamic_params_url['PickUpID'] = $pre_booking_params['pickupId'];
                                             
                                                $dynamic_params_url['DropID'] = $pre_booking_params['dropId'];
                                             
                                                $dynamic_params_url['seat_attr'] = $seat_attr;
                                             
                                                $dynamic_params_url['selected_seats'] = $selected_seat_response; 
                                             
                                                $dynamic_params_url['DepartureTime'] = $CUR_Route['DepartureTime'];
                                             
                                                $dynamic_params_url['ArrivalTime'] = $CUR_Route['ArrivalTime'];
                                             
                                                $dynamic_params_url['departure_from'] = $details['Origin'];
                                             
                                                $dynamic_params_url['arrival_to'] = $details['Destination'];
                                             
                                                $dynamic_params_url['Form_id'] = $CUR_Route['Form_id'];
                                             
                                                $dynamic_params_url['To_id'] = $CUR_Route['To_id'];
                                             
                                                $dynamic_params_url['boarding_from'] = $pickup_string;//
                                             
                                                $dynamic_params_url['dropping_to'] = $drop_string;//
                                             
                                                $dynamic_params_url['bus_type'] = $pre_booking_params['bus_res']['TravelName'];
                                             
                                                $dynamic_params_url['operator'] = $pre_booking_params['bus_res']['TravelName'];
                                             
                                                $dynamic_params_url['CommPCT'] = $CUR_Route['CommPCT'];
                                             
                                                $dynamic_params_url['CommAmount'] = $CUR_Route['CommAmount'];
                                             
                                                $dynamic_params_url['gst_value'] = $gst_value;
                                             
                                                $dynamic_params_url['CancPolicy'] = base64_encode(json_encode($pre_booking_params['token']['result']['Canc']));
                                             
                                                $dynamic_params_url['resultIndex'] = $resultIndex;
                                             
                                                $dynamic_params_url['tokenId'] = $tokenId;
                                             
                                                $dynamic_params_url['traceId'] = $traceId;
                                             
                                             /*   debug($dynamic_params_url);
                                             
                                                debug($pre_booking_params);
                                             
                                                debug($page_data);
                                             
                                                exit;*/
                                             
                                                $dynamic_params_url = serialized_data($dynamic_params_url);                                   
                                             
                                               /* debug($cart);
                                             
                                                debug($details);*/
                                             
                                                // debug($CUR_Route);
                                             
                                                //echo '<pre>';print_r($cart);exit();
                                             
                                             
                                             
                                                $Total[] = $cart->amount;
                                             
                                                ?>          
                                          <div class="onedept">
                                             <!-- <div class="evryicon"><span class="fa fa-bed"></span></div> -->
                                             <div class="pasenger_location">
                                                <input type="hidden" required="required" name="token"   value="<?=$dynamic_params_url;?>" />
                                                <input type="hidden" required="required" name="token_key" value="<?=md5($dynamic_params_url);?>" />
                                                <input type="hidden" required="ResultToken" name="ResultToken"  value="<?=$pre_booking_params['ResultToken'];?>" />
                                                <div class="labltowr arimobold"><?php echo $details['Origin'];?> to <?php echo $details['Destination'];?><strong>(<?=get_time_duration_label(calculate_duration($CUR_Route['DepartureTime'], $CUR_Route['ArrivalTime']))?>)</strong></div>
                                                <!-- <h3 class="inpagehedbuk">
                                                   <span class="bookingcnt"><?php echo $i;?>.</span>
                                                   
                                                   <span class="aptbokname"><?php echo $hotel_data['HotelName'] .'(' .$hotel_data['city']. ')'; ?></span>            
                                                   
                                                   </h3>
                                                   
                                                   <span class="hwonum">Adult <?php echo $adult; ?></span> <span class="hwonum">Child <?php echo $child; ?></span> -->
                                             </div>
                                             <div class="clearfix"></div>
                                             <?php
                                                if($seat_count >0)
                                                
                                                {
                                                
                                                    for($k=0;$k<$seat_count;$k++)
                                                
                                                    {
                                                
                                                
                                                
                                                      $cur_pax_info = is_array($pax_details) ? array_shift($pax_details) : array();
                                                
                                                      $i_seat = $bus_seats[$pre_booking_params['seat'][$i]];
                                                
                                                      $attr['Fare']   = $i_seat['SeatFare'];                
                                                
                                                      $attr['Markup_Fare']= $i_seat['Markup_Fare'];
                                                
                                                      $i_seat_title = array();
                                                
                                                      if ($i_seat['SeatStatus'] != '0') {
                                                
                                                        $attr['IsAcSeat'] = false;
                                                
                                                        $i_seat_title[] = 'NON_AC';
                                                
                                                      } else {
                                                
                                                        $attr['IsAcSeat'] = true;
                                                
                                                        $i_seat_title[] = 'AC';
                                                
                                                      }                                                      
                                                
                                                      $i_seat_title[] = ($i_seat['IsLadiesSeat'] != false ? '' : 'Reserved For Ladies');
                                                
                                                      if ($i_seat['SeatType'] == '2') {
                                                
                                                        $i_seat_type = 'sleeper-A.png';
                                                
                                                        $attr['SeatType'] = 'sleeper';
                                                
                                                      } elseif ($i_seat['SeatType'] == '3') {
                                                
                                                        $attr['SeatType'] = 'seatCumSleeper';
                                                
                                                        $i_seat_type = 'seat-A.png';
                                                
                                                      }elseif ($i_seat['SeatType'] == '4') {
                                                
                                                        $attr['SeatType'] = 'UpperBerth';
                                                
                                                        $i_seat_type = 'seat-A.png';
                                                
                                                      }elseif ($i_seat['SeatType'] == '5') {
                                                
                                                        $attr['SeatType'] = 'LowerBerth';
                                                
                                                        $i_seat_type = 'seat-A.png';
                                                
                                                      }else
                                                
                                                      {
                                                
                                                        $attr['SeatType'] = 'seat';
                                                
                                                        $i_seat_type = 'seat-A.png';
                                                
                                                      }
                                                
                                                      $attr['seq_no'] = $i_seat['seq_no'];
                                                
                                                        ?>
                                             <div class="payrow">
                                                <div class="repeatprows">
                                                   <div class="col-md-2 downsrt set_margin">
                                                      <div class="lokter">
                                                         <span class="fa fa-user"></span>
                                                         <span class="whoare">Adult(<?php echo $k+1; ?>)</span>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-2 set_margin">
                                                      <div class="selectedwrap">
                                                         <select class="flpayinput" name="bgender[<?php echo $k; ?>]">
                                                            <option value="Mr">Mr</option>
                                                            <option value="Mrs">Mrs</option>
                                                            <option value="Miss">Miss</option>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-4 set_margin">
                                                      <input placeholder="First Name" name="bfirst_name[<?php echo $k; ?>]"  type="text" class="payinput mytextbox" value="" required />
                                                   </div>
                                                   <div class="col-md-4 set_margin">
                                                      <input placeholder="Last Name" name="blast_name[<?php echo $k; ?>]" type="text" id="<?php echo 'AL'.$k; ?>" class="payinput mytextbox" required />
                                                   </div>
                                                </div>
                                                <div class="repeatprows">
                                                   <div class="col-md-4 set_margin">
                                                      <!-- <input placeholder="Email" name="email[<?php echo $k; ?>]"  type="ema" class="payinput mytextbox" value="" required /> -->
                                                      <input type="email"  placeholder="Email"  id="email_id" name="bemail[<?php echo $k; ?>]" class="payinput" value="" required/>
                                                   </div>
                                                   <div class="col-md-4 set_margin">
                                                      <!-- <input placeholder="Age" name="age[<?php echo $k; ?>]"  type="text" class="payinput mytextbox" value="" required /> -->
                                                      <div class="col-md-8 set_margin">
                                                         <input type="text" placeholder="Mobile" name="bmobile[<?php echo $k; ?>]" class="payinput " data-mask="000000000000" value="" required/>
                                                      </div>
                                                      <div class="col-md-4 set_margin">
                                                         <input type="text" id="age" placeholder="Age" data-mask="000000000000" name="bage[<?php echo $k; ?>]"  class="payinput "  value="" required/>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-4 set_margin">
                                                      <div class="selectedwrap">
                                                         <select class="flpayinput" name="bgender[<?php echo $k; ?>]">
                                                            <option value="" selected disabled>Gender</option>
                                                            <option value="1">Male</option>
                                                            <option value="2">Female</option>
                                                         </select>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <?php
                                                $seat_attr['seats'][$i_seat['seat_no']] = $attr;
                                                
                                                $selected_seats['Seat'] = $i_seat;
                                                
                                                }
                                                
                                                ?>
                                             <?php
                                                }
                                                
                                                ?>
                                             <?php
                                                if($child >0)
                                                
                                                {
                                                
                                                    for($k=0;$k<$child;$k++)
                                                
                                                    {
                                                
                                                        ?>
                                             <div class="payrow">
                                                <div class="repeatprows">
                                                   <div class="col-md-2 downsrt set_margin">
                                                      <div class="lokter">
                                                         <span class="fa fa-male"></span>
                                                         <span class="whoare">Child (<?php echo $k+1; ?>)</span>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-2 set_margin">
                                                      <div class="selectedwrap">
                                                         <select class="flpayinput" name="c_gender<?php echo $cid; ?>[<?php echo $k; ?>]">
                                                            <option value="Mr">Mr</option>
                                                            <option value="Miss">Miss</option>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-4 set_margin">
                                                      <input placeholder="First Name" name="cfirst_name<?php echo $cid;?>[<?php echo $k; ?>]" type="text" class="payinput mytextbox" value=""/>
                                                   </div>
                                                   <div class="col-md-4 set_margin">
                                                      <input placeholder="Last Name" name="clast_name<?php echo $cid;?>[<?php echo $k; ?>]" type="text" class="payinput mytextbox"/>
                                                   </div>
                                                </div>
                                             </div>
                                             <?php
                                                }
                                                
                                                ?>
                                             <?php
                                                }
                                                
                                                ?>
                                          </div>
                                          <?php $i++; }
                                             ?>
                                          <?php  } }?> 
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="comon_backbg">
                                 <h3 class="inpagehed" data-toggle="collapse" data-target="#demo">GST number for business travel (Optional) <i class="fa fa-chevron-down" style="float: right;"></i></h3>
                                 <div class="sectionbuk billingnob collapse" id="demo" >
                                    <div class="payrow">
                                       <div class="col-md-6 set_margin">
                                          <div class="paylabel">Company Name</div>
                                          <input type="text" id="gst_cname" name="gst_cname" class="payinput mytextbox" />
                                       </div>
                                       <div class="col-md-6 set_margin">
                                          <div class="paylabel">Registration No</div>
                                          <input type="text" id="gst_reg_no" name="gst_reg_no" class="payinput mytextbox" />
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="comon_backbg">
                                 <h3 class="inpagehed">Address</h3>
                                 <div class="sectionbuk billingnob">
                                    <div class="payrow">
                                       <div class="col-md-2 set_margin">
                                          <div class="paylabel">Salutation</div>
                                          <div class="selectedwrap">
                                             <select class="flpayinput " name="saluation" required>
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                                <option value="Miss">Miss</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-5 set_margin">
                                          <div class="paylabel">First Name<span class="required">*</span></div>
                                          <input type="text" id="first_name" name="first_name" class="payinput mytextbox" value="<?php if(isset($userInfo) && $userInfo->user_name != NULL){echo $userInfo->user_name;} else { } ?>" required/>
                                       </div>
                                       <div class="col-md-5 set_margin">
                                          <div class="paylabel">Last Name<span class="required">*</span></div>
                                          <input type="text" id="last_name" name="last_name" class="payinput mytextbox" value="<?php if(isset($userInfo) && $userInfo->user_name != NULL){echo $userInfo->user_name;} else { }?>" required/>
                                       </div>
                                    </div>
                                    <input type="hidden" name="BlockTourId" value="<?=@$cart->BlockTourId?>">
                                    <input type="hidden" name="cid" id="cid" value="<?php echo @$cart_global_id;?>"/>
                                    <div class="payrow">
                                       <div class="col-md-4 set_margin">
                                          <div class="paylabel">Country Code<span class="required">*</span></div>
                                          <select class="form-control payinput  newslterinput nputbrd _numeric_only" id="before_country_code" required name="mobile_code">
                                          <?php
                                             echo diaplay_phonecode($phone_code, $user_country_code); ?>
                                          </select>
                                       </div>
                                       <div class="col-md-3 set_margin">
                                          <div class="paylabel">ContactNumber<span class="required">*</span></div>
                                          <input type="text" id="mobile" name="mobile" class="payinput " data-mask="000000000000" value="<?php if(isset($recent_billing->billing_contact_number) && $recent_billing->billing_contact_number != NULL){echo $recent_billing->billing_contact_number;} else { }?>" required/>
                                       </div>
                                       <div class="col-md-5 set_margin">
                                          <div class="paylabel">Email Address<span class="required">*</span></div>
                                          <input type="email" id="email" name="email" class="payinput" value="<?php if(isset($recent_billing->billing_email) && $recent_billing->billing_email != NULL){echo $recent_billing->billing_email;} else { }?>" required/>
                                       </div>
                                    </div>
                                    <div class="payrow">
                                       <span class="noteclick">
                                       After clicking "Book it" you will be redirected to payment gateway. You must complete the process or the transaction will not occur.
                                       </span>
                                    </div>
                                 </div>
                              </div>
                              <?php if($this->session->userdata('user_type')!='1'){ ?>
                              <div class="comon_backbg">
                                 <h3 class="inpagehed">Payment Information</h3>
                                 <div class="sectionbuk billingnob">
                                    <div class="payrow">
                                       <div class="col-md-3 set_margin">
                                          <div class="paylabel">Card Type</div>
                                          <div class="selectedwrap">
                                             <select class="flpayinput " name="card_type" required>
                                                <option value="">Select card</option>
                                                <option value="VI">Visa</option>
                                                <option value="CA">Master Card</option>
                                                <option value="AX">American Express</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-4 set_margin">
                                          <div class="paylabel">Card Holder Name</div>
                                          <input type="text" id="card_holder_name" name="card_holder_name" class="payinput mytextbox" placeholder="Card Holder Name" required/>
                                       </div>
                                       <div class="col-md-5 set_margin">
                                          <div class="paylabel">Card No</div>
                                          <input type="text" id="card_number" name="card_number" class="payinput" minlength="8" maxlength="16" placeholder="Card Number" data-rule-number= "true" required/>
                                       </div>
                                    </div>
                                    <div class="payrow">
                                       <div class="col-md-3 set_margin">
                                          <div class="paylabel">Expiry Date</div>
                                          <?php 
                                             $month_array[1] = ucfirst("January");
                                             
                                             $month_array[2] = ucfirst("February");
                                             
                                             $month_array[3] = ucfirst("March");
                                             
                                             $month_array[4] = ucfirst("April");
                                             
                                             $month_array[5] = ucfirst("May");
                                             
                                             $month_array[6] = ucfirst("June");
                                             
                                             $month_array[7] = ucfirst("July");
                                             
                                             $month_array[8] = ucfirst("August");
                                             
                                             $month_array[9] = ucfirst("September");
                                             
                                             $month_array[10] = ucfirst("October");
                                             
                                             $month_array[11] = ucfirst("November");
                                             
                                             $month_array[12] = ucfirst("December");
                                             
                                             ?>
                                          <div class="selectedwrap">
                                             <select class="flpayinput " name="exp_month" required>
                                                <option value="">Select Month</option>
                                                <option value="01"><?=$month_array[1] ?></option>
                                                <option value="02"><?=$month_array[2] ?></option>
                                                <option value="03"><?=$month_array[3] ?></option>
                                                <option value="04"><?=$month_array[4] ?></option>
                                                <option value="05"><?=$month_array[5] ?></option>
                                                <option value="06"><?=$month_array[6] ?></option>
                                                <option value="07"><?=$month_array[7] ?></option>
                                                <option value="08"><?=$month_array[8] ?></option>
                                                <option value="09"><?=$month_array[9] ?></option>
                                                <option value="10"><?=$month_array[10]?></option>
                                                <option value="11"><?=$month_array[11]?></option>
                                                <option value="12" selected><?=$month_array[12]?></option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-3 set_margin">
                                          <div class="paylabel">&nbsp;</div>
                                          <div class="selectedwrap">
                                             <select class="flpayinput " name="exp_year" required>
                                                <option selected="" value="">Select Year</option>
                                                <?php for($i=0; $i < 13; $i++){?>
                                                <option value="<?= date("Y", strtotime("+".$i." years"))?>"><?= date("Y", strtotime("+".$i." years"))?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-2 set_margin">
                                          <div class="paylabel">CVV</div>
                                          <input type="password" id="cvv_num" name="cvv_num" class="payinput" placeholder="CVV" maxlength="3" required/>
                                       </div>
                                       <div class="col-md-4 set_margin">
                                          <div class="paylabel">&nbsp;</div>
                                          <a href="#" class="cvv_pa showTip L1"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php } ?>
                              <div class="clearfix"></div>
                              <div class="col-md-12 nopad">
                                 <div class="checkcontent" style="overflow: inherit;">
                                    <div class="squaredThree"><input type="checkbox" value="0" name="confirm" class="filter_airline" id="squaredThree1"><label for="squaredThree1"></label></div>
                                    <label for="squaredThree1" class="lbllbl">By booking this item, you agree to pay the total amount shown, which includes Service Fees, on the right and to the<a data-toggle="modal" data-target="#terms_n_conditions" class="colorbl"> Terms &amp; Conditions</a>.</label>
                                 </div>
                              </div>
                              <input type="hidden" id="total_payable" name="total" value="<?php echo base64_encode(array_sum($Total)); ?>"/>
                              <input type="hidden" id="pcode" name="code" value="<?php echo $bt['pcode']; ?>"/>
                              <input type="hidden" name="session_id_xc" value="<?php echo $bt['session_id_xc']; ?>"/>
                              <input type="hidden" name="module_final1" value="<?php echo $module_final1; ?>"/>
                              <div class="clear"></div>
                              <div class="payrowsubmt">
                                 <div class="col-md-3 col-sm-12 fulat500 nopad">
                                    <input type="submit" class="paysubmit" name="continue" id="continue" value="Continue" />
                                 </div>
                                 <div class="col-md-9 col-xs-3 fulat500 nopad">
                                 </div>
                                 <div class="clear"></div>
                                 <div class="lastnote">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="col-md-4 col-sm-4  sidebuki">
                  <div class="cartbukdis">
                     <div class="liscartbuk">
                        <div class="lostcart">
                           <div class="prebok_hding">
                              Purchase Summary
                           </div>
                           <?php if($module == 'FLIGHT'){ 
                              if($cart->api_id == 10){
                              
                              ?>
                           <div class="cartlistingbuk">
                              <div class="cartitembuk">
                                 <div class="col-md-8 celcart">
                                    <div class="payblnhm">Base Fare</div>
                                 </div>
                              </div>
                              <?php 
                                 // debug($segment_data);
                                 
                                 $pax_array['ADT'] = "Adult";
                                 
                                 $pax_array['CNN'] = "Child";
                                 
                                 $pax_array['INF'] = "Infant";
                                 
                                 ?>
                              <div class="cartitembuk">
                                 <div class="col-md-8 celcart">
                                    <div class="payblnhm"><?= $pax_array[$segment_data[0]['PCode'][0]] ." X ". $segment_data[0]['PQuantity'][0] ?></div>
                                 </div>
                                 <div class="col-md-4 celcart">
                                    <div class="cartprc">
                                       <div class="ritaln cartcntamnt normalprc"><?php echo $this->display_icon?><?= number_format((($segment_data[0]['PEquivFare_org'][0] * $segment_data[0]['PQuantity'][0]) * $this->curr_val), 2) ?></div>
                                    </div>
                                 </div>
                              </div>
                              <?php if(isset($segment_data[0]['PCode'][1])){ ?>
                              <div class="cartitembuk">
                                 <div class="col-md-8 celcart">
                                    <div class="payblnhm"><?= $pax_array[$segment_data[0]['PCode'][1]] ." X ". $segment_data[0]['PQuantity'][1] ?></div>
                                 </div>
                                 <div class="col-md-4 celcart">
                                    <div class="cartprc">
                                       <div class="ritaln cartcntamnt normalprc"><?php echo $this->display_icon?><?= number_format(($segment_data[0]['PEquivFare_org'][1] * $segment_data[0]['PQuantity'][1] * $this->curr_val), 2) ?></div>
                                    </div>
                                 </div>
                              </div>
                              <?php } ?>
                              <?php if(isset($segment_data[0]['PCode'][2])){ ?>
                              <div class="cartitembuk">
                                 <div class="col-md-8 celcart">
                                    <div class="payblnhm"><?= $pax_array[$segment_data[0]['PCode'][2]] ." X ". $segment_data[0]['PQuantity'][2] ?></div>
                                 </div>
                                 <div class="col-md-4 celcart">
                                    <div class="cartprc">
                                       <div class="ritaln cartcntamnt normalprc"><?php echo $this->display_icon?><?= number_format(($segment_data[0]['PEquivFare_org'][2] * $segment_data[0]['PQuantity'][2] * $this->curr_val), 2) ?></div>
                                    </div>
                                 </div>
                              </div>
                              <?php } ?>
                              <div class="cartitembuk">
                                 <div class="col-md-8 celcart">
                                    <div class="payblnhm">Taxes & Fees</div>
                                 </div>
                                 <div class="col-md-4 celcart">
                                    <div class="cartprc">
                                       <?php $total_after_markup = ($admin_markup[0]->admin_markup)+($segment_data[0]['TotalTax']); ?>
                                       <!-- <div class="ritaln cartcntamnt normalprc"><?php echo BASE_CURRENCY_ICON?><?= $price_summary['taxes'] ?></div> -->
                                       <div class="ritaln cartcntamnt normalprc"><?php echo $this->display_icon?><?= number_format(($total_after_markup * $this->curr_val), 2); ?></div>
                                    </div>
                                 </div>
                              </div>
                              <?php } else { ?>
                              <div class="cartlistingbuk">
                                 <div class="cartitembuk">
                                    <div class="col-md-8 celcart">
                                       <div class="payblnhm">Base Fare</div>
                                    </div>
                                 </div>
                                 <?php 
                                    // debug($pricing_details[0]['PriceInfo']['PassengerFare']);
                                    
                                    $pax_array['ADT'] = "Adult";
                                    
                                    $pax_array['CNN'] = "Child";
                                    
                                    $pax_array['CH'] = "Child";
                                    
                                    $pax_array['INF'] = "Infant";
                                    
                                    ?>
                                 <?php foreach($pricing_details[0]['PriceInfo']['PassengerFare'] as $key=>$val){ ?>
                                 <div class="cartitembuk">
                                    <div class="col-md-8 celcart">
                                       <div class="payblnhm"><?= $pax_array[$key] ?> X <?= $pricing_details[0]['PriceInfo']['PassengerFare'][$key]['count'] ?></div>
                                    </div>
                                    <div class="col-md-4 celcart">
                                       <div class="cartprc">
                                          <div class="ritaln cartcntamnt normalprc"><?php echo $this->display_icon?> <?= number_format((($pricing_details[0]['PriceInfo']['PassengerFare'][$key]['totalFareAmount'] * $pricing_details[0]['PriceInfo']['PassengerFare'][$key]['count']) * $this->curr_val), 2) ?></div>
                                       </div>
                                    </div>
                                 </div>
                                 <?php } ?>
                                 <div class="cartitembuk">
                                    <div class="col-md-8 celcart">
                                       <div class="payblnhm">Taxes & Fees</div>
                                    </div>
                                    <div class="col-md-4 celcart">
                                       <div class="cartprc">
                                          <?php $total_after_markup = ($admin_markup[0]->admin_markup)+($pricing_details[0]['PriceInfo']['totalTaxAmount']); ?>
                                          <!-- <div class="ritaln cartcntamnt normalprc"><?php echo BASE_CURRENCY_ICON?><?= $price_summary['taxes'] ?></div> -->
                                          <div class="ritaln cartcntamnt normalprc"><?php echo $this->display_icon?> <?= number_format(($total_after_markup * $this->curr_val), 2); ?></div>
                                       </div>
                                    </div>
                                 </div>
                                 <?php } ?>
                                 <?php } ?>
                                 <div id="discount_row" class="cartitembuk hide">
                                    <div class="col-md-8 celcart">
                                       <div class="payblnhm">Discount</div>
                                    </div>
                                    <div class="col-md-4 celcart">
                                       <div class="cartprc">
                                          <div class="ritaln cartcntamnt normalprc discount"><?php echo $this->display_icon?><span class="amount">0.00</span></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="clear"></div>
                              <div class="cartlistingbuk nomarr">
                                 <div class="cartitembuk">
                                    <div class="col-md-8 celcart">
                                       <div class="payblnhm">Total</div>
                                    </div>
                                    <div class="col-md-4 celcart">
                                       <div class="cartprc">
                                          <div class="ritaln cartcntamnt bigclrfnt finalAmt"><?php echo $this->display_icon?><span class="amount"><?php echo number_format(( array_sum($Totall)), 2);?></span></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="clear"></div>
                              <div class="cartlistingbuk nomarr">
                                 <div class="cartitembuk">
                                    <div class="col-md-8 celcart">
                                       <div class="payblnhm">Total <small>( currency converted value )</small></div>
                                    </div>
                                    <div class="col-md-4 celcart">
                                       <div class="cartprc">
                                          <?php
                                             $CI =& get_instance();
                                             
                                             $CI->load->library(currency_converter);
                                             
                                             $price_val = array_sum($Totall) * $this->curr_val;
                                             
                                             $total_value = $CI->currency_converter->convert(BASE_CURRENCY,'USD',$price_val);
                                             
                                             
                                             
                                             ?>
                                          <input type="hidden" value="<?php echo $price_val; ?>" id="total_amount">
                                          <div class="ritaln cartcntamnt bigclrfnt finalAmt"><span id="curr_symbol"><?php echo '$';?></span>&nbsp;<span class="amount" id="curr_amount"><?php echo number_format($total_value, 2);?></span></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="clear"></div>
                              <div class="cartlistingbuk nomarr">
                                 <div class="cartitembuk">
                                    <div class="col-md-6 celcart">
                                       <div class="payblnhm">Currency List</small></div>
                                    </div>
                                    <div class="col-md-6 celcart">
                                       <div class="cartprc">
                                          <?php
                                             $currency_list = $this->general_model->get_currency_list();
                                             
                                             ?>
                                          <div class="ritaln cartcntamnt bigclrfnt finalAmt">
                                             <select class="form-control" id="currency_list">
                                                <?php foreach($currency_list as $data){ ?>
                                                <option <?php if($data->currency_code == 'USD'){echo 'selected';} ?> value="<?php echo $data->currency_code; ?>"><?php echo $data->currency_name; ?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="lostcart">
                           <div class="cartlistingbuk" style="border: 2px dashed #d6d6d6;">
                              <div class="cartitembuk">
                                 <div class="col-md-12">
                                    <div class="payblnhmxm">Promo code</div>
                                 </div>
                              </div>
                              <div class="clear"></div>
                              <div class="cartitembuk prompform">
                                 <form id="promocode" name="promocode" action="<?php echo WEB_URL;?>booking/promo">
                                    <div class="col-md-8 col-xs-8 nopadding_right">
                                       <div class="cartprc">
                                          <input type="hidden" name="total" value="<?php echo base64_encode(array_sum($Totall)); ?>">
                                          <input type="hidden" name="cid" id="cid" value="<?php echo $cart_global_id;?>"/>
                                          <input type="hidden" name="airline_code" value="<?=$airline_code?>">
                                          <div class="payblnhm singecartpricebuk ritaln">
                                             <input type="text" class="promocode" id="code" name="code" placeholder="Enter Promo" required/>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-4 col-xs-4 nopadding_left">
                                       <input type="submit" class="promosubmit" name="apply" value="Apply" />
                                    </div>
                                 </form>
                              </div>
                              <div class="clear"></div>
                              <div class="savemessage"></div>
                           </div>
                           </li>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
      <script type="text/javascript">
         var sessionCurrency = "<?=$this->curr_val?>";
         
          $(document).on('show','.accordion', function (e) {
         
                  //$('.accordion-heading i').toggleClass(' ');
         
                  $(e.target).prev('.accordion-heading').addClass('accordion-opened');
         
             });
         
             
         
             $(document).on('hide','.accordion', function (e) {
         
                 $(this).find('.accordion-heading').not($(e.target)).removeClass('accordion-opened');
         
                 //$('.accordion-heading i').toggleClass('fa-chevron-right fa-chevron-down');
         
             });
         
         
         
         $(document).ready(function(){
         
         
         
             $('#currency_list').on('change', function() {
         
                 var total = $('#total_amount').val();
         
                 var code = this.value;
         
                 $.ajax({
         
                  type:'POST',
         
                  dataType:'json',
         
                  data:{total_amount:total,currency_code:code,},
         
                  url:"<?php echo base_url('general/getCurrencyValue')?>",
         
                  success:function(e){
         
                      $('#curr_symbol').html(e.currency_code);
         
                      $('#curr_amount').html(e.converted_value);
         
         
         
                  }
         
                });
         
               
         
            });
         
             
         
         $(".car-togle").click(function(){
         
           $(".car-tglview").toggle("500ms","linear");
         
         });
         
         
         
         
         
         
         
         
         
           /*$('input#ihave[type="checkbox"]').click(function(){
         
             $('#pswd_p').val('');
         
             $('#booking_user_mobile').val('');
         
             if($(this).prop("checked") == true){
         
                $("#pswd_p").attr('required',true);
         
               $('#con_as_guest').fadeOut(500, function(){
         
                 $('#i_have_account').fadeIn(500);
         
               });
         
             }
         
             else if($(this).prop("checked") == false){
         
                $("#pswd_p").attr('required',false);
         
                     $('#i_have_account').fadeOut(500, function(){
         
                       $('#con_as_guest').fadeIn(500);
         
                     });
         
             }
         
           });*/
         
           $('input#ihave[type="checkbox"]').change(function(){
         
             if($(this).prop("checked") == true){
         
               $("#login_signup").addClass("open");
         
               $("#login_signup").addClass("dropdown-animating");
         
               $("#login_signup ul").addClass("animated").removeClass("fadeOutUp").addClass("fadeInOut");
         
               setTimeout(function(){
         
                   $("#login_signup ul").removeClass("animated").removeClass("fadeInOut").removeClass("fadeOutUp");
         
               },1000);
         
             }
         
             else if($(this).prop("checked") == false){ 
         
               $("#login_signup").removeClass("open");
         
               $("#login_signup").removeClass("dropdown-animating");
         
               $("#login_signup ul").addClass("animated").removeClass("fadeInOut").addClass("fadeOutUp");      
         
                setTimeout(function(){
         
                   $("#login_signup ul").removeClass("animated").removeClass("fadeInOut").removeClass("fadeOutUp");
         
               },1000);
         
             }
         
           });
         
         
         
           $("#bill_adding").owlCarousel({
         
             items : 2, 
         
             itemsDesktop : [1000,2],
         
             itemsDesktopSmall : [900,1], 
         
             itemsTablet: [600,1], 
         
             itemsMobile : [479,1], 
         
                 navigation : true,
         
             pagination : false
         
               });
         
             
         
             $('.addnewbill').click(function(){
         
             $('#bill_adding .item').removeClass('active'); 
         
             $(this).addClass('active');
         
             });
         
             
         
            $(".infoside, .smalinfo").tooltip();
         
              $('#squaredThree1').change(function() {
         
                 if($(this).prop('checked') == true){
         
                     $('#continue').removeAttr('disabled');
         
                 }else{
         
                     $('#continue').attr('disabled','disabled');
         
                 }
         
              });
         
         });
         
         
         
         
         
         <?php foreach($cart_global as $key => $cid){           
            list($module, $cid) = explode(',', $cid);
            
            if($module == 'FLIGHT'){
            
              $cart = $this->cart_model->getBookingTemp_flight($cid);
            
              $Total[] = $cart->total_cost;
            
              $request = json_decode($cart->request_scenario);
            
              if($request->CHD >0){
            
                for($k=0;$k<$request->CHD;$k++){ ?>
         
                   jQuery( "#cDate Of Birth<?php echo $cid.'_'.$k; ?>" ).datepicker({
         
                     maxDate: 0,
         
                     dateFormat: 'dd-mm-yy',
         
                     numberOfMonths: 2,
         
                     onClose: function( selectedDate ) {
         
                       
         
                     }
         
                   }); 
         
             
         
             <?php } }
            if($request->INF >0){
            
              for($k=0;$k<$request->INF;$k++){ ?>
         
                   jQuery( "#iDate Of Birth<?php echo $cid.'_'.$k; ?>" ).datepicker({
         
                     maxDate: 0,
         
                     dateFormat: 'dd-mm-yy',
         
                     numberOfMonths: 2,
         
                     onClose: function( selectedDate ) {
         
                       
         
                     }
         
                   }); 
         
             <?php } } 
            } } ?>
         
      </script>
      <script type="text/javascript" src="<?php echo ASSETS; ?>js/jquery.mask.js"></script>
      </script><script type="text/javascript">
         $(document).ready(function(){
         
         $('.date').mask('00/00/0000');
         
         $('.time').mask('00:00:00');
         
         $('.date_time').mask('00/00/0000 00:00:00');
         
         $('.cep').mask('00000-000');
         
         $('.phone').mask('0000-0000');
         
         $('.phone_with_ddd').mask('(00) 0000-0000');
         
         $('.phone_us').mask('(000) 000-0000');
         
         $('.mixed').mask('AAA 000-S0S');
         
         $('.cpf').mask('000.000.000-00', {reverse: true});
         
         $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
         
         $('.money').mask('000.000.000.000.000,00', {reverse: true});
         
         $('.money2').mask("#.##0,00", {reverse: true});
         
         $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
         
          translation: {
         
            'Z': {
         
              pattern: /[0-9]/, optional: true
         
            }
         
          }
         
         });
         
         $('.ip_address').mask('099.099.099.099');
         
         $('.percent').mask('##0,00%', {reverse: true});
         
         $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
         
         $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
         
         $('.fallback').mask("00r00r0000", {
         
            translation: {
         
              'r': {
         
                pattern: /[\/]/,
         
                fallback: '/'
         
              },
         
              placeholder: "__/__/____"
         
            }
         
          });
         
         $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
         
         });
         
         
         
         
         
      </script>
      <!-- Page Content -->
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>
      <script type="text/javascript" src="<?php echo ASSETS; ?>js/jquery.mask.js"></script>
      <!-- Script to Activate the Carousel --> 
      <script src="<?php echo ASSETS; ?>js/dw_tooltip_c.js" type="text/javascript"></script>
      <?php
         function diaplay_phonecode($phone_code, $user_country_code)
         
         {
         
         
         
         
         
         $list='';
         
         foreach($phone_code as $code){
         
         
         
         if($user_country_code==$code['iso_country_code']){
         
         $selected ="selected";
         
         }
         
         else {
         
         $selected="";
         
         }
         
         
         
         
         
         $list .="<option value=".$code['name']." ".$code['country_code']."  ".$selected." >".$code['name']." ".$code['country_code']."</option>";
         
         
         
         }
         
         return $list;
         
         
         
         }
         
         ?>
      <script type="text/javascript">
         /* 2 functions that can be used to vary tooltip width according to image width:
         
         dw_Tooltip.wrapImageToWidth and dw_Tooltip.wrapToWidth
         
         See www.dyn-web.com/code/tooltips/documentation2.php#wrapFn for info */
         
         dw_Tooltip.defaultProps = {
         
             //supportTouch: true, // set false by default
         
             wrapFn: dw_Tooltip.wrapImageToWidth
         
         }
         
         
         
         // Problems, errors? See http://www.dyn-web.com/tutorials/obj_lit.php#syntax
         
         
         
         dw_Tooltip.content_vars = {
         
             L1: {
         
                 img: '<?php echo ASSETS; ?>/images/cvv_number.png',
         
                 w: 225, // width of image
         
                 h: 138 // height of image
         
         
         
             }
         
         }
         
         
         
      </script>
      <script>
         var dateToday = new Date();
         
         var yrRange = dateToday.getFullYear() + ":" + (dateToday.getFullYear() + 25);
         
         
         
         var passport_expiry = $(".flight_departure_date").val();
         
         if(passport_expiry !='undefined'){
         
             passport_expiry = passport_expiry;
         
         }else{
         
             passport_expiry = '';
         
         }
         
         
         
          jQuery( ".adt" ).datepicker({
         
               changeMonth: true,
         
               changeYear: true,
         
               dateFormat: 'dd/mm/yy',
         
               yearRange: "-80:-12",
         
               maxDate: "-12y",
         
           });
         
          jQuery( ".passport_expiry" ).datepicker({
         
                changeMonth: true,
         
              changeYear: true,
         
              dateFormat: 'dd/mm/yy',
         
              yearRange : yrRange,
         
              minDate: dateToday
         
          });
         
           jQuery( ".chd" ).datepicker({
         
                 changeMonth: true,
         
               changeYear: true,
         
               dateFormat: 'dd/mm/yy',
         
               yearRange: "-12:-2",
         
               minDate: "-12y",
         
               maxDate: "-2y",
         
           });
         
           jQuery( ".inf" ).datepicker({
         
               changeMonth: true,
         
               changeYear: true,
         
               dateFormat: 'dd/mm/yy',
         
               yearRange: "-2:+0",
         
               minDate: "-2y",
         
               maxDate: "0",
         
           });
         
           
         
      </script>
      <script type="text/javascript">      
         $(".mytextbox").on("keypress", function(event) {
         
         
         
           var eng = /[A-Za-z ]/g;
         
           var key = String.fromCharCode(event.which);
         
         
         
           if (event.keyCode == 8 || event.keyCode == 37 || event.keyCode == 39 || eng.test(key)) {
         
               return true;}
         
           return false;
         
         });
         
         
         
         $('.mytextbox').on("paste",function(e)
         
         {  e.preventDefault();});
         
         
         
         $(document).ready(function(){
         
         $('.date').mask('00/00/0000');
         
         $('.time').mask('00:00:00');
         
         $('.date_time').mask('00/00/0000 00:00:00');
         
         $('.cep').mask('00000-000');
         
         $('.phone').mask('0000-0000');
         
         $('.phone_with_ddd').mask('(00) 0000-0000');
         
         $('.phone_us').mask('(000) 000-0000');
         
         $('.mixed').mask('AAA 000-S0S');
         
         $('.cpf').mask('000.000.000-00', {reverse: true});
         
         $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
         
         $('.money').mask('000.000.000.000.000,00', {reverse: true});
         
         $('.money2').mask("#.##0,00", {reverse: true});
         
         $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
         
           translation: {
         
             'Z': {
         
               pattern: /[0-9]/, optional: true
         
             }
         
           }
         
         });
         
         $('.ip_address').mask('099.099.099.099');
         
         $('.percent').mask('##0,00%', {reverse: true});
         
         $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
         
         $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
         
         $('.fallback').mask("00r00r0000", {
         
             translation: {
         
               'r': {
         
                 pattern: /[\/]/,
         
                 fallback: '/'
         
               },
         
               placeholder: "__/__/____"
         
             }
         
           });
         
         $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
         
         });
         
         
         
      </script>
      <style>
         .ui-datepicker.ui-widget .ui-datepicker-header,.ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year{
         background-color: #fff;
         }
         #ui-datepicker-div .ui-datepicker-title .ui-datepicker-month{
         margin:0;
         width: 28%;
         }
         #ui-datepicker-div .ui-datepicker-year{
         width: 34%;
         margin-left: 10px !important;
         }
         #ui-datepicker-div .ui-datepicker-title .ui-datepicker-month, #ui-datepicker-div .ui-datepicker-year{
         text-align: center;
         margin: 0 auto;
         font-size: 13px!important;    
         padding: 5px;    
         border: 1px solid #CCC;
         height: 30px;
         border-radius: 3px;
         -webkit-appearance: menulist-button;
         }
         .ui-datepicker.ui-widget .ui-datepicker-prev::after, .ui-datepicker.ui-widget .ui-datepicker-next::after{
         color: #333;
         border: 1px solid #ccc;
         }
         div#ui-datepicker-div.ui-datepicker{
         border: 1px solid #CCC;
         }
         #ui-datepicker-div.ui-datepicker .ui-datepicker-title {
         line-height: 15px;
         }
      </style>
      <script type="text/javascript" language="JavaScript">
         function checkCheckBoxes(theForm) {
         
             if (theForm.confirm.checked == false) 
         
             {
         
                 alert('You must agree to the terms first.');
         
                 return false;
         
             } else { 
         
                 return true;
         
             }
         
         }
         
      </script>
      <script type="text/javascript">
         $('select[name="country"]').on('change',function(){
         
           var country_id = $(this).val();
         
         
         
           $.ajax({
         
           type:'POST',
         
           dataType:'json',
         
           data:{id:country_id},
         
           url:"<?php echo base_url('general/getStateCity')?>",
         
           success:function(e){
         
               $('select[name="state"]').html(e.states);
         
               $('select[name="city"]').html(e.cities);
         
         
         
           }
         
         });
         
         
         
          });
         
         
         
         // $('select[name="country"]').on('change',function(){alert("FSDFSDFS");
         
         //   var country_id = $(this).val();
         
         //   alert(country_id);
         
         
         
         //   $.ajax({
         
         //   type:'POST',
         
         //   dataType:'json',
         
         //   data:{s_id:country_id},
         
         //   url:"<?php echo base_url('general/getCity')?>",
         
         //   success:function(e){
         
         //       $('select[name="city"]').html(e.city);
         
         //   }
         
         // });
         
         
         
         //  });
         
         
         
         $('select[name="state"]').on('change',function(){
         
           var state_id = $(this).val();
         
           // alert(state_id);
         
           $.ajax({
         
           type:'POST',
         
           dataType:'json',
         
           data:{s_id:state_id},
         
           url:"<?php echo base_url('general/getCity')?>",
         
           success:function(e){
         
               $('select[name="city"]').html(e.cities);
         
           }
         
         });
         
         
         
          });
         
      </script> 
   </body>
</html>