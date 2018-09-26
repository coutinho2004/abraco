<?php

class Boleto_model extends CI_Model
{
/***************************************************************************/
	function __construct()
	{
		parent::__construct();
	}
/***************************************************************************/
	public function campos()
	{
		$this->db->select('
			b.boletos_id AS id,
			b.boletos_nosso_numero AS pedido_numero,
			b.boletos_vencimento AS data_venc,
			b.boletos_emissao AS data_documento,
			b.boletos_valor AS pedido_valor_unitario,
			a.aluno_nome AS sacado_nome,
			a.aluno_cpf AS sacado_cpf_cnpj,
			a.aluno_endereco AS sacado_endereco,
			a.aluno_cidade AS sacado_cidade,
			e.estados_sigla AS sacado_uf,
			a.aluno_cep AS sacado_cep,
			a.aluno_email1 AS sacado_email'
		);
		$this->db->from('boletos AS b');
		$this->db->join('aluno AS a', 'a.aluno_id = b.boletos_aluno_id');
		$this->db->join('estados AS e', 'e.estados_id = a.aluno_estado');
		$this->db->order_by('boletos_id', 'desc');
	}
/***************************************************************************/
/*
 * Get boleto by id
 */
/***************************************************************************/
	function get_boleto($id)
	{
		$this->campos();
		return $this->db->where(array('b.boletos_id'=>$id))->get()->row_array();
	}
/***************************************************************************/
/*
 * Get all boletos count
 */
/***************************************************************************/
	function get_all_boletos_count()
	{
		$this->db->from('boletos');
		return $this->db->count_all_results();
	}
/***************************************************************************/
/*
 * Get all boletos
 */
/***************************************************************************/
	function get_all_boletos($params = array())
	{

		$this->campos();
		if(isset($params) && !empty($params))
		{
			$this->db->limit($params['limit'], $params['offset']);
		}
		return $this->db->get()->result_array();
	}
/***************************************************************************/
/*
 * Get all boletos sem remessa
 */
/***************************************************************************/
	function get_all_boletos_sem_remessa($params = array())
	{
		$this->campos();
		if(isset($params) && !empty($params))
		{
			$this->db->limit($params['limit'], $params['offset']);
		}
		$this->db->where(array('idRemessa' => 0,'boletos_nosso_numero <>'=>0));
		return $this->db->get()->result_array();
	}
/***************************************************************************/
/*
 * function to add new boleto
 */
/***************************************************************************/
	function add_boleto($params)
	{
		$this->db->insert('boletos',$params);
		return $this->db->insert_id();
	}
/***************************************************************************/
/*
 * function to update boleto
 */
/***************************************************************************/
	function update_boleto($id,$params)
	{
		$this->db->where('boletos_id',$id);
		return $this->db->update('boletos',$params);
	}
/***************************************************************************/
/*
 * function to delete boleto
 */
/***************************************************************************/
	function delete_boleto($id)
	{
		return $this->db->delete('boletos',array('boletos_id'=>$id));
	}
/***************************************************************************/
	function getBoletoByRemessa($id)
	{
		$this->campos();
		$this->db->where(array('idRemessa' => $id,'boletos_nosso_numero <>'=>0));
		return $this->db->get()->result_array();
	}
/***************************************************************************/
}