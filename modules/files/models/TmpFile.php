<?php

namespace codeheadco\tools\modules\files\models;

use Yii;
use yii\helpers\Json;
use yii\helpers\FileHelper;
use yii\helpers\Inflector;
use yii\web\UploadedFile;
use codeheadco\tools\DirectoryPath;

/**
 * Description of TmpFile
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
class TmpFile extends File
{
    
    /**
     * 
     * @return DirectoryPath
     */
    public static function getTmpFilesDirectoryPath($date = null)
    {
        $date = null === $date ? date('Ymd') : $date;
        
        $uploadsPath = Yii::getAlias('@uploads');
        FileHelper::createDirectory($uploadsPath);
        
        $directoryPath = new DirectoryPath(["/{$date}", null], $uploadsPath);
        $directoryPath->ensure();
        
        return $directoryPath;
    }
    
    public static function generateUploadId(DirectoryPath $directoryPath)
    {
        return Inflector::slug(basename($directoryPath->getPath()) . '_' . microtime(), '_');
    }
    
    public static function processUpload(UploadedFile $uploadedFile)
    {
        $directoryPath = static::getTmpFilesDirectoryPath();
        
        do {
            $uploadId = TmpFile::generateUploadId($directoryPath);
            $fileName = "{$uploadId}.{$uploadedFile->extension}";
        } while ($directoryPath->fileExists($fileName));
        
        $uploadedFile->saveAs($directoryPath->getPath() . '/' . $fileName);
        
        file_put_contents(
            $directoryPath->getPath() . "/{$uploadId}.opi.json", 
            Json::encode(pathinfo("{$uploadedFile->baseName}.{$uploadedFile->extension}"))
        );
            
        return $fileName;
    }
    
    public static function processUploadedFiles($uploadIds)
    {
        $fileIds = [];
        foreach ($uploadIds as $uploadId) {
            $file = File::getByUploadId($uploadId);
            $fileIds[] = $file->fileId;
        }
        
        return $fileIds;
    }
    
}
