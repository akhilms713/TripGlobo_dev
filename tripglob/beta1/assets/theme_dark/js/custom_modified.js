   // room adding for hotel
 var WEB_URL='https://tripglobo.com/beta1/index.php/';
     function show_room_info(room_count,divid){
     var data = {};
     var data = $('#hotelSearchForm').serialize();
     $.ajax({
       type: 'POST',
       url: WEB_URL + "hotel/adult_child_binding_m",
       async: true,
       dataType: 'json',
       data: data,
       success: function(data) {
         $('#room_info').html('');
         $('#room_info').html(data);
       }
     });
       
       
     }
       function show_room_info_package(room_count,divid){
       if(room_count==''){
         room_count=0;
       }
       if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
         xmlhttp=new XMLHttpRequest();
       }else{// code for IE6, IE5
         xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
       }
       xmlhttp.onreadystatechange=function(){
         if (xmlhttp.readyState==4 && xmlhttp.status==200){
           document.getElementById(divid).innerHTML=xmlhttp.responseText;
         }
       }
       xmlhttp.open("GET",api_url+"hotel/adult_child_binding_m_package/"+room_count,true);
       xmlhttp.send();
     }
     
     
   $(document).ready(function(){

     $("#advance_close").click(function(){
           $("#advance_opn").toggle();
       });

     $("#advance_close1").click(function(){
           $("#advance_opn1").toggle();
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
           var childsdata = '<span class="formlabel">Child age '+cid+'</span><div class="selectedwrapnum"><div class="onlynumwrap"><div class="onlynum"><button type="button" class="btn btn-default btn-number btnpot" disabled data-type="minus" data-field="'+field+'_age'+cid+'"> <span class="fa fa-minus"></span> </button><input type="text" name="'+field+'[]" id="'+field+'_age'+cid+'" class="form-control input-number centertext" value="0" data-min="0" data-max="11"><button type="button" class="btn btn-default btn-number btnpot" data-type="plus" data-field="'+field+'_age'+cid+'"> <span class="fa fa-plus"></span> </button></div></div></div>';
           $('#'+field+'_ages').append(childsdata);
         }
       } else {
         $('#'+field+'_ages').empty();
         $("."+field+"_age").hide();
       }
       });
       
       $('.remngwd').click(function() {
          $('.roomcount').addClass("fadeinn");
       }); 

       $(document).mouseup(function (e) { 
            if ($(e.target).closest(".roomcount").length === 0) { 
                $('.roomcount').removeClass("fadeinn");
            } 
        }); 
   
     $('.advncebtn').click(function() {
           $(this).parent('.togleadvnce').toggleClass('open')
       });

   
       $('.alladvnce').click(function() {
          $('.roomcount').removeClass("fadeinn")
       });

       $(document).click(function() {
           //$('.roomcount').removeClass("fadeinn")
       });
       $('.alladvnce').click(function() {
           $('.advncedown').removeClass("fadeinn");
           $(this).children('.advncedown').toggleClass("fadeinn")
       });
       $('.alladvnce, .advncedown').click(function(e) {
           e.stopPropagation()
       });
       $(document).click(function() {
           $('.advncedown').removeClass("fadeinn")
       });  
     
   // Number field button function 
     
   //$(document).on('click', '.btn-number', function(e){
   $('#flight .btn-number').on('click', function(e){

       // e.preventDefault();
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

       var form_id = $(this).closest('form').attr('id');
       //alert(form_id);
       total_pax_count(form_id)
   });

   $('.act-btn-number').click(function(e) {
        e.preventDefault();
        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var current_pax_count_wrapper = $(this).closest('.pax-count-wrapper');
        var input = $("input[name='" + fieldName + "']", current_pax_count_wrapper);
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {
                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change()
                }
                if (parseInt(input.val()) == input.attr('min')) {}
            } else if (type == 'plus') {
                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change()
                }
                if (parseInt(input.val()) == input.attr('max')) {}
            }
        } else {
            input.val(0)
        }
        var form_id = 'check_tourgrade';
        activites_total_pax_count(form_id)
    });

   $('.input-number').focusin(function(){
      $(this).data('oldValue', $(this).val());
   });
   
   
   $('.wament1').click(function(event){
       $('.wament1').removeClass('active');
       $(this).addClass('active');
      
          $("#deal_type").val($(this).attr('id'));
             if ($(this).attr('id') == 'flight_hotel'){
               $("#bundleSearchForm .chilagediv").removeClass('hide');
               $("#bundleSearchForm .infaagediv").removeClass('hide');
               $("#rm_flt_txt").show();
               $("#add_rooms_pkg").show();
               $("#hotel_car_def").show();
               $("#hotel_car_define").hide();
               $("#hotel_car_def :input").prop("disabled", false);
               $("#hotel_car_define :input").prop("disabled", true);
               $("#advance_options").show();
               $("#room_count").show();
               $("#rooms_more").show();
               $("#deal_rooms_count").show();
               $("#hotel_diff").show();
             }
   
             if ($(this).attr('id') == 'flight_car'){
               $("#bundleSearchForm .chilagediv").addClass('hide');
               $("#bundleSearchForm .infaagediv").addClass('hide');
               $("#rm_flt_txt").hide();
               $("#add_rooms_pkg").hide();
               $("#hotel_car_def").show();
               $("#hotel_car_define").hide();
               $("#hotel_car_def :input").prop("disabled", false);
               $("#hotel_car_define :input").prop("disabled", true);
                 $("#advance_options").show();
                 $("#room_count").hide();
                 $("#rooms_more").hide();
                 $("#deal_rooms_count").hide();
                 $("#hotel_diff").hide();
             }
   
             if ($(this).attr('id') == 'hotel_car'){
               $("#bundleSearchForm .chilagediv").removeClass('hide');
               $("#bundleSearchForm .infaagediv").removeClass('hide');
               $("#rm_flt_txt").show();
               $("#add_rooms_pkg").show();
               $("#hotel_car_def").hide();
               $("#hotel_car_define").show();
               $("#hotel_car_def :input").prop("disabled", true);
               $("#hotel_car_define :input").prop("disabled", false);
               $("#advance_options").hide();
               $("#room_count").show();
               $("#rooms_more").show();
               $("#deal_rooms_count").show();
               $("#hotel_diff").show();
             }
   
             if ($(this).attr('id') == 'flight_hotel_car'){
               $("#bundleSearchForm .chilagediv").removeClass('hide');
               $("#bundleSearchForm .infaagediv").removeClass('hide');
               $("#rm_flt_txt").show();
               $("#add_rooms_pkg").show();
               $("#hotel_car_def :input").prop("disabled", false);
               $("#hotel_car_define :input").prop("disabled", true);
               $("#hotel_car_def").show();
               $("#hotel_car_define").hide();
               $("#advance_options").show();
               $("#room_count").show();
               $("#rooms_more").show();
               $("#deal_rooms_count").show();
               $("#hotel_diff").show();
             }
   
    });
     
   // flight oneway and roundtrip date disabling
     
    $('.wament').click(function(event){
    $('.wament').removeClass('active');
    $(this).addClass('active');

    $("#trip_type").val($(this).attr('id'));
    // alert($(this).attr('id'));
    if ($(this).attr('id') == 'oneway'){
      $('#return').addClass('bgclr');
      $('#return_lbl').addClass('bgclr');
           
      // $('#return_pic').hide();
      $('#multi_city').hide();
      $('#one_return_div').show();
      $('#calendar_module').show();
      $('#return').prop('disabled',true);
      $('#return').prop('required',false);
      $("#return").val("");
      $('#returnDiv').addClass('ifonway');
      $(".flight_chnge").removeClass('hide');
    }
    if ($(this).attr('id') == 'round'){   
      $('#return').removeClass('bgclr');
      $('#return_lbl').removeClass('bgclr');   
      $('#calendar_module').show();
      $('#one_return_div').show();
      $('#return_pic').show();
      $('#multi_city').hide();
      $('#return').prop('disabled',false);
      $('#return').prop('required',true);
      $('#returnDiv').removeClass('ifonway');
       $(".flight_chnge").removeClass('hide');
    }
    if ($(this).attr('id') == 'multicity'){      
      $('#return').prop('disabled',true);
      $('#return').prop('required',false);
      $("#return").val("");
      $('#returnDiv').addClass('ifonway');
      // $('#return_pic').hide();
      $('#one_return_div').hide();
      $('#calendar_module').hide();
      $('#multi_city').show();
      $('#return').prop('disabled',true);
      $('#return').prop('required',false);

      $(".flight_chnge").addClass('hide');
    }
    
  });
     
   /* flight */  
     
       $(function() {
        try { 
            
             $(".fromflight").autocomplete({
               source: WEB_URL+"general/get_flight_suggestions",
               minLength: 2,//search after two characters     
               select: function(event,ui){
                  
                  if(ui.item.hasOwnProperty("id")==true){
                     $("#from_loc_id").val(ui.item.id);
                  }else{
                     $("#from_loc_id").val(0);
                  }
                  console.log(ui.item.id,"hello");
               }
             })
             .data("ui-autocomplete")._renderItem = function (ul, item) {
                  return $('<li class="ui-menu-item-with-icon"></li>')
                      .data("ui-autocomplete-item", item)
                      .append('<a><i class="fa fa-plane fa-2" aria-hidden="true"></i> ' + item.label + '</a>')
                      .appendTo(ul);
              }

             $(".fromhotel").autocomplete({
               source: WEB_URL+"general/get_flight_suggestions",
               minLength: 2,//search after two characters     
               select: function(event,ui){
                  
                  if(ui.item.hasOwnProperty("id")==true){
                     $("#from_loc_id").val(ui.item.id);
                  }else{
                     $("#from_loc_id").val(0);
                  }
                  console.log(ui.item.id,"hello");
               }
             })
             .data("ui-autocomplete")._renderItem = function (ul, item) {
                  return $('<li class="ui-menu-item-with-icon"></li>')
                      .data("ui-autocomplete-item", item)
                      .append('<a><i class="fa fa-plane fa-2" aria-hidden="true"></i> ' + item.label + '</a>')
                      .appendTo(ul);
              }
          
        }catch(e) { };


     try { 
     $(".departflight").autocomplete({
       source: WEB_URL+"general/get_flight_suggestions",
       minLength: 2,//search after two characters
       autoFocus: true, // first item will automatically be focused
       select: function(event,ui){
          if(ui.item.hasOwnProperty("id")==true){
             $("#to_loc_id").val(ui.item.id);
          }else{
            $("#to_loc_id").val(0);
          }
           // $("#depature").focus();
           // $("#depature_from").focus();
       }
     })
     .data("ui-autocomplete")._renderItem = function (ul, item) {
          return $('<li class="ui-menu-item-with-icon"></li>')
              .data("ui-autocomplete-item", item)
              .append('<a><i class="fa fa-plane fa-rotate-180" aria-hidden="true"></i> ' + item.label + '</a>')
              .appendTo(ul);
      };
     }catch(e) { };
     

     /* flight */  
     
       
        try { 
            console.log("sdfad");
             $(".frombus").autocomplete({
               source: WEB_URL+"general/bus_stations",
               minLength: 2,//search after two characters     
               select: function(event,ui){
                  
                  if(ui.item.hasOwnProperty("id")==true){
                     $("#from_loc_id").val(ui.item.id);
                  }else{
                     $("#from_loc_id").val(0);
                  }
                  console.log(ui.item.id);
               }
             })
             .data("ui-autocomplete")._renderItem = function (ul, item) {
                // console.log(item);
                  return $('<li class="ui-menu-item-with-icon"></li>')
                      .data("ui-autocomplete-item", item)
                      .append('<a><i class="" aria-hidden="true"></i> ' + item.label + '</a>')
                      .appendTo(ul);
              }
          
        }catch(e) { };


     try { 
      console.log("sdfad");
     $(".departbus").autocomplete({
       source: WEB_URL+"general/bus_stations",
       minLength: 2,//search after two characters
       autoFocus: true, // first item will automatically be focused
       select: function(event,ui){
          if(ui.item.hasOwnProperty("id")==true){
             $("#to_loc_id").val(ui.item.id);
          }else{
            $("#to_loc_id").val(0);
          }
           // $("#depature").focus();
           // $("#depature_from").focus();
       }
     })
     .data("ui-autocomplete")._renderItem = function (ul, item) {
          return $('<li class="ui-menu-item-with-icon"></li>')
              .data("ui-autocomplete-item", item)
              .append('<a><i class="fa-rotate-180" aria-hidden="true"></i> ' + item.label + '</a>')
              .appendTo(ul);
      };
     }catch(e) { };

     


    $("#swap").on('click', function() {
       var from = $('#from').val();
     var destination = $('#to').val();
     $('#from').val(destination);
     $('#to').val(from);
       }); 
   
   
     var windowidth = $(window).width();
     if(windowidth > 768){
       set_datepickerval(1);
     }else{
       set_datepickerval(1);
     }
    
   });
   
   
   var days_to_escape = 1;
   
       function customRange(input){
       if(input.id=='depature'){
         return {
           minDate: "+"+days_to_escape+"d"
         }
       }
     }
     
       $(function () {
           $("#checkbox").click(function () {
               if ($(this).is(":checked")) {
                   $(".chec").show();
               } else {
                   $(".chec").hide();
               }
           });
   
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
    $(document).on('change', '.input-number-act', function(e){
   //$('.input-number').change(function() {
       
       minValue =  parseInt($(this).attr('min'));
       maxValue =  parseInt($(this).attr('max'));
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

   //Car search type
   
   $('.wament').click(function(event){
       $('.wament').removeClass('active');
       $(this).addClass('active');
   
       $("#trip_type_car").val($(this).attr('id'));
       if ($(this).attr('id') == 'same_loc'){
         $('#drop_down_loc').prop('disabled',true);
         $('#drop_down_date2').prop('required',false);
         $('#drop_down_time2').addClass('ifonway');
       } 
   
        $("#trip_type_car").val($(this).attr('id'));
       if ($(this).attr('id') == 'diff_loc'){
         $('#drop_down_loc').prop('disabled',false);
         $('#drop_down_date2').prop('required',false);
         $('#drop_down_time2').addClass('ifonway');
       }   
       
     });
   
   
   
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
   
   
   
   
   
   function set_datepickerval($mths){
     jQuery( "#depature" ).datepicker({
     minDate: 0,
     dateFormat: 'M d,yy',
     maxDate: "+1y",
     numberOfMonths: $mths,
     onChange : function(){
     },
     onSelect: function( selectedDate ) {
       $( "#return" ).datepicker( "option", "minDate", selectedDate );
      $( "#depature_m_1" ).datepicker( "option", "minDate", selectedDate );
      var type = $("#trip_type").val();
      assign_source();
      //console.log(type);
      //$( '#return' ).focus();
         //$( '#return' ).focus();
     }
   });
   jQuery( "#return" ).datepicker({
     minDate: 0,
     dateFormat: 'M d,yy',
     maxDate: "+1y",
     numberOfMonths: $mths,
     onSelect: function( selectedDate ) {
       $( "#depature" ).datepicker( "option", "maxDate", selectedDate );
     }
   });



   
     jQuery( "#depature_from" ).datepicker({
     minDate: 0,
     dateFormat: 'M d,yy',
     maxDate: "+1y",
     numberOfMonths: $mths,
     onChange : function(){
     },
     onSelect: function( selectedDate ) {
       //$( "#return_from" ).datepicker( "option", "minDate", selectedDate );
      // var type = $("#trip_type").val();
       //console.log(type);
       $("#ph_check-in").val($(this).val());

       var date2 = $('#depature_from').datepicker('getDate');
      if(date2!='' && date2!=null){
         date2.setDate(date2.getDate() + 1);
         //alert(date2);
          var to_date_1 =  $.datepicker.formatDate('M d,yy', new Date(date2));
         // alert(to_date_1);
         $( "#return_from" ).datepicker( "option", "minDate", date2 );
         $("#return_from").val(to_date_1);
         $("#ph_check-out").val(to_date_1);
          //$( '#check-out' ).focus();
       }



       //$("#return_from").focus();
     }
   });
   jQuery( "#return_from" ).datepicker({
     minDate: 0,
     dateFormat: 'M d,yy',
     maxDate: "+1y",
     numberOfMonths: $mths,
     onSelect: function( selectedDate ) {
        $("#ph_check-out").val($(this).val());
      // $( "#depature_from" ).datepicker( "option", "maxDate", selectedDate );
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
         function assign_source(){ 
          var my_pxvalue = $('#to').val();
          $('#from_m_1').val(my_pxvalue);
          $('#from_loc_id_1').val($('#to_loc_id').val());
        }
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
       
    // car_dropdown_date
    // car_pickup_date  
       $(function() {
       $( "#car_pickup_date" ).datepicker({
         defaultDate: "+1w",
         changeMonth: false,
         dateFormat: 'M d,yy',
         numberOfMonths: 1,
         minDate:"+1w",
         maxDate:"+1y",
         onSelect: function( selectedDate ) {
           $( "#car_dropdown_date" ).datepicker( "option", "minDate", selectedDate );
            $( '#drop_down_time1' ).focus();
         }
       });
       $( "#car_dropdown_date" ).datepicker({
         defaultDate: "+1w",
         changeMonth: false,  
         dateFormat: 'M d,yy',         
         numberOfMonths: 1,
           minDate:"+1w",
           maxDate:"+1y",
         onSelect: function( selectedDate ) {
           $( "#car_pickup_date" ).datepicker( "option", "maxDate", selectedDate );
            $( '#drop_out_time2' ).focus();
         }
       });
     });
   
     
   /* Flight Script ends here */
   /* Hotel Script */
   //hotel search related
   
    $(function() {
     $(".hotelCityIp").autocomplete({
         source: WEB_URL+"general/get_hotel_cities",
         minLength: 3,//search after two characters
         autoFocus: true, // first item will automatically be focused
         select: function(event,ui){
              $("#check-in").focus();
         },
         change: function (event, ui) {
           if(!ui.item){
             $(".hotelCityIp").val("");
           }
         }
       });
     $("#activity_destination_search_name").autocomplete({
         source: WEB_URL+"general/get_sightseen_city_list",
         minLength: 2,//search after two characters
         autoFocus: true,// first item will automatically be focused
         select: function(event,ui){
              $('#activity_selection_id').val(ui.item.id);
         }
       });
     $("#activity_form").submit(function(e){
         //e.preventDefault();
        if($("#activity_selection_id").val()==''){
            alert("This location not found in our system");
          return false;
        }else{

         return true;
        }
        return true;
     });
     $("#transfer_form").submit(function(e){
         if($("#transfer_selection_id").val()==''){
            alert("This location not found in our system");
          return false;
        }else{

         return true;
        }
        return true;
     });
     $("#transfer_destination_search_name").autocomplete({
         source: WEB_URL+"general/get_sightseen_city_list",
         minLength: 2,//search after two characters
         autoFocus: true,// first item will automatically be focused
         select: function(event,ui){
              $('#transfer_selection_id').val(ui.item.id);
         }
       });
     
   
       
       
       });
   
   
   
   // package  hotel check in 
   
   $("#ph_check-in" ).datepicker({
     minDate: 0,
     dateFormat: 'M d,yy',
     maxDate: "+1y",
     numberOfMonths: 2,
     onChange : function(){
     },
     onSelect: function( selectedDate ) {
        var date2 = $('#ph_check-in').datepicker('getDate');
       if(date2!='' && date2!=null){
         date2.setDate(date2.getDate() + 1);
         //alert(date2);
          var to_date_1 =  $.datepicker.formatDate('M d,yy', new Date(date2));
         // alert(to_date_1);
         $( "#ph_check-out" ).datepicker( "option", "minDate", date2 );
         $("#ph_check-out").val(to_date_1);
         //$("#ph_check-out").val(to_date_1);
          //$( '#check-out' ).focus();
       }
     }
   });
   $("#ph_check-out" ).datepicker({
     minDate: 0,
     dateFormat: 'M d,yy',
     maxDate: "+1y",
     numberOfMonths: 2,
     onSelect: function( selectedDate ) {
       //$( "#ph_check-in" ).datepicker( "option", "maxDate", selectedDate );
     }
   }); 
   /* Hotel Script ends here */  
     
     
     
   });
   
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
    
   $(".mytextbox").on("keypress", function(event) {
   
     var eng = /[A-Za-z ]/g;
     var key = String.fromCharCode(event.which);
   
     if (event.keyCode == 8 || event.keyCode == 37 || event.keyCode == 39 || eng.test(key)) {
         return true;}
     return false;
   });

   $('.mytextbox').on("paste",function(e)
   {  e.preventDefault();});
   flights = parseInt($("#flight_found").val());  



   /*start*/
    function addFlights(){
     // alert("hii");
      cnt = 3;
      // alert(cnt);
      var passvalue=cnt-1;
      //alert(passvalue);
      var mymvaluexx= $('#depature_m_'+passvalue).val();
     // alert(mymvaluexx);
      if(mymvaluexx==""){
         var MulticityAlert  = "MulticityAlert"  ; 
        
      }else{    
        ft_cnt = 2;
          
        // document.getElementById('addclose').style.display = 'none';
        if (cnt = 2){
          id    = parseInt(cnt);
          console.log(id);
          var xidp = id - 1;
          var mymvalue = $('#to_m_'+xidp).val();

          var myvalueid = $('#to_loc_id_'+xidp).val();
          art_id  = parseInt(ft_cnt);
          art_id1 = art_id + 1;   
          id1   = id + 1;  
          id2   = id - 1; 
          // console.log(id2);
          selectedDateValue = $("#datepickermtr_"+id2).val();
          if(selectedDateValue == ''){
            var ChooseDate  = "ChooseDate";
            //alert(ChooseDate);
            // $("#datepickermtr_"+id2).focus();
            return false;
          }
            var FlightPlaceholderFrom = "From, Airport Code / City";      
            var FlightPlaceholderToSc = "To, Airport Code / City";
            var dipatureDate  =   "Departure date";
           var WEB_URL2='https://tripglobo.com/beta1/';
          $("#rowsFlight").append('<div class="appenddiv"><div class="s002"><div class="col-md-11" style="padding:0px;"><div class="inner-form"><div class="input-field first-wrap"><div class="col-md-4 nopad" style=""><div class="brde_on on_multi"><h4>From</h4><input type="text" class="ft fromflightm iconLoc contr_form" data-refid='+id+' id="from_m_'+id+'" data-id="'+id+'" value="" name="from_m[]" placeholder="Type departure city" required style="border-radius: 50px 0px 0px 50px;"/><input class="hide loc_id_holder" name="from_loc_id_'+id+'" id="from_loc_id_'+id+'" type="hidden" value="'+myvalueid+'" /></div></div></div><div class="input-field first-wrap"><div class="col-md-4 nopad " style=""><div class="brde_on on_multi"><h4>To</h4><input type="text" class="ft departflightm iconLoc contr_form" id="to_m_'+id+'" name="to_m[]" placeholder="Type destination city" /></div></div></div><div class="input-field second-wrap"><div class="col-md-4 nopad" style=""> <div class="brde_on on_multi"><h4>Depature Date</h4><input name="depature_m[]" id="depature_m_'+id+'" type="text" class="forminput date_picker contr_form" placeholder="'+dipatureDate+'" readonly="" style="border-radius: 0px 50px 50px 0px;"/></div></div></div></div></div><div class="col-md-1 fiveh pad5"><span class="formlabel">&nbsp;</span><div class="flightDate" id="addclose"><img src="'+WEB_URL2+'assets/theme_dark/images/minus-button.png" id="closeflights" onclick="closeFlights()" style="cursor:pointer;" /></div></div><div class="col-md-4"></div></div></div>');
          $(function() {
            $("#depature_m_"+id ).datepicker({
              numberOfMonths: 1,
              dateFormat: 'M d,yy',     
              minDate: $( "#depature_m_1").val(),
              maxDate: "+361D"
            });

        
var WEB_URL='https://tripglobo.com/beta1/index.php/';

             $(".fromflightm").autocomplete({
               source: WEB_URL+"general/get_flight_suggestions",
                minLength: 3,//search after two characters
                autoFocus: true, // first item will automatically be focused
                select: function(event,ui){
                  var id1 = $(this).attr('data-refid');
                  $("#from_loc_id_"+id1).val(ui.item.id);
                  // $(".departflightm").focus();
                  //$(".flighttoo").focus();
                },
                change: function(event, ui) {
                    if (ui.item) {
                      var id1 = $(this).attr('data-refid');
                      $("#from_loc_id_"+id1).val(ui.item.id);
                    } else {
                        $(this).val('');
                    }
                }            
              });           
              $(".departflightm").autocomplete({
               source: WEB_URL+"general/get_flight_suggestions",
                minLength: 3,//search after two characters
                autoFocus: true, // first item will automatically be focused
                select: function(event,ui){
                  var id1 = $(this).attr('data-refid');
                  
                  $("#to_loc_id_"+id1).val(ui.item.id);
                  // $("#depature_m_"+id).focus();
                },
                change: function(event, ui) {
                  
                    if (ui.item) {
                      var id1 = $(this).attr('data-refid');
                     
                      $("#to_loc_id_"+id1).val(ui.item.id);
                    } else {
                        $(this).val('');
                    }
                }
              });    
            
          });
          flights += 1;
          art_id1 += 1;
          
          $("#f_count").val(id1);
          $("#ft_count").val(art_id1);
         // alert("#f_count"+id1);
         //alert("#ft_count"+art_id1);

        }else{
          var MultiCitiesAllowed  = "Max 5 Multicities Allowed"  ;
          // alert("Max 5 Multicities Allowed");
          $("#rowsFlight1").empty().html('<div style="width:100%;color:#FFFFFF; margin:0px 5px 0px 5px;"><br />'+MultiCitiesAllowed+'</div>');
        }
    }

  }
  /*end*/




  
   function addFlights_old(){ 
   
     cnt = $("#f_count").val();
     var passvalue=cnt-1;
     var mymvaluexx= $('#depature_multi_'+passvalue).val();
     if(mymvaluexx==""){ 
        var MulticityAlert  = "MulticityAlert"  ;
        //alert(MulticityAlert);
     }else{    
       ft_cnt = $("#ft_count").val();
       // document.getElementById('addclose').style.display = 'none';
       if (flights != 5){
         id    = parseInt(cnt);
         var xidp = id - 1;
         var mymvalue = $('#to_m_'+xidp).val();
         art_id  = parseInt(ft_cnt);
         art_id1 = art_id + 1;   
         id1   = id + 1; 
         id2   = id - 1; 
         selectedDateValue = $("#datepickermtr_"+id2).val();
         if(selectedDateValue == ''){
           var ChooseDate  = "ChooseDate";
           // $("#datepickermtr_"+id2).focus();
           return false;
         }
         var FlightPlaceholderFrom = "";      
         var FlightPlaceholderToSc = "";
         var dipatureDate  =   ""; 
          var WEB_URL='https://tripglobo.com/beta1/';
       $("#rowsFlight").append('<div class="appenddiv"><div class="col-md-7 nopad"><div class="col-md-6 pad10 fullwidth_tab"><div class="marginbotom10"><div class="relativemask"><span class="maskimg mfrom"></span><div class="col-md-12 nopad brde_on" style="padding: 0;border: 2px solid #fdb813; border-radius: 4px; margin-bottom: 5px;"><h4>From</h4><input type="text" class="ft fromflightm" data-refid='+id+' id="from_m_'+id+'" name="from_m[]" placeholder="From, Airport Name or Airport City" /></div></div></div></div><div class="col-md-6 pad10 fullwidth_tab"><div class="marginbotom10"><div class="relativemask"><span class="maskimg mto"></span><input type="text" class="ft departflightm" name="to_m[]" data-refid='+id+' id="to_m_'+id+'" placeholder="To, Airport Name or Airport City" /></div></div></div></div><div class="col-md-4 nopad fullwidth_tab"><div class="marginbotom10"><div class="col-xs-8 fiveh pad10"><div class="relativemask"><span class="maskimg caln"></span><input name="depature_m[]" id="departure_multi'+id+'" type="text" class="forminput date_picker" placeholder="'+dipatureDate+'" /></div></div><div class="col-xs-4 fiveh pad10"><div class="flightDate" id="addclose"><div><img src="'+WEB_URL2+'assets/theme_dark/images/minus-button.png" id="closeflights" onclick="closeFlights()" style="cursor:pointer;" /></div></div></div></div></div></div>');
   
   
   
         $( "#depature_multi"+id).val($( "#depature_multi"+passvalue).val());
   
           $("#depature_multi"+id).datepicker({
           minDate:  $( "#depature_multi_"+passvalue).val(),
           dateFormat: 'dd/mm/yy',
           maxDate: "+1y",
           numberOfMonths: 2,
           onChange : function(){
           },
           onClose: function( selectedDate ) { 
           $( "#depature_multi"+(id+1)).datepicker( "option", "minDate", selectedDate);
           }
           });
   
        
       $(".fromflightm").autocomplete({
           source: WEB_URL+"general/get_flight_suggestions",
           minLength: 3,//search after two characters
           autoFocus: true, // first item will automatically be focused
           select: function(event,ui){ 
             var refid = $(this).attr('data-refid');
             // $(".departflightm").focus();
            //$(".flighttoo").focus();
             //$(this).closest('input:(".flighttoo")').focus();
        // $('#to_m_'+refid).focus();
           }
           
           });
          
           $(".departflightm").autocomplete({
           source: WEB_URL+"general/get_flight_suggestions",
           minLength: 3,//search after two characters
           autoFocus: true, // first item will automatically be focused
           select: function(event,ui){
             var refid = $(this).attr('data-refid');
             // $('#depature_multi'+refid).focus();
           }
           });
   
   
       flights += 1;
       art_id1 += 1;
       $("#f_count").val(id1);
       $("#ft_count").val(art_id1);
     }else{
       var MultiCitiesAllowed  = "MultiCities Allowed"  ;
       $("#rowsFlight1").empty().html('<div style="width:100%;color:#FFFFFF; margin:0px 5px 0px 5px;"><br />'+MultiCitiesAllowed+'</div>');
     }
   }
   
   }
   
   function closeFlights(){
     cnt = $("#f_count").val();
     id1 = (cnt - 1); 
     $("#f_count").val(id1);
     
     ft_cnt = $("#ft_count").val();
     art_id  = parseInt(ft_cnt);
     art_id1 = art_id - 2;
     $("#ft_count").val(art_id1);
     flights -= 1;
     $('#rowsFlight .appenddiv').last().remove();
     }

   $(document).ready(function() {

      //flight exchange buttin
      $(".flight_chnge").click(function(){
           var from = $('#from').val();
           var to = $('#to').val();
           $('#from').val(to);
           $('#to').val(from);
           $(".flight_chnge .fa-exchange").toggleClass('rot_arrow');
     });
 var WEB_URL='https://tripglobo.com/beta1/index.php/';
       $(".fromflightm").autocomplete({
             source: WEB_URL+"general/get_flight_suggestions",
             minLength: 3,//search after two characters
             autoFocus: true, // first item will automatically be focused
             select: function(event,ui){ 
               var refid = $(this).attr('data-refid');
               // $(".departflightm").focus();
              //$(".flighttoo").focus();
               //$(this).closest('input:(".flighttoo")').focus();
               // $('#to_m_'+refid).focus();
                $("#to_loc_id_1").val(ui.item.id);
              // $("#depature_m_1").focus();

             }
           
       });
          
       $(".departflightm").autocomplete({
         source: WEB_URL+"general/get_flight_suggestions",
         minLength: 3,//search after two characters
         autoFocus: true, // first item will automatically be focused
         select: function(event,ui){

            $("#to_loc_id_1").val(ui.item.id);
            // $("#depature_m_1").focus();

           //var refid = $(this).attr('data-refid');
           //$('#depature_multi'+refid).focus();
         },
         change: function(event, ui) {
            if (ui.item) {
              $("#to_loc_id_1").val(ui.item.id);
              // $("#depature_m_1").focus();
            } else {
                $(this).val('');
            }
        }
       });
      
       $( "#depature_m_1" ).datepicker({
        minDate: 0,
        dateFormat: 'M d,yy',
        maxDate: "+361D",
        numberOfMonths: 2,
      });

   });
   $(document).ready(function() {
    var max_rooms = 3;
    var min_rooms = 1;
    var max_childs = 2;
    $('.add_rooms').on('click', function(e) {
        e.preventDefault();
        var _visible_rooms = parseInt($('#room-count').val());
        _visible_rooms = _visible_rooms + 1;
        toggle_add_remove_rooms(_visible_rooms);
        if (_visible_rooms <= max_rooms) {
            $('#room-count').val(_visible_rooms);
            for (var i = 1; i <= (_visible_rooms); i++) {
                $('#room-wrapper-' + i).show()
            }
            validate_rooms(_visible_rooms)
        }
        total_pax_summary()
    });
    $('.remove_rooms').on('click', function(e) {
        e.preventDefault();
        var _visible_rooms = parseInt($('#room-count').val());
        toggle_add_remove_rooms((_visible_rooms - 1));
        if (_visible_rooms > min_rooms) {
            $('#room-wrapper-' + _visible_rooms).hide();
            _visible_rooms = _visible_rooms - 1;
            $('#room-count').val(_visible_rooms);
            validate_rooms(_visible_rooms)
        }
        total_pax_summary()
    });
    $('.add_rooms_pkg').on('click', function(e) {
        e.preventDefault();
        var _visible_rooms = parseInt($('#room-count_pkg').val());
        _visible_rooms = _visible_rooms + 1;
        toggle_add_remove_rooms_pkg(_visible_rooms);
        if (_visible_rooms <= max_rooms) {
            $('#room-count_pkg').val(_visible_rooms);
            for (var i = 1; i <= (_visible_rooms); i++) {
                $('#room-wrapper-pkg-' + i).show()
            }
            validate_rooms_pkg(_visible_rooms)
        }
        total_pax_summary_pkg()
    });
    $('.remove_rooms_pkg').on('click', function(e) {
        e.preventDefault();
        var _visible_rooms = parseInt($('#room-count_pkg').val());
        toggle_add_remove_rooms_pkg((_visible_rooms - 1));
        if (_visible_rooms > min_rooms) {
            $('#room-wrapper-pkg-' + _visible_rooms).hide();
            _visible_rooms = _visible_rooms - 1;
            $('#room-count_pkg').val(_visible_rooms);
            validate_rooms_pkg(_visible_rooms)
        }
        total_pax_summary_pkg()
    });

    function toggle_add_remove_rooms(current_rooms) {
        if (current_rooms >= max_rooms) {
            $('.add_rooms').css('visibility','hidden')
        } else {
            $('.add_rooms').css('visibility','visible')
        }
        if (current_rooms <= min_rooms) {
            $('.remove_rooms').hide()
        } else {
            $('.remove_rooms').show()
        }
    }

    function toggle_add_remove_rooms_pkg(current_rooms) {
        if (current_rooms >= max_rooms) {
            $('.add_rooms_pkg').css('visibility','hidden')
        } else {
            $('.add_rooms_pkg').css('visibility','visible')
        }
        if (current_rooms <= min_rooms) {
            $('.remove_rooms_pkg').hide()
        } else {
            $('.remove_rooms_pkg').show()
        }
    }
    function validate_rooms(room) {
    
        for (var i = (parseInt(room) + 1); i <= max_rooms; i++) {
            $('input, select', $('#room-wrapper-' + i)).attr('disabled', 'disabled')
            
        }
        for (var i = (parseInt(room)); i >= min_rooms; i--) {
            $('input, select', $('#room-wrapper-' + i)).removeAttr('disabled')
        }
    }
    function validate_rooms_pkg(room) {
        for (var i = (parseInt(room) + 1); i <= max_rooms; i++) {
            $('input, select', $('#room-wrapper-pkg-' + i)).attr('disabled', 'disabled')
            
        }
        for (var i = (parseInt(room)); i >= min_rooms; i--) {
            $('input, select', $('#room-wrapper-pkg-' + i)).removeAttr('disabled')
        }
    }
   // var pri_visible_room = $('#room-count').val();
    var pri_visible_room = $("#pri_visible_room").val();
    var pri_visible_room_pkg = $('#room-count_pkg').val();
    toggle_add_remove_rooms(pri_visible_room);
    

    if($("#hotel").hasClass('active')){
       validate_rooms(pri_visible_room);     
    }else if($("#package").hasClass('active')){
      validate_rooms(pri_visible_room_pkg);   
    } 
    //total_pax_summary();
    $('#hotelSearchForm .input-number').on('change blur', function() {
        total_pax_summary()
    });
    $('#hotelSearchForm input[name="child[]"]').on('change', function() {
        var current_rooms = $(this).closest('.oneroom');
        var child_count = parseInt(this.value);
        if (child_count < 1) {
            $('.chilagediv', current_rooms).hide()
        } else {
            $('.chilagediv', current_rooms).show();
           // console.log(child_count);
            for (var j = 1; j <= child_count; j++) {
                $('.child-age-wrapper-' + j, current_rooms).show()
                
            }
            for (var j = (child_count + 1); j <= max_childs; j++) {
                $('.child-age-wrapper-' + j, current_rooms).hide()
                
            }
        }
    });

    $('#bundleSearchForm .input-number').on('change blur', function() {
        total_pax_summary_pkg()
    });
    $('#bundleSearchForm input[name="child[]"]').on('change', function() {
        var current_rooms = $(this).closest('.oneroom');
        var child_count = parseInt(this.value);
        var current_id=current_rooms.attr("id");
        var current_v=$(this).closest('#'+current_id);
        if (child_count < 1) {
            $('.chilagediv', current_v).hide()
            $('select',current_v).attr('disabled','disabled')
        } else {
            $('.chilagediv', current_v).show();
            for (var j = 1; j <= child_count; j++) {
                $('.child-age-wrapper-' + j, current_v).show()
                $('select','.child-age-wrapper-' + j, current_v).removeAttr('disabled')
            }
            for (var j = (child_count + 1); j <= max_childs; j++) {
                $('.child-age-wrapper-' + j, current_v).hide()
                $('select','.child-age-wrapper-' + j, current_v).attr('disabled','disabled')
            }
        }
    });
    $('#bundleSearchForm input[name="infant[]"]').on('change', function() {
        var current_rooms = $(this).closest('.oneroom');
        var infant_count = parseInt(this.value);
        var current_id=current_rooms.attr("id");
        var current_v=$(this).closest('#'+current_id);
        if (infant_count < 1) {
            $('.infaagediv', current_v).hide()
            $('select',current_v).attr('disabled','disabled')
        } else {
            $('.infaagediv', current_v).show();
            for (var j = 1; j <= infant_count; j++) {
                $('.infa-age-wrapper-' + j, current_v).show()
                $('select','.infa-age-wrapper-' + j, current_v).removeAttr('disabled')
            }
            for (var j = (infant_count + 1); j <= max_childs; j++) {
                $('.infa-age-wrapper-' + j , current_v).hide()
               $('select','.infa-age-wrapper-' + j, current_v).attr('disabled','disabled')
            }
        }
    });

    function total_pax_summary() {
        var total_rooms = $('#room-count').val();
        var total_adults = 0;
       
        /*start*/
        for (var i = 0; i <parseInt(total_rooms); i++) {
            var room_adult_count = $("#adult_text_"+i).val();
            if(parseInt(room_adult_count)==0){
                $("#adult_text_"+i).val(1);
            }
        }
        /*End*/
        $('#hotelSearchForm [name="adult[]"]').not(':disabled').each(function() {
            //alert(this.value);
            total_adults = total_adults + parseInt(this.value)
        });
        var total_child = 0;
        $('#hotelSearchForm [name="child[]"]').not(':disabled').each(function() {
            total_child = total_child + parseInt(this.value)
        });
      
        var room_summary = '';
        room_summary += total_adults;
        if (total_adults > 1) {
            room_summary += ' Adults,'
        } else {
            room_summary += ' Adult,'
        }
        if (total_child > 0) {
            room_summary += total_child;
            if (total_child > 1) {
                room_summary += ' Children,'
            } else {
                room_summary += ' Child,'
            }
        }
        room_summary += total_rooms;
        if (total_rooms > 1) {
            room_summary += ' Rooms'
        } else {
            room_summary += ' Room'
        }
        $('#hotel-pax-summary').text(room_summary)
    }
    function total_pax_summary_pkg() {
        var total_rooms = $('#room-count_pkg').val();
        var total_adults = 0;
        
        /*start*/
        for (var i = 0; i <parseInt(total_rooms); i++) {
            var room_adult_count = $("#adult_text_pkg_"+i).val();
            if(parseInt(room_adult_count)==0){
                $("#adult_text_pkg_"+i).val(1);
            }
        }
        /*End*/
        $('#bundleSearchForm [name="adult[]"]').not(':disabled').each(function() {
            total_adults = total_adults + parseInt(this.value)
        });
        var total_child = 0;
        $('#bundleSearchForm [name="child[]"]').not(':disabled').each(function() {
            total_child = total_child + parseInt(this.value)
        });
        var total_infant = 0;
        $('#bundleSearchForm [name="infant[]"]').not(':disabled').each(function() {
            total_infant = total_infant + parseInt(this.value)
        });
        var room_summary = '';
        room_summary += total_adults;
        if (total_adults > 1) {
            room_summary += ' Adults'
        } else {
            room_summary += ' Adult'
        }
        if (total_child > 0) {
            room_summary +=' ,'+total_child;
            if (total_child > 1) {
                room_summary += 'Children'
            } else {
                room_summary += 'Child'
            }
        }
        if(total_infant > 0){
          room_summary +=' ,'+total_infant;
          if(total_infant > 1){
            room_summary +='Infants';
          }else{
            room_summary +='Infant';
          }
        }
        var active_bundle_module_type = $(".wament1.active").data('module');
        
        if(active_bundle_module_type !='flight_car'){
          room_summary +=','+total_rooms;
          if (total_rooms > 1) {
              room_summary += ' Rooms'
          } else {
              room_summary += ' Room'
          }
        }
       
        $('#hotel-pax-summary-pkg').text(room_summary)
    }
    $("#validation_part").click(function(event){
         var out = true;
         var total_adults = 0;
        $('#bundleSearchForm [name="adult[]"]').not(':disabled').each(function() {
            total_adults = total_adults + parseInt(this.value)
        });
        var total_child = 0;
        $('#bundleSearchForm [name="child[]"]').not(':disabled').each(function() {
            total_child = total_child + parseInt(this.value)
        });
        $('#bundleSearchForm [name="infant[]"]').not(':disabled').each(function() {
            total_child = total_child + parseInt(this.value)
        });
        var total=total_adults+total_child;
          $("#bundleSearchForm input").each(function(){
            if($(this).prop('required')==true&&$(this).is('[disabled]')==false){
              if ($.trim($(this).val()).length == 0){
                  $(this).addClass("highlight");
                  out = false;
              }else{
                  $(this).removeClass("highlight");
              }
           }
        });
        if (!out) { event.preventDefault(); return out;}
        //alert(total);
        if(total>6){
         $(".alert-message").show();
         event.preventDefault();
         return false;
        }else{
         $(".alert-message").hide();
         $("#bundleSearchForm").submit();
        }
      });
});

$(document).ready(function() {
    $('.btn-number_h').click(function(e) {
        e.preventDefault();
        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var current_pax_count_wrapper = $(this).closest('.pax-count-wrapper');
        var input = $("input[name='" + fieldName + "']", current_pax_count_wrapper);
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {
                if (currentVal > input.data('min')) {
                    input.val(currentVal - 1).change()
                }
                if (parseInt(input.val()) == input.data('min')) {}
            } else if (type == 'plus') {
                if (currentVal < input.data('max')) {
                    input.val(currentVal + 1).change()
                }
                if (parseInt(input.val()) == input.data('max')) {}
            }
        } else {
            input.val(0)
        }
        var form_id = $(this).closest('form').attr('id');
        total_pax_count(form_id)
        
    });

    var dp_visi_monthsp = 2;

    if ($(window).width() > 650) {
        dp_visi_monthsp = 2
    } else {
        dp_visi_monthsp = 1
    }

    $("#check-in").datepicker({
     minDate: 0,
     dateFormat: 'M d,yy',
     maxDate: "+1y",
     numberOfMonths: dp_visi_monthsp,     
     onSelect: function( selectedDate ) {
      var date2 = $('#check-in').datepicker('getDate');
      if(date2!='' && date2!=null){
         date2.setDate(date2.getDate() + 1);
         //alert(date2);
          var to_date_1 =  $.datepicker.formatDate('M d,yy', new Date(date2));
         // alert(to_date_1);
         $( "#check-out" ).datepicker( "option", "minDate", date2 );
         $("#check-out").val(to_date_1);
         $("#no_of_nights").val(1);
          //$( '#check-out' ).focus();
       }
     }
     

   });

    


   $("#check-out").datepicker({
     minDate: 0,
     dateFormat: 'M d,yy',
     minDate: "+1d",
     maxDate: "+1y",
     numberOfMonths: dp_visi_monthsp,
     onClose: function( selectedDate ) {
       //~ $( "#check-in" ).datepicker( "option", "maxDate", selectedDate );
     }
   });  

     $('#check-in, #check-out').on('change', function(e) {
        e.preventDefault();
        
        var from_date = $('#check-in').val();
        var to_date = $('#check-out').val();
        //alert("from_date"+from_date);
        //alert("to_date"+to_date);
        if (from_date != '' && to_date != '') {
            var diffDays = parseInt(get_day_difference($('#check-in').datepicker('getDate'), $('#check-out').datepicker('getDate')));
            if (parseInt(diffDays) > 300 || diffDays < -300) {
                diffDays = 300;
                $('#check-out').val(add_days_to_date_night(from_date, diffDays))
            } else if (diffDays < 0) {
                diffDays = diffDays * -1;
                $('#check-out').val(add_days_to_date_night(from_date, diffDays))
            } else if (diffDays == 0) {
                diffDays = 1;
                $('#check-out').val(add_days_to_date_night(from_date, diffDays))
            }
            //alert(diffDays);
            $('#no_of_nights').val(diffDays)
        }
    });

      $('#no_of_nights').on('change', function() {
        var from_date = $('#check-in').val();
        var number_of_nights = parseInt(this.value);
       
        if (from_date != '') {
            var to_date = add_days_to_date_night(from_date, number_of_nights);
           // console.log(typeof(to_date));
            var from = to_date.split("-")
            var new_to_date = new Date(from[2], from[1] - 1, from[0]);
            var to_date_1 =  $.datepicker.formatDate('M d,yy', new Date(new_to_date));
            $('#check-out').val(to_date_1)
        }
    })
      //hotel validation
      $("#hotelSearchForm").submit(function(){
          var check_in  = $("#check-in").val();
          var check_out = $("#check-out").val();
          if(check_in ==''){
            $("#check-in").addClass('invalid-ip');
             $('#check-in').datepicker('show');
             return false;
          }
          if(check_out==''){
           $("#check-out").addClass('invalid-ip'); 
          // $('#check-out').datepicker('show');
          return false;
          }         

      });
      //flight validation
      $("#flight").submit(function(e){
        //e.preventDefault();
     
        var adult_count = parseInt($("#adult").val());
        var child_count = parseInt($("#child").val());

        var total_pax_count = (adult_count + child_count);
        if(total_pax_count>9){
          // alert('Travelers should be less than 9');
          $('#searchflight_error').html('Travelers should be equal or less than 9');
          $('#searchflight_error').removeClass('hide');
          setTimeout(function(){ $('#searchflight_error').addClass('hide'); }, 5000);
          return false;
        }
        var trip_type = $('[name="trip_type"]').val();      
       // var err_counter = 0;  
       // alert(trip_type);
        if(trip_type=='oneway'){
         
           var _from_loc = $('#flight #from').val();
           var _to_loc = $('#flight #to').val();

           if(_from_loc == '' || _to_loc == ''){
            // alert('Please Enter the location');
            $('#searchflight_error').html('Please Enter the location');
            $('#searchflight_error').removeClass('hide');
            setTimeout(function(){ $('#searchflight_error').addClass('hide'); }, 5000);
            return false;
           }
          if(_from_loc==_to_loc){
            // alert('From location and To location cannot be same');
            $('#searchflight_error').html('From location and To location cannot be same');
            $('#searchflight_error').removeClass('hide');
            setTimeout(function(){ $('#searchflight_error').addClass('hide'); }, 5000);
            return false
          }
          if($("#flight #depature").val()==''){
            $("#flight #depature").addClass('invalid-ip');
            $("#flight #depature").datepicker('show');
            return false;
          }
        }else if(trip_type=='round'){
           var _from_loc = $('#flight #from').val();
           var _to_loc = $('#flight #to').val();
           if(_from_loc == '' || _to_loc == ''){
            // alert('Please Enter the location');
            $('#searchflight_error').html('Please Enter the location');
            $('#searchflight_error').removeClass('hide');
            setTimeout(function(){ $('#searchflight_error').addClass('hide'); }, 5000);
            return false;
           }
          if(_from_loc==_to_loc){
            // alert('From location and To location cannot be same');
            $('#searchflight_error').html('From location and To location cannot be same');
            $('#searchflight_error').removeClass('hide');
            setTimeout(function(){ $('#searchflight_error').addClass('hide'); }, 5000);
            return false
          }
          if (($("#flight #depature").val()=='') && ($("#flight #return").val()=='')) {
            $("#flight #depature").addClass('invalid-ip');
            $("#flight #return").addClass('invalid-ip');
            $("#flight #depature").datepicker('show');
            return false;
          }else if($("#flight #depature").val()==''){
            $("#flight #depature").addClass('invalid-ip');
            $("#flight #depature").datepicker('show');
            return false;
          }else{
            $("#flight #depature").removeClass('invalid-ip');
          }
          if($("#flight #return").val()==''){
            $("#flight #return").addClass('invalid-ip');
            $("#flight #return").datepicker('show');
            return false;
          } else{
            $("#flight #return").addClass('invalid-ip');
          }

        }else if(trip_type=='multicity'){
           f_count = $('#f_count').val();
          if(from != '' && to !=''){
            if(from == to){
              // alert("from location and to location should be different");
              $('#searchflight_error').html('from location and to location should be different');
            $('#searchflight_error').removeClass('hide');
            setTimeout(function(){ $('#searchflight_error').addClass('hide'); }, 5000);
              $("#to").focus();
              err_counter = 1;
            }else{
            
              for(var k=1;k<f_count;k++){

                var loc_id_f = $('#from_m_'+k).val();
                var loc_id_t = $('#to_m_'+k).val(); 
                var depart_t = $('#depature_m_'+k).val(); 

                if(loc_id_f==''){
                 
                  $('#from_m_'+k).focus();
                  $('#from_m_'+k).addClass('invalid-ip');
                   // alert("From location can't be empty"); 
                     $('#searchflight_error').html("From location can't be empty");
                     $('#searchflight_error').removeClass('hide');
                     setTimeout(function(){ $('#searchflight_error').addClass('hide'); }, 5000);                 
                  err_counter = 1;
                  break;
                }else{
                  $('#from_m_'+k).removeClass('invalid-ip');
                }
                if(loc_id_t==''){
                  $('#to_m_'+k).focus();
                  $('#to_m_'+k).addClass('invalid-ip');
                   // alert("To location can't be empty");
                   $('#searchflight_error').html("To location can't be empty");
                     $('#searchflight_error').removeClass('hide'); 
                     setTimeout(function(){ $('#searchflight_error').addClass('hide'); }, 5000);
                  err_counter = 1;
                  break;
                  
                }else{
                  $('#to_m_'+k).removeClass('invalid-ip');
                }

                if(loc_id_f == loc_id_t){
                  // alert("from location and to location should be different");
                  $('#searchflight_error').html("from location and to location should be different");
                     $('#searchflight_error').removeClass('hide'); 
                     setTimeout(function(){ $('#searchflight_error').addClass('hide'); }, 5000);
                  $('#to_m_'+k).focus();
                  err_counter = 1;
                  break;
                }
                if(depart_t==''){
                 
                  $('#depature_m_'+k).focus();
                  $('#depature_m_'+k).addClass('invalid-ip');
                   // alert("departure date can't be empty"); 
                   $('#searchflight_error').html("departure date can't be empty");
                     $('#searchflight_error').removeClass('hide');  
                     setTimeout(function(){ $('#searchflight_error').addClass('hide'); }, 5000);                
                  err_counter = 1;
                  break;
                }else{
                  $('#depature_m_'+k).removeClass('invalid-ip');
                  $('#flight').submit();
                }
              }
                 var depart_t_0 = $('#depature_m_0').val(); 
                 var depart_t_1 = $('#depature_m_1').val();
           if(depart_t_0==''){
                 
                  $('#depature_m_0').focus();
                  $('#depature_m_0').addClass('invalid-ip');
                   //alert("departure date can't be empty");                  
                  return false;
                }else{
                  $('#depature_m_0').removeClass('invalid-ip');
                  $('#flight').submit();
                }
                if(depart_t_1==''){
                 
                  $('#depature_m_1').focus();
                  $('#depature_m_1').addClass('invalid-ip');
                   //alert("departure date can't be empty");                  
                  return false;
                }else{
                  $('#depature_m_1').removeClass('invalid-ip');
                  $('#flight').submit();
                }
            }
          }else{
            // alert("please select from location and to location");
            $('#searchflight_error').html("please select from location and to location");
            $('#searchflight_error').removeClass('hide'); 
            setTimeout(function(){ $('#searchflight_error').addClass('hide'); }, 5000);
            err_counter = 1;
          }
        }
         // alert(err_counter);
          

          
          var _from_loc_id = $('#flight #from_loc_id').val();
          var _to_loc_id = $('#flight #to_loc_id').val();

          if(parseInt(_from_loc_id)==0 || parseInt(_to_loc_id)==0 ){
            // alert("Please check the location");
            $('#searchflight_error').html("Please check the location");
            $('#searchflight_error').removeClass('hide'); 
            setTimeout(function(){ $('#searchflight_error').addClass('hide'); }, 5000);
             return false;
          }
          if(err_counter>0){
            return false;
          }else{
            return true;
          }
      
      });
      //car validation
      $("#car").submit(function(){
        

        var pickup_time = $("#drop_down_time1").val();
        var drop_time = $("#drop_out_time2").val();

        
        var trip_type = $("#trip_type_car").val();
        
        if(trip_type=='diff_loc'){
          var _from_loc  = $("#pick_up_loc").val();
          var _to_loc = $("#drop_down_loc").val();
          if(_from_loc==_to_loc){
              alert('From location and To location cannot be same');
              return false;
          }
        }
        if($("#car_pickup_date").val()==''){
          $("#car_pickup_date").addClass('invalid-ip');
          $("#car_pickup_date").datepicker('show');
          return false;
        }else{
          $("#car_pickup_date").removeClass('invalid-ip');
        }
        if($("#car_dropdown_date").val()==''){
           $("#car_dropdown_date").addClass('invalid-ip');
           $("#car_dropdown_date").datepicker('show');
           return false;
        }else{
          $("#car_dropdown_date").removeClass('invalid-ip');
        }
        if($("#car_pickup_date").val()==$("#car_dropdown_date").val()){

          if(drop_time > pickup_time){
            
          }else{
            $("#drop_out_time2").addClass('invalid-ip');
            alert('Drop time should be greater than pickup time');
            return false;
          }

        }

        
      });

           $("#depature_m_0").datepicker({
                               // changeMonth: true,
                               //  changeYear:true,
                                dateFormat : 'M d,yy',
                                numberOfMonths: 1,
                                minDate:0,
                                 onChange : function(){
     },
         onSelect: function( selectedDate ) {
          $( "#depature_m_1" ).datepicker( "option", "minDate", selectedDate );
          var type = $("#trip_type").val();
          assign_source();
          //console.log(type);
          //$( '#return' ).focus();
             //$( '#return' ).focus();
         }
            });


});
 function add_days_to_date_night(from_date, number_of_days) {
  var from_date =  $.datepicker.formatDate('dd-mm-yy', new Date(from_date));

 // console.log("from_date"+from_date);
        from_date = from_date.split('-');
        var to_date = new Date(from_date[2], parseInt(from_date[1]) - 1, (parseInt(from_date[0]) + number_of_days));
        month = '' + (to_date.getMonth() + 1), day = '' + to_date.getDate(), year = to_date.getFullYear();
        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
        return [day, month, year].join('-')
    }

    function activites_total_pax_count(form_id) {
    if (form_id != '') {
        var pax_count = $('input.pax_count_value', 'form#' + form_id + ' div.pax_count_div').map(function() {
            if (this.value != '') {
                return parseInt(this.value)
            }
        }).get();
        var total_pax_count = 0;
        $.each(pax_count, function() {
            total_pax_count += this
        });
        $("#total_pax_count").val(total_pax_count);
    }
}

function total_pax_count(form_id) {
   // alert(form_id);
    if (form_id != '') {
        var pax_count = $('input', 'form#' + form_id + ' div.pax_count_div1').map(function() {
            if (this.value != '') {
                return parseInt(this.value)
            }
        }).get();
        var total_pax_count = 0;
        console.log(pax_count);
        $.each(pax_count, function() {

            total_pax_count += this

            // alert(total_pax_count);
         
        });
        if (total_pax_count > 1) {
            $('#travel_text').text('Travelers');
        } else {
            $('#travel_text').text('Traveler');
        }
        $('.total_pax_count', 'form#' + form_id).empty().text(total_pax_count)
    }
}


 
