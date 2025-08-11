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
<?php if($this->session->userdata('user_type')=='1' || $this->session->userdata('user_type')=='4'){
  echo $this->load->view(PROJECT_THEME.'/common/header');
}else{
  echo $this->load->view(PROJECT_THEME.'/new_theme/header'); 
} ?>
<div class="clearfix"></div>
<div class="dash-img"> 
</div>
<!--sidebar start-->
<div class="container">
<div class="dashboard_section">
<div class="col-md-12 nopad">
<aside class="aside"> <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?> </aside>
<!--sidebar end--> 

<!--main content start-->
<section id="main-content" class="col-md-12 tab_sty nopad dash-allbok">
  <section class="wrapper">
    <div class="main-chart col-md-12 cent-block">
       <h3 class="lineth">Deposit Control</h3>
      <div class="tab_inside_profile">
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
       <!--  <span class="profile_head">Deposit Control</span> -->
        <div class='box-content box-no-padding rowit'>
        
        <div class="top_deposit_div">
          <div class="col-md-6 nopad"> <span class="amnbalbl">Balance Amount </span> <span class="balncamnt">
            <?php  echo (isset($deposit_amount->balance_credit) && $deposit_amount->balance_credit != "" ) ? $deposit_amount->balance_credit : "0.00" ; ?>
            INR</span> </div>
          <div class="col-md-6 nopad"> 
            <!--<a class="right" href="<?php echo WEB_URL.'account/addDeposit' ?>"><button class="btn btn-primary" style="float: right;">Add New Deposit</button></a>--> 
            <a class="pull-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#add_deposite">Add New Deposit</button>
            </a> </div>
        </div>
            
          <div class="clearfix"></div>

            <div class="table-responsive">
              <table id="depostDatatable" class="data-table-column-filter table table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Sl No</th>
                    <th>Transaction ID</th>
                    <th>Deposit Mode</th>
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
                    <td>
                      <?php if($k->deposit_mode=='banking'){ echo 'Banking';}else{echo 'Cheque';} ?>
                    </td>
                    <td>
                      <?php if($k->deposit_mode=='banking'){ echo $k->deposited_date;}else{echo $k->cheque_date;} ?>
                    </td>
                    <td><?php echo $k->amount; ?></td>
                    <td><?php echo $k->remarks; ?></td>
                    <td><?php if($k->status !='DECLINED'){ echo $k->superadmin_status;}else{ echo $k->status; }; ?></td>
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

<div id="add_deposite" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Deposit</h4>
      </div>
      <div class="modal-body">
        <form class="form form-horizontal validate-form" style="margin-bottom: 0;" action="<?php echo WEB_URL.'account/saveDeposit'; ?>" method="post" enctype="multipart/form-data" >
        <div class="popconyent overvis vehicledetail">
          <div class="form-group">
            <input type="hidden" value="banking" class="banking_types" name="banking_types">
            <div class="col-sm-6 controls text-right">
              <label class="radio-inline radio-styled radio-success fivetop control-label" for="amount">
              <div class="iradio_flat-blue " id="banking" style="position: relative;">
                <input type="radio" class="triprad iradio_flat-blue" checked name="banking_type">
                
                <ins class="iCheck-helper" id="banking" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
             </div><span>Banking</span>
              </label>              
              <label class="radio-inline radio-styled radio-success fivetop control-label" for="amount">
              <div class="iradio_flat-blue" id="cheque" style="position: relative;">
                <input type="radio" class="triprad iradio_flat-blue" name="banking_type" value="cheque" >
                
                <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>  <span>Cheque</span>            
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3" for="amount">Amount</label>
            <div class="col-sm-7 controls">
              <input class="form-control" data-rule-number="true" data-rule-required="true" id="amount" name="amount" placeholder="Amount" type="text" required>
              <span id="msg"></span>
            </div>
          </div>

          

          <div class="form-group">
            <label class="control-label col-sm-3" for="amount">Date</label>
            <div class="datepicker-input col-sm-7 controls" > 

             <!--  <span class="input-group-addon"> <span data-date-icon="icon-calendar" data-time-icon="icon-time" class="icon-calendar"></span> </span> -->
              <input id="deposit_date" class="datepicker-input form-control" data-format="MM/DD/YYYY" placeholder="MM/DD/YYYY" name="date"  type="text" required>
            </div>
          </div>
          



          <div class="banking_fields">
            <div class="form-group">
              <label class="control-label col-sm-3" for="amount">Bank Name</label>
              <div class="col-sm-7 controls">
                <input class="form-control" data-rule-number="true" data-rule-required="true" id="bank_name" name="bank_name" placeholder="Bank Name" type="text" >
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="amount">Bank Branch</label>
              <div class="col-sm-7 controls">
                <input class="form-control" data-rule-number="true" data-rule-required="true" id="bank_branch" name="bank_branch" placeholder="Bank Branch" type="text" >
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="amount">Bank City</label>
              <div class="col-sm-7 controls">
                <input class="form-control" data-rule-number="true" data-rule-required="true" id="bank_city" name="bank_city" placeholder="Bank City" type="text" >
              </div>
            </div>
          </div>
          <div class="cheque_fields">
            <div class="form-group">
              <label class="control-label col-sm-3" for="amount">Cheque number</label>
              <div class="col-sm-7 controls">
                <input class="form-control" data-rule-number="true" data-rule-required="true" id="check_number" name="check_number" placeholder="Cheque number" type="text" >
              </div>
            </div>
          </div>
          <!-- <div class="form-group">
            <label class="control-label col-sm-3" for="amount">Deposit List</label>
            <div class="col-sm-7 controls">
              <input class="form-control" data-rule-number="true" data-rule-required="true"  name="userfile" id="userfile" type="file" >
            </div>
          </div> -->

          <div class="item form-group">
              <label for="Remarks" class="control-label col-md-3">Transaction Slip</label>
              <div class="col-md-3 col-sm-3 col-xs-12">
                <input id="slip" type="file" name="slip" >
              </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-3" for="validation_remarks">Remarks</label>
            <div class="col-sm-7 controls">
              <textarea class="form-control" id="validation_remarks" placeholder="" name="remarks" rows="3" ></textarea>
            </div>
          </div>
        </div>
        <div class="popfooter">
          <div class="form-actions" style="margin-bottom:0">
            <div class="row">
              <label class="control-label col-sm-3" for="validation_remarks">&nbsp;</label>
              <div class="col-sm-7">
                <button class="btn btn-primary amount_validate" type="submit" > <i class="icon-plus"></i> Add Amount </button>
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
</div>
</div>
</div>

