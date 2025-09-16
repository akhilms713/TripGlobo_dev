<?php
$search_history = json_decode($search_history[0]->search_data);
//echo '<pre>';print_r($search_history);
//$search_history = $search_history->hotel_search;

//echo '<pre>';print_r($search_history);
// debug(array_column($RoomCombinations['RoomCombination'],'RoomIndex'));exit();

if(!empty($search_history->adult[1])){
  if(isset($search_history->adult[2])){
    $adult = $search_history->adult[0] + $search_history->adult[1] + $search_history->adult[2];
  }else{
    $adult = $search_history->adult[0] + $search_history->adult[1];
  }
}else{
  $adult = $search_history->adult[0];
}

if(!empty($search_history->child[1])){
  if(isset($search_history->child[2])){
    $child = $search_history->child[0] + $search_history->child[1] + $search_history->child[2];
  }else{
    $child = $search_history->child[0] + $search_history->child[1];
  }
}else{
  $child = $search_history->child[0];
}
$checkIn = date(strtotime($search_history->checkin));
$checkOut = date(strtotime($search_history->checkout));
$diffDate = abs($checkOut - $checkIn);
$NoOfNights = floor($diffDate/(60*60*24));
$NoOfRooms = $search_history->rooms;
$HotelCode = $hotel_details['HotelCode'];
$HotelName = $hotel_details['HotelName'];
$StarRating = $hotel_details['StarRating'];
$Address = $hotel_details['Address'];
$check_in = date('d M Y',strtotime($search_history->checkin));
$check_out = date('d M Y',strtotime($search_history->checkout));
?>


<style>
    .xxGHyP-dialog-view .uNGBb-dialog-view--content .BEIBcM-dialog-view--inner-content {
     height: 297px !important;
    overflow: auto !important;
}
</style>
<div class="dets_section">
	<div class="container">
 <!-- image slider -->
        <div class="col-xs-12 col-md-8" id="img-slider">
        	<div class="leftslider">
        	
              <div id="sync1" class="owl-carousel detowl">
                <?php foreach($hotel_details['Images'] as $k => $v){ ?>
                <div class="item">
                <div class="bighotl"><img src="<?php echo $v?>" alt="" /></div>
                </div>
                <?php } ?>
                </div>
            
                <div id="sync2" class="owl-carousel syncslide">
                <?php foreach($hotel_details['Images'] as $k => $v){ ?>
                <div class="item">
                <div class="thumbimg"><img src="<?php echo $v?>" alt="" /></div>
                </div>
                <?php } ?>
                </div>

            </div>
        </div>
        
        <div class="col-md-4 col-sm-6 col-xs-12 right_det">
            <div class="inside_detsy">
                <div class="dets_hotel">
                    <span class="hotel_name"><?php echo $hotel_details['HotelName'];?></span>
                    <div class="clearfix"></div>   
					<div class="stra_hotel" data-star="<?php echo $hotel_details['StarRating'];?>">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div> 
                    <span class="hotel_address elipsetool"><?php echo $hotel_details['Address'];?></span>                   
                               
                </div>             
                <p>Adult : <?=$adult?></p> 
                <?php if ($child!=0) {?>
                	
                <p>Child : <?=$child?></p>   
               <?php } ?>  
                <p>checkin : <?=$search_history->checkin?></p>   
                <p>checkout : <?=$search_history->checkout?></p>   
                <div class="clearfix"></div>               
                <div class="price_strts">
                    <div class="price_froms">starting from<strong><?=BASE_CURRENCY_ICON?> <?php  echo $starting_price; ?></strong></div>
                </div>               
                <div class="clearfix"></div>               
                <a class="room_select">Select Room</a>               
            </div>
        </div>
         
    </div>
</div>

