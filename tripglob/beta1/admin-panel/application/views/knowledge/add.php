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
      <link href="https://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
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
                           Add Knowledge
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
                              <form class="form-horizontal form-label-left input_mask"  method="post" action="" >
                                 <div class="item form-group">
                                    <label for="subject" class="control-label col-md-3 col-sm-3 col-xs-12">Subject</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <input id="subject" type="text" name="subject" class="ft subject form-control col-md-7 col-xs-12" value="" required="required">
                                    </div>
                                 </div>
                                 <div class="item form-group">
                                    <label for="message" class="control-label col-md-3 col-sm-3 col-xs-12">Details </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <textarea  name="details" required="required" id="details"  class="form-control" style=" height: 200px"></textarea>
                                    </div>
                                 </div>

                                 <div class="item form-group">
                                    <label for="subject" class="control-label col-md-3 col-sm-3 col-xs-12">Ststus</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <select id="status" name="status" class="ft status form-control col-md-7 col-xs-12" required>
                                        <option value="">Select Status</option>
                                        <option value="ACTIVE">Active</option>
                                        <option value="INACTIVE">Inactive</option>
                                       </select>
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
      
      <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
      <script>tinymce.init({
         selector: '#details',
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