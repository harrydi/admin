<?php
	
class Omniesolutions_Catalogdoc_Block_Adminhtml_Catalogdoc_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "id";
				$this->_blockGroup = "catalogdoc";
				$this->_controller = "adminhtml_catalogdoc";
				$this->_updateButton("save", "label", Mage::helper("catalogdoc")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("catalogdoc")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("catalogdoc")->__("Save And Continue Edit"),
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
				if( Mage::registry("catalogdoc_data") && Mage::registry("catalogdoc_data")->getId() ){

				    return Mage::helper("catalogdoc")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("catalogdoc_data")->getId()));

				} 
				else{

				     return Mage::helper("catalogdoc")->__("Add Item");

				}
		}
}