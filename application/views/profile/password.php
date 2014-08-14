<div class='stripe-regular items-carousel-wrap row'>
	<div class="box box-site-header">
		<div class="box-header">
			<h3 class="box-title"><i class="fa fa-cogs"></i> Change Password</h3>
		</div>
	</div>
	<div id="flash_msg">
		<?php
			if (@$flash_msg['flash_type'] == "success") {
				echo @$flash_msg['flash_msg'];
			}

			if (@$flash_msg['flash_type'] == "error") {
				echo @$flash_msg['flash_msg'];
			}
		?>
	</div>
	<div class="box">
		<form name="frmChangePwd" method="post" id="frmChangePwd">
		<div class="box-body">
				<div class='form-group'>
					<label for="username">New Password: </label>
					<input class='form-control validate[required]' type="password" name="password" id="change_password" value="">
					<?=@$error_msg['password']?>
				</div>
				<div class='form-group'>
					<label for="username">Repeat Password: </label>
					<input class='form-control validate[required,equals[change_password]]' type="password" name="re_password" id="re_password" value="">
					<?=@$error_msg['re_password']?>
				</div>
		</div>
		<div class='box-footer'>
			<input type="submit" name="pwd_submit" id="pwd_submit" value="Submit" class="input button primary" style="width:150px;" />
		</div>
		</form>
	</div>
</div>
