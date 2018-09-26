<?php
namespace CnabPHP\samples;
use \CnabPHP\Retorno;
include("../autoloader.php");
$fileContent = file_get_contents("COBST_QIAC_02_010617P_MOV.TXT");

$arquivo = new Retorno($fileContent);

$registros = $arquivo->getRegistros();
foreach($registros as $registro)
{
	if($registro->codigo_movimento==2){
		$nossoNumero   = $registro->nosso_numero;
		$valorRecebido = $registro->vlr_pago;
		$dataPagamento = $registro->data_ocorrencia;
		$carteira      = $registro->carteira;
        $vlr_juros_multa = $registro->valor;
        $vlr_desconto = $registro->vlr_desconto;
        echo $nossoNumero;
        echo $vlr_desconto;
        echo $dataPagamento;
        echo $vlr_juros_multa;
        var_dump($registro);
		// você ja pode dar baixa
	}
}
?>