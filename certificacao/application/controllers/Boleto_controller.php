<?php
header('Access-Control-Allow-Origin: *');

defined('BASEPATH') OR exit('No direct script access allowed');

class Boleto_controller extends CI_Controller {
	var $params;
/*******************************************************************************/
	function __construct()
	{
		parent::__construct();
		$this->load->library('boleto');

		if (!$this->ion_auth->logged_in()){
			redirect('index.php/auth', 'refresh');
		}

		$msg = $this->message->getMensagem($this->input->post('demonstrativo_linha1'));
		$this->params  = array(
			'dias_de_prazo_para_pagamento' => 0,
			'data_vencimento' => $this->input->post('data_vencimento'),
			'taxa_boleto' => 0,
			'pedido_quantidade' => 1,
			'pedido_nome' => $this->input->post('pedido_nome'),
			'pedido_valor_unitario' => $this->input->post('pedido_valor_unitario'),
			'sacado_snqc' => isset($_POST['sacado_snqc'])?$this->input->post('sacado_snqc'):0,
			'sacado_nome' => $this->input->post('sacado_nome'),
			'sacado_email' => $this->input->post('sacado_email'),
			'sacado_cpf_cnpj' => $this->fbradesco->clearFormatacao($this->input->post('sacado_cpf_cnpj')),
			'sacado_endereco' => $this->input->post('sacado_endereco'),
			'sacado_cidade' => $this->input->post('sacado_cidade'),
			'sacado_uf' => $this->input->post('sacado_uf'),
			'sacado_cep' => $this->input->post('sacado_cep'),
			'instrucoes_linha1' => $this->input->post('instrucoes_linha1'),
			'instrucoes_linha2' => $this->input->post('instrucoes_linha2'),
			'instrucoes_linha3' => $this->input->post('instrucoes_linha3'),
			'instrucoes_linha4' => $this->input->post('instrucoes_linha4'),
			'demonstrativo_linha1' => $msg['mensagem_nome'],
			'demonstrativo_linha2' => $msg['conteudo'],
			'demonstrativo_linha3' => $this->input->post('demonstrativo_linha3'),
			//'demonstrativo_linha1' => $this->input->post('demonstrativo_linha1'),
			//'demonstrativo_linha2' => $this->input->post('demonstrativo_linha2'),
		);
	}
/*******************************************************************************/
/*
 * Listar boletos
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
			$cpf_cnpj = new Validacpfcnpj($row['sacado_cpf_cnpj']);

			$data['boletos'][$key]['sacado_cpf_cnpj'] = $cpf_cnpj->formata();
			$data['boletos'][$key]['v_cpf_cnpj'] = $cpf_cnpj->valida();

			$nnum = $this->fbradesco->nnum($row['pedido_numero']);

			$data['boletos'][$key]['nosso_numero'] = $nnum.'-'.$this->fbradesco->digitoVerificador_nossonumero($nnum);

			$data['boletos'][$key]['data_venc'] = $this->fbradesco->data_venc($row['data_documento'],$row['dias_de_prazo_para_pagamento']);
			$data['boletos'][$key]['valor_boleto'] = $this->fbradesco->valor_boleto(1,$row['pedido_valor_unitario'],$row['taxa_boleto']);
		}

		$data['_view'] = 'boleto/index';
		$this->load->view('layouts/main',$data);
	}
/*******************************************************************************/
/*
 * Listar boletos com dataTables
 */
/*******************************************************************************/
	public function data_tables()
	{
		$t = new Datatables;

		$t->select('
			id,
			sacado_nome,
			sacado_cpf_cnpj,
			sacado_cep,
			pedido_valor_unitario,
			taxa_boleto,
			pedido_numero,
			data_documento,
			data_vencimento,
			dias_de_prazo_para_pagamento,
			status
		')
		->from('boleto')
		->order_by('id desc');

		$t->datatable('tabela_boletos') // table's id for html
			->set_options('searching', 'true')
			->searchable('sacado_nome, sacado_cpf_cnpj, pedido_numero')
			->style(array(
				'class' => 'table table-bordered table-striped',
			))
			->column('Nome', 'sacado_nome')
			->column('CPF/CNPJ', 'sacado_cpf_cnpj',function($data, $row){
				$o = new Validacpfcnpj($row['sacado_cpf_cnpj']);
				return ($o->valida())?'<span style="color: blue;">'.$o->formata().'<i class="fa fa-check" aria-hidden="true"></i></span>':'<span style="color: red;">'.$o->formata().'<i class="fa fa-times" aria-hidden="true"></i></span>';
			})
			->column('CEP','sacado_cep',function($data, $row){
				return ($this->validaCep($row['sacado_cep']))?'<span style="color: blue;">'.$row['sacado_cep'].'<i class="fa fa-check" aria-hidden="true"></i></span>':'<span style="color: red;">'.$row['sacado_cep'].'<i class="fa fa-times" aria-hidden="true"></i></span>';
			})
			->column('Valor do Boleto', 'pedido_valor_unitario',function($data, $row){
				return $this->fbradesco->valor_boleto(1,$row['pedido_valor_unitario'],$row['taxa_boleto']);
			})
			->column('Data do Vencimento', 'data_documento',function($data, $row){
				return date('d/m/Y', strtotime($row['data_vencimento']));
			})
			->column('Nosso Número', 'pedido_numero',function($data, $row){
				$nnum = $this->fbradesco->nnum($row['pedido_numero']);
				return $nnum.'-'.$this->fbradesco->digitoVerificador_nossonumero($nnum);
			})
			->column('Status', 'status')
			->column('Ações', 'id', function ($data, $row){
				$str = '<a href="'.site_url("index.php/boleto/edit/{$row['id']}").'" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Editar</a> | ';
				$str .= '<a href="'.site_url("index.php/boleto/remove/{$row['id']}").'" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Deletar</a> | ';
				$str .= '<a href="'.site_url("index.php/boleto/getBoleto/{$row['id']}").'" target="_Blank" class="btn btn-default btn-xs"><span class="fa fa-ticket"></span> Boleto</a>';
				return $str;
			});

		$t->init();

		$data['_view'] = 'boleto/dataTables';
		$this->load->view('layouts/main',$data);
	}
/*******************************************************************************/
/*
 * Criar um novo boleto
 */
/*******************************************************************************/
	function add()
	{

		$this->validacao();

		if($this->form_validation->run())
		{

			$this->params['data_documento'] = date('Y-m-d');
			//Pega o nosso_numero
			$nm = $this->nossoNumero->getNossoNumero(1);
			$this->params['pedido_numero'] = ($nm['numero']+1);
			$boleto_id = $this->boletos->add_boleto($this->params);
			$this->nossoNumero->update(1,array('numero'=> ($nm['numero']+1)));
			redirect('index.php/boleto/index');
		}
		else
		{
			$data['idAluno'] = false;
			$data['message'] = $this->message->getAll();
			$data['_view'] = 'boleto/add';
			$this->load->view('layouts/main',$data);
		}
	}
/*******************************************************************************/
/*
 * Editando um boleto
 */
/*******************************************************************************/
	function edit($id)
	{
		// check if the boleto exists before trying to edit it
		$data['boleto'] = $this->boletos->get_boleto($id);
		if(isset($data['boleto']['id']))
		{
			$this->validacao();

			if($this->form_validation->run())
			{

				$this->boletos->update_boleto($id,$this->params);
				redirect('index.php/boleto/index');
			}
			else
			{
				$o = new Validacpfcnpj($data['boleto']['sacado_cpf_cnpj']);
				$data['boleto']['sacado_cpf_cnpj'] = $o->formata();
				$data['message'] = $this->message->getAll();
				$data['_view'] = 'boleto/edit';
				$this->load->view('layouts/main',$data);
			}
		}
		else
			show_error('O boleto que você está tentado editar não existe.');
	}
/*******************************************************************************/
/*
 * Deletando um boleto
 */
/*******************************************************************************/
	function remove($id)
	{
		$boleto = $this->boletos->get_boleto($id);

		// check if the boleto exists before trying to delete it
		if(isset($boleto['id']))
		{
			$this->boletos->delete_boleto($id);
			redirect('index.php/boleto/index');
		}
		else
			show_error('O Boleto que você está tentando deletar não existe.');
	}
/*******************************************************************************/
/*
 * find Aluno para boleto
 */
/*******************************************************************************/
	function findAluno(){
		$data['_view'] = 'boleto/findAluno';
		$this->load->view('layouts/main',$data);
	}
/*******************************************************************************/
/*
 * get Aluno para boleto
 */
/*******************************************************************************/
	function getAluno(){
		$id = $this->input->post('snqc');
		$data['aluno'] = $this->alunos->getSnqc($id);
		if(isset($data['aluno']['id'])){
			$data['idAluno'] = true;
			$data['message'] = $this->message->getAll();
			$data['_view'] = 'boleto/add';
			$this->load->view('layouts/main',$data);
		}else
			show_error('O Aluno pesquisado não foi encontrado.');
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

			$cpf_cnpj = new Validacpfcnpj($this->fbradesco->poeZero(11,$boleto['sacado_cpf_cnpj']));

			$dados = array(
				// Informações necessárias para todos os bancos
				'data_documento' => $boleto['data_documento'],
				'data_vencimento' => $boleto['data_vencimento'],
				'dias_de_prazo_para_pagamento' => $boleto['dias_de_prazo_para_pagamento'],
				'taxa_boleto'                  => $boleto['taxa_boleto'],
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
					'quantidade'     => $boleto['pedido_quantidade'],
					'valor_unitario' => $boleto['pedido_valor_unitario'],
					'numero'         => $boleto['pedido_numero'],
					'aceite'         => 'N',
					'especie'        => 'R$',
					'especie_doc'    => 'DM',
				),
				'sacado'                       => array(
					'cpf_cnpj' => $cpf_cnpj->formata(),
					'snqc'     => $boleto['sacado_snqc'],
					'email'     => $boleto['sacado_email'],
					'nome'     => $boleto['sacado_nome'],
					'endereco' => $boleto['sacado_endereco'],
					'cidade'   => $boleto['sacado_cidade'],
					'uf'       => $boleto['sacado_uf'],
					'cep'      => $boleto['sacado_cep'],
				),
				'demonstrativo'		=> array(
					'linha1' => $boleto['demonstrativo_linha1'],
					'linha2' => $boleto['demonstrativo_linha2'],
					'linha3' => $boleto['demonstrativo_linha3'],
					'linha4' => '',
				),
				'instrucoes'		=> array(
					'linha1' => $boleto['instrucoes_linha1'],
					'linha2' => $boleto['instrucoes_linha2'],
					'linha3' => $boleto['instrucoes_linha3'],
					'linha4' => $boleto['instrucoes_linha4'],
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

		//$this->form_validation->set_rules('dias_de_prazo_para_pagamento','Dias De Prazo Para Pagamento','required');
		$this->form_validation->set_rules('data_vencimento','Data de Vencimento','required');
		//$this->form_validation->set_rules('pedido_quantidade','Pedido Quantidade','required');
		$this->form_validation->set_rules('pedido_valor_unitario','Pedido Valor Unitario','required|decimal');
		$this->form_validation->set_rules('sacado_nome','Sacado Nome','required');
		$this->form_validation->set_rules('sacado_email','Sacado E-mail','required');
		$this->form_validation->set_rules('sacado_cpf_cnpj','Sacado Cpf Cnpj','required');
		$this->form_validation->set_rules('sacado_endereco','Sacado Endereco','required');
		$this->form_validation->set_rules('sacado_cidade','Sacado Cidade','required');
		$this->form_validation->set_rules('sacado_uf','Sacado Uf','required');
		$this->form_validation->set_rules('sacado_cep','Sacado Cep','required');
		$this->form_validation->set_rules('instrucoes_linha1','Instruções','required');
		$this->form_validation->set_rules('demonstrativo_linha1','Demonstrativo','required');
	}
/*******************************************************************************/
	function validaCep($valor){
		return (preg_match('/[0-9]{5,5}([-]?[0-9]{3})?$/', $valor));
	}
/*******************************************************************************/
}
