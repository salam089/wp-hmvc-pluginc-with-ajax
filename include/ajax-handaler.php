<?php
/**
 * Created by Shahalam.
 * User: user
 * Date: 8/4/2016
 * Time: 3:43 PM
 */

/**
 * @param $object
 * @param $method
 * @return Closure
 */


add_action( 'wp_ajax_user_logout', 'prefix_ajax_oel__logout' );
add_action( 'wp_ajax_nopriv_user_logout', 'prefix_ajax_oel__logout' );
function prefix_ajax_oel__logout() {
    if(!isset($_GET['user_email']))
        return;


    if(is_user_logged_in()) {
        wp_logout();
    }
    if ( is_wp_error() ){
        echo json_encode(array('type'=>false ,'loggout'=>false, 'message'=>'error occure'));
    } else {
        echo json_encode(array('type'=>true,'loggout'=>true,'message'=>__('Logout successful, redirecting...' )));
    }
    die();
}


add_action( 'wp_ajax_user_login', 'prefix_ajax_oel_login' );
add_action( 'wp_ajax_nopriv_user_login', 'prefix_ajax_oel_login' );
function prefix_ajax_oel_login() {

    global $wpdb;

    $info = array();
    $info['user_email'] = $account = sanitize_email($_GET['user_email']);
    $info['user_password'] = $_REQUEST['password'];
    $info['remember'] = (isset($_REQUEST['remember'])&& !empty($_REQUEST['remember']))?$_REQUEST['remember']:false;

    //$user = get_user( $info['user_email']);
    $user = get_user( $account );

    // $user = get_user_by('email', $info['user_email'])

    $user_data = $wpdb->get_results($wpdb->prepare("SELECT contact_name,website_url,email,email_cc,telephone,work_telephone,company_name,vat_number,address_1,address_2,postcode,town,state,country,pass_for_ftp FROM `".CMP_CLIENT_TABLE."` WHERE user_id = %d", $user->ID));

    $user = (object) array_merge((array) $user, (array) $user_data[0]);

    $pass_for_ftp = unserialize($user_data[0]->pass_for_ftp);
    $user->pass_for_ftp = $pass_for_ftp['pass'];
    $user->pass_for_ftp_masked = str_repeat('*', strlen($pass_for_ftp['pass']));
    $user->ftp_status = $pass_for_ftp['status'];
    $user->ftp_same_pass = $pass_for_ftp['same_pass'];

    // var_dump($user);
    
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



    $user_signon = wp_signon( $info, false );


    if ( is_wp_error($user_signon) ){
        if(!empty($error)){
            echo json_encode(array('type'=>false ,'loggedin'=>false, 'message'=> $error));
        }else{
            echo json_encode(array('type'=>false ,'loggedin'=>false, 'message'=> $user_signon->get_error_message()));
        }

    } else {
        $cookies_name = $_COOKIE[$user->user_login] ;

        // $user_templates = array(
        //     array('ID' => 1, 'name' => 'Shoe - white background with drop shadow', 'last_used' => '30 May 2016', 'times_used' => 5),
        //     array('ID' => 2, 'name' => 'Shows print 2016 milan', 'last_used' => '1 June 2016', 'times_used' => 6),
        //     array('ID' => 3, 'name' => 'Template 3', 'last_used' => '7 July 2016', 'times_used' => 7),
        //     array('ID' => 4, 'name' => 'Template 4', 'last_used' => '14 August 2016', 'times_used' => 8),
        //     array('ID' => 5, 'name' => 'Template 5', 'last_used' => '30 September 2016', 'times_used' => 9)
        // );

        // function generateRandomString($length = 10, $strings = 1) {
        //     $characters = 'abcdefghijklmnopqrstuvwxyz';
        //     $charactersLength = strlen($characters);
        //     $randomString = '';
        //     for ($i = 0; $i < $strings; $i++) {
        //         for ($j = 0; $j < $length; $j++) {
        //             $randomString .= $characters[rand(0, $charactersLength - 1)];
        //         }
        //         $randomString = ucfirst($randomString) . ' ';
        //     }
        //     return $randomString;
        // }

        // for($i=0;$i<20;$i++)
        //     array_push($user_templates, array('ID' => mt_rand(6,100), 'name' => generateRandomString(mt_rand(3,10), rand(1,8)), 'last_used' => $string = date("j F Y", mt_rand(1483228800,1489104000)), 'times_used' => mt_rand(0,10)));

        // echo json_encode(array('type'=>true,'loggedin'=>true,'userData'=>$user,'userTemplates'=>$user_templates,'user_loggedin_cookie'=>$cookies_name  ,'message'=>__('Login successful, redirecting...' )));
        echo json_encode(array('type'=>true,'loggedin'=>true,'userData'=>$user,'user_loggedin_cookie'=>$cookies_name  ,'message'=>__('Login successful, redirecting...' )));
    }
    die();
}

