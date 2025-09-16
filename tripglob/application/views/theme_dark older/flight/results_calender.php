<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo PROJECT_TITLE; ?></title>

  <style type="text/css" media="screen">
   .col-xs-2.nopadding {
      width: 12.33%;
    } 
  </style>


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
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>

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
              <h4 class="placename"><?php if($req->type == 'round')
                 {
                         echo $this->syal['search']['round_trip'];
                  }elseif($req->type == 'oneway'){
                         echo $this->syal['search']['one_way'];
                       
                    } elseif($req->type == 'M'){
                         echo "Multicity";
                       
                    }  
                     ?></h4>
              <h3 class="contryname"><?= $req->origin .' To '. $req->destination; ?> </h3>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6 hidden-sm hidden-xs nopad">
          <div class="col-xs-6 nopad">
            <div class="pad_ten">
              <div class="left_icon sprite calendar_icon"></div>
              <div class="from_to_place">
                <div class="boxlabl"><?php echo $this->syal['search']['departure']; ?></div>
                <div class="datein">
                  <span class="calinn"> <?php echo date('d - M - Y' , strtotime( $req->depart_date )); ?> </span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xs-6 nopad <?php if($req->type != 'round') echo 'disabled'; ?>">
            <div class="pad_ten">
              <div class="left_icon sprite calendar_icon"></div>
              <div class="from_to_place">
                <div class="boxlabl"><?php echo $this->syal['search']['return']; ?></div>
                <div class="datein">
                  <?= $return_date =  ($req->type == 'round') ? date('d - M - Y' , strtotime( $req->return_date )) : "-- --"; ?><span class="calinn">  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-2 hidden-md hidden-sm hidden-xs nopad">
          <div class="pad_ten">
            <div class="left_icon sprite pasnger_icon"></div>
            <div class="from_to_place">
              <div class="boxlabl textcentr"><?php echo $this->syal['search']['passangers']; ?></div>
              <div class="countlbl"><?= $req->ADT + $req->CHD + $req->INF; ?></div>
            </div>
          </div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-4 nopad">
          <div class="pad_ten">
            <button class="modifysrch" data-toggle="collapse" data-target="#modify"><strong><?php echo $this->syal['search']['Modify']; ?></strong> </button>
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
      $data['product']    = 'Flight';
      $data['triptype']     = $req->type;
      $data['origin_m'] = $req->origin_m;
       $data['destination_m'] = $req->destination_m;
      $data['depart_date_m'] = $req->depart_date_m;
      $origin1        = $this->Flight_Model->get_airport_name($req->origin);
      $destination1       = $this->Flight_Model->get_airport_name($req->destination);
      $data['origin']     = $origin1.' ('. $req->origin.')';
      $data['destination']  = $destination1.' ('. $req->destination.')';
      $data['depart_date']  = $req->depart_date;
      $data['return_date']  = $req->return_date;
      $data['ADT']      = $req->ADT;
      $data['CHD']      = $req->CHD;
      $data['INF']      = $req->INF;
      $data['class']      = $req->class;
    //  print_r($data); exit;
      echo $this->load->view(PROJECT_THEME.'/home/search_tab', $data); 
    ?>
    </div>
  </div>
</div>

