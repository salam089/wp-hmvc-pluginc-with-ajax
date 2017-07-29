<?php

namespace App;
use App\Quotation;

class Quotation
{
    public $db;

    function __construct(){
        global $wpdb;
        $this->db = $wpdb;
    }

    public function insert($data){
        //update_option('shah','shaht');
        global $wpdb;
       $prepared_sql =  $wpdb->prepare( "CALL addFreeTrial(%d, %d, %s)",  1, 1, "fgfdgfdg" );
       $results = $wpdb->get_results($prepared_sql);

        return $results;
    }


}