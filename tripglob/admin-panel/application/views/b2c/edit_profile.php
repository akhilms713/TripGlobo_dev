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
                    <?php echo $user->user_name; ?> Profile
                </h3>
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
				<?php if($status=='1'){?>
                    <div class="alert alert-block alert-success alert-dismissable">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <h4 class="alert-heading">Success!</h4>
                    Your Details Successfully Updated.
                  </div>
              <?php }elseif($status=='0'){?>
                   <div class="alert alert-block alert-danger alert-dismissable">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <h4 class="alert-heading">Failure!</h4>
                     Your Details Not Updated Due To Some Error. Please Try Again After Some Time.
                  </div>
               <?php }elseif($status=='11'){?>
               <div class="alert alert-block alert-danger alert-dismissable">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <h4 class="alert-heading">Failure!</h4>
                       Please Enter Correct Details.
                  </div>
               <?php } ?><form class="form-horizontal form-label-left input_mask" novalidate method="post" action="<?php echo WEB_URL; ?>b2c/edit_profile_do/<?php echo $user->user_id; ?>" >
						<div class="item form-group">
							<label for="address_v" class="control-label col-md-3 col-sm-3 col-xs-12">User Name</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="username" value="<?php echo $user->user_name; ?>" class="form-control has-feedback-left" required="required" id="username" placeholder="Name">
							</div>
						</div>
						<div class="item form-group">
							<label for="address_v" class="control-label col-md-3 col-sm-3 col-xs-12">Email Id</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" disabled class="form-control has-feedback-left" required id="inputSuccess4" placeholder="Email" value="<?php echo $user->user_email_id; ?>">
							</div>
						</div>
						<div class="item form-group">
							<label for="address_v" class="control-label col-md-3 col-sm-3 col-xs-12">Home Phone</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control" name="home_phone"  required id="inputSuccess5" placeholder="Home Phone" value="<?php echo $user->home_phone; ?>">
							</div>
						</div>
						<div class="item form-group">
							<label for="address_v" class="control-label col-md-3 col-sm-3 col-xs-12">Mobile Phone</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control" name="mobile_phone" required id="mobile_number" placeholder="Mobile Phone" value="<?php echo $user->mobile_phone; ?>">
							</div>
						</div>
						<div class="item form-group">
							<label for="address_v" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="address_v" name="address" class="form-control" required="required" placeholder="Address" value="<?php echo $user->address; ?>" >
							</div>
						</div>
						<div class="item form-group">
							<label for="city_name" class="control-label col-md-3 col-sm-3 col-xs-12">City Name </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value="<?php echo $user->city_name; ?>" id="city_name" name="city_name" class="form-control" required placeholder="City Name">
							</div>
						</div>
						<div class="item form-group">
							<label for="state_name" class="control-label col-md-3 col-sm-3 col-xs-12">State Name</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value="<?php echo $user->state_name; ?>" id="state_name" class="form-control" name="state_name" required placeholder="State Name">
							</div>
						</div>
						 <div class="item form-group">
							<label for="zip_code" class="control-label col-md-3 col-sm-3 col-xs-12">Zip Code</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input id="zip_code" name="zip_code" value="<?php echo $user->zip_code; ?>" type="text" class="form-control" required placeholder="Zip Code">
							</div>
						</div>
						  <div class="item form-group">
							<label for="country_name" class="control-label col-md-3 col-sm-3 col-xs-12">Country Name</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select id="country_name" name="country_name" required  class="form-control" >
									<?php if(!empty($country_details)){ 
										//~ echo "<pre/>";print_r($user);exit;
										foreach($country_details as $country_details){ ?>
										<option value="<?php echo $country_details->country_code; ?>"  <?php if($user->country_name == $country_details->country_name) echo "selected"; ?>><?php echo $country_details->country_name; ?></option>
									<?php } } ?>
								</select>
							</div>
						</div>
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
								<button type="submit" class="btn btn-success ad-save">Submit</button>
							</div>
						</div>
                        </form>
						</div>
					</div>
				</div>
			</div>
           </div>
               <?php echo $this->load->view('common/footer'); ?>  
            </div>
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

</body>

</html>
