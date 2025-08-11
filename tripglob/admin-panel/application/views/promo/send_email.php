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
                    Send Promo To User
                </h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>PROMO : <?php echo $promo->promo_code; ?><em><small> <?php if($promo->promo_type == 'PERCENTAGE') { echo $promo->discount.' %'; 
                                    } else { echo $promo->discount.BASE_CURRENCY_ICON; } ?> discount </small></em></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
 <?php if($status=='1'){?>
                    <div class="alert alert-block alert-success alert-dismissable">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <h4 class="alert-heading">Success!</h4>
                    Your Password Successfully Updated.
                  </div>
              <?php }elseif($status=='0'){?>
                   <div class="alert alert-block alert-danger alert-dismissable">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <h4 class="alert-heading">Failure!</h4>
                     Your Password Not Updated Due To Some Error. Please Try Again After Some Time.
                  </div>
               <?php }elseif($status=='11'){?>
               <div class="alert alert-block alert-danger alert-dismissable">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <h4 class="alert-heading">Failure!</h4>
                     Current Password Worng, Please Enter Correct Password.
                  </div>
               <?php } ?>
                                    <form class="form-horizontal form-label-left" novalidate method="post" action="<?php echo WEB_URL; ?>promo/send_promo_to_user_do/<?php echo $id; ?>">

                                            
                                          <div class="item form-group">
                                            <label for="subject" class="control-label col-md-3">Subject</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="subject" type="text" name="subject"  class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
                                         <div class="control-group">
                                            <label class="control-label col-md-3 ">E-mail</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="tags_1"  type="text" name="emailid" class="tags form-control" value="" />
                                                <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                                            </div>
                                        </div>
                                        
                                        <div class='form-group'>
                          <label class='col-md-4 control-label'></label>
                          <div class='col-md-5'>
                          <?php
						  foreach($user_type as $user)
						  {
                            if ($promo->user_type == $user->user_type_id) {
                                
                            
							  ?>
                            <div class='checkbox'>
                              <label><input type='checkbox' class="flat" value='<?php echo $user->user_type_id; ?>' name="user_type[]"> <?php echo $user->user_type_name; ?> </label>
                            </div>
                           <?php
						  }}
						  ?>
                            </div>
                          </div>
                         
                                        
                                        
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3"> 
                                                <button id="send" type="submit" class="btn btn-success">Send</button>
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
    <script src="<?php echo ASSETS; ?>js/tags/jquery.tagsinput.min.js"></script>
    <script src="<?php echo ASSETS; ?>js/custom.js"></script>
    <!-- form validation -->
    <script src="<?php echo ASSETS; ?>js/validator/validator.js"></script>
    
    <script>
	  $(function () {
                $('#tags_1').tagsInput({
                    width: 'auto'
                });
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

</body>

</html>
