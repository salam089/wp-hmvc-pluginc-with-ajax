<?php
if(!class_exists('Oel_CMP_Template_Settings'))
{
	class Oel_CMP_Template_Settings
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// register actions
            add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));
		} // END public function __construct
		
        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
        	// register your plugin's settings
        	register_setting('oel_portal_template-group', 'setting_portal');

        	// add your settings section
        	add_settings_section(
        	    'oel_portal_template-section',
        	    'Oel portal Template Settings',
        	    array(&$this, 'settings_section_wp_plugin_template'),
        	    'oel_portal_template'
        	);

        	// add your setting's fields
            add_settings_field(
                'oel_portal_template-setting_portal',
                'Setting Portal Url',
                array(&$this, 'settings_field_input_text'),
                'oel_portal_template',
                'oel_portal_template-section',
                array(
                    'field' => 'setting_portal'
                )
            );

            // Possibly do additional admin_init tasks
        } // END public static function activate

        public function settings_section_wp_plugin_template()
        {
            // Think of this as help text for the section.
            echo 'These settings do things for the protal page url slug.';
        }

        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_text($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            // echo a proper input type="text"
            echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
        } // END public function settings_field_input_text($args)

        /**
         * add a menu
         */
        public function add_menu()
        {
            // Add a page to manage this plugin's settings
        	add_options_page(
        	    'Oel portal Template Settings',
        	    'Oel Portal Template',
        	    'manage_options',
        	    'oel_portal_template',
        	    array(&$this, 'plugin_settings_page')
        	);
        } // END public function add_menu()

        /**
         * Menu Callback
         */
        public function plugin_settings_page()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}

        	// Render the settings template
        	include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
        } // END public function plugin_settings_page()
    } // END class WP_Plugin_Template_Settings
} // END if(!class_exists('WP_Plugin_Template_Settings'))
