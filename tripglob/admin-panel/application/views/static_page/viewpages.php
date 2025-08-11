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
@media print{
            table td:nth-child(4),
            table th:nth-child(4) {
                display: none;
            }
    }
@media print{
            table td:nth-child(5),
            table th:nth-child(5) {
                display: none;
            }
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
                                   Static Page Management
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
                                            <th>Title </th>
                                            <th>Url</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
										$i=1;
										if(!empty($pages))
										{
                                        foreach($pages as $allpages)
                                        {
                                        
                                           ?>
                                           <tr class="even pointer">

                                            <td class=" "><?php echo $i++; ?></td>
                                            <td class=""> <?php echo $allpages->title; ?></td>
                                            <td class=""><?php echo $allpages->url; ?></td>
                                           
                                            <td class=""><?php 
 if($allpages->status!='')
               {
               ?> 
           <label class="switch-light switch-ios" id="ip_status<?php echo $allpages->status; ?>" style="width: 100px; " onclick="">
                    <input type="hidden" value="<?php  echo $allpages->status; ?>" id="alert_status_<?php echo $allpages->id; ?>" />
                                                          <input  class="whiteip1" id="whiteip1_<?php echo $allpages->id; ?>" data-alert_id1="<?php echo $allpages->id; ?>" type="checkbox"  <?php 
               if($allpages->status=='1')
               {
               ?> checked="checked"  <?php
               }
               ?>  />
                                                        <span class="htspan"> 
                                                <?php if($allpages->status != '0'){?>
                                                    <span style="color: #0a0a0a;">Active</span>
                                                <?php }else { ?>
                                                    <span>Inactive</span>
                                                <?php } ?>
                                                </span>
                                                           
                                                           
                                                          </span>
                                                          <a><img id="whiteip_load1<?php echo $allpages->id; ?>"  width="26"  style="display: none;"  src="<?php echo ASSETS.'/images/loader1.gif'; ?>"></a>
                                                        </label>
              <?php
               }
               else
               {
               echo $allpages->status; 
               }
               ?>



                                            </td>
                                            <td>
                                              <a onclick="return confirm('Are you sure to Edit the page?')" href="<?php echo WEB_URL; ?>static_page/editPage/<?php echo $allpages->id; ?>">  <i class="fa fa-pencil-square-o" title="Edit profile"></i></a>
                                         <a onclick="return confirm('Are you sure to Delete the page?')" data-placement='top' title='Delete' href='<?php echo WEB_URL; ?>static_page/deletePage/<?=$allpages->id;?>'>
                                           <i class='fa fa-times'></i>

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
    <script>
$('.whiteip1').on('click', function() {
	
		var curEle = $(this);
		var id1 = $(this).data('alert_id1');
		var status1 = $('#alert_status_'+id1).val();
		
		if(status1=='1' || status1=='0')
		{
   		$('#whiteip_load1'+id1).fadeIn();
		if(id1) {
			_id1 = id1.toString().trim();
		}
		
			_status1 = status1.toString().trim();
	if(_status1=='0')
	{
		var s_status1 = 1;
	}
	else
	{
		var s_status1 = 0;
	}
	
		if(_id1.toString().length > 0 && !isNaN(_id1)) {
				
			$.ajax({
				url: '<?php echo WEB_URL; ?>static_page/updatePageStatus',
				data: {id: _id1,status: s_status1},
				type: "POST",
				success: function(result) {
					 $('#alert_status_'+id1).val(s_status1);
					$('#whiteip_load1'+id1).fadeOut();
          window.location.href = "viewAllPages";
				}
			});
		} else {
			
		}
		}
	});


    </script>

</body>

</html>
