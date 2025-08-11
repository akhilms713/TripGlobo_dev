<!--search_tab-->  
<div class="totopp"> 
  <div class="col-lg-12 nopad">
    <div class="tabbable customtab">
      <?php  if(!isset($product)){ ?>
      <ul class="nav nav-tabs nav-tabs-responsive">
        <li class="<?php if(isset($header_product) && $header_product == 'Flights') echo 'active'; if(!isset($header_product)) echo 'active'; ?>"> <a href="#flight_search" data-toggle="tab"> <span class="text"><span class="spanfa sprite faflight"></span>Flight</span> </a> </li>
        </ul>
      <?php } ?>
      <div class="tab-content">
        <div class="tab-pane 
                  <?php if((isset($product) && $product == 'Flight') || (isset($header_product) && $header_product == 'Flights')) echo 'active'; if(!isset($product) && !isset($header_product)) echo 'active';  ?>" id="flight_search">
          <form  autocomplete="off" action="<?php echo WEB_URL ?>flight/search" name="flight" id="flight" >
                    <div class="intabs">
                      <div class="waywy">
                        <div class="smalway"> 
                         <input type="hidden" class="triprad iradio_flat-blue" id="trip_type" name="trip_type" value="round"/>
                        <a class="wament <?php if(isset($triptype) && $triptype == 'O') echo 'active'; ?>" id="oneway">One Way</a> <a class="wament <?php if(isset($triptype) && $triptype == 'R') echo 'active'; else echo 'active'; ?>" id="round">Round Trip</a> </div>
                      </div>
                      <div class="clear"></div>
                      <div class="outsideserach">
                        <div class="col-xs-6 nopad fullwidth_tab">
                          <div class="marginbotom10 pad10">   
                             <span class="formlabel">From</span>
                            <div class="relativemask"> 
                            <div class="maskimg"><span class="mfrom icon_wd"></span> <span class="formlabel1">From</span></div>
                     <input type="text" required class="ft fromflight mytextbox" id="from" name="from" placeholder="From, Airport Code or Airport City" value="<?php if(isset($origin)) echo $origin; ?>" />
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-6 nopad fullwidth_tab">
                          <div class="marginbotom10 pad10"> 
                             <span class="formlabel">To</span>
                            <div class="relativemask"> 
                           <div class="maskimg"><span class="mto icon_wd"></span> <span class="formlabel1">To</span></div>
                               <input type="text" required class="ft departflight mytextbox" name="to"  id="to"  placeholder="To, Airport Code or Airport City" value="<?php if(isset($destination)) echo $destination; ?>" />
                            </div>
                          </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-xs-6 nopad fullwidth_tab">
                          <div class="marginbotom10">
                            <div class="col-xs-6 fiveh pad10">
                              <span class="formlabel">Depart</span>
                              <div class="relativemask"> 
                              <div class="maskimg"><span class="caln icon_wd"></span> <span class="formlabel1">Depart</span></div>
