<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo PROJECT_TITLE; ?></title>
<?php echo $this->load->view(PROJECT_THEME.'/common/load_common_css'); ?>
<link href="<?php echo ASSETS; ?>css/flight_result.css" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<style type="text/css">
  .btn-searc{ background: #f73829; }
</style>
<!-- Navigation -->
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
  
<!-- Header Carousel -->
<div class="allpagewrp top80">
  <div class="newmodify">
    <div class="container">
      <div class="contentsdw">
        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 nopad">
          <div class="pad_ten">
            <div class="left_icon sprite marker_icon"></div>
            <div class="from_to_place">
              <h4 class="placename"><?= ($request_array['type'] == 'round') ? 'Round Trip' : 'One way' ;  ?></h4>
              <h3 class="contryname"><?= $request_array['origin'] .' To '. $request_array['destination']; ?> </h3>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6 hidden-sm hidden-xs nopad">
          <div class="col-xs-6 nopad">
            <div class="pad_ten">
              <div class="left_icon sprite calendar_icon"></div>
              <div class="from_to_place">
                <div class="boxlabl">Departure</div>
                <div class="datein">
                  <span class="calinn"> <?php echo date('d - M - Y' , strtotime( $request_array['depart_date'] )); ?> </span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xs-6 nopad <?php if($request_array['type'] == 'O') echo 'disabled'; ?>">
            <div class="pad_ten">
              <div class="left_icon sprite calendar_icon"></div>
              <div class="from_to_place">
                <div class="boxlabl">Return</div>
                <div class="datein">
                  <?= $return_date =  ($request_array['type'] == 'round') ? date('d - M - Y' , strtotime( $request_array['return_date'] )) : "-- --"; ?><span class="calinn">  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-2 hidden-md hidden-sm hidden-xs nopad">
          <div class="pad_ten">
            <div class="left_icon sprite pasnger_icon"></div>
            <div class="from_to_place">
              <div class="boxlabl textcentr">Passenger(s)</div>
              <div class="countlbl"><?= $request_array['ADT']+$request_array['CHD']+$request_array['INF']; ?></div>
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
<div class="clearfix"></div>
<div class="modify_search_wrap">
<div class="container">
    <div id="modify" class="collapse">
        <?php 
        $data['product'] = 'Flight';
        $data['triptype'] = $request_array['type'];
        $origin1 = $this->flight_model->get_airport_name($request_array['origin']);
        $destination1 = $this->flight_model->get_airport_name($request_array['destination']);
        $data['origin'] = $origin1.' ('. $request_array['origin'].')';
        $data['destination'] = $destination1.' ('. $request_array['destination'].')';
        $data['depart_date'] = $request_array['depart_date'];
        $data['return_date'] = $request_array['return_date'];
        $data['ADT'] = $request_array['ADT'];
        $data['CHD'] = $request_array['CHD'];
        $data['INF'] = $request_array['INF'];
        $data['class'] = $request_array['class'];
        echo $this->load->view(PROJECT_THEME.'/home/search_tab', $data); ?>
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
              <div class="avlhtls"><strong><span id="flight_count"></span></strong> Flight found<span class="placenamefil"><?php echo $req->origin; ?> to <?php echo $req->destination; ?></span></div>
            </div>
          </div>
          <div class="norfilterr">
            <div class="outbnd">
              <div class="rangebox">
                <div class="ranghead">Price</div>
                <div class="price_slider1">
                  <input type="text"  class="level" id="amount" readonly >
                  <div id="slider-range"></div>
                </div>
              </div>
              <div class="rangebox">
                <div class="ranghead">No. of Stops</div>
                <div id="no_stops" class="stoprow">
                  <input hidden type="checkbox" id="stop_0_v" class="filter_stop"  name="filter_stop[]" value="0" >
                  <input hidden type="checkbox" id="stop_1_v" class="filter_stop"  name="filter_stop[]" value="1" >
                  <input hidden type="checkbox" id="stop_m_v" class="filter_stop"  name="filter_stop[]" value="1+" >
                  <div class="boxins marret">
                    <div class="relatboxs">
                      <a class="stopone toglefil " type="0"><label class="rounds"></label></a>
                      <a class="stopone toglefil " type="1"><label class="rounds"></label></a>
                      <a class="stopone toglefil " type="m"><label class="rounds"></label></a>
                    </div>
                    <div class="relatboxsone">
                      <a class="stopone stopzero" type="0">
                        <div class="starin">
                          <div class="stopbig">0 <span class="stopsml">stop</span></div>
                        </div>
                      </a>
                      <a class="stopone stop_one toglefil" type="1">
                        <div class="starin">
                          <div class="stopbig">1 <span class="stopsml">stop</span></div>
                        </div>
                      </a>
                      <a class="stopone stop_mul toglefil" type="m">
                        <div class="starin">
                          <div class="stopbig">1+ <span class="stopsml">stop</span></div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="rangebox">
                    <div class="ranghead">Arrival Time</div>
                    <div id="arr_time" class="stoprow">
                        <input hidden type="checkbox" id="12_6A_A" class="filter_arrive"  name="filter_arrive[]" value="12_6A" >
                        <input hidden type="checkbox" id="6_12A_A" class="filter_arrive"  name="filter_arrive[]" value="6_12A" >
                        <input hidden type="checkbox" id="12_6P_A" class="filter_arrive"  name="filter_arrive[]" value="12_6P" >
                        <input hidden type="checkbox" id="6_12P_A" class="filter_arrive"  name="filter_arrive[]" value="6_12P" >
                        <div class="boxins marret padlow">
                            <div class="relatboxsone">
                                <a class="timone" type="0"><div class="sprte png1"></div></a>
                                <a class="timone toglefil" type="1"><div class="sprte png2"></div></a>
                                <a class="timone toglefil" type="m"><div class="sprte png3"></div></a>
                                <a class="timone toglefil" type="m"><div class="sprte png4"></div></a>
                            </div>
                            <div class="clearfix"></div>
                            <div class="relatboxs">
                                <a class="timone filter_arrive_btn toglefil " type="12_6A"><label class="rounds"></label></a>
                                <a class="timone filter_arrive_btn toglefil " type="6_12A"><label class="rounds"></label></a>
                                <a class="timone filter_arrive_btn toglefil " type="12_6P"><label class="rounds"></label></a>
                                <a class="timone filter_arrive_btn toglefil " type="6_12P"><label class="rounds"></label></a>
                            </div>
                            <div class="clearfix"></div>
                            <div class="relatboxsone">
                                <a class="timone toglefil filter_arrive_btn" type="12_6A">
                                    <div class="starin"><span class="htlcount">12-6 AM</span></div>
                                </a>
                                <a class="timone toglefil filter_arrive_btn" type="6_12A">
                                    <div class="starin"><span class="htlcount">6-12 AM</span></div>
                                </a>
                                <a class="timone toglefil filter_arrive_btn" type="12_6P">
                                    <div class="starin"><span class="htlcount">12-6 PM</span></div>
                                </a>
                                <a class="timone toglefil filter_arrive_btn" type="6_12P">
                                    <div class="starin"><span class="htlcount">6-12 PM</span></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
              <div class="rangebox">
                <div class="ranghead">Departure Time</div>
                <div id="dep_time" class="stoprow">
                  <input hidden type="checkbox" id="12_6A_D" class="filter_depart"  name="filter_depart[]" value="12_6A" >
                  <input hidden type="checkbox" id="6_12A_D" class="filter_depart"  name="filter_depart[]" value="6_12A" >
                  <input hidden type="checkbox" id="12_6P_D" class="filter_depart"  name="filter_depart[]" value="12_6P" >
                  <input hidden type="checkbox" id="6_12P_D" class="filter_depart"  name="filter_depart[]" value="6_12P" >
                  <div class="boxins marret padlow">
                    <div class="relatboxsone">
                      <a class="timone" type="0"><div class="sprte png1"></div></a>
                      <a class="timone toglefil" type="1"><div class="sprte png2"></div></a>
                      <a class="timone toglefil" type="m"><div class="sprte png3"></div></a>
                      <a class="timone toglefil" type="m"><div class="sprte png4"></div></a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="relatboxs">
                      <a class="timone filter_depart_btn toglefil " type="12_6A"><label class="rounds"></label></a>
                      <a class="timone filter_depart_btn toglefil " type="6_12A"><label class="rounds"></label></a>
                      <a class="timone filter_depart_btn toglefil " type="12_6P"><label class="rounds"></label></a>
                      <a class="timone filter_depart_btn toglefil " type="6_12P"><label class="rounds"></label></a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="relatboxsone">
                      <a class="timone toglefil filter_depart_btn" type="12_6A">
                        <div class="starin"><span class="htlcount">12-6 AM</span></div>
                      </a>
                      <a class="timone toglefil filter_depart_btn" type="6_12A">
                        <div class="starin"><span class="htlcount">6-12 AM</span></div>
                      </a>
                      <a class="timone toglefil filter_depart_btn" type="12_6P">
                        <div class="starin"><span class="htlcount">12-6 PM</span></div>
                      </a>
                      <a class="timone toglefil filter_depart_btn" type="6_12P">
                        <div class="starin"><span class="htlcount">6-12 PM</span></div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <?php if($_GET['type'] === 'round' AND isset($_GET['return_date'])) {?>
              <div class="rangebox">
                <div class="ranghead">Return Time</div>
                <div id="return_time" class="stoprow">
                  <input hidden type="checkbox" id="12_6A_R" class="filter_return"  name="filter_return[]" value="12_6A">
                  <input hidden type="checkbox" id="6_12A_R" class="filter_return"  name="filter_return[]" value="6_12A">
                  <input hidden type="checkbox" id="12_6P_R" class="filter_return"  name="filter_return[]" value="12_6P">
                  <input hidden type="checkbox" id="6_12P_R" class="filter_return"  name="filter_return[]" value="6_12P">
                  <div class="boxins marret padlow">
                    <div class="relatboxsone">
                      <a class="timone" type="0"><div class="sprte png1"></div></a>
                      <a class="timone toglefil" type="1"><div class="sprte png2"></div></a>
                      <a class="timone toglefil" type="m"><div class="sprte png3"></div></a>
                      <a class="timone toglefil" type="m"><div class="sprte png4"></div></a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="relatboxs">
                      <a class="timone filter_return_btn toglefil" type="12_6A"><label class="rounds"></label></a>
                      <a class="timone filter_return_btn toglefil" type="6_12A"><label class="rounds"></label></a>
                      <a class="timone filter_return_btn toglefil" type="12_6P"><label class="rounds"></label></a>
                      <a class="timone filter_return_btn toglefil" type="6_12P"><label class="rounds"></label></a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="relatboxsone">
                      <a class="timone  filter_return_btn toglefil" type="12_6A">
                        <div class="starin"><span class="htlcount">12-6AM</span></div>
                      </a>
                      <a class="timone filter_return_btn toglefil" type="6_12A">
                        <div class="starin"><span class="htlcount">6-12AM</span></div>
                      </a>
                      <a class="timone toglefil filter_return_btn" type="12_6P">
                        <div class="starin"><span class="htlcount">12-6PM</span></div>
                      </a>
                      <a class="timone toglefil filter_return_btn" type="6_12P">
                        <div class="starin"><span class="htlcount">6-12PM</span></div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>  
              <?php }?>
              <div class="rangebox">
                <div class="ranghead">Airlines</div>
                <div id="airlines" class="stoprow">
                  <div class="boxins">
                    <ul class="locationul" id="AirlineFilter"></ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
            </div> 





            <div class="col70">
              <div class="in70">       

              


                    <div class="farecaled">
                  <div class="col-xs-12 nopad">
                      <div class="farenewcal">
                          <div class="matrx">
                              <div id="farecal" class="owl-carousel matrixcarsl owl-theme">

                                      
                               </div>
                            </div>
                        </div>
                    </div>
              </div>
                    
                  <div class="topmisty">
                      <div class="col-xs-12 nopad">
                          <button class="filter_show"><span class="fa fa-filter"></span></button>
                            <div class="insidemyt">
                              <ul class="sortul flight_sort">
                                  <li class="sortli hide_sort">
                                      <span class="sprite sirticon sort1"></span>
                                      <a class="sorta" type='depature_time' id="depart_sort" val='asc'>Airline</a>
                                    </li>
                                     <li class="sortli">
                                      <span class="sprite sirticon sort2"></span>
                                      <a class="sorta" type='depature_time' id="depart_sort" val='asc'>Departure Time</a>
                                    </li>
                                    <li class="sortli">
                                      <span class="sprite sirticon sort3"></span>
                                      <a class="sorta" type='arrival_time' type='amount' id="arrival_sort" val='asc'>Arrival Time</a>
                                    </li>

                                    <li class="sortli">
                                      <span class="sprite sirticon sort4"></span>
                                      <a class="sorta active des" type='amount' id="price_sort" val='asc'>Price</a>
                                    </li>
                                   
                                    <li class="sortli hide_sort">
                                      <span class="sprite sirticon sort5"></span>
                                      <a class="sorta" type='onwards_stops' id="stop_sort" val='asc'>Stop</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!--All Available flight result comes here -->
                  
                    <div class="allresult">
                    
            <?php echo $this->load->view(PROJECT_THEME.'/flight/flight_result_loader'); ?>
            
                      <input type="hidden" value="" id='session_id'>
                      
                      <div class="lodrefrentrev flight_fliter_loader"> </div>
                       
                     <div class="flights <?php if($request_array['type'] == 'round') echo 'ifroundway'; ?>" id="flightsdata">
                     </div>
                
                    </div>
                    <!-- End of result -->
                    
                </div>
            </div>
            
        </div>
        
    </div>
</div>

</div>



<!-- Page Content -->

<?php echo $this->load->view(PROJECT_THEME.'/common/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/common/load_common_js'); ?>


<script type="text/javascript" src="<?= ASSETS; ?>js/flight_filter.js"></script>

<!-- Script to Activate the Carousel --> 
<script type="text/javascript">
/*  $origin_code ;
  $origin_name ;
  $destination_code  ;
  $destination_name ;*/

$(document).ready(function(){
  
  
  
  
  

  $(".filter_depart").prop('checked', false);
  $(".filter_return").prop('checked', false);
//Before the AJAX function runs

var start = new Date().getTime(),
    difference;
$(function() {
   
    $.ajax({
      type:'GET', 
    dataType:"json",
      url: '<?php echo WEB_URL;?>flight/GetResults/<?php echo $request;?>',
      beforeSend: function(XMLHttpRequest){
    $('.imgLoader').fadeIn();
    $('body').css('overflow', 'hidden');
    
      }, 
      success: function(response) {
       // var endTime = new Date().getTime();
      //  console.log(difference = new Date().getTime() - start);
      //  console.log(endTime);
        alert(response.result);
    $('.flights').html(response.result);
    $('#farecal').html(response.airlinematrix);
    
    //airline_matrix();
    
    
        $('.imgLoader').fadeOut(500, function(){
      $('body').css('overflow', '');
    });
    $('#pricerange').addClass('in');
     $(function() {
      $( "#slider-range" ).slider({
        range: true,
        min: response.min_rate,
        max: response.max_rate,
        values: [ response.min_rate, response.max_rate ],
        slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        },
        change: function( event, ui ) {
         one=ui.values[0];
         two=ui.values[1];
         //alert(one+'-'+two);
        // showFlights(one, two);
        
        }
      });
      $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
        " - $" + $( "#slider-range" ).slider( "values", 1 ) );
      });
      
    
     $('#no_stops').addClass('in');
     $('#dep_time').addClass('in');
     $('#return_time').addClass('in');
    
    //$("#flight_count").html(response.flight_count);
    $("#session_id").val(response.session_data);
    $("#stops_0").html(response.stops_0min_rate+" $");
    $("#stops_1").html(response.stops_1min_rate+" $");
    $("#stops_multi").html(response.stops_multimin_rate+" $");

      }
    });
});

function airline_matrix(){
  
  $("#farecal").owlCarousel({
  items : 4, 
  itemsDesktop : [1000,4],
  itemsDesktopSmall : [900,3], 
  itemsTablet: [600,2], 
  itemsMobile : [479,1], 
  navigation : true,
  pagination : false
  });
  
}


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

  $(document).on("click", ".FlightbookNow", function (e) {
    var that = $(this);
          e.preventDefault();
          var att = $(this).attr('data-attr');
          var action = WEB_URL+'flight/addToCart/'+att;
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
    
    
  //filter toggle 
  
  $('.filter_show').click(function(){
    $('.filtrsrch').addClass('open');
  });
  
  $('.close_filter').click(function(){
    $('.filtrsrch').removeClass('open');
  });
    
    
});
</script>

</body>
</html>
