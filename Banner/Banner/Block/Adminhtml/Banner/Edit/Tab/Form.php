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
 * Banner module display form with input fields and validation.
 *
 * @author : Chetu
 */
class Envista_Banner_Block_Adminhtml_Banner_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('banner_form', array('legend'=>Mage::helper('banner')->__('Banner information')));
      
      //$fieldset->addType('image', 'Asiacheckout_Banner_Block_Adminhtml_Renderer_Helper_Image');
      $afterElementHtml = '<p class="nm"><small>' . ' The height and width of logo is between 84px and 240px respectively. ' . '</small></p>';
      $fieldset->addField('banner_title', 'text', array(
          'label'     => Mage::helper('banner')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'banner_title',
      ));

      $fieldset->addField('url', 'text', array(
          'label'     => Mage::helper('banner')->__('Url'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'url',
      ));

      $fieldset->addField('image', 'image', array(
          'label'     => Mage::helper('banner')->__('Banner Image'),
          'required'  => false,
          'name'      => 'image',
          'after_element_html' => $afterElementHtml,
	  ));
      
      
      
      $fieldset->addField('sort_order', 'text', array(
          'label'     => Mage::helper('banner')->__('Sort Order'),
          'required'  => false,
          'name'      => 'sort_order',
	  ));
      
    
      
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('banner')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('banner')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('banner')->__('Disabled'),
              ),
          ),
      ));
    
    /*Custom Code Start */
        $fieldset->addType('banner_description', Mage::getConfig()->getBlockClassName('Envista_Banner_Block_Adminhtml_Renderer_Bannerdescription'));

        $fieldset->addField('banner_desc', 'banner_description', array(
            'name'      => 'banner_desc',
            'label'     => $this->__('Banner Description'),
            'style'     => 'height:15em',
            'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(array('add_variables' => false, 'add_widgets' => false,'files_browser_window_url'=>$this->getBaseUrl().'admin/cms_wysiwyg_images/index/')),
            'wysiwyg'   => true,
            'value_class'   => 'bannerdescription'
        ));
    /*Custom code ends*/
    $fieldset->addField("banner_start_date", "date", array(
        "label" => Mage::helper("banner")->__("Banner Start Date"),
        'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT), 
        'after_element_html' => '<small>Comments</small>',
        'tabindex' => 1,
        'image' => $this->getSkinUrl('images/grid-cal.gif'),
        'name' =>   'banner_start_date',
        'time' =>   'true',
    ));
   
	$fieldset->addField("banner_expire_date", "date", array(
        "label" => Mage::helper("banner")->__("Banner Close Date"),
        'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT), 
        'after_element_html' => '<small>Comments</small>',
        'tabindex' => 1,
        'image' => $this->getSkinUrl('images/grid-cal.gif'),
        'name' =>   'banner_expire_date',
        'time' =>   'true',
    ));
	  if ( Mage::getSingleton('adminhtml/session')->getBannerData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getBannerData());
          Mage::getSingleton('adminhtml/session')->setBannerData(null);
      } elseif ( Mage::registry('banner_data') ) {
          $form->setValues(Mage::registry('banner_data')->getData());
          
      }
      return parent::_prepareForm();
  }
}