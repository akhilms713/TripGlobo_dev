<?php
    //echo "<pre>"; print_r($orders); echo "</pre>"; die();

?>
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
	<link rel="stylesheet" href="<?php echo ASSETS; ?>css/switch-forms.css">
    <link href="<?php echo ASSETS; ?>css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
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
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                  Add New Banner
                </h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Add New Banner</h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
               <div class="" role="tabpanel" data-example-id="togglable-tabs">
<div id="myTabContent" class="tab-content">							
<form method="post" action="<?php echo site_url()."banner/add_banner"; ?>" class="form-horizontal form-groups-bordered validate" enctype= "multipart/form-data">				
								<div class="form-group hide">
									<label class="col-sm-3 control-label">Banner Type</label>									
									<div class="col-sm-5">										
										<select name="banner_type" class="form-control col-md-7 col-xs-12">
											<option value="MAIN_BANNER" data-iconurl="" >MAIN BANNER</option>
											<!-- <option value="INNER_BANNER" data-iconurl="" >INNER BANNER</option>
											<option value="SLIDER" data-iconurl="" >MAIN SLIDER</option>
											<option value="INNER_SLIDER" data-iconurl="" >INNER SLIDER</option> -->
										</select>
									</div>
								</div>
								<div class="form-group hide">
									<label for="field-1" class="col-sm-3 control-label">Banner Name</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-1" name="title" placeholder="Banner Name">
									</div>
								</div>
								<div class="form-group hide">
									<label for="field-2" class="col-sm-3 control-label">Banner Image Alternative text</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-2" name="img_alt_text" placeholder="Banner Image Alternative Text">
									</div>
								</div>
								<div class="form-group hide">
									<label for="field-3" class="col-sm-3 control-label">Banner URL</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-3" name="link" placeholder="Banner URL" data-validate="url" data-message-required="Please enter the proper Banner URL">
									</div>
								</div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Banner Position</label>									
									<div class="col-sm-5">
										<input type="text" class="form-control" id="field-1" name="position" placeholder="Banner Position" required>
									</div>
								</div>

										<div class="form-group">
									<label class="col-sm-3 control-label">Banner Image Upload <br>
										<span class="red">Image Resolution (1024X765 )</span>
									</label>
								
									<div class="col-sm-5">										
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" data-trigger="fileinput" style="height:35px;">
												<img src="https://tripglobo.com/beta1/assets/theme_dark/images/logo.jpg" alt="Banner Image" >
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail"></div>
											<div>
												<span class="btn btn-white btn-file">
													<span class="fileinput-new">Select image</span>
												   <input type="file" name="banner_logo" accept="image/*" required>
												</span>
												<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
											</div>
										</div>										
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Banner Status</label>									
									<div class="col-sm-5">
										<div id="label-switch" class="make-switch" data-on-label="Active" data-off-label="InActive">
											<input type="checkbox" name="status" value="ACTIVE" id="status" checked>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>									
									<div class="col-sm-5">
										<button type="submit" class="btn btn-success ad-save add-bann">Add Banner Details</button>
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

            <!-- /page content -->
        </div>
         <!-- footer content -->
               <?php echo $this->load->view('common/footer'); ?>  
               <!-- /footer content -->

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="<?php echo ASSETS; ?>js/bootstrap.min.js"></script>
	<script src="<?php echo ASSETS ?>js/bootstrap-switch.min.js"></script>
	<script src="<?php echo ASSETS ?>js/fileinput.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?php echo ASSETS; ?>js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo ASSETS; ?>js/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?php echo ASSETS; ?>js/custom.js"></script>
    <!-- form validation -->
    <script src="<?php echo ASSETS; ?>js/validator/validator.js"></script>
    
    	<script>
		$(function(){
			$('#status').change(function(){
				var status = $('#status').val();
				if(status == "ACTIVE")
					$('#status').val('INACTIVE');
				else
					$('#status').val('ACTIVE');
			});
		});
	</script>
</body>

</html>
