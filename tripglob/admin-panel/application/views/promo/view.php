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
.dataTables_wrapper{
     overflow: scroll;
    }
    @media print{
            table td:nth-child(12),
            table th:nth-child(12) {
                display: none;
            }
            table td:nth-child(13),
            table th:nth-child(13) {
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
             <?php if($status=='1'){?>
                    <div class="alert alert-block alert-success alert-dismissable">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <h4 class="alert-heading">Success!</h4>
                    Your  Successfully Updated.
                  </div>
              <?php }elseif($status=='0'){?>
                   <div class="alert alert-block alert-danger alert-dismissable">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <h4 class="alert-heading">Failure!</h4>
                    No Promo code
                  </div>
               <?php }elseif($status=='2'){?>
               <div class="alert alert-block alert-success alert-dismissable">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <h4 class="alert-heading">Success!</h4>
                     Email send Successfully.
                  </div>
               <?php } ?>

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
                                   Promo 
                                </h3>
                            </div>


                        </div>
                        <div class="clearfix"></div>
                        
                        <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#b2b_tab">B2B</a></li>
                          <li><a data-toggle="tab" href="#b2c_tab">B2C</a></li>
                          <!-- <li><a data-toggle="tab" href="#staff_tab">Staff</a></li> -->
                        </ul>
                        <div class="tab-content">
                            <div id="b2b_tab" class="tab-pane fade in active">
                            <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                    
                                <table id="b2b_table" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                        <tr class="headings">
                                            <th>S no </th>
                                            <th>Promo Code </th>
                                            <th>User Name</th>
                                            <th>Type</th>
                                            <th>Module Type</th>
                                            <th>Airline</th>
                                            <th>Limit Type</th> 
                                            <th>Limit</th> 
                                            <!-- <th>Minimum Amount</th> -->
                                            <th>Description</th>
                                            <!-- <th>Amount Range</th> -->
                                            <th>Discount</th>
                                            <th>Expiry</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
										$i=1;
                                        foreach($promo as $promos)
                                        {

                                            if($promos->user_type == 1)
                                            {
                                               if ($promos->user_id!=0) {                                                    
                                               $req =$this->db->get_where('user_details',array('user_id'=>$promos->user_id))->row();
                                               $user_name=$req->user_name.' '.$req->user_email;  
                                                } else{
                                               $user_name='All';  
                                                }
										  // debug($req);exit;
                                           ?>
                                           <tr class="even pointer">

                                            <td class=" "><?php echo $i;$i++; ?></td>
                                            <td class=""> <?php echo $promos->promo_code; ?></td>
                                            <td class=""> <?php echo $user_name; ?></td>
                                            <td class=""> <?php echo $promos->promo_type; ?></td>
                                            <td class=""> <?php echo $promos->module; ?></td>
                                            <td class=""> <?php echo ($promos->airline_name == '')? '---':$promos->airline_name.'( '.$promos->air_code.' )'; ?></td>
                                             <td class=""> <?php echo $promos->limit; ?></td>
                                            <td class=""> <?php echo $promos->limit_count; ?></td>
                                            <!-- <td class=""> <?php echo $promos->minimum_amount; ?></td> -->
                                            <td class=""> <?php echo $promos->description; ?></td>

                                            <!-- <td class=""><?php if(!empty($promos->promo_amount)) {echo BASE_CURRENCY_ICON.' '.$promos->promo_amount;
                                            }else{echo '<center>---</center>'; }?></td> -->
                                                    <td class="">
                                                    <?php if($promos->promo_type == 'PERCENTAGE') { echo $promos->discount.' %'; 
                                            } else { echo $promos->promo_amount.BASE_CURRENCY_ICON; } ?></td>
                                            <td class=""><?php echo date('M j,Y',strtotime($promos->expiry_date)); ?></td>
                                            <td class="">
                                                   <label class="switch-light switch-ios" id="ip_status<?php echo $promos->status; ?>" style="width: 100px; " onclick="">
                                                            <input type="hidden" value="<?php  echo $promos->status; ?>" id="alert_status_<?php echo $promos->promo_id; ?>" />
                                                                                                  <input  class="whiteip1" id="whiteip1_<?php echo $promos->promo_id; ?>" data-alert_id1="<?php echo $promos->promo_id; ?>" type="checkbox"  <?php 
                                                       if($promos->status!='INACTIVE')
                                                       {
                                                       ?> checked="checked"  <?php
                                                       }
                                                       ?>  />
                                              <span class="htspan"> <span>Inactive</span>
                                               <span>Active</span>
                                               
                                               
                                              </span>
                                              <a><img id="whiteip_load1<?php echo $promos->promo_id; ?>"  width="26"  style="display: none;"  src="<?php echo ASSETS.'/images/loader1.gif'; ?>"></a>
                                            </label>
                                            </td>
                                            <td>
                                         
                                         
                                           <a href="<?php echo WEB_URL; ?>promo/send_promo_to_user/<?php echo $promos->promo_id; ?>" onclick="return confirm('Do You Want to Send this Promo Code?')"> <i class="fa fa-envelope" title="Send Email"></i>
                                       </a>
                                        <a href="<?php echo WEB_URL; ?>promo/delete_promo/<?php echo $promos->promo_id; ?>" onclick="return confirm('Do You Want to delete this Promo Code ?')">   <i class="fa fa-close" title="Delete"></i></a>
                                          <a href="<?php echo WEB_URL; ?>promo/edit_promo/<?php echo $promos->promo_id; ?>" onclick="return confirm('Do You Want to Edit this Promo Code ?')">   <i class="fa fa-edit" title="Edit"></i></a>
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
            
                            <div id="b2c_tab" class="tab-pane fade">
                                <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                <div class="x_content">
                                <table id="b2c_table" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                        <tr class="headings">
                                            <th># </th>
                                            <th>Promo Code </th>
                                            <th>Type</th>
                                            <th>Module Type</th>
                                            <th>Airline</th>
                                            <!-- <th>Minimum Amount</th> -->
                                            <th>Limit Type</th> 
                                            <th>Limit</th> 
                                            <th>Description</th>
                                            <!-- <th>Amount Range</th> -->
                                            <th>Discount</th>
                                            <th>Expiry</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
										$i=1;
                                        foreach($promo as $promos)
                                        {
                                            if($promos->user_type == 2)
                                            {
                                           ?>
                                           <tr class="even pointer">
                                            <td class=" "><?php echo $i;$i++; ?></td>
                                            <td class=""> <?php echo $promos->promo_code; ?></td>
                                            <td class=""> <?php echo $promos->promo_type; ?></td>
                                            <td class=""> <?php echo $promos->module; ?></td>
                                            <td class=""> <?php echo ($promos->airline_name=='')? 'All':$promos->airline_name.'( '.$promos->air_code.' )'; ?></td> 
                                           <!-- <td><?php echo $promos->airline_name; ?></td> -->
                                            <!-- <td class=""> <?php echo $promos->minimum_amount; ?></td> -->
                                            <td class=""> <?php echo $promos->limit; ?></td>
                                            <td class=""> <?php echo $promos->limit_count; ?></td>
                                            <td class=""> <?php echo $promos->description; ?></td>

                                            <!-- <td class=""><?php if(!empty($promos->promo_amount)) {echo BASE_CURRENCY_ICON.' '.$promos->promo_amount;
                                            }else{echo '<center>---</center>'; }?></td> -->
                                                    <td class=""><?php if($promos->promo_type == 'PERCENTAGE') { echo $promos->discount.' %'; 
                                            } else { echo $promos->discount.BASE_CURRENCY_ICON; } ?></td>
                                            <td class=""><?php echo date('M j,Y',strtotime($promos->expiry_date)); ?></td>
                                            <td class="">
                                                   <label class="switch-light switch-ios" id="ip_status<?php echo $promos->status; ?>" style="width: 100px; " onclick="">
                                                            <input type="hidden" value="<?php  echo $promos->status; ?>" id="alert_status_<?php echo $promos->promo_id; ?>" />
                                                                                                  <input  class="whiteip1" id="whiteip1_<?php echo $promos->promo_id; ?>" data-alert_id1="<?php echo $promos->promo_id; ?>" type="checkbox"  <?php 
                                                       if($promos->status!='INACTIVE')
                                                       {
                                                       ?> checked="checked"  <?php
                                                       }
                                                       ?>  />
                                              <span class="htspan"> <span>Inactive</span>
                                               <span>Active</span>
                                               
                                               
                                              </span>
                                              <a><img id="whiteip_load1<?php echo $promos->promo_id; ?>"  width="26"  style="display: none;"  src="<?php echo ASSETS.'/images/loader1.gif'; ?>"></a>
                                            </label>
                                            </td>
                                            <td>
                                         
                                         
                                           <a href="<?php echo WEB_URL; ?>promo/send_promo_to_user/<?php echo $promos->promo_id; ?>" onclick="return confirm('Do You Want to Send this Promo Code?')"> <i class="fa fa-envelope" title="Send Email"></i>
                                       </a>
                                        <a href="<?php echo WEB_URL; ?>promo/delete_promo/<?php echo $promos->promo_id; ?>" onclick="return confirm('Do You Want to delete this Promo Code ?')">   <i class="fa fa-close" title="Delete"></i></a>

                                       <a href="<?php echo WEB_URL; ?>promo/edit_promo/<?php echo $promos->promo_id; ?>" onclick="return confirm('Do You Want to Edit this Promo Code ?')">   <i class="fa fa-edit" title="Edit"></i></a>
                                          
                                            </td>

                                           
                                          </tr>
                                        <?php
                                    }}
                                    ?>
                                </tbody>

                            </table>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
                            </div>
                            
                            <div id="staff_tab" class="tab-pane fade">
                                <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                <div class="x_content">
                                <table id="staff_table" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                        <tr class="headings">
                                            <th># </th>
                                            <th>Promo Code </th>
                                            <th>Type</th>
                                            <th>Module Type</th>
                                            <th>Airline</th>
                                            <th>Minimum Amount</th>
                                            <th>Description</th>
                                            <th>Amount Range</th>
                                            <th>Discount</th>
                                            <th>Expiry</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
										$i=1;
                                        foreach($promo as $promos)
                                        {
                                            if($promos->user_type == 4)
                                            {
                                           ?>
                                           <tr class="even pointer">
                                            <td class=" "><?php echo $i;$i++; ?></td>
                                            <td class=""> <?php echo $promos->promo_code; ?></td>
                                            <td class=""> <?php echo $promos->promo_type; ?></td>
                                            <td class=""> <?php echo $promos->module; ?></td>
                                            <td class=""> <?php echo ($promos->airline_name=='')? 'All':$promos->airline_name.'( '.$promos->air_code.' )'; ?></td>
                                            <td class=""> <?php echo $promos->minimum_amount; ?></td>
                                            <td class=""> <?php echo $promos->description; ?></td>

                                            <td class=""><?php if(!empty($promos->promo_amount)) {echo BASE_CURRENCY_ICON.' '.$promos->promo_amount;
                                            }else{echo '<center>---</center>'; }?></td>
                                                    <td class=""><?php if($promos->promo_type == 'PERCENTAGE') { echo $promos->discount.' %'; 
                                            } else { echo $promos->discount.BASE_CURRENCY_ICON; } ?></td>
                                            <td class=""><?php echo date('M j,Y',strtotime($promos->expiry_date)); ?></td>
                                            <td class="">
                                                   <label class="switch-light switch-ios" id="ip_status<?php echo $promos->status; ?>" style="width: 100px; " onclick="">
                                                            <input type="hidden" value="<?php  echo $promos->status; ?>" id="alert_status_<?php echo $promos->promo_id; ?>" />
                                                                                                  <input  class="whiteip1" id="whiteip1_<?php echo $promos->promo_id; ?>" data-alert_id1="<?php echo $promos->promo_id; ?>" type="checkbox"  <?php 
                                                       if($promos->status!='INACTIVE')
                                                       {
                                                       ?> checked="checked"  <?php
                                                       }
                                                       ?>  />
                                              <span class="htspan"> <span>Inactive</span>
                                               <span>Active</span>
                                               
                                               
                                              </span>
                                              <a><img id="whiteip_load1<?php echo $promos->promo_id; ?>"  width="26"  style="display: none;"  src="<?php echo ASSETS.'/images/loader1.gif'; ?>"></a>
                                            </label>
                                            </td>
                                            <td>
                                         
                                         
                                           <a href="<?php echo WEB_URL; ?>promo/send_promo_to_user/<?php echo $promos->promo_id; ?>" onclick="return confirm('Do You Want to Send this Promo Code?')"> <i class="fa fa-envelope" title="Send Email"></i>
                                       </a>
                                        <a href="<?php echo WEB_URL; ?>promo/delete_promo/<?php echo $promos->promo_id; ?>" onclick="return confirm('Do You Want to delete this Promo Code ?')">   <i class="fa fa-close" title="Delete"></i></a>
                                          
                                            </td>

                                           
                                          </tr>
                                        <?php
                                    }}
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
  <link type="text/css" rel="stylesheet" href="<?php echo ASSETS; ?>/css/common/toastr.css?1425466569" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready(function() {
    $('#b2b_table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel','print',
            {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    width:'100%',
                     customize:  function (doc) {
                    doc.layout = 'lightHorizotalLines;'
                    doc.pageMargins = [60, 60, 60, 60];
                    doc.defaultStyle.fontSize = 11;
                    doc.styles.tableHeader.fontSize = 12;
                    doc.styles.title.fontSize = 14;
                    },
            }, 
            
        ]
    } );
      
      
      
    $('#b2c_table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print',
            {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A3',
                    width:'100%'
            }, 
        ]
    } );
    
    $('#staff_table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print',
            {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    width:'100%'
            }, 
        ]
    } );
} );
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        $("body").on("click", ".buttons-pdf", function () {
            html2canvas($('#b2c_table')[0], {
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        $("body").on("click", ".buttons-pdf", function () {
            html2canvas($('#staff_table')[0], {
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        $("body").on("click", ".buttons-pdf", function () {
            html2canvas($('#b2b_table')[0], {
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
				url: '<?php echo WEB_URL; ?>promo/update_promo_status',
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
    <script type="text/javascript">

<?php if($this->session->flashdata('success')){ ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
<?php }else if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
<?php } ?>

</script>

</body>

</html>
