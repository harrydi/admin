<?php
/*------------------------------------------------------------------------
 # SM MegaMenu - Version 1.0
 # Copyright (c) 2009-2011 YouTech Company. All Rights Reserved.
 # @license - Copyrighted Commercial Software
 # Author: YouTech Company
 # Websites: http://www.smartaddons.com
-------------------------------------------------------------------------*/

class Smartaddons_Megamenu_Model_System_Config_Source_ListEffect
{
	const CSS		 	=	1;
	const ANIMATION	 	=	2;
	const TOGGLE 		=	3;

	static public function getOptionArray()
    {
        return array(	
			self::CSS 				=> Mage::helper('megamenu')->__('Css'),
			self::ANIMATION			=> Mage::helper('megamenu')->__('Animation'),
			self::TOGGLE			=> Mage::helper('megamenu')->__('toggle'),
        );
    }	
    static public function toOptionArray()
    {
        return array(	
					array(
					  'value'     => self::CSS,
					  'label'     => Mage::helper('megamenu')->__('Css'),
					),		
					array(
					  'value'     => self::ANIMATION,
					  'label'     => Mage::helper('megamenu')->__('Animation'),
					),
					array(
					  'value'     => self::TOGGLE,
					  'label'     => Mage::helper('megamenu')->__('Toggle'),
					),			
		);
    }	
}
