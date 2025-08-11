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
      <link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
      <!-- editor -->
      <!-- <link href="<?php echo ASSETS; ?>css/bootstrap-wysihtml5.css" rel="stylesheet">
         -->
      <script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>
      <script src="<?php echo ASSETS; ?>js/jquery-1.11.0.js"></script>
    <script src="<?php  echo ASSETS; ?>js/jquery_ui.js"></script>
     <link href="<?php  echo ASSETS; ?>css/jquery_ui.css" rel="stylesheet" type="text/css">
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
                           Edit Airline Page
                        </h3>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                           <div class="x_content">
                           <?php if(isset($msg)){?>
                             <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                  <div class="alert alert-success">
                                      <strong><?php echo $msg; ?></strong>
                                  </div>
                                </div>
                             </div>
                             <?php } ?>
                              <form class="form-horizontal form-label-left input_mask" novalidate method="post" action="" enctype="multipart/form-data">
                                 <div class="item form-group">
                                    <label for="subject" class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <select id="ad_type" name="ad_type" class="ft ad_type form-control col-md-7 col-xs-12">
                                        <option value="<?php echo $ad->ad_type; ?>"><?php echo $ad->ad_type; ?></option>
                                        <option value="FLIGHT">Flight</option>
                                        <option value="CAR">Car</option>
                                        <option value="HOTEL">Hotel</option>
                                       </select>
                                    </div>
                                 </div>

                                 <div class="item form-group">
                                    <label for="message" class="control-label col-md-3 col-sm-3 col-xs-12">Image </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                       <input type="file" name="ad_image" id="ad_image" class="ft ad_image form-control col-md-7 col-xs-12">
                                    </div>

                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                       <img style="width: 100%;height: 50px;" src="<?php echo WEB_URL; ?>uploads/sponsor_ad/<?php echo $ad->ad_image; ?>">
                                    </div>
                                 </div>

                                 <div class="item form-group">
                                    <label for="message" class="control-label col-md-3 col-sm-3 col-xs-12">Details </label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                       <textarea  name="ad_content" required="required" id="ad_content"  class="form-control" style=" height: 200px"><?php echo $ad->ad_content; ?></textarea>
                                    </div>
                                 </div>
                                 <div class="ln_solid"></div>
                                 <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                       <button type="submit" id="submit-btn" class="btn btn-success">Submit</button>
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
      <!-- richtext editor -->
      <!-- 
         <script src="<?php echo ASSETS; ?>js/wysihtml5-0.3.0.js"></script>
         <script src="<?php echo ASSETS; ?>js/bootstrap3-wysihtml5.js"></script>
          -->
      <script>
      var api_url='<?php echo WEB_FRONT_URL; ?>';
        $(function() {
          $(".airportName").autocomplete({
             source: api_url+"general/get_flight_suggestions",
            minLength: 2,//search after two characters
            autoFocus: true, // first item will automatically be focused
            select: function(event,ui){
                $(".departflight").focus();
                //$(".flighttoo").focus();
            }
            
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
             .on('keyup blur', 'input',  function () {
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
      <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
      <script>tinymce.init({
         selector: 'textarea',
         height: 400,
         theme: 'modern',
         plugins: [ 
           'advlist autolink lists link image charmap print preview hr anchor pagebreak',
           'searchreplace wordcount visualblocks visualchars code fullscreen',
           'insertdatetime media nonbreaking save table contextmenu directionality',
           'emoticons template paste textcolor colorpicker textpattern imagetools'
         ],
         toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
         toolbar2: 'print preview media | forecolor backcolor emoticons',
         image_advtab: true,
         templates: [
           { title: 'Test template 1', content: 'Test 1' },
           { title: 'Test template 2', content: 'Test 2' }
         ],
         content_css: [
           '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
           '//www.tinymce.com/css/codepen.min.css'
         ]
         });
      </script>
   </body>
</html>