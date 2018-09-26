DROP TABLE IF EXISTS `remessa`;
CREATE TABLE `remessa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(10) DEFAULT NULL,
  `data_criacao` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `sacado_snqc` int(11) NOT NULL DEFAULT '0',
  `sacado_endereco` varchar(255) DEFAULT NULL,
  `sacado_cidade` varchar(255) DEFAULT NULL,
  `sacado_uf` varchar(2) DEFAULT NULL,
  `sacado_cep` varchar(20) DEFAULT NULL,
  `demonstrativo_linha1` text,
  `demonstrativo_linha2` text,
  `demonstrativo_linha3` varchar(250) DEFAULT NULL,
  `instrucoes_linha1` text,
  `instrucoes_linha2` text,
  `instrucoes_linha3` varchar(250) DEFAULT NULL,
  `instrucoes_linha4` varchar(250) DEFAULT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'Criado',
  `idRemessa` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

##Alterando a tabela boleto para armazenar a data de vencimento

ALTER TABLE `abraco`.`boleto`
  ADD COLUMN `data_vencimento` date NOT NULL DEFAULT '0000-00-00' AFTER `data_documento`;

##Alterando a tabela boleto para armazenar o e-mail
ALTER TABLE `abraco`.`boleto`
  ADD COLUMN `sacado_email` varchar(255) NULL DEFAULT NULL AFTER `sacado_nome`;
