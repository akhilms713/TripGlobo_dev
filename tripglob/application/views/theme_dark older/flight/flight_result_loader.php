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
        // debug($_GET['class']);exit();
				$origin1 = $this->Flight_Model->get_airport_name($req->origin);
				$destination1 = $this->Flight_Model->get_airport_name($req->destination);
				$origin = $origin1.' ('. $req->origin.')';
				$destination = $destination1.' ('. $req->destination.')';
        // debug($destination1);exit;
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
            <?php } ?>
            
             <?php if($req->type!='round'&&$req->type!='M'){ ?>
                <i class="fal fa-arrow-right"></i>
             <?php } ?>
            <?php if($req->type=='round'){ ?>
             <i class="fal fa-arrows-h"></i>
             <?php } ?>
             <?php if($req->type!='M'){ ?>
            <span class="lblbk"><?php echo $destination; ?></span> </div>
           <?php } ?>
            </span>
          
             <?php   
              if(!empty($req->origin_m)){
                 // debug($req);exit();
                    $count_origin = count($req->origin_m);
                    for($i=0;$i<$count_origin;$i++){
                      $origin1_m = $this->Flight_Model->get_airport_name($req->origin_m[$i]);
                      $origin_m = $origin1_m.' ('. $req->origin_m[$i].')';
                      $destination1_m = $this->Flight_Model->get_airport_name($req->destination_m[$i]);
                      $destination_m = $destination1_m.' ('. $req->destination_m[$i].')';

                  //  $origin_m = $req->origin_m[$i]; ?>
                   <div class="borddo"> 
                    <span class="lblbk"><?php echo $origin_m; ?></span> 
                     <i class="fal fa-arrow-right"></i>
                    <span class="lblbk"><?php echo $destination_m;  ?></span>
                   </div>
                   <?php  } }?>
          
               
            <!--   <?php   
                    if(!empty($req->destination_m)){
                    $count_destination = count($req->destination_m);
                    for($i=0;$i<$count_destination;$i++){
                      $destination1_m = $this->Flight_Model->get_airport_name($req->destination_m[$i]);
                      $destination_m = $destination1_m.' ('. $req->destination_m[$i].')';

                  //  $origin_m = $req->origin_m[$i]; ?>
                    <span class="lblbk"><?php echo $destination_m; //debug(end($req->depart_date_m));exit(); ?></span></i> 
                   <?php  } }?> -->
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
                 <?php if($req->type == 'M'){ ?>
                 <span class="to-text"> to </span>
                  <span class="biginre1"> <?php echo date('d', strtotime(end($req->depart_date_m))); ?> <?php echo date('M', strtotime(end($req->depart_date_m))); ?>
                    <?php echo date('Y', strtotime(end($req->depart_date_m))); ?> </span>
              
                <?php } ?>
              </div>
                         <div class="nigthcunt"><?php if($req->type == 'round'){ echo 'Round '; } elseif($req->type == 'oneway') { echo 'Oneway '; } else{ echo 'Multicity';} ?> Trip </div>

            </div>
            <?php
            if (!empty($_GET['class'])) {
               echo $_GET['class'];
             } 
            ?>
            <?php
            if (!empty($_GET['airline'])) {
              $airline_name=$this->db->select('airline_name')->get_where('airline_list',array('airline_code'=>$_GET['airline']))->row_array();
               echo $airline_name['airline_name'];
             } 
            ?>
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
