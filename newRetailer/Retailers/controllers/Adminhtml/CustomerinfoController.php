<?php

class Omniesolutions_Retailers_Adminhtml_CustomerinfoController extends Mage_Adminhtml_Controller_Action
{
		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("retailers/customerinfo")->_addBreadcrumb(Mage::helper("adminhtml")->__("Customerinfo  Manager"),Mage::helper("adminhtml")->__("Customerinfo Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("Retailers"));
			    $this->_title($this->__("Manager Customerinfo"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("Retailers"));
				$this->_title($this->__("Customerinfo"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("retailers/customerinfo")->load($id);
				if ($model->getId()) {
					Mage::register("customerinfo_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("retailers/customerinfo");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Customerinfo Manager"), Mage::helper("adminhtml")->__("Customerinfo Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Customerinfo Description"), Mage::helper("adminhtml")->__("Customerinfo Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("retailers/adminhtml_customerinfo_edit"))->_addLeft($this->getLayout()->createBlock("retailers/adminhtml_customerinfo_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("retailers")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("Retailers"));
		$this->_title($this->__("Customerinfo"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("retailers/customerinfo")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("customerinfo_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("retailers/customerinfo");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Customerinfo Manager"), Mage::helper("adminhtml")->__("Customerinfo Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Customerinfo Description"), Mage::helper("adminhtml")->__("Customerinfo Description"));


		$this->_addContent($this->getLayout()->createBlock("retailers/adminhtml_customerinfo_edit"))->_addLeft($this->getLayout()->createBlock("retailers/adminhtml_customerinfo_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						

						$model = Mage::getModel("retailers/customerinfo")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Customerinfo was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setCustomerinfoData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setCustomerinfoData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("retailers/customerinfo");
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

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("retailers/customerinfo");
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
			$fileName   = 'customerinfo.csv';
			$grid       = $this->getLayout()->createBlock('retailers/adminhtml_customerinfo_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'customerinfo.xml';
			$grid       = $this->getLayout()->createBlock('retailers/adminhtml_customerinfo_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}
