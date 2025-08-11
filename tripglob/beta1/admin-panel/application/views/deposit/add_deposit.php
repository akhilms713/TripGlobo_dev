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
                   Deposit Management
                </h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Add New Deposit<small> </small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left"  method="post" action="<?php echo WEB_URL; ?>deposit/add_deposit_do" enctype="multipart/form-data">
										<div class="form-group">
											<input type="hidden" value="banking" class="banking_types" name="banking_types">
											<div class="col-sm-7 controls adeposit-radio">
											  <label class="control-label col-sm-4" for="amount">
											  <div class="iradio_flat-blue checked" id="banking" style="position: relative;">
												<input type="radio" class="triprad iradio_flat-blue" name="banking_type"  style="position: absolute; " checked>
												<ins class="iCheck-helper" id="banking" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
											  <strong>Banking &nbsp</strong>
											  </label>
											  <label class="control-label col-sm-4" for="amount">
											  <div class="iradio_flat-blue" id="cheque" style="position: relative;">
												<input type="radio" class="triprad iradio_flat-blue" name="banking_type" value="cheque" style="position: absolute; ">
												<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
											  <strong>Cheque &nbsp</strong>
											  </label>

                                             <!-- <label class="control-label col-sm-4" for="amount">
                                              <div class="iradio_flat-blue" id="cash" style="position: relative;">
                                                <input type="radio" class="triprad iradio_flat-blue" name="banking_type" value="cash" style="position: absolute; ">
                                                <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                                              <strong>Cash &nbsp</strong>
                                              </label>-->
											</div>
										  </div>
          
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Agent</label>
                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <select class="form-control js-example-basic-single" required name="user_det" >
                                                    <option value="">Choose Agent</option>
                                                    <?php
													foreach($user as $val)
													{
														?>
                                                    <option value="<?php echo $val->user_id; ?>"><?php echo $val->user_name; ?> (<?php echo $val->user_email; ?>)</option>
                                                    <?php
													}
													?>
                                                </select>
                                            </div>
                                        </div> 
											<div class="item form-group">
                                            <label for="amount" class="control-label col-md-3">Amount</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input id="amount" type="number" name="amount" maxlength="8"  class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
                                       
                                          <div class="item form-group">
                                            <label for="d_date" class="control-label col-md-3"> Date</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input id="d_date" type="date" name="d_date" class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
                                        <div class="banking_fields">
                                               <div class="item form-group">
                                            <label for="b_name" class="control-label col-md-3">Bank Name</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input id="b_name" type="text" name="b_name"  class="form-control col-md-7 col-xs-12"  >
                                            </div>
                                        </div>
                                          <div class="item form-group">
                                            <label for="b_branch" class="control-label col-md-3">Bank Branch</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input id="b_branch" type="text" name="b_branch"  class="form-control col-md-7 col-xs-12" >
                                            </div>
                                        </div>
                                         <div class="item form-group">
                                            <label for="b_city" class="control-label col-md-3">Bank City</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input id="b_city" type="text" name="b_city"  class="form-control col-md-7 col-xs-12"  >
                                            </div>
                                        </div>
                                        </div>
                                        <div class="cheque_fields">
                                         <div class="item form-group">
                                            <label for="c_date" class="control-label col-md-3">Cheque Date</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input id="c_date" type="date" name="c_date"  class="form-control col-md-7 col-xs-12"  >
                                            </div>
                                        </div>
                                        <!-- <div class="item form-group">
                                            <label for="c_date" class="control-label col-md-3">Cheque Date</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input id="c_date" type="date" name="c_date"  class="form-control col-md-7 col-xs-12"  >
                                            </div>
                                        </div>-->
                                        
                                         <div class="item form-group">
                                            <label for="c_number" class="control-label col-md-3">Cheque Number</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input id="c_number" type="number" name="c_number" maxlength="20" class="form-control col-md-7 col-xs-12" >
                                            </div>
                                        </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="Remarks" class="control-label col-md-3">Transaction Slip</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                              <input type="file" name="slip" >
                                            </div>
                                        </div>
                                        
                                         <div class="item form-group">
                                            <label for="Remarks" class="control-label col-md-3">Remarks</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                               <textarea required name="Remarks"></textarea>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="Remarks" class="control-label col-md-3">Service Charges Rs</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                              <input type="number" name="service_charge" id="service_charge" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <button type="reset" class="btn btn-primary">Cancel</button>
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

    <script src="<?php echo ASSETS; ?>js/custom.js"></script>
    <!-- form validation -->
    <script src="<?php echo ASSETS; ?>js/validator/validator.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    
    <script type="text/javascript">

        $('.js-example-basic-single').select2();
			$(document).on('click','.iradio_flat-blue',function(){
				$('.iradio_flat-blue').attr('class','iradio_flat-blue');
				$(this).attr('class','iradio_flat-blue checked');
				if ( $(this).attr('id') == 'banking'){
					$('.banking_fields').slideDown();
					$('.cheque_fields').slideUp();
					$('.banking_types').val('banking');
				} else if ( $(this).attr('id') == 'cheque'){
					$('.banking_fields').slideUp();
					$('.cheque_fields').slideDown();
					$('.banking_types').val('cheque');
				} else if ( $(this).attr('id') == 'cash'){
                    $('.banking_fields').slideDown();
                    $('.cheque_fields').slideUp();
                    $('.banking_types').val('cash');
                } 
                else{ }
			});
    </script>
    <script>
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {
          dd = '0' + dd
        }
        if (mm < 10) {
          mm = '0' + mm
        }
        
        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("d_date").setAttribute("min", today);
        document.getElementById("d_date").setAttribute("max", today);
    </script>
    
    
    <script>
		$(document).ready(function() {
			$('.cheque_fields').slideUp();
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
