<?php
class Omniesolutions_Catalogdoc_Model_Mysql4_Catalogdoc extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("catalogdoc/catalogdoc", "id");
    }
}