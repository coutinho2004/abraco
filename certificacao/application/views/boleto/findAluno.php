<div class="row">
	<div class="col-md-12">
		<?php echo form_open('index.php/boleto/getAluno'); ?>
		<div class="box-header with-border">
		<h3 class="box-title">Pesquisar Aluno</h3>
	</div>
	<div class="box-body">
		<div class="row clearfix">
			<div class="col-md-3">
				<label for="snqc" class="control-label"><span class="text-danger">*</span>SNQC</label>
				<div class="form-group">
					<input type="text" name="snqc" value="<?php echo $this->input->post('snqc'); ?>" class="form-control" id="snqc" />
					<span class="text-danger"><?php echo form_error('snqc');?></span>
					<p></p>
					<button type="submit" class="btn btn-success">
						<i class="fa fa-search"></i>	 Pesquisar
					</button>
				</div>
			</div>
			<div class="col-md-3">
			</div>
		</div>
	</div>
		<?php echo form_close(); ?>
	</div>
</div>