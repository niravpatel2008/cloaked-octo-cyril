<div class="row push-down">
		<div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
			<h1 class="page-title">Stamps</h1>
			<h2 class="page-title" style="margin: 0px auto; float: right;" >
				<a href="javascript:void(0);" <?php if($this->front_session['id'] > 0) {}else{?>onclick="openLoginForm();" <?php }?>>Share Your Stamps With Us</a>
			</h2>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
			<form method="GET" action="<?=base_url();?>" accept-charset="UTF-8" id="frmSearch">
				<input type="text" id="txtSearch" name="search" class="search-box form-control" placeholder="Search..." value="<?=$searchKeyword;?>">
				<input style="display:none;" type="submit" value="search">
			</form>
		</div>
	</div>
	<input type="hidden" id="hdnCurrPage" name="hdnCurrPage" value="1" />
	<input type="hidden" id="hdnRecLimit" name="hdnRecLimit" value="21" />
	<input type="hidden" id="hdnTotalRec" name="hdnTotalRec" value="" />
	<input type="hidden" id="hdnSearchUid" name="hdnSearchUid" value="" />
	<input type="hidden" id="hdnTag" name="hdnTag" value="<?=$hdnTag;?>" />
	<input type="hidden" id="searchKeyword" name="searchKeyword" value="<?=$searchKeyword;?>" />
		
	<div id="mainStampContainer" class="row js-trick-container" style="position: relative; height: 771px;">
		
	</div>