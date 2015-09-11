<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
DROP TABLE IF EXISTS {$this->getTable('customerinfo')};
	CREATE TABLE {$this->getTable('customerinfo')} (
	  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `customer_id` varchar(50) NOT NULL DEFAULT '',
	  `detail` varchar(50) NOT NULL DEFAULT '',
	  `description` text NOT NULL DEFAULT '',
	  `creation_time` datetime DEFAULT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SQLTEXT;

$installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 
$installer->endSetup();
	 