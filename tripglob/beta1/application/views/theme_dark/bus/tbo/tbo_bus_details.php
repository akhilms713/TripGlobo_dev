<style>
    /*.topssec{*/
    /*    margin-top: -0px;*/
    /*    position:fixed;*/
    /*}*/
    /*.wrapper_before_content{*/
    /*    margin-top: 75px;*/
    /*}*/
    </style>
    <?php //echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
<?php 
    // include('response.php'); 
    //include('response1.php'); 
    // include('response2.php'); 
    $CUR_Route = ($details['Route']);
    $CUR_Layout = $SeatDetails;

    $CUR_Pickup = force_multple_data_format(@$BoardingDetails['BoardingPointsDetails']);
    // debug($BoardingDetails);exit;
    $CUR_Dropoff = force_multple_data_format(@$BoardingDetails['DroppingPointsDetails']);
    $CUR_CancellationCharges = force_multple_data_format($details['result']['Canc']);
    $template_images = ASSETS.'images/';
    $GLOBALS['CI']->load->model('bus_model');
$getBusMarkup = $GLOBALS['CI']->bus_model->get_markup_B2C('GENERAL',2);

//debug($getBusMarkup[0]->markup_value);die;
//debug($getBusMarkup[0]->markup_fixed);die;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Search Result Page</title>
    <!-- Bootstrap -->
   
  
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<style>.padfive {
  padding: 5px;
}

.nopad {
  padding: 0px;
}

.brdre {
  border: 1px solid #dbd5d5;
}

.wrapper_tikting {
  width: 100%;
  float: left;
  margin: auto;
  padding: 10px 0px;
  background: #fff;
}

.new_head_lower {
  font-family: roboto;
  font-size: 14px;
  position: absolute;
  transform: rotate(270deg);
  -ms-transform: rotate(270deg);
  -webkit-transform: rotate(270deg);
  right: -20px;
  top: 26px;
  letter-spacing: 3px;
}

.new_head_lower1 {
  font-family: roboto;
  font-size: 16px;
  position: relative;
  letter-spacing: 0;
  writing-mode: vertical-rl;
  text-orientation: upright;
  /*float: right;*/
  right: 0px;
  /*top: -8px;*/
}

.upper_lowe {
  height: auto !important;
}

.upper_lowe1 {
  height: auto !important;
  border-bottom: none;
}

.wrapper_tikting_firstrow {
  width: 100%;
  float: left;
  background: #fff;
  padding: 5px 5px 5px 5px;
  height: 130px;
  overflow-y: auto; 
}

.wrapper_tikting_firstrow ul {
  padding-left: 0px;
}

.wrapper_tikting_firstrow li {
  display: inline-block;
}

.wrapper_tikting_firstrow img {
  width: auto;
  cursor: pointer;
}

.wa_senods {
  width: 35px !important;
  cursor: pointer;
}

.wrapper_tikting_secondrow {
  width: 100%;
  float: left; 
  background: #fff;
  padding: 15px;
}

.wrapper_tikting_secondrow ul {
  padding-left: 0px;
}

.wrapper_tikting_secondrow li {
  list-style: none;
  padding-bottom: 8px;
  display:inline-block;
      width: 25%;
    float: left;
}

.wrapper_tikting_secondrow img {
  width: 27px;
  cursor: pointer;
  float:left;
}
.new_addtionl_textz_x h4{padding-left:12px;}
.wrapper_tikting_secondrow span {
  position: relative;
  font-family: roboto;
  left: 10px;
  float: left;
    font-size: 14px;
}

.wrapper_tikting_thirdtrow {
  width: 100%;
  float: left;
  background: #fff;
  padding: 0px 9px;
  font-family: roboto;
}

.margin_botm {
  float: left;
  width: 100%;
  padding-bottom: 15px;
}

