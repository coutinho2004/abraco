<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'garb/Arquivo.php';
/**
 *
 * GARB - GERADOR DE ARQUIVOS DE REMESSA BRADESCO
 *
 * @author Thiago Henrique
 *
 * PATA TESTE
 * Para a realização do teste, poderá ser transmitido quantos Arquivos Remessa lhes convier,
 * porém, gravados com todos os dados fictícios, exigidos no Lay-out, e deverá conter no
 * máximo 10 registros a vencer. Após a oficialização, os Arquivos Remessa poderão conter
 * quantos registros lhes convier. Os arquivos não devem em hipótese alguma seres compactados
 * e sim zonados, bem como os registros devem ser de acordo com as especificações do Lay-out.
 *
 * CBDDMM??.REM
 *	CB é Cobrança Bradesco
 *	DD é O Dia geração do arquivo
 *	MM é O Mês da geração do Arquivo
 *	?? - variáveis alfanumérico-Numéricas
 *	Ex.: 01, AB, A1 etc.
 * Nota: Quando se tratar de arquivo remessa para teste, a extensão deverá ser TST.
 */
class Garb extends Arquivo {
	public function __construct() {

	}

	public function gerarArquivo($nome='',$boletos)
	{
		# code...
	}
}
/* End of file Someclass.php */