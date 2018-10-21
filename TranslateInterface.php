<?php

namespace codeheadco\gotools;

/**
 * Description of Translatable
 *
 * @author gabor
 */
interface TranslateInterface {
    
    const SOURCE = 'en';
    
    public static function getTranslationCategory();
    
}
