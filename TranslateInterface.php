<?php

namespace codeheadco\tools;

/**
 * Description of Translatable
 *
 * @author gabor
 */
interface TranslateInterface {
    
    const SOURCE = 'en';
    
    public static function getTranslationCategory();
    
}
