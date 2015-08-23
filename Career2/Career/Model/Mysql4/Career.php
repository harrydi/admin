<?php
class Omniesolutions_Career_Model_Mysql4_Career extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("career/career", "id");
    }
}