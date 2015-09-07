<?php
class Omniesolutions_CustomMenu_Block_Adminhtml_Collection_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("collection_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("custommenu")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("custommenu")->__("Item Information"),
				"title" => Mage::helper("custommenu")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("custommenu/adminhtml_collection_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
