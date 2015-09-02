<?php
class Omniesolutions_General_Block_Adminhtml_General_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("general_form", array("legend"=>Mage::helper("general")->__("Item information")));

				
						$fieldset->addField("title", "text", array(
						"label" => Mage::helper("general")->__("Title"),
						"name" => "title",
						));
									
						 $fieldset->addField('interested', 'select', array(
						'label'     => Mage::helper('general')->__('Interested'),
						'values'   => Omniesolutions_General_Block_Adminhtml_General_Grid::getValueArray1(),
						'name' => 'interested',
						));

				if (Mage::getSingleton("adminhtml/session")->getGeneralData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getGeneralData());
					Mage::getSingleton("adminhtml/session")->setGeneralData(null);
				} 
				elseif(Mage::registry("general_data")) {
				    $form->setValues(Mage::registry("general_data")->getData());
				}
				return parent::_prepareForm();
		}
}