add_action( 'wp_ajax_oeluser_signup', 'cmp_ajax_user_signup' );
add_action( 'wp_ajax_nopriv_oeluser_signup', 'cmp_ajax_user_signup' );
function cmp_ajax_user_signup() {
global $wpdb;
    $data = array();
    $data['user_name'] =  sanitize_text_field($_GET['user_name']);
    $data['user_email'] = sanitize_email($_GET['user_email']);
    $data['user_password'] = $_GET['password'];
    $data['find_us'] = sanitize_text_field($_GET['findus']);
    $data['terms'] = (isset($_GET['terms'])&& !empty($_GET['terms']))?$_GET['terms']:false;

    $inserted_user = wp_create_user( $data['user_email'], $data['user_password'],  $data['user_email'] );
    if ( is_wp_error($inserted_user) ){
        echo json_encode(array('type'=>false ,'signup'=>false, 'message'=>  $inserted_user->get_error_message()));
    } else {
    // Add currency
    $data['default_currency'] = "USD";//$this->getCurrency();
    $user_info = get_userdata($inserted_user);
    $data['create_date'] = $user_info->user_registered;
    $data['modify_date'] = $user_info->user_registered;


   $inserted_client =  $wpdb->insert(
        CMP_CLIENT_TABLE,
        array(
            'user_id'  => $user_info->ID,
            'email'    => $data['user_email'],
            'create_date' => $data['create_date'] ,
            'modify_date' =>$data['modify_date'] ,
            'contact_name' => $data['user_name'],
            'find_us' => $data['find_us']
        ),
        array(
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s'
        )
    );


    //$insert_query = $wpdb->last_query;


    if (isset($data['user_id'])) unset($data['user_id']);

    if (isset($data['create_date'])) unset($data['create_date']);

    if (isset($data['modify_date'])) unset($data['modify_date']);

    if (isset($data['find_us'])) unset($data['find_us']);

   $inserted_client_fistory =  $wpdb->insert(
            CMP_CLIENT_HISTORY_TABLE,
            array(
                'user_id'  => $user_info->ID,
                'data'    => $data['user_email'],
                'modify_date' => ['create_date']
            ),
            array(
                '%d',
                '%s',
                '%s'
            )
        );

        prefix_ajax_oel_login();
        echo json_encode(array('type'=>true,'signup'=>true,'userData'=>$user_info,'user_loggedin_cookie'=> $data['user_email']  ,'message'=>__('Login successful, redirecting...')));
    }
    die();

}

add_action( 'wp_ajax_oeluser_forgetpass', 'ajax_forgotPassword' );
add_action( 'wp_ajax_nopriv_oeluser_forgetpass', 'ajax_forgotPassword' );

function ajax_forgotPassword(){

    // First check the nonce, if it fails the function will break
   // check_ajax_referer( 'ajax-forgot-nonce', 'security' );

    global $wpdb;

    $account = $_GET['user_email'];

    if( empty( $account ) ) {
        $error = 'Enter an username or e-mail address.';
    } else {
        if(is_email( $account )) {
            if( email_exists($account) )
                $get_by = 'email';
            else
                $error = 'There is no user registered with that email address.';
        }
        else if (validate_username( $account )) {
            if( username_exists($account) )
                $get_by = 'login';
            else
                $error = 'There is no user registered with that username.';
        }
        else
            $error = 'Invalid username or e-mail address.';
    }

    if(empty ($error)) {
        // lets generate our new password
        //$random_password = wp_generate_password( 12, false );
        //$random_password = wp_generate_password();


        // Get user data by field and data, fields are id, slug, email and login
        $user = get_user_by( $get_by, $account );
        $code = mt_rand(100000,999999);
        $update_user = update_user_meta( $user->ID,'forget_pass_token',$code);

        //$update_user = wp_update_user( array ( 'ID' => $user->ID, 'user_pass' => $random_password ) );

        // if  update user return true then lets send user an email containing the new password
        if( $update_user ) {

            $from = 'WRITE SENDER EMAIL ADDRESS HERE'; // Set whatever you want like mail@yourdomain.com

            if(!(isset($from) && is_email($from))) {
                $sitename = strtolower( $_SERVER['SERVER_NAME'] );
                if ( substr( $sitename, 0, 4 ) == 'www.' ) {
                    $sitename = substr( $sitename, 4 );
                }
                $from = 'admin@'.$sitename;
            }

            $to = $user->user_email;
            $subject = 'Your new password';
            $sender = 'From: '.get_option('name').' <'.$from.'>' . "\r\n";

            //$message = 'Your new password is: '.$random_password;
            $message = 'Your request processed code is: <b>'.$code .'</b>';

            $headers[] = 'MIME-Version: 1.0' . "\r\n";
            $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers[] = "X-Mailer: PHP \r\n";
            $headers[] = $sender;

            $mail = wp_mail( $to, $subject, $message, $headers );
            if( $mail )
                $success = 'Check your email address for you new password.';
            else
                $error = 'System is unable to send you mail containg your request processed CODE.';
        } else {
            $error = 'Oops! Something went wrong while updaing your account.';
        }
    }

    if( ! empty( $error ) )
        echo json_encode(array('type'=>false,'loggedin'=>false, 'message'=>__($error)));

    if( ! empty( $success ) )
        echo json_encode(array('type'=>true,'loggedin'=>true, 'message'=>__($success)));

    die();
}

