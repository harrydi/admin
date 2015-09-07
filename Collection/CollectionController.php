<?php

class Omniesolutions_CustomMenu_Adminhtml_CollectionController extends Mage_Adminhtml_Controller_Action
{
	
		/**
		 * Method for initilization
		 */
		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("custommenu/collection")->_addBreadcrumb(Mage::helper("adminhtml")->__("Collection  Manager"),Mage::helper("adminhtml")->__("Collection Manager"));
				return $this;
		}
		
		/**
		 * Index Action List data.
		 *
		 */
		public function indexAction() 
		{
			    $this->_title($this->__("CustomMenu"));
			    $this->_title($this->__("Manager Collection"));

				$this->_initAction();
				$this->renderLayout();
		}
		/**
		 * Edit Action Edit items in admin panel.
		 *
		 */
		public function editAction()
		{			    
			    $this->_title($this->__("CustomMenu"));
				$this->_title($this->__("Collection"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("custommenu/collection")->load($id);
				if ($model->getId()) {
					Mage::register("collection_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("custommenu/collection");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Collection Manager"), Mage::helper("adminhtml")->__("Collection Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Collection Description"), Mage::helper("adminhtml")->__("Collection Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("custommenu/adminhtml_collection_edit"))->_addLeft($this->getLayout()->createBlock("custommenu/adminhtml_collection_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("custommenu")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}
		
		/**
		 * New Action add New items in admin panel.
		 *
		 */
		public function newAction()
		{

		$this->_title($this->__("CustomMenu"));
		$this->_title($this->__("Collection"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("custommenu/collection")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("collection_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("custommenu/collection");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Collection Manager"), Mage::helper("adminhtml")->__("Collection Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Collection Description"), Mage::helper("adminhtml")->__("Collection Description"));


		$this->_addContent($this->getLayout()->createBlock("custommenu/adminhtml_collection_edit"))->_addLeft($this->getLayout()->createBlock("custommenu/adminhtml_collection_edit_tabs"));

		$this->renderLayout();

		}
		
		/**
		 * Save Action save data after add and Edit items in admin panel.
		 *
		 */
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();
				if ($post_data) {
					if($post_data['attribute_option_label']){
						if(!$this->attributeValueExists('product_collection',$post_data['attribute_option_label'])){
							$optionID = $this->addAttributeValue('product_collection',$post_data['attribute_option_label']);
							unset($post_data['attribute_option_value']);
							$post_data['attribute_option_value'] = $optionID;	
						}else{
							$optionID = $this->attributeValueExists('product_collection',$post_data['attribute_option_label']);
							unset($post_data['attribute_option_value']);
							$post_data['attribute_option_value'] = $optionID;	
						}	
					}

					try {
					//save image
						try{

							if((bool)$post_data['image']['delete']==1) {

										$post_data['image']='';

							}
							else {

								unset($post_data['image']);

								if (isset($_FILES)){

									if ($_FILES['image']['name']) {

										if($this->getRequest()->getParam("id")){
											$model = Mage::getModel("custommenu/collection")->load($this->getRequest()->getParam("id"));
											if($model->getData('image')){
													$io = new Varien_Io_File();
													$io->rm(Mage::getBaseDir('media').DS.implode(DS,explode('/',$model->getData('image'))));	
											}
										}
										$path = Mage::getBaseDir('media') . DS . 'custommenu' . DS .'collection'.DS;
										$uploader = new Varien_File_Uploader('image');
										$uploader->setAllowedExtensions(array('jpg','png','gif'));
										$uploader->setAllowRenameFiles(false);
										$uploader->setFilesDispersion(false);
										$destFile = $path.$_FILES['image']['name'];
										$filename = $uploader->getNewFileName($destFile);
										$uploader->save($path, $filename);

										$post_data['image']='custommenu/collection/'.$filename;
									}
								}
							}

						} catch (Exception $e) {
								Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
								$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
								return;
						}
						//save image


						$model = Mage::getModel("custommenu/collection")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Collection was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setCollectionData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setCollectionData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}


		/**
		 * Delete Action delete items from admin panel.
		 *
		 */
		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("custommenu/collection");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		/**
		 * massRemove Action delete multiple items from admin panel.
		 *
		 */
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("custommenu/collection");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
		/**
		 * Export order grid to CSV format
		 */
		public function exportCsvAction()
		{
			$fileName   = 'collection.csv';
			$grid       = $this->getLayout()->createBlock('custommenu/adminhtml_collection_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'collection.xml';
			$grid       = $this->getLayout()->createBlock('custommenu/adminhtml_collection_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
		
		/**
		 * addAttributeValue method add new Attribute Option value.
		 * @return option value
		 */
		public function addAttributeValue($arg_attribute, $arg_value)
		{
			$attribute_model        = Mage::getModel('eav/entity_attribute');

			$attribute_code         = $attribute_model->getIdByCode('catalog_product', $arg_attribute);
			$attribute              = $attribute_model->load($attribute_code);

			if(!$this->attributeValueExists($arg_attribute, $arg_value))
			{
				$value['option'] = array($arg_value,$arg_value);
				$result = array('value' => $value);
				$attribute->setData('option',$result);
				$attribute->save();
			}

			$attribute_options_model= Mage::getModel('eav/entity_attribute_source_table') ;
			$attribute_table        = $attribute_options_model->setAttribute($attribute);
			$options                = $attribute_options_model->getAllOptions(false);

			foreach($options as $option)
			{
				if ($option['label'] == $arg_value)
				{
					return $option['value'];
				}
			}
		   return false;
		}
		
		/**
		 * attributeValueExists method Check Option value exist.
		 * @return option value
		 */
		public function attributeValueExists($arg_attribute, $arg_value)
		{
			$attribute_model        = Mage::getModel('eav/entity_attribute');
			$attribute_options_model= Mage::getModel('eav/entity_attribute_source_table') ;

			$attribute_code         = $attribute_model->getIdByCode('catalog_product', $arg_attribute);
			$attribute              = $attribute_model->load($attribute_code);

			$attribute_table        = $attribute_options_model->setAttribute($attribute);
			$options                = $attribute_options_model->getAllOptions(false);

			foreach($options as $option)
			{
				if ($option['label'] == $arg_value)
				{
					return $option['value'];
				}
			}

			return false;
		}
		
		/**
		 * Check the permission to run it
		 *
		 * @return boolean
		 */
		protected function _isAllowed()
		{
			return Mage::getSingleton('admin/session')->isAllowed('socialspot/custommenu/collection');
		}
		
}
