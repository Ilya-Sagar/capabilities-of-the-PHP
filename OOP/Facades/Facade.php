<?php

abstract class Facade
{
    private static function getClass()
    {
        return new static::$class;
    }

    public function __call($method, $args)
    {
        $instance = static::getClass();
        return $instance->$method(...$args);
    }

    public static function __callStatic($method, $args)
    {
        $instance = static::getClass();
        return $instance->$method(...$args);
    }
}