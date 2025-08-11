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
</head>
<body>


<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>


<!-- Header Carousel -->
<div class="allpagewrp top80">
<?php if($bundle_search_id==0){ ?>
	<div class="newmodify">
		<div class="container">
			<div class="contentsdw">
				<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 nopad">
					<div class="pad_ten">
						<div class="left_icon sprite marker_icon"></div>
						<div class="from_to_place">
							<?php //$city = explode(', ', $request_data['city']); ?>
							<h4 class="placename"><?php echo $request_data['city'] ?></h4>
							<h3 class="contryname"><?php echo $request_data['country']; ?> </h3>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-xs-6 hidden-sm hidden-xs nopad">
					<div class="col-xs-6 nopad">
						<div class="pad_ten">
							<div class="left_icon sprite calendar_icon"></div>
							<div class="from_to_place">
								<div class="boxlabl">Check-in</div>
								<div class="datein">
									<span class="calinn"> <?php echo date('M d,Y' , strtotime($request_data['hotel_checkin'])); ?> </span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-6 nopad ">
						<div class="pad_ten">
							<div class="left_icon sprite calendar_icon"></div>
							<div class="from_to_place">
								<div class="boxlabl">Check-out</div>
								<div class="datein">
									<?php echo date('M d,Y' , strtotime($request_data['hotel_checkout'])); ?><span class="calinn">  </span>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-lg-2 hidden-md hidden-sm hidden-xs nopad">
					<div class="pad_ten">
						<div class="left_icon sprite pasnger_icon"></div>
						<div class="from_to_place">
							<div class="boxlabl textcentr"><strong><?php echo array_sum($request_data['adult'])+array_sum($request_data['child']); ?></strong>Passenger(s)</div>
                            <div class="boxlabl textcentr"><strong><?php echo $request_data['rooms']; ?></strong>Room(s)</div>
							
						</div>
					</div>
				</div>
                
				<div class="col-md-2 col-sm-4 col-xs-4 nopad">
					<div class="pad_ten">
						<button class="modifysrch" data-toggle="collapse" data-target="#modify"><strong>Modify</strong> <span class="down_caret"></span></button>
					</div>
				</div>
				
			</div>
	</div>
</div>
<?php } ?>
<div class="clearfix"></div>
<input type="hidden" id="bundle_search_id" value="<?=@$bundle_search_id?>">
<input type="hidden" id="single_search_id" value="<?=@$search_id?>">
<input type="hidden" id="request_data" value="<?=base64_encode(json_encode($request_data))?>">
<input type="hidden" id="ssid" value="<?=base64_encode(json_encode($ssid))?>">
<div class="modify_search_wrap">
<div class="container">
		<div id="modify" class="collapse">
		    
				<?php 
				//   echo "<pre/>";print_r($ssid);
				$data['product'] 	= 'Hotel';
				$data['city']		= $request_data['city'];
				$data['country']    = $request_data['country'];
				$data['check_in']	= $request_data['hotel_checkin'];
				$data['check_out']	= $request_data['hotel_checkout'];
				$data['rooms']		= $request_data['rooms'];
				$data['adult']		= $request_data['adult'];
				$data['child']		= $request_data['child'];
				
				// echo "<pre>"; print_r($data);
				function get_date_difference($date1, $date2)
                {
                    // echo 'here';exit;
                	$date1 = strtotime($date1);
                	$date2 = strtotime($date2);
                	return floor(($date2-$date1)/(60*60*24));
                }
				
				$no_of_days = intval(get_date_difference(@$request_data['hotel_checkin'], @$request_data['hotel_checkout']));
				$data['no_of_nights'] = $no_of_days;
				if(isset($request_data['childAge_1'])){
					if(@$request_data['childAge_1']){
						$data['childAges'] =$request_data['childAge_1'];
					}else{
						$data['childAges'] = array();
					}
				}else{
					$data['childAges'] = array();
				}
			
				
				 //echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/hotel_search', $data);
		    	//echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/flight_search');
			    echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/hotel_search',$data);
   
				?>
				 
   
		</div>
</div>
</div>

