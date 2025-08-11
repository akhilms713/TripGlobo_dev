<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo PROJECT_TITLE; ?> </title>
	<link rel="icon" href="https://tripglobo.com/beta1/assets/theme_dark/images/favicon.png" type="image/x-icon">

    <!-- Bootstrap core CSS -->

    <link href="<?php echo ASSETS; ?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="<?php echo ASSETS; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/animate.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/common/toggle-switch.css" rel="stylesheet" media="screen">
    <!-- Custom styling plus plugins -->
    <link href="<?php echo ASSETS; ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/icheck/flat/green.css" rel="stylesheet">

     <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet">
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

   <script type="text/javascript">

<?php if($this->session->flashdata('success')){ ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
<?php }else if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
<?php } ?>

</script>
<style>

.switch-ios.switch-light {
    
    top: 0px !important; 
}
i{
  margin-right:5px;
  cursor:pointer;
}
</style>
    <script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->

      </head>


      <body class="nav-md">

        <div class="container body">


            <div class="main_container">



                <!-- top navigation -->

                <?php echo $this->load->view('common/sidebar_menu'); ?>
                <?php echo $this->load->view('common/top_menu'); ?>
                <div class="right_col" role="main">
               <div class="main-content" style="width:100%;float: left;">
               <div class="row" style="overflow-x: scroll;">
               <div class="col-md-12 col-sm-12 col-xs-12">
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."home/index"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."markup/list_dest_air_markup"; ?>">Markup</a></li>
				<li class="active"><strong>Markup List</strong></li>
				<li class="active" style="float:right;"><a href="<?php echo site_url()."markup/add_dest_air_markup"; ?>">Add New Markup</a></li>
			</ol>
			<div class="" style="overflow-x: scroll;">
				<table class="table table-bordered datatable" id="api_list">
					<thead>
						<tr>
							<th class="frow">Sl No</th>
							<th>User Type</th>
							<th>User Name</th>
							<!-- <th>Domain Name</th> -->
							<th>Product Name</th>
							<th>Api Name</th>
							<!--<th>Country</th>-->
							<th>Airline</th>
							<th>Markup Type</th>
							<th>Markup (%)age</th>
							<th>Markup Fixed</th>
							<th>Trip Type</th>
							<th>Source</th>
							<th>Destination</th>
							<th>Onward Class</th>
							<th>Return Class</th>
							<th>IP Address</th>
							<th>Date</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php if($markup!=''){ for($a=0;$a<count($markup);$a++){ ?>
						<tr>
							<td><?php echo ($a+1); ?></td>
							<td><?php echo $markup[$a]->user_type_name; ?></td>
							<td>
							   
								<?php
								// debug($markup);
									if($markup[$a]->user_details_id){
										$agent_lis=$this->Markup_Model->get_agent_name($markup[$a]->user_details_id);
										if($agent_lis){
											echo $agent_lis[0]->user_name.' '.$agent_lis[0]->user_unique_id;
										}else{											
										echo 'All';
										}	
									}else{
										echo 'All';
									} 
								?>
							</td>
							<!-- <td><?php echo $markup[$a]->domain_name; ?></td> -->
							<td><?php echo $markup[$a]->product_name; ?></td>
							<td><?php echo $markup[$a]->api_name." (".$markup[$a]->api_credential_type.")"; ?></td>
							<!--<td><?php echo $markup[$a]->country_name." (".$markup[$a]->iso3_code.")"; ?></td>-->
							<td><?php echo $markup[$a]->airline_name; ?></td>
							<td><?php echo $markup[$a]->markup_type; ?></td>
							<td><?php echo $markup[$a]->markup_value; ?></td>
							<td><?php echo $markup[$a]->markup_fixed; ?></td>
							<td><?php if($markup[$a]->trip_type=='1'){ echo "One Way";}else{echo "Round Trip";} ?></td>
							<td><?php echo $markup[$a]->from_loc; ?></td>
							<td><?php echo $markup[$a]->to_loc; ?></td>
							<td><?php echo $markup[$a]->onward_class; ?></td>
							<td><?php echo $markup[$a]->return_class; ?></td>
							<td><?php echo $markup[$a]->ip_address; ?></td>
							<td><?php echo $markup[$a]->date; ?></td>
							<td>
								<?php if($markup[$a]->status == "ACTIVE"){ ?>
									<button type="button" class="btn btn-green btn-icon icon-left">Active<i class="entypo-check"></i></button>
								<?php }else{ ?>
										<button type="button" class="btn btn-orange btn-icon icon-left">InActive<i class="entypo-cancel"></i></button>
								<?php } ?>
							</td>
							<td class="center">
								<?php if($markup[$a]->status == "ACTIVE"){ ?>
									<a href="<?php echo site_url()."markup/inactive_dest_air_markup/".base64_encode(json_encode($markup[$a]->markup_details_id)); ?>" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-eye"></i>InActive</a>
								<?php }else{ ?>
									<a href="<?php echo site_url()."markup/active_dest_air_markup/".base64_encode(json_encode($markup[$a]->markup_details_id)); ?>" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-check"></i>Active</a>
								<?php } ?>
								<a href="<?php echo site_url()."markup/edit_dest_air_markup/".base64_encode(json_encode($markup[$a]->markup_details_id)); ?>" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>				
								<a onclick="return confirm('Are you sure you want to delete ?');" href="<?php echo site_url()."markup/delete_dest_air_markup/".base64_encode(json_encode($markup[$a]->markup_details_id)); ?>" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>
							</td>
						</tr>
					<?php } } ?>												
					</tbody>
				</table>
			</div>
			<!-- Footer -->
			<?php echo $this->load->view('common/footer'); ?> 				
		</div>				
		
	</div>
	</div>
	</div>
	</div>
	</div>
	<!-- Bottom Scripts -->
	<?php $this->load->view('general/load_js');	?>
	
	<script src="<?php echo ASSETS; ?>js/bootstrap.min.js"></script>

<!-- chart js -->
<script src="<?php echo ASSETS; ?>js/chartjs/chart.min.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo ASSETS; ?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo ASSETS; ?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo ASSETS; ?>js/icheck/icheck.min.js"></script>

<script src="<?php echo ASSETS; ?>js/custom.js"></script>


<!-- form validation -->
<script src="<?php echo ASSETS; ?>js/validator/validator.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script>
   $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>

	
</body>
</html>
