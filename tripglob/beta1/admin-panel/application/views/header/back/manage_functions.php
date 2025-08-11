<?php
    $result_arr = array();
    $i = 0;
    foreach ($privilege_functions as $key => $value) {
        $result_arr[$value->privilege_module][$i]["controller_name"] = $value->controller_name;
        $result_arr[$value->privilege_module][$i]["function_name"] = $value->function_name;
        $result_arr[$value->privilege_module][$i]["privilege_functions_id"] = $value->privilege_functions_id;
        $i++;
       
    }
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

    <link href="<?php echo ASSETS; ?>css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">

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
                                        <h2>Manage Privilege<small> </small></h2>
                                         <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form class="form-horizontal form-label-left" novalidate method="post" action="<?php echo WEB_URL; ?>subadmin/activate_functions">
                                            <?php
                                            foreach ($result_arr as $key => $arr) {
                                                ?>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="x_panel">
                                                        <div class="x_title">
                                                            <?php
                                                            echo "<h2>".$key."</h2>"
                                                            ?>
                                                            <ul class="nav navbar-right panel_toolbox">
                                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                                            </ul>
                                                            <div class="clearfix"></div>
                                                        </div>

                                                        <div class="x_content">
                                                            <?php
                                                            foreach ($arr as $value) {
                                                                if ($value["controller_name"] != "" || $value["controller_name"] != null || $value["function_name"] != "" || $value["function_name"] != null ) {
                                                                    $checked = "";
                                                                    if(count($active_functions) > 0){
                                                                        if (in_array($value["privilege_functions_id"], $active_functions)) {
                                                                            $checked = 'checked="checked"';
                                                                        }
                                                                    }
                                                                    echo '<input type="hidden" name="privilege_id" value="'.$privilege_id.'">';
                                                                    echo '<input type="checkbox" name="privilege[]" '.$checked.' value="'.$value["privilege_functions_id"].'" class="flat" /> '.$value["controller_name"].'/'.$value["function_name"];
                                                                    echo "<br />";
                                                                    
                                                                }
                                                            }
                                                            ?>
                                                        </div>

                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="col-md-12 col-md-offset-6">
                                                <button id="send" type="submit" class="btn btn-success">Save</button>
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
        <script src="<?php echo ASSETS; ?>js/datatables/js/jquery.dataTables.js"></script>
        <script src="<?php echo ASSETS; ?>js/datatables/tools/js/dataTables.tableTools.js"></script>
        
 <script src="<?php echo ASSETS; ?>/js/toastr/toastr.js"></script>
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
 