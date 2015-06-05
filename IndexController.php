<?php
class Webkul_Marketplace_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction(){
		$marketplacelabel=Mage::getStoreConfig('marketplace/marketplace_options/marketplacelabel');
		$this->loadLayout(array('default','marketplace_index_toplinkmarketplace'));
		$this->getLayout()->getBlock('head')->setTitle( Mage::helper('marketplace')->__($marketplacelabel));
		$this->renderLayout();
    }
	public function toplinkmarketplaceAction(){
		$this->loadLayout(); 
		$this->renderLayout();
	}
	
	public function importAction(){
		$this->loadLayout(); 
		$this->renderLayout();
		if(!Mage::getModel('marketplace/userprofile')->isPartner()){
		  $this->_redirect();
		}
	}
	
	/**
	* Save csv file in root/delete directory
	* 
	*/
	public function saveAction() {
		if(isset($_FILES['docname']['name']) && $_FILES['docname']['name'] != ''){
			try{      
				$path = Mage::getBaseDir().DS.'delete'.DS;  //desitnation directory   
				//echo 'File Uploaded to this path => '. $path;
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
			catch (Exception $e){
				echo 'Error Message: '.$e->getMessage();
			}
		}
		$this->importCsvFile();
		$this->moveCsvFile($path);	
	}
	/**
	* move CSV after import
	* 
	*/
	public function moveCsvFile($path) {
		//$path = Mage::getBaseDir().DS.'delete'.DS;
		$files = scandir($path);
		// Identify directories
		$source = $path;
		$vendorId = Mage::getSingleton('customer/session')->getCustomer()->getId();
		$destination = $path.'Archive-VID-'.$vendorId.'-'.time().DS;
		if (!file_exists($destination)) {
			mkdir($destination, 777, true);
		}
		// Cycle through all source files
		foreach ( $files as $file ) {
			if (in_array($file, array(".",".."))) continue;
			// If we copied this successfully, mark it for deletion
			if (copy($source.$file, $destination.$file)) {
				$delete[] = $source.$file;
			}
		}
		// Delete all successfully-copied files
		foreach ( $delete as $file ) {
			unlink( $file );
		}
		$this->_redirect();
	}
	/**
	* Import Product from CSV file.
	*
	*/
	
	public function importCsvFile() {
		
		if (($handle = fopen("delete\allproductspp.csv", "r")) !== FALSE) {
			$row = 0;
			//$categoryids = array(4);
			$sizeAttributeId = Mage::getModel('eav/entity_attribute')->getIdByCode('catalog_product', 'size');
			$colorAttributeId = Mage::getModel('eav/entity_attribute')->getIdByCode('catalog_product', 'color');
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				//echo 'Importing product: '.$data[0].'<br />';
				$num = count($data);
				$row++;
				if($row == 1) continue;
				if($data[0]=='') continue;
				if(Mage::getModel('catalog/product')->loadByAttribute('sku', $data[0])) continue;
				$imagepath = $this->downloadImage($data[17],$data[0]);
				$categories = $data[8]; /// all SKU of simple products belongs to configurable product.
				$categoryids = array();
				$categoryids = explode("|",$categories);
				$product = Mage::getModel('catalog/product');
				$product->setSku($data[0]);
				$product->setName($data[2]);
				$product->setDescription($data[4]);
				$product->setShortDescription($data[9]);
				$product->setPrice($data[10]);
				$product->setAttributeSetId(4); // enter the catalog attribute set id here
				
				$product->setCategoryIds($categoryids); // id of categories
				$product->setWeight(1.0);
				$product->setTaxClassId($data[15]);
				$product->setStatus($data[3]);
				// assign product to the default website
				$product->setWebsiteIds(array(Mage::app()->getStore(true)->getWebsite()->getId()));
				if($data[5] == 'simple'){
					if($data[18]){
						$optionId = $this->_getOptionIDByCode('color', $data[18]);
						$product->setColor($optionId);
					} 
					if($data[19]){
						$optionId = $this->_getOptionIDByCode('size', $data[19]);
						$product->setSize($optionId);
					}
					$product->setTypeId($data[5]);
					$product->setStockData(array(
							'manage_stock' => 1,
							'is_in_stock' => 1,
							'qty' => $data[6]
						)
					);
					$product->setVisibility(1); // Simple prod is Not visible individually. 
				}
				elseif($data[5] == 'configurable'){
					$product->setTypeId($data[5]);
					$product->setStockData(array(
						'use_config_manage_stock' => 0, //'Use config settings' checkbox
						'manage_stock' => 1, //manage stock
						'is_in_stock' => 1, //Stock Availability
						)
					);
					$product->setVisibility(4); //only configurable prod is visible
					/**	assigning associated product to configurable*/
					$product->getTypeInstance()->setUsedProductAttributeIds(
													array($colorAttributeId,$sizeAttributeId)
												); 
					$configurableAttributesData = $product->getTypeInstance()->getConfigurableAttributesAsArray();
					$product->setCanSaveConfigurableAttributes(true);
					$product->setConfigurableAttributesData($configurableAttributesData);
					$configurableProductsData = array();
					$assocProdSkus = $data[7]; /// all SKU of simple products belongs to configurable product.
					$assocProducts = array();
					$assocProducts = explode("/",$assocProdSkus);
					$configurableProductsData = $this->getConfProductsArrayDataHere($assocProducts,$sizeAttributeId,$colorAttributeId); 
					//Mage::log($configurableProductsData,null,'ntn.log');
					$product->setConfigurableProductsData($configurableProductsData);
				}
				$product->addImageToMediaGallery($imagepath, array('image', 'small_image', 'thumbnail'),true,false); 
				//Save product
				try{
					$saved=$product->save();
					$lastId = $saved->getId();
					//Save product info in marketplace_product table.
					$vendorId = Mage::getSingleton('customer/session')->getCustomer()->getId();
					$collection1=Mage::getModel('marketplace/product');
					$collection1->setmageproductid($lastId);
					$collection1->setuserid($vendorId);
					$collection1->setstatus($saved->getStatus());
					$collection1->save();
					//Mage::log('vendor_info',null,'ntn.log');
					//Mage::log($collection1,null,'ntn.log');
					//echo $product->getSku().'  Save Successfully';
					Mage::getSingleton('core/session')->addSuccess('Product SKU '.$product->getSku().' Save Successfully');
				}
				catch (Exception $ex) {
					//Handle the error
					Mage::getSingleton('core/session')->addError($ex->getMessage());
					//Mage::log($ex->getMessage(),null,'Csv-Import-Error.log');
					//echo $ex->getMessage();					
				}
			}
			fclose($handle); 
			//echo 'Done';
		}
	}
	
	/**
	* Return Array for configurable product
	*
	* @param int $attrCode ,string $optionLabel
    * @return int $option value
	*/
	protected function getConfProductsArrayDataHere($assocProducts,$sizeAttributeId,$colorAttributeId) 
	{	
		$configurableProductsD = array();
		foreach($assocProducts as $assoc_prod_sku){
			$assoc_prod = Mage::getModel('catalog/product')->loadByAttribute('sku', $assoc_prod_sku);
			$assocProductId = $assoc_prod->getId();	// Associative Product ID
			$configurableProductsD[$assocProductId] = $this->getAttributeArrayDataHere($assoc_prod,$sizeAttributeId,$colorAttributeId); 		
		}
		//Mage::log($configurableProductsD,null,'ntn.log');
		return $configurableProductsD;
	}
	
	/**
	* Return Array as per requirement
	*
	* @param object $assoc_prod(Product obj), int $sizeAttributeId,$colorAttributeId
    * @return array $data 
	*/
	public function getAttributeArrayDataHere($assoc_prod,$sizeAttributeId,$colorAttributeId){
		$data = array();
		$i = 0;
		if($assoc_prod->getAttributeText('color')){
			$data[$i] = array(
							'label' => $assoc_prod->getAttributeText('color'), 
							'attribute_id' => $colorAttributeId, 
							'value_index' => (int) $assoc_prod->getColor(), 
							'is_percent' => '0', //fixed/percent price for this option
							'pricing_value' => $assoc_prod->getPrice() 
						);
			$i++;
		}
		if($assoc_prod->getAttributeText('size')){
			$data[$i] = array(
							'label' => $assoc_prod->getAttributeText('size'), 
							'attribute_id' => $sizeAttributeId, 
							'value_index' => (int) $assoc_prod->getSize(), 
							'is_percent' => '0', //fixed/percent price for this option
							'pricing_value' => $assoc_prod->getPrice() 
						);
			$i++;
		}
		return $data;		
	}

	/**
	* Download image from external URL
	*
	* @param string $path(image path), $name(Name for image)
    * @return string $filepath_to_image 
	*/
	public function downloadImage($path,$name){
		$image_url = $path;
		$image_url  =str_replace("https://", "http://", $image_url); // replace https tp http
		$image_type = substr(strrchr($image_url,"."),1); //find the image extension
		$filename   = $name.'.'.$image_type; //give a new name, you can modify as per your requirement
		$filepath   = Mage::getBaseDir('media') . DS . 'import'. DS . $filename; //path for temp storage folder: ./media/import/
		$curl_handle=curl_init();
		curl_setopt($curl_handle, CURLOPT_URL,$image_url);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Cirkel');
		$query = curl_exec($curl_handle);
		curl_close($curl_handle);
		
		file_put_contents($filepath, $query); //store the image from external url to the temp storage folder
		//file_get_contents(trim($image_url))
		$filepath_to_image=$filepath;
		
		return $filepath_to_image;
	}
	
	/**
	* Return attribute ID
	*
	* @param int $attrCode ,string $optionLabel
    * @return int $option value
	*/
	protected function _getOptionIDByCode($attrCode, $optionLabel){
		$attrModel   = Mage::getModel('eav/entity_attribute');
		$attrID      = $attrModel->getIdByCode('catalog_product', $attrCode);
		$attribute   = $attrModel->load($attrID);
		$options     = Mage::getModel('eav/entity_attribute_source_table')
						->setAttribute($attribute)
						->getAllOptions(false);

		foreach ($options as $option) {
			if ($option['label'] == $optionLabel) {
				//Mage::log('return '.$option['value'],null,'ntn.log');
				return $option['value'];
			}
		}
		return false;
	}	
	
}