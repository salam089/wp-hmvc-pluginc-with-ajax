<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/3/2016
 * Time: 4:26 PM
 */




foreach (glob(PLUGIN_ROOT_DIR."/helper/*.php") as $filename)
{
  include_once $filename;
}



  $config_item = array(
    'smtp_server'=> 'google.com',
    'smtp_port' => '8080',
    'smtp_username' => 'babubd089@gmail.com',
    'smtp_password' =>''
);


 function configItem($param){

     echo $param;
    switch($param){
        case "smtp_server":

            return $this->config_item[$param];
            break;
        case "smtp_port":
            return $this->config_item[$param];
            break;
        case "smtp_username":
            return $this->config_item[$param];
            break;
        case "smtp_password":
            return $this->config_item[$param];
            break;
    }

}


//Euro Countries
function findCurrency(){
    $euro = [
        'ALB',
        'AND',
        'AUT',
        'BLR',
        'BEL',
        'BIH',
        'BGR',
        'HRV',
        'CYP',
        'CZE',
        'DNK',
        'EST',
        'FRO',
        'FIN',
        'FRA',
        'DEU',
        'GIB',
        'GRC',
        'HUN',
        'ISL',
        'IRL',
        'ITA',
        'LVA',
        'LIE',
        'LTU',
        'LUX',
        'MKD',
        'MLT',
        'MDA',
        'MCO',
        'NLD',
        'NOR',
        'POL',
        'PRT',
        'ROU',
        'RUS',
        'SMR',
        'SRB',
        'SVK',
        'SVN',
        'ESP',
        'SWE',
        'CHE',
        'UKR',
        'VAT',
        'RSB',
        'IMN',
        'XKX',
        'MNE'
    ];

    $country = geoip_country_code3_by_name($_SERVER['REMOTE_ADDR']);

    if($country == 'GBR')
    {
        return 'GBP';
    }
    elseif(in_array($country, $euro))
    {
        return 'EUR';
    }
    else
    {
        return 'USD';
    }
}


function getCurrency(){
    return "USD";
}

function get_method($object, $method){
    return function() use($object, $method){
        $args = func_get_args();
        return call_user_func_array(array($object, $method), $args);
    };
}

function generate_method_name($str){
    $strArr =array();
    $strArr = explode("_",$str);
    $method = "";
    foreach($strArr as $key => $val){
       $method .= ($key==0)? $val : ucfirst($val);
    }
    return $method;
}


if(!function_exists('init_header')){

    add_action('wp_head','init_header');
    function init_header(){

        if(!session_id()){
            session_start();

        }
        $user_folder = is_user_logged_in() ? get_current_user_id() : 'quotation';
            $_SESSION['job_folder']= session_id(). "_" . date("Y-m-d");
            $_SESSION["user_folder"] = $user_folder;



    }

}







/* REGISTER POST TYPE */

add_action('init', 'email_register');

function email_register()
{

    $labels = array(
        'name' => _x('Emails', 'post type general name'),
        'singular_name' => _x('Email', 'post type singular name'),
        'add_new' => _x('Add New Email', 'Team item'),
        'add_new_item' => __('Add a new subject'),
        'edit_item' => __('Edit email subject'),
        'new_item' => __('New email'),
        'view_item' => __('View email'),
        'search_items' => __('Search emails'),
        'not_found' =>  __('No emails found'),
        'not_found_in_trash' => __('No emails currently trashed'),
        'parent_item_colon' => ''
    );

    $capabilities = array(
        // this is where the first code block from above goes

            'publish_emails' => true,
            'edit_emails' => true,
            'edit_others_emails' => true,
            'delete_emails' => true,
            'delete_others_emails' => true,
            'read_private_emails' => true,
            'edit_email' => true,
            'delete_email' => true,
            'read_email' => true,
            // more standard capabilities here

    );

    $args = array(
        'labels' => $labels,
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'query_var' => false,
        'rewrite' => true,
        'capability_type' => 'email',
        'capabilities' => $capabilities,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'author', 'editor' )
    );

    register_post_type( 'email' , $args );

    flush_rewrite_rules( false );
}


/* MAP META CAPABILITIES */

add_filter( 'map_meta_cap', 'email_map_meta_cap', 10, 4 );

function email_map_meta_cap( $caps, $cap, $user_id, $args )
{

    if ( 'edit_email' == $cap || 'delete_email' == $cap || 'read_email' == $cap ) {
        $post = get_post( $args[0] );
        $post_type = get_post_type_object( $post->post_type );
        $caps = array();
    }

    if ( 'edit_email' == $cap ) {
        if ( $user_id == $post->post_author )
            $caps[] = $post_type->cap->edit_posts;
        else
            $caps[] = $post_type->cap->edit_others_posts;
    }

    elseif ( 'delete_email' == $cap ) {
        if ( $user_id == $post->post_author )
            $caps[] = $post_type->cap->delete_posts;
        else
            $caps[] = $post_type->cap->delete_others_posts;
    }

    elseif ( 'read_email' == $cap ) {
        if ( 'private' != $post->post_status )
            $caps[] = 'read';
        elseif ( $user_id == $post->post_author )
            $caps[] = 'read';
        else
            $caps[] = $post_type->cap->read_private_posts;
    }

    return $caps;
}


add_action( 'edit_form_after_title', 'myprefix_edit_form_after_title' );

function myprefix_edit_form_after_title() {
    echo '<br /><h1>Message</h1>';
}