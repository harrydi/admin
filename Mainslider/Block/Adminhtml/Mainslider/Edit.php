<?php
	
class Omniesolutions_Mainslider_Block_Adminhtml_Mainslider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "id";
				$this->_blockGroup = "mainslider";
				$this->_controller = "adminhtml_mainslider";
				$this->_updateButton("save", "label", Mage::helper("mainslider")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("mainslider")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("mainslider")->__("Save And Continue Edit"),
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
				if( Mage::registry("mainslider_data") && Mage::registry("mainslider_data")->getId() ){

				    return Mage::helper("mainslider")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("mainslider_data")->getId()));

				} 
				else{

				     return Mage::helper("mainslider")->__("Add Item");

				}
		}
}