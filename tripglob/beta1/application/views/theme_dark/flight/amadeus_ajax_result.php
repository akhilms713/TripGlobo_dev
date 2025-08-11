
<?php
    
    $flights_data = base64_encode(json_encode($flights)); // For reference
    $request = base64_encode(json_encode($request)); // request For reference
    //$flights_data = json_decode(base64_decode($flights_data));
    //echo'<pre>'; print_r($flights_data);die; 
    $flights = json_decode(json_encode($flights));
    $i=0;
  
    foreach($flights as $flight){
		
    $flight_data = base64_encode(json_encode($flight));
    $first_seg = reset($flight->segments[0]); 
    $last_seg = end($flight->segments[0]);
    $fromCityName =  $this->flight_model->get_airport_cityname($first_seg->Origin);
    $toCityName =  $this->flight_model->get_airport_cityname($last_seg->Destination);
	$price[] = $flight->TotalPrice;
	
    $Airlines[] = $first_seg->Carrier;
    $Stops[] = count($flight->segments[0])-1;
    
    //	Exploding T from arrival time  
	//	echo $last_seg->ArrivalTime;exit;

    $ArrivalDateTime = $art = strtotime($last_seg->ArrivalTime);
    //echo $ArrivalDateTime;die;

    //Exploding T from depature time  

    $DepartureDateTime = $dpt = strtotime($first_seg->DepartureTime);

    $seconds = $ArrivalDateTime - $DepartureDateTime;
    $jms = $seconds/60;
    $days = floor($seconds / 86400);
    $hours = floor(($seconds - ($days * 86400)) / 3600);
    $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
    // $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
    if($days==0){
        $dur=$hours."h ".$minutes."m";  
    }else{
        $dur=$days."d ".$hours."h ".$minutes."m";
    }

    $deptime = date('h:i', $DepartureDateTime);
    list($hours, $min) = explode(':', $deptime);
    $depminutes=$hours*60;
    $depminutes=$depminutes+$min;
	
?>


 <!-- Normal trip-->
<div id="ticketid0123<?php echo $i;?>" class="maderow flight" data-airline="<?php echo $this->flight_model->get_airline_name($first_seg->Carrier);?>" data-arrive="<?php echo $ArrivalDateTime;?>" data-duration="<?php echo $jms;?>" data-stops="<?php echo count($flight->segments[0])-1;?>" data-depature="<?php echo $depminutes;?>" data-airlinecode="<?php echo $first_seg->Carrier;?>" data-price="<?php echo $this->home_model->currency_convertor_v1($flight->TotalPrice);?>">
    <div class="col-md-12 nopad">
    <!-- GOING TICKET-->
        <div class="frow1">
        
        	
        
            <div class="col-md-12 nopad tablshow">
                <div class="col-md-2 col-xs-2 nopad litblue">
                    <!--<button class="lightbtn" type="button" data-toggle="collapse" data-target="#collapse10">More</button>-->
                    <div class="pricefilt">
                        <span class="nortocount"><span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->home_model->currency_convertor_v1($flight->TotalPrice);?></span></span>
                        <span class="norto2"><strong><?php echo $this->lang->line('FL_One_Way'); ?>  </strong><?php echo $this->lang->line('FL_Per_Person'); ?></span>
                        <form name="flightbook<?php echo $i;?>" id="F<?php echo str_replace('.', '', $flight->TotalPrice).$i;?>" action="<?php echo WEB_URL;?>">
                        <input type="hidden" name="chk_do" value="AM" required/>
                            <input type="hidden" name="temp_d" value="<?php echo $flight_data;?>" required/>
                            <input type="hidden" name="temp_r" value="<?php echo $request;?>" required/>
                            <input class="selectbtn FlightbookNow" type="button" name="button" data-attr="F<?php echo str_replace('.', '', $flight->TotalPrice).$i;?>" value="Select" />
                        </form>
                    </div>
                </div>
                
                	
                
                <div class="col-md-12 col-xs-12 nopad fulwidmob">
                    <div class="onwyrow">
                        <div class="fblueline">
                        
                        <?php 
						$segs = $flight->segments[0];
						for($k=0;$k<count($flight->segments[0]);$k++)
						{
							if($k==0)
							{
							echo '<b>'. $this->flight_model->get_airport_cityname($segs[$k]->Origin).'</b> '.'('.$segs[$k]->Origin.')';
							echo '<span class="farrow"></span>';
							echo '<b>'. $this->flight_model->get_airport_cityname($segs[$k]->Destination).'</b> '.'('.$segs[$k]->Destination.')';
							}
							else
							{
								echo '<span class="farrow"></span>';
							echo '<b>'. $this->flight_model->get_airport_cityname($segs[$k]->Destination).'</b> '.'('.$segs[$k]->Destination.')';
							}
						}
						?>
                            
                        </div>
                        <div class="col-md-2 col-xs-2 fulat500">
                            <div class="flitsecimg">
                                <img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $first_seg->Carrier;?>.gif" id="FF<?php echo str_replace('.', '', $flight->TotalPrice).$i;?>" alt="">
                                <span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($first_seg->Carrier);?></span>
                            </div>
                        </div>
                        
                        <div class="col-md-7 col-xs-7 nopad fulat500">
                        
                        <div class="col-md-5 col-xs-5">
                            <div class="radiobtn rittextalign"><?php echo $this->lang->line('FL_Depature'); ?></div>
                            <span class="norto rittextalign"><?php echo date('d M, D Y', $DepartureDateTime);?></span>
                            <span class="norto lbold rittextalign"><?php echo date('h:i a', $DepartureDateTime);?></span>
                        </div>
                        <div class="col-md-2 col-xs-2 nopad">
                            <div class="flightimgs">
                                <img src="<?php echo ASSETS;?>images/departure.png" alt="" />
                            </div>
                        </div>
                        <div class="col-md-5 col-xs-5">
                            <span class="radiobtn"><?php echo $this->lang->line('FL_Arrival'); ?></span>
                            <span class="norto"><?php echo date('d M, D Y', $ArrivalDateTime);?></span>
                            <span class="norto lbold"><?php echo date('h:i a', $ArrivalDateTime);?></span>
                        </div>
                        
                        </div>
                        
                        <div class="col-md-3 col-xs-3 nopad fulat500">
                            <div class="fatfi">
                                <span class="radiobtn"><?php echo $this->lang->line('FL_Duration'); ?></span>
                                <span class="norto"><?php echo $this->lang->line('FL_Economy'); ?></span>
                                <span class="norto lbold"><?php echo $dur;?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="clear"></div>
                    <div class="pricefilt foronmob">
                        <span class="nortocount"><span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->home_model->currency_convertor_v1($flight->TotalPrice);?></span></span>
                        <span class="norto2"><strong><?php echo $this->lang->line('FL_One_Way'); ?>  </strong><?php echo $this->lang->line('FL_Per_Person'); ?></span>
                        <form name="flightbook<?php echo $i;?>" id="F<?php echo str_replace('.', '', $flight->TotalPrice).$i;?>" action="<?php echo WEB_URL;?>">
                            <input type="hidden" name="temp_d" value="<?php echo $flight_data;?>" required/>
                            <input type="hidden" name="temp_r" value="<?php echo $request;?>" required/>
                            <input class="selectbtn FlightbookNow" type="button" name="button" data-attr="F<?php echo str_replace('.', '', $flight->TotalPrice).$i;?>" value="Select" />
                        </form>
                    </div>
                    <div class="clear"></div>
                    <div class="toglerow">
                        <button class="lightbtn" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i;?>"><?php echo $this->lang->line('FL_Show_F_Details'); ?></button>
                    </div>
                </div> 
            </div>
            <div class="clearfix"></div>
            <div  class="collapse frowexpand" id="collapse<?php echo $i;?>">
                <div class="col-md-12 nopad tablshow">
                    <div class="col-md-2 col-xs-2 nopad litblue">
                        <div class="clsfare">
                            <div class="pricerow">
                                <h4 class="brkup"><?php echo $this->lang->line('FL_Total_Fare'); ?></h4>
                                <div class="inrowse">
                                    <span class="pricelabl"><?php echo $this->lang->line('FL_Total_Base_Fare'); ?></span>
                                    <span class="priceamnt"><span class="curr_icon"><?php echo $this->display_icon;?></span><?php echo $this->home_model->currency_convertor_v1($flight->BasePrice);?></span>
                                </div>
                                <div class="inrowse">
                                    <span class="pricelabl"><?php echo $this->lang->line('FL_Tax'); ?></span>
                                    <span class="priceamnt"><span class="curr_icon"><?php echo $this->display_icon;?></span><?php echo $this->home_model->currency_convertor_v1($flight->Taxes);?></span>
                                </div>
                                <div class="inrowse">
                                    <span class="pricelabl"><?php echo $this->lang->line('FL_Grand_Total'); ?></span>
                                    <span class="priceamnt totlamntcol"><span class="curr_icon"><?php echo $this->display_icon;?></span><?php echo $this->home_model->currency_convertor_v1($flight->TotalPrice);?></span>
                                </div>  
                            </div>
                        </div>
                    </div>
                    
                        <div class="col-md-12 nopad fulwidmob">
<?php 

foreach($flight->segments[0] as $key => $segment){
//Exploding T from arrival time  

$ArrivalDateTime = $art = strtotime($segment->ArrivalTime);
//echo $ArrivalDateTime;die;

$DepartureDateTime = $dpt = strtotime($segment->DepartureTime);

$seconds = $ArrivalDateTime - $DepartureDateTime;

$days = floor($seconds / 86400);
$hours = floor(($seconds - ($days * 86400)) / 3600);
$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
// $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
if($days==0){
    $dur=$hours."h ".$minutes."m";  
}else{
    $dur=$days."d ".$hours."h ".$minutes."m";
}
if(count($flight->segments[0]) > 0 &&  $key+1 < count($flight->segments[0])){
    //Exploding T from arrival time  

    $ArrivalDateTime_v = $art = strtotime($flight->segments[0][$key]->ArrivalTime);
    //echo $ArrivalDateTime;die;

    //Exploding T from depature time  

    $DepartureDateTime_v = $dpt = strtotime($flight->segments[0][$key+1]->DepartureTime);

    $seconds_v = $DepartureDateTime_v - $ArrivalDateTime_v;

    $days_v = floor($seconds_v / 86400);
    $hours_v = floor(($seconds_v - ($days_v * 86400)) / 3600);
    $minutes_v = floor(($seconds_v - ($days_v * 86400) - ($hours_v * 3600))/60);
    // $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
    if($days_v==0){
        $Layover=$hours_v."h ".$minutes_v."m";  
    }else{
        $Layover=$days_v."d ".$hours_v."h ".$minutes_v."m";
    }
}
?>                        
                            <div class="repflight">
                            
                                <div class="col-md-4 col-xs-4 fulat500">
                                    <div class="alldetss">
                                        <div class="detflitimg">
                                            <img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $segment->Carrier;?>.gif"  alt=""/>
                                        </div>
                                        <span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($segment->Carrier);?>-<?php echo $segment->FlightNumber;?><br><?php echo $segment->Carrier;?>-<?php echo $segment->Equipment;?></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-8 col-xs-8 nopad fulat500">
                                <div class="col-md-5 col-xs-5">
                                    <span class="radiobtnnill rittextalign"><?php echo $segment->Origin;?> <strong><?php echo date('h:i a', $DepartureDateTime);?></strong></span>
                                    <span class="norto rittextalign"><?php echo date('d M, Y', $DepartureDateTime);?></span>
                                    <span class="simle rittextalign"><?php echo $this->flight_model->get_airport_name($segment->Origin);?></span>
                                </div>
                                <div class="col-md-2 col-xs-2">
                                    <span class="timeclo"></span>
                                    <span class="nortocen lbold"><?php echo $dur;?></span>
                                </div>
                                <div class="col-md-5 col-xs-5">
                                    <span class="radiobtnnill"><?php echo $segment->Destination;?> <strong><?php echo date('h:i a', $ArrivalDateTime);?></strong></span>
                                    <span class="norto"><?php echo date('d M, Y', $ArrivalDateTime);?></span>
                                    <span class="simle"><?php echo $this->flight_model->get_airport_name($segment->Destination);?></span>
                                </div>
                                </div>
                                
                                
                            </div>
                            <div class="clear"></div>
                            <?php if(count($flight->segments[0]) > 0 &&  $key+1 < count($flight->segments[0])){?>
                            <div class="betwenrow"><?php echo $this->lang->line('FL_Change_Plane'); ?>  <strong><?php echo $this->flight_model->get_airport_name($segment->Destination);?></strong>, | <strong><?php echo $this->lang->line('FL_Layover'); ?> <?php echo $Layover;?></strong> </div>
                            <div class="clear"></div>
                            <?php } ?>
<?php }?>                            
                            
                        </div>

                </div>
            </div>
        </div>
    <!-- END OF GOING TICKET-->
    </div>
</div>
<!-- Normal trip End-->
<?php


 $i++;}?>
