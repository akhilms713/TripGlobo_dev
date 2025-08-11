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

               <?php } ?><form class="form-horizontal form-label-left input_mask" novalidate method="post" action="<?php echo WEB_URL; ?>b2b/edit_profile_do/<?php echo $user->user_id; ?>" >

                                        <div for="username" class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                            <input type="text" name="username" value="<?php echo $user->user_name; ?>" class="form-control has-feedback-left" required="required" id="username" placeholder="Name">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>

                                        

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                            <input type="text" disabled class="form-control has-feedback-left" required id="inputSuccess4" placeholder="Email" value="<?php echo $user->user_email_id; ?>">
                                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                        </div>
  <div class="col-md-7 col-sm-7 col-xs-12">
   <h2 class="green"><i class="fa fa-user"></i> Company Details</h2>
   <div class="item form-group">
                                            <label for="iatacode" class="control-label col-md-3 col-sm-3 col-xs-12">IATA Code</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="iatacode" name="iatacode" class="form-control"  placeholder="IATA" value="<?php echo $user->iata; ?>" >
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="branch" class="control-label col-md-3 col-sm-3 col-xs-12">No Of Branches</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="branch" name="branch" class="form-control"  placeholder="branch" value="<?php echo $user->no_branch; ?>" >
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
                                            <label for="zip_code" class="control-label col-md-3 col-sm-3 col-xs-12">Zip Code</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="zip_code" name="zip_code" value="<?php echo $user->zip_code; ?>" type="text" class="form-control" required placeholder="Zip Code">
                                            </div>
                                        </div>
                                          <div class="item form-group">
                                            <label for="country_name" class="control-label col-md-3 col-sm-3 col-xs-12">Country Name</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select name="country_name" id="country_name" class="form-control" required="required">
                                            <?php
											for($k=0;$k<count($country);$k++)
											{
												?>
                                                <option value="<?php echo $country[$k]->country_code; ?>" <?php if($user->country_code == $country[$k]->country_code) { echo 'selected'; } ?>><?php echo $country[$k]->country_name; ?></option>
                                                <?php
											}
											?>
                                            </select>
                                                 
                                            </div>
                                        </div>
                                         <div class="item form-group">
                                            <label for="mobile_phone" class="control-label col-md-3 col-sm-3 col-xs-12">Office Phone Name</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="mobile_phone" value="<?php echo $user->mobile_phone; ?>" name="mobile_phone" required  type="text" class="form-control"  placeholder="mobile_phone	"  >
                                            </div>
                                        </div>
                                        
  </div>
    <div class="col-md-5 col-sm-5 col-xs-12">
   <h2 class="green"><i class="fa fa-user"></i> Contact Details</h2>
   <div class="item form-group">
                                            <label for="c_p_name" class="control-label col-md-3 col-sm-3 col-xs-12">Contact Person</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="c_p_name" name="c_p_name" class="form-control"  required value="<?php echo $user->c_p_name; ?>" >
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="c_p_designation" class="control-label col-md-3 col-sm-3 col-xs-12">Designation</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="c_p_designation" name="c_p_designation" class="form-control" required="required" placeholder="" value="<?php echo $user->c_p_designation; ?>" >
                                            </div>
                                        </div>
                                         <div class="item form-group">
                                            <label for="c_p_email" class="control-label col-md-3 col-sm-3 col-xs-12">Email Address</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="c_p_email" name="c_p_email" class="form-control" required="required" placeholder=" " value="<?php echo $user->c_p_email; ?>" >
                                            </div>
                                        </div>
                                         <div class="item form-group">
                                            <label for="c_p_phone" class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="c_p_phone" name="c_p_phone" class="form-control" required="required" placeholder=" " value="<?php echo $user->c_p_phone; ?>" >
                                            </div>
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