<div class="down_hotel">
	<div class="container">
		<div class="col-md-8 col-xs-12 nopad">
    	<div class="col-xs-12 nopad">
        	<div class="shdoww">
            <div class="hotel_detailtab">
              <ul class="nav nav-tabs htl_bigtab">
                <li class="">
                	<a data-toggle="tab" href="#htldets"><span class="fa fa-info-circle"></span>Hotel Details</a>
                </li>
                <li class="active">
                	<a data-toggle="tab" href="#rooms"><span class="fa fa-building-o"></span>Rooms</a>
                </li>
                <li>
                	<a data-toggle="tab" href="#facility"><span class="fa fa-check-square-o"></span>Facilities</a>
                </li>

                <li>
                	<a data-toggle="tab" href="#map" id="hotel_location" lat="<?php echo $hotel_details['Latitude'];?>" lan="<?php echo $hotel_details['Longitude'];?>"  nameattr="<?php echo ucwords(strtolower($hotel_details['HotelName'])); ?>";><span class="fa fa-map-marker"></span>Map</a>
                </li>
              </ul>



              <div class="clearfix"></div>
              <div class="tab-content" id="hotel-tab-content">   
			<!-- tab content-->		
			
        	<?php 
	        $Hotel_room_image =	$img=str_replace("/B","",$hotel_details['Images']);
			if($hotel_image ==''){
				$Hotel_room_image = base_url().'assets/theme_dark/images/no_image.png';	
			} ?>
			<!-- Hotel Detail-->
                <div id="htldets" class="tab-pane">
                  <div class="innertabs">
                    <div class="comenhtlsum" id="description_hotel">
						<div class="detail_iamges"   style="float: left;margin-right: 20px;width: 100px;"> <img src="<?php echo $Hotel_room_image; ?>" alt="" style="width:100%;"> </div>
						<div class="detail_iamges_desc">
						<h4 class="dethtlname"><?php echo $hotel_details['HotelName'];?> </h4><h6><?php echo $hotel_details['Address'];?> </h6>
						 <div class="star_detail">
						
						  <div class="stra_hotel" data-star="<?php echo $hotel_details['StarRating'];?>">
							<span class="fa fa-star"></span>
							<span class="fa fa-star"></span>
							<span class="fa fa-star"></span>
							<span class="fa fa-star"></span>
							<span class="fa fa-star"></span>
						</div>
					</div>					
				</div>
			<div class="clearfix"></div>
			<div class="descriptnall"  style="margin: 20px 0 0;">
				<?php echo $hotel_details['Description'];?>
				</div>	
			</div>
            <div class="linebrk"></div>
             </div>
                </div>
                <!-- Hotel Detail End--> 
                <div class="clearfix"></div>
                <!-- Rooms-->
                <div id="rooms" class="tab-pane active">
                  <div class="innertabs">
					  <?php  	
                        $admin_markup 	= 0;
                        $NoOfRooms 		= $search_history->rooms;
                        $chkIn 			= date(strtotime($search_history->checkin));
                        $chkOut 		= date(strtotime($search_history->checkout));
                        $diffDate 		= abs($chkOut - $chkIn);
                        $nights 		= floor($diffDate/(60*60*24));
                        
					   ?>
					   <?php
					   foreach ($roomDetails as $key_s => $values) {
					                        
            unset($values['Price']);
					   	?>
					   <div class="htl_rumrow">
						
										
										<div class="mensionspl">Occupancy : <span class="menlbl"><?=$adult;?> Adult</span> , <?=$child;?> Child</div>
						<div class="hotel_list">
							<?php
							$totel_price =0; 
								foreach($values as $key => $value){ ?>
							<div class="col-md-9 col-sm-6 col-xs-12">
								<div class="row">				
									<div class="col-md-8  nopad">
										<div class="in_center_htl">
										 <div class="hotel_hed" style="font-size:15px;"><?=$value['RoomTypeName'];?> </div>
										<div class="mensionspl">CancellationPolicy : <br><span class="menlbl">											
											<?php
												// debug($value);exit();
											if (is_array($value['CancellationPolicies'][0])) {
												
											foreach($value['CancellationPolicies'] as $key_c => $CancellationPolicy){
												if ($CancellationPolicy['ChargeType'] == 2) {
													$ChargeType='Percentage';
												}elseif ($CancellationPolicy['ChargeType'] == 1) {
													$ChargeType='Amount';
												}else{
													$ChargeType='Nights';													
												}
												echo 'From now until the start date of travel '.str_replace('T', ' ', $CancellationPolicy['ToDate']).'  : '.$CancellationPolicy['Charge'] .' '.$ChargeType.' '.$CancellationPolicy['Currency'].' of expenses <br>';
											}
											}else{
												echo 'Non Refundable';
											}

											?> 
										</span> </div>
										<div class="clearfix"></div>
									</div>
									<div class="in_center_htl gridpos collapse in" id="roomcancellationdisplay<?=$key?>" aria-expanded="true"></div>
								</div>
								</div>
							</div>
						

						<div class="col-md-3 col-sm-6 col-xs-12 nopad">
						<div class="col-md-12 nopad bordrit">
							<div class="pricesec">

							
							</div>
						</div>
					</div>
					<?php
					   $RoomTypeCode[]=$value['RoomTypeCode'];
					   $RoomTypeName[]=$value['RoomTypeName'];
					   $RatePlanCode[]=$value['RatePlanCode'];
					 $totel_price += $value['Price']['PublishedPrice']; ?>
						<?php }
						 $user_id = $this->session->userdata('user_id');
            $user_type = $this->session->userdata('user_type');
            if ($user_type==1) {            	
            $generic_markup_B2B = $this->hotel_model->get_markup_B2B('GENERAL', $user_type); //B2B
            $agent_markup = $this->hotel_model->get_markup_B2B_agent($user_id); //B2B
            	if ($agent_markup=='') {
             $agent_markup = $this->hotel_model->get_markup_B2B_agent($user_id); //B2B
            	// code...
            }
            if ($generic_markup_B2B=='') {
            $generic_markup_B2B = $this->hotel_model->get_markup_B2B('GENERAL', $user_type); //B2B
            	// code...
            }
            }elseif ($user_type==4) {
            	$generic_markup_B2B = $this->hotel_model->get_markup_B2B('GENERAL', $user_type); 
            	if ($generic_markup_B2C=='') {
            $generic_markup_B2B = $this->hotel_model->get_markup_B2B('GENERAL', $user_type); 
            	// code...
            }
            }else{
            // $generic_markup_B2B = $this->get_markup_B2B('GENERAL', $user_type); //B2B
            $generic_markup_B2C = $this->hotel_model->get_markup_B2C('GENERAL', '2'); //B2C
            if ($generic_markup_B2C=='') {
            $generic_markup_B2C = $this->hotel_model->get_markup_B2C('GENERAL', '2'); //B2C
            	// code...
            }
            // debug($generic_markup_B2C);exit;

            }
            $agent_markup_price = 0;
            if ($user_type == 1 ||$user_type == 4) {
                if ($generic_markup_B2B != '') {
                    foreach ($generic_markup_B2B as $B2B_markup) {
                        if ($B2B_markup->user_id == $user_id) {
                            if (!empty($B2B_markup->markup_value)) {
                                $percentage = $B2B_markup->markup_value;
                                $generic_markup_price_B2B = PercentageToAmount($totel_price, $percentage);
                            } else {
                                $generic_markup_price_B2B = $generic_markup_B2B[0]->markup_fixed;
                            }
                        } elseif ($B2B_markup->user_id == 0) {

                            if (!empty($B2B_markup->markup_value)) {
                                $percentage = $B2B_markup->markup_value;
                                $generic_markup_price_B2B = PercentageToAmount($totel_price, $percentage);
                            } else {
                                $generic_markup_price_B2B = $generic_markup_B2B[0]->markup_fixed;
                            }
                        } else {
                            $generic_markup_price_B2B = 0;
                        }
                    }
                }
                if ($generic_markup_price_B2B != 0) {
                    $admin_markup = $generic_markup_price_B2B;
                }
                //agent markup 
                if ($agent_markup != "") {

                    if ($agent_markup[0]->markup_value_type == 'percentage') {
                        //   echo "d";
                        $percentage = $agent_markup[0]->markup;
                        $agent_markup_price = PercentageToAmount($totel_price+$admin_markup, $percentage);
                    } elseif ($agent_markup[0]->markup_value_type == 'fixed') {
                        $agent_markup_price = $agent_markup[0]->markup;
                    }
                } else {
                    $agent_markup_price = 0;
                }

                // echo $agent_markup_price;
                //agent markup ends
            } else {
 
                if ($generic_markup_B2C != NULL) {
                    if (!empty($generic_markup_B2C[0]->markup_value)) {
                        $percentage = $generic_markup_B2C[0]->markup_value;
                        $generic_markup_price = PercentageToAmount($totel_price, $percentage);
                    } else {
                        $generic_markup_price = $generic_markup_B2C[0]->markup_fixed;
                    }
                } else {
                    $generic_markup_price = 0;
                }

                if ($generic_markup_price != 0) {
                    $admin_markup = $generic_markup_price;
                } else {
                    $admin_markup = 0;
                }
            }
            // debug($admin_markup);exit();
						 ?>

							<div class="sideprice">  <?=BASE_CURRENCY_ICON?> <?php echo (($totel_price) + $admin_markup+$agent_markup_price);?><span class="avgper"></span> </div>
								<form action="<?=base_url();?>hotel/add_cart" method="post" target="_blank" id="hotel_booking">
									<input type="hidden" name="roomRequest" value="<?php echo base64_encode(json_encode($roomRequest));?>">
                            		<input type="hidden" name="HotelName" value="<?php echo base64_encode(json_encode($HotelName));?>">
                            		<input type="hidden" name="HotelCode" value="<?php echo base64_encode(json_encode($HotelCode));?>">
                            		<input type="hidden" name="NoOfRooms" value="<?php echo base64_encode(json_encode($NoOfRooms));?>">
                            		<input type="hidden" name="RoomIndex" value="<?php echo base64_encode(json_encode($value['RoomIndex']));?>">
                            		<input type="hidden" name="RoomTypeCode" value="<?php echo base64_encode(json_encode($RoomTypeCode));?>">
                            		<input type="hidden" name="RoomTypeName" value="<?php echo base64_encode(json_encode($RoomTypeName));?>">
                            		<input type="hidden" name="RatePlanCode" value="<?php echo base64_encode(json_encode($RatePlanCode));?>">
                            		<input type="hidden" name="SmokingPreference" value="<?php echo base64_encode(json_encode($value['SmokingPreference']));?>">
                            		<input type="hidden" name="search_id" value="<?php echo base64_encode(json_encode($search_id));?>">
                            		<input type="hidden" name="session_id" value="<?php echo base64_encode(json_encode($session_id));?>">
                            		<input type="hidden" name="room_price" value="<?php echo base64_encode(json_encode($totel_price + $admin_markup+$agent_markup_price));?>">
                            		<input type="hidden" name="admin_markup" value="<?php echo base64_encode(json_encode($admin_markup));?>">
                            		<input type="hidden" name="agent_markup_price" value="<?php echo base64_encode(json_encode($agent_markup_price));?>">
                            		<input type="hidden" name="room_details" value="<?php echo base64_encode(json_encode($values));?>">
                                    <input type="hidden" name="CancellationPolicies" value="<?php echo base64_encode(json_encode(array_column($values,'CancellationPolicies')));?>">
                            		<input type="hidden" name="api_id" value="<?php echo base64_encode(json_encode($api_id));?>">
                            		
									<div class="bookbtn"> <a form_id="hotel_booking" class="booknow">Book</a> </div>
								</form>
				</div>
							

				</div>
                    <?php }
                    ?>
				</div>
                </div>                
				<div id="facility" class="tab-pane">
					<div class="innertabs">
						<div class="comenhtlsum">
						<?php $HotelFacilities = $hotel_details['HotelFacilities'];
							if(empty($Hotel_room[0])){  ?>
								<div class="comenhtlsum">  Note:- Some(<span class="fa fa-money" style="color:#FF16E0"></span>) services shall be paid at the establishment. </div>
							<?php } ?>
						</div>	
						<div class="linebrk"></div>
						<div class="hotel_dlts nopad">
							<ul class="checklist" >
							<?php for($i=0; $i<count($HotelFacilities); $i++) { 
							  if($HotelFacilities[$i]!='' && $HotelFacilities[$i]!=='.'){ ?>
							  <li><span class="spanfaci" style="display:flex;"> <span class="fa fa-check-square-o"></span> <span><?php echo $HotelFacilities[$i]; ?><span><span></li>
							<?php }  } ?>
							</ul>                                             
						</div>
                       
					</div>
				</div>
			<!-- Facilities End--> 
			 <!-- Reviews-->
			 <div id="map" class="tab-pane">
				 <div class="map_hotel_pop" id="map1"></div>
			</div>
			 <div id="mapintegration" class="tab-pane">
				<div class="innertabs">
					<div class="comenhtlsum">
					</div>
				</div>
				</div>	            
              </div>
            </div>
          </div>
        </div>
        </div>

        <div class="col-md-4 col-xs-12 nopad">

        <div class="col-md-12 col-sm-12 col-xs-12 nopad">
        	<div class="contact_hotel">
            	<h3 class="head_hotel">Contact Hotel</h3>
                <div class="inside_contact">
                	<div class="row_contact">
                    	<!--<span class="fa fa-phone"></span>-->
                    	<?php// echo "<pre>"; print_r($hotel_details['PinCode']); ?>
                    	<p>Address: <?php echo $hotel_details['Address'];?></p>
                    	<!--<p>Country Name: <?php echo $hotel_details['CountryName'];?></p>-->
                    	<!--<p>Pincode: <?php echo $hotel_details['PinCode'];?></p>-->
                    	<!--<p>Contact No: <?php echo $hotel_details['HotelContactNo'];?></p>-->
                    	
                    	
                        <!--<strong class="roboto"><?php  if(!empty($PhoneNumber)){ echo $PhoneNumber; }else{ echo "Not Available.";} ?></strong>-->
                    </div>
                    <div class="clearfix"></div>
                    <div class="row_contact">
                    	<!--<span class="fa fa-envelope"></span>-->
                    	<!--<p>Fax Number: <?php echo $hotel_details['FaxNumber'];?></p>-->
                    	<!--<p>Email: <?php echo $hotel_details['Email'];?></p>-->
                        <!--<strong><?php if(!empty($AddressLine)){echo $AddressLine; }else{ echo "Not Available.";}?></strong>-->
                    </div>
                    <div class="clearfix"></div>
                    <div class="map_contact" id="map_contact">
                    	<div class="row_contact">
                            <span class="fa fa-map-marker"></span>
                            <input type="hidden" value="<?php echo $hotel_details['Latitude'];?>" id="latitude">
                            <input type="hidden" value="<?php echo $hotel_details['Longitude'];?>" id="langitude">
                            <input type="hidden" value="<?php echo ucwords(strtolower($hotel_details['HotelName'])); ?>" id="hotelName">
                            <strong><?php  echo $hoteladdress; ?><br><?php  echo $CityName.',',$PostalCode; ?></strong>
                        </div>
                    </div>
   <!--                 <div id="" class="tab-pane">-->
			<!--	 <div class="map_hotel_pop" id="google_maps1"></div>-->
			<!--</div>-->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php 
	        function PercentageToAmount($total, $percentage) {

        $amount = ($percentage / 100) * $total;
        $perc_amount = $amount;

        //echo "percamounta".$perc_amount;exit();
        return $perc_amount;
    }
 
