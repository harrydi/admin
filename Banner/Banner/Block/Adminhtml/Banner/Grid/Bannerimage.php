<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Designerimage
 *
 * @author abdullahh
 */
class Envista_Banner_Block_Adminhtml_Banner_Grid_Bannerimage extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {
    
    public function render(Varien_Object $row)
    {
        $data = (string)$row->getData($this->getColumn()->getIndex());
        
       $url = Mage::getBaseUrl('media') . $data;
        return '<img src="'. $url .'" style="width:60px" />';
    }
}