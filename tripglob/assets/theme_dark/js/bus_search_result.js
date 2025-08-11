$(document).ready(function() {
// show_result_pre_loader();
// pre_load_audio();
app_base_url = $('#baseUrl').val();

});
/*****Buss code******/ 

$(document).ready(function() {
// show_result_pre_loader();
// pre_load_audio();
app_base_url = $('#baseUrl').val();
window.process_result_update = function(result)
{
$('.loader-image').hide();
				hide_result_pre_loader();
				// console.log(result);
				// result.hasOwnProperty('status') == true &&
				if ( result.status == true) {
					// console.log(result.data);
					$('#bus_search_result').html(result.data);
					// post_load_audio();
					//update total bus count
					// update_filter();
					// update_total_count_summary();
				} else {
					update_total_count_summary();
					check_empty_search_result();
				}
};
 
	function check_empty_search_result()
	{
		if ($('.r-r-i:first').index() == -1) {
			$('#empty-search-result').show();
			$('#page-parent').hide();
		}
	}

	/**
	*Update Count Details
	*/
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

	//activate bus booking
	$(document).on('click', '.inner-summary-btn', function(e) {

		e.preventDefault();
		$('.selsect_seat-hidden').removeClass("in");
		$('.selected_seats').html('');
        $('.selected_amount').html('');
        $(".seat_layout_li").removeClass('opacity_cls');
        $(".seat_layout_li").closest('li').removeClass('back_green_clr');
        $(".seat_layout_li").closest('li').attr('data-price',''); 
        $(".seat_layout_li").closest('li').attr('data-name_index',''); 
        $(".seat_layout_li").closest('li').attr('data-response','');
        
        $('.bording_drop-hidden').removeClass("in");
        $('.cancellation_policy_hidden').removeClass("in");
		var _inner_summary_toggle = $('.inner-summary-toggle', $(this).closest('.r-r-i'));
		_inner_summary_toggle.toggle();

		//update data if visible
		// console.log(_inner_summary_toggle);
		/*console.log(_inner_summary_toggle);
	
		console.log($(this).closest('form').serializeArray());*/
		data_index = $(this).attr("data-index");

			//  $('.bus_seat_loader'+data_index).show();
		 // setTimeout(function() {
	  //      $('.bus_seat_loader'+data_index).hide();
		 // 	// $('.ss').removeClass('bus_seat_loader'+data_index);
	  //    }, 5000);

          
		// console.log(data_index);
		if (_inner_summary_toggle.is(':visible')) {
			//load data
	
			get_inner_bus_details($(this).closest('form').serializeArray(), _inner_summary_toggle, data_index);
			$('.bus_seat_loader'+data_index).hide();

		} else {
	
			$('.room-summ', _inner_summary_toggle).html('').hide();

			$('.loader-image', _inner_summary_toggle).show();

           
		}
	});

$(document).on('click', '.bookNow-summary-btn', function(e) {

		e.preventDefault();
			$('.bording_drop-hidden').removeClass("in");
    	$('.cancellation_policy_hidden').removeClass("in");

		var _inner_summary_toggle = $('.inner-summary-toggle', $(this).closest('.r-r-i'));
		_inner_summary_toggle.toggle();
		// console.log(_inner_summary_toggle);
		var data_index = $(this).attr("data-index");

		if (_inner_summary_toggle.is(':visible')) {
			//load data
	
			get_inner_bus_details($(this).closest('form').serializeArray(), _inner_summary_toggle, data_index);
			$('.bus_seat_loader'+data_index).hide();

		} else {
	
			$('.room-summ', _inner_summary_toggle).html('').hide();

			$('.loader-image', _inner_summary_toggle).show();

           
		}
	});




	$(document).on('click', '.amenities-summary-btn', function(e) {
             
	});
 
 
	function get_inner_bus_details(params, result_row_index, data_index)
	{
		// alert(result_row_index);
		/*console.log(params);
		console.log(result_row_index);*/
		// console.log(result_row_index);
		$.ajax({
			type: 'POST',
			url: app_base_url+'index.php/bus/get_bus_details',
			async: true,
			cache: false,
			data: params,
			success: function(result) { 
				// console.log(result_row_index);
				/*console.log(result);
				console.log(result.data);*/
				var myArr = $.parseJSON(result);
				// console.log(myArr.data);
				// $('#select_seats_'+data_index).slideToggle("slow");
				$('#seat_'+data_index).html(myArr.data);
				$('#seat_'+data_index).show();
				$('.loader-image').hide();

				/*$('.room-summ', result_row_index).html(result);
				$('.room-summ', result_row_index).show();
				$('.loader-image', result_row_index).hide();*/
			}
		});
	}


	$(document).on('click', '.cancellation-policy-btn', function(e) {
		// console.log("sdasd");
		e.preventDefault();
// 		$('.cancellation_policy_hidden').show();
// 		$('.bording_drop-hidden').hide();
	$('.bording_drop-hidden').removeClass("in");
	$('.selsect_seat-hidden').removeClass("in");
		var _inner_summary_toggle = $('.inner-summary-toggle', $(this).closest('.r-r-i'));
// 		_inner_summary_toggle.hide();
// 		//update data if visible
// 		console.log(_inner_summary_toggle);
				data_index = $(this).attr("data-index");
// 		if (_inner_summary_toggle.is(':visible')) {
// 			//load data
            $('.room-summ', _inner_summary_toggle).html('').hide();
			$('.loader-image', _inner_summary_toggle).show();
		//	 get_cancellation_policy($(this).closest('form').serializeArray(), _inner_summary_toggle,data_index);
// 		} else {
			
// 		}
	});


	function get_cancellation_policy(params, result_row_index, data_index)
	{
		$.ajax({
			type: 'POST',
			url: app_base_url+'index.php/bus/get_cancellation_details',
			async: true,
			cache: false,
			data: params,
			success: function(result) { 
				 console.log(result);
				// var myArr = $.parseJSON(result);
				/*console.log(myArr);
				console.log(myArr.data);
*/
				console.log(result);
				
					// $('#boarding_'+data_index).slideToggle("slow");
					$('#cancelPolicy_'+data_index).html(result);
					// $('#cancelPolicy_'+data_index).show();
					$('.loader-image').hide();
				
			}
		});
	}

	$(document).on('click', '.amenities-summary-btn', function(e) {
		// console.log("sdasd");
		e.preventDefault();
		$(".cancellation_policy_hidden").hide();
		$('.bording_drop-hidden').hide();
		var _inner_summary_toggle = $('.inner-summary-toggle', $(this).closest('.r-r-i'));
		_inner_summary_toggle.toggle();
		//update data if visible
		console.log(_inner_summary_toggle);
		/*console.log(_inner_summary_toggle);
		console.log($(this).closest('form').serializeArray());*/
// 		if (_inner_summary_toggle.is(':visible')) {
			//load data
			get_inner_bus_details($(this).closest('form').serializeArray(), _inner_summary_toggle);
// 		} else {
			$('.room-summ', _inner_summary_toggle).html('').hide();
			$('.loader-image', _inner_summary_toggle).show();
// 		}
	});

	$(document).on('click', '.boarding-summary-btn', function(e) {
	//	console.log("sdasd");
		e.preventDefault();
	    $('.cancellation_policy_hidden').removeClass("in");
		$('.selsect_seat-hidden').removeClass("in");
	   // $('.bording_drop-hidden').show();
		//$(this).hasClass('active');
       //$(this).removeClass('active');
    $(this).siblings('.new_addtionl_textz_x').slideUp(200);
		//$('.room-summ').hide();
		var _inner_summary_toggle = $('.inner-summary-toggle', $(this).closest('.r-r-i'));
		_inner_summary_toggle.hide();
		//update data if visible
		// console.log(_inner_summary_toggle);
		// console.log($(this).closest('form').serializeArray());
		data_index = $(this).attr("data-index");
		
// 		if (_inner_summary_toggle.is(':visible')) {
			//load data
			$('.room-summ', _inner_summary_toggle).html('').hide();
			$('.loader-image', _inner_summary_toggle).show();
			get_boadrding_details($(this).closest('form').serializeArray(), _inner_summary_toggle, data_index);
			//	$('.bus_seat_loader'+data_index).hide();
// 		} else {
			
// 		}
	});
	


	function get_boadrding_details(params, result_row_index, data_index)
	{
		// alert(result_row_index);
		/*console.log(params);
		console.log(result_row_index);*/
		//params='+params+'&result_row_index='+result_row_index
		$.ajax({
			type: 'POST',
			url: app_base_url+'index.php/bus/get_boadrding_details',
			async: true,
			cache: false,
			data: params,
			success: function(result) { 
				// console.log(result);
				var myArr = $.parseJSON(result);
				/*console.log(myArr);
				console.log(myArr.data);
*/
				// console.log(result.data);
				
					// $('#boarding_drop_points', result_row_index).html(result.data);
					/*$('.boarding_drop_points').html(myArr.data);
					 $('.bording_drop-hidden').slideToggle("slow");*/
				// 	$('#boarding_'+data_index).slideToggle("slow");
					$('#drop_'+data_index).html(myArr.data);
				// 	$('#drop_'+data_index).show();
					$('.loader-image').hide();
					// $('#boarding_drop_points', result_row_index).show();
					// $('.loader-image', result_row_index).hide();
			}
		});
	}

	//activate bus booking
	$(document).on('click', '.bus-info-btn', function(e) {
		e.preventDefault();
		//update data if visible
		//load data
		clean_up_info_modal();
		var _bus_info_data = get_inner_bus_information($('.book-form', $(this).closest('.r-r-i')).serializeArray());
	});

	function clean_up_info_modal()
	{
		$('#bus-info-modal-content ').empty();
		$('#bus-info-modal .loader-image').show();
		$('#bus-info-modal').modal();
	}
	function get_inner_bus_information(params)
	{
		$.ajax({
			type: 'POST',
			url: app_base_url+'index.php/ajax/get_bus_information',
			async: true,
			cache: true,
			data: params,
			success: function(result) {
				$('#bus-info-modal .loader-image').hide();
				if (result.status) {
					$('#bus-info-modal-content').html(result.data);
				} else {
					$('#bus-info-modal-content').html('NA');
				}
			}
		});
	}
	
		/**
	* Toggle active class to highlight current applied sorting
	**/
	$(document).on('click', '.sorta', function(e) {
		e.preventDefault();
		$(this).closest('.sortul').find('.active').removeClass('active');
		//Add to sibling
		$(this).siblings().addClass('active');
	});
	
	//Filter toggle
	$('.toglefil').click(function() {
			$(this).toggleClass('active');
		});

	//Boarding point info
	$(document).on('click', '.bus-boarding-info-btn', function(e) {
		e.preventDefault();
		//update data if visible
		//load data
		clean_up_boarding_modal();
		var _target_view = $(this).data('target');
		var _bus_info_data = get_board_bus_information($('.book-form', $(this).closest('.r-r-i')).serializeArray(), _target_view);
	});



 
 function hide_result_pre_loader() {
	$(".result-pre-loader-wrapper").hide();
 }

 function show_result_pre_loader() {
 	$(".result-pre-loader-wrapper").show();
    var t = setInterval(function() {
        var e = $("#bar"),
            r = parseInt($(".result-pre-loader-container").width()),
            a = bar_width = parseInt(e.width()),
            o = parseInt(r / 10);
        bar_width >= r ? (e.text("Please Wait ... 100%"), clearInterval(t)) : (a = bar_width + o, e.width(a), e.text(parseInt(a / 10) + "%"))
    }, 1e3)
}


});
/*****Buss code******/


