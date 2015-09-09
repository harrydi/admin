<?php   
class Omniesolutions_Mainslider_Block_Index extends Mage_Core_Block_Template{   

	public function getResponsivebannersliderEnabled() {
        return Mage::getStoreConfig('generalsetting/mainslidergroup/enable', Mage::app()->getStore());
    }

    public function getResponsivebannersliderSpeed() {
        return Mage::getStoreConfig('generalsetting/mainslidergroup/slidespeed', Mage::app()->getStore());
    }

    public function getResponsivebannerSlideType() {
        return Mage::getStoreConfig('generalsetting/mainslidergroup/styletype', Mage::app()->getStore());
    }

    public function getResponsivebannerBannerLoop() {
        return Mage::getStoreConfig('generalsetting/mainslidergroup/bannerloop', Mage::app()->getStore());
    }

    public function getResponsivebannerPauseOnhover() {
        return Mage::getStoreConfig('generalsetting/mainslidergroup/pauseonhover', Mage::app()->getStore());
    }



}