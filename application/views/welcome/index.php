<div class='row'>
	<center>
	<h2 class="page-title">
				<a href="javascript:void(0);" <?php if($this->front_session['id'] > 0) {}else{?>onclick="openLoginForm();" <?php }?>>Put your stamps here and brings it to the world</a>
	</h2>
	</center>
</div>
<div class="row push-down">
		
		<div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
			<h1 class="page-title">Stamps</h1>
		</div>
		

		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
			<form method="GET" action="<?=base_url();?>" accept-charset="UTF-8" id="frmSearch">
				<input type="text" id="txtSearch" name="search" class="search-box form-control" placeholder="Search..." value="<?=$searchKeyword;?>">
				<input style="display:none;" type="submit" value="search">
			</form>
		</div>
		
		<?php 
			if(isset($uinfoArr) && !empty($uinfoArr))
			{
				if($uinfoArr['u_photo'] != '')
					$uphoto = base_url().UPLOADPATH.$uinfoArr['u_photo'];
				else
					$uphoto = base_url().UPLOADPATH.'nophoto.jpg';
				echo '<div class="col-lg-12 col-md-6" id="divUinfo" style="padding-top:10px;">
					<div class="content-box" style="margin:0;">
						<div class="trick-user">
							<div class="trick-user-image">
								<img src="'.$uphoto.'" class="user-avatar">
							</div>
							<div class="trick-user-data">
								<h1 class="page-title">User Name : '.$uinfoArr['u_fname'].' '.$uinfoArr['u_lname'].'</h1>
								<p>'.$uinfoArr['u_country'].'</p>
							</div>
						</div>
					</div>
				</div>';
			}
			?>

	</div>
	<input type="hidden" id="hdnCurrPage" name="hdnCurrPage" value="1" />
	<input type="hidden" id="hdnRecLimit" name="hdnRecLimit" value="21" />
	<input type="hidden" id="hdnTotalRec" name="hdnTotalRec" value="" />
	<input type="hidden" id="hdnSearchUid" name="hdnSearchUid" value="<?=$hdnUid;?>" />
	<input type="hidden" id="hdnTag" name="hdnTag" value="<?=$hdnTag;?>" />
	<input type="hidden" id="searchKeyword" name="searchKeyword" value="<?=$searchKeyword;?>" />
		
	<div id="mainStampContainer" class="row js-trick-container" style="position: relative; height: 771px;">
		
	</div>