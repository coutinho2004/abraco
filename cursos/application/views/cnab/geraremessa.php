<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Gerar Remessa</h3>
			</div>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-12">
						<table class="table">
							<thead>
								<tr>
									<!--<th width="20"><input type="checkbox" name="todos" id="todos" value="todos" onclick="//marcardesmarcar();" /></th>-->
									<th></th>
									<th>Nome</th>
									<th>CPF CNPJ</th>
									<th>CEP</th>
									<th>Número Documento</th>
									<th>Nosso Número</th>
									<th>Data Vencimento</th>
									<th>Valor</th>
									<th>Ação</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$cpf = true;
								$cep = true;
								$i=1;
								foreach($boletos as $b):
									if(!$b['v_cpf_cnpj']){
										$cpf = false;
									}
									if(!$b['v_cep']){
										$cep = false;
									}
									$icone = ($b['v_cpf_cnpj'])?'fa fa-check':'fa fa-times';
									$iconeStyle = ($b['v_cpf_cnpj'])?'color: blue;':'color: red;';
									$iconeCEP = ($b['v_cep'])?'fa fa-check':'fa fa-times';
									$iconeStyleCEP = ($b['v_cep'])?'color: blue;':'color: red;';
								?>
								<tr>
									<!--<td><input type="checkbox" name="id_venda[]" class="marcar" value="<?php //echo $array['id_venda'] ?>" id="marcar"></td>-->
									<td><?php echo $i;?></td>
									<td><?php echo $b['sacado_nome']?></td>
									<td style="<?php echo $iconeStyle;?>"><?php echo $b['sacado_cpf_cnpj']?> <i class="<?php echo $icone?>" aria-hidden="true"></i></td>
									<td style="<?php echo $iconeStyleCEP;?>"><?php echo $b['sacado_cep']?> <i class="<?php echo $iconeCEP?>" aria-hidden="true"></i></td>
									<td><?php echo $b['pedido_numero']; ?></td>
									<td><?php echo $b['nosso_numero']; ?></td>
									<td><?php echo $b['data_venc']; ?></td>
									<td><?php echo $b['valor_boleto']; ?></td>
									<td><a href="<?php echo site_url('index.php/cnab/retirarCNAB/'.$b['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Retirar</a></td>
								</tr>
								<?php 
									$i++;
								endforeach ?>
							</tbody>
							</table>
					</div>
				</div>
			</div>
			<?php if(count($boletos)>0):?>
			<div class="box-footer">
			<?php if($cpf && $cep):?>
					<a href="<?php echo site_url('index.php/cnab/garb'); ?>" class="btn btn-success btn-sm">Gerar Remessa</a>
			<?php endif?>
			</div>
			<?php endif?>
		</div>
	</div>
</div>
<script language="Javascript">
window.onload = function () {
setTimeout('location.reload();', 6000);
}
</script>