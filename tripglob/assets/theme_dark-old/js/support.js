 

	$(".viewTicket").on("click",  function(){
		
		$("#viewticktLdr").show();
		var id = $(this).attr('id');
		$(".showTickets").attr('id', 'viewticketss'+id);
		var url = $("#thisController").val();
		$.ajax({
			type:"POST",
			data:{},
			url:WEB_URL+"dashboard/view_ticket/"+id,
			dataType:"JSON",
			success:function(res){
				if(res.status=='1'){
					setTimeout(function() { $("#viewticktLdr").hide() }, 600);
					$("#viewTickets").html(res.tickets)
						
				}
			}		
		});	
	});

	$("#inboxsearchTickets").keyup(function(){       
        
		var filter = $(this).val(), count = 0;
		var regex = new RegExp(filter, "i"); 
		$("ul#inboxTickets li.searchCount div.searchSupport div.showOrHide").each(function()
		{   
		   if (($(this).attr('data-ticket').search(regex) < 0) && ($(this).attr('data-time').search(regex) < 0) && ($(this).attr('data-subject').search(regex) < 0) && ($(this).attr('data-reply').search(regex) < 0)) 
		    { 
			$(this).parents(".searchSupport").parent().hide();         
		    }
		    else 
		    {
			count++;
		     	 $(this).parents(".searchSupport").parent().show();
		        $(this).parents(".searchSupport").show();
			tickets("inboxTickets",count);
			
		    }    
			
			  
		});
		
		
    	 }); 
	
	$("#sentsearchTickets").keyup(function(){       
        
		var filter = $(this).val(), count = 0;
		var regex = new RegExp(filter, "i"); 
		$("ul#sentTickets li.searchCount div.searchSupport div.showOrHide").each(function()
		{   
		   if (($(this).attr('data-ticket').search(regex) < 0) && ($(this).attr('data-time').search(regex) < 0) && ($(this).attr('data-subject').search(regex) < 0) && ($(this).attr('data-reply').search(regex) < 0)) 
		    { 
			$(this).parents(".searchSupport").parent().hide();         
		    }
		    else 
		    {
			count++;
			$(this).parents(".searchSupport").parent().show();
		        $(this).parents(".searchSupport").show();
			tickets("sentTickets",count);
			
		    }    
			
			  
		});
	
		
    	 }); 

	$("#closedsearchTickets").keyup(function(){       
        
		var filter = $(this).val(), count = 0;
		var regex = new RegExp(filter, "i"); 
		$("ul#closedTickets li.searchCount div.searchSupport div.showOrHide").each(function()
		{   
		   if (($(this).attr('data-ticket').search(regex) < 0) && ($(this).attr('data-time').search(regex) < 0) && ($(this).attr('data-subject').search(regex) < 0) && ($(this).attr('data-reply').search(regex) < 0)) 
		    { 
			$(this).parents(".searchSupport").parent().hide();         
		    }
		    else 
		    {
			count++;
		        $(this).parents(".searchSupport").parent().show();
		        $(this).parents(".searchSupport").show();
			tickets("closedTickets",count);
			
		    }    
			
			  
		});
		
		
    }); 

  
	$("#addNewTicket123").on('submit',function(e) {
		e.preventDefault();
		 $("#sentticktLdr").show();
		var message = $("#message").val();
		if(message){
		var action = $("#addNewTicket123").attr('action');
		var data = new FormData(this);
		var files =  document.getElementById('attach_file').files[0];
		$.ajax({
				type: "POST",
				url: action,
				data: new FormData(this),
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false, 
				dataType: "json",
				success: function(data){
					 setTimeout(function() { $("#sentticktLdr").hide() }, 600);
					$("#sentTickets").append(data.tickets);
					$("#message").val('');
					$("#loginLdr").hide();
					$( "#sent" ).trigger( "click" );
				}
			});
			return false;
		}else{
			return false;
		}
	});
 