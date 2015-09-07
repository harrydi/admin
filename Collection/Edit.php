<?php
	
class Omniesolutions_CustomMenu_Block_Adminhtml_Collection_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "id";
				$this->_blockGroup = "custommenu";
				$this->_controller = "adminhtml_collection";
				$this->_updateButton("save", "label", Mage::helper("custommenu")->__("Save Item"));
				
				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("custommenu")->__("Save And Continue Edit"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);



				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
				$this->_removeButton('delete');
		}

		public function getHeaderText()
		{
				if( Mage::registry("collection_data") && Mage::registry("collection_data")->getId() ){

				    return Mage::helper("custommenu")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("collection_data")->getId()));

				} 
				else{

				     return Mage::helper("custommenu")->__("Add Item");

				}
		}
}