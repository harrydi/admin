<?php
class Omniesolutions_Career_Block_Adminhtml_Openposition_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("openposition_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("career")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("career")->__("Item Information"),
				"title" => Mage::helper("career")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("career/adminhtml_openposition_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
