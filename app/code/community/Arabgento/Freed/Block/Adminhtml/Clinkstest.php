<?php
class Arabgento_Freed_Block_Adminhtml_Clinkstest extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
public function render(Varien_Object $row)
{
$value = $row->getData($this->getColumn()->getIndex());
$value1 = $this->getColumn()->getGetter();
$value2 = $row->getData($value1["product_name"]);
return $value2;
die();

return $this->_getValue($row)." ".$value;
 
}
 
    
}