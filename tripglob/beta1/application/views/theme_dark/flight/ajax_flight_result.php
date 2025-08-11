<div class="carttoloadr"><strong>Confirming your flight...</strong></div>

<?php 
if(!empty($flight_result)){  //echo '<pre/>';print_r($flight_result);exit;
		$flight_count_res=count($flight_result);
			for($i=0;$i<$flight_count_res;$i++){ ?>
				<div class="rowresult" price='<?php $flight_result[$i]['amount'];?>'> 
					<div class="madgrid">
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
								</div>
								<div class="airlinename"><?php echo $flight_result[$i]['FlightDetails'][$j]['airlineName'][0]; ?></div>
							  </div>
							  <div class="celhtl width60">
								<div class="waymensn">

								  <div class="flitruo cloroutbnd">
								   <div class="detlnavi">
									<div class="col-xs-4 cus-se padflt widfty">
									  <span class="timlbl right">
										<span class="flname"><span class="sprite reflone"></span><?php echo  $flight_result[$i]['FlightDetails'][$j]['locationIdDeparture'][0]; ?><span class="fltime"><?php echo $flight_result[$i]['FlightDetails'][$j]['DepartureTime'][0];   ?></span></span>
									  </span>
									  <div class="clearfix"></div>
									  <span class="flitrlbl elipsetool"><?php echo date('M d,Y',strtotime($flight_result[$i]['FlightDetails'][$j]['DepartureDate'][0])); ?> </span>
									  <div class="rndplace"><?php echo $this->Flight_Model->get_airport_cityname($flight_result[$i]['FlightDetails'][$j]['locationIdDeparture'][0]); ?></div>
									</div>
									<div class="col-xs-4 nopad padflt widfty">
									  <div class="lyovrtime"> 
										<!--<span class="flect"> <span class="sprite retime"></span> <?php echo  $flight_result[$i]['FlightDetails'][$j]['durationFinalEft'];  ?></span>-->
																				<div class="instops <?php if($flight_result[$i]['FlightDetails'][$j]['stops'] > 1) echo 'morestop'; if($flight_result[$i]['FlightDetails'][$j]['stops'] > 2) echo 'plusone'; ?>">
										  <a class="stopone">
											<label class="rounds"></label>
										  </a>
										  <a class="stopone">
										<!-- 	<label class="rounds <?php if($flight_result[$i]['FlightDetails'][$j]['stops'] != 2) echo 'oneonly'; ?>"></label> -->
											<!-- <label class="rounds oneplus"></label> -->
											
										  </a>
										  <a class="stopone">
											<label class="rounds"></label>
										  </a>
										</div>

									  </div>  
									</div>
									<div class="col-xs-4 padflt widfty">
									  <span class="timlbl left">
										<span class="flname"><span class="sprite refltwo"></span><?php echo  $flight_result[$i]['FlightDetails'][$j]['locationIdArival'][$inner_segment_len]; ?><span class="fltime"><?php echo $flight_result[$i]['FlightDetails'][$j]['ArrivalTime'][$inner_segment_len];  ?></span> </span>

									  </span>
									  <div class="clearfix"></div>
									  <span class="flitrlbl elipsetool"><?php 
									   echo date('M d,Y',strtotime($flight_result[$i]['FlightDetails'][$j]['ArrivalDate'][$inner_segment_len]));
									   ?></span>
									   <div class="rndplace"><?php echo $this->Flight_Model->get_airport_cityname($flight_result[$i]['FlightDetails'][$j]['locationIdArival'][$inner_segment_len]); ?></div>
									 </div>
								   </div>
								 </div>

							   </div>
							 </div>  
						</div>
                        		
						 </div>
						<?php }  }   ?>
                        <div class="mrinfrmtn">
                        hello
   <a class="detailsflt" data-toggle="modal" onclick="show_flightpopup('<?php echo  $flight_result[$i]['routing_id'];  ?>', 'itenerary')" data-target="#flight_res"> <span class="sprite fldetail"></span>Flight Details</a> 
   <a class="detailsflt fare_flight" data-toggle="modal" onclick="show_flightpopup('<?php echo  $flight_result[$i]['routing_id']; ?>', 'faredets')" data-target="#flight_res"> <span class="sprite faredetail"></span>Fare Details</a>
   <div class="sidepricewrp"  >
    <div class="sideprice" >
     <?= BASE_CURRENCY_ICON.' '.$flight_result[$i]['amount']; ?>
   </div>
   
<?php
$data_v['sessionid'] = $flight_result[$i]['session_id'];
$data_v['id'] = $flight_result[$i]['flight_id'];
$uid  =  base64_encode(json_encode($data_v)); 

?>
<div class="carttoloadr" id="hotel_loader"><strong>Getting your hotel Information...</strong></div>

   <div class="bookbtn">
    <a class="booknow" id="filght_package_select" href="#" data-id-attr="<?php echo $data_v['id']; ?>"  data-pass-attr="<?php echo $Req_before_decode; ?>"  data-attr="<?php echo $uid; ?>">Select</a>
  </div>

