<?php
namespace Lib;

abstract class Session
{
    const MSG_KEY = 'flash_msg';

    public static function start(){
        session_start();
    }

    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }

    public static function get($key){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function delete($key){
        unset($_SESSION[$key]);
    }

    public static function destroy(){
        session_destroy();
    }

    public static function setFlash($msg){
        self::set(self::MSG_KEY, $msg);
    }

    public static function getFlash(){
        $message = self::get(self::MSG_KEY);
        self::delete(self::MSG_KEY);
        return $message;
    }
}