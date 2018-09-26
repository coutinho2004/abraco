<?php
/*************************************************/
class Alunos_controller extends CI_Controller{
	function __construct()
	{
		parent::__construct();
	}
/*************************************************/
	public function listarAlunos()
	{
		$data['alunos'] = $this->alunos->listarAlunos();
		$data['_view'] = 'alunos/listarAlunos';
		$this->load->view('layouts/main',$data);
	}
/*************************************************/
	public function listarEmpresas()
	{
		$data['empresas'] = $this->alunos->listarEmpresas();
		$data['_view'] = 'alunos/listarEmpresas';
		$this->load->view('layouts/main',$data);
	}
/*************************************************/
}
