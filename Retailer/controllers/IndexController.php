<?php
class Omniesolutions_Retailer_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
      
		if($this->getRequest()->getParam('registration') == 'retailer'){
			$this->_redirect('retailers');
		}else{
			$this->_redirect('customer/account/create/');
		}	  
    }
}