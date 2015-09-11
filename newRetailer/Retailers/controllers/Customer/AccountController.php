<?php
require_once "Mage/Customer/controllers/AccountController.php";  
class Omniesolutions_Retailers_Customer_AccountController extends Mage_Customer_AccountController{
   public function createwholesaleAction()
    {
        if ($this->_getSession()->isLoggedIn()) {
            $this->_redirect('*/*');
            return;
        }
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        $this->renderLayout();
    }
	
	/**
     * Create customer account action
     */
    public function createPostAction()
    {
        /** @var $session Mage_Customer_Model_Session */
        $session = $this->_getSession();
        if ($session->isLoggedIn()) {
            $this->_redirect('*/*/');
            return;
        }
        $session->setEscapeMessages(true); // prevent XSS injection in user input
        if (!$this->getRequest()->isPost()) {
            $errUrl = $this->_getUrl('*/*/create', array('_secure' => true));
            $this->_redirectError($errUrl);
            return;
        }
		$customer = $this->_getCustomer();
		try {
			if($this->getRequest()->getPost('group_id')){ 
                $customer->setGroupId($this->getRequest()->getPost('group_id'));
            } else {
                $customer->getGroupId(); 
            } 
			
			
            $errors = $this->_getCustomerErrors($customer);

            if (empty($errors)) {
                $customer->cleanPasswordsValidationData();
                $customer->save();
				/* NItin */
				$detail = $this->getRequest()->getPost('detail');
				$description = $this->getRequest()->getPost('description');
				$customer_id = $customer->getId();
				$data = Mage::getModel('retailers/customerinfo');
				$data->setData('detail', $detail);
				$data->setData('description', $description);
				$data->setData('customer_id', $customer_id);
				try{
					$saved = $data->save();
					Mage::getSingleton('core/session')->addSuccess('Details For '. $customer_id .' has been Saved Successfully');
				}catch (Exception $ex) {
					Mage::getSingleton('core/session')->addError($ex->getMessage());
				} 
				/* NItin */
				
                $this->_dispatchRegisterSuccess($customer);
                $this->_successProcessRegistration($customer);
                return;
            } else {
                $this->_addSessionError($errors);
            }
        } catch (Mage_Core_Exception $e) {
            $session->setCustomerFormData($this->getRequest()->getPost());
            if ($e->getCode() === Mage_Customer_Model_Customer::EXCEPTION_EMAIL_EXISTS) {
                $url = $this->_getUrl('customer/account/forgotpassword');
                $message = $this->__('There is already an account with this email address. If you are sure that it is your email address, <a href="%s">click here</a> to get your password and access your account.', $url);
                $session->setEscapeMessages(false);
            } else {
                $message = $e->getMessage();
            }
            $session->addError($message);
        } catch (Exception $e) {
            $session->setCustomerFormData($this->getRequest()->getPost())
                ->addException($e, $this->__('Cannot save the customer.'));
        }
        $errUrl = $this->_getUrl('*/*/create', array('_secure' => true));
        $this->_redirectError($errUrl);
    }
}
				