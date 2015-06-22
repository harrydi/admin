<?php
/*------------------------------------------------------------------------
 # Yt Slideshow III - Version 1.0
 # Copyright (C) 2009-2011 The YouTech JSC. All Rights Reserved.
 # @license - Copyrighted Commercial Software
 # Author: The YouTech JSC
 # Websites: http://magento.ytcvn.com - http://joomla.ytcvn.com
 -------------------------------------------------------------------------*/


class Smartaddons_Slickslider_Model_System_Config_Source_ListEffectType
{
	public function toOptionArray()
	{
		return array(
		array('value'=>'fade', 'label'=>Mage::helper('slickslider')->__('Fade')),
		array('value'=>'fadeZoom', 'label'=>Mage::helper('slickslider')->__('Fade Zoom')),
		array('value'=>'zoom', 'label'=>Mage::helper('slickslider')->__('Zoom')),
			
		array('value'=>'shuffle', 'label'=>Mage::helper('slickslider')->__('Shuffle')),
		array('value'=>'toss', 'label'=>Mage::helper('slickslider')->__('Toss')),
		array('value'=>'wipe', 'label'=>Mage::helper('slickslider')->__('Wipe')),
			
		array('value'=>'cover', 'label'=>Mage::helper('slickslider')->__('Cover')),
		array('value'=>'uncover', 'label'=>Mage::helper('slickslider')->__('Uncover')),
		array('value'=>'blindX', 'label'=>Mage::helper('slickslider')->__('Blind X')),
			
		array('value'=>'blindY', 'label'=>Mage::helper('slickslider')->__('Blind Y')),
		array('value'=>'blindZ', 'label'=>Mage::helper('slickslider')->__('Blind Z')),
		array('value'=>'growY', 'label'=>Mage::helper('slickslider')->__('Grow Y')),
			
		array('value'=>'curtainX', 'label'=>Mage::helper('slickslider')->__('Curtain X')),
		array('value'=>'curtainY', 'label'=>Mage::helper('slickslider')->__('Curtain Y')),
		array('value'=>'slideX', 'label'=>Mage::helper('slickslider')->__('Slide X')),
			
		array('value'=>'slideY', 'label'=>Mage::helper('slickslider')->__('Slide Y')),
		array('value'=>'turnUp', 'label'=>Mage::helper('slickslider')->__('Turn Up')),
		array('value'=>'turnDown', 'label'=>Mage::helper('slickslider')->__('Turn Down')),
			
		array('value'=>'turnLeft', 'label'=>Mage::helper('slickslider')->__('Turn Left')),
		array('value'=>'turnRight', 'label'=>Mage::helper('slickslider')->__('Turn Right')),
		array('value'=>'scrollRight', 'label'=>Mage::helper('slickslider')->__('Scroll Right')),
			
		array('value'=>'scrollLeft', 'label'=>Mage::helper('slickslider')->__('Scroll Left')),
		array('value'=>'scrollUp', 'label'=>Mage::helper('slickslider')->__('Scroll Up')),
		array('value'=>'scrollDown', 'label'=>Mage::helper('slickslider')->__('Scroll Down')),	
		);
	}
}
