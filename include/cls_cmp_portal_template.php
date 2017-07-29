<?php
if(!class_exists('Oel_Cmp_Template'))
{
	/**
	 * A PostTypeTemplate class that provides 3 additional meta fields
	 */
	class Oel_Cmp_Template
	{
    	/**
    	 * The Constructor
    	 */
		private $slug;
    	public function __construct()
    	{
    		// register actions
			add_action('after_setup_theme',array(&$this, 'remove_admin_bar'));
    		add_action('init', array(&$this, 'init'));
    		add_action('admin_init', array(&$this, 'admin_init'));
    	} // END public function __construct()

    	/**
    	 * hook into WP's init action hook
    	 */
    	public function init()
    	{
    		// Initialize Post Type
			$this->slug = get_option(setting_portal);
    		$this->template_url_init();
    	} // END public function init()


    	public function admin_init()
    	{			

    	} // END public function admin_init()

		public function template_url_init() {
			$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');

			if ( $url_path === $this->slug ) {
				// load the file if exists

				$load = locate_template('template-retail.php', true);
				if ($load) {
					exit(); // just exit if template was found and loaded
				}
			}
		}



		function remove_admin_bar() {
			if (!current_user_can('administrator') && !is_admin()) {
				show_admin_bar(false);
			}
		}
			


	} // END class Post_Type_Template
} // END if(!class_exists('Post_Type_Template'))
