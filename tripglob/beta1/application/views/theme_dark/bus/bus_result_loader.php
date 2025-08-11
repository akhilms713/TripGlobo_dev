
<link href="<?php echo ASSETS; ?>css/load.css" rel="stylesheet" />
<style>
  .bg_loader,
.full_bg {
        bottom: 0;
    left: 0;
    top: -104px!important;
}
</style>
<div class="all_loading imgLoader text-center loader-image fulloading result-pre-loader-wrapper bus_preloader">
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
        <div>
          <img src="<?php echo ASSETS; ?>images/bus_deal.gif" alt="logo" style="width:26%;margin-top:13px;"/>
          <img src="<?php echo ASSETS; ?>images/bus_deal_loader.png" alt="logo" style="width: 27%;"/> 
        </div>
       
        <?php 
			       $data = $this->input->get();
                   $insert_data['search_data'] = json_encode($data);
                   $insert_data['search_type'] = 'BUS';
                      //debug($data);die;

              
        ?>
      <div class="relativetop new-loader">
        <!-- <div class="paraload"> Searching for the best airfares </div> -->
        <!-- <div class="paraload"><img src="<?php echo base_url(); ?>assets/theme_dark/images/flight_load.gif" width="200"/></div> -->
        <!-- <div class="normal_load"></div> -->
        <br>
        <div class="clearfix"></div>
                <div class="paraload">We are seeking the best results for your search. Please wait.<br>This will take only few seconds......</div>

        <div class="sckintload <?php if($data){ echo $data['from'];  } ?>"><!--For round way add class 'round_way'-->
          <div class="ffty bus_fiffy">
          <?php if(isset($data)){ ?>
            <div class="borddo brdrit"> <span class="lblbk"> 
            <?php echo $data['from']; ?>
           
            <!--<?php if($data){ ?>-->
            <!-- <i class="fal fa-arrows-h"></i>-->
            <!-- <?php } ?>-->
            </span>
            <?php } ?>

             <?php if(isset($data)){ ?>
                <i class="fal fa-arrow-right"></i>
             <?php } ?>
           <?php if($data){ ?>
            <span class="lblbk"><?php echo $data['to']; ?></span> </div>
           <?php } ?>
          </div>
          </div>
           <div class="bus_depat">
          <span class="lblbk_a"><?php echo $data['bus_depature']; ?></span> 
        </div>
         

          <div class="clearfix"></div>
           <div class="clearfix"></div>
           <div class="nigthcunt"><?php if($insert_data['search_type'] == 'BUS'){ echo 'BUS '; }?> Trip </div>
          
</div>
       
        <a class="cancel_search" href="<?php echo WEB_URL; ?>"><span class="fa fa-long-arrow-left"></span>Back to home</a>
         </div>
      </div>
    </div>
    </div>
</div>
