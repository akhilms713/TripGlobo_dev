                                <div class="inbox-body ">
                                                <div class="mail_heading row">
                                                    <div class="col-md-8">
                                                        <div class="compose-btn">
                                                            
                                                        </div>

                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                    <span class="ticket_time"> <?php $date = date_create($singleticket->last_update_time); if(date_format($date, 'Y-m-d') == date("Y-m-d")) { echo date_format($date, 'g:ia'); } else{ echo date_format($date, 'g:ia j M Y');  } ?></span>
                                                        <h4> <?php echo $singleticket->support_ticket_subject_value; ?></h4>
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
                                                        <a href="<?php echo $singleticket->file_path; ?>" target="_blank">View</a>
                                                    </p>
                                                </div> <?php } ?>
                                                
                                </div>
                                <div class="col-md-12 nopad"> <b>Replies:</b>
                                                <?php if($tickethistory) foreach($tickethistory as $history){  ?><div class="ticket_content">
                                                <div class="left">
                                                            </div>
                                                <p class="mail_header">
                                                   <span class="user_deatails"><?php  echo $history->last_updated_by; ?>  </span>         <span class="tickettime"><?php $date = date_create($history->last_update_time); if(date_format($date, 'Y-m-d') == date("Y-m-d")) { echo date_format($date, 'g:ia'); } else{ echo date_format($date, 'g:ia j M Y');  } ?></span>
                                                </p><p><?php echo $history->message; ?></p>
                                                 <?php if($history->file_path){  ?>
                                            <div class="attachment">
                                                    <p>
                                                        <span><i class="fa fa-paperclip"></i> 1 attachment — </span>
                                                        <a href="<?php echo WEB_URL.''.$history->file_path; ?>" download>Download all attachments</a> |
                                                        <a href="<?php echo WEB_URL.''.$history->file_path; ?>" target="_blank">View</a>
                                                    </p>
                                                </div> <?php } ?>
                                        </div>

                                     <? }  ?><p class="new_replys"></p>
                                </div> 
                                        <div class="compose-btn pull-left">
                                                   <button class="btn btn-sm reply_ticket"><i class="fa fa-reply"></i> Reply</button>
                                                   <button title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Print" class="btn  btn-sm tooltips" onclick="myFunction()"><i class="fa fa-print"></i> </button>
                                                    <a href="<?php echo WEB_URL; ?>ticket_support/closeTicket/<?php echo $singleticket->support_ticket_id; ?>" onclick="return confirm('Are you sure you want to Close this ticket?');"> <button title="" data-placement="top" data-toggle="tooltip"  class="btn btn-sm tooltips">Close Ticket</button></a>
                                                    </button>
                                                </div>
                                    <div class="col-md-12 reply_rext_area">
                                            <div id="summernote"><p>Enter Your Reply...</p></div> 
                                    <form method="post" action="" id="upload_file" >
                                        <input type="file" name="userfile" id="userfile" size="20" />
                                        <input type="submit" class="btn btn-info ticket_reply" value="Send" alt="<?php echo $singleticket->support_ticket_id; ?>" name="submit" id="submit" />
                                    </form>
                                    </div>
                                   
                                        
                                        <script>
                                        $(document).ready(function() {
                                            $('.reply_rext_area').hide();
                                            $('#summernote').summernote();
                                        
                                        $('#summernote').summernote({
                                      height: 300,                 // set editor height
                                      minHeight: null,             // set minimum height of editor
                                      maxHeight: null,             // set maximum height of editor
                                      focus: true                  // set focus to editable area after initializing summernote
                                    });

                                    });
                                      </script>
                                      
<script>
function myFunction() {
  window.print();
}
</script>

                                        <script src="<?php echo ASSETS; ?>js/file/ajaxupload.js"></script>
                                        <script src="<?php echo ASSETS; ?>js/file/custom.js"></script>
