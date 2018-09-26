<?php
namespace CnabPHP\samples;
use \CnabPHP\Retorno;
include("../autoloader.php");
$fileContent = file_get_contents("R2100095.RET");

$arquivo = new Retorno($fileContent);

$registros = $arquivo->getRegistros();
foreach($registros as $registro)
{
	if($registro->R3U->codigo_movimento==6){
		$nossoNumero   = $registro->nosso_numero;
		$valorRecebido = $registro->vlr_pago;
		$dataPagamento = $registro->R3U->data_ocorrencia;
		$carteira      = $registro->carteira;
        $vlr_juros_multa = $registro->valor;
        $vlr_desconto = $registro->R3U->vlr_desconto;
        echo $nossoNumero;
        echo $vlr_desconto;
        echo $dataPagamento;
        echo $vlr_juros_multa;
        echo $registro;
		// você ja pode dar baixa
	}
    //echo $registro;
}
?>