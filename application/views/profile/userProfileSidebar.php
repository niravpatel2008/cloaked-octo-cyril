<aside class="profile-nav col-lg-3">
  <section class="panel">
	  <div class="user-heading round">
		<?php
			if(isset($this->front_session['u_photo']) && $this->front_session['u_photo'] != '')
				$uphoto = $this->front_session['u_photo'];
			else
				$uphoto = 'nophoto.jpg';
		?>
		  <a href="#">
			<img id="imgUserPhoto" alt="Profile Pic" imgname="<?=$uphoto?>" src="<?=base_url().UPLOADPATH.$uphoto;?>">
		</a>
		
		 <span id="changePic"><a href="#" data-target="#dlgProfilePic" data-toggle="modal" style="color:#fff;">Change Picture</a></span>
		  <h1><?= ucwords($this->front_session['u_fname'].' '.$this->front_session['u_lname']);?></h1>
		  <p><?=$this->front_session['u_email'];?></p>
		  <p><a href="<?=$this->front_session['u_url'];?>" style="" id="myurlLink">View My Website</a></p>
	  </div>

	  <ul class="nav nav-pills nav-stacked">
		  <li class="active"><a href="<?=base_url()?>profile"> <i class="fa fa-user"></i> Profile View</a></li>
		  <li><a href="<?=base_url()?>profile/edit"> <i class="fa fa-edit"></i>Edit Profile</a></li>
		  <li><a href="<?=base_url()?>profile/change_password"> <i class="fa fa-edit"></i>Change Password</a></li>
		  <li><a href="#"> <i class="fa fa-calendar"></i>Album</a></li>
		  <li><a href="#"> <i class="fa fa-calendar"></i> Stamps</a></li>
	  </ul>

  </section>
</aside>
<div id="dlgProfilePic" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:#ff766c;">		
				<button class="close" aria-hidden="true" data-dismiss="modal" type="button">�</button>
				<h3 class="modal-title"><i class="fa fa-shopping-cart"></i> Upload Photo :</h3>
			</div>
			<div class="modal-body">
				<div>
				<form id="frmAddPhoto" method="post" enctype="multipart/form-data" action="<?=base_url()?>profile/fileupload">
						<input type="hidden" id="hdnOldPhoto" name="hdnOldPhoto" value="" />
						<input type="file" id="profile_photo" name="profile_photo" style="" />
						<button type="submit" class="btn btn-primary btn-login" style="margin-top:10px !important;" id="btnPhotoSubmit">Add</button>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>