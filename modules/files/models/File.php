<?php

namespace codeheadco\tools\modules\files\models;

use Yii;
use yii\base\Model;

/**
 * Description of File
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
class File extends Model
{

    /**
     *
     * @var \codeheadco\tools\DirectoryPath
     */
    public $directoryPath;
    
    /**
     *
     * @var type 
     */
    public $fileId;
    
    /**
     *
     * @var type 
     */
    public $originalInfo;

    public function init()
    {
        parent::init();
        
        
    }
    
    /**
     * 
     * @param type $uploadId
     * @return \static
     */
    public static function getByUploadId($uploadId)
    {
        $directoryPath = TmpFile::getTmpFilesDirectoryPath(substr($uploadId, 0, 8));
        
        $file = new static([
            'fileId' => $uploadId,
            'directoryPath' => $directoryPath,
        ]);
        
        return $file;
    }
    
    /**
     * 
     * @return \codeheadco\tools\DirectoryPath
     */
    public function getDirectoryPath()
    {
        return $this->directoryPath;
    }
    
    public function getPath()
    {
        return $this->directoryPath->getPath() . "/{$this->fileId}";
    }
    
}
