
   
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
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
      <style>
      	.cont_pad{ padding: 30px 0px;}
      	.sub_btn{width: 100%;background: #fdb813;height: 40px;font-size: 15px;}
      	.input_ss{height: 40px;}
      	.bg_clr{background: #f2f2f2;}
      	.fgt_secss{    
      		background: #fff;
		    padding: 25px 25px;
		    border-radius: 5px;
		    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.08), 0 6px 20px 0 rgba(0, 0, 0, 0.08);
		    margin-top:70px;
		    
		}
		.topssec{
			position: fixed;
    /* margin: -83px; */
    top: 0px;
		}
		.wrapper_before_content{
        margin-top: 75px;
    }
    .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
        padding: 0px!important;
    border-top: none!important;
 
}
   h2.bus_trip_specil {
    text-align: center;
    font-size: 30px;
    color: #fdb813;
    font-weight: 500;
    margin-bottom: 35px;
}
      </style>
      </head>
   <body class="bg_clr">
   	  <!-- Navigation -->
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
      <div class="clearfix"></div>

		<div class="container cont_pad">
			
         <form method="post" action="voucher">
			<div class="col-md-12 fgt_secss">
				<span><h2 class="bus_trip_specil">Special Flight Trip</h2></span>
		    		 <p style='color:green;padding-left:30px;font-weight:bold;'><?= $this->session->flashdata('success');?></p>
		    	 <div class="col-md-12">
			     <!--	<table class="table">
			     	  
			     	    <?//php print_r($flight_details);
			     	    $i=1;
			     	       foreach($flight_details as $vals)
			     	       {
			     	        $from=json_decode($vals['from_location']);
			     	        $to=json_decode($vals['to_location']);
			     	       $fid=base64_encode(json_encode($vals['flight_trip_id']));
			     	    ?>
			     	    <tr>
			     	        <td><?= $i++;?></td>
			     	      <td>  <a href="allFlightTrip_details/<?= $fid;?>" style="color:#333!important;font-size:14px;"><?php foreach($from as $form_val){ echo $form_val."<br>";}?></a></td>
			     	        <td><a href="allFlightTrip_details/<?= $fid;?>" style="color:#333!important;font-size:14px;"><?php foreach($to as $to_val){ echo $to_val."<br>";}?></a></td>
			     	    </tr>
			     	    <?php } ?>
			     	</table>--><?php if (is_array($flight_details) || is_object($flight_details))
              {
                $i=1;
                   foreach($flight_details as $vals)
                   {
                 
                    $from=json_decode($vals['from_location']);
                    $from_f='';
                  foreach ($from as $key_from => $value_from) {
                      if ($value_from!='') {
                          $from_f[]=$value_from;
                      }
                  }
                   // debug($from);exit(); 
                 $to=json_decode($vals['to_location']);
                 $to_t='';
                 foreach ($to as $key_to => $value_to) {
                      if ($value_to!='') {
                          $to_t[]=$value_to;
                      }
                  }
                  // debug($from_f); 
                  // debug($to_t);
             $fid=base64_encode(json_encode($vals['flight_trip_id'])); ?>
                   
			     	
                  

     	<div class="col-md-3">
             <table class="table">
               
             <tr>
             <td style="text-align:left;"><a href="allFlightTrip_details/<?= $fid;?>" style="font-weight: 600;font-family: 'Font Awesome 5 Pro';    color: #203f7c!important;font-size:14px;margin-right: 3px;">
                 <?php 
                 if(is_array($from_f) && is_array($to_t))
                 {
                      echo current($from_f).' '.'To'.' '. end($to_t)."<br>";
                 }
               // if(isset($from[1]) && isset($to[1]))
               //   {
               //        echo $from[1].' '.'To'.' '. $to[1]."<br>";
               //   }
               //   if(isset($from[2]) && isset($to[2]))
               //  {
               //       echo $from[2].' '.'To'.' '. $to[2]."<br>";
               //  }
                 
                 ?>
                    </a></td>
                </tr>
                
             </table>
         </div>
          <?php }
                    ?>
           <?php } ?>
         <!--   <div class="col-md-4">-->
         <!--    <table class="table">-->
         <!--       <tr>-->
         <!--       <td style="text-align:center;"><a href="" style="font-weight: 600;font-family: 'Font Awesome 5 Pro';    color: #203f7c!important;font-size:14px;margin-right: 3px;">Delhi (DEL) To Bangalore (BLR)-->
         <!--           </a></td>-->

         <!--       </tr>-->

         <!--    </table>-->
         <!--</div>-->

         <!--<div class="col-md-4">-->
         <!--    <table class="table">-->
         <!--      <tr>-->
         <!--      <td style="text-align:right;"><a href="" style="font-weight: 600;font-family: 'Font Awesome 5 Pro';    color: #203f7c!important;font-size:14px;margin-right: 3px;">Delhi (DEL) To Bangalore (BLR)-->
         <!--           </a></td>-->

         <!--       </tr>-->

         <!--    </table>-->
         <!--</div>-->







			     </div>
			     
			     <!--<div class="col-md-4">-->
			     <!--	<label style="visibility: hidden;">.</label>-->
			     <!--	<button class="btn sub_btn">Find Your Booking</button>-->
			     <!--</div>-->
		     </div>
         </form> 
		</div>
   

       <div class="clearfix"></div>
 		<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      <script type="text/javascript">
      <?php if($this->session->flashdata('success')){ ?>
          toastr.success("<?php echo $this->session->flashdata('success'); ?>");
      <?php }else if($this->session->flashdata('error')){  ?>
          toastr.error("<?php echo $this->session->flashdata('error'); ?>");
      <?php }else if($this->session->flashdata('warning')){  ?>
          toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
      <?php }else if($this->session->flashdata('info')){  ?>
          toastr.info("<?php echo $this->session->flashdata('info'); ?>");
      <?php } ?>
</script>

 	</body>
 	</html>
