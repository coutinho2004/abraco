<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Nosso_numero_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
/****************************************************************/
/*
 * Get dados_boleto by id
 */
/****************************************************************/
	function getNossoNumero($id)
	{
		return $this->db->get_where('nosso_numero',array('id'=>$id))->row_array();
	}
/***************************************************************************/
/*
 * function to update
 */
/***************************************************************************/
	function update($id,$params)
	{
		$this->db->where('id',$id);
		return $this->db->update('nosso_numero',$params);
	}
/****************************************************************/
}