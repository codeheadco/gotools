<?php

namespace codeheadco\tools;

use Yii;

/**
 * Description of DirectoryPath
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
class DirectoryPath
{

    /**
     *
     * @var DirectoryPath|string
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
    public function __construct($path, $parent = null)
    {
        $this->parent = $parent;

        if (is_array($path)) {
            list($realPath, $webPath) = $path;
        } else {
            $webPath = $realPath = $path;
        }

        if ($this->parent instanceof DirectoryPath) {
            $this->path = $parent->getPath() . $realPath;

            if ($webPath) {
                $this->webPath = $parent->getWebPath() . $webPath;
            }
        } elseif (null !== $this->parent) {
            if (is_array($this->parent)) {
                list($parentRealPath, $parentWebPath) = $this->parent;
            } else {
                $parentRealPath = $parentWebPath = $parent;
            }

            $this->path = $parentRealPath . $realPath;

            if ($webPath) {
                $this->webPath = $parentWebPath . $webPath;
            }
        } else {
            $this->path = Yii::getAlias('@files') . $realPath;

            if ($webPath) {
                $this->webPath = '/files' . $webPath;
            }
        }
    }

    public function getPath()
    {
        return $this->_path;
    }

    public function getWebPath()
    {
        if (null === $this->webPath) {
            throw new \yii\base\InvalidCallException();
        }

        return $this->webPath;
    }

    public function exists()
    {
        return file_exists($this->path);
    }

    public function ensure()
    {
        return \yii\helpers\FileHelper::createDirectory($this->path);
    }

    public function remove()
    {
        return \yii\helpers\FileHelper::removeDirectory($this->path);
    }

    public function fileExists($fileName)
    {
        return file_exists("{$this->path}/{$fileName}");
    }

    public function copyInto($pathFrom)
    {
        $pathFromPI = pathinfo($pathFrom);

        if (is_dir($pathFrom)) {
            return \yii\helpers\FileHelper::copyDirectory($pathFrom, "{$this->path}/{$pathFromPI['filename']}");
        }

        return copy($pathFrom, "{$this->path}/{$pathFromPI['filename']}.{$pathFromPI['extension']}");
    }

    public function moveInto($pathFrom)
    {
        $pathFromPI = pathinfo($pathFrom);

        if (is_file($pathFrom)) {
            return rename($pathFrom, "{$this->path}/{$pathFromPI['filename']}");
        }

        return rename($pathFrom, "{$this->path}/{$pathFromPI['filename']}");
    }

}
