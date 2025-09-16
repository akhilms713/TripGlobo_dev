<!DOCTYPE html>
<html lang="en">
   <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta name="description" content="">
      <meta name="author" content="">
      <title><?php echo PROJECT_TITLE; ?></title>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_css'); ?>
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> 
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
   </head>
   <body>
      <!-- Navigation -->
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
      <div class="clearfix"></div>
      <!-- /Navigation --> 
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/search_tab'); ?>
      <?php //echo $this->load->view(PROJECT_THEME.'/home/search_tab'); ?>
      <div class="clearfix"></div>
 
      <div class="body_bg">
          <!------------------------------------------- flight deals------------------------------------------->
          <?php if($type == 'flight_deals'){ ?>
          
        <section class="main_second ">
            <div class="container">    
            <div class=" new_right_secondcon_new">
          <h3 class="m11_w">Exclusive Flight Offers</h3>   
           <p>Compare & Book the best airlines deals available online in just on search</p> 
          </div> 
        
            <div class="main_new_imagessctions">
            <?php
            $flightCount = count($top_flightdeals);
             foreach($top_flightdeals as $flightData)
             {
            ?>
            <div class="col-md-4 col-sm-4 col-xs-4 pad8">
                <img class="flat_right" src="<?php echo base_url(); ?>admin-panel/uploads/flightdeal/<?php echo $flightData->deal_image; ?>">
                 <p><?php echo $flightData->deal_from_place; ?> - <?php echo $flightData->deal_to_place; ?></p>
                <p>Offer price: $ <?php echo $flightData->deal_offered_price; ?></p>
                <p><?php echo $flightData->offered_text; ?></p>
            </div>
           <?php }?>
            </div>
        </div> 
    </section>  
        <?php } ?> 
        <!------------------------------------------- flight deals end------------------------------------------->
      </div>
    
               
      <!-- customers are growing -->
      <div class="clearfix"></div>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
      <!-- /.container --> 
      <link href="<?php //echo base_url(); ?>assets/theme_dark/css/index.css" rel="stylesheet" />
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/theme_dark/js/datepicker.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/theme_dark/js/wow.min.js"></script>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/footer_js'); 
         ?>
   </body>
</html>