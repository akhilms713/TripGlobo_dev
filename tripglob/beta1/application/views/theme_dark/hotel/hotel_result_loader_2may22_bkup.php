<link href="<?php echo ASSETS; ?>css/load.css" rel="stylesheet" />
<style type="text/css">
.progress-bar {background-color: #dd2a1b !important;}
</style>
<div class="all_loading imgLoader">
  <div class="full_bg bg_relative">
    <div class="bg_loader"></div>
    <div class="load_inner">
      <div class="relativetop">
        <div class="paraload"> Searching for the best room rates in</div>
        <h5><?php echo $request_data['city']; ?> City</h5>
        <!-- <div class="normal_load"></div> -->

        <div class="clearfix"></div>
        <div class="clearfix"></div>
        <div class="sckintload">
			
			<!--For round way add class 'round_way'-->
          <div class="ffty">
            <div class="borddo brdrit"> <span class="lblbk">Check In</span> </div>
          </div>
          <div class="ffty">
            <div class="borddo"> <span class="lblbk">Check Out</span> </div>
          </div>
          <div class="clearfix"></div>
          <div class="tabledates for_hotel">
            <!--  Check in  -->
            <div class="tablecelfty">
              <div class="borddo brdrit">
                <div class="fuldate"> <span class="bigdate"><?php echo date('d', strtotime($request_data['hotel_checkin'])); ?></span>
                  <div class="biginre"> <?php echo date('M', strtotime($request_data['hotel_checkin'])); ?><br>
                    <?php echo date('Y', strtotime($request_data['hotel_checkin'])); ?>  </div>
                </div>
              </div>
            </div>
            <!--  Check out  -->
            <div class="tablecelfty">
              <div class="borddo">
              	<div class="fuldate"><span class="bigdate"><?php echo date('d', strtotime($request_data['hotel_checkout'])); ?></span>
                  <div class="biginre">  <?php echo date('M', strtotime($request_data['hotel_checkout'])); ?><br>
                    <?php echo date('Y', strtotime($request_data['hotel_checkout'])); ?>  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="clearfix"></div>
          <div class="progress progress-striped active">
        <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%;transition-duration:50ms;">Fetching Results....</div>
       </div>
          <!-- <div class="nigthcunt"> </div> -->
        </div>
        <a class="cancel_search" href="<?php echo WEB_URL; ?>"><img src="<?php echo base_url();?>assets/theme_dark/images/back_icon.png"> </a>
      </div>
    </div>
  </div>
</div>
<script>
var progressBar = $("div.progress-bar");
var x = 0;
var increment = function() {
  x = (x > 100) ? 0 : x + 1;
  progressBar.css('width', (x % 100) + '%');
};
for(var prog=0; prog<10; prog++){
	// setTimeout(function(){ increment() },3000);
window.setInterval(increment, 3000);
}
</script>
