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
  <?php if($_SESSION['syal']['language_code']=='ar')
  {
    ?>
      <link href="<?php echo ASSETS; ?>css/flight_result_arabic.css" rel="stylesheet">
  <?php
}else{
  ?>
	<link href="<?php echo ASSETS; ?>css/flight_result.css" rel="stylesheet">
  <?php 
  } ?>
    </head>
    <body>

    	<?php //echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
<style type="text/css">
  .allpagewrp.top80 {margin: 125px 0 20px 0;}
  .book_btn_fly{
      background: #005aab none repeat scroll 0 0;
      border: 1px solid #005aab;
      border-radius: 3px;
      color: #fff;
      float: right;
      font-size: 15px;
      font-weight: 600;
      padding: 10px 25px;
      text-align: center;
      text-transform: uppercase;
  }
</style>


<?php 
// echo "<pre>"; print_r($flight_result);
if($search_request->type=='oneway'){
   if($flight_result){
         $search_date=date('D j M',strtotime($search_request->depart_date));
         $total_count=count($flight_result);

         $unsoreted_array=array();
         $price_array=array();

         for($cou=0;$cou<$total_count;$cou++){
            $total_amt=$flight_result[$cou]['PricingDetails'][0]['PriceInfo']['totalFareAmount'];
            $mix_data=array(
                        'DepartureDate' =>$flight_result[$cou]['FlightDetails'][0]['DepartureDate']['0'], 
                        'totalFareAmount' =>$total_amt, 
                        'flight_id'=>$flight_result[$cou]['flight_id'],
                        'session_id'=>$flight_result[$cou]['session_id'],
                        'routing_id'=>$flight_result[$cou]['routing_id'],
                     );
            array_push($unsoreted_array, $mix_data);   
            array_push($price_array,$total_amt);   
         }
         $min_amount=min($price_array);
         $max_amount=max($price_array);

         $before_sort_array=$unsoreted_array;
         function date_compare($a, $b)
         {
             $t1 = strtotime($a['DepartureDate']);
             $t2 = strtotime($b['DepartureDate']);
             return $t1 - $t2;
         }    
         usort($unsoreted_array, 'date_compare');
         $sorted_array=$unsoreted_array;
      ?>
      <!-- one way start -->
      <div class="allpagewrp top80">
         <div class="newmodify">
            <div class="container">
               <div class="totbrds">
                  <div class="col-xs-12 nopadding">
                  <?php 
                     foreach ($sorted_array as $key => $sorted_ele) {
                  ?>
                     <div class="col-xs-2 nopadding">                  
                        <div class="col-xs-12 nopadding">
                           <div class="headsec">
                              Departure<br><?php echo date('D j M',strtotime($sorted_ele['DepartureDate'])); ?>            
                           </div>
                        </div>
                        <div class="col-xs-12 nopadding clearfix">
                                 <?php  
                                 if($sorted_ele['totalFareAmount']){
                                    
                                    $background_color='#fff';

                                    if(($sorted_ele['totalFareAmount']!=$max_amount)||($sorted_ele['totalFareAmount']!=$min_amount)){
                                       $background_color='#fff';
                                    }
                                    if($sorted_ele['totalFareAmount']==$max_amount){
                                       $background_color='#FF7777';
                                    }
                                    if($sorted_ele['totalFareAmount']==$min_amount){
                                       $background_color='#77ff77';
                                    }
                                    if($search_date==date('D j M',strtotime($sorted_ele['DepartureDate']))){
                                       $background_color='#f68e0e';
                                    }
                                 ?>

                                 <div class="innersec" onClick="show_flight_details_oneway('<?php echo $sorted_ele['flight_id'] ?>','<?php echo $sorted_ele['session_id'] ?>','<?php echo $sorted_ele['routing_id'] ?>')" style="background-color:<?php echo $background_color; ?>;cursor: pointer;color:#333">
                                 <?php   
                                    echo BASE_CURRENCY.' '.$sorted_ele['totalFareAmount'];   
                                 }else{
                                 ?>
                                    <div class="innersec" style="background-color:#fff"> <!-- this extra div only work is no result found condition -->
                                 <?php
                                    echo 'No Flights';
                                 }
                                 ?>
                                 </div>

                        </div>
                     </div>
                  <?php  
                     }
                  ?>

                  </div>
                  <div class="clearfix"></div>
                     
               </div>
            </div>
         </div>
      </div>


      <?php 
         $tot_count=count($flight_result);
         for($k=0; $k < $tot_count; $k++) {
            $fly_count=count($flight_result[$k]['FlightDetails'][0]['DepartureDate']);
            $fly_id_div='show_flight_'.$flight_result[$k]['flight_id'].'_'.$flight_result[$k]['session_id'].'_'.$flight_result[$k]['routing_id'];
      ?>
            <table style="display: none;" class="table table-bordered  table_cnt show_all_flight" id='<?php echo $fly_id_div; ?>'>
               <thead>
                  <tr class="bg-j">
                     <th class="ftclr"><i class="fa fa-plane" aria-hidden="true"></i></th>
                     <th class="ftclr">Flight</th>
                     <th class="ftclr">From</th>
                     <th class="ftclr">To</th>
                     <th class="ftclr">Departure</th>
                     <th class="ftclr">Arrival</th>
                     <th class="ftclr">Total price</th>
                     <th class="ftclr">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $snum=0; for ($x=0; $x < $fly_count ; $x++) { ?>
                        <tr>
                           <?php $img_url='https://c.fareportal.com/n/common/air/ai/'.$flight_result[$k]['FlightDetails'][0]['marketingCarrier'][$x].'.gif'; ?>
                           <td><img src="<?php echo $img_url; ?>" alt=""></td>
                           <td>
                              <div class="tooltip1">
                                 <?php echo $flight_result[$k]['FlightDetails'][0]['airlineName'][$x]; ?> <br>
                                 <?php echo '('.$flight_result[$k]['FlightDetails'][0]['marketingCarrier'][$x].' - '.$flight_result[$k]['FlightDetails'][0]['flightOrtrainNumber'][$x].')'; ?>
                              </div>
                           </td>
                           <td><?php echo $flight_result[$k]['FlightDetails'][0]['locationIdDeparture'][$x]; ?></td>
                           <td><?php echo $flight_result[$k]['FlightDetails'][0]['locationIdArival'][$x]; ?></td>
                           <td><?php echo $flight_result[$k]['FlightDetails'][0]['DepartureDate'][$x]; ?> <br><?php echo $flight_result[$k]['FlightDetails'][0]['DepartureTime'][$x]; ?></td>
                           <td><?php echo $flight_result[$k]['FlightDetails'][0]['ArrivalDate'][$x]; ?> <br><?php echo $flight_result[$k]['FlightDetails'][0]['ArrivalTime'][$x]; ?></td>
                           <?php if($snum==0){ ?>
                              <td rowspan="4" style="vertical-align:middle;">
                                 <div class="tooltip1">
                                    <?php echo BASE_CURRENCY.' '.$flight_result[$k]['PricingDetails'][0]['PriceInfo']['totalFareAmount'] ?>    
                                 </div>
                              </td>
                              <td rowspan="4" style="vertical-align:middle;">
                                 <?php  
                                    $data_v['sessionid'] = $flight_result[$k]['session_id'];
                                    $data_v['id'] = $flight_result[$k]['flight_id'];
                                    $uid_fly  =  base64_encode(json_encode($data_v));
                                    $api_name_fly=$flight_result[$k]['api_name'];
                                 ?>
                                 <a class="FlightbookNow_calender" data-target="_blank" data-apiname="<?php echo $api_name_fly;?>" data-attr="<?php echo $uid_fly; ?>"><button type="button" class="btn btn-primary book_btn_fly"><?php echo $this->syal['Book']['Book'];?></button></a>

                              </td>
                           <?php } ?>
                        </tr>
                  <?php $snum++; } ?>
               </tbody>
            </table>
      <?php  
         }
      ?>
      <!-- one way ends -->

<?php 
   }else{
      echo "No results found !!";
   } 
}else if($search_request->type=='round'){

   if($flight_result){

      $search_date_depart=date('D j M',strtotime($search_request->depart_date));
      $search_date_return=date('D j M',strtotime($search_request->return_date));
      $total_count=count($flight_result);

      $unsoreted_array=array();
      $price_array=array();

      for($cou=0;$cou<$total_count;$cou++){
         $total_amt=$flight_result[$cou]['PricingDetails'][0]['PriceInfo']['totalFareAmount'];
         $mix_data=array(
                     'DepartureDate' =>$flight_result[$cou]['FlightDetails'][0]['DepartureDate']['0'], 
                     'ReturnDate' =>$flight_result[$cou]['FlightDetails'][1]['DepartureDate']['0'], 
                     'totalFareAmount' =>$total_amt, 
                     'flight_id'=>$flight_result[$cou]['flight_id'],
                     'session_id'=>$flight_result[$cou]['session_id'],
                     'routing_id'=>$flight_result[$cou]['routing_id'],
                  );
         array_push($unsoreted_array, $mix_data);   
         array_push($price_array,$total_amt);   
      }
      $min_amount=min($price_array);
      $max_amount=max($price_array);

      $before_sort_array=$unsoreted_array;
      foreach ($unsoreted_array as $key => $row) {
          $dept_r[$key]  = $row['DepartureDate'];
          $retu_r[$key] = $row['ReturnDate'];
      }
      array_multisort($dept_r, SORT_ASC, $retu_r, SORT_ASC, $unsoreted_array);
      $sorted_array=$unsoreted_array;
      $new_array=array();
      for($u=0;$u<count($sorted_array);$u++){
         if (!(in_array($sorted_array[$u]['DepartureDate'], $new_array))) {
            $key=$sorted_array[$u]['DepartureDate'];
            $new_array[$key]=array();
         }
      }

      for($u=0;$u<count($sorted_array);$u++){
         if (array_key_exists($sorted_array[$u]['DepartureDate'],$new_array)){
            $key=$sorted_array[$u]['DepartureDate'];
           
            $input_arr=array(
                           'ReturnDate' =>$sorted_array[$u]['ReturnDate'], 
                           'totalFareAmount' =>$sorted_array[$u]['totalFareAmount'],
                           'flight_id'=>$sorted_array[$u]['flight_id'],
                           'session_id'=>$sorted_array[$u]['session_id'],
                           'routing_id'=>$sorted_array[$u]['routing_id'], 
                        );
            array_push($new_array[$key],$input_arr);
         }
      }

      
      // echo "<pre>"; print_r($new_array);

   }else{
      echo "No results found !!";
   }


// }else{
//    echo "No results found !!";
// } 
?>



<!-- Header Carousel --> 
<div class="allpagewrp top80">
	<div class="newmodify">
		<div class="container">
			<div class="totbrds">

            <div class="col-xs-12 nopadding">
               <!-- return data top array start-->
               
               <div class="col-xs-2 nopadding">
                  <div class="col-xs-12 nopadding">
                     <div class="headsec brdbtmwt">
                     </div>
                  </div>
               </div>

               <?php  
                  $days = array('-3 days','-2 days','-1 days','+0 days','+1 days','+2 days','+3 days');  
                  for($d = 0; $d < 7; $d++){
                     // $converteddate_sd[$d] = date('D j M',strtotime($search_request->return_date. $days[$d]));
                     $converteddate_sd = date('D j M',strtotime($search_request->return_date. $days[$d]));
               ?>
                     <div class="col-xs-2 nopadding">
                        <div class="col-xs-12 nopadding">
                           <?php  
                              if($converteddate_sd==date('D j M',strtotime($search_request->return_date))){
                                 $bclor='#f68e0e';
                              }else{
                                 $bclor='#00adef';
                              }
                           ?>
                           <div class="headsec" style="background-color:<?php echo $bclor; ?>">
                              Return<br><?php echo $converteddate_sd; ?>            
                           </div>
                        </div>
                     </div>
               <?php  
                  }
               ?>
               <!-- return data top array ends-->
               
            </div>


            <div class="clearfix"></div>

               
               <?php 
                  foreach ($new_array as $depart_key => $return_data){
                     // echo "<pre>"; print_r($depart_key); 
                     // echo "<pre>"; print_r($return_data); exit();
               ?>
                     <div class="col-xs-12 nopadding">

                        <div class="col-xs-2 nopadding">
                           <div class="col-xs-12 nopadding">
                              <?php  
                                 if($search_date_depart==date('D j M',strtotime($depart_key))){
                                    $bclor='#f68e0e';
                                 }else{
                                    $bclor='#00adef';
                                 }
                              ?>
                              <div class="leftheadsec" style="background-color:<?php echo $bclor; ?>">
                                 Departure<br><?php echo  date('D j M',strtotime($depart_key)); ?>               
                              </div>
                           
                           </div>
                        </div>

                        <?php  
                           for ($iner=0; $iner <count($return_data) ; $iner++) { 
                        ?>
                              <div class="col-xs-2 nopadding">
                                 <div class="col-xs-12 nopadding">
                                    
                                    <?php  
                                       if($return_data[$iner]['totalFareAmount']){
                                          
                                          $background_color='#fff';

                                          if(($return_data[$iner]['totalFareAmount']!=$max_amount)||($return_data[$iner]['totalFareAmount']!=$min_amount)){
                                             $background_color='#fff';
                                          }
                                          if($return_data[$iner]['totalFareAmount']==$max_amount){
                                             $background_color='#FF7777';
                                          }
                                          if($return_data[$iner]['totalFareAmount']==$min_amount){
                                             $background_color='#77ff77';
                                          }
                                          // if($search_date==date('D j M',strtotime($sorted_ele['DepartureDate']))){
                                          //    $background_color='#f68e0e';
                                          // }
                                       ?>

                                       <div class="innersec" onClick="show_flight_details_roundway('<?php echo $return_data[$iner]['flight_id'] ?>','<?php echo $return_data[$iner]['session_id'] ?>','<?php echo $return_data[$iner]['routing_id'] ?>')" style="background-color:<?php echo $background_color; ?>;cursor: pointer;color:#333">
                                       <?php   
                                          echo BASE_CURRENCY.' '.$return_data[$iner]['totalFareAmount'];   
                                       }else{
                                       ?>
                                          <div class="innersec" style="background-color:#fff">
                                       <?php
                                          echo 'No Flights';
                                       }
                                       ?>
                                       </div>

                                    <!-- <div class="innersec">
                                       <span class="noflights"><?php echo BASE_CURRENCY.' '.$return_data[$iner]['totalFareAmount']; ?></span>                   
                                    </div> -->
                                 

                                 </div>
                              </div>
                        <?php 
                           }
                        ?>

                     </div>
                     <div class="clearfix"></div>
               <?php  
                  }
               ?>
        
      </div>
         
      
      <?php 
         $tot_count=count($flight_result);
         for($k=0; $k < $tot_count; $k++) {
            $fly_count_depart_connect=count($flight_result[$k]['FlightDetails'][0]['DepartureDate']);
            $fly_count_return_connect=count($flight_result[$k]['FlightDetails'][1]['DepartureDate']);
            $fly_id_div='show_flight_round_'.$flight_result[$k]['flight_id'].'_'.$flight_result[$k]['session_id'].'_'.$flight_result[$k]['routing_id'];
      ?>
            <table style="display: none;" class="table table-bordered  table_cnt show_flight_round" id='<?php echo $fly_id_div; ?>'>
               <thead>
                  <tr class="bg-j">
                     <th class="ftclr"><i class="fa fa-plane" aria-hidden="true"></i></th>
                     <th class="ftclr">Flight</th>
                     <th class="ftclr">From</th>
                     <th class="ftclr">To</th>
                     <th class="ftclr">Departure</th>
                     <th class="ftclr">Arrival</th>
                     <th class="ftclr">Total price</th>
                     <th class="ftclr">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $snum=0; for ($x=0; $x < $fly_count_depart_connect ; $x++) { ?>
                        <tr>
                           <?php $img_url='https://c.fareportal.com/n/common/air/ai/'.$flight_result[$k]['FlightDetails'][0]['marketingCarrier'][$x].'.gif'; ?>
                           <td><img src="<?php echo $img_url; ?>" alt=""></td>
                           <td>
                              <div class="tooltip1">
                                 <?php echo $flight_result[$k]['FlightDetails'][0]['airlineName'][$x]; ?> <br>
                                 <?php echo '('.$flight_result[$k]['FlightDetails'][0]['marketingCarrier'][$x].' - '.$flight_result[$k]['FlightDetails'][0]['flightOrtrainNumber'][$x].')'; ?>
                              </div>
                           </td>
                           <td><?php echo $flight_result[$k]['FlightDetails'][0]['locationIdDeparture'][$x]; ?></td>
                           <td><?php echo $flight_result[$k]['FlightDetails'][0]['locationIdArival'][$x]; ?></td>
                           <td><?php echo $flight_result[$k]['FlightDetails'][0]['DepartureDate'][$x]; ?> <br><?php echo $flight_result[$k]['FlightDetails'][0]['DepartureTime'][$x]; ?></td>
                           <td><?php echo $flight_result[$k]['FlightDetails'][0]['ArrivalDate'][$x]; ?> <br><?php echo $flight_result[$k]['FlightDetails'][0]['ArrivalTime'][$x]; ?></td>
                           <?php if($snum==0){ ?>
                              <td rowspan="4" style="vertical-align:middle;">
                                 <div class="tooltip1">
                                    <?php echo BASE_CURRENCY.' '.$flight_result[$k]['PricingDetails'][0]['PriceInfo']['totalFareAmount'] ?>    
                                 </div>
                              </td>
                              <td rowspan="4" style="vertical-align:middle;">
                                 <?php  
                                    $data_v['sessionid'] = $flight_result[$k]['session_id'];
                                    $data_v['id'] = $flight_result[$k]['flight_id'];
                                    $uid_fly  =  base64_encode(json_encode($data_v));
                                    $api_name_fly=$flight_result[$k]['api_name'];
                                 ?>
                                 <a class="FlightbookNow_calender" data-target="_blank" data-apiname="<?php echo $api_name_fly;?>" data-attr="<?php echo $uid_fly; ?>"><button type="button" class="btn btn-primary book_btn_fly"><?php echo $this->syal['Book']['Book'];?></button></a>

                              </td>
                           <?php } ?>
                        </tr>
                  <?php $snum++; } ?>


                  <?php for ($xx=0; $xx < $fly_count_return_connect ; $xx++) { ?>
                        <tr>
                           <?php $img_url='https://c.fareportal.com/n/common/air/ai/'.$flight_result[$k]['FlightDetails'][1]['marketingCarrier'][$xx].'.gif'; ?>
                           <td><img src="<?php echo $img_url; ?>" alt=""></td>
                           <td>
                              <div class="tooltip1">
                                 <?php echo $flight_result[$k]['FlightDetails'][1]['airlineName'][$xx]; ?> <br>
                                 <?php echo '('.$flight_result[$k]['FlightDetails'][1]['marketingCarrier'][$xx].' - '.$flight_result[$k]['FlightDetails'][1]['flightOrtrainNumber'][$xx].')'; ?>
                              </div>
                           </td>
                           <td><?php echo $flight_result[$k]['FlightDetails'][1]['locationIdDeparture'][$xx]; ?></td>
                           <td><?php echo $flight_result[$k]['FlightDetails'][1]['locationIdArival'][$xx]; ?></td>
                           <td><?php echo $flight_result[$k]['FlightDetails'][1]['DepartureDate'][$xx]; ?> <br><?php echo $flight_result[$k]['FlightDetails'][1]['DepartureTime'][$xx]; ?></td>
                           <td><?php echo $flight_result[$k]['FlightDetails'][1]['ArrivalDate'][$xx]; ?> <br><?php echo $flight_result[$k]['FlightDetails'][1]['ArrivalTime'][$xx]; ?></td>
                        </tr>
                  <?php } ?>


               </tbody>
            </table>
      <?php  
         }
      ?>
         
    
	  </div>
  </div>
</div>

<div class="clearfix"></div>
<?php
}else{
   echo "No results found !!";
} 
?>
<!-- Page Content -->

