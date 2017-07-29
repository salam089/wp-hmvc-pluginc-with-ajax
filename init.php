<?php

if (session_status() == PHP_SESSION_NONE) {

    add_action('init', 'portalStartSession', 1);
    add_action('wp_logout', 'portalEndSession');
    add_action('wp_login', 'portalEndSession');

    function portalStartSession()
    {
        if (!session_id()) {
            session_start();
        }
    }

    function portalEndSession()
    {
        session_destroy();
    }
}




?>