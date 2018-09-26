<?php
/**
 * CodeIgniter Boleto
 *
 * @package    CodeIgniter Boleto
 * @author     Natan Felles
 * @link       https://github.com/natanfelles/codeigniter-boleto
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Cnab_controller extends CI_Controller {
/********************************************************************/
	public function __construct()
	{
		parent::__construct();
	}
/********************************************************************/
	function listaRemessa()
	{
		$params['limit'] = RECORDS_PER_PAGE;
		$params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

		$config = $this->config->item('pagination');
		$config['base_url'] = site_url('index.php/cnab/listaRemessa?');
		$config['total_rows'] = $this->remessas->get_all_remessa_count();
		$this->pagination->initialize($config);

		$data['boletos'] = $this->remessas->get_all_remessa($params);

		$data['_view'] = 'cnab/listaRemessa';
		$this->load->view('layouts/main',$data);
	}
/********************************************************************/
	public function findRetorno()
	{
		$data['_view'] = 'cnab/getRetorno';
		$this->load->view('layouts/main',$data);
	}
/********************************************************************/
	public function getRetorno()
	{

		$file = $_FILES['arq_ret']['tmp_name'];
		$arquivo = file($file);

		//CAPTURA A EXTENSÃO DO ARQUIVO
		$_UP['extensoes'] = array('ret','rst');
		$extensao = @strtolower(@end(@explode('.', $_FILES['arq_ret']['name'])));

		//VERIFICA A EXTENSÃO DO ARQUIVO
		if (array_search($extensao, $_UP['extensoes']) === false ){//||  mime_content_type($file) != 'text/plain') {
			echo "<center><h1>Por favor, envie arquivos .ret</h1></center> ";
			exit;
		}else{
			//$fp = fopen($file, "r");
			//$content = fread( $fp, filesize($file) );
			$this->lart->getRetorno_1($file);
		}
		//$data['_view'] = 'cnab/findRetorno';
		//$this->load->view('layouts/main',$data);
	}
/********************************************************************/
	public function geraremessa()
	{

		$params['limit'] = 100;
		$params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$data['boletos'] = $this->boletos->get_all_boletos_sem_remessa($params);

		foreach ($data['boletos'] as $key => $row) {
			$cpf_cnpj = new Validacpfcnpj($row['sacado_cpf_cnpj']);
			$data['boletos'][$key]['v_cpf_cnpj'] = $cpf_cnpj->valida();
			$data['boletos'][$key]['v_cep'] = $this->validaCep($row['sacado_cep']);

			$data['boletos'][$key]['nosso_numero'] = $this->fbradesco->nnum($row['pedido_numero']).'-'.$this->dv_nosso_numero($row['pedido_numero']);

			$data['boletos'][$key]['data_venc'] = $this->data_vencimento($row['data_venc'],DIAS_DE_PRAZO_PARA_PAGAMENTO);
			$data['boletos'][$key]['valor_boleto'] = $this->fbradesco->valor_boleto(1,$row['pedido_valor_unitario'],TAXA_BOLETO);
		}


		$data['_view'] = 'cnab/geraremessa';
		$this->load->view('layouts/main',$data);
	}
/********************************************************************/
	public function retorno()
	{
		$this->cnab->retorno_bradesco(array());
	}
/********************************************************************/
	public function garb()
	{
		//Incluiu na tabela remessa
		$nome = $this->remessas->getNome();
		$id = $this->addRemessa($nome);
		$qry = $this->boletos->getBoletoByRemessa(0);

		$this->criarArquivoRemessa(true,$id,$nome,$qry);
	}
/**********************************************************************/
	public function getGarb($id=0)
	{
		$r = $this->remessas->get_remessa($id);
		$nome = $r['nome'];
		$qry = $this->boletos->getBoletoByRemessa($id);

		$this->criarArquivoRemessa(false,$id,$nome,$qry);
	}
/**********************************************************************/
	private function addRemessa($nome=''){
		$params = array(
			'nome' => $nome,
			'data_criacao' => date('Y-m-d'),
		);

		return $this->remessas->add_remessa($params);
	}
/**********************************************************************/
	private function clearFormatacao($str){
		return str_replace(",", "",str_replace("/", "", str_replace("-", "", str_replace(".", "", $str))));
	}
