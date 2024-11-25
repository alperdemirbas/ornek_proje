<?php

namespace App\Traits;

use ReflectionClass;
use ReflectionProperty;

trait ToArrayTrait
{

    /**
     * @throws \ReflectionException
     */
    protected function toFillable( $class)
    {

        $properties = ( new ReflectionClass($class))->getProperties(ReflectionProperty::IS_PROTECTED);
        $classArray = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();

            $getterMethod = 'get' . ucfirst($propertyName);

            if (method_exists($class, $getterMethod)) {
                if (!empty($class->$getterMethod())) {
                    $key = camelToSnake( $propertyName);
                    $classArray[$key] = $class->$getterMethod();
                }
            }
        }
        return $classArray;
    }


}