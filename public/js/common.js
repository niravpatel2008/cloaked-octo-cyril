function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function openLoginForm()
{
	$("#divCreateAccountForm").modal('hide');
	$("#divForgotPasswordForm").modal('hide');
    $('#divConsLogin').modal();
}

function openSignupForm()
{
	$('#divConsLogin').modal('hide');
	$("#divForgotPasswordForm").modal('hide');
    $("#divCreateAccountForm").modal();
}

function openForgotPasswordForm () {
	$('#divConsLogin').modal('hide');
	$("#divCreateAccountForm").modal('hide');
    $("#divForgotPasswordForm").modal();
}
$(document).ready(function(){

$("#loginform").validationEngine();
$("#loginform").on('submit', function (e) {
	e.preventDefault();
		var url =  base_url()+'welcome/login';
		var data =  $("#loginform").serialize();
		$.post(url,data,function(e){
			if(e == 'success'){
				location.reload();
			}else{
				alert(data);
				return false;
			}
		});
	});

$("#signupform").validationEngine();
	$("#signupform").on('submit', function (e) {
		e.preventDefault();
	var url = base_url()+'welcome/signup';
	var data = $("#signupform").serialize();
	
		$.post(url,data,function(e){
				if(e == 'success'){
					location.reload();
				}else{
					alert(data);
					return false;
				}
			});
	});

	$("#forgotpwdform").validationEngine();
	$("#forgotpwdform").on('submit', function (e) {
		e.preventDefault();
		var url = base_url()+'welcome/forgotpassword';
		var data = $("#forgotpwdform").serialize();
		$.post(url,data,function(e){
				if(e == 'success'){
					alert("Email has been sent to your email.");
					$('#divForgotPasswordForm').modal('toggle');
				}else{
					alert(data);
					return false;
				}
			});
	});

	$('.allow-enter').keydown(function(e){
		 if (e.which == 13) {
			var $targ = $(e.target).closest("form");
			$targ.find(".sumitbtn").focus();
		}	
	})
});