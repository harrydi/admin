<?php
class Omniesolutions_Career_Block_Adminhtml_Career_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("career_form", array("legend"=>Mage::helper("career")->__("Item information")));

				
						$fieldset->addField("firstname", "text", array(
						"label" => Mage::helper("career")->__("First Name"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "firstname",
						));
					
						$fieldset->addField("lastname", "text", array(
						"label" => Mage::helper("career")->__("Last Name"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "lastname",
						));
					
						$fieldset->addField("email", "text", array(
						"label" => Mage::helper("career")->__("Email"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "email",
						));
					
						$fieldset->addField("phone", "text", array(
						"label" => Mage::helper("career")->__("Phone No"),
						"name" => "phone",
						));
					
						$fieldset->addField("linkedIn", "text", array(
						"label" => Mage::helper("career")->__("Linkedin ID"),
						"name" => "linkedIn",
						));
					
						$fieldset->addField("department", "text", array(
						"label" => Mage::helper("career")->__("Department"),
						"name" => "department",
						));
					

				if (Mage::getSingleton("adminhtml/session")->getCareerData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getCareerData());
					Mage::getSingleton("adminhtml/session")->setCareerData(null);
				} 
				elseif(Mage::registry("career_data")) {
				    $form->setValues(Mage::registry("career_data")->getData());
				}
				return parent::_prepareForm();
		}
}
