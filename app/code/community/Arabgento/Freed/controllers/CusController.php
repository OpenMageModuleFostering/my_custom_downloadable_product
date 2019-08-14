<?php

class Arabgento_Freed_CusController extends Mage_Core_Controller_Front_Action
{

       /**
     * Check customer authentication
     */
    public function preDispatch()
    {
        parent::preDispatch();
        $action = $this->getRequest()->getActionName();
        $loginUrl = Mage::helper('customer')->getLoginUrl();

        if (!Mage::getSingleton('customer/session')->authenticate($this, $loginUrl)) {
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
        }
    }

    /**
     * Display downloadable links bought by customer
     *
     */
    public function prprdAction()
    {
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        if ($block = $this->getLayout()->getBlock('freed_block_privateproducts_list')) {
            $block->setRefererUrl($this->_getRefererUrl());
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->setTitle(Mage::helper('downloadable')->__('My Private Orders'));
        }
        $this->renderLayout();
    }
    /**
     * Display downloadable links bought by customer
     *
     */
    public function editAction()
    {
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        if ($block = $this->getLayout()->getBlock('freed_block_privateproducts_edit')) {
            $block->setRefererUrl($this->_getRefererUrl());
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->setTitle(Mage::helper('downloadable')->__('My Private Orders'));
        }
         $session = Mage::getSingleton('customer/session');
        $productId = $this->getRequest()->getParam('product_id');
        $forsell = $this->getRequest()->getParam('for_sell');
        $price = $this->getRequest()->getParam('price');
        //echo $forsell;echo "/".$productId;
    if($forsell!=null)
	{
	if ($productId > 0)
	{
	$purchasedPrivate = Mage::getModel('freed/freed');
        $purchasedPrivate->convertPiedClient($productId,$session->getCustomerId(),$forsell);
        if (!is_null($price))
	{
	
	if(is_numeric($price))
	{
	$prdprice = Mage::getModel('catalog/product')->load($productId);
	$currentStore = $prdprice->getStoreId();
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
	
	$prdprice->setPrice($price);
	$prdprice->save();
	Mage::app()->setCurrentStore($currentStore);
	}
	}
        }
		}
        
        $this->renderLayout();
    }
    
    public function confirmAction()
    {
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        if ($block = $this->getLayout()->getBlock('freed_block_privateproducts_edit')) {
            $block->setRefererUrl($this->_getRefererUrl());
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->setTitle(Mage::helper('downloadable')->__('My Private Orders'));
        }
        $session = Mage::getSingleton('customer/session');
        $productId = $this->getRequest()->getParam('product_id');
        $forsell = $this->getRequest()->getParam('for_sell');
        $price = $this->getRequest()->getParam('price');
        if ($productId > 0)
	{
	$purchasedPrivate = Mage::getModel('freed/freed');
        $purchasedPrivate->convertPiedClient($productId,$session->getCustomerId(),$forsell);
        if (!is_null($price))
	{
	
	if(is_numeric($price))
	{
	$prdprice = Mage::getModel('catalog/product')->load($productId);
	$currentStore = $prdprice->getStoreId();
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
	
	$prdprice->setPrice($price);
	$prdprice->save();
	Mage::app()->setCurrentStore($currentStore);
	}
	}
        }

        $this->renderLayout();
    }

}