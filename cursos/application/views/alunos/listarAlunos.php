<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Listando Alunos com CPF inválido oriundos da aplicação "Cursos"</h3>
			</div>
			<div class="box-body">
				<table class="table table-striped">
					<tr>
						<th></th>
						<th>Nome</th>
						<th>CPF/CNPJ</th>
					</tr>
					<?php
					$i = 1;
					foreach($alunos as $d):
						$cpf_cnpj = new Validacpfcnpj($d['aluno_cpf']);
					?>
					<?php if(!$cpf_cnpj->valida()):?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $d['aluno_nome']; ?></td>
						<td style="color: red;"><?php echo $d['aluno_cpf']; ?> <i class="fa fa-times" aria-hidden="true"></i></td>
					</tr>
					<?php 
							$i++;
							endif ?>
					<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
</div>
