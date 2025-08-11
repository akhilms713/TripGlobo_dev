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
                                    Change Requests
                                </h3>
                            </div>


                        </div>
                        <div class="clearfix"></div>
                        
                        <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#b2c_request">B2C</a></li>
                          <li><a data-toggle="tab" href="#staff_request">STAFF</a></li>
                        </ul>
                            
                            <div class="tab-content">
                              <div id="b2c_request" class="tab-pane fade in active">
                                     <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    
                                    <div class="x_content">
                                    
                                <table id="example_first" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                        <tr class="headings">

                                            <th>Sl No </th>
                                            <th>Pnr No.</th>
                                            <th>Change Request</th>
                                            <th>Created Date</th>
                                            <th>Remarks</th>
                                            <th>View Remark</th> 
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                     
										$i=1;
										if(!empty($reports_data))
										{
                                        foreach($reports_data as $report)
                                        {
                                            if($report['user_type_id'] == '2')
                                            {
                                        // echo"<pre/>";print_r($report);exit();
                                           ?>
                                           <tr class="even pointer">

                                            <td class=" "><?php echo $i++; ?></td>
                                            <td class=""><?php echo $report['pnr_no']; ?></td>
                                            <td class=""><?php echo $report['request']; ?></td>
                                            <td class=""><?php echo $report['create_date']; ?></td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#list_remark<?php echo $report['id']; ?>" class="btn btn-primary btn-xs has-tooltip" data-placement='top' title='Update remark'><span class="glyphicon glyphicon-info-sign"></span></a>
                                                <div class="modal fade" id="list_remark<?php echo $report['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Update Remark</h4>
                                                      </div>
                                                        <form action="<?=base_url()?>reports/update_request_remark" method="POST" autocomplete="off" class="form-horizontal" role="form">
                                                            <input type="hidden" value="<?php echo base64_encode(json_encode($report['id'])); ?>" name="request_id">
                                                          <div class="modal-body">
                                                            <div class='err_cont'>
                                                                <textarea name="remarks" required placeholder="No remark found !!" style="width: 575px; height: 353px;"><?php if($group_report[$k]['remarks']!=''){echo $group_report[$k]['remarks'];}?></textarea>
                                                            </div>                                        
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="submit" class="btn btn-default">Update Remark</button>
                                                          </div>
                                                        </form>
                                                    </div>
                                                  </div>
                                                </div>
                                            </td>
                                            
                                             <td>
                                                 <?php
                                                 if($report['flag']==0){
                                                 ?>
                                                <a href="<?php echo WEB_URL; ?>reports/update_change_status/<?php echo $report['id']; ?>"> <i class="fa fa-th-list" title="Take action!!"></i></a>
                                                <?php
                                                 }
                                                ?>
                                                
                                                <?php if($report['remarks']!=''){ ?>
                                                <a class="btn btn-primary btn-xs has-tooltip" href="<?php echo base_url(); ?>reports/get_request_remark_history/<?php echo base64_encode(json_encode($report['id'])); ?>" data-placement='top' title='GB Remark History' onclick="return confirm('Are you sure ,you want to See the history remark?')"> <span class="glyphicon glyphicon-book"></span></a>
                                                <?php } ?>
                                              </td> 

                                        </tr>
                                        <?php
                                                }
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
                              
                              <div id="staff_request" class="tab-pane fade">
                                     <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                
                                                <div class="x_content">
                                                
                                            <table id="example_second" class="table table-striped responsive-utilities jambo_table">
                                                <thead>
                                                    <tr class="headings">
            
                                                        <th>Sl No </th>
                                                        <th>Pnr No.</th>
                                                        <th>Change Request</th>
                                                        <th>Created Date</th>
                                                        <th>Remarks</th>
                                                         <th>View Remark</th> 
                                                    </tr>
                                                </thead>
            
                                                <tbody>
                                        <?php 
                                     
										$i=1;
										if(!empty($reports_data))
										{
                                        foreach($reports_data as $report)
                                        {
                                            if($report['user_type_id'] == '4')
                                            {
                                        // echo"<pre/>";print_r($report);exit();
                                           ?>
                                           <tr class="even pointer">

                                            <td class=" "><?php echo $i++; ?></td>
                                            <td class=""><?php echo $report['pnr_no']; ?></td>
                                            <td class=""><?php echo $report['request']; ?></td>
                                            <td class=""><?php echo $report['create_date']; ?></td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#list_remark<?php echo $report['id']; ?>" class="btn btn-primary btn-xs has-tooltip" data-placement='top' title='Update remark'><span class="glyphicon glyphicon-info-sign"></span></a>
                                                <div class="modal fade" id="list_remark<?php echo $report['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Update Remark</h4>
                                                      </div>
                                                        <form action="<?=base_url()?>reports/update_request_remark" method="POST" autocomplete="off" class="form-horizontal" role="form">
                                                            <input type="hidden" value="<?php echo base64_encode(json_encode($report['id'])); ?>" name="request_id">
                                                          <div class="modal-body">
                                                            <div class='err_cont'>
                                                                <textarea name="remarks" required placeholder="No remark found !!" style="width: 575px; height: 353px;"><?php if($group_report[$k]['remarks']!=''){echo $group_report[$k]['remarks'];}?></textarea>
                                                            </div>                                        
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="submit" class="btn btn-default">Update Remark</button>
                                                          </div>
                                                        </form>
                                                    </div>
                                                  </div>
                                                </div>
                                            </td>
                                            
                                             <td>
                                                 <?php
                                                 if($report['flag']==0){
                                                 ?>
                                                <!--<a href="<?php echo WEB_URL; ?>reports/update_change_status/<?php //echo $report['id']; ?>"> <i class="fa fa-th-list" title="Take action!!"></i></a>-->
                                                <a href="#" data-toggle="modal" data-target="#list_remark<?php echo $report['id']; ?>" class="btn  btn-xs has-tooltip" data-placement='top' title='Update remark'><i class="fa fa-th-list" title="Take action!!"></i></a>
                                                <?php
                                                 }
                                                ?>
                                                
                                                <?php if($report['remarks']!=''){ ?>
                                                <a class="btn btn-primary btn-xs has-tooltip" href="<?php echo base_url(); ?>reports/get_request_remark_history/<?php echo base64_encode(json_encode($report['id'])); ?>" data-placement='top' title='GB Remark History' onclick="return confirm('Are you sure ,you want to See the history remark?')"> <span class="glyphicon glyphicon-book"></span></a>
                                                <?php } ?>
                                              </td> 

                                        </tr>
                                        <?php
                                                }
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
    $('#example_first, #example_second').DataTable( {
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
            html2canvas($('#example_first, #example_second')[0], {
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
