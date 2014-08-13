<div class="header">
    <div class="wrap">
        <div class="logo">
            <a href="index.html"><img title="pinbal" src="<?=public_path()?>images/logo.png"></a>
        </div>
        <div class="nav-icon">
             <a id="activator" class="right_bt" href="#"><span> </span> </a>
        </div>
         <div id="box" class="box">
             <div class="box_content">
                <div class="box_content_center">
                    <div class="form_content">
                        <div class="menu_box_list">
                            <ul>
                                <li><a href="#"><span>home</span></a></li>
                                <li><a href="#"><span>About</span></a></li>
                                <li><a href="#"><span>Works</span></a></li>
                                <li><a href="#"><span>Clients</span></a></li>
                                <li><a href="#"><span>Blog</span></a></li>
                                <li><a href="contact.html"><span>Contact</span></a></li>
                                <div class="clear"> </div>
                            </ul>
                        </div>
                        <a id="boxclose" class="boxclose"> <span> </span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="top-searchbar">
            <form>
                <input type="text"><input type="submit" value="">
            </form>
        </div>
        <div class="userinfo">
            <div class="user">
			<?php 
					if($this->front_session['id'] > 0) {
				?>
					<button data-toggle="dropdown" class="input button tertiary"><?=$this->front_session['uname']?></button>
					<ul class="dropdown-menu pull-right" style='text-align:left;' role="menu">
						<li><a href="<?=base_url()?>profile/edit">Edit Profile</a></li>
						<li><a href="<?=base_url()?>profile/change_password">Change password</a></li>
						<li><a href="<?=base_url()?>profile/logout">Log out</a></li>
					</ul>
				  <?php
					}else{
				  ?>
                <ul>
					<li>
						 <a class="input button blue tertiary icon plus" href="javascript:void(0)" onclick="openSignupForm();" >Sign up</a>
                        <a class="input button transparent tertiary" href="javascript:void(0)" onclick="openLoginForm();" >Sign in</a>
					</li>
						<li><a href="<?=base_url()?>profile/edit">Edit Profile</a></li>
						<li><a href="<?=base_url()?>profile/change_password">Change password</a></li>
						<li><a href="<?=base_url()?>profile/logout">Log out</a></li>
                </ul><?php }?>
            </div>
        </div>
        <div class="clear"> </div>
    </div>
</div>