<?php //echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>


<script type="text/javascript" src="<?= ASSETS; ?>js/flight_filter.js"></script>

<!-- Script to Activate the Carousel --> 
<script type="text/javascript">


   function show_flight_details_oneway(flight_id,session_id,routing_id) {
      // alert('got');
      var get_id=flight_id+'_'+session_id+'_'+routing_id;
      $('.show_all_flight').hide();      
      $('#show_flight_'+get_id).show();      
   }

   function show_flight_details_roundway(flight_id,session_id,routing_id) {
      // alert('got');
      var get_id=flight_id+'_'+session_id+'_'+routing_id;
      $('.show_flight_round').hide();      
      $('#show_flight_round_'+get_id).show();      
   }


	$(document).ready(function(){

		$(".filter_depart").prop('checked', false);
        $(".filter_arrive").prop('checked', false);
		$(".filter_return").prop('checked', false);
        $(".prefer").prop('checked', false);
		//Before the AJAX function runs
		var start = new Date().getTime(),
		difference;
	
		var a = [<?php echo $api_det; ?>];
		//alert(a);
		console.log(a);
		var i = 0;
        var k = 1;
	
		function nextCall() {
			
		   if(i==0)
            {
			   $('.imgLoader').fadeIn();
			}
		   
           var x = a.length;
		   if (i == a.length) {
				   $('.imgLoader').fadeOut(500, function(){
							$('body').css('overflow', '');

					});
					return;
           }
           
		 $.ajax({
		  type:'GET', 
		  dataType:"json",
		  url: '<?php echo WEB_URL;?><?php echo $_SESSION['syal']['language_code']; ?>/flight/GetResults/<?php echo $request;?>/'+ a[i]+'/<?php echo $sessionidd; ?>',
		   beforeSend: function(XMLHttpRequest){
		  	if(i==0){
			$('.imgLoader').fadeIn();
			$('body').css('overflow', 'hidden');		
		  }
		}, 
		  success: function(response) {
        console.log(response);
			$('.flights').html(response.result);
			$('#farecal').html(response.airlinematrix);		
			airline_matrix();	
			$('.imgLoader').fadeOut(500, function(){
				$('body').css('overflow', '');
			});
			$('#pricerange').addClass('in');

      countdown(10);
      
     /* var minval = <?php echo $currencyValue; ?> * response.min_rate;
      var maxval = <?php echo $currencyValue; ?> * response.max_rate;*/

       var minval =  response.min_rate;
      var maxval =   response.max_rate;

        $("#slider-range").slider({ 
            range: true,
            min: minval,
            max: maxval,
            values: [minval, maxval],
            slide: function (event, ui) {
              $("#amount").val("<?php echo $currency;?>" + ui.values[ 0 ] + " - <?php echo $currency;?>" + ui.values[ 1 ]);
            },
            change: function (event, ui)
            {
                if (event.originalEvent) {
                  //alert("hii");
                    //FilterResults();
                }
            }
        });

    $("#amount").val("<?php echo $currency;?> " + 
    $("#slider-range").slider("values", 0) + " - <?php echo $currency;?> " + $("#slider-range").slider("values", 1));			 
			 $('#no_stops').addClass('in');
			 $('#dep_time').addClass('in');
			 $('#return_time').addClass('in');
			 $('#arr_time').addClass('in');
			
			//$("#flight_count").html(response.flight_count);
			$("#session_id").val(response.session_data);
			$("#stops_0").html(response.stops_0min_rate+" $");
			$("#stops_1").html(response.stops_1min_rate+" $");
			// $("#AirlineFilter").html(response.AirlineFilter);
			$("#stops_multi").html(response.stops_multimin_rate+" $");
			 i++;
              nextCall(); 

		  }
		});
	}
	
		  nextCall();    
	

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

  $(document).on("click", ".FlightbookNow_calender", function (e) {
	  var that = $(this);
	        e.preventDefault();
          var att = $(this).attr('data-attr');
	        var api_name = $(this).attr('data-apiname');
         
	        //var action = WEB_URL+.+ses+'/flight/addToCart/'+att+'/'+api_name;
			$.ajax({
				type: "GET",
				url: '<?php echo WEB_URL.$_SESSION["syal"]['language_code']; ?>/flight/addToCart/'+att+'/'+api_name,
				data: '',
				dataType: "json",
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
			//callFlightCart(att);
	    });
		
		
	//filter toggle	
	
	$('.filter_show').click(function(){
		$('.filtrsrch').addClass('open');
	});
	
	$('.close_filter').click(function(){
		$('.filtrsrch').removeClass('open');
	});
		
		
});
</script>
<script type="text/javascript">
   $('#flight .btn-number').on('click', function(e){
       e.preventDefault();
       fieldName = $(this).attr('data-field');
       type      = $(this).attr('data-type');
       var input = $("input[id='"+fieldName+"']");
       var currentVal = parseInt(input.val());
       var form_id = $(this).closest('form').attr('id');
       if (!isNaN(currentVal)) {
           if(type == 'minus') {
               var total_pas = parseInt($('.total_pax_count', 'form#' + form_id).text()) - 1;
               if(currentVal > input.attr('data-min')) {
                  if(fieldName == 'adult' || fieldName == 'child'){
                       //flight
                       var max = 9;
                       var chd = parseInt($('#child').val()); 
                       var adt = parseInt($('#adult').val());
                       var inf = parseInt($('#infant').val());
                       var persons = adt + chd;
                       
                       if(persons <= max){
                           input.val(currentVal - 1).change();
                           $('.total_pax_count', 'form#' + form_id).empty().text(total_pas);
                       }
   
                       if(fieldName == 'adult'){
                           //console.log(inf +'>='+ adt);
                           if(inf >= adt){
                               $('#infant').val(adt-1).change();
                               $('.total_pax_count', 'form#' + form_id).empty().text(total_pas);
                           } 
                       }
                                           
                   }if(fieldName == 'infant'){
                       var adt = parseInt($('#adult').val());
                       var inf = parseInt($('#infant').val());
                       if(inf <= adt){
                           input.val(currentVal - 1).change();
                           $('.total_pax_count', 'form#' + form_id).empty().text(total_pas);
                       }                    
                   }else{
                       input.val(currentVal - 1).change();
                   }
               } 
               if(parseInt(input.val()) == input.attr('data-min')) {
                   $(this).attr('disabled', true);
               }
   
           } else if(type == 'plus') {
             var total_pas = parseInt($('.total_pax_count', 'form#' + form_id).text()) + 1;
               if(currentVal < input.attr('data-max')) {
                   if(fieldName == 'adult' || fieldName == 'child'){
                       //flight
                       var max = 9;
                       var chd = parseInt($('#child').val());
                       var adt = parseInt($('#adult').val());
                       var persons = adt + chd;
                       if(persons < max){
                           //console.log(persons +'<'+ max);
                           input.val(currentVal + 1).change();
                           $('.total_pax_count', 'form#' + form_id).empty().text(total_pas);
                       }                    
                   }else if(fieldName == 'infant'){
                       var adt = parseInt($('#adult').val());
                       var inf = parseInt($('#infant').val());
                       if(inf < adt){
                           input.val(currentVal + 1).change();
                           $('.total_pax_count', 'form#' + form_id).empty().text(total_pas);
                       }
                   }else{
                       input.val(currentVal + 1).change();
                   } 
               }
               if(parseInt(input.val()) == input.attr('data-max')) {
                   $(this).attr('disabled', true);
               }
   
           }
       } else {
           input.val(0);
       }
   });
</script>

<script type="text/javascript">
  var timeoutHandle;
function countdown(minutes) {
    var seconds = 60;
    var mins = minutes
    function tick() {
        var counter = document.getElementById("timer");
        var current_minutes = mins-1
        seconds--;
        document.getElementById("timer").innerHTML =
        current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
        if( seconds > 0 ) {
            timeoutHandle=setTimeout(tick, 1000);
        } else {

            if(mins > 1){
               // countdown(mins-1);   never reach “00″ issue solved:Contributed by Victor Streithorst
               setTimeout(function () { countdown(mins - 1); }, 1000);

            }
        }

          var count = counter.innerHTML; //parseInt(counter.innerHTML);
          // alert(count);
        if ((counter.innerHTML) == '0:00') {
            alert('Your session expired. Your booking wont be completed. Please search again.');
            location.href = '<?php echo WEB_URL;?>';
         }
    }
    tick();
}
</script>

<script type="text/javascript">
  $(document).on('click', '.next_day', function(){

      <?php if($request_data->type == 'oneway'){ ?>
        var new_date = $(this).data('journey-date');
        // console.log(new_date);
        var search_request = '<?php echo $request; ?>';
        window.location.href = '<?php echo WEB_URL.$_SESSION["syal"]['language_code']; ?>/flight/add_days_todate?search_request='+search_request+'&new_date='+new_date;
      <?php } ?>
      });

      $(document).on('click', '.previous_day', function(){
        <?php if($request_data->type == 'oneway'){ ?>

        var new_date = $(this).data('journey-date');
        // console.log(new_date);
        var search_request = '<?php echo $request; ?>';
        window.location.href = '<?php echo WEB_URL.$_SESSION["syal"]['language_code']; ?>/flight/add_days_todate?search_request='+search_request+'&new_date='+new_date;
      <?php } ?>
      });
</script>

</body>
</html>
