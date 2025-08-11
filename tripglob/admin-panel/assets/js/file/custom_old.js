$(function() {
    $('#upload_file').submit(function(e) {
        e.preventDefault();
        $.ajaxFileUpload({
            url             :base_url , 
            secureuri       :false,
            fileElementId   :'userfile',
            dataType: 'JSON',
            
            success : function (data)
            {
               var obj = jQuery.parseJSON(data);                
                if(obj['status'] == 'success')
                {
                   // alert(data);
                   // var ticket = $('.ticket_'+obj['id']);
                   // ticket.find('class','dummy_attachment').attr('href',obj['msg']);
                 }
                else
                 {
                   //alert('0');
                   // $('#files').html('Some failure message');
                  }
            }
        });
        return false;
    });
});