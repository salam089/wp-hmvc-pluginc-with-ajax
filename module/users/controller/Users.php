<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/9/2016
 * Time: 5:23 PM
 */
class Users
{ use loader;


    public $user_id;
    private $db, $modelUsers;
    public $rurl;


    public function __construct($user_id = NULL) {

        $this->loadModel(get_class($this));
        //$this->loadHelper('path');
        //$this->modelUsers =new APP\Users;

        if ($user_id)

            $this->user_id = $user_id;

        elseif (is_user_logged_in())

            $this->user_id = get_current_user_id();

        // Initiate local database
        global $wpdb;

        $this->db = $wpdb;
    }

    public function userLogin() {

        $info = array();

        $info['user_email'] = $account = sanitize_email($_POST['user_email']);
        $info['user_password'] = $_POST['password'];
        $info['remember'] = (isset($_POST['remember'])&& !empty($_POST['remember']))? $_POST['remember']:false;

        $user = get_user( $info['user_email']);

        //$user = get_user_by('email', $info['user_email']);
        if( empty( $account ) ) {
            $error = 'Enter an username or e-mail address.';
        } else {
            if(is_email( $account )) {
                if (email_exists($account)) {
                    $get_by = 'email';
                    $info['user_login'] = $account;
                } else{
                    $error = 'There is no user registered with that email address.';
                }
            }
            else
                $error = 'Invalid username or e-mail address.';
        }



        // $user_signon = wp_signon( $info, false );
        $user_signon = APP\Users::oel_sign_on($info,false);


        if ( is_wp_error($user_signon) ){
            if(!empty($error)){
                return json_encode(array('type'=>false ,'loggedin'=>$info, 'message'=> $error));
            }else{
                return json_encode(array('type'=>false ,'loggedin'=>$info, 'message'=> $user_signon->get_error_message()));
            }

        } else {
            $cookies_name = $_COOKIE[$user->user_login] ;
            return json_encode(array('type'=>true,'loggedin'=>true,'userData'=>$user,'user_loggedin_cookie'=>$cookies_name  ,'message'=>'Login successful, redirecting...'));
        }

    }




    public function user_signup($user_data){
        $model = new APP\Users();
        return $inserted_wp_user = $model->add_wp_user($user_data);

    }

    public function checkUser(){
        $model = new APP\Users();
        $_POST['user_email']=$_POST['client_email'];
        $user_data= $_POST;
        $user = get_user( $_POST['user_email']);
        if($user){
            $loginData = json_decode($this->userLogin());

            //$data = array("abc" => $loginData);
            if(!$loginData->type){
                $data['message']= "The user have found in our system.Password not match.";
                $data['error']= true;
                $data['success']= false;
                $data['is_user_exists']= true;
            }else{
                $data = (array) $loginData;
                $data['error'] = false;
                $data['success'] = true;
                $data['is_user_exists']= true;
                $data['message']= "The user have found and have logged in.";
            }


        }else{
            $data = array("abc" => $_POST);
            $data['message'] = 'user not found';
            $data['error'] = true;
            $data['success'] = false;
            $data['is_user_exists'] = false;

        }


        return $data;
    }





}