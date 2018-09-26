<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Lista dos Boletos</h3>
				<div class="box-tools">
					<a href="<?php echo site_url('index.php/boleto/findAluno'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Criar Boleto Aluno</a>
					<a href="<?php echo site_url('index.php/boleto/add'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Criar Boleto Empresa</a>
				</div>
			</div>
			<div class="box-body">
				<?php
					$this->datatables->generate();
					$this->datatables->jquery();
				?>
			</div>
		</div>
	</div>
</div>