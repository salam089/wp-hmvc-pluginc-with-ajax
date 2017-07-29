<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/3/2016
 * Time: 12:05 PM
 */
trait loader
{

    function load($class_name){
        global $classes;
        $file = $classes[$class_name];
        include_once($file);
        return new $class_name();

    }

    function loadHelper($class_name){
        global $helper_classes;
        $file = $helper_classes[$class_name];
        include_once($file);
        return new $class_name();

    }

    function loadModel($class_name){
        global $cpi_modules;
        $module = ucfirst($class_name);
        $file = $cpi_modules[$module].CPI_MODEL.'/'.ucfirst($class_name).'.php';
        return include_once($file);
    }

    function loadController($class_name){
        global $cpi_modules;
        $module = ucfirst($class_name);
       $file = $cpi_modules[$module].CPI_CONTROLLER.'/'.ucfirst($class_name).'.php';
        return include_once($file);
    }


    function loadObj($class_name, $args){
        global $classes;
        $file = $classes[$class_name];
        include_once($file);
        return new $class_name($args);
    }

    function loadLibrary($class_name){
        global $cpi_modules;
        $module = ucfirst($class_name);
        $file = PLUGIN_ROOT_DIR.'/libraries/'.ucfirst($class_name).'.php';
        return include_once($file);
    }



}