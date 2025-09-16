//var web = 'http://<?php echo $_SERVER['HTTP_HOST'];?>/Travel_APT';
/*
$("#registration").validate({
	rules: {
		password: "required",
		cpassword: {
		equalTo: "#password"
		}
	},
	submitHandler: function() { 
		$('#loginLdrReg').show();
		var action = $("#registration").attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $("#registration").serialize(),
			dataType: "json",
			success: function(data){
				if(data.status == 1){
					$('#loginLdrReg').hide();
					$('#login_signup').removeClass('open');
					//$('#fadeandscalereg').popup('hide');
					doLogin(data);
				}
				if(data.status == 3){
					$('#loginLdrReg').hide();
					$('#login_signup').removeClass('open');
					//$('#fadeandscalereg').popup('hide');
					$('#confirmation').modal('toggle');
					$("#confim_email_idshow").html(data.emailid);
					
				}
				else{
					$('#loginLdrReg').hide();
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
				}
			}
		});
		return false; 
	}
});

  
$("#login_prebook").validate({
	submitHandler: function() { 
	
		p = $('#pswd_p').val();
		p_s = $('#booking_user_mobile').val();
		
			if(p=='')
			{
			$('.errMsg').empty().append('<label id="pswd_p-error" class="error" for="pswd_p">This field is required.</label>');
			}
			if(p_s=='')
			{
			$('.errMsgf').empty().append('<label id="booking_user_mobile-error" class="error" for="booking_user_mobile">This field is required.</label>');
			}
	 
		if(p =='' && p_s=='') {
				return false;
		}
		
		$('#loginLdrReg_p').show();
		if(p!='')
			{
		var action = $("#login_prebook").attr('login-action');

		$.ajax({
			type: "POST",
			url: action,
			data: $("#login_prebook").serialize(),
			dataType: "json",
			success: function(data){
				if(data.status == 1){
					$('#loginLdrReg_p').hide();
					$('.signing_detis').fadeOut(500);
					$('.signing_detis_confirm').fadeIn(500);
					if(data.user_logs_status)
					{
					 $("#user_logs_status").html(data.user_logs_status);
					}
					//$('#fadeandscale').popup('hide');
					doLogin(data);
				} else if(data.status == 2) {
					var curUrl = document.URL; //encode to base64
					window.location.href = WEB_URL+'security/verifytwostep?url='+curUrl;
				} else{
					$('#loginLdrReg_p').hide();
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
				}
			}
		});
			}
			else if(p_s!='')
			{
				
		var action = $("#login_prebook").attr('reg-action');

		$.ajax({
			type: "POST",
			url: action,
			data: $("#login_prebook").serialize(),
			dataType: "json",
			success: function(data){
				 $('#secdata').val(data.secdata);
				 $("#user_logs_status").html(data.user_logs_status);
				$('.signing_detis').fadeOut(500);
					$('.signing_detis_confirm').fadeIn(500);
				
			}
		});
			}
			
		return false; 
	}
});
*/
$("#login").validate({
	submitHandler: function() { 
		p = $('#pswd').val();
		if(!p) {
			$('.errMsg').empty().append('<label id="pswd-error" class="error" for="pswd">This field is required.</label>');
			return false;
		}
		$('#loginLdr').show();
		var action = $("#login").attr('action');

		$.ajax({
			type: "POST",
			url: action,
			data: $("#login").serialize(),
			dataType: "json",
			success: function(data){
				if(data.status == 1){
					$('#loginLdr').hide();
					$('#login_signup').removeClass('open');
					
					$('.signing_detis').fadeOut(500);
					$('.signing_detis_confirm').fadeIn(500);
					if(data.user_logs_status)
					{
					 $("#user_logs_status").html(data.user_logs_status);
					}
					//$('#fadeandscale').popup('hide');
					doLogin(data);
				} else if(data.status == 2) {
					var curUrl = document.URL; //encode to base64
					window.location.href = WEB_URL+'security/verifytwostep?url='+curUrl;
				} else{
					$('#loginLdr').hide();
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
				}
			}
		});
		return false; 
	}

});
/*
$("#login1").validate({
	submitHandler: function() { 
		var action = $("#login1").attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $("#login1").serialize(),
			dataType: "json",
			success: function(data){
				
				if(data.status == 1){
					$('#fadeandscale').popup('hide');
					window.location.href = data.continue;
				} else if(data.status == 2) {
					var curUrl = document.URL; //encode to base64
					window.location.href = WEB_URL+'security/verifytwostep?url='+curUrl;
				} else{
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
				}
			}
		});
		return false; 
	}
});

$("#login2").validate({
	submitHandler: function() { 
		var action = $("#login2").attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $("#login2").serialize(),
			dataType: "json",
			success: function(data){
				
				if(data.status == 1){
					$('#fadeandscale').popup('hide');
					window.location.href = data.continue;
				} else if(data.status == 2) {
					var curUrl = document.URL; //encode to base64
					window.location.href = WEB_URL+'security/verifytwostep?url='+curUrl;
				} else{
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
				}
			}
		});
		return false; 
	}
});


/*$("#login1").validate({
	submitHandler: function() { 
		var action = $("#login1").attr('action'); alert(action);
		$.ajax({
			type: "POST",
			url: action,
			data: $("#login1").serialize(),
			dataType: "json",
			success: function(data){ 
				alert();
				if(data.status == 1){
					$('#fadeandscale').popup('hide');
					window.location.href = 'dashboard';
				}else{
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
				}
			}
		});
		return false; 
	}
});*/
/*

$("#forgetpwd").validate({
	submitHandler: function() { 
		var action = $("#forgetpwd").attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $("#forgetpwd").serialize(),
			dataType: "json",
			success: function(data){
				if(data.status == 1){
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
					setTimeout(function(){$('#fadeandscaleforget').popup('hide');}, 8000);
				}else{
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
				}
			}
		});
		return false; 
	}
});

$("#resetpwd").validate({
	rules: {
		password: "required",
		cpassword: {
			equalTo: "#npassword"
		}
	},
	submitHandler: function() { 
		var action = $("#resetpwd").attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $("#resetpwd").serialize(),
			dataType: "json",
			success: function(data){
				if(data.status == 1){
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
					setTimeout(function(){$('#afterlogin').click();}, 3000);
				}else{
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
				}
			}
		});
		return false; 
	}
});

$("#editprofile").validate({
	submitHandler: function() { 
		var action = $("#editprofile").attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $("#editprofile").serialize(),
			dataType: "json",
			success: function(data){
				if(data.status == '1'){
					$('div.editmsg').html(data.msg);
					var percentageToScroll = 100;
    				var percentage = percentageToScroll/100;
    				var height = $(document).scrollTop();
    				var scrollAmount = height * (1 - percentage);
    				$('html,body').animate({ scrollTop: scrollAmount }, 'slow', function () {
                          $('div.editmsg').show(); 
                          setTimeout(function(){ $('div.editmsg').hide();}, 4000);   
                    });
					
				}else{
					$('div.editmsg').html('Something wrong please try again');
					var percentageToScroll = 100;
    				var percentage = percentageToScroll/100;
    				var height = $(document).scrollTop();
    				var scrollAmount = height * (1 - percentage);
    				$('html,body').animate({ scrollTop: scrollAmount }, 'slow', function () {
                          $('div.editmsg').show(); 
                          setTimeout(function(){ $('div.editmsg').hide();}, 4000);   
                    });
				}
			}
		});
		return false; 
	}
});


$("#change_password").validate({
	rules: {
		opassword: {
			remote: {
		      	url: WEB_URL+"security/validatePassword",
		        type: "post"
		    }
	    },
		password: "required",
		cpassword: {
			equalTo: "#npassword"
		}
	},
	submitHandler: function() { 
		var action = $("#change_password").attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $("#change_password").serialize(),
			dataType: "json",
			success: function(data){
				if(data.status == 1){
					$('div.msg').html(data.msg);

					$('div.msg').show();
					$( "#change_password" ).resetForm();
					setTimeout(function(){ $('div.msg').hide();}, 4000);  
				}
			}
		});
		return false; 
	}
});

//Home Page
$("#apartment").validate();
$('#cars').validate();
$('#vacations').validate();
$('#hotel_search').validate();

//$("#flight").validate();
$('input.fromflighta').each(function () {
    $(this).rules('add', {
        required: true
    });
});
*/


