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
                   Header Menu
                </h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Add New Header Menu <small> </small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left" novalidate method="post" action="<?php echo WEB_URL; ?>header/add_header_do">


                                            
                                          <div class="item form-group">
                                            <label for="City Name" class="control-label col-md-3">Header Menu Name</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <input id="from" type="text" name="menu_name" class="ft fromflight form-control col-md-7 col-xs-12" value="" required="required">
                                            </div>
                                        </div>
                                         <div class="item form-group">
                                            <label for="Offer" class="control-label col-md-3">Menu Link Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                
                                                <select name="menu_type" class="form-control col-md-7 col-xs-12" >
                                                <option value="INTERNAL" >INTERNAL</option>
                                                <option value="EXTERNAL" >EXTERNAL</option>
                                              </select>
                                            </div>
                                        </div>
                                         <div class="item form-group">
                                            <label for="Offer Desc" class="control-label col-md-3">Header URL</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="menu_url" type="text" name="menu_url"  class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>
                                         <div class="item form-group">
                                            <label for="Special Title" class="control-label col-md-3">Menu Level</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                
                                                <select name="menu_level" class="form-control col-md-7 col-xs-12" >
                                                <option value="0" >0</option>
                                                <option value="1" >1</option>
                                              </select>
                                            </div>
                                        </div>
                                         <div class="item form-group">
                                            <label for="Special Desc" class="control-label col-md-3">Menu Position</label>
                                                 <div class="col-md-6 col-sm-6 col-xs-12">                                              
                                                 <input id="Menu Position" type="text" name="position"  class="form-control col-md-7 col-xs-12" required="required">

                                            </div>
                                        </div> 
                                        
                                        <div class="item form-group">
                                            <label for="Check-in" class="control-label col-md-3 col-sm-3 col-xs-12">Menu Status</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">                                                
                                                <select name="menu_status" class="form-control col-md-7 col-xs-12" >
                                                <option value="ACTIVE" >ACTIVE</option>
                                                <option value="INACTIVE" >INACTIVE</option>
                                              </select>
                                            </div>
                                        </div>                                     


                                        <div class="ln_solid"></div>
                                        <div class="form-group">   
                                            <div class="col-md-3 col-md-offset-3">
                                            
                                              <a href="javascript:history.back()"  class="btn btn-primary">Cancel</a>                                                
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

     <script src="<?php echo ASSETS; ?>/js/ckeditor/ckeditor.js"></script>
    <script src="<?php echo ASSETS; ?>js/ckeditor/adapters/jquery.js"></script>


    <!-- form validation -->
    <script src="<?php echo ASSETS; ?>js/validator/validator.js"></script>
    <link href="<?php echo ASSETS; ?>css/common/patternLock.css"  rel="stylesheet" type="text/css" />
<script src="<?php echo ASSETS; ?>js/pattern/patternLock.js"></script>
<script type="text/javascript">
var api_url='http://192.168.0.128/china_eastern/';
// room adding for hotel
  function show_room_info(room_count,divid){
    if(room_count==''){
      room_count=0;
    }
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){
        document.getElementById(divid).innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET",api_url+"hotel/adult_child_binding_m/"+room_count,true);
    xmlhttp.send();
  }
  

(function($) {
  

  'use strict';

  $(document).on('show.bs.tab', '.nav-tabs-responsive [data-toggle="tab"]', function(e) {
    var $target = $(e.target);
    var $tabs = $target.closest('.nav-tabs-responsive');
    var $current = $target.closest('li');
    var $parent = $current.closest('li.dropdown');
    $current = $parent.length > 0 ? $parent : $current;
    var $next = $current.next();
    var $prev = $current.prev();
    var updateDropdownMenu = function($el, position){
      $el
        .find('.dropdown-menu')
        .removeClass('pull-xs-left pull-xs-center pull-xs-right')
        .addClass( 'pull-xs-' + position );
    };

    $tabs.find('>li').removeClass('next prev');
    $prev.addClass('prev');
    $next.addClass('next');
    
    updateDropdownMenu( $prev, 'left' );
    updateDropdownMenu( $current, 'center' );
    updateDropdownMenu( $next, 'right' );
  });

})(jQuery);
</script> 


</body>

</html>