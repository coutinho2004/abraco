<?php
namespace CnabPHP\resources\B237\retorno\L400;
use CnabPHP\resources\generico\retorno\L400\Generico9;
use CnabPHP\Exception;

class Registro9 extends Generico9{
/************************************************************************/
	protected $meta = array(
        'tipo_registro'=>array(			//01.5
            'tamanho'=>1,
            'default'=>'9',
            'tipo'=>'int',
            'required'=>true
        ),
        'ident_retorno'=>array(			//01.5
            'tamanho'=>1,
            'default'=>'9',
            'tipo'=>'int',
            'required'=>true
        ),
        'ident__tipo_retorno'=>array(	//01.5
            'tamanho'=>2,
            'default'=>'01',
            'tipo'=>'int',
            'required'=>true
        ),
		'codigo_banco'=>array(			//01.5
			'tamanho'=>3,
			'default'=>'237',
			'tipo'=>'int',
			'required'=>true
		),
		'filler0'=>array(				//02.5
			'tamanho'=>10,
			'default'=>'',
			'tipo'=>'alfa',
			'required'=>true
		),
		'tipo_registro'=>array(			//03.5
			'tamanho'=>1,
			'default'=>'9',
			'tipo'=>'int',
			'required'=>true
		),
		'filler1'=>array(				//04.5
			'tamanho'=>9,
			'default'=>' ',
			'tipo'=>'alfa',
			'required'=>true
		),
		'qtd_lotes'=>array(				//05.5
			'tamanho'=>6,
			'default'=>'1',
			'tipo'=>'int',
			'required'=>true
		),
		'qtd_registros'=>array(			//06.5
			'tamanho'=>6,
			'default'=>'0',
			'tipo'=>'int',
			'required'=>true
		),
		'filler2'=>array(				//12.5
			'tamanho'=>6,
			'default'=>' ',
			'tipo'=>'alfa',
			'required'=>true
		),
		'filler3'=>array(				//13.5
			'tamanho'=>105,
			'default'=>' ',
			'tipo'=>'alfa',
			'required'=>true
		),
	);
/************************************************************************/
}
