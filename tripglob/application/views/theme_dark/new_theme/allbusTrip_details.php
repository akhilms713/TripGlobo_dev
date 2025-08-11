<style>
    /*.topssec{*/
    /*    margin-top: -481px;*/
    /*      position:fixed;*/
    /*}*/
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
   	  <!-- Navigation -->
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
      <div class="clearfix"></div>

		<div class="container cont_pad">
			<div class="col-md-1"></div>
			<div class="col-md-10 fgt_secss">
		    	 <h2><center>All Bus Trip Details</center></h2><br><br>
		    	 <div class="col-md-1"></div>
			     <div class="col-md-12">
			     	<table class="table">
			     	    <tr>
			     	        <th>Sr No.</th>
			     	        <th>Module Name</th>
			     	        <th>Travels Name</th>
			     	        <th>From</th>
			     	        <th>To</th>
			     	        <th>Departure Date</th>
			     	        <th>Arrival Date</th>
			     	        <th>Start Time</th>
			     	        <th>End Time</th>
			     	        <th>Boarding Point</th>
			     	        <th>Droping Point</th>
			     	        <th>Amount</th>
			     	        <th>Action</th>
			     	    </tr>
			     	    <?//php print_r($flight_details);
			     	    $i=1;
			     	       foreach($flight_details as $key => $vals)
			     	       {
			     	        $boarding=json_decode($vals['boarding_point']);
			     	        $droping=json_decode($vals['droping_point']);
			     	       
			     	    ?>
			     	    <tr>
			     	        <td><?= $i++;?></td>
			     	         <td><?php echo $vals['moduleName']?></td>
			     	         <td><?php echo $vals['travels_name']?></td>
			     	        <td><?php echo $vals['from_location'];?></td>
			     	        <td><?php echo $vals['to_location'];?></td>
			     	        <td><?php echo $vals['departure_date']?></td>
			     	        <td><?php echo $vals['arrival_date']?></td>
			     	        <td><?php echo $vals['start_time'];?></td>
			     	        <td><?php echo $vals['end_time'];?></td>
			     	        <td><?php foreach($boarding as $boarding_val){ echo $boarding_val."<br>";}?></td>
			     	        <td><?php foreach($droping as $droping_val){ echo $droping_val."<br>";}?></td>
			     	       
			     	        <td><?php echo $vals['amount'];?></td>
			     	        <td>
			     	        <!--<a href="<?= base_url()?>general/sendEnquiry_flightTrip/<?= $vals['bus_trip_id']?>" class="btn btn-success btn btn-sm">Send</a><br>-->
			     	        <button data-toggle="modal" data-target="#myModal" class="btn btn-info btn btn-sm">Contact</button>
			     	        </td>
			     	    </tr>
			     	    <?php } ?>
			     	</table>
			     </div>
			   
		     </div>
      
		</div>
   
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Contact Details</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                  <form action="<?php echo WEB_URL; ?>general/specialbus_userDetail" method="post">
                      <div class="form-group">
                          <lable>Name</lable>
                           <input id="user_name" type="text" name="user_name" class="form-control" required="required" placeholder="Enter Name">
                      </div>
                       <div class="form-group">
                          <lable>Email</lable>
                           <input id="email" type="email" name="email" class="form-control" required="required" placeholder="Enter Email Id">
                      </div>
                      <div class="form-group">
                          <lable>Phone</lable>
                           <input id="phone" type="number" name="phone" class="form-control" required="required" placeholder="Enter Phone No.">
                      </div>
                      <div class="form-group">
                          <lable>Message</lable>
                          <textarea name="message" class="form-control"></textarea>
                      </div>
                       <div class="form-group">
                        <div class="col-md-9 ad-btn col-md-offset-3">
                            <input id="flight_trip_id" type="hidden" name="bus_trip_id" class="form-control" value="<?php echo $vals['bus_trip_id'];?>" required="required" placeholder="Enter Phone No.">
                            <button id="send" type="submit" class="btn btn-success ad-save">Save</button>
                        </div>
                    </div>
                  </form>
                </div>
                
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!--//modal-->
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
