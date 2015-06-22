<?php
/*------------------------------------------------------------------------
 # SM Slick Slider - Version 1.1
 # Copyright (c) 2009-2011 YouTech Company. All Rights Reserved.
 # @license - Copyrighted Commercial Software
 # Author: YouTech Company
 # Websites: http://www.smartaddons.com
-------------------------------------------------------------------------*/

class Smartaddons_Slickslider_Model_System_Config_Source_ProductSources
{
	public function toOptionArray()
	{
		return array(
			array('value'=>'catalog',	'label'=>Mage::helper('slickslider')->__('Catalog')),
			array('value'=>'product',	'label'=>Mage::helper('slickslider')->__('Product')),
			array('value'=>'media',	'label'=>Mage::helper('slickslider')->__('Media')),
		);
	}
}
