<?php
class Omniesolutions_General_Block_Adminhtml_General_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("general_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("general")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("general")->__("Item Information"),
				"title" => Mage::helper("general")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("general/adminhtml_general_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
