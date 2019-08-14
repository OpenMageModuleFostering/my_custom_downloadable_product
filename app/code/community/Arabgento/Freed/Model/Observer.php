<?php

class Arabgento_Freed_Model_Observer {

        public function change_order($observer) {
                $order = $observer->getEvent()->getOrder();
                $items = $order->getAllItems();
                 //$items->removeItem($item->getId())->save();

        
            
               
             
                foreach($items as $item)
                {

                //echo "<script type='text/javascript'>alert('".$item->getSku()."')</script>";
				//die();

              
/**
        if (isset($options['options'])) { 
            foreach ($options['options'] as $optionValues) {
                if ($optionValues['value']) {
                    echo '&nbsp;<strong><i>'. $optionValues['label'].'</i></strong>: ';

                    $_printValue = isset($optionValues['print_value']) ? $optionValues['print_value'] : strip_tags($optionValues['value']);
                    $values = explode(', ', $_printValue);
                    foreach ($values as $value) {
                        if (is_array($value))
                          foreach ($value as $_value) 
                              echo $_value;
                        else echo $value; 
                    }
                    echo '<br />';
                }
            }    
        }
*/        
                
                
                if($item->getSku()=="tiket1.0-tiket-file")
                {
				
                $pursh=array();
              $allOptions=$item->getData('product_options');
               $linkFile=array();
               $options = unserialize($allOptions);
               foreach ($options['options'] as $optionValues) {
               //var_dump($optionValues);
               $linkFile[]=$optionValues["value"];
               }
              $qte=$item->getQtyToInvoice();
              
             for($i=0 ; $i<$qte ; $i++){
                  	// product does not exist so we will be creating a new one.
    // i noticed some fields will give a database error if they are set when existing. These are the fields I found to work successfully
        $nmprd="down".time().rand(2,6);
  	$product = new Mage_Catalog_Model_Product();
  	$product->setAttributeSetId(4);
	$product->setWebsiteIDs(array(1)); // your website ids
	$product->setStoreIDs(array(1));  // your store ids
  	$product->setTypeId('downloadable');
	$product->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE);
	$product->setStatus(1);
	$product->setSku($nmprd);
        $product->setLinksPurchasedSeparately(0);
        $product->setName($nmprd);
        $product->setTaxClassId(0);
        $product->setDescription('Description');
        $product->setShortDescription('Short Description');
        $product->setPrice(0);

        $product->save();
        $link =array( 'title' => 'Waiting not Ready', 'link' => 'http://www.Null.com' );

        Mage::getModel('downloadable/link')->setData(array(
      'product_id' => $product->getId(),
       'sort_order' => 0,
       'number_of_downloads' => 0, // Unlimited downloads
       'is_shareable' => 2, // Not shareable
       'link_url' => $link['link'],
       'link_type' => 'url',
       'link_file' => '',
       'sample_url' => '',
       'sample_file' => '',
       'sample_type' => '',
       'use_default_title' => false,
       'title' => $link['title'],
       'default_price' => 0,
       'price' => 0,
       ))->save();
        $orderItem = Mage::getModel('sales/order_item')
       ->setItemId(NULL)
       ->setStoreId(1)
       ->setIsVirtual(1)
       ->setQuoteItemId(0)
       ->setProductType('downloadable')
       ->setQuoteParentItemId(NULL)
       ->setProductId($product->getId())
       ->setProductType($product->getTypeId())
       ->setQtyBackordered(NULL)
       ->setTotalQtyOrdered(1)
       ->setQtyOrdered(1)
       ->setName($product->getName())
       ->setSku($product->getSku())
       ->setPrice($product->getPrice());

        
        $order->addItem($orderItem);
        $order->save();
        $orderItem->save();
        
       $order1 = Mage::getModel('sales/order');
       $order1->load(Mage::getSingleton('sales/order')->getLastOrderId());

  
        $orderIncrementId = $order1->getIncrementId();
        
         $orderPur = Mage::getModel('downloadable/link_purchased')
         ->setPurchasedId(NULL)
        ->setOrderItemId($orderItem->getItemId())
        ->setOrderIncrementId($orderIncrementId)
        ->setProductName($product->getName())
        ->setProductSku($product->getSku())
        ->setCustomerId($order->getCustomerId())
        ->setOrderId($order->getId())
        ->save();
        $linkHash = strtr(base64_encode(microtime() . $orderPur->getId() . $orderItem->getId() . $product->getId()), '+/=', '-_,');
        $orderPurItem = Mage::getModel('downloadable/link_purchased_item')
        ->setPurchasedId($orderPur->getPurchasedId())
        ->setOrderItemId($orderPur->getOrderItemId())
        ->setLinkHash($linkHash)
        ->setProductId($product->getId())
        ->setLinkTitle($link['title'])
        ->setLinkType('file')
        ->setLinkFile(null)
        ->setCreatedAt($orderItem->getCreatedAt())
        ->setUpdatedAt($orderItem->getUpdatedAt())
        ->setStatus(Mage_Downloadable_Model_Link_Purchased_Item::LINK_STATUS_PENDING)
        ->save();
         $pursh[]=$orderPur->getId();
        
         $date = new DateTime();
         $fprd = Mage::getModel('freed/freed')
        ->setProductId($product->getId())
        ->setOrderId($order->getId())
        ->setProductName($product->getName())
        ->setCostumerId($order->getCustomerId())
        ->setProductLink($linkFile[0])
        ->setCostumerName($order->getCustomerEmail())
        ->setCondition('pending')
        ->setPiedAdmin(0)
        ->setPiedClient(0)
        ->setFreedCreate($date->format('Y-m-d H:i:s'))
        ->setFreedModify($date->format('Y-m-d H:i:s'))
        ->save();
        



       }
           Mage::register('PurchasedIds', $pursh);
    
                }


                // $order->removeItem($item)->save();
                //echo $item->getSku();
                }
// Then we see if the product exists already, by SKU since that is unique to each product






// setting a Yes/No Attribute



        }
        
        public function change_pur($observer) {
                $order = $observer->getEvent()->getOrder();
                $purshs=Mage::registry('PurchasedIds');
                if(!is_null($purshs))
                {
                foreach($purshs as $pursh){
                $ordPursh=Mage::getModel('downloadable/link_purchased')->load($pursh);

                $ordPursh->setOrderIncrementId($order->getIncrementId());
                $ordPursh->save();
                } 
             
                Mage::unregister('PurchasedIds'); 
           $session = Mage::getSingleton('customer/session');              
          $emailTemplate  = Mage::getModel('core/email_template')->loadDefault('freed_private_order');                                 
        //Create an array of variables to assign to template
          $emailTemplateVariables = array();
          $emailTemplateVariables['myvar2'] = $order->getIncrementId();      
          $processedTemplate = $emailTemplate->getProcessedTemplate($emailTemplateVariables);  
          $emailTemplate->setSenderName('abdo lah achakik');
          $emailTemplate->setSenderEmail('achakik@gmail.com');   
          $emailTemplate->setTemplateSubject('New private ticket order');
          $emailTemplate->send('achakik@gmail.com','abdo lah achakik', $emailTemplateVariables);    
                
       }
       }
       public function change_link($observer) {
                 $prd = $observer->getEvent()->getProduct();
                 if($prd->getTypeId()=="downloadable")
                 {
                $date = new DateTime();
                
                $prdPurItem = Mage::getModel('downloadable/link_purchased_item')->getCollection()
               ->addFieldToFilter('product_id',$prd->getId()); 
               if($prd->getTypeInstance(true)->hasLinks($prd)){
               $fl=$prd->getTypeInstance(true)->getLinks($prd);
	       foreach($fl as $fl1){
              if(!is_null($prdPurItem))
              {
              foreach ($prdPurItem as $_itemPur) {

               $_itemPur->setLinkUrl(null)
               ->setLinkId($fl1["link_id"])
               ->setLinkType('file')
               ->setLinkTitle("Ready For Download")
               ->setStatus(Mage_Downloadable_Model_Link_Purchased_Item::LINK_STATUS_AVAILABLE)
               ->setLinkFile($fl1["link_file"]) 
               ->setUpdatedAt($date->format('Y-m-d H:i:s')) 
               ->save();
               
              }
              }
              }
              }
              }
                
       }
}
