<?php

namespace app\classes;

use ReflectionClass;

class Container 
{
    public array $instances = [];

    public static Container $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function set($key, $value)
    {
        $this->instances[$key] = $value;
    }

    public function get($key)
    {
        $reflectionClass = new ReflectionClass($this->instances[$key] ?? $key);

        $constructor = $reflectionClass->getConstructor();

        if(!$constructor){
            return $reflectionClass->newInstance();
        }



        $params = $constructor->getParameters();

        $params = array_map(function ($param) {

            $type = $param->getType();
            return $this->get($type->getName());
        }, $params);
        if (count($params)) {
            return $reflectionClass->newInstanceArgs($params);
        }

        return $reflectionClass->newInstance();
    }
}
