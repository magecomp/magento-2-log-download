<?php

namespace Magecomp\Logdownload\Controller\Adminhtml\Table;

class Index extends \Magento\Backend\App\Action
{
    
    protected $resultPageFactory;

   
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

  
    public function execute()
    {

        $this->_view->loadLayout();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Log Viewer'));
        $this->_view->renderLayout();

    }
}