?>
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPzuJwLpObYaPJc4Pujh4pPZWZlarWUkc&sensor=true" type="text/javascript"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJfvWH36KY3rrRfopWstNfduF5-OzoywY&sensor=true" type="text/javascript"></script>
<script>
function view_hotel_map() {
	$('#hotel_location').trigger('click');
}
$('#hotel_location').click(function(){
	var lat = $(this).attr('lat');
	var longi = $(this).attr('lan');
	var nameattr = $(this).attr('nameattr');
		setTimeout(function(){
			initialize(lat,longi,nameattr);
		},400);
});
function initialize(lat,longi,nameattr){
	var myCenter=new google.maps.LatLng(lat, longi);
	var marker;
	var mapProp = {
		center:myCenter,
		zoom:16,
		mapTypeId:google.maps.MapTypeId.ROADMAP
	};
	var infowindow = new google.maps.InfoWindow();
	var map=new google.maps.Map(document.getElementById("map1"),mapProp);
	var marker=new google.maps.Marker({
	  position:myCenter,
	  //animation:google.maps.Animation.BOUNCE
	  });
	marker.setMap(map);
	google.maps.event.addListener(marker, 'click', function() {
		infowindow.setContent(nameattr);
		infowindow.open(map, marker);
	});
}

$('.room_select').click(function(){
	$('a[href="#rooms"]').trigger('click');
});
</script>
<script>
	$(document).ready(function(){
	var sync1 = $("#sync1");
      var sync2 = $("#sync2");

      sync1.owlCarousel({
        singleItem : true,
        slideSpeed : 1000,
        navigation: true,
        pagination:false,
        afterAction : syncPosition,
        responsiveRefreshRate : 200,
      });

      sync2.owlCarousel({
        items : 4,
        itemsDesktop      : [1199,4],
        itemsDesktopSmall     : [979,4],
        itemsTablet       : [768,4],
        itemsMobile       : [479,2],
        pagination:false,
        responsiveRefreshRate : 100,
        afterInit : function(el){
          el.find(".owl-item").eq(0).addClass("synced");
        }
      });

      function syncPosition(el){
        var current = this.currentItem;
        $("#sync2")
          .find(".owl-item")
          .removeClass("synced")
          .eq(current)
          .addClass("synced")
        if($("#sync2").data("owlCarousel") !== undefined){
          center(current)
        }

      }

      $("#sync2").on("click", ".owl-item", function(e){
        e.preventDefault();
        var number = $(this).data("owlItem");
        sync1.trigger("owl.goTo",number);
      });

      function center(number){
        var sync2visible = sync2.data("owlCarousel").owl.visibleItems;

        var num = number;
        var found = false;
        for(var i in sync2visible){
          if(num === sync2visible[i]){
            var found = true;
          }
        }

        if(found===false){
          if(num>sync2visible[sync2visible.length-1]){
            sync2.trigger("owl.goTo", num - sync2visible.length+2)
          }else{
            if(num - 1 === -1){
              num = 0;
            }
            sync2.trigger("owl.goTo", num);
          }
        } else if(num === sync2visible[sync2visible.length-1]){
          sync2.trigger("owl.goTo", sync2visible[1])
        } else if(num === sync2visible[0]){
          sync2.trigger("owl.goTo", num-1)
        }
      }
	});	 
	
