<?php
    //echo "<pre>"; print_r($orders); echo "</pre>"; die();

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
	<link rel="stylesheet" href="<?php echo ASSETS; ?>/css/switch-forms.css">
	<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet">
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
                                 Banners
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
										 <th>Sl No</th>
											<!-- <th>Banner Title</th>
											<th>Banner Type</th>
											<th>Banner Alt Text</th> -->
											<th>Banner Image</th>
											<!-- <th>Banner URL</th> -->
											<th>Position</th>
											<th>Status</th>
											<th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                            <?php
                            if ($banner_list != '') {
                                for ($a = 0; $a < count($banner_list); $a++) {
                                    ?>
                                    <tr>
                                        <td><?php echo ($a + 1); ?></td>
                                        <!-- <td><?php echo $banner_list[$a]->title; ?></td>
                                        <td><?php echo $banner_list[$a]->banner_type; ?></td>
                                        <td><?php echo $banner_list[$a]->img_alt_text; ?></td> -->                                      
                                        <td class="center"><img src="<?php echo WEB_URL; ?>uploads/banner/<?php echo $banner_list[$a]->banner_image; ?>" alt="Banner Logo" width="100" height="50"></td>
                                        <!-- <td><?php echo $banner_list[$a]->link; ?></td> -->
                                        <td><?php echo $banner_list[$a]->position; ?></td>
                                        <td>
                                            <?php if ($banner_list[$a]->status == "ACTIVE") { ?>
                                                <button type="button" class="btn btn-green btn-icon icon-left">Active<i class="entypo-check"></i></button>
                                            <?php } else { ?>
                                                <button type="button" class="btn btn-orange btn-icon icon-left">InActive<i class="entypo-cancel"></i></button>
        <?php } ?>
                                        </td>
                                        <td class="center">
                                            <?php if ($banner_list[$a]->status == "ACTIVE") { ?>
                                                <a href="<?php echo WEB_URL."banner/inactive_banner/".base64_encode(json_encode($banner_list[$a]->banner_details_id)); ?>" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-eye"></i>InActive</a>
                                            <?php } else { ?>
                                                <a href="<?php echo WEB_URL."banner/active_banner/".base64_encode(json_encode($banner_list[$a]->banner_details_id)); ?>" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-check"></i>Active</a>
        <?php } ?>
                                            <a href="<?php echo WEB_URL."banner/edit_banner/".base64_encode(json_encode($banner_list[$a]->banner_details_id)); ?>" class="btn btn-default btn-sm btn-icon icon-left" onclick="return confirm('Do You Want to Edit this Banner Details ?')"><i class="entypo-pencil"></i>Edit</a>				
                                            <a href="<?php echo WEB_URL."banner/delete_banner/".base64_encode(json_encode($banner_list[$a]->banner_details_id)); ?>" class="btn btn-danger btn-sm btn-icon icon-left" onclick="return confirm('Do You Want to delete this Banner Details?')"> <i class="entypo-cancel"></i>Delete</a>
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


    </div>
    
        <!-- footer content -->
        <?php echo $this->load->view('common/footer'); ?>  
        <!-- /footer content -->
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
<script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.min.js"></script>
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
				data: {id: _id1,status: s_status1},
				method: "POST",
				 dataType: 'json',
				success: function(result) {
					 $('#alert_status_'+id1).val(s_status1);
					$('#whiteip_load1'+id1).fadeOut();
				}
			});
		} else {
			
		}
		}
	});


    </script>

</body>

</html>
