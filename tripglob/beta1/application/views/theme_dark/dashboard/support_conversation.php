<?php
$active_domain_modules = $GLOBALS ['CI']->active_domain_modules;
$master_module_list = $GLOBALS ['CI']->config->item ( 'master_module_list' );
if (empty ( $default_view )) {
  $default_view = $GLOBALS ['CI']->uri->segment ( 2 );
}
?>
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
    <!-- pankaj start here -->
    <style>
        .list_of_sections a {
            background: #fff none repeat scroll 0 0;
            border: 1px solid #eeeeee;
            border-radius: 3px;
            box-shadow: 0 1px 2px 0 #ccc;
            color: #666;
            float: left;
            font-size: 14px;
            margin: 5px;
            padding: 5px 10px;
        }
        .list_of_sections a{
          margin-bottom: 20px;
        }
        .list_of_sections a.active {
            color: #1b66a9;
        }
    </style>
    <!-- pankaj end here -->
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
<h3 class="lineth">Add Ticket</h3>

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
    


            
               

    
    <div class="withedrow">
                    <div class="rowit chngecolr set_toggle">
                      <div class="addtiktble">
                     <form action="<?php echo WEB_URL; ?>dashboard/add_new_ticket" method="post"  enctype="multipart/form-data" class='validate form-horizontal' id="addNewTicket12311">   
                        <input type="hidden" value="<?php echo WEB_URL; ?>dashboard" id="thisController">                      
                        <div class="likrticktsec">
                            <div class="cobldo">Subject</div>
                            <div class="coltcnt">
                                <select class="payinselect mySelectBoxClassfortab hasCustomSelect" name="subject" required>
                                    <?php for($i=0;$i<count($support_ticket_subject);$i++){ ?>
                                        <option value="<?php echo $support_ticket_subject[$i]->support_ticket_subject_id; ?>"><?php echo $support_ticket_subject[$i]->support_ticket_subject_value; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="likrticktsec">
                            <div class="cobldo">Attachment</div>
                            <div class="coltcnt">

                                <input type="file" name="file_name" class="payinput" id="attach_file" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*"> 
                            </div>
                        </div>
                        
                        <div class="likrticktsec">
                            <div class="cobldo">Message</div>
                            <div class="coltcnt">
                                <textarea class="tikttext" name="message" id="message" required></textarea>
                            </div>
                        </div>
                        
                        <div class="likrticktsec">
                            <div class="cobldo">&nbsp;</div>
                            <div class="coltcnt">
                            <input type="submit" class="dashbuttons extr_profile" value="Add Ticket" onclick="return confirm('Do You Want to this Open a ticket ?')">
                            </div>
                        </div>
                        </form>
                      </div>
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
<div class="clearfix"></div>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<?php //echo $this->load->view(PROJECT_THEME.'/new_theme/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>

<!-- Script to Activate the Carousel --> 


<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/dataTables.tableTools.js"></script>

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
          $('#attach_file').on( 'change', function() {
   myfile= $( this ).val();
   var ext = myfile.split('.').pop();
   // console.log(ext);
   if(ext=="png" || ext=="gif" || ext=="pdf" || ext=="jpeg"||ext=="jpg" || ext==''|| ext=="doc"|| ext=="docx"|| ext=="txt"||ext=="ppt"||ext=="pptx"||ext=="xls"||ext=="xlsx"){       
   } else{
      alert('Only Image and PDF format will  be accepted');
       $('#attach_file').val('');
   }
});
    </script>


<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/support.js"></script>

</body>
</html>