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
 * File to show the brand screenshot in Grid layout.
 *
 *
 * @author: Chetu
 */
class Envista_Banner_Block_Adminhtml_Banner_Grid_Screenshot extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {
    
    public function render(Varien_Object $row)
    { 
         $data = (string)$row->getData($this->getColumn()->getIndex());
        $url = Mage::getBaseUrl('media') . $data;
        return '<img src="'. $url .'" style="width:60px" />';
    }
}