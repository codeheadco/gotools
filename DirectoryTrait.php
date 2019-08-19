<?php

namespace codeheadco\tools;

/**
 * Description of DirectoryTrait
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
trait DirectoryTrait
{

    protected $directoryPath;

    /**
     * 
     * @return DirectoryPath
     */
    public function getDirectoryPath($create = true)
    {
        if (!$this->directoryPath) {
            $path = strtolower(static::classShortName());

            if ($this instanceof \yii\db\ActiveRecord) {
                $path .= '/' . join('_', $this->getPrimaryKey(true));
            }

            $this->directoryPath = new DirectoryPath("/{$path}");
        }

        if ($create) {
            $this->directoryPath->ensure();
        }

        return $this->directoryPath;
    }

    /**
     * 
     * @return string
     */
    public function getPath()
    {
        return $this->getDirectoryPath(true)->getPath();
    }

}
