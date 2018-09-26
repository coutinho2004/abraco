<div class="container">
  <div class="row">
	<p></p>
	<div class="col-md-4 col-md-offset-4">
	  <div class="login-panel panel panel-default">
		<div class="panel-heading">
		  <h2 class="panel-title"><strong><?php echo lang('login_heading');?></strong></h2>
		</div>
		<div class="panel-body">
		  <div id="infoMessage"><?php echo $message;?></div>
		  <?php echo form_open("index.php/auth/login");?>
		  <fieldset>
			<div class="form-group">
			  <?php //echo lang('login_identity_label', 'identity');?>
			  <?php echo form_input($identity);?>
			</div>
			<div class="form-group">
			  <?php //echo lang('login_password_label', 'password');?>
			  <?php echo form_input($password);?>
			</div>
			<div class="checkbox">
			  <label>
				<?php //echo lang('login_remember_label', 'remember');?>
				<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
			  </label>
			</div>
			<?php echo form_submit('submit', lang('login_submit_btn'),'class="btn btn-primary"');?></p>
		  </fieldset>
		  <?php echo form_close();?>
		</div>
	  </div>
	</div>
  </div>
</div>