<?php


class Omniesolutions_General_Block_Adminhtml_General extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_general";
	$this->_blockGroup = "general";
	$this->_headerText = Mage::helper("general")->__("General Manager");
	$this->_addButtonLabel = Mage::helper("general")->__("Add New Item");
	parent::__construct();
	
	}

}