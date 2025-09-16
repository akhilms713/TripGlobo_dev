$(document).ready(function() {
/*
* 
*/
	$('.sms_alert').on('click', function() {
		var curEle = $(this);
		var id = $(this).data('alert_id');
   		$(this).parent().siblings('.smsAlrtLdr').fadeIn();
		if(id) {
			_id = id.toString().trim();
		}
		
		if(_id.toString().length > 0 && !isNaN(_id)) {
			$.ajax({
				url: WEB_URL+'/verification/changeSMSalertstatus',
				data: {alert_id: _id},
				method: "POST",
				success: function(r) {
					$('.smsAlrtLdr').fadeOut();
				}
			});
		} else {
			
		}

	});

/*	$('#cancelAccount').on('click', function(e) {
		e.preventDefault();
		
		$('.fullquestionswrp4').provabPopup({
					modalClose: true, 
					zIndex: 100005
		});
	});

	$('.addNewLength').on('click', function(e) {
		e.preventDefault();
		
		$('.fullquestionswrp4').provabPopup({
					modalClose: true, 
					zIndex: 100005
		});
	});

	$('#hideCancelPopup').on('click', function(e) {
		e.preventDefault();
		$('.fullquestionswrp4').provabPopup().close();
	});*/
	
	
	

	$('#startCancelProc').on('click', function(e) { 
		e.preventDefault(); 
//		showLoader();
		chkTwoStp();
	});

	$('#verifyPswd').on('click', function(e) {
		e.preventDefault();
		
		var pswd = $('#twoStepCode').val();
		if(pswd) {
			pswd = pswd.trim();
		}
		if(pswd.length > 0) {
			showLoader();
			verifyTwoStepPswd(pswd);			
		} else {
			$('#verificationCodeErr').text('Please enter the code.');
		}
	})

	$('#verifyOneStepPswd').on('click', function(e) {
		e.preventDefault();
		var pswd = $('#oneStepCode').val();
		if(pswd) {
			pswd = pswd.trim();
		}
		if(pswd.length > 0) {
			verifyOneStepPswd(pswd);
		}
		else
		{
			$("#popuperror_verifyOneStepPswd").show();
		}
	})

	$("#add_markup").validate({
		rules: {
		    field: {
		      	required: true,
		      	number: true
		    }
		 },		
		submitHandler: function() { 
			$('#addMarkUpLoader').show();
			var action = $("#add_markup").attr('action');
			$.ajax({
				type: "POST",
				url: action,
				data: $("#add_markup").serialize(),
				dataType: "json",
				success: function(data){
					$('#addMarkUpLoader').hide();
					$('.msg').show();
					$('.msg').text('Mark up updated successfully.');
					// $('.fullquestionswrp5').slideToggle(500);
					location.reload();
				}
			});
			return false; 
		}
	});

});

function chkTwoStp() { 
	$.ajax({
		url: WEB_URL+'security/cancelAccountVerificationChk',
		data: {'ajaxRequest': '1'},
		method: "POST",
		dataType: "json",
		success: function(r) {
			if(r){
				if(r.status == 1 && r.enabled == 1 && r.ver == 1) {  //enabled case: email
					verifyTwoStp(1);
				} else if(r.status == 1 && r.enabled == 1 && r.ver == 2) {   //enabled case: mobile
					verifyTwoStp(2);
				} else {
					checkPswrdAvail();
					 
				}
			}
		}
	})
}

function verifyTwoStp(verifyType) {

	if(verifyType == 1) {
		$('#typeString').text('email id');
	} else if(verifyType == 2) {
		$('#typeString').text('contact number');
	}
	$.ajax({
		url: WEB_URL+'security/cancelAccountSendCode',
		data: {'ver': verifyType},
		method: "POST",
		success: function(r) {
			hideLoader();
			showTwoStepPop();
		}
	});
}

function checkPswrdAvail() {
	$.ajax({
		url: WEB_URL+'security/checkPswrdAvail',
		dataType: "json",
		success: function(r) {
			if(r.status == 1 && r.pswrdAvail == 1 && r.emailVerified == 2) {
				verifyOneStp();  //use regular password to deactivate
			} else if(r.status == 0 && r.pswrdAvail == 0 && r.emailVerified == 1) {
				verifyTwoStp(1);
			} else if(r.status == 0 && r.pswrdAvail == 0 && r.emailVerified == 0) {
				window.location.href = WEB_URL+'dashboard/profile/verifications';
			}
		}
	});
}

function verifyOneStp() {
	hideLoader();
	showOneStepPop();
}

function showTwoStepPop() {
	$('.fullquestionswrp4').provabPopup().close();
	$('#cancel2stepVerify').provabPopup({
				modalClose: false,
				zIndex: 100005
	});	
}

function showOneStepPop() {
	$('.fullquestionswrp4').provabPopup().close();
	$('#cancelLoginPswd').provabPopup({
				modalClose: false,
				zIndex: 100005
	});	
}

function verifyTwoStepPswd(pswd) {
	$.ajax({
		url: WEB_URL+'security/cancelAccountVerifyPswd',
		data: {'twoStepPwd': pswd},
		method: "POST",
		dataType: "json",
		success: function(r) {
			if(r) {
				if(r.status == 1) {
					cancelAccountData();
				} else {
					hideLoader();
					$('#verificationCodeErr').text('Verification code entered is wrong. Please try again.');
				}
			}
		}
	})
}

function verifyOneStepPswd(pswd) {
	$.ajax({
		url: WEB_URL+'security/cancelAccountOneStepVerifyPswd',
		data: {'oneStepPwd': pswd},
		method: "POST",
		dataType: "json",
		success: function(r) {
			if(r.status == 1) {
				window.location.href = WEB_URL+'security/cancel_account_success';
			}
			else
			{
				$('#popuperror_verifyOneStepPswd').show();
				$('#popuperror_verifyOneStepPswd').html(r.msg);
			}
		}
	})
}

function cancelAccountData() {
	$.ajax({
		url: WEB_URL+'security/cancelAccountData',
		dataType: 'json',
		success: function(r) {
			hideLoader();
			if(r.status == 1) {
				window.location.href = WEB_URL+'security/cancel_account_success';
			}
			else
			{
				$('#popuperror_verifyOneStepPswd').show();
				$('#popuperror_verifyOneStepPswd').html(r.msg);
			}
		}
	});
}

function showLoader() {
	$('#showLoader').provabPopup({
				modalClose: false,
				zIndex: 100005
	});	
}

function hideLoader() {
	$('#showLoader').provabPopup().close();
}