<input  name="depature" id="depature" required type="text" class="forminput date_picker" value="<?php if(isset($depart_date)) echo $depart_date; ?>" placeholder="Depature Date" readonly />
                              </div>
                            </div>
                            <div class="col-xs-6 fiveh pad10 " id="return_date1" >
                            <span class="formlabel">Return</span>
                              <div class="relativemask"> 
                               <div class="maskimg"><span class="caln icon_wd"></span> <span class="formlabel1">Return</span></div>
                                <input type="text" name="return" id="return" required class="forminput date_picker" value="<?php if(isset($return_date)) echo $return_date; ?>" placeholder="Return Date" readonly />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-6 nopad fullwidth_tab">
                          <div class="marginbotom10">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 fiveh pad10"> 
                             <span class="formlabel">Adult</span>
                              <div class="selectedwrapnum">
                                <div class="onlynumwrap">
                                  <div class="onlynum">
                                    <div class="onlynum">
                          <button type="button" class="btn btn-default btn-number btnpot" data-type="minus" data-field="adult"> <span class="fa fa-minus"></span> </button>

                          <input type="text" name="adult" id="adult" readonly class="form-control input-number centertext valid" value="<?php if(isset($ADT)) echo $ADT; ?>" data-min="1" data-max="9" aria-invalid="false">
                          <button type="button" class="btn btn-default btn-number btnpot btn_right" data-type="plus" data-field="adult"> <span class="fa fa-plus"></span> </button>
                        </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 fiveh pad10"> 
                            <span class="formlabel">Child<strong>(2-11 yrs)</strong></span>
                              <div class="selectedwrapnum">
                                <div class="onlynumwrap">
                                  <div class="onlynum">
                                    <button type="button" class="btn btn-default btn-number btnpot" data-type="minus" data-field="child"> <span class="fa fa-minus"></span> </button>
                          <input type="text" name="child" id="child" readonly class="form-control input-number centertext" value="<?php if(isset($CHD)) echo $CHD; else echo '0'; ?>" data-min="0" data-max="8">
                          <button type="button" class="btn btn-default btn-number btnpot btn_right" data-type="plus" data-field="child"> <span class="fa fa-plus"></span> </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 fiveh pad10"> 
                            <span class="formlabel">Infant<strong>(0-2 yrs)</strong></span>
                              <div class="selectedwrapnum">
                                <div class="onlynumwrap">
                                  <div class="onlynum">
                                    <button type="button" class="btn btn-default btn-number btnpot"  data-type="minus" data-field="infant"> <span class="fa fa-minus"></span> </button>
                          <input type="text" id="infant" name="infant" readonly class="form-control input-number centertext" value="<?php if(isset($INF)) echo $INF; else echo '0'; ?>" data-min="0" data-max="9">
                          <button type="button" class="btn btn-default btn-number btnpot btn_right" data-type="plus" data-field="infant"> <span class="fa fa-plus"></span> </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                  </div> 
                         

                        </div>
                        <div class="col-xs-12 nopad fullwidth_tab" id="advance_close">
                          <div class="">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 fiveh pad10 pull-right">
                              <span class="formlabel pull-right advnce_optn">Advanced Options</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12 nopad fullwidth_tab" id="advance_opn">
                          <div class="marginbotom10">
                            <!--div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 fiveh pad10">
                              <span class="formlabel">Prefered Airlines</span>
                              <input type="text" class="prfrd_airline" placeholder="Airline Name or Code">
                            </div-->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 fiveh pad10"> 
                             <span class="formlabel">Class</span>
                              <div class="selectedwrap">
                                <select class="mySelectBoxClass flyinputsnor" id="class" name="class" required>
                                  <option value="ALL" <?php if(isset($class) && $class == 'ALL') echo 'Selected'; ?>>All</option>
                                  <option value="Economy" <?php if(isset($class) && $class == 'Economy') echo 'Selected'; ?>>Economic</option>
                                  <option value="PremiumEconomy" <?php if(isset($class) && $class == 'PremiumEconomy') echo 'Selected'; ?>>Premium Economy</option>
                                  <option value="Business" <?php if(isset($class) && $class == 'Business') echo 'Selected'; ?>>Business</option>
                                  <option value="PremiumBusiness" <?php if(isset($class) && $class == 'PremiumBusiness') echo 'Selected'; ?>>Premium Business</option>
                                  <option value="First" <?php if(isset($class) && $class == 'First') echo 'Selected'; ?>>First</option>
                                  <option value="PremiumFirst" <?php if(isset($class) && $class == 'PremiumFirst') echo 'Selected'; ?>>Premium First</option>
                                </select>  
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-xs-12 nopad lesstab">
                          <div class="marginbotom10 pad10">
                            <div class="formsubmit">
                             <button class="srchbutn comncolor">Search Flights</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

<!--/search_tab-->
<script type="text/javascript">
var api_url='<?php echo base_url();?>';
// room adding for hotel
  
