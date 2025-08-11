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

    <link href="<?php echo ASSETS; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo ASSETS; ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/icheck/flat/green.css" rel="stylesheet">
    	<link rel="stylesheet" href="<?php echo ASSETS; ?>/css/switch-forms.css">

   <link type="text/css" rel="stylesheet" href="<?php echo ASSETS; ?>/css/common/toastr.css?1425466569" />

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
          <?php echo $this->load->view('common/top_menu'); 
         //~ echo "<pre/>";print_r($admin_profile_info);exit; 
         
	if(isset($admin_profile_info)){
			$name 		= $admin_profile_info->admin_name;
			$email 		= $admin_profile_info->admin_email;
			$address 	= $admin_profile_info->address;
			$city_name 	= $admin_profile_info->city_name;
			$zip_code 	= $admin_profile_info->zip_code;
			$state_name = $admin_profile_info->state_name;
			$country 	= $admin_profile_info->country_code;
			$admin_id 	= $admin_profile_info->admin_id;
			$profile_img= $admin_profile_info->admin_profile_pic;
			$admin_pattren= $admin_profile_info->admin_pattren;
			$address_details_id= $admin_profile_info->address_details_id;
			$admin_home_phone= $admin_profile_info->admin_home_phone;
			$admin_cell_phone= $admin_profile_info->admin_cell_phone;
			}  
				//$admin_id 	= 2;    
          ?>
          
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Admin Profile</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Edit Profile<small> </small></h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form class="form-horizontal form-label-left" novalidate method="post" action="<?php echo WEB_URL; ?>home/update_info" enctype="multipart/form-data">
                                          <div class="item form-group">
                                            <label for="fname" class="control-label col-md-3">Name</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="fname" type="text" name="fname"  value="<?php echo $name; ?>" class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="email" class="control-label col-md-3">Email</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="email" type="text" name="email" value="<?php echo $email; ?>" class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="email" class="control-label col-md-3">Cell Phone</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="cell_phone" type="number" name="cell_phone" value="<?php echo $admin_cell_phone; ?>" class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="email" class="control-label col-md-3">Home Mobile</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="home_mobile" type="number" name="home_mobile" value="<?php echo $admin_home_phone; ?>" class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="address" type="text" name="address"  value="<?php echo $address; ?>" class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="city_name" class="control-label col-md-3 col-sm-3 col-xs-12">City Name</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="city_name" type="text" name="city_name" value="<?php echo $city_name; ?>" class="form-control col-md-7 col-xs-12" required="required">
                                            </div>	
                                        </div>
                                        <div class="item form-group">
                                            <label for="zip_code" class="control-label col-md-3 col-sm-3 col-xs-12">Zip Code</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="zip_code" type="text" name="zip_code" value="<?php echo $zip_code; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="state_name" class="control-label col-md-3 col-sm-3 col-xs-12">State </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="state_name" type="text" name="state_name" value="<?php echo $state_name; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="country_code" class="control-label col-md-3 col-sm-3 col-xs-12">Country</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
												<select id="country_code" name="country_code" required  class="form-control" >
													<?php
													 if(!empty($country_details)){ 
														foreach($country_details as $country_details){ ?>
														<option value="<?php echo $country_details->country_code; ?>"  <?php if($country == $country_details->country_code) echo "selected"; ?>><?php echo $country_details->country_name; ?></option>
													<?php } } ?>
												</select>
                                            </div>
                                        </div>
                           
                                    <!--    <div class="item form-group">
                                            <label for="profile_photo" class="control-label col-md-3 col-sm-3 col-xs-12">Profile Photo</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input  type="file" name="profile_photo"  value ="<?php $profile_img; ?>" id="profile_photo" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div> -->
                                        
                                   <!-- <div class="form-group">
									<label class="col-sm-3 control-label">Profile Photo</label>									
									<div class="col-sm-5">										
										<div class="fileinput fileinput-new" data-provides="fileinput">
											
											<div class="fileinput-new thumbnail" data-trigger="fileinput" style="height: 35px;">
												<img src="<?php echo  $profile_img; ?>" alt="Profile Image">
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail"></div>
											<div>
												<span class="btn btn-white btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="banner_logo" accept="image/*">
													<input type="file" value="<?php echo  $profile_img; ?>" name="profile_photo" accept="image/*">
													<input type="hidden" value="<?php echo  $profile_img; ?>" name="previous_profile_photo">
												</span>
												<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
											</div>
										</div>										
									</div>
								</div>-->
								<input type="hidden" name="admin_id"  value="<?php echo $admin_id;?>">
								<input type="hidden" name="address_details_id"  value="<?php echo $address_details_id; ?> ">
                                        <div class="ln_solid"></div>
                                        <div class="form-group">  
                                     <!--  
                                      <div class="col-md-3 col-md-offset-3">
                                        <div for="pattern" class="" id="patternHolder3"></div>   
                                        <input   name="pattern"  id="patern" value="<?php //echo $admin_pattren; ?>"  type="hidden"  required >
                                        </div> -->
                                            <div class="col-md-3 col-md-offset-3">
                                            
                                              <a href="javascript:history.back()"  class="btn btn-primary ad-cancel">Cancel</a>                                                
                                                <button id="send" type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
               <!-- footer content -->
               <?php echo $this->load->view('common/footer'); ?>  
               <!-- /footer content -->

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
 <script src="<?php echo ASSETS; ?>/js/toastr/toastr.js"></script>
    <script src="<?php echo ASSETS; ?>js/custom.js"></script>
    	<script src="<?php echo base_url(); ?>assets/js/fileinput.js"></script>
    <!-- form validation -->
    <script src="<?php echo ASSETS; ?>js/validator/validator.js"></script>
    <link href="<?php echo ASSETS; ?>css/common/patternLock.css"  rel="stylesheet" type="text/css" />
<script src="<?php echo ASSETS; ?>js/pattern/patternLock.js"></script>
    <script>
	var lock6=new PatternLock('#patternHolder3',{
    mapper: function(idx){
		  $(".patt-holder").css("background", "#0aa89e"); 
		  
        return (idx%9);
     },
   onDraw:function(pattern){
    $("#patern").val(pattern);
   }
});

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
    </script>
  <script type="text/javascript">
          <?php
if(isset($error['status']) && $error['status']!='')
{
	
?>
toastr.<?php echo $error['status_tag']; ?>("<?php echo $error['status_msg']; ?>", '');

<?php
}
?>
        </script>
</body>

</html>
