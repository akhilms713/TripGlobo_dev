$(document).ready(function() {
    
    window.process_result_update = function(result)
    {
    $('.loader-image').hide();
		//hide_result_pre_loader();
		if ( result.status == true) {
			$('#bus_search_result').html(result.data);
			  update_filter();
			  update_total_count_summary();
		} else {
			update_total_count_summary();
			check_empty_search_result();
		}
    };
    $(document).ready(function(){
      $('#fare_bus_asc').addClass('active');
      $('.fare_bus').addClass('active');

    });
     $(document).on('click', '.seats_available', function(){
     	 $('.depart_sort').removeClass('active');	
      $('#depart_sort_dec').removeClass('active');	
      $('#depart_sort_asc').removeClass('active');	
      $('#depart_sort_asc').removeClass('hide');	
      $('#depart_sort_dec').addClass('hide');	

      $('.fare_bus').removeClass('active');	
      $('#fare_bus_dec').removeClass('active');	
      $('#fare_bus_asc').removeClass('active');	
      $('#fare_bus_asc').removeClass('hide');	
      $('#fare_bus_dec').addClass('hide');

      $('.arrival_time').removeClass('active');	
      $('#arrival_time_dec').removeClass('active');	
      $('#arrival_time_asc').removeClass('active');	
      $('#arrival_time_asc').removeClass('hide');	
      $('#arrival_time_dec').addClass('hide');

     if ( $('.seats_available').hasClass('active')== true && $('#seats_available_asc').hasClass('active')== true) {
     		$('.seats_available').addClass('active');
      $('#seats_available_dec').addClass('active');
      $('#seats_available_dec').removeClass('hide');
      $('#seats_available_asc').removeClass('active');
      $('#seats_available_asc').addClass('hide');
      //filter
      jSort_filter('addtionl_seat_filter','desc');
     
     	}else{
     	$('.seats_available').addClass('active');
      $('#seats_available_asc').addClass('active');
      $('#seats_available_asc').removeClass('hide');
      $('#seats_available_dec').addClass('hide');
      $('#seats_available_dec').removeClass('active');
      $('#seats_available_dec').addClass('active');
      //filter
      jSort_filter('addtionl_seat_filter','asc');
   
     	}  
     });
     $(document).on('click', '.arrival_time', function(){
     	 $('.depart_sort').removeClass('active');	
      $('#depart_sort_dec').removeClass('active');	
      $('#depart_sort_asc').removeClass('active');	
      $('#depart_sort_asc').removeClass('hide');	
      $('#depart_sort_dec').addClass('hide');	

      $('.fare_bus').removeClass('active');	
      $('#fare_bus_dec').removeClass('active');	
      $('#fare_bus_asc').removeClass('active');	
      $('#fare_bus_asc').removeClass('hide');	
      $('#fare_bus_dec').addClass('hide');

      $('.seats_available').removeClass('active');	
      $('#seats_available_dec').removeClass('active');	
      $('#seats_available_asc').removeClass('active');	
      $('#seats_available_asc').removeClass('hide');	
      $('#seats_available_dec').addClass('hide');

     if ( $('.arrival_time').hasClass('active')== true && $('#arrival_time_asc').hasClass('active')== true) {
     		$('.arrival_time').addClass('active');
      $('#arrival_time_dec').addClass('active');
      $('#arrival_time_dec').removeClass('hide');
      $('#arrival_time_asc').removeClass('active');
      $('#arrival_time_asc').addClass('hide');
      //filter
      jSort_filter('arrivaltime_datetime_filter','desc');
     
     	}else{
     	$('.arrival_time').addClass('active');
      $('#arrival_time_asc').addClass('active');
      $('#arrival_time_asc').removeClass('hide');
      $('#arrival_time_dec').addClass('hide');
      $('#arrival_time_dec').removeClass('active');
      $('#arrival_time_dec').addClass('active');
      //filter
      jSort_filter('arrivaltime_datetime_filter','asc');
   
     	}  
     });
      $(document).on('click', '.fare_bus', function(){
      $('.depart_sort').removeClass('active');	
      $('#depart_sort_dec').removeClass('active');	
      $('#depart_sort_asc').removeClass('active');	
      $('#depart_sort_asc').removeClass('hide');	
      $('#depart_sort_dec').addClass('hide');	

      $('.arrival_time').removeClass('active');	
      $('#arrival_time_dec').removeClass('active');	
      $('#arrival_time_asc').removeClass('active');	
      $('#arrival_time_asc').removeClass('hide');	
      $('#arrival_time_dec').addClass('hide');

      $('.seats_available').removeClass('active');	
      $('#seats_available_dec').removeClass('active');	
      $('#seats_available_asc').removeClass('active');	
      $('#seats_available_asc').removeClass('hide');	
      $('#seats_available_dec').addClass('hide');
      	 
     	if ( $('.fare_bus').hasClass('active')== true && $('#fare_bus_asc').hasClass('active')== true) {
     		$('.fare_bus').addClass('active');
      $('#fare_bus_dec').addClass('active');
      $('#fare_bus_dec').removeClass('hide');
      $('#fare_bus_asc').removeClass('active');
      $('#fare_bus_asc').addClass('hide');
      jSort_filter('price-order','desc');
        
     	}else{
     	$('.fare_bus').addClass('active');
      $('#fare_bus_asc').addClass('active');
      $('#fare_bus_asc').removeClass('hide');
      $('#fare_bus_dec').addClass('hide');
      $('#fare_bus_dec').removeClass('active');
      $('#fare_bus_dec').addClass('active');
      jSort_filter('price-order','asc');
        
     	}  

     });
    $(document).on('click', '.depart_sort', function(){
        $('.fare_bus').removeClass('active');	
      $('#fare_bus_dec').removeClass('active');	
      $('#fare_bus_asc').removeClass('active');	
      $('#fare_bus_asc').removeClass('hide');	
      $('#fare_bus_dec').addClass('hide');	

      $('.arrival_time').removeClass('active');	
      $('#arrival_time_dec').removeClass('active');	
      $('#arrival_time_asc').removeClass('active');	
      $('#arrival_time_asc').removeClass('hide');	
      $('#arrival_time_dec').addClass('hide');

      $('.seats_available').removeClass('active');	
      $('#seats_available_dec').removeClass('active');	
      $('#seats_available_asc').removeClass('active');	
      $('#seats_available_asc').removeClass('hide');	
      $('#seats_available_dec').addClass('hide');

     	if ( $('.depart_sort').hasClass('active')== true && $('#depart_sort_asc').hasClass('active')== true) {
     		$('.depart_sort').addClass('active');
      $('#depart_sort_dec').addClass('active');
      $('#depart_sort_dec').removeClass('hide');
      $('#depart_sort_asc').removeClass('active');
      $('#depart_sort_asc').addClass('hide');
       jSort_filter('departure_datetime_filter','desc');
     	}else{
     	$('.depart_sort').addClass('active');
      $('#depart_sort_asc').addClass('active');
      $('#depart_sort_asc').removeClass('hide');
      $('#depart_sort_dec').addClass('hide');
      $('#depart_sort_dec').removeClass('active');
      $('#depart_sort_dec').addClass('active');
       jSort_filter('departure_datetime_filter','asc');
     	}
     
     });
	$(".time-category").click(function () {
     filter_row_origin_marker();
    });
    function jSort_filter(sort_by,order){
        $("#bus_search_result").jSort({
        sort_by: '.'+sort_by,
        item: '.r-r-i',
        order: order,
        is_num: true
      })
    }
   
    $(document).on('click', '#reset_filters', function() {
    	window.location.reload(true)
		// loader();
		// var minPrice = $('#core_minimum_range_value', '#core_min_max_slider_values').val();
		// var maxPrice = $('#core_maximum_range_value', '#core_min_max_slider_values').val();
		// $("#slider-range-1").slider("option", "values", [minPrice, maxPrice]);		
		// $(".ui-slider-range").css("width","100%");
		// $(".ui-slider-handle:nth-child(3)").css("left","100%");		
		// $('input.bus-type-box, input.time-category, input.travel-box').prop('checked', false);		
		// $('.enabled','#departureTimeWrapper','.time-wrapper').removeClass('active');
		// $('.enabled','#arrivalTimeWrapper').removeClass('active');
	// 	$('.fare_bus').removeClass('active');	
      // $('#fare_bus_dec').removeClass('active');	
      // $('#fare_bus_asc').removeClass('active');	
      // $('#fare_bus_asc').removeClass('hide');	
      // $('#fare_bus_dec').addClass('hide');	

      // $('.arrival_time').removeClass('active');	
      // $('#arrival_time_dec').removeClass('active');	
      // $('#arrival_time_asc').removeClass('active');	
      // $('#arrival_time_asc').removeClass('hide');	
      // $('#arrival_time_dec').addClass('hide');

      // $('.seats_available').removeClass('active');	
      // $('#seats_available_dec').removeClass('active');	
      // $('#seats_available_asc').removeClass('active');	
      // $('#seats_available_asc').removeClass('hide');	
      // $('#seats_available_dec').addClass('hide');

      //  $('.depart_sort').removeClass('active');	
      // $('#depart_sort_dec').removeClass('active');	
      // $('#depart_sort_asc').removeClass('active');	
      // $('#depart_sort_asc').removeClass('hide');	
      // $('#depart_sort_dec').addClass('hide');

      // $('#fare_bus_asc').addClass('active');
      // $('.fare_bus').addClass('active');

	// 	jSort_filter('price-order','asc');
		// set_slider_label(min_amt, max_amt);		
		// filter_row_origin_marker(min_amt, max_amt);
	});
    
	function filter_row_origin_marker(min_amt='', max_amt='')
	{
		loader();
		visibility = '';
		//get all the search criteria
		var deptimeList = $('.time-category:checked:not(:disabled)', '#departureTimeWrapper').map(function() {
			return parseInt(this.value);
		}).get();
		var arrtimeList = $('.time-category:checked:not(:disabled)', '#arrivalTimeWrapper').map(function() {
			return parseInt(this.value);
		}).get();
		if (min_amt!='' && max_amt!='') {
         var min_price=min_amt;
         var max_price=max_amt;
		}else{			
		var min_price = parseFloat($("#slider-range-1").slider("values")[0]);
		var max_price = parseFloat($("#slider-range-1").slider("values")[1]);
		}
		$('.r-r-i'+visibility).each(function(key, value) {
		var price = $('.bus_price:first', this).data('price');
		
			//
			if (
				((deptimeList.length == 0) || ($.inArray(parseInt($('.departure_datetime:first', this).data('departure-category')), deptimeList) != -1)) &&
				((arrtimeList.length == 0) || ($.inArray(parseInt($('.arrival_datetime:first', this).data('arrival-category')), arrtimeList) != -1)) &&
				(parseFloat($('.bus_price:first', this).data('price')) >= min_price && parseFloat($('.bus_price:first', this).data('price')) <= max_price)
			) {
				$(this).show();
		} else {
			$(this).hide();
		}
	});
		update_total_count_summary();
	}
	
	function update_total_count_summary()
	{
		$('#bus_search_result').show();
		var _visible_records = parseInt($('.r-r-i:visible').length);
		var _total_records = $('.r-r-i').length;
		if (isNaN(_visible_records) == true || _visible_records == 0) {
			_visible_records = 0;
			//display warning
			$('#bus_search_result').hide();
			$('#empty_bus_search_result').show();
		} else {
			$('#bus_search_result').show();
			$('#empty_bus_search_result').hide();
		}
		if (_visible_records > 1) {
			_visible_records = _visible_records+' Buses ';
		} else {
			_visible_records = _visible_records+' Bus ';
		}
		$('#total_records').text(_visible_records+' Found');
		$('.visible-row-record-count').text(_visible_records);
		$('.total-row-record-count').text(_total_records);
	}
	
	function loader(selector)
	{
		selector = selector || '#bus_search_result';
		$(selector).animate({'opacity':'.1'});
		setTimeout(function() {$(selector).animate({'opacity':'1'}, 'slow');}, 1000);
	}
	
	function update_filter()
	{
		var departureCategoryList = {};
		var arrivalCategoryList = {};

        
		var minPrice = 0;
		var maxPrice = 0;

		var price = 0;
		var dep_time = 0;
		var arr_time = 0;
		if($('.price-order').html().length!=0){
		var minPrice = 9999999;
		}
		
		$('.r-r-i').each(function(key, value) {
			price = parseFloat($('.bus_price:first', this).data('price'));
			depCat = parseInt($('.departure_datetime:first', this).data('departure-category'));
			arrCat = parseInt($('.arrival_datetime:first', this).data('arrival-category'));
			
			if (departureCategoryList.hasOwnProperty(depCat) == false) {departureCategoryList[depCat] = depCat;}
			if (arrivalCategoryList.hasOwnProperty(arrCat) == false) {arrivalCategoryList[arrCat] = arrCat;}
			if (price < minPrice) {minPrice = price;}
			if (price > maxPrice) {maxPrice = price;}
		});
		enable_price_range_slider(minPrice, maxPrice);
		
	}
	
	var sliderCurrency = 'INR';//document.getElementById('pri_slider_currency').value;
	var min_amt = 0;
	var max_amt = 0;
	function enable_price_range_slider(minPrice, maxPrice)
	{
		min_amt = minPrice;
		max_amt = maxPrice;
		
		$( "#slider-range-1" ).slider({
			range: true,
			min: minPrice,
			max: maxPrice,
			animate: "slow",
			values: [ minPrice, maxPrice ],
			slide: function(event, ui) {
				set_slider_label(ui.values[ 0 ], ui.values[ 1 ]);
			},
			change: function(event, ui) {
				if (parseFloat(ui.values[0]) == min_amt) {
					if (parseFloat(ui.values[1]) > max_amt) {
						visibility = ':hidden';
					} else {
						visibility = ':visible';
					}
				} else {
					if (parseFloat(ui.values[0]) < min_amt) {
						visibility = ':hidden';
					} else {
						visibility = ':visible';
					}
				}
				filter_row_origin_marker(visibility);
			}
		});
		set_slider_label(minPrice, maxPrice);
	}
	
	function set_slider_label(val1, val2)
	{
		$( "#amount" ).text( sliderCurrency + val1 + " - "+ sliderCurrency + val2);
	}
	

	function check_empty_search_result()
	{
		if ($('.r-r-i:first').index() == -1) {
			$('#empty-search-result').show();
			$('#page-parent').hide();
		}
	}
	});
