<?php

class Omniesolutions_Career_Block_Adminhtml_Career_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("careerGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("career/career")->getCollection();
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
                
				$this->addColumn("firstname", array(
				"header" => Mage::helper("career")->__("First Name"),
				"index" => "firstname",
				));
				$this->addColumn("lastname", array(
				"header" => Mage::helper("career")->__("Last Name"),
				"index" => "lastname",
				));
				$this->addColumn("email", array(
				"header" => Mage::helper("career")->__("Email"),
				"index" => "email",
				));
				$this->addColumn("phone", array(
				"header" => Mage::helper("career")->__("Phone No"),
				"index" => "phone",
				));
				$this->addColumn("linkedIn", array(
				"header" => Mage::helper("career")->__("Linkedin ID"),
				"index" => "linkedIn",
				));
				$this->addColumn("department", array(
				"header" => Mage::helper("career")->__("Department"),
				"index" => "department",
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
			$this->getMassactionBlock()->addItem('remove_career', array(
					 'label'=> Mage::helper('career')->__('Remove Career'),
					 'url'  => $this->getUrl('*/adminhtml_career/massRemove'),
					 'confirm' => Mage::helper('career')->__('Are you sure?')
				));
			return $this;
		}
			

}