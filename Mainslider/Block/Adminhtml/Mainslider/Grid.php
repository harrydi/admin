<?php

class Omniesolutions_Mainslider_Block_Adminhtml_Mainslider_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("mainsliderGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("mainslider/mainslider")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("id", array(
					"header" => Mage::helper("mainslider")->__("ID"),
					"align" =>"right",
					"width" => "50px",
					"type" => "number",
					"index" => "id",
				));
                $this->addColumn("title", array(
					"header" => Mage::helper("mainslider")->__("Title"),
					"index" => "title",
				));
				$this->addColumn("url", array(
					"header" => Mage::helper("mainslider")->__("URL"),
					"index" => "url",
				));
				$this->addColumn("imageorder", array(
					"header" => Mage::helper("mainslider")->__("Images Order"),
					"index" => "imageorder",
				));
				$this->addColumn('status', array(
					'header' => Mage::helper('mainslider')->__('Status'),
					'index' => 'status',
					'type' => 'options',
					'options'=>Omniesolutions_Mainslider_Block_Adminhtml_Mainslider_Grid::getOptionArray5(),				
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
			$this->getMassactionBlock()->addItem('remove_mainslider', array(
					 'label'=> Mage::helper('mainslider')->__('Remove Mainslider'),
					 'url'  => $this->getUrl('*/adminhtml_mainslider/massRemove'),
					 'confirm' => Mage::helper('mainslider')->__('Are you sure?')
				));
			return $this;
		}
		
		static public function getOptionArray5()
		{
            $data_array=array(); 
			$data_array[0]='Enable';
			$data_array[1]='Disable';
            return($data_array);
		}
		
		static public function getValueArray5()
		{
            $data_array=array();
			foreach(Omniesolutions_Mainslider_Block_Adminhtml_Mainslider_Grid::getOptionArray5() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);
		}
		
}