add_action( 'wp_ajax_get_user', 'oel_ajax_get_user' );
add_action( 'wp_ajax_nopriv_get_user', 'oel_ajax_get_user' );
function get_user($email="") {
    // Handle request then generate response using WP_Ajax_Response

        global $wpdb;
        $client_table = CMP_CLIENT_TABLE;
        $query =  $wpdb->prepare("SELECT * FROM {$wpdb->prefix}users as us LEFT JOIN $client_table as ct ON ct.user_id = us.ID WHERE us.user_email=%s", $email) ;
        $results = $wpdb->get_results($query, OBJECT);
        $user =$results[0];
        if ( is_wp_error($results) ){
            return false;
        } else {
            return $user;
       }

}

add_action( 'wp_ajax_oeluser_verifyreq', 'oel_ajax_verify_forgetpass' );
add_action( 'wp_ajax_nopriv_oeluser_verifyreq', 'oel_ajax_verify_forgetpass' );
function oel_ajax_verify_forgetpass() {
    // Handle request then generate response using WP_Ajax_Response

    $data = array();
    $account = sanitize_email($_GET['user_email']);
    $code = $_GET['verify_code'];

    if( empty( $account ) ) {
        $error = 'Enter an username or e-mail address.';
    } else {
        if(is_email( $account )) {
            if( email_exists($account) )
                $get_by = 'email';
            else
                $error = 'There is no user registered with that email address.';
        }
        else if (validate_username( $account )) {
            if( username_exists($account) )
                $get_by = 'login';
            else
                $error = 'There is no user registered with that username.';
        }
        else
            $error = 'Invalid username or e-mail address.';
    }
    $user = get_user_by($get_by, $account);


    $forget_requested_code = get_user_meta($user->ID, 'forget_pass_token',true);


    if (!empty($forget_requested_code)&&($forget_requested_code == $code)){
        $code_verifed = true;
    }else{
        $error .= empty($error)? " The code is not exists.":" ";
        $code_verifed = false;
    }

    if(empty ($error)) {
        // Get user data by field and data, fields are id, slug, email and login
        $success = "Your code is susscessfuly verified. Please wait for redirection.";
        $verified_data = new stdClass;
        $verified_data->email = $account;
        $verified_data->code = $code;
        $verified_data->status = true;

     }

    if (!empty($error))
        echo json_encode(array('type'=>false,'loggedin' => false, 'message' => __($error)));

    if (!empty($success))
        echo json_encode(array('type'=>true,'loggedin' => false, verifiedToken=>$verified_data, 'message' => __($success)));

    die();

}


