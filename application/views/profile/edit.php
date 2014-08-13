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
			//	echo '<pre>';print_r($userinfo[0]);die;
		?>
	</div>

	<div class="box">
		<form action="" method="post" enctype="multipart/form-data">
		<div class="box-body">
				<div class='form-group'>
					<label for="username">Name: </label> 
					<input class='form-control' type="text" name="username" id="username" value="<?=$this->front_session['uname']?>">
				</div>
				<div class='form-group'>
					<label for="username">Email: </label> 
					<input class='form-control' type="text" name="email" id="email" value="<?=$this->front_session['email']?>" disabled>
				</div>
				<div class='form-group'>
					<label for="username">Contact: </label> 
					<input class='form-control' type="text" name="contact" id="contact" value="<?=$this->front_session['contact']?>">
				</div>
				<div class='form-group'>
					<label for="username">Gender </label> 
					<input class='form-control' type="radio" name="gender" id="gender_m" value="m"> Male
					<input class='form-control' type="radio" name="gender" id="gender_f" value="f"> Female
				</div>
				<div class='form-group'>
					<label for="username">Country: </label> 
					<input class='form-control' type="text" name="country" id="country" value="<?=$this->front_session['contact']?>">
				</div>
				<div class='form-group'>
					<label for="username">State: </label> 
					<input class='form-control' type="text" name="state" id="state" value="<?=$this->front_session['contact']?>">
				</div>
				<div class='form-group'>
					<label for="username">City: </label> 
					<input class='form-control' type="text" name="city" id="city" value="<?=$this->front_session['contact']?>">
				</div>
		</div>
		<div class='box-footer'>
			<input type="submit" name="submit" id="submit" value="Submit" class="input button primary" style="width:150px;" />
		</div>
		</form>
	</div>
</div>