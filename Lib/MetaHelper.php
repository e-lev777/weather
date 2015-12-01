<?php
namespace Lib;

abstract class MetaHelper
{
    private static $title = array();
    private static $description;

    public static function setPageTitle($key = Config::DEFAULT_TITLE){
        return self::$title = $key;
    }

    public static function setPageDescription($key = Config::DEFAULT_DESCRIPTION){
        return self::$description = $key;
    }
}