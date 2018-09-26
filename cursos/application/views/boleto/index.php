<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Lista dos Boletos</h3>
				<div class="box-tools">
					<!--<a href="<?php echo site_url('boleto/add'); ?>" class="btn btn-success btn-sm">Adicionar</a> -->
				</div>
			</div>
			<div class="box-body">
				<table class="table table-striped">
					<tr>
						<th>Sacado Nome</th>
						<th>Sacado Cpf Cnpj</th>
						<th>Valor Unitario</th>
						<th>Data Vencimento</th>
						<th>Nosso Número</th>
						<th>Status</th>
						<th>Ações</th>
					</tr>
					<?php foreach($boletos as $b):
						$icone = ($b['v_cpf_cnpj'])?'fa fa-check':'fa fa-times';
						$iconeStyle = ($b['v_cpf_cnpj'])?'color: blue;':'color: red;';
					?>
					<tr>
						<td><?php echo $b['sacado_nome']; ?></td>
						<td style="<?php echo $iconeStyle;?>"><?php echo $b['sacado_cpf_cnpj']; ?>  <i class="<?php echo $icone?>" aria-hidden="true"></i></td>
						<td>R$ <?php echo $b['valor_boleto']; ?></td>
						<td><?php echo $b['data_venc']; ?></td>
						<td><?php echo $b['nosso_numero']; ?></td>
						<td><?php echo $b['status']; ?></td>
						<td>
							<!--<a href="<?php echo site_url('index.php/boleto/edit/'.$b['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Editar</a> -->
							<a href="<?php echo site_url('index.php/boleto/remove/'.$b['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Deletar</a>
							<a href="<?php echo site_url('index.php/boleto/getBoleto/'.$b['id']); ?>" target="_Blank" class="btn btn-default btn-xs"><span class="fa fa-ticket"></span> Boleto</a>
						</td>
					</tr>
					<?php endforeach ?>
				</table>
				<div class="pull-right">
					<?php echo $this->pagination->create_links(); ?>
				</div>
			</div>
		</div>
	</div>
</div>