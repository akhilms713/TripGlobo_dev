<div class="tab-pane padding20me active" id="dashbord">
  <div class="col-md-2 nopad">
    <div class="userprowrp">
      <div class="profileusrs"> <a href="<?php echo WEB_URL.'/dashboard/profile'; ?>"> <img src="<?php echo $userInfo->profile_picture;?>" alt="" class="profile_photo"/> </a> </div>
      <h3 class="proname"><?php echo $userInfo->user_name;?></h3>
      <div class="adagnt"> <span class="icon icon-map-marker"></span> <span class="roktuo"> Agent Address </span> </div>
      <div class="adagnt"> <span class="icon icon-user"></span> <span class="roktuo"> APT000 </span> </div>
    </div>
    <div class="clear"></div>
    <div class="sidewiserow">
      <h3 class="sidewisehed">Accounts</h3>
      <div class="rogntr">
        <div class="col-xs-6 detdt">Last Deposit</div>
        <div class="col-xs-6 detdt idagnt coloramnt">$ <?php echo $userInfo->last_credit; ?></div>
      </div>
      <div class="rogntr">
        <div class="col-xs-6 detdt">Balance</div>
        <div class="col-xs-6 detdt idagnt coloramnt">$ <?php echo $userInfo->balance_credit; ?></div>
      </div>
      <div class="rogntr">
        <div class="col-xs-12 detdt"> <span class="icon icon-money"></span> <a href="<?php echo WEB_URL;?>/dashboard/account_statement">&nbsp;&nbsp;Account Statement</a> </div>
      </div>
      <div class="rogntr">
        <div class="col-xs-12 detdt"> <span class="icon icon-pushpin"></span> <a href="<?php echo WEB_URL;?>/dashboard/booking_statement">&nbsp;&nbsp;Booking Statement</a> </div>
      </div>
      <div class="rogntr">
        <div class="col-xs-12 detdt "> <span class="icon icon-bar-chart"></span> <a href="<?php echo WEB_URL;?>/dashboard/profit_matrix">&nbsp;&nbsp;profit Matrix</a> </div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="clear"></div>
    <div class="sidewiserow">
      <h3 class="sidewisehed">Verification</h3>
      <?php 
			 if($userInfo->email_verify == 1 || $userInfo->mobile_verify == 1){
                if($userInfo->email_verify == 1){
					?>
      <div class="sideop"><span class="icontik icon icon-check"></span><span class="strogtiv">Email Address</span><span class="littiv">Verified</span> </div>
      <?php
                }
                if($userInfo->mobile_verify == 1){
                 ?>
      <div class="sideop"><span class="icontik icon icon-check"></span><span class="strogtiv">Mobile</span><span class="littiv">Verified</span> </div>
      <?php
                }
              }else { ?>
      <p class="sideop">No Verified Yet.</p>
      <?php } ?>
    </div>
    <div class="clear"></div>
    <div class="sidewiserow">
      <h3 class="sidewisehed">Quick Links</h3>
      <ul class="qlinkul">
        <li class="qlink"><a href="<?php echo WEB_URL;?>/dashboard/profile">Profile</a></li>
      </ul>
    </div>
  </div>
  <div class="col-md-10 nopad">
    <div class="clear"></div>
    <div class="dashrow marbtm20 ">
      <h3 class="dashed">Welcome  To <?php echo PROJECT_TITLE; ?></h3>
      <div class="indashrow"> <span class="onlysent"> <?php echo PROJECT_TITLE; ?> brings the world closer to you. Go ahead and explore the largest range of destinations and properties, hotels with the world's leading online travel company. </span>
        <div class="fullofdash">
          <ul>
            <li class="dshcol"> <a href="<?php echo WEB_URL;?>/help">
              <div class="indash">
                <div class="dashico"><img src="<?php echo ASSETS;?>images/dash1.png" alt="" /></div>
                <h3 class="dashinhed">Lorem Ipsum is simply </h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              </div>
              </a> </li>
            <li class="dshcol"> <a href="<?php echo WEB_URL;?>/help">
              <div class="indash">
                <div class="dashico"><img src="<?php echo ASSETS;?>images/dash3.png" alt="" /></div>
                <h3 class="dashinhed">Lorem Ipsum is simply </h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              </div>
              </a> </li>
            <li class="dshcol"> <a href="<?php echo WEB_URL;?>/help">
              <div class="indash">
                <div class="dashico"><img src="<?php echo ASSETS;?>images/dash4.png" alt="" /></div>
                <h3 class="dashinhed">Lorem Ipsum is simply </h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              </div>
              </a> </li>
            <li class="dshcol"> <a href="<?php echo WEB_URL;?>/dashboard/support_conversation">
              <div class="indash">
                <div class="dashico"><img src="<?php echo ASSETS;?>images/dash2.png" alt="" /></div>
                <
                <h3 class="dashinhed">Lorem Ipsum is simply </h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              </div>
              </a> </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="dashrow1">
      <div class="col-md-3">
        <div class="clrbos fagren"> <span class="fa fa-list"></span> </div>
        <div class="cntbos"> <span class="lablbos">Bookings</span> <span class="countbos fagren">12</span> </div>
      </div>
      <div class="col-md-3">
        <div class="clrbos fared"> <span class="fa fa-comments"></span> </div>
        <div class="cntbos"> <span class="lablbos">Inbox</span> <span class="countbos fared">1</span> </div>
      </div>
      <div class="col-md-3">
        <div class="clrbos fayello"> <span class="fa fa-bookmark"></span> </div>
        <div class="cntbos"> <span class="lablbos">Bookings</span> <span class="countbos fayello">23</span> </div>
      </div>
      <div class="col-md-3">
        <div class="clrbos fablu"> <span class="fa fa-heart"></span> </div>
        <div class="cntbos"> <span class="lablbos">Bookings</span> <span class="countbos fablu">1</span> </div>
      </div>
    </div>
  </div>
</div>