<div class="clearfix"></div>
<div class="contentsec margtop">
	<div class="container">
		<div class="filtrsrch">
			<div class="col30">
				<div class="celsrch">
				<button class="close_filter"><span class="fa fa-close"></span></button>
					<div class="boxtop">
						<div class="filtersho">
							<div class="avlhtls"><strong><span id="total_result_count">10</span></strong> Hotels found<span class="placenamefil"><?php echo $request_data['city']; ?></span></div>
						</div>
						<input type="reset" name="reset" id="reset" value="Reset" class="btn btn-primary" style="float:right">
					</div>
					<div class="norfilterr">
						<div class="outbnd">
							<div class="rangebox">
								<div class="ranghead">Hotel Name</div>
								<div id="" class="stoprow">
									<div class="boxins">
										<input type="text" id="hotel_namefilter" class="filter_input" placeholder="Type hotel name" /> 
									</div>
								</div>
							</div>
							<div class="rangebox">
								<div class="ranghead">Price</div>
								<div class="price_slider1">
									<input type="text"  class="level" id="amount" readonly >
									<div id="slider-range"></div>
								</div>
							</div>
							<div class="rangebox">
								<div class="ranghead">Star Rating</div>
								<div id="dep_time" class="stoprow">

									<div class="boxins marret padlow hotel_star_filter">
										<div class="clearfix"></div>
										<div class="relatboxsone" id="hotel_star_tbo">
                                            <div id="categorystar"></div>

										</div>
									</div>
								</div>
							</div>
							<!--<div class="rangebox">
								<div class="ranghead">Accommodation Type</div>
								<div id="airlines" class="stoprow">
									<div class="boxins">
										<ul class="locationul" id="accommodations">
                                        	
                                        </ul>
									</div>
								</div>
							</div>-->
							</div>
					</div>
				</div>
            </div>
            
            <div class="col70">
            	<div class="in70">   				
                    
                	<div class="topmisty hote_reslts">
                    	<div class="col-xs-12 nopad">
                        	<button class="filter_show"><span class="fa fa-filter"></span></button>
                            <div class="insidemyt">
                                <div class="col-xs-8  fullshort nopad">
                                    <ul class="sortul">
                                        <li class="sortli">
                                          <span class="sirticon fa fa-sort-amount-asc"></span>
                                          <a class="sorta" type='depature_time' id="HotelName" val='asc'>Hotel Name</a>
                                        </li>
                                         <li class="sortli">
                                          <span class="sirticon fa fa-tag"></span>
                                          <a class="sorta active des" type='depature_time' id="total_cost" val='asc'>Price</a>
                                        </li>
                                         <li class="sortli">
                                          <span class="sirticon fa fa-star-o"></span>
                                          <a class="sorta" type='depature_time' id="star_rating" val='asc'>Star Rating</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xs-4 noviews nopad">
                                	<div class="rit_view">
                                    	<a class="view_type active"><span class="fa fa-list"></span> 
                                    	<strong>List</strong></a>
                                        <a class="view_type map_all" data-toggle="modal" data-target="#map_view_hotelall"><span class="fa fa-map"></span>	<strong>Map</strong></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--All Available flight result comes here -->
                  
                    <div class="allresult">
                    
						<?php echo $this->load->view(PROJECT_THEME.'/hotel/hotel_result_loader'); ?>
						
                      <input type="hidden" value="" id='session_id'>
                      
                      <div class="lodrefrentrev flight_fliter_loader"> </div>
                       
                     <div class="flights" id="hotel_result">
						
                     </div>
                	<div id="empty_tour_search_result"  style="display:none">
						<div class="noresultfnd">
							<div class="imagenofnd text-center"><img src="<?=base_url().'assets/theme_dark/images/empty.jpg';?>" alt="Empty" /></div>
							<div class="lablfnd text-center">No Result Found!!!</div>
						</div>
					</div>
                    </div>
                    <!-- End of result -->
                  
                </div>
            </div>
            
        </div>
        
    </div>
</div>

</div>

<div id="map_view_hotelall" class="modal fade" data-role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="clearfix"></div>
      <div class="modal-body">
        <div class="map_hotel_pop" id="mapall"></div>
      </div>
      <div class="clearfix"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    <?php
        $currentURL = current_url(); //http://myhost/main
        $params   = $_SERVER['QUERY_STRING']; //my_id=1,3
        $fullURL = $currentURL . '?' . $params;
    ?>
<!-- Page Content -->

