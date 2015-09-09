<?php   
class Omniesolutions_Mainslider_Block_featured extends Mage_Catalog_Block_Product_Abstract{   
	/**
     * Prepare collection with new products and applied page limits.
     *
     * return ZodiacMedia_Bestsellers_Block_Bestsellers
     */
    protected function getFeaturedProduct() {
		$collection = Mage::getModel('catalog/product')->getCollection();
			//$collection =  $collection->addAttributeToFilter('trending_product', '1');
			$collection =  $collection->addAttributeToFilter('feature_product', '1');
			$attributes = Mage::getSingleton('catalog/config')->getProductAttributes();
			$collection->addAttributeToSelect($attributes)
				->addMinimalPrice()
				->addFinalPrice()
				->addTaxPercents()
				->addStoreFilter()
				->setPageSize(2)	
				->setCurPage(1); 

			Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
			Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
		
		return $collection;
    }

}