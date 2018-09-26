<script type="text/javascript">
	$(function() {
		$('#pedido_valor_unitario').maskMoney({ decimal: '.', thousands: '', precision: 2 });
	})
</script>
<div class="row">
	<div class="col-md-12">
		<?php echo form_open('index.php/boleto/add'); ?>
		<?php include('include/dadosBoleto.php');?>
		<?php include('include/sacado.php');?>
		<?php include('include/demonstrativo.php');?>
		<?php include('include/instrucoes.php');?>
		<?php echo form_close(); ?>
	</div>
</div>