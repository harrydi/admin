<?php
class Omniesolutions_Removelinks_Block_Customer_Account_Navigation extends Mage_Customer_Block_Account_Navigation
{
	/**
     * Remove Link using custom method removeLinkByName()
     * We are using it in local.xml
     *
     * Unset link by its name
     */
	public function removeLinkByName($name) {
        unset($this->_links[$name]);
    }
}
			