<?php

class Arabgento_Freed_Adminhtml_FreedController extends Mage_Adminhtml_Controller_action

{

  protected function _initAction()

  {

    $this->loadLayout()

    ->_setActiveMenu('arabgento/items')

    ->_addBreadcrumb(Mage::helper('freed')->__('Manage Private Orders'), 

       Mage::helper('freed')->__('Manage Private Orders'));

    return $this;

  }

  public function indexAction() {

    $this->_initAction();

    $this->renderLayout();

  }
  public function gridAction() {

    $this->_initAction();
    $productId=$this->getRequest()->getParam('product_id');
    $conv=$this->getRequest()->getParam('conv');
         if ($productId > 0)
	{

	$prd = Mage::getModel('catalog/product')->load($productId);
	$currentStore = $prd->getStoreId();
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
	if($conv=="1")
	$prd->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH);
	else
	$prd->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE);
	$prd->save();
	Mage::app()->setCurrentStore($currentStore);
	$prdf = Mage::getModel('freed/freed');
	$prdf->convertPiedAdmin($productId,$conv);
	}
    $this->renderLayout();

  }
    public function grid1Action() {

    $this->_initAction();
    $this->renderLayout();

  }

  
}
