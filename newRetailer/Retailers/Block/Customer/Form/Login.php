<?php
class Omniesolutions_Retailers_Block_Customer_Form_Login extends Mage_Customer_Block_Form_Login
{
	
	/**
     * Retrieve create new Whole sale account url
     *
     * @return string
     */
    public function getCreateWholesaleAccountUrl()
    {
        $url = $this->getData('create_account_url');
        if (is_null($url)) {
            $url = $this->helper('customer')->getWholesaleRegisterUrl();
        }
        return $url;
    }
}
			