<section class="content-header">
    <h1>
        Stamp
        <small>
            <?=($this->router->fetch_method() == 'add')?'Add Stamp':'Edit Stamp'?>
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
                <form id='stamp_form' name='stamp_form' role="form" action="" method="post">
					<div class="form-group <?=(@$error_msg['t_uid'] != '')?'has-error':'' ?>">
                        <?php
                            if(@$error_msg['t_uid'] != ''){
                        ?>
                            <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i><?=@$error_msg['t_uid']?></label><br/>
                        <?php
                            }
                        ?>
						<label>Select User</label>
						<select class="form-control validate[required]" id="t_uid" name="t_uid">
                            <option value="">Select</option>
							<?php foreach ($users as $user) { ?>
								<option value='<?=$user->u_id; ?>' <?=(@$stamp[0]->t_uid == $user->u_id)?'selected':''?>  ><?=$user->u_fname." (".$user->u_email.")"; ?></option>
							<?php } ?>
						</select>
                    </div>
					<div class="form-group <?=(@$error_msg['t_albumid'] != '')?'has-error':'' ?>">
                        <?php
                            if(@$error_msg['t_albumid'] != ''){
                        ?>
                            <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i><?=@$error_msg['t_albumid']?></label><br/>
                        <?php
                            }
                        ?>
						<label>Select Album</label>
						<select class="form-control validate[required]" id="t_albumid" name="t_albumid">
                            <option value="">Select</option>
							<?php foreach ($albums as $album) { ?>
								<option value='<?=$album->al_id; ?>'  <?=(@$stamp[0]->t_albumid == $album->al_id)?'selected':''?>  ><?=$album->al_name; ?></option>
							<?php } ?>
						</select>
                    </div>
                    <div class="form-group <?=(@$error_msg['t_name'] != '')?'has-error':'' ?>">
                        <?php
                            if(@$error_msg['t_name'] != ''){
                        ?>
                            <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i><?=$error_msg['t_name']?></label><br/>
                        <?php
                            }
                        ?>
                        <label>Stamp Name:</label>
                        <input type="text" placeholder="Enter ..." class="form-control validate[required]" name="t_name" id="t_name" value="<?=@$stamp[0]->t_name?>" >
                    </div>
					<div class="form-group">
                        <label>Url:</label>
                        <input type="text" placeholder="Enter ..." class="form-control validate[custom[url]" name="t_url" id="t_url" value="<?=@$stamp[0]->t_url?>">
                    </div>
					<div class="form-group">
                        <label>Price:</label>
                        <input type="text" placeholder="Enter ..." class="form-control" name="t_price" id="t_price" value="<?=@$stamp[0]->t_price?>" >
                    </div>
					<div class="form-group">
                        <label>Year:</label>
                        <input type="text" placeholder="Enter ..." class="form-control" name="t_year" id="t_year" value="<?=@$stamp[0]->t_year?>" >
                    </div>
                    <div class="form-group">
                        <label>Country:</label>
                        <input type="text" placeholder="Enter ..." class="form-control" name="t_ownercountry" id="t_ownercountry" value="<?=@$stamp[0]->t_ownercountry?>" >
                    </div>
                    <div class="form-group">
                        <label>Bio:</label>
                        <textarea placeholder="Description here" id="t_bio" class="form-control" name="t_bio"><?=@$stamp[0]->t_bio?></textarea>
                    </div>
                   
                    
                    <div class="form-group">
                        <button class="btn btn-primary btn-flat" type="submit" id="submit">Submit</button>
                    </div>
                </form>
            </div>
    	</div>
    </div>
</section>
