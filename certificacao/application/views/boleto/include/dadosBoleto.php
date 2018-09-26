<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Dados do Boleto</h3>
	</div>
	<div class="box-body">
		<div class="row clearfix">
			<!--<div class="col-md-3">
				<label for="dias_de_prazo_para_pagamento" class="control-label"><span class="text-danger">*</span>Dias de Prazo para Pagamento</label>
				<div class="form-group">
					<input type="text" name="dias_de_prazo_para_pagamento" value="<?php echo $this->input->post('dias_de_prazo_para_pagamento'); ?>" class="form-control" id="dias_de_prazo_para_pagamento" />
					<span class="text-danger"><?php echo form_error('dias_de_prazo_para_pagamento');?></span>
				</div>
			</div>
			<div class="col-md-2">
				<label for="pedido_quantidade" class="control-label"><span class="text-danger">*</span>Quantidade</label>
				<div class="form-group">
					<input type="text" name="pedido_quantidade" value="<?php echo ($this->input->post('pedido_quantidade')?$this->input->post('pedido_quantidade'):'1'); ?>" class="form-control" id="pedido_quantidade" />
					<span class="text-danger"><?php echo form_error('pedido_quantidade');?></span>
				</div>
			</div>-->
			<div class="col-md-3">
				<label for="data_vencimento" class="control-label"><span class="text-danger">*</span>Data do Vencimento</label>
				<div class="form-group">
					<input type="date" id="data_vencimento" name="data_vencimento" value="<?php echo $this->input->post('data_vencimento'); ?>" class="form-control" id="data_vencimento" />
					<span class="text-danger"><?php echo form_error('data_vencimento');?></span>
				</div>
			</div>
			<div class="col-md-3">
				<label for="pedido_valor_unitario" class="control-label"><span class="text-danger">*</span>Valor Unitario</label>
				<div class="form-group">
					<input type="text" id="pedido_valor_unitario" name="pedido_valor_unitario" value="<?php echo $this->input->post('pedido_valor_unitario'); ?>" class="form-control" id="pedido_valor_unitario" />
					<span class="text-danger"><?php echo form_error('pedido_valor_unitario');?></span>
				</div>
			</div>
		</div>
	</div>
</div>