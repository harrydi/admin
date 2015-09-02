<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
ALTER TABLE general MODIFY COLUMN interested varchar(50) NOT NULL DEFAULT '';
SQLTEXT;

$installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 
$installer->endSetup();
	 