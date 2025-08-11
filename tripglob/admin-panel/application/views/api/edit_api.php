<?php
  //  echo "<pre>"; print_r($api); echo "</pre>"; die();

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
                   Api Management
                </h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Edit Api<small> </small></h2>
                                    
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

               <?php } ?>
               <form class="form-horizontal form-label-left input_mask" novalidate method="post" action="<?php echo WEB_URL; ?>api/edit_api_do/<?php echo $api->api_details_id; ?>" >

<?php

if( $api->api_name != 'AMADEUS1')
{
	?>                    <div class="item form-group">
                                            <label for="username" class="control-label col-md-3 col-sm-3 col-xs-12">Username</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="username" name="username" class="form-control" required="required" placeholder="username" value="<?php echo $api->api_username; ?>" >
                                            </div>
                                        </div>
                                         <div class="item form-group">
                                            <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="password" name="password" class="form-control" required="required" placeholder="password" value="<?php echo $api->api_password; ?>" >
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="tbranch" class="control-label col-md-3 col-sm-3 col-xs-12">PesuoCity Code</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="tbranch" name="tbranch" class="form-control" required="required" placeholder="tbranch" value="<?php echo $api->pseudo_city_code; ?>" >
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="WSAP" class="control-label col-md-3 col-sm-3 col-xs-12">WSAP</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="WSAP" name="wsap" class="form-control" required="required" placeholder="WSAP" value="<?php echo $api->api_WSAP; ?>" >
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="url" class="control-label col-md-3 col-sm-3 col-xs-12">API URL</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="url1" name="url" class="form-control" required="required" placeholder="url1" value="<?php echo $api->api_url; ?>" >
                                            </div>
                                        </div>
                                         <div class="item form-group">
                                            <label for="url2" class="control-label col-md-3 col-sm-3 col-xs-12">API URL1</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="url2" name="url2" class="form-control" required="required" placeholder="url2" value="<?php echo $api->api_url1; ?>" >
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="status" class="control-label col-md-3 col-sm-3 col-xs-12">API Status</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                             <select required="" name="status" class="form-control col-md-7 col-xs-12">
                                                  <option value="ACTIVE"<?php if($api->api_status=="ACTIVE") echo "SELECTED"; ?>>ACTIVE</option>
                                                  <option value="INACTIVE"<?php if($api->api_status=="INACTIVE")  echo  "SELECTED"; ?>>INACTIVE</option>
                                                 
                                             </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label for="mode" class="control-label col-md-3 col-sm-3 col-xs-12">API Mode</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                             <select required="" name="mode" class="form-control col-md-7 col-xs-12">
                                                  <option value="TEST" <?php if($api->api_credential_type=="TEST") echo "SELECTED"; ?>>TEST</option>
                                                  <option value="LIVE" <?php if($api->api_credential_type=="LIVE") echo "SELECTED"; ?>>LIVE</option>
                                                  <option value="CERTIFICATION" <?php if($api->api_credential_type=="CERTIFICATION") echo "SELECTED"; ?>>CERTIFICATION</option>
                                                  <option value="DEVELOPMENT" <?php if($api->api_credential_type=="DEVELOPMENT") echo "SELECTED"; ?>>DEVELOPMENT</option>
                                              
                                             </select>
                                            </div>
                                        </div>





                                        <?php
}
?>
                                        
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                              
                                                <button type="submit" class="btn btn-success">Submit</button>
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