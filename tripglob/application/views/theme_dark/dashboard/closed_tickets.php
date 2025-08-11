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
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/dataTables.tableTools.css">
<link href="<?php echo ASSETS; ?>css/toggle-switch.css" rel="stylesheet" media="screen">
<link href="<?php echo ASSETS; ?>css/dashboard.css" rel="stylesheet" />
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
 <h3 class="lineth">Closed Tickets</h3>
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
    

                
                 <!-- <span class="profile_head">Closed Tickets</span>  -->
              <div class="withedrow" style="overflow: scroll !important;">
                    <div class="rowit chngecolr" id="closedTickets" style=" padding-bottom:22px">

            <table id="depostDatatable2" class='data-table-column-filter table table-bordered table-striped' cellspacing="0" width="100%">
                        <thead>
                            <tr class="sortablehed">
                                <th>SL No</th>
                                <th>Ticket ID</th>
                                <th>Date</th>
                              
                                
                                <th>Subject</th>
                                
                                <th>Remarks</th>
                               
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
            <?php if($support_close!=''){
            for($i=0;$i<count($support_close);$i++)
            {
                 
                ?>
                <tr>
            <td><?php echo $i+1; ?></td>
            <td><?php echo $support_close[$i]->ticket_unique_id; ?></td>
            <td><?php echo date('M j,Y',strtotime($support_close[$i]->created_time)); ?></td> 
            <td><?php echo substr($support_close[$i]->support_ticket_subject_value,0,100); ?></td>
            <td><?php echo $support_close[$i]->remarks; ?></td>
            <td> CLOSED <?php /*?><a class="viewtickt viewTicket" id="<?php echo $support_close[$i]->support_ticket_id; ?>" href="#viewticketss<?php echo $support_close[$i]->support_ticket_id; ?>" data-toggle="tab">View</a<a class="closetickt" href="<?php echo WEB_URL; ?>dashboard/delete_ticket/<?php echo $support_close[$i]->support_ticket_id; ?>">Delete</a><?php */?></td>
            </tr>
            
            
            <?php }} else{?>
     
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
        
        $(document).on("click",".closetickt",function(){
              $("#clsticktLdr").show();
            var ticketid = $(this).attr('ticketid');
            var tickettype = $(this).attr('tickettype');

            if(ticketid){
            $.ajax({
                    type: "POST",
                    url: "<?php echo WEB_URL; ?>dashboard/close_ticket/"+ticketid,
                    data: '',
                    dataType: "json",
                    success: function(data){
                        if(data.status==1)
                        {
                            setTimeout(function() { $("#clsticktLdr").hide() }, 600);
                            $("#closeticket"+ticketid).remove();
                            $("#totalLI"+ticketid).clone().appendTo("#closedTickets");
                            $("#totalLI"+ticketid).remove();
                            $( "#closed" ).trigger( "click" );
                            //tickets(tickettype,"2");
                        }
                    }
                });
                return false;
            }else{
                return false;
            }
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
