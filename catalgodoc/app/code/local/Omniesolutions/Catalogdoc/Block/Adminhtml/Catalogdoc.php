<?php


class Omniesolutions_Catalogdoc_Block_Adminhtml_Catalogdoc extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_catalogdoc";
	$this->_blockGroup = "catalogdoc";
	$this->_headerText = Mage::helper("catalogdoc")->__("Catalogdoc Manager");
	$this->_addButtonLabel = Mage::helper("catalogdoc")->__("Add New Item");
	parent::__construct();
	
	}

}