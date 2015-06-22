<?php

class Envista_Banner_Adminhtml_BannerController extends Mage_Adminhtml_Controller_action {

    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('banner/items')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));

        return $this;
    }

    public function indexAction() {  
        $this->_initAction()
                ->renderLayout();
    }

    protected function _prepareLayout() {
		parent::_prepareLayout();
		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
		}
	} 
    
	 public function wysiwygAction()
    {
        $elementId = $this->getRequest()->getParam('element_id', md5(microtime()));
        $storeId = $this->getRequest()->getParam('store_id', 0);
        $storeMediaUrl = Mage::app()->getStore($storeId)->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);

        $content = $this->getLayout()->createBlock('adminhtml/catalog_helper_form_wysiwyg_content', '', array(
            'editor_element_id' => $elementId,
            'store_id'          => $storeId,
            'store_media_url'   => $storeMediaUrl,
        ));
        $this->getResponse()->setBody($content->toHtml());
    }
	
    public function editAction() { 
        $id = $this->getRequest()->getParam('id');
		$model = Mage::getModel('banner/banner')->getCollection();         
		$model = Mage::getModel('banner/banner')->load($id);  
		if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('banner_data', $model);
			$this->loadLayout();
            $this->_setActiveMenu('banner/items');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_initProduct();
			$this->_addContent($this->getLayout()->createBlock('banner/adminhtml_banner_edit'))
                    ->_addLeft($this->getLayout()->createBlock('banner/adminhtml_banner_edit_tabs'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('banner')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAction() {      
        if ($data = $this->getRequest()->getPost()) { 
            $model = Mage::getModel('banner/banner');
            $upload_dir = $model->uploaded_media_dir;
            $upload_product_dir = $model->uploaded_product_dir;
            if (isset($data['image'])) {
                if (isset($data['image']['delete']) && $data['image']['delete'] == 1) {
                    unlink(Mage::getBaseDir('media') . DS . $data['image']['value']);
                    $data['image'] = '';
                } else {
                    $data['image'] = $data['image']['value'];
                }
            }
             if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                try {
                     /* Starting upload */
                    $uploader = new Varien_File_Uploader('image');
                    // Any extention would work
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                    $uploader->setAllowRenameFiles(false);
                    // Set the file upload mode 
                    // false -> get the file directly in the specified folder
                    // true -> get the file in the product like folders 
                    //	(file.jpg will go in something like /media/f/i/file.jpg)
                    $uploader->setFilesDispersion(false);
                    // We set media as the upload dir
                    $path = Mage::getBaseDir('media') . DS . $upload_dir;
                    if (!is_dir($path)) {
                        $old = umask(0);
                        mkdir($path, 0777);
                        umask($old);
                    }
                    $uploader->save($path, $_FILES['image']['name']);
                    $data['image'] = $upload_dir . '/' . $uploader->getUploadedFileName();
                } catch (Exception $e) {
                    
                }
            }
            $model = Mage::getModel('banner/banner');
            $model->setData($data)->setId($this->getRequest()->getParam('id'));
            
            $endDate = $data['banner_expire_date'];
            echo $endDate;
            $dateTimestamp = Mage::getModel('core/date')->timestamp(strtotime($endDate));
            $endDate = date('Y-m-d', $dateTimestamp);
            try {
                if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
                    $model->setCreatedTime(now())
                            ->setUpdateTime(now());
                } else {
                    $model->setUpdateTime(now());
                }
                $model->save();
				$descriptionmodel = Mage::getModel('banner/description');
                    if($this->getRequest()->getParam('id')){
                        $id = $this->getRequest()->getParam('id');
                    }
                    elseif($model->getId()){
                        $id = $model->getId();
                    }
                    else{
                        $id = '';
                    }
				$modid = $model->getId();
                
                foreach($data['banner_desc'] as $key => $value){			
					$data = array('banner_desc' => $value, 'store_view' => $key, 
					   'banner_id' => $id);
					$read= Mage::getSingleton('core/resource')->getConnection('core_read');
					$exec=$read->query("SELECT id from banner_description where banner_id='".$id."' AND store_view='".$key."'");
					$row = $exec->fetch();
					if(!empty($row)){ 					
						$tt = $descriptionmodel->load($row['id'])->addData($data);
						$tt->setId($row['id'])->save();
					}
					else{ 
						$descriptionmodel->setData($data)->save(); 
					}
				}			
                
                
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('banner')->__('Banner was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('banner')->__('Unable to find banner to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
				$bannerId = $this->getRequest()->getParam('id');
                $model = Mage::getModel('banner/banner');
				
				/*Banner Description*/
				$modeldesc = Mage::getSingleton('core/resource')->getConnection('core_write');
                $where = "banner_id = '".$this->getRequest()->getParam('id')."'"; 
				$modeldesc->delete("banner_description", $where);
				
				$model->setId($this->getRequest()->getParam('id'))
                        ->delete();
				unlink(Mage::getBaseDir('media').DS.$model->getImage());
                $model->setId($bannerId)->delete();
                unlink(Mage::getBaseDir('media').DS.$model->getScreenshot());
                $model->setId($bannerId)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        $bannerIds = $this->getRequest()->getParam('banner');
        if (!is_array($bannerIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($bannerIds as $bannerId) {
                    $banner = Mage::getModel('banner/banner')->load($bannerId);
					
					$modeldesc = Mage::getSingleton('core/resource')->getConnection('core_write');
					$modeldesc->query("delete from banner_description where banner_id = '".$bannerId."'");
					/*Banner Product Delete*/
					$modelprod = Mage::getSingleton('core/resource')->getConnection('core_write');				
					$modelprod->query("delete from banner_product where banner_id = '".$bannerId."'");
					/*End of Banner product Delete*/
				    $banner->load($bannerId);
                    unlink(Mage::getBaseDir('media').DS.$banner->getImage());
                    $banner->setId($bannerId)->delete();
                    unlink(Mage::getBaseDir('media').DS.$banner->getScreenshot());
                    $banner->setId($bannerId)->delete();
                    $banner->delete();
				}
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')->__(
                                'Total of %d record(s) were successfully deleted', count($bannerIds)
                        )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massStatusAction() {
        $bannerIds = $this->getRequest()->getParam('banner');
        if (!is_array($bannerIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($bannerIds as $bannerId) {
                    $banner = Mage::getSingleton('banner/banner')
                            ->load($bannerId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) were successfully updated', count($bannerIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function exportCsvAction() {
        $fileName = 'banner.csv';
        $content = $this->getLayout()->createBlock('banner/adminhtml_banner_grid')
                ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction() {
        $fileName = 'banner.xml';
        $content = $this->getLayout()->createBlock('banner/adminhtml_banner_grid')
                ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType = 'application/octet-stream') {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK', '');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename=' . $fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
    }
    
    public function categoriesJsonAction() {
        $product = $this->_initProduct();
        $this->getResponse()->setBody(
                $this->getLayout()->createBlock('banner/adminhtml_banner_edit_tab_categories')
                        ->getCategoryChildrenJson($this->getRequest()->getParam('category'))
        );
    }

    protected function _initProduct() {
        if (!isset($this->_product)) {
            //Getting Banner Id
            $bannerId = (int) $this->getRequest()->getParam('id');
            $banner = Mage::getModel('banner/banner')->load($bannerId);
            $banner->setData('_edit_mode', true);
            if ($bannerId) {
                try {
                    $banner->load($bannerId);
					$category_ids = $banner->getData('category_ids');
					$banner->setCategoryIds(explode(',', $category_ids));
                } catch (Exception $e) {
                    $banner->setTypeId(Mage_Catalog_Model_Product_Type::DEFAULT_TYPE);
                    Mage::logException($e);
                }
            }
            $this->_product = $banner;
            Mage::register('current_banner', $banner);            
        }
        return $this->_product;
    }
}