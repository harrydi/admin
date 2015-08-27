<?php

class Omniesolutions_Career_Block_Adminhtml_Openposition_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("openpositionGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("career/openposition")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("id", array(
				"header" => Mage::helper("career")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "id",
				));
                
				$this->addColumn("title", array(
				"header" => Mage::helper("career")->__("Title"),
				"index" => "title",
				));
				$this->addColumn("location", array(
				"header" => Mage::helper("career")->__("Location"),
				"index" => "location",
				));
					$this->addColumn('fromdate', array(
						'header'    => Mage::helper('career')->__('From Date'),
						'index'     => 'fromdate',
						'type'      => 'datetime',
					));
					$this->addColumn('todate', array(
						'header'    => Mage::helper('career')->__('To Date'),
						'index'     => 'todate',
						'type'      => 'datetime',
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
			$this->getMassactionBlock()->addItem('remove_openposition', array(
					 'label'=> Mage::helper('career')->__('Remove Openposition'),
					 'url'  => $this->getUrl('*/adminhtml_openposition/massRemove'),
					 'confirm' => Mage::helper('career')->__('Are you sure?')
				));
			return $this;
		}
			

}