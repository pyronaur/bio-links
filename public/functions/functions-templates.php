<?php

use Bio_Links_Plugin\Frontend\Template;

/**
 * == Instantly load a template
 *
 * Only use this function to UNSET a template!
 * Never load templates with this function!
 *
 * Use `biolinks_get_template()` instead!
 *
 * @param $template
 * @param $slug
 */
function _biolinks_load_template( $template, $slug ) {

	Template::load( $template, $slug );
}


/**
 * Easily unload a template
 * @priority = 40
 */
function biolinks_detach_template( $template, $remove_when_slug = '*' ) {

	add_action(
		"biolinks_get_template/{$template}",

		function ( $template, $current_slug ) use ( $remove_when_slug ) {

			// Only remove action if conditional slug is unset or matches the $current_slug
			if ( $remove_when_slug === '*' || $remove_when_slug === $current_slug ) {
				remove_action( "biolinks_get_template/{$template}", '_biolinks_load_template', 50 );
			}

		},
		// priority 50 - 10 = 40
		40,

		// arguments = 2
		2
	);

}

/**
 * Shorthand to easily attach template to any `biolinks_get_template/{$template}` hook
 *
 * @param     $template - the template path, for example `single/layout`
 * @param     $callback
 * @param int $priority
 * @param int $arguments
 */
function biolinks_attach_template( $template, $callback, $priority = 50, $arguments = 2 ) {

	add_action( "biolinks_get_template/{$template}", $callback, $priority, $arguments );
}

/**
 * Get Portfolio Template
 * Kind of like `get_template_part()`
 *
 * @param      $template
 * @param null $slug
 *
 * @updated 1.4.0
 * @hook    `biolinks_get_template/{$template}`
 */
function biolinks_get_template( $template, $slug = NULL ) {

	/**
	 * Defer loading the requested $template path with `add_action()`
	 * This way anyone can load a desired template bit before or after an Bio Links template is loaded
	 *
	 * @priority = 50
	 * To load templates after a $template has loaded, increase the priority
	 * To load templates before - decrease the priority
	 *
	 */
	biolinks_attach_template( $template, '_biolinks_load_template' );

	/**
	 * Load any templates that have been attached to this:
	 */
	do_action( "biolinks_get_template/{$template}", $template, $slug );

}