<?php 
    echo '<div id="errorMessage" style="text-align:center;display:none;" class="no_available">
    <h1>There are no flights available. </h1>
    <br><br>
    <div class="no_available_text">Sorry, we have no prices for flights in this date range matching your criteria. One or more of your preferences may be affecting the number of exact matches found. Try searching again with a wider search criteria. <br></div>
    </div>'; // Error Message
?>
<?php $Airlines = array_unique($Airlines); //Creating Unique Airlines?>
<?php $Stops = array_unique($Stops); //Creating Unique Airlines?>
<input type="hidden" name="temp_d" value="<?php echo $flights_data;?>"/>
<input type="hidden" id="setMinPrice" value="<?php if(!empty($price)) echo min($price); else echo 0; ?>" />
<input type="hidden" id="setMaxPrice" value="<?php if(!empty($price)) echo max($price); else echo 0; ?>" />
<input type="hidden" id="setMinTime" value="0" />
<input type="hidden" id="setMaxTime" value="1440" />
<script>
function showFlights(minPrice, maxPrice) {
    $("div.flights div.flight").removeClass('Fcount').hide().filter(function() {
        //var price = parseFloat($(this).data("price"));
        var price = $(this).find("span.amount").html();
        //var price = price.replace(/,/g , '');
        var price = parseFloat(price);
        console.log(price);
       //console.log(price+' >= '+minPrice+' && '+price+' <= '+maxPrice);
        return price >= minPrice && price <= maxPrice;
    }).addClass('Fcount').show();
    //checkCount();
}
function showDepFlights(mint, maxt) {
    $("div.flights div.flight").hide().filter(function() {
      var dep = $(this).data("depature");
      return dep >= mint && dep <= maxt;
    }).show();
}
$('#pricerange').addClass('in');
  $(function() {
    $( "#slider-range" ).slider({
      range: true,
      min: <?php echo $this->home_model->currency_convertor_v1(min($price))?>,
      max: <?php echo $this->home_model->currency_convertor_v1(max($price))?>,
      values: [ <?php echo $this->home_model->currency_convertor_v1(min($price))?>, <?php echo $this->home_model->currency_convertor_v1(max($price))?> ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "<?php echo $this->display_icon;?>" + ui.values[ 0 ] + " - <?php echo $this->display_icon;?>" + ui.values[ 1 ] );
      },
      change: function( event, ui ) {
         one=ui.values[0];
         two=ui.values[1];
         //alert(one+'-'+two);
         showFlights(one, two);
        
      }
    });
    $( "#amount" ).val( "<?php echo $this->display_icon;?>" + $( "#slider-range" ).slider( "values", 0 ) +
      " - <?php echo $this->display_icon;?>" + $( "#slider-range" ).slider( "values", 1 ) );
  });

