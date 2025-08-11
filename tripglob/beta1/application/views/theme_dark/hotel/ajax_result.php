<div id="mainDiv"><div class="carttoloadr"><strong>Confirming your hotel...</strong></div>
<?php 
function checkRemoteFile($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    // don't download content
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);
    curl_close($ch);
    if($result !== FALSE)
    {
        return true;
    }
    else
    {
        return false;
    }
}

    //echo '<pre>';print_r($photeldesc);exit();
	$findmaxmin=array();
	if(!empty($photeldesc)){
	for($i=0; $i< count($photeldesc); $i++) { 
     $totalcost=$photeldesc[$i]->low_cost;
     $markup=$photeldesc[$i]->markup;
     $totalamount=$totalcost+$markup;
    //debug();exit();
		// debug($photeldesc);exit;
		$hotel_code		=	$photeldesc[$i]->hotel_code;	
		$findmaxmin[$i]	=	$photeldesc[$i]->low_cost;	
		if(empty($photeldesc[$i]->URL)){
			$img= base_url().'assets/theme_dark/images/default_hotel.jpg';
		}else{
		   
			$img = $photeldesc[$i]->URL;
		}
		
		?>	
		<div class="rowresult" price='200'>
			<div class="madgrid">
				<div class="col-xs-12 nopad">
					<div class="sidenamedesc">
						<div class="celhtl width30 midlbord">
							<div class="hotel_image">
                <?php 
                $ext = pathinfo($img, PATHINFO_EXTENSION);?>
                               <?php if (empty($ext)) {
                                 echo'No image';
                               } else {?>
                                 <img src="<?php echo $img?>" alt="" />
                              <?php }
                                ?>               
                            	
                                <a class="hotel_location fa fa-map-marker"  lat="<?php echo ($photeldesc[$i]->Latitude);?>" lan="<?php echo ($photeldesc[$i]->Longitude);?>" nameattr="<?php echo ucwords(strtolower($photeldesc[$i]->HotelName)); ?>";  starattr="<?php echo $photeldesc[$i]->star_rating; ?>" data-toggle="modal" data-target="#map_view_hotel"></a>
                            </div>
						</div>
						<div class="celhtl width52">
							<div class="waymensn">
								<div class="flitruo_hotel">
									<div class="hoteldist">                                  
										<span class="hotel_name"><?php echo ucwords(strtolower($photeldesc[$i]->HotelName)); ?></span>
										 <div class="clearfix"></div>
											<div class="stra_hotel" data-star="<?php echo $photeldesc[$i]->star_rating; ?>">
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
											</div>	
											<span class="hotel_address elipsetool"><?php if(isset($photeldesc[$i]->AddressLine)){echo $photeldesc[$i]->AddressLine; } ?></span>
										<?php if(!empty($photeldesc[$i]->RoomRateDescription_Text)){ ?>	
										<div class="hotel_info"><?php echo (strlen($photeldesc[$i]->RoomRateDescription_Text) > 65) ? substr($photeldesc[$i]->RoomRateDescription_Text, 0,65) : $photeldesc[$i]->RoomRateDescription_Text;?></div>
										<?php } ?>
													
									</div>
								</div>
							</div>  
						</div>
                        <div class="celhtl width18">
							<div class="hotel_sideprice">
                                <div class="sideprice_hotel">
                                    <?= BASE_CURRENCY_ICON.' '.$totalamount; ?>
                                </div>                              
                                <div class="bookbtn_htl">
                                    <a class="booknow" href="<?php echo site_url(); ?>hotel/hotel_details/<?php echo base64_encode(json_encode($photeldesc[$i]->hotel_code)); ?>/<?php echo $ssid; ?>">Details</a>
                                </div>
                            </div>
                           
						</div>
					</div>
                </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php 
    } 
        $minval=min($findmaxmin);
     	$maxval=max($findmaxmin);
     	
    }
    else{ echo "<center> <h3> No Result Found. </h3><center>" ; } ?>
     <p style="color:red;"><?php echo (isset($links))?$links:''; ?></p>
    <?php #echo $this->ajax_pagination->create_links(); ?>
 </div>   
  <!--Map view indipendent hotel-->
<input type="hidden" id="minnval" name="minval" value="<?php echo $minval; ?>">
<input type="hidden" id="maxxval" name="maxval" value="<?php echo $maxval;  ?>">

<div id="map_view_hotel" class="modal fade" data-role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title hotel_map_single"></h4>
        <div class="stra_hotel hotel_star_rating" data-star="3">
			<span class="fa fa-star"></span>
			<span class="fa fa-star"></span>
			<span class="fa fa-star"></span>
			<span class="fa fa-star"></span>
			<span class="fa fa-star"></span>
		</div>
      </div>
      <div class="clearfix"></div>
      <div class="modal-body">
        <div class="map_hotel_pop" id="map1"></div>
      </div>
      <div class="clearfix"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 

<script>

$(document).ready(function(){
$('.hotel_location').click(function(){
var lat = $(this).attr('lat');
var longi = $(this).attr('lan');
var nameattr = $(this).attr('nameattr');
$('.hotel_map_single').html($(this).attr('nameattr'));
$('.hotel_star_rating').attr('data-star',$(this).attr('starattr'));
	setTimeout(function(){
		initialize(lat,longi,nameattr);
	},400);

});

function initialize(lat,longi,nameattr)
{
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
  // animation:google.maps.Animation.BOUNCE
  });

marker.setMap(map);
google.maps.event.addListener(marker, 'click', function() {
	infowindow.setContent(nameattr);
	infowindow.open(map, marker);

	});
}
//google.maps.event.addDomListener(window, 'load', initialize);
});
</script>
