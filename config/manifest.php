<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/5/2016
 * Time: 3:49 PM
 */


global  $portal_controllers, $portal_models, $helper_classes;

$cpi_modules = array (
    'Quotation' => PLUGIN_ROOT_DIR.'module/quotation/',
    'Users' => PLUGIN_ROOT_DIR.'module/users/',
    'Login' => PLUGIN_ROOT_DIR.'module/login/'
);

$portal_controller = array (
    'Quotation' => '../wp-content/plugins/oel-cmp/module/quotation/controller/Quotation.php',
    'Users' => '../wp-content/plugins/oel-cmp/module/quotation/controller/Users.php',
    'Login' => '../wp-content/plugins/oel-cmp/module/quotation/controller/Login.php',
);
$portal_models = array (
    'Quotation' => '../wp-content/plugins/oel-cmp/module/quotation/model/Quotation.php',
    'Users' => '../wp-content/plugins/oel-cmp/module/quotation/model/Users.php',
    'Login' => '../wp-content/plugins/oel-cmp/module/quotation/model/Login.php',
);

$helper_classes = array();

