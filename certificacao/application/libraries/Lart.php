<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use ManoelCampos\RetornoBoleto\LeituraArquivo;
use ManoelCampos\RetornoBoleto\RetornoFactory;
use ManoelCampos\RetornoBoleto\RetornoInterface;
use ManoelCampos\RetornoBoleto\LinhaArquivo;

class Lart {
	var $layout_1;
	var $layout_2;

	public function __construct() {
	/*******************************************************************************************/
		$this->layout_1 = function (RetornoInterface $retorno, LinhaArquivo $linha) {
			if($linha->dados["registro"] == $retorno->getIdHeaderArquivo()){
				echo "<table>\n";
				echo "<tr>
						<th>Linha</th>
						<th>Número Documento</th>
						<th>Nosso Número</th>
						<th>Data Pag</th>".
				"<th>Valor Título</th><th>Valor Pago</th></tr>\n";
			}
			else if($linha->dados["registro"] == $retorno->getIdTrailerArquivo()){
				echo "</table>\n";
			}
			else if($linha->dados["registro"] == $retorno->getIdDetalhe()){
				printf(
					"<tr>
						<td>%d</td>
						<td>%d</td>
						<td>%d</td>
						<td>%s</td>
						<td>%.2f</td>
						<td>%.2f</td>
					</tr>\n",
					$linha->numero,
					$linha->dados['num_documento'],
					$linha->dados['nosso_numero'],
					$linha->dados["data_pagamento"],
					$linha->dados["valor_titulo"],
					$linha->dados["valor_pagamento"]);
				echo "</tr>\n";
			}
		};
/*******************************************************************************************/
		$this->layout_2 = function (RetornoInterface $retorno, LinhaArquivo $linha) {
			if($linha->dados["registro"] == $retorno->getIdHeaderArquivo()){
				echo "<table>\n";
			}
			else if($linha->dados["registro"] == $retorno->getIdTrailerArquivo()){
				echo "</table>\n";
			}
			else {
				printf("<tr><th colspan='2'>Número da Linha: %08d</th></tr>\n", $linha->numero);
				foreach ($linha->dados as $nome_campo => $valor_campo){
					printf("<tr><td><b>%s</b></td><td>%s</td>\n ", $nome_campo, $valor_campo);
				}
				echo "</tr>\n";
			}
		};
	}
/*******************************************************************************************/
	public function getRetorno_1($fileName='')
	{
		$cnab400 = RetornoFactory::getRetorno($fileName);

		//$leitura = new LeituraArquivo($processarLinha1, $cnab400);
		$leitura = new LeituraArquivo($this->layout_2, $cnab400);

		$leitura->lerArquivoRetorno();
	}
/*******************************************************************************************/
/*******************************************************************************************/
/*******************************************************************************************/
}
/* End of file Someclass.php */