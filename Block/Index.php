<?php
namespace Magecomp\Logdownload\Block;

class Index extends \Magento\Framework\View\Element\Template
{
   
    protected $logDataHelper;

   
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magecomp\Logdownload\Helper\Data $logDataHelper,
        array $data = []
    )
    {
        $this->logDataHelper = $logDataHelper;
        parent::__construct($context, $data);
    }

    public function getLogFiles()
    {
        return $this->logDataHelper->buildLogData();
    }

    public function downloadLogFiles($fileName)
    {
            return $this->getUrl('logview/download/getfile', [$fileName]);
    }

    public function previewLogFile($fileName)
    {
        return $this->getUrl('logview/view/index', [$fileName]);
    }
}