.wrapper_tikting_thirdtrow h5 {
  font-size: 13px;
}
.booking-form {
    background-color: #ffffff; }
.wrapper_tikting_thirdtrow select {
  width: 100%;
  height: 43px;
  border-radius: 0;
  margin-bottom: 15px;
  padding: 5px;
  color: #a19d9d;
 
  text-align: left: ;
} 
.newd_rightqa{    
       background: #fdb813;
    padding: 11px 15px;
    border: none;
    border-radius: 5px;
    margin: 10px 22px;
    color: #fff;
    cursor: pointer;
    outline: none;
}

.rights_onew {
  text-align: right;
  padding-right: 25px;
}

.left_pad{
    padding-left:5px; 
}
.w2_h1_img{
    height: 47px !important;
    width: 22px !important;
}
.w1_h2_img{
        width: 68px !important;
        height: 23px !important;
        margin: 1px 0px;
}
.seat_img{
     width: 53px !important;
    height: 28px !important;
    padding: 0px 5px;
}

.opacity_cls{
    opacity: 0.7 !important;
}
.back_green_clr{
    background: #3fcb3f;
    border-radius: 5px;
}
.disabled:hover {
    cursor: not-allowed;
}
.err_msg{
    color: #ff0000;
}

</style> 
<?php 
    $decoded_api_response=$CUR_Layout;
     // echo "<pre>"; print_r($decoded_api_response); exit();
    $max_row_num_upper=$max_col_num_upper=$max_row_num_lower=$max_col_num_lower=0;
    $upper_array=$lower_array=[];
    $row_count=count($decoded_api_response['GetBusSeatLayOutResult']['SeatLayoutDetails']['SeatLayout']['SeatDetails']);
    for ($i=0; $i < $row_count; $i++){ 
        $column_count=count($decoded_api_response['GetBusSeatLayOutResult']['SeatLayoutDetails']['SeatLayout']['SeatDetails'][$i]);
        for ($j=0; $j < $column_count; $j++) { 
            $inner_loop_data=$decoded_api_response['GetBusSeatLayOutResult']['SeatLayoutDetails']['SeatLayout']['SeatDetails'][$i][$j];
            if(($inner_loop_data['IsUpper']!=1) && (($inner_loop_data['SeatType']!=4)) ){
                //lower array start
                    if($inner_loop_data['RowNo']>$max_row_num_lower){
                        $max_row_num_lower=$inner_loop_data['RowNo'];
                    }
                    if($inner_loop_data['ColumnNo']>$max_col_num_lower){
                        $max_col_num_lower=$inner_loop_data['ColumnNo'];
                    }
                    $lower_array[$inner_loop_data['RowNo']][$inner_loop_data['ColumnNo']]=$inner_loop_data;
                //lower array ends
            }else{
                // upper array start
                    if($inner_loop_data['RowNo']>$max_row_num_upper){
                        $max_row_num_upper=$inner_loop_data['RowNo'];
                    }
                    if($inner_loop_data['ColumnNo']>$max_col_num_upper){
                        $max_col_num_upper=$inner_loop_data['ColumnNo'];
                    }
                    $upper_array[$inner_loop_data['RowNo']][$inner_loop_data['ColumnNo']]=$inner_loop_data;
                // upper array ends
            }

        }
    }
   // debug($upper_array);exit();
?>
<body>
    <form class="booking-form" action="" method="POST" >
    <div class="wrapper_tikting">
      <div class="col-md-12">
        

        <!-- upper html start -->
        <?php  
            if($upper_array){
        ?>
                <div class="col-md-12  padfive">
                  <div class="wrapper_tikting_firstrow brdre">
                    <div class="col-md-2 nopad box_text">
                      <h5 class="new_head_lower1">UPPER</h5>
                    </div>
                    <div class="col-md-10 nopad left_pad">
                        <?php  
                            for ($m=0; $m <= $max_row_num_upper; $m++) { 
                                $m = str_pad($m, 3, "0", STR_PAD_LEFT);
                               
                        ?>  
                                <div class="col-md-12 margin_botm nopad">
                                    <?php  
                                        for ($n=0; $n <= $max_col_num_upper ; $n++) { 
                                            $n = str_pad($n, 3, "0", STR_PAD_LEFT);
                                            
                                            
                                            if(($getBusMarkup[0]->markup_fixed)>0 && ($getBusMarkup[0]->markup_fixed)!='')
                                                {
                                                $lower_array[$k][$l]['Price']['admin_markup'] = $getBusMarkup[0]->markup_fixed;
                                                }
                                                else{
                                                 $getmarkVal=$getBusMarkup[0]->markup_value;
                                                 $upermarkval=$getmarkVal/100;
                                                 $lower_array[$k][$l]['Price']['admin_markup']=$upper_array[$m][$n]['Price']['PublishedPriceRoundedOff']*$upermarkval;
                                           
                                                }
                                      
                                             ?>
                                            <li class="seat_layout_li" data-price="" data-name_index="" data-response="" data-seat_number="">
                                                <input type="hidden" class="seat_layout_li" id="getallseatData_<?php echo $upper_array[$m][$n]['SeatName']; ?>" value="<?php echo base64_encode(json_encode($upper_array[$m][$n])); ?>">
                                                <?php  
                                                    if(isset($upper_array[$m][$n])){
                                                        if(($upper_array[$m][$n]['SeatType']!=1)||($upper_array[$m][$n]['SeatType']!=3)||($upper_array[$m][$n]['SeatType']!=5)){
                                                            //sleeper start above
                                                            if($upper_array[$m][$n]['Width']==1){
                                                                if($upper_array[$m][$n]['SeatStatus']!=1){
                                                                    //seat blocked already
                                                                ?>
                                                                    <img class="wa_senods w1_h2_img disabled" src="<?php echo $template_images; ?>seats/sleeper_booked_w1_h2.png">
                                                                <?php
                                                                }else{
                                                                    if($upper_array[$m][$n]['IsLadiesSeat']){
                                                                    //seat lady
                                                                ?>
                                                                    <img class="wa_senods w1_h2_img select_seat" seat_name="<?php echo $upper_array[$m][$n]['SeatName']; ?>" seat_index="<?php echo $upper_array[$m][$n]['SeatIndex']; ?>" amount="<?php echo round($upper_array[$m][$n]['Price']['TotalFare'] ); ?>" data-resp="<?php echo base64_encode(json_encode($upper_array[$m][$n])); ?>" src="<?php echo $template_images; ?>seats/sleeper_ladies_w1_h2.png">
                                                                <?php
                                                                    }else{
                                                                    //normal seat
                                                                ?>
                                                                    <img class="wa_senods w1_h2_img select_seat" seat_name="<?php echo $upper_array[$m][$n]['SeatName']; ?>" seat_index="<?php echo $upper_array[$m][$n]['SeatIndex']; ?>" amount="<?php echo round($upper_array[$m][$n]['Price']['TotalFare'] + @$lower_array[$k][$l]['Price']['admin_markup']); ?>" data-resp="<?php echo base64_encode(json_encode($upper_array[$m][$n])); ?>" src="<?php echo $template_images; ?>seats/sleeper_w1_h2.png">
                                                                <?php
                                                                    }
                                                                }
                                                            }else{
                                                                if($upper_array[$m][$n]['SeatStatus']!=1){
                                                                //seat blocked already
                                                                ?>
                                                                    <img class="wa_senods w2_h1_img disabled" src="<?php echo $template_images; ?>seats/sleeper_booked_w2_h1.png">
                                                                <?php
                                                                }else{
                                                                    if($upper_array[$m][$n]['IsLadiesSeat']){
                                                                        //seat lady
                                                                ?>
                                                                    <img class="wa_senods w2_h1_img select_seat" seat_name="<?php echo $upper_array[$m][$n]['SeatName']; ?>" seat_index="<?php echo $upper_array[$m][$n]['SeatIndex']; ?>" amount="<?php echo round($upper_array[$m][$n]['Price']['TotalFare']); ?>" data-resp="<?php echo base64_encode(json_encode($upper_array[$m][$n])); ?>" src="<?php echo $template_images; ?>seats/sleeper_ladies_w2_h1.png">
                                                                <?php
                                                                    }else{
                                                                        //normal seat
                                                                ?>
                                                                    <img class="wa_senods w2_h1_img select_seat" seat_name="<?php echo $upper_array[$m][$n]['SeatName']; ?>" seat_index="<?php echo $upper_array[$m][$n]['SeatIndex']; ?>" amount="<?php echo round($upper_array[$m][$n]['Price']['TotalFare']); ?>" data-resp="<?php echo base64_encode(json_encode($upper_array[$m][$n])); ?>" src="<?php echo $template_images; ?>seats/sleeper_w2_h1.png">
                                                                <?php
                                                                    }
                                                                }
                                                            }   
                                                            //sleeper ends  below
                                                        }
                                                ?>
                                                        <!-- <img class="wa_senods" src="seat_icons/seat.png"> -->
                                                <?php  
                                                    }else{
                                                ?>
                                                        <img class="wa_senods">
                                                <?php       
                                                    }
                                                ?>
                                            </li>
                                    <?php  
                                        }
                                    ?>
                                </div>
                        <?php  
                            }
                        ?>
                    </div>
                  </div>
                </div>
        <?php  
            }
        ?>
        <!-- upper html ends -->

        <!-- side seat type start -->
        <div class="col-md-12  padfive">
          <div class="wrapper_tikting_secondrow brdre">
            <!-- <ul>
              <li>
                <img src="<?php echo $template_images; ?>seats/seat_nomal_book.png"><span>Available Seat</span>
              </li>
              <li>
                <img src="<?php echo $template_images; ?>seats/seat_lady_book.png"><span>Reserved for ladies</span>
              </li>
              <li>
                <img src="<?php echo $template_images; ?>seats/normal_select.png"><span>Selected Seat</span>
              </li>
              <li>
                <img src="<?php echo $template_images; ?>seats/seat_gents_book.png"><span>Booked Seat</span>
              </li>
            </ul> -->
            <ul>
              <li>
                <img src="<?php echo $template_images; ?>seats/seat.png"><span>Available Seat</span>
              </li>
              <li>
                <img src="<?php echo $template_images; ?>seats/seat_ladies.png"><span>Reserved for ladies</span>
              </li>
              <li>
                <img src="<?php echo $template_images; ?>seats/seat_select.png"><span>Selected Seat</span>
              </li>
              <li>
                <img src="<?php echo $template_images; ?>seats/seat_booked.png"><span>Booked Seat</span>
              </li>
            </ul>
          </div>
        </div>
        <!-- side seat type ends -->
        
        <!-- lower html start -->
        <?php  
            if($lower_array){
        ?>
                <div class="col-md-12  padfive">
                  <div class="wrapper_tikting_firstrow brdre">
                    <div class="col-md-1 nopad box_text">
                      <h5 class="new_head_lower1">LOWER</h5>
                    </div>
                    <div class="col-md-11 nopad left_pad">
                        <?php  
                            for ($k=0; $k <= $max_row_num_lower; $k++) {
                                $k = str_pad($k, 3, "0", STR_PAD_LEFT);
                                            
                                
                                      
                        ?>  
                                <div class="col-md-12 margin_botm nopad">
                                    <?php  
                                        for ($l=0; $l <= $max_col_num_lower ; $l++) {
                                            $l = str_pad($l, 3, "0", STR_PAD_LEFT); 
                                          
                                        if(($getBusMarkup[0]->markup_fixed)>0 && ($getBusMarkup[0]->markup_fixed)!='')
                                        {
                                         $lower_array[$k][$l]['Price']['admin_markup'] = round($getBusMarkup[0]->markup_fixed);
                                        // echo $lower_array[$k][$l]['Price']['PublishedPriceRoundedOff'];
                                        }
                                        else{
                                         $getlowermarkVal=$getBusMarkup[0]->markup_value;
                                         $lowermarkval=$getlowermarkVal/100;
                                         $lower_array[$k][$l]['Price']['admin_markup']=$lower_array[$k][$l]['Price']['PublishedPriceRoundedOff']*$lowermarkval;
                                         
                                        }
                                        // debug($lower_array[$k][$l]['Price']['admin_markup']);die;
                                                     
                                    ?>
                                            <li class="seat_layout_li" data-price="" data-name_index="" data-response="" data-seat_number="">
                                                  <input type="hidden" class="seat_layout_li" id="getalllowerseatData_<?php echo $lower_array[$k][$l]['SeatName']; ?>" value="<?php echo base64_encode(json_encode($lower_array[$k][$l])); ?>">
                                             
                                                <?php  
                                                    if(isset($lower_array[$k][$l])){
                                                        if($lower_array[$k][$l]['SeatType']!=4){
                                                            if($lower_array[$k][$l]['SeatType']==1 || $lower_array[$k][$l]['SeatType']==3){
                                                                //seat type start above
                                                                if($lower_array[$k][$l]['SeatStatus']!=1){
                                                                    //seat blocked already
                                                                ?>
                                                                    <img class="wa_senods seat_img disabled" src="<?php echo $template_images; ?>seats/seat_booked.png">
                                                                <?php
                                                                }else{
                                                                    if($lower_array[$k][$l]['IsLadiesSeat']){
                                                                        //seat lady
                                                                ?>
                                                                    <img class="wa_senods seat_img select_seat" seat_name="<?php echo $lower_array[$k][$l]['SeatName']; ?>" seat_index="<?php echo $lower_array[$k][$l]['SeatIndex']; ?>" amount="<?php echo round($lower_array[$k][$l]['Price']['TotalFare'] ); ?>" data-resp="<?php echo base64_encode(json_encode($lower_array[$k][$l])); ?>" src="<?php echo $template_images; ?>seats/seat_ladies.png">
                                                                <?php
                                                                    }else{
                                                                        //normal seat
                                                                ?>
                                                                    <img class="wa_senods seat_img select_seat" seat_name="<?php echo $lower_array[$k][$l]['SeatName']; ?>" seat_index="<?php echo $lower_array[$k][$l]['SeatIndex']; ?>" amount="<?php echo round($lower_array[$k][$l]['Price']['TotalFare']); ?>" data-resp="<?php echo base64_encode(json_encode($lower_array[$k][$l])); ?>" src="<?php echo $template_images; ?>seats/seat.png">
                                                                <?php
                                                                    }
                                                                }
                                                                //seat type ends below
                                                            }else{
                                                                //sleeper start above
                                                                if($lower_array[$k][$l]['Width']==1){
                                                                    if($lower_array[$k][$l]['SeatStatus']!=1){
                                                                    //seat blocked already
                                                                    ?>
                                                                        <img class="wa_senods w1_h2_img disabled" src="<?php echo $template_images; ?>seats/sleeper_booked_w1_h2.png">
                                                                    <?php
                                                                    }else{
                                                                        if($lower_array[$k][$l]['IsLadiesSeat']){
                                                                            //seat lady
                                                                    ?>
                                                                        <img class="wa_senods w1_h2_img select_seat" seat_name="<?php echo $lower_array[$k][$l]['SeatName']; ?>" seat_index="<?php echo $lower_array[$k][$l]['SeatIndex']; ?>" amount="<?php echo round($lower_array[$k][$l]['Price']['TotalFare']); ?>" data-resp="<?php echo base64_encode(json_encode($lower_array[$k][$l])); ?>" src="<?php echo $template_images; ?>seats/sleeper_ladies_w1_h2.png">
                                                                    <?php
                                                                        }else{
                                                                            //normal seat
                                                                          // + $lower_array[$k][$l]['Price']['admin_markup']
                                                                    ?>
                                                                        <img class="wa_senods w1_h2_img select_seat" seat_name="<?php echo $lower_array[$k][$l]['SeatName']; ?>" seat_index="<?php echo $lower_array[$k][$l]['SeatIndex']; ?>" amount="<?php echo round($lower_array[$k][$l]['Price']['TotalFare'] ); ?>" data-resp="<?php echo base64_encode(json_encode($lower_array[$k][$l])); ?>" src="<?php echo $template_images; ?>seats/sleeper_w1_h2.png">
                                                                    <?php
                                                                        }
                                                                    }
                                                                }else{
                                                                    if($lower_array[$k][$l]['SeatStatus']!=1){
                                                                    //seat blocked already
                                                                    ?>
                                                                        <!--<img class="wa_senods w2_h1_img disabled" src="<?php echo $template_images; ?>seats/sleeper_booked_w2_h1.png">-->
                                                                    <?php
                                                                    }else{
                                                                        if($lower_array[$k][$l]['IsLadiesSeat']){
                                                                            //seat lady
                                                                    ?>
                                                                        <img class="wa_senods w2_h1_img select_seat" seat_name="<?php echo $lower_array[$k][$l]['SeatName']; ?>" seat_index="<?php echo $lower_array[$k][$l]['SeatIndex']; ?>" amount="<?php echo round($lower_array[$k][$l]['Price']['TotalFare'] ); ?>" data-resp="<?php echo base64_encode(json_encode($lower_array[$k][$l])); ?>" src="<?php echo $template_images; ?>seats/sleeper_ladies_w2_h1.png">
                                                                    <?php
                                                                        }else{
                                                                            //normal seat
                                                                    ?>
                                                                        <img class="wa_senods w2_h1_img select_seat" seat_name="<?php echo $lower_array[$k][$l]['SeatName']; ?>" seat_index="<?php echo $lower_array[$k][$l]['SeatIndex']; ?>" amount="<?php echo round($lower_array[$k][$l]['Price']['TotalFare'] ); ?>" data-resp="<?php echo base64_encode(json_encode($lower_array[$k][$l])); ?>" src="<?php echo $template_images; ?>seats/sleeper_w2_h1.png">
                                                                    <?php
                                                                        }
                                                                    }
                                                                }   
                                                                //sleeper ends  below
                                                            }
                                                        }
                                                ?>
                                                        <!-- <img class="wa_senods" src="seat_icons/seat.png"> -->
                                                <?php  
                                                    }else{
                                                ?>
                                                        <img class="wa_senods">
                                                <?php       
                                                    }
                                                ?>
                                            </li>
                                    <?php  
                                        }
                                    ?>
                                </div>
                        <?php  
                            }
                        ?>
                    </div>
                  </div>
                </div>
        <?php  
            }
        ?>
        <!-- lower html ends -->
       
        
     <!--<p style="color:red;"><?php echo (isset($links))?$links:''; ?></p>-->
        <!-- down selection start -->
        <div class="col-md-12 padfive ">
            <span id="error_message" class="err_msg" style="display: none;">You cannot select more than 6 seats</span>
          <div class="wrapper_tikting_thirdtrow brdre">
            <input type="hidden" name="selected_seat_response" id="selected_seat_response" value="">
            <input type="hidden" name="resultIndex" class="route-schedule-id" value="<?=$resultIndex?>">
            
            <input type="hidden" name="tokenId" value="<?=$tokenId ?>">
            <input type="hidden" name="traceId" value="<?=$traceId ?>">
            <input type="hidden" name="session_id" value="<?=$session_id ?>">
            <input type="hidden" name="bus_res" value="<?php echo $bus_res = serialized_data($bus_res)?>">
            <input type="hidden" name="pickup-details" value="<?php echo $picdetails = serialized_data($CUR_Pickup)?>">
            <input type="hidden" name="dropdetails" value="<?php echo $dropdetails = serialized_data($CUR_Dropoff)?>">
            <input type="hidden" name="totalbus_res" value="<?php echo $totalbus_res = serialized_data($totalbus_res)?>">
            
            <div class="seat-summary">
            </div>

            <div class="col-md-6">
              <h4>Seat(s) : <span id="selected_seats" class="selected_seats"> </span></h4>
            </div>
            <div class="col-md-6">
              <h4>Amount : Rs <span id="selected_amount" class="selected_amount"> </span></h4>
            </div>
            <div class="col-md-12 nopad">
              <div class="col-md-12 nopad">
                <div class="col-md-12 nopad">
                  <div class="col-md-12 nopad">
                    <h4 class="rights_onew">Select Boarding Point</h4>
                  </div>
                  <div class="col-md-12 nopad">
                     <select class="form-control boarding-point normalsel " name="pickupId">
                        <option value="INVALIDIP">--- boarding points ---</option>
                        <?php
                            if (valid_array($CUR_Pickup) == true) {
                                foreach ($CUR_Pickup as $__pk => $__pv) {
                                    echo '<option value="'.$__pv['CityPointIndex'].'">'.get_time($__pv['CityPointTime']).' - '.$__pv['CityPointName'].' - '.$__pv['CityPointContactNumber'].'</option>';
                                }
                            }
                        ?>
                        </select>
                  </div>
                </div>
                <div class="col-md-12 nopad">
                  <div class="col-md-12 nopad">
                    <h4 class="rights_onew">Select Droping Point</h4>
                  </div>
                  <div class="col-md-12 nopad">
                    <select class="form-control drop-point normalsel " name="dropId">
                        <option value="INVALIDIP">--- drop points ---</option>
                        <?php
                            if (valid_array($CUR_Dropoff) == true) {
                                foreach ($CUR_Dropoff as $__pk => $__pv) {
                                    if(isset($__pv['CityPointLocation']) && isset($__pv['CityPointTime'])){
                                        echo '<option value="'.$__pv['CityPointIndex'].'">'.get_time($__pv['CityPointTime']).' - '.$__pv['CityPointName'].'</option>';
                                    }
                                    else{
                                        $DropoffName = $CUR_Route['To'];
                                        echo '<option value="0">'.get_time($__pv['CityPointTime']).' - '.$DropoffName.'</option>';
                                    }
                                }
                            }
                        ?>
                        </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- down selection ends -->

      </div>
    </div>
    <input name ="bookallbtn" type="button" class="bookallbtn b-btn newd_rightqa" value="Continue">
</form>
  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
   $( ".select_seat" ).bind( "click", function() {
 
        
        var seat_attr = '';
        $('#error_message').hide();
        $('#selected_seat_response').val('');
        var sum_price=0;
        var apnd_seat_name_index=apnd_complete_select_response='';
        $('.selected_seats').html('');
        $('.selected_amount').html('');

        if($(this).hasClass("opacity_cls")){
          console.log("AAA");
            $(this).removeClass('opacity_cls');
            $(this).closest('li').removeClass('back_green_clr');
            $(this).closest('li').attr('data-price',''); 
            $(this).closest('li').attr('data-name_index',''); 
            $(this).closest('li').attr('data-response',''); 
        }else{
            // if(numItems>6){
            //  $('#error_message').show();
            //  return false;
            // }
            
            var amount=parseInt($(this).attr('amount'));
            var seat_index=$(this).attr('seat_index');
            var seat_name=$(this).attr('seat_name');
            var data_response_select=$(this).attr('data-resp');
            var apnd_text=seat_index+"("+seat_name+")";
          
            $(this).addClass('opacity_cls');
            $(this).closest('li').addClass('back_green_clr');
            $(this).closest('li').attr('data-price',amount); 
            $(this).closest('li').attr('data-name_index',apnd_text); 
            $(this).closest('li').attr('data-response',data_response_select);
            $(this).closest('li').attr('data-seat_number',seat_index);
        }
        
        
        jQuery('.seat_layout_li').each(function(){ 
          
            var total_price=parseInt($(this).attr('data-price'));
            console.log("total_price",total_price)
            var seat_index_name=$(this).attr('data-name_index');
            var complete_response_encoded=$(this).attr('data-response');
            var seat_number=$(this).attr('data-seat_number');
            if(total_price){
                sum_price+=total_price;
                apnd_seat_name_index+=seat_index_name+',';
                apnd_complete_select_response+=complete_response_encoded+'-resp_brk-';
                seat_attr += '<input type="hidden" name="seat[]" value="'+seat_number+'">';
            }
        });

        var lastChar = apnd_seat_name_index.slice(-1);
        if(lastChar == ',') {
          apnd_seat_name_index = apnd_seat_name_index.slice(0, -1);
        }
        $('.selected_seats').html(apnd_seat_name_index);
        $('.selected_amount').html(sum_price);
        $('#selected_seat_response').val(apnd_complete_select_response);
        $('.seat-summary').empty().html(seat_attr);
       
    });
   


</script>



<script type="text/javascript">
   var basUrl = $('#baseUrl').val();
   $(document).on("click", ".bookallbtn", function (e) {
       if($('body').find('.back_green_clr').length < 1){
          alert("please select any seats");
         return true;
     }
     
    var that = $(this);
          e.preventDefault();
          var att = $(this).attr('data-attr');
          var frm =  $(this).closest('form').serializeArray();
          console.log(att);
          console.log(frm);
           var session_id = '<?=$session_id ?>';
           var search_id = '<?=$search_id ?>';
          // var action = basUrl+'bus/addToCart/';
          var action = basUrl+'bus/addToCart/'+session_id+'/'+search_id;
      $.ajax({
        type: "POST",
        url: action,
        data: frm,
        dataType: "json",
        beforeSend: function(){
          // $('.flights').find('.carttoloadr').fadeIn();
          },
        success: function(data){
          // $('.flights').find('.carttoloadr').fadeOut();
          console.log(data);
          if(data.isCart == false){
            alert('error')
          }else{
            if(data.status == 1){
              console.log('ajaxsuccess');
                window.location.href = data.C_URL;
            }else{
              console.log('ajaxunsuccess');
              alert(data.error);
            }
          }
        }
      });
      // callFlightCart(att);
      });
</script>
    
</body>