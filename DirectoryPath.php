<?php

namespace codeheadco\tools;

use Yii;

/**
 * Description of DirectoryPath
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
class DirectoryPath {

    /**
     *
     * @var DirectoryPath
     */
    protected $parent;
    
    /**
     *
     * @var string 
     */
    protected $path;
    
    /**
     *
     * @var string 
     */
    protected $webPath;
    
    /**
     * 
     * @param type $path
     * @param type $webPath
     * @param \gglobal\components\DirectoryPath $parent
     */
    public function __construct($path, DirectoryPath $parent = null) {
        $this->parent = $parent;
        
        if ($this->parent instanceof DirectoryPath) {
            $this->path = $parent->getPath() . '/' . $path;
            $this->webPath = $parent->getWebPath() . '/' . $path;
        } else {
            $this->path = Yii::getAlias('@files') . '/' . $path;
            $this->webPath = '/files/' . $path;
        }
    }

    public function getPath() {
        return $this->path;
    }

    public function getWebPath() {
        return $this->webPath;
    }
    
    public function exists() {
        return file_exists($this->path);
    }
    
    public function ensure() {
        return \yii\helpers\FileHelper::createDirectory($this->path);
    }
    
    public function remove() {
        return \yii\helpers\FileHelper::removeDirectory($this->path);
    }
    
    public function copyInto($pathFrom) {
        $pathFromPI = pathinfo($pathFrom);
        
        if (is_dir($pathFrom)) {            
            return \yii\helpers\FileHelper::copyDirectory($pathFrom, "{$this->path}/{$pathFromPI['filename']}");
        }
        
        return copy($pathFrom, "{$this->path}/{$pathFromPI['filename']}.{$pathFromPI['extension']}");
    }
    
    public function moveInto($pathFrom) {
        $pathFromPI = pathinfo($pathFrom);
        
        if (is_file($pathFrom)) {
            return rename($pathFrom, "{$this->path}/{$pathFromPI['filename']}");
        }
        
        return rename($pathFrom, "{$this->path}/{$pathFromPI['filename']}");
    }
    
}