<div class="clearfix"></div>
<div class="contentsec margtop">
  <div class="container">
    <div class="filtrsrch">
  <?php /*if(@$req->id!=''){ 
    $history = $this->custom_db->single_table_records('search_history', '', array('origin' => $req->id));
    ?>
    <div class="selected_module">
  <h5 class="bund_tit"><i class="fa fa-tags"></i> Your Selected Hotel</h5>
    <div class="selected_result">
     <div class="clearfix"></div>
     <?php 
     $fs = json_decode($history['data'][0]['search_data'], true);
          if($fs['deal_type']=="flight_hotel"){
          $htl_rese = $this->custom_db->single_table_records('cart_hotel', '', array('bundle_search_id' => $req->id));
          $htl_res=$htl_rese['data'][0];
          ?>
       <div class="col-md-4 nopad">
          <div class="hotel_selet">
            <span class="cat_mod"><i class="fa fa-hotel"></i> Hotel</span>

             <div class="ho-img"><img src="<?=$htl_res['image']?>" alt="" /></div>

             <div class="ho-det">
                    <div>
                      <h4><?=$htl_res['hotel_name']?></h4>
                      <p class="address ng-binding"><i class="fa fa-map-marker"></i> <?=$htl_res['hotel_address_full']?></p>
                      <p class="address ng-binding"><?=date('D, M d',strtotime($htl_res['checkin'])).' -to '.date('D, M d',strtotime($htl_res['checkout']))?></p>
                      <p class="rating">
                        <?php for($i=0;$i<$htl_res['star'];$i++){?>
                        <i ng-repeat="i in [1,2,3,4,5,6,7]" ng-class="i <= hotel.star ? 'fa fa-star' : 'fa fa-star-o'" class="ng-scope fa fa-star"></i>
                      <?php } ?>
                        <!-- <i ng-repeat="i in [1,2,3,4,5,6,7]" ng-class="i <= hotel.star ? 'fa fa-star' : 'fa fa-star-o'" class="ng-scope fa fa-star"></i>
                        <i ng-repeat="i in [1,2,3,4,5,6,7]" ng-class="i <= hotel.star ? 'fa fa-star' : 'fa fa-star-o'" class="ng-scope fa fa-star"></i>
                        <i ng-repeat="i in [1,2,3,4,5,6,7]" ng-class="i <= hotel.star ? 'fa fa-star' : 'fa fa-star-o'" class="ng-scope fa fa-star"></i>
                        <i ng-repeat="i in [1,2,3,4,5,6,7]" ng-class="i <= hotel.star ? 'fa fa-star' : 'fa fa-star-o'" class="ng-scope fa fa-star"></i> -->
                      </p>
                    </div>
            </div>

          </div>
       </div>
   <?php $org_amt=$htl_res['org_amt'];
     $curr=$htl_res['currency_val'];
    } ?>
       <div class="col-md-4 nopad hide">
          <div class="hotel_selet">
            <span class="cat_mod"><i class="fa fa-car"></i> Car</span>

             <div class="ho-img"><img src="https://www.vipcars.com/images/carimg/Toyota-Yaris.jpg" alt="" /></div>

             <div class="ho-det">
                    <div>
                      <h4>Hyundai Accent or Similar</h4>
                      <p class="address ng-binding"><i class="fa fa-map-marker"></i> Dubai, United Arab Emirates (DXB Airport)</p>
                      <p class="address ng-binding">(Sat, Jul 29 -to Sun, Jul 30)</p>
                      <p class="facil">
                        &nbsp;<i ng-repeat="i in [1,2,3,4,5,6,7]" ng-class="i <= hotel.star ? 'fa fa-star' : 'fa fa-star-o'" class="ng-scope fa fa-user"></i> 5
                        &nbsp;<i ng-repeat="i in [1,2,3,4,5,6,7]" ng-class="i <= hotel.star ? 'fa fa-star' : 'fa fa-star-o'" class="ng-scope fa fa-suitcase"></i> 3
                      </p>
                    </div>
            </div>

          </div>
       </div>

       <div class="col-md-4 nopad hide">
         <div class="hotel_selet">
          <span class="cat_mod"><i class="fa fa-plane"></i> Flight</span>
          <div class="clearfix"></div>

             <div class="ho-img"><img src="https://c.fareportal.com/n/common/air/ai/CX.gif" alt="" style="height: auto;" /></div>

             <div class="ho-det">
                    <div>
                      <h4>Cathay Pacific Airways (Oneway Flight)</h4>
                      <p class="address ng-binding"><i class="fa fa-map-marker"></i> Bengaluru (BLR) to Dubai (DXB)</p>
                      <p class="address ng-binding">(Sat, Jul 29 -to Sun, Jul 30)</p>
                      <p class="facil">
                        &nbsp;<i ng-repeat="i in [1,2,3,4,5,6,7]" ng-class="i <= hotel.star ? 'fa fa-star' : 'fa fa-star-o'" class="ng-scope fa fa-male"></i> 1
                        &nbsp;<i ng-repeat="i in [1,2,3,4,5,6,7]" ng-class="i <= hotel.star ? 'fa fa-star' : 'fa fa-star-o'" class="ng-scope fa fa-child"></i> 2
                      </p>
                    </div>
            </div>

          </div>
       </div>

        <div class="col-md-4 nopad">
       <div class="bundle_price">
          <div class="price-btn">
            <span class="price"> <strong class="ng-binding"><?=$curr?> <?=$org_amt?></strong> <br><!-- <small>Per person includes</small> -->  </span> 
          </div>
       </div>
       </div>

    </div>
  </div>
    <?php } */?>
    <div class="clearfix"></div>
            <div class="col70">
              <div class="in70">          
                    <div class="farecaled">
                    <!--All Available flight result comes here -->
                  
                    <div class="allresult">
                    
            <?php echo $this->load->view(PROJECT_THEME.'/flight/flight_result_loader'); ?>
            
                      <input type="hidden" value="" id='session_id'>
                      
                      <div class="lodrefrentrev flight_fliter_loader"> </div>
                       
                     <div class="flights <?php if($req->type == 'round') echo 'ifroundway'; ?>" id="flightsdata">
                     </div>
                
                    </div>
                    <!-- End of result -->
                    
                </div>
            </div>
            
        </div>
        
    </div>
