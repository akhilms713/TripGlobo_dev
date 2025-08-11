$(document).ready(function() {
    $('#test_email').popup();
    $('#email').popup();

    // $('.send_campaign_email_confirm').hide();
    /*Fetch the email template from the database via ajax call*/
    $('.email_loader, .loader_text').hide();
    $('.loader_text').html('<div style="background: #fff; padding: 5px">Sending Mail...</div>');
    $('.view_template').on('click', function() {
        var id = $(this).data('id');    /*Get the id of the clicked row using data attribute.*/
        $.ajax({
            url: api_url+"newsletter/fetch_campaign_template/" + id,
            dataType: 'json',
            success: function(res) {
                $('.template_data').html(res['campaign_template']);
            }
        });
        /*  Use popup overlay to create a lightbox to show the template. 
         Plugin location: admin/assets/plugins/jquery.popupoverlay.js  */
        $('#template').popup();
    });

    $('.emailSend').on('click', function() { 
        $('#email').popup();
        $('.send_email_box_content').show();
        window.id = $(this).data('email');
        $('.emailSuccess, .emailFail, .emailSending').hide();
    });

    $('#sendCampaignMail').on('click', function() {
        var id = window.id;
        var allB2c  = $('#allB2c').prop('checked');
        var allB2b  = $('#allB2b').prop('checked');
        var allSub  = $('#allSub').prop('checked');

        if(allB2c) {
            allB2c_val = 1;
        } else {
            allB2c_val = 0;
        }

        if(allB2b) {
            allB2b_val = 1;
        } else {
            allB2b_val = 0;
        }

        if(allSub) {
            allSub_val = 1;
        } else {
            allSub_val = 0;
        }

        
        $('.send_email_box_content').hide();
        $('.emailSending').show();
        
        $.ajax({
            url: api_url+"newsletter/send_campaign_email/" + id,
            data: {'allB2c': allB2c_val, 'allB2b': allB2b_val, 'allSub': allSub_val},
            method: 'POST',
            dataType: 'json',
            success: function(res) {
                
                if (res.status == 1) {
                    $('.loader_text').html('<div style="background: #fff; padding: 5px"><i class="fa fa-check-circle"></i> Mail Sent Successfully</div>');
                    $('.email_loader').slideUp();
                    $('.emailSending').hide();
                    $('.emailSuccess').show();
                } else {
                    $('.loader_text').html('<div style="background: #fff; padding: 5px">Mail sending failed</div>');
                    $('.email_loader').fadeOut();
                    $('.emailSending').hide();
                    $('.emailFail').show();
                }

            }
        });
    })

    $('.test_email_open').on('click', function() {
        window.test_email_id = $(this).data('testemail');
        $('.input_box_div').show();
        $('.testEmailSending, .testEmailFail, .testEmailSuccess').hide();
    });

    $('#sendTestMail').on('click', function() {
        var emailId = $('#testEmailId').val().trim();
        if (emailId) {
            $('.input_box_div').hide();
            $('.testEmailSending').show();
            var id = window.test_email_id;
            $.ajax({
                url: api_url+"newsletter/send_test_campaign_email/",
                data: {'id': id, 'emailid': emailId},
                method: 'post',
                dataType: 'json',
                success: function(r) {
                    if (r.status == 1) {
                        $('.testEmailSending').hide();
                        $('.testEmailSuccess').show();
                    } else {
                        $('.testEmailSending').hide();
                        $('.testEmailFail').show();
                    }

                }
            });
        }
    });

    $('.close_popup').on('click', function() {
        //  alert();
        $('#email, #template, #test_email').popup('hide');
    });

});