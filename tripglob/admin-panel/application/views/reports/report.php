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
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="<?php echo ASSETS; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/animate.min.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>css/common/toggle-switch.css" rel="stylesheet" media="screen">
    <!-- Custom styling plus plugins -->
    <link href="<?php echo ASSETS; ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/icheck/flat/green.css" rel="stylesheet">

    <link href="<?php echo ASSETS; ?>css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
<style>
.switch-ios.switch-light {
    
    top: 0px !important; 
}
i{
  margin-right:5px;
  cursor:pointer;
}
</style>
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
                                    <?php echo $page_title; ?>
                                </h3>
                            </div>


                        </div>
                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    
                                    <div class="x_content">
                                    
                                <table id="example" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                        <tr class="headings">

                                            <th>Sl No </th>
                                            <th>Photo </th>
                                            <th>User Name</th>
                                            <th >Email</th>
                                            <th>Contact</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
										$i=1;
										if(!empty($users))
										{
                                        foreach($users as $user)
                                        {
                                        
                                           ?>
                                           <tr class="even pointer">

                                            <td class=" "><?php echo $i++; ?></td>
                                            <td class=""> <img width="50" title="<?php echo $user->user_name; ?>" alt="<?php echo $user->user_name; ?>" src="<?php echo UPLOAD_PATH.$user->profile_picture; ?>">
</td>
                                            <td class=""><?php echo $user->user_name; ?></td>
                                           <td class=""><?php echo $user->user_email; ?></td>
                                            <td class=""><?php
											if($user->home_phone!=0)
											{
											 echo $user->home_phone; 
											}
											else
											{
												echo '-';
											}?></td>
                                            <td class=""><?php 
 if($user->status!='PENDING')
               {
               ?> 
           <label class="switch-light switch-ios" id="ip_status<?php echo $user->status; ?>" style="width: 100px; " onclick="">
                    <input type="hidden" value="<?php  echo $user->status; ?>" id="alert_status_<?php echo $user->user_id; ?>" />
                                                          <input  class="whiteip1" id="whiteip1_<?php echo $user->user_id; ?>" data-alert_id1="<?php echo $user->user_id; ?>" type="checkbox"  <?php 
               if($user->status!='INACTIVE')
               {
               ?> checked="checked"  <?php
               }
               ?>  />
                                                          <span class="htspan"> <span>Inactive</span>
                                                           <span>Active</span>
                                                           
                                                           
                                                          </span>
                                                          <a><img id="whiteip_load1<?php echo $user->user_id; ?>"  width="26"  style="display: none;"  src="<?php echo ASSETS.'/images/loader1.gif'; ?>"></a>
                                                        </label>
              <?php
               }
               else
               {
               echo $user->status; 
               }
               ?>



                                            </td>
                                            <td>
                                            <a href="<?php echo WEB_URL; ?>b2c/view_profile/<?php echo $user->user_id; ?>"> <i class="fa fa-th-list" title="View profile"></i></a>
                                          <a href="<?php echo WEB_URL; ?>b2c/edit_profile/<?php echo $user->user_id; ?>">  <i class="fa fa-pencil-square-o" title="Edit profile"></i></a>
                        
                                          <a href="<?php echo WEB_URL; ?>orders/user_bookings/<?php echo $user->user_type_id; ?>/<?php echo $user->user_id; ?>">   <i class="fa fa-ticket" title="View Bookings"></i></a>
                                         <?php /*?>  <a href="<?php echo WEB_URL; ?>b2c/send_email_to_user/<?php echo $user->user_id; ?>"> <i class="fa fa-envelope" title="Send Email"></i></a>
                                        <a data-toggle="modal" data-target=".bs-example-modal-lg"  onClick="get_user_id('<?php echo $user->user_id; ?>')">    <i class="fa fa-gift" title="Send Promo"></i></a><?php */?>
                                          
                                            </td>

                                        </tr>
                                        <?php
                                    }
										}
                                    ?>
                                </tbody>

                            </table>
                            
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                    <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL; ?>b2c/send_user_promo">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Send Promo Ccde</h4>
                                            </div>
                                            <div class="modal-body">
                                                 
                                                 <div class='form-group'><strong>Choose Any One Promo</strong>

																								<?php $i = 1; foreach ($promo as $promos) { ?>

                                                                                                            <label class="control-label" for="validation_promo<?php echo $i; ?>"></label><br>

                                                                                                            <div class='radio'>

                                                                                                                <label><input type='radio' data-rule-required='true' id="validation_promo<?php echo $i; ?>" name="promoid" value='<?php echo $promos->promo_id; ?>'>

                                                                                                            <?php echo $promos->promo_code; ?> - <em> <font color="#FF00FD"><?php echo $promos->discount; ?>%</font> discount, valid upto <?php echo date('M j,Y', strtotime($promos->expiry_date)); ?></em>

                                                                                                                </label>

                                                                                                            </div>

																								<?php $i++; } ?>

                                                                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <input type="hidden" name="user_id" id="userid">
                                                <button type="button" class="btn btn-primary">Send Via Email</button>
                                            </div>

                                        </div>
                                        </form>
                                    </div>
                                </div>
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
		function get_user_id($vals)
		{
	$('#userid').val($vals);
		}
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
                            "sSwfPath": "<?php echo base_url('assets/js/datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                        }
                    });
        });
    </script>
    <script>
$('.whiteip1').on('click', function() {
	
		var curEle = $(this);
		var id1 = $(this).data('alert_id1');
		var status1 = $('#alert_status_'+id1).val();
		
		if(status1=='ACTIVE' || status1=='INACTIVE')
		{
   		$('#whiteip_load1'+id1).fadeIn();
		if(id1) {
			_id1 = id1.toString().trim();
		}
		
			_status1 = status1.toString().trim();
	if(_status1=='INACTIVE')
	{
		var s_status1 = 'ACTIVE';
	}
	else
	{
		var s_status1 = 'INACTIVE';
	}
	
		if(_id1.toString().length > 0 && !isNaN(_id1)) {


			$.ajax({
				url: '<?php echo WEB_URL; ?>b2c/update_user_status',
				type: "get",
                data: {id: _id1,status: s_status1},
				dataType: 'json',
				success: function(result) {
					$('#alert_status_'+id1).val(s_status1);
					$('#whiteip_load1'+id1).fadeOut();
                    window.location.reload();
				}
			});
		} else {
			
		}
		}
	});


    </script>

</body>

</html>
