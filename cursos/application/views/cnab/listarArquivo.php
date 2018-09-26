<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Listar Arquivo Remessa</h3>
			</div>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-12">
						<table class="table table-striped">
							<tr>
								<th>Nome do Arquivo</th>
							</tr>
						<?php foreach($map as $row):?>
							<tr>
								<td><a href="<?php echo base_url('resources/remessa/')?><?php echo $row;?>"><?php echo $row;?></a></td>
							</tr>
						<?php endforeach ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>