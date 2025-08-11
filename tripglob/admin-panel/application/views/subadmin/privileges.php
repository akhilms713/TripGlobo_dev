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

   <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet">

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
      <style>
            @media print{
                    table td:nth-child(4),
                    table th:nth-child(4) {
                          display: none;
                 }
            }
      </style>

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
                                        <h2>Privilege<small> </small></h2>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                     <form class="form-horizontal form-label-left" novalidate method="post" action="<?php echo WEB_URL; ?>subadmin/add_privileges">


                                      <div class="item form-group">
                                        <label for="role_name" class="control-label col-md-3">Privilege Name</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="privilege_name" type="text" name="privilege_name"  class="form-control col-md-7 col-xs-12" required="required">
                                        </div>
                                        <div class="form-group">
                                            <div class="">

                                                <button id="send" type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="ln_solid"></div>
                                    
                                </form>
                                <table id="example" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                        <tr class="headings">

                                            <th>Sl No </th>
                                            <th>Privileges </th>
                                            <th>Date Of Creation</th>
                                            <th class=" no-link last"><span class="nobr">Action</span>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
										if(!empty($admin_privileges))
										{
                                        for($j=0;$j<count($admin_privileges);$j++)
                                        {
                                           ?>
                                           <tr class="even pointer">
                                            <td><?php echo $j+1; ?></td>
                                            <td><?php echo $admin_privileges[$j]->privilege_name; ?> </td>
 <td class=""><?php echo date(SITE_TIME_FORMAT,strtotime($admin_privileges[$j]->admin_privilege_creation_date_time)); ?></td>

                                            <td>
                                            <a href="<?php echo WEB_URL; ?>subadmin/edit_privileges/<?php echo $admin_privileges[$j]->privilege_id; ?>" onclick="return confirm('Do You Want to Edit this Privilege ?')"> <i class="fa fa-edit" title="Edit"></i>
                                        </a>
                                        &nbsp;
                                         <a id="delete_privilege" style="cursor:pointer" href="<?php echo WEB_URL; ?>subadmin/delete_privilege/<?php echo $admin_privileges[$j]->privilege_id; ?>" onclick="return confirm('Do You Want to delete this Privilege?')"> <i class="fa fa-remove" title="Remove"></i>
                                        </a>
                                   &nbsp;
                                           <a href="<?php echo WEB_URL; ?>subadmin/manage_functions/<?php echo $admin_privileges[$j]->privilege_id; ?>" onclick="return confirm('Do You Want to Assign Privilege Points to this Privilege?')"> <i class="fa fa-flash" title="Manage Privileges"></i>
                                        </a>
                                        
                                                
                                              
                                            </td>
                                        </tr>
                                        <?php
                                    }
										}
                                    ?>
                                </tbody>

                            </table>
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

 <script src="<?php echo ASSETS; ?>/js/toastr/toastr.js"></script>

<!-- form validation -->
<script src="<?php echo ASSETS; ?>js/validator/validator.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script>
   $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        $("body").on("click", ".buttons-pdf", function () {
            html2canvas($('#example')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500,
                          
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("TripGlobo.pdf");
                }
            });
        });
    </script>
</body>

</html>
