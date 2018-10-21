<?php

namespace codeheadco\gotools;

/**
 * Description of ReflectionTrait
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
trait ReflectionTrait
{

    public static function implementsInterface($interfaceClass)
    {
        return Utils::implementsInterface(get_called_class(), $interfaceClass);
    }

    public static function usesTrait($traitClass)
    {
        return Utils::usesTrait(get_called_class(), $traitClass);
    }

    public static function classShortName()
    {
        return Utils::classShortName(get_called_class());
    }

    public static function listConstants($groupName = null, $onlyValues = true)
    {
        return Utils::listConstants(get_called_class(), $groupName, $onlyValues);
    }
    
    public static function listProperties($classFilter = null, $onlyNames = false)
    {
        return Utils::listProperties(get_called_class(), $classFilter, $onlyNames);
    }

}