<!-- Page Content --> 
<div class="clearfix"></div>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<?php //echo $this->load->view(PROJECT_THEME.'/new_theme/footer'); ?> 
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?> 

<!-- Script to Activate the Carousel -->







<script>

$(document).ready(function() {
	 $('.cheque_fields').slideUp();
	$('#example').DataTable();
	$('#depostDatatable').DataTable( {
	// dom: 'T<"clear">lfrtip',
        // tableTools: {
        //     "sSwfPath": "<?php echo ASSETS;?>swf/copy_csv_xls_pdf.swf"
        // }
    } );
	$(document).on('click','.iradio_flat-blue',function(){
        
        $('.iradio_flat-blue').attr('class','iradio_flat-blue');
        $(this).attr('class','iradio_flat-blue checked');
        if ( $(this).attr('id') == 'banking'){
            $('.banking_fields').slideDown();
            $('.cheque_fields').slideUp();
            $('.banking_types').val('banking');
        }
        else{
            $('.banking_fields').slideUp();
            $('.cheque_fields').slideDown();
            $('.banking_types').val('cheque');
        }
    });
    $(document).on('click','.amount_validate',function(){
       var banking = $('.banking_types').val();

       var amount = $('#amount').val();
       var date = $('#deposit_date').val();
       var review = $('#validation_remarks').val();
      /* var slip = $('#slip')[0].files[0]*/
       
       if(amount!=''){
        var decimal_filter  = /^[0-9]*[.][0-9]*?$/;  
        var number_filter   = /^[0-9]+$/; 
        if(!($('#amount').val().match(decimal_filter) || $('#amount').val().match(number_filter))){
          $('#msg').html('Invalid Amount');
          $("#msg").css({"color": "#FF0000"});
          return false;
        }else{
          $('#msg').html('');
        }
      }


         if(amount ==''){
          $('#amount').focus();
          return false;
         }
         if(date ==''){
          $('#deposit_date').focus();
          return false;
         }
         
       if(banking == 'banking'){
         var bank_name = $('#bank_name').val();
         var bank_branch = $('#bank_branch').val();
         var bank_city = $('#bank_city').val();

         if(bank_name ==''){
          $('#bank_name').focus();
          return false;

         }
         if(bank_branch ==''){
          $('#bank_branch').focus();
          return false;
         }
         if(bank_city ==''){
          $('#bank_city').focus();
          return false;
         }
         /*if(!slip){
          $('#slip').focus();
          return false;
         }
         slip =$('#slip').prop('files')[0];*/
         if(bank_name !='' && bank_branch !='' && bank_city!=''  ){}
          
       }

       if(banking == 'cheque'){}       
    });
  //BookingPagination();
});
	$('#deposit_date').datepicker({
      autoclose: true, 
      todayHighlight: true,
      minDate:0, 
      format: "yyyy-mm-dd",
      startDate:Date(),
      maxDate:'0', 
    });
	</script>
<script>
    var base_url = "<?php echo WEB_URL; ?>account/fileupload";
</script>
<script src="../admin-panel/assets/js/file/ajaxupload.js"></script>
<script src="../admin-panel/assets/js/file/custom.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/dataTables.tableTools.js"></script>



</body>
</html>
