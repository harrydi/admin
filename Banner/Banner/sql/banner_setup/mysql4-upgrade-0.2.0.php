<?php

$installer = $this;
$installer->startSetup();
$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('banner_description')};
CREATE TABLE {$this->getTable('banner_description')} (
  `id` int(10) unsigned NOT NULL auto_increment,
  `banner_id` int(10) NOT NULL,
  `banner_desc` varchar(255) NOT NULL default '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();