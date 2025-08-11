<script type="text/javascript">
$(document).ready(function(){
	  $("#owl-demobanertrip").owlCarousel({
		items : 1, 
		itemsDesktop : [1000,1],
		itemsDesktopSmall : [900,1], 
		itemsTablet: [600,1], 
		itemsMobile : [479,1], 
        navigation : false,
		pagination : true,
		autoPlay : true
      });

      $("#owl-demobanertrip1").owlCarousel({
		items : 1, 
		itemsDesktop : [1000,1],
		itemsDesktopSmall : [900,1], 
		itemsTablet: [600,1], 
		itemsMobile : [479,1], 
        navigation : false,
		pagination : true,
		autoPlay : true
      });

      $("#owl-demobanertrip2").owlCarousel({
		items : 1, 
		itemsDesktop : [1000,1],
		itemsDesktopSmall : [900,1], 
		itemsTablet: [600,1], 
		itemsMobile : [479,1], 
        navigation : false,
		pagination : true,
		autoPlay : true
      });

      $("#owl-demobanertrip3").owlCarousel({
		items : 1, 
		itemsDesktop : [1000,1],
		itemsDesktopSmall : [900,1], 
		itemsTablet: [600,1], 
		itemsMobile : [479,1], 
        navigation : false,
		pagination : true,
		autoPlay : true
      });

$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});

$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });	
});



//homepage slide show
$(function($){
	
				var url = '<?php echo base_url(); ?>admin-panel/uploads/banner/';

				$.supersized({
				
					// Functionality
					slide_interval          :   5000,		// Length between transitions
					transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	700,		// Speed of transition
															   
					// Components							
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					slides 					:  	[			// Slideshow Images
												
							/*					{image : url1+'/slide1.jpg' ,title : 'BOOK NOW THE BEST DEALS' ,description:'Book securely and with confidence'},
												{image : url1+'/slide2.jpg' ,title : 'BOOK NOW THE BEST DEALS' ,description:'Book securely and with confidence'},
												{image : url1+'/slide3.jpg' ,title : 'BOOK NOW THE BEST DEALS' ,description:'Book securely and with confidence'},	
							*/					
												<?php $banners = $this->home_model->home_banners();   $i = 0;
												foreach($banners as $slider_banners) {
														$slogan = $slider_banners->title;
														$slogan_desc = $slider_banners->img_alt_text;
												?>
												{image : url+'/<?php echo $slider_banners->banner_image; ?>',title : '<?php echo $slogan; ?>' ,description:'<?php echo $slogan_desc; ?>' ,},
												<?php $i++; } ?>
												
												
												]
					
				});
		    });

//homepage slide show end

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
