<?php

namespace codeheadco\tools\modules\files\models;

use yii\helpers\Json;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Description of UploadForm
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
class UploadForm extends Model
{
    
    /**
     * @var UploadedFile
     */
    public $file;
    
    /**
     * 
     * @return type
     */
    protected $uploadId;

    public function rules()
    {
        return [
            [['file'], 'safe'],
        ];
    }
    
    public function process()
    {
        if ($this->validate()) {
            $this->uploadId = TmpFile::processUpload($this->file);
            
            return true;
        } else {
            return false;
        }
    }
    
    public function getUploadId()
    {
        return $this->uploadId;
    }
    
}
