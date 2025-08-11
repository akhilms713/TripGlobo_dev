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
                                        <h2>Manage XmlLogs<small> </small></h2>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                     
                                <table id="example" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                        <tr class="headings">


                                            <th>Sl No </th>
                                            <th>api_name </th>
                                            <th>PNR NO</th>
                                            <th>Booking Supplier No</th>
                                            <th>xml_timestamp </th>
                                           
                                            <th class=" no-link last"><span class="nobr">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        for($j=0;$j<count($booking_logs);$j++)
                                        {
                                           ?>
                                           <tr class="even pointer">
                                            
                                            <td class=" "><?php echo $j+1; ?></td>
                                            <td class=""><?php echo $booking_logs[$j]->api_name; ?> </td>
                                            <td class=""><?php echo $booking_logs[$j]->pnr_no; ?></td>
                                            <td class=""><?php echo $booking_logs[$j]->booking_supplier_number; ?></td>
                                            <td class=""><?php echo $booking_logs[$j]->supplier_timestamp; ?></td>

                                            
                                              <td class=" last">
                                             
                                                <a class='btn btn-inverse btn-xs ' data-toggle="tooltip" data-placement="top" title="" data-original-title='See the Prebook xml request' href='<?php echo base_url(); ?><?php echo $booking_logs[$j]->prebook_xml_request; ?>' role='button' download>
                                                                                        <i class='fa fa-search'></i>
                                                                              </a>
                                                <a class='btn btn-inverse btn-xs 'data-toggle="tooltip" data-placement="top" title="" data-original-title='See the Prebook xml response' href='<?php echo base_url(); ?><?php echo $booking_logs[$j]->prebook_xml_response; ?>' role='button' download>
                                                                                        <i class='fa fa-search'></i>
                                                                              </a> 
                                                <a class='btn btn-inverse btn-xs' data-toggle="tooltip" data-placement="top" title="" data-original-title='See the Process Terms Request' href='<?php echo base_url(); ?><?php echo $booking_logs[$j]->ProcessTermsRequest; ?>' role='button' download>
                                                                                        <i class='fa fa-search'></i>
                                                                              </a> 
                                                <a class='btn btn-inverse btn-xs' data-toggle="tooltip" data-placement="top" title="" data-original-title='See the Process Terms Response' href='<?php echo base_url(); ?><?php echo $booking_logs[$j]->ProcessTermsResponse; ?>' role='button' download>
                                                                                        <i class='fa fa-search'></i>
                                                                              </a> 
                                                <a class='btn btn-inverse btn-xs' data-toggle="tooltip" data-placement="top" title="" data-original-title='See the Start Booking Flight Request' href='<?php echo base_url(); ?><?php echo $booking_logs[$j]->StartBookingFlightRequest; ?>' role='button' download>
                                                                                        <i class='fa fa-search'></i>
                                                                              </a>
                                                <a class='btn btn-inverse btn-xs' data-toggle="tooltip" data-placement="top" title="" data-original-title='See the Start Booking Flight Response' href='<?php echo base_url(); ?><?php echo $booking_logs[$j]->StartBookingFlightResponse; ?>' role='button' download>
                                                                                        <i class='fa fa-search'></i>
                                                                                        </a>
                                                <a class='btn btn-inverse btn-xs' data-toggle="tooltip" data-placement="top" title="" data-original-title='See the Check Booking Flight Request' href='<?php echo base_url(); ?><?php echo $booking_logs[$j]->CheckBookingFlightRequest; ?>' role='button' download>
                                                                                        <i class='fa fa-search'></i>
                                                                                                        </a> 
                                                <a class='btn btn-inverse btn-xs' data-toggle="tooltip" data-placement="top" title="" data-original-title='See the Check Booking Flight Response' href='<?php echo base_url(); ?><?php echo $booking_logs[$j]->CheckBookingFlightResponse; ?>' role='button' download>
                                                                                        <i class='fa fa-search'></i>
                                                                                                        </a>                                                                                          
                                              </td>
                                        </tr>
                                        <?php
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
                        'iDisplayLength': 4,
                        "sPaginationType": "full_numbers",
                        "dom": 'T<"clear">lfrtip',
                        "tableTools": {
                            "sSwfPath": "<?php echo base_url('assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                        }
                    });
        });
    </script>

</body>

</html>