/*$("#bookNow").validate({
	submitHandler: function() {
		var action = $("#bookNow").attr('action');
		
		return false; 
	}
});*/
/*
$("#checkout-apartment").validate({
	submitHandler: function() {
		var action = $("#checkout-apartment").attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $("#checkout-apartment").serialize(),
			dataType: "json",
			beforeSend: function(){
		        $('.lodrefrentwhole').show();
		    },
			success: function(data){
				if(data.status == 1){
					setTimeout(function(){ $('div.lodrefrentwhole').hide();}, 2000);
					window.location.href = data.voucher_url; 	  
				}else if(data.status == -1){
					window.location.href = data.signup_login;
				}else if(data.status == -2){
					$('div.lodrefrentwhole').hide();
					inform();
					console.log('There is no enough amount in your account');
				}else if(data.status == 555){
					console.log('Gate');
					window.location.href = data.GateURL;
				}
			}
		});
		return false; 
	}
});

$("#form_pinmap").validate({
	rules: {
		autocomplete: "required",
		city: "required",
		postal_code: "required",
		country: "required"		
	},
	submitHandler: function() {
			
			var action = $("#form_pinmap").attr('action');
			var data= {};
			
			data['listings_city'] = $('#autocomplete').val();
			data['address_line_1'] = $('#address_line_1').val();
			data['address_line_2'] = $('#address_line_2').val();
			data['address_line_3'] = $('#address_line_3').val();
			data['postal_code'] = $('#postal_code').val();			
			data['city'] = $('#locality').val();
			data['country'] = $('#country').val();
			data['edit_listings_pinmap'] = $('#edit_listings_pinmap').val();			
			var latitudec = $('#latitude').val();
			var longitudec = $('#longitude').val();
			$.ajax({
			type: "POST",
			url: action,
			data: data,
			dataType: "json",
			success: function(data){
				$('.lodingpop').fadeIn(500);
				$('#enteradrs').fadeOut(500,function(){
				$('#verifyloc').fadeIn(500,function(){
var myCenter=new google.maps.LatLng(latitudec,longitudec);
					google.maps.event.trigger(map,'resize');
					map.setCenter(myCenter);
				$('.lodingpop').fadeOut(500);
				});
			});
			}
		});			
	}
});

$("#usrSub").validate({

	rules: {
		usrSubscId: "required",
	},

	submitHandler: function() { 
		var action = $("#usrSub").attr('action');
		var subscEmail = $('#usrSubEmail').val();
		
		$.ajax({
			url: action,
			data: {'subEmail': subscEmail},
			method: "POST",
			dataType: "json",
			success: function(r) {
				if(r.status == 1) {
					$('.succNewsLetterSubsc').fadeIn().fadeOut(7000);
				} else {
					$('.failNewsLetterSubsc').fadeIn().fadeOut(7000);
				}
			} 
		})
		return false; 
	}
});

$("#checkNewsLetter").on('click', function() {
	$('.nl_subs_loader').fadeIn();
	var checkStatus = $(this).prop("checked");
	if(checkStatus) {
		setBit = 1;
	} else {
		setBit = 0;
	}

	$.ajax({
		url: WEB_URL+'/users/subscribeUserCheckbox',
		data: {'setbit': setBit},
		method: 'POST',
		success: function(r) {
			$('.nl_subs_loader').hide();
			if(setBit == 1) {
				$('.ns_subd').fadeIn(100).fadeOut(5000);
			} else {
				$('.ns_unsub').fadeIn(100).fadeOut(5000);
			}
		}
	})
});


//Agent Starts From Here

$("#Agentregistration").validate({
	submitHandler: function() { 
		$('#AgntloginLdrReg').show();
		var action = $("#Agentregistration").attr('action');
		var formData = new FormData($("#Agentregistration")[0]);
		$.ajax({
			type: "POST",
			url: action,
			data: formData,
			dataType: "json",
			cache: false,
        	contentType: false,
        	processData: false,
			success: function(data){
				if(data.status == 1){
					$('#AgntloginLdrReg').hide();
					$('#signupfix').fadeOut(500,function(){
			    		//$('#signinfix').fadeOut(500);
			    		$('#agentVerification').fadeIn(500);
						$('#verify_id').val(data.verifyid);
						$('#verify_id_c').val(data.verifyid);
						
			    	});
				}else{
					$('#AgntloginLdrReg').hide();
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
				}
			}
		});
		return false; 
	}
});

$("#AgentResetPassword").validate({
	submitHandler: function() { 
		var action = $("#AgentResetPassword").attr('action');
		var formData = $("#AgentResetPassword").serialize();
		$.ajax({
			type: "POST",
			url: action,
			dataType:"json",
			data: formData,
			beforeSend: function(){
					$('div.popuperror').hide();
					$("#AgntloginLdrReg").show();
			    },
			success: function(data){
				
				$("#AgntloginLdrReg").hide();
				if(data.status == 1){
								$('#forgotpasemail_agent').fadeOut(500,function(){
								$('#signinfix').fadeIn(500);
							});
				}
				else
				{
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
				}
			}
		});
		return false; 
	}
});

$('#AgentVerify').validate({
	submitHandler: function() {
		$('#AgntVeriContact').show();
		var action = $("#AgentVerify").attr('action');
		var veri_email = $('#veri_email').val();
		//var veri_mobile = $('#veri_mobile').val();

		if(veri_email) {
			var ve_t = veri_email.trim();
			//var vm_t = veri_mobile.trim();
		} else {
			var ve_t = "";
			//var vm_t = "";
		}
		if(ve_t.length == 0) {
			return false;
		}

		$.ajax({
			type: "POST",
			url: action,
			data: $('#AgentVerify').serialize(),
			dataType: "JSON",
			success: function(data) {
				$('#AgntVeriContact').hide();
				if(data.status == 1) {
					$('#AgntloginLdrReg').hide();
					window.location.href = WEB_URL+'account/confirm_login';
				} else if(data.status == 0) {
					$('#AgntloginLdrReg').hide();
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
				} else if(data.status == 2) {
					$('#AgntloginLdrReg').hide();
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
				}
			}
		})
	}
})



$("#Agentlogin").validate({
	submitHandler: function() { 
		var action = $("#Agentlogin").attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $("#Agentlogin").serialize(),
			dataType: "json",
			success: function(data){
				if(data.status == 1){
					window.location.href = data.continue;
				} else if(data.status == 2) {
					var curUrl = document.URL; //encode to base64
					//window.location.href = WEB_URL+'/security/verifytwostep?url='+curUrl;
					window.location.href = WEB_URL+'security/verifytwostep/';
				} else{
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
				}
			}
		});
		return false; 
	}
});

$('#cntctAdmin').validate({
	submitHandler: function() {
		var msg = $('#msgId').val();
		if(msg) {
			msg = msg.trim();
		} else {
			return false;
		}		
		var action = $('#cntctAdmin').attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $('#cntctAdmin').serialize(),
			dataType: "json",
			success: function(data) {
				if(data.status == 1) {
					
				//	$('#cntctAgentPopup').modal('toggle');
					
						$('#messageSentPopup').fadeIn(500);	
					
						$('#cntctAgentPopup,#facing_problem').modal('toggle');
					setTimeout(function(){
					//	$('#cntctAgentPopup,#facing_problem').modal('toggle');
					$('#messageSentPopup').fadeOut(500);	
					},5000);
					
					
				}
			}
		})
		return false;
	}
})

$('#addDepositForm').validate({});
$('#promocode').validate({
	submitHandler: function() {
		var action = $('#promocode').attr('action');
		$.ajax({
			type: "GET",
			url: action,
			data: $('#promocode').serialize(),
			dataType: "json",
			success: function(data) {
				$('#code').val('');
				if(data.status == 1) {
					$('.savemessage').html(data.discMsg).show();
					$('div.discount span.amount').html(data.discount);
					$('div.finalAmt span.amount').html(data.finalAmt);
					$('#pcode').val(data.code);
					$('#pcode_d').val(data.discount);
					$('#pcode_f').val(data.finalAmt);
				}else if(data.status == 0) {
					$('.savemessage').html(data.discMsg).show();
				}
			}
		})
		return false;
	}
});

$("#AgentloginReference").validate({
	submitHandler: function() { 
		var action = $("#AgentloginReference").attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $("#AgentloginReference").serialize(),
			dataType: "json",
			success: function(data){
				if(data.status == 1){
					window.location.href = data.continue;
				} else if(data.status == 2) {
					var curUrl = document.URL; //encode to base64
					//window.location.href = WEB_URL+'/security/verifytwostep?url='+curUrl;
					window.location.href = WEB_URL+'/security/verifytwostep/';
				} else{
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
				}
			}
		});
		return false; 
	}
});

$('#ownerReq').validate({
	submitHandler: function() {
		var action = $('#ownerReq').attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $('#ownerReq').serialize(),
			dataType: "json",
			success: function(data) {
				if(data.status == 1 && data.verif == 0) {  //not verified.
					$('#manageListingHandle, #mangelisting').removeClass('active');
					$('#resReqHandle, #resReq').addClass('active');
					$('#resReqHandle').attr("data-toggle", 'tab').children().removeAttr("onclick").css("color", "#2a6496");
					checkOwnerAccVerif()
				} else if(data.status == 1 && data.verif == 1) {  //verified, show the payment tab.
					$('#manageListingHandle, #mangelisting').removeClass('active');
					$('#resReqHandle, #resReq').addClass('active');
					$('#resReqHandle, #paymentHandle').children().removeAttr("onclick").attr("data-toggle", 'tab').css("color", "#2a6496");
					checkOwnerAccVerif();
				}
			}
		})
	}

})

//checkOwnerAccVerif();
function checkOwnerAccVerif() {
	$.ajax({
		url: WEB_URL+'account/checkOwnerAccVerif',
		dataType: "json",
		success: function(r) {
			console.log(r);
			 
			if(r.userVerification == 1) {
				$('.ownCmpltStepUV').addClass("icon-check icontik");
			} else {
				$('.ownCmpltStepUV').addClass("icon-remove icontikx");
			}
			 
		}
	})
}

$('#addBankDetails').validate({
	submitHandler: function() {
		var action = $('#addBankDetails').attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $('#addBankDetails').serialize(),
			dataType: "json",
			success: function(data) {
				if(data.status == 1) {
					$('.msg').show().text('Bank details updated successfully.');
					window.scrollTo(0,0)
					msgHide();
				} else {
					$('.chkVeriLoader').show();
					$('.centerload').hide();
                	$('#verifyMsg').html('You have to verify your email and mobile number in order to create listing owner account. Please <a target="_blank" href="'+WEB_URL+'/dashboard/profile/verifications'+'">Click here to verify');
				}
			}
		})
	}
})


$('#addPaypalDetails').validate({
	submitHandler: function() {
		var action = $('#addPaypalDetails').attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $('#addPaypalDetails').serialize(),
			dataType: "json",
			success: function(data) {
				if(data.status == 1) {
					$('.msg').show().text('Paypal details updated successfully.');
					window.scrollTo(0,0)
					msgHide();
				} else {
					$('.chkVeriLoader').show();
					$('.centerload').hide();
                	$('#verifyMsg').html('You have to verify your email and mobile number in order to create listing owner account. Please <a target="_blank" href="'+WEB_URL+'/dashboard/profile/verifications'+'">Click here to verify');
				}
			}
		})
	}

});


$('#trackTransaction').validate({
	submitHandler: function() {
		$('#loaderTransHist').show();
		var action = $('#trackTransaction').attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $('#trackTransaction').serialize(),
			dataType: "json",
			success: function(data) {
				$('#loaderTransHist').parent().hide();
				$('#transactContainer').html(data.view);
			}
		})
	}

})

//Static Pages
$("#contactus, #feedback").validate();

$("#employeeregistration").validate({
	submitHandler: function() { 
		$('#AgntloginLdrReg').show();
		var action = $("#employeeregistration").attr('action');
		var formData = new FormData($("#employeeregistration")[0]);
		$.ajax({
			type: "POST",
			url: action,
			data: formData,
			dataType: "json",
			cache: false,
        	contentType: false,
        	processData: false,
			success: function(data){
				if(data.status == 1){
					$('#AgntloginLdrReg').hide();
					location.href=data.url;
				}else{
					$('#AgntloginLdrReg').hide();
					$('div.popuperror').html(data.msg);
					$('div.popuperror').show();
				}
			}
		});
		return false; 
	}
});
*/
