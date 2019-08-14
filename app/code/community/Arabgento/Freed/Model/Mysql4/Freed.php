<?php
class Arabgento_Freed_Model_Mysql4_Freed extends Mage_Core_Model_Mysql4_Abstract
{
  public function _construct()
  {   
    $this->_init('freed/freed','freed_id');
  }
}