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
                                    </div>



                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">

                                            <button id="send" type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </div>
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
                                            <a href="<?php echo WEB_URL; ?>subadmin/edit_privileges/<?php echo $admin_privileges[$j]->privilege_id; ?>"> <i class="fa fa-edit" title="Edit"></i>
                                        </a>
                                        &nbsp;
                                         <a id="delete_privilege" style="cursor:pointer" href="<?php echo WEB_URL; ?>subadmin/delete_privilege/<?php echo $admin_privileges[$j]->privilege_id; ?>"> <i class="fa fa-remove" title="Remove"></i>
                                        </a>
                                   &nbsp;
                                           <a href="<?php echo WEB_URL; ?>subadmin/manage_functions/<?php echo $admin_privileges[$j]->privilege_id; ?>"> <i class="fa fa-flash" title="Send Email"></i>
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
<script src="<?php echo ASSETS; ?>js/datatables/js/jquery.dataTables.js"></script>
<script src="<?php echo ASSETS; ?>js/datatables/tools/js/dataTables.tableTools.js"></script>

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
        $('#send').click('submit');//.prop('disabled', true);

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



        $(document).ready(function () {
            var oTable = $('#example').dataTable({
                "oLanguage": {
                    "sSearch": "Search all columns:"
                },
                "aoColumnDefs": [
                {
                    'bSortable': false,
                    'aTargets': [0]
                        } //disables sorting for column one
                        ],
                        'iDisplayLength': 10,
                        "sPaginationType": "full_numbers",
                        "dom": 'T<"clear">lfrtip',
                        "tableTools": {
                            "sSwfPath": "<?php echo base_url('assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                        }
                    });
               
        });
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