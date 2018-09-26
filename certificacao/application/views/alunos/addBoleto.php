<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Dados do Boleto</h3>
            </div>
			<?php echo form_open('dados_boleto/edit/'.$alunos['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="nosso_numero" class="control-label">Nosso Numero</label>
						<div class="form-group">
							<input type="text" name="nosso_numero" value="<?php echo ($this->input->post('nosso_numero') ? $this->input->post('nosso_numero') : $alunos['nome']); ?>" class="form-control" id="nosso_numero" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="numero_documento" class="control-label">Numero Documento</label>
						<div class="form-group">
							<input type="text" name="numero_documento" value="<?php echo ($this->input->post('numero_documento') ? $this->input->post('numero_documento') : $alunos['nome']); ?>" class="form-control" id="numero_documento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="data_vencimento" class="control-label">Data Vencimento</label>
						<div class="form-group">
							<input type="text" name="data_vencimento" value="<?php echo ($this->input->post('data_vencimento') ? $this->input->post('data_vencimento') : $alunos['nome']); ?>" class="has-datepicker form-control" id="data_vencimento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="data_documento" class="control-label">Data Documento</label>
						<div class="form-group">
							<input type="text" name="data_documento" value="<?php echo ($this->input->post('data_documento') ? $this->input->post('data_documento') : $alunos['nome']); ?>" class="has-datepicker form-control" id="data_documento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="data_processamento" class="control-label">Data Processamento</label>
						<div class="form-group">
							<input type="text" name="data_processamento" value="<?php echo ($this->input->post('data_processamento') ? $this->input->post('data_processamento') : $alunos['nome']); ?>" class="has-datepicker form-control" id="data_processamento" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="valor_boleto" class="control-label">Valor Boleto</label>
						<div class="form-group">
							<input type="text" name="valor_boleto" value="<?php echo ($this->input->post('valor_boleto') ? $this->input->post('valor_boleto') : $alunos['nome']); ?>" class="form-control" id="valor_boleto" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="endereco1" class="control-label">Endereco1</label>
						<div class="form-group">
							<input type="text" name="endereco1" value="<?php echo ($this->input->post('endereco1') ? $this->input->post('endereco1') : $alunos['endereco']); ?>" class="form-control" id="endereco1" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="endereco2" class="control-label">Endereco2</label>
						<div class="form-group">
							<input type="text" name="endereco2" value="<?php echo ($this->input->post('endereco2') ? $this->input->post('endereco2') : $alunos['nome']); ?>" class="form-control" id="endereco2" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="demonstrativo1" class="control-label">Demonstrativo1</label>
						<div class="form-group">
							<input type="text" name="demonstrativo1" value="<?php echo ($this->input->post('demonstrativo1') ? $this->input->post('demonstrativo1') : $alunos['nome']); ?>" class="form-control" id="demonstrativo1" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="demonstrativo2" class="control-label">Demonstrativo2</label>
						<div class="form-group">
							<input type="text" name="demonstrativo2" value="<?php echo ($this->input->post('demonstrativo2') ? $this->input->post('demonstrativo2') : $alunos['nome']); ?>" class="form-control" id="demonstrativo2" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="valor_unitario" class="control-label">Valor Unitario</label>
						<div class="form-group">
							<input type="text" name="valor_unitario" value="<?php echo ($this->input->post('valor_unitario') ? $this->input->post('valor_unitario') : $alunos['nome']); ?>" class="form-control" id="valor_unitario" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cpf_cnpj" class="control-label">Cpf Cnpj</label>
						<div class="form-group">
							<input type="text" name="cpf_cnpj" value="<?php echo ($this->input->post('cpf_cnpj') ? $this->input->post('cpf_cnpj') : $alunos['cpf']); ?>" class="form-control" id="cpf_cnpj" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="nome" class="control-label">Nome</label>
						<div class="form-group">
							<input type="text" name="nome" value="<?php echo ($this->input->post('nome') ? $this->input->post('nome') : $alunos['nome']); ?>" class="form-control" id="nome" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="email" class="control-label">Email</label>
						<div class="form-group">
							<input type="text" name="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $alunos['email']); ?>" class="form-control" id="email" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="situacao" class="control-label">Situacao</label>
						<div class="form-group">
							<input type="text" name="situacao" value="<?php echo ($this->input->post('situacao') ? $this->input->post('situacao') : $alunos['nome']); ?>" class="form-control" id="situacao" />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Save
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>