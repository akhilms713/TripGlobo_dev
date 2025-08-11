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