add_action( 'wp_ajax_oeluser_change_pass', 'oel_ajax_oel_change_pass' );
add_action( 'wp_ajax_nopriv_oeluser_change_pass', 'oel_ajax_oel_change_pass' );
function oel_ajax_oel_change_pass() {
    // Handle request then generate response using WP_Ajax_Response

    $data = $return_data  = array();
    $account = sanitize_email($_GET['user_email']);
    $code = $_GET['verify_code'];
    $password = $_GET['password'];
    $requestFrom = (isset($_GET['request_from'])&& ($_GET['request_from']=='free_quote'))? $_GET['request_from'] : false ;

    if( empty( $account ) ) {
        $error = 'There are some technicle error please try again.';
    } else {
        if(is_email( $account )) {
            if( email_exists($account) )
                $get_by = 'email';
            else
                $error = 'There is no user registered with that email address.';
        }
        else if (validate_username( $account )) {
            if( username_exists($account) )
                $get_by = 'login';
            else
                $error = 'There is no user registered with that username.';
        }
        else
            $error = 'Invalid username or e-mail address.';
    }





    if(empty ($error)) {
        // lets generate our new password
        //$random_password = wp_generate_password( 12, false );
        //$random_password = wp_generate_password();


        // Get user data by field and data, fields are id, slug, email and login
        $user = get_user_by( $get_by, $account );
        $forget_requested_code = get_user_meta($user->ID, 'forget_pass_token',true);

        if (!empty($forget_requested_code)&&($forget_requested_code == $code)){
            $code_verifed = true;
        }else{
            $error .= empty($error)? " The code is not exists.":" ";
            $code_verifed = false;
        }

        $update_user = wp_update_user( array ( 'ID' => $user->ID, 'user_pass' => $password ) );

        // if  update user return true then lets send user an email containing the new password
        if( $update_user ) {

            if (trim($requestFrom) == 'free_quote') {
                $new_user_data = get_user_by($get_by, $account);
                $info = array();
                $info['user_email'] = $account;
                $info['user_password'] = $password;
                $info['user_login'] = $account;
                $info['remember'] = (isset($_REQUEST['remember']) && !empty($_REQUEST['remember'])) ? $_REQUEST['remember'] : false;
                $user_signon = wp_signon($info, false);
                $cookies_name = $_COOKIE[$user->user_login];
                if (is_wp_error($user_signon)) {
                    $return_data = array('userData' => $new_user_data, 'loggedin' => false, 'user_loggedin_cookie' => $cookies_name);
                } else {
                    $return_data = array('userData' => $new_user_data, 'loggedin' => true, 'user_loggedin_cookie' => $cookies_name);
                }


            } else {
                $return_data = array('loggedin' => false);
            }

            $from = 'WRITE SENDER EMAIL ADDRESS HERE'; // Set whatever you want like mail@yourdomain.com

            if (!(isset($from) && is_email($from))) {
                $sitename = strtolower($_SERVER['SERVER_NAME']);
                if (substr($sitename, 0, 4) == 'www.') {
                    $sitename = substr($sitename, 4);
                }
                $from = 'admin@' . $sitename;
            }

            $to = $user->user_email;
            $subject = 'Your account password hasbeen changed';
            $sender = 'From: ' . get_option('name') . ' <' . $from . '>' . "\r\n";

            //$message = 'Your new password is: '.$random_password;
            $message = 'You account password has been changed to' . $password;

            $headers[] = 'MIME-Version: 1.0' . "\r\n";
            $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers[] = "X-Mailer: PHP \r\n";
            $headers[] = $sender;

            $mail = wp_mail($to, $subject, $message, $headers);
            if ($mail) {
                $success = 'Your password hasbeen successfuly changed.';
            } else{
                $error = 'System is unable to send you mail about change password.';
            }
        } else {
            $error = 'Oops! Something went wrong while updaing your account.';
        }

    }

    if( ! empty( $error ) ){
        $return_data['type'] = false;
        $return_data['message'] = $error;

        echo json_encode($return_data);
    }


    if( ! empty( $success ) ){
        $return_data['type'] = true;
        $return_data['message'] = $success;
        echo json_encode($return_data);
    }


    die();

}

add_action( 'wp_ajax_oel_user_edit_parsonal', 'cmp_ajax_user_edit' );
add_action( 'wp_ajax_nopriv_oel_user_edit_parsonal', 'cmp_ajax_user_edit' );

