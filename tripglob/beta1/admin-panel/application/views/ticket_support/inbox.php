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
    <link href="<?php echo ASSETS; ?>css/ticket_support/style.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/animate.min.css" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="<?php echo ASSETS; ?>css/custom.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/icheck/flat/green.css" rel="stylesheet">
    <body class="nav-md">

        <div class="container body">


            <div class="main_container">
                <?php echo $this->load->view('common/sidebar_menu'); ?>
                <?php echo $this->load->view('common/top_menu'); ?>
                <div class="right_col" role="main">

                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>
                      Inbox
                    </h3>
                            </div>

                        
                    </div>
                    <div class="clearfix"></div>
                        <div class="row">

                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2> Inbox <small>User Mail</small></h2>
                                    <!-- <ul class="nav navbar-right panel_toolbox">
                                        <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="#"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul> -->
                                    <div class="clearfix"></div>
                                </div>
                                <h4><a href="<?php echo WEB_URL; ?>ticket_support/inbox/"><button class="btn btn-sm" style="float:right;">All Tickets</button></a></h4>
                                <?php echo $this->load->view('ticket_support/search_ticket'); ?>

                                    <div class="row">
                                     <?php if($inbox){ ?>
                                        <div class="col-sm-4 mail_list_column nopad">
                                       <?php $count = 0; foreach($inbox as $allinbox){ $count++; ?>
                                            <div class="mail_list tabadd <?php if($count == 1){echo ' active';} ?>" id="<?php echo $allinbox->support_ticket_id; ?> ">
                                                <div class="right">
                                                    <h3><?php echo $allinbox->support_ticket_subject_value; echo '--'.$allinbox->ticket_unique_id.'...';  ?><small><?php $date = date_create($allinbox->last_update_time); if(date_format($date, 'Y-m-d') == date("Y-m-d")) { echo date_format($date, 'g:ia'); } else{ echo date_format($date, 'g:ia j M Y');  } ?></small></h3>
                                                    <p><?php //echo $allinbox->message; ?></p>
                                                </div>
                                            </div>
                                            <?php } ?>
                                          <p><?php echo $links; ?></p>
                                        </div>
                                        <!-- /MAIL LIST -->


                                        <!-- CONTENT MAIL -->
                                        <div class="col-sm-8 mail_view singleticketdisplay" >
                                            <div class="inbox-body">
                                                <div class="mail_heading row">
                                                    <div class="col-md-8">
                                                        <div class="compose-btn">
                                                           
                                                        </div>

                                                    </div>
                                                <div class="col-md-12">
                                                    <span class="ticket_time"> <?php $date = date_create($singleticket->last_update_time); if(date_format($date, 'Y-m-d') == date("Y-m-d")) { echo date_format($date, 'g:ia'); } else{ echo date_format($date, 'g:ia j M Y');  } ?></span>
                                                        <h4> <?php echo $singleticket->support_ticket_subject_value.'--'. $singleticket->ticket_unique_id; ?></h4>
                                                </div>
                                                </div>
                                               <div class="sender-info">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <strong><?php echo $singleticket->user_name; ?></strong>
                                                            <span>(<?php echo $singleticket->user_email; ?>)</span> to
                                                            <strong>admin</strong>
                                                            <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="view-mail">
                                                    <p><?php echo $singleticket->message; ?></p>
                                                </div>
                                                <?php if($singleticket->file_path){  ?>
                                                <div class="attachment">
                                                    <p>
                                                        <span><i class="fa fa-paperclip"></i> 1 attachment — </span>
                                                        <a href="<?php echo WEB_URL.''.$singleticket->file_path; ?>" download>Download all attachments</a> |
                                                        <a href="<?php echo WEB_URL.''. $singleticket->file_path; ?>" target="_blank">View</a>
                                                    </p>
                                                </div><?php } ?>
                                                </div>
                                           <div class="col-md-12 nopad"> <b>Replies:</b>
                                    <?php if($tickethistory) foreach($tickethistory as $history){  ?><div class="ticket_content ticket_<?php echo $history->support_ticket_history_id; ?>"><div class="left">
                                                </div><p class="mail_header">
                                          <span class="user_deatails">
                                                 
                                       <?php echo $history->last_updated_by; ?>  </span> <span class="tickettime"><?php $date = date_create($history->last_update_time); if(date_format($date, 'Y-m-d') == date("Y-m-d")) { echo date_format($date, 'g:ia'); } else{ echo date_format($date, 'g:ia j M Y');  } ?></span>
                                     </p>
                                    <p><?php echo $history->message; ?></p>
                                         <?php if($history->file_path){  ?>
                                            <div class="attachment">
                                                    <p>
                                                        <span><i class="fa fa-paperclip"></i> 1 attachment — </span>
                                                        <a href="<?php echo WEB_URL.''.$history->file_path; ?>" download>Download all attachments</a> |
                                                        <a href="<?php echo WEB_URL.''.$history->file_path; ?>" target="_blank">View</a>
                                                    </p>
                                             </div> <?php } ?>
                                    </div> <? } 
                                     ?><p class="new_replys"></p>
                                     </div> 
                                            <div class="compose-btn pull-left">
                                                   <button class="btn btn-sm reply_ticket"> <i class="fa fa-reply"></i> Reply</button>
                                                   
                                                    <button title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Print" class="btn  btn-sm tooltips"><i class="fa fa-print"></i> Print</button>
                                                   <a href="<?php echo WEB_URL; ?>ticket_support/closeTicket/<?php echo $singleticket->support_ticket_id; ?>" onclick="return confirm('Are you sure you want to Close this ticket?');"> <button title="" data-placement="top" data-toggle="tooltip" data-original-title="Close Ticket" class="btn btn-sm tooltips">Close Ticket</button></a>
                                                    </button>
                                            </div>
                                            <div class="col-md-12 reply_rext_area">
                                                        <div id="summernote"><p>Enter Your Reply...</p></div> 
                                            <form method="post" action="" id="upload_file" >
                                               
                                                             
                                                            <input type="file" name="userfile" id="userfile" size="20" />
                                                            <input type="submit" class="btn btn-info ticket_reply" alt="<?php echo $singleticket->support_ticket_id; ?>" name="submit" value="Send" id="submit" />
                                            </form>
                                             </div><?php }else{ echo 'No Tickets Found'; } ?>
                                        <!-- /CONTENT MAIL -->

                                   </div></div></div></div></div></div></div></div></div></div>
                 
                    <script>
                    var base_url = "<?php echo WEB_URL; ?>ticket_support/fileupload";
                    </script>
                    <script src="<?php echo ASSETS; ?>js/ticket_support/jquery.min.js"></script> 
                    <script src="<?php echo ASSETS; ?>js/ticket_support/bootstrap.js"></script>
                    <script src="<?php echo ASSETS; ?>js/ticket_support/summernote.js"></script>
                    
                    <script src="<?php echo ASSETS; ?>js/file/ajaxupload.js"></script>
                    <script src="<?php echo ASSETS; ?>js/file/custom.js"></script> 
                    <script src="<?php echo ASSETS; ?>js/progressbar/bootstrap-progressbar.min.js"></script>
                    <script src="<?php echo ASSETS; ?>js/nicescroll/jquery.nicescroll.min.js"></script>
                    <script src="<?php echo ASSETS; ?>js/icheck/icheck.min.js"></script>
                    <script src="<?php echo ASSETS; ?>js/custom.js"></script>
         <script>
                    $(document).ready(function(){
                        
                        $('.tabadd').click(function(){
                            $('.tabadd').removeClass('active');
                            $(this).addClass('active');
                        });
                                    $('.reply_rext_area').hide();
                        $('.note-editable').html('');
                        $(document).on('click','.mail_list',function(){
                            var ticketID=$(this).attr('id');
                            $.ajax({
                                url:"<?php echo WEB_URL; ?>ticket_support/SingleTicketDisplay",
                                type:"POST",
                                data:{SingleTicketID:ticketID},
                            }).done(function(data){
                                $('.singleticketdisplay').html(data);
                        });
                        });
                        $(document).on('click','.reply_ticket',function(){
                            $('.reply_rext_area').slideToggle();
                        });
                        $(document).on('click','.ticket_reply',function(){
                            var newticketID = $(this).attr('alt');
                            var message = $('.note-editable').html();
                            var file = $('#userfile').val();
                            if(message.length > 50) {
                            //if(message !='' & message != '<p></p>'){
                            $.ajax({
                            url:"<?php echo WEB_URL; ?>ticket_support/AddTicketReply",
                            type:"POST",
                            data:{newticketID:newticketID,message:message},
                             }).done(function(data){
                               if(file){
                            $('.new_replys').append('<div class="ticket_content ticket_"'+ data+'><p class="mail_header"><span class="user_deatails">Admin</span><span class="tickettime">Few Seconds Ago</span></p><p>'+message+'</p><div class="attachment"><p><span><i class="fa fa-paperclip"></i> 1 attachment</span></p></div></div>');
                             }else {
                                 $('.new_replys').append('<div class="ticket_content ticket_"'+ data+'><p class="mail_header"><span class="user_deatails">Admin</span><span class="tickettime">Few Seconds Ago</span></p><p>'+message+'</p></div>');
                             }
                            $('.note-editable').html('');
                            return true;
                        });
                        }
                         else { alert('Enter minimum 50 characters...'); }//$('.note-editable').focus(); return false; }
                        });
                    
                            $('#summernote').summernote();
                        
                        $('#summernote').summernote({
                          height: 300,                 // set editor height
                          minHeight: null,             // set minimum height of editor
                          maxHeight: null,             // set maximum height of editor
                          focus: true                  // set focus to editable area after initializing summernote
                        });

                        });
</script>

         </body>                                                  