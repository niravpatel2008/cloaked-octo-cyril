<div id="footer">
  <div class="container">
    <p class="text-muted credit"><a target="_blank" href="<?=base_url();?>contactus">CONTACT US</a> | <a href="<?=base_url();?>aboutus">ABOUT US</a>
    <span class="pull-right">
        <a target="_blank" href="http://twitter.com/" title="Follow updates"><i class="fa fa-twitter fa-lg"></i></a>
        |
        <a target="_blank" href="https://facebook.com" title="Get the source of this site"><i class="fa fa-facebook fa-lg"></i></a>
    </span>
    </p>

  </div>
</div>

</body>

<?php if(in_array($this->router->fetch_class(),array('welcome'))) {?>
<script type="text/javascript" src="<?=public_path()?>js/index.js" charset="utf-8"></script>
<?php }?>

<?php if(in_array($this->router->fetch_class(),array('profile')) && $this->router->fetch_method()=='mystamp') {?>
<script type="text/javascript" src="<?=public_path()?>js/index.js" charset="utf-8"></script>
<?php }?>

<?php if(in_array($this->router->fetch_class(),array('profile'))) { ?>
	<link rel="stylesheet" href="<?=public_path()?>css/daterangepicker/datepicker.css">
	<script src="<?=public_path()?>js/plugins/daterangepicker/bootstrap-datepicker.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?=public_path()?>js/profile.js" charset="utf-8"></script>
	
	<?php } 
	if (in_array($this->router->fetch_method(), array("add","edit"))) { ?>
		<link href="<?=public_path()?>css/tagedit/jquery.tagedit.css" rel="stylesheet" type="text/css" />
		<script src="<?=public_path()?>js/jquery-ui-1.10.3.js" type="text/javascript"></script>
		<script src="<?=public_path()?>js/plugins/validation/btvalidationEngine.js" type="text/javascript"></script>
		<script src="<?=public_path()?>js/plugins/validation/btvalidationEngine-en.js" type="text/javascript"></script>
		<script src="<?=public_path()?>js/userstamp/<?=$this->router->fetch_class()?>/add_edit.js" type="text/javascript"></script>
		<script src="<?=public_path()?>js/plugins/tagedit/jquery.autoGrowInput.js" type="text/javascript"></script>
		<script src="<?=public_path()?>js/plugins/tagedit/jquery.tagedit.js" type="text/javascript"></script>
		<script src="<?=public_path()?>js/plugins/dropzone/dropzone.js" type="text/javascript"></script>
	<?php }
	
	if(in_array($this->router->fetch_class(),array('album'))) { ?>
		<script src="<?=public_path()?>js/plugins/imageCrop/imagecrop.js" type="text/javascript"></script>
	<?php }?>

<script src="http://www.laravel-tricks.com/js/vendor/masonry.pkgd.min.js"></script>
<script type="text/javascript">
	$(function(){$container=$(".js-trick-container");$container.masonry({gutter:0,itemSelector:".trick-card",columnWidth:".trick-card"});$(".js-goto-trick a").click(function(e){e.stopPropagation()});$(".js-goto-trick").click(function(e){e.preventDefault();var t="http://www.laravel-tricks.com/tricks";var n=$(this).data("slug");window.location=t+"/"+n})})
</script>