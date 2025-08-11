
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
                                    <?php echo $page_title; ?>
                                </h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content" style="overflow: auto;">
                                <table id="example" class="table table-striped responsive-utilities jambo_table" >
                                    <thead>
                                        <tr class="headings">
                                             <th>Sl No </th>
                                            <th>Logo </th>
                                            <th>Tripglobo Unique ID</th>
                                            <th>Agency Name</th>
                                            <th>Contact Person</th>
                                            <th>Contact Number</th>
                                            <th>Country</th>
                                            <th>City</th>
                                            <th>Account Balance</th>
                                            <th>Current Status</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                            <?php
                                             $sub_admin_id = $this->session->userdata('admin_id');
                                             if($sub_admin_id==1){
                                            ?>
                                            <th>Super Admin Status</th>
                                            <?php
                                             }
                                            
                                            ?>
                                            
                                        </tr>
                                    </thead>
                                     <tbody>
                                        <?php 
										 $page1= ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; 
                                       $page2= ($page1==1)?1:$page1+1;
                                       $i=$page2;
										if(!empty($users)){
                                        foreach($users as $user){
											//echo '<pre/>'; print_r($user);
                                           ?>
                                           <tr class="even pointer">
                                             <td class=" "><?php echo $i++; ?></td>
                                            <!--<td class=""> <img width="50" title="<?php echo $user->user_name; ?>" alt="<?php echo $user->user_name; ?>" src="<?php echo WEB_FRONT_URL;?>photo/users/<?php echo $user->profile_picture; ?>"></td>-->
                                        <td class=""> <img width="50" title="<?php echo $user->user_name; ?>" alt="<?php echo $user->user_name; ?>" src="<?php echo WEB_FRONT_URL;?>photo/users/<?php echo $user->profile_picture; ?>">
</td>
                                         <td class=""><?php echo $user->user_unique_id; ?></td>
                                                <td class=""><?php echo $user->user_name; ?></td>
                                            <td class=""><?php echo $user->c_p_name; ?></td>
                                            <td class=""><?php echo $user->c_p_phone; ?></td>
                                            <td class=""><?php echo $user->country_name; ?></td>
                                            <td class=""><?php echo $user->city_name; ?></td>
                                            <td class=""><?php echo $user->balance_credit; ?></td>
                                            <td class=""><?php echo $user->status; ?></td>




                                                 <td class="">

                                                <label class="switch-light switch-ios" id="ip_status<?php echo $user->status; ?>" style="width: 100px; " onclick="">
                                                <input type="hidden" value="<?php  echo $user->status; ?>" id="alert_status_<?php echo $user->user_id; ?>" />
                                                <input  class="whiteip1" id="whiteip1_<?php echo $user->user_id; ?>" data-alert_id1="<?php echo $user->user_id; ?>" type="checkbox"  <?php 
                                                if($user->status!='INACTIVE')
                                                {
                                                ?> checked="checked"  <?php
                                                }
                                                ?>  />
                                                <span class="htspan"> 
                                                <?php if($user->status!='INACTIVE') { ?>
                                                    <span>Active</span>
                                                <?php }else { ?>   
                                                    <span>Inactive</span>                 
                                                <?php } ?>
                                                </span>
                                                <a><img id="whiteip_load1<?php echo $user->user_id; ?>"  width="26"  style="display: none;"  src="<?php echo ASSETS.'/images/loader1.gif'; ?>"></a>
                                                </label>
                                                </td>




											<td>
												<a href="<?php echo WEB_URL; ?>b2b/view_profile/<?php echo $user->user_id; ?>" onclick="return confirm('Do You Want to See User Details ?')">  <i class="fa fa-th-list" title="View profile"></i></a>
												<a href="<?php echo WEB_URL; ?>b2b/edit_profile/<?php echo $user->user_id; ?>" onclick="return confirm('Do You Want to Edit Details ?')">   <i class="fa fa-pencil-square-o" title="Edit profile"></i></a>
												<a href="<?php echo WEB_URL; ?>orders/user_bookings/<?php echo $user->user_type_id; ?>/<?php echo $user->user_id; ?>" onclick="return confirm('Do You Want to See Booking Details ?')">   <i class="fa fa-ticket" title="View Bookings"></i></a>
									
											</td>
											
											<?php
										         if($sub_admin_id==1){
                                            ?>
											
											
											 <td class="">

                                                <label class="switch-light switch-ios" id="ip_status<?php echo $user->sa_status; ?>" style="width: 100px; " onclick="">
                                                <input type="hidden" value="<?php  echo $user->sa_status; ?>" id="alert_status1_<?php echo $user->user_id; ?>" />
                                                <input  class="whiteip11" id="whiteip11_<?php echo $user->user_id; ?>" data-alert_id11="<?php echo $user->user_id; ?>" type="checkbox"  <?php 
                                                if($user->sa_status!='BLOCK')
                                                {
                                                ?> checked="checked"  <?php
                                                }
                                                ?>  />
                                                <span class="htspan"> 
                                                <?php if($user->sa_status!='BLOCK') { ?>
                                                    <span>Active</span>
                                                <?php }else { ?>   
                                                    <span>BLOCK</span>                 
                                                <?php } ?>
                                                </span>
                                                <a><img id="whiteip_load1<?php echo $user->user_id; ?>"  width="26"  style="display: none;"  src="<?php echo ASSETS.'/images/loader1.gif'; ?>"></a>
                                                </label>
                                                </td>
                                            <?php
                                            
										         }
                                            ?>
											
											
											
										</tr>
                                   <?php } } ?>
                                </tbody>

                            </table>
                            <p style="margin-top: 10px;">Showing <?php $b= ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; echo ($b==1)?1:$b+1; ?> to <?php $a=($this->uri->segment(3)) ? $this->uri->segment(3) : 0; echo $a+10; ?> of <?= $total_rows ?> entries</p>
                              <p><?php echo $links; ?></p>
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
            "paging": false,
        "info": false,
        buttons: [
            'copy', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',    
                width:'100%',
                pageSize: 'A3',
                customize:  function (doc) {
                    doc.layout = 'lightHorizotalLines;'
                    doc.pageMargins = [40, 50, 40, 40];
                    doc.defaultStyle.fontSize = 11;
                    doc.styles.tableHeader.fontSize = 12;
                    doc.styles.title.fontSize = 14;
                },
            
            }, 'print'
        ]
    } );
} );
</script>
 <script type="text/javascript">
        var permanotice, tooltip, _alert;
        $(function () {
			<?php if(isset($status->status) && $status->status!='') {
				?>
            new PNotify({
                title: "<?php echo $status->title; ?>",
                type: "<?php echo $status->status; ?>",
                text: "<?php echo $status->msg; ?>",
                nonblock: {
                    nonblock: true
                },
                before_close: function (PNotify) {
                    // You can access the notice's options with this. It is read only.
                    //PNotify.options.text;

                    // You can change the notice's options after the timer like this:
                    PNotify.update({
                        title: PNotify.options.title + " - Enjoy your Stay",
                        before_close: null
                    });
                    PNotify.queueRemove();
                    return false;
                }
            });
<?php
			}
			?>
        });
    </script>

