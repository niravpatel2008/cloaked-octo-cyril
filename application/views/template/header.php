<!DOCTYPE HTML>
<html>
<head>
    <title>Stamp</title>
    <link href="<?php echo public_path();?>css/style.css" rel='stylesheet' type='text/css' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?=public_path()?>images/fav-icon.png" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- webfonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!-- //webfonts -->
    <!-- Global CSS for the page and tiles -->
    
	<link rel="stylesheet" href="<?=public_path()?>css/bootstrap.css">
	<link rel="stylesheet" href="<?=public_path()?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=public_path()?>css/btvalidation.css">
	<link rel="stylesheet" href="<?=public_path()?>css/main_new.css">
	<?php if(in_array($this->router->fetch_class(),array('profile','userstamp','album'))){?>

		<link rel="stylesheet" href="<?=public_path()?>css/styleProfile.css">
		<link rel="stylesheet" href="<?=public_path()?>css/BOOTSTRAP_RESET.css">
	<?php } ?>

	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <!-- //Global CSS for the page and tiles -->
    <!-- start-click-drop-down-menu -->
    <script src="<?=public_path()?>js/jquery-2.1.1.min.js"></script>
	<script src="<?=public_path()?>js/bootstrap.min.js"></script>
	<script src="<?=public_path()?>js/btvalidation.js"></script>
	<script src="<?=public_path()?>js/btvalidation.min.js"></script>
	<script src="<?=public_path()?>js/common.js"></script>


    <!-- start-dropdown -->
    <script type="text/javascript">
    /*var $ = jQuery.noConflict();
    $(function() {
    $('#activator').click(function(){
    $('#box').animate({'top':'0px'},500);
    });
    $('#boxclose').click(function(){
    $('#box').animate({'top':'-700px'},500);
    });
    });
    $(document).ready(function(){
    //Hide (Collapse) the toggle containers on load
    $(".toggle_container").hide();
    //Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
    $(".trigger").click(function(){
    $(this).toggleClass("active").next().slideToggle("slow");
    return false; //Prevent the browser jump to the link anchor
    });

    });*/
    </script>
    <!-- //End-dropdown -->
    <!-- //End-click-drop-down-menu -->
	<script type="text/javascript">
      function base_url () {
          return '<?=base_url()?>';
      }
    </script>
</head>

<body>

<div id="wrap">
	<div class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".header-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<a class="navbar-brand" href="<?=base_url()?>">
					<img width="207" height="50" src="<?=public_path()?>images/logo.jpg">
				</a>
			</div>

			<div class="collapse navbar-collapse header-collapse">

				<ul class="nav navbar-nav">
					<li class="active"><a href="<?=base_url()?>">Home</a></li>
					<li><a href="#">Album</a></li>
					<li><a href="<?=base_url()?>contactus">Contact Us</a></li>
					<li><a href="<?=base_url()?>aboutus">About Us</a></li>
					<?php if($this->front_session['id'] > 0) { ?>
						<li class="visible-xs"><a href="<?=base_url()?>profile/">Profile</a></li>
						<li class="visible-xs"><a href="<?=base_url()?>profile/change_password" >Change Password</a></li>
						<li class="visible-xs"><a href="<?=base_url()?>profile/logout" >Log Out</a></li>
					<?php }else{ ?>
						<li class="visible-xs"><a href="javascript:void(0);" onclick="openSignupForm();">Register</a></li>
						<li class="visible-xs"><a href="javascript:void(0);" onclick="openLoginForm();" >Login</a></li>
					<?php }?>
				</ul>
				
				<?php if($this->front_session['id'] > 0) { ?>
					<div class="navbar-right hidden-xs">
						<ul class="nav">
							<li class="dropdown ">
								<a data-toggle="dropdown" class="dropdown-toggle btn btn-primary" href="#">
									Welcome <?=$this->front_session['u_fname']?>
									<b class="caret"></b>
								 </a>
								<ul class="dropdown-menu">
									<li class=""><a href="<?=base_url()?>profile/">Profile</a></li>
									<li class=""><a href="<?=base_url()?>profile/change_password">Change Password</a></li>
									<li><a href="<?=base_url()?>profile/logout">Logout</a></li>
								</ul>
							</li>
						</ul>
					</div>
				<?php }else{ ?>

				<div class="navbar-right hidden-xs">
					<a href="javascript:void(0);" class="btn btn-primary" onclick="openSignupForm();">Register</a>
					<a href="javascript:void(0);" class="btn btn-primary" onclick="openLoginForm();" >Login</a>
				</div>
				<?php }?>
			</div>
			
		</div>
	</div>
	<?=$this->load->view('/initial');?>
