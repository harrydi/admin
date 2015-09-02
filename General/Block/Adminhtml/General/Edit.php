<?php
	
class Omniesolutions_General_Block_Adminhtml_General_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "id";
				$this->_blockGroup = "general";
				$this->_controller = "adminhtml_general";
				$this->_updateButton("save", "label", Mage::helper("general")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("general")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("general")->__("Save And Continue Edit"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);



				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
		}

		public function getHeaderText()
		{
				if( Mage::registry("general_data") && Mage::registry("general_data")->getId() ){

				    return Mage::helper("general")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("general_data")->getId()));

				} 
				else{

				     return Mage::helper("general")->__("Add Item");

				}
		}
}