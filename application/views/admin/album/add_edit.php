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
					<div class="form-group <?=(@$error_msg['t_uid'] != '')?'has-error':'' ?>">
                        <?php
                            if(@$error_msg['t_uid'] != ''){
                        ?>
                            <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i><?=@$error_msg['t_uid']?></label><br/>
                        <?php
                            }
                        ?>
						<label>Select User</label>
						<select class="form-control validate[required]" id="al_uid" name="al_uid">
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
                        <input type="text" placeholder="Enter ..." class="form-control validate[required]" name="al_name" id="al_name" value="<?=@$album[0]->al_name?>" >
                    </div>
                    <div class="form-group">
                        <label>Country:</label>
                        <input type="text" placeholder="Enter ..." class="form-control" name="al_country" id="al_country" value="<?=@$album[0]->al_country?>" >
                    </div>
                    <div class="form-group">
                        <label>Price:</label>
                        <input type="text" placeholder="Enter ..." class="form-control" name="al_price" id="al_price" value="<?=@$album[0]->al_price?>" >
                    </div>
                    <div class="form-group">
                        <label>Url:</label>
                        <input type="text" placeholder="Enter ..." class="form-control validate[custom[url]" name="al_url" id="al_url" value="<?=@$album[0]->al_url?>">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-flat" type="submit" id="submit">Submit</button>
                    </div>
                </form>
            </div>
    	</div>
    </div>
</section>