/********************************************************************/
	private function poeZero($n,$str){$t = strlen($str);if($n > $t){for($i=0; $i<($n-$t); $i++){$str = "0".$str;}}return $str;}
/********************************************************************/
	private function dv_nosso_numero($pedido_numero=0){
		return $this->fbradesco->digitoVerificador_nossonumero($this->fbradesco->nnum($pedido_numero));
	}
/********************************************************************/
	private function data_vencimento($data_documento='0000-00-00',$dias_de_prazo_para_pagamento=0){
		return $this->fbradesco->data_venc($data_documento,$dias_de_prazo_para_pagamento);
	}
/********************************************************************/
	public function salvarRemessa($dados,$nome){
		//$path = 'public/uploads/fcc/fcc.txt';
		$path = PATHREMESSA.$nome;
		$this->load->helper('file');

		if(!write_file($path,$dados)){
			echo 'Erro nao pode criar o arquivo';
		}else{
			header('Content-Description: File Transfer');
			header('Content-Disposition: attachment; filename="'.$nome.'"');
			header('Content-Type: application/octet-stream');
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . filesize($path));
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Expires: 0');
			// Envia o arquivo para o cliente
			readfile($path);
		}
	}
/********************************************************************/
	public function criarArquivoRemessa($idNovo=false,$id,$nome,$qry)
	{
		$this->load->library('garb');

		//configurando o arquivo de remessa
		$config['codigo_empresa'] = CEDENTE_NUMERO_CLIENTE;//Acessório escritural (número do cliente)
		$config['razao_social'] = substr(CEDENTE_NOME,0,30);
		$config['data_gravacao'] = date('dmy');
		$config['numero_remessa'] = $this->poeZero(7,$id);//'0000001';//tem que ser autoincremento como id da tabela

		$garb = new Garb();
		//configurando remessa
		$garb->config($config);

		//Loop dos Boletos
		foreach ($qry as $row){

			$data_venc = $this->data_vencimento($row['data_venc'],DIAS_DE_PRAZO_PARA_PAGAMENTO);
			$valor_boleto = $this->fbradesco->valor_boleto(1,$row['pedido_valor_unitario'],TAXA_BOLETO);

			$o = new Validacpfcnpj($row['sacado_cpf_cnpj']);
			if($o->valida()){
				$documento = $o->tipo();
				$cpf_cnpj = $o->zeroEsquerda();
			}

			$cep = explode('-', $row['sacado_cep']);

			$boleto['razao_conta_corrente']			= '0';//opcional
			$boleto['agencia'] 						= CEDENTE_AG;
			$boleto['agencia_dv'] 					= CEDENTE_AG_DV;
			$boleto['conta'] 						= CEDENTE_CC;
			$boleto['conta_dv'] 					= CEDENTE_CC_DV;
			$boleto['carteira'] 					= CEDENTE_CARTEIRA;
			$boleto['numero_controle'] 				= $row['pedido_numero'];
			$boleto['habilitar_debito_compensacao'] = false;
			$boleto['habilitar_multa'] 				= false;
			$boleto['percentual_multa'] 			= '0';
			$boleto['nosso_numero'] 				= $row['pedido_numero'];
			$boleto['nosso_numero_dv'] 				= $this->dv_nosso_numero($row['pedido_numero']);
			$boleto['desconto_dia']	 				= '0';
			$boleto['rateio'] 						= false;
			$boleto['numero_documento'] 			= substr($row['pedido_numero'],4,7);
			$boleto['vencimento'] 					= $this->f_data($data_venc);
			$boleto['valor'] 						= $this->clearFormatacao($valor_boleto);
			$boleto['data_emissao_titulo'] 			= date('dmy', strtotime($row['data_documento']));
			$boleto['valor_dia_atraso'] 			= '0';
			$boleto['data_limite_desconto'] 		= '000000';
			$boleto['valor_desconto'] 				= '0';
			$boleto['valor_iof'] 					= '0';
			$boleto['valor_abatimento_concedido'] 	= '0';
			$boleto['tipo_inscricao_pagador'] 		= $documento;
			$boleto['numero_inscricao'] 			= $cpf_cnpj;
			$boleto['nome_pagador'] 				= convert_accented_characters(substr($row['sacado_nome'],0,40));
			$boleto['endereco_pagador'] 			= convert_accented_characters(substr($row['sacado_endereco'],0,40));
			$boleto['primeira_mensagem'] 			= '';//convert_accented_characters(substr($row['demonstrativo_linha1'],0,12));
			$boleto['cep_pagador'] 					= $cep[0];
			$boleto['sufixo_cep_pagador'] 			= $cep[1];
			$boleto['sacador_segunda_mensagem'] 	= '';

			//adicionando boleto
			$garb->add_boleto($boleto);
			if($idNovo){
				//adiciona o idRemessa na tabela dados_boletos
				$this->boletos->update_boleto($row['id'],array('status'=>'Remessa','idRemessa'=>$id));
			}
		}

		$this->salvarRemessa($garb->get_text(),$nome.'.rem');
		if($idNovo){
			$path = PATHREMESSA;
			$garb->setFilename("$path$nome");
			$garb->save();
		}

	}
/********************************************************************/
	public function listarArquivos(){
		$map = directory_map('./resources/remessa');
		$data['map'] = $map;
		$data['_view'] = 'cnab/listarArquivo';
		$this->load->view('layouts/main',$data);
	}
/********************************************************************/
	function validaCep($valor){
		return (preg_match('/[0-9]{5,5}([-]?[0-9]{3})?$/', $valor));
	}
/********************************************************************/
	public function f_data($value=''){
		$venData = explode('/', $value);

		return $venData[0].$venData[1].substr($venData[2], 2);
	}
/********************************************************************/
	public function exportarRemessa($id='')
	{
		//Pega o nome do arquivo remessa
		$o = $this->remessas->get_remessa($id);
		$title = $o['nome'];
		$this->load->library('excel');

		$this->excel->getProperties()->setCreator("Sistema ABRACO")
				->setLastModifiedBy("Modificado por...")
				->setTitle("Arquivo Remessa {$title}")
				->setSubject("Exportação de Dados");

		$this->excel->setActiveSheetIndex(0)
		->setCellValue('A1', 'Nome')
		->setCellValue('B1', 'CPF/CNPJ')
		->setCellValue('C1', 'Endereço')
		->setCellValue('D1', 'Cidade')
		->setCellValue('E1', 'CEP')
		->setCellValue('F1', 'UF')
		->setCellValue('G1', 'Nosso Número')
		->setCellValue('H1', 'Valor')
		->setCellValue('I1', 'E-mail')
		;
		//Loop para popular o arquivo
		$dados = $this->boletos->getBoletoByRemessa($id);

		$i=2;
		foreach ($dados as $rw){
			$o = new Validacpfcnpj($rw['sacado_cpf_cnpj']);
			$this->excel->setActiveSheetIndex(0)
			->setCellValue('A'.$i, $rw['sacado_nome'])
			->setCellValue('B'.$i, $o->formata())
			->setCellValue('C'.$i, $rw['sacado_endereco'])
			->setCellValue('D'.$i, $rw['sacado_cidade'])
			->setCellValue('E'.$i, $rw['sacado_cep'])
			->setCellValue('F'.$i, $rw['sacado_uf'])
			->setCellValue('G'.$i, $rw['pedido_numero'])
			->setCellValue('H'.$i, $rw['pedido_valor_unitario'])
			->setCellValue('I'.$i, $rw['sacado_email'])
			;
			$i++;
		}

		// Definir a largura da coluna A para automático/auto-ajustar
		$this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);

		// Formatar a célula A1 a negrito
		$this->excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);


		// Indicação da criação do ficheiro
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		// Encaminhar o ficheiro resultante para abrir no browser ou fazer download
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$title.'.xls"');
		header('Cache-Control: max-age=0');
		$objWriter->save('php://output');
	}
/*******************************************************************************/
	function retirarCNAB($id)
	{
		// check if the boleto exists before trying to edit it
		$data['boleto'] = $this->boletos->get_boleto($id);

		if(isset($data['boleto']['id']))
		{
			$this->boletos->update_boleto($id,array('idRemessa'=>-1));
			redirect('index.php/cnab/geraremessa');
		}
		else
			show_error('O boleto que você está tentado editar não existe.');
	}
/********************************************************************/
}