function cmp_ajax_user_edit()
{
    // Handle request then generate response using WP_Ajax_Response
    $data = array();
    $account = sanitize_email($_GET['user_email']);
    $type = sanitize_text_field($_GET['type']);
    $user_id = sanitize_text_field($_GET['user_id']);

    if (empty($account)) {
        $error = 'Enter an username or e-mail address.';
    } else {
        if (is_email($account)) {
            if (email_exists($account))
                $get_by = 'email';
            else
                $error = 'There is no user registered with that email address.';
        } else if (validate_username($account)) {
            if (username_exists($account))
                $get_by = 'login';
            else
                $error = 'There is no user registered with that username.';
        } else
            $error = 'Invalid username or e-mail address.';
    }

    if(empty ($error)) {
        global $wpdb;

        if($type=="personal_info"){
            $data = array();
            $data['contact_name'] = sanitize_text_field($_GET['user_name']);
            $data['email'] =sanitize_text_field($_GET['email']);
            $data['telephone'] =sanitize_text_field($_GET['user_phone']);
            $data['email_cc'] = sanitize_text_field($_GET['more_emails']);

            $validate_error = false;
            if(empty($data['contact_name']) || strlen($data['contact_name']) > 50)
                $validate_error = "Contact name is too long or too short";
            if(!is_email($data['email']) || empty($data['email']) || strlen($data['email']) > 200)
                $validate_error = "Invalid email address";
            if(!preg_match("/^(\+|)\d{4}-\d{3}-\d+$/",$data['telephone']) || empty($data['telephone']) || strlen($data['telephone']) > 30)
                $validate_error = "Invalid phone number format";
            $more_emails = strlen($data['email_cc']) > 0 ? explode(",", $data['email_cc']) : false;
            if($more_emails)
                foreach($more_emails as $email_cc){
                    if(!is_email($email_cc) || empty($email_cc) ||  strlen($email_cc) > 50){
                        $validate_error = "Invalid email address";
                        break;
                    }
                }

            if($validate_error === false){
                $update_data =  $wpdb->update( CMP_CLIENT_TABLE, $data, array('user_id' => $user_id) );
                $last_q = $wpdb->last_query;//lists only single query
                if( $update_data ) {
                    // $user = get_user( $account );
                    $success = 'Your personal information has been changed.';
                }else{
                    if( $update_data === 0 )
                        $success = 'Your personal information is up to date.';
                    else
                        $error = 'Oops! Something went wrong while updaing your account.';
                }
            }
            else
                $error = $validate_error;

        }elseif($type=="company_info"){

            $data = array();
            $data['company_name'] = sanitize_text_field($_GET['companyname']);
            $data['website_url'] =sanitize_text_field($_GET['website']);
            $data['work_telephone'] =sanitize_text_field($_GET['workphone']);
            $data['vat_number'] =sanitize_text_field($_GET['vat_num']);

            $validate_error = false;
            if(empty($data['company_name']) || strlen($data['company_name']) > 100)
                $validate_error = "Company name is too long or too short";
            if((filter_var($data['website_url'], FILTER_VALIDATE_URL) === FALSE && !empty($data['website_url'])) || strlen($data['website_url']) > 255)
                $validate_error = "Invalid website url";
            if(!preg_match("/^(\+|)\d{4}-\d{3}-\d+$/",$data['work_telephone']) || empty($data['work_telephone']) || strlen($data['work_telephone']) > 30)
                $validate_error = "Invalid phone number format";
            if(strlen($data['vat_number']) > 50)
                $validate_error = "Vat number is too long or too short";

            if($validate_error === false){
                $update_data =  $wpdb->update( CMP_CLIENT_TABLE, $data, array('user_id' => $user_id) );
                $last_q = $wpdb->last_query;//lists only single query
                if( $update_data ) {
                    // $user = get_user( $account );
                    $success = 'Your Company information has been changed.';
                }else{
                    
                    if( $update_data === 0 )
                        $success = 'Your company information is up to date.';
                    else
                        $error = 'Oops! Something went wrong while updating your company info.';
                }
            }
            else
                $error = $validate_error;


        }elseif($type=="billing_info"){
            $data = array();
            $data['address_1'] = sanitize_text_field($_GET['address1']);
            $data['address_2'] =sanitize_text_field($_GET['address2']);
            $data['town'] =sanitize_text_field($_GET['city']);
            $data['state'] =sanitize_text_field($_GET['county']);
            $data['postcode'] =sanitize_text_field($_GET['postcode']);
            $data['country'] =sanitize_text_field($_GET['country']);

            $validate_error = false;
            if(empty($data['address_1']) || strlen($data['address_1']) > 100)
                $validate_error = "Address line 1 is too long or too short";
            if(strlen($data['address_2']) > 100)
                $validate_error = "Address line 2 is too long";
            if(empty($data['town']) || strlen($data['town']) > 50)
                $validate_error = "City name is too long or too short";
            if(strlen($data['state']) > 50)
                $validate_error = "County name is too long";
            if(empty($data['postcode']) || strlen($data['postcode']) > 50)
                $validate_error = "Post code is too long or too short";
            if(empty($data['country']) || strlen($data['country']) > 2)
                $validate_error = "Invalid country name";

            if($validate_error === false){
                $update_data =  $wpdb->update( CMP_CLIENT_TABLE, $data, array('user_id' => $user_id) );
                $last_q = $wpdb->last_query;//lists only single query
                if( $update_data ) {
                    // $user = get_user( $account );
                    $success = 'Your Billing information has been changed.';
                }else{
                    
                    if( $update_data === 0 )
                        $success = 'Your billing information is up to date.';
                    else
                        $error = 'Oops! Something went wrong while updating your billing info.';
                }
            }
            else
                $error = $validate_error;


        }elseif($type=="change_pass"){
            $data = array();
            $password = sanitize_text_field($_GET['password']);
            $pass_for_ftp = sanitize_text_field($_GET['passforftp']);
            $ftp_status = (int) (filter_var( sanitize_text_field($_GET['ftpStatus']), FILTER_VALIDATE_BOOLEAN) );
            $ftp_same_pass = (int) (filter_var( sanitize_text_field($_GET['ftpSamePassword']), FILTER_VALIDATE_BOOLEAN) );

            // $data['pass_for_ftp'] = ($data['pass_for_ftp']=='true')?"Yes":"No";

            $data['pass_for_ftp'] = serialize(array('status'=>$ftp_status, 'same_pass'=>$ftp_same_pass, 'pass'=>$pass_for_ftp));

            $update_user = wp_update_user( array ( 'ID' => $user_id, 'user_pass' => $password ) );

            $update_data =  $wpdb->update( CMP_CLIENT_TABLE, $data, array('user_id' => $user_id) );

            if($ftp_same_pass == 1){
                $ftp_data['status'] = $ftp_status;
                $ftp_data['Password'] = md5($pass_for_ftp);
                $update_data =  $wpdb->update( CMP_FTP_TABLE, $ftp_data, array('User' => $user_id."@clippingpathindia.com") );
            }

            $last_q = $wpdb->last_query;//lists only single query

            $validate_error = false;
            if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d$@$!%*?&]{8,}/",$password) || empty($password))
                $validate_error = "Invalid password format";
            if((!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d$@$!%*?&]{8,}/",$pass_for_ftp) && !empty($ftp_same_pass)) || strlen($pass_for_ftp) > 255)
                $validate_error = "Invalid password format";
            if($ftp_same_pass == 1 && $password !== $pass_for_ftp)
                $validate_error = "FTP password doesnt match";


            if($validate_error === false){
                if( $update_user ) {
                    // $user = get_user( $account );
                    $success = 'Your account password has been changed.';
                }else{
                    
                    if( $update_data === 0 )
                        $success = 'Your account password is up to date.';
                    else
                        $error = 'Oops! Something went wrong while updating password.';
                }
            }
            else
                $error = $validate_error;

        }elseif($type=="enable_ftp"){
            $pass_for_ftp = sanitize_text_field($_GET['passforftp']);

            $data = array();
            $data['pass_for_ftp'] = serialize(array('status'=>1, 'same_pass'=>0, 'pass'=>$pass_for_ftp));

            $update_data =  $wpdb->update( CMP_CLIENT_TABLE, $data, array('user_id' => $user_id) );

            $sql = "INSERT INTO `".CMP_FTP_TABLE."` (User,status,Password,Uid,Gid,Dir,ULBandwidth,DLBandwidth,comment,ipaccess,QuotaSize,QuotaFiles) VALUES (%s,%s,%s,%s,%s,%s,%d,%d,%s,%s,%d,%d) ON DUPLICATE KEY UPDATE status = %s, password = %s";
            $sql = $wpdb->prepare($sql, $user_id."@clippingpathindia.com", 1, md5($pass_for_ftp), 2001, 33, "/data/files/".$user_id, 0, 0, "", "*", 0, 0, 1, md5($pass_for_ftp));
            $enable_ftp = $wpdb->query($sql);
            $last_q = $wpdb->last_query;//lists only single query

            $validate_error = false;
            if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d$@$!%*?&]{8,}/",$pass_for_ftp) || empty($pass_for_ftp) || strlen($data['password']) > 255)
                $validate_error = "Invalid FTP password format";


            if($validate_error === false){
                if( $enable_ftp ) {
                    // $user = get_user( $account );
                    $success = 'Your FTP account is created successfuly.';
                }else{
                    if( $enable_ftp === 0 )
                        $success = 'Your FTP password is up to date.';
                    else
                        $error = 'Oops! Something went wrong while updating password.';
                }
            }
            else
                $error = $validate_error;

        }elseif($type=="change_ftp_pass"){
            $data = array();
            $pass_for_ftp = sanitize_text_field($_GET['passforftp']);

            // $data['pass_for_ftp'] = ($data['pass_for_ftp']=='true')?"Yes":"No";

            $data['pass_for_ftp'] = serialize(array('status'=>1, 'same_pass'=>0, 'pass'=>$pass_for_ftp));

            $update_data =  $wpdb->update( CMP_CLIENT_TABLE, $data, array('user_id' => $user_id) );

            $ftp_data['status'] = 1;
            $ftp_data['Password'] = md5($pass_for_ftp);
            $update_data =  $wpdb->update( CMP_FTP_TABLE, $ftp_data, array('User' => $user_id."@clippingpathindia.com") );

            $last_q = $wpdb->last_query;//lists only single query

            $validate_error = false;
            if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d$@$!%*?&]{8,}/",$pass_for_ftp) || empty($pass_for_ftp) || strlen($pass_for_ftp) > 255)
                $validate_error = "Invalid FTP password format";


            if($validate_error === false){
                if( $update_data ) {
                    // $user = get_user( $account );
                    $success = 'Your FTP password has been updated.';
                }else{
                    
                    if( $update_data === 0 )
                        $success = 'Your FTP password is up to date.';
                    else
                        $error = 'Oops! Something went wrong while updating password.';
                }
            }
            else
                $error = $validate_error;
        }

    }


    if( ! empty( $error ) )
        echo json_encode(array('type'=>false,'loggedin'=>false, 'message'=>$error));

    if( ! empty( $success ) ){
        $user = get_user( $account );
        
        $user_data = $wpdb->get_results($wpdb->prepare("SELECT contact_name,website_url,email,email_cc,telephone,work_telephone,company_name,vat_number,address_1,address_2,postcode,town,state,country,pass_for_ftp FROM `".CMP_CLIENT_TABLE."` WHERE user_id = %d", $user->ID));

        $user = (object) array_merge((array) $user, (array) $user_data[0]);

        $pass_for_ftp = unserialize($user_data[0]->pass_for_ftp);
        $user->pass_for_ftp = $pass_for_ftp['pass'];
        $user->pass_for_ftp_masked = str_repeat('*', strlen($pass_for_ftp['pass']));
        $user->ftp_status = $pass_for_ftp['status'];
        $user->ftp_same_pass = $pass_for_ftp['same_pass'];

        echo json_encode(array('type'=>true,'loggedin'=>true, 'userData'=>$user, 'message'=>$success));
    }

    die();
}

