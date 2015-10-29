<?php

class Omniesolutions_Catalogdoc_Block_Adminhtml_Catalogdoc_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("catalogdocGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("catalogdoc/catalogdoc")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("id", array(
				"header" => Mage::helper("catalogdoc")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "id",
				));
                
				$this->addColumn("title", array(
				"header" => Mage::helper("catalogdoc")->__("Title"),
				"index" => "title",
				));
				$this->addColumn("sort_order", array(
				"header" => Mage::helper("catalogdoc")->__("Sort Order"),
				"index" => "sort_order",
				));
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('id');
			$this->getMassactionBlock()->setFormFieldName('ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_catalogdoc', array(
					 'label'=> Mage::helper('catalogdoc')->__('Remove Catalogdoc'),
					 'url'  => $this->getUrl('*/adminhtml_catalogdoc/massRemove'),
					 'confirm' => Mage::helper('catalogdoc')->__('Are you sure?')
				));
			return $this;
		}
			

}