var startTime;
  var endTime;
  function slideTime(event, ui){
    var val0 = $("#DepSlider").slider("values", 0),
      val1 = $("#DepSlider").slider("values", 1),
      minutes0 = parseInt(val0 % 60, 10),
      hours0 = parseInt(val0 / 60 % 24, 10),
      minutes1 = parseInt(val1 % 60, 10),
      hours1 = parseInt(val1 / 60 % 24, 10);
      
    startTime = getTime(hours0, minutes0);
    endTime = getTime(hours1, minutes1);
    // startTime = hours0+':'+minutes0;
    // endTime = hours1+':'+minutes1;
    $("#Dep").val(startTime + ' - ' + endTime);
  }
  function getTime(hours, minutes) {
    var time = null;
    minutes = minutes + "";
    if (hours < 12) {
      time = "AM";
    }
    else {
      time = "PM";
    }
    if (hours == 0) {
      hours = 12;
    }
    if (hours > 12) {
      hours = hours - 12;
    }
    if (minutes.length == 1) {
      minutes = "0" + minutes;
    }
    return hours + ":" + minutes + " " + time;
  }
$('#departtime').addClass('in');  
    $( "#DepSlider" ).slider({
      range: true,
      min: 0,
      max: 1439,
      step: 1,
      values: [ 0, 1439 ],
      slide: slideTime,
      change: function( event, ui ) {
         one=ui.values[0];
         two=ui.values[1];
         //alert(one+'-'+two);
          showDepFlights(one, two);
        
      }
    });
