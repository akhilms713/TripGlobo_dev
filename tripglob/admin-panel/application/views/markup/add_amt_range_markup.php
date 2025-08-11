<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Provab Admin Panel" />
	<meta name="author" content="" />	
	<title><?php echo PAGE_TITLE; ?> | Markup</title>	  <link rel="icon" href="https://tripglobo.com/beta1/assets/theme_dark/images/favicon.png" type="image/x-icon">
	<!-- Load Default CSS and JS Scripts -->
	<?php $this->load->view('general/load_css');	?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2.css">

	<link href="<?php echo FRONT_URL; ?>/assets/css/jquery-ui.css" rel="stylesheet" />  
	<script src="<?php echo FRONT_URL; ?>/assets/js/jquery-ui.js"></script> 
</head>
<body  id="top" oncontextmenu="return false" class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
	<div class="page-container <?php if(isset($header) && $header == 'header_top'){ echo "horizontal-menu"; } ?> <?php if(isset($header) && $header == 'header_right'){ echo "right-sidebar"; } ?> <?php if(isset($sidebar)){ echo $sidebar; } ?>">
		<?php if(isset($header) && $header == 'header_top'){ $this->load->view('general/header_top'); }else{ $this->load->view('general/left_menu'); }	?>
		<div class="main-content">
			<?php if(!isset($header) || $header != 'header_top'){ $this->load->view('general/header_left'); } ?>
			<?php $this->load->view('general/top_menu');	?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."markup/list_amt_range_markup"; ?>">Markup</a></li>
				<li class="active"><strong>Add New Markup</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Add New Markup
							</div>							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" action="<?php echo site_url()."markup/add_amt_range_markup"; ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">User Type</label>									
									<div class="col-sm-5">
										<select name="user_type" class="select2" required onchange="chaeck_user(this.value)">
											<?php if($user_type!=''){ for($a=0;$a<count($user_type);$a++){ ?>
											<option value="<?php echo $user_type[$a]->user_type_id; ?>" data-iconurl=""><?php echo $user_type[$a]->user_type_name; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
								<div id="agent_list">
									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Select Agent</label>
										<div class="col-sm-5">
											<select name="agent_name" class="select2" required >
											<option value="">Select User</option>
											<?php for ($i=0; $i < count($agents); $i++) { ?>
											<option value="<?php echo $agents[$i]->user_details_id;?>" data-iconurl=""><?php echo $agents[$i]->user_name.'-'.$agents[$i]->user_email;?></option>;
											<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Domain</label>									
									<div class="col-sm-5">
										<select name="domain" class="select2" required>
											<?php if($domain!=''){ for($d=0;$d<count($domain);$d++){ ?>
											<option value="<?php echo $domain[$d]->domain_details_id; ?>" data-iconurl=""><?php echo $domain[$d]->domain_name; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Product</label>									
									<div class="col-sm-5">
										<select name="product" id="product" class="select2" required>
										<option value="">Select Product</option>
											<?php if($product!=''){ for($p=0;$p<count($product);$p++){ ?>
											<option value="<?php echo $product[$p]->product_details_id; ?>" data-iconurl=""><?php echo $product[$p]->product_name; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>	
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">API</label>									
									<div class="col-sm-5">
										<select name="api" class="select2" required>
										<option value="" data-iconurl="">Select Api</option>
											<?php if($api!=''){ for($a=0;$a<count($api);$a++){ ?>
											<option value="<?php echo $api[$a]->api_details_id; ?>" data-iconurl=""><?php echo $api[$a]->api_name ." (".$api[$a]->api_credential_type.")"; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Markup Type</label>									
									<div class="col-sm-5">
										<select onchange="makup_type_details(this.value)" id="markup_type" name="markup_type" class="select2" required>
											<option value="" data-iconurl="">Select Markup Type</option>
											<option value="SPECIFIC" data-iconurl="">SPECIFIC</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="field-2" class="col-sm-3 control-label">Amount From</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="amt_from" name="amt_from" placeholder="Enter amount" data-validate="required" data-message-required="Please enter the amount">
										<span id="from_msg"></span>
									</div>
								</div>

								<div class="form-group">
									<label for="field-2" class="col-sm-3 control-label">Amount To</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="amt_to" name="amt_to" placeholder="Enter amount" data-validate="required" data-message-required="Please enter the amount">
										<span id="to_msg"></span>
									</div>
								</div>
								
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Markup Type</label>									
									<div class="col-sm-5">
										<select  name="markup_value_type" class="select2" required onchange="change_val(this.value)">
											<option value="1" data-iconurl="">%age</option>
											<option value="2" data-iconurl="">fixed</option>
										</select>
									</div>
								</div>
								<div id="percent">
									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Markup Value %age</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="field-ms" name="markup_value" placeholder="Markup Value" data-validate="required" data-message-required="Please enter markup value" autocomplete="off">
										</div>
									</div>
								</div>
								<div id="fixed">
								<div class="form-group">
									<label for="field-2" class="col-sm-3 control-label">Markup Value Fixed</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-mf" name="markup_fixed" placeholder="Markup Fixed" data-validate="required" data-message-required="Please enter the Markup Fixed">
									</div>
								</div>
								</div>
								<!-- <div class="form-group">
									<label class="col-sm-3 control-label">Markup Status</label>									
									<div class="col-sm-5">
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
											<input type="checkbox" name="status" value="ACTIVE" id="status" checked>
										</div>
									</div>
								</div> -->
								
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" id="add_mark" class="btn btn-success">Add Markup Details</button>
									</div>
								</div>
							</form>
						</div>
					</div>				
				</div>
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
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>	
	<script src="<?php echo base_url(); ?>assets/js/fileinput.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/select2/select2.min.js"></script>
	<script>
		$(function(){
			$('#specific').hide();
			$("#agent_list").hide();
			$("#fixed").hide();
			$('#status').change(function(){
				var current_status = $('#status').val();
				if(current_status == "ACTIVE")
					$('#status').val('INACTIVE');
				else
					$('#status').val('ACTIVE');
			});
			
		});
		function makup_type_details(value){
			if(value == "SPECIFIC"){
				$('#specific').show();
			}else{
				$('#specific').hide();
			}
		}
		function change_val(val){
			if(val == 1){
				$("#fixed").hide();
				$("#percent").show();
			}else{
				$("#fixed").show();
				$("#percent").hide();
			}
		}
		function trip_type_change(value){
			if(value=='1'){
				$('#source_class').show();
				$('#destination_class').hide();
			}else if(value=='2'){
				$('#source_class').show();
				$('#destination_class').show();
			}else{
				$('#source_class').hide();
				$('#destination_class').hide();
			}
		}
		
	</script>
	<script type="text/javascript">
		function chaeck_user(id){
				if(id == 3){
					$("#agent_list").show();

				}else{
					$("#agent_list").hide();
				}
		}
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			//function allow only numbers and .(special char and %)
			$("#field-mv").on("keypress",function(event){
				var ew = event.which;        		
		        if ((ew == 8  || ew == 0 || ew == 16 || ew == 46 )||(ew >= 48 && ew <= 57) ){
		            
		            return true;
		        
		        }
		        return false;
			});
			
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			//alert();
			$('#product').change(function(){
				var pro = $('#product').val(); //alert(pro);
				if(pro == 2){
					$('#airline').hide();
					
				}else{
					$('#airline').show();
				}
			});
			$('#markup_type').change(function(){
				var pro = $('#product').val();
				var mark = $('#markup_type').val();
				// alert(pro);
				// alert(mark);
				if((pro == 1) && (mark == "SPECIFIC")){
					$('#airline').show();
				}else if((pro == 2) && (mark == "SPECIFIC")){
					$('#airline').hide();
					alert("Specific Markup is Not Applicable for Hotel !..");
					window.location.reload();
				}else if((pro == 1) && (mark == "GENERAL")){
					$('#airline').hide();
				}
			});
		});
		
		$("#from_city,#to_city").autocomplete({
			source: "<?php echo FRONT_URL; ?>/en/home/get_airports",
			minLength: 2, //search after two characters
			autoFocus: true, // first item will automatically be focused
			change: function (event, ui) {
			  	if(ui.item.label == 'Only GCG Countries Allowed, Please Review Your Search.!!'){
			    	$(this).val('');
			   	}
			    if(!ui.item){
			      $(".f_book_box1").val("");
			    }
			}
		});


		$('#amt_from').blur(function(key) { 
		  var decimal_filter  = /^[0-9]*[.][0-9]*?$/;  
		  var number_filter   = /^[0-9]+$/; 
		  if(!($('#amt_from').val().match(decimal_filter) || $('#amt_from').val().match(number_filter))){
		    $('#from_msg').html('Invalid Amount');
		    $("#from_msg").css({"color": "#FF0000"});
		    return false;
		  }else{
		    $('#from_msg').html('');
		  }
		});

		$('#amt_to').blur(function(key) { 
		  var decimal_filter  = /^[0-9]*[.][0-9]*?$/;  
		  var number_filter   = /^[0-9]+$/; 
		  if(!($('#amt_to').val().match(decimal_filter) || $('#amt_to').val().match(number_filter))){
		    $('#to_msg').html('Invalid Amount');
		    $("#to_msg").css({"color": "#FF0000"});
		    return false;
		  }else{
		    $('#to_msg').html('');
		  }
		});

		$('#add_mark').click(function (key) {
			var decimal_filter  = /^[0-9]*[.][0-9]*?$/;  
			var number_filter   = /^[0-9]+$/; 
			if(!($('#amt_from').val().match(decimal_filter) || $('#amt_from').val().match(number_filter))){
				$('#from_msg').html('Invalid Amount');
				$("#from_msg").css({"color": "#FF0000"});
				return false;
			}else{
				$('#from_msg').html('');
			}
			if(!($('#amt_to').val().match(decimal_filter) || $('#amt_to').val().match(number_filter))){
				$('#to_msg').html('Invalid Amount');
				$("#to_msg").css({"color": "#FF0000"});
				return false;
			}else{
				$('#to_msg').html('');
			}
		});
	</script>
</body>
</html>
