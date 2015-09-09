<?php
class Omniesolutions_Mainslider_Block_Adminhtml_Mainslider_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("mainslider_form", array("legend"=>Mage::helper("mainslider")->__("Item information")));

				$fieldset->addField("title", "text", array(
					"label" => Mage::helper("mainslider")->__("Title"),					
					"class" => "required-entry",
					"required" => true,
					"name" => "title",
				));
								
				$fieldset->addField('image', 'image', array(
					'label' => Mage::helper('mainslider')->__('Images'),
					'name' => 'image',
					'note' => '(*.jpg, *.png, *.gif)',
				));
				$fieldset->addField("description", "textarea", array(
					"label" => Mage::helper("mainslider")->__("Description"),
					"name" => "description",
				));
			
				$fieldset->addField("url", "text", array(
					"label" => Mage::helper("mainslider")->__("URL"),
					"name" => "url",
				));
			
				$fieldset->addField("imageorder", "text", array(
					"label" => Mage::helper("mainslider")->__("Images Order"),
					"name" => "imageorder",
				));
							
				$fieldset->addField('status', 'select', array(
					'label'     => Mage::helper('mainslider')->__('Status'),
					'values'   => Omniesolutions_Mainslider_Block_Adminhtml_Mainslider_Grid::getValueArray5(),
					'name' => 'status',					
					"class" => "required-entry",
					"required" => true,
				));

				if (Mage::getSingleton("adminhtml/session")->getMainsliderData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getMainsliderData());
					Mage::getSingleton("adminhtml/session")->setMainsliderData(null);
				} 
				elseif(Mage::registry("mainslider_data")) {
				    $form->setValues(Mage::registry("mainslider_data")->getData());
				}
				return parent::_prepareForm();
		}
}