<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJfvWH36KY3rrRfopWstNfduF5-OzoywY&sensor=true" type="text/javascript"></script>
<?php $city_data_enc = base64_encode(json_encode($city_data)); ?>
<?php $request_data_enc = base64_encode(json_encode($request_data)); ?>


<!-- Script to Activate the Carousel --> 
<script type="text/javascript">
/*  $origin_code ;
  $origin_name ;
  $destination_code  ;
  $destination_name ;*/

$(document).ready(function(){
// alert();

  $(".filter_depart").prop('checked', false);
  $(".filter_return").prop('checked', false);
//Before the AJAX function runs



var start = new Date().getTime(),
    difference;
    // var a = ['Amedeus'];
    var a = ['TBO'];
        var i = 0;
        var k = 1;
		function nextCall() {
			// alert("rahul");
            var x = a.length;
            if (i == a.length) {
                $('.imgLoader').fadeOut(500, function(){
						$('body').css('overflow', '');
					});
                return;
            }
            
            $.ajax({
                url: '<?php echo site_url(); ?>hotel/call_api/' + a[i],
                data: { request: '<?php echo $request_data_enc; ?>',page:<?= (isset($_GET['page']))?$_GET['page']:0 ?>},
                dataType: "json",
                beforeSend: function () {
                    $(".nextpage").hide();
                    $('.imgLoader').fadeIn();
					$('body').css('overflow', 'hidden');
                },
                success: function (data) { 
                    // alert('hello');
                    console.log(data);
                    $('.imgLoader').fadeOut(100, function(){
						$('body').css('overflow', '');
					});
                    if (parseInt(data.total_result) == 0) {
                        $('#noresult').fadeIn();
                    }
                    $('#hotel_result').html(data.hotel_search_result);
                    //$('#accommodations').html(data.accommodation_html);
                    $('#dep_time').append(data.star_rating_checkhtml);
                    $('#hotel_star_tbo').append(data.star_rating_html);
                    $('#total_result_count').html(data.total_result_count);
                   	// $('#min_price').html(data.min_val);
                    
                     var minVal = Math.floor(parseFloat($('#minnval').val()));         
                     var maxVal = Math.ceil(parseFloat($('#maxxval').val()));
                    $("#slider-range").slider({	
                        range: true,
                        // min: minVal,
                        min: minVal,
                        max: maxVal,
                        values: [0, maxVal],
                        // values: [minVal, maxVal],
                        slide: function (event, ui) {
                            $("#amount").val("<?php
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
                    $("#amount").val("<?php
									if (isset($_SESSION['currency']))
										echo $_SESSION['currency'];
									else
										echo BASE_CURRENCY;
										?> " + 
										$("#slider-range").slider("values", 0) + " - <?php
											if (isset($_SESSION['currency']))
												echo $_SESSION['currency'];
											else
												echo BASE_CURRENCY;
											?> " + $("#slider-range").slider("values", 1));
						
					
				
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
					
					
					categoryCodeString = '<a id=\'check_star_rate1\' class=\'starone\' ><div class=\'starin\' data-val=\'1\'> 1<span class=\'starfa fa fa-star\'></span><span class=\'htlcount\'>'+one_star+'</span></div></a><a id=\'check_star_rate2\' class=\'starone\' ><div class=\'starin\' data-val=\'2\'> 2 <span class=\'starfa fa fa-star\'></span><span class=\'htlcount\'>'+two_star+'</span></div></a><a id=\'check_star_rate3\' class=\'starone\' ><div class=\'starin\' data-val=\'3\'> 3 <span class=\'starfa fa fa-star\'></span><span class=\'htlcount\'>'+three_star+'</span></div></a><a id=\'check_star_rate4\' class=\'starone\' ><div class=\'starin\' data-val=\'4\'> 4<span class=\'starfa fa fa-star\'></span><span class=\'htlcount\'>'+four_star+'</span></div></a><a id=\'check_star_rate5\' class=\'starone\' ><div class=\'starin\' data-val=\'5\'>5<span class=\'starfa fa fa-star\'></span><span class=\'htlcount\'>'+five_star+'</span></div></a>';
					              
                    $("#categorystar").html(categoryCodeString);
					

                    i++;
                    nextCall(); 
                }
                
            });
        }
        nextCall();


$(document).on("click",".starin",function() {

    var checked_rating = [];
    var popped_rating = [];
    $('.starone').each(function(key, value) {
        if($(this).attr('class') == 'starone active')
            checked_rating.push($(this).find('.starin').attr('data-val'));
    });

    if($(this).parent().attr('class') == 'starone active'){
        $(this).parent().removeClass('active');
        var check_rating = $(this).attr('data-val');
        if(jQuery.inArray(check_rating, checked_rating) != -1){
            checked_rating = jQuery.grep(checked_rating, function(value) {
                return value != check_rating;
            });

            popped_rating.push(check_rating);

        }

        $('.madgrid').each(function(key, value) {
            var rating = $(this).find('.stra_hotel').attr('data-star');
            if(popped_rating.length>0 && checked_rating.length>0){
                if(jQuery.inArray(rating, popped_rating) != -1)
                    $(this).addClass('hide');
                	
            }
            else{
                if(rating != check_rating && jQuery.inArray(rating, checked_rating) == -1)
                    $(this).removeClass('hide');
                	
            }

        });
    }
    else{
        $(this).parent().addClass('active');
        var check_rating = $(this).attr('data-val');
        $('.madgrid').each(function(key, value) {
            var rating = $(this).find('.stra_hotel').attr('data-star');

            if(rating != check_rating && jQuery.inArray(rating, checked_rating) == -1){

                    $(this).addClass('hide');
                   
            }
            if(rating == check_rating){
                if($(this).attr('class') == 'madgrid hide'){
                    $(this).removeClass('hide');
                   
                }
            }

        });
    }
    var show_count=0;
    var hide_count =0;
    $(".rowresult .madgrid").each(function(){
    	if(!$(this).hasClass('hide')){
    		show_count = show_count+1;	
    	}
    });
    $("#total_result_count").html(show_count);
    if(show_count==0){
    	$("#empty_tour_search_result").show();
    }else{
    	$("#empty_tour_search_result").hide();
    }
});
 
$(document).on("click",".filter_airline",function() {
  filter();
});

$(document).on("keyup","#hotel_namefilter",function() {
  filter();
});

$(".sorta").click(function(){

    var val = $(this).attr('val');
    $(".sorta").each(function(){

      if ($(this).attr('class').match(/active|des/)) 
      {
        $(this).removeClass("active des");
      } 
      if ($(this).attr('class').match(/active|ase/)) 
      {
        $(this).removeClass("active ase");
      } 

    });
    //$(this).addClass('active des');
    if( val == 'desc')
    {
		$(this).addClass('active des');
        $(this).attr('val' ,'asc');
    }
    else
    {
		$(this).addClass('active ase');
      $(this).attr('val',"desc");
    }
    filter();

  });



$(document).on("click",".filter_accommodation",function() {
  filter();
});
$(document).on("click",".filter_ammenity",function() {
  filter();
});


$(document).on("click","#reset",function() {
	var bundle_search_id = $("#bundle_search_id").val();
    var single_search_id = $("#single_search_id").val();
    var request_data  = $("#request_data").val();
    var ssid  = $("#ssid").val();
	var data = {};	
    $.ajax({
		type:'POST', 
		url: WEB_URL+'hotel/ajaxfilter?<?= $_SERVER['QUERY_STRING'] ?>',
		data: { filter: JSON.stringify(data),Bsearch_id:bundle_search_id,Ssearch_id:single_search_id,RequestData:request_data,ssid:ssid },
		beforeSend: function(XMLHttpRequest){
		  $('.flight_fliter_loader').fadeIn();
		  }, 
		  success: function(response) {
			$('.flight_fliter_loader').fadeOut();
			var ss= JSON.parse(response);//jQuery.parseJSON(response);
			$('#mainDiv').html(ss.hotel_search_result);
			$('#hotel_namefilter').val('');
			$('.star_rating').removeClass('active');
			$(".starone").removeClass('active');
			$('.filter_airline').prop('checked',false);
			$('#total_cost').val('asc');
			$('#total_cost').removeClass('ase');
			$('#star_rating, #HotelName').removeClass('ase');
			$('#star_rating, #HotelName').removeClass('des');
			$('#total_cost').addClass('des');
			$('#total_result_count').html(ss.total_result_count);
			window.scrollTo(500, 10);
			var minVal = Math.floor(parseFloat(ss.min_val));         
			var maxVal = Math.ceil(parseFloat(ss.max_val));
			$("#slider-range").slider({	
				range: true,
				min: minVal,
				max: maxVal,
				values: [minVal, maxVal],
				slide: function (event, ui) {
					$("#amount").val("<?php
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
			
			 $("#amount").val("<?php
			if (isset($_SESSION['currency']))
				echo $_SESSION['currency'];
			else
				echo BASE_CURRENCY;
				?> " + 
				$("#slider-range").slider("values", 0) + " - <?php
					if (isset($_SESSION['currency']))
						echo $_SESSION['currency'];
					else
						echo BASE_CURRENCY;
					?> " + $("#slider-range").slider("values", 1));
		  }
    });
});

function filter()
{
   var sorting_type ;
   var sorting_value;
   $(".sorta").each(function(){
      if ($(this).attr('class').match(/active|des/)) 
      {
          sorting_type = $(this).attr('id');
          sorting_value = $(this).attr('val');
      } 
    });

    var data = {};
    var sort = {};
    var facilities = [];
    var star = [];

    data['amount'] = $("#amount").val();
    data['hotel_name'] = $("#hotel_namefilter").val();
    sort['column'] = sorting_type;
    sort['value'] = sorting_value;
    data['sort'] = sort;
    //data['request'] = requeststring;
    //data['api_id'] = api_id;

    $(".starone").each(function() {
	if($(this).hasClass( "active" ))
	{	
        star.push($(this).children("div").attr("data-val"));
	}
    });
    

    data['starrate'] = star;
    var bundle_search_id = $("#bundle_search_id").val();
    var single_search_id = $("#single_search_id").val();
    var request_data  = $("#request_data").val();
    var ssid  = $("#ssid").val();
    $.ajax({
    type:'POST', 
    url: WEB_URL+'hotel/ajaxfilter?<?= $_SERVER['QUERY_STRING'] ?>',
    data: { filter: JSON.stringify(data),Bsearch_id:bundle_search_id,Ssearch_id:single_search_id,RequestData:request_data,ssid : ssid},
    beforeSend: function(XMLHttpRequest){
      $('.flight_fliter_loader').fadeIn();
      }, 
      success: function(response) {
		 $('.flight_fliter_loader').fadeOut();
		 var ss= jQuery.parseJSON(response);
      	$('#mainDiv').html(ss.hotel_search_result);
        $('#total_result_count').html(ss.total_result_count);
        window.scrollTo(500, 10);

      }
    });
} 
   
   
function filterSearch() {
 filter();
 }

$(document).on("click",".star_rating",function() 
{
filter();
});
  /*      
 function filterSearch() {
 filter();
        var minVal = $("#slider-range").slider("values", 0);
        var maxVal = $("#slider-range").slider("values", 1);

        $.ajax({
            type: 'GET',
            async: true,
            dataType: 'json',
            url: '<?php echo site_url(); ?>hotel/hotel_filter_slider/' + minVal + '/' + maxVal,
            beforeSend: function () {
                $(".nextpage").hide();
            },
            success: function (data) {
				//alert();
					$('#mainDiv').html(data.hotel_search_result);
                    $('#total_result_count').html(data.total_result_count);
            }

        });
    }
    
$(document).on("click",".filter_airline",function() 
{
var ItemArray = [];  
$( ".filter_airline" ).each(function() {
	
  lan= $(this).attr('id'); 
  if($('#'+lan+':checkbox:checked').length > 0==true)
  {	  
	name= $(this).attr('val'); 
  ItemArray.push(name);
  }
  });	
	
	        $.ajax({
            type: 'GET',
            async: true,
            data: { name: ItemArray },
            dataType: 'json',
            url: '<?php echo site_url(); ?>hotel/hotel_type/',
            beforeSend: function () {
                $(".nextpage").hide();
            },
            success: function (data) {
				//alert();
					$('#mainDiv').html(data.hotel_search_result);
                    $('#total_result_count').html(data.total_result_count);
            }

        });
});

$(document).on("click",".star_rating",function() 
{
	
	
	filter();
var ItemArray = [];  
$( ".star_rating" ).each(function() {
	
  if($(this).hasClass( "active" ))
  {	  
	name= $(this).attr('rate'); 
  ItemArray.push(name);
  }
  });	
	
	        $.ajax({
            type: 'GET',
            async: true,
            data: { name: ItemArray },
            dataType: 'json',
            url: '<?php echo site_url(); ?>hotel/hotel_star_rating/',
            beforeSend: function () {
                $(".nextpage").hide();
            },
            success: function (data) {
				//alert();
					$('#mainDiv').html(data.hotel_search_result);
                    $('#total_result_count').html(data.total_result_count);
            }

        });
});


        
 
 
 $('#hotel_namefilter').keyup(function(){
	var name = $(this).val();
	 
	           $.ajax({
                url: '<?php echo site_url(); ?>hotel/filter_hotel_result',
                data: { name: name },
                dataType: "json",
                beforeSend: function () {
					$('#mainDiv').empty();
                },
                success: function (data) {
					$('#mainDiv').html(data.hotel_search_result);
                    $('#total_result_count').html(data.total_result_count);
                     $.getScript("https://maps.googleapis.com/maps/api/js?callback=MapApiLoaded", function () {});
                    }
				});
	 
	 
 });   
 
 */
 $('.map_all').click(function(){
	var locations = [];
	var lan;
	var lat;
	$( ".hotel_location" ).each(function() {
		lan= $(this).attr('lan');
		lat= $(this).attr('lat');
		name= $(this).attr('nameattr');
		var ItemArray = [];  
		ItemArray.push(name);
		ItemArray.push(lat);
		ItemArray.push(lan);
		locations.push(ItemArray);
	  });
  
	setTimeout(function(){
		
		var map = new google.maps.Map(document.getElementById('mapall'), {
		  zoom: 10,
		  center: new google.maps.LatLng(lat, lan),
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		});

		var infowindow = new google.maps.InfoWindow();

		var marker, i;

		for (i = 0; i < locations.length; i++) {  
		  marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map
		  });

		  google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
			  infowindow.setContent(locations[i][0]);
			  infowindow.open(map, marker);
			}
		  })(marker, i));
		}
	},400);
  });      
        
  $("#farecal").owlCarousel({
		items : 4, 
		itemsDesktop : [1000,4],
		itemsDesktopSmall : [900,3], 
		itemsTablet: [600,2], 
		itemsMobile : [479,1], 
        navigation : true,
		pagination : false
      });


$('.mymail').click(function(){
    $(this).fadeOut(500,function(){
      $('.signupul').fadeIn(500);
    });
    
  });
/*  
  $('#fadeandscale, #fadeandscalereg').popup({
        pagecontainer: '.container',

        transition: 'all 0.3s'
    });
  */
  
$('.toglefil').click(function(){
    $(this).toggleClass('active');
  });

    $('.nav-tabs.customtab .item').click(function(){
      $('.nav-tabs.customtab .item').removeClass('active');
      $(this).toggleClass('active');
    });
    
  /*popup click function*/
  /*  $(".provabslideshow").provabslideshow({
            mobile: true
     }); */
  
  /*popup click function ends*/
  
  /*

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
            var name = $(this).attr('id');
            var val = $(this).attr('val');
      
      	       $.ajax({
                url: '<?php echo site_url(); ?>hotel/Top_filter',
                data: { name: name ,val:val},
                dataType: "json",
                beforeSend: function () {
					$('#mainDiv').empty();
                },
                success: function (data) {
					$('#mainDiv').html(data.hotel_search_result);
                    $('#total_result_count').html(data.total_result_count);
                     $.getScript("https://maps.googleapis.com/maps/api/js?callback=MapApiLoaded", function () {});
                    }
				});
      
      

  });
*/
  $(document).on("click", ".FlightbookNow", function (e) {
	  var that = $(this);
	        e.preventDefault();
	        var att = $(this).attr('data-attr');
	        var action = WEB_URL+'flight/AddToCart/'+att;
			$.ajax({
				type: "GET",
				url: action,
				data: '',
				dataType: "json",
				beforeSend: function(){
					$('.flights').find('.carttoloadr').fadeIn();
			    },
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
			callFlightCart(att);
	    });
});
</script>
<script>
//filter toggle	
	$('.filter_show').click(function(){
		$('.filtrsrch').addClass('open');
	});
	$('.close_filter').click(function(){
		$('.filtrsrch').removeClass('open');
	});

</script>
</body>
</html>
