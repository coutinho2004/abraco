<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="panel-title"><strong><?php echo lang('create_user_heading');?></strong></h3>
		<p><?php echo lang('create_user_subheading');?></p>
		<div id="infoMessage"><?php echo $message;?></div>
	</div>
	<?php echo form_open("index.php/auth/create_user");?>
	<div class="box-body">
		<div class="form-group">
			<label for="first_name" class="col-sm-4 control-label">
				<?php echo lang('create_user_fname_label', 'first_name');?>
				<span class="text-danger">*</span>
			</label>
			<div class="col-sm-8">
				<?php echo form_input($first_name);?>
			</div>
		</div> <!--/ first_name -->
		<br>
		<div class="form-group">
			<label for="last_name" class="col-sm-4 control-label">
				<?php echo lang('create_user_lname_label', 'last_name');?>
				<span class="text-danger">*</span>
			</label>
			<div class="col-sm-8">
				<?php echo form_input($last_name);?>
			</div>
		</div> <!--/ last_name -->
		<div class="form-group">
			<?php
			if($identity_column!=='email') {
				echo '<p>';
					echo lang('create_user_identity_label', 'identity');
					echo '<br />';
					echo form_error('identity');
					echo form_input($identity);
				echo '</p>';
			}?>
		</div>
		<br>
		<div class="form-group">
			<label for="email" class="col-sm-4 control-label">
				<?php echo lang('create_user_email_label', 'email');?>
				<span class="text-danger">*</span>
			</label>
			<div class="col-sm-8">
				<?php echo form_input($email);?>
			</div>
		</div> <!--/ email -->
		<br>
		<div class="form-group">
			<label for="password" class="col-sm-4 control-label">
				<?php echo lang('create_user_password_label', 'password');?>
				<span class="text-danger">*</span>
			</label>
			<div class="col-sm-8">
				<?php echo form_input($password);?>
			</div>
		</div> <!--/ password -->
		<br>
		<div class="form-group">
			<label for="password_confirm" class="col-sm-4 control-label">
				<?php echo lang('create_user_password_confirm_label', 'password_confirm');?>
				<span class="text-danger">*</span>
			</label>
			<div class="col-sm-8">
				<?php echo form_input($password_confirm);?>
			</div>
		</div> <!--/ password_confirm -->
	</div> <!--/ Panel Body -->
	<div class="box-footer">
		<div class="row">
			<div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
				<a href="<?php echo base_url('index.php/auth/index'); ?>" class="btn btn-default">
					<i class="glyphicon glyphicon-chevron-left"></i> Voltar
				</a>
				<button type="submit" class="btn btn-primary" name="post">
					<i class="glyphicon glyphicon-floppy-save"></i> <?php echo(lang('create_user_submit_btn'));?>
				</button>
			</div>
		</div>
	</div><!--/ Panel Footer -->
	<?php echo form_close();?>
</div><!--/ Panel -->