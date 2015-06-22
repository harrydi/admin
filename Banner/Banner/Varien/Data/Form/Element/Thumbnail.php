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
 * @Varien :Thumbnail
 *
 * File to show the Brand Screenshot Image in the Edit section of the Brand module.
 *
 *
 * @author: Chetu
 */
class Envista_Banner_Varien_Data_Form_Element_Thumbnail extends Varien_Data_Form_Element_Abstract {
    public function __construct($data) {
        parent::__construct($data);
        $this->setType('file');
    }
 
    public function getElementHtml() {
        $html = '';
        if ($this->getValue()) {
            $url = $this->_getUrl();
            if( !preg_match("/^http\:\/\/|https\:\/\//", $url) ) {
                $url = Mage::getBaseUrl('media') . $url;
            }
            $html = '<a href="' . $url . '"'
                . ' onclick="imagePreview(\'' . $this->getHtmlId() . '_image\'); return false;">'
                . '<img src="' . $url . '" id="' . $this->getHtmlId() . '_image" title="' . $this->getValue() . '"'
                . ' alt="' . $this->getValue() . '" height="150" width="150" class="small-image-preview v-middle" />'
                . '</a> ';
        }
        $this->setClass('input-file');
        $html.= parent::getElementHtml();
        return $html;
    }
 
    protected function _getUrl() {
        return $this->getValue();
    }
 
    public function getName() {
        return  $this->getData('name');
      }
}      
?>