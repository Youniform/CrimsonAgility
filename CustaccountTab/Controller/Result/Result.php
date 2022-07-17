<?php

namespace CrimsonAgility\CustaccountTab\Controller\Result;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;

class Result extends \Magento\Framework\App\Action\Action
{

     /**
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    protected $resultJsonFactory; 

    /**
     * @param Context     $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory
        )
    {

        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory; 
        return parent::__construct($context);
    }


    public function execute()
    {
        $lowprice = $this->getRequest()->getParam('lowprice');
        $highprice = $this->getRequest()->getParam('highprice');
        $sort = $this->getRequest()->getParam('sortorder');

        $result = $this->resultJsonFactory->create();
        $resultPage = $this->resultPageFactory->create();

        $block = $resultPage->getLayout()
                ->createBlock('CrimsonAgility\CustaccountTab\Block\Index')
                ->setTemplate('CrimsonAgility_CustaccountTab::result.phtml')
                ->setData('lowprice',$lowprice)
                ->setData('highprice',$highprice)
                ->setData('sort', $sort)
                ->toHtml();
        

        $result->setData(['output' => $block]);
        return $result; 
    } 
}