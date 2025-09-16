$("#get_cheapest_flight").click(function(){
    $('a.stop_one').addClass('active');
      $('#stop_1_v').prop('checked', true);
      $('a.stop_mul').addClass('active');
      $('#stop_m_v').prop('checked', true);
      $('a.stopzero').addClass('active');
      $('#stop_0_v').prop('checked', true);
      $('#price_sort').addClass('des');
      $('.filter_airline').prop('checked',false);  
      $('.filter_con_air').prop('checked',false);
      
      
    filter();
  });
$("#get_non_stop_flight").click(function(){
    if(! $('a.stopzero').hasClass('active')){
      $('a.stopzero').addClass('active');
        $('#stop_0_v').prop('checked', true);
    }
    if($('a.stop_one').hasClass('active')){
      $('a.stop_one').removeClass('active');
        $('#stop_1_v').prop('checked', false);
    }
    if($('a.stop_mul').hasClass('active')){
      $('a.stop_mul').removeClass('active');
      $('#stop_m_v').prop('checked', false);
    }
    if($('div.notflexible').hasClass('hide')){
      $('div.notflexible').removeClass('hide');
      $("div.col70").css('width','70%');
    }
    filter();
  });
  $("#slider-range").on("click",function(){
    var val = $("#amount").val();
    filter();
  });
//   $(document).ready(function() {
//   if ($("#slider-range a").hasClass("ui-state-focus")) {
//     filter();
// }
//   });



$(document).on("click",".filter_airline",function() {
  filter();
});

