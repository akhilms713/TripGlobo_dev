<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Markup</title>	
	  <link rel="icon" href="https://tripglobo.com/beta1/assets/theme_dark/images/favicon.png" type="image/x-icon">
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>	
	 <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet">
</head>
<body id="top" oncontextmenu="return false" class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?> <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."markup/list_amt_range_markup"; ?>">Markup</a></li>
				<li class="active"><strong>Markup List</strong></li>
				<li class="active" style="float:right;"><a href="<?php echo site_url()."markup/add_amt_range_markup"; ?>">Add New Markup</a></li>
			</ol>
			<div class="row" style="overflow-x: scroll;">
				<table class="table table-bordered datatable" id="api_list">
					<thead>
						<tr>
							<th class="frow">Sl No</th>
							<th>User Type</th>
							<th>Agent Name</th>
							<th>Domain Name</th>
							<th>Product Name</th>
							<th>Api Name</th>
							<!--<th>Country</th>-->
							<!-- <th>Airline</th> -->
							<th>Markup Type</th>
							<th>Amount Range From</th>
							<th>Amount Range To</th>
							<th>Markup (%)age</th>
							<th>Markup Fixed</th>
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
									if($markup[$a]->user_details_id){
										$agent_lis=$this->Markup_Model->get_agent_name($markup[$a]->user_details_id);
										if($agent_lis){
											echo $agent_lis[0]->salutation.' '.$agent_lis[0]->first_name.' '.$agent_lis[0]->sure_name;
										}	
									} 
								?>
							</td>
							<td><?php echo $markup[$a]->domain_name; ?></td>
							<td><?php echo $markup[$a]->product_name; ?></td>
							<td><?php echo $markup[$a]->api_name." (".$markup[$a]->api_credential_type.")"; ?></td>
							<!--<td><?php echo $markup[$a]->country_name." (".$markup[$a]->iso3_code.")"; ?></td>-->
							<!-- <td><?php echo $markup[$a]->airline_name_english; ?></td> -->
							<td><?php echo $markup[$a]->markup_type; ?></td>
							<td><?php echo $markup[$a]->amt_from; ?></td>
							<td><?php echo $markup[$a]->amt_to; ?></td>
							<td><?php echo $markup[$a]->markup_value; ?></td>
							<td><?php echo $markup[$a]->markup_fixed; ?></td>
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
									<a href="<?php echo site_url()."markup/inactive_amt_range_markup/".base64_encode(json_encode($markup[$a]->markup_details_id)); ?>" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-eye"></i>InActive</a>
								<?php }else{ ?>
									<a href="<?php echo site_url()."markup/active_amt_range_markup/".base64_encode(json_encode($markup[$a]->markup_details_id)); ?>" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-check"></i>Active</a>
								<?php } ?>
											
								<a onclick="return confirm('Are you sure you want to delete ?');" href="<?php echo site_url()."markup/delete_amt_range_markup/".base64_encode(json_encode($markup[$a]->markup_details_id)); ?>" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>
							</td>
						</tr>
					<?php } } ?>												
					</tbody>
				</table>
			</div>
			<!-- Footer -->
			<?php $this->load->view('general/footer');	?>				
		</div>				
		<!-- Chat Module -->
			<?php $this->load->view('general/chat');	?>	
	</div>
	<!-- Bottom Scripts -->
	<?php $this->load->view('general/load_js');	?>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.min.js"></script>	
	<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/TableTools.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/lodash.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/responsive/js/datatables.responsive.js"></script>

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
