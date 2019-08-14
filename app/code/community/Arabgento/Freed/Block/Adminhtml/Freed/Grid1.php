<?php
class Arabgento_Freed_Block_Adminhtml_Freed_Grid1 extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
    {
      parent::__construct();
      $this->setId('freedGrid1');
      $this->setDefaultSort('product_id');
      $this->setDefaultDir('Desc');
      $this->setUseAjax(false);
      $this->setSaveParametersInSession(true);
    }


    protected function _prepareCollection()
    {

        $collection = Mage::getModel('catalog/product')->getCollection()
        ->addFieldToFilter('nbrdownload', array('gt' =>0))
        ->addAttributeToFilter('name', array('nin' =>array(Null)))
        ->setOrder('nbrdownload', 'DESC');
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('product_name',
            array(
                'header'    =>  Mage::helper('freed')->__('Product Name'),
                'type'      => 'action',
                'getter'    => 'getId',
                'renderer'  => 'freed/adminhtml_Plinks1',
                'actions'   => array(
                    array(
                        'field'     => 'id'
                    )
                ),
                'index'     => 'name',
                'is_system' => true,
        ));
        $this->addColumn('nbr_download', array(
            'header'    => Mage::helper('catalog')->__('NBR Download'),
            'index'     => 'nbrdownload',
            
        ));


        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid1', array('_current'=>true));
    }


}