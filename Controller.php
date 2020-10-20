<?php

namespace codeheadco\tools;

use Yii;

/**
 * Description of Controller
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
class Controller extends \yii\web\Controller
{

    public function afterAction($action, $result)
    {
        $parentRresult = parent::afterAction($action, $result);

        if (is_array($parentRresult)) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }

        return $parentRresult;
    }

}