$(document).ready(function(){
  $("#advance_close").click(function(){
        $("#advance_opn").toggle();
    });
  // hotel child ages display on child value
  $(document).on('click', '.agecount', function(e){
    var value=$(this).attr('data-type');
    var field=$(this).attr('data-field');
    var childs = $('#'+field).val();
    if(value == 'plus'){
      childs = parseInt(parseInt(childs)+1);
    } else {
      childs = parseInt(parseInt(childs)-1);
    }
    if(childs > 0){
      $('#'+field+'_ages').empty();
      $("."+field+"_age").show();
      for(var i=0; i<childs; i++){
        var cid = parseInt(parseInt(i)+1);
        var childsdata = '<span class="formlabel">Child age '+cid+'</span><div class="selectedwrapnum"><div class="onlynumwrap"><div class="onlynum"><button type="button" class="btn btn-default btn-number btnpot" disabled="disabled" data-type="minus" data-field="'+field+'_age'+cid+'"> <span class="fa fa-minus"></span> </button><input type="text" name="'+field+'[]" id="'+field+'_age'+cid+'" class="form-control input-number centertext" value="0" data-min="0" data-max="11"><button type="button" class="btn btn-default btn-number btnpot" data-type="plus" data-field="'+field+'_age'+cid+'"> <span class="fa fa-plus"></span> </button></div></div></div>';
        $('#'+field+'_ages').append(childsdata);
      }
    } else {
      $('#'+field+'_ages').empty();
      $("."+field+"_age").hide();
    }  
    });
  $("#rowsFlight").append('<div class="appenddiv"><div class="col-md-7 nopad"><div class="col-md-6 pad5 fullwidth_tab"><div class=""><span class="formlabel"></span><div class="relativemask"> <span class="maskimg mfrom"></span><input type="text" class="ft fromflightm iconLoc contr_form" data-refid ='+id+' id="from_m_'+id+'" data-id="'+id+'" value="'+mymvalue+'" name="from_m[]" placeholder="'+FlightPlaceholderFrom+'"  required/><input class="hide loc_id_holder" name="from_loc_id_'+id+'" id="from_loc_id_'+id+'" type="hidden" value="'+myvalueid+'" /></div></div></div><div class="col-md-6 pad5 fullwidth_tab"><div class=""><span class="formlabel">To</span><div class="relativemask"> <span class="maskimg mto"></span><input type="text" class="ft fromflightm iconLoc contr_form" name="to_m[]"  data-refid ='+id+' id="to_m_'+id+'" placeholder="'+FlightPlaceholderToSc+'" /><input class="hide loc_id_holder" data-id="'+id+'" name="to_loc_id_'+id+'" id="to_loc_id_'+id+'" type="hidden" value="" /></div></div></div></div><div class="col-md-4 nopad fullwidth_tab"><div class=""><div class="col-xs-9 fiveh pad5"><span class="formlabel">Departure</span><div class="relativemask"> <span class="maskimg caln"></span><input  name="depature_m[]" id="depature_m_'+id+'" type="text" class="forminput date_picker contr_form" placeholder="'+dipatureDate+'" readonly=""/></div></div><div class="col-xs-3 fiveh pad5"><span class="formlabel">&nbsp;</span><div class="flightDate" id="addclose"><div><img src="'+WEB_URL+'assets/theme_dark/images/minus-button.png" id="closeflights" onclick="closeFlights()" style="cursor:pointer;" /></div></div></div></div></div></div>');
         
    
  
// Number field button function 
  
$(document).on('click', '.btn-number', function(e){
//$('.btn-number').on('click', function(e){
    e.preventDefault();
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[id='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('data-min')) {
               if(fieldName == 'adult' || fieldName == 'child'){
                    //flight
                    var max = 9;
                    var chd = parseInt($('#child').val()); 
                    var adt = parseInt($('#adult').val());
                    var inf = parseInt($('#infant').val());
                    var persons = adt + chd;
                    
                    if(persons < max){
                        input.val(currentVal - 1).change();
                    }

                    if(fieldName == 'adult'){
                        //console.log(inf +'>='+ adt);
                        if(inf >= adt){
                            $('#infant').val(adt-1).change();
                        } 
                    }
                                        
                }if(fieldName == 'infant'){
                    var adt = parseInt($('#adult').val());
                    var inf = parseInt($('#infant').val());
                    if(inf <= adt){
                        input.val(currentVal - 1).change();
                    }                    
                }else{
                    input.val(currentVal - 1).change();
                }
            } 
            if(parseInt(input.val()) == input.attr('data-min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

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
                    }                    
                }else if(fieldName == 'infant'){
                    var adt = parseInt($('#adult').val());
                    var inf = parseInt($('#infant').val());
                    if(inf < adt){
                        input.val(currentVal + 1).change();
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
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
  
// flight oneway and roundtrip date disabling
  
  $('.wament').click(function(event){
    $('.wament').removeClass('active');
    $(this).addClass('active');

    $("#trip_type").val($(this).attr('id'));
    if ($(this).attr('id') == 'oneway'){
      $('#return_date1').hide();
      $('#return').prop('required',false);
      $('#returnDiv').addClass('ifonway');
    }
    if ($(this).attr('id') == 'round'){      
      $('#return_date1').show();
      $('#return').prop('required',true);
      $('#returnDiv').removeClass('ifonway');
    }
    
  });
  
/* flight */  
  
    $(function() {
  $(".fromflight").autocomplete({
    source: "<?php echo WEB_URL;?>general/get_flight_suggestions",
    minLength: 2,//search after two characters
    autoFocus: true, // first item will automatically be focused
    select: function(event,ui){
        $(".departflight").focus();
        //$(".flighttoo").focus();
    }
    
  });
 
  $(".departflight").autocomplete({
    source: "<?php echo WEB_URL;?>general/get_flight_suggestions",
    minLength: 2,//search after two characters
    autoFocus: true, // first item will automatically be focused
    select: function(event,ui){
        $("#depature").focus();
    }
  });

 $("#swap").on('click', function() {
    var from = $('#from').val();
  var destination = $('#to').val();
  $('#from').val(destination);
  $('#to').val(from);
    }); 


  var windowidth = $(window).width();
  if(windowidth > 768){
    set_datepickerval(2);
  }else{
    set_datepickerval(1);
  }
 
});


$(document).on('change', '.input-number', function(e){
//$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('data-min'));
    maxValue =  parseInt($(this).attr('data-max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('id');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});



function set_datepickerval($mths){
  jQuery( "#depature" ).datepicker({
  minDate: 0,
  dateFormat: 'dd-mm-yy',
  maxDate: "+1y",
  numberOfMonths: $mths,
  onChange : function(){
  },
  onClose: function( selectedDate ) {
    $( "#return" ).datepicker( "option", "minDate", selectedDate );
    var type = $("#trip_type").val();
    console.log(type);
    $( '#return' ).focus();
  }
});
jQuery( "#return" ).datepicker({
  minDate: 0,
  dateFormat: 'dd-mm-yy',
  maxDate: "+1y",
  numberOfMonths: $mths,
  onClose: function( selectedDate ) {
    $( "#depature" ).datepicker( "option", "maxDate", selectedDate );
  }
});
}
        /*Start Home page Flight search*/
$(function() {
    $( "#dept_date" ).datepicker({
      defaultDate: "+1w",
      changeMonth: false,
    dateFormat : 'dd-mm-yy',
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#return_date" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#return_date" ).datepicker({
      defaultDate: "+1w",
      changeMonth: false,
        dateFormat : 'dd-mm-yy',
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#dept_date" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });

    change_infant_option($('#ADT').val());
    change_child_option($('#ADT').val());

     $('#ADT').on('change', function() {           
           $(".childs_ADT").find("option[val='0']").attr("selected", true);
           var self = $('.childs_ADT');
           self.val(self.find('option[selected]').val());
        change_infant_option($(this).val());
        change_child_option($(this).val());
      });
      
          function change_child_option(adt_count)
     {
        var length =   9 - adt_count ; 
        $("#CHD").empty();
        for ( var i = 0; i <= length; i++) 
        {
            $("#CHD").append("<option value='" +i+ "'>" +i+ "</option>");
        }
     }
     function change_infant_option(adt_count)
     {
        $("#INF").empty();
        for ( var i = 0; i <= adt_count; i++) 
        {
            $("#INF").append("<option value='" +i+ "'>" +i+ "</option>");
        }
     }

      is_it_roundTrip($('input[name=type]:checked').val());
       $(".type").click(function(){

         is_it_roundTrip($(this).val());

       });

    function is_it_roundTrip(type)
    {
        if(type == 'R')
        {
            $("#return_date").attr('required',true);
        }
        else
        {
             $("#return_date").attr('required',false);   
        }
    }
  
/* Flight Script ends here */
 
  
  
});
 $(function() {
// $("#trip_type").val($(this).attr('id'));
 var cnt = $("#check_type").val();
//alert(cnt);
      if (cnt == 'oneway'){
      $('#return_date1').hide();  
    }

});


</script> 
<script>
(function($) {
  

  'use strict';

  $(document).on('show.bs.tab', '.nav-tabs-responsive [data-toggle="tab"]', function(e) {
    var $target = $(e.target);
    var $tabs = $target.closest('.nav-tabs-responsive');
    var $current = $target.closest('li');
    var $parent = $current.closest('li.dropdown');
    $current = $parent.length > 0 ? $parent : $current;
    var $next = $current.next();
    var $prev = $current.prev();
    var updateDropdownMenu = function($el, position){
      $el
        .find('.dropdown-menu')
        .removeClass('pull-xs-left pull-xs-center pull-xs-right')
        .addClass( 'pull-xs-' + position );
    };

    $tabs.find('>li').removeClass('next prev');
    $prev.addClass('prev');
    $next.addClass('next');
    
    updateDropdownMenu( $prev, 'left' );
    updateDropdownMenu( $current, 'center' );
    updateDropdownMenu( $next, 'right' );
  });

})(jQuery);
</script> 
  <script type="text/javascript">      
  $(".mytextbox").on("keypress", function(event) {
 
    var eng = /[A-Za-z ]/g;
    var key = String.fromCharCode(event.which);
  
    if (event.keyCode == 8 || event.keyCode == 37 || event.keyCode == 39 || eng.test(key)) {
        return true;}
    return false;
});

$('.mytextbox').on("paste",function(e)
{  e.preventDefault();});

</script>

