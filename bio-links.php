<?php
/**
 * @package           Bio Links
 * @link              http://pyronaur.com
 *
 * @wordpress-plugin
 * Plugin Name:       Bio links
 * Plugin URI:        http://pyronaur.com/plugins/bio-links
 * Description:       With Bio Links plugin you can turn a single link into many. A helpful tool direct your visitors where they need to go.
 * Version:           1.0.3
 * Author:            Pyronaur
 * Author URI:        http://pyronaur.com
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       bio-links
 * Domain Path:       /languages
 */
/**
 * This file should work without errors on PHP 5.2.17
 * Use this instead of __DIR__
 */
$__DIR = dirname( __FILE__ );


/**
 * Define Constants
 */
define( 'BIOLINKS_ABSPATH', $__DIR . '/' );
define( 'BIOLINKS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'BIOLINKS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

define( 'BIOLINKS_THEME_PATH', 'bio-links/' );
define( 'BIOLINKS_PLUGIN_THEME_PATH', BIOLINKS_ABSPATH . 'public/templates/' );
define( 'BIOLINKS_PREFIX', 'biolinks_' );


function biolinks_prefix( $key ) {

	return 'biolinks_' . $key;
}

/**
 * Require PHP 5.4
 * Instantly auto-deactivate if plugin requirements are not met
 */
if ( version_compare( phpversion(), '5.4', '<' ) ) {

	include( ABSPATH . "wp-includes/pluggable.php" );
	require_once $__DIR . '/php-require-54.php';

	$PP_Requre_PHP54 = new Bio_Links_Plugin_Require_PHP54();

	function biolinks_auto_deactivate() {

		deactivate_plugins( plugin_basename( __FILE__ ) );
	}

	if ( current_user_can( 'activate_plugins' ) ) {
		add_action( 'admin_notices', [ &$PP_Requre_PHP54, 'admin_notice' ] );
		add_action( 'admin_init', 'biolinks_auto_deactivate' );
	}
}



// ============================================================================
//  Initialize Bio Links
// ============================================================================
else {
	/**
	 * Setup Autoloading
	 */
	require_once $__DIR . '/vendor/autoload.php';


	/**
	 * Include CMB2
	 */
	if ( file_exists( $__DIR . '/vendor/cmb2/cmb2/init.php' ) ) {
		require_once $__DIR . '/vendor/cmb2/cmb2/init.php';
	}


	/**
	 * Require the Plugin God object.
	 */
	require_once $__DIR . '/Bio_Links_Plugin.php';


	/**
	 * Template Tags, public functions
	 */
	require_once $__DIR . '/public/functions/functions.php';
	require_once $__DIR . '/public/functions/functions-templates.php';


	/**
	 * Add CMB2 Symlinks support in development environments
	 */
	if ( defined( "WP_DEBUG" ) && WP_DEBUG ) {
		require_once $__DIR . '/cmb-symlinks.php';
	}


	/**
	 * Flush permalinks after plugin is activated
	 */
	// biolinks_plugin_activation_hook lives here:
	require_once $__DIR . '/activation-hooks.php';

	// register_activation_hook is best called from this file
	register_activation_hook( __FILE__, 'biolinks_plugin_activation_hook' );


	/**
	 * Boot Bio_Links_Plugin
	 * This happens before WordPress `init`
	 */
	add_action( 'after_setup_theme', 'biolinks_instance', 50 );

}