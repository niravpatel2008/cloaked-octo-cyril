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
    <link rel="stylesheet" href="<?=public_path()?>css/main.css">
	<link rel="stylesheet" href="<?=public_path()?>css/bootstrap.css">
	<link rel="stylesheet" href="<?=public_path()?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=public_path()?>css/bootstrap-responsive.css">
	<link rel="stylesheet" href="<?=public_path()?>css/bootstrap-responsive.min.css">
	<link rel="stylesheet" href="<?=public_path()?>css/btvalidation.css">
    <!-- //Global CSS for the page and tiles -->
    <!-- start-click-drop-down-menu -->
    <script src="<?=public_path()?>js/jquery-2.1.1.min.js"></script>
	<script src="<?=public_path()?>js/bootstrap.min.js"></script>
	<script src="<?=public_path()?>js/btvalidation.js"></script>
	<script src="<?=public_path()?>js/btvalidation.min.js"></script>
	<script src="<?=public_path()?>js/common.js"></script>
    <!-- start-dropdown -->
    <script type="text/javascript">
    var $ = jQuery.noConflict();
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

    });
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
<?=$this->load->view('/initial');?>