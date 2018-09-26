<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Por favor escolha o documento que você deseja fazer a Leitura do Arquivo de Retorno</h3>
			</div>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<?php echo form_open_multipart('index.php/cnab/getRetorno'); ?>
							<label for="arq_ret">Selecione o Arquivo</label>
							<input type="file" name="arq_ret" id="arq_ret"  class="btn btn-default" accept="*.ret" /><br><br>
							<input type="submit" name="enviar"  class="btn btn-success" value="Ler Arquivo" />
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>