<?php
/*
 **
 ** Magento
 *
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE_AFL.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @Namespace : AsiaCheckout
 * @module : Banner
 * @Block :Rendered function to call Banner Description to show textarea respective to the store view.
 *
 * @author : Chetu
 */
class Envista_Banner_Block_Adminhtml_Renderer_Description extends Mage_Core_block_template {

	public function __construct() {
		return parent::__construct();
	}
	
	public function getBanner() {
		$everyStore = Mage::app()->getStores();
		$bnnerid = $this->getRequest()->getParam('id'); 
		return $everyStore;
	}
	
	public function getDescription($store_code, $bannerid)
	{
		$read= Mage::getSingleton('core/resource')->getConnection('core_read');
		$exec=$read->query("SELECT banner_desc from banner_description where banner_id='".$bannerid."' AND store_view='".$store_code."'");
		$row = $exec->fetch();
		return $row['banner_desc'];
	}
		
}