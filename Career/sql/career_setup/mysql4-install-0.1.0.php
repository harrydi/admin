<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
DROP TABLE IF EXISTS {$this->getTable('career_info')};
	CREATE TABLE {$this->getTable('career_info')} (
	  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `firstname` varchar(50) NOT NULL DEFAULT '',
	  `lastname` varchar(50) NOT NULL DEFAULT '',
	  `email` varchar(50) NOT NULL DEFAULT '',
	  `phone` varchar(50) NOT NULL DEFAULT '',
	  `linkedIn` varchar(255) NOT NULL DEFAULT '',
	  `department` varchar(50) NOT NULL DEFAULT '',
	  `resume` varchar(50) NOT NULL DEFAULT '',
	  `message` text,
	  `creation_time` datetime DEFAULT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SQLTEXT;

$installer->run($sql);

$installer->endSetup(); 