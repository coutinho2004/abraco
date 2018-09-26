<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Listando Boletos</h3>
			</div>
			<div class="box-body">
				<table class="table table-striped">
					<tr>
						<th>Nome</th>
						<th>CPF/CNPJ</th>
						<th>SNQC</th>
						<th>Ações</th>
					</tr>
					<?php foreach($alunos as $d){
						$icone = ($d['v_cpf_cnpj'])?'fa fa-check':'fa fa-times';
						$iconeStyle = ($d['v_cpf_cnpj'])?'color: blue;':'color: red;';
					?>
					<tr>
						<td><?php echo $d['nome']; ?></td>
						<td style="<?php echo $iconeStyle;?>"><?php echo $d['cpf']; ?> <i class="<?php echo $icone?>" aria-hidden="true"></i></td>
						<td><?php echo $d['snqc']; ?></td>
						<td>
							<!--<a href="<?php echo site_url('alunos/edit/'.$d['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> -->
							<a href="<?php echo site_url('alunos/addBoleto/'.$d['id']); ?>" class="btn btn-default btn-xs"><span class="fa fa-ticket"></span> Boleto</a>
						</td>
					</tr>
					<?php } ?>
				</table>
				<div class="pull-right">
					<?php echo $this->pagination->create_links(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
