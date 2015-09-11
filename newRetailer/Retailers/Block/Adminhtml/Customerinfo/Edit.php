<?php
	
class Omniesolutions_Retailers_Block_Adminhtml_Customerinfo_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "id";
				$this->_blockGroup = "retailers";
				$this->_controller = "adminhtml_customerinfo";
				$this->_updateButton("save", "label", Mage::helper("retailers")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("retailers")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("retailers")->__("Save And Continue Edit"),
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
				if( Mage::registry("customerinfo_data") && Mage::registry("customerinfo_data")->getId() ){

				    return Mage::helper("retailers")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("customerinfo_data")->getId()));

				} 
				else{

				     return Mage::helper("retailers")->__("Add Item");

				}
		}
}