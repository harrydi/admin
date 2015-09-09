<?php


class Omniesolutions_Mainslider_Block_Adminhtml_Mainslider extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_mainslider";
	$this->_blockGroup = "mainslider";
	$this->_headerText = Mage::helper("mainslider")->__("Mainslider Manager");
	$this->_addButtonLabel = Mage::helper("mainslider")->__("Add New Item");
	parent::__construct();
	
	}

}