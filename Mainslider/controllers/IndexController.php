<?php
 /**
 * Created by OmnieSolutions.
 * Date: 1.08.15
 * Main Home page slider
 */
class Omniesolutions_Mainslider_IndexController extends Mage_Core_Controller_Front_Action{
    
	/**
	* Created by OmnieSolutions.
	* Date: 1.08.15
	* IndexAction
	* @param: No
	* @return: No 
	*/
	public function IndexAction() {
      
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Titlename"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("titlename", array(
                "label" => $this->__("Titlename"),
                "title" => $this->__("Titlename")
		   ));

      $this->renderLayout(); 
	  
    }
	
}