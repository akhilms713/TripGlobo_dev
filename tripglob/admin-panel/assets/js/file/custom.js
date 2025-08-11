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
                  $('.new_img').append('<li class="photo'+obj['id']+'"><div class="picture"><div class="tags"><a id="'+obj['id']+'" class="btn  has-tooltip btn-danger btn-xs delete_photo" data-original-title="Delete"><span class="fa fa-trash"></span></a></div><a data-lightbox="flatty" href="'+obj['url']+'"><img width="130" src="'+web_url+obj['url']+'" /></a></div></li>');
                  $('.empty_image').slideUp();
                  // alert(obj['msg']);
                   // var ticket = $('.ticket_'+obj['id']);
                   // ticket.find('class','dummy_attachment').attr('href',obj['msg']);
                 }
                else
                 {
                  // alert(obj['msg']);
                   // $('#files').html('Some failure message');
                  }
            }
        });
        return false;
    });
});
 
