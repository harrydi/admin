<?php
Amasty
class Custom_Ntnimport_IndexController extends Mage_Core_Controller_Front_Action{
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

	/**
	*	Upload CSV file. 
	*/
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
	
	/**
	*	Import Product from CSV file. 
	*/
	
	public function importCsvFile() {
		$categoryids = array(4);
		if (($handle = fopen("Delete\allproductspp.csv", "r")) !== FALSE) {
			$row = 0;
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				echo 'Importing product: '.$data[0].'<br />';
				$num = count($data);
				$row++;
				if($row == 1) continue;
				
				if($data[0]=='') continue;
				
				$imagepath = $this->downloadImage($data[17],$data[0]);
				//$imagepath2 = $this->downloadImage($data[17],$data[0]);
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
					$product->setTypeId($data[5]);
					$product->setColor(24);
					$product->setStockData(array(
							'manage_stock' => 1,
							'is_in_stock' => 1,
							'qty' => $data[6]
						)
					);
					$product->setVisibility(1); // Simple prod is Not visible individually. 
				}elseif($data[5] == 'configurable')
				{
					$product->setTypeId($data[5]);
					$product->setStockData(array(
						'use_config_manage_stock' => 0, //'Use config settings' checkbox
						'manage_stock' => 1, //manage stock
						'is_in_stock' => 1, //Stock Availability
						)
					);
					$product->setVisibility(4); //only configurable prod is visible
					/**
					**	assigning associated product to configurable
					*/
					$product->getTypeInstance()->setUsedProductAttributeIds(array(92)); //attribute ID of attribute 'color' in my store.
					$configurableAttributesData = $product->getTypeInstance()->getConfigurableAttributesAsArray();
					$product->setCanSaveConfigurableAttributes(true);
					$product->setConfigurableAttributesData($configurableAttributesData);
					$configurableProductsData = array();
					
					/* assigning associated product id */
					$assoc_prod_sku = $data[7]; // use your own sku number 
					$assoc_prod__id = Mage::getModel("catalog/product")->getIdBySku( $assoc_prod_sku ); 
					/* assigning associated product id Ends */
					
					$configurableProductsData[$assoc_prod__id] = array( 
						'0' => array(
							'label' => 'Green', //attribute label
							'attribute_id' => '92', //attribute ID of attribute 'color' in my store
							'value_index' => '24', //value of 'Green' index of the attribute 'color'
							'is_percent' => '0', //fixed/percent price for this option
							'pricing_value' => '21' //value for the pricing
						)
					);
					$product->setConfigurableProductsData($configurableProductsData);
				}
				$product->addImageToMediaGallery($imagepath, array('image', 'small_image', 'thumbnail'),true,false); // absolute path of image in local file system
				try{
					$saved=$product->save();
					$lastId = $saved->getId();
					//Creating log
					Mage::log($lastId,null,'ntn.log');
					$vendorId = Mage::getSingleton('customer/session')->getCustomer()->getId();
					$collection1=Mage::getModel('marketplace/product');
					$collection1->setmageproductid($lastId);
					$collection1->setuserid($vendorId);
					$collection1->setstatus($saved->getStatus());
					$collection1->save();
					Mage::log($collection1,null,'ntn.log');
					Mage::log(Mage::getSingleton('customer/session')->getCustomer()->getData(),null,'ntn.log');
					echo $product->getSku().'  Save Successfully';
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
	public function downloadImage($path,$name){
		Mage::log($a.'===='.$b,null,'ntn.log');
		/* $image_url = $data['productImg']; */
		//$image_url = 'http://www.silksoftware.com/wp-content/uploads/2013/12/logo3.png';
		$image_url = $path;
		$image_url  =str_replace("https://", "http://", $image_url); // replace https tp http
		$image_type = substr(strrchr($image_url,"."),1); //find the image extension
		$filename   = $name.'.'.$image_type; //give a new name, you can modify as per your requirement
		$filepath   = Mage::getBaseDir('media') . DS . 'import'. DS . $filename; //path for temp storage folder: ./media/import/
		$curl_handle=curl_init();
		curl_setopt($curl_handle, CURLOPT_URL,$image_url);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Cirkel');$query = curl_exec($curl_handle);curl_close($curl_handle);
		
		file_put_contents($filepath, $query); //store the image from external url to the temp storage folder
		//file_get_contents(trim($image_url))
		$filepath_to_image=$filepath;
		
		Mage::log($filepath_to_image,null,'ntn.log');
		Mage::Log('68. File Path ' . $filepath . ', image url ' . $image_url,null,'ntn.log');
		return $filepath_to_image;
	}
}