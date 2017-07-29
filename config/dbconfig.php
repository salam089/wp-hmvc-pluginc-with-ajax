<?php

if ($_SERVER['SERVER_NAME'] == "localhost") {
    // Local
    define('ET_HOSTt', 'localhost');
    define('ET_USERt', 'sumon');
    define('ET_PASSt', '382065');
    define('ET_DBt', 'easytask');
}
else {
    // Old server
    /*define('ET_HOST', '198.57.179.108');
    define('ET_USER', 'oelet_etuser2');
    define('ET_PASS', '7b9hS70dv09Vg5XF1T');
    define('ET_DB', 'oelet_easytask');*/

    // New server
    define('ET_HOSTt', '162.243.203.114');
    define('ET_USERt', 'et_cpi');
    define('ET_PASSt', 'ZGGAScm2VjhHaTnN');
    define('ET_DBt', 'easytask');

}

?>