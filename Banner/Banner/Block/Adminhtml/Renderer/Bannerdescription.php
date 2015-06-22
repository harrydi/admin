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
 * @Block :Rendered function to call Banner Description template file to show Html .
 *
 * @author : Chetu
 */
class Envista_Banner_Block_Adminhtml_Renderer_Bannerdescription extends Varien_Data_Form_Element_Abstract {

	public function getElementHtml()
    {
        echo Mage::app()->getLayout()->createBlock('banner/adminhtml_renderer_description')->setTemplate('banner/description.phtml')->toHtml();
    }
	
}