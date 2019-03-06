<?php

namespace codeheadco\tools\modules\files\controllers;

use Yii;
use codeheadco\tools\modules\files\models\UploadForm;
use yii\web\UploadedFile;

/**
 * Description of DefaultController
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
class DefaultController extends \codeheadco\tools\Controller
{
    
    public function actionUpload()
    {
        $model = new UploadForm();
        $model->file = UploadedFile::getInstanceByName('file');
        
        if ($model->process()) {
            // file is uploaded successfully
            return [
                'success' => true,
                'uploadId' => $model->getUploadId(),
            ];
        }
        
        return ['success' => false];
    }
    
    public function actionDownload()
    {
        
    }
    
    public function actionView()
    {
        
    }
    
}
