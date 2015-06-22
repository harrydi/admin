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
 * @Block :Adminhtml
 *
 * File to show the Add Banner button and Take Screenshot button for brand urls.
 *
 *
 * @author: Chetu
 */
class Envista_Banner_Block_Adminhtml_Banner extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
            $this->_controller = 'adminhtml_banner';
        $this->_blockGroup = 'banner';
        $this->_headerText = Mage::helper('banner')->__('Banner Manager');
        $this->_addButtonLabel = Mage::helper('banner')->__('Add Banner');
        parent::__construct();
        
    }

}