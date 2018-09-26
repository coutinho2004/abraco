<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fbradesco
{

/**************************************************************/
	function __construct ( $valor = null )
	{
		
	}
/**************************************************************/
	function data_venc($data_documento,$dias_de_prazo_para_pagamento){
		return date("d/m/Y", strtotime($data_documento) + ($dias_de_prazo_para_pagamento * 86400));
	}
/**************************************************************/
	function modulo_11($num, $base=9, $r=0)  {
		$soma = 0;
		$fator = 2;

		/* Separacao dos numeros */
		for ($i = strlen($num); $i > 0; $i--) {
			// pega cada numero isoladamente
			$numeros[$i] = substr($num,$i-1,1);
			// Efetua multiplicacao do numero pelo falor
			$parcial[$i] = $numeros[$i] * $fator;
			// Soma dos digitos
			$soma += $parcial[$i];
			if ($fator == $base) {
				// restaura fator de multiplicacao para 2
				$fator = 1;
			}
			$fator++;
		}

		/* Calculo do modulo 11 */
		if ($r == 0) {
			$soma *= 10;
			$digito = $soma % 11;
			if ($digito == 10) {
				$digito = 0;
			}
			return $digito;
		} elseif ($r == 1){
			$resto = $soma % 11;
			return $resto;
		}
	}
/**************************************************************/
	function nnum($pedido_numero=0){
		return $this->formata_numero(CEDENTE_CARTEIRA,2,0).$this->formata_numero($pedido_numero,11,0);
	}
/**************************************************************/
	function digitoVerificador_nossonumero($numero) {
		$resto2 = $this->modulo_11($numero, 7, 1);
		$digito = 11 - $resto2;
		if ($digito == 10) {
			$dv = "P";
		} elseif($digito == 11) {
			$dv = 0;
		} else {
			$dv = $digito;
		}
		return $dv;
	}
/**************************************************************/
	function formata_numero($numero,$loop,$insert,$tipo = "geral") {
		if ($tipo == "geral") {
			$numero = str_replace(",","",$numero);
			while(strlen($numero)<$loop){
				$numero = $insert . $numero;
			}
		}
		if ($tipo == "valor") {
			/*
			retira as virgulas
			formata o numero
			preenche com zeros
			*/
			$numero = str_replace(",","",$numero);
			while(strlen($numero)<$loop){
				$numero = $insert . $numero;
			}
		}
		if ($tipo == "convenio") {
			while(strlen($numero)<$loop){
				$numero = $numero . $insert;
			}
		}
		return $numero;
	}
/**************************************************************/
	function fator_vencimento($data) {
		$data = explode("/",$data);
		$ano = $data[2];
		$mes = $data[1];
		$dia = $data[0];
		return(abs((_dateToDays("1997","10","07")) - (_dateToDays($ano, $mes, $dia))));
	}
/**************************************************************/
	function _dateToDays($year,$month,$day) {
		$century = substr($year, 0, 2);
		$year = substr($year, 2, 2);
		if ($month > 2) {
			$month -= 3;
		} else {
			$month += 9;
			if ($year) {
				$year--;
			} else {
				$year = 99;
				$century --;
			}
		}
		return ( floor((  146097 * $century)    /  4 ) +
			floor(( 1461 * $year)        /  4 ) +
			floor(( 153 * $month +  2) /  5 ) +
			$day +  1721119);
	}
/**************************************************************/
	function valor_boleto($quantidade,$valor_unitario,$taxa_boleto){
		$valor_cobrado = $quantidade * $valor_unitario; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
		$valor_cobrado = str_replace(",", ".",$valor_cobrado);
		return number_format($valor_cobrado+$taxa_boleto, 2, ',', '');
	}
/**************************************************************/
	function clearFormatacao($str){
		return str_replace(",", "",str_replace("/", "", str_replace("-", "", str_replace(".", "", $str))));
	}
/********************************************************************/
	function poeZero($n,$str){$t = strlen($str);if($n > $t){for($i=0; $i<($n-$t); $i++){$str = "0".$str;}}return $str;}
/**************************************************************/
/**************************************************************/
}
?>