<?php
class Arabgento_Freed_Block_Adminhtml_Freed extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
    $this->_controller = 'adminhtml_freed';
    $this->_blockGroup = 'freed';
    $this->_headerText = Mage::helper('freed')->__('Manage commande');
    parent::__construct();
    }
}