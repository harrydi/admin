<?php
	
class Omniesolutions_Career_Block_Adminhtml_Openposition_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "id";
				$this->_blockGroup = "career";
				$this->_controller = "adminhtml_openposition";
				$this->_updateButton("save", "label", Mage::helper("career")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("career")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("career")->__("Save And Continue Edit"),
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
				if( Mage::registry("openposition_data") && Mage::registry("openposition_data")->getId() ){

				    return Mage::helper("career")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("openposition_data")->getId()));

				} 
				else{

				     return Mage::helper("career")->__("Add Item");

				}
		}
}