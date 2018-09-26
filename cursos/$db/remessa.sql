# Host: 127.0.0.1  (Version 5.6.26)
# Date: 2018-04-23 16:55:03
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "remessa"
#

DROP TABLE IF EXISTS `remessa`;
CREATE TABLE `remessa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(10) DEFAULT NULL,
  `data_criacao` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `cursos`.`remessa` SET `nome`='Anteriores',`data_criacao`='2018-05-14';

ALTER TABLE `cursos`.`boletos`
  ADD COLUMN `idRemessa` int(11) NOT NULL DEFAULT 1;
SHOW CREATE TABLE `cursos`.`boletos`;

ALTER TABLE `cursos`.`boletos`
  ADD COLUMN `status` varchar(20) NOT NULL DEFAULT 'Remessa';

ALTER TABLE `cursos`.`boletos`
  CHANGE COLUMN `idRemessa` `idRemessa` int(11) NOT NULL DEFAULT 0;