  // $("#slider-range").click(function(){
  //   
  //   var val = $("#amount").val();
  //   filter();
  // });

   $("#slider-range").on("slidestop", function(event, ui) {
      var val = $("#amount").val();
      filter();
       /* endPos = ui.value;
        alert($("#amount").val());
        alert(endPos);
        if (startPos != endPos) {
            // do stuff
        }

        startPos = endPos;*/
    });



  // $("#slider-range").change(function(){
  //   alert("calrerr");
  //   var val = $("#amount").val();
  //   filter();
  // });


$(document).on("click",".filter_airline",function() {
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

function filter()
{
	
	//alert();
  //alert("caleed");
   var sorting_type ;
   var sorting_value;
   $(".sorta").each(function(){
      if ($(this).attr('class').match(/active|des/)) 
      {
          sorting_type = $(this).attr('type');
          sorting_value = $(this).attr('val');
      } 
    });
	// alert(sorting_type+" "+sorting_value);
    var data = {};
    var sort = {};
    var stops = [];
    var depart_time = [];
    var return_time = [];
    var session_id  = $("#session_id").val();

    data['amount'] = $("#amount").val();
    sort['column'] = sorting_type;  
    sort['value'] = sorting_value; 
    data['sort'] = sort; 
    var matches = [];
    $(".filter_airline:checked").each(function() {
        matches.push(this.value);
    });
    data['airline'] = matches; 
    $.ajax({
    type:'POST', 
    url: WEB_URL+'car/ajaxPaginationData/'+session_id,
    data: { filter: JSON.stringify(data) },
    beforeSend: function(XMLHttpRequest){
      $('.flight_fliter_loader').fadeIn();
      }, 
      success: function(response) {
       // console.log(response);
      $('.flights').html(response);
      window.scrollTo(500, 10);
       $('.flight_fliter_loader').fadeOut();
      }
    });



} 	

