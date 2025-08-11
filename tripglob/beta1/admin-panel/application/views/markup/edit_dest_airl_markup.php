<!DOCTYPE html>
<html lang="en">`
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
    <link href="<?php echo ASSETS; ?>css/jquery_ui.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
   <link type="text/css" rel="stylesheet" href="<?php echo ASSETS; ?>/css/common/toastr.css?1425466569" />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>
	<script src="<?php echo ASSETS; ?>js/jquery_ui.js"></script>
	
<style>
.switch-ios.switch-light {
    
    top: 0px !important; 
}
i{
  margin-right:5px;
  cursor:pointer;
}
</style>
<?php 
$markup=$markup[0];
// debug($markup);exit();
 ?>

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
				<li><a href="<?php echo site_url()."dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
				<li><a href="<?php echo site_url()."markup/list_dest_air_markup"; ?>">Markup</a></li>
				<li class="active"><strong>Edit New Markup</strong></li>
			</ol>
			<div class="row">
				<div class="col-md-12">					
					<div class="panel panel-primary" data-collapsed="0">					
						<div class="panel-heading">
							<div class="panel-title">
								Edit New Markup
							</div>							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							</div>
						</div>						
						<div class="panel-body">							
							<form method="post" action="<?php echo site_url()."markup/add_dest_air_markup"; ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">User Type</label>									
									<div class="col-sm-5">
										<select name="user_type" class="select2 user_type" required onchange="chaeck_user(this.value)">
											<?php if($user_type!=''){ for($a=0;$a<count($user_type);$a++){ ?>
											<option value="<?php echo $user_type[$a]->user_type_id; ?>" data-iconurl="" <?php if( $user_type[$a]->user_type_id ==$markup->user_type_id){ echo "selected"; } ?>><?php echo $user_type[$a]->user_type_name; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
								<input type="hidden" name="markup_details_id" value="<?=$markup->markup_details_id?>">
								<div id="agent_list">
									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Select Agent</label>
										<div class="col-sm-5">
											<select name="agent_name" class="select2">
											<option value="All">Select User</option>
											<?php for ($i=0; $i < count($agents); $i++) { ?>
											<option value="<?php echo $agents[$i]->user_id;?>" <?php if( $agents[$i]->user_id==$markup->user_details_id && $markup->user_details_id != 0){ echo "selected"; } ?>><?php echo $agents[$i]->user_name.'-'.$agents[$i]->user_email;?></option>;
											<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group hide">
									<label for="field-1" class="col-sm-3 control-label">Domain</label>									
									<div class="col-sm-5">
										<select name="domain" class="select2" required>
											<?php if($domain!=''){ for($d=0;$d<count($domain);$d++){ ?>
											<option value="<?php echo $domain[$d]->domain_details_id; ?>" <?php if( $domain[$d]->domain_details_id ==$markup->domain_details_id){ echo "selected"; } ?> data-iconurl=""><?php echo $domain[$d]->domain_name; ?></option>
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
											<option value="<?php echo $product[$p]->product_details_id; ?>"  <?php if( $product[$p]->product_details_id ==$markup->product_details_id){ echo "selected"; } ?> data-iconurl=""><?php echo $product[$p]->product_name; ?></option>
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
											<option value="<?php echo $api[$a]->api_details_id; ?>" <?php if($api[$a]->api_details_id ==$markup->api_details_id){ echo "selected"; } ?> data-iconurl=""><?php echo $api[$a]->api_name ." (".$api[$a]->api_credential_type.")"; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Markup Type</label>									
									<div class="col-sm-5">
										<select onchange="makup_type_details(this.value)" id="markup_type" name="markup_type" class="select2" required>
											<option value="" data-iconurl="">Select Markup Type</option>
											<option value="SPECIFIC" selected data-iconurl="">SPECIFIC</option>
										</select>
									</div>
								</div>
								<div class="form-group" id="airline">
									<label for="field-1" class="col-sm-3 control-label">Airline</label>									
									<div class="col-sm-5">
										<select name="airline"  class="select2" required>
										<option value="">Select Airline</option>
											<?php if($airline!=''){ for($ad=0;$ad<count($airline);$ad++){ ?>
											<option value="<?php echo $airline[$ad]->airline_code; ?>" <?php if($airline[$ad]->airline_name ==$markup->airline_name){ echo "selected"; } ?> data-iconurl=""><?php echo $airline[$ad]->airline_name; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>	

								<div class="form-group" id="trip">
									<label for="field-1" class="col-sm-3 control-label">Trip Type</label>		
									<div class="col-sm-5">
										<select name="trip_type" onchange="trip_type_change(this.value)"  class="select2 trip_type" required>
											<option value="">Select Trip Type</option>
											<option value="1" <?php if($markup->trip_type == 1){echo'selected';}  ?> >One Way</option>
											<option value="2" <?php if($markup->trip_type == 2){echo'selected';}  ?>>Round Trip</option>
										</select>
									</div>
								</div>
<div class="form-group" id="source">
									<label for="field-1" class="col-sm-3 control-label">Source</label>		
									<div class="col-sm-5">
										<input type="text" required name="from_city" id="from_city" class="form-control ft fromflight  ui-autocomplete-input f_book_box1" value="<?=$markup->from_loc?>" onclick="this.select();" placeholder="City_or_Airport" autocomplete="off">
									</div>
								</div>	

								<div class="form-group" id="destination">
									<label for="field-1" class="col-sm-3 control-label">Destination</label>
									<div class="col-sm-5">
										<input type="text" required name="to_city" id="to_city" class="form-control ft  ui-autocomplete-input f_book_box1" value="<?=$markup->to_loc?>" onclick="this.select();" placeholder="City_or_Airport" autocomplete="off">
									</div>
								</div>


								<div class="form-group" id="source_class" style="display: none;">
									<label for="field-1" class="col-sm-3 control-label">Onward Class</label>
									<div class="col-sm-5">
										<select name="onward_class"  class="select2" required>
					                      <option value="All"<?php if($markup->onward_class == 'All'){echo'selected';}  ?>>Any</option>
					                      <option value="Economy"<?php if($markup->onward_class == 'Economy'){echo'selected';}  ?>>Economy</option>
					                      <option value="PremiumEconomy"<?php if($markup->onward_class == 'PremiumEconomy'){echo'selected';}  ?>>Premium Economy</option>
					                      <option value="Business"<?php if($markup->onward_class == 'Business'){echo'selected';}  ?>>Business</option>
					                      <option value="PremiumBusiness"<?php if($markup->onward_class == 'PremiumBusiness'){echo'selected';}  ?>>Premium Business</option>
					                      <option value="First"<?php if($markup->onward_class == 'First'){echo'selected';}  ?>>First Class</option>
					                    </select>
									</div>
								</div>	

								<div class="form-group" id="destination_class" style="display: none;">
									<label for="field-1" class="col-sm-3 control-label">Return Class</label>
									<div class="col-sm-5">
										<select name="return_class"  class="select2" required>
					                      <option value="All"<?php if($markup->onward_class == 'All'){echo'selected';}  ?>>Any</option>
					                      <option value="Economy"<?php if($markup->onward_class == 'Economy'){echo'selected';}  ?>>Economy</option>
					                      <option value="PremiumEconomy"<?php if($markup->onward_class == 'PremiumEconomy'){echo'selected';}  ?>>Premium Economy</option>
					                      <option value="Business"<?php if($markup->onward_class == 'Business'){echo'selected';}  ?>>Business</option>
					                      <option value="PremiumBusiness"<?php if($markup->onward_class == 'PremiumBusiness'){echo'selected';}  ?>>Premium Business</option>
					                      <option value="First"<?php if($markup->onward_class == 'First'){echo'selected';}  ?>>First Class</option>
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
												<option value="<?php echo $country[$p]->country_id; ?>" <?php if($country[$p]->country_name =="ALL"){ echo "selected"; } ?> data-iconurl=""><?php echo $country[$p]->country_name; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
									<!-- <div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Airline</label>									
										<div class="col-sm-5">
											<select name="airline" id="airline" class="select2" required>
											<option value="0">Select Airline</option>
												<?php if($airline!=''){ for($ad=0;$ad<count($airline);$ad++){ ?>
												<option value="<?php echo $airline[$ad]->airline_details_id; ?>" <?php if($airline[$ad]->airline_name =="ALL"){ echo "selected"; } ?> data-iconurl=""><?php echo $airline[$ad]->airline_name; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>	 -->
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Markup Type</label>									
									<div class="col-sm-5">
										<select  name="markup_value_type" class="select2 markup_value_type" required onchange="change_val(this.value)">
											<option value="1" <?php if($markup->markup_value != 0 ||$markup->markup_value == ''){echo'selected';}  ?> data-iconurl="">%age</option>
											<option value="2" <?php if($markup->markup_fixed != 0 ||$markup->markup_fixed == ''){echo'selected';}  ?> data-iconurl="">fixed</option>
										</select>
									</div>
								</div>
								<div id="percent">
									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Markup Value %age</label>									<!-- field-mv old -->
										<div class="col-sm-5">
											<input type="text" class="form-control" id="field-ms" name="markup_value" placeholder="Markup Value" data-validate="required" value="<?=$markup->markup_value?>" data-message-required="Please enter the Markup Value" autocomplete="off">
										</div>
									</div>
								</div>
								<div id="fixed">
								<div class="form-group">
									<label for="field-2" class="col-sm-3 control-label">Markup Value Fixed</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-mf" name="markup_fixed" placeholder="Markup Fixed" data-validate="required" value="<?=$markup->markup_fixed?>" data-message-required="Please enter the Markup Fixed">
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
										<button id="hide" type="submit" class="btn btn-success">Update Markup Details</button>
									</div>
								</div>
							</form>
						</div>
					</div>				
				</div>
			</div>
			<!-- Footer -->
				<?php echo $this->load->view('common/footer'); ?> 			
		</div>				
		<!-- Chat Module -->
	</div>
	</div>
	</div>
	</div>
	</div>
	<!-- Bottom Scripts -->
	<?php //$this->load->view('general/load_js');	?>

	<script src="<?php echo ASSETS; ?>js/bootstrap.min.js"></script>
      <!-- chart js -->
      <script src="<?php echo ASSETS; ?>js/chartjs/chart.min.js"></script>
      <!-- bootstrap progress js -->
      <script src="<?php echo ASSETS; ?>js/progressbar/bootstrap-progressbar.min.js"></script>
      <script src="<?php echo ASSETS; ?>js/nicescroll/jquery.nicescroll.min.js"></script>
      <!-- icheck -->
      <script src="<?php echo ASSETS; ?>js/icheck/icheck.min.js"></script>
      <script src="<?php echo ASSETS; ?>js/custom.js"></script>
<script src="<?php echo ASSETS; ?>js/tags/jquery.tagsinput.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/moment.min2.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/datepicker/daterangepicker.js"></script>
	<!-- form validation -->
	<script src="<?php echo ASSETS; ?>js/validator/validator.js"></script>
	 <script type="text/javascript" src="https://tripglobo.com/beta1/assets/theme_dark/js/custom_modified.js"></script>
	
	
	
	
	
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
	
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>	
	<script src="<?php echo base_url(); ?>assets/js/fileinput.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/select2/select2.min.js"></script>
	<script>
		$(document).ready(function(){
			var value = $(".trip_type").val();
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

			var val= $(".markup_value_type").val();
			if(val == 1){
				$("#fixed").hide();
				$("#percent").show();
			}else{
				$("#fixed").show();
				$("#percent").hide();
			}
			var id= $(".user_type").val();
			if(id == 1){
					$("#agent_list").show();

				}else{
					$("#agent_list").hide();
				}
		});
		$(function(){
			// $('#specific').hide();
			// $("#agent_list").hide();
			// $("#fixed").hide();
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
				if(id == 1){
					$("#agent_list").show();

				}else{
					$("#agent_list").hide();
				}
		}
		// $(document).ready(function(){
        //  $("#agent_list").show();
		// });
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
				//	alert("Specific Markup is Not Applicable for Hotel !..");
					//window.location.reload();
				}else if((pro == 1) && (mark == "GENERAL")){
					$('#airline').hide();
				}
			});
		});
		
			$("#from_city,#to_city").autocomplete({
			source: "https://tripglobo.com/beta1/index.php/general/get_flight_suggestions",
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
		
		
		
		
	</script>
	
	<script>
	
	
// function search_option_from()
// {
//     var fromsearch=$("#from_city").val();
//     //alert(fromsearch);
//     $.ajax({
//         type: "POST",
//         url: "search_option_from",
//         data:{fromsearch:fromsearch},
//         success:function(data){
//             //alert(data);
//           $('#browsers').html('');
//             response = $.parseJSON(data);
//             var trHTML = '';
//             for(var f=0;f<response.length;f++) {
//                 //console.log(response[f]);
//               trHTML += '<option value='+response[f]["airport_city"]+'-'+response[f]["airport_name"]+','+response[f]["country"]+','+response[f]["airport_code"]+'></option>';
//              }
//           $("#browsers").html(trHTML);
//         }
//     });
// }

// function search_option_to(){
//     var tosearch=$("#to_city").val();
//       $.ajax({
//         type: "POST",
//         url: "search_option_to",
//         data:{tosearch:tosearch},
//         success:function(data){
//           // alert(data);
//           $('#browsers_to').html('');
//             response = $.parseJSON(data);
//             var trHTML = '';
//             for(var f=0;f<response.length;f++) {
//               trHTML += '<option value='+response[f]["airport_city"]+'-'+response[f]["airport_name"]+','+response[f]["country"]+','+response[f]["airport_code"]+'></option>';
           
//              }
//           $("#browsers_to").html(trHTML);
//         }
//     });
// }


	
	    	$(function() {
	    	   
                    $("#from_loc_id").autocomplete({
                        source: "search_option_from",
                        select: function( event, ui ) {
                            event.preventDefault();
                            console.log(ui,"hi");
                            $("#from_loc_id").val(ui.item.id);
                        },
                        maxLength: 2,
                		autoFocus: true,
                    });
                    $("#to_loc_id").autocomplete({
                        source: "search_option_from",
                        select: function( event, ui ) {
                            event.preventDefault();
                            console.log(ui,"hello");
                            $("#to_loc_id").val(ui.item.id);
                        },
                        maxLength: 2,
                		autoFocus: true,
                    });
                });
	</script>
</body>
</html>
