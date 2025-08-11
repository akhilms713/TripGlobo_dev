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
    table td:nth-child(15),
    table th:nth-child(15) {
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
                                    Special Flight Trip Request List
                                </h3>
                            </div>


                        </div>
                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    
                                    <div class="x_content" style="overflow: scroll auto;">
                                    
                                <table id="example" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                        <tr class="headings">

                                            <th>Sl No </th>
                                            <th>User Name</th>
                                            <th >Email</th>
                                            <th>Contact</th>
                                            <th>Message</th>
                                            <th>Airline Name</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Stops</th>
                                            <th>Depature</th>
                                            <th>Arrival</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
										$i=1;
										if(!empty($flight_request_list))
										{
                                        foreach($flight_request_list as $key => $vals)
                                        {
                                           ?>
                                           <tr class="even pointer">

                                            <td class=" "><?php echo $i++; ?></td>
                                           
                                                 
                                            <td class=""><?php echo $vals['user_name']; ?></td>
                                            <td class=""><?php echo $vals['email']; ?></td>
                                            <td class=""><?php
											if($vals['phone']!=0)
											{
											 echo $vals['phone']; 
											}
											else
											{
												echo '-';
											}?></td>
										<td class=""><?php echo $vals['message']; ?></td>
											
                                            <td><?php foreach($airline_name[$key] as $airline_val){
                                                foreach($airline_val as $al_val)
                                                {
                                                    echo $al_val."<br>";
                                                }
                                            } ?></td>
                                           
                                            <td class="">
                                                
                                            <?php $from_loc= json_decode($vals['from_location']);
                                            
                                            foreach($from_loc as $from_val){ echo $from_val."<br>"; }
                                                 ?></td>
                                                  <td class=""> <?php 
                                             $to_loc= json_decode($vals['to_location']);
                                           foreach($to_loc as $to_val){ echo $to_val."<br>"; }
                                             ?></td>
                                             <td class=""><?php echo $vals['stops']; ?></td>
                                             <td class=""><?php 
                                             $departure_date= json_decode($vals['departure_date']);
                                             foreach($departure_date as $departure_val){ echo $departure_val."<br>"; }
                                             ?></td>
                                            <td><?php 
                                             $arrival_date= json_decode($vals['arrival_date']);
                                             foreach($arrival_date as $arrival_val){ echo $arrival_val."<br>"; }
                                             ?></td>
                                              <td class=""> <?php 
                                             $start_time= json_decode($vals['start_time']);
                                           foreach($start_time as $start_time_val){ echo $start_time_val."<br>"; }
                                             ?></td>
                                            <td><?php 
                                             $end_time= json_decode($vals['end_time']);
                                           foreach($end_time as $end_time_val){ echo $end_time_val."<br>"; }
                                             ?></td>
                                             <td><?php echo $vals['amount']; ?></td>
                                       <td>
                                           <select onchange="updateStatus(this.value,<?php echo $vals['special_trip_id']; ?>)">
                                               <option value="0" <?php if($vals['status']==0){ echo "selected";}?>>Pending</option>
                                               <option value="1" <?php if($vals['status']==1){ echo "selected";}?>>Accept</option>
                                               <option value="2" <?php if($vals['status']==2){ echo "selected";}?>>Reject</option>
                                           </select>
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
            'copy', 'csv', 'excel', 'print',
            {
            extend: 'pdfHtml5',
            orientation: 'landscape', 
            pageSize: 'A3'
        }
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
    function updateStatus(val,ids)
    {
        	$.ajax({
				url: '<?php echo WEB_URL; ?>special_trip/userReq_status_update',
				type: "post",
                data: {val:val,ids: ids},
				dataType: 'json',
				success: function(result) {
				//alert(result);
				}
			});
    }
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
