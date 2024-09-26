<?php
namespace Magecomp\Logdownload\Controller\Adminhtml\Download;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Controller\Adminhtml\System;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\Exception\NotFoundException;



abstract class GetLog extends System
{
    protected $fileFactory;
    public function __construct(Context $context, FileFactory $fileFactory)
    {
        $this->fileFactory = $fileFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $param = $this->getRequest()->getParams();
        $filePath = $this->getFilePathWithFile($param[0]);


        $filter =  basename($filePath);
        $fileName = $filePath;
        try {
            return $this->fileFactory->create(
                $fileName,
                [
                    'type'  => 'filename',
                    'value' => $filePath
                ]
            );
        } catch (\Exception $e) {
            throw new NotFoundException(__($e->getMessage()));
        }
    }
}