</div>
</div>
				 </div>
				</div>



</div>
<?php
}

}else{ 
  echo "<center> <h3> No Result Found. </h3><center>" ; } ?>
  <?php echo $this->ajax_pagination->create_links();
  $hotelrequest = $request->hotel_request;
   ?>
  
  <div class="modal fade"  id="flight_res" role="dialog">
  <div class="modal-dialog ">
  </div>

  </div>



  <script type="text/javascript">
   

    function show_flightpopup(id, divclass){
     var idval = id;
     $.ajax({
      type:'GET', 
      url: '<?php echo WEB_URL;?>flight/call_iternary/'+idval,
      beforeSend: function(XMLHttpRequest){
        $('.flight_fliter_loader').fadeIn();
      }, 
      success: function(response) {
        $('#flight_res').html(response);
        $( "li.active" ).removeClass( "active" );
        //$( "div.active" ).removeClass( "active" );
        $('#'+divclass+'_li').addClass('active');
        $('#'+divclass).addClass('active');
        $('.flight_fliter_loader').fadeOut();
         }
     });  
    }


$('.booknow').click(function(event){
	  event.preventDefault();
	  var idVal = $(this).attr('data-id-attr');
	  var Req_before_decode=$(this).attr('data-pass-attr'); 
	  $('#hotel_change').css('display','none');
	//  alert(Req_before_decode); 
	  $.ajax({
      type:'json', 
      url: '<?php echo WEB_URL;?>package/getlowestprice_flight_byid/'+idVal+'/'+Req_before_decode,
      beforeSend: function(XMLHttpRequest){
        $('.flight_fliter_loader').fadeIn();
      }, 
      success: function(response) {
      	var res = jQuery.parseJSON(response);
      	if(res.ArivalDate!='')
      	{
      	//alert(res.ArivalDate); 
      	var a = ['Amedeus'];
        var i = 0;
        var k = 1;
		function nextCall() {
            var x = a.length;
            if (i == a.length) {
                $('.imgLoader').fadeOut(500, function(){
						$('body').css('overflow', '');
					});
                return;
            }
            var ArivalDate = res.ArivalDate;
            $.ajax({
                url: '<?php echo site_url(); ?>hotel/call_api/' + res.ArivalDate,
                data: { request: '<?php echo $hotelrequest; ?>'},
                dataType: "json",
                beforeSend: function () {
					
                   $("#hotel_loader").show();
                   // $('.imgLoader').fadeIn();
					//$('body').css('overflow', 'hidden');
                },
                success: function (data) {
                    $('.imgLoader').fadeOut(500, function(){
						$('body').css('overflow', '');
						 $("#hotel_loader").hide();
					});
                    if (parseInt(data.total_result) == 0) {
                        $('#noresult').fadeIn();
                    }
                    

                    $('#hotel_result').html(data.hotel_search_result);
                    $('#total_result_count').html(data.total_result_count);

                   
                   // Getting lowest  price from both

                    
                     var minVal = Math.floor(parseFloat($('#passportinfo11 #minnval').val()));         
                     var maxVal = Math.ceil(parseFloat($('#passportinfo11 #maxxval').val()));
                    $("#passportinfo11 #slider-range").slider({	
                        range: true,
                        min: minVal,
                        max: maxVal,
                        values: [minVal, maxVal],
                        slide: function (event, ui) {
                            $("#passportinfo11 #amount").val("<?php
							if (isset($_SESSION['currency']))
								echo $_SESSION['currency'];
							else
								echo BASE_CURRENCY;
							?> " + ui.values[ 0 ] + " - <?php
							if (isset($_SESSION['currency']))
								echo $_SESSION['currency'];
							else
								echo BASE_CURRENCY;
							?> " + ui.values[ 1 ]);
                        },
                        change: function (event, ui)
                        {
                            if (event.originalEvent) {
                                filterSearch();
                            }
                        }
                    });
                    $("#passportinfo11 #amount").val("<?php
									if (isset($_SESSION['currency']))
										echo $_SESSION['currency'];
									else
										echo BASE_CURRENCY;
										?> " + 
										$("#passportinfo11 #slider-range").slider("values", 0) + " - <?php
											if (isset($_SESSION['currency']))
												echo $_SESSION['currency'];
											else
												echo BASE_CURRENCY;
											?> " + $("#passportinfo11 #slider-range").slider("values", 1));
											
											

						
                    var InclusionString = '';
                    if( $.isArray(data.inclusion)) {
						for (var a = 0; a < data.inclusion.length; a++) {
							InclusionString += '<li><div class=\'squaredThree\'><input id=\'amnts' + a + '\' type=\'checkbox\' name=\'hotel_fac_val1\' checked=\'checked\' value=\"' + data.inclusion[a] + '"\' onclick=\'airlinncheck("")\' ><label for=\'amnts' + a + '\'></label></div><label class=\'lbllbl\' for=\'amnts' + a + '\'>' + data.inclusion[a] + '</label></li>';
						}
					}
                    $("#inclusions").html(InclusionString);
                    
                    var AmmenityString = '';
                    if( $.isArray(data.ammenity)) {
						for (var b = 0; b < data.ammenity.length; b++) {
							AmmenityString += '<li><div class=\'squaredThree\'><input id=\'hotelamnts' + b + '\' type=\'checkbox\' name=\'hotel_ammenity_val1\' checked=\'checked\' value=\"' + data.ammenity[b] + '"\' onclick=\'airlinncheck("")\' ><label for=\'hotelamnts' + b + '\'></label></div><label class=\'lbllbl\' for=\'hotelamnts' + b + '\'>' + data.ammenity[b] + '</label></li>';
						}
					}
                    $("#ammenities_info").html(AmmenityString);
					
				
					//Star count
                    var categoryCodeString = '';
                   var zero_star = 0;
                    var star_rating=0;
                    var one_star=0;
                    var two_star=0;
                    var three_star=0;
                    var four_star=0;
                    var five_star=0;
                    //alert(data.category.length);
                    if( $.isArray(data.category)) {
                    for (var a = 0; a < data.category.length; a++) {
						var star = data.category[a];
						
						//alert(star);
						if($.isNumeric(star[0])){
						 star_rating = star[0];
						 //alert(star_rating);
						}else{
							star_rating=0;
							}
						//star_rating = star_rating + 1;
						
							if(star_rating == 0) 
							zero_star = zero_star + 1;
							if(star_rating == 1) 
								one_star = one_star + 1;
							if(star_rating == 2) 
								two_star = two_star + 1;
								//alert(two_star);
								
							if(star_rating == 3) 
								three_star = three_star + 1;
							if(star_rating == 4) 
								four_star = four_star + 1;
							if(star_rating == 5) 
								five_star = five_star + 1;
					}
				}
					
					
					categoryCodeString = '<a id=\'check_star_rate1\' class=\'starone active\' onclick=\'filter_hotel_resultbystar1(1)\'><div class=\'starin\'> 1<span class=\'starfa fa fa-star\'></span><span class=\'htlcount\'>'+one_star+'</span></div></a><a id=\'check_star_rate2\' class=\'starone active\' onclick=\'filter_hotel_resultbystar1(2)\'><div class=\'starin\'> 2 <span class=\'starfa fa fa-star\'></span><span class=\'htlcount\'>'+two_star+'</span></div></a><a id=\'check_star_rate3\' class=\'starone active\' onclick=\'filter_hotel_resultbystar1(3)\'><div class=\'starin\'> 3 <span class=\'starfa fa fa-star\'></span><span class=\'htlcount\'>'+three_star+'</span></div></a><a id=\'check_star_rate4\' class=\'starone active\' onclick=\'filter_hotel_resultbystar1(4)\'><div class=\'starin\'> 4<span class=\'starfa fa fa-star\'></span><span class=\'htlcount\'>'+four_star+'</span></div></a><a id=\'check_star_rate5\' class=\'starone active\' onclick=\'filter_hotel_resultbystar1(5)\'><div class=\'starin\'>5<span class=\'starfa fa fa-star\'></span><span class=\'htlcount\'>'+five_star+'</span></div></a>';
					              
                    $("#categorystar").html(categoryCodeString);
					

                    i++;
                    nextCall(); 
                    
                    
                $.ajax({		
                url: '<?php echo site_url(); ?>package/getlowestprice_package/'+ArivalDate,
                data: { request: '<?php echo $hotelrequest; ?>'},
                dataType: "json",
                beforeSend: function () {
                  //  $(".nextpage").hide();
                  //  $('.imgLoader').fadeIn();
					//$('body').css('overflow', 'hidden');
                }, 
                success: function (res) {
					$('#lowest_hotel_price').html(res.hotel_search_result);
					console.log(res.hotel_search_result);
					
				}
			});
                    
                    
                }
                
            });
        }
        nextCall();
      	
      	
	}
      	
      	
      	
      	
      	//$('#hotel_result').html('');
      	//console.log($('#hotel_result').html(''));
      	//console.log(res.hotel_search_result);

       	$('#lowest_hotel_price').html(res.hotel_search_result);     
        $('.flight_fliter_loader').fadeOut();
         }
     });  

});




    
   $("#flight_count").html("<?php echo $flight_count; ?>");

   $('#airlines').addClass('in');
   $('#AirlineFilter').html('<?php if(isset($airline_data)) { $i=1;foreach($airline_data as $airline){?><li><div class="squaredThree"><input id="squaredThree<?php echo $i;?>" class="filter_airline" type="checkbox" name="airline" value="<?php echo $airline->airline;?>"><label for="squaredThree<?php echo $i;?>"></label></div><label class="lbllbl" for="squaredThree<?php echo $i;?>"><?php echo ucfirst($airline->airline);?></label></li><?php $i++; } }?>');  
</script>