</div>

</div>

<?php
          $currency = $this->input->cookie('currency',true);
          $currency_info =   $this->general_model->get_currency_info();
        // echo "<pre>";print_r($currency_info);exit;
          foreach($currency_info as $valCurr){
            if($valCurr->currency_code == $currency){
              $currencyValue = $valCurr->value;
            }
          }
          //$icon = $this->input->cookie('icon',true);
          //$Cvalue = $currencyValue[$currency];              
      ?>

<!-- Page Content -->
<?php //echo "<pre>";print_r($_COOKIE);exit; ?>

      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>


<script type="text/javascript" src="<?= ASSETS; ?>js/flight_filter.js"></script>

<!-- Script to Activate the Carousel --> 
<script type="text/javascript">
  $(document).ready(function(){
    $(".filter_depart").prop('checked', false);
        $(".filter_arrive").prop('checked', false);
    $(".filter_return").prop('checked', false);
        $(".prefer").prop('checked', false);
    //Before the AJAX function runs
    var start = new Date().getTime(),
    difference;
    
    
    /*$(function() {
      $.ajax({
      type:'GET', 
      dataType:"json",
      url: '<?php echo WEB_URL;?>flight/GetResults/<?php echo $request;?>',
      beforeSend: function(XMLHttpRequest){
      $('.imgLoader').fadeIn();
      $('body').css('overflow', 'hidden');    
      }, 
      success: function(response) {
      $('.flights').html(response.result);
      $('#farecal').html(response.airlinematrix);   
      airline_matrix(); 
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
          }
        });
        $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
          " - $" + $( "#slider-range" ).slider( "values", 1 ) );
        });
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
      }
    });
  });
  */
  
    var a = [<?php echo $api_det; ?>];
    alert(a);
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
      url: '<?php echo WEB_URL;?>flight/GetResults/<?php echo $request;?>/'+ a[i]+'/<?php echo $sessionidd; ?>',
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
       /*$(function() {
        $( "#slider-range" ).slider({
          range: true,
          min: response.min_rate,
          max: response.max_rate,
          values: [ response.min_rate, response.max_rate ],
          slide: function( event, ui ) {
             var val1 = ui.values[ 0 ] * <?php echo $Cvalue; ?>;
             var val2 = ui.values[ 1 ] * <?php echo $Cvalue; ?>;

             //alert(val1+' '+val2);
     

          $( "#amount" ).val( "<?php echo $icon;?>" + val1 + " - <?php echo $icon;?>" + val2 );
        
          },
          change: function( event, ui ) {
            one = val1;
            two = val2;
          }
        });

        var value1 = $( "#slider-range" ).slider( "values", 0 );
        var value2 = $( "#slider-range" ).slider( "values", 1 );
       
        var fval1 = value1 * <?php echo $Cvalue; ?>;
        var fval2 = value2 * <?php echo $Cvalue; ?>;
        
        $( "#amount" ).val( "<?php echo $icon;?>" + fval1 +
          " - <?php echo $icon;?>" + fval2 );
        });*/
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

  $(document).on("click", ".FlightbookNow", function (e) {
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
