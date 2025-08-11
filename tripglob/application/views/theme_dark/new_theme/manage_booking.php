<style>
    
    .wrapper_before_content{
        margin-top: 75px;
    }
</style>
   
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
      </style>
      </head>
   <body class="bg_clr">
     <?php echo $this->load->view(PROJECT_THEME.'/new_theme/header');
     
     
     ?>
   	  <!-- Navigation -->
     
   

		<div class="container cont_pad">
			<div class="col-md-2"></div>
         <form method="post" action="">
			<div class="col-md-8 fgt_secss">
		    	 <h2><center>My Bookings</center></h2><br><br>
		    	 <div class="col-md-1"></div>
			     <div class="col-md-6">
			     	<label>Reference Number</label>
			     	<input type="text" name="pnr" class="form-control input_ss" placeholder="Reference Number" required>
			     </div>
			     <div class="col-md-4">
			     	<label style="visibility: hidden;">.</label>
			     	<button class="btn sub_btn">Find Your Booking</button>
			     </div>
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
