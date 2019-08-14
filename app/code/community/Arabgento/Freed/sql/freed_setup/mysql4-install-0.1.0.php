<?php
$installer = $this;
$installer->startSetup();
$installer->run("
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';
DROP TABLE IF EXISTS {$this->getTable('freed')};
CREATE TABLE {$this->getTable('freed')}(
`freed_id` int(11) unsigned NOT NULL auto_increment,
`product_id` int(11) NOT NULL default 0,
`order_id` int(11) NOT NULL default 0,
`costumer_id` int(11) NOT NULL default 0,
`product_link` varchar(400) NOT NULL default '',
`product_name` varchar(400) NOT NULL default '',
`costumer_name` varchar(400) NOT NULL default '',
`condition` varchar(400) NOT NULL default '',
`pied_admin` tinyint NOT NULL default 0 ,
`pied_client` tinyint NOT NULL default 0,
`freed_create` datetime NULL,
`freed_modify` datetime NULL,
  PRIMARY KEY (`freed_id`))
   ENGINE=InnoDB DEFAULT CHARSET=utf8;
   SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
   SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
");
 $installer->endSetup();