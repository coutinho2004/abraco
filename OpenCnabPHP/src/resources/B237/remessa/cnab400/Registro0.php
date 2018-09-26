<?php
namespace CnabPHP\resources\B237\remessa\cnab400;

use CnabPHP\resources\generico\remessa\cnab400\Generico0;

class Registro0 extends Generico0{
/************************************************************************/
	protected $meta = array(
		'identificacao_registro'=>array(
			'tamanho'=>1,
			'default'=>'0',
			'tipo'=>'int',
			'required'=>true
		),
		'operacao'=>array(
			'tamanho'=>1,
			'default'=>'1',
			'tipo'=>'int',
			'required'=>true
		),
		'literal_remessa'=>array(
			'tamanho'=>7,
			'default'=>'remessa',
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
		'codigo_beneficiario'=>array(
			'tamanho'=>20,
			'default'=>'',
			'tipo'=>'int',
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
			'default'=>'Bradesco',
			'tipo'=>'alfa',
			'required'=>true
		),
		'data_gravacao'=>array(
			'tamanho'=>6,
			'default'=>'',// não informar a data na instanciação - gerada dinamicamente
			'tipo'=>'date',
			'required'=>true
		),
		'filler1'=>array(
			'tamanho'=>8,
			'default'=>' ',
			'tipo'=>'alfa',
			'required'=>true
		),
		'identificacao_sistema'=>array(
			'tamanho'=>2,
			'default'=>'MX',
			'tipo'=>'alfa',
			'required'=>true
		),
		'numero_sequencial_arquivo'=>array(
			'tamanho'=>7,
			'default'=>'1',
			'tipo'=>'int',
			'required'=>true
		),
		'filler2'=>array(
			'tamanho'=>277,
			'default'=>' ',
			'tipo'=>'alfa',
			'required'=>true
		),
		'numero_sequencial'=>array(
			'tamanho'=>6,
			'default'=>'1',
			'tipo'=>'int',
			'required'=>true
		),
	);
/************************************************************************/
}
