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

    <link href="<?php echo ASSETS; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo ASSETS; ?>css/custom.css" rel="stylesheet">

    <link href="<?php echo ASSETS; ?>css/icheck/flat/green.css" rel="stylesheet">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> 
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
<style>
.tickettime{
    float:right;
}
.user_deatails{
    float:left;
    color:Grey;
    font-weight: bold;
}
.reply_message{
    width: 85%;
}
.mail_header{
    height:20px;
        border-bottom: 2px solid #ccc;
}
.ticket_content{
    box-shadow: 0.5px 0.5px 0.5px 0.5px;
    padding: 5px;
        margin: 0px 0px 7px 3px;
}
.ticket_remarks{
    margin-top: 10px;
    border: solid 1px #eee;
    padding: 10px;
}
</style>

   
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
                  Closed Ticket
                </h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <h4><a href="<?php echo WEB_URL; ?>ticket_support/closed"><button class="btn btn-sm" style="float:right;">All Tickets</button></a></h4>
                    <?php echo $this->load->view('ticket_support/search_ticket'); ?>
        <div class="row">

                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2> Closed Ticket <small></small></h2>
                                    <!--<ul class="nav navbar-right panel_toolbox">
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
                                    </ul>-->
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">


                                    <div class="row">
                           <?php         if($inbox){ ?>
                                        <div class="col-sm-4 mail_list_column nopad">
                                       <?php $count = 0; foreach($inbox as $allinbox){ $count++; ?>
                                            <div class="mail_list tabadd <?php if($count == 1){echo ' active';} ?>" id="<?php echo $allinbox->support_ticket_id; ?> ">
                                                <div class="right">
                                                    <h3><?php echo $allinbox->support_ticket_subject_value;echo '--'.$allinbox->ticket_unique_id.'...';  ?><small><?php $date = date_create($allinbox->last_update_time); if(date_format($date, 'Y-m-d') == date("Y-m-d")) { echo date_format($date, 'g:ia'); } else{ echo date_format($date, 'g:ia j M Y');  }  ?></small></h3>
                                                    <p><?php //echo $allinbox->message; ?></p>
                                                </div>
                                            </div>
                                            <?php } ?>
                                          <p><?php echo $links; ?></p>
                                        </div>
                                        <!-- /MAIL LIST -->


                                        <!-- CONTENT MAIL -->
                                      <!--   <div class="col-md-1"></div> -->
                                        <div class="col-sm-8 mail_view singleticketdisplay" >
                                            <div class="inbox-body">
                                                <div class="mail_heading row">
                                                    <div class="col-md-8">
                                                        <div class="compose-btn">
                                                           
                                                        </div>

                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <p class="date"> <?php $date = date_create($singleticket->last_update_time); if(date_format($date, 'Y-m-d') == date("Y-m-d")) { echo date_format($date, 'g:ia'); } else{ echo date_format($date, 'g:ia j M Y');  }   ?></p>
                                                    </div>
                                                    <div class="col-md-12">
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
                                                        <a href="<?php echo $singleticket->file_path; ?>" download>Download all attachments</a> |
                                                        <a href="#">View</a>
                                                    </p>
                                                </div><?php } ?>
                                                </div>
                                           <div class="col-md-12 nopad"> <b>Replies:</b>
                                          <?php if($tickethistory) foreach($tickethistory as $history){  ?><div class="ticket_content ticket_<?php echo $history->support_ticket_history_id; ?>"><div class="left">
                                                </div><p class="mail_header">
                                          <span class="user_deatails">
                                         
                                               <?php echo $history->last_updated_by; ?>  </span>         <span class="tickettime"><?php $date = date_create($history->last_update_time); if(date_format($date, 'Y-m-d') == date("Y-m-d")) { echo date_format($date, 'g:ia'); } else{ echo date_format($date, 'g:ia j M Y');  }  ?></span>
                                                    </p>
                                                    <p><?php echo $history->message; ?></p>
                                                 <?php if($history->file_path){  ?>
                                            <div class="attachment">
                                                    <p>
                                                        <span><i class="fa fa-paperclip"></i> 1 attachments — </span>
                                                        <a href="<?php echo WEB_URL.''.$history->file_path; ?>" download>Download all attachments</a> |
                                                        <a href="<?php echo WEB_URL.''.$history->file_path; ?>" target="_blank">View</a>
                                                    </p>
                                                </div> <?php } ?>
                                    </div> <? }
                                     ?>
                                     
                                     <!--<p class="ticket_remarks"> <b>USER Remark: </b><?php //echo $singleticket->remarks; ?> </p>-->
                                     <p class="new_replys"></p>
                                     </div> 
                                            <div class="compose-btn pull-left">
                                                   <button class="btn btn-sm reply_ticket"> <i class="fa fa-reply"></i> Reply</button>
                                                   
                                                    <button title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Print" class="btn  btn-sm tooltips"><i class="fa fa-print"></i> </button>
                                                   <a href="<?php echo WEB_URL; ?>ticket_support/closeTicket/<?php echo $singleticket->support_ticket_id; ?>"> <button title="" data-placement="top" data-toggle="tooltip" data-original-title="Trash" class="btn btn-sm tooltips"><i class="fa fa-trash-o"></i></button></a>
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

                                    </div>
                                </div>
                            </div>
                        </div></div></div>
                    </div></div></div>

                    <script>
                    var base_url = "<?php echo WEB_URL; ?>ticket_support/fileupload";
                    </script>
   
                    <script>
                    $(document).ready(function(){
						
						$('.tabadd').click(function(){
							$('.tabadd').removeClass('active');
							$(this).addClass('active');
						});
						
						//$('.note-editable').html('');
                        $('.reply_rext_area').hide();
                        $(document).on('click','.mail_list',function(){
                            var ticketID=$(this).attr('id');
                            $.ajax({
                                url:"<?php echo WEB_URL; ?>ticket_support/closedSingleTicketDisplay",
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
                            if(message !=''){
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
                            //$('.new_replys').append('<div class="ticket_content ticket_"'+ data+'><p class="mail_header"><span class="user_deatails">Admin</span><span class="tickettime">Few Seconds Ago</span></p><p>'+message+'</p></div>');
                            $('.note-editable').html('');
                            return true;
                             });
                         }
                         else { $('.note-editable').focus(); return false; }
                                      });
                        });


                    </script>
                                    <script src="<?php echo ASSETS; ?>js/file/ajaxupload.js"></script>

                               <script src="<?php echo ASSETS; ?>js/file/custom.js"></script>  
                                    
                  
                  </body>
                        <script src="<?php echo ASSETS; ?>js/progressbar/bootstrap-progressbar.min.js"></script>
                        <script src="<?php echo ASSETS; ?>js/nicescroll/jquery.nicescroll.min.js"></script>
                        <script src="<?php echo ASSETS; ?>js/icheck/icheck.min.js"></script>
                        <script src="<?php echo ASSETS; ?>js/custom.js"></script>
                                                       <script>
                                        $(document).ready(function() {
                                            $('#summernote').summernote();
                                        
                                                $('#summernote').summernote({
                                              height: 300,                 // set editor height
                                              minHeight: null,             // set minimum height of editor
                                              maxHeight: null,             // set maximum height of editor
                                              focus: true                  // set focus to editable area after initializing summernote
                                            });

                                            });
                                     </script>