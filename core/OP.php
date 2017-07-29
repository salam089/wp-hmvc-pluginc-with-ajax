<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/5/2016
 * Time: 12:12 PM
 */
class OP
{
    private function __construct(){}
    private static $i;

    public static function instance()
    {
        if(!self::$i){
            self::$i = new GoCart();
        }

        return self::$i;
    }


    public static function __callStatic($method, $parameters=[])
    {
        self::instance();
        return call_user_func_array(array(self::$i, $method), $parameters);
    }
}