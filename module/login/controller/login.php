<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/5/2016
 * Time: 12:08 PM
 */
class Login
{
    use loader;


    public $user_id;
    public $quotation_id;
    public $rurl;
    private $db;

    public function __construct($user_id = NULL)
    {
        $this->loadModel(get_class($this));
    }

    public function logout(){

        if(!isset($_POST['user_email']))
            return array('type'=>false ,'loggout'=>false, 'message'=>'Email not found');


        if(is_user_logged_in()) {

            wp_logout();
            return array('type'=>true,'error'=>false, 'success'=>true, 'loggout'=>true,'message'=>__('Logout successful, redirecting...' ));
        } else {
            return array('type'=>false ,'error'=>true, 'success'=>false, 'loggout'=>false, 'message'=>'error occure');
        }
    }

}