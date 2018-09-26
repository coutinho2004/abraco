<?php
namespace CnabPHP;
use \CnabPHP\RemessaAbstract;
use \CnabPHP;
class Remessa extends RemessaAbstract{
/************************************************************************/
	public function __construct($banco,$layout,$data){
		parent::__construct($banco,$layout,$data);
	}
/************************************************************************/
}
?>
