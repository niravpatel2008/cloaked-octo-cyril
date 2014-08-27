<!--login popup -->
<div id="divConsLogin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
	<div class="col-lg-4 col-lg-push-4 col-md-6 col-md-push-3 col-sm-8 col-sm-push-2" style="margin-top:20px;">
		<div class="content-box login-form">
			<h1 class="page-title">Login</h1>
			<div id="divConsumerError" class="errorMsg"></div>

			<form method="POST" name="loginform" id="loginform" accept-charset="UTF-8">
				<div class="form-group">
					<label for="username" class="control-label">Username</label>
					<input class="validate[required,custom[email]] form-control" placeholder="Username..." name="txtuseremail" type="text" id="txtuseremail">
				</div>
				<div class="form-group">
					<label for="password" class="control-label">Password</label>
					<input class="validate[required] form-control" placeholder="Password..." name="txtpassword" type="txtpassword" value="" id="txtpassword">
				</div>
					
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-login">Login</button>
				</div>
			</form>
			<ul class="nav nav-list">
				<li class="text-center"><a id="achConsForgot" href="javascript:openForgotPasswordForm();"> Forgot your password? </a></li>
				<li class="text-center"><a id="userregister" href="javascript:openSignupForm();"> Don't have an account yet? </a></li>
			</ul>
		</div>
	</div>
</div>


<!--login popup end -->

<!--signup popup -->

<div id="divCreateAccountForm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
	<div class="col-lg-4 col-lg-push-4 col-md-6 col-md-push-3 col-sm-8 col-sm-push-2" style="margin-top:20px;">
		<div class="content-box register-form">
			<h1 class="page-title">Registration</h1>
			<form name="signupform" id="signupform" method="post" accept-charset="UTF-8">
				<div class="form-group">
					<label for="username" class="control-label">Name</label>
					<input class="validate[required] form-control" name='name' id='name' placeholder="Name" type="text">
				</div>
				<div class="form-group">
					<label for="email" class="control-label">E-mail</label>
					<input class="validate[required,custom[email]] form-control" placeholder="E-mail" name="email" type="text" id="email">
				</div>
				<div class="form-group">
					<label for="password" class="control-label">Password</label>
					<input class="validate[required] form-control" placeholder="Password" name="password" type="password" value="" id="password">
				</div>
				<div class="form-group">
					<label for="password_confirmation" class="control-label">Confirm Password</label>
					<input class="validate[required,equals[password]] form-control" placeholder="Confirm Password" name="password2" type="password" value="" id="password2">
				</div>
				<div class="form-group">
					<button type="submit" id="signup" class="btn btn-primary btn-block btn-login">Register</button>
					<button type="reset" name="csbtnClear" id="csbtnClear" onclick="javascript:$('#divCreateAccountForm').modal('toggle');" class="btn btn-primary btn-block btn-login">Cancel</button>
				</div>
				<div class="clearboth" style="height:10px"></div>
			</form>
		</div>
	</div>
</div>

<!--signup popup end -->


<!--forgot password popup -->
<div id="divForgotPasswordForm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
 <div class="col-lg-4 col-lg-push-4 col-md-6 col-md-push-3 col-sm-8 col-sm-push-2" style="margin-top:20px;">
	<div class="content-box login-form">
		<h1 class="page-title">Forgot password</h1>
		<form method="POST" name="forgotpwdform" id="forgotpwdform" accept-charset="UTF-8">							<div class="form-group">
				<label for="email" class="control-label">Email</label>
				<input class="form-control validate[required,custom[email]]" placeholder="E-mail to send password reminder..." name="txtemail" type="text" id="txtemail">
			</div>
			<div class="form-group">
				<button type="submit" name="forgotpassword" id="forgotpassword" class="btn btn-primary btn-block btn-login">Submit</button>
				<button type="reset"  onclick="javascript:$('#divForgotPasswordForm').modal('toggle');" class="btn btn-primary btn-block btn-login">Cancel</button>
			</div>
		</form>
	</div>
</div>
</div>

<!--forgot password popup end -->
