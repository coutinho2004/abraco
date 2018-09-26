<div class="box box-info">
	<div class="box-header with-border">
		<h3><?php echo lang('edit_user_heading');?></h3>
		<p><?php echo lang('edit_user_subheading');?></p>
		<div id="infoMessage"><?php echo $message;?></div>
	</div>
	<?php echo form_open('index.php/'.uri_string());?>
	<div class="box-body">
		<div class="form-group">
			<label for="first_name" class="col-sm-4 control-label"><?php echo lang('edit_user_fname_label', 'first_name');?> <span class="required-input">*</span></label>
			<div class="col-sm-8">
				<?php echo form_input($first_name);?>
			</div>
		</div> <!--/ first_name -->
		<br>
		<div class="form-group">
			<label for="last_name" class="col-sm-4 control-label"><?php echo lang('edit_user_lname_label', 'last_name');?> <span class="required-input">*</span></label>
			<div class="col-sm-8">
				<?php echo form_input($last_name);?>
			</div>
		</div> <!--/ last_name -->
		<br>
		<div class="form-group">
			<label for="password" class="col-sm-4 control-label"><?php echo lang('edit_user_password_label', 'password');?> <span class="required-input">*</span></label>
			<div class="col-sm-8">
				<?php echo form_input($password);?>
			</div>
		</div> <!--/ password -->
		<br>
		<div class="form-group">
			<label for="password_confirm" class="col-sm-4 control-label"><?php echo lang('edit_user_password_confirm_label', 'password_confirm');?> <span class="required-input">*</span></label>
			<div class="col-sm-8">
				<?php echo form_input($password_confirm);?>
			</div>
		</div> <!--/ password_confirm -->
		<?php if($this->ion_auth->is_admin()): ?>
		<div class="checkbox">
			<label for="group" class="col-sm-4 control-label"><?php echo lang('edit_user_groups_heading');?></label>
			<div class="col-sm-8">
				<?php foreach ($groups as $group):?>
					<label class="checkbox">
						<?php
							$gID=$group['id'];
							$checked = null;
							$item = null;
							foreach($currentGroups as $grp) {
								if($gID == $grp->id){
									$checked= ' checked="checked"';
									break;
								}
							}
						?>
						<input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
						<?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
					</label>
				<?php endforeach?>
			</div>
		</div> <!--/ group -->
		<?php endif ?>
		<?php echo form_hidden('id', $user->id);?>
		<?php echo form_hidden($csrf); ?>
	</div> <!--/ Panel Body -->
	<div class="box-footer">
		<div class="row">
			<div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
				<a href="<?php echo base_url('index.php/auth/index'); ?>" class="btn btn-default">
					<i class="glyphicon glyphicon-chevron-left"></i> Voltar
				</a>
				<button type="submit" class="btn btn-primary" name="post">
					<i class="glyphicon glyphicon-floppy-save"></i> <?php echo(lang('edit_user_submit_btn'));?>
				</button>
			</div>
		</div>
	</div><!--/ Panel Footer -->
	<?php echo form_close();?>
</div><!--/ Panel -->