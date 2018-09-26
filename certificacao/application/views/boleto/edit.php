<script type="text/javascript">
	$(function() {
		$('#pedido_valor_unitario').maskMoney({ decimal: '.', thousands: '', precision: 2 });
	})
</script>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Boleto</h3>
            </div>
			<?php echo form_open('index.php/boleto/edit/'.$boleto['id']); ?>
			<div class="box-body">
				<!-- Data e Valor -->
				<div class="row clearfix">
					<!--<div class="col-md-3">
						<label for="dias_de_prazo_para_pagamento" class="control-label"><span class="text-danger">*</span>Dias de Prazo para Pagamento</label>
						<div class="form-group">
							<input type="text" name="dias_de_prazo_para_pagamento" value="<?php echo ($this->input->post('dias_de_prazo_para_pagamento')?$this->input->post('dias_de_prazo_para_pagamento'):$boleto['dias_de_prazo_para_pagamento']); ?>" class="form-control" id="dias_de_prazo_para_pagamento" />
							<span class="text-danger"><?php echo form_error('dias_de_prazo_para_pagamento');?></span>
						</div>
					</div>
					<div class="col-md-2">
						<label for="pedido_quantidade" class="control-label"><span class="text-danger">*</span>Quantidade</label>
						<div class="form-group">
							<input type="text" name="pedido_quantidade" value="<?php echo ($this->input->post('pedido_quantidade')?$this->input->post('pedido_quantidade'):$boleto['pedido_quantidade']); ?>" class="form-control" id="pedido_quantidade" />
							<span class="text-danger"><?php echo form_error('pedido_quantidade');?></span>
						</div>
					</div>-->
					<div class="col-md-3">
						<label for="data_vencimento" class="control-label"><span class="text-danger">*</span>Data do Vencimento</label>
						<div class="form-group">
							<input type="date" id="data_vencimento" name="data_vencimento" value="<?php echo ($this->input->post('data_vencimento')?$this->input->post('data_vencimento'):$boleto['data_vencimento']); ?>" class="form-control" id="data_vencimento" />
							<span class="text-danger"><?php echo form_error('data_vencimento');?></span>
						</div>
					</div>
					<div class="col-md-3">
						<label for="pedido_valor_unitario" class="control-label"><span class="text-danger">*</span>Valor Unitario</label>
						<div class="form-group">
							<input type="text" id="pedido_valor_unitario" name="pedido_valor_unitario" value="<?php echo ($this->input->post('pedido_valor_unitario')?$this->input->post('pedido_valor_unitario'):$boleto['pedido_valor_unitario']); ?>" class="form-control" id="pedido_valor_unitario" />
							<span class="text-danger"><?php echo form_error('pedido_valor_unitario');?></span>
						</div>
					</div>
				</div>
				<!-- Sacado -->
				<div class="row clearfix">
					<div class="col-md-4">
						<label for="sacado_nome" class="control-label"><span class="text-danger">*</span>Sacado Nome</label>
						<div class="form-group">
								<input type="text" name="sacado_nome" value="<?php echo ($this->input->post('sacado_nome')? $this->input->post('sacado_nome'): $boleto['sacado_nome'] ); ?>" class="form-control" id="sacado_nome" />
							<span class="text-danger"><?php echo form_error('sacado_nome');?></span>
						</div>
					</div>
					<div class="col-md-5">
						<label for="sacado_endereco" class="control-label"><span class="text-danger">*</span>Endereco</label>
						<div class="form-group">
							<input type="text" name="sacado_endereco" value="<?php echo ($this->input->post('sacado_endereco')?$this->input->post('sacado_endereco'):$boleto['sacado_endereco']); ?>" class="form-control" id="sacado_endereco" />
							<span class="text-danger"><?php echo form_error('sacado_endereco');?></span>
						</div>
					</div>
					<div class="col-md-3">
						<label for="sacado_email" class="control-label"><span class="text-danger">*</span>E-mail</label>
						<div class="form-group">
							<input type="text" name="sacado_email" value="<?php echo ($this->input->post('sacado_email')?$this->input->post('sacado_email'):$boleto['sacado_email']); ?>" class="form-control" id="sacado_email" />
							<span class="text-danger"><?php echo form_error('sacado_email');?></span>
						</div>
					</div>
					<div class="col-md-3">
						<label for="sacado_cpf_cnpj" class="control-label"><span class="text-danger">*</span>Sacado Cpf Cnpj</label>
						<div class="form-group">
							<input type="text" name="sacado_cpf_cnpj" value="<?php echo ($this->input->post('sacado_cpf_cnpj')?$this->input->post('sacado_cpf_cnpj'):$boleto['sacado_cpf_cnpj']); ?>" class="form-control" id="sacado_cpf_cnpj" />
							<span class="text-danger"><?php echo form_error('sacado_cpf_cnpj');?></span>
						</div>
					</div>
					<div class="col-md-3">
						<label for="sacado_cidade" class="control-label"><span class="text-danger">*</span>Cidade</label>
						<div class="form-group">
							<input type="text" name="sacado_cidade" value="<?php echo ($this->input->post('sacado_cidade')?$this->input->post('sacado_cidade'):$boleto['sacado_cidade']); ?>" class="form-control" id="sacado_cidade" />
							<span class="text-danger"><?php echo form_error('sacado_cidade');?></span>
						</div>
					</div>
					<div class="col-md-3">
						<label for="sacado_uf" class="control-label"><span class="text-danger">*</span>Uf</label>
						<div class="form-group">
							<input type="text" name="sacado_uf" value="<?php echo ($this->input->post('sacado_uf')?$this->input->post('sacado_uf'):$boleto['sacado_uf']); ?>" class="form-control" id="sacado_uf" />
							<span class="text-danger"><?php echo form_error('sacado_uf');?></span>
						</div>
					</div>
					<div class="col-md-3">
						<label for="sacado_cep" class="control-label"><span class="text-danger">*</span>Cep</label>
						<div class="form-group">
							<input type="text" name="sacado_cep" value="<?php echo ($this->input->post('sacado_cep')?$this->input->post('sacado_cep'):$boleto['sacado_cep']); ?>" class="form-control" id="sacado_cep" />
							<span class="text-danger"><?php echo form_error('sacado_cep');?></span>
							<input type="hidden" name="sacado_snqc" value="<?php echo $boleto['sacado_snqc'];?>">
						</div>
					</div>
				</div>
				<!-- Demostrativo -->
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="demonstrativo_linha1" class="control-label"><span class="text-danger">*</span>Linha 1</label>
						<div class="form-group">
							<select class="form-control" id="demonstrativo_linha1" name="demonstrativo_linha1">
							<?php foreach ($message as $ms):?>
								<option value="<?php echo $ms['mensagem_id'];?>" <?php echo ($boleto['demonstrativo_linha1']==$ms['mensagem_nome'])?'selected':''?>><?php echo $ms['mensagem_nome'];?></option>
							<?php endforeach?>
							</select>
							<span class="text-danger"><?php echo form_error('demonstrativo_linha1');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="demonstrativo_linha2" class="control-label">Linha 3</label>
						<div class="form-group">
							<input type="text" name="demonstrativo_linha3" value="<?php echo ($this->input->post('demonstrativo_linha3')?$this->input->post('demonstrativo_linha3'):$boleto['demonstrativo_linha3']); ?>" class="form-control" id="sacado_nome" />
							<span class="text-danger"><?php echo form_error('demonstrativo_linha3');?></span>
						</div>
					</div>
				</div>
				<!-- Instruções -->
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="instrucoes_linha1" class="control-label"><span class="text-danger">*</span>Linha 1</label>
						<div class="form-group">
							<input type="text" name="instrucoes_linha1" value="<?php echo ($this->input->post('instrucoes_linha1')?$this->input->post('instrucoes_linha1'):$boleto['instrucoes_linha1']); ?>" class="form-control" id="sacado_nome" />
							<span class="text-danger"><?php echo form_error('instrucoes_linha1');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="instrucoes_linha2" class="control-label">Linha 2</label>
						<div class="form-group">
							<input type="text" name="instrucoes_linha2" value="<?php echo ($this->input->post('instrucoes_linha2')?$this->input->post('instrucoes_linha2'):$boleto['instrucoes_linha2']); ?>" class="form-control" id="sacado_nome" />
							<span class="text-danger"><?php echo form_error('instrucoes_linha2');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="instrucoes_linha1" class="control-label">Linha 3</label>
						<div class="form-group">
							<input type="text" name="instrucoes_linha3" value="<?php echo ($this->input->post('instrucoes_linha3')?$this->input->post('instrucoes_linha3'):$boleto['instrucoes_linha3']); ?>" class="form-control" id="sacado_nome" />
							<span class="text-danger"><?php echo form_error('instrucoes_linha3');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="instrucoes_linha2" class="control-label">Linha 4</label>
						<div class="form-group">
							<input type="text" name="instrucoes_linha4" value="<?php echo ($this->input->post('instrucoes_linha4')?$this->input->post('instrucoes_linha4'):$boleto['instrucoes_linha4']); ?>" class="form-control" id="sacado_nome" />
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
			<?php echo form_close(); ?>
		</div>
    </div>
</div>