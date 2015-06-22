<?php

class Smartaddons_Megamenu_Model_System_Config_Source_ListNumCol extends Varien_Object
{
    const ONE			= 1;
    const TWO			= 2;
    const THREE			= 3;
    const FOUR			= 4;
    const FIVE			= 5;
    const SIX			= 6;		
    static public function getOptionArray()
    {
        return array(	
			self::ONE 		=> Mage::helper('megamenu')->__('1 column (145px)'),
			self::TWO		=> Mage::helper('megamenu')->__('2 columns (300px)'),
			self::THREE		=> Mage::helper('megamenu')->__('3 columns (455px)'),
			self::FOUR		=> Mage::helper('megamenu')->__('4 columns (610px)'),
			self::FIVE		=> Mage::helper('megamenu')->__('5 columns (765px)'),
			self::SIX		=> Mage::helper('megamenu')->__('6 columns (920px)'),		
        );
    }	
    static public function toOptionArray()
    {
        return array(	
			array(
			  'value'     => self::ONE,
			  'label'     => Mage::helper('megamenu')->__('1 column (145px)'),
			),

			array(
			  'value'     => self::TWO,
			  'label'     => Mage::helper('megamenu')->__('2 columns (300px)'),
			),

			array(
			  'value'     => self::THREE,
			  'label'     => Mage::helper('megamenu')->__('3 columns (455px)'),
			),		
			array(
			  'value'     => self::FOUR,
			  'label'     => Mage::helper('megamenu')->__('4 columns (610px)'),
			),			
			array(
			  'value'     => self::FIVE,
			  'label'     => Mage::helper('megamenu')->__('5 columns (765px)'),
			),		
			array(
			  'value'     => self::SIX,
			  'label'     => Mage::helper('megamenu')->__('6 columns (920px)'),
			),	
        );
    }
}