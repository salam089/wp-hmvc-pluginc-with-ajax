<?php

namespace App;

use App\Login;
class Login
{
    function __construct(){
        global $wpdb;
        $this->db = $wpdb;
    }

    public static function logout(){

    }
}