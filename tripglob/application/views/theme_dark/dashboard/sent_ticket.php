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
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/dataTables.tableTools.css">
<link href="<?php echo ASSETS; ?>css/toggle-switch.css" rel="stylesheet" media="screen">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Navigation -->
<?php //echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
<?php if($this->session->userdata('user_type')=='1' || $this->session->userdata('user_type')=='4'){
  echo $this->load->view(PROJECT_THEME.'/common/header');
}else{
  echo $this->load->view(PROJECT_THEME.'/new_theme/header'); 
} ?>
<style>
    .closetickt{cursor:pointer;}
</style>
<div class="clearfix"></div>
<div class="dash-img"> 
</div>
<!--sidebar start-->
<div class="container">
<div class="dashboard_section">
<div class="col-md-12 nopad">
<aside  class="aside">
  <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?>
</aside>
<!--sidebar end-->

<!--main content start-->
<section id="main-content" class="col-md-12 tab_sty nopad dash-allbok">
<section class="wrapper">
<div class="main-chart col-md-12 cent-block">
    <h3 class="lineth">Sent Tickets</h3>

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

                 
                
                 
                 <!-- <span class="profile_head">Sent Tickets</span>  -->
                 <div class="withedrow" style="overflow: scroll !important;">
                    <div class="rowit chngecolr"  id="sentTickets" style=" padding-bottom:22px">
          
                <table id="depostDatatable" class='data-table-column-filter table table-bordered table-striped' cellspacing="0" width="100%">
                        <thead>
                            <tr class="sortablehed">
                                 <th>SL No</th>
                                <th>Ticket ID</th>
                                <th>Date</th>
                                <th>Subject</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                       
            <?php 
              if($support_sent!=''){
                // debug($support_sent);
            for($i=0;$i<count($support_sent);$i++){
               
                ?>
                 <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $support_sent[$i]->ticket_unique_id; ?></td>
                    <td><?php echo date('M j,Y',strtotime($support_sent[$i]->created_time)); ?></td>
                    
                    <td><?php echo substr($support_sent[$i]->support_ticket_subject_value,0,100); ?></td>
                    
                    <td><a class="viewtickt viewTicket" id="<?php echo $support_sent[$i]->support_ticket_id; ?>" href="<?php echo WEB_URL; ?>dashboard/view_ticket/<?php echo $support_sent[$i]->support_ticket_id; ?>" onclick="return confirm('Do You Want to this View This ticket ?')">View</a>

                    <a class="closetickt" data-id="<?php echo $support_sent[$i]->support_ticket_id; ?>" ticketid="<?php echo $support_sent[$i]->support_ticket_id; ?>" tickettype="inboxTickets">Close</a>
                    </td>
                </tr>
            <?php }}  else{?>
      
            <?php } ?>
             </tbody></table>
            
                    </div>
                </div>

</div>  
</section>
</section>
</div>
</div>
</div>

<div class="modal fade bs-example-modal-sm" id="close_ticket" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-sm">
	   <form id="service_deposit" name="service_deposit" method="post" action="<?php echo WEB_URL; ?>dashboard/close_ticket">
	   <div class="modal-content">
		   <div class="modal-header">
			  <!-- <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>-->
			   <h4 class="modal-title" id="myModalLabel">Add Remark</h4>
			</div>
			<div class="modal-body">
				<div class='form-group'><strong>Remarks</strong>
				<div class=''>
					<input type='text' data-rule-required='true' id="remarks" Placeholder="Remarks" name="remarks"  class="form-control col-md-7 col-xs-12" />
					<input type="hidden" value="" name="ticket_number" id="ticket_number">
				</div>
			</div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>
 </form>
</div>
</div>

<div class="clearfix"></div>


<!-- Page Content -->

<?php echo $this->load->view(PROJECT_THEME.'/new_theme/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>

<!-- Script to Activate the Carousel --> 


</body>
</html>
<script>
$(document).ready(function() {
    
    $(".closetickt").click(function () {
        
        if(confirm('Do You Want to this Close This ticket ?'))
        {
            var val_id = $(this).attr("data-id");
            
            //alert(val);
            
            $('#ticket_number').val(val_id);
            
            $('#close_ticket').modal('show');
        }
    });
    
    
$('#depostDatatable').DataTable( {

        "order": [[ 1, "desc" ]]

       
    } );
$('#depostDatatable1').DataTable( {

        "order": [[ 1, "desc" ]]

       
    } );$('#depostDatatable2').DataTable( {

        "order": [[ 1, "desc" ]]

       
    } );
  //BookingPagination();
});

function tickets(id,count) {
  if(count>2){
    count = Math.ceil(parseInt(count)/5);
  }else{
    count = 5;
  }
}
         $(document).ready(function () {
            tickets("inboxTickets","2");
        $(document).on("click","#sent",function(){
            $("#sentticktLdr").show();
             setTimeout(function() { $("#sentticktLdr").hide() }, 600);
            $('#sentTickets').children().removeClass("jp-hidden");
            $('#sentTickets').children().addClass("flipInX");
            tickets("sentTickets","2");
        });
        $(document).on("click","#closed",function(){
             $("#clsticktLdr").show();
             setTimeout(function() { $("#clsticktLdr").hide() }, 600);
            $('#closedTickets').children().removeClass("jp-hidden");
            $('#closedTickets').children().addClass("flipInX");
            tickets("closedTickets","2");
        });
        $(document).on("click","#inbox",function(){
             $("#inbticktLdr").show();
             setTimeout(function() { $("#inbticktLdr").hide() }, 600);
            $('#inboxTickets').children().removeClass("jp-hidden");
            $('#inboxTickets').children().addClass("flipInX");
            tickets("inboxTickets","2");
        });
        
        
    });
    </script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/dataTables.tableTools.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/support.js"></script>
<style>
#adddeposit {
    display: none;
}
</style>
