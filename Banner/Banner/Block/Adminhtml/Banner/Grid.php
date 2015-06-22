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
 * @Block :Adminhtml
 *
 * File to show the brand module information in Grid layout.
 *
 *
 * @author: Chetu
 */
class Envista_Banner_Block_Adminhtml_Banner_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('bannerGrid');
        $this->setDefaultSort('banner_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('banner/banner')->getCollection();
        
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('banner_id', array(
            'header' => Mage::helper('banner')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'banner_id',
        ));
        $this->addColumn('banner_title', array(
            'header' => Mage::helper('banner')->__('Banner Title'),
            'align' => 'left',
            'index' => 'banner_title',
        ));


        $this->addColumn('url', array(
            'header' => Mage::helper('banner')->__('Url'),
            'align' => 'left',
            'index' => 'url',
        ));
        
       /*  $this->addColumn('description', array(
            'header' => Mage::helper('banner')->__('Brand Description'),
            'align' => 'left',
            'index' => 'description',
        )); */
        
        $this->addColumn('image', array(
            'header' => Mage::helper('banner')->__('Banner Image'),
            'align' => 'left',
            'index' => 'image',
            'renderer' => 'banner/adminhtml_banner_grid_bannerimage'
        ));
        $this->addColumn('status', array(
            'header' => Mage::helper('banner')->__('Status'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'status',
            'type' => 'options',
            'options' => array(
                1 => 'Enabled',
                2 => 'Disabled',
            ),
        ));
        
        $this->addColumn('action', array(
            'header' => Mage::helper('banner')->__('Action'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('banner')->__('Edit'),
                    'url' => array('base' => '*/*/edit'),
                    'field' => 'id'
                )
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,
        ));

        $this->addColumn('sort_order', array(
            'header' => Mage::helper('banner')->__('Sort Order'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'sort_order',
        ));
     
        $this->addExportType('*/*/exportCsv', Mage::helper('banner')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('banner')->__('XML'));
        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('banner_id');
        $this->getMassactionBlock()->setFormFieldName('banner');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('banner')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('banner')->__('Are you sure?')
        ));
        $statuses = Mage::getSingleton('banner/status')->getOptionArray();
        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('banner')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('banner')->__('Status'),
                    'values' => $statuses
                )
            )
        ));
        return $this;
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}