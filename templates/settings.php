<div class="wrap">
    <h2>Outsource Expert Portal Slug</h2>
    <form method="post" action="options.php"> 
        <?php @settings_fields('oel_portal_template-group'); ?>
        <?php @do_settings_fields('oel_portal_template-group'); ?>

        <?php do_settings_sections('oel_portal_template'); ?>

        <?php @submit_button(); ?>
    </form>
</div>