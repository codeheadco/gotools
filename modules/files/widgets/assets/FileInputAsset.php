<?php

namespace codeheadco\tools\modules\files\widgets\assets;

use yii\web\AssetBundle;

/**
 * Description of FileInputAsset
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
class FileInputAsset extends AssetBundle
{

    /**
     *
     * {@inheritdoc}
     */
    public $js = [
        'fileinput.js'
    ];

    /**
     *
     * {@inheritdoc}
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    /**
     *
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->sourcePath = dirname(__FILE__) . '/src';
    }

}
