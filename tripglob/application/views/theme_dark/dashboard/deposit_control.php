<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo PROJECT_TITLE; ?></title>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_css'); ?>
<link href="<?php echo ASSETS; ?>css/dashboard.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/jquery.dataTables.css">
<link type="text/css" rel="stylesheet" href="<?php echo ASSETS; ?>css/bootstrap-datepicker/datepicker3.css?1424887858" />
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/dataTables.tableTools.css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Navigation --> 
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
<div class="clearfix"></div>
<!--sidebar start-->
<aside class="aside"> <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?> </aside>
<!--sidebar end--> 



<div class="clearfix"></div>

<!--main content start-->
<section id="main-content">
<section class="wrapper">

<div class="main-chart">



 <?php if (isset($email_v)) { ?>
                <div class="msg" style="display: block;"><?php echo $email_v; ?></div>
<?php } ?>
<?php if (isset($err_v)) { ?>
                <div class="msg" style="display: block;"><?php echo $err_v; ?></div>
<?php } ?>
<?php if (isset($d_msg)) { ?>
                <div class="msg" style="display: block;"><?php echo $d_msg; ?></div>  
<?php } ?>

    <div class="msg" style="display: none;"></div>
    <div class="errstatus" style="display: none;"></div>
    

    
    
    <div class="tab_inside_profile"> 
    	<span class="profile_head">Deposit Control  </span>
    
    	
      <div class='box-content box-no-padding rowit'>
        	
            <div class="top_deposit_div">
            <div class="col-md-12 nopad">
                <a  class="pull-right"><button class="btn btn-primary" data-toggle="modal" data-target="#add_new_deposite">Add New Deposit</button></a>
            </div>
            </div>

            <div class="clearfix"></div>

        
            <div class="table-responsive">

                    <table id="depostDatatable" class="data-table-column-filter table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr class="sortablehed">
                                <th>S.No</th>
                                <th>Transaction ID</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Remarks</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            <?php $count = 1; ?>
                            <?php if(!empty($deposit)): ?>
                            <?php foreach($deposit as $k): ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $k->deposit_number; ?></td>
                                <td><?php echo $k->deposited_date; ?></td>
                                <td><?php echo $k->amount; ?></td>
                                <td><?php echo $k->remarks; ?></td>
                                <td><?php echo $k->status; ?></td>
                            </tr>
                            <?php $count++; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                       
                    </table>

            </div>
        </div>
        
        
        

	</div>

				
              
           
        


</div>

</section>
</section>

<div class="clearfix"></div>





<div id="add_new_deposite" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Deposit</h4>
      </div>
      <div class="modal-body">
        <form id="addDepositForm" class="form form-horizontal validate-form" style="margin-bottom: 0;" action="<?php echo WEB_URL.'account/saveDeposit'; ?>" method="post" enctype="multipart/form-data" > 
    <div class="popconyent overvis vehicledetail">
    	
                    <div class="form-group">
                        <label class="control-label col-sm-5" for="amount">Amount Deposited</label>
                        <div class="col-sm-7 controls">
                            <input class="form-control" data-rule-number="true" data-rule-required="true" id="amount" name="amount" placeholder="Amount" type="text" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-5" for="amount">Deposited Date</label>
                        <div class="datepicker-input input-group col-sm-7">
                            <span class="input-group-addon">
                                <span data-date-icon="icon-calendar" data-time-icon="icon-time" class="icon-calendar"></span>
                            </span>
                            <input id="datepicker" class="datepicker-input form-control" data-format="MM/DD/YYYY" placeholder="MM/DD/YYYY" name="deposited_date" type="text" required>
                            
                         </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-5" for="validation_remarks">Remarks</label>
                        <div class="col-sm-7 controls">
                            <textarea class="form-control" data-rule-required="true" id="validation_remarks" placeholder="Remarks" name="remarks" rows="3" required></textarea>
                        </div>
                    </div>

                    
               
    </div>
    
    <div class="popfooter">
      <div class="form-actions" style="margin-bottom:0">
            <div class="row">
            	<label class="control-label col-sm-5" for="validation_remarks">&nbsp;</label>
                <div class="col-sm-7">
                    <button class="btn btn-primary" type="submit">
                        <i class="icon-plus"></i>
                        Add Amount
                    </button>
                </div>
            </div>
        </div>
    </div>
     </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Page Content -->

<?php echo $this->load->view(PROJECT_THEME.'/new_theme/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>

<!-- Script to Activate the Carousel --> 


</body>
</html>
<script>
$(document).ready(function() {
	
	//$('#example').DataTable();
	$('#depostDatatable').DataTable( {
		"order": [[ 1, "desc" ]],
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "<?php echo ASSETS;?>swf/copy_csv_xls_pdf.swf"
        }
    } );
	
  //BookingPagination();
});
		
	</script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/dataTables.tableTools.js"></script><style>
#adddeposit {
    display: none;
}
</style>