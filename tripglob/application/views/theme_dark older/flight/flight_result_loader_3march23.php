<style>
.load_inner, .load_inner1 {
    top: -12% !important;
  }

</style>


<link href="<?php echo ASSETS; ?>css/load.css" rel="stylesheet" />
<div class="all_loading imgLoader">
  <div class="full_bg bg_relative">
    <div class="bg_loader"></div>
    <div class="load_inner">
    	
        <div class="loader_box hide">
          <div class="loadcity"></div>
          <div class="clodnsun"></div>
          <div class="reltivefligtgo">
            <div class="flitfly"></div>
          </div>
        </div>  
        <div class="load-logo">
          <img style="" src="<?php echo ASSETS; ?>images/logo.png" alt="logo" />
        </div>
        <img src="<?php echo ASSETS; ?>images/search_load.gif" alt="logo" style="padding-left: 25px;width: 60%;"/>
        <?php 
				$origin1 = $this->Flight_Model->get_airport_name($req->origin);
				$destination1 = $this->Flight_Model->get_airport_name($req->destination);
				$origin = $origin1.' ('. $req->origin.')';
				$destination = $destination1.' ('. $req->destination.')';
        ?>
      <div class="relativetop new-loader">
        <!-- <div class="paraload"> Searching for the best airfares </div> -->
        <!-- <div class="paraload"><img src="<?php echo base_url(); ?>assets/theme_dark/images/flight_load.gif" width="200"/></div> -->
        <!-- <div class="normal_load"></div> -->
        <br>
        <div class="clearfix"></div>
                <div class="paraload">We are seeking the best results for your search. Please wait.<br>This will take only few seconds......</div>

        <div class="sckintload flight_sckintload <?php if($req->type == 'round'){ echo 'round_way'; } ?>"><!--For round way add class 'round_way'-->
          <div class="ffty">
          <?php if($req->type!='M'){ ?>
            <div class="borddo brdrit"> <span class="lblbk">
            <?php echo $origin; ?>
            
             <?php if($req->type!='round'){ ?>
                <i class="fal fa-arrow-right"></i>
             <?php } ?>
            <?php if($req->type=='round'){ ?>
             <i class="fal fa-arrows-h"></i>
             <?php } ?>
             
            </span>
          <?php } ?>
             <?php   
                    if(!empty($req->origin_m)){
                    $count_origin = count($req->origin_m);
                    for($i=0;$i<$count_origin;$i++){
                      $origin1_m = $this->Flight_Model->get_airport_name($req->origin_m[$i]);
                      $origin_m = $origin1_m.' ('. $req->origin_m[$i].')';

                  //  $origin_m = $req->origin_m[$i]; ?>
                   <div class="borddo"> <span class="lblbk"><?php echo $origin_m; ?></span> </div>
                   <?php  } }?>
          
            <?php if($req->type!='M'){ ?>
            <span class="lblbk"><?php echo $destination; ?></span> </div>
           <?php } ?>  
              <?php   
                    if(!empty($req->destination_m)){
                    $count_destination = count($req->destination_m);
                    for($i=0;$i<$count_destination;$i++){
                      $destination1_m = $this->Flight_Model->get_airport_name($req->destination_m[$i]);
                      $destination_m = $destination1_m.' ('. $req->destination_m[$i].')';

                  //  $origin_m = $req->origin_m[$i]; ?>
                    <span class="lblbk"><?php echo $destination_m; ?></span> 
                   <?php  } }?>
          </div>
          <div class="clearfix"></div>
          <div class="tabledates">
            <!--  Onward  -->
            <div class="tablecelfty1">
              <div class="borddo brdrit flight_type">
                <div class="fuldate"> 
                  <span class="biginre1"><?php echo date('d', strtotime($req->depart_date)); ?> <?php echo date('M', strtotime($req->depart_date)); ?>
                    <?php echo date('Y', strtotime($req->depart_date)); ?> </span>
              
           
				  <?php if($req->type == 'round'){ ?>
              	 <span class="to-text"> to </span>
                  <span class="biginre1"> <?php echo date('d', strtotime($req->return_date)); ?> <?php echo date('M', strtotime($req->return_date)); ?>
                    <?php echo date('Y', strtotime($req->return_date)); ?> </span>
              
                <?php } ?>
              </div>
                         <div class="nigthcunt"><?php if($req->type == 'round'){ echo 'Round '; } elseif($req->type == 'oneway') { echo 'Oneway '; } else{ echo 'Multicity';} ?> Trip </div>

            </div>
              </div>
          </div>
          <div class="clearfix"></div>
        </div>
       
        <a class="cancel_search" href="<?php echo WEB_URL; ?>"><span class="fa fa-long-arrow-left"></span>Back to home</a>
        
      </div>
    </div>
    </div>
</div>
