<?php
 /**
 * Created by OmnieSolutions.
 * Date: 1.08.15
 * Main Home page slider Admin Crud operations
 */
class Omniesolutions_Mainslider_Adminhtml_MainsliderController extends Mage_Adminhtml_Controller_Action
{
	/**
	* Created by OmnieSolutions.
	* Date: 1.08.15
	* initAction
	* @param: No
	* @return: Object 
	*/
	protected function _initAction()
	{
			$this->loadLayout()->_setActiveMenu("mainslider/mainslider")->_addBreadcrumb(Mage::helper("adminhtml")->__("Mainslider  Manager"),Mage::helper("adminhtml")->__("Mainslider Manager"));
			return $this;
	}
	
	/**
	* Created by OmnieSolutions.
	* Date: 1.08.15
	* IndexAction
	* @param: No
	* @return: No 
	*/
	public function indexAction() 
	{
			$this->_title($this->__("Mainslider"));
			$this->_title($this->__("Manager Mainslider"));

			$this->_initAction();
			$this->renderLayout();
	}
	
	/**
	* Created by OmnieSolutions.
	* Date: 1.08.15
	* EditAction
	*/
	public function editAction()
	{			    
			$this->_title($this->__("Mainslider"));
			$this->_title($this->__("Mainslider"));
			$this->_title($this->__("Edit Item"));
			
			$id = $this->getRequest()->getParam("id");
			$model = Mage::getModel("mainslider/mainslider")->load($id);
			if ($model->getId()) {
				Mage::register("mainslider_data", $model);
				$this->loadLayout();
				$this->_setActiveMenu("mainslider/mainslider");
				$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Mainslider Manager"), Mage::helper("adminhtml")->__("Mainslider Manager"));
				$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Mainslider Description"), Mage::helper("adminhtml")->__("Mainslider Description"));
				$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
				$this->_addContent($this->getLayout()->createBlock("mainslider/adminhtml_mainslider_edit"))->_addLeft($this->getLayout()->createBlock("mainslider/adminhtml_mainslider_edit_tabs"));
				$this->renderLayout();
			} 
			else {
				Mage::getSingleton("adminhtml/session")->addError(Mage::helper("mainslider")->__("Item does not exist."));
				$this->_redirect("*/*/");
			}
	}

	/**
	* Created by OmnieSolutions.
	* Date: 1.08.15
	* newAction (Add new slider)
	*/
	public function newAction()
	{

	$this->_title($this->__("Mainslider"));
	$this->_title($this->__("Mainslider"));
	$this->_title($this->__("New Item"));

	$id   = $this->getRequest()->getParam("id");
	$model  = Mage::getModel("mainslider/mainslider")->load($id);

	$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
	if (!empty($data)) {
		$model->setData($data);
	}

	Mage::register("mainslider_data", $model);

	$this->loadLayout();
	$this->_setActiveMenu("mainslider/mainslider");

	$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

	$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Mainslider Manager"), Mage::helper("adminhtml")->__("Mainslider Manager"));
	$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Mainslider Description"), Mage::helper("adminhtml")->__("Mainslider Description"));


	$this->_addContent($this->getLayout()->createBlock("mainslider/adminhtml_mainslider_edit"))->_addLeft($this->getLayout()->createBlock("mainslider/adminhtml_mainslider_edit_tabs"));

	$this->renderLayout();

	}
	
	/**
	* Created by OmnieSolutions.
	* Date: 1.08.15
	* saveAction ( Save slider Data)
	*/
	public function saveAction()
	{
		$post_data=$this->getRequest()->getPost();
		if ($post_data) {
			try {
				/* save image  Starts Here*/
				try {
					if ((bool) $post_data['image']['delete'] == 1) {
						$post_data['image'] = '';
					} else {
						unset($post_data['image']);
						if (isset($_FILES)) {
							if ($_FILES['image']['name']) {
								if ($this->getRequest()->getParam("id")) {
									$model = Mage::getModel("mainslider/mainslider")->load($this->getRequest()->getParam("id"));
									if ($model->getData('image')) {
										$io = new Varien_Io_File();
										$io->rm(Mage::getBaseDir('media') . DS . implode(DS, explode('/', $model->getData('image'))));
									}
								}
								$path = Mage::getBaseDir('media') . DS . 'mainslider' . DS . 'mainslider' . DS;
								if (!file_exists($path)) {
									mkdir($path, 777, true);
								}
								$uploader = new Varien_File_Uploader('image');
								$uploader->setAllowedExtensions(array('jpg', 'png', 'gif'));
								$uploader->setAllowRenameFiles(false);
								$uploader->setFilesDispersion(false);
								$destFile = $path . $_FILES['image']['name'];
								$filename = $uploader->getNewFileName($destFile);
								$uploader->save($path, $filename);

								$post_data['image'] = 'mainslider/mainslider/' . $filename;
							}
						}
					}
				} catch (Exception $e) {
					Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
					$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
					return;
				}
				/* save image  Starts Ends */

				$model = Mage::getModel("mainslider/mainslider")
				->addData($post_data)
				->setId($this->getRequest()->getParam("id"))
				->save();

				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Mainslider was successfully saved"));
				Mage::getSingleton("adminhtml/session")->setMainsliderData(false);

				if ($this->getRequest()->getParam("back")) {
					$this->_redirect("*/*/edit", array("id" => $model->getId()));
					return;
				}
				$this->_redirect("*/*/");
				return;
			} 
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
				Mage::getSingleton("adminhtml/session")->setMainsliderData($this->getRequest()->getPost());
				$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
			return;
			}

		}
		$this->_redirect("*/*/");
	}

	/**
	* Created by OmnieSolutions.
	* Date: 1.08.15
	* deleteAction ( delete slider Data)
	*/

	public function deleteAction()
	{
		if( $this->getRequest()->getParam("id") > 0 ) {
			try {
				$model = Mage::getModel("mainslider/mainslider");
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
	* Created by OmnieSolutions.
	* Date: 1.08.15
	* massRemoveAction ( Remove multiple slider Data)
	*/
	
	public function massRemoveAction()
	{
		try {
			$ids = $this->getRequest()->getPost('ids', array());
			foreach ($ids as $id) {
				  $model = Mage::getModel("mainslider/mainslider");
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
		$fileName   = 'mainslider.csv';
		$grid       = $this->getLayout()->createBlock('mainslider/adminhtml_mainslider_grid');
		$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
	} 
	/**
	 *  Export order grid to Excel XML format
	 */
	public function exportExcelAction()
	{
		$fileName   = 'mainslider.xml';
		$grid       = $this->getLayout()->createBlock('mainslider/adminhtml_mainslider_grid');
		$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
	}
	
	/**
     * Check access (in the ACL) for current user
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('socialspot/mainslider');
    }
	
}
