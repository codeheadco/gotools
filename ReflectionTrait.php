<?php

namespace codeheadco\tools;

/**
 * An OOP util collection as a trait.
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
trait ReflectionTrait
{

    /**
     * @see Utils::implementsInterface($class, $interfaceClass)
     */
    public static function implementsInterface($interfaceClass)
    {
        return Utils::implementsInterface(get_called_class(), $interfaceClass);
    }

    /**
     * @see Utils::usesTrait($class, $traitClass)
     */
    public static function usesTrait($traitClass)
    {
        return Utils::usesTrait(get_called_class(), $traitClass);
    }

    /**
     * @see Utils::classShortName($class)
     */
    public static function classShortName()
    {
        return Utils::classShortName(get_called_class());
    }

    /**
     * @see Utils::listConstants($class, $groupName, $onlyValues)
     */
    public static function listConstants($groupName = null, $onlyValues = true)
    {
        return Utils::listConstants(get_called_class(), $groupName, $onlyValues);
    }
    
    /**
     * @see Utils::listConstants($class, $groupName, $onlyValues)
     */
    public static function listProperties($classFilter = null, $onlyNames = false)
    {
        return Utils::listProperties(get_called_class(), $classFilter, $onlyNames);
    }

}
