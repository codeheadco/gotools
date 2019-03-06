<?php

namespace codeheadco\tools\modules\files\widgets;

use yii\helpers\Html;
use codeheadco\tools\modules\files\widgets\assets\FileInputAsset;
use yii\widgets\InputWidget;

/**
 * Description of FileInput
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
class FileInput extends InputWidget
{
    
    /**
     *
     * @var type 
     */
    public $uploadUrl = '/files/default/upload';
    
    /**
     *
     * @var type 
     */
    public $hiddenId = null;
    
    /**
     *
     * @var array()
     */
    public $fileInputOptions = [];
    
    public function init()
    {
        parent::init();
        
        if (!isset($this->fileInputOptions['id'])) {
            $this->fileInputOptions['id'] = "{$this->options['id']}-fileinput";
        }
    }
    
    /**
     *
     * {@inheritdoc}
     */
    public function run()
    {
        $this->registerClientScript();
        
        if (null === $this->hiddenId) {
            if ($this->hasModel()) {
                $hiddenInput = Html::activeHiddenInput($this->model, $this->attribute, \yii\helpers\ArrayHelper::merge($this->options, ['name' => $this->name]));
            } else {
                $hiddenInput = Html::hiddenInput($this->name, $this->value, $this->options);
            }
        }
        
        return $hiddenInput . Html::fileInput('', '', \yii\helpers\ArrayHelper::merge($this->fileInputOptions, [
            'data-upload-url' => $this->uploadUrl,
            'data-hidden-id' => $this->hiddenId ? $this->hiddenId : $this->options['id'],
        ]));
    }
    
    protected function registerClientScript()
    {
        FileInputAsset::register($this->getView());
        $this->getView()->registerJs("jQuery('#{$this->fileInputOptions['id']}').fileInput();");
    }
    
}
