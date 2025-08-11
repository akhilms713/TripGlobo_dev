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
          <?php echo $this->load->view('common/top_menu'); ?>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Admin Profile
                </h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Add New Sub-Admin<small> </small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left" novalidate method="post" action="<?php echo WEB_URL; ?>subadmin/add_subadmin_do" enctype="multipart/form-data">

                                            
                                          <div class="item form-group">
                                            <label for="fname" class="control-label col-md-3">Name</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="fname" type="text" name="fname"  class="form-control col-md-7 col-xs-12" required="required" pattern="[A-Za-z.]">
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="email" class="control-label col-md-3">Email</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="email" type="email" name="email"  class="form-control col-md-7 col-xs-12" required="required" >
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="password" type="password" name="password"  class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="password2" type="password" name="password2" class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="phone_number" type="text" name="phone_number"  class="form-control col-md-7 col-xs-12" required="required">
                                            </div>	
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="address" type="text" name="address" class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="city_name" class="control-label col-md-3 col-sm-3 col-xs-12">City Name</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="city_name" type="text" name="city_name"  class="form-control col-md-7 col-xs-12" required="required">
                                            </div>	
                                        </div>
                                        <div class="item form-group">
                                            <label for="zip_code" class="control-label col-md-3 col-sm-3 col-xs-12">Zip Code</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="zip_code" type="text" name="zip_code"   class="form-control col-md-7 col-xs-12" required="required" pattern="[0-9]">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="state_name" class="control-label col-md-3 col-sm-3 col-xs-12">State </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="state_name" type="text" name="state_name"   class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="country_code" class="control-label col-md-3 col-sm-3 col-xs-12">Country</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
												<select id="country_code" name="country_code"  class="form-control" required="required">
													<?php if(!empty($country_details)){ 
														foreach($country_details as $country_details){ ?>
														<option value="<?php echo $country_details->country_code; ?>" ><?php echo $country_details->country_name; ?></option>
													<?php } } ?>
												</select>
<!--
                                                <input id="country_code" type="text" name="country_code"  class="form-control col-md-7 col-xs-12" required="required">
-->
                                            </div>
                                        </div>
                                          <div class="item form-group">
                                            <label for="profile_photo" class="control-label col-md-3 col-sm-3 col-xs-12">Admin Role</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                         <select  required name="role" class="form-control col-md-7 col-xs-12">
                                         <?php if(!empty($role)) { for($i=0;$i<count($role);$i++)  { ?>
                                         <option value="<?php echo $role[$i]->admin_role_id; ?>"><?php echo $role[$i]->admin_role_name; ?></option>
                                         <?php
										 }
										 }
										 ?>
                                         </select>
                                      
                                             
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="profile_photo" class="control-label col-md-3 col-sm-3 col-xs-12">Profile Photo</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input  type="file" name="profile_photo" id="profile_photo" class="form-control col-md-7 col-xs-12" required>
                                            </div>
                                            <span>
                                                
                                            </span>
                                        </div>
                                        <!-- <div class="item form-group">
                                            <label for="zip_code" class="control-label col-md-3 col-sm-3 col-xs-12">Aadhar Card</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="aadhar_card" type="text" name="aadhar_card"   class="form-control col-md-7 col-xs-12" required="required" >
                                            </div>
                                        </div> -->
                                        <!--<div class="ln_solid"></div>-->
                                        <div class="form-group">   <div class="col-md-3 col-md-offset-3">
                                        <div for="pattern" class="" id="patternHolder3"></div>   <input   name="pattern"  id="patern" value=""   required type="hidden"  required >
                                        </div>
                                            <div class="col-md-9 ad-btn col-md-offset-3">
                                            
                                              <a href="javascript:history.back()"  class="btn btn-primary ad-cancel">Cancel</a>                                                
                                                <button id="send" type="submit" class="btn btn-success ad-save">Save</button>
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
$('#send').click(function(){   
   myfile= $('#profile_photo').val();
   var ext = myfile.split('.').pop();
   // console.log(ext);
   if(ext=="png" || ext=="gif" || ext=="jpeg"||ext=="jpg"){
   return true;        
   }else if(ext==""){
   toastr.<?php echo $error['status_tag']; ?>("This Field is Required", '');
   return false;        
   }
   else{
   return false; 
      alert('Only Image format will  be accepted');
       $('.company_file').val('');
   }

   return false; 
});
</script>
</body>
</html>
