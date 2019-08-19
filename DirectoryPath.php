<?php

namespace codeheadco\tools;

use Yii;
use yii\helpers\FileHelper;
use yii\base\ErrorHandler;

/**
 * Description of DirectoryPath
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
class DirectoryPath
{

    /**
     *
     * @var string 
     */
    private $_path = '';

    /**
     * 
     * @param type $path
     * @param DirectoryPath|string $parent
     */
    public function __construct($path, $parent = null)
    {
        if (null !== $parent) {
            if ($parent instanceof DirectoryInterface) {
                $parent = $parent->getDirectoryPath();
            }
            
            /* @var $parent DirectoryPath */
            $this->_path = $parent instanceof DirectoryPath 
                            ? $parent->getPath() 
                            : $parent;
        }
        
        $this->_path .= $path;
    }

    public function getPath()
    {
        return $this->_path;
    }

    public function __toString()
    {
        try {
            return $this->getPath();
        } catch (\Exception $e) {
            ErrorHandler::convertExceptionToError($e);
            return '';
        }
    }

    public function exists()
    {
        return file_exists($this->_path) && is_dir($this->_path);
    }

    public function ensure()
    {
        if (!$this->exists()) {
            FileHelper::createDirectory($this->getPath());
        }
        
        return $this;
    }
    
    public function listFiles($options = [])
    {
        return FileHelper::findFiles($this->getPath(), $options);
    }
    
    public function listDirectories($options = [])
    {
        return FileHelper::findDirectories($this->getPath(), $options);
    }
    
    public function remove()
    {
        return FileHelper::removeDirectory($this->getPath());
    }
    
    public function removeFile($fileName)
    {
        if ($this->fileExists($fileName)) {
            return @unlink($this->getPath() . DIRECTORY_SEPARATOR . $fileName);
        }
        
        return false;
    }

    public function fileExists($fileName)
    {
        return file_exists($this->getPath() . DIRECTORY_SEPARATOR . $fileName);
    }

    public function copyInto($pathFrom, $newName = null)
    {
        $pathFromPI = pathinfo($pathFrom);
        
        if (null === $newName) {
            $newName = $pathFromPI['basename'];
        } else {
            $newName .= ".{$pathFromPI['extension']}";
        }

        if (is_dir($pathFrom)) {
            return FileHelper::copyDirectory($pathFrom, "{$this->getPath()}/{$newName}");
        }

        return copy($pathFrom, "{$this->getPath()}/{$newName}");
    }

    public function moveInto($pathFrom, $newName = null)
    {
        $pathFromPI = pathinfo($pathFrom);
        
        if (null === $newName) {
            $newName = $pathFromPI['basename'];
        } else {
            $newName .= ".{$pathFromPI['extension']}";
        }
        
        return rename($pathFrom, "{$this->getPath()}/{$newName}");
    }

}
