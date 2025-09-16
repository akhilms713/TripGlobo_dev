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





$(function ($) {
    var url = '<?php echo base_url(); ?>admin-panel/uploads/banner/';

    // Track the current background image to avoid unnecessary updates
    var currentImage = ''; // Initially no background image

    // Function to initialize the background with a single static image
    function setBackground(image, title = '', description = '') {
        // Check if the new image is different from the current one
        if (currentImage === image) {
            return; // No change, don't do anything
        }

        // Temporarily hide the background to avoid white flash
        $('#supersized').fadeOut(200); // Hide for 200ms (or adjust as needed)

        // Preload the new image
        var img = new Image();
        img.src = url + image;

        // Wait until the image is fully loaded before updating
        img.onload = function () {
            // Change the background image of the #supersized container
            $('#supersized').css('background-image', 'url(' + url + image + ')');
            
             $('#supersized').css({
                'background-image': 'url(' + url + image + ')',
                'background-size': 'cover',  // Ensure the image covers the entire screen
                'background-position': 'center',  // Center the image
                'background-repeat': 'no-repeat'  // Ensure the image doesn't repeat
            });

            // Optionally, you can update the title and description as well
            // $('#title').text(title); // If you have a title element
            // $('#description').text(description); // If you have a description element

            // Fade the background back in once the image is loaded
            $('#supersized').fadeIn(200); // Show for 200ms (or adjust as needed)

            // Update the current image to the new one
            currentImage = image;
        };
    }

    var sdefaultImage = 'Flight.png'; // Set the default image to be for the flight tab
    var sdefaultTitle = 'Explore the Skies';
    var sdefaultDescription = 'Book the best flight deals!';
    var currentUrl = window.location.href;
    var currentPage = hash.replace('#', '');

    if(currentPage === 'hotels') {
        sdefaultImage = 'Hotels.jpg'; // Set the default image to be for the hotel tab
        sdefaultTitle = 'Find Your Stay';
        sdefaultDescription = 'Book hotels at great prices!';
    } else if(currentPage === 'buses') {
        sdefaultImage = 'Bus.png'; // Set the default image to be for the bus tab
        sdefaultTitle = 'Travel by Bus';
        sdefaultDescription = 'Affordable bus tickets available!';
    } else {
        sdefaultImage = 'Flight.png'; // Set the default image to be for the hotel tab
        sdefaultTitle = 'Explore the Skies';
        sdefaultDescription = 'Book the best flight deals!';
    }
    // Default background (set based on the first banner)
    var defaultBanners = <?php echo json_encode($this->home_model->home_banners()); ?>;
    if (defaultBanners.length > 0) {
        var defaultBanner = defaultBanners[0];
        setBackground(sdefaultImage, sdefaultTitle, sdefaultDescription);
    }

    // Event listener for tab click to change background
    $('.nav-tabs li').on('click', function () {
        var tabId = $(this).attr('id');
        var image, title, description;

        switch (tabId) {
            case 'blank_select_fly':
                console.log('selected flight');
                image = 'Flight.png'; // Replace with your flight banner image
                title = 'Explore the Skies';
                description = 'Book the best flight deals!';
                break;
            case 'blank_select_hotel':
                console.log('selected hotel');
                image = 'Hotels.jpg'; // New hotel banner image
                title = 'Find Your Stay';
                description = 'Book hotels at great prices!';
                break;
            case 'blank_select_bus':
                console.log('selected bus');
                image = 'Bus.png'; // New bus banner image
                title = 'Travel by Bus';
                description = 'Affordable bus tickets available!';
                break;
            case 'blank_select_transfer':
                console.log('selected transfer');
                image = 'Taxis.jpg'; // Replace with your transfer banner image
                title = 'Easy Transfers';
                description = 'Hassle-free transportation!';
                break;
            case 'blank_select_insurance':
                console.log('selected insurance');
                image = 'insurance.jpg'; // Replace with your insurance banner image
                title = 'Travel Insurance';
                description = 'Secure your journeys!';
                break;
            default:
                image = 'Flight.png'; // Fallback image
                title = 'Welcome';
                description = 'Choose your service!';
        }

        // Replace the current background with the new image
        setBackground(image, title, description);
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
