<?php
class Omniesolutions_Sorting_Model_Catalog_Config extends Mage_Catalog_Model_Config
{
	public function getAttributeUsedForSortByArray()
    {
        return array_merge(
			parent::getAttributeUsedForSortByArray(),
			array(
				'qty_ordered' => Mage::helper('catalog')->__('Sold quantity'),
				'rating_summary' => Mage::helper('catalog')->__('Rating'),
			)
			
		);
    }
	
}
		