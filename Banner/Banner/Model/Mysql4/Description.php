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
 * @Model_Mysql4 :Description
 *
 *
 * @author: Chetu
 */
class Envista_Banner_Model_Mysql4_Description extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        // Note that the banner_id refers to the key field in your database table.
        $this->_init('description/description', 'id');
    }

}