# Host: 127.0.0.1  (Version 5.6.26)
# Date: 2018-04-23 16:52:53
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "dados_boletos"
#

DROP TABLE IF EXISTS `dados_boletos`;
CREATE TABLE `dados_boletos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nosso_numero` varchar(30) DEFAULT NULL,
  `numero_documento` bigint(20) DEFAULT NULL,
  `data_vencimento` date DEFAULT NULL,
  `data_documento` date DEFAULT NULL,
  `data_processamento` date DEFAULT NULL,
  `valor_boleto` decimal(10,2) DEFAULT NULL,
  `sacado` varchar(255) DEFAULT NULL,
  `sacado_cpf_cnpj` varchar(20) DEFAULT NULL,
  `sacado_nome` varchar(255) DEFAULT NULL,
  `sacado_endereco` varchar(255) DEFAULT NULL,
  `sacado_cep` varchar(10) DEFAULT NULL,
  `endereco1` varchar(255) DEFAULT NULL,
  `endereco2` varchar(255) DEFAULT NULL,
  `demonstrativo1` text,
  `demonstrativo2` text,
  `demonstrativo3` text,
  `instrucoes1` varchar(255) DEFAULT NULL,
  `instrucoes2` varchar(255) DEFAULT NULL,
  `instrucoes3` varchar(255) DEFAULT NULL,
  `instrucoes4` varchar(255) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valor_unitario` decimal(10,2) DEFAULT NULL,
  `aceite` varchar(255) DEFAULT NULL,
  `especie` varchar(10) DEFAULT NULL,
  `especie_doc` varchar(10) DEFAULT NULL,
  `agencia` varchar(10) DEFAULT NULL,
  `agencia_dv` varchar(2) DEFAULT NULL,
  `conta` varchar(10) DEFAULT NULL,
  `conta_dv` varchar(2) DEFAULT NULL,
  `conta_cedente` varchar(10) DEFAULT NULL,
  `conta_cedente_dv` varchar(2) DEFAULT NULL,
  `carteira` varchar(2) DEFAULT NULL,
  `identificacao` varchar(255) DEFAULT NULL,
  `cpf_cnpj` varchar(20) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cidade_uf` varchar(255) DEFAULT NULL,
  `cedente` varchar(255) DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'P',
  `idRemessa` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `boleto`;
CREATE TABLE `boleto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_documento` date DEFAULT NULL,
  `dias_de_prazo_para_pagamento` int(2) NOT NULL DEFAULT '0',
  `taxa_boleto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pedido_quantidade` int(2) NOT NULL DEFAULT '1',
  `pedido_nome` varchar(255) DEFAULT NULL,
  `pedido_valor_unitario` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pedido_numero` bigint(11) NOT NULL DEFAULT '0',
  `pedido_aceite` varchar(10) NOT NULL DEFAULT 'N',
  `pedido_especie` varchar(10) NOT NULL DEFAULT 'R$',
  `pedido_especie_doc` varchar(10) NOT NULL DEFAULT 'DM',
  `sacado_nome` varchar(255) DEFAULT NULL,
  `sacado_cpf_cnpj` bigint(14) NOT NULL DEFAULT '0',
  `sacado_endereco` varchar(255) DEFAULT NULL,
  `sacado_cidade` varchar(255) DEFAULT NULL,
  `sacado_uf` varchar(2) DEFAULT NULL,
  `sacado_cep` varchar(20) DEFAULT NULL,
  `demonstrativo_linha1` varchar(100) DEFAULT NULL,
  `demonstrativo_linha2` text,
  `demonstrativo_linha3` varchar(250) DEFAULT NULL,
  `instrucoes_linha1` varchar(250) DEFAULT NULL,
  `instrucoes_linha2` varchar(250) DEFAULT NULL,
  `instrucoes_linha3` varchar(250) DEFAULT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'Criado',
  `idRemessa` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;