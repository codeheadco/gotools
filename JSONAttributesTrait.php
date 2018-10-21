<?php

namespace codeheadco\tools;

use yii\helpers\Json;

/**
 * Description of JSONAttributesTrait
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
trait JSONAttributesTrait
{
    
    public function getArrayAttribute($attribute)
    {
        $value = $this->getAttribute($attribute);
        
        if (is_string($value)) {
            return Json::decode($value);
        }
        
        return $value;
    }

    public function setArrayAttribute($attribute, $array)
    {
        $this->setAttribute($attribute, Json::encode($array));
    }
    
}
