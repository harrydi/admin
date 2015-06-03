<?php
class Webkul_Marketplace_IndexController extends Mage_Core_Controller_Front_Action{
    
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

	public function saveAction() {
		if(isset($_FILES['docname']['name']) && $_FILES['docname']['name'] != '')
		{
			try
			{      
				$path = Mage::getBaseDir().DS.'delete'.DS;  //desitnation directory   
				echo 'File Uploaded to this path => '. $path;
				if (!file_exists($path)) {
					mkdir($path, 777, true);
				}
				$fname = $_FILES['docname']['name']; //file name                       
				$uploader = new Varien_File_Uploader('docname'); //load class
				$uploader->setAllowedExtensions(array('csv')); //Allowed extension for file
				$uploader->setAllowCreateFolders(true); //for creating the directory if not exists
				$uploader->setAllowRenameFiles(false); //if true, uploaded file's name will be changed, if file with the same name already exists directory.
				$uploader->setFilesDispersion(false);
				$uploader->save($path,$fname); //save the file on the specified path
			}
			catch (Exception $e)
			{
				echo 'Error Message: '.$e->getMessage();
			}
		}
		$this->importCsvFile(); 
	}	
	
	public function importCsvFile() {
		$imagepath = 'D:\wamp\www\magento\delete\1.jpg';
		$imagepath2 = 'D:\wamp\www\magento\delete\2.jpg';
		$categoryids = array(4,5,10);
		if (($handle = fopen("Delete\allproductspp.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			echo 'Importing product: '.$data[0].'<br />';
			$num = count($data);
			//echo "<p> $num fields in line $row: <br /></p>\n";
			$row++;
			if($row == 1) continue;
			$product = Mage::getModel('catalog/product');
			$product->setSku($data[0]);
			$product->setName($data[2]);
			$product->setDescription($data[4]);
			$product->setShortDescription($data[9]);
			$product->setPrice($data[10]);
			$product->setAttributeSetId(20); // enter the catalog attribute set id here
			
			$product->setCategoryIds($categoryids); // id of categories
			$product->setWeight(1.0);
			$product->setTaxClassId($data[15]);
			$product->setStatus($data[3]);
			//$product->setBrand($brand);
			
			// assign product to the default website
			$product->setWebsiteIds(array(Mage::app()->getStore(true)->getWebsite()->getId()));
			if($data[5] == 'simple'){
				$product->setTypeId($data[5]);
				$product->setColor(24);
				$product->setStockData(array(
						'manage_stock' => 1,
						'is_in_stock' => 1,
						'qty' => $data[6]
					)
				);
				$product->addImageToMediaGallery($imagepath, array('image', 'small_image', 'thumbnail'),false,false); // absolute path of image in local file system
				$product->setVisibility(1); //////
			}elseif($data[5] == 'configurable'){
				$product->setTypeId($data[5]);
				$product->setStockData(array(
					'use_config_manage_stock' => 0, //'Use config settings' checkbox
					'manage_stock' => 1, //manage stock
					'is_in_stock' => 1, //Stock Availability
					)
				);
				$product->addImageToMediaGallery($imagepath2, array('image', 'small_image', 'thumbnail'),false,false); // absolute path of image in local file system
				$product->setVisibility(4); //////
				/**/
				/** assigning associated product to configurable */
				/**/
				$product->getTypeInstance()->setUsedProductAttributeIds(array(92)); //attribute ID of attribute 'color' in my store
				$configurableAttributesData = $product->getTypeInstance()->getConfigurableAttributesAsArray();
			 
				$product->setCanSaveConfigurableAttributes(true);
				$product->setConfigurableAttributesData($configurableAttributesData);
			 
				$configurableProductsData = array();
				$configurableProductsData['949'] = array( //['920'] = id of a simple product associated with this configurable
					'0' => array(
						'label' => 'Green', //attribute label
						'attribute_id' => '92', //attribute ID of attribute 'color' in my store
						'value_index' => '24', //value of 'Green' index of the attribute 'color'
						'is_percent' => '0', //fixed/percent price for this option
						'pricing_value' => '21' //value for the pricing
					)
				);
				$product->setConfigurableProductsData($configurableProductsData);

				/*  */
			}
			try{
				$product->save();
				echo $product->getId().'  Save Successfully';
			}
			catch (Exception $ex) {
				echo $ex->getMessage();
				//Handle the error
			}
		}
		fclose($handle); 
		echo 'Done';
	}
	}
}