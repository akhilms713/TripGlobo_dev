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

    <link href="<?php echo ASSETS; ?>css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
   <link type="text/css" rel="stylesheet" href="<?php echo ASSETS; ?>/css/common/toastr.css?1425466569" />

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
							<form method="post" action="<?php echo site_url()."markup/add_markup"; ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">User Type</label>									
									<div class="col-sm-5">
										<select name="user_type" class="form-control select2" required onchange="chaeck_user(this.value)">
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
											<select name="agent_name" class="form-control select2" required >
											<option value="0">Select User</option>
											<?php for ($i=0; $i < count($agents); $i++) { ?>
											<option value="<?php echo $agents[$i]->user_details_id;?>" data-iconurl=""><?php echo $agents[$i]->user_name.'-'.$agents[$i]->user_email;?></option>;
											<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group hide">
									<label for="field-1" class="col-sm-3 control-label">Domain</label>									
									<div class="col-sm-5">
										<select name="domain" class="form-control select2" required>
											<?php if($domain!=''){ for($d=0;$d<count($domain);$d++){ ?>
											<option value="<?php echo $domain[$d]->domain_details_id; ?>" data-iconurl=""><?php echo $domain[$d]->domain_name; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Product</label>									
									<div class="col-sm-5">
										<select name="product" id="product" class="form-control select2" required>
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
										<select name="api" class="form-control select2" required>
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
										<select onchange="makup_type_details(this.value)" id="markup_type" name="markup_type" class="form-control select2" required>
											<option value="" data-iconurl="">Select Markup Type</option>
											<option value="GENERAL" data-iconurl="">GENERAL</option>
											<!-- <option value="SPECIFIC" data-iconurl="">SPECIFIC</option> -->
										</select>
									</div>
								</div>
								<!-- <div class="form-group" id="airline">
										<label for="field-1" class="col-sm-3 control-label">Airline</label>									
										<div class="col-sm-5">
											<select name="airline"  class="select2" required>
											<option value="0">Select Airline</option>
												<?php if($airline!=''){ for($ad=0;$ad<count($airline);$ad++){ ?>
												<option value="<?php echo $airline[$ad]->airline_code; ?>" <?php if($airline[$ad]->airline_name =="ALL"){ echo "selected"; } ?> data-iconurl=""><?php echo $airline[$ad]->airline_name_english; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div> -->	
								<div id="specific">
									<div class="form-group hide">
										<label for="field-1" class="col-sm-3 control-label">Country</label>									
										<div class="col-sm-5">
											<select name="country" class="form-control select2" required>
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
										<select  name="markup_value_type" class="form-control select2" required onchange="change_val(this.value)">
											<option value="1" data-iconurl="">%age</option>
											<option value="2" data-iconurl="">fixed</option>
										</select>
									</div>
								</div>
								<div id="percent">
									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Markup Value %age</label>									<!-- field-mv old -->
										<div class="col-sm-5">
											<input type="text" class="form-control" id="field-ms" name="markup_value" placeholder="Markup Value" data-validate="required" data-message-required="Please enter the Markup Value" autocomplete="off">
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
								<div class="form-group hide">
									<label class="col-sm-3 control-label">Markup Status</label>									
									<div class="col-sm-5">
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
											<input type="checkbox" name="status" value="ACTIVE" id="status" checked>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success">Add Markup Details</button>
									</div>
								</div>
							</form>
						</div>
					</div>				
				</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			 <!-- footer content -->
        <?php echo $this->load->view('common/footer'); ?>  
        <!-- /footer content -->

    </div>
    </div>
    <!-- /page content -->
</div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>

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
<script src="<?php echo ASSETS; ?>js/datatables/js/jquery.dataTables.js"></script>
<script src="<?php echo ASSETS; ?>js/datatables/tools/js/dataTables.tableTools.js"></script>
 <script src="<?php echo ASSETS; ?>/js/toastr/toastr.js"></script>

<script>
        // initialize the validator function
        validator.message['date'] = 'not a real date';

        // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
        $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

        $('.multi.required')
        .on('keyup blur', 'input', function () {
            validator.checkField.apply($(this).siblings().last()[0]);
        });

        // bind the validation to the form submit event
        //$('#send').click('submit');//.prop('disabled', true);
		function get_user_id($vals)
		{
	$('#userid').val($vals);
		}
        $('form').submit(function (e) {

            e.preventDefault();
            var submit = true;
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }

            if (submit)
                this.submit();
            return false;
        });

        /* FOR DEMO ONLY */
        $('#vfields').change(function () {
            $('form').toggleClass('mode2');
        }).prop('checked', false);

        $('#alerts').change(function () {
            validator.defaults.alerts = (this.checked) ? false : true;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);



        $(document).ready(function () {
            var oTable = $('#api_list').dataTable({
                "oLanguage": {
                    "sSearch": "Search all columns:"
                },
                "aoColumnDefs": [
                {
                    'bSortable': false,
                    'aTargets': [0]
                        } //disables sorting for column one
                        ],
                        'iDisplayLength': 10,
                        "sPaginationType": "full_numbers",
                        "dom": 'T<"clear">lfrtip',
                        "tableTools": {
                            "sSwfPath": "<?php echo base_url('assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                        }
                    });

                $(".delete").click(function(e){
                    if(!confirm("Are you sure you want to delete.?"))
                    {
                        e.preventDefault();
                    }
                });


                    <?php
                if(isset($error['status']) && $error['status']!='')
                {
                    
                ?>
                toastr.<?php echo $error['status_tag']; ?>("<?php echo $error['status_msg']; ?>", '');

                <?php
                }
                ?>
        });
    </script>
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
	</script>

</body>

</html>
