<?php
namespace Lib;

abstract class Registry
{
    private static $objects = array();

    public static function get($key){
        return isset(self::$objects[$key]) ? self::$objects[$key] : null;
    }

    public static function set($key, $value){
       self::$objects[$key] = $value;
    }
}