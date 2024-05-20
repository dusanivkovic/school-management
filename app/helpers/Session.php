<?php
namespace app\helpers;
class Session 
{
    public static function init():void
    {
        session_start();
    }

    public static function set($key, $val):void
    {
        $_SESSION[$key] = $val;
    }

    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public static function unset($key)
    {
        unset($_SESSION[$key]);
    }

    public static function destroy()
    {
        session_destroy();
        session_unset();
    }

    public static function redirect ($location)
    {
        header("location: {$location}");
        // exit();
    }

    public static function prntR ($attribute)
    {
        echo '<pre>';
        print_r($attribute) ;
        echo '</pre>';
    }
}