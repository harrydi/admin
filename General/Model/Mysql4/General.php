<?php
class Omniesolutions_General_Model_Mysql4_General extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("general/general", "id");
    }
}