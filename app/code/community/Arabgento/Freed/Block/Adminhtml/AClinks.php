<?php
class Arabgento_Freed_Block_Adminhtml_AClinks extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
public function render(Varien_Object $row)
{
$value = $row->getData($this->getColumn()->getIndex());
if($value==1)
{
return "<a href='".Mage::getUrl('freed/adminhtml_freed/grid', array('product_id' => $this->_getValue($row),'conv' => 0,'_current' => true,'_absolute' => true))."'>".Mage::helper('catalog')->__("Disable")."</a>";
}
else
{
return "<a href='".Mage::getUrl('freed/adminhtml_freed/grid', array('product_id' => $this->_getValue($row),'conv' => 1,'_current' => true,'_absolute' => true))."'>".Mage::helper('catalog')->__("Enable")."</a>";
}


 
}
 
    
}