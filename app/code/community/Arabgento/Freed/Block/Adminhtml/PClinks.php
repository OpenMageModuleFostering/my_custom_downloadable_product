<?php
class Arabgento_Freed_Block_Adminhtml_PClinks extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
public function render(Varien_Object $row)
{
$value = $row->getData($this->getColumn()->getIndex());
if($value==1)
{
return Mage::helper('catalog')->__('Want convert');
}
else
{
return Mage::helper('catalog')->__("Don't want convert");
}


 
}
 
    
}