<?php

namespace app\components;

/**
 * Description of TranslateTrait
 *
 * @author gabor
 */
trait TranslateTrait
{
    
    public static function t($message, $params = [], $language = null)
    {
        return \Yii::t(static::getTranslationCategory(), $message, $params, $language);
    }
    
    public static function tSource($message, $params = [])
    {
        return static::t($message, $params, TranslateInterface::SOURCE);
    }
    
}
