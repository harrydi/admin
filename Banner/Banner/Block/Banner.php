<?php
/*
 **
 ** Magento
 *
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE_AFL.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @Namespace : Envista
 * @module : Banner
 * @Block  : Banner
 *
 * File to get Banners from collection.
 *
 *
 * @author: Chetu
 */
class Envista_Banner_Block_Banner extends Mage_Core_Block_Template {

    public function getBanners() {
        if ($this->hasData('banners')) {
            return $this->getData('banners');
        }

        $banners = Mage::getModel('banner/banner')->getCollection();
        $this->setData('banners', $banners);
        return $this->getData('banners');
    }

}