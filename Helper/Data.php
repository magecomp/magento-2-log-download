<?php
namespace Magecomp\Logdownload\Helper;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    
    protected $directoryList;

    public function __construct(
        Context $context,
        DirectoryList $directoryList
    ) {
        $this->directoryList = $directoryList;
        parent::__construct(
            $context
        );
       
    }
   
    public function getPath()
    {
        $rootPath = $this->directoryList->getRoot();
        $path =
            $rootPath . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'log'. DIRECTORY_SEPARATOR;
        return $path;
    }

  
    protected function getLogFiles()
    {
        $path = $this->getPath();
        return scandir($path);
    }

    protected function filesizeToReadableString($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

   
    public function buildLogData()
    {
        $logFileData = [];
        $path = $this->getPath();
        $files = $this->getLogFiles();

       

        //remove rubbish from array
        array_splice($files, 0, 2);

        //build log data into array
        foreach ($files as $file) {
            $logFileData[$file]['name'] = $file;
            $logFileData[$file]['filesize'] = $this->filesizeToReadableString((filesize($path . $file)));
            $logFileData[$file]['modTime'] = filemtime($path . $file);
            $logFileData[$file]['modTimeLong'] = date("F d Y H:i:s", filemtime($path . $file));
        }

        //sort array by modified time
        usort($logFileData, function ($item1, $item2) {
            return $item2['modTime']<=>$item1['modTime'];
        });

        return $logFileData;

    }

 
}
