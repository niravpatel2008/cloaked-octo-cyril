<div class='stripe-regular items-carousel-wrap row'>
	<div class="box box-site-header">
		<div class="box-header">
			<h3 class="box-title"><i class="fa fa-credit-card"></i> Edit Profile</h3>
		</div>
	</div>

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

	<div class="box">
		<form action="" method="post" enctype="multipart/form-data">
		<div class="box-body">
				<div class='form-group'>
					<label for="username">Name: </label> 
					<input class='form-control' type="text" name="name" id="name" value="<?=$this->front_session['u_fname']?>">
				</div>
				<div class='form-group'>
					<label for="username">Email: </label> 
					<input class='form-control' type="text" name="email" id="email" value="<?=$userinfo[0]->u_email;?>" readonly>
				</div>
				<div class='form-group'>
					<label for="username">Contact: </label> 
					<input class='form-control' type="text" name="contact" id="contact" value="<?=$userinfo[0]->u_phone;?>">
				</div>
				<div class='form-group'>
					<label for="username">Gender </label> 
					<input class='form-control' type="radio" name="gender" id="gender_m" value="m" <?php if($check == 'm') echo 'checked';?>> Male
					<input class='form-control' type="radio" name="gender" id="gender_f" value="f" <?php if($check == 'f') echo 'checked'?>> Female
				</div>
				<div class='form-group'>
					<label for="username">Country: </label> 
					<input class='form-control' type="text" name="country" id="country" value="<?=$userinfo[0]->u_country;?>">
				</div>
				<div class='form-group'>
					<label for="username">State: </label> 
					<input class='form-control' type="text" name="state" id="state" value="<?=$userinfo[0]->u_state;?>">
				</div>
				<div class='form-group'>
					<label for="username">City: </label> 
					<input class='form-control' type="text" name="city" id="city" value="<?=$userinfo[0]->u_city;?>">
				</div>
		</div>
		<div class='box-footer'>
			<input type="submit" name="submit" id="submit" value="Submit" class="input button primary" style="width:150px;" />
		</div>
		</form>
	</div>
</div>