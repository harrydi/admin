<?php
class Omniesolutions_Catalogdoc_Block_Adminhtml_Catalogdoc_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("catalogdoc_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("catalogdoc")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("catalogdoc")->__("Item Information"),
				"title" => Mage::helper("catalogdoc")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("catalogdoc/adminhtml_catalogdoc_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
