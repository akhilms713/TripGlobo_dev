$(document).ready(function(){
	
	//Ad banner
	 $("#owl-demobanertrip").owlCarousel({
		items : 1, 
		itemsDesktop : [1000,1],
		itemsDesktopSmall : [900,1], 
		itemsTablet: [600,1], 
		itemsMobile : [460,1], 
        navigation : false,
		pagination : false,
		autoPlay : true
      });
	  
	  
	  //Our destination
	  $("#owl-demodestination").owlCarousel({
		items : 5, 
		itemsDesktop : [1000,5],
		itemsDesktopSmall : [900,4], 
		itemsTablet: [600,3], 
		itemsMobile : [460,1], 
        navigation : true,
		pagination : false
      });
	  
	  
	  // Holiday Types
	  $("#owl-demodeals").owlCarousel({
		items : 5, 
		itemsDesktop : [1000,5],
		itemsDesktopSmall : [900,4], 
		itemsTablet: [600,3], 
		itemsMobile : [460,1], 
        navigation : true,
		pagination : false
      });
	  
	  //Holiday Deals
	  $("#owl-demo2").owlCarousel({
		items : 4, 
		itemsDesktop : [1000,4],
		itemsDesktopSmall : [900,3], 
		itemsTablet: [600,2], 
		itemsMobile : [460,1], 
        navigation : true,
		pagination : false
      });
	  
	  //Hotel Deals
	  $("#owl-demo3").owlCarousel({
		items : 4, 
		itemsDesktop : [1000,4],
		itemsDesktopSmall : [900,3], 
		itemsTablet: [600,2], 
		itemsMobile : [460,1], 
        navigation : true,
		pagination : false
      });
	  
	  //Activity Deals
	   $("#owl-demo4").owlCarousel({
		items : 4, 
		itemsDesktop : [1000,4],
		itemsDesktopSmall : [900,3], 
		itemsTablet: [600,2], 
		itemsMobile : [460,1], 
        navigation : true,
		pagination : false
      });
	  
	  
	  
});