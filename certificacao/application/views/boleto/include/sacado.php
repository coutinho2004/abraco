<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Dados do Sacado</h3>
	</div>
	<div class="box-body">
		<div class="row clearfix">
			<div class="col-md-4">
				<label for="sacado_nome" class="control-label"><span class="text-danger">*</span>Sacado Nome</label>
				<div class="form-group">
					<?php if($idAluno):?>
						<input type="text" name="sacado_nome" value="<?php echo ($this->input->post('sacado_nome')? $this->input->post('sacado_nome'): $aluno['nome'] ); ?>" class="form-control" id="sacado_nome" />
					<?php else: ?>
						<input type="text" name="sacado_nome" value="<?php echo $this->input->post('sacado_nome'); ?>" class="form-control" id="sacado_nome" />
					<?php endif?>
					<span class="text-danger"><?php echo form_error('sacado_nome');?></span>
				</div>
			</div>
			<div class="col-md-5">
				<label for="sacado_endereco" class="control-label"><span class="text-danger">*</span>Endereco</label>
				<div class="form-group">
					<?php if($idAluno):?>
						<input type="text" name="sacado_endereco" value="<?php echo ($this->input->post('sacado_endereco')?$this->input->post('sacado_endereco'):$aluno['endereco']); ?>" class="form-control" id="sacado_endereco" />
					<?php else: ?>
						<input type="text" name="sacado_endereco" value="<?php echo $this->input->post('sacado_endereco'); ?>" class="form-control" id="sacado_endereco" />
					<?php endif?>
					<span class="text-danger"><?php echo form_error('sacado_endereco');?></span>
				</div>
			</div>
			<div class="col-md-3">
				<label for="sacado_email" class="control-label"><span class="text-danger">*</span>E-mail</label>
				<div class="form-group">
					<?php if($idAluno):?>
						<input type="text" name="sacado_email" value="<?php echo ($this->input->post('sacado_email')?$this->input->post('sacado_email'):$aluno['email']); ?>" class="form-control" id="sacado_email" />
					<?php else: ?>
						<input type="text" name="sacado_email" value="<?php echo $this->input->post('sacado_email'); ?>" class="form-control" id="sacado_email" />
					<?php endif?>
					<span class="text-danger"><?php echo form_error('sacado_email');?></span>
				</div>
			</div>
			<div class="col-md-3">
				<label for="sacado_cpf_cnpj" class="control-label"><span class="text-danger">*</span>Sacado Cpf Cnpj</label>
				<div class="form-group">
					<?php if($idAluno):?>
						<input type="text" name="sacado_cpf_cnpj" value="<?php echo ($this->input->post('sacado_cpf_cnpj')?$this->input->post('sacado_cpf_cnpj'):$aluno['cpf']); ?>" class="form-control" id="sacado_cpf_cnpj" />
					<?php else: ?>
						<input type="text" name="sacado_cpf_cnpj" value="<?php echo $this->input->post('sacado_cpf_cnpj'); ?>" class="form-control" id="sacado_cpf_cnpj" />
					<?php endif?>
					<span class="text-danger"><?php echo form_error('sacado_cpf_cnpj');?></span>
				</div>
			</div>
			<div class="col-md-3">
				<label for="sacado_cidade" class="control-label"><span class="text-danger">*</span>Cidade</label>
				<div class="form-group">
					<?php if($idAluno):?>
						<input type="text" name="sacado_cidade" value="<?php echo ($this->input->post('sacado_cidade')?$this->input->post('sacado_cidade'):$aluno['cidade']); ?>" class="form-control" id="sacado_cidade" />
					<?php else: ?>
						<input type="text" name="sacado_cidade" value="<?php echo $this->input->post('sacado_cidade'); ?>" class="form-control" id="sacado_cidade" />
					<?php endif?>
					<span class="text-danger"><?php echo form_error('sacado_cidade');?></span>
				</div>
			</div>
			<div class="col-md-3">
				<label for="sacado_uf" class="control-label"><span class="text-danger">*</span>Uf</label>
				<div class="form-group">
					<?php if($idAluno):?>
						<input type="text" name="sacado_uf" value="<?php echo ($this->input->post('sacado_uf')?$this->input->post('sacado_uf'):$aluno['sigla']); ?>" class="form-control" id="sacado_uf" />
					<?php else: ?>
						<input type="text" name="sacado_uf" value="<?php echo $this->input->post('sacado_uf'); ?>" class="form-control" id="sacado_uf" />
					<?php endif?>
					<span class="text-danger"><?php echo form_error('sacado_uf');?></span>
				</div>
			</div>
			<div class="col-md-3">
				<label for="sacado_cep" class="control-label"><span class="text-danger">*</span>Cep</label>
				<div class="form-group">
					<?php if($idAluno):?>
						<input type="text" name="sacado_cep" value="<?php echo ($this->input->post('sacado_cep')?$this->input->post('sacado_cep'):$aluno['cep']); ?>" class="form-control" id="sacado_cep" />
					<?php else: ?>
						<input type="text" name="sacado_cep" value="<?php echo $this->input->post('sacado_cep'); ?>" class="form-control" id="sacado_cep" />
					<?php endif?>
					<span class="text-danger"><?php echo form_error('sacado_cep');?></span>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if($idAluno):?>
	<input type="hidden" name="sacado_snqc" value="<?php echo $aluno['snqc'];?>">
<?php endif?>