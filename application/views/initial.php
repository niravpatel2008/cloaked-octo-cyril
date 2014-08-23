<!--login popup -->
<div id="divConsLogin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
  <div class="modal-dialog">
    <div class="modal-content property_details">
       <div class="modal-header"> Welcome </div>
		<div id="divConsumerError" class="errorMsg"></div>
        <form name="loginform" id="loginform" method="post">
          <div class="row">
            <div class="" style='padding:15px;'>
              <input type="text" class="validate[required,custom[email]] input field primary allow-enter" name='txtuseremail' id='txtuseremail' placeholder="Email address">
			</div>
          </div>

          <div class="row">
            <div class="" style='padding:15px;'>
              <input type="password" class="validate[required] input field primary allow-enter" name='txtpassword' id='txtpassword' placeholder="Password">

            </div>
          </div>

            <div style="padding-top:10px;text-align:center;" class='row'>
      			  <input type="submit" name="signin" id="signin" value="Sign in" class="sumitbtn input button primary" style='width: 33.3333%;display:inline-block;' />
      			  <input type="button" name="csbtnClear" id="csbtnClear" onclick="javascript:$('#divConsLogin').modal('toggle');" value="Cancel" class="input button primary" style='width: 33.3333%;display:inline-block;' />
            </div>

          <div class="row" style='text-align:center;'>
            <a id="userregister" href="javascript:openSignupForm();"> Create Account </a> | <a id="achConsForgot" href="javascript:openForgotPasswordForm();"> Forgot your password? </a>
          </div>
          <div class="clearboth" style="height:10px"></div>
        </form>
      </div>
    </div>

</div>
<!--login popup end -->

<!--signup popup -->
<div id="divCreateAccountForm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
  <div class="modal-dialog">
    <div class="modal-content property_details">
       <div class="modal-header"> Signup </div>
        <form name="signupform" id="signupform" method="post">
          <div class="row">
            <div class="" style='padding:15px;'>
              <input type="text" class="validate[required] input field primary allow-enter" name='name' id='name' placeholder="Name">
            </div>
          </div>
		  <div class="row">
            <div class="" style='padding:15px;'>
              <input type="text" class="validate[required,custom[email]] input field primary allow-enter" name='email' id='email' placeholder="Email">
            </div>
          </div>
          <div class="row">
            <div class="" style='padding:15px;'>
              <input type="password" class="validate[required] input field primary allow-enter" name='password' id='password' placeholder="Password">
            </div>
          </div>
          <div class="row">
            <div class="" style='padding:15px;'>
              <input type="password" class="validate[required,equals[password]] input field primary allow-enter" name='password2' id='password2' placeholder="Confirm password">
            </div>
          </div>

          <div style="padding-top:10px;text-align:center;" class='row'>
            <input type="submit" name="signup" id="signup" value="Submit" class="sumitbtn input button primary" style='width: 33.3333%;display:inline-block;' />
            <input type="button" name="csbtnClear" id="csbtnClear" onclick="javascript:$('#divCreateAccountForm').modal('toggle');" value="Cancel" class="input button primary" style='width: 33.3333%;display:inline-block;' />
          </div>
          <div class="clearboth" style="height:10px"></div>
        </form>
    </div>
  </div>
</div>
<!--signup popup end -->


<!--forgot password popup -->
<div id="divForgotPasswordForm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
  <div class="modal-dialog">
    <div class="modal-content property_details">
      <div class="modal-header"> Forgot Password </div>
      <form name="forgotpwdform" id="forgotpwdform" method="post">
        <div class="row">
          <div class="" style='padding:15px;'>
            <input type="text" class="validate[required,custom[email]] input field primary" name='txtemail' id='txtemail' placeholder="Email">
          </div>
        </div>

        <div style="padding-top:10px;text-align:center;" class='row'>
          <input type="submit" name="forgotpassword" id="forgotpassword" value="Submit" class="sumitbtn input button primary" style='width: 33.3333%;display:inline-block;' />
          <input type="button" onclick="javascript:$('#divForgotPasswordForm').modal('toggle');" value="Cancel" class="input button primary" style='width: 33.3333%;display:inline-block;' />
        </div>
        <div class="clearboth" style="height:10px"></div>
      </form>
    </div>
  </div>
</div>
<!--forgot password popup end -->
