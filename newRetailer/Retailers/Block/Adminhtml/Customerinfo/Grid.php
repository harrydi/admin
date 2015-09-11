<?php

class Omniesolutions_Retailers_Block_Adminhtml_Customerinfo_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("customerinfoGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("retailers/customerinfo")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("id", array(
				"header" => Mage::helper("retailers")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "id",
				));
                
				$this->addColumn("customer_id", array(
				"header" => Mage::helper("retailers")->__("Customer ID"),
				"index" => "customer_id",
				));
				$this->addColumn("detail", array(
				"header" => Mage::helper("retailers")->__("Detail"),
				"index" => "detail",
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
			$this->getMassactionBlock()->addItem('remove_customerinfo', array(
					 'label'=> Mage::helper('retailers')->__('Remove Customerinfo'),
					 'url'  => $this->getUrl('*/adminhtml_customerinfo/massRemove'),
					 'confirm' => Mage::helper('retailers')->__('Are you sure?')
				));
			return $this;
		}
			

}