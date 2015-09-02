<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
DROP TABLE IF EXISTS {$this->getTable('general')};
	CREATE TABLE {$this->getTable('general')} (
	  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `title` varchar(50) NOT NULL DEFAULT '',
	  `interested` int(11) unsigned NOT NULL,
	  `creation_time` datetime DEFAULT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SQLTEXT;

$installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 
$installer->endSetup();
	 