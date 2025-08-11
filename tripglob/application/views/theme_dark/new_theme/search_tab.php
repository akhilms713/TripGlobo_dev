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
       $header_product1 = explode('/',$_SERVER['REQUEST_URI']);

       // print_r($header_product1);die;
         // print_r($this->uri->segments[0]);die; 
       if($header_product1[2] =='' || $header_product1[2] =='fligt' || $header_product1[2] =='subscriber'){
        $header_product = 'flight';
       }else if($header_product1[2] =='' || $header_product1[2] =='hotel' || $header_product1[2] =='subscriber'){
        $header_product = 'hotel';
       }else if($header_product == "transfer"){
        $header_product = 'transfer';
       }else if($header_product == "insurance"){
        $header_product = 'insurance';
       }else{
        $header_product = 'bus';
       }
        // if (!(isset($this->uri->segments[3]))) {
        //   $header_product = "Hotel";
        // } else {
        //   $header_product = $this->uri->segments[3];
        // }

        // echo $header_product;die;
      ?>



      <div class="customtab-Y">
        <div class="container">
          <div class="col-sm-12 tabs tabs-style-iconfall nopad">
        <input type="hidden" name="selected_product" id="header_product" value="<?php echo $header_product; ?>">
            <?php  //if(true || isset($header_product)||$this->uri->segment(1)==''){  ?>
            <div class="col-lg-12 col-md-9 col-sm-12 nopad">
              <ul class="nav nav-tabs nav-tabs-responsive nav_custo">   
                 <li id="blank_select_fly" class="tab-current act active"> 
                  <a href="#flight_search" data-toggle="tab"> <i class="fal fa-plane"></i> <p class="p_head">Flights</p></a> 
                </li>

                <li id="blank_select_hotel" class="tab-current act"> 
                  <a href="#hotel" data-toggle="tab"> <i class="fal fa-building"></i> <p class="p_head">Hotels</p></a> 
                </li>

                <li id="blank_select_bus" class=" tab-current act"> 
                  <a href="#bus" data-toggle="tab"> <i class="fal fa-bus"></i> <p class="p_head">Bus</p></a> 
                </li>
               <li id="blank_select_transfer" class=" tab-current act"> 
               <a href="#transfer" data-toggle="tab"> <i class="fal fa-car"></i> <p class="p_head">Transfers</p></a> 
               </li>
                 <li id="blank_select_insurance" class=" tab-current act"> 
               <a href="#Insurance" data-toggle="tab"><i class="fal fa-shield-check"></i> <p class="p_head">Insurance</p></a> 
               </li>
              </ul> 
          </div>
            <?php //} ?>
        <div class="outtabcontent">
            <div class="col-lg-12 col-md-9 col-sm-12 nopad">
               <div class="totopp">
                  <div class="col-lg-12 nopad">
                     <div class="tab-content custmtab">
                        <div class="tabbable">
                          <div class="content-wrap">
                           <div class="tab-content">
                               <input type="hidden" id="getUrl" value="<?php echo $_SERVER['REQUEST_URI']?>">
                                 <div class="flightSearchPanel" id="flightSearchPanel">
                                      <?php  echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/flight_search');?>
                                 </div>
                            
                                  <div class="hotelSearchPanel hide" id="hotelSearchPanel">
                                      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/hotel_search');?>
                                </div> 

                                <div class="busSearchPanel hide" id="busSearchPanel">
                                      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/bus_search');?>
                                </div>
                                    <div class="transferSearchPanel hide" id="transferSearchPanel">
                                      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/transfer_search');?>
                                </div>
                                        <div class="insuranceSearchPanel hide" id="insuranceSearchPanel">
                                      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/insurance_search');?>
                                </div>

                            </div> 
                              
                            </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
           
         </div> 
          
      
        
      <div class="col-md-3 col-sm-12 col-xs-12 new_mobiles">
      <div class="col-md-12 col-sm-12 col-xs-12 new_mobiles" style="display:none;"> 
        
      <div class="new_main_effect">
          <img class="class_new_logo" src="<?php echo base_url(); ?>assets/theme_dark/images/right_side_new.png">
      </div> 
      <div class="col-md-12 nopad">
          <div class="new_main_effect_slider">
          <div class="owl-carousel owl-theme" id="new_globlo">
            <?php 
               foreach ($top_news as $vals)
               {
                ?>
              <div class="item"> 
                <p><b><?= $vals['subject'];?></b> </p>
                <p><?= $vals['details'];?></p>
              </div>
            

                <?php
               }

             ?>
            
              
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

  

