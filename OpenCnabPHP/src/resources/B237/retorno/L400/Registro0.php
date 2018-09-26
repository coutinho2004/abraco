<?php
namespace CnabPHP\resources\B237\retorno\L400;
use CnabPHP\resources\generico\retorno\L400\Generico0;
use CnabPHP\RetornoAbstract;

class Registro0 extends Generico0
{
/************************************************************************/
	public $trailler;
/************************************************************************/
	protected $meta = array(
		'tipo_registro'=>array(
			'tamanho'=>1,
			'default'=>'0',
			'tipo'=>'int',
			'required'=>true
		),
		'operacao'=>array(
			'tamanho'=>1,
			'default'=>'2',
			'tipo'=>'int',
			'required'=>true
		),
		'literal_remessa'=>array(
			'tamanho'=>7,
			'default'=>'RETORNO',
			'tipo'=>'alfa',
			'required'=>true
		),
		'tipo_servico'=>array(
			'tamanho'=>2,
			'default'=>'01',
			'tipo'=>'int',
			'required'=>true
		),
		'literal_servico'=>array(
			'tamanho'=>15,
			'default'=>'COBRANCA',
			'tipo'=>'alfa',
			'required'=>true
		),
		'codigo_empresa'=>array(
			'tamanho'=>20,
			'default'=>'',
			'tipo'=>'alfa',
			'required'=>true
		),
		'nome_empresa'=>array(
			'tamanho'=>30,
			'default'=>' ',
			'tipo'=>'alfa',
			'required'=>true
		),
		'codigo_banco'=>array(
			'tamanho'=>3,
			'default'=>'237',
			'tipo'=>'int',
			'required'=>true
		),
		'nome_banco'=>array(
			'tamanho'=>15,
			'default'=>'BRADESCO',
			'tipo'=>'alfa',
			'required'=>true
		),
		'data_gravacao'=>array(
			'tamanho'=>6,
			'default'=>'',// não informar a data na instanciação - gerada dinamicamente
			'tipo'=>'date',
			'required'=>true
		),
		'densidade_gravacao'=>array(
			'tamanho'=>8,
			'default'=>'0',
			'tipo'=>'int',
			'required'=>true
		),
		'n_aviso_bancario'=>array(
			'tamanho'=>5,
			'default'=>'',
			'tipo'=>'int',
			'required'=>true
		),
		'filler1'=>array(
			'tamanho'=>266,
			'default'=>' ',
			'tipo'=>'alfa',
			'required'=>true
		),
		'data_credito'=>array(
			'tamanho'=>6,
			'default'=>'',// não informar a data na instanciação - gerada dinamicamente
			'tipo'=>'date',
			'required'=>true
		),
		'filler2'=>array(
			'tamanho'=>9,
			'default'=>' ',
			'tipo'=>'alfa',
			'required'=>true
		),
		'numero_sequencial_registro'=>array(
			'tamanho'=>6,
			'default'=>'',
			'tipo'=>'int',
			'required'=>true
		),
	);
/************************************************************************/
	public function __construct($linhaTxt){
		parent::__construct($linhaTxt);
		RetornoAbstract::$linesCounter++;
		$this->inserirDetalhe();
	}
/************************************************************************/
	public function inserirDetalhe(){
		while(RetornoAbstract::$linesCounter < (count(RetornoAbstract::$lines)-2))
		{
			$class = 'CnabPHP\resources\\B'.RetornoAbstract::$banco.'\retorno\\'.RetornoAbstract::$layout.'\Registro1';
			$this->children[] = new $class(RetornoAbstract::$lines[RetornoAbstract::$linesCounter]);
		}
		//RetornoAbstract::$linesCounter--;
	}
/************************************************************************/
}
