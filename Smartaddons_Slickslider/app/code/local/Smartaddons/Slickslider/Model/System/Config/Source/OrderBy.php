<?php
/*------------------------------------------------------------------------
 # SM Slick Slider - Version 1.0
 # Copyright (c) 2009-2011 The YouTech Company. All Rights Reserved.
 # @license - Copyrighted Commercial Software
 # Author: YouTech Company
 # Websites: http://www.smartaddons.com
-------------------------------------------------------------------------*/

class Smartaddons_Slickslider_Model_System_Config_Source_OrderBy
{
	public function toOptionArray()
	{
		return array(
			array('value' => 'position',	'label' => Mage::helper('slickslider')->__('Position')),
			array('value' => 'created_at', 	'label' => Mage::helper('slickslider')->__('Date Created')),
			array('value' => 'name', 		'label' => Mage::helper('slickslider')->__('Name')),
			array('value' => 'price', 		'label' => Mage::helper('slickslider')->__('Price')),
			array('value' => 'random', 		'label' => Mage::helper('slickslider')->__('Random')),
			array('value' => 'top_rating', 	'label' => Mage::helper('slickslider')->__('Top Rating')),
			array('value' => 'most_reviewed',	'label' => Mage::helper('slickslider')->__('Most Reviews')),
			array('value' => 'most_viewed',	'label' => Mage::helper('slickslider')->__('Most Visited')),
			array('value' => 'best_sales',	'label' => Mage::helper('slickslider')->__('Most Selling')),
		);
	}
}
