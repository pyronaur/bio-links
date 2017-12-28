<?php
/**
 * Flush Permalinks on plugin activation
 * Ensure PHP 5.2 compitability - don't use anonymous functions
 */
function biolinks_plugin_activation_hook() {

	// Register post types
	Bio_Links_Plugin\Core\Register_Post_Type::register_post_type();


	// Flush rewrite rules
	flush_rewrite_rules();

}