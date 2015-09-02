<?php

class Omniesolutions_General_Block_Adminhtml_General_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("generalGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("general/general")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("id", array(
				"header" => Mage::helper("general")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "id",
				));
                
				$this->addColumn("title", array(
				"header" => Mage::helper("general")->__("Title"),
				"index" => "title",
				));
						$this->addColumn('interested', array(
						'header' => Mage::helper('general')->__('Interested'),
						'index' => 'interested',
						'type' => 'options',
						'options'=>Omniesolutions_General_Block_Adminhtml_General_Grid::getOptionArray1(),				
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
			$this->getMassactionBlock()->addItem('remove_general', array(
					 'label'=> Mage::helper('general')->__('Remove General'),
					 'url'  => $this->getUrl('*/adminhtml_general/massRemove'),
					 'confirm' => Mage::helper('general')->__('Are you sure?')
				));
			return $this;
		}
			
		static public function getOptionArray1()
		{
            $data_array=array(); 
			$data_array[0]='book';
			$data_array[1]='copy';
			$data_array[2]='safdsdf';
            return($data_array);
		}
		static public function getValueArray1()
		{
            $data_array=array();
			foreach(Omniesolutions_General_Block_Adminhtml_General_Grid::getOptionArray1() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		

}