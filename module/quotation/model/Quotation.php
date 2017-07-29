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

    public function getQuotations($table){

        global $wpdb;

        $prepared_sql = $wpdb->prepare( '
            SELECT q.*, 
            (CASE WHEN (q.status = "Completed") THEN 1 
            ELSE
                (CASE WHEN (q.status = "Pending") THEN 2
                ELSE
                    3
                END)
            END) as status_num,
            GROUP_CONCAT(s.label SEPARATOR ", ") as services
            from ' . CMP_QUOTATION_TABLE . ' as q ,
            ' . CMP_QUOTATION_ITEMS_TABLE . ' as qi
            LEFT JOIN ' . CMP_PRICE_LIST . ' as p ON qi.price_list_id = p.id
            LEFT JOIN ' . CMP_SERVICES . ' as s ON p.service_sku = s.sku
            WHERE q.id = qi.quotation_id AND user_id = %d
            GROUP BY qi.quotation_id'
        , get_current_user_id());

        $result = $wpdb->get_results($prepared_sql);

        // return $wpdb->last_query;
        return $result;
    }

}