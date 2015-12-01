<?php
namespace Lib;

abstract class Debugger
{
    public static function mvd($array, $param = 0){
        if( !$param ){
            echo "<pre>";
            var_dump($array);
            echo "</pre>";
        } else {
            echo "<pre>";
            var_dump($array);
            echo "</pre>";
            die();
        }
    }

    public static function mve($array, $param = 0){
        if( !$param ){
            echo "<pre>";
            var_export($array);
            echo "</pre>";
        } else {
            echo "<pre>";
            var_export($array);
            echo "</pre>";
            die();
        }

    }

    public static function mpr($array, $param = 0){
        if( !$param ){
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        } else {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
            die();
        }
    }
}