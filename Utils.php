<?php

namespace codeheadco\gotools;

/**
 * Description of Utils
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
class Utils
{

    public static function implementsInterface($class, $interfaceClass)
    {
        $interfaces = class_implements($class);
        return isset($interfaces[$interfaceClass]);
    }

    public static function usesTrait($class, $traitClass)
    {
        $traits = class_uses($class);
        return isset($traits[$traitClass]);
    }

    public static function classShortName($class)
    {
        return (new \ReflectionClass($class))->getShortName();
    }

    public static function listConstants($class, $groupName = null, $onlyValues = true)
    {
        $constants = (new \ReflectionClass($class))->getConstants();

        if (null !== $groupName) {
            if (is_string($groupName)) {
                $callback = function ($constantName) use (&$groupName) {
                    return 0 === strpos($constantName, $groupName) && $groupName !== $constantName;
                };
            } elseif (is_callable($groupName)) {
                $callback = $groupName;
            } else {
                throw new \InvalidArgumentException('Parameter $groupName must be string or callable.');
            }

            $constants = array_filter($constants, $callback, ARRAY_FILTER_USE_KEY);
        }

        return $onlyValues ? array_values($constants) : $constants;
    }
    
    public static function listProperties($class, $classFilter = null, $onlyNames = false)
    {
        $properties = (new \ReflectionClass($class))->getProperties();
        
        if ($classFilter) {
            $filtered = [];
            foreach ($properties as $reflectionProperty) {
                if ($reflectionProperty->class === $classFilter) {
                    $filtered[] = $reflectionProperty;
                }
            }
            
            $properties = $filtered;
        }
        
        if ($onlyNames) {
            $names = [];
            foreach ($properties as $reflectionProperty) {
                $names[] = $reflectionProperty->name;
            }
            
            return $names;
        }
        
        return $properties;
    }

}
