<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Demonstrativo</h3>
	</div>
	<div class="box-body">
		<div class="row clearfix">
			<div class="col-md-6">
				<label for="demonstrativo_linha1" class="control-label"><span class="text-danger">*</span>Linha 1</label>
				<div class="form-group">
					<select class="form-control" id="demonstrativo_linha1" name="demonstrativo_linha1">
					<?php foreach ($message as $ms):?>
						<option value="<?php echo $ms['mensagem_id'];?>"><?php echo $ms['mensagem_nome'];?></option>
					<?php endforeach?>
					</select>
					<!--<input type="text" name="demonstrativo_linha1" value="<?php echo $this->input->post('demonstrativo_linha1'); ?>" class="form-control" id="sacado_nome" />-->
					<span class="text-danger"><?php echo form_error('demonstrativo_linha1');?></span>
				</div>
			</div>
			<div class="col-md-6">
				<label for="demonstrativo_linha2" class="control-label">Linha 3</label>
				<div class="form-group">
					<input type="text" name="demonstrativo_linha3" value="<?php echo $this->input->post('demonstrativo_linha3'); ?>" class="form-control" id="sacado_nome" />
					<span class="text-danger"><?php echo form_error('demonstrativo_linha3');?></span>
				</div>
			</div>
		</div>
	</div>
</div>