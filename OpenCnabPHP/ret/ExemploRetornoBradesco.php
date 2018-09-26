<?php
namespace CnabPHP\samples;
use \CnabPHP\Retorno;
include("../autoloader.php");

if(!empty($_FILES['userfile']['name'])){
	$fileContent = file_get_contents($_FILES['userfile']['name']);
	$arquivo = new Retorno($fileContent);
	$registros = $arquivo->getRegistros();
	
}else{
	$registros = array();
}


?>

<form enctype="multipart/form-data" action="ExemploRetornoBradesco.php" method="POST">
    <!-- MAX_FILE_SIZE deve preceder o campo input -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- O Nome do elemento input determina o nome da array $_FILES -->
    Enviar esse arquivo: <input name="userfile" type="file"  accept="*.ret"/>
    <input type="submit" value="Enviar arquivo" />
</form>

<table class="table">
	<thead>
		<tr>
			<th>Nosso Número</th>
			<th>Código do Movimento</th>
			<th>Motivo da Reijeição</th>
			<th>Valor Pago</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($registros as $registro):?>
		<tr>
			<td><?=$registro->nosso_numero?></td>
			<td><?=$registro->codigo_movimento?></td>
			<td><?=$registro->motivo_rejeicao?></td>
			<td><?=$registro->vlr_pago?></td>
		</tr>
		<?php endforeach?>
	</tbody>
</table>