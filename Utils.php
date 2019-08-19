<?php

namespace codeheadco\tools;

/**
 * An OOP util collection.
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
class Utils
{

    /**
     * Checks if the $class does implement the $interfaceClass.
     * @param string|object $class
     * @param string $interfaceClass
     * @return boolean
     */
    public static function implementsInterface($class, $interfaceClass)
    {
        $interfaces = class_implements($class);
        return isset($interfaces[$interfaceClass]);
    }
    
    /**
     * @see \ReflectionClass::isSubclassOf($class)
     * @param string|object $class
     * @param string|object $compareTo
     * @return boolean
     */
    public static function isSubclassOf($class, $compareTo)
    {
        return (new \ReflectionClass($class))->isSubclassOf($compareTo);
    }
    
    /**
     * Checks if the $class is an instance of the $compareTo. (The same as the "instanceof" operator but static.)
     * @param string $class
     * @param string $compareTo
     * @return boolean
     */
    public static function isInstanceOf(string $class, string $compareTo)
    { 
        return ltrim($class, '\\') === ltrim($compareTo, '\\') || static::isSubclassOf($class, $compareTo);
    }

    /**
     * Checks if the $class uses the $traitClass as trait.
     * @param string|object $class
     * @param string $traitClass
     * @return boolean
     */
    public static function usesTrait($class, string $traitClass)
    {
        $traits = class_uses($class);
        return isset($traits[$traitClass]);
    }

    /**
     * @see \ReflectionClass::getShortName()
     * @param string|object $class
     * @return string
     */
    public static function classShortName($class)
    {
        return (new \ReflectionClass($class))->getShortName();
    }

    /**
     * Returns by an array of the $class constants,
     * if the $groupName is null, then the all constants or else filters by that,
     * if the $onlyValues is true, then only the constants' values or else a map as: "constant name" => "value name".
     * @param string|object $class
     * @param string $groupName
     * @param boolean $onlyValues
     * @return array()
     * @throws \InvalidArgumentException
     */
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
    
    /**
     * Returns by an array of the $class properties,
     * if the $classFilter is null, then the all properties from the inheritance tree or else filters by that,
     * if the $onlyNames is false, then an array of \ReflectionProperty instances or else only property names.
     * @see \ReflectionClass::getProperties()
     * @param string|object $class
     * @param string $classFilter
     * @param boolean $onlyNames
     * @return array()
     */
    public static function listProperties($class, string $classFilter = null, bool $onlyNames = false)
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
