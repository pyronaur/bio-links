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

	// Initialize Bio Links
	biolinks_instance()->setup_settings();

	// Setup sample content
	// @TODO: Setup sample content
	//	new Bio_Links_Plugin\Settings\Sample_Content\Setup_Sample_Content();

}