//add_action('admin_enqueue_scripts', 'unload_all_jquery');
//add_action('enqueue_scripts', 'unload_all_jquery');


add_action( 'wp_ajax_oeluser_login', 'cmp_ajax_user_login' );
add_action( 'wp_ajax_nopriv_oeluser_login', 'cmp_ajax_user_login' );

function cmp_ajax_user_login() {

    global $json_api;

    if (!$json_api->query->cookie) {

        $json_api->error("You must include a 'cookie' authentication cookie. Use the create_auth_cookie method.");

    }

    $valid = wp_validate_auth_cookie($json_api->query->cookie, 'logged_in') ? true : false;

    $userid = wp_validate_auth_cookie($json_api->query->cookie, 'logged_in');

// print_r($userid);
// print_r(get_userdata( $userid ));
    $data = get_userdata( $userid );
    $username = $data->user_login;
// print_r($username );
// require('../wp-blog-header.php');
    $user_login = $username;
    $user = get_userdatabylogin($user_login);
// print_r($user);
    $user_id = $user->ID;
    $dsf=wp_set_current_user($user_id, $user_login);
// print_r($dsf);
    $sdf=wp_set_auth_cookie($user_id);
// print_r($sdf);
    $datas=do_action('wp_login', $user_login);
// print_r($datas);
// exit;
    wp_redirect( get_site_url(), 301 ); //exit;
// exit;

    if($userid) {
        $creds = array();
// $creds['user_login'] = 'add';// $json_api->query->username;
// $creds['user_password'] = 'add'; // $json_api->query->password;
        $creds['remember'] = true;
        $user = wp_signon( $creds, false );
        if ( is_wp_error($user) )
            echo $user->get_error_message();

        wp_redirect( get_site_url(), 301 ); exit;
    }
    else

    {
        return array("valid" => $valid);
    }
}





    function cmp_ajax_img_upload(){

        if(!session_id()){
            session_start();

        }
       $jobFolder =  session_id(). "_" . date("Y-m-d").'/';
       $user_folder = (isset($_SESSION["user_folder"]))? $_SESSION["user_folder"]."/" : "quotation";


        if(isset($_GET['deleted_file']) && !empty($_GET['deleted_file'])){
            $filename = $_GET['deleted_file'];
            $fileOut= "/data/files/".$user_folder.$jobFolder;
            if (file_exists($fileOut.$filename)) {
            //this can also be a png or jpg

                //Set the content-type header as appropriate
                $imageInfo = getimagesize($fileOut.$filename);


                switch ($imageInfo['mime']) {
                    case 'image/jpeg':
                        header("Content-Type: image/jpg");
                       header('Content-Length: ' . filesize($fileOut.$filename));
                      readfile($fileOut.'thumbnail/'.$filename);
                        break;
                    case 'image/gif':
                        header("Content-Type: image/gif");
                        header('Content-Length: ' . filesize($fileOut.$filename));
                        readfile($fileOut.'thumbnail/'.$filename);
                        break;
                    case 'image/png':
                       header("Content-Type: image/png");
                        header('Content-Length: ' . filesize($fileOut.$filename));
                        readfile($fileOut.'thumbnail/'.$filename);
                        break;
                    case 'image/g3fax':
                        $filename ='g3fax.jpg';
                        $fileOut =PLUGIN_ROOT_DIR.'templates/assets/images/uploads/';
                        header("Content-Type: image/jpeg");
                        header('Content-Length: ' . filesize($fileOut.$filename));
                        readfile($fileOut.$filename);
                        break;
                        break;
                    case 'image/psd':

                         $fileOut =PLUGIN_ROOT_DIR.'templates/assets/images/uploads/';
                         $filename ='psd.png';
                        header("Content-Type: image/png");
                        header('Content-Length: ' . filesize($fileOut.$filename));
                        readfile($fileOut.$filename);
                        break;
                    case 'image/tiff':
                        $filename ='tiff.jpg';
                        $fileOut =PLUGIN_ROOT_DIR.'templates/assets/images/uploads/';
                        header("Content-Type: image/jpeg");
                        header('Content-Length: ' . filesize($fileOut.$filename));
                        readfile($fileOut.$filename);
                        break;
                    default:
                        $fileOut =PLUGIN_ROOT_DIR.'templates/assets/images/uploads/';
                        $filename ='default.png';
                        header("Content-Type: image/png");
                        header('Content-Length: ' . filesize($fileOut.$filename));
                        readfile($fileOut.$filename);
                        break;
                }

                die();



            }else{
                header("Content-Type: image/jpeg");
                $fileOut = '/wamp/www/cpi-live/wp-content/plugins/oel-cmp/uploads/images.png';
                header('Content-Length: ' . filesize($fileOut));
            }

            die();

        }else{
            include_once('UploadHandler.php');


            $uploadDir = "/data/files/$user_folder.$jobFolder/";
            $uploadThumbDir = $uploadDir = "/data/files/$user_folder.$jobFolder/";

             $data['options'] = array(
                'upload_dir' => $uploadDir,
                'upload_url' => 'https://www.cpilive.com/wp-admin/admin-ajax.php?action=upload_handaler&deleted_file=',
                'upload_thumb_dir' =>$uploadDir,
                'script_url' =>  'https://www.cpilive.com/wp-content/plugins/oel-cmp/templates/assets/js/uploader/server/php/index.php',
                'order_id' => '12300',
                'customer_dir'=> $uploadDir
            );

             new UploadHandler( $data['options']);

        }

        die();
    }

