<?php
/*------------------------------------------------------------------------
 # Yt Slideshow III - Version 1.0
 # Copyright (C) 2009-2011 The YouTech JSC. All Rights Reserved.
 # @license - Copyrighted Commercial Software
 # Author: The YouTech JSC
 # Websites: http://magento.ytcvn.com - http://joomla.ytcvn.com
 -------------------------------------------------------------------------*/


class Smartaddons_Slickslider_Model_System_Config_Source_ListShowButtonStyle
{
	public function toOptionArray()
	{
		return array(
		array('value'=>'number', 'label'=>Mage::helper('slickslider')->__('Number')),
        array('value'=>'cycle', 'label'=>Mage::helper('slickslider')->__('Cycle'))
		);
	}
}
