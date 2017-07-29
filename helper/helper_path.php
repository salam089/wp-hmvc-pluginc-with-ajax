<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/2/2016
 * Time: 1:20 PM
 */


class path {
    function getReturnType() { /*1*/ }
    function getReturnDescription() { /*2*/ }

    function filePath($arg) {
           switch($arg){
               case "quotation":
                   $path = QUOTATION_PATH;
                   break;
               default:
                   break;
           }
        return $path;
    }

}