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
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2.css">
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
				<li><a href="<?php echo site_url()."markup"; ?>">Markup</a></li>
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
							<form method="post" action="<?php echo site_url()."markup/update_markup/".base64_encode(json_encode($markup[0]->markup_details_id)); ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">User Type</label>									
									<div class="col-sm-5">
										<select name="user_type" class="select2" required onchange="chaeck_user(this.value)">
											<?php if($user_type!=''){ for($a=0;$a<count($user_type);$a++){ ?>
											<option value="<?php echo $user_type[$a]->user_type_id; ?>" <?php if($user_type[$a]->user_type_id == $markup[0]->user_type_id){ echo "selected"; } ?> data-iconurl=""><?php echo $user_type[$a]->user_type_name; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
								<div id="agent_list">
									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Select Agent</label>
										<div class="col-sm-5">
											<select name="agent_name" class="select2" required>
											<?php for ($i=0; $i < count($agents); $i++) { ?>
											<option value="<?php echo $agents[$i]->user_details_id;?>" data-iconurl="" <?php if($agents[$i]->user_details_id == $markup[0]->user_details_id){echo "selected";} ?>><?php echo $agents[$i]->user_name.'-'.$agents[$i]->user_email;?></option>;
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
											<option value="<?php echo $domain[$d]->domain_details_id; ?>" <?php if($domain[$d]->domain_details_id == $markup[0]->domain_details_id){ echo "selected"; } ?> data-iconurl=""><?php echo $domain[$d]->domain_name; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Product</label>									
									<div class="col-sm-5">
										<select name="product" id="product" class="select2" required>
											<?php if($product!=''){ for($p=0;$p<count($product);$p++){ ?>
											<option value="<?php echo $product[$p]->product_details_id; ?>" <?php if($product[$p]->product_details_id == $markup[0]->product_details_id){ echo "selected"; } ?> data-iconurl=""><?php echo $product[$p]->product_name; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>	
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">API</label>									
									<div class="col-sm-5">
										<select name="api" class="select2" required>
											<?php if($api!=''){ for($a=0;$a<count($api);$a++){ ?>
											<option value="<?php echo $api[$a]->api_details_id; ?>" <?php if($api[$a]->api_details_id == $markup[0]->api_details_id){ echo "selected"; } ?> data-iconurl=""><?php echo $api[$a]->api_name ." (".$api[$a]->api_credential_type.")"; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Markup Type</label>									
									<div class="col-sm-5">
										<select onchange="makup_type_details(this.value)" id="markup_type" name="markup_type" class="select2" required>
											<option value="GENERAL" <?php if($markup[0]->markup_type =="GENERAL"){ echo "selected"; } ?> data-iconurl="">GENERAL</option>
											<option value="SPECIFIC" <?php if($markup[0]->markup_type =="SPECIFIC"){ echo "selected"; } ?> data-iconurl="">SPECIFIC</option>
										</select>
									</div>
								</div>
								<div class="form-group" id="airline">
										<label for="field-1" class="col-sm-3 control-label">Airline</label>									
										<div class="col-sm-5">
											<select name="airline" class="select2" required>
												<?php if($airline!=''){ for($ad=0;$ad<count($airline);$ad++){ ?>
												<option value="<?php echo $airline[$ad]->airline_code; ?>" <?php if($airline[$ad]->airline_code ==$markup[0]->airline_details_id){ echo "selected"; } ?> data-iconurl=""><?php echo $airline[$ad]->airline_name_english; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>	
								<div id="specific">
									<div class="form-group hide">
										<label for="field-1" class="col-sm-3 control-label">Country</label>									
										<div class="col-sm-5">
											<select name="country" class="select2" required>
												<option value="0">Select Country</option>
												<?php if($country!=''){ for($p=0;$p<count($country);$p++){ ?>
												<option value="<?php echo $country[$p]->country_id; ?>" <?php if($country[$p]->country_id == $markup[0]->country_id){ echo "selected"; } ?> data-iconurl=""><?php echo $country[$p]->country_name; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
									
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Markup Type</label>									
									<div class="col-sm-5">
										<select name="markup_value_type" class="select2" required onchange="change_val(this.value)">
											<option value="1" data-iconurl=""   <?php if($markup[0]->markup_value!='') { echo "selected"; } ?>>%age</option>
											<option value="2" data-iconurl="" <?php if($markup[0]->markup_fixed!='' && $markup[0]->markup_fixed!='0.00') { echo "selected"; } ?> >fixed</option>
										</select>
									</div>
								</div>	
								<div id="percent">
									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Markup Value %age</label>								<!-- id="field-mv" -->	
										<div class="col-sm-5">
											<input type="text" class="form-control" id="field-ms" name="markup_value" value="<?php echo $markup[0]->markup_value; ?>" data-validate="required" data-message-required="Please enter the Markup Value" autocomplete="off">
											<input type="hidden" name="old_percentage_value" value="<?php echo $markup[0]->markup_value; ?>">
										</div>
									</div>
								</div>
								<div id="fixed">
									<div class="form-group">
										<label for="field-2" class="col-sm-3 control-label">Markup Value Fixed</label>									
										<div class="col-sm-5">
											<input type="text" class="form-control" id="field-mf" name="markup_fixed" value="<?php echo $markup[0]->markup_fixed; ?>" data-validate="required" data-message-required="Please enter the Markup Fixed">
											<input type="hidden" name="old_fixed_value" value="<?php echo $markup[0]->markup_fixed; ?>">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Markup Status</label>									
									<div class="col-sm-5">
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
											<input type="checkbox" name="status" value="ACTIVE" id="status" <?php if($markup[0]->status =="ACTIVE"){ echo "checked"; } ?>>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Update Markup Details</button>
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
			<?php if($markup[0]->markup_type =="GENERAL"){ ?>
				$('#specific').hide();
			<?php } ?>
			<?php if($markup[0]->user_type_id ==3){ ?>
				$('#agent_list').show();
			<?php }else{ ?>
				$('#agent_list').hide();
			<?php } ?>
			<?php if($markup[0]->markup_fixed =="0.00" || $markup[0]->markup_fixed == NULL){ ?>
				$('#percent').show();
				$('#fixed').hide();
			<?php }else{ ?>
				$('#percent').hide();
				$('#fixed').show();
				<?php } ?>
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
			$('#product').change(function(){
				var pro = $('#product').val();//alert(pro);
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
				}else{
					$('#airline').hide();
				}
			});
		});
	</script>
	<script type="text/javascript">
		<?php if($markup[0]->markup_type =="GENERAL"){?>
			$('#airline').hide();
		<?php }?>
	</script>
</body>
</html>
