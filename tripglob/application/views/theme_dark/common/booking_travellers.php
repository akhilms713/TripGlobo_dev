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
      <link rel="stylesheet" href="<?php echo ASSETS; ?>css/backslider.css" type="text/css" media="screen" />
      <link rel="stylesheet" href="<?php echo ASSETS; ?>css/backslider2.css" type="text/css" media="screen" />
      <link href="<?php echo ASSETS; ?>css/owl.carousel.css" rel="stylesheet">
      <link href="<?php echo ASSETS; ?>css/flight_result.css" rel="stylesheet">
      <link href="<?php echo ASSETS; ?>css/pre_booking.css" rel="stylesheet">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <style type="text/css">
      #confirm-error {position: absolute;
      top: 41px;
      background: none;
      width: 500px;
      height: auto;
      border: none;}
      .hotel_prebook img { width: 70px; }
      .sidenamedesc { float: left; padding: 10px; }
      .flitruo { padding: 0px; }
      .padflt  { padding:0px 2px !important; }
   </style>
   <body>
      <!-- Navigation -->
      <?php if($this->session->userdata('user_type')=='1'){
         echo $this->load->view(PROJECT_THEME.'/common/header');
         }else{
         echo $this->load->view(PROJECT_THEME.'/new_theme/header'); 
         } ?>
      <div class="full onlycontent top80">
      <div class="container martopbtm">
         <div class="payment_process">
            <div class="col-xs-4 nopad">
               <div class="center_pro ">
                  <div class="fabols"></div>
                  <div class="center_labl">Review</div>
               </div>
            </div>
            <div class="col-xs-4 nopad">
               <div class="center_pro active">
                  <div class="fabols"></div>
                  <div class="center_labl">Travellers</div>
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
               $Acount = 0;$Fcount = 0;$Hcount = 0;$Ccount = 0; $Pcount = 0;$sight_count = 0;$transfer_count = 0;$module_final=array();
                   $Vcount = 0;
                   $Total = array();
                       //echo "<pre>"; print_r($cart_global); echo "</pre>"; die();
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
                               $Ccount = $Ccount+1;
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
               
                   //echo "<pre>"; print_r($module_final); echo "</pre>"; die();
               
               
                   foreach($cart_global as $key => $cid){
                   list($module, $cid) = explode(',', $cid);
                       
                       if($module == 'FLIGHT'){
                           $cart = $this->cart_model->getBookingTemp_flight($cid);
                           $Totall[] = $cart->amount;
                       }
                       if($module == 'HOTEL'){
                           $cart = $this->cart_model->getBookingTemp_hotel($cid);
                           $Totall[] = $cart->total_cost;
                       }
                       if($module == 'CAR'){
                           $cart = $this->cart_model->getBookingTemp_car($cid);
                           $Totall[] = $cart->total_cost;
                       }
                   }
                       
               ?>
               
            <div class="col-md-4 col-sm-4 nopad sidebuki">
               <div class="cartbukdis">
                  <ul class="liscartbuk">
                     <?php 
                        foreach($cart_global as $key => $cid){
                        list($module, $cid) = explode(',', $cid);
                        
                        if($module == 'FLIGHT'){
                        $cart = $this->cart_model->getCartDataByModule($cid,$module)->row();
                        $segment_data = json_decode($cart->segment_data,1);
                            
                             
                        $flight_segment_details = array();
                        ?>
                     <?php if($cart->api_id == 10){ 
                        $airline_list_code = array();
                            $airline_list_code[] =array('category'=>'airline_wise','ref_id'=>$segment_data[0]['MarketingAirline'][0]);
                        ?>
                     <input type="hidden" class="flight_departure_date" value="<?=@date('Y-m-d',strtotime($segment_data[0]['DepartureDateTime_r'][0]));?>">
                     <li class="lostcart ">
                        <div class="carttitlebuk"><?php echo $this->general_model->get_airport_cityname($cart->origin); ?> To <?php echo $this->general_model->get_airport_cityname($cart->destination); ?></div>
                        <div class="cartlistingbuk">
                           <?php
                              for($s=0;$s<count($segment_data);$s++){  for($ss=0;$ss<count($segment_data[$s]['dateOfDeparture']);$ss++){
                                  $flight_segment_details[] = $segment_data[$s]['MarketingAirline'][$ss];
                                  ?>
                           <div class="cartitembuk">
                              <div class="col-md-4 celcart">
                                 <a class="smalbukcrt"><img src="<?php echo 'https://c.fareportal.com/n/common/air/ai/'.$segment_data[$s]['MarketingAirline'][$ss].'.gif'; ?>" alt=""/></a><br>
                                 <span class="sprice"><?php echo $segment_data[$s]['MarketingAirline'][$ss]; ?> <?php echo $segment_data[$s]['FlighvgtNumber_no'][$ss];?></span>
                              </div>
                              <div class="col-md-9 splcrtpad celcart">
                                 <div class="carttitlebuk1">
                                    <div class="col-xs-6 nopad">
                                       <?php echo $segment_data[$s]['OriginLocation'][$ss]; ?>
                                       <div class="cartsec_time"><?php echo date("M d", strtotime($segment_data[$s]['DepartureDateTime_r'][$ss])); ?> </div>
                                    </div>
                                    <div class="col-xs-6 nopad">
                                       <?php echo $segment_data[$s]['DestinationLocation'][$ss]; ?>
                                       <div class="cartsec_time"><?php echo date("M d", strtotime($segment_data[$s]['ArrivalDateTime_r'][$ss])); ?></div>
                                    </div>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                              <!--
                                 <div class="col-md-1 cartfprice celcart">
                                     <div class="cartprc">
                                         <div class="singecartpricebuk"><?php echo BASE_CURRENCY_ICON?><?php echo $cart->onward_amount;?></div>
                                     </div>
                                 </div>
                                 -->
                           </div>
                           <?php
                              }}
                              ?>
                        </div>
                     </li>
                     <?php } else { ?>
                     <?php 
                        $airline_list_code = array();
                           $airline_list_code[] =array('category'=>'airline_wise','ref_id'=>$segment_data[0]['marketingCarrier'][0]);
                        ?>
                     <input type="hidden" class="flight_departure_date" value="<?=@date('Y-m-d',strtotime($segment_data[0]['DepartureDate'][0]));?>">
                     <li class="lostcart ">
                        <div class="carttitlebuk"><?php echo $this->general_model->get_airport_cityname($cart->origin); ?> To <?php echo $this->general_model->get_airport_cityname($cart->destination); ?></div>
                        <div class="cartlistingbuk">
                           <?php
                              for($s=0;$s<count($segment_data);$s++){  for($ss=0;$ss<count($segment_data[$s]['dateOfDeparture']);$ss++){
                                  $flight_segment_details[] = $segment_data[$s]['marketingCarrier'][$ss];
                                  ?>
                           <div class="cartitembuk">
                              <div class="col-md-4 celcart">
                                 <a class="smalbukcrt"><img src="<?php echo 'https://c.fareportal.com/n/common/air/ai/'.$segment_data[$s]['marketingCarrier'][$ss].'.gif'; ?>" alt=""/></a><br>
                                 <span class="sprice"><?php echo $segment_data[$s]['marketingCarrier'][$ss]; ?> <?php echo $segment_data[$s]['flightOrtrainNumber'][$ss];?></span>
                              </div>
                              <div class="col-md-9 splcrtpad celcart">
                                 <div class="carttitlebuk1">
                                    <div class="col-xs-6 nopad">
                                       <?php echo $segment_data[$s]['locationIdDeparture'][$ss]; ?>
                                       <div class="cartsec_time"><?php echo date("M d", strtotime($segment_data[$s]['DepartureDate'][$ss])); ?> </div>
                                    </div>
                                    <div class="col-xs-6 nopad">
                                       <?php echo $segment_data[$s]['locationIdArival'][$ss]; ?>
                                       <div class="cartsec_time"><?php echo date("M d", strtotime($segment_data[$s]['ArrivalDate'][$ss])); ?></div>
                                    </div>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                              <!--
                                 <div class="col-md-1 cartfprice celcart">
                                     <div class="cartprc">
                                         <div class="singecartpricebuk"><?php echo BASE_CURRENCY_ICON?><?php echo $cart->onward_amount;?></div>
                                     </div>
                                 </div>
                                 -->
                           </div>
                           <?php
                              }}
                              ?>
                        </div>
                     </li>
                     <?php } ?>
                     <?php }
                        if($module == 'HOTEL'){
                            $cart = $this->cart_model->getCartDataByModule($cid,$module)->row();
                            // debug($cart->api);
                            if ($cart->api == "Sabre") {
                               $images[0]  = $cart->image;   
                            } else {
                                $images  = explode(',', $cart->image);   
                            }              
                        ?>
                     <input type="hidden" class="flight_departure_date" value="<?=@date('Y-m-d');?>">
                     <li class="lostcart ">
                        <div class="carttitlebuk"><?php echo $cart->hotel_name; ?></div>
                        <div class="cartlistingbuk">
                           <div class="cartitembuk">
                              <div class="col-md-3 celcart">
                                 <a class="smalbukcrt"><img src="<?php echo $images[0]; ?>" alt=""/></a><br>
                              </div>
                              <div class="col-md-8 splcrtpad celcart">
                                 <div class="carttitlebuk1">
                                    <div class="col-xs-6 nopad">
                                       Check In: 
                                       <div class="cartsec_time"><?php echo date("D M d Y", strtotime($cart->checkin)); ?></div>
                                    </div>
                                    <div class="col-xs-6 nopad">
                                       Check Out:
                                       <div class="cartsec_time"><?php echo date("D M d Y", strtotime($cart->checkout)); ?></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-1 cartfprice celcart">
                                 <div class="cartprc">
                                    <div class="singecartpricebuk"><?php echo $this->display_icon?><?php echo number_format(($this->Hotel_Model->calculate_hotel_markup($cart->total_cost) * $this->curr_val), 2);?></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     <?php  }
                        if($module == 'CAR'){
                          $cart = $this->cart_model->getCartDataByModule($cid,$module)->row();        
                          $segment_data = json_decode(base64_decode($cart->segment_data));         
                          $request_scenario = json_decode(base64_decode($cart->request_scenario));                 
                        ?>
                     <input type="hidden" class="flight_departure_date" value="<?=@date('Y-m-d');?>">
                     <div class="pre_summery">
                        <div class="prebok_hding">
                           <div class="detail_htlname"><strong><?=$segment_data->car_model?></strong></div>
                           <div class="star_detail">
                              <div class="detail_htlname">
                                 <!--<span class="flitrlbl elipsetool" style="
                                    display: inline !important;">Supplier </span><span class="flitrlbl elipsetool" style="
                                    display: inline !important;font-size: 14px"><?=$cart->company_name?></span>-->
                              </div>
                              <div class="detail_htlname" style="margin-left: 0px;"><span class="flitrlbl elipsetool" style="
                                 display: inline !important;">Pick-up location </span><span class="flitrlbl elipsetool" style="
                                 display: inline !important;"><?=$cart->pick_up_loc?></span></div>
                              <div class="detail_htlname" style="margin-left: 0px;">
                                 <span class="flitrlbl elipsetool" style="
                                    display: inline !important;">Drop-off </span><span class="flitrlbl elipsetool" style="
                                    display: inline !important;"><?=$cart->pick_up_loc?></span>
                                 <!--<span class="flitrlbl elipsetool" style="
                                    display: inline !important;"><img src="<?=$segment_data->car_image?>" alt="" width="100px" height="100px" style="float : right;margin-top: -77px;"></span>-->
                              </div>
                           </div>
                        </div>
                        <div class="sidenamedesc">
                           <!--  <div class="celhtl width20 midlbord">
                              <div class="hotel_prebook"> <img src="<?=$segment_data->car_image?>" alt="" width="100px" height="100px"> </div>
                              </div> -->
                           <div class="celhtl" style="width: 100%;padding: 0px 10px">
                              <div class="waymensn">
                                 <div class="flitruo cloroutbnd">
                                    <div class="detlnavi">
                                       <div class="col-xs-4 nopad">
                                          <span class="timlbl"> <span class="flname"><span style="font-weight: 500;">Pick-up</span></span> </span>
                                          <div class="clearfix"></div>
                                          <span class="elipsetool"><?=explode("(", $segment_data->car_pick_up_dt)[0];?>&nbsp;<?=$request_scenario->drop_down_time1;?></span>
                                       </div>
                                       <div class="col-xs-4 nopad">
                                          <div class="lyovrtime"> <span class="flect"><?=$cart->travler?> Passenger(s)</span></span> </div>
                                       </div>
                                       <div class="col-xs-4 nopad">
                                          <span class="timlbl right"> <span class="flname"><span style="font-weight: 500;">Drop-off</span> </span> </span>
                                          <div class="clearfix"></div>
                                          <span class="elipsetool right" style="float: right"><?=explode("(", $segment_data->car_drop_off_dt)[0];?>&nbsp;<?=$request_scenario->drop_down_time2;?></span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php
                        }
                        
                        }
                        ?>
                     <li class="lostcart">
                        <div class="carttitlebuk">Purchase Summary</div>
                        <div class="cartlistingbuk">
                           <div class="cartitembuk">
                              <div class="col-md-8 celcart">
                                 <div class="payblnhm">Sub Total</div>
                              </div>
                              <div class="col-md-4 celcart">
                                 <div class="cartprc">
                                    <div class="ritaln cartcntamnt normalprc"><?php echo $this->display_icon?>
                                       <?php if(isset($pcode_d) && !empty($pcode_d) && $pcode_d>0){ ?>
                                       <?php echo number_format((($pcode_f + $pcode_d) * $this->curr_val), 2); ?>
                                       <?php } else { ?>
                                       <?php echo number_format(($pcode_f * $this->curr_val), 2); ?>
                                       <?php } ?>
                                    </div>
                                    <?php //echo $this->Hotel_Model->calculate_hotel_markup(array_sum($Totall));?>
                                 </div>
                              </div>
                           </div>
                           <?php if(isset($pcode_d) && !empty($pcode_d) && $pcode_d>0){ ?>
                           <div class="cartitembuk">
                              <div class="col-md-8 celcart">
                                 <div class="payblnhm">Discount</div>
                              </div>
                              <div class="col-md-4 celcart">
                                 <div class="cartprc">
                                    <div class="ritaln cartcntamnt normalprc discount"><?php echo $this->display_icon?><span class="amount"><?php echo number_format(($pcode_d * $this->curr_val), 2); ?></span></div>
                                 </div>
                              </div>
                           </div>
                           <?php } ?>
                        </div>
                        <div class="clear"></div>
                        <div class="cartlistingbuk">
                           <div class="cartitembuk">
                              <div class="col-md-8 celcart">
                                 <div class="payblnhm">Total</div>
                              </div>
                              <div class="col-md-4 celcart">
                                 <div class="cartprc">
                                    <div class="ritaln cartcntamnt bigclrfnt finalAmt"><?php echo $this->display_icon?><span class="amount"><?php echo number_format(($pcode_f * $this->curr_val), 2); ?></span></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="clear"></div>
                     </li>
                     <li class="lostcart ">
                        <div class="carttitlebuk">Additional Information</div>
                        <div class="cartlistingbuk link-bar">
                           <div class="cartitembuk">
                              <div class="col-md-12 celcart">
                                 <div class="payblnhm trvl_tps mB10"><a data-toggle="modal" data-target="#travel_tips" class="colorbl">Travel Tips </a></div>
                              </div>
                           </div>
                        </div>
                        <div class="clear"></div>
                        <hr style="clear: both; margin:0px; " />
                        <div class="cartlistingbuk link-bar">
                           <div class="cartitembuk">
                              <div class="col-md-12 celcart">
                                 <div class="payblnhm mB10"><a data-toggle="modal" data-target="#cancellation_policy" class="colorbl">Cancellation Policy</a></div>
                              </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="col-md-8 col-sm-8 nopad fulbuki ">
               <form name="checkout-apartment" id="checkout-apartment"  action="<?php echo WEB_URL;?>booking/checkout">
                  <div class="col-md-12 padleftpay">
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
                                             <div class="paylabel">Title</div>
                                             <div class="selectedwrap">
                                                <select class="flpayinput" name="a_gender<?php echo $cid; ?>[<?php echo $k; ?>]">
                                                   <option value="Male">Mr.</option>
                                                   <option value="Female">Mrs./Miss.</option>
                                                </select>
                                                <input type="hidden" name="search_request" value="<?=base64_encode(json_encode($request))?>" />
                                             </div>
                                          </div>
                                          <div class="col-md-4 set_margin">
                                             <div class="paylabel">First Name</div>
                                             <input placeholder="First Name" name="first_name<?php echo $cid;?>[<?php echo $k; ?>]"  type="text" class="payinput mytextbox" value="<?php if($k == 0){ echo $first_name;}?>" required />
                                          </div>
                                          <div class="col-md-4 set_margin">
                                             <div class="paylabel">Last Name</div>
                                             <input placeholder="Last Name" name="last_name<?php echo $cid;?>[<?php echo $k; ?>]" type="text" id="<?php echo 'AL'.$k; ?>" class="payinput mytextbox" value="<?php if($k == 0){ echo $last_name;}?>" required />
                                          </div>
                                          <!-- 
                                             <div class="clearfix"></div>
                                             <div class="col-md-2 set_margin"></div> -->
                                          <div class="col-md-2 set_margin">
                                             <div class="paylabel">Date of Birth</div>
                                             <input type="text" name="adob<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput adt" value="" placeholder="Date of Birth" required readonly/>
                                          </div>
                                          <!-- <div class="clearfix"></div>
                                             <div class="col-md-2 set_margin"></div>
                                             <div class="col-md-10 set_margin"><div class="paylabel psprt_head">Passport Details</div></div>
                                             <div class="clearfix"></div> 
                                             <div class="col-md-2 set_margin"></div>-->
                                          <?php if ($request->is_domestic != 1) { ?>
                                          <div class="col-md-4 set_margin">
                                             <div class="paylabel">Passport No.</div>
                                             <input placeholder="Passport No." value="<?php if($k == 0){ echo $passport_number;}?>" name="apass<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput" type="text"  required/> 
                                          </div>
                                          <div class="col-md-4 set_margin">
                                             <div class="paylabel">Passport Expiry</div>
                                             <input placeholder="Pasport Expiry" value="<?php if($k == 0){ echo $passport_expirydate;}?>" name="pass_expiry<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput passport_expiry" type="text" required readonly/> 
                                          </div>
                                          <?php } ?>
                                          <!-- </div> -->
                                          <?php if ($request->is_domestic != 1) { ?>
                                          <!-- <div class=""> -->
                                          <!--  <div class="col-md-2 set_margin"></div> -->
                                          <div class="col-md-4 set_margin">
                                             <div class="paylabel">Issuing Country</div>
                                             <select class="payinput" id="issuing_country<?php echo $cid;?>[<?php echo $k; ?>]" name="issuing_country<?php echo $cid;?>[<?php echo $k; ?>]" required>
                                                <option value="">--select--</option>
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
                                             <div class="paylabel">Title</div>
                                             <div class="selectedwrap">
                                                <select class="flpayinput" name="c_gender<?php echo $cid; ?>[<?php echo $k; ?>]">
                                                   <option value="Male">Mr.</option>
                                                   <option value="Female">Mrs./Miss.</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-4 set_margin">
                                             <div class="paylabel">First Name</div>
                                             <input placeholder="First Name" name="cfirst_name<?php echo $cid;?>[<?php echo $k; ?>]" type="text" class="payinput mytextbox" value=""/>
                                          </div>
                                          <div class="col-md-4 set_margin">
                                             <div class="paylabel">Last Name</div>
                                             <input placeholder="Last Name" name="clast_name<?php echo $cid;?>[<?php echo $k; ?>]" type="text" class="payinput mytextbox"/>
                                          </div>
                                          <div class="col-md-2 set_margin">
                                             <div class="paylabel">DOB</div>
                                             <input placeholder="Date Of Birth" type="text" name="cdob<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput chd" value="" readonly  required/>
                                             <!--  <input placeholder="Child age" id="cdob<?php echo $cid.'_'.$k; ?>" name="cdob<?php echo $cid;?>[<?php echo $k; ?>]" type="text" class="payinput adt"/> -->
                                          </div>
                                          <div class="clearfix"></div>
                                          <!-- <div class="col-md-2 set_margin"></div>
                                             <div class="col-md-10 set_margin"><div class="paylabel psprt_head">Passport Details</div></div>
                                              <div class="col-md-2 set_margin"></div> -->
                                          <?php if ($request->is_domestic != 1) { ?>
                                          <div class="col-md-4 set_margin">
                                             <div class="paylabel">Passport No.</div>
                                             <input placeholder="Passport No." value="" name="cpass<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput" type="text" required /> 
                                          </div>
                                          <div class="col-md-4 set_margin">
                                             <div class="paylabel">Passport Expiry</div>
                                             <input placeholder="Pasport Expiry" value="" name="cpass_expiry<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput passport_expiry" type="text" required readonly /> 
                                          </div>
                                          <?php } ?>
                                          <?php if ($request->is_domestic != 1) { ?>
                                          <div class="col-md-4 set_margin">
                                             <div class="paylabel">Issuing Country</div>
                                             <select class="payinput" id="cissuing_country<?php echo $cid;?>[<?php echo $k; ?>]" name="cissuing_country<?php echo $cid;?>[<?php echo $k; ?>]" required>
                                                <option value="">--select--</option>
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
                                             <div class="paylabel">Title</div>
                                             <div class="selectedwrap">
                                                <select class="flpayinput" name="i_gender<?php echo $cid; ?>[<?php echo $k; ?>]">
                                                   <option value="Male">Mr.</option>
                                                   <option value="Female">Mrs./Miss.</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-4 set_margin">
                                             <div class="paylabel">First Name</div>
                                             <input placeholder="First Name" name="ifirst_name<?php echo $cid;?>[<?php echo $k; ?>]" type="text" class="payinput mytextbox" value=""/>
                                          </div>
                                          <div class="col-md-4 set_margin">
                                             <div class="paylabel">Last Name</div>
                                             <input placeholder="Last Name" name="ilast_name<?php echo $cid;?>[<?php echo $k; ?>]" type="text" class="payinput mytextbox"/>
                                          </div>
                                          <div class="col-md-2 set_margin">
                                             <div class="paylabel">DOB</div>
                                             <input placeholder="Date Of Birth" type="text" name="idob<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput inf" value="" readonly  required/>
                                             <!--    <input placeholder="Infant age" id="idob<?php echo $cid.'_'.$k; ?>" name="idob<?php echo $cid;?>[<?php echo $k; ?>]" type="text" class="payinput"/> -->
                                          </div>
                                          <?php if ($request->is_domestic != 1) { ?>
                                          <!--<div class="paylabel psprt_head">Passport Details</div></div>
                                             <div class="col-md-2 set_margin"></div>-->
                                          <div class="col-md-4 set_margin">
                                             <div class="paylabel">Passport No.</div>
                                             <input placeholder="Passport No." value="" name="ipass<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput" type="text" required  /> 
                                          </div>
                                          <div class="col-md-4 set_margin">
                                             <div class="paylabel">Passport Expiry</div>
                                             <input placeholder="Passport Expiry" value="" name="ipass_expiry<?php echo $cid;?>[<?php echo $k; ?>]" class="payinput passport_expiry" type="text"  required readonly /> 
                                          </div>
                                          <?php } ?>
                                          <?php if ($request->is_domestic != 1) { ?>
                                          <div class="col-md-4 set_margin">
                                             <div class="paylabel">Issuing Country</div>
                                             <select class="payinput" id="iissuing_country<?php echo $cid;?>[<?php echo $k; ?>]" name="iissuing_country<?php echo $cid;?>[<?php echo $k; ?>]" required>
                                                <option value="">--select--</option>
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
                                       
                                       ?>
                                    <?php  } }?> 
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
                                    <div class="paylabel">First Name</div>
                                    <input type="text" id="first_name" name="first_name" class="payinput mytextbox" value="<?php if(isset($userInfo) && $userInfo->user_name != NULL){echo $userInfo->user_name;} else { } ?>" required/>
                                 </div>
                                 <div class="col-md-5 set_margin">
                                    <div class="paylabel">Last Name</div>
                                    <input type="text" id="last_name" name="last_name" class="payinput mytextbox" value="<?php if(isset($userInfo) && $userInfo->user_name != NULL){echo $userInfo->user_name;} else { }?>" required/>
                                 </div>
                              </div>
                              <div class="payrow">
                                 <div class="col-md-6 set_margin">
                                    <div class="paylabel">Address</div>
                                    <input type="text" id="street_address" name="street_address" class="payinput" value="<?php if(isset($recent_billing->billing_address) && $recent_billing->billing_address != NULL){ $billing = explode(' ',$recent_billing->billing_address); echo $billing[0]; } else { }?>" required/>
                                 </div>
                                 <div class="col-md-6 set_margin">
                                    <div class="paylabel">Address2</div>
                                    <input type="text" id="address2" name="address2" class="payinput" value="<?php if(isset($recent_billing->billing_address) && $recent_billing->billing_address != NULL){$billing = explode(' ',$recent_billing->billing_address); echo $billing[1];} else { }?>"/>
                                 </div>
                              </div>
                              <input type="hidden" name="BlockTourId" value="<?=@$cart->BlockTourId?>">
                              <input type="hidden" name="cid" id="cid" value="<?php echo @$cart_global_id;?>"/>
                              <div class="payrow">
                                 <div class="col-md-4 set_margin">
                                    <div class="paylabel">City</div>
                                    <input type="text" id="city"  name="city" class="payinput mytextbox" value="<?php if(isset($recent_billing->billing_city) && $recent_billing->billing_city != NULL){echo $recent_billing->billing_city;} else { }?>" required/>
                                 </div>
                                 <div class="col-md-4 set_margin">
                                    <div class="paylabel">State</div>
                                    <input type="text" id="state" name="state" class="payinput mytextbox" value=" <?php if(isset($recent_billing->billing_state) && $recent_billing->billing_state != NULL){echo $recent_billing->billing_state;} else { }?>" required/>
                                 </div>
                                 <div class="col-md-4 set_margin">
                                    <div class="paylabel">Postal Code</div>
                                    <input type="text" id="zip" data-mask="000000000" name="zip" class="payinput" value="<?php if(isset($recent_billing->billing_zip) && $recent_billing->billing_zip != NULL){echo $recent_billing->billing_zip;} else { }?>" required/>
                                 </div>
                              </div>
                              <div class="payrow">
                                 <div class="col-md-4 set_margin">
                                    <div class="paylabel">Country</div>
                                    <div class="selectedwrap">
                                       <select class="flpayinput" id="country" name="country" required>
                                          <?php 
                                             $c=0;
                                             foreach($bt['countries'] as $country){
                                             //if(isset($recent_billing->billing_city) && $recent_billing->billing_city != NULL){echo $recent_billing->billing_city;} else { }
                                             
                                             if((isset($recent_billing->country_code) && $recent_billing->country_code == $c)||$country->country_code=="US") {  ?>       
                                          <option value="<?php echo $country->country_code; ?>" selected ><?php echo $country->country_name;?></option>
                                          <?php   
                                             } else{ 
                                             ?>
                                          <option value="<?php echo $country->country_code; ?>" ><?php echo $country->country_name;?></option>
                                          <?php 
                                             $c++;
                                             }
                                             } 
                                             ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-5 set_margin">
                                    <div class="paylabel">Email Address</div>
                                    <input type="email" id="email" name="email" class="payinput" value="<?php if(isset($recent_billing->billing_email) && $recent_billing->billing_email != NULL){echo $recent_billing->billing_email;} else { }?>" required/>
                                 </div>
                                 <div class="col-md-3 set_margin">
                                    <div class="paylabel">Contact</div>
                                    <input type="text" id="mobile" name="mobile" class="payinput " data-mask="000000000000" value="<?php if(isset($recent_billing->billing_contact_number) && $recent_billing->billing_contact_number != NULL){echo $recent_billing->billing_contact_number;} else { }?>" required/>
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
                                    <input type="text" id="card_number" name="card_number" class="payinput" minlength="16" maxlength="19" placeholder="Card Number" data-rule-number= "true" required/>
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
                                    <input type="text" id="cvv_num" name="cvv_num" class="payinput" placeholder="CVV" required/>
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
                              <div class="squaredThree"><input type="checkbox" value="0" name="confirm" class="filter_airline" id="squaredThree1" required><label for="squaredThree1"></label></div>
                              <label for="squaredThree1" class="lbllbl">By booking this item, you agree to pay the total amount shown, which includes Service Fees, on the right and to the<a data-toggle="modal" data-target="#terms_n_conditions" class="colorbl"> Terms &amp; Conditions</a>.</label>
                           </div>
                        </div>
                        <input type="hidden" id="total_payable" name="total" value="<?php echo base64_encode(array_sum($Total)); ?>"/>
                        <input type="hidden" id="pcode" name="code" value="<?php echo $pcode; ?>"/>
                        <input type="hidden" name="session_id_xc" value="<?php echo $session_id_xc; ?>"/>
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
         </div>
         </form>
      </div>
      <div class="clearfix"></div>
      <div class="clearfix"></div>
      <!-- Modal -->
      <div class="modal fade" id="terms_n_conditions" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Terms and Conditions</h4>
               </div>
               <div class="modal-body">
                  <?php 
                     //$datatt['id'] = 12; 
                     if ($module == "CAR") {
                         $datatt['id'] = 19; 
                     } else if($module == "HOTEL"){
                         $datatt['id'] = 18; 
                     } else {
                         $datatt['id'] = 17; 
                     }
                     $travel_tip = $this->db->get_where('static_pages', $datatt)->row_array();
                     echo $travel_tip['english'];
                     ?>
                  <!-- <p>1. Some text in the modal.</p>
                     <p>2. Some text in the modal.</p>
                     <p>3. Some text in the modal.</p>
                     <p>4. Some text in the modal.</p> -->
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="cancellation_policy" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Cancellation Policy</h4>
               </div>
               <div class="modal-body">
                  <?php 
                     if ($module == "CAR") {
                         $datatt['id'] = 16; 
                     } else if($module == "HOTEL"){
                         $datatt['id'] = 15; 
                     } else {
                         $datatt['id'] = 14; 
                     }
                     $travel_tip = $this->db->get_where('static_pages', $datatt)->row_array();
                     echo $travel_tip['english']; ?>
                  <!-- <p>Some text in the modal.</p> -->
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="travel_tips" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Travel Tips</h4>
               </div>
               <?php 
                  $datatt['id'] = 10; 
                  $travel_tip = $this->db->get_where('static_pages', $datatt)->row_array();
                  //echo "<pre/>";print_r($travel_tip['english']);
                  ?>
               <div class="modal-body">
                  <p><?=$travel_tip['english']?></p>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <script type="text/javascript">
         $(document).ready(function(){
             var selected_text  = $(".hotelPickup option:selected").text();
               $("#hotel_pickup_list_name").val(selected_text);
         
            $(".hotelPickup").on("change",function(){
                 var selected_value = $(this).val();
                 var selected_text  = $(".hotelPickup option:selected").text();
                 $("#hotel_pickup_list_name").val(selected_text);
                 if(selected_value =='notListed'){         
                   $("#hotelPickup_name").removeClass('hide');
                 }else{         
                   $("#hotelPickup_name").addClass('hide');
                 }
         
             });
             
              $(".p-weight").on("change",function(){
                   
                   var product_key = $(this).data('key');
                   var selected_weight = $(this).val();
                   $(".weight_measure_"+product_key).val(selected_weight);
               });
               $(".p-height").on("change",function(){
                   
                   var product_key = $(this).data('key');
                   var selected_height = $(this).val();
                   $(".height_measure_"+product_key).val(selected_height);
               });
               var start = new Date();
               start.setFullYear(start.getFullYear() - 70);
               var end = new Date();
               end.setFullYear(end.getFullYear() - 1);
         
               $(".datepickerbook" ).datepicker(
                 {
                   dateFormat: 'dd MM yy',
                   changeMonth: true,
                   changeYear: true,
                   yearRange: '1970:'+(new Date).getFullYear()    
                 });
         
         
               $(".dobdatepickerbook").datepicker({
         
                 dateFormat: 'dd MM yy',
                   changeMonth: true,
                   changeYear: true,
                   yearRange: start.getFullYear()+':'+end.getFullYear()  
               });
               $(".expiraydatepickerbook").datepicker({
                   dateFormat:'dd MM yy',
                   changeMonth:true,
                   changeYear:true,
                   minDate:0,
                   yearRange:'2000:'+((new Date).getFullYear()+10)
               });
                $(".transferdeparturedate").datepicker({
                   dateFormat:'dd MM yy',
                   changeMonth:true,
                   changeYear:true,
                   minDate:0
               });
                $(".transferarrivaldate").datepicker({
                   dateFormat:'dd MM yy',
                   changeMonth:true,
                   changeYear:true,
                   minDate:0
               });
             $('input#ihave[type="checkbox"]').click(function(){
                 if($(this).prop("checked") == true){
                     $('#con_as_guest').fadeOut(500, function(){
                         $('#i_have_account').fadeIn(500);
                     });
                 }
         
                 else if($(this).prop("checked") == false){
         
                     $('#i_have_account').fadeOut(500, function(){
                         $('#con_as_guest').fadeIn(500);
                     });
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
              
            /*  $( "#newbill" ).click(function() {
                  $('#first_name').val('');
                  $('#last_name').val('');
                  $('#street_address').val('');
                  $('#address2').val('');
                  $('#email').val('');
                  $('#mobile').val('');
                  $('#country').val('AF');
                  $('#city').val('');
                  $('#state').val('');
                  $('#zip').val('');
             });
             $('.item').click(function(){
                 $(".item").removeClass("active");
                 $('.addnewbill').removeClass('active');
                 $(this).addClass('active');
                  $.ajax({
                      type:'GET', 
                      url: '<?php echo WEB_URL;?>flight/get_billing_address/',
                      data:{id: $(this).attr('id')},
                      beforeSend: function(XMLHttpRequest){
                     }, 
                     success: function(response) {
                         var response=eval('(' + response + ')');
                         $('#first_name').val(response.billing_first_name);
                          $('#last_name').val(response.billing_last_name);
                          $('#street_address').val(response.billing_address);
                          $('#address2').val('');
                          $('#email').val(response.billing_email);
                          $('#mobile').val(response.billing_contact_number);
                          $('#country').val(response.billing_country_id);
                          $('#city').val(response.billing_city);
                          $('#state').val(response.billing_state);
                          $('#zip').val(response.billing_zip);
                     }
                 });
             });*/
              
         });
         
         
         <?php foreach($cart_global as $key => $cid){           
            list($module, $cid) = explode(',', $cid);
            if($module == 'FLIGHT'){
                $cart = $this->cart_model->getBookingTemp_flight($cid);
                $Total[] = $cart->total_cost;
                $request = json_decode($cart->request_scenario);
                if($request->CHD >0){
                    for($k=0;$k<$request->CHD;$k++){ ?>
                             jQuery( "#cdob<?php echo $cid.'_'.$k; ?>" ).datepicker({
                                 maxDate: 0,
                                 dateFormat: 'dd-mm-yy',
                                 numberOfMonths: 2,
                                 onClose: function( selectedDate ) {
                                     
                                 }
                             }); 
                 
                 <?php } }
            if($request->INF >0){
                for($k=0;$k<$request->INF;$k++){ ?>
                             jQuery( "#idob<?php echo $cid.'_'.$k; ?>" ).datepicker({
                                 maxDate: 0,
                                 dateFormat: 'dd-mm-yy',
                                 numberOfMonths: 2,
                                 onClose: function( selectedDate ) {
                                     
                                 }
                             }); 
                 <?php    } } 
            } } ?>
      </script>
      <!-- Page Content -->
      <div class="clearfix"></div>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>
      <script type="text/javascript" src="<?php echo ASSETS; ?>js/jquery.mask.js"></script>
      <!-- Script to Activate the Carousel --> 
      <script src="<?php echo ASSETS; ?>js/dw_tooltip_c.js" type="text/javascript"></script>
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
              minDate: new Date(passport_expiry)
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
   </body>
</html>