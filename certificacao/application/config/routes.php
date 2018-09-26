<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'dashboard/index';

$route['cnab'] = "Cnab_controller";
$route['cnab/geraremssa'] = "Cnab_controller/geraremssa";
$route['cnab/remessa'] = "Cnab_controller/remessa";
$route['cnab/findRetorno'] = "Cnab_controller/findRetorno";
$route['cnab/getRetorno'] = "Cnab_controller/getRetorno";
$route['cnab/retorno'] = "Cnab_controller/retorno";
$route['cnab/garb'] = "Cnab_controller/garb";
$route['cnab/listaRemessa'] = "Cnab_controller/listaRemessa";
$route['cnab/getGarb/(:num)'] = "Cnab_controller/getGarb/$1";
$route['cnab/exportarRemessa/(:num)'] = "Cnab_controller/exportarRemessa/$1";
/*****************************************************************/
$route['alunos'] = "Alunos_controller/index";
$route['alunos/index'] = "Alunos_controller/index";
$route['alunos/addBoleto/(:num)'] = "Alunos_controller/addBoleto/$1";
/*****************************************************************/
$route['boleto'] = "Boleto_controller/data_tables";
$route['boleto/datatables'] = "Boleto_controller/data_tables";
$route['boleto/index'] = "Boleto_controller/data_tables";
$route['boleto/add'] = "Boleto_controller/add";
$route['boleto/findAluno'] = "Boleto_controller/findAluno";
$route['boleto/getAluno'] = "Boleto_controller/getAluno";
$route['boleto/edit/(:num)'] = "Boleto_controller/edit/$1";
$route['boleto/remove/(:num)'] = "Boleto_controller/remove/$1";
$route['boleto/getBoleto/(:num)'] = "Boleto_controller/getBoleto/$1";

$route['remessa'] = "Remessa_controller/index";
$route['remessa/gerar/(:num)'] = "Remessa_controller/gerar/$1";
/*****************************************************************/
$route['auth'] = "auth/login";
$route['auth/logout'] = "auth/logout";

/*****************************************************************/
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
