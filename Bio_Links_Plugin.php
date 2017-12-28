<?php

use Bio_Links_Plugin\Admin_View\Admin_View;
use Bio_Links_Plugin\Frontend\Template_Override;


/**
 * Bio_Links_Plugin
 * @package Bio_Links_Plugin
 * @type    `Singleton` God Object, the worst kind. Yet serves its function.
 *
 */
final class Bio_Links_Plugin {

	/**
	 * This is a Singleton class
	 * Singletons are almost always bad, surely not this time. Right?....
	 */
	protected static $_instance = NULL;

	/**
	 * Colormelon Bio Links Version
	 *
	 * @var string
	 */
	private $version = '1.0.0';


	/**
	 * Constructor.
	 */
	public function __construct() {

		define( 'BIOLINKS_VERSION', $this->version );
		define( 'BIOLINKS_BUILD_DIRECTORY', BIOLINKS_PLUGIN_DIR_URL . 'public/build/' );

		/**
		 * Everything else is handled in $this->boot(), so that `biolinks_instance()` is available if needed
		 */

	}


	public function boot_admin_view() {

		if ( is_admin() ) {
			new Admin_View();
		}

	}


	/**
	 * Main Instance.
	 *
	 * Ensures only one instance of Bio_Links_Plugin is loaded or can be loaded.
	 *
	 * @static
	 * @return Bio_Links_Plugin instance
	 *
	 * Very Heavily inspired by WooCommerce
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			// Create instance
			self::$_instance = new self();

			// Boot immediately
			self::$_instance->initialize();
		}

		return self::$_instance;
	}


	public function load_translations() {

		load_plugin_textdomain( 'bio-links', false, dirname( BIOLINKS_ABSPATH ) . '/languages' );
	}


	/**
	 * Cloning is forbidden.
	 */
	public function __clone() {

		_doing_it_wrong( __FUNCTION__, __( "Can't do this thing.", 'biolinks' ), '2.1' );
	}


	/**
	 * Unserializing instances of this class is forbidden.
	 */
	public function __wakeup() {

		_doing_it_wrong( __FUNCTION__, __( "Can't do this thing.", 'biolinks' ), '2.1' );
	}


	/**
	 * Maybe start loading portfolio template files instead of whatever WordPress was going to do.
	 * This is run @filter `template_include`
	 *
	 * @param $template - Current template path
	 *
	 * @return string
	 */
	public function override_template_include( $template ) {

		/**
		 * Exceptions
		 */
		if ( is_embed() ) {
			return $template;
		}

		/**
		 * If the current query says that this is a portfolio -
		 * Load the portfolio view
		 */
		if ( biolinks_is_queried() ) {

			$meta = biolinks_current_meta();

			$override = new Template_Override( $meta->layout() );
			$override->load();

		}


		/**
		 * Return $template if this is not the portfolio or a template was not located
		 */
		return $template;

	}


	/**
	 * Constructor is only going to set up the core
	 */
	protected function initialize() {

		$this->register_hooks();
	}


	protected function register_hooks() {

		/**
		 *
		 * Register Post Types
		 *
		 * post_type:   `biolinks_post`
		 * taxonomy:    `biolinks_post_category`
		 * Turns out taxonomies have to be registered before the
		 * post type is registered to get pretty URLs like `/portfolio/category/%cat`
		 *
		 * @link https://cnpagency.com/blog/the-right-way-to-do-wordpress-custom-taxonomy-rewrites/
		 *
		 * `add_action` order is improtant here:
		 */
		add_action( 'init', [ 'Bio_Links_Plugin\Core\Register_Post_Type', 'register_post_type' ], 5 );

		// Load Translations:
		add_action( 'init', [ $this, 'load_translations' ] );

		/**
		 * Load `Admin_View`
		 */
		add_action( 'init', [ $this, 'boot_admin_view' ], 30 );

		/*
		 *
		 * This at the core of loading all of the Bio Links template files
		 */
		add_filter( 'template_include', [ $this, 'override_template_include' ], 150 );

	}


}
