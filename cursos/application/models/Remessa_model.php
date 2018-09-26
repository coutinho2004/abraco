<?php

class Remessa_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
/****************************************************************/
/*
 * Get remessa by id
 */
/****************************************************************/
	function get_remessa($id)
	{
		return $this->db->get_where('remessa',array('id'=>$id))->row_array();
	}
/****************************************************************/
/*
 * Get all remessa count
 */
/****************************************************************/
	function get_all_remessa_count()
	{
		$this->db->from('remessa');
		return $this->db->count_all_results();
	}
/****************************************************************/
/*
 * Get all remessa
 */
/****************************************************************/
	function get_all_remessa($params = array())
	{
		$this->db->order_by('id', 'desc');
		if(isset($params) && !empty($params))
		{
			$this->db->limit($params['limit'], $params['offset']);
		}
		return $this->db->get('remessa')->result_array();
	}
/****************************************************************/
/*
 * function to add new remessa
 */
/****************************************************************/
	function add_remessa($params)
	{
		$this->db->insert('remessa',$params);
		return $this->db->insert_id();
	}
/****************************************************************/
/*
 * function to update remessa
 */
/****************************************************************/
	function update_remessa($id,$params)
	{
		$this->db->where('id',$id);
		return $this->db->update('remessa',$params);
	}
/****************************************************************/
/*
 * function to delete remessa
 */
/****************************************************************/
	function delete_remessa($id)
	{
		return $this->db->delete('remessa',array('id'=>$id));
	}
/****************************************************************/
	public function getNome()
	{
		$letras = array('A','B','C','D','E','F','G','H','I','J','L','M','N','O','P','Q','R','S','T','U','X','W','K','Y','Z');
		$id = $this->db
		->get_where('remessa',array('data_criacao'=>date('Y-m-d')))
		->num_rows();
		//return 'CB'.date('dm').$this->poeZero(2,($id+1));

		$dv = $this->poeZero(2,($id+1));
		$d = substr($dv,0,1);
		$v = substr($dv,1,1);
		$dv = $letras[$d].$v;
		return 'CB'.date('dmy').$dv;
	}
/****************************************************************/
public function poeZero($n,$str){$t = strlen($str);if($n > $t){for($i=0; $i<($n-$t); $i++){$str = "0".$str;}}return $str;}
/****************************************************************/
}
