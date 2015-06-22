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
 * @Namespace : AsiaCheckout
 * @module : Banner
 * @Block  : Filter
 *
 * File to create the view of Brand module and pager functionality for category page.
 *
 *
 * @author: Chetu
 */
class Envista_Banner_Block_Filter_View extends Mage_Core_Block_Template {

    protected $banners = array();
    //protected $_generalConfigPath = "banner_section/banner_group/";

    public function getBanners() {
    $date = date('Y-m-d');
        $id = $this->getRequest()->getParam('id');
        $collection = Mage::getModel('banner/banner')->getCollection()->addFieldToFilter(
            array('banner_start_date'),
            array(array('lteq' => $date)))->addFieldToFilter(
            array('banner_expire_date'),
            array(array('gteq' => $date)));
        $this->banners = $collection->getData();
        return $this->banners;
    }

    public function __construct() {
        parent::__construct();
        $collection = $this->getBanners();
        $this->setCollection($collection);
    }

}
