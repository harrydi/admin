<?php
class Omniesolutions_Mainslider_Model_Mysql4_Mainslider extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("mainslider/mainslider", "id");
    }
}