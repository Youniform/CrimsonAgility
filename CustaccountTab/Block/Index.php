<?php

namespace CrimsonAgility\CustaccountTab\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;

class Index extends Template
{
    protected $_productCollectionFactory;
    protected $_stockItemRepository;


    public function __construct(Context $context,      
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository,
        array $data = []
    )
    {        
        $this->_storeManager = $storeManager;
        $this->_productCollectionFactory = $productCollectionFactory; 
        $this->_stockItemRepository = $stockItemRepository;
        parent::__construct($context, $data);
    }

    public function getStockItem($productId)
    {
        return $this->_stockItemRepository->get($productId);
    }

    public function getProductCollection($lowprice, $highprice, $sort)
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addFieldToFilter( 'price' , array('from' => $lowprice, 'to' => $highprice) );
        $collection->addAttributeToSort('price', $sort);
        $collection->setPageSize(10); // fetching 10 producs
        return $collection;
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    public function getSortData()
    {
        return $this->getSort();
    }

    public function getLowPriceData()
    {
        return $this->getLowprice();
    }

    public function getHighPriceData()
    {
        return $this->getHighprice();
    }
}