add_action( 'wp_ajax_upload_handaler', 'cmp_ajax_img_upload' );
add_action( 'wp_ajax_nopriv_upload_handaler', 'cmp_ajax_img_upload' );



if(!function_exists('get_upload_path')){
    function get_upload_path($param){

        extract($param);

        switch ($type) {
            case FREE_QUOTATION_TRIAL:
                $path = "/data/files/freetrialquote/$user_folder. $jobFolder";
                break;
            case FREE_QUOTATION:
                $path = "/data/files/quotations/$user_folder. $jobFolder";
                break;
            default:
                $filename = 'default.jpg';
                $path = "/wamp\www\cpiv3.1\wp-content\plugins\oel-cmp\uploads/";
                break;
        }

        return $path;



    }
}

add_action( 'wp_ajax_post_request', 'cmp_ajax_quotation_post_request' );
add_action( 'wp_ajax_nopriv_post_request', 'cmp_ajax_quotation_post_request' );

function cmp_ajax_quotation_post_request(){

    include_once(PLUGIN_ROOT_DIR . 'core/loader.php');
     $error  = true;

    $json = file_get_contents('php://input');
    $obj = json_decode($json);

    //$obj = new stdClass();
    //$obj->operation->type='quotation_free_trial_add';
    //$obj->operation->type='quote_request';


    if(!empty($obj->operation->type)){
        $post = new PostHandaler($obj->operation);
        $request = get_method($post, $obj->operation->type);
        $data = $request($obj);  //Output is "Hello"


    }


    if( ! empty( $data['error'] ) )
        echo json_encode(array('type'=>false,'data'=>$data, 'message'=> $data['message']));

    if( ! empty( $data['success'] ) )
        echo json_encode(array('type'=>true, 'data'=>$data, 'message'=>$data['message']));

    die();

}

add_action( 'wp_ajax_post_data', 'cmp_ajax_post_request' );
add_action( 'wp_ajax_nopriv_post_data', 'cmp_ajax_post_request' );

function cmp_ajax_post_request(){

    include_once(PLUGIN_ROOT_DIR . 'core/loader.php');
    $error  = true;

    $json = file_get_contents('php://input');
    $obj = json_decode($json);

    // $obj = new stdClass();
    // $obj->operation->type='quotation_getTemplate';
   
    if(!empty($obj->operation->type)){
        $post = new PostHandaler($obj->operation);
        $request = get_method($post,'processRequest');
        $data = $request($obj);  //Output is "Hello"
    }

    if( ! empty( $data['error'] ) )
        echo json_encode(array('type'=>false,'data'=>$data, 'message'=> $data['message']));

    if( ! empty( $data['success'] ) )
        echo json_encode(array('type'=>true, 'data'=>$data, 'message'=>$data['message']));

    die();

}