$(document).on("click",".filter_con_air",function() {

  filter();
});

  $(document).on("click",".prefer",function() {


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

$(".stopone").mouseup(function(){
  if($(this).attr('type') == '0')
  {
     if ($('#stop_0_v').is(':checked')) 
     {
      $('#stop_0_v').prop('checked', false);
     }
     else
     {
      $('#stop_0_v').prop('checked', true);
     }
  }

if($(this).attr('type') == '1')
  {
     if ($('#stop_1_v').is(':checked')) 
     {
      $('#stop_1_v').prop('checked', false);

     }
     else
     {
      $('#stop_1_v').prop('checked', true);
     }
  }
  if($(this).attr('type') == 'm')
  {
     if ($('#stop_m_v').is(':checked')) 
     {
      $('#stop_m_v').prop('checked', false);

     }
     else
     {
      $('#stop_m_v').prop('checked', true);
     }
  }
    filter();
});


  $(".filter_arrive_btn").mouseup(function(){

      if($(this).attr('type') == '12_6A')
      {
          if ($('#12_6A_A').is(':checked'))
          {
              $('#12_6A_A').prop('checked', false);
          }
          else
          {
              $('#12_6A_A').prop('checked', true);
          }
      }

      if($(this).attr('type') == '6_12A')
      {
          if ($('#6_12A_A').is(':checked'))
          {
              $('#6_12A_A').prop('checked', false);

          }
          else
          {
              $('#6_12A_A').prop('checked', true);
          }
      }
      if($(this).attr('type') == '12_6P')
      {
          if ($('#12_6P_A').is(':checked'))
          {
              $('#12_6P_A').prop('checked', false);

          }
          else
          {
              $('#12_6P_A').prop('checked', true);
          }
      }

      if($(this).attr('type') == '6_12P')
      {
          if ($('#6_12P_A').is(':checked'))
          {
              $('#6_12P_A').prop('checked', false);

          }
          else
          {
              $('#6_12P_A').prop('checked', true);
          }
      }

      filter();
  });


$(".filter_depart_btn").mouseup(function(){

  if($(this).attr('type') == '12_6A')
  {
     if ($('#12_6A_D').is(':checked')) 
     {
      $('#12_6A_D').prop('checked', false);
     }
     else
     {
      $('#12_6A_D').prop('checked', true);
     }
  }

if($(this).attr('type') == '6_12A')
  {
     if ($('#6_12A_D').is(':checked')) 
     {
      $('#6_12A_D').prop('checked', false);

     }
     else
     {
      $('#6_12A_D').prop('checked', true);
     }
  }
  if($(this).attr('type') == '12_6P')
  {
     if ($('#12_6P_D').is(':checked')) 
     {
      $('#12_6P_D').prop('checked', false);

     }
     else
     {
      $('#12_6P_D').prop('checked', true);
     }
  }

  if($(this).attr('type') == '6_12P')
  {
     if ($('#6_12P_D').is(':checked')) 
     {
      $('#6_12P_D').prop('checked', false);

     }
     else
     {
      $('#6_12P_D').prop('checked', true);
     }
  }

   filter();
});


$(".filter_return_btn").mouseup(function(){

  if($(this).attr('type') == '12_6A')
  {
     if ($('#12_6A_R').is(':checked')) 
     {
      $('#12_6A_R').prop('checked', false);
     }
     else
     {
      $('#12_6A_R').prop('checked', true);
     }
  }

if($(this).attr('type') == '6_12A')
  {
     if ($('#6_12A_R').is(':checked')) 
     {
      $('#6_12A_R').prop('checked', false);

     }
     else
     {
      $('#6_12A_R').prop('checked', true);
     }
  }
  if($(this).attr('type') == '12_6P')
  {
     if ($('#12_6P_R').is(':checked')) 
     {
      $('#12_6P_R').prop('checked', false);

     }
     else
     {
      $('#12_6P_R').prop('checked', true);
     }
  }

  if($(this).attr('type') == '6_12P')
  {
     if ($('#6_12P_R').is(':checked')) 
     {
      $('#6_12P_R').prop('checked', false);

     }
     else
     {
      $('#6_12P_R').prop('checked', true);
     }
  }

  filter();
});

$(".filter_airline").mouseup(function(){ 
	
});

$(".filter_con_air").mouseup(function(){ 
	
});
function filter()
{
	
//	alert('hi');
   var sorting_type ;
   var sorting_value;
   $(".sorta").each(function(){
      if ($(this).attr('class').match(/active|des/)) 
      {
          sorting_type = $(this).attr('type');
          sorting_value = $(this).attr('val');
      } 
    });
	 //alert(sorting_type+" "+sorting_value);
    var data = {};
    var sort = {};
    var stops = [];
    var arrive_time = [];
    var depart_time = [];
    var return_time = [];
    var session_id  = $("#session_id").val();
    var prefer = [];
// alert($("#amount").val());
    data['amount'] = $("#amount").val();
    sort['column'] = sorting_type;
    sort['value'] = sorting_value;
    data['sort'] = sort;
    
    var matches = [];
    $(".filter_airline:checked").each(function() {
        matches.push(this.value);
    });
    data['airline'] = matches;

    var con_air = [];
    $(".filter_con_air:checked").each(function() {
        con_air.push(this.value);
    });
    data['con_air'] = con_air;


    $(".filter_stop:checked").each(function() {
        stops.push(this.value);
    });

    data['stops'] = stops;

    $(".filter_arrive:checked").each(function() {
        arrive_time.push(this.value);
    });

    data['arrive_time'] = arrive_time;

   $(".filter_depart:checked").each(function() {
        depart_time.push(this.value);
    });

    data['depart_time'] = depart_time;

    $(".prefer:checked").each(function() {
        if(this.value == 'refund')
            ref_type = 'R';
        else
            ref_type = 'NR';
        prefer.push(ref_type);
    });

    data['prefer'] = prefer;

    $(".filter_return:checked").each(function() {
        return_time.push(this.value);
    });
    //console.log(return_time);
    data['return_time'] = return_time;

    $.ajax({
    type:'POST', 
    url: WEB_URL+'flight/ajaxPaginationData/'+session_id,
    data: { filter: JSON.stringify(data) },
    beforeSend: function(XMLHttpRequest){
      $('.flight_fliter_loader').removeClass('hide');
      $('.flights').addClass('hide');
      }, 
      success: function(response) {
      $('.flights').html(response);
      window.scrollTo(500, 10);
       $('.flight_fliter_loader').addClass('hide');
        $('.flights').removeClass('hide');
      }
    });
} 

$(document).on("click",".pricedates",function() {
    console.log($("#amount").val());
  var sorting_type ;
   var sorting_value;
   $(".sorta").each(function(){
      if ($(this).attr('class').match(/active|des/)) 
      {
          sorting_type = $(this).attr('type');
          sorting_value = $(this).attr('val');
      } 
    });

    var data = {};
    var sort = {};
    var stops = [];
    var arrive_time = [];
    var depart_time = [];
    var return_time = [];
    var session_id  = $("#session_id").val();
    var prefer = [];

    data['amount'] = $("#amount").val();
    sort['column'] = sorting_type;
    sort['value'] = sorting_value;
    data['sort'] = sort;
    
    var matches = [];
    if($(this).attr('id') != 'all'){
        matches.push($(this).attr('id'));
    };
    data['airline'] = matches;

    var con_air = [];
    $(".filter_con_air:checked").each(function() {
        con_air.push(this.value);
    });
    data['con_air'] = con_air;

    $(".filter_stop:checked").each(function() {
        stops.push(this.value);
    });

    data['stops'] = stops;

    $(".filter_arrive:checked").each(function() {
        arrive_time.push(this.value);
    });

    data['arrive_time'] = arrive_time;

   $(".filter_depart:checked").each(function() {
        depart_time.push(this.value);
    });

    data['depart_time'] = depart_time;

    $(".filter_return:checked").each(function() {
        return_time.push(this.value);
    });

    data['return_time'] = return_time;

    $(".prefer:checked").each(function() {
        if(this.value == 'refund')
            ref_type = 'R';
        else
            ref_type = 'NR';
        prefer.push(ref_type);
    });

    data['prefer'] = prefer;

    $.ajax({
    type:'POST', 
    url: WEB_URL+'flight/ajaxPaginationData/'+session_id,
    data: { filter: JSON.stringify(data) },
    beforeSend: function(XMLHttpRequest){
      $('.flight_fliter_loader').removeClass('hide');
      $('.flights').addClass('hide');
      //$('.flight_fliter_loader').fadeIn();
      }, 
      success: function(response) {
      $('.flights').html(response);
        window.scrollTo(500, 10);
       $('.flight_fliter_loader').addClass('hide');
        $('.flights').removeClass('hide');
       //$('.flight_fliter_loader').fadeOut();
      }
    });
   
});
 $('.flight_filter_reset').click(function() {
   
    
    //$('.filter_arrive').attr('checked', false);
    $('.toglefil').attr('checked', false);
    $('.filter_depart').attr('checked', false);
    //$('.filter_arrive').attr('checked', false);
    
    $('.filter_airline').attr('checked', false);
    $('.filter_con_air').attr('checked', false);
    $('#stop_1_v').attr('checked', false);
    $('#stop_m_v').attr('checked', false);
    $('#stop_0_v').attr('checked', false);
    $('.active').attr('checked', false);
    $('.toglefil').removeClass('active');
    

    var amount =$('#amount_min_').val();
    $('#amount').val(amount);
    //$('#stop_1_v').attr('checked', false);
    //HotelName
    //$('#hotel-name').val(''); //Hotel Name
  
    filter();
});