</script>
<script>
function room_cancellation(appid,hotelcode,room_cost) {
	
	 var room_data = {
            temp_appid:appid,
            hotel_code:hotelcode,
           total_room_cost:room_cost
        };
  	
		$.ajax({
			type	: "POST",
			url		: '<?php echo site_url(); ?>hotel/get_calcellation',
			data	: room_data,
			dataType: "json",			
			beforeSend : function(){
				$('.cancel_policy_loader').fadeIn();
			},
			success: function(data){
				$('.cancel_policy_loader').fadeOut();
				console.log(data.cancellation_policy);
				if(data.cancellation_policy == null || data.cancellation_policy ==""){
				$('#roomcancellationdisplay'+appid).html('<div class="dowside_book_info"><div class="each_can"><span class="can_hed">Cancellation policy</span><p></p><p>(*)Date and Time Depends on Hotel Destination..</p></div></div>');
				}else{
				$('#roomcancellationdisplay'+appid).html('<div class="dowside_book_info"><div class="each_can"><span class="can_hed">Cancellation policy</span><p></p><p>(*)'+data.cancellation_policy+'.</p></div></div>');
				//alert(data.cancellation_policy);
			}
			}			
		});			
}
$('.room_select').click(function(){
var topmove = $('.room_select').offset().top;
$('html, body').animate({scrollTop: topmove}, 500);
});
 $(document).ready(function(){
	$('.booknow').click(function(){ 
	 //alert($(this).attr('form_id'));
	 var id =$(this).attr('form_id');
	 		$.ajax({
			type	: "POST",
			url		: $('#' + id).attr('action'),
			data	: $('#' + id).serialize(),
			dataType: "json",
			beforeSend : function(){
				$('.flight_book_loader').fadeIn();
			},
			success: function(data){
				$('.flight_book_loader').fadeOut();
			//alert(data);
				if(data.isCart == false){
					alert('error')
				}else{
					if(data.cart_status == 1){
							console.log('ajaxsuccess');
							window.location.href = data.C_URL;
					}else{
						console.log('ajaxsuccesserror');
						alert(data.error);
					}
				}
			}			
		});	
	 
	 });
 });
</script>

<script>
     $(document).ready(function(){
          var lat=$("#latitude").val();
          var longi=$("#langitude").val();
          var nameattr=$("#hotelName").val();
         
		setTimeout(function(){
			initialization(lat,longi,nameattr);
		},400);

function initialization(lat,longi,nameattr){
  //  alert(nameattr);
	var myCenter=new google.maps.LatLng(lat, longi);
	var marker;
	var mapProp = {
		center:myCenter,
		zoom:16,
		mapTypeId:google.maps.MapTypeId.ROADMAP
	};
	var infowindow = new google.maps.InfoWindow();
	var map=new google.maps.Map(document.getElementById("map_contact"),mapProp);
	var marker=new google.maps.Marker({
	  position:myCenter,
	  //animation:google.maps.Animation.BOUNCE
	  });
	marker.setMap(map);
	google.maps.event.addListener(marker, 'click', function() {
		infowindow.setContent(nameattr);
		infowindow.open(map, marker);
		
	});

}




     });
</script>
