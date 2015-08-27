<?php
class Omniesolutions_Career_Block_Adminhtml_Openposition_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("career_form", array("legend"=>Mage::helper("career")->__("Item information")));

				
						$fieldset->addField("title", "text", array(
						"label" => Mage::helper("career")->__("Title"),
						"name" => "title",
						));
					
						$fieldset->addField("location", "text", array(
						"label" => Mage::helper("career")->__("Location"),
						"name" => "location",
						));
					
						$fieldset->addField("description", "textarea", array(
						"label" => Mage::helper("career")->__("Description"),
						"name" => "description",
						));
					
						$dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(
							Mage_Core_Model_Locale::FORMAT_TYPE_SHORT
						);

						$fieldset->addField('fromdate', 'date', array(
						'label'        => Mage::helper('career')->__('From Date'),
						'name'         => 'fromdate',
						'time' => true,
						'image'        => $this->getSkinUrl('images/grid-cal.gif'),
						'format'       => $dateFormatIso
						));
						$dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(
							Mage_Core_Model_Locale::FORMAT_TYPE_SHORT
						);

						$fieldset->addField('todate', 'date', array(
						'label'        => Mage::helper('career')->__('To Date'),
						'name'         => 'todate',
						'time' => true,
						'image'        => $this->getSkinUrl('images/grid-cal.gif'),
						'format'       => $dateFormatIso
						));

				if (Mage::getSingleton("adminhtml/session")->getOpenpositionData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getOpenpositionData());
					Mage::getSingleton("adminhtml/session")->setOpenpositionData(null);
				} 
				elseif(Mage::registry("openposition_data")) {
				    $form->setValues(Mage::registry("openposition_data")->getData());
				}
				return parent::_prepareForm();
		}
}
