<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
DROP TABLE IF EXISTS {$this->getTable('open_position')};
	CREATE TABLE {$this->getTable('open_position')} (
	  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `title` varchar(50) NOT NULL DEFAULT '',
	  `location` varchar(50) NOT NULL DEFAULT '',
	  `description` text NOT NULL DEFAULT '',
	  `fromdate` datetime DEFAULT NULL,
	  `todate` datetime DEFAULT NULL,
	  `creation_time` datetime DEFAULT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SQLTEXT;

$installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 
$installer->endSetup();
	 