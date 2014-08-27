<section class="content-header">
    <h1>
        Album
        <small>
            <?=($this->router->fetch_method() == 'add')?'Add Album':'Edit Album'?>
        </small>
    </h1>
    <?php
		$this->load->view(ADMIN."/template/bread_crumb");
	?>
</section>
<section class="content">
	<div class="row">
    	<div class="col-md-6">
    		<div class="box-body">
                <?php 
                    if (@$flash_msg != "") {
                ?>
                    <div id="flash_msg"><?=$flash_msg?></div>
                <?php
                    }
                ?>
                <form id='album_form' name='album_form' role="form" action="" method="post">
					<input type='hidden' id='al_id' name='al_id' value='<?=(@$album[0]->al_id)?>'>
					<input type='hidden' id='t_dimension' name='t_dimension' value='<?=(@$ticket_collection)?>'>
					<div class="form-group <?=(@$error_msg['t_uid'] != '')?'has-error':'' ?>">
                        <?php
                            if(@$error_msg['t_uid'] != ''){
                        ?>
                            <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i><?=@$error_msg['t_uid']?></label><br/>
                        <?php
                            }
                        ?>
						<label>Select User</label>
						<select class="form-control validate[required]" id="al_uid" name="al_uid" title="Select User">
                            <option value="">Select</option>
							<?php foreach ($users as $user) { ?>
								<option value='<?=$user->u_id; ?>' <?=(@$album[0]->al_uid == $user->u_id)?'selected':''?>  ><?=$user->u_fname." (".$user->u_email.")"; ?></option>
							<?php } ?>
						</select>
                    </div>
                    <div class="form-group <?=(@$error_msg['al_name'] != '')?'has-error':'' ?>">
                        <?php
                            if(@$error_msg['al_name'] != ''){
                        ?>
                            <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i><?=$error_msg['al_name']?></label><br/>
                        <?php
                            }
                        ?>
                        <label>Album Name:</label>
                        <input type="text" placeholder="Enter ..." class="form-control validate[required]" name="al_name" id="al_name" value="<?=@$album[0]->al_name?>" title="Album Name">
                    </div>
                    <div class="form-group">
                        <label>Country:</label>
                        <input type="text" placeholder="Enter ..." class="form-control" name="al_country" id="al_country" value="<?=@$album[0]->al_country?>" title="Country">
                    </div>
                    <div class="form-group">
                        <label>Price:</label>
                        <input type="text" placeholder="Enter ..." class="form-control" name="al_price" id="al_price" value="<?=@$album[0]->al_price?>" title="Price" >
                    </div>
                    <div class="form-group">
                        <label>Url:</label>
                        <input type="text" placeholder="Enter ..." class="form-control validate[custom[url]" name="al_url" id="al_url" value="<?=@$album[0]->al_url?>" title="URL">
                    </div>
					<div class="form-group clearfix dealuploaddiv" style="position:relative;"> <!-- Uploaded images will be shown here -->
						<input type='hidden' name='newimages' id='newimages'>
						<input type='hidden' name='sortOrder' id='sortOrder'>
						<input type='hidden' name='al_mainphoto' id='al_mainphoto' value='<?=(@$ticket_links[0]->link_url)?>'>
						<label for="">Select Album Image:</label>
						<?php if(count(@$ticket_links) == 0) {
							echo "<div class='form-group'>Please upload image for Album than you can select images for stamp.</div>";
						}?>
                        
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-flat" type="submit" id="submit">Submit</button>
                    </div>
                </form>
            </div>
    	</div>
		<ul id='img-container' class='list-unstyled clearfix'>
			<?php foreach(@$ticket_links as $img) {?>
				<li class='pull-left'>
				<img id="albumImg" src='<?=(base_url()."uploads/stamp/".$img->link_url)?>' class='newimgFull' imgid = '<?=($img->link_id)?>'>
				<br>
				<center>
					<a class="removeimage" link_id="<?=($img->link_id)?>" href="#" title="Delete"><i class="fa fa-trash-o"></i></a>
					<button class="btn btn-primary btn-flat" style="margin-left:14px;" id="btn_createstamp">Create Stamp</button>
				</center>
				</li>
			<?php }?>
		</ul>
		<?php if(count(@$ticket_links) == 0){?>
		<div class='col-md-6'>
			<div class='box box-info'>
				<div class="box-header">
					<h3 class="box-title">Upload Album Image</h3>
				</div>
				<div class="box-body">
					<form id="my-awesome-dropzone" action="<?=base_url()."admin/album/fileupload"?>" class="dropzone">
						<input type='hidden' name='al_id' value='<?=(@$album[0]->al_id)?>'>
					</form>
				</div>
			</div>
		</div>
		<?php }?>
    </div>
</section>
