<?php
class Arabgento_Freed_Model_Freed extends Mage_Core_Model_Abstract
{
  public function _construct()
  {
    parent::_construct();
    $this->_init('freed/freed');
  }
  public function convertPiedClient($pi,$ci,$forsell)
  {
    $purchasedPrivates = Mage::getResourceModel('freed/freed_collection')
    ->addFieldToFilter('costumer_id', $ci)
    ->addFieldToFilter('product_id',$pi ); 
    foreach ($purchasedPrivates as $_itemPrv) {
         $_itemPrv->setPiedClient((int)$forsell);
         $_itemPrv->save();
    }
  }
  public function convertPiedAdmin($pi,$conv)
  {
    $purchasedPrivates = Mage::getResourceModel('freed/freed_collection')
    ->addFieldToFilter('product_id',$pi); 
    foreach ($purchasedPrivates as $_itemPrv) {
         $_itemPrv->setPiedAdmin((int)$conv);
         $_itemPrv->save();
    }
  }
  
}