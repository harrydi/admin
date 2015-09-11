<?php
class Omniesolutions_Retailers_Helper_Customer_Data extends Mage_Customer_Helper_Data
{
	/**
     * Retrieve Wholesale customer register form url
     *
     * @return string
     */
    public function getWholesaleRegisterUrl()
    {
        return $this->_getUrl('customer/account/createwholesale');
    }
}
		