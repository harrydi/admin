<?php

class Omniesolutions_CustomMenu_Block_Adminhtml_Collection_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("collectionGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("custommenu/collection")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$enableDisable = Mage::getModel('custommenu/enabledisable')->toArray();
				
				$this->addColumn("id", array(
				"header" => Mage::helper("custommenu")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "id",
				));
                
				$this->addColumn("attribute_option_label", array(
					"header" => Mage::helper("custommenu")->__("Attribute Option Label"),
					"index" => "attribute_option_label",
				));
				
				$this->addColumn("sortorder", array(
					"header" => Mage::helper("custommenu")->__("Sort Order"),
					"index" => "sortorder",
				));
				
				$this->addColumn('status', array(
					'header'=>Mage::helper('custommenu')->__('Status'),
					'index'     => 'status',
					'width'     =>'100px',
					'type'      => 'options',
					'options'    => $enableDisable,
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
			
			return $this;
		}
		
		static public function getOptionArray1()
		{
            $data_array=array(); 
			$attributeId = Mage::getResourceModel('eav/entity_attribute')->getIdByCode('catalog_product','product_collection');
			$collection =Mage::getResourceModel('eav/entity_attribute_option_collection')
                ->setPositionOrder('asc')
                ->setAttributeFilter($attributeId)
                ->setStoreFilter(0)
                ->load();

			$i=1;
			foreach($collection->toOptionArray() as $k=>$v){
				foreach($v as $key=>$val){
					if($i % 2 == 0){
						$value = $val; $i++; 
					} else{
						$keyy = $val; $i++;
					}
					$data_array[$keyy]=$value;
				}
			} 
			return($data_array);
		}
		
		static public function getValueArray1()
		{
            $data_array=array();
			
			foreach(Omniesolutions_CustomMenu_Block_Adminhtml_Collection_Grid::getOptionArray1() as $k=>$v){
				$data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
			
}