<?php
class Omniesolutions_Career_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
      
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Career"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home"),
                "title" => $this->__("Home"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("career", array(
                "label" => $this->__("Career"),
                "title" => $this->__("Career")
		   ));

      $this->renderLayout(); 
	  
    }
	
	/**
	* Save the general inquiry data
	*
	* Redirect to indexAction after saving data
	*/
	public function saveAction(){
		$firstname = $this->getRequest()->getPost('firstname');
		$lastname = $this->getRequest()->getPost('lastname');
		$phone = $this->getRequest()->getPost('phone');
		$email = $this->getRequest()->getPost('email');
		$linkedin = $this->getRequest()->getPost('linkedin');
		$department = implode(',', $this->getRequest()->getPost('department'));
		$message = $this->getRequest()->getPost('message');
		if(isset($_FILES['docname']['name']) && $_FILES['docname']['name'] != '' &&  isset($firstname)&&($firstname!='') && isset($lastname)&&($lastname!='') && isset($phone)&&($phone!='') && isset($email)&&($email!='') && isset($linkedin)&&($linkedin!='') && isset($department)&&($department!='') && isset($message)&&($message!='') ){
			try{      
				$path = Mage::getBaseDir().DS.'resume'.DS;  //desitnation directory    
				$fname = $_FILES['docname']['name']; //file name                       
				$uploader = new Varien_File_Uploader('docname'); //load class
				$uploader->setAllowedExtensions(array('doc','pdf','docx')); //Allowed extension for file
				$uploader->setAllowCreateFolders(true); //for creating the directory if not exists
				$uploader->setAllowRenameFiles(false); //if true, uploaded file's name will be changed, if file with the same name already exists directory.
				$uploader->setFilesDispersion(false);
				$uploader->save($path,$fname); //save the file on the specified path
				
				Mage::getSingleton('core/session')->addSuccess('Resume has been Uploaded Successfully'); //Success Message
				
				$data = Mage::getModel('career/career');
				$data->setData('firstname', $firstname);
				$data->setData('lastname', $lastname);
				$data->setData('phone', $phone);
				$data->setData('email', $email);
				$data->setData('linkedIn', $linkedin);
				$data->setData('department', $department);
				$data->setData('resume', 'resume'.DS.$fname);
				$data->setData('message', $message);
				try{
					$saved = $data->save();
					Mage::getSingleton('core/session')->addSuccess('Details For '. $firstname .' has been Saved Successfully');
				}catch (Exception $ex) {
					Mage::getSingleton('core/session')->addError($ex->getMessage());
				} 
			}catch (Exception $e){
				Mage::getSingleton('core/session')->addError('Error..'.$e->getMessage());
				$this->_redirect('career/index/index'); 
			}			
		}
		$this->_redirect('career/index/index');
	}
}