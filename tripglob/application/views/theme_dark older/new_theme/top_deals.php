
<div class="top_deals">
  <div class="container">

   <div class="col-md-4 col-sm-12 col-xs-12 nopad">
             <div class="topdeal">
                 <div class="pagehed">Flight Deals</div>
              <div class="clearfix"></div>
              <img src="<?php echo base_url(); ?>assets/theme_dark/images/flightd.png" alt="" style="width:100%; height: 126px;">
              
               <div class="flightdealbg">
                <div class="flightdeals">
                <div class="flightimg"><img src="<?php echo base_url(); ?>assets/theme_dark/images/flightdeal1.jpg" alt=""></div>
                    <div class="flightdetails">
                    <h1>ORD - DEL</h1>
                    <span>one way flights</span> 
                    <div class="deal_rate"><span>$470</span> $300</div>
                    </div>
                </div>    
                
                <div class="flightdeals">
                <div class="flightimg"><img src="<?php echo base_url(); ?>assets/theme_dark/images/flightdeal2.jpg" alt=""></div>
                    <div class="flightdetails">
                    <h1>DEL - BOM</h1>
                    <span>one way flights</span> 
                    <div class="deal_rate"><span>$470</span> $300</div>
                    </div>
                </div> 
                
                <div class="flightdeals">
                <div class="flightimg"><img src="<?php echo base_url(); ?>assets/theme_dark/images/flightdeal3.jpg" alt=""></div>
                    <div class="flightdetails">
                    <h1>DXB - MAA</h1>
                    <span>one way flights</span> 
                    <div class="deal_rate"><span>$470</span> $300</div>
                    </div>
                </div>

                <div class="flightdeals">
                <div class="flightimg"><img src="<?php echo base_url(); ?>assets/theme_dark/images/flightdeal3.jpg" alt=""></div>
                    <div class="flightdetails">
                    <h1>BLR - HYD</h1>
                    <span>one way flights</span> 
                    <div class="deal_rate"><span>$470</span> $300</div>
                    </div>
                </div> 
                
             </div>
             </div>
            </div>

            <div class="col-md-4 ">
             <div class="pagehed">&nbsp;</div>
              <div class="clearfix"></div>
              <div id="owl-demobanertrip3" class="owl-carousel">
              <div class="item">
                  <img class="ad_img" src="<?php echo base_url(); ?>assets/theme_dark/images/flight_ad.jpg" alt="">
              </div>

              <div class="item">
                  <img class="ad_img" src="<?php echo base_url(); ?>assets/theme_dark/images/flight_ad.jpg" alt="">
              </div>

              </div>
            </div>



    <div class="col-md-4 nopad">
      <div class="inside_pading">
        <div class="pagehed">Today Hotel Deals</div>
        <div class="clearfix"></div>
<?php
$flight=count($top_flightdeals);
for($i=0;$i<$flight;$i++)
{
?>

        <a href="<?php echo WEB_URL; ?>home/topsearch/<?php echo $top_flightdeals[$i]->flight_deal_id; ?>" >
        <div class="everydealrow">
          <div class="flight_dealimg"> <img src="<?php echo IMG_URL.$top_flightdeals[$i]->deal_image;?>" alt="" />
            <div class="flightover">
           <!--    <div class="col-xs-12 nopad"> <span class="flplace"> <?php echo $top_flightdeals[$i]->deal_from_place;?>-> TO -><?php echo $top_flightdeals[$i]->deal_to_place;?><strong>flights</strong></span> </div> -->

              <div class="col-xs-12 nopad"> <span class="flplace">Singapore</span> <span class="total_hotels">105 Hotels</span></div>
       
            </div>
          </div>
        </div>
        </a>

<?php
}
?>


    
      </div>
    </div>
  </div>
</div>
