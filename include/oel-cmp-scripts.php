<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 8/4/2016
 * Time: 3:46 PM
 * Here all neecessary script will include / hookup with wordpress
 */

// for printing any javascript code in heade section
//add_action('wp_print_scripts','custom_print_script');
function custom_print_script(){

    ?>

    <script>
        var siteUrl = '<?php echo site_url(); ?>';
        //ajaxUrl =  '<?php echo admin_url('admin-ajax.php'); ?>';
        var templateDirRootUrl = '<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/';
        var pluginsDirUr = '<?php echo site_url(); ?>/wp-content/plugins/oel-cmp';
    </script>
    <?php

}



function oel_cmp_nonce_scripts()
{
    wp_enqueue_script('jquery');
    wp_localize_script(
        'jquery',
        'nonceLocalized',
        array(
            'partials' => trailingslashit(get_template_directory_uri()) . 'partials/',
            'nonce' => wp_create_nonce('wp_rest')
        )
    );
}
//add_action( 'wp_enqueue_scripts', 'oel_cmp_nonce_scripts' );