<!-- status change start  -->


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
                url: '<?php echo WEB_URL; ?>b2b/update_user_status',
                data: {id: _id1,status: s_status1},
                method: "POST",
                 dataType: 'json',
                success: function(result) {
                     $('#alert_status_'+id1).val(s_status1);
                    $('#whiteip_load1'+id1).fadeOut();
                    location.reload();
                    
                }
            });
        } else {
            
        }
        }
    });


    </script>




    <script>
$('.whiteip11').on('click', function() { 
        var curEle = $(this);
        var id11 = $(this).data('alert_id11');
        var status11 = $('#alert_status1_'+id11).val();
        if(status11=='ACTIVE' || status11=='BLOCK')
        {
        $('#whiteip_load11'+id11).fadeIn();
        if(id11) {
            _id11 = id11.toString().trim();
        }
        
            _status11 = status11.toString().trim();
    if(_status11=='BLOCK')
    {
        var s_status11 = 'ACTIVE';
    }
    else
    {
        var s_status11 = 'BLOCK';
    }
    if(_id11.toString().length > 0 && !isNaN(_id11)) {
                
            $.ajax({
                url: '<?php echo WEB_URL; ?>b2b/update_sa_status',
                data: {id: _id11,status: s_status11},
                method: "POST",
                 dataType: 'json',
                success: function(result) {
                     $('#alert_status1_'+id11).val(s_status11);
                    $('#whiteip_load11'+id11).fadeOut();
                    location.reload();
                }
            });
        } else {
            
        }
        }
    });


    </script>




<!-- status change ends -->




</body>

</html>
