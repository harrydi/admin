<?php
/*------------------------------------------------------------------------
 # SM Frontpage - Version 1.0
 # Copyright (c) 2009-2011 YouTech Company. All Rights Reserved.
 # @license - Copyrighted Commercial Software
 # Author: YouTech Company
 # Websites: http://www.smartaddons.com
-------------------------------------------------------------------------*/

class Smartaddons_Megamenu_Model_System_Config_Source_ListTheme
{
	const HORIZONTAL =	1;
	const VERTICAL	 =	2;

	static public function getOptionArray()
    {
        return array(	
			self::HORIZONTAL 		=> Mage::helper('megamenu')->__('Horizontal'),
			self::VERTICAL			=> Mage::helper('megamenu')->__('Vertical'),
        );
    }	
    static public function toOptionArray()
    {
        return array(	
			array(
			  'value'     => self::HORIZONTAL,
			  'label'     => Mage::helper('megamenu')->__('Horizontal'),
			),		
			array(
			  'value'     => self::VERTICAL,
			  'label'     => Mage::helper('megamenu')->__('Vertical'),
			),
		);
    }	
}
