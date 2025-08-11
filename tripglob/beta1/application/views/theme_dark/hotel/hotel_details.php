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
<link href="<?php echo ASSETS; ?>css/hotel_result.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>css/hotel_detail.css" rel="stylesheet">
</head>
<body>
<!-- Navigation -->
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
<!-- Header Carousel -->
<div class="allpagewrp top80">

<div class="hotel_discriptive_content" id="hotel_discriptive_content"></div>
<div class="carttoloadr flight_fliter_loader"> <br><strong>Processing your Request...</strong></div> 
<div class="carttoloadr flight_book_loader"><strong>Confirming your Room...</strong></div>
<div class="carttoloadr cancel_policy_loader"><strong>Loading..</strong></div>
</div>

<!-- Page Content -->
<?php $hotel_code = base64_encode(json_encode($hotel_code)); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>
<script src="<?php echo ASSETS; ?>js/jquery.nicescroll.js" type="text/javascript"></script>

<!-- Script to Activate the Carousel --> 
<script type="text/javascript">
function view_hotel_map() {
$('#hotel_location').trigger('click');
}
$(document).ready(function(){
	
			$.ajax({
				type: 'POST',
				async: true,
				dataType: 'json',
				data: { hotel_code: '<?php echo $hotel_code; ?>',session_id : '<?php echo $session_id; ?>'},
				url: '<?php echo site_url(); ?>hotel/get_room_details/',
			beforeSend: function () {
				$(".nextpage").hide();
				$('.flight_fliter_loader').fadeIn();
			},
			success: function (data) {
				$('.flight_fliter_loader').fadeOut();
				$('#hotel_discriptive_content').html(data.hotel_description_result);

			}

			});
	
});
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
</script>
</body>
</html>
