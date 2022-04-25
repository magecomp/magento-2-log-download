<?php
namespace Magecomp\Logdownload\Controller\Adminhtml\Download;

class GetFile extends GetLog
{
    protected function getFilePathWithFile($fileName)
    {
        return 'var/log/' . $fileName;
}
}