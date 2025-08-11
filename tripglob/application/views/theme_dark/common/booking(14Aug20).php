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
         <?php 
            /*if(isset($search_request)){                
                if($search_module=='FLIGHT'){
                   $search_data['req'] =$search_req;
                   $search_data['request'] = $search_request;
                  echo  $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/modify_flight_search', $search_data);  
                }elseif ($search_module=='HOTEL') {
                   $search_data['request_data'] = $search_request;
                  echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/modify_hotel_search', $search_data);  
                }elseif($search_module=='CAR'){
                   $search_data['req'] = $search_request;         
                  echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/modify_car_search', $search_data);  
                }
             }*/
            ?>
         <div class="container martopbtm">
            <div class="payment_process">
               <div class="col-xs-4 nopad">
                  <div class="center_pro active">
                     <div class="fabols"></div>
                     <div class="center_labl">Review</div>
                  </div>
               </div>
               <div class="col-xs-4 nopad">
                  <div class="center_pro">
                     <div class="fabols"></div>
                     <div class="center_labl">Travelers</div>
                  </div>
               </div>
               <div class="col-xs-4 nopad">
                  <div class="center_pro">
                     <div class="fabols"></div>
                     <div class="center_labl">Payment</div>
                  </div>
               </div>
            </div>
            <div class="paymentpage">
               <?php 
                  $Acount = 0;$Fcount = 0;$Hcount = 0;$Ccount = 0;$Car_count = 0;$sight_count = 0;$transfer_count=0;$Car_v1_count = 0;
                    $Vcount = 0;
                    $Total = array();
                    $cart_count=count($cart_global);
                      if($cart_count==1){ 
                        foreach($cart_global as $key => $cid){
                            list($module, $cid) = explode(',', $cid);     
                          if($module == 'FLIGHT'){
                            $Fcount = $Fcount+1;
                          }
                          if($module == 'HOTEL'){
                            $Hcount = $Hcount+1;
                          }
                          if($module == 'CAR'){
                            $Car_count = $Car_count+1;
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
                      
                      if($module == 'CAR'){
                        $cart = $this->cart_model->getBookingTemp_car($cid);
                              $Totall[] = $cart->car_rate;
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

                               if($cart->api_id == 2){ 
                               $segment_data1 = json_decode($cart->segment_data,1); 
                               $segment_data =$segment_data1['Segments'];
                               $flight_segment_details = array();
                            ?>
                         <div class="pre_summery">
                            <div class="prebok_hding">
                               <?php echo $this->general_model->get_airport_name($cart->origin); ?> (<?php echo $cart->origin; ?>)  <span class="fa fa-exchange"></span>  <?php echo $this->general_model->get_airport_name($cart->destination); ?> (<?php echo $cart->destination; ?>)
                            </div>
                            <?php
                               for($s=0;$s<count($segment_data);$s++){

                                 for($ss=0;$ss<count($segment_data[$s]);$ss++){
                           
                           // echo "<pre/>";print_r($segment_data[$s][$ss]);exit("raj");


                                //$flight_segment_details[] = $segment_data[$s]['MarketingAirline'][$ss];
                                 ?>
                            <div class="sidenamedesc">
                               <div class="celhtl width20 midlbord">
                                  <div class="fligthsmll">
                                     <img alt="" src="<?php echo 'https://c.fareportal.com/n/common/air/ai/'.$segment_data[$s][$ss]['Airline']['AirlineCode'].'.gif'; ?>">
                                     <?php
                                        $airline_code .= $segment_data[$s][$ss]['Airline']['AirlineCode'].';';
                                        ?>
                                     <div class="flitsmdets">
                                        <?php echo $segment_data[$s][$ss]['Airline']['AirlineCode'].'-'.$segment_data[$s][$ss]['Airline']['AirlineName']; ?> <strong> <?php echo $segment_data[$s][$ss]['Airline']['FlightNumber']; ?><br>
                                        </strong>
                                     </div>
                                  </div>
                               </div>
                               <div class="celhtl width80">
                                  <div class="waymensn">
                                     <div class="flitruo cloroutbnd">
                                        <div class="detlnavi">
                                           <div class="col-xs-4 padflt widfty">
                                              <div class="rndplace"><?php echo $segment_data[$s][$ss]['Origin']['Airport']['CityName']; ?> <span class="timlbl right"> <span class="flname">(<?php echo $segment_data[$s][$ss]['Origin']['Airport']['AirportCode']; ?>)</span> </span></div>
                                              <div class="clearfix"></div>
                                              <?php
                                              $ddd=explode('T',$segment_data[$s][$ss]['Origin']['DepTime']);
                                              ?>


                                              <span class="flitrlbl elipsetool"><?php echo $ddd[0]; ?>, <span class="fltime"><?php echo $ddd[1]; ?></span></span>
                                           </div>
                                           <div class="col-xs-2 nopad padflt widfty">
                                              <span class="fadr fa fa-long-arrow-right textcntr" style="font-size: 15px; line-height: 30px;"> </span>
                                           </div>
                                           <div class="col-xs-4 padflt widfty">
                                              <div class="rndplace"><?php echo $segment_data[$s][$ss]['Destination']['Airport']['CityName']; ?> <span class="timlbl"> <span class="flname">(<?php echo $segment_data[$s][$ss]['Destination']['Airport']['AirportCode']; ?>)</span> </span></div>
                                              <div class="clearfix"></div>
                                              <?php 
                                                 $aaa=explode('T',$segment_data[$s][$ss]['Destination']['ArrTime']);
                                               ?>
                                              <span class="flitrlbl elipsetool"><?php echo $aaa[0]; ?>, <span class="fltime"><?php echo $aaa[1]; ?></span></span>
                                           </div>
                                           <div class="col-xs-2 nopad padflt widfty">
                                              <div class="lyovrtime">

                                                <?php 
                                                $time=$segment_data[$s][$ss]['Duration'];

                                                 $hours = floor($time / 60);
                                                 $minutes = ($time % 60);
                                                 ?>
                                                 <span class="flect"> <span class="fa fa-clock-o"></span> <?php echo $hours.'h:'.$minutes.'m'; ?></span>
                                                
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
                         <?php } else { 
                               $segment_data = json_decode($cart->segment_data,1); 
                               ?>
                         <div class="pre_summery">
                            <div class="prebok_hding">
                               <?php echo $this->general_model->get_airport_name($cart->origin); ?> (<?php echo $cart->origin; ?>)  <span class="fa fa-exchange"></span>  <?php echo $this->general_model->get_airport_name($cart->destination); ?> (<?php echo $cart->destination; ?>)
                            </div>
                            <?php
                               for($s=0;$s<count($segment_data);$s++){  for($ss=0;$ss<count($segment_data[$s]['dateOfDeparture']);$ss++){
                                 ?>
                            <div class="sidenamedesc">
                               <div class="celhtl width20 midlbord">
                                  <div class="fligthsmll">
                                     <img alt="" src="<?php echo 'https://c.fareportal.com/n/common/air/ai/'.$segment_data[$s]['marketingCarrier'][$ss].'.gif'; ?>">
                                     <?php
                                        $airline_code .= $segment_data[$s]['marketingCarrier'][$ss].';';
                                        ?>
                                     <div class="flitsmdets">
                                        <?php echo $segment_data[$s]['marketingCarrier'][$ss]; ?> <strong> <?php echo $segment_data[$s]['flightOrtrainNumber'][$ss]; ?><br>
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
                                              <div class="rndplace"><?php echo $this->general_model->get_airport_cityname($segment_data[$s]['locationIdDeparture'][$ss]); ?> <span class="timlbl right"> <span class="flname">(<?php echo $segment_data[$s]['locationIdDeparture'][$ss]; ?>)</span> </span></div>
                                              <div class="clearfix"></div>
                                              <span class="flitrlbl elipsetool"><?php echo date("M d,Y", strtotime($segment_data[$s]['DepartureDate'][$ss])); ?>, <span class="fltime"><?php echo $segment_data[$s]['DepartureTime'][$ss]; ?></span></span>
                                           </div>
                                           <div class="col-xs-2 nopad padflt widfty">
                                              <span class="fadr fa fa-long-arrow-right textcntr" style="font-size: 15px; line-height: 30px;"> </span>
                                           </div>
                                           <div class="col-xs-4 padflt widfty">
                                              <div class="rndplace"><?php echo $this->general_model->get_airport_cityname($segment_data[$s]['locationIdArival'][$ss]); ?> <span class="timlbl"> <span class="flname">(<?php echo $segment_data[$s]['locationIdArival'][$ss]; ?>)</span> </span></div>
                                              <div class="clearfix"></div>
                                              <span class="flitrlbl elipsetool"><?php echo date("M d,Y", strtotime($segment_data[$s]['ArrivalDate'][$ss])); ?>, <span class="fltime"><?php echo $segment_data[$s]['ArrivalTime'][$ss]; ?></span></span>
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
                                
                               // $hotel_request = unserialize($hotel_data['request']);
                                
                                $hotel_request = json_decode($cart->search_history,true);
                                //echo '<pre>';print_r($hotel_request);exit();
                                
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
                               <!-- <form id="login_prebook" method="post" name="login" login-action="<?php echo WEB_URL;?>account/login" reg-action="<?php echo WEB_URL;?>account/create_with_email" autocomplete="off"> -->

                                  <!-- <input type="hidden" name="user_type_name" value="B2C">
                                  <input type="hidden" name="session_id" value="<?php echo $session_id_c; ?>"> -->
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
                                              <!--  <a class="fadeandscale_close fadeandscaleforget_open forgtpsw pre_forgot" id="forgtpsw">Forgot password?</a>      -->
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
                                           <!-- <div class="wrp_pre">
                                              <input type="submit" class="paysubmit" name="continue_c" value="Continue as guest" />
                                           </div> -->
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
                   <!-- <form name="checkout-apartment" id="checkout-apartment"  action="<?php echo WEB_URL;?>booking/checkout"> -->
                      <div class="sumry_wrap">
                         <div class="wrappay leftboks">
                            <div class="comon_backbg">
                               <h3 class="inpagehed">Traveller </h3>
                               <?php if($Fcount > 0 || $Hcount > 0 || $Ccount > 0){ ?>              
                               <div class="sectionbuk">
                                  <!--<button class="collapsebtn2 collapsed bukcolsp" data-target="#collapse102" data-toggle="collapse" type="button">
                                     Flight Bookings (<?php echo $Fcount;?>)
                                     <span class="collapsearrow"></span>
                                     <span class="editbuk">Edit</span>
                                     </button>  -->
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
                                                <select name="mealcode" class="payinput">
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
                                            //echo '<pre>';print_r($cart);exit();
                                            $Total[] = $cart->total_cost;
                                            ?>          
                                            <div class="onedept">
                                                <div class="evryicon"><span class="fa fa-bed"></span></div>
                                                <div class="pasenger_location">
                                                    <h3 class="inpagehedbuk">
                                                        <span class="bookingcnt"><?php echo $i;?>.</span>
                                                        <span class="aptbokname"><?php echo $hotel_data['HotelName'] .'(' .$hotel_data['city']. ')'; ?></span>            
                                                    </h3>
                                                    <span class="hwonum">Adult <?php echo $adult; ?></span> <span class="hwonum">Child <?php echo $child; ?></span>
                                                </div>
                                                <div class="clearfix"></div>
                                                <?php
                                            
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
                                     <div class="col-md-5 set_margin">
                                        <div class="paylabel">Company Name</div>
                                        <input type="text" id="gst_cname" name="gst_cname" class="payinput mytextbox" />
                                     </div>
                                     <div class="col-md-5 set_margin">
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
                              <!--     <div class="payrow">
                                     <div class="col-md-6 set_margin">
                                        <div class="paylabel">Address</div>
                                        <input type="text" id="street_address" name="street_address" class="payinput" value="<?php if(isset($recent_billing->billing_address) && $recent_billing->billing_address != NULL){ $billing = explode(' ',$recent_billing->billing_address); echo $billing[0]; } else { }?>" required/>
                                     </div>
                                     <div class="col-md-6 set_margin">
                                        <div class="paylabel">Address2</div>
                                        <input type="text" id="address2" name="address2" class="payinput" value="<?php if(isset($recent_billing->billing_address) && $recent_billing->billing_address != NULL){$billing = explode(' ',$recent_billing->billing_address); echo $billing[1];} else { }?>"/>
                                     </div>
                                  </div> -->
                                  <input type="hidden" name="BlockTourId" value="<?=@$cart->BlockTourId?>">
                                  <input type="hidden" name="cid" id="cid" value="<?php echo @$cart_global_id;?>"/>
                                 <!--  <div class="payrow">
                                    <div class="col-md-4 set_margin">
                                        <div class="paylabel">Country</div>
                                        <div class="selectedwrap">
                                           <select class="flpayinput" id="country" name="country" required>
                                              <?php 
                                                 $c=0;
                                                 foreach($countries as $country){
                                                 //if(isset($recent_billing->billing_city) && $recent_billing->billing_city != NULL){echo $recent_billing->billing_city;} else { }
                                                 
                                                 if((isset($recent_billing->country_code) && $recent_billing->country_code == $c)||$country->country_code=="US") {  ?>       
                                              <option value="<?php echo $country->country_id; ?>" selected ><?php echo $country->name;?></option>
                                              <?php   
                                                 } else{ 
                                                 ?>
                                              <option value="<?php echo $country->country_id; ?>" ><?php echo $country->name;?></option>
                                              <?php 
                                                 $c++;
                                                 }
                                                 } 
                                                 ?>
                                           </select>
                                        </div>
                                     </div>
                                     <div class="col-md-4 set_margin">
                                        <div class="paylabel">State</div>

                                        <div class="selectedwrap">
                                           <select class="flpayinput" id="state" name="state" required>
                                            <option value=''>Select State</option>
                                          </select>
                                        </div>
                                      
                                     </div>
                                     <div class="col-md-4 set_margin">
                                        <div class="paylabel">City</div>

                                        <div class="selectedwrap">
                                           <select class="flpayinput" id="city" name="city" required>
                                            <option value=''>Select City</option>
                                          </select>
                                        </div>
                                         </div>
                                    
                                  </div> -->
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


              <div class="col-md-4 col-sm-4 nopad sidebuki">
                  <div class="cartbukdis">
                     <ul class="liscartbuk">
                        <li class="lostcart">
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
                                          <div class="ritaln cartcntamnt bigclrfnt finalAmt"><?php echo $this->display_icon?><span class="amount"><?php echo number_format(( array_sum($Totall) * $this->curr_val), 2);?></span></div>
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
                              
                        </li>
                        <li class="lostcart">
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
                     </ul>
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