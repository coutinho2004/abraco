<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Lista das Arquivos Remessa</h3>
				<div class="box-tools">
					<!--<a href="<?php echo site_url('index.php/remessa/add'); ?>" class="btn btn-success btn-sm">Adicionar</a> -->
				</div>
			</div>
			<div class="box-body">
				<table class="table table-striped">
					<tr>
						<th>Nome do Arquivo</th>
						<th>Data da Criação</th>
						<th>Ações</th>
					</tr>
					<?php foreach($boletos as $b):?>
					<tr>
						<td><a href="<?php echo base_url('resources/remessa/')?><?php echo $b['nome'];?>.rem"><?php echo $b['nome'];?></a></td>
						<td><?php echo $b['data_criacao']; ?></td>
						<td>
							<a href="<?php echo site_url('index.php/cnab/getGarb/'.$b['id']); ?>" class="btn btn-success btn-xs"><span class="fa fa-pencil"></span> Gerar Remessa</a>
							<a href="<?php echo site_url('index.php/cnab/exportarRemessa/'.$b['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Gerar Excel</a>
							<!--<a href="<?php echo site_url('index.php/remessa/remove/'.$b['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Deletar</a>-->
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