
<div class="advertisement">
  <div class="container">
    <div class="out_advertise">
				
     
		         <?php 
			$advertise_section = $this->home_model->advertise_sect(); 
			//print_r($advertise_section); exit;
			foreach($advertise_section as $links) {
			$icon_img = $links->advertise_image;
			$link = $links->link;
		?>
		 <div class="col-sm-6">
<!--
        <div class="advimage"><a href="<?php echo $link;  ?>"><img src="<?php //echo IMG_URL.$icon_img; ?>" alt="" /> </a> </div>     
-->
        <div class="advimage"><a href="<?php echo $link;  ?>"><img src="<?php echo $icon_img; ?>" alt="" /> </a> </div>     
        </div>
        <?php } ?>
     
    </div>
  </div>
</div>
