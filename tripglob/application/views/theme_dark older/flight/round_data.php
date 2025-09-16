 <div class="rowresult" price='<?php echo $TotalPrice;?>'>
    <div class="madgrid">
<?php
 for($k=0;$k<$inner_segment_len;$k++)
                {
                    $segment_path=$segments[$j][$k];
                    $Carrier=$segment_path['Carrier'];
                    $Equipment=$segment_path['Equipment'];
                    $FlightNumber=$segment_path['FlightNumber'];
                    $Origin=$segment_path['Origin'];
                    $Destination=$segment_path['Destination'];
                    $DepartureTime=$segment_path['DepartureTime'];
                    $DepartureDate=$segment_path['DepartureDate'];
                    $ArrivalTime=$segment_path['ArrivalTime'];
                    $ArrivalDate=$segment_path['ArrivalDate'];
                    $DeparturedateTime=$segment_path['DeparturedateTime'];
                    $ArrivaldateTime=$segment_path['ArrivaldateTime'];
                    $stops=count($segments[$j][$k]);


                    $d_d=str_split($DepartureDate, 2);
                    $dd=$d_d['0'];
                    $dm=$d_d['1'];
                    $dy=$d_d['2'];


                    $d_t = str_split($DepartureTime, 2);
                    $hh=$d_t['0'];
                    $mm=$d_t['1'];


                    $a_d=str_split($ArrivalDate, 2);
                    $add=$a_d['0'];
                    $adm=$a_d['1'];
                    $ady=$a_d['2'];


                    $a_t=str_split($ArrivalTime, 2);
                    $hha=$a_t['0'];
                    $mma=$a_t['1'];

        $o_ArrivalDateTime = strtotime($ArrivaldateTime);
        $o_DepartureDateTime = strtotime($DeparturedateTime);
        $seconds = $o_ArrivalDateTime - $o_DepartureDateTime;
        $jms = $seconds/60;
        $days = floor($seconds / 86400);
        $hours = floor(($seconds - ($days * 86400)) / 3600);
        $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
        $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
        if($days==0){
         $duration=$hours."h ".$minutes."m";  
     }else{
         $duration=$days."d ".$hours."h ".$minutes."m";
     }
     $duration;


     $airline_data=array();
     $airline_data=$this->flight_model->get_airline_name($Carrier);

     ?>
     <div class="col-xs-12 nopad">
        <div class="sidenamedesc">
        <!-- Round trip start -->
           <div class="celhtl width20 midlbord">
             <div class="fligthsmll">
                <img src="<?php echo base_url(); ?>assets/theme_dark/icons/<?php echo $Carrier; ?>.gif" alt="" />
            </div>
            <div class="airlinename"><?php echo $this->flight_model->get_airline_name($Carrier); ?></div>
        </div>
        <div class="celhtl width80">
            <div class="waymensn">
                <div class="flitruo cloroutbnd">
                   <div class="detlnavi">
                    <div class="col-xs-4 padflt widfty">
                        <span class="timlbl right">
                          <span class="flname"><span class="sprite reflone"></span><?php echo  $Origin; ?><span class="fltime"><?php echo $hh; echo ":";echo $mm;   ?></span></span>
                      </span>
                      <div class="clearfix"></div>
                      <span class="flitrlbl elipsetool"><?php echo date("M d", $o_ArrivalDateTime); ?> </span>
                      <div class="rndplace"><?php echo $this->flight_model->get_airport_cityname($Origin); ?></div>
                  </div>
                  <div class="col-xs-4 nopad padflt widfty">
                    <div class="lyovrtime"> 
                        <span class="flect"> <span class="sprite retime"></span> <?php echo $duration;  ?></span>
                        <div class="instops <?php if($stop > 1) echo 'morestop'; if($stop > 2) echo 'plusone'; ?>">
                            <a class="stopone">
                                <label class="rounds"></label>
                            </a>
                            <a class="stopone">
                                <label class="rounds <?php if($stop != 2) echo 'oneonly'; ?>"></label>
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
                      <span class="flname"><span class="sprite refltwo"></span><?php echo  $Destination; ?><span class="fltime"><?php echo $hha; echo ":";echo $mma;  ?></span> </span>
                  </span>
                  <div class="clearfix"></div>
                  <span class="flitrlbl elipsetool"><?php 
                   echo   date("M d", $o_DepartureDateTime);
                   ?></span>
                   <div class="rndplace"><?php echo $this->flight_model->get_airport_cityname($Destination); ?></div>
               </div>
           </div>
       </div>
   </div>  
</div>
<?php
}
?>
</div>
<div class="mrinfrmtn">
    <a class="detailsflt" data-toggle="modal" onclick="show_flightpopup('<?php echo $FlightNumber; ?>', 'itenerary')" data-target="#flight_res"> <span class="sprite fldetail"></span>Flight Details</a>
    <a class="detailsflt fare_flight" data-toggle="modal" onclick="show_flightpopup('<?php echo $FlightNumber; ?>', 'faredets')" data-target="#flight_res"> <span class="sprite faredetail"></span>Fare Details</a>
    <div class="sidepricewrp"  >
        <div class="sideprice" >
         <?= BASE_CURRENCY_ICON.' '.$TotalPrice; ?>
     </div>
     <?php

//$data_v['sessionid'] = $res['session_id'];
     $data_v['id'] = $FlightNumber;
     $uid  =  base64_encode(json_encode($data_v));
     ?>
     <div class="bookbtn">
        <a class="booknow FlightbookNow" data-target="_blank" data-attr="<?php echo $uid; ?>">Book</a>
    </div>
</div>
</div>
</div>
</div>
</div>