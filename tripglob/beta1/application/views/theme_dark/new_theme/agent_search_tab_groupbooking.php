<!--search_tab-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme_dark/css/custom_style.css">
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
   .userorlogin {color: #4c4c4c;display: block;float: left;font-size: 14px;padding-right:15px;position: relative;text-overflow: ellipsis;white-space: nowrap;
   }

   .userorlogin::after {color: #4c4c4c;content: "";font-family: "FontAwesome";/*position: absolute;*/right: 0;
   }
   /*.userorlogin{margin: 10px 0;}*/
/*    .caret.cartdown { color: #4c4c4c;margin: 5px;
} */
   .flags {color: #4c4c4c;float: left;font-size: 14px;margin: 0 10px 0 0;
   }
   #advance_options { max-width: 250px;float: right;}
   .highlight{border: 1px solid #ff0000;}
   .col-lg-5.col-md-5.col-sm-12.col-xs-12.fiveh.nopad .formlabel{color: #333;}
   .multi_label .formlabel{color: #333;}
  #addclose img {width: 25px;}
   .p_head{
    text-align: center;
    padding: 8px 20px;
   }
   .tab-content.custmtab {
    float: left;
    width: 100%;
    background: #2727278f;
    padding-top: 10px;
    padding-bottom: 10px;   
 /*   min-height: 316px;*/
     background: url(https://www.qickwt.com/wp-content/uploads/2015/12/Travel-insurance.jpg)no-repeat 90% 9%;

}
</style>
<div class="searchtabs search_panel">
   <div class="whenfixmar">
      <!-- <div class="carousel-caption">
         <h3 id="big1" class="bigcaption"></h3>
         <p id="desc" class="smalcaptn"></p>
      </div> -->


      <div class="customtab Y">
        <div class="">
          <div class="col-sm-12 tabs tabs-style-iconfall nopad">
        <input type="hidden" name="selected_product" id="header_product" value="<?php echo $header_product; ?>">
            <?php  if(true || isset($header_product)||$this->uri->segment(1)==''){  ?>
            <ul class="nav nav-tabs nav-tabs-responsive nav_custo">   
              <!--  <li id="blank_select_fly" class="<?php if(isset($header_product) && $header_product == 'Flights' || $header_product=='subscriber') echo 'active';?>tab-current act"> 
                <a href="#flight_search" data-toggle="tab"> <i class="fal fa-plane"></i> <p class="p_head">Flights</p></a> 
              </li> -->

              <!--  <li id="blank_select_hotel" class="<?php if(isset($header_product) && $header_product == 'Hotels') echo 'active'; ?> act"> <a href="#hotel" data-toggle="tab"> 
                <i class="fal fa-building"></i>
                <p class="p_head">Hotels</p></a> </li>
 -->
               <!-- <li id="blank_select_car" class="<?php if(isset($header_product) && $header_product == 'Cars') echo 'active'; ?> act"> <a href="#car" data-toggle="tab">
                <i class="fal fa-car"></i>
                <p class="p_head">Cars</p></a> </li> -->
            </ul>
            <?php } ?>
         <div class="outtabcontent">
            <div class="col-lg-12 nopad">
               <div class="totopp">
                  <div class="col-lg-12 nopad">
                     <div class="tab-content custmtab">
                        <div class="tabbable">
                          <div class="content-wrap">
                           <div class="tab-content">
                              <?php echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/flight_search_groupbooking');?>
                              <?php //echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/hotel_search');?>
                              <?php //echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/car_search');?>
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

      </div>

   </div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/theme_dark/js/custom_modified.js"></script>
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
    }else if(test=='Hotels'){
      $('#blank_select_hotel').addClass('active');
    }else if(test=='Cars'){
      $('#blank_select_car').addClass('active');
    }
  }
    
});
</script>