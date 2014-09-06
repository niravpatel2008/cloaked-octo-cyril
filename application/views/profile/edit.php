<div class="col-md-6 col-md-push-3 col-sm-8 col-sm-push-2" style="margin-top:20px;">
		<div class="content-box register-form">
			<h1 class="page-title">Edit Profile</h1>
			<div id="flash_msg">
			<?php
				if (@$flash_msg['flash_type'] == "success") {
					echo $flash_msg['flash_msg'];
				}

				if (@$flash_msg['flash_type'] == "error") {
					echo $flash_msg['flash_msg'];
				}
				//echo '<pre>';print_r($userinfo);die;
				$check = $userinfo[0]->u_gender;
			?>
		</div>

		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="username" class="control-label">Name: </label> 
				<input class='form-control' type="text" name="name" id="name" value="<?=$this->front_session['u_fname']?>">
			</div>
			<div class='form-group'>
				<label for="email" class="control-label" title="Email Can't be Edit">Email: </label> 
				<input class='form-control' type="text" name="email" id="email" value="<?=$userinfo[0]->u_email;?>" readonly title="Email Can't be Edit">
			</div>
			<div class='form-group'>
				<label for="contact" class="control-label">Contact: </label> 
				<input class='form-control' type="text" name="contact" id="contact" value="<?=$userinfo[0]->u_phone;?>">
			</div>
			<div class='form-group'>
				<label for="gender" class="control-label" style="width:100%">Gender </label> 
				<input class='' type="radio" name="gender" id="gender_m" value="m" <?php if($check == 'm') echo 'checked';?>> Male
				<input class='' type="radio" name="gender" id="gender_f" value="f" <?php if($check == 'f') echo 'checked'?>> Female
			</div>
			<div class='form-group'>
				<label for="country" class="control-label">Country: </label> 
				<input class='form-control' type="text" name="country" id="country" value="<?=$userinfo[0]->u_country;?>">
			</div>
			<div class='form-group'>
				<label for="state" class="control-label">State: </label> 
				<input class='form-control' type="text" name="state" id="state" value="<?=$userinfo[0]->u_state;?>">
			</div>
			<div class='form-group'>
				<label for="city" class="control-label">City: </label> 
				<input class='form-control' type="text" name="city" id="city" value="<?=$userinfo[0]->u_city;?>">
			</div>
			<div class="form-group">
				<button type="submit" name="submit" id="submit"  class="btn btn-primary btn-block btn-login">Submit</button>
			</div>
			<div class="clearboth" style="height:10px"></div>
		</form>
	</div>
</div>


					