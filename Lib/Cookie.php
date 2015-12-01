<?php
namespace Lib;

abstract class Cookie
{
    public static function set($key, $value){
        setcookie($key, $value, time()+60*60*24*30*12, '/');
    }

    public static function get($key){
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
    }

    public static function delete($key){
        setcookie($key, '', time()-3600, '/');
        unset($_COOKIE[$key]);
    }
}