// $(function() {
//   var test=$('#header_product').val();

//   if(test==''){
//     $('#blank_select_fly').addClass('active');
//   }else{
//     $('.act').removeClass('active'); 
//     if(test=='flight'){
//       $('#blank_select_fly').addClass('active');
//     }else if(test=='bus'){
//       console.log("bus");
//       $('#blank_select_fly').removeClass('active');
//       $('#blank_select_hotel').removeClass('active');
//       $('#blank_select_bus').addClass('active');
//     }{
//       $('#blank_select_hotel').addClass('active');

//     }
//   }
    
// });
</script>
<script>  

document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll(".nav_custo li");

  function updateTabStyles() {
    // Reset styles for all tabs
    tabs.forEach((tab) => {
      const anchor = tab.querySelector("a");
      anchor.style.borderTopLeftRadius = "0";
      anchor.style.borderTopRightRadius = "0";
    });

    // Get specific tabs
    const firstTab = document.querySelector(".nav_custo li:first-child");
    const lastTab = document.querySelector(".nav_custo li:last-child");
    const activeTab = document.querySelector(".nav_custo li.active");

   

    // Handle dynamic styles based on active tab
    if (activeTab) {
      const prevTab = activeTab.previousElementSibling;
      const nextTab = activeTab.nextElementSibling;

      // Remove border radius from the previous tab if it exists
      if (prevTab) {
        prevTab.querySelector("a").style.borderTopLeftRadius = "0";
        prevTab.querySelector("a").style.marginRight = "-28px";
      }

      // Add border radius to the next tab's left side if it exists
      if (nextTab) {
        nextTab.querySelector("a").style.borderTopLeftRadius = "34px";
      }
    }
     // Ensure the first tab always has its top-left border radius
    firstTab.querySelector("a").style.borderTopLeftRadius = "34px";
    activeTab.querySelector("a").style.borderTopLeftRadius = "34px";
    // Ensure the last tab always has its top-right border radius
    lastTab.querySelector("a").style.borderTopRightRadius = "34px";
  }
  
  

  // Add click event listeners to each tab
  tabs.forEach((tab) => {
    tab.addEventListener("click", function () {
      // Remove the active class from all tabs
      tabs.forEach((t) => t.classList.remove("active"));
      // Add the active class to the clicked tab
      this.classList.add("active");

      // Update styles
      updateTabStyles();
    });
  });

  // Initialize styles on page load
  updateTabStyles();
});



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
// var getUrl = ($('#getUrl').val()).split('/');
var getUrl = '<?php echo $header_product;?>';
     // alert(getUrl);
    if(getUrl == 'hotel'){
        searchPanel('hotelSearchPanel','flightSearchPanel','busSearchPanel');

    }else{
        searchPanel('flightSearchPanel','hotelSearchPanel','busSearchPanel');
    }
    $(document).ready(function(){
      $('#blank_select_hotel').on('click',function(){
        if($('.page_flight').hasClass('active')){
          $('.page_flight').removeClass('active');
        }
        $('.page_hotel').addClass('active');
          $('.page_hotel').show();
          $('.page_transfer').hide();
          $('.transfer_search_engine').hide();
           $('.page_insurance').hide();
           $('.page_bus').hide();
           $('.page_flight').hide();
        searchPanel('hotelSearchPanel','flightSearchPanel','busSearchPanel');
      });
      $('#blank_select_fly').on('click',function(){
        // alert('flight');
        if($('.page_hotel').hasClass('active')){
          $('.page_hotel').removeClass('active');
        }
        $('.page_flight').addClass('active');
          $('.page_flight').show();
          $('.page_transfer').hide();
          $('.transfer_search_engine').hide();
           $('.page_insurance').hide();
           $('.page_bus').hide();
           $('.page_hotel').hide();
        searchPanel('flightSearchPanel','hotelSearchPanel','busSearchPanel');
        // if($('#flightSearchPanel').hasClass('hide')){
        //     $('#flightSearchPanel').removeClass('hide');
        //     $('#hotelSearchPanel').addClass('hide');
        // }
      });

       $('#blank_select_bus').on('click',function(){
        // alert('bsu')
        if($('.page_flight').hasClass('active')){
          $('.page_flight').removeClass('active');
        }else if($('.page_hotel').hasClass('active')){
          $('.page_hotel').removeClass('active');
        }else if($('#blank_select_bus').hasClass('active')){
          $('.transferSearchPanel').removeClass('active');
        }
        $('.page_bus').addClass('active');
        $('.page_transfer').removeClass('active');
        $('.page_bus').show();
        $('.page_insurance').hide();
        $('.page_transfer').hide();
        $('.transfer_search_engine').hide();
        searchPanel('busSearchPanel','flightSearchPanel','hotelSearchPanel','transferSearchPanel');
      });

      $('#blank_select_transfer').on('click',function(){  
      if($('.page_flight').hasClass('active')){ 
          $('.page_flight').removeClass('active');
        }else if($('.page_bus').hasClass('active')){
          $('.page_bus').removeClass('active');
        }else if($('.page_hotel').hasClass('active')){
          $('.page_hotel').removeClass('active');
        }
          // $('.page_hotel').removeClass('active');
          // $('.page_flight').removeClass('active');
          // $('.page_bus').removeClass('active');
      // alert('transfer');
        // $('.page_transfer').addClass('active');  

           $('.page_transfer').show();
           $('.transfer_search_engine').show();
           $('.page_insurance').hide();
           $('.page_bus').hide();
           $('.page_flight').hide();
           $('.page_hotel').hide();

        searchPanel('transferSearchPanel','busSearchPanel','flightSearchPanel','hotelSearchPanel');
        // if($('#flightSearchPanel').hasClass('hide')){
        //     $('#flightSearchPanel').removeClass('hide');
        //     $('#hotelSearchPanel').addClass('hide');
        // }
      });

// insurance 

      $('#blank_select_insurance').on('click',function(){ 
      if($('.page_flight').hasClass('active')){ 
          $('.page_flight').removeClass('active');
        }else if($('.page_bus').hasClass('active')){
          $('.page_bus').removeClass('active');
        }else if($('.page_hotel').hasClass('active')){
          $('.page_hotel').removeClass('active');
        }
        else if($('.page_transfer').hasClass('active')){
          $('.page_transfer').removeClass('active');
        }
          // $('.page_hotel').removeClass('active');
          // $('.page_flight').removeClass('active');
          // $('.page_bus').removeClass('active');
      // alert('transfer');
         $('.page_insurance').addClass('active');
         $('.page_transfer').hide();
         $('.transfer_search_engine').hide();
         $('.page_bus').hide();
         $('.page_insurance').show();
         $('.page_flight').hide();
         $('.page_hotel').hide();
        searchPanel('insuranceSearchPanel','transferSearchPanel','busSearchPanel','flightSearchPanel','hotelSearchPanel');
        // if($('#flightSearchPanel').hasClass('hide')){
        //     $('#flightSearchPanel').removeClass('hide');
        //     $('#hotelSearchPanel').addClass('hide');
        // }
      });




      /*$('#blank_select_bus').on('click',function(){
        console.log("blank_select_bus");
        if($('.page_bus').hasClass('active')){
          $('.page_bus').removeClass('active');
        }
        $('.page_bus').addClass('active');
        searchPanel('busSearchPanel');
        // if($('#flightSearchPanel').hasClass('hide')){
        //     $('#flightSearchPanel').removeClass('hide');
        //     $('#hotelSearchPanel').addClass('hide');
        // }
      });*/

    });
    function searchPanel(panel1,panel2,panel3){

      // alert(panel1);
      // alert(panel2);
      // alert(panel3);
      if($('#'+panel1).hasClass('hide')){
            $('#'+panel1).removeClass('hide');
            $('#'+panel2).addClass('hide');
            $('#'+panel3).addClass('hide');
        }
    }
    </script> 