slideTime();
$('#airlines').addClass('in');
$('#AirlineFilter').html('<?php $i=1;foreach($Airlines as $airline){?><li class="cheklist"><label for="airline<?php echo $i;?>"><div class="left"><input class="filtchk serch-blue airline" name="airline" type="checkbox" id="airline<?php echo $i;?>" value="<?php echo $airline;?>" checked/></div><span class="cheklabl"><?php echo $this->flight_model->get_airline_name($airline);?></span></label></li><?php $i++; }?>');       


var $filters = $("input:checkbox[name='airline']"); // start all checked
var $categoryContent = $('div.flights div.flight'); // Path for flights

var $errorMessage = $('#errorMessage'); //Error Message

$filters.on('ifChanged', function(event){
  $categoryContent.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters = $filters.filter(':checked');
  if ($selectedFilters.length > 0) {
    $errorMessage.hide();
    $selectedFilters.each(function (i, el) {
      $('div.flights div.flight[data-airlinecode="'+ el.value +'"]').show();
    });
  } else {
      $errorMessage.show();
  }
});


$('#stops').addClass('in');
$('#StopFilter').html('<?php $i=1;foreach($Stops as $stop){?><li class="cheklist"><label for="stop<?php echo $i;?>"><div class="left"><input class="filtchk serch-blue stop" name="stop" type="checkbox" id="stop<?php echo $i;?>" value="<?php echo $stop;?>" checked/></div><span class="cheklabl"><?php if($stop == 0){ echo 'Non';}else if($stop == 1){echo 'One';}else if($stop == 2){echo 'Two';}else if($stop == 3){echo 'Three';}else{echo $stop;}?>-Stop</span></label></li><?php $i++; }?>');
var $filters1 = $("input:checkbox[name='stop']"); // start all checked
var $categoryContent1 = $('div.flights div.flight'); // Path for flights
var $errorMessage = $('#errorMessage'); //Error Message

$filters1.on('ifChanged', function(event){
  $categoryContent1.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters1 = $filters1.filter(':checked');
  //console.log($selectedFilters);
  if ($selectedFilters1.length > 0) {
    $errorMessage.hide();
    $selectedFilters1.each(function (i, el) {
      $('div.flights div.flight[data-stops="'+ el.value +'"]').show();
    });
  } else {
      $errorMessage.show();
  }
});

$('input.serch-blue').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat'
});
</script>
