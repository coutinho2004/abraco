<?php

class Boleto_model extends CI_Model
{
/***************************************************************************/
	function __construct()
	{
		parent::__construct();
	}
/***************************************************************************/
/*
 * Get boleto by id
 */
/***************************************************************************/
	function get_boleto($id)
	{
		return $this->db->get_where('boleto',array('id'=>$id))->row_array();
	}
/***************************************************************************/
/*
 * Get all boletos count
 */
/***************************************************************************/
	function get_all_boletos_count()
	{
		$this->db->from('boleto');
		return $this->db->count_all_results();
	}
/***************************************************************************/
/*
 * Get all boletos
 */
/***************************************************************************/
	function get_all_boletos($params = array())
	{
		$this->db->order_by('id', 'desc');
		if(isset($params) && !empty($params))
		{
			$this->db->limit($params['limit'], $params['offset']);
		}
		return $this->db->get('boleto')->result_array();
	}
/***************************************************************************/
/*
 * Get all boletos sem remessa
 */
/***************************************************************************/
	function get_all_boletos_sem_remessa($params = array())
	{
		$this->db->order_by('id', 'desc');
		if(isset($params) && !empty($params))
		{
			$this->db->limit($params['limit'], $params['offset']);
		}
		return $this->db->get_where('boleto', array('idRemessa' => 0))->result_array();
	}
/***************************************************************************/
/*
 * function to add new boleto
 */
/***************************************************************************/
	function add_boleto($params)
	{
		$this->db->insert('boleto',$params);
		return $this->db->insert_id();
	}
/***************************************************************************/
/*
 * function to update boleto
 */
/***************************************************************************/
	function update_boleto($id,$params)
	{
		$this->db->where('id',$id);
		return $this->db->update('boleto',$params);
	}
/***************************************************************************/
/*
 * function to delete boleto
 */
/***************************************************************************/
	function delete_boleto($id)
	{
		return $this->db->delete('boleto',array('id'=>$id));
	}
/***************************************************************************/
	function getBoletoByRemessa($id)
	{
		return $this->db->get_where('boleto', array('idRemessa' => $id))->result_array();
	}
/***************************************************************************/
}