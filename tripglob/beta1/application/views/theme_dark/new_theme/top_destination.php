<div class="top_destination">
  <div class="col-xs-12 nopad">
    <div class="pagehed hide">Top Hotel Destinations</div>
    <div class="centersep hide">
      <div class="comn_icons"> <span class="fa fa-star"></span> </div>
    </div>
    <div class="clearfix"></div>
    <div class="dest_out"> 
     <div id="owl-demobanertrip2" class="owl-carousel"> 
      <?php
       // echo "<pre>"; print_r($top_destionation); echo "</pre>"; die();
      
     $top=count($top_destionation);
     for($k=0;$k<$top;$k++)
     {
        
    ?>
        <div class="item" onclick="<?php echo WEB_URL; ?>home/tophotelsearch/<?php echo $top_destionation[$k]->last_minute_deals_id; ?>" >

      <div class="col-xs-12 nopad">
        <div class="deat_image"> 
        <img src="<?php echo IMG_URL.$top_destionation[$k]->hotel_image; ?>" alt="" />

          <div class="blackovhotel">
          <div class="top_det_hotel">
          <h3><?php echo $top_destionation[$k]->city; ?></h3>
          <div class="hotel_dtls">
          <h2>$850 <span>per night/person</span></h2>
          <img class="star_rat" src="<?php echo base_url(); ?>assets/theme_dark/images/fourstar.png" alt=""/>
          <div class="clearfix"></div>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
          <div class="clearfix"></div>
          <div class="book_btns">
          <a href="" class="view_det">VIEW DETAILS</a>
          <a href="" class="book_now">BOOK NOW</a>
          </div>
          </div>
          </div>
          </div>
    
        </div>
      </div>
      </div>
<?php
}
?>

      </div>

    </div>

</div>
</div>