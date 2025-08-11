<!--search_tab-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" /><script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<style type="text/css">
   .topssec { background: rgb(255, 255, 255); box-shadow: none; }
   .topssec:after {     background: url('<?php echo base_url();?>/assets/theme_dark/images/shadow_2.png') no-repeat scroll center bottom rgba(0, 0, 0, 0);
    bottom: -27px;
    content: "";
    height: 28px;
    left: 0;
    position: absolute; 
    width: 100%; 
    z-index: 100; }
   .sidetorit .menuli a{color: #4c4c4c;font-size: 16px;}

   .leftpul h4 { margin-bottom: 15px; color: #000; }
   .userorlogin {color: #4c4c4c;/*display: block;float: left;font-size: 14px;padding-right:15px;position: relative;text-overflow: ellipsis;white-space: nowrap;    width: 160px;*/
    /*overflow: hidden; */
   }
   .userorlogin::after {color: #4c4c4c;content: "";font-family: "FontAwesome";/*position: absolute;*/right: 0;
   }
 .dropdown.menuli .reglog .userimage.user_profimag span.userorlogin{
      width: auto !important;
 }
/*    .caret.cartdown { color: #4c4c4c;margin: 5px;
} */
   .flags {color: #4c4c4c;float: left;font-size: 14px;margin: 0 10px 0 0;
   }
   #advance_options { max-width: 250px;float: right;}
   .highlight{border: 1px solid #ff0000;}
   .p_head{ 
    text-align: center;
    padding: 8px 20px;
   }

.class_new_logo {
    cursor: pointer;
    height: 170px;
    width: 226px;
    top: -8px;
} 
.panel-heading .accordion-toggle:after {
    font-family: 'Glyphicons Halflings';
    content: "\e114";
    float: right;
    color: grey;
}
.panel-heading .accordion-toggle.collapsed:after {
    content: "\e080";
}
.new_main_effect_slider{
  width: 100%;
  height: auto;
  background: #fff;
  margin-top: 15px;
}
.new_main_effect_slider .owl-buttons {
    display: none;
}
#new_globlo p{
        padding: 7px;
    text-align: left;
    line-height: 18px;
    font-family: poppins;
    font-size: 12px;
    color: #193960;
}
</style>


<div class="searchtabs search_panel">
   <div class="whenfixmar">
      <!-- <div class="carousel-caption">
         <h3 id="big1" class="bigcaption"></h3>
         <p id="desc" class="smalcaptn"></p>
      </div> -->

       <?php 
         //print_r($this->uri->segments(1));die; 
        if (!(isset($this->uri->segments[3]))) {
          $header_product = "Hotel";
        } else {
          $header_product = $this->uri->segments[3];
        }

        //echo $header_product;
      ?>



      <div class="customtab Y">
        <div class="container">
          <div class="col-sm-12 tabs tabs-style-iconfall nopad">
        <input type="hidden" name="selected_product" id="header_product" value="<?php echo $header_product; ?>">
            <?php  //if(true || isset($header_product)||$this->uri->segment(1)==''){  ?>
            <ul class="nav nav-tabs nav-tabs-responsive nav_custo">   
               <li id="blank_select_fly" class="<?php if(isset($header_product) && $header_product == 'Flights' || $header_product=='subscriber') echo 'active';?>tab-current act"> 
                <a href="#flight_search" data-toggle="tab"> <i class="fal fa-plane"></i> <p class="p_head">Flights</p></a> 
              </li>

              <li id="blank_select_hotel" class="<?php if(isset($header_product) && $header_product == 'Hotel' || $header_product=='subscriber') echo 'active';?>tab-current act"> 
                <a href="#hotel" data-toggle="tab"> <i class="fal fa-building"></i> <p class="p_head">Hotels</p></a> 
              </li>

            </ul> 
            <?php //} ?>
         <div class="outtabcontent">
            <div class="col-lg-9 col-md-9 col-sm-12 nopad">
               <div class="totopp">
                  <div class="col-lg-12 nopad">
                     <div class="tab-content custmtab">
                        <div class="tabbable">
                          <div class="content-wrap">
                           <div class="tab-content">
                              <?php echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/flight_search');?>
                              <?php //echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/hotel_search');?>
                           </div>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
            <div class="col-md-4"></div>
         </div> 
          
        </div>
        
      <div class="col-md-3 col-sm-12 col-xs-12 new_mobiles">
      <div class="col-md-12 col-sm-12 col-xs-12 new_mobiles"> 
        
      <div class="new_main_effect">
          <img class="class_new_logo" src="<?php echo base_url(); ?>assets/theme_dark/images/right_side_new.png">
      </div> 
      <div class="col-md-12 nopad">
          <div class="new_main_effect_slider">
          <div class="owl-carousel owl-theme" id="new_globlo">
              <div class="item"> 
                <p style="color:red;">Website is in test mode, there is no LIVE data </p>
              </div>
              <div class="item">
                <p style="color:red;">Website is in test mode, there is no LIVE data </p>
              </div>
          </div>
          </div>
      </div>
      </div>
    </div>
        
        </div>

      </div>
   </div>
</div>
		
<script type="text/javascript"> 

	

$(function() {
  var test=$('#header_product').val();
    // alert(test);
  if(test==''){
    $('#blank_select_fly').addClass('active');
  }else{
    $('.act').removeClass('active'); 
    if(test=='Flights'){
      $('#blank_select_fly').addClass('active');
    }
  }
    
});
</script>
<script>	 
	$(document).ready(function(){ 
  $("#new_globlo").owlCarousel({
            items : 1, 
            itemsDesktop : [1000,4], 
            itemsDesktopSmall : [991,3], 
            itemsTablet: [767,2], 
            itemsMobile : [480,1], 
            navigation : true,
            pagination : false,
            autoPlay: 3000, //Set AutoPlay to 3 seconds    
       
    }); 
});
    </script> 