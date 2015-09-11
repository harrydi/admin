<?php


class Omniesolutions_Retailers_Block_Adminhtml_Customerinfo extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_customerinfo";
	$this->_blockGroup = "retailers";
	$this->_headerText = Mage::helper("retailers")->__("Customerinfo Manager");
	$this->_addButtonLabel = Mage::helper("retailers")->__("Add New Item");
	parent::__construct();
	
	}

}