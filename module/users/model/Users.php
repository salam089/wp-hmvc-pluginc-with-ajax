<?php

namespace App;
class Users
{
    public $db,$module;

    function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
    }

    /**
     * @param $data as dataset
     * @return array|int|\WP_Error
     */
    public function add_wp_user($data){
        global $wpdb;



        $inserted_wp_user = wp_create_user($data['client_email'], $data['user_password'], $data['client_email']);

        if(!is_int ($inserted_wp_user)){
            return array('error'=>true, 'message'=>'User not inserted');
        }else {

            $data['default_currency'] = getCurrency();
            $user_info = get_userdata($inserted_wp_user);
            $data['user_id'] = $user_info->ID;
            $data['create_date'] = $user_info->user_registered;
            $data['modify_date'] = $user_info->user_registered;
            $client_data = $this->add_client($data);
            if (is_wp_error($client_data)) {
                return array('error' => true, 'message' => 'Client not inserted');
            } else {
                if (isset($data['user_id'])) unset($data['user_id']);
                if (isset($data['create_date'])) unset($data['create_date']);
                if (isset($data['modify_date'])) unset($data['modify_date']);
                if (isset($data['find_us'])) unset($data['find_us']);
                $client_history = $this->add_client_history($data,$user_info);
                if (is_wp_error($client_history)) {
                    return array('error' => true, 'message' => 'Client history not added');
                } else {
                    return $inserted_wp_user;

                }
            }
        }


    }

    /**
     * @param $data as dataset
     * @param $freequote false|int
     * @return false|int
     */

    public  function add_client($data,$freequote)
    {
        global $wpdb;
        if($freequote)

       return $inserted_client = $wpdb->insert(
                CLIENT_TABLE,
                array(
                    'user_id' =>$data['user_id'],
                    'email' => $data['user_email'],
                    'create_date' => $data['create_date'],
                    'modify_date' => $data['modify_date'],
                    'contact_name' => $data['uname'],
                    'find_us' => $data['find_us'],
                    'default_currency'=>$data['default_currency']
                ),
                array(
                    '%d',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s'
                )
            );

    }


    public function add_client_history($data , $user_info)
    {
        global $wpdb;
       return $inserted_client_fistory = $wpdb->insert(
            CLIENT_HISTORY_TABLE,
            array(
                'user_id' =>  $user_info->ID,
                'data' => serialize($data),
                'modify_date' => $user_info->user_registered
            ),
            array(
                '%d',
                '%s',
                '%s'
            )
        );

    }


    public static function oel_sign_on($data, $optional)
    {

        return $user_signon = wp_signon($data, $optional);
    }


    public function add_free_trial(){

        mysql_query('START TRANSACTION');
        $res1 = mysql_query('query1');
        $res2 = mysql_query('query2');
        If ( $res1 && $res2 ) {
            mysql_query('COMMIT'); // commits all queries
        } else {
            mysql_query('ROLLBACK'); // rollbacks everything
        }



        $wpdb->query('START TRANSACTION');
        $result1 = $wpdb->delete( $table, $where, $where_format = null );
        $resul2 = $wpdb->delete( $table, $where, $where_format = null );
        if($result1 && $result2) {
            $wpdb->query('COMMIT'); // if you come here then well done
        }
        else {
            $wpdb->query('ROLLBACK'); // // something went wrong, Rollback
        }
    }

}