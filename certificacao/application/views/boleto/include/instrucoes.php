<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Instruções</h3>
	</div>
	<div class="box-body">
		<div class="row clearfix">
			<div class="col-md-6">
				<label for="instrucoes_linha1" class="control-label"><span class="text-danger">*</span>Linha 1</label>
				<div class="form-group">
					<input type="text" name="instrucoes_linha1" value="<?php echo ($this->input->post('instrucoes_linha1')?$this->input->post('instrucoes_linha1'):'- Não aceitamos depósito em conta'); ?>" class="form-control" id="sacado_nome" />
					<span class="text-danger"><?php echo form_error('instrucoes_linha1');?></span>
				</div>
			</div>
			<div class="col-md-6">
				<label for="instrucoes_linha2" class="control-label">Linha 2</label>
				<div class="form-group">
					<input type="text" name="instrucoes_linha2" value="<?php echo ($this->input->post('instrucoes_linha2')?$this->input->post('instrucoes_linha2'):'- Em caso de dúvidas entre em contato conosco: qualificacao@abraco.org.br'); ?>" class="form-control" id="sacado_nome" />
					<span class="text-danger"><?php echo form_error('instrucoes_linha2');?></span>
				</div>
			</div>
			<div class="col-md-6">
				<label for="instrucoes_linha1" class="control-label">Linha 3</label>
				<div class="form-group">
					<input type="text" name="instrucoes_linha3" value="<?php echo ($this->input->post('instrucoes_linha3')?$this->input->post('instrucoes_linha3'):''); ?>" class="form-control" id="sacado_nome" />
					<span class="text-danger"><?php echo form_error('instrucoes_linha3');?></span>
				</div>
			</div>
			<div class="col-md-6">
				<label for="instrucoes_linha2" class="control-label">Linha 4</label>
				<div class="form-group">
					<input type="text" name="instrucoes_linha4" value="<?php echo ($this->input->post('instrucoes_linha4')?$this->input->post('instrucoes_linha4'):''); ?>" class="form-control" id="sacado_nome" />
					<span class="text-danger"><?php echo form_error('instrucoes_linha4');?></span>
				</div>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<button type="submit" class="btn btn-success">
			<i class="fa fa-check"></i> Salvar
		</button>
		<a href="<?php echo base_url('index.php/boleto')?>" class="btn btn-default"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Voltar</a>
	</div>
</div>