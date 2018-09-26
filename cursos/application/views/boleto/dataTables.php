<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Lista dos Boletos criados no aplicativo "ABRACO - Cursos"</h3>
				<div class="box-tools">
					<!--<a href="<?php echo site_url('boleto/add'); ?>" class="btn btn-success btn-sm">Adicionar</a> -->
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