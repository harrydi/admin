<?php
class Omniesolutions_Catalogdoc_Block_Adminhtml_Catalogdoc_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("catalogdoc_form", array("legend"=>Mage::helper("catalogdoc")->__("Item information")));

				
						$fieldset->addField("title", "text", array(
						"label" => Mage::helper("catalogdoc")->__("Title"),
						"name" => "title",
						));
									
						$fieldset->addField('document', 'image', array(
						'label' => Mage::helper('catalogdoc')->__('Document'),
						'name' => 'document',
						'note' => '(*.jpg, *.png, *.gif)',
						));
						$fieldset->addField("sort_order", "text", array(
						"label" => Mage::helper("catalogdoc")->__("Sort Order"),
						"name" => "sort_order",
						));
					

				if (Mage::getSingleton("adminhtml/session")->getCatalogdocData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getCatalogdocData());
					Mage::getSingleton("adminhtml/session")->setCatalogdocData(null);
				} 
				elseif(Mage::registry("catalogdoc_data")) {
				    $form->setValues(Mage::registry("catalogdoc_data")->getData());
				}
				return parent::_prepareForm();
		}
}
