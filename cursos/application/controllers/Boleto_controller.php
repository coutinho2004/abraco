<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class Boleto_controller extends CI_Controller {
	var $params;
/*******************************************************************************/
	function __construct()
	{
		parent::__construct();

		$this->params  = array(
			'dias_de_prazo_para_pagamento' => $this->input->post('dias_de_prazo_para_pagamento'),
			'taxa_boleto' => 0,
			'pedido_quantidade' => $this->input->post('pedido_quantidade'),
			'pedido_nome' => $this->input->post('pedido_nome'),
			'pedido_valor_unitario' => $this->input->post('pedido_valor_unitario'),
			'sacado_snqc' => $this->input->post('sacado_snqc'),
			'sacado_nome' => $this->input->post('sacado_nome'),
			'sacado_cpf_cnpj' => $this->fbradesco->clearFormatacao($this->input->post('sacado_cpf_cnpj')),
			'sacado_endereco' => $this->input->post('sacado_endereco'),
			'sacado_cidade' => $this->input->post('sacado_cidade'),
			'sacado_uf' => $this->input->post('sacado_uf'),
			'sacado_cep' => $this->input->post('sacado_cep'),
			'instrucoes_linha1' => $this->input->post('instrucoes_linha1'),
			'instrucoes_linha2' => $this->input->post('instrucoes_linha2'),
			'instrucoes_linha3' => $this->input->post('instrucoes_linha3'),
			'instrucoes_linha4' => $this->input->post('instrucoes_linha4'),
			//'demonstrativo_linha1' => $msg['mensagem_nome'],
			//'demonstrativo_linha2' => $msg['conteudo'],
			'demonstrativo_linha3' => $this->input->post('demonstrativo_linha3'),
		);
	}
/*******************************************************************************/
/*
 * Listando boletos
 */
/*******************************************************************************/
	function index()
	{
		$params['limit'] = RECORDS_PER_PAGE;
		$params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

		$config = $this->config->item('pagination');
		$config['base_url'] = site_url('index.php/boleto/index?');
		$config['total_rows'] = $this->boletos->get_all_boletos_count();
		$this->pagination->initialize($config);

		$data['boletos'] = $this->boletos->get_all_boletos($params);

		foreach ($data['boletos'] as $key => $row) {
			$data['boletos'][$key]['sacado_cpf_cnpj'] = $this->fbradesco->poeZero(11,$row['sacado_cpf_cnpj']);
			$cpf_cnpj = new Validacpfcnpj($data['boletos'][$key]['sacado_cpf_cnpj']);
			$data['boletos'][$key]['v_cpf_cnpj'] = $cpf_cnpj->valida();

			$nnum = $this->fbradesco->nnum($row['pedido_numero']);

			$data['boletos'][$key]['nosso_numero'] = $nnum.'-'.$this->fbradesco->digitoVerificador_nossonumero($nnum);

			$data['boletos'][$key]['data_venc'] = $this->fbradesco->data_venc($row['data_documento'],1);
			$data['boletos'][$key]['valor_boleto'] = $this->fbradesco->valor_boleto(1,$row['pedido_valor_unitario'],0);

			$data['boletos'][$key]['status'] = 'Remessa';
		}

		$data['_view'] = 'boleto/index';
		$this->load->view('layouts/main',$data);
	}
/*******************************************************************************/
/*
 * Listando boletos com dataTables
 */
/*******************************************************************************/
	public function data_tables()
	{
		$t = new Datatables;

		$t->select('
			b.boletos_id AS id,
			b.boletos_nosso_numero AS pedido_numero,
			b.boletos_vencimento AS data_venc,
			b.boletos_emissao AS data_documento,
			b.boletos_valor AS pedido_valor_unitario,
			b.status,
			b.idRemessa,
			a.aluno_nome AS sacado_nome,
			a.aluno_cpf AS sacado_cpf_cnpj,
			a.aluno_endereco AS sacado_endereco,
			a.aluno_cidade AS sacado_cidade,
			e.estados_sigla AS sacado_uf,
			a.aluno_cep AS sacado_cep'
		)
		->from('boletos AS b')
		->join('aluno AS a', 'a.aluno_id = b.boletos_aluno_id')
		->join('estados AS e', 'e.estados_id = a.aluno_estado')
		->where('b.boletos_nosso_numero <>',0)
		->order_by('b.boletos_id', 'desc');

		$t->datatable('tabela_boletos') // table's id for html
			->column('Nome', 'sacado_nome')
			->column('CPF/CNPJ', 'sacado_cpf_cnpj',function($data, $row){
				$cpf_cnpj = new Validacpfcnpj($row['sacado_cpf_cnpj']);
				return ($cpf_cnpj->valida())?'<span style="color: blue;">'.$row['sacado_cpf_cnpj']. '<i class="fa fa-check" aria-hidden="true"></i></span>':'<span style="color: red;">'.$row['sacado_cpf_cnpj']. '<i class="fa fa-times" aria-hidden="true"></i></span>';
			})
			->column('Valor', 'pedido_valor_unitario',function($data, $row){
				return $this->fbradesco->valor_boleto(1,$row['pedido_valor_unitario'],0);
			})
			->column('Nosso Número', 'pedido_numero',function($data, $row){
				$nnum = $this->fbradesco->nnum($row['pedido_numero']);
				return $nnum.'-'.$this->fbradesco->digitoVerificador_nossonumero($nnum);
			})
			->column('Data de Vencimento', 'data_venc',function($data, $row){
				return $this->fbradesco->data_venc($row['data_venc'],0);
			})
			->column('Status', 'status')
			->column('Ações', 'id', function ($data, $row){
				//$str = '<a href="'.site_url("index.php/boleto/getBoleto/{$row['id']}").'" target="_Blank" class="btn btn-default btn-xs"><span class="fa fa-ticket"></span> Boleto</a>';
				$str = '';
				if($row['idRemessa']==-1){
					$cpf_cnpj = new Validacpfcnpj($row['sacado_cpf_cnpj']);
					if($cpf_cnpj->valida()){
						$str = ' | <a href="'.site_url("index.php/boleto/adicionarCNAB/{$row['id']}").'" class="btn btn-success btn-xs"><span class="fa fa-ticket"></span> Add CNAB</a>';
					}
				}
				return $str;
			});

		$t->init();

		$data['_view'] = 'boleto/dataTables';
		$this->load->view('layouts/main',$data);
	}
/*******************************************************************************/
/*
 * get boleto
 */
/*******************************************************************************/
	function getBoleto($id)
	{
		$boleto = $this->boletos->get_boleto($id);

		// check if the boleto exists before trying to delete it
		if(isset($boleto['id']))
		{

			$cpf_cnpj = new Validacpfcnpj($boleto['sacado_cpf_cnpj']);

			$dados = array(
				// Informações necessárias para todos os bancos
				'data_documento' => $boleto['data_documento'],
				'dias_de_prazo_para_pagamento' => 0,
				'taxa_boleto'                  => 0,
				'cedente' =>  array(
					'nome'			=> CEDENTE_NOME,
					'cpf_cnpj'		=> CEDENTE_CNPJ,
					'agencia'		=> CEDENTE_AGENCIA,
					'conta'			=> CEDENTE_CONTA,
					'conta_cedente'	=> CEDENTE_CONTA,
					'carteira'		=> CEDENTE_CARTEIRA,
					'nosso_numero'	=> $boleto['pedido_numero'],
					'endereco'		=> CEDENTE_ENDERECO,
					'cidade'		=> CEDENTE_CIDADE,
					'uf'			=> CEDENTE_UF,
				),
				'pedido'                       => array(
				//	'nome'           => 'Serviços de Desenvolvimento Web',
					'quantidade'     => 1,
					'valor_unitario' => number_format($boleto['pedido_valor_unitario'],'2', ',', ''),
					'numero'         => $boleto['pedido_numero'],
					'aceite'         => 'N',
					'especie'        => 'R$',
					'especie_doc'    => 'DM',
				),
				'sacado'                       => array(
					'cpf_cnpj' => $cpf_cnpj->formata(),
					'nome'     => $boleto['sacado_nome'],
					'endereco' => $boleto['sacado_endereco'],
					'cidade'   => $boleto['sacado_cidade'],
					'uf'       => $boleto['sacado_uf'],
					'cep'      => $boleto['sacado_cep'],
				),
				'demonstrativo'		=> array(
					'linha1' => '',//$boleto['demonstrativo_linha1'],
					'linha2' => '',//$boleto['demonstrativo_linha2'],
					'linha3' => '',//$boleto['demonstrativo_linha3'],
					'linha4' => '',
				),
				'instrucoes'		=> array(
					'linha1' => "- Sr. Caixa, não receber após o vencimento",
					'linha2' => "- Receber apenas em sua totalidade",
					'linha3' => "- Em caso de dúvidas entre em contato conosco: (21) 2516-1962 Ramal 35",
					'linha4' => "",
				)
			);

			// Gera o boleto
			$this->boleto->bradesco($dados);
		}
		else
			show_error('O Boleto que você está tentando abrir não existe.');
	}
/*******************************************************************************/
	public function validacao()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('dias_de_prazo_para_pagamento','Dias De Prazo Para Pagamento','required');
		//$this->form_validation->set_rules('taxa_boleto','Taxa Boleto','required');
		$this->form_validation->set_rules('pedido_quantidade','Pedido Quantidade','required');
		$this->form_validation->set_rules('pedido_valor_unitario','Pedido Valor Unitario','required|decimal');
		$this->form_validation->set_rules('sacado_nome','Sacado Nome','required');
		$this->form_validation->set_rules('sacado_cpf_cnpj','Sacado Cpf Cnpj','required');
		$this->form_validation->set_rules('sacado_endereco','Sacado Endereco','required');
		$this->form_validation->set_rules('sacado_cidade','Sacado Cidade','required');
		$this->form_validation->set_rules('sacado_uf','Sacado Uf','required');
		$this->form_validation->set_rules('sacado_cep','Sacado Cep','required');
		$this->form_validation->set_rules('instrucoes_linha1','Instruções','required');
		$this->form_validation->set_rules('demonstrativo_linha1','Demonstrativo','required');
	}
/*******************************************************************************/
	function adicionarCNAB($id)
	{
		// check if the boleto exists before trying to edit it
		$data['boleto'] = $this->boletos->get_boleto($id);

		if(isset($data['boleto']['id']))
		{
			$this->boletos->update_boleto($id,array('idRemessa'=>0));
			redirect('index.php/listarboleto');
		}
		else
			show_error('O boleto que você está tentado editar não existe.');
	}
/*******************************************************************************/
}
