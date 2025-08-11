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
<h3 class="lineth">Inbox</h3>

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
    

            
            


                 
               <!--  <span class="profile_head">Inbox</span>  -->
                 <div class="withedrow">
                    <div class="rowit chngecolr" id="inboxTickets" style=" padding-bottom:22px">
            <table id="depostDatatable1" class='data-table-column-filter table table-bordered table-striped' cellspacing="0" width="100%">
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
            if($support_pending!=''){
            for($i=0;$i<count($support_pending);$i++)
            {
            ?>
            <tr>
<td><?php echo $i+1; ?></td>
<td><?php echo $support_pending[$i]->ticket_unique_id; ?></td>
<td><?php echo date('M j,Y',strtotime($support_pending[$i]->created_time)); ?></td>

<td><?php echo substr($support_pending[$i]->subject,0,100); ?></td>

<td> <a class="viewtickt viewTicket" id="<?php echo $support_pending[$i]->support_ticket_id; ?>" href="<?php echo WEB_URL; ?>dashboard/view_ticket/<?php echo $support_pending[$i]->support_ticket_id; ?>">View</a>

     <a class="closetickt" href="<?php echo WEB_URL; ?>dashboard/close_ticket/<?php echo $support_pending[$i]->support_ticket_id; ?>" onclick="return confirm('Do You Want to Close this Ticket?')">Close</a></td>
            </tr>
            
            <?php
              }
            }
             else{?>
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
<div class="clearfix"></div>


<!-- Page Content -->

<?php echo $this->load->view(PROJECT_THEME.'/new_theme/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>

<!-- Script to Activate the Carousel --> 


</body>
</html>
<script>
$(document).ready(function() {
	
	
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
