<div class="panel panel-default">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-signal"></i>
		<h3 class="panel-title"><strong><?php echo lang('deactivate_heading');?></strong></h3>
		<p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>
	</div>
	<?php echo form_open("index.php/auth/deactivate/".$user->id);?>
	<div class="panel-body">
		<div class="form-group">
			<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
			<input type="radio" name="confirm" value="yes" checked="checked" />
			<?php echo lang('deactivate_confirm_n_label', 'confirm');?>
			<input type="radio" name="confirm" value="no" />
		</div> <!--/ deactivate -->
	</div> <!--/ Panel Body -->
	<?php echo form_hidden($csrf); ?>
  	<?php echo form_hidden(array('id'=>$user->id)); ?>
	<div class="panel-footer">
		<div class="row">
			<div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
				<a href="<?php echo base_url('index.php/auth/index'); ?>" class="btn btn-default">
					<i class="glyphicon glyphicon-chevron-left"></i> Voltar
				</a>
				<button type="submit" class="btn btn-primary" name="post">
					<i class="glyphicon glyphicon-floppy-save"></i> <?php echo(lang('deactivate_submit_btn'));?>
				</button>
			</div>
		</div>
	</div><!--/ Panel Footer -->
	<?php echo form_close();?>
</div><!--/ Panel -->