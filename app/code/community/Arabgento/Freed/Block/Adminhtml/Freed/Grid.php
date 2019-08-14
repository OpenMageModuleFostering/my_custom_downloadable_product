<?php
class Arabgento_Freed_Block_Adminhtml_Freed_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
    {
      parent::__construct();
      $this->setId('freedGrid');
      $this->setDefaultSort('product_id');
      $this->setDefaultDir('Desc');
      $this->setUseAjax(false);
      $this->setSaveParametersInSession(true);
    }


    protected function _prepareCollection()
    {

        $collection = Mage::getModel('freed/freed')->getCollection();
        $collection->setOrder('freed_create', 'DESC');
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('product_name',
            array(
                'header'    =>  Mage::helper('freed')->__('Product Name'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getProductId',
                'renderer'  => 'freed/adminhtml_Plinks',
                'actions'   => array(
                    array(
                        'field'     => 'id'
                    )
                ),
                'index'     => 'product_name',
                'is_system' => true,
        ));
        $this->addColumn('product_link', array(
            'header'    => Mage::helper('catalog')->__('Zip File'),
            'index'     => 'product_link',
            'renderer'  => 'freed/adminhtml_Alinks'
            
        ));
        $this->addColumn('costumer_name', array(
            'header'    => Mage::helper('catalog')->__('Costumer Name'),
             'width'     => '100',
              'type'      => 'action',
              'getter'    => 'getCostumerId',
              'renderer'  => 'freed/adminhtml_Clinks',
                'actions'   => array(
                    array(
                        'field'     => 'id'
                    )
                ),
           'index'     => 'costumer_name'
        ));
        $this->addColumn('pied_admin', array(
            'header'    => Mage::helper('catalog')->__('Pied from admin'),
              'type'      => 'action',
              'getter'    => 'getProductId',
              'renderer'  => 'freed/adminhtml_AClinks',
                'actions'   => array(
                    array(
                        'field'     => 'id'
                    )
                ),
            'index'     => 'pied_admin'
        ));
        $this->addColumn('pied_client', array(
            'header'    => Mage::helper('catalog')->__('Pied from client'),
            'renderer'  => 'freed/adminhtml_PClinks',
            'index'     => 'pied_client'
        )); 
        
        $this->addColumn('freed_create', array(
            'header'    => Mage::helper('catalog')->__('created'),
            'index'     => 'freed_create'
        )); 
        $this->addColumn('freed_modify', array(
            'header'    => Mage::helper('catalog')->__('modified'),
            'index'     => 'freed_modify'
        )); 

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }


}