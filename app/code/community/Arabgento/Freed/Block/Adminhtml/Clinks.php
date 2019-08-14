<?php
class Arabgento_Freed_Block_Adminhtml_Clinks extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
public function render(Varien_Object $row)
{
$value = $row->getData($this->getColumn()->getIndex());
$actions=$this->getColumn()->getActions();
$key=Mage::getSingleton('adminhtml/url')->getSecretKey("customer","edit");

return "<a href='".Mage::getUrl('././admin/customer/edit', array('id' => $this->_getValue($row),'key' => $key,'_current' => true,'_absolute' => true))."'>".$value."</a>